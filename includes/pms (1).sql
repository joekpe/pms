-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2018 at 07:39 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `deleted` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academic_years`
--

INSERT INTO `academic_years` (`id`, `academic_year`, `start_date`, `end_date`, `deleted`) VALUES
(1, '2018/2019', '2018-05-02', '2018-05-03', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `chapter_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `deadline` date NOT NULL,
  `close_date` date NOT NULL,
  `deleted` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`chapter_id`, `name`, `deadline`, `close_date`, `deleted`) VALUES
(1, 'Chapter 1', '2018-05-04', '2018-05-05', 'no'),
(2, 'Chapter 2', '2018-05-06', '2018-05-07', 'no'),
(3, 'Chapter 3', '2018-05-08', '2018-05-09', 'no'),
(4, 'Chapter 4', '2018-05-10', '2018-05-11', 'no'),
(5, 'Chapter 5', '2018-05-12', '2018-05-13', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `doc_id` varchar(255) NOT NULL,
  `chapter_id` varchar(255) NOT NULL,
  `supervisor_id` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `date_posted` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `doc_id`, `chapter_id`, `supervisor_id`, `comment`, `date_posted`, `status`) VALUES
(1, '1', '', '2', 'Good Job', '2018-05-04', 1),
(2, '2', '', '2', 'Work on the intro', '2018-05-04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `docs`
--

CREATE TABLE `docs` (
  `doc_id` int(11) NOT NULL,
  `chapter_id` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `date_uploaded` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `docs`
--

INSERT INTO `docs` (`doc_id`, `chapter_id`, `student_id`, `file`, `date_uploaded`, `status`) VALUES
(1, '1', 'STD1', '5aec4d303153f-Fish4jobs_Web_Developer_template.docx', '2018-05-04', 'success'),
(2, '2', 'STD1', '5aec2785787d1-jhs 3 science.docx', '2018-05-04', 'warning');

-- --------------------------------------------------------

--
-- Table structure for table `open_days`
--

CREATE TABLE `open_days` (
  `id` int(11) NOT NULL,
  `inspector` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `date_inspected` date NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `open_days`
--

INSERT INTO `open_days` (`id`, `inspector`, `phone`, `student_id`, `date_inspected`, `comment`) VALUES
(1, 'Fred Amoako', '0202415292', 'STD1', '2018-05-04', '<p>Some Comments</p>');

-- --------------------------------------------------------

--
-- Table structure for table `pairings`
--

CREATE TABLE `pairings` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `supervisor_id` varchar(255) NOT NULL,
  `synopsis_id` varchar(255) NOT NULL,
  `academic_year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pairings`
--

INSERT INTO `pairings` (`id`, `student_id`, `supervisor_id`, `synopsis_id`, `academic_year`) VALUES
(1, 'STD1', '2', '1', '1'),
(2, 'STD2', '2', '2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `synopsis`
--

CREATE TABLE `synopsis` (
  `id` int(11) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `academic_year` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `date_uploaded` date NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'warning'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `synopsis`
--

INSERT INTO `synopsis` (`id`, `student_id`, `academic_year`, `file`, `topic`, `date_uploaded`, `status`) VALUES
(1, 'STD1', 1, '5aeb164b7b11a-synopsis.docx', 'Project Management System Update', '2018-05-03', 'success'),
(2, 'STD2', 1, '5aeb24b4241d7-kidney.doc', 'Health Project', '2018-05-03', 'success');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access_level` int(11) NOT NULL,
  `DOR` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `student_id`, `full_name`, `email`, `phone`, `password`, `access_level`, `DOR`, `deleted`) VALUES
(1, '', 'Head Of Department', 'hod@gmail.com', '0123456789', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0, '2018-05-02 18:28:31', 'no'),
(2, '', 'Lecturer 1', 'l1@gmail.com', '0321456987', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 1, '2018-05-02 18:54:19', 'no'),
(3, 'STD1', 'Student1', 'std1@gmail.com', '0202415292', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 2, '2018-05-02 18:55:00', 'no'),
(4, 'STD2', 'Student 2', 'std2@gmail.com', '0231456987', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 2, '2018-05-02 20:53:45', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`chapter_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `docs`
--
ALTER TABLE `docs`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `open_days`
--
ALTER TABLE `open_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pairings`
--
ALTER TABLE `pairings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `synopsis`
--
ALTER TABLE `synopsis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `unqEmail` (`email`),
  ADD UNIQUE KEY `unqPhone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_years`
--
ALTER TABLE `academic_years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `chapter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `docs`
--
ALTER TABLE `docs`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `open_days`
--
ALTER TABLE `open_days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pairings`
--
ALTER TABLE `pairings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `synopsis`
--
ALTER TABLE `synopsis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
