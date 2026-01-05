<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['HostID'])) {
    header("Location: registration.php");
    exit();
}

// Enforce integer HostID from session
$HostID = intval($_SESSION['HostID']);

// Database connection
$conn = new mysqli("localhost", "root", "", "eventy");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Retrieve form values
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $capacity = isset($_POST['capacity']) ? intval($_POST['capacity']) : null;
    $event_date = isset($_POST['event_date']) ? $_POST['event_date'] : null; // YYYY-MM-DD
    $event_time = isset($_POST['event_time']) ? $_POST['event_time'] : null; // HH:MM[:SS]
    $location = isset($_POST['location']) ? trim($_POST['location']) : '';
    $status = isset($_POST['status']) ? intval($_POST['status']) : 1;

    // Validate minimal required inputs
    if ($name === '' || $capacity === null || $event_date === null || $event_time === null || $location === '') {
        http_response_code(400);
        echo "Error: Missing required fields.";
        exit;
    }

    // Ensure HostID exists in users (avoid FK errors)
    $chk = $conn->prepare("SELECT 1 FROM users WHERE HostID = ? LIMIT 1");
    $chk->bind_param("i", $HostID);
    $chk->execute();
    $chk->store_result();
    if ($chk->num_rows === 0) {
        http_response_code(403);
        echo "Error: Invalid user session (HostID not found).";
        $chk->close();
        exit;
    }
    $chk->close();


    // Insert into events table
    $query = $conn->prepare("
        INSERT INTO events (HostID, name, description, capacity, event_date, event_time, location, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    

    // Types: i (HostID), s (name), s (description), i (capacity), s (date), s (time), s (location), i (status)
    $query->bind_param(
        "ississsi",
        $HostID,
        $name,
        $description,
        $capacity,
        $event_date,
        $event_time,
        $location,
        $status
    );

    if ($query->execute()) {
        // Redirect back to mainboard
        header("Location: Mainboard.php?success=1");
        exit();
    } else {
        echo "Error: " . $query->error;
    }
}
?>
