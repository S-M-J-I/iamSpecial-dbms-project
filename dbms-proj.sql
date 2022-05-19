-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2022 at 10:18 PM
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
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category` int(11) NOT NULL,
  `image` text NOT NULL DEFAULT 'https://dummyimage.com/900x400/ced4da/6c757d.jpg',
  `date` date NOT NULL,
  `author` int(11) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `draft` enum('T','F') NOT NULL DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `category`, `image`, `date`, `author`, `tags`, `draft`) VALUES
(4, 'Yess', '<p>Okay</p><ol><li>2</li><li>134</li></ol>', 4, '11-Yess.jpg', '2022-05-18', 11, 'Yes, testing', 'F'),
(5, 'Testing post', '<h3><strong>Brah</strong></h3><p>&nbsp;</p><p>isdflkjdsf&nbsp;</p><p>&nbsp;</p><figure class=\"table\"><table><tbody><tr><td>dfg</td><td>dfgdf</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>dfg</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>', 8, '11-Testing post.jpg', '2022-05-19', 11, 'health, yes, okay', 'F'),
(6, 'Test', '<p>dfsgdfgdfg</p>', 4, '6-Test.jpg', '2022-05-19', 6, 'parenting, side, testing', 'F'),
(7, 'another test', '<p>sadfdasf</p>', 4, '6-another test.jpg', '2022-05-19', 6, 'health, yes, okay', 'F'),
(8, 'dfsgdf', '<p>sdfgdfsg</p>', 4, '6-dfsgdf.png', '2022-05-19', 6, 'health, yes, okay', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `cat_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `thumbnail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`cat_id`, `name`, `description`, `thumbnail`) VALUES
(3, 'Autism Early Signs', 'Read about finding out the early signs of Autism', 'Autism Early Signs.png\r\n'),
(4, 'Parenting', 'Parenting guides', 'Parenting.jpg\r\n'),
(8, 'Health', 'Maintaining health', 'Health.jpg'),
(11, 'Learn the signs', 'One of the most important things you can do.', 'Learn the Signs.jpg'),
(14, 'Educator', 'An educator', 'Educator.jpg');

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
(1, 9, 11, 'User', '2022-05-25', '17:30:00', 'Speech Therapy', 'T'),
(2, 5, 11, 'User', '2022-05-02', '09:03:37', 'Just a test', 'T'),
(3, 9, 11, 'User', '2022-05-28', '16:24:00', 'Again', 'F'),
(4, 9, 11, 'User', '2022-05-28', '18:30:00', 'Testing', 'T'),
(5, 9, 11, 'User', '2022-06-30', '14:30:00', 'Speech Therapy Patient', 'T'),
(6, 9, 11, 'User', '2022-05-28', '16:20:00', 'dsfdsafadfsf', 'F'),
(7, 9, 11, 'User', '2022-05-31', '20:22:00', 'wuydsakfjlksdjflkds', 'T'),
(8, 21, 11, 'User', '2022-05-26', '13:55:00', 'Some agenda', 'T'),
(9, 21, 11, 'User', '2022-05-26', '13:55:00', 'Some agenda', 'F'),
(10, 21, 11, 'User', '2022-06-02', '07:58:00', 'dhgffh', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`chat_id`, `sender`, `receiver`, `message`, `date_time`) VALUES
(35, 9, 11, 'Hello', '0000-00-00 00:00:00'),
(36, 9, 11, 'Hello', '2022-05-14 20:25:09'),
(37, 9, 11, 'Hi again', '2022-05-14 20:31:01'),
(38, 9, 11, 'again', '2022-05-14 20:32:23'),
(46, 9, 6, 'Hi', '2022-05-16 16:18:35'),
(47, 6, 9, 'Hello', '2022-05-16 16:19:14'),
(49, 9, 6, 'How are you?', '2022-05-16 17:12:52'),
(50, 6, 9, 'Doing well', '2022-05-16 17:12:59'),
(52, 6, 11, 'He', '2022-05-16 17:34:34'),
(54, 6, 9, 'hweloo', '2022-05-17 04:56:17');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `commenter` int(11) NOT NULL,
  `commented_to` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `is_reply` enum('T','F') NOT NULL DEFAULT 'F',
  `replied_to` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `commenter`, `commented_to`, `content`, `date`, `is_reply`, `replied_to`) VALUES
(1, 9, 4, 'Hi', '2022-05-19', 'F', NULL),
(2, 9, 4, 'New testing', '2022-05-19', 'F', NULL),
(3, 9, 4, 'dsjfaidjasfkljdas', '2022-05-19', 'F', NULL),
(4, 11, 5, 'Yah', '2022-05-19', 'F', NULL),
(5, 6, 7, 'Hello', '2022-05-19', 'F', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `poster` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`id`, `title`, `poster`, `content`, `category`, `tags`, `date`) VALUES
(1, 'Emergency', 6, 'Help me', 4, 'tags, help, emergency', '2022-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `forum_categories`
--

CREATE TABLE `forum_categories` (
  `forum_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_categories`
--

INSERT INTO `forum_categories` (`forum_id`, `name`) VALUES
(1, 'Health & Wellness\r\n'),
(2, 'Emergency'),
(3, 'Medical Assistance'),
(4, 'Psychological Assistance'),
(5, 'Help for parents');

-- --------------------------------------------------------

--
-- Table structure for table `fundraisers`
--

CREATE TABLE `fundraisers` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `total_target` int(11) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `requested_by` int(11) DEFAULT NULL,
  `approved` enum('T','F') NOT NULL DEFAULT 'F',
  `complete` enum('T','F') NOT NULL DEFAULT 'F'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fundraisers`
