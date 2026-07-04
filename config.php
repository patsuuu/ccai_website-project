<link rel="icon" href="assets/ccai-logo.png">
<?php
// Database configuration
$db_host = 'sql108.infinityfree.com';  // InfinityFree hostname
$db_user = 'if0_38418315';            // InfinityFree username
$db_pass = 'hMnz6Kmq5YaMB';          // InfinityFree password
$db_name = 'if0_38418315_ccai_db';    // InfinityFree database name

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
