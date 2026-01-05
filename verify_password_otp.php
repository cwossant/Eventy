<?php
session_start();
header("Content-Type: application/json");

require_once "includes/db.php";

if (!isset($_SESSION['HostID'])) {
    echo json_encode(["status" => "error", "message" => "Not logged in."]);
    exit();
}

$HostID = $_SESSION['HostID'];
$otp = $_POST['otp'] ?? "";

if (!isset($_SESSION['password_otp'])) {
    echo json_encode(["status" => "error", "message" => "No OTP generated."]); 
    exit();
}

if ($otp != $_SESSION['password_otp']) {
    echo json_encode(["status" => "error", "message" => "Incorrect OTP."]);
    exit();
}

$newPassHash = $_SESSION['pending_new_password'];

$stmt = $conn->prepare("UPDATE users SET password = ? WHERE HostID = ?");
$stmt->bind_param("si", $newPassHash, $HostID);
$stmt->execute();

unset($_SESSION['password_otp']);
unset($_SESSION['pending_new_password']);

echo json_encode(["status" => "success"]);
exit();
?>
