-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 13, 2023 at 04:11 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CS-IA`
--

-- --------------------------------------------------------

--
-- Table structure for table `Counsellors`
--

CREATE TABLE `Counsellors` (
  `id` int(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `schoolemail` varchar(320) NOT NULL,
  `personalemail` varchar(320) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(10) NOT NULL,
  `address` varchar(500) NOT NULL,
  `school` varchar(500) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `profileimage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Counsellors`
--

INSERT INTO `Counsellors` (`id`, `firstname`, `middlename`, `lastname`, `schoolemail`, `personalemail`, `dob`, `sex`, `address`, `school`, `phone`, `password`, `profileimage`) VALUES
(3, 'Stan', 'Karel', 'Sousek', 'stanislav_sousek@swa-jkt.com', 'stan@gmail.com', '1990-01-01', 'male', 'Jakarta', 'Sinarmas World Academy', '7499567233', '$2y$10$QdD3dcqpE7VdDcMDTwd6kO33NoPewLBls8m6kyBFXApnX6bfkC.c6', 'poiuytrewq'),
(5, '', '', '', 'counsellor2@myschool.com', '', '0000-00-00', '', '', '', '', '$2y$10$oC6UXOtiKg.FpJHPBVxFlOefllHPHJThTnl5LqOT0VIlNGfK1J53S', '');

-- --------------------------------------------------------

--
-- Table structure for table `Documents`
--

CREATE TABLE `Documents` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `filepath` text NOT NULL,
  `fromuserid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Documents`
--

INSERT INTO `Documents` (`id`, `userid`, `filepath`, `fromuserid`) VALUES
(1, 2, 'documents/College Essay #1.txt', 2),
(2, 2, 'documents/College Essay #2.txt', 2),
(3, 3, 'documents/College Essay #4.txt', 3),
(4, 4, 'documents/College Essay #1.txt', 4),
(5, 1, 'documents/College Essay #1.txt', 1),
(6, 1, 'documents/College Essay #2.txt', 1),
(7, 1, 'documents/My resume.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Events`
--

