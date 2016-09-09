-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 16, 2016 at 09:07 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uscert`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `datetime_in` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datetime_out` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `datetime_in`, `datetime_out`) VALUES
(15, 5, '2016-07-24 00:01:00', '2016-07-24 14:50:50'),
(16, 4, '2016-07-24 14:44:45', '2016-07-24 14:50:35'),
(17, 6, '2016-07-24 14:50:52', '2016-07-24 14:55:23'),
(18, 5, '2016-07-28 01:18:22', '0000-00-00 00:00:00'),
(19, 4, '2016-08-08 06:56:59', '2016-08-08 06:58:16'),
(20, 5, '2016-08-08 06:58:18', '2016-08-08 14:00:00'),
(21, 5, '2016-08-12 01:02:00', '2016-08-12 05:00:00'),
(22, 5, '2016-08-14 00:18:00', '2016-08-14 15:54:19'),
(23, 4, '2016-08-14 13:16:02', '2016-08-14 14:03:14'),
(24, 6, '2016-08-14 15:48:12', '2016-08-14 15:53:25');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE IF NOT EXISTS `organizations` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `acronym` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `acronym`) VALUES
(4, 'Sample Name', 'SN'),
(5, 'Sample Name 2', 'SN2'),
(6, 'Sample Name 3', 'SN3');

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE IF NOT EXISTS `persons` (
  `id` int(10) unsigned NOT NULL,
  `firstname` varchar(45) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(45) COLLATE utf8_bin NOT NULL,
  `gender` enum('MALE','FEMALE') COLLATE utf8_bin NOT NULL,
  `birthdate` date NOT NULL DEFAULT '0000-00-00',
  `nationality` varchar(45) COLLATE utf8_bin NOT NULL,
  `contact_number` varchar(45) COLLATE utf8_bin NOT NULL,
  `address` text COLLATE utf8_bin NOT NULL,
  `course` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `skills` text COLLATE utf8_bin
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`id`, `firstname`, `lastname`, `gender`, `birthdate`, `nationality`, `contact_number`, `address`, `course`, `skills`) VALUES
(1, 'Adrian', 'Natabio', 'MALE', '1995-06-20', 'Filipino', '', 'mandaue ity', '123', '213'),
(2, 'Harry', 'Wells', 'MALE', '1962-02-10', 'American', '', 'Seattle, New Jersey', 'BS CpE', 'Hukad kan-on');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `login_username` varchar(45) COLLATE utf8_bin NOT NULL,
  `login_password` varchar(45) COLLATE utf8_bin NOT NULL,
  `login_type` enum('v','a','sa') COLLATE utf8_bin NOT NULL DEFAULT 'v',
  `person_id` int(10) unsigned DEFAULT NULL,
  `organization_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login_username`, `login_password`, `login_type`, `person_id`, `organization_id`) VALUES
(1, 'gwapoko1', '6ef5b8e14f85b79ea0c56e78fdd4779e', 'a', NULL, 6),
(2, 'gwapoko', '8c4205ec33d8f6caeaaaa0c10a14138c', 'a', NULL, 6),
(4, 'adriannatabio', '5f4dcc3b5aa765d61d8327deb882cf99', 'sa', 1, NULL),
(5, 'admin', '8c4205ec33d8f6caeaaaa0c10a14138c', 'a', 2, 6),
(6, 'volun', '9e0b11af3b94614b4508bc6d85d3790f', 'v', NULL, 6),
(7, 'teer', '9e0b11af3b94614b4508bc6d85d3790f', 'v', NULL, 5),
(8, 'admin2', 'c84258e9c39059a89ab77d846ddab909', 'a', NULL, 4),
(9, 'helloworld', '8c4205ec33d8f6caeaaaa0c10a14138c', 'v', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `vehicle_type_id` int(10) unsigned NOT NULL,
  `organization_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `name`, `vehicle_type_id`, `organization_id`) VALUES
(1, 'sadsad', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

CREATE TABLE IF NOT EXISTS `vehicle_types` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`id`, `name`) VALUES
(1, 'Ambulance'),
(2, 'Firetruck');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_user_id_foreign_idx` (`user_id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_username_UNIQUE` (`login_username`),
  ADD KEY `users_person_id_foreign_idx` (`person_id`),
  ADD KEY `users_organization_id_foreign_idx` (`organization_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `vehicles_vehicle_type_id_foreign_idx` (`vehicle_type_id`),
  ADD KEY `vehicles_organization_id_foreign_idx` (`organization_id`);

--
-- Indexes for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `vehicles_vehicle_type_id_foreign` FOREIGN KEY (`vehicle_type_id`) REFERENCES `vehicle_types` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
