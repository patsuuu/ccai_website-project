<?php
header('Content-Type: application/json');

$uploadDir = 'forms/admission/'; // Update to match the path in functions.php

// Create directory if it doesn't exist
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$response = ['status' => 'error', 'message' => ''];

if (isset($_FILES['files'])) {
    $files = $_FILES['files'];
    $formName = isset($_POST['formName']) ? $_POST['formName'] : '';
    $successCount = 0;
    $errors = [];

    for ($i = 0; $i < count($files['name']); $i++) {
        if ($files['error'][$i] === 0) {
            $fileName = $files['name'][$i];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            
            // Generate timestamp for unique filename
            $timestamp = date('YmdHis');
            
            // If form name is provided, use it as the filename
            if ($formName) {
                $newFileName = $timestamp . '_' . cleanFileName($formName) . '.' . $fileExt;
            } else {
                $newFileName = $timestamp . '_' . cleanFileName(pathinfo($fileName, PATHINFO_FILENAME)) . '.' . $fileExt;
            }
            
            // Only allow PDF files
            if ($fileExt === 'pdf') {
                $destination = $uploadDir . $newFileName;
                
                if (move_uploaded_file($files['tmp_name'][$i], $destination)) {
                    $successCount++;
                } else {
                    $errors[] = "Failed to move uploaded file: " . $fileName;
                }
            } else {
                $errors[] = "Invalid file type for: " . $fileName . ". Only PDF files are allowed.";
            }
        } else {
            $errors[] = "Error uploading file: " . $fileName;
        }
    }

    if ($successCount > 0) {
        $response['status'] = 'success';
        $response['message'] = $successCount . " file(s) uploaded successfully.";
    }
    
    if (!empty($errors)) {
        $response['errors'] = $errors;
    }
} else {
    $response['message'] = 'No files were uploaded.';
}

function cleanFileName($name) {
    // Remove special characters and replace spaces with underscores
    $name = preg_replace('/[^A-Za-z0-9\-\s]/', '', $name);
    $name = str_replace(' ', '_', trim($name));
    return $name;
}

echo json_encode($response);
