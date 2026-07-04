<?php
header('Content-Type: application/json');

$response = ['status' => 'error', 'message' => ''];

if (isset($_POST['filename'])) {
    $filename = $_POST['filename'];
    $filepath = 'forms/admission/' . $filename;
    
    // Validate filename to prevent directory traversal
    if (strpos($filename, '/') !== false || strpos($filename, '\\') !== false) {
        $response['message'] = 'Invalid filename';
    }
    // Check if file exists and is within allowed directory
    else if (file_exists($filepath) && pathinfo($filepath, PATHINFO_EXTENSION) === 'pdf') {
        if (unlink($filepath)) {
            $response['status'] = 'success';
            $response['message'] = 'File deleted successfully';
        } else {
            $response['message'] = 'Unable to delete file';
        }
    } else {
        $response['message'] = 'File not found or invalid file type';
    }
} else {
    $response['message'] = 'No filename provided';
}

echo json_encode($response);
