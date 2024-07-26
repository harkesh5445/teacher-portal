-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2024 at 11:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teacher_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `marks` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `teacher_id`, `name`, `subject`, `marks`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'ram', 'physics', '80', 1, '2024-07-26 12:58:24', '2024-07-26 12:58:24'),
(3, 1, 'gngfn', 'gfnjgn', '77', 0, '2024-07-26 13:00:03', '2024-07-26 13:00:03'),
(4, 1, 'sbgfd', 'dfnjhmn65', '66', 0, '2024-07-26 13:05:40', '2024-07-26 13:05:40'),
(5, 1, 'fgjn fg', 'nggf', '100', 0, '2024-07-26 13:05:57', '2024-07-26 13:05:57'),
(6, 1, 'shyam', 'chemystry', '50', 1, '2024-07-26 14:46:11', '2024-07-26 14:46:11'),
(7, 1, 'ravi', 'cs', '60', 1, '2024-07-26 14:48:22', '2024-07-26 14:48:22'),
(8, 1, 'guru', 'mechanics', '70', 1, '2024-07-26 14:49:47', '2024-07-26 14:49:47'),
(9, 1, 'anil', 'economic', '65', 1, '2024-07-26 14:50:19', '2024-07-26 14:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `isDeleted` int(2) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `username`, `password`, `status`, `isDeleted`, `created_at`, `updated_at`) VALUES
(1, 'teailwebs', 'tailwebs@user', '$2y$10$SwmKAWY5IQZ.DTNpaUsJze1j.Hvn/hq7pxv5rBFOok3Ags2B9880K', 1, 0, '2024-07-26 10:52:13', '2024-07-26 10:52:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
