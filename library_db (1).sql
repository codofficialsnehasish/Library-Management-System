-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 09:30 AM
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
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `publication_year` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `total_copies` int(50) DEFAULT 0,
  `avaliable_copies` int(50) DEFAULT 0,
  `shelf_number` varchar(255) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `isbn`, `publisher`, `publication_year`, `category`, `description`, `language`, `total_copies`, `avaliable_copies`, `shelf_number`, `keywords`, `image`, `created_at`) VALUES
(3, 'bh', 'b', 'b', 'gug', 'uyg', 'uyg', 'uy', 'guy', 5, 3, 'guy', 'guy', '1711523387beautiful-shot-colorful-autumn-forest-full-different-kinds-plants.jpg', '2024-03-25 17:11:04'),
(5, 'yyug', 'hgyug', 'hyubguuyg', 'uhgiugyiuy', 'yguiygiu', 'yugyigiug', 'yhgygvyig', 'hyhgvyug', 5, 2, 'uguyguyg', 'uighuig', '1711386722', '2024-03-25 17:12:02'),
(7, 'uihuihi', 'huiuh', 'iuiuiug', 'uhiuhui', 'uiuighiu', 'guiiugiug', 'iuguiguig', 'iuguiguig', 5, 4, 'jhvbhjv', 'jhvjh', '171152356404012019-25.jpg', '2024-03-25 17:13:33');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `borrow_date` date DEFAULT NULL,
  `exptd_return_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `fine_amount` decimal(10,2) DEFAULT NULL,
  `fine_paid` tinyint(1) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 2,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `user_id`, `book_id`, `borrow_date`, `exptd_return_date`, `return_date`, `fine_amount`, `fine_paid`, `is_approved`, `created_at`) VALUES
(1, 1, 3, '2024-03-26', NULL, '2024-03-22', NULL, NULL, 1, '2024-03-26 10:26:19'),
(2, 1, 5, '2024-03-26', NULL, NULL, NULL, NULL, 0, '2024-03-26 10:41:40'),
(3, 1, 6, '2024-03-26', NULL, '2024-03-28', NULL, NULL, 1, '2024-03-26 10:56:37'),
(4, 1, 7, '2024-03-26', NULL, NULL, NULL, NULL, 1, '2024-03-26 11:03:45'),
(5, 3, 3, '2024-03-26', '2024-04-03', '2024-03-27', NULL, NULL, 1, '2024-03-26 11:54:08'),
(6, 1, 6, '2024-03-26', '2024-04-05', NULL, NULL, NULL, 2, '2024-03-26 12:19:41'),
(7, 3, 3, '2024-03-27', '2024-04-06', NULL, NULL, NULL, 2, '2024-03-27 05:32:12'),
(8, 3, 3, '2024-03-27', '2024-04-06', NULL, NULL, NULL, 2, '2024-03-27 05:33:25'),
(9, 1, 3, '2024-03-27', '2024-04-06', NULL, NULL, NULL, 2, '2024-03-27 05:59:20'),
(10, 1, 3, '2024-03-27', '2024-04-06', NULL, NULL, NULL, 2, '2024-03-27 06:00:55'),
(11, 1, 3, '2024-03-27', '2024-04-06', NULL, NULL, NULL, 2, '2024-03-27 06:01:09'),
(12, 1, 3, '2024-03-27', '2024-04-06', NULL, NULL, NULL, 2, '2024-03-27 06:01:17'),
(13, 1, 3, '2024-03-27', '2024-04-06', NULL, NULL, NULL, 2, '2024-03-27 06:03:14'),
(14, 1, 3, '2024-03-27', '2024-04-06', NULL, NULL, NULL, 2, '2024-03-27 06:03:24'),
(15, 1, 3, '2024-03-27', '2024-04-06', NULL, NULL, NULL, 2, '2024-03-27 06:04:11'),
(16, 1, 3, '2024-03-27', '2024-04-06', NULL, NULL, NULL, 2, '2024-03-27 06:04:52'),
(17, 1, 3, '2024-03-27', '2024-04-06', NULL, NULL, NULL, 2, '2024-03-27 06:06:31'),
(18, 1, 3, '2024-03-27', '2024-04-06', NULL, NULL, NULL, 2, '2024-03-27 06:06:45'),
(19, 1, 3, '2024-03-27', '2024-04-06', NULL, NULL, NULL, 2, '2024-03-27 06:08:07'),
(20, 1, 3, '2024-03-27', '2024-04-06', NULL, NULL, NULL, 2, '2024-03-27 06:08:24'),
(21, 1, 7, '2024-03-27', '2024-04-06', NULL, NULL, NULL, 2, '2024-03-27 06:56:54'),
(22, 1, 7, '2024-03-27', '2024-04-06', NULL, NULL, NULL, 2, '2024-03-27 06:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `password`, `mobile`, `city`, `address`, `created_at`) VALUES
(1, 'Snehasish Bhurisrestha', 'admin', 'admin', '$2y$10$83lmx9.nA.WWVP.HHk5G8.jlPeg3Zx3j4wlkJcvVu9ufpPngE69Mm', '7031182870', 'Khanakul', 'Radhanahar, nanagukpara, hooghly', '2024-03-25 15:15:23'),
(3, 'Not Sure saka', 'user', 'eslienterprisess@gmail.com', '$2y$10$lK0M.6hb4TPoodJIn3ZlB.irKirs3IIVAru/R28jin3N1Dftc6LfC', '7031182870', 'Khanakul', 'adccdc', '2024-03-26 11:48:02'),
(4, 'slide-2', 'user', 'dign@gmail.com', '$2y$10$oUUuG.G3EGLAkmBDRjMQIOIOX7mQkB9SwPuqmcC7mWPsOLdp.qAU2', '2032145698', 'Khanakul', 'fvdxb', '2024-03-26 14:35:31'),
(5, 'dogs', 'user', 'jiokaka@gmail.com', '$2y$10$0NEFQGuA0.j4IRF2kcJgxuCV0EWXxZC0KJagww53rP8zEKbb4ky.S', '2032145698', 'Khanakul', 'vbdzbdfx', '2024-03-26 14:37:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
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
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
