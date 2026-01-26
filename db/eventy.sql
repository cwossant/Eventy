-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 22, 2026 at 05:25 PM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventy`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_verification`
--

DROP TABLE IF EXISTS `email_verification`;
CREATE TABLE IF NOT EXISTS `email_verification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_verification`
--

INSERT INTO `email_verification` (`id`, `email`, `otp`, `expires_at`, `created_at`) VALUES
(1, 'evhyyy7@gmail.com', '126221', '2026-01-05 16:30:30', '2026-01-05 16:25:30'),
(2, 'markdwayne68@gmail.com', '469178', '2026-01-05 16:31:10', '2026-01-05 16:26:10'),
(3, 'markdwayne68@gmail.com', '105987', '2026-01-05 16:32:40', '2026-01-05 16:27:40'),
(4, 'eventy.industries@gmail.com', '585102', '2026-01-05 16:53:16', '2026-01-05 16:48:16'),
(5, 'eventy.industries@gmail.com', '984813', '2026-01-05 16:54:20', '2026-01-05 16:49:20'),
(6, 'eventy.industries@gmail.com', '553694', '2026-01-05 16:54:38', '2026-01-05 16:49:38'),
(7, 'eventy.industries@gmail.com', '718179', '2026-01-05 17:00:59', '2026-01-05 16:55:59'),
(8, 'test@inbox.mailtrap.io', '918151', '2026-01-05 17:01:35', '2026-01-05 16:56:35'),
(9, 'eventy.industries@gmail.com', '719527', '2026-01-05 17:02:31', '2026-01-05 16:57:31'),
(10, 'eventy.industries@gmail.com', '251364', '2026-01-05 17:03:34', '2026-01-05 16:58:34'),
(11, 'your@email.com', '527155', '2026-01-05 17:09:23', '2026-01-05 17:04:23'),
(12, 'markdwayne68@gmail.com', '909997', '2026-01-05 17:09:41', '2026-01-05 17:04:41');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `capacity` int DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `event_time` time DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `event_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `attendees` int DEFAULT '0',
  `is_featured` tinyint(1) DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `HostID` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_events_host` (`HostID`),
  KEY `fk_events_category` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `capacity`, `event_date`, `event_time`, `location`, `category_id`, `event_image`, `latitude`, `longitude`, `attendees`, `is_featured`, `status`, `HostID`, `created_at`) VALUES
