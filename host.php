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
$profilePicture = !empty($profilePicture) ? "uploads/profile_pics/" . $profilePicture : "uploads/profile_pics/default_profile.jpg";

$userData = [
    'firstname' => $firstname,
    'lastname' => $lastname,
    'email' => $email ?? ''
];

// Fetch events created by this user
$eventQuery = $conn->prepare("SELECT * FROM events WHERE HostID = ? ORDER BY event_date DESC");
$eventQuery->bind_param("i", $HostID);
$eventQuery->execute();
$eventsResult = $eventQuery->get_result();
$events = [];
while ($row = $eventsResult->fetch_assoc()) {
    $events[] = $row;
}
$eventQuery->close();

// Calculate statistics
$totalEvents = count($events);
$upcomingEvents = 0;
$finishedEvents = 0;
$totalAttendees = 0;
$totalCapacity = 0;

foreach ($events as $event) {
    if ($event['status'] == 1) {
        $upcomingEvents++;
    } else {
        $finishedEvents++;
    }
    $totalAttendees += ($event['attendees'] ?? 0);
    $totalCapacity += ($event['capacity'] ?? 0);
}

$attendanceRate = $totalCapacity > 0 ? round(($totalAttendees / $totalCapacity) * 100) : 0;

// Fetch event categories
$categoryQuery = $conn->prepare("SELECT id, name FROM event_categories ORDER BY id ASC");
$categoryQuery->execute();
$categoriesResult = $categoryQuery->get_result();
$categories = [];
while ($row = $categoriesResult->fetch_assoc()) {
    $categories[] = $row;
}
$categoryQuery->close();

