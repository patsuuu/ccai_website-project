<?php 
require_once('db_connect.php');

// Add error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize year variables
$currentYear = date('Y');
$nextYear = $currentYear + 1;
$selectedYear = isset($_GET['school_year']) ? $_GET['school_year'] : "Start Year - End Year";

// Add success message handling
$success_message = '';
if (isset($_GET['success']) && $_GET['success'] === 'deleted') {
    $success_message = 'Record deleted successfully!';
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and validate school year from form
    $school_year = isset($_POST['school_year_hidden']) ? $_POST['school_year_hidden'] : '';
    
    if (!empty($school_year) && preg_match('/^\d{4}-\d{4}$/', $school_year)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO student_population (level, grade_level, strand, section, male_count, female_count, school_year) 
                              VALUES (?, ?, ?, ?, ?, ?, ?)");
        
            $stmt->execute([
                $_POST['level'],
                $_POST['grade_level'],
                $_POST['strand'] ?: null,
                $_POST['section'],
                $_POST['male_count'],
                $_POST['female_count'],
                $school_year
            ]);

            header("Location: popul1.php?school_year=" . urlencode($school_year));
            exit;
        } catch(PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    } else {
        $error = "Invalid school year format. Please use YYYY-YYYY format.";
    }
}

// Add query to get all population data ordered by newest first
$populationQuery = $pdo->query("SELECT * FROM student_population ORDER BY created_at DESC");
$populationData = $populationQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student Population | Cavite Community Academy, Inc.</title>
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
        .form-control:focus, .form-select:focus {
            border-color: #000080;
            box-shadow: 0 0 0 0.2rem rgba(0,0,128,0.25);
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
        .btn-primary {
            background-color: #000080;
            border-color: #000080;
        }
        .btn-primary:hover {
            background-color: #000066;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,128,0.3);
        }
        .message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            animation: slideDown 0.5s ease-out;
        }
        .error-message {
            background-color: #f8d7da;
            border-left: 5px solid #dc3545;
            color: #721c24;
        }
        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
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
        .data-section {
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }

        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead th {
            background-color: #000080;
            color: white;
            border: none;
        }

        .btn-danger {
            padding: 5px 10px;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(220, 53, 69, 0.3);
        }

        .success-message {
            background-color: #d4edda;
            border-left: 5px solid #28a745;
            color: #155724;
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
            <h1 class="text-center mb-3"><i class="fas fa-users me-2"></i>Student Population Management</h1>
            <img src="ccai-logo.png" alt="CCAI Logo" class="header-logo">
        </div>

        <?php if (!empty($error)): ?>
            <div class="message error-message">
                <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if ($success_message): ?>
            <div class="message success-message">
                <i class="fas fa-check-circle me-2"></i><?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <div class="form-section">
            <h3 class="mb-4"><i class="fas fa-plus-circle me-2"></i>Add Student Population</h3>
            
            <form method="POST" class="mt-4" onsubmit="return validateForm()">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2></h2>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>School Year (YYYY-YYYY)</label>
                            <div class="input-group">
                                <input type="text" 
                                       class="form-control" 
                                       id="start_year" 
                                       placeholder="Start Year"
                                       pattern="\d{4}"
                                       maxlength="4"
                                       required>
                                <span class="input-group-text">-</span>
                                <input type="text" 
                                       class="form-control" 
                                       id="end_year" 
                                       placeholder="End Year"
                                       pattern="\d{4}"
                                       maxlength="4"
                                       required>
                                <input type="hidden" 
                                       name="school_year_hidden" 
                                       id="school_year_hidden" 
                                       value="<?php echo $selectedYear; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Level</label>
                    <select name="level" class="form-select" required onchange="toggleStrand(this.value)">
                        <option value="JHS">Junior High School</option>
                        <option value="SHS">Senior High School</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Grade Level</label>
                    <select name="grade_level" class="form-select" required>
                        <option value="Grade 7">Grade 7</option>
                        <option value="Grade 8">Grade 8</option>
                        <option value="Grade 9">Grade 9</option>
                        <option value="Grade 10">Grade 10</option>
                        <option value="Grade 11">Grade 11</option>
                        <option value="Grade 12">Grade 12</option>
                    </select>
                </div>

                <div class="mb-3" id="strandDiv" style="display:none;">
                    <label class="form-label">Strand</label>
                    <select name="strand" class="form-select">
                        <option value="">Select Strand</option>
                        <option value="STEM">STEM</option>
                        <option value="ABM">ABM</option>
                        <option value="HUMSS">HUMSS</option>
                        <option value="ICT">ICT</option>
                        <option value="HE">HE</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Section</label>
                    <input type="text" name="section" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Male Count</label>
                        <input type="number" name="male_count" class="form-control" required min="0">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Female Count</label>
                        <input type="number" name="female_count" class="form-control" required min="0">
                    </div>
                </div>

                <div class="text-end mt-4">
                    <a href="superadmin.php?school_year=<?php echo urlencode($selectedYear); ?>" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left me-2"></i>Back to Admin
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Submit
                    </button>
                </div>
            </form>
        </div>

        <div class="data-section mt-5">
            <h3 class="mb-4"><i class="fas fa-list me-2"></i>Population Data</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>School Year</th>
                            <th>Level</th>
                            <th>Grade</th>
                            <th>Strand</th>
                            <th>Section</th>
                            <th>Male</th>
                            <th>Female</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($populationData as $data): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($data['school_year']); ?></td>
                                <td><?php echo htmlspecialchars($data['level']); ?></td>
                                <td><?php echo htmlspecialchars($data['grade_level']); ?></td>
                                <td><?php echo htmlspecialchars($data['strand'] ?? '-'); ?></td>
                                <td><?php echo htmlspecialchars($data['section']); ?></td>
                                <td><?php echo $data['male_count']; ?></td>
                                <td><?php echo $data['female_count']; ?></td>
                                <td><?php echo $data['male_count'] + $data['female_count']; ?></td>
                                <td>
                                    <button class="btn btn-danger btn-sm" 
                                            onclick="confirmDelete(<?php echo $data['id']; ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    function validateForm() {
        const startYear = document.getElementById('start_year').value;
        const endYear = document.getElementById('end_year').value;
        const hiddenField = document.getElementById('school_year_hidden');
        
        if (!/^\d{4}$/.test(startYear) || !/^\d{4}$/.test(endYear)) {
            alert('Please enter valid years in YYYY format');
            return false;
        }
        
        if (parseInt(endYear) !== parseInt(startYear) + 1) {
            alert('End year must be the next year after start year');
            return false;
        }

        hiddenField.value = startYear + '-' + endYear;
        return true;
    }

    // Update end year automatically
    document.getElementById('start_year').addEventListener('input', function(e) {
        if (this.value.length === 4 && /^\d{4}$/.test(this.value)) {
            const startYear = parseInt(this.value);
            document.getElementById('end_year').value = (startYear + 1).toString();
        }
    });

    // Add delete confirmation function
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this record?')) {
            window.location.href = 'delete_population1.php?id=' + id + '&success=deleted';
        }
    }
    </script>
</body>
</html>
