<?php
session_start();
require_once "includes/db.php";

if (!isset($_SESSION['HostID'])) {
    echo "You must be logged in.";
    exit();
}

$HostID = $_SESSION['HostID'];

$stmt = $conn->prepare("
    SELECT firstname, lastname, email, contactno, bio, city, profile_picture
    FROM users 
    WHERE HostID = ?
");
$stmt->bind_param("i", $HostID);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<link rel="stylesheet" href="styles.css">

<div class="profile-container">
    <h2>Edit Profile</h2>

    <!-- PROFILE PICTURE -->
    <div class="profile-pic-box">

        <?php 
            $profilePic = (!empty($user['profile_picture'])) 
                ? "uploads/profile_pics/" . $user['profile_picture'] 
                : "profileIcon.png";
        ?>

        <img id="profilePreview" src="<?php echo $profilePic; ?>" alt="Profile Picture">

        <!-- Upload Button -->
        <label for="profilePicInput" class="upload-btn">Upload Picture</label>
        <input id="profilePicInput" type="file" accept="image/*">
    </div>

    <!-- PROFILE DETAILS -->
    <form id="updateForm" method="POST" action="api/update_profile.php">

        <label>First Name</label>
        <input type="text" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>

        <label>Last Name</label>
        <input type="text" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label>Contact Number</label>
        <input type="text" name="contactno" value="<?php echo htmlspecialchars($user['contactno']); ?>">

        <label>City</label>
        <input type="text" name="city" value="<?php echo htmlspecialchars($user['city']); ?>">

        <label>Bio</label>
        <textarea name="bio" rows="4"><?php echo htmlspecialchars($user['bio']); ?></textarea>

        <button type="submit" class="save-btn">Save Changes</button>
        <div id="message"></div>
    </form>

    <hr><br>

    <!-- PASSWORD CHANGE -->
    <h3>Change Password</h3>

    <form id="passwordForm" method="POST">
        <input type="hidden" name="password_change" value="1">

        <label>Current Password</label>
        <input type="password" name="current_password" required>

        <label>New Password</label>
        <input type="password" name="new_password" required>

        <label>Confirm New Password</label>
        <input type="password" name="confirm_password" required>

        <button type="submit" class="save-btn">Update Password</button>
        <div id="pwdMessage"></div>
    </form>
</div>

<script>
// PROFILE UPDATE
document.getElementById("updateForm").onsubmit = function(e) {
    e.preventDefault();
    let form = new FormData(this);

    fetch("api/update_profile.php", {
        method: "POST",
        body: form
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById("message").innerHTML = `<p class='success-msg'>${data}</p>`;
    });
};

// PASSWORD UPDATE
document.getElementById("passwordForm").onsubmit = function(e) {
    e.preventDefault();
    let form = new FormData(this);

    fetch("api/update_profile.php", {
        method: "POST",
        body: form
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById("pwdMessage").innerHTML = `<p class='success-msg'>${data}</p>`;
    });
};

// PROFILE PICTURE UPLOAD (silent)
document.getElementById("profilePicInput").addEventListener("change", function (e) {
    e.preventDefault();
    
    let file = this.files[0];
    if (!file) return false;

    let form = new FormData();
    form.append("profile_picture", file);

    fetch("api/upload_profile_picture.php", {
        method: "POST",
        body: form
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            document.getElementById("profilePreview").src = data.url + "?v=" + Date.now();
        }
    })
    .catch(err => console.error(err));

    return false;
});
</script>
