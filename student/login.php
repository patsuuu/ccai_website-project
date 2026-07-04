<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lrn = $_POST['lrn'] ?? '';
    $password = $_POST['password'];

    // Student login
    $stmt = $conn->prepare("SELECT * FROM students WHERE lrn = ? AND password = ?");
    $stmt->bind_param("ss", $lrn, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $student = $result->fetch_assoc();
        $_SESSION['student_id'] = $student['student_id'];
        $_SESSION['lrn'] = $student['lrn'];
        $_SESSION['name'] = $student['first_name'] . ' ' . $student['last_name'];
        header('Location: view_grades.php');
        exit;
    }
    $error = "Invalid LRN or password";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" href="../assets/ccai-logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <title>Student Login</title>
</head>
<body>
    <div class="login-container" style="max-width:700px;">
        <div class="login-box">
            <?php if (isset($error)): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="logo-section">
                <img src="../assets/ccai-logo.png" alt="CCAI Logo">
                <h1>Student Portal</h1>
            </div>

            <form method="post" id="loginForm">
                <div class="form-group">
                    <input type="number" 
                           id="lrn" 
                           name="lrn" 
                           required
                           minlength="12"
                           maxlength="12"
                           inputmode="numeric"
                           onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                           oninput="javascript: if (this.value.length > 12) this.value = this.value.slice(0, 12); this.value = this.value.replace(/[^0-9]/g, '');">
                    <label for="lrn">LRN</label>
                </div>

                <div class="form-group">
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required>
                    <label for="password">Password</label>
                </div>

                <div class="forgot-password">
                    <a href="forgot-password.php">Forgot Password?</a>
                </div>
                
                <button type="submit" class="login-btn">Sign In</button>
            </form>

            <div class="switch-login">
                <a href="../adviser/login.php">Login as Adviser</a>
                <span style="margin: 0 10px;">|</span>
                <a href="../admin/login.php">Login as Admin</a>
            </div>
        </div>
    </div>
</body>
</html>
