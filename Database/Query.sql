-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 12:09 PM
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
(5, 'Glory', 2024, 'Album by Yo Yo Honey Singh', '6775208e3c762_cover.jpg'),
(6, 'Moosetape', 2021, 'Moosetape is the second studio album by Indian singer, rapper and songwriter Sidhu Moose Wala, released independently on 15 May 2021. Moose Wala served as the executive producer.', '67752a8bf2e33_cover.jpg'),
(7, 'Shani Arshad Mix Songs', 2024, 'Afat (Original Score) is a Urdu album released on 17 Oct 2024. Afat (Original Score) Album has 1 song sung by Shani Arshad.', '67753236103c1_cover.jpg');

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
(6, 'Hirdesh Singh', 'Hirdesh Singh, known professionally as Yo Yo Honey Singh or simply Honey Singh, is an Indian singer, music producer and actor.', '67751f7fdb938_artist.jpg'),
(7, 'Sidhu Moose Wala', 'Shubhdeep Singh Sidhu, known professionally as Sidhu Moose Wala, was an Indian singer and rapper. He worked predominantly in Punjabi-language music and cinema.', '67752865813f5_artist.jpg'),
(8, 'Shani Arshad', 'Shani Arshad is a Pakistani film music director, songwriter, TV jingle composer, playback singer and record producer. He has composed music for various television serials and films including Actor in Law', '677531c98ce87_artist.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `parent_comment_id` int(11) DEFAULT NULL,
  `commentable_type` enum('VIDEO','MUSIC') NOT NULL,
  `commentable_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `content`, `parent_comment_id`, `commentable_type`, `commentable_id`, `created_at`) VALUES
(27, 0, 'hello', NULL, 'MUSIC', 28, '2025-01-02 11:21:32'),
(30, 0, 'dawdaw', NULL, 'MUSIC', 28, '2025-01-02 11:24:57');

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
(13, 'Action'),
(14, 'Mystery'),
(15, 'Adventure'),
(16, 'Comedy'),
(17, 'Historical'),
(18, 'Games'),
(19, 'Food');

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
(7, '6 Am', 'REGIONAL', '2024', 5, 6, '6775217397c42_music.mp3', '6775217397c49_music_cover.jpg', 'Presenting the 12th Track \"6 AM\" From the Most Awaited Album of the Year \"Glory\" by Yo Yo Honey Singh', 0, '2025-01-01 16:10:23'),
(8, 'Beeba', 'REGIONAL', '2024', 5, 6, '67752217bafec_music.mp3', '67752217baff5_music_cover.jpg', 'Beeba is a Hindi language song and is sung by Yo Yo Honey Singh, Laïoung and Wahab Bugti. Beeba, from the album GLORY, was released in the year 2024.', 0, '2025-01-01 16:08:07'),
(9, 'Bonita', 'REGIONAL', '2024', 5, 6, '6775226e98884_music.mp3', '6775226e9888c_music_cover.jpg', '\'BONITA\' BY YO YO HONEY SINGH, FROM THE MOST LOVED ALBUM OF THIS YEAR \'GLORY\'', 0, '2025-01-01 16:09:34'),
(10, 'Caliente', 'REGIONAL', '2023', 5, 6, '677522ed247cc_music.mp3', '677522ed247d4_music_cover.jpg', 'Caliente is a Hindi language song and is sung by Yo Yo Honey Singh. Caliente, from the album GLORY', 0, '2025-01-01 16:11:41'),
(11, 'Chhori', 'REGIONAL', '2017', 5, 6, '677524166c90b_music.mp3', '677524166c914_music_cover.jpg', 'Movie song singed by hirdesh singh', 0, '2025-01-01 16:16:38'),
(12, 'Fuck Them', 'REGIONAL', '2024', 5, 6, '67752477000f6_music.mp3', '67752477000fe_music_cover.jpg', 'Fuck Them by Yo Yo Honey Singh & Leo Grewal', 0, '2025-01-01 16:18:15'),
(13, 'Hide It', 'REGIONAL', '2023', 5, 6, '677524caa527b_music.mp3', '677524caa5284_music_cover.jpg', 'Hide It is a Hindi language song and is sung by Yo Yo Honey Singh. Hide It, from the album GLORY', 0, '2025-01-01 16:19:38'),
(14, 'High On Me', 'REGIONAL', '2024', 5, 6, '677525b849ce0_music.mp3', '677525b849ce8_music_cover.jpg', 'SONG \"HIGH ON ME\" BY YO YO HONEY SINGH, FROM THE ALBUM \'GLORY\'', 1, '2025-01-01 16:23:36'),
(15, 'Payal', 'REGIONAL', '2024', 5, 6, '6775261583faf_music.mp3', '6775261583fb6_music_cover.jpg', '\"Payal\" From the Most Awaited Album of the Year \"Glory\" by Yo Yo Honey Singh', 1, '2025-01-01 16:25:09'),
(16, 'Millionaire', 'ENGLISH', '2024', 5, 6, '677526693eb16_music.mp3', '677526693eb1e_music_cover.jpg', '\'MILLIONAIRE\' BY YO YO HONEY SINGH, FROM THE MOST AWAITED ALBUM OF THE YEAR \'GLORY\'', 1, '2025-01-01 16:26:33'),
(17, 'Lapata', 'REGIONAL', '2024', 5, 6, '677526cb6d4e9_music.mp3', '677526cb6d4f1_music_cover.jpg', '\"Lapata\" From the Most Awaited Album of the Year \"Glory\" by Yo Yo Honey Singh.', 0, '2025-01-01 16:28:11'),
(18, 'Majnooh', 'REGIONAL', '2024', 5, 6, '6775273b650fe_music.mp3', '6775273b65106_music_cover.jpg', 'Majnu - Yo Yo Honey singh ft. Emiway Bantai', 0, '2025-01-01 16:30:03'),
(19, '295', 'REGIONAL', '2021', 6, 7, '67752b00e25a1_music.mp3', '67752b00e25a9_music_cover.jpg', '295 is a Punjabi language song and is sung by Sidhu Moose Wala. 295,', 0, '2025-01-01 16:46:08'),
(20, 'Unfuckwithable', 'REGIONAL', '2021', 6, 7, '67752b790c5e7_music.mp3', '67752b790c5ef_music_cover.jpg', 'UNFUCKWITHABLE Song - UNFUCKWITHABLE Singer - Sidhu Moose Wala & Afsana Khan', 0, '2025-01-01 16:48:09'),
(21, 'Bitch Im Back', 'REGIONAL', '2021', 6, 7, '67752bed7eb84_music.mp3', '67752bed7eb8c_music_cover.jpg', 'Sidhu Moose Wala Presents Song - Bitch Im Back Music', 0, '2025-01-01 16:50:05'),
(22, 'Celebrity Killer', 'REGIONAL', '2021', 6, 7, '67752dd41ff55_music.mp3', '67752dd41ff5d_music_cover.jpg', 'Celebrity Killer (feat. Tion Wayne) Song from Moosetape album are written by Sidhu Moose Wala,', 0, '2025-01-01 16:58:12'),
(23, 'Malwa Block', 'REGIONAL', '2021', 6, 7, '67752e51d4ce8_music.mp3', '67752e51d4cf0_music_cover.jpg', 'Malwa Block Song from Moosetape album are written by Sidhu Moose Wala.', 0, '2025-01-01 17:00:17'),
(24, 'GOAT', 'REGIONAL', '2021', 6, 7, '67752f3ca9228_music.mp3', '67752f3ca922f_music_cover.jpg', 'GOAT - Sidhu Moose Wala x Moosetape', 0, '2025-01-01 17:04:12'),
(25, 'These Days', 'REGIONAL', '2021', 6, 7, '67752f9aac444_music.mp3', '67752f9aac44b_music_cover.jpg', '\"These Days\" from Moosetape Singer/Lyrics/Composer - Sidhu Moose Wala Rap', 0, '2025-01-01 17:05:46'),
(26, 'Afat (Original Score)', 'REGIONAL', '2024', 7, 8, '677532b6e6b7d_music.m4a', '677532b6e6b85_music_cover.jpg', 'Afat (Original Score) - Single by Shani Arshad', 1, '2025-01-01 17:19:02'),
(27, 'Kaffara (Original Score)', 'REGIONAL', '2024', 7, 8, '677533f873f29_music.m4a', '677533f873f30_music_cover.jpg', 'Kaffara (Original Score) · Shani Arshad Kaffara (Original Score)', 1, '2025-01-01 17:24:24'),
(28, 'Tauba (Original Score)', 'REGIONAL', '2024', 7, 8, '677535306ebd7_music.m4a', '677535306ebdf_music_cover.jpg', 'Tauba (Original Score) - Single by Shani Arshad.', 1, '2025-01-01 17:29:36');

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
(22, 'test user', 'user@example.com', '03333333333', '123 street, Pakistan', '$2y$10$BqYrzKZeXYhYl0rUxqKva.EHiXVpZgXkFZ9PzcPwMlqEj2EBqXgcu', 'USER', '2025-01-07 11:05:16', '2025-01-07 11:05:16');

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
(7, 'Dunya ka Sab se Barra Chapli Kabab', 'REGIONAL', '2024', 19, '67765f4f57d6b_video.mp4', '67765f1757055_video_cover.jpg', 'Dunya ka Sab se Barra Chapli Kabab', 1, '2025-01-02 14:40:39'),
(8, 'ZERO Vs !???????????????????????? #pubgmobile #youssefelpop #youssef #pubg', 'REGIONAL', '2024', 18, '677660982c16c_video.mp4', '677660982c174_video_cover.jpg', 'ZERO Vs !???????????????????????? #pubgmobile #youssefelpop #youssef #pubg\r\nPUBG MOBILE SHORT', 0, '2025-01-02 14:47:04'),
(9, 'Who likes Chandigarh\'s viral Gulab Jamun ☺️ #trend #breakfastfood #food #streetfoo #trending', 'REGIONAL', '2024', 19, '677661d128bf9_video.mp4', '677661d128c02_video_cover.jpg', 'street food Gulab Jamun', 0, '2025-01-02 14:52:17'),
(10, 'Beautiful places ????#shorts #amazing', 'ENGLISH', '2023', 15, '677662b3c76dc_video.mp4', '677662b3c76e3_video_cover.jpg', 'Beautiful places ????#shorts #amazing', 0, '2025-01-02 14:56:03'),
(11, 'When a whale dies #shorts #hindifacts', 'REGIONAL', '2023', 17, '677663359b391_video.mp4', '677663359b399_video_cover.jpg', 'When a whale dies #shorts #hindifacts', 0, '2025-01-02 14:58:13');

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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `music_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

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
