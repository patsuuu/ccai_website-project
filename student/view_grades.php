<?php
session_start();
include '../config.php';

// Check if user is logged in
if (!isset($_SESSION['student_id'])) {
    header('Location: login.php');
    exit;
}

// Get student's current grade level and strand
$level_query = "SELECT s.student_id, sec.level as current_level, sec.name as section_name, 
                l.name as level_name, 
                CASE
                    WHEN l.level_id IN (13,14) THEN 'STEM'
                    WHEN l.level_id IN (5,6) THEN 'ABM'
                    WHEN l.level_id IN (9,10) THEN 'HUMSS'
                    WHEN l.level_id IN (11,12) THEN 'ICT'
                    WHEN l.level_id IN (7,8) THEN 'HE'
                    ELSE NULL
                END as student_strand
                FROM students s
                JOIN section sec ON s.section = sec.`section-id`
                JOIN level l ON sec.level = l.level_id
                WHERE s.student_id = ?";
$stmt = $conn->prepare($level_query);
$stmt->bind_param("i", $_SESSION['student_id']);
$stmt->execute();
$student_info = $stmt->get_result()->fetch_assoc();

// Get all available grade levels up to current level
$available_levels = [];
$levels_query = "SELECT l.level_id, l.name 
                 FROM level l 
                 WHERE l.level_id <= ? AND l.level_id >= 1
                 AND (
                    l.level_id <= 4 
                    OR (
                        CASE 
                            WHEN ? = 'STEM' AND l.level_id IN (13,14) THEN 1
                            WHEN ? = 'ABM' AND l.level_id IN (5,6) THEN 1
                            WHEN ? = 'HUMSS' AND l.level_id IN (9,10) THEN 1
                            WHEN ? = 'ICT' AND l.level_id IN (11,12) THEN 1
                            WHEN ? = 'HE' AND l.level_id IN (7,8) THEN 1
                            WHEN ? IS NULL THEN 1
                            ELSE 0
                        END
                    )
                 )
                 ORDER BY l.level_id DESC";
$stmt = $conn->prepare($levels_query);
$stmt->bind_param("issssss", 
    $student_info['current_level'],
    $student_info['student_strand'],
    $student_info['student_strand'],
    $student_info['student_strand'],
    $student_info['student_strand'],
    $student_info['student_strand'],
    $student_info['student_strand']
);
$stmt->execute();
$levels_result = $stmt->get_result();
while($row = $levels_result->fetch_assoc()) {
    $available_levels[$row['level_id']] = $row['name'];
}

// Get selected level (default to current level)
$selected_level = isset($_GET['level']) ? (int)$_GET['level'] : $student_info['current_level'];

// Modify subject query to filter based on strand
$query = "SELECT sub.subject_id, sub.subject_name,
          g.grade, g.quarter, s.lrn, s.first_name, s.last_name, s.middle_name
          FROM subject sub
          LEFT JOIN grades g ON sub.subject_id = g.subject AND g.student = ? AND g.level = ?
          LEFT JOIN students s ON s.student_id = ?
          WHERE sub.year_level = ? AND (
              sub.year_level <= 4 
              OR (
                CASE 
                    WHEN ? = 'STEM' AND sub.year_level IN (13,14) THEN 1
                    WHEN ? = 'ABM' AND sub.year_level IN (5,6) THEN 1
                    WHEN ? = 'HUMSS' AND sub.year_level IN (9,10) THEN 1
                    WHEN ? = 'ICT' AND sub.year_level IN (11,12) THEN 1
                    WHEN ? = 'HE' AND sub.year_level IN (7,8) THEN 1
                    WHEN ? IS NULL THEN 1
                    ELSE 0
                END
              )
          )
          ORDER BY sub.subject_name, g.quarter";

$stmt = $conn->prepare($query);
$stmt->bind_param("iiiissssss", 
    $_SESSION['student_id'], 
    $selected_level,
    $_SESSION['student_id'], 
    $selected_level,
    $student_info['student_strand'],
    $student_info['student_strand'],
    $student_info['student_strand'],
    $student_info['student_strand'],
    $student_info['student_strand'],
    $student_info['student_strand']
);
$stmt->execute();
$result = $stmt->get_result();