CREATE TABLE `Events` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `title` text NOT NULL,
  `days` int(11) NOT NULL,
  `color` text NOT NULL,
  `creatorid` int(11) NOT NULL,
  `receiverid` int(11) NOT NULL,
  `receivertype` text NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Events`
--

INSERT INTO `Events` (`id`, `date`, `title`, `days`, `color`, `creatorid`, `receiverid`, `receivertype`, `info`) VALUES
(1, '2023-01-30', 'Upload all transcripts', 1, 'red', 3, 3, 'Counsellors', ''),
(2, '2023-01-20', 'Finish recs', 1, 'blue', 3, 3, 'Counsellors', ''),
(3, '2023-03-01', 'Double check applications', 1, 'yellow', 3, 3, 'Counsellors', ''),
(4, '2023-03-24', 'Check UK apps', 1, 'red', 3, 3, 'Counsellors', ''),
(5, '2023-03-10', 'Finalize recommendation', 1, 'blue', 3, 3, 'Counsellors', ''),
(6, '2023-03-14', 'Finish recommendations', 1, 'yellow', 3, 3, 'Counsellors', '');

-- --------------------------------------------------------

--
-- Table structure for table `Logins`
--

CREATE TABLE `Logins` (
  `loginid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `usertype` text NOT NULL,
  `logintime` text NOT NULL,
  `logouttime` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Logins`
--

INSERT INTO `Logins` (`loginid`, `userid`, `usertype`, `logintime`, `logouttime`) VALUES
(1, 1, 'student', '2022-12-28,12:37:10', '2022-12-29,09:36:45'),
(2, 1, 'student', '2022-12-28,12:37:49', '2022-12-28,12:40:26'),
(3, 2, 'student', '2022-12-28,12:38:18', '2022-12-28,12:39:58'),
(4, 2, 'student', '2022-12-28,12:43:38', '2022-12-29,09:39:24'),
(5, 1, 'student', '2022-12-29,09:39:35', '2022-12-29,10:40:01'),
(6, 1, 'student', '2022-12-29,10:40:27', '2023-01-01,01:53:05'),
(7, 1, 'student', '2023-01-01,01:57:01', '2023-01-01,02:57:22'),
(8, 1, 'student', '2023-01-01,02:57:38', '2023-01-01,03:57:46'),
(9, 1, 'student', '2023-01-01,03:57:56', '2023-01-01,07:15:56'),
(10, 1, 'student', '2023-01-01,07:17:29', '2023-01-01,08:27:45'),
(11, 1, 'student', '2023-01-01,08:27:52', '2023-01-01,09:28:21'),
(12, 1, 'student', '2023-01-01,09:28:28', '2023-01-01,10:44:02'),
(13, 1, 'student', '2023-01-01,10:44:17', '2023-01-01,11:50:23'),
(14, 1, 'student', '2023-01-01,11:50:29', '2023-01-02,12:00:37'),
(15, 1, 'student', '2023-01-02,12:00:46', '2023-01-02,10:22:02'),
(16, 1, 'student', '2023-01-02,10:22:18', '2023-01-02,11:22:23'),
(17, 1, 'student', '2023-01-02,11:22:29', '2023-01-02,01:22:31'),
(18, 1, 'student', '2023-01-02,01:22:39', '2023-01-02,04:07:37'),
(19, 1, 'student', '2023-01-02,04:07:44', '2023-01-02,05:13:31'),
(20, 1, 'student', '2023-01-02,05:13:36', '2023-01-02,06:34:47'),
(21, 1, 'student', '2023-01-02,06:34:53', '2023-01-02,07:44:14'),
(22, 1, 'student', '2023-01-02,07:44:19', '2023-01-02,07:50:21'),
(23, 1, 'student', '2023-01-02,07:50:30', '2023-01-02,07:58:26'),
(24, 4, 'teacher', '2023-01-02,07:59:29', '2023-01-02,09:34:39'),
(25, 1, 'teacher', '2023-01-02,08:11:18', '2023-01-02,08:32:41'),
(26, 1, 'student', '2023-01-02,08:32:50', '2023-01-02,08:33:04'),
(27, 1, 'teacher', '2023-01-02,08:33:15', '2023-01-02,08:56:00'),
(28, 1, 'student', '2023-01-02,08:56:08', '2023-01-02,08:56:18'),
(29, 1, 'teacher', '2023-01-02,08:56:29', '2023-01-02,08:56:35'),
(30, 3, 'counsellor', '2023-01-02,09:34:39', '2023-01-02,10:36:48'),
(31, 3, 'counsellor', '2023-01-03,09:50:50', '2023-01-03,10:51:34'),
(32, 3, 'counsellor', '2023-01-03,10:51:41', '2023-01-03,11:14:33'),
(33, 2, 'student', '2023-01-03,11:14:55', '2023-01-03,11:25:10'),
(34, 3, 'counsellor', '2023-01-03,11:25:19', '2023-01-03,11:31:56'),
(35, 1, 'teacher', '2023-01-03,11:32:12', '2023-01-03,11:32:21'),
(36, 3, 'counsellor', '2023-01-03,11:32:49', '2023-01-03,02:05:01'),
(37, 3, 'counsellor', '2023-01-03,02:05:14', '2023-01-03,06:58:05'),
(38, 3, 'counsellor', '2023-01-03,06:58:12', '2023-01-04,07:45:02'),
(39, 3, 'counsellor', '2023-01-04,07:45:02', '2023-01-04,07:47:49'),
(40, 1, 'student', '2023-01-04,07:47:56', '2023-01-04,07:49:35'),
(41, 3, 'counsellor', '2023-01-04,07:49:44', '2023-01-04,07:50:20'),
(42, 1, 'teacher', '2023-01-04,07:50:28', '2023-01-04,07:52:27'),
(43, 1, 'teacher', '2023-01-04,07:52:42', '2023-01-04,07:53:01'),
(44, 3, 'counsellor', '2023-01-04,07:55:01', '2023-01-04,08:55:18'),
(45, 3, 'counsellor', '2023-01-04,08:56:09', '2023-01-06,10:20:24'),
(46, 3, 'counsellor', '2023-01-06,10:20:24', '2023-01-06,11:20:39'),
(47, 3, 'counsellor', '2023-01-06,11:20:47', '2023-01-06,11:53:26'),
(48, 3, 'counsellor', '2023-01-07,09:57:18', '2023-01-07,10:59:54'),
(49, 1, 'student', '2023-01-07,11:00:00', '2023-01-07,11:10:48'),
(50, 3, 'counsellor', '2023-01-07,11:10:54', '2023-01-07,11:40:54'),
(51, 1, 'student', '2023-01-07,12:37:38', '2023-01-07,12:37:41'),
(52, 3, 'counsellor', '2023-01-07,12:37:47', '2023-01-07,12:38:11'),
(53, 3, 'counsellor', '2023-01-07,12:38:30', '2023-01-07,12:38:52'),
(54, 1, 'student', '2023-01-07,12:38:58', '2023-01-07,12:49:44'),
(55, 3, 'counsellor', '2023-01-07,12:49:50', '2023-01-07,12:49:53'),
(56, 3, 'counsellor', '2023-01-09,12:00:16', '2023-01-10,08:55:59'),
(57, 2, 'student', '2023-01-09,11:14:39', '2023-01-09,11:15:01'),
(58, 3, 'student', '2023-01-09,11:15:21', '2023-01-09,11:15:34'),
(59, 4, 'student', '2023-01-09,11:16:00', '2023-01-09,11:16:03'),
(60, 5, 'student', '2023-01-09,11:16:22', '2023-01-09,11:16:24'),
(61, 6, 'student', '2023-01-09,11:16:44', '2023-01-09,11:16:46'),
(62, 7, 'student', '2023-01-09,11:16:55', '2023-01-09,11:16:56'),
(63, 8, 'student', '2023-01-09,11:17:16', '2023-01-09,11:17:17'),
(64, 9, 'student', '2023-01-09,11:17:32', '2023-01-09,11:17:34'),
(65, 10, 'student', '2023-01-09,11:17:56', '2023-01-09,11:17:58'),
(66, 11, 'student', '2023-01-09,11:18:12', '2023-01-09,11:18:13'),
(67, 3, 'counsellor', '2023-01-09,11:20:15', '2023-01-09,11:24:18'),
(68, 3, 'counsellor', '2023-01-10,08:55:59', '2023-01-10,08:58:08'),
(69, 1, 'teacher', '2023-01-10,08:58:42', '2023-01-10,09:00:28'),
(70, 1, 'student', '2023-01-10,09:00:39', '2023-01-10,09:05:46'),
(71, 2, 'student', '2023-01-10,09:06:13', '2023-01-10,09:08:44'),
(72, 2, 'teacher', '2023-01-10,09:08:59', '2023-01-10,07:42:11'),
(73, 2, 'teacher', '2023-01-10,09:09:13', '2023-01-10,09:10:04'),
(74, 4, 'teacher', '2023-01-10,09:10:17', '2023-01-10,09:10:22'),
(75, 1, 'student', '2023-01-10,09:10:36', '2023-01-10,09:10:43'),
(76, 2, 'student', '2023-01-10,09:11:02', '2023-01-10,09:12:16'),
(77, 3, 'student', '2023-01-10,09:13:05', '2023-01-10,09:13:27'),
(78, 4, 'student', '2023-01-10,09:13:47', '2023-01-10,09:46:16'),
(79, 3, 'counsellor', '2023-01-10,07:42:11', '2023-01-10,07:55:21'),
(80, 4, 'student', '2023-01-10,07:55:30', '2023-01-10,07:55:41'),
(81, 1, 'student', '2023-01-10,08:12:24', '2023-01-10,08:17:40'),
(82, 3, 'counsellor', '2023-01-10,08:17:46', '2023-01-10,08:18:12'),
(83, 1, 'student', '2023-01-11,07:59:24', '2023-01-11,08:00:02'),
(84, 3, 'teacher', '2023-01-11,08:00:53', '2023-01-11,08:03:18'),
(85, 3, 'counsellor', '2023-01-11,08:03:25', '2023-01-11,08:04:52'),
(86, 3, 'counsellor', '2023-01-11,11:36:57', '2023-01-11,11:40:31'),
(87, 2, 'student', '2023-01-11,11:40:51', '2023-01-11,11:42:39'),
(88, 2, 'teacher', '2023-01-11,11:42:52', '2023-01-11,11:43:01'),
(89, 1, 'teacher', '2023-01-11,11:43:12', '2023-01-11,11:43:45'),
(90, 1, 'student', '2023-01-11,11:43:52', '2023-01-11,12:00:58'),
(91, 5, 'counsellor', '2023-01-11,09:29:12', '2023-01-11,09:32:49'),
(92, 1, 'student', '2023-01-11,09:35:31', '2023-01-11,10:40:42'),
(93, 5, 'counsellor', '2023-01-11,10:41:28', '2023-01-11,10:51:45'),
(94, 3, 'teacher', '2023-01-11,10:51:55', '2023-01-23,08:49:01'),
(95, 3, 'counsellor', '2023-01-23,08:49:01', '2023-01-28,09:21:12'),
(96, 1, 'student', '2023-01-28,09:21:12', '2023-01-28,09:21:51'),
(97, 3, 'counsellor', '2023-01-28,09:21:58', '2023-01-28,09:22:11'),
(98, 3, 'teacher', '2023-01-28,09:22:19', '2023-01-29,12:06:23'),
(99, 1, 'student', '2023-01-29,12:06:29', '2023-01-30,10:18:42'),
(100, 1, 'student', '2023-01-30,10:18:42', '2023-01-30,10:25:00'),
(101, 3, 'teacher', '2023-01-30,10:25:19', '2023-01-30,10:26:16'),
(102, 1, 'student', '2023-01-30,10:26:23', '2023-01-30,10:26:32'),
(103, 3, 'counsellor', '2023-01-30,10:27:03', '2023-01-30,10:31:20'),
(104, 1, 'student', '2023-01-30,10:31:25', '2023-01-30,10:32:18'),
(105, 3, 'counsellor', '2023-01-30,10:32:26', '2023-01-30,11:38:20'),
(106, 1, 'student', '2023-01-30,10:35:08', '2023-01-30,11:38:20'),
(107, 1, 'student', '2023-01-30,11:29:02', '2023-01-30,11:29:08'),
(108, 3, 'counsellor', '2023-01-30,11:29:16', '2023-01-30,11:29:21'),
(109, 3, 'counsellor', '2023-01-30,11:38:20', '2023-01-30,09:12:49'),
(110, 3, 'counsellor', '2023-01-30,09:12:56', '2023-01-30,10:13:45'),
(111, 3, 'counsellor', '2023-01-30,10:14:11', '2023-01-30,11:15:36'),
(112, 1, 'student', '2023-01-30,11:15:42', '2023-02-08,09:50:52'),
(113, 1, 'student', '2023-02-13,10:42:42', '2023-02-13,10:43:02'),
(114, 3, 'counsellor', '2023-02-13,10:43:12', '2023-02-13,10:43:30'),
(115, 3, 'teacher', '2023-02-13,10:43:46', '2023-02-13,10:44:57'),
(116, 3, 'counsellor', '2023-02-13,10:45:05', '2023-02-13,10:46:30'),
(117, 1, 'student', '2023-02-13,10:46:36', '2023-02-13,10:46:53'),
(118, 3, 'teacher', '2023-02-13,10:47:12', '2023-02-13,10:47:34'),
(119, 1, 'student', '2023-02-13,10:47:44', '2023-03-01,09:06:00'),
(120, 1, 'student', '2023-03-01,09:06:00', '2023-03-04,02:23:40'),
(121, 3, 'counsellor', '2023-03-01,08:15:25', '2023-03-04,02:23:40'),
(122, 3, 'counsellor', '2023-03-04,02:23:39', '2023-03-04,03:04:38'),
(123, 5, 'student', '2023-03-04,03:04:48', '2023-03-04,03:05:04'),
(124, 6, 'student', '2023-03-04,03:05:22', '2023-03-04,03:05:53'),
(125, 7, 'student', '2023-03-04,03:06:07', '2023-03-04,03:06:20'),
(126, 8, 'student', '2023-03-04,03:06:28', '2023-03-04,03:06:46'),
(127, 9, 'student', '2023-03-04,03:07:03', '2023-03-04,03:07:20'),
(128, 10, 'student', '2023-03-04,03:07:29', '2023-03-04,06:39:12'),
(129, 10, 'student', '2023-03-04,06:39:30', '2023-03-04,06:40:49'),
(130, 1, 'student', '2023-03-04,06:40:55', '2023-03-04,06:41:50'),
(131, 3, 'counsellor', '2023-03-04,06:42:00', '2023-03-04,07:11:16'),
(132, 2, 'student', '2023-03-04,07:11:31', '2023-03-04,07:11:42'),
(133, 3, 'student', '2023-03-04,07:11:50', '2023-03-04,07:11:58'),
(134, 5, 'student', '2023-03-04,07:12:06', '2023-03-04,07:12:13'),
(135, 6, 'student', '2023-03-04,07:12:34', '2023-03-04,07:12:46'),
(136, 7, 'student', '2023-03-04,07:12:55', '2023-03-04,07:13:03'),
(137, 8, 'student', '2023-03-04,07:13:13', '2023-03-04,07:13:21'),
(138, 9, 'student', '2023-03-04,07:13:45', '2023-03-04,07:13:56'),
(139, 10, 'student', '2023-03-04,07:14:06', '2023-03-04,07:14:35'),
(140, 11, 'student', '2023-03-04,07:14:45', '2023-03-04,07:14:52'),
(141, 3, 'counsellor', '2023-03-04,07:14:59', '2023-03-04,07:15:06'),
(142, 2, 'teacher', '2023-03-04,07:15:22', '2023-03-04,07:16:27'),
(143, 3, 'teacher', '2023-03-04,07:16:34', '2023-03-04,07:17:07'),
(144, 1, 'teacher', '2023-03-04,07:17:15', '2023-03-04,07:17:49'),
(145, 3, 'counsellor', '2023-03-04,07:17:54', '2023-03-04,07:26:34'),
(146, 3, 'teacher', '2023-03-04,07:26:41', '2023-03-04,07:36:30'),
(147, 3, 'counsellor', '2023-03-04,07:36:36', '2023-03-04,07:36:48'),
(148, 3, 'teacher', '2023-03-04,07:36:55', '2023-03-04,08:37:32'),
(149, 3, 'teacher', '2023-03-04,08:37:40', '2023-03-05,11:46:28'),
(150, 2, 'student', '2023-03-05,11:51:03', '2023-03-05,05:30:31'),
(151, 2, 'student', '2023-03-05,06:13:20', '2023-03-05,06:13:31'),
(152, 12, 'student', '2023-03-05,06:15:09', ''),
(153, 12, 'student', '2023-03-05,06:19:31', '2023-03-05,06:48:55'),
(154, 2, 'student', '2023-03-05,06:21:30', '2023-03-05,06:21:42'),
(155, 1, 'student', '2023-03-05,06:27:43', '2023-03-05,06:27:49'),
(156, 1, 'student', '2023-03-05,06:30:22', '2023-03-05,06:39:27'),
(157, 2, 'teacher', '2023-03-05,06:39:35', '2023-03-05,06:41:07'),
(158, 1, 'student', '2023-03-05,06:41:13', '2023-03-05,06:41:42'),
(159, 3, 'counsellor', '2023-03-05,06:42:12', '2023-03-05,06:47:45'),
(160, 1, 'student', '2023-03-05,06:49:41', '2023-03-05,06:50:19'),
(161, 3, 'counsellor', '2023-03-05,06:50:32', '2023-03-05,06:52:43'),
(162, 1, 'student', '2023-03-05,06:52:58', '2023-03-05,06:53:52'),
(163, 3, 'counsellor', '2023-03-05,06:54:04', '2023-03-05,06:56:18'),
(164, 3, 'student', '2023-03-05,06:56:25', '2023-03-05,06:56:59'),
(165, 3, 'counsellor', '2023-03-05,06:57:10', '2023-03-05,07:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `Notifications`
--

CREATE TABLE `Notifications` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Notifications`
--

