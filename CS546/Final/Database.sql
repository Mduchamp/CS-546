-- phpMyAdmin SQL Dump
-- version 4.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2014 at 05:31 PM
-- Server version: 5.6.17
-- PHP Version: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `document`
--
CREATE DATABASE IF NOT EXISTS `document` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `document`;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
`id_doc` int(32) unsigned NOT NULL,
  `id_owner` int(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id_user` int(32) NOT NULL,
  `id_doc` int(32) NOT NULL,
  `can_read` tinyint(1) NOT NULL DEFAULT '0',
  `can_write` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`id_user` int(32) unsigned NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `writing`
--

DROP TABLE IF EXISTS `writing`;
CREATE TABLE IF NOT EXISTS `writing` (
  `id_user` int(32) NOT NULL,
  `id_doc` int(32) NOT NULL,
  `timestamp` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
 ADD PRIMARY KEY (`id_doc`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
 ADD PRIMARY KEY (`id_user`,`id_doc`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id_user`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `writing`
--
ALTER TABLE `writing`
 ADD PRIMARY KEY (`id_user`,`id_doc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
MODIFY `id_doc` int(32) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id_user` int(32) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
