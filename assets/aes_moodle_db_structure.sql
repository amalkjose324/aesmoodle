-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2018 at 02:03 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aes_moodle_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `moodle_participation`
--

CREATE TABLE `moodle_participation` (
  `participation_id` int(11) NOT NULL,
  `participation_user_id` int(11) NOT NULL,
  `participation_question_id` int(11) NOT NULL,
  `participation_choice_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `moodle_questions`
--

CREATE TABLE `moodle_questions` (
  `question_id` int(11) NOT NULL,
  `question_quiz_id` int(11) NOT NULL,
  `question_title` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_option_1` int(11) NOT NULL,
  `question_option_2` int(11) NOT NULL,
  `question_option_3` int(11) NOT NULL,
  `question_option_4` int(11) NOT NULL,
  `question_option_correct` int(11) NOT NULL,
  `question_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1: Active, 0: In-Active',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `moodle_quizzes`
--

CREATE TABLE `moodle_quizzes` (
  `quiz_id` int(11) NOT NULL,
  `quiz_title` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quiz_department_id` tinyint(4) NOT NULL,
  `quiz_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1: Active, 0: In-Active',
  `quiz_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quiz_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `moodle_users`
--

CREATE TABLE `moodle_users` (
  `user_id` int(11) NOT NULL,
  `user_registration_no` int(11) NOT NULL,
  `user_department_id` tinyint(4) NOT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1: Users, 0: Admin',
  `user_score` int(11) NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `moodle_participation`
--
ALTER TABLE `moodle_participation`
  ADD PRIMARY KEY (`participation_id`);

--
-- Indexes for table `moodle_questions`
--
ALTER TABLE `moodle_questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `moodle_quizzes`
--
ALTER TABLE `moodle_quizzes`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `moodle_users`
--
ALTER TABLE `moodle_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `moodle_participation`
--
ALTER TABLE `moodle_participation`
  MODIFY `participation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `moodle_questions`
--
ALTER TABLE `moodle_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `moodle_quizzes`
--
ALTER TABLE `moodle_quizzes`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `moodle_users`
--
ALTER TABLE `moodle_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
