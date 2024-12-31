-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2024 at 12:26 PM
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
-- Database: `sound_entertainment`
--

CREATE DATABASE IF NOT EXISTS sound_entertainment;
USE sound_entertainment;

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `album_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `release_year` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`album_id`, `name`, `release_year`, `description`, `cover_image`) VALUES
(1, 'Glory', 2024, 'Amazing album by honey singh', 'glory_album_cover.jpg'),
(3, 'Vip Mix Sindhi', 2019, 'Vip mix sindhi songs sindhi culture songs', 'mix-sindhi_cover_album_cover.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `artist_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bio` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`artist_id`, `name`, `bio`, `image_url`) VALUES
(1, 'Hirdesh Singh', 'Hirdesh Singh (born 15 March 1983), known professionally as Yo Yo Honey Singh or simply Honey Singh, is an Indian singer, music producer and actor.', 'sign_artist.jpg'),
(2, 'Mumtaz Molai', 'Mumtaz Molai is one of the most famous singer and poet of Sindh. He was born in 1980 city of Khairpur Mirus in Sindh.Now he named as King Of Sindh.', 'Mumtaz-Molai_artist.jpg'),
(3, 'Attaullah Khan', 'Attaullah Khan Niazi SI PP, known professionally as Attaullah Khan Esakhelvi, is a Pakistani musician, singer, and poet from Isakhel in Mianwali District, Punjab.', '6773d3b43a281_artist.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `name`) VALUES
(1, 'Action'),
(2, 'Comedy'),
(3, 'Education'),
(4, 'Programming'),
(5, 'Tutorial'),
(6, 'Mystery');

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `music_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `language` enum('ENGLISH','REGIONAL') NOT NULL,
  `year` year(4) NOT NULL,
  `album_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_new` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`music_id`, `title`, `language`, `year`, `album_id`, `artist_id`, `file_path`, `cover_image`, `description`, `is_new`, `created_at`) VALUES
(1, 'Dil Chori', 'REGIONAL', '2018', 1, 1, 'DilChori.mp3', 'dilchori_cover.jpg', 'Yo Yo Honey Singh Listen to the story of last night Drink red wine mane purani\r\n', 0, '2024-12-26 19:16:48'),
(2, 'Rooh', 'REGIONAL', '2024', 1, 1, 'Rooh.mp3', 'rooh_cover.jpg', 'This December Rooh song by Hirdesh Singh\r\n', 1, '2024-12-26 20:12:50'),
(3, 'Bagre badan te karo wago', 'REGIONAL', '2015', 3, 2, 'bagre-badan-te-karo.mp3', 'Bagre-Badan_music_cover.jpg', 'KARO WAGO MUMTAZ MOLAI OF MOLAI MURTAZA', 0, '2024-12-31 14:07:14'),
(4, 'Be Dard Dhola', 'REGIONAL', '2023', 3, 3, '6773c4c0ae581_music.mp3', '6773c4a5bee0a_music_cover.jpg', 'Be Dard Dhola (Original) - by Attaullah Khan d', 1, '2024-12-31 14:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('ADMIN','USER') DEFAULT 'USER',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `phone_number`, `address`, `password`, `role`, `created_at`, `updated_at`) VALUES
(0, 'Admin', 'admin@gmail.com', '1', 'Sound Entertainment Admin', '$2y$10$OY5FphpZFzJbbtNEpVSzS.3.dbR7U9JY5RRFaVUMB0VCSty7qk.ZG', 'ADMIN', '2024-12-30 14:59:32', '2024-12-30 15:08:04'),
(19, 'Faisal Khan', 'fmugheri83@gmail.com', '03337545997', 'District Council Larkana, Near-Subhanallah-Hotel', '$2y$10$lO3C4xhK8uYBpG1sLNbnDuLEQRCzuWyP7GnBkD4Lhas7HF7CYReTq', 'USER', '2024-12-30 14:20:49', '2024-12-30 15:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `video_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `language` enum('ENGLISH','REGIONAL') NOT NULL,
  `year` year(4) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_new` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`video_id`, `title`, `language`, `year`, `genre_id`, `file_path`, `cover_image`, `description`, `is_new`, `created_at`) VALUES
(1, 'JavaScript tutorial for beginners ????', 'ENGLISH', '2019', 4, '6772af3a1dd94_video.mp4', '6772af3a204bb_video_cover.jpg', 'JavaScript tutorial for beginners the backbone of webdev', 1, '2024-12-29 16:41:26'),
(4, 'Learn CSS in 1 hour ????', 'ENGLISH', '2021', 5, '6772ae86b0d18_video.mp4', '6772ae86b38fe_video_cover.jpg', 'Learn CSS in 1 hour improve you\'re webdev skills', 1, '2024-12-29 16:51:56'),
(5, 'HTML Tutorial for Beginners: HTML Crash Course', 'ENGLISH', '2021', 5, '6771ae8c85162_video.mp4', '6771ae8c8517c_video_cover.jpg', 'Start your web development career with HTML/CSS! ????  This beginner-friendly tutorial covers the essentials.', 1, '2024-12-30 01:18:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`album_id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`music_id`),
  ADD KEY `album_id` (`album_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`video_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `music_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `music`
--
ALTER TABLE `music`
  ADD CONSTRAINT `music_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `albums` (`album_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `music_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`) ON DELETE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
