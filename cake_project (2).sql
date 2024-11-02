-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 21, 2024 at 12:19 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cake_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_ID` int NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `admin_email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `admin_password` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`admin_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_ID`, `admin_name`, `admin_email`, `admin_password`, `created_at`, `updated_at`) VALUES
(1, 'Alice Johnson', 'alice.j@example.com', 'admin123', '2024-10-01 05:30:00', '2024-10-01 05:30:00'),
(2, 'Bob Smith', 'bob.s@example.com', 'securePass456', '2024-10-02 06:45:00', '2024-10-02 06:45:00'),
(3, 'Carol Lee', 'carol.l@example.com', 'pass789', '2024-10-03 07:00:00', '2024-10-03 07:00:00'),
(4, 'Alice Johnson', 'alice.j@example.com', 'admin123', '2024-10-01 05:30:00', '2024-10-01 05:30:00'),
(5, 'Bob Smith', 'bob.s@example.com', 'securePass456', '2024-10-02 06:45:00', '2024-10-02 06:45:00'),
(6, 'Carol Lee', 'carol.l@example.com', 'pass789', '2024-10-03 07:00:00', '2024-10-03 07:00:00'),
(7, 'Alice Johnson', 'alice.j@example.com', 'admin123', '2024-10-01 05:30:00', '2024-10-01 05:30:00'),
(8, 'Bob Smith', 'bob.s@example.com', 'securePass456', '2024-10-02 06:45:00', '2024-10-02 06:45:00'),
(9, 'Carol Lee', 'carol.l@example.com', 'pass789', '2024-10-03 07:00:00', '2024-10-03 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_ID` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `category_image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_ID`, `category_name`, `category_image`, `created_at`, `updated_at`) VALUES
(1, 'Cakes', 'cakes.jpg', '2024-10-01 05:30:00', '2024-10-01 05:30:00'),
(2, 'sugar free', 'pastries.jpg', '2024-10-02 06:45:00', '2024-10-02 06:45:00'),
(3, 'gluten free', 'cookies.jpg', '2024-10-03 07:00:00', '2024-10-03 07:00:00'),
(4, 'special occasions', 'cakes.jpg', '2024-10-01 05:30:00', '2024-10-01 05:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `coupon_ID` int NOT NULL AUTO_INCREMENT,
  `coupon_amount` float NOT NULL,
  `coupon_value` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `coupon_expire` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`coupon_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`coupon_ID`, `coupon_amount`, `coupon_value`, `coupon_expire`, `created_at`, `updated_at`) VALUES
(1, 10.5, '', '0000-00-00', '2024-10-01 05:30:00', '2024-10-01 05:30:00'),
(2, 15.75, '', '0000-00-00', '2024-10-02 06:45:00', '2024-10-02 06:45:00'),
(3, 5, '', '0000-00-00', '2024-10-03 07:00:00', '2024-10-03 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_ID` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_password` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_address1` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_address2` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_phone` int NOT NULL,
  `customer_image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`customer_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_ID`, `customer_name`, `customer_email`, `customer_password`, `customer_address1`, `customer_address2`, `customer_phone`, `customer_image`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'john.doe@example.com', 'johndoe123', '123 Main St', NULL, 1234567890, '', '2024-10-01 05:30:00', '2024-10-01 05:30:00'),
(2, 'Jane Smith', 'jane.smith@example.com', 'janesmith456', '456 Oak St', 'Apt 7', 2147483647, '', '2024-10-02 06:45:00', '2024-10-02 06:45:00'),
(3, 'Mark Taylor', 'mark.taylor@example.com', 'marktaylor789', '789 Pine St', NULL, 1928374650, '', '2024-10-03 07:00:00', '2024-10-03 07:00:00'),
(4, 'issa', 'sal.sroor0@gmail.com', '$2y$10$6Oc4rBOLA', '', NULL, 0, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `message_ID` int NOT NULL AUTO_INCREMENT,
  `customer_ID` int NOT NULL,
  `message_text` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `subject` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`message_ID`),
  KEY `customer_ID` (`customer_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_ID`, `customer_ID`, `message_text`, `created_at`, `updated_at`, `subject`) VALUES
(1, 1, 'I would like to know more about your cakes.', '2024-10-01 05:30:00', '2024-10-01 05:30:00', NULL),
(2, 2, 'Can I apply a discount code after placing an order?', '2024-10-02 06:45:00', '2024-10-02 06:45:00', NULL),
(3, 3, 'What is the expected delivery time?', '2024-10-03 07:00:00', '2024-10-03 07:00:00', NULL),
(4, 4, 'hello test', NULL, NULL, NULL),
(5, 4, 'hellloooooo', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_ID` int NOT NULL AUTO_INCREMENT,
  `customer_ID` int NOT NULL,
  `coupon_ID` int NOT NULL,
  `order_total_amount` float NOT NULL,
  `order_total_amount_after` float NOT NULL,
  `order_status` enum('processing','shipped','delivered','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `delivery_address` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_ID`),
  KEY `customer_ID` (`customer_ID`),
  KEY `coupon_ID` (`coupon_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_ID`, `customer_ID`, `coupon_ID`, `order_total_amount`, `order_total_amount_after`, `order_status`, `delivery_address`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 100, 89.5, 'processing', '', '2024-10-01 05:30:00', '2024-10-01 05:30:00'),
(2, 2, 2, 150, 134.25, 'shipped', '', '2024-10-02 06:45:00', '2024-10-02 06:45:00'),
(3, 3, 3, 50, 45, 'delivered', '', '2024-10-03 07:00:00', '2024-10-03 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

DROP TABLE IF EXISTS `order_products`;
CREATE TABLE IF NOT EXISTS `order_products` (
  `order_products_ID` int NOT NULL AUTO_INCREMENT,
  `order_ID` int NOT NULL,
  `product_ID` int NOT NULL,
  `quantity` int NOT NULL,
  `price` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_products_ID`),
  KEY `orderID` (`order_ID`),
  KEY `product_ID` (`product_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`order_products_ID`, `order_ID`, `product_ID`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 20, '2024-10-01 05:30:00', '2024-10-01 05:30:00'),
(2, 1, 2, 1, 30, '2024-10-01 05:30:00', '2024-10-01 05:30:00'),
(3, 2, 3, 3, 15, '2024-10-02 06:45:00', '2024-10-02 06:45:00'),
(4, 2, 4, 2, 50, '2024-10-02 06:45:00', '2024-10-02 06:45:00'),
(5, 3, 5, 1, 40, '2024-10-03 07:00:00', '2024-10-03 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_ID` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `product_description` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `product_price` float NOT NULL,
  `product_image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `product_quantity` int NOT NULL,
  `category_ID` int NOT NULL,
  `total_review` float DEFAULT NULL,
  `product_discount` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `add_to_cart_clicks` int DEFAULT '0',
  PRIMARY KEY (`product_ID`),
  KEY `category_ID` (`category_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_ID`, `product_name`, `product_description`, `product_price`, `product_image`, `product_quantity`, `category_ID`, `total_review`, `product_discount`, `created_at`, `updated_at`, `add_to_cart_clicks`) VALUES
(1, 'Classic Vanilla Cake', 'A moist vanilla cake with creamy vanilla frosting.', 25, 'classic_vanilla_cake.jpg', 30, 1, 10, NULL, '2024-10-01 05:30:00', '2024-10-01 05:30:00', 0),
(2, 'Chocolate Sugar-Free Cake', 'A rich chocolate cake sweetened with natural sugar substitutes.', 28, 'chocolate_sugar_free_cake.jpg', 20, 2, 8, NULL, '2024-10-02 06:45:00', '2024-10-02 06:45:00', 0),
(3, 'Gluten-Free Almond Cake', 'A delightful almond cake made without gluten.', 30, 'gluten_free_almond_cake.jpg', 15, 3, 12, NULL, '2024-10-03 07:00:00', '2024-10-03 07:00:00', 0),
(4, 'Fruit Cake for Special Occasions', 'A rich fruit cake perfect for celebrations and special events.', 35, 'fruit_cake_special_occasions.jpg', 10, 4, 5, NULL, '2024-10-04 08:00:00', '2024-10-04 08:00:00', 0),
(5, 'Lemon Gluten-Free Cake', 'A zesty lemon cake that’s gluten-free and delicious.', 27, 'lemon_gluten_free_cake.jpg', 18, 3, 7, NULL, '2024-10-05 09:30:00', '2024-10-05 09:30:00', 0),
(6, 'Sugar-Free Chocolate Brownies', 'Decadent brownies made with no added sugar.', 22, 'sugar_free_brownies.jpg', 25, 2, 9, NULL, '2024-10-06 10:30:00', '2024-10-06 10:30:00', 0),
(7, 'Special Occasion Red Velvet Cake', 'A classic red velvet cake with cream cheese frosting.', 40, 'red_velvet_special_occasions.jpg', 12, 4, 15, NULL, '2024-10-07 11:30:00', '2024-10-07 11:30:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `review_ID` int NOT NULL AUTO_INCREMENT,
  `product_ID` int NOT NULL,
  `customer_ID` int NOT NULL,
  `rating` int NOT NULL,
  `review_text` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`review_ID`),
  KEY `customer_ID` (`customer_ID`),
  KEY `product_ID` (`product_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_ID`, `product_ID`, `customer_ID`, `rating`, `review_text`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, 'Absolutely loved this vanilla cake! Moist and delicious.', '2024-10-01 06:00:00', '2024-10-01 06:00:00'),
(2, 1, 2, 4, 'Good cake, but the frosting was a bit too sweet for my taste.', '2024-10-02 07:15:00', '2024-10-02 07:15:00'),
(3, 2, 1, 5, 'A great sugar-free option. Tastes just like a regular cake!', '2024-10-03 08:30:00', '2024-10-03 08:30:00'),
(4, 3, 3, 3, 'The gluten-free almond cake was okay, but a bit dry.', '2024-10-04 09:45:00', '2024-10-04 09:45:00'),
(5, 4, 2, 5, 'This fruit cake is perfect for special occasions. Everyone loved it!', '2024-10-05 10:00:00', '2024-10-05 10:00:00'),
(6, 5, 1, 4, 'Lemon flavor was refreshing, but I wish it was a bit sweeter.', '2024-10-06 11:00:00', '2024-10-06 11:00:00'),
(7, 6, 3, 5, 'These sugar-free brownies are amazing! I will definitely order again.', '2024-10-07 12:30:00', '2024-10-07 12:30:00'),
(8, 7, 2, 5, 'The red velvet cake for my sister’s birthday was a hit! Highly recommend.', '2024-10-08 13:00:00', '2024-10-08 13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE IF NOT EXISTS `wishlists` (
  `wishlist_ID` int NOT NULL AUTO_INCREMENT,
  `product_ID` int NOT NULL,
  `customer_ID` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`wishlist_ID`),
  KEY `customer_ID` (`customer_ID`),
  KEY `product_ID` (`product_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`wishlist_ID`, `product_ID`, `customer_ID`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-10-01 06:00:00', '2024-10-01 06:00:00'),
(2, 2, 2, '2024-10-02 07:15:00', '2024-10-02 07:15:00'),
(3, 3, 3, '2024-10-03 08:30:00', '2024-10-03 08:30:00'),
(4, 4, 1, '2024-10-04 09:45:00', '2024-10-04 09:45:00'),
(5, 5, 2, '2024-10-05 10:00:00', '2024-10-05 10:00:00'),
(6, 6, 3, '2024-10-06 11:00:00', '2024-10-06 11:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
