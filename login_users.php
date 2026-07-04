<?php
session_start();
require_once('includes/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM user_users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_username'] = $user['username'];
            header("Location: admin/create_admin.php");
            exit;
        } else {
            $error = "Invalid username or password";
        }
    } catch(PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>
<?php if(isset($_GET['timeout'])): ?>
    <div class="alert alert-warning">
        Your session has expired due to inactivity. Please login again.
    </div>
<?php endif; ?>
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
<!DOCTYPE html>
<html lang="en">
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
<head>
    <meta charset="UTF-8">
    <title>Super Admin Login | Cavite Community Academy, Inc.</title>
    <link rel="shortcut icon" href="../ccai-logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('../ccai.png') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
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

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
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
            width: 80px;  /* Changed from 80px to match login.php */
            height: 80px; /* Added to match login.php */
            margin-bottom: 20px;
            animation: pulse 2s infinite;
            object-fit: contain; /* Added to match login.php */
        }

        @keyframes pulse {  /* Added pulse animation */
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

        /* Add these responsive styles */
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

        /* Touch device optimizations */
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

        .forgot-password {
            text-align: center;
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .forgot-password a {
            color: #000080;
            text-decoration: none;
            font-size: 0.9rem;
            padding: 5px 15px;
            transition: all 0.3s ease;
        }

        .forgot-password a:hover {
            color: #000066;
            text-decoration: underline;
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
    <div class="login-container">
        <div class="login-header">
            <img src="../ccai-logo.png" alt="CCAI Logo">
            <h2>Super Admin Login</h2>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="password-container">
                    <input type="password" name="password" id="password" class="form-control" required>
                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <div class="forgot-password">
              
            </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.querySelector('.toggle-password i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.className = 'fa fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleButton.className = 'fa fa-eye';
            }
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
</body>
</html>
