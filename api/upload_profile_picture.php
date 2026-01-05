<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['HostID'])) {
    echo json_encode(["error" => "Not logged in"]);
    exit();
}

$HostID = $_SESSION['HostID'];

if (!isset($_FILES['profile_picture'])) {
    echo json_encode(["error" => "No file uploaded"]);
    exit();
}

$file = $_FILES['profile_picture'];
$allowed = ['jpg', 'jpeg', 'png', 'gif'];
$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

if (!in_array($ext, $allowed)) {
    echo json_encode(["error" => "Invalid file type"]);
    exit();
}

$newName = "IMG_" . uniqid() . "." . $ext;
$uploadDir = __DIR__ . '/../uploads/profile_pics/';
if (!is_dir($uploadDir)) { mkdir($uploadDir, 0777, true); }
$path = 'uploads/profile_pics/' . $newName;

if (move_uploaded_file($file['tmp_name'], __DIR__ . '/../' . $path)) {
    $stmt = $conn->prepare("UPDATE users SET profile_picture = ? WHERE HostID = ?");
    $stmt->bind_param("si", $newName, $HostID);
    $stmt->execute();
    $stmt->close();

    echo json_encode([
        "status" => "success",
        "url" => $path
    ]);
} else {
    echo json_encode(["error" => "Upload failed"]);
}

$conn->close();
?>