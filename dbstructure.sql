-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 29, 2015 at 12:10 AM
-- Server version: 5.5.32-cll-lve
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `coebrmei_coebotsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `site_bots`
--

CREATE TABLE IF NOT EXISTS `site_bots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel` varchar(32) NOT NULL,
  `apiKey` tinytext NOT NULL,
  `isActive` bit(1) NOT NULL,
  `pusherAppId` tinytext NOT NULL,
  `pusherAppKey` tinytext NOT NULL,
  `pusherAppSecret` tinytext NOT NULL,
  `accessType` enum('OFFICIAL','PUBLIC','PRIVATE') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `channel` (`channel`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `site_channels`
--

CREATE TABLE IF NOT EXISTS `site_channels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel` varchar(32) NOT NULL,
  `displayName` tinytext NOT NULL,
  `isActive` bit(1) NOT NULL DEFAULT b'1',
  `botChannel` varchar(32) NOT NULL,
  `youtube` tinytext NOT NULL,
  `twitter` tinytext NOT NULL,
  `shouldShowOffensiveWords` bit(1) NOT NULL DEFAULT b'1',
  `shouldShowBoir` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `channel` (`channel`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1275 ;

-- --------------------------------------------------------

--
-- Table structure for table `site_reqsongs`
--

CREATE TABLE IF NOT EXISTS `site_reqsongs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel` varchar(32) NOT NULL,
  `url` varchar(1023) NOT NULL,
  `requestedBy` varchar(32) NOT NULL,
  `dateAdded` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `site_users`
--

CREATE TABLE IF NOT EXISTS `site_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel` varchar(32) NOT NULL,
  `isActive` bit(1) NOT NULL,
  `twitchAccessToken` tinytext NOT NULL,
  `lastLogin` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `channel` (`channel`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1211 ;

-- --------------------------------------------------------

--
-- Table structure for table `site_vars`
--

CREATE TABLE IF NOT EXISTS `site_vars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `var` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `lastModified` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `channel_2` (`channel`,`var`),
  FULLTEXT KEY `channel` (`channel`,`var`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=111 ;
--
-- Database: `coebrmei_highlights`
--

-- --------------------------------------------------------

--
-- Table structure for table `highlights`
--

CREATE TABLE IF NOT EXISTS `highlights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel` varchar(255) NOT NULL,
  `stamp` int(11) DEFAULT NULL,
  `comment` text NOT NULL,
  `type` enum('stream started','highlight','stream ended') NOT NULL DEFAULT 'highlight',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54676 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
