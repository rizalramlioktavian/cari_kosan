-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 06 Bulan Mei 2024 pada 07.36
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cari_kosan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `applications`
--

CREATE TABLE `applications` (
  `id` bigint UNSIGNED NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('show','hide') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hide',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `applications`
--

INSERT INTO `applications` (`id`, `picture`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, '1713934413-1135763339-logo_playstore.jpg', '<p>Apilkasi di dalam genggaman</p>', '<p>Download di appstore dan playstore</p>', 'show', '2024-04-23 21:53:33', '2024-04-23 21:53:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `banks`
--

CREATE TABLE `banks` (
  `id` bigint UNSIGNED NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('show','hide') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hide',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `banks`
--

INSERT INTO `banks` (`id`, `picture`, `bank_name`, `bank_account_number`, `account_name`, `status`, `created_at`, `updated_at`) VALUES
(1, '1713940599-586751554-mandiri_icon.png', 'BNI', '1234567890', 'paijo sarwito', 'show', '2024-04-23 23:36:39', '2024-04-23 23:36:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cities`
--

CREATE TABLE `cities` (
  `id` bigint UNSIGNED NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('show','hide') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hide',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cities`
--

INSERT INTO `cities` (`id`, `picture`, `title`, `status`, `created_at`, `updated_at`) VALUES
(2, '1713934441-1768039101-bali.png', 'Palembang', 'show', '2024-04-23 21:54:01', '2024-04-23 23:21:39'),
(3, '1713934473-757894111-yogyakarta.png', 'Yogyakarta', 'show', '2024-04-23 21:54:33', '2024-04-23 21:54:33'),
(4, '1713934508-1244166816-makassar.png', 'Makassar', 'show', '2024-04-23 21:55:08', '2024-04-23 21:55:08'),
(5, '1713934523-2143587904-jakarta.png', 'Jakarta', 'show', '2024-04-23 21:55:23', '2024-04-23 21:55:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `heroes`
--

CREATE TABLE `heroes` (
  `id` bigint UNSIGNED NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('show','hide') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hide',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `heroes`
--

INSERT INTO `heroes` (`id`, `picture`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, '1713934055-1213004981-kosan1.jpg', '<h1>Temukan Kosan Impianmu</h1>', '<p>Cari kosan terbaik dengan mudah<br />cukup lewat handphone mu.</p>', 'show', '2024-04-23 21:47:35', '2024-05-05 23:59:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kosans`
--

CREATE TABLE `kosans` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` bigint NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kosan_facility` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `public_facility` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_facility` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kosans`
--

INSERT INTO `kosans` (`id`, `city_id`, `picture`, `title`, `slug`, `address`, `price`, `description`, `kosan_facility`, `public_facility`, `other_facility`, `created_at`, `updated_at`) VALUES
('9be1c569-00d1-4142-8ce3-2682b8468566', 2, '1713939819-973212592-kosan_ibu_ani.jpg', 'Kosan Ibu Ani Palembang', 'kosan-ibu-ani-palembang-palembang', '<p>Jalan Pangeran Ratu No. 23 Kecamatan Jakabaring Palembang</p>', '5000000', '<p>Lokasi strategis berada di jantung kota palembang, dekat dengan kampus uin raden fatah b, dan stasiun lrt polresta palembang</p>', '<p>Ac, Cctv, Parkir Motor Luas&nbsp;</p>', '<p>Dekat dengan kantor, statsiun lrt polresta</p>', '<p>Jam 10 sudah di kucni&nbsp;</p>', '2024-04-23 23:23:39', '2024-04-23 23:23:39'),
('9be1c614-c976-4b3c-81b7-aaa542de64c7', 2, '1713939931-930555150-kosan_pak_bambang.jpg', 'Kosan Pak Bambang Palembang', 'kosan-pak-bambang-palembang-palembang', '<p>Jalan Silaberanti No 25 Kec SU II Kota Palembang</p>', '6000000', '<p>Terletak di jantung kota palembang dan dekat dengan banyak kampus</p>', '<p>parkir motor, cctv 24 jam, free wifi</p>', '<p>parkir tamu maksimal 3 motor&nbsp;</p>', '<p>dekat dengan rumah makan dan tempat ibadah masjid&nbsp;</p>', '2024-04-23 23:25:31', '2024-05-05 19:55:52'),
('9be1c6e3-ad33-4d7a-b11b-fafaf022d7e0', 2, '1713940067-1056467033-kosan_ibu_vera.jpg', 'Kosan Ibu Vera Palembang', 'kosan-ibu-vera-palembang-palembang', '<p>Jl Banten No 13 Kec SU 2 Palembang</p>', '5000000', '<p>Kosan Murah tapi gak murahan&nbsp;</p>', '<p>parkir motor, dekat dengan masjid&nbsp;</p>', '<p>parkit motor tamu maksmila 3</p>', '<p>dekat rumah makan dengan harga murah</p>', '2024-04-23 23:27:47', '2024-05-05 19:57:54'),
('9be1c71f-6c32-4845-9342-cd2db1d0d95d', 2, '1713940106-1711033749-kosan_pelangi.jpg', 'Kosan Pelangi', 'kosan-pelangi-palembang', '<p>Jl Panca Usaha No 13&nbsp;</p>', '6000000', '<p>Dekat dengan kampus UIN Raden fatah B, dekat dengan stasiun lrt polresta</p>', '<p>parkr motor, keamanan 24 jam, cctv</p>', '<p>Prarkir Motor Tamu Maksimal 3 Motor</p>', '<p>Dekat dengan stasiun lrt polresta palembang, dekat denngan warung makan dengan harga yang terjangkau</p>', '2024-04-23 23:28:26', '2024-05-05 20:00:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(34, '2014_10_12_000000_create_users_table', 1),
(35, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(36, '2014_10_12_100000_create_password_resets_table', 1),
(37, '2019_08_19_000000_create_failed_jobs_table', 1),
(38, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(39, '2024_04_22_063004_create_cities_table', 1),
(40, '2024_04_23_024534_create_kosans_table', 1),
(41, '2024_04_23_045333_create_heroes_table', 1),
(42, '2024_04_23_054535_create_applications_table', 1),
(43, '2024_04_23_060446_create_promotions_table', 1),
(44, '2024_04_23_062056_create_orders_table', 1),
(45, '2024_04_23_063743_create_banks_table', 1),
(46, '2024_04_23_065233_create_ruangs_table', 1),
(47, '2024_04_25_075234_create_ratings_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `ruang_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_id` bigint NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` enum('Transfer Bank','OVO','GoPay','Dana','LinkAja','ShopeePay') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_sewa` timestamp NOT NULL,
  `total_sewa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('process','success') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'process',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `ruang_id`, `promo_id`, `name`, `phone`, `email`, `payment_method`, `tanggal_sewa`, `total_sewa`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '9bf1b3f8-82a6-469b-ae56-d1498eaa8962', 0, 'test', '123', 'test@mail.com', 'Transfer Bank', '2024-05-01 17:00:00', '2', '20000000', 'success', '2024-05-01 23:17:16', '2024-05-02 01:42:12'),
(2, 1, '9bf1c047-59af-4c90-b196-fc97bc822daf', 0, 'test1', '123', 'test1@mail.com', 'Transfer Bank', '2024-05-01 17:00:00', '4', '4000000', 'success', '2024-05-01 23:17:57', '2024-05-02 01:42:14'),
(3, 2, '9bf1b3f8-82a6-469b-ae56-d1498eaa8962', 0, 'User', '012345678', 'user@telnest.com', 'Transfer Bank', '2024-05-01 17:00:00', '2', '20000000', 'success', '2024-05-01 23:22:30', '2024-05-02 01:42:16'),
(4, 2, '9bf1b3f8-82a6-469b-ae56-d1498eaa8962', 0, 'User', '012345678', 'user@telnest.com', 'Transfer Bank', '2024-05-02 17:00:00', '1', '10000000', 'success', '2024-05-02 02:15:56', '2024-05-02 02:16:49'),
(5, 5, '9bf1f177-183a-45a7-aec7-d602d8112bdd', 0, 'doni salaman', '0812345', 'donisaputra@gmail.com', 'Transfer Bank', '2024-05-06 17:00:00', '3', '300000', 'success', '2024-05-05 23:56:34', '2024-05-06 00:04:46'),
(6, 5, '9bf2115e-827f-45fc-9012-a3c132346904', 1, 'doni wijaya', '0812345', 'donisaputra@gmail.com', 'Transfer Bank', '2024-05-07 17:00:00', '2', '2500000', 'process', '2024-05-06 00:07:20', '2024-05-06 00:07:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `promotions`
--

CREATE TABLE `promotions` (
  `id` bigint UNSIGNED NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('show','hide') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hide',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `promotions`
--

INSERT INTO `promotions` (`id`, `picture`, `title`, `discount`, `status`, `created_at`, `updated_at`) VALUES
(1, '1713934262-1933178242-diskon_limapuluh.jpg', 'disc_limapuluh', '50', 'show', '2024-04-23 21:51:02', '2024-05-06 00:00:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `kosan_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stars_rated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `kosan_id`, `stars_rated`, `comment`, `created_at`, `updated_at`) VALUES
(1, 2, '9be1c569-00d1-4142-8ce3-2682b8468566', '1', 'pelayanan buruk', '2024-05-02 02:17:08', '2024-05-02 02:17:08'),
(2, 5, '9be1c569-00d1-4142-8ce3-2682b8468566', '5', 'ibu nya baik hati sering ngasih makan', '2024-05-06 00:05:22', '2024-05-06 00:05:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangs`
--

CREATE TABLE `ruangs` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kosan_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `type_sewa` enum('Harian','Mingguan','Bulanan','Tahunan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_ruang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruang_facility` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ruangs`
--

INSERT INTO `ruangs` (`id`, `kosan_id`, `picture`, `title`, `slug`, `price`, `type_sewa`, `total_ruang`, `ruang_facility`, `created_at`, `updated_at`) VALUES
('9bf1b3f8-82a6-469b-ae56-d1498eaa8962', '9be1c569-00d1-4142-8ce3-2682b8468566', '1714624088-1431215218-kamar1.png', 'Deluxe Room', 'deluxe-room-kosan-ibu-ani-palembang-palembang', 10000000, 'Tahunan', '5', '<p>qqq</p>', '2024-05-01 21:28:08', '2024-05-01 23:11:50'),
('9bf1c047-59af-4c90-b196-fc97bc822daf', '9be1c569-00d1-4142-8ce3-2682b8468566', '1714626153-545726410-kamar2.png', 'Super Room', 'super-room-kosan-ibu-ani-palembang-palembang', 1000000, 'Mingguan', '5', '<p>qqqq</p>', '2024-05-01 22:02:33', '2024-05-01 22:02:33'),
('9bf1f177-183a-45a7-aec7-d602d8112bdd', '9be1c569-00d1-4142-8ce3-2682b8468566', '1714634405-1549645430-kamar1.png', 'Minimalis', 'minimalis-kosan-ibu-ani-palembang-palembang', 100000, 'Harian', '5', '<p>qqq</p>', '2024-05-02 00:20:05', '2024-05-02 00:20:05'),
('9bf2115e-827f-45fc-9012-a3c132346904', '9be1c569-00d1-4142-8ce3-2682b8468566', '1714639757-680490191-kamar1.png', 'Minimal', 'minimal-kosan-ibu-ani-palembang-palembang', 2500000, 'Bulanan', '5', '<p>qqq</p>', '2024-05-02 01:49:17', '2024-05-02 01:49:17'),
('9bf9f797-c6d0-40c4-9a67-2c10fe126bae', '9be1c614-c976-4b3c-81b7-aaa542de64c7', '1714979030-992269405-masalah eror login.jpg', 'weerr', 'weerr-kosan-pak-bambang-palembang-palembang', 100000, 'Harian', '5', '<p>Tempat Parkir Motor Luas</p>', '2024-05-06 00:03:50', '2024-05-06 00:03:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `email_verified_at`, `password`, `picture`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '0123456789', 'admin@localhost.com', NULL, '$2y$10$5nYlEtl8zrwijpAHE8yrwevUTDfvPT0.Fkxf7gAch5FJJpqw4K.WG', NULL, 1, NULL, NULL, NULL),
(2, 'User', '012345678', 'user@telnest.com', NULL, '$2y$10$9b39UBKrkeIC9udEnlmeTe3ls3zbgSCdl0GRXCfbgX30yFTeourCy', NULL, 0, NULL, NULL, NULL),
(3, 'doni wijaya', '01234567889', 'doniwijaya@gmail.com', NULL, '$2y$10$phlb067nlMKJMJXwx/fJ8umen0Xmu5bf1gv/DkakTfmAAd0Vs25xK', NULL, 0, NULL, '2024-04-24 23:53:33', '2024-04-24 23:53:33'),
(4, 'alex montel', '081234567890', 'alexmontel@gmail.com', NULL, '$2y$10$wGJjVPPHdJUSylKt8zG5AOxVnNVAHvv6yC8/rUU2Mp1vHI9KLCu0m', NULL, 0, NULL, '2024-04-28 23:20:13', '2024-04-28 23:20:13'),
(5, 'doni wijaya', '0812345', 'donisaputra@gmail.com', NULL, '$2y$10$JUtdo2dRKEchdVzgq6xeHONGpBZToyeL3OmK7ya1PYcIlG.JOCP0a', NULL, 0, NULL, '2024-05-05 23:52:25', '2024-05-05 23:52:25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `heroes`
--
ALTER TABLE `heroes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kosans`
--
ALTER TABLE `kosans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kosans_slug_unique` (`slug`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ruangs`
--
ALTER TABLE `ruangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ruangs_slug_unique` (`slug`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `heroes`
--
ALTER TABLE `heroes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
