-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2023 at 08:53 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbhr`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `akses_id` int(11) NOT NULL,
  `akses_role` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `apps_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `edited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`akses_id`, `akses_role`, `user_id`, `apps_id`, `created_at`, `edited_at`, `deleted_at`) VALUES
(3, 'Admin', 24, 6, '2023-01-17 10:02:09', NULL, NULL),
(4, 'Admin', 27, 6, '2023-01-17 10:03:06', NULL, NULL),
(5, 'User', 26, 6, '2023-01-17 11:06:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `apps_id` int(11) NOT NULL,
  `apps_nama` varchar(100) DEFAULT NULL,
  `apps_url` varchar(255) DEFAULT NULL,
  `apps_desc` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `edited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `apps`
--

INSERT INTO `apps` (`apps_id`, `apps_nama`, `apps_url`, `apps_desc`, `created_at`, `edited_at`, `deleted_at`) VALUES
(3, 'Arsip', 'http://202.146.130.230/arsip_banktanah/', 'Penyimpanan arsip digital', '2022-12-28 17:30:12', NULL, NULL),
(4, 'JDIH', 'http://202.146.130.227/jdih/', 'Dokumen landasan hukum ', '2023-01-04 11:11:39', NULL, NULL),
(5, 'BDP Monitoring', 'http://202.146.130.236/project_monitoring/', '', '2023-01-04 11:12:21', NULL, NULL),
(6, 'Inventory Pengadaan', 'http://localhost/bt_pengadaan/', '', '2023-01-09 09:17:07', NULL, NULL),
(7, 'Form Request', 'http://localhost/bt_request', '', '2023-01-13 15:44:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `divisi_id` int(11) NOT NULL,
  `divisi_nama` varchar(100) NOT NULL,
  `divisi_deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `edited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`divisi_id`, `divisi_nama`, `divisi_deskripsi`, `created_at`, `edited_at`, `deleted_at`) VALUES
