<?php
// InfinityFree hosting configuration
define('DB_HOST', 'sql108.infinityfree.com');
define('DB_USER', 'if0_38418315');
define('DB_PASS', 'hMnz6Kmq5YaMB');
define('DB_NAME', 'if0_38418315_ccai_db'); // Use the correct InfinityFree database name
define('DB_PORT', '3306');

// For local development, use this URL
define('SITE_URL', '/upload');

function getDBConnection() {
    try {
        // Create connection without port number for InfinityFree
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $conn->set_charset("utf8mb4");
        
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
        
        return $conn;
    } catch (Exception $e) {
        die("Connection error: " . $e->getMessage());
    }
}

// Function to test connection
function testConnection() {
    try {
        $conn = getDBConnection();
        echo "Database connection successful!";
        $conn->close();
        return true;
    } catch (Exception $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
}
