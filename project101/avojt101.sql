-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2024 at 03:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avojt101`
--

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dos` date NOT NULL,
  `doe` date NOT NULL,
  `assigned_dept` varchar(20) NOT NULL,
  `summary` varchar(500) NOT NULL,
  `accomplishment` varchar(500) NOT NULL,
  `challenges` varchar(500) NOT NULL,
  `learnings` varchar(500) NOT NULL,
  `status` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `timestamp`, `dos`, `doe`, `assigned_dept`, `summary`, `accomplishment`, `challenges`, `learnings`, `status`) VALUES
(27, 3, '2024-05-03 05:14:16', '2024-04-30', '2024-05-16', 'IT', 'shut the fuck up', 'shut thefuck up', 'shut the fuck up', 'shut the fuck up', 'Saved'),
(28, 3, '2024-05-03 05:55:30', '2024-05-01', '2024-05-24', 'IT', 'sdfsd', 'fsdfsd', 'fsdf', 'sdffd', 'Saved'),
(29, 3, '2024-05-03 05:57:15', '2024-05-01', '2024-05-17', 'Admin', 'fsdfds', 'fsdfsd', 'fsdfsd', 'ffsdfdsfdsfds', 'Saved'),
(30, 3, '2024-05-06 07:31:50', '2024-04-30', '2024-05-11', 'IT', 'sadsad', 'sadsadas', 'dasdasdsa', 'dsa', 'Saved');

-- --------------------------------------------------------

--
-- Table structure for table `timesheet`
--

CREATE TABLE `timesheet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `event_type` varchar(3) NOT NULL,
  `total_hours` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timesheet`
--

INSERT INTO `timesheet` (`id`, `user_id`, `timestamp`, `event_type`, `total_hours`) VALUES
(85, 3, '2024-05-03 00:48:02.621437', 'In', 0),
(86, 3, '2024-05-03 05:38:02.077870', 'Out', 5),
(87, 3, '2024-05-04 01:08:14.103911', 'In', 0),
(88, 1, '2024-05-04 02:10:38.317465', 'In', 0),
(89, 3, '2024-05-06 06:26:53.780195', 'In', 0),
(90, 3, '2024-05-06 08:27:07.593252', 'Out', 2);

-- --------------------------------------------------------

--
-- Table structure for table `trainees`
--

