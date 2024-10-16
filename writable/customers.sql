-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 12, 2024 at 06:39 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id22013795_cablagedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `subscription` int(11) NOT NULL,
  `phoneNumber` varchar(25) NOT NULL,
  `address` varchar(25) NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `picture` int(11) NOT NULL,
  `statePayment` enum('BeingPaid','LatePayment','UpToDate') NOT NULL,
  `bankAccount` int(11) NOT NULL,
  `registrationDate` varchar(25) NOT NULL,
  `language` enum('French','English') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `surname`, `subscription`, `phoneNumber`, `address`, `sex`, `picture`, `statePayment`, `bankAccount`, `registrationDate`, `language`) VALUES
(39, 'BAMIS ', 'Frédéric ', 2500, '692833145', 'beedi', 'Male', 2131165263, 'BeingPaid', -2500, '21-05-2024', 'French'),
(40, 'DONGMO', 'moise ', 2500, '694727528', 'beedi', 'Male', 2131165263, 'BeingPaid', -2500, '21-05-2024', 'French');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
