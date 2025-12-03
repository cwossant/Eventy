<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "eventy";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die(json_encode(["status"=>"error","message"=>$conn->connect_error]));
}

// Get POST values
$name = $_POST['name'];
$description = $_POST['description'];
$capacity = $_POST['capacity'];
$event_date = $_POST['event_date'];
$event_time = $_POST['event_time'];
$location = $_POST['location'];

$sql = "INSERT INTO events (name, description, capacity, event_date, event_time, location) 
        VALUES ('$name','$description','$capacity','$event_date','$event_time','$location')";

if($conn->query($sql)===TRUE){
    $id = $conn->insert_id;
    $newEvent = $conn->query("SELECT * FROM events WHERE id=$id")->fetch_assoc();
    echo json_encode(["status"=>"success","event"=>$newEvent]);
}else{
    echo json_encode(["status"=>"error","message"=>$conn->error]);
}

$conn->close();
?>
