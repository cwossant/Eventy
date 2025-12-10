<?php
session_start();
require "includes/db.php";
require "PHPMailer/PHPMailer.php";
require "PHPMailer/SMTP.php";
require "PHPMailer/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

// Logged-in Host
$HostID = $_SESSION['HostID'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    // Fetch user
    $stmt = $conn->prepare("SELECT password, email FROM users WHERE HostID=?");
    $stmt->bind_param("i", $HostID);
    $stmt->execute();
    $stmt->bind_result($hashedPassword, $email);
    $stmt->fetch();
    $stmt->close();

    // Check current pass
    if (!password_verify($current, $hashedPassword)) {
        echo json_encode(["status" => "error", "message" => "Current password is incorrect."]);
        exit;
    }

    if ($new !== $confirm) {
        echo json_encode(["status" => "error", "message" => "New passwords do not match."]);
        exit;
    }

    // Generate OTP
    $_SESSION['password_otp'] = rand(100000, 999999);
    $_SESSION['pending_new_password'] = password_hash($new, PASSWORD_DEFAULT);

    // Send Email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "evhyyy7@gmail.com";
        $mail->Password = "qwuennavqobomiwh"; 
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;

        $mail->setFrom("your_eventy_app_email@gmail.com", "Eventy");
        $mail->addAddress($email);
        $mail->Subject = "Your Eventy Password Change OTP";
        $mail->Body = "Your Eventy OTP is: " . $_SESSION['password_otp'];

        $mail->send();

        echo json_encode(["status" => "otp_sent"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Email failed: ".$e->getMessage()]);
    }

}
