-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2020 at 10:04 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poly_app_c1`
--

-- --------------------------------------------------------

--
-- Table structure for table `cheque`
--

CREATE TABLE `cheque` (
  `cheque_id` int(7) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `cheque_no` varchar(50) NOT NULL,
  `valid_date` date NOT NULL,
  `exchange_date` date NOT NULL,
  `cheque_value` double(10,2) NOT NULL,
  `interest` int(5) NOT NULL,
  `exchange_amt` double(10,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `cust_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cheque`
--

INSERT INTO `cheque` (`cheque_id`, `bank`, `cheque_no`, `valid_date`, `exchange_date`, `cheque_value`, `interest`, `exchange_amt`, `status`, `cust_id`) VALUES
(1, 'commercial', 'NV09764', '2020-12-12', '2020-11-10', 5000.00, 6, 4700.00, 'Completed ', 'D0001'),
(2, 'NSB', '12454789', '2020-12-12', '2020-11-07', 1550.00, 4, 1430.00, 'NYC ', 'Moo3'),
(3, 'BOC', 'BO256378', '2020-12-01', '2020-11-14', 9000.00, 10, 8100.00, 'NYC', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` varchar(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `vehicle_no` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `type`, `name`, `address`, `vehicle_no`) VALUES
('D0002', 'Daily', 'anneSS', 'katukurunda', ''),
('D0006', 'Daily', 'Nirmala weerasinghe', 'Unawatuna,Galle', ''),
('D0007', 'Daily', 'Iresha sandamali ', 'payagala', ''),
('D0009', 'Daily', 'anuradha', 'pituwala', ''),
('D0010', 'Daily', 'harshika sammani', 'wadduwa south', ''),
('D0011', 'Daily', 'Sachintha Dilshan', 'Katukurunda', ''),
('M0001', 'Monthly', 'Hasith Lakmal', 'panadura', ''),
('M0003', 'Monthly', 'Gimhani', 'pitigala,elpitiya', ''),
('M0010', 'Monthly', 'Chirath yapa', 'Gampola', ''),
('M0076', 'Monthly', 'anushka bandara', 'maharagamaaa', ''),
('M0077', 'Monthly', 'Hasitha', 'kalutara', ''),
('M0078', 'Monthly', 'Damith', 'pelawatta', '');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `loan_no` int(7) NOT NULL,
  `l_date` date NOT NULL,
  `amount` double(10,2) NOT NULL,
  `interest` int(5) NOT NULL,
  `value_of_interest` double NOT NULL,
  `cust_id` varchar(10) NOT NULL,
  `l_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`loan_no`, `l_date`, `amount`, `interest`, `value_of_interest`, `cust_id`, `l_status`) VALUES
(1, '2020-11-27', 10000.00, 7, 1, 'D0002', 0),
(4, '2020-07-27', 25000.00, 5, 0, 'M0010', 0),
(12, '2020-11-12', 20000.00, 5, 0, 'M0001', 0),
(17, '2020-11-25', 100000.00, 4, 100, 'M0078', 1),
(18, '2020-11-26', 10000.00, 5, 100, 'M0001', 1),
(19, '2020-11-27', 110000.00, 4, 146.67, 'D0010', 1),
(20, '2020-11-30', 100000.00, 4, 133.33, 'M0076', 1),
(21, '2020-12-07', 100000.00, 4, 133.33, 'D0011', 1),
(22, '2020-12-07', 50000.00, 4, 66.67, 'M0077', 1),
(23, '2020-12-07', 50000.00, 4, 66.67, 'D0002', 1),
(24, '2020-11-29', 60000.00, 5, 100, 'D0009', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loan_installement`
--

