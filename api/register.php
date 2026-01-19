<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load SMTP configuration (Gmail or Mailtrap)
$mailConfigPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'mail.php';
$mailConfig = file_exists($mailConfigPath) ? (require $mailConfigPath) : [];

require_once __DIR__ . '/../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = trim($_POST['firstname'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contactno = trim($_POST['contactno'] ?? '');
    $password = trim($_POST['password'] ?? '');
    // accept role (participant/host) from form, default to participant
    $user_type = trim($_POST['role'] ?? 'participant');
    $user_type = strtolower($user_type);
    if (!in_array($user_type, ['participant', 'host'])) {
        $user_type = 'participant';
    }

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

    // CHECK IF USER ALREADY EXISTS
    $check = $conn->prepare("SELECT HostID FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "email_exists";
        exit();
    }

    // GENERATE OTP
    $otp = rand(100000, 999999);

    $_SESSION['pending_user'] = [
        "firstname" => $firstname,
        "lastname" => $lastname,
        "email" => $email,
        "contactno" => $contactno,
        "password" => password_hash($password, PASSWORD_DEFAULT),
        "profile_picture" => "default_profile.jpg",
        "user_type" => $user_type,
        "otp" => $otp,
        "expires" => time() + 300
    ];

    // SEND OTP USING PHPMailer
    $mail = new PHPMailer(true);

    try {
        $provider = $mailConfig['provider'] ?? 'gmail';
        $conf = $mailConfig[$provider] ?? [];
        if (!empty($conf['password'])) {
            $conf['password'] = preg_replace('/\s+/', '', $conf['password']);
        }

        $mail->isSMTP();
        $mail->SMTPAuth   = true;
        $mail->Host       = $conf['host'] ?? 'smtp.gmail.com';
        $mail->Port       = $conf['port'] ?? 587;
        $mail->SMTPSecure = $conf['encryption'] ?? 'tls';
        $mail->Username   = $conf['username'] ?? '';
        $mail->Password   = $conf['password'] ?? '';

        $mail->setFrom($conf['from']['address'] ?? $mail->Username, $conf['from']['name'] ?? 'Eventy Verification');
        $mail->addAddress($email);

        // Embed background image for email body
        $bgPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'bg.png';
        if (file_exists($bgPath)) {
            $mail->addEmbeddedImage($bgPath, 'bg', 'bg.png', 'base64', 'image/png');
        }

        $mail->Subject = 'Your Eventy OTP Code';
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'quoted-printable';
        $mail->isHTML(true);

        $year = date('Y');
        $html = <<<HTML
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Eventy Verification Code</title>
    <!--[if mso]><style type="text/css">body, table, td {font-family: Arial, Helvetica, sans-serif !important;}</style><![endif]-->
</head>
<body style="margin:0; padding:0; background:#f5f7fb; background-image:url('cid:bg'); background-size:cover; background-position:center top; background-repeat:no-repeat;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" background="cid:bg" style="background:#f5f7fb; background-image:url('cid:bg'); background-size:cover; background-position:center top; background-repeat:no-repeat;">
        <tr>
            <td align="center" style="padding:24px;">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="width:600px; max-width:600px; background:#ffffff; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,.06); font-family:Arial,Helvetica,sans-serif;">
                    <tr>
                        <td style="padding:24px 24px 8px; text-align:center;">
                            <div style="font-size:22px; font-weight:700; color:#1F2937;">Eventy</div>
                            <div style="margin-top:6px; font-size:14px; color:#6B7280;">Your one-time verification code</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:8px 24px 24px;">
                            <div style="background:#F3F4F6; border:1px dashed #D1D5DB; border-radius:10px; padding:16px; text-align:center;">
                                <div style="font-size:30px; font-weight:700; letter-spacing:8px; color:#111827;">{$otp}</div>
                            </div>
                            <p style="margin:16px 0 0; font-size:14px; color:#374151; line-height:1.6;">
                                Enter this code in Eventy to complete your registration. This code expires in 5 minutes.
                            </p>
                            <p style="margin:12px 0 0; font-size:12px; color:#6B7280;">
                                If you didn’t request this code, you can safely ignore this email.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px 24px 24px; text-align:center; border-top:1px solid #F3F4F6;">
                            <div style="font-size:12px; color:#9CA3AF;">© {$year} Eventy — Do not share this code.</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
HTML;

        $mail->Body    = $html;
        $mail->AltBody = "Your Eventy verification code is: {$otp}. It expires in 5 minutes.";

        $mail->send();

        echo "otp_required";
        exit();

    } catch (Exception $e) {
        echo "mail_error";
        exit();
    }
}
?>