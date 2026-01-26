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
$action = $data['action'] ?? 'toggle'; // 'toggle', 'add', 'remove'

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
    // Check if already favorited
    $checkStmt = $conn->prepare("SELECT id FROM participant_favorites WHERE event_id = ? AND user_id = ?");
    $checkStmt->bind_param("ii", $event_id, $ParticipantID);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    $isFavorited = $checkResult->num_rows > 0;
    $checkStmt->close();
    
    if ($action === 'toggle') {
        if ($isFavorited) {
            // Remove from favorites
            $deleteStmt = $conn->prepare("DELETE FROM participant_favorites WHERE event_id = ? AND user_id = ?");
            $deleteStmt->bind_param("ii", $event_id, $ParticipantID);
            
            if ($deleteStmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Removed from favorites', 'is_favorited' => 0]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to remove from favorites']);
            }
            $deleteStmt->close();
        } else {
            // Add to favorites
            $insertStmt = $conn->prepare("INSERT INTO participant_favorites (event_id, user_id) VALUES (?, ?)");
            $insertStmt->bind_param("ii", $event_id, $ParticipantID);
            
            if ($insertStmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Added to favorites', 'is_favorited' => 1]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add to favorites']);
            }
            $insertStmt->close();
        }
    } elseif ($action === 'add') {
        if (!$isFavorited) {
            $insertStmt = $conn->prepare("INSERT INTO participant_favorites (event_id, user_id) VALUES (?, ?)");
            $insertStmt->bind_param("ii", $event_id, $ParticipantID);
            
            if ($insertStmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Added to favorites']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add to favorites']);
            }
            $insertStmt->close();
        } else {
            echo json_encode(['success' => true, 'message' => 'Already in favorites']);
        }
    } elseif ($action === 'remove') {
        if ($isFavorited) {
            $deleteStmt = $conn->prepare("DELETE FROM participant_favorites WHERE event_id = ? AND user_id = ?");
            $deleteStmt->bind_param("ii", $event_id, $ParticipantID);
            
            if ($deleteStmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Removed from favorites']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to remove from favorites']);
            }
            $deleteStmt->close();
        } else {
            echo json_encode(['success' => true, 'message' => 'Not in favorites']);
        }
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?>
