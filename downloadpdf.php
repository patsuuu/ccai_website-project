<?php
// Get the file parameter
$filename = $_GET["file"];

// Set the file path
$filepath = "forms/admission/" . $filename;

// Check if file exists
if (file_exists($filepath)) {
    // Set appropriate headers
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
    header('Content-Length: ' . filesize($filepath));
    header('Cache-Control: no-cache, no-store, must-revalidate');
    
    // Clear output buffer
    ob_clean();
    flush();
    
    // Read and output file
    readfile($filepath);
    exit;
} else {
    die('Error: File not found');
}
?>
