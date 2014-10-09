-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2014 at 08:33 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `diklat`
--

-- --------------------------------------------------------

--
-- Table structure for table `memos`
--

CREATE TABLE IF NOT EXISTS `memos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomor_memo` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `nama_memo` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('public','inhouse') COLLATE utf8_unicode_ci NOT NULL,
  `karakter` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `lama` int(11) NOT NULL,
  `anggaran` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `_token` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `status_memo` int(11) NOT NULL,
  `memo` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_rbb` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `memos_id_rbb_foreign` (`id_rbb`),
  KEY `memos_id_user_foreign` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `memos`
--

INSERT INTO `memos` (`id`, `nomor_memo`, `nama_memo`, `keterangan`, `tanggal`, `status`, `karakter`, `jumlah`, `lama`, `anggaran`, `created_at`, `updated_at`, `_token`, `status_memo`, `memo`, `id_rbb`, `id_user`) VALUES
(1, '123/123/123', 'aslfas', 'asdfasfsa', '2014-10-16', 'public', '123', 321, 321, 321, '2014-10-07 01:38:16', '2014-10-07 01:47:32', '', 0, 'NIfjHfCNZcr2RtOo9WGkIyGu0G9HVRYT.pdf', 1, 1),
(2, '123.123.123', 'fjdaksfj', '', '2014-10-16', 'public', 'G1 G2 G3', 123, 123, 123, '2014-10-07 02:24:47', '2014-10-08 02:36:08', '', 1, NULL, 1, 4),
(3, '3212313212', 'hehey', 'sadfa', '2014-10-24', 'public', 'G1 G2 G3', 123, 123, 123, '2014-10-09 01:00:01', '2014-10-09 01:00:45', '', 1, NULL, 1, 4),
(4, 'yyyyyy', 'fjdksasf', '12312', '2014-10-18', 'public', '1123', 321, 321, 321, '2014-10-09 01:16:35', '2014-10-09 01:16:35', '', 0, NULL, 1, 4),
(5, '3213123213', 'fdadfas', '', '2014-10-22', 'public', 'G1 G2 G3', 13, 123, 12, '2014-10-09 01:39:28', '2014-10-09 01:39:28', '', 0, NULL, 1, 4),
(6, 'jkdflafj', 'ljfdklasjfkl', 'Memo untuk blablablabla ', '2014-10-24', 'public', 'G1 G2 G3', 321, 123, 321, '2014-10-09 01:51:02', '2014-10-09 03:29:26', '', 1, 'Ag7Q7jNYsNeD5UN0UWtEY1HFFhe1YKjq.pdf', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `memo_comments`
--

CREATE TABLE IF NOT EXISTS `memo_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user` int(10) unsigned NOT NULL,
  `id_memo` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `memo_comments_id_user_foreign` (`id_user`),
  KEY `memo_comments_id_memo_foreign` (`id_memo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `memo_comments`
--

