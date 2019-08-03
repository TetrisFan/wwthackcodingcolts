-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2019 at 12:03 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clubapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `pendingclubs`
--

CREATE TABLE `pendingclubs` (
  `ID` int(11) NOT NULL,
  `clubName` text NOT NULL,
  `clubDescription` text NOT NULL,
  `tag1` varchar(30) CHARACTER SET utf8 NOT NULL,
  `tag2` varchar(30) CHARACTER SET utf8 NOT NULL,
  `user` text NOT NULL,
  `userID` varchar(50) NOT NULL,
  `submitTime` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendingclubs`
--

INSERT INTO `pendingclubs` (`ID`, `clubName`, `clubDescription`, `tag1`, `tag2`, `user`, `userID`, `submitTime`) VALUES
(15, 'Tree Climbing', 'We climb trees. Go trees!', 'STEM', 'Language', 'Yordle Smith', '1', '8/20/19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pendingclubs`
--
ALTER TABLE `pendingclubs`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pendingclubs`
--
ALTER TABLE `pendingclubs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
