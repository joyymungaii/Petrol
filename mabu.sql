-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2025 at 07:36 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mabu`
--

-- --------------------------------------------------------

--
-- Table structure for table `diesel`
--

CREATE TABLE `diesel` (
  `id` int(11) NOT NULL,
  `fuel_start` decimal(10,2) NOT NULL,
  `fuel_end` decimal(10,2) NOT NULL,
  `fuel_sold` decimal(10,2) NOT NULL,
  `amount_expected` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diesel`
--

INSERT INTO `diesel` (`id`, `fuel_start`, `fuel_end`, `fuel_sold`, `amount_expected`, `created_at`) VALUES
(1, '76000.00', '32000.00', '44000.00', '7350640.00', '2025-03-29 17:55:19');

-- --------------------------------------------------------

--
-- Table structure for table `kerosene`
--

CREATE TABLE `kerosene` (
  `id` int(11) NOT NULL,
  `fuel_start` decimal(10,2) NOT NULL,
  `fuel_end` decimal(10,2) NOT NULL,
  `fuel_sold` decimal(10,2) NOT NULL,
  `amount_expected` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kerosene`
--

INSERT INTO `kerosene` (`id`, `fuel_start`, `fuel_end`, `fuel_sold`, `amount_expected`, `created_at`) VALUES
(1, '56466.00', '40000.00', '0.00', '0.00', '2025-03-29 17:20:26'),
(2, '20000.00', '500.00', '0.00', '0.00', '2025-03-29 17:25:07'),
(3, '50000.00', '15000.00', '35000.00', '5298650.00', '2025-03-29 17:48:16'),
(4, '80000.00', '15000.00', '65000.00', '9840350.00', '2025-03-29 17:48:50');

-- --------------------------------------------------------

--
-- Table structure for table `petrol`
--

CREATE TABLE `petrol` (
  `id` int(11) NOT NULL,
  `fuel_start` decimal(10,2) NOT NULL,
  `fuel_end` decimal(10,2) NOT NULL,
  `fuel_sold` decimal(10,2) NOT NULL,
  `amount_expected` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petrol`
--

INSERT INTO `petrol` (`id`, `fuel_start`, `fuel_end`, `fuel_sold`, `amount_expected`, `created_at`) VALUES
(1, '76000.00', '45000.00', '31000.00', '5473980.00', '2025-03-29 18:02:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`) VALUES
(1, 'Kevin Mungai Munene', 'plug', '$2y$10$ILOylvCTIxT9gkSNEb9aHegjgoP0Rp3f6Hrif9jfjXO1wd5f3KYV6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diesel`
--
ALTER TABLE `diesel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kerosene`
--
ALTER TABLE `kerosene`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petrol`
--
ALTER TABLE `petrol`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diesel`
--
ALTER TABLE `diesel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kerosene`
--
ALTER TABLE `kerosene`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `petrol`
--
ALTER TABLE `petrol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