INSERT INTO `memo_comments` (`id`, `comment`, `created_at`, `updated_at`, `id_user`, `id_memo`) VALUES
(1, 'huhuy', '2014-10-07 02:21:06', '2014-10-07 02:21:06', 2, 1),
(2, 'hehey', '2014-10-07 02:30:37', '2014-10-07 02:30:37', 4, 1),
(3, 'woooho', '2014-10-08 00:56:34', '2014-10-08 00:56:34', 1, 2),
(4, 'di tolak', '2014-10-08 02:17:45', '2014-10-08 02:17:45', 2, 2),
(5, 'okay', '2014-10-08 02:19:22', '2014-10-08 02:19:22', 4, 2),
(6, 'wooohoooy', '2014-10-08 02:35:42', '2014-10-08 02:35:42', 2, 2),
(7, 'wooho', '2014-10-08 09:43:32', '2014-10-08 09:43:32', 4, 2),
(8, 'wooooho', '2014-10-08 09:44:32', '2014-10-08 09:44:32', 4, 2),
(9, 'sadfas', '2014-10-08 09:47:35', '2014-10-08 09:47:35', 4, 2),
(10, 'wooohoooo', '2014-10-08 09:49:11', '2014-10-08 09:49:11', 2, 2),
(11, 'wohoooo', '2014-10-09 00:47:19', '2014-10-09 00:47:19', 4, 2),
(12, 'wooohoooo', '2014-10-09 00:53:38', '2014-10-09 00:53:38', 1, 2),
(13, 'hohoy', '2014-10-09 00:54:17', '2014-10-09 00:54:17', 4, 2),
(14, 'hhey', '2014-10-09 00:54:59', '2014-10-09 00:54:59', 2, 2),
(15, 'hhhhhhhey', '2014-10-09 00:55:38', '2014-10-09 00:55:38', 4, 2),
(16, 'huhuy', '2014-10-09 00:56:21', '2014-10-09 00:56:21', 2, 2),
(17, 'yeay', '2014-10-09 01:07:05', '2014-10-09 01:07:05', 2, 3),
(18, 'wooooohoooy', '2014-10-09 01:11:11', '2014-10-09 01:11:11', 2, 3),
(20, 'yeeeeeeeeeeeeeeeeeeeeee', '2014-10-09 01:27:00', '2014-10-09 01:27:00', 2, 2),
(23, 'sdfafdas', '2014-10-09 01:34:37', '2014-10-09 01:34:37', 2, 4),
(24, 'dfsasdf', '2014-10-09 01:38:00', '2014-10-09 01:38:00', 4, 4),
(25, 'fdsafasd', '2014-10-09 01:38:34', '2014-10-09 01:38:34', 2, 4),
(31, 'wihi', '2014-10-09 01:49:50', '2014-10-09 01:49:50', 2, 5),
(35, 'asdfsa', '2014-10-09 02:39:39', '2014-10-09 02:39:39', 1, 6),
(36, 'woho', '2014-10-09 02:40:21', '2014-10-09 02:40:21', 4, 6),
(37, 'asdfsa', '2014-10-09 02:42:39', '2014-10-09 02:42:39', 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_09_07_123406_create_users', 1),
('2014_09_07_134708_add_token_to_user', 2),
('2014_09_08_050136_add_memo_token', 3),
('2014_09_08_074326_add_memo_to_memos', 4),
('2014_09_19_030657_notification_table', 5),
('2014_09_19_122600_data_pegawai', 5),
('2014_10_03_011636_status_memo', 5),
('2014_10_03_074648_memo_nullable', 6),
('2014_10_07_075527_relationship_fixed', 7),
('2014_10_08_064517_notif', 8),
('2014_10_08_065639_timestamps_notif', 9),
('2014_10_08_070948_status_nullable', 10);

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE IF NOT EXISTS `notif` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_from` int(10) unsigned NOT NULL,
  `obj` int(10) unsigned NOT NULL,
  `id_memo` int(10) unsigned NOT NULL,
  `id_to` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `notif_id_from_foreign` (`id_from`),
  KEY `notif_id_memo_foreign` (`id_memo`),
  KEY `notif_id_to_foreign` (`id_to`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`id`, `id_from`, `obj`, `id_memo`, `id_to`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 50, 2, 4, '2014-10-08 00:57:38', '2014-10-08 01:34:31', 1),
(2, 2, 1, 2, 4, '2014-10-08 02:03:44', '2014-10-08 02:13:34', 1),
(3, 1, 2, 2, 4, '2014-10-08 02:16:29', '2014-10-08 02:17:00', 1),
(4, 2, 3, 2, 4, '2014-10-08 02:17:30', '2014-10-08 02:19:13', 1),
(5, 2, 50, 2, 4, '2014-10-08 02:17:45', '2014-10-08 02:19:13', 1),
(6, 2, 50, 2, 4, '2014-10-08 02:35:42', '2014-10-08 02:37:25', 1),
(7, 1, 1, 2, 4, '2014-10-08 02:36:08', '2014-10-08 02:37:25', 1),
(8, 2, 50, 2, 4, '2014-10-08 09:49:11', '2014-10-09 00:33:05', 1),
(9, 4, 50, 2, 1, '2014-10-09 00:47:19', '2014-10-09 00:48:44', 1),
(10, 4, 50, 2, 2, '2014-10-09 00:47:19', '2014-10-09 00:47:51', 1),
(11, 4, 50, 2, 2, '2014-10-09 00:47:19', '2014-10-09 00:47:51', 1),
(12, 4, 50, 2, 2, '2014-10-09 00:47:19', '2014-10-09 00:47:51', 1),
(13, 1, 50, 2, 2, '2014-10-09 00:53:38', '2014-10-09 00:54:50', 1),
(14, 1, 50, 2, 4, '2014-10-09 00:53:38', '2014-10-09 00:54:07', 1),
(15, 4, 50, 2, 1, '2014-10-09 00:54:17', '2014-10-09 00:57:02', 1),
(16, 4, 50, 2, 2, '2014-10-09 00:54:17', '2014-10-09 00:54:50', 1),
(17, 2, 50, 2, 1, '2014-10-09 00:54:59', '2014-10-09 00:57:02', 1),
(18, 2, 50, 2, 4, '2014-10-09 00:54:59', '2014-10-09 00:55:30', 1),
(19, 4, 50, 2, 1, '2014-10-09 00:55:39', '2014-10-09 00:57:02', 1),
(20, 4, 50, 2, 2, '2014-10-09 00:55:39', '2014-10-09 00:56:09', 1),
(21, 2, 50, 2, 1, '2014-10-09 00:56:21', '2014-10-09 00:57:02', 1),
(22, 2, 50, 2, 4, '2014-10-09 00:56:21', '2014-10-09 00:59:22', 1),
(23, 2, 1, 3, 4, '2014-10-09 01:00:45', '2014-10-09 01:11:45', 1),
(24, 2, 50, 2, 1, '2014-10-09 01:27:00', '2014-10-09 01:53:27', 1),
(25, 2, 50, 2, 4, '2014-10-09 01:27:00', '2014-10-09 01:27:27', 1),
(26, 4, 50, 4, 2, '2014-10-09 01:38:00', '2014-10-09 01:38:28', 1),
(27, 2, 50, 4, 4, '2014-10-09 01:38:34', '2014-10-09 01:39:00', 1),
(28, 4, 50, 5, 4, '2014-10-09 01:39:41', '2014-10-09 01:39:42', 1),
(29, 2, 50, 5, 4, '2014-10-09 01:40:12', '2014-10-09 01:40:43', 1),
(30, 2, 50, 5, 4, '2014-10-09 01:45:58', '2014-10-09 01:49:03', 1),
(31, 2, 50, 5, 4, '2014-10-09 01:47:16', '2014-10-09 01:49:03', 1),
(32, 2, 50, 5, 4, '2014-10-09 01:47:33', '2014-10-09 01:49:03', 1),
(33, 2, 50, 5, 4, '2014-10-09 01:47:59', '2014-10-09 01:49:03', 1),
(34, 2, 50, 5, 4, '2014-10-09 01:48:14', '2014-10-09 01:49:03', 1),
(35, 2, 50, 5, 4, '2014-10-09 01:49:50', '2014-10-09 01:50:40', 1),
(36, 2, 50, 6, 4, '2014-10-09 01:51:44', '2014-10-09 01:52:18', 1),
(37, 1, 50, 6, 2, '2014-10-09 01:53:54', '2014-10-09 01:54:22', 1),
(38, 4, 50, 6, 2, '2014-10-09 02:38:36', '2014-10-09 02:42:32', 1),
(39, 4, 50, 6, 1, '2014-10-09 02:38:37', '2014-10-09 02:39:08', 1),
(40, 1, 50, 6, 4, '2014-10-09 02:39:39', '2014-10-09 02:40:12', 1),
(41, 4, 50, 6, 1, '2014-10-09 02:40:21', '2014-10-09 02:47:02', 1),
(42, 2, 50, 6, 1, '2014-10-09 02:42:39', '2014-10-09 02:47:02', 1),
(43, 2, 50, 6, 4, '2014-10-09 02:42:39', '2014-10-09 02:47:45', 1),
(44, 1, 1, 6, 4, '2014-10-09 02:47:08', '2014-10-09 02:47:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rbbs`
--

CREATE TABLE IF NOT EXISTS `rbbs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rbb` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `rbbs`
--

INSERT INTO `rbbs` (`id`, `rbb`, `created_at`, `updated_at`) VALUES
(1, 'asd', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `access` int(11) NOT NULL DEFAULT '1',
  `avatar` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.png',
  `remember_token` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `_token` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `email`, `password`, `access`, `avatar`, `remember_token`, `created_at`, `updated_at`, `_token`) VALUES
(1, 'admin', 'admin', '', '$2y$10$IIbPet5YSkoxhL1ljSlOzOcDtvZRK53ZaNRajmkqu2jmiaC1Pg7ue', 99, 'default.png', 'MG42o0uA6x3QpE4JL6udFc8ptNxWnS7pXMNlBX2EWPIJnEebGGlXnMzxIeKb', '2014-10-07 01:36:08', '2014-10-09 02:47:18', ''),
(2, 'pingroup', 'Pimpinan Group', '', '$2y$10$M5fXcr2zxnoIQXpYCZnadeRwM.aWsow4HTg8YyD.q9tLyG0Av563O', 2, 'default.png', 'QFypbMLp5UpnMh2FxW0a4M0fk6NeJtaUWrSptToJxDrZ3KcGzJcFaGfJy26Y', '2014-10-07 02:13:14', '2014-10-09 02:42:47', ''),
(4, 'pp', 'Pengembangan Pegawai', '', '$2y$10$EmeYOe7CdoWUWahZ0b9Lquw24HwpMrzWRaSjI3K/CZh0H6l1SK5Fm', 1, 'PlqKeHzQF3KaOwjnzm1kv4SWZNpv4lCo.jpeg', '1YMqCI2COzw0ehhwSvalMK1iIGDQV4YoKL8G9tQbD4otIiZybWi0fl1jqBIO', '2014-10-07 02:14:09', '2014-10-09 04:03:48', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `memos`
--
ALTER TABLE `memos`
  ADD CONSTRAINT `memos_id_rbb_foreign` FOREIGN KEY (`id_rbb`) REFERENCES `rbbs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `memos_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `memo_comments`
--
ALTER TABLE `memo_comments`
  ADD CONSTRAINT `memo_comments_id_memo_foreign` FOREIGN KEY (`id_memo`) REFERENCES `memos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `memo_comments_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notif`
--
ALTER TABLE `notif`
  ADD CONSTRAINT `notif_id_from_foreign` FOREIGN KEY (`id_from`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notif_id_memo_foreign` FOREIGN KEY (`id_memo`) REFERENCES `memos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notif_id_to_foreign` FOREIGN KEY (`id_to`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
