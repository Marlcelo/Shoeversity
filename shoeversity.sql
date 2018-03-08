-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2018 at 02:10 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoeversity`
--
DROP DATABASE IF EXISTS `shoeversity`;
CREATE DATABASE `shoeversity`;
USE `shoeversity`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `uid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `first_name` varchar(35) NOT NULL,
  `middle_name` varchar(35) NOT NULL,
  `last_name` varchar(35) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`uid`, `username`, `password`, `email`, `gender`, `first_name`, `middle_name`, `last_name`, `time_stamp`) VALUES
(1, 'marl', 'marl', 'marlchristian@yahoo.com.ph', 'm', 'Marl', 'Christian', 'Ricanor', '2018-02-27 14:18:26'),
(2, 'linds', 'linds', 'lindsey_erlandsen@dlsu.edu.ph', 'f', 'Lindsey', 'Panghulan', 'Erlandsen', '2018-02-27 14:42:30'),
(3, 'chels', 'che', 'chelsey@gmail.com', 'm', 'Cristino', 'Panghulan', 'Nodado', '2018-02-27 14:44:58'),
(4, 'daniel', 'lachica', 'daniel@gmail.com', 'm', 'Daniel', 'Philippe', 'Lachica', '2018-03-01 00:58:42');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `uid` int(11) NOT NULL,
  `brand_name` varchar(35) NOT NULL,
  `b_username` varchar(35) NOT NULL,
  `b_password` varchar(100) NOT NULL,
  `b_email` varchar(50) NOT NULL,
  `b_verified` int(11) NOT NULL DEFAULT '0',
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`uid`, `brand_name`, `b_username`, `b_password`, `b_email`, `b_verified`, `time_stamp`) VALUES
(1, 'Nike', 'NikePhilippines', 'swoosh', 'nike@check.com', 0, '2018-02-26 13:52:54'),
(2, 'Adidas', 'AdidasPH', 'stripes', 'adidas@gmail.com', 0, '2018-02-26 13:55:45'),
(3, 'Adidas1', 'AdidasPH1', 'something', 'adidas@gmail.com', 0, '2018-02-26 13:56:37'),
(4, 'Yeezy', 'YeezySupply', 'beluga', 'yeezy@yahoo.com', 0, '2018-02-27 12:03:48'),
(5, 'ReebokAsia', 'ReebokPH', 'reebok', 'reebok@gmail.com', 0, '2018-02-27 12:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `brand_contact_number`
--

CREATE TABLE `brand_contact_number` (
  `uid` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand_contact_number`
--

INSERT INTO `brand_contact_number` (`uid`, `brand_id`, `contact`, `time_stamp`) VALUES
(1, 1, '09175135129', '2018-02-26 13:52:54'),
(2, 1, '09087651234', '2018-02-26 13:52:54'),
(3, 2, '09088765432', '2018-02-26 13:55:45'),
(4, 2, '09081234567', '2018-02-26 13:55:45'),
(5, 2, '09081237890', '2018-02-26 13:55:45'),
(6, 3, '09088765432', '2018-02-26 13:56:37'),
(7, 4, '09175135129', '2018-02-27 12:03:48'),
(8, 5, '09189876251', '2018-02-27 12:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `brand_link`
--

CREATE TABLE `brand_link` (
  `uid` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `link_type` enum('website','facebook','twitter','instagram') NOT NULL,
  `link` varchar(100) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand_link`
--

INSERT INTO `brand_link` (`uid`, `brand_id`, `link_type`, `link`, `time_stamp`) VALUES
(1, 1, 'website', 'http://www.adidas.com.ph/', '2018-02-26 13:52:54'),
(2, 1, 'twitter', 'http://www.adidas.com.ph/', '2018-02-26 13:52:54'),
(3, 1, 'instagram', 'http://www.adidas.com.ph/', '2018-02-26 13:52:54'),
(4, 1, 'facebook', 'http://www.adidas.com.ph/', '2018-02-26 13:52:54'),
(5, 2, 'website', 'https://www.youtube.com/watch?v=ToIQFP55s7Q', '2018-02-26 13:55:45'),
(6, 2, 'twitter', 'https://www.youtube.com/watch?v=ToIQFP55s7Q', '2018-02-26 13:55:45'),
(7, 2, 'instagram', 'https://www.youtube.com/watch?v=ToIQFP55s7Q', '2018-02-26 13:55:45'),
(8, 2, 'facebook', 'https://www.youtube.com/watch?v=ToIQFP55s7Q', '2018-02-26 13:55:45'),
(9, 3, 'website', 'https://www.youtube.com/watch?v=ToIQFP55s7Q', '2018-02-26 13:56:37'),
(10, 3, 'twitter', 'https://www.youtube.com/watch?v=ToIQFP55s7Q', '2018-02-26 13:56:37'),
(11, 3, 'facebook', 'https://www.youtube.com/watch?v=ToIQFP55s7Q', '2018-02-26 13:56:37'),
(12, 4, 'website', 'https://yeezysupply.com/', '2018-02-27 12:03:48'),
(13, 5, 'website', 'https://www.reebok.com/international/', '2018-02-27 12:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `brand_location`
--

CREATE TABLE `brand_location` (
  `uid` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand_location`
--

INSERT INTO `brand_location` (`uid`, `brand_id`, `location`, `time_stamp`) VALUES
(1, 1, 'Solenad Nuvali', '2018-02-26 13:52:54'),
(2, 1, 'Solenad Nuvali', '2018-02-26 13:52:54'),
(3, 2, 'Paseo De Sta Rosa', '2018-02-26 13:55:45'),
(4, 2, 'Tagaytay', '2018-02-26 13:55:45'),
(5, 2, 'Batangas City', '2018-02-26 13:55:45'),
(6, 2, 'Lipa City', '2018-02-26 13:55:45'),
(7, 3, 'Paseo De Sta Rosa', '2018-02-26 13:56:37'),
(8, 4, 'USA', '2018-02-27 12:03:48'),
(9, 5, 'Philippines,Makati', '2018-02-27 12:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `uid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `log_action` varchar(200) NOT NULL,
  `time_stamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `uid` int(11) NOT NULL,
  `purchased_by` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shoes`
--

CREATE TABLE `shoes` (
  `uid` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `name` varchar(35) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `category` varchar(35) NOT NULL,
  `size` decimal(10,0) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `color` varchar(35) NOT NULL,
  `photo_url` varchar(100) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shoes`
--

INSERT INTO `shoes` (`uid`, `posted_by`, `name`, `description`, `category`, `size`, `price`, `color`, `photo_url`, `time_stamp`) VALUES
(1, 2, 'Adidas Yeezy Boost 350 V2', 'The second generation of the Yeezy Collection.', 'Casual', '13', '12000', 'blue', 'IMAGES/MENS/adidas-yeezy-mens.jpg', '2018-02-27 17:18:19'),
(2, 2, 'Adidas Yeezy Boost 350 V2', 'The second generation of the original Yeezy Boost 350, the V2 version of Kanye West.', 'Casual', '12', '15000', 'red', 'IMAGES/MENS/adidas-yeezy_blue_tints-mes.jpg', '2018-02-27 17:44:29'),
(3, 1, 'Nike Air Presto', 'OFF WHITE X NIKE COLLAB ', 'Running/Casual', '10', '19000', 'yellow', 'IMAGES/MENS/nike-airpresto_offwhite-mens.jpg', '2018-02-27 17:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `shoe_ratings`
--

CREATE TABLE `shoe_ratings` (
  `uid` int(11) NOT NULL,
  `shoe_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `rated_by` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `u_username` varchar(35) NOT NULL,
  `u_password` varchar(100) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `u_gender` enum('m','f') NOT NULL,
  `first_name` varchar(35) NOT NULL,
  `middle_name` varchar(35) NOT NULL,
  `last_name` varchar(35) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `u_username`, `u_password`, `u_email`, `u_gender`, `first_name`, `middle_name`, `last_name`, `time_stamp`) VALUES
(1, 'marl', 'ricanor', 'marlchristian@yahoo.com.ph', 'm', 'Cristino', 'Damien', 'Nodado', '2018-02-26 14:06:57'),
(2, 'linds', 'erla', 'lindsey_erlandsen@dlsu.edu.ph', 'f', 'Lindsey', 'Panghulan', 'Erlandsen', '2018-02-26 14:40:52'),
(3, 'linds', 'linds', 'lindsey_erlandsen@dlsu.edu.ph', 'f', 'Lindsey', 'Panghulan', 'Erlandsen', '2018-02-27 14:41:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `brand_contact_number`
--
ALTER TABLE `brand_contact_number`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `brand_link`
--
ALTER TABLE `brand_link`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `brand_location`
--
ALTER TABLE `brand_location`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `user_id` (`purchased_by`),
  ADD KEY `shoe_id` (`item`);

--
-- Indexes for table `shoes`
--
ALTER TABLE `shoes`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `brand` (`posted_by`);

--
-- Indexes for table `shoe_ratings`
--
ALTER TABLE `shoe_ratings`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `shoe_id` (`shoe_id`),
  ADD KEY `user_id` (`rated_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brand_contact_number`
--
ALTER TABLE `brand_contact_number`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `brand_link`
--
ALTER TABLE `brand_link`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `brand_location`
--
ALTER TABLE `brand_location`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shoes`
--
ALTER TABLE `shoes`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shoe_ratings`
--
ALTER TABLE `shoe_ratings`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
