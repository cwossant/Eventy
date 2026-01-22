<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
header("Content-Type: application/json");

if (!isset($_SESSION['HostID'])) {
    echo json_encode(["status" => "error", "message" => "User not authenticated"]);
    exit();
}

$HostID = $_SESSION['HostID'];

if (isset($_POST['firstname'])) {
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $lastname  = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
    $city      = isset($_POST['city']) ? trim($_POST['city']) : '';
    $bio       = isset($_POST['bio']) ? trim($_POST['bio']) : '';

    // Validate inputs
    if (empty($firstname) || empty($lastname)) {
        echo json_encode(["status" => "error", "message" => "First name and last name are required"]);
        exit();
    }

    $stmt = $conn->prepare("UPDATE users SET firstname=?, lastname=?, city=?, bio=? WHERE HostID=?");
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
        exit();
    }

    $stmt->bind_param("ssssi", $firstname, $lastname, $city, $bio, $HostID);

    if ($stmt->execute()) {
        $stmt->close();
        
        $stmt2 = $conn->prepare("SELECT firstname, lastname, email, city, bio FROM users WHERE HostID=?");
        if (!$stmt2) {
            echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
            exit();
        }

        $stmt2->bind_param("i", $HostID);
        $stmt2->execute();
        $result = $stmt2->get_result()->fetch_assoc();
        $stmt2->close();

        echo json_encode([
            "status"    => "success",
            "message"   => "Profile updated successfully",
            "firstname" => $result["firstname"],
            "lastname"  => $result["lastname"],
            "email"     => $result["email"],
            "city"      => $result["city"],
            "bio"       => $result["bio"]
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update profile: " . $stmt->error]);
    }

    exit();
}

if (isset($_FILES['profile_picture'])) {
    $uploadDir = __DIR__ . '/../uploads/profile_pics/';
    if (!is_dir($uploadDir)) { mkdir($uploadDir, 0777, true); }

    $fileTmp   = $_FILES['profile_picture']['tmp_name'];
    $fileName  = $_FILES['profile_picture']['name'];
    $fileSize  = $_FILES['profile_picture']['size'];
    $fileError = $_FILES['profile_picture']['error'];

    $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if ($fileError !== 0 || !in_array($ext, $allowedExt) || $fileSize > 5 * 1024 * 1024) {
        echo json_encode(["status" => "error"]);
        exit();
    }

    $newFileName = "PIC_" . $HostID . "_" . time() . "." . $ext;
    $targetPath  = 'uploads/profile_pics/' . $newFileName;

    if (move_uploaded_file($fileTmp, __DIR__ . '/../' . $targetPath)) {
        $stmt = $conn->prepare("UPDATE users SET profile_picture=? WHERE HostID=?");
        $stmt->bind_param("si", $newFileName, $HostID);
        $stmt->execute();

        echo json_encode([
            "status"  => "success",
            "newPath" => $targetPath
        ]);

    } else {
        echo json_encode(["status" => "error"]);
    }

    exit();
}

echo json_encode(["status" => "error"]);
exit();
?>