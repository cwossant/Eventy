<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Eventy - Connect Effortlessly</title>

    <!-- Google Fonts: added Simonetta -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Playfair+Display:wght@700&family=Simonetta:wght@400;700&display=swap" rel="stylesheet">

    <style>
        /* load local Handyman font (place font files in /fonts/) */
        
        @font-face {
            font-family: "Handyman";
            src: url("fonts/Handyman.woff2") format("woff2"), url("fonts/Handyman.woff") format("woff"), url("fonts/Handyman.ttf") format("truetype");
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
            display: flex;
            align-items: flex-start;
            overflow: visible;
            background: url('bg.png') center/cover no-repeat;
            color: var(--accent);
            padding: 28px 64px;
        }
        
        .hero::before {
            content: "";
            position: absolute;
            right: clamp(28px, 6vw, 6%);
            top: clamp(24px, 5vh, 6%);
            width: clamp(160px, 20vw, 320px);
            height: clamp(160px, 20vw, 320px);
            background-image: radial-gradient(rgba(255, 255, 255, 0.12) 1px, transparent 1px);
            background-size: 10px 10px;
            background-repeat: repeat;
            border-radius: 50%;
            opacity: 0.85;
            pointer-events: none;
            transform: translateZ(0);
            -webkit-mask-image: radial-gradient(circle at 60% 40%, black 55%, transparent 100%);
            mask-image: radial-gradient(circle at 60% 40%, black 55%, transparent 100%);
        }
        
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
            --logo-size: var(--logo-size);
        }
        
        .logo img {
            display: block;
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        
        .brand {
            font-weight: 900;
            letter-spacing: 0.4px;
        }
        
        .brand img {
            height: var(--logo-size);
            max-height: 140px;
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
        
        h1 {
            font-family: "Simonetta", "Playfair Display", serif;
            font-size: 64px;
            line-height: 0.95;
            margin-bottom: 18px;
            color: var(--accent);
            text-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        }
        
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
            cursor: pointer;
            border: none;
        }
        
        .btn.secondary {
            background: transparent;
            color: var(--accent);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 11px 16px;
            font-weight: 600;
        }
        
        .illustration {
            position: relative;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: auto;
        }
        
        .auth-card {
            width: min(460px, 42vw);
            max-width: 100%;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.04), rgba(255, 255, 255, 0.02));
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 18px 50px rgba(0, 0, 0, 0.30);
            backdrop-filter: blur(6px);
            color: var(--accent);
        }
        
        .auth-card h2 {
            margin: 0 0 14px 0;
            font-size: 28px;
            font-weight: 700;
            color: var(--accent);
            text-align: center;
            letter-spacing: 0.2px;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 12px;
            width: 100%;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 14px 16px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.03);
            color: var(--accent);
            outline: none;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }
        
        input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        
        .error {
            color: #ff6b6b;
            font-size: 12px;
            margin-top: 4px;
        }
        
        .actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 4px;
        }
        
        .show-pw {
            --cb-size: 20px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: var(--muted);
            cursor: pointer;
            user-select: none;
            position: relative;
            padding-left: calc(var(--cb-size) + 6px);
        }
        
        .show-pw input[type="checkbox"] {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: var(--cb-size);
            height: var(--cb-size);
            margin: 0;
            opacity: 0;
            cursor: pointer;
        }
        
        .show-pw .checkbox {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: var(--cb-size);
            height: var(--cb-size);
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.10);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.12);
            transition: background .16s ease, border-color .12s ease, transform .12s ease;
            display: inline-block;
            overflow: visible;
            z-index: 0;
        }
        
        .show-pw .checkbox::after {
            content: "";
            position: absolute;
            left: 50%;
            top: 50%;
            width: 12px;
            height: 12px;
            transform: translate(-50%, -50%) scale(.8);
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 12px 12px;
            background-image: none;
            opacity: 0;
            transition: opacity .14s ease, transform .18s ease;
            pointer-events: none;
            z-index: 1;
        }
        
        .show-pw input[type="checkbox"]:checked+.checkbox {
            background: #ffffff;
            border-color: rgba(0, 0, 0, 0.06);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
            transform: translateY(-50%) scale(1.02);
        }
        
        .show-pw input[type="checkbox"]:checked+.checkbox::after {
            background-image: url("data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%237f4fdc' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M20 6L9 17l-5-5'/%3E%3C/svg%3E");
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
        
        .show-pw input[type="checkbox"]:focus+.checkbox {
            box-shadow: 0 0 0 4px rgba(127, 79, 220, 0.12), inset 0 2px 4px rgba(0, 0, 0, 0.06);
            outline: none;
        }
        
        .show-pw .label-text {
            margin-left: 6px;
            color: var(--muted);
            transition: color .12s ease;
        }
        
        .show-pw input[type="checkbox"]:checked~.label-text,
        .show-pw input[type="checkbox"]:checked+.checkbox+.label-text {
            color: var(--muted) !important;
            font-weight: 400 !important;
        }
        
        @media (prefers-reduced-motion: reduce) {
            .show-pw .checkbox,
            .show-pw .checkbox::after {
                transition: none;
            }
        }
        
        .modal-overlay {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.65);
            z-index: 9999;
            padding: 24px;
        }
        
        .modal-overlay[open] {
            display: flex;
        }
        
        .modal {
            width: min(460px, 96%);
            background: linear-gradient(180deg, #ffffff, #f7f8fb);
            color: #111;
            border-radius: 12px;
            padding: 18px 18px 16px;
            box-shadow: 0 18px 60px rgba(0, 0, 0, 0.28);
            position: relative;
            text-align: center;
        }
        
        .modal h3 {
            margin: 0 0 8px;
            font-size: 18px;
            color: var(--purple-2);
            font-weight: 700;
        }
        
        .modal p {
            margin: 0 0 14px;
            color: #444;
            font-size: 14px;
        }
        
        .modal .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 6px;
        }
        
        .modal .btn {
            padding: 8px 14px;
            border-radius: 8px;
            font-weight: 700;
            box-shadow: none;
        }
        
        .modal .btn.secondary {
            background: transparent;
            color: var(--purple-2);
            border: 1px solid rgba(127, 79, 220, 0.12);
        }
        
        .modal .btn.primary {
            background: var(--purple-2);
            color: #fff;
            border: none;
        }
        
        .close-modal {
            position: absolute;
            right: 10px;
            top: 8px;
            background: transparent;
            border: none;
            font-size: 20px;
            color: #666;
            cursor: pointer;
            line-height: 1;
            padding: 6px;
        }
        
        .btn-primary {
            background: var(--accent);
            color: var(--purple-2);
            padding: 10px 16px;
            border-radius: 10px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.18);
            width: 100%;
        }
        
        .btn-primary:active {
            transform: translateY(1px);
        }
        
        .sr-only {
            position: absolute !important;
            height: 1px;
            width: 1px;
            overflow: hidden;
            clip: rect(1px, 1px, 1px, 1px);
            white-space: nowrap;
        }
        
        .password-row {
            display: block;
            margin-bottom: 12px;
        }
        
        .password-row input[type="password"],
        .password-row input[type="text"] {
            width: 100%;
            padding: 14px 16px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.03);
            color: var(--accent);
            font-size: 16px;
            box-sizing: border-box;
        }
        
        @media (max-width:980px) {
            .auth-card {
                width: min(420px, 90vw);
                padding: 16px;
            }
        }
        
        #loginModal .modal {
            width: min(460px, 42vw);
            max-width: 96%;
            background: linear-gradient(180deg, rgba(127, 79, 220, 0.22), rgba(127, 79, 220, 0.14));
            color: var(--accent);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.48);
            backdrop-filter: blur(8px);
            position: relative;
            text-align: left;
        }
        
        #loginModal .modal h3 {
            margin: 0 0 8px;
            font-size: 20px;
            color: var(--accent);
            font-weight: 700;
            text-align: center;
        }
        
        #loginModal .modal .auth-form {
            margin-top: 10px;
        }
        
        #loginModal .modal input[type="text"],
        #loginModal .modal input[type="password"] {
            padding: 14px 16px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: #ffffff;
            color: #111;
            width: 100%;
            box-sizing: border-box;
            font-size: 16px;
        }
        
        #loginModal .modal input::placeholder {
            color: #777;
        }
        
        #loginModal .modal .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 14px;
        }
        
        #loginModal .modal .btn.secondary {
            background: transparent;
            color: var(--accent);
            border: 1px solid rgba(255, 255, 255, 0.16);
            padding: 8px 12px;
            border-radius: 10px;
            font-weight: 700;
        }
        
        #loginModal .modal .btn.primary {
            background: var(--accent);
            color: var(--purple-2);
            padding: 8px 12px;
            border-radius: 10px;
            font-weight: 700;
        }
        
        #loginModal .show-pw {
            --cb-size: 20px;
            padding-left: calc(var(--cb-size) + 8px) !important;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #ffffff !important;
        }
        
        #loginModal .show-pw input[type="checkbox"]:checked+.checkbox {
            background: #ffffff !important;
            border-color: rgba(0, 0, 0, 0.06) !important;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12) !important;
            transform: translateY(-50%) scale(1.02);
        }
        
        #loginModal .show-pw input[type="checkbox"]:checked+.checkbox::after {
            background-image: url("data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%237f4fdc' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M20 6L9 17l-5-5'/%3E%3C/svg%3E");
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
        
        #loginModal .show-pw .checkbox {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            overflow: visible;
        }
        
        #loginModal .show-pw .checkbox::after {
            left: 50%;
            top: 50%;
            width: 12px;
            height: 12px;
            background-size: 12px 12px;
            background-position: center center;
            background-repeat: no-repeat;
            transform: translate(-50%, -50%) scale(.8);
        }
        
        /* OTP Modal Styling */
        #otpModal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }
        
        #otpModal.show {
            display: flex;
        }
        
        .otp-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 350px;
            text-align: center;
            box-shadow: 0 18px 60px rgba(0, 0, 0, 0.28);
        }
        
        .otp-container h2 {
            margin-bottom: 10px;
            font-size: 22px;
            color: var(--purple-2);
            font-weight: 700;
        }
        
        .otp-container p {
            margin-bottom: 20px;
            color: #6b3be6;
            font-size: 14px;
        }
        
        .otp-container input {
            width: 100%;
            font-size: 20px;
            padding: 12px;
            text-align: center;
            border: 2px solid #ddd;
            border-radius: 8px;
            letter-spacing: 8px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #6b3be6;  /* Add this line */
        }
        
        .otp-container input:focus {
            outline: none;
            border-color: var(--purple-2);
            box-shadow: 0 0 0 3px rgba(127, 79, 220, 0.1);
        }
        
        .otp-container button {
            width: 100%;
            padding: 12px;
            background: var(--purple-2);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
            font-size: 16px;
            transition: background .2s ease;
        }
        
        .otp-container button:hover {
            background: #6b3be6;
        }
        
        .otp-error {
            color: #ff6b6b;
            font-size: 12px;
            margin-top: 8px;
            display: none;
        }
    </style>
