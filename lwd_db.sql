-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2025 at 09:53 PM
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
-- Database: `lwd_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `home_id` bigint(20) UNSIGNED NOT NULL,
  `platform` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `home_id`, `platform`, `url`, `detail`, `icon`, `created_at`, `updated_at`) VALUES
(1, 1, 'Email', 'https://mail.google.com/mail/?view=cm&fs=1&to=lestariwisatadieng@gmail.com', 'lestariwisatadieng@gmail.com', 'ri-mail-line', '2025-07-16 06:30:59', '2025-07-16 06:30:59');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_destinasi`
--

CREATE TABLE `daftar_destinasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_destinasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daftar_destinasi`
--

INSERT INTO `daftar_destinasi` (`id`, `nama_destinasi`, `created_at`, `updated_at`) VALUES
(6, 'testdestinasi1', '2025-07-16 06:30:59', '2025-07-16 06:30:59'),
(7, 'testdestinasi3', '2025-07-16 06:30:59', '2025-07-16 06:30:59'),
(8, 'testdestinasi4', '2025-07-16 06:30:59', '2025-07-16 06:30:59');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_destinasi_paket`
--

CREATE TABLE `daftar_destinasi_paket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket_id` bigint(20) UNSIGNED NOT NULL,
  `daftar_destinasi_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daftar_destinasi_paket`
--

INSERT INTO `daftar_destinasi_paket` (`id`, `paket_id`, `daftar_destinasi_id`, `created_at`, `updated_at`) VALUES
(1, 11, 7, '2025-07-16 06:30:59', '2025-07-16 06:30:59'),
(2, 13, 7, '2025-07-16 06:30:59', '2025-07-16 06:30:59'),
(3, 13, 6, '2025-07-16 06:30:59', '2025-07-16 06:30:59');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_fasilitas`
--

CREATE TABLE `daftar_fasilitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_fasilitas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daftar_fasilitas`
--

INSERT INTO `daftar_fasilitas` (`id`, `nama_fasilitas`, `created_at`, `updated_at`) VALUES
(1, 'AC', '2025-07-16 11:26:05', '2025-07-16 11:26:05'),
(2, 'Kasur', '2025-07-16 11:26:13', '2025-07-16 11:26:13'),
(3, 'Bantal', '2025-07-16 11:26:19', '2025-07-16 11:26:19');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_fasilitas_paket`
--

CREATE TABLE `daftar_fasilitas_paket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket_id` bigint(20) UNSIGNED NOT NULL,
  `daftar_fasilitas_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daftar_fasilitas_paket`
--

INSERT INTO `daftar_fasilitas_paket` (`id`, `paket_id`, `daftar_fasilitas_id`, `created_at`, `updated_at`) VALUES
(1, 11, 1, '2025-07-16 11:26:05', '2025-07-16 11:26:05'),
(2, 11, 2, '2025-07-16 11:26:13', '2025-07-16 11:26:13'),
(3, 11, 3, '2025-07-16 11:26:19', '2025-07-16 11:26:19');

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE `destination` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `home_id` bigint(20) UNSIGNED NOT NULL,
  `is_main_page` tinyint(1) NOT NULL DEFAULT 0,
  `content_title` varchar(255) NOT NULL,
  `content_summary` text NOT NULL,
  `content_location_title` varchar(255) NOT NULL,
  `content_location_detail` longtext NOT NULL,
  `thumbnail_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id`, `home_id`, `is_main_page`, `content_title`, `content_summary`, `content_location_title`, `content_location_detail`, `thumbnail_image`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Telaga Warna', 'Telaga terkenal dengan warna airnya yang bisa berubah-ubah, dikelilingi perbukitan hijau dan udara sejuk khas Dieng.', 'Telaga Warna Dieng', 'Desa Dieng Wetan, Kejajar, Wonosobo, Jawa Tengah', '1752692139_thumb.jpg', '2025-07-16 11:55:39', '2025-07-16 11:55:39'),
(2, 1, 1, 'Komplek Candi Arjuna', 'Kompleks candi Hindu peninggalan abad ke-8, sering digunakan untuk ritual budaya Dieng Culture Festival.', 'Candi Arjuna', 'Dieng Kulon, Batur, Banjarnegara, Jawa Tengah', '1752692231_thumb.jpg', '2025-07-16 11:57:11', '2025-07-16 12:15:28'),
(3, 1, 1, 'Kawah Sikidang', 'Kawah aktif dengan asap belerang yang menari, jalur aman tersedia untuk wisatawan menikmati fenomena geologi ini.', 'Kawah Sikidang', 'Dieng Kulon, Batur, Banjarnegara, Jawa Tengah', '1752692350_thumb.jpg', '2025-07-16 11:59:10', '2025-07-16 12:15:11'),
(4, 1, 1, 'Bukit Sikunir', 'Spot favorit melihat golden sunrise dengan latar gunung-gunung megah di sekitar Dieng.', 'Bukit Sikunir', 'Desa Sembungan, Kejajar, Wonosobo, Jawa Tengah', '1752692433_thumb.jpg', '2025-07-16 12:00:33', '2025-07-16 12:00:33'),
(5, 1, 0, 'Batu Ratapan Angin', 'Tebing batu dengan pemandangan langsung ke Telaga Warna dan Telaga Pengilon dari ketinggian', 'Batu Ratapan Angin', 'Dieng Wetan, Kejajar, Wonosobo, Jawa Tengah', '1752692499_thumb.jpg', '2025-07-16 12:01:39', '2025-07-16 12:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `destination_content_section`
--

CREATE TABLE `destination_content_section` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `destination_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `detail` longtext DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destination_content_section`
--

INSERT INTO `destination_content_section` (`id`, `destination_id`, `title`, `detail`, `order`, `created_at`, `updated_at`) VALUES
(1, 2, 'Tambahan 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2025-07-16 12:31:29', '2025-07-16 12:31:29'),
(2, 2, 'Tambahan 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2, '2025-07-16 12:31:45', '2025-07-16 12:31:45'),
(3, 2, 'Tambahan 3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3, '2025-07-16 12:31:56', '2025-07-16 12:31:56');

-- --------------------------------------------------------

--
-- Table structure for table `destination_uniq`
--

CREATE TABLE `destination_uniq` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `destination_id` bigint(20) UNSIGNED NOT NULL,
  `uniq_title` varchar(255) NOT NULL,
  `uniq_sub_title` varchar(255) DEFAULT NULL,
  `uniq_image` varchar(255) NOT NULL,
  `uniq_detail` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_itinerary`
