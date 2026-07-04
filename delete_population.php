<?php
require_once('db_connect.php');

if (isset($_GET['id'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM student_population WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        
        // Stay on popul.php with success message
        header("Location: popul.php?success=deleted");
        exit;
    } catch(PDOException $e) {
        header("Location: popul.php?error=" . urlencode($e->getMessage()));
        exit;
    }
}

// Redirect back to popul.php if no ID provided
header("Location: popul.php");
exit;
?>
