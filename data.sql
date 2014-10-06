-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2014 at 04:26 AM
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
  `id_rbb` int(11) NOT NULL,
  `status` enum('public','inhouse') COLLATE utf8_unicode_ci NOT NULL,
  `karakter` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `lama` int(11) NOT NULL,
  `anggaran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `_token` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `status_memo` int(11) NOT NULL,
  `memo` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `memos`
--

INSERT INTO `memos` (`id`, `nomor_memo`, `nama_memo`, `keterangan`, `tanggal`, `id_rbb`, `status`, `karakter`, `jumlah`, `lama`, `anggaran`, `id_user`, `created_at`, `updated_at`, `_token`, `status_memo`, `memo`) VALUES
(32, '123123213', 'test', 'keterangan', '2014-09-19', 2, 'inhouse', 'G1 G2 G3', 20, 15, 1000000000, 8, '2014-09-16 23:33:23', '2014-09-16 23:33:23', '', 0, NULL),
(34, 'test', 'testmemo', 'keterangan', '2014-09-26', 1, 'public', 'G1 G2 G3', 14, 12, 123, 10, '2014-09-16 23:46:48', '2014-09-16 23:46:48', '', 0, NULL),
(35, 'fdsaf', 'asfsadfsaf', 'saff', '2014-09-09', 1, 'public', 'asfas', 12312, 121312, 1231231, 10, '2014-09-16 23:59:01', '2014-09-16 23:59:01', '', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `memo_comments`
--

CREATE TABLE IF NOT EXISTS `memo_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_memo` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `memo_comments_id_memo_index` (`id_memo`),
  KEY `memo_comments_id_user_index` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=49 ;

--
-- Dumping data for table `memo_comments`
--

INSERT INTO `memo_comments` (`id`, `id_memo`, `id_user`, `comment`, `created_at`, `updated_at`) VALUES
(34, 32, 8, 'komentar', '2014-09-16 23:33:43', '2014-09-16 23:33:43'),
(35, 32, 9, 'komentar', '2014-09-16 23:36:01', '2014-09-16 23:36:01'),
(38, 34, 9, 'cek anggaran', '2014-09-16 23:47:28', '2014-09-16 23:47:28');

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
('2014_10_03_074648_memo_nullable', 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rbbs`
--

INSERT INTO `rbbs` (`id`, `rbb`, `created_at`, `updated_at`) VALUES
(1, 'General Banking Program', '2014-09-07 18:24:03', '2014-09-07 18:24:03'),
(2, 'Managerial Program', '2014-09-07 18:24:03', '2014-09-07 18:24:03');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `email`, `password`, `access`, `avatar`, `remember_token`, `created_at`, `updated_at`, `_token`) VALUES
(2, 'gardakhadafi', 'Garda Dafi', 'gardakhadafi@gmail.com.coy', '$2y$10$r/6DJOIJCBLyaqqclayJ1unirldN7JtaiqqPUN6GWNa0dgKn3cGui', 2, 'default.png', 'fApEIDn16G7CZDnBXHsam86xvFANSOiHhewsMP9ByWNBJMqQ4rv8KTnVGwDE', '2014-09-07 09:59:33', '2014-09-15 21:12:59', ''),
(7, 'admin', 'administrator', '', '$2y$10$4v8JjaiVhVdIJV4b9DmSzu26AvyMZ8oIhizSKaLlXfxD0MSQ9WJFm', 99, 'default.png', 'FRawe3st2Ppl7lfrZgCKEmG0ScAgKcQOO9FDOnPKQHijM1FT7Xd3xKk7zu9X', '2014-09-16 18:41:33', '2014-09-16 23:46:04', ''),
(8, 'user', 'user diklat', 'user@diklat.com', '$2y$10$f/r1uGriImsR54hHpyER9.FevaQiJwIyUui8pImT4YlbOIi30TxP6', 1, 'default.png', '74u0Jj8Y2uQuAGulevTxU9z2GjnyFE7tvefhZ73LKNq5Of9xJUTeFAQ9AnAK', '2014-09-16 23:31:09', '2014-09-16 23:34:14', ''),
(9, 'pingroup', 'pingroup', '', '$2y$10$mgL3a1BrT0h8pd1rCIDQ0uZlaghRywOQmjZzdOpkEVXFSPxWkG1..', 2, 'default.png', 'hRnDLt9CxC1Mm9rmNhxYM5n2IkjR2EQS543AYRVnoIBUMJop81HhtbFQY7VM', '2014-09-16 23:35:15', '2014-09-16 23:47:43', ''),
(10, 'sonda', 'bu sonda', '', '$2y$10$TA2vWBTmaoJ/J6Q7BLfJ/Oo5B0qK9onrFj3x5UYqJ.ydJbhqAPiuK', 1, 'default.png', 'PK9mKf5jZeXxU7axQkW1mtsKCCDiC3XTlsQg3wybmMP2Dbtuf4kyaPKiOxUZ', '2014-09-16 23:45:57', '2014-09-16 23:46:58', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
