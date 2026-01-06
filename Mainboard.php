<?php
session_start();

if (!isset($_SESSION['HostID'])) {
    header("Location: registration.php");
    exit();
}

$HostID = $_SESSION['HostID'];

// Database connection
$conn = new mysqli("localhost", "root", "", "eventy");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data
$stmt = $conn->prepare("SELECT firstname, lastname, email, city, bio, profile_picture FROM users WHERE HostID = ?");
$stmt->bind_param("i", $HostID);
$stmt->execute();
$stmt->bind_result($firstname, $lastname, $email, $city, $bio, $profilePicture);
$stmt->fetch();
$stmt->close();

// Set defaults for NULL fields
$firstname = $firstname ?? "";
$lastname = $lastname ?? "";
$city = $city ?? "";
$bio = $bio ?? "";
// Use a consistent default icon and prefer stored filename when available
$profilePicture = !empty($profilePicture) ? "uploads/profile_pics/" . $profilePicture : "uploads/profile_pics/profileicon.png";

$userData = [
    'firstname' => $firstname,
    'lastname' => $lastname,
    'email' => $email ?? ''
];

// Fetch events created by this user
$eventQuery = $conn->prepare("SELECT * FROM events WHERE HostID = ?");
$eventQuery->bind_param("i", $HostID);
$eventQuery->execute();
$events = $eventQuery->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        
        <!-- Sidebar -->
        <aside class="sidebar">
           <div class="profile-section">
        <div class="profile-icon">
            <img id="sidebarProfilePic" src="<?php echo $profilePicture; ?>" alt="Profile">
        </div>

        <!-- FIRST + LAST NAME stacked but inside same styled element -->
        <h1 class="profile-name">
            <span class="firstname"><?php echo htmlspecialchars($userData['firstname']); ?></span><br>
            <span class="lastname"><?php echo htmlspecialchars($userData['lastname']); ?></span>
        </h1>

        <!-- EMAIL stays the same -->
        <p class="profile-email">
            <?php echo htmlspecialchars($userData['email']); ?>
        </p>
    </div>

            <nav class="nav-menu">
                <a href="#" class="nav-item" data-page="home.php">Home</a>
                <a href="#" class="nav-item" data-page="profile.php">Profile</a>
                <a href="#" class="nav-item" data-page="events.php">Hosted events</a>
                <a href="#" class="nav-item" data-page="messages.php">Messages</a>
                <a href="#" class="nav-item" data-page="ratings.php">Ratings</a>
                <a href="#" class="nav-item" data-page="settings.php">Settings</a>
            </nav>

            <a href="logout.php" class="nav-item logout-btn">
                <svg width="20" height="20" fill="none" stroke="white" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round" style="margin-right:10px;">
                    <path d="M9 3H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Sign Out
            </a>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Profile Tab (Hidden by default) -->
            <div id="profileTab" class="tab-content" style="display:none;">
                <div class="profile-container">
                    <div class="profile-header">Your Profile</div>

                    <div class="profile-flex">
                        <!-- Profile Picture -->
                        <div class="profile-picture-box">
                            <img id="profilePicImg" src="<?= $profilePicture ?>" alt="Profile Picture">
                            <form id="uploadForm" enctype="multipart/form-data" onsubmit="return false;">
                                <input id="profile_picture" type="file" name="profile_picture" accept="image/*" required>
                                <button type="button" id="uploadPicBtn" class="upload-btn">Upload Picture</button>
                            </form>
                        </div>

                        <!-- Profile Fields -->
                        <div class="profile-fields">
                            <form id="profileForm">
                                <label>First Name</label>
                                <input type="text" name="firstname" value="<?= htmlspecialchars($firstname) ?>">

                                <label>Last Name</label>
                                <input type="text" name="lastname" value="<?= htmlspecialchars($lastname) ?>">

                                <label>City</label>
                                <input type="text" name="city" value="<?= htmlspecialchars($city) ?>">

                                <label>Bio</label>
                                <textarea name="bio"><?= htmlspecialchars($bio) ?></textarea>

                                <div class="profile-actions">
                                    <button type="button" id="saveProfileBtn" class="btn-primary">Save Changes</button>
                                    <button type="button" class="btn-secondary" onclick="alert('Changes Discarded!')">Discard Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Events Header -->
            <div class="header">
                <div class="events-header">
                    <h2 class="events-title">Events</h2>
                    <button class="create-event-btn" id="openPopupBtn">
                        <span class="plus-icon">+</span>
                        Create Event
                    </button>
                </div>

                <div class="search-section">
                    <input type="text" id="searchInput" class="search-input" placeholder="Search event">
                </div>
            </div>

            <!-- Events Grid -->
            <div class="pinned-section">
                <h3 class="pinned-title">Your Events</h3>

                <div class="events-grid" id="eventContainer">
                    <?php if ($events->num_rows > 0): ?>
                        <?php while ($row = $events->fetch_assoc()): ?>
                            <?php
                                $eventClass = $row["status"] == 1 ? "event-upcoming" : "event-finished";
                                $statusText = $row["status"] == 1 ? "Upcoming" : "Finished";
                            ?>
                            <div class="event-card <?php echo $eventClass; ?>">
                                <div class="event-info">
                                    <h4><?php echo htmlspecialchars($row['name']); ?></h4>
                                    <p>
                                        <?php
                                            $desc = htmlspecialchars($row['description']);
                                            echo strlen($desc) > 100 ? substr($desc, 0, 100) . "..." : $desc;
                                        ?>
                                    </p>
                                    <p><strong>Capacity:</strong> <?php echo htmlspecialchars($row['capacity']); ?></p>
                                    <p><strong>Event Date:</strong> <?php echo htmlspecialchars($row['event_date']); ?></p>
                                    <p><strong>Event Time:</strong> <?php echo htmlspecialchars($row['event_time']); ?></p>
                                    <p><strong>Status:</strong> <?php echo $statusText; ?></p>
                                </div>

                                <div class="event-actions">
                                    <button class="edit-btn" onclick="openEditPopup(<?php echo $row['id']; ?>)">✏️</button>
                                    <button class="delete-btn" onclick="confirmDelete(<?php echo $row['id']; ?>)">❌</button>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="no-events">No events created yet.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- =============================== SETTINGS CONTAINER =============================== -->
            <div id="settingsContainer" style="display:none;">

                <div class="settings-card">
                    <h2>Account Settings</h2>

                    <!-- ===== CHANGE PASSWORD ===== -->
                    <div class="settings-group">
                        <h3>Change Password</h3>

                        <form id="changePasswordForm" method="POST">
                            <div class="form-row">
                                <label>Current Password</label>
                                <input type="password" name="current_password" required>
                            </div>

                            <div class="form-row">
                                <label>New Password</label>
                                <input type="password" name="new_password" required>
                            </div>

                            <div class="form-row">
                                <label>Confirm New Password</label>
                                <input type="password" name="confirm_password" required>
                            </div>

                            <button type="button" id="savePasswordBtn" class="btn-primary">
                                Save Password
                            </button>

                            <p id="passwordMessage" class="settings-message"></p>
                        </form>

                    </div>

                    <!-- ===== DARK MODE ===== -->
                    <div class="settings-group">
                        <h3>Display</h3>

                        <label class="darkmode-option">
                            <input type="checkbox" id="darkModeToggle">
                            <span class="darkmode-circle"></span>
                            <span>Dark Mode</span>
                        </label>
                    </div>

                    <!-- ===== LANGUAGE ===== -->
                    <div class="settings-group">
                        <h3>Language</h3>

                        <div class="form-row">
                            <select id="languageSelect">
                                <option value="english">English</option>
                                <option value="tagalog">Tagalog</option>
                            </select>
                        </div>

                        <button type="button" id="saveLanguageBtn" class="btn-primary">
                            Save Language
                        </button>

                        <p id="languageMessage" class="settings-message"></p>
                    </div>

                </div>


                <!-- OTP PASSWORD MODAL -->
                <div id="otpPassword" class="modal-overlay" style="display:none; align-items:center; justify-content:center;">
                    <div class="modal-box">
                        <h2>Enter OTP</h2>
                        <p>We've sent a 6-digit verification code to your email.</p>

                        <input type="text" id="otpPasswordInput" maxlength="6" placeholder="Enter OTP">

                        <p id="otpPasswordError" style="color:red;"></p>

                        <button id="verifyOtpPasswordBtn" class="btn-primary">
                            Verify OTP
                        </button>
                    </div>
                </div>

            </div>

            <script>

            /* ===============================
            SAVE NEW PASSWORD
            =============================== */
            document.getElementById("savePasswordBtn").addEventListener("click", function () {

                const form = new FormData(document.getElementById("changePasswordForm"));
                form.append("action", "change_password");

                fetch("api/update_settings.php", {
                    method: "POST",
                    body: form
                })
                .then(r => r.json())
                .then(data => {

                    const msg = document.getElementById("passwordMessage");

                    if (data.status === "otp_sent") {

                        msg.textContent = "";
                        document.getElementById("otpPassword").style.display = "flex";

                    } else {
                        msg.style.color = "red";
                        msg.textContent = data.message || "Failed to send OTP.";
                    }
                })
                .catch(err => {
                    console.log("JSON parse error:", err);
                });
            });


            /* ===============================
            VERIFY PASSWORD OTP
            =============================== */
            document.getElementById("verifyOtpPasswordBtn").addEventListener("click", function () {

                const otp = document.getElementById("otpPasswordInput").value;

                fetch("api/verify_password_otp.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "otp=" + encodeURIComponent(otp)
                })
                .then(r => r.json())
                .then(data => {

                    const msg = document.getElementById("passwordMessage");

                    if (data.status === "success") {

                        msg.style.color = "green";
                        msg.textContent = "Password updated successfully.";

                        document.getElementById("otpPassword").style.display = "none";
                        document.getElementById("otpPasswordError").textContent = "";
                        document.getElementById("otpPasswordInput").value = "";

                    } else {

                        document.getElementById("otpPasswordError").textContent = data.message;
                    }
                })
                .catch(err => {
                    console.log("Error verifying OTP", err);
                });
            });


            /* ===============================
            SAVE LANGUAGE
            =============================== */
            document.getElementById("saveLanguageBtn").addEventListener("click", function () {

                const lang = document.getElementById("languageSelect").value;

                fetch("api/update_settings.php", {
                    method: "POST",
                    body: new URLSearchParams({ language: lang })
                })
                .then(res => res.json())
                .then(data => {

                    const msg = document.getElementById("languageMessage");

                    msg.style.color = data.status === "success" ? "green" : "red";
                    msg.textContent = data.status === "success" ? "Language updated." : "Failed to update language.";
                });
            });


            /* ===============================
            DARK MODE TOGGLE
            =============================== */
            document.getElementById("darkModeToggle").addEventListener("change", function () {

                const darkMode = this.checked ? 1 : 0;

                document.body.classList.toggle("dark-mode", darkMode === 1);

                fetch("api/update_settings.php", {
                    method: "POST",
                    body: new URLSearchParams({ darkmode: darkMode })
                });
            });

            </script>


        </main>
    </div>

    <!-- Create Event Popup -->
    <div class="popup-overlay" id="popupOverlay">
        <div class="popup-box">
            <h2 class="popup-title">Create Event</h2>

            <form action="api/create_event.php" method="POST" class="popup-form">
                <label>Event Name</label>
                <input type="text" name="name" required>

                <label>Description</label>
                <textarea name="description" required></textarea>

                <label>Capacity</label>
                <input type="number" name="capacity" required>

                <label>Date</label>
                <input type="date" name="event_date" required>

                <label>Time</label>
                <input type="time" name="event_time" required>

                <label>Location</label>
                <input type="text" name="location" required>

                <label>Status</label>
                <select name="status" required>
                    <option value="1">Upcoming</option>
                    <option value="0">Finished</option>
                </select>

                <div class="popup-buttons">
                    <button type="submit" class="confirm-btn">Create</button>
                    <button type="button" class="cancel-btn" id="closePopupBtn">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Event Popup -->
    <div class="popup-overlay" id="editPopupOverlay">
        <div class="popup-box">
            <h2 class="popup-title">Update Event</h2>

            <form action="api/UpdateEvent.php" method="POST" class="popup-form">
                <input type="hidden" name="id" id="edit_event_id">

                <label>Event Name</label>
                <input type="text" name="name" id="edit_name" required>

                <label>Description</label>
                <textarea name="description" id="edit_description" required></textarea>

                <label>Capacity</label>
                <input type="number" name="capacity" id="edit_capacity" required>

                <label>Date</label>
                <input type="date" name="event_date" id="edit_event_date" required>

                <label>Time</label>
                <input type="time" name="event_time" id="edit_event_time" required>

                <label>Location</label>
                <input type="text" name="location" id="edit_location" required>

                <label>Status</label>
                <select name="status" id="edit_status" required>
                    <option value="1">Upcoming</option>
                    <option value="0">Finished</option>
                </select>

                <div class="popup-buttons">
                    <button type="submit" class="confirm-btn">Update</button>
                    <button type="button" class="cancel-btn" onclick="closeEditPopup()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast"></div>

    <!-- JavaScript -->
    <script>
        // ===== POPUP MANAGEMENT =====
        const openPopup = document.getElementById("openPopupBtn");
        const closePopup = document.getElementById("closePopupBtn");
        const popupOverlay = document.getElementById("popupOverlay");

        openPopup.addEventListener("click", () => {
            popupOverlay.style.display = "flex";
        });

        closePopup.addEventListener("click", () => {
            popupOverlay.style.display = "none";
        });

        popupOverlay.addEventListener("click", (e) => {
            if (e.target === popupOverlay) {
                popupOverlay.style.display = "none";
            }
        });

        // ===== DELETE EVENT =====
        function confirmDelete(eventId) {
            if (confirm("Are you sure you want to delete this event?")) {
                window.location.href = "api/DeleteEvent.php?id=" + eventId;
            }
        }

        // ===== EDIT EVENT POPUP =====
        function openEditPopup(eventId) {
            fetch("api/get_event.php?id=" + eventId)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert("Error loading event data.");
                        return;
                    }

                    document.getElementById("edit_event_id").value = data.id;
                    document.getElementById("edit_name").value = data.name;
                    document.getElementById("edit_description").value = data.description;
                    document.getElementById("edit_capacity").value = data.capacity;
                    document.getElementById("edit_event_date").value = data.event_date;
                    document.getElementById("edit_event_time").value = data.event_time;
                    document.getElementById("edit_location").value = data.location;
                    document.getElementById("edit_status").value = data.status;

                    document.getElementById("editPopupOverlay").style.display = "flex";
                })
                .catch(err => {
                    console.error("Fetch error:", err);
                    if (typeof showToast === 'function') showToast('Failed to load event data', '#dc2626');
                });
        }

        function closeEditPopup() {
            document.getElementById("editPopupOverlay").style.display = "none";
        }

        // ===== SEARCH FUNCTIONALITY =====
        (function() {
            const input = document.getElementById("searchInput");
            const container = document.getElementById("eventContainer");

            if (!input || !container) {
                console.error("Search: missing elements (searchInput or eventContainer)");
                return;
            }

            function escapeHtml(str) {
                if (str === null || str === undefined) return '';
                return String(str)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }

            function renderEvents(events) {
                container.innerHTML = "";

                if (!events || events.length === 0) {
                    container.innerHTML = "<p class='no-events'>No events found.</p>";
                    return;
                }

                events.forEach(event => {
                    let statusText = event.status == 1 ? "Upcoming" : "Finished";
                    let eventClass = event.status == 1 ? "event-upcoming" : "event-finished";
                    let desc = event.description ? event.description.substring(0, 100) : "";

                    container.innerHTML += `
                        <div class="event-card ${eventClass}">
                            <div class="event-info">
                                <h4>${escapeHtml(event.name)}</h4>
                                <p>${escapeHtml(desc)}${event.description && event.description.length > 100 ? "..." : ""}</p>
                                <p><strong>Capacity:</strong> ${escapeHtml(event.capacity)}</p>
                                <p><strong>Event Date:</strong> ${escapeHtml(event.event_date)}</p>
                                <p><strong>Event Time:</strong> ${escapeHtml(event.event_time)}</p>
                                <p><strong>Status:</strong> ${statusText}</p>
                            </div>

                            <div class="event-actions">
                                <button class="edit-btn" onclick="openEditPopup(${event.id})">✏️</button>
                                <button class="delete-btn" onclick="confirmDelete(${event.id})">❌</button>
                            </div>
                        </div>
                    `;
                });
            }

            function fetchEventsExact(searchTerm = '') {
                const url = "SearchEvent.php?search=" + encodeURIComponent(searchTerm) + "&_=" + Date.now();
                fetch(url)
                    .then(resp => resp.json())
                    .then(json => {
                        if (json && json.error) {
                            console.warn("SearchEvent.php returned error:", json);
                            renderEvents([]);
                            return;
                        }
                        renderEvents(json);
                    })
                    .catch(err => {
                        console.error("Search fetch failed:", err);
                        if (typeof showToast === 'function') showToast('Search failed', '#dc2626');
                        renderEvents([]);
                    });
            }

            fetchEventsExact();

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const q = input.value.trim();
                    fetchEventsExact(q);
                }
            });
        })();

        // ===== NAVIGATION =====
        (function() {
            const profileTab = document.getElementById('profileTab');
            const settingsContainer = document.getElementById('settingsContainer');
            const eventsHeader = document.querySelector('.events-header');
            const pinnedSection = document.querySelector('.pinned-section');
            const searchSection = document.querySelector('.search-section');

            document.querySelectorAll('.nav-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    const text = this.textContent.trim().toLowerCase();

                    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
                    this.classList.add('active');

                    // Hide both profile and settings by default
                    profileTab.style.display = 'none';
                    if (settingsContainer) settingsContainer.style.display = 'none';

                    if (text === 'profile') {
                        e.preventDefault();
                        eventsHeader.style.display = 'none';
                        pinnedSection.style.display = 'none';
                        searchSection.style.display = 'none';
                        profileTab.style.display = 'block';
                    } else if (text === 'settings') {
                        e.preventDefault();
                        eventsHeader.style.display = 'none';
                        pinnedSection.style.display = 'none';
                        searchSection.style.display = 'none';
                        if (settingsContainer) settingsContainer.style.display = 'block';
                    } else {
                        // default: show events view
                        eventsHeader.style.display = 'flex';
                        pinnedSection.style.display = 'block';
                        searchSection.style.display = 'block';
                    }
                });
            });
        })();

        // ===== PROFILE PICTURE PREVIEW =====
        document.getElementById("profile_picture").addEventListener("change", function() {
            const file = this.files[0];
            if (!file) return;

            const preview = document.getElementById("profilePicImg");
            const objectURL = URL.createObjectURL(file);
            preview.src = objectURL;

            preview.onload = () => {
                URL.revokeObjectURL(objectURL);
            };
        });

        // ===== PROFILE PICTURE UPLOAD =====
        document.getElementById("uploadPicBtn").addEventListener("click", () => {
            const fileInput = document.getElementById("profile_picture");
            const file = fileInput.files[0];

            if (!file) {
                alert("Please choose an image first.");
                return;
            }

            let formData = new FormData();
            formData.append("profile_picture", file);

            fetch("api/upload_profile_picture.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
                .then(data => {
                    if (data.error) {
                        // show error toast
                        if (typeof showToast === 'function') showToast(data.error, '#dc2626');
                        else alert(data.error);
                        return;
                    }

                    const timestamp = "?v=" + Date.now();
                    document.getElementById("profilePicImg").src = data.newPath + timestamp;

                    const sidebarPic = document.getElementById("sidebarProfilePic");
                    if (sidebarPic) {
                        sidebarPic.src = data.newPath + timestamp;
                    }

                    const navPic = document.getElementById("navProfilePic");
                    if (navPic) {
                        navPic.src = data.newPath + timestamp;
                    }

                    // show success toast and temporary message
                    if (typeof showToast === 'function') showToast('Profile picture updated!', '#16a34a');
                    const msg = document.createElement("p");
                    msg.textContent = "Profile picture updated!";
                    msg.classList.add("upload-success-msg");
                    document.querySelector(".profile-picture-box").appendChild(msg);
                    setTimeout(() => msg.remove(), 2000);

                    // Reload page shortly after showing success message so updated image is used everywhere
                    setTimeout(() => { location.reload(); }, 1500);
                })
            .catch(err => {
                console.error(err);
                if (typeof showToast === 'function') showToast('Upload error', '#dc2626');
                else alert("Upload error");
            });
        });

       // ===== SAVE PROFILE =====
document.getElementById("saveProfileBtn").addEventListener("click", function () {
    let formData = new FormData(document.getElementById("profileForm"));

    fetch("api/update_profile.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {

        if (data.status === "success") {

            // Update FIRST NAME (inside span)
            const fn = document.querySelector(".firstname");
            if (fn) fn.textContent = data.firstname;

            // Update LAST NAME (inside span)
            const ln = document.querySelector(".lastname");
            if (ln) ln.textContent = data.lastname;

            // Update EMAIL
            const em = document.querySelector(".profile-email");
            if (em) em.textContent = data.email;
            // show success toast
            if (typeof showToast === 'function') showToast('Profile updated', '#16a34a');
        }
    });
});

        // ===== TOAST NOTIFICATION =====
        function showToast(msg, color) {
            const toast = document.getElementById("toast");
            toast.innerText = msg;
            toast.style.background = color;
            toast.style.display = "block";

            setTimeout(() => {
                toast.style.display = "none";
            }, 2500);
        }
    </script>
    
    <script>
        // Load dark mode setting on page load
        fetch("api/get_settings.php")
            .then(res => res.json())
            .then(settings => {
                if (settings.darkmode == 1) {
                    document.body.classList.add("dark-mode");
                    document.getElementById("darkModeToggle").checked = true;
                }
            })
            .catch(err => console.error("Error loading settings:", err));
    </script>

</body>
</html>