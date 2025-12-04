<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "eventy";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die(json_encode(["status"=>"error","message"=>$conn->connect_error]));
}

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

$sql = "DELETE FROM events WHERE id=$id";

if($conn->query($sql)===TRUE){
    echo json_encode(["status"=>"success"]);
}else{
    echo json_encode(["status"=>"error","message"=>$conn->error]);
}

$conn->close();
?>
