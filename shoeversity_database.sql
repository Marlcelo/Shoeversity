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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_LOG` (`uName` VARCHAR(35), `actions` VARCHAR(100))  BEGIN
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
    FROM logs ORDER BY time_stamp DESC;
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
  
  IF EXISTS(SELECT * FROM shoes WHERE posted_by = brandID AND name = shoeName AND type = shoeType AND category = shoeCategory AND size = shoeSize AND color = shoeColor) THEN
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

INSERT INTO `brands` (`uid`, `brand_name`, `b_username`, `b_password`, `b_email`, `b_verified`, `time_stamp`) VALUES
(1, 'Nike', 'nikephilippines', '041BC667C02B01AE6B3C4DB08CF4D904B0DEBBF73EE74E7CC2DA890AB0F718BB', 'nike@gmail.com', 1, '2018-04-17 06:19:58'),
(2, 'Adidas', 'adidasofficialph', 'D207E70CD6DE2F72823F9CB381C4693E8C00DDA81EE5DED2349755530DA9F80D', 'adidas@gmail.com', 1, '2018-04-17 06:17:35'),
(3, 'Reebok', 'reebok_ph', '6D1BA1FC9150934CBA2C02CA006070F865D808BD422668835A94828018A19905', 'reebok@gmail.com', 1, '2018-04-17 06:20:12'),
(4, 'New Balance', 'newbalanceph', 'BD79CE2E53AE7EB36EE8F5055C3042A637338E3C319A8A72D4FBD3D709620812', 'newbalance@gmail.com', 1, '2018-04-17 06:19:38'),
(5, 'Vans', 'vansofficialph', '3685BF34FFCF2776799DFC38769330F9928508672A0AEB60AF15BD49F901C22D', 'vans@gmail.com', 1, '2018-04-17 06:20:25'),
(6, 'Gucci', 'guccishoes', 'BBC620549F120D673EC9CD516EB9352CA381B36403F582068925A46B46F34153', 'gucci@gmail.com', 1, '2018-04-17 06:19:26'),
(7, 'Converse', 'converseph', '442769274DF734F72902ADC4659AB90B7F1D09B9252914AB4E05D9158A013E23', 'converse@gmail.com', 1, '2018-04-17 06:18:13'),
(8, 'Fila', 'filaphilippines', '50139FE31EC4047210FB7731FE2E9DC63AA208DA3547F6C1FF2D78E20E547028', 'fila@gmail.com', 0, '2018-04-17 06:11:39');

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
(1, 1, '1800-188-6453', '2018-04-17 05:15:48'),
(2, 1, '0002-802-7235', '2018-04-17 05:15:48'),
(3, 2, '0002-633-8110', '2018-04-17 05:27:39'),
(4, 2, '0002-376-4716', '2018-04-17 05:27:39'),
(5, 3, '0143-784-0428', '2018-04-17 05:36:23'),
(6, 3, '0002-536-8072', '2018-04-17 05:36:23'),
(7, 4, '0002-846-1958', '2018-04-17 05:43:44'),
(8, 5, '0855-909-8267', '2018-04-17 05:51:44'),
(9, 5, '6302-519-8927', '2018-04-17 05:51:44'),
(10, 5, '6302-519-2371', '2018-04-17 05:51:44'),
(11, 6, '0632-637-2892', '2018-04-17 05:59:51'),
(12, 7, '6292-941-4382', '2018-04-17 06:07:47'),
(13, 8, '0002-783-2745', '2018-04-17 06:11:39'),
(14, 8, '0639-283-4811', '2018-04-17 06:11:39');

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
(1, 1, 'website', 'https://www.nike.com/ph/en_gb/', '2018-04-17 05:15:48'),
(2, 1, 'facebook', 'https://www.facebook.com/nike/', '2018-04-17 05:15:48'),
(3, 1, 'twitter', 'https://twitter.com/Nike', '2018-04-17 05:15:48'),
(4, 1, 'instagram', 'https://www.instagram.com/nike/', '2018-04-17 05:15:48'),
(5, 2, 'website', 'http://shop.adidas.com.ph/', '2018-04-17 05:27:40'),
(6, 2, 'facebook', 'https://www.facebook.com/adidasPH', '2018-04-17 05:27:40'),
(7, 2, 'twitter', 'https://twitter.com/adidas', '2018-04-17 05:27:40'),
(8, 2, 'instagram', 'https://www.instagram.com/adidasph/', '2018-04-17 05:27:40'),
(9, 3, 'website', 'https://www.reebok.com/international/', '2018-04-17 05:36:24'),
(10, 3, 'facebook', 'https://www.facebook.com/reebokphilippines/', '2018-04-17 05:36:24'),
(11, 4, 'website', 'http://newbalance.com.ph/', '2018-04-17 05:43:44'),
(12, 4, 'facebook', 'https://www.facebook.com/Newbalance/', '2018-04-17 05:43:44'),
(13, 4, 'twitter', 'https://twitter.com/newbalanceph', '2018-04-17 05:43:44'),
(14, 4, 'instagram', 'https://www.instagram.com/newbalance/', '2018-04-17 05:43:44'),
(15, 5, 'website', 'https://www.vans.com/', '2018-04-17 05:51:44'),
(16, 5, 'facebook', 'https://www.facebook.com/vansphmanila/', '2018-04-17 05:51:44'),
(17, 5, 'twitter', 'https://twitter.com/VANS_66', '2018-04-17 05:51:44'),
(18, 5, 'instagram', 'https://www.instagram.com/vans/', '2018-04-17 05:51:44'),
(19, 6, 'website', 'https://www.gucci.com/us/en/', '2018-04-17 05:59:51'),
(20, 6, 'facebook', 'https://www.facebook.com/GUCCI/', '2018-04-17 05:59:51'),
(21, 6, 'twitter', 'https://twitter.com/gucci', '2018-04-17 05:59:51'),
(22, 6, 'instagram', 'https://www.instagram.com/gucci/', '2018-04-17 05:59:51'),
(23, 7, 'website', 'https://www.converse.com/us/en_us/c/converse', '2018-04-17 06:07:47'),
(24, 7, 'facebook', 'https://www.facebook.com/Converse.PH/', '2018-04-17 06:07:47'),
(25, 7, 'twitter', 'https://twitter.com/Converse', '2018-04-17 06:07:47'),
(26, 7, 'instagram', 'https://www.instagram.com/converseph/', '2018-04-17 06:07:47'),
(27, 8, 'website', 'http://www.fila.com.ph/', '2018-04-17 06:11:40');

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
(1, 1, '10/F Marajo Tower, 312 26th St. West cor 4th Ave., Bonifacio Global City, Taguig Metro Manila', '2018-04-17 05:15:48'),
(2, 1, 'Solenad 3 Ayala Malls, Nuvali, Laguna', '2018-04-17 05:15:48'),
(3, 2, 'Trinoma Store, Quezon City, Metro Manila', '2018-04-17 05:27:39'),
(4, 2, 'Ortigas Avenue Greenhills, San Juan, Philippines', '2018-04-17 05:27:39'),
(5, 2, 'Ground Floor SM City North the Annex, North Avenue Corner Edsa', '2018-04-17 05:27:39'),
(6, 3, 'Royal Sporting House - Nuvali, Sta. Rosa Laguna', '2018-04-17 05:36:23'),
(7, 3, 'Royal Sporting House - Festival, Level 2 Festival Supermall, Alabang', '2018-04-17 05:36:23'),
(8, 3, 'Royal Sporting House - Makati, Ayala Center, Makati', '2018-04-17 05:36:23'),
(9, 3, 'Royal Sporting House - Alimall, Araneta Center, Cubao Q.C.', '2018-04-17 05:36:24'),
(10, 4, '3F Alabang Town Center, Alabang, Muntinlupa City', '2018-04-17 05:43:44'),
(11, 4, 'Ayala Malls Solenad, Nuvali, Laguna', '2018-04-17 05:43:44'),
(12, 5, 'California HQ - 1588 South Coast Dr., Costa Mesa, CA 92626', '2018-04-17 05:51:44'),
(13, 5, 'Vans Store - G/F The Garden, Alabang Town Center, Muntinlupa', '2018-04-17 05:51:44'),
(14, 5, 'Vans Store - G/F Level, Glorietta 3, Ayala Center, Makati City', '2018-04-17 05:51:44'),
(15, 5, 'Vans Store - 2/F Level, Greenbelt 3, Makati City', '2018-04-17 05:51:44'),
(16, 6, 'Shangri - La Plaza Mall, Edsa Corner Shaw Boulevard, Mandaluyong, Metro Manila', '2018-04-17 05:59:51'),
(17, 7, '3F Alabang Town Center, Alabang, Muntinlupa City', '2018-04-17 06:07:47'),
(18, 7, 'Ayala Malls Solenad, Nuvali, Laguna', '2018-04-17 06:07:47'),
(19, 7, 'Greenbelt 3, Makati City', '2018-04-17 06:07:47'),
(20, 8, '3F Alabang Town Center, Alabang, Muntinlupa City', '2018-04-17 06:11:39'),
(21, 8, 'Ayala Malls Solenad, Nuvali, Laguna', '2018-04-17 06:11:39');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `uid` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `log_action` varchar(200) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`uid`, `username`, `log_action`, `time_stamp`) VALUES
(1, 'logandylan37', 'Successfully Logged In', '2018-04-17 04:55:55'),
(2, 'logandylan37', 'Logged Out', '2018-04-17 04:57:35'),
(3, 'nikephilippines', 'Newly Registered', '2018-04-17 05:15:48'),
(4, 'nikephilippines', 'Successfully Logged In', '2018-04-17 05:18:32'),
(5, 'logandylan37', 'Successfully Logged In', '2018-04-17 05:18:47'),
(6, 'logandylan37', 'Logged Out', '2018-04-17 05:19:48'),
(7, 'adidasofficialph', 'Newly Registered', '2018-04-17 05:27:40'),
(8, 'reebok_ph', 'Newly Registered', '2018-04-17 05:36:24'),
(9, 'newbalanceph', 'Newly Registered', '2018-04-17 05:43:44'),
(10, 'vansofficialph', 'Newly Registered', '2018-04-17 05:51:44'),
(11, 'guccishoes', 'Newly Registered', '2018-04-17 05:59:51'),
(12, 'logandylan37', 'Successfully Logged In', '2018-04-17 06:00:06'),
(13, 'logandylan37', 'Logged Out', '2018-04-17 06:06:56'),
(14, 'converseph', 'Newly Registered', '2018-04-17 06:07:48'),
(15, 'filaphilippines', 'Newly Registered', '2018-04-17 06:11:40'),
(16, 'logandylan37', 'Successfully Logged In', '2018-04-17 06:12:20'),
(17, 'logandylan37', 'Approved Brand 2', '2018-04-17 06:17:35'),
(18, 'logandylan37', 'Approved Brand 7', '2018-04-17 06:18:13'),
(19, 'logandylan37', 'Approved Brand 6', '2018-04-17 06:19:26'),
(20, 'logandylan37', 'Approved Brand 4', '2018-04-17 06:19:38'),
(21, 'logandylan37', 'Approved Brand 1', '2018-04-17 06:19:58'),
(22, 'logandylan37', 'Approved Brand 3', '2018-04-17 06:20:12'),
(23, 'logandylan37', 'Approved Brand 5', '2018-04-17 06:20:25'),
(24, 'logandylan37', 'Logged Out', '2018-04-17 06:20:44'),
(25, 'nikephilippines', 'Successfully Logged In', '2018-04-17 06:20:53'),
(26, 'logandylan37', 'Successfully Logged In', '2018-04-17 06:25:18'),
(27, 'logandylan37', 'Logged Out', '2018-04-17 06:25:32'),
(28, 'nikephilippines', 'Successfully Logged In', '2018-04-17 06:25:44'),
(29, 'nikephilippines', 'New product Nike Air Presto has been added', '2018-04-17 07:10:29'),
(30, 'nikephilippines', 'Product Nike Air Presto has been updated', '2018-04-17 07:14:55'),
(31, 'Unknown user', 'Attempted to access /Shoeversity/views/brands/products.php?edit=1&pid=1&token=5b05bb43e02aac13e8a798', '2018-04-17 08:38:57'),
(32, 'Unknown user', 'Attempted to access /Shoeversity/views/brands/products.php?token=5b05bb43e02aac13e8a7985be7ef2b940e7', '2018-04-17 08:38:58'),
(33, 'Unknown user', 'Attempted to access /Shoeversity/views/brands/view_product.php?pid=1&token=5b05bb43e02aac13e8a7985be', '2018-04-17 08:38:59'),
(34, 'logandylan37', 'Successfully Logged In', '2018-04-17 08:39:16'),
(35, 'logandylan37', 'Logged Out', '2018-04-17 08:40:59'),
(36, 'nikephilippines', 'Successfully Logged In', '2018-04-17 08:41:08'),
(37, 'nikephilippines', 'Product Nike Air Presto has been updated', '2018-04-17 08:41:22'),
(38, 'nikephilippines', 'New product Nike Air Huarache has been added', '2018-04-17 09:08:03'),
(39, 'nikephilippines', 'New product Nike Air Max has been added', '2018-04-17 09:09:39'),
(40, 'nikephilippines', 'New product Nike Air Precision has been added', '2018-04-17 09:11:49'),
(41, 'nikephilippines', 'New product Nike Air Zoom Flyknit has been added', '2018-04-17 09:16:37'),
(42, 'nikephilippines', 'New product Nike Dart has been added', '2018-04-17 09:18:00'),
(43, 'nikephilippines', 'New product Nike Dualtone Racer has been added', '2018-04-17 09:18:58'),
(44, 'nikephilippines', 'New product Nike Hyperdunk has been added', '2018-04-17 09:20:40'),
(45, 'nikephilippines', 'New product Nike Rack Room has been added', '2018-04-17 09:21:51'),
(46, 'nikephilippines', 'New product Nike Air Max Guile has been added', '2018-04-17 09:23:13'),
(47, 'nikephilippines', 'New product Nike Air Max Tailwind has been added', '2018-04-17 09:25:53'),
(48, 'nikephilippines', 'New product Nike Cortez has been added', '2018-04-17 09:27:01'),
(49, 'nikephilippines', 'New product Nike Flex has been added', '2018-04-17 09:28:12'),
(50, 'nikephilippines', 'New product Nike Flex Style has been added', '2018-04-17 09:29:21'),
(51, 'nikephilippines', 'New product Nike Lunar Eclipse has been added', '2018-04-17 09:30:35'),
(52, 'nikephilippines', 'New product Nike Roshe One has been added', '2018-04-17 09:31:55'),
(53, 'nikephilippines', 'Logged Out', '2018-04-17 09:32:22'),
(54, 'reebok_ph', 'Successfully Logged In', '2018-04-17 09:33:30'),
(55, 'reebok_ph', 'New product Reebok Crossfit Nano has been added', '2018-04-17 09:34:47'),
(56, 'reebok_ph', 'New product Reebok Crossfit Nano 8 Flexweave has been added', '2018-04-17 09:37:18'),
(57, 'reebok_ph', 'New product Reebok Speed has been added', '2018-04-17 09:37:45'),
(58, 'reebok_ph', 'New product Reebok Twistform has been added', '2018-04-17 09:39:10'),
(59, 'reebok_ph', 'New product Reebok Classic Leather has been added', '2018-04-17 09:41:21'),
(60, 'reebok_ph', 'Product Reebok Classic Leather has been updated', '2018-04-17 09:41:34'),
(61, 'reebok_ph', 'New product Reebok Speed has been added', '2018-04-17 09:42:43'),
(62, 'reebok_ph', 'Logged Out', '2018-04-17 09:42:59'),
(63, 'newbalanceph', 'Successfully Logged In', '2018-04-17 09:59:44'),
(64, 'newbalanceph', 'New product New Balance 501 Classic has been added', '2018-04-17 10:00:44'),
(65, 'newbalanceph', 'New product New Balance 990 has been added', '2018-04-17 10:02:25'),
(66, 'newbalanceph', 'Product New Balance 990 has been updated', '2018-04-17 10:02:41'),
(67, 'newbalanceph', 'New product New Balance FF Zarte has been added', '2018-04-17 10:04:40'),
(68, 'newbalanceph', 'New product New Balance 501 Kids has been added', '2018-04-17 10:05:26'),
(69, 'newbalanceph', 'New product New Balance 696 Classic has been added', '2018-04-17 10:06:20'),
(70, 'newbalanceph', 'New product New Balance 999 CML has been added', '2018-04-17 10:07:04'),
(71, 'newbalanceph', 'New product New Balance Fresh Cruz has been added', '2018-04-17 10:07:44'),
(72, 'newbalanceph', 'New product New Balance Runners has been added', '2018-04-17 10:09:41'),
(73, 'newbalanceph', 'Logged Out', '2018-04-17 10:09:58'),
(74, 'vansofficialph', 'Successfully Logged In', '2018-04-17 10:10:56'),
(75, 'vansofficialph', 'New product Vans Lo Suede has been added', '2018-04-17 10:11:21'),
(76, 'vansofficialph', 'New product Vans SK8-Hi has been added', '2018-04-17 10:11:52'),
(77, 'vansofficialph', 'Product Vans SK8-Hi has been updated', '2018-04-17 10:12:03'),
(78, 'vansofficialph', 'New product Vans Ward Lo has been added', '2018-04-17 10:12:39'),
(79, 'vansofficialph', 'New product Vans Asher Chambray has been added', '2018-04-17 10:13:48'),
(80, 'vansofficialph', 'Logged Out', '2018-04-17 10:13:53'),
(81, 'guccishoes', 'Successfully Logged In', '2018-04-17 12:17:43'),
(82, 'guccishoes', 'New product Gucci Lyst has been added', '2018-04-17 12:18:46'),
(83, 'guccishoes', 'New product Gucci Marmount Sandals has been added', '2018-04-17 12:19:23'),
(84, 'guccishoes', 'New product Gucci Ace (Leather) has been added', '2018-04-17 12:20:17'),
(85, 'guccishoes', 'Logged Out', '2018-04-17 12:20:32'),
(86, 'converseph', 'Successfully Logged In', '2018-04-17 12:21:24'),
(87, 'converseph', 'New product Converse Chuck Taylor Hi (Black) has been added', '2018-04-17 12:22:33'),
(88, 'converseph', 'New product Converse Chuck Taylor Hi (White) has been added', '2018-04-17 12:23:11'),
(89, 'converseph', 'Product Converse Chuck Taylor Hi (Black) has been updated', '2018-04-17 12:23:27'),
(90, 'converseph', 'Product Converse Chuck Taylor Hi (Red) has been updated', '2018-04-17 12:23:36'),
(91, 'converseph', 'New product Converse Chuck Taylor has been added', '2018-04-17 12:24:20'),
(92, 'converseph', 'New product Converse Chuck Taylor Allstars has been added', '2018-04-17 12:25:05'),
(93, 'converseph', 'New product Converse Chuck Taylor Hi (White) has been added', '2018-04-17 12:25:32'),
(94, 'converseph', 'Logged Out', '2018-04-17 12:25:48'),
(95, 'adidasofficialph', 'Successfully Logged In', '2018-04-17 12:26:51'),
(96, 'adidasofficialph', 'New product Adidas NMD R1 has been added', '2018-04-17 12:28:10'),
(97, 'adidasofficialph', 'New product Adidas NMD XR1 has been added', '2018-04-17 12:29:26'),
(98, 'adidasofficialph', 'New product Adidas Prophere has been added', '2018-04-17 12:30:34'),
(99, 'adidasofficialph', 'New product Adidas Stan Smith has been added', '2018-04-17 12:31:54'),
(100, 'adidasofficialph', 'New product Adidas Yeezy Boost has been added', '2018-04-17 12:34:59'),
(101, 'adidasofficialph', 'New product Adidas Yeezy Boost V2 has been added', '2018-04-17 12:35:29'),
(102, 'adidasofficialph', 'New product Adidas NMD R1 STLT has been added', '2018-04-17 12:36:46'),
(103, 'adidasofficialph', 'New product Adidas Superstar has been added', '2018-04-17 12:37:50'),
(104, 'adidasofficialph', 'Logged Out', '2018-04-17 12:38:02');

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
(1, 1, 'Nike Air Presto', 'Want a shoe that has all the timelessness and comfort of your favorite T-shirt? Look no further than the Nike Air Presto. With a molded lacing component and comfortable stretch-mesh upper, you’ll have support and flexibility where you need them most. The Phylon™ midsole and Air-Sole® unit add lightweight cushioning for all of your everyday activities.', 'mens', 'Running', '12', '5500', 'black', '../images/php-uploads/shoes/mens/nike-running-nike_air_presto.png', '2018-04-17 08:41:22'),
(2, 1, 'Nike Air Huarache', 'The men’s Nike Air Huarache is the epitome of eye-catching style, designed by Tinker Hatfield himself. Its neoprene inner sleeve hugs your foot in all of the right places, providing you with the support you need. The textile and leather upper adds the perfect finish to this streetwear staple. Phylon™ foam in the midsole and Air-Sole® units under the heel and forefoot offer you undeniable comfort with each step you take. This fresh sneaker is finished off with a rubber outsole in a waffle pattern for premium traction and exceptional durability. This kick is dressed to impress, so are you ready to turn some heads?', 'mens', 'Sneakers', '13', '5999', 'green', '../images/php-uploads/shoes/mens/nike-sneakers-nike_air_huarache.png', '2018-04-17 09:08:03'),
(3, 1, 'Nike Air Max', 'Introducing the first-ever Max Air unit designed specifically for Nike Sportswear, the Nike Air Max 270 delivers visible air and unbelievable comfort under every step. It has callbacks to the original 1991 Air Max 180 on its exaggerated tongue top and heritage tongue logo while also being upgraded for modern comfort.', 'mens', 'Sneakers', '9', '7000', 'orange', '../images/php-uploads/shoes/mens/nike-sneakers-nike_air_max.png', '2018-04-17 09:09:39'),
(4, 1, 'Nike Air Precision', 'The in-your-face style of the men’s Nike Air Precision is as mesmerizing now as it was when the experimental design debuted in 1998 and changed the game forever. With the same fierce details, like the injected ribs that wrap the upper, but revamped technology, today&#39;s version of the shoe is exactly what you’re looking for.', 'mens', 'Training', '13', '7000', 'black', '../images/php-uploads/shoes/mens/nike-training-nike_air_precision.png', '2018-04-17 09:11:49'),
(5, 1, 'Nike Air Zoom Flyknit', 'The track icon that&#39;s been winning marathons since the &#39;80s is making a modern return. Featuring a Flyknit upper, sock-like feel, and Zoom Air unit, the Nike Air Zoom Flyknit Racer has a streamlined style that represents its race-day roots.', 'mens', 'Running', '12', '6799', 'gray', '../images/php-uploads/shoes/mens/nike-running-nike_air_zoom_flyknit.png', '2018-04-17 09:16:37'),
(6, 1, 'Nike Dart', 'Introducing a revamped design loaded with durable support, while remaining lightweight and breathable so you can wear it from your run&#39;s start to the day&#39;s finish.', 'mens', 'Running', '11', '4100', 'white', '../images/php-uploads/shoes/mens/nike-running-nike_dart.png', '2018-04-17 09:18:00'),
(7, 1, 'Nike Dualtone Racer', 'Inspired by the track and reinvented for the street, the Nike Dualtone Racer offers a sleek style and speedy look. The shoe mixes a running style with casual appeal to create a unique silhouette that&#39;s perfect for runners and streetwear fans.', 'mens', 'Running', '9', '5000', 'gray', '../images/php-uploads/shoes/mens/nike-running-nike_dualtone_racer.png', '2018-04-17 09:18:58'),
(8, 1, 'Nike Hyperdunk', 'Stay fresh on the court all game long with the Nike Hyperdunk 2017. The latest and greatest in a long line of Hyperdunks, the 2017 edition of the famous basketball shoe is made for basketball&#39;s best players.  Updated technology and a new look turn the Nike Hyperdunk 2017 into the best Hyperdunk yet. Nike React Cushioning is Nike&#39;s best cushioning yet, built to keep you feeling fresh all game long with a lightweight feel and extreme durability.', 'mens', 'Training', '12', '6500', 'gray', '../images/php-uploads/shoes/mens/nike-training-nike_hyperdunk.png', '2018-04-17 09:20:40'),
(9, 1, 'Nike Rack Room', 'A highly technical design that will help you sprint to the finish line. Best for runs 100m-400m.', 'mens', 'Running', '10', '3999', 'gray', '../images/php-uploads/shoes/mens/nike-running-nike_rack_room.png', '2018-04-17 09:21:51'),
(10, 1, 'Nike Air Max Guile', 'The Nike Air Max Guile boasts classic style and a comfortable step, which is perfect for your daily jogging routine.', 'womens', 'Running', '8', '4200', 'black', '../images/php-uploads/shoes/womens/nike-running-nike_air_max_guile.png', '2018-04-17 09:23:13'),
(11, 1, 'Nike Air Max Tailwind', 'Premium cushioning and advanced comfort make this running shoe truly a throne for your feet.', 'womens', 'Running', '10', '5000', 'orange', '../images/php-uploads/shoes/womens/nike-running-nike_air_max_tailwind.png', '2018-04-17 09:25:53'),
(12, 1, 'Nike Cortez', 'Nothing says “classic retro look” like Bill Bowerman’s first masterpiece, the men’s Nike Cortez. Proving that you can’t go wrong with an iconic look, the Cortez features a herringbone outsole for traction and durability. The wedge EVA midsole provides updated comfort that won’t weigh you down. A low-cut collar gives you freedom of movement, and the eye-catching Swoosh logo completes the look.', 'womens', 'Casual', '9', '2700', 'white', '../images/php-uploads/shoes/womens/nike-casual-nike_cortez.png', '2018-04-17 09:27:01'),
(13, 1, 'Nike Flex', 'Lightweight and flexible, the Nike Flex RN 2017 enhances your natural stride for a more comfortable, efficient run.', 'womens', 'Running', '9', '3999', 'black', '../images/php-uploads/shoes/womens/nike-running-nike_flex.png', '2018-04-17 09:28:12'),
(14, 1, 'Nike Flex Style', 'Lightweight and flexible, the Nike Flex RN 2017 enhances your natural stride for a more comfortable, efficient run.', 'womens', 'Running', '9', '3999', 'white', '../images/php-uploads/shoes/womens/nike-running-nike_flex_style.png', '2018-04-17 09:29:21'),
(15, 1, 'Nike Lunar Eclipse', 'The Nike LunarEclipse+ 3 running shoe provides lightweight support for the mild- to moderate overpronator. Evolved Flywire technology hugs the entire length of foot with customizable lightweight support. Heel clip engages upon footstrike to offer snug fit and support. Lunarlon cushioning system with a bottomless carrier construction and the Dynamic Support platform adds support and plush cushioning. Natural-motion-engineered flex groves promote an efficient stride. BRS 1000™ at heel. Environmentally preferred rubber everywhere else. Wt. 8.9 oz.', 'womens', 'Running', '9', '2999', 'violet', '../images/php-uploads/shoes/womens/nike-running-nike_lunar_eclipse.png', '2018-04-17 09:30:35'),
(16, 1, 'Nike Roshe One', 'Everywhere you look, you can see gals rocking a pair of women’s Roshe Ones. They’re one of the most versatile shoes from Nike. Wear them with or without socks, dress them up or down — the Roshe One can do it all. Its superior ventilation comes from the ultra-lightweight mesh textile or suede upper, offering you the breathability your feet need.  The full-length Phylon™ midsole provides all-day comfort and support, while the waffle outsole gives you traction where you need it the most.', 'womens', 'Running', '11', '3500', 'red', '../images/php-uploads/shoes/womens/nike-running-nike_roshe_one.png', '2018-04-17 09:31:55'),
(17, 3, 'Reebok Crossfit Nano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla. Nulla facilisi. Fusce sollicitudin sem rutrum sapien placerat tempus. Duis non enim venenatis, vulputate felis eu, lacinia dui. Ut placerat ante turpis, at tempus ipsum gravida sit amet. Pellentesque vitae sodales eros. Praesent volutpat arcu in purus consequat, id sagittis lorem euismod. Aenean porta pellentesque dui non auctor.', 'mens', 'Training', '12', '2600', 'gray', '../images/php-uploads/shoes/mens/reebok-training-reebok_crossfit_nano.png', '2018-04-17 09:34:47'),
(18, 3, 'Reebok Crossfit Nano 8 Flexweave', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla. Nulla facilisi. Fusce sollicitudin sem rutrum sapien placerat tempus. Duis non enim venenatis, vulputate felis eu, lacinia dui. Ut placerat ante turpis, at tempus ipsum gravida sit amet. Pellentesque vitae sodales eros. Praesent volutpat arcu in purus consequat, id sagittis lorem euismod. Aenean porta pellentesque dui non auctor.', 'mens', 'Running', '12', '3000', 'blue', '../images/php-uploads/shoes/mens/reebok-running-reebok_crossfit_nano_8_flexweave.png', '2018-04-17 09:37:18'),
(19, 3, 'Reebok Speed', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla. Nulla facilisi. Fusce sollicitudin sem rutrum sapien placerat tempus. Duis non enim venenatis, vulputate felis eu, lacinia dui. Ut placerat ante turpis, at tempus ipsum gravida sit amet. Pellentesque vitae sodales eros. Praesent volutpat arcu in purus consequat, id sagittis lorem euismod. Aenean porta pellentesque dui non auctor.', 'mens', 'Running', '13', '4300', 'red', '../images/php-uploads/shoes/mens/reebok-running-reebok_speed.png', '2018-04-17 09:37:45'),
(20, 3, 'Reebok Twistform', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla. Nulla facilisi. Fusce sollicitudin sem rutrum sapien placerat tempus. Duis non enim venenatis, vulputate felis eu, lacinia dui. Ut placerat ante turpis, at tempus ipsum gravida sit amet. Pellentesque vitae sodales eros. Praesent volutpat arcu in purus consequat, id sagittis lorem euismod. Aenean porta pellentesque dui non auctor.', 'mens', 'Running', '13', '2799', 'blue', '../images/php-uploads/shoes/mens/reebok-running-reebok_twistform.png', '2018-04-17 09:39:10'),
(21, 3, 'Reebok Classic Leather', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla. Nulla facilisi. Fusce sollicitudin sem rutrum sapien placerat tempus. Duis non enim venenatis, vulputate felis eu, lacinia dui. Ut placerat ante turpis, at tempus ipsum gravida sit amet. Pellentesque vitae sodales eros. Praesent volutpat arcu in purus consequat, id sagittis lorem euismod. Aenean porta pellentesque dui non auctor.', 'womens', 'Casual', '10', '5000', 'orange', '../images/php-uploads/shoes/womens/reebok-casual-reebok_classic_leather.png', '2018-04-17 09:41:34'),
(22, 3, 'Reebok Speed', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla. Nulla facilisi. Fusce sollicitudin sem rutrum sapien placerat tempus. Duis non enim venenatis, vulputate felis eu, lacinia dui. Ut placerat ante turpis, at tempus ipsum gravida sit amet. Pellentesque vitae sodales eros. Praesent volutpat arcu in purus consequat, id sagittis lorem euismod. Aenean porta pellentesque dui non auctor.', 'womens', 'Running', '7', '4300', 'gray', '../images/php-uploads/shoes/womens/reebok-running-reebok_speed.png', '2018-04-17 09:42:43'),
(23, 4, 'New Balance 501 Classic', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla. Nulla facilisi. Fusce sollicitudin sem rutrum sapien placerat tempus', 'mens', 'Sneakers', '10', '3999', 'gray', '../images/php-uploads/shoes/mens/new_balance-sneakers-new_balance_501_classic.png', '2018-04-17 10:00:44'),
(24, 4, 'New Balance 990', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla. Nulla facilisi. Fusce sollicitudin sem rutrum sapien placerat tempus', 'mens', 'Running', '11', '4200', 'gray', '../images/php-uploads/shoes/mens/new_balance-running-new_balance_990.png', '2018-04-17 10:02:41'),
(25, 4, 'New Balance FF Zarte', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla. Nulla facilisi. Fusce sollicitudin sem rutrum sapien placerat tempus', 'mens', 'Running', '12', '2500', 'orange', '../images/php-uploads/shoes/mens/new_balance-running-new_balance_ff_zarte.png', '2018-04-17 10:04:40'),
(26, 4, 'New Balance 501 Kids', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla. Nulla facilisi. Fusce sollicitudin sem rutrum sapien placerat tempus', 'womens', 'Sneakers', '6', '1400', 'violet', '../images/php-uploads/shoes/womens/new_balance-sneakers-new_balance_501_kids.png', '2018-04-17 10:05:26'),
(27, 4, 'New Balance 696 Classic', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla. Nulla facilisi. Fusce sollicitudin sem rutrum sapien placerat tempus', 'womens', 'Running', '9', '2800', 'black', '../images/php-uploads/shoes/womens/new_balance-running-new_balance_696_classic.png', '2018-04-17 10:06:20'),
(28, 4, 'New Balance 999 CML', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla. Nulla facilisi. Fusce sollicitudin sem rutrum sapien placerat tempus', 'womens', 'Sneakers', '11', '4999', 'orange', '../images/php-uploads/shoes/womens/new_balance-sneakers-new_balance_999_cml.png', '2018-04-17 10:07:04'),
(29, 4, 'New Balance Fresh Cruz', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla. Nulla facilisi. Fusce sollicitudin sem rutrum sapien placerat tempus', 'womens', 'Sneakers', '9', '3700', 'black', '../images/php-uploads/shoes/womens/new_balance-sneakers-new_balance_fresh_cruz.png', '2018-04-17 10:07:44'),
(30, 4, 'New Balance Runners', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla. Nulla facilisi. Fusce sollicitudin sem rutrum sapien placerat tempus', 'womens', 'Running', '9', '1299', 'violet', '../images/php-uploads/shoes/womens/new_balance-running-new_balance_runners.png', '2018-04-17 10:09:41'),
(31, 5, 'Vans Lo Suede', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla. Nulla facilisi. Fusce sollicitudin sem rutrum sapien placerat tempus', 'mens', 'Casual', '12', '3500', 'black', '../images/php-uploads/shoes/mens/vans-casual-vans_lo_suede.png', '2018-04-17 10:11:21'),
(32, 5, 'Vans SK8-Hi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla. Nulla facilisi. Fusce sollicitudin sem rutrum sapien placerat tempus', 'mens', 'Sneakers', '13', '4500', 'black', '../images/php-uploads/shoes/mens/vans-sneakers-vans_sk8-hi.png', '2018-04-17 10:12:03'),
(33, 5, 'Vans Ward Lo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla. Nulla facilisi. Fusce sollicitudin sem rutrum sapien placerat tempus', 'womens', 'Sneakers', '9', '3000', 'violet', '../images/php-uploads/shoes/womens/vans-sneakers-vans_ward_lo.png', '2018-04-17 10:12:39'),
(34, 5, 'Vans Asher Chambray', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla. Nulla facilisi. Fusce sollicitudin sem rutrum sapien placerat tempus', 'womens', 'Casual', '7', '2900', 'gray', '../images/php-uploads/shoes/womens/vans-casual-vans_asher_chambray.png', '2018-04-17 10:13:48'),
(35, 6, 'Gucci Lyst', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla.', 'womens', 'Formal', '9', '6000', 'black', '../images/php-uploads/shoes/womens/gucci-formal-gucci_lyst.png', '2018-04-17 12:18:46'),
(36, 6, 'Gucci Marmount Sandals', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla.', 'womens', 'Formal', '8', '8500', 'red', '../images/php-uploads/shoes/womens/gucci-formal-gucci_marmount_sandals.png', '2018-04-17 12:19:23'),
(37, 6, 'Gucci Ace (Leather)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla.', 'womens', 'Casual', '10', '5999', 'white', '../images/php-uploads/shoes/womens/gucci-casual-gucci_ace_(leather).png', '2018-04-17 12:20:17'),
(38, 7, 'Converse Chuck Taylor Hi (Black)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla.', 'mens', 'Sneakers', '12', '4500', 'black', '../images/php-uploads/shoes/mens/converse-sneakers-converse_chuck_taylor_hi_(black).png', '2018-04-17 12:23:27'),
(39, 7, 'Converse Chuck Taylor Hi (Red)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla.', 'mens', 'Sneakers', '12', '4500', 'white', '../images/php-uploads/shoes/mens/converse-sneakers-converse_chuck_taylor_hi_(red).png', '2018-04-17 12:23:36'),
(40, 7, 'Converse Chuck Taylor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla.', 'mens', 'Sneakers', '10', '4200', 'green', '../images/php-uploads/shoes/mens/converse-sneakers-converse_chuck_taylor.png', '2018-04-17 12:24:20'),
(41, 7, 'Converse Chuck Taylor Allstars', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla.', 'womens', 'Sneakers', '7', '4300', 'black', '../images/php-uploads/shoes/womens/converse-sneakers-converse_chuck_taylor_allstars.png', '2018-04-17 12:25:05'),
(42, 7, 'Converse Chuck Taylor Hi (White)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut cursus massa eget purus hendrerit lacinia. Suspendisse potenti. Phasellus feugiat elementum nunc, et feugiat odio consequat et. Pellentesque et mauris nec mi tincidunt consectetur. Nunc tempor mauris et dui sagittis vehicula. Praesent a ullamcorper justo, ac imperdiet nulla.', 'womens', 'Sneakers', '9', '4500', 'white', '../images/php-uploads/shoes/womens/converse-sneakers-converse_chuck_taylor_hi_(white).png', '2018-04-17 12:25:32'),
(43, 2, 'Adidas NMD R1', 'Born from an inspired past, made for the future, adidas Originals presents the NMD in adidas Primeknit.', 'mens', 'Sneakers', '12', '8700', 'black', '../images/php-uploads/shoes/mens/adidas-sneakers-adidas_nmd_r1.png', '2018-04-17 12:28:10'),
(44, 2, 'Adidas NMD XR1', 'Blending heritage with innovation, the NMD XR1 includes a fresh, running-inspired design that will propel you into crisp style and outstanding performance.', 'mens', 'Sneakers', '10', '7250', 'black', '../images/php-uploads/shoes/mens/adidas-sneakers-adidas_nmd_xr1.png', '2018-04-17 12:29:25'),
(45, 2, 'Adidas Prophere', 'The Adidas Originals Prophere launches the next era of streetwear with an unexpected look fueled by a strong adidas identity. Enhanced by raw edge details and embroidery, they feature a knit upper with small pops of color to create a melange effect.', 'mens', 'Sneakers', '13', '6200', 'black', '../images/php-uploads/shoes/mens/adidas-sneakers-adidas_prophere.png', '2018-04-17 12:30:34'),
(46, 2, 'Adidas Stan Smith', 'Adidas Originals&#39; Stan Smith has been an icon throughout the years, but now it gets a brand new Primeknit upper. It is low-profile and extremely breathable.', 'mens', 'Casual', '11', '4400', 'white', '../images/php-uploads/shoes/mens/adidas-casual-adidas_stan_smith.png', '2018-04-17 12:31:54'),
(47, 2, 'Adidas Yeezy Boost', 'THE YEEZY BOOST 350 V2 FEATURES A BLACK  UPPER WITH CONTRAST RED LETTERS BEARING A MIRRORED ‘SPLY-350’ MARK, DISTINCT CENTER STITCHING, AND A HEEL TAB. A SEMI-TRANSLUCENT OUTSOLE AND TPU SIDEWALLS CREATE A STRIKING EFFECT WHILE PROVIDING SUPERIOR TRACTION, WHILE THE YEEZY BOOST 350 V2 MIDSOLE UTILIZES ADIDAS’ INNOVATIVE BOOST™ TECHNOLOGY TO CREATE A DURABLE, SHOCK-RESISTANT, RESPONSIVE SOLE.', 'mens', 'Sneakers', '14', '9000', 'black', '../images/php-uploads/shoes/mens/adidas-sneakers-adidas_yeezy_boost.png', '2018-04-17 12:34:58'),
(48, 2, 'Adidas Yeezy Boost V2', 'THE YEEZY BOOST 350 V2 FEATURES A TINTED BLUE UPPER WITH CONTRAST RED LETTERS BEARING A MIRRORED ‘SPLY-350’ MARK, DISTINCT CENTER STITCHING, AND A HEEL TAB. A SEMI-TRANSLUCENT OUTSOLE AND TPU SIDEWALLS CREATE A STRIKING EFFECT WHILE PROVIDING SUPERIOR TRACTION, WHILE THE YEEZY BOOST 350 V2 MIDSOLE UTILIZES ADIDAS’ INNOVATIVE BOOST™ TECHNOLOGY TO CREATE A DURABLE, SHOCK-RESISTANT, RESPONSIVE SOLE.', 'mens', 'Sneakers', '13', '9100', 'white', '../images/php-uploads/shoes/mens/adidas-sneakers-adidas_yeezy_boost_v2.png', '2018-04-17 12:35:29'),
(49, 2, 'Adidas NMD R1 STLT', 'Blending heritage with innovation, the NMD R1 includes a fresh, running-inspired design that will propel you into crisp style and outstanding performance.', 'womens', 'Sneakers', '10', '7300', 'red', '../images/php-uploads/shoes/womens/adidas-sneakers-adidas_nmd_r1_stlt.png', '2018-04-17 12:36:46'),
(50, 2, 'Adidas Superstar', 'Generation after generation, the adidas Originals Superstar lives as a style icon. The first Superstar debuted in 1969 as a basketball shoe, but quickly became a statement kick for the streets. Today’s Superstar is a perfect representation of the iconic style everybody loves. It features a smooth, leather and or textile upper for enhanced durability, and is finished off with the iconic 3-Stripes for style and shell toe for protection. The official Originals emblem on the tongue polishes the look and gives it a vintage vibe everyone loves. Inside, there’s breathable mesh lining for ultimate breathability, as well as a padded heel collar for increased comfort.  At the bottom, you’ll find a rubber outsole in a herringbone pattern for superior traction and durability.', 'womens', 'Casual', '9', '4200', 'white', '../images/php-uploads/shoes/womens/adidas-casual-adidas_superstar.png', '2018-04-17 12:37:50');

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
(1, 'Admin', 'logandylan37', '5C06EB3D5A05A19F49476D694CA81A36344660E9D5B98E3D6A6630F31C2422E7'),
(2, 'Brand', 'nikephilippines', '041BC667C02B01AE6B3C4DB08CF4D904B0DEBBF73EE74E7CC2DA890AB0F718BB'),
(3, 'Brand', 'adidasofficialph', 'D207E70CD6DE2F72823F9CB381C4693E8C00DDA81EE5DED2349755530DA9F80D'),
(4, 'Brand', 'reebok_ph', '6D1BA1FC9150934CBA2C02CA006070F865D808BD422668835A94828018A19905'),
(5, 'Brand', 'newbalanceph', 'BD79CE2E53AE7EB36EE8F5055C3042A637338E3C319A8A72D4FBD3D709620812'),
(6, 'Brand', 'vansofficialph', '3685BF34FFCF2776799DFC38769330F9928508672A0AEB60AF15BD49F901C22D'),
(7, 'Brand', 'guccishoes', 'BBC620549F120D673EC9CD516EB9352CA381B36403F582068925A46B46F34153'),
(8, 'Brand', 'converseph', '442769274DF734F72902ADC4659AB90B7F1D09B9252914AB4E05D9158A013E23'),
(9, 'Brand', 'filaphilippines', '50139FE31EC4047210FB7731FE2E9DC63AA208DA3547F6C1FF2D78E20E547028');

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
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `brand_contact_number`
--
ALTER TABLE `brand_contact_number`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `brand_link`
--
ALTER TABLE `brand_link`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `brand_location`
--
ALTER TABLE `brand_location`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shoes`
--
ALTER TABLE `shoes`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `shoe_ratings`
--
ALTER TABLE `shoe_ratings`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_users`
--
ALTER TABLE `site_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
