<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Eventy - Connect Effortlessly</title>

    <!-- Google Fonts: added Simonetta -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Playfair+Display:wght@700&family=Simonetta:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Vantage Style CSS -->
    <link rel="stylesheet" href="assets/css/vantage-style.css">
    <!-- Project styles (moved from inline to assets/css/site.css) -->
    <link rel="stylesheet" href="assets/css/site.css">
</head>

<body>
    <!-- site header moved outside hero so it can be styled / separated -->
    <header class="site-header">
        <div class="container">
            <div style="width:100%">
                <nav>
                    <div class="logo">
                        <div class="brand">
                            <img src="assets/logo/eventy_logo.png" alt="Eventy logo">
                        </div>
                    </div>

                    <div class="nav-links" aria-hidden="true">
                        <a href="#home">Home</a>
                        <a href="#about-us">About us</a>
                        <a href="#features">Features</a>
                        <a href="#contacts">Contacts</a>
                    </div>
                    <a class="btn" href="#">Get Started</a>
                </nav>
            </div>
        </div>
    </header>

    <section id="home" class="hero">
        <div class="container">
            <div style="width:100%">
                <!-- header moved to top of page; hero content starts here -->

                <div class="hero-grid">
                    <div class="left">
                        <div class="eyebrow">Community • Events</div>
                        <h1><strong>Connect Effortlessly</strong></h1>
                        <p class="lead">Bringing people together has never been easier. Host events, join activities, and meet like‑minded people — all in one place.</p>

                        <div class="cta-row">
                            <a id="openLoginModal" class="btn" href="#" aria-haspopup="dialog">Already Have an Account? →</a>
                        </div>
                    </div>

                    <div class="illustration" aria-hidden="false">
                        <div class="auth-card" role="region" aria-label="Login form">
                            <h2>Registration</h2>

                            <form method="POST" action="src/php/register.php" id="regForm">
                                <div class="form-group">
                                    <input id="firstname" name="firstname" type="text" placeholder="First name" required>
                                    <span class="error" id="fnameError"></span>
                                </div>

                                <div class="form-group">
                                    <input id="lastname" name="lastname" type="text" placeholder="Last name" required>
                                    <span class="error" id="lnameError"></span>
                                </div>

                                <div class="form-group">
                                    <input id="email" name="email" type="email" placeholder="Email" required>
                                    <span class="error" id="emailError"></span>
                                </div>

                                <div class="form-group">
                                    <input id="contactno" name="contactno" type="text" placeholder="Contact Number" required>
                                    <span class="error" id="contactError"></span>
                                </div>

                                <div class="form-group">
                                    <input id="password" name="password" type="password" placeholder="Password" required>
                                    <span class="error" id="passwordError"></span>
                                </div>

                                <button type="submit" class="btn-primary">Create Account</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- About Us Section -->
    <section id="about-us" class="about-us">
            <i class="fas fa-users about-icon"></i>
            <h2 class="about-title">About Us</h2>


        <div class="container">
            <p class="about-description">Eventy is a platform designed to bring communities together through seamless event management. Whether you're hosting a local meetup, a corporate conference, or a social gathering, our tools make it easy to connect with like-minded people and create unforgettable experiences.</p>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">

        <div class="section-header">
            <h2 class="section-title">Features</h2>
            <p class="section-description">Discover the powerful features that make Eventy the ultimate platform for event management.</p>
        </div>

        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-calendar-plus feature-icon"></i>
                    <h3 class="feature-title">Easy Event Creation</h3>
                    <p class="feature-description">Create and manage events with our intuitive interface. Set dates, locations, and descriptions in minutes.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-users-cog feature-icon"></i>
                    <h3 class="feature-title">Community Building</h3>
                    <p class="feature-description">Connect with attendees, share updates, and build lasting relationships through our integrated community tools.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-bell feature-icon"></i>
                    <h3 class="feature-title">Real-Time Updates</h3>
                    <p class="feature-description">Stay informed with live notifications and updates on event changes, RSVPs, and more.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contacts" class="footer">
        <div class="container">
       <div class="footer-content">
            <div class="footer-section">
                <div class="footer-logo">
                    <h4 class="footer-title">Eventy</h4>
                </div>
                <p class="footer-description">
                    Your Event Organizer platform,
                    powering the future of community engagement.
                </p>
            </div>

                <div class="footer-section">
                    <h4 class="footer-title">About</h4>
                    <ul class="footer-links">
                        <li><a href="#about-us">About Us</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="pages/our_team.php">Our Team</a></li>
                        <li><a href="#">Careers</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4 class="footer-title">Support</h4>
                    <ul class="footer-links">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="pages/contact_us.php">Contact Us</a></li>
                        <li><a href="pages/faq.php">FAQ</a></li>
                        <li><a href="pages/privacy_policy.php">Privacy Policy</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4 class="footer-title">Contacts</h4>
                    <p><strong>Eventy Team:</strong> Dela Cruz, Cuevas, Suba, Lontoc</p>
                    <div>
                        <p><strong>Email:</strong> support@eventy.com</p>
                        <p><strong>Phone:</strong> +63 123-4567</p>
                        <p><strong>Address:</strong> Jhocson St., Sampaloc, Manila, Philippines 1008</p>
                    </div>
                </div>
            </div>
        </div>
                    <div class="footer-bottom">
                <p>© 2025 Eventy. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
            </div>
    </footer>

    
    <!-- Login modal (for "Already Have an Account?") -->
    <div id="loginModal" class="modal-overlay" role="dialog" aria-modal="true" aria-hidden="true">
        <div class="modal" role="document" aria-labelledby="loginTitle">
            <button class="close-modal" aria-label="Close">&times;</button>
            <h3 id="loginTitle">Sign in</h3>
            <form id="loginModalForm" class="auth-form" autocomplete="on" novalidate>
                <div class="form-group">
                    <label class="sr-only" for="modal-username">Username</label>
                    <input id="modal-username" name="username" type="text" placeholder="Username" required>
                </div>

                <div class="form-group password-row">
                    <label class="sr-only" for="modal-password">Password</label>
                    <input id="modal-password" name="password" type="password" placeholder="Password" required>
                </div>

                <div class="actions" style="justify-content:flex-start;">
                    <label class="show-pw">
                        <input id="modal-showPw" type="checkbox" aria-controls="modal-password" />
                        <span class="checkbox" aria-hidden="true"></span>
                        <span class="label-text">Show password</span>
                    </label>
                </div>

                <div class="modal-actions" style="margin-top:16px;">
                    <button type="button" class="btn secondary" data-action="cancel">Cancel</button>
                    <button type="submit" class="btn primary">Sign in</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>

