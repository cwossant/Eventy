<?php
session_start();

$conn = new mysqli("localhost", "root", "", "eventy");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $contactno = trim($_POST['contactno']);
    $password = trim($_POST['password']);

    // ----------------------------
    // 1️⃣ VALIDATION CHECKS
    // ----------------------------

    // Validate Email Format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "❌ Invalid email format.";
        exit();
    }

    // Validate Contact Number - must start with 09 and have 11 digits
    if (!preg_match("/^09\d{9}$/", $contactno)) {
        echo "❌ Invalid contact number. Must start with 09 and be 11 digits long.";
        exit();
    }

    // Validate Password Strength
    $uppercase = preg_match("@[A-Z]@", $password);
    $lowercase = preg_match("@[a-z]@", $password);
    $number    = preg_match("@[0-9]@", $password);

    if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
        echo "❌ Password must be at least 8 characters long and contain:
                <br>• 1 uppercase letter,
                <br>• 1 lowercase letter,
                <br>• 1 number.";
        exit();
    }

    // -----------------------------------
    // 2️⃣ CHECK IF EMAIL ALREADY EXISTS
    // -----------------------------------
    $check = $conn->prepare("SELECT HostID, password FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Email found → login mode
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['HostID'] = $user['HostID'];
            header("Location: /Eventy/pages/dashboard.php");
            exit();
        } else {
            echo "❌ Password incorrect.";
            exit();
        }
    }

    // -----------------------------------
    // 3️⃣ EMAIL NOT FOUND → REGISTER USER
    // -----------------------------------
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, contactno, password)
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstname, $lastname, $email, $contactno, $hashed);

    if ($stmt->execute()) {
        $_SESSION['HostID'] = $stmt->insert_id;
        header("Location: /Eventy/pages/dashboard.php");
        exit();
    } else {
        echo "❌ Database error: " . $stmt->error;
    }
}
?>
