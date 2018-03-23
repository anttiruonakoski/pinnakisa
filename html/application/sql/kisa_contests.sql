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
-- Table structure for table `kisa_contests`
--

CREATE TABLE IF NOT EXISTS `kisa_contests` (
  `id` varchar(64) COLLATE utf8_swedish_ci NOT NULL,
  `name` varchar(128) COLLATE utf8_swedish_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8_swedish_ci NOT NULL,
  `date_begin` date NOT NULL,
  `date_end` date NOT NULL,
  `url` varchar(256) COLLATE utf8_swedish_ci NOT NULL,
  `location_list` varchar(64) COLLATE utf8_swedish_ci DEFAULT NULL,
  `status` varchar(32) COLLATE utf8_swedish_ci NOT NULL,
  `society` int(11) DEFAULT NULL,
  `meta_edited_user` varchar(128) COLLATE utf8_swedish_ci NOT NULL,
  `meta_edited` datetime NOT NULL,
  `meta_created_user` varchar(128) COLLATE utf8_swedish_ci NOT NULL,
  `meta_created` datetime NOT NULL,
  `comparison` varchar(128) COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date_begin` (`date_begin`),
  KEY `date_end` (`date_end`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
