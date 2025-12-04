<!DOCTYPE html>
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
    <link rel="stylesheet" href="../assets/css/vantage-style.css">

    <style>
        :root {
            --purple-1: #6b3be6;
            --purple-2: #7f4fdc;
            --accent: #ffffff;
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

        /* Header styles */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100vw;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .header.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.15);
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 64px;
        }

        nav {
            display: flex;
            align-items: center;
            gap: 24px;
            width: 100%;
            padding: 16px 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-right: auto;
        }

        .logo img {
            display: block;
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            height: var(--logo-size);
            width: auto;
        }

        .brand {
            font-weight: 900;
            letter-spacing: 0.4px;
        }

        .nav-links {
            display: flex;
            gap: 20px;
            align-items: center;
            font-weight: 600;
            font-size: 15px;
        }

        .nav-links a {
            color: #111;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 6px;
        }

        .nav-links a:hover {
            background: rgba(107, 59, 230, 0.1);
            color: var(--purple-2);
        }

        .cta-nav {
            margin-left: 16px;
            background: var(--purple-2);
            color: var(--accent);
            padding: 8px 16px;
            border-radius: 10px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 20px;
            }

            nav {
                padding: 12px 0;
            }

            .nav-links {
                display: none;
            }

            .cta-nav {
                margin-left: auto;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <nav>
                <div class="logo">
                    <a href="../index.php" class="brand">
                        <img src="../assets/logo/eventy_logo.png" alt="Eventy logo">
                    </a>
                </div>

                <div class="nav-links">
                    <a href="../index.php">Home</a>
                    <a href="../index.php#about-us">About us</a>
                    <a href="../index.php#features">Features</a>
                    <a href="#contacts">Contacts</a>
                    <a href="our_team.php">Our Team</a>
                    <a href="help_center.php">Help Center</a>
                    <a href="contact_us.php">Contact Us</a>
                </div>
                <a class="cta-nav" href="../index.php">Get Started</a>
            </nav>
        </div>
    </header>
