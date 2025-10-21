-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2025 at 06:53 PM
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
-- Database: `db_asbao`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_text`) VALUES
(1, 'The universitys academic and administrative services are easily accessible, well-organized, and align with the services listed on the citizenss charter for each unit.'),
(2, 'The university staff demonstrate professionalism and courtesy in their interactions with clients, ensuring that services listed on the citizens charter for each unit are clearly communicated.'),
(3, 'The University effectively addresses the individual needs and concerns of its clients, in line with the services outlined in the citizens charter for each unit.'),
(4, 'The university staff promptly respond to my inquiries and You sent inquiries and requests.'),
(5, 'The university consistently delivers the services it promises.'),
(6, 'The facilities and resources provided by the university meet the needs of its clients effectively.'),
(7, 'I find it easy to communicate with university staff and faculty.'),
(8, 'The university provides clear and transparent information about fees.'),
(9, 'The university is committed to (Nakatuon ang pamantasan sa katarungan at pantay-pantay na pagtrato.)'),
(10, 'The university instill confidence in its ability to meet the needs of its stakeholders.'),
(11, 'I am satisfied with the overall outcome of my interactions with the (Nasasatisfy ako sa kabuuang mga bunga ng aking pakikipag-ugnayan sa unibersidad.');

-- --------------------------------------------------------

--
-- Table structure for table `question_feedback`
--

CREATE TABLE `question_feedback` (
  `id` int(11) NOT NULL,
  `usercode` varchar(30) NOT NULL,
  `appointid` varchar(30) NOT NULL,
  `question_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_feedback`
--

INSERT INTO `question_feedback` (`id`, `usercode`, `appointid`, `question_id`, `rating`, `status`, `created_at`) VALUES
(43, '250622-061858-69720', '2510132138352', 1, 5, 1, '2025-10-13 13:44:59'),
(44, '250622-061858-69720', '2510132138352', 2, 4, 1, '2025-10-13 13:45:03'),
(45, '250622-061858-69720', '2510132138352', 3, 3, 1, '2025-10-13 13:45:06'),
(46, '250622-061858-69720', '2510132138352', 4, 3, 1, '2025-10-13 13:45:10'),
(47, '250622-061858-69720', '2510132138352', 5, 2, 1, '2025-10-13 13:45:12'),
(48, '251014-120051-16367', '', 1, 5, 0, '2025-10-14 04:35:04'),
(49, '251014-120051-16367', '', 2, 5, 0, '2025-10-14 04:35:10'),
(50, '251014-120051-16367', '', 3, 5, 0, '2025-10-14 04:35:13'),
(51, '251015-101846-51818', '2510151033640', 1, 5, 1, '2025-10-15 02:33:48'),
(52, '251015-101846-51818', '2510151033640', 2, 4, 1, '2025-10-15 02:33:52'),
(53, '251015-101846-51818', '2510151033640', 3, 4, 1, '2025-10-15 02:33:54'),
(54, '251015-101846-51818', '2510151033640', 4, 5, 1, '2025-10-15 02:33:57'),
(55, '251015-101846-51818', '2510151033640', 5, 5, 1, '2025-10-15 02:33:59'),
(56, '251015-101846-51818', '2510151033640', 6, 5, 1, '2025-10-15 02:34:01'),
(57, '251015-110231-48493', '2510151111710', 1, 5, 1, '2025-10-15 03:29:27'),
(58, '251015-110231-48493', '2510151111710', 2, 5, 1, '2025-10-15 03:29:30'),
(59, '251015-110231-48493', '2510151111710', 3, 5, 1, '2025-10-15 03:29:32'),
(60, '251015-110231-48493', '2510151111710', 4, 5, 1, '2025-10-15 03:29:34'),
(61, '251015-110231-48493', '2510151111710', 5, 5, 1, '2025-10-15 03:29:37'),
(62, '251015-110231-48493', '2510151111710', 6, 5, 1, '2025-10-15 03:29:40'),
(63, '251015-110231-48493', '2510151111710', 7, 5, 1, '2025-10-15 03:29:42'),
(64, '251015-110231-48493', '2510151111710', 8, 5, 1, '2025-10-15 03:29:45'),
(65, '251015-110231-48493', '2510151111710', 9, 5, 1, '2025-10-15 03:29:48'),
(66, '251015-110231-48493', '2510151111710', 10, 5, 1, '2025-10-15 03:29:50'),
(67, '251015-110231-48493', '2510151111710', 11, 5, 1, '2025-10-15 03:29:53'),
(68, '251015-140934-82503', '2510151411327', 1, 5, 1, '2025-10-15 06:28:09'),
(69, '251015-140934-82503', '2510151411327', 2, 5, 1, '2025-10-15 06:28:11'),
(70, '251015-140934-82503', '2510151411327', 3, 5, 1, '2025-10-15 06:28:14'),
(71, '251015-140934-82503', '2510151411327', 4, 5, 1, '2025-10-15 06:28:17'),
(72, '251015-140934-82503', '2510151411327', 5, 5, 1, '2025-10-15 06:28:20'),
(73, '251015-140934-82503', '2510151411327', 6, 5, 1, '2025-10-15 06:28:22'),
(74, '251015-140934-82503', '2510151411327', 7, 5, 1, '2025-10-15 06:28:25'),
(75, '251015-140934-82503', '2510151411327', 8, 5, 1, '2025-10-15 06:28:27'),
(76, '251015-140934-82503', '2510151411327', 9, 5, 1, '2025-10-15 06:28:29'),
(77, '251015-140934-82503', '2510151411327', 10, 5, 1, '2025-10-15 06:28:32'),
(78, '251015-140934-82503', '2510151411327', 11, 5, 1, '2025-10-15 06:28:35'),
(79, '251015-122545-49925', '2510151226118', 1, 5, 1, '2025-10-16 14:39:52'),
(80, '251015-122545-49925', '2510151226118', 2, 5, 1, '2025-10-16 14:39:54'),
(81, '251015-122545-49925', '2510151226118', 3, 5, 1, '2025-10-16 14:39:55'),
(82, '251015-122545-49925', '2510151226118', 4, 5, 1, '2025-10-16 14:39:59'),
(83, '251015-122545-49925', '2510151226118', 5, 5, 1, '2025-10-16 14:40:00'),
(84, '251015-122545-49925', '2510151226118', 6, 5, 1, '2025-10-16 14:40:03'),
(85, '251015-122545-49925', '2510151226118', 7, 5, 1, '2025-10-16 14:40:05'),
(86, '251015-122545-49925', '2510151226118', 8, 5, 1, '2025-10-16 14:40:08'),
(87, '251015-122545-49925', '2510151226118', 9, 5, 1, '2025-10-16 14:40:10'),
(88, '251015-122545-49925', '2510151226118', 10, 5, 1, '2025-10-16 14:40:12'),
(89, '251015-122545-49925', '2510151226118', 11, 5, 1, '2025-10-16 14:40:14');

-- --------------------------------------------------------

--
-- Table structure for table `report_entries`
--

CREATE TABLE `report_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `run_id` int(10) UNSIGNED NOT NULL,
  `controlcode` varchar(100) NOT NULL,
  `reservation_date` date DEFAULT NULL,
  `last_name` varchar(150) DEFAULT NULL,
  `first_name` varchar(150) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `department` varchar(150) DEFAULT NULL,
  `venue` varchar(150) DEFAULT NULL,
  `time_display` varchar(100) DEFAULT NULL,
  `activity_date` date DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `status` enum('PENDING','ACCEPTED','COMPLETED','CANCELLED') DEFAULT NULL,
  `feedback_rating` tinyint(3) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report_entries`
--

INSERT INTO `report_entries` (`id`, `run_id`, `controlcode`, `reservation_date`, `last_name`, `first_name`, `contact`, `email`, `address`, `department`, `venue`, `time_display`, `activity_date`, `purpose`, `status`, `feedback_rating`, `created_at`) VALUES
(2, 1, '2510151103531', '2025-10-15', 'Efsor', 'Jaen', '09669145096', 'daraefsormaniable@gmail.com', 'Brgy. Hamorawon', 'CCIS', 'BDC 4th Floor', '09:00 - 11:00', '2025-10-17', 'seminar', 'ACCEPTED', NULL, '2025-10-17 15:13:39'),
(3, 1, '2510151111710', '2025-10-15', 'Efsor', 'Jaen', '09669145096', 'daraefsormaniable@gmail.com', 'Brgy. Hamorawon', 'CCIS', 'BDC 3rd Floor', '11:00 - 12:00', '2025-10-25', 'jdjsjjxdj', 'ACCEPTED', 5, '2025-10-17 15:13:39'),
(4, 1, '2510151120941', '2025-10-15', 'Maniable', 'Dara Jaen', '09669145096', 'darajaenmaniable14@gmail.com', 'Brgy. Hamorawon Calbayog City', 'CCIS', 'BDC 4th Floor', '11:00 - 12:00', '2025-10-17', 'DSHGCHDS', 'ACCEPTED', NULL, '2025-10-17 15:13:39'),
(5, 1, '2510151226118', '2025-10-15', 'Duja', 'Dara', '09669145096', 'daraefsormaniable@gmail.com', 'Brgy. Hamorawon Calbayog City', 'CCIS', 'BDC 2nd Floor', '07:00 - 09:00', '2025-10-25', 'Seminar', 'COMPLETED', 5, '2025-10-17 15:13:39'),
(6, 1, '2510151411327', '2025-10-15', 'Doinog', 'Angeline', '09817768088', 'angelinedoinog2002@gmail.com', 'Brgy. Monbon Sta. Margarita', 'CCIS', 'BDC 2nd Floor', '07:00 - 09:00', '2025-10-16', 'Seminar', 'COMPLETED', 5, '2025-10-17 15:13:39'),
(7, 1, '2510151418133', '2025-10-15', 'Maniable', 'Dara Jaen', '09669450169', 'darajaenmaniable14@gmail.com', 'Brgy. Hamorawon Calbayog City', 'CCIS', 'SOCIO', '07:00 - 09:00', '2025-10-23', 'fdghyfh', 'COMPLETED', NULL, '2025-10-17 15:13:39'),
(8, 1, '2510151439217', '2025-10-15', 'Guion', 'Ymhea', '09558718919', 'justforfuninrpw@gmail.com', 'Brgy. Rawis Calbayog City', 'CCIS', 'BDC 2nd Floor', '13:00 - 15:00', '2025-10-16', 'Oath', 'COMPLETED', NULL, '2025-10-17 15:13:39');

-- --------------------------------------------------------

--
-- Table structure for table `report_runs`
--

CREATE TABLE `report_runs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `department` varchar(150) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `generated_by` varchar(100) DEFAULT NULL,
  `generated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report_runs`
