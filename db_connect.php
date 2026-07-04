<?php
$host = 'sql108.infinityfree.com';  // InfinityFree MySQL hostname
$dbname = 'if0_38418315_ccai_db';      // Your database name
$username = 'if0_38418315';         // InfinityFree MySQL username
$password = 'hMnz6Kmq5YaMB';        // InfinityFree MySQL password
$port = 3306;                       // MySQL port

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>