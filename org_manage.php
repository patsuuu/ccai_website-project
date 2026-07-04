<?php
            require_once('db.php');

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    // Handle image upload
                    $image_path = '';
                    if(isset($_FILES['org_image']) && $_FILES['org_image']['error'] === 0) {
                        $upload_dir = 'org_images/';
                        if (!file_exists($upload_dir)) {
                            mkdir($upload_dir, 0777, true);
                        }
                        $image_path = $upload_dir . time() . '_' . $_FILES['org_image']['name'];
                        move_uploaded_file($_FILES['org_image']['tmp_name'], $image_path);
                    }

                    $stmt = $pdo->prepare("INSERT INTO student_organizations 
                        (name, description, category_tags, member_count, members_data, image_path) 
                        VALUES (?, ?, ?, ?, ?, ?)");
                    
                    // Validate and sanitize input
                    $org_name = filter_var($_POST['org_name'], FILTER_SANITIZE_STRING);
                    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
                    $member_count = filter_var($_POST['member_count'], FILTER_VALIDATE_INT);
                    
                    $membersData = json_encode(array_map(function($member) {
                        return [
                            'name' => filter_var($member['name'], FILTER_SANITIZE_STRING),
                            'position' => filter_var($member['position'], FILTER_SANITIZE_STRING),
                            'level' => filter_var($member['level'], FILTER_SANITIZE_STRING)
                        ];
                    }, $_POST['members']));
                    
                    $tags = json_encode(array_filter($_POST['tags']));
                    
                    $stmt->execute([
                        $org_name,
                        $description,
                        $tags,
                        $member_count,
                        $membersData,
                        $image_path
                    ]);
                    
                    $message = "Organization added successfully!";
                } catch (PDOException $e) {
                    $error = "Error: " . $e->getMessage();
                }
            }

            // Add delete handler
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
                try {
                    $stmt = $pdo->prepare("DELETE FROM student_organizations WHERE id = ?");
                    $stmt->execute([$_POST['delete_id']]);
                    $message = "Organization deleted successfully!";
                } catch (PDOException $e) {
                    $error = "Error deleting: " . $e->getMessage();
                }
            }

            // Fetch existing organizations
            $orgs = $pdo->query("SELECT * FROM student_organizations ORDER BY name")->fetchAll();
            ?>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>CCAI Student Organization Management | Cavite Community Academy, Inc.</title>
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
                </style>
            </head>
            <body>
                <div class="admin-container">
                    <div class="page-header">
                        <h1 class="text-center mb-3"><i class="fas fa-users me-2"></i>Student Organization Management</h1>
                        <img src="ccai-logo.png" alt="CCAI Logo" class="header-logo">
                    </div>

                    <section class="upload-section">
                        <div class="upload-container">
                            <?php if (isset($message)): ?>
                                <div class="alert alert-success alert-dismissible fade show">
                                    <?php echo $message; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger alert-dismissible fade show"><?php echo $error; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>
                            
                            <form method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                                <div class="mb-3">
                                    <label for="org_image" class="form-label">Organization Image</label>
                                    <input type="file" class="form-control" id="org_image" name="org_image" accept="image/*" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="org_name" class="form-label">Organization Name</label>
                                    <input type="text" class="form-control" id="org_name" name="org_name" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="member_count" class="form-label">Member Count</label>
                                    <input type="number" class="form-control" id="member_count" name="member_count" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Tags</label>
                                    <div id="tagsContainer">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="tags[]" placeholder="Tag" required>
                                            <button type="button" class="btn btn-outline-secondary" onclick="addTagField()">+</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="membersContainer" class="mb-3">
                                    <h4>Members</h4>
                                    <div class="member-entry mb-3">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control" name="members[0][name]" placeholder="Name" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="members[0][position]" placeholder="Position" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="members[0][level]" placeholder="Grade Level" required>
                                            </div>
                                            <div class="col-auto">
                                                <span class="member-delete-btn" onclick="this.parentElement.parentElement.parentElement.remove()">✕</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3 mb-4">
                                    <button type="button" class="btn btn-secondary" onclick="addMemberField()">
                                        <i class="fas fa-plus"></i> Add Member
                                    </button>
                                </div>
                                
                                <div class="mt-4 button-container">
                                    <a href="admin.php" class="btn btn-back">
                                        <i class="fas fa-arrow-left"></i> Back to Admin
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add Organization
                                    </button>
                                </div>
                            </form>

                            <div class="table-responsive mt-5">
                                <h3 class="text-center mb-4" style="color: #000080;">Student Organizations</h3>
                                <table class="table table-hover">
                                    <thead style="background-color: #000080; color: white;">
                                        <tr>
                                            <th>Name</th>
                                            <th>Members</th>
                                            <th>Tags</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($orgs)): ?>
                                            <tr>
                                                <td colspan="4" class="text-center py-4">
                                                    <i class="fas fa-info-circle me-2"></i>
                                                    No student organizations available
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach($orgs as $org): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($org['name']); ?></td>
                                                    <td><?php echo $org['member_count']; ?></td>
                                                    <td>
                                                        <?php foreach(json_decode($org['category_tags']) as $tag): ?>
                                                            <span class="badge bg-secondary"><?php echo htmlspecialchars($tag); ?></span>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td>
                                                        <button onclick="deleteOrganization(<?php echo $org['id']; ?>)" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="notification" id="notification">
                    <i class="fas fa-check-circle"></i>
                    <span>Organization added successfully!</span>
                </div>

                <script>
                    let memberCount = 1;
                    let tagCount = 1;
                    
                    function addMemberField() {
                        const container = document.getElementById('membersContainer');
                        const newEntry = document.createElement('div');
                        newEntry.className = 'member-entry mb-3';
                        newEntry.innerHTML = `
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" name="members[${memberCount}][name]" placeholder="Name" required>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="members[${memberCount}][position]" placeholder="Position" required>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="members[${memberCount}][level]" placeholder="Grade Level" required>
                                </div>
                                <div class="col-auto">
                                    <span class="member-delete-btn" onclick="this.parentElement.parentElement.parentElement.remove()">✕</span>
                                </div>
                            </div>
                        `;
                        container.appendChild(newEntry);
                        memberCount++;
                    }

                    function addTagField() {
                        const container = document.getElementById('tagsContainer');
                        const newEntry = document.createElement('div');
                        newEntry.className = 'input-group mb-2';
                        newEntry.innerHTML = `
                            <input type="text" class="form-control" name="tags[]" placeholder="Tag">
                            <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">✕</button>
                        `;
                        container.appendChild(newEntry);
                        tagCount++;
                    }

                    function deleteOrganization(orgId) {
                        if (confirm('Are you sure you want to delete this organization?')) {
                            fetch('delete_org.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                },
                                body: 'id=' + orgId
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Show success message
                                    const notification = document.getElementById('notification');
                                    notification.querySelector('span').textContent = 'Organization deleted successfully!';
                                    notification.classList.add('show');
                                    setTimeout(() => {
                                        notification.classList.remove('show');
                                        location.reload(); // Reload after notification
                                    }, 2000);
                                } else {
                                    alert('Error deleting organization: ' + (data.error || 'Unknown error'));
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Error deleting organization');
                            });
                        }
                    }

                    // Form validation
                    (() => {
                        'use strict'
                        const forms = document.querySelectorAll('.needs-validation')
                        Array.from(forms).forEach(form => {
                            form.addEventListener('submit', event => {
                                if (!form.checkValidity()) {
                                    event.preventDefault()
                                    event.stopPropagation()
                                }
                                form.classList.add('was-validated')
                            }, false)
                        })
                    })()
                </script>
            </body>
            </html>
