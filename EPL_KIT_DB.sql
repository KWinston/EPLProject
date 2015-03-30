-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Mar 30, 2015 at 10:59 AM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `EPL_KIT_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Booking`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Booking`
--

INSERT INTO `Booking` (`ID`, `KitID`, `ForBranch`, `StartDate`, `EndDate`, `ShadowStartDate`, `ShadowEndDate`, `Purpose`, `updated_at`, `created_at`) VALUES
(14, 2, 3, '2015-03-18 00:00:00', '2015-03-21 00:00:00', '2015-03-17 00:00:00', '2015-03-22 00:00:00', 'aaa', '2015-03-02 17:59:56', '2015-03-02 17:59:56'),
(15, 16, 3, '2015-03-05 00:00:00', '2015-03-09 00:00:00', '2015-03-04 00:00:00', '2015-03-10 00:00:00', 'Kit #3', '2015-03-02 18:07:06', '2015-03-02 18:07:06'),
(17, 2, 3, '2015-03-12 00:00:00', '2015-03-13 00:00:00', '2015-03-11 00:00:00', '2015-03-14 00:00:00', 'Kit #2', '2015-03-02 18:19:51', '2015-03-02 18:19:51'),
(18, 16, 3, '2015-03-19 00:00:00', '2015-03-20 00:00:00', '2015-03-18 00:00:00', '2015-03-21 00:00:00', 'Kit #3', '2015-03-02 19:38:49', '2015-03-02 19:38:49'),
(19, 1, 3, '2015-03-13 00:00:00', '2015-03-20 00:00:00', '2015-03-10 00:00:00', '2015-03-21 00:00:00', 'Kit #1 + ESL Tutor', '2015-03-02 19:42:29', '2015-03-02 19:42:29'),
(21, 2, 0, '2015-03-05 00:00:00', '2015-03-06 00:00:00', '2015-03-04 00:00:00', '2015-03-07 00:00:00', 'aaa', '2015-03-11 20:02:37', '2015-03-11 20:02:37'),
(25, 13, 3, '2015-03-16 00:00:00', '2015-03-18 00:00:00', '2015-03-13 00:00:00', '2015-03-19 00:00:00', 'testing', '2015-03-15 13:46:42', '2015-03-15 13:46:42'),
(26, 36, 0, '2015-03-16 00:00:00', '2015-03-18 00:00:00', '2015-03-13 00:00:00', '2015-03-19 00:00:00', 'leaving', '2015-03-15 13:46:42', NULL),
(32, 3, 13, '2015-03-27 00:00:00', '2015-03-30 00:00:00', '2015-03-26 00:00:00', '2015-03-31 00:00:00', 'Kit #1', '2015-03-26 03:25:56', '2015-03-26 03:25:56'),
(36, 57, 3, '2015-03-28 00:00:00', '2015-03-30 00:00:00', '2015-03-27 00:00:00', '2015-03-31 00:00:00', 'Arduino PARTY', '2015-03-30 04:43:33', '2015-03-30 04:43:33'),
(37, 1, 7, '2015-03-28 00:00:00', '2015-03-30 00:00:00', '2015-03-27 00:00:00', '2015-03-31 00:00:00', 'IPAD Weather Party', '2015-03-30 04:45:33', '2015-03-30 04:45:33'),
(38, 55, 9, '2015-03-28 00:00:00', '2015-03-30 00:00:00', '2015-03-27 00:00:00', '2015-03-31 00:00:00', 'LEGO MINDU STORMU', '2015-03-30 04:46:11', '2015-03-30 04:46:11'),
(39, 2, 2, '2015-03-28 00:00:00', '2015-03-30 00:00:00', '2015-03-27 00:00:00', '2015-03-31 00:00:00', 'Creator''s Corner Meeting', '2015-03-30 04:48:23', '2015-03-30 04:48:23'),
(40, 36, 3, '2015-03-28 00:00:00', '2015-04-08 00:00:00', '2015-03-27 00:00:00', '2015-04-09 00:00:00', 'Earth Science Event', '2015-03-30 04:50:29', '2015-03-30 04:50:29'),
(41, 36, 3, '2015-03-28 00:00:00', '2015-04-03 00:00:00', '2015-03-27 00:00:00', '2015-04-04 00:00:00', 'Earth Science Party', '2015-03-30 04:51:18', '2015-03-30 04:51:18'),
(42, 16, 8, '2015-03-28 00:00:00', '2015-03-30 00:00:00', '2015-03-27 00:00:00', '2015-03-31 00:00:00', 'Card Collector Meeting', '2015-03-30 04:56:23', '2015-03-30 04:56:23'),
(43, 56, 3, '2015-03-28 00:00:00', '2015-03-30 00:00:00', '2015-03-27 00:00:00', '2015-03-31 00:00:00', 'Flask networking with Pi', '2015-03-30 04:59:46', '2015-03-30 04:59:46');

-- --------------------------------------------------------

--
-- Table structure for table `BookingDetails`
--

CREATE TABLE `BookingDetails` (
`ID` int(11) NOT NULL,
  `BookingID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Email` tinytext,
  `Booker` tinyint(1) NOT NULL DEFAULT '1',
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `BookingDetails`
--

INSERT INTO `BookingDetails` (`ID`, `BookingID`, `UserID`, `Email`, `Booker`, `updated_at`, `created_at`) VALUES
(2, 14, 1, NULL, 1, '2015-03-02 17:59:56', '2015-03-02 17:59:56'),
(3, 15, 1, NULL, 1, '2015-03-02 18:07:06', '2015-03-02 18:07:06'),
(5, 17, 1, NULL, 1, '2015-03-02 18:19:51', '2015-03-02 18:19:51'),
(6, 18, 1, NULL, 1, '2015-03-02 19:38:49', '2015-03-02 19:38:49'),
(7, 19, 1, NULL, 1, '2015-03-02 19:42:29', '2015-03-02 19:42:29'),
(8, 21, 1, NULL, 1, '2015-03-11 20:02:37', '2015-03-11 20:02:37'),
(10, 17, 2, NULL, 0, '2015-03-15 13:46:42', '2015-03-15 13:46:42'),
(11, 17, NULL, 'A.External.User@someotherplace.com', 0, '2015-03-15 13:46:42', '2015-03-15 13:46:42'),
(12, 32, 1, 'Auser.Name@someplace.com', 1, '2015-03-26 03:25:56', '2015-03-26 03:25:56'),
(23, 32, NULL, 'suspicious@user.com', 0, '2015-03-26 04:19:01', '2015-03-26 04:19:01'),
(24, 32, NULL, 'ogre@club.com', 0, '2015-03-26 04:19:01', '2015-03-26 04:19:01'),
(27, 36, 1, 'Auser.Name@someplace.com', 1, '2015-03-30 04:43:33', '2015-03-30 04:43:33'),
(28, 37, 1, 'Auser.Name@someplace.com', 1, '2015-03-30 04:45:33', '2015-03-30 04:45:33'),
(29, 38, 1, 'Auser.Name@someplace.com', 1, '2015-03-30 04:46:11', '2015-03-30 04:46:11'),
(30, 39, 1, 'Auser.Name@someplace.com', 1, '2015-03-30 04:48:23', '2015-03-30 04:48:23'),
(31, 40, 1, 'Auser.Name@someplace.com', 1, '2015-03-30 04:50:29', '2015-03-30 04:50:29'),
(32, 41, 1, 'Auser.Name@someplace.com', 1, '2015-03-30 04:51:18', '2015-03-30 04:51:18'),
(33, 42, 1, 'Auser.Name@someplace.com', 1, '2015-03-30 04:56:23', '2015-03-30 04:56:23'),
(34, 43, 1, 'Auser.Name@someplace.com', 1, '2015-03-30 04:59:46', '2015-03-30 04:59:46');

-- --------------------------------------------------------

--
-- Table structure for table `Branches`
--

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

CREATE TABLE `KitContents` (
`ID` int(11) NOT NULL,
  `KitID` int(11) NOT NULL,
  `Name` tinytext NOT NULL,
  `SerialNumber` tinytext,
  `DamagedLogID` int(11) DEFAULT NULL,
  `MissingLogID` int(11) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `KitContents`
--

INSERT INTO `KitContents` (`ID`, `KitID`, `Name`, `SerialNumber`, `DamagedLogID`, `MissingLogID`, `updated_at`, `created_at`) VALUES
(1, 1, 'Ipad #1', '111101', 0, 0, '2015-03-30 04:28:19', NULL),
(2, 1, 'Ipad #2', '111102', 0, 0, '2015-03-30 04:28:19', NULL),
(3, 1, 'Ipad #3', '111103', 0, 0, '2015-03-30 04:28:19', NULL),
(4, 1, 'Ipad #4', '111104', 0, 0, '2015-03-30 04:28:19', NULL),
(5, 1, 'Ipad #5', '111105', 0, 0, '2015-03-30 04:28:19', NULL),
(6, 1, 'Ipad #6', '111106', 0, 0, '2015-03-30 04:28:19', NULL),
(7, 1, '6x Power cables', '111107', 0, 0, '2015-03-30 04:28:19', NULL),
(8, 1, '6x Ipad power bricks', '111108', 0, 0, '2015-03-30 04:28:19', NULL),
(9, 1, '8-slot powerbar', '111109', 0, 0, '2015-03-30 04:28:19', NULL),
(10, 1, '6x magnetic ipad covers', '111110', 0, 0, '2015-03-30 04:28:19', NULL),
(11, 2, 'Ipad 2 #1', '115111', 365, 361, '2015-03-30 04:30:22', NULL),
(12, 2, 'Ipad 2 #2', '115112', 371, 367, '2015-03-30 04:30:22', NULL),
(13, 2, 'Ipad 2 #3', '115113', 0, 0, '2015-03-30 04:30:22', NULL),
(14, 2, 'Ipad 2 #4', '115114', 0, 0, '2015-03-30 04:30:22', NULL),
(15, 2, 'Ipad 2 #5', '115115', 0, 0, '2015-03-30 04:30:22', NULL),
(16, 2, 'Ipad 2 #6', '115116', 0, 0, '2015-03-30 04:30:22', NULL),
(17, 2, '6x Power cables', '115117', 0, 0, '2015-03-30 04:30:22', NULL),
(18, 2, '6x power Bricks', '115118', 0, 0, '2015-03-30 04:30:22', NULL),
(19, 2, '8-slot power bar', '115119', 0, 0, '2015-03-30 04:30:22', NULL),
(21, 3, 'HP Laptop #1', '154611', 346, 342, '2015-03-30 04:37:24', NULL),
(22, 3, 'HP Laptop #2', '154612', 344, 0, '2015-03-30 04:37:24', NULL),
(23, 3, 'HP Laptop #3', '154613', 0, 0, '2015-03-30 04:37:24', NULL),
(24, 3, 'HP Laptop #4', '154614', 0, 0, '2015-03-30 04:37:24', NULL),
(25, 3, 'HP Laptop #5', '154615', 0, 0, '2015-03-30 04:37:24', NULL),
(26, 3, 'HP Laptop #6', '154616', 0, 0, '2015-03-30 04:37:24', NULL),
(27, 3, '6x Power bricks', '154617', 0, 0, '2015-03-30 04:37:24', NULL),
(28, 3, '8-slot power bar', '154618', 0, 0, '2015-03-30 04:37:24', NULL),
(110, 36, 'Ipad 2 2nd Gen #1 w/ EAW', '189001', 0, 0, '2015-03-30 04:27:22', '2015-03-06 19:09:07'),
(111, 36, 'Ipad 2 2nd Gen #2 w/ EAW', '189002', 0, 0, '2015-03-30 04:27:22', '2015-03-06 19:10:48'),
(113, 36, 'Ipad 3 2nd Gen #3 w/ EAW', '189003', 0, 0, '2015-03-30 04:27:22', '2015-03-06 19:38:08'),
(114, 55, 'Mindstorms NXT 2.0', '143022', 0, 0, '2015-03-30 04:24:15', '2015-03-30 04:13:57'),
(115, 56, 'Raspberry Pi #1', '164001', 0, 0, '2015-03-30 04:15:57', '2015-03-30 04:15:57'),
(116, 56, 'Raspberry Pi #2', '164002', 0, 0, '2015-03-30 04:15:57', '2015-03-30 04:15:57'),
(117, 56, 'Raspberry Pi #3', '164003', 0, 0, '2015-03-30 04:15:57', '2015-03-30 04:15:57'),
(118, 56, 'Raspberry Pi #4', '164004', 0, 0, '2015-03-30 04:15:57', '2015-03-30 04:15:57'),
(119, 47, 'Ipad Mini #1', '121000', 0, 0, '2015-03-30 04:17:23', '2015-03-30 04:17:23'),
(120, 47, 'Ipad Mini #2', '121001', 0, 0, '2015-03-30 04:17:23', '2015-03-30 04:17:23'),
(121, 47, 'Ipad Mini #3', '121002', 0, 0, '2015-03-30 04:17:23', '2015-03-30 04:17:23'),
(122, 47, 'Ipad Mini #4', '121003', 0, 0, '2015-03-30 04:17:23', '2015-03-30 04:17:23'),
(123, 47, 'Ipad Mini #5', '121004', 0, 0, '2015-03-30 04:17:23', '2015-03-30 04:17:23'),
(124, 10, 'Ipad Mini #1', '121105', 0, 0, '2015-03-30 04:19:24', '2015-03-30 04:19:24'),
(125, 10, 'Ipad Mini #2', '121106', 0, 0, '2015-03-30 04:19:24', '2015-03-30 04:19:24'),
(126, 10, 'Ipad Mini #3', '121107', 0, 0, '2015-03-30 04:19:24', '2015-03-30 04:19:24'),
(127, 10, 'Ipad Mini #4', '121108', 0, 0, '2015-03-30 04:19:24', '2015-03-30 04:19:24'),
(128, 57, 'Arduino UNO R3 #1', '185321', 0, 0, '2015-03-30 04:22:21', '2015-03-30 04:22:21'),
(129, 57, 'Arduino UNO R3 #2', '185322', 0, 0, '2015-03-30 04:22:21', '2015-03-30 04:22:21'),
(130, 57, 'Arduino UNO R3 #3', '185323', 0, 0, '2015-03-30 04:22:21', '2015-03-30 04:22:21'),
(131, 57, 'Arduino MEGA #1', '185324', 0, 0, '2015-03-30 04:22:21', '2015-03-30 04:22:21'),
(132, 57, 'Components Pack', '185325', 0, 0, '2015-03-30 04:22:21', '2015-03-30 04:22:21'),
(133, 57, 'BOE Shield', '185326', 0, 0, '2015-03-30 04:22:21', '2015-03-30 04:22:21'),
(134, 55, 'NXT Components Pkg', '143023', 0, 0, '2015-03-30 04:24:15', '2015-03-30 04:24:15'),
(135, 16, 'Ipad 2 2nd Gen #1', '152301', 0, 0, '2015-03-30 04:32:26', '2015-03-30 04:32:26'),
(136, 16, 'Ipad 2 2nd Gen #2', '152302', 0, 0, '2015-03-30 04:32:26', '2015-03-30 04:32:26'),
(137, 16, 'Ipad 2 2nd Gen #3', '152303', 0, 0, '2015-03-30 04:32:26', '2015-03-30 04:32:26'),
(138, 16, 'Ipad 2 2nd Gen #4', '152304', 0, 0, '2015-03-30 04:32:26', '2015-03-30 04:32:26'),
(139, 16, 'Ipad 2 2nd Gen #5', '152305', 0, 0, '2015-03-30 04:32:26', '2015-03-30 04:32:26'),
(140, 16, 'Ipad 2 2nd Gen #6', '152306', 0, 0, '2015-03-30 04:32:26', '2015-03-30 04:32:26'),
(141, 13, 'HP Laptop #1 w/ VW', '178021', 0, 0, '2015-03-30 04:35:40', '2015-03-30 04:35:40'),
(142, 13, 'HP Laptop #2 w/ VW', '178022', 0, 0, '2015-03-30 04:35:40', '2015-03-30 04:35:40'),
(143, 13, 'HP Laptop #3 w/ VW', '178023', 0, 0, '2015-03-30 04:35:40', '2015-03-30 04:35:40'),
(144, 13, 'HP Laptop #4 w/ VW', '178024', 0, 0, '2015-03-30 04:35:40', '2015-03-30 04:35:40'),
(145, 12, 'HP Laptop w/ MB #1', '151601', 0, 0, '2015-03-30 04:39:46', '2015-03-30 04:39:46'),
(146, 12, 'HP Laptop w/ MB #2', '151602', 0, 0, '2015-03-30 04:39:46', '2015-03-30 04:39:46'),
(147, 12, 'HP Laptop w/ MB #3', '151603', 0, 0, '2015-03-30 04:39:46', '2015-03-30 04:39:46'),
(148, 12, 'HP Laptop w/ MB #4', '151604', 0, 0, '2015-03-30 04:39:46', '2015-03-30 04:39:46'),
(149, 54, 'HP Laptop #1', '188801', 0, 0, '2015-03-30 04:41:30', '2015-03-30 04:41:30'),
(150, 54, 'HP Laptop #2', '188802', 0, 0, '2015-03-30 04:41:30', '2015-03-30 04:41:30'),
(151, 54, 'HP Laptop #3', '188803', 0, 0, '2015-03-30 04:41:30', '2015-03-30 04:41:30'),
(152, 54, 'HP Laptop #4', '188804', 0, 0, '2015-03-30 04:41:30', '2015-03-30 04:41:30'),
(153, 54, 'HP Laptop #5', '188805', 0, 0, '2015-03-30 04:41:30', '2015-03-30 04:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `Kits`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Kits`
--

