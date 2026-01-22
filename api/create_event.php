<?php
session_start();

if (!isset($_SESSION['HostID'])) {
    header("Location: ../index.php");
    exit();
}

$HostID = intval($_SESSION['HostID']);

require_once __DIR__ . '/../includes/db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $capacity = isset($_POST['capacity']) ? intval($_POST['capacity']) : null;
    $event_date = isset($_POST['event_date']) ? $_POST['event_date'] : null;
    $event_time = isset($_POST['event_time']) ? $_POST['event_time'] : null;
    $location = isset($_POST['location']) ? trim($_POST['location']) : '';
    $status = isset($_POST['status']) ? intval($_POST['status']) : 1;
    $category_id = isset($_POST['category']) && $_POST['category'] !== '' ? intval($_POST['category']) : null;
    $latitude = isset($_POST['latitude']) && $_POST['latitude'] !== '' ? floatval($_POST['latitude']) : null;
    $longitude = isset($_POST['longitude']) && $_POST['longitude'] !== '' ? floatval($_POST['longitude']) : null;
    $imageName = null;

    if ($name === '' || $capacity === null || $event_date === null || $event_time === null || $location === '') {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
        exit;
    }

    // Validate user
    $chk = $conn->prepare("SELECT 1 FROM users WHERE HostID = ? LIMIT 1");
    $chk->bind_param("i", $HostID);
    $chk->execute();
    $chk->store_result();
    if ($chk->num_rows === 0) {
        http_response_code(403);
        echo json_encode(['status' => 'error', 'message' => 'Invalid user session']);
        $chk->close();
        exit;
    }
    $chk->close();

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES['image']['tmp_name']);
        finfo_close($finfo);
        
        if (!in_array($mime, $allowed)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid image type']);
            exit;
        }
        
        if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
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
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Failed to upload image']);
            exit;
        }
    }

    $query = $conn->prepare(
        "INSERT INTO events (HostID, name, description, capacity, event_date, event_time, location, status, category_id, event_image, latitude, longitude)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $query->bind_param(
        "issiisssissd",
        $HostID,
        $name,
        $description,
        $capacity,
        $event_date,
        $event_time,
        $location,
        $status,
        $category_id,
        $imageName,
        $latitude,
        $longitude
    );

    if ($query->execute()) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'Event created successfully', 'event_id' => $query->insert_id]);
        exit();
    } else {
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $query->error]);
        exit();
    }
}
?>