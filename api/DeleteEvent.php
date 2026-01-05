<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['HostID'])) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid Event ID.");
}

$eventId = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
$stmt->bind_param("i", $eventId);

if ($stmt->execute()) {
    echo "<script>\nalert('Event deleted successfully.');\nwindow.location.href = '../Mainboard.php';\n</script>";
} else {
    echo "Error deleting event: " . $conn->error;
}

$stmt->close();
$conn->close();
?>