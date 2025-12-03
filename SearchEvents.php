<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "eventy";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) die(json_encode([]));

$query = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : "";

$sql = "SELECT * FROM events 
        WHERE name LIKE '%$query%' 
        OR description LIKE '%$query%' 
        OR location LIKE '%$query%'
        ORDER BY event_date, event_time";

$result = $conn->query($sql);
$events = [];
while($row = $result->fetch_assoc()){
    $events[] = $row;
}

echo json_encode($events);
$conn->close();
?>
