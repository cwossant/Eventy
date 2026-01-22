<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
header("Content-Type: application/json");

if (!isset($_SESSION['HostID'])) {
    echo json_encode(["status" => "error", "message" => "User not authenticated"]);
    exit();
}

$HostID = $_SESSION['HostID'];

// Handle theme/darkmode setting
if (isset($_POST['darkmode'])) {
    $darkMode = isset($_POST['darkmode']) ? (int)$_POST['darkmode'] : 0;
    
    $stmt = $conn->prepare("UPDATE users SET darkmode = ? WHERE HostID = ?");
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
        exit();
    }
    
    $stmt->bind_param("ii", $darkMode, $HostID);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Theme updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update theme: " . $stmt->error]);
    }
    $stmt->close();
    exit();
}

// Handle language setting
if (isset($_POST['language'])) {
    $language = trim($_POST['language']);
    
    // Validate language
    $validLanguages = ['english', 'tagalog', 'spanish'];
    if (!in_array($language, $validLanguages)) {
        echo json_encode(["status" => "error", "message" => "Invalid language selected"]);
        exit();
    }
    
    $stmt = $conn->prepare("UPDATE users SET language = ? WHERE HostID = ?");
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
        exit();
    }
    
    $stmt->bind_param("si", $language, $HostID);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Language updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update language: " . $stmt->error]);
    }
    $stmt->close();
    exit();
}

// Handle password change
if (isset($_POST['action']) && $_POST['action'] === 'change_password') {
    require_once __DIR__ . '/request_password_otp.php';
    exit();
}

echo json_encode(["status" => "error", "message" => "No valid action provided"]);
exit();
?>