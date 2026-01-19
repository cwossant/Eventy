<?php
session_start();

if (!isset($_SESSION['HostID']) || $_SESSION['user_type'] !== 'participant') {
    header("Location: index.php");
    exit();
}

$ParticipantID = $_SESSION['HostID'];

// ===== MOCK DATA FOR DESIGN MOCKUP =====
// User data mock
$firstname = "mark";
$lastname = "dwayne";
$email = "markdwayne68@gmail.com";
$city = "Manila";
$bio = "Event enthusiast and tech lover. Love attending tech conferences and networking events.";
$profilePicture = "uploads/profile_pics/default_profile.jpg";
$memberSince = "January 2024";
$customProfileUrl = "markdwayne.eventy.com";

// Verification badges mock
$verifications = [
    'email_verified' => true,
    'phone_verified' => true,
    'identity_verified' => false
];

// User reputation and tier
$reputationScore = 4.8; // out of 5
$userLevel = "Active Member"; // Can be: "Newcomer", "Active Member", "Event Expert", "Community Leader"
$userLevelColor = "#4ECDC4"; // Turquoise for Active Member

// Achievement badges mock
$achievementBadges = [
    ['id' => 1, 'name' => 'First Event', 'description' => 'Attended your first event', 'icon' => 'fa-star', 'earned' => true, 'earnedDate' => 'Jan 20, 2024'],
    ['id' => 2, 'name' => '5 Events Attended', 'description' => 'Attended 5 events', 'icon' => 'fa-fire', 'earned' => true, 'earnedDate' => 'Mar 15, 2024'],
    ['id' => 3, 'name' => 'Social Butterfly', 'description' => 'Made 10 connections', 'icon' => 'fa-users', 'earned' => true, 'earnedDate' => 'Apr 10, 2024'],
    ['id' => 4, 'name' => 'Tech Enthusiast', 'description' => 'Attended 3 tech events', 'icon' => 'fa-laptop', 'earned' => true, 'earnedDate' => 'May 5, 2024'],
    ['id' => 5, 'name' => '10 Events Milestone', 'description' => 'Attended 10 events', 'icon' => 'fa-trophy', 'earned' => false],
    ['id' => 6, 'name' => 'Super Reviewer', 'description' => 'Left 10 event reviews', 'icon' => 'fa-pen', 'earned' => false]
];

// Timeline data mock
$milestoneTimeline = [
    ['date' => 'Jan 20, 2024', 'event' => 'Joined Eventy', 'type' => 'join'],
    ['date' => 'Jan 25, 2024', 'event' => 'Attended Tech Conference 2024', 'type' => 'event'],
    ['date' => 'Feb 10, 2024', 'event' => 'Earned "First Event" Badge', 'type' => 'badge'],
    ['date' => 'Mar 15, 2024', 'event' => 'Reached 5 Events Attended', 'type' => 'milestone'],
    ['date' => 'Apr 10, 2024', 'event' => 'Earned "Social Butterfly" Badge', 'type' => 'badge'],
    ['date' => 'May 20, 2024', 'event' => 'Promoted to "Active Member"', 'type' => 'promotion']
];

// Calendar export options
$calendarOptions = [
    ['name' => 'Google Calendar', 'icon' => 'fa-calendar', 'color' => '#4285F4'],
    ['name' => 'Outlook Calendar', 'icon' => 'fa-calendar', 'color' => '#0078D4'],
    ['name' => 'Apple Calendar', 'icon' => 'fa-calendar', 'color' => '#555555'],
    ['name' => 'iCal File', 'icon' => 'fa-download', 'color' => '#6C63FF']
];

// Forum/Discussion data mock
$forumStats = [
    'topics_created' => 12,
    'replies_given' => 45,
    'helpful_votes' => 87,
    'followers' => 23
];

$userData = [
    'firstname' => $firstname,
    'lastname' => $lastname,
    'email' => $email
];

// User preferences/settings mock
$settings = [
    'enable_notifications' => 1,
    'event_email_alerts' => 1,
    'email_frequency' => 'weekly',
    'dark_mode' => 0,
    'two_factor_auth' => 0,
    'profile_visibility' => 'public'
];

// Stats mock
$eventsAttended = 5;
$favoritesCount = 8;

