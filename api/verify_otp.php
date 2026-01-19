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

// INSERT THE NEW USER (include profile_picture)
// determine user_type (default to participant)
$user_type = $stored['user_type'] ?? 'participant';

// ensure users table has user_type column (safe migration)
$colCheck = $conn->query("SHOW COLUMNS FROM users LIKE 'user_type'");
if ($colCheck && $colCheck->num_rows == 0) {
    $conn->query("ALTER TABLE users ADD COLUMN `user_type` VARCHAR(20) NOT NULL DEFAULT 'participant' AFTER `password`");
}

$stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, contactno, password, profile_picture, user_type) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss",
    $stored['firstname'],
    $stored['lastname'],
    $stored['email'],
    $stored['contactno'],
    $stored['password'],
    $stored['profile_picture'],
    $user_type
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