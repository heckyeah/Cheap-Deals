-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 19, 2015 at 05:08 am
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
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
`ID` tinyint(3) unsigned NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Bio` varchar(200) NOT NULL,
  `ProfileImage` varchar(50) NOT NULL,
  `Job` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`ID`, `FirstName`, `LastName`, `Bio`, `ProfileImage`, `Job`) VALUES
(1, 'Ben', 'Abbott', 'Ben is the lead developer of Cheap Deals for students.', 'http://placehold.it/320x180', 'Lead Developer'),
(2, 'Billy', 'Bob', 'Billy Bob is the Lead Designer of Cheap Deals for Students.', 'http://placehold.it/320x180', 'Lead Designer'),
(4, 'Bruce', 'Wayne', 'I am a BAT!', 'http://placehold.it/320x180', 'The Batman');

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
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Active` enum('enabled','disabled') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Username`, `Password`, `Email`, `Privilege`, `CreationDate`, `Active`) VALUES
(1, 'admin', '$2y$10$u9Q5Dn.A2DsKs2LUUeNMD./e2M2qwGjAfFH7gNcWSvNf6ZUFPjFm6', 'admin@admin.com', 'admin', '2015-06-12 02:45:48', 'enabled'),
(2, 'user', '$2y$10$dWiQqS3gYLW6AgxjsfBiZ.Wi64qhf1TmZLXQsdhTY3Drip5AsEWam', 'user@user.com', 'user', '2015-06-12 02:46:48', 'enabled'),
(3, 'benabbott', '$2y$10$g4yhEBDumIRwzd/UDxjTcuVBNMQLsXYt0THdPNDeV2iyNPGkrKnNm', 'ben.abbott@yoobee.ac.nz', 'user', '2015-06-15 02:46:53', 'disabled'),
(7, 'iambatman', '$2y$10$Hd8Azz60VmyyrebrmcYL.Okd.Hpp4qw0Shh1WM0gDgL4Y.rffw./y', 'ben.abbott@yoobee.ac.nzz', 'user', '2015-06-18 03:13:58', 'enabled');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
 ADD PRIMARY KEY (`ID`);

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
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
MODIFY `ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `ID` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
