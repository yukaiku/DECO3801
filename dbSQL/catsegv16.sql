-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 16, 2020 at 08:21 AM
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
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `recordId` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` datetime NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`recordId`, `studentId`, `teacherId`, `message`, `timestamp`, `status`) VALUES
(38, 24, 5, 'student1', '2020-10-08 21:18:09', 0),
(39, 24, 5, 'student1', '2020-10-08 21:18:16', 0),
(40, 24, 5, 'student2', '2020-10-08 21:18:21', 0),
(41, 24, 5, 'student1', '2020-10-08 21:18:38', 0),
(42, 24, 5, 'student1', '2020-10-08 21:22:33', 0),
(43, 24, 5, 'student1', '2020-10-08 21:24:40', 0),
(46, 24, 5, 'teacher1', '2020-10-08 22:07:51', 1),
(47, 24, 5, 'teachertoo', '2020-10-08 22:25:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `friendship`
--

CREATE TABLE `friendship` (
  `id` int(11) NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `friend` int(10) UNSIGNED NOT NULL,
  `relationship` int(1) NOT NULL COMMENT '0 is for student to student relationship, 1 is for student to teacher relationship',
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friendship`
--

INSERT INTO `friendship` (`id`, `user`, `friend`, `relationship`, `status`) VALUES
(8, 24, 25, 0, 0),
(9, 26, 24, 0, 0),
(10, 26, 24, 0, 0);

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
(1, 1, 'German', 'Shephard', 'cleverpuppy', 'puppy', '', '#JóQ¼R!\Z¯°Åà¿A¼', 5, 'E', '0000-00-00 00:00:00', 0),
(2, 1, 'Daniel', 'Radcliffe', 'mercyHEALPLS', 'Dan', '', 'DR1111', 6, 'E', '0000-00-00 00:00:00', 0),
(3, 1, 'Trevor', 'MacDonald', 'fortnite3', 'Trev', '', 'TM0987', 6, 'E', '0000-00-00 00:00:00', 0),
(4, 1, 'Rebecca', 'Cooper', 'sunshinegal08', 'Becky', '', 'Bec0808', 6, 'E', '0000-00-00 00:00:00', 0),
(6, 1, 'Cheryl', 'Tan', 'Dreamland', 'barbie', '', 'Ct0123', 6, 'E', '0000-00-00 00:00:00', 0),
(7, 1, 'Ariel', 'Melton', 'schoolsux111', NULL, '', 'Am4567', 6, 'E', '0000-00-00 00:00:00', 0),
(8, 1, 'Steven', 'McCoy', 'ihatevapour', 'steve', '', 'Sm8888', 6, 'E', '0000-00-00 00:00:00', 0),
(9, 1, 'Reggie', 'Mantle', 'MasterR', NULL, '', 'Rm6753', 6, 'F', '0000-00-00 00:00:00', 0),
(10, 1, 'Clay', 'Jensen', 'DJCJ', 'clay', '', 'Cj5548', 6, 'F', '0000-00-00 00:00:00', 0),
(11, 1, 'Nora', 'Walker', 'princessNora', NULL, '', 'Nw25796', 6, 'F', '0000-00-00 00:00:00', 0),
(12, 1, 'Winston', 'Williams', '', NULL, '', 'Wwh7654', 6, 'F', '0000-00-00 00:00:00', 0),
(13, 1, 'Reena', 'Dawn', 'rainbowD', 'nana', '', '1867rD', 6, 'F', '0000-00-00 00:00:00', 0),
(14, 1, 'Diego', 'Torres', 'CaptainD', 'DD', '', '9754Dd', 6, 'F', '0000-00-00 00:00:00', 0),
(15, 1, 'Ani', 'Achola', 'ocean8', 'ani', '', ')`§1´îHüî\0¸Ôœ`', 6, 'F', '0000-00-00 00:00:00', 0),
(16, 1, 'Martin', 'Addison', 'hackerMA', 'Ad', '', '67856290Mh', 6, 'F', '0000-00-00 00:00:00', 0),
(19, 1, 'theo3', 'theo3', 'theo', 'theo', '19_1600075204.jpg', 'z³Œøç¿÷êl#Wø', 6, 'E', '2020-09-21 19:55:04', 0),
(21, 1, 'theotheo', 'theotheo', 'theodore', 'Theo', '21_1600074771.jpg', 'N§U2Z\"„”\nÁ%Ý\Zó »', 1, 'B', '2020-09-13 05:37:34', 0),
(22, 1, 'theotheo', 'theotheo', 'theodore2', NULL, 'dummy.jpg', '\nk5­}ÝÎªUIºr<õW4ñÛpù‘o*¯Ñ', 1, 'B', '2020-09-13 05:38:13', 0),
(23, 1, 'theo', 'theo', 'theo3', 'theo3', 'dummy.jpg', 'z³Œøç¿÷êl#Wø', 6, 'F', '2020-09-21 18:43:41', 0),
(24, 1, 'studentfirstname1', 'studentlastname1', 'student1', 'student1', 'dummy.jpg', '×.tâé«04¸ŠÚ®oõ	', 6, 'F', '2020-10-08 21:25:17', 0),
(25, 1, 'studentfirstname2', 'studentlastname2', 'student2', 'student2', 'dummy.jpg', 'o[$	{çk„?2Dý«V-', 6, 'F', '2020-09-21 18:43:41', 0),
(26, 1, 'studentfirstname3', 'studentlastname3', 'student3', 'student3', 'dummy.jpg', 'È­òCi…Ykm#V)', 6, 'F', '2020-09-21 20:41:56', 0),
(27, 1, 'Tania', 'McIntosh', 'mum', NULL, 'dummy.jpg', '”$%!\rûr\néºnAH¤HC<Šn/°q¡\rL«{H¿', 9, 'H', '2020-09-23 16:31:02', 0),
(28, 1, 'arnold', 'schwarz', '1232', NULL, 'dummy.jpg', 'å	á’¸“JUøQé\\·', 1, 'A', '2020-09-24 15:12:32', 0),
(29, 1, 'vk', 'j', 'jvk', NULL, 'dummy.jpg', 'µ*ÇXåhwJÝ¶•ßzýs\Zl`œN=š€2ùØ7Ùd', 7, 'B', '2020-09-27 17:01:45', 0),
(30, 1, 'Fion', 'Jong', 'ApplePIE', NULL, 'dummy.jpg', '¯^ÿsn„µ…íáa<;8&	7_ŸCï|¶-«<ìCÒ€', 6, 'E', '2020-09-27 17:09:10', 0),
(31, 1, 'Briana', 'Briana', 'Br792', NULL, 'dummy.jpg', ')‡¡|¹…lYû‘µ·-í', 9, 'F', '2020-09-28 11:36:02', 0),
(32, 1, 'test1', 'test1', 'test1', NULL, NULL, 'Tbˆ	¬Ó>ûç“„ÒÞ)', 1, 'A', '2020-10-12 03:48:34', 0),
(35, 1, 'test2', 'test2', 'test2', NULL, NULL, 'Ü\\mÌ®iOJŠk5•u“S', 2, 'B', '2020-10-12 03:50:10', 0),
(36, 1, 'test3', 'test3', 'test3', NULL, NULL, '¢€6ÝÙ]@.·ŒÁ±(', 3, 'C', '2020-10-12 03:50:10', 0),
(37, 1, 'test4', 'test4', 'test4', NULL, NULL, 'ËjÇ‚Æ®ü*(ÏÍ>', 4, 'D', '2020-10-12 03:50:10', 0),
(38, 1, 'test5', 'test5', 'test5', NULL, NULL, 'Ã†Ék˜fq?\0V±lgÓéc', 5, 'E', '2020-10-12 03:50:10', 0),
(39, 1, 'test6', 'test6', 'test6', NULL, NULL, '`b1)’|üÈ1¤“†¬£\0', 6, 'F', '2020-10-12 03:50:10', 0);

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
(5, 1, 'teacherF', 'teacherL', 'teacher1', '3_1599974146.jpg', 'fñ`¡Â7äZOäS•¡', '2020-10-14 01:34:47', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_progress`
--

INSERT INTO `teacher_progress` (`id`, `game`, `teacher`, `percentage`, `score`, `status`) VALUES
(1, 1, 1, 100, 49782, 0);

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
(7, 0, 11, 1, 100, '22', 'asda|asa|asa', '0000-00-00 00:00:00', 0),
(8, 24, 15, 1, 100, '', '', '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`recordId`);

--
-- Indexes for table `friendship`
--
ALTER TABLE `friendship`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`,`friend`);

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
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `recordId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `friendship`
--
ALTER TABLE `friendship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `recordid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
