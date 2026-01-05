<?php
$email = $_POST['email'] ?? '';
$otp = $_POST['otp'] ?? '';
require_once __DIR__ . '/../includes/db.php';

$stmt = $conn->prepare("SELECT otp, expires_at FROM email_verification WHERE email = ? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($correctOtp, $expires);
$stmt->fetch();
$stmt->close();

$currentTime = date("Y-m-d H:i:s");

if (!$correctOtp) {
    die("No OTP found for this email.");
}

if ($otp == $correctOtp && $currentTime < $expires) {
    echo "Verification successful!";
} else {
    echo "Invalid or expired OTP.";
}
?>