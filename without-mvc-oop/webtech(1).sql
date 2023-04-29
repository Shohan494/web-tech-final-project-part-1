-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 08, 2023 at 07:38 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.14

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
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `product_id`, `quantity`, `total_cost`, `order_date`, `status`) VALUES
(1, 1, 2, 5, '100.00', '2023-03-11 10:56:34', 'processing'),
(2, 2, 3, 10, '200.00', '2023-03-11 10:56:34', 'shipped'),
(3, 3, 1, 2, '50.00', '2023-03-11 10:56:34', 'cancelled'),
(4, 1, 3, 3, '75.00', '2023-03-11 10:56:34', 'processing'),
(5, 2, 1, 8, '160.00', '2023-03-11 10:56:34', 'shipped'),
(6, 3, 2, 1, '20.00', '2023-03-11 10:56:34', 'cancelled'),
(7, 4, 1, 4, '80.00', '2023-03-11 10:56:34', 'processing'),
(8, 5, 3, 6, '90.00', '2023-03-11 10:56:34', 'shipped'),
(9, 4, 2, 2, '40.00', '2023-03-11 10:56:34', 'cancelled'),
(10, 5, 1, 10, '200.00', '2023-03-11 10:56:35', 'processing'),
(11, 4, 1, 2, '100.00', '2023-03-11 10:58:09', 'Delivered'),
(12, 4, 2, 1, '50.00', '2023-03-11 10:58:09', 'Pending'),
(13, 4, 3, 3, '150.00', '2023-03-11 10:58:09', 'Shipped'),
(14, 4, 4, 4, '200.00', '2023-03-11 10:58:09', 'Delivered'),
(15, 4, 5, 2, '100.00', '2023-03-11 10:58:09', 'Delivered'),
(16, 4, 6, 1, '50.00', '2023-03-11 10:58:09', 'Delivered'),
(17, 4, 7, 3, '150.00', '2023-03-11 10:58:09', 'Shipped'),
(18, 4, 8, 2, '100.00', '2023-03-11 10:58:09', 'Pending'),
(19, 4, 9, 1, '50.00', '2023-03-11 10:58:09', 'Shipped'),
(20, 4, 10, 5, '250.00', '2023-03-11 10:58:09', 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` float NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `created_at`, `updated_at`) VALUES
(5, 'Jet Fuel', 'Fuel for jet engines', 3.2, '2023-03-11 11:07:05', '2023-03-11 11:07:05'),
(6, 'Natural Gas', 'Fuel for natural gas engines', 1.5, '2023-03-11 11:07:05', '2023-03-11 11:07:05'),
(7, 'Ethanol', 'Fuel for ethanol engines', 2, '2023-03-11 11:07:05', '2023-03-11 11:07:05'),
(8, 'Biodiesel', 'Fuel for biodiesel engines', 2.1, '2023-03-11 11:07:05', '2023-03-11 11:07:05'),
(9, 'Methanol', 'Fuel for methanol engines', 2.3, '2023-03-11 11:07:05', '2023-03-11 11:07:05'),
(10, 'Electricity', 'Fuel for electric engines', 0.8, '2023-03-11 11:07:05', '2023-03-11 11:07:05');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `token`) VALUES
(5, 'shohanul', 'shohanul', 'shohan12224943@gmail.com', 'admin', '17907a494887809874ad666793a8cf3e0709aac91a761279113ff3c85b1b3d0e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

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
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
