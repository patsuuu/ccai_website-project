<?php
$servername = "sql108.infinityfree.com";
$username = "if0_38418315";
$password = "hMnz6Kmq5YaMB"; // InfinityFree MySQL password
$dbname = "if0_38418315_ccai_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
