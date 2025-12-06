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

    // Retrieve form values
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $capacity = $_POST['capacity'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $location = $_POST['location'];

    // Update events table
    $query = $conn->prepare("
        UPDATE events SET name = ?, description = ?, capacity = ?, event_date = ?, event_time = ?, location = ?
        WHERE id = ? AND HostID = ?
    ");

    $query->bind_param(
        "ssisssii",
        $name,
        $description,
        $capacity,
        $event_date,
        $event_time,
        $location,
        $id,
        $HostID
    );

    if ($query->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Event updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $query->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
