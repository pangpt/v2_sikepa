-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 06, 2023 at 08:33 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sikepa`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `atasan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `golongan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmt` date DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `department_id`, `atasan_id`, `golongan_id`, `nama`, `nip`, `alamat`, `jenis_kelamin`, `email`, `phone`, `tmt`, `tanggal_lahir`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, 10, 'Dra. Hj. HERIYAH, S.H., M.H.', '196712311993032018', 'Bone', NULL, 'heriyash@mahkamahagung.go.id', '000000', '2022-08-31', NULL, '2023-11-05 18:51:43', '2023-11-05 18:51:43'),
(2, 3, 2, NULL, 9, 'HADRAWATI, S.Ag., M.H.I.', '197301311998022003', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2022-12-07', NULL, '2023-11-05 18:54:09', '2023-11-05 18:54:09'),
(3, 4, 3, NULL, 8, 'MUNIROH NAHDI, S.H., M.H.', '196712101999032003', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2022-08-15', NULL, '2023-11-05 19:06:37', '2023-11-05 19:06:37'),
(4, 5, 4, NULL, 7, 'LUKMAN PATAWARI, S.H.', '196907181998031003', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2022-12-07', NULL, '2023-11-05 19:08:21', '2023-11-05 19:08:21'),
(5, 6, 5, NULL, 10, 'Drs. H. ABD. JABBAR, M.H.', '196408201991031004', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2022-01-28', NULL, '2023-11-05 19:09:12', '2023-11-05 19:09:12'),
(6, 7, 5, NULL, 10, 'Dra. SITTI JOHAR, M.H.', '196607211994032002', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2022-08-29', NULL, '2023-11-05 19:10:30', '2023-11-05 19:10:30'),
(7, 8, 5, NULL, 10, 'Drs. H. M. TANG, M.H.', '195812311987031030', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2019-05-28', NULL, '2023-11-05 19:11:06', '2023-11-05 19:11:06'),
(8, 9, 5, NULL, 10, 'Drs. DASRI AKIL, S.H.', '195912311988031027', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2019-05-28', '1959-12-31', '2023-11-05 19:11:42', '2023-11-05 22:21:34'),
(9, 10, 5, NULL, 10, 'Dra. Hj. MUSABBIHAH, S.H., M.H.', '196805111994032003', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2023-09-12', NULL, '2023-11-05 19:12:16', '2023-11-05 19:12:16'),
(10, 11, 5, NULL, 10, 'Drs. H. IDRIS, M.H.I.', '195812311985031051', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2022-02-25', NULL, '2023-11-05 19:12:49', '2023-11-05 19:12:49'),
(11, 12, 5, NULL, 10, 'Drs. M. YUNUS K., S.H., M.H.', '196112311991031014', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2022-12-07', NULL, '2023-11-05 19:13:18', '2023-11-05 19:13:18'),
(12, 13, 5, NULL, 10, 'Dra. Hj. SITTI HUSNAENAH, M.H.', '196911241994032004', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2023-02-21', NULL, '2023-11-05 19:13:44', '2023-11-05 19:13:44'),
(13, 14, 5, NULL, 10, 'Dra. Hj. BADRIYAH, S.H.', '195812311982032021', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2021-08-27', NULL, '2023-11-05 19:14:12', '2023-11-05 19:14:12'),
(14, 15, 5, NULL, 10, 'Dra. Hj. WARNI, M.H.', '196507271994012001', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2022-02-11', NULL, '2023-11-05 19:14:42', '2023-11-05 19:14:42'),
(15, 16, 5, NULL, 10, 'Dra. Hj. SITTI AMIRAH', '196602121994012001', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2020-11-03', NULL, '2023-11-05 19:15:14', '2023-11-05 19:15:14'),
(16, 17, 8, NULL, 6, 'BINTANG, S.H.', '197009121992031004', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2020-11-03', NULL, '2023-11-05 19:15:59', '2023-11-05 19:15:59'),
(17, 18, 7, NULL, 6, 'ANDI SUARDI, S. Ag.', '197311052001121001', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2022-08-15', NULL, '2023-11-05 19:16:38', '2023-11-05 19:16:38'),
(18, 19, 6, NULL, 6, 'HAYAD JUSA, S.Ag.', '196708011992031003', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2022-07-25', NULL, '2023-11-05 19:17:15', '2023-11-05 19:17:15'),
(19, 20, 9, NULL, 7, 'NINIK HARTINI MANSYUR, S.H., M.H.', '198102052009012005', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2023-05-04', NULL, '2023-11-05 19:18:06', '2023-11-05 19:18:06'),
(20, 21, 10, NULL, 7, 'NURHIDAYAH, S.Ag., M.H.', '197807052002122001', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2017-03-06', NULL, '2023-11-05 19:18:38', '2023-11-05 19:18:38'),
(21, 22, 11, NULL, 6, 'Hj. ASMAH, S.H.', '196611271987032001', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2017-03-06', NULL, '2023-11-05 19:41:53', '2023-11-05 19:41:53'),
(22, 23, 12, NULL, 7, 'HARIS, S.H.I., M.Sy.', '197304051998031004', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2017-11-16', NULL, '2023-11-05 19:42:29', '2023-11-05 19:42:29'),
(23, 24, 12, NULL, 6, 'Dra. Hj. SAMSANG', '196812312003122002', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2016-11-29', NULL, '2023-11-05 19:42:59', '2023-11-05 19:42:59'),
(24, 25, 12, NULL, 6, 'SITI JAMILA, S.H.', '196707282000122001', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2013-08-23', NULL, '2023-11-05 19:43:33', '2023-11-05 19:43:33'),
(25, 26, 12, NULL, 6, 'Dra. Hj. ROSMINI', '196704121994032002', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2011-05-05', NULL, '2023-11-05 19:44:04', '2023-11-05 19:44:04'),
(26, 27, 12, NULL, 6, 'Hj. NAIMAH NURDIN, Lc., S.HI., M.Th.I.', '198209182009122003', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2020-03-16', NULL, '2023-11-05 19:44:42', '2023-11-05 19:44:42'),
(27, 28, 12, NULL, 6, 'Hj. FITRIANI, S.Ag.', '197410172001122002', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2021-05-31', NULL, '2023-11-05 19:54:01', '2023-11-05 19:54:01'),
(28, 29, 12, NULL, 5, 'MARYATI M, S.H.', '198601232012122004', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2022-07-25', NULL, '2023-11-05 19:54:31', '2023-11-05 19:54:31'),
(29, 30, 12, NULL, 5, 'ASRIL AMRAH, S.H.I.', '198910222012121001', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2023-03-21', NULL, '2023-11-05 19:55:00', '2023-11-05 19:55:00'),
(30, 31, 12, NULL, 4, 'AGUSTIAWATI, S.E., S.H.', '198308082014082001', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2023-03-21', NULL, '2023-11-05 19:55:35', '2023-11-05 19:55:35'),
(31, 32, 13, NULL, 6, 'MUHAMMAD SYAHRANI, S.H.', '197301012006041019', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2016-08-09', NULL, '2023-11-05 19:56:07', '2023-11-05 19:56:07'),
(32, 33, 13, NULL, 5, 'RIDMAJAYANTI, S.Sos.', '199007092009122001', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2023-03-01', NULL, '2023-11-05 19:57:05', '2023-11-05 19:57:05'),
(33, 34, 14, NULL, 3, 'PANGGIH TRIDARMA, S.Kom.', '199609022020121004', 'Sesuaikan dengan data SIKEP', NULL, 'panggihtridarma@mahkamahagung.go.id', '000000', '2022-08-26', '1996-09-02', '2023-11-05 21:46:18', '2023-11-05 23:52:49'),
(34, 35, 15, NULL, 3, 'NUR FAUZI RADLIATUL FATAH, S.H.', '199504222022031006', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2923-03-01', NULL, '2023-11-05 21:46:48', '2023-11-05 21:46:48'),
(35, 36, 15, NULL, 3, 'FATHUR RAZAK, S.Sy.', '199310092022031005', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2023-03-01', NULL, '2023-11-05 21:47:17', '2023-11-05 21:47:17'),
(36, 37, 16, NULL, 1, 'WAHYUNI ISFA AULIA, A.Md', '199608272022032015', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2023-03-01', NULL, '2023-11-05 21:47:57', '2023-11-05 21:47:57'),
(37, 38, 18, NULL, 3, 'BREEND BENNY DHARMAWAN, S.E.', '199008052022031004', 'Sesuaikan dengan data SIKEP', NULL, 'isikan@mahkamahagung.go.id', '000000', '2023-03-01', NULL, '2023-11-05 21:48:24', '2023-11-05 21:48:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
