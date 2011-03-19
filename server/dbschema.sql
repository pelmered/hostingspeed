-- phpMyAdmin SQL Dump
-- version 2.11.8.1deb5+lenny7
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 18 mars 2011 kl 14:41
-- Serverversion: 5.1.54
-- PHP-version: 5.3.5-0.dotdeb.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `hostingspeed`
--

-- --------------------------------------------------------

--
-- Struktur för tabell `errorlog`
--

CREATE TABLE IF NOT EXISTS `errorlog` (
  `id` int(11) unsigned NOT NULL,
  `testid` int(11) unsigned NOT NULL,
  `testhostid` int(11) unsigned NOT NULL,
  `code` mediumint(5) unsigned NOT NULL,
  `msg` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `testid` (`testid`,`testhostid`,`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Data i tabell `errorlog`
--


-- --------------------------------------------------------

--
-- Struktur för tabell `testhosts`
--

CREATE TABLE IF NOT EXISTS `testhosts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `webhost` int(11) NOT NULL,
  `scripthost` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `active` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabell med alla hosts som ska testas.' AUTO_INCREMENT=2 ;

--
-- Data i tabell `testhosts`
--

INSERT INTO `testhosts` (`id`, `webhost`, `scripthost`, `url`, `active`) VALUES
(1, 0, '', 'http://www.elmered.com/test/', 'yes');

-- --------------------------------------------------------

--
-- Struktur för tabell `testresults`
--

CREATE TABLE IF NOT EXISTS `testresults` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `testid` int(11) unsigned NOT NULL,
  `time` int(11) unsigned NOT NULL,
  `testtype` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `result` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `testid` (`testid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Testresultat' AUTO_INCREMENT=5 ;

--
-- Data i tabell `testresults`
--

INSERT INTO `testresults` (`id`, `testid`, `time`, `testtype`, `result`) VALUES
(1, 3, 1300463305, 'insert', '11628'),
(2, 3, 1300463305, 'insert_pdo', '12500'),
(3, 3, 1300463305, 'select', '31250'),
(4, 3, 1300463305, 'update', '8197');

-- --------------------------------------------------------

--
-- Struktur för tabell `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hostid` int(11) unsigned NOT NULL,
  `time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hostid` (`hostid`,`time`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Data i tabell `tests`
--

INSERT INTO `tests` (`id`, `hostid`, `time`) VALUES
(1, 1, 1300463054),
(2, 1, 1300463067),
(3, 1, 1300463305),
(4, 1, 1300464949),
(5, 1, 1300464958),
(6, 1, 1300464959),
(7, 1, 1300483732);

-- --------------------------------------------------------

--
-- Struktur för tabell `webhosts`
--

CREATE TABLE IF NOT EXISTS `webhosts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Webbhotell';

--
-- Data i tabell `webhosts`
--

