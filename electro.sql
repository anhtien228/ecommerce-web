-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2021 at 09:42 PM
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `checkCart` (IN `productID` INT, IN `sessionID` INT(8))  BEGIN

SELECT 
		product.sku AS sku
FROM cart_item
INNER JOIN product ON product.id=cart_item.product_id
WHERE
    (product.id=productID) AND		(cart_item.session_id=sessionID);
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `filterProducts` (IN `productName` VARCHAR(255), IN `brandFilter` VARCHAR(255), IN `osFilter` VARCHAR(255), IN `cpuFilter` VARCHAR(255), IN `ramFilter` VARCHAR(255), IN `stoFilter` VARCHAR(255), IN `minPrice` INT(8), IN `maxPrice` INT(8))  BEGIN
SELECT
	product.id as pid,
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
	(product.name LIKE CONCAT ('%', productName, '%')) AND
	(product_brand.name LIKE CONCAT('%', brandFilter, '%')) AND
    (CASE osFilter
     	WHEN 'mac' THEN
    	product_brand.name = 'Apple'
     	WHEN 'windows' THEN
     	product_brand.name != 'Apple'
     	ELSE product_brand.name LIKE CONCAT('%', osFilter, '%')
     END) AND
    (CASE cpuFilter
     	WHEN 'other' THEN
     		(product.cpu NOT LIKE CONCAT('%i3%') AND
             product.cpu NOT LIKE CONCAT('%i5%') AND
             product.cpu NOT LIKE CONCAT('%i7%') AND
     		 product.cpu NOT LIKE CONCAT('%amd%'))
     	ELSE product.cpu LIKE CONCAT('%', cpuFilter, '%')
    END) AND
    (product.ram LIKE CONCAT('%', ramFilter, '%')) AND
    (product.storage LIKE CONCAT('%', stoFilter, '%'))
    AND
    (((product.price <= maxPrice) AND (maxPrice != '') AND (minPrice = ''))
    OR 
    ((product.price >= minPrice) AND (minPrice != '') AND (maxPrice = ''))
    OR 
    ((product.price BETWEEN minPrice AND maxPrice) AND (minPrice != '') AND (maxPrice != ''))
    OR 
    ((minPrice = '') AND (maxPrice = '')));   END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCartItems` (IN `sessionID` INT)  BEGIN
SELECT
	product.id as pid,
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
	cart_item
INNER JOIN product
ON cart_item.product_id=product.id
INNER JOIN product_brand
ON product_brand.id = product.brand
WHERE cart_item.session_id=sessionID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getLaptopProducts` ()  BEGIN 
SELECT  
		product.id as pid,
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
FROM product
INNER JOIN product_brand ON product.brand=product_brand.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getProductsByName` (IN `productNameInput` VARCHAR(255))  BEGIN
SELECT
	product.id as pid,
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
  `desc` text DEFAULT NULL,
  `sku` varchar(20) NOT NULL,
  `brand` int(11) NOT NULL,
  `cpu` varchar(30) NOT NULL,
  `ram` varchar(30) NOT NULL,
  `storage` varchar(20) NOT NULL,
  `graphic` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `photo` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `desc`, `sku`, `brand`, `cpu`, `ram`, `storage`, `graphic`, `price`, `year`, `photo`, `created_at`) VALUES
(1, 'Asus ROG Strix', 'Gaming', 'G712LWS', 2, 'Intel i7-10875H', '16GB', '1TB SSD', 'NVIDIA GeForce RTX 2070 SUPER', '896', 2020, 'https://drscdn.500px.org/photo/1039898936/m%3D900/v2?sig=ea03aff276e4637d75f73dd97bbc60a7ee4325940c234cfbb633ec103458c033', '2021-11-26 09:38:56'),
(2, 'Asus Chromebook', 'Chromebook', 'C423NA', 2, 'Intel N3350', '4GB', '64GB eMMC', 'Intel HD Graphics 500', '749', 2020, 'https://drscdn.500px.org/photo/1039898934/m%3D900/v2?sig=7ba1f8818b53e8d32e7036c9f6f49458e83fa4ac05f17cc75930858833b22429', '2021-11-26 09:38:56'),
(3, 'Asus VivoBook', 'VivoBook', 'D712DA', 2, 'Intel 3250U', '8GB', '256GB SSD', 'AMD Radeon Graphics', '699', 2021, 'https://drscdn.500px.org/photo/1039898937/m%3D900/v2?sig=dd9e68bf6547da1369caad4084c6861246b5eb1dab10234939ee1cdf004a5db5', '2021-11-26 09:38:56'),
(4, 'Lenovo IdeaPad Gaming 3', 'Gaming', '15ARH05', 1, 'Intel i7 4800H', '16GB', '512GB SSD', 'NVIDIA GeForce GTX 1650 Ti', '896', 2020, 'https://drscdn.500px.org/photo/1039898938/m%3D900/v2?sig=263f3f0dfe7618f5e1022926a369c66fe0ac6a7e5df309909598e2b75175853a', '2021-11-26 09:38:56'),
(5, 'Lenovo ThinkPad ', 'ThinkPad', 'T590', 1, 'Intel i5-8265U', '16GB', '512GB SSD', 'Intel UHD Graphics 620', '499', 2020, 'https://drscdn.500px.org/photo/1039898939/m%3D900/v2?sig=e571961fedc8d5d23dfe122f1993d8474921458dd0d68b657970900d54964c13', '2021-11-26 09:38:56'),
(6, 'Lenovo ThinkBook 15', 'ThinkBook', 'TB15', 1, 'Intel i5-10210U', '16GB', '512GB SSD', 'Intel UHD Graphics', '599', 2021, 'https://drscdn.500px.org/photo/1039898943/m%3D900/v2?sig=77765868b8a1ffdd3a88e0a910b4c2473f05e76d1991b54f5b8b0543c2065f49', '2021-11-26 09:38:56'),
(7, 'Acer Switch SF314', 'Switch', 'NX.A5UAA', 5, 'Intel i7-1165G7', '8GB', '512GB SSD', 'Intel Iris Xe Graphics', '570', 2020, 'https://drscdn.500px.org/photo/1039952848/m%3D900/v2?sig=0e09d6cee05d4a10c9bac38a63a328e70994f27cabc26c0e1210726d664df9ec', '2021-11-26 09:38:56'),
(8, 'Acer Nitro 5', 'Nitro', 'AN517', 5, 'Intel i5-11300H', '16GB', '512GB SSD', 'NVIDIA GeForce GTX 1650', '730', 2019, 'https://drscdn.500px.org/photo/1039952850/m%3D900/v2?sig=945a76cf8e0bb5239c6cd9c5b0156cbc1ea6224471e684bc7886f9da015a86b7', '2021-11-26 09:38:56'),
(9, 'Acer Chromebook 315', 'Chromebook', 'CB315', 5, 'Intel N4120', '4GB', '128GB SSD', 'Intel UHD Graphics 600', '400', 2017, 'https://drscdn.500px.org/photo/1039952849/m%3D900/v2?sig=c86a32aeed8102ef10604cb2c171685ead113aec70a87f1b73da50db5844949f', '2021-11-26 09:38:56'),
(10, 'DELL Inspiron 5406', 'Graphic', 'I5406MT', 3, 'Intel i7-1165G7', '8GB', '512GB SSD', 'Intel Iris Xe Graphics', '460', 2017, 'https://drscdn.500px.org/photo/1039953407/m%3D900/v2?sig=6cb6485fc0b64198d63a7fb9904a8c2ea3fa2d105fbf61942188bf30e69b88d2', '2021-11-26 09:38:56'),
(11, 'DELL Vostro 3500', 'Gaming', 'CAV153', 3, 'Intel i5-1135G7', '8GB', '256GB SSD', 'Intel Iris Xe Graphics', '700', 2019, 'https://drscdn.500px.org/photo/1039953408/m%3D900/v2?sig=7df37aa0a885930ac2d0b81c05cc01cf31bee676b3198721645be216dee470ac', '2021-11-26 09:38:56'),
(12, 'MacBook Air 2020', 'Macbook Air', 'A2337', 6, 'Apple M1 3.2 GHz', '8GB', '512GB SSD', 'Integrated (Retina IPS)', '1249', 2020, 'https://drscdn.500px.org/photo/1039954744/m%3D900/v2?sig=fd7ce47aedda9b1de0fb3fe765dedea46207be9021d60c60ada35bf60c12fdc4', '2021-11-26 09:38:56'),
(13, 'MacBook Pro 13\" 2020', 'Macbook Pro', 'A2251', 6, 'Intel i7-1068NG7', '16GB', '512GB SSD', 'Iris Plus (Retina IPS)', '1999', 2020, 'https://drscdn.500px.org/photo/1039954742/m%3D900/v2?sig=d130c1e839a6db5732209abc1af0b92a9c9d53762a579ac451b8a331cdd7ac19', '2021-11-26 09:38:56'),
(14, 'HP Pavilion x360', 'Graphic', '16Y38EA', 4, 'Intel i7-1065G7', '16GB', '512GB SSD', 'Intel Iris Plus Graphics', '600', 2021, 'https://lh3.googleusercontent.com/HKeGSZak5X98zdQLJe4ONIuc9KTFviGaTxTDI4sSIfrAfagbBb8W4_0BsyhdTc__r-pG1PebRPJfCJqqOMvk1COwoh_E-pBMyaFijJv6Kp6ckccR0215GOIynCs0W2ArBPZX2tQ9ig=w2400?source=screenshot.guru\"> <img src=\"https://lh3.googleusercontent.com/HKeGSZa', '2021-11-26 09:38:56'),
(15, 'Asus Gaming G5', NULL, 'AG3152', 2, 'Intel i3-U2500', '4GB', '256GB', 'Intel UHD Graphics', '399', NULL, 'https://www.phongcachxanh.vn/web/image/product.template/13944/image_1024?unique=e632c53', '2021-11-26 09:38:56'),
(16, 'Lenovo IdeaPad 320-15IKB', 'Notebook', 'J79JZVM', 1, 'Intel Core i3 7100U 2.4GHz', '8GB', '1TB HDD', 'Nvidia GeForce 940MX', '564', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR1dUICZBgtAYh5oV6blEHwBXzEfLM2ar8OiPM1Ys5YRE78JbxKMB0aUHT7uQ&s', '2021-12-02 13:37:01'),
(17, 'Lenovo Legion Y520-15IKBN', 'Gaming', '622RTO2', 1, 'Intel Core i5 7300HQ 2.5GHz', '8GB', '128GB SSD +  1TB HDD', 'Nvidia GeForce GTX 1050', '1129', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtdbr6a_oeEiaqFRQPdT2p6cLTxrxDaENELbomAPm88J0wNHR3r1yoQoG8Dw&s', '2021-12-02 13:37:02'),
(18, 'Lenovo IdeaPad 120S-14IAP', 'Notebook', '5YVTT0W', 1, 'Intel Celeron Dual Core N3350 ', '4GB', '64GB Flash Storage', 'Intel HD Graphics 500', '281', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRUReTDFABqKhHBgWj_4EFQWxLo8vXfYypFhbyJ67ZEjXVVrsxzBQQH_gufvqU&s', '2021-12-02 13:37:03'),
(19, 'Lenovo IdeaPad 320-15ISK', 'Notebook', '93V60U9', 1, 'Intel Core i3 6006U 2GHz', '4GB', '128GB SSD', 'Intel HD Graphics 520', '417', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMxCKVqe_OuxWnPOMQuG6GJh8ddS83Y46mJpMdRcqImHcvTfEOpPLSW90Iaw&s', '2021-12-02 13:37:04'),
(20, 'Lenovo Yoga Book', '2 in 1 Convertible', 'D21BDKG', 1, 'Intel Atom x5-Z8550 1.44GHz', '4GB', '64GB Flash Storage', 'Intel HD Graphics 400', '360', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQipxIZE0lTvWokvkCfbyHWTZI5QMALTs-gOLPtt6An9F5Id6qF0RtIeVfljxM&s', '2021-12-02 13:37:05'),
(21, 'Lenovo IdeaPad 520S-14IKB', 'Notebook', 'HKA3ZMF', 1, 'Intel Core i3 7130U 2.7GHz', '8GB', '256GB SSD', 'Intel HD Graphics 620', '677', 2020, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQz02TUP5gOGz8nNrNKfrZnxn9iZMDUbLONanylj8v_Bi3hacPwV8drMzhsWg&s', '2021-12-02 13:37:06'),
(22, 'Lenovo V310-15ISK ', 'Notebook', 'U42KRKJ', 1, 'Intel Core i5 7200U 2.5GHz', '4GB', '1TB HDD', 'Intel HD Graphics 620', '620', 2020, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBcNUAVGb_5X3ZUb2V3zYA9VerbHTbWV5wnwk6teLSjDWY9OBrAYPB8qo6-nY&s', '2021-12-02 13:37:07'),
(23, 'Lenovo IdeaPad 320-15IKBN', 'Notebook', 'T71WW7C', 1, 'Intel Core i5 7200U 2.5GHz', '8GB', '2TB HDD', 'Intel HD Graphics 620', '586', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTAxZhIYninNaILB_50N3rifn6jgMu21lx2_8n9mncFII0kq_Lim7qVAzqzYA&s', '2021-12-02 13:37:08'),
(24, 'Lenovo IdeaPad 320-15AST', 'Notebook', '35U3DNK', 1, 'AMD A6-Series 9220 2.5GHz', '4GB', '128GB SSD', 'AMD R4 Graphics', '451', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGt0gGny44eaQmmoXesT_TvngHOXMbq_IYFyHT7_YOvO1kzQmnXs2GWbvLHQ&s', '2021-12-02 13:37:09'),
(25, 'Lenovo Ideapad 310-15ISK', 'Notebook', 'LIQAJZD', 1, 'Intel Core i3 6006U 2GHz', '4GB', '1TB HDD', 'Intel HD Graphics 520', '469', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmPBZ9nxpUQxOCEG-TKK_C0oswLrMyol7NcXl72myhWX_VWuUPxPFkGAXKaQ&s', '2021-12-02 13:37:10'),
(26, 'Lenovo Thinkpad T470', 'Notebook', '32KK3AZ', 1, 'Intel Core i7 7500U 2.7GHz', '8GB', '256GB SSD', 'Intel HD Graphics 620', '1672', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTQbxzutHCB77gqxLg1ujy6yUb-w84U1Wq_AtBTo25yKLuUtcC7Nk7gyoQ0n8&s', '2021-12-02 13:37:10'),
(27, 'Lenovo ThinkPad Yoga', '2 in 1 Convertible', '6GNV3QY', 1, 'Intel Core i5 7200U 2.5GHz', '8GB', '256GB SSD', 'Intel HD Graphics 620', '1581', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4Qhip88XYSgRr4RY9SZwwpaPi6FEJCR4GPe_xj-jtJ0_Bea0VEoHFEyMcvQ&s', '2021-12-02 13:37:11'),
(28, 'Lenovo IdeaPad 320-15IKBN', 'Notebook', 'HV8R9GX', 1, 'Intel Core i5 7200U 2.5GHz', '8GB', '256GB SSD', 'Nvidia GeForce 940MX', '711', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTAxZhIYninNaILB_50N3rifn6jgMu21lx2_8n9mncFII0kq_Lim7qVAzqzYA&s', '2021-12-02 13:37:12'),
(29, 'Lenovo V110-15IAP (N3350/4GB/1TB/No', 'Notebook', 'Z6IKJS0', 1, 'Intel Celeron Dual Core N3350 ', '4GB', '1TB HDD', 'Intel HD Graphics 500', '285', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_QVQYLojZRcAfDHqXTutse8FErT7jtqCcbeUdo_GzxgcSlqi5MshgHaJHqsY&s', '2021-12-02 13:37:14'),
(30, 'Lenovo IdeaPad 320-15IKBN', 'Notebook', '8E2AI41', 1, 'Intel Core i5 7200U 2.5GHz', '4GB', '1TB HDD', 'Nvidia GeForce 920MX', '564', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTAxZhIYninNaILB_50N3rifn6jgMu21lx2_8n9mncFII0kq_Lim7qVAzqzYA&s', '2021-12-02 13:37:15'),
(31, 'Lenovo ThinkPad E480', 'Notebook', '1UHSD1B', 1, 'Intel Core i5 8250U 1.6GHz', '8GB', '256GB SSD', 'AMD Radeon RX 550', '1261', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTVFWN7A5dBXtzTG3uQHMRmcSPOXWH-s-WfoKq-b0SRMKESmtjXFF9-VjSAg&s', '2021-12-02 13:37:16'),
(32, 'Lenovo Legion Y520-15IKBN', 'Gaming', '8ET70U2', 1, 'Intel Core i7 7700HQ 2.8GHz', '8GB', '256GB SSD', 'Nvidia GeForce GTX 1050M', '982', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtdbr6a_oeEiaqFRQPdT2p6cLTxrxDaENELbomAPm88J0wNHR3r1yoQoG8Dw&s', '2021-12-02 13:37:17'),
(33, 'Lenovo V110-15IKB ', 'Notebook', '3UEP1D6', 1, 'Intel Core i5 7200U 2.5GHz', '4GB', '128GB SSD', 'Intel HD Graphics 620', '563', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQh5PHWYvP0tpKcHs-hvkE7aLUdTPyiQM4aZVeDns_XMp3BBEGDErtDdChDQxg&s', '2021-12-02 13:37:19'),
(34, 'Lenovo Yoga 520-14IKB', '2 in 1 Convertible', 'P6I86FO', 1, 'Intel Core i3 7100U 2.4GHz', '4GB', '256GB SSD', 'Intel HD Graphics 620', '711', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZVa1YWZ6W1Mp7YL0tNk2XyZfG3hSgjZ6okBArGLy0G7YCJ_iJ9O3_LZCBiA&s', '2021-12-02 13:37:20'),
(35, 'Lenovo Legion Y520-15IKBN', 'Gaming', 'UW4LNO7', 1, 'Intel Core i7 7700HQ 2.8GHz', '16GB', '256GB SSD', 'Nvidia GeForce GTX 1050 Ti', '1219', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtdbr6a_oeEiaqFRQPdT2p6cLTxrxDaENELbomAPm88J0wNHR3r1yoQoG8Dw&s', '2021-12-02 13:37:21'),
(36, 'Lenovo IdeaPad 320-15AST', 'Notebook', 'MSSC8QC', 1, 'AMD A6-Series 9220 2.9GHz', '4GB', '500GB HDD', 'AMD Radeon R4 Graphics', '349', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGt0gGny44eaQmmoXesT_TvngHOXMbq_IYFyHT7_YOvO1kzQmnXs2GWbvLHQ&s', '2021-12-02 13:37:22'),
(37, 'Asus ZenBook UX430UN', 'Ultrabook', '1RA0B1N', 2, 'Intel Core i7 8550U 1.8GHz', '16GB', '512GB SSD', 'Nvidia GeForce MX150', '1689', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ43UG0hIs_Z7J20pOkPuozITDGhWPdc9EJvPYzwZ8ItZuudXBx739t3FrTP5M&s', '2021-12-02 13:37:23'),
(38, 'Asus Vivobook E200HA', 'Netbook', '4ZDK0D1', 2, 'Intel Atom x5-Z8350 1.44GHz', '2GB', '32GB Flash Storage', 'Intel HD Graphics 400', '217', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTvQ0rvHZ0i3Zr5GiCfZHn0NXE7ns4hLRLeU1NRvz35T69ZlmU6nh5g8Rb0g&s', '2021-12-02 13:37:24'),
(39, 'Asus E402WA-GA010T ', 'Notebook', 'DHWA9SG', 2, 'AMD E-Series E2-6110 1.5GHz', '2GB', '32GB Flash Storage', 'AMD Radeon R2', '225', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcREhS9Yy_IJqpNonq_v-vPOuzV4fKbndjYbdmJ7KEUDoGf7-DK4ToBuz8j6v1E&s', '2021-12-02 13:37:25'),
(40, 'Asus X540UA-DM186 ', 'Notebook', 'WMDWOSO', 2, 'Intel Core i3 6006U 2GHz', '4GB', '1TB HDD', 'Intel HD Graphics 620', '440', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQD2YpFrf1On31ps2zAMvudRLOBYnM6GFFVel5ksVfpbqAFi8H3Z8aBCYMNPr4&s', '2021-12-02 13:37:26'),
(41, 'Asus X542UQ-GO005 (i5-7200U/8GB/1TB/GeForce', 'Notebook', 'L56L799', 2, 'Intel Core i5 7200U 2.5GHz', '8GB', '1TB HDD', 'Nvidia GeForce 940MX', '591', 2020, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQVvcvOzXN01yEtgNp3KWt52QyNnpUGYRmJstOJwJru2-0IYV1SG5OfUHukBHg&s', '2021-12-02 13:37:27'),
(42, 'Asus Rog Strix', 'Gaming', 'IZ2U4RN', 2, 'AMD Ryzen 1700 3GHz', '8GB', '256GB SSD +  1TB HDD', 'AMD Radeon RX 580', '1468', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQm-9By5a77r5ZeqnQCDL-ARI3-mIB5J9OmeKcAJ99o_THrPIF7CTqV-IZG6GM&s', '2021-12-02 13:37:28'),
(43, 'Asus X751NV-TY001T (N4200/4GB/1TB/GeForce', 'Notebook', 'YJ9ZPYR', 2, 'Intel Pentium Quad Core N4200 ', '4GB', '1TB HDD', 'Nvidia GeForce 920MX', '527', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsnzIecJuC84Qmf2SFLZylCuztgZU6g0n_2sp4_n9MH-tEi60HSpiRbs3F1Ys&s', '2021-12-02 13:37:29'),
(44, 'Asus VivoBook Max', 'Notebook', '40DKTV5', 2, 'Intel Core i5 7200U 2.5GHz', '4GB', '256GB SSD', 'Intel HD Graphics 620', '662', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRX-Lh-YZXq9MtGH03nS-Og_DDZG0M9KVGEpZX1qbZ_yhP04SY2cZ1tly-Pdmw&s', '2021-12-02 13:37:30'),
(45, 'Asus X541UA-DM1897 ', 'Notebook', 'CMAJY34', 2, 'Intel Core i3 6006U 2GHz', '4GB', '256GB SSD', 'Intel HD Graphics 520', '469', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbCRjRi-lH_UJQq-vTbgiuXvRqGBK9XW1rMu17CE7oShmSblvDHHm3T-XDAEM&s', '2021-12-02 13:37:31'),
(46, 'Asus UX410UA-GV350T ', 'Notebook', '7D76E40', 2, 'Intel Core i5 8250U 1.6GHz', '8GB', '256GB SSD', 'Intel UHD Graphics 620', '1063', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTPNkmz4nvQLJfV4wgXtHdmjuMCiLuEPbwivsGiRSvENhaMe4PCHWg8xOHaBg&s', '2021-12-02 13:37:32'),
(47, 'Asus ZenBook Pro', 'Ultrabook', 'L3SO9IC', 2, 'Intel Core i7 7700HQ 2.8GHz', '16GB', '512GB SSD', 'Nvidia GeForce GTX 1050 Ti', '2241', 2020, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR35IsDBaZB4cPPDqJc_0v3Qx9WXPp_1whDuoKC6Y9KAlIFYewtd4EgU_-GIA&s', '2021-12-02 13:37:33'),
(48, 'Asus FX753VE-GC093 (i7-7700HQ/12GB/1TB/GeForce', 'Gaming', 'AEGZR32', 2, 'Intel Core i7 7700HQ 2.8GHz', '12GB', '1TB HDD', 'Nvidia GeForce GTX 1050 Ti', '1072', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlxro3rdH2dGyr2Nz3WUqW5DRQBqNr6mze6cW6igS21e8LG19lk8QxO6UtMr4&s', '2021-12-02 13:37:34'),
(49, 'Asus FX503VD-E4022T (i7-7700HQ/8GB/1TB/GeForce', 'Gaming', 'JARAKKE', 2, 'Intel Core i7 7700HQ 2.8GHz', '8GB', '1TB HDD', 'Nvidia GeForce GTX 1050', '1072', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMMt7aMV1McdMVPTYdq3I2GHYObmfL9NbvMQDNGFv1_9g1ex-pMHyUlkrXjw&s', '2021-12-02 13:37:35'),
(50, 'Asus FX503VM-E4007T (i7-7700HQ/16GB/1TB', 'Gaming', 'I86TLEK', 2, 'Intel Core i7 7700HQ 2.8GHz', '16GB', '128GB SSD +  1TB HDD', 'Nvidia GeForce GTX 1060', '1637', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJ_cGEIyLJOzFOZ9LFhuCjm371Il32MPeUluozxTafgTR8lq8Fb9z0y5SMql4&s', '2021-12-02 13:37:36'),
(51, 'Asus FX550IK-DM018T (FX-9830P/8GB/1TB/Radeon', 'Gaming', 'DDB6PU5', 2, 'AMD FX 9830P 3GHz', '8GB', '1TB HDD', 'AMD Radeon RX 560', '790', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSK-Wu6HNUqzaJLhlpBrRa9dAra8Xcs0DY5WkjYFdtIlRboKwRMqk3ONRPTtNA&s', '2021-12-02 13:37:37'),
(52, 'Asus Zenbook UX430UA', 'Ultrabook', 'E3RXRFI', 2, 'Intel Core i7 7500U 2.7GHz', '8GB', '256GB SSD', 'Intel HD Graphics 620', '1185', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzZZuc7L1NWNvw4CidrsjL6MHJlMriQPS-SsTuOkoHgB5FjkzcZsPvMW-1Rhg&s', '2021-12-02 13:37:38'),
(53, 'Asus X541UV-DM1439T (i3-7100U/6GB/256GB/GeForce', 'Notebook', 'JIPMLQL', 2, 'Intel Core i3 7100U 2.4GHz', '6GB', '256GB SSD', 'Nvidia GeForce 920M', '652', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRC41bSUNnN_v_2vQAaTuFZthcXsZKlF5GmDcXhyymRnA6YwfB0jOo7R7ckhAc&s', '2021-12-02 13:37:39'),
(54, 'Asus UX430UQ-GV209R (i7-7500U/8GB/256GB/GeForce', 'Ultrabook', 'R1Q6SJF', 2, 'Intel Core i7 7500U 2.7GHz', '8GB', '256GB SSD', 'Nvidia GeForce 940MX', '1348', 2020, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS96hTeDV1IRj_IPWaUGYbil8um_BA4SkkTikcOb49JNmqE24Sw-YD-3oP0Vf8&s', '2021-12-02 13:37:40'),
(55, 'Asus VivoBook S15', 'Ultrabook', 'F4WLTR7', 2, 'Intel Core i7 8550U 1.8GHz', '16GB', '256GB SSD +  1TB HDD', 'Nvidia GeForce MX150', '1426', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoTmmdk-M3W0Zn4-ziIRcvnlaoUQ6L3WQogYCGdJUhK3P81hX8zYGDmbx9rA&s', '2021-12-02 13:37:41'),
(56, 'Asus X705UV-BX074T (i3-6006U/4GB/1TB/GeForce', 'Notebook', '2XUFFPK', 2, 'Intel Core i3 6006U 2GHz', '4GB', '1TB HDD', 'Nvidia GeForce 920MX', '637', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQC83i1rVl_OxIracAUk-i3qBDun-90DOPliKv1HeU0jF6RGg8QOJ0VbmMea_g&s', '2021-12-02 13:37:42'),
(57, 'Asus VivoBook S15', 'Notebook', 'E22CWO2', 2, 'Intel Core i7 8550U 1.8GHz', '8GB', '256GB SSD', 'Nvidia GeForce 940MX', '1263', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoTmmdk-M3W0Zn4-ziIRcvnlaoUQ6L3WQogYCGdJUhK3P81hX8zYGDmbx9rA&s', '2021-12-02 13:37:43'),
(58, 'Dell Inspiron 3567', 'Notebook', '9T5CF57', 3, 'Intel Core i3 6006U 2GHz', '4GB', '256GB SSD', 'AMD Radeon R5 M430', '564', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2-iGmdb9dOu0HD09N09UxdLOE_kIcyDAXz5jSVKdEqYqd5NHORWplJs5Hbg&s', '2021-12-02 13:37:44'),
(59, 'Dell Inspiron 3567', 'Notebook', 'ENA7T9C', 3, 'Intel Core i7 7500U 2.7GHz', '8GB', '256GB SSD', 'AMD Radeon R5 M430', '842', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2-iGmdb9dOu0HD09N09UxdLOE_kIcyDAXz5jSVKdEqYqd5NHORWplJs5Hbg&s', '2021-12-02 13:37:45'),
(60, 'Dell XPS 13', 'Ultrabook', '99VOHN3', 3, 'Intel Core i5 8250U 1.6GHz', '8GB', '128GB SSD', 'Intel UHD Graphics 620', '1106', 2020, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7Xcn5eFvSbHEM1lQWunRxMYIa3BDKGpNxZVmAdemW6eHp-2QSukWbrQWYf74&s', '2021-12-02 13:37:46'),
(61, 'Dell Inspiron 5379', '2 in 1 Convertible', '0CWA176', 3, 'Intel Core i5 8250U 1.6GHz', '8GB', '256GB SSD', 'Intel UHD Graphics 620', '925', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQR5zG99Xc-eBMDtDwGIcSzlYGjtMzXgzvTad3NXDIYxVqbBbrtBAJ0KsCuXA&s', '2021-12-02 13:37:46'),
(62, 'Dell Inspiron 3567', 'Notebook', 'ABTBJ0E', 3, 'Intel Core i3 6006U 2GHz', '4GB', '1TB HDD', 'Intel HD Graphics 520', '473', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2-iGmdb9dOu0HD09N09UxdLOE_kIcyDAXz5jSVKdEqYqd5NHORWplJs5Hbg&s', '2021-12-02 13:37:47'),
(63, 'Dell Inspiron 5570', 'Notebook', 'T07STD6', 3, 'Intel Core i5 8250U 1.6GHz', '8GB', '256GB SSD', 'AMD Radeon 530', '904', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTB24QQAY-46kICsdH9PM6D7xmZDCPqFJ5jKcRCguNMugZEejkgGC2zSwvZUQ&s', '2021-12-02 13:37:48'),
(64, 'Dell Latitude 5590', 'Ultrabook', 'E5T2UJ4', 3, 'Intel Core i7 8650U 1.9GHz', '8GB', '256GB SSD +  256GB S', 'Intel UHD Graphics 620', '1467', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjLkjoI_s0rbFUFU1lAfRcnlsN6mxmYW1lYOEAgjNE4cYIV33Uf8_XhLXXKA&s', '2021-12-02 13:37:49'),
(65, 'Dell XPS 13', 'Ultrabook', 'JXZ3M5A', 3, 'Intel Core i7 8550U 1.8GHz', '16GB', '512GB SSD', 'Intel UHD Graphics 620', '2112', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7Xcn5eFvSbHEM1lQWunRxMYIa3BDKGpNxZVmAdemW6eHp-2QSukWbrQWYf74&s', '2021-12-02 13:37:50'),
(66, 'Dell Inspiron 5770', 'Notebook', 'EM7HOJY', 3, 'Intel Core i5 8250U 1.6GHz', '8GB', '128GB SSD +  1TB HDD', 'AMD Radeon 530', '1106', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRJFbt0933DEqdESTd9LkTWBqF95kBbQRmAscPQZDI8S7i9IXBpCJXheNmPWEE&s', '2021-12-02 13:37:51'),
(67, 'Dell Inspiron 7577', 'Gaming', '0I316PM', 3, 'Intel Core i7 7700HQ 2.8GHz', '16GB', '256GB SSD +  1TB HDD', 'Nvidia GeForce GTX 1060', '1694', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFcGQm64Rk4Isj5DpKb-7wmgdo0LaOq4iN-6d5yDL4YUI0yW42xOPm16T9zg&s', '2021-12-02 13:37:52'),
(68, 'Dell Inspiron 7773', '2 in 1 Convertible', 'Q27DSQC', 3, 'Intel Core i5 8250U 1.6GHz', '12GB', '1TB HDD', 'Nvidia GeForce 150MX', '1129', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9UMRXaa10qVknvNBXLx0RhmnqdE1Vdrb6qZZfI6lzn4muFlGTfh0HF4WLvek&s', '2021-12-02 13:37:53'),
(69, 'Dell Inspiron 3567', 'Notebook', 'IS8D3UA', 3, 'Intel Core i5 7200U 2.5GHz', '4GB', '256GB SSD', 'AMD Radeon R5 M430', '722', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2-iGmdb9dOu0HD09N09UxdLOE_kIcyDAXz5jSVKdEqYqd5NHORWplJs5Hbg&s', '2021-12-02 13:37:53'),
(70, 'Dell Inspiron 3576', 'Notebook', 'PTYD9TO', 3, 'Intel Core i7 8550U 1.8GHz', '8GB', '256GB SSD', 'AMD Radeon 520', '868', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTPj1x1twJ1WNksngp1XNZXP7kHrMkFpdJCAUoQYd1uuvTXE6nZAFny2LfKg&s', '2021-12-02 13:37:54'),
(71, 'Dell Inspiron 5770', 'Notebook', 'RLBMLX5', 3, 'Intel Core i7 8550U 1.8GHz', '16GB', '256GB SSD +  2TB HDD', 'AMD Radeon 530', '1468', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRJFbt0933DEqdESTd9LkTWBqF95kBbQRmAscPQZDI8S7i9IXBpCJXheNmPWEE&s', '2021-12-02 13:37:55'),
(72, 'Dell Vostro 5471', 'Ultrabook', 'FL3JLFW', 3, 'Intel Core i5 8250U 1.6GHz', '8GB', '256GB SSD', 'Intel UHD Graphics 620', '993', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTks7pxChyjNTTBOPYPQuFZwq7L-7_76fuUjWvGUyWcUVU9uCdibpKoBHui3A&s', '2021-12-02 13:37:56'),
(73, 'Dell Inspiron 5370', 'Ultrabook', 'CMWVD49', 3, 'Intel Core i7 8550U 1.8GHz', '8GB', '256GB SSD', 'AMD Radeon 530', '1079', 2020, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9-tVC8TjXnqnOooT8ANbyQCiXcgHTjGaDrN2ePUhzVNe7EH0kbcIKoorbDQw&s', '2021-12-02 13:37:57'),
(74, 'Dell Inspiron 5570', 'Notebook', 'UETJSIH', 3, 'Intel Core i7 8550U 1.8GHz', '8GB', '256GB SSD', 'AMD Radeon 530', '983', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTB24QQAY-46kICsdH9PM6D7xmZDCPqFJ5jKcRCguNMugZEejkgGC2zSwvZUQ&s', '2021-12-02 13:37:58'),
(75, 'Dell Inspiron 5570', 'Notebook', '3Z2XLOG', 3, 'Intel Core i7 8550U 1.8GHz', '8GB', '128GB SSD +  1TB HDD', 'Intel UHD Graphics 620', '966', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTB24QQAY-46kICsdH9PM6D7xmZDCPqFJ5jKcRCguNMugZEejkgGC2zSwvZUQ&s', '2021-12-02 13:37:59'),
(76, 'Dell Latitude 5590', 'Ultrabook', '59DY4Q2', 3, 'Intel Core i5 8250U 1.6GHz', '8GB', '256GB SSD', 'Intel UHD Graphics 620', '1239', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjLkjoI_s0rbFUFU1lAfRcnlsN6mxmYW1lYOEAgjNE4cYIV33Uf8_XhLXXKA&s', '2021-12-02 13:38:00'),
(77, 'Dell Inspiron 7577', 'Gaming', '6U6XG84', 3, 'Intel Core i7 7700HQ 2.8GHz', '16GB', '128GB SSD +  1TB HDD', 'Nvidia GeForce GTX 1050 Ti', '1524', 2020, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFcGQm64Rk4Isj5DpKb-7wmgdo0LaOq4iN-6d5yDL4YUI0yW42xOPm16T9zg&s', '2021-12-02 13:38:01'),
(78, 'Dell XPS 13', 'Ultrabook', 'Q44OLIP', 3, 'Intel Core i7 8550U 1.8GHz', '8GB', '256GB SSD', 'Intel UHD Graphics 620', '1863', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7Xcn5eFvSbHEM1lQWunRxMYIa3BDKGpNxZVmAdemW6eHp-2QSukWbrQWYf74&s', '2021-12-02 13:38:01'),
(79, 'HP 250 G6', 'Notebook', 'OUW5VR2', 4, 'Intel Core i5 7200U 2.5GHz', '8GB', '256GB SSD', 'Intel HD Graphics 620', '650', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvjUK88DJ_RnLqRj6opyFCYtDo-VKQzcOptak9MZVRk87ykhkhs-dtQMZF0iM&s', '2021-12-02 13:38:02'),
(80, 'HP 250 G6', 'Notebook', 'VE54NYS', 4, 'Intel Core i5 7200U 2.5GHz', '4GB', '500GB HDD', 'Intel HD Graphics 620', '445', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvjUK88DJ_RnLqRj6opyFCYtDo-VKQzcOptak9MZVRk87ykhkhs-dtQMZF0iM&s', '2021-12-02 13:38:03'),
(81, 'HP 250 G6', 'Notebook', 'U49EMXM', 4, 'Intel Core i3 6006U 2GHz', '4GB', '500GB HDD', 'Intel HD Graphics 520', '390', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvjUK88DJ_RnLqRj6opyFCYtDo-VKQzcOptak9MZVRk87ykhkhs-dtQMZF0iM&s', '2021-12-02 13:38:04'),
(82, 'HP 255 G6', 'Notebook', 'SZXRSOY', 4, 'AMD E-Series E2-9000e 1.5GHz', '4GB', '500GB HDD', 'AMD Radeon R2', '292', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTdxgWyAMZpzOskRBZf4rfrewF6WTBJpJQC_-f0-SOQX4a9VWCDYmRinrOJw&s', '2021-12-02 13:38:05'),
(83, 'HP 15-BS101nv ', 'Ultrabook', 'EY7WCOH', 4, 'Intel Core i7 8550U 1.8GHz', '8GB', '256GB SSD', 'Intel HD Graphics 620', '745', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZSkG5bcui24lO3qhn6jXDnWF6hK8lfHF0-j8BHsD_k-AMkZ5w_JjCBtXySQM&s', '2021-12-02 13:38:06'),
(84, 'HP ProBook 470', 'Notebook', 'RSEWT3E', 4, 'Intel Core i5 8250U 1.6GHz', '8GB', '1TB HDD', 'Nvidia GeForce 930MX', '1012', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS9Zoe5wqv8JKFesnHh5EPCDh4wDxDkIx7TkWXTmxyEzUG6uq6hPjjjm6EHNcs&s', '2021-12-02 13:38:08'),
(85, 'HP 17-ak001nv (A6-9220/4GB/500GB/Radeon', 'Notebook', 'MNGFBJC', 4, 'AMD A6-Series 9220 2.5GHz', '4GB', '500GB HDD', 'AMD Radeon 530', '496', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX_snmQkG81NvFx_aNj9C_ODxj9RDpMHRRMJ2uaj9-KVGHUQ3BB0bdDn5qfw&s', '2021-12-02 13:38:09'),
(86, 'HP 250 G6', 'Notebook', 'S4CHBWY', 4, 'Intel Core i5 7200U 2.5GHz', '4GB', '1TB HDD', 'Intel HD Graphics 620', '552', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvjUK88DJ_RnLqRj6opyFCYtDo-VKQzcOptak9MZVRk87ykhkhs-dtQMZF0iM&s', '2021-12-02 13:38:10'),
(87, 'HP ProBook 450', 'Notebook', '7IRPSI0', 4, 'Intel Core i5 8250U 1.6GHz', '8GB', '256GB SSD', 'Nvidia GeForce 930MX ', '993', 2020, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDQ60tJ-w9KrDdzBB4Dpg5J6cSuCUJI6-yw64lyaX-S-0_vphIe6hvGL3D0BI&s', '2021-12-02 13:38:11'),
(88, 'HP 255 G6', 'Notebook', 'EGZTDDL', 4, 'AMD A6-Series 9220 2.5GHz', '4GB', '256GB SSD', 'AMD Radeon R4 Graphics', '450', 2020, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTdxgWyAMZpzOskRBZf4rfrewF6WTBJpJQC_-f0-SOQX4a9VWCDYmRinrOJw&s', '2021-12-02 13:38:12'),
(89, 'HP ProBook 430', 'Notebook', 'BLLD4N3', 4, 'Intel Core i7 8550U 1.8GHz', '8GB', '512GB SSD', 'Intel UHD Graphics 620', '1246', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRonrGOhzCO1ZMF3o_Uzc2z6bKcM0owG2-juJ1zUQjPK3U-153QEJjhID4sRi4&s', '2021-12-02 13:38:13'),
(90, 'HP 15-bs002nv ', 'Notebook', 'C0T9IV3', 4, 'Intel Core i3 6006U 2GHz', '4GB', '128GB SSD', 'Intel HD Graphics 520', '496', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRONF4elAF8kvDlnvMIYFiWOcN66MIFn0iaqCothddy-dfut4pufpSTt06Alw&s', '2021-12-02 13:38:14'),
(91, 'HP 250 G6', 'Notebook', '509RLEJ', 4, 'Intel Core i5 7200U 2.5GHz', '8GB', '256GB SSD', 'Intel HD Graphics 620', '780', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvjUK88DJ_RnLqRj6opyFCYtDo-VKQzcOptak9MZVRk87ykhkhs-dtQMZF0iM&s', '2021-12-02 13:38:15'),
(92, 'HP 250 G6', 'Notebook', '78M1LVC', 4, 'Intel Core i3 6006U 2GHz', '4GB', '500GB HDD', 'AMD Radeon 520', '496', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvjUK88DJ_RnLqRj6opyFCYtDo-VKQzcOptak9MZVRk87ykhkhs-dtQMZF0iM&s', '2021-12-02 13:38:16'),
(93, 'HP Stream 14-AX040wm', 'Notebook', 'Y9G5AHM', 4, 'Intel Celeron Dual Core N3060 ', '4GB', '32GB SSD', 'Intel HD Graphics 400', '259', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSt9h3WPdURDyTj7uEg7WSF8JWyBbSyhZfxO-k8NKBiU9uS4Z-5mzA0Mei9LjQ&s', '2021-12-02 13:38:17'),
(94, 'HP ProBook 470', 'Notebook', 'FVUMAK0', 4, 'Intel Core i5 8250U 1.6GHz', '8GB', '128GB SSD +  1TB HDD', 'Nvidia GeForce 930MX', '1104', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS9Zoe5wqv8JKFesnHh5EPCDh4wDxDkIx7TkWXTmxyEzUG6uq6hPjjjm6EHNcs&s', '2021-12-02 13:38:18'),
(95, 'HP ProBook 440', 'Notebook', 'Y68MRJR', 4, 'Intel Core i5 8250U 1.6GHz', '8GB', '256GB SSD', 'Intel HD Graphics 620', '972', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRUIwhqJQB7rmed6lDLJLScdmXWFm0_R5jkstsGjz4ODx9z5LEv7JUnPxWN9A&s', '2021-12-02 13:38:19'),
(96, 'HP Pavilion 15-CK000nv', 'Ultrabook', '5TKQG5R', 4, 'Intel Core i7 8550U 1.8GHz', '8GB', '256GB SSD', 'Nvidia GeForce GTX 940MX', '790', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSG138ZGCm1yoIJQw_Wt5FzJNPO2FMTrDI5nwxc5a3QVCzDN8h80wz-SLgDgA&s', '2021-12-02 13:38:20'),
(97, 'HP 250 G6', 'Notebook', 'ILI50PK', 4, 'Intel Core i5 7200U 2.5GHz', '8GB', '256GB SSD', 'Intel HD Graphics 620', '677', 2020, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvjUK88DJ_RnLqRj6opyFCYtDo-VKQzcOptak9MZVRk87ykhkhs-dtQMZF0iM&s', '2021-12-02 13:38:21'),
(98, 'HP Probook 430', 'Notebook', 'MZ4L0FB', 4, 'Intel Core i7 8550U 1.8GHz', '16GB', '512GB SSD', 'Intel UHD Graphics 620', '1353', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRonrGOhzCO1ZMF3o_Uzc2z6bKcM0owG2-juJ1zUQjPK3U-153QEJjhID4sRi4&s', '2021-12-02 13:38:22'),
(99, 'HP Omen 15-ce007nv', 'Gaming', 'Q4J3R64', 4, 'Intel Core i7 7700HQ 2.8GHz', '12GB', '128GB SSD +  1TB HDD', 'Nvidia GeForce GTX 1050', '1411', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8IVKp28jCTAnRrmVfIBiJiX9726bLdaQzY-F5oDHsSvLqv0irR-TAWT5xQw&s', '2021-12-02 13:38:23'),
(100, 'Acer Aspire 3', 'Notebook', 'ZGXMOKX', 5, 'AMD A9-Series 9420 3GHz', '4GB', '500GB HDD', 'AMD Radeon R5', '452', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHibrh0F7MpaUomsthKn3xs5V60yFr0xbDhkJvijd9LygOU_nzpxZFeoncIQ&s', '2021-12-02 13:38:24'),
(101, 'Acer Swift 3', 'Ultrabook', 'J4RDUXK', 5, 'Intel Core i5 8250U 1.6GHz', '8GB', '256GB SSD', 'Intel UHD Graphics 620', '870', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8Lom_c6d60rG5sgLLAt50r6B-NkzyBWj2tBPli_0szjIAjP3scw_L_3gJxg&s', '2021-12-02 13:38:25'),
(102, 'Acer Aspire 3', 'Notebook', 'K49CT93', 5, 'Intel Core i3 7130U 2.7GHz', '4GB', '1TB HDD', 'Intel HD Graphics 620', '415', 2020, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHibrh0F7MpaUomsthKn3xs5V60yFr0xbDhkJvijd9LygOU_nzpxZFeoncIQ&s', '2021-12-02 13:38:26'),
(103, 'Acer Aspire A515-51G', 'Notebook', 'NMV8KMF', 5, 'Intel Core i5 8250U 1.6GHz', '4GB', '256GB SSD', 'Intel UHD Graphics 620', '771', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQI0MIx083NBtVStfjUkOskLoosbA047PiVoA8LHig2rBqna4ir6XRRraMyaVs&s', '2021-12-02 13:38:27'),
(104, 'Acer Aspire A515-51G', 'Notebook', '5EP1ZER', 5, 'Intel Core i7 8550U 1.8GHz', '8GB', '256GB SSD', 'Nvidia GeForce MX150', '950', 2020, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQI0MIx083NBtVStfjUkOskLoosbA047PiVoA8LHig2rBqna4ir6XRRraMyaVs&s', '2021-12-02 13:38:28'),
(105, 'Acer Aspire 3', 'Notebook', 'ES4ZYME', 5, 'Intel Core i3 7100U 2.4GHz', '4GB', '1TB HDD', 'Intel HD Graphics 620', '434', 2019, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHibrh0F7MpaUomsthKn3xs5V60yFr0xbDhkJvijd9LygOU_nzpxZFeoncIQ&s', '2021-12-02 13:38:29'),
(106, 'Acer Aspire E5-475', 'Notebook', 'QEBRW5K', 5, 'Intel Core i3 6006U 2GHz', '8GB', '1TB HDD', 'Intel HD Graphics 520', '440', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS9KAgNKdCupUwDpnWdHXyDOMbqLwvngfjqtAkA7BV71iGs2IWAJ737yfGBYg&s', '2021-12-02 13:38:30'),
(107, 'Acer Aspire A515-51G-32MX', 'Notebook', 'LJN2HKX', 5, 'Intel Core i3 7130U 2.7GHz', '4GB', '1TB HDD', 'Nvidia GeForce MX130', '599', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjVfXK7tuO6lP9YhA8bpbU2hGDzLG8behFT41VgssLbRLBD6rx4MclPeOHbg&s', '2021-12-02 13:38:31'),
(108, 'Acer Aspire 3', 'Notebook', 'MIO72PY', 5, 'AMD A9-Series 9420 3GHz', '4GB', '1TB HDD', 'AMD Radeon R5', '446', 2020, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHibrh0F7MpaUomsthKn3xs5V60yFr0xbDhkJvijd9LygOU_nzpxZFeoncIQ&s', '2021-12-02 13:38:32'),
(109, 'Acer Aspire 5', 'Notebook', 'T1O6HQ3', 5, 'Intel Core i7 8550U 1.8GHz', '8GB', '1TB HDD', 'Nvidia GeForce MX150', '779', 2020, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRu7g2JGbvmwpahNUmtvvU5VAOpmhpSCTNBbxx1qUSop5g12e2Lrv2gjPHPug&s', '2021-12-02 13:38:33'),
(110, 'Acer Spin 5', '2 in 1 Convertible', '94C9GL9', 5, 'Intel Core i5 8250U 1.6GHz', '8GB', '256GB SSD', 'Intel UHD Graphics 620', '957', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRRDAQjOc88Vh9LZrzjxB-N7S3WM7Lrf0AeDZkk1UXHX_3Aaeo_Cy5HzgT9poE&s', '2021-12-02 13:38:34'),
(111, 'Acer Spin 3', 'Notebook', 'BU3EON8', 5, 'Intel Core i3 7100U 2.4GHz', '6GB', '1TB HDD', 'Intel HD Graphics 620', '541', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR-8jU7vU9KYbxppr4b15qZAaYwIcdZ4sLJSS9a-lviG9nVFlcS8ePGiRpamqM&s', '2021-12-02 13:38:35'),
(112, 'Acer Aspire 3', 'Notebook', 'ST7A1OD', 5, 'AMD A9-Series 9420 3GHz', '4GB', '256GB SSD', 'AMD Radeon R5', '510', 2020, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHibrh0F7MpaUomsthKn3xs5V60yFr0xbDhkJvijd9LygOU_nzpxZFeoncIQ&s', '2021-12-02 13:38:36'),
(113, 'Acer Swift 3', 'Ultrabook', '98Y8U6I', 5, 'Intel Core i7 8550U 1.8GHz', '8GB', '256GB SSD', 'Intel UHD Graphics 620', '999', 2018, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8Lom_c6d60rG5sgLLAt50r6B-NkzyBWj2tBPli_0szjIAjP3scw_L_3gJxg&s', '2021-12-02 13:38:37'),
(114, 'Acer Aspire A515-51G-37JS', 'Notebook', 'DUIFKRU', 5, 'Intel Core i3 7130U 2.7GHz', '4GB', '256GB SSD', 'Nvidia GeForce MX130', '646', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjVfXK7tuO6lP9YhA8bpbU2hGDzLG8behFT41VgssLbRLBD6rx4MclPeOHbg&s', '2021-12-02 13:38:38'),
(115, 'Acer Aspire 5', 'Notebook', 'C4EKZPF', 5, 'Intel Core i3 7130U 2.7GHz', '4GB', '1TB HDD', 'Nvidia GeForce MX130', '740', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRu7g2JGbvmwpahNUmtvvU5VAOpmhpSCTNBbxx1qUSop5g12e2Lrv2gjPHPug&s', '2021-12-02 13:38:39'),
(116, 'Acer Aspire A315-51', 'Notebook', '7IHZXWQ', 5, 'Intel Core i3 6006U 2GHz', '4GB', '1TB HDD', 'Intel HD Graphics 520', '505', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTc1oat-XetPfo9ncfB1zbT2wRNSrKXbVrSgi8yHuB7w1JjOYG8Lx4eYR2hwNI&s', '2021-12-02 13:38:40'),
(117, 'Acer Aspire A517-51G', 'Notebook', 'DEGD27T', 5, 'Intel Core i5 8250U 1.6GHz', '4GB', '256GB SSD', 'Nvidia GeForce MX150', '910', 2021, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQrWwn1padFaNLMuJPZMJwGr3U3m9XlYC6NqG4OsXAAeOVvG__rLFFlTzeOYS4&s', '2021-12-02 13:38:41'),
(118, 'Acer Aspire A315-31', 'Notebook', 'ULKVUQP', 5, 'Intel Celeron Dual Core N3350 ', '4GB', '1TB HDD', 'Intel HD Graphics 500', '393', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4Y5v-sIh4MbC_4Rjh5ZoR_LjCR6bgn7QfEGXkOz4QVeFkHQxS2r7FaZ_2aIg&s', '2021-12-02 13:38:42'),
(119, 'Acer Aspire 3', 'Notebook', 'MMJ2XWA', 5, 'Intel Pentium Quad Core N4200 ', '4GB', '1TB HDD', 'Intel HD Graphics 505', '411', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHibrh0F7MpaUomsthKn3xs5V60yFr0xbDhkJvijd9LygOU_nzpxZFeoncIQ&s', '2021-12-02 13:38:43'),
(120, 'Acer Aspire A517-51G', 'Notebook', '8X4LY48', 5, 'Intel Core i5 8250U 1.6GHz', '8GB', '256GB SSD', 'Nvidia GeForce MX150', '965', 2017, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQrWwn1padFaNLMuJPZMJwGr3U3m9XlYC6NqG4OsXAAeOVvG__rLFFlTzeOYS4&s', '2021-12-02 13:38:44');

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
(1, 1, '0', '2021-12-02 20:41:36');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `username`, `password`, `firstname`, `lastname`, `created_at`) VALUES
(0, 'electrostaff1@gmail.com', '$2y$10$7T/3eIlxSC75kxmPsqySWusYb1Fc9GC8CR68qFNfq23S9S8FUZ8cO', 'Vu', 'Thai', '2021-11-23 05:05:10');

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
(4, 'd.atien228@gmail.com', '$2y$10$oONwELxl64N5hS.6lGGVweXtF.EBvf1bVCdPZTBEs9oqYfYTmutFO', 'Tien', 'Doan', NULL, NULL, '2003-01-01', '2021-11-16 08:27:44'),
(5, 'long123@gmail.com', '$2y$10$z2QcVfa1ZKH9PN77PMPJb.pzQDdbiqlAHceHYoCWt/HtDBgn7XjQm', 'Long', 'Nguyen', NULL, NULL, '2003-01-01', '2021-11-22 20:10:21');

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
-- Indexes for table `staff`
--
ALTER TABLE `staff`
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
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
