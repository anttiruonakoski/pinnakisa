-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 22, 2014 at 10:26 PM
-- Server version: 5.5.37-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kisa`
--

-- --------------------------------------------------------

--
-- Table structure for table `kisa_participations`
--

CREATE TABLE IF NOT EXISTS `kisa_participations` (
  `id` varchar(64) NOT NULL,
  `contest_id` varchar(64) NOT NULL,
  `name` varchar(512) NOT NULL,
  `location` varchar(256) NOT NULL,
  `kms` decimal(10,0) DEFAULT NULL,
  `hours` decimal(10,0) DEFAULT NULL,
  `spontaneous` smallint(6) DEFAULT NULL,
  `species_json` mediumtext NOT NULL,
  `species_count` int(11) DEFAULT NULL,
  `ticks_day_json` text,
  `meta_edited` datetime NOT NULL,
  `meta_created` datetime NOT NULL,
  `meta_edited_user` varchar(128) NOT NULL,
  `meta_created_user` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contest_id` (`contest_id`),
  KEY `location` (`location`),
  KEY `species_count` (`species_count`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
