-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 30, 2020 at 02:36 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catseg`
--

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `name`, `status`) VALUES
(1, 'Who Lost Roger', 0),
(2, 'Puzzle Master', 0);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `name`, `status`) VALUES
(1, 'Ironside State School', 0),
(2, 'Holy Family Primary School', 0),
(3, 'St Ignatius School', 0),
(4, 'West End State School', 0),
(5, 'Toowong State School', 0),
(6, 'St Ita\'s Regional Primary School', 0),
(7, 'Dutton Park State School', 0),
(8, 'Milton State School', 0),
(9, 'Petrie Terrace State School', 0),
(10, 'Brisbane Central State School', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(10) UNSIGNED NOT NULL,
  `school` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(10) NOT NULL,
  `lastname` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nickname` varchar(10) DEFAULT NULL,
  `pwd` varchar(10) NOT NULL,
  `grade` int(1) UNSIGNED NOT NULL,
  `class` varchar(1) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `school`, `firstname`, `lastname`, `username`, `nickname`, `pwd`, `grade`, `class`, `status`) VALUES
(1, 1, 'German', 'Shephard', 'cleverpuppy', 'puppy', 'GS1234', 6, 'E', 0),
(2, 1, 'Daniel', 'Radcliffe', 'mercyHEALPLS', 'Dan', 'DR1111', 6, 'E', 0),
(3, 1, 'Trevor', 'MacDonald', 'fortnite3', 'Trev', 'TM0987', 6, 'E', 0),
(4, 1, 'Rebecca', 'Cooper', 'sunshinegal08', 'Becky', 'Bec0808', 6, 'E', 0),
(5, 1, 'Bob', 'Keller', 'bobbyBOB', 'bob', 'Bob6666', 6, 'E', 0),
(6, 1, 'Cheryl', 'Tan', 'Dreamland', 'barbie', 'Ct0123', 6, 'E', 0),
(7, 1, 'Ariel', 'Melton', 'schoolsux111', NULL, 'Am4567', 6, 'E', 0),
(8, 1, 'Steven', 'McCoy', 'ihatevapour', 'steve', 'Sm8888', 6, 'E', 0),
(9, 1, 'Reggie', 'Mantle', 'MasterR', NULL, 'Rm6753', 6, 'F', 0),
(10, 1, 'Clay', 'Jensen', 'DJCJ', 'clay', 'Cj5548', 6, 'F', 0),
(11, 1, 'Nora', 'Walker', 'princessNora', NULL, 'Nw25796', 6, 'F', 0),
(12, 1, 'Winston', 'Williams', '', NULL, 'Wwh7654', 6, 'F', 0),
(13, 1, 'Reena', 'Dawn', 'rainbowD', 'nana', '1867rD', 6, 'F', 0),
(14, 1, 'Diego', 'Torres', 'CaptainD', 'DD', '9754Dd', 6, 'F', 0),
(15, 1, 'Ani', 'Achola', 'ocean8', 'ani', 'Ani2190', 6, 'F', 0),
(16, 1, 'Martin', 'Addison', 'hackerMA', 'Ad', '67856290Mh', 6, 'F', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_progress`
--

CREATE TABLE `student_progress` (
  `id` int(11) NOT NULL,
  `game` int(10) UNSIGNED NOT NULL,
  `student` int(10) UNSIGNED NOT NULL,
  `percentage` int(3) NOT NULL,
  `score` int(6) NOT NULL,
  `level` int(2) NOT NULL,
  `rank` int(2) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_progress`
--

INSERT INTO `student_progress` (`id`, `game`, `student`, `percentage`, `score`, `level`, `rank`, `status`) VALUES
(1, 1, 4, 60, 40202, 10, 1, 0),
(2, 1, 5, 53, 40015, 10, 2, 0),
(3, 1, 3, 47, 30926, 10, 3, 0),
(4, 1, 1, 40, 30878, 9, 4, 0),
(5, 1, 7, 39, 30000, 8, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(10) UNSIGNED NOT NULL,
  `school` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(10) NOT NULL,
  `lastname` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `school`, `firstname`, `lastname`, `username`, `pwd`, `status`) VALUES
(1, 1, 'Santana', 'Lopez', 'mrsapplepie', 'SLa6680095', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_progress`
--

CREATE TABLE `teacher_progress` (
  `id` int(11) NOT NULL,
  `game` int(10) UNSIGNED NOT NULL,
  `teacher` int(10) UNSIGNED NOT NULL,
  `percentage` int(3) NOT NULL,
  `score` int(5) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_progress`
--

INSERT INTO `teacher_progress` (`id`, `game`, `teacher`, `percentage`, `score`, `status`) VALUES
(1, 1, 1, 100, 49782, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `school` (`school`);

--
-- Indexes for table `student_progress`
--
ALTER TABLE `student_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game` (`game`),
  ADD KEY `student` (`student`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `school` (`school`);

--
-- Indexes for table `teacher_progress`
--
ALTER TABLE `teacher_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game` (`game`),
  ADD KEY `teacher` (`teacher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `student_progress`
--
ALTER TABLE `student_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_progress`
--
ALTER TABLE `teacher_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_school` FOREIGN KEY (`school`) REFERENCES `school` (`id`);

--
-- Constraints for table `student_progress`
--
ALTER TABLE `student_progress`
  ADD CONSTRAINT `fk_game` FOREIGN KEY (`game`) REFERENCES `game` (`id`),
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`student`) REFERENCES `student` (`id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `fk_school2` FOREIGN KEY (`school`) REFERENCES `school` (`id`);

--
-- Constraints for table `teacher_progress`
--
ALTER TABLE `teacher_progress`
  ADD CONSTRAINT `fk_game2` FOREIGN KEY (`game`) REFERENCES `game` (`id`),
  ADD CONSTRAINT `fk_teacher` FOREIGN KEY (`teacher`) REFERENCES `teacher` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
