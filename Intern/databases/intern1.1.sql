-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2016 at 12:24 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intern`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `address`, `number`) VALUES
(1, 'vinay', 'vinay.patil28@gmail.com', '403,Dishank Tower,Khadakpada,kalyan west', '7666406289'),
(2, 'vijay', 'vinayp173@gmail.com', '403,Dishank Tower,above hotel GuurudevNX,khadakpada,kalyan west', '8767541708');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `name`, `price`, `quantity`) VALUES
(1, 'oil', 500, 30),
(2, 'music system', 5000, 3),
(3, 'spark plug', 50, 50),
(4, 'headlight', 500, 10),
(5, 'ac belt', 500, 10),
(6, 'wipers', 4000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_list`
--

CREATE TABLE `inventory_list` (
  `srno` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_list`
--

INSERT INTO `inventory_list` (`srno`, `list_id`, `inventory_id`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 3, 6),
(4, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int(11) NOT NULL,
  `job_name` varchar(50) NOT NULL,
  `list_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `job_name`, `list_id`, `total_price`) VALUES
(1, 'refill engine oil', 1, 1000),
(2, 'change headlight', 2, 0),
(3, 'change wipers', 3, 4000),
(4, 'change ac belt', 4, 500);

-- --------------------------------------------------------

--
-- Table structure for table `job_card`
--

CREATE TABLE `job_card` (
  `card_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `stage1` int(11) NOT NULL,
  `stage2` int(11) NOT NULL,
  `stage3` int(11) NOT NULL,
  `stage4` int(11) NOT NULL,
  `chassis_no` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `total_cost` int(11) NOT NULL,
  `license_no` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_card`
--

INSERT INTO `job_card` (`card_id`, `customer_id`, `stage1`, `stage2`, `stage3`, `stage4`, `chassis_no`, `start_date`, `delivery_date`, `total_cost`, `license_no`) VALUES
(1, 2, 123, 0, 0, 0, 'dsdsdfgf213', '2016-12-15', '2016-12-15', 0, 'gfgfgf3221'),
(2, 1, 123, 0, 0, 0, '122', '2016-12-15', '2016-12-15', 0, '12232');

-- --------------------------------------------------------

--
-- Table structure for table `job_card_details`
--

CREATE TABLE `job_card_details` (
  `srno` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_list`
--
ALTER TABLE `inventory_list`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `job_card`
--
ALTER TABLE `job_card`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `job_card_details`
--
ALTER TABLE `job_card_details`
  ADD PRIMARY KEY (`srno`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
