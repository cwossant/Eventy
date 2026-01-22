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

// Start transaction
$conn->begin_transaction();

try {
    // Delete user events
    $deleteEventsStmt = $conn->prepare("DELETE FROM events WHERE HostID = ?");
    $deleteEventsStmt->bind_param("i", $HostID);
    if (!$deleteEventsStmt->execute()) {
        throw new Exception("Failed to delete events");
    }
    $deleteEventsStmt->close();

    // Delete event attendees related to this user's events
    $deleteAttendeesStmt = $conn->prepare("DELETE FROM event_attendees WHERE event_id IN (SELECT id FROM events WHERE HostID = ?)");
    $deleteAttendeesStmt->bind_param("i", $HostID);
    if (!$deleteAttendeesStmt->execute()) {
        throw new Exception("Failed to delete attendees");
    }
    $deleteAttendeesStmt->close();

    // Delete user settings
    $deleteSettingsStmt = $conn->prepare("DELETE FROM user_settings WHERE HostID = ?");
    $deleteSettingsStmt->bind_param("i", $HostID);
    if (!$deleteSettingsStmt->execute()) {
        throw new Exception("Failed to delete user settings");
    }
    $deleteSettingsStmt->close();

    // Delete notification settings
    $deleteNotifStmt = $conn->prepare("DELETE FROM host_notification_settings WHERE HostID = ?");
    $deleteNotifStmt->bind_param("i", $HostID);
    if (!$deleteNotifStmt->execute()) {
        throw new Exception("Failed to delete notification settings");
    }
    $deleteNotifStmt->close();

    // Delete user account
    $deleteUserStmt = $conn->prepare("DELETE FROM users WHERE HostID = ?");
    $deleteUserStmt->bind_param("i", $HostID);
    if (!$deleteUserStmt->execute()) {
        throw new Exception("Failed to delete user account");
    }
    $deleteUserStmt->close();

    // Commit transaction
    $conn->commit();
    $conn->close();

    // Destroy session
    session_destroy();

    echo json_encode([
        'status' => 'success',
        'message' => 'Account deleted successfully'
    ]);

} catch (Exception $e) {
    // Rollback transaction
    $conn->rollback();
    $conn->close();

    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
