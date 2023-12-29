-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2023 at 01:43 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timetable`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_year`
--

CREATE TABLE `academic_year` (
  `id` int(11) NOT NULL,
  `academic_year_id` varchar(100) NOT NULL,
  `academic_year` varchar(100) NOT NULL,
  `Year` varchar(255) DEFAULT NULL,
  `year_status` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_year`
--

INSERT INTO `academic_year` (`id`, `academic_year_id`, `academic_year`, `Year`, `year_status`, `date_added`) VALUES
(1, 'YR_2019_2020', '2019/2020', 'Year 4', 'Active', '2023-03-02 11:51:27'),
(2, 'YR_2020_2021', '2020/2021', 'Year 3', 'Active', '2023-03-02 11:51:27'),
(4, 'YR_2021_2022', '2021/2022', 'Year 2', 'Active', '2023-03-06 12:34:36'),
(5, 'YR_2022_2023', '2022/2023', 'Year 1', 'Active', '2023-03-06 12:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `course_details`
--

CREATE TABLE `course_details` (
  `id` int(11) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_shortform` varchar(100) NOT NULL,
  `date_added` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_details`
--

INSERT INTO `course_details` (`id`, `course_id`, `course_name`, `course_shortform`, `date_added`) VALUES
(1, 'CRS_CCS', 'Bachelor of Science in Computer Science', 'CCS', '2023-02-28 15:24:27'),
(2, 'CRS_CCT', 'Bachelor of Science in Computer Technology', 'CCT', '2023-02-28 15:24:36'),
(5, 'CRS_ICTM', 'Bachelor of Science in Information and Communication Technology Management', 'CIM', '2023-03-01 21:33:39'),
(3, 'CRS_IS', 'Bachelor of Science in Information Systems', 'CIS', '2023-02-28 15:40:09'),
(4, 'CRS_IT', 'Bachelor of Science in Information Technology', 'CIT', '2023-02-28 15:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `course_group_details`
--

CREATE TABLE `course_group_details` (
  `id` int(11) NOT NULL,
  `group_id` varchar(100) NOT NULL,
  `course_id` varchar(100) NOT NULL,
  `academic_year_id` varchar(100) NOT NULL,
  `group_number` bigint(20) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_group_details`
--

INSERT INTO `course_group_details` (`id`, `group_id`, `course_id`, `academic_year_id`, `group_number`, `date_added`) VALUES
(8, 'GRP_CRS-CCS_229', 'CRS_CCS', 'YR_2022_2023', 80, '2023-03-26 12:59:48'),
(5, 'GRP_CRS-CCS_366', 'CRS_CCS', 'YR_2019_2020', 62, '2023-03-26 12:58:48'),
(7, 'GRP_CRS-CCS_580', 'CRS_CCS', 'YR_2021_2022', 95, '2023-03-26 12:59:13'),
(6, 'GRP_CRS-CCS_74', 'CRS_CCS', 'YR_2020_2021', 53, '2023-03-26 12:58:59'),
(10, 'GRP_CRS-CCT_332', 'CRS_CCT', 'YR_2020_2021', 32, '2023-03-26 13:00:37'),
(11, 'GRP_CRS-CCT_392', 'CRS_CCT', 'YR_2021_2022', 48, '2023-03-26 13:00:52'),
(9, 'GRP_CRS-CCT_635', 'CRS_CCT', 'YR_2019_2020', 45, '2023-03-26 13:00:18'),
(12, 'GRP_CRS-CCT_734', 'CRS_CCT', 'YR_2022_2023', 72, '2023-03-26 13:01:07'),
(14, 'GRP_CRS-ICTM_533', 'CRS_ICTM', 'YR_2020_2021', 40, '2023-03-26 13:01:31'),
(13, 'GRP_CRS-ICTM_557', 'CRS_ICTM', 'YR_2019_2020', 36, '2023-03-26 13:01:23'),
(16, 'GRP_CRS-ICTM_644', 'CRS_ICTM', 'YR_2022_2023', 40, '2023-03-26 13:01:59'),
(15, 'GRP_CRS-ICTM_916', 'CRS_ICTM', 'YR_2021_2022', 51, '2023-03-26 13:01:42'),
(17, 'GRP_CRS-IS_208', 'CRS_IS', 'YR_2019_2020', 18, '2023-03-26 13:03:09'),
(19, 'GRP_CRS-IS_504', 'CRS_IS', 'YR_2021_2022', 30, '2023-03-26 13:03:24'),
(20, 'GRP_CRS-IS_805', 'CRS_IS', 'YR_2022_2023', 28, '2023-03-26 13:03:32'),
(18, 'GRP_CRS-IS_897', 'CRS_IS', 'YR_2020_2021', 23, '2023-03-26 13:03:17'),
(22, 'GRP_CRS-IT_1000', 'CRS_IT', 'YR_2020_2021', 43, '2023-03-26 13:03:59'),
(21, 'GRP_CRS-IT_317', 'CRS_IT', 'YR_2019_2020', 42, '2023-03-26 13:03:50'),
(24, 'GRP_CRS-IT_794', 'CRS_IT', 'YR_2022_2023', 54, '2023-03-26 13:04:17'),
(23, 'GRP_CRS-IT_797', 'CRS_IT', 'YR_2021_2022', 50, '2023-03-26 13:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `department_course_details`
--

CREATE TABLE `department_course_details` (
  `id` int(11) NOT NULL,
  `department_id` varchar(100) NOT NULL,
  `course_id` varchar(100) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_course_details`
--

INSERT INTO `department_course_details` (`id`, `department_id`, `course_id`, `date_added`) VALUES
(1, 'DPT_COMPUTERSCIENCE', 'CRS_CCS', '2023-02-28 15:24:27'),
(2, 'DPT_COMPUTERSCIENCE', 'CRS_CCT', '2023-02-28 15:24:37'),
(5, 'DPT_INFORMATIONTECHNOLOGY', 'CRS_IT', '2023-02-28 15:27:38'),
(7, 'DPT_INFORMATIONTECHNOLOGY', 'CRS_IS', '2023-02-28 15:40:10'),
(12, 'DPT_INFORMATIONTECHNOLOGY', 'CRS_ICTM', '2023-03-01 21:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `department_details`
--

CREATE TABLE `department_details` (
  `id` int(11) NOT NULL,
  `department_id` varchar(100) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_details`
--

INSERT INTO `department_details` (`id`, `department_id`, `department_name`, `date_created`) VALUES
(2, 'DPT_COMPUTERSCIENCE', 'Computer Science', '2023-02-28 15:15:48'),
(1, 'DPT_INFORMATIONTECHNOLOGY', 'Information Technology', '2023-02-28 15:15:22');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_department_details`
--

CREATE TABLE `lecturer_department_details` (
  `id` int(11) NOT NULL,
  `department_id` varchar(100) NOT NULL,
  `lecturer_id` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer_department_details`
--

INSERT INTO `lecturer_department_details` (`id`, `department_id`, `lecturer_id`, `date_created`) VALUES
(1, 'DPT_INFORMATIONTECHNOLOGY', 'PF01', '2023-03-09 06:25:37'),
(2, 'DPT_INFORMATIONTECHNOLOGY', 'PF02', '2023-03-09 06:25:37'),
(3, 'DPT_INFORMATIONTECHNOLOGY', 'PF03', '2023-03-09 06:25:54'),
(4, 'DPT_INFORMATIONTECHNOLOGY', 'PF04', '2023-03-09 06:25:54'),
(6, 'DPT_COMPUTERSCIENCE', 'PF06', '2023-03-09 09:25:05'),
(7, 'DPT_INFORMATIONTECHNOLOGY', 'PF07', '2023-03-09 07:32:22'),
(8, 'DPT_INFORMATIONTECHNOLOGY', 'PF08', '2023-03-09 08:47:43'),
(9, 'DPT_INFORMATIONTECHNOLOGY', 'PF09', '2023-03-09 08:52:02'),
(10, 'DPT_INFORMATIONTECHNOLOGY', 'PF10', '2023-03-09 08:52:56'),
(11, 'DPT_INFORMATIONTECHNOLOGY', 'PF11', '2023-03-09 08:54:16'),
(12, 'DPT_INFORMATIONTECHNOLOGY', 'PF12', '2023-03-09 08:55:11'),
(13, 'DPT_INFORMATIONTECHNOLOGY', 'PF13', '2023-03-09 08:56:09'),
(14, 'DPT_INFORMATIONTECHNOLOGY', 'PF14', '2023-03-09 08:57:06'),
(15, 'DPT_INFORMATIONTECHNOLOGY', 'PF15', '2023-03-09 08:58:03'),
(16, 'DPT_INFORMATIONTECHNOLOGY', 'PF16', '2023-03-09 08:59:11'),
(17, 'DPT_INFORMATIONTECHNOLOGY', 'PF17', '2023-03-09 09:00:18'),
(18, 'DPT_INFORMATIONTECHNOLOGY', 'PF18', '2023-03-09 09:01:26'),
(19, 'DPT_INFORMATIONTECHNOLOGY', 'PF19', '2023-03-09 09:02:24'),
(20, 'DPT_COMPUTERSCIENCE', 'PF20', '2023-03-09 09:05:33'),
(21, 'DPT_COMPUTERSCIENCE', 'PF21', '2023-03-09 09:07:02'),
(22, 'DPT_COMPUTERSCIENCE', 'PF22', '2023-03-09 09:08:45'),
(23, 'DPT_COMPUTERSCIENCE', 'PF23', '2023-03-09 09:09:42'),
(24, 'DPT_COMPUTERSCIENCE', 'PF24', '2023-03-09 09:10:30'),
(25, 'DPT_COMPUTERSCIENCE', 'PF25', '2023-03-09 09:11:20'),
(26, 'DPT_COMPUTERSCIENCE', 'PF26', '2023-03-09 09:12:49'),
(27, 'DPT_COMPUTERSCIENCE', 'PF27', '2023-03-09 09:14:03'),
(28, 'DPT_COMPUTERSCIENCE', 'PF28', '2023-03-09 09:14:55'),
(30, 'DPT_COMPUTERSCIENCE', 'PF29', '2023-03-20 20:19:14'),
(31, 'DPT_COMPUTERSCIENCE', 'PF30', '2023-03-20 20:25:40'),
(32, 'DPT_COMPUTERSCIENCE', 'PF31', '2023-03-20 20:51:25'),
(33, 'DPT_INFORMATIONTECHNOLOGY', 'PF60', '2023-03-25 10:09:58'),
(34, 'DPT_INFORMATIONTECHNOLOGY', 'PF52', '2023-03-25 11:56:47');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_unit_details`
--

CREATE TABLE `lecturer_unit_details` (
  `id` int(11) NOT NULL,
  `lecturer_id` varchar(20) NOT NULL,
  `unit_id` varchar(20) NOT NULL,
  `academic_year_id` varchar(100) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer_unit_details`
--

INSERT INTO `lecturer_unit_details` (`id`, `lecturer_id`, `unit_id`, `academic_year_id`, `date_updated`) VALUES
(1, 'PF01', 'CIS 212', 'YR_2021_2022', '2023-03-16 06:28:05'),
(11, 'PF02', 'CIM 312', 'YR_2020_2021', '2023-03-16 06:39:33'),
(12, 'PF01', 'CIT 322', 'YR_2020_2021', '2023-03-16 06:56:31'),
(18, 'PF01', 'CIT 204', 'YR_2021_2022', '2023-03-16 07:17:08'),
(19, 'PF01', 'CIT 212', 'YR_2021_2022', '2023-03-16 07:17:08'),
(20, 'PF16', 'CIT 416', 'YR_2019_2020', '2023-03-16 07:19:17'),
(21, 'PF16', 'CIM 104', 'YR_2022_2023', '2023-03-16 07:19:55'),
(22, 'PF16', 'CIM 212', 'YR_2021_2022', '2023-03-16 07:20:20'),
(23, 'PF16', 'CIM 404', 'YR_2019_2020', '2023-03-16 07:26:06'),
(24, 'PF16', 'CIM 408', 'YR_2019_2020', '2023-03-16 07:26:06'),
(25, 'PF16', 'CIS 104', 'YR_2022_2023', '2023-03-16 07:27:25'),
(26, 'PF16', 'CIS 214', 'YR_2021_2022', '2023-03-16 07:28:56'),
(28, 'PF16', 'CIT 104', 'YR_2022_2023', '2023-03-16 07:29:25'),
(29, 'PF21', 'CCT 316', 'YR_2020_2021', '2023-03-20 19:47:10'),
(30, 'PF21', 'CCT 412', 'YR_2019_2020', '2023-03-20 19:47:40'),
(31, 'PF21', 'CCS 308', 'YR_2020_2021', '2023-03-20 19:48:04'),
(32, 'PF22', 'CCT 402', 'YR_2019_2020', '2023-03-20 19:49:06'),
(33, 'PF22', 'CCT 302', 'YR_2020_2021', '2023-03-20 19:49:27'),
(34, 'PF26', 'CCT 112', 'YR_2022_2023', '2023-03-20 19:51:15'),
(35, 'PF26', 'CCT 214', 'YR_2021_2022', '2023-03-20 19:51:44'),
(36, 'PF26', 'CCT 420', 'YR_2019_2020', '2023-03-20 19:52:18'),
(37, 'PF26', 'CCS 414', 'YR_2019_2020', '2023-03-20 19:52:39'),
(38, 'PF27', 'CCS 316', 'YR_2020_2021', '2023-03-20 19:54:29'),
(39, 'PF27', 'CCS 314', 'YR_2020_2021', '2023-03-20 19:54:30'),
(40, 'PF27', 'CCS 312', 'YR_2020_2021', '2023-03-20 19:54:30'),
(41, 'PF27', 'CCT 322', 'YR_2020_2021', '2023-03-20 19:55:34'),
(42, 'PF27', 'CCT 306', 'YR_2020_2021', '2023-03-20 19:55:53'),
(43, 'PF23', 'CCT 206', 'YR_2021_2022', '2023-03-20 19:57:12'),
(44, 'PF23', 'CCT 215', 'YR_2021_2022', '2023-03-20 19:57:12'),
(45, 'PF23', 'CCT 210', 'YR_2021_2022', '2023-03-20 19:57:12'),
(46, 'PF23', 'CCS 204', 'YR_2021_2022', '2023-03-20 19:57:49'),
(47, 'PF23', 'CCS 208', 'YR_2021_2022', '2023-03-20 19:57:49'),
(48, 'PF24', 'CCT 202', 'YR_2021_2022', '2023-03-20 20:04:23'),
(49, 'PF20', 'CCS 210', 'YR_2021_2022', '2023-03-20 20:07:01'),
(50, 'PF20', 'CCT 212', 'YR_2021_2022', '2023-03-20 20:07:23'),
(51, 'PF20', 'CCS 412', 'YR_2019_2020', '2023-03-20 20:07:44'),
(52, 'PF20', 'CCT 418', 'YR_2019_2020', '2023-03-20 20:08:02'),
(53, 'PF25', 'CCS 202', 'YR_2021_2022', '2023-03-20 20:11:05'),
(54, 'PF25', 'CCS 406', 'YR_2019_2020', '2023-03-20 20:11:21'),
(55, 'PF25', 'CCS 404', 'YR_2019_2020', '2023-03-20 20:11:43'),
(56, 'PF06', 'CCS 318', 'YR_2020_2021', '2023-03-20 20:13:46'),
(57, 'PF06', 'CCS 306', 'YR_2020_2021', '2023-03-20 20:13:46'),
(58, 'PF06', 'CCS 418', 'YR_2019_2020', '2023-03-20 20:14:01'),
(59, 'PF06', 'CCT 308', 'YR_2020_2021', '2023-03-20 20:14:23'),
(60, 'PF06', 'CCT 320', 'YR_2020_2021', '2023-03-20 20:14:53'),
(61, 'PF29', 'CCT 312', 'YR_2020_2021', '2023-03-20 20:20:01'),
(62, 'PF29', 'CCS 104', 'YR_2022_2023', '2023-03-20 20:20:53'),
(63, 'PF29', 'CCT 104', 'YR_2022_2023', '2023-03-20 20:21:11'),
(64, 'PF29', 'CCS 206', 'YR_2021_2022', '2023-03-20 20:22:01'),
(65, 'PF29', 'CCS 416', 'YR_2019_2020', '2023-03-20 20:24:21'),
(68, 'PF30', 'CCS 302', 'YR_2020_2021', '2023-03-20 20:31:03'),
(69, 'PF30', 'CCT 304', 'YR_2020_2021', '2023-03-20 20:31:23'),
(70, 'PF30', 'CCS 304', 'YR_2020_2021', '2023-03-20 20:32:04'),
(71, 'PF30', 'CCS 212', 'YR_2021_2022', '2023-03-20 20:32:24'),
(72, 'PF26', 'CCT 116', 'YR_2022_2023', '2023-03-20 20:34:14'),
(73, 'PF24', 'CCT 118', 'YR_2022_2023', '2023-03-20 20:38:02'),
(74, 'PF24', 'CCS 122', 'YR_2022_2023', '2023-03-20 20:38:24'),
(75, 'PF24', 'CCT 318', 'YR_2020_2021', '2023-03-20 20:38:38'),
(77, 'PF27', 'CCS 214', 'YR_2021_2022', '2023-03-20 20:53:20'),
(78, 'PF01', 'CIT 118', 'YR_2022_2023', '2023-03-25 07:55:22'),
(79, 'PF01', 'CIM 216', 'YR_2021_2022', '2023-03-25 09:09:57'),
(80, 'PF01', 'CIS 120', 'YR_2022_2023', '2023-03-25 09:11:55'),
(81, 'PF01', 'CIM 118', 'YR_2022_2023', '2023-03-25 09:13:38'),
(82, 'PF19', 'CIM 106', 'YR_2022_2023', '2023-03-25 09:32:50'),
(83, 'PF19', 'CIM 416', 'YR_2019_2020', '2023-03-25 09:35:13'),
(84, 'PF19', 'CIT 106', 'YR_2022_2023', '2023-03-25 09:37:16'),
(85, 'PF19', 'CIT 312', 'YR_2020_2021', '2023-03-25 09:40:07'),
(86, 'PF19', 'CIS 106', 'YR_2022_2023', '2023-03-25 09:40:56'),
(87, 'PF16', 'CIT 206', 'YR_2021_2022', '2023-03-25 09:47:31'),
(88, 'PF18', 'CIM 108', 'YR_2022_2023', '2023-03-25 09:51:34'),
(89, 'PF18', 'CIM 302', 'YR_2020_2021', '2023-03-25 09:52:58'),
(90, 'PF18', 'CIM 320', 'YR_2020_2021', '2023-03-25 09:52:58'),
(91, 'PF18', 'CIM 410', 'YR_2019_2020', '2023-03-25 09:55:04'),
(92, 'PF18', 'CIT 210', 'YR_2021_2022', '2023-03-25 09:56:25'),
(93, 'PF18', 'CIT 214', 'YR_2021_2022', '2023-03-25 09:57:29'),
(94, 'PF18', 'CIT 108', 'YR_2022_2023', '2023-03-25 09:58:22'),
(95, 'PF18', 'CIS 108', 'YR_2022_2023', '2023-03-25 09:59:50'),
(96, 'PF18', 'CIS 208', 'YR_2021_2022', '2023-03-25 10:00:36'),
(97, 'PF18', 'CIS 304', 'YR_2020_2021', '2023-03-25 10:01:19'),
(98, 'PF08', 'CIM 120', 'YR_2022_2023', '2023-03-25 10:03:45'),
(99, 'PF08', 'CIM 202', 'YR_2021_2022', '2023-03-25 10:04:33'),
(100, 'PF08', 'CIM 306', 'YR_2020_2021', '2023-03-25 10:05:26'),
(101, 'PF04', 'CIM 308', 'YR_2020_2021', '2023-03-25 10:05:26'),
(102, 'PF08', 'CIT 414', 'YR_2019_2020', '2023-03-25 10:06:28'),
(103, 'PF08', 'CIS 414', 'YR_2019_2020', '2023-03-25 10:07:11'),
(104, 'PF08', 'CIS 412', 'YR_2019_2020', '2023-03-25 10:07:11'),
(105, 'PF60', 'CIM 204', 'YR_2021_2022', '2023-03-25 10:11:33'),
(106, 'PF60', 'CIM 406', 'YR_2019_2020', '2023-03-25 10:12:20'),
(107, 'PF60', 'CIM 412', 'YR_2019_2020', '2023-03-25 10:12:20'),
(108, 'PF60', 'ABA 424', 'YR_2019_2020', '2023-03-25 10:14:18'),
(109, 'PF60', 'CIS 312', 'YR_2020_2021', '2023-03-25 10:15:38'),
(110, 'PF60', 'CIS 402', 'YR_2019_2020', '2023-03-25 10:16:25'),
(111, 'PF15', 'CIM 206', 'YR_2021_2022', '2023-03-25 10:18:55'),
(112, 'PF15', 'CIM 208', 'YR_2021_2022', '2023-03-25 10:18:55'),
(113, 'PF15', 'CIT 316', 'YR_2020_2021', '2023-03-25 10:21:48'),
(114, 'PF17', 'CIM 214', 'YR_2021_2022', '2023-03-25 10:25:32'),
(115, 'PF17', 'CIM 210', 'YR_2021_2022', '2023-03-25 10:25:32'),
(116, 'PF17', 'CIM 402', 'YR_2019_2020', '2023-03-25 10:47:12'),
(117, 'PF17', 'CIT 304', 'YR_2020_2021', '2023-03-25 10:48:16'),
(118, 'PF17', 'CIT 408', 'YR_2019_2020', '2023-03-25 10:48:44'),
(119, 'PF17', 'CIS 416', 'YR_2019_2020', '2023-03-25 10:49:25'),
(120, 'PF12', 'CIM 304', 'YR_2020_2021', '2023-03-25 10:50:32'),
(121, 'PF12', 'CIM 316', 'YR_2020_2021', '2023-03-25 10:50:32'),
(122, 'PF12', 'CIT 216', 'YR_2021_2022', '2023-03-25 10:51:23'),
(123, 'PF12', 'CIS 204', 'YR_2021_2022', '2023-03-25 10:52:16'),
(124, 'PF12', 'CIT 318', 'YR_2020_2021', '2023-03-25 10:53:09'),
(125, 'PF04', 'CIT 202', 'YR_2021_2022', '2023-03-25 10:58:48'),
(126, 'PF04', 'CIT 306', 'YR_2020_2021', '2023-03-25 11:01:13'),
(127, 'PF04', 'CIS 302', 'YR_2020_2021', '2023-03-25 11:02:52'),
(128, 'PF04', 'CIS 310', 'YR_2020_2021', '2023-03-25 11:02:52'),
(129, 'PF04', 'CIS 404', 'YR_2019_2020', '2023-03-25 11:04:04'),
(130, 'PF02', 'CIM 418', 'YR_2019_2020', '2023-03-25 11:10:52'),
(131, 'PF18', 'CIS 406', 'YR_2019_2020', '2023-03-25 11:29:20'),
(132, 'PF07', 'CIM 322', 'YR_2020_2021', '2023-03-25 11:33:46'),
(133, 'PF19', 'CIM 422', 'YR_2019_2020', '2023-03-25 11:35:16'),
(134, 'PF07', 'CIT 308', 'YR_2020_2021', '2023-03-25 11:38:27'),
(135, 'PF07', 'CIS 308', 'YR_2020_2021', '2023-03-25 11:39:57'),
(136, 'PF03', 'CIM 420', 'YR_2019_2020', '2023-03-25 11:45:11'),
(137, 'PF03', 'CIT 310', 'YR_2020_2021', '2023-03-25 11:48:42'),
(138, 'PF03', 'CIT 404', 'YR_2019_2020', '2023-03-25 11:49:22'),
(139, 'PF03', 'CIT 418', 'YR_2019_2020', '2023-03-25 11:49:22'),
(140, 'PF13', 'CIT 314', 'YR_2020_2021', '2023-03-25 11:51:29'),
(141, 'PF15', 'CIS 314', 'YR_2020_2021', '2023-03-25 11:52:35'),
(142, 'PF03', 'CIS 306', 'YR_2020_2021', '2023-03-25 11:53:09'),
(143, 'PF52', 'CIS 408', 'YR_2019_2020', '2023-03-25 11:57:40'),
(144, 'PF52', 'CIT 208', 'YR_2021_2022', '2023-03-25 12:00:33'),
(145, 'PF14', 'CIT 302', 'YR_2020_2021', '2023-03-25 12:04:14'),
(146, 'PF14', 'CIT 406', 'YR_2019_2020', '2023-03-25 12:05:28'),
(147, 'PF11', 'CIS 202', 'YR_2021_2022', '2023-03-25 12:07:19'),
(148, 'PF11', 'CIS 206', 'YR_2021_2022', '2023-03-25 12:08:18'),
(149, 'PF14', 'CIS 210', 'YR_2021_2022', '2023-03-25 12:09:01'),
(150, 'PF60', 'ABS 424', 'YR_2019_2020', '2023-03-25 12:13:40'),
(151, 'PF08', 'CIT 120', 'YR_2022_2023', '2023-03-25 12:20:41'),
(152, 'PF20', 'CCS 216', 'YR_2021_2022', '2023-03-27 05:19:44'),
(153, 'PF28', 'CCS 106', 'YR_2022_2023', '2023-03-27 05:21:29'),
(154, 'PF28', 'CCS 110', 'YR_2022_2023', '2023-03-27 05:21:29'),
(155, 'PF28', 'CCS 114', 'YR_2022_2023', '2023-03-27 05:21:29'),
(156, 'PF28', 'CCT 106', 'YR_2022_2023', '2023-03-27 05:21:50'),
(157, 'PF28', 'CCT 102', 'YR_2022_2023', '2023-03-27 05:21:50'),
(158, 'PF28', 'CCS 112', 'YR_2022_2023', '2023-03-27 05:22:09'),
(159, 'PF24', 'CCS 102', 'YR_2022_2023', '2023-03-27 05:22:58'),
(160, 'PF22', 'CCS 108', 'YR_2022_2023', '2023-03-27 05:23:28'),
(161, 'PF22', 'CCS 310', 'YR_2020_2021', '2023-03-27 05:23:50'),
(162, 'PF22', 'CCS 422', 'YR_2019_2020', '2023-03-27 05:24:04'),
(163, 'PF22', 'CCT 108', 'YR_2022_2023', '2023-03-27 05:24:35'),
(164, 'PF25', 'CCT 114', 'YR_2022_2023', '2023-03-27 05:25:31'),
(165, 'PF25', 'CCT 110', 'YR_2022_2023', '2023-03-27 05:25:31'),
(166, 'PF25', 'CCS 408', 'YR_2019_2020', '2023-03-27 05:26:12'),
(167, 'PF20', 'CCT 216', 'YR_2021_2022', '2023-03-27 05:27:52'),
(168, 'PF30', 'CCT 406', 'YR_2019_2020', '2023-03-27 05:33:26'),
(169, 'PF10', 'CIT 402', 'YR_2019_2020', '2023-04-30 11:59:14');

-- --------------------------------------------------------

--
-- Table structure for table `role_details`
--

CREATE TABLE `role_details` (
  `id` int(11) NOT NULL,
  `role_id` varchar(20) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_details`
--

INSERT INTO `role_details` (`id`, `role_id`, `role_name`) VALUES
(1, 'role001', 'Admin'),
(2, 'role002', 'Lecturer'),
(3, 'role003', 'Chairperson'),
(4, 'role004', 'Dean');

-- --------------------------------------------------------

--
-- Table structure for table `room_details`
--

CREATE TABLE `room_details` (
  `id` int(11) NOT NULL,
  `room_id` varchar(100) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `room_type_id` varchar(100) NOT NULL,
  `room_capacity` bigint(20) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_details`
--

INSERT INTO `room_details` (`id`, `room_id`, `room_name`, `room_type_id`, `room_capacity`, `date_added`) VALUES
(1, 'RM-ELECTRONICS-LAB-I', 'Electronics LAB I', 'RM_ELECTRONIC_LAB', 90, '2023-03-26 08:54:20'),
(2, 'RM-ELECTRONICS-LAB-II', 'Electronics LAB II', 'RM_ELECTRONIC_LAB', 110, '2023-04-02 12:37:22'),
(22, 'RM-ELECTRONICS-LAB-III', 'Electronics LAB III', 'RM_ELECTRONIC_LAB', 115, '2023-04-14 22:00:12'),
(3, 'RM-LAB-I', 'LAB I', 'RM_ICT_LAB', 55, '2023-03-06 12:02:32'),
(4, 'RM-LAB-II', 'LAB II', 'RM_ICT_LAB', 70, '2023-03-06 12:02:51'),
(5, 'RM-LAB-III', 'LAB III', 'RM_ICT_LAB', 85, '2023-03-06 12:03:10'),
(6, 'RM-LAB-IV', 'LAB IV', 'RM_ICT_LAB', 55, '2023-03-06 12:03:24'),
(19, 'RM-LAB-IX', 'LAB IX', 'RM_ICT_LAB', 100, '2023-04-14 21:58:59'),
(7, 'RM-LAB-V', 'LAB V', 'RM_ICT_LAB', 200, '2023-03-06 12:03:38'),
(8, 'RM-LAB-VI', 'LAB VI', 'RM_ICT_LAB', 85, '2023-03-30 11:49:57'),
(9, 'RM-LAB-VII', 'LAB VII', 'RM_ICT_LAB', 120, '2023-03-30 11:50:12'),
(10, 'RM-TB-1', 'TB 1', 'RM_STD', 100, '2023-03-06 12:00:39'),
(20, 'RM-TB-10', 'TB 10', 'RM_STD', 90, '2023-04-14 21:59:43'),
(21, 'RM-TB-11', 'TB 11', 'RM_STD', 80, '2023-04-14 21:59:55'),
(11, 'RM-TB-2', 'TB 2', 'RM_STD', 150, '2023-03-06 12:00:54'),
(12, 'RM-TB-3', 'TB 3', 'RM_STD', 75, '2023-03-06 12:01:09'),
(13, 'RM-TB-4', 'TB 4', 'RM_STD', 90, '2023-03-06 12:01:24'),
(14, 'RM-TB-5', 'TB 5', 'RM_STD', 65, '2023-03-30 11:48:21'),
(15, 'RM-TB-6', 'TB 6', 'RM_STD', 95, '2023-03-30 11:48:33'),
(16, 'RM-TB-7', 'TB 7', 'RM_STD', 85, '2023-03-30 11:48:52'),
(17, 'RM-TB-8', 'TB 8', 'RM_STD', 110, '2023-04-02 12:34:06'),
(18, 'RM-TB-9', 'TB 9', 'RM_STD', 140, '2023-04-02 12:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `room_type_details`
--

CREATE TABLE `room_type_details` (
  `id` int(11) NOT NULL,
  `room_type_id` varchar(100) NOT NULL,
  `room_type` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_type_details`
--

INSERT INTO `room_type_details` (`id`, `room_type_id`, `room_type`, `date_added`) VALUES
(7, 'RM_AMPH', 'Amphitheatre', '2023-03-06 14:14:51'),
(4, 'RM_BIO_LAB', 'Biology Lab', '2023-03-06 14:12:55'),
(3, 'RM_CHEM_LAB', 'Chemistry Lab', '2023-03-06 14:12:55'),
(8, 'RM_ELECTRONIC_LAB', 'Electronics LAB', '2023-03-26 11:52:42'),
(2, 'RM_ICT_LAB', 'ICT Labaratory', '2023-03-06 14:12:00'),
(5, 'RM_PHY_LAB', 'Physics Lab', '2023-03-06 14:13:35'),
(1, 'RM_STD', 'Standard', '2023-03-06 14:12:00'),
(6, 'RM_ZOOLOGY_LAB', 'Zoology Lab', '2023-03-06 14:13:35');

-- --------------------------------------------------------

--
-- Table structure for table `school_department_details`
--

CREATE TABLE `school_department_details` (
  `id` int(11) NOT NULL,
  `school_id` varchar(100) NOT NULL,
  `department_id` varchar(100) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_department_details`
--

INSERT INTO `school_department_details` (`id`, `school_id`, `department_id`, `date_updated`) VALUES
(1, 'MSU_COMPUTING', 'DPT_INFORMATIONTECHNOLOGY', '2023-02-28 15:15:22'),
(2, 'MSU_COMPUTING', 'DPT_COMPUTERSCIENCE', '2023-02-28 15:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `school_details`
--

CREATE TABLE `school_details` (
  `id` int(11) NOT NULL,
  `school_id` varchar(100) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_shortform` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_details`
--

INSERT INTO `school_details` (`id`, `school_id`, `school_name`, `school_shortform`, `date_created`) VALUES
(11, 'MSU_AGRICULTURE', 'Agriculture,Food Security and Environmental Sciences', 'Agriculture', '2023-02-20 20:42:28'),
(6, 'MSU_ARTS', 'Arts and Social Sciences', 'Arts', '2023-02-20 20:20:11'),
(7, 'MSU_BUSINESS', 'Business and Economics', 'Business', '2023-02-20 20:23:28'),
(1, 'MSU_COMPUTING', 'Computing and Informatics', 'Computing', '2023-02-20 19:57:41'),
(2, 'MSU_DEVELOPMENT', 'Development and Strategic Planning', 'Development', '2023-02-20 19:57:50'),
(3, 'MSU_EDUCATION', 'Education', 'Education', '2023-02-20 19:58:24'),
(12, 'MSU_MATHEMATICS', 'Mathematics, Statistics and Actuarial Sciences', 'Mathematics', '2023-02-22 10:30:41'),
(8, 'MSU_NURSING', 'Nursing', 'Nursing', '2023-02-20 20:24:14'),
(4, 'MSU_PHARMACY', 'Pharmacy', 'Pharmacy', '2023-02-20 19:59:02'),
(9, 'MSU_PHYSICAL', 'Physical and Biological Studies', 'Physical', '2023-02-20 20:31:34'),
(5, 'MSU_PLANNING', 'Planning and Architecture', 'Planning', '2023-02-20 19:59:44'),
(10, 'MSU_PUBLICHEALTH', 'Public Health and Community Development', 'Public Health', '2023-02-20 20:38:10');

-- --------------------------------------------------------

--
-- Table structure for table `semester_details`
--

CREATE TABLE `semester_details` (
  `id` int(11) NOT NULL,
  `semester_id` varchar(20) NOT NULL,
  `semester_name` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester_details`
--

INSERT INTO `semester_details` (`id`, `semester_id`, `semester_name`, `date_added`) VALUES
(1, 'Y1S1', 'Year 1 Semester 1', '2023-02-17 05:19:33'),
(2, 'Y1S2', 'Year 1 Semester 2', '2023-02-17 05:19:33'),
(3, 'Y2S1', 'Year 2 Semester 1', '2023-02-17 05:19:53'),
(4, 'Y2S2', 'Year 2 Semester 2', '2023-02-17 05:19:53'),
(5, 'Y3S1', 'Year 3 Semester 1', '2023-02-17 05:20:16'),
(6, 'Y3S2', 'Year 3 Semester 2', '2023-02-17 05:20:16'),
(7, 'Y4S1', 'Year 4 Semester 1', '2023-02-17 05:20:39'),
(8, 'Y4S2', 'Year 4 Semester 2', '2023-02-17 05:20:39');

-- --------------------------------------------------------

--
-- Table structure for table `unit_course_details`
--

CREATE TABLE `unit_course_details` (
  `id` int(11) NOT NULL,
  `unit_id` varchar(100) NOT NULL,
  `course_id` varchar(100) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_course_details`
--

INSERT INTO `unit_course_details` (`id`, `unit_id`, `course_id`, `date_updated`) VALUES
(11, 'CIT 101', 'CRS_IT', '2023-03-01 19:26:18'),
(12, 'CIT 103', 'CRS_IT', '2023-03-01 19:26:46'),
(13, 'CIT 105', 'CRS_IT', '2023-03-01 19:27:11'),
(14, 'CIT 107', 'CRS_IT', '2023-03-01 19:27:37'),
(15, 'CIT 109', 'CRS_IT', '2023-03-01 19:28:05'),
(16, 'CIT 111', 'CRS_IT', '2023-03-01 19:28:31'),
(19, 'CIT 102', 'CRS_IT', '2023-03-01 19:29:55'),
(20, 'CIT 104', 'CRS_IT', '2023-03-01 19:30:21'),
(21, 'CIT 106', 'CRS_IT', '2023-03-01 19:30:47'),
(22, 'CIT 108', 'CRS_IT', '2023-03-01 19:31:08'),
(23, 'CIT 110', 'CRS_IT', '2023-03-01 19:31:31'),
(25, 'CIT 114', 'CRS_IT', '2023-03-01 19:32:22'),
(26, 'CIT 116', 'CRS_IT', '2023-03-01 19:32:42'),
(27, 'CIT 201', 'CRS_IT', '2023-03-01 19:33:13'),
(28, 'CIT 203', 'CRS_IT', '2023-03-01 19:33:35'),
(29, 'CIT 205', 'CRS_IT', '2023-03-01 19:33:58'),
(30, 'CIT 207', 'CRS_IT', '2023-03-01 19:34:33'),
(31, 'CIT 209', 'CRS_IT', '2023-03-01 19:34:52'),
(32, 'CIT 211', 'CRS_IT', '2023-03-01 19:35:15'),
(33, 'CIT 213', 'CRS_IT', '2023-03-01 19:35:47'),
(34, 'CIT 215', 'CRS_IT', '2023-03-01 19:36:08'),
(35, 'CIT 202', 'CRS_IT', '2023-03-01 19:36:55'),
(36, 'CIT 204', 'CRS_IT', '2023-03-01 19:37:21'),
(37, 'CIT 206', 'CRS_IT', '2023-03-01 19:37:55'),
(38, 'CIT 208', 'CRS_IT', '2023-03-01 19:38:17'),
(39, 'CIT 210', 'CRS_IT', '2023-03-01 19:38:44'),
(40, 'CIT 212', 'CRS_IT', '2023-03-01 19:39:17'),
(41, 'CIT 214', 'CRS_IT', '2023-03-01 19:39:39'),
(42, 'CIT 216', 'CRS_IT', '2023-03-01 19:40:07'),
(43, 'CIT 301', 'CRS_IT', '2023-03-01 19:40:41'),
(44, 'CIT 305', 'CRS_IT', '2023-03-01 19:41:07'),
(45, 'CIT 307', 'CRS_IT', '2023-03-01 19:41:30'),
(46, 'CIT 309', 'CRS_IT', '2023-03-01 19:41:54'),
(48, 'CIT 311', 'CRS_IT', '2023-03-01 19:42:44'),
(49, 'CIT 313', 'CRS_IT', '2023-03-01 19:43:10'),
(50, 'CIT 315', 'CRS_IT', '2023-03-01 19:43:49'),
(51, 'CIT 317', 'CRS_IT', '2023-03-01 19:44:17'),
(52, 'CIT 319', 'CRS_IT', '2023-03-01 19:44:38'),
(53, 'CIT 302', 'CRS_IT', '2023-03-01 19:45:06'),
(54, 'CIT 304', 'CRS_IT', '2023-03-01 19:45:27'),
(55, 'CIT 312', 'CRS_IT', '2023-03-01 19:45:53'),
(56, 'CIT 318', 'CRS_IT', '2023-03-01 19:46:24'),
(57, 'CIT 306', 'CRS_IT', '2023-03-01 19:47:23'),
(58, 'CIT 308', 'CRS_IT', '2023-03-01 19:47:49'),
(59, 'CIT 310', 'CRS_IT', '2023-03-01 19:48:17'),
(60, 'CIT 314', 'CRS_IT', '2023-03-01 19:48:39'),
(61, 'CIT 316', 'CRS_IT', '2023-03-01 19:49:03'),
(62, 'CIT 320', 'CRS_IT', '2023-03-01 19:49:25'),
(63, 'CIT 322', 'CRS_IT', '2023-03-01 19:49:48'),
(64, 'CIT 401', 'CRS_IT', '2023-03-01 19:51:06'),
(65, 'CIT 405', 'CRS_IT', '2023-03-01 19:52:54'),
(66, 'CIT 409', 'CRS_IT', '2023-03-01 19:53:36'),
(67, 'CIT 411', 'CRS_IT', '2023-03-01 19:54:59'),
(69, 'CIT 407', 'CRS_IT', '2023-03-01 19:55:42'),
(70, 'CIT 413', 'CRS_IT', '2023-03-01 19:56:09'),
(71, 'CIT 415', 'CRS_IT', '2023-03-01 19:57:06'),
(72, 'CIT 419', 'CRS_IT', '2023-03-01 19:58:04'),
(73, 'ABA 424', 'CRS_IT', '2023-03-01 20:45:43'),
(74, 'CIT 402', 'CRS_IT', '2023-03-01 20:46:11'),
(76, 'CIT 406', 'CRS_IT', '2023-03-01 20:47:18'),
(77, 'CIT 408', 'CRS_IT', '2023-03-01 20:48:06'),
(78, 'CIT 410', 'CRS_IT', '2023-03-01 20:48:35'),
(79, 'CIT 412', 'CRS_IT', '2023-03-01 20:49:03'),
(80, 'CIT 414', 'CRS_IT', '2023-03-01 20:49:43'),
(81, 'CIT 416', 'CRS_IT', '2023-03-01 20:50:14'),
(82, 'CIT 418', 'CRS_IT', '2023-03-01 20:50:43'),
(83, 'CIT 420', 'CRS_IT', '2023-03-01 20:51:08'),
(87, 'CIS 101', 'CRS_IS', '2023-03-02 05:57:03'),
(88, 'CIS 103', 'CRS_IS', '2023-03-02 05:59:05'),
(90, 'CIS 105', 'CRS_IS', '2023-03-02 05:59:31'),
(91, 'CIS 107', 'CRS_IS', '2023-03-02 05:59:57'),
(92, 'CIS 109', 'CRS_IS', '2023-03-02 06:00:23'),
(93, 'CIS 111', 'CRS_IS', '2023-03-02 06:00:53'),
(94, 'CIS 102', 'CRS_IS', '2023-03-02 06:01:51'),
(95, 'CIS 104', 'CRS_IS', '2023-03-02 06:02:23'),
(96, 'CIS 106', 'CRS_IS', '2023-03-02 06:02:49'),
(97, 'CIS 108', 'CRS_IS', '2023-03-02 06:03:11'),
(98, 'CIS 110', 'CRS_IS', '2023-03-02 06:03:38'),
(99, 'CIS 112', 'CRS_IS', '2023-03-02 06:04:00'),
(100, 'CIS 114', 'CRS_IS', '2023-03-02 06:04:22'),
(101, ' CIS 201', 'CRS_IS', '2023-03-02 06:04:52'),
(102, 'CIS 203', 'CRS_IS', '2023-03-02 06:05:19'),
(103, 'CIS 205', 'CRS_IS', '2023-03-02 06:05:43'),
(104, 'CIS 207', 'CRS_IS', '2023-03-02 06:06:21'),
(105, 'CIS 209', 'CRS_IS', '2023-03-02 06:06:47'),
(106, 'CIS 211', 'CRS_IS', '2023-03-02 06:07:13'),
(107, 'CIS 213', 'CRS_IS', '2023-03-02 06:07:44'),
(108, 'CIS 215', 'CRS_IS', '2023-03-02 06:08:06'),
(109, 'CIS 202', 'CRS_IS', '2023-03-02 06:08:35'),
(110, 'CIS 204', 'CRS_IS', '2023-03-02 06:09:01'),
(111, 'CIS 206', 'CRS_IS', '2023-03-02 06:09:34'),
(112, 'CIS 208', 'CRS_IS', '2023-03-02 06:10:19'),
(113, 'CIS 210', 'CRS_IS', '2023-03-02 06:17:22'),
(114, 'CIS 212', 'CRS_IS', '2023-03-02 06:17:48'),
(115, 'CIS 214', 'CRS_IS', '2023-03-02 06:18:31'),
(116, 'CIS 301', 'CRS_IS', '2023-03-02 06:19:15'),
(117, 'CIS 303', 'CRS_IS', '2023-03-02 06:19:56'),
(118, 'CIS 305', 'CRS_IS', '2023-03-02 06:20:33'),
(119, 'CIS 307', 'CRS_IS', '2023-03-02 06:20:56'),
(120, 'CIS 309', 'CRS_IS', '2023-03-02 06:21:21'),
(121, 'CIS 311', 'CRS_IS', '2023-03-02 06:21:48'),
(122, 'CIS 313', 'CRS_IS', '2023-03-02 06:22:18'),
(123, 'CIS 315', 'CRS_IS', '2023-03-02 06:22:43'),
(124, 'CIS 302', 'CRS_IS', '2023-03-02 06:23:13'),
(125, 'CIS 304', 'CRS_IS', '2023-03-02 06:23:36'),
(126, 'CIS 306', 'CRS_IS', '2023-03-02 06:24:08'),
(127, 'CIS 308', 'CRS_IS', '2023-03-02 06:24:37'),
(128, 'CIS 310', 'CRS_IS', '2023-03-02 06:25:00'),
(129, 'CIS 312', 'CRS_IS', '2023-03-02 06:25:25'),
(130, 'CIS 314', 'CRS_IS', '2023-03-02 06:25:56'),
(131, 'CIS 316', 'CRS_IS', '2023-03-02 06:26:23'),
(132, 'CIS 318', 'CRS_IS', '2023-03-02 06:26:50'),
(133, 'CIS 401', 'CRS_IS', '2023-03-02 06:27:49'),
(134, 'CIS 403', 'CRS_IS', '2023-03-02 06:28:19'),
(135, 'CIS 405', 'CRS_IS', '2023-03-02 06:28:41'),
(136, 'CIS 407', 'CRS_IS', '2023-03-02 06:29:04'),
(137, 'CIS 409', 'CRS_IS', '2023-03-02 06:29:27'),
(138, 'CIS 411', 'CRS_IS', '2023-03-02 06:29:55'),
(139, 'CIS 413', 'CRS_IS', '2023-03-02 06:30:22'),
(140, 'CIS 415', 'CRS_IS', '2023-03-02 06:30:54'),
(141, 'CIS 417', 'CRS_IS', '2023-03-02 06:31:21'),
(142, 'CIS 402', 'CRS_IS', '2023-03-02 06:32:00'),
(143, 'CIS 404', 'CRS_IS', '2023-03-02 06:32:39'),
(144, 'CIS 406', 'CRS_IS', '2023-03-02 06:33:21'),
(145, 'CIS 408', 'CRS_IS', '2023-03-02 06:33:56'),
(146, 'CIS 410', 'CRS_IS', '2023-03-02 06:34:21'),
(147, 'CIS 412', 'CRS_IS', '2023-03-02 06:34:42'),
(148, 'CIS 414', 'CRS_IS', '2023-03-02 06:35:08'),
(149, 'CIS 416', 'CRS_IS', '2023-03-02 06:35:33'),
(150, 'CIS 418', 'CRS_IS', '2023-03-02 06:35:57'),
(151, 'CIM 101', 'CRS_ICTM', '2023-03-02 06:37:46'),
(152, 'CIM 103', 'CRS_ICTM', '2023-03-02 06:38:09'),
(153, 'CIM 105', 'CRS_ICTM', '2023-03-02 06:38:34'),
(154, 'CIM 107', 'CRS_ICTM', '2023-03-02 06:39:03'),
(155, 'CIM 109', 'CRS_ICTM', '2023-03-02 06:39:27'),
(156, 'CIM 111', 'CRS_ICTM', '2023-03-02 06:39:49'),
(157, 'CIM 113', 'CRS_ICTM', '2023-03-02 06:40:15'),
(159, 'CIM 104', 'CRS_ICTM', '2023-03-02 06:41:04'),
(160, 'CIM 106', 'CRS_ICTM', '2023-03-02 06:41:31'),
(165, 'CIM 116', 'CRS_ICTM', '2023-03-02 06:43:37'),
(166, ' CIM 201', 'CRS_ICTM', '2023-03-02 06:44:46'),
(167, 'CIM 201', 'CRS_ICTM', '2023-03-02 06:45:54'),
(168, 'CIM 203', 'CRS_ICTM', '2023-03-02 06:46:20'),
(169, 'CIM 205', 'CRS_ICTM', '2023-03-02 06:46:50'),
(170, 'CIM 207', 'CRS_ICTM', '2023-03-02 06:47:15'),
(171, 'CIM 209', 'CRS_ICTM', '2023-03-02 06:47:55'),
(172, 'CIM 211', 'CRS_ICTM', '2023-03-02 06:48:28'),
(173, 'CIM 213', 'CRS_ICTM', '2023-03-02 06:49:01'),
(174, 'CIM 215', 'CRS_ICTM', '2023-03-02 06:49:36'),
(176, 'CIM 204', 'CRS_ICTM', '2023-03-02 06:51:09'),
(177, 'CIM 206', 'CRS_ICTM', '2023-03-02 06:51:38'),
(178, 'CIM 208', 'CRS_ICTM', '2023-03-02 06:52:02'),
(179, 'CIM 210', 'CRS_ICTM', '2023-03-02 06:52:35'),
(180, 'CIM 212', 'CRS_ICTM', '2023-03-02 06:52:58'),
(181, 'CIM 214', 'CRS_ICTM', '2023-03-02 06:53:23'),
(182, 'CIM 216', 'CRS_ICTM', '2023-03-02 06:53:49'),
(183, 'CIM 301', 'CRS_ICTM', '2023-03-02 06:54:17'),
(184, 'CIM 303', 'CRS_ICTM', '2023-03-02 06:54:47'),
(185, 'CIM 307', 'CRS_ICTM', '2023-03-02 06:55:10'),
(186, 'CIM 311', 'CRS_ICTM', '2023-03-02 06:55:30'),
(187, 'CIM 305', 'CRS_ICTM', '2023-03-02 06:56:22'),
(188, 'CIM 309', 'CRS_ICTM', '2023-03-02 06:57:09'),
(189, 'CIM 313', 'CRS_ICTM', '2023-03-02 06:57:34'),
(190, 'CIM 315', 'CRS_ICTM', '2023-03-02 06:58:00'),
(191, 'CIM 317', 'CRS_ICTM', '2023-03-02 06:58:36'),
(192, 'CIM 319', 'CRS_ICTM', '2023-03-02 06:59:11'),
(193, 'CIM 321', 'CRS_ICTM', '2023-03-02 06:59:59'),
(194, 'CIM 302', 'CRS_ICTM', '2023-03-02 07:00:27'),
(195, 'CIM 304', 'CRS_ICTM', '2023-03-02 07:00:57'),
(196, 'CIM 308', 'CRS_ICTM', '2023-03-02 07:01:24'),
(197, 'CIM 312', 'CRS_ICTM', '2023-03-02 07:01:55'),
(198, 'CIM 306', 'CRS_ICTM', '2023-03-02 07:02:29'),
(199, 'CIM 310', 'CRS_ICTM', '2023-03-02 07:02:54'),
(200, 'CIM 316', 'CRS_ICTM', '2023-03-02 07:03:16'),
(201, 'CIM 318', 'CRS_ICTM', '2023-03-02 07:03:40'),
(202, 'CIM 320', 'CRS_ICTM', '2023-03-02 07:04:07'),
(203, 'CIM 322', 'CRS_ICTM', '2023-03-02 07:04:49'),
(204, 'CIM 324', 'CRS_ICTM', '2023-03-02 07:05:16'),
(205, 'CIM 401', 'CRS_ICTM', '2023-03-02 07:05:58'),
(206, 'CIM 403', 'CRS_ICTM', '2023-03-02 07:06:21'),
(207, 'CIM 407', 'CRS_ICTM', '2023-03-02 07:06:49'),
(208, 'CIM 409', 'CRS_ICTM', '2023-03-02 07:07:13'),
(209, 'CIM 405', 'CRS_ICTM', '2023-03-02 07:07:37'),
(210, 'CIM 411', 'CRS_ICTM', '2023-03-02 07:08:08'),
(211, 'CIM 413', 'CRS_ICTM', '2023-03-02 07:08:34'),
(212, 'CIM 415', 'CRS_ICTM', '2023-03-02 07:09:03'),
(213, 'CIM 417', 'CRS_ICTM', '2023-03-02 07:09:28'),
(216, 'CIM 423', 'CRS_ICTM', '2023-03-02 07:10:45'),
(217, 'CIM 425', 'CRS_ICTM', '2023-03-02 07:11:14'),
(218, 'CIM 402', 'CRS_ICTM', '2023-03-02 07:11:57'),
(219, 'CIM 404', 'CRS_ICTM', '2023-03-02 07:12:23'),
(220, 'CIM 406', 'CRS_ICTM', '2023-03-02 07:12:48'),
(221, 'CIM 408', 'CRS_ICTM', '2023-03-02 07:13:19'),
(222, 'CIM 410', 'CRS_ICTM', '2023-03-02 07:14:21'),
(223, 'CIM 412', 'CRS_ICTM', '2023-03-02 07:14:45'),
(224, 'CIM 414', 'CRS_ICTM', '2023-03-02 07:15:12'),
(225, 'CIM 416', 'CRS_ICTM', '2023-03-02 07:15:54'),
(226, 'CIM 418', 'CRS_ICTM', '2023-03-02 07:16:26'),
(227, 'CIM 420', 'CRS_ICTM', '2023-03-02 07:17:02'),
(228, 'CIM 422', 'CRS_ICTM', '2023-03-02 07:17:25'),
(229, 'CIM 424', 'CRS_ICTM', '2023-03-02 07:17:50'),
(230, 'CIM 426', 'CRS_ICTM', '2023-03-02 07:18:14'),
(231, 'CCT 101', 'CRS_CCT', '2023-03-02 07:22:48'),
(232, 'CCT 103', 'CRS_CCT', '2023-03-02 07:23:18'),
(233, 'CCT 105', 'CRS_CCT', '2023-03-02 07:23:50'),
(234, 'CCT 107', 'CRS_CCT', '2023-03-02 07:24:19'),
(235, 'CCT 109', 'CRS_CCT', '2023-03-02 07:24:46'),
(236, 'CCT 113', 'CRS_CCT', '2023-03-02 07:25:17'),
(237, 'CCT 115', 'CRS_CCT', '2023-03-02 07:25:40'),
(238, 'CCT 104', 'CRS_CCT', '2023-03-02 07:27:26'),
(239, 'CCT 106', 'CRS_CCT', '2023-03-02 07:27:56'),
(240, 'CCT 108', 'CRS_CCT', '2023-03-02 07:28:38'),
(241, 'CCT 110', 'CRS_CCT', '2023-03-02 07:31:50'),
(242, 'CCT 112', 'CRS_CCT', '2023-03-02 07:32:14'),
(243, 'CCT 114', 'CRS_CCT', '2023-03-02 07:32:46'),
(244, 'CCT 102', 'CRS_CCT', '2023-03-02 07:33:21'),
(245, 'CCT 201', 'CRS_CCT', '2023-03-02 07:34:09'),
(246, 'CCT 203', 'CRS_CCT', '2023-03-02 07:35:12'),
(247, 'CCT 205', 'CRS_CCT', '2023-03-02 07:35:45'),
(248, 'CCT 207', 'CRS_CCT', '2023-03-02 07:36:12'),
(249, 'CCT 209', 'CRS_CCT', '2023-03-02 07:36:42'),
(250, 'CCT 211', 'CRS_CCT', '2023-03-02 07:38:09'),
(251, 'CCT 213', 'CRS_CCT', '2023-03-02 07:38:44'),
(252, 'CCT 204', 'CRS_CCT', '2023-03-02 07:42:23'),
(253, 'CCT 202', 'CRS_CCT', '2023-03-02 07:42:47'),
(254, 'CCT 206', 'CRS_CCT', '2023-03-02 07:43:17'),
(255, 'CCT 208', 'CRS_CCT', '2023-03-02 07:43:48'),
(256, 'CCT 210', 'CRS_CCT', '2023-03-02 07:44:15'),
(257, 'CCT 212', 'CRS_CCT', '2023-03-02 07:44:42'),
(258, 'CCT 214', 'CRS_CCT', '2023-03-02 07:45:06'),
(259, 'CCT 216', 'CRS_CCT', '2023-03-02 07:45:30'),
(260, 'CCT 215', 'CRS_CCT', '2023-03-02 07:45:57'),
(261, 'CCT 301', 'CRS_CCT', '2023-03-02 07:46:54'),
(262, 'CCT 303	', 'CRS_CCT', '2023-03-02 07:47:18'),
(263, 'CCT 305', 'CRS_CCT', '2023-03-02 07:47:49'),
(264, 'CCT 307', 'CRS_CCT', '2023-03-02 07:48:16'),
(265, 'CCT 309', 'CRS_CCT', '2023-03-02 07:48:41'),
(266, 'CCT 311', 'CRS_CCT', '2023-03-02 07:49:11'),
(268, 'CCT 315', 'CRS_CCT', '2023-03-02 07:49:40'),
(269, 'CCT 317', 'CRS_CCT', '2023-03-02 07:50:07'),
(270, 'CCT 319', 'CRS_CCT', '2023-03-02 07:50:35'),
(271, 'CCT 302', 'CRS_CCT', '2023-03-02 07:51:09'),
(272, 'CCT 304', 'CRS_CCT', '2023-03-02 07:51:32'),
(273, 'CCT 306', 'CRS_CCT', '2023-03-02 07:51:58'),
(274, 'CCT 308', 'CRS_CCT', '2023-03-02 07:52:28'),
(275, 'CCT 312', 'CRS_CCT', '2023-03-02 07:52:52'),
(276, 'CCT 316', 'CRS_CCT', '2023-03-02 07:53:20'),
(277, 'CCT 320', 'CRS_CCT', '2023-03-02 07:53:55'),
(278, 'CCT 322', 'CRS_CCT', '2023-03-02 07:54:27'),
(279, 'CCT 401', 'CRS_CCT', '2023-03-02 07:55:25'),
(280, 'CCT 403', 'CRS_CCT', '2023-03-02 07:55:53'),
(281, 'CCT 405', 'CRS_CCT', '2023-03-02 07:56:37'),
(282, 'CCT 411', 'CRS_CCT', '2023-03-02 07:57:06'),
(283, 'CCT 413', 'CRS_CCT', '2023-03-02 07:57:28'),
(284, 'CCT 415', 'CRS_CCT', '2023-03-02 07:57:52'),
(285, 'CCT 417', 'CRS_CCT', '2023-03-02 07:58:15'),
(286, 'CCT 419', 'CRS_CCT', '2023-03-02 07:58:40'),
(287, 'CCT 425', 'CRS_CCT', '2023-03-02 07:59:05'),
(288, 'CCT 416', 'CRS_CCT', '2023-03-02 07:59:31'),
(289, 'CCT 402', 'CRS_CCT', '2023-03-02 08:00:11'),
(290, 'CCT 406', 'CRS_CCT', '2023-03-02 08:00:33'),
(291, 'CCT 407', 'CRS_CCT', '2023-03-02 08:01:10'),
(293, 'CCT 412', 'CRS_CCT', '2023-03-02 08:02:02'),
(294, 'CCT 418', 'CRS_CCT', '2023-03-02 08:02:26'),
(295, 'CCT 420', 'CRS_CCT', '2023-03-02 08:02:49'),
(296, 'CCT 430', 'CRS_CCT', '2023-03-02 08:03:16'),
(297, 'CCS 101', 'CRS_CCS', '2023-03-02 08:05:56'),
(298, 'CCS 103', 'CRS_CCS', '2023-03-02 08:06:21'),
(299, 'CCS 105', 'CRS_CCS', '2023-03-02 08:06:54'),
(300, 'CCS 107', 'CRS_CCS', '2023-03-02 08:07:22'),
(301, 'CCS 109', 'CRS_CCS', '2023-03-02 08:07:47'),
(302, 'CCS 111', 'CRS_CCS', '2023-03-02 08:08:16'),
(303, 'CCS 113', 'CRS_CCS', '2023-03-02 08:08:44'),
(304, 'CCS 102', 'CRS_CCS', '2023-03-02 08:09:12'),
(305, 'CCS 104', 'CRS_CCS', '2023-03-02 08:09:46'),
(306, 'CCS 106', 'CRS_CCS', '2023-03-02 08:10:09'),
(307, 'CCS 108', 'CRS_CCS', '2023-03-02 08:10:43'),
(308, 'CCS 110', 'CRS_CCS', '2023-03-02 08:11:31'),
(309, 'CCS 112', 'CRS_CCS', '2023-03-02 08:12:01'),
(310, 'CCS 114', 'CRS_CCS', '2023-03-02 08:12:26'),
(311, 'CCS 201', 'CRS_CCS', '2023-03-02 08:13:11'),
(312, 'CCS 203', 'CRS_CCS', '2023-03-02 08:13:41'),
(313, 'CCS 205', 'CRS_CCS', '2023-03-02 08:14:39'),
(314, 'CCS 207', 'CRS_CCS', '2023-03-02 08:15:13'),
(315, 'CCS 209', 'CRS_CCS', '2023-03-02 08:15:37'),
(316, 'CCS 211', 'CRS_CCS', '2023-03-02 08:16:12'),
(317, 'CCS 213', 'CRS_CCS', '2023-03-02 08:16:37'),
(318, 'CCS 202', 'CRS_CCS', '2023-03-02 08:17:06'),
(319, 'CCS 204', 'CRS_CCS', '2023-03-02 08:17:32'),
(320, 'CCS 206', 'CRS_CCS', '2023-03-02 08:18:11'),
(321, 'CCS 208', 'CRS_CCS', '2023-03-02 08:18:55'),
(322, 'CCS 210', 'CRS_CCS', '2023-03-02 08:19:22'),
(323, 'CCS 212', 'CRS_CCS', '2023-03-02 08:19:57'),
(324, 'CCS 214', 'CRS_CCS', '2023-03-02 08:20:21'),
(325, 'CCS 216', 'CRS_CCS', '2023-03-02 08:20:50'),
(326, 'CCS 301', 'CRS_CCS', '2023-03-02 08:21:44'),
(327, 'CCS 303', 'CRS_CCS', '2023-03-02 08:22:16'),
(328, 'CCS 305', 'CRS_CCS', '2023-03-02 08:22:53'),
(329, 'CCS 307', 'CRS_CCS', '2023-03-02 08:23:17'),
(330, 'CCS 309', 'CRS_CCS', '2023-03-02 08:23:51'),
(331, 'CCS 313', 'CRS_CCS', '2023-03-02 08:24:25'),
(332, 'CCS 315', 'CRS_CCS', '2023-03-02 08:24:52'),
(333, 'CCS 317', 'CRS_CCS', '2023-03-02 08:25:21'),
(334, 'CCS 319', 'CRS_CCS', '2023-03-02 08:25:53'),
(335, 'CCS 323', 'CRS_CCS', '2023-03-02 08:26:22'),
(336, 'CCS 302', 'CRS_CCS', '2023-03-02 08:27:31'),
(337, 'CCS 304', 'CRS_CCS', '2023-03-02 08:27:59'),
(338, 'CCS 306', 'CRS_CCS', '2023-03-02 08:28:28'),
(339, 'CCS 308', 'CRS_CCS', '2023-03-02 08:28:51'),
(340, 'CCS 310', 'CRS_CCS', '2023-03-02 08:29:21'),
(341, 'CCS 312', 'CRS_CCS', '2023-03-02 08:29:50'),
(342, 'CCS 314', 'CRS_CCS', '2023-03-02 08:30:14'),
(343, 'CCS 316', 'CRS_CCS', '2023-03-02 08:30:43'),
(344, 'CCS 318', 'CRS_CCS', '2023-03-02 08:31:09'),
(345, 'CCS 401', 'CRS_CCS', '2023-03-02 08:32:05'),
(346, 'CCS 403', 'CRS_CCS', '2023-03-02 08:32:28'),
(347, 'CCS 405', 'CRS_CCS', '2023-03-02 08:32:52'),
(348, 'CCS 407', 'CRS_CCS', '2023-03-02 08:33:25'),
(349, 'CCS 409', 'CRS_CCS', '2023-03-02 08:33:50'),
(350, 'CCS 415', 'CRS_CCS', '2023-03-02 08:34:31'),
(351, 'CCS 417', 'CRS_CCS', '2023-03-02 08:34:53'),
(352, 'CCS 419', 'CRS_CCS', '2023-03-02 08:35:19'),
(353, 'CCS 421', 'CRS_CCS', '2023-03-02 08:35:45'),
(354, 'CCS 420', 'CRS_CCS', '2023-03-02 08:36:08'),
(355, 'CCS 404', 'CRS_CCS', '2023-03-02 08:36:39'),
(356, 'CCS 406', 'CRS_CCS', '2023-03-02 08:37:02'),
(357, 'CCS 408', 'CRS_CCS', '2023-03-02 08:37:35'),
(358, 'CCS 412', 'CRS_CCS', '2023-03-02 08:37:58'),
(359, 'CCS 414', 'CRS_CCS', '2023-03-02 08:38:24'),
(360, 'CCS 418', 'CRS_CCS', '2023-03-02 08:38:50'),
(361, 'CCS 422', 'CRS_CCS', '2023-03-02 08:39:17'),
(363, 'CCS 416', 'CRS_CCS', '2023-03-20 20:23:40'),
(366, 'CCT 116', 'CRS_CCT', '2023-03-20 20:33:25'),
(367, 'CCT 118', 'CRS_CCT', '2023-03-20 20:36:18'),
(368, 'CCS 122', 'CRS_CCS', '2023-03-20 20:36:54'),
(369, 'CCT 318', 'CRS_CCT', '2023-03-20 20:37:29'),
(371, 'CIT 118', 'CRS_IT', '2023-03-25 07:53:09'),
(372, 'CIT 120', 'CRS_IT', '2023-03-25 07:54:12'),
(373, 'CIM 118', 'CRS_ICTM', '2023-03-25 08:22:18'),
(375, 'CIM 108', 'CRS_ICTM', '2023-03-25 08:32:50'),
(376, 'CIM 120', 'CRS_ICTM', '2023-03-25 08:33:41'),
(377, 'CIM 202', 'CRS_ICTM', '2023-03-25 08:36:26'),
(378, 'CIT 404', 'CRS_IT', '2023-03-25 08:42:27'),
(379, 'CIS 118', 'CRS_IS', '2023-03-25 08:44:44'),
(380, 'CIS 120', 'CRS_IS', '2023-03-25 08:46:01'),
(383, 'ABS 424', 'CRS_IS', '2023-03-25 12:12:49'),
(384, 'CIT 403', 'CRS_IT', '2023-03-25 12:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `unit_details`
--

CREATE TABLE `unit_details` (
  `id` int(11) NOT NULL,
  `unit_code` varchar(50) NOT NULL,
  `unit_name` varchar(100) NOT NULL,
  `unit_type` varchar(50) NOT NULL,
  `unit_active` varchar(20) NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_details`
--

INSERT INTO `unit_details` (`id`, `unit_code`, `unit_name`, `unit_type`, `unit_active`, `date_added`) VALUES
(152, ' CIM 201', 'Organizational Processes I', 'Theory', 'Active', '2023-03-02 06:44:46'),
(87, ' CIS 201', 'Introduction to Information Systems and Technology', 'Theory', 'Active', '2023-03-02 06:04:52'),
(63, 'ABA 424', 'Entrepreneurship and Small Business Management', 'Theory', 'Active', '2023-03-01 20:45:43'),
(369, 'ABS 424', 'Entrepreneurship and Small Business Management', 'Theory', 'Active', '2023-03-25 12:12:49'),
(283, 'CCS 101', 'Fundamentals of Computing', 'Theory', 'Active', '2023-03-02 08:05:55'),
(290, 'CCS 102', 'Linear Algebra', 'Theory', 'Active', '2023-03-02 08:09:12'),
(284, 'CCS 103', 'Discrete Structures I', 'Theory', 'Active', '2023-03-02 08:06:21'),
(291, 'CCS 104', 'Object Oriented Programming', 'ICT-Practical', 'Active', '2023-03-02 08:09:45'),
(285, 'CCS 105', 'Electrical Principles', 'Theory', 'Active', '2023-03-02 08:06:54'),
(292, 'CCS 106', 'Discrete Structures II', 'Theory', 'Active', '2023-03-02 08:10:09'),
(286, 'CCS 107', 'Electronics', 'Theory', 'Active', '2023-03-02 08:07:22'),
(293, 'CCS 108', 'Digital Electronics 1', 'ELECT-Practical', 'Active', '2023-03-02 08:10:43'),
(287, 'CCS 109', 'Basic Calculus', 'Theory', 'Active', '2023-03-02 08:07:47'),
(294, 'CCS 110', 'Introduction to Internet Technologies', 'Theory', 'Active', '2023-03-02 08:11:31'),
(288, 'CCS 111', 'Introduction to Programming', 'ICT-Practical', 'Active', '2023-03-02 08:08:16'),
(295, 'CCS 112', 'Databases Systems', 'Theory', 'Active', '2023-03-02 08:12:01'),
(289, 'CCS 113', 'Programming in C', 'ICT-Practical', 'Active', '2023-03-02 08:08:44'),
(296, 'CCS 114', 'Introduction to Spreadsheets', 'ICT-Practical', 'Active', '2023-03-02 08:12:26'),
(354, 'CCS 122', 'Electronics', 'Theory', 'Active', '2023-03-20 20:36:54'),
(297, 'CCS 201', 'Object Oriented Programming II (Java)', 'ICT-Practical', 'Active', '2023-03-02 08:13:10'),
(304, 'CCS 202', 'Computer Organization and architecture', 'Theory', 'Active', '2023-03-02 08:17:05'),
(298, 'CCS 203', 'Data Structures and Algorithms', 'Theory', 'Active', '2023-03-02 08:13:40'),
(305, 'CCS 204', 'Assembly Language Programming', 'ICT-Practical', 'Active', '2023-03-02 08:17:32'),
(299, 'CCS 205', 'Probability and Statistics', 'Theory', 'Active', '2023-03-02 08:14:39'),
(306, 'CCS 206', 'Application Development for the Internet', 'Theory', 'Active', '2023-03-02 08:18:11'),
(300, 'CCS 207', 'Digital Electronics II', 'ELECT-Practical', 'Active', '2023-03-02 08:15:13'),
(307, 'CCS 208', 'Data Communications', 'Theory', 'Active', '2023-03-02 08:18:55'),
(301, 'CCS 209', 'Principles of Operating Systems', 'Theory', 'Active', '2023-03-02 08:15:37'),
(308, 'CCS 210', 'Automata Theory', 'Theory', 'Active', '2023-03-02 08:19:21'),
(302, 'CCS 211', 'Digital and Analogue Communication Systems', 'Theory', 'Active', '2023-03-02 08:16:12'),
(309, 'CCS 212', 'Web Design and Publishing', 'Theory', 'Active', '2023-03-02 08:19:57'),
(303, 'CCS 213', 'Systems Analysis and Design', 'Theory', 'Active', '2023-03-02 08:16:37'),
(310, 'CCS 214', 'Group Project', 'ICT-Practical', 'Active', '2023-03-02 08:20:21'),
(311, 'CCS 216', 'Visual Basic Programming', 'ICT-Practical', 'Active', '2023-03-02 08:20:50'),
(312, 'CCS 301', 'Principles of programming languages', 'Theory', 'Active', '2023-03-02 08:21:44'),
(322, 'CCS 302', 'Human Computer Interaction', 'Theory', 'Active', '2023-03-02 08:27:31'),
(313, 'CCS 303', 'Design and Analysis of algorithms', 'Theory', 'Active', '2023-03-02 08:22:16'),
(323, 'CCS 304', 'Project II ', 'ICT-Practical', 'Active', '2023-03-02 08:27:59'),
(314, 'CCS 305', 'Intro. to Compiler Construction and Design', 'Theory', 'Active', '2023-03-02 08:22:53'),
(324, 'CCS 306', 'Software Engineering', 'Theory', 'Active', '2023-03-02 08:28:28'),
(315, 'CCS 307', 'Computer Networks', 'Theory', 'Active', '2023-03-02 08:23:17'),
(325, 'CCS 308', 'Research Methods and Technical Writing', 'Theory', 'Active', '2023-03-02 08:28:51'),
(316, 'CCS 309', 'Information Systems Security and Design', 'Theory', 'Active', '2023-03-02 08:23:51'),
(326, 'CCS 310', 'Computer Graphics', 'Theory', 'Active', '2023-03-02 08:29:21'),
(327, 'CCS 312', 'Mobile Computing', 'Theory', 'Active', '2023-03-02 08:29:50'),
(317, 'CCS 313', 'Unix Operating Systems', 'Theory', 'Active', '2023-03-02 08:24:25'),
(328, 'CCS 314', 'Computer Networks Lab II (CISCO II)', 'ICT-Practical', 'Active', '2023-03-02 08:30:14'),
(318, 'CCS 315', 'Intelligent Systems', 'Theory', 'Active', '2023-03-02 08:24:52'),
(329, 'CCS 316', 'Network Administration', 'Theory', 'Active', '2023-03-02 08:30:43'),
(319, 'CCS 317', 'Computer Networks Lab I (CISCO)', 'ICT-Practical', 'Active', '2023-03-02 08:25:21'),
(330, 'CCS 318', 'Introduction to Expert Systems', 'Theory', 'Active', '2023-03-02 08:31:09'),
(320, 'CCS 319', 'Database Administration', 'Theory', 'Active', '2023-03-02 08:25:53'),
(321, 'CCS 323', 'Group Project', 'ICT-Practical', 'Active', '2023-03-02 08:26:22'),
(331, 'CCS 401', 'Software Project Management', 'Theory', 'Active', '2023-03-02 08:32:05'),
(332, 'CCS 403', 'Computer Science Project I', 'Theory', 'Active', '2023-03-02 08:32:28'),
(341, 'CCS 404', 'Social Legal and ethical issues in Computing', 'Theory', 'Active', '2023-03-02 08:36:39'),
(333, 'CCS 405', 'Management Information Systems', 'Theory', 'Active', '2023-03-02 08:32:51'),
(342, 'CCS 406', 'Computer Science Project II', 'ICT-Practical', 'Active', '2023-03-02 08:37:02'),
(334, 'CCS 407', 'Distributed Systems', 'Theory', 'Active', '2023-03-02 08:33:25'),
(343, 'CCS 408', 'Computer Networks Lab IV (CISCO IV)', 'ICT-Practical', 'Active', '2023-03-02 08:37:35'),
(335, 'CCS 409', 'Computer Networks Lab III (CISCO III)', 'ICT-Practical', 'Active', '2023-03-02 08:33:50'),
(344, 'CCS 412', 'Natural Language Processing', 'Theory', 'Active', '2023-03-02 08:37:58'),
(345, 'CCS 414', 'Pattern Recognition', 'Theory', 'Active', '2023-03-02 08:38:24'),
(336, 'CCS 415', 'Data Mining', 'Theory', 'Active', '2023-03-02 08:34:31'),
(349, 'CCS 416', 'Information Retrival', 'Theory', 'Active', '2023-03-20 20:23:40'),
(337, 'CCS 417', 'Principles of Functional Programming', 'Theory', 'Active', '2023-03-02 08:34:53'),
(346, 'CCS 418', 'Advanced Database Systems', 'Theory', 'Active', '2023-03-02 08:38:50'),
(338, 'CCS 419', 'Advanced Computer Architectures', 'Theory', 'Active', '2023-03-02 08:35:19'),
(340, 'CCS 420', 'Neural Networks', 'Theory', 'Active', '2023-03-02 08:36:08'),
(339, 'CCS 421', 'Intelligent Agents', 'Theory', 'Active', '2023-03-02 08:35:45'),
(347, 'CCS 422', 'Advanced Compiler Construction and Design', 'Theory', 'Active', '2023-03-02 08:39:17'),
(217, 'CCT 101', 'Fundamentals of Computing', 'Theory', 'Active', '2023-03-02 07:22:47'),
(230, 'CCT 102', 'Engineering Mathematics II', 'Theory', 'Active', '2023-03-02 07:33:21'),
(218, 'CCT 103', 'Discrete Structures I', 'Theory', 'Active', '2023-03-02 07:23:18'),
(224, 'CCT 104', 'Object Oriented programming in Java ', 'ICT-Practical', 'Active', '2023-03-02 07:27:26'),
(219, 'CCT 105', 'Electric Circuits I', 'Theory', 'Active', '2023-03-02 07:23:50'),
(225, 'CCT 106', 'Discrete Structures II', 'Theory', 'Active', '2023-03-02 07:27:56'),
(220, 'CCT 107', 'Electronics', 'Theory', 'Active', '2023-03-02 07:24:19'),
(226, 'CCT 108', 'Digital Logic Circuits', 'Theory', 'Active', '2023-03-02 07:28:38'),
(221, 'CCT 109', 'Engineering Mathematics I', 'Theory', 'Active', '2023-03-02 07:24:46'),
(227, 'CCT 110', 'Digital Logic Circuits Lab', 'ELECT-Practical', 'Active', '2023-03-02 07:31:50'),
(228, 'CCT 112', 'Electronics II', 'Theory', 'Active', '2023-03-02 07:32:13'),
(222, 'CCT 113', 'Programming in C', 'Theory', 'Active', '2023-03-02 07:25:17'),
(229, 'CCT 114', 'Electric Circuits II', 'Theory', 'Active', '2023-03-02 07:32:46'),
(223, 'CCT 115', 'Computer Aided Drawing and Design', 'Theory', 'Active', '2023-03-02 07:25:40'),
(352, 'CCT 116', 'Digital Electronics I', 'ELECT-Practical', 'Active', '2023-03-20 20:33:24'),
(353, 'CCT 118', 'Digital Electronics I LAB', 'ELECT-Practical', 'Active', '2023-03-20 20:36:18'),
(231, 'CCT 201', 'Object Oriented programming II', 'ICT-Practical', 'Active', '2023-03-02 07:34:09'),
(239, 'CCT 202', 'Digital Electronics II', 'ELECT-Practical', 'Active', '2023-03-02 07:42:47'),
(232, 'CCT 203', 'Data Structures and Algorithms', 'Theory', 'Active', '2023-03-02 07:35:12'),
(238, 'CCT 204', 'Principles of Operating Systems', 'Theory', 'Active', '2023-03-02 07:42:23'),
(233, 'CCT 205', 'Engineering Mathematics III', 'Theory', 'Active', '2023-03-02 07:35:45'),
(240, 'CCT 206', 'Circuits and Systems', 'Theory', 'Active', '2023-03-02 07:43:17'),
(234, 'CCT 207', 'Digital Electronics I', 'ELECT-Practical', 'Active', '2023-03-02 07:36:12'),
(241, 'CCT 208', 'Engineering Mathematics IV', 'Theory', 'In-Active', '2023-03-02 07:43:47'),
(235, 'CCT 209', 'Comp. Org. & Assm. Lang. Prog', 'Theory', 'Active', '2023-03-02 07:36:42'),
(242, 'CCT 210', 'Data Communications', 'Theory', 'Active', '2023-03-02 07:44:15'),
(236, 'CCT 211', 'Databases', 'Theory', 'Active', '2023-03-02 07:38:09'),
(243, 'CCT 212', 'Automata Theory', 'Theory', 'Active', '2023-03-02 07:44:42'),
(237, 'CCT 213', 'Electronics III', 'Theory', 'Active', '2023-03-02 07:38:44'),
(244, 'CCT 214', 'Signals and Systems', 'Theory', 'Active', '2023-03-02 07:45:06'),
(246, 'CCT 215', 'Applied Electromagnetics', 'Theory', 'Active', '2023-03-02 07:45:57'),
(245, 'CCT 216', 'Applied probability and Statistics', 'Theory', 'Active', '2023-03-02 07:45:30'),
(247, 'CCT 301', 'Computer Architecture I', 'Theory', 'Active', '2023-03-02 07:46:54'),
(257, 'CCT 302', 'Computer Architecture II', 'Theory', 'Active', '2023-03-02 07:51:09'),
(248, 'CCT 303	', 'Digital Signal Processing', 'Theory', 'Active', '2023-03-02 07:47:17'),
(258, 'CCT 304', 'Human Computer Interaction', 'Theory', 'Active', '2023-03-02 07:51:32'),
(249, 'CCT 305', 'Intro. Compiler Const. & Design', 'Theory', 'Active', '2023-03-02 07:47:49'),
(259, 'CCT 306', 'Mobile Computing', 'Theory', 'Active', '2023-03-02 07:51:58'),
(250, 'CCT 307', 'Computer Networks', 'Theory', 'Active', '2023-03-02 07:48:16'),
(260, 'CCT 308', 'Software Engineering', 'Theory', 'Active', '2023-03-02 07:52:28'),
(251, 'CCT 309', 'Digital Systems Design', 'Theory', 'Active', '2023-03-02 07:48:41'),
(252, 'CCT 311', 'Digital Systems Design Lab', 'ELECT-Practical', 'Active', '2023-03-02 07:49:11'),
(261, 'CCT 312', 'Embedded Computing Systems I', 'Theory', 'Active', '2023-03-02 07:52:52'),
(254, 'CCT 315', 'Communication Systems', 'Theory', 'Active', '2023-03-02 07:49:40'),
(262, 'CCT 316', 'Digital Communications Systems', 'Theory', 'Active', '2023-03-02 07:53:20'),
(255, 'CCT 317', 'Group Project I', 'Theory', 'Active', '2023-03-02 07:50:07'),
(355, 'CCT 318', 'Optical Devices and Systems', 'Theory', 'Active', '2023-03-20 20:37:29'),
(256, 'CCT 319', 'Computer Networks Lab I (Cisco I)', 'ICT-Practical', 'Active', '2023-03-02 07:50:35'),
(263, 'CCT 320', 'Group Project II', 'ICT-Practical', 'Active', '2023-03-02 07:53:55'),
(264, 'CCT 322', 'Computer Networks Lab II (Cisco II)', 'ICT-Practical', 'Active', '2023-03-02 07:54:27'),
(265, 'CCT 401', 'Computer Systems Engineering I', 'Theory', 'Active', '2023-03-02 07:55:24'),
(275, 'CCT 402', 'Computer-Aided Analysis and Design', 'ICT-Practical', 'Active', '2023-03-02 08:00:11'),
(266, 'CCT 403', 'Computer Design Lab', 'Theory', 'Active', '2023-03-02 07:55:53'),
(267, 'CCT 405', 'Computer Technology Project I', 'Theory', 'Active', '2023-03-02 07:56:37'),
(276, 'CCT 406', 'Computer Technology Project II', 'Theory', 'Active', '2023-03-02 08:00:33'),
(277, 'CCT 407', 'Social and Professional Issues', 'Theory', 'Active', '2023-03-02 08:01:10'),
(268, 'CCT 411', 'Neural Networks', 'Theory', 'Active', '2023-03-02 07:57:05'),
(279, 'CCT 412', 'Computer Systems Engineering II', 'Theory', 'Active', '2023-03-02 08:02:02'),
(269, 'CCT 413', 'Principles of Functional Programming', 'Theory', 'Active', '2023-03-02 07:57:28'),
(270, 'CCT 415', 'Embedded Computing Systems II', 'Theory', 'Active', '2023-03-02 07:57:52'),
(274, 'CCT 416', 'Data Mining', 'Theory', 'Active', '2023-03-02 07:59:31'),
(271, 'CCT 417', 'Simulation and Modeling', 'Theory', 'Active', '2023-03-02 07:58:14'),
(280, 'CCT 418', 'Natural Language Processing', 'Theory', 'Active', '2023-03-02 08:02:26'),
(272, 'CCT 419', 'Intelligent Agents', 'Theory', 'Active', '2023-03-02 07:58:40'),
(281, 'CCT 420', 'Pattern Recognition', 'Theory', 'Active', '2023-03-02 08:02:49'),
(273, 'CCT 425', 'Computer Networks Lab III (Cisco III)', 'ICT-Practical', 'Active', '2023-03-02 07:59:05'),
(282, 'CCT 430', 'Computer Networks Lab IV (Cisco IV)', 'ICT-Practical', 'In-Active', '2023-03-02 08:03:16'),
(137, 'CIM 101', 'Business Organization', 'Theory', 'Active', '2023-03-02 06:37:46'),
(138, 'CIM 103', 'Business Mathematics', 'Theory', 'Active', '2023-03-02 06:38:08'),
(145, 'CIM 104', 'Object Oriented Programming I', 'ICT-Practical', 'Active', '2023-03-02 06:41:04'),
(139, 'CIM 105', 'Business Communication Skills', 'Theory', 'Active', '2023-03-02 06:38:34'),
(146, 'CIM 106', 'Database Systems', 'Theory', 'Active', '2023-03-02 06:41:31'),
(140, 'CIM 107', 'Self-Management and Leadership', 'Theory', 'Active', '2023-03-02 06:39:03'),
(361, 'CIM 108', 'System Analysis and Design', 'Theory', 'Active', '2023-03-25 08:32:49'),
(141, 'CIM 109', 'Introduction to Programming using C/C++', 'ICT-Practical', 'Active', '2023-03-02 06:39:26'),
(142, 'CIM 111', 'Computer Organization and Architecture', 'Theory', 'Active', '2023-03-02 06:39:49'),
(143, 'CIM 113', 'Computer Applications', 'ICT-Practical', 'Active', '2023-03-02 06:40:15'),
(151, 'CIM 116', 'Database Management Systems', 'Theory', 'In-Active', '2023-03-02 06:43:37'),
(359, 'CIM 118', 'Computer Communication Theory', 'Theory', 'Active', '2023-03-25 08:22:18'),
(362, 'CIM 120', ' Computer Organization and Architecture', 'Theory', 'Active', '2023-03-25 08:33:41'),
(153, 'CIM 201', 'Organizational Processes I', 'Theory', 'Active', '2023-03-02 06:45:54'),
(363, 'CIM 202', 'Operations Management', 'Theory', 'Active', '2023-03-25 08:36:26'),
(154, 'CIM 203', 'Computer Networks', 'Theory', 'Active', '2023-03-02 06:46:20'),
(162, 'CIM 204', 'Customer Care', 'Theory', 'Active', '2023-03-02 06:51:09'),
(155, 'CIM 205', 'Internet Technology', 'Theory', 'Active', '2023-03-02 06:46:50'),
(163, 'CIM 206', 'Messaging and Communication', 'Theory', 'Active', '2023-03-02 06:51:38'),
(156, 'CIM 207', 'Systems Support', 'Theory', 'Active', '2023-03-02 06:47:15'),
(164, 'CIM 208', 'Work Flow Applications', 'Theory', 'Active', '2023-03-02 06:52:02'),
(157, 'CIM 209', 'Data Structures and Algorithms', 'Theory', 'Active', '2023-03-02 06:47:54'),
(165, 'CIM 210', 'Office Applications Programming', 'Theory', 'Active', '2023-03-02 06:52:35'),
(158, 'CIM 211', 'Object Oriented Programming in VB', 'ICT-Practical', 'Active', '2023-03-02 06:48:27'),
(166, 'CIM 212', 'Security in Applications', 'Theory', 'Active', '2023-03-02 06:52:58'),
(159, 'CIM 213', 'Database Management Systems Labs', 'ICT-Practical', 'Active', '2023-03-02 06:49:01'),
(167, 'CIM 214', 'Structured Programming Models', 'Theory', 'Active', '2023-03-02 06:53:23'),
(160, 'CIM 215', 'Programming Project', 'ICT-Practical', 'Active', '2023-03-02 06:49:36'),
(168, 'CIM 216', 'ICT Consultancy Project', 'Theory', 'Active', '2023-03-02 06:53:49'),
(169, 'CIM 301', 'Systems Analysis and Design', 'Theory', 'Active', '2023-03-02 06:54:17'),
(180, 'CIM 302', 'IT Service Support and Delivery', 'Theory', 'Active', '2023-03-02 07:00:27'),
(170, 'CIM 303', 'Network Security', 'Theory', 'Active', '2023-03-02 06:54:47'),
(181, 'CIM 304', 'Unix Fundamentals', 'Theory', 'Active', '2023-03-02 07:00:57'),
(173, 'CIM 305', 'Electronic Commerce', 'Theory', 'Active', '2023-03-02 06:56:22'),
(184, 'CIM 306', 'Group Project 2', 'Theory', 'Active', '2023-03-02 07:02:29'),
(171, 'CIM 307', 'System Administration I', 'Theory', 'Active', '2023-03-02 06:55:10'),
(182, 'CIM 308', 'Mobile Computing', 'Theory', 'Active', '2023-03-02 07:01:24'),
(174, 'CIM 309', 'Quality Management Systems', 'Theory', 'Active', '2023-03-02 06:57:09'),
(185, 'CIM 310', 'Defining the Information Architecture', 'Theory', 'In-Active', '2023-03-02 07:02:54'),
(172, 'CIM 311', 'Research Methods', 'Theory', 'Active', '2023-03-02 06:55:30'),
(183, 'CIM 312', 'Project (Programming)', 'ICT-Practical', 'Active', '2023-03-02 07:01:55'),
(175, 'CIM 313', 'IT Hardware Support & Maintenance', 'Theory', 'Active', '2023-03-02 06:57:34'),
(176, 'CIM 315', 'Knowledge Management', 'Theory', 'Active', '2023-03-02 06:58:00'),
(186, 'CIM 316', 'System Administration II', 'Theory', 'Active', '2023-03-02 07:03:15'),
(177, 'CIM 317', 'Human Computer Interactions', 'Theory', 'Active', '2023-03-02 06:58:36'),
(187, 'CIM 318', 'Network Server Maintenance', 'Theory', 'In-Active', '2023-03-02 07:03:40'),
(178, 'CIM 319', 'Report Generation Skills', 'Theory', 'Active', '2023-03-02 06:59:11'),
(188, 'CIM 320', 'Object Oriented Systems Analysis & Design', 'Theory', 'Active', '2023-03-02 07:04:07'),
(179, 'CIM 321', 'Organizational Processes II', 'Theory', 'Active', '2023-03-02 06:59:59'),
(189, 'CIM 322', 'Internet Based Programming', 'Theory', 'Active', '2023-03-02 07:04:49'),
(190, 'CIM 324', 'Business Process Management and Outsourcing', 'Theory', 'In-Active', '2023-03-02 07:05:16'),
(191, 'CIM 401', 'Strategic Business Management', 'Theory', 'Active', '2023-03-02 07:05:58'),
(204, 'CIM 402', 'IT Project Management', 'Theory', 'Active', '2023-03-02 07:11:57'),
(192, 'CIM 403', 'Management Information Systems', 'Theory', 'Active', '2023-03-02 07:06:21'),
(205, 'CIM 404', 'Security Policies', 'Theory', 'Active', '2023-03-02 07:12:23'),
(195, 'CIM 405', 'People Management', 'Theory', 'Active', '2023-03-02 07:07:37'),
(206, 'CIM 406', 'Change Management', 'Theory', 'Active', '2023-03-02 07:12:48'),
(193, 'CIM 407', 'Business Intelligence', 'Theory', 'Active', '2023-03-02 07:06:49'),
(207, 'CIM 408', 'Information Systems Audits', 'Theory', 'Active', '2023-03-02 07:13:19'),
(194, 'CIM 409', 'Software Engineering', 'Theory', 'Active', '2023-03-02 07:07:13'),
(208, 'CIM 410', 'Managing the IT Investment', 'Theory', 'Active', '2023-03-02 07:14:21'),
(196, 'CIM 411', 'Information Systems Strategy', 'Theory', 'Active', '2023-03-02 07:08:08'),
(209, 'CIM 412', 'Entrepreneurship', 'Theory', 'Active', '2023-03-02 07:14:45'),
(197, 'CIM 413', 'Information Security Management', 'Theory', 'Active', '2023-03-02 07:08:33'),
(210, 'CIM 414', 'Analysis of Infrastructure Requirements', 'Theory', 'In-Active', '2023-03-02 07:15:12'),
(198, 'CIM 415', 'Application of Emerging Technology', 'Theory', 'Active', '2023-03-02 07:09:03'),
(211, 'CIM 416', 'Emerging Database Technologies & Applications', 'Theory', 'Active', '2023-03-02 07:15:54'),
(199, 'CIM 417', 'Web Design - Server Side', 'Theory', 'Active', '2023-03-02 07:09:28'),
(212, 'CIM 418', 'Software Implementation Techniques', 'Theory', 'Active', '2023-03-02 07:16:26'),
(213, 'CIM 420', 'Software Quality Assurance', 'Theory', 'Active', '2023-03-02 07:17:02'),
(214, 'CIM 422', 'Decision Making Systems', 'Theory', 'Active', '2023-03-02 07:17:25'),
(202, 'CIM 423', 'Customer Relationship Management', 'Theory', 'Active', '2023-03-02 07:10:45'),
(215, 'CIM 424', 'IT Service Cost & Availability Management', 'Theory', 'In-Active', '2023-03-02 07:17:50'),
(203, 'CIM 425', 'Ethical Issues in Information Technology', 'Theory', 'Active', '2023-03-02 07:11:14'),
(216, 'CIM 426', 'Supply Chain Management', 'Theory', 'In-Active', '2023-03-02 07:18:14'),
(73, 'CIS 101', 'Fundamentals of Computers Systems', 'Theory', 'Active', '2023-03-02 05:57:02'),
(80, 'CIS 102', 'Probability and Statistics', 'Theory', 'In-Active', '2023-03-02 06:01:51'),
(74, 'CIS 103', 'Mathematics for IT', 'Theory', 'Active', '2023-03-02 05:59:05'),
(81, 'CIS 104', 'Object Oriented Programming I', 'ICT-Practical', 'Active', '2023-03-02 06:02:23'),
(76, 'CIS 105', 'Principles of Accounting', 'Theory', 'Active', '2023-03-02 05:59:31'),
(82, 'CIS 106', 'Database Systems', 'Theory', 'Active', '2023-03-02 06:02:49'),
(77, 'CIS 107', 'Communication Skills', 'Theory', 'Active', '2023-03-02 05:59:56'),
(83, 'CIS 108', 'Systems Analysis and Design', 'Theory', 'Active', '2023-03-02 06:03:11'),
(78, 'CIS 109', 'General Economics', 'Theory', 'Active', '2023-03-02 06:00:23'),
(84, 'CIS 110', 'Data Communications', 'Theory', 'In-Active', '2023-03-02 06:03:38'),
(79, 'CIS 111', 'Structured Programming', 'ICT-Practical', 'Active', '2023-03-02 06:00:53'),
(85, 'CIS 112', 'Multimedia systems', 'Theory', 'In-Active', '2023-03-02 06:03:59'),
(86, 'CIS 114', 'Introduction to Macroeconomics', 'Theory', 'In-Active', '2023-03-02 06:04:22'),
(365, 'CIS 118', 'Computer Communication Theory', 'Theory', 'In-Active', '2023-03-25 08:44:44'),
(366, 'CIS 120', 'Computer Based Information Systems Concepts', 'Theory', 'Active', '2023-03-25 08:46:01'),
(95, 'CIS 202', 'Transaction Processing Systems', 'Theory', 'Active', '2023-03-02 06:08:35'),
(88, 'CIS 203', 'Data structures and Algorithms', 'Theory', 'Active', '2023-03-02 06:05:18'),
(96, 'CIS 204', 'Group Project', 'ICT-Practical', 'Active', '2023-03-02 06:09:01'),
(89, 'CIS 205', 'Commercial Law', 'Theory', 'Active', '2023-03-02 06:05:43'),
(97, 'CIS 206', 'Insurance and Risk Management', 'Theory', 'Active', '2023-03-02 06:09:34'),
(90, 'CIS 207', 'IT Service Delivery Management', 'Theory', 'Active', '2023-03-02 06:06:21'),
(98, 'CIS 208', 'Software Engineering', 'Theory', 'Active', '2023-03-02 06:10:19'),
(91, 'CIS 209', 'Web Programming I', 'ICT-Practical', 'Active', '2023-03-02 06:06:47'),
(99, 'CIS 210', 'Human Computer Interaction', 'Theory', 'Active', '2023-03-02 06:17:21'),
(92, 'CIS 211', 'Object Oriented Programming II', 'ICT-Practical', 'Active', '2023-03-02 06:07:13'),
(100, 'CIS 212', 'Computer Networks Lab III', 'ICT-Practical', 'Active', '2023-03-02 06:17:48'),
(93, 'CIS 213', 'MIS Group Project I', 'Theory', 'Active', '2023-03-02 06:07:44'),
(101, 'CIS 214', 'IS Audit and Control', 'Theory', 'Active', '2023-03-02 06:18:31'),
(94, 'CIS 215', 'Object Oriented Analysis and Design with UML', 'Theory', 'Active', '2023-03-02 06:08:06'),
(102, 'CIS 301', 'Internet Marketing', 'Theory', 'Active', '2023-03-02 06:19:15'),
(110, 'CIS 302', 'Computer Aided Art and Design', 'Theory', 'Active', '2023-03-02 06:23:13'),
(103, 'CIS 303', 'Introduction to Management', 'Theory', 'Active', '2023-03-02 06:19:56'),
(111, 'CIS 304', 'Database Administration', 'Theory', 'Active', '2023-03-02 06:23:36'),
(104, 'CIS 305', 'Unix Operating System', 'Theory', 'Active', '2023-03-02 06:20:32'),
(112, 'CIS 306', 'Group Project 2', 'ICT-Practical', 'Active', '2023-03-02 06:24:08'),
(105, 'CIS 307', 'MIS Group Project I ', 'Theory', 'Active', '2023-03-02 06:20:56'),
(113, 'CIS 308', 'Web Server Applications Development', 'Theory', 'Active', '2023-03-02 06:24:37'),
(106, 'CIS 309', 'Information Systems Security', 'Theory', 'Active', '2023-03-02 06:21:21'),
(114, 'CIS 310', 'Mobile Devices and Wireless Computing', 'Theory', 'Active', '2023-03-02 06:25:00'),
(107, 'CIS 311', 'Social Networking and Cyber Security', 'Theory', 'Active', '2023-03-02 06:21:48'),
(115, 'CIS 312', 'Business Ethics and Corporate Governance', 'Theory', 'Active', '2023-03-02 06:25:25'),
(108, 'CIS 313', 'System Administration and Management', 'Theory', 'Active', '2023-03-02 06:22:18'),
(116, 'CIS 314', 'Computer Graphics', 'ICT-Practical', 'Active', '2023-03-02 06:25:56'),
(109, 'CIS 315', 'Artificial Intelligence', 'Theory', 'In-Active', '2023-03-02 06:22:43'),
(117, 'CIS 316', 'Business Information Systems and Management', 'Theory', 'Active', '2023-03-02 06:26:23'),
(118, 'CIS 318', 'Database Administration', 'Theory', 'In-Active', '2023-03-02 06:26:50'),
(119, 'CIS 401', 'Management Research Project', 'Theory', 'Active', '2023-03-02 06:27:48'),
(128, 'CIS 402', 'Business Process Management', 'Theory', 'Active', '2023-03-02 06:32:00'),
(120, 'CIS 403', 'Entrepreneurship Skills', 'Theory', 'Active', '2023-03-02 06:28:19'),
(129, 'CIS 404', 'Information Systems Security and Controls', 'Theory', 'Active', '2023-03-02 06:32:39'),
(121, 'CIS 405', 'ICT Strategic Management', 'Theory', 'Active', '2023-03-02 06:28:41'),
(130, 'CIS 406', 'Strategic Management', 'Theory', 'Active', '2023-03-02 06:33:21'),
(122, 'CIS 407', 'Data Warehousing and Data mining', 'Theory', 'Active', '2023-03-02 06:29:04'),
(131, 'CIS 408', 'IS Project Execution', 'ICT-Practical', 'Active', '2023-03-02 06:33:56'),
(123, 'CIS 409', 'MIS Individual Project 1', 'Theory', 'Active', '2023-03-02 06:29:27'),
(132, 'CIS 410', 'Mobile Technology Applications and M-Commerce', 'Theory', 'In-Active', '2023-03-02 06:34:21'),
(124, 'CIS 411', 'Business Process Management', 'Theory', 'Active', '2023-03-02 06:29:55'),
(133, 'CIS 412', 'Business Continuity and Disaster Recovery', 'Theory', 'Active', '2023-03-02 06:34:42'),
(125, 'CIS 413', 'Content Development and Management', 'Theory', 'Active', '2023-03-02 06:30:22'),
(134, 'CIS 414', 'Cloud Computing and Emerging Applications', 'Theory', 'Active', '2023-03-02 06:35:08'),
(126, 'CIS 415', 'Distributed Systems', 'Theory', 'Active', '2023-03-02 06:30:54'),
(135, 'CIS 416', 'Knowledge Based Systems', 'Theory', 'Active', '2023-03-02 06:35:33'),
(127, 'CIS 417', 'Information Systems Innovations and New Technologies', 'Theory', 'Active', '2023-03-02 06:31:21'),
(136, 'CIS 418', 'Cloud Computing and Emerging Applications', 'Theory', 'In-Active', '2023-03-02 06:35:57'),
(1, 'CIT 101', 'Discrete Structures I', 'Theory', 'Active', '2023-03-01 19:26:18'),
(9, 'CIT 102', 'Discrete Structures II', 'Theory', 'In-Active', '2023-03-01 19:29:55'),
(2, 'CIT 103', 'Mathematics for IT', 'Theory', 'Active', '2023-03-01 19:26:46'),
(10, 'CIT 104', 'Object Oriented Programming I', 'Theory', 'Active', '2023-03-01 19:30:21'),
(3, 'CIT 105', 'Electrical Principles', 'Theory', 'Active', '2023-03-01 19:27:10'),
(11, 'CIT 106', 'Database Systems', 'Theory', 'Active', '2023-03-01 19:30:47'),
(4, 'CIT 107', 'Fundamentals of IT', 'Theory', 'Active', '2023-03-01 19:27:37'),
(12, 'CIT 108', 'System Analysis and Design', 'ICT-Practical', 'Active', '2023-03-01 19:31:08'),
(5, 'CIT 109', 'Computer Applications', 'Theory', 'Active', '2023-03-01 19:28:05'),
(13, 'CIT 110', 'Platform technologies I', 'Theory', 'In-Active', '2023-03-01 19:31:31'),
(6, 'CIT 111', 'Fundamentals of Programming', 'ICT-Practical', 'Active', '2023-03-01 19:28:31'),
(15, 'CIT 114', 'System Analysis and Design', 'Theory', 'In-Active', '2023-03-01 19:32:22'),
(16, 'CIT 116', 'Data communications', 'Theory', 'In-Active', '2023-03-01 19:32:42'),
(357, 'CIT 118', 'Computer Communication Theory', 'Theory', 'Active', '2023-03-25 07:53:09'),
(358, 'CIT 120', 'Computer Organization and Architecture', 'Theory', 'Active', '2023-03-25 07:54:12'),
(17, 'CIT 201', 'Object-Oriented Programming II', 'ICT-Practical', 'Active', '2023-03-01 19:33:13'),
(25, 'CIT 202', 'Computer Aided Design', 'ICT-Practical', 'Active', '2023-03-01 19:36:55'),
(18, 'CIT 203', 'Data Structures and Algorithms', 'Theory', 'Active', '2023-03-01 19:33:35'),
(26, 'CIT 204', 'Networking Administration and Management', 'Theory', 'Active', '2023-03-01 19:37:21'),
(19, 'CIT 205', 'Computer Networks', 'Theory', 'Active', '2023-03-01 19:33:58'),
(27, 'CIT 206', 'Research Methods and Technical Writing', 'Theory', 'Active', '2023-03-01 19:37:55'),
(20, 'CIT 207', 'Web Systems and Technologies', 'ICT-Practical', 'Active', '2023-03-01 19:34:33'),
(28, 'CIT 208', 'Group Project', 'ICT-Practical', 'Active', '2023-03-01 19:38:17'),
(21, 'CIT 209', 'Unix Operating System Fundamentals', 'Theory', 'Active', '2023-03-01 19:34:52'),
(29, 'CIT 210', 'Object Oriented Analysis and Design', 'Theory', 'Active', '2023-03-01 19:38:44'),
(22, 'CIT 211', 'Event Driven Programming', 'ICT-Practical', 'Active', '2023-03-01 19:35:15'),
(30, 'CIT 212', 'Computer Networks lab II', 'ICT-Practical', 'Active', '2023-03-01 19:39:17'),
(23, 'CIT 213', 'Computer Networks Lab I', 'ICT-Practical', 'Active', '2023-03-01 19:35:47'),
(31, 'CIT 214', 'Software Engineering', 'Theory', 'Active', '2023-03-01 19:39:39'),
(24, 'CIT 215', 'Databases Systems', 'Theory', 'Active', '2023-03-01 19:36:08'),
(32, 'CIT 216', 'System Administration and Management', 'Theory', 'Active', '2023-03-01 19:40:07'),
(33, 'CIT 301', 'Design and Analysis of Algorithms', 'Theory', 'Active', '2023-03-01 19:40:41'),
(43, 'CIT 302', 'Human Computer Interaction', 'Theory', 'Active', '2023-03-01 19:45:05'),
(44, 'CIT 304', 'Integrative programming and technologies', 'Theory', 'Active', '2023-03-01 19:45:27'),
(34, 'CIT 305', 'Advanced Database Systems', 'Theory', 'Active', '2023-03-01 19:41:07'),
(47, 'CIT 306', 'Wireless and Mobile Computing', 'Theory', 'Active', '2023-03-01 19:47:23'),
(35, 'CIT 307', 'Information Assurance and Security I', 'Theory', 'Active', '2023-03-01 19:41:30'),
(48, 'CIT 308', 'Web systems and Technologies II', 'ICT-Practical', 'Active', '2023-03-01 19:47:49'),
(36, 'CIT 309', 'IT Project I (Proposal Writing)', 'Theory', 'Active', '2023-03-01 19:41:54'),
(49, 'CIT 310', 'Information Assurance and Security II', 'Theory', 'Active', '2023-03-01 19:48:17'),
(38, 'CIT 311', 'Information Technology Control and Audit I', 'Theory', 'Active', '2023-03-01 19:42:44'),
(45, 'CIT 312', 'Group Project (Project Implementation)', 'ICT-Practical', 'Active', '2023-03-01 19:45:53'),
(39, 'CIT 313', 'Database Administration', 'Theory', 'Active', '2023-03-01 19:43:10'),
(50, 'CIT 314', 'Mobile Programming', 'ICT-Practical', 'Active', '2023-03-01 19:48:39'),
(40, 'CIT 315', 'Computer Networks Lab III', 'ICT-Practical', 'Active', '2023-03-01 19:43:49'),
(51, 'CIT 316', 'Computer Graphics', 'Theory', 'Active', '2023-03-01 19:49:03'),
(41, 'CIT 317', 'Multimedia and Graphics Systems', 'Theory', 'Active', '2023-03-01 19:44:16'),
(46, 'CIT 318', 'Artificial Intelligence', 'Theory', 'Active', '2023-03-01 19:46:23'),
(42, 'CIT 319', 'Software Testing and Measurement', 'Theory', 'Active', '2023-03-01 19:44:38'),
(52, 'CIT 320', 'Simulation and Modelling', 'Theory', 'In-Active', '2023-03-01 19:49:25'),
(53, 'CIT 322', 'Computer Networks Lab 4', 'ICT-Practical', 'Active', '2023-03-01 19:49:47'),
(54, 'CIT 401', 'Software Project Management', 'Theory', 'Active', '2023-03-01 19:51:06'),
(64, 'CIT 402', 'IT project II', 'ICT-Practical', 'Active', '2023-03-01 20:46:11'),
(370, 'CIT 403', 'Management Information Systems', 'Theory', 'Active', '2023-03-25 12:23:04'),
(364, 'CIT 404', 'Cryptography and Information Security', 'Theory', 'Active', '2023-03-25 08:42:27'),
(55, 'CIT 405', 'E-Commerce', 'Theory', 'Active', '2023-03-01 19:52:54'),
(65, 'CIT 406', 'Social and Professional Issues In IT', 'Theory', 'Active', '2023-03-01 20:47:17'),
(59, 'CIT 407', 'IT and Society', 'Theory', 'Active', '2023-03-01 19:55:42'),
(66, 'CIT 408', 'IT and Development', 'Theory', 'Active', '2023-03-01 20:48:05'),
(56, 'CIT 409', 'IT Project ', 'Theory', 'Active', '2023-03-01 19:53:36'),
(67, 'CIT 410', 'Mobile Technology Applications and M-Commerce', 'Theory', 'In-Active', '2023-03-01 20:48:35'),
(57, 'CIT 411', 'Distributed Systems', 'Theory', 'Active', '2023-03-01 19:54:59'),
(68, 'CIT 412', 'Mobile Embedded Hardware Platforms & Architectures', 'Theory', 'In-Active', '2023-03-01 20:49:03'),
(60, 'CIT 413', 'Mobile Devices, Technologies, and Programming', 'ICT-Practical', 'Active', '2023-03-01 19:56:09'),
(69, 'CIT 414', 'Cloud Computing and Emerging Applications', 'Theory', 'Active', '2023-03-01 20:49:43'),
(61, 'CIT 415', 'Web Applications and Programming', 'ICT-Practical', 'Active', '2023-03-01 19:57:06'),
(70, 'CIT 416', 'Network Security', 'Theory', 'Active', '2023-03-01 20:50:14'),
(71, 'CIT 418', 'Authentication Protocols and Biometrics', 'Theory', 'Active', '2023-03-01 20:50:43'),
(62, 'CIT 419', 'Content Development and Management', 'Theory', 'Active', '2023-03-01 19:58:04'),
(72, 'CIT 420', 'Information Systems Innovations & New Technologies', 'Theory', 'In-Active', '2023-03-01 20:51:08');

-- --------------------------------------------------------

--
-- Table structure for table `unit_room_time_day_allocation_details`
--

CREATE TABLE `unit_room_time_day_allocation_details` (
  `id` int(11) NOT NULL,
  `unit_id` varchar(100) NOT NULL,
  `lecturer_id` varchar(100) DEFAULT NULL,
  `room_id` varchar(100) NOT NULL,
  `time_slot_id` varchar(100) NOT NULL,
  `weekday` varchar(100) DEFAULT NULL,
  `date_allocated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_room_time_day_allocation_details`
--

INSERT INTO `unit_room_time_day_allocation_details` (`id`, `unit_id`, `lecturer_id`, `room_id`, `time_slot_id`, `weekday`, `date_allocated`) VALUES
(1, 'CIM 214', 'PF17', 'TB 1', '13:00-15:00', 'Thursday', '2023-04-30 13:20:55'),
(2, 'CCT 116', 'PF26', 'Electronics LAB I', '15:00-17:00', 'Wednesday', '2023-04-30 13:20:55'),
(3, 'CIS 214', 'PF16', 'TB 4', '13:00-15:00', 'Wednesday', '2023-04-30 13:20:55'),
(4, 'CIS 306', 'PF03', 'LAB III', '13:00-15:00', 'Tuesday', '2023-04-30 13:20:55'),
(5, 'CCT 110', 'PF25', 'Electronics LAB I', '09:00-11:00', 'Friday', '2023-04-30 13:20:55'),
(6, 'CCS 212', 'PF30', 'TB 11', '13:00-15:00', 'Wednesday', '2023-04-30 13:20:55'),
(7, 'CIS 206', 'PF11', 'TB 7', '09:00-11:00', 'Thursday', '2023-04-30 13:20:55'),
(8, 'CCS 416', 'PF29', 'TB 7', '07:00-09:00', 'Friday', '2023-04-30 13:20:55'),
(9, 'CIS 204', 'PF12', 'LAB VII', '15:00-17:00', 'Wednesday', '2023-04-30 13:20:55'),
(10, 'CIM 408', 'PF16', 'TB 1', '09:00-11:00', 'Friday', '2023-04-30 13:20:55'),
(11, 'CCT 308', 'PF06', 'TB 8', '09:00-11:00', 'Tuesday', '2023-04-30 13:20:55'),
(12, 'CCT 108', 'PF22', 'TB 1', '15:00-17:00', 'Wednesday', '2023-04-30 13:20:55'),
(13, 'CIT 210', 'PF18', 'TB 2', '15:00-17:00', 'Monday', '2023-04-30 13:20:55'),
(14, 'CIT 306', 'PF04', 'TB 8', '07:00-09:00', 'Tuesday', '2023-04-30 13:20:55'),
(15, 'CIM 206', 'PF15', 'TB 1', '17:00-19:00', 'Thursday', '2023-04-30 13:20:55'),
(16, 'CIT 204', 'PF01', 'TB 7', '09:00-11:00', 'Thursday', '2023-04-30 13:20:55'),
(17, 'CIM 216', 'PF01', 'TB 2', '09:00-11:00', 'Monday', '2023-04-30 13:20:55'),
(18, 'CCS 202', 'PF25', 'TB 1', '09:00-11:00', 'Tuesday', '2023-04-30 13:20:56'),
(19, 'CCT 312', 'PF29', 'TB 2', '07:00-09:00', 'Monday', '2023-04-30 13:20:56'),
(20, 'CIS 406', 'PF18', 'TB 10', '17:00-19:00', 'Monday', '2023-04-30 13:20:56'),
(21, 'CIM 420', 'PF03', 'TB 11', '13:00-15:00', 'Tuesday', '2023-04-30 13:20:56'),
(22, 'CCS 210', 'PF20', 'TB 1', '15:00-17:00', 'Wednesday', '2023-04-30 13:20:56'),
(23, 'CIT 304', 'PF17', 'TB 1', '07:00-09:00', 'Wednesday', '2023-04-30 13:20:56'),
(24, 'CIT 418', 'PF03', 'TB 8', '09:00-11:00', 'Friday', '2023-04-30 13:20:56'),
(25, 'CIS 304', 'PF18', 'TB 4', '15:00-17:00', 'Wednesday', '2023-04-30 13:20:56'),
(26, 'ABA 424', 'PF60', 'TB 1', '09:00-11:00', 'Monday', '2023-04-30 13:20:56'),
(27, 'CIT 416', 'PF16', 'TB 11', '07:00-09:00', 'Wednesday', '2023-04-30 13:20:56'),
(28, 'CIS 402', 'PF60', 'TB 6', '07:00-09:00', 'Monday', '2023-04-30 13:20:56'),
(29, 'CIS 408', 'PF52', 'LAB V', '07:00-09:00', 'Tuesday', '2023-04-30 13:20:56'),
(30, 'CIT 202', 'PF04', 'LAB VII', '09:00-11:00', 'Monday', '2023-04-30 13:20:56'),
(31, 'CCS 122', 'PF24', 'TB 4', '17:00-19:00', 'Thursday', '2023-04-30 13:20:56'),
(32, 'CCT 418', 'PF20', 'TB 1', '17:00-19:00', 'Monday', '2023-04-30 13:20:56'),
(33, 'CIM 108', 'PF18', 'TB 10', '13:00-15:00', 'Wednesday', '2023-04-30 13:20:56'),
(34, 'CIM 316', 'PF12', 'TB 11', '13:00-15:00', 'Thursday', '2023-04-30 13:20:56'),
(35, 'CCT 212', 'PF20', 'TB 7', '13:00-15:00', 'Tuesday', '2023-04-30 13:20:57'),
(36, 'CCT 306', 'PF27', 'TB 7', '11:00-13:00', 'Wednesday', '2023-04-30 13:20:57'),
(37, 'CCT 106', 'PF28', 'TB 1', '17:00-19:00', 'Monday', '2023-04-30 13:20:57'),
(38, 'CIS 308', 'PF07', 'TB 7', '15:00-17:00', 'Wednesday', '2023-04-30 13:20:57'),
(39, 'CCS 312', 'PF27', 'TB 2', '13:00-15:00', 'Tuesday', '2023-04-30 13:20:57'),
(40, 'CCT 104', 'PF29', 'LAB VI', '11:00-13:00', 'Friday', '2023-04-30 13:20:57'),
(41, 'CIS 106', 'PF19', 'TB 9', '07:00-09:00', 'Tuesday', '2023-04-30 13:20:57'),
(42, 'CCT 114', 'PF25', 'TB 9', '11:00-13:00', 'Thursday', '2023-04-30 13:20:57'),
(43, 'CCT 214', 'PF26', 'TB 6', '17:00-19:00', 'Thursday', '2023-04-30 13:20:57'),
(44, 'CCT 318', 'PF24', 'TB 6', '15:00-17:00', 'Monday', '2023-04-30 13:20:57'),
(45, 'CIM 308', 'PF04', 'TB 1', '13:00-15:00', 'Tuesday', '2023-04-30 13:20:57'),
(46, 'CCS 102', 'PF24', 'TB 4', '17:00-19:00', 'Friday', '2023-04-30 13:20:57'),
(47, 'CIM 412', 'PF60', 'TB 8', '13:00-15:00', 'Friday', '2023-04-30 13:20:57'),
(48, 'CIM 422', 'PF19', 'TB 8', '07:00-09:00', 'Tuesday', '2023-04-30 13:20:57'),
(49, 'CIM 312', 'PF02', 'LAB III', '07:00-09:00', 'Monday', '2023-04-30 13:20:57'),
(50, 'CCT 420', 'PF26', 'TB 6', '13:00-15:00', 'Friday', '2023-04-30 13:20:58'),
(51, 'CCT 320', 'PF06', 'LAB IX', '11:00-13:00', 'Friday', '2023-04-30 13:20:58'),
(52, 'CIT 406', 'PF14', 'TB 2', '17:00-19:00', 'Friday', '2023-04-30 13:20:58'),
(53, 'CIS 416', 'PF17', 'TB 8', '11:00-13:00', 'Wednesday', '2023-04-30 13:20:58'),
(54, 'CIT 214', 'PF18', 'TB 8', '09:00-11:00', 'Monday', '2023-04-30 13:20:58'),
(55, 'CCS 206', 'PF29', 'TB 1', '11:00-13:00', 'Monday', '2023-04-30 13:20:58'),
(56, 'CIM 212', 'PF16', 'TB 11', '13:00-15:00', 'Thursday', '2023-04-30 13:20:58'),
(57, 'CIT 316', 'PF15', 'TB 2', '07:00-09:00', 'Thursday', '2023-04-30 13:20:58'),
(58, 'CIS 312', 'PF60', 'TB 9', '07:00-09:00', 'Monday', '2023-04-30 13:20:58'),
(59, 'CCS 104', 'PF29', 'LAB VI', '11:00-13:00', 'Tuesday', '2023-04-30 13:20:58'),
(60, 'CIT 108', 'PF18', 'LAB IX', '15:00-17:00', 'Wednesday', '2023-04-30 13:20:58'),
(61, 'CCS 314', 'PF27', 'LAB IX', '11:00-13:00', 'Monday', '2023-04-30 13:20:58'),
(62, 'CIM 410', 'PF18', 'TB 1', '07:00-09:00', 'Tuesday', '2023-04-30 13:20:58'),
(63, 'CCT 210', 'PF23', 'TB 1', '09:00-11:00', 'Friday', '2023-04-30 13:20:58'),
(64, 'CCT 216', 'PF20', 'TB 6', '07:00-09:00', 'Monday', '2023-04-30 13:20:58'),
(65, 'CIM 118', 'PF01', 'TB 2', '13:00-15:00', 'Monday', '2023-04-30 13:20:59'),
(66, 'CIT 310', 'PF03', 'TB 8', '09:00-11:00', 'Monday', '2023-04-30 13:20:59'),
(67, 'CCS 408', 'PF25', 'LAB IX', '13:00-15:00', 'Monday', '2023-04-30 13:20:59'),
(68, 'CCS 112', 'PF28', 'TB 9', '09:00-11:00', 'Tuesday', '2023-04-30 13:20:59'),
(69, 'CIT 402', 'PF10', 'LAB VI', '17:00-19:00', 'Friday', '2023-04-30 13:20:59'),
(70, 'CCT 316', 'PF21', 'TB 1', '09:00-11:00', 'Thursday', '2023-04-30 13:20:59'),
(71, 'CCT 322', 'PF27', 'LAB V', '11:00-13:00', 'Thursday', '2023-04-30 13:20:59'),
(72, 'CCS 418', 'PF06', 'TB 11', '17:00-19:00', 'Thursday', '2023-04-30 13:20:59'),
(73, 'CIS 404', 'PF04', 'TB 11', '11:00-13:00', 'Wednesday', '2023-04-30 13:20:59'),
(74, 'CCS 214', 'PF27', 'LAB V', '09:00-11:00', 'Wednesday', '2023-04-30 13:20:59'),
(75, 'CIT 318', 'PF12', 'TB 10', '15:00-17:00', 'Wednesday', '2023-04-30 13:20:59'),
(76, 'CCT 412', 'PF21', 'TB 10', '15:00-17:00', 'Thursday', '2023-04-30 13:20:59'),
(77, 'CIM 106', 'PF19', 'TB 11', '09:00-11:00', 'Thursday', '2023-04-30 13:20:59'),
(78, 'CIM 416', 'PF19', 'TB 10', '17:00-19:00', 'Thursday', '2023-04-30 13:20:59'),
(79, 'CCS 114', 'PF28', 'LAB V', '11:00-13:00', 'Monday', '2023-04-30 13:20:59'),
(80, 'CCS 308', 'PF21', 'TB 7', '07:00-09:00', 'Thursday', '2023-04-30 13:20:59'),
(81, 'CIM 418', 'PF02', 'TB 1', '17:00-19:00', 'Monday', '2023-04-30 13:21:00'),
(82, 'CIS 208', 'PF18', 'TB 10', '13:00-15:00', 'Wednesday', '2023-04-30 13:21:00'),
(83, 'CIM 402', 'PF17', 'TB 8', '13:00-15:00', 'Tuesday', '2023-04-30 13:21:00'),
(84, 'CIT 104', 'PF16', 'TB 4', '11:00-13:00', 'Tuesday', '2023-04-30 13:21:00'),
(85, 'CIT 206', 'PF16', 'TB 7', '17:00-19:00', 'Tuesday', '2023-04-30 13:21:00'),
(86, 'CIT 120', 'PF08', 'TB 1', '09:00-11:00', 'Tuesday', '2023-04-30 13:21:00'),
(87, 'CIM 306', 'PF08', 'TB 11', '15:00-17:00', 'Tuesday', '2023-04-30 13:21:00'),
(88, 'CCS 310', 'PF22', 'TB 6', '13:00-15:00', 'Thursday', '2023-04-30 13:21:00'),
(89, 'CCS 406', 'PF25', 'LAB VI', '15:00-17:00', 'Monday', '2023-04-30 13:21:00'),
(90, 'ABS 424', 'PF60', 'TB 2', '15:00-17:00', 'Thursday', '2023-04-30 13:21:00'),
(91, 'CCS 204', 'PF23', 'LAB V', '13:00-15:00', 'Monday', '2023-04-30 13:21:00'),
(92, 'CCS 306', 'PF06', 'TB 10', '07:00-09:00', 'Wednesday', '2023-04-30 13:21:00'),
(93, 'CIT 212', 'PF01', 'LAB VI', '07:00-09:00', 'Tuesday', '2023-04-30 13:21:00'),
(94, 'CIT 118', 'PF01', 'TB 1', '11:00-13:00', 'Friday', '2023-04-30 13:21:00'),
(95, 'CCT 215', 'PF23', 'TB 11', '13:00-15:00', 'Friday', '2023-04-30 13:21:01'),
(96, 'CIS 414', 'PF08', 'TB 1', '11:00-13:00', 'Tuesday', '2023-04-30 13:21:01'),
(97, 'CIS 310', 'PF04', 'TB 2', '11:00-13:00', 'Friday', '2023-04-30 13:21:01'),
(98, 'CIS 212', 'PF01', 'LAB IX', '11:00-13:00', 'Wednesday', '2023-04-30 13:21:01'),
(99, 'CCS 412', 'PF20', 'TB 1', '11:00-13:00', 'Monday', '2023-04-30 13:21:01'),
(100, 'CIT 106', 'PF19', 'TB 11', '09:00-11:00', 'Wednesday', '2023-04-30 13:21:01'),
(101, 'CIS 104', 'PF16', 'LAB V', '15:00-17:00', 'Wednesday', '2023-04-30 13:21:01'),
(102, 'CCS 208', 'PF23', 'TB 8', '11:00-13:00', 'Monday', '2023-04-30 13:21:01'),
(103, 'CIT 408', 'PF17', 'TB 4', '13:00-15:00', 'Friday', '2023-04-30 13:21:01'),
(104, 'CCT 304', 'PF30', 'TB 1', '11:00-13:00', 'Thursday', '2023-04-30 13:21:01'),
(105, 'CIM 322', 'PF07', 'TB 1', '13:00-15:00', 'Thursday', '2023-04-30 13:21:01'),
(106, 'CCT 118', 'PF24', 'Electronics LAB III', '11:00-13:00', 'Friday', '2023-04-30 13:21:01'),
(107, 'CIT 314', 'PF13', 'LAB VI', '17:00-19:00', 'Thursday', '2023-04-30 13:21:01'),
(108, 'CCS 216', 'PF20', 'LAB VII', '07:00-09:00', 'Tuesday', '2023-04-30 13:21:01'),
(109, 'CCS 404', 'PF25', 'TB 9', '13:00-15:00', 'Thursday', '2023-04-30 13:21:01'),
(110, 'CCT 102', 'PF28', 'TB 8', '11:00-13:00', 'Monday', '2023-04-30 13:21:01'),
(111, 'CCS 318', 'PF06', 'TB 10', '15:00-17:00', 'Wednesday', '2023-04-30 13:21:01'),
(112, 'CIT 216', 'PF12', 'TB 9', '17:00-19:00', 'Wednesday', '2023-04-30 13:21:01'),
(113, 'CIM 406', 'PF60', 'TB 9', '17:00-19:00', 'Wednesday', '2023-04-30 13:21:02'),
(114, 'CIT 302', 'PF14', 'TB 8', '13:00-15:00', 'Monday', '2023-04-30 13:21:02'),
(115, 'CCS 302', 'PF30', 'TB 10', '13:00-15:00', 'Tuesday', '2023-04-30 13:21:02'),
(116, 'CCT 206', 'PF23', 'TB 2', '09:00-11:00', 'Friday', '2023-04-30 13:21:02'),
(117, 'CIM 320', 'PF18', 'TB 10', '15:00-17:00', 'Tuesday', '2023-04-30 13:21:02'),
(118, 'CIM 210', 'PF17', 'TB 7', '11:00-13:00', 'Thursday', '2023-04-30 13:21:02'),
(119, 'CIS 302', 'PF04', 'TB 6', '13:00-15:00', 'Tuesday', '2023-04-30 13:21:02'),
(120, 'CCS 108', 'PF22', 'Electronics LAB III', '07:00-09:00', 'Tuesday', '2023-04-30 13:21:02'),
(121, 'CIM 302', 'PF18', 'TB 4', '13:00-15:00', 'Monday', '2023-04-30 13:21:02'),
(122, 'CIT 208', 'PF52', 'LAB VI', '17:00-19:00', 'Wednesday', '2023-04-30 13:21:02'),
(123, 'CCT 302', 'PF22', 'TB 11', '13:00-15:00', 'Wednesday', '2023-04-30 13:21:02'),
(124, 'CIT 414', 'PF08', 'TB 6', '17:00-19:00', 'Friday', '2023-04-30 13:21:02'),
(125, 'CCT 202', 'PF24', 'Electronics LAB III', '15:00-17:00', 'Monday', '2023-04-30 13:21:02'),
(126, 'CCS 304', 'PF30', 'LAB III', '13:00-15:00', 'Tuesday', '2023-04-30 13:21:02'),
(127, 'CIM 120', 'PF08', 'TB 2', '17:00-19:00', 'Tuesday', '2023-04-30 13:21:02'),
(128, 'CIM 404', 'PF16', 'TB 8', '13:00-15:00', 'Friday', '2023-04-30 13:21:03'),
(129, 'CIS 314', 'PF15', 'LAB VI', '09:00-11:00', 'Thursday', '2023-04-30 13:21:03'),
(130, 'CCS 414', 'PF26', 'TB 2', '13:00-15:00', 'Wednesday', '2023-04-30 13:21:03'),
(131, 'CIT 322', 'PF01', 'LAB VII', '17:00-19:00', 'Friday', '2023-04-30 13:21:03'),
(132, 'CCS 106', 'PF28', 'TB 9', '13:00-15:00', 'Friday', '2023-04-30 13:21:03'),
(133, 'CIM 104', 'PF16', 'LAB VII', '13:00-15:00', 'Tuesday', '2023-04-30 13:21:03'),
(134, 'CIM 208', 'PF15', 'TB 7', '17:00-19:00', 'Tuesday', '2023-04-30 13:21:03'),
(135, 'CCT 406', 'PF30', 'TB 6', '13:00-15:00', 'Thursday', '2023-04-30 13:21:03'),
(136, 'CIM 202', 'PF08', 'TB 1', '15:00-17:00', 'Tuesday', '2023-04-30 13:21:03'),
(137, 'CCT 402', 'PF22', 'LAB VII', '11:00-13:00', 'Tuesday', '2023-04-30 13:21:03'),
(138, 'CCS 422', 'PF22', 'TB 11', '11:00-13:00', 'Friday', '2023-04-30 13:21:03'),
(139, 'CIT 308', 'PF07', 'LAB VII', '07:00-09:00', 'Wednesday', '2023-04-30 13:21:03'),
(140, 'CCS 110', 'PF28', 'TB 8', '13:00-15:00', 'Thursday', '2023-04-30 13:21:03'),
(141, 'CIS 210', 'PF14', 'TB 8', '17:00-19:00', 'Tuesday', '2023-04-30 13:21:03'),
(142, 'CIM 204', 'PF60', 'TB 7', '15:00-17:00', 'Friday', '2023-04-30 13:21:03'),
(143, 'CIS 120', 'PF01', 'TB 7', '17:00-19:00', 'Thursday', '2023-04-30 13:21:03'),
(144, 'CIS 202', 'PF11', 'TB 11', '11:00-13:00', 'Friday', '2023-04-30 13:21:03'),
(145, 'CCT 112', 'PF26', 'TB 7', '11:00-13:00', 'Thursday', '2023-04-30 13:21:04'),
(146, 'CIT 404', 'PF03', 'TB 11', '11:00-13:00', 'Friday', '2023-04-30 13:21:04'),
(147, 'CIM 304', 'PF12', 'TB 10', '13:00-15:00', 'Friday', '2023-04-30 13:21:04'),
(148, 'CIS 108', 'PF18', 'TB 10', '15:00-17:00', 'Thursday', '2023-04-30 13:21:04'),
(149, 'CIT 312', 'PF19', 'LAB V', '17:00-19:00', 'Thursday', '2023-04-30 13:21:04'),
(150, 'CCS 316', 'PF27', 'TB 2', '11:00-13:00', 'Friday', '2023-04-30 13:21:04'),
(151, 'CIS 412', 'PF08', 'TB 4', '17:00-19:00', 'Monday', '2023-04-30 13:21:04');

-- --------------------------------------------------------

--
-- Table structure for table `unit_semester_details`
--

CREATE TABLE `unit_semester_details` (
  `id` int(11) NOT NULL,
  `unit_id` varchar(50) NOT NULL,
  `semester_id` varchar(20) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_semester_details`
--

INSERT INTO `unit_semester_details` (`id`, `unit_id`, `semester_id`, `date_added`) VALUES
(10, 'CIT 101', 'Y1S1', '2023-03-01 22:26:18'),
(11, 'CIT 103', 'Y1S1', '2023-03-01 22:26:46'),
(12, 'CIT 105', 'Y1S1', '2023-03-01 22:27:11'),
(13, 'CIT 107', 'Y1S1', '2023-03-01 22:27:37'),
(14, 'CIT 109', 'Y1S1', '2023-03-01 22:28:05'),
(15, 'CIT 111', 'Y1S1', '2023-03-01 22:28:31'),
(18, 'CIT 102', 'Y1S2', '2023-03-01 22:29:55'),
(19, 'CIT 104', 'Y1S2', '2023-03-01 22:30:22'),
(20, 'CIT 106', 'Y1S2', '2023-03-01 22:30:47'),
(21, 'CIT 108', 'Y1S2', '2023-03-01 22:31:08'),
(22, 'CIT 110', 'Y1S2', '2023-03-01 22:31:31'),
(24, 'CIT 114', 'Y1S2', '2023-03-01 22:32:22'),
(25, 'CIT 116', 'Y1S2', '2023-03-01 22:32:43'),
(26, 'CIT 201', 'Y2S1', '2023-03-01 22:33:13'),
(27, 'CIT 203', 'Y2S1', '2023-03-01 22:33:35'),
(28, 'CIT 205', 'Y2S1', '2023-03-01 22:33:58'),
(29, 'CIT 207', 'Y2S1', '2023-03-01 22:34:33'),
(30, 'CIT 209', 'Y2S1', '2023-03-01 22:34:53'),
(31, 'CIT 211', 'Y2S1', '2023-03-01 22:35:15'),
(32, 'CIT 213', 'Y2S1', '2023-03-01 22:35:47'),
(33, 'CIT 215', 'Y2S1', '2023-03-01 22:36:09'),
(34, 'CIT 202', 'Y2S2', '2023-03-01 22:36:56'),
(35, 'CIT 204', 'Y2S2', '2023-03-01 22:37:21'),
(36, 'CIT 206', 'Y2S2', '2023-03-01 22:37:55'),
(37, 'CIT 208', 'Y2S2', '2023-03-01 22:38:18'),
(38, 'CIT 210', 'Y2S2', '2023-03-01 22:38:44'),
(39, 'CIT 212', 'Y2S2', '2023-03-01 22:39:17'),
(40, 'CIT 214', 'Y2S2', '2023-03-01 22:39:39'),
(41, 'CIT 216', 'Y2S2', '2023-03-01 22:40:07'),
(42, 'CIT 301', 'Y3S1', '2023-03-01 22:40:41'),
(43, 'CIT 305', 'Y3S1', '2023-03-01 22:41:07'),
(44, 'CIT 307', 'Y3S1', '2023-03-01 22:41:30'),
(45, 'CIT 309', 'Y3S1', '2023-03-01 22:41:54'),
(46, 'CIT 305', 'Y3S1', '2023-03-01 22:42:18'),
(47, 'CIT 311', 'Y3S1', '2023-03-01 22:42:44'),
(48, 'CIT 313', 'Y3S1', '2023-03-01 22:43:10'),
(49, 'CIT 315', 'Y3S1', '2023-03-01 22:43:49'),
(50, 'CIT 317', 'Y3S1', '2023-03-01 22:44:17'),
(51, 'CIT 319', 'Y3S1', '2023-03-01 22:44:38'),
(52, 'CIT 302', 'Y3S2', '2023-03-01 22:45:06'),
(53, 'CIT 304', 'Y3S2', '2023-03-01 22:45:27'),
(54, 'CIT 312', 'Y3S2', '2023-03-01 22:45:53'),
(55, 'CIT 318', 'Y3S2', '2023-03-01 22:46:24'),
(56, 'CIT 306', 'Y3S2', '2023-03-01 22:47:23'),
(57, 'CIT 308', 'Y3S2', '2023-03-01 22:47:49'),
(58, 'CIT 310', 'Y3S2', '2023-03-01 22:48:17'),
(59, 'CIT 314', 'Y3S2', '2023-03-01 22:48:39'),
(60, 'CIT 316', 'Y3S2', '2023-03-01 22:49:03'),
(61, 'CIT 320', 'Y3S2', '2023-03-01 22:49:25'),
(62, 'CIT 322', 'Y3S2', '2023-03-01 22:49:48'),
(63, 'CIT 401', 'Y4S1', '2023-03-01 22:51:06'),
(64, 'CIT 405', 'Y4S1', '2023-03-01 22:52:54'),
(65, 'CIT 409', 'Y4S1', '2023-03-01 22:53:36'),
(66, 'CIT 411', 'Y4S1', '2023-03-01 22:54:59'),
(68, 'CIT 407', 'Y4S1', '2023-03-01 22:55:43'),
(69, 'CIT 413', 'Y4S1', '2023-03-01 22:56:09'),
(70, 'CIT 415', 'Y4S1', '2023-03-01 22:57:06'),
(71, 'CIT 419', 'Y4S1', '2023-03-01 22:58:04'),
(72, 'ABA 424', 'Y4S2', '2023-03-01 23:45:43'),
(73, 'CIT 402', 'Y4S2', '2023-03-01 23:46:11'),
(75, 'CIT 406', 'Y4S2', '2023-03-01 23:47:18'),
(76, 'CIT 408', 'Y4S2', '2023-03-01 23:48:06'),
(77, 'CIT 410', 'Y4S2', '2023-03-01 23:48:36'),
(78, 'CIT 412', 'Y4S2', '2023-03-01 23:49:03'),
(79, 'CIT 414', 'Y4S2', '2023-03-01 23:49:43'),
(80, 'CIT 416', 'Y4S2', '2023-03-01 23:50:14'),
(81, 'CIT 418', 'Y4S2', '2023-03-01 23:50:43'),
(82, 'CIT 420', 'Y4S2', '2023-03-01 23:51:08'),
(86, 'CIS 101', 'Y1S1', '2023-03-02 08:57:03'),
(87, 'CIS 103', 'Y1S1', '2023-03-02 08:59:05'),
(88, 'CIS 103', 'Y1S1', '2023-03-02 08:59:05'),
(89, 'CIS 105', 'Y1S1', '2023-03-02 08:59:31'),
(90, 'CIS 107', 'Y1S1', '2023-03-02 08:59:57'),
(91, 'CIS 109', 'Y1S1', '2023-03-02 09:00:23'),
(92, 'CIS 111', 'Y1S1', '2023-03-02 09:00:53'),
(93, 'CIS 102', 'Y1S2', '2023-03-02 09:01:51'),
(94, 'CIS 104', 'Y1S2', '2023-03-02 09:02:23'),
(95, 'CIS 106', 'Y1S2', '2023-03-02 09:02:49'),
(96, 'CIS 108', 'Y1S2', '2023-03-02 09:03:11'),
(97, 'CIS 110', 'Y1S2', '2023-03-02 09:03:38'),
(98, 'CIS 112', 'Y1S2', '2023-03-02 09:04:00'),
(99, 'CIS 114', 'Y1S2', '2023-03-02 09:04:22'),
(100, ' CIS 201', 'Y2S1', '2023-03-02 09:04:52'),
(101, 'CIS 203', 'Y2S1', '2023-03-02 09:05:19'),
(102, 'CIS 205', 'Y2S1', '2023-03-02 09:05:44'),
(103, 'CIS 207', 'Y2S1', '2023-03-02 09:06:21'),
(104, 'CIS 209', 'Y2S1', '2023-03-02 09:06:47'),
(105, 'CIS 211', 'Y2S1', '2023-03-02 09:07:13'),
(106, 'CIS 213', 'Y2S1', '2023-03-02 09:07:44'),
(107, 'CIS 215', 'Y2S1', '2023-03-02 09:08:06'),
(108, 'CIS 202', 'Y2S2', '2023-03-02 09:08:35'),
(109, 'CIS 204', 'Y2S2', '2023-03-02 09:09:01'),
(110, 'CIS 206', 'Y2S2', '2023-03-02 09:09:34'),
(111, 'CIS 208', 'Y2S2', '2023-03-02 09:10:19'),
(112, 'CIS 210', 'Y2S2', '2023-03-02 09:17:22'),
(113, 'CIS 212', 'Y2S2', '2023-03-02 09:17:48'),
(114, 'CIS 214', 'Y2S2', '2023-03-02 09:18:31'),
(115, 'CIS 301', 'Y3S1', '2023-03-02 09:19:15'),
(116, 'CIS 303', 'Y3S1', '2023-03-02 09:19:56'),
(117, 'CIS 305', 'Y3S1', '2023-03-02 09:20:33'),
(118, 'CIS 307', 'Y3S1', '2023-03-02 09:20:56'),
(119, 'CIS 309', 'Y3S1', '2023-03-02 09:21:21'),
(120, 'CIS 311', 'Y3S1', '2023-03-02 09:21:48'),
(121, 'CIS 313', 'Y3S1', '2023-03-02 09:22:18'),
(122, 'CIS 315', 'Y3S1', '2023-03-02 09:22:43'),
(123, 'CIS 302', 'Y3S2', '2023-03-02 09:23:13'),
(124, 'CIS 304', 'Y3S2', '2023-03-02 09:23:36'),
(125, 'CIS 306', 'Y3S2', '2023-03-02 09:24:08'),
(126, 'CIS 308', 'Y3S2', '2023-03-02 09:24:37'),
(127, 'CIS 310', 'Y3S2', '2023-03-02 09:25:00'),
(128, 'CIS 312', 'Y3S2', '2023-03-02 09:25:26'),
(129, 'CIS 314', 'Y3S2', '2023-03-02 09:25:57'),
(130, 'CIS 316', 'Y3S2', '2023-03-02 09:26:23'),
(131, 'CIS 318', 'Y3S2', '2023-03-02 09:26:50'),
(132, 'CIS 401', 'Y4S1', '2023-03-02 09:27:49'),
(133, 'CIS 403', 'Y4S1', '2023-03-02 09:28:19'),
(134, 'CIS 405', 'Y4S1', '2023-03-02 09:28:41'),
(135, 'CIS 407', 'Y4S1', '2023-03-02 09:29:04'),
(136, 'CIS 409', 'Y4S1', '2023-03-02 09:29:27'),
(137, 'CIS 411', 'Y4S1', '2023-03-02 09:29:55'),
(138, 'CIS 413', 'Y4S1', '2023-03-02 09:30:22'),
(139, 'CIS 415', 'Y4S1', '2023-03-02 09:30:54'),
(140, 'CIS 417', 'Y4S1', '2023-03-02 09:31:22'),
(141, 'CIS 402', 'Y4S2', '2023-03-02 09:32:01'),
(142, 'CIS 404', 'Y4S2', '2023-03-02 09:32:39'),
(143, 'CIS 406', 'Y4S2', '2023-03-02 09:33:21'),
(144, 'CIS 408', 'Y4S2', '2023-03-02 09:33:56'),
(145, 'CIS 410', 'Y4S2', '2023-03-02 09:34:21'),
(146, 'CIS 412', 'Y4S2', '2023-03-02 09:34:42'),
(147, 'CIS 414', 'Y4S2', '2023-03-02 09:35:08'),
(148, 'CIS 416', 'Y4S2', '2023-03-02 09:35:34'),
(149, 'CIS 418', 'Y4S2', '2023-03-02 09:35:57'),
(150, 'CIM 101', 'Y1S1', '2023-03-02 09:37:46'),
(151, 'CIM 103', 'Y1S1', '2023-03-02 09:38:09'),
(152, 'CIM 105', 'Y1S1', '2023-03-02 09:38:34'),
(153, 'CIM 107', 'Y1S1', '2023-03-02 09:39:03'),
(154, 'CIM 109', 'Y1S1', '2023-03-02 09:39:27'),
(155, 'CIM 111', 'Y1S1', '2023-03-02 09:39:50'),
(156, 'CIM 113', 'Y1S1', '2023-03-02 09:40:15'),
(158, 'CIM 104', 'Y1S2', '2023-03-02 09:41:05'),
(159, 'CIM 106', 'Y1S2', '2023-03-02 09:41:31'),
(164, 'CIM 116', 'Y1S2', '2023-03-02 09:43:37'),
(165, 'CIM 201', 'Y2S1', '2023-03-02 09:45:54'),
(166, 'CIM 203', 'Y2S1', '2023-03-02 09:46:20'),
(167, 'CIM 205', 'Y2S1', '2023-03-02 09:46:51'),
(168, 'CIM 207', 'Y2S1', '2023-03-02 09:47:15'),
(169, 'CIM 209', 'Y2S1', '2023-03-02 09:47:55'),
(170, 'CIM 211', 'Y2S1', '2023-03-02 09:48:28'),
(171, 'CIM 213', 'Y2S1', '2023-03-02 09:49:01'),
(172, 'CIM 215', 'Y2S1', '2023-03-02 09:49:36'),
(174, 'CIM 204', 'Y2S2', '2023-03-02 09:51:09'),
(175, 'CIM 206', 'Y2S2', '2023-03-02 09:51:38'),
(176, 'CIM 208', 'Y2S2', '2023-03-02 09:52:02'),
(177, 'CIM 210', 'Y2S2', '2023-03-02 09:52:35'),
(178, 'CIM 212', 'Y2S2', '2023-03-02 09:52:59'),
(179, 'CIM 214', 'Y2S2', '2023-03-02 09:53:23'),
(180, 'CIM 216', 'Y2S2', '2023-03-02 09:53:49'),
(181, 'CIM 301', 'Y3S1', '2023-03-02 09:54:18'),
(182, 'CIM 303', 'Y3S1', '2023-03-02 09:54:47'),
(183, 'CIM 307', 'Y3S1', '2023-03-02 09:55:10'),
(184, 'CIM 311', 'Y3S1', '2023-03-02 09:55:31'),
(185, 'CIM 305', 'Y3S1', '2023-03-02 09:56:23'),
(186, 'CIM 309', 'Y3S1', '2023-03-02 09:57:09'),
(187, 'CIM 313', 'Y3S1', '2023-03-02 09:57:34'),
(188, 'CIM 315', 'Y3S1', '2023-03-02 09:58:00'),
(189, 'CIM 317', 'Y3S1', '2023-03-02 09:58:36'),
(190, 'CIM 319', 'Y3S1', '2023-03-02 09:59:12'),
(191, 'CIM 321', 'Y3S1', '2023-03-02 09:59:59'),
(192, 'CIM 302', 'Y3S2', '2023-03-02 10:00:27'),
(193, 'CIM 304', 'Y3S2', '2023-03-02 10:00:57'),
(194, 'CIM 308', 'Y3S2', '2023-03-02 10:01:24'),
(195, 'CIM 312', 'Y3S2', '2023-03-02 10:01:55'),
(196, 'CIM 306', 'Y3S2', '2023-03-02 10:02:29'),
(197, 'CIM 310', 'Y3S2', '2023-03-02 10:02:54'),
(198, 'CIM 316', 'Y3S2', '2023-03-02 10:03:16'),
(199, 'CIM 318', 'Y3S2', '2023-03-02 10:03:40'),
(200, 'CIM 320', 'Y3S2', '2023-03-02 10:04:07'),
(201, 'CIM 322', 'Y3S2', '2023-03-02 10:04:49'),
(202, 'CIM 324', 'Y3S2', '2023-03-02 10:05:16'),
(203, 'CIM 401', 'Y4S1', '2023-03-02 10:05:59'),
(204, 'CIM 403', 'Y4S1', '2023-03-02 10:06:21'),
(205, 'CIM 407', 'Y4S1', '2023-03-02 10:06:49'),
(206, 'CIM 409', 'Y4S1', '2023-03-02 10:07:13'),
(207, 'CIM 405', 'Y4S1', '2023-03-02 10:07:37'),
(208, 'CIM 411', 'Y4S1', '2023-03-02 10:08:08'),
(209, 'CIM 413', 'Y4S1', '2023-03-02 10:08:34'),
(210, 'CIM 415', 'Y4S1', '2023-03-02 10:09:03'),
(211, 'CIM 417', 'Y4S1', '2023-03-02 10:09:28'),
(212, 'CIM 319', 'Y4S1', '2023-03-02 10:09:51'),
(213, 'CIM 321', 'Y4S1', '2023-03-02 10:10:17'),
(214, 'CIM 423', 'Y4S1', '2023-03-02 10:10:45'),
(215, 'CIM 425', 'Y4S1', '2023-03-02 10:11:14'),
(216, 'CIM 402', 'Y4S2', '2023-03-02 10:11:58'),
(217, 'CIM 404', 'Y4S2', '2023-03-02 10:12:23'),
(218, 'CIM 406', 'Y4S2', '2023-03-02 10:12:48'),
(219, 'CIM 408', 'Y4S2', '2023-03-02 10:13:20'),
(220, 'CIM 410', 'Y4S2', '2023-03-02 10:14:22'),
(221, 'CIM 412', 'Y4S2', '2023-03-02 10:14:45'),
(222, 'CIM 414', 'Y4S2', '2023-03-02 10:15:12'),
(223, 'CIM 416', 'Y4S2', '2023-03-02 10:15:54'),
(224, 'CIM 418', 'Y4S2', '2023-03-02 10:16:26'),
(225, 'CIM 420', 'Y4S2', '2023-03-02 10:17:02'),
(226, 'CIM 422', 'Y4S2', '2023-03-02 10:17:25'),
(227, 'CIM 424', 'Y4S2', '2023-03-02 10:17:50'),
(228, 'CIM 426', 'Y4S2', '2023-03-02 10:18:14'),
(229, 'CCT 101', 'Y1S1', '2023-03-02 10:22:48'),
(230, 'CCT 103', 'Y1S1', '2023-03-02 10:23:18'),
(231, 'CCT 105', 'Y1S1', '2023-03-02 10:23:50'),
(232, 'CCT 107', 'Y1S1', '2023-03-02 10:24:19'),
(233, 'CCT 109', 'Y1S1', '2023-03-02 10:24:46'),
(234, 'CCT 113', 'Y1S1', '2023-03-02 10:25:17'),
(235, 'CCT 115', 'Y1S1', '2023-03-02 10:25:40'),
(236, 'CCT 104', 'Y1S2', '2023-03-02 10:27:26'),
(237, 'CCT 106', 'Y1S2', '2023-03-02 10:27:56'),
(238, 'CCT 108', 'Y1S2', '2023-03-02 10:28:38'),
(239, 'CCT 110', 'Y1S2', '2023-03-02 10:31:50'),
(240, 'CCT 112', 'Y1S2', '2023-03-02 10:32:14'),
(241, 'CCT 114', 'Y1S2', '2023-03-02 10:32:46'),
(242, 'CCT 102', 'Y1S2', '2023-03-02 10:33:21'),
(243, 'CCT 201', 'Y2S1', '2023-03-02 10:34:09'),
(244, 'CCT 203', 'Y2S1', '2023-03-02 10:35:12'),
(245, 'CCT 205', 'Y2S1', '2023-03-02 10:35:45'),
(246, 'CCT 207', 'Y2S1', '2023-03-02 10:36:12'),
(247, 'CCT 209', 'Y2S1', '2023-03-02 10:36:42'),
(248, 'CCT 211', 'Y2S1', '2023-03-02 10:38:09'),
(249, 'CCT 213', 'Y2S1', '2023-03-02 10:38:44'),
(250, 'CCT 204', 'Y2S1', '2023-03-02 10:42:23'),
(251, 'CCT 202', 'Y2S2', '2023-03-02 10:42:47'),
(252, 'CCT 206', 'Y2S2', '2023-03-02 10:43:17'),
(253, 'CCT 208', 'Y2S2', '2023-03-02 10:43:48'),
(254, 'CCT 210', 'Y2S2', '2023-03-02 10:44:15'),
(255, 'CCT 212', 'Y2S2', '2023-03-02 10:44:43'),
(256, 'CCT 214', 'Y2S2', '2023-03-02 10:45:06'),
(257, 'CCT 216', 'Y2S2', '2023-03-02 10:45:31'),
(258, 'CCT 215', 'Y2S2', '2023-03-02 10:45:57'),
(259, 'CCT 301', 'Y3S1', '2023-03-02 10:46:54'),
(260, 'CCT 303	', 'Y3S1', '2023-03-02 10:47:18'),
(261, 'CCT 305', 'Y3S1', '2023-03-02 10:47:49'),
(262, 'CCT 307', 'Y3S1', '2023-03-02 10:48:16'),
(263, 'CCT 309', 'Y3S1', '2023-03-02 10:48:41'),
(264, 'CCT 311', 'Y3S1', '2023-03-02 10:49:11'),
(265, 'CCT 311', 'Y3S1', '2023-03-02 10:49:11'),
(266, 'CCT 315', 'Y3S1', '2023-03-02 10:49:40'),
(267, 'CCT 317', 'Y3S1', '2023-03-02 10:50:07'),
(268, 'CCT 319', 'Y3S1', '2023-03-02 10:50:35'),
(269, 'CCT 302', 'Y3S2', '2023-03-02 10:51:09'),
(270, 'CCT 304', 'Y3S2', '2023-03-02 10:51:32'),
(271, 'CCT 306', 'Y3S2', '2023-03-02 10:51:59'),
(272, 'CCT 308', 'Y3S2', '2023-03-02 10:52:28'),
(273, 'CCT 312', 'Y3S2', '2023-03-02 10:52:52'),
(274, 'CCT 316', 'Y3S2', '2023-03-02 10:53:20'),
(275, 'CCT 320', 'Y3S2', '2023-03-02 10:53:55'),
(276, 'CCT 322', 'Y3S2', '2023-03-02 10:54:27'),
(277, 'CCT 401', 'Y4S1', '2023-03-02 10:55:25'),
(278, 'CCT 403', 'Y4S1', '2023-03-02 10:55:54'),
(279, 'CCT 405', 'Y4S1', '2023-03-02 10:56:37'),
(280, 'CCT 411', 'Y4S1', '2023-03-02 10:57:06'),
(281, 'CCT 413', 'Y4S1', '2023-03-02 10:57:28'),
(282, 'CCT 415', 'Y4S1', '2023-03-02 10:57:52'),
(283, 'CCT 417', 'Y4S1', '2023-03-02 10:58:15'),
(284, 'CCT 419', 'Y4S1', '2023-03-02 10:58:40'),
(285, 'CCT 425', 'Y4S1', '2023-03-02 10:59:05'),
(286, 'CCT 416', 'Y4S1', '2023-03-02 10:59:31'),
(287, 'CCT 402', 'Y4S2', '2023-03-02 11:00:11'),
(288, 'CCT 406', 'Y4S2', '2023-03-02 11:00:34'),
(289, 'CCT 407', 'Y4S1', '2023-03-02 11:01:10'),
(291, 'CCT 412', 'Y4S2', '2023-03-02 11:02:02'),
(292, 'CCT 418', 'Y4S2', '2023-03-02 11:02:26'),
(293, 'CCT 420', 'Y4S2', '2023-03-02 11:02:49'),
(294, 'CCT 430', 'Y4S2', '2023-03-02 11:03:16'),
(295, 'CCS 101', 'Y1S1', '2023-03-02 11:05:56'),
(296, 'CCS 103', 'Y1S1', '2023-03-02 11:06:21'),
(297, 'CCS 105', 'Y1S1', '2023-03-02 11:06:54'),
(298, 'CCS 107', 'Y1S1', '2023-03-02 11:07:22'),
(299, 'CCS 109', 'Y1S1', '2023-03-02 11:07:47'),
(300, 'CCS 111', 'Y1S1', '2023-03-02 11:08:16'),
(301, 'CCS 113', 'Y1S1', '2023-03-02 11:08:44'),
(302, 'CCS 102', 'Y1S2', '2023-03-02 11:09:12'),
(303, 'CCS 104', 'Y1S2', '2023-03-02 11:09:46'),
(304, 'CCS 106', 'Y1S2', '2023-03-02 11:10:09'),
(305, 'CCS 108', 'Y1S2', '2023-03-02 11:10:43'),
(306, 'CCS 110', 'Y1S2', '2023-03-02 11:11:32'),
(307, 'CCS 112', 'Y1S2', '2023-03-02 11:12:01'),
(308, 'CCS 114', 'Y1S2', '2023-03-02 11:12:26'),
(309, 'CCS 201', 'Y2S1', '2023-03-02 11:13:11'),
(310, 'CCS 203', 'Y2S1', '2023-03-02 11:13:41'),
(311, 'CCS 205', 'Y2S1', '2023-03-02 11:14:39'),
(312, 'CCS 207', 'Y2S1', '2023-03-02 11:15:13'),
(313, 'CCS 209', 'Y2S1', '2023-03-02 11:15:37'),
(314, 'CCS 211', 'Y2S1', '2023-03-02 11:16:12'),
(315, 'CCS 213', 'Y2S1', '2023-03-02 11:16:37'),
(316, 'CCS 202', 'Y2S2', '2023-03-02 11:17:06'),
(317, 'CCS 204', 'Y2S2', '2023-03-02 11:17:32'),
(318, 'CCS 206', 'Y2S2', '2023-03-02 11:18:11'),
(319, 'CCS 208', 'Y2S2', '2023-03-02 11:18:55'),
(320, 'CCS 210', 'Y2S2', '2023-03-02 11:19:22'),
(321, 'CCS 212', 'Y2S2', '2023-03-02 11:19:57'),
(322, 'CCS 214', 'Y2S2', '2023-03-02 11:20:21'),
(323, 'CCS 216', 'Y2S2', '2023-03-02 11:20:50'),
(324, 'CCS 301', 'Y3S1', '2023-03-02 11:21:44'),
(325, 'CCS 303', 'Y3S1', '2023-03-02 11:22:16'),
(326, 'CCS 305', 'Y3S1', '2023-03-02 11:22:54'),
(327, 'CCS 307', 'Y3S1', '2023-03-02 11:23:18'),
(328, 'CCS 309', 'Y3S1', '2023-03-02 11:23:51'),
(329, 'CCS 313', 'Y3S1', '2023-03-02 11:24:25'),
(330, 'CCS 315', 'Y3S1', '2023-03-02 11:24:52'),
(331, 'CCS 317', 'Y3S1', '2023-03-02 11:25:21'),
(332, 'CCS 319', 'Y3S1', '2023-03-02 11:25:53'),
(333, 'CCS 323', 'Y3S1', '2023-03-02 11:26:22'),
(334, 'CCS 302', 'Y3S2', '2023-03-02 11:27:31'),
(335, 'CCS 304', 'Y3S2', '2023-03-02 11:27:59'),
(336, 'CCS 306', 'Y3S2', '2023-03-02 11:28:28'),
(337, 'CCS 308', 'Y3S2', '2023-03-02 11:28:51'),
(338, 'CCS 310', 'Y3S2', '2023-03-02 11:29:21'),
(339, 'CCS 312', 'Y3S2', '2023-03-02 11:29:50'),
(340, 'CCS 314', 'Y3S2', '2023-03-02 11:30:14'),
(341, 'CCS 316', 'Y3S2', '2023-03-02 11:30:43'),
(342, 'CCS 318', 'Y3S2', '2023-03-02 11:31:09'),
(343, 'CCS 401', 'Y4S1', '2023-03-02 11:32:05'),
(344, 'CCS 403', 'Y4S1', '2023-03-02 11:32:28'),
(345, 'CCS 405', 'Y4S1', '2023-03-02 11:32:52'),
(346, 'CCS 407', 'Y4S1', '2023-03-02 11:33:25'),
(347, 'CCS 409', 'Y4S1', '2023-03-02 11:33:50'),
(348, 'CCS 415', 'Y4S1', '2023-03-02 11:34:31'),
(349, 'CCS 417', 'Y4S1', '2023-03-02 11:34:54'),
(350, 'CCS 419', 'Y4S1', '2023-03-02 11:35:19'),
(351, 'CCS 421', 'Y4S1', '2023-03-02 11:35:45'),
(352, 'CCS 420', 'Y4S1', '2023-03-02 11:36:09'),
(353, 'CCS 404', 'Y4S2', '2023-03-02 11:36:39'),
(354, 'CCS 406', 'Y4S2', '2023-03-02 11:37:02'),
(355, 'CCS 408', 'Y4S2', '2023-03-02 11:37:35'),
(356, 'CCS 412', 'Y4S2', '2023-03-02 11:37:58'),
(357, 'CCS 414', 'Y4S2', '2023-03-02 11:38:24'),
(358, 'CCS 418', 'Y4S2', '2023-03-02 11:38:51'),
(359, 'CCS 422', 'Y4S2', '2023-03-02 11:39:17'),
(361, 'CCS 416', 'Y4S2', '2023-03-20 23:23:40'),
(364, 'CCT 116', 'Y1S2', '2023-03-20 23:33:25'),
(365, 'CCT 118', 'Y1S2', '2023-03-20 23:36:19'),
(366, 'CCS 122', 'Y1S2', '2023-03-20 23:36:54'),
(367, 'CCT 318', 'Y3S2', '2023-03-20 23:37:29'),
(369, 'CIT 118', 'Y1S2', '2023-03-25 10:53:09'),
(370, 'CIT 120', 'Y1S2', '2023-03-25 10:54:12'),
(371, 'CIM 118', 'Y1S2', '2023-03-25 11:22:18'),
(373, 'CIM 108', 'Y1S2', '2023-03-25 11:32:50'),
(374, 'CIM 120', 'Y1S2', '2023-03-25 11:33:41'),
(375, 'CIM 202', 'Y2S2', '2023-03-25 11:36:26'),
(376, 'CIT 404', 'Y4S2', '2023-03-25 11:42:27'),
(377, 'CIS 118', 'Y1S2', '2023-03-25 11:44:44'),
(378, 'CIS 120', 'Y1S2', '2023-03-25 11:46:01'),
(381, 'ABS 424', 'Y4S2', '2023-03-25 15:12:49'),
(382, 'CIT 403', 'Y4S1', '2023-03-25 15:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `pf_number` varchar(20) NOT NULL,
  `user_title` varchar(20) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` int(20) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `pf_number`, `user_title`, `user_firstname`, `user_lastname`, `user_email`, `user_phone`, `user_password`, `password_reset_token`, `date_created`) VALUES
(1, 'PF01', 'Dr', ' Titus', 'Muhambe', 'muhambe@maseno.ac.ke', 785412562, '41183fc34c443b5ef29622b5bad9021bcdb766c260dc4efc766965d1711a8f710b3f7261', NULL, '2022-12-16 19:57:25'),
(2, 'PF02', 'Mrs', 'Violet', 'Settim', 'vsettim@maseno.ac.ke', 752452868, '58b94b70faccb444ca0ae2a5dba9be2acdb766c260dc4efc766965d1711a8f710b3f7261', NULL, '2022-12-16 19:58:26'),
(3, 'PF03', 'Dr', ' Samuel', 'Oonge', 'soonge@maseno.ac.ke', 752452868, 'eb0434fee150ffbac0777c820714fb1bcdb766c260dc4efc766965d1711a8f710b3f7261', NULL, '2022-12-16 20:49:58'),
(4, 'PF04', 'Mr', 'Isaac', 'Owino', ' iowino@maseno.ac.ke', 785412541, 'a9750013af3699fe09e7ef855cc73b26cdb766c260dc4efc766965d1711a8f710b3f7261', NULL, '2022-12-16 20:55:14'),
(5, 'PF05', 'Mr', 'Benson', 'Makau', 'bensonmakau2000@gmail.com', 758413462, 'fa34efef1fbcadf4c6f2fbdda9e7bad4cdb766c260dc4efc766965d1711a8f710b3f7261', NULL, '2023-02-16 20:17:16'),
(6, 'PF06', 'Dr', 'Calvins', 'Otieno', 'cotieno@maseno.ac.ke', 741258795, '318216c3766e84bd7dbc11850ec39d7acdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 12:25:05'),
(7, 'PF07', 'Mr', 'David', 'Saka', 'sakad2011@gmail.com', 785785689, '9cd3c90d8a8d9402e256c668ccde5e11cdb766c260dc4efc766965d1711a8f710b3f7261', NULL, '2023-03-09 10:32:21'),
(8, 'PF08', 'Mr', 'George', 'Omuono', 'omuono@maseno.ac.ke', 752458256, 'e51ebb11e912d482972e91f5b2243849cdb766c260dc4efc766965d1711a8f710b3f7261', NULL, '2023-03-09 11:47:42'),
(9, 'PF09', 'Dr', 'Erick', 'Obare', 'oteyo@maseno.ac.ke', 752658575, '34934ea8ec5dd876f829adbe07b65961cdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 11:52:01'),
(10, 'PF10', 'Mr', 'James', 'Chamwama', 'chamwama@maseno.ac.ke', 795824582, '31b90ee1a33da1431913c70021722926cdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 11:52:56'),
(11, 'PF11', 'Mr', 'Charles', 'Awuor', 'jumamark1234@gmail.com', 762854852, '511fae1765b80afceb29cf5fbcd15e17cdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 11:54:16'),
(12, 'PF12', 'Mr', 'Gabriel', 'Oliko', 'goliko2002@gmail.com', 752785245, '4f8977b865468be91c3cc666d03ee2f3cdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 11:55:11'),
(13, 'PF13', 'Mrs', 'Rennish', 'Mboya', 'rennishm@gmail.com', 752897412, '70642600a08efae11ab6d83b52e9a8e9cdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 11:56:08'),
(14, 'PF14', 'Mrs', 'Maurine', 'Awuor', 'cnyambuga@maseno.ac.ke', 741789547, '96777c2aa17ebbd8b84cfc25fd559714cdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 11:57:06'),
(15, 'PF15', 'Mr', 'Bethuel', 'Okelo', 'bethuel.okello@maseno.ac.ke', 723547858, '37267a49029c50f832ff1e3dc45bb44bcdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 11:58:03'),
(16, 'PF16', 'Mr', 'Michael', 'Wambwere', 'mwambwere@maseno.ac.ke', 712524789, '7b9b8b1311511a6bb0903dd2bdf5ef95cdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 11:59:11'),
(17, 'PF17', 'Mr', 'Moses', 'Wainaina', 'moses.wainaina@maseno.ac.ke', 798457585, '8a232e18e5696750da8543e323a1b363cdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 12:00:17'),
(18, 'PF18', 'Mrs', 'Yvonne', 'Mwajuma', 'ymwajuma@maseno.ac.ke', 741256585, '85db1de2e3d332b956969dbbd7d8a21acdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 12:01:26'),
(19, 'PF19', 'Mrs', 'Rose', 'Kapukha', 'rkapukha@maseno.ac.ke', 742789525, '8eb69cc52a93ea7b6281b674ecc65abacdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 12:02:23'),
(20, 'PF20', 'Dr', 'Lilian', 'Wanzare', 'ldwanzare@maseno.ac.ke', 742156585, '2fa61c19d6975b56e0800bdca11358b6cdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 12:05:33'),
(21, 'PF21', 'Dr', 'Sylvester', 'McOyowo', 'omcoyowo@maseno.ac.ke', 714257585, '64ff6aea6ca5f902a49fd8b387c55787cdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 12:07:02'),
(22, 'PF22', 'Dr', 'Henry', 'Okoyo', 'ookoyo@maseno.ac.ke', 712456257, 'd288a9980aaa616063101f3416b99dc4cdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 12:08:45'),
(23, 'PF23', 'Mr', 'Solomon', 'Nyabundi', 'solonyabs@gmail.com', 714256478, '3d5e0bb3323b7caf64dffce76a7bd092cdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 12:09:42'),
(24, 'PF24', 'Mr', 'Dickson', 'Omingo', 'omingodo@maseno.ac.ke', 762748595, '2668f88fa219d86cd20965b9008a29a3cdb766c260dc4efc766965d1711a8f710b3f7261', NULL, '2023-03-09 12:10:30'),
(25, 'PF25', 'Mrs', 'Vivian', 'Oloo', 'voloo@maseno.ac.ke', 724758565, 'e80b69b8963a262c31c5e20650e35fd4cdb766c260dc4efc766965d1711a8f710b3f7261', NULL, '2023-03-09 12:11:20'),
(26, 'PF26', 'Mr', 'John', 'Konyino', 'okonyino@yahoo.com', 745278954, 'fb92e67516c0eb29f12b7e72eb8248dfcdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 12:12:49'),
(27, 'PF27', 'Mr', 'John', 'Alwala', 'alwala@maseno.ac.ke', 732452578, 'bc8a41d8128e770a768d7048602df34acdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 12:14:02'),
(28, 'PF28', 'Mr', 'Michael', 'Ondeja', 'michaelondeja@gmail.com', 742657585, 'b9247041b1890c1e721c39eb7e924ce6cdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 12:14:55'),
(33, 'PF29', 'Dr', 'James', 'Obuhuma', 'obuhumajames12@gmail.com', 745859575, '58afc8013559b43b6549e08f282adeafcdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-20 23:19:13'),
(34, 'PF30', 'Mr', 'M O', 'Adongo', 'adongo@maseno.ac.ke', 741254789, 'b0f2759ec860ccc3195840db56358922cdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-20 23:25:40'),
(35, 'PF31', 'Mr', 'Tomas', 'Ojijo', 'ojijotom@gmail.com', 723459127, 'fe5da4e501fd0f38f34a4aecad380808cdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-20 23:51:25'),
(37, 'PF52', 'Dr', 'Roxanne', 'Hawi', 'roxannehavi@maseno.ac.ke', 752457582, '733cf4ed6fc40042a9514cb42817a54fcdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-25 14:56:47'),
(32, 'PF55', 'Ms', 'Ruth', 'Daphne', 'daphneruth304@gmail.com', 710323547, 'afe4cc51d030b9b23b0aeec793cdc96fcdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-09 23:30:02'),
(36, 'PF60', 'Mr', 'Thomas', 'Ojijo', 'ojijotom@maseno.ac.ke', 714758258, '7ed946148ae8b14c898fcefde7a03734cdb766c260dc4efc766965d1711a8f710b3f7261 ', NULL, '2023-03-25 13:09:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_details`
--

CREATE TABLE `user_role_details` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `role_id` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role_details`
--

INSERT INTO `user_role_details` (`id`, `user_id`, `role_id`, `date_created`) VALUES
(1, 'PF01', 'role003', '2023-02-16 20:22:49'),
(2, 'PF05', 'role001', '2023-02-20 14:39:11'),
(3, 'PF02', 'role002', '2023-03-09 06:21:30'),
(4, 'PF03', 'role002', '2023-03-09 06:22:16'),
(5, 'PF04', 'role002', '2023-03-09 06:22:53'),
(7, 'PF07', 'role002', '2023-03-09 07:32:21'),
(8, 'PF08', 'role002', '2023-03-09 08:47:42'),
(9, 'PF09', 'role002', '2023-03-09 08:52:01'),
(10, 'PF10', 'role002', '2023-03-09 08:52:56'),
(11, 'PF11', 'role002', '2023-03-09 08:54:16'),
(12, 'PF12', 'role002', '2023-03-09 08:55:11'),
(13, 'PF13', 'role002', '2023-03-09 08:56:09'),
(14, 'PF14', 'role002', '2023-03-09 08:57:06'),
(15, 'PF15', 'role002', '2023-03-09 08:58:03'),
(16, 'PF16', 'role002', '2023-03-09 08:59:11'),
(17, 'PF17', 'role002', '2023-03-09 09:00:17'),
(18, 'PF18', 'role002', '2023-03-09 09:01:26'),
(19, 'PF19', 'role002', '2023-03-09 09:02:24'),
(20, 'PF20', 'role003', '2023-03-09 09:05:33'),
(21, 'PF21', 'role002', '2023-03-09 09:07:02'),
(22, 'PF22', 'role002', '2023-03-09 09:08:45'),
(23, 'PF23', 'role002', '2023-03-09 09:09:42'),
(24, 'PF24', 'role002', '2023-03-09 09:10:30'),
(25, 'PF25', 'role002', '2023-03-09 09:11:20'),
(26, 'PF26', 'role002', '2023-03-09 09:12:49'),
(27, 'PF27', 'role002', '2023-03-09 09:14:02'),
(28, 'PF28', 'role002', '2023-03-09 09:14:55'),
(29, 'PF06', 'role004', '2023-03-09 09:25:05'),
(32, 'PF55', 'role001', '2023-03-09 20:30:02'),
(33, 'PF29', 'role002', '2023-03-20 20:19:14'),
(34, 'PF30', 'role002', '2023-03-20 20:25:40'),
(35, 'PF31', 'role002', '2023-03-20 20:51:25'),
(36, 'PF60', 'role002', '2023-03-25 10:09:58'),
(37, 'PF52', 'role002', '2023-03-25 11:56:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_year`
--
ALTER TABLE `academic_year`
  ADD PRIMARY KEY (`academic_year_id`),
  ADD KEY `iddd` (`id`),
  ADD KEY `yearid` (`academic_year`);

--
-- Indexes for table `course_details`
--
ALTER TABLE `course_details`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `course_name` (`course_name`),
  ADD UNIQUE KEY `course_shortform` (`course_shortform`),
  ADD KEY `idd` (`id`);

--
-- Indexes for table `course_group_details`
--
ALTER TABLE `course_group_details`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `academic_year_id` (`academic_year_id`),
  ADD KEY `grpid` (`id`);

--
-- Indexes for table `department_course_details`
--
ALTER TABLE `department_course_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_id` (`course_id`),
  ADD KEY `dpt` (`department_id`);

--
-- Indexes for table `department_details`
--
ALTER TABLE `department_details`
  ADD PRIMARY KEY (`department_id`),
  ADD UNIQUE KEY `department_name` (`department_name`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `lecturer_department_details`
--
ALTER TABLE `lecturer_department_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lid` (`lecturer_id`),
  ADD KEY `did` (`department_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `lecturer_unit_details`
--
ALTER TABLE `lecturer_unit_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `lecturer_id` (`lecturer_id`),
  ADD KEY `acdid` (`academic_year_id`);

--
-- Indexes for table `role_details`
--
ALTER TABLE `role_details`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `idd` (`id`);

--
-- Indexes for table `room_details`
--
ALTER TABLE `room_details`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `rm_typ_iddd` (`room_type_id`),
  ADD KEY `dgfif` (`id`),
  ADD KEY `room_name` (`room_name`);

--
-- Indexes for table `room_type_details`
--
ALTER TABLE `room_type_details`
  ADD PRIMARY KEY (`room_type_id`),
  ADD KEY `id_rm_typ` (`id`);

--
-- Indexes for table `school_department_details`
--
ALTER TABLE `school_department_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_id` (`department_id`),
  ADD KEY `id` (`school_id`);

--
-- Indexes for table `school_details`
--
ALTER TABLE `school_details`
  ADD PRIMARY KEY (`school_id`),
  ADD KEY `schidddd` (`id`);

--
-- Indexes for table `semester_details`
--
ALTER TABLE `semester_details`
  ADD PRIMARY KEY (`semester_id`),
  ADD KEY `sid` (`id`);

--
-- Indexes for table `unit_course_details`
--
ALTER TABLE `unit_course_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`unit_id`),
  ADD KEY `cid` (`course_id`);

--
-- Indexes for table `unit_details`
--
ALTER TABLE `unit_details`
  ADD PRIMARY KEY (`unit_code`),
  ADD KEY `iddddddd` (`id`);

--
-- Indexes for table `unit_room_time_day_allocation_details`
--
ALTER TABLE `unit_room_time_day_allocation_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room` (`room_id`),
  ADD KEY `day_of_the_week` (`weekday`),
  ADD KEY `weekday_id` (`weekday`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `lecturer_id` (`lecturer_id`);

--
-- Indexes for table `unit_semester_details`
--
ALTER TABLE `unit_semester_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unitid` (`unit_id`),
  ADD KEY `semid` (`semester_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`pf_number`),
  ADD UNIQUE KEY `email` (`user_email`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `user_role_details`
--
ALTER TABLE `user_role_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`user_id`),
  ADD KEY `roleid` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_year`
--
ALTER TABLE `academic_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_details`
--
ALTER TABLE `course_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_group_details`
--
ALTER TABLE `course_group_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `department_course_details`
--
ALTER TABLE `department_course_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `department_details`
--
ALTER TABLE `department_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lecturer_department_details`
--
ALTER TABLE `lecturer_department_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `lecturer_unit_details`
--
ALTER TABLE `lecturer_unit_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `role_details`
--
ALTER TABLE `role_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `room_details`
--
ALTER TABLE `room_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `room_type_details`
--
ALTER TABLE `room_type_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `school_department_details`
--
ALTER TABLE `school_department_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school_details`
--
ALTER TABLE `school_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `semester_details`
--
ALTER TABLE `semester_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `unit_course_details`
--
ALTER TABLE `unit_course_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;

--
-- AUTO_INCREMENT for table `unit_details`
--
ALTER TABLE `unit_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;

--
-- AUTO_INCREMENT for table `unit_room_time_day_allocation_details`
--
ALTER TABLE `unit_room_time_day_allocation_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `unit_semester_details`
--
ALTER TABLE `unit_semester_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=383;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_role_details`
--
ALTER TABLE `user_role_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_group_details`
--
ALTER TABLE `course_group_details`
  ADD CONSTRAINT `aca_yr_id` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_year` (`academic_year_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gripidd` FOREIGN KEY (`course_id`) REFERENCES `course_details` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department_course_details`
--
ALTER TABLE `department_course_details`
  ADD CONSTRAINT `courses` FOREIGN KEY (`course_id`) REFERENCES `course_details` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dpt` FOREIGN KEY (`department_id`) REFERENCES `department_details` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lecturer_department_details`
--
ALTER TABLE `lecturer_department_details`
  ADD CONSTRAINT `dptiid` FOREIGN KEY (`department_id`) REFERENCES `department_details` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lid` FOREIGN KEY (`lecturer_id`) REFERENCES `user_details` (`pf_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lecturer_unit_details`
--
ALTER TABLE `lecturer_unit_details`
  ADD CONSTRAINT `acadmyid` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_year` (`academic_year_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lec_id` FOREIGN KEY (`lecturer_id`) REFERENCES `user_details` (`pf_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `unId_id` FOREIGN KEY (`unit_id`) REFERENCES `unit_details` (`unit_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_details`
--
ALTER TABLE `room_details`
  ADD CONSTRAINT `rm_id_typ` FOREIGN KEY (`room_type_id`) REFERENCES `room_type_details` (`room_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `school_department_details`
--
ALTER TABLE `school_department_details`
  ADD CONSTRAINT `dptid` FOREIGN KEY (`department_id`) REFERENCES `department_details` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schid` FOREIGN KEY (`school_id`) REFERENCES `school_details` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unit_course_details`
--
ALTER TABLE `unit_course_details`
  ADD CONSTRAINT `crsids` FOREIGN KEY (`course_id`) REFERENCES `course_details` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `unitsidddd` FOREIGN KEY (`unit_id`) REFERENCES `unit_details` (`unit_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unit_room_time_day_allocation_details`
--
ALTER TABLE `unit_room_time_day_allocation_details`
  ADD CONSTRAINT `LC` FOREIGN KEY (`lecturer_id`) REFERENCES `user_details` (`pf_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `RM` FOREIGN KEY (`room_id`) REFERENCES `room_details` (`room_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UNT` FOREIGN KEY (`unit_id`) REFERENCES `lecturer_unit_details` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unit_semester_details`
--
ALTER TABLE `unit_semester_details`
  ADD CONSTRAINT `semiddd` FOREIGN KEY (`semester_id`) REFERENCES `semester_details` (`semester_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uniDD` FOREIGN KEY (`unit_id`) REFERENCES `unit_details` (`unit_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_role_details`
--
ALTER TABLE `user_role_details`
  ADD CONSTRAINT `role` FOREIGN KEY (`role_id`) REFERENCES `role_details` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`pf_number`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
