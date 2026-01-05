<?php
session_start();
require "includes/db.php";
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load SMTP configuration
$mailConfigPath = __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'mail.php';
$mailConfig = file_exists($mailConfigPath) ? (require $mailConfigPath) : [];

// Logged-in Host
$HostID = $_SESSION['HostID'] ?? null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $current = $_POST['current_password'] ?? '';
        $new = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if (!$HostID) {
                echo json_encode(["status" => "error", "message" => "Not authenticated."]);
                exit;
        }

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
        $otpStr = (string)$_SESSION['password_otp'];

        // Send Email via PHPMailer with configured provider
        $mail = new PHPMailer(true);
        try {
            $debugMode = isset($_GET['debug']) && $_GET['debug'] === '1';
                $provider = $mailConfig['provider'] ?? 'gmail';
                $conf = $mailConfig[$provider] ?? [];
                if (!empty($conf['password'])) {
                        $conf['password'] = preg_replace('/\s+/', '', $conf['password']);
                }

                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->Host       = $conf['host'] ?? 'smtp.gmail.com';
                $mail->Port       = $conf['port'] ?? 587;
                $mail->SMTPSecure = $conf['encryption'] ?? 'tls';
                $mail->Username   = $conf['username'] ?? '';
                $mail->Password   = $conf['password'] ?? '';

            // Debug logging to file similar to send_otp
            $mail->SMTPDebug = $debugMode ? 3 : 0;
            $logFile = __DIR__ . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'mail.log';
            if (!is_dir(dirname($logFile))) {@mkdir(dirname($logFile), 0775, true);}        
            @file_put_contents($logFile, '[' . date('c') . "] request_password_otp init\n", FILE_APPEND);
            $mail->Debugoutput = function ($str, $level) use ($logFile) {
                $line = '[' . date('c') . "] level=$level " . $str . "\n";
                error_log($line);
                @file_put_contents($logFile, $line, FILE_APPEND);
            };

                $mail->setFrom($conf['from']['address'] ?? $mail->Username, $conf['from']['name'] ?? 'Eventy');
                $mail->addAddress($email);

                // Embed background image for email body
                $bgPath = __DIR__ . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'bg.png';
                if (file_exists($bgPath)) {
                    $mail->addEmbeddedImage($bgPath, 'bg', 'bg.png', 'base64', 'image/png');
                }

                $mail->Subject = 'Your Eventy Password Change OTP';
                $mail->CharSet = 'UTF-8';
                $mail->Encoding = 'quoted-printable';

                // Styled HTML email body
                $year = date('Y');
                $html = <<<HTML
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Password Change Verification</title>
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
                            <div style="margin-top:6px; font-size:14px; color:#6B7280;">Password change verification code</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:8px 24px 24px;">
                            <div style="background:#F3F4F6; border:1px dashed #D1D5DB; border-radius:10px; padding:16px; text-align:center;">
                                <div style="font-size:30px; font-weight:700; letter-spacing:8px; color:#111827;">{$otpStr}</div>
                            </div>
                            <p style="margin:16px 0 0; font-size:14px; color:#374151; line-height:1.6;">
                                Enter this code to confirm your password change. This code expires in 5 minutes.
                            </p>
                            <p style="margin:12px 0 0; font-size:12px; color:#6B7280;">
                                If you didn’t request this change, you can safely ignore this email.
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

                // Multipart (HTML + plain text)
                $mail->isHTML(true);
                $mail->Body    = $html;
                $mail->AltBody = "Your Eventy OTP is: {$otpStr}. It expires in 5 minutes.";

                // MIME preview in debug
                if ($debugMode) {
                    if ($mail->preSend()) {
                        $mime = $mail->getSentMIMEMessage();
                        @file_put_contents($logFile, '[' . date('c') . "] PASSWORD MIME preview (first 4000 chars):\n" . substr($mime, 0, 4000) . "\n", FILE_APPEND);
                        // Echo a trimmed preview without breaking JSON for debug-only manual calls
                        header('Content-Type: text/plain');
                        echo "SMTP Debugging enabled. Check logs at: $logFile\n";
                        echo "Subject: " . $mail->Subject . "\n";
                        echo "From: " . $conf['from']['address'] . "\n";
                        echo substr($mime, 0, 600);
                        return;
                    }
                }

                $mail->send();
                echo json_encode(["status" => "otp_sent"]);
        } catch (Exception $e) {
                echo json_encode(["status" => "error", "message" => "Email failed: ".$e->getMessage()]);
        }
}