CREATE TABLE `trainees` (
  `id` int(11) NOT NULL,
  `ojt_id` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `age` int(2) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `contact_num` varchar(11) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `university` varchar(100) NOT NULL,
  `hours_to_render` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dos` date NOT NULL,
  `profile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainees`
--

INSERT INTO `trainees` (`id`, `ojt_id`, `user_id`, `first_name`, `middle_name`, `last_name`, `age`, `sex`, `contact_num`, `degree`, `university`, `hours_to_render`, `email`, `dos`, `profile`) VALUES
(1, 'AVOJT-001', 1, 'John Louie', 'Toñacao', 'Gastardo', 22, 'Male', '09772799104', 'Bachelor of Industrial Technology major in Computer Technology', 'Cebu Technological University - Daanbantayan Campus', 1800, 'gastardo.johnlouie10@gmail.com', '2023-09-11', 'zenitsu.jpg'),
(2, 'AVOJT-002', 2, 'John Louie', 'Toñacao', 'Gastardo', 25, 'Male', '09057306552', 'Bachelor of Industrial Technology major in Computer Technology', 'Cebu Technological University - Daanbantayan Campus', 1800, 'gastardo.johnlouie00@gmail.com', '2024-04-27', ''),
(3, 'AVOJT-003', 3, 'Kent Dominic', 'Oro', 'Pepito', 27, 'Male', '09057306552', 'Bachelor of Science in Information Technology', 'Cebu Technological University - Consolacion Campus', 600, 'kpepito@gmail.com', '2024-04-08', 'zenitsu.jpg'),
(4, 'AVOJT-004', 4, 'Rhealyn', 'Ostia', 'Arnoco', 22, 'Female', '09999999999', 'Bachelor of Industrial Technology major in Computer Technology', 'Cebu Technological University - Daanbantayan Campus', 1800, 'rhealyn@gmail.com', '2024-05-01', ''),
(5, 'AVOJT-005', 5, 'Charity', 'Nulia', 'Salgarino', 23, 'Female', '08888888888', 'Bachelor of Industrial Technology major in Computer Technology', 'Cebu Technological University - Daanbantayan Campus', 1800, 'charity@gmail.con', '2024-05-01', ''),
(6, 'AVOJT-006', 6, 'Marichu', 'Marichu', 'Arriesgado', 30, 'Male', '0999999999', 'Bachelor of Industrial Technology major in Computer Technology', 'Cebu Technological University - Daanbantayan Campus', 1800, 'gastardo.johnlouie0000@gmail.com', '2024-05-06', ''),
(7, 'AVOJT-007', 7, 'John Louie', 'Toñacao', 'Gastardo', 43, 'Male', '44545', 'Bachelor of Industrial Technology major in Computer Technology', 'Cebu Technological University - Daanbantayan Campus', 435, 'gastardo.johnlouie@gmail.com', '2024-05-06', ''),
(8, 'AVOJT-008', 8, 'John Louie', 'Toñacao', 'Gastardo', 22, 'Male', '13123323', 'Bachelor of Industrial Technology major in Computer Technology', 'Cebu Technological University - Daanbantayan Campus', 1232, 'janlowi@gmail.com', '2024-05-06', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `profile` text NOT NULL,
  `status` varchar(8) NOT NULL,
  `office_assigned` varchar(15) NOT NULL,
  `department` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `user_type`, `profile`, `status`, `office_assigned`, `department`) VALUES
(1, 'gastardo.johnlouie10@gmail.com', '$2y$10$Dr4CikHOmpd8pthdK56DiO1zuYqhbQg.PjBMsmcUjVwm/5FgY6vtG', 'Trainee', '', 'Active', 'Tayud', 'IT'),
(2, 'gastardo.johnlouie00@gmail.com', '$2y$10$8GTukiEitwEQmxqc4kMLcetFaOCaw8fA6uFCTqPjGLVUBt/21LjGi', 'Admin', '', 'Active', 'Tayud', 'IT'),
(3, 'kpepito@gmail.com', '$2y$10$tTYnVZS7ENJ5Gzwgx7tIie0fgU/LxGdyoqGbHUtWTsQW7633yN3te', 'Trainee', '', 'Active', 'Tayud', 'IT'),
(4, 'rhealyn@gmail.com', '$2y$10$lNnMgMP6wT1RlqwgBVsKMuYrW8LQDP2UxGpjqGuMTuEh7wq1bBGKC', 'Trainee', '', 'Active', 'Tayud', 'IT'),
(5, 'charity@gmail.con', '$2y$10$usYr7k6QIXcr0g6SSw3dau1KPUIO5Zcv2XU04sWIXD.kvpwclLEAu', 'Trainee', '', 'Active', 'Tayud', 'IT'),
(6, 'gastardo.johnlouie0000@gmail.c', '$2y$10$AaXiz1dz9erQmIZWwgwSJe7PMy.Scg.H80RtQc0EMmc6N/Oleq07q', 'Trainee', '', 'Active', 'Tayud', 'IT'),
(7, 'gastardo.johnlouie@gmail.com', '$2y$10$aLlu0ryhMb0LBmuL08fugupFtouQdU5Z5qnh79g.n3qUvYcRVb48a', 'Trainee', '', 'Active', 'Tayud', 'IT'),
(8, 'janlowi@gmail.com', '$2y$10$2lGgIMjgEO6x2tU.ahwfM.mdj9H3IudytG9pw2NlweIWAJYoN/tiC', 'Trainee', '', 'Active', 'NRA', 'IT'),
(9, 'gastardo@gmail.com', '$2y$10$Q/SnUEyPFW55ppxp8RANruWzuy8g8idhfhpyjWZBX1HadbkkFTBNu', 'Admin', '', 'Active', 'Tayud', 'IT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainee_id` (`user_id`);

--
-- Indexes for table `timesheet`
--
ALTER TABLE `timesheet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainee_id` (`user_id`);

--
-- Indexes for table `trainees`
--
ALTER TABLE `trainees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `timesheet`
--
ALTER TABLE `timesheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `trainees`
--
ALTER TABLE `trainees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `timesheet`
--
ALTER TABLE `timesheet`
  ADD CONSTRAINT `timesheet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `trainees`
--
ALTER TABLE `trainees`
  ADD CONSTRAINT `trainees_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
