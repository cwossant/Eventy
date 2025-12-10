<?php
session_start();
require 'vendor/autoload.php';  // Composer autoload

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Get email from form
$email = $_POST['email'];

// Generate OTP
$otp = rand(100000, 999999);
$expires = date("Y-m-d H:i:s", strtotime("+5 minutes"));

// Store OTP in database
$conn = new mysqli("localhost", "root", "", "eventy");
$stmt = $conn->prepare("INSERT INTO email_verification (email, otp, expires_at) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $otp, $expires);
$stmt->execute();
$stmt->close();

// Send OTP email via PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'YOUR_GMAIL@gmail.com';
    $mail->Password   = 'YOUR_APP_PASSWORD';  // NOT normal Gmail password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('YOUR_GMAIL@gmail.com', 'Eventy Verification');
    $mail->addAddress($email);

    // Content
    $mail->Subject = 'Your Eventy OTP Code';
    $mail->Body    = "Your OTP is: $otp\n\nThis code expires in 5 minutes.";

    $mail->send();

    header("Location: verify_otp.php?email=" . urlencode($email));
    exit();

} catch (Exception $e) {
    echo "Error sending email: {$mail->ErrorInfo}";
}
?>
