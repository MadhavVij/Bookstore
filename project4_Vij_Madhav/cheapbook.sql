-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2016 at 12:41 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cheapbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `ssn` int(9) NOT NULL,
  `name` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`ssn`, `name`, `address`, `phone`) VALUES
(760019184, 'Prasoon Kumar', '1206 Peppermill Circle, Apt #46, Arlington, TX-76013', '7683534117'),
(760097689, 'Shail Chokshi', '417 Summit Avn, Arlington, TX-76013', '6362599151'),
(760150087, 'Rushabh Mehta', '312 UTA BLVD, Arlington, TX-76013', '7603134004'),
(760181313, 'Madhav Vij', '1206 Peppermill Circle, Apt #46, Arlington, TX-76013', '5187097855');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `isbn` varchar(20) NOT NULL,
  `title` varchar(30) NOT NULL,
  `year` year(4) NOT NULL,
  `price` float NOT NULL,
  `publisher` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`isbn`, `title`, `year`, `price`, `publisher`) VALUES
('711-9-13-769032-3', 'Fundamentalism', 2016, 7, 'David Beckham'),
('786-2-20-668772-1', 'The Positive thinking', 2007, 8.33, 'Simon & Schuster'),
('888-3-23-769882-0', 'Java Complete Reference', 2009, 19.99, 'McGraw-Hill'),
('978-3-16-148410-0', 'The Alchemist', 2013, 119.99, 'HarperCollins');

-- --------------------------------------------------------

--
-- Table structure for table `contains`
--