</head>

<body>

    <section class="hero">
        <div class="container">
            <div style="width:100%">
                <nav>
                    <div class="logo">
                        <div class="brand">
                            <img src="eventy_logo.png" alt="Eventy logo">
                        </div>
                    </div>

                    <div class="nav-links" aria-hidden="true">
                        <a href="#">Home</a>
                        <a href="#">About us</a>
                        <a href="#">Features</a>
                        <a href="#">Contacts</a>
                    </div>
                    <a class="btn" href="#">Get Started</a>
                </nav>

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
                       <div class="auth-card" role="region" aria-label="Registration form">
                            <h2>Registration</h2>
                            
                           <form id="registerForm" method="POST">
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

    <!-- Coming Soon modal -->
    <div id="comingSoonModal" class="modal-overlay" role="dialog" aria-modal="true" aria-hidden="true">
        <div class="modal" role="document" aria-labelledby="comingTitle">
            <button class="close-modal" aria-label="Close">&times;</button>
            <h3 id="comingTitle">Feature Coming Soon</h3>
            <p id="comingMsg">This feature is being prepared. Stay tuned!</p>
            <div class="modal-actions">
                <button class="btn primary" type="button">Okay</button>
            </div>
        </div>
    </div>

    <!-- Login modal (for "Already Have an Account?") -->
    <div id="loginModal" class="modal-overlay" role="dialog" aria-modal="true" aria-hidden="true">
        <div class="modal" role="document" aria-labelledby="loginTitle">
            <button class="close-modal" aria-label="Close">&times;</button>
            <h3 id="loginTitle">Sign in</h3>

            <form id="loginModalForm" class="auth-form" autocomplete="on" novalidate>
                <p id="loginError" style="color:red; display:none; margin-bottom:10px;"></p>
                <div class="form-group">
                    <label class="sr-only" for="modal-email">Email</label>
                    <input id="modal-email" name="email" type="email" placeholder="Email" required>
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

    <!-- OTP Modal -->
    <div id="otpModal">
        <div class="otp-container">
            <h2>Email Verification</h2>
            <p>Enter the 6-digit OTP sent to your email</p>
            <input type="text" id="otpInput" maxlength="6" placeholder="000000" required>
            <span class="otp-error" id="otpError"></span>
            <button type="button" id="otpSubmitBtn">Verify OTP</button>
        </div>
    </div>

