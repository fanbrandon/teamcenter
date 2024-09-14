-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 01:50 AM
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
-- Database: `login_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_location` varchar(255) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `event_description` text DEFAULT NULL,
  `event_task` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_location`, `event_date`, `event_description`, `event_task`) VALUES
(1, 'Fall 2023 Job & Internship Fair', 'University Union Ballroom, 6000 J St, Sacramento, California 95819, United States', '2023-10-03', '\r\nStudents and alumni, find jobs or internships! Open to all majors, all class levels, graduates and undergrads, recent grads and alumni, this event is an opportunity to meet with employers to learn about full-time jobs, part-time jobs and internship opportunities. \r\n\r\nTwo days to meet 100+ employers!  Register to see the list of employers from corporate, government, and nonprofit sectors recruiting for a variety of positions across industries and occupations.', 'Set up booths, clean up booths'),
(2, 'HERE TO CAREER: How to Negotiate a Salary', 'Cottonwood Suite, 2nd Floor\r\nUniversity Union, 6000 J Street, Sacramento, California 95819, United States of America', '2023-10-29', 'You\'ve received a job offer and you\'re excited to get started! And now it\'s time to talk about the salary. Not sure if it\'s best to accept the offer? Reject it? Negotiate it? Or how to talk about salary in general?\r\n\r\nJoin the Sac State Career Center and Consolidated Electrical Distributors! We will be co-facilitating an in-person workshop to provide tips on how to negotiate a salary. This workshop is a fantastic opportunity for undergraduates, graduates, and alums of all majors are encouraged to attend.', 'Set up tables, clean up tables'),
(3, 'HERE TO CAREER: LinkedIn and Handshake 101', 'Cottonwood Suite, 2nd Floor\r\nUniversity Union, 6000 J Street, Sacramento, California 95819, United States of America', '2023-11-01', 'Did you know there are more than a thousand jobs and internships posted on Handshake? And 95% of recruiters search for professional talent on Linkedin?\r\n\r\nThis Here to Career workshop is designed for you to learn the significant features of both platforms, Handshake and Linkedin. These platforms could help widen your professional network, engagement with employers, showcase your skills and potential to obtain internships, part-time or full-time employment opportunities.', 'Set up tables, clean up '),
(4, 'MEET THE EMPLOYER: ITS Logistics', '	Foothill Suite, 3rd Floor\r\nUniversity Union, 6000 J Street, Sacramento, California 95819, United States of America', '2023-11-02', 'Join representatives from ITS Logistics as they discuss their internship and employment opportunities and give tips on how to apply!', 'Set up and clean up'),
(5, 'MEET THE EMPLOYER: CITY YEAR', '	Room Orchard Suite, 2nd Floor\r\nUniversity Union, 6000 J Street, Sacramento, California 95819, United States of America', '2023-11-09', '\r\nBe an agent of change when creating positive impact within: school districts, non-profit organizations, and public service programs.\r\n\r\nCity Year will be on campus for an in-person info session to introduce their purpose in providing guidance and service to our youth in need. Join us to find out how you can become part of the team that serves our community.\r\n\r\nStudents interested in a career in Sociology, Social Work, Psychology, and Education are encouraged to attend!', 'Set up audio and visual ');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `comment` longtext NOT NULL,
  `date` varchar(50) NOT NULL,
  `reply_id` int(11) NOT NULL,
  `reply_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `name`, `comment`, `date`, `reply_id`, `reply_name`) VALUES
(148, 'John', 'Hello', 'November 30 2023, 06:19:45 PM', 0, ''),
(149, 'Jane', 'Hello', 'November 30 2023, 06:22:43 PM', 148, 'John'),
(150, 'Jane', 'Hello', 'November 30 2023, 06:22:52 PM', 0, ''),
(151, 'Jane', 'hello', 'November 30 2023, 06:23:02 PM', 149, 'Jane'),
(152, 'Jane', 'hello', 'November 30 2023, 06:23:13 PM', 148, 'John');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_name`, `password`, `email`, `firstname`, `lastname`, `date`, `user_type`) VALUES
(28, 12429, 'student', '$2y$10$7DUEeWTL99.gQWtY8VaF2e8JMFwuhAngkOoe6mBBjdTEY92rGBFAq', 'example@csus.edu', 'John', 'Smith', '2023-11-27 07:51:04', 'user'),
(29, 6605, 'admin', '$2y$10$vn/U2nGLzddQpHoP3eCP5.fBXXKqQAe5H/yQoS7qqUMbw7uyrNtYK', 'admin@csus.edu', 'Jane', 'Smith', '2023-11-27 07:52:54', 'admin'),
(30, 6210, 'taekjin', '$2y$10$Z6Mwxni4h1KBHDZ.ZSAarOMVkmP/eW7yFqTSDAPNsiJkRUOcsgirW', 'taekjin@csus.edu', 'Taekjin', 'Jung', '2023-11-28 23:14:35', 'user'),
(32, 23124, 'student3', '$2y$10$R41PQ9JIE/Y6U.DUaRfB/epfUCO9e3/wOFJ0bLXr382ZS8yU4QgU6', 'example@csus.edu', 'Brandon', 'F', '2023-12-01 02:17:05', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_events`
--

CREATE TABLE `user_events` (
  `user_id` bigint(20) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_events`
--

INSERT INTO `user_events` (`user_id`, `event_id`) VALUES
(6210, 1),
(6210, 3),
(12429, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `about_me` varchar(1500) NOT NULL,
  `experience` varchar(1500) NOT NULL,
  `accommodations` varchar(1500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `user_id`, `first_name`, `last_name`, `about_me`, `experience`, `accommodations`, `date`) VALUES
(0, 6210, '', '', 'I\'m a student', 'none yet', '', '2023-11-28 23:16:48'),
(0, 12429, '', '', 'This about me', 'orking with large groups of people. I can set up and tear down any events.', 'I', '2023-12-01 02:20:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_name` (`user_name`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `user_events`
--
ALTER TABLE `user_events`
  ADD PRIMARY KEY (`user_id`,`event_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_events`
--
ALTER TABLE `user_events`
  ADD CONSTRAINT `user_events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_events_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