(10, 'PERENCANAAN STRATEGIS', '', '2022-11-07 07:38:24', NULL, NULL),
(11, 'PERENCANAAN TEKNIS', 'tes edit', '2022-11-07 07:38:42', '2022-11-11 09:47:56', NULL),
(12, 'PEROLEHAN DAN PENGADAAN TANAH', '', '2022-11-07 07:39:01', NULL, NULL),
(13, 'PENGELOLAAN TANAH', '', '2022-11-07 07:39:19', NULL, NULL),
(14, 'PEMANFAATAN TANAH NON/SEMI KOMERSIAL', '', '2022-11-07 07:39:36', NULL, NULL),
(15, 'PENGEMBANGAN USAHA KOMERSIAL', '', '2022-11-07 07:39:51', NULL, NULL),
(16, 'KEUANGAN DAN AKUNTANSI', '', '2022-11-07 07:40:15', NULL, NULL),
(17, 'INFORMASI TEKNOLOGI DAN OPERASIONAL', '', '2022-11-07 07:40:31', NULL, NULL),
(18, 'SEKRETARIS BADAN', '', '2022-11-07 07:40:53', NULL, NULL),
(19, 'SPI/INTERNAL AUDIT', '', '2022-11-07 07:41:14', NULL, NULL),
(21, 'Badan Pelaksana', '', '2022-11-14 07:37:20', NULL, NULL),
(22, 'Lainnya', '', '2022-11-20 04:33:15', NULL, NULL),
(23, 'Non Staf', '', '2022-11-20 05:44:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divisi_bagian`
--

CREATE TABLE `divisi_bagian` (
  `divisi_bagian_id` int(11) NOT NULL,
  `divisi_bagian_nama` varchar(100) NOT NULL,
  `divisi_bagian_deskripsi` text NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `edited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi_bagian`
--

INSERT INTO `divisi_bagian` (`divisi_bagian_id`, `divisi_bagian_nama`, `divisi_bagian_deskripsi`, `divisi_id`, `created_at`, `edited_at`, `deleted_at`) VALUES
(9, 'HUKUM DAN KERJA SAMA', '', 18, '2022-11-07 07:42:20', NULL, NULL),
(10, 'HUBUNGAN MASYARAKAT', '', 18, '2022-11-07 07:43:08', NULL, NULL),
(11, 'SUMBER DAYA MANUSIA DAN ADMINSTRASI', '', 18, '2022-11-07 07:43:34', NULL, NULL),
(12, 'PENGADAAN', '', 18, '2022-11-07 07:44:15', NULL, NULL),
(19, 'SPI ATAU INTERNAL AUDIT', '', 19, '2022-11-07 07:45:39', NULL, NULL),
(20, 'PENYUSUNAN RENCANA INDUK DAN RENCANA KERJA BANK TANAH', '', 10, '2022-11-07 07:52:33', NULL, NULL),
(21, 'MANAJEMEN RISIKO', '', 10, '2022-11-07 07:56:31', NULL, NULL),
(22, 'PERENCANAAN TEKNIS BIDANG PEROLEHAN, PENGADAAN DAN PENGELOLAAN TANAH', '', 11, '2022-11-07 07:57:07', NULL, NULL),
(23, 'PERENCANAAN TEKNIS BIDANG PEMANFAATAN DAN PENDISTRIBUSIAN TANAH', '', 11, '2022-11-07 07:57:36', NULL, NULL),
(24, 'PERENCANAAN PETA TEMATIK TANAH DAN KAWASAN', '', 11, '2022-11-07 07:57:59', NULL, NULL),
(25, 'PEROLEHAN TANAH DAN PENGADAAN TANAH', '', 12, '2022-11-07 07:58:27', NULL, NULL),
(26, 'PENGEMBANGAN TANAH', '', 13, '2022-11-07 07:59:04', NULL, NULL),
(27, 'PEMELIHARAAN DAN PENGAMANAN TANAH', '', 13, '2022-11-07 07:59:29', NULL, NULL),
(28, 'PEMANFAATAN TANAH', '', 14, '2022-11-07 07:59:59', NULL, NULL),
(29, 'RISET DAN PENYUSUNAN TARIF PEMANFAATAN', '', 15, '2022-11-07 08:00:30', NULL, NULL),
(30, 'KERJA SAMA DAN PENGEMBANGAN USAHA', '', 15, '2022-11-07 08:00:53', NULL, NULL),
(31, 'KEUANGAN DAN AKUNTANSI', '', 16, '2022-11-07 08:01:19', NULL, NULL),
(32, 'OPERASIONAL', '', 16, '2022-11-07 08:01:45', NULL, NULL),
(33, 'PENGEMBANGAN TEKNOLOGI INFORMASI', '', 17, '2022-11-07 08:02:09', NULL, NULL),
(35, 'BADAN PELAKSANA', '', 21, '2022-11-14 07:37:39', NULL, NULL),
(36, 'Lainnya', '', 22, '2022-11-20 04:33:32', NULL, NULL),
(37, 'Proyek Penajam', '', 22, '2022-11-20 04:39:24', NULL, NULL),
(38, 'Perencanaan Internal', '', 18, '2022-11-20 05:15:00', NULL, NULL),
(39, 'Office Boy', '', 23, '2022-11-20 05:45:19', NULL, NULL),
(40, 'Driver Deputi', '', 23, '2022-11-20 05:45:42', NULL, NULL),
(41, 'Driver Operasional', '', 23, '2022-11-20 05:46:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `jabatan_id` int(11) NOT NULL,
  `jabatan_nama` varchar(100) NOT NULL,
  `jabatan_deskripsi` text NOT NULL,
  `jabatan_level` int(11) DEFAULT NULL,
  `jabatan_under` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `pegawai_nama` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `edited_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`jabatan_id`, `jabatan_nama`, `jabatan_deskripsi`, `jabatan_level`, `jabatan_under`, `pegawai_id`, `pegawai_nama`, `created_at`, `edited_at`, `deleted_at`) VALUES
(31, 'KEPALA BADAN', '', 1, 0, 11, 'Parman Nataatmaja', '2022-11-07 06:29:31', NULL, NULL),
(35, 'DEPUTI BIDANG PERENCANAAN STRATEGIS DAN PENGADAAN TANAH', '', 2, 31, 13, 'Ir. Perdananto Aribowo', '2022-11-07 06:31:24', NULL, NULL),
(36, 'DEPUTI BIDANG PENGEMBANGAN USAHA DAN KEUANGAN', '', 2, 31, 12, 'Hakiki Sudrajat', '2022-11-07 06:32:12', NULL, NULL),
(37, 'SEKRETARIS BADAN', '', 2, 31, NULL, NULL, '2022-11-07 06:36:09', NULL, NULL),
(38, 'KEPALA SPI/INTERNAL AUDIT', '', 2, 31, NULL, NULL, '2022-11-07 06:36:42', NULL, NULL),
(39, 'KEPALA DIVISI PERENCANAAN STRATEGIS', '', 3, 35, 28, 'Jerzi Budiarto', '2022-11-07 06:37:16', NULL, NULL),
(40, 'KEPALA DIVISI PERENCANAAN TEKNIS', '', 3, 35, NULL, NULL, '2022-11-07 06:37:34', NULL, NULL),
(41, 'KEPALA DIVISI PEROLEHAN DAN PENGADAAN TANAH', '', 3, 35, NULL, NULL, '2022-11-07 06:38:37', NULL, NULL),
(42, 'KEPALA DIVISI PENGELOLAAN TANAH', '', 3, 35, NULL, NULL, '2022-11-07 06:38:55', NULL, NULL),
(43, 'KEPALA DIVISI PEMANFAATAN TANAH NON/SEMI KOMERSIAL', '', 3, 36, NULL, NULL, '2022-11-07 06:39:25', NULL, NULL),
(44, 'KEPALA DIVISI PENGEMBANGAN USAHA KOMERSIAL', '', 3, 36, NULL, NULL, '2022-11-07 06:39:55', NULL, NULL),
(45, 'KEPALA DIVISI KEUANGAN DAN AKUNTANSI', '', 3, 36, NULL, NULL, '2022-11-07 06:40:14', NULL, NULL),
(46, 'KEPALA DIVISI INFORMASI TEKNOLOGI DAN OPERASIONAL', '', 3, 36, NULL, NULL, '2022-11-07 06:41:01', NULL, NULL),
(47, 'KEPALA BAGIAN HUKUM DAN KERJA SAMA', '', 3, 37, NULL, NULL, '2022-11-07 06:45:56', NULL, NULL),
(48, 'KEPALA BAGIAN HUBUNGAN MASYARAKAT', '', 3, 37, NULL, NULL, '2022-11-07 06:46:16', NULL, NULL),
(49, 'KEPALA BAGIAN SUMBER DAYA MANUSIA DAN ADMINSTRASI', '', 3, 37, NULL, NULL, '2022-11-07 06:46:35', NULL, NULL),
(50, 'KEPALA BAGIAN PENGADAAN', '', 3, 37, NULL, NULL, '2022-11-07 06:46:55', NULL, NULL),
(51, 'KEPALA BAGIAN PERENCANAAN INTERNAL', '', 3, 37, NULL, NULL, '2022-11-07 06:47:16', NULL, NULL),
(52, 'KEPALA BAGIAN SPI/ INTERNAL AUDIT', '', 3, 38, NULL, NULL, '2022-11-07 06:47:50', NULL, NULL),
(53, 'KEPALA BAGIAN PENYUSUNAN RENCANA INDUK DAN RENCANA KERJA BANK TANAH', '', 4, 39, NULL, NULL, '2022-11-07 06:48:20', NULL, NULL),
(54, 'KEPALA BAGIAN MANAJEMEN RISIKO', '', 4, 39, NULL, NULL, '2022-11-07 06:48:55', NULL, NULL),
(55, 'KEPALA BAGIAN PERENCANAAN TEKNIS BIDANG PEROLEHAN, PENGADAAN DAN PENGELOLAAN TANAH', '', 4, 40, NULL, NULL, '2022-11-07 06:53:19', NULL, NULL),
(56, 'KEPALA BAGIAN PERENCANAAN TEKNIS BIDANG PEMANFAATAN DAN PENDIST', '', 4, 40, NULL, NULL, '2022-11-07 06:53:47', NULL, NULL),
(57, 'KEPALA BAGIAN PERENCANAAN PETA TEMATIK TANAH DAN KAWASAN', '', 4, 40, NULL, NULL, '2022-11-07 06:54:10', NULL, NULL),
(58, 'KEPALA BAGIAN PEROLEHAN TANAH DAN PENGADAAN TANAH', '', 4, 41, NULL, NULL, '2022-11-07 06:54:53', NULL, NULL),
(59, 'KEPALA BAGIAN PENGEMBANGAN TANAH', '', 4, 42, NULL, NULL, '2022-11-07 06:55:45', NULL, NULL),
(60, 'KEPALA BAGIAN PEMELIHARAAN DAN PENGAMANAN TANAH', '', 4, 42, NULL, NULL, '2022-11-07 06:56:55', NULL, NULL),
(61, 'KEPALA BAGIAN PEMANFAATAN TANAH', '', 4, 43, NULL, NULL, '2022-11-07 06:57:23', NULL, NULL),
(62, 'KEPALA BAGIAN RISET DAN PENYUSUNAN TARIF PEMANFAATAN', '', 4, 44, NULL, NULL, '2022-11-07 06:57:51', NULL, NULL),
(63, 'KEPALA BAGIAN KERJA SAMA DAN PENGEMBANGAN USAHA', '', 4, 44, NULL, NULL, '2022-11-07 06:58:27', NULL, NULL),
(64, 'KEPALA BAGIAN KEUANGAN DAN AKUNTANSI', '', 4, 45, NULL, NULL, '2022-11-07 06:58:56', NULL, NULL),
(65, 'KEPALA BAGIAN OPERASIONAL', '', 4, 45, NULL, NULL, '2022-11-07 07:00:58', NULL, NULL),
(66, 'STAF', '', 4, 47, NULL, NULL, '2022-11-07 07:01:56', NULL, NULL),
(67, 'STAF', '', 4, 47, NULL, NULL, '2022-11-07 07:02:15', NULL, NULL),
(68, 'STAF', '', 4, 47, NULL, NULL, '2022-11-07 07:02:26', NULL, NULL),
(69, 'STAF', '', 4, 49, NULL, NULL, '2022-11-07 07:03:23', NULL, NULL),
(70, 'STAF', '', 4, 49, NULL, NULL, '2022-11-07 07:04:12', NULL, NULL),
(71, 'STAF', '', 4, 49, NULL, NULL, '2022-11-07 07:04:25', NULL, NULL),
(72, 'STAF', '', 4, 49, NULL, NULL, '2022-11-07 07:04:35', NULL, NULL),
(73, 'STAF', '', 4, 49, NULL, NULL, '2022-11-07 07:04:55', NULL, NULL),
(74, 'STAF', '', 4, 49, NULL, NULL, '2022-11-07 07:05:03', NULL, NULL),
(75, 'STAF', '', 4, 50, NULL, NULL, '2022-11-07 07:05:22', NULL, NULL),
(76, 'STAF', '', 5, 53, NULL, NULL, '2022-11-07 07:05:56', NULL, NULL),
(77, 'STAF', '', 5, 55, NULL, NULL, '2022-11-07 07:06:34', NULL, NULL),
(78, 'STAF', '', 5, 55, NULL, NULL, '2022-11-07 07:06:53', NULL, NULL),
(79, 'STAF', '', 5, 58, NULL, NULL, '2022-11-07 07:07:17', NULL, NULL),
(80, 'STAF', '', 5, 58, NULL, NULL, '2022-11-07 07:07:39', NULL, NULL),
(81, 'STAF', '', 5, 58, NULL, NULL, '2022-11-07 07:07:55', NULL, NULL),
(82, 'STAF', '', 5, 58, NULL, NULL, '2022-11-07 07:08:16', NULL, NULL),
(83, 'STAF', '', 5, 58, NULL, NULL, '2022-11-07 07:08:40', NULL, NULL),
(84, 'STAF', '', 5, 59, NULL, NULL, '2022-11-07 07:09:10', NULL, NULL),
(85, 'STAF', '', 5, 59, NULL, NULL, '2022-11-07 07:09:25', NULL, NULL),
(86, 'STAF', '', 5, 64, NULL, NULL, '2022-11-07 07:10:03', NULL, NULL),
(87, 'STAF', '', 5, 64, NULL, NULL, '2022-11-07 07:10:12', NULL, NULL),
(88, 'STAF', '', 5, 64, NULL, NULL, '2022-11-07 07:10:21', NULL, NULL),
(89, 'STAF', '', 5, 64, NULL, NULL, '2022-11-07 07:10:33', NULL, NULL),
(90, 'STAF', '', 5, 64, NULL, NULL, '2022-11-07 07:10:54', NULL, NULL),
(91, 'KEPALA BAGIAN PENGEMBANGAN TEKNOLOGI INFORMASI', '', 4, 46, NULL, NULL, '2022-11-07 07:12:37', NULL, NULL),
(92, 'STAF', '', 5, 91, NULL, NULL, '2022-11-07 07:12:53', NULL, NULL),
(93, 'STAF', '', 5, 91, NULL, NULL, '2022-11-07 07:13:00', NULL, NULL),
(94, 'STAF', '', 5, 91, NULL, NULL, '2022-11-07 07:13:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan_general`
--

CREATE TABLE `jabatan_general` (
  `jabatan_id` int(11) NOT NULL,
  `jabatan_nama` varchar(255) NOT NULL,
  `jabatan_level` int(11) NOT NULL,
  `jabatan_desc` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `edited_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan_general`
--

INSERT INTO `jabatan_general` (`jabatan_id`, `jabatan_nama`, `jabatan_level`, `jabatan_desc`, `created_at`, `deleted_at`, `edited_at`) VALUES
(1, 'Kepala Badan', 1, NULL, '2023-01-04 10:36:38', NULL, NULL),
(2, 'Deputi', 2, NULL, '2023-01-04 10:36:58', NULL, NULL),
(3, 'Kepala Divisi', 3, NULL, '2023-01-04 10:37:12', NULL, NULL),
(4, 'Kepala Bagian', 4, NULL, '2023-01-04 10:37:32', NULL, NULL),
(6, 'Staf', 5, NULL, '2023-01-04 13:55:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_nama`) VALUES
(3, 'KATEGORI B'),
(4, 'KATEGORI C'),
(5, 'KATEGORI D'),
(8, 'xxx');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `pegawai_id` int(11) NOT NULL,
  `pegawai_nama` varchar(100) NOT NULL,
  `pegawai_nip` varchar(100) DEFAULT NULL,
  `pegawai_gender` char(2) NOT NULL,
  `pegawai_tgl_lahir` date NOT NULL,
  `pegawai_domisili` varchar(500) NOT NULL,
  `pegawai_divisi` int(11) NOT NULL,
  `pegawai_divisi_bagian` int(11) NOT NULL,
  `pegawai_pendidikan` int(11) NOT NULL,
  `pegawai_jabatan` int(11) DEFAULT NULL,
  `pegawai_status` int(11) NOT NULL,
  `pegawai_foto` varchar(1000) DEFAULT NULL,
  `pegawai_tgl_gabung` date NOT NULL,
  `pegawai_level` int(11) DEFAULT NULL,
  `pegawai_email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `edited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`pegawai_id`, `pegawai_nama`, `pegawai_nip`, `pegawai_gender`, `pegawai_tgl_lahir`, `pegawai_domisili`, `pegawai_divisi`, `pegawai_divisi_bagian`, `pegawai_pendidikan`, `pegawai_jabatan`, `pegawai_status`, `pegawai_foto`, `pegawai_tgl_gabung`, `pegawai_level`, `pegawai_email`, `created_at`, `edited_at`, `deleted_at`) VALUES
(11, 'Parman Nataatmaja', NULL, 'L', '1957-11-14', 'JL. H. ILYAS BAWAH REMPOA RT005 RW010 CIPUTAT TIMUR', 21, 35, 9, NULL, 2, NULL, '2021-12-31', 1, NULL, '2022-11-14 07:38:42', NULL, NULL),
(12, 'Hakiki Sudrajat', NULL, 'L', '1968-09-11', 'SENAYAN BINTARO BLOK HH. 11/3 SEKT IX PONDOK AREN', 21, 35, 9, NULL, 2, NULL, '2021-12-31', NULL, NULL, '2022-11-14 07:39:55', NULL, NULL),
(13, 'Ir. Perdananto Aribowo', NULL, 'L', '1962-12-27', 'TEGALASARI RT008 RW 006 KARANGANYAR', 21, 35, 9, NULL, 2, NULL, '2021-12-31', NULL, NULL, '2022-11-14 07:41:15', NULL, NULL),
(14, 'Febriano Edlian', NULL, 'L', '1986-02-11', 'JL. ALAM PESANGGRAHAN III No 14 DEPOK', 17, 33, 9, NULL, 2, NULL, '2022-01-13', NULL, NULL, '2022-11-14 07:47:57', NULL, NULL),
(15, 'Andi Rukmana', NULL, 'L', '1991-09-06', 'KP. CITAPEN  BOJONGPICUNG CIANJUR JAWA BARAT', 17, 33, 9, NULL, 2, NULL, '2022-02-24', NULL, NULL, '2022-11-14 07:49:48', NULL, NULL),
(16, 'Mario Alvin Vetter', NULL, 'L', '1988-12-14', 'Mahkota Mas Blok N4 no 3 Tangerang Banten', 17, 33, 8, NULL, 2, NULL, '2022-06-22', NULL, NULL, '2022-11-14 07:56:22', NULL, NULL),
(17, 'Hatrick Febriadi Aslam', '123456789', 'L', '1997-02-13', 'PERUM MANDOSI PERMAI BLOK E NO 5 JATIASIH BEKASI JAWA BARAT', 17, 33, 8, NULL, 2, 'http://localhost/hr-dashboard/gambar/pegawai/a8898abe789c8f57e6535ff3518e2e5f.png', '2022-06-14', 6, 'hatrick.aslam@banktanah.id', '2022-11-14 07:58:39', NULL, NULL),
(18, 'Eka Wira Buana', NULL, 'L', '1981-04-11', 'JL. LAHAB NO.55A RT 07/03 PETUKANGAN PASANGGRAHAN JAKARTA SELATAN ', 18, 12, 9, NULL, 2, NULL, '2022-02-21', NULL, NULL, '2022-11-14 08:00:45', NULL, NULL),
(19, 'Adhiya Kandiana', NULL, 'L', '1995-05-01', 'KOMP. GBI BLOK D5 NO.11 RT 002 RW 007 BOJONGSOANG, BANDUNG', 18, 12, 8, NULL, 2, NULL, '2022-06-14', NULL, NULL, '2022-11-14 08:03:33', NULL, NULL),
(20, 'Zaki Yusa, S.SI', NULL, 'L', '1982-04-06', 'JL. BATU KUCING GG. PUTRI DUYUNG RT002/003 KAMPUNG BULANG', 12, 25, 9, NULL, 2, NULL, '2022-07-02', NULL, NULL, '2022-11-14 08:06:10', NULL, NULL),
(21, 'Alda Fadila Putra', NULL, 'L', '1997-10-11', 'JL. KAPAS 1 NO 3B UMBULHARJO YOGYAKARTA', 12, 25, 8, NULL, 2, NULL, '2022-02-17', NULL, NULL, '2022-11-14 08:13:51', NULL, NULL),
(22, 'Deden Fajar', NULL, 'L', '1996-10-28', 'JL PELABUHAN II CIPOHO INDAH SARON BAWAH RT 005/006 CIKONDANG, CITAMIANG, SUKABUMI', 12, 25, 6, NULL, 2, NULL, '2022-04-04', NULL, NULL, '2022-11-14 08:15:06', NULL, NULL),
(23, 'Ni Putu Ayu Puspa Lestari', NULL, 'P', '1993-05-09', 'JL. LINGKAR SARI NO 46A RT 007 RW 008 KALISARI, PASAR REBO, JAKARTA TIMUR', 12, 25, 8, NULL, 2, NULL, '2022-02-06', NULL, NULL, '2022-11-14 08:17:16', NULL, NULL),
(24, 'Adiba Kamila Fizaki', NULL, 'P', '1998-11-05', 'PERUMAHAN BUKIT ASRI CIOMAS INDAH JL.CENDANA 3 BLOK B5/34 CIOMAS, KAB. BOGOR', 12, 25, 8, NULL, 2, NULL, '2022-02-06', NULL, NULL, '2022-11-14 08:18:48', NULL, NULL),
(25, 'Mahendra Wahyu Utomo', NULL, 'L', '1994-10-28', 'JL. PUCANG ANOM TIMUR MRAGGEN DEMAK', 12, 25, 8, NULL, 2, NULL, '2022-01-13', NULL, NULL, '2022-11-14 08:21:13', NULL, NULL),
(26, 'Rohmat Hidayat', NULL, 'L', '1981-07-21', 'KEMBARAN RT 03 RW 06 SEDAYU, MUNTILAN, MAGELANG, JAWA TENGAH', 12, 25, 8, NULL, 2, NULL, '2022-07-11', NULL, NULL, '2022-11-14 08:22:53', NULL, NULL),
(27, 'San Yuan Sirait', NULL, 'L', '1985-05-28', 'JL. HANG LEKIR PERM.MAHKOTA ALAM RAYA BLOK JASMINE 3 NO 27 RT005 RW007 BATU IX TANJUNGPINANG TIMUR', 12, 25, 9, NULL, 2, NULL, '2022-07-11', NULL, NULL, '2022-11-14 08:24:15', NULL, NULL),
(28, 'Jerzi Budiarto', NULL, 'L', '1989-01-24', 'JL. PERKICI X EB9 NO 5, KEC. PONDOK AREN, TANGERANG SELATAN', 10, 20, 9, NULL, 2, NULL, '2022-09-03', NULL, NULL, '2022-11-14 08:41:55', NULL, NULL),
(29, 'Neysa Nur Amalina', NULL, 'P', '1999-03-18', 'PERUM BIP BLOK B NO.6 RT22/08 CIBENING BUNGURSARI PURWAKARTA', 18, 11, 8, NULL, 2, NULL, '2022-02-21', NULL, NULL, '2022-11-20 04:24:46', NULL, NULL),
(30, 'Inesa Alya Dinie', NULL, 'P', '1997-09-07', 'SARIE BUNGA BAKUNG RESIDENCE BLOK C73 BUAH BATU MARGACINTA BANDUNG', 16, 31, 8, NULL, 2, NULL, '2022-02-21', NULL, NULL, '2022-11-20 04:26:35', NULL, NULL),
(31, 'Nada Minel Safitri', NULL, 'P', '1998-01-30', 'JL. NYENGSERET I No.70/95 ASTANA ANYAR BANDUNG', 16, 31, 8, NULL, 2, NULL, '2022-11-07', NULL, NULL, '2022-11-20 04:28:38', NULL, NULL),
(32, 'Riska Devita Aprianti', NULL, 'P', '1998-04-03', 'JL. SUNGAI BATANGHARI 24 GANDEKAN, JEBRES, SURAKARTA', 18, 11, 8, NULL, 2, NULL, '2022-07-25', NULL, NULL, '2022-11-20 04:30:28', NULL, NULL),
(33, 'Arga Putra', NULL, 'L', '1996-08-05', 'JL. ASSOFA RAYA NO 22 RT004 RW001 SUKABUMI UTARA KEBON JERUK JAKARTA BARAT', 22, 36, 9, NULL, 2, NULL, '2022-10-24', NULL, NULL, '2022-11-20 04:35:01', NULL, NULL),
(34, 'Deni Ahmad', NULL, 'L', '1966-03-13', 'JL YUPITER II -FII N05-7 RT001 RW002 SEKEJATI BUAH BATU BANDUNG', 22, 36, 9, NULL, 3, NULL, '2022-02-02', NULL, NULL, '2022-11-20 04:36:35', NULL, NULL),
(35, 'Tri Rahayu', NULL, 'P', '1986-05-24', 'PERUM BUANA INDAH BLOK B N0 26 PURWAKARTA ', 18, 11, 8, NULL, 2, NULL, '2022-01-13', NULL, NULL, '2022-11-20 04:38:05', NULL, NULL),
(36, 'Agoes Prijanto', NULL, 'L', '1964-02-25', 'JL. ADIPURA RAYA NO. 188 RT 02 RW 06 PURWOSARI, BATURADEN, PURWOKERTO', 22, 37, 9, NULL, 2, NULL, '2022-08-22', NULL, NULL, '2022-11-20 04:40:32', NULL, NULL),
(37, 'Moh Syafran Zamzami', NULL, 'L', '1984-11-30', 'JL. KENCANA LOKA BLOK II/17 BSD TANGERANG', 13, 26, 8, NULL, 2, NULL, '2022-01-13', NULL, NULL, '2022-11-20 04:42:09', NULL, NULL),
(38, 'Dody Pratama Setia', NULL, 'L', '1984-06-02', 'CLUSTER KELAPA REGENCY JL. SOMAWINATA B.5 , TANIMULYA, NGAMPRAH, BANDUNG BARAT', 22, 37, 8, NULL, 2, NULL, '2022-08-22', NULL, NULL, '2022-11-20 04:43:38', NULL, NULL),
(39, 'Andriyansa', NULL, 'L', '1992-12-22', 'KEBANTENAN, 003/004, SEMPER TIMUR, CILINCING, JAKARTA UTARA', 22, 37, 9, NULL, 2, NULL, '2022-08-24', NULL, NULL, '2022-11-20 04:45:07', NULL, NULL),
(40, 'Bondan Riantoro Ruliawan', NULL, 'L', '1995-06-02', 'JL RONODIGDAYAN NO. 47 YOGYAKARTA', 22, 37, 8, NULL, 2, NULL, '2022-08-22', NULL, NULL, '2022-11-20 04:46:35', NULL, NULL),
(41, 'Aulia Fitri Maulani', NULL, 'P', '1995-04-04', 'JL. PONCOL JAYA MAMPANG PRAPATAN JAKARTA SELATAN', 18, 11, 8, NULL, 2, NULL, '2022-01-24', NULL, NULL, '2022-11-20 04:47:58', NULL, NULL),
(42, 'Abdul Gani', NULL, 'L', '2001-03-23', 'KP. BABAKAN PARI. RT 37 RW 17 KECAMATAN CISAAT KABUPATEN SUKABUMI', 22, 37, 8, NULL, 2, NULL, '2022-08-22', NULL, NULL, '2022-11-20 04:49:24', NULL, NULL),
(43, 'Sandra Priatinda Priatna', NULL, 'L', '1977-05-16', 'JL. NYENGSERET I No.70/95 ASTANA ANYAR BANDUNG', 16, 31, 8, NULL, 2, NULL, '2022-01-17', NULL, NULL, '2022-11-20 04:50:49', NULL, NULL),
(44, 'Rico Fernando', NULL, 'L', '1986-04-29', 'METLAND CILEUNGSI SEKTOR 7 BLOK GB.06 NO.01 RT 007 RW 002 CIPENJO-CILEUNGSI KAB. BOGOR', 22, 37, 8, NULL, 2, NULL, '2022-08-22', NULL, NULL, '2022-11-20 04:52:14', NULL, NULL),
(45, 'Muklis, SE', NULL, 'L', '1975-02-28', 'JL. RAYA SILIWANGI KM.7 RAWALUMBU BEKASI', 16, 31, 8, NULL, 2, NULL, '2022-01-17', NULL, NULL, '2022-11-20 04:53:49', NULL, NULL),
(46, 'Riyan Setya Anggana', NULL, 'L', '1990-06-30', 'JL.MERAPI C3/3 JATIMEKAR,JATIASIH, BEKASI', 22, 37, 8, NULL, 2, NULL, '2022-09-15', NULL, NULL, '2022-11-20 04:55:13', NULL, NULL),
(47, 'Luthfan Hudaya', NULL, 'L', '1984-11-26', 'UJUNG MENTENG No 33 CAKUNG JAKARTA TIMUR', 16, 31, 6, NULL, 2, NULL, '2022-01-17', NULL, NULL, '2022-11-20 04:56:36', NULL, NULL),
(48, 'Lucky Ariansa', NULL, 'L', '1981-03-11', 'JL. PERUNGGU NO. 1 RT001/006 BUAH BATU BANDUNG', 14, 28, 9, NULL, 2, NULL, '2022-07-02', NULL, NULL, '2022-11-20 04:58:20', NULL, NULL),
(49, 'Meidyah Indreswari, SE', NULL, 'P', '1957-02-05', 'JL. GUDANG PELURU SELATAN 8 NO. 283-284 KEBON BARU TEBET JAKARTA', 22, 36, 10, NULL, 3, NULL, '2022-01-20', NULL, NULL, '2022-11-20 05:00:04', NULL, NULL),
(50, 'Nona Dengen', NULL, 'P', '1992-07-17', 'JL MURAI BLOK JS NO.13, BINTARO PESANGGRAHAN, JAKARTA SELATAN', 18, 11, 8, NULL, 2, NULL, '2022-02-24', NULL, NULL, '2022-11-20 05:01:20', NULL, NULL),
(51, 'Disyanda Giswa', NULL, 'P', '1994-06-16', 'PERUM MANDOSI PERMAI BLOK D NO 15 JATIASIH BEKASI JAWA BARAT', 18, 11, 8, NULL, 2, NULL, '2022-02-24', NULL, NULL, '2022-11-20 05:02:41', NULL, NULL),
(52, 'Ani Wijayanti', NULL, 'P', '1973-10-10', 'PERUM. TAMAN PUSPA NO 156 BLOK F 007/005 KELURHAN TUGU, CIMANGGIS, DEPOK', 11, 22, 8, NULL, 2, NULL, '2022-03-14', NULL, NULL, '2022-11-20 05:04:02', NULL, NULL),
(53, 'Masril', NULL, 'L', '1966-01-10', 'JL. GINTUNG N0.18 RT08 RW06 KELURAHAN TANJUNG BARAT, JAGAKARSA - JAKARTA SELATAN', 16, 31, 8, NULL, 2, NULL, '2022-03-21', NULL, NULL, '2022-11-20 05:05:27', NULL, NULL),
(54, 'Jonni Sugana Tachita', NULL, 'L', '1964-04-13', 'KOTA WISATA BLOK A. 10/18 GUNUNGPUTRI', 22, 36, 8, NULL, 3, NULL, '2022-02-07', NULL, NULL, '2022-11-20 05:07:00', NULL, NULL),
(55, 'Tiara Ulfayana', NULL, 'P', '1998-03-17', 'JL OSCAR RAYA BLOK C8 NO 21 RT 002/RW 002 KOTA BARU BEKASI BARAT', 11, 22, 8, NULL, 2, NULL, '2022-04-04', NULL, NULL, '2022-11-20 05:08:22', NULL, NULL),
(56, 'Fx Aghastia Khresna', NULL, 'L', '1981-01-04', 'JL. SINGOSARI RAYA 36 RT 008 RW 005 WONODRI SEMARANG SELATAN', 16, 31, 8, NULL, 2, NULL, '2022-11-04', NULL, NULL, '2022-11-20 05:10:05', NULL, NULL),
(57, 'Rochman Marota', NULL, 'L', '1977-01-13', 'PERUMAHAN BABAKAN SARI, JL. BABAKAN SARI RAYA NO.13 RT006 RW 005 BOGOR', 18, 38, 10, NULL, 2, NULL, '2022-04-18', NULL, NULL, '2022-11-20 05:16:09', NULL, NULL),
(58, 'Bagus Hananto', NULL, 'L', '1978-11-19', 'JL. PANCORAN BARAT IV B', 15, 29, 9, NULL, 2, NULL, '2022-09-05', NULL, NULL, '2022-11-20 05:17:29', NULL, NULL),
(59, 'Firas Fakkar Afif', NULL, 'L', '1990-09-09', 'JL. RADAR UTARA B-11 A RT 008 RW 009 CIPINANG MELAYU MAKASAR', 18, 9, 9, NULL, 2, NULL, '2022-05-19', NULL, NULL, '2022-11-20 05:18:52', NULL, NULL),
(60, 'Hanny Chairany Ermansyah', NULL, 'P', '1991-08-04', 'JL. KARTINI VI BLOK G NO. 03 SEI-HARAPAN SEKUPANG BATAM KEPULAUAN RIAU', 18, 9, 9, NULL, 2, NULL, '2022-05-23', NULL, NULL, '2022-11-20 05:20:11', NULL, NULL),
(61, 'Angela Tarida', NULL, 'P', '1989-12-10', 'JL. MURAI RT 031 RW 010 AIK RAYAK, TANJUNG PANDAN, BELITUNG', 18, 9, 8, NULL, 2, NULL, '2022-05-30', NULL, NULL, '2022-11-20 05:21:47', NULL, NULL),
(62, 'Nadia Kusuma Putri', NULL, 'P', '1995-03-13', 'VILLA NUSA INDAH 3, BLOK KA 4 NO.2 RT 05 RW 37 KAB, BOGOR', 18, 11, 8, NULL, 2, NULL, '2022-04-09', NULL, NULL, '2022-11-20 05:22:56', NULL, NULL),
(63, 'Andhika Budiantono Irfan', NULL, 'L', '1998-05-23', 'KOMP. BPPT I-7/22 RT 06 RW 03', 11, 22, 8, NULL, 2, NULL, '2022-04-07', NULL, NULL, '2022-11-20 05:24:25', NULL, NULL),
(64, 'Mulyana Dedi Saputra', NULL, 'L', '1970-10-14', 'KAPLING THOMAS JL TENGKI NO 18 RT 004 RW 003 KELURAHAN CIPAYUNG KECAMATAN CIPAYUNG', 13, 26, 2, NULL, 2, NULL, '2022-01-08', NULL, NULL, '2022-11-20 05:25:46', NULL, NULL),
(65, 'Adhi Wicaksono', NULL, 'L', '1983-07-15', 'JL. RIAM KANAN NO 18 RT10 RW01 DUREN TIGA PANCORAN', 18, 38, 8, NULL, 2, NULL, '2022-10-28', NULL, NULL, '2022-11-20 05:27:13', NULL, NULL),
(66, 'Oce Madril', NULL, 'L', '1983-11-18', 'PERUM GPW AS-19 RT006 RW037 SUKOHARJO NGAGLIK', 22, 36, 10, NULL, 3, NULL, '2022-03-01', NULL, NULL, '2022-11-20 05:28:25', NULL, NULL),
(67, 'Herry Reinaldi', NULL, 'L', '1963-01-09', 'PERUM BALI VIEW B4 NO 4 RT007 RW015 PISANGAN CIPUTAT TIMUR', 22, 36, 8, NULL, 3, NULL, '2022-10-24', NULL, NULL, '2022-11-20 05:29:32', NULL, NULL),
(68, 'Wahyudi Sunu Priyanto', NULL, 'L', '1962-12-28', 'DUSUN GAMBYOK RT09 RW04 GAMBYOK GROGOL', 22, 37, 11, NULL, 2, NULL, '2022-10-01', NULL, NULL, '2022-11-20 05:34:14', NULL, NULL),
(69, 'Baharudin', NULL, 'L', '1983-03-15', 'JENEBORA RT 11 RW00 JENEBORA PENAJAM', 22, 37, 11, NULL, 2, NULL, '2022-10-01', NULL, NULL, '2022-11-20 05:35:19', NULL, NULL),
(70, 'Asriadi', NULL, 'L', '1997-09-19', 'JL. UNOCAL RT15 RW00 PENAJAM', 22, 37, 11, NULL, 2, NULL, '2022-10-01', NULL, NULL, '2022-11-20 05:36:33', NULL, NULL),
(71, 'Muhammad Fadila', NULL, 'L', '1989-09-02', 'JL.D.I. PANJAITAN NO 58 RT82 RW00 KARANG REJO BALIKPAPAN TENGAH', 22, 37, 11, NULL, 2, NULL, '2022-10-01', NULL, NULL, '2022-11-20 05:37:41', NULL, NULL),
(72, 'Embun Sari', NULL, 'P', '1989-04-18', 'JL. H MANDOR SALIM NO 54 RT 002 RW 002 SRENGSENG KEMBANGAN', 22, 36, 8, NULL, 3, NULL, '2021-12-31', NULL, NULL, '2022-11-20 05:39:28', NULL, NULL),
(73, 'Made Arya', NULL, 'L', '1965-08-17', 'CILILITAN BESAR RT 006 RW 004 CILILITAN KRAMATJATI', 22, 36, 8, NULL, 3, NULL, '2021-12-31', NULL, NULL, '2022-11-20 05:40:36', NULL, NULL),
(74, 'Wiwit Yulianto', NULL, 'L', '1995-07-01', 'JL. BULAK INDAH RT014/003 PONDOK AREN KOTA TANGGERANG SELATAN', 23, 39, 12, NULL, 2, NULL, '2022-02-02', NULL, NULL, '2022-11-20 05:48:08', NULL, NULL),
(75, 'Filla Bambu Permata Putra', NULL, 'L', '1985-01-12', 'KP PONDOK RANJI RT002/004 TANGERANG SELATAN', 23, 39, 3, NULL, 2, NULL, '2022-01-17', NULL, NULL, '2022-11-20 05:49:17', NULL, NULL),
(76, 'Jaelani', NULL, 'L', '1975-12-13', 'JL. BANGO III BAWAH RT014/003 PONDOK LABU JAKARTA SELATAN ', 23, 40, 12, NULL, 2, NULL, '2022-01-17', NULL, NULL, '2022-11-20 05:50:25', NULL, NULL),
(77, 'Bosrin', NULL, 'L', '1974-07-08', 'TANJUNGANOM RT004/003 BANJARNEGARA JAWA TENGAH ', 23, 40, 12, NULL, 2, NULL, '2022-01-17', NULL, NULL, '2022-11-20 05:51:44', NULL, NULL),
(78, 'Muhammad Kusbilah', NULL, 'L', '1995-05-05', 'JL KEMUNING 5 NO 40 005/006, PAMULANG BARAT', 23, 41, 2, NULL, 2, NULL, '2022-08-03', NULL, NULL, '2022-11-20 05:53:11', NULL, NULL),
(79, 'Wasido', NULL, 'L', '1966-06-12', 'JL LUBANG BUAYA 013/009, LUBANG BUAYA, CIPAYUNG, JAKARTA TMUR', 23, 41, 12, NULL, 2, NULL, '2022-09-03', NULL, NULL, '2022-11-20 05:54:24', NULL, NULL),
(80, 'Muhammad Yakub', NULL, 'L', '1981-05-17', 'JL. SETIA II NO 9 RT 001/012 KELURAHAN JATIWARINGIN KECAMATAN PONDOKGEDE BEKASI', 23, 41, 2, NULL, 2, NULL, '2022-09-19', NULL, NULL, '2022-11-20 05:55:37', NULL, NULL),
(82, 'Dummy User', '2222', 'P', '1991-02-22', 'Jakarta', 17, 33, 8, NULL, 2, 'http://localhost/hr-dashboard/gambar/pegawai/40bfb87a382086bcb9c7178edbe1c242.png', '2022-02-22', 6, 'dummy.user@banktanah.id', '2023-01-17 08:59:20', NULL, NULL),
(83, 'Dummy Admin', '1111', 'L', '1991-01-01', 'Jakarta', 17, 33, 8, NULL, 2, 'http://localhost/hr-dashboard/gambar/pegawai/e84325d601ac4e93ed1e67f58d5da2f6.png', '2022-02-22', 6, 'dummy.admin@banktanah.id', '2023-01-17 09:03:47', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `pendidikan_id` int(11) NOT NULL,
  `pendidikan_nama` varchar(100) NOT NULL,
  `pendidikan_deskripsi` varchar(1000) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `edited_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`pendidikan_id`, `pendidikan_nama`, `pendidikan_deskripsi`, `created_at`, `edited_at`, `deleted_at`) VALUES
(2, 'SMA', '', '2022-11-03 07:06:07', NULL, NULL),
(3, 'SMK', '', '2022-11-03 07:06:20', NULL, NULL),
(4, 'Diploma 1', '', '2022-11-03 07:06:39', NULL, NULL),
(5, 'Diploma 2', '', '2022-11-03 07:06:45', NULL, NULL),
(6, 'Diploma 3', '', '2022-11-03 07:06:52', NULL, NULL),
(7, 'Diploma 4', '', '2022-11-03 07:07:00', NULL, NULL),
(8, 'S1', '', '2022-11-03 07:07:08', NULL, NULL),
(9, 'S2', '', '2022-11-03 07:07:17', NULL, NULL),
(10, 'S3', '', '2022-11-03 07:07:43', NULL, NULL),
(11, 'Lainnya', '', '2022-11-20 05:33:02', NULL, NULL),
(12, 'SMP', '', '2022-11-20 05:47:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `project_nama` varchar(100) NOT NULL,
  `project_lokasi` varchar(255) NOT NULL,
  `project_periode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_nama`, `project_lokasi`, `project_periode`) VALUES
(4, 'pembangunan halte', 'cunda', '2022'),
(5, 'Pembangunan Parkiran DPRK', 'Lhokseumawe', '2022'),
(6, 'Pembangunan Jembatan Gantung', 'Desa Penari', '2022'),
(8, 'pembangunan  jalan halim kusuma', 'Jakarta Barat', '2022'),
(9, 'renovasi balai desa', 'Jakarta', '2022'),
(12, 'Project Test', 'Jakarta', '1 tahun'),
(13, 'tes', 'cunda', '1 tahun');

-- --------------------------------------------------------

--
-- Table structure for table `realisasi`
--

CREATE TABLE `realisasi` (
  `realisasi_id` int(11) NOT NULL,
  `realisasi_project` int(11) NOT NULL,
  `realisasi_kategori` int(11) NOT NULL,
  `realisasi_sub_kategori` int(11) NOT NULL,
  `realisasi_transaksi` int(11) NOT NULL,
  `realisasi_volume` double DEFAULT NULL,
  `realisasi_harga_satuan` double DEFAULT NULL,
  `realisasi_jumlah_harga` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `realisasi`
--

INSERT INTO `realisasi` (`realisasi_id`, `realisasi_project`, `realisasi_kategori`, `realisasi_sub_kategori`, `realisasi_transaksi`, `realisasi_volume`, `realisasi_harga_satuan`, `realisasi_jumlah_harga`) VALUES
(4, 13, 4, 10, 4, 120, 10, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `status_pegawai`
--

CREATE TABLE `status_pegawai` (
  `status_pegawai_id` int(11) NOT NULL,
  `status_nama` varchar(100) NOT NULL,
  `status_deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `edited_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_pegawai`
--

INSERT INTO `status_pegawai` (`status_pegawai_id`, `status_nama`, `status_deskripsi`, `created_at`, `edited_at`, `deleted_at`) VALUES
(2, 'PEGAWAI', '', '2022-11-03 07:04:03', NULL, NULL),
(3, 'NON-PEGAWAI', '', '2022-11-03 07:04:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kategori`
--

CREATE TABLE `sub_kategori` (
  `sub_id` int(11) NOT NULL,
  `kategori` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `satuan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_kategori`
--

INSERT INTO `sub_kategori` (`sub_id`, `kategori`, `nama`, `satuan`) VALUES
(10, 4, 'Sub Kategori C1', 'M'),
(11, 4, 'Sub Kategori C2', 'M'),
(12, 4, 'Sub Kategori C3', 'M'),
(13, 5, 'Sub Kategori D1', 'M'),
(14, 5, 'Sub Kategori D2', 'M'),
(15, 5, 'Sub Kategori D4', 'm');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `transaksi_project` int(11) NOT NULL,
  `transaksi_kategori` int(11) NOT NULL,
  `transaksi_sub_kategori` int(11) DEFAULT NULL,
  `transaksi_rencana_volume` float NOT NULL,
  `transaksi_rencana_harga` float DEFAULT NULL,
  `transaksi_rencana_jumlah` float DEFAULT NULL,
  `transaksi_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `transaksi_project`, `transaksi_kategori`, `transaksi_sub_kategori`, `transaksi_rencana_volume`, `transaksi_rencana_harga`, `transaksi_rencana_jumlah`, `transaksi_keterangan`) VALUES
(4, 13, 4, 10, 120, 20, 2400, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `user_nama` varchar(100) DEFAULT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_foto` varchar(100) DEFAULT NULL,
  `foto_path` varchar(255) DEFAULT NULL,
  `hrm_level` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `pegawai_id`, `user_nama`, `user_username`, `user_password`, `user_foto`, `foto_path`, `hrm_level`) VALUES
(1, NULL, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin_avatar.jpg', NULL, 'Admin'),
(24, 17, 'Hatrick Febriadi Aslam', 'hatrick.aslam@banktanah.id', 'ddcf1a05fc21c90c386c63ae7d0d538c', '7e6dc1c9596b9015b270fad8d44e4bbc.png', 'http://localhost/hr-dashboard/gambar/user/7e6dc1c9596b9015b270fad8d44e4bbc.png', 'Admin'),
(26, 18, 'Eka Wira Buana', 'eka.wira@banktanah.id', 'ddcf1a05fc21c90c386c63ae7d0d538c', 'ade47d20228cc3a6d88b2e786136dfe7.png', 'http://localhost/hr-dashboard/gambar/user/ade47d20228cc3a6d88b2e786136dfe7.png', 'Pegawai'),
(27, 19, 'Adhiya Kandiana', 'adhiya.kandiana@banktanah.id', '21232f297a57a5a743894a0e4a801fc3', 'd12560996cebd6dd0307aff16a9065aa.png', 'http://localhost/hr-dashboard/gambar/user/d12560996cebd6dd0307aff16a9065aa.png', 'Pegawai'),
(28, 16, 'Mario Alvin Vetter', 'mario.alvin@banktanah.id', '21232f297a57a5a743894a0e4a801fc3', '3076f3c8721618acaf50ce51620b9aac.png', 'http://localhost/hr-dashboard/gambar/user/3076f3c8721618acaf50ce51620b9aac.png', 'Pegawai'),
(30, 83, 'Dummy Admin', 'dummy.admin@banktanah.id', 'ddcf1a05fc21c90c386c63ae7d0d538c', '6a15551a458f75c5b95f9a4b28782d9f.png', 'http://localhost/hr-dashboard/gambar/user/6a15551a458f75c5b95f9a4b28782d9f.png', 'Admin'),
(31, 82, 'Dummy User', 'dummy.user@banktanah.id', 'ddcf1a05fc21c90c386c63ae7d0d538c', 'c8e28831d0c18bfcd901b52a2fd97130.png', 'http://localhost/hr-dashboard/gambar/user/c8e28831d0c18bfcd901b52a2fd97130.png', 'Pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role_nama` varchar(100) NOT NULL,
  `role_desc` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role_nama`, `role_desc`) VALUES
(2, 'Admin', NULL),
(3, 'User', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`akses_id`);

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`apps_id`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`divisi_id`);

--
-- Indexes for table `divisi_bagian`
--
ALTER TABLE `divisi_bagian`
  ADD PRIMARY KEY (`divisi_bagian_id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`jabatan_id`);

--
-- Indexes for table `jabatan_general`
--
ALTER TABLE `jabatan_general`
  ADD PRIMARY KEY (`jabatan_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`pegawai_id`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`pendidikan_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `realisasi`
--
ALTER TABLE `realisasi`
  ADD PRIMARY KEY (`realisasi_id`);

--
-- Indexes for table `status_pegawai`
--
ALTER TABLE `status_pegawai`
  ADD PRIMARY KEY (`status_pegawai_id`);

--
-- Indexes for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `akses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `apps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `divisi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `divisi_bagian`
--
ALTER TABLE `divisi_bagian`
  MODIFY `divisi_bagian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `jabatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `jabatan_general`
--
ALTER TABLE `jabatan_general`
  MODIFY `jabatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `pegawai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `pendidikan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `realisasi`
--
ALTER TABLE `realisasi`
  MODIFY `realisasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status_pegawai`
--
ALTER TABLE `status_pegawai`
  MODIFY `status_pegawai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
