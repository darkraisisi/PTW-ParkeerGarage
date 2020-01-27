-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 27, 2020 at 02:12 PM
-- Server version: 10.3.13-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ptwgarage`
--

-- --------------------------------------------------------

--
-- Table structure for table `parking_garage`
--

CREATE TABLE `parking_garage` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `place` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parking_garage`
--

INSERT INTO `parking_garage` (`id`, `name`, `place`) VALUES
(1, 'Utrecht Centrum', 'Utrecht'),
(2, 'Utrecht Overvecht', 'Utrecht');

-- --------------------------------------------------------

--
-- Table structure for table `parking_spot`
--

CREATE TABLE `parking_spot` (
  `id` int(11) NOT NULL,
  `garage` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `occupation` int(11) NOT NULL,
  `reserve_untill` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parking_spot`
--

INSERT INTO `parking_spot` (`id`, `garage`, `level`, `number`, `occupation`, `reserve_untill`) VALUES
(1, 1, 1, 1, 0, NULL),
(2, 1, 1, 2, 0, NULL),
(3, 1, 1, 3, 0, NULL),
(4, 1, 2, 1, 0, NULL),
(5, 1, 2, 2, 0, NULL),
(6, 1, 2, 3, 0, NULL),
(7, 1, 3, 1, 0, NULL),
(8, 1, 3, 2, 0, NULL),
(9, 1, 3, 3, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parking_garage`
--
ALTER TABLE `parking_garage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parking_spot`
--
ALTER TABLE `parking_spot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `garage_id` (`garage`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parking_garage`
--
ALTER TABLE `parking_garage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parking_spot`
--
ALTER TABLE `parking_spot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parking_spot`
--
ALTER TABLE `parking_spot`
  ADD CONSTRAINT `garage_id` FOREIGN KEY (`garage`) REFERENCES `parking_garage` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
