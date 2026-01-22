<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['HostID'])) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_GET['id']) && !isset($_POST['id'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid Event ID']);
        exit();
    }
    die("Invalid Event ID.");
}

$eventId = intval($_GET['id'] ?? $_POST['id']);

$stmt = $conn->prepare("DELETE FROM events WHERE id = ? AND HostID = ?");
$stmt->bind_param("ii", $eventId, $_SESSION['HostID']);

if ($stmt->execute()) {
    // For AJAX requests, return JSON
    if (!empty($_POST['id'])) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'Event deleted successfully']);
    } else {
        // For direct GET requests, show alert
        echo "<script>
            alert('Event deleted successfully.');
            window.location.href = '../Mainboard.php';
        </script>";
    }
} else {
    $response = ['status' => 'error', 'message' => 'Error deleting event: ' . $conn->error];
    if (!empty($_POST['id'])) {
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        echo $response['message'];
    }
}

$stmt->close();
$conn->close();
?>