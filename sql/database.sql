--
-- Table structure for table `users`
--

-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2016 at 06:50 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `N00145905`
--

-- --------------------------------------------------------

--
-- Table structure for table `branchwebp`
--

CREATE TABLE IF NOT EXISTS `branchwebp` (
  `branchNo` int(11) NOT NULL,
  `branchName` varchar(40) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phoneNo` varchar(10) NOT NULL,
  `openHours` enum('8 to 4','8 to 6','9 to 4','9 to 6','10 to 6','10 to 8') NOT NULL DEFAULT '9 to 6',
  `openDate` date DEFAULT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branchwebp`
--

INSERT INTO `branchwebp` (`branchNo`, `branchName`, `address`, `phoneNo`, `openHours`, `openDate`, `createdDate`) VALUES
(1, 'Raheny', '12 Main st                                                                                                                       ', '123-456789', '10 to 6', '2015-12-12', '2015-11-01 02:31:02'),
(2, 'Finglas', '3 Chalestown sc d11', '123-456789', '10 to 6', '2009-02-12', '2015-11-03 20:47:54'),
(3, 'Galway', 'Earl Square Galway', '021-342111', '10 to 8', '0000-00-00', '2015-11-18 18:54:31'),
(4, 'Cork', 'Cork City', '123-123123', '8 to 6', '2015-12-12', '2015-11-20 22:10:06'),
(5, 'john', 'main vill', '123-456789', '8 to 6', '2015-12-12', '2015-11-23 11:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `customerStockwebp`
--

CREATE TABLE IF NOT EXISTS `customerStockwebp` (
  `custStockId` int(11) NOT NULL,
  `customerNo` int(11) NOT NULL,
  `stockId` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customerStockwebp`
--



-- --------------------------------------------------------

--
-- Table structure for table `customerwebp`
--

CREATE TABLE IF NOT EXISTS `customerwebp` (
  `customerNo` int(11) NOT NULL,
  `branchNo` int(11) NOT NULL,
  `fName` varchar(50) NOT NULL,
  `lName` varchar(50) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `address` varchar(300) NOT NULL,
  `email` varchar(256) NOT NULL,
  `mobileNo` varchar(10) DEFAULT NULL,
  `openDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customerwebp`
--

-- --------------------------------------------------------

--
-- Table structure for table `stockwebp`
--

CREATE TABLE IF NOT EXISTS `stockwebp` (
  `stockId` int(11) NOT NULL,
  `stockName` varchar(255) NOT NULL,
  `stockCode` varchar(5) NOT NULL,
  `qty` int(11) NOT NULL,
  `openPrice` decimal(11,2) NOT NULL,
  `currentPrice` decimal(11,2) NOT NULL,
  `image` varchar(700) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockwebp`
--

INSERT INTO `stockwebp` (`stockId`, `stockName`, `stockCode`, `qty`, `openPrice`, `currentPrice`, `image`) VALUES
(1, 'Apple', 'AAPL', 10000000, '116.60', '100.00', 'apple.png'),
(2, 'Nike Ltd', 'NKE', 2041652, '90.69', '294.67', 'nike.png'),
(13, 'Liberty Media', 'LMCA', 754527452, '41.03', '45.75', 'upc.png'),
(14, 'Delta Airlines', 'DAL', 25285256, '49.99', '54.98', ''),
(15, 'Manchester United', 'MANU', 22521528, '18.16', '23.07', 'manutd.png'),
(16, 'Samsung Electronics', 'SSNLF', 52252511, '1100.00', '397.35', 'samsung.png'),
(17, 'Facebook Inc', 'FB', 24524581, '108.94', '18.09', 'facebook.png'),
(18, 'Yahoo! Inc.', 'YHOO', 8522524, '33.41', '28.23', 'yahoo.png'),
(19, 'Autodesk ', 'ADSK', 21515041, '62.12', '6.01', 'autodesk.png'),
(20, 'Virgin America Inc.', 'VA', 51245511, '36.98', '28.53', 'virgin.png'),
(21, 'Microsoft Corp.', 'MSFT', 1825644, '53.65', '120.02', 'microsoft.png'),
(22, 'MBNA', 'OSNDF', 15228248, '3.97', '109.58', 'mbna.png'),
(23, 'google', 'ggl', 431345332, '123.45', '2.34', 'google.png'),
(24, 'Adidas', 'AD', 124643225, '124.44', '3.56', 'adidas.png');


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'joe@bloggs.com', 'secret', 'admin'),
(2, 'mary@bloggs.com', 'secret', 'staff'),
(3, 'fred@bloggs.com', 'secret', 'hr'),
(4, 'john', 'secret', 'hr'),


--
-- Indexes for dumped tables
--


--
-- Indexes for table `branchwebp`
--
ALTER TABLE `branchwebp`
  ADD PRIMARY KEY (`branchNo`),
  ADD KEY `name` (`branchName`);


--
-- Indexes for table `customerStockwebp`
--
ALTER TABLE `customerStockwebp`
  ADD PRIMARY KEY (`custStockId`);

--
-- Indexes for table `customerwebp`
--
ALTER TABLE `customerwebp`
  ADD PRIMARY KEY (`customerNo`),
  ADD KEY `branchNo` (`branchNo`);

--
-- Indexes for table `stockwebp`
--
ALTER TABLE `stockwebp`
  ADD PRIMARY KEY (`stockId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branchwebp`
--
ALTER TABLE `branchwebp`
  MODIFY `branchNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customerStockwebp`
--
ALTER TABLE `customerStockwebp`
  MODIFY `custStockId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `customerwebp`
--
ALTER TABLE `customerwebp`
  MODIFY `customerNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `fucuation`
--
--
-- AUTO_INCREMENT for table `stockwebp`
--
ALTER TABLE `stockwebp`
  MODIFY `stockId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
