-- 1) Ensure database and select it
CREATE DATABASE IF NOT EXISTS `eventy`
  CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
USE `eventy`;

-- 2) Create users first (InnoDB + PK on HostID)
CREATE TABLE IF NOT EXISTS `users` (
  `HostID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `firstname` VARCHAR(50) NOT NULL,
  `lastname`  VARCHAR(50) NOT NULL,
  `city` VARCHAR(100) DEFAULT NULL,
  `bio`  TEXT DEFAULT NULL,
  `profile_picture` VARCHAR(255) DEFAULT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `contactno` VARCHAR(20) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- If users already exists but is not InnoDB, convert it:
-- (Run this only if needed)
-- ALTER TABLE `users` ENGINE=InnoDB;

-- 3) Now create user_settings with FK to users
CREATE TABLE IF NOT EXISTS `user_settings` (
  `HostID` INT NOT NULL PRIMARY KEY,
  `darkmode` TINYINT(1) NOT NULL DEFAULT 0,
  `language` VARCHAR(32) NOT NULL DEFAULT 'english',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `fk_user_settings_host`
    FOREIGN KEY (`HostID`) REFERENCES `users`(`HostID`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4) Backfill settings for any existing users
INSERT INTO `user_settings` (`HostID`)
SELECT u.`HostID`
FROM `users` u
LEFT JOIN `user_settings` s ON s.`HostID` = u.`HostID`
WHERE s.`HostID` IS NULL;

-- Safe migration for existing databases: add missing user columns (MySQL/MariaDB compatible)
-- Add `city` if missing
SET @col_exists := (
  SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'users'
    AND COLUMN_NAME = 'city'
);
SET @sql := IF(@col_exists = 0,
  'ALTER TABLE `users` ADD COLUMN `city` VARCHAR(100) DEFAULT NULL AFTER `lastname`',
  'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

-- Add `bio` if missing
SET @col_exists := (
  SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'users'
    AND COLUMN_NAME = 'bio'
);
SET @sql := IF(@col_exists = 0,
  'ALTER TABLE `users` ADD COLUMN `bio` TEXT DEFAULT NULL AFTER `city`',
  'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

-- Add `profile_picture` if missing
SET @col_exists := (
  SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'users'
    AND COLUMN_NAME = 'profile_picture'
);
SET @sql := IF(@col_exists = 0,
  'ALTER TABLE `users` ADD COLUMN `profile_picture` VARCHAR(255) DEFAULT NULL AFTER `bio`',
  'SELECT 1'
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

-- Optional sample seed data (adjust passwords to real hashes)
INSERT IGNORE INTO `users` (`firstname`,`lastname`,`city`,`bio`,`profile_picture`,`email`,`contactno`,`password`) VALUES
('Admin','User',NULL,NULL,NULL,'admin@example.com','0123456789','$2y$10$examplehashedpassword');

-- Ensure events table exists before seeding
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

INSERT IGNORE INTO `events` (`name`,`description`,`capacity`,`event_date`,`event_time`,`location`,`status`,`HostID`) VALUES
('Sample Event','This is a sample event',100,'2026-05-10','09:00:00','Main Hall',1,1);

-- 5) Email verification storage for OTPs
CREATE TABLE IF NOT EXISTS `email_verification` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(255) NOT NULL,
  `otp` VARCHAR(6) NOT NULL,
  `expires_at` DATETIME NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
