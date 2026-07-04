<?php
session_start();
require_once('includes/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['verify_username'])) {
        $username = $_POST['username'];
        $account_type = $_POST['account_type'];
        
        // Select table based on account type
        $table = ($account_type === 'superadmin') ? 'superadmin_users' : 'admin_users';
        
        $stmt = $pdo->prepare("SELECT * FROM $table WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if($user) {
            $_SESSION['reset_user_id'] = $user['id'];
            $_SESSION['security_question'] = $user['security_question'];
            $_SESSION['account_type'] = $account_type; // Store account type in session
        } else {
            $error = "Username not found";
        }
    } 
    else if(isset($_POST['verify_answer'])) {
        $answer = $_POST['security_answer'];
        $user_id = $_SESSION['reset_user_id'];
        
        $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();

        if($user && password_verify($answer, $user['security_answer'])) {
            $_SESSION['security_verified'] = true;
        } else {
            $error = "Incorrect answer";
        }
    }
    else if(isset($_SESSION['security_verified'])) {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        try {
            if ($new_password !== $confirm_password) {
                $error = "Passwords do not match";
            } else if (strlen($new_password) < 8) {
                $error = "Password must be at least 8 characters long";
            } else {
                $user_id = $_SESSION['reset_user_id'];
                $table = ($_SESSION['account_type'] === 'superadmin') ? 'superadmin_users' : 'admin_users';
                
                $stmt = $pdo->prepare("SELECT * FROM $table WHERE id = ?");
                $stmt->execute([$user_id]);
                $user = $stmt->fetch();

                if ($user) {
                    $hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("UPDATE $table SET password = ? WHERE id = ?");
                    $stmt->execute([$hash, $user['id']]);
                    $success = "Password has been reset successfully";
                    session_unset();
                    session_destroy();
                } else {
                    $error = "User not found";
                }
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
    <title>Reset Password | Cavite Community Academy, Inc.</title>
    <link rel="shortcut icon" href="../ccai-logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('ccai.png') no-repeat center center fixed;
            background-size: cover;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                135deg,
                rgba(0, 0, 0, 0.85),
                rgba(0, 0, 128, 0.75)
            );
            z-index: -1;
            backdrop-filter: blur(3px);
            pointer-events: none;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        body::after {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(
                circle,
                rgba(255, 255, 255, 0.1) 0%,
                transparent 60%
            );
            animation: shine 15s linear infinite;
            z-index: -1;
            pointer-events: none;
        }

        @keyframes shine {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 50px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.5s ease-out;
            position: relative;
            overflow: hidden;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 10s linear infinite;
            pointer-events: none;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header img {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
            object-fit: contain;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .login-header h2 {
            color: #000080;
            font-weight: bold;
            text-shadow: 0 0 10px rgba(0,0,128,0.2);
        }

        .form-control {
            background: rgba(255,255,255,0.9);
            border: 1px solid rgba(0,0,128,0.2);
            padding: 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255,255,255,1);
            border-color: #000080;
            box-shadow: 0 0 0 0.25rem rgba(0,0,128,0.25);
            transform: translateY(-2px);
        }

        .btn-primary {
            background-color: #000080;
            border: none;
            padding: 12px 20px;
            width: 100%;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-primary::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent,
                rgba(255, 255, 255, 0.1),
                transparent
            );
            transform: rotate(45deg);
            animation: buttonShine 2s infinite;
        }

        @keyframes buttonShine {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }

        .btn-primary:active {
            background-color: #000080 !important;
            transform: translateY(-2px);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 128, 0.3);
            background-color: #000080;
            color: white;
        }

        @keyframes fadeIn {
            from { 
                opacity: 0; 
                transform: translateY(-20px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
        
        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            color: #000080;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .toggle-password:hover {
            color: #000066;
            transform: translateY(-50%) scale(1.1);
        }

        .back-to-login {
            text-align: center;
            margin-top: 20px;
        }

        .back-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(-5px);
            color: white;
        }

        .back-btn i {
            font-size: 1.2rem;
        }

        .btn-back-form {
            background: #000080;
            color: white;
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .btn-back-form:hover {
            transform: translateX(-3px);
            background: #000066;
            box-shadow: 0 3px 8px rgba(0,0,0,0.3);
        }

        .position-relative {
            position: relative;
        }

        @media (max-width: 480px) {
            .login-container {
                max-width: 90%;
                padding: 20px;
                margin: 10px;
            }

            .login-header img {
                width: 60px;
            }

            .login-header h2 {
                font-size: 1.5rem;
            }

            .form-control {
                padding: 8px;
            }

            .btn-primary {
                padding: 10px 15px;
            }

            .back-btn {
                padding: 8px 15px;
                font-size: 0.8rem;
            }
        }

        @media (hover: none) {
            .btn-primary:hover {
                transform: none;
            }

            .back-btn:hover {
                transform: none;
            }

            .toggle-password:hover {
                transform: translateY(-50%);
            }
        }
    </style>
</head>
<body>
    <a href="../admin/login.php" class="back-btn">
        <i class="fa fa-arrow-left"></i>
        Back
    </a>
    <div class="login-container">
        <div class="login-header">
            <img src="../../ccai-logo.png" alt="CCAI Logo">
            <h2>Reset Password</h2>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="alert alert-success">
                <?php echo $success; ?>
                <div class="mt-3">
                    <a href="../admin/login.php" class="btn btn-primary">Return to Login</a>
                </div>
            </div>
        <?php else: ?>
            <?php if(!isset($_SESSION['reset_user_id'])): ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Account Type</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="account_type" id="admin" value="admin" checked>
                                <label class="form-check-label" for="admin">Super Admin</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="account_type" id="superadmin" value="superadmin">
                                <label class="form-check-label" for="superadmin">Admin</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <button type="submit" name="verify_username" class="btn btn-primary">Continue</button>
                </form>
            <?php elseif(!isset($_SESSION['security_verified'])): ?>
                <div class="position-relative mb-4">
                    <!-- Move back button to top -->
                    <div class="d-flex justify-content-start mb-3">
                        <button type="button" class="btn-back-form" onclick="resetForm()">
                            <i class="fa fa-arrow-left"></i>
                        </button>
                    </div>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Security Question:</label>
                            <p class="form-control-static"><?php echo htmlspecialchars($_SESSION['security_question']); ?></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Your Answer</label>
                            <input type="text" name="security_answer" class="form-control" required>
                        </div>
                        <button type="submit" name="verify_answer" class="btn btn-primary">Verify Answer</button>
                    </form>
                </div>
            <?php else: ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <div class="password-container">
                            <input type="password" name="new_password" id="new_password" class="form-control" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('new_password')">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <div class="password-container">
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('confirm_password')">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Reset Password
                        <span class="shine"></span>
                    </button>
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const button = input.nextElementSibling.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                button.className = 'fa fa-eye-slash';
            } else {
                input.type = 'password';
                button.className = 'fa fa-eye';
            }
        }

        function resetForm() {
            // Clear session and reload the page
            fetch('clear_session.php')
                .then(() => {
                    window.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>';
                })
                .catch(error => {
                    console.error('Error:', error);
                    window.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>';
                });
        }
    </script>
</body>
</html>