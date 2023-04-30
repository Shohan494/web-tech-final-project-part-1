-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2023 at 03:16 AM
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
-- Database: `webtech`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `total_cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `total_cost`) VALUES
(1, 6, '2023-04-26 09:25:11', 0.00),
(2, 6, '2023-04-26 09:28:14', 0.00),
(3, 6, '2023-04-27 05:53:10', 0.00),
(4, 6, '2023-04-27 05:53:42', 0.00),
(5, 6, '2023-04-27 05:56:21', 0.00),
(6, 6, '2023-04-27 11:51:04', 0.00),
(7, 6, '2023-04-27 11:52:05', 0.00),
(8, 6, '2023-04-27 11:53:57', 0.00),
(9, 6, '2023-04-27 11:54:42', 0.00),
(10, 6, '2023-04-27 11:58:52', 0.00),
(11, 6, '2023-04-27 12:04:40', 0.00),
(12, 6, '2023-04-27 12:06:36', 0.00),
(13, 6, '2023-04-27 12:07:14', 0.00),
(14, 6, '2023-04-27 12:09:21', 9.40),
(15, 6, '2023-04-27 12:22:52', 0.00),
(16, 6, '2023-04-28 08:35:49', 26.80),
(17, 6, '2023-04-29 20:41:00', 0.00),
(18, 6, '2023-04-29 20:42:03', 0.00),
(19, 6, '2023-04-29 20:42:35', 0.00),
(20, 6, '2023-04-29 20:43:35', 0.00),
(21, 6, '2023-04-29 20:49:39', 0.00),
(22, 6, '2023-04-30 02:26:16', 23.00),
(23, 6, '2023-04-30 02:36:06', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `product_id`, `quantity`, `price`, `subtotal`) VALUES
(1, 14, 5, 2, 3.20, 6.40),
(2, 14, 6, 2, 1.50, 3.00),
(3, 14, 7, 0, 2.00, 0.00),
(4, 14, 8, 0, 2.10, 0.00),
(5, 14, 9, 0, 2.30, 0.00),
(6, 14, 10, 0, 0.80, 0.00),
(7, 14, 11, 0, 12.00, 0.00),
(8, 15, 5, 0, 3.20, 0.00),
(9, 15, 6, 0, 1.50, 0.00),
(10, 15, 7, 0, 2.00, 0.00),
(11, 15, 8, 0, 2.10, 0.00),
(12, 15, 9, 0, 2.30, 0.00),
(13, 15, 10, 0, 0.80, 0.00),
(14, 15, 11, 0, 12.00, 0.00),
(15, 16, 5, 4, 3.20, 12.80),
(16, 16, 6, 4, 1.50, 6.00),
(17, 16, 7, 4, 2.00, 8.00),
(18, 16, 8, 0, 2.10, 0.00),
(19, 16, 9, 0, 2.30, 0.00),
(20, 16, 10, 0, 0.80, 0.00),
(21, 16, 11, 0, 12.00, 0.00),
(22, 17, 5, 0, 3.20, 0.00),
(23, 17, 6, 0, 1.50, 0.00),
(24, 17, 7, 0, 2.00, 0.00),
(25, 17, 8, 0, 2.10, 0.00),
(26, 17, 9, 0, 2.30, 0.00),
(27, 17, 10, 0, 0.80, 0.00),
(28, 18, 5, 0, 3.20, 0.00),
(29, 18, 6, 0, 1.50, 0.00),
(30, 18, 7, 0, 2.00, 0.00),
(31, 18, 8, 0, 2.10, 0.00),
(32, 18, 9, 0, 2.30, 0.00),
(33, 18, 10, 0, 0.80, 0.00),
(34, 19, 5, 0, 3.20, 0.00),
(35, 19, 6, 0, 1.50, 0.00),
(36, 19, 7, 0, 2.00, 0.00),
(37, 19, 8, 0, 2.10, 0.00),
(38, 19, 9, 0, 2.30, 0.00),
(39, 19, 10, 0, 0.80, 0.00),
(40, 20, 5, 0, 3.20, 0.00),
(41, 20, 6, 0, 1.50, 0.00),
(42, 20, 7, 0, 2.00, 0.00),
(43, 20, 8, 0, 2.10, 0.00),
(44, 20, 9, 0, 2.30, 0.00),
(45, 20, 10, 0, 0.80, 0.00),
(46, 22, 5, 5, 3.20, 16.00),
(47, 22, 6, 2, 1.50, 3.00),
(48, 22, 7, 2, 2.00, 4.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` float NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `created_at`, `updated_at`) VALUES
(5, 'Jet Fuel', 'Fuel for jet engines', 3.2, '2023-03-11 11:07:05', '2023-03-11 11:07:05'),
(6, 'Natural Gas', 'Fuel for natural gas engines', 1.5, '2023-03-11 11:07:05', '2023-03-11 11:07:05'),
(7, 'Ethanol', 'Fuel for ethanol engines', 2, '2023-03-11 11:07:05', '2023-03-11 11:07:05'),
(8, 'Biodiesel', 'Fuel for biodiesel engines', 2.1, '2023-03-11 11:07:05', '2023-03-11 11:07:05'),
(9, 'Methanol', 'Fuel for methanol engines', 2.6, '2023-03-11 11:07:05', '2023-04-30 00:17:52'),
(13, 'test2sdgfadfg', NULL, 12324, '2023-04-30 00:19:38', '2023-04-30 00:19:38'),
(14, 'jmvhjk', 'hjkfghjkfhj', 12313, '2023-04-30 00:21:30', '2023-04-30 00:21:30'),
(15, 'Diesel', 'Fuel for diesel engines', 2.5, '2023-04-01 02:00:00', '2023-04-01 02:00:00'),
(16, 'Gasoline', 'Fuel for gasoline engines', 2.8, '2023-04-02 03:00:00', '2023-04-02 03:00:00'),
(17, 'Bioethanol', 'Fuel for bioethanol engines', 2.2, '2023-04-03 04:00:00', '2023-04-03 04:00:00'),
(18, 'Liquefied Petroleum Gas (LPG)', 'Fuel for LPG engines', 1.7, '2023-04-04 05:00:00', '2023-04-04 05:00:00'),
(19, 'Compressed Natural Gas (CNG)', 'Fuel for CNG engines', 1.4, '2023-04-05 06:00:00', '2023-04-05 06:00:00'),
(20, 'Propane', 'Fuel for propane engines', 2, '2023-04-06 07:00:00', '2023-04-06 07:00:00'),
(21, 'Hydrogen', 'Fuel for hydrogen engines', 3, '2023-04-07 08:00:00', '2023-04-07 08:00:00'),
(22, 'Methane', 'Fuel for methane engines', 2.6, '2023-04-08 09:00:00', '2023-04-08 09:00:00'),
(23, 'Butane', 'Fuel for butane engines', 2.1, '2023-04-09 10:00:00', '2023-04-09 10:00:00'),
(24, 'Dimethyl Ether (DME)', 'Fuel for DME engines', 2.9, '2023-04-10 11:00:00', '2023-04-10 11:00:00'),
(25, 'Cocaine', 'Illegal fuel for illegal engines', 99.99, '2023-04-11 12:00:00', '2023-04-11 12:00:00'),
(26, 'Acetone', 'Fuel for acetone engines', 1.9, '2023-04-12 13:00:00', '2023-04-12 13:00:00'),
(27, 'Compressed Air', 'Fuel for compressed air engines', 0.5, '2023-04-13 14:00:00', '2023-04-13 14:00:00'),
(28, 'Kerosene', 'Fuel for kerosene engines', 2.3, '2023-04-14 15:00:00', '2023-04-14 15:00:00'),
(29, 'Vegetable Oil', 'Fuel for vegetable oil engines', 1.8, '2023-04-15 16:00:00', '2023-04-15 15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `token`) VALUES
(5, 'shohanul', 'shohanul', 'shohan12224943@gmail.com', 'admin', NULL),
(6, 'shohan', 'admin0', 'admin@admin.com', 'customer', NULL),
(9, 'shohanulalam', 'Shohan59@', 'shohanul@gmail.com', 'customer', NULL),
(10, 'customer1', 'password1', 'customer1@example.com', 'customer', 'token1'),
(11, 'customer2', 'password2', 'customer2@example.com', 'customer', 'token2'),
(12, 'customer3', 'password3', 'customer3@example.com', 'customer', 'token3'),
(13, 'customer4', 'password4', 'customer4@example.com', 'customer', 'token4'),
(14, 'customer5', 'password5', 'customer5@example.com', 'customer', 'token5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `unique_email_constraint` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
