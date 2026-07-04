<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCAI Form Management | Cavite Community Academy, Inc.</title>
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
        .form-control:focus {
            border-color: #000080;
            box-shadow: 0 0 0 0.2rem rgba(0,0,128,0.25);
        }
        .btn-primary {
            background-color: #000080;
            border-color: #000080;
        }
        .btn-primary:hover {
            background-color: #000066;
            border-color: #000066;
        }
        .news-table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }
        .table thead th {
            background-color: #000080;
            color: white;
            border: none;
        }
        .message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            animation: slideDown 0.5s ease-out;
        }
        .success-message {
            background-color: #d4edda;
            border-left: 5px solid #28a745;
            color: #155724;
        }
        .error-message {
            background-color: #f8d7da;
            border-left: 5px solid #dc3545;
            color: #721c24;
        }
        .form-section {
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }
        .form-label {
            color: #000080;
            font-weight: 600;
        }
        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .btn {
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .table-responsive {
            margin-top: 30px;
            border-radius: 10px;
            overflow: hidden;
        }
        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        .delete-btn:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        }
        .upload-section {
            padding: 4rem 2rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .upload-container {
            max-width: 800px;
            margin: 0 auto;
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

        .upload-title {
            color: #000080;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
            animation: headShake 2s ease-in-out infinite;
        }

        .drop-zone {
            border: 2px dashed #82C0CC;
            border-radius: 10px;
            padding: 3rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8f9fa;
            position: relative;
            overflow: hidden;
        }

        .drop-zone:hover {
            border-color: #000080;
            background: #e9ecef;
        }

        .drop-zone.dragover {
            background: rgba(130, 192, 204, 0.1);
            border-color: #000080;
        }

        .drop-zone-text {
            color: #666;
            margin-bottom: 1rem;
        }

        .drop-zone-icon {
            font-size: 2.5rem;
            color: #82C0CC;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .drop-zone:hover .drop-zone-icon {
            transform: translateY(-5px);
        }

        .file-list {
            margin-top: 2rem;
            padding: 0;
            list-style: none;
        }

        .file-item {
            display: flex;
            align-items: center;
            padding: 0.5rem;
            margin-bottom: 0.5rem;
            background: #f8f9fa;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .file-item:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }

        .file-icon {
            margin-right: 1rem;
            color: #000080;
        }

        .file-name {
            flex-grow: 1;
            margin-right: 1rem;
        }

        .file-remove {
            color: #dc3545;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-remove:hover {
            color: #c82333;
            transform: scale(1.1);
        }

        .submit-btn {
            margin-top: 2rem;
            width: 100%;
            padding: 1rem;
            font-size: 1.1rem;
            background: #000080;
            border: none;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background: #82C0CC;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .progress {
            display: none;
            margin-top: 1rem;
            height: 10px;
            border-radius: 5px;
        }

        .alert {
            margin-top: 1rem;
            display: none;
        }

        @media (max-width: 768px) {
            .upload-section {
                padding: 2rem 1rem;
            }

            .upload-container {
                padding: 1.5rem;
            }

            .upload-title {
                font-size: 1.5rem;
            }

            .drop-zone {
                padding: 2rem;
            }
        }

        /* Add styles for PDF files table */
        .pdf-files-table {
            margin-top: 2rem;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }

        .table-header {
            background-color: #000080;
            color: white;
            padding: 1rem;
        }

        .pdf-files-table th {
            background: #000080;
            color: white;
            border: none;
            padding: 1rem;
        }

        .pdf-files-table td {
            vertical-align: middle;
            padding: 0.75rem;
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
            <h1 class="text-center mb-3"><i class="fas fa-file-upload me-2"></i>Form Management System</h1>
            <img src="../ccai-logo.png" alt="CCAI Logo" class="header-logo">
        </div>

        <!-- Add PDF Files Table -->
        
    <div class="card shadow">
        <div class="card-header" style="background: #000080 !important; color: white;">
            <h3 class="mb-0"><i class="fa fa-file-pdf me-2"></i>Uploaded Forms</h3>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0"><i class="fa fa-file-pdf me-2"></i>Uploaded Forms</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Form Name</th>
                            <th>Upload Date</th>
                            <th>Size</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once 'includes/functions.php';
                        $forms = getAvailableForms();
                        
                        foreach ($forms as $form) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($form['displayName']) . "</td>";
                            echo "<td>" . date("F d, Y", $form['date']) . "</td>";
                            echo "<td>" . round($form['size'] / 1024, 2) . " KB</td>";
                            echo "<td>
                                    <button onclick=\"deleteFile('" . htmlspecialchars($form['name']) . "')\" 
                                            class=\"btn btn-danger btn-sm\">
                                        <i class=\"fa fa-trash\"></i> Delete
                                    </button>
                                  </td>";
                            echo "</tr>";
                        }
                        
                        if (empty($forms)) {
                            echo '<tr><td colspan="4" class="text-center">No forms are currently available.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="text-end mt-3">
                <a href="admin.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Admin
                </a>
            </div>
        </div>
       
    </div>

        </div>

        <section class="upload-section mt-4">
            <div class="upload-container">
                <h2 class="upload-title">Upload Forms</h2>
                
                <div class="drop-zone" id="dropZone">
                    <i class="fa fa-cloud-upload drop-zone-icon"></i>
                    <p class="drop-zone-text">Drag & Drop PDF files here or click to browse</p>
                    <input type="file" id="fileInput" multiple accept=".pdf" style="display: none">
                    <div class="form-group mt-3">
                        <input type="text" class="form-control" id="formName" placeholder="Enter form name (e.g. Registration Form 2024)">
                    </div>
                </div>

                <ul class="file-list" id="fileList"></ul>

                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated"></div>
                </div>

                <div class="alert alert-success" role="alert"></div>
                <div class="alert alert-danger" role="alert"></div>

                <button type="button" class="btn btn-primary submit-btn" id="submitBtn">
                    <i class="fa fa-upload"></i> Upload Forms
                </button>
            </div>
        </section>
    </div>

    <script>
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const fileList = document.getElementById('fileList');
        const submitBtn = document.getElementById('submitBtn');
        const progress = document.querySelector('.progress');
        const progressBar = document.querySelector('.progress-bar');
        const successAlert = document.querySelector('.alert-success');
        const errorAlert = document.querySelector('.alert-danger');

        let files = [];

        // Handle drag and drop events
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.add('dragover');
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.remove('dragover');
            });
        });

        // Handle dropped files
        dropZone.addEventListener('drop', (e) => {
            const droppedFiles = e.dataTransfer.files;
            handleFiles(droppedFiles);
        });

        // Handle clicked files
        dropZone.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });

        function handleFiles(newFiles) {
            files = [...files, ...Array.from(newFiles)];
            updateFileList();
        }

        function updateFileList() {
            fileList.innerHTML = '';
            files.forEach((file, index) => {
                const li = document.createElement('li');
                li.className = 'file-item';
                li.innerHTML = `
                    <i class="fa fa-file-pdf-o file-icon"></i>
                    <span class="file-name">${file.name}</span>
                    <i class="fa fa-times file-remove" onclick="removeFile(${index})"></i>
                `;
                fileList.appendChild(li);
            });
            submitBtn.style.display = files.length ? 'block' : 'none';
        }

        function removeFile(index) {
            files.splice(index, 1);
            updateFileList();
        }

        submitBtn.addEventListener('click', uploadFiles);

        function uploadFiles() {
            if (!files.length) return;

            const formData = new FormData();
            const formName = document.getElementById('formName').value;
            
            files.forEach(file => {
                formData.append('files[]', file);
            });
            
            if (formName) {
                formData.append('formName', formName);
            }

            progress.style.display = 'flex';
            progressBar.style.width = '0%';
            submitBtn.disabled = true;

            fetch('upload_handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    showAlert(successAlert, 'Files uploaded successfully!');
                    files = [];
                    updateFileList();
                    location.reload(); // Refresh to show new files
                } else {
                    showAlert(errorAlert, data.message || 'Upload failed');
                }
            })
            .catch(error => {
                showAlert(errorAlert, 'An error occurred during upload');
            })
            .finally(() => {
                progress.style.display = 'none';
                submitBtn.disabled = false;
            });
        }

        function showAlert(alert, message) {
            alert.textContent = message;
            alert.style.display = 'block';
            setTimeout(() => {
                alert.style.display = 'none';
            }, 5000);
        }

        // Add delete function
        function deleteFile(filename) {
            if (confirm('Are you sure you want to delete this file?')) {
                fetch('delete_file.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'filename=' + encodeURIComponent(filename)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        location.reload(); // Refresh to update the list
                    } else {
                        showAlert(errorAlert, data.message || 'Delete failed');
                    }
                })
                .catch(error => {
                    showAlert(errorAlert, 'Error deleting file');
                });
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Clear success message after 5 seconds
        setTimeout(function() {
            var successMessage = document.querySelector('.success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 5000);
    </script>
</body>
</html>
