/* ============================================
   HOST DASHBOARD JAVASCRIPT
   ============================================ */

// ============================================
// INITIALIZATION
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    initializeNavigation();
    initializeProfileUpload();
    initializeFormHandlers();
    initializeToggleSwitches();
    initializeSearchAndFilter();
});

// ============================================
// TAB NAVIGATION
// ============================================

function initializeNavigation() {
    const navItems = document.querySelectorAll('.nav-item');
    const tabContents = document.querySelectorAll('.tab-content');

    navItems.forEach(item => {
        item.addEventListener('click', function() {
            const tabName = this.dataset.tab;
            
            // Remove active class from all nav items
            navItems.forEach(nav => nav.classList.remove('active'));
            
            // Add active class to clicked nav item
            this.classList.add('active');
            
            // Hide all tabs
            tabContents.forEach(tab => tab.classList.remove('active'));
            
            // Show selected tab
            const selectedTab = document.getElementById(tabName + '-tab');
            if (selectedTab) {
                selectedTab.classList.add('active');
            }
        });
    });

    // Set first nav item as active by default
    if (navItems.length > 0) {
        navItems[0].classList.add('active');
        const firstTabName = navItems[0].dataset.tab;
        const firstTab = document.getElementById(firstTabName + '-tab');
        if (firstTab) {
            firstTab.classList.add('active');
        }
    }
}

// ============================================
// PROFILE PICTURE UPLOAD
// ============================================

function initializeProfileUpload() {
    const uploadBtn = document.getElementById('uploadPicBtn');
    const profilePicInput = document.getElementById('profilePicInput');
    const profilePicPreview = document.getElementById('profilePicPreview');

    if (uploadBtn && profilePicInput) {
        uploadBtn.addEventListener('click', function() {
            profilePicInput.click();
        });

        profilePicInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    profilePicPreview.src = event.target.result;
                    uploadProfilePicture(file);
                };
                reader.readAsDataURL(file);
            }
        });
    }
}

function uploadProfilePicture(file) {
    const formData = new FormData();
    formData.append('profile_picture', file);

    fetch('api/upload_profile_picture.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            showToast('Profile picture updated successfully!', 'success');
            // Update sidebar profile picture
            const sidebarProfilePic = document.getElementById('sidebarProfilePic');
            if (sidebarProfilePic) {
                sidebarProfilePic.src = data.filename;
            }
        } else {
            showToast('Failed to upload picture: ' + (data.message || 'Unknown error'), 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error uploading picture', 'error');
    });
}

// ============================================
// FORM HANDLERS
// ============================================

function initializeFormHandlers() {
    // Profile form
    const saveProfileBtn = document.getElementById('saveProfileBtn');
    if (saveProfileBtn) {
        saveProfileBtn.addEventListener('click', saveProfile);
    }

    // Password form
    const savePasswordBtn = document.getElementById('savePasswordBtn');
    if (savePasswordBtn) {
        savePasswordBtn.addEventListener('click', savePassword);
    }

    // Language form
    const saveLanguageBtn = document.getElementById('saveLanguageBtn');
    if (saveLanguageBtn) {
        saveLanguageBtn.addEventListener('click', saveLanguage);
    }

    // Event form
    const eventForm = document.getElementById('eventForm');
    if (eventForm) {
        eventForm.addEventListener('submit', createEvent);
    }

    // Create event buttons
    const createEventBtns = document.querySelectorAll('#openCreateEventBtn, #openCreateEventBtn2, #createEventFromEmpty');
    createEventBtns.forEach(btn => {
        if (btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                // Reset form for creating new event
                document.getElementById('eventForm').reset();
                document.getElementById('eventId').value = '';
                document.getElementById('eventModalTitle').textContent = 'Create Event';
                document.getElementById('eventSubmitBtn').textContent = 'Create Event';
                openModal('eventModal');
            });
        }
    });
}

function saveProfile() {
    const form = document.getElementById('profileForm');
    const formData = new FormData(form);
    formData.append('action', 'update_profile');

    fetch('api/update_profile.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            showToast('Profile updated successfully!', 'success');
        } else {
            showToast(data.message || 'Failed to update profile', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error updating profile', 'error');
    });
}

function savePassword() {
    const form = document.getElementById('changePasswordForm');
    const newPassword = form.querySelector('input[name="new_password"]').value;
    const confirmPassword = form.querySelector('input[name="confirm_password"]').value;

    if (newPassword !== confirmPassword) {
        showToast('Passwords do not match', 'error');
        return;
    }

    const formData = new FormData(form);
    formData.append('action', 'change_password');

    fetch('api/update_settings.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'otp_sent' || data.status === 'success') {
            showToast('Password update initiated. Check your email for OTP.', 'success');
            form.reset();
        } else {
            showToast(data.message || 'Failed to update password', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error updating password', 'error');
    });
}

function saveLanguage() {
    const language = document.getElementById('languageSelect').value;

    fetch('api/update_settings.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'language=' + encodeURIComponent(language)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            showToast('Language updated successfully!', 'success');
        } else {
            showToast('Failed to update language', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error updating language', 'error');
    });
}

