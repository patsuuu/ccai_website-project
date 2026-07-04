<?php
session_start();
require_once('../includes/db_connect.php');

// Update session check for admin users
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
   
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $security_question = trim($_POST['security_question']);
    $security_answer = trim($_POST['security_answer']);
    $role = trim($_POST['role']); // Add role field

    // Validate input
    if (strlen($username) < 4) {
        $error = "Username must be at least 4 characters long";
    } elseif (!in_array($role, ['admin', 'superadmin'])) {
        $error = "Invalid role selected";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match";
    } elseif (empty($security_question) || empty($security_answer)) {
        $error = "Security question and answer are required";
    } else {
        try {
            // Determine which table to use based on role
            $table = ($role === 'admin') ? 'superadmin_users' : 'admin_users';
            
            // Check if username already exists in selected table
            $stmt = $pdo->prepare("SELECT id FROM $table WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->rowCount() > 0) {
                $error = "Username already exists";
            } else {
                // Create new account in selected table
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $hashed_answer = password_hash($security_answer, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO $table (username, password, security_question, security_answer) VALUES (?, ?, ?, ?)");
                $stmt->execute([$username, $hashed_password, $security_question, $hashed_answer]);
                $success = ucfirst($role) . " account created successfully";
            }
        } catch(PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account | Cavite Community Academy, Inc.</title>
    <link rel="shortcut icon" href="../ccai-logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .admin-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0,0,0,0.1);
        }
        .page-header {
            background-color: #000080;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
        }
        .header-logo {
            width: 60px;
            height: 60px;
            margin-bottom: 15px;
            border-radius: 50%;
            border: 3px solid white;
        }
        .form-label {
            color: #000080;
            font-weight: 600;
        }
        
        /* Add these new styles */
        .select-wrapper {
            position: relative;
        }
        
        .select-wrapper::after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #000080;
            pointer-events: none;
        }

        .select-wrapper select {
            appearance: none;
            -webkit-appearance: none;
            padding-right: 40px;
        }

        .select-wrapper select option[value="custom"] {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #000080;
            border: none;
            padding: 10px 25px;
        }
        .btn-primary:hover {
            background-color: #000066;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,128,0.3);
        }
        .message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            animation: fadeIn 0.5s ease-out;
        }
        .success-message {
            background-color: #d4edda;
            border-left: 5px solid #28a745;
            color: #155724;
        }
        .error-message {
            background-color: #f8d7da;
            border-left: 5px solid #dc3545;
            color: #721c24;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<script type="text/javascript">
        // Prevent back button
        window.onload = function() {
            noBack();
        }
        window.onpageshow = function(evt) {
            if (evt.persisted) {
                noBack();
            }
        }
        window.onunload = function() {
            void(0);
        }
    </script>
    <script type="text/javascript">
        // Prevent back button
        window.onload = function() {
            noBack();
        }
        window.onpageshow = function(evt) {
            if (evt.persisted) {
                noBack();
            }
        }
        window.onunload = function() {
            void(0);
        }
    </script>
<body>
    <div class="admin-container">
        <div class="page-header">
            <img src="../ccai-logo.png" alt="CCAI Logo" class="header-logo">
            <h2><i class="fas fa-user-plus me-2"></i>Create Account</h2>
        </div>

        <?php if ($success): ?>
            <div class="message success-message">
                <i class="fas fa-check-circle me-2"></i><?php echo $success; ?>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="message error-message">
                <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Account Type</label>
                <div class="select-wrapper">
                    <select name="role" class="form-control" required>
                        <option value="">Select account type</option>
                        <option value="admin">Admin</option>
                        <option value="superadmin">Super Admin</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required minlength="4">
            </div>
            <div class="mb-3">
                <label class="form-label">Security Question</label>
                <div class="select-wrapper">
                    <select name="security_question" class="form-control" id="security_question" required onchange="toggleCustomQuestion()">
                        <option value="">Select a security question</option>
                        <option value="What is your birth date?">What is your birth date?</option>
                        <option value="What was your first pet's name?">What was your first pet's name?</option>
                        <option value="What city were you born in?">What city were you born in?</option>
                        <option value="What is your favorite color?">What is your favorite color?</option>
                        <option value="What was the name of your first school?">What was the name of your first school?</option>
                        <option value="custom">Add your own question</option>
                    </select>
                </div>
                <input type="text" name="custom_question" id="custom_question" class="form-control mt-2" 
                    placeholder="Enter your security question" style="display: none;">
            </div>
            <div class="mb-3">
                <label class="form-label">Security Answer</label>
                <input type="text" name="security_answer" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required minlength="6">
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-user-plus me-2"></i>Create Account
                </button>
                <a href="../admin.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Admin Panel
                </a>
            </div>
        </form>
    </div>
    <script>
        function toggleCustomQuestion() {
            const select = document.getElementById('security_question');
            const customInput = document.getElementById('custom_question');
            
            if (select.value === 'custom') {
                customInput.style.display = 'block';
                customInput.required = true;
                select.name = ''; // Remove name attribute from select
                customInput.name = 'security_question'; // Add name attribute to input
            } else {
                customInput.style.display = 'none';
                customInput.required = false;
                select.name = 'security_question'; // Restore name attribute to select
                customInput.name = 'custom_question'; // Remove name from input
            }
        }
    </script>
</body>
</html>
