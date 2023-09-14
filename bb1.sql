-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2023 at 09:58 AM
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
-- Database: `bloodbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `bloodstock`
--

CREATE TABLE `bloodstock` (
  `Id` int(11) NOT NULL,
  `Code` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `BloodType_Id` int(11) NOT NULL,
  `Donor_Id` int(11) DEFAULT NULL,
  `Others_Id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bloodtype`
--

CREATE TABLE `bloodtype` (
  `Id` int(11) NOT NULL,
  `BloodType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bloodtype`
--

INSERT INTO `bloodtype` (`Id`, `BloodType`) VALUES
(1, 'A+'),
(2, 'B+'),
(3, 'AB+'),
(4, 'O+'),
(5, 'A-'),
(6, 'B-'),
(7, 'AB-'),
(8, 'O-');

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `Id` int(11) NOT NULL,
  `ReqDetail_Id` int(11) NOT NULL,
  `BloodStock_Id` int(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `Id` int(11) NOT NULL,
  `Donor_req_Id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donor_req`
--

CREATE TABLE `donor_req` (
  `Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `PhNo` varchar(255) NOT NULL,
  `BloodType_Id` int(11) NOT NULL,
  `Status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `Id` int(11) NOT NULL,
  `Hospital_Id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospital_req`
--

CREATE TABLE `hospital_req` (
  `Id` int(11) NOT NULL,
  `Contact_Name` varchar(255) NOT NULL,
  `Dept` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `PhNo` varchar(255) NOT NULL,
  `Status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

CREATE TABLE `others` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `PhNo` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `BloodType_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `Id` int(11) NOT NULL,
  `Patient_Id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_req`
--

CREATE TABLE `patient_req` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `PhNo` varchar(255) NOT NULL,
  `Hospital_Name` varchar(255) NOT NULL,
  `Qty` int(11) NOT NULL,
  `BloodType_Id` int(11) NOT NULL,
  `Status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `req`
--

CREATE TABLE `req` (
  `Id` int(11) NOT NULL,
  `Patient_Req_Id` int(11) DEFAULT NULL,
  `Hospital_Req_Id` int(11) DEFAULT NULL,
  `Status` tinyint(4) NOT NULL,
  `Reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `req_detail`
--

CREATE TABLE `req_detail` (
  `Id` int(11) NOT NULL,
  `Req_Id` int(11) NOT NULL,
  `BloodType_Id` int(11) NOT NULL,
  `Qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Cpassword` varchar(255) NOT NULL,
  `otp_code` int(11) DEFAULT NULL,
  `verify_otp` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Name`, `Email`, `Password`, `Cpassword`, `otp_code`, `verify_otp`) VALUES
(7, 'Zaw', 'zaw@gmail.com', '$2y$10$lvO/xe29.kKsTB8EQ4Qpa.w9BHPH.lkOgSG2WPWyHrbbovZ7uw9L6', '0', 0, 0),
(43, 'Phue Pwint', 'phuepwint293989@gmail.com', '$2y$10$Qcl2cv4q6vVTd8eT8fqkOOz6xpZ5V8vtfS3Uq77DEz8Id01e6I17C', '$2y$10$Qcl2cv4q6vVTd8eT8fqkOOz6xpZ5V8vtfS3Uq77DEz8Id01e6I17C', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bloodstock`
--
ALTER TABLE `bloodstock`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `BloodType_Id` (`BloodType_Id`),
  ADD KEY `Donor_Id` (`Donor_Id`),
  ADD KEY `Others_Id` (`Others_Id`);

--
-- Indexes for table `bloodtype`
--
ALTER TABLE `bloodtype`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ReqDetail_Id` (`ReqDetail_Id`),
  ADD KEY `BloodStock_Id` (`BloodStock_Id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Donor_Id` (`Donor_req_Id`);

--
-- Indexes for table `donor_req`
--
ALTER TABLE `donor_req`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `BloodType_Id` (`BloodType_Id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Hospital_Id` (`Hospital_Id`);

--
-- Indexes for table `hospital_req`
--
ALTER TABLE `hospital_req`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `others`
--
ALTER TABLE `others`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Patient_Id` (`Patient_Id`);

--
-- Indexes for table `patient_req`
--
ALTER TABLE `patient_req`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `BloodType_Id` (`BloodType_Id`);

--
-- Indexes for table `req`
--
ALTER TABLE `req`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Hospital_Req` (`Hospital_Req_Id`),
  ADD KEY `Patient_Req_Id` (`Patient_Req_Id`);

--
-- Indexes for table `req_detail`
--
ALTER TABLE `req_detail`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Req_Id` (`Req_Id`),
  ADD KEY `BloodType_Id` (`BloodType_Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bloodstock`
--
ALTER TABLE `bloodstock`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bloodtype`
--
ALTER TABLE `bloodtype`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donor_req`
--
ALTER TABLE `donor_req`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospital_req`
--
ALTER TABLE `hospital_req`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `others`
--
ALTER TABLE `others`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_req`
--
ALTER TABLE `patient_req`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `req`
--
ALTER TABLE `req`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `req_detail`
--
ALTER TABLE `req_detail`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bloodstock`
--
ALTER TABLE `bloodstock`
  ADD CONSTRAINT `bloodstock_ibfk_1` FOREIGN KEY (`BloodType_Id`) REFERENCES `bloodtype` (`Id`),
  ADD CONSTRAINT `bloodstock_ibfk_2` FOREIGN KEY (`Donor_Id`) REFERENCES `donor` (`Id`),
  ADD CONSTRAINT `bloodstock_ibfk_3` FOREIGN KEY (`Others_Id`) REFERENCES `others` (`Id`);

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `donation_ibfk_1` FOREIGN KEY (`ReqDetail_Id`) REFERENCES `req_detail` (`Id`),
  ADD CONSTRAINT `donation_ibfk_2` FOREIGN KEY (`BloodStock_Id`) REFERENCES `bloodstock` (`Id`);

--
-- Constraints for table `donor`
--
ALTER TABLE `donor`
  ADD CONSTRAINT `donor_ibfk_1` FOREIGN KEY (`Donor_req_Id`) REFERENCES `donor_req` (`Id`);

--
-- Constraints for table `hospital`
--
ALTER TABLE `hospital`
  ADD CONSTRAINT `hospital_ibfk_1` FOREIGN KEY (`Hospital_Id`) REFERENCES `hospital_req` (`Id`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`Patient_Id`) REFERENCES `patient_req` (`Id`);

--
-- Constraints for table `patient_req`
--
ALTER TABLE `patient_req`
  ADD CONSTRAINT `patient_req_ibfk_1` FOREIGN KEY (`BloodType_Id`) REFERENCES `bloodtype` (`Id`);

--
-- Constraints for table `req`
--
ALTER TABLE `req`
  ADD CONSTRAINT `req_ibfk_1` FOREIGN KEY (`Hospital_Req_Id`) REFERENCES `hospital_req` (`Id`),
  ADD CONSTRAINT `req_ibfk_2` FOREIGN KEY (`Patient_Req_Id`) REFERENCES `patient_req` (`Id`);

--
-- Constraints for table `req_detail`
--
ALTER TABLE `req_detail`
  ADD CONSTRAINT `req_detail_ibfk_1` FOREIGN KEY (`Req_Id`) REFERENCES `req` (`Id`),
  ADD CONSTRAINT `req_detail_ibfk_2` FOREIGN KEY (`BloodType_Id`) REFERENCES `bloodtype` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
