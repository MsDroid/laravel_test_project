-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2025 at 08:57 AM
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
-- Database: `laravel_job_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `acknowledgements`
--

CREATE TABLE `acknowledgements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `applicant_id` bigint(20) UNSIGNED NOT NULL,
  `ack_no` varchar(20) NOT NULL,
  `pdf_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `acknowledgements`
--

INSERT INTO `acknowledgements` (`id`, `applicant_id`, `ack_no`, `pdf_path`, `created_at`, `updated_at`) VALUES
(1, 8, 'ACK1756793394QGJ', 'C:\\Users\\MSDROID\\Documents\\website\\laravel\\laravelJobTest\\storage\\app/acknowledgements/ack_ACK1756793394QGJ.pdf', '2025-09-02 00:39:54', '2025-09-02 00:39:55'),
(2, 8, 'ACK1756793600THK', NULL, '2025-09-02 00:43:20', '2025-09-02 00:43:20'),
(3, 8, 'ACK17567936172LF', 'acknowledgements/ack_ACK17567936172LF.pdf', '2025-09-02 00:43:37', '2025-09-02 00:43:37');

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `advt_no` varchar(255) DEFAULT NULL,
  `already_applied` tinyint(1) NOT NULL DEFAULT 0,
  `post` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `bed_required` tinyint(1) NOT NULL DEFAULT 1,
  `gender` enum('Male','Female','Others') NOT NULL,
  `physically_handicapped` tinyint(1) NOT NULL DEFAULT 0,
  `handicap_details` varchar(255) DEFAULT NULL,
  `category` enum('General','ST','SC','OBC') NOT NULL DEFAULT 'General',
  `category_certificate_no` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `photo_id_type` varchar(255) DEFAULT NULL,
  `photo_id_no` varchar(255) DEFAULT NULL,
  `photo_id_image` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `current_step` int(11) NOT NULL,
  `submitted` tinyint(1) NOT NULL DEFAULT 0,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `registration_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `user_id`, `advt_no`, `already_applied`, `post`, `subject`, `bed_required`, `gender`, `physically_handicapped`, `handicap_details`, `category`, `category_certificate_no`, `dob`, `full_name`, `mobile`, `photo_id_type`, `photo_id_no`, `photo_id_image`, `address`, `current_step`, `submitted`, `submitted_at`, `status`, `registration_no`, `created_at`, `updated_at`) VALUES
(8, 8, NULL, 0, 'Teacher', 'Agriculture', 1, 'Male', 0, NULL, 'SC', '2541256325', '1991-08-20', 'Manoranjan Singh', '8178001430', 'PAN', 'FERPS2548R', 'uploads/photo_ids/1756653393_mlm.png', 'Ratu Road', 4, 1, '2025-09-02 00:43:37', 'approved', 'CED/TAGR/2025/4000948', '2025-08-31 05:03:29', '2025-09-02 01:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-1b6453892473a467d07372d45eb05abc2031647a', 'i:1;', 1756635255),
('laravel-cache-1b6453892473a467d07372d45eb05abc2031647a:timer', 'i:1756635255;', 1756635255),
('laravel-cache-77de68daecd823babbb58edb1c8e14d7106e83bb', 'i:2;', 1756635090),
('laravel-cache-77de68daecd823babbb58edb1c8e14d7106e83bb:timer', 'i:1756635090;', 1756635090),
('laravel-cache-902ba3cda1883801594b6e1b452790cc53948fda', 'i:3;', 1756636214),
('laravel-cache-902ba3cda1883801594b6e1b452790cc53948fda:timer', 'i:1756636214;', 1756636214),
('laravel-cache-ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', 'i:4;', 1756635566),
('laravel-cache-ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4:timer', 'i:1756635566;', 1756635566),
('laravel-cache-c1dfd96eea8cc2b62785275bca38ac261256e278', 'i:1;', 1756636134),
('laravel-cache-c1dfd96eea8cc2b62785275bca38ac261256e278:timer', 'i:1756636134;', 1756636134),
('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:1;', 1756634767),
('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1756634767;', 1756634767),
('laravel-cache-fe5dbbcea5ce7e2988b8c69bcfdfde8904aabc1f', 'i:1;', 1756636488),
('laravel-cache-fe5dbbcea5ce7e2988b8c69bcfdfde8904aabc1f:timer', 'i:1756636488;', 1756636488);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `applicant_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `applicant_id`, `type`, `path`, `created_at`, `updated_at`) VALUES
(1, 8, '10th', 'documents/8/WmgRSEu9Nowa3cxVdMCWjoleWs61hND7eyuHp36R.png', '2025-09-01 10:53:18', '2025-09-01 11:24:20'),
(2, 8, '12th', 'documents/8/CBW5FLhIq6U4DFJrfQU5nkyBnWZLWqYQmTbVXyn6.png', '2025-09-01 10:53:18', '2025-09-01 11:24:20'),
(3, 8, 'B.Ed', 'documents/8/iaV66MKRQ3Ipl7ocBofYwNWCrpDa32NzcHgsKhdR.png', '2025-09-01 10:53:18', '2025-09-01 11:24:20');

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `applicant_id` bigint(20) UNSIGNED NOT NULL,
  `level` varchar(255) NOT NULL,
  `board_university` varchar(255) DEFAULT NULL,
  `subjects` varchar(255) DEFAULT NULL,
  `year_of_passing` year(4) DEFAULT NULL,
  `marks_obtained` int(11) DEFAULT NULL,
  `marks_total` int(11) DEFAULT NULL,
  `division` varchar(255) DEFAULT NULL,
  `certificate_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`applicant_id`, `level`, `board_university`, `subjects`, `year_of_passing`, `marks_obtained`, `marks_total`, `division`, `certificate_no`, `created_at`, `updated_at`) VALUES
