<?php
header('Content-Type: application/json');
require '../includes/db.php';

try {
    $query = $conn->query("SELECT id, name, color_code, icon FROM event_categories ORDER BY name");
    if (!$query) {
        throw new Exception($conn->error);
    }
    $categories = $query->fetch_all(MYSQLI_ASSOC);
    echo json_encode($categories);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
