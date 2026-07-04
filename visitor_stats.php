<?php
// Database connection
$conn = new mysqli('sql108.infinityfree.com', 'if0_38418315', 'hMnz6Kmq5YaMB', 'if0_38418315_ccai_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if not exists
$sql = "CREATE TABLE IF NOT EXISTS visitor_stats (
    visit_date DATE PRIMARY KEY,
    visitor_count INT DEFAULT 0
)";
$conn->query($sql);

// Get the requested period
$period = $_GET['period'] ?? 'month';

// Record visit
$today = date('Y-m-d');
$sql = "INSERT INTO visitor_stats (visit_date, visitor_count) 
        VALUES (?, 1)
        ON DUPLICATE KEY UPDATE visitor_count = visitor_count + 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $today);
$stmt->execute();

// Get period data
switch ($period) {
    case 'week':
        $interval = '7 DAY';
        break;
    case 'year':
        $interval = '1 YEAR';
        break;
    default:
        $interval = '30 DAY';
}

$sql = "SELECT visit_date, visitor_count 
        FROM visitor_stats 
        WHERE visit_date >= DATE_SUB(CURDATE(), INTERVAL $interval)
        ORDER BY visit_date ASC";

$result = $conn->query($sql);
$data = array(
    'dates' => array(),
    'counts' => array()
);

while ($row = $result->fetch_assoc()) {
    $data['dates'][] = date('M d', strtotime($row['visit_date']));
    $data['counts'][] = (int)$row['visitor_count'];
}

// Get today's visitors
$sql = "SELECT visitor_count FROM visitor_stats WHERE visit_date = CURDATE()";
$result = $conn->query($sql);
$today_count = $result->fetch_assoc()['visitor_count'] ?? 0;

// Get total visitors
$sql = "SELECT SUM(visitor_count) as total FROM visitor_stats";
$result = $conn->query($sql);
$total_count = $result->fetch_assoc()['total'] ?? 0;

$response = array(
    'dates' => $data['dates'],
    'counts' => $data['counts'],
    'today' => $today_count,
    'total' => $total_count
);

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
