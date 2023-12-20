-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 11:51 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `unit` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `expiry` date NOT NULL,
  `availinv` int(11) NOT NULL,
  `invcost` int(11) NOT NULL,
  `image` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `productname`, `unit`, `price`, `expiry`, `availinv`, `invcost`, `image`) VALUES
(1, 'Logan', 12, 10, '2023-12-19', 12, 120, 0x4453435f34373533202831292e4a5047),
(2, 'Marlou', 12, 15, '2023-12-19', 5, 75, 0x4453435f34373935202831292e4a5047),
(3, 'mango', 20, 10, '2023-12-19', 12, 120, 0x4453435f343739352e4a5047),
(4, 'as', 34, 12, '2023-12-14', 23, 276, 0x4453435f34373932202831292e4a5047),
(5, 'kj', 56, 45, '2023-12-01', 10, 450, 0x53494d554c414e20414e472050524f475245534f21205341205445414d2056494e544120414153454e534f21202831292e706e67),
(6, 'df', 123, 10, '2023-12-19', 4, 40, 0x3338343139323130315f313036323136363436383239363033335f353437313434343531343732353530353430305f6e2e6a7067),
(7, 'asdasd', 234234, 12123, '2023-12-19', 34, 412182, 0x53494d554c414e20414e472050524f475245534f21205341205445414d2056494e544120414153454e534f212e706e67);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
