<?php
session_start();

require_once __DIR__ . '/../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $stmt = $conn->prepare("SELECT HostID, user_type, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['HostID'] = $user['HostID'];
            $_SESSION['user_type'] = $user['user_type'];
            
            // Return JSON response with user type for frontend redirection
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'user_type' => $user['user_type']
            ]);
            exit();
        }
    }

    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'invalid'
    ]);
}
?>