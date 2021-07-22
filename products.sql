-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2021 at 02:38 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `products`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `SKU` varchar(12) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `type_id` int(11) NOT NULL,
  `p_size` float DEFAULT NULL,
  `height` float DEFAULT NULL,
  `width` float DEFAULT NULL,
  `p_length` float DEFAULT NULL,
  `p_weight` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `SKU`, `p_name`, `price`, `type_id`, `p_size`, `height`, `width`, `p_length`, `p_weight`) VALUES
(25, 'JVC423534', 'Acme DISC', 1, 1, 400, NULL, NULL, NULL, NULL),
(26, 'JVC423534', 'Acme DISC', 1, 1, 400, NULL, NULL, NULL, NULL),
(27, 'JVC423534', 'Acme DISC', 1, 1, 400, NULL, NULL, NULL, NULL),
(28, 'JVC423534', 'Acme DISC', 1, 1, 400, NULL, NULL, NULL, NULL),
(29, 'GGWP0007', 'War and Peace', 20, 3, NULL, NULL, NULL, NULL, 20),
(31, 'GGWP0007', 'War and Peace', 20, 3, NULL, NULL, NULL, NULL, 20),
(34, 'TR120555', 'Chair', 40, 2, NULL, 24, 53, 23, NULL),
(35, 'TR120555', 'Chair', 40, 2, NULL, 24, 53, 23, NULL),
(36, 'TR120555', 'Chair', 40, 2, NULL, 24, 53, 23, NULL),
(38, 'TR120555', 'Chair', 40, 2, NULL, 24, 53, 23, NULL),
(42, 'GGWP0007', 'War and Peace', 20, 3, NULL, NULL, NULL, NULL, 2),
(43, 'GGWP0007', 'War and Peace', 20, 3, NULL, NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'DVD'),
(2, 'Furniture'),
(3, 'Book');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
