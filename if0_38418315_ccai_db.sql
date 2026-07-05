-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql105.infinityfree.com
-- Generation Time: Jun 21, 2025 at 04:25 AM
-- Server version: 10.6.21-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_38418315_ccai_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `reset_token` varchar(64) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `security_question` varchar(255) NOT NULL,
  `security_answer` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `created_at`, `email`, `reset_token`, `reset_expires`, `security_question`, `security_answer`) VALUES
(12, 'adminto', '$2y$10$A8YhHJQgjh8KFY3c1BJqIeHvdl8yUeYpkhpbtefpnDTXavwHVm15a', '2025-05-05 05:37:35', '', NULL, NULL, 'What was your first pet\'s name?', '$2y$10$Q45jLcGpckYLOU.HUd7zaOwrzx7L0iCR3rATT6SF9AdsF90Hze8oS');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `image` varbinary(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start_date`, `end_date`, `color`, `image`, `created_at`) VALUES
(36, 'saaas', '2025-05-30', '2025-05-31', '#3788d8', 0x75706c6f6164732f6576656e74732f6576656e745f36383331366238643032383136312e39303130363838372e4a5047, '2025-05-24 06:47:41'),
(35, 'sasa', '2025-05-07', '2025-05-08', '#3788d8', 0x75706c6f6164732f6576656e74732f6576656e745f36383331363766643536363761342e35343235323738372e6a7067, '2025-05-24 06:32:29'),
(37, 'oh', '2025-05-29', '2025-05-30', '#3788d8', 0x75706c6f6164732f6576656e74732f6576656e745f36383331373063613930346336372e34363635373733332e4a5047, '2025-05-24 07:10:02');

-- --------------------------------------------------------

--
-- Table structure for table `news_posts`
--

CREATE TABLE `news_posts` (
  `id` int(11) NOT NULL,
  `title` longblob NOT NULL,
  `description` longblob NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_organizations`
--

CREATE TABLE `student_organizations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ;

--
-- Dumping data for table `student_organizations`
--

INSERT INTO `student_organizations` (`id`, `name`, `description`, `category_tags`, `member_count`, `members_data`, `image_path`, `created_at`, `updated_at`, `status`) VALUES
(30, 'MATHEMATICS', 'DI AKO MAGALING', '[\"EWAN\"]', 2, '[{\"name\":\"SIMON PATAG\",\"position\":\"LEADER\",\"level\":\"12\"},{\"name\":\"KENNETH NAVARRO\",\"position\":\"MEMBER\",\"level\":\"12\"}]', 'org_images1/1747876695_MTk0NDkyNDU0MjY1NjkzODcz.png', '2025-05-22 01:18:15', '2025-05-22 01:18:15', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `student_population`
--

CREATE TABLE `student_population` (
  `id` int(11) NOT NULL,
  `level` enum('JHS','SHS') NOT NULL,
  `grade_level` varchar(50) NOT NULL,
  `strand` varchar(50) DEFAULT NULL,
  `section` varchar(50) NOT NULL,
  `male_count` int(11) DEFAULT 0,
  `female_count` int(11) DEFAULT 0,
  `total_count` int(11) GENERATED ALWAYS AS (`male_count` + `female_count`) STORED,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `school_year` varchar(9) NOT NULL DEFAULT '2023-2024'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student_population`
--

INSERT INTO `student_population` (`id`, `level`, `grade_level`, `strand`, `section`, `male_count`, `female_count`, `created_at`, `updated_at`, `school_year`) VALUES
(11, 'JHS', 'Grade 7', NULL, 'A', 12, 12, '2025-04-02 03:36:08', '2025-04-02 03:36:08', '2025-2026');

-- --------------------------------------------------------

--
-- Table structure for table `superadmin_users`
--

CREATE TABLE `superadmin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `reset_token` varchar(64) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `security_question` varchar(255) NOT NULL,
  `security_answer` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `superadmin_users`
--

INSERT INTO `superadmin_users` (`id`, `username`, `password`, `created_at`, `email`, `reset_token`, `reset_expires`, `security_question`, `security_answer`) VALUES
(23, 'adminto', '$2y$10$sPA/oqk7IVpzTxL1Ao1tSOvQkyCHiICgUGu79g6kD9lH92xU0AV/S', '2025-05-07 07:50:46', '', NULL, NULL, 'What is your birth date?', '$2y$10$4QzaZtqxaTPB1V2djZA2HeQgZyLhp2Q/zWcF5pruzxU7BFKH31E6W'),
(29, 'teacher', '$2y$10$i9tTmd..rnqp1FsC8ayA0.3s8k1p.JmyqtJrBTBwMGw9cs0K.MYiK', '2025-05-22 01:04:05', '', NULL, NULL, 'What is your favorite color?', '$2y$10$rCfSwXUVIuT.1lh8V7t0c.kutl306RtuW/UGhHv96ECTXYaxOWMem');

-- --------------------------------------------------------

--
-- Table structure for table `user_users`
--

CREATE TABLE `user_users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_users`
--

INSERT INTO `user_users` (`id`, `username`, `password`) VALUES
(2, 'adminto', '$2y$10$8mU/Hb50eZgcg/R496MFre1SyCj1y/GD.WdS9GUtkpHSiT/DzkbOG');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `thumbnail` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitor_stats`
--

CREATE TABLE `visitor_stats` (
  `id` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `visitor_count` int(11) DEFAULT 0,
  `page_views` int(11) DEFAULT 0,
  `avg_duration` int(11) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `visitor_stats`
--

INSERT INTO `visitor_stats` (`id`, `visit_date`, `visitor_count`, `page_views`, `avg_duration`) VALUES
(1, '2025-04-21', 11, 0, 0),
(2, '2025-04-22', 18, 0, 0),
(3, '2025-04-23', 229, 0, 0),
(4, '2025-04-24', 14, 0, 0),
(5, '2025-04-25', 2, 0, 0),
(6, '2025-04-26', 5, 0, 0),
(7, '2025-04-27', 15, 0, 0),
(8, '2025-04-29', 12, 0, 0),
(9, '2025-04-30', 10, 0, 0),
(10, '2025-05-01', 4, 0, 0),
(11, '2025-05-02', 4, 0, 0),
(12, '2025-05-04', 1, 0, 0),
(13, '2025-05-05', 34, 0, 0),
(14, '2025-05-06', 1, 0, 0),
(15, '2025-05-07', 16, 0, 0),
(16, '2025-05-08', 1, 0, 0),
(17, '2025-05-09', 6, 0, 0),
(18, '2025-05-10', 3, 0, 0),
(19, '2025-05-12', 1, 0, 0),
(20, '2025-05-13', 2, 0, 0),
(21, '2025-05-14', 1, 0, 0),
(22, '2025-05-16', 3, 0, 0),
(23, '2025-05-20', 6, 0, 0),
(24, '2025-05-21', 19, 0, 0),
(25, '2025-05-23', 1, 0, 0),
(26, '2025-05-24', 4, 0, 0),
(27, '2025-05-25', 4, 0, 0),
(28, '2025-06-01', 1, 0, 0),
(29, '2025-06-02', 1, 0, 0),
(30, '2025-06-09', 8, 0, 0),
(31, '2025-06-12', 1, 0, 0),
(32, '2025-06-16', 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_posts`
--
ALTER TABLE `news_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_population`
--
ALTER TABLE `student_population`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_population_year` (`school_year`),
  ADD KEY `idx_population_level_year` (`level`,`school_year`),
  ADD KEY `idx_population_grade_year` (`grade_level`,`school_year`);

--
-- Indexes for table `superadmin_users`
--
ALTER TABLE `superadmin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_users`
--
ALTER TABLE `user_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor_stats`
--
ALTER TABLE `visitor_stats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_date` (`visit_date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `news_posts`
--
ALTER TABLE `news_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `student_organizations`
--
ALTER TABLE `student_organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_population`
--
ALTER TABLE `student_population`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `superadmin_users`
--
ALTER TABLE `superadmin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_users`
--
ALTER TABLE `user_users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `visitor_stats`
--
ALTER TABLE `visitor_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
