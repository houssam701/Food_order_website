-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2024 at 08:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `order_id` int(100) NOT NULL,
  `user_name` mediumtext NOT NULL,
  `user_phone` int(255) NOT NULL,
  `user_address` mediumtext NOT NULL,
  `food_name` mediumtext NOT NULL,
  `food_price` varchar(122) NOT NULL,
  `food_quantity` int(122) NOT NULL,
  `date_time` datetime(6) NOT NULL,
  `user_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`order_id`, `user_name`, `user_phone`, `user_address`, `food_name`, `food_price`, `food_quantity`, `date_time`, `user_id`) VALUES
(96, 'ahmad', 961, 'beirut,tarik ljdide building 34 , N0', 'Mortadella Bliss Delight', '8$', 1, '2024-01-06 22:00:16.000000', 5);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(150) NOT NULL,
  `price` varchar(100) NOT NULL,
  `description` varchar(2555) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `price`, `description`) VALUES
(26, 'Smoky burger', 'images/menu-burger.jpg', '10$', 'Made with smoky beef, and vegetables.'),
(27, 'Mortadella Bliss Delight', 'images/food-3.png', '8$', ' Combination of mortadella, vegetables, and mayonnaise '),
(29, 'Fries ', 'images/food-6.png', '6$', 'French fries'),
(43, 'Meet Momo', 'images/momo.jpg', '25$', 'Tender dumplings filled with savory minced meet, perfect for a flavorful bite.'),
(44, 'Chicken Momo', 'images/menu-momo.jpg', '20$', 'Tender dumplings filled with savory minced chicken, perfect for a flavorful bite.'),
(45, 'humus', 'images/burger.jpg', '25$', 'very delecious'),
(46, 'humus', 'images/menu-momo.jpg', '25$', 'very delecious');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullName`, `password`, `email`, `address`, `phone`) VALUES
(2, 'husamssss', '$2y$10$MAtBw38Z.PrLzUhhhvgfGe4.Dxp/T6Pks5PNrVN2GGiJN7tkUU0i.', 'smak23@gmail.com', 'beirut', 123650),
(3, 'husam2', '$2y$10$fo1x.I34tZBdeXxBhSzvru0Jz6x85uyP3bx/Jt3dn83MEbTCAqALG', 'houss2002@outlook.com', 'beirut', 961),
(4, 'ali', '$2y$10$.wvRkzJqbe0FnpuG9mR8KOHKQsA3rwOklOknkyYt.4d8h5oPP5fI6', 'smak23@gmail.com', 'beirut', 9610),
(5, 'ahmad', '$2y$10$HSgpvq3cj6pUm1KlTChiv.fNyq4pccbg6N0cBTc2TKdsJ7AYdKOA.', 'ahmad@gmail.com', 'beirut,tarik ljdide building 34 , N0', 961);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
