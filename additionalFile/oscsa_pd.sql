-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 18, 2019 at 07:58 PM
-- Server version: 10.3.20-MariaDB
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
-- Database: `oscsa_pd`
--

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `content_id` int(11) NOT NULL,
  `content_title` varchar(256) NOT NULL,
  `content_desc` longtext NOT NULL,
  `content_link` varchar(256) NOT NULL,
  `venue` varchar(255) DEFAULT 'NULL',
  `content_type` varchar(128) NOT NULL,
  `content_date_time` datetime NOT NULL,
  `display_date_from` datetime NOT NULL,
  `display_date_to` datetime NOT NULL,
  `content_status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `approved_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`content_id`, `content_title`, `content_desc`, `content_link`, `venue`, `content_type`, `content_date_time`, `display_date_from`, `display_date_to`, `content_status`, `created_by`, `approved_by`) VALUES
(1, 'Test', 'Test', 'images/contents/1576691272_TestEvent.png', 'Sunway', 'event', '2020-11-11 11:11:00', '2020-11-11 00:00:00', '2020-11-11 00:00:00', 0, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'contributor'),
(3, 'viewer');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `user_pass_hash` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `user_pass_salt` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `user_org` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `user_created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass_hash`, `user_pass_salt`, `user_org`, `user_created_at`) VALUES
(3, 'Tan Kai Wei', 'kaiweitan128@gmail.com', '$2y$10$m.0Tk2di7RWwWjHyjlAP1eEnWYJOTGa1RoMTT5oEQ93NulD8mlyru', '8b8cfff65cbf0a527a1cb83a966fbede62ba023edb49663b9fc627420f42f7fb', '', '2019-12-16 01:24:06'),
(4, 'Admin', 'admin@pd.oscsa.my', '$2y$10$ED1qOZmyDsdxt7q4LGLnrOtsNarABIaE/1Ym0p368B7QeTjO/rUnC', 'b125e949573bc7ccd276607b655442e0f9fefe6821261053042ba48d6d90606e', '', '2019-12-16 15:16:34'),
(5, 'Content Contributor', 'cc@pd.oscsa.my', '$2y$10$RX9zK4IShrFyZUNDhtjBRuJ9FQjKqcMJWrMp9pTNym1A9rEJZNkZS', '7f74d2872866d0653e4c3d7aa062135e6c58fbeb49eb01f80d85816a9b722d0b', '', '2019-12-17 01:20:06'),
(8, 'Tan Kai Wei', 'kaiweitan1997@gmail.com', '$2y$10$2a6gnwcnTquPeZFDJVxXse/tb1E2VbDjl1Q9JYjycXKJokVQwPYyG', 'a76b5c5f2282894e0ddd225715471b0d3efd3cc5ca7ca7b582a204b7a739f73a', 'Test', '2019-12-19 02:54:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_request`
--

CREATE TABLE `user_request` (
  `request_id` int(11) NOT NULL,
  `req_fullName` varchar(256) NOT NULL,
  `req_email` varchar(256) NOT NULL,
  `req_organization` varchar(256) NOT NULL,
  `req_reason` longtext NOT NULL,
  `req_status` tinyint(4) NOT NULL,
  `reject_reason` varchar(256) DEFAULT NULL,
  `handle_by` int(11) DEFAULT NULL,
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_request`
--

INSERT INTO `user_request` (`request_id`, `req_fullName`, `req_email`, `req_organization`, `req_reason`, `req_status`, `reject_reason`, `handle_by`, `requested_at`) VALUES
(18, 'JTicket', 'kaiweitan1997@gmail.com', 'Sunway University', '1', 0, NULL, NULL, '2019-12-17 09:18:16'),
(19, 'samir', 'ranasam987@gmail.com', 'cricket club', 'event', 0, NULL, NULL, '2019-12-17 14:02:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(4, 1),
(5, 2),
(8, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_request`
--
ALTER TABLE `user_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_request`
--
ALTER TABLE `user_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
