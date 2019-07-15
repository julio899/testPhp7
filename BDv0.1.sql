-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 15, 2019 at 01:30 PM
-- Server version: 5.7.21-1
-- PHP Version: 7.2.4-1+b1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `julio899`
--
CREATE DATABASE IF NOT EXISTS `julio899` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `julio899`;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'A',
  `price` float NOT NULL,
  `score` text COLLATE utf8_spanish_ci NOT NULL,
  `stars` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `status`, `price`, `score`, `stars`) VALUES
(1, 'Stacy Adams Men\'s', 'The men\'s Vale Plain Toe Slip-On dress shoe features a patent upper, leather linings.', 'A', 125.5, '{\"star-1\":3,\"star-2\":0,\"star-3\":0,\"star-4\":0,\"star-5\":3}', 0),
(2, 'apple', '', 'A', 0.3, '{\"star-1\":3,\"star-2\":4,\"star-3\":1,\"star-4\":0,\"star-5\":13}', 0),
(3, 'beer', '', 'A', 2, '{\"star-1\":3,\"star-2\":0,\"star-3\":0,\"star-4\":0,\"star-5\":0}', 0),
(4, 'water', '', 'A', 1, '{\"star-1\":3,\"star-2\":0,\"star-3\":0,\"star-4\":0,\"star-5\":3}', 0),
(5, 'cheese', '', 'A', 3.75, '{\"star-1\":0,\"star-2\":0,\"star-3\":0,\"star-4\":0,\"star-5\":0}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `status` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `type` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `balance` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`, `type`, `balance`) VALUES
(1, 'julio899@gmail.com', '51c30cf5b566235f70673a8092853fa4b0bb60e4', 'active', 'A', 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
