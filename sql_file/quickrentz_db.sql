-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2023 at 01:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quickrentz_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `PhoneNumber` int(13) NOT NULL,
  `Address` varchar(199) NOT NULL,
  `AdminUsername` varchar(50) NOT NULL,
  `Email` varchar(199) NOT NULL,
  `Password` varchar(199) NOT NULL,
  `Photo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `FirstName`, `LastName`, `PhoneNumber`, `Address`, `AdminUsername`, `Email`, `Password`, `Photo`) VALUES
(1, 'Don Allen', 'Veloso', 912323232, 'Poblacion MAribojoc, Bohol, Ph', 'Admin_Yongski', 'admin@admin.com', 'admin', '262172437_2017241288473396_2537272664894478501_n.jpg'),
(3, 'Jeremiah Angelo', 'Neri', 2147483647, 'Quezon City', 'jeremiahneri', 'admin_jeremiahneri@admin.com', 'admin_jeremiahneri', '381071066_990375145403384_3132189997954132368_n.jpg'),
(4, 'Gabriel Jonathan', 'Mataya', 2147483647, 'Mandaluyong', 'Dose0719', 'admin_Dose0719@admin.com', 'admin_Dose0719', '379669676_638971825038933_8724536753515732786_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `BrandID` int(11) NOT NULL,
  `brandName` text NOT NULL,
  `brandLogo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`BrandID`, `brandName`, `brandLogo`) VALUES