--

CREATE TABLE `detail_itinerary` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket_id` bigint(20) UNSIGNED NOT NULL,
  `day` tinyint(3) UNSIGNED NOT NULL,
  `time` varchar(10) NOT NULL,
  `detail` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_itinerary`
--

INSERT INTO `detail_itinerary` (`id`, `paket_id`, `day`, `time`, `detail`, `created_at`, `updated_at`) VALUES
(1, 11, 1, '01:24', 'Detail Kegiatan', '2025-07-16 11:24:28', '2025-07-16 11:24:28'),
(2, 11, 1, '01:27', 'Detail Kegiatan 2', '2025-07-16 11:24:45', '2025-07-16 11:24:45'),
(3, 11, 1, '02:24', 'Detail Kegiatan', '2025-07-16 11:24:56', '2025-07-16 11:24:56'),
(4, 11, 2, '03:25', 'Detail Kegiatan', '2025-07-16 11:25:07', '2025-07-16 11:25:07'),
(5, 11, 2, '03:30', 'Detail Kegiatan', '2025-07-16 11:25:18', '2025-07-16 11:25:18'),
(6, 11, 2, '03:35', 'Detail Kegiatan', '2025-07-16 11:25:41', '2025-07-16 11:25:41');

-- --------------------------------------------------------

--
-- Table structure for table `galery`
--

CREATE TABLE `galery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galery_img`
--

CREATE TABLE `galery_img` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `galery_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `tag_line` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `hero_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`id`, `title`, `tag_line`, `logo`, `hero_image`, `created_at`, `updated_at`) VALUES
(1, 'Lestari Wisata Dieng', 'Menjelajah Alam, Meresapi Budaya – Bersama Lestari Wisata Dieng', '1744538777_logo.png', '1744538777_hero.jpg', '2025-07-16 06:30:59', '2025-07-16 06:30:59');

-- --------------------------------------------------------

--
-- Table structure for table `legality`
--

