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
$userQuery = $conn->prepare("SELECT firstname, lastname, email FROM users WHERE HostID = ?");
$userQuery->bind_param("i", $HostID);
$userQuery->execute();
$userResult = $userQuery->get_result();
$userData = $userResult->fetch_assoc();

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

    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>

<div class="container">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="profile-section">
            <div class="profile-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="8" r="4" stroke="white" stroke-width="2"/>
                    <path d="M6 21C6 17.134 8.686 14 12 14C15.314 14 18 17.134 18 21"
                        stroke="white" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>

            <h1 class="profile-name">
                <?php echo htmlspecialchars($userData['firstname'] . " " . $userData['lastname']); ?>
            </h1>

            <p class="profile-email">
                <?php echo htmlspecialchars($userData['email']); ?>
            </p>
        </div>

        <nav class="nav-menu">
            <a href="#" class="nav-item active">Home</a>
            <a href="#" class="nav-item">Profile</a>
            <a href="#" class="nav-item">Hosted events</a>
            <a href="#" class="nav-item">Messages</a>
            <a href="#" class="nav-item">Ratings</a>
            <a href="#" class="nav-item">Settings</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">

        <div class="header">
            <div class="events-header">
                <h2 class="events-title">Events</h2>

                <button class="create-event-btn" id="openPopupBtn">
                    <span class="plus-icon">+</span>
                    Create Event
                </button>
            </div>

            <div class="search-section">
                <!-- FIXED: added ID -->
                <input type="text" id="searchInput" class="search-input" placeholder="Search event">
            </div>
        </div>

        <div class="pinned-section">
            <h3 class="pinned-title">Your Events</h3>

            <!-- FIXED: added eventContainer ID -->
            <div class="events-grid" id="eventContainer">

                <?php if ($events->num_rows > 0): ?>
                  <?php while ($row = $events->fetch_assoc()): ?>

    <?php
        // Correctly compute BEFORE using it
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
    </main>
</div>

<!-- POPUPS BELOW (unchanged) -->
<!-- Create Event Popup -->
<div class="popup-overlay" id="popupOverlay">
    <div class="popup-box">
        <h2 class="popup-title">Create Event</h2>

        <form action="create_event.php" method="POST" class="popup-form">

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

<!-- EDIT EVENT POPUP -->
<div class="popup-overlay" id="editPopupOverlay">
    <div class="popup-box">

        <h2 class="popup-title">Update Event</h2>

        <form action="UpdateEvent.php" method="POST" class="popup-form">

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

<script>
// Create popup
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
    if (e.target === popupOverlay) popupOverlay.style.display = "none";
});
</script>

<script>
function confirmDelete(eventId) {
    if (confirm("Are you sure you want to delete this event?")) {
        window.location.href = "DeleteEvent.php?id=" + eventId;
    }
}
</script>
<script>
(function(){
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

        // Determine status text + class
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


    // fetch exact-match results. cache-buster added to avoid browser caching.
    function fetchEventsExact(searchTerm = '') {
        const url = "SearchEvent.php?search=" + encodeURIComponent(searchTerm) + "&_=" + Date.now();
        fetch(url)
            .then(resp => resp.json())
            .then(json => {
                // If the server returns an error object, log it
                if (json && json.error) {
                    console.warn("SearchEvent.php returned error:", json);
                    renderEvents([]);
                    return;
                }
                renderEvents(json);
            })
            .catch(err => {
                console.error("Search fetch failed:", err);
                renderEvents([]);
            });
    }

    // initial load => show all events
    fetchEventsExact();

    // exact-match only when user presses Enter
    input.addEventListener('keydown', function(e){
        if (e.key === 'Enter') {
            e.preventDefault();
            const q = input.value.trim();
            fetchEventsExact(q);
        }
    });
})();
</script>

<script>
// OPEN EDIT POPUP (FULLY WORKING)
function openEditPopup(eventId) {

    // Call backend to retrieve event info
    fetch("get_event.php?id=" + eventId)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert("Error loading event data.");
                return;
            }

            // Fill form fields
            document.getElementById("edit_event_id").value = data.id;
            document.getElementById("edit_name").value = data.name;
            document.getElementById("edit_description").value = data.description;
            document.getElementById("edit_capacity").value = data.capacity;
            document.getElementById("edit_event_date").value = data.event_date;
            document.getElementById("edit_event_time").value = data.event_time;
            document.getElementById("edit_location").value = data.location;
            document.getElementById("edit_status").value = data.status;

            // Show popup
            document.getElementById("editPopupOverlay").style.display = "flex";
        })
        .catch(err => {
            console.error("Fetch error:", err);
        });
}

function closeEditPopup() {
    document.getElementById("editPopupOverlay").style.display = "none";
}
</script>


</body>
</html>