$students = [];
$student_set = false;

while ($row = $result->fetch_assoc()) {
    if (!$student_set) {
        $students[$row['lrn']] = [
            'info' => [
                'name' => $row['last_name'] . ', ' . $row['first_name'] . ' ' . $row['middle_name'],
                'section' => $student_info['section_name'],
                'level' => $student_info['level_name']
            ],
            'grades' => []
        ];
        $student_set = true;
    }
    
    $subject_name = $row['subject_name'];
    // Check if subject is part of MAPEH
    if (in_array($subject_name, ['Music', 'Arts', 'Physical Education', 'Health'])) {
        // Create MAPEH group if not exists
        if (!isset($students[$row['lrn']]['grades']['MAPEH'])) {
            $students[$row['lrn']]['grades']['MAPEH'] = [
                'isGroup' => true,
                'components' => [],
                '1st' => '-',
                '2nd' => '-',
                '3rd' => '-',
                '4th' => '-',
                'Finals' => '-'
            ];
        }
        // Add component subject
        if (!isset($students[$row['lrn']]['grades']['MAPEH']['components'][$subject_name])) {
            $students[$row['lrn']]['grades']['MAPEH']['components'][$subject_name] = [
                '1st' => '-',
                '2nd' => '-',
                '3rd' => '-',
                '4th' => '-',
                'Finals' => '-'
            ];
        }
        // Add grade if it exists
        if ($row['quarter']) {
            $students[$row['lrn']]['grades']['MAPEH']['components'][$subject_name][$row['quarter']] = $row['grade'];
            // Calculate average for MAPEH
            $mapeh_components = $students[$row['lrn']]['grades']['MAPEH']['components'];
            $quarter_sum = 0;
            $count = 0;
            foreach ($mapeh_components as $component) {
                if ($component[$row['quarter']] !== '-') {
                    $quarter_sum += $component[$row['quarter']];
                    $count++;
                }
            }
            if ($count > 0) {
                $students[$row['lrn']]['grades']['MAPEH'][$row['quarter']] = round($quarter_sum / $count);
            }
        }
    } else {
        // Handle non-MAPEH subjects as before
        if (!isset($students[$row['lrn']]['grades'][$subject_name])) {
            $students[$row['lrn']]['grades'][$subject_name] = [
                'isGroup' => false,
                '1st' => '-',
                '2nd' => '-',
                '3rd' => '-',
                '4th' => '-',
                'Finals' => '-'
            ];
        }
        if ($row['quarter']) {
            $students[$row['lrn']]['grades'][$subject_name][$row['quarter']] = $row['grade'];
        }
    }
}

// Define subject order for grades 7-10
$subject_order = [
    'Filipino',
    'English',
    'Mathematics',
    'Science',
    'Araling Panlipunan',
    'TLE',
    'MAPEH',
    'Values Education',
    'Computer',
    'Journalism'
];

// Function to get subject order position
function getSubjectOrder($subject, $subject_order) {
    $pos = array_search($subject, $subject_order);
    return $pos === false ? count($subject_order) : $pos;
}

