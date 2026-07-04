<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once('../config/db_config.php');
$conn = getDBConnection();

$sql = "SELECT * FROM news_posts ORDER BY post_date DESC LIMIT 6";
$result = $conn->query($sql);

$news = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $news[] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'description' => substr(strip_tags($row['description']), 0, 500000) . '',
            'image_path' => $row['image_path'],
            'post_date' => $row['post_date']
        ];
    }
}

echo json_encode($news);
$conn->close();
