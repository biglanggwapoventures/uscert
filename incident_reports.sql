-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 09, 2016 at 02:00 PM
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
-- Table structure for table `incident_reports`
--

CREATE TABLE IF NOT EXISTS `incident_reports` (
  `id` int(10) unsigned NOT NULL,
  `incident_type` enum('FIRE','FLOOD','EARTHQUAKE','CRASH') COLLATE utf8_bin NOT NULL,
  `incident_date` date NOT NULL DEFAULT '0000-00-00',
  `actions_taken` text COLLATE utf8_bin NOT NULL,
  `other_information` text COLLATE utf8_bin NOT NULL,
  `alarm` varchar(50) COLLATE utf8_bin NOT NULL,
  `casualty` text COLLATE utf8_bin NOT NULL,
  `investigator` varchar(100) COLLATE utf8_bin NOT NULL,
  `structures_involved` text COLLATE utf8_bin,
  `estimated_damage` float NOT NULL DEFAULT '0',
  `cause` text COLLATE utf8_bin NOT NULL,
  `key_details` text COLLATE utf8_bin,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `formatted_address` varchar(100) COLLATE utf8_bin NOT NULL,
  `zoom` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approved_by` int(10) unsigned DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `incident_reports`
--
ALTER TABLE `incident_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incident_reports_created_by_foreign_idx` (`created_by`),
  ADD KEY `incident_reports_approved_by_foreign_idx` (`approved_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incident_reports`
--
ALTER TABLE `incident_reports`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `incident_reports`
--
ALTER TABLE `incident_reports`
  ADD CONSTRAINT `incident_reports_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `incident_reports_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
