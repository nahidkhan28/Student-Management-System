-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2024 at 12:39 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `main_crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `blood_group` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `age`, `blood_group`) VALUES
(3, 'Faizaan', 'khann', 27, 'B+'),
(9, 'Aman', 'Patel', 12, 'O+'),
(10, 'Saurabh', 'Singh', 12, 'B+'),
(11, 'Raja ', 'Patel', 11, 'B+'),
(12, 'Riya', 'Singh', 11, 'O+'),
(13, 'Dhruv', 'Singh', 10, 'AB+'),
(14, 'Ruby', 'Kumari', 11, 'O-'),
(15, 'Faraaz ', 'Khan', 12, 'AB+'),
(16, 'Himanshu', 'Tiwari', 9, 'AB+'),
(17, 'Ritik', 'Sahu', 10, 'B+'),
(18, 'Amit', 'Kumar', 12, 'O+'),
(19, 'Rahul ', 'Aanand', 14, 'B+');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'test', 'test@gmail.com', '$2y$10$4wTi5zqj2Y1tGmBMrQyDcuQOTEXg9M/qpT43XkIPmcspM7yWzVCgq'),
(3, 'faizaan', 'faizaan@gmail.com', '$2y$10$hIDZrLTN9toYj9sEySYDbuE5D8dj2gvbvkmvqhvHuV6OE1Z1uOM0.'),
(5, 'admin', 'admin@gmail.com', '$2y$10$O.OPbq6Ngj0mujZeinWSLedjb1MOIB7co5zzxaccimXddRkD.CblG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
