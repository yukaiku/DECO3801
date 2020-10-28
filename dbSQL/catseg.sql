-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 26, 2020 at 04:41 AM
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
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `message` longtext NOT NULL,
  `timeStamp` datetime NOT NULL,
  `teacherId` int(11) NOT NULL,
  `announcementType` varchar(3) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `message`, `timeStamp`, `teacherId`, `announcementType`, `status`) VALUES
(1, 'test', 'testh', '2020-10-20 02:33:21', 5, '0', 0),
(15, 'test', '6emessage', '2020-10-26 00:43:12', 5, '6E', 0);

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `id` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` datetime NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`id`, `studentId`, `teacherId`, `message`, `timestamp`, `status`) VALUES
(38, 24, 5, 'student1', '2020-10-08 21:18:09', 0),
(39, 24, 5, 'student1', '2020-10-08 21:18:16', 0),
(40, 24, 5, 'student2', '2020-10-08 21:18:21', 0),
(41, 24, 5, 'student1', '2020-10-08 21:18:38', 0),
(42, 24, 5, 'student1', '2020-10-08 21:22:33', 0),
(43, 24, 5, 'student1', '2020-10-08 21:24:40', 0),
(46, 24, 5, 'teacher1', '2020-10-08 22:07:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `genre` text NOT NULL,
  `grade` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `name`, `subject`, `description`, `genre`, `grade`, `status`) VALUES
(1, 'Who Lost Roger', 'English', 'Your name is Roger ... that\'s all you know. You wake up in an unknown room, and you don\'t know who you are, or where you came from. The house you are in has a weird vibe, and you need to find out who you are, and escape the house before it\'s too late ...', 'Thriller, Hidden Objects', 6, 0),
(2, 'Puzzle Master', 'Mathematics', 'Stuff', 'Mystery', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nickname` varchar(20) DEFAULT NULL,
  `profileImage` varchar(100) DEFAULT NULL,
  `pwd` varchar(100) NOT NULL,
  `grade` int(1) UNSIGNED NOT NULL,
  `class` varchar(1) NOT NULL,
  `lastactivity` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `school`, `firstname`, `lastname`, `username`, `nickname`, `profileImage`, `pwd`, `grade`, `class`, `lastactivity`, `status`) VALUES
(24, 1, 'studentfirstname1', 'studentlastname1', 'student1', 'student1', 'dummy.jpg', '×.tâé«04¸ŠÚ®oõ	', 6, 'F', '2020-10-26 00:48:24', 0),
(25, 1, 'studentfirstname2', 'studentlastname2', 'student2', 'student2', 'dummy.jpg', 'o[$	{çk„?2Dý«V-', 6, 'F', '2020-09-21 18:43:41', 0),
(26, 1, 'studentfirstname3', 'studentlastname3', 'student3', 'student3', 'dummy.jpg', 'È­òCi…Ykm#V)', 6, 'F', '2020-10-17 01:14:21', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_progress`
--

INSERT INTO `student_progress` (`id`, `game`, `student`, `percentage`, `score`, `level`, `rank`, `status`) VALUES
(1, 1, 4, 60, 40202, 10, 1, 0),
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
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `profileImage` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `lastactivity` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `school`, `firstname`, `lastname`, `username`, `profileImage`, `pwd`, `lastactivity`, `status`) VALUES
(1, 1, 'Santana', 'Lopez', 'mrsapplepie', '', 'AES_ENCRYPT(\'mrsapplepie\',\'deco2800\')', '0000-00-00 00:00:00', 0),
(3, 1, 'Santana', 'Lopez Sir', 'mrapplepie2', '3_1600070135.jpg', 'AD(Áážzïð2\"%Ü˜T\\', '0000-00-00 00:00:00', 0),
(4, 1, 'Theodoric', 'Theo', 'mrtheo', '3_1599974146.jpg', 'kO“7[»ì%~ñ:c{', '0000-00-00 00:00:00', 0),
(5, 1, 'teacherF', 'teacherL', 'teacher1', '3_1599974146.jpg', 'fñ`¡Â7äZOäS•¡', '2020-10-26 03:41:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `who_lost_roger`
--

CREATE TABLE `who_lost_roger` (
  `recordid` int(11) NOT NULL,
  `studentid` int(10) NOT NULL,
  `score` int(6) NOT NULL,
  `level` int(2) NOT NULL,
  `percentage` int(3) NOT NULL,
  `timeUsed` varchar(3) NOT NULL COMMENT '0~999 seconds',
  `nounsClicked` text NOT NULL COMMENT 'nouns1|nouns2|...',
  `dateTime` datetime NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `who_lost_roger`
--

INSERT INTO `who_lost_roger` (`recordid`, `studentid`, `score`, `level`, `percentage`, `timeUsed`, `nounsClicked`, `dateTime`, `status`) VALUES
(10, 24, 13, 1, 100, '9', 'Spume|Carafe|Swan|Memoir|Marigold|Cloud|Futon|Framed Art|Valise', '2020-10-16 20:26:15', 0),
(11, 25, 13, 2, 100, '9', 'Spume|Carafe|Swan|Memoir|Marigold|Cloud|Futon|Framed Art', '2020-09-17 20:26:15', 0),
(12, 25, 14, 1, 100, '9', 'Spume|Carafe|Swan|Memoir|Marigold|Cloud|Futon|Framed Art', '2020-10-16 20:26:15', 0),
(13, 25, 12, 2, 100, '9', 'Spume|Carafe|Swan|Memoir|Marigold|Cloud|Futon|Framed Art|Valise', '2020-10-16 20:26:15', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `who_lost_roger`
--
ALTER TABLE `who_lost_roger`
  ADD PRIMARY KEY (`recordid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `student_progress`
--
ALTER TABLE `student_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teacher_progress`
--
ALTER TABLE `teacher_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `who_lost_roger`
--
ALTER TABLE `who_lost_roger`
  MODIFY `recordid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
