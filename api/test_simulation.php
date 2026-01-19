<?php
// CLI simulation for registration -> verify_otp flow
// This script does NOT send email or connect to the DB; it mimics logic to verify user_type handling.

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Simulate incoming POST from participant or host form
$simulate = [
    'firstname' => 'Sim',
    'lastname'  => 'User',
    'email'     => 'sim.user+test@example.com',
    'contactno' => '09123456789',
    'password'  => 'Password123',
    // change to 'host' to simulate host registration
    'role'      => 'host'
];

// ---- register.php logic (trimmed, without mail send) ----
$firstname = trim($simulate['firstname']);
$lastname  = trim($simulate['lastname']);
$email     = trim($simulate['email']);
$contactno = trim($simulate['contactno']);
$password  = trim($simulate['password']);
$user_type = trim($simulate['role'] ?? 'participant');
$user_type = strtolower($user_type);
if (!in_array($user_type, ['participant', 'host'])) {
    $user_type = 'participant';
}

// basic validations (same as register.php)
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "INVALID EMAIL\n";
    exit(1);
}
if (!preg_match('/^09\d{9}$/', $contactno)) {
    echo "INVALID CONTACT\n";
    exit(1);
}
$uppercase = preg_match("@[A-Z]@", $password);
$lowercase = preg_match("@[a-z]@", $password);
$number    = preg_match("@[0-9]@", $password);
if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
    echo "WEAK PASSWORD\n";
    exit(1);
}

$otp = rand(100000, 999999);

// store pending user in session (mimic register.php)
$_SESSION['pending_user'] = [
    'firstname' => $firstname,
    'lastname'  => $lastname,
    'email'     => $email,
    'contactno' => $contactno,
    'password'  => password_hash($password, PASSWORD_DEFAULT),
    'profile_picture' => 'default_profile.jpg',
    'user_type' => $user_type,
    'otp' => $otp,
    'expires' => time() + 300
];

echo "[SIM] Registration validated — OTP generated and stored in session.\n";
echo "[SIM] Pending user: \n";
print_r($_SESSION['pending_user']);

// ---- verify_otp.php logic (trimmed, without DB) ----
$inputOTP = (string)$otp; // simulate user entering correct OTP
$stored   = $_SESSION['pending_user'];

if (time() > ($stored['expires'] ?? 0)) {
    echo "[SIM] OTP expired\n";
    exit(1);
}
if ($inputOTP != ($stored['otp'] ?? '')) {
    echo "[SIM] INVALID OTP\n";
    exit(1);
}

$user_type = $stored['user_type'] ?? 'participant';

// Show the INSERT statement that would be executed (parameters)
$insertSql = "INSERT INTO users (firstname, lastname, email, contactno, password, profile_picture, user_type) VALUES (?, ?, ?, ?, ?, ?, ?)";
$params = [
    $stored['firstname'],
    $stored['lastname'],
    $stored['email'],
    $stored['contactno'],
    $stored['password'],
    $stored['profile_picture'],
    $user_type
];

echo "[SIM] OTP verified — user will be inserted with the following SQL and parameters:\n";
echo $insertSql . "\n";
echo "[SIM] Params:\n";
print_r($params);

echo "[SIM] user_type -> " . $user_type . "\n";

// end
exit(0);
?>
