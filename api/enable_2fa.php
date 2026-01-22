<?php
session_start();

if (!isset($_SESSION['HostID'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

$HostID = $_SESSION['HostID'];

// Database connection
$conn = new mysqli("localhost", "root", "", "eventy");

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit();
}

// Get user email
$stmt = $conn->prepare("SELECT email, firstname FROM users WHERE HostID = ?");
$stmt->bind_param("i", $HostID);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    http_response_code(404);
    echo json_encode(['status' => 'error', 'message' => 'User not found']);
    exit();
}

// Update 2FA status in database
$updateStmt = $conn->prepare("UPDATE users SET `2FA` = 1 WHERE HostID = ?");
$updateStmt->bind_param("i", $HostID);

if (!$updateStmt->execute()) {
    $conn->close();
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Failed to update 2FA status']);
    exit();
}

$updateStmt->close();

// Send security notification email
require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load mail configuration
$mailConfig = require '../config/mail.php';
$provider = $mailConfig['provider'];
$config = $mailConfig[$provider];

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = $config['host'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $config['username'];
    $mail->Password   = $config['password'];
    $mail->SMTPSecure = $config['encryption'] === 'ssl' ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $config['port'];

    // Recipients
    $mail->setFrom($config['from']['address'], $config['from']['name']);
    $mail->addAddress($user['email'], $user['firstname']);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Two-Factor Authentication Enabled - Eventy';
    
    $emailBody = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; background: #f9f9f9; border-radius: 8px; }
            .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 8px 8px 0 0; text-align: center; }
            .content { background: white; padding: 30px; }
            .security-badge { background: #10b981; color: white; padding: 10px; border-radius: 5px; text-align: center; font-weight: bold; margin: 20px 0; }
            .info-box { background: #f0f9ff; border-left: 4px solid #3b82f6; padding: 15px; margin: 20px 0; border-radius: 4px; }
            .footer { background: #f3f4f6; padding: 20px; text-align: center; font-size: 12px; color: #666; border-radius: 0 0 8px 8px; }
            .btn { background: #667eea; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 20px 0; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>Security Update</h2>
            </div>
            <div class='content'>
                <p>Hello <strong>" . htmlspecialchars($user['firstname']) . "</strong>,</p>
                
                <p>We're writing to confirm that <strong>Two-Factor Authentication (2FA)</strong> has been successfully enabled on your Eventy account.</p>
                
                <div class='security-badge'>
                    ✓ 2FA is now ACTIVE on your account
                </div>
                
                <div class='info-box'>
                    <h3 style='margin-top: 0;'>What this means:</h3>
                    <ul>
                        <li>Your account now has an additional layer of security</li>
                        <li>You may be prompted for additional verification when logging in from new devices</li>
                        <li>Keep your recovery codes in a safe place</li>
                    </ul>
                </div>
                
                <div class='info-box'>
                    <h3 style='margin-top: 0;'>Did you make this change?</h3>
                    <p>If you did not enable 2FA on your account, please contact our support team immediately or reset your password.</p>
                </div>
                
                <p><strong>Account Security Tips:</strong></p>
                <ul>
                    <li>Never share your password with anyone</li>
                    <li>Use a strong, unique password</li>
                    <li>Enable 2FA for better protection</li>
                    <li>Review your account activity regularly</li>
                </ul>
                
                <p>Thank you for prioritizing your account security!</p>
                
                <p>Best regards,<br><strong>The Eventy Team</strong></p>
            </div>
            <div class='footer'>
                <p>© 2026 Eventy. All rights reserved.</p>
                <p>This is an automated email. Please do not reply to this message.</p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    $mail->Body = $emailBody;

    $mail->send();
    
    $conn->close();
    echo json_encode([
        'status' => 'success',
        'message' => '2FA has been enabled successfully. A confirmation email has been sent to your registered email address.'
    ]);

} catch (Exception $e) {
    $conn->close();
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to send email: ' . $mail->ErrorInfo
    ]);
}
?>
