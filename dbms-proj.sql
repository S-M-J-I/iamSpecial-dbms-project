-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2022 at 11:21 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbms-proj`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `cat_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`cat_id`, `name`) VALUES
(3, 'Autism Early Signs'),
(4, 'Parenting'),
(5, 'Causes '),
(6, 'Sleep'),
(7, 'Fitness'),
(8, 'Health'),
(9, 'Speech');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `booker` int(11) NOT NULL,
  `booked_to` int(11) NOT NULL,
  `booker_type` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `agenda` varchar(255) NOT NULL,
  `is_finished` enum('T','F') NOT NULL DEFAULT 'F'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `booker`, `booked_to`, `booker_type`, `date`, `time`, `agenda`, `is_finished`) VALUES
(1, 9, 11, 'User', '2022-05-25', '17:30:00', 'Speech Therapy', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`chat_id`, `sender`, `receiver`, `message`) VALUES
(12, 9, 11, 'Hello There'),
(15, 9, 11, 'Hello'),
(16, 9, 11, 'Hi?'),
(17, 9, 11, 'Works?'),
(18, 9, 11, 'Yesss'),
(19, 11, 9, 'What\\\'s up?'),
(20, 11, 9, 'When will you book appointment?'),
(21, 9, 11, 'Tomorrow'),
(22, 9, 11, 'Okay\\\'s'),
(23, 9, 8, 'Hi Dr Ryan'),
(24, 9, 11, 'There?');

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE `institutions` (
  `ins_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `picture` text NOT NULL DEFAULT 'demo.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institutions`
--

INSERT INTO `institutions` (`ins_id`, `name`, `about`, `street`, `area`, `city`, `state`, `phone`, `type`, `picture`) VALUES
(1, 'XYZ institute', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 'House #89, Shankar', 'Dhanmondi', 'Dhaka', 'Dhaka', '2441139', 'school', 'demo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL DEFAULT '12345678911',
  `role` int(11) DEFAULT 3,
  `verified` enum('T','F') DEFAULT 'F',
  `avatar` text DEFAULT 'demo.jpg',
  `area` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `speciality` varchar(255) DEFAULT NULL,
  `randSalt` varchar(255) DEFAULT '$2y$10$verycrazystring1234567'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `email`, `phone`, `role`, `verified`, `avatar`, `area`, `city`, `state`, `speciality`, `randSalt`) VALUES
(5, 'S M Jishanul', 'Islam', 'smji14', '$2y$10$verycrazystring123456uWkYvBdEsXPdFCyZZtpiS2NAB3Ea7ZQi', 'jishanlion@gmail.com', '01759338652', 1, 'F', '5.jpg', 'House #89, Shankar Chairman Goli, Shankar, West Dhanmondi', 'Dhaka', 'Dhaka', NULL, '$2y$10$verycrazystring1234567'),
(6, 'Sadia', 'Ahmmed', 'sahmmed', '$2y$10$verycrazystring123456u8imG4og/4q73zzZIAo4JqmKlhLCVoPG', 'sahmmed201146@bscse.uiu.ac.bd', '01531192391', 1, 'F', '6.jpg', 'House 12, Road 16/A, Gulshan 1', 'Dhaka', 'Dhaka', NULL, '$2y$10$verycrazystring1234567'),
(7, 'Mysun', 'Mashira', 'mysun', '$2y$10$verycrazystring123456u5pMx6iLXIdghYQJsTud0rJhCKu3H7aK', 'mmashira201011@bscse.uiu.ac.bd', '19303048392', 1, 'F', '7.jpg', 'Chanmia Housing, Gate #3, Mohammedpur', 'Dhaka', 'Dhaka', NULL, '$2y$10$verycrazystring1234567'),
(8, 'Ryan', 'Goslin', 'ryanG', '$2y$10$verycrazystring123456uAuQGUvtaTxeXtj9menS0LCSY0/Pm1K2', 'rg@gmail.com', '923472373', 2, 'T', 'demo.jpg', 'House #89, Shankar Chairman Goli, Shankar, West Dhanmondi', 'Dhaka', 'Dhaka', 'Speech Therapy, Epilepsy ', '$2y$10$verycrazystring1234567'),
(9, 'John', 'Doe', 'jdoe', '$2y$10$verycrazystring123456ugvWBBztWU3yP8QSso431UVJ0DlQgoTS', 'j.doe@gmail.com', '12345678911', 3, 'T', '9.jpg', 'Some area', 'Some city', 'Barisal', NULL, '$2y$10$verycrazystring1234567'),
(10, 'Jane', 'Doe', 'jane', '$2y$10$verycrazystring123456uFRIT2pdMOT/VJuONmQWWy0nVV/.zgwm', 'jane.doe@gmail.com', '23534534435', 3, 'F', 'demo.jpg', 'Dmd lake', 'Dhaka', 'Dhaka', NULL, '$2y$10$verycrazystring1234567'),
(11, 'Christian', 'Bale', 'c.bale', '$2y$10$verycrazystring123456uctzw2F2IQYf.iRkIrN7i7olpuk5IPkK', 'c.bale@gmail.com', '14252563351', 2, 'T', '11.jpg', 'House #48, Marine Drive', 'Cox\'s Bazar', 'Chittagong', 'Speech Therapy, Epilepsy, Fitness, Health', '$2y$10$verycrazystring1234567');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `type_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`type_id`, `role`) VALUES
(1, 'admin'),
(2, 'counselor'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `user_id` int(11) NOT NULL,
  `id1` text DEFAULT NULL,
  `id2` text DEFAULT NULL,
  `NID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`ins_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `institutions`
--
ALTER TABLE `institutions`
  MODIFY `ins_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `user_type` (`type_id`);

--
-- Constraints for table `verification`
--
ALTER TABLE `verification`
  ADD CONSTRAINT `verification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
