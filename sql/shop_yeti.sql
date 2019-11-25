-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 10, 2018 at 03:58 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_yeti`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `Car_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Mem_ID` int(11) NOT NULL,
  `Pro_ID` int(11) NOT NULL,
  `Car_Amount` int(11) NOT NULL,
  PRIMARY KEY (`Car_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `count_page`
--

DROP TABLE IF EXISTS `count_page`;
CREATE TABLE IF NOT EXISTS `count_page` (
  `Cou_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Cou_IP` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Cou_Date` date NOT NULL,
  PRIMARY KEY (`Cou_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `count_page`
--

INSERT INTO `count_page` (`Cou_ID`, `Cou_IP`, `Cou_Date`) VALUES
(1, '::1', '2018-09-09'),
(2, '::1', '2018-09-09'),
(3, '::1', '2018-09-09'),
(4, '::1', '2018-09-09'),
(5, '::1', '2018-09-09'),
(6, '::1', '2018-09-09');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `Mem_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Mem_User` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Mem_Pass` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Mem_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Mem_Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Mem_Tel` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Mem_Address` text COLLATE utf8_unicode_ci NOT NULL,
  `Mem_Date` date NOT NULL,
  `Mem_Permission` int(11) NOT NULL COMMENT '1 = ใช้งาน 2 = ยกเลิก',
  `Mem_Status` int(11) NOT NULL COMMENT '1 = admin 2 = user',
  PRIMARY KEY (`Mem_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`Mem_ID`, `Mem_User`, `Mem_Pass`, `Mem_Name`, `Mem_Email`, `Mem_Tel`, `Mem_Address`, `Mem_Date`, `Mem_Permission`, `Mem_Status`) VALUES
(1, 'admin', '1234', 'administrator', 'biglovemo@hotmail.com', '', '', '2017-03-11', 1, 1),
(5, 'topza', 'topza1412', 'aa bb ', 'topza1412@gmail.com', '0814567899', '34/567', '2017-03-19', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `Ord_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ord_Number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Mem_ID` int(11) NOT NULL,
  `Ord_Note` text COLLATE utf8_unicode_ci NOT NULL,
  `Ord_AddressSend` text COLLATE utf8_unicode_ci NOT NULL,
  `Ord_Shipping` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `Ord_AmountTotal` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Ord_PriceTotal` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Ord_DateShipping` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Ord_NumberShipping` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Ord_DateBuy` date NOT NULL,
  `Ord_Status` int(11) NOT NULL COMMENT '0 = รอชำระเงิน 1= ตรวจสอบชำระเงิน 2 = ชำระเงินเรียบร้อย 3 = จัดส่งเรียบร้อย 4 = ยกเลิกรายการ',
  PRIMARY KEY (`Ord_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE IF NOT EXISTS `order_detail` (
  `Odd_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ord_ID` int(11) NOT NULL,
  `Pro_ID` int(11) NOT NULL,
  `Odd_Amount` int(11) NOT NULL,
  PRIMARY KEY (`Odd_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `Pay_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ord_ID` int(11) NOT NULL,
  `Pay_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Pay_Tel` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Pay_File` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Pay_Price` double(9,2) NOT NULL,
  `Pay_Bank` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Pay_Detail` text COLLATE utf8_unicode_ci NOT NULL,
  `Pay_Date` date NOT NULL,
  `Pay_Time` time NOT NULL,
  `Pay_Status` int(11) NOT NULL COMMENT '0 = ตรวจสอบ1 = ชำระเรียบร้อย',
  PRIMARY KEY (`Pay_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `Pro_ID` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `Pro_Img` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Pro_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Pro_Detail` text COLLATE utf8_unicode_ci NOT NULL,
  `Pro_Price` double(7,2) NOT NULL,
  `Pro_Amount` int(11) NOT NULL,
  `Pro_Buy` int(11) NOT NULL,
  `Pro_Date` date NOT NULL,
  PRIMARY KEY (`Pro_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Pro_ID`, `Pro_Img`, `Pro_Name`, `Pro_Detail`, `Pro_Price`, `Pro_Amount`, `Pro_Buy`, `Pro_Date`) VALUES
(000002, '1.png', 'แก้ว Yeti 1', 'แก้ว Yeti 1', 180.00, 10, 1, '2018-09-09'),
(000003, '2.png', 'แก้ว Yeti 2', 'แก้ว Yeti 2', 230.00, 4, 2, '2018-09-09'),
(000004, '3.png', 'แก้ว Yeti 3', 'แก้ว Yeti 3', 210.00, 1, 1, '2018-09-09'),
(000005, '4.png', 'แก้ว Yeti 4', 'แก้ว Yeti 4', 190.00, 3, 0, '2018-09-09'),
(000006, '5.png', 'แก้ว Yeti 5', 'แก้ว Yeti 5', 250.00, 3, 0, '2018-09-09');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
