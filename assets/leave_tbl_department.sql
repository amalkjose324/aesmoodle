-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 16, 2018 at 10:37 AM
-- Server version: 10.2.19-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aesajce_aes3`
--

-- --------------------------------------------------------

--
-- Table structure for table `leave_tbl_department`
--

CREATE TABLE `leave_tbl_department` (
  `deptCode` bigint(20) NOT NULL,
  `deptName` varchar(500) DEFAULT NULL,
  `deptStatus` int(11) DEFAULT NULL,
  `createdDate` varchar(100) DEFAULT NULL,
  `createdBy` varchar(500) DEFAULT NULL,
  `entryIp` varchar(100) DEFAULT NULL,
  `deptshort` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_tbl_department`
--

INSERT INTO `leave_tbl_department` (`deptCode`, `deptName`, `deptStatus`, `createdDate`, `createdBy`, `entryIp`, `deptshort`) VALUES
(29, 'Metallurgical & Materials Engineering', 0, '04/30/2013', 'Admin', '', 'MTG'),
(28, 'Humanities', 1, '04/30/2013', 'Admin', '', 'HUM'),
(27, 'Mechanical Engineering Automobile', 1, '04/30/2013', 'Admin', '', 'MA'),
(26, 'Electrical & Electronics Engineering', 1, '04/30/2013', 'Admin', '', 'EEE'),
(9, 'Administration', 1, '', '', '', 'ADM'),
(25, 'Information Technology', 1, '04/30/2013', 'Admin', '', 'IT'),
(24, 'Computer Science & Engineering', 1, '04/30/2013', 'Admin', '', 'CSE'),
(23, 'Electronics & Communication Engineering', 1, '04/30/2013', 'Admin', '', 'ECE'),
(22, 'Basic Science', 1, '04/30/2013', 'Admin', '', 'BS'),
(21, 'Civil Engineering', 1, '04/30/2013', 'Admin', '', 'CE'),
(20, 'Mechanical Engineering', 1, '04/30/2013', 'Admin', '', 'ME'),
(30, 'Master of Computer Applications', 1, '04/30/2013', 'Admin', '', 'MCA'),
(32, 'Library, Information and Documentation', 1, '', '', '', 'LIB'),
(33, 'Chemical Engineering', 0, '2013-11-13', 'Administrator', '192.168.4.223', 'CHE'),
(34, 'AES & Incubation Center', 0, '', '', '', 'AES'),
(35, 'Metallurgical & Materials Engineering', 1, '', '', '', 'MT'),
(36, 'Chemical Engineering', 1, '', '', '', 'CHE'),
(37, 'Placement Cell', 2, '', '', '', NULL),
(38, 'IEDC/TBI', 2, '', '', '', NULL),
(40, 'Counselling', 1, '', '', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leave_tbl_department`
--
ALTER TABLE `leave_tbl_department`
  ADD PRIMARY KEY (`deptCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leave_tbl_department`
--
ALTER TABLE `leave_tbl_department`
  MODIFY `deptCode` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
