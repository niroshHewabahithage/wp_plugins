-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2020 at 11:35 AM
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
-- Database: `new_tevel`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_customer_requests`
--

CREATE TABLE `wp_customer_requests` (
  `id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `sub_service_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` text,
  `gender` text,
  `birth_year` text,
  `birth_month` text,
  `birth_day` text,
  `birth_hour` text,
  `birth_minute` text,
  `birth_place` text,
  `par_name` text,
  `par_gender` text,
  `par_birth_year` text,
  `par_birth_month` text,
  `par_birth_day` text,
  `par_birth_hour` text,
  `par_birth_minute` text,
  `par_birth_place` text,
  `need_partner` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_by` int(11) DEFAULT NULL,
  `edited_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remark` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_customer_requests`
--

INSERT INTO `wp_customer_requests` (`id`, `service_id`, `sub_service_id`, `user_id`, `name`, `gender`, `birth_year`, `birth_month`, `birth_day`, `birth_hour`, `birth_minute`, `birth_place`, `par_name`, `par_gender`, `par_birth_year`, `par_birth_month`, `par_birth_day`, `par_birth_hour`, `par_birth_minute`, `par_birth_place`, `need_partner`, `active`, `created_by`, `created_date`, `edited_by`, `edited_date`, `remark`) VALUES
(2, 1, 9, 14, 'aefaefaefaef', 'female', '2019', 'May', '30', '23', '00', 'aefaefaefaefaef', '', '', '', '', '', '', '', '', 0, 1, NULL, '2020-01-13 10:23:48', NULL, '2020-01-13 10:23:48', NULL),
(3, 2, 0, 14, 'aefaefaefaef', 'female', '2019', 'May', '30', '23', '00', 'aefaefaefaefaef', 'aefeaefaefafaef', 'male', '2012', 'October', '30', '23', '12', 'aefaefaef', 1, 1, NULL, '2020-01-13 10:24:06', NULL, '2020-01-13 10:24:06', NULL),
(4, 2, 0, 13, 'aefaefaefaef', 'female', '2019', 'May', '30', '23', '00', 'aefaefaefaefaef', 'aefeaefaefafaef', 'male', '2012', 'October', '30', '23', '12', 'aefaefaef', 1, 1, NULL, '2020-01-13 10:24:30', NULL, '2020-01-13 10:24:30', NULL),
(5, 1, 10, 13, 'aefaefaefaef', 'female', '2019', 'May', '30', '23', '00', 'aefaefaefaefaef', '', '', '', '', '', '', '', '', 0, 1, NULL, '2020-01-13 10:26:35', NULL, '2020-01-13 10:26:35', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_customer_requests`
--
ALTER TABLE `wp_customer_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_customer_requests`
--
ALTER TABLE `wp_customer_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
