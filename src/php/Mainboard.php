<?php
session_start();
$HostID = $_SESSION['HostID'];

// Redirect if not logged in
if (!isset($_SESSION['HostID'])) {
    header("Location: registration.php");
    exit();
}

$HostID = $_SESSION['HostID'];

// Database connection
$conn = new mysqli("localhost", "root", "", "eventy");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
    $status = intval($_POST['status']);


    // Insert into events table
    $query = $conn->prepare("
        INSERT INTO events (HostID, name, description, capacity, event_date, event_time, location, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $query->bind_param(
        "ississss",
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
