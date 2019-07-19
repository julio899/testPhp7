-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 19, 2019 at 01:19 AM
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
-- Database: `app_php7`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `itens` text COLLATE utf8_spanish_ci NOT NULL,
  `idUser` int(10) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(10) NOT NULL DEFAULT '1',
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `itens`, `idUser`, `date`, `status`, `total`) VALUES
(7, '[{\"name\":\"cheese\",\"price\":\"3.75\",\"id\":\"5\"},{\"name\":\"beer\",\"price\":\"2\",\"id\":\"3\"},{\"name\":\"water\",\"price\":\"1\",\"id\":\"4\"}]', 1, '2019-07-16 13:42:18', 1, 6.75),
(8, '[{\"name\":\"apple\",\"price\":\"0.3\",\"id\":\"2\"}]', 1, '2019-07-16 14:01:47', 1, 0.3),
(9, '[{\"name\":\"water\",\"price\":\"1\",\"id\":\"4\"},{\"name\":\"beer\",\"price\":\"2\",\"id\":\"3\"}]', 1, '2019-07-16 15:06:59', 1, 3),
(10, '[{\"name\":\"cheese\",\"price\":\"3.75\",\"id\":\"5\"}]', 1, '2019-07-16 15:07:17', 1, 3.75),
(11, '[{\"name\":\"cheese\",\"price\":\"3.75\",\"id\":\"5\"}]', 1, '2019-07-16 15:07:41', 1, 3.75),
(12, '[{\"name\":\"water\",\"price\":\"1\",\"id\":\"4\"},{\"name\":\"apple\",\"price\":\"0.3\",\"id\":\"2\"}]', 1, '2019-07-16 15:08:23', 1, 1.3),
(13, '[{\"name\":\"water\",\"price\":\"1\",\"id\":\"4\"}]', 1, '2019-07-16 15:17:05', 1, 1),
(14, '[{\"name\":\"water\",\"price\":\"1\",\"id\":\"4\"}]', 1, '2019-07-16 15:18:25', 1, 1),
(15, '[{\"name\":\"water\",\"price\":\"1\",\"id\":\"4\"}]', 1, '2019-07-16 15:19:42', 1, 1),
(16, '[{\"name\":\"beer\",\"price\":\"2\",\"id\":\"3\"}]', 1, '2019-07-16 15:19:55', 1, 2),
(17, '[{\"name\":\"beer\",\"price\":\"2\",\"id\":\"3\"}]', 1, '2019-07-16 15:20:51', 1, 2),
(18, '[{\"name\":\"cheese\",\"price\":\"3.75\",\"id\":\"5\"}]', 1, '2019-07-16 15:23:11', 1, 3.75),
(19, '[{\"name\":\"apple\",\"price\":\"0.3\",\"id\":\"2\"},{\"name\":\"beer\",\"price\":\"2\",\"id\":\"3\"}]', 1, '2019-07-16 22:18:16', 1, 2.3),
(20, '[{\"name\":\"beer\",\"price\":\"2\",\"id\":\"3\"}]', 1, '2019-07-16 22:51:21', 1, 2),
(21, '[{\"name\":\"apple\",\"price\":\"0.3\",\"id\":\"2\"},{\"name\":\"water\",\"price\":\"1\",\"id\":\"4\"}]', 1, '2019-07-16 22:51:51', 1, 1.3),
(22, '[{\"name\":\"water\",\"price\":\"1\",\"id\":\"4\"},{\"name\":\"beer\",\"price\":\"2\",\"id\":\"3\"},{\"name\":\"apple\",\"price\":\"0.3\",\"id\":\"2\"}]', 1, '2019-07-16 22:54:35', 1, 3.3),
(23, '[{\"name\":\"beer\",\"price\":\"2\",\"id\":\"3\"}]', 1, '2019-07-17 00:12:42', 1, 2),
(24, '[{\"name\":\"beer\",\"price\":\"2\",\"id\":\"3\"}]', 1, '2019-07-17 11:48:49', 1, 2),
(25, '[{\"name\":\"beer\",\"price\":\"2\",\"id\":\"3\"}]', 1, '2019-07-17 11:49:55', 1, 2),
(26, '[{\"name\":\"beer\",\"price\":\"2\",\"id\":\"3\"}]', 1, '2019-07-17 11:50:16', 1, 2),
(27, '[{\"name\":\"beer\",\"price\":\"2\",\"id\":\"3\"}]', 1, '2019-07-17 12:18:23', 1, 2),
(28, '[{\"name\":\"apple\",\"price\":\"0.3\",\"id\":\"2\"}]', 1, '2019-07-17 12:24:26', 1, 0.3),
(29, '[{\"name\":\"beer\",\"price\":\"2\",\"id\":\"3\"}]', 1, '2019-07-17 12:24:49', 1, 2),
(30, '[{\"name\":\"beer\",\"price\":\"2\",\"id\":\"3\"}]', 1, '2019-07-17 17:01:52', 1, 2),
(31, '[{\"name\":\"water\",\"price\":\"1\",\"id\":\"4\"}]', 1, '2019-07-17 17:18:24', 1, 1),
(32, '[{\"name\":\"cheese\",\"price\":\"3.75\",\"id\":\"5\"}]', 1, '2019-07-17 17:28:05', 1, 3.75),
(33, '[{\"name\":\"cheese\",\"price\":\"3.75\",\"id\":\"5\"},{\"name\":\"cheese\",\"price\":\"3.75\",\"id\":\"5\"}]', 1, '2019-07-18 00:23:38', 1, 7.5),
(34, '[{\"name\":\"apple\",\"price\":\"0.3\",\"id\":\"2\"}]', 2, '2019-07-18 18:29:29', 1, 0.3),
(35, '[{\"name\":\"apple\",\"price\":\"0.3\",\"id\":\"2\"}]', 1, '2019-07-18 19:46:36', 1, 0.3),
(36, '[{\"name\":\"water\",\"price\":\"1\",\"id\":\"4\"},{\"name\":\"beer\",\"price\":\"2\",\"id\":\"3\"}]', 3, '2019-07-18 23:19:55', 1, 3),
(37, '[{\"name\":\"apple\",\"price\":\"0.3\",\"id\":\"2\"},{\"name\":\"water\",\"price\":\"1\",\"id\":\"4\"},{\"name\":\"apple\",\"price\":\"0.3\",\"id\":\"2\"}]', 1, '2019-07-18 23:38:01', 1, 1.6),
(38, '[{\"name\":\"water\",\"price\":\"1\",\"id\":\"4\"}]', 1, '2019-07-18 23:45:49', 1, 1),
(39, '[{\"name\":\"apple\",\"price\":\"0.3\",\"id\":\"2\"}]', 1, '2019-07-18 23:49:25', 1, 0.3),
(40, '[{\"name\":\"water\",\"price\":\"1\",\"id\":\"4\"}]', 1, '2019-07-18 23:49:47', 1, 1),
(41, '[{\"name\":\"apple\",\"price\":\"0.3\",\"id\":\"2\"}]', 1, '2019-07-18 23:52:16', 1, 0.3),
(42, '[{\"name\":\"apple\",\"price\":\"0.3\",\"id\":\"2\"}]', 1, '2019-07-18 23:54:06', 1, 0.3),
(43, '[{\"name\":\"apple\",\"price\":\"0.3\",\"id\":\"2\"}]', 1, '2019-07-18 23:56:25', 1, 0.3),
(44, '[{\"name\":\"apple\",\"price\":\"0.3\",\"id\":\"2\"},{\"name\":\"apple\",\"price\":\"0.3\",\"id\":\"2\"},{\"name\":\"apple\",\"price\":\"0.3\",\"id\":\"2\"},{\"name\":\"water\",\"price\":\"1\",\"id\":\"4\"},{\"name\":\"cheese\",\"price\":\"3.75\",\"id\":\"5\"},{\"name\":\"truck\",\"price\":\"0.00\",\"id\":0}]', 1, '2019-07-19 00:16:23', 1, 5.65);

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
  `stars` int(5) NOT NULL DEFAULT '0',
  `img` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `status`, `price`, `score`, `stars`, `img`) VALUES