// Mock events data
$allEvents = [
    [
        'id' => 1,
        'name' => 'Tech Conference 2026',
        'description' => 'Join industry leaders for a day-long conference covering the latest in web development, AI, and cloud technologies. Learn from expert speakers and network with peers.',
        'event_date' => '2026-02-15',
        'event_time' => '09:00',
        'location' => 'Manila Convention Center',
        'category' => 'Technology',
        'capacity' => 500,
        'attendees' => 380,
        'color' => '#FF6B6B'
    ],
    [
        'id' => 2,
        'name' => 'Basketball Tournament',
        'description' => 'Annual inter-office basketball tournament featuring teams from local companies. Compete, cheer, and have fun with colleagues.',
        'event_date' => '2026-02-20',
        'event_time' => '14:00',
        'location' => 'Makati Sports Complex',
        'category' => 'Sports',
        'capacity' => 200,
        'attendees' => 156,
        'color' => '#4ECDC4'
    ],
    [
        'id' => 3,
        'name' => 'Jazz Night Live',
        'description' => 'Experience smooth jazz performances from renowned local and international artists. An evening of great music and ambiance.',
        'event_date' => '2026-02-25',
        'event_time' => '19:00',
        'location' => 'Hard Rock Cafe Manila',
        'category' => 'Music',
        'capacity' => 300,
        'attendees' => 245,
        'color' => '#FFD93D'
    ],
    [
        'id' => 4,
        'name' => 'Networking Mixer',
        'description' => 'Meet and connect with professionals from various industries. Share ideas, make new connections, and expand your network.',
        'event_date' => '2026-03-01',
        'event_time' => '18:00',
        'location' => 'BGC Taguig',
        'category' => 'Social',
        'capacity' => 150,
        'attendees' => 98,
        'color' => '#95E1D3'
    ],
    [
        'id' => 5,
        'name' => 'Web Development Workshop',
        'description' => 'Hands-on workshop on modern web development frameworks. Learn React, Vue, and Angular from industry experts.',
        'event_date' => '2026-03-05',
        'event_time' => '10:00',
        'location' => 'Tech Hub Manila',
        'category' => 'Education',
        'capacity' => 100,
        'attendees' => 87,
        'color' => '#6C63FF'
    ],
    [
        'id' => 6,
        'name' => 'Art Exhibition Opening',
        'description' => 'Contemporary art showcase featuring works from emerging Filipino artists. Wine and cheese reception included.',
        'event_date' => '2026-03-10',
        'event_time' => '17:00',
        'location' => 'Art Gallery District',
        'category' => 'Art & Culture',
        'capacity' => 250,
        'attendees' => 189,
        'color' => '#FF9ECD'
    ],
    [
        'id' => 7,
        'name' => 'Startup Pitch Competition',
        'description' => 'Watch innovative startups pitch their ideas to investors. Be part of the entrepreneurship ecosystem.',
        'event_date' => '2026-03-15',
        'event_time' => '13:00',
        'location' => 'Innovation Hub',
        'category' => 'Business',
        'capacity' => 180,
        'attendees' => 145,
        'color' => '#A8E6CF'
    ],
    [
        'id' => 8,
        'name' => 'Yoga and Wellness Retreat',
        'description' => 'Find inner peace with yoga sessions, meditation, and wellness talks. Refresh your mind and body.',
        'event_date' => '2026-03-20',
        'event_time' => '08:00',
        'location' => 'Wellness Center',
        'category' => 'Health & Fitness',
        'capacity' => 75,
        'attendees' => 62,
        'color' => '#FF8787'
    ]
];

// Mock favorited event IDs
$favoriteEventIds = [1, 3, 5, 7];

