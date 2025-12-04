<!-- Footer -->
    <footer class="footer">
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
                        <li><a href="../index.php#about-us">About Us</a></li>
                        <li><a href="../index.php#features">Features</a></li>
                        <li><a href="our_team.php">Our Team</a></li>
                        <li><a href="#">Careers</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4 class="footer-title">Support</h4>
                    <ul class="footer-links">
                        <li><a href="help_center.php">Help Center</a></li>
                        <li><a href="contact_us.php">Contact Us</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="privacy_policy.php">Privacy Policy</a></li>
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
            <p>© 2025 Eventy. All rights reserved. | <a href="privacy_policy.php">Privacy Policy</a> | <a href="terms_of_service.php">Terms of Service</a></p>
        </div>
    </footer>

    <style>
        .footer {
            background: linear-gradient(180deg, #7f4fdc, #6b3be6);
            color: #ffffff;
            padding: 40px 64px 20px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            gap: 40px;
            margin-bottom: 20px;
        }

        .footer-section {
            flex: 1;
        }

        .footer-title {
            font-size: 20px;
            margin-bottom: 16px;
            color: #ffffff;
            font-weight: 700;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 8px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
        }

        .footer-links a:hover {
            color: #ffffff;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            padding-top: 24px;
            text-align: center;
        }

        .footer-bottom p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
        }

        .footer-bottom a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        .footer-bottom a:hover {
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .footer {
                padding: 40px 20px 20px;
            }

            .footer-content {
                flex-direction: column;
                gap: 30px;
            }
        }
    </style>

    <script>
        // Add scroll effect to header
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (header && window.scrollY > 100) {
                header.classList.add('scrolled');
            } else if (header) {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
