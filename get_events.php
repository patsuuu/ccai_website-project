<?php
include 'connection.php';

$sql = "SELECT id, title, start_date as start, end_date as end, color FROM events";
$result = $conn->query($sql);

$events = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Convert to format FullCalendar expects
        $event = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'start' => $row['start'],
            'end' => $row['end'],
            'color' => $row['color']
        );
        array_push($events, $event);
    }
}

echo json_encode($events);
$conn->close();
?>
