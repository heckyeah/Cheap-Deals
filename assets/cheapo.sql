-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2015 at 02:04 am
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cheapo`
--

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
`ID` tinyint(3) unsigned NOT NULL,
  `Title` varchar(60) NOT NULL,
  `Description` varchar(160) NOT NULL,
  `Name` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`ID`, `Title`, `Description`, `Name`) VALUES
(1, 'Cheap deals for Students - Page not found', 'You broke our website!', '404'),
(2, 'Cheap deals for Students - About Us', 'Find out all about us', 'about'),
(3, 'Cheap deals for Students - Home', 'Everything is cheaper with a discount', 'home'),
(5, 'Cheap deals for Students - Contact Us', 'Send us a message and get in touch!', 'contact'),
(6, 'Cheap deals for Students - Registration', 'An account lets you access more advanced features of the website.', 'register'),
(7, 'Cheap deals for Students - Your Account', 'Your account page', 'account'),
(8, 'Cheap deals for Students - Log out', 'Goodbye :(', 'logout'),
(9, 'Cheap deals for Students - Log In', 'Log into your account', 'login');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`ID` mediumint(8) unsigned NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Privilege` enum('user','admin') NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Username`, `Password`, `Email`, `Privilege`, `CreationDate`) VALUES
(1, 'admin', '$2y$10$SME8qgIrG2G3HRey4ts5IOG.4Wm0Lrh74lhNlS29Ya3JwlTVkku9.', 'admin@admin.com', 'admin', '2015-06-12 02:45:48'),
(2, 'user', '$2y$10$dWiQqS3gYLW6AgxjsfBiZ.Wi64qhf1TmZLXQsdhTY3Drip5AsEWam', 'user@user.com', 'user', '2015-06-12 02:46:48'),
(3, 'benabbott', '$2y$10$g4yhEBDumIRwzd/UDxjTcuVBNMQLsXYt0THdPNDeV2iyNPGkrKnNm', 'ben.abbott@yoobee.ac.nz', 'user', '2015-06-15 02:46:53'),
(4, 'benabbott2', '$2y$10$gE04nIJ.eR59ybzLSojQKOa8szW3ssexlsXl.fbbqrBSS25eWrhMC', 'ben.abbott2@yoobee.ac.nz', 'user', '2015-06-15 03:05:49'),
(5, 'iambatman', '$2y$10$1bu4BVtg3TQ76DufFK1kr.jRM/IL4In04Ekz.D5V8hyN0zsQZFo3G', 'bat@cave.com', 'user', '2015-06-15 03:20:09'),
(6, 'test', '$2y$10$L8Cp/tIkBz7cpRnDHk8/Vud2ky.ffvatNCJgWpna2cKhRd/udgDNm', 'test@test.com', 'user', '2015-06-16 00:33:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
MODIFY `ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `ID` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