// ===== END OF MOCK DATA =====
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Eventy Participant</title>
    <link rel="stylesheet" href="assets/css/participant-dashboard.css">
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
                <button class="nav-item active" data-tab="events">
                    <i class="fas fa-calendar"></i>
                    <span>Events</span>
                    <span class="badge"><?php echo count($allEvents); ?></span>
                </button>
                <button class="nav-item" data-tab="profile">
                    <i class="fas fa-user-circle"></i>
                    <span>Profile</span>
                </button>
                <button class="nav-item" data-tab="favorites">
                    <i class="fas fa-heart"></i>
                    <span>Favorites</span>
                    <span class="badge"><?php echo $favoritesCount; ?></span>
                </button>
                <button class="nav-item" data-tab="settings">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </button>
            </nav>

            <!-- Notification Bell -->
            <div class="notification-center">
                <button class="notification-btn" id="notificationBell">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                <div class="notification-dropdown" id="notificationDropdown">
                    <div class="notification-header">
                        <h3>Notifications</h3>
                        <button class="clear-btn"><i class="fas fa-trash"></i></button>
                    </div>
                    <div class="notification-list">
                        <div class="notification-item">
                            <i class="fas fa-calendar-check"></i>
                            <div class="notification-content">
                                <p>Tech Conference happening in 2 hours</p>
                                <small>5 min ago</small>
                            </div>
                        </div>
                        <div class="notification-item">
                            <i class="fas fa-users"></i>
                            <div class="notification-content">
                                <p>5 new events matching your interests</p>
                                <small>1 hour ago</small>
                            </div>
                        </div>
                        <div class="notification-item">
                            <i class="fas fa-star"></i>
                            <div class="notification-content">
                                <p>Event you favorited is happening soon</p>
                                <small>2 hours ago</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sign Out</span>
            </a>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- EVENTS TAB (Home/Discovery) -->
            <section id="events-tab" class="tab-content active">
                <div class="page-header">
                    <div>
                        <h1>Discover Events</h1>
                        <p class="subtitle">Find and join amazing events near you</p>
                    </div>
                </div>

                <!-- User Stats Dashboard -->
                <div class="stats-grid">
                    <div class="stat-card stat-attended">
                        <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-content">
                            <h3><?php echo $eventsAttended; ?></h3>
                            <p>Events Attended</p>
                        </div>
                    </div>

                    <div class="stat-card stat-favorites">
                        <div class="stat-icon"><i class="fas fa-heart"></i></div>
                        <div class="stat-content">
                            <h3><?php echo $favoritesCount; ?></h3>
                            <p>Favorited Events</p>
                        </div>
                    </div>

                    <div class="stat-card stat-total">
                        <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                        <div class="stat-content">
                            <h3><?php echo count($allEvents); ?></h3>
                            <p>Available Events</p>
                        </div>
                    </div>

                    <div class="stat-card stat-profile">
                        <div class="stat-icon"><i class="fas fa-fire"></i></div>
                        <div class="stat-content">
                            <h3><?php echo round(($eventsAttended / max(count($allEvents), 1)) * 100); ?>%</h3>
                            <p>Activity Score</p>
                        </div>
                    </div>
                </div>

                <!-- Search & Filter Controls -->
                <div class="events-header">
                    <div class="search-container">
                        <i class="fas fa-search"></i>
                        <input type="text" class="search-input" id="eventSearchInput" placeholder="Search events by name or description...">
                    </div>
                    <div class="filter-controls">
                        <select class="filter-select" id="categoryFilter">
                            <option value="">All Categories</option>
                            <option value="tech">Technology</option>
                            <option value="sports">Sports</option>
                            <option value="music">Music</option>
                            <option value="social">Social</option>
                            <option value="education">Education</option>
                            <option value="art">Art & Culture</option>
                        </select>
                        <select class="filter-select" id="dateFilter">
                            <option value="">All Dates</option>
                            <option value="this-week">This Week</option>
                            <option value="this-month">This Month</option>
                            <option value="upcoming">Upcoming</option>
                        </select>
                        <select class="filter-select" id="sizeFilter">
                            <option value="">All Sizes</option>
                            <option value="small">Small (0-50)</option>
                            <option value="medium">Medium (50-200)</option>
                            <option value="large">Large (200+)</option>
                        </select>
                        <button class="filter-btn" id="toggleAdvanced">
                            <i class="fas fa-sliders-h"></i> More Filters
                        </button>
                    </div>
                </div>

                <!-- Advanced Filters -->
                <div class="advanced-filters" id="advancedFilters" style="display:none;">
                    <div class="filter-group">
                        <label>Location/City</label>
                        <input type="text" placeholder="Enter city..." id="locationFilter">
                    </div>
                    <div class="filter-group">
                        <label>Distance Range</label>
                        <select id="distanceFilter">
                            <option value="">No Filter</option>
                            <option value="5">Within 5 km</option>
                            <option value="10">Within 10 km</option>
                            <option value="25">Within 25 km</option>
                            <option value="50">Within 50 km</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Sorting</label>
                        <select id="sortingFilter">
                            <option value="date">Date (Earliest)</option>
                            <option value="trending">Trending</option>
                            <option value="most-attended">Most Attended</option>
                            <option value="newest">Newest</option>
                        </select>
                    </div>
                    <button class="btn-apply-filters" id="applyFilters">Apply Filters</button>
                </div>

                <!-- Recommended Events Banner -->
                <div class="recommendations-banner">
                    <div class="banner-content">
                        <i class="fas fa-lightbulb"></i>
                        <div>
                            <h3>Suggested for You</h3>
                            <p>Based on your interests and past events</p>
                        </div>
                    </div>
                    <button class="btn-view-suggested">View Suggestions</button>
                </div>

                <!-- Events Grid with Infinite Scroll -->
                <div class="events-feed" id="eventsFeed">
                    <?php foreach ($allEvents as $event): ?>
                        <?php
                            $isFavorited = in_array($event['id'], $favoriteEventIds);
                            $attendancePercent = $event['capacity'] > 0 ? round((($event['attendees'] ?? 0) / $event['capacity']) * 100) : 0;
                            $isSoldOut = $attendancePercent >= 100;
                            $isHappening = true;
                            $eventColor = $event['color'] ?? '#6C63FF';
                        ?>
                        <div class="event-card" data-event-id="<?php echo $event['id']; ?>" data-category="<?php echo strtolower($event['category']); ?>" data-name="<?php echo strtolower(htmlspecialchars($event['name'])); ?>">
                            
                            <!-- Event Image with Overlay -->
                            <div class="event-image-container" style="background-color: <?php echo htmlspecialchars($eventColor); ?>;">
                                
                                <!-- Status Badges -->
                                <div class="event-badges">
                                    <?php if ($isHappening): ?>
                                        <span class="badge badge-happening"><i class="fas fa-circle"></i> Happening Now</span>
                                    <?php endif; ?>
                                    <?php if ($isSoldOut): ?>
                                        <span class="badge badge-sold-out">Sold Out</span>
                                    <?php else: ?>
                                        <span class="badge badge-free">Free</span>
                                    <?php endif; ?>
                                </div>

                                <!-- Favorite Button -->
                                <button class="favorite-btn <?php echo $isFavorited ? 'favorited' : ''; ?>" title="Add to favorites">
                                    <i class="fas fa-heart"></i>
                                </button>

                                <!-- Share Button -->
                                <button class="share-btn" title="Share event">
                                    <i class="fas fa-share-alt"></i>
                                </button>

                                <!-- Category Icon -->
                                <div class="category-badge">
                                    <i class="fas fa-tag"></i>
                                    <?php echo htmlspecialchars($event['category']); ?>
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
                                        <span><?php echo htmlspecialchars($event['event_time']); ?></span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span><?php echo htmlspecialchars($event['location']); ?></span>
                                    </div>
                                </div>

                                <!-- Capacity Bar -->
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
                                    <button class="btn-primary btn-register">Register Now</button>
                                    <button class="btn-secondary btn-details">View Details</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Load More Button -->
                <div class="load-more-container">
                    <button class="btn-load-more" id="loadMoreBtn">Load More Events</button>
                    <p class="no-more-events" style="display:none; text-align:center;">No more events to load</p>
                </div>
            </section>

            <!-- PROFILE TAB -->
            <section id="profile-tab" class="tab-content">
                <div class="page-header">
                    <h1>My Profile</h1>
                    <p class="subtitle">View and manage your personal information</p>
                </div>

                <!-- Profile Completeness Indicator -->
                <div class="profile-completeness">
                    <div class="completeness-content">
                        <h3>Profile Completeness</h3>
                        <p>Complete your profile to get better event recommendations</p>
                    </div>
                    <div class="completeness-bar-container">
                        <div class="completeness-bar">
                            <div class="bar-fill" style="width: 75%;"></div>
                        </div>
                        <span class="completeness-text">75%</span>
                    </div>
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
                            
                            <!-- Custom Profile URL -->
                            <div class="profile-url-section">
                                <small>Your Profile URL</small>
                                <p><?php echo htmlspecialchars($customProfileUrl); ?></p>
                            </div>
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
                                <input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>" placeholder="Enter your city">
                            </div>

                            <div class="form-group">
                                <label>Bio</label>
                                <textarea name="bio" placeholder="Tell us about yourself..." rows="4"><?php echo htmlspecialchars($bio); ?></textarea>
                            </div>

                            <div class="form-actions">
                                <button type="button" class="btn-primary" id="saveProfileBtn">Save Changes</button>
                                <button type="reset" class="btn-secondary">Discard</button>
                            </div>
                        </form>
                    </div>

                    <!-- Interests/Tags Card -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h2>Interests & Tags</h2>
                        </div>

                        <div class="interests-section">
                            <p class="section-description">Select your interests to get personalized event recommendations</p>
                            <div class="interest-tags">
                                <?php 
                                    $availableInterests = ['Technology', 'Sports', 'Music', 'Art & Culture', 'Business', 'Education', 'Food & Dining', 'Travel', 'Health & Fitness', 'Gaming'];
                                    $selectedInterests = !empty($interests) ? explode(',', $interests) : [];
                                ?>
                                <?php foreach ($availableInterests as $interest): ?>
                                    <label class="interest-tag">
                                        <input type="checkbox" value="<?php echo htmlspecialchars($interest); ?>" <?php echo in_array($interest, $selectedInterests) ? 'checked' : ''; ?>>
                                        <span><?php echo htmlspecialchars($interest); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                            <button type="button" class="btn-primary" id="saveInterestsBtn">Save Interests</button>
                        </div>
                    </div>

                    <!-- Profile Stats Card -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h2>Your Statistics</h2>
                        </div>

                        <div class="stats-list">
                            <div class="stat-row">
                                <span><i class="fas fa-calendar-check"></i> Events Attended</span>
                                <span class="stat-value"><?php echo $eventsAttended; ?></span>
                            </div>
                            <div class="stat-row">
                                <span><i class="fas fa-heart"></i> Favorited Events</span>
                                <span class="stat-value"><?php echo $favoritesCount; ?></span>
                            </div>
                            <div class="stat-row">
                                <span><i class="fas fa-fire"></i> Activity Score</span>
                                <span class="stat-value"><?php echo round(($eventsAttended / max(count($allEvents), 1)) * 100); ?>%</span>
                            </div>
                            <div class="stat-row">
                                <span><i class="fas fa-star"></i> Member Since</span>
                                <span class="stat-value">Jan 2024</span>
                            </div>
                        </div>
                    </div>

                    <!-- Verification Badges Card -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h2><i class="fas fa-shield-alt"></i> Verification Status</h2>
                        </div>

                        <div class="verification-section">
                            <div class="verification-item <?php echo $verifications['email_verified'] ? 'verified' : ''; ?>">
                                <i class="fas fa-envelope"></i>
                                <div class="verification-content">
                                    <h4>Email</h4>
                                    <p><?php echo $verifications['email_verified'] ? 'Verified ✓' : 'Not verified'; ?></p>
                                </div>
                            </div>
                            <div class="verification-item <?php echo $verifications['phone_verified'] ? 'verified' : ''; ?>">
                                <i class="fas fa-phone"></i>
                                <div class="verification-content">
                                    <h4>Phone</h4>
                                    <p><?php echo $verifications['phone_verified'] ? 'Verified ✓' : 'Not verified'; ?></p>
                                </div>
                            </div>
                            <div class="verification-item <?php echo $verifications['identity_verified'] ? 'verified' : ''; ?>">
                                <i class="fas fa-user-check"></i>
                                <div class="verification-content">
                                    <h4>Identity</h4>
                                    <p><?php echo $verifications['identity_verified'] ? 'Verified ✓' : 'Not verified'; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Level & Reputation Card -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h2><i class="fas fa-medal"></i> Level & Reputation</h2>
                        </div>

                        <div class="level-reputation-section">
                            <div class="user-level" style="border-color: <?php echo htmlspecialchars($userLevelColor); ?>;">
                                <div class="level-badge" style="background-color: <?php echo htmlspecialchars($userLevelColor); ?>;">
                                    <i class="fas fa-crown"></i>
                                </div>
                                <div class="level-info">
                                    <h3><?php echo htmlspecialchars($userLevel); ?></h3>
                                    <p>Community Member</p>
                                </div>
                            </div>

                            <div class="reputation-score">
                                <h4>Reputation Score</h4>
                                <div class="score-display">
                                    <span class="score-number"><?php echo htmlspecialchars($reputationScore); ?></span>
                                    <span class="score-max">/5.0</span>
                                    <div class="star-rating">
                                        <?php for ($i = 0; $i < 5; $i++): ?>
                                            <i class="fas fa-star <?php echo ($i < floor($reputationScore)) ? 'filled' : (($i - floor($reputationScore)) < 0.5 ? 'half-filled' : ''); ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <p class="score-basis">Based on <?php echo count($allEvents); ?> event reviews</p>
                            </div>
                        </div>
                    </div>

                    <!-- Achievement Badges Card -->
                    <div class="profile-card achievement-card">
                        <div class="card-header">
                            <h2><i class="fas fa-trophy"></i> Achievement Badges</h2>
                        </div>

                        <div class="badges-grid">
                            <?php foreach ($achievementBadges as $badge): ?>
                                <div class="badge-item <?php echo $badge['earned'] ? 'earned' : 'locked'; ?>" title="<?php echo htmlspecialchars($badge['description']); ?>">
                                    <div class="badge-icon">
                                        <i class="fas <?php echo htmlspecialchars($badge['icon']); ?>"></i>
                                    </div>
                                    <h4><?php echo htmlspecialchars($badge['name']); ?></h4>
                                    <?php if ($badge['earned']): ?>
                                        <p class="earned-date">Earned: <?php echo htmlspecialchars($badge['earnedDate']); ?></p>
                                    <?php else: ?>
                                        <p class="locked-text">Locked</p>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Member Timeline Card -->
                    <div class="profile-card timeline-card">
                        <div class="card-header">
                            <h2><i class="fas fa-history"></i> Member Timeline</h2>
                        </div>

                        <div class="timeline">
                            <?php foreach ($milestoneTimeline as $index => $milestone): ?>
                                <div class="timeline-item">
                                    <div class="timeline-marker">
                                        <?php if ($milestone['type'] === 'join'): ?>
                                            <i class="fas fa-user-plus"></i>
                                        <?php elseif ($milestone['type'] === 'event'): ?>
                                            <i class="fas fa-calendar-check"></i>
                                        <?php elseif ($milestone['type'] === 'badge'): ?>
                                            <i class="fas fa-star"></i>
                                        <?php elseif ($milestone['type'] === 'milestone'): ?>
                                            <i class="fas fa-flag"></i>
                                        <?php else: ?>
                                            <i class="fas fa-crown"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="timeline-date"><?php echo htmlspecialchars($milestone['date']); ?></p>
                                        <p class="timeline-event"><?php echo htmlspecialchars($milestone['event']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Forum Activity Card -->
                    <div class="profile-card forum-card">
                        <div class="card-header">
                            <h2><i class="fas fa-comments"></i> Forum Activity</h2>
                        </div>

                        <div class="forum-stats">
                            <div class="forum-stat-item">
                                <div class="stat-icon">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <div class="stat-info">
                                    <h4><?php echo $forumStats['topics_created']; ?></h4>
                                    <p>Topics Created</p>
                                </div>
                            </div>
                            <div class="forum-stat-item">
                                <div class="stat-icon">
                                    <i class="fas fa-reply"></i>
                                </div>
                                <div class="stat-info">
                                    <h4><?php echo $forumStats['replies_given']; ?></h4>
                                    <p>Replies Given</p>
                                </div>
                            </div>
                            <div class="forum-stat-item">
                                <div class="stat-icon">
                                    <i class="fas fa-thumbs-up"></i>
                                </div>
                                <div class="stat-info">
                                    <h4><?php echo $forumStats['helpful_votes']; ?></h4>
                                    <p>Helpful Votes</p>
                                </div>
                            </div>
                            <div class="forum-stat-item">
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-info">
                                    <h4><?php echo $forumStats['followers']; ?></h4>
                                    <p>Followers</p>
                                </div>
                            </div>
                        </div>
                        <button class="btn-primary" style="width: 100%; margin-top: 15px;">Go to Forum</button>
                    </div>
                </div>
            </section>

            <!-- FAVORITES TAB -->
            <section id="favorites-tab" class="tab-content">
                <div class="page-header">
                    <h1>Saved Events</h1>
                    <p class="subtitle">Your favorite events</p>
                </div>

                <div class="favorites-grid" id="favoritesFeed">
                    <?php foreach ($allEvents as $event): ?>
                        <?php if (in_array($event['id'], $favoriteEventIds)): ?>
                            <?php
                                $attendancePercent = $event['capacity'] > 0 ? round((($event['attendees'] ?? 0) / $event['capacity']) * 100) : 0;
                                $isSoldOut = $attendancePercent >= 100;
                                $eventImage = !empty($event['image']) ? "uploads/events/" . $event['image'] : "assets/images/default-event.jpg";
                            ?>
                        
                            <div class="event-card" data-event-id="<?php echo $event['id']; ?>">
                                <div class="event-image-container" style="background-color: <?php echo htmlspecialchars($eventColor); ?>;
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <div class="category-badge">
                                        <i class="fas fa-tag"></i>
                                        <?php echo htmlspecialchars($event['category']); ?>
                                    </div>
                                </div>

                                <div class="event-content">
                                    <h3><?php echo htmlspecialchars($event['name']); ?></h3>
                                    <div class="event-meta">
                                        <div class="meta-item">
                                            <i class="fas fa-calendar"></i>
                                            <span><?php echo htmlspecialchars($event['event_date']); ?></span>
                                        </div>
                                        <div class="meta-item">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span><?php echo htmlspecialchars($event['location']); ?></span>
                                        </div>
                                    </div>
                                    <div class="event-actions">
                                        <button class="btn-primary btn-register">Register Now</button>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <?php if (empty($favoriteEventIds)): ?>
                    <div class="empty-state-container">
                        <i class="fas fa-heart"></i>
                        <p>No favorite events yet</p>
                        <p class="empty-state-subtitle">Start adding events to your favorites!</p>
                    </div>
                <?php endif; ?>
            </section>

            <!-- SETTINGS TAB -->
            <section id="settings-tab" class="tab-content">
                <div class="page-header">
                    <h1>Settings</h1>
                    <p class="subtitle">Manage your preferences and account</p>
                </div>

                <div class="settings-grid">
                    <!-- Notification Preferences -->
                    <div class="settings-card">
                        <div class="card-header">
                            <h2><i class="fas fa-bell"></i> Notification Preferences</h2>
                        </div>

                        <div class="settings-content">
                            <div class="setting-item">
                                <div class="setting-label">
                                    <h3>Enable Notifications</h3>
                                    <p>Receive notifications about events and updates</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="enableNotifications" class="toggle-input" <?php echo $settings['enable_notifications'] ? 'checked' : ''; ?>>
                                    <label for="enableNotifications" class="toggle-label"></label>
                                </div>
                            </div>

                            <div class="setting-item">
                                <div class="setting-label">
                                    <h3>Event Email Alerts</h3>
                                    <p>Get email notifications about new events</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="eventEmailAlerts" class="toggle-input" <?php echo $settings['event_email_alerts'] ? 'checked' : ''; ?>>
                                    <label for="eventEmailAlerts" class="toggle-label"></label>
                                </div>
                            </div>

                            <div class="setting-item">
                                <div class="setting-label">
                                    <h3>Email Frequency</h3>
                                    <p>How often you want to receive emails</p>
                                </div>
                                <select class="select-input" id="emailFrequency">
                                    <option value="daily" <?php echo $settings['email_frequency'] === 'daily' ? 'selected' : ''; ?>>Daily</option>
                                    <option value="weekly" <?php echo $settings['email_frequency'] === 'weekly' ? 'selected' : ''; ?>>Weekly</option>
                                    <option value="monthly" <?php echo $settings['email_frequency'] === 'monthly' ? 'selected' : ''; ?>>Monthly</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Privacy Settings -->
                    <div class="settings-card">
                        <div class="card-header">
                            <h2><i class="fas fa-lock"></i> Privacy Settings</h2>
                        </div>

                        <div class="settings-content">
                            <div class="setting-item">
                                <div class="setting-label">
                                    <h3>Profile Visibility</h3>
                                    <p>Who can view your profile</p>
                                </div>
                                <select class="select-input" id="profileVisibility">
                                    <option value="public" <?php echo $settings['profile_visibility'] === 'public' ? 'selected' : ''; ?>>Public</option>
                                    <option value="private" <?php echo $settings['profile_visibility'] === 'private' ? 'selected' : ''; ?>>Private</option>
                                    <option value="friends-only" <?php echo $settings['profile_visibility'] === 'friends-only' ? 'selected' : ''; ?>>Friends Only</option>
                                </select>
                            </div>

                            <div class="setting-item">
                                <div class="setting-label">
                                    <h3>Show My Interests</h3>
                                    <p>Display your interests on your profile</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="showInterests" class="toggle-input" checked>
                                    <label for="showInterests" class="toggle-label"></label>
                                </div>
                            </div>

                            <div class="setting-item">
                                <div class="setting-label">
                                    <h3>Show Event History</h3>
                                    <p>Let others see events you've attended</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="showEventHistory" class="toggle-input">
                                    <label for="showEventHistory" class="toggle-label"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Appearance Settings -->
                    <div class="settings-card">
                        <div class="card-header">
                            <h2><i class="fas fa-palette"></i> Appearance</h2>
                        </div>

                        <div class="settings-content">
                            <div class="setting-item">
                                <div class="setting-label">
                                    <h3>Dark Mode</h3>
                                    <p>Use dark theme for the interface</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="darkModeToggle" class="toggle-input" <?php echo $settings['dark_mode'] ? 'checked' : ''; ?>>
                                    <label for="darkModeToggle" class="toggle-label"></label>
                                </div>
                            </div>

                            <div class="setting-item">
                                <div class="setting-label">
                                    <h3>Language</h3>
                                    <p>Choose your preferred language</p>
                                </div>
                                <select class="select-input" id="languageSelect">
                                    <option value="en">English</option>
                                    <option value="es">Español</option>
                                    <option value="fr">Français</option>
                                    <option value="de">Deutsch</option>
                                    <option value="pt">Português</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Security Settings -->
                    <div class="settings-card">
                        <div class="card-header">
                            <h2><i class="fas fa-shield-alt"></i> Security</h2>
                        </div>

                        <div class="settings-content">
                            <div class="setting-item">
                                <div class="setting-label">
                                    <h3>Change Password</h3>
                                    <p>Update your account password</p>
                                </div>
                                <button class="btn-secondary" id="changePasswordBtn">Change Password</button>
                            </div>

                            <div class="setting-item">
                                <div class="setting-label">
                                    <h3>Two-Factor Authentication</h3>
                                    <p>Add an extra layer of security</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="twoFactorToggle" class="toggle-input" <?php echo $settings['two_factor_auth'] ? 'checked' : ''; ?>>
                                    <label for="twoFactorToggle" class="toggle-label"></label>
                                </div>
                            </div>

                            <div class="setting-item">
                                <div class="setting-label">
                                    <h3>Login History</h3>
                                    <p>View your recent login activities</p>
                                </div>
                                <button class="btn-secondary" id="viewLoginHistoryBtn">View History</button>
                            </div>

                            <div class="setting-item danger-zone">
                                <div class="setting-label">
                                    <h3>Delete Account</h3>
                                    <p>Permanently delete your account and data</p>
                                </div>
                                <button class="btn-danger" id="deleteAccountBtn">Delete Account</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Save Settings Button -->
                <div class="settings-actions">
                    <button class="btn-primary" id="saveSettingsBtn">Save All Changes</button>
                    <button class="btn-secondary" id="resetSettingsBtn">Reset to Defaults</button>
                </div>
            </section>

        </main>
    </div>

    <!-- Modal for Event Details -->
    <div class="modal" id="eventDetailsModal">
        <div class="modal-content">
            <button class="modal-close">&times;</button>
            <div id="modalEventDetails">
                <!-- Event details will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Modal for Change Password -->
    <div class="modal" id="changePasswordModal">
        <div class="modal-content">
            <button class="modal-close">&times;</button>
            <h2>Change Password</h2>
            <form id="changePasswordForm" class="modal-form">
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
                <button type="submit" class="btn-primary">Update Password</button>
            </form>
        </div>
    </div>

    <script>
        // Tab Switching
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                const tabName = this.getAttribute('data-tab');
                
                // Remove active class from all items
                document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
                
                // Add active class to clicked item and corresponding tab
                this.classList.add('active');
                document.getElementById(tabName + '-tab').classList.add('active');
            });
        });

        // Search functionality
        document.getElementById('eventSearchInput').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            document.querySelectorAll('.event-card').forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const description = card.querySelector('.event-description')?.textContent.toLowerCase() || '';
                if (title.includes(searchValue) || description.includes(searchValue)) {
                    card.style.display = '';
                    card.style.animation = 'fadeIn 0.3s ease-in';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Category filter
        document.getElementById('categoryFilter').addEventListener('change', function() {
            const selectedCategory = this.value.toLowerCase();
            document.querySelectorAll('.event-card').forEach(card => {
                const category = card.getAttribute('data-category');
                if (selectedCategory === '' || category === selectedCategory) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Toggle advanced filters
        document.getElementById('toggleAdvanced').addEventListener('click', function() {
            const filters = document.getElementById('advancedFilters');
            filters.style.display = filters.style.display === 'none' ? 'grid' : 'none';
        });

        // Favorite button functionality
        document.querySelectorAll('.favorite-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                this.classList.toggle('favorited');
                const card = this.closest('.event-card');
                const eventId = card.getAttribute('data-event-id');
                
                // Animate the heart
                this.style.animation = 'heartBeat 0.6s ease-in-out';
                setTimeout(() => this.style.animation = '', 600);
                
                // Send to backend (you'll need to create this endpoint)
                // fetch('api/toggle_favorite.php', {
                //     method: 'POST',
                //     body: JSON.stringify({event_id: eventId})
                // });
            });
        });

        // Register button
        document.querySelectorAll('.btn-register').forEach(btn => {
            btn.addEventListener('click', function() {
                const card = this.closest('.event-card');
                const eventId = card.getAttribute('data-event-id');
                // Handle registration
                alert('Registered for event: ' + eventId);
            });
        });

        // View details button
        document.querySelectorAll('.btn-details').forEach(btn => {
            btn.addEventListener('click', function() {
                const card = this.closest('.event-card');
                const eventId = card.getAttribute('data-event-id');
                // Load and show event details in modal
                document.getElementById('eventDetailsModal').style.display = 'flex';
            });
        });

        // Modal close functionality
        document.querySelectorAll('.modal-close').forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('.modal').style.display = 'none';
            });
        });

        // Profile form save
        document.getElementById('saveProfileBtn').addEventListener('click', function() {
            const form = document.getElementById('profileForm');
            // Send data to backend
            alert('Profile saved successfully!');
        });

        // Notification bell
        document.getElementById('notificationBell').addEventListener('click', function() {
            const dropdown = document.getElementById('notificationDropdown');
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        });

        // Settings save
        document.getElementById('saveSettingsBtn').addEventListener('click', function() {
            // Collect all settings values
            const settings = {
                enableNotifications: document.getElementById('enableNotifications').checked,
                eventEmailAlerts: document.getElementById('eventEmailAlerts').checked,
                emailFrequency: document.getElementById('emailFrequency').value,
                profileVisibility: document.getElementById('profileVisibility').value,
                darkMode: document.getElementById('darkModeToggle').checked
            };
            console.log('Settings saved:', settings);
            alert('Settings saved successfully!');
        });

        // Dark mode toggle
        document.getElementById('darkModeToggle').addEventListener('change', function() {
            if (this.checked) {
                document.body.classList.add('dark-mode');
            } else {
                document.body.classList.remove('dark-mode');
            }
        });

        // Change password modal
        document.getElementById('changePasswordBtn').addEventListener('click', function() {
            document.getElementById('changePasswordModal').style.display = 'flex';
        });

        // Add animation keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            @keyframes heartBeat {
                0%, 100% { transform: scale(1); }
                25% { transform: scale(1.3); }
                50% { transform: scale(1.15); }
                75% { transform: scale(1.2); }
            }
            
            /* Profile Enhancement Styles */
            .profile-url-section {
                margin-top: 15px;
                padding: 12px;
                background: #f5f5f5;
                border-radius: 8px;
                text-align: center;
            }
            
            .profile-url-section small {
                color: #888;
                font-size: 12px;
                display: block;
                margin-bottom: 5px;
            }
            
            .profile-url-section p {
                color: #6C63FF;
                font-weight: 600;
                margin: 0;
                font-size: 14px;
            }
            
            /* Verification Section */
            .verification-section {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }
            
            .verification-item {
                display: flex;
                align-items: center;
                gap: 15px;
                padding: 12px;
                border-left: 4px solid #ddd;
                border-radius: 4px;
                background: #fafafa;
                transition: all 0.3s ease;
            }
            
            .verification-item.verified {
                border-left-color: #4CAF50;
                background: #f1f8f4;
            }
            
            .verification-item i {
                font-size: 24px;
                color: #6C63FF;
            }
            
            .verification-item.verified i {
                color: #4CAF50;
            }
            
            .verification-content h4 {
                margin: 0;
                font-size: 14px;
                color: #333;
            }
            
            .verification-content p {
                margin: 2px 0 0 0;
                font-size: 12px;
                color: #666;
            }
            
            /* Level & Reputation */
            .level-reputation-section {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }
            
            .user-level {
                display: flex;
                align-items: center;
                gap: 15px;
                padding: 15px;
                border: 2px solid;
                border-radius: 10px;
                background: #fafafa;
            }
            
            .level-badge {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 24px;
                flex-shrink: 0;
            }
            
            .level-info h3 {
                margin: 0;
                font-size: 16px;
                color: #333;
            }
            
            .level-info p {
                margin: 3px 0 0 0;
                font-size: 12px;
                color: #666;
            }
            
            .reputation-score {
                text-align: center;
                padding: 15px;
                background: #f5f5f5;
                border-radius: 8px;
            }
            
            .reputation-score h4 {
                margin: 0 0 12px 0;
                font-size: 14px;
            }
            
            .score-display {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                margin-bottom: 8px;
            }
            
            .score-number {
                font-size: 32px;
                font-weight: bold;
                color: #6C63FF;
            }
            
            .score-max {
                font-size: 14px;
                color: #666;
            }
            
            .star-rating {
                display: flex;
                gap: 4px;
                justify-content: center;
            }
            
            .star-rating i {
                color: #ddd;
                font-size: 16px;
            }
            
            .star-rating i.filled {
                color: #FFD93D;
            }
            
            .star-rating i.half-filled {
                background: linear-gradient(90deg, #FFD93D 50%, #ddd 50%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            
            .score-basis {
                margin: 8px 0 0 0;
                font-size: 12px;
                color: #888;
            }
            
            /* Badges */
            .badges-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
                gap: 15px;
            }
            
            .badge-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 15px;
                background: #fff;
                border: 2px solid #ddd;
                border-radius: 12px;
                text-align: center;
                transition: all 0.3s ease;
            }
            
            .badge-item.earned {
                border-color: #FFD93D;
                background: #fffef5;
            }
            
            .badge-item.locked {
                opacity: 0.5;
            }
            
            .badge-icon {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
                margin-bottom: 8px;
                background: #f5f5f5;
            }
            
            .badge-item.earned .badge-icon {
                background: #FFD93D;
                color: white;
            }
            
            .badge-item h4 {
                margin: 0;
                font-size: 12px;
                color: #333;
            }
            
            .earned-date {
                font-size: 10px;
                color: #FFD93D;
                margin-top: 5px;
            }
            
            .locked-text {
                font-size: 10px;
                color: #999;
                margin-top: 5px;
            }
            
            /* Timeline */
            .timeline {
                display: flex;
                flex-direction: column;
                gap: 0;
            }
            
            .timeline-item {
                display: flex;
                gap: 15px;
                padding: 15px 0;
                border-left: 2px solid #ddd;
                padding-left: 20px;
                position: relative;
            }
            
            .timeline-item:last-child {
                border-left: none;
            }
            
            .timeline-marker {
                position: absolute;
                left: -10px;
                top: 15px;
                width: 18px;
                height: 18px;
                background: white;
                border: 2px solid #6C63FF;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 10px;
                color: #6C63FF;
            }
            
            .timeline-content {
                flex: 1;
            }
            
            .timeline-date {
                font-size: 12px;
                color: #999;
                margin: 0;
            }
            
            .timeline-event {
                font-size: 14px;
                color: #333;
                margin: 4px 0 0 0;
                font-weight: 500;
            }
            
            /* Forum Activity */
            .forum-stats {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
                gap: 15px;
            }
            
            .forum-stat-item {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 12px;
                background: #f5f5f5;
                border-radius: 8px;
                text-align: left;
            }
            
            .stat-icon {
                width: 40px;
                height: 40px;
                background: #6C63FF;
                color: white;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 18px;
                flex-shrink: 0;
            }
            
            .stat-info h4 {
                margin: 0;
                font-size: 16px;
                color: #333;
            }
            
            .stat-info p {
                margin: 2px 0 0 0;
                font-size: 12px;
                color: #666;
            }
            
            /* Calendar Export */
            .calendar-export-section p {
                margin: 0 0 15px 0;
                color: #666;
                font-size: 14px;
            }
            
            .calendar-options {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
                gap: 12px;
                margin-bottom: 15px;
            }
            
            .calendar-option {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 8px;
                padding: 15px;
                border: 2px solid;
                border-radius: 8px;
                background: white;
                cursor: pointer;
                transition: all 0.3s ease;
                font-size: 12px;
                font-weight: 500;
            }
            
            .calendar-option:hover {
                background: #f5f5f5;
                transform: translateY(-2px);
            }
            
            .calendar-option i {
                font-size: 24px;
            }
            
            .export-note {
                text-align: center;
                color: #999;
                margin: 0;
            }
        `;
        document.head.appendChild(style);

        // Close modal when clicking outside
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
