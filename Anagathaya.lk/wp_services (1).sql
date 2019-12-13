-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2019 at 04:11 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anagathaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_services`
--

CREATE TABLE `wp_services` (
  `id` int(11) NOT NULL,
  `service_name_si` text CHARACTER SET utf8,
  `service_name_en` text,
  `service_price` text,
  `active` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_by` int(11) DEFAULT NULL,
  `edited_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remark` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_services`
--

INSERT INTO `wp_services` (`id`, `service_name_si`, `service_name_en`, `service_price`, `active`, `created_by`, `created_date`, `edited_by`, `edited_date`, `remark`) VALUES
(1, 'ඵලාපල බැලිම(කේන්දර සැකසීම හා පරික්ෂාව)', 'Horrescope', '500', 1, NULL, '2019-12-09 06:35:54', NULL, '2019-12-09 11:58:46', NULL),
(2, 'පොරොන්දම් බැලීම ', 'Matching Horoscope', '1500', 1, NULL, '2019-12-09 09:50:05', NULL, '2019-12-09 11:58:57', NULL),
(4, 'නම් තැබීම ', 'Naming', '5000', 1, NULL, '2019-12-09 09:51:36', NULL, '2019-12-09 09:51:36', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_services`
--
ALTER TABLE `wp_services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_services`
--
ALTER TABLE `wp_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
