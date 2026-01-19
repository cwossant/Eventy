<!DOCTYPE HTML
<html style="scroll-behavior: smooth;">
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
								<style>
									.eventy-logo {
									width: 120px; /* Adjust width as needed */
									height: auto;
									max-height: 80px; /* Optional: limit height */
									}
								</style>

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
						<section class="hero-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 32px; align-items: center; border-radius: 18px; min-height: 70vh; margin-top: var(--hero-top-margin, 24px); margin-bottom: 0; padding: 48px 32px; font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;">
							<div class="left">
								<div class="eyebrow" style="background: rgba(0,0,0,0.08); color: #fff; padding: 6px 12px; border-radius: 999px; font-weight: 600; font-size: 14px; margin-bottom: 18px; opacity: 0.95; display: inline-block; font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;">Community • Events</div>
								<style>
									.hero-title {
										color: rgba(255,255,255,0.92) !important;
									}
								</style>
								<p class="hero-title" style="font-family: 'Simonetta', 'Playfair Display', serif; font-size: 64px; line-height: 0.95; margin-bottom: 18px; font-weight: 500;">Connect Effortlessly</p>
								<p class="lead" style="font-family: 'Handyman', 'Handlee', 'Poppins', cursive; font-size: 18px; color: rgba(255,255,255,0.92); max-width: 540px; margin-bottom: 22px;">Bringing people together has never been easier. Host events, join activities, and meet like‑minded people — all in one place.</p>
								<div class="cta-row" style="display: flex; gap: 16px; align-items: center;">
									<a id="openLoginModal" class="btn" href="#" aria-haspopup="dialog" style="background: #fff; color: var(--purple-2, #8A5CF0); padding: 12px 18px; border-radius: 12px; font-weight: 700; text-decoration: none; box-shadow: 0 8px 24px rgba(0,0,0,0.12); display: inline-flex; gap: 10px; align-items: center; cursor: pointer; border: none;">Already Have an Account? →</a>
								</div>
							</div>
							<div class="right" style="display: flex; align-items: center; justify-content: center;">
								
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
						@keyframes slideUpFade {
							from {
								opacity: 0;
								transform: translateY(30px);
							}
							to {
								opacity: 1;
								transform: translateY(0);
							}
						}

						.feature-card {
							background: #ffffff;
							border-radius: 12px;
							overflow: hidden;
							padding: 0;
							box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
							transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
							opacity: 0;
							transform: translateY(30px);
							display: flex;
							flex-direction: column;
							height: 100%;
							position: relative;
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
							animation: slideUpFade 0.6s ease-out forwards;
						}

						.feature-card:hover {
							box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
							transform: translateY(-4px);
						}

						.feature-card .icon-circle {
							display: flex;
							align-items: center;
							justify-content: center;
							width: 80px;
							height: 80px;
							border-radius: 50%;
							margin: 24px auto 16px;
							font-size: 40px;
							position: relative;
							z-index: 2;
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
							padding: 0 20px 24px;
							width: 100%;
						}

						.feature-card header.second h3 {
							color: #1f2937;
							font-weight: 700;
							text-align: center;
							margin-bottom: 12px;
							font-size: 18px;
						}

						.feature-card header.second p {
							color: #6b7280;
							line-height: 1.6;
							text-align: center;
							margin: 0;
							padding: 0;
							width: 100%;
						}
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
							border-radius: 12px;
							border-left: 5px solid #8A5CF0;
							padding: 20px;
							margin-bottom: 20px;
							box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
							transition: all 0.3s ease;
						}

						.event-card:hover {
							box-shadow: 0 8px 20px rgba(139, 92, 246, 0.15);
							transform: translateX(4px);
						}

						.event-header {
							display: flex;
							justify-content: space-between;
							align-items: center;
							margin-bottom: 12px;
						}

						.event-header h3 {
							color: #1f2937;
							font-weight: 700;
							margin: 0;
							font-size: 16px;
						}

						.event-category {
							display: inline-block;
							padding: 4px 12px;
							border-radius: 20px;
							font-size: 11px;
							font-weight: 600;
							text-transform: uppercase;
						}

						.event-category.tech {
							background: #dbeafe;
							color: #1e40af;
						}

						.event-category.community {
							background: #dcfce7;
							color: #15803d;
						}

						.event-category.networking {
							background: #fed7aa;
							color: #b45309;
						}

						.event-details {
							display: grid;
							grid-template-columns: 1fr 1fr;
							gap: 12px;
							margin-bottom: 12px;
						}

						.detail-item {
							display: flex;
							align-items: center;
							gap: 6px;
							font-size: 12px;
							color: #6b7280;
						}

						.detail-item i {
							color: #8A5CF0;
							width: 16px;
						}

						.event-card p {
							color: #6b7280;
							font-size: 13px;
							line-height: 1.6;
							margin: 12px 0;
						}

						/* Stats Dashboard Styling */
						.stats-dashboard {
							background: #ffffff;
							border-radius: 12px;
							padding: 20px;
							box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
						}

						.stats-dashboard h2 {
							color: #1f2937;
							font-weight: 700;
							margin-bottom: 24px;
							padding-bottom: 12px;
							border-bottom: 2px solid #f3f4f6;
						}

						.stat-card {
							display: flex;
							align-items: center;
							gap: 16px;
							padding: 16px;
							margin-bottom: 12px;
							border-radius: 8px;
							background: #f9fafb;
							transition: all 0.3s ease;
						}

						.stat-card:hover {
							background: #f3f4f6;
							transform: translateX(4px);
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
							font-size: 24px;
							width: 40px;
							height: 40px;
							display: flex;
							align-items: center;
							justify-content: center;
							border-radius: 8px;
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
							font-size: 13px;
							font-weight: 600;
							margin: 0 0 6px 0;
						}

						.stat-number {
							color: #1f2937;
							font-size: 24px;
							font-weight: 700;
							margin: 0;
						}

						/* Button Small Styling */
						.button.small {
							background: #fff !important;
							color: #8A5CF0 !important;
							padding: 12px 18px !important;
							border-radius: 12px !important;
							font-weight: 700 !important;
							text-decoration: none !important;
							box-shadow: 0 8px 24px rgba(0,0,0,0.12) !important;
							display: inline-flex !important;
							align-items: center !important;
							cursor: pointer !important;
							border: none !important;
							font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial !important;
							font-size: 0.95em !important;
							letter-spacing: 0.075em !important;
							text-transform: uppercase !important;
						}

						.button.small:hover {
							box-shadow: 0 12px 32px rgba(0,0,0,0.16) !important;
						}

						.button.small:active {
							box-shadow: 0 4px 16px rgba(0,0,0,0.08) !important;
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
														<i class="fas fa-users-circle"></i>
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
				<div id="footer-wrapper">
					<footer id="footer" class="container">
						<div class="row">
							<div class="col-3 col-6-medium col-12-small">

								<!-- Links -->
									<section>
										<h2>Links</h2>
										<ul class="divided">
											<li><a href="#">About Us</a></li>
											<li><a href="#main-wrapper">Features</a></li>
											<li><a href="our_team.php">Our Team</a></li>
											<li><a href="#">Contacts</a></li>
										</ul>
									</section>

							</div>
							<div class="col-3 col-6-medium col-12-small">

								<!-- Links -->
									<section>
									</section>

							</div>
							<div class="col-6 col-12-medium imp-medium">


								<!-- Contact -->
									<section>
										<h2>Get in touch</h2>
										<div>
											<div style="margin-top: -50px;" class="row">
												<div class="col-6 col-12-small">
													<dl class="contact">
														<dt>Twitter</dt>
														<dd><a href="#">Eventy</a></dd>
														<dt>Facebook</dt>
														<dd><a href="#">facebook.com/Eventy</a></dd>
														<dt>WWW</dt>
														<dd><a href="#">Eventy.com</a></dd>
														<dt>Email</dt>
														<dd><a href="#">eventy.industries@gmail.com</a></dd>
													</dl>
												</div>
												<div class="col-6 col-12-small">
													<dl class="contact">
														<dt>Address</dt>
														<dd>
															551 M.F. Jhocson Street<br />
															Sampaloc, Manila<br />
															Metro Manila, Philippines
														</dd>	
													</dl>
												</div>
											</div>
										</div>
									</section>

							</div>
							<div style="margin-top: -150px;"   class="col-12">
								<div id="copyright">
									<ul class="menu">
										<li>&copy; Eventy. All rights reserved</li><li><a href="our_team.php">Eventy Design Team</a></li>
									</ul>
								</div>
							</div>
						</div>
					</footer>
				</div>

		</div>

		<!-- Get Started Button Styles -->
		<style>
			:root {
				/* Adjust this value to change the Get Started button height */
				--get-started-btn-height: 40px;
			}

			.get-started-btn {
				background: #fff !important;
				border-radius: 12px !important;
				color: #7c3aed !important;
				font-weight: 700 !important;
				font-size: 14px !important;
				line-height: 1.5 !important;
				cursor: pointer !important;
				display: inline-flex !important;
				align-items: center !important;
				justify-content: center !important;
				height: var(--get-started-btn-height) !important;
				padding: 0 18px !important;
				transition: all 0.2s ease !important;
				border: none !important;
				text-decoration: none !important;
				white-space: nowrap !important;
				backface-visibility: hidden !important;
				-webkit-font-smoothing: antialiased !important;
				letter-spacing: 0.5px !important;
			}

			.get-started-btn:hover {
				box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12) !important;
				transform: translateY(-2px) translateZ(0) !important;
			}

			.get-started-btn:active {
				transform: translateY(0) translateZ(0) !important;
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
						<input type="password" id="participant_password" name="password" placeholder="Enter a strong password" required>
					</div>
					<div class="form-group">
						<label for="participant_confirm">Confirm Password</label>
						<input type="password" id="participant_confirm" name="confirm_password" placeholder="Confirm your password" required>
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
						<input type="password" id="host_password" name="password" placeholder="Enter a strong password" required>
					</div>
					<div class="form-group">
						<label for="host_confirm">Confirm Password</label>
						<input type="password" id="host_confirm" name="confirm_password" placeholder="Confirm your password" required>
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
							<button type="button" class="password-toggle" onclick="togglePasswordVisibility()" tabindex="-1">
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
				background: rgba(0, 0, 0, 0.5);
				z-index: 10000;
				align-items: center;
				justify-content: center;
				will-change: opacity;
				contain: paint;
			}

			.modal-overlay.active {
				display: flex;
				animation: fadeIn 0.3s ease-out forwards;
			}

			@keyframes fadeIn {
				from {
					opacity: 0;
				}
				to {
					opacity: 1;
				}
			}

			.modal-content {
				background: #ffffff;
				border-radius: 16px;
				padding: 32px;
				max-width: 500px;
				width: 90%;
				box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
				max-height: 90vh;
				overflow: hidden;
				display: flex;
				flex-direction: column;
				will-change: transform;
				contain: layout style paint;
				backface-visibility: hidden;
				-webkit-font-smoothing: antialiased;
			}

			.modal-header {
				flex-shrink: 0;
			}

			.modal-subtitle {
				flex-shrink: 0;
			}

			.registration-form {
				overflow-y: auto;
				padding-right: 8px;
				margin-right: -8px;
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
			}

			.registration-form::-webkit-scrollbar-thumb:hover {
				background: #9ca3af;
			}

			.modal-overlay.active .modal-content {
				animation: slideUp 0.3s ease-out forwards;
			}

			@keyframes slideUp {
				from {
					transform: translateY(30px) translateZ(0);
					opacity: 0;
				}
				to {
					transform: translateY(0) translateZ(0);
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
				font-size: 24px;
				font-weight: 700;
				margin: 0;
				font-family: 'Simonetta', 'Playfair Display', serif;
			}

			.modal-close {
				font-size: 28px;
				font-weight: 300;
				color: #999;
				cursor: pointer;
				transition: color 0.2s;
				line-height: 1;
			}

			.modal-close:hover {
				color: #6F42C7;
			}

			.modal-subtitle {
				color: #666;
				font-size: 14px;
				margin: 8px 0 24px 0;
				font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
			}

			.role-buttons {
				display: grid;
				grid-template-columns: 1fr 1fr;
				gap: 16px;
				margin-top: 24px;
			}

			.role-btn {
				display: flex;
				flex-direction: column;
				align-items: center;
				justify-content: center;
				gap: 12px;
				padding: 28px 16px;
				border: 2px solid #e5e5e5;
				border-radius: 12px;
				background: #f9f9f9;
				cursor: pointer;
				transition: border-color 0.2s, background 0.2s, box-shadow 0.2s, transform 0.2s;
				font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
				text-decoration: none;
				will-change: transform, box-shadow;
				backface-visibility: hidden;
				-webkit-font-smoothing: antialiased;
			}

			.role-btn i {
				font-size: 32px;
				color: #6F42C7;
				transition: color 0.2s;
			}

			.role-btn span {
				font-size: 16px;
				font-weight: 700;
				color: #1f2937;
			}

			.role-btn small {
				font-size: 12px;
				color: #999;
				text-align: center;
			}

			.role-btn:hover {
				border-color: #6F42C7;
				background: #f0ebf8;
				transform: translateY(-2px) translateZ(0);
				box-shadow: 0 8px 20px rgba(111, 66, 193, 0.15);
			}

			.role-btn:hover i {
				color: #8A5CF0;
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
				gap: 6px;
			}

			.form-group label {
				color: #6F42C7;
				font-weight: 600;
				font-size: 13px;
				text-transform: uppercase;
				letter-spacing: 0.5px;
				font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
			}

			.form-group input {
				padding: 12px 14px;
				border: 2px solid #e5e5e5;
				border-radius: 8px;
				font-size: 14px;
				font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
				transition: border-color 0.2s;
				outline: none;
				will-change: border-color;
				backface-visibility: hidden;
				-webkit-font-smoothing: antialiased;
			}

			.form-group input::placeholder {
				color: #bbb;
			}

			.form-group input:focus {
				border-color: #6F42C7;
				box-shadow: 0 0 0 3px rgba(111, 66, 193, 0.1);
			}

			.form-submit {
				padding: 14px 20px;
				background: linear-gradient(135deg, #6F42C7 0%, #8A5CF0 100%);
				color: #ffffff;
				border: none;
				border-radius: 8px;
				font-size: 15px;
				font-weight: 700;
				cursor: pointer;
				transition: box-shadow 0.3s ease, transform 0.2s ease;
				margin-top: 12px;
				font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
				text-transform: uppercase;
				letter-spacing: 0.5px;
				will-change: box-shadow, transform;
				backface-visibility: hidden;
				-webkit-font-smoothing: antialiased;
			}

			.form-submit:hover {
				box-shadow: 0 8px 20px rgba(111, 66, 193, 0.3);
				transform: translateY(-2px) translateZ(0);
			}

			.form-submit:active {
				transform: translateY(0) translateZ(0);
			}

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
				background: none;
				border: none;
				cursor: pointer;
				color: #8A5CF0;
				font-size: 16px;
				padding: 6px;
				display: flex;
				align-items: center;
				justify-content: center;
				transition: color 0.2s ease;
			}

			.password-toggle:hover {
				color: #6F42C7;
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
				.then(response => response.text())
				.then(data => {
					if (data.trim() === 'success') {
						// Show success modal and auto-redirect to dashboard after 4s (no buttons)
						closeLoginModal();
						loginForm.reset();
						resetPasswordVisibility();
						showSuccessAndRedirect('Login Successful!', 'You have successfully signed in. Redirecting to your dashboard...', 'Mainboard.php', false, 2600);
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