function createEvent(e) {
    e.preventDefault();
    
    const form = document.getElementById('eventForm');
    const eventId = document.getElementById('eventId').value;
    const formData = new FormData(form);
    
    const isEditing = eventId && eventId.trim() !== '';
    const endpoint = isEditing ? 'api/UpdateEvent.php' : 'api/create_event.php';
    const successMessage = isEditing ? 'Event updated successfully!' : 'Event created successfully!';

    fetch(endpoint, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        // Handle both JSON and text responses
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            return response.json();
        } else {
            return response.text().then(text => {
                // Try to parse as JSON, if fails return as success
                try {
                    return JSON.parse(text);
                } catch (e) {
                    return { status: 'success', message: successMessage };
                }
            });
        }
    })
    .then(data => {
        if (data.status === 'success' || (typeof data === 'string' && data.includes('success'))) {
            showToast(successMessage, 'success');
            closeModal('eventModal');
            form.reset();
            document.getElementById('eventId').value = '';
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showToast(data.message || 'Failed to save event', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error saving event', 'error');
    });
}

// ============================================
// TOGGLE SWITCHES
// ============================================

function initializeToggleSwitches() {
    const toggles = document.querySelectorAll('.toggle-input');

    toggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const toggleLabel = this.nextElementSibling;
            if (toggleLabel) {
                toggleLabel.classList.toggle('active');
            }

            // Handle specific toggle switches
            if (this.id === 'darkModeToggle') {
                toggleDarkMode(this.checked);
            }

            if (this.id === 'showBioToggle') {
                const previewBio = document.getElementById('previewBio');
                if (previewBio) {
                    previewBio.style.display = this.checked ? 'block' : 'none';
                }
            }

            if (this.id === 'publicProfileToggle') {
                updateProfileVisibility();
            }

            // Save visibility settings
            if (this.id.includes('Toggle')) {
                saveVisibilitySettings();
            }
        });
    });
}

function toggleDarkMode(enabled) {
    if (enabled) {
        document.body.classList.add('dark-mode');
        localStorage.setItem('darkMode', 'enabled');
    } else {
        document.body.classList.remove('dark-mode');
        localStorage.setItem('darkMode', 'disabled');
    }
}

function updateProfileVisibility() {
    const publicProfile = document.getElementById('publicProfileToggle').checked;
    const previewCard = document.querySelector('.preview-card');
    
    if (previewCard) {
        if (publicProfile) {
            previewCard.style.opacity = '1';
        } else {
            previewCard.style.opacity = '0.5';
        }
    }
}

function saveVisibilitySettings() {
    const settings = {
        public_profile: document.getElementById('publicProfileToggle').checked,
        show_bio: document.getElementById('showBioToggle').checked,
        show_email: document.getElementById('showEmailToggle').checked,
        show_event_count: document.getElementById('showEventCountToggle').checked
    };

    fetch('api/update_settings.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(settings)
    })
    .then(response => response.json())
    .catch(error => console.error('Error saving visibility settings:', error));
}

// ============================================
// SEARCH AND FILTER
// ============================================

function initializeSearchAndFilter() {
    const searchInput = document.getElementById('eventSearchInput');
    const statusFilter = document.getElementById('eventStatusFilter');

    if (searchInput) {
        searchInput.addEventListener('input', filterEvents);
    }

    if (statusFilter) {
        statusFilter.addEventListener('change', filterEvents);
    }
}

function filterEvents() {
    const searchQuery = (document.getElementById('eventSearchInput').value || '').toLowerCase();
    const statusFilter = document.getElementById('eventStatusFilter').value;
    const eventCards = document.querySelectorAll('.event-card');

    eventCards.forEach(card => {
        const eventName = card.dataset.name || '';
        const eventStatus = card.dataset.status || '';
        
        const matchesSearch = eventName.includes(searchQuery);
        const matchesStatus = !statusFilter || eventStatus === statusFilter;

        if (matchesSearch && matchesStatus) {
            card.style.display = 'flex';
            setTimeout(() => card.classList.add('fade-in'), 10);
        } else {
            card.style.display = 'none';
        }
    });
}

// ============================================
// EVENT ACTIONS
// ============================================

function openEditEventModal(eventId) {
    // Fetch event data
    fetch('api/get_event.php?id=' + eventId)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                showToast('Error loading event data', 'error');
                return;
            }

            // Populate form with event data
            document.getElementById('eventId').value = data.id;
            document.getElementById('eventModalTitle').textContent = 'Edit Event';
            document.getElementById('eventSubmitBtn').textContent = 'Update Event';
            document.querySelector('#eventForm input[name="name"]').value = data.name;
            document.querySelector('#eventForm textarea[name="description"]').value = data.description;
            document.querySelector('#eventForm input[name="capacity"]').value = data.capacity;
            document.querySelector('#eventForm input[name="event_date"]').value = data.event_date;
            document.querySelector('#eventForm input[name="event_time"]').value = data.event_time;
            document.querySelector('#eventForm input[name="location"]').value = data.location;
            document.querySelector('#eventForm select[name="status"]').value = data.status;

            openModal('eventModal');
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error loading event', 'error');
        });
}