</body>

</html>

<script>
    // Initialize all modals and form handlers
    (function() {
        // 1. COMING SOON MODAL
        const comingSoonModal = document.getElementById('comingSoonModal');
        if (comingSoonModal) {
            const navTargets = document.querySelectorAll('nav .nav-links a, nav .btn');
            
            function openComingSoon() {
                comingSoonModal.setAttribute('open', '');
                comingSoonModal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            }
            
            function closeComingSoon() {
                comingSoonModal.removeAttribute('open');
                comingSoonModal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }
            
            navTargets.forEach(el => {
                el.addEventListener('click', function(e) {
                    e.preventDefault();
                    openComingSoon();
                });
            });
            
            comingSoonModal.addEventListener('click', function(e) {
                if (e.target === comingSoonModal) closeComingSoon();
            });
            comingSoonModal.querySelectorAll('.close-modal, .modal-actions .btn').forEach(b => {
                b.addEventListener('click', closeComingSoon);
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && comingSoonModal.hasAttribute('open')) closeComingSoon();
            });
        }

        // 2. LOGIN MODAL
        const loginModal = document.getElementById('loginModal');
        if (loginModal) {
            const openLoginBtn = document.getElementById('openLoginModal');
            const closeLoginBtns = loginModal.querySelectorAll('.close-modal, .btn[data-action="cancel"]');
            const loginForm = document.getElementById('loginModalForm');
            const modalShowPw = document.getElementById('modal-showPw');
            const modalPassword = document.getElementById('modal-password');

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

            if (openLoginBtn) {
                openLoginBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    openLogin();
                });
            }

            closeLoginBtns.forEach(btn => btn.addEventListener('click', closeLogin));

            // Toggle password visibility
            if (modalShowPw && modalPassword) {
                modalShowPw.addEventListener('change', function() {
                    modalPassword.type = this.checked ? 'text' : 'password';
                });
            }

            // Handle login submission
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const email = document.getElementById('modal-email').value.trim();
                    const password = document.getElementById('modal-password').value.trim();
                    const errorBox = document.getElementById('loginError');

                    if (!email || !password) {
                        errorBox.textContent = 'Please enter your Email and Password.';
                        errorBox.style.display = 'block';
                        return;
                    }

                    fetch('api/login.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: new URLSearchParams({ email, password })
                    })
                    .then(res => res.text())
                    .then(data => {
                        if (data.trim() === 'success') {
                            window.location.href = 'Mainboard.php';
                        } else {
                            errorBox.textContent = 'Email or Password is Incorrect';
                            errorBox.style.display = 'block';
                        }
                    })
                    .catch(err => {
                        errorBox.textContent = 'Connection error. Try again.';
                        errorBox.style.display = 'block';
                    });
                });
            }
        }

        // 3. REGISTRATION FORM
        const registerForm = document.getElementById('registerForm');
        if (registerForm) {
            registerForm.addEventListener('submit', function(e) {
                e.preventDefault();

                let valid = true;
                document.querySelectorAll('.error').forEach(el => el.textContent = '');

                const firstname = document.getElementById('firstname').value.trim();
                const lastname = document.getElementById('lastname').value.trim();
                const email = document.getElementById('email').value.trim();
                const contact = document.getElementById('contactno').value.trim();
                const password = document.getElementById('password').value.trim();

                // Validate first name
                if (!firstname) {
                    document.getElementById('fnameError').textContent = 'First name is required.';
                    valid = false;
                }

                // Validate last name
                if (!lastname) {
                    document.getElementById('lnameError').textContent = 'Last name is required.';
                    valid = false;
                }

                // Validate email
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    document.getElementById('emailError').textContent = 'Invalid email format.';
                    valid = false;
                }

                // Validate contact
                if (!/^09\d{9}$/.test(contact)) {
                    document.getElementById('contactError').textContent = 'Must start with 09 and be 11 digits.';
                    valid = false;
                }

                // Validate password
                if (!/[A-Z]/.test(password) || !/[a-z]/.test(password) || !/[0-9]/.test(password) || password.length < 8) {
                    document.getElementById('passwordError').textContent = 'At least 8 chars, 1 uppercase, 1 lowercase, 1 number.';
                    valid = false;
                }

                if (!valid) return;

                // Submit registration
                fetch('api/register.php', {
                    method: 'POST',
                    body: new FormData(this)
                })
                .then(res => res.text())
                .then(response => {
                    console.log('Registration response:', response);
                    if (response.trim() === 'otp_required') {
                        document.getElementById('otpModal').classList.add('show');
                    } else if (response.trim() === 'email_exists') {
                        alert('Email already exists.');
                    } else if (response.trim() === 'invalid_email') {
                        alert('Invalid email format.');
                    } else if (response.trim() === 'invalid_contact') {
                        alert('Contact number must be like 09XXXXXXXXX.');
                    } else if (response.trim() === 'weak_password') {
                        alert('Password must be 8+ chars with upper, lower & number.');
                    } else if (response.trim() === 'mail_error') {
                        alert('Failed to send OTP email.');
                    } else {
                        alert('Error: ' + response);
                    }
                })
                .catch(err => {
                    console.error('Registration error:', err);
                    alert('An error occurred. Please try again.');
                });
            });
        }

        // 4. OTP VERIFICATION
       // 4. OTP VERIFICATION
