<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "eventy";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => $conn->connect_error]));
}

$sql = "SELECT * FROM events ORDER BY event_date, event_time";
$result = $conn->query($sql);

$events = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

echo json_encode($events);
$conn->close();
?>
