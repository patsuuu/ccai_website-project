<?php
session_start();
require_once('config/db_config.php');

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Check if user is logged in
function checkAuth() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header("Location: login.php");
        exit();
    }
}

// Prevent going back after logout
function preventBack() {
    if (isset($_SESSION['admin_logged_in'])) {
        echo "
        <script type='text/javascript'>
            window.history.forward();
            function noBack() {
                window.history.forward();
            }
        </script>";
    }
}
?>
