<?php
require_once 'database.php';

// Enable error reporting at the top
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set PHP configuration for large uploads
ini_set('upload_max_filesize', '500M');
ini_set('post_max_size', '500M');
ini_set('max_execution_time', '300');
ini_set('max_input_time', '300');

// Handle delete request
if(isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $stmt = $pdo->prepare("SELECT url, thumbnail FROM videos WHERE id = ?");
    $stmt->execute([$id]);
    $video = $stmt->fetch();
    
    if($video) {
        if(file_exists($video['url'])) {
            unlink($video['url']); // Delete video file
        }
        if(file_exists($video['thumbnail'])) {
            unlink($video['thumbnail']); // Delete thumbnail file
        }
    }
    
    $stmt = $pdo->prepare("DELETE FROM videos WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: upload_video1.php");
    exit();
}

// Handle upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["video"])) {
    $target_dir = "uploads/videos/";
    $thumbs_dir = "uploads/thumbnails/";
    
    // Create directories with proper permissions
    if (!file_exists($target_dir)) {
        if (!mkdir($target_dir, 0777, true)) {
            die('Failed to create videos directory');
        }
        chmod($target_dir, 0777);
    }
    
    if (!file_exists($thumbs_dir)) {
        if (!mkdir($thumbs_dir, 0777, true)) {
            die('Failed to create thumbnails directory');
        }
        chmod($thumbs_dir, 0777);
    }

    $video = $_FILES["video"];
    
    // Check for upload errors
    if ($video["error"] !== UPLOAD_ERR_OK) {
        switch ($video["error"]) {
            case UPLOAD_ERR_INI_SIZE:
                die("The uploaded file exceeds the upload_max_filesize directive in php.ini");
            case UPLOAD_ERR_FORM_SIZE:
                die("The uploaded file exceeds the MAX_FILE_SIZE directive in the HTML form");
            case UPLOAD_ERR_PARTIAL:
                die("The uploaded file was only partially uploaded");
            case UPLOAD_ERR_NO_FILE:
                die("No file was uploaded");
            default:
                die("Unknown upload error");
        }
    }

    $title = $_POST["title"];
    
    // Validate file size (500MB max)
    $maxFileSize = 500 * 1024 * 1024;
    if ($video["size"] > $maxFileSize) {
        die('File is too large. Maximum size is 500MB.');
    }
    
    $video_name = time() . '_' . basename($video["name"]);
    $target_file = $target_dir . $video_name;

    if (move_uploaded_file($video["tmp_name"], $target_file)) {
        // Insert into database without thumbnail for now
        $stmt = $pdo->prepare("INSERT INTO videos (url, title) VALUES (?, ?)");
        if($stmt->execute([$target_file, $title])) {
            header("Location: upload_video1.php");
            exit();
        } else {
            unlink($target_file);
            die('Database error occurred: ' . implode(", ", $stmt->errorInfo()));
        }
    } else {
        die('Error uploading file. Check directory permissions.');
    }
}

// Fetch all videos
$videos = $pdo->query("SELECT * FROM videos ORDER BY id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Upload Video | Cavite Community Academy, Inc.</title>
    <link rel="shortcut icon" href="ccai-logo.png" type="image/svg+xml" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/ccai-logo.png" type="image/png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        
        .admin-container {
            max-width: 1000px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0,0,0,0.1);
        }
        
        .page-header {
            background-color: #000080;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .header-logo {
            max-width: 100px;
            height: auto;
            margin: 10px auto;
            display: block;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        .video-section {
            padding: 4rem 2rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .video-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            animation: containerFadeIn 0.8s ease-out;
        }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 2rem;
            padding: 1rem;
            animation: fadeIn 1s ease-out;
        }
        .video-item {
            background: #f8f9fa;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-radius: 8px;
        }
        .video-item video {
            width: 100%;
            border-radius: 4px;
        }
        .progress {
            display: none;
            margin-top: 10px;
        }
        .upload-status {
            margin-top: 10px;
            display: none;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes containerFadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="page-header">
            <h1 class="text-center mb-3"><i class="fas fa-video me-2"></i>Video Management System</h1>
            <img src="../ccai-logo.png" alt="CCAI Logo" class="header-logo">
        </div>

        <div class="video-section">
            <div class="video-container">
                <!-- Upload Form -->
                <div class="card shadow">
                    <div class="card-header" style="background: #000080 !important; color: white;">
                        <h3 class="mb-0"><i class="fa fa-upload me-2"></i>Upload New Video</h3>
                    </div>
                    <div class="card-body">
                        <form action="upload_video.php" method="POST" enctype="multipart/form-data" class="mt-4">
                            <input type="hidden" name="MAX_FILE_SIZE" value="524288000"/>
                            
                            <div class="mb-3">
                                <label for="title" class="form-label">Video Title</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="video" class="form-label">Select Video (Max 500MB)</label>
                                <input type="file" class="form-control" name="video" id="videoInput" accept="video/*" required>
                            </div>
                            <div class="preview-container">
                                <video id="videoPreview" controls style="display:none">
                                    Your browser doesn't support video playback.
                                </video>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Upload Video</button>
                                <a href="superadmin.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Admin
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Videos List -->
                <div class="card shadow mt-4">
                    <div class="card-header" style="background: #000080 !important; color: white;">
                        <h3 class="mb-0"><i class="fa fa-film me-2"></i>Uploaded Videos</h3>
                    </div>
                    <div class="card-body">
                        <div class="video-grid">
                            <?php foreach($videos as $video): ?>
                                <div class="video-item">
                                    <video controls poster="<?= htmlspecialchars($video['thumbnail'] ?? '') ?>">
                                        <source src="<?= htmlspecialchars($video['url']) ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <h5 class="mt-2"><?= htmlspecialchars($video['title']) ?></h5>
                                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this video?');">
                                        <button type="submit" name="delete" value="<?= $video['id'] ?>" 
                                                class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('videoInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 500 * 1024 * 1024) {
                    alert('File is too large. Maximum size is 500MB.');
                    this.value = '';
                    return;
                }
                const video = document.getElementById('videoPreview');
                video.style.display = 'block';
                video.src = URL.createObjectURL(file);
            }
        });
    </script>
</body>
</html>