CREATE TABLE `legality` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `home_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `legality`
--

INSERT INTO `legality` (`id`, `home_id`, `type`, `number`, `created_at`, `updated_at`) VALUES
(1, 1, 'NPWP', '25.105.951.5-615.000', '2025-07-16 06:30:59', '2025-07-16 06:30:59');

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
(1, '2025_04_05_183813_create_sessions_table', 1),
(2, '2025_04_05_184814_create_home_table', 1),
(3, '2025_04_06_121704_create_destination_table', 1),
(4, '2025_04_06_132314_create_destination_content_section_table', 1),
(5, '2025_04_08_213339_create_legality_table', 1),
(6, '2025_04_08_213402_create_socmed_table', 1),
(7, '2025_04_08_213415_create_contact_table', 1),
(8, '2025_04_13_165856_create_destination_uniq_table', 1),
(9, '2025_04_18_093725_create_paket_table', 1),
(10, '2025_04_18_172100_create_daftar_destinasi_table', 1),
(11, '2025_04_18_172246_create_daftar_destinasi_paket_table', 1),
(12, '2025_04_29_210228_create_daftar_fasilitas_table', 1),
(13, '2025_04_29_210324_create_daftar_fasilitas_paket_table', 1),
(14, '2025_05_03_182925_create_galery_table', 1),
(15, '2025_05_03_183504_create_galery_img_table', 1),
(16, '2025_07_01_135643_create_time_itinerary_table', 1),
(17, '2025_07_01_140623_create_day_itinerary_table', 1),
(18, '2025_07_01_141033_create_detail_itinerary_table', 1),
(19, '2025_07_10_131916_create_reviews_table', 1),
(20, '2025_07_12_165901_create_users_table', 1),
(21, '2025_07_16_235537_update_detail_itinerary_columns', 2),
(22, '2025_07_17_001504_drop_day_and_time_itinerary_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `home_id` bigint(20) UNSIGNED NOT NULL,
  `is_main_page` tinyint(1) NOT NULL DEFAULT 0,
  `paket_title` varchar(255) NOT NULL,
  `paket_sub_title_date` varchar(255) NOT NULL,
  `paket_price` int(11) NOT NULL,
  `paket_detail` varchar(255) DEFAULT NULL,
  `paket_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id`, `home_id`, `is_main_page`, `paket_title`, `paket_sub_title_date`, `paket_price`, `paket_detail`, `paket_image`, `created_at`, `updated_at`) VALUES
(8, 1, 0, 'et', '1 Day Trip', 1222, '30', '1745931617_paket.jpg', '2025-07-16 06:30:59', '2025-07-16 06:30:59'),
(11, 1, 1, 'paket4', '2 Day Trip', 2000000, '30', '1752634940_paket.jpg', '2025-07-16 06:30:59', '2025-07-16 06:30:59'),
(13, 1, 1, 'paket3', '1 Day Trip', 100, '20', '1752666178_paket.jpg', '2025-07-16 06:30:59', '2025-07-16 06:30:59');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `paket_id` bigint(20) UNSIGNED NOT NULL,
  `isi_review` text NOT NULL,
  `bintang` tinyint(3) UNSIGNED NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('BrcLs2uiCpWsdNtQus6fJ59aN7vZoEw3UqUbLzOa', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVjVyZUFiZUYyRXZzMkpReTV1eERFdkhNYjd3MVREOGVuaUZNM2dTTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZXN0aW5hc2ktaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1752695388);

-- --------------------------------------------------------

--
-- Table structure for table `socmed`
--

CREATE TABLE `socmed` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `home_id` bigint(20) UNSIGNED NOT NULL,
  `platform` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socmed`
--

