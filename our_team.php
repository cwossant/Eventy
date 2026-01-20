
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Our Team - Cephra</title>
    <link rel="icon" type="image/png" href="images/logo.png?v=2" />
    <link rel="apple-touch-icon" href="images/logo.png?v=2" />
    <link rel="manifest" href="manifest.webmanifest" />
    <meta name="theme-color" content="#1a1a2e" />
    <link rel="stylesheet" href="css/vantage-style.css" />
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #723FBD;
            --primary-dark: #693ABB;
            --secondary-color: #f8fafc;
            --accent-color: #e2e8f0;
            --text-primary: #1a202c;
            --text-secondary: rgba(26, 32, 44, 0.8);
            --text-muted: rgba(26, 32, 44, 0.6);
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-card: #ffffff;
            --border-color: rgba(26, 32, 44, 0.1);
            --shadow-light: rgba(114, 63, 189, 0.1);
            --shadow-medium: rgba(114, 63, 189, 0.2);
            --shadow-strong: rgba(114, 63, 189, 0.3);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Poppins', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ==================== NAVBAR ==================== */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            z-index: 999;
            transition: all 0.3s ease;
            padding: 16px 0;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #723FBD 0%, #683ABB 25%, #7743BF 50%, #683ABB 75%, #693ABB 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            opacity: 0.8;
        }

        .navbar-links {
            display: flex;
            gap: 2rem;
            align-items: center;
            list-style: none;
        }

        .navbar-link {
            text-decoration: none;
            color: var(--text-secondary);
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-link:hover {
            color: var(--primary-color);
        }

        .navbar-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }

        .navbar-link:hover::after {
            width: 100%;
        }

        /* ==================== BACK BUTTON CIRCLE ==================== */
        .back-button-circle {
            position: fixed;
            right: 30px;
            bottom: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #723FBD 0%, #683ABB 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 500;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(114, 63, 189, 0.3);
            text-decoration: none;
            color: white;
            font-size: 1.5rem;
        }

        .back-button-circle:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 12px 35px rgba(114, 63, 189, 0.4);
        }

        .back-button-circle:active {
            transform: translateY(-2px) scale(1.05);
        }

        /* ==================== HERO SECTION ==================== */
        .team-hero {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 140px 0 80px;
            text-align: center;
            margin-top: 70px;
            animation: heroFadeIn 0.8s ease-out;
        }

        @keyframes heroFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .leadership-section {
            padding: 80px 0;
            background: white;
        }

        .leadership-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 3rem;
            margin-bottom: 4rem;
        }

        .team-section {
            padding: 80px 0;
            background: var(--bg-secondary);
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        /* ==================== TEAM MEMBER CARDS ==================== */
        .team-member-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            animation: cardSlideUp 0.6s ease-out forwards;
            opacity: 0;
        }

        .team-member-card:nth-child(1) { animation-delay: 0.1s; }
        .team-member-card:nth-child(2) { animation-delay: 0.2s; }
        .team-member-card:nth-child(3) { animation-delay: 0.3s; }
        .team-member-card:nth-child(4) { animation-delay: 0.4s; }

        @keyframes cardSlideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .team-member-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px var(--shadow-medium);
            border-color: var(--primary-color);
        }

        .member-photo {
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, #723FBD 0%, #683ABB 25%, #7743BF 50%, #683ABB 75%, #693ABB 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            border-radius: 50%;
            margin: 20px auto 0;
        }

        .member-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .member-photo-placeholder {
            font-size: 4rem;
            color: white;
        }

        .member-info {
            padding: 1.5rem;
            text-align: center;
        }

        .member-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .member-role {
            font-size: 1rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .member-bio {
            color: var(--text-secondary);
            line-height: 1.6;
            font-size: 0.9rem;
        }

        .member-social {
            position: absolute;
            top: 10px;
            right: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .team-member-card:hover .member-social {
            opacity: 1;
        }

        .social-links {
            display: flex;
            gap: 0.5rem;
        }

        .social-link {
            width: 35px;
            height: 35px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }

        .department-filter {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.75rem 1.5rem;
            border: 2px solid var(--border-color);
            background: white;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            color: var(--text-secondary);
            transition: all 0.3s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            border-color: var(--primary-color);
            color: var(--primary-color);
            background: rgba(114, 63, 189, 0.05);
        }

        .join-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #723FBD 0%, #683ABB 25%, #7743BF 50%, #683ABB 75%, #693ABB 100%);
            color: white;
            text-align: center;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-block;
        }

        .btn-primary {
            background: white;
            color: var(--primary-color);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
        }

        .btn-secondary {
            background: var(--primary-color);
            color: white;
            border: 2px solid var(--primary-color);
        }

        .btn-secondary:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        /* ==================== TEAM STATISTICS ==================== */
        .team-stats {
            padding: 80px 0;
            background: white;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e0 100%);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, #723FBD 0%, #683ABB 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1rem;
            color: var(--text-secondary);
            font-weight: 600;
        }

        /* ==================== FOOTER ==================== */
        .footer-wrapper {
            background: #1a202c;
            color: white;
            padding: 80px 0 20px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding: 0 20px;
        }

        .footer-section h3 {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            color: white;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 1rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--primary-color);
            padding-left: 5px;
        }

        .footer-contact {
            color: rgba(255, 255, 255, 0.7);
        }

        .footer-contact dt {
            font-weight: 600;
            color: white;
            margin-top: 1rem;
            margin-bottom: 0.3rem;
        }

        .footer-contact dd {
            margin-left: 0;
            margin-bottom: 1rem;
        }

        .footer-contact a {
            color: var(--primary-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-contact a:hover {
            text-decoration: underline;
        }

        .footer-social {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background: rgba(114, 63, 189, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem 20px;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
        }

        .footer-bottom a {
            color: var(--primary-color);
            text-decoration: none;
        }

        /* Hide unwanted titleBar */
        #titleBar {
            display: none !important;
        }

        @media (max-width: 768px) {
            .navbar-links {
                gap: 1rem;
                font-size: 0.9rem;
            }

            .team-hero {
                padding: 100px 20px 60px;
            }

            .leadership-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .team-grid {
                grid-template-columns: 1fr;
            }

            .department-filter {
                gap: 0.5rem;
            }

            .filter-btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            .member-photo {
                width: 150px;
                height: 150px;
            }

            .back-button-circle {
                right: 20px;
                bottom: 20px;
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }

            .footer-content {
                gap: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-content">
            <a href="index.php" class="navbar-brand">Eventy</a>
            <ul class="navbar-links">
                <li><a href="index.php" class="navbar-link">Home</a></li>
                <li><a href="index.php#main-wrapper" class="navbar-link">Features</a></li>
                <li><a href="our_team.php" class="navbar-link">Our Team</a></li>
                <li><a href="#footer-wrapper" class="navbar-link">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Back Button Circle -->
    <a href="index.php" class="back-button-circle" title="Go back to Home">
        <i class="fas fa-arrow-left"></i>
    </a>
    <!-- Header -->
    <!-- Team Hero -->
    <section class="team-hero">
        <div class="container">
            <h1 style="font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 900; margin-bottom: 1rem; background: linear-gradient(135deg, #723FBD 0%, #683ABB 25%, #7743BF 50%, #683ABB 75%, #693ABB 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Meet Our Team</h1>
            <p style="font-size: 1.3rem; color: var(--text-secondary); max-width: 600px; margin: 0 auto 2rem;">The passionate individuals driving Eventy's mission to modernize event management system.</p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">

                <a href="#leadership" class="btn btn-secondary">Our Team</a>
            </div>
        </div>
    </section>

    <!-- Leadership Section -->
    <section class="leadership-section" id="leadership">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 60px; animation: fadeInDown 0.8s ease-out;">
                <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem; background: linear-gradient(135deg, #723FBD 0%, #683ABB 25%, #7743BF 50%, #683ABB 75%, #693ABB 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Our Team</h2>
                <p style="font-size: 1.2rem; color: var(--text-secondary);">Visionary leaders guiding our mission</p>
            </div>

            <div class="leadership-grid">
                <div class="team-member-card">
                    <div class="member-photo">
                        <img src="images/team pictures/suba.jpg" alt="Yhvhan Suba" />
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">Yhvhan Suba</h3>
                        <div class="member-role">Project Lead</div>
                        <p class="member-bio">- Backend logic & project coordination</p>
                        <p class="member-bio">- Manages Eventy system flow</p>
                    </div>
                    <div class="member-social">
                        <div class="social-links">
                            <a href="https://github.com/ItzEvhyx" target="_blank" class="social-link"><i class="fab fa-github"></i></a>
                        </div>
                        <div class="social-links">
                            <a style="margin-top: 10px;" href="https://www.linkedin.com/in/yhvhan-suba-4b985339b/" target="_blank" class="social-link"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="team-member-card">
                    <div class="member-photo">
                        <img src="images/team pictures/delacruz.jpeg" alt="Mark Dwayne P. Dela Cruz" />
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">Mark Dwayne P. Dela Cruz</h3>
                        <div class="member-role">User Interface & User Experience</div>
                        <p class="member-bio">- Designs and develops mobile web interface for customers</p>
                        <p class="member-bio">- Focuses on intuitive, responsive layouts</p>

                    </div>
                    <div class="member-social">
                        <div class="social-links">
                            <a href="https://github.com/cwossant" target="_blank" class="social-link"><i class="fab fa-github"></i></a>
                        </div>
                        <div class="social-links">
                            <a style="margin-top: 10px;" href="https://www.linkedin.com/in/markdwaynedelacruz/" target="_blank" class="social-link"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                    
                </div>

                <div class="team-member-card">
                    <div class="member-photo">
                        <img src="images/team pictures/lontoc.png" alt="Joseph Gabriel Lontoc" />
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">Joseph Gabriel Lontoc</h3>
                        <div class="member-role">Database Developer</div>
                         <p class="member-bio">- Expert in Database Architechture</p>
                        <p class="member-bio">- Handles database design</p>
                    </div>
                    <div class="member-social">
                        <div class="social-links">
                            <a href="https://github.com/banana-juice" target="_blank" class="social-link"><i class="fab fa-github"></i></a>
                        </div>
                        <div class="social-links">
                            <a style="margin-top: 10px;" href="https://www.linkedin.com/in/joseph-gabriel-lontoc-34649b295/" target="_blank" class="social-link"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="team-member-card">
                    <div class="member-photo">
                        <img src="images/team pictures/bruce.jpg" alt="Bruce Cuevas" />
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">Bruce Cuevas</h3>
                        <div class="member-role">Frontend Development</div>
                         <p class="member-bio">- Specializes in Frontend Design</p>  
                        <p class="member-bio">- Focuses on building an intuitive and functional desktop interface</p>
                    </div>


                    <div class="member-social">
                        <div class="social-links">
                            <a href="https://github.com/wbcjep0108" target="_blank" class="social-link"><i class="fab fa-github"></i></a>
                        </div>
                        <div class="social-links">
                            <a style="margin-top: 10px;" href="https://www.linkedin.com/in/wilhem-bruce-cuevas-452554379/" target="_blank" class="social-link"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>

                </div>
                
            </div>
        </div>
    </section>

    <!-- Team Statistics Section -->
    <section class="team-stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">4</div>
                    <div class="stat-label">Team Members</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Dedication</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">3+</div>
                    <div class="stat-label">Years Experience</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">∞</div>
                    <div class="stat-label">Potential</div>
                </div>
            </div>
        </div>
    </section>

   

    <!-- Join Section -->
    <section class="join-section">
        <div class="container">
            <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem;">Join Our Mission</h2>
            <p style="font-size: 1.2rem; margin-bottom: 2rem; opacity: 0.9;">We're always looking for talented individuals who share our passion for better event management.</p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="contact_us.php" class="btn btn-primary">Get in Touch</a>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="footer-wrapper" id="footer-wrapper">
        <div class="footer-content">
            <!-- Links Section -->
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php#main-wrapper">Features</a></li>
                    <li><a href="our_team.php">Our Team</a></li>
                    <li><a href="#footer-wrapper">Contact</a></li>
                </ul>
            </div>

            <!-- About Section -->
            <div class="footer-section">
                <h3>About Eventy</h3>
                <p>A modern event management platform designed to simplify event organization and enhance participant experience.</p>
                <div class="footer-social">
                    <a href="https://github.com" target="_blank" class="social-icon"><i class="fab fa-github"></i></a>
                    <a href="https://linkedin.com" target="_blank" class="social-icon"><i class="fab fa-linkedin"></i></a>
                    <a href="https://twitter.com" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="footer-section">
                <h3>Get in Touch</h3>
                <div class="footer-contact">
                    <dt>Email</dt>
                    <dd><a href="mailto:eventy.industries@gmail.com">eventy.industries@gmail.com</a></dd>
                    
                    <dt>Address</dt>
                    <dd>551 M.F. Jhocson Street<br />Sampaloc, Manila<br />Metro Manila, Philippines</dd>
                    
                    <dt>Phone</dt>
                    <dd><a href="tel:+63900000000">+63 (900) 000-0000</a></dd>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>&copy; 2026 Eventy. All rights reserved | <a href="our_team.php">Design by Eventy Team</a></p>
        </div>
    </footer>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.dropotron.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Department Filter Functionality
        function initDepartmentFilter() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const teamMembers = document.querySelectorAll('.team-member-card');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');

                    const filterValue = this.getAttribute('data-filter');

                    teamMembers.forEach(member => {
                        if (filterValue === 'all' || member.getAttribute('data-department') === filterValue) {
                            member.style.display = 'block';
                            setTimeout(() => {
                                member.style.opacity = '1';
                                member.style.transform = 'scale(1)';
                            }, 10);
                        } else {
                            member.style.opacity = '0';
                            member.style.transform = 'scale(0.8)';
                            setTimeout(() => {
                                member.style.display = 'none';
                            }, 300);
                        }
                    });
                });
            });
        }

        // Add scroll effect to header
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            initDepartmentFilter();

            // Add initial animation styles
            const teamMembers = document.querySelectorAll('.team-member-card');
            teamMembers.forEach(member => {
                member.style.transition = 'all 0.3s ease';
            });
        });
    </script>
</body>
</html>
