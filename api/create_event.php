<?php
session_start();

if (!isset($_SESSION['HostID'])) {
    header("Location: ../index.php");
    exit();
}

$HostID = intval($_SESSION['HostID']);

require_once __DIR__ . '/../includes/db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $capacity = isset($_POST['capacity']) ? intval($_POST['capacity']) : null;
    $event_date = isset($_POST['event_date']) ? $_POST['event_date'] : null;
    $event_time = isset($_POST['event_time']) ? $_POST['event_time'] : null;
    $location = isset($_POST['location']) ? trim($_POST['location']) : '';
    $status = isset($_POST['status']) ? intval($_POST['status']) : 1;

    if ($name === '' || $capacity === null || $event_date === null || $event_time === null || $location === '') {
        http_response_code(400);
        echo "Error: Missing required fields.";
        exit;
    }

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

    $query = $conn->prepare(
        "INSERT INTO events (HostID, name, description, capacity, event_date, event_time, location, status)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );

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
        header("Location: ../Mainboard.php?success=1");
        exit();
    } else {
        echo "Error: " . $query->error;
    }
}
?>