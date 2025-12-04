-- Create database and use it
CREATE DATABASE IF NOT EXISTS `eventy`
  CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
USE `eventy`;

-- Users table (hosts)
CREATE TABLE IF NOT EXISTS `users` (
  `HostID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `firstname` VARCHAR(50) NOT NULL,
  `lastname` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `contactno` VARCHAR(20) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Events table
CREATE TABLE IF NOT EXISTS `events` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `capacity` INT DEFAULT NULL,
  `event_date` DATE DEFAULT NULL,
  `event_time` TIME DEFAULT NULL,
  `location` VARCHAR(255) DEFAULT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  `HostID` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT `fk_events_host` FOREIGN KEY (`HostID`) REFERENCES `users`(`HostID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Optional sample seed data (adjust passwords to real hashes)
INSERT IGNORE INTO `users` (`firstname`,`lastname`,`email`,`contactno`,`password`) VALUES
('Admin','User','admin@example.com','0123456789','$2y$10$examplehashedpassword');

INSERT IGNORE INTO `events` (`name`,`description`,`capacity`,`event_date`,`event_time`,`location`,`status`,`HostID`) VALUES
('Sample Event','This is a sample event',100,'2026-05-10','09:00:00','Main Hall',1,1);