CREATE TABLE `loan_installement` (
  `id` int(7) NOT NULL,
  `li_date` date NOT NULL,
  `installement_amt` double(10,2) NOT NULL,
  `interest_amt` double(10,2) NOT NULL,
  `remaining_int_amt` decimal(10,0) NOT NULL DEFAULT '0',
  `remaining_amt` double(10,2) NOT NULL,
  `loan_no` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_installement`
--

INSERT INTO `loan_installement` (`id`, `li_date`, `installement_amt`, `interest_amt`, `remaining_int_amt`, `remaining_amt`, `loan_no`) VALUES
(1, '2020-11-03', 2000.00, 100.00, '0', 8000.00, 1),
(2, '2020-11-09', 2500.00, 5.00, '0', 7500.00, 1),
(3, '2020-11-01', 5454.00, 454.00, '0', 45.00, 1),
(5, '2020-11-03', 5450.00, 450.00, '0', 54.00, 1),
(7, '2020-11-13', 6000.00, 500.00, '0', 8500.00, 2),
(16, '2020-11-03', 2500.00, 500.00, '0', 23250.00, 4),
(17, '2020-11-05', 5000.00, 1000.00, '0', 17250.00, 4),
(18, '2020-11-09', 8000.00, 2250.00, '0', 7000.00, 4),
(21, '2020-11-25', 5000.00, 600.00, '0', 10000.00, 14),
(22, '2020-11-26', 4000.00, 1000.00, '0', 20000.00, 12),
(25, '2020-11-26', 2000.00, 500.00, '0', 10000.00, 18),
(26, '2020-12-01', 8533.30, 1466.70, '0', 152800.00, 19),
(27, '2020-12-01', 8533.30, 1466.70, '0', 142800.00, 19),
(28, '2020-12-01', 8533.30, 1466.70, '0', 132800.00, 19),
(29, '2020-12-04', 466.68, 533.32, '0', 147000.00, 20),
(30, '2020-12-04', 23.00, 31.00, '0', 0.00, 1),
(31, '2020-12-07', 0.00, 1200.00, '200', 147000.00, 17),
(32, '2020-12-10', 0.00, 500.00, '300', 146800.00, 17),
(34, '2020-12-07', 400.00, 1100.00, '0', 8500.00, 18),
(46, '2020-12-08', 900.00, 100.00, '0', 7500.00, 18),
(47, '2020-12-07', 400.00, 600.00, '0', 145800.00, 17),
(48, '2020-12-08', 20.00, 100.00, '0', 145680.00, 17),
(49, '2020-12-08', 1000.00, 0.00, '0', 144680.00, 17),
(50, '2020-12-08', 0.00, 533.32, '33', 146500.00, 20),
(51, '2020-12-08', 200.00, 0.00, '0', 144480.00, 17),
(52, '2020-12-02', 4700.00, 300.00, '0', 55000.00, 24),
(53, '2020-12-09', 4300.00, 700.00, '0', 50000.00, 24),
(54, '2020-12-10', 4900.00, 100.00, '0', 45100.00, 24),
(55, '2020-12-10', 5000.00, 0.00, '0', 40100.00, 24);

-- --------------------------------------------------------

--
-- Table structure for table `summary`
--

CREATE TABLE `summary` (
  `id` int(11) NOT NULL,
  `year` varchar(500) NOT NULL,
  `month` varchar(500) NOT NULL,
  `loanAMT` decimal(18,2) NOT NULL DEFAULT '0.00',
  `debtAMT` decimal(18,2) NOT NULL DEFAULT '0.00',
  `createDate` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `summary`
--

INSERT INTO `summary` (`id`, `year`, `month`, `loanAMT`, `debtAMT`, `createDate`) VALUES
(1, '2020', '11', '410000.00', '66500.00', '2020-11-24'),
(2, '2020', '01', '0.00', '0.00', '2020-11-24'),
(3, '2020', '02', '0.00', '0.00', '2020-11-24'),
(4, '2020', '03', '10000.00', '0.00', '2020-11-24'),
(5, '2020', '04', '0.00', '0.00', '2020-11-24'),
(6, '2020', '05', '0.00', '0.00', '2020-11-24'),
(7, '2020', '06', '0.00', '0.00', '2020-11-24'),
(8, '2020', '07', '0.00', '0.00', '2020-11-24'),
(9, '2020', '08', '0.00', '0.00', '2020-11-24'),
(10, '2020', '09', '0.00', '0.00', '2020-11-24'),
(11, '2020', '10', '0.00', '0.00', '2020-11-24'),
(12, '2020', '12', '800000.00', '106422.89', '2020-11-24');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'sa', '698d51a19d8a121ce581499d7b701668');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cheque`
--
ALTER TABLE `cheque`
  ADD PRIMARY KEY (`cheque_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`loan_no`);

--
-- Indexes for table `loan_installement`
--
ALTER TABLE `loan_installement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `summary`
--
ALTER TABLE `summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cheque`
--
ALTER TABLE `cheque`
  MODIFY `cheque_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `loan_no` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `loan_installement`
--
ALTER TABLE `loan_installement`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `summary`
--
ALTER TABLE `summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
