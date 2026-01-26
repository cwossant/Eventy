<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['HostID'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit();
}

$ParticipantID = $_SESSION['HostID'];

// Database connection
$conn = new mysqli("localhost", "root", "", "eventy");

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed']);
    exit();
}

$type = $_GET['type'] ?? 'all'; // 'all', 'registered', 'favorites'

try {
    if ($type === 'all') {
        // Get all available events
        $query = "SELECT e.*, ec.name as category_name, u.firstname, u.lastname 
                  FROM events e 
                  LEFT JOIN event_categories ec ON e.category_id = ec.id 
                  LEFT JOIN users u ON e.HostID = u.HostID 
                  WHERE e.status = 1 
                  ORDER BY e.event_date DESC";
        
        $result = $conn->query($query);
        $events = [];
        
        while ($row = $result->fetch_assoc()) {
            // Construct proper image path
            $row['event_image'] = !empty($row['event_image']) ? "uploads/events/" . $row['event_image'] : null;
            
            // Check if user has registered
            $registrationCheck = $conn->prepare("SELECT id FROM event_attendees WHERE event_id = ? AND user_id = ?");
            $registrationCheck->bind_param("ii", $row['id'], $ParticipantID);
            $registrationCheck->execute();
            $regResult = $registrationCheck->get_result();
            $row['is_registered'] = $regResult->num_rows > 0 ? 1 : 0;
            $registrationCheck->close();
            
            // Check if user has favorited
            $favoriteCheck = $conn->prepare("SELECT id FROM participant_favorites WHERE event_id = ? AND user_id = ?");
            $favoriteCheck->bind_param("ii", $row['id'], $ParticipantID);
            $favoriteCheck->execute();
            $favResult = $favoriteCheck->get_result();
            $row['is_favorited'] = $favResult->num_rows > 0 ? 1 : 0;
            $favoriteCheck->close();
            
            $events[] = $row;
        }
        
        echo json_encode(['success' => true, 'events' => $events]);
        
    } elseif ($type === 'registered') {
        // Get events user has registered for
        $query = "SELECT e.*, ec.name as category_name, u.firstname, u.lastname 
                  FROM events e 
                  INNER JOIN event_attendees ea ON e.id = ea.event_id
                  LEFT JOIN event_categories ec ON e.category_id = ec.id 
                  LEFT JOIN users u ON e.HostID = u.HostID 
                  WHERE ea.user_id = ?
                  ORDER BY e.event_date DESC";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $ParticipantID);
        $stmt->execute();
        $result = $stmt->get_result();
        $events = [];
        
        while ($row = $result->fetch_assoc()) {
            // Construct proper image path
            $row['event_image'] = !empty($row['event_image']) ? "uploads/events/" . $row['event_image'] : null;
            $row['is_registered'] = 1;
            
            // Check if user has favorited
            $favoriteCheck = $conn->prepare("SELECT id FROM participant_favorites WHERE event_id = ? AND user_id = ?");
            $favoriteCheck->bind_param("ii", $row['id'], $ParticipantID);
            $favoriteCheck->execute();
            $favResult = $favoriteCheck->get_result();
            $row['is_favorited'] = $favResult->num_rows > 0 ? 1 : 0;
            $favoriteCheck->close();
            
            $events[] = $row;
        }
        $stmt->close();
        
        echo json_encode(['success' => true, 'events' => $events]);
        
    } elseif ($type === 'favorites') {
        // Get favorited events
        $query = "SELECT e.*, ec.name as category_name, u.firstname, u.lastname 
                  FROM events e 
                  INNER JOIN participant_favorites pf ON e.id = pf.event_id
                  LEFT JOIN event_categories ec ON e.category_id = ec.id 
                  LEFT JOIN users u ON e.HostID = u.HostID 
                  WHERE pf.user_id = ?
                  ORDER BY e.event_date DESC";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $ParticipantID);
        $stmt->execute();
        $result = $stmt->get_result();
        $events = [];
        
        while ($row = $result->fetch_assoc()) {
            $row['event_image'] = !empty($row['event_image']) ? "uploads/events/" . $row['event_image'] : null;
            $row['is_favorited'] = 1;
            
            // Check if user has registered
            $registrationCheck = $conn->prepare("SELECT id FROM event_attendees WHERE event_id = ? AND user_id = ?");
            $registrationCheck->bind_param("ii", $row['id'], $ParticipantID);
            $registrationCheck->execute();
            $regResult = $registrationCheck->get_result();
            $row['is_registered'] = $regResult->num_rows > 0 ? 1 : 0;
            $registrationCheck->close();
            
            $events[] = $row;
        }
        $stmt->close();
        
        echo json_encode(['success' => true, 'events' => $events]);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?>
