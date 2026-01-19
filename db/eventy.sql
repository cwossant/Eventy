-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 19, 2026 at 03:29 PM
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
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `HostID` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_events_host` (`HostID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `capacity`, `event_date`, `event_time`, `location`, `status`, `HostID`, `created_at`) VALUES
(1, 'Sample Event', 'This is a sample event', 100, '2026-05-10', '09:00:00', 'Main Hall', 1, 1, '2026-01-05 15:50:20');

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
(8, 'participant', 'mark', 'dwayne', NULL, NULL, 'default_profile.jpg', 'markdwayne68@gmail.com', '09111111111', '$2y$10$VGiqUuRZKJMBsArUST2mjeYozZWZBnHJwvy6gZ8OoiJJmgLeXmOam', '2026-01-19 15:28:08');

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
  ADD CONSTRAINT `fk_events_host` FOREIGN KEY (`HostID`) REFERENCES `users` (`HostID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD CONSTRAINT `fk_user_settings_host` FOREIGN KEY (`HostID`) REFERENCES `users` (`HostID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
