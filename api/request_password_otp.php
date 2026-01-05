<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mailConfigPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'mail.php';
$mailConfig = file_exists($mailConfigPath) ? (require $mailConfigPath) : [];

$HostID = $_SESSION['HostID'] ?? null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $current = $_POST['current_password'] ?? '';
    $new = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (!$HostID) {
        echo json_encode(["status" => "error", "message" => "Not authenticated."]);
        exit;
    }

    $stmt = $conn->prepare("SELECT password, email FROM users WHERE HostID=?");
    $stmt->bind_param("i", $HostID);
    $stmt->execute();
    $stmt->bind_result($hashedPassword, $email);
    $stmt->fetch();
    $stmt->close();

    if (!password_verify($current, $hashedPassword)) {
        echo json_encode(["status" => "error", "message" => "Current password is incorrect."]);
        exit;
    }

    if ($new !== $confirm) {
        echo json_encode(["status" => "error", "message" => "New passwords do not match."]);
        exit;
    }

    $_SESSION['password_otp'] = rand(100000, 999999);
    $_SESSION['pending_new_password'] = password_hash($new, PASSWORD_DEFAULT);
    $otpStr = (string)$_SESSION['password_otp'];

    $mail = new PHPMailer(true);
    try {
        $debugMode = isset($_GET['debug']) && $_GET['debug'] === '1';
        $provider = $mailConfig['provider'] ?? 'gmail';
        $conf = $mailConfig[$provider] ?? [];
        if (!empty($conf['password'])) { $conf['password'] = preg_replace('/\s+/', '', $conf['password']); }

        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host       = $conf['host'] ?? 'smtp.gmail.com';
        $mail->Port       = $conf['port'] ?? 587;
        $mail->SMTPSecure = $conf['encryption'] ?? 'tls';
        $mail->Username   = $conf['username'] ?? '';
        $mail->Password   = $conf['password'] ?? '';

        $mail->SMTPDebug = $debugMode ? 3 : 0;
        $logFile = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'mail.log';
        if (!is_dir(dirname($logFile))) {@mkdir(dirname($logFile), 0775, true);}        
        @file_put_contents($logFile, '[' . date('c') . "] request_password_otp init\n", FILE_APPEND);
        $mail->Debugoutput = function ($str, $level) use ($logFile) {
            $line = '[' . date('c') . "] level=$level " . $str . "\n";
            error_log($line);
            @file_put_contents($logFile, $line, FILE_APPEND);
        };

        $mail->setFrom($conf['from']['address'] ?? $mail->Username, $conf['from']['name'] ?? 'Eventy');
        $mail->addAddress($email);

        $bgPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'bg.png';
        if (file_exists($bgPath)) { $mail->addEmbeddedImage($bgPath, 'bg', 'bg.png', 'base64', 'image/png'); }

        $mail->Subject = 'Your Eventy Password Change OTP';
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'quoted-printable';

        $year = date('Y');
        $html = "<html><body>Your OTP is: {$otpStr}</body></html>";

        $mail->isHTML(true);
        $mail->Body    = $html;
        $mail->AltBody = "Your Eventy OTP is: {$otpStr}. It expires in 5 minutes.";

        $mail->send();
        echo json_encode(["status" => "otp_sent"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Email failed: " . $e->getMessage()]);
    }
}
?>