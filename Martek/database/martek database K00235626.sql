-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2020 at 07:38 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `martek`
--
CREATE DATABASE IF NOT EXISTS `martek` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `martek`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CartID`, `UserID`, `ProductID`) VALUES
(2, 5, 8);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `Description` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `name`, `Description`) VALUES
(1, 'Phones', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `OrderDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UserID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `UnitPrice` decimal(9,2) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Shipped` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `OrderDate`, `UserID`, `ProductID`, `UnitPrice`, `Quantity`, `Shipped`) VALUES
(2, '2020-04-08 17:35:21', 2, 5, '0.00', 1, 1),
(3, '2020-04-08 18:05:38', 2, 13, '0.00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `Description` varchar(225) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `Price` decimal(9,2) DEFAULT NULL,
  `UnitsInStock` int(11) DEFAULT NULL,
  `ProductImage` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `Description`, `categoryID`, `Price`, `UnitsInStock`, `ProductImage`) VALUES
(5, 'iphone xr', 'black 128Gb', 1, '810.00', 5, 0x58722e706e67),
(8, 'Samsung Galaxy s5', '16GB Black', 1, '149.99', 0, 0x73352e706e67),
(9, 'Samsung Galaxy s5', '16GB Black', 1, '149.99', 0, 0x73352e706e67),
(10, 'Samsung Galaxy s6', '16Gb White', 1, '200.00', 0, 0x47616c6178792073362e706e67),
(11, 'Samsung Galaxy s6', '16Gb White', 1, '200.00', 0, 0x47616c6178792073362e706e67),
(13, 'iphone 8', '265 Gb black', 1, '950.00', 4, 0x4970686f6e65382e706e67),
(14, 'Samsung Galaxy s6', '265 Gb black', 1, '800.00', 11, 0x47616c6178792073362e706e67),
(23, 'iphone x', 'black 128Gb', 1, '800.00', 4, 0x4970686f6e65582e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `products_has_reviews`
--

CREATE TABLE `products_has_reviews` (
  `Products_ProductID` int(11) NOT NULL,
  `Reviews_ReviewID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ReviewID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FirstName` varchar(45) DEFAULT NULL,
  `Surname` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `ProfilePic` blob,
  `Status` varchar(45) DEFAULT NULL,
  `Type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FirstName`, `Surname`, `username`, `Email`, `Password`, `Address`, `ProfilePic`, `Status`, `Type`) VALUES
(2, 'Mario', 'Barsoum', 'mariobarsoum59', 'mariobarsoum59@gmail.com', 'ea478a2540c809c475ec9172d583692801e6704a', '65, Beach Park', '', 'Active', '0'),
(3, 'John', 'barsoum', 'jbarsoum', 'jbarsoum@gmail.com', 'd3d0379126c1e5e0ba70ad6e5e53ff6aeab9f4fa', '6847 rosemount', '', 'Blocked', '0'),
(4, 'Local', 'Admin', 'admin', 'admin@martek.com', '10da03831ea1b58159eebd4af35e2bf4fdb88dc9', 'Localhost', '', 'Active', '1'),
(5, 'Gerry', 'Guinane', 'gerry123', 'gerry.guinane@lit.ie', '4e111b7891a92ac8f2f86190a29926157622dc45', 'Moylish Limerick', '', 'Active', '0'),
(6, 'Patrick', 'Barsoum', 'pabars', 'paddy@gmail.com', 'e0a8a5c8893ece21859446bea7653b03b6ef20f6', '10 Benguragh sq', '', 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `WishlistID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `fk_Cart_users1_idx` (`UserID`),
  ADD KEY `fk_Products_users1` (`ProductID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `fk_Orders_users_idx` (`UserID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `fk_Products_categories1_idx` (`categoryID`);

--
-- Indexes for table `products_has_reviews`
--
ALTER TABLE `products_has_reviews`
  ADD PRIMARY KEY (`Products_ProductID`,`Reviews_ReviewID`),
  ADD KEY `fk_Products_has_Reviews_Reviews1_idx` (`Reviews_ReviewID`),
  ADD KEY `fk_Products_has_Reviews_Products1_idx` (`Products_ProductID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ReviewID`),
  ADD KEY `fk_Reviews_users1_idx` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `Email_UNIQUE` (`Email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`WishlistID`),
  ADD KEY `fk_Wishlist_users1_idx` (`UserID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `WishlistID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_Cart_users1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Products_users1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_Orders_users` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_Products_categories1` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_has_reviews`
--
ALTER TABLE `products_has_reviews`
  ADD CONSTRAINT `fk_Products_has_Reviews_Products1` FOREIGN KEY (`Products_ProductID`) REFERENCES `products` (`ProductID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Products_has_Reviews_Reviews1` FOREIGN KEY (`Reviews_ReviewID`) REFERENCES `reviews` (`ReviewID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_Reviews_users1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_Wishlist_users1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
