<?php
session_start();

if (!isset($_SESSION['HostID'])) {
    echo json_encode([]);
    exit();
}

$HostID = $_SESSION['HostID'];

$conn = new mysqli("localhost", "root", "", "eventy");
if ($conn->connect_error) {
    echo json_encode([]);
    exit();
}

// GET search text
$search = isset($_GET['search']) ? trim($_GET['search']) : "";

// GET filter status
// "" = no filter, "1" = upcoming, "0" = finished
$statusFilter = isset($_GET['status']) ? $_GET['status'] : "";

// Base query
$sql = "SELECT * FROM events WHERE HostID = ?";
$params = [$HostID];
$types = "i";

// Apply search
if ($search !== "") {
    $sql .= " AND name LIKE ?";
    $params[] = "%$search%";
    $types .= "s";
}

// Apply status filter
if ($statusFilter === "0" || $statusFilter === "1") { 
    $sql .= " AND status = ?";
    $params[] = $statusFilter;
    $types .= "i";
}

$sql .= " ORDER BY event_date ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$events = [];

while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

echo json_encode($events);
?>