(1, 'Sample Event', 'This is a sample event', 100, '2026-05-10', '09:00:00', 'Main Hall', NULL, NULL, NULL, NULL, 0, 0, 1, 1, '2026-01-05 15:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `event_attendees`
--

DROP TABLE IF EXISTS `event_attendees`;
CREATE TABLE IF NOT EXISTS `event_attendees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `check_in_date` timestamp NULL DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'registered',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_attendee` (`event_id`,`email`),
  KEY `idx_event` (`event_id`),
  KEY `idx_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_categories`
--

DROP TABLE IF EXISTS `event_categories`;
CREATE TABLE IF NOT EXISTS `event_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `color_code` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '#6C63FF',
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'fa-calendar',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_categories`
--

INSERT INTO `event_categories` (`id`, `name`, `description`, `color_code`, `icon`, `created_at`) VALUES
(1, 'Technology', 'Tech conferences, workshops, and meetups', '#667eea', 'fa-laptop', '2026-01-22 17:03:27'),
(2, 'Business', 'Business conferences, networking events', '#764ba2', 'fa-briefcase', '2026-01-22 17:03:27'),
(3, 'Education', 'Seminars, workshops, courses', '#4facfe', 'fa-graduation-cap', '2026-01-22 17:03:27'),
(4, 'Sports', 'Sports events, competitions', '#00f2fe', 'fa-basketball', '2026-01-22 17:03:27'),
(5, 'Entertainment', 'Concerts, shows, festivals', '#fa709a', 'fa-music', '2026-01-22 17:03:27'),
(6, 'Social', 'Meetups, parties, community events', '#fee140', 'fa-users', '2026-01-22 17:03:27'),
(7, 'Health', 'Fitness, wellness, health talks', '#30cfd0', 'fa-heart', '2026-01-22 17:03:27'),
(8, 'Art & Culture', 'Exhibitions, theater, cultural events', '#a8edea', 'fa-palette', '2026-01-22 17:03:27'),
(9, 'Other', 'Miscellaneous events', '#9ca3af', 'fa-calendar-alt', '2026-01-22 17:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `event_images`
--

DROP TABLE IF EXISTS `event_images`;
CREATE TABLE IF NOT EXISTS `event_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_primary` tinyint(1) DEFAULT '0',
  `uploaded_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_event` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_notifications`
--

DROP TABLE IF EXISTS `event_notifications`;
CREATE TABLE IF NOT EXISTS `event_notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `HostID` int NOT NULL,
  `event_id` int NOT NULL,
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sent_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint(1) DEFAULT '0',
  `related_user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_host_event` (`HostID`,`event_id`),
  KEY `idx_event` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `host_notification_settings`
--

DROP TABLE IF EXISTS `host_notification_settings`;
CREATE TABLE IF NOT EXISTS `host_notification_settings` (
  `HostID` int NOT NULL,
  `email_new_registration` tinyint(1) DEFAULT '1',
  `email_event_reminders` tinyint(1) DEFAULT '1',
  `email_event_updates` tinyint(1) DEFAULT '1',
  `email_cancellations` tinyint(1) DEFAULT '1',
  `email_attendee_messages` tinyint(1) DEFAULT '1',
  `email_weekly_digest` tinyint(1) DEFAULT '0',
  `notification_frequency` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'immediate',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`HostID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `host_notification_settings`
--

INSERT INTO `host_notification_settings` (`HostID`, `email_new_registration`, `email_event_reminders`, `email_event_updates`, `email_cancellations`, `email_attendee_messages`, `email_weekly_digest`, `notification_frequency`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 0, 'immediate', '2026-01-22 17:04:01'),
(8, 1, 1, 1, 1, 1, 0, 'immediate', '2026-01-22 17:04:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `HostID` int NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'if host or participant',
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactno` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`HostID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`HostID`, `user_type`, `firstname`, `lastname`, `city`, `bio`, `profile_picture`, `email`, `contactno`, `password`, `created_at`) VALUES
(1, '', 'Admin', 'User', NULL, NULL, NULL, 'admin@example.com', '0123456789', '$2y$10$examplehashedpassword', '2026-01-05 15:50:20'),
(8, 'host', 'mark', 'dwayne', NULL, NULL, 'default_profile.jpg', 'markdwayne68@gmail.com', '09111111111', '$2y$10$VGiqUuRZKJMBsArUST2mjeYozZWZBnHJwvy6gZ8OoiJJmgLeXmOam', '2026-01-19 15:28:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

DROP TABLE IF EXISTS `user_settings`;
CREATE TABLE IF NOT EXISTS `user_settings` (
  `HostID` int NOT NULL,
  `darkmode` tinyint(1) NOT NULL DEFAULT '0',
  `language` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'english',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`HostID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_events_category` FOREIGN KEY (`category_id`) REFERENCES `event_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_events_host` FOREIGN KEY (`HostID`) REFERENCES `users` (`HostID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_attendees`
--
ALTER TABLE `event_attendees`
  ADD CONSTRAINT `fk_attendee_event` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_attendee_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`HostID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `event_images`
--
ALTER TABLE `event_images`
  ADD CONSTRAINT `fk_image_event` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_notifications`
--
ALTER TABLE `event_notifications`
  ADD CONSTRAINT `fk_notification_event` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_notification_host` FOREIGN KEY (`HostID`) REFERENCES `users` (`HostID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `host_notification_settings`
--
ALTER TABLE `host_notification_settings`
  ADD CONSTRAINT `fk_notification_settings_host` FOREIGN KEY (`HostID`) REFERENCES `users` (`HostID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD CONSTRAINT `fk_user_settings_host` FOREIGN KEY (`HostID`) REFERENCES `users` (`HostID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Table structure for table `participant_favorites`
--

DROP TABLE IF EXISTS `participant_favorites`;
CREATE TABLE IF NOT EXISTS `participant_favorites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `event_id` int NOT NULL,
  `added_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_favorite` (`user_id`, `event_id`),
  KEY `idx_user` (`user_id`),
  KEY `idx_event` (`event_id`),
  CONSTRAINT `fk_favorite_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`HostID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_favorite_event` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
