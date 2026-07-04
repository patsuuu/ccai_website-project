<?php
$db_host = 'sql108.infinityfree.com';
$db_name = 'if0_38418315_ccai_db';
$db_user = 'if0_38418315';
$db_pass = 'hMnz6Kmq5YaMB';

try {
    $pdo = new PDO("mysql:host=$db_host;port=3306;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
