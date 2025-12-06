<?php
error_reporting(0);
session_start();

// Check if not logged in
if (!isset($_SESSION['HostID'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit();
}

$HostID = $_SESSION['HostID'];

// Database connection
$conn = new mysqli("localhost", "root", "", "eventy");

// Check connection
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get JSON input
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (!isset($data['id']) || !is_numeric($data['id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid Event ID.']);
        exit();
    }

    $eventId = intval($data['id']);

    // Delete events table
    $query = $conn->prepare("DELETE FROM events WHERE id = ? AND HostID = ?");

    $query->bind_param("ii", $eventId, $HostID);

    if ($query->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Event deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $query->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