// Sort the grades array based on custom order for grades 7-10
foreach ($students as &$student) {
    if ($selected_level >= 1 && $selected_level <= 4) {
        uksort($student['grades'], function($a, $b) use ($subject_order) {
            return getSubjectOrder($a, $subject_order) - getSubjectOrder($b, $subject_order);
        });
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grades History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="../assets/ccai-logo.png">

    <style>
        :root {
            --transition-speed: 0.2s;
        }
        
        /* Shared styles */
        .text-pass { color: #198754 !important; }
        .text-fail { color: #dc3545 !important; }
        .text-neutral { color: #6c757d !important; }
        
        /* Card Styles */
        .grade-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 0.75rem;
            padding: 1.25rem;
            background: white;
            transition: transform var(--transition-speed);
        }
        
        .grade-card:hover {
            transform: translateX(4px);
        }
        
        .grade-card .subject-name {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #333;
            font-size: 1.1rem;
        }
        
        .grades-wrapper {
            display: flex;
            justify-content: space-between;
            gap: 0.75rem;
        }
        
        .quarter-grade {
            flex: 1;
            text-align: center;
            padding: 0.75rem 0.5rem;
            border-radius: 6px;
            background: #f8f9fa;
            transition: transform var(--transition-speed);
        }
        
        .quarter-grade:hover {
            transform: scale(1.05);
        }
        
        .quarter-grade .label {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }
        
        .quarter-grade .value {
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        .final-grade {
            background: #e7f0ff;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .grade-card {
                padding: 1rem;
                margin-bottom: 0.5rem;
            }
            
            .quarter-grade {
                padding: 0.5rem;
            }
            
            .quarter-grade .value {
                font-size: 1rem;
            }
            
            .quarter-grade .label {
                font-size: 0.75rem;
            }
        }
        
        @media (min-width: 769px) {
            .container-fluid {
                max-width: 1200px;
                margin: 0 auto;
            }
            
            .student-info {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1.5rem;
            }
        }
        
        .nav-pills .nav-link.active {
            background-color: #0d6efd;
        }
        .student-info {
            background-color: #f8f9fa;
            /* border-radius: 8px; */
            padding: 20px;
            margin-bottom: 20px;
        }
        .table-responsive {
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .grade-badge {
            font-size: 1rem;
            min-width: 45px;
            background-color: transparent !important;
        }
        .text-pass {
            color: #198754 !important;
        }
        .text-fail {
            color: #dc3545 !important;
        }
        .text-neutral {
            color: #6c757d !important;
        }
        .table-responsive::-webkit-scrollbar {
            height: 6px;
        }
        .table-responsive::-webkit-scrollbar-thumb {
            background-color: #dee2e6;
            border-radius: 3px;
        }
        
        /* Level Selector Styles */
        .level-selector-wrapper {
            margin-bottom: 0;
            padding: 1.25rem;
            background: white;
            border-bottom: 1px solid #dee2e6;
        }
        
        .level-selector {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 0.75rem;
            align-items: stretch;
        }
        
        .school-year {
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #dee2e6;
        }
        
        .level-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            color: #495057;
            text-decoration: none;
            font-weight: 500;
            transition: all var(--transition-speed);
            position: relative;
            background: #f8f9fa;
            text-align: center;
            height: 100%;
        }
        
        .level-btn:hover {
            border-color: #0d6efd;
            color: #0d6efd;
            transform: translateY(-2px);
        }
        
        .level-btn.active {
            background: #0d6efd;
            color: white;
            border-color: #0d6efd;
        }
        
        .level-btn.current::after {
            content: 'Current';
            position: absolute;
            top: -0.5rem;
            right: -0.5rem;
            background: #198754;
            color: white;
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            border-radius: 1rem;
        }
        
        @media (max-width: 768px) {
            .level-selector-wrapper {
                padding: 1rem;
            }
            
            .level-selector {
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
                gap: 0.5rem;
            }
            
            .level-btn {
                padding: 0.75rem;
                font-size: 0.9rem;
            }
        }

        /* Student Info Container */
        .student-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }
        
        .student-info {
            background-color: #f8f9fa;
            padding: 1.75rem 1.25rem;  /* increased padding */
            margin-bottom: 0;
            border-bottom: 1px solid #dee2e6;
        }

        .student-info .row {
            margin: 0;  /* remove default row margin */
        }

        .grades-view {
            padding: 1.25rem;
        }

        @media (max-width: 768px) {
            .student-info {
                padding: 1.5rem 1rem;  /* increased padding for mobile */
            }
            .grades-view {
                padding: 1rem;
            }
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid px-3">
            <a class="navbar-brand" href="../index.php">
                <i class="bi bi-mortarboard-fill me-2"></i>
                <span class="d-none d-sm-inline">Student Portal</span>
            </a>
            
            <div class="ms-auto">
                <a href="logout.php" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-box-arrow-right me-1"></i>
                    <span class="d-none d-sm-inline">Logout</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid container-md py-3 py-md-4">
        <h1 class="h4 text-center mb-4">
            <i class="bi bi-person-circle me-2"></i>
            <?php echo htmlspecialchars($_SESSION['name']); ?>'s Grade History
        </h1>

        <!-- Student Info and Grades -->
        <?php foreach($students as $lrn => $data): ?>
            <div class="student-container">
                <div class="student-info">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <h5 class="card-title mb-2">
                                <i class="bi bi-person me-1"></i>
                                <?php echo htmlspecialchars($data['info']['name']); ?>
                            </h5>
                            <p class="mb-2 small">
                                <i class="bi bi-card-heading me-1"></i>
                                LRN: <?php echo htmlspecialchars($lrn); ?>
                            </p>
                        </div>
                        <div class="col-12 col-md-6">
                            <p class="mb-1 small">
                                <i class="bi bi-people me-1"></i>
                                Section: <?php echo htmlspecialchars($data['info']['section']); ?>
                            </p>
                            <p class="mb-1 small">
                                <i class="bi bi-layers me-1"></i>
                                Grade Level: <?php echo htmlspecialchars($data['info']['level']); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Level Selector -->
                <div class="level-selector-wrapper">
                    <!-- <div class="school-year">
                        School Year <?php echo date('Y') - 1 . ' - ' . date('Y'); ?>
                    </div> -->
                    <div class="level-selector">    
                        <?php foreach($available_levels as $level_id => $level_name): ?>
                        <a href="?level=<?php echo $level_id; ?>" 
                           class="level-btn <?php 
                               echo ($selected_level == $level_id) ? 'active ' : '';
                               echo ($level_id == $student_info['current_level']) ? 'current' : '';
                           ?>">
                            <?php echo htmlspecialchars($level_name); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="grades-view">
                    <?php foreach($data['grades'] as $subject => $grades): ?>
                    <div class="grade-card">
                        <div class="subject-name"><?php echo htmlspecialchars($subject); ?></div>
                        <div class="grades-wrapper">
                            <?php 
                            foreach(['1st', '2nd', '3rd', '4th'] as $quarter) {
                                $grade = $grades[$quarter];
                                $textClass = $grade == '-' ? 'text-neutral' : 
                                    ($grade >= 75 ? 'text-pass' : 'text-fail');
                            ?>
                            <div class="quarter-grade">
                                <div class="label"><?php echo $quarter; ?></div>
                                <div class="value <?php echo $textClass; ?>">
                                    <?php echo htmlspecialchars($grade); ?>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="quarter-grade final-grade">
                                <div class="label">Final</div>
                                <div class="value text-primary">
                                    <?php echo htmlspecialchars($grades['Finals']); ?>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($grades['isGroup']) && $grades['isGroup']): ?>
                            <div class="components-wrapper mt-3">
                                <?php 
                                // Define MAPEH order
                                $mapeh_order = ['Music', 'Arts', 'Physical Education', 'Health'];
                                // Sort components according to MAPEH order
                                $ordered_components = [];
                                foreach($mapeh_order as $subject) {
                                    if(isset($grades['components'][$subject])) {
                                        $ordered_components[$subject] = $grades['components'][$subject];
                                    }
                                }
                                foreach($ordered_components as $component => $componentGrades): 
                                ?>
                                    <div class="mb-2">
                                        <div class="subject-name small"><?php echo htmlspecialchars($component); ?></div>
                                        <div class="grades-wrapper">
                                            <?php 
                                            foreach(['1st', '2nd', '3rd', '4th'] as $quarter) {
                                                $grade = $componentGrades[$quarter];
                                                $textClass = $grade == '-' ? 'text-neutral' : 
                                                    ($grade >= 75 ? 'text-pass' : 'text-fail');
                                            ?>
                                            <div class="quarter-grade">
                                                <div class="label small"><?php echo $quarter; ?></div>
                                                <div class="value small <?php echo $textClass; ?>">
                                                    <?php echo htmlspecialchars($grade); ?>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="quarter-grade final-grade">
                                                <div class="label small">Final</div>
                                                <div class="value small text-primary">
                                                    <?php echo htmlspecialchars($componentGrades['Finals']); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
