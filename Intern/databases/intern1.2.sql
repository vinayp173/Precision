-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2016 at 07:45 PM
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
-- Table structure for table `emp`
--

CREATE TABLE `emp` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `post` varchar(50) NOT NULL,
  `no of cars` int(11) NOT NULL,
  `no of cars handled` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact No` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`id`, `name`, `address`, `post`, `no of cars`, `no of cars handled`, `email`, `contact No`, `emp_id`) VALUES
(2, 'Max', 'Nerul', 'Supervisor', 1, 10, 'Supervisor@gmail.com', 124578896, 1),
(2, 'james', 'kharghar', 'Supervisor', 2, 12, 'supervisor2@gmail.com', 65231245, 2);

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
(1, 'refill engine oil', 1, 0),
(2, 'change oilFilter', 2, 0),
(3, 'change spark plug', 3, 0),
(4, 'change Air Filter', 4, 0),
(5, 'change Break Fluid', 5, 0),
(6, 'change clutch Fluid', 6, 0),
(7, 'change AC Belt', 7, 0),
(8, 'wheel balancing', 8, 0),
(9, 'wheel rotation', 9, 0),
(10, 'fill air in tyres', 10, 0),
(11, 'replace 1 wheel', 11, 0),
(12, 'replace 2 wheel', 12, 0),
(13, 'replace 3 wheel', 13, 0),
(14, 'replace 4 wheel', 14, 0),
(15, 'change 1 headlight', 15, 0),
(16, 'change 2 headlights', 16, 0),
(17, 'change 1 tail light', 17, 0),
(18, 'change 2 tail light', 18, 0),
(19, 'repair electric switches', 19, 0),
(20, 'repair other lights', 20, 0),
(21, 'wash the car', 21, 0),
(22, 'change wiper', 22, 0),
(23, 'repair wiper operation', 23, 0),
(24, 'refill Transmission oil', 24, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobd`
--

CREATE TABLE `jobd` (
  `job` varchar(50) NOT NULL,
  `cost` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `sr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobd`
--

INSERT INTO `jobd` (`job`, `cost`, `id`, `sr`) VALUES
('change ac belt', 500, 1, 4),
('change clutch Fluid', 50, 1, 5),
('refill engine oil', 0, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `jobd1`
--

CREATE TABLE `jobd1` (
  `job` varchar(50) NOT NULL,
  `cost` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `sr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobd1`
--

INSERT INTO `jobd1` (`job`, `cost`, `id`, `sr`) VALUES
('refill engine oil', 1000, 2, 1),
('change wipers', 4000, 2, 3),
('change 2 headlights', 0, 2, 4);

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
  `license_no` varchar(15) NOT NULL,
  `dents` int(11) NOT NULL,
  `scratches` int(11) NOT NULL,
  `peelings` int(11) NOT NULL,
  `remark` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_card`
--

INSERT INTO `job_card` (`card_id`, `customer_id`, `stage1`, `stage2`, `stage3`, `stage4`, `chassis_no`, `start_date`, `delivery_date`, `total_cost`, `license_no`, `dents`, `scratches`, `peelings`, `remark`) VALUES
(1, 2, 123, 0, 0, 0, 'dsdsdfgf213', '2016-12-15', '2016-12-15', 0, 'gfgfgf3221', 0, 0, 0, ''),
(2, 1, 123, 0, 0, 0, '122', '2016-12-15', '2016-12-15', 0, '12232', 0, 0, 0, ''),
(3, 1, 123, 0, 0, 0, 'wqw', '2016-12-19', '2016-12-19', 0, 'qwqw', 0, 0, 0, ''),
(4, 2, 123, 0, 0, 0, 'RTGGGRT', '2016-12-19', '2016-12-19', 0, 'GTRTGR', 0, 0, 0, ''),
(5, 1, 123, 0, 0, 0, 'dsd', '2016-12-19', '2016-12-19', 0, 'sddf32', 0, 0, 0, ''),
(6, 1, 123, 0, 0, 0, 'analysis car', '2016-12-19', '2016-12-19', 0, 'take 1', 12, 432, 43, 'this car is a waste'),
(7, 1, 123, 0, 0, 0, '3223', '2016-12-20', '2016-12-20', 0, '3223', 0, 0, 0, ''),
(8, 1, 123, 0, 0, 0, 'wf', '2016-12-20', '2016-12-20', 0, 'we', 0, 0, 0, ''),
(9, 1, 123, 0, 0, 0, 'testing itergration', '2016-12-20', '2016-12-20', 0, 'g544324', 121, 12, 12, 'fdfddfdf');

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
-- Dumping data for table `job_card_details`
--

INSERT INTO `job_card_details` (`srno`, `card_id`, `job_id`, `price`, `priority`) VALUES
(1, 9, 1, 0, 1),
(2, 9, 4, 0, 1),
(3, 9, 6, 0, 1),
(4, 9, 18, 0, 1),
(5, 9, 20, 0, 1),
(6, 9, 23, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

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
