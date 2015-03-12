-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Mar 12, 2015 at 02:48 AM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `EPL_KIT_DB`
--

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
(1, 'user', '$2y$10$yKhkFzxkvhrgMY7DCXCdAOA2lNIIMDEYw4qnKCTxnpPXplZV7KzgG', 'User', NULL, 3, 1, 'Og66mtVKyYOalKH8jS3XIhUcnydWkW6UNbzO09GTcmTRRSq6i9PkfAp7DQja', '2015-03-12 01:47:34', ''),
(2, 'user2', '$2y$10$yKhkFzxkvhrgMY7DCXCdAOA2lNIIMDEYw4qnKCTxnpPXplZV7KzgG', 'User 2', '', 0, 0, NULL, '2015-03-09 19:30:23', ''),
(3, '<redacted>', '$2y$10$yKhkFzxkvhrgMY7DCXCdAOA2lNIIMDEYw4qnKCTxnpPXplZV7KzgG', 'The all mighty git.', 'god@heaven.org', 7, 0, NULL, '2015-03-09 19:29:28', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD KEY `user-home_branch_idx` (`home_branch`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `user-home_branch` FOREIGN KEY (`home_branch`) REFERENCES `Branches` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
