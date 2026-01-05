<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['HostID'])) {
    die(json_encode(["error" => "Not logged in"]));
}

$HostID = $_SESSION['HostID'];

$query = $conn->prepare("SELECT * FROM events WHERE HostID = ?");
$query->bind_param("i", $HostID);
$query->execute();
$result = $query->get_result();

$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

echo json_encode($events);
?>