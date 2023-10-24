-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 24, 2023 at 11:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `user1_email` varchar(60) NOT NULL,
  `user2_email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `user1_email`, `user2_email`) VALUES
(8, 'johndoe@gmail.com', 'johncho@gmail.com'),
(9, 'johndoe@gmail.com', 'johnboe@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `post_id` int(11) NOT NULL,
  `action` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `email`, `post_id`, `action`) VALUES
(15, 'johndoe@gmail.com', 50, 'increment');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `sender_email` varchar(60) NOT NULL,
  `body` text NOT NULL,
  `sent_at` datetime NOT NULL DEFAULT current_timestamp(),
  `readed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_email`, `body`, `sent_at`, `readed`) VALUES
(1, 8, 'johndoe@gmail.com', 'hello', '2023-08-17 10:29:07', 1),
(2, 8, 'johncho@gmail.com', 'hello to', '2023-08-17 13:17:03', 1),
(3, 8, 'johndoe@gmail.com', 'A new email by johndoe', '2023-08-17 14:35:53', 1),
(4, 9, 'johndoe@gmail.com', 'Heloo boy', '2023-08-18 13:51:27', 1),
(5, 9, 'johndoe@gmail.com', 'hi', '2023-10-24 11:56:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `added_by` varchar(60) NOT NULL,
  `user_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(3) NOT NULL DEFAULT 'NO',
  `likes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `likes`) VALUES
(29, 'fsdafdsaf sdasv asd', 'johndoe@gmail.com', 'none', '2023-08-02 17:36:23', 'NO', 0),
(30, 'as', 'johndoe@gmail.com', 'none', '2023-08-02 17:58:29', 'NO', 0),
(31, 'hwelllosa', 'johndoe@gmail.com', 'none', '2023-08-02 18:13:21', 'NO', 0),
(32, 'hwelllosa', 'johndoe@gmail.com', 'none', '2023-08-02 18:14:32', 'NO', 0),
(33, 'Hello my friend, update the users posts', 'johndoe@gmail.com', 'none', '2023-08-03 11:56:51', 'NO', 0),
(34, 'uhfsdiuj\r\n\r\ndsaikda', 'johndoe@gmail.com', 'none', '2023-08-03 12:33:58', 'NO', 0),
(35, '123', 'johndoe@gmail.com', 'none', '2023-08-03 12:36:01', 'NO', 0),
(37, '2 post submited by johnchoe', 'johncho@gmail.com', 'none', '2023-08-03 12:44:38', 'NO', 0),
(38, '3 post submited by johnchoe', 'johncho@gmail.com', 'none', '2023-08-03 12:44:43', 'NO', 0),
(43, '8 sadsa', 'johndoe@gmail.com', 'none', '2023-08-04 13:23:59', 'NO', 0),
(44, '9 dsadsa', 'johndoe@gmail.com', 'none', '2023-08-04 13:24:04', 'NO', 0),
(45, '5 post submited by johnchoe', 'johncho@gmail.com', 'none', '2023-08-04 13:43:22', 'NO', 0),
(46, 'dsadsadas', 'johndoe@gmail.com', 'none', '2023-08-06 13:53:37', 'NO', 0),
(47, 'Post nr 6 by johncho', 'johncho@gmail.com', 'none', '2023-08-06 13:55:01', 'NO', 0),
(48, 'Hello 7', 'johndoe@gmail.com', 'none', '2023-08-07 16:16:53', 'NO', 0),
(49, 'Heloo the first post!', 'johndoe@gmail.com', 'none', '2023-08-08 14:09:40', 'NO', 0),
(50, '1 Post by johnboe', 'johnboe@gmail.com', 'none', '2023-08-08 15:37:43', 'NO', 1),
(51, '2 Post by johnboe', 'johnboe@gmail.com', 'none', '2023-08-08 15:37:48', 'NO', 0),
(52, '3 Post by johnboe', 'johnboe@gmail.com', 'none', '2023-08-08 15:38:28', 'NO', 0),
(53, 'New Comment To johncho', 'johndoe@gmail.com', 'none', '2023-08-09 12:14:39', 'NO', 0),
(54, 'Hello, this is a post writed by John cho', 'johncho@gmail.com', 'none', '2023-08-11 14:45:04', 'NO', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `posted_by` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`id`, `post_body`, `posted_by`, `date_added`, `post_id`) VALUES
(6, 'this comment is added by john DOE', 'johndoe@gmail.com', '2023-08-08 15:39:24', 50),
(7, 'is the second comment added by John DOE', 'johndoe@gmail.com', '2023-08-08 15:40:48', 50),
(13, 'johndoe new comment from a long time ', 'johndoe@gmail.com', '2023-10-24 11:56:07', 50);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `profile_pic` varchar(255) DEFAULT NULL,
  `user_closed` varchar(3) NOT NULL DEFAULT 'NO',
  `friends_array` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `created_at`, `updated_at`, `profile_pic`, `user_closed`, `friends_array`) VALUES
(42, 'john', 'doe', 'johndoe@gmail.com', 'johndoe', '$2y$10$e3UP6gcC7QEDBMcg2fiNlOqOx96fxsZP48a74wYEJpYSXU39yrcX6', '2023-08-03 11:43:03', '2023-08-03 11:43:03', '/images/64d9f69a9ad05_head_belize_hole.png', 'NO', 'johnboe@gmail.com,johncho@gmail.com'),
(43, 'john', 'cho', 'johncho@gmail.com', 'johncho', '$2y$10$70lGsq6s3XIDQpTUyFaU1ehpd9wNrlQt4DxeeKM8AfSxrIKHLvvre', '2023-08-03 12:44:08', '2023-08-03 12:44:08', NULL, 'NO', 'johnboe@gmail.com'),
(44, 'john', 'boe', 'johnboe@gmail.com', 'johnboe', '$2y$10$jtv3FwtMWdF5efTHlqYrGuuAVIdtub02k5fHLd7oyeRuQDxA5I2Pi', '2023-08-05 11:09:19', '2023-08-05 11:09:19', NULL, 'NO', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user1_email` (`user1_email`),
  ADD KEY `user2_email` (`user2_email`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversation_id` (`conversation_id`),
  ADD KEY `sender_email` (`sender_email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `added_by` (`added_by`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `fk_added_by_email` (`posted_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `new_email` (`email`),
  ADD KEY `id` (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`user1_email`) REFERENCES `users` (`email`),
  ADD CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`user2_email`) REFERENCES `users` (`email`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_email` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_likes_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`sender_email`) REFERENCES `users` (`email`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_added_by` FOREIGN KEY (`added_by`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `fk_added_by_email` FOREIGN KEY (`posted_by`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
