-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for weather
DROP DATABASE IF EXISTS `weather`;
CREATE DATABASE IF NOT EXISTS `weather` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `weather`;


-- Dumping structure for table weather.ikjpr_contest_current
DROP TABLE IF EXISTS `ikjpr_contest_current`;
CREATE TABLE IF NOT EXISTS `ikjpr_contest_current` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL,
  `category` tinyint(2) NOT NULL,
  `region_id` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `cur-region` (`region_id`),
  KEY `cur-type` (`type_id`),
  CONSTRAINT `cur-region` FOREIGN KEY (`region_id`) REFERENCES `ikjpr_region` (`id`),
  CONSTRAINT `cur-type` FOREIGN KEY (`type_id`) REFERENCES `ikjpr_contest_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table weather.ikjpr_contest_current: ~0 rows (approximately)
DELETE FROM `ikjpr_contest_current`;
/*!40000 ALTER TABLE `ikjpr_contest_current` DISABLE KEYS */;
/*!40000 ALTER TABLE `ikjpr_contest_current` ENABLE KEYS */;


-- Dumping structure for table weather.ikjpr_contest_type
DROP TABLE IF EXISTS `ikjpr_contest_type`;
CREATE TABLE IF NOT EXISTS `ikjpr_contest_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `entry_fee` decimal(10,2) NOT NULL,
  `withheld` decimal(10,2) NOT NULL,
  `min_players` int(11) NOT NULL,
  `max_players` int(11) NOT NULL,
  `structure_id` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `type-structure` (`structure_id`),
  CONSTRAINT `type-structure` FOREIGN KEY (`structure_id`) REFERENCES `ikjpr_structure` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table weather.ikjpr_contest_type: ~2 rows (approximately)
DELETE FROM `ikjpr_contest_type`;
/*!40000 ALTER TABLE `ikjpr_contest_type` DISABLE KEYS */;
INSERT INTO `ikjpr_contest_type` (`id`, `title`, `entry_fee`, `withheld`, `min_players`, `max_players`, `structure_id`, `status`) VALUES
	(1, 'Head To Head', 10.00, 1.00, 2, 2, 1, 10),
	(2, 'Head To Head', 20.00, 2.00, 2, 2, 1, 10);
/*!40000 ALTER TABLE `ikjpr_contest_type` ENABLE KEYS */;


