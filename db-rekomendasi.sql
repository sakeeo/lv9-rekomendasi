-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2022 at 10:04 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-rekomendasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2022_07_21_155537_create_instansis_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_attachement_rekomendasi`
--

CREATE TABLE `tb_attachement_rekomendasi` (
  `id` int(11) NOT NULL,
  `rekomendasi_id` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_instansi`
--

CREATE TABLE `tb_instansi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_instansi`
--

INSERT INTO `tb_instansi` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'SEKRETARIAT DAERAN', '2022-07-21 16:01:24', '2022-07-21 16:01:24'),
(2, 'BIRO TATA PEMERINTAHAN', '2022-07-21 16:01:24', '2022-07-21 16:01:24'),
(3, 'BIRO HUKUM', '2022-07-21 16:01:24', '2022-07-21 16:01:24'),
(4, 'BIRO ORGANISASI', '2022-07-21 16:01:24', '2022-07-21 16:01:24');

-- --------------------------------------------------------

--
-- Table structure for table `tb_permohonan`
--

CREATE TABLE `tb_permohonan` (
  `id` int(11) NOT NULL,
  `nama_sistem_eletronik` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` enum('Submitted','Activated','Approved','Rejected','Draft','Suspended','Pending') DEFAULT 'Draft',
  `tipe` enum('Rekomendasi','Subdomain Dan Hosting') DEFAULT 'Rekomendasi',
  `ttd` enum('y','n') DEFAULT 'n',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `no_surat` varchar(255) DEFAULT NULL,
  `estimasi_biaya` bigint(20) DEFAULT NULL,
  `instansi` varchar(255) DEFAULT NULL,
  `nama_kepala_dinas` varchar(255) DEFAULT NULL,
  `nip_kepala_dinas` varchar(255) DEFAULT NULL,
  `deskripsi_investasi` varchar(255) DEFAULT NULL,
  `kondisi_sekarang` varchar(255) DEFAULT NULL,
  `kondisi_diharapkan` varchar(255) DEFAULT NULL,
  `manfaat_aplikasi` varchar(255) DEFAULT NULL,
  `fitur_aplikasi` varchar(255) DEFAULT NULL,
  `kebutuhan_data` varchar(255) DEFAULT NULL,
  `kontak_pic` varchar(255) DEFAULT NULL,
  `ruang_lingkup_aplikasi` varchar(255) DEFAULT NULL,
  `bidang` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_permohonan`
--

INSERT INTO `tb_permohonan` (`id`, `nama_sistem_eletronik`, `user_id`, `status`, `tipe`, `ttd`, `created_at`, `updated_at`, `no_surat`, `estimasi_biaya`, `instansi`, `nama_kepala_dinas`, `nip_kepala_dinas`, `deskripsi_investasi`, `kondisi_sekarang`, `kondisi_diharapkan`, `manfaat_aplikasi`, `fitur_aplikasi`, `kebutuhan_data`, `kontak_pic`, `ruang_lingkup_aplikasi`, `bidang`) VALUES
(1, 'APLIKASI PENJUALAN', 1002, 'Submitted', 'Rekomendasi', 'n', '2022-07-22 10:08:15', '2022-07-25 05:15:45', '121122/4545', 21221, 'BIRO HUKUM', 'AMIR KHAN', '1121212121212', 'Aplikasi pengelolaan Data Pegawai', 'Tidak ada', 'Ada aplikasinya', 'ya begitu deh', 'Banyak Pokoknya', 'banyak', '2222222222', 'Public dan Internal', 'sayembara');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instansi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','client') COLLATE utf8mb4_unicode_ci DEFAULT 'admin',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `nip`, `instansi`, `role`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Lim', 'Salim', 'sasasasasa', 'BIRO ORGANISASI', 'admin', 'muhammadliem@gmail.com', NULL, '$2y$10$/AfZEc9ADbmPhW5InrkRnu2.wxmejjqtodnazjvrItJqhgRnM5uMG', NULL, NULL, NULL, '2022-07-21 00:32:55', '2022-07-22 08:00:48'),
(1002, 'BIRO HUKUM', 'BIRO HUKUM', '12345678', 'BIRO HUKUM', 'client', 'hukum@gmail.com', NULL, '$2y$10$ztiNS1mHm71gYtG2AQBWouMYaU.U6eaMcZSvWt0HYs./27hdv0ccm', NULL, NULL, NULL, '2022-07-22 08:09:06', '2022-07-22 08:09:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `tb_attachement_rekomendasi`
--
ALTER TABLE `tb_attachement_rekomendasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_instansi`
--
ALTER TABLE `tb_instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_permohonan`
--
ALTER TABLE `tb_permohonan`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_instansi`
--
ALTER TABLE `tb_instansi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_permohonan`
--
ALTER TABLE `tb_permohonan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