const otpSubmitBtn = document.getElementById('otpSubmitBtn');
if (otpSubmitBtn) {
    otpSubmitBtn.addEventListener('click', function() {
        const otp = document.getElementById('otpInput').value.trim();
        const otpError = document.getElementById('otpError');

        if (otp.length !== 6 || !/^\d+$/.test(otp)) {
            otpError.textContent = 'Please enter a valid 6-digit OTP.';
            otpError.style.display = 'block';
            return;
        }

        otpError.style.display = 'none';

        fetch('api/verify_otp.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'otp=' + otp
        })
        .then(res => res.text())
        .then(response => {
            console.log('OTP response:', response);
            const trimmed = response.trim();

            if (trimmed === 'success') {
                window.location.href = 'Mainboard.php';

            } else if (trimmed === 'invalid_otp') {
                otpError.textContent = 'Incorrect OTP. Please try again.';
                otpError.style.display = 'block';

            } else if (trimmed === 'otp_expired') {
                alert('OTP expired. Please register again.');
                location.reload();

            } else if (trimmed === 'no_pending') {
                alert('Session expired. Please register again.');
                location.reload();

            } else if (trimmed === 'db_error') {
                otpError.textContent = 'Database error. Try again later.';
                otpError.style.display = 'block';

            } else {
                otpError.textContent = 'Error: ' + trimmed;
                otpError.style.display = 'block';
            }
        })
        .catch(err => {
            console.error('OTP verification error:', err);
            otpError.textContent = 'Connection error. Please try again.';
            otpError.style.display = 'block';
        });
    });

    document.getElementById('otpInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            otpSubmitBtn.click();
        }
    });
}

    })();
</script>

</html>