--

INSERT INTO `report_runs` (`id`, `name`, `department`, `start_date`, `end_date`, `generated_by`, `generated_at`) VALUES
(1, 'Appointments - CCIS (2025-10-15 to 2025-10-17)', 'CCIS', '2025-10-15', '2025-10-17', 'Dara', '2025-10-17 15:13:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointment`
--

CREATE TABLE `tbl_appointment` (
  `ID` int(11) NOT NULL,
  `CONTROLCODE` varchar(30) NOT NULL,
  `LASTNAME` varchar(60) NOT NULL,
  `FIRSTNAME` varchar(60) NOT NULL,
  `MIDDLENAME` varchar(60) NOT NULL,
  `CONTACT` varchar(11) NOT NULL,
  `DEPARTMENT` varchar(100) NOT NULL,
  `EMAIL` varchar(60) NOT NULL,
  `ADDRESS` text NOT NULL,
  `REMARKS` text NOT NULL,
  `QRCODE` text NOT NULL,
  `FORMS` text NOT NULL,
  `TYPE` varchar(15) NOT NULL,
  `FEEDBACK` varchar(15) NOT NULL,
  `STATUS` varchar(15) NOT NULL,
  `DATEON` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_appointment`
--

INSERT INTO `tbl_appointment` (`ID`, `CONTROLCODE`, `LASTNAME`, `FIRSTNAME`, `MIDDLENAME`, `CONTACT`, `DEPARTMENT`, `EMAIL`, `ADDRESS`, `REMARKS`, `QRCODE`, `FORMS`, `TYPE`, `FEEDBACK`, `STATUS`, `DATEON`, `created_at`, `updated_at`, `department_id`) VALUES
(83, '2510151103531', 'Efsor', 'Jaen', 'M', '09669145096', 'CCIS', 'daraefsormaniable@gmail.com', 'Brgy. Hamorawon', 'seminar', 'qrcodes/2510151103531.png', 'uploads/clients/251015-110231-48493-3.7.1-asb-qf-01a-new-request-slip-irs-a4-rev05-03-20-2025.pdf', 'Online', 'RATED', 'ACCEPTED', '2025-10-15 11:03 am', '2025-10-17 02:55:11', NULL, NULL),
(84, '2510151111710', 'Efsor', 'Jaen', 'M', '09669145096', 'CCIS', 'daraefsormaniable@gmail.com', 'Brgy. Hamorawon', 'jdjsjjxdj', 'qrcodes/2510151111710.png', 'uploads/clients/251015-110231-48493-3.7.1-asb-qf-01a-new-request-slip-irs-a4-rev05-03-20-2025.pdf', 'Online', 'RATED', 'ACCEPTED', '2025-10-15 11:11 am', '2025-10-17 02:55:11', NULL, NULL),
(85, '2510151120941', 'Maniable', 'Dara Jaen', 'Efsor', '09669145096', 'CCIS', 'darajaenmaniable14@gmail.com', 'Brgy. Hamorawon Calbayog City', 'DSHGCHDS', 'qrcodes/2510151120941.png', 'uploads/clients/251015-105859-13025-3.7.1-asb-qf-01a-new-request-slip-irs-a4-rev05-03-20-2025.pdf', 'Walk-in', 'NOT RATED', 'ACCEPTED', '2025-10-15 11:20 am', '2025-10-17 02:55:11', NULL, NULL),
(86, '2510151226118', 'Duja', 'Dara', 'Maniable', '09669145096', 'CCIS', 'daraefsormaniable@gmail.com', 'Brgy. Hamorawon Calbayog City', 'Seminar', 'qrcodes/2510151226118.png', 'uploads/clients/251015-122545-49925-3.7.1-asb-qf-01a-new-request-slip-irs-a4-rev05-03-20-2025.pdf', 'Online', 'RATED', 'COMPLETED', '2025-10-15 12:26 pm', '2025-10-17 02:55:11', NULL, NULL),
(87, '2510151411327', 'Doinog', 'Angeline', 'Casaljay', '09817768088', 'CCIS', 'angelinedoinog2002@gmail.com', 'Brgy. Monbon Sta. Margarita', 'Seminar', 'qrcodes/2510151411327.png', 'uploads/clients/251015-140934-82503-3.7.1-asb-qf-01a-new-request-slip-irs-a4-rev05-03-20-2025.pdf', 'Online', 'RATED', 'COMPLETED', '2025-10-15 2:11 pm', '2025-10-17 02:55:11', NULL, NULL),
(88, '2510151418133', 'Maniable', 'Dara Jaen', 'Efsor', '09669450169', 'CCIS', 'darajaenmaniable14@gmail.com', 'Brgy. Hamorawon Calbayog City', 'fdghyfh', 'qrcodes/2510151418133.png', 'uploads/clients/251015-105859-13025-3.7.1-asb-qf-01a-new-request-slip-irs-a4-rev05-03-20-2025.pdf', 'Walk-in', 'NOT RATED', 'COMPLETED', '2025-10-15 2:18 pm', '2025-10-17 02:55:11', NULL, NULL),
(89, '2510151439217', 'Guion', 'Ymhea', 'Jalayajay', '09558718919', 'CCIS', 'justforfuninrpw@gmail.com', 'Brgy. Rawis Calbayog City', 'Oath', 'qrcodes/2510151439217.png', 'uploads/clients/251015-143524-68487-slip.pdf', 'Online', 'NOT RATED', 'COMPLETED', '2025-10-15 2:39 pm', '2025-10-17 02:55:11', NULL, NULL),
(90, '2510172241163', 'Valeria', 'Luna', 'M', '09856332603', 'CEA', 'denowe5487@foxroids.com', 'Burgos St Brgy. East Awang', 'Seminar', 'qrcodes/2510172241163.png', 'uploads/clients/251017-224025-47932-asbao report.pdf', 'Online', 'NOT RATED', 'ACCEPTED', '2025-10-17 10:41 pm', '2025-10-17 22:41:51', '2025-10-17 22:43:34', NULL),
(91, '2510182136632', 'Camero', 'Dara', 'Maniable', '09669145096', 'CCIS', 'daraefsormaniable@gmail.com', 'Brgy. Hamorawon Calbayog City', 'Seminar for SDGs.', 'qrcodes/2510182136632.png', 'uploads/clients/251015-122545-49925-asbao report.pdf', 'Online', 'NOT RATED', 'COMPLETED', '2025-10-18 9:36 pm', '2025-10-18 21:36:29', '2025-10-20 17:58:44', NULL),
(92, '2510201755101', 'Camero', 'Dara', 'Maniable', '09669145096', 'CCIS', 'daraefsormaniable@gmail.com', 'Brgy. Hamorawon Calbayog City', 'Oath Taking', 'qrcodes/2510201755101.png', 'uploads/clients/251015-122545-49925-3.7.1-asb-qf-01a-new-request-slip-irs-a4-rev05-03-20-2025.pdf', 'Online', 'NOT RATED', 'ACCEPTED', '2025-10-20 5:55 pm', '2025-10-20 17:55:37', '2025-10-20 17:56:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `CATEGORYCODE` varchar(30) NOT NULL,
  `CATEGORYVENUE` varchar(100) NOT NULL,
  `CATEGORYNAME` varchar(100) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `PHOTOS` text NOT NULL,
  `STATUS` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`CATEGORYCODE`, `CATEGORYVENUE`, `CATEGORYNAME`, `DESCRIPTION`, `PHOTOS`, `STATUS`) VALUES
('250610-161204-69475', 'SOCIO', 'SOCIO', 'Capacity:\r\n1,000 seats for large events (e.g., cultural shows, conferences)\r\n300 seats for workshops (with a more spacious setup)\r\nSuitable for: Large-scale events, performances, and interactive workshops', 'uploads/category/250610-161204-69475-494831976_4146973768957586_3715586113320259460_n (1).jpg', 'Active'),
('250610-161307-45070', 'OVAL', 'OVAL', '10000 seated', 'uploads/category/250610-161307-45070-teacher.png', 'Deactive'),
('250610-161356-64508', 'ADMIN BUILDING', 'ADMINS OFFICE', 'Administration Office Building', '', 'Deactive'),
('250610-161433-70529', 'BDC', 'BDC 1st Floor', '300 seated', 'uploads/category/250610-161433-70529-499548901_686060971023199_7417046173184238325_n (1).jpg', 'Deactive'),
('250610-161449-76434', 'BDC', 'BDC 2nd Floor', 'Capacity: Accommodates up to 200 seats\r\nSuitable for: Small seminars, meetings, and lectures', 'uploads/category/250610-161449-76434-499548901_686060971023199_7417046173184238325_n (1).jpg', 'Active'),
('250610-161506-73664', 'BDC', 'BDC 3rd Floor', 'Capacity: Accommodates up to 200 seats\r\nSuitable for: Small seminars, meetings, and lectures', 'uploads/category/250610-161506-73664-499548901_686060971023199_7417046173184238325_n (1).jpg', 'Active'),
('250610-161519-37367', 'BDC', 'BDC 4th Floor', 'Capacity: Accommodates up to 200 seats\r\nSuitable for: Small seminars, meetings, and lectures', 'uploads/category/250610-161519-37367-499548901_686060971023199_7417046173184238325_n (1).jpg', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clients`
--

CREATE TABLE `tbl_clients` (
  `ID` int(11) NOT NULL,
  `USERCODE` varchar(30) NOT NULL,
  `LASTNAME` varchar(60) NOT NULL,
  `FIRSTNAME` varchar(60) NOT NULL,
  `MIDDLENAME` varchar(60) NOT NULL,
  `CONTACT` varchar(11) NOT NULL,
  `EMAIL` varchar(60) NOT NULL,
  `ADDRESS` text NOT NULL,
  `PASSWORD` varchar(60) NOT NULL,
  `ROLE` varchar(30) NOT NULL,
  `PROFILE` text NOT NULL,
  `STATUS` varchar(15) NOT NULL,
  `DATEON` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `DEPARTMENTCODE` varchar(30) NOT NULL,
  `DEPARTMENTNAME` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(200) NOT NULL,
  `STATUS` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`DEPARTMENTCODE`, `DEPARTMENTNAME`, `DESCRIPTION`, `STATUS`) VALUES
('250902-102728-69936', 'CON', 'College of Nursing', 'Active'),
('250902-102751-87050', 'CEA', 'College of Engineering and Architecture', 'Active'),
('250902-104206-27819', 'COM', 'College of Management', 'Active'),
('251014-114258-55996', 'CCIS', 'College of Computer and Information Sciences', 'Active'),
('251014-114313-59828', 'CCJS', 'College of Criminal Justice and Sciences', 'Active'),
('251014-114338-33136', 'CAT', 'College of Agriculture and Technology', 'Active'),
('251014-114356-29527', 'COED', 'College of Education', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `ID` int(11) NOT NULL,
  `USERCODE` varchar(30) NOT NULL,
  `REMARKS` text NOT NULL,
  `DATEON` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`ID`, `USERCODE`, `REMARKS`, `DATEON`) VALUES
(1, '250622-064651-18553', 'Good services', '2025-09-02 5:12 pm'),
(2, '250622-064651-18553', 'Hello', '2025-09-02 5:14 pm'),
(3, '250622-064651-18553', 'Hi', '2025-09-02 5:14 pm'),
(4, '250622-064651-18553', 'Wow great!', '2025-09-02 5:15 pm'),
(5, '250622-064651-18553', 'Ho', '2025-09-02 5:15 pm'),
(6, '250622-064651-18553', 'sds asfs', '2025-09-22 10:04 pm'),
(7, '250622-064651-18553', 'sdfsd', '2025-09-23 8:04 am'),
(8, '250622-064651-18553', 'dgf', '2025-09-23 8:22 am'),
(9, '250622-064651-18553', 'sjfsj sdjfdjf', '2025-10-01 11:17 am');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_forms`
--

CREATE TABLE `tbl_forms` (
  `ID` int(11) NOT NULL,
  `FILENAME` varchar(150) NOT NULL,
  `FILEPATH` text NOT NULL,
  `STATUS` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_forms`
--

INSERT INTO `tbl_forms` (`ID`, `FILENAME`, `FILEPATH`, `STATUS`) VALUES
(1, 'Internal Request Slip', 'uploads/forms/3.7.1-asb-qf-01a-new-request-slip-irs-a4-rev05-03-20-2025.pdf', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_holiday`
--

CREATE TABLE `tbl_holiday` (
  `ID` int(10) NOT NULL,
  `HOLIDAYCODE` varchar(30) NOT NULL,
  `HOLIDAYDATE` date NOT NULL,
  `REMARKS` varchar(200) NOT NULL,
  `STATUS` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_holiday`
--

INSERT INTO `tbl_holiday` (`ID`, `HOLIDAYCODE`, `HOLIDAYDATE`, `REMARKS`, `STATUS`) VALUES
(1, '250826-163503-73268', '2025-09-28', 'Yamashita Surrender Day', 'Active'),
(2, '250826-163930-15974', '2025-09-30', 'Maulid un-Nabi', 'Active'),
(3, '250826-231915-75507', '2025-09-08', 'Feast of the Nativity of Mary', 'Active'),
(4, '250826-231953-77811', '2025-09-25', 'September Equinox', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `SCHEDULECODE` varchar(30) NOT NULL,
  `CHECKIN` varchar(15) NOT NULL,
  `CHECKOUT` varchar(15) NOT NULL,
  `REMARKS` varchar(200) NOT NULL,
  `STATUS` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`SCHEDULECODE`, `CHECKIN`, `CHECKOUT`, `REMARKS`, `STATUS`) VALUES
('250826-152716-75066', '07:00', '09:00', '2 Hours', 'Active'),
('250826-152826-94143', '09:00', '11:00', '2 Hours', 'Active'),
('250826-153750-10621', '13:00', '15:00', '2 Hours', 'Active'),
('251017-000830-41374', '15:00', '17:00', '2 Hours', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `ID` int(11) NOT NULL,
  `USERCODE` varchar(30) NOT NULL,
  `FIRSTNAME` varchar(60) NOT NULL,
  `MIDDLENAME` varchar(60) NOT NULL,
  `LASTNAME` varchar(60) NOT NULL,
  `GENDER` varchar(6) NOT NULL,
  `CONTACT` varchar(11) NOT NULL,
  `ADDRESS` text NOT NULL,
  `DEPARTMENT` varchar(200) NOT NULL,
  `EMAIL` varchar(60) NOT NULL,
  `PASSWORD` varchar(60) NOT NULL,
  `ROLE` varchar(30) NOT NULL,
  `PROFILE` text NOT NULL,
  `STATUS` varchar(15) NOT NULL,
  `DATEON` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`ID`, `USERCODE`, `FIRSTNAME`, `MIDDLENAME`, `LASTNAME`, `GENDER`, `CONTACT`, `ADDRESS`, `DEPARTMENT`, `EMAIL`, `PASSWORD`, `ROLE`, `PROFILE`, `STATUS`, `DATEON`) VALUES
(30, '251015-105859-13025', 'Dara', 'Efsor', 'Maniable', 'Female', '09669450169', 'Brgy. Hamorawon Calbayog City', 'CCIS', 'darajaenmaniable14@gmail.com', '50fa4f1afaa1ca5a224686c5da2d231d', 'Admin', 'No Image', 'Active', '1760497139'),
(32, '251015-122545-49925', 'Dara', 'Maniable', 'Camero', 'Female', '09669145096', 'Brgy. Hamorawon Calbayog City', 'CCIS', 'daraefsormaniable@gmail.com', '4deadd2b5c1adeb99765177dab2c9001', 'Client', 'No Image', 'Active', '1760502345'),
(33, '251015-140934-82503', 'Angeline', 'Casaljay', 'Doinog', 'Female', '09817768088', 'Brgy. Monbon Sta. Margarita', 'CCIS', 'angelinedoinog2002@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Client', 'No Image', 'Active', '1760508574'),
(34, '251015-143339-34725', 'Ymhea Gwenn', 'Jalayajay', 'Jaballa', 'Female', '09856332603', 'Burgos St Brgy. East Awang', 'CCIS', 'earnifydigitals@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Client', 'No Image', 'Active', '1760510019'),
(35, '251015-143524-68487', 'Ymhea', 'Jalayajay', 'Guion', 'Female', '09558718919', 'Brgy. Rawis Calbayog City', 'CCIS', 'justforfuninrpw@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Client', 'No Image', 'Active', '1760510124'),
(36, '251017-151931-88587', 'Arkin', 'S', 'Sanchez', 'Male', '09669450169', 'Brgy. Hamorawon', 'CEA', 'comeb48666@foxroids.com', 'e03fa839212850ef81d52ee81dd1d7b5', 'Client', 'No Image', 'Active', '1760685571'),
(37, '251017-224025-47932', 'Luna', 'M', 'Valeria', 'Female', '09856332603', 'Burgos St Brgy. East Awang', 'CEA', 'denowe5487@foxroids.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Client', 'No Image', 'Active', '1760712025');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_venuelists`
--

CREATE TABLE `tbl_venuelists` (
  `VENUEID` int(10) NOT NULL,
  `USERCODE` varchar(30) NOT NULL,
  `CONTROLCODE` varchar(30) NOT NULL,
  `CATEGORYCODE` varchar(30) NOT NULL,
  `SCHEDULECODE` varchar(30) NOT NULL,
  `CATEGORYNAME` varchar(100) NOT NULL,
  `CATEGORYDESCRIPTION` text NOT NULL,
  `VENUEDATE` date NOT NULL,
  `VENUETIME` varchar(15) NOT NULL,
  `AVAILABILITY` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_venuelists`
--

INSERT INTO `tbl_venuelists` (`VENUEID`, `USERCODE`, `CONTROLCODE`, `CATEGORYCODE`, `SCHEDULECODE`, `CATEGORYNAME`, `CATEGORYDESCRIPTION`, `VENUEDATE`, `VENUETIME`, `AVAILABILITY`) VALUES
(149, '250622-064651-18553', '2509021423534', '250610-161449-76434', '250826-152904-18427', 'BDC 2nd Floor', '200 seated', '2025-09-23', '11:00 - 12:00', 1),
(150, '250622-064651-18553', '2509021503897', '250610-161506-73664', '250826-152904-18427', 'BDC 3rd Floor', '200 seated', '2025-09-06', '11:00', 1),
(151, '230821-194222-52501', '2509021624245', '250610-161204-69475', '250826-153750-10621', 'SOCIO', 'RSU Socio - Cultural Center\r\n1000 seated worshop', '2025-09-04', '13:00', 1),
(152, '230821-194222-52501', '2509031347690', '250610-161433-70529', '250826-152904-18427', 'BDC 1st Floor', '300 seated', '2025-09-12', '11:00', 1),
(168, '250622-064651-18553', '2509222112837', '250610-161449-76434', '250826-152826-94143', 'BDC 2nd Floor', '200 seated', '2025-09-23', '09:00 - 11:00', 1),
(173, '230821-194222-52501', '2509222145161', '250610-161449-76434', '250826-153750-10621', 'BDC 2nd Floor', '200 seated', '2025-09-23', '13:00 - 15:00', 1),
(186, '250622-064651-18553', '2509230014263', '250610-161449-76434', '250826-152716-75066', 'BDC 2nd Floor', '200 seated', '2025-09-23', '07:00 - 09:00', 1),
(187, '250622-064651-18553', '2509230821304', '250610-161449-76434', '250826-153847-10472', 'BDC 2nd Floor', '200 seated', '2025-09-23', '15:00 - 17:00', 1),
(189, '230821-194222-52501', '2510011100525', '250610-161433-70529', '250826-152904-18427', 'BDC 1st Floor', '300 seated', '2025-10-01', '11:00 - 12:00', 1),
(190, '230821-194222-52501', '2510011100525', '250610-161433-70529', '250826-153750-10621', 'BDC 1st Floor', '300 seated', '2025-10-01', '13:00 - 15:00', 1),
(191, '250622-064651-18553', '2510011106680', '250610-161433-70529', '250826-153847-10472', 'BDC 1st Floor', '300 seated', '2025-10-01', '15:00 - 17:00', 1),
(192, '250622-064651-18553', '', '250610-161356-64508', '250826-152716-75066', 'ADMINS OFFICE', 'Administration Office Building', '2025-10-01', '07:00 - 09:00', 0),
(193, '230821-194222-52501', '2510131654745', '250610-161433-70529', '250826-152716-75066', 'BDC 1st Floor', '300 seated', '2025-10-14', '07:00 - 09:00', 1),
(194, '230821-194222-52501', '2510131654745', '250610-161433-70529', '250826-152826-94143', 'BDC 1st Floor', '300 seated', '2025-10-14', '09:00 - 11:00', 1),
(195, '230821-194222-52501', '2510131654745', '250610-161433-70529', '250826-152904-18427', 'BDC 1st Floor', '300 seated', '2025-10-14', '11:00 - 12:00', 1),
(196, '230821-194222-52501', '2510131654745', '250610-161433-70529', '250826-153750-10621', 'BDC 1st Floor', '300 seated', '2025-10-14', '13:00 - 15:00', 1),
(197, '230821-194222-52501', '2510131654745', '250610-161433-70529', '250826-153847-10472', 'BDC 1st Floor', '300 seated', '2025-10-14', '15:00 - 17:00', 1),
(198, '250622-061858-69720', '2510131702455', '250610-161433-70529', '250826-152716-75066', 'BDC 1st Floor', '300 seated', '2025-10-15', '07:00 - 09:00', 1),
(200, '250622-061858-69720', '2510132138352', '250610-161433-70529', '250826-152826-94143', 'BDC 1st Floor', '300 seated', '2025-10-15', '09:00 - 11:00', 1),
(201, '250622-061858-69720', '2510132224254', '250610-161433-70529', '250826-152904-18427', 'BDC 1st Floor', '300 seated', '2025-10-15', '11:00 - 12:00', 1),
(202, '251014-120051-16367', '2510141218694', '250610-161356-64508', '250826-152716-75066', 'ADMINS OFFICE', 'Administration Office Building', '2025-10-15', '07:00 - 09:00', 1),
(204, '251014-114028-44501', '2510141510943', '250610-161449-76434', '250826-152826-94143', 'BDC 2nd Floor', '200 seated', '2025-10-15', '09:00 AM - 11:0', 1),
(205, '251014-114028-44501', '2510141510943', '250610-161449-76434', '250826-152904-18427', 'BDC 2nd Floor', '200 seated', '2025-10-15', '11:00 AM - 12:0', 1),
(206, '251014-114028-44501', '2510141510943', '250610-161449-76434', '250826-153750-10621', 'BDC 2nd Floor', '200 seated', '2025-10-15', '01:00 PM - 03:0', 1),
(207, '251014-114028-44501', '2510141510943', '250610-161449-76434', '250826-153847-10472', 'BDC 2nd Floor', '200 seated', '2025-10-15', '03:00 PM - 05:0', 1),
(208, '251014-114028-44501', '2510142102928', '250610-161519-37367', '250826-152826-94143', 'BDC 4th Floor', '200 seated', '2025-10-16', '9:00am - 11:00a', 1),
(209, '251014-114028-44501', '2510142102928', '250610-161519-37367', '250826-152826-94143', 'BDC 4th Floor', '200 seated', '2025-10-16', '9:00am - 11:00a', 1),
(210, '251014-114028-44501', '2510142102928', '250610-161519-37367', '251014-162448-75766', 'BDC 4th Floor', '200 seated', '2025-10-16', '10:30am - 12:30', 1),
(211, '251014-114028-44501', '2510142158800', '250610-161519-37367', '250826-152716-75066', 'BDC 4th Floor', '200 seated', '2025-10-17', '07:00 - 09:00', 1),
(212, '251014-152911-89637', '2510142159443', '250610-161356-64508', '250826-153750-10621', 'ADMINS OFFICE', 'Administration Office Building', '2025-10-24', '13:00 - 15:00', 1),
(213, '251014-114028-44501', '2510150003389', '250610-161204-69475', '251014-162448-75766', 'SOCIO', 'RSU Socio - Cultural Center\r\n1000 seated worshop', '2025-10-17', '10:30 - 12:30', 1),
(214, '251014-114028-44501', '2510150003389', '250610-161519-37367', '251014-162448-75766', 'BDC 4th Floor', '200 seated', '2025-10-25', '10:30 - 12:30', 1),
(215, '251014-152911-89637', '2510142225372', '250610-161433-70529', '251014-162448-75766', 'BDC 1st Floor', '300 seated', '2025-10-22', '10:30 - 12:30', 1),
(216, '251014-114028-44501', '', '250610-161519-37367', '251014-162448-75766', 'BDC 4th Floor', '200 seated', '2025-10-18', '10:30 - 12:30', 0),
(217, '251014-114028-44501', '', '250610-161506-73664', '251014-162448-75766', 'BDC 3rd Floor', '200 seated', '2025-10-23', '10:30 - 12:30', 0),
(218, '251014-114028-44501', '', '250610-161506-73664', '250826-153847-10472', 'BDC 3rd Floor', '200 seated', '2025-10-23', '15:00 - 17:00', 0),
(219, '251014-152911-89637', '2510151010886', '250610-161433-70529', '251014-162448-75766', 'BDC 1st Floor', '300 seated', '2025-10-17', '10:30 - 12:30', 1),
(220, '251015-101846-51818', '2510151033640', '250610-161519-37367', '250826-153847-10472', 'BDC 4th Floor', '200 seated', '2025-10-17', '15:00 - 17:00', 1),
(221, '251015-110231-48493', '2510151103531', '250610-161519-37367', '250826-152826-94143', 'BDC 4th Floor', '200 seated', '2025-10-17', '09:00 - 11:00', 1),
(222, '251015-110231-48493', '2510151111710', '250610-161506-73664', '250826-152904-18427', 'BDC 3rd Floor', '200 seated', '2025-10-25', '11:00 - 12:00', 1),
(223, '251015-105859-13025', '2510151120941', '250610-161519-37367', '250826-152904-18427', 'BDC 4th Floor', '200 seated', '2025-10-17', '11:00 - 12:00', 1),
(224, '251015-122545-49925', '2510151226118', '250610-161449-76434', '250826-152716-75066', 'BDC 2nd Floor', '200 seated', '2025-10-25', '07:00 - 09:00', 1),
(225, '251015-122545-49925', '2510151226118', '250610-161449-76434', '250826-152826-94143', 'BDC 2nd Floor', '200 seated', '2025-10-25', '09:00 - 11:00', 1),
(226, '251015-122545-49925', '2510151226118', '250610-161449-76434', '250826-152904-18427', 'BDC 2nd Floor', '200 seated', '2025-10-25', '11:00 - 12:00', 1),
(227, '251015-140934-82503', '2510151411327', '250610-161449-76434', '250826-152716-75066', 'BDC 2nd Floor', '200 seated', '2025-10-16', '07:00 - 09:00', 1),
(228, '251015-140934-82503', '2510151411327', '250610-161449-76434', '250826-152826-94143', 'BDC 2nd Floor', '200 seated', '2025-10-16', '09:00 - 11:00', 1),
(229, '251015-140934-82503', '2510151411327', '250610-161449-76434', '250826-152904-18427', 'BDC 2nd Floor', '200 seated', '2025-10-16', '11:00 - 12:00', 1),
(230, '251015-105859-13025', '2510151418133', '250610-161204-69475', '250826-152716-75066', 'SOCIO', 'RSU Socio - Cultural Center\r\n1000 seated worshop', '2025-10-23', '07:00 - 09:00', 1),
(231, '251015-143524-68487', '2510151439217', '250610-161449-76434', '250826-153750-10621', 'BDC 2nd Floor', '200 seated', '2025-10-16', '13:00 - 15:00', 1),
(232, '251015-143524-68487', '2510151439217', '250610-161449-76434', '250826-153847-10472', 'BDC 2nd Floor', '200 seated', '2025-10-16', '15:00 - 17:00', 1),
(233, '251015-105859-13025', '', '250610-161506-73664', '251014-162448-75766', 'BDC 3rd Floor', '200 seated', '2025-10-17', '10:30 - 12:30', 0),
(234, '251015-105859-13025', '', '250610-161519-37367', '250826-153750-10621', 'BDC 4th Floor', '200 seated', '2025-10-17', '13:00 - 15:00', 0),
(237, '251015-122545-49925', '2510182136632', '250610-161506-73664', '250826-152826-94143', 'BDC 3rd Floor', '200 seated', '2025-10-18', '9:00 AM - 11:00', 1),
(238, '251015-122545-49925', '2510182136632', '250610-161506-73664', '250826-153847-10472', 'BDC 3rd Floor', '200 seated', '2025-10-17', '3:00 PM - 5:00 ', 1),
(239, '251015-122545-49925', '2510182136632', '250610-161519-37367', '250826-153847-10472', 'BDC 4th Floor', '200 seated', '2025-10-18', '3:00 PM - 5:00 ', 1),
(240, '251015-122545-49925', '2510182136632', '250610-161519-37367', '251014-162448-75766', 'BDC 4th Floor', '200 seated', '2025-10-17', '10:30 AM - 12:3', 1),
(242, '251015-122545-49925', '2510182136632', '250610-161449-76434', '250826-152716-75066', 'BDC 2nd Floor', '200 seated', '2025-10-30', '7:00 AM - 9:00 ', 1),
(243, '251015-122545-49925', '2510182136632', '250610-161449-76434', '250826-153750-10621', 'BDC 2nd Floor', '200 seated', '2025-10-30', '1:00 PM - 3:00 ', 1),
(244, '251015-105859-13025', '', '250610-161449-76434', '250826-152716-75066', 'BDC 2nd Floor', '200 seated', '2025-10-29', '7:00 AM - 9:00 ', 0),
(245, '251015-105859-13025', '', '250610-161506-73664', '250826-153750-10621', 'BDC 3rd Floor', '200 seated', '2025-10-17', '1:00 PM - 3:00 ', 0),
(246, '251015-122545-49925', '2510182136632', '250610-161449-76434', '250826-152716-75066', 'BDC 2nd Floor', '200 seated', '2025-10-24', '7:00 AM - 9:00 ', 1),
(247, '251015-122545-49925', '2510182136632', '250610-161449-76434', '251017-000830-41374', 'BDC 2nd Floor', '200 seated', '2025-10-30', '3:00 PM - 5:00 ', 1),
(248, '251017-224025-47932', '2510172241163', '250610-161506-73664', '251017-000830-41374', 'BDC 3rd Floor', '200 seated', '2025-10-30', '3:00 PM - 5:00 ', 1),
(249, '251015-122545-49925', '2510182136632', '250610-161449-76434', '250826-152716-75066', 'BDC 2nd Floor', 'Capacity: Accommodates up to 200 seats\r\nSuitable for: Small seminars, meetings, and lectures', '2025-10-22', '7:00 AM - 9:00 ', 1),
(250, '251015-122545-49925', '2510182136632', '250610-161449-76434', '250826-152716-75066', 'BDC 2nd Floor', 'Capacity: Accommodates up to 200 seats\r\nSuitable for: Small seminars, meetings, and lectures', '2025-10-31', '7:00 AM - 9:00 ', 1),
(251, '251015-122545-49925', '2510201755101', '250610-161449-76434', '250826-152826-94143', 'BDC 2nd Floor', 'Capacity: Accommodates up to 200 seats\r\nSuitable for: Small seminars, meetings, and lectures', '2025-10-31', '9:00 AM - 11:00', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_live_appointment_report`
-- (See below for the actual view)
--
CREATE TABLE `v_live_appointment_report` (
`controlcode` varchar(30)
,`reservation_date` date
,`last_name` varchar(60)
,`first_name` varchar(60)
,`contact` varchar(11)
,`email` varchar(60)
,`address` text
,`department` varchar(100)
,`venue` varchar(100)
,`time_display` varchar(15)
,`activity_date` date
,`purpose` text
,`status` varchar(15)
,`feedback_rating` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `v_live_appointment_report`
--
DROP TABLE IF EXISTS `v_live_appointment_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_live_appointment_report`  AS SELECT `a`.`CONTROLCODE` AS `controlcode`, cast(`a`.`DATEON` as date) AS `reservation_date`, `a`.`LASTNAME` AS `last_name`, `a`.`FIRSTNAME` AS `first_name`, `a`.`CONTACT` AS `contact`, `a`.`EMAIL` AS `email`, `a`.`ADDRESS` AS `address`, `a`.`DEPARTMENT` AS `department`, `v`.`CATEGORYNAME` AS `venue`, `v`.`VENUETIME` AS `time_display`, cast(`v`.`VENUEDATE` as date) AS `activity_date`, `a`.`REMARKS` AS `purpose`, `a`.`STATUS` AS `status`, (select `qf`.`rating` from `question_feedback` `qf` where `qf`.`appointid` = `a`.`CONTROLCODE` order by `qf`.`id` desc limit 1) AS `feedback_rating` FROM (`tbl_appointment` `a` join `tbl_venuelists` `v` on(`a`.`CONTROLCODE` = `v`.`CONTROLCODE`)) GROUP BY `a`.`CONTROLCODE` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_feedback`
--
ALTER TABLE `question_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_entries`
--
ALTER TABLE `report_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_run` (`run_id`),
  ADD KEY `idx_controlcode` (`controlcode`);

--
-- Indexes for table `report_runs`
--
ALTER TABLE `report_runs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_period` (`start_date`,`end_date`),
  ADD KEY `idx_department` (`department`);

--
-- Indexes for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idx_appointment_dateon` (`DATEON`(768)),
  ADD KEY `idx_appointment_department` (`DEPARTMENT`),
  ADD KEY `idx_appointment_control` (`CONTROLCODE`),
  ADD KEY `idx_department_id` (`department_id`);

--
-- Indexes for table `tbl_clients`
--
ALTER TABLE `tbl_clients`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD KEY `idx_department_name` (`DEPARTMENTNAME`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_forms`
--
ALTER TABLE `tbl_forms`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_holiday`
--
ALTER TABLE `tbl_holiday`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_venuelists`
--
ALTER TABLE `tbl_venuelists`
  ADD PRIMARY KEY (`VENUEID`),
  ADD KEY `idx_venue_control` (`CONTROLCODE`),
  ADD KEY `idx_venue_date` (`VENUEDATE`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `question_feedback`
--
ALTER TABLE `question_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `report_entries`
--
ALTER TABLE `report_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `report_runs`
--
ALTER TABLE `report_runs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `tbl_clients`
--
ALTER TABLE `tbl_clients`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_forms`
--
ALTER TABLE `tbl_forms`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_holiday`
--
ALTER TABLE `tbl_holiday`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_venuelists`
--
ALTER TABLE `tbl_venuelists`
  MODIFY `VENUEID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `report_entries`
--
ALTER TABLE `report_entries`
  ADD CONSTRAINT `fk_report_entries_run` FOREIGN KEY (`run_id`) REFERENCES `report_runs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
