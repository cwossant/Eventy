<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';  // Composer autoload
// Load SMTP configuration (Gmail or Mailtrap)
$mailConfigPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'mail.php';
$mailConfig = file_exists($mailConfigPath) ? (require $mailConfigPath) : [];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../includes/db.php';

// Debug mode toggle from query param
$debugMode = isset($_GET['debug']) && $_GET['debug'] === '1';
// Optional: force single-part HTML instead of multipart/alternative
$forceHtmlSingle = isset($_GET['force_html']) && $_GET['force_html'] === '1';

// Get email from form (POST first, then allow GET for debug/testing)
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
if (!$email) {
    $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
}
if (empty($email)) {
    if ($debugMode) {
        echo '<pre style="background:#111;color:#eee;padding:12px;border-radius:8px;">Missing email input. Provide via POST or ?email=example@domain.com</pre>';
        exit;
    }
    echo 'Missing email input.';
    exit;
}

// Generate OTP
$otp = rand(100000, 999999);
$expires = date("Y-m-d H:i:s", strtotime("+5 minutes"));

// Ensure email_verification table exists
$createSql = "CREATE TABLE IF NOT EXISTS `email_verification` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL,
    `otp` VARCHAR(6) NOT NULL,
    `expires_at` DATETIME NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
$conn->query($createSql);

$stmt = $conn->prepare("INSERT INTO email_verification (email, otp, expires_at) VALUES (?, ?, ?)");
if (!$stmt) {
    $msg = 'Prepare failed: ' . $conn->error;
    error_log($msg);
    echo $msg;
    exit;
}
$otpStr = (string)$otp;
$stmt->bind_param("sss", $email, $otpStr, $expires);
$stmt->execute();
$stmt->close();

// Send OTP email via PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $provider = isset($_GET['provider']) ? $_GET['provider'] : ($mailConfig['provider'] ?? 'gmail');
    $conf = $mailConfig[$provider] ?? $mailConfig['gmail'] ?? [
        'host' => 'smtp.gmail.com',
        'port' => 587,
        'encryption' => 'tls',
        'username' => 'YOUR_GMAIL@gmail.com',
        'password' => 'YOUR_APP_PASSWORD',
        'from' => ['address' => 'YOUR_GMAIL@gmail.com', 'name' => 'Eventy Verification'],
    ];
    // Sanitize app password (Google shows with spaces)
    if (!empty($conf['password'])) {
        $conf['password'] = preg_replace('/\s+/', '', $conf['password']);
    }
    $mail->SMTPAuth   = true;
    $mail->Host       = $conf['host'];
    $mail->Port       = $conf['port'];
    $mail->SMTPSecure = $conf['encryption'];
    $mail->Username   = $conf['username'];
    $mail->Password   = $conf['password'];

    // Debug logging configuration (already parsed at top)
    $mail->SMTPDebug = $debugMode ? 3 : 0; // 0=off, 2=server msgs, 3=full
    $logFile = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'mail.log';
    if (!is_dir(dirname($logFile))) {
        @mkdir(dirname($logFile), 0775, true);
    }
    // Ensure we can write to log file; fallback to temp dir if needed
    $initialLogLine = '[' . date('c') . "] log initialized\n";
    $wrote = @file_put_contents($logFile, $initialLogLine, FILE_APPEND);
    if ($wrote === false) {
        $logFile = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'eventy_mail.log';
        @file_put_contents($logFile, $initialLogLine, FILE_APPEND);
    }
    @ini_set('error_log', $logFile);

    $mail->Debugoutput = function ($str, $level) use ($logFile) {
        $line = '[' . date('c') . "] level=$level " . $str . "\n";
        error_log($line);
        @file_put_contents($logFile, $line, FILE_APPEND);
    };

    // Recipients
    $mail->setFrom($conf['from']['address'], $conf['from']['name']);
    $mail->addAddress($email);

    // Embed background image for email body
    $bgPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'bg.png';
    if (file_exists($bgPath)) {
        $mail->addEmbeddedImage($bgPath, 'bg', 'bg.png', 'base64', 'image/png');
    }

    // Content
    $mail->Subject = 'Your Eventy OTP Code';
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'quoted-printable';

    // Styled HTML Email Body
    $year = date('Y');
    $html = <<<HTML
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="color-scheme" content="light only">
    <meta name="supported-color-schemes" content="light">
    <title>Eventy Verification Code</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if mso]>
    <style type="text/css">
        body, table, td {font-family: Arial, Helvetica, sans-serif !important;}
    </style>
    <![endif]-->
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
                                Enter this code in Eventy to continue. This code expires in 5 minutes for your security.
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

    // Apply HTML body directly
    if ($forceHtmlSingle) {
        $mail->isHTML(false);
        $mail->ContentType = 'text/html';
        $mail->Encoding = 'quoted-printable';
        $mail->AltBody = '';
        $mail->Body = $html;
    } else {
        $mail->isHTML(true);
        $mail->Encoding = 'quoted-printable';
        $mail->Body = $html;
        $mail->AltBody = "Your Eventy verification code is: {$otp}. It expires in 5 minutes.";
    }

    @file_put_contents($logFile, '[' . date('c') . "] HTML body size=" . strlen($html) . " bytes\n", FILE_APPEND);

    $mimePreview = null;
    if ($debugMode) {
        if ($mail->preSend()) {
            $mimePreview = $mail->getSentMIMEMessage();
            @file_put_contents($logFile, '[' . date('c') . "] MIME preview (first 4000 chars):\n" . substr($mimePreview, 0, 4000) . "\n", FILE_APPEND);
        } else {
            @file_put_contents($logFile, '[' . date('c') . "] preSend failed\n", FILE_APPEND);
        }
    }

    $success = $mail->send();

    if ($debugMode) {
        echo '<pre style="background:#111;color:#eee;padding:12px;border-radius:8px;">';
        echo "SMTP Debugging enabled. Check logs at: " . htmlspecialchars($logFile) . "\n";
        echo "Send result: " . ($success ? 'OK' : 'FAILED') . "\n";
        echo "Subject: " . htmlspecialchars($mail->Subject) . "\n";
        echo "ContentType: " . htmlspecialchars($mail->ContentType) . " | CharSet: " . htmlspecialchars($mail->CharSet) . "\n";
        echo "Encoding: " . htmlspecialchars($mail->Encoding ?: 'default') . " | force_html_single=" . ($forceHtmlSingle ? '1' : '0') . "\n";
        echo "AltBody length: " . strlen($mail->AltBody) . "\n";
        echo "HTML length: " . strlen($html) . "\n";
        if (!empty($mimePreview)) {
            echo "\n--- MIME Preview (first 1200 chars) ---\n";
            echo htmlspecialchars(substr($mimePreview, 0, 1200));
            echo "\n--- End MIME Preview ---\n";
        }
        echo "</pre>";
    } else {
        header("Location: /Eventy/api/verify_otp.php?email=" . urlencode($email));
        exit();
    }

} catch (Exception $e) {
    $errLine = '[' . date('c') . '] send_otp.php error: ' . $mail->ErrorInfo . "\n";
    error_log($errLine);
    @file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'mail.log', $errLine, FILE_APPEND);
    echo "Error sending email: {$mail->ErrorInfo}";
}
?>