(0, 'TRUCK', 'TAX', 'active', 0, '', 0, ''),
(1, 'Stacy Adams Men\'s', 'The men\'s Vale Plain Toe Slip-On dress shoe features a patent upper, leather linings.', 'A', 125.5, '{\"star-1\":1,\"star-2\":0,\"star-3\":0,\"star-4\":0,\"star-5\":1}', 0, 'https://lgbtqnation-assets.s3.amazonaws.com/assets/2018/05/adidas-pride-shoe4-500x351.jpg'),
(2, 'apple', '', 'A', 0.3, '{\"star-1\":1,\"star-2\":0,\"star-3\":0,\"star-4\":0,\"star-5\":1}', 2, 'https://images-na.ssl-images-amazon.com/images/I/81xQBb5jRzL._SY355_.jpg'),
(3, 'beer', '', 'A', 2, '{\"star-1\":3,\"star-2\":0,\"star-3\":0,\"star-4\":0,\"star-5\":0}', 0, 'https://www.hola.com/imagenes/cocina/escuela/2012022457133/servir-correctamente-cerveza/0-264-108/cerveza_botellin_-z.jpg'),
(4, 'water', '', 'A', 1, '{\"star-1\":0,\"star-2\":1,\"star-3\":0,\"star-4\":0,\"star-5\":0}', 0, 'https://cdn.totalcode.com.co/homesentry/product-zoom/es/botella-de-agua-vidrio-agua-del-nacimiento-500ml-1.jpg'),
(5, 'cheese', '', 'A', 3.75, '{\"star-1\":0,\"star-2\":1,\"star-3\":0,\"star-4\":0,\"star-5\":0}', 0, 'https://img2.gratispng.com/20180712/hot/kisspng-who-moved-my-cheese-swiss-cheese-toast-manchego-cheese-pull-5b47819ed68056.6411361815314128948786.jpg');

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
(1, 'julio899@gmail.com', '51c30cf5b566235f70673a8092853fa4b0bb60e4', 'active', 'A', 41.15),
(2, 'user1@user.com', '51c30cf5b566235f70673a8092853fa4b0bb60e4', 'active', 'A', 200),
(3, 'user@user.com', '51c30cf5b566235f70673a8092853fa4b0bb60e4', 'active', 'A', 100),
(4, 'user2@user.com', '51c30cf5b566235f70673a8092853fa4b0bb60e4', 'active', 'A', 100),
(5, 'user3@user.com', '51c30cf5b566235f70673a8092853fa4b0bb60e4', 'active', 'A', 100),
(6, 'user4@user.com', '51c30cf5b566235f70673a8092853fa4b0bb60e4', 'active', 'A', 100),
(7, 'user5@user.com', '51c30cf5b566235f70673a8092853fa4b0bb60e4', 'active', 'A', 100),
(8, 'user6@user.com', '51c30cf5b566235f70673a8092853fa4b0bb60e4', 'active', 'A', 100),
(9, 'user7@user.com', '51c30cf5b566235f70673a8092853fa4b0bb60e4', 'active', 'A', 100);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(10) NOT NULL,
  `id_product` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `stars` int(10) NOT NULL,
  `commentary` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `id_product`, `id_user`, `stars`, `commentary`, `date`) VALUES
(1, 4, 1, 2, '3stars', '2019-07-18 20:46:08'),
(2, 1, 1, 5, '', '2019-07-18 23:10:52'),
(3, 2, 1, 3, '', '2019-07-18 23:11:12'),
(4, 1, 3, 1, 'malos no me gustaron', '2019-07-18 23:17:18'),
(5, 2, 3, 5, 'Saludable', '2019-07-18 23:18:19'),
(6, 3, 3, 1, 'mala para la salud', '2019-07-18 23:18:51'),
(7, 4, 3, 5, 'Rica y saludable', '2019-07-18 23:20:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`);

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
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
