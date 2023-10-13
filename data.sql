-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2023 at 04:32 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` varchar(11) NOT NULL,
  `total` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `user_id`, `quantity`, `total`) VALUES
(132, 67, 28, '9', '198');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `img`, `price`, `description`) VALUES
(67, 'Mèo 3', 'uploads/30-giong-meo-noi-tieng-dep-nhat-cute-de-nuoi-va-gia-ban-bia.webp', '22k', 'ln'),
(68, 'Mèo 1', 'uploads/c9d8b3f32f91fdb2e4bde4496a4959df.jpg', '55k', 'Mèo'),
(69, 'Mèo 2', 'uploads/Anh-meo-dep-998x800.webp', '55k', 'Mèo'),
(70, 'Mèo 4', 'uploads/meo-munchkin-1.jpg', '55k', 'Béo');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `money` varchar(11) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `roles`, `money`, `avatar`) VALUES
(22, 'owner', 'cb5f1deba55968f84613d7c3081186c4', 'owner', 'owner', '600k', ''),
(28, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', '2202', 'Tux.svg.png'),
(32, 'Thanh001+', '2344de9fee3d24bb853792519ace9805', 'Thanh001+', 'user', '500', '591a86f4b1452f462b4f144f7b1c426d.jpg'),
(33, 'Akali17', '2344de9fee3d24bb853792519ace9805', 'akali', 'user', '500', 'meo-munchkin-1.jpg'),
(34, 'Chusohuu', '1ed043b18ce1273f97db0d4bd02c420e', 'Chủ sở hữu', 'owner', '500', '202258154624_90444.jpg'),
(35, 'Thanh2004', '2344de9fee3d24bb853792519ace9805', 'Beo', 'user', '500', ''),
(36, 'Thanh888', '8bdac52aacc7468edad980103f505030', 'Beo 2', 'user', '500', ''),
(37, 'Thanh999', '4e995768a6900f4ea22d2664a4c6691a', 'Meo 3 ', 'user', '500', ''),
(38, 'Saurieng17', '7f39ef8ac00b5113e9b68607abfb0874', 'sau rieng', 'user', '500', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_id`),
  ADD KEY `product` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
