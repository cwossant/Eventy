<?php
session_start();
require_once "includes/db.php";

if (!isset($_SESSION['HostID'])) {
    exit("Not logged in.");
}

$HostID = $_SESSION['HostID'];
$darkMode = isset($_POST['darkmode']) ? (int)$_POST['darkmode'] : 0;

// UPDATE the user's dark mode preference
$stmt = $conn->prepare("UPDATE users SET darkmode = ? WHERE HostID = ?");
$stmt->bind_param("ii", $darkMode, $HostID);
$stmt->execute();

echo "success";
?>
