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
            background: url('assets/images/bg.png') center/cover no-repeat;
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
            color: var(--accent);
        }
        
        .auth-card h2 {
            margin: 0 0 14px 0;
            font-size: 28px;
            /* made larger */
            font-weight: 700;
            color: var(--accent);
            text-align: center;
            /* centered heading */
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
            /* larger text holder (bigger input) */
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.03);
            color: var(--accent);
            outline: none;
            font-size: 16px;
            /* larger font for placeholder/entry */
            width: 100%;
            box-sizing: border-box;
        }
        
        input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        
        .actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 4px;
        }
        /* styled toggle for "Show password" (keeps native checkbox but restyles it) */
        
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
        /* keep native checkbox accessible but visually hidden (still receives focus) */
        
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
        /* visible custom checkbox */
        
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
            /* allow the checkmark pseudo-element to be visible */
            z-index: 0;
        }
        /* check mark (SVG) — hidden by default (centered) */
        
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
        /* checked state: make the visible box turn white and show a centered purple check */
        
        .show-pw input[type="checkbox"]:checked+.checkbox {
            background: #ffffff;
            border-color: rgba(0, 0, 0, 0.06);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
            transform: translateY(-50%) scale(1.02);
        }
        /* Use a fully URL-encoded data URI for the SVG to avoid parser issues */
        
        .show-pw input[type="checkbox"]:checked+.checkbox::after {
            background-image: url("data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%237f4fdc' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M20 6L9 17l-5-5'/%3E%3C/svg%3E");
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
        /* focus ring for keyboard users */
        
        .show-pw input[type="checkbox"]:focus+.checkbox {
            box-shadow: 0 0 0 4px rgba(127, 79, 220, 0.12), inset 0 2px 4px rgba(0, 0, 0, 0.06);
            outline: none;
        }
        /* label text */
        
        .show-pw .label-text {
            margin-left: 6px;
            color: var(--muted);
            transition: color .12s ease;
        }
        /* change text color when checked */
        
        .show-pw input[type="checkbox"]:checked~.label-text,
        .show-pw input[type="checkbox"]:checked+.checkbox+.label-text {
            color: var(--muted) !important;
            font-weight: 400 !important;
        }
        /* reduce motion preference */
        
        @media (prefers-reduced-motion: reduce) {
            .show-pw .checkbox,
            .show-pw .checkbox::after {
                transition: none;
            }
        }
        /* ===== Coming Soon modal styles ===== */
        
        .modal-overlay {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.65);
            /* darkened from 0.45 */
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
        
        .forgot {
            color: var(--accent);
            opacity: 0.9;
            text-decoration: underline;
            font-size: 14px;
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
        /* CSS: add to your main stylesheet */
        
        .password-row {
            /* make the password row match the main input styles */
            display: block;
            margin-bottom: 12px;
        }
        
        .password-row input[type="password"],
        .password-row input[type="text"] {
            width: 100%;
            padding: 14px 16px;
            /* same as global inputs */
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.03);
            color: var(--accent);
            font-size: 16px;
            box-sizing: border-box;
        }
        /* Toggle button styling */
        
        .pwd-toggle {
            display: inline-grid;
            place-items: center;
            width: 38px;
            height: 38px;
            padding: 6px;
            border-radius: 6px;
            border: 1px solid transparent;
            background: #fff;
            color: #444;
            cursor: pointer;
            transition: background .12s, color .12s, border-color .12s;
        }
        
        .pwd-toggle:focus {
            outline: 2px solid rgba(0, 123, 255, .25);
            border-color: #8ab4ff;
        }
        
        .pwd-toggle[aria-pressed="true"] {
            background: #f0f6ff;
            color: #0b61d6;
            border-color: #d5e6ff;
        }
        /* Optional: smaller eye stroke */
        
        .pwd-toggle .eye {
            width: 18px;
            height: 18px;
        }
        
        @media (max-width:980px) {
            .auth-card {
                width: min(420px, 90vw);
                padding: 16px;
            }
        }
        /* Login modal: use a near-white card with a subtle purple border/shadow so it
           reads well while keeping the purple theme — avoids an "awkward" saturated panel */
        
        #loginModal .modal {
            width: min(460px, 42vw);
            /* copy auth-card sizing */
            max-width: 96%;
            background: linear-gradient(180deg, rgba(127, 79, 220, 0.22), rgba(127, 79, 220, 0.14));
            color: var(--accent);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.48);
            /* stronger shadow for contrast */
            backdrop-filter: blur(8px);
            position: relative;
            text-align: left;
            /* keep form left-aligned like auth-card */
        }
        /* heading + text inside login modal follow auth-card */
        
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
        /* inputs - copy registration look but keep them white for readability */
        
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
        /* modal actions centered and buttons sized like auth-card */
        
        #loginModal .modal .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 14px;
        }
        /* ensure buttons contrast on purple modal */
        
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
        /* Fix: modal-specific spacing + color for show-password */
        
        #loginModal .show-pw {
            --cb-size: 20px;
            padding-left: calc(var(--cb-size) + 8px) !important;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #ffffff !important;
        }
        /* checked box (modal) */
        
        #loginModal .show-pw input[type="checkbox"]:checked+.checkbox {
            background: #ffffff !important;
            border-color: rgba(0, 0, 0, 0.06) !important;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12) !important;
            transform: translateY(-50%) scale(1.02);
        }
        /* centered purple checkmark for modal checkbox */
        
        #loginModal .show-pw input[type="checkbox"]:checked+.checkbox::after {
            background-image: url("data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%237f4fdc' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M20 6L9 17l-5-5'/%3E%3C/svg%3E");
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
        /* ensure the check pseudo-element is visible and centered */
        
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
        /* Footer styles */
        .footer {
            background: linear-gradient(180deg, var(--purple-2), var(--purple-1));
            color: var(--accent);
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
            color: var(--accent);
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
            color: var(--accent);
        }
        /* Features styles */
        .features {
            padding: 80px 64px;
            background: #fff;
            color: #111;
            text-align: center;
        }

        .section-header {
            margin-bottom: 45px;
        }

        .section-title {
            font-family: "Simonetta", serif;
            font-size: 48px;
            margin-bottom: 16px;
            color: var(--purple-2);
        }

        .section-description {
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            margin-top: 0;
        }

        .feature-card {
            background: #f7f7fb;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.5s ease-in-out, background 0.5s ease-in-out, box-shadow 0.5s ease-in-out, color 0.5s ease-in-out;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            background: linear-gradient(135deg, var(--purple-1), var(--purple-2));
            box-shadow: 0 8px 24px rgba(107, 59, 230, 0.3), 0 0 40px rgba(127, 79, 220, 0.2);
            color: white;
        }

        .feature-card:hover .feature-icon,
        .feature-card:hover .feature-title,
        .feature-card:hover .feature-description {
            color: white;
        }

        .feature-icon {
            font-size: 48px;
            color: var(--purple-2);
            margin-bottom: 20px;
        }

        .feature-title {
            font-size: 24px;
            margin-bottom: 16px;
            color: var(--purple-2);
            font-weight: 700;
        }

        .feature-description {
            font-size: 16px;
            line-height: 1.6;
            color: #666;
        }
        /* About Us styles */
        .about-us {
            padding: 80px 64px;
            background: #f7f7fb;
            color: #111;
            text-align: center;
        }

        .about-icon {
            font-size: 64px;
            color: var(--purple-2);
            margin-bottom: 24px;
        }

        .about-title {
            font-family: "Simonetta", serif;
            font-size: 48px;
            margin-bottom: 24px;
            color: var(--purple-2);
        }

        .about-description {
            font-size: 18px;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <section id="home" class="hero">
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

                            <form method="POST" action="src/php/register.php">
                                <div class="form-group">
                                    <input id="firstname" name="firstname" type="text" placeholder="First name" required>
                                </div>

                                <div class="form-group">
                                    <input id="lastname" name="lastname" type="text" placeholder="Last name" required>
                                </div>

                                <div class="form-group">
                                    <input id="email" name="email" type="email" placeholder="Email" required>
                                </div>

                                <div class="form-group">
                                    <input id="contactno" name="contactno" type="text" placeholder="Contact Number" required>
                                </div>

                                <div class="form-group">
                                    <input id="password" name="password" type="password" placeholder="Password" required>
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
                        <li><a href="#">Our Team</a></li>
                        <li><a href="#">Careers</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4 class="footer-title">Support</h4>
                    <ul class="footer-links">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="pages/contact_us.php">Contact Us</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Privacy Policy</a></li>
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
</script>