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
    const formData = new FormData(form);

    fetch('api/create_event.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            showToast('Event created successfully!', 'success');
            closeModal('eventModal');
            form.reset();
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showToast(data.message || 'Failed to create event', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error creating event', 'error');
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

function editEvent(eventId) {
    showToast('Edit functionality coming soon!', 'info');
    // TODO: Implement event editing
}

function deleteEvent(eventId) {
    if (confirm('Are you sure you want to delete this event?')) {
        fetch('api/DeleteEvent.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id=' + eventId
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showToast('Event deleted successfully!', 'success');
                document.querySelector(`[data-event-id="${eventId}"]`).remove();
                setTimeout(() => location.reload(), 1500);
            } else {
                showToast('Failed to delete event', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error deleting event', 'error');
        });
    }
}

function viewEventDetails(eventId) {
    showToast('Event details coming soon!', 'info');
    // TODO: Implement event details view
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
