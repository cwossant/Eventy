<!DOCTYPE HTML>
<html>
	<head>
		<title>Eventy</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="homepage is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<div class="container">

						<!-- Header -->
							<header id="header">
								<div class="inner">

									<!-- Logo -->
										<h1><a href="index.html" id="logo"><img src="eventy_logo.png" alt="Eventy logo" class="eventy-logo"></a></h1>

									<!-- Nav -->
										<nav id="nav">
											<ul>
												<li class="current_page_item"><a href="index.html">Home</a></li>						
												<li><a href="#footer-wrapper">About Us</a></li>
												<li><a href="#main-wrapper">Features</a></li>
												<li><a href="our_team.php">Contacts</a></li>
												<li><a id="getStartedBtn" class="get-started-btn">Get Started</a></li>
											</ul>
										</nav>

								</div>
							</header>


						<!-- Hero Grid Modern Section -->
						<style>
							/* ==================== HERO SECTION STYLES ==================== */
							.hero-grid {
								display: grid;
								grid-template-columns: 1fr 1fr;
								gap: 48px;
								align-items: center;
								border-radius: 18px;
								min-height: 70vh;
								margin-top: var(--hero-top-margin, 24px);
								margin-bottom: 0;
								padding: 48px 32px;
								font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
								animation: heroFadeIn 0.6s ease-out forwards;
								will-change: opacity;
							}

							@keyframes heroFadeIn {
								from {
									opacity: 0;
								}
								to {
									opacity: 1;
								}
							}

							.hero-grid .left {
								animation: slideInLeft 0.6s ease-out forwards;
								will-change: transform, opacity;
							}

							.hero-grid .right {
								overflow: visible;
								min-width: 0;
								display: block !important;
								flex: none !important;
							}

							@keyframes slideInLeft {
								from {
									opacity: 0;
									transform: translateX(-30px);
								}
								to {
									opacity: 1;
									transform: translateX(0);
								}
							}

							.hero-grid .eyebrow {
								background: rgba(255, 255, 255, 0.12);
								color: #fff;
								padding: 8px 14px;
								border-radius: 999px;
								font-weight: 600;
								font-size: 13px;
								margin-bottom: 24px;
								opacity: 0.95;
								display: inline-block;
								font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
								border: 1px solid rgba(255, 255, 255, 0.2);
								animation: fadeInUp 0.6s ease-out 0.1s forwards;
								opacity: 0;
								will-change: transform, opacity;
							}

							.hero-title {
								font-family: 'Playfair Display', serif;
								font-size: 72px;
								line-height: 1.1;
								margin-bottom: 24px;
								font-weight: 700;
								color: #ffffff !important;
								animation: fadeInUp 0.6s ease-out 0.15s forwards;
								opacity: 0;
								will-change: transform, opacity;
							}

							.hero-grid .lead {
								font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
								font-size: 18px;
								color: rgba(255, 255, 255, 0.9);
								max-width: 540px;
								margin-bottom: 32px;
								line-height: 1.7;
								animation: fadeInUp 0.6s ease-out 0.2s forwards;
								opacity: 0;
								will-change: transform, opacity;
							}

							.hero-grid .cta-row {
								display: flex;
								gap: 16px;
								align-items: center;
								animation: fadeInUp 0.6s ease-out 0.25s forwards;
								opacity: 0;
								will-change: transform, opacity;
							}

							.btn-primary {
								background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
								color: #6F42C7 !important;
								padding: 14px 24px;
								border-radius: 12px;
								font-weight: 700;
								text-decoration: none;
								box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
								display: inline-flex;
								gap: 10px;
								align-items: center;
								cursor: pointer;
								border: none;
								transition: all 0.25s ease;
								font-size: 15px;
								will-change: transform, box-shadow;
							}

							.btn-primary:hover {
								transform: translateY(-3px);
								box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
								background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
							}

							.btn-primary:active {
								transform: translateY(-1px);
							}

							/* Hero Visual */
							.hero-visual {
								position: relative;
								height: 400px;
								animation: slideInRight 0.6s ease-out forwards;
								opacity: 0;
								will-change: transform, opacity;
							}

							@keyframes slideInRight {
								from {
									opacity: 0;
									transform: translateX(30px);
								}
								to {
									opacity: 1;
									transform: translateX(0);
								}
							}

							.hero-shape {
								position: absolute;
								width: 350px;
								height: 350px;
								background: linear-gradient(135deg, rgba(139, 92, 246, 0.25) 0%, rgba(138, 92, 240, 0.08) 100%);
								border-radius: 35% 65% 65% 35% / 35% 35% 65% 65%;
								top: 50%;
								left: 50%;
								transform: translate(-50%, -50%);
								animation: gentleFloat 6s ease-in-out infinite;
								z-index: 0;
								will-change: transform;
							}

							@keyframes gentleFloat {
								0%, 100% {
									transform: translate(-50%, -50%) scale(1);
								}
								50% {
									transform: translate(-50%, -50%) scale(1.03);
								}
							}
							}

							.floating-card {
								position: absolute !important;
								width: 120px !important;
								height: 120px !important;
								max-width: 120px !important;
								max-height: 120px !important;
								min-width: 120px !important;
								min-height: 120px !important;
								background: linear-gradient(135deg, #f8f9ff 0%, #f3f0ff 100%) !important;
								border-radius: 20px !important;
								padding: 0 !important;
								margin: 0 !important;
								box-shadow: 0 10px 30px rgba(111, 66, 193, 0.15), 0 4px 12px rgba(0, 0, 0, 0.08) !important;
								display: flex !important;
								flex-direction: column !important;
								align-items: center !important;
								justify-content: center !important;
								gap: 8px !important;
								font-weight: 600 !important;
								color: #6F42C7 !important;
								z-index: 1 !important;
								transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
								cursor: pointer !important;
								will-change: transform, box-shadow !important;
								border: 1px solid rgba(111, 66, 193, 0.2) !important;
								overflow: hidden !important;
								box-sizing: border-box !important;
								font-size: inherit !important;
								line-height: 1 !important;
							}

							.floating-card i {
								font-size: 36px;
								color: #6F42C7;
								transition: all 0.3s ease;
								flex-shrink: 0;
								line-height: 1;
							}

							.floating-card p {
								margin: 0 !important;
								font-size: 12px;
								color: #6F42C7;
								font-weight: 600;
								transition: color 0.3s ease;
								flex-shrink: 0;
								width: 100%;
								text-align: center !important;
								white-space: nowrap;
								overflow: hidden;
								text-overflow: ellipsis;
							}

							.floating-card:hover {
								transform: translateY(-12px) scale(1.08);
								box-shadow: 0 20px 40px rgba(111, 66, 193, 0.25), 0 8px 16px rgba(0, 0, 0, 0.1);
								border-color: rgba(111, 66, 193, 0.3);
							}

							.floating-card:hover i {
								color: #8A5CF0;
								transform: scale(1.15);
							}

							.floating-card:hover p {
								color: #8A5CF0;
							}

							.card-1 {
								top: 15%;
								left: 8%;
								animation: floatEasy 5s ease-in-out infinite;
								animation-delay: 0s;
								position: absolute !important;
								width: 120px !important;
								height: 120px !important;
								max-width: 120px !important;
								max-height: 120px !important;
								min-width: 120px !important;
								min-height: 120px !important;
								background: linear-gradient(135deg, #f8f9ff 0%, #f3f0ff 100%) !important;
								border-radius: 20px !important;
								padding: 0 !important;
								margin: 0 !important;
								box-shadow: 0 10px 30px rgba(111, 66, 193, 0.15), 0 4px 12px rgba(0, 0, 0, 0.08) !important;
								display: flex !important;
								flex-direction: column !important;
								align-items: center !important;
								justify-content: center !important;
								gap: 8px !important;
								font-weight: 600 !important;
								color: #6F42C7 !important;
								z-index: 1 !important;
								transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
								cursor: pointer !important;
								will-change: transform, box-shadow !important;
								border: 1px solid rgba(111, 66, 193, 0.2) !important;
								overflow: hidden !important;
								box-sizing: border-box !important;
								font-size: inherit !important;
								line-height: 1 !important;
							}

							.card-2 {
								top: 50%;
								right: 12%;
								animation: floatEasy 5s ease-in-out infinite;
								animation-delay: 0.3s;
								position: absolute !important;
								width: 120px !important;
								height: 120px !important;
								max-width: 120px !important;
								max-height: 120px !important;
								min-width: 120px !important;
								min-height: 120px !important;
								background: linear-gradient(135deg, #f8f9ff 0%, #f3f0ff 100%) !important;
								border-radius: 20px !important;
								padding: 0 !important;
								margin: 0 !important;
								box-shadow: 0 10px 30px rgba(111, 66, 193, 0.15), 0 4px 12px rgba(0, 0, 0, 0.08) !important;
								display: flex !important;
								flex-direction: column !important;
								align-items: center !important;
								justify-content: center !important;
								gap: 8px !important;
								font-weight: 600 !important;
								color: #6F42C7 !important;
								z-index: 1 !important;
								transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
								cursor: pointer !important;
								will-change: transform, box-shadow !important;
								border: 1px solid rgba(111, 66, 193, 0.2) !important;
								overflow: hidden !important;
								box-sizing: border-box !important;
								font-size: inherit !important;
								line-height: 1 !important;
							}

							.card-3 {
								bottom: 12%;
								left: 18%;
								animation: floatEasy 5s ease-in-out infinite;
								animation-delay: 0.6s;
								position: absolute !important;
								width: 120px !important;
								height: 120px !important;
								max-width: 120px !important;
								max-height: 120px !important;
								min-width: 120px !important;
								min-height: 120px !important;
								background: linear-gradient(135deg, #f8f9ff 0%, #f3f0ff 100%) !important;
								border-radius: 20px !important;
								padding: 0 !important;
								margin: 0 !important;
								box-shadow: 0 10px 30px rgba(111, 66, 193, 0.15), 0 4px 12px rgba(0, 0, 0, 0.08) !important;
								display: flex !important;
								flex-direction: column !important;
								align-items: center !important;
								justify-content: center !important;
								gap: 8px !important;
								font-weight: 600 !important;
								color: #6F42C7 !important;
								z-index: 1 !important;
								transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
								cursor: pointer !important;
								will-change: transform, box-shadow !important;
								border: 1px solid rgba(111, 66, 193, 0.2) !important;
								overflow: hidden !important;
								box-sizing: border-box !important;
								font-size: inherit !important;
								line-height: 1 !important;
							}

							.card-4 {
								top: 8%;
								right: 10%;
								animation: floatEasy 5s ease-in-out infinite;
								animation-delay: 0.9s;
								position: absolute !important;
								width: 120px !important;
								height: 120px !important;
								max-width: 120px !important;
								max-height: 120px !important;
								min-width: 120px !important;
								min-height: 120px !important;
								background: linear-gradient(135deg, #f8f9ff 0%, #f3f0ff 100%) !important;
								border-radius: 20px !important;
								padding: 0 !important;
								margin: 0 !important;
								box-shadow: 0 10px 30px rgba(111, 66, 193, 0.15), 0 4px 12px rgba(0, 0, 0, 0.08) !important;
								display: flex !important;
								flex-direction: column !important;
								align-items: center !important;
								justify-content: center !important;
								gap: 8px !important;
								font-weight: 600 !important;
								color: #6F42C7 !important;
								z-index: 1 !important;
								transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
								cursor: pointer !important;
								will-change: transform, box-shadow !important;
								border: 1px solid rgba(111, 66, 193, 0.2) !important;
								overflow: hidden !important;
								box-sizing: border-box !important;
								font-size: inherit !important;
								line-height: 1 !important;
							}
							@keyframes floatEasy {
								0%, 100% {
									transform: translateY(0px);
								}
								50% {
									transform: translateY(-12px);
								}
							}

							@keyframes fadeInUp {
								from {
									opacity: 0;
									transform: translateY(15px);
								}
								to {
									opacity: 1;
									transform: translateY(0);
								}
							}

							/* Responsive Hero */
							@media (max-width: 768px) {
								.hero-grid {
									grid-template-columns: 1fr;
									min-height: auto;
									padding: 32px 20px;
									gap: 32px;
								}

								.hero-title {
									font-size: 48px;
								}

								.hero-visual {
									min-height: 300px;
								}
							}

							/* Logo Styles */
							.eventy-logo {
								width: 120px;
								height: auto;
								max-height: 80px;
							}
						</style>

						<section class="hero-grid">
							<div class="left">
								<div class="eyebrow">Community • Events</div>
								<h1 class="hero-title">Connect Effortlessly</h1>
								<p class="lead">Bringing people together has never been easier. Host events, join activities, and meet like‑minded people — all in one place.</p>
								<div class="cta-row">
									<a id="openLoginModal" class="btn btn-primary" href="#" aria-haspopup="dialog">Already Have an Account? →</a>
								</div>
							</div>
							<div class="right hero-visual">
								<div class="floating-card card-1">
									<i class="fas fa-calendar-alt"></i>
									<p>Events</p>
								</div>
								<div class="floating-card card-2">
									<i class="fas fa-users"></i>
									<p>Community</p>
								</div>
								<div class="floating-card card-3">
									<i class="fas fa-star"></i>
									<p>Featured</p>
								</div>
								<div class="floating-card card-4">
									<i class="fas fa-handshake"></i>
									<p>Connect</p>
								</div>
								<div class="hero-shape"></div>
							</div>
						</section>

					</div>
				</div>

			<!-- Main Wrapper -->
				<div id="main-wrapper">
					<div class="wrapper style1">
						<div class="inner">

							<!-- Feature 1 -->
								<section class="container box feature1">
									<div class="row">
										<div class="col-12">
											<header class="first major">
											<h2>Effortless Event Management</h2>
											<p>Discover how Eventy empowers you to <strong>Create, Read, Update, and Delete</strong> events with ease. Manage your community, your way.</p>
											</header>
										</div>
										<div class="col-3 col-12-medium">
										<section class="feature-card card-create">
											<div class="icon-circle">
												<i class="fas fa-plus-circle"></i>
											</div>
											<header class="second">
												<h3>Create</h3>
												<p style="font-size: 12px;">Launch new events</p>
												<p style="font-size: 12px;">in seconds.</p>
											</header>
										</section>
									</div>
									<div class="col-3 col-12-medium">
										<section class="feature-card card-read">
											<div class="icon-circle">
												<i class="fas fa-eye"></i>
											</div>
											<header class="second">
												<h3>Read</h3>
												<p style="font-size: 12px;">Browse all upcoming</p>
												<p style="font-size: 12px;">and past events.</p>	
											</header>
										</section>
									</div>
									<div class="col-3 col-12-medium">
										<section class="feature-card card-update">
											<div class="icon-circle">
												<i class="fas fa-edit"></i>
											</div>
											<header class="second">
												<h3>Update</h3>
												<p style="font-size: 12px;">Modify event</p>
												<p style="font-size: 12px;">information anytime.</p>
											</header>
										</section>
									</div>
									<div class="col-3 col-12-medium">
										<section class="feature-card card-delete">
											<div class="icon-circle">
												<i class="fas fa-trash-alt"></i>
											</div>
											<header class="second">
												<h3>Delete</h3>
												<p style="font-size: 12px;">Remove events that</p>
												<p style="font-size: 12px;">are no longer needed.</p>
											</header>
										</section>
									</div>
									<div class="col-12">
										<p>With Eventy, managing your events is simple and intuitive. Experience the full power of CRUD—Create, Read, Update, and Delete—so you can focus on what matters: building great experiences.</p>
									</div>
								</div>
							</section>

							</div>
					</div>

					<!-- Feature Card Styling & Animation -->
					<style>
						/* ==================== FEATURE CARDS ==================== */
						@keyframes slideUpFade {
							from {
								opacity: 0;
								transform: translateY(20px);
							}
							to {
								opacity: 1;
								transform: translateY(0);
							}
						}

						@keyframes scaleIn {
							from {
								opacity: 0;
								transform: scale(0.98);
							}
							to {
								opacity: 1;
								transform: scale(1);
							}
						}

						.feature-card {
							background: #ffffff;
							border-radius: 16px;
							overflow: hidden;
							padding: 28px 20px;
							box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
							transition: all 0.3s ease;
							opacity: 0;
							transform: translateY(20px);
							display: flex;
							flex-direction: column;
							height: 100%;
							position: relative;
							border: 1px solid rgba(0, 0, 0, 0.04);
							cursor: pointer;
							will-change: transform, box-shadow;
						}

						.feature-card::before {
							content: '';
							position: absolute;
							top: 0;
							left: 0;
							right: 0;
							height: 4px;
							background: #6F42C7;
							z-index: 1;
							transition: height 0.25s ease;
						}

						/* Color-coded top bars */
						.feature-card.card-create::before {
							background: linear-gradient(90deg, #10b981, #34d399);
						}

						.feature-card.card-read::before {
							background: linear-gradient(90deg, #3b82f6, #60a5fa);
						}

						.feature-card.card-update::before {
							background: linear-gradient(90deg, #f59e0b, #fbbf24);
						}

						.feature-card.card-delete::before {
							background: linear-gradient(90deg, #ef4444, #f87171);
						}

						.feature-card.animate {
							animation: slideUpFade 0.5s ease-out forwards;
						}

						.feature-card:hover {
							box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
							transform: translateY(-8px);
						}

						.feature-card:hover::before {
							height: 4px;
						}

						.feature-card .icon-circle {
							display: flex;
							align-items: center;
							justify-content: center;
							width: 90px;
							height: 90px;
							border-radius: 50%;
							margin: 0 auto 20px;
							font-size: 44px;
							position: relative;
							z-index: 2;
							transition: all 0.3s ease;
							box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
							will-change: transform;
						}

						.feature-card:hover .icon-circle {
							transform: scale(1.08);
							box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
						}

						.feature-card.card-create .icon-circle {
							background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
							color: white;
						}

						.feature-card.card-read .icon-circle {
							background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
							color: white;
						}

						.feature-card.card-update .icon-circle {
							background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
							color: white;
						}

						.feature-card.card-delete .icon-circle {
							background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
							color: white;
						}

						.feature-card header.second {
							text-align: center;
							flex-grow: 1;
							display: flex;
							flex-direction: column;
							justify-content: center;
							align-items: center;
							padding: 0 16px 0;
							width: 100%;
						}

						.feature-card header.second h3 {
							color: #1f2937;
							font-weight: 700;
							text-align: center;
							margin-bottom: 10px;
							font-size: 19px;
							transition: color 0.3s ease;
						}

						.feature-card:hover header.second h3 {
							color: #6F42C7;
						}

						.feature-card header.second p {
							color: #6b7280;
							line-height: 1.6;
							text-align: center;
							margin: 0;
							padding: 0;
							width: 100%;
							font-size: 13px;
							transition: color 0.3s ease;
						}

						.feature-card:hover header.second p {
							color: #4f46e5;
						}

						/* Stagger animation for each card */
						.col-3:nth-child(2) .feature-card.animate {
							animation-delay: 0.1s;
						}

						.col-3:nth-child(3) .feature-card.animate {
							animation-delay: 0.2s;
						}

						.col-3:nth-child(4) .feature-card.animate {
							animation-delay: 0.3s;
						}

						.col-3:nth-child(5) .feature-card.animate {
							animation-delay: 0.4s;
						}

						/* Featured Events Styling */
						.event-card {
							background: #ffffff;
							border-radius: 16px;
							border: 2px solid transparent;
							border-left: 5px solid #8A5CF0;
							padding: 24px;
							margin-bottom: 20px;
							box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
							transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
							position: relative;
							overflow: hidden;
							animation: slideUpFade 0.6s ease-out forwards;
							opacity: 0;
						}

						.event-card::before {
							content: '';
							position: absolute;
							top: 0;
							right: -50%;
							width: 100%;
							height: 100%;
							background: linear-gradient(135deg, transparent, rgba(139, 92, 246, 0.05));
							transition: right 0.4s ease;
							z-index: 0;
						}

						.event-card:hover::before {
							right: -100%;
						}

						.event-card > * {
							position: relative;
							z-index: 1;
						}

						.event-card:hover {
							box-shadow: 0 20px 48px rgba(139, 92, 246, 0.15);
							transform: translateX(8px) translateY(-4px);
							border-color: rgba(139, 92, 246, 0.2);
						}

						.event-header {
							display: flex;
							justify-content: space-between;
							align-items: center;
							margin-bottom: 16px;
						}

						.event-header h3 {
							color: #1f2937;
							font-weight: 700;
							margin: 0;
							font-size: 17px;
							transition: color 0.3s ease;
						}

						.event-card:hover .event-header h3 {
							color: #6F42C7;
						}

						.event-category {
							display: inline-block;
							padding: 6px 14px;
							border-radius: 20px;
							font-size: 12px;
							font-weight: 600;
							text-transform: uppercase;
							transition: all 0.3s ease;
							letter-spacing: 0.5px;
						}

						.event-category.tech {
							background: #dbeafe;
							color: #1e40af;
		border: 1px solid #bfdbfe;
						}

						.event-category.community {
							background: #dcfce7;
							color: #15803d;
							border: 1px solid #bbf7d0;
						}

						.event-category.networking {
							background: #fed7aa;
							color: #b45309;
							border: 1px solid #fdba74;
						}

						.event-card:hover .event-category {
							transform: scale(1.05);
						}

						.event-details {
							display: grid;
							grid-template-columns: 1fr 1fr;
							gap: 14px;
							margin-bottom: 16px;
						}

						.detail-item {
							display: flex;
							align-items: center;
							gap: 8px;
							font-size: 13px;
							color: #6b7280;
							transition: all 0.3s ease;
						}

						.event-card:hover .detail-item {
							color: #4f46e5;
						}

						.detail-item i {
							color: #8A5CF0;
							width: 18px;
							transition: transform 0.3s ease;
						}

						.event-card:hover .detail-item i {
							transform: scale(1.15);
						}

						.event-card p {
							color: #6b7280;
							font-size: 14px;
							line-height: 1.7;
							margin: 14px 0;
							transition: color 0.3s ease;
						}

						.event-card:hover p {
							color: #374151;
						}

						/* Stats Dashboard Styling */
						.stats-dashboard {
							background: #ffffff;
							border-radius: 16px;
							padding: 28px;
							box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
							border: 1px solid rgba(0, 0, 0, 0.04);
							animation: slideUpFade 0.6s ease-out 0.1s forwards;
							opacity: 0;
						}

						.stats-dashboard h2 {
							color: #1f2937;
							font-weight: 700;
							margin-bottom: 24px;
							padding-bottom: 16px;
							border-bottom: 2px solid #f3f4f6;
							transition: all 0.3s ease;
						}

						.stat-card {
							display: flex;
							align-items: center;
							gap: 18px;
							padding: 18px;
							margin-bottom: 14px;
							border-radius: 12px;
							background: #f9fafb;
							transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
							cursor: pointer;
							position: relative;
							overflow: hidden;
							border: 1px solid rgba(0, 0, 0, 0.02);
						}

						.stat-card::before {
							content: '';
							position: absolute;
							top: 0;
							left: -100%;
							width: 100%;
							height: 100%;
							background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.08), transparent);
							transition: left 0.5s ease;
						}

						.stat-card:hover::before {
							left: 100%;
						}

						.stat-card > * {
							position: relative;
							z-index: 1;
						}

						.stat-card:hover {
							background: #f3f4f6;
							transform: translateX(6px) translateY(-2px);
							box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
						}

						.stat-card.stat-events {
							border-left: 4px solid #3b82f6;
						}

						.stat-card.stat-users {
							border-left: 4px solid #8b5cf6;
						}

						.stat-card.stat-upcoming {
							border-left: 4px solid #f59e0b;
						}

						.stat-card.stat-attendees {
							border-left: 4px solid #10b981;
						}

						.stat-icon {
							font-size: 26px;
							width: 48px;
							height: 48px;
							display: flex;
							align-items: center;
							justify-content: center;
							border-radius: 10px;
							transition: all 0.3s ease;
							flex-shrink: 0;
						}

						.stat-card:hover .stat-icon {
							transform: scale(1.15) rotateZ(-5deg);
						}

						.stat-card.stat-events .stat-icon {
							background: #dbeafe;
							color: #3b82f6;
						}

						.stat-card.stat-users .stat-icon {
							background: #ede9fe;
							color: #8b5cf6;
						}

						.stat-card.stat-upcoming .stat-icon {
							background: #fed7aa;
							color: #f59e0b;
						}

						.stat-card.stat-attendees .stat-icon {
							background: #dcfce7;
							color: #10b981;
						}

						.stat-content h4 {
							color: #6b7280;
							font-size: 12px;
							font-weight: 600;
							margin: 0 0 6px 0;
							text-transform: uppercase;
							letter-spacing: 0.5px;
							transition: color 0.3s ease;
						}

						.stat-card:hover .stat-content h4 {
							color: #4f46e5;
						}

						.stat-number {
							color: #1f2937;
							font-size: 26px;
							font-weight: 700;
							margin: 0;
							transition: color 0.3s ease;
						}

						.stat-card:hover .stat-number {
							color: #6F42C7;
						}

						/* Button Small Styling */
						.button.small {
							background: linear-gradient(135deg, #fff 0%, #f0f0f0 100%) !important;
							color: #6F42C7 !important;
							padding: 12px 20px !important;
							border-radius: 10px !important;
							font-weight: 700 !important;
							text-decoration: none !important;
							box-shadow: 0 8px 24px rgba(0,0,0,0.12) !important;
							display: inline-flex !important;
							align-items: center !important;
							cursor: pointer !important;
							border: 1px solid rgba(139, 92, 246, 0.1) !important;
							font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial !important;
							font-size: 0.95em !important;
							letter-spacing: 0.075em !important;
							text-transform: uppercase !important;
							transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
							position: relative !important;
							overflow: hidden !important;
						}

						.button.small::before {
							content: '';
							position: absolute;
							top: 0;
							left: -100%;
							width: 100%;
							height: 100%;
							background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.1), transparent);
							transition: left 0.5s ease;
						}

						.button.small:hover {
							box-shadow: 0 12px 32px rgba(139, 92, 246, 0.2) !important;
							transform: translateY(-3px) !important;
							background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%) !important;
						}

						.button.small:hover::before {
							left: 100%;
						}

						.button.small:active {
							box-shadow: 0 4px 16px rgba(0,0,0,0.08) !important;
							transform: translateY(-1px) !important;
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

						.footer-section p {
							color: rgba(255, 255, 255, 0.7);
							line-height: 1.6;
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
							color: #723FBD;
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
							color: #723FBD;
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
							color: #723FBD;
							text-decoration: none;
							transition: all 0.3s ease;
						}

						.social-icon:hover {
							background: #723FBD;
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
							color: #723FBD;
							text-decoration: none;
						}

						.footer-bottom a:hover {
							text-decoration: underline;
						}

						@media (max-width: 768px) {
							.footer-content {
								gap: 2rem;
							}

							.footer-section h3 {
								font-size: 1.1rem;
							}

							.social-icon {
								width: 35px;
								height: 35px;
								font-size: 0.9rem;
							}
						}
					</style>

					<script>
						// Intersection Observer for scroll animations
						document.addEventListener('DOMContentLoaded', function() {
							const observerOptions = {
								threshold: 0.15,
								rootMargin: '0px 0px -50px 0px'
							};

							const observer = new IntersectionObserver(function(entries) {
								entries.forEach(function(entry) {
									if (entry.isIntersecting) {
										entry.target.classList.add('animate');
									}
								});
							}, observerOptions);

							document.querySelectorAll('.feature-card').forEach(function(card) {
								observer.observe(card);
							});
						});
					</script>


						<div class="inner">
							<div class="container">
								<div class="row">
									<div class="col-8 col-12-medium">

										<!-- Featured Events -->
											<section class="box featured-events">
												<h2 class="icon fa-calendar">Featured Events</h2>

												<!-- Event Card 1 -->
													<article class="event-card">
														<div class="event-header">
															<h3>Tech Conference 2026</h3>
															<span class="event-category tech">Technology</span>
														</div>
														<div class="event-details">
															<div class="detail-item">
																<i class="fas fa-calendar-alt"></i>
																<span>Jan 25, 2026</span>
															</div>
															<div class="detail-item">
																<i class="fas fa-clock"></i>
																<span>10:00 AM - 5:00 PM</span>
															</div>
															<div class="detail-item">
																<i class="fas fa-map-marker-alt"></i>
																<span>Convention Center, Manila</span>
															</div>
															<div class="detail-item">
																<i class="fas fa-users"></i>
																<span>324 Attendees</span>
															</div>
														</div>
														<p>Join industry leaders and innovators for an exciting day of talks, workshops, and networking opportunities.</p>
														<footer>
															<a href="#" class="button small">Learn More</a>
														</footer>
													</article>

												<!-- Event Card 2 -->
													<article class="event-card">
														<div class="event-header">
															<h3>Community Charity Run</h3>
															<span class="event-category community">Community</span>
														</div>
														<div class="event-details">
															<div class="detail-item">
																<i class="fas fa-calendar-alt"></i>
																<span>Feb 8, 2026</span>
															</div>
															<div class="detail-item">
																<i class="fas fa-clock"></i>
																<span>6:00 AM - 9:00 AM</span>
															</div>
															<div class="detail-item">
																<i class="fas fa-map-marker-alt"></i>
																<span>Rizal Park, Manila</span>
															</div>
															<div class="detail-item">
																<i class="fas fa-users"></i>
																<span>156 Attendees</span>
															</div>
														</div>
														<p>A fun and healthy way to support our local charity while connecting with your community.</p>
														<footer>
															<a href="#" class="button small">Learn More</a>
														</footer>
													</article>


											</section>
									</div>
									<div class="col-4 col-12-medium">

										<!-- Stats Dashboard -->
											<section class="box stats-dashboard">
												<h2 class="icon fa-chart-bar">Platform Stats</h2>
												
												<div class="stat-card stat-events">
													<div class="stat-icon">
														<i class="fas fa-calendar-check"></i>
													</div>
													<div class="stat-content">
														<h4>Total Events</h4>
														<p class="stat-number">1,247</p>
													</div>
												</div>

												<div class="stat-card stat-users">
													<div class="stat-icon">
														<i class="fas fa-users"></i>
													</div>
													<div class="stat-content">
														<h4>Active Users</h4>
														<p class="stat-number">3,892</p>
													</div>
												</div>

												<div class="stat-card stat-upcoming">
													<div class="stat-icon">
														<i class="fas fa-hourglass-start"></i>
													</div>
													<div class="stat-content">
														<h4>This Week</h4>
														<p class="stat-number">24</p>
													</div>
												</div>

												<div class="stat-card stat-attendees">
													<div class="stat-icon">
														<i class="fas fa-user-check"></i>
													</div>
													<div class="stat-content">
														<h4>Total Attendees</h4>
														<p class="stat-number">12,543</p>
													</div>
												</div>

											</section>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			<!-- Footer Wrapper -->
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

		</div>

		<!-- Get Started Button Styles -->
		<style>
			:root {
				--get-started-btn-height: 42px;
			}

			.get-started-btn {
				background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%) !important;
				border-radius: 12px !important;
				color: #6F42C7 !important;
				font-weight: 700 !important;
				font-size: 14px !important;
				line-height: 1.5 !important;
				cursor: pointer !important;
				display: inline-flex !important;
				align-items: center !important;
				justify-content: center !important;
				height: var(--get-started-btn-height) !important;
				padding: 0 22px !important;
				transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
				border: 1px solid rgba(139, 92, 246, 0.15) !important;
				text-decoration: none !important;
				white-space: nowrap !important;
				backface-visibility: hidden !important;
				-webkit-font-smoothing: antialiased !important;
				letter-spacing: 0.5px !important;
				position: relative !important;
				overflow: hidden !important;
				box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12) !important;
			}

			.get-started-btn::before {
				content: '';
				position: absolute;
				top: 0;
				left: -100%;
				width: 100%;
				height: 100%;
				background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.1), transparent);
				transition: left 0.5s ease;
			}

			.get-started-btn:hover {
				box-shadow: 0 12px 36px rgba(139, 92, 246, 0.25) !important;
				transform: translateY(-3px) translateZ(0) !important;
				background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%) !important;
			}

			.get-started-btn:hover::before {
				left: 100%;
			}

			.get-started-btn:active {
				transform: translateY(-1px) translateZ(0) !important;
				box-shadow: 0 6px 20px rgba(139, 92, 246, 0.15) !important;
			}
		</style>

		<!-- Role Selection Modal -->
		<div id="roleModal" class="modal-overlay">
			<div class="modal-content">
				<div class="modal-header">
					<h2>Join Eventy</h2>
					<span class="modal-close" onclick="closeRoleModal()">&times;</span>
				</div>
				<p class="modal-subtitle">Are you joining as a Participant or a Host?</p>
				<div class="role-buttons">
					<button class="role-btn participant-btn" onclick="openRegistrationModal('participant')">
						<i class="fas fa-user"></i>
						<span>Participant</span>
						<small>Join and attend events</small>
					</button>
					<button class="role-btn host-btn" onclick="openRegistrationModal('host')">
						<i class="fas fa-calendar-plus"></i>
						<span>Host</span>
						<small>Create and manage events</small>
					</button>
				</div>
			</div>
		</div>

		<!-- Participant Registration Modal -->
		<div id="participantModal" class="modal-overlay">
			<div class="modal-content registration-modal">
				<div class="modal-header">
					<h2>Create Your Account</h2>
					<span class="modal-close" onclick="closeRegistrationModal()">&times;</span>
				</div>
				<p class="modal-subtitle">Join Eventy as a Participant</p>
				<form class="registration-form" id="participantForm">
					<div class="form-group">
						<label for="participant_firstname">First Name</label>
						<input type="text" id="participant_firstname" name="firstname" placeholder="John" required>
					</div>
					<div class="form-group">
						<label for="participant_lastname">Last Name</label>
						<input type="text" id="participant_lastname" name="lastname" placeholder="Doe" required>
					</div>
					<div class="form-group">
						<label for="participant_email">Email Address</label>
						<input type="email" id="participant_email" name="email" placeholder="john@eventy.com" required>
					</div>
					<div class="form-group">
						<label for="participant_phone">Phone Number</label>
						<input type="tel" id="participant_phone" name="contactno" placeholder="09XXXXXXXXX" required>
					</div>
					<div class="form-group">
						<label for="participant_password">Password</label>
						<div class="password-field">
							<input type="password" id="participant_password" name="password" placeholder="Enter a strong password" required>
							<button type="button" class="password-toggle" onclick="togglePasswordVisibilityField('participant_password','participantTogglePass')" tabindex="-1">
								<i class="fas fa-eye" id="participantTogglePass"></i>
							</button>
						</div>
					</div>
					<div class="form-group">
						<label for="participant_confirm">Confirm Password</label>
						<div class="password-field">
							<input type="password" id="participant_confirm" name="confirm_password" placeholder="Confirm your password" required>
							<button type="button" class="password-toggle" onclick="togglePasswordVisibilityField('participant_confirm','participantToggleConfirm')" tabindex="-1">
								<i class="fas fa-eye" id="participantToggleConfirm"></i>
							</button>
						</div>
					</div>
					<button type="submit" class="form-submit">Create Account</button>
					<p class="form-back"><a href="#" onclick="backToRole(); return false;">← Back to Role Selection</a></p>
				</form>
			</div>
		</div>

		<!-- Host Registration Modal -->
		<div id="hostModal" class="modal-overlay">
			<div class="modal-content registration-modal">
				<div class="modal-header">
					<h2>Create Your Host Account</h2>
					<span class="modal-close" onclick="closeRegistrationModal()">&times;</span>
				</div>
				<p class="modal-subtitle">Start hosting amazing events on Eventy</p>
				<form class="registration-form" id="hostForm">
					<div class="form-group">
						<label for="host_firstname">First Name</label>
						<input type="text" id="host_firstname" name="firstname" placeholder="Jane" required>
					</div>
					<div class="form-group">
						<label for="host_lastname">Last Name</label>
						<input type="text" id="host_lastname" name="lastname" placeholder="Doe" required>
					</div>
					<div class="form-group">
						<label for="host_email">Email Address</label>
						<input type="email" id="host_email" name="email" placeholder="jane@eventy.com" required>
					</div>
					<div class="form-group">
						<label for="host_phone">Phone Number</label>
						<input type="tel" id="host_phone" name="contactno" placeholder="09XXXXXXXXX" required>
					</div>
					<div class="form-group">
						<label for="host_password">Password</label>
						<div class="password-field">
							<input type="password" id="host_password" name="password" placeholder="Enter a strong password" required>
							<button type="button" class="password-toggle" onclick="togglePasswordVisibilityField('host_password','hostTogglePass')" tabindex="-1">
								<i class="fas fa-eye" id="hostTogglePass"></i>
							</button>
						</div>
					</div>
					<div class="form-group">
						<label for="host_confirm">Confirm Password</label>
						<div class="password-field">
							<input type="password" id="host_confirm" name="confirm_password" placeholder="Confirm your password" required>
							<button type="button" class="password-toggle" onclick="togglePasswordVisibilityField('host_confirm','hostToggleConfirm')" tabindex="-1">
								<i class="fas fa-eye" id="hostToggleConfirm"></i>
							</button>
						</div>
					</div>
					<button type="submit" class="form-submit">Create Host Account</button>
					<p class="form-back"><a href="#" onclick="backToRole(); return false;">← Back to Role Selection</a></p>
				</form>
			</div>
		</div>

		<!-- Login Modal -->
		<div id="loginModal" class="modal-overlay">
			<div class="modal-content login-modal">
				<div class="modal-header">
					<h2>Login to Eventy</h2>
					<span class="modal-close" onclick="closeLoginModal()">&times;</span>
				</div>
				<p class="modal-subtitle">Welcome back! Sign in to your account</p>
						<!-- inline error for login failures -->
						<p id="loginError" class="modal-error" style="display:none;">&nbsp;</p>
				<form class="login-form" id="loginForm">
					<div class="form-group">
						<label for="login_email">Email Address</label>
						<input type="email" id="login_email" name="email" placeholder="your@email.com" required>
					</div>
					<div class="form-group">
						<label for="login_password">Password</label>
						<div class="password-field">
							<input type="password" id="login_password" name="password" placeholder="Enter your password" required>
								<button type="button" class="password-toggle" onclick="togglePasswordVisibilityField('login_password','toggleIcon')" tabindex="-1">
								<i class="fas fa-eye" id="toggleIcon"></i>
							</button>
						</div>
					</div>
					<button type="submit" class="form-submit">Login</button>
					<p class="form-footer">Don't have an account? <a href="#" onclick="switchToSignup(); return false;">Sign up here</a></p>
				</form>
			</div>
		</div>

		<!-- Loading Modal -->
		<div id="loadingModal" class="modal-overlay">
			<div class="modal-content loading-modal">
				<div class="spinner"></div>
				<p class="loading-text">Sending OTP to your email...</p>
			</div>
		</div>

		<!-- OTP Verification Modal -->
		<div id="otpModal" class="modal-overlay">
			<div class="modal-content otp-modal">
				<div class="modal-header">
					<h2>Verify Your Email</h2>
					<span class="modal-close" onclick="closeOtpModal()">&times;</span>
				</div>
				<p class="modal-subtitle">Enter the 6-digit OTP sent to your email</p>
				<form class="otp-form" id="otpForm">
					<div class="otp-input-group">
						<input type="text" class="otp-input" maxlength="1" placeholder="0" inputmode="numeric" data-index="0">
						<input type="text" class="otp-input" maxlength="1" placeholder="0" inputmode="numeric" data-index="1">
						<input type="text" class="otp-input" maxlength="1" placeholder="0" inputmode="numeric" data-index="2">
						<input type="text" class="otp-input" maxlength="1" placeholder="0" inputmode="numeric" data-index="3">
						<input type="text" class="otp-input" maxlength="1" placeholder="0" inputmode="numeric" data-index="4">
						<input type="text" class="otp-input" maxlength="1" placeholder="0" inputmode="numeric" data-index="5">
					</div>
					<button type="submit" class="form-submit otp-submit">Verify OTP</button>
					<p class="form-back"><a href="#" onclick="closeOtpModal(); return false;">← Back</a></p>
				</form>
			</div>
		</div>

		<!-- Success Modal -->
		<div id="successModal" class="modal-overlay">
			<div class="modal-content success-modal">
				<div class="success-icon">
					<i class="fas fa-check-circle"></i>
				</div>
				<h2 id="successTitle">Registration Successful!</h2>
				<p id="successSubtitle" class="modal-subtitle">Your account has been created successfully. You can now login.</p>
				<button type="button" id="successButton" class="form-submit" onclick="successModalToLogin()">Go to Login</button>
			</div>
		</div>

		<!-- Modal Styles -->
		<style>
			.modal-overlay {
				display: none;
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background: rgba(0, 0, 0, 0.45);
				z-index: 10000;
				align-items: center;
				justify-content: center;
				will-change: opacity;
				contain: paint;
			}

			.modal-overlay.active {
				display: flex;
				animation: fadeInModal 0.25s ease-out forwards;
			}

			@keyframes fadeInModal {
				from {
					opacity: 0;
				}
				to {
					opacity: 1;
				}
			}

			.modal-content {
				background: #ffffff;
				border-radius: 20px;
				padding: 36px 32px;
				max-width: 500px;
				width: 90%;
				box-shadow: 0 16px 48px rgba(0, 0, 0, 0.2);
				max-height: 90vh;
				overflow: hidden;
				display: flex;
				flex-direction: column;
				will-change: transform;
				contain: layout style paint;
				backface-visibility: hidden;
				-webkit-font-smoothing: antialiased;
				border: 1px solid rgba(255, 255, 255, 0.8);
			}

			.modal-overlay.active .modal-content {
				animation: slideUpModal 0.35s ease-out forwards;
			}

			@keyframes slideUpModal {
				from {
					transform: translateY(30px) scale(0.98);
					opacity: 0;
				}
				to {
					transform: translateY(0) scale(1);
					opacity: 1;
				}
			}

			.modal-header {
				flex-shrink: 0;
				margin-bottom: 8px;
			}

			.modal-subtitle {
				flex-shrink: 0;
				margin-bottom: 20px;
			}

			.registration-form {
				overflow-y: auto;
				padding-right: 8px;
				margin-right: -8px;
				max-height: calc(90vh - 200px);
				animation: fadeIn 0.35s ease-out 0.05s forwards;
				opacity: 0;
				will-change: opacity;
			}

			.registration-form::-webkit-scrollbar {
				width: 6px;
			}

			.registration-form::-webkit-scrollbar-track {
				background: transparent;
			}

			.registration-form::-webkit-scrollbar-thumb {
				background: #d1d5db;
				border-radius: 3px;
				transition: background 0.2s ease;
			}

			.registration-form::-webkit-scrollbar-thumb:hover {
				background: #8b5cf6;
			}

			@keyframes fadeIn {
				from {
					opacity: 0;
				}
				to {
					opacity: 1;
				}
			}

			.registration-modal {
				max-width: 450px;
			}

			.modal-header {
				display: flex;
				justify-content: space-between;
				align-items: center;
				margin-bottom: 12px;
			}

			.modal-header h2 {
				color: #6F42C7;
				font-size: 26px;
				font-weight: 700;
				margin: 0;
				font-family: 'Playfair Display', serif;
			}

			.modal-close {
				font-size: 32px;
				font-weight: 300;
				color: #d1d5db;
				cursor: pointer;
				transition: all 0.2s ease;
				line-height: 1;
				display: flex;
				align-items: center;
				justify-content: center;
				width: 40px;
				height: 40px;
				border-radius: 50%;
				background: #f3f4f6;
			}

			.modal-close:hover {
				color: #6F42C7;
				background: #ede9fe;
				transform: rotate(90deg);
			}

			.modal-subtitle {
				color: #6b7280;
				font-size: 14px;
				margin: 8px 0 24px 0;
				font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
			}

			.role-buttons {
				display: grid;
				grid-template-columns: 1fr 1fr;
				gap: 16px;
				margin-top: 24px;
				animation: fadeIn 0.35s ease-out 0.05s forwards;
				opacity: 0;
				will-change: opacity;
			}

			.role-btn {
				display: flex;
				flex-direction: column;
				align-items: center;
				justify-content: center;
				gap: 12px;
				padding: 28px 16px;
				border: 2px solid #e5e5e5;
				border-radius: 14px;
				background: #f9f9f9;
				cursor: pointer;
				transition: all 0.3s ease;
				font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
				text-decoration: none;
				will-change: transform, box-shadow;
				backface-visibility: hidden;
				-webkit-font-smoothing: antialiased;
				position: relative;
				overflow: hidden;
			}

			.role-btn::before {
				content: '';
				position: absolute;
				top: -50%;
				left: -50%;
				width: 200%;
				height: 200%;
				background: linear-gradient(135deg, transparent, rgba(139, 92, 246, 0.08), transparent);
				transition: all 0.4s;
				transform: rotate(45deg);
			}

			.role-btn:hover::before {
				top: -100%;
				left: -100%;
			}

			.role-btn i {
				font-size: 36px;
				color: #6F42C7;
				transition: all 0.3s ease;
				z-index: 1;
				position: relative;
			}

			.role-btn span {
				font-size: 16px;
				font-weight: 700;
				color: #1f2937;
				z-index: 1;
				position: relative;
			}

			.role-btn small {
				font-size: 12px;
				color: #999;
				text-align: center;
				z-index: 1;
				position: relative;
			}

			.role-btn:hover {
				border-color: #6F42C7;
				background: linear-gradient(135deg, #f0ebf8 0%, #faf7ff 100%);
				transform: translateY(-4px) translateZ(0);
				box-shadow: 0 8px 20px rgba(111, 66, 193, 0.15);
			}

			.role-btn:hover i {
				color: #8A5CF0;
				transform: scale(1.12);
			}

			.registration-form {
				display: flex;
				flex-direction: column;
				gap: 16px;
				margin-top: 24px;
			}

			.form-group {
				display: flex;
				flex-direction: column;
				gap: 8px;
				animation: fadeIn 0.4s ease-out forwards;
				opacity: 0;
			}

			.form-group:nth-child(1) {
				animation-delay: 0.15s;
			}
			.form-group:nth-child(2) {
				animation-delay: 0.2s;
			}
			.form-group:nth-child(3) {
				animation-delay: 0.25s;
			}
			.form-group:nth-child(4) {
				animation-delay: 0.3s;
			}
			.form-group:nth-child(5) {
				animation-delay: 0.35s;
			}
			.form-group:nth-child(6) {
				animation-delay: 0.4s;
			}

			.form-group label {
				color: #6F42C7;
				font-weight: 600;
				font-size: 12px;
				text-transform: uppercase;
				letter-spacing: 0.6px;
				font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
			}

			.form-group input {
				padding: 12px 14px;
				border: 2px solid #e5e5e5;
				border-radius: 10px;
				font-size: 14px;
				font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
				transition: all 0.3s ease;
				outline: none;
				will-change: border-color, box-shadow;
				backface-visibility: hidden;
				-webkit-font-smoothing: antialiased;
				background: #f9f9f9;
			}

			.form-group input::placeholder {
				color: #bbb;
			}

			.form-group input:focus {
				border-color: #6F42C7;
				background: #ffffff;
				box-shadow: 0 0 0 4px rgba(111, 66, 193, 0.1);
				transform: translateY(-1px);
			}

			.password-field {
				display: flex;
				align-items: center;
				position: relative;
			}

			.password-field input {
				width: 100%;
			}

			.password-toggle {
				position: absolute;
				right: 12px;
				background: none;
				border: none;
				color: #8b5cf6;
				cursor: pointer;
				font-size: 16px;
				transition: all 0.3s ease;
				padding: 8px;
				z-index: 2;
			}

			.password-toggle:hover {
				transform: scale(1.2);
				color: #6F42C7;
			}

			.form-submit {
				padding: 16px 20px;
				min-height: 50px;
				background: linear-gradient(135deg, #6F42C7 0%, #8A5CF0 100%);
				color: #ffffff;
				border: none;
				border-radius: 10px;
				font-size: 15px;
				font-weight: 700;
				cursor: pointer;
				transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
				margin-top: 12px;
				font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
				text-transform: uppercase;
				letter-spacing: 0.6px;
				will-change: box-shadow, transform;
				backface-visibility: hidden;
				-webkit-font-smoothing: antialiased;
				position: relative;
				overflow: hidden;
				display: inline-flex;
				align-items: center;
				justify-content: center;
			}
			.form-submit::before {
				content: '';
				position: absolute;
				top: 0;
				left: -100%;
				width: 100%;
				height: 100%;
				background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
				transition: left 0.6s ease;
			}

			.form-submit:hover {
				box-shadow: 0 12px 32px rgba(111, 66, 193, 0.4);
				transform: translateY(-4px) translateZ(0);
			}

			.form-submit:hover::before {
				left: 100%;
			}

			.form-submit:active {
				transform: translateY(-2px) translateZ(0);
				box-shadow: 0 8px 24px rgba(111, 66, 193, 0.3);
			}

			.form-back {
				text-align: center;
				margin-top: 12px;
				animation: fadeIn 0.4s ease-out 0.5s forwards;
				opacity: 0;
			}

			.form-back a {
				color: #6F42C7;
				text-decoration: none;
				font-weight: 600;
				transition: all 0.3s ease;
				display: inline-block;
			}

			.form-back a:hover {
				transform: translateX(-4px);
				color: #8A5CF0;
			}

			.modal-error {
				background: #fee2e2;
				color: #991b1b;
				padding: 12px 16px;
				border-radius: 8px;
				border: 1px solid #fecaca;
				margin-bottom: 16px;
				font-size: 13px;
				animation: slideInDown 0.3s ease-out forwards;
				opacity: 0;
			}

			@keyframes slideInDown {
				from {
					opacity: 0;
					transform: translateY(-10px);
				}
				to {
					opacity: 1;
					transform: translateY(0);
				}
			}

			.login-form {
				animation: fadeIn 0.4s ease-out 0.1s forwards;
				opacity: 0;
			}

			.form-footer {
				text-align: center;
				margin-top: 16px;
				color: #6b7280;
				font-size: 13px;
				animation: fadeIn 0.4s ease-out 0.4s forwards;
				opacity: 0;
			}

			.form-footer a {
				color: #6F42C7;
				text-decoration: none;
				font-weight: 600;
				transition: all 0.3s ease;
			}

			.form-footer a:hover {
				color: #8A5CF0;
				text-decoration: underline;
			}

			/* OTP Modal Styles */
			.otp-modal {
				max-width: 420px;
			}

			.otp-input-group {
				display: grid;
				grid-template-columns: repeat(6, 1fr);
				gap: 10px;
				margin: 24px 0;
				animation: fadeIn 0.4s ease-out 0.15s forwards;
				opacity: 0;
			}

			.otp-input {
				width: 100%;
				aspect-ratio: 1;
				border: 2px solid #e5e5e5;
				border-radius: 12px;
				text-align: center;
				font-size: 24px;
				font-weight: 700;
				font-family: 'Poppins', monospace;
				transition: all 0.3s ease;
				background: #f9f9f9;
			}

			.otp-input:focus {
				border-color: #6F42C7;
				background: #ffffff;
				box-shadow: 0 0 0 4px rgba(111, 66, 193, 0.1);
				transform: scale(1.05);
			}

			.otp-submit {
				animation: fadeIn 0.4s ease-out 0.25s forwards;
				opacity: 0;
			}

			/* Loading Modal */
			.loading-modal {
				display: flex;
				flex-direction: column;
				align-items: center;
				justify-content: center;
				gap: 20px;
				min-height: 200px;
			}

			.spinner {
				width: 48px;
				height: 48px;
				border: 4px solid #f3f4f6;
				border-top-color: #6F42C7;
				border-right-color: #8A5CF0;
				border-radius: 50%;
				animation: spin 1s linear infinite;
			}

			@keyframes spin {
				to {
					transform: rotate(360deg);
				}
			}

			.loading-text {
				color: #6b7280;
				font-size: 15px;
				text-align: center;
				animation: pulse 1.5s ease-in-out infinite;
			}

			@keyframes pulse {
				0%, 100% {
					opacity: 1;
				}
				50% {
					opacity: 0.6;
				}
			}

			/* Success Modal */
			.success-modal {
				text-align: center;
				animation: slideUpModal 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
			}

			.success-icon {
				width: 80px;
				height: 80px;
				background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
				border-radius: 50%;
				display: flex;
				align-items: center;
				justify-content: center;
				margin: 0 auto 20px;
				font-size: 40px;
				color: white;
				animation: popIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
				box-shadow: 0 12px 32px rgba(16, 185, 129, 0.2);
			}

			@keyframes popIn {
				from {
					transform: scale(0) rotateZ(-30deg);
					opacity: 0;
				}
				to {
					transform: scale(1) rotateZ(0);
					opacity: 1;
				}
			}

			#successTitle {
				color: #1f2937;
				font-size: 24px;
				font-weight: 700;
				margin-bottom: 8px;
				animation: fadeIn 0.4s ease-out 0.2s forwards;
				opacity: 0;
			}

			#successSubtitle {
				color: #6b7280;
				margin-bottom: 24px;
				animation: fadeIn 0.4s ease-out 0.3s forwards;
				opacity: 0;
			}

			#successButton {
				animation: fadeIn 0.4s ease-out 0.4s forwards;
				opacity: 0;
			}
		</style>

		<style>
			.form-back {
				text-align: center;
				margin-top: 16px;
				font-size: 13px;
			}

			.form-back a {
				color: #6F42C7;
				text-decoration: none;
				font-weight: 600;
				transition: color 0.2s;
			}

			.form-back a:hover {
				color: #8A5CF0;
			}

			@media (max-width: 600px) {
				.modal-content {
					padding: 24px;
					width: 95%;
				}

				.role-buttons {
					grid-template-columns: 1fr;
				}

				.modal-header h2 {
					font-size: 20px;
				}
			}

			/* Login Modal Styles */
			.login-modal {
				max-width: 420px;
				min-width: 300px;
			}

			.password-field {
				position: relative;
				display: flex;
				align-items: center;
			}

			.password-field input {
				width: 100%;
				padding-right: 44px;
			}

			.password-toggle {
				position: absolute;
				right: 12px;
				background: transparent;
				border: none;
				cursor: pointer;
				color: #6F42C7 !important;
				font-size: 16px;
				padding: 0;
				margin: 0;
				display: inline-flex;
				align-items: center;
				justify-content: center;
				outline: none;
				box-shadow: none !important;
				opacity: 0.95 !important;
				transition: none !important;
				width: 28px;
				height: 28px;
				line-height: 1;
			}

			.password-toggle:hover,
			.password-toggle:focus,
			.password-toggle:active,
			.password-toggle i {
				/* Always keep the eye purple and slightly less opaque; disable hover color change */
				color: #6F42C7 !important;
				opacity: 0.95 !important;
				box-shadow: none !important;
				transition: none !important;
			}

			.password-toggle i {
				pointer-events: none;
			}

			.form-footer {
				text-align: center;
				margin-top: 16px;
				font-size: 13px;
				color: #6b7280;
			}

			.form-footer a {
				color: #6F42C7;
				text-decoration: none;
				font-weight: 600;
				transition: color 0.2s;
			}

			.form-footer a:hover {
				color: #8A5CF0;
			}

			/* Inline error shown below subtitle in login modal */
			.modal-error {
				color: #dc2626;
				font-size: 13px;
				margin-top: 8px;
				margin-bottom: 8px;
			}
		</style>

		<!-- Loading Modal Styles -->
		<style>
			.loading-modal {
				max-width: 300px;
				text-align: center;
				padding: 48px 32px;
			}

			.spinner {
				width: 50px;
				height: 50px;
				border: 5px solid #f3f4f6;
				border-top: 5px solid #8A5CF0;
				border-radius: 50%;
				animation: spin 1s linear infinite;
				margin: 0 auto 24px;
			}

			@keyframes spin {
				0% { transform: rotate(0deg); }
				100% { transform: rotate(360deg); }
			}

			.loading-text {
				color: #6b7280;
				font-size: 14px;
				margin: 0;
			}

			/* OTP Modal Styles */
			.otp-modal {
				max-width: 450px;
			}

			.otp-input-group {
				display: flex;
				justify-content: center;
				gap: 12px;
				margin: 24px 0;
			}

			.otp-input {
				width: 60px;
				height: 60px;
				padding: 0;
				text-align: center;
				font-size: 24px;
				font-weight: 700;
				border: 2px solid #e5e5e5;
				border-radius: 8px;
				background: #ffffff;
				color: #1f2937;
				outline: none;
				transition: all 0.2s;
				font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
			}

			.otp-input:focus {
				border-color: #6F42C7;
				box-shadow: 0 0 0 3px rgba(111, 66, 193, 0.1);
			}

			.otp-input::placeholder {
				color: #d1d5db;
			}

			.otp-submit {
				margin-top: 12px;
			}

			/* Success Modal Styles */
			.success-modal {
				max-width: 400px;
				text-align: center;
				padding: 48px 32px;
			}

			.success-icon {
				font-size: 64px;
				color: #10b981;
				margin-bottom: 24px;
				animation: scaleIn 0.5s ease-out;
			}

			@keyframes scaleIn {
				from {
					transform: scale(0.5);
					opacity: 0;
				}
				to {
					transform: scale(1);
					opacity: 1;
				}
			}

			.success-modal h2 {
				color: #10b981;
				margin-bottom: 12px;
			}

			.success-modal .modal-subtitle {
				color: #6b7280;
				margin-bottom: 24px;
			}
		</style>

		<!-- Modal JavaScript -->
		<script>
			// Cache DOM elements for better performance
			const getStartedBtn = document.getElementById('getStartedBtn');
			const roleModal = document.getElementById('roleModal');
			const participantModal = document.getElementById('participantModal');
			const hostModal = document.getElementById('hostModal');
			const loginModal = document.getElementById('loginModal');
			const loadingModal = document.getElementById('loadingModal');
			const otpModal = document.getElementById('otpModal');
			const successModal = document.getElementById('successModal');
			const successTitle = document.getElementById('successTitle');
			const successSubtitle = document.getElementById('successSubtitle');
			const successButton = document.getElementById('successButton');
			const participantForm = document.getElementById('participantForm');
			const hostForm = document.getElementById('hostForm');
			const loginForm = document.getElementById('loginForm');
			const loginError = document.getElementById('loginError');
			const otpForm = document.getElementById('otpForm');
			const openLoginModalBtn = document.getElementById('openLoginModal');

			// OTP input variables
			let pendingEmail = null;
			
			// Open role selection modal
			getStartedBtn.addEventListener('click', function(e) {
				e.preventDefault();
				openRoleModal();
			});

			// Clear login error when opening login modal or when user types
			function clearLoginError() {
				if (loginError) {
					loginError.innerText = '';
					loginError.style.display = 'none';
				}
			}

			// Clear the inline error when user starts typing in login inputs
			['login_email','login_password'].forEach(id => {
				const el = document.getElementById(id);
				if (el) {
					el.addEventListener('input', clearLoginError);
				}
			});

			// Open login modal
			openLoginModalBtn.addEventListener('click', function(e) {
				e.preventDefault();
				openLoginModal();
			});

			function openRoleModal() {
				roleModal.classList.add('active');
				document.body.style.overflow = 'hidden';
			}

			function closeRoleModal() {
				roleModal.classList.remove('active');
				document.body.style.overflow = 'auto';
			}

			function openLoginModal() {
				clearLoginError();
				loginModal.classList.add('active');
				document.body.style.overflow = 'hidden';
			}

			function closeLoginModal() {
				loginModal.classList.remove('active');
				document.body.style.overflow = 'auto';
				loginForm.reset();
				resetPasswordVisibility();
			}

			function openRegistrationModal(role) {
				closeRoleModal();
				const modalId = role === 'participant' ? participantModal : hostModal;
				modalId.classList.add('active');
				document.body.style.overflow = 'hidden';
			}

			function closeRegistrationModal() {
				participantModal.classList.remove('active');
				hostModal.classList.remove('active');
				document.body.style.overflow = 'auto';
			}

			function backToRole() {
				closeRegistrationModal();
				openRoleModal();
			}

			// Password visibility toggle
			function togglePasswordVisibilityField(fieldId, iconId) {
				const passwordInput = document.getElementById(fieldId);
				const toggleIcon = document.getElementById(iconId);
				if (!passwordInput || !toggleIcon) return;
				if (passwordInput.type === 'password') {
					passwordInput.type = 'text';
					toggleIcon.classList.remove('fa-eye');
					toggleIcon.classList.add('fa-eye-slash');
				} else {
					passwordInput.type = 'password';
					toggleIcon.classList.remove('fa-eye-slash');
					toggleIcon.classList.add('fa-eye');
				}
			}

			function togglePasswordVisibility() {
				const passwordInput = document.getElementById('login_password');
				const toggleIcon = document.getElementById('toggleIcon');

				if (passwordInput.type === 'password') {
					passwordInput.type = 'text';
					toggleIcon.classList.remove('fa-eye');
					toggleIcon.classList.add('fa-eye-slash');
				} else {
					passwordInput.type = 'password';
					toggleIcon.classList.remove('fa-eye-slash');
					toggleIcon.classList.add('fa-eye');
				}
			}

			function resetPasswordVisibility() {
				const passwordInput = document.getElementById('login_password');
				const toggleIcon = document.getElementById('toggleIcon');
				passwordInput.type = 'password';
				toggleIcon.classList.remove('fa-eye-slash');
				toggleIcon.classList.add('fa-eye');
			}

			function switchToSignup() {
				closeLoginModal();
				openRoleModal();
			}

			// Optimized event delegation for modals
			[roleModal, participantModal, hostModal, loginModal, loadingModal, otpModal, successModal].forEach(modal => {
				modal.addEventListener('click', function(e) {
					if (e.target === this) {
						closeRoleModal();
						closeRegistrationModal();
						closeLoginModal();
						closeOtpModal();
					}
				});
			});

			// Handle form submissions
			participantForm.addEventListener('submit', function(e) {
				e.preventDefault();
				const firstname = document.getElementById('participant_firstname').value;
				const lastname = document.getElementById('participant_lastname').value;
				const email = document.getElementById('participant_email').value;
				const contactno = document.getElementById('participant_phone').value;
				const password = document.getElementById('participant_password').value;
				const confirmPassword = document.getElementById('participant_confirm').value;
				
				if (password !== confirmPassword) {
					alert('Passwords do not match!');
					return;
				}
				
				const formData = new FormData();
				formData.append('firstname', firstname);
				formData.append('lastname', lastname);
				formData.append('email', email);
				formData.append('contactno', contactno);
				formData.append('password', password);
				
				// Store email for OTP verification
				pendingEmail = email;
				
				// Close registration modal and show loading
				closeRegistrationModal();
				loadingModal.classList.add('active');
				
				fetch('api/register.php', {
					method: 'POST',
					body: formData
				})
				.then(response => response.text())
				.then(data => {
					loadingModal.classList.remove('active');
					
					if (data.trim() === 'otp_required') {
						// Show OTP modal
						setTimeout(() => {
							otpModal.classList.add('active');
							document.getElementById('otpForm').reset();
							// Focus first OTP input
							document.querySelector('.otp-input[data-index="0"]').focus();
						}, 500);
					} else if (data.trim() === 'email_exists') {
						alert('Email already registered. Please login instead.');
					} else if (data.trim() === 'invalid_email') {
						alert('Invalid email format.');
					} else if (data.trim() === 'invalid_contact') {
						alert('Invalid contact number. Use format: 09XXXXXXXXX');
					} else if (data.trim() === 'weak_password') {
						alert('Password must be at least 8 characters with uppercase, lowercase, and numbers.');
					} else {
						alert('An error occurred. Please try again.');
					}
					participantForm.reset();
				})
				.catch(error => {
					console.error('Registration error:', error);
					loadingModal.classList.remove('active');
					alert('An error occurred. Please try again.');
				});
			});

			hostForm.addEventListener('submit', function(e) {
				e.preventDefault();
				const firstname = document.getElementById('host_firstname').value;
				const lastname = document.getElementById('host_lastname').value;
				const email = document.getElementById('host_email').value;
				const contactno = document.getElementById('host_phone').value;
				const organization = document.getElementById('host_organization').value;
				const eventType = document.getElementById('host_event_type').value;
				const password = document.getElementById('host_password').value;
				const confirmPassword = document.getElementById('host_confirm').value;
				
				if (password !== confirmPassword) {
					alert('Passwords do not match!');
					return;
				}
				
				const formData = new FormData();
				formData.append('firstname', firstname);
				formData.append('lastname', lastname);
				formData.append('email', email);
				formData.append('contactno', contactno);
				formData.append('organization', organization);
				formData.append('event_type', eventType);
				formData.append('password', password);
				formData.append('role', 'host');
				
				// Store email for OTP verification
				pendingEmail = email;
				
				// Close registration modal and show loading
				closeRegistrationModal();
				loadingModal.classList.add('active');
				
				fetch('api/register.php', {
					method: 'POST',
					body: formData
				})
				.then(response => response.text())
				.then(data => {
					loadingModal.classList.remove('active');
					
					if (data.trim() === 'otp_required') {
						// Show OTP modal
						setTimeout(() => {
							otpModal.classList.add('active');
							document.getElementById('otpForm').reset();
							// Focus first OTP input
							document.querySelector('.otp-input[data-index="0"]').focus();
						}, 500);
					} else if (data.trim() === 'email_exists') {
						alert('Email already registered. Please login instead.');
					} else if (data.trim() === 'invalid_email') {
						alert('Invalid email format.');
					} else if (data.trim() === 'invalid_contact') {
						alert('Invalid contact number. Use format: 09XXXXXXXXX');
					} else if (data.trim() === 'weak_password') {
						alert('Password must be at least 8 characters with uppercase, lowercase, and numbers.');
					} else {
						alert('An error occurred. Please try again.');
					}
					hostForm.reset();
				})
				.catch(error => {
					console.error('Host registration error:', error);
					loadingModal.classList.remove('active');
					alert('An error occurred. Please try again.');
				});
			});

			// Login form submission
			loginForm.addEventListener('submit', function(e) {
				e.preventDefault();
				const email = document.getElementById('login_email').value;
				const password = document.getElementById('login_password').value;
				
				// Create FormData for POST request
				const formData = new FormData();
				formData.append('email', email);
				formData.append('password', password);
				
				// Send login request to API
				fetch('api/login.php', {
					method: 'POST',
					body: formData
				})
				.then(response => response.json())

				.then(data => {
					if (data.status === 'success') {
						// Show success modal and auto-redirect to dashboard after 2.6s based on user_type
						closeLoginModal();
						loginForm.reset();
						resetPasswordVisibility();
						
						// Determine redirect URL based on user_type
						let redirectUrl = 'Mainboard.php'; // default
						if (data.user_type === 'participant') {
							redirectUrl = 'participant.php';
						} else if (data.user_type === 'host') {
							redirectUrl = 'host.php';
						}
						
						showSuccessAndRedirect('Login Successful!', 'You have successfully signed in. Redirecting to your dashboard...', redirectUrl, false, 2600);
					} else {
						// show inline error below the subtitle in the login modal
						if (loginError) {
							loginError.innerText = 'The email address or password is incorrect. Please try again.';
							loginError.style.display = 'block';
						}
						// focus email field for correction
						document.getElementById('login_email').focus();
					}
				})
				.catch(error => {
					console.error('Login error:', error);
					alert('An error occurred during login. Please try again.');
				});
			});

			// OTP Form Submission
			otpForm.addEventListener('submit', function(e) {
				e.preventDefault();
				
				const otpInputs = document.querySelectorAll('.otp-input');
				let otp = '';
				
				// Combine all OTP digits
				otpInputs.forEach(input => {
					otp += input.value;
				});
				
				// Validate OTP is complete
				if (otp.length !== 6) {
					alert('Please enter all 6 digits of the OTP.');
					return;
				}
				
				const formData = new FormData();
				formData.append('otp', otp);
				
				fetch('api/verify_otp.php', {
					method: 'POST',
					body: formData
				})
				.then(response => response.text())
				.then(data => {
					const response = data.trim();
					console.log('OTP Response:', response); // Debug log
					
					if (response === 'success') {
						// Close OTP modal and show success modal, then auto-open login modal after 4s
						otpModal.classList.remove('active');
						showSuccessAndRedirect('Registration Successful!', 'Your account has been created successfully. Redirecting to login...', null, true, 2600);
					} else if (response === 'invalid_otp') {
						alert('Invalid OTP. Please try again.');
						otpForm.reset();
						document.querySelector('.otp-input[data-index="0"]').focus();
					} else if (response === 'otp_expired') {
						alert('OTP has expired. Please register again.');
						closeOtpModal();
					} else if (response === 'no_pending') {
						alert('No pending registration found. Please register again.');
						closeOtpModal();
					} else if (response === 'db_error') {
						alert('Database error occurred. Please try again.');
					} else {
						console.error('Unexpected response:', response);
						alert('An error occurred: ' + response);
					}
				})
				.catch(error => {
					console.error('OTP verification error:', error);
					alert('An error occurred during verification. Please try again.');
				});
			});

			// OTP Input Handling
			const otpInputs = document.querySelectorAll('.otp-input');
			
			otpInputs.forEach((input, index) => {
				// Handle input
				input.addEventListener('input', function(e) {
					const value = this.value;
					
					// Only allow digits
					if (!/^\d?$/.test(value)) {
						this.value = '';
						return;
					}
					
					// Move to next input if digit entered
					if (value.length === 1 && index < otpInputs.length - 1) {
						otpInputs[index + 1].focus();
					}
				});
				
				// Handle backspace
				input.addEventListener('keydown', function(e) {
					if (e.key === 'Backspace' && this.value === '' && index > 0) {
						otpInputs[index - 1].focus();
					}
				});
				
				// Handle paste
				input.addEventListener('paste', function(e) {
					e.preventDefault();
					const pastedData = e.clipboardData.getData('text');
					const digits = pastedData.replace(/\D/g, '').split('');
					
					// Fill OTP inputs with pasted digits
					for (let i = 0; i < Math.min(digits.length, otpInputs.length - index); i++) {
						otpInputs[index + i].value = digits[i];
					}
					
					// Focus last filled input or last input
					const lastFilledIndex = Math.min(index + digits.length - 1, otpInputs.length - 1);
					otpInputs[lastFilledIndex].focus();
				});
				
				// Handle arrow keys
				input.addEventListener('keydown', function(e) {
					if (e.key === 'ArrowLeft' && index > 0) {
						otpInputs[index - 1].focus();
					} else if (e.key === 'ArrowRight' && index < otpInputs.length - 1) {
						otpInputs[index + 1].focus();
					}
				});
			});

			function closeOtpModal() {
				otpModal.classList.remove('active');
				document.body.style.overflow = 'auto';
				otpForm.reset();
			}

			/**
			 * Show the shared success modal and auto-redirect after a delay.
			 * If `redirectToLogin` is true the login modal is opened after the delay.
			 * Otherwise `redirectUrl` is used for window.location.href.
			 */
			function showSuccessAndRedirect(titleText, subtitleText, redirectUrl = null, redirectToLogin = false, delay = 2600) {
				successTitle.innerText = titleText;
				successSubtitle.innerText = subtitleText;
				// hide the button for auto-redirect flows
				successButton.style.display = 'none';
				successModal.classList.add('active');
				document.body.style.overflow = 'hidden';
				setTimeout(function() {
					successModal.classList.remove('active');
					document.body.style.overflow = 'auto';
					if (redirectToLogin) {
						openLoginModal();
					} else if (redirectUrl) {
						window.location.href = redirectUrl;
					}
				}, delay);
			}

			function successModalToLogin() {
				successModal.classList.remove('active');
				document.body.style.overflow = 'auto';
				openLoginModal();
			}
		</script>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>