-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2021 at 10:58 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mycake`
--

-- --------------------------------------------------------

--
-- Table structure for table `cake_tbl`
--

CREATE TABLE `cake_tbl` (
  `id` int(11) NOT NULL,
  `cake_name` varchar(50) NOT NULL,
  `cake_desc` text,
  `category_id` int(11) NOT NULL,
  `cake_photo` varchar(255) NOT NULL,
  `cake_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cake_tbl`
--

INSERT INTO `cake_tbl` (`id`, `cake_name`, `cake_desc`, `category_id`, `cake_photo`, `cake_price`) VALUES
(1, 'Sweet Chocolate Cake', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 1, 'cake-1', 100000),
(2, 'Strobarry Vanilla Cake', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 1, 'cake-2', 100000),
(3, 'Sweet Pink Cake', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur', 1, 'cake-3', 70000),
(4, 'Rainbow Cup Cake', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur', 2, 'cupcake-1', 10000),
(5, 'Chocolate Cup Cake', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur', 2, 'cupcake-2', 10000),
(6, 'Vanilla Blue Cup Cake', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur', 2, 'cupcake-3', 20000),
(7, 'Sweet Vanilla Doughnut', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur', 3, 'doughnut-1', 10000),
(8, 'Special Chocolate Doughnut', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur', 3, 'doughnut-2', 10000),
(9, 'Sweet Bear Special Doughnut', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur', 3, 'doughnut-3', 25000);

-- --------------------------------------------------------

--
-- Table structure for table `category_tbl`
--

CREATE TABLE `category_tbl` (
  `id` int(11) NOT NULL,
  `category_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_tbl`
--

INSERT INTO `category_tbl` (`id`, `category_name`) VALUES
(1, 'Cake'),
(2, 'Cup Cake'),
(3, 'Doughnut');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail_tbl`
--

CREATE TABLE `transaction_detail_tbl` (
  `transaction_detail_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `cake_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_total` int(11) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_detail_tbl`
--

INSERT INTO `transaction_detail_tbl` (`transaction_detail_id`, `transaction_id`, `cake_id`, `quantity`, `price_total`, `status`) VALUES
(1, 1, 5, 5, 50000, 'SUCCES'),
(3, 1, 9, 2, 50000, 'SUCCES'),
(4, 1, 6, 2, 40000, 'SUCCES'),
(5, 1, 1, 2, 200000, 'SUCCES'),
(6, 1, 4, 1, 10000, 'SUCCES');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_tbl`
--

CREATE TABLE `transaction_tbl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_tbl`
--

INSERT INTO `transaction_tbl` (`id`, `user_id`, `date`, `total`) VALUES
(1, 1, '2016-03-21', 375000);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `username`, `name`, `address`, `phone`, `email`, `password`) VALUES
(1, 'ilham', 'Ilham Muhamad', 'GBA III Blok P.5 No.5', '082234375472', 'Ilham@mail.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cake_tbl`
--
ALTER TABLE `cake_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rel_cake/category` (`category_id`);

--
-- Indexes for table `category_tbl`
--
ALTER TABLE `category_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_detail_tbl`
--
ALTER TABLE `transaction_detail_tbl`
  ADD PRIMARY KEY (`transaction_detail_id`),
  ADD KEY `rel_tdetail/transaction` (`transaction_id`),
  ADD KEY `rel_tdetail/cake` (`cake_id`);

--
-- Indexes for table `transaction_tbl`
--
ALTER TABLE `transaction_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rel_transac/user` (`user_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cake_tbl`
--
ALTER TABLE `cake_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category_tbl`
--
ALTER TABLE `category_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction_detail_tbl`
--
ALTER TABLE `transaction_detail_tbl`
  MODIFY `transaction_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction_tbl`
--
ALTER TABLE `transaction_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cake_tbl`
--
ALTER TABLE `cake_tbl`
  ADD CONSTRAINT `rel_cake/category` FOREIGN KEY (`category_id`) REFERENCES `category_tbl` (`id`);

--
-- Constraints for table `transaction_detail_tbl`
--
ALTER TABLE `transaction_detail_tbl`
  ADD CONSTRAINT `rel_tdetail/cake` FOREIGN KEY (`cake_id`) REFERENCES `cake_tbl` (`id`),
  ADD CONSTRAINT `rel_tdetail/transaction` FOREIGN KEY (`transaction_id`) REFERENCES `transaction_tbl` (`id`);

--
-- Constraints for table `transaction_tbl`
--
ALTER TABLE `transaction_tbl`
  ADD CONSTRAINT `rel_transac/user` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