--

INSERT INTO `fundraisers` (`id`, `title`, `description`, `total_target`, `duration`, `requested_by`, `approved`, `complete`) VALUES
(1, 'New school', 'For a new school', 500000, '1 week', NULL, 'T', 'F'),
(2, 'New institute', 'For a new insitute', 450000, '3 weeks', NULL, 'T', 'F'),
(3, 'Special Day', 'Description', 50000, '2 weeks', NULL, 'T', 'F'),
(5, 'Test Request', 'A test request', 5000, '1 week', 9, 'T', 'F'),
(6, 'Title', 'descrp', 90000, '1 week', 9, 'T', 'F'),
(14, 'A demo test', 'Something something', 12000, '2 weeks', 6, 'T', 'F');

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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fundraiser_id` int(11) NOT NULL,
  `currency` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `amount`, `address`, `status`, `transaction_id`, `fundraiser_id`, `currency`) VALUES
(20, 'Sadia Ahmmed', 'sahmmed201146@bscse.uiu.ac.bd', '01531192391', 7000, 'Dhaka', 'Processing', 'SSLCZ_TEST_626da86fe230a', 1, 'BDT'),
(21, 'Mysun Mashira', 'mmashira201011@bscse.uiu.ac.bd', '19303048392', 9000, 'Dhaka', 'Processing', 'SSLCZ_TEST_626daa164b0cc', 1, 'BDT'),
(22, 'S M Jishanul Islam', 'jishanlion@gmail.com', '01759338652', 600, 'Dhaka', 'Processing', 'SSLCZ_TEST_626daaaa0dd91', 1, 'BDT'),
(25, 'S M Jishanul Islam', 'jishanlion@gmail.com', '01759338652', 1200, 'Dhaka', 'Processing', 'SSLCZ_TEST_626e37113095e', 1, 'BDT'),
(26, 'Sadia Ahmmed', 'sahmmed201146@bscse.uiu.ac.bd', '01531192391', 90000, 'Dhaka', 'Processing', 'SSLCZ_TEST_626e514f6572c', 1, 'BDT'),
(27, 'Sadia Ahmmed', 'sahmmed201146@bscse.uiu.ac.bd', '01531192391', 40000, 'Dhaka', 'Processing', 'SSLCZ_TEST_626e5176ea5eb', 1, 'BDT'),
(28, 'Sadia Ahmmed', 'sahmmed201146@bscse.uiu.ac.bd', '01531192391', 5000, 'Dhaka', 'Processing', 'SSLCZ_TEST_626e52156a418', 1, 'BDT'),
(29, 'S M Jishanul Islam', 'jishanlion@gmail.com', '01759338652', 12000, 'Dhaka', 'Processing', 'SSLCZ_TEST_626e682753290', 2, 'BDT'),
(30, 'Sadia Ahmmed', 'sahmmed201146@bscse.uiu.ac.bd', '01531192391', 100000, 'Dhaka', 'Processing', 'SSLCZ_TEST_626e78839ed0d', 3, 'BDT'),
(31, 'Sadia Ahmmed', 'sahmmed201146@bscse.uiu.ac.bd', '01531192391', 250000, 'Dhaka', 'Processing', 'SSLCZ_TEST_626e79021a9f2', 2, 'BDT'),
(32, 'John Doe', 'j.doe@gmail.com', '12345678911', 8000, 'Dhaka', 'Processing', 'SSLCZ_TEST_626e987aa6384', 1, 'BDT'),
(33, 'Sadia Ahmmed', 'sahmmed201146@bscse.uiu.ac.bd', '01531192391', 120000, 'Dhaka', 'Processing', 'SSLCZ_TEST_626e98c236fe3', 1, 'BDT'),
(34, 'Christian Bale', 'c.bale@gmail.com', '14252563351', 1000, 'Dhaka', 'Processing', 'SSLCZ_TEST_627563177310d', 2, 'BDT'),
(35, 'S M Jishanul Islam', 'jishanlion@gmail.com', '+8801759338652', 1000, 'Dhaka', 'Processing', 'SSLCZ_TEST_6275f80106785', 1, 'BDT'),
(36, 'Sadia Ahmmed', 'sahmmed201146@bscse.uiu.ac.bd', '01531192391', 20000, 'Dhaka', 'Processing', 'SSLCZ_TEST_6275f860ab4ed', 2, 'BDT'),
(37, 'Christian Bale', 'c.bale@gmail.com', '14252563351', 1000, 'Dhaka', 'Processing', 'SSLCZ_TEST_627601f97339e', 1, 'BDT'),
(38, 'Christian Bale', 'c.bale@gmail.com', '14252563351', 10000, 'Dhaka', 'Processing', 'SSLCZ_TEST_62762a46a6cbf', 2, 'BDT'),
(39, 'John Doe', 'j.doe@gmail.com', '12345678911', 12323, 'Dhaka', 'Processing', 'SSLCZ_TEST_627c0943115ab', 2, 'BDT'),
(40, 'Sadia Ahmmed', 'sahmmed201146@bscse.uiu.ac.bd', '01531192391', 12000, 'Dhaka', 'Pending', 'SSLCZ_TEST_62867d345da6b', 6, 'BDT'),
(41, 'Sadia Ahmmed', 'sahmmed201146@bscse.uiu.ac.bd', '01531192391', 12000, 'Dhaka', 'Failed', 'SSLCZ_TEST_62867d48be853', 6, 'BDT'),
(42, 'Sadia Ahmmed', 'sahmmed201146@bscse.uiu.ac.bd', '01531192391', 12000, 'Dhaka', 'Failed', 'SSLCZ_TEST_62867d5d68722', 6, 'BDT'),
(43, 'Sadia Ahmmed', 'sahmmed201146@bscse.uiu.ac.bd', '01531192391', 12000, 'Dhaka', 'Processing', 'SSLCZ_TEST_62867d7a97423', 6, 'BDT');

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
(11, 'Christian', 'Bale', 'c.bale', '$2y$10$verycrazystring123456uctzw2F2IQYf.iRkIrN7i7olpuk5IPkK', 'c.bale@gmail.com', '14252563351', 2, 'T', '11.jpg', 'House #48, Marine Drive', 'Cox\'s Bazar', 'Chittagong', 'Speech Therapy, Epilepsy, Fitness, Health', '$2y$10$verycrazystring1234567'),
(12, 'Jack', 'Daniels', 'jdan', '$2y$10$verycrazystring123456u8imG4og/4q73zzZIAo4JqmKlhLCVoPG', 'jdan@gmail.com', '01923020202', 2, 'F', '12.jpg', 'Gulshan-1', 'Dhaka', 'Dhaka', 'Speech Therapy, Epilepsy, Behavioral Sciences', '$2y$10$verycrazystring1234567'),
(13, 'Hermoine', 'Granger', 'hgranger', '$2y$10$verycrazystring123456ufgLTKsXlgDR3VFVilp8hBttEgPHF1fK', 'h.granger@hogwarts.ac.uk', '+8801773095463', 3, 'F', '13.jpg', '', '', '', NULL, '$2y$10$verycrazystring1234567');

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
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_categories`
--
ALTER TABLE `forum_categories`
  ADD PRIMARY KEY (`forum_id`);

--
-- Indexes for table `fundraisers`
--
ALTER TABLE `fundraisers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`ins_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forum_categories`
--
ALTER TABLE `forum_categories`
  MODIFY `forum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fundraisers`
--
ALTER TABLE `fundraisers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `institutions`
--
ALTER TABLE `institutions`
  MODIFY `ins_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
