<?php
include 'connection.php';

// Add error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Log the incoming data
    error_log("Received POST data: " . print_r($_POST, true));
    
    $title = $_POST['title'];
    $start_date = $_POST['start_date'];
    $end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : NULL;
    $color = !empty($_POST['color']) ? $_POST['color'] : '#3788d8';

    // Handle file upload
    $imagePath = NULL;
    if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['event_image']['tmp_name'];
        $fileName = $_FILES['event_image']['name'];
        $fileSize = $_FILES['event_image']['size'];
        $fileType = $_FILES['event_image']['type'];
        
        // Validate file size (2MB max)
        if ($fileSize > 2 * 1024 * 1024) {
            echo json_encode(["success" => false, "error" => "File size must be less than 2MB"]);
            exit;
        }
        
        // Validate file type
        if (!preg_match('/image\/(jpg|jpeg|png|gif)/', $fileType)) {
            echo json_encode(["success" => false, "error" => "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed."]);
            exit;
        }
        
        // Generate a new filename and set the upload path
        $newFileName = uniqid('event_', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
        $uploadPath = 'uploads/events/' . $newFileName;
        
        // Move the file to the upload directory
        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            $imagePath = $uploadPath;
        } else {
            echo json_encode(["success" => false, "error" => "Error moving the uploaded file"]);
            exit;
        }
    }

    $sql = "INSERT INTO events (title, start_date, end_date, color, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        echo json_encode(["success" => false, "error" => "Prepare failed: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("sssss", $title, $start_date, $end_date, $color, $imagePath);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Event added successfully"]);
    } else {
        error_log("Execute failed: " . $stmt->error);
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCAI Events Management | Cavite Community Academy, Inc.</title>
    <link rel="shortcut icon" href="../ccai-logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
        .upload-section {
            padding: 2rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
        }
        
        .upload-container {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            animation: containerFadeIn 0.8s ease-out;
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

        .button-container {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 25px;
        }

        .btn-back {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: bold;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            width: auto;
            min-width: 150px;
        }

        /* Add these notification styles */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            background-color: #4CAF50;
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transform: translateX(200%);
            transition: transform 0.3s ease;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification i {
            font-size: 20px;
        }
    </style>
</head>
<script type="text/javascript">
        // Prevent back button
        window.onload = function() {
            noBack();
        }
        window.onpageshow = function(evt) {
            if (evt.persisted) {
                noBack();
            }
        }
        window.onunload = function() {
            void(0);
        }
    </script>
    <script type="text/javascript">
        // Prevent back button
        window.onload = function() {
            noBack();
        }
        window.onpageshow = function(evt) {
            if (evt.persisted) {
                noBack();
            }
        }
        window.onunload = function() {
            void(0);
        }
    </script>
<body>
    <div class="admin-container">
        <div class="page-header">
            <h1 class="text-center mb-3"><i class="fas fa-calendar-plus me-2"></i>Event Management System</h1>
            <img src="ccai-logo.png" alt="CCAI Logo" class="header-logo">
        </div>

        <section class="upload-section">
            <div class="upload-container">
                <form id="eventForm" class="mt-4">
                    <div class="mb-3">
                        <label for="title" class="form-label">Event Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date (Optional)</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Event Color</label>
                        <input type="color" class="form-control" id="color" name="color" value="#3788d8">
                    </div>
                    <div class="mb-3">
                        <label for="event_image" class="form-label">Event Image</label>
                        <input type="file" class="form-control" id="event_image" name="event_image" accept="image/*">
                        <div class="form-text">Recommended size: 800x600 pixels. Max size: 2MB</div>
                    </div>
                    <!-- Preview container -->
                    <div class="mb-3">
                        <img id="imagePreview" src="#" alt="Preview" style="max-width: 300px; display: none;" class="img-thumbnail">
                    </div>
                    <div class="button-container">
                        <a href="superadmin.php" class="btn btn-back">
                            <i class="fas fa-arrow-left"></i> Back to Admin
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Event
                        </button>
                    </div>
                </form>

                <!-- Add Events Table -->
                <div class="table-responsive mt-5">
                    <h3 class="text-center mb-4" style="color: #000080;">Recent Events</h3>
                    <table class="table table-hover">
                        <thead style="background-color: #000080; color: white;">
                            <tr>
                                <th>Event Title</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM events ORDER BY start_date DESC";
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $endDate = $row['end_date'] ? $row['end_date'] : 'N/A';
                                    $imagePath = $row['image'] ? $row['image'] : 'uploads/default-event.png';
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                    echo "<td>" . $row['start_date'] . "</td>";
                                    echo "<td>" . $endDate . "</td>";
                                    echo "<td><img src='" . $imagePath . "' alt='Event Image' style='max-width: 100px;'></td>";
                                    echo "<td>
                                            <button onclick=\"deleteEvent(" . $row['id'] . ")\" class=\"btn btn-danger btn-sm\">
                                                <i class=\"fas fa-trash\"></i> Delete
                                            </button>
                                        </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No events found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i>
        <span>Event added successfully!</span>
    </div>

    <script>
    function showNotification() {
        const notification = document.getElementById('notification');
        notification.classList.add('show');
        setTimeout(() => {
            notification.classList.remove('show');
        }, 3000);
    }

    document.getElementById('eventForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        let formData = new FormData(this);
        
        fetch('upload_event1.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification();
                this.reset();
                setTimeout(() => {
                    location.reload(); // Reload after notification
                }, 2000);
            } else {
                alert('Error adding event: ' + (data.error || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error adding event');
        });
    });

    document.getElementById('event_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('imagePreview');
        
        if (file) {
            // Check file size (2MB limit)
            if (file.size > 2 * 1024 * 1024) {
                alert('File size must be less than 2MB');
                this.value = '';
                preview.style.display = 'none';
                return;
            }

            // Check file type
            if (!file.type.match('image.*')) {
                alert('Only image files are allowed');
                this.value = '';
                preview.style.display = 'none';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    function deleteEvent(eventId) {
        if (confirm('Are you sure you want to delete this event?')) {
            fetch('delete_event1.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + eventId
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error deleting event');
                    console.error('Error:', error);
                }
            })
            .catch(error => {
                alert('Error deleting event');
                console.error('Error:', error);
            });
        }
    }
    </script>
</body>
</html>
