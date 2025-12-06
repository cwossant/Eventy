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
    $name = $_POST['name'];
    $description = $_POST['description'];
    $capacity = $_POST['capacity'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $location = $_POST['location'];

    // Insert into events table
    $query = $conn->prepare("
        INSERT INTO events (HostID, name, description, capacity, event_date, event_time, location)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $query->bind_param(
        "ississs",
        $HostID,
        $name,
        $description,
        $capacity,
        $event_date,
        $event_time,
        $location
    );

    if ($query->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Event added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $query->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
