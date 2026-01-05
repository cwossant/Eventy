<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['HostID'])) {
    echo json_encode(['darkmode' => 0]);
    exit();
}

$HostID = $_SESSION['HostID'];
$stmt = $conn->prepare("SELECT darkmode FROM users WHERE HostID = ?");
$stmt->bind_param("i", $HostID);
$stmt->execute();
$stmt->bind_result($darkmode);
$stmt->fetch();
$stmt->close();

echo json_encode(['darkmode' => (int)($darkmode ?? 0)]);
?>