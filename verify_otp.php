<?php
session_start();
$conn = new mysqli("localhost", "root", "", "eventy");

if (!isset($_SESSION['pending_user'])) {
    echo "no_pending";
    exit();
}

$inputOTP = $_POST['otp'];
$stored   = $_SESSION['pending_user'];

if (time() > $stored['expires']) {
    echo "otp_expired";
    exit();
}

if ($inputOTP != $stored['otp']) {
    echo "invalid_otp";
    exit();
}

// -----------------------
// INSERT THE NEW USER
// -----------------------
$stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, contactno, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss",
    $stored['firstname'],
    $stored['lastname'],
    $stored['email'],
    $stored['contactno'],
    $stored['password']
);

if ($stmt->execute()) {

    // get the HostID of the newly created user
    $newID = $stmt->insert_id;

    // create the normal session
    $_SESSION['HostID'] = $newID;

    // delete pending user session so OTP can't be reused
    unset($_SESSION['pending_user']);

    echo "success";
    exit();
}

echo "db_error";
?>
