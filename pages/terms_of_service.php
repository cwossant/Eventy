<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
require_once '../config/database.php';
$db = new Database();
$conn = $db->getConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Terms of Service - Cephra</title>
    <link rel="icon" type="image/png" href="images/logo.png?v=2" />
    <link rel="apple-touch-icon" href="images/logo.png?v=2" />
    <link rel="manifest" href="manifest.webmanifest" />
    <meta name="theme-color" content="#1a1a2e" />
    <!-- Google Fonts: added Simonetta -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Playfair+Display:wght@700&family=Simonetta:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Vantage Style CSS -->
    <link rel="stylesheet" href="../assets/css/vantage-style.css">

    <style>
        /* load local Handyman font (place font files in /fonts/) */

        @font-face {
            font-family: "Handyman";
            src: url("../fonts/Handyman.woff2") format("woff2"), url("../fonts/Handyman.woff") format("woff"), url("../fonts/Handyman.ttf") format("truetype");
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }

         :root {
            --purple-1: #6b3be6;
            --purple-2: #7f4fdc;
            --accent: #ffffff;
            /* slightly less bright muted text for better contrast on purple */
            --muted: rgba(255, 255, 255, 0.88);
            --logo-size: clamp(36px, 6vw, 120px);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        html {
            scroll-behavior: smooth;
        }

        html,
        body {
            height: 100%
        }

        body {
            font-family: "Poppins", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: #f7f7fb;
            color: #111;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        /* HERO */

        .hero {
            position: relative;
            min-height: 100vh;
            /* changed from 85vh so hero always reaches bottom of the viewport */
            display: flex;
            align-items: flex-start;
            /* allow the wave to overlap outside the hero cleanly */
            overflow: visible;
            /* use image/bg.png only as the hero background (no overlays) */
            background: url('../assets/images/bg.png') center/cover no-repeat;
            color: var(--accent);
            padding: 28px 64px;
        }
        /* dotted pattern on the right - smaller, softly faded, responsive */

        .hero::before {
            content: "";
            position: absolute;
            right: clamp(28px, 6vw, 6%);
            top: clamp(24px, 5vh, 6%);
            width: clamp(160px, 20vw, 320px);
            height: clamp(160px, 20vw, 320px);
            /* small repeating dots */
            background-image: radial-gradient(rgba(255, 255, 255, 0.12) 1px, transparent 1px);
            background-size: 10px 10px;
            background-repeat: repeat;
            border-radius: 50%;
            opacity: 0.85;
            pointer-events: none;
            transform: translateZ(0);
            /* soft fade at the edges so it blends with the gradient */
            -webkit-mask-image: radial-gradient(circle at 60% 40%, black 55%, transparent 100%);
            mask-image: radial-gradient(circle at 60% 40%, black 55%, transparent 100%);
        }
        /* thin vertical guide - keep subtle and hide on small screens */

        .hero::after {
            content: "";
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 1px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.06) 0%, rgba(255, 255, 255, 0.02) 50%, transparent 100%);
            transform: translateX(-50%);
            pointer-events: none;
            opacity: 0.9;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            gap: 32px;
            align-items: center;
            position: relative;
            z-index: 2;
        }
        /* NAV */

        nav {
            display: flex;
            align-items: center;
            gap: 24px;
            width: 100%;
            padding: 8px 0 24px 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-right: auto;
            /* allow per-container override of logo size - falls back to :root --logo-size */
            --logo-size: var(--logo-size);
        }
        /* removed the fixed .logo img size so brand image can scale via the CSS variable */

        .logo img {
            display: block;
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .brand {
            font-weight: 900;
            letter-spacing: 0.4px;
            /* optional: set a different size for this logo instance:
               uncomment and tweak the line below to override :root for this .logo container
            */
            /* --logo-size: clamp(48px, 8vw, 140px); */
        }

        .brand img {
            /* use the adjustable variable so the logo scales with viewport */
            height: var(--logo-size);
            max-height: 140px;
            /* absolute upper bound */
            width: auto;
            display: block;
            object-fit: contain;
        }

        .nav-links {
            display: flex;
            gap: 20px;
            align-items: center;
            font-weight: 600;
            font-size: 15px;
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.95);
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 6px;
        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.06);
        }

        .cta-nav {
            margin-left: 16px;
            background: var(--accent);
            color: var(--purple-2);
            padding: 8px 16px;
            border-radius: 10px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        }
        /* Hero content layout */

        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 540px;
            gap: 32px;
            align-items: center;
            width: 100%;
        }

        .left {
            padding: 32px 0;
        }

        .eyebrow {
            display: inline-block;
            background: rgba(0, 0, 0, 0.08);
            color: var(--accent);
            padding: 6px 12px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 18px;
            opacity: 0.95;
        }
        /* Heading uses Simonetta */

        h1 {
            font-family: "Simonetta", "Playfair Display", serif;
            font-size: 64px;
            line-height: 0.95;
            margin-bottom: 18px;
            color: var(--accent);
            text-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        }
        /* Lead paragraph uses Handyman (fallback to a handwriting font) */

        p.lead {
            font-family: "Handyman", "Handlee", "Poppins", cursive;
            font-size: 18px;
            color: var(--muted);
            max-width: 540px;
            margin-bottom: 22px;
        }

        .cta-row {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .btn {
            background: var(--accent);
            color: var(--purple-2);
            padding: 12px 18px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            display: inline-flex;
            gap: 10px;
            align-items: center;
        }

        .btn.secondary {
            background: transparent;
            color: var(--accent);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 11px 16px;
            font-weight: 600;
        }
        /* Right illustration area */

        .illustration {
            position: relative;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            /* allow interaction for the form */
            pointer-events: auto;
        }
        /* Login form / auth card styles (replaces the decorative scene) */

        .auth-card {
            width: min(460px, 42vw);
            max-width: 100%;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.04), rgba(255, 255, 255, 0.02));
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 18px 50px rgba(0, 0, 0, 0.30);
            backdrop-filter: blur(6px);
