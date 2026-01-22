<?php
header('Content-Type: application/json');
session_start();
require '../includes/db.php';

$hostId = $_SESSION['HostID'] ?? null;
if (!$hostId) {
    http_response_code(401);
    exit(json_encode(['error' => 'Unauthorized']));
}

try {
    $stmt = $pdo->prepare("SELECT * FROM host_notification_settings WHERE HostID = ?");
    $stmt->execute([$hostId]);
    $settings = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$settings) {
        // Create default settings if they don't exist
        $stmt = $pdo->prepare("INSERT INTO host_notification_settings (HostID) VALUES (?)");
        $stmt->execute([$hostId]);
        $settings = [
            'HostID' => $hostId,
            'email_new_registration' => 1,
            'email_event_reminders' => 1,
            'email_event_updates' => 1,
            'email_cancellations' => 1,
            'email_attendee_messages' => 1,
            'email_weekly_digest' => 0
        ];
    }
    
    echo json_encode($settings);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
