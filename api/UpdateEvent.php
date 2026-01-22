<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['HostID'])) {
    header("Location: ../index.php");
    exit();
}

$id = $_POST['id'] ?? null;
$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$capacity = $_POST['capacity'] ?? null;
$event_date = $_POST['event_date'] ?? null;
$event_time = $_POST['event_time'] ?? null;
$location = $_POST['location'] ?? '';
$status = $_POST['status'] ?? null;
$category_id = isset($_POST['category']) && $_POST['category'] !== '' ? intval($_POST['category']) : null;
$latitude = isset($_POST['latitude']) && $_POST['latitude'] !== '' ? floatval($_POST['latitude']) : null;
$longitude = isset($_POST['longitude']) && $_POST['longitude'] !== '' ? floatval($_POST['longitude']) : null;

if (!$id) {
    header('Content-Type: application/json');
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid ID']);
    exit();
}

// Check if user owns this event
$checkStmt = $conn->prepare("SELECT id FROM events WHERE id = ? AND HostID = ?");
$checkStmt->bind_param("ii", $id, $_SESSION['HostID']);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();
if ($checkResult->num_rows === 0) {
    header('Content-Type: application/json');
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    $checkStmt->close();
    exit();
}
$checkStmt->close();

// Handle image upload
$imageName = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $_FILES['image']['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($mime, $allowed)) {
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid image type']);
        exit;
    }
    
    if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'File too large (max 5MB)']);
        exit;
    }
    
    $uploadDir = __DIR__ . '/../uploads/events/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    $imageName = time() . '_' . preg_replace("/[^a-zA-Z0-9._-]/", "", basename($_FILES['image']['name']));
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName)) {
        header('Content-Type: application/json');
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Failed to upload image']);
        exit;
    }
}

// Ensure date format is valid (YYYY-MM-DD)
if ($event_date) {
    $parsedDate = strtotime($event_date);
    if ($parsedDate) {
        $event_date = date('Y-m-d', $parsedDate);
    }
}

if ($event_time) {
    $parsedTime = strtotime($event_time);
    if ($parsedTime) {
        $event_time = date('H:i:s', $parsedTime);
    }
}

// Build update query
$updateFields = ["name = ?", "description = ?", "capacity = ?", "event_date = ?", "event_time = ?", "location = ?", "status = ?", "category_id = ?", "latitude = ?", "longitude = ?"];
$params = [$name, $description, $capacity, $event_date, $event_time, $location, $status, $category_id, $latitude, $longitude];
$types = "sissisisiddd";

if ($imageName) {
    $updateFields[] = "event_image = ?";
    $params[] = $imageName;
    $types .= "s";
}

// Add WHERE clause parameters
$params[] = $id;
$params[] = $_SESSION['HostID'];
$types .= "ii";

// Build the complete query
$updateQuery = "UPDATE events SET " . implode(", ", $updateFields) . " WHERE id = ? AND HostID = ?";

$stmt = $conn->prepare($updateQuery);
if (!$stmt) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
    exit;
}

$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'message' => 'Event updated successfully']);
} else {
    header('Content-Type: application/json');
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Error updating event: ' . $stmt->error]);
}

$stmt->close();
$conn->close();