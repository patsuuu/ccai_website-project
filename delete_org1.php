<?php
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    try {
        // Get the organization image path before deletion
        $stmt = $pdo->prepare("SELECT image_path FROM student_organizations WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        $org = $stmt->fetch();

        // Delete the organization
        $stmt = $pdo->prepare("DELETE FROM student_organizations WHERE id = ?");
        $result = $stmt->execute([$_POST['id']]);

        if ($result) {
            // Delete the image file if it exists
            if ($org && $org['image_path'] && file_exists($org['image_path'])) {
                unlink($org['image_path']);
            }
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Failed to delete organization"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request"]);
}