(10, 'Toyota', 1695658106),
(11, 'Nissan', 1695659017),
(12, 'Ford', 1695659148),
(13, 'Honda', 1695659236),
(14, 'Isuzu', 1695659326),
(15, 'Hyundai', 1695659616),
(16, 'Chevrolet', 1695659758),
(17, 'Mazda', 1695659821),
(18, 'Mitsubishi', 1695659902);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `ReservationID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `VehicleID` int(11) NOT NULL,
  `Pickup` date NOT NULL,
  `Return` date NOT NULL,
  `Message` text NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`ReservationID`, `UserID`, `VehicleID`, `Pickup`, `Return`, `Message`, `Status`) VALUES
(17, 22, 54, '2023-09-28', '2023-09-29', 'Hi', 'Not yet Confirmed'),
(19, 27, 53, '2023-09-12', '2023-09-27', 'pa rent.', 'Booking Confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(11) NOT NULL,
  `FirstName` text NOT NULL,
  `LastName` text NOT NULL,
  `PhoneNumber` int(12) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(11) NOT NULL,
  `Status` text NOT NULL,
  `Photo` varchar(50) NOT NULL,
  `AccCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `FrontID` varchar(50) NOT NULL,
  `BackID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `FirstName`, `LastName`, `PhoneNumber`, `Address`, `Email`, `Password`, `Status`, `Photo`, `AccCreated`, `FrontID`, `BackID`) VALUES
(20, 'testrun123', 'test', 'run', 915846232, 'tagb', 'tesstsaw@gmail.com', '1233', 'Account Verified', '1695645574_hUZqnd7coR.png', '2023-09-25 19:56:41', '1695651126_nVp6tWIamg.jpg', '1695651126_nDeTaKymqH.jpg'),
(21, 'timedate', 'testdate', 'time', 915846384, 'tagb', 'timedate@gmail.com', '123', 'Account Rejected', 'avatar1.png', '2023-09-25 19:59:17', '', ''),
(22, 'unigah', 'testuuu', 'yongi', 122321434, 'purok 1, anislag', 'allen21@gmail.com', '123', 'Account Rejected', 'avatar1.png', '2023-09-25 22:18:01', '1695653702_CXVjmhrHzL.jpg', '1695653702_sX9F1ehU50.jpg'),
(23, 'testing123', 'test', 'onetwo', 915846384, 'tagb', 'testing123@gmail.com', 'testing123', 'Account Verified', '1695655706_jhDIe28QEa.png', '2023-09-25 23:27:54', '1695655759_jgW8XL14CI.jpg', '1695655759_CR8DVkzuFB.jpg'),
(24, 'jeremiah17', 'Jeremiah', 'Neri', 912345678, 'quezon city', 'jeremiahangelo.neri@gmail.com', 'ytrewq321', 'Not Yet Verified', 'avatar1.png', '2023-09-26 00:13:43', '', ''),
(25, 'allen_admin', 'allen', 'Veloso', 915846384, 'tagb', 'allen@gmail.com', '123', 'Not Yet Verified', 'avatar1.png', '2023-09-26 02:14:53', '', ''),
(26, 'testaccount', 'test', 'account', 2147483647, 'amaerica city bohol', 'test@gmail.com', '123', 'Account Rejected', 'avatar1.png', '2023-09-27 01:47:43', '', ''),
(27, 'raymartrosa', 'raymart', 'rosali', 1234456789, 'metro manila', 'raymartrosali@gmail.com', 'qwerty123', 'Not Yet Verified', 'avatar1.png', '2023-09-27 12:21:37', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `VehicleID` int(11) NOT NULL,
  `BrandID` int(11) NOT NULL,
  `Model` varchar(50) NOT NULL,
  `Year` year(4) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `FuelType` varchar(50) NOT NULL,
  `Transmision` varchar(50) NOT NULL,
  `Mileage` varchar(50) NOT NULL,
  `SeatingCapacity` int(11) NOT NULL,
  `Rate` int(11) NOT NULL,
  `Image1` varchar(60) NOT NULL,
  `Image2` varchar(60) NOT NULL,
  `Image3` varchar(60) NOT NULL,
  `Image4` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`VehicleID`, `BrandID`, `Model`, `Year`, `Type`, `FuelType`, `Transmision`, `Mileage`, `SeatingCapacity`, `Rate`, `Image1`, `Image2`, `Image3`, `Image4`) VALUES
(53, 10, 'Fortuner', '2023', 'SUV', 'Diesel', 'Automatic', '5,000', 8, 7000, '1695658171_4qpGIeoATk.png', '1695658171_UyzrBPena1.png', '1695658171_2r6GDtp4Uu.png', '1695658171_a1LN3xneI4.'),
(54, 11, 'Sentra', '2023', 'Sedan', 'Petrol', 'Automatic', '2,000', 4, 3000, '1695659060_VFB8OMyUPo.png', '1695659060_DfSyzp84Tm.png', '1695659060_RyTDUCKb3i.png', '1695659060_inb4WxuET7.'),
(56, 13, 'Civic', '2023', 'Sedan', 'Petrol', 'Manual', '2,500', 4, 4000, '1695659285_ClpMGruO7U.png', '1695659285_Pxb6DVHmAY.png', '1695659285_IlxUXsgG2Z.png', '1695659285_gG8uifJ6zx.'),
(57, 14, 'MU-X', '2022', 'SUV', 'Diesel', 'Automatic', '4000', 8, 4500, '1695659383_bzaA7k5US2.png', '1695659383_02xWJbSHcE.png', '1695659383_jcN50xs1IC.png', '1695659383_a6XwNjGWqp.'),
(58, 15, 'Elantra', '2023', 'Sedan', 'Petrol', 'Automatic', '5000', 4, 4700, '1695659667_nCd7HEAwrP.png', '1695659667_nqRKbvOuFp.png', '1695659667_rlEL5TpYsw.png', '1695659667_WQVpE17dX4.'),
(59, 16, 'Trailblazer', '2023', 'SUV', 'Petrol', 'Automatic', '1500', 8, 6000, '1695659792_LzWwZuGRSy.png', '1695659792_9DRT1oqHny.png', '1695659792_9bYPv4dWGo.png', '1695659792_wHNKJA5VcG.'),
(60, 17, 'CX-5', '2023', 'SUV', 'Petrol', 'Automatic', '3500', 6, 4300, '1695659867_rGte1fMYlB.png', '1695659867_A8tMos3Ydc.png', '1695659867_N5yGV4RslH.png', '1695659867_5FlLxOQK93.'),
(61, 18, 'Montero', '2023', 'SUV', 'Petrol', 'Automatic', '3200', 8, 5500, '1695660070_Vo8MwSLjPp.png', '1695660070_Y6swirUa7m.png', '1695660070_aRc75gZpxH.png', '1695660070_iUaH70cRS5.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`BrandID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`ReservationID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`VehicleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `BrandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `VehicleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
