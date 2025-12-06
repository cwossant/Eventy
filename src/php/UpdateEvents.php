<?php
session_start();

$conn = new mysqli("localhost", "root", "", "eventy");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$capacity = $_POST['capacity'];
$event_date = $_POST['event_date'];
$event_time = $_POST['event_time'];
$location = $_POST['location'];
$status = $_POST['status'];

$stmt = $conn->prepare("UPDATE events SET 
    name=?, description=?, capacity=?, event_date=?, event_time=?, location=?, status=?
    WHERE id=?");

$stmt->bind_param("ssissssi", 
    $name, $description, $capacity, $event_date, $event_time, $location, $status, $id);

if ($stmt->execute()) {
    echo "<script>
        alert('Event updated successfully!');
        window.location.href = 'Mainboard.php';
    </script>";
} else {
    echo "Error updating event: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
