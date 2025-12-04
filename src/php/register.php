<?php
session_start();

// Database credentials
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "eventy";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get user input and sanitize
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $email = $conn->real_escape_string($_POST['email']);
    $contactno = $conn->real_escape_string($_POST['contactno']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Insert into database
    $sql = "INSERT INTO users (firstname, lastname, email, contactno, password)
            VALUES ('$firstname', '$lastname', '$email', '$contactno', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to Mainboard.html after successful registration
        header("Location: Mainboard.html");
        exit(); // Always call exit after header redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
