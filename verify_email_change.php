<?php
// verify_email_change.php
session_start();
require_once __DIR__ . '/includes/db.php';

if (!isset($_SESSION['HostID'])) { echo "no_session"; exit(); }
$HostID = (int)$_SESSION['HostID'];
$otp = trim($_POST['otp'] ?? '');

if (!$otp) { echo "invalid"; exit(); }

// fetch pending
$stmt = $conn->prepare("SELECT id, new_email, expires_at FROM email_change_verification WHERE hostid = ? AND otp = ? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("is", $HostID, $otp);
$stmt->execute();
$stmt->bind_result($id, $new_email, $expires_at);
if (!$stmt->fetch()) { echo "invalid_otp"; exit(); }
$stmt->close();

if (strtotime($expires_at) < time()) { echo "otp_expired"; exit(); }

// update users table
$u = $conn->prepare("UPDATE users SET email = ? WHERE HostID = ?");
$u->bind_param("si", $new_email, $HostID);
if ($u->execute()) {
    // delete used record
    $d = $conn->prepare("DELETE FROM email_change_verification WHERE id = ?");
    $d->bind_param("i", $id);
    $d->execute();
    echo "success";
} else {
    echo "db_error";
}
