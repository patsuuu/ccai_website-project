<?php
function getAvailableForms($directory = 'forms/admission/') {
    $forms = [];
    if (is_dir($directory)) {
        $files = scandir($directory);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..' && pathinfo($file, PATHINFO_EXTENSION) == 'pdf') {
                $filePath = $directory . $file;
                $forms[] = [
                    'name' => $file,
                    'displayName' => pathinfo($file, PATHINFO_FILENAME),
                    'path' => $filePath,
                    'size' => filesize($filePath),
                    'date' => filemtime($filePath),
                    'type' => 'PDF Document'
                ];
            }
        }
        usort($forms, function($a, $b) {
            return $b['date'] - $a['date'];
        });
    }
    return $forms;
}

function determineFormType($filename) {
    $filename = strtolower($filename);
    if (strpos($filename, 'registration') !== false) {
        return 'Registration Form';
    } elseif (strpos($filename, 'enrollment') !== false) {
        return 'Enrollment Form';
    } elseif (strpos($filename, 'admission') !== false) {
        return 'Admission Form';
    } else {
        return 'Other Form';
    }
}
