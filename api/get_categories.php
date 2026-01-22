<?php
header('Content-Type: application/json');
require '../includes/db.php';

try {
    $query = $pdo->query("SELECT id, name, color_code, icon FROM event_categories ORDER BY name");
    $categories = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($categories);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