INSERT INTO `socmed` (`id`, `home_id`, `platform`, `url`, `icon`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tiktok', 'https://www.tiktok.com/@lestariwisatadieng', 'ri-tiktok-line', '2025-07-16 06:30:59', '2025-07-16 06:30:59'),
(2, 1, 'Instagram', 'https://www.instagram.com/lestariwisatadieng/', 'ri-instagram-line', '2025-07-16 06:30:59', '2025-07-16 06:30:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin lwd', 'admin@lestariwisatadieng.com', '$2y$12$UqKcrocR.oAl.A/kEvKYye3jc6TU2muSZxmcib4hRV5rFlEOMVNq2', 'admin', 'fPXBxxiRe6', '2025-07-16 06:31:00', '2025-07-16 06:31:00'),
(2, 'bagus', 'solaybagus2@gmail.com', '$2y$12$9.eiwJ8oAWsCYe7Lza2Ic.C0IZq0lyhxn8ou6kHXRBcZHHhp8q5uW', 'user', NULL, '2025-07-16 06:33:45', '2025-07-16 06:33:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_home_id_foreign` (`home_id`);

--
-- Indexes for table `daftar_destinasi`
--
ALTER TABLE `daftar_destinasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_destinasi_paket`
--
ALTER TABLE `daftar_destinasi_paket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daftar_destinasi_paket_paket_id_foreign` (`paket_id`),
  ADD KEY `daftar_destinasi_paket_daftar_destinasi_id_foreign` (`daftar_destinasi_id`);

--
-- Indexes for table `daftar_fasilitas`
--
ALTER TABLE `daftar_fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_fasilitas_paket`
--
ALTER TABLE `daftar_fasilitas_paket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daftar_fasilitas_paket_paket_id_foreign` (`paket_id`),
  ADD KEY `daftar_fasilitas_paket_daftar_fasilitas_id_foreign` (`daftar_fasilitas_id`);

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destination_home_id_foreign` (`home_id`);

--
-- Indexes for table `destination_content_section`
--
ALTER TABLE `destination_content_section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destination_content_section_destination_id_foreign` (`destination_id`);

--
-- Indexes for table `destination_uniq`
--
ALTER TABLE `destination_uniq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destination_uniq_destination_id_foreign` (`destination_id`);

--
-- Indexes for table `detail_itinerary`
--
ALTER TABLE `detail_itinerary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_itinerary_paket_id_foreign` (`paket_id`);

--
-- Indexes for table `galery`
--
ALTER TABLE `galery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galery_img`
--
ALTER TABLE `galery_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galery_img_galery_id_foreign` (`galery_id`);

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `legality`
--
ALTER TABLE `legality`
  ADD PRIMARY KEY (`id`),
  ADD KEY `legality_home_id_foreign` (`home_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paket_home_id_foreign` (`home_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_paket_id_foreign` (`paket_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `socmed`
--
ALTER TABLE `socmed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `socmed_home_id_foreign` (`home_id`);

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
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `daftar_destinasi`
--
ALTER TABLE `daftar_destinasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `daftar_destinasi_paket`
--
ALTER TABLE `daftar_destinasi_paket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `daftar_fasilitas`
--
ALTER TABLE `daftar_fasilitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `daftar_fasilitas_paket`
--
ALTER TABLE `daftar_fasilitas_paket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `destination_content_section`
--
ALTER TABLE `destination_content_section`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `destination_uniq`
--
ALTER TABLE `destination_uniq`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_itinerary`
--
ALTER TABLE `detail_itinerary`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `galery`
--
ALTER TABLE `galery`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galery_img`
--
ALTER TABLE `galery_img`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `legality`
--
ALTER TABLE `legality`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `socmed`
--
ALTER TABLE `socmed`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_home_id_foreign` FOREIGN KEY (`home_id`) REFERENCES `home` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `daftar_destinasi_paket`
--
ALTER TABLE `daftar_destinasi_paket`
  ADD CONSTRAINT `daftar_destinasi_paket_daftar_destinasi_id_foreign` FOREIGN KEY (`daftar_destinasi_id`) REFERENCES `daftar_destinasi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `daftar_destinasi_paket_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `daftar_fasilitas_paket`
--
ALTER TABLE `daftar_fasilitas_paket`
  ADD CONSTRAINT `daftar_fasilitas_paket_daftar_fasilitas_id_foreign` FOREIGN KEY (`daftar_fasilitas_id`) REFERENCES `daftar_fasilitas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `daftar_fasilitas_paket_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `destination`
--
ALTER TABLE `destination`
  ADD CONSTRAINT `destination_home_id_foreign` FOREIGN KEY (`home_id`) REFERENCES `home` (`id`);

--
-- Constraints for table `destination_content_section`
--
ALTER TABLE `destination_content_section`
  ADD CONSTRAINT `destination_content_section_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destination` (`id`);

--
-- Constraints for table `destination_uniq`
--
ALTER TABLE `destination_uniq`
  ADD CONSTRAINT `destination_uniq_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destination` (`id`);

--
-- Constraints for table `detail_itinerary`
--
ALTER TABLE `detail_itinerary`
  ADD CONSTRAINT `detail_itinerary_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `galery_img`
--
ALTER TABLE `galery_img`
  ADD CONSTRAINT `galery_img_galery_id_foreign` FOREIGN KEY (`galery_id`) REFERENCES `galery` (`id`);

--
-- Constraints for table `legality`
--
ALTER TABLE `legality`
  ADD CONSTRAINT `legality_home_id_foreign` FOREIGN KEY (`home_id`) REFERENCES `home` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `paket`
--
ALTER TABLE `paket`
  ADD CONSTRAINT `paket_home_id_foreign` FOREIGN KEY (`home_id`) REFERENCES `home` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `socmed`
--
ALTER TABLE `socmed`
  ADD CONSTRAINT `socmed_home_id_foreign` FOREIGN KEY (`home_id`) REFERENCES `home` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
