<?php
session_start();

// Database credentials
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "eventy";

// Connect to DB
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Connection check
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate event ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid Event ID.");
}

$eventId = intval($_GET['id']);

// Prepare delete query
$stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
$stmt->bind_param("i", $eventId);

if ($stmt->execute()) {
    echo "<script>
            alert('Event deleted successfully.');
            window.location.href = 'Mainboard.php';
          </script>";
} else {
    echo "Error deleting event: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
