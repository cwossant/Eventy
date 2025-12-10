<?php
session_start();

if (!isset($_SESSION['HostID'])) {
    echo json_encode(["error" => "Not logged in"]);
    exit();
}

$HostID = $_SESSION['HostID'];

// DB
$conn = new mysqli("localhost", "root", "", "eventy");
if ($conn->connect_error) {
    echo json_encode(["error" => "DB error"]);
    exit();
}

// must be file upload
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

// Generate unique file name
$newName = "IMG_" . uniqid() . "." . $ext;
$uploadDir = "uploads/profile_pics/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$path = $uploadDir . $newName;

if (move_uploaded_file($file['tmp_name'], $path)) {
    // Save to DB
    $stmt = $conn->prepare("UPDATE users SET profile_picture = ? WHERE HostID = ?");
    $stmt->bind_param("si", $newName, $HostID);
    $stmt->execute();
    $stmt->close();

    echo json_encode([
        "success" => true,
        "newPath" => $path
    ]);
} else {
    echo json_encode(["error" => "Upload failed"]);
}

$conn->close();
?>