-- Dumping structure for table weather.ikjpr_location
DROP TABLE IF EXISTS `ikjpr_location`;
CREATE TABLE IF NOT EXISTS `ikjpr_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lon` float(10,6) NOT NULL,
  `subregion_id` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `location-subregion` (`subregion_id`),
  CONSTRAINT `location-subregion` FOREIGN KEY (`subregion_id`) REFERENCES `ikjpr_subregion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- Dumping data for table weather.ikjpr_location: ~51 rows (approximately)
DELETE FROM `ikjpr_location`;
/*!40000 ALTER TABLE `ikjpr_location` DISABLE KEYS */;
INSERT INTO `ikjpr_location` (`id`, `title`, `lat`, `lon`, `subregion_id`, `status`) VALUES
	(1, 'Montgomery', 32.380119, -86.300629, 1, 10),
	(2, 'Juneau', 58.299740, -134.406799, 2, 10),
	(3, 'Phoenix', 33.448261, -112.075775, 3, 10),
	(4, 'Little Rock', 34.748653, -92.274490, 4, 10),
	(5, 'Sacramento', 38.579063, -121.491013, 5, 10),
	(6, 'Denver', 39.740009, -104.992256, 6, 10),
	(7, 'Hartford', 41.763325, -72.674072, 7, 10),
	(8, 'Dover', 39.158035, -75.524734, 8, 10),
	(9, 'Tallahassee', 30.439775, -84.280647, 9, 10),
	(10, 'Atlanta', 33.748314, -84.391106, 10, 10),
	(11, 'Honolulu', 21.304770, -157.857620, 11, 10),
	(12, 'Boise', 43.606979, -116.193413, 12, 10),
	(13, 'Springfield', 39.801056, -89.643600, 13, 10),
	(14, 'Indianapolis', 39.766911, -86.149963, 14, 10),
	(15, 'Des Moines', 41.589790, -93.615662, 15, 10),
	(16, 'Topeka', 39.049286, -95.671181, 16, 10),
	(17, 'Frankfort', 38.195068, -84.878693, 17, 10),
	(18, 'Baton Rouge', 30.443344, -91.186996, 18, 10),
	(19, 'Augusta', 44.318035, -69.776215, 19, 10),
	(20, 'Annapolis', 38.976700, -76.489937, 20, 10),
	(21, 'Boston', 42.358635, -71.056702, 21, 10),
	(22, 'Lansing', 42.731941, -84.552246, 22, 10),
	(23, 'Saint Paul', 44.943829, -93.093323, 23, 10),
	(24, 'Jackson', 32.298691, -90.180489, 24, 10),
	(25, 'Jefferson City', 38.577515, -92.177841, 25, 10),
	(26, 'Helana', 46.589760, -112.021202, 26, 10),
	(27, 'Lincoln', 40.813622, -96.707741, 27, 10),
	(28, 'Carson City', 39.164886, -119.766998, 28, 10),
	(29, 'Concord', 43.207249, -71.536606, 29, 10),
	(30, 'Trenton', 40.217876, -74.759407, 30, 10),
	(31, 'Santa Fe', 35.691544, -105.937408, 31, 10),
	(32, 'Albany', 42.651443, -73.755257, 32, 10),
	(33, 'Raleigh', 35.785511, -78.642670, 33, 10),
	(34, 'Bismarck', 46.805370, -100.779335, 34, 10),
	(35, 'Columbus', 39.961960, -83.002983, 35, 10),
	(36, 'Oklahoma City', 35.472015, -97.520355, 36, 10),
	(37, 'Salem', 44.933262, -123.043816, 37, 10),
	(38, 'Harrisburg', 40.259865, -76.882233, 38, 10),
	(39, 'Providence', 41.823875, -71.411995, 39, 10),
	(40, 'Columbia', 33.998550, -81.045250, 40, 10),
	(41, 'Pierre', 44.368923, -100.350159, 41, 10),
	(42, 'Nashville', 36.167782, -86.778366, 42, 10),
	(43, 'Austin', 30.267605, -97.742981, 43, 10),
	(44, 'Salt Lake City', 40.759506, -111.888229, 44, 10),
	(45, 'Montpelier', 44.260300, -72.576263, 45, 10),
	(46, 'Richmond', 37.540699, -77.433655, 46, 10),
	(47, 'Olympia', 47.039230, -122.891365, 47, 10),
	(48, 'Charleston', 38.350197, -81.638992, 48, 10),
	(49, 'Madison', 43.072948, -89.386696, 49, 10),
	(50, 'Cheyenne', 41.134815, -104.821541, 50, 10),
	(51, 'Washington', 38.904701, -77.016403, 51, 10);
/*!40000 ALTER TABLE `ikjpr_location` ENABLE KEYS */;


-- Dumping structure for table weather.ikjpr_migration
DROP TABLE IF EXISTS `ikjpr_migration`;
CREATE TABLE IF NOT EXISTS `ikjpr_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table weather.ikjpr_migration: ~2 rows (approximately)
DELETE FROM `ikjpr_migration`;
/*!40000 ALTER TABLE `ikjpr_migration` DISABLE KEYS */;
INSERT INTO `ikjpr_migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1432654905),
	('m130524_201442_init', 1432654908);
/*!40000 ALTER TABLE `ikjpr_migration` ENABLE KEYS */;


-- Dumping structure for table weather.ikjpr_region
DROP TABLE IF EXISTS `ikjpr_region`;
CREATE TABLE IF NOT EXISTS `ikjpr_region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `parent_region_id` int(11) NOT NULL DEFAULT '1',
  `status` smallint(6) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table weather.ikjpr_region: ~3 rows (approximately)
DELETE FROM `ikjpr_region`;
/*!40000 ALTER TABLE `ikjpr_region` DISABLE KEYS */;
INSERT INTO `ikjpr_region` (`id`, `title`, `parent_region_id`, `status`) VALUES
	(1, 'All', 0, 10),
	(2, 'United States', 1, 10),
	(3, 'Canada', 1, 0);
/*!40000 ALTER TABLE `ikjpr_region` ENABLE KEYS */;


-- Dumping structure for table weather.ikjpr_structure
DROP TABLE IF EXISTS `ikjpr_structure`;
CREATE TABLE IF NOT EXISTS `ikjpr_structure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `structure` text NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table weather.ikjpr_structure: ~2 rows (approximately)
DELETE FROM `ikjpr_structure`;
/*!40000 ALTER TABLE `ikjpr_structure` DISABLE KEYS */;
INSERT INTO `ikjpr_structure` (`id`, `title`, `structure`, `status`) VALUES
	(1, 'Head To Head', 'Filler', 10),
	(2, 'Four Man', 'Filler', 10);
/*!40000 ALTER TABLE `ikjpr_structure` ENABLE KEYS */;


-- Dumping structure for table weather.ikjpr_subregion
DROP TABLE IF EXISTS `ikjpr_subregion`;
CREATE TABLE IF NOT EXISTS `ikjpr_subregion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `short_title` varchar(8) DEFAULT NULL,
  `region_id` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `subregion-region` (`region_id`),
  CONSTRAINT `subregion-region` FOREIGN KEY (`region_id`) REFERENCES `ikjpr_region` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- Dumping data for table weather.ikjpr_subregion: ~51 rows (approximately)