INSERT INTO `Kits` (`ID`, `KitType`, `Name`, `AtBranch`, `Available`, `KitState`, `KitDesc`, `BarcodeNumber`, `Specialized`, `SpecializedName`, `updated_at`, `created_at`) VALUES
(1, 1, 'Kit #1', 1, 1, 1, 'A kit of 6 ipad 2''s with ESL programs installed.', '31221780699422', 1, 'ESL Tutor', '2015-03-30 04:28:32', '2015-03-01 12:30:10'),
(2, 1, 'Kit #2 The Best', 3, 1, 2, 'A Kit of 6 Ipad 2''s with accessories.', '31221555554444', 0, '', '2015-03-30 04:30:38', '2015-03-01 12:30:10'),
(3, 2, 'Laptop Kit #3', 9, 1, 2, '6 HP Laptops with 15" screens.', '31221123890555', 0, '', '2015-03-30 04:37:48', '2015-03-01 12:30:10'),
(10, 3, 'Ipad Mini Kit #2', 10, 0, 1, 'Ipad Mini Kit with 4 Ipads on latest iOS.', '31221678901234', 0, '', '2015-03-30 04:19:24', '2015-02-28 17:33:51'),
(12, 2, 'Laptop Kit #2', 7, 1, 1, 'Remember this old gem? A look into old software. Included are 4 HP Laptops with 15.6" Screens.', '31221333666999', 1, 'Mathblaster', '2015-03-30 04:39:46', '2015-02-28 17:39:31'),
(13, 2, 'Laptop Kit #1', 7, 1, 2, '4 HP Laptops installed with Physics Virtualware modules: Kinematics, Collisions, and Wave Theory.', '31221989000111', 1, 'Physics Virtualware', '2015-03-30 04:36:00', '2015-02-28 17:40:49'),
(16, 1, 'Kit #3 ', 3, 1, 1, 'Six Ipad 2 second generation. ', '31221847823111', 0, '', '2015-03-30 04:32:26', '2015-03-01 14:14:21'),
(36, 1, 'Foobar', 3, 1, 1, 'Made to break test the system.', '31221564322110', 1, 'EAW', '2015-03-30 04:55:39', '2015-03-01 15:02:12'),
(47, 3, 'Ipad Mini Kit #1', 2, 0, 1, '5 Ipad Mini''s installed with the latest iOS.', '31221342555612', 0, '', '2015-03-30 04:17:23', '2015-03-06 21:26:45'),
(54, 2, 'Laptop Kit #4', 3, 0, 1, 'HP Laptop Kit containing 5 HP Laptops.', '31221000011223', 0, 'bar', '2015-03-30 04:41:30', '2015-03-06 21:35:46'),
(55, 9, 'Lego Mindstorms NXT Kit #1', 3, 0, 2, 'Mindstorms Kit with extra components package.', '31221444555666', 0, '', '2015-03-30 04:46:48', '2015-03-07 01:33:07'),
(56, 5, 'Raspberry Pi Kit #1', 2, 0, 1, '4 Model B 512MB Raspberry Pis. Comes with 4x HDMI Cables and 4x Power supplies (800mA).', '31221810584321', 0, '', '2015-03-30 08:57:33', '2015-03-30 04:14:06'),
(57, 4, 'Arduino Kit #1', 3, 0, 1, 'Three Arduino UNO''s and an Arduino MEGA. Included is a components pack and a Board of Education Shield.', '31221668423111', 0, '', '2015-03-30 04:58:24', '2015-03-30 04:19:35');

