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
    
    set strHashedPass = md5(strRawPassword);
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
(1, 'Nike', 'NikePhilippines', 'swoosh', 'nike@check.com', 1, '2018-02-26 13:52:54'),
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

INSERT INTO `shoes` (`uid`, `posted_by`, `name`, `description`, `type`, `category`, `size`, `price`, `color`, `photo_url`, `time_stamp`) VALUES
(1, 2, 'Adidas Yeezy Boost 350 V2', 'The second generation of the Yeezy Collection.', 'mens', 'Casual', '13', '12000', 'blue', '../images/php-uploads/shoes/mens/adidas-yeezy.png', '2018-03-18 15:19:00'),
(2, 2, 'Adidas Yeezy Boost 350 V2', 'The second generation of the original Yeezy Boost 350, the V2 version of Kanye West.', 'mens', 'Casual', '12', '15000', 'red', '../images/php-uploads/shoes/mens/adidas-yeezy_blue_tints.png', '2018-03-18 15:19:00'),
(3, 1, 'Nike Air Presto', 'OFF WHITE X NIKE COLLAB ', 'mens', 'Running/Casual', '10', '19000', 'yellow', '../images/php-uploads/shoes/mens/nike-airpresto_offwhite.png', '2018-03-18 15:19:00'),
(4, 2, 'Adidas NMD', 'lorem ipsum...', 'womens', 'Running/Casual', '8', '16500', 'pink', '../images/php-uploads/shoes/womens/adidas-nmd.png', '2018-03-19 17:16:39'),
(5, 1, 'Nike Cortez', 'lorem ipsum...', 'womens', 'Casual', '6', '12000', 'white', '../images/php-uploads/shoes/womens/nike-cortez.png', '2018-03-19 17:17:02'),
(6, 1, 'Nike Roshe', 'lorem ipsum...', 'womens', 'Running/Casual', '9', '15000', 'black', '../images/php-uploads/shoes/womens/nike-roshe.png', '2018-03-19 17:17:18');

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
(1, 'User', 'marl', '37C6F1B0A01C157186B5A878F639EBF1'),
(2, 'User', 'linds', 'linds'),
(3, 'User', 'linds', 'erla'),
(4, 'Brand', 'NikePhilippines', 'D95A2765AA6B7202E5B6B57C10850C5A'),
(5, 'Brand', 'AdidasPH', '238A0A964769B4DAD6E41653F3EE033B'),
(6, 'Brand', 'AdidasPH1', 'something'),
(7, 'Brand', 'YeezySupply', 'beluga'),
(8, 'Brand', 'ReebokPH', 'reebok'),
(9, 'Admin', 'marl', 'marl'),
(10, 'Admin', 'linds', 'linds'),
(11, 'Admin', 'chels', 'che'),
(12, 'Admin', 'daniel', '79C640CD65AC125A6D7F709E11179863'),
(13, 'User', 'dflachica77', '098F6BCD4621D373CADE4E832627B4F6');

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
(3, 'linds', 'linds', 'lindsey_erlandsen@dlsu.edu.ph', 'f', 'Lindsey', 'Panghulan', 'Erlandsen', '2018-02-27 14:41:14'),
(6, 'loserdan', '6CB59BCB03E7A1EDBE7573BC367307E8', 'dan@yahoo.com', 'm', 'Daniel Philip', 'Fernandes', 'Lachica', '2018-03-16 15:57:05'),
(9, 'maemae', '00580EFDF9D27A169D296A4B5DE7A735', 'chelsey@gmail.com', 'f', 'Chelsey ', 'Anne', 'Medina', '2018-03-16 16:00:17'),
(10, 'cris', '7BB0BB352FFB2F5245F25149889A0C76', 'chelsey@gmail.com', 'm', 'Cristino', 'Panghulan', 'Nodado', '2018-03-16 16:12:55'),
(11, 'dflachica77', '098F6BCD4621D373CADE4E832627B4F6', 'daniel_lachica@dlsu.edu.ph', 'm', 'Daniel', 'Philippe', 'Lachica', '2018-03-18 10:57:51');

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
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shoe_ratings`
--
ALTER TABLE `shoe_ratings`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_users`
--
ALTER TABLE `site_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
