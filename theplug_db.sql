-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: May 05, 2025 at 03:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theplug_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `type` enum('percent','fixed') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `banner_message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `code`, `type`, `amount`, `is_active`, `start_date`, `end_date`, `banner_message`) VALUES
(1, '10%OFF', 'percent', 10.00, 0, NULL, NULL, NULL),
(2, 'SAVE5EURO', 'fixed', 5.00, 0, NULL, NULL, NULL),
(4, 'BF30%', 'percent', 30.00, 0, '2025-04-27', '2025-04-28', 'Black Friday 30% OFF!'),
(5, '20EUROBOOM', 'fixed', 20.00, 0, '2025-04-27', '2025-04-29', 'Use Code 20EUROBOOM For 20 Euro OFf!'),
(6, 'BEN10', 'percent', 10.00, 1, '2025-05-04', '2025-05-07', '⌚USE CODE BEN10 FOR 10% OFF ⌚');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `delivery_method` varchar(255) NOT NULL DEFAULT '? Delivery',
  `payment_method` varchar(50) DEFAULT NULL,
  `discount_code` varchar(50) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `discount_total` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_email`, `full_name`, `address`, `contact`, `delivery_method`, `payment_method`, `discount_code`, `total`, `discount_total`, `created_at`, `user_id`, `status`) VALUES
