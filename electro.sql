-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2021 at 03:25 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electro`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getLaptopProducts` ()  BEGIN 
SELECT  product.name as productName,
		product.desc as productDesc,
        product.sku as productSKU,
		product.cpu as productCPU,
        product.ram as productRAM,
        product.storage as productSto,
        product.graphic as productGPU,
        product.price as productPrice,
        product.year as productYear,
        product.photo as productPhoto,
        product_brand.name as productBrand,
        product_brand.desc as productOrigin
FROM product
INNER JOIN product_brand ON product.brand=product_brand.id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `provider` varchar(20) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `method` enum('visa','mastercard','cash') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `desc` text DEFAULT NULL,
  `sku` varchar(20) DEFAULT NULL,
  `brand` int(11) DEFAULT NULL,
  `cpu` varchar(30) DEFAULT NULL,
  `ram` varchar(30) DEFAULT NULL,
  `storage` varchar(20) DEFAULT NULL,
  `graphic` varchar(100) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `desc`, `sku`, `brand`, `cpu`, `ram`, `storage`, `graphic`, `price`, `year`, `photo`, `created_at`) VALUES
(1, 'Asus ROG Strix', 'Gaming', 'G712LWS', 2, 'i7-10875H', '16 GB', '1000 GB SSD', 'NVIDIA GeForce RTX 2070 SUPER', '896', 2020, 'https://drscdn.500px.org/photo/1039898936/m%3D900/v2?sig=ea03aff276e4637d75f73dd97bbc60a7ee4325940c234cfbb633ec103458c033', '2021-11-12 06:07:48'),
(2, 'Asus Chromebook', 'Chromebook', 'C423NA', 2, 'Intel N3350', '4 GB', '64 GB eMMC', 'Intel HD Graphics 500', '749', 2020, 'https://drscdn.500px.org/photo/1039898934/m%3D900/v2?sig=7ba1f8818b53e8d32e7036c9f6f49458e83fa4ac05f17cc75930858833b22429', '2021-11-12 06:08:30'),
(3, 'Asus VivoBook', 'VivoBook', 'D712DA', 2, 'Intel 3250U', '8 GB', '256 GB SSD', 'AMD Radeon Graphics', '699', 2021, 'https://drscdn.500px.org/photo/1039898937/m%3D900/v2?sig=dd9e68bf6547da1369caad4084c6861246b5eb1dab10234939ee1cdf004a5db5', '2021-11-12 06:08:59'),
(4, 'Lenovo IdeaPad Gaming 3', 'Gaming', '15ARH05', 1, 'Intel i7 4800H', '16 GB', '512 GB SSD', 'NVIDIA GeForce GTX 1650 Ti', '896', 2020, 'https://drscdn.500px.org/photo/1039898938/m%3D900/v2?sig=263f3f0dfe7618f5e1022926a369c66fe0ac6a7e5df309909598e2b75175853a', '2021-11-12 06:09:31'),
(5, 'Lenovo ThinkPad ', 'ThinkPad', 'T590', 1, 'Intel i5-8265U', '16 GB', '512 GB SSD', 'Intel UHD Graphics 620', '499', 2020, 'https://drscdn.500px.org/photo/1039898939/m%3D900/v2?sig=e571961fedc8d5d23dfe122f1993d8474921458dd0d68b657970900d54964c13', '2021-11-12 06:09:50'),
(6, 'Lenovo ThinkBook 15', 'ThinkBook', 'TB15', 1, 'Intel i5-10210U', '16 GB', '512 GB SSD', 'Intel UHD Graphics', '599', 2021, 'https://drscdn.500px.org/photo/1039898943/m%3D900/v2?sig=77765868b8a1ffdd3a88e0a910b4c2473f05e76d1991b54f5b8b0543c2065f49', '2021-11-12 06:10:22');

-- --------------------------------------------------------

--
-- Table structure for table `product_brand`
--

CREATE TABLE `product_brand` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `desc` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_brand`
--

INSERT INTO `product_brand` (`id`, `name`, `desc`, `created_at`) VALUES
(1, 'Lenovo', 'China', '2021-11-11 07:47:58'),
(2, 'Asus', 'Taiwan', '2021-11-11 07:49:56'),
(3, 'Dell', 'US', '2021-11-11 07:50:21'),
(4, 'HP', 'US', '2021-11-11 07:51:03'),
(5, 'Acer', 'Taiwan', '2021-11-11 07:51:27'),
(6, 'Apple', 'US', '2021-11-11 07:51:37');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_session`
--

CREATE TABLE `shopping_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `telephone` int(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `firstname`, `lastname`, `address`, `telephone`, `dob`, `created_at`) VALUES
(1, 'jason123@gmail.com', '$2y$10$bj1LmM5.MaNSbd2NC2CkD.NBaOxOJMnkD.eK7.iLQqJx2nmKc.DgC', 'Jason', 'Nguyen', '5 Ham Nghi, District 1', 931251260, NULL, '2021-01-24 17:00:00'),
(2, 'duycse2k@gmail.com', '$2y$10$yRrusuRiqm2xiNwrBQbMve.oxygt.p/60zJjGlyTpTr5OkddbsYm2', 'Duy', 'Nguyen Vinh', '106 Lexington, New York City', 903591012, NULL, '2021-05-02 17:00:00'),
(3, 'nataliedang@gmail.com', '$2y$10$WXsWZPqogohLWBQd/cU8BOZleyp1Vyj4kRWqho1ODZiUMElD3cDqS', 'Natalie', 'Dang', '206 Ly Thuong Kiet, District 10', 938120677, NULL, '2021-07-03 17:00:00'),
(10, 'datien228@gmail.com', '$2y$10$lH/vueMAhoG57keFZ7aRo.1itA53LViZsNyzNZL5mTHXrNqBLXGqe', 'Tien', 'Doan', NULL, NULL, '2003-01-01', '2021-11-11 06:34:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_item_ibfk_2` (`session_id`),
  ADD KEY `cart_item_ibfk_3` (`product_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_ibfk_5` (`user_id`),
  ADD KEY `order_details_ibfk_6` (`payment_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_ibfk_1` (`product_id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ibfk_1` (`brand`);

--
-- Indexes for table `product_brand`
--
ALTER TABLE `product_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_session`
--
ALTER TABLE `shopping_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopping_session_ibfk_2` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_brand`
--
ALTER TABLE `product_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shopping_session`
--
ALTER TABLE `shopping_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `shopping_session` (`id`),
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `shopping_session` (`id`),
  ADD CONSTRAINT `cart_item_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `payment_details` (`id`),
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `order_details_ibfk_4` FOREIGN KEY (`payment_id`) REFERENCES `payment_details` (`id`),
  ADD CONSTRAINT `order_details_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `order_details_ibfk_6` FOREIGN KEY (`payment_id`) REFERENCES `payment_details` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`id`) REFERENCES `order_details` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brand`) REFERENCES `product_brand` (`id`);

--
-- Constraints for table `shopping_session`
--
ALTER TABLE `shopping_session`
  ADD CONSTRAINT `shopping_session_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `shopping_session_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