CREATE TABLE `contains` (
  `isbn` varchar(20) NOT NULL,
  `basketid` varchar(20) NOT NULL,
  `number` int(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contains`
--

INSERT INTO `contains` (`isbn`, `basketid`, `number`) VALUES
('978-3-16-148410-0', '583f5ad2035eb', 2),
('978-3-16-148410-0', '583f5b1e10beb', 2),
('978-3-16-148410-0', '583f5b83555c1', 2),
('711-9-13-769032-3', '583f5d789e236', 2),
('786-2-20-668772-1', '583f5d789e236', 3),
('978-3-16-148410-0', '583f5f23eff37', 1),
('786-2-20-668772-1', '583f5f6cbc2c3', 4),
('786-2-20-668772-1', '583f5fb817568', 1),
('786-2-20-668772-1', '583f5ff147458', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `username` varchar(20) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`username`, `password`, `address`, `phone`, `email`) VALUES
('madhav', '37389d0b25723738752fe8432830ae63', '1206 Peppermill Circle\r\nApt 46', '5187097855', 'madhav.vij@mavs.uta.edu'),
('madhav1', '37389d0b25723738752fe8432830ae63', '1206 Peppermill Circle\r\nApt 46', '5187097855', 'madhav1.vij@uta.edu'),
('test1', '5d9c68c6c50ed3d02a2fcf54f63993b6', 'hew 7267832 njkn ', '8798987212', 'test@test.com'),
('test2', '34507ff4ac691a66bcfe8a409fff514a', '219, Sector 8\r\nUrban Estate', '8570874123', 'test2@test.com');

-- --------------------------------------------------------

--
-- Table structure for table `shippingorder`
--

CREATE TABLE `shippingorder` (
  `isbn` varchar(20) NOT NULL,
  `warehouseCode` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `number` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shippingorder`
--

INSERT INTO `shippingorder` (`isbn`, `warehouseCode`, `username`, `number`) VALUES
('711-9-13-769032-3', 'bcjhw_hhyt55678', 'madhav', 2),
('786-2-20-668772-1', 'bdhjr_fdiw65790', 'madhav', 3),
('978-3-16-148410-0', 'bdhjr_fdiw65790', 'madhav', 2);

-- --------------------------------------------------------

--
-- Table structure for table `shoppingbasket`
--

CREATE TABLE `shoppingbasket` (
  `basketID` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shoppingbasket`
--

INSERT INTO `shoppingbasket` (`basketID`, `username`) VALUES
('583e0537e0832', 'madhav'),
('583f5ad2035eb', 'madhav'),
('583f5b1e10beb', 'madhav'),
('583f5b83555c1', 'madhav'),
('583f5d789e236', 'madhav'),
('583f5f23eff37', 'madhav'),
('583f5f6cbc2c3', 'madhav'),
('583f5fb817568', 'madhav'),
('583f5ff147458', 'madhav'),
('583f61def2a30', 'madhav1'),
('583f631b575f7', 'test1'),
('583f636f0ae1b', 'test2');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `isbn` varchar(20) NOT NULL,
  `warehouseCode` varchar(50) NOT NULL,
  `number` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`isbn`, `warehouseCode`, `number`) VALUES
('711-9-13-769032-3', 'bcjhw_hhyt55678', 15),
('786-2-20-668772-1', 'bdhjr_fdiw65790', 51),
('888-3-23-769882-0', 'dhbcj_jdsk88322', 0),
('978-3-16-148410-0', 'bdhjr_fdiw65790', 20);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `warehouseCode` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`warehouseCode`, `name`, `address`, `phone`) VALUES
('bcjhw_hhyt55678', 'Amazon_ul', 'Celeste Slater 606-3727 Ullamcorper. Street Roseville NH 11523', '7867138616'),
('bdhjr_fdiw65790', 'Amazon_ny', 'Theodore Lowe Ap #867-859 Sit Rd. Azusa New York 39531', '7911516230'),
('dhbcj_jdsk88322', 'Amazon_dal', '743 Genoa Ave, Dallas, TX 75216', '4695527209'),
('fhssm_kjdh77881', 'Amazon_ny', 'Cecilia Chapman 711-2880 Nulla St. Mankato Mississippi 96522', '2575637401');

-- --------------------------------------------------------

--
-- Table structure for table `writtenby`
--

CREATE TABLE `writtenby` (
  `ssn` int(9) NOT NULL,
  `ISBN` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `writtenby`
--

INSERT INTO `writtenby` (`ssn`, `ISBN`) VALUES
(760019184, '711-9-13-769032-3'),
(760097689, '786-2-20-668772-1'),
(760150087, '888-3-23-769882-0'),
(760181313, '978-3-16-148410-0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`ssn`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `contains`
--
ALTER TABLE `contains`
  ADD PRIMARY KEY (`basketid`,`isbn`),
  ADD KEY `isbn_modify(book)` (`isbn`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `shippingorder`
--
ALTER TABLE `shippingorder`
  ADD PRIMARY KEY (`isbn`,`warehouseCode`,`username`),
  ADD KEY `warehouseCode_modify(shippingOrder)` (`warehouseCode`),
  ADD KEY `username_modify(shippingOrder)` (`username`);

--
-- Indexes for table `shoppingbasket`
--
ALTER TABLE `shoppingbasket`
  ADD PRIMARY KEY (`basketID`,`username`),
  ADD KEY `username_modify` (`username`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`isbn`,`warehouseCode`),
  ADD KEY `warehouseCode_modify` (`warehouseCode`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`warehouseCode`);

--
-- Indexes for table `writtenby`
--
ALTER TABLE `writtenby`
  ADD PRIMARY KEY (`ssn`,`ISBN`),
  ADD KEY `writtenby_ibfk_2` (`ISBN`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contains`
--
ALTER TABLE `contains`
  ADD CONSTRAINT `basketID_modify` FOREIGN KEY (`basketid`) REFERENCES `shoppingbasket` (`basketID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `isbn_modify(book)` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shippingorder`
--
ALTER TABLE `shippingorder`
  ADD CONSTRAINT `isbn_modify(shippingOrder)` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `username_modify(shippingOrder)` FOREIGN KEY (`username`) REFERENCES `customers` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `warehouseCode_modify(shippingOrder)` FOREIGN KEY (`warehouseCode`) REFERENCES `warehouse` (`warehouseCode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shoppingbasket`
--
ALTER TABLE `shoppingbasket`
  ADD CONSTRAINT `username_modify` FOREIGN KEY (`username`) REFERENCES `customers` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `isbn_modify` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `warehouseCode_modify` FOREIGN KEY (`warehouseCode`) REFERENCES `warehouse` (`warehouseCode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `writtenby`
--
ALTER TABLE `writtenby`
  ADD CONSTRAINT `writtenby_ibfk_1` FOREIGN KEY (`ssn`) REFERENCES `author` (`ssn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `writtenby_ibfk_2` FOREIGN KEY (`ISBN`) REFERENCES `book` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