(1, 'guest@example.com', 'Matas Zostautas', '123 Main Road', NULL, 'Express', 'PayPal', NULL, 115.00, NULL, '2025-03-25 00:41:25', 0, 'Processing 🔄'),
(2, 'guest@example.com', 'Ethan Teixeira', '1234 Main Street', NULL, 'Pickup', 'Apple Pay', NULL, 108.00, NULL, '2025-03-25 00:45:30', 0, 'Processing 🔄'),
(3, 'guest@example.com', 'Matas Zos', '12345 Rpad', NULL, 'Standard', 'Card', NULL, 115.00, NULL, '2025-03-25 00:49:46', 0, 'Processing 🔄'),
(6, NULL, '', '', NULL, '', NULL, NULL, 600.00, NULL, '2025-03-25 16:52:07', 4, 'Pending ⏳'),
(7, NULL, '', '', NULL, '', NULL, NULL, 600.00, NULL, '2025-03-25 16:52:08', 4, 'Pending ⏳'),
(8, NULL, '', '', NULL, '', NULL, NULL, 600.00, NULL, '2025-03-25 16:52:08', 4, 'Pending ⏳'),
(9, NULL, '', '', NULL, '', NULL, NULL, 1900.00, NULL, '2025-03-25 16:52:17', 4, 'Pending ⏳'),
(10, NULL, '', '', NULL, '', NULL, NULL, 1900.00, NULL, '2025-03-25 16:53:10', 4, 'Pending ⏳'),
(11, NULL, '', '', NULL, '', NULL, NULL, 9000.00, NULL, '2025-03-25 17:04:14', 2, 'Pending ⏳'),
(12, NULL, 'Matas Zostautas', '123', '0899995555', 'delivery', 'Pay at counter', 'SAVE5EURO', 1615.00, NULL, '2025-03-25 17:27:47', 2, 'Cancelled ❌'),
(13, NULL, 'Matas Zostautas', '123', '0899995555', 'pickup', 'Pay at counter', 'SAVE5EURO', 295.00, NULL, '2025-03-25 18:36:45', 2, 'Pending ⏳'),
(14, NULL, 'Matas Zostautas', 'Poland is an L country', '0899995555', 'delivery', 'MasterCard', 'SAVE5EURO', 115.00, NULL, '2025-03-26 10:01:14', 4, 'Pending ⏳'),
(15, NULL, 'Matas Zostautas', 'L', '0899995555', 'delivery', 'Visa', 'SAVE5EURO', 295.00, NULL, '2025-03-26 10:02:01', 4, 'Pending ⏳'),
(16, NULL, 'Matas Zostautas', '123', '0899995555', 'delivery', 'Visa', '', 300.00, NULL, '2025-03-26 10:07:20', 2, 'Delivered 📦'),
(17, NULL, 'Matas Zostautas', 'Ethan is failing us', '0899995555', 'delivery', 'Visa', '', 300.00, NULL, '2025-03-26 10:08:20', 2, 'Delivered 📦'),
(18, NULL, 'Matas Zostautas', 'iug', '0899995555', 'delivery', 'Visa', '', 300.00, NULL, '2025-03-26 10:09:55', 2, 'Shipped 🚚'),
(19, NULL, 'Matas Zostautas', 'qw', '0899995555', 'delivery', 'Visa', '', 300.00, NULL, '2025-03-26 10:11:03', 2, 'Delivered 📦'),
(20, NULL, 'Matas Zostautas', 'ygv', '0899995555', 'delivery', 'Visa', '', 300.00, NULL, '2025-03-26 10:30:58', 2, 'Cancelled ❌'),
(21, NULL, 'Matas Zostautas', 'gv', '0899995555', 'delivery', 'Visa', '', 300.00, NULL, '2025-03-26 10:31:18', 2, 'Pick up at store 🏬'),
(22, NULL, 'Matas Zostautas', 'ihuh', '0899995555', 'delivery', 'Visa', '', 400.00, NULL, '2025-03-26 11:17:46', 2, 'Processing 🔄'),
(23, NULL, 'Matas Zostautas', 'ih', '0899995555', 'delivery', 'Visa', '', 400.00, NULL, '2025-03-26 11:18:41', 2, 'Delivery to 🏠'),
(24, NULL, 'Matas Zostautas', 'FGYF', '0899995555', 'delivery', 'Visa', 'SAVE5EURO', 135.00, NULL, '2025-03-26 11:23:49', 2, 'Pending ⏳'),
(25, NULL, 'Matas Zostautas', 'TYFF', '0899995555', 'pickup', 'Revolut', '10%OFF', 4990.00, NULL, '2025-03-26 11:25:06', 2, 'Pending ⏳'),
(26, NULL, 'Matas Zostautas', 'asdd', '0899995555', 'delivery', 'Visa', '5EUROOFF', 10000.00, NULL, '2025-03-26 12:46:48', 2, 'Shipped 🚚'),
(27, NULL, 'adaa', 'adaada', '4320090042', 'delivery', 'MasterCard', 'SAVE5EURO', 284.00, NULL, '2025-03-26 14:10:07', 2, 'Pending ⏳'),
(28, NULL, '231241', '312321', '3141141', 'delivery', 'MasterCard', 'SAVE5EURO', 4995.00, NULL, '2025-03-26 15:16:22', 2, ''),
(29, NULL, '3e42', '191Squk road', '929439429432', 'delivery', 'Visa', 'SAVE5EURO', 115.00, NULL, '2025-03-26 15:50:11', 2, ''),
(30, 'Monkey@monkey.com', '', 'Pickup Only', '', 'Delivery', '', '', 10540.00, NULL, '2025-04-06 22:12:56', 6, 'Shipped'),
(31, 'guest@domain.com', '', '', '', 'Pick-Up', '', NULL, 10540.00, NULL, '2025-04-06 22:18:38', 6, ''),
(32, 'guest@domain.com', '', '', '', 'Pick-Up', '', '', 720.00, NULL, '2025-04-07 03:29:08', 6, ''),
(33, 'guest@domain.com', '', '', '', 'Delivery', '', '', 1200.00, NULL, '2025-04-07 03:43:25', 6, ''),
(34, 'guest@domain.com', '', '', '', 'Delivery', '', '', 400.00, NULL, '2025-04-07 04:28:50', 6, 'Processing'),
(35, 'guest@domain.com', '', '', '', 'Delivery', '', '', 3300.00, NULL, '2025-04-07 08:55:12', 6, 'Processing'),
(36, 'guest@domain.com', '', '', '', 'Delivery', '', '', 1660.00, NULL, '2025-04-07 09:02:24', 6, 'Processing'),
(37, 'bigback@gmail.com', '', '', '', 'Delivery', '', '', 100.00, NULL, '2025-04-07 09:11:00', 7, 'Processing'),
(38, 'test123@gmail.com', '', '', '', 'Delivery', '', '', 5300.00, NULL, '2025-04-07 15:30:30', 8, 'Processing'),
(39, 'alex@gmail.com', '', '', '', 'Delivery', '', '', 400.00, NULL, '2025-04-07 16:22:58', 9, 'Processing'),
(40, 'Monkey@monkey.com', '', '', '', 'Delivery', '', '', 1200.00, NULL, '2025-04-07 16:31:27', 6, 'Processing'),
(41, 'Monkey@monkey.com', '', '', '', 'Delivery', '', '', 200.00, NULL, '2025-04-09 13:58:08', 6, 'Processing'),
(42, 'Monkey@monkey.com', '', '', '', 'Delivery', '', '', 300.00, NULL, '2025-04-24 19:18:29', 6, '⏳ Pending'),
(43, 'Monkey@monkey.com', '', '', '', 'Delivery', '', NULL, 600.00, 600.00, '2025-04-24 19:38:51', 6, '⏳ Pending'),
(44, 'Monkey@monkey.com', '', '', '', 'Delivery', '', NULL, 120.00, 120.00, '2025-04-24 19:56:35', 6, '🚚 Shipped'),
(45, 'Monkey@monkey.com', '', '', '', 'Delivery', '', NULL, 9000.00, 9000.00, '2025-04-24 21:55:55', 6, 'Processing'),
(46, 'Monkey@monkey.com', '', '', '', 'Delivery', '', NULL, 100.00, 100.00, '2025-04-24 22:20:42', 6, '🚚 Shipped'),
(47, 'Monkey@monkey.com', '', '', '', 'Delivery', '', '10%off', 12200.00, 10980.00, '2025-04-27 02:09:00', 6, '🚚 Shipped'),
(48, 'Monkey@monkey.com', '', '', '', 'Delivery', '', 'SAVE5EURO', 10000.00, 9995.00, '2025-04-27 03:13:23', 6, '❌ Cancelled'),
(49, 'Monkey@monkey.com', '', '', '', 'Delivery', '', NULL, 140.00, 140.00, '2025-04-27 04:56:38', 6, '❌ Cancelled'),
(50, 'Monkey@monkey.com', '', '', '', 'Delivery', '', 'BF30%', 5000.00, 5000.00, '2025-04-27 05:24:08', 6, '❌ Cancelled'),
(51, 'Monkey@monkey.com', '', '', '', 'Delivery', '', 'BF30%', 200.00, 200.00, '2025-04-27 05:34:42', 6, '❌ Cancelled'),
(52, 'Monkey@monkey.com', '', '', '', 'Delivery', '', '10%OFF', 3100.00, 3100.00, '2025-04-27 05:35:56', 6, '❌ Cancelled'),
(53, 'Monkey@monkey.com', '', '', '', 'Delivery', '', '20EUROBOOM', 320.00, 300.00, '2025-04-27 06:15:48', 6, '🚚 Shipped'),
(54, 'Monkey@monkey.com', '4124124', '14111412', '1456456', '? Delivery', 'Visa', 'BEN10', 2760.00, 2484.00, '2025-05-04 04:01:00', 6, 'Pending'),
(55, 'Monkey@monkey.com', 'Jobn', 'Bigback Road', 'Lucky ROck', '? Delivery', 'MasterCard', 'BEN10', 120.00, 108.00, '2025-05-04 04:02:31', 6, 'Pending'),
(56, 'Monkey@monkey.com', '4123414', '1241212', '43634634', '? Delivery', 'MasterCard', 'BEN10', 1300.00, 1170.00, '2025-05-04 04:05:17', 6, 'Pending'),
(57, 'Monkey@monkey.com', 'Monkey D Luffy', 'laughTale 254 streeat', '903205826345', '? Delivery', 'Visa', 'BEN10', 1300.00, 1170.00, '2025-05-04 04:10:52', 6, 'Pending'),
(58, 'Monkey@monkey.com', 'Big Bob', '213 Luffy Road', '32544632134', '? Delivery', 'Visa', 'BEN10', 120.00, 108.00, '2025-05-04 22:04:17', 6, 'Pending'),
(59, 'Monkey@monkey.com', '3342342', '342342', '343242', '? Delivery', 'MasterCard', 'BEN10', 140.00, 126.00, '2025-05-04 23:13:46', 6, 'Pending'),
(60, 'Monkey@monkey.com', 'T3', 'T4', 'T65', '? Delivery', 'MasterCard', 'BEN10', 120.00, 108.00, '2025-05-04 23:16:44', 6, 'Pending'),
(61, 'Monkey@monkey.com', 't3', '3t3', '3t23', '? Delivery', 'Visa', 'BEN10', 600.00, 540.00, '2025-05-04 23:21:04', 6, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `color` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `price`, `quantity`, `color`, `size`, `image_url`) VALUES
(1, 1, 3, 'Jordan 1 Spider-Man Across the Spider Verse', 120.00, 1, '', '', NULL),
(2, 2, 3, 'Jordan 1 Spider-Man Across the Spider Verse', 120.00, 1, '', '', NULL),
(3, 3, 3, 'Jordan 1 Spider-Man Across the Spider Verse', 120.00, 1, '', '', NULL),
(4, 10, 11, NULL, 300.00, 1, 'Black', 'L', 'images/wreath.png'),
(5, 10, 11, NULL, 300.00, 1, 'Black', 'S', 'images/wreath.png'),
(6, 10, 9, NULL, 1300.00, 1, 'Black', '8', 'images/hamilton.png'),
(7, 11, 22, NULL, 9000.00, 1, 'Grey', '10', 'images/nikebttf.png'),
(8, 12, 21, NULL, 320.00, 1, 'Red', 'L', 'images/bape.png'),
(9, 12, 9, NULL, 1300.00, 1, 'Black', '8', 'images/hamilton.png'),
(10, 13, 27, NULL, 300.00, 1, 'White', '9', NULL),
(11, 14, 10, NULL, 120.00, 1, 'Red', '8', 'images/j1spider.png'),
(12, 15, 11, NULL, 300.00, 1, 'White', 'S', 'images/wreath.png'),
(13, 16, 27, NULL, 300.00, 1, 'White', '8', NULL),
(14, 17, 27, NULL, 300.00, 1, 'White', '8', NULL),
(15, 18, 27, NULL, 300.00, 1, 'White', '8', NULL),
(16, 19, 27, NULL, 300.00, 1, 'White', '8', NULL),
(17, 20, 27, NULL, 300.00, 1, 'Black', '10', NULL),
(18, 21, 27, NULL, 300.00, 1, 'Black', '10', NULL),
(19, 22, 26, NULL, 400.00, 1, 'Black', 'XL', 'images/supremejersey.png'),
(20, 23, 26, NULL, 400.00, 1, 'Black', 'XL', 'images/supremejersey.png'),
(21, 24, 12, NULL, 140.00, 1, 'Black', 'M', 'images/Travis.png'),
(22, 25, 25, NULL, 5000.00, 1, 'Multi', 'L', 'images/lv.png'),
(23, 26, 25, NULL, 5000.00, 1, 'Multi', 'XL', 'images/lv.png'),
(24, 26, 25, NULL, 5000.00, 1, 'Multi', 'L', 'images/lv.png'),
(25, 27, 8, NULL, 289.00, 1, 'Black', '9', 'images/jordan4fear.png'),
(26, 28, 25, NULL, 5000.00, 1, 'Multi', 'L', 'images/lv.png'),
(27, 29, 10, NULL, 120.00, 1, 'Red', '9', 'images/j1spider.png'),
(28, 31, 25, 'Louis Vuitton Multi-Patches Mixed Leather Varsity Blouson', 5000.00, 1, 'Multi', 'L', 'images/lv.png'),
(29, 31, 12, 'Travis Scott Cactus Jack Skeleton Graffiti Hoodie', 140.00, 1, 'Black', 'M', 'images/Travis.png'),
(30, 31, 26, 'Supreme Rhinestone Hockey Jersey Light Grey', 400.00, 1, 'Grey', 'M', 'images/supremejersey.png'),
(31, 31, 25, 'Louis Vuitton Multi-Patches Mixed Leather Varsity Blouson', 5000.00, 1, 'Multi', 'XL', 'images/lv.png'),
(32, 32, 30, 'Jordan 4 Retro Military Black', 300.00, 1, 'White', '10', NULL),
(33, 32, 19, 'Kith x Batman Joker Tee', 100.00, 1, 'Black', 'L', NULL),
(34, 32, 21, 'BAPE Color Camo Shark Red Full Zip Hoodie', 320.00, 1, 'Red', 'M', NULL),
(35, 33, 31, 'Men\'s Gucci Ha Ha Ha Collection Varsity Jacket', 1200.00, 1, 'Black', 'M', 'images/gucci_jacket.png'),
(36, 34, 26, 'Supreme Rhinestone Hockey Jersey Light Grey', 400.00, 1, 'Black', 'M', 'images/supremejersey.png'),
(37, 35, 24, 'Nike SB Dunk Low Day of the Dead', 3100.00, 1, 'Orange', '8', 'images/dayofthedead.png'),
(38, 35, 20, 'Nike Kobe 5 Protro Year of the Mamba', 200.00, 1, 'White', '9', 'images/nikekobe.png'),
(39, 36, 31, 'Men\'s Gucci Ha Ha Ha Collection Varsity Jacket', 1200.00, 1, 'Black', 'M', 'images/gucci_jacket.png'),
(40, 36, 15, 'Jordan 1 Retro High Spider-Man Origin Story', 460.00, 1, 'Red', '9', 'images/spiderorigin.png'),
(41, 37, 19, 'Kith x Batman Joker Tee', 100.00, 1, 'Black', 'L', 'images/joker.png'),
(42, 38, 30, 'Jordan 4 Retro Military Black', 300.00, 1, 'White', '10', 'images/j4militaryblack.png'),
(43, 38, 25, 'Louis Vuitton Multi-Patches Mixed Leather Varsity Blouson', 5000.00, 1, 'Black', 'XXL', 'images/lv.png'),
(44, 39, 26, 'Supreme Rhinestone Hockey Jersey Light Grey', 400.00, 1, 'Black', 'L', 'images/supremejersey.png'),
(45, 40, 31, 'Men\'s Gucci Ha Ha Ha Collection Varsity Jacket', 1200.00, 1, 'Black', 'XL', 'images/gucci_jacket.png'),
(46, 41, 32, 'Nike Tech', 200.00, 1, 'Black', 'M', 'images/niketech.png'),
(47, 42, 13, 'Supreme Star Football Jersey', 300.00, 1, 'Black', 'S', 'images/supreme.png'),
(48, 43, 13, 'Supreme Star Football Jersey', 300.00, 1, 'White', 'S', 'images/supreme.png'),
(49, 43, 11, 'Denim Tears The Cotton Wreath Sweatshirt', 300.00, 1, 'Black', 'M', 'images/wreath.png'),
(50, 44, 10, 'Jordan 1 Spider-Man Across the Spider Verse', 120.00, 1, 'Blue', '8', 'images/j1spider.png'),
(51, 45, 22, 'Nike MAG Back to the Future (2016)', 9000.00, 1, 'Silver', '8', 'images/nikebttf.png'),
(52, 46, 19, 'Kith x Batman Joker Tee', 100.00, 1, 'Black', 'M', 'images/joker.png'),
(53, 47, 32, 'Nike Tech', 200.00, 1, 'Black', 'L', 'images/niketech.png'),
(54, 47, 23, 'Nike SB Dunk Low Blue Lobster', 6000.00, 1, 'Navy', '8', 'images/bluelobster.png'),
(55, 47, 23, 'Nike SB Dunk Low Blue Lobster', 6000.00, 1, 'Blue', '10', 'images/bluelobster.png'),
(56, 48, 25, 'Louis Vuitton Multi-Patches Mixed Leather Varsity Blouson', 5000.00, 2, 'Black', 'L', 'images/lv.png'),
(57, 49, 12, 'Travis Scott Cactus Jack Skeleton Graffiti Hoodie', 140.00, 1, 'Black', 'L', 'images/Travis.png'),
(58, 50, 25, 'Louis Vuitton Multi-Patches Mixed Leather Varsity Blouson', 5000.00, 1, 'Black', 'M', 'images/lv.png'),
(59, 51, 32, 'Nike Tech', 200.00, 1, 'White', 'M', 'images/niketech.png'),
(60, 52, 24, 'Nike SB Dunk Low Day of the Dead', 3100.00, 1, 'Orange', '9', 'images/dayofthedead.png'),
(61, 53, 21, 'BAPE Color Camo Shark Red Full Zip Hoodie', 320.00, 1, 'Red', 'XL', 'images/bape.png'),
(62, 54, 16, 'Nike Kobe Mamba Mentality LA Lakers City Edition Jersey', 120.00, 1, 'Purple', 'L', 'images/kobe.png'),
(63, 54, 11, 'Denim Tears The Cotton Wreath Sweatshirt', 300.00, 1, 'White', 'S', 'images/wreath.png'),
(64, 54, 18, 'Jordan 4 Retro SB Pine Green', 320.00, 1, 'Green', '8', 'images/j4pinegreen.png'),
(65, 54, 10, 'Jordan 1 Spider-Man Across the Spider Verse', 120.00, 1, 'Red', '9', 'images/j1spider.png'),
(66, 54, 11, 'Denim Tears The Cotton Wreath Sweatshirt', 300.00, 1, 'White', 'M', 'images/wreath.png'),
(67, 54, 9, 'DIOR AND LEWIS HAMILTON Dior Snow Derby Shoe', 1300.00, 1, 'White', '8', 'images/hamilton.png'),
(68, 54, 30, 'Jordan 4 Retro Military Black', 300.00, 1, 'White', '10', 'images/j4militaryblack.png'),
(69, 55, 10, 'Jordan 1 Spider-Man Across the Spider Verse', 120.00, 1, 'Red', '8', 'images/j1spider.png'),
(70, 56, 9, 'DIOR AND LEWIS HAMILTON Dior Snow Derby Shoe', 1300.00, 1, 'White', '8', 'images/hamilton.png'),
(71, 57, 9, 'DIOR AND LEWIS HAMILTON Dior Snow Derby Shoe', 1300.00, 1, 'Black', '10', 'images/hamilton.png'),
(72, 58, 10, 'Jordan 1 Spider-Man Across the Spider Verse', 120.00, 1, 'Blue', '8', 'images/j1spider.png'),
(73, 59, 12, 'Travis Scott Cactus Jack Skeleton Graffiti Hoodie', 140.00, 1, 'Black', 'L', 'images/Travis.png'),
(74, 60, 10, 'Jordan 1 Spider-Man Across the Spider Verse', 120.00, 1, 'Blue', '8', 'images/j1spider.png'),
(75, 61, 30, 'Jordan 4 Retro Military Black', 300.00, 1, 'White', '10', 'images/j4militaryblack.png'),
(76, 61, 11, 'Denim Tears The Cotton Wreath Sweatshirt', 300.00, 1, 'Black', 'M', 'images/wreath.png');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `description`, `price`, `image_url`, `created_at`) VALUES
(8, 'Air Jordan 4 \"Fear of God\" Sneakers', 'Sneakers', 'An iconic design with innovative cushioning and style that stands out on the court.', 289.00, 'images/jordan4fear.png', '2025-03-25 13:54:06'),
(9, 'DIOR AND LEWIS HAMILTON Dior Snow Derby Shoe', 'Shoes', 'The Dior Snow derby shoe is part of the exclusive DIOR AND LEWIS HAMILTON capsule.', 1300.00, 'images/hamilton.png', '2025-03-25 13:54:06'),
(10, 'Jordan 1 Spider-Man Across the Spider Verse', 'Sneakers', 'Nike and Jordan Brand are returning back to the Spider-Verse for their second Spider-Man themed Air Jordan 1.', 120.00, 'images/j1spider.png', '2025-03-25 13:54:06'),
(11, 'Denim Tears The Cotton Wreath Sweatshirt', 'Sweatshirt', 'The Denim Tears The Cotton Wreath Sweatshirt Black is part of the Denim Tears clothing line.', 300.00, 'images/wreath.png', '2025-03-25 13:54:06'),
(12, 'Travis Scott Cactus Jack Skeleton Graffiti Hoodie', 'Hoodie', 'Released as part of a capsule collection between Travis Scott and Fragment Design.', 140.00, 'images/Travis.png', '2025-03-25 13:54:06'),
(13, 'Supreme Star Football Jersey', 'Jersey', 'The Supreme Star Football Jersey Black is a premium sports jersey released as part of Supreme’s Fall/Winter 2024 collection.', 300.00, 'images/supreme.png', '2025-03-25 13:54:06'),
(14, 'Moncler Maya 70 by Palm Angels Jacket', 'Jacket', 'The Moncler Maya 70 by Palm Angels Jacket Bright White is crafted from nylon material, and it comes in a bright white colorway.', 7000.00, 'images/moncler.png', '2025-03-25 13:54:06'),
(15, 'Jordan 1 Retro High Spider-Man Origin Story', 'Sneakers', 'If Spider-Man was a sneaker head, he probably would be rocking the Jordan 1 Retro High Spider-Man Origin Story.', 460.00, 'images/spiderorigin.png', '2025-03-25 13:54:06'),
(16, 'Nike Kobe Mamba Mentality LA Lakers City Edition Jersey', 'Jersey', 'Nike\'s Mamba Mentality apparel collection was created to celebrate all the things that made Kobe Bryant such a special player throughout his NBA career.', 120.00, 'images/kobe.png', '2025-03-25 13:54:06'),
(17, 'Nike x NOCTA Opal Deep Cover GORE-TEX Jacket', 'Jacket', 'Water-repellent gore-tex material. Front cargo pockets and oversized back pocket. 3-panel hood with adjustable drawcord. Hook-and-loop adjusted cuffs.', 300.00, 'images/nocta.png', '2025-03-25 13:54:06'),
(18, 'Jordan 4 Retro SB Pine Green', 'Sneakers', 'Nike SB’s collaboration with Jordan helps create the ultimate sneaker, with the Jordan 4 Retro SB Pine Green.', 320.00, 'images/j4pinegreen.png', '2025-03-25 13:54:06'),
(19, 'Kith x Batman Joker Tee', 'T-Shirt', 'The Kith x Batman Joker Tee, released as part of a special collaboration apparel collection from Kith, featuring an image of Batman’s nemesis, the Joker.', 100.00, 'images/joker.png', '2025-03-25 13:54:06'),
(20, 'Nike Kobe 5 Protro Year of the Mamba', 'Sneakers', 'The Nike Kobe 5 Year of the Mamba celebrates Kobe Bryant\'s legacy with a design inspired by the elegance and wisdom of the snake in Chinese culture.', 200.00, 'images/nikekobe.png', '2025-03-25 13:54:06'),
(21, 'BAPE Color Camo Shark Red Full Zip Hoodie', 'Hoodie', 'BAPE\'s Color Camo Shark Full Zip Hoodie \'Red\' from FW20 brings back the Japanese brand\'s iconic shark-face design.', 320.00, 'images/bape.png', '2025-03-25 13:54:06'),
(22, 'Nike MAG Back to the Future (2016)', 'Sneakers', 'The Nike MAG is a limited-edition shoe created by Nike Inc. It is a replica of a self-tying shoe featured in the film Back to the Future Part II.', 9000.00, 'images/nikebttf.png', '2025-03-25 13:54:06'),
(23, 'Nike SB Dunk Low Blue Lobster', 'Sneakers', 'The Nike SB Dunk Low Blue Lobster 2009 is a highly sought-after sneaker released as part of Nike SB\'s unique and thematic Dunk series.', 6000.00, 'images/bluelobster.png', '2025-03-25 13:54:06'),
(24, 'Nike SB Dunk Low Day of the Dead', 'Sneakers', 'One of Nike SB\'s most popular dunks, the festive motifs depict the Aztec God of the underworld exhaling souls into the living world.', 3100.00, 'images/dayofthedead.png', '2025-03-25 13:54:06'),
(25, 'Louis Vuitton Multi-Patches Mixed Leather Varsity Blouson', 'Jacket', 'This lively take on the varsity blouson has grained LWG leather certified calfskin sleeves and a wool body.', 5000.00, 'images/lv.png', '2025-03-25 13:54:06'),
(26, 'Supreme Rhinestone Hockey Jersey Light Grey', 'Jersey', 'NHL enthusiasts can\'t get enough of this Supreme x NHL colab', 400.00, 'images/supremejersey.png', '2025-03-25 13:54:06'),
(30, 'Jordan 4 Retro Military Black', 'Sneakers', 'Jordan Brand flipped one of its original Air Jordan 4 colorways for the Air Jordan 4 Military Black', 300.00, 'images/j4militaryblack.png', '2025-03-26 11:01:16'),
(31, 'Men\'s Gucci Ha Ha Ha Collection Varsity Jacket', 'Jacket', 'Transitioning into the warm season, new sets bring to mind a sartorial uniform enriched with subtle yet refined details, in cotton or jersey, in logo-detailed outerwear or knitwear. This jacket is presented in navy wool with tonal leather sleeves. A Gucci script embroidery and a striped rib trim further enrich the silhouette.', 1200.00, 'images/gucci_jacket.png', '2025-04-07 02:24:05'),
(32, 'Nike Tech', 'Hoodie', 'Nike Tech Fleece Set', 200.00, 'images/niketech.png', '2025-04-07 15:36:28');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `quantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `color`, `size`, `quantity`) VALUES
(14, 9, 'White', '8', 0),
(15, 9, 'White', '9', 2),
(16, 9, 'White', '10', 1),
(17, 9, 'Black', '9', 1),
(18, 9, 'Black', '10', 1),
(19, 9, 'Black', '11', 1),
(20, 10, 'Red', '8', 1),
(21, 10, 'Red', '9', 0),
(22, 10, 'Red', '10', 2),
(23, 10, 'Blue', '9', 2),
(24, 10, 'Blue', '10', 2),
(25, 10, 'Blue', '11', 1),
(26, 11, 'Black', 'S', 3),
(27, 11, 'Black', 'M', 1),
(28, 11, 'Black', 'L', 1),
(29, 11, 'White', 'M', 1),
(30, 11, 'White', 'L', 2),
(31, 11, 'White', 'XL', 1),
(32, 12, 'Black', 'M', 1),
(33, 12, 'Black', 'L', 0),
(34, 12, 'Black', 'XL', 2),
(35, 12, 'Beige', 'M', 1),
(36, 12, 'Beige', 'L', 1),
(37, 12, 'Beige', 'XL', 1),
(38, 13, 'Black', 'S', 2),
(39, 13, 'Black', 'M', 2),
(40, 13, 'Black', 'L', 2),
(41, 13, 'White', 'M', 1),
(42, 13, 'White', 'L', 2),
(43, 13, 'White', 'XL', 1),
(44, 14, 'White', 'M', 2),
(45, 14, 'White', 'L', 1),
(46, 14, 'White', 'XL', 1),
(47, 14, 'Black', 'M', 1),
(48, 14, 'Black', 'L', 1),
(49, 14, 'Black', 'XL', 1),
(50, 15, 'Red', '8', 2),
(51, 15, 'Red', '9', 2),
(52, 15, 'Red', '10', 2),
(53, 15, 'White', '9', 1),
(54, 15, 'White', '10', 1),
(55, 15, 'White', '11', 1),
(56, 16, 'Purple', 'S', 2),
(57, 16, 'Purple', 'M', 2),
(58, 16, 'Purple', 'L', 1),
(59, 16, 'Yellow', 'M', 1),
(60, 16, 'Yellow', 'L', 2),
(61, 16, 'Yellow', 'XL', 1),
(62, 17, 'Grey', 'M', 2),
(63, 17, 'Grey', 'L', 2),
(64, 17, 'Grey', 'XL', 1),
(65, 17, 'Black', 'M', 1),
(66, 17, 'Black', 'L', 1),
(67, 17, 'Black', 'XL', 1),
(68, 18, 'Green', '8', 1),
(69, 18, 'Green', '9', 2),
(70, 18, 'Green', '10', 1),
(71, 18, 'White', '9', 2),
(72, 18, 'White', '10', 1),
(73, 18, 'White', '11', 1),
(74, 19, 'Black', 'M', 2),
(75, 19, 'Black', 'L', 2),
(76, 19, 'Black', 'XL', 2),
(77, 19, 'Purple', 'M', 1),
(78, 19, 'Purple', 'L', 1),
(79, 19, 'Purple', 'XL', 1),
(80, 20, 'White', '8', 2),
(81, 20, 'White', '9', 2),
(82, 20, 'White', '10', 2),
(83, 20, 'Gold', '9', 1),
(84, 20, 'Gold', '10', 1),
(85, 20, 'Gold', '11', 1),
(86, 21, 'Red', 'M', 2),
(87, 21, 'Red', 'L', 1),
(88, 21, 'Red', 'XL', 0),
(89, 21, 'Black', 'M', 2),
(90, 21, 'Black', 'L', 1),
(91, 21, 'Black', 'XL', 1),
(92, 22, 'Grey', '8', 1),
(93, 22, 'Grey', '9', 1),
(94, 22, 'Grey', '10', 0),
(95, 22, 'Silver', '9', 1),
(96, 22, 'Silver', '10', 1),
(97, 22, 'Silver', '11', 1),
(98, 23, 'Blue', '8', 2),
(99, 23, 'Blue', '9', 2),
(100, 23, 'Blue', '10', 1),
(101, 23, 'Navy', '9', 1),
(102, 23, 'Navy', '10', 1),
(103, 23, 'Navy', '11', 1),
(104, 24, 'Orange', '8', 2),
(105, 24, 'Orange', '9', 0),
(106, 24, 'Orange', '10', 2),
(107, 24, 'Black', '9', 1),
(108, 24, 'Black', '10', 1),
(109, 24, 'Black', '11', 1),
(110, 25, 'Multi', 'M', 1),
(111, 25, 'Multi', 'L', -2),
(112, 25, 'Multi', 'XL', 0),
(113, 25, 'Black', 'L', 0),
(114, 25, 'Black', 'XL', 1),
(115, 25, 'Black', 'XXL', 1),
(116, 26, 'Grey', 'M', 2),
(117, 26, 'Grey', 'L', 2),
(118, 26, 'Grey', 'XL', 1),
(119, 26, 'Black', 'M', 1),
(120, 26, 'Black', 'L', 1),
(121, 26, 'Black', 'XL', 6),
(130, 30, 'White', '10', 4),
(131, 31, 'Black', 'M', 2),
(132, 31, 'Black', 'XL', 2),
(133, 31, 'Blue', 'M', 2),
(134, 31, 'Blue', 'XL', 2),
(135, 8, 'Red', '9', 23),
(136, 32, 'Black', 'M', 50),
(137, 32, 'Black', 'L', 10),
(138, 32, 'White', 'M', 1),
(139, 32, 'White', 'L', 7);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_email`, `rating`, `comment`, `created_at`, `user_id`) VALUES
(1, 22, NULL, 4, 'Very nice shoes', '2025-03-25 17:02:18', 5),
(2, 11, NULL, 4, 'sensational', '2025-03-26 09:07:05', 5),
(3, 12, NULL, 4, '', '2025-03-26 11:22:55', 2),
(4, 20, NULL, 1, 'Bad quality', '2025-03-26 11:38:26', 2),
(5, 10, NULL, 4, 'COol', '2025-03-26 14:15:46', 2),
(6, 10, NULL, 5, 'Nice runners', '2025-03-26 15:50:33', 2),
(7, 12, NULL, 3, 'Fire', '2025-04-06 18:18:16', 6),
(8, 26, NULL, 3, 'adashda', '2025-04-06 18:36:35', 6),
(9, 14, NULL, 5, 'great', '2025-04-07 15:38:23', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`, `created_at`) VALUES
(2, 'Matas Zostautas', 'MZ@ThePlug.com', '$2y$10$fvlVWEl0i/zpJVoVoJ5QkOcUCcpz6NuwGruhaQPhwbwJQZMLASu8W', 1, '2025-03-24 15:55:10'),
(3, 'Ethan Teixeira', 'ET@ThePlug', '$2y$10$KCo4Rlp/6Pc0WF4J8UZgkuaZEH.eVN3bSwbplHzVFCphgZLC4iWg.', 1, '2025-03-24 16:10:08'),
(4, 'Matas Zostautas', 'B00163194@mytudublin.ie', '$2y$10$epKtE.6eKvTvzTlxRFN3q.Ol6Mtbtf9Pq4YuLJIfs2P1PlUvL421e', 0, '2025-03-25 14:45:56'),
(5, 'Ethan Teixeira', 'B00164666@mytudublin.ie', '$2y$10$2MEqnpDwAmepv2KXvo2cvuPKAWknpxdsASl.OCLX3RdbexdRVSeTu', 0, '2025-03-25 16:55:01'),
(6, 'Wukong', 'Monkey@monkey.com', '$2y$10$RBMJXondAOMFCC7O/fvTyuZspHMyQ7gflhDqzBhsVOyuZr3NGAFLG', 1, '2025-04-06 14:21:11'),
(7, '', 'bigback@gmail.com', '$2y$10$ySEkPmhZs6G6xmh.8s.VlezaByW82soECUEoYdQA7y6Y0zFO9Ge8m', 0, '2025-04-07 09:08:46'),
(8, '', 'test123@gmail.com', '$2y$10$e.cnnJs6DSzo7kGFXkTpquveOCgB/DHhlcP5Y26gtcbgt7Vnjh77W', 0, '2025-04-07 15:28:36'),
(9, '', 'alex@gmail.com', '$2y$10$L.Thfq9M67zpmqNunDiMZuXQThcgkDjiiFEhpSapZ8soKB.827FhG', 0, '2025-04-07 16:17:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discount_code` (`discount_code`),
  ADD KEY `discount_code_2` (`discount_code`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`,`user_email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
