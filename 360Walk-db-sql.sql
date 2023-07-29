-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 23, 2023 at 12:55 PM
-- Server version: 10.6.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u748365388_new_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment_table`
--

CREATE TABLE `comment_table` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `image_video_id` int(11) NOT NULL,
  `x_coordinate` decimal(7,3) DEFAULT NULL,
  `y_coordinate` decimal(7,3) DEFAULT NULL,
  `video_seconds` decimal(5,2) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `resolve_flag` int(2) NOT NULL DEFAULT 0,
  `resolve_by` int(11) DEFAULT NULL,
  `resolve_date` timestamp NULL DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_flag` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment_table`
--

INSERT INTO `comment_table` (`id`, `project_id`, `image_video_id`, `x_coordinate`, `y_coordinate`, `video_seconds`, `user_id`, `comment`, `resolve_flag`, `resolve_by`, `resolve_date`, `create_date`, `update_date`, `delete_flag`) VALUES
(1, 1, 2, NULL, NULL, '1.12', 1, 'this is my comment\r\n', 0, NULL, NULL, '2023-05-30 16:07:20', '2023-06-07 03:36:45', 0),
(2, 1, 2, NULL, NULL, '1.12', 2, 'this is user comment', 0, NULL, NULL, '2023-05-30 16:09:34', '2023-06-07 03:36:45', 0),
(3, 1, 2, NULL, NULL, '1.12', 1, 'this is admin comment', 0, NULL, NULL, '2023-05-31 16:53:27', '2023-06-07 03:36:45', 0),
(4, 4, 4, NULL, NULL, '1.12', 1, 'Video is not visible', 0, NULL, NULL, '2023-06-01 10:43:54', '2023-06-07 03:36:45', 0),
(5, 4, 4, NULL, NULL, '1.12', 1, 'this is new comment section', 0, NULL, NULL, '2023-06-05 03:10:50', '2023-06-07 03:36:45', 0),
(8, 4, 4, NULL, NULL, '1.12', 1, 'this is mail testing comment', 0, NULL, NULL, '2023-06-06 06:26:17', '2023-06-07 03:36:45', 0),
(9, 5, 5, '556.000', '179.600', '1.12', 1, 'this is my comment for this section of the video', 1, 1, '2023-06-06 07:51:13', '2023-06-06 07:05:02', '2023-06-07 03:36:45', 0),
(10, 5, 5, '0.000', '0.000', '1.12', 1, 'this is normal comment', 0, NULL, NULL, '2023-06-06 07:07:50', '2023-06-07 03:36:45', 0),
(11, 5, 5, '0.000', '0.000', '1.12', 1, 'this is my new comment', 0, NULL, NULL, '2023-06-06 07:11:27', '2023-06-07 03:36:45', 0),
(12, 5, 5, '0.000', '0.000', '1.12', 1, 'this is my another comment', 0, NULL, NULL, '2023-06-06 07:12:25', '2023-06-07 03:36:45', 0),
(13, 5, 5, '235.000', '199.600', '1.12', 1, 'this is another comment for pinned section', 1, 1, '2023-06-06 09:35:08', '2023-06-06 07:25:09', '2023-06-07 03:36:45', 0),
(14, 5, 5, '241.000', '284.406', '1.12', 1, 'Hello', 1, 1, '2023-06-06 10:42:20', '2023-06-06 10:42:07', '2023-06-07 03:36:45', 0),
(15, 4, 4, '933.000', '163.600', '1.12', 1, 'hello\r\n', 1, 1, '2023-06-06 11:34:12', '2023-06-06 11:34:01', '2023-06-07 03:36:45', 0),
(16, 4, 4, '960.000', '341.600', '1.12', 1, 'hi', 1, 1, '2023-06-08 11:19:11', '2023-06-06 11:34:37', '2023-06-08 05:49:11', 0),
(18, 4, 4, '290.000', '453.406', '1.12', 1, '@gdsfg', 1, 1, '2023-06-08 11:42:55', '2023-06-06 17:55:00', '2023-06-08 06:12:55', 0),
(23, 5, 5, '328.000', '328.600', '3.09', 1, 'this is my comment at this point of second', 0, NULL, NULL, '2023-06-07 08:17:16', '2023-06-07 03:37:00', 0),
(26, 6, 7, '0.000', '0.000', '0.00', 1, 'hytjt', 0, NULL, NULL, '2023-06-26 14:11:21', '2023-06-26 08:41:21', 0),
(27, 6, 7, '0.000', '0.000', '0.00', 1, 'add comment here', 0, NULL, NULL, '2023-06-30 03:57:07', '2023-06-29 22:27:07', 0),
(28, 6, 7, '0.000', '0.000', '0.00', 1, 'test', 0, NULL, NULL, '2023-06-30 03:57:22', '2023-06-29 22:27:22', 0),
(29, 6, 7, '224.000', '329.975', '0.00', 1, 'test', 0, NULL, NULL, '2023-06-30 03:58:31', '2023-06-29 22:28:31', 0),
(30, 6, 7, '643.000', '423.734', '0.00', 1, ' {{user@gmail.com}} A', 0, NULL, NULL, '2023-06-30 09:09:08', '2023-06-30 03:39:08', 0),
(31, 6, 7, '245.000', '217.775', '0.00', 1, 'this is my test comment', 0, NULL, NULL, '2023-07-02 17:18:58', '2023-07-02 11:48:58', 0),
(32, 6, 7, '142.000', '322.175', '0.00', 1, 'issue is here', 1, 1, '2023-07-02 21:29:15', '2023-07-02 21:26:56', '2023-07-02 15:59:15', 0),
(33, 6, 7, '150.000', '379.375', '0.00', 1, 'xxx', 0, NULL, NULL, '2023-07-02 21:33:10', '2023-07-02 16:03:10', 0),
(34, 6, 7, '628.000', '444.300', '0.00', 1, ' {{user@gmail.com}}  {{kapoor.rohit95@gmail.com}} xnmmm', 1, 1, '2023-07-03 12:30:29', '2023-07-03 12:30:08', '2023-07-03 07:00:29', 0),
(35, 6, 7, '870.000', '366.300', '0.00', 1, ' {{stiwari@arcturusbusiness.com}} hi', 0, NULL, NULL, '2023-07-03 15:47:03', '2023-07-03 10:17:03', 0),
(36, 6, 7, '510.000', '214.575', '5.06', 1, 'this is my comment', 0, NULL, NULL, '2023-07-05 13:42:23', '2023-07-05 08:12:23', 0),
(37, 6, 7, '352.000', '430.336', '10.76', 1, 'check this\r\n', 1, 1, '2023-07-05 13:45:12', '2023-07-05 13:43:56', '2023-07-05 08:15:12', 0),
(38, 6, 7, '0.000', '0.000', '0.00', 1, ' {{sakshamsaini123@gmail.com}} ', 0, NULL, NULL, '2023-07-05 13:46:01', '2023-07-05 08:16:01', 0),
(39, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} ', 0, NULL, NULL, '2023-07-05 13:46:28', '2023-07-05 08:16:28', 0),
(40, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} chek this\r\n', 0, NULL, NULL, '2023-07-05 13:46:34', '2023-07-05 08:16:34', 0),
(41, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} chek this\r\n', 0, NULL, NULL, '2023-07-05 13:46:35', '2023-07-05 08:16:35', 0),
(42, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} chek this\r\n', 0, NULL, NULL, '2023-07-05 13:46:38', '2023-07-05 08:16:38', 0),
(43, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} chek this\r\n', 0, NULL, NULL, '2023-07-05 13:46:39', '2023-07-05 08:16:39', 0),
(44, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} check this\r\n\r\n\r\n', 0, NULL, NULL, '2023-07-05 13:46:45', '2023-07-05 08:16:45', 0),
(45, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} check this\r\n\r\n\r\n', 0, NULL, NULL, '2023-07-05 13:47:11', '2023-07-05 08:17:11', 0),
(46, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} check this\r\n\r\n\r\n\r\n', 0, NULL, NULL, '2023-07-05 13:47:15', '2023-07-05 08:17:15', 0),
(47, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} check this\r\n\r\n\r\n\r\n', 0, NULL, NULL, '2023-07-05 13:47:16', '2023-07-05 08:17:16', 0),
(48, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} check this\r\n\r\n\r\n\r\n', 0, NULL, NULL, '2023-07-05 13:47:16', '2023-07-05 08:17:16', 0),
(49, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} check this\r\n\r\n\r\n\r\n', 0, NULL, NULL, '2023-07-05 13:47:18', '2023-07-05 08:17:18', 0),
(50, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} check this\r\n\r\n\r\n\r\n', 0, NULL, NULL, '2023-07-05 13:47:18', '2023-07-05 08:17:18', 0),
(51, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} check this\r\n\r\n\r\n\r\n', 0, NULL, NULL, '2023-07-05 13:47:18', '2023-07-05 08:17:18', 0),
(52, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} check this\r\n\r\n\r\n\r\n', 0, NULL, NULL, '2023-07-05 13:47:20', '2023-07-05 08:17:20', 0),
(53, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} check this\r\n\r\n\r\n\r\n', 0, NULL, NULL, '2023-07-05 13:47:20', '2023-07-05 08:17:20', 0),
(54, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} check this\r\n\r\n\r\n\r\n', 0, NULL, NULL, '2023-07-05 13:47:20', '2023-07-05 08:17:20', 0),
(55, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} check this\r\n\r\n\r\n\r\n', 0, NULL, NULL, '2023-07-05 13:47:21', '2023-07-05 08:17:21', 0),
(56, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} check this\r\n\r\n\r\n\r\n', 0, NULL, NULL, '2023-07-05 13:47:23', '2023-07-05 08:17:23', 0),
(57, 6, 7, '292.000', '463.336', '15.56', 1, ' {{sakshamsaini123@gmail.com}} check this\r\n\r\n\r\n\r\n', 0, NULL, NULL, '2023-07-05 13:47:23', '2023-07-05 08:17:23', 0),
(58, 6, 7, '15.000', '668.336', '15.56', 1, '\r\n\r\n\r\n {{user@gmail.com}} ', 0, NULL, NULL, '2023-07-05 13:48:44', '2023-07-05 08:18:44', 0),
(59, 6, 7, '460.000', '503.336', '15.56', 1, '\r\n\r\n\r\n {{user@gmail.com}} ', 0, NULL, NULL, '2023-07-05 13:48:50', '2023-07-05 08:18:50', 0),
(60, 6, 7, '460.000', '503.336', '15.56', 1, '\r\n\r\n\r\n {{user@gmail.com}} ', 0, NULL, NULL, '2023-07-05 13:48:52', '2023-07-05 08:18:52', 0),
(61, 6, 7, '460.000', '503.336', '15.56', 1, '\r\n\r\n\r\n {{user@gmail.com}} ', 0, NULL, NULL, '2023-07-05 13:48:52', '2023-07-05 08:18:52', 0),
(62, 6, 7, '460.000', '503.336', '15.56', 1, '\r\n\r\n\r\n {{user@gmail.com}} ', 0, NULL, NULL, '2023-07-05 13:48:52', '2023-07-05 08:18:52', 0),
(63, 6, 7, '460.000', '503.336', '15.56', 1, '\r\n\r\n\r\n {{user@gmail.com}} ', 0, NULL, NULL, '2023-07-05 13:48:52', '2023-07-05 08:18:52', 0),
(64, 6, 7, '460.000', '503.336', '15.56', 1, '\r\n\r\n\r\n {{user@gmail.com}} ', 0, NULL, NULL, '2023-07-05 13:48:53', '2023-07-05 08:18:53', 0),
(65, 6, 7, '460.000', '503.336', '15.56', 1, '\r\n\r\n\r\n {{user@gmail.com}} ', 0, NULL, NULL, '2023-07-05 13:48:53', '2023-07-05 08:18:53', 0),
(66, 6, 7, '460.000', '503.336', '15.56', 1, '\r\n\r\n\r\n {{user@gmail.com}} ', 0, NULL, NULL, '2023-07-05 13:48:53', '2023-07-05 08:18:53', 0),
(67, 6, 7, '460.000', '503.336', '15.56', 1, '\r\n\r\n\r\n {{user@gmail.com}} ', 0, NULL, NULL, '2023-07-05 13:48:53', '2023-07-05 08:18:53', 0),
(68, 6, 7, '460.000', '503.336', '15.56', 1, '\r\n\r\n\r\n {{user@gmail.com}} ', 0, NULL, NULL, '2023-07-05 13:48:53', '2023-07-05 08:18:53', 0),
(69, 6, 7, '460.000', '503.336', '15.56', 1, '\r\n\r\n\r\n {{user@gmail.com}} ', 0, NULL, NULL, '2023-07-05 13:48:54', '2023-07-05 08:18:54', 0),
(70, 6, 7, '460.000', '503.336', '15.56', 1, '\r\n\r\n\r\n {{user@gmail.com}} ', 0, NULL, NULL, '2023-07-05 13:48:54', '2023-07-05 08:18:54', 0),
(71, 6, 7, '362.000', '469.336', '0.00', 1, 'check \r\n', 0, NULL, NULL, '2023-07-05 13:49:45', '2023-07-05 08:19:45', 0),
(72, 6, 7, '362.000', '469.336', '0.00', 1, 'check \r\n', 0, NULL, NULL, '2023-07-05 13:49:48', '2023-07-05 08:19:48', 0),
(73, 6, 7, '362.000', '469.336', '0.00', 1, 'check \r\n', 0, NULL, NULL, '2023-07-05 13:49:48', '2023-07-05 08:19:48', 0),
(74, 6, 7, '362.000', '469.336', '0.00', 1, 'check \r\n', 0, NULL, NULL, '2023-07-05 13:49:48', '2023-07-05 08:19:48', 0),
(75, 6, 7, '362.000', '469.336', '0.00', 1, 'check \r\n', 0, NULL, NULL, '2023-07-05 13:50:56', '2023-07-05 08:20:56', 0),
(76, 6, 7, '362.000', '469.336', '0.00', 1, 'check \r\n', 0, NULL, NULL, '2023-07-05 13:50:56', '2023-07-05 08:20:56', 0),
(77, 6, 7, '362.000', '469.336', '0.00', 1, 'check \r\n', 0, NULL, NULL, '2023-07-05 13:50:56', '2023-07-05 08:20:56', 0),
(78, 6, 7, '362.000', '469.336', '0.00', 1, 'check \r\n', 0, NULL, NULL, '2023-07-05 13:50:56', '2023-07-05 08:20:56', 0),
(79, 4, 4, '301.000', '447.336', '3.53', 1, 'test', 1, 1, '2023-07-05 13:54:09', '2023-07-05 13:53:31', '2023-07-05 08:24:09', 0),
(80, 4, 4, '329.000', '414.336', '4.10', 1, 'akjsfhaif', 1, 1, '2023-07-10 17:26:59', '2023-07-05 13:55:24', '2023-07-10 11:56:59', 0),
(81, 4, 4, '109.000', '498.336', '2.65', 1, 'test', 0, NULL, NULL, '2023-07-05 13:57:08', '2023-07-05 08:27:08', 0),
(82, 4, 4, '0.000', '0.000', '0.00', 1, 'Test {{stiwari@arcturusbusiness.com}} ', 0, NULL, NULL, '2023-07-05 13:58:10', '2023-07-05 08:28:10', 0),
(83, 6, 7, '331.000', '468.836', '4.86', 1, 'testing\r\n', 0, NULL, NULL, '2023-07-05 13:59:13', '2023-07-05 08:29:13', 0),
(84, 6, 7, '21.000', '672.336', '12.35', 1, 'check', 0, NULL, NULL, '2023-07-05 14:00:10', '2023-07-05 08:30:10', 0),
(85, 4, 4, '49.000', '502.336', '3.41', 1, 'cfgryty', 0, NULL, NULL, '2023-07-05 14:03:50', '2023-07-05 08:33:50', 0),
(86, 4, 4, '175.000', '576.836', '0.47', 1, 'nhgbjh', 0, NULL, NULL, '2023-07-05 14:04:28', '2023-07-05 08:34:28', 0),
(87, 6, 7, '258.000', '545.336', '38.08', 1, 'lkfkls', 1, 1, '2023-07-05 14:20:08', '2023-07-05 14:17:40', '2023-07-05 08:50:08', 0),
(88, 4, 4, '460.000', '531.336', '4.35', 1, 'test', 0, NULL, NULL, '2023-07-05 14:23:46', '2023-07-05 08:53:46', 0),
(89, 4, 4, '328.000', '428.336', '4.33', 1, 'jbkjb', 0, NULL, NULL, '2023-07-05 14:24:50', '2023-07-05 08:54:50', 0),
(90, 4, 4, '420.000', '203.336', '4.45', 1, 'bjhg', 0, NULL, NULL, '2023-07-05 14:25:27', '2023-07-05 08:55:27', 0),
(91, 4, 4, '308.000', '328.336', '5.71', 1, 'fgyuwegfu', 0, NULL, NULL, '2023-07-05 14:29:48', '2023-07-05 08:59:48', 0),
(92, 4, 4, '377.000', '439.336', '4.21', 1, 'sjknfawie', 0, NULL, NULL, '2023-07-05 14:32:58', '2023-07-05 09:02:58', 0),
(93, 6, 7, '0.000', '0.000', '0.00', 1, 'abc', 0, NULL, NULL, '2023-07-07 15:43:15', '2023-07-07 10:13:15', 0),
(94, 4, 4, '98.000', '413.375', '2.95', 1, 'Faulty chain', 1, 1, '2023-07-07 15:51:39', '2023-07-07 15:50:58', '2023-07-07 10:21:39', 0),
(95, 8, 10, '289.000', '303.648', '5.91', 2, ' {{sakshamsaini123@gmail.com}} check this\r\n', 0, NULL, NULL, '2023-07-10 17:10:18', '2023-07-10 11:40:18', 0),
(96, 8, 10, '439.000', '299.900', '7.48', 2, '@ {{stiwari@arcturusbusiness.com}} check pillar\r\n', 0, NULL, NULL, '2023-07-10 17:12:07', '2023-07-10 11:42:07', 0),
(97, 8, 10, '1077.000', '214.900', '3.58', 2, ' {{sakshamsaini123@gmail.com}} check this gap', 0, NULL, NULL, '2023-07-10 17:13:31', '2023-07-10 11:43:31', 0),
(98, 2, 3, '0.000', '0.000', '0.00', 1, ' {{kapoor.rohit95@gmail.com}} ', 0, NULL, NULL, '2023-07-10 17:17:35', '2023-07-10 11:47:35', 0),
(99, 2, 3, '0.000', '0.000', '0.00', 1, ' {{kapoor.rohit95@gmail.com}} ', 0, NULL, NULL, '2023-07-10 17:17:35', '2023-07-10 11:47:35', 0),
(100, 2, 3, '0.000', '0.000', '0.00', 1, ' {{kapoor.rohit95@gmail.com}} ', 0, NULL, NULL, '2023-07-10 17:17:35', '2023-07-10 11:47:35', 0),
(101, 4, 4, '243.000', '425.836', '3.33', 1, 'jnfw', 0, NULL, NULL, '2023-07-10 17:20:55', '2023-07-10 11:50:55', 0),
(102, 8, 10, '716.000', '509.900', '9.64', 1, ' {{stiwari@arcturusbusiness.com}} Check this pillar location', 1, 1, '2023-07-12 16:17:45', '2023-07-12 16:17:31', '2023-07-12 10:47:45', 0),
(103, 8, 10, '508.000', '414.900', '3.03', 1, ' {{user@gmail.com}}  {{user@gmail.com}}  {{user@gmail.com}} check this pillar for problem', 0, NULL, NULL, '2023-07-17 23:07:01', '2023-07-17 17:37:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `document_table`
--

CREATE TABLE `document_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `document` varchar(100) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_flag` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_table`
--