(8, '10th', 'JAC', 'science', '2000', 325, 500, 'First', 'MTR456321', '2025-09-01 10:37:58', '2025-09-01 10:37:58'),
(8, '12th', 'JAC', 'science', '2005', 325, 500, 'First', 'SESEC451254', '2025-09-01 10:37:58', '2025-09-01 10:37:58'),
(8, 'Graduation', NULL, NULL, NULL, NULL, 500, NULL, NULL, '2025-09-01 10:37:58', '2025-09-01 10:37:58'),
(8, 'Post-Graduation', NULL, NULL, NULL, NULL, 500, NULL, NULL, '2025-09-01 10:37:58', '2025-09-01 10:37:58'),
(8, 'B.Ed', 'Ranchi University', 'Hindi honrs', '2015', 400, 500, 'First', 'BED6589654', '2025-09-01 10:37:58', '2025-09-01 10:37:58');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `applicant_id` bigint(20) UNSIGNED NOT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `total_period` varchar(255) DEFAULT NULL,
  `subjects_taught` varchar(255) DEFAULT NULL,
  `current` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`applicant_id`, `institution`, `designation`, `from_date`, `to_date`, `total_period`, `subjects_taught`, `current`, `created_at`, `updated_at`) VALUES
(8, 'Company first', 'Developer', '2016-06-15', '2025-09-24', '9 Yr 3 Mo', 'Lavarel', 0, '2025-09-01 11:23:26', '2025-09-01 11:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_25_183127_create_applicants_table', 1),
(5, '2025_08_31_080013_create_payments_table', 1),
(6, '2025_08_31_080055_create_educations_table', 1),
(7, '2025_08_31_080131_create_experiences_table', 1),
(8, '2025_08_31_080212_create_documents_table', 1),
(9, '2025_08_31_080256_create_acknowledgements_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `applicant_id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `payment_ref` varchar(255) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `receipt_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `applicant_id`, `bank_name`, `amount`, `payment_ref`, `payment_date`, `receipt_path`, `created_at`, `updated_at`) VALUES
(1, 8, NULL, 500, NULL, NULL, NULL, '2025-08-31 05:38:59', '2025-08-31 05:38:59');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('hL37a54tWuhJV4a9AfC07MauV6SmayU9tSRQz2tJ', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidk02eUtBazAxSDFRRFJhVWtzQU5EcG40YzF6Vlg0QmR0SndmTjZ6eiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo5O30=', 1756796019);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'applicant',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(8, 'Manoranjan Singh', 'manoranjansngh77@gmail.com', '2025-08-31 05:03:48', '$2y$12$.DRS9LlWI8ctIxlI/.MeVeMj6NpZ0ho2OuhKbLdT8FqED3mBF3X9i', 'applicant', NULL, '2025-08-31 05:03:29', '2025-08-31 05:03:48'),
(9, 'Admin', 'admin@gmail.com', '2025-08-31 05:03:48', '$2y$12$.DRS9LlWI8ctIxlI/.MeVeMj6NpZ0ho2OuhKbLdT8FqED3mBF3X9i', 'admin', NULL, '2025-08-31 05:03:29', '2025-08-31 05:03:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acknowledgements`
--
ALTER TABLE `acknowledgements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `acknowledgements_ack_no_unique` (`ack_no`),
  ADD KEY `acknowledgements_applicant_id_foreign` (`applicant_id`);

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applicants_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_applicant_id_foreign` (`applicant_id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD KEY `educations_applicant_id_foreign` (`applicant_id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD KEY `experiences_applicant_id_foreign` (`applicant_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_applicant_id_foreign` (`applicant_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acknowledgements`
--
ALTER TABLE `acknowledgements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acknowledgements`
--
ALTER TABLE `acknowledgements`
  ADD CONSTRAINT `acknowledgements_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `applicants`
--
ALTER TABLE `applicants`
  ADD CONSTRAINT `applicants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `educations`
--
ALTER TABLE `educations`
  ADD CONSTRAINT `educations_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `experiences`
--
ALTER TABLE `experiences`
  ADD CONSTRAINT `experiences_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
