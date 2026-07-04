<?php
session_start();
require_once('../config/db_config.php');
$conn = getDBConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $conn->real_escape_string($_POST['id']);
    
    // First, get the image path to delete the file
    $sql = "SELECT image_path FROM news_posts WHERE id = '$id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_path = "../" . $row['image_path'];
        
        // Delete the file if it exists locally
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        
        // Delete the database record
        $sql = "DELETE FROM news_posts WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['success_message'] = "News item deleted successfully!";
        } else {
            $_SESSION['error_message'] = "Error deleting news item";
        }
    }
}

$conn->close();
header("Location: add_news.php");
exit();
