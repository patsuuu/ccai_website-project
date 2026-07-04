<?php
session_start();
require_once('../config/db_config.php');
$conn = getDBConnection();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    // Remove nl2br to store raw text
    $description = $conn->real_escape_string($_POST['description']);
    $post_date = $_POST['post_date'];
    
    // Update target directory path
    $target_dir = "../uploads/news/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    $newFileName = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $newFileName;
    
    // Update the database path to include the full URL path
    $db_image_path = "/uploads/news/" . $newFileName; // Remove the dot from ../
    
    $valid = true;
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check === false) {
        $error_message = "File is not an image.";
        $valid = false;
    }
    
    if ($_FILES["image"]["size"] > 5000000) {
        $error_message = "File is too large. Maximum size is 5MB.";
        $valid = false;
    }
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $error_message = "Only JPG, JPEG, PNG files are allowed.";
        $valid = false;
    }
    
    if ($valid) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO news_posts (title, description, image_path, post_date) 
                   VALUES ('$title', '$description', '$db_image_path', '$post_date')";
            
            if ($conn->query($sql) === TRUE) {
                $success_message = "News post added successfully!";
                // Clear form data
                $_POST = array();
            } else {
                $error_message = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $error_message = "Error uploading file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../ccai-logo.png" type="image/x-icon">
    <title>News Management System | Cavite Community Academy, Inc.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        .admin-container {
            max-width: 1000px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0,0,0,0.1);
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
            max-width: 100px;
            height: auto;
            margin: 10px auto;
            display: block;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        .form-control:focus {
            border-color: #000080;
            box-shadow: 0 0 0 0.2rem rgba(0,0,128,0.25);
        }
        .btn-primary {
            background-color: #000080;
            border-color: #000080;
        }
        .btn-primary:hover {
            background-color: #000066;
            border-color: #000066;
        }
        .news-table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }
        .table thead th {
            background-color: #000080;
            color: white;
            border: none;
        }
        .message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            animation: slideDown 0.5s ease-out;
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
        .form-section {
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }
        .form-label {
            color: #000080;
            font-weight: 600;
        }
        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .btn {
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .table-responsive {
            margin-top: 30px;
            border-radius: 10px;
            overflow: hidden;
        }
        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        .delete-btn:hover {
            background-color: #c82333;
            transform: translateY(-2px);
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
            <h1 class="text-center mb-3"><i class="fas fa-newspaper me-2"></i>News Management System</h1>
            <img src="../ccai-logo.png" alt="CCAI Logo" class="header-logo">
        </div>

        <?php if ($success_message): ?>
            <div class="message success-message">
                <i class="fas fa-check-circle me-2"></i><?php echo $success_message; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error_message): ?>
            <div class="message error-message">
                <i class="fas fa-exclamation-circle me-2"></i><?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <div class="form-section">
            <h3 class="mb-4"><i class="fas fa-plus-circle me-2"></i>Add New Post</h3>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="10" style="white-space: pre-wrap;"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" class="form-control" name="post_date" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" class="form-control" name="image" accept="image/*" required>
                </div>
                <div class="text-end mt-4">
                    <a href="../admin.php" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left me-2"></i>Back to Admin
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Submit
                    </button>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <h3 class="mb-4"><i class="fas fa-list me-2"></i>Existing News</h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                          <th>Description</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT id, title, description, post_date, image_path FROM news_posts ORDER BY post_date DESC";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            // Add image column first
                            echo "<td><img src='.." . $row['image_path'] . "' alt='News thumbnail' style='width: 100px; height: 60px; object-fit: cover; border-radius: 4px;'></td>";
                            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                             echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['post_date']) . "</td>";
                            echo "<td>
                                    <form action='delete.php' method='POST' style='display:inline;' onsubmit='return confirm(\"Are you sure you want to delete this news item?\");'>
                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                        <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                    </form>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>No news items found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Clear success message after 5 seconds
        setTimeout(function() {
            var successMessage = document.querySelector('.success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 5000);
    </script>
</body>
</html>
