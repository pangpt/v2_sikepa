-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 06, 2023 at 08:29 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sikepa`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('pegawai','ketua','sekretaris','panitera','kepegawaian','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$0g0eubOABGZ3ieLbUTnpreaXU2BY19rPc0hNqGBUo7exWWGs0K/Xm', 'admin', NULL, NULL, '2023-11-05 18:50:04', '2023-11-05 18:50:04'),
(2, '196712311993032018', '$2y$10$4dFjMdugqlO1URmQtBRruuvrUJzafmTEfeBUWVj0Q3rnmOf.aeI8m', 'ketua', NULL, NULL, '2023-11-05 18:51:43', '2023-11-05 18:51:43'),
(3, '197301311998022003', '$2y$10$OTDs3qf2lB3f7u2bnWFPpu1.WT5BOZBhl/QpoZgjNYa36C7.Ts5Ry', 'pegawai', NULL, NULL, '2023-11-05 18:54:09', '2023-11-05 18:54:09'),
(4, '196712101999032003', '$2y$10$CTe7k4NVl3Xl5fp/O0llrOOrsdKyVgQ97OW2nE4Umxzo5fwD2RSSG', 'sekretaris', NULL, NULL, '2023-11-05 19:06:37', '2023-11-05 19:06:37'),
(5, '196907181998031003', '$2y$10$RVZaGpPJHOtMTec99ItZNutCW0JqtXUCwi4ED6aG95qNZ3ra6uvam', 'panitera', NULL, NULL, '2023-11-05 19:08:21', '2023-11-05 19:08:21'),
(6, '196408201991031004', '$2y$10$gcyIjFAJJLHsehc06M3vxuZDV4Q81DzSuy/8pDze9xcYaCwAa.Gga', 'pegawai', NULL, NULL, '2023-11-05 19:09:12', '2023-11-05 19:09:12'),
(7, '196607211994032002', '$2y$10$047V0/H7Z7W5HqQ6ZGFFU.3ymkfB26vvm2EVSciJjKY9d6oqjVU5W', 'pegawai', NULL, NULL, '2023-11-05 19:10:30', '2023-11-05 19:10:30'),
(8, '195812311987031030', '$2y$10$4JIVGOXm2U3K4.58QHvXJO9DV98BcQJ0SDMruJdB3S6Oj8ggtP/KG', 'pegawai', NULL, NULL, '2023-11-05 19:11:06', '2023-11-05 19:11:06'),
(9, '195912311988031027', '$2y$10$566MdiwCDFnD.t6WonYyHeuTmjm//oBZSXJt/wgcDyJ9BGHXD6LMu', 'pegawai', NULL, NULL, '2023-11-05 19:11:42', '2023-11-05 19:11:42'),
(10, '196805111994032003', '$2y$10$WRdwyDeh1JwrIC4/D7mca.aoaeqYxwV72ACWbvVclzYUvcdqo2dse', 'pegawai', NULL, NULL, '2023-11-05 19:12:16', '2023-11-05 19:12:16'),
(11, '195812311985031051', '$2y$10$Ga4Ht4mId4BdgG6b7g1z5O3VPG4p96nri0rO6g5fpZZqAF1W0c7/2', 'pegawai', NULL, NULL, '2023-11-05 19:12:49', '2023-11-05 19:12:49'),
(12, '196112311991031014', '$2y$10$H/OZDb65p6f5h3ehfE5DA.YQb2wP7krPvMYIXB9aIB5Trn2ZFV8KW', 'pegawai', NULL, NULL, '2023-11-05 19:13:18', '2023-11-05 19:13:18'),
(13, '196911241994032004', '$2y$10$ZfE/Pwxe2kHdNQHowulk9.TvnRrjMOYg9qlYZEmTGIPpCe5jElCLq', 'pegawai', NULL, NULL, '2023-11-05 19:13:44', '2023-11-05 19:13:44'),
(14, '195812311982032021', '$2y$10$/tcJ/bYDQ4sbaxhSj2tXjugZdPWanWfr2yYZwm9CvL5tMPePaBeR2', 'pegawai', NULL, NULL, '2023-11-05 19:14:12', '2023-11-05 19:14:12'),
(15, '196507271994012001', '$2y$10$iFJmm/s5BaEwcWDlU.g.zusQyrN8PLoQOIDfm4OCiGi8EwJq7gSJa', 'pegawai', NULL, NULL, '2023-11-05 19:14:42', '2023-11-05 19:14:42'),
(16, '196602121994012001', '$2y$10$U9Sx9mYJQrhBu/48xXwSnebyEWXTkDiB00RC77ZJSYgnpS5hgJ.8y', 'pegawai', NULL, NULL, '2023-11-05 19:15:14', '2023-11-05 19:15:14'),
(17, '197009121992031004', '$2y$10$UEoyWvygrKJMKbGJK.JLre6zlcB7Pqso5XZPmV1HTlx4TAwSOU2eq', 'pegawai', NULL, NULL, '2023-11-05 19:15:59', '2023-11-05 19:15:59'),
(18, '197311052001121001', '$2y$10$D7qkT5vsZ1DYzqFIrj8TOOc9Ii5wiqhjmej30ueaj6aTh1y8JSnQ6', 'pegawai', NULL, NULL, '2023-11-05 19:16:38', '2023-11-05 19:16:38'),
(19, '196708011992031003', '$2y$10$5UylRulNgKvX1apahjmuMOuGF27FibfQ4r5.GsipMUCYLlqF0utzu', 'pegawai', NULL, NULL, '2023-11-05 19:17:15', '2023-11-05 19:17:15'),
(20, '198102052009012005', '$2y$10$t49oVkaZ/6HaRhQt9tYQcOuzdv5cNTBsFazMaQtyrhmqjCW58BwTq', 'pegawai', NULL, NULL, '2023-11-05 19:18:06', '2023-11-05 19:18:06'),
(21, '197807052002122001', '$2y$10$VxfX5Un34E.7RQ9Sr36.V.P3JzD2f.mONiARPQPOby06If84cyc.q', 'pegawai', NULL, NULL, '2023-11-05 19:18:38', '2023-11-05 19:18:38'),
(22, '196611271987032001', '$2y$10$J5XcJgWncry48TeNLS2et.KclQcNiHwUeHFceBenZOF/067nhMkuG', 'kepegawaian', NULL, NULL, '2023-11-05 19:41:53', '2023-11-05 19:41:53'),
(23, '197304051998031004', '$2y$10$4MKMuAtboIdUhNM28iiKuem7SmJC4xrpccsfglCElfgmafKMB.mpG', 'pegawai', NULL, NULL, '2023-11-05 19:42:29', '2023-11-05 19:42:29'),
(24, '196812312003122002', '$2y$10$gP9OlIGQ4axRlXleXOe4o.Yfs.wyQqY1.X.ULSERAyi2bUQNpe.7i', 'pegawai', NULL, NULL, '2023-11-05 19:42:59', '2023-11-05 19:42:59'),
(25, '196707282000122001', '$2y$10$2BWnszsoGnXStw9Gk7YtT.cqFX8DwGSE04CTGTt5xhtTF1FWQkvJe', 'pegawai', NULL, NULL, '2023-11-05 19:43:33', '2023-11-05 19:43:33'),
(26, '196704121994032002', '$2y$10$VyQyYuMLVLG1b4BZwaUeu.YJ7vWv9/IJHnmd2Ep5C7lMaFklz7xcu', 'pegawai', NULL, NULL, '2023-11-05 19:44:04', '2023-11-05 19:44:04'),
(27, '198209182009122003', '$2y$10$AxhyJxSpDRVgmJ1.MS7o7OqKEEPcGAIvoIgLVHIbGG2KxUZOb0MWS', 'pegawai', NULL, NULL, '2023-11-05 19:44:42', '2023-11-05 19:44:42'),
(28, '197410172001122002', '$2y$10$MgV/PoZPvJZCvDzNC.ysvOlrQcFZ.fgMHd8Yt22yjRZ/srnd/0Z6u', 'pegawai', NULL, NULL, '2023-11-05 19:54:01', '2023-11-05 19:54:01'),
(29, '198601232012122004', '$2y$10$CnUVo1XS9X6KNU8e.m2ThOlSVFCj.LquONr6IH75e.4F3aSvcFza2', 'pegawai', NULL, NULL, '2023-11-05 19:54:31', '2023-11-05 19:54:31'),
(30, '198910222012121001', '$2y$10$i9I3HVj43dYySb8Cc/Wgheb/qJszcaSAV8mK082pCpAVFg5v2bOni', 'pegawai', NULL, NULL, '2023-11-05 19:55:00', '2023-11-05 19:55:00'),
(31, '198308082014082001', '$2y$10$ao0.B7Bbn4czORztTRSkROidNyXI6vS/yeHpeJja0VrlaREqXvKQq', 'pegawai', NULL, NULL, '2023-11-05 19:55:35', '2023-11-05 19:55:35'),
(32, '197301012006041019', '$2y$10$RGMLQvFlP5rPoyzUAp5yX.1TQlXEjICF.CzkiZHJt7Bz9HyFkpo2q', 'pegawai', NULL, NULL, '2023-11-05 19:56:07', '2023-11-05 19:56:07'),
(33, '199007092009122001', '$2y$10$DuqNue4F2jhzbLTz3Wv6Y.DBJ0q8mSL7a5VXzic0NerIPgFffYN0a', 'pegawai', NULL, NULL, '2023-11-05 19:57:05', '2023-11-05 19:57:05'),
(34, '199609022020121004', '$2y$10$6Wv4xG0kcvjlREukpMH36u8FsUFaXAde1XgWTpI9b2a2mjSXU1HZG', 'pegawai', NULL, NULL, '2023-11-05 21:46:18', '2023-11-05 21:46:18'),
(35, '199504222022031006', '$2y$10$UT4lCi1onez0UpHFTXchyewgdqB.yg.JrUuzMRbfIg4FKPsSHlOTO', 'pegawai', NULL, NULL, '2023-11-05 21:46:48', '2023-11-05 21:46:48'),
(36, '199310092022031005', '$2y$10$2h2FNxmWHL9OiTCCa05v2Oo3aO.n83kaF1egytTQ5YT4hhRnZWn3O', 'pegawai', NULL, NULL, '2023-11-05 21:47:17', '2023-11-05 21:47:17'),
(37, '199608272022032015', '$2y$10$laaITFDOb52JDgE3L6DtUOknzIyWMxZ8e.1QcQjuhcHn9R13dV01u', 'pegawai', NULL, NULL, '2023-11-05 21:47:57', '2023-11-05 21:47:57'),
(38, '199008052022031004', '$2y$10$D5QiIHEtZspK1KpmWm/yF.p1Ckk/dTXFQyZBOCBxCBFepH/HuZQZK', 'pegawai', NULL, NULL, '2023-11-05 21:48:24', '2023-11-05 21:48:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
