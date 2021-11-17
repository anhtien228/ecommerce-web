-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2021 at 12:22 PM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `calCartQuantity` (IN `userSessionID` INT)  BEGIN
SELECT A.*, B.*
FROM
	shopping_session A
LEFT JOIN (
    SELECT
    	session_id,
		SUM(quantity) as cart_quantity
    FROM cart_item
    GROUP BY session_id) B
ON A.id = B.session_id
WHERE A.user_id = userSessionID;
END$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `getProductsByName` (IN `productNameInput` VARCHAR(255))  BEGIN
SELECT
	product.name as productName,
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
FROM
	product
INNER JOIN
	product_brand
ON
	product_brand.id = product.brand
WHERE
	product.name
LIKE CONCAT('%', productNameInput, '%');
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
  `quantity` int(5) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` decimal(10,0) NOT NULL,
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
  `desc` text NOT NULL,
  `sku` varchar(20) NOT NULL,
  `brand` int(11) NOT NULL,
  `cpu` varchar(30) NOT NULL,
  `ram` varchar(30) NOT NULL,
  `storage` varchar(20) NOT NULL,
  `graphic` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `year` int(11) NOT NULL,
  `photo` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `desc`, `sku`, `brand`, `cpu`, `ram`, `storage`, `graphic`, `price`, `year`, `photo`, `created_at`) VALUES
(1, 'Asus ROG Strix', 'Gaming', 'G712LWS', 2, 'Intel i7-10875H', '16 GB', '1000 GB SSD', 'NVIDIA GeForce RTX 2070 SUPER', '896', 2020, 'https://drscdn.500px.org/photo/1039898936/m%3D900/v2?sig=ea03aff276e4637d75f73dd97bbc60a7ee4325940c234cfbb633ec103458c033', '2021-11-16 18:21:53'),
(2, 'Asus Chromebook', 'Chromebook', 'C423NA', 2, 'Intel N3350', '4 GB', '64 GB eMMC', 'Intel HD Graphics 500', '749', 2020, 'https://drscdn.500px.org/photo/1039898934/m%3D900/v2?sig=7ba1f8818b53e8d32e7036c9f6f49458e83fa4ac05f17cc75930858833b22429', '2021-11-12 06:08:30'),
(3, 'Asus VivoBook', 'VivoBook', 'D712DA', 2, 'Intel 3250U', '8 GB', '256 GB SSD', 'AMD Radeon Graphics', '699', 2021, 'https://drscdn.500px.org/photo/1039898937/m%3D900/v2?sig=dd9e68bf6547da1369caad4084c6861246b5eb1dab10234939ee1cdf004a5db5', '2021-11-12 06:08:59'),
(4, 'Lenovo IdeaPad Gaming 3', 'Gaming', '15ARH05', 1, 'Intel i7 4800H', '16 GB', '512 GB SSD', 'NVIDIA GeForce GTX 1650 Ti', '896', 2020, 'https://drscdn.500px.org/photo/1039898938/m%3D900/v2?sig=263f3f0dfe7618f5e1022926a369c66fe0ac6a7e5df309909598e2b75175853a', '2021-11-12 06:09:31'),
(5, 'Lenovo ThinkPad ', 'ThinkPad', 'T590', 1, 'Intel i5-8265U', '16 GB', '512 GB SSD', 'Intel UHD Graphics 620', '499', 2020, 'https://drscdn.500px.org/photo/1039898939/m%3D900/v2?sig=e571961fedc8d5d23dfe122f1993d8474921458dd0d68b657970900d54964c13', '2021-11-12 06:09:50'),
(6, 'Lenovo ThinkBook 15', 'ThinkBook', 'TB15', 1, 'Intel i5-10210U', '16 GB', '512 GB SSD', 'Intel UHD Graphics', '599', 2021, 'https://drscdn.500px.org/photo/1039898943/m%3D900/v2?sig=77765868b8a1ffdd3a88e0a910b4c2473f05e76d1991b54f5b8b0543c2065f49', '2021-11-12 06:10:22'),
(7, 'Acer Switch SF314', 'Switch', 'NX.A5UAA', 5, 'Intel i7-1165G7', '8 GB', '512 GB SSD', 'Intel Iris Xe Graphics', '570', 2020, 'https://drscdn.500px.org/photo/1039952848/m%3D900/v2?sig=0e09d6cee05d4a10c9bac38a63a328e70994f27cabc26c0e1210726d664df9ec', '2021-11-16 18:22:30'),
(8, 'Acer Nitro 5', 'Nitro', 'AN517', 5, 'Intel i5-11300H', '16 GB', '512 GB SSD', 'NVIDIA GeForce GTX 1650', '730', 2019, 'https://drscdn.500px.org/photo/1039952850/m%3D900/v2?sig=945a76cf8e0bb5239c6cd9c5b0156cbc1ea6224471e684bc7886f9da015a86b7', '2021-11-16 18:22:40'),
(9, 'Acer Chromebook 315', 'Chromebook', 'CB315', 5, 'Intel N4120', '4 GB', '128 GB SSD', 'Intel UHD Graphics 600', '400', 2017, 'https://drscdn.500px.org/photo/1039952849/m%3D900/v2?sig=c86a32aeed8102ef10604cb2c171685ead113aec70a87f1b73da50db5844949f', '2021-11-16 18:23:45'),
(10, 'DELL Inspiron 5406', 'Graphic', 'I5406MT', 3, 'Intel i7-1165G7', '8 GB', '512 GB SSD', 'Intel Iris Xe Graphics', '460', 2017, 'https://drscdn.500px.org/photo/1039953407/m%3D900/v2?sig=6cb6485fc0b64198d63a7fb9904a8c2ea3fa2d105fbf61942188bf30e69b88d2', '2021-11-16 18:23:45'),
(11, 'DELL Vostro 3500', 'Gaming', 'CAV153', 3, 'Intel i5-1135G7', '8 GB', '256 GB SSD', 'Intel Iris Xe Graphics', '700', 2019, 'https://drscdn.500px.org/photo/1039953408/m%3D900/v2?sig=7df37aa0a885930ac2d0b81c05cc01cf31bee676b3198721645be216dee470ac', '2021-11-16 18:23:45'),
(12, 'MacBook Air 2020', 'Macbook Air', 'A2337', 6, 'Apple M1 3.2 GHz', '8 GB', '512 GB SSD', 'Integrated (Retina IPS)', '1249', 2020, 'https://drscdn.500px.org/photo/1039954744/m%3D900/v2?sig=fd7ce47aedda9b1de0fb3fe765dedea46207be9021d60c60ada35bf60c12fdc4', '2021-11-16 18:23:45'),
(13, 'MacBook Pro 13\" 2020', 'Macbook Pro', 'A2251', 6, 'Intel i7-1068NG7', '16 GB', '512 GB SSD', 'Iris Plus (Retina IPS)', '1999', 2020, 'https://drscdn.500px.org/photo/1039954742/m%3D900/v2?sig=d130c1e839a6db5732209abc1af0b92a9c9d53762a579ac451b8a331cdd7ac19', '2021-11-16 18:23:45'),
(14, 'HP Pavilion x360', 'Graphic', '16Y38EA', 4, 'Intel i7-1065G7', '16 GB', '512 GB SSD', 'Intel Iris Plus Graphics', '600', 2021, 'https://lh3.googleusercontent.com/HKeGSZak5X98zdQLJe4ONIuc9KTFviGaTxTDI4sSIfrAfagbBb8W4_0BsyhdTc__r-pG1PebRPJfCJqqOMvk1COwoh_E-pBMyaFijJv6Kp6ckccR0215GOIynCs0W2ArBPZX2tQ9ig=w2400?source=screenshot.guru\"> <img src=\"https://lh3.googleusercontent.com/HKeGSZa', '2021-11-16 09:14:59');

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
  `total` decimal(10,0) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopping_session`
--

INSERT INTO `shopping_session` (`id`, `user_id`, `total`, `created_at`) VALUES
(1, 1, '0', '2021-11-16 08:54:16');

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
(11, 'd.atien228@gmail.com', '$2y$10$oONwELxl64N5hS.6lGGVweXtF.EBvf1bVCdPZTBEs9oqYfYTmutFO', 'Tien', 'Doan', NULL, NULL, '2003-01-01', '2021-11-16 08:27:44');

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
  ADD UNIQUE KEY `customer_order_index` (`id`,`user_id`) USING BTREE,
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
  ADD UNIQUE KEY `sku_index` (`id`,`sku`) USING BTREE,
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
  ADD UNIQUE KEY `session_index` (`id`,`user_id`) USING BTREE,
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_brand`
--
ALTER TABLE `product_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shopping_session`
--
ALTER TABLE `shopping_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  ADD CONSTRAINT `order_details_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `order_details_ibfk_6` FOREIGN KEY (`payment_id`) REFERENCES `payment_details` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

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
  ADD CONSTRAINT `shopping_session_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
