-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2024 at 08:46 PM
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
-- Database: `canteen`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `message_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `menu_items` (
  `menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` enum('breakfast','lunch','dinner') NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`menu_id`, `name`, `price`, `category`, `image_url`) VALUES
(1, 'Chicken Burger', 320.00, 'breakfast', 'Chicken Burger.jpg'),
(2, 'Pizza', 450.00, 'lunch', 'menu-7.jpg'),
(3, 'burgur', 300.00, 'dinner', 'yu.jpg'),
(4, 'chiken', 200.00, 'lunch', 'girl_cloths.jpg');

-- --------------------------------------------------------

--
-- 
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone number` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_status` varchar(50) DEFAULT 'Pending',
  `payment_method` varchar(50) DEFAULT NULL,
  `order_number` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
--
--

INSERT INTO `orders` (`order_id`, `user_id`, `name`, `email`, `item_name`, `item_price`, `quantity`, `total_price`, `order_status`, `payment_method`, `order_number`, `created_at`) VALUES
(1, 2, 'Diru', 'dirukshika@gmail.com', 'Chicken Burger', 320.00, 3, 960.00, 'Pending', 'Online', '4F70919E', '2024-06-14 05:06:38'),
(2, 2, 'Diru', 'dirukshika@gmail.com', 'chiken', 200.00, 4, 800.00, 'Pending', 'cash', '3036E31D', '2024-06-14 05:29:44');

-- --------------------------------------------------------

--
--
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_type` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `created_at`, `user_type`) VALUES
(1, 'Admin', 'admin200@gmail.com', '$2y$10$JVkwLth2UAPdVT6sNpQ7WORvseuApd.B.3AHNIdcLwXzB4jg3JXJu', '2024-06-02 20:34:10', 'admin'),
(2, 'Diru', 'dirukshika@gmail.com', '$2y$10$/albx3kgdptC/.TbdOGbpezKryqay3ncmLNdO25kAfRkzrNhwxpsq', '2024-06-02 21:40:16', 'user'),
(3, 'Jesinth', 'jesifabi200@gmail.com', '$2y$10$Uln6ee9eqVtVyXaw.81..e94OP5F.zB2rRXEeqWpJgQszZrT9xaDi', '2024-06-03 07:55:16', 'user'),
(4, 'Brannavi', 'branna123@gmail.com', '$2y$10$nbCn9Y7Vtu7uCYz5sUAJZODWuBZbxZyNIUWo05ld01GWlNyH04oNu', '2024-06-04 04:11:10', 'user');

--
-- 
--

--
-- 
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`message_id`);

--
-- 
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`menu_id`);

--
-- 
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- 
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 
--
ALTER TABLE `contact_form`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 
--
ALTER TABLE `menu_items`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 
--

--
-- 
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;



CREATE TABLE logos (
    id INT AUTO_INCREMENT PRIMARY KEY,       
    icon VARCHAR(255),                       
    name VARCHAR(255) NOT NULL,              
    image VARCHAR(255) NOT NULL,            
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  
);

CREATE TABLE about_us (
    id INT AUTO_INCREMENT PRIMARY KEY,
    head VARCHAR(255) NOT NULL,
    about TEXT NOT NULL,
    image1 VARCHAR(255) DEFAULT NULL,
    image2 VARCHAR(255) DEFAULT NULL,
    image3 VARCHAR(255) DEFAULT NULL,
    image4 VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE contact_us (
    id INT AUTO_INCREMENT PRIMARY KEY,
    head VARCHAR(255) NOT NULL,
    booking_email VARCHAR(255) NOT NULL,
    general_email VARCHAR(255) NOT NULL,
    technical_email VARCHAR(255) NOT NULL,
    google_map_link TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS homepage_images (
    id INT AUTO_INCREMENT PRIMARY KEY,     
    image_path VARCHAR(255) NOT NULL,      
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);