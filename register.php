<?php
session_start();

require __DIR__ . '/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$conn = new mysqli("localhost", "root", "", "eventy");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $contactno = trim($_POST['contactno']);
    $password = trim($_POST['password']);

    // ------------------------------------------------------------
    // VALIDATION (You can re-add your full validation here)
    // ------------------------------------------------------------

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "invalid_email";
        exit();
    }

    if (!preg_match("/^09\d{9}$/", $contactno)) {
        echo "invalid_contact";
        exit();
    }

    $uppercase = preg_match("@[A-Z]@", $password);
    $lowercase = preg_match("@[a-z]@", $password);
    $number    = preg_match("@[0-9]@", $password);

    if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
        echo "weak_password";
        exit();
    }

    // ------------------------------------------------------------
    // CHECK IF USER ALREADY EXISTS
    // ------------------------------------------------------------
    $check = $conn->prepare("SELECT HostID FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "email_exists";
        exit();
    }

    // ------------------------------------------------------------
    // GENERATE OTP
    // ------------------------------------------------------------
    $otp = rand(100000, 999999);

    $_SESSION['pending_user'] = [
        "firstname" => $firstname,
        "lastname" => $lastname,
        "email" => $email,
        "contactno" => $contactno,
        "password" => password_hash($password, PASSWORD_DEFAULT),
        "otp" => $otp,
        "expires" => time() + 300
    ];

    // ------------------------------------------------------------
    // SEND OTP USING PHPMailer
    // ------------------------------------------------------------
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // 🔥 Replace this with YOUR Gmail + 16-digit app password
        $mail->Username   = 'evhyyy7@gmail.com';
        $mail->Password   = 'qwuennavqobomiwh'; // No spaces!

        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('YOUR_GMAIL@gmail.com', 'Eventy Verification');
        $mail->addAddress($email);

        $mail->Subject = "Your Eventy OTP Code";
        $mail->Body    = "Your OTP is: $otp";

        $mail->send();

        echo "otp_required";
        exit();

    } catch (Exception $e) {
        echo "mail_error";
        exit();
    }
}
?>
