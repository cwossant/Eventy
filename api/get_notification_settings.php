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
    $stmt = $conn->prepare("SELECT * FROM host_notification_settings WHERE HostID = ?");
    if (!$stmt) {
        throw new Exception($conn->error);
    }
    $stmt->bind_param("i", $hostId);
    $stmt->execute();
    $result = $stmt->get_result();
    $settings = $result->fetch_assoc();
    
    if (!$settings) {
        // Create default settings if they don't exist
        $insertStmt = $conn->prepare("INSERT INTO host_notification_settings (HostID) VALUES (?)");
        if (!$insertStmt) {
            throw new Exception($conn->error);
        }
        $insertStmt->bind_param("i", $hostId);
        $insertStmt->execute();
        $insertStmt->close();
        
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
    $stmt->close();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
