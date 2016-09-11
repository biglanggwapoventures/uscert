ALTER TABLE `uscert`.`incident_reports` 
CHANGE COLUMN `longitude` `longitude` DECIMAL(9,6) NOT NULL COMMENT '' ,
CHANGE COLUMN `latitude` `latitude` DECIMAL(9,6) NOT NULL COMMENT '' ,
CHANGE COLUMN `approved_at` `approved_at` TIMESTAMP NOT NULL DEFAULT 0 COMMENT '' ,
ADD COLUMN `rejected_by` INT UNSIGNED NULL COMMENT '' AFTER `approved_at`,
ADD COLUMN `rejected_at` TIMESTAMP NOT NULL DEFAULT 0 COMMENT '' AFTER `rejected_by`,
ADD INDEX `incident_reports_rejected_by_foreign_idx` (`rejected_by` ASC)  COMMENT '';
ALTER TABLE `uscert`.`incident_reports` 
ADD CONSTRAINT `incident_reports_rejected_by_foreign`
  FOREIGN KEY (`rejected_by`)
  REFERENCES `uscert`.`users` (`id`)
  ON DELETE RESTRICT
  ON UPDATE CASCADE;


ALTER TABLE `uscert`.`incident_reports` 
ADD COLUMN `vehicles_used` TEXT NULL COMMENT '' AFTER `investigator`;

-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 11, 2016 at 07:20 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `uscert`
--

-- --------------------------------------------------------

--
-- Table structure for table `map_markers`
--

CREATE TABLE IF NOT EXISTS `map_markers` (
  `id` int(10) unsigned NOT NULL,
  `latitude` decimal(9,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  `formatted_address` varchar(255) COLLATE utf8_bin NOT NULL,
  `status` enum('0','1') COLLATE utf8_bin NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `map_markers`
--
ALTER TABLE `map_markers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `map_markers`
--
ALTER TABLE `map_markers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;