DELETE FROM `ikjpr_subregion`;
/*!40000 ALTER TABLE `ikjpr_subregion` DISABLE KEYS */;
INSERT INTO `ikjpr_subregion` (`id`, `title`, `short_title`, `region_id`, `status`) VALUES
	(1, 'Alabama', 'AL', 2, 10),
	(2, 'Alaska', 'AK', 2, 10),
	(3, 'Arizona', 'AZ', 2, 10),
	(4, 'Arkansas', 'AR', 2, 10),
	(5, 'California', 'CA', 2, 10),
	(6, 'Colorado', 'CO', 2, 10),
	(7, 'Connecticut', 'CT', 2, 10),
	(8, 'Delaware', 'DE', 2, 10),
	(9, 'Florida', 'FL', 2, 10),
	(10, 'Georgia', 'GA', 2, 10),
	(11, 'Hawaii', 'HI', 2, 10),
	(12, 'Idaho', 'ID', 2, 10),
	(13, 'Illinois', 'IL', 2, 10),
	(14, 'Indiana', 'IN', 2, 10),
	(15, 'Iowa', 'IA', 2, 10),
	(16, 'Kansas', 'KS', 2, 10),
	(17, 'Kentucky', 'KY', 2, 10),
	(18, 'Louisiana', 'LA', 2, 10),
	(19, 'Maine', 'ME', 2, 10),
	(20, 'Maryland', 'MD', 2, 10),
	(21, 'Massachusetts', 'MA', 2, 10),
	(22, 'Michigan', 'MI', 2, 10),
	(23, 'Minnesota', 'MN', 2, 10),
	(24, 'Mississippi', 'MS', 2, 10),
	(25, 'Missouri', 'MO', 2, 10),
	(26, 'Montana', 'MT', 2, 10),
	(27, 'Nebraska', 'NE', 2, 10),
	(28, 'Nevada', 'NV', 2, 10),
	(29, 'New Hampshire', 'NH', 2, 10),
	(30, 'New Jersey', 'NJ', 2, 10),
	(31, 'New Mexico', 'NM', 2, 10),
	(32, 'New York', 'NY', 2, 10),
	(33, 'North Carolina', 'NC', 2, 10),
	(34, 'North Dakota', 'ND', 2, 10),
	(35, 'Ohio', 'OH', 2, 10),
	(36, 'Oklahoma', 'OK', 2, 10),
	(37, 'Oregon', 'OR', 2, 10),
	(38, 'Pennsylvania', 'PA', 2, 10),
	(39, 'Rhode Island', 'RI', 2, 10),
	(40, 'South Carolina', 'SC', 2, 10),
	(41, 'South Dakota', 'SD', 2, 10),
	(42, 'Tennessee', 'TN', 2, 10),
	(43, 'Texas', 'TX', 2, 10),
	(44, 'Utah', 'UT', 2, 10),
	(45, 'Vermont', 'VT', 2, 10),
	(46, 'Virginia', 'VA', 2, 10),
	(47, 'Washington', 'WA', 2, 10),
	(48, 'West Virginia', 'WV', 2, 10),
	(49, 'Wisconsin', 'WI', 2, 10),
	(50, 'Wyoming', 'WY', 2, 10),
	(51, 'District of Columbia', 'DC', 2, 10);
/*!40000 ALTER TABLE `ikjpr_subregion` ENABLE KEYS */;


-- Dumping structure for table weather.ikjpr_user
DROP TABLE IF EXISTS `ikjpr_user`;
CREATE TABLE IF NOT EXISTS `ikjpr_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` tinyint(2) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `balance_bonus` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table weather.ikjpr_user: ~3 rows (approximately)
DELETE FROM `ikjpr_user`;
/*!40000 ALTER TABLE `ikjpr_user` DISABLE KEYS */;
INSERT INTO `ikjpr_user` (`id`, `username`, `email`, `role`, `created_at`, `updated_at`, `password_reset_token`, `password_hash`, `auth_key`, `status`, `balance`, `balance_bonus`) VALUES
	(1, 'ThorAdmin', 'luigijerk@gmail.com', 10, 1432654937, 1432681416, NULL, '$2y$13$lMymixop3SuGFZQusTWbEutf2J600axuNEZFXxboo0qnzOVFUjv7G', '67EhuxbrUc6vqhung7zjy8umfk307BYX', 10, 0.00, 0.00),
	(5, 'Doofus', 'doofus@test.com', 1, 1432682156, 1434306019, NULL, '$2y$13$eYtvye2R./DnBKy0zzAbuO8boW0lOCaKbXvq0XbA0la6yMeSq347K', 'Vg2L8b5eTKckcV_CURLMevsSuSVywaTw', 10, 0.00, 0.00),
	(9, 'NewGuy', 'test@test.com', 1, 1432683220, 1432683719, NULL, '$2y$13$Bds.H71gd7SiCwhSS./QB.9/q2b3gzb1LY3rhEG3G099xP8cf3S3y', 'kXTGr8fCVYOceHjFBy_FDX3ghLKyQD6s', 10, 0.00, 0.00);
/*!40000 ALTER TABLE `ikjpr_user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
