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
    $new_reg = isset($_POST['email_new_registration']) ? 1 : 0;
    $reminders = isset($_POST['email_event_reminders']) ? 1 : 0;
    $updates = isset($_POST['email_event_updates']) ? 1 : 0;
    $cancellations = isset($_POST['email_cancellations']) ? 1 : 0;
    $messages = isset($_POST['email_attendee_messages']) ? 1 : 0;
    $digest = isset($_POST['email_weekly_digest']) ? 1 : 0;
    
    $stmt = $conn->prepare("UPDATE host_notification_settings SET 
        email_new_registration = ?,
        email_event_reminders = ?,
        email_event_updates = ?,
        email_cancellations = ?,
        email_attendee_messages = ?,
        email_weekly_digest = ?
        WHERE HostID = ?");
    
    if (!$stmt) {
        throw new Exception($conn->error);
    }
    
    $stmt->bind_param("iiiiiii", $new_reg, $reminders, $updates, $cancellations, $messages, $digest, $hostId);
    $stmt->execute();
    
    echo json_encode(['status' => 'success', 'message' => 'Notification settings updated']);
    $stmt->close();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
