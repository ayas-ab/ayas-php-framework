-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 06, 2020 at 03:28 AM
-- Server version: 5.7.28-0ubuntu0.18.04.4
-- PHP Version: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apf`
--

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cookie` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `last_online` datetime NOT NULL,
  `expire_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `user_id`, `cookie`, `user_agent`, `last_online`, `expire_at`) VALUES
(184, 1, '6dc1ce3253631da7a18d12688f331ad1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:71.0) Gecko/20100101 Firefox/71.0', '2020-01-05 22:05:14', '2020-01-07 22:05:13'),
(182, 1, 'a4ad90fb4357211b65c8b7e471cbd521', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:71.0) Gecko/20100101 Firefox/71.0', '2019-12-27 08:13:21', '2019-12-29 08:13:20'),
(181, 1, 'd23426a097980419ed26d9d520fd203d', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:70.0) Gecko/20100101 Firefox/70.0', '2019-11-28 02:09:14', '2019-11-30 02:09:13'),
(195, 15, '8e796542d3686cbad14f7dd378bbeda1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/79.0.3945.79 Chrome/79.0.3945.79 Safari/537.36', '2020-01-06 09:44:23', '2020-01-08 09:44:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `last_ip` mediumtext COLLATE utf8_unicode_ci,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `last_ip`, `email`, `password`, `number`, `user_type`) VALUES
(15, 'new', 'tryingthis', '127.0.0.1', 'person_try@testinghaha.com', '$argon2i$v=19$m=65536,t=4,p=1$UUdIUVdJekh5VUNLMU8xZA$I+QEagqDa7PavKnDEmRgY2NgZfCsVN7hQt6cl9FvXQ8', '1232321313', 0),
(14, 'test', 'stuff', '127.0.0.1', 'p4@example.com', '$argon2i$v=19$m=65536,t=4,p=1$YWlHMUpRemdZN0tBdGV4TQ$dd6Y6QNztEEHFY/R+B3XJ3uH9aL0rBlHq1JQFMbzbDg', '1234567890', 0),
(13, 'hello', 'its me', '127.0.0.1', 'p3@example.com', '$argon2i$v=19$m=65536,t=4,p=1$YWlHMUpRemdZN0tBdGV4TQ$dd6Y6QNztEEHFY/R+B3XJ3uH9aL0rBlHq1JQFMbzbDg', '1234567890', 0),
(12, 'someone', 'two', '127.0.0.1', 'p2@example.com', '$argon2i$v=19$m=65536,t=4,p=1$YWlHMUpRemdZN0tBdGV4TQ$dd6Y6QNztEEHFY/R+B3XJ3uH9aL0rBlHq1JQFMbzbDg', '1234567890', 0),
(11, 'person', 'helloo', '127.0.0.1', 'p1@example.com', '$argon2i$v=19$m=65536,t=4,p=1$YWlHMUpRemdZN0tBdGV4TQ$dd6Y6QNztEEHFY/R+B3XJ3uH9aL0rBlHq1JQFMbzbDg', '1234567890', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
