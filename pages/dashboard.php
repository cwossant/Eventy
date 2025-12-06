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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

    <!-- Local CSS -->
    <link rel="stylesheet" href="../assets/css/Mainboard.css">

    <style>
        /* Table styling */
        
        #eventsTable {
            position: absolute;
            top: calc(50px + 50px + 40px + 40px);
            /* leave space for search bar */
            left: calc(400px + 30px);
            max-width: 800px;
            width: 100%;
            border-collapse: collapse;
            font-family: "Source Sans 3", sans-serif;
        }
        
        #eventsTable th,
        #eventsTable td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        
        #eventsTable th {
            background-color: #6F42C7;
            color: white;
        }
        
        #eventsTable tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        
        #eventsTable tr:hover {
            background-color: #e0d4f7;
        }
        /* Modal styling */
        
        .modal {
            display: none;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        
        .modal-content {
            background: white;
            padding: 20px;
            width: 500px;
            border-radius: 10px;
            font-family: "Source Sans 3", sans-serif;
            border: 2px solid #6F42C7;
        }
        
        .modal-content input,
        .modal-content textarea {
            width: 100%;
            margin: 5px 0 15px 0;
            padding: 8px;
            border-radius: 5px;
            border: 2px solid #6F42C7;
        }
        
        .modal-content button {
            padding: 10px 15px;
            margin-right: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .confirm-btn {
            background: green;
            color: white;
            border: 2px solid #6F42C7;
        }
        
        .cancel-btn {
            background: red;
            color: white;
            border: 2px solid #6F42C7;
        }
    </style>
</head>

<body>

    <button id="openEventBtn" class="floating-btn"> +Add Event</button>

    <!-- Sidebar -->
    <div id="profile-bg">
        <img id="Icon" src="../assets/images/profileIcon.png" alt="Profile Icon">
        <h1>USER</h1>
    </div>

    <!-- Overlay Label + Search -->
    <div id="events-header">
        <h2 id="events-label">Events</h2>
        <input type="text" id="searchInput" placeholder="Search events...">
    </div>

    <!-- Events Table -->
    <table id="eventsTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Capacity</th>
                <th>Date</th>
                <th>Time</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="eventsTableBody"></tbody>
    </table>

    <!-- Add Event Modal -->
    <div id="eventModal" class="modal">
        <div class="modal-content">
            <h2>Add Event</h2>
            <form id="eventForm">
                <label>Name</label>
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
                <button type="submit" class="confirm-btn">Confirm Event</button>
                <button type="button" id="closeEventBtn" class="cancel-btn">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Update Event Modal -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <h2>Update Event</h2>
            <form id="updateForm">
                <input type="hidden" name="id">
                <label>Name</label>
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
                <button type="submit" class="confirm-btn">Confirm Changes</button>
                <button type="button" id="closeUpdateBtn" class="cancel-btn">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        const tableBody = document.getElementById("eventsTableBody");
        const eventModal = document.getElementById("eventModal");
        const updateModal = document.getElementById("updateModal");
        const openBtn = document.getElementById("openEventBtn");
        const closeBtn = document.getElementById("closeEventBtn");
        const closeUpdateBtn = document.getElementById("closeUpdateBtn");
        const eventForm = document.getElementById("eventForm");
        const updateForm = document.getElementById("updateForm");
        const searchInput = document.getElementById("searchInput");

        // Open/close modals
        openBtn.onclick = () => eventModal.style.display = "flex";
        closeBtn.onclick = () => eventModal.style.display = "none";
        closeUpdateBtn.onclick = () => updateModal.style.display = "none";
        window.onclick = e => {
            if (e.target === eventModal) eventModal.style.display = "none";
            if (e.target === updateModal) updateModal.style.display = "none";
        };

        // Append event to table
        function appendEvent(event) {
            const row = document.createElement("tr");
            row.dataset.id = event.id;
            row.innerHTML = `
                <td>${event.name}</td>
                <td>${event.description}</td>
                <td>${event.capacity}</td>
                <td>${event.event_date}</td>
                <td>${event.event_time}</td>
                <td>${event.location}</td>
                <td>
                    <button class="update-btn">✏️</button>
                    <button class="delete-btn">❌</button>
                </td>
            `;
            tableBody.appendChild(row);
        }

        // Load all events
        function loadEvents(query = "") {
            fetch(`/Eventy/src/php/search_events.php?search=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(events => {
                    tableBody.innerHTML = "";
                    events.forEach(appendEvent);
                })
                .catch(err => console.error(err));
        }

        window.addEventListener("DOMContentLoaded", () => {
            loadEvents();
        });

        // Add event
        eventForm.addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(eventForm);
            fetch('/Eventy/src/php/create_event.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        loadEvents(searchInput.value); // reload with current search filter
                        eventModal.style.display = "none";
                        eventForm.reset();
                    } else alert(data.message);
                });
        });

        // Update/Delete
        document.addEventListener('click', e => {
            const row = e.target.closest('tr');
            if (!row) return;
            const id = row.dataset.id;

            // Delete
            if (e.target.classList.contains('delete-btn')) {
                if (confirm("Are you sure you want to delete this entry?")) {
                    fetch('../src/php/delete_event.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id
                            })
                        }).then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') row.remove();
                            else alert(data.message);
                        });
                }
            }

            // Update
            if (e.target.classList.contains('update-btn')) {
                const cells = row.querySelectorAll('td');
                updateForm.id.value = id;
                updateForm.name.value = cells[0].innerText;
                updateForm.description.value = cells[1].innerText;
                updateForm.capacity.value = cells[2].innerText;
                updateForm.event_date.value = cells[3].innerText;
                updateForm.event_time.value = cells[4].innerText;
                updateForm.location.value = cells[5].innerText;

                updateModal.style.display = "flex";

                updateForm.onsubmit = function(ev) {
                    ev.preventDefault();
                    const updateData = new FormData(updateForm);
                    fetch('../src/php/update_event.php', {
                            method: 'POST',
                            body: updateData
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') {
                                loadEvents(searchInput.value);
                                updateModal.style.display = "none";
                            } else alert(data.message);
                        });
                }
            }
        });

        // Search input event
        searchInput.addEventListener("input", () => {
            loadEvents(searchInput.value);
        });
    </script>

</body>

</html>