function deleteEventConfirm(eventId) {
    if (confirm('Are you sure you want to delete this event? This action cannot be undone.')) {
        deleteEvent(eventId);
    }
}

function deleteEvent(eventId) {
    fetch('api/DeleteEvent.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id=' + eventId
    })
    .then(response => response.text())
    .then(data => {
        showToast('Event deleted successfully!', 'success');
        const eventCard = document.querySelector(`[data-event-id="${eventId}"]`);
        if (eventCard) {
            eventCard.style.opacity = '0';
            setTimeout(() => {
                eventCard.remove();
                location.reload();
            }, 500);
        } else {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error deleting event', 'error');
    });
}

function viewEventDetails(eventId) {
    fetch('api/get_event.php?id=' + eventId)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                showToast('Error loading event details', 'error');
                return;
            }

            const attendancePercent = data.capacity > 0 ? Math.round((data.attendees / data.capacity) * 100) : 0;
            const statusText = data.status == 1 ? 'Upcoming' : 'Finished';
            const statusColor = data.status == 1 ? '#3b82f6' : '#10b981';

            const detailsHtml = `
                <div class="event-details-view">
                    <h2>${data.name}</h2>
                    <div class="details-grid">
                        <div class="detail-item">
                            <strong>Status</strong>
                            <p><span class="status-badge" style="background-color: ${statusColor};">${statusText}</span></p>
                        </div>
                        <div class="detail-item">
                            <strong>Date</strong>
                            <p>${data.event_date}</p>
                        </div>
                        <div class="detail-item">
                            <strong>Time</strong>
                            <p>${data.event_time}</p>
                        </div>
                        <div class="detail-item">
                            <strong>Location</strong>
                            <p>${data.location}</p>
                        </div>
                    </div>
                    <div class="detail-section">
                        <strong>Description</strong>
                        <p>${data.description}</p>
                    </div>
                    <div class="detail-section">
                        <strong>Attendance</strong>
                        <p>${data.attendees} / ${data.capacity} attendees (${attendancePercent}%)</p>
                        <div class="capacity-bar">
                            <div class="bar-fill" style="width: ${attendancePercent}%;"></div>
                        </div>
                    </div>
                    <div class="details-actions">
                        <button class="btn-primary" onclick="openEditEventModal(${data.id})">Edit Event</button>
                        <button class="btn-danger" onclick="deleteEventConfirm(${data.id})">Delete Event</button>
                        <button class="btn-secondary" onclick="closeModal('eventDetailsModal')">Close</button>
                    </div>
                </div>
            `;

            document.getElementById('eventDetailsContent').innerHTML = detailsHtml;
            openModal('eventDetailsModal');
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error loading event details', 'error');
        });
}

// ============================================
// DATA EXPORT
// ============================================

function exportData(dataType, format) {
    const endpoint = 'api/export.php';
    
    fetch(endpoint, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `type=${dataType}&format=${format}`
    })
    .then(response => {
        if (format === 'json' || format === 'csv' || format === 'excel') {
            return response.blob();
        }
        return response.blob();
    })
    .then(blob => {
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `${dataType}_${new Date().getTime()}.${getFileExtension(format)}`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
        showToast(`${dataType} exported successfully!`, 'success');
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error exporting data', 'error');
    });
}

function getFileExtension(format) {
    const extensions = {
        'csv': 'csv',
        'pdf': 'pdf',
        'json': 'json',
        'excel': 'xlsx',
        'zip': 'zip'
    };
    return extensions[format] || format;
}

// ============================================
// MODAL FUNCTIONS
// ============================================

function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('active');
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('active');
    }
}

// Close modal when clicking close button
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-close')) {
        const modal = e.target.closest('.modal');
        if (modal) {
            modal.classList.remove('active');
        }
    }
});

// Close modal when clicking outside of it
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal')) {
        e.target.classList.remove('active');
    }
});

// ============================================
// TOAST NOTIFICATIONS
// ============================================

function showToast(message, type = 'info') {
    const toast = document.getElementById('toast');
    
    toast.textContent = message;
    toast.className = 'toast show ' + type;
    
    setTimeout(() => {
        toast.classList.remove('show');
    }, 4000);
}

// ============================================
// UTILITY FUNCTIONS
// ============================================

// Load dark mode preference on page load
function loadDarkModePreference() {
    const darkModeEnabled = localStorage.getItem('darkMode') === 'enabled';
    const darkModeToggle = document.getElementById('darkModeToggle');
    
    if (darkModeEnabled) {
        document.body.classList.add('dark-mode');
        if (darkModeToggle) {
            darkModeToggle.checked = true;
        }
    }
}

// Initialize dark mode on page load
document.addEventListener('DOMContentLoaded', loadDarkModePreference);

// Add smooth scrolling
document.documentElement.style.scrollBehavior = 'smooth';
