<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['HostID'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit();
}

$ParticipantID = $_SESSION['HostID'];

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);
$event_id = $data['event_id'] ?? null;

if (!$event_id) {
    echo json_encode(['success' => false, 'message' => 'Event ID is required']);
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "eventy");

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed']);
    exit();
}

try {
    // Get user email and name
    $userStmt = $conn->prepare("SELECT email, firstname, lastname FROM users WHERE HostID = ?");
    $userStmt->bind_param("i", $ParticipantID);
    $userStmt->execute();
    $userResult = $userStmt->get_result();
    $userData = $userResult->fetch_assoc();
    $userStmt->close();
    
    if (!$userData) {
        echo json_encode(['success' => false, 'message' => 'User not found']);
        exit();
    }
    
    // Check if already registered
    $checkStmt = $conn->prepare("SELECT id FROM event_attendees WHERE event_id = ? AND user_id = ?");
    $checkStmt->bind_param("ii", $event_id, $ParticipantID);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    
    if ($checkResult->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Already registered for this event']);
        $checkStmt->close();
        $conn->close();
        exit();
    }
    $checkStmt->close();
    
    // Register user for event
    $insertStmt = $conn->prepare("INSERT INTO event_attendees (event_id, user_id, email, name, status) VALUES (?, ?, ?, ?, 'registered')");
    $fullName = $userData['firstname'] . ' ' . $userData['lastname'];
    $insertStmt->bind_param("iiss", $event_id, $ParticipantID, $userData['email'], $fullName);
    
    if ($insertStmt->execute()) {
        // Update attendee count
        $updateStmt = $conn->prepare("UPDATE events SET attendees = attendees + 1 WHERE id = ?");
        $updateStmt->bind_param("i", $event_id);
        $updateStmt->execute();
        $updateStmt->close();
        
        echo json_encode(['success' => true, 'message' => 'Successfully registered for event']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to register']);
    }
    $insertStmt->close();
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?>