INSERT INTO `document_table` (`id`, `user_id`, `project_id`, `document`, `create_date`, `update_date`, `delete_flag`) VALUES
(1, 1, 1, '16855315008027Get_Started_With_Smallpdf.pdf', '2023-05-31 11:11:40', '2023-05-31 11:11:40', 0),
(2, 1, 6, '16867200912724Degradation analysis of a-Si, (HIT) hetro-junction intrinsic thin layer.pdf', '2023-06-14 05:21:31', '2023-06-14 05:21:31', 0),
(4, 2, 8, 'area.pdf', '2023-07-10 11:39:25', '2023-07-10 11:39:25', 0),
(5, 1, 8, 'HotStuff.pdf', '2023-07-12 10:48:21', '2023-07-12 10:48:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `image_video_table`
--

CREATE TABLE `image_video_table` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `type` varchar(25) NOT NULL,
  `image_video` varchar(100) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_flag` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image_video_table`
--

INSERT INTO `image_video_table` (`id`, `project_id`, `type`, `image_video`, `create_date`, `update_date`, `delete_flag`) VALUES
(1, 1, 'picture', '9171gmail.png', '2023-06-06 07:17:53', '2023-06-06 07:17:53', 0),
(2, 1, 'video', '32821.mp4', '2023-06-06 07:17:53', '2023-06-06 07:17:53', 0),
(3, 2, 'picture', '9818SAM_0115.JPG', '2023-06-06 07:17:53', '2023-06-06 07:17:53', 0),
(4, 4, 'video', '81587103360_0207.mp4', '2023-06-06 07:17:53', '2023-06-06 07:17:53', 0),
(5, 5, 'video', '51597103360_0207.mp4', '2023-06-06 07:17:53', '2023-06-06 07:17:53', 0),
(6, 5, 'picture', '1638user_profile.png', '2023-06-06 07:17:53', '2023-06-06 07:17:53', 0),
(7, 6, 'video', '3724SAM_0161.MP4', '2023-06-06 07:17:53', '2023-06-06 07:17:53', 0),
(9, 7, 'picture', '25724.jpg', '2023-07-07 10:37:17', '2023-07-07 10:37:17', 0),
(10, 8, 'video', '2701xxxx.MP4', '2023-07-10 11:35:17', '2023-07-10 11:35:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_table`
--

CREATE TABLE `project_table` (
  `id` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `members_id` varchar(200) NOT NULL,
  `document` varchar(100) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_flag` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_table`
--

INSERT INTO `project_table` (`id`, `project_name`, `members_id`, `document`, `status`, `create_date`, `update_date`, `delete_flag`) VALUES
(1, 'New Website', '2', '16855167125138Flyer.pdf', 1, '2023-05-30 15:00:39', '2023-06-06 04:31:41', 1),
(2, 'Ghatmpur', '3', '16855242394026SafetyEYE_Report_2023-05-31.pdf', 0, '2023-05-31 09:10:39', '2023-06-19 07:09:51', 0),
(4, 'Khurja', '5,4', '', 0, '2023-06-01 05:13:15', '2023-06-06 12:36:52', 0),
(5, 'New Project', '3', '16860138947859test.pdf', 2, '2023-06-06 01:11:35', '2023-06-06 06:30:34', 0),
(6, 'Buxar', '2,3', NULL, 0, '2023-06-07 05:59:56', '2023-06-26 08:46:48', 0),
(7, 'PPGCL', '3', '', 0, '2023-07-07 10:37:17', '2023-07-07 10:37:17', 0),
(8, 'xcvb', '2,3,4,5', '16889889151044StepsToOpenWebApp.pdf', 0, '2023-07-10 11:35:15', '2023-07-10 11:35:15', 0),
(9, 'test', '3', '16897756585506test.pdf', 0, '2023-07-19 14:07:38', '2023-07-19 14:07:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mobile_number` bigint(20) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `access_token` enum('admin','user') NOT NULL,
  `block_flag` int(1) NOT NULL DEFAULT 0,
  `delete_flag` int(1) NOT NULL DEFAULT 0,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `full_name`, `email`, `password`, `mobile_number`, `image`, `company_name`, `access_token`, `block_flag`, `delete_flag`, `create_date`, `update_date`) VALUES
(1, 'Admin', 'admin@gmail.com', '11f92de54247d36c29a975471205ed88eb804afd', 0, NULL, NULL, 'admin', 0, 0, '2023-05-29 07:32:26', '2023-05-30 14:41:46'),
(2, 'Member 1', 'user@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 8888888888, NULL, 'company name', 'user', 0, 0, '2023-05-29 12:45:02', '2023-06-06 06:32:55'),
(3, 'User 2', 'kapoor.rohit95@gmail.com', '642b797047cefcbf8e883490d3b01fa7d55e1289', 9999999999, NULL, 'as', 'user', 0, 0, '2023-05-31 07:21:04', '2023-06-06 11:58:29'),
(4, 'Swati Tiwari', 'stiwari@arcturusbusiness.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 9650100036, NULL, 'Arcturus Business Solutions Pvt Ltd', 'user', 0, 0, '2023-06-01 05:12:00', '2023-06-06 01:42:05'),
(5, 'Saksham', 'sakshamsaini123@gmail.com', 'b80a9aed8af17118e51d4d0c2d7872ae26e2109e', 8791110408, NULL, 'Test', 'user', 0, 0, '2023-06-06 12:36:33', '2023-06-06 12:36:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment_table`
--
ALTER TABLE `comment_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_table`
--
ALTER TABLE `document_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_video_table`
--
ALTER TABLE `image_video_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_table`
--
ALTER TABLE `project_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment_table`
--
ALTER TABLE `comment_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `document_table`
--
ALTER TABLE `document_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `image_video_table`
--
ALTER TABLE `image_video_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `project_table`
--
ALTER TABLE `project_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
