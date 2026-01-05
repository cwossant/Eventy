<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['pending_user'])) {
    echo "no_pending";
    exit();
}

$inputOTP = $_POST['otp'] ?? '';
$stored   = $_SESSION['pending_user'];

if (time() > ($stored['expires'] ?? 0)) {
    echo "otp_expired";
    exit();
}

if ($inputOTP != ($stored['otp'] ?? '')) {
    echo "invalid_otp";
    exit();
}

// INSERT THE NEW USER
$stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, contactno, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss",
    $stored['firstname'],
    $stored['lastname'],
    $stored['email'],
    $stored['contactno'],
    $stored['password']
);

if ($stmt->execute()) {
    $newID = $stmt->insert_id;
    $_SESSION['HostID'] = $newID;
    unset($_SESSION['pending_user']);
    echo "success";
    exit();
}

echo "db_error";
?>