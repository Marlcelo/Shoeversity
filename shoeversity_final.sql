-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2018 at 05:13 PM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_PURCHASED` (`userId` INT)  BEGIN
  IF EXISTS (SELECT * FROM users WHERE uid = userId)then
    SELECT s.name,brand_name,size, category, price, color, p.time_stamp
        FROM shoes s, brands b, purchases p
        WHERE purchased_by = userId AND item = s.uid AND posted_by = b.uid;
  END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_LOG` (`uName` INT, `actions` VARCHAR(100))  BEGIN
  INSERT INTO logs VALUES(NULL,uName,actions,NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_PURCHASE` (`purchaser` INT, `itemBought` INT)  BEGIN
  declare str_return varchar(10);
    
  INSERT INTO purchases VALUES(NULL,purchaser,itemBought,NOW());
    SET str_return = "SUCCESS";
    
    SELECT str_return as col;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DELETE_USER` (`userId` INT(11))  BEGIN
  declare str_return varchar(10);
    
    IF !EXISTS(SELECT * FROM users WHERE uid LIKE uId) THEN
    SET str_return = "FAIL";
  ELSE 
    DELETE FROM users WHERE uid = userId;
        SET str_return = "SUCCESS";
  END IF;
    
    SELECT str_return result;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_ALL_USERS` ()  BEGIN
  SELECT uid,CONCAT(first_name," ",middle_name," ",last_name) uName,u_username, u_email,u_gender
    FROM users;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_ALL_LOGS`()
BEGIN
  SELECT * 
    FROM logs;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CHECK_UNAME_EMAIL_DUPLICATE` (IN `testUname` VARCHAR(50), IN `testEmail` VARCHAR(50))  BEGIN
  declare str_return varchar(10);
    
    if exists(SELECT * FROM site_users su,admins a,brands b,users u WHERE su.username LIKE testUname OR testEmail LIKE u_email OR testEmail LIKE b_email OR testEmail LIKE email) then
    set str_return = "TRUE";
  else
    set str_return = "FALSE";
  end if;
    
    SELECT str_return as col;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DELETE_ADMIN` (`adminId` INT(11))  BEGIN
  declare str_return varchar(10);
    
    IF !EXISTS(SELECT * FROM admins WHERE uid LIKE adminId) THEN
    SET str_return = "FAIL";
  ELSE 
    DELETE FROM admins WHERE uid = adminId;
        SET str_return = "SUCCESS";
  END IF;
    
    SELECT str_return result;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DELETE_BRAND` (`brandId` INT(11))  BEGIN
  declare str_return varchar(10);
    
    IF !EXISTS(SELECT * FROM brands WHERE uid LIKE brandId) THEN
    SET str_return = "FAIL";
  ELSE 
    DELETE FROM brands WHERE uid = brandId;
        SET str_return = "SUCCESS";
  END IF;
    
    SELECT str_return result;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DEL_SHOE`(shoeiD int)
BEGIN
  DECLARE strreturn varchar(10);
    IF EXISTS(SELECT * FROM shoes WHERE uid = shoeID) THEN
    DELETE FROM shoes
        WHERE uid = shoeID;
    SET strreturn = 'SUCCESS';
        
    ELSE
    SET strreturn = 'FAILED';
    
    END IF;
    
    SELECT strreturn;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_ALL_ADMINS` ()  BEGIN
  SELECT uid,CONCAT(first_name," ",middle_name," ",last_name) adName, username,email,gender
    FROM admins;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_ADMIN` (`uname` VARCHAR(50), `pass` VARCHAR(100), `emailAdd` VARCHAR(50), `gender` CHAR(2), `firstn` VARCHAR(35), `middlen` VARCHAR(35), `lastn` VARCHAR(35))  BEGIN
  declare str_return varchar(10);
    
    IF EXISTS(SELECT * FROM admins WHERE uname LIKE username AND emailAdd LIKE email) THEN
    SET str_return = "FAIL";
  ELSE 
    INSERT INTO admins VALUES(NULL,uname,FN_GET_HASHEDPASSWORD(pass),emailAdd,gender,firstn,middlen,lastn,NOW());
        SET str_return = "SUCCESS";
  END IF;
    
    SELECT str_return result;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_ALL_BRANDS` ()  BEGIN
  declare strreturn varchar(10);
  SELECT * FROM brands WHERE b_verified = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_ALL_BRANDSUV` ()  BEGIN
  declare strreturn varchar(10);
  SELECT * FROM brands WHERE b_verified = 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_APPROVE_BRAND` (`brandId` INT(11))  BEGIN
  declare strreturn varchar(10);
  IF EXISTS(SELECT * FROM brands WHERE b_verified = 0 AND uid = brandId) THEN
    UPDATE brands SET b_verified = 1 WHERE uid = brandId;
    SET strreturn = 'SUCCESS';
        
  ELSE
    SET strreturn = 'FAILED';
    
  END IF;
    
  SELECT strreturn result;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_BRAND_CONTACT`(bId int(11), contactNum varchar(20))
BEGIN
  declare str_return varchar(15);
    
    IF EXISTS(SELECT * FROM brand_contact_number WHERE bId LIKE brand_id AND contact LIKE contactNum) THEN
    set str_return = 'FAIL';
  ELSE 
    INSERT INTO brand_contact_number(brand_id,contact) VALUES(bId,contactNum);
        SET str_return = 'SUCCESS';
  END IF;
    
  SELECT str_return col;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_BRAND_INFO` (`bName` VARCHAR(35), `bUser` VARCHAR(35), `bPass` VARCHAR(100), `bEmail` VARCHAR(50))  BEGIN
  declare str_return varchar(10);
    
    IF EXISTS(SELECT * FROM brands WHERE bName LIKE brand_name AND bEmail LIKE b_email) THEN
    SET str_return = "FAIL";
  ELSE 
    INSERT INTO brands VALUES(NULL,bName,bUser,FN_GET_HASHEDPASSWORD(bPass),bEmail,0,NOW());
        SET str_return = "SUCCESS";
  END IF;
    
    SELECT str_return result;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_BRAND_LINK` (`bId` INT(11), `bLinkType` VARCHAR(15), `blink` VARCHAR(100))  BEGIN
  declare str_return varchar(15);
    
    IF EXISTS(SELECT * FROM brand_link WHERE bId LIKE brand_id AND link_type LIKE bLinkType AND blink = link) THEN
    set str_return = 'FAIL';
  ELSE 
    INSERT INTO brand_link(brand_id,link_type,link) VALUES(bId,bLinkType,blink);
        SET str_return = 'SUCCESS';
  END IF;
    
  SELECT str_return col;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_BRAND_LOCATION` (`bId` INT(11), `bLocation` VARCHAR(100))  BEGIN
  declare str_return varchar(15);
    
    IF EXISTS(SELECT * FROM brand_location WHERE bId LIKE brand_id AND location LIKE bLocation) THEN
    set str_return = 'FAIL';
  ELSE 
    INSERT INTO brand_location(brand_id,location) VALUES(bId,bLocation);
        SET str_return = 'SUCCESS';
  END IF;
    
  SELECT str_return col;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_RATING`(intShoeID int, intUserID int, intRating int)
BEGIN

  IF EXISTS(SELECT * FROM shoe_ratings WHERE shoe_id = intShoeID AND rated_by = intUserID) THEN
    UPDATE shoe_ratings
        SET rating = intRating
        WHERE shoe_id = intShoeID AND rated_by = intUserID;
        
  ELSE
    INSERT INTO shoe_ratings
        VALUES (NULL, intShoeID, intRating, intUserID, NOW());
        
    END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_BRAND`(bName varchar(35),bEmail varchar(50),bUsername varchar(35))
BEGIN
  SELECT *
  FROM brands
  WHERE brand_name LIKE bName AND b_email LIKE bEmail AND b_username LIKE bUsername;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_BRANDV`(strUsername VARCHAR(35))
BEGIN
  SELECT uid, b_username, brand_name, b_email, b_verified
  FROM brands 
  WHERE b_username = strUsername 
  LIMIT 1;
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_RATING`(intShoeID int)
BEGIN

  SELECT AVG(rating) FROM shoe_ratings WHERE shoe_id = intShoeID;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_RATING_FOR`(intShoeID int, intUserID int)
BEGIN

  SELECT rating FROM shoe_ratings WHERE shoe_id = intShoeID AND rated_by = intUserID;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_BRAND_NAMES`()
BEGIN

  SELECT uid, brand_name 
    FROM brands
    ORDER BY uid;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_BRAND_INFO`(brandID int)
BEGIN
  SELECT *
  FROM brands
  WHERE uid = brandID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_BRAND_PROFILE`(brandID int)
BEGIN
  SELECT *
  FROM brands, brand_contact_number, brand_link, brand_location
  WHERE brands.uid = brandID AND brand_location.brand_id = brandID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_BRAND_CONTACTS`(brandID int)
BEGIN
  SELECT *
  FROM brand_contact_number
  WHERE brand_contact_number.brand_id = brandID;
END$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_BRAND_LINKS`(brandID int)
BEGIN
  SELECT *
  FROM brand_link
  WHERE brand_link.brand_id = brandID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_SHOE_FROM`(intBrandID int)
BEGIN
  SELECT * 
  FROM shoes 
  WHERE posted_by = intBrandID
  ORDER BY uid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_SHOE` (`intShoeID` INT)  
BEGIN
  SELECT * 
  FROM shoes,brands 
  WHERE shoes.uid = intShoeID AND posted_by = brands.uid
  LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_NEWUSER` (`uname` VARCHAR(35), `pass` VARCHAR(100), `emailAdd` VARCHAR(50), `uGender` CHAR(1), `fname` VARCHAR(35), `mname` VARCHAR(35), `lname` VARCHAR(35))  BEGIN
  declare str_return varchar(10); 
    
    IF EXISTS(SELECT * FROM users WHERE uname LIKE u_username AND emailAdd LIKE u_email) THEN
    set str_return = "FAIL";
  ELSE 
    INSERT INTO users VALUES(NULL,uname,FN_GET_HASHEDPASSWORD(pass),emailAdd,uGender,fname,mname,lname,NOW());
        set str_return = "SUCCESS";
  END IF;
    
    SELECT str_return as col;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_SHOE`(brandID int, shoeName varchar(35), shoeDesc text, shoeType varchar(10), shoeCategory varchar(35), shoeSize int,
                                                          shoePrice double, shoeColor varchar(35), shoeImage varchar(100))
BEGIN
  DECLARE str_return varchar(10); 
  
  IF EXISTS(SELECT * FROM shoes WHERE posted_by = brandID AND name = shoeName AND type = shoeType AND category = shoeCategory) THEN
    SET str_return = 'FAILED';  
    
  ELSE
    INSERT INTO shoes VALUES (
      NULL, brandID, shoeName, shoeDesc, shoeType, 
        shoeCategory, shoeSize, shoePrice, shoeColor, 
        shoeImage, NOW()
      );
    SET str_return = 'SUCCESS';  
  
  END IF;
  
  SELECT str_return;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_SITE_USER` (`uType` VARCHAR(10), `uName` VARCHAR(35), `upass` VARCHAR(100))  BEGIN
  declare str_return varchar(15);
    
    IF EXISTS(SELECT * FROM site_users WHERE uType LIKE type AND uName LIKE username AND upass LIKE password) THEN
    set str_return = 'FAIL';
  ELSE 
    INSERT INTO site_users(type,username,password) VALUES(uType,uName,upass);
        SET str_return = 'SUCCESS';
  END IF;
    
  SELECT str_return col;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_ADMIN` (`strUsername` VARCHAR(35))  BEGIN
  SELECT uid, username, email, gender, first_name, middle_name, last_name
    FROM admins 
    WHERE username = strUsername 
    LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_AUTHUSER` (`strUsername` VARCHAR(35), `strPassword` VARCHAR(100))  BEGIN
  DECLARE strreturn varchar(50);
    
  IF EXISTS (SELECT * FROM site_users WHERE username = strUsername AND password = strPassword LIMIT 1) THEN
    SET strreturn = 'SUCCESS';
        
    ELSE
    SET strreturn = 'FAILED';
        
    END IF;
    
    SELECT strreturn;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_USER` (`strUsername` VARCHAR(35))  BEGIN
  SELECT uid, u_username, u_email, u_gender, first_name, middle_name, last_name
    FROM users 
    WHERE u_username = strUsername 
    LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_USER_FROM_EMAIL`(strEmail VARCHAR(50))
BEGIN
  DECLARE strType VARCHAR(10);
    
  IF EXISTS(SELECT u_email FROM users WHERE u_email = strEmail) THEN
    SET strType = 'USER';
        
    SELECT strType, u_username, u_email, first_name, last_name
    FROM users 
    WHERE u_email = strEmail 
    LIMIT 1;
        
  ELSEIF EXISTS(SELECT b_email FROM brands WHERE b_email =  strEmail) THEN
    SET strType = 'BRAND';
        
    SELECT strType, b_username, b_email, brand_name
    FROM brands 
    WHERE b_email = strEmail 
    LIMIT 1;
    
  ELSEIF EXISTS(SELECT email FROM admins WHERE email =  strEmail) THEN
    SET strType = 'ADMIN';
        
    SELECT strType, username, email, first_name, last_name
    FROM admins 
    WHERE email = strEmail 
    LIMIT 1;
        
  END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_SET_SHOE`(shoeID int, shoeName varchar(35), shoeDesc text, shoeType varchar(10), shoeCategory varchar(35), shoeSize int,
                                                          shoePrice double, shoeColor varchar(35), shoeImage varchar(100))
BEGIN
  UPDATE shoes
  SET name = shoeName, 
    description = shoeDesc,
      type = shoeType,
      category = shoeCategory,
      size = shoeSize,
      price = shoePrice,
      color = shoeColor,
      photo_url = shoeImage
  WHERE uid = shoeID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_SET_PASSWORD`(strEmail VARCHAR(50), strUsername VARCHAR(35), strPass VARCHAR(100))
BEGIN
  IF EXISTS(SELECT u_email FROM users WHERE u_email = strEmail) THEN
    UPDATE users
    SET u_password = FN_GET_HASHEDPASSWORD(strPass)
    WHERE u_email = strEmail;
        
  ELSEIF EXISTS(SELECT b_email FROM brands WHERE b_email =  strEmail) THEN
    UPDATE brands
    SET b_password = FN_GET_HASHEDPASSWORD(strPass)
    WHERE b_email = strEmail;
    
    ELSEIF EXISTS(SELECT email FROM admins WHERE email =  strEmail) THEN
    UPDATE admins
    SET password = FN_GET_HASHEDPASSWORD(strPass)
    WHERE email = strEmail;
    END IF;
    
    UPDATE site_users
  SET password = FN_GET_HASHEDPASSWORD(strPass) 
  WHERE username = strUsername;  
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `FN_GET_HASHEDPASSWORD` (`strRawPassword` VARCHAR(255)) RETURNS VARCHAR(255) CHARSET latin1 READS SQL DATA
    DETERMINISTIC
BEGIN
  
  DECLARE strHashedPass varchar(255);
    
    set strHashedPass = sha2(strRawPassword, 256);
    set strHashedPass = UPPER(strHashedPass);

  RETURN strHashedPass;
    
END$$

DELIMITER ;

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
(1, 'logandylan37', '5C06EB3D5A05A19F49476D694CA81A36344660E9D5B98E3D6A6630F31C2422E7', 'daniel.lachica82@gmail.com', 'm', 'Logan', 'Dylan', 'Ricanor', NOW());

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

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `uid` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
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
  `description` text DEFAULT NULL,
  `type` enum('mens','womens') NOT NULL,
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
-- Table structure for table `site_users`
--

CREATE TABLE `site_users` (
  `id` int(11) NOT NULL,
  `type` enum('Admin','Brand','User','') NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_users`
--

INSERT INTO `site_users` (`id`, `type`, `username`, `password`) VALUES
(1, 'Admin', 'logandylan37', '5C06EB3D5A05A19F49476D694CA81A36344660E9D5B98E3D6A6630F31C2422E7');

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
  ADD KEY `username` (`username`);

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
-- Indexes for table `site_users`
--
ALTER TABLE `site_users`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand_contact_number`
--
ALTER TABLE `brand_contact_number`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand_link`
--
ALTER TABLE `brand_link`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand_location`
--
ALTER TABLE `brand_location`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shoe_ratings`
--
ALTER TABLE `shoe_ratings`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_users`
--
ALTER TABLE `site_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
