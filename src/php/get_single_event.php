<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['HostID'])) {
    echo json_encode(["error" => "Not logged in"]);
    exit();
}

$HostID = $_SESSION['HostID'];

$conn = new mysqli("localhost", "root", "", "eventy");
if ($conn->connect_error) {
    echo json_encode(["error" => "DB connection failed"]);
    exit();
}

if (!isset($_GET['id'])) {
    echo json_encode(["error" => "Missing ID"]);
    exit();
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM events WHERE id = ? AND HostID = ?");
$stmt->bind_param("ii", $id, $HostID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo json_encode(["error" => "Event not found"]);
    exit();
}

echo json_encode($result->fetch_assoc());
?>
