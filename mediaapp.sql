-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2023 at 09:35 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mediaapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int NOT NULL,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `comment`, `created_at`) VALUES
(4, 2, 2, 'love it', '2023-06-03 13:20:48'),
(8, 4, 2, 'what a computer', '2023-06-03 22:48:41'),
(16, 4, 2, 'try', '2023-06-03 23:26:34'),
(17, 4, 2, 'trytry', '2023-06-03 23:26:40'),
(18, 2, 2, 'welcome', '2023-06-03 23:26:48'),
(19, 2, 2, 'welcome', '2023-06-03 23:26:49'),
(20, 2, 2, 'welcome', '2023-06-03 23:26:49'),
(21, 2, 2, 'welcome', '2023-06-03 23:26:50'),
(22, 1, 2, 'trythis', '2023-06-03 23:27:21'),
(24, 1, 2, 'this test', '2023-06-03 23:44:08'),
(66, 2, 1, 'good one', '2023-06-12 14:14:46'),
(67, 1, 1, 'lets work', '2023-06-12 14:14:56'),
(68, 4, 1, 'ydgsudhshdis', '2023-06-17 18:09:06');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int NOT NULL,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `likeStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `post_id`, `user_id`, `likeStatus`) VALUES
(1, 11, 1, 1),
(9, 9, 1, 1),
(10, 4, 1, 0),
(19, 1, 1, 1),
(20, 2, 1, 1),
(21, 11, 5, 1),
(22, 9, 5, 1),
(23, 4, 5, 1),
(24, 2, 5, 1),
(25, 2, 2, 1),
(26, 11, 2, 1),
(27, 9, 2, 1),
(28, 12, 1, 1),
(29, 13, 6, 1),
(30, 13, 1, 1),
(31, 11, 7, 1),
(32, 14, 7, 0),
(33, 4, 7, 1),
(34, 2, 7, 1),
(35, 1, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE `users_info` (
  `user_id` int NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profile_img` varchar(100) NOT NULL,
  `firstname` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `lastname` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `bio` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`user_id`, `user_name`, `user_email`, `password`, `profile_img`, `firstname`, `lastname`, `bio`, `gender`, `phone`, `date_time`) VALUES
(1, 'rafeh saayfan', 'rafehsaayfan@gmail.com', 'servusrafeh7', 'sofia-mcguire.png', '', '', 'Lebanon', 'Male', '', '2023-05-16 09:05:34'),
(2, 'dany_seifddin', 'dany_seifddin@gmail.com', 'dannynbw', 'user_profile.webp', '', '', '', '', '', '2023-05-16 09:24:10'),
(5, 'yousuf_saayfan', 'yousuf@gmail.com', '123321456', 'user_profile.webp', '', '', '', '', '', '2023-05-26 18:58:19');

-- --------------------------------------------------------

--
-- Table structure for table `users_posts`
--

CREATE TABLE `users_posts` (
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `post_img` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users_posts`
--

INSERT INTO `users_posts` (`post_id`, `user_id`, `post_img`, `description`, `created_at`) VALUES
(1, 1, 'our-service-img.jpg', 'this is my computer', '2023-05-28 01:08:17'),
(2, 1, 'create-digital-img.jpg', 'new vibes', '2023-05-28 01:08:42'),
(4, 2, 'about-us-img.jpg', 'computer', '2023-05-28 02:17:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comm&post` (`post_id`),
  ADD KEY `comm&user` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `likedUser_id` (`user_id`),
  ADD KEY `idOfPost` (`post_id`);

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_posts`
--
ALTER TABLE `users_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user&post` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users_posts`
--
ALTER TABLE `users_posts`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comm&post` FOREIGN KEY (`post_id`) REFERENCES `users_posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comm&user` FOREIGN KEY (`user_id`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_posts`
--
ALTER TABLE `users_posts`
  ADD CONSTRAINT `user&post` FOREIGN KEY (`user_id`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