// Close connection (will reopen for specific queries if needed)
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Eventy</title>
    <link rel="stylesheet" href="assets/css/host-dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="dashboard-container">
        
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-calendar-check"></i>
                    <span>Eventy</span>
                </div>
            </div>

            <div class="profile-section">
                <div class="profile-avatar">
                    <img src="<?php echo $profilePicture; ?>" alt="Profile">
                </div>
                <h2 class="profile-name"><?php echo htmlspecialchars($firstname . " " . $lastname); ?></h2>
                <p class="profile-email"><?php echo htmlspecialchars($email); ?></p>
                <div class="status-badge">
                    <span class="status-dot"></span>
                    Active
                </div>
            </div>

            <nav class="sidebar-nav">
                <button class="nav-item active" data-tab="dashboard">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </button>
                <button class="nav-item" data-tab="profile">
                    <i class="fas fa-user-circle"></i>
                    <span>Profile</span>
                </button>
                <button class="nav-item" data-tab="events">
                    <i class="fas fa-calendar"></i>
                    <span>Events</span>
                    <span class="badge"><?php echo $totalEvents; ?></span>
                </button>
                <button class="nav-item" data-tab="analytics">
                    <i class="fas fa-bar-chart"></i>
                    <span>Analytics</span>
                </button>
                <button class="nav-item" data-tab="settings">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </button>
                <button class="nav-item" data-tab="export">
                    <i class="fas fa-download"></i>
                    <span>Export</span>
                </button>
            </nav>

            <a href="logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sign Out</span>
            </a>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- DASHBOARD TAB (Home/Overview) -->
            <section id="dashboard-tab" class="tab-content active">
                <div class="page-header">
                    <div>
                        <h1>Welcome back, <?php echo htmlspecialchars($firstname); ?>!</h1>
                        <p class="subtitle">Here's your event management overview</p>
                    </div>
                    <button class="btn-create-event" id="openCreateEventBtn">
                        <i class="fas fa-plus"></i>
                        Create Event
                    </button>
                </div>

                <!-- STATS GRID -->
                <div class="stats-grid">
                    <div class="stat-card stat-total">
                        <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                        <div class="stat-content">
                            <h3><?php echo $totalEvents; ?></h3>
                            <p>Total Events</p>
                        </div>
                        <div class="stat-trend">↑</div>
                    </div>

                    <div class="stat-card stat-upcoming">
                        <div class="stat-icon"><i class="fas fa-hourglass-start"></i></div>
                        <div class="stat-content">
                            <h3><?php echo $upcomingEvents; ?></h3>
                            <p>Upcoming</p>
                        </div>
                        <div class="stat-trend">→</div>
                    </div>

                    <div class="stat-card stat-finished">
                        <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-content">
                            <h3><?php echo $finishedEvents; ?></h3>
                            <p>Completed</p>
                        </div>
                        <div class="stat-trend">✓</div>
                    </div>

                    <div class="stat-card stat-attendees">
                        <div class="stat-icon"><i class="fas fa-users"></i></div>
                        <div class="stat-content">
                            <h3><?php echo $totalAttendees; ?></h3>
                            <p>Total Attendees</p>
                        </div>
                        <div class="stat-trend">↑</div>
                    </div>
                </div>

                <!-- QUICK ACTIONS & INSIGHTS -->
                <div class="dashboard-grid">
                    <!-- Attendance Analytics -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h2>Attendance Overview</h2>
                            <span class="badge-pill"><?php echo $attendanceRate; ?>%</span>
                        </div>
                        <div class="attendance-chart">
                            <div class="chart-bar">
                                <div class="bar-fill" style="width: <?php echo $attendanceRate; ?>%;"></div>
                            </div>
                            <div class="chart-stats">
                                <span><?php echo $totalAttendees; ?> / <?php echo $totalCapacity; ?> capacity</span>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Events -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h2>Recent Events</h2>
                            <a href="#" class="see-all">View All →</a>
                        </div>
                        <div class="recent-events">
                            <?php if (!empty($events)): ?>
                                <?php foreach (array_slice($events, 0, 3) as $event): ?>
                                    <div class="recent-event-item">
                                        <div class="event-dot <?php echo $event['status'] == 1 ? 'upcoming' : 'finished'; ?>"></div>
                                        <div class="event-details">
                                            <h4><?php echo htmlspecialchars($event['name']); ?></h4>
                                            <p><?php echo htmlspecialchars($event['event_date']); ?></p>
                                        </div>
                                        <span class="attendee-count"><?php echo ($event['attendees'] ?? 0) . " attendees"; ?></span>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="empty-state">No events yet. Create your first event!</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h2>Key Metrics</h2>
                        </div>
                        <div class="metrics-list">
                            <div class="metric-row">
                                <span>Avg. Attendees per Event</span>
                                <span class="metric-value"><?php echo $totalEvents > 0 ? round($totalAttendees / $totalEvents) : 0; ?></span>
                            </div>
                            <div class="metric-row">
                                <span>Avg. Capacity Usage</span>
                                <span class="metric-value"><?php echo $attendanceRate; ?>%</span>
                            </div>
                            <div class="metric-row">
                                <span>Completion Rate</span>
                                <span class="metric-value"><?php echo $totalEvents > 0 ? round(($finishedEvents / $totalEvents) * 100) : 0; ?>%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- PROFILE TAB -->
            <section id="profile-tab" class="tab-content">
                <div class="page-header">
                    <h1>Profile Settings</h1>
                    <p class="subtitle">Manage your profile and visibility</p>
                </div>

                <div class="profile-grid">
                    <!-- Profile Edit Card -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h2>Personal Information</h2>
                        </div>

                        <div class="profile-picture-section">
                            <img id="profilePicPreview" src="<?php echo $profilePicture; ?>" alt="Profile" class="profile-pic-large">
                            <form id="profilePicForm" enctype="multipart/form-data">
                                <input type="file" id="profilePicInput" name="profile_picture" accept="image/*" style="display:none;">
                                <button type="button" class="btn-upload" id="uploadPicBtn">
                                    <i class="fas fa-camera"></i> Change Photo
                                </button>
                            </form>
                        </div>

                        <form id="profileForm" class="profile-form">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" value="<?php echo htmlspecialchars($email); ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>">
                            </div>

                            <div class="form-group">
                                <label>Bio</label>
                                <textarea name="bio" placeholder="Tell something about yourself..." rows="4"><?php echo htmlspecialchars($bio); ?></textarea>
                            </div>

                            <div class="form-actions">
                                <button type="button" class="btn-primary" id="saveProfileBtn">Save Changes</button>
                                <button type="reset" class="btn-secondary">Discard</button>
                            </div>
                        </form>
                    </div>

                    <!-- Profile Visibility Card -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h2>Profile Visibility</h2>
                        </div>

                        <div class="visibility-section">
                            <div class="visibility-item">
                                <div class="visibility-content">
                                    <h3>Public Profile</h3>
                                    <p>Let others view your profile and events</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="publicProfileToggle" class="toggle-input">
                                    <label for="publicProfileToggle" class="toggle-label"></label>
                                </div>
                            </div>

                            <div class="visibility-item">
                                <div class="visibility-content">
                                    <h3>Show Bio</h3>
                                    <p>Display your bio on your profile</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="showBioToggle" class="toggle-input" checked>
                                    <label for="showBioToggle" class="toggle-label"></label>
                                </div>
                            </div>

                            <div class="visibility-item">
                                <div class="visibility-content">
                                    <h3>Show Email</h3>
                                    <p>Allow others to contact you via email</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="showEmailToggle" class="toggle-input">
                                    <label for="showEmailToggle" class="toggle-label"></label>
                                </div>
                            </div>

                            <div class="visibility-item">
                                <div class="visibility-content">
                                    <h3>Show Event Count</h3>
                                    <p>Display how many events you've hosted</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="showEventCountToggle" class="toggle-input" checked>
                                    <label for="showEventCountToggle" class="toggle-label"></label>
                                </div>
                            </div>

                            <div class="visibility-preview">
                                <h3>Profile Preview</h3>
                                <div class="preview-card">
                                    <div class="preview-avatar"></div>
                                    <h4><?php echo htmlspecialchars($firstname . " " . $lastname); ?></h4>
                                    <p class="preview-location"><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($city ?: 'Location not set'); ?></p>
                                    <p class="preview-bio" id="previewBio" style="display:none;"><?php echo htmlspecialchars(substr($bio, 0, 80)); ?></p>
                                    <p class="preview-events" id="previewEvents"><?php echo $totalEvents; ?> Events Hosted</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- EVENTS TAB -->
            <section id="events-tab" class="tab-content">
                <div class="page-header">
                    <h1>Manage Events</h1>
                    <p class="subtitle">View and manage all your hosted events</p>
                    <button class="btn-create-event" id="openCreateEventBtn2">
                        <i class="fas fa-plus"></i>
                        Create Event
                    </button>
                </div>

                <div class="events-controls">
                    <input type="text" class="search-input" id="eventSearchInput" placeholder="Search events...">
                    <select class="filter-select" id="eventStatusFilter">
                        <option value="">All Events</option>
                        <option value="upcoming">Upcoming</option>
                        <option value="finished">Finished</option>
                    </select>
                </div>

                <div class="events-grid" id="eventsContainer">
                    <?php if (!empty($events)): ?>
                        <?php foreach ($events as $event): ?>
                            <?php
                                $statusClass = $event['status'] == 1 ? 'upcoming' : 'finished';
                                $statusText = $event['status'] == 1 ? 'Upcoming' : 'Finished';
                                $attendancePercent = $event['capacity'] > 0 ? round((($event['attendees'] ?? 0) / $event['capacity']) * 100) : 0;
                                $isSoldOut = $attendancePercent >= 100;
                            ?>
                            <div class="event-card" data-event-id="<?php echo $event['id']; ?>" data-status="<?php echo $event['status'] == 1 ? 'upcoming' : 'finished'; ?>" data-name="<?php echo strtolower(htmlspecialchars($event['name'])); ?>">
                                
                                <!-- Event Image Container with Overlay -->
                                <div class="event-image-container" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <?php if (!empty($event['event_image'])): ?>
                                        <img src="uploads/events/<?php echo htmlspecialchars($event['event_image']); ?>" alt="Event" style="width: 100%; height: 100%; object-fit: cover;">
                                    <?php endif; ?>
                                    
                                    <!-- Status Badges -->
                                    <div class="event-badges">
                                        <span class="badge badge-<?php echo $statusClass; ?>">
                                            <i class="fas fa-<?php echo $statusClass === 'upcoming' ? 'hourglass-start' : 'check-circle'; ?>"></i>
                                            <?php echo $statusText; ?>
                                        </span>
                                        <?php if (!$isSoldOut): ?>
                                            <span class="badge badge-available">Available</span>
                                        <?php else: ?>
                                            <span class="badge badge-sold-out">Sold Out</span>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Action Buttons Overlay -->
                                    <div class="event-overlay-actions">
                                        <button class="btn-action edit-btn" title="Edit Event" onclick="openEditEventModal(<?php echo $event['id']; ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-action delete-btn" title="Delete Event" onclick="deleteEventConfirm(<?php echo $event['id']; ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Event Content -->
                                <div class="event-content">
                                    <h3><?php echo htmlspecialchars($event['name']); ?></h3>
                                    
                                    <p class="event-description">
                                        <?php 
                                            $desc = htmlspecialchars($event['description']);
                                            echo strlen($desc) > 100 ? substr($desc, 0, 100) . "..." : $desc;
                                        ?>
                                    </p>

                                    <!-- Event Meta Information -->
                                    <div class="event-meta">
                                        <div class="meta-item">
                                            <i class="fas fa-calendar"></i>
                                            <span><?php echo htmlspecialchars($event['event_date']); ?></span>
                                        </div>
                                        <div class="meta-item">
                                            <i class="fas fa-clock"></i>
                                            <span><?php echo date("h:i A", strtotime($event['event_time'])); ?></span>
                                        </div>
                                        <div class="meta-item">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span><?php echo htmlspecialchars($event['location']); ?></span>
                                        </div>
                                    </div>

                                    <!-- Capacity Section -->
                                    <div class="capacity-section">
                                        <div class="capacity-info">
                                            <span class="attendee-count"><i class="fas fa-users"></i> <?php echo ($event['attendees'] ?? 0) . "/" . $event['capacity']; ?></span>
                                            <span class="capacity-percent"><?php echo $attendancePercent; ?>%</span>
                                        </div>
                                        <div class="capacity-bar">
                                            <div class="bar-fill" style="width: <?php echo $attendancePercent; ?>%;"></div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="event-actions">
                                        <button class="btn-primary btn-view-details" onclick="viewEventDetails(<?php echo $event['id']; ?>)">View Details</button>
                                        <button class="btn-secondary btn-edit" onclick="openEditEventModal(<?php echo $event['id']; ?>)">Edit</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="empty-state-container">
                            <i class="fas fa-calendar-times"></i>
                            <p>No events created yet</p>
                            <button class="btn-primary" id="createEventFromEmpty">Create Your First Event</button>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

            <!-- ANALYTICS TAB -->
            <section id="analytics-tab" class="tab-content">
                <div class="page-header">
                    <h1>Event Analytics</h1>
                    <p class="subtitle">Detailed insights about your events</p>
                </div>

                <div class="analytics-grid">
                    <!-- Event Insights -->
                    <div class="analytics-card">
                        <div class="card-header">
                            <h2>Event Performance</h2>
                        </div>
                        <div class="insights-content">
                            <div class="insight-item">
                                <div class="insight-label">
                                    <i class="fas fa-arrow-up"></i>
                                    <span>Most Popular Event</span>
                                </div>
                                <div class="insight-value">
                                    <?php 
                                        $maxAttendees = 0;
                                        $popularEvent = '';
                                        foreach ($events as $event) {
                                            if (($event['attendees'] ?? 0) > $maxAttendees) {
                                                $maxAttendees = $event['attendees'] ?? 0;
                                                $popularEvent = $event['name'];
                                            }
                                        }
                                        echo $popularEvent ? htmlspecialchars($popularEvent) : 'No events';
                                    ?>
                                </div>
                            </div>

                            <div class="insight-item">
                                <div class="insight-label">
                                    <i class="fas fa-clock"></i>
                                    <span>Avg. Event Duration</span>
                                </div>
                                <div class="insight-value">
                                    <?php echo $totalEvents > 0 ? "2.5 hours" : "N/A"; ?>
                                </div>
                            </div>

                            <div class="insight-item">
                                <div class="insight-label">
                                    <i class="fas fa-star"></i>
                                    <span>Average Rating</span>
                                </div>
                                <div class="insight-value">
                                    <span class="rating">4.8 ★</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Trends -->
                    <div class="analytics-card">
                        <div class="card-header">
                            <h2>Attendance Trends</h2>
                        </div>
                        <div class="trend-chart">
                            <div class="trend-bars">
                                <div class="trend-bar" style="height: 60%;"><span>35%</span></div>
                                <div class="trend-bar" style="height: 75%;"><span>50%</span></div>
                                <div class="trend-bar" style="height: 90%;"><span>70%</span></div>
                                <div class="trend-bar" style="height: 65%;"><span>45%</span></div>
                                <div class="trend-bar" style="height: 85%;"><span>65%</span></div>
                            </div>
                            <div class="trend-labels">
                                <span>Week 1</span>
                                <span>Week 2</span>
                                <span>Week 3</span>
                                <span>Week 4</span>
                                <span>Week 5</span>
                            </div>
                        </div>
                    </div>

                    <!-- Registration Peak Times -->
                    <div class="analytics-card">
                        <div class="card-header">
                            <h2>Registration Peak Times</h2>
                        </div>
                        <div class="peak-times">
                            <div class="peak-item">
                                <span>Monday - Friday</span>
                                <span class="peak-value">2-4 PM</span>
                                <div class="peak-bar" style="width: 85%;"></div>
                            </div>
                            <div class="peak-item">
                                <span>Saturday - Sunday</span>
                                <span class="peak-value">10 AM - 12 PM</span>
                                <div class="peak-bar" style="width: 65%;"></div>
                            </div>
                            <div class="peak-item">
                                <span>Evening (6-9 PM)</span>
                                <span class="peak-value">High Engagement</span>
                                <div class="peak-bar" style="width: 75%;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Geographic Distribution (Mockup) -->
                    <div class="analytics-card">
                        <div class="card-header">
                            <h2>Attendee Geographic Distribution</h2>
                        </div>
                        <div class="geo-distribution">
                            <div class="geo-item">
                                <span>City</span>
                                <span class="geo-value">60%</span>
                                <div class="geo-bar" style="width: 60%;"></div>
                            </div>
                            <div class="geo-item">
                                <span>Suburbs</span>
                                <span class="geo-value">25%</span>
                                <div class="geo-bar" style="width: 25%;"></div>
                            </div>
                            <div class="geo-item">
                                <span>Remote</span>
                                <span class="geo-value">15%</span>
                                <div class="geo-bar" style="width: 15%;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue-like Metrics (Event Value) -->
                    <div class="analytics-card">
                        <div class="card-header">
                            <h2>Event Value Analysis</h2>
                        </div>
                        <div class="value-metrics">
                            <div class="value-item">
                                <span>Total Capacity Value</span>
                                <span class="value-number"><?php echo $totalCapacity; ?></span>
                            </div>
                            <div class="value-item">
                                <span>Utilized Value</span>
                                <span class="value-number" style="color: #10b981;"><?php echo $totalAttendees; ?></span>
                            </div>
                            <div class="value-item">
                                <span>Efficiency Ratio</span>
                                <span class="value-number" style="color: #f59e0b;"><?php echo $attendanceRate; ?>%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SETTINGS TAB -->
            <section id="settings-tab" class="tab-content">
                <div class="page-header">
                    <h1>Account Settings</h1>
                    <p class="subtitle">Manage your account preferences and security</p>
                </div>

                <div class="settings-grid">
                    <!-- Security Settings -->
                    <div class="settings-card">
                        <div class="card-header">
                            <h2><i class="fas fa-lock"></i> Security</h2>
                        </div>

                        <div class="settings-group">
                            <h3>Change Password</h3>
                            <form id="changePasswordForm">
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <input type="password" name="current_password" required>
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" name="new_password" required>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm_password" required>
                                </div>
                                <button type="button" class="btn-primary" id="savePasswordBtn">Update Password</button>
                                <p id="passwordMessage" class="form-message"></p>
                            </form>
                        </div>

                        <div class="settings-group">
                            <h3>Two-Factor Authentication</h3>
                            <p class="description">Add an extra layer of security to your account</p>
                            <button class="btn-secondary">Enable 2FA</button>
                        </div>
                    </div>

                    <!-- Display Settings -->
                    <div class="settings-card">
                        <div class="card-header">
                            <h2><i class="fas fa-palette"></i> Display</h2>
                        </div>

                        <div class="settings-group">
                            <h3>Theme</h3>
                            <div class="theme-options">
                                <label class="theme-option">
                                    <input type="radio" name="theme" value="light" checked>
                                    <span class="theme-preview light"></span>
                                    <span>Light</span>
                                </label>
                                <label class="theme-option">
                                    <input type="radio" name="theme" value="dark">
                                    <span class="theme-preview dark"></span>
                                    <span>Dark</span>
                                </label>
                                <label class="theme-option">
                                    <input type="radio" name="theme" value="auto">
                                    <span class="theme-preview auto"></span>
                                    <span>Auto</span>
                                </label>
                            </div>
                        </div>

                        <div class="settings-group">
                            <h3>Language</h3>
                            <select id="languageSelect" class="form-select">
                                <option value="english">English</option>
                                <option value="tagalog">Tagalog (Filipino)</option>
                                <option value="spanish">Spanish</option>
                            </select>
                            <button type="button" class="btn-primary" id="saveLanguageBtn" style="margin-top: 10px;">Save Language</button>
                            <p id="languageMessage" class="form-message"></p>
                        </div>
                    </div>

                    <!-- Notifications -->
                    <div class="settings-card">
                        <div class="card-header">
                            <h2><i class="fas fa-bell"></i> Notifications</h2>
                        </div>

                        <div class="settings-group">
                            <h3>Email Notifications</h3>
                            <div class="notification-item">
                                <div class="notification-content">
                                    <h3>New Participant Registrations</h3>
                                    <p>Notify when someone registers for your events</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" name="email_new_registration" class="toggle-input notification-toggle" checked>
                                    <label class="toggle-label"></label>
                                </div>
                            </div>

                            <div class="notification-item">
                                <div class="notification-content">
                                    <h3>Event Reminders</h3>
                                    <p>Get reminders 1 day before your events</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" name="email_event_reminders" class="toggle-input notification-toggle" checked>
                                    <label class="toggle-label"></label>
                                </div>
                            </div>

                            <div class="notification-item">
                                <div class="notification-content">
                                    <h3>Event Updates</h3>
                                    <p>Notify when event details are changed</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" name="email_event_updates" class="toggle-input notification-toggle" checked>
                                    <label class="toggle-label"></label>
                                </div>
                            </div>

                            <div class="notification-item">
                                <div class="notification-content">
                                    <h3>Cancellations</h3>
                                    <p>Alert when events are cancelled</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" name="email_cancellations" class="toggle-input notification-toggle" checked>
                                    <label class="toggle-label"></label>
                                </div>
                            </div>

                            <div class="notification-item">
                                <div class="notification-content">
                                    <h3>Attendee Messages</h3>
                                    <p>Notify about messages from attendees</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" name="email_attendee_messages" class="toggle-input notification-toggle" checked>
                                    <label class="toggle-label"></label>
                                </div>
                            </div>

                            <div class="notification-item">
                                <div class="notification-content">
                                    <h3>Weekly Digest</h3>
                                    <p>Receive a weekly summary of your events</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" name="email_weekly_digest" class="toggle-input notification-toggle">
                                    <label class="toggle-label"></label>
                                </div>
                            </div>

                            <button type="button" class="btn-primary" id="saveNotificationSettingsBtn" style="margin-top: 20px;">Save Notification Settings</button>
                            <p id="notificationMessage" class="form-message"></p>
                        </div>
                    </div>

                    <!-- Privacy Settings -->
                    <div class="settings-card">
                        <div class="card-header">
                            <h2><i class="fas fa-shield-alt"></i> Privacy</h2>
                        </div>

                        <div class="settings-group">
                            <div class="privacy-item">
                                <div class="privacy-content">
                                    <h3>Show Profile to Others</h3>
                                    <p>Allow people to view your public profile</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="publicProfile" class="toggle-input" checked>
                                    <label for="publicProfile" class="toggle-label"></label>
                                </div>
                            </div>

                            <div class="privacy-item">
                                <div class="privacy-content">
                                    <h3>Allow Messages</h3>
                                    <p>Let people contact you through the platform</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="allowMessages" class="toggle-input" checked>
                                    <label for="allowMessages" class="toggle-label"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- EXPORT TAB -->
            <section id="export-tab" class="tab-content">
                <div class="page-header">
                    <h1>Data Export</h1>
                    <p class="subtitle">Export your data in various formats</p>
                </div>

                <div class="export-container">
                    <!-- Events Export -->
                    <div class="export-card">
                        <div class="export-icon">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <h2>Export Events</h2>
                        <p>Download all your hosted events</p>
                        <div class="export-options">
                            <button class="export-btn" onclick="exportData('events', 'csv')">
                                <i class="fas fa-file-csv"></i> CSV
                            </button>
                            <button class="export-btn" onclick="exportData('events', 'pdf')">
                                <i class="fas fa-file-pdf"></i> PDF
                            </button>
                            <button class="export-btn" onclick="exportData('events', 'json')">
                                <i class="fas fa-file-code"></i> JSON
                            </button>
                        </div>
                    </div>

                    <!-- Attendees Export -->
                    <div class="export-card">
                        <div class="export-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h2>Export Attendees</h2>
                        <p>Download attendee lists for all events</p>
                        <div class="export-options">
                            <button class="export-btn" onclick="exportData('attendees', 'csv')">
                                <i class="fas fa-file-csv"></i> CSV
                            </button>
                            <button class="export-btn" onclick="exportData('attendees', 'excel')">
                                <i class="fas fa-file-excel"></i> Excel
                            </button>
                            <button class="export-btn" onclick="exportData('attendees', 'pdf')">
                                <i class="fas fa-file-pdf"></i> PDF
                            </button>
                        </div>
                    </div>

                    <!-- Analytics Export -->
                    <div class="export-card">
                        <div class="export-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h2>Export Analytics</h2>
                        <p>Download detailed analytics and reports</p>
                        <div class="export-options">
                            <button class="export-btn" onclick="exportData('analytics', 'pdf')">
                                <i class="fas fa-file-pdf"></i> PDF Report
                            </button>
                            <button class="export-btn" onclick="exportData('analytics', 'csv')">
                                <i class="fas fa-file-csv"></i> CSV
                            </button>
                            <button class="export-btn" onclick="exportData('analytics', 'json')">
                                <i class="fas fa-file-code"></i> JSON
                            </button>
                        </div>
                    </div>

                    <!-- Account Data Export -->
                    <div class="export-card">
                        <div class="export-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h2>Account Data</h2>
                        <p>Download all your account information</p>
                        <div class="export-options">
                            <button class="export-btn" onclick="exportData('account', 'json')">
                                <i class="fas fa-file-code"></i> JSON
                            </button>
                            <button class="export-btn" onclick="exportData('account', 'zip')">
                                <i class="fas fa-file-archive"></i> ZIP
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Recent Exports -->
                <div class="recent-exports">
                    <h2>Recent Exports</h2>
                    <div class="exports-list">
                        <div class="export-item">
                            <div class="export-item-info">
                                <span class="export-name">Events_2025-01-20.csv</span>
                                <span class="export-date">20 Jan 2025</span>
                            </div>
                            <a href="#" class="download-link"><i class="fas fa-download"></i></a>
                        </div>
                        <div class="export-item">
                            <div class="export-item-info">
                                <span class="export-name">Analytics_Report_2025.pdf</span>
                                <span class="export-date">15 Jan 2025</span>
                            </div>
                            <a href="#" class="download-link"><i class="fas fa-download"></i></a>
                        </div>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <!-- MODALS -->
    <!-- Create Event Modal -->
    <div class="modal" id="createEventModal">
        <div class="modal-content">
            <button class="modal-close">&times;</button>
            <h2>Create Event</h2>
            <form id="createEventForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Event Name</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="4" required></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" id="createEventCategory" required>
                            <option value="">Select a category...</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Event Image</label>
                        <input type="file" name="image" id="createEventImage" accept="image/*">
                    </div>
                </div>
                <div id="createImagePreview" style="display: none; margin: 10px 0;">
                    <img id="createPreviewImg" src="" alt="Preview" style="max-width: 200px; border-radius: 8px;">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="event_date" required>
                    </div>
                    <div class="form-group">
                        <label>Time</label>
                        <input type="time" name="event_time" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Location Address</label>
                    <input type="text" name="location" id="createEventLocation" placeholder="Enter address" required>
                    <input type="hidden" name="latitude" id="createEventLatitude">
                    <input type="hidden" name="longitude" id="createEventLongitude">
                </div>
                <div class="form-group">
                    <label>Capacity</label>
                    <input type="number" name="capacity" min="1" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="1">Upcoming</option>
                        <option value="0">Finished</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">Create Event</button>
                    <button type="button" class="btn-secondary" onclick="closeModal('createEventModal')">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Event Modal -->
    <div class="modal" id="editEventModal">
        <div class="modal-content">
            <button class="modal-close">&times;</button>
            <h2>Edit Event</h2>
            <form id="editEventForm" enctype="multipart/form-data">
                <input type="hidden" name="id" id="editEventId">
                <div class="form-group">
                    <label>Event Name</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="4" required></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" id="editEventCategory" required>
                            <option value="">Select a category...</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Event Image</label>
                        <input type="file" name="image" id="editEventImage" accept="image/*">
                    </div>
                </div>
                <div id="editImagePreview" style="display: none; margin: 10px 0;">
                    <img id="editPreviewImg" src="" alt="Preview" style="max-width: 200px; border-radius: 8px;">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="event_date" required>
                    </div>
                    <div class="form-group">
                        <label>Time</label>
                        <input type="time" name="event_time" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Location Address</label>
                    <input type="text" name="location" id="editEventLocation" placeholder="Enter address" required>
                    <input type="hidden" name="latitude" id="editEventLatitude">
                    <input type="hidden" name="longitude" id="editEventLongitude">
                </div>
                <div class="form-group">
                    <label>Capacity</label>
                    <input type="number" name="capacity" min="1" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="1">Upcoming</option>
                        <option value="0">Finished</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">Update Event</button>
                    <button type="button" class="btn-secondary" onclick="closeModal('editEventModal')">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Event Details Modal -->
    <div class="modal" id="eventDetailsModal">
        <div class="modal-content modal-lg">
            <button class="modal-close">&times;</button>
            <div id="eventDetailsContent">
                <!-- Populated by JavaScript -->
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="toast"></div>

    <script src="assets/js/host-dashboard.js"></script>
</body>
</html>