</head>
<body>
    <!-- Header Removed -->

    <!-- Terms Hero -->
    <section class="terms-hero">
        <div class="container">
            <div class="terms-hero-content">
                <h1 style="font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 900; margin-bottom: 1rem; color: var(--text-primary);">Terms of Service</h1>
                <p style="font-size: 1.3rem; color: var(--text-secondary); max-width: 700px; margin: 0 auto 2rem;">Please read these terms carefully before using Cephra's services.</p>
            </div>
        </div>
    </section>

    <!-- Terms Content -->
    <section class="terms-content">
        <div class="container">
            <div class="terms-section">
                <h2>1. Introduction</h2>
                <p>Welcome to Cephra, an electric vehicle charging platform. These Terms of Service ("Terms") govern your use of our website, mobile application, and related services (collectively, the "Service"). By accessing or using the Service, you agree to be bound by these Terms.</p>
            </div>

            <div class="terms-section">
                <h2>2. Acceptance of Terms</h2>
                <p>By creating an account or using the Service, you acknowledge that you have read, understood, and agree to be bound by these Terms and our Privacy Policy. If you do not agree to these Terms, please do not use the Service.</p>
            </div>

            <div class="terms-section">
                <h2>3. Use of Service</h2>
                <p>You may use the Service only for lawful purposes and in accordance with these Terms. You agree not to:</p>
                <ul>
                    <li>Use the Service in any way that violates applicable laws or regulations</li>
                    <li>Attempt to gain unauthorized access to our systems</li>
                    <li>Interfere with or disrupt the Service</li>
                    <li>Use the Service for any commercial purpose without our written consent</li>
                </ul>
            </div>

            <div class="terms-section">
                <h2>4. User Accounts</h2>
                <p>To use certain features of the Service, you must create an account. You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account. You agree to provide accurate and complete information when creating your account.</p>
            </div>

            <div class="terms-section">
                <h2>5. Payment and Billing</h2>
                <p>Some services may require payment. All fees are non-refundable unless otherwise specified. You agree to pay all charges associated with your use of the Service. We reserve the right to change our pricing at any time.</p>
            </div>

            <div class="terms-section">
                <h2>6. Intellectual Property</h2>
                <p>The Service and its original content, features, and functionality are owned by Cephra and are protected by copyright, trademark, and other intellectual property laws. You may not reproduce, distribute, or create derivative works without our written consent.</p>
            </div>

            <div class="terms-section">
                <h2>7. Limitation of Liability</h2>
                <p>To the maximum extent permitted by law, Cephra shall not be liable for any indirect, incidental, special, or consequential damages arising out of or in connection with your use of the Service.</p>
            </div>

            <div class="terms-section">
                <h2>8. Termination</h2>
                <p>We reserve the right to terminate or suspend your account and access to the Service at our sole discretion, without prior notice, for conduct that we believe violates these Terms or is harmful to other users, us, or third parties.</p>
            </div>

            <div class="terms-section">
                <h2>9. Governing Law</h2>
                <p>These Terms shall be governed by and construed in accordance with the laws of the Philippines, without regard to its conflict of law provisions.</p>
            </div>

            <div class="terms-section">
                <h2>10. Changes to Terms</h2>
                <p>We reserve the right to modify these Terms at any time. We will notify users of any changes by posting the new Terms on this page. Your continued use of the Service after such changes constitutes your acceptance of the new Terms.</p>
            </div>

            <div class="terms-section">
                <h2>11. Contact Information</h2>
                <p>If you have any questions about these Terms, please contact us at support@cephra.com.</p>
            </div>

            <p style="text-align: center; margin-top: 3rem; color: var(--text-muted);">Last updated: September 2025</p>
        </div>
    </section>

    <!-- Footer -->
    <?php include __DIR__ . '/partials/footer.php'; ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.dropotron.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        // Add scroll effect to header
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