INSERT INTO `Notifications` (`id`, `userid`, `text`) VALUES
(1, 1, 'Remember your January deadlines! I will be uploading your transcripts soon.'),
(2, 2, 'Remember your January deadlines! I will be uploading your transcripts soon.'),
(3, 3, 'Remember your January deadlines! I will be uploading your transcripts soon.'),
(4, 4, 'Remember your January deadlines! I will be uploading your transcripts soon.'),
(5, 5, 'Remember your January deadlines! I will be uploading your transcripts soon.'),
(6, 6, 'Remember your January deadlines! I will be uploading your transcripts soon.'),
(7, 7, 'Remember your January deadlines! I will be uploading your transcripts soon.'),
(8, 8, 'Remember your January deadlines! I will be uploading your transcripts soon.'),
(9, 9, 'Remember your January deadlines! I will be uploading your transcripts soon.'),
(10, 10, 'Remember your January deadlines! I will be uploading your transcripts soon.'),
(11, 11, 'Remember your January deadlines! I will be uploading your transcripts soon.'),
(12, 1, 'write essays!'),
(13, 2, 'write essays!'),
(14, 3, 'write essays!'),
(15, 4, 'write essays!'),
(16, 5, 'write essays!'),
(17, 6, 'write essays!'),
(18, 7, 'write essays!'),
(19, 8, 'write essays!'),
(20, 9, 'write essays!'),
(21, 10, 'write essays!'),
(22, 11, 'write essays!'),
(23, 1, 'Remember you have deadlines!'),
(24, 1, 'your US deadlines are here'),
(25, 1, 'Please remember to finish all you university applications by Monday!'),
(26, 2, 'Please remember to finish all you university applications by Monday!'),
(27, 3, 'Please remember to finish all you university applications by Monday!'),
(28, 4, 'Please remember to finish all you university applications by Monday!'),
(29, 5, 'Please remember to finish all you university applications by Monday!'),
(30, 6, 'Please remember to finish all you university applications by Monday!'),
(31, 7, 'Please remember to finish all you university applications by Monday!'),
(32, 8, 'Please remember to finish all you university applications by Monday!'),
(33, 9, 'Please remember to finish all you university applications by Monday!'),
(34, 10, 'Please remember to finish all you university applications by Monday!'),
(35, 11, 'Please remember to finish all you university applications by Monday!'),
(36, 12, 'Please remember to finish all you university applications by Monday!'),
(37, 1, 'Please remember to finish all you university applications by Monday!'),
(38, 2, 'Please remember to finish all you university applications by Monday!'),
(39, 3, 'Please remember to finish all you university applications by Monday!'),
(40, 4, 'Please remember to finish all you university applications by Monday!'),
(41, 5, 'Please remember to finish all you university applications by Monday!'),
(42, 6, 'Please remember to finish all you university applications by Monday!'),
(43, 7, 'Please remember to finish all you university applications by Monday!'),
(44, 8, 'Please remember to finish all you university applications by Monday!'),
(45, 9, 'Please remember to finish all you university applications by Monday!'),
(46, 10, 'Please remember to finish all you university applications by Monday!'),
(47, 11, 'Please remember to finish all you university applications by Monday!'),
(48, 12, 'Please remember to finish all you university applications by Monday!'),
(49, 1, 'Please remember to finish all you university applications by Monday!'),
(50, 2, 'Please remember to finish all you university applications by Monday!'),
(51, 3, 'Please remember to finish all you university applications by Monday!'),
(52, 4, 'Please remember to finish all you university applications by Monday!'),
(53, 5, 'Please remember to finish all you university applications by Monday!'),
(54, 6, 'Please remember to finish all you university applications by Monday!'),
(55, 7, 'Please remember to finish all you university applications by Monday!'),
(56, 8, 'Please remember to finish all you university applications by Monday!'),
(57, 9, 'Please remember to finish all you university applications by Monday!'),
(58, 10, 'Please remember to finish all you university applications by Monday!'),
(59, 11, 'Please remember to finish all you university applications by Monday!'),
(60, 12, 'Please remember to finish all you university applications by Monday!'),
(61, 1, 'Remember to upload all you applications tomorrow'),
(62, 2, 'Remember to upload all you applications tomorrow'),
(63, 3, 'Remember to upload all you applications tomorrow'),
(64, 4, 'Remember to upload all you applications tomorrow'),
(65, 5, 'Remember to upload all you applications tomorrow'),
(66, 6, 'Remember to upload all you applications tomorrow'),
(67, 7, 'Remember to upload all you applications tomorrow'),
(68, 8, 'Remember to upload all you applications tomorrow'),
(69, 9, 'Remember to upload all you applications tomorrow'),
(70, 10, 'Remember to upload all you applications tomorrow'),
(71, 11, 'Remember to upload all you applications tomorrow'),
(72, 12, 'Remember to upload all you applications tomorrow');

