-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2019 at 12:56 AM
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
-- Table structure for table `wp_service_map`
--

CREATE TABLE `wp_service_map` (
  `id` int(11) NOT NULL,
  `is_user` int(11) DEFAULT NULL,
  `id_service` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `edited_by` int(11) DEFAULT NULL,
  `edited_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_service_map`
--

INSERT INTO `wp_service_map` (`id`, `is_user`, `id_service`, `active`, `created_by`, `created_date`, `edited_by`, `edited_date`, `remark`) VALUES
(21, 10, 1, 1, NULL, '2019-12-19 19:05:38', NULL, '2019-12-19 19:05:38', NULL),
(22, 10, 3, 1, NULL, '2019-12-19 19:05:38', NULL, '2019-12-19 19:05:38', NULL),
(23, 10, 4, 1, NULL, '2019-12-19 19:05:38', NULL, '2019-12-19 19:05:38', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_service_map`
--
ALTER TABLE `wp_service_map`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_service_map`
--
ALTER TABLE `wp_service_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
