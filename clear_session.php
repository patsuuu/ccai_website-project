<?php
session_start();
session_unset();
session_destroy();
header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate');
echo json_encode(['success' => true]);
exit;
?>
