-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Feb 18, 2015 at 09:15 PM
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
CREATE TABLE IF NOT EXISTS `Booking` (
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

DROP TABLE IF EXISTS `BookingDetails`;
CREATE TABLE IF NOT EXISTS `BookingDetails` (
`ID` int(11) NOT NULL,
  `BookingID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Email` tinytext,
  `Booker` bit(1) NOT NULL DEFAULT b'1',
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Branches`
--

DROP TABLE IF EXISTS `Branches`;
CREATE TABLE IF NOT EXISTS `Branches` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `KitContents`
--

DROP TABLE IF EXISTS `KitContents`;
CREATE TABLE IF NOT EXISTS `KitContents` (
`ID` int(11) NOT NULL,
  `KitID` int(11) NOT NULL,
  `Name` tinytext NOT NULL,
  `SerialNumber` tinytext,
  `Damaged` bit(1) NOT NULL DEFAULT b'0',
  `Missing` bit(1) NOT NULL DEFAULT b'0',
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Kits`
--

DROP TABLE IF EXISTS `Kits`;
CREATE TABLE IF NOT EXISTS `Kits` (
`ID` int(11) NOT NULL,
  `KitType` int(11) NOT NULL,
  `Name` tinytext NOT NULL,
  `AtBranch` int(11) NOT NULL,
  `Available` bit(1) NOT NULL DEFAULT b'1',
  `KitState` int(11) NOT NULL,
  `KitDesc` text NOT NULL,
  `Specialized` bit(1) NOT NULL DEFAULT b'0',
  `SecializedName` tinytext,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `KitState`
--

DROP TABLE IF EXISTS `KitState`;
CREATE TABLE IF NOT EXISTS `KitState` (
`ID` int(11) NOT NULL,
  `StateName` tinytext,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `KitTypes`
--

DROP TABLE IF EXISTS `KitTypes`;
CREATE TABLE IF NOT EXISTS `KitTypes` (
`ID` int(11) NOT NULL,
  `Name` tinytext NOT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Logs`
--

DROP TABLE IF EXISTS `Logs`;
CREATE TABLE IF NOT EXISTS `Logs` (
`ID` int(11) NOT NULL,
  `LogDate` datetime NOT NULL,
  `LogType` int(11) NOT NULL,
  `LogKey1` int(11) NOT NULL,
  `LogKey2` int(11) DEFAULT NULL,
  `LogUserID` int(11) NOT NULL,
  `LogMessage` text NOT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `LogType`
--

DROP TABLE IF EXISTS `LogType`;
CREATE TABLE IF NOT EXISTS `LogType` (
`ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `realname` tinytext NOT NULL,
  `rememberToken` text,
  `updated_at` tinytext NOT NULL,
  `created_at` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
 ADD PRIMARY KEY (`ID`), ADD KEY `Logs_users_idx` (`LogUserID`), ADD KEY `Logs_LogType_idx` (`LogType`);

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
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `KitContents`
--
ALTER TABLE `KitContents`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Kits`
--
ALTER TABLE `Kits`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `KitState`
--
ALTER TABLE `KitState`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `KitTypes`
--
ALTER TABLE `KitTypes`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Logs`
--
ALTER TABLE `Logs`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `LogType`
--
ALTER TABLE `LogType`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
ADD CONSTRAINT `Logs_LogType` FOREIGN KEY (`LogType`) REFERENCES `Logs` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `Logs_users` FOREIGN KEY (`LogUserID`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
