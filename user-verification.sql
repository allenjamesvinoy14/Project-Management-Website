-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2019 at 08:51 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user-verification`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `verified` tinyint(4) NOT NULL,
  `token` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `verified`, `token`, `password`) VALUES
(1, 'allenjamesvinoy', 'jamesallenvinoy@gmail.com', 0, 'f6e96db76369faf74678d22905a65e686965a199ccc418e7cb400c203fd7e908e7580aaaebc1eb43eab260d1e4829024ce92', '$2y$10$oZbW3cvf0JlpdbobNuIfMuIrNqvr3LaaPvd0SW1qHJNzIlOZIyo66'),
(3, 'ajv199', 'prithvirajindi@gmail.com', 0, 'e3a98d4c75a9ae44ea38b666ef931a0ea8c29f4fd8522eefa8263485ad9f4ccd28ce1281ad72331d789a809cb69c916def16', '$2y$10$S0ZpBrTfguIoDwVHh9cLS.juwzbDdjpQ1QmMFlSwSpKQ/pWrgAvQO'),
(6, 'ajjv', 'allenjames.vinoy2017@vitstudent.ac.in', 0, '00b8a2ef1d9ba62e8ea55ff6c606b650f8c9eaf8745931cdddaa2529bde643a22c738b7d0d78aed7de950463a596f520d73c', '$2y$10$JcYsTR68JIpYdlRO8xGTpezGcDHy2Cpu57CNLHdhpVYY6TuBWlcA2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
