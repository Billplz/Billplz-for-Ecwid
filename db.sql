-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2017 at 10:03 AM
-- Server version: 5.6.32-78.1
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spfaszoi_bzecwid`
--

-- --------------------------------------------------------

--
-- Table structure for table `bze_bills`
--

CREATE TABLE IF NOT EXISTS `bze_bills` (
  `id` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Bill ID',
  `order_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Ecwid Invoice Number',
  `x_login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `relayURL` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `need_callback` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bze_user`
--

CREATE TABLE IF NOT EXISTS `bze_user` (
  `id` int(11) NOT NULL,
  `api_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `collection_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `x_signature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `login_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'API Login ID',
  `transaction_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `md5_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'MD5 Hash Value'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bze_bills`
--
ALTER TABLE `bze_bills`
  ADD PRIMARY KEY (`id`), ADD KEY `x_login_id` (`x_login`) COMMENT 'Login ID ECWID';

--
-- Indexes for table `bze_user`
--
ALTER TABLE `bze_user`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `Login ID` (`login_id`) COMMENT 'Login ID ECWID';

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bze_bills`
--
ALTER TABLE `bze_bills`
ADD CONSTRAINT `Login ID` FOREIGN KEY (`x_login`) REFERENCES `bze_user` (`login_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