-- --------------------------------------------------------

--
-- Table structure for table `Requests`
--

CREATE TABLE `Requests` (
  `id` int(11) NOT NULL,
  `fromuserid` int(11) NOT NULL,
  `touserid` int(11) NOT NULL,
  `filepath` text NOT NULL,
  `datesent` text NOT NULL,
  `datereceived` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Requests`
--

INSERT INTO `Requests` (`id`, `fromuserid`, `touserid`, `filepath`, `datesent`, `datereceived`) VALUES
(1, 2, 1, 'documents/Recommendation Letter #1.txt', '2023-01-10,09:08:32', '2023-03-04,07:17:20'),
(2, 2, 2, 'documents/Recommendation Letter #1.txt', '2023-01-10,09:11:33', '2023-03-04,07:15:47'),
(3, 2, 3, 'documents/Recommendation Letter #1.txt', '2023-01-10,09:11:37', '2023-03-04,07:16:41'),
(4, 3, 2, 'documents/Recommendation Letter #1.txt', '2023-01-10,09:13:24', '2023-03-04,07:15:53'),
(5, 4, 3, 'documents/Recommendation Letter #1.txt', '2023-01-10,09:46:13', '2023-01-11,08:01:37'),
(6, 1, 1, 'documents/Recommendation Letter #1.txt', '2023-01-11,07:59:55', '2023-01-11,11:43:41'),
(7, 1, 3, 'documents/Recommendation Letter #1.txt', '2023-01-11,08:00:00', '2023-01-30,10:26:08'),
(8, 3, 3, 'documents/Recommendation Letter #1.txt', '2023-03-04,07:11:54', '2023-03-04,07:16:46'),
(9, 5, 2, 'documents/Recommendation Letter #1.txt', '2023-03-04,07:12:10', '2023-03-04,07:15:58'),
(10, 6, 1, 'documents/Recommendation Letter #1.txt', '2023-03-04,07:12:38', '2023-03-04,07:17:26'),
(11, 6, 2, 'documents/Recommendation Letter #1.txt', '2023-03-04,07:12:42', '2023-03-04,07:16:03'),
(12, 6, 3, 'documents/Recommendation Letter #1.txt', '2023-03-04,07:12:45', '2023-03-04,07:16:51'),
(13, 7, 1, 'documents/Recommendation Letter #1.txt', '2023-03-04,07:12:59', '2023-03-04,07:17:30'),
(14, 7, 3, 'documents/Recommendation Letter #1.txt', '2023-03-04,07:13:02', '2023-03-04,07:16:55'),
(15, 8, 2, 'documents/Recommendation Letter #1.txt', '2023-03-04,07:13:17', '2023-03-04,07:16:07'),
(16, 8, 3, 'documents/Recommendation Letter #1.txt', '2023-03-04,07:13:20', '2023-03-04,07:16:58'),
(17, 9, 1, 'documents/Recommendation Letter #1.txt', '2023-03-04,07:13:48', '2023-03-04,07:17:34'),
(18, 9, 2, 'documents/Recommendation Letter #1.txt', '2023-03-04,07:13:51', '2023-03-04,07:16:15'),
(19, 9, 3, 'documents/Recommendation Letter #1.txt', '2023-03-04,07:13:55', '2023-03-04,07:17:02'),
(20, 10, 2, 'documents/Recommendation Letter #1.txt', '2023-03-04,07:14:26', '2023-03-04,07:16:24'),
(21, 10, 3, 'documents/Recommendation Letter #1.txt', '2023-03-04,07:14:30', '2023-03-04,07:17:06'),
(22, 10, 1, '', '2023-03-04,07:14:33', ''),
(23, 11, 1, 'documents/Recommendation Letter #1.txt', '2023-03-04,07:14:50', '2023-03-04,07:17:37'),
(24, 1, 2, 'documents/Recommendation Letter #1.txt', '2023-03-05,06:38:53', '2023-03-05,06:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `Status`
--

CREATE TABLE `Status` (
  `studentid` int(11) NOT NULL,
  `accepted` text NOT NULL,
  `rejected` text NOT NULL,
  `deferred` text NOT NULL,
  `pending` text NOT NULL,
  `attending` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Students`
--

CREATE TABLE `Students` (
  `id` int(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `middlename` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `schoolemail` varchar(320) NOT NULL,
  `personalemail` varchar(320) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `school` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `profileimage` text NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `grade` int(12) NOT NULL,
  `graduation` varchar(10) NOT NULL,
  `hlsubjects` varchar(300) NOT NULL,
  `slsubjects` varchar(300) NOT NULL,
  `hlscores` varchar(100) NOT NULL,
  `slscores` varchar(100) NOT NULL,
  `accomplishments` text NOT NULL,
  `activities` text NOT NULL,
  `sat` varchar(4) NOT NULL,
  `act` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Students`
--

INSERT INTO `Students` (`id`, `firstname`, `middlename`, `lastname`, `schoolemail`, `personalemail`, `dob`, `sex`, `address`, `school`, `phone`, `password`, `profileimage`, `citizenship`, `country`, `grade`, `graduation`, `hlsubjects`, `slsubjects`, `hlscores`, `slscores`, `accomplishments`, `activities`, `sat`, `act`) VALUES
(1, 'Ben', '', 'Dirga', '23joshuad@swa-jkt.com', 'abcdef@gmail.com', '2004-08-14', 'male', 'higgins', 'Higgins Highschool', '12349987', '$2y$10$YyAVZthceu00Su7DisYkqelZGra8sjlbgD249aKqLIKRBqSJ9Rq.W', 'resources/m1.jpg', 'Indonesia, USA', 'Indonesia', 12, '2023', 'Math, Physics, Computer Science', 'English, Chinese, Economics', '6, 7, 7', '7, 7, 5', '', 'Chess club', '1490', '32'),
(2, 'James', '', 'Jones', 'james@myschool.com', 'jamesj@gmail.com', '2005-03-03', 'male', 'Higgins', 'Higgins Highschool', '8111233456', '$2y$10$YyAVZthceu00Su7DisYkqelZGra8sjlbgD249aKqLIKRBqSJ9Rq.W', 'resources/s1.jpg', 'US', 'US', 12, '2023', 'Math, Physics, Computer Science', 'Business, Economics, English', '6, 6, 7', '7, 7, 6', '', '', '1500', '31'),
(3, 'Hannah', '', 'Hoston', 'hannah@myschool.com', '', '0000-00-00', 'female', '', 'Higgins Highschool', '', '$2y$10$hMyx.N89t9.oBaXd.Y0mQ.cyt/qjQXPrihGO.fBNKcN6Zz9nZCsje', 'resources/s6.jpg', 'US', 'US', 12, '2023', 'English, Chinese, Economics', 'Math, Business, Computer Science', '6, 5, 7', '6, 5, 7', '', '', '1390', '33'),
(4, 'Brian', '', 'Bazzinger', 'brian@myschool.com', '', '0000-00-00', 'male', '', 'Higgins Highschool', '', '$2y$10$yWK8Vh0/CqGXhkUUCbfQ/u7bq4WdxGegFKAoJg5O3QbuiFAIUHu2a', 'resources/s2.jpg', 'Australia', 'Australia', 12, '2023', 'Business, Math, English', 'Biology, Chinese, Physics', '7, 7, 7', '6, 6, 6', '', '', '1550', '30'),
(5, 'Jenny', '', 'Jules', 'jenny@myschool.com', '', '0000-00-00', 'female', '', 'Higgins Highschool', '', '$2y$10$UTBheh/hoWzfFACSvVSeEeDCEK8Fkwh5iiTLhFSlLH79sn4Vrc4/q', 'resources/s4.jpg', 'Australia', 'Australia', 12, '2023', 'Computer Science, Physics, Chinese', 'English, Math, Business', '7, 6, 6', '7, 6, 6', '', '', '1590', '28'),
(6, 'Cheng', '', 'Cong', 'cheng@myschool.com', '', '0000-00-00', 'male', '', 'Higgins Highschool', '', '$2y$10$CtIBIqvyBvNEVNd.h0XgkOwsYTFc9/I4oYjTE4ET9gEO4gmbLIat.', 'resources/s3.jpg', 'China', 'China', 12, '2023', 'Economics, Business, English', 'Math, Computer Science, Physics', '7, 5, 5', '7, 7, 7', '', '', '1490', '30'),
(7, 'Michelle', '', 'Marin', 'michelle@myschool.com', '', '0000-00-00', 'female', '', 'Higgins Highschool', '', '$2y$10$A6OlHr0V5nDj5r1OvOGDDOCgfgXq1PXBHzn/jRjpR71wk4qyUeCSG', 'resources/s5.jpg', 'China', 'China', 12, '2023', 'Math, Computer Science, Economics', 'English, Chinese, Business', '5, 6, 6', '6, 6, 7', '', '', '1500', '33'),
(8, 'Ahmad', '', 'Anand', 'ahmad@myschool.com', '', '0000-00-00', 'male', '', 'Higgins Highschool', '', '$2y$10$IVK965J/Xq62Tm7WWNzUOOXJx9Cl9/sd0rC0rIo4FGgo7w56dcjiC', 'resources/s7.jpg', 'Indonesia', 'Indonesia', 12, '2023', 'Chinese, Physics, Business', 'Math, Computer Science, English', '7, 7, 5', '6, 7, 6', '', '', '1470', '32'),
(9, 'Maria', '', 'Marlene', 'maria@myschool.com', '', '0000-00-00', 'female', '', 'Higgins Highschool', '', '$2y$10$Uifmcl1itboUuv.lmBOSN.KfSnZ89oJDlY4.C4Lv5uXYhyru3gQYa', 'resources/s8.jpg', 'Indonesia', 'Indonesia', 12, '2023', 'English, Math, Computer Science', 'Physics, Biology, Chinese', '6, 6, 6', '5, 5, 7', '', '', '1600', '27'),
(10, 'Charles', '', 'Campbell', 'charles@myschool.com', '', '0000-00-00', 'male', '', 'Higgins Highschool', '', '$2y$10$UIuKUS0LhMK4vm6uX8z4EuSii/WkVHUS1vv3/HoO2Z4KyF17znAda', 'resources/s10.jpg', 'UK', 'UK', 12, '2023', 'Economics, Chinese, Physics', 'Math, English, Computer Science', '6, 5, 5', '7, 7, 6', '', '', '1450', '26'),
(11, 'Chelsea', '', 'Carden', 'chelsea@myschool.com', '', '0000-00-00', 'female', '', 'Higgins Highschool', '', '$2y$10$iE27V7Qd1YqHyA2fDNbDDuJOe/RHn5DnbVQUlGBr.emed6/vWvYpK', 'resources/s9.jpg', 'UK', 'UK', 12, '2023', 'Business, English, Math', 'Chinese, Computer Science, Economics', '7, 5, 6', '7, 7, 7', '', '', '1460', '31'),
(12, '', '', '', 'person@myschool.com', '', '0000-00-00', '', '', '', '', '$2y$10$JGlvbBa0mMv6nAmx5nPtk.xzYWOGypsTp5S77toOtzxFmz9ajj32.', '', '', '', 0, '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `Teachers`
--

CREATE TABLE `Teachers` (
  `id` int(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `schoolemail` varchar(320) NOT NULL,
  `personalemail` varchar(320) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(10) NOT NULL,
  `address` varchar(500) NOT NULL,
  `school` varchar(500) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `profileimage` text NOT NULL,
  `subject` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Teachers`
--

INSERT INTO `Teachers` (`id`, `firstname`, `middlename`, `lastname`, `schoolemail`, `personalemail`, `dob`, `sex`, `address`, `school`, `phone`, `password`, `profileimage`, `subject`) VALUES
(1, 'Dover', '', 'Daniel', 'dover@myschool.com', '', '0000-00-00', '', '', 'Higgins Highschool', '', '$2y$10$E/8R.Z9b9DlZHV6/zRZGneSNO4wupWFu46MqI1GiK2gdNN/2rTyGK', 'resources/m1.jgp', 'Math'),
(2, 'Mary', '', '', 'mary@myschool.com', '', '0000-00-00', '', '', 'Higgins Highschool', '', '$2y$10$kwkdh3QoPNUfja.jQ9/QsOeIVJhFjvPL.BTtY256UFD.vY8D72WD2', '', ''),
(3, 'Brown', '', '', 'brown@myschool.com', '', '0000-00-00', '', '', 'Higgins Highschool', '', '$2y$10$imEtmg9X9xemil/nVgTRb.DB2KYDzzzR0ROxoe7sYeehQ72JttWz.', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `Transcripts`
--

CREATE TABLE `Transcripts` (
  `id` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `filepath` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Transcripts`
--

INSERT INTO `Transcripts` (`id`, `studentid`, `filepath`, `date`) VALUES
(1, 3, 'documents/Transcript.txt', '2023-01-10,07:43:01'),
(2, 2, 'documents/Transcript.txt', '2023-01-11,11:39:38'),
(3, 1, 'documents/Transcript.txt', '2023-01-30,10:30:30'),
(4, 4, 'documents/Transcript.txt', '2023-03-05,06:54:37');

-- --------------------------------------------------------

--
-- Table structure for table `Universities`
--

CREATE TABLE `Universities` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `location` text NOT NULL,
  `country` text NOT NULL,
  `description` text NOT NULL,
  `phone` text NOT NULL,
  `logo` text NOT NULL,
  `background` text NOT NULL,
  `price` text NOT NULL,
  `starred` text NOT NULL,
  `deadline` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Universities`
--

INSERT INTO `Universities` (`id`, `name`, `location`, `country`, `description`, `phone`, `logo`, `background`, `price`, `starred`, `deadline`) VALUES
(0, 'Cornell University', 'Ithaca, NY 14850, United States', 'USA', 'Cornell is a privately endowed research university and a partner of the State University of New York. As the federal land-grant institution in New York State, we have a responsibility—unique within the Ivy League—to make contributions in all fields of knowledge in a manner that prioritizes public engagement to help improve the quality of life in our state, the nation, the world.', '+1 607-254-4636', 'Cornell University logo', 'Cornell University background', '37000', ',3,2,6,8,0,0,,,1', '2023-03-08'),
(1, 'Harvard University', 'Cambridge, MA, United States', 'USA', 'Harvard is at the frontier of academic and intellectual discovery. Those who venture here—to learn, research, teach, work, and grow—join nearly four centuries of students and scholars in the pursuit of truth, knowledge, and a better world.', '+1 617-495-1000', 'Harvard University logo', 'Harvard University background', '14000', ',2,6,10,11,10', '2023-03-16'),
(2, 'Princeton University', 'Princeton, NJ 08544, United States', 'USA', 'Princeton University is a private research university in Princeton, New Jersey. Founded in 1746 in Elizabeth as the College of New Jersey, Princeton is the fourth-oldest institution of higher education in the United States and one of the nine colonial colleges chartered before the American Revolution.', '+1 609-258-3000', 'Princeton University logo', 'Princeton University background', '9836', '1,2,6,9,10,3', '2023-03-22'),
(3, 'Purdue University', 'West Lafayette, IN 47907, United States', 'USA', 'Purdue University is a public land-grant research university in West Lafayette, Indiana, and the flagship campus of the Purdue University system. The university was founded in 1869 after Lafayette businessman John Purdue donated land and money to establish a college of science, technology, and agriculture in his name.', '+1 765-494-4600', 'Purdue University logo', 'Purdue University background', '13000', '4,1,7,9,11', '2023-03-02'),
(4, 'University of Wisconsin–Madison', 'Madison, WI, United States', 'USA', 'The University of Wisconsin–Madison is a public land-grant research university in Madison, Wisconsin. Founded when Wisconsin achieved statehood in 1848, UW–Madison is the official state university of Wisconsin and the flagship campus of the University of Wisconsin System.', '+1 608-263-2400', 'University of Wisconsin–Madison logo', 'University of Wisconsin–Madison background', '17000', '4,7,9,10,3', '2023-03-20'),
(5, 'University of Oxford', 'Oxford OX1 2JD, United Kingdom', 'UK', 'The University of Oxford is a collegiate research university in Oxford, England. There is evidence of teaching as early as 1096, making it the oldest university in the English-speaking world and the world\'s second-oldest university in continuous operation.', '+44 1865 270000', 'University of Oxford logo', 'University of Oxford background', '32800', '1,5,6,8,11', '2023-03-28'),
(6, 'Imperial College London', 'South Kensington, London SW7 2BX, United Kingdom', 'UK', 'Imperial College London is a public research university in London, United Kingdom. Its history began with Prince Albert, consort of Queen Victoria, who developed his vision for a cultural area that included the Royal Albert Hall, Victoria & Albert Museum, Natural History Museum and royal colleges.', '+44 20 7589 5111', 'Imperial College London logo', 'Imperial College London background', '40000', '6,8,11,3', '2023-03-27'),
(7, 'Tsinghua University', '蓝旗营 Haidian District, Beijing, China', 'China', 'Tsinghua University is a national public research university in Beijing, China. The university is funded by the Ministry of Education. The university is a member of the C9 League, Double First Class University Plan, Project 985, and Project 211.', '+86 10 6279 3001', 'Tsinghua University logo', 'Tsinghua University background', '40000', '4,1,5,6,10', '2023-03-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Counsellors`
--
ALTER TABLE `Counsellors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Documents`
--
ALTER TABLE `Documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Events`
--
ALTER TABLE `Events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Logins`
--
ALTER TABLE `Logins`
  ADD PRIMARY KEY (`loginid`);

--
-- Indexes for table `Notifications`
--
ALTER TABLE `Notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Requests`
--
ALTER TABLE `Requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Status`
--
ALTER TABLE `Status`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `Students`
--
ALTER TABLE `Students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Teachers`
--
ALTER TABLE `Teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Transcripts`
--
ALTER TABLE `Transcripts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Universities`
--
ALTER TABLE `Universities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Counsellors`
--
ALTER TABLE `Counsellors`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Documents`
--
ALTER TABLE `Documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Events`
--
ALTER TABLE `Events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Logins`
--
ALTER TABLE `Logins`
  MODIFY `loginid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `Notifications`
--
ALTER TABLE `Notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `Requests`
--
ALTER TABLE `Requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `Status`
--
ALTER TABLE `Status`
  MODIFY `studentid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Students`
--
ALTER TABLE `Students`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Teachers`
--
ALTER TABLE `Teachers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Transcripts`
--
ALTER TABLE `Transcripts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Universities`
--
ALTER TABLE `Universities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
