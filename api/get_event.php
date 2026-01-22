<?php
session_start();
header("Content-Type: application/json");
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['HostID'])) {
    echo json_encode(["error" => "Not logged in"]);
    exit();
}

$HostID = $_SESSION['HostID'];

if (!isset($_GET['id'])) {
    echo json_encode(["error" => "Missing ID"]);
    exit();
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT e.*, c.name as category_name FROM events e LEFT JOIN event_categories c ON e.category_id = c.id WHERE e.id = ? AND e.HostID = ?");
$stmt->bind_param("ii", $id, $HostID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo json_encode(["error" => "Event not found"]);
    exit();
}

echo json_encode($result->fetch_assoc());
?>