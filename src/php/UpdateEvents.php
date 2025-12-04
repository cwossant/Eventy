<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "eventy";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) die(json_encode(["status"=>"error","message"=>$conn->connect_error]));

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$capacity = $_POST['capacity'];
$event_date = $_POST['event_date'];
$event_time = $_POST['event_time'];
$location = $_POST['location'];

$sql = "UPDATE events SET 
        name='$name', description='$description', capacity='$capacity', 
        event_date='$event_date', event_time='$event_time', location='$location'
        WHERE id=$id";

if($conn->query($sql)===TRUE){
    echo json_encode(["status"=>"success"]);
} else {
    echo json_encode(["status"=>"error","message"=>$conn->error]);
}
$conn->close();
?>