-- --------------------------------------------------------

--
-- Table structure for table `KitState`
--

CREATE TABLE `KitState` (
`ID` int(11) NOT NULL,
  `StateName` tinytext,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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

CREATE TABLE `KitTypes` (
`ID` int(11) NOT NULL,
  `Name` tinytext NOT NULL,
  `TypeDescription` text,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `KitTypes`
--

INSERT INTO `KitTypes` (`ID`, `Name`, `TypeDescription`, `updated_at`, `created_at`) VALUES
(0, '** Undefined **', NULL, NULL, NULL),
(1, 'Ipad 2', 'These are Ipad 2 with 64gb storage', NULL, NULL),
(2, 'HP Laptops', 'This is a pack of HP laptops that are mostly working with some bugs. \r\n', '2015-03-07 00:28:01', NULL),
(3, 'Ipad Mini', 'this is a test', '2015-03-07 00:20:01', NULL),
(4, 'Arduino', 'Play around with microcontrollers and PWM motors.', '2015-03-30 04:11:51', '2015-03-07 01:00:25'),
(5, 'Raspberry Pi', 'ARM-based mini computers.', '2015-03-30 04:12:22', '2015-03-07 01:00:44'),
(9, 'Lego Mindstorms', 'Imagine things, build things.', '2015-03-30 04:23:06', '2015-03-07 01:04:23');

-- --------------------------------------------------------

--
-- Table structure for table `Logs`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=559 DEFAULT CHARSET=latin1;

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
(305, '2015-03-08 00:00:00', 4, 0, 55, NULL, 1, 'Created Kit: New Kit Name', '2015-03-07 01:33:07', '2015-03-07 01:33:07'),
(308, '2015-03-07 00:00:00', 12, 9, 55, 116, 1, 'Removed Contents: new item', '2015-03-07 01:33:26', '2015-03-07 01:33:26'),
(311, '2015-03-07 00:00:00', 4, 0, 56, NULL, 1, 'Created Kit: New Kit Name', '2015-03-07 01:34:16', '2015-03-07 01:34:16'),
(318, '2015-03-07 00:00:00', 4, 0, 57, NULL, 1, 'Created Kit: New Kit Name', '2015-03-07 01:42:08', '2015-03-07 01:42:08'),
(325, '2015-03-07 00:00:00', 14, 6, 57, 3, 1, 'Booking Deleted by:user', '2015-03-07 01:45:06', '2015-03-07 01:45:06'),
(326, '2015-03-07 00:00:00', 6, 6, 57, NULL, 1, 'Deleted Kit: walla', '2015-03-07 01:45:07', '2015-03-07 01:45:07'),
(327, '2015-03-07 00:00:00', 20, 6, NULL, NULL, 1, 'Kit type deleted by:user', '2015-03-07 01:45:07', '2015-03-07 01:45:07'),
(328, '2015-03-15 00:00:00', 13, 3, 10, NULL, 1, 'Booking for:MNA-IT from:2015-03-14 To:Invalid date', '2015-03-15 13:46:42', '2015-03-15 13:46:42'),
(329, '2015-03-18 00:00:00', 1, 1, 2, 15, 1, 'This item is damaged', '2015-03-18', '2015-03-18'),
(330, '2015-03-18 00:00:00', 2, 1, 2, 16, 1, 'This item is missing', '2015-03-18 00:00:00', '2015-03-18 00:00:00'),
(331, '2015-03-20 00:00:00', 11, 1, 2, NULL, 1, 'Changed DamagedLogID From:329 To:', '2015-03-20 21:21:04', '2015-03-20 21:21:04'),
(332, '2015-03-20 00:00:00', 11, 1, 2, NULL, 1, 'Changed MissingLogID From:330 To:', '2015-03-20 21:21:04', '2015-03-20 21:21:04'),
(333, '2015-03-20 00:00:00', 11, 1, 2, NULL, 1, 'Changed DamagedLogID From:0 To:', '2015-03-20 22:13:38', '2015-03-20 22:13:38'),
(334, '2015-03-20 00:00:00', 11, 1, 2, NULL, 1, 'Changed MissingLogID From:0 To:', '2015-03-20 22:13:38', '2015-03-20 22:13:38'),
(335, '2015-03-20 00:00:00', 11, 1, 2, NULL, 1, 'Changed DamagedLogID From:0 To:', '2015-03-20 22:13:38', '2015-03-20 22:13:38'),
(336, '2015-03-20 00:00:00', 11, 1, 2, NULL, 1, 'Changed MissingLogID From:0 To:', '2015-03-20 22:13:38', '2015-03-20 22:13:38'),
(337, '2015-03-26 00:00:00', 18, 2, 3, NULL, 1, 'Added user:user as primary booker', '2015-03-26 03:25:56', '2015-03-26 03:25:56'),
(338, '2015-03-26 00:00:00', 18, 2, 3, NULL, 1, 'Added user:suspicious@user.com as secondary contact', '2015-03-26 03:25:56', '2015-03-26 03:25:56'),
(339, '2015-03-26 00:00:00', 18, 2, 3, NULL, 1, 'Added user:suspicious@user.com as secondary contact', '2015-03-26 03:28:13', '2015-03-26 03:28:13'),
(340, '2015-03-26 00:00:00', 18, 2, 3, NULL, 1, 'Added user:ogre@club.com as secondary contact', '2015-03-26 03:28:13', '2015-03-26 03:28:13'),
(341, '2015-03-26 00:00:00', 5, 2, 3, NULL, 1, 'Changed Kit field: KitState From:1 To:2', '2015-03-26 03:49:21', '2015-03-26 03:49:21'),
(342, '2015-03-26 00:00:00', 2, 2, 3, NULL, 1, 'Test missing log laptop 1', '2015-03-26 03:49:21', '2015-03-26 03:49:21'),
(343, '2015-03-26 00:00:00', 11, 2, 3, NULL, 1, 'Changed MissingLogID From: To:342', '2015-03-26 03:49:21', '2015-03-26 03:49:21'),
(344, '2015-03-26 00:00:00', 1, 2, 3, NULL, 1, 'Test damage laptop 2', '2015-03-26 03:49:21', '2015-03-26 03:49:21'),
(345, '2015-03-26 00:00:00', 11, 2, 3, NULL, 1, 'Changed DamagedLogID From: To:344', '2015-03-26 03:49:21', '2015-03-26 03:49:21'),
(346, '2015-03-26 00:00:00', 1, 2, 3, NULL, 1, 'new damage test', '2015-03-26 04:09:07', '2015-03-26 04:09:07'),
(347, '2015-03-26 00:00:00', 11, 2, 3, NULL, 1, 'Changed DamagedLogID From: To:346', '2015-03-26 04:09:07', '2015-03-26 04:09:07'),
(348, '2015-03-26 00:00:00', 5, 2, 3, NULL, 1, 'Changed Kit field: AtBranch From:3 To:9', '2015-03-26 04:09:07', '2015-03-26 04:09:07'),
(349, '2015-03-26 00:00:00', 5, 2, 3, NULL, 1, 'Changed Kit field: KitState From:2 To:1', '2015-03-26 04:09:07', '2015-03-26 04:09:07'),
(350, '2015-03-26 00:00:00', 18, 2, 3, NULL, 1, 'Added user:suspicious@user.com as secondary contact', '2015-03-26 04:14:04', '2015-03-26 04:14:04'),
(351, '2015-03-26 00:00:00', 18, 2, 3, NULL, 1, 'Added user:ogre@club.com as secondary contact', '2015-03-26 04:14:04', '2015-03-26 04:14:04'),
(352, '2015-03-26 00:00:00', 18, 2, 3, NULL, 1, 'Added user:suspicious@user.com as secondary contact', '2015-03-26 04:14:13', '2015-03-26 04:14:13'),
(353, '2015-03-26 00:00:00', 18, 2, 3, NULL, 1, 'Added user:ogre@club.com as secondary contact', '2015-03-26 04:14:13', '2015-03-26 04:14:13'),
(354, '2015-03-26 00:00:00', 5, 2, 3, NULL, 1, 'Changed Kit field: KitState From:1 To:2', '2015-03-26 04:15:07', '2015-03-26 04:15:07'),
(355, '2015-03-26 00:00:00', 18, 2, 3, NULL, 1, 'Added user:suspicious@user.com as secondary contact', '2015-03-26 04:17:07', '2015-03-26 04:17:07'),
(356, '2015-03-26 00:00:00', 18, 2, 3, NULL, 1, 'Added user:ogre@club.com as secondary contact', '2015-03-26 04:17:07', '2015-03-26 04:17:07'),
(357, '2015-03-26 00:00:00', 18, 1, 2, NULL, 1, 'Added user:user as primary booker', '2015-03-26 04:17:54', '2015-03-26 04:17:54'),
(358, '2015-03-26 00:00:00', 18, 2, 3, NULL, 1, 'Added user:suspicious@user.com as secondary contact', '2015-03-26 04:19:01', '2015-03-26 04:19:01'),
(359, '2015-03-26 00:00:00', 18, 2, 3, NULL, 1, 'Added user:ogre@club.com as secondary contact', '2015-03-26 04:19:01', '2015-03-26 04:19:01'),
(360, '2015-03-26 00:00:00', 5, 1, 2, NULL, 1, 'Changed Kit field: KitState From:1 To:2', '2015-03-26 16:50:38', '2015-03-26 16:50:38'),
(361, '2015-03-26 00:00:00', 2, 1, 2, NULL, 1, 'fdfdfd', '2015-03-26 16:50:38', '2015-03-26 16:50:38'),
(362, '2015-03-26 00:00:00', 11, 1, 2, NULL, 1, 'Changed MissingLogID From: To:361', '2015-03-26 16:50:38', '2015-03-26 16:50:38'),
(363, '2015-03-26 00:00:00', 18, 1, 2, NULL, 1, 'Added user:user as primary booker', '2015-03-26 17:00:12', '2015-03-26 17:00:12'),
(364, '2015-03-26 00:00:00', 18, 1, 2, NULL, 1, 'Added user:user as primary booker', '2015-03-26 17:01:00', '2015-03-26 17:01:00'),
(365, '2015-03-29 00:00:00', 1, 1, 2, NULL, 1, 'update dmg', '2015-03-29 04:23:53', '2015-03-29 04:23:53'),
(366, '2015-03-29 00:00:00', 11, 1, 2, NULL, 1, 'Changed DamagedLogID From: To:365', '2015-03-29 04:23:53', '2015-03-29 04:23:53'),
(367, '2015-03-29 00:00:00', 2, 1, 2, NULL, 1, 'thisipad2damage', '2015-03-29 04:26:03', '2015-03-29 04:26:03'),
(368, '2015-03-29 00:00:00', 11, 1, 2, NULL, 1, 'Changed MissingLogID From: To:367', '2015-03-29 04:26:03', '2015-03-29 04:26:03'),
(369, '2015-03-29 00:00:00', 2, 1, 2, NULL, 1, 'hime', '2015-03-29 04:34:02', '2015-03-29 04:34:02'),
(370, '2015-03-29 00:00:00', 11, 1, 2, NULL, 1, 'Changed MissingLogID From: To:369', '2015-03-29 04:34:02', '2015-03-29 04:34:02'),
(371, '2015-03-29 00:00:00', 1, 1, 2, NULL, 1, 'newdmg', '2015-03-29 04:39:28', '2015-03-29 04:39:28'),
(372, '2015-03-29 00:00:00', 11, 1, 2, NULL, 1, 'Changed DamagedLogID From: To:371', '2015-03-29 04:39:28', '2015-03-29 04:39:28'),
(373, '2015-03-29 00:00:00', 5, 3, 47, NULL, 1, 'Changed Kit field: KitType From:1 To:3', '2015-03-29 05:09:29', '2015-03-29 05:09:29'),
(374, '2015-03-29 00:00:00', 1, 1, 2, NULL, 1, 'testdmg', '2015-03-29 05:21:22', '2015-03-29 05:21:22'),
(375, '2015-03-29 00:00:00', 11, 1, 2, NULL, 1, 'Changed DamagedLogID From: To:374', '2015-03-29 05:21:22', '2015-03-29 05:21:22'),
(376, '2015-03-29 00:00:00', 1, 1, 2, NULL, 1, 'shouldnotdmg', '2015-03-29 05:41:20', '2015-03-29 05:41:20'),
(377, '2015-03-29 00:00:00', 11, 1, 2, NULL, 1, 'Changed DamagedLogID From: To:376', '2015-03-29 05:41:20', '2015-03-29 05:41:20'),
(378, '2015-03-29 00:00:00', 2, 1, 2, NULL, 1, 'milom', '2015-03-29 05:51:49', '2015-03-29 05:51:49'),
(379, '2015-03-29 00:00:00', 11, 1, 2, NULL, 1, 'Changed MissingLogID From: To:378', '2015-03-29 05:51:49', '2015-03-29 05:51:49'),
(380, '2015-03-29 00:00:00', 5, 1, 16, NULL, 1, 'Changed Kit field: AtBranch From:0 To:3', '2015-03-29 05:59:21', '2015-03-29 05:59:21'),
(381, '2015-03-30 00:00:00', 19, 4, NULL, NULL, 1, 'Name changed From:newType To:Arduino', '2015-03-30 04:11:51', '2015-03-30 04:11:51'),
(382, '2015-03-30 00:00:00', 19, 4, NULL, NULL, 1, 'TypeDescription changed From: To:Play around with microcontrollers and PWM motors.', '2015-03-30 04:11:51', '2015-03-30 04:11:51'),
(383, '2015-03-30 00:00:00', 19, 5, NULL, NULL, 1, 'Name changed From:newType To:Raspberry Pi', '2015-03-30 04:12:22', '2015-03-30 04:12:22'),
(384, '2015-03-30 00:00:00', 19, 5, NULL, NULL, 1, 'TypeDescription changed From: To:ARM-based mini computers.', '2015-03-30 04:12:22', '2015-03-30 04:12:22'),
(385, '2015-03-30 00:00:00', 19, 9, NULL, NULL, 1, 'Name changed From:this is a thing To:Makerbot', '2015-03-30 04:12:52', '2015-03-30 04:12:52'),
(386, '2015-03-30 00:00:00', 19, 9, NULL, NULL, 1, 'TypeDescription changed From:what is this thing>? To:Make things.', '2015-03-30 04:12:52', '2015-03-30 04:12:52'),
(387, '2015-03-30 00:00:00', 5, 9, 55, NULL, 1, 'Changed Kit field: Name From:New Kit Name To:Makerbot Package', '2015-03-30 04:13:27', '2015-03-30 04:13:27'),
(388, '2015-03-30 00:00:00', 5, 9, 55, NULL, 1, 'Changed Kit field: KitDesc From:Place a description of the contents of this kit here.  To:Makerbot Package. Learn how it makes things.', '2015-03-30 04:13:27', '2015-03-30 04:13:27'),
(389, '2015-03-30 00:00:00', 5, 9, 55, NULL, 1, 'Changed Kit field: BarcodeNumber From:31221 To:31221444555666', '2015-03-30 04:13:27', '2015-03-30 04:13:27'),
(390, '2015-03-30 00:00:00', 5, 9, 55, NULL, 1, 'Changed Kit field: Name From:Makerbot Package To:Makerbot Kit', '2015-03-30 04:13:57', '2015-03-30 04:13:57'),
(391, '2015-03-30 00:00:00', 10, 9, 55, NULL, 1, 'Added content: Makerbot Package', '2015-03-30 04:13:57', '2015-03-30 04:13:57'),
(392, '2015-03-30 00:00:00', 4, 0, 56, NULL, 1, 'Created Kit: New Kit Name', '2015-03-30 04:14:06', '2015-03-30 04:14:06'),
(393, '2015-03-30 00:00:00', 5, 5, 56, NULL, 1, 'Changed Kit field: KitType From:0 To:5', '2015-03-30 04:15:57', '2015-03-30 04:15:57'),
(394, '2015-03-30 00:00:00', 5, 5, 56, NULL, 1, 'Changed Kit field: Name From:New Kit Name To:Raspberry Pi Kit #1', '2015-03-30 04:15:57', '2015-03-30 04:15:57'),
(395, '2015-03-30 00:00:00', 5, 5, 56, NULL, 1, 'Changed Kit field: AtBranch From:0 To:2', '2015-03-30 04:15:57', '2015-03-30 04:15:57'),
(396, '2015-03-30 00:00:00', 5, 5, 56, NULL, 1, 'Changed Kit field: KitDesc From:Place a description of the contents of this kit here.  To:4 Model B 512MB Raspberry Pis. Comes with 4x HDMI Cables and 4x Power supplies (800mA).', '2015-03-30 04:15:57', '2015-03-30 04:15:57'),
(397, '2015-03-30 00:00:00', 10, 5, 56, NULL, 1, 'Added content: Raspberry Pi #1', '2015-03-30 04:15:57', '2015-03-30 04:15:57'),
(398, '2015-03-30 00:00:00', 10, 5, 56, NULL, 1, 'Added content: Raspberry Pi #2', '2015-03-30 04:15:57', '2015-03-30 04:15:57'),
(399, '2015-03-30 00:00:00', 10, 5, 56, NULL, 1, 'Added content: Raspberry Pi #3', '2015-03-30 04:15:57', '2015-03-30 04:15:57'),
(400, '2015-03-30 00:00:00', 10, 5, 56, NULL, 1, 'Added content: Raspberry Pi #4', '2015-03-30 04:15:57', '2015-03-30 04:15:57'),
(401, '2015-03-30 00:00:00', 5, 3, 47, NULL, 1, 'Changed Kit field: Name From:What am i thinking? To:Ipad Mini Kit #1', '2015-03-30 04:17:23', '2015-03-30 04:17:23'),
(402, '2015-03-30 00:00:00', 5, 3, 47, NULL, 1, 'Changed Kit field: AtBranch From:0 To:2', '2015-03-30 04:17:23', '2015-03-30 04:17:23'),
(403, '2015-03-30 00:00:00', 5, 3, 47, NULL, 1, 'Changed Kit field: KitDesc From:Place a description of the contents of this kit here.  To:5 Ipad Mini''s installed with the latest iOS.', '2015-03-30 04:17:23', '2015-03-30 04:17:23'),
(404, '2015-03-30 00:00:00', 5, 3, 47, NULL, 1, 'Changed Kit field: BarcodeNumber From:31221 To:31221342555612', '2015-03-30 04:17:23', '2015-03-30 04:17:23'),
(405, '2015-03-30 00:00:00', 10, 3, 47, NULL, 1, 'Added content: Ipad Mini #1', '2015-03-30 04:17:23', '2015-03-30 04:17:23'),
(406, '2015-03-30 00:00:00', 10, 3, 47, NULL, 1, 'Added content: Ipad Mini #2', '2015-03-30 04:17:23', '2015-03-30 04:17:23'),
(407, '2015-03-30 00:00:00', 10, 3, 47, NULL, 1, 'Added content: Ipad Mini #3', '2015-03-30 04:17:23', '2015-03-30 04:17:23'),
(408, '2015-03-30 00:00:00', 10, 3, 47, NULL, 1, 'Added content: Ipad Mini #4', '2015-03-30 04:17:23', '2015-03-30 04:17:23'),
(409, '2015-03-30 00:00:00', 10, 3, 47, NULL, 1, 'Added content: Ipad Mini #5', '2015-03-30 04:17:23', '2015-03-30 04:17:23'),
(410, '2015-03-30 00:00:00', 5, 3, 10, NULL, 1, 'Changed Kit field: Name From:aaa To:Ipad Mini Kit #2', '2015-03-30 04:19:24', '2015-03-30 04:19:24'),
(411, '2015-03-30 00:00:00', 5, 3, 10, NULL, 1, 'Changed Kit field: AtBranch From:0 To:10', '2015-03-30 04:19:24', '2015-03-30 04:19:24'),
(412, '2015-03-30 00:00:00', 5, 3, 10, NULL, 1, 'Changed Kit field: KitDesc From:Place a description of the contents of this kit here.  To:Ipad Mini Kit with 4 Ipads on latest iOS.', '2015-03-30 04:19:24', '2015-03-30 04:19:24'),
(413, '2015-03-30 00:00:00', 10, 3, 10, NULL, 1, 'Added content: Ipad Mini #1', '2015-03-30 04:19:24', '2015-03-30 04:19:24'),
(414, '2015-03-30 00:00:00', 10, 3, 10, NULL, 1, 'Added content: Ipad Mini #2', '2015-03-30 04:19:24', '2015-03-30 04:19:24'),
(415, '2015-03-30 00:00:00', 10, 3, 10, NULL, 1, 'Added content: Ipad Mini #3', '2015-03-30 04:19:24', '2015-03-30 04:19:24'),
(416, '2015-03-30 00:00:00', 10, 3, 10, NULL, 1, 'Added content: Ipad Mini #4', '2015-03-30 04:19:24', '2015-03-30 04:19:24'),
(417, '2015-03-30 00:00:00', 4, 0, 57, NULL, 1, 'Created Kit: New Kit Name', '2015-03-30 04:19:35', '2015-03-30 04:19:35'),
(418, '2015-03-30 00:00:00', 5, 4, 57, NULL, 1, 'Changed Kit field: KitType From:0 To:4', '2015-03-30 04:22:21', '2015-03-30 04:22:21'),
(419, '2015-03-30 00:00:00', 5, 4, 57, NULL, 1, 'Changed Kit field: Name From:New Kit Name To:Arduino Kit 1', '2015-03-30 04:22:21', '2015-03-30 04:22:21'),
(420, '2015-03-30 00:00:00', 5, 4, 57, NULL, 1, 'Changed Kit field: KitDesc From:Place a description of the contents of this kit here.  To:Three Arduino UNO''s and an Arduino MEGA. Included is a components back and a Board of Education Shield.', '2015-03-30 04:22:21', '2015-03-30 04:22:21'),
(421, '2015-03-30 00:00:00', 5, 4, 57, NULL, 1, 'Changed Kit field: BarcodeNumber From:31221 To:31221668423111', '2015-03-30 04:22:21', '2015-03-30 04:22:21'),
(422, '2015-03-30 00:00:00', 10, 4, 57, NULL, 1, 'Added content: Arduino UNO R3 #1', '2015-03-30 04:22:21', '2015-03-30 04:22:21'),
(423, '2015-03-30 00:00:00', 10, 4, 57, NULL, 1, 'Added content: Arduino UNO R3 #2', '2015-03-30 04:22:21', '2015-03-30 04:22:21'),
(424, '2015-03-30 00:00:00', 10, 4, 57, NULL, 1, 'Added content: Arduino UNO R3 #3', '2015-03-30 04:22:21', '2015-03-30 04:22:21'),
(425, '2015-03-30 00:00:00', 10, 4, 57, NULL, 1, 'Added content: Arduino MEGA #1', '2015-03-30 04:22:21', '2015-03-30 04:22:21'),
(426, '2015-03-30 00:00:00', 10, 4, 57, NULL, 1, 'Added content: Components Pack', '2015-03-30 04:22:21', '2015-03-30 04:22:21'),
(427, '2015-03-30 00:00:00', 10, 4, 57, NULL, 1, 'Added content: BOE Shield', '2015-03-30 04:22:21', '2015-03-30 04:22:21'),
(428, '2015-03-30 00:00:00', 5, 4, 57, NULL, 1, 'Changed Kit field: KitDesc From:Three Arduino UNO''s and an Arduino MEGA. Included is a components back and a Board of Education Shield. To:Three Arduino UNO''s and an Arduino MEGA. Included is a components pack and a Board of Education Shield.', '2015-03-30 04:22:25', '2015-03-30 04:22:25'),
(429, '2015-03-30 00:00:00', 19, 9, NULL, NULL, 1, 'Name changed From:Makerbot To:Lego Mindstorms', '2015-03-30 04:23:06', '2015-03-30 04:23:06'),
(430, '2015-03-30 00:00:00', 19, 9, NULL, NULL, 1, 'TypeDescription changed From:Make things. To:Imagine things, build things.', '2015-03-30 04:23:06', '2015-03-30 04:23:06'),
(431, '2015-03-30 00:00:00', 5, 9, 55, NULL, 1, 'Changed Kit field: Name From:Makerbot Kit To:Lego Mindstorms NXT Kit #1', '2015-03-30 04:24:15', '2015-03-30 04:24:15'),
(432, '2015-03-30 00:00:00', 5, 9, 55, NULL, 1, 'Changed Kit field: KitDesc From:Makerbot Package. Learn how it makes things. To:Mindstorms Kit with extra components package.', '2015-03-30 04:24:15', '2015-03-30 04:24:15'),
(433, '2015-03-30 00:00:00', 11, 9, 55, NULL, 1, 'Changed Name From:Makerbot Package To:Mindstorms NXT 2.0', '2015-03-30 04:24:15', '2015-03-30 04:24:15'),
(434, '2015-03-30 00:00:00', 10, 9, 55, NULL, 1, 'Added content: NXT Components Pkg', '2015-03-30 04:24:15', '2015-03-30 04:24:15'),
(435, '2015-03-30 00:00:00', 5, 1, 36, NULL, 1, 'Changed Kit field: Name From:Ipad Pro To:Kit #4', '2015-03-30 04:27:22', '2015-03-30 04:27:22'),
(436, '2015-03-30 00:00:00', 5, 1, 36, NULL, 1, 'Changed Kit field: KitDesc From:this is the descriptiona To:Learn about Earth and Atmospheric Weather. Included are three iPads with EAW packages installed.', '2015-03-30 04:27:22', '2015-03-30 04:27:22'),
(437, '2015-03-30 00:00:00', 5, 1, 36, NULL, 1, 'Changed Kit field: BarcodeNumber From:31221 To:31221564322110', '2015-03-30 04:27:22', '2015-03-30 04:27:22'),
(438, '2015-03-30 00:00:00', 5, 1, 36, NULL, 1, 'Changed Kit field: SpecializedName From:EASL To:EAW', '2015-03-30 04:27:22', '2015-03-30 04:27:22'),
(439, '2015-03-30 00:00:00', 11, 1, 36, NULL, 1, 'Changed Name From:new item To:Ipad 2 2nd Gen #1 w/ EAW', '2015-03-30 04:27:22', '2015-03-30 04:27:22'),
(440, '2015-03-30 00:00:00', 11, 1, 36, NULL, 1, 'Changed SerialNumber From:new asset number To:189001', '2015-03-30 04:27:22', '2015-03-30 04:27:22'),
(441, '2015-03-30 00:00:00', 11, 1, 36, NULL, 1, 'Changed Name From:blaa To:Ipad 2 2nd Gen #2 w/ EAW', '2015-03-30 04:27:22', '2015-03-30 04:27:22'),
(442, '2015-03-30 00:00:00', 11, 1, 36, NULL, 1, 'Changed SerialNumber From:111 To:189002', '2015-03-30 04:27:22', '2015-03-30 04:27:22'),
(443, '2015-03-30 00:00:00', 11, 1, 36, NULL, 1, 'Changed Name From:this is something new To:Ipad 3 2nd Gen #3 w/ EAW', '2015-03-30 04:27:22', '2015-03-30 04:27:22'),
(444, '2015-03-30 00:00:00', 11, 1, 36, NULL, 1, 'Changed SerialNumber From:111222 To:189003', '2015-03-30 04:27:22', '2015-03-30 04:27:22'),
(445, '2015-03-30 00:00:00', 5, 1, 1, NULL, 1, 'Changed Kit field: KitDesc From:A kit of 6 ipad 2''s with ESL programs To:A kit of 6 ipad 2''s with ESL programs installed.', '2015-03-30 04:28:19', '2015-03-30 04:28:19'),
(446, '2015-03-30 00:00:00', 11, 1, 1, NULL, 1, 'Changed SerialNumber From:1111 To:111101', '2015-03-30 04:28:19', '2015-03-30 04:28:19'),
(447, '2015-03-30 00:00:00', 11, 1, 1, NULL, 1, 'Changed SerialNumber From:2222 To:111102', '2015-03-30 04:28:19', '2015-03-30 04:28:19'),
(448, '2015-03-30 00:00:00', 11, 1, 1, NULL, 1, 'Changed SerialNumber From:3333 To:111103', '2015-03-30 04:28:19', '2015-03-30 04:28:19'),
(449, '2015-03-30 00:00:00', 11, 1, 1, NULL, 1, 'Changed SerialNumber From:4444 To:111104', '2015-03-30 04:28:19', '2015-03-30 04:28:19'),
(450, '2015-03-30 00:00:00', 11, 1, 1, NULL, 1, 'Changed SerialNumber From:5555 To:111105', '2015-03-30 04:28:19', '2015-03-30 04:28:19'),
(451, '2015-03-30 00:00:00', 11, 1, 1, NULL, 1, 'Changed SerialNumber From:6666 To:111106', '2015-03-30 04:28:19', '2015-03-30 04:28:19'),
(452, '2015-03-30 00:00:00', 11, 1, 1, NULL, 1, 'Changed SerialNumber From:na To:111107', '2015-03-30 04:28:19', '2015-03-30 04:28:19'),
(453, '2015-03-30 00:00:00', 11, 1, 1, NULL, 1, 'Changed SerialNumber From:ns To:111108', '2015-03-30 04:28:19', '2015-03-30 04:28:19'),
(454, '2015-03-30 00:00:00', 11, 1, 1, NULL, 1, 'Changed SerialNumber From:ns To:111109', '2015-03-30 04:28:19', '2015-03-30 04:28:19'),
(455, '2015-03-30 00:00:00', 11, 1, 1, NULL, 1, 'Changed SerialNumber From:na To:111110', '2015-03-30 04:28:19', '2015-03-30 04:28:19'),
(456, '2015-03-30 00:00:00', 5, 1, 1, NULL, 1, 'Changed Kit field: BarcodeNumber From:31221 To:31221780699422', '2015-03-30 04:28:32', '2015-03-30 04:28:32'),
(457, '2015-03-30 00:00:00', 5, 1, 2, NULL, 1, 'Changed Kit field: Name From:Kit #2 the best To:Kit #2 The Best', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(458, '2015-03-30 00:00:00', 5, 1, 2, NULL, 1, 'Changed Kit field: BarcodeNumber From:31221 To:31221555554444', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(459, '2015-03-30 00:00:00', 11, 1, 2, NULL, 1, 'Changed Name From:Ipad #1s To:Ipad 2 #1', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(460, '2015-03-30 00:00:00', 11, 1, 2, NULL, 1, 'Changed SerialNumber From:11111 To:115111', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(461, '2015-03-30 00:00:00', 11, 1, 2, NULL, 1, 'Changed Name From:Ipad #2 To:Ipad 2 #2', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(462, '2015-03-30 00:00:00', 11, 1, 2, NULL, 1, 'Changed SerialNumber From:22222 To:115112', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(463, '2015-03-30 00:00:00', 11, 1, 2, NULL, 1, 'Changed Name From:Ipad #3 To:Ipad 2 #3', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(464, '2015-03-30 00:00:00', 11, 1, 2, NULL, 1, 'Changed SerialNumber From:33333 To:115113', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(465, '2015-03-30 00:00:00', 11, 1, 2, NULL, 1, 'Changed Name From:Ipad #4 To:Ipad 2 #4', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(466, '2015-03-30 00:00:00', 11, 1, 2, NULL, 1, 'Changed SerialNumber From:44444 To:115114', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(467, '2015-03-30 00:00:00', 11, 1, 2, NULL, 1, 'Changed Name From:Ipad #5 To:Ipad 2 #5', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(468, '2015-03-30 00:00:00', 11, 1, 2, NULL, 1, 'Changed SerialNumber From:55555 To:115115', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(469, '2015-03-30 00:00:00', 11, 1, 2, NULL, 1, 'Changed Name From:Ipad #6 To:Ipad 2 #6', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(470, '2015-03-30 00:00:00', 11, 1, 2, NULL, 1, 'Changed SerialNumber From:66666 To:115116', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(471, '2015-03-30 00:00:00', 11, 1, 2, NULL, 1, 'Changed SerialNumber From:na To:115117', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(472, '2015-03-30 00:00:00', 11, 1, 2, NULL, 1, 'Changed SerialNumber From:na To:115118', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(473, '2015-03-30 00:00:00', 11, 1, 2, NULL, 1, 'Changed SerialNumber From:na To:115119', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(474, '2015-03-30 00:00:00', 12, 1, 2, NULL, 1, 'Removed Contents: 6x magnetic ipad covers', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(475, '2015-03-30 00:00:00', 12, 1, 2, NULL, 1, 'Removed Contents: new item', '2015-03-30 04:30:22', '2015-03-30 04:30:22'),
(476, '2015-03-30 00:00:00', 5, 1, 2, NULL, 1, 'Changed Kit field: KitDesc From:A Kit of 6 Ipad ''2ss To:A Kit of 6 Ipad 2''s with accessories.', '2015-03-30 04:30:38', '2015-03-30 04:30:38'),
(477, '2015-03-30 00:00:00', 5, 1, 16, NULL, 1, 'Changed Kit field: KitDesc From:eight Ipad 2 second generation.  To:Six Ipad 2 second generation. ', '2015-03-30 04:32:26', '2015-03-30 04:32:26'),
(478, '2015-03-30 00:00:00', 5, 1, 16, NULL, 1, 'Changed Kit field: BarcodeNumber From:31221 To:31221847823111', '2015-03-30 04:32:26', '2015-03-30 04:32:26'),
(479, '2015-03-30 00:00:00', 10, 1, 16, NULL, 1, 'Added content: Ipad 2 2nd Gen #1', '2015-03-30 04:32:26', '2015-03-30 04:32:26'),
(480, '2015-03-30 00:00:00', 10, 1, 16, NULL, 1, 'Added content: Ipad 2 2nd Gen #2', '2015-03-30 04:32:26', '2015-03-30 04:32:26'),
(481, '2015-03-30 00:00:00', 10, 1, 16, NULL, 1, 'Added content: Ipad 2 2nd Gen #3', '2015-03-30 04:32:26', '2015-03-30 04:32:26'),
(482, '2015-03-30 00:00:00', 10, 1, 16, NULL, 1, 'Added content: Ipad 2 2nd Gen #4', '2015-03-30 04:32:26', '2015-03-30 04:32:26'),
(483, '2015-03-30 00:00:00', 10, 1, 16, NULL, 1, 'Added content: Ipad 2 2nd Gen #5', '2015-03-30 04:32:26', '2015-03-30 04:32:26'),
(484, '2015-03-30 00:00:00', 10, 1, 16, NULL, 1, 'Added content: Ipad 2 2nd Gen #6', '2015-03-30 04:32:26', '2015-03-30 04:32:26'),
(485, '2015-03-30 00:00:00', 5, 2, 13, NULL, 1, 'Changed Kit field: KitDesc From:This is a sample lap for testing laptops.  To:4 HP Laptops installed with Physics Virtualware modules: Kinematics, Collisions, and Wave Theory.', '2015-03-30 04:35:40', '2015-03-30 04:35:40'),
(486, '2015-03-30 00:00:00', 5, 2, 13, NULL, 1, 'Changed Kit field: BarcodeNumber From:31221 To:31221989000111', '2015-03-30 04:35:40', '2015-03-30 04:35:40'),
(487, '2015-03-30 00:00:00', 5, 2, 13, NULL, 1, 'Changed Kit field: SpecializedName From:aa To:Physics Virtualware', '2015-03-30 04:35:40', '2015-03-30 04:35:40'),
(488, '2015-03-30 00:00:00', 10, 2, 13, NULL, 1, 'Added content: HP Laptop #1 w/ VW', '2015-03-30 04:35:40', '2015-03-30 04:35:40'),
(489, '2015-03-30 00:00:00', 10, 2, 13, NULL, 1, 'Added content: HP Laptop #2 w/ VW', '2015-03-30 04:35:40', '2015-03-30 04:35:40'),
(490, '2015-03-30 00:00:00', 10, 2, 13, NULL, 1, 'Added content: HP Laptop #3 w/ VW', '2015-03-30 04:35:40', '2015-03-30 04:35:40'),
(491, '2015-03-30 00:00:00', 10, 2, 13, NULL, 1, 'Added content: HP Laptop #4 w/ VW', '2015-03-30 04:35:40', '2015-03-30 04:35:40'),
(492, '2015-03-30 00:00:00', 5, 2, 13, NULL, 1, 'Changed Kit field: Name From:HP Lap To:Kit #1', '2015-03-30 04:35:52', '2015-03-30 04:35:52'),
(493, '2015-03-30 00:00:00', 5, 2, 13, NULL, 1, 'Changed Kit field: Name From:Kit #1 To:Laptop Kit #1', '2015-03-30 04:36:00', '2015-03-30 04:36:00'),
(494, '2015-03-30 00:00:00', 5, 2, 3, NULL, 1, 'Changed Kit field: KitDesc From:6Laptops with 15" screens To:6 HP Laptops with 15" screens.', '2015-03-30 04:37:24', '2015-03-30 04:37:24'),
(495, '2015-03-30 00:00:00', 5, 2, 3, NULL, 1, 'Changed Kit field: BarcodeNumber From:31221 To:31221123890555', '2015-03-30 04:37:24', '2015-03-30 04:37:24'),
(496, '2015-03-30 00:00:00', 11, 2, 3, NULL, 1, 'Changed Name From:Laptop #1 To:HP Laptop #1', '2015-03-30 04:37:24', '2015-03-30 04:37:24'),
(497, '2015-03-30 00:00:00', 11, 2, 3, NULL, 1, 'Changed SerialNumber From:aaaa To:154611', '2015-03-30 04:37:24', '2015-03-30 04:37:24'),
(498, '2015-03-30 00:00:00', 11, 2, 3, NULL, 1, 'Changed Name From:Laptop #2 To:HP Laptop #2', '2015-03-30 04:37:24', '2015-03-30 04:37:24'),
(499, '2015-03-30 00:00:00', 11, 2, 3, NULL, 1, 'Changed SerialNumber From:bbbb To:154612', '2015-03-30 04:37:24', '2015-03-30 04:37:24'),
(500, '2015-03-30 00:00:00', 11, 2, 3, NULL, 1, 'Changed Name From:Laptop #3 To:HP Laptop #3', '2015-03-30 04:37:24', '2015-03-30 04:37:24'),
(501, '2015-03-30 00:00:00', 11, 2, 3, NULL, 1, 'Changed SerialNumber From:cccc To:154613', '2015-03-30 04:37:24', '2015-03-30 04:37:24'),
(502, '2015-03-30 00:00:00', 11, 2, 3, NULL, 1, 'Changed Name From:Laptop #4 To:HP Laptop #4', '2015-03-30 04:37:24', '2015-03-30 04:37:24'),
(503, '2015-03-30 00:00:00', 11, 2, 3, NULL, 1, 'Changed SerialNumber From:dddd To:154614', '2015-03-30 04:37:24', '2015-03-30 04:37:24'),
(504, '2015-03-30 00:00:00', 11, 2, 3, NULL, 1, 'Changed Name From:Laptop #5 To:HP Laptop #5', '2015-03-30 04:37:24', '2015-03-30 04:37:24'),
(505, '2015-03-30 00:00:00', 11, 2, 3, NULL, 1, 'Changed SerialNumber From:eeee To:154615', '2015-03-30 04:37:24', '2015-03-30 04:37:24'),
(506, '2015-03-30 00:00:00', 11, 2, 3, NULL, 1, 'Changed Name From:Laptop #6 To:HP Laptop #6', '2015-03-30 04:37:24', '2015-03-30 04:37:24'),
(507, '2015-03-30 00:00:00', 11, 2, 3, NULL, 1, 'Changed SerialNumber From:ffff To:154616', '2015-03-30 04:37:24', '2015-03-30 04:37:24'),
(508, '2015-03-30 00:00:00', 11, 2, 3, NULL, 1, 'Changed SerialNumber From:na To:154617', '2015-03-30 04:37:24', '2015-03-30 04:37:24'),
(509, '2015-03-30 00:00:00', 11, 2, 3, NULL, 1, 'Changed SerialNumber From:na To:154618', '2015-03-30 04:37:24', '2015-03-30 04:37:24'),
(510, '2015-03-30 00:00:00', 5, 2, 3, NULL, 1, 'Changed Kit field: Name From:Kit #1 To:Laptop Kit #3', '2015-03-30 04:37:48', '2015-03-30 04:37:48'),
(511, '2015-03-30 00:00:00', 5, 2, 12, NULL, 1, 'Changed Kit field: Name From:Kit # 1234 To:Laptop Kit #2', '2015-03-30 04:39:46', '2015-03-30 04:39:46'),
(512, '2015-03-30 00:00:00', 5, 2, 12, NULL, 1, 'Changed Kit field: KitDesc From:This is the alst Frigging kit i am going to make, what are they doing with them? feeding them to germelins in the stacks? To:Remember this old gem? A look into old software. Included are 4 HP Laptops with 15.6" Screens.', '2015-03-30 04:39:46', '2015-03-30 04:39:46'),
(513, '2015-03-30 00:00:00', 5, 2, 12, NULL, 1, 'Changed Kit field: BarcodeNumber From:31221 To:31221333666999', '2015-03-30 04:39:46', '2015-03-30 04:39:46'),
(514, '2015-03-30 00:00:00', 5, 2, 12, NULL, 1, 'Changed Kit field: SpecializedName From:laced with cyanide.  To:Mathblaster', '2015-03-30 04:39:46', '2015-03-30 04:39:46'),
(515, '2015-03-30 00:00:00', 10, 2, 12, NULL, 1, 'Added content: HP Laptop w/ MB #1', '2015-03-30 04:39:46', '2015-03-30 04:39:46'),
(516, '2015-03-30 00:00:00', 10, 2, 12, NULL, 1, 'Added content: HP Laptop w/ MB #2', '2015-03-30 04:39:46', '2015-03-30 04:39:46'),
(517, '2015-03-30 00:00:00', 10, 2, 12, NULL, 1, 'Added content: HP Laptop w/ MB #3', '2015-03-30 04:39:46', '2015-03-30 04:39:46'),
(518, '2015-03-30 00:00:00', 10, 2, 12, NULL, 1, 'Added content: HP Laptop w/ MB #4', '2015-03-30 04:39:46', '2015-03-30 04:39:46'),
(519, '2015-03-30 00:00:00', 5, 2, 54, NULL, 1, 'Changed Kit field: Name From:foo To:Laptop Kit #4', '2015-03-30 04:41:30', '2015-03-30 04:41:30'),
(520, '2015-03-30 00:00:00', 5, 2, 54, NULL, 1, 'Changed Kit field: KitDesc From:This is a FUBAR kit. Do not use! To:HP Laptop Kit containing 5 HP Laptops.', '2015-03-30 04:41:30', '2015-03-30 04:41:30'),
(521, '2015-03-30 00:00:00', 5, 2, 54, NULL, 1, 'Changed Kit field: BarcodeNumber From:31221 To:31221000011223', '2015-03-30 04:41:30', '2015-03-30 04:41:30'),
(522, '2015-03-30 00:00:00', 5, 2, 54, NULL, 1, 'Changed Kit field: Specialized From:1 To:0', '2015-03-30 04:41:30', '2015-03-30 04:41:30'),
(523, '2015-03-30 00:00:00', 10, 2, 54, NULL, 1, 'Added content: HP Laptop #1', '2015-03-30 04:41:30', '2015-03-30 04:41:30'),
(524, '2015-03-30 00:00:00', 10, 2, 54, NULL, 1, 'Added content: HP Laptop #2', '2015-03-30 04:41:30', '2015-03-30 04:41:30'),
(525, '2015-03-30 00:00:00', 10, 2, 54, NULL, 1, 'Added content: HP Laptop #3', '2015-03-30 04:41:30', '2015-03-30 04:41:30'),
(526, '2015-03-30 00:00:00', 10, 2, 54, NULL, 1, 'Added content: HP Laptop #4', '2015-03-30 04:41:30', '2015-03-30 04:41:30'),
(527, '2015-03-30 00:00:00', 10, 2, 54, NULL, 1, 'Added content: HP Laptop #5', '2015-03-30 04:41:30', '2015-03-30 04:41:30'),
(528, '2015-03-30 00:00:00', 5, 4, 57, NULL, 1, 'Changed Kit field: Name From:Arduino Kit 1 To:Arduino Kit #1', '2015-03-30 04:43:09', '2015-03-30 04:43:09'),
(529, '2015-03-30 00:00:00', 13, 4, 57, NULL, 1, 'Booking for:CPL from:2015-03-28 To:2015-03-30', '2015-03-30 04:43:33', '2015-03-30 04:43:33'),
(530, '2015-03-30 00:00:00', 18, 4, 57, NULL, 1, 'Added user:user as primary booker', '2015-03-30 04:43:33', '2015-03-30 04:43:33'),
(531, '2015-03-30 00:00:00', 14, 1, 2, NULL, 1, 'Booking Deleted by:user', '2015-03-30 04:45:07', '2015-03-30 04:45:07'),
(532, '2015-03-30 00:00:00', 13, 1, 1, NULL, 1, 'Booking for:IDY from:2015-03-28 To:2015-03-30', '2015-03-30 04:45:33', '2015-03-30 04:45:33'),
(533, '2015-03-30 00:00:00', 18, 1, 1, NULL, 1, 'Added user:user as primary booker', '2015-03-30 04:45:33', '2015-03-30 04:45:33'),
(534, '2015-03-30 00:00:00', 13, 9, 55, NULL, 1, 'Booking for:LHL from:2015-03-28 To:2015-03-30', '2015-03-30 04:46:11', '2015-03-30 04:46:11'),
(535, '2015-03-30 00:00:00', 18, 9, 55, NULL, 1, 'Added user:user as primary booker', '2015-03-30 04:46:11', '2015-03-30 04:46:11'),
(536, '2015-03-30 00:00:00', 5, 9, 55, NULL, 1, 'Changed Kit field: KitState From:1 To:2', '2015-03-30 04:46:48', '2015-03-30 04:46:48'),
(537, '2015-03-30 00:00:00', 5, 9, 55, NULL, 1, 'Changed Kit field: KitState From:1 To:2', '2015-03-30 04:46:48', '2015-03-30 04:46:48'),
(538, '2015-03-30 00:00:00', 14, 1, 2, NULL, 1, 'Booking Deleted by:user', '2015-03-30 04:47:47', '2015-03-30 04:47:47'),
(539, '2015-03-30 00:00:00', 14, 1, 2, NULL, 1, 'Booking Deleted by:user', '2015-03-30 04:48:11', '2015-03-30 04:48:11'),
(540, '2015-03-30 00:00:00', 13, 1, 2, NULL, 1, 'Booking for:CPL from:2015-03-28 To:2015-03-30', '2015-03-30 04:48:23', '2015-03-30 04:48:23'),
(541, '2015-03-30 00:00:00', 18, 1, 2, NULL, 1, 'Added user:user as primary booker', '2015-03-30 04:48:23', '2015-03-30 04:48:23'),
(542, '2015-03-30 00:00:00', 13, 1, 36, NULL, 1, 'Booking for:CPL from:2015-03-28 To:2015-04-08', '2015-03-30 04:50:29', '2015-03-30 04:50:29'),
(543, '2015-03-30 00:00:00', 18, 1, 36, NULL, 1, 'Added user:user as primary booker', '2015-03-30 04:50:29', '2015-03-30 04:50:29'),
(544, '2015-03-30 00:00:00', 13, 1, 36, NULL, 1, 'Booking for:CPL from:2015-03-28 To:2015-04-03', '2015-03-30 04:51:18', '2015-03-30 04:51:18'),
(545, '2015-03-30 00:00:00', 18, 1, 36, NULL, 1, 'Added user:user as primary booker', '2015-03-30 04:51:18', '2015-03-30 04:51:18'),
(546, '2015-03-30 00:00:00', 5, 1, 36, NULL, 1, 'Changed Kit field: AtBranch From:3 To:10', '2015-03-30 04:52:42', '2015-03-30 04:52:42'),
(547, '2015-03-30 00:00:00', 5, 1, 36, NULL, 1, 'Changed Kit field: Name From:Kit #4 To:Decommisioned Kit #4', '2015-03-30 04:53:52', '2015-03-30 04:53:52'),
(548, '2015-03-30 00:00:00', 5, 1, 36, NULL, 1, 'Changed Kit field: Name From:Decommisioned Kit #4 To:Kit #4', '2015-03-30 04:54:07', '2015-03-30 04:54:07'),
(549, '2015-03-30 00:00:00', 5, 1, 36, NULL, 1, 'Changed Kit field: Name From:Kit #4 To:Foobar', '2015-03-30 04:55:34', '2015-03-30 04:55:34'),
(550, '2015-03-30 00:00:00', 5, 1, 36, NULL, 1, 'Changed Kit field: KitDesc From:Learn about Earth and Atmospheric Weather. Included are three iPads with EAW packages installed. To:Made to break test the system.', '2015-03-30 04:55:34', '2015-03-30 04:55:34'),
(551, '2015-03-30 00:00:00', 5, 1, 36, NULL, 1, 'Changed Kit field: AtBranch From:10 To:3', '2015-03-30 04:55:39', '2015-03-30 04:55:39'),
(552, '2015-03-30 00:00:00', 14, 1, 16, NULL, 1, 'Booking Deleted by:user', '2015-03-30 04:56:05', '2015-03-30 04:56:05'),
(553, '2015-03-30 00:00:00', 13, 1, 16, NULL, 1, 'Booking for:JPL from:2015-03-28 To:2015-03-30', '2015-03-30 04:56:23', '2015-03-30 04:56:23'),
(554, '2015-03-30 00:00:00', 18, 1, 16, NULL, 1, 'Added user:user as primary booker', '2015-03-30 04:56:23', '2015-03-30 04:56:23'),
(555, '2015-03-30 00:00:00', 5, 4, 57, NULL, 1, 'Changed Kit field: AtBranch From:0 To:3', '2015-03-30 04:58:24', '2015-03-30 04:58:24'),
(556, '2015-03-30 00:00:00', 13, 5, 56, NULL, 1, 'Booking for:CPL from:2015-03-28 To:2015-03-30', '2015-03-30 04:59:46', '2015-03-30 04:59:46'),
(557, '2015-03-30 00:00:00', 18, 5, 56, NULL, 1, 'Added user:user as primary booker', '2015-03-30 04:59:46', '2015-03-30 04:59:46'),
(558, '2015-03-30 00:00:00', 5, 5, 56, NULL, 1, 'Changed Kit field: BarcodeNumber From:31221 To:31221810584321', '2015-03-30 08:57:33', '2015-03-30 08:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `LogType`
--

CREATE TABLE `LogType` (
`ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

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

CREATE TABLE `Settings` (
`ID` int(11) NOT NULL,
  `Key` varchar(45) NOT NULL,
  `Value` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Settings`
--

INSERT INTO `Settings` (`ID`, `Key`, `Value`) VALUES
(1, 'HomeLink', 'cmp-395/public/'),
(2, 'ShadowDays', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `realname`, `email`, `home_branch`, `is_admin`, `remember_token`, `updated_at`, `created_at`) VALUES
(1, 'user', '$2y$10$yKhkFzxkvhrgMY7DCXCdAOA2lNIIMDEYw4qnKCTxnpPXplZV7KzgG', 'User', 'Auser.Name@someplace.com', 3, 1, 'PBm4ncrR0lIWNHuasZEjZFKs3qlbvURQBzj6YovFPokvwfxuSCRiNvROpXGd', '2015-03-29 04:57:13', ''),
(2, 'user2', '$2y$10$yKhkFzxkvhrgMY7DCXCdAOA2lNIIMDEYw4qnKCTxnpPXplZV7KzgG', 'User 2', '', 0, 0, 'e9Wz4Ld9eUCVmOw3lfMFxNCokr7iKcVWOGQPxjh0Jfm3yinC9g4DxFcSF3vy', '2015-03-20 16:32:42', ''),
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
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `BookingDetails`
--
ALTER TABLE `BookingDetails`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `Branches`
--
ALTER TABLE `Branches`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `KitContents`
--
ALTER TABLE `KitContents`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=154;
--
-- AUTO_INCREMENT for table `Kits`
--
ALTER TABLE `Kits`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
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
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=559;
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
