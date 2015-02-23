-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Feb 20, 2015 at 03:13 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 0, 'EPLABB', 'Abbottsfield - Penny McKee Branch', '3410 - 118 Avenue  T5W 0Z4', '780-496-7839', 53.5704, -113.392, '', ''),
(2, 0, 'EPLCAL', 'Calder Branch', '12522 - 132 Avenue, T5L 3P9', '780-496-7090', 53.5922, -113.539, '', ''),
(3, 0, 'EPLCPL', 'Capilano Branch', '201 Capilano Mall, 5004 - 98 Avenue,T6A 0A1', '780-496-1802', 53.5379, -113.42, '', ''),
(4, 0, 'EPLCSD', 'Castle Downs Branch', '106 Lakeside Landing, 15379 Castle Downs Rd, T5X 3Y7', '780-496-1804', 53.6157, -113.517, '', ''),
(5, 0, 'EPLCLV', 'Clareview Branch', '3808 - 139 Avenue, T5Y 3E7', '780-442-7471', 53.6013, -113.402, '', ''),
(6, 0, 'EPLHIG', 'Highlands Branch', '6710 - 118 Avenue, T5B 0P3', '780-496-1806', 53.5706, -113.445, '', ''),
(7, 0, 'EPLIDY', 'Idylwylde Branch', '8310 88 Avenue, T6C 1L1', '780-496-1808', 53.5235, -113.459, '', ''),
(8, 0, 'EPLJPL', 'Jasper Place Branch', '9010 - 156 Street, T5R 5X7', '780-496-1810', 53.5232, -113.59, '', ''),
(9, 0, 'EPLLHL', 'Lois Hole Library', '17650 69 Avenue, T5T 3X9', '780-442-0888', 53.5038, -113.626, '', ''),
(10, 0, 'EPLLON', 'Londonderry Branch', '110 Londonderry Mall, 137 Avenue &amp; 66 Street, T5C 3C8', '780-496-1814', 53.6034, -113.446, '', ''),
(11, 0, 'EPLGMU', 'MacEwan University Lending Machine', '10700 - 104 Avenue, T5J 4S2', ' ', 53.5467, -113.505, '', ''),
(12, 0, 'EPLMEA', 'Meadows Branch', '2704 - 17 Street, T6T 0X1', '780-442-7472', 53.469, -113.369, '', ''),
(13, 0, 'EPLMLW', 'Mill Woods Branch', '601 Mill Woods Town Centre, 2331 - 66 Street, T6K 4B5', '780-496-1818', 53.4554, -113.434, '', ''),
(14, 0, 'EPLRIV', 'Riverbend Branch', '460 Riverbend Square, Rabbit Hill Road &amp; Terwillegar Drive, T6R 2X2', '780-944-5311', 53.4684, -113.584, '', ''),
(15, 0, 'EPLSPW', 'Sprucewood Branch', '11555 - 95 Street, T5G 1L5', '780-496-7099', 53.5667, -113.487, '', ''),
(16, 0, 'EPLMNA', 'Stanley A. Milner Library (Downtown)', '7 Sir Winston Churchill Square, T5J 2V4', '780-496-7000', 53.5432, -113.49, '', ''),
(17, 0, 'EPLSTR', 'Strathcona Branch', '8331 - 104 Street, T6E 4E9', '780-496-1828', 53.5195, -113.497, '', ''),
(18, 0, 'EPLWMC', 'Whitemud Crossing Branch', '145 Whitemud Crossing Shopping Centre, 4211 - 106 Street, T6J 6L7', '780-496-1822', 53.4795, -113.504, '', ''),
(19, 0, 'EPLWOO', 'Woodcroft Branch', '13420 - 114 Avenue, T5M 2Y5', '780-496-1830', 53.5638, -113.554, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `KitContents`
--

CREATE TABLE `KitContents` (
`ID` int(11) NOT NULL,
  `KitID` int(11) NOT NULL,
  `Name` tinytext NOT NULL,
  `SerialNumber` tinytext,
  `Damaged` tinyint(1) NOT NULL DEFAULT '0',
  `Missing` tinyint(1) NOT NULL DEFAULT '0',
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

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
(11, 2, 'Ipad #1', '11111', 0, 0, NULL, NULL),
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
(28, 3, '8-slot power bar', 'na', 0, 0, NULL, NULL);

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
  `Specialized` tinyint(1) NOT NULL DEFAULT '0',
  `SecializedName` tinytext,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Kits`
--

INSERT INTO `Kits` (`ID`, `KitType`, `Name`, `AtBranch`, `Available`, `KitState`, `KitDesc`, `Specialized`, `SecializedName`, `updated_at`, `created_at`) VALUES
(1, 1, 'Kit #1', 1, 1, 1, 'A kit of 6 ipad 2''s with ESL programs', 1, 'ESL Tutor', NULL, NULL),
(2, 1, 'Kit #2', 1, 1, 1, 'A Kit of 6 Ipad ''2', 0, NULL, NULL, NULL),
(3, 2, 'Kit #1', 3, 1, 1, '6Laptops with 15" screens', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `KitState`
--

CREATE TABLE `KitState` (
`ID` int(11) NOT NULL,
  `StateName` tinytext,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `KitState`
--

INSERT INTO `KitState` (`ID`, `StateName`, `updated_at`, `created_at`) VALUES
(1, 'Good', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `KitTypes`
--

CREATE TABLE `KitTypes` (
`ID` int(11) NOT NULL,
  `Name` tinytext NOT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `KitTypes`
--

INSERT INTO `KitTypes` (`ID`, `Name`, `updated_at`, `created_at`) VALUES
(1, 'Ipad 2', NULL, NULL),
(2, 'HP Laptop', NULL, NULL),
(3, 'Ipad Mini', NULL, NULL),
(4, 'Raspberry PI 2', NULL, NULL);

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
  `LogUserID` int(11) NOT NULL,
  `LogMessage` text NOT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Logs`
--

INSERT INTO `Logs` (`ID`, `LogDate`, `LogType`, `LogKey1`, `LogKey2`, `LogUserID`, `LogMessage`, `updated_at`, `created_at`) VALUES
(1, '2015-02-19 00:00:00', 1, 1, 1, 1, 'blass', '2015-02-19 14:48:51', '2015-02-19 14:48:51'),
(4, '2015-02-19 00:00:00', 4, 1, NULL, 1, 'A new Kit was created', '2015-02-19 15:13:39', '2015-02-19 15:13:39'),
(5, '2015-02-19 00:00:00', 4, 1, NULL, 1, 'A new Kit was created', '2015-02-19 15:17:51', '2015-02-19 15:17:51'),
(6, '2015-02-19 00:00:00', 4, 1, NULL, 1, 'A new Kit was created', '2015-02-19 15:18:07', '2015-02-19 15:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `LogType`
--

CREATE TABLE `LogType` (
`ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

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
(17, 'Kit Transfer Received', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
`id` int(11) NOT NULL,
  `username` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `realname` tinytext NOT NULL,
  `rememberToken` text,
  `updated_at` tinytext NOT NULL,
  `created_at` tinytext NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `realname`, `rememberToken`, `updated_at`, `created_at`, `is_admin`) VALUES
(1, 'user', '$2y$10$yKhkFzxkvhrgMY7DCXCdAOA2lNIIMDEYw4qnKCTxnpPXplZV7KzgG', 'User', NULL, '', '', 1);

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
 ADD PRIMARY KEY (`ID`), ADD KEY `Logs_users_idx` (`LogUserID`), ADD KEY `Logs_LogType_idx` (`LogType`), ADD KEY `Logs_Type_Keys_idx` (`LogType`,`LogKey1`,`LogKey2`);

--
-- Indexes for table `LogType`
--
ALTER TABLE `LogType`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Booking`
--
ALTER TABLE `Booking`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `BookingDetails`
--
ALTER TABLE `BookingDetails`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Branches`
--
ALTER TABLE `Branches`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `KitContents`
--
ALTER TABLE `KitContents`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `Kits`
--
ALTER TABLE `Kits`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `KitState`
--
ALTER TABLE `KitState`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `KitTypes`
--
ALTER TABLE `KitTypes`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Logs`
--
ALTER TABLE `Logs`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `LogType`
--
ALTER TABLE `LogType`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
