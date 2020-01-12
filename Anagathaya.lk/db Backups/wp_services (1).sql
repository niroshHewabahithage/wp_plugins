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
-- Table structure for table `wp_services`
--

CREATE TABLE `wp_services` (
  `id` int(11) NOT NULL,
  `service_name_si` text CHARACTER SET utf8 DEFAULT NULL,
  `service_name_en` text DEFAULT NULL,
  `service_price` text DEFAULT NULL,
  `is_multiple` int(11) DEFAULT 0,
  `active` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `edited_by` int(11) DEFAULT NULL,
  `edited_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_services`
--

INSERT INTO `wp_services` (`id`, `service_name_si`, `service_name_en`, `service_price`, `is_multiple`, `active`, `created_by`, `created_date`, `edited_by`, `edited_date`, `remark`) VALUES
(1, 'ඵලාපල බැලීම (කේන්දර සැකසීම හා පරික්ෂාව )', 'Horrescope', '1500', 0, 1, NULL, '2019-12-10 22:32:53', NULL, '2019-12-10 22:32:53', NULL),
(2, 'පොරොන්දම් බැලීම ', 'Matching Horrescope', '1500', 1, 1, NULL, '2019-12-10 22:33:45', NULL, '2020-01-12 03:42:04', NULL),
(3, 'නැකත් සකස් කිරීම ', 'Naketh Time', '1500', 0, 1, NULL, '2019-12-10 22:34:26', NULL, '2019-12-10 22:34:26', NULL),
(4, 'නම් තැබීම ', 'Naming', '5000', 0, 1, NULL, '2019-12-10 22:34:52', NULL, '2019-12-10 22:34:52', NULL);

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
