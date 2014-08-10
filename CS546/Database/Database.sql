-- phpMyAdmin SQL Dump
-- version 4.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 11, 2014 at 08:08 PM
-- Server version: 5.6.17
-- PHP Version: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `searcher`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
`id_file` int(32) NOT NULL,
  `name` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `file_word`
--

CREATE TABLE IF NOT EXISTS `file_word` (
  `id_file` int(32) NOT NULL,
  `id_word` int(32) NOT NULL,
  `count` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `meta_info`
--

CREATE TABLE IF NOT EXISTS `meta_info` (
  `id_file` int(32) NOT NULL,
  `type` varchar(200) NOT NULL,
  `content` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE IF NOT EXISTS `words` (
`id_word` int(32) NOT NULL,
  `word` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
 ADD PRIMARY KEY (`id_file`), ADD UNIQUE KEY `url` (`url`);

--
-- Indexes for table `file_word`
--
ALTER TABLE `file_word`
 ADD PRIMARY KEY (`id_file`,`id_word`);

--
-- Indexes for table `meta_info`
--
ALTER TABLE `meta_info`
 ADD PRIMARY KEY (`id_file`,`type`);

--
-- Indexes for table `words`
--
ALTER TABLE `words`
 ADD PRIMARY KEY (`id_word`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
MODIFY `id_file` int(32) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `words`
--
ALTER TABLE `words`
MODIFY `id_word` int(32) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