<script>
    // Toggle show password + Coming Soon modal
    (function() {
        const show = document.getElementById('showPw');
        const pwd = document.getElementById('password');
        if (show && pwd) {
            show.addEventListener('change', function() {
                pwd.type = this.checked ? 'text' : 'password';
            });
        }

        // Simple submit handler (replace with real auth)
        const form = document.getElementById('loginForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const u = document.getElementById('username').value.trim();
                // Basic validation
                if (!u || !pwd.value) {
                    alert('Please enter username and password.');
                    return;
                }
                // simulate submit
                alert('Signing in as ' + u);
                // TODO: replace with real POST to server
            });
        }

        /* Coming Soon modal logic */
        const modal = document.getElementById('comingSoonModal');
        if (modal) {
            const showTargets = document.querySelectorAll('nav .btn');

            function openModal(title, msg) {
                const h = modal.querySelector('#comingTitle');
                const p = modal.querySelector('#comingMsg');
                if (h) h.textContent = title || 'Feature Coming Soon';
                if (p) p.textContent = msg || 'This feature is being prepared. Stay tuned!';
                modal.setAttribute('open', '');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                modal.removeAttribute('open');
                modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }
            showTargets.forEach(el => {
                el.addEventListener('click', function(e) {
                    // only intercept the Get Started button
                    e.preventDefault();
                    openModal('Feature Coming Soon', 'This feature is being prepared. Stay tuned!');
                });
            });
            // close when clicking overlay or close buttons
            modal.addEventListener('click', function(e) {
                if (e.target === modal) closeModal();
            });
            // keep the top-right close button functional
            modal.querySelectorAll('.close-modal').forEach(b => b.addEventListener('click', closeModal));
            // make the modal action buttons close the modal as well
            modal.querySelectorAll('.modal-actions .btn').forEach(b => b.addEventListener('click', closeModal));
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.hasAttribute('open')) closeModal();
            });
        }

        /* Login modal logic (for "Already Have an Account?") */
        const loginModal = document.getElementById('loginModal');
        if (loginModal) {
            const openLoginModal = document.getElementById('openLoginModal');
            const closeLoginButtons = loginModal.querySelectorAll('.close-modal, .btn[data-action="cancel"]');

            function openLogin() {
                loginModal.setAttribute('open', '');
                loginModal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            }

            function closeLogin() {
                loginModal.removeAttribute('open');
                loginModal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }

            if (openLoginModal) {
                openLoginModal.addEventListener('click', function(e) {
                    e.preventDefault();
                    openLogin();
                });
            }

            closeLoginButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    closeLogin();
                });
            });

            // Toggle show password in login modal
            const modalShow = document.getElementById('modal-showPw');
            const modalPwd = document.getElementById('modal-password');
            if (modalShow && modalPwd) {
                modalShow.addEventListener('change', function() {
                    modalPwd.type = this.checked ? 'text' : 'password';
                });
            }

            // Simple login submit handler (replace with real auth)
            const loginForm = document.getElementById('loginModalForm');
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const u = document.getElementById('modal-username').value.trim();
                    const p = modalPwd.value;
                    // Basic validation
                    if (!u || !p) {
                        alert('Please enter username and password.');
                        return;
                    }
                    // simulate login
                    alert('Logging in as ' + u);
                    // TODO: replace with real POST to server
                });
            }
        }
    })();

