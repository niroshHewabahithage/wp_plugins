-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2020 at 09:43 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jetwing_holidays`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_sub_services`
--

CREATE TABLE `wp_sub_services` (
  `id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `sub_service_sinhala` text CHARACTER SET utf8 DEFAULT NULL,
  `sub_service_english` text DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `edited_by` int(11) DEFAULT NULL,
  `edited_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_sub_services`
--

INSERT INTO `wp_sub_services` (`id`, `service_id`, `sub_service_sinhala`, `sub_service_english`, `active`, `created_by`, `created_date`, `edited_by`, `edited_date`, `remark`) VALUES
(9, 1, 'සමාජ තත්ත්වය ', 'Sample Data', 1, NULL, '2020-01-12 03:11:12', NULL, '2020-01-12 03:11:12', NULL),
(10, 1, 'සමාජ තත්ත්වය 1', 'Sample Data1', 1, NULL, '2020-01-12 03:11:19', NULL, '2020-01-12 03:11:19', NULL),
(11, 1, 'සමාජ තත්ත්වය 2', 'Sample Data2', 1, NULL, '2020-01-12 03:11:28', NULL, '2020-01-12 03:11:28', NULL),
(12, 3, 'සමාජ තත්ත්වය 2', 'Sample Data1', 1, NULL, '2020-01-12 03:11:42', NULL, '2020-01-12 03:11:42', NULL),
(13, 3, 'සමාජ තත්ත්වය 3', 'Sample Data3', 1, NULL, '2020-01-12 03:11:49', NULL, '2020-01-12 03:11:49', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_sub_services`
--
ALTER TABLE `wp_sub_services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_sub_services`
--
ALTER TABLE `wp_sub_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
