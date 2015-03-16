-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Mar 16, 2015 at 09:07 PM
-- Server version: 5.5.38-log
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `EPL_KIT_DB`
--
CREATE DATABASE IF NOT EXISTS `EPL_KIT_DB` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `EPL_KIT_DB`;

-- --------------------------------------------------------

--
-- Table structure for table `Booking`
--

DROP TABLE IF EXISTS `Booking`;
CREATE TABLE `Booking` (
`ID` int(11) NOT NULL,
  `KitID` int(11) NOT NULL,
  `ForBranch` int(11) NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `ShadowStartDate` datetime NOT NULL,
  `ShadowEndDate` datetime NOT NULL,
  `Purpose` tinytext,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `Booking`
--

TRUNCATE TABLE `Booking`;
--
-- Dumping data for table `Booking`
--

INSERT INTO `Booking` (`ID`, `KitID`, `ForBranch`, `StartDate`, `EndDate`, `ShadowStartDate`, `ShadowEndDate`, `Purpose`, `updated_at`, `created_at`) VALUES
(14, 10, 3, '2015-03-18 00:00:00', '2015-03-21 00:00:00', '2015-03-17 00:00:00', '2015-03-22 00:00:00', 'aaa', '2015-03-02 17:59:56', '2015-03-02 17:59:56'),
(15, 16, 3, '2015-03-05 00:00:00', '2015-03-09 00:00:00', '2015-03-04 00:00:00', '2015-03-10 00:00:00', 'Kit #3', '2015-03-02 18:07:06', '2015-03-02 18:07:06'),
(16, 16, 3, '2015-03-27 00:00:00', '2015-03-30 00:00:00', '2015-03-26 00:00:00', '2015-03-31 00:00:00', 'Kit #3', '2015-03-02 18:13:10', '2015-03-02 18:13:10'),
(17, 2, 3, '2015-03-12 00:00:00', '2015-03-13 00:00:00', '2015-03-11 00:00:00', '2015-03-14 00:00:00', 'Kit #2', '2015-03-02 18:19:51', '2015-03-02 18:19:51'),
(18, 16, 3, '2015-03-19 00:00:00', '2015-03-20 00:00:00', '2015-03-18 00:00:00', '2015-03-21 00:00:00', 'Kit #3', '2015-03-02 19:38:49', '2015-03-02 19:38:49'),
(19, 1, 3, '2015-03-13 00:00:00', '2015-03-20 00:00:00', '2015-03-10 00:00:00', '2015-03-21 00:00:00', 'Kit #1 + ESL Tutor', '2015-03-02 19:42:29', '2015-03-02 19:42:29'),
(21, 10, 0, '2015-03-05 00:00:00', '2015-03-06 00:00:00', '2015-03-04 00:00:00', '2015-03-07 00:00:00', 'aaa', '2015-03-11 20:02:37', '2015-03-11 20:02:37'),
(23, 10, 0, '2015-03-14 00:00:00', '2015-03-15 00:00:00', '2015-03-13 00:00:00', '2015-03-16 00:00:00', 'aaa', '2015-03-15 13:46:42', '2015-03-15 13:46:42'),
(25, 13, 3, '2015-03-16 00:00:00', '2015-03-18 00:00:00', '2015-03-13 00:00:00', '2015-03-19 00:00:00', 'testing', '2015-03-15 13:46:42', '2015-03-15 13:46:42'),
(26, 36, 0, '2015-03-16 00:00:00', '2015-03-18 00:00:00', '2015-03-13 00:00:00', '2015-03-19 00:00:00', 'leaving', '2015-03-15 13:46:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `BookingDetails`
--

DROP TABLE IF EXISTS `BookingDetails`;
CREATE TABLE `BookingDetails` (
`ID` int(11) NOT NULL,
  `BookingID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Email` tinytext,
  `Booker` tinyint(1) NOT NULL DEFAULT '1',
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `BookingDetails`
--

TRUNCATE TABLE `BookingDetails`;
--
-- Dumping data for table `BookingDetails`
--

INSERT INTO `BookingDetails` (`ID`, `BookingID`, `UserID`, `Email`, `Booker`, `updated_at`, `created_at`) VALUES
(2, 14, 1, NULL, 1, '2015-03-02 17:59:56', '2015-03-02 17:59:56'),
(3, 15, 1, NULL, 1, '2015-03-02 18:07:06', '2015-03-02 18:07:06'),
(4, 16, 1, NULL, 1, '2015-03-02 18:13:10', '2015-03-02 18:13:10'),
(5, 17, 1, NULL, 1, '2015-03-02 18:19:51', '2015-03-02 18:19:51'),
(6, 18, 1, NULL, 1, '2015-03-02 19:38:49', '2015-03-02 19:38:49'),
(7, 19, 1, NULL, 1, '2015-03-02 19:42:29', '2015-03-02 19:42:29'),
(8, 21, 1, NULL, 1, '2015-03-11 20:02:37', '2015-03-11 20:02:37'),
(9, 23, 1, NULL, 1, '2015-03-15 13:46:42', '2015-03-15 13:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `Branches`
--

DROP TABLE IF EXISTS `Branches`;
CREATE TABLE `Branches` (
`ID` int(11) NOT NULL,
  `BranchMangerID` int(11) NOT NULL,
  `BranchID` varchar(45) NOT NULL,
  `Name` tinytext NOT NULL,
  `EPLAddress` tinytext NOT NULL,
  `PhoneNumber` tinytext NOT NULL,
  `Latitude` float NOT NULL,
  `LONGitude` float NOT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `Branches`
--

TRUNCATE TABLE `Branches`;
--
-- Dumping data for table `Branches`
--

INSERT INTO `Branches` (`ID`, `BranchMangerID`, `BranchID`, `Name`, `EPLAddress`, `PhoneNumber`, `Latitude`, `LONGitude`, `updated_at`, `created_at`) VALUES
(0, 0, 'MNA-IT', 'Cenetral Depot', '7 Sir Winston Churchill Square, T5J 2V4', '000-000-0000', 53.5432, -113.49, NULL, NULL),
(1, 0, 'ABB', 'Abbottsfield - Penny McKee Branch', '3410 - 118 Avenue  T5W 0Z4', '780-496-7839', 53.5704, -113.392, '', ''),
(2, 0, 'CAL', 'Calder Branch', '12522 - 132 Avenue, T5L 3P9', '780-496-7090', 53.5922, -113.539, '', ''),
(3, 0, 'CPL', 'Capilano Branch', '201 Capilano Mall, 5004 - 98 Avenue,T6A 0A1', '780-496-1802', 53.5379, -113.42, '', ''),
(4, 0, 'CSD', 'Castle Downs Branch', '106 Lakeside Landing, 15379 Castle Downs Rd, T5X 3Y7', '780-496-1804', 53.6157, -113.517, '', ''),
(5, 0, 'CLV', 'Clareview Branch', '3808 - 139 Avenue, T5Y 3E7', '780-442-7471', 53.6013, -113.402, '', ''),
(6, 0, 'HIG', 'Highlands Branch', '6710 - 118 Avenue, T5B 0P3', '780-496-1806', 53.5706, -113.445, '', ''),
(7, 0, 'IDY', 'Idylwylde Branch', '8310 88 Avenue, T6C 1L1', '780-496-1808', 53.5235, -113.459, '', ''),
(8, 0, 'JPL', 'Jasper Place Branch', '9010 - 156 Street, T5R 5X7', '780-496-1810', 53.5232, -113.59, '', ''),
(9, 0, 'LHL', 'Lois Hole Library', '17650 69 Avenue, T5T 3X9', '780-442-0888', 53.5038, -113.626, '', ''),
(10, 0, 'LON', 'Londonderry Branch', '110 Londonderry Mall, 137 Avenue &amp; 66 Street, T5C 3C8', '780-496-1814', 53.6034, -113.446, '', ''),
(11, 0, 'GMU', 'MacEwan University Lending Machine', '10700 - 104 Avenue, T5J 4S2', ' ', 53.5467, -113.505, '', ''),
(12, 0, 'MEA', 'Meadows Branch', '2704 - 17 Street, T6T 0X1', '780-442-7472', 53.469, -113.369, '', ''),
(13, 0, 'MLW', 'Mill Woods Branch', '601 Mill Woods Town Centre, 2331 - 66 Street, T6K 4B5', '780-496-1818', 53.4554, -113.434, '', ''),
(14, 0, 'RIV', 'Riverbend Branch', '460 Riverbend Square, Rabbit Hill Road &amp; Terwillegar Drive, T6R 2X2', '780-944-5311', 53.4684, -113.584, '', ''),
(15, 0, 'SPW', 'Sprucewood Branch', '11555 - 95 Street, T5G 1L5', '780-496-7099', 53.5667, -113.487, '', ''),
(16, 0, 'MNA', 'Stanley A. Milner Library (Downtown)', '7 Sir Winston Churchill Square, T5J 2V4', '780-496-7000', 53.5432, -113.49, '', ''),
(17, 0, 'STR', 'Strathcona Branch', '8331 - 104 Street, T6E 4E9', '780-496-1828', 53.5195, -113.497, '', ''),
(18, 0, 'WMC', 'Whitemud Crossing Branch', '145 Whitemud Crossing Shopping Centre, 4211 - 106 Street, T6J 6L7', '780-496-1822', 53.4795, -113.504, '', ''),
(19, 0, 'WOO', 'Woodcroft Branch', '13420 - 114 Avenue, T5M 2Y5', '780-496-1830', 53.5638, -113.554, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `KitContents`
--

DROP TABLE IF EXISTS `KitContents`;
CREATE TABLE `KitContents` (
`ID` int(11) NOT NULL,
  `KitID` int(11) NOT NULL,
  `Name` tinytext NOT NULL,
  `SerialNumber` tinytext,
  `Damaged` tinyint(1) NOT NULL DEFAULT '0',
  `Missing` tinyint(1) NOT NULL DEFAULT '0',
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `KitContents`
--

TRUNCATE TABLE `KitContents`;
--
-- Dumping data for table `KitContents`
--

INSERT INTO `KitContents` (`ID`, `KitID`, `Name`, `SerialNumber`, `Damaged`, `Missing`, `updated_at`, `created_at`) VALUES
(1, 1, 'Ipad #1', '1111', 0, 0, NULL, NULL),
(2, 1, 'Ipad #2', '2222', 0, 0, NULL, NULL),
(3, 1, 'Ipad #3', '3333', 0, 0, '', NULL),
(4, 1, 'Ipad #4', '4444', 0, 0, NULL, NULL),
(5, 1, 'Ipad #5', '5555', 0, 0, NULL, NULL),
(6, 1, 'Ipad #6', '6666', 0, 0, NULL, NULL),
(7, 1, '6x Power cables', 'na', 0, 0, NULL, NULL),
(8, 1, '6x Ipad power bricks', 'ns', 0, 0, NULL, NULL),
(9, 1, '8-slot powerbar', 'ns', 0, 0, NULL, NULL),
(10, 1, '6x magnetic ipad covers', 'na', 0, 0, NULL, NULL),
(11, 2, 'Ipad #1s', '11111', 0, 0, '2015-03-06 21:04:09', NULL),
(12, 2, 'Ipad #2', '22222', 0, 0, NULL, NULL),
(13, 2, 'Ipad #3', '33333', 0, 0, NULL, NULL),
(14, 2, 'Ipad #4', '44444', 0, 0, NULL, NULL),
(15, 2, 'Ipad #5', '55555', 1, 0, NULL, NULL),
(16, 2, 'Ipad #6', '66666', 0, 1, NULL, NULL),
(17, 2, '6x Power cables', 'na', 1, 0, NULL, NULL),
(18, 2, '6x power Bricks', 'na', 1, 0, NULL, NULL),
(19, 2, '8-slot power bar', 'na', 0, 0, NULL, NULL),
(20, 2, '6x magnetic ipad covers', 'na', 1, 1, NULL, NULL),
(21, 3, 'Laptop #1', 'aaaa', 0, 0, NULL, NULL),
(22, 3, 'Laptop #2', 'bbbb', 0, 0, NULL, NULL),
(23, 3, 'Laptop #3', 'cccc', 0, 0, NULL, NULL),
(24, 3, 'Laptop #4', 'dddd', 0, 0, NULL, NULL),
(25, 3, 'Laptop #5', 'eeee', 0, 0, NULL, NULL),
(26, 3, 'Laptop #6', 'ffff', 1, 0, NULL, NULL),
(27, 3, '6x Power bricks', 'na', 0, 0, NULL, NULL),
(28, 3, '8-slot power bar', 'na', 0, 0, NULL, NULL),
(109, 2, 'new item', 'new asset number', 0, 0, '2015-03-06 18:55:39', '2015-03-06 18:55:39'),
(110, 36, 'new item', 'new asset number', 1, 1, '2015-03-06 19:35:30', '2015-03-06 19:09:07'),
(111, 36, 'blaa', '111', 0, 0, '2015-03-06 19:35:30', '2015-03-06 19:10:48'),
(113, 36, 'this is something new', '111222', 1, 0, '2015-03-06 19:38:08', '2015-03-06 19:38:08');

-- --------------------------------------------------------

--
-- Table structure for table `Kits`
--

DROP TABLE IF EXISTS `Kits`;
CREATE TABLE `Kits` (
`ID` int(11) NOT NULL,
  `KitType` int(11) NOT NULL,
  `Name` tinytext NOT NULL,
  `AtBranch` int(11) NOT NULL,
  `Available` tinyint(1) NOT NULL DEFAULT '1',
  `KitState` int(11) NOT NULL,
  `KitDesc` text NOT NULL,
  `BarcodeNumber` varchar(45) NOT NULL DEFAULT '31221',
  `Specialized` tinyint(1) NOT NULL DEFAULT '0',
  `SpecializedName` tinytext,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `Kits`
--

TRUNCATE TABLE `Kits`;
--
-- Dumping data for table `Kits`
--

INSERT INTO `Kits` (`ID`, `KitType`, `Name`, `AtBranch`, `Available`, `KitState`, `KitDesc`, `BarcodeNumber`, `Specialized`, `SpecializedName`, `updated_at`, `created_at`) VALUES
(1, 1, 'Kit #1', 1, 1, 1, 'A kit of 6 ipad 2''s with ESL programs', '31221', 1, 'ESL Tutor', '2015-03-01 12:30:10', '2015-03-01 12:30:10'),
(2, 1, 'Kit #2 the best', 3, 1, 2, 'A Kit of 6 Ipad ''2ss', '31221', 0, '', '2015-03-06 21:04:05', '2015-03-01 12:30:10'),
(3, 2, 'Kit #1', 3, 1, 1, '6Laptops with 15" screens', '31221', 0, NULL, '2015-03-01 12:30:10', '2015-03-01 12:30:10'),
(10, 3, 'aaa', 0, 0, 1, 'Place a description of the contents of this kit here. ', '31221678901234', 0, NULL, '2015-03-01 13:17:51', '2015-02-28 17:33:51'),
(12, 2, 'Kit # 1234', 7, 1, 1, 'This is the alst Frigging kit i am going to make, what are they doing with them? feeding them to germelins in the stacks?', '31221', 1, 'laced with cyanide. ', '2015-03-01 13:59:09', '2015-02-28 17:39:31'),
(13, 2, 'HP Lap', 7, 1, 2, 'This is a sample lap for testing laptops. ', '31221', 1, 'aa', '2015-03-01 14:09:02', '2015-02-28 17:40:49'),
(16, 1, 'Kit #3 ', 0, 1, 1, 'eight Ipad 2 second generation. ', '31221', 0, '', '2015-03-06 21:20:27', '2015-03-01 14:14:21'),
(36, 1, 'Ipad Pro', 3, 1, 1, 'this is the descriptiona', '31221', 1, 'EASL', '2015-03-06 19:38:08', '2015-03-01 15:02:12'),
(47, 1, 'What am i thinking?', 0, 0, 1, 'Place a description of the contents of this kit here. ', '31221', 0, '', '2015-03-06 21:26:59', '2015-03-06 21:26:45'),
(54, 2, 'foo', 3, 0, 1, 'This is a FUBAR kit. Do not use!', '31221', 1, 'bar', '2015-03-06 22:09:30', '2015-03-06 21:35:46'),
(55, 9, 'New Kit Name', 3, 0, 1, 'Place a description of the contents of this kit here. ', '31221', 0, '', '2015-03-07 01:33:15', '2015-03-07 01:33:07');

-- --------------------------------------------------------

--
-- Table structure for table `KitState`
--

DROP TABLE IF EXISTS `KitState`;
CREATE TABLE `KitState` (
`ID` int(11) NOT NULL,
  `StateName` tinytext,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `KitState`
--

TRUNCATE TABLE `KitState`;
--
-- Dumping data for table `KitState`
--

INSERT INTO `KitState` (`ID`, `StateName`, `updated_at`, `created_at`) VALUES
(1, 'At Branch', NULL, NULL),
(2, 'InTransit', NULL, NULL),
(3, 'Unavailable', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `KitTypes`
--

DROP TABLE IF EXISTS `KitTypes`;
CREATE TABLE `KitTypes` (
`ID` int(11) NOT NULL,
  `Name` tinytext NOT NULL,
  `TypeDescription` text,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `KitTypes`
--

TRUNCATE TABLE `KitTypes`;
--
-- Dumping data for table `KitTypes`
--

INSERT INTO `KitTypes` (`ID`, `Name`, `TypeDescription`, `updated_at`, `created_at`) VALUES
(0, '** Undefined **', NULL, NULL, NULL),
(1, 'Ipad 2', 'These are Ipad 2 with 64gb storage', NULL, NULL),
(2, 'HP Laptops', 'This is a pack of HP laptops that are mostly working with some bugs. \r\n', '2015-03-07 00:28:01', NULL),
(3, 'Ipad Mini', 'this is a test', '2015-03-07 00:20:01', NULL),
(4, 'newType', '', '2015-03-07 01:00:25', '2015-03-07 01:00:25'),
(5, 'newType', '', '2015-03-07 01:00:44', '2015-03-07 01:00:44'),
(9, 'this is a thing', 'what is this thing>?', '2015-03-07 01:04:34', '2015-03-07 01:04:23');

-- --------------------------------------------------------

--
-- Table structure for table `Logs`
--

DROP TABLE IF EXISTS `Logs`;
CREATE TABLE `Logs` (
`ID` int(11) NOT NULL,
  `LogDate` datetime NOT NULL,
  `LogType` int(11) NOT NULL,
  `LogKey1` int(11) NOT NULL,
  `LogKey2` int(11) DEFAULT NULL,
  `LogKey3` int(11) DEFAULT NULL,
  `LogUserID` int(11) NOT NULL,
  `LogMessage` text NOT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=329 DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `Logs`
--

TRUNCATE TABLE `Logs`;
--
-- Dumping data for table `Logs`
--

INSERT INTO `Logs` (`ID`, `LogDate`, `LogType`, `LogKey1`, `LogKey2`, `LogKey3`, `LogUserID`, `LogMessage`, `updated_at`, `created_at`) VALUES
(287, '2015-03-06 00:00:00', 5, 2, 54, NULL, 1, 'Changed Kit field: KitType From:0 To:2', '2015-03-06 22:09:30', '2015-03-06 22:09:30'),
(288, '2015-03-07 00:00:00', 19, 3, NULL, NULL, 1, 'TypeDescription changed From: To:this is a test', '2015-03-07 00:20:01', '2015-03-07 00:20:01'),
(289, '2015-03-07 00:00:00', 19, 2, NULL, NULL, 1, 'Name changed From:HP Laptop To:foobar', '2015-03-07 00:21:47', '2015-03-07 00:21:47'),
(290, '2015-03-07 00:00:00', 19, 2, NULL, NULL, 1, 'Name changed From:foobar To:HP Laptop', '2015-03-07 00:22:57', '2015-03-07 00:22:57'),
(291, '2015-03-07 00:00:00', 19, 2, NULL, NULL, 1, 'Name changed From:HP Laptop To:blaa', '2015-03-07 00:27:24', '2015-03-07 00:27:24'),
(292, '2015-03-07 00:00:00', 19, 2, NULL, NULL, 1, 'TypeDescription changed From: To:this sia a comment', '2015-03-07 00:27:24', '2015-03-07 00:27:24'),
(293, '2015-03-07 00:00:00', 19, 2, NULL, NULL, 1, 'Name changed From:blaa To:HP Laptops', '2015-03-07 00:28:01', '2015-03-07 00:28:01'),
(294, '2015-03-07 00:00:00', 19, 2, NULL, NULL, 1, 'TypeDescription changed From:this sia a comment To:This is a pack of HP laptops that are mostly working with some bugs. \r\n', '2015-03-07 00:28:01', '2015-03-07 00:28:01'),
(295, '2015-03-07 00:00:00', 7, 4, NULL, NULL, 1, 'Type Created', '2015-03-07 01:00:25', '2015-03-07 01:00:25'),
(303, '2015-03-07 00:00:00', 20, 7, NULL, NULL, 1, 'Kit type deleted by:user', '2015-03-07 01:32:19', '2015-03-07 01:32:19'),
(304, '2015-03-07 00:00:00', 20, 8, NULL, NULL, 1, 'Kit type deleted by:user', '2015-03-07 01:32:27', '2015-03-07 01:32:27'),
(305, '2015-03-07 00:00:00', 4, 0, 55, NULL, 1, 'Created Kit: New Kit Name', '2015-03-07 01:33:07', '2015-03-07 01:33:07'),
(308, '2015-03-07 00:00:00', 12, 9, 55, 116, 1, 'Removed Contents: new item', '2015-03-07 01:33:26', '2015-03-07 01:33:26'),
(311, '2015-03-07 00:00:00', 4, 0, 56, NULL, 1, 'Created Kit: New Kit Name', '2015-03-07 01:34:16', '2015-03-07 01:34:16'),
(318, '2015-03-07 00:00:00', 4, 0, 57, NULL, 1, 'Created Kit: New Kit Name', '2015-03-07 01:42:08', '2015-03-07 01:42:08'),
(325, '2015-03-07 00:00:00', 14, 6, 57, 3, 1, 'Booking Deleted by:user', '2015-03-07 01:45:06', '2015-03-07 01:45:06'),
(326, '2015-03-07 00:00:00', 6, 6, 57, NULL, 1, 'Deleted Kit: walla', '2015-03-07 01:45:07', '2015-03-07 01:45:07'),
(327, '2015-03-07 00:00:00', 20, 6, NULL, NULL, 1, 'Kit type deleted by:user', '2015-03-07 01:45:07', '2015-03-07 01:45:07'),
(328, '2015-03-15 00:00:00', 13, 3, 10, NULL, 1, 'Booking for:MNA-IT from:2015-03-14 To:Invalid date', '2015-03-15 13:46:42', '2015-03-15 13:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `LogType`
--

DROP TABLE IF EXISTS `LogType`;
CREATE TABLE `LogType` (
`ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `LogType`
--

TRUNCATE TABLE `LogType`;
--
-- Dumping data for table `LogType`
--

INSERT INTO `LogType` (`ID`, `Name`, `updated_at`, `created_at`) VALUES
(1, 'Damage Report', NULL, NULL),
(2, 'Missing Report', NULL, NULL),
(3, 'Note', NULL, NULL),
(4, 'Kit Created', NULL, NULL),
(5, 'Kit Edit', NULL, NULL),
(6, 'Kit Deleted', NULL, NULL),
(7, 'Kit Type Created', NULL, NULL),
(8, 'Kit Type Edited', NULL, NULL),
(9, 'Kit Type Deleted', NULL, NULL),
(10, 'Kit Contents added', NULL, NULL),
(11, 'Kit Contents Editied', NULL, NULL),
(12, 'Kit Contents Removed', NULL, NULL),
(13, 'Booking Request', NULL, NULL),
(14, 'Booking Canceled', NULL, NULL),
(15, 'Booking Edited', NULL, NULL),
(16, 'Kit Transfer Shipped', NULL, NULL),
(17, 'Kit Transfer Received', NULL, NULL),
(18, 'Booking detail added', NULL, NULL),
(19, 'Booking detail edit', NULL, NULL),
(20, 'Booking detail deleted', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Settings`
--

DROP TABLE IF EXISTS `Settings`;
CREATE TABLE `Settings` (
`ID` int(11) NOT NULL,
  `Key` varchar(45) NOT NULL,
  `Value` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `Settings`
--

TRUNCATE TABLE `Settings`;
--
-- Dumping data for table `Settings`
--

INSERT INTO `Settings` (`ID`, `Key`, `Value`) VALUES
(1, 'HomeLink', '/'),
(2, 'ShadowDays', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
`id` int(11) NOT NULL,
  `username` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `realname` tinytext NOT NULL,
  `email` tinytext,
  `home_branch` int(11) DEFAULT '0',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` text,
  `updated_at` tinytext NOT NULL,
  `created_at` tinytext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `realname`, `email`, `home_branch`, `is_admin`, `remember_token`, `updated_at`, `created_at`) VALUES
(1, 'user', '$2y$10$yKhkFzxkvhrgMY7DCXCdAOA2lNIIMDEYw4qnKCTxnpPXplZV7KzgG', 'User', NULL, 3, 1, NULL, '', ''),
(2, 'user2', '$2y$10$yKhkFzxkvhrgMY7DCXCdAOA2lNIIMDEYw4qnKCTxnpPXplZV7KzgG', 'User 2', '', 0, 0, NULL, '2015-03-09 19:30:23', ''),
(3, 'user3', '$2y$10$yKhkFzxkvhrgMY7DCXCdAOA2lNIIMDEYw4qnKCTxnpPXplZV7KzgG', 'Users 3', 'adadaa', 0, 0, NULL, '2015-03-09 23:01:42', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Booking`
--
ALTER TABLE `Booking`
 ADD PRIMARY KEY (`ID`), ADD KEY `Kit_idx` (`KitID`), ADD KEY `Booking_Branch_idx` (`ForBranch`);

--
-- Indexes for table `BookingDetails`
--
ALTER TABLE `BookingDetails`
 ADD PRIMARY KEY (`ID`), ADD KEY `BookingDetails_Booking_idx` (`BookingID`);

--
-- Indexes for table `Branches`
--
ALTER TABLE `Branches`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `KitContents`
--
ALTER TABLE `KitContents`
 ADD PRIMARY KEY (`ID`), ADD KEY `Kit_idx` (`KitID`);

--
-- Indexes for table `Kits`
--
ALTER TABLE `Kits`
 ADD PRIMARY KEY (`ID`), ADD KEY `KitType_idx` (`KitType`), ADD KEY `Kits_Branch_idx` (`AtBranch`), ADD KEY `Kits_KitState_idx` (`KitState`);

--
-- Indexes for table `KitState`
--
ALTER TABLE `KitState`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `KitTypes`
--
ALTER TABLE `KitTypes`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Logs`
--
ALTER TABLE `Logs`
 ADD PRIMARY KEY (`ID`), ADD KEY `Logs_users_idx` (`LogUserID`), ADD KEY `Logs_LogType_idx` (`LogType`), ADD KEY `Logs_Type_Keys_idx` (`LogType`,`LogKey1`,`LogKey2`,`LogKey3`);

--
-- Indexes for table `LogType`
--
ALTER TABLE `LogType`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Settings`
--
ALTER TABLE `Settings`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD KEY `user-home_branch_idx` (`home_branch`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Booking`
--
ALTER TABLE `Booking`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `BookingDetails`
--
ALTER TABLE `BookingDetails`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `Branches`
--
ALTER TABLE `Branches`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `KitContents`
--
ALTER TABLE `KitContents`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `Kits`
--
ALTER TABLE `Kits`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `KitState`
--
ALTER TABLE `KitState`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `KitTypes`
--
ALTER TABLE `KitTypes`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `Logs`
--
ALTER TABLE `Logs`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=329;
--
-- AUTO_INCREMENT for table `LogType`
--
ALTER TABLE `LogType`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `Settings`
--
ALTER TABLE `Settings`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Booking`
--
ALTER TABLE `Booking`
ADD CONSTRAINT `Booking_Branch` FOREIGN KEY (`ForBranch`) REFERENCES `Branches` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `Booking_Kit` FOREIGN KEY (`KitID`) REFERENCES `Kits` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `BookingDetails`
--
ALTER TABLE `BookingDetails`
ADD CONSTRAINT `BookingDetails_Booking` FOREIGN KEY (`BookingID`) REFERENCES `Booking` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `KitContents`
--
ALTER TABLE `KitContents`
ADD CONSTRAINT `KitContents_Kit` FOREIGN KEY (`KitID`) REFERENCES `Kits` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Kits`
--
ALTER TABLE `Kits`
ADD CONSTRAINT `Kits_Branch` FOREIGN KEY (`AtBranch`) REFERENCES `Branches` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `Kits_KitState` FOREIGN KEY (`KitState`) REFERENCES `KitState` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `Kits_KitType` FOREIGN KEY (`KitType`) REFERENCES `KitTypes` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Logs`
--
ALTER TABLE `Logs`
ADD CONSTRAINT `Logs_LogType` FOREIGN KEY (`LogType`) REFERENCES `LogType` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `Logs_users` FOREIGN KEY (`LogUserID`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `user-home_branch` FOREIGN KEY (`home_branch`) REFERENCES `Branches` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
