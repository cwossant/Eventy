<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['HostID'])) {
    echo json_encode(["status" => "error"]);
    exit();
}

$HostID = $_SESSION['HostID'];

$conn = new mysqli("localhost", "root", "", "eventy");
if ($conn->connect_error) {
    echo json_encode(["status" => "error"]);
    exit();
}

/* ---------------------------------------
   UPDATE PROFILE TEXT FIELDS (EMAIL LOCKED)
---------------------------------------- */
if (isset($_POST['firstname'])) {

    $firstname = trim($_POST['firstname']);
    $lastname  = trim($_POST['lastname']);
    $city      = trim($_POST['city']);
    $bio       = trim($_POST['bio']);

    // Email is intentionally NOT updated
    $stmt = $conn->prepare("
        UPDATE users 
        SET firstname=?, lastname=?, city=?, bio=?
        WHERE HostID=?
    ");
    $stmt->bind_param("ssssi", $firstname, $lastname, $city, $bio, $HostID);

    if ($stmt->execute()) {

        // Fetch updated values including email (unchanged)
        $stmt2 = $conn->prepare("
            SELECT firstname, lastname, email, city, bio 
            FROM users WHERE HostID=?
        ");
        $stmt2->bind_param("i", $HostID);
        $stmt2->execute();
        $result = $stmt2->get_result()->fetch_assoc();

        echo json_encode([
            "status"    => "success",
            "firstname" => $result["firstname"],
            "lastname"  => $result["lastname"],
            "email"     => $result["email"], // Returned but never modified
            "city"      => $result["city"],
            "bio"       => $result["bio"]
        ]);
    } else {
        echo json_encode(["status" => "error"]);
    }

    exit();
}

/* ---------------------------------------
   PROFILE PICTURE UPLOAD
---------------------------------------- */
if (isset($_FILES['profile_picture'])) {

    $uploadDir = "uploads/profile_pics/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

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
    $targetPath  = $uploadDir . $newFileName;

    if (move_uploaded_file($fileTmp, $targetPath)) {

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

/* ---------------------------------------
   INVALID ACCESS
---------------------------------------- */
echo json_encode(["status" => "error"]);
exit();