<script>
document.getElementById("regForm").addEventListener("submit", function (e) {
    let valid = true;

    // Clear previous errors
    document.querySelectorAll(".error").forEach(el => el.textContent = "");

    let email = document.getElementById("email").value.trim();
    let contact = document.getElementById("contactno").value.trim();
    let password = document.getElementById("password").value.trim();

    // Email validation
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        document.getElementById("emailError").textContent = "Invalid email format.";
        valid = false;
    }

    // Contact number validation
    let contactPattern = /^09\d{9}$/;
    if (!contactPattern.test(contact)) {
        document.getElementById("contactError").textContent = "Must start with 09 and be 11 digits.";
        valid = false;
    }

    // Password validation
    let upper = /[A-Z]/.test(password);
    let lower = /[a-z]/.test(password);
    let number = /[0-9]/.test(password);

    if (!(upper && lower && number) || password.length < 8) {
        document.getElementById("passwordError").textContent =
            "At least 8 chars, 1 uppercase, 1 lowercase, 1 number.";
        valid = false;
    }

    // Stop form submit if errors exist
    if (!valid) {
        e.preventDefault();
    }
});
</script>

</script>

<script>
document.getElementById("regForm").addEventListener("submit", function (e) {
    let valid = true;

    // Clear previous errors
    document.querySelectorAll(".error").forEach(el => el.textContent = "");

    let email = document.getElementById("email").value.trim();
    let contact = document.getElementById("contactno").value.trim();
    let password = document.getElementById("password").value.trim();

    // Email validation
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        document.getElementById("emailError").textContent = "Invalid email format.";
        valid = false;
    }

    // Contact number validation
    let contactPattern = /^09\d{9}$/;
    if (!contactPattern.test(contact)) {
        document.getElementById("contactError").textContent = "Must start with 09 and be 11 digits.";
        valid = false;
    }

    // Password validation
    let upper = /[A-Z]/.test(password);
    let lower = /[a-z]/.test(password);
    let number = /[0-9]/.test(password);

    if (!(upper && lower && number) || password.length < 8) {
        document.getElementById("passwordError").textContent =
            "At least 8 chars, 1 uppercase, 1 lowercase, 1 number.";
        valid = false;
    }

    // Stop form submit if errors exist
    if (!valid) {
        e.preventDefault();
    }
});
</script>
