<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['HostID'])) {
    header("Location: ../index.php");
    exit();
}

$id = $_POST['id'] ?? null;
$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$capacity = $_POST['capacity'] ?? null;
$event_date = $_POST['event_date'] ?? null;
$event_time = $_POST['event_time'] ?? null;
$location = $_POST['location'] ?? '';
$status = $_POST['status'] ?? null;

if (!$id) {
    echo "Invalid ID";
    exit();
}

$stmt = $conn->prepare("UPDATE events SET name=?, description=?, capacity=?, event_date=?, event_time=?, location=?, status=? WHERE id=?");
$stmt->bind_param("ssissssi",
    $name, $description, $capacity, $event_date, $event_time, $location, $status, $id);

if ($stmt->execute()) {
    echo "<script>\nalert('Event updated successfully!');\nwindow.location.href = '../Mainboard.php';\n</script>";
} else {
    echo "Error updating event: " . $conn->error;
}

$stmt->close();
$conn->close();
?>