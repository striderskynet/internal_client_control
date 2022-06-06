-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.14 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for {data}
DROP DATABASE IF EXISTS `{data}`;
CREATE DATABASE IF NOT EXISTS `{data}` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `{data}`;

-- Dumping structure for table {data}.general_users
DROP TABLE IF EXISTS `general_users`;
CREATE TABLE IF NOT EXISTS `general_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(15) NOT NULL DEFAULT 'observer',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table {data}.main_clients
DROP TABLE IF EXISTS `main_clients`;
CREATE TABLE IF NOT EXISTS `main_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `prefix` varchar(10) NOT NULL DEFAULT 'Sr.',
  `passport` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `country` varchar(2) NOT NULL,
  `date_added` datetime NOT NULL,
  `company` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `image` binary(50) DEFAULT NULL,
  `observations` tinyblob,
  `last_touch` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=491 DEFAULT CHARSET=latin1 COMMENT='Database to store the clients in the system';

-- Data exporting was unselected.

-- Dumping structure for table {data}.main_vouchers
DROP TABLE IF EXISTS `main_vouchers`;
CREATE TABLE IF NOT EXISTS `main_vouchers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_client` int(11) NOT NULL DEFAULT '0',
  `data` text,
  `type` varchar(50) NOT NULL DEFAULT '0',
  `in_date` date NOT NULL,
  `out_date` date NOT NULL,
  `information` text,
  `service_partner` varchar(50) DEFAULT NULL,
  `confirmation_number` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `main_client` (`main_client`),
  CONSTRAINT `main_client` FOREIGN KEY (`main_client`) REFERENCES `main_clients` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table {data}.voucher_client_array
DROP TABLE IF EXISTS `voucher_client_array`;
CREATE TABLE IF NOT EXISTS `voucher_client_array` (
  `voucher_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  KEY `FK__main_clients` (`client_id`),
  KEY `FK__main_vouchers` (`voucher_id`),
  CONSTRAINT `FK__main_clients` FOREIGN KEY (`client_id`) REFERENCES `main_clients` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK__main_vouchers` FOREIGN KEY (`voucher_id`) REFERENCES `main_vouchers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
