-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 13, 2021 at 09:26 AM
-- Server version: 10.5.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u491816900_klinik_mahotta`
--

-- --------------------------------------------------------

--
-- Table structure for table `alkes_kontrol_kehamilan`
--

CREATE TABLE `alkes_kontrol_kehamilan` (
  `id` int(5) NOT NULL,
  `no_periksa` varchar(30) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `jml_barang` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `alkes_periksa_lab`
--

CREATE TABLE `alkes_periksa_lab` (
  `id` int(11) NOT NULL,
  `no_sampel` varchar(30) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `jml_barang` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alkes_periksa_lab`
--

INSERT INTO `alkes_periksa_lab` (`id`, `no_sampel`, `kode_barang`, `jml_barang`) VALUES
(1, '000912/20211115/000722', 'BRG1636430074', 1);

-- --------------------------------------------------------

--
-- Table structure for table `alkes_periksa_rapid`
--

CREATE TABLE `alkes_periksa_rapid` (
  `id` int(11) NOT NULL,
  `no_sampel` varchar(30) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `jml_barang` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `last_sync`
--

CREATE TABLE `last_sync` (
  `id` int(1) NOT NULL,
  `last_sync` datetime NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `last_sync`
--

INSERT INTO `last_sync` (`id`, `last_sync`, `dtm_crt`, `dtm_upd`) VALUES
(1, '2018-05-19 21:33:18', '2018-03-27 11:37:36', '2018-05-19 21:33:18');

-- --------------------------------------------------------

--
-- Table structure for table `no_sync_table`
--

CREATE TABLE `no_sync_table` (
  `table_name` varchar(60) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `no_sync_table`
--

INSERT INTO `no_sync_table` (`table_name`, `dtm_crt`, `dtm_upd`) VALUES
('tbl_hak_akses', '2018-03-29 15:55:57', '2018-03-29 15:55:57'),
('tbl_master_sequence', '2018-03-29 15:55:57', '2018-03-29 15:55:57'),
('last_sync', '2018-04-02 14:31:16', '2018-04-02 14:31:16'),
('no_sync_table', '2018-03-29 15:57:27', '2018-03-29 15:57:27'),
('tbl_menu', '2018-03-29 16:33:21', '2018-03-29 16:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_absensi_pegawai`
--

CREATE TABLE `tbl_absensi_pegawai` (
  `id_absensi` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `jam_datang` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `tanggal` date NOT NULL,
  `id_shift` int(11) NOT NULL,
  `durasi_lembur` int(11) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agama`
--

CREATE TABLE `tbl_agama` (
  `id_agama` int(11) NOT NULL,
  `agama` varchar(30) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_agama`
--

INSERT INTO `tbl_agama` (`id_agama`, `agama`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'ISLAM', '2018-03-27 10:32:18', '2018-03-25 10:32:18'),
(2, 'KRISTEN', '2018-03-27 10:32:18', '2018-03-25 10:32:18'),
(3, 'HINDU', '2018-03-27 10:32:18', '2018-03-25 10:32:18'),
(4, 'BUDHA', '2018-03-27 10:32:18', '2018-03-25 10:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akun`
--

CREATE TABLE `tbl_akun` (
  `id_akun` int(11) NOT NULL,
  `no_akun` varchar(15) NOT NULL,
  `nama_akun` varchar(100) NOT NULL,
  `level` int(1) NOT NULL,
  `id_main_akun` int(5) NOT NULL,
  `sifat_debit` int(1) NOT NULL,
  `sifat_kredit` int(1) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_akun`
--

INSERT INTO `tbl_akun` (`id_akun`, `no_akun`, `nama_akun`, `level`, `id_main_akun`, `sifat_debit`, `sifat_kredit`, `dtm_crt`, `dtm_upd`) VALUES
(3, '1', 'HARTA', 0, 0, 1, 0, '2019-11-23 14:32:05', '2019-11-23 14:32:05'),
(4, '2', 'HUTANG', 0, 0, 0, 1, '2019-11-23 14:33:41', '2019-11-23 14:33:41'),
(5, '3', 'MODAL', 0, 0, 0, 1, '2019-11-23 14:33:41', '2019-11-23 14:33:41'),
(6, '4', 'PENDAPATAN', 0, 0, 0, 1, '2019-11-23 14:33:41', '2019-11-23 14:33:41'),
(7, '5', 'BEBAN', 0, 0, 1, 0, '2019-11-23 14:33:41', '2019-11-23 14:33:41'),
(20, '1.1.0.0', 'Kas tunai', 1, 3, 1, 0, '2019-11-28 10:34:18', '2021-10-16 05:41:09'),
(34, '5.1.0.0', 'Rumah Tangga/kantor', 1, 7, 1, 0, '2019-11-29 20:03:24', '2021-10-13 07:14:50'),
(38, '5.2.0.0', 'Gaji/Upah', 1, 7, 1, 0, '2019-12-01 13:21:06', '2021-10-12 06:37:51'),
(39, '4.1.0.0', 'Penjualan Obat', 1, 6, 0, 1, '2019-12-02 12:57:24', '2019-12-02 12:57:24'),
(40, '4.2.0.0', 'Penjualan Obat Tindakan', 1, 6, 0, 1, '2019-12-02 12:58:02', '2019-12-02 12:58:02'),
(41, '4.3.0.0', 'Penjualan Alkes', 1, 6, 0, 1, '2019-12-02 12:58:15', '2019-12-02 12:58:15'),
(42, '2.1.0.0', 'Hutang Jangka Panjang', 1, 4, 0, 1, '2019-12-02 20:18:33', '2019-12-02 20:18:33'),
(43, '5.3.0.0', 'Operasional', 1, 7, 1, 0, '2019-12-02 20:30:42', '2021-10-12 06:36:08'),
(44, '5.4.0.0', 'Retribusi', 1, 7, 1, 0, '2019-12-02 20:31:19', '2021-10-12 03:49:49'),
(45, '4.4.0.0', 'Potongan Pembelian Obat', 1, 6, 0, 1, '2019-12-03 10:05:30', '2019-12-03 10:05:30'),
(46, '4.5.0.0', 'Potongan Penjualan', 1, 6, 0, 1, '2019-12-03 11:20:03', '2019-12-03 11:20:03'),
(47, '4.6.0.0', 'Potongan Pembelian Alkes', 1, 6, 0, 1, '2019-12-03 12:44:27', '2019-12-03 12:44:27'),
(54, '1.4.0.0', 'Aset Klinik', 1, 3, 1, 0, '2019-12-06 09:43:25', '2019-12-06 09:43:25'),
(55, '1.4.1.0', 'Tanah', 2, 54, 1, 0, '2019-12-06 09:43:48', '2021-10-12 07:56:10'),
(56, '3.1.0.0', 'Modal awal', 1, 5, 0, 1, '2019-12-06 09:59:52', '2021-10-13 06:59:11'),
(57, '1.5.0.0', 'Persediaan', 1, 3, 1, 0, '2019-12-06 10:00:09', '2019-12-06 10:00:09'),
(58, '1.5.1.0', 'Persediaan Obat', 2, 57, 1, 0, '2019-12-06 10:00:33', '2019-12-06 10:00:33'),
(59, '1.5.2.0', 'Alat Kesehatan', 2, 57, 1, 0, '2019-12-06 10:00:54', '2019-12-06 10:00:54'),
(60, '1.5.3.0', 'Obat Tindakan', 2, 57, 1, 0, '2019-12-06 10:01:47', '2019-12-06 10:01:47'),
(61, '4.7.0.0', 'Klinik', 1, 6, 0, 1, '2019-12-06 10:40:03', '2019-12-06 10:40:03'),
(62, '4.7.1.0', 'Pemeriksaan', 2, 61, 0, 1, '2019-12-06 10:40:24', '2019-12-06 10:40:24'),
(63, '4.7.2.0', 'Tindakan', 2, 61, 0, 1, '2019-12-06 10:40:45', '2019-12-06 10:40:45'),
(64, '4.8.0.0', 'Potongan Obat di Klinik', 1, 6, 0, 1, '2019-12-06 10:41:36', '2019-12-06 10:41:36'),
(65, '5.5.0.0', 'Harga Pokok Penjualan (HPP)', 1, 7, 1, 0, '2019-12-06 15:53:57', '2019-12-06 15:53:57'),
(66, '5.6.0.0', 'Kasbon', 1, 7, 1, 0, '2019-12-09 14:30:43', '2019-12-09 14:30:43'),
(67, '5.7.0.0', 'ATK', 1, 7, 1, 0, '2019-12-09 14:30:58', '2019-12-09 14:30:58'),
(68, '4.7.3.0', 'Administrasi', 2, 61, 0, 1, '2019-12-13 20:20:30', '2019-12-13 20:20:30'),
(69, '4.9.0.0', 'Subsidi Klinik', 1, 6, 0, 1, '2019-12-13 20:20:56', '2019-12-13 20:20:56'),
(70, '5.8.0.0', 'Listrik', 1, 7, 1, 0, '2021-10-12 10:46:25', '2021-10-12 10:46:25'),
(71, '5.9.0.0', 'Telepon', 1, 7, 1, 0, '2021-10-12 10:46:56', '2021-10-12 10:46:56'),
(73, '5.4.1.0', 'Sampah', 2, 44, 1, 0, '2021-10-12 10:50:41', '2021-10-12 10:50:41'),
(74, '5.4.2.0', 'Keamanan Linkungan', 2, 44, 1, 0, '2021-10-12 10:51:23', '2021-10-12 04:22:55'),
(78, '5.3.1.0', 'Bensin/Tranportasi', 2, 43, 1, 0, '2021-10-12 13:36:28', '2021-10-13 08:04:08'),
(79, '5.3.2.0', 'Konsumsi', 2, 43, 1, 0, '2021-10-12 13:36:48', '2021-10-12 13:36:48'),
(80, '5.2.1.0', 'Upah dokter', 2, 38, 1, 0, '2021-10-12 13:44:52', '2021-10-12 13:44:52'),
(81, '5.2.2.0', 'Upah karyawan', 2, 38, 1, 0, '2021-10-12 13:45:18', '2021-10-12 13:45:18'),
(82, '5.2.3.0', 'Uang makan', 2, 38, 1, 0, '2021-10-12 13:45:40', '2021-10-12 13:45:40'),
(83, '5.2.4.0', 'Uang transport', 2, 38, 1, 0, '2021-10-12 13:45:59', '2021-10-12 13:45:59'),
(84, '5.2.5.0', 'Jamsostek/BPJS', 2, 38, 1, 0, '2021-10-12 13:46:19', '2021-10-12 13:46:19'),
(85, '5.2.6.0', 'Fee tindakan', 2, 38, 1, 0, '2021-10-12 13:46:35', '2021-10-12 13:46:35'),
(86, '1.4.2.0', 'Gedung', 2, 54, 1, 0, '2021-10-12 14:56:36', '2021-10-12 14:56:36'),
(87, '1.4.3.0', 'Alat & Peralatan', 2, 54, 1, 0, '2021-10-12 14:57:09', '2021-10-12 14:57:09'),
(88, '1.4.4.0', 'Komputer & Sistem', 2, 54, 1, 0, '2021-10-12 14:57:35', '2021-10-12 14:57:35'),
(89, '1.4.5.0', 'Furniture', 2, 54, 1, 0, '2021-10-12 14:58:00', '2021-10-12 14:58:00'),
(90, '1.4.6.0', 'Ac & Tv', 2, 54, 1, 0, '2021-10-12 14:58:24', '2021-10-12 14:58:24'),
(91, '1.4.7.0', 'Kendaraan', 2, 54, 1, 0, '2021-10-12 14:58:43', '2021-10-13 06:58:40'),
(92, '3.2.0.0', 'Prive/Keuntungan', 1, 5, 0, 1, '2021-10-13 08:43:56', '2021-10-13 08:43:56'),
(95, '1.3.0.0', 'Bank', 1, 3, 1, 0, '2021-11-01 13:33:00', '2021-11-01 13:33:00'),
(96, '1.3.1.0', 'Bank Mandiri', 2, 95, 1, 0, '2021-11-01 13:33:18', '2021-11-01 13:33:18'),
(99, '4.10.0.0', 'Kapitasi BPJS', 1, 6, 0, 1, '2021-11-02 15:31:08', '2021-11-02 15:31:08'),
(100, '5.10.0.0', 'Internet', 1, 7, 1, 0, '2021-11-04 11:40:53', '2021-11-04 11:40:53'),
(101, '5.11.0.0', 'Biaya ekspedisi', 1, 7, 1, 0, '2021-11-04 11:41:29', '2021-11-04 11:41:29'),
(102, '5.2.7.0', 'Komisi dokter', 2, 38, 1, 0, '2021-11-04 11:44:33', '2021-11-04 11:44:33'),
(103, '5.12.0.0', 'Beban penyusutan', 1, 7, 1, 0, '2021-11-04 11:45:11', '2021-11-04 11:45:11'),
(104, '1.6.0.0', 'Akumulasi penyusutan', 1, 3, 1, 0, '2021-11-04 11:46:25', '2021-11-04 11:46:25'),
(105, '5.12.1.0', 'Beban penyusutan tanah', 2, 103, 1, 0, '2021-11-04 11:48:13', '2021-11-04 11:48:13'),
(106, '5.12.2.0', 'Beban peyusutan gedung', 2, 103, 1, 0, '2021-11-04 11:48:42', '2021-11-04 11:48:42'),
(107, '5.12.3.0', 'Beban penyusutan kendaraan', 2, 103, 1, 0, '2021-11-04 11:49:04', '2021-11-04 11:49:04'),
(108, '5.12.4.0', 'beban penyusutan inventaris ', 2, 103, 1, 0, '2021-11-04 11:49:28', '2021-11-04 11:49:28'),
(109, '2.2.0.0', 'Hutang PO', 1, 4, 0, 1, '2021-11-23 13:24:55', '2021-11-23 13:24:55'),
(111, '3.3.0.0', 'Laba Rugi Berjalan', 1, 5, 0, 1, '2021-11-25 15:35:57', '2021-11-25 15:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akun_detail`
--

CREATE TABLE `tbl_akun_detail` (
  `id_akun_d` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `turunan1` int(11) NOT NULL,
  `turunan2` int(11) NOT NULL,
  `turunan3` int(11) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_akun_detail`
--

INSERT INTO `tbl_akun_detail` (`id_akun_d`, `id_akun`, `id_parent`, `turunan1`, `turunan2`, `turunan3`, `dtm_crt`, `dtm_upd`) VALUES
(1, 34, 7, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 38, 7, 0, 0, 0, '2019-12-01 13:21:06', '2019-12-01 13:21:06'),
(6, 39, 6, 0, 0, 0, '2019-12-02 12:57:24', '2019-12-02 12:57:24'),
(7, 40, 6, 0, 0, 0, '2019-12-02 12:58:02', '2019-12-02 12:58:02'),
(8, 41, 6, 0, 0, 0, '2019-12-02 12:58:16', '2019-12-02 12:58:16'),
(9, 20, 3, 0, 0, 0, '2019-12-02 19:25:01', '2019-12-02 19:25:01'),
(16, 42, 4, 0, 0, 0, '2019-12-02 20:18:34', '2019-12-02 20:18:34'),
(17, 43, 7, 0, 0, 0, '2019-12-02 20:30:42', '2019-12-02 20:30:42'),
(18, 44, 7, 0, 0, 0, '2019-12-02 20:31:19', '2019-12-02 20:31:19'),
(19, 45, 6, 0, 0, 0, '2019-12-03 10:05:30', '2019-12-03 10:05:30'),
(20, 46, 6, 0, 0, 0, '2019-12-03 11:20:03', '2019-12-03 11:20:03'),
(21, 47, 6, 0, 0, 0, '2019-12-03 12:44:27', '2019-12-03 12:44:27'),
(24, 54, 3, 0, 0, 0, '2019-12-06 09:43:26', '2019-12-06 09:43:26'),
(25, 55, 3, 54, 0, 0, '2019-12-06 09:43:48', '2019-12-06 09:43:48'),
(26, 56, 5, 0, 0, 0, '2019-12-06 09:59:52', '2019-12-06 09:59:52'),
(27, 57, 3, 0, 0, 0, '2019-12-06 10:00:09', '2019-12-06 10:00:09'),
(28, 58, 3, 57, 0, 0, '2019-12-06 10:00:33', '2019-12-06 10:00:33'),
(29, 59, 3, 57, 0, 0, '2019-12-06 10:00:54', '2019-12-06 10:00:54'),
(30, 60, 3, 57, 0, 0, '2019-12-06 10:01:47', '2019-12-06 10:01:47'),
(31, 61, 6, 0, 0, 0, '2019-12-06 10:40:03', '2019-12-06 10:40:03'),
(32, 62, 6, 61, 0, 0, '2019-12-06 10:40:24', '2019-12-06 10:40:24'),
(33, 63, 6, 61, 0, 0, '2019-12-06 10:40:45', '2019-12-06 10:40:45'),
(34, 64, 6, 0, 0, 0, '2019-12-06 10:41:36', '2019-12-06 10:41:36'),
(35, 65, 7, 0, 0, 0, '2019-12-06 15:53:58', '2019-12-06 15:53:58'),
(36, 66, 7, 0, 0, 0, '2019-12-09 14:30:44', '2019-12-09 14:30:44'),
(37, 67, 7, 0, 0, 0, '2019-12-09 14:30:58', '2019-12-09 14:30:58'),
(38, 68, 6, 61, 0, 0, '2019-12-13 20:20:30', '2019-12-13 20:20:30'),
(39, 69, 6, 0, 0, 0, '2019-12-13 20:20:56', '2019-12-13 20:20:56'),
(40, 70, 7, 0, 0, 0, '2021-10-12 10:46:25', '2021-10-12 10:46:25'),
(41, 71, 7, 0, 0, 0, '2021-10-12 10:46:56', '2021-10-12 10:46:56'),
(43, 73, 7, 44, 0, 0, '2021-10-12 10:50:41', '2021-10-12 10:50:41'),
(44, 74, 7, 44, 0, 0, '2021-10-12 10:51:23', '2021-10-12 10:51:23'),
(48, 78, 7, 43, 0, 0, '2021-10-12 13:36:28', '2021-10-12 13:36:28'),
(49, 79, 7, 43, 0, 0, '2021-10-12 13:36:48', '2021-10-12 13:36:48'),
(50, 80, 7, 38, 0, 0, '2021-10-12 13:44:52', '2021-10-12 13:44:52'),
(51, 81, 7, 38, 0, 0, '2021-10-12 13:45:18', '2021-10-12 13:45:18'),
(52, 82, 7, 38, 0, 0, '2021-10-12 13:45:40', '2021-10-12 13:45:40'),
(53, 83, 7, 38, 0, 0, '2021-10-12 13:45:59', '2021-10-12 13:45:59'),
(54, 84, 7, 38, 0, 0, '2021-10-12 13:46:19', '2021-10-12 13:46:19'),
(55, 85, 7, 38, 0, 0, '2021-10-12 13:46:35', '2021-10-12 13:46:35'),
(56, 86, 3, 54, 0, 0, '2021-10-12 14:56:36', '2021-10-12 14:56:36'),
(57, 87, 3, 54, 0, 0, '2021-10-12 14:57:09', '2021-10-12 14:57:09'),
(58, 88, 3, 54, 0, 0, '2021-10-12 14:57:35', '2021-10-12 14:57:35'),
(59, 89, 3, 54, 0, 0, '2021-10-12 14:58:00', '2021-10-12 14:58:00'),
(60, 90, 3, 54, 0, 0, '2021-10-12 14:58:24', '2021-10-12 14:58:24'),
(61, 91, 3, 54, 0, 0, '2021-10-12 14:58:43', '2021-10-12 14:58:43'),
(62, 92, 5, 0, 0, 0, '2021-10-13 08:43:56', '2021-10-13 08:43:56'),
(65, 95, 3, 0, 0, 0, '2021-11-01 13:33:00', '2021-11-01 13:33:00'),
(66, 96, 3, 95, 0, 0, '2021-11-01 13:33:18', '2021-11-01 13:33:18'),
(69, 99, 6, 0, 0, 0, '2021-11-02 15:31:08', '2021-11-02 15:31:08'),
(70, 100, 7, 0, 0, 0, '2021-11-04 11:40:53', '2021-11-04 11:40:53'),
(71, 101, 7, 0, 0, 0, '2021-11-04 11:41:29', '2021-11-04 11:41:29'),
(72, 102, 7, 38, 0, 0, '2021-11-04 11:44:33', '2021-11-04 11:44:33'),
(73, 103, 7, 0, 0, 0, '2021-11-04 11:45:11', '2021-11-04 11:45:11'),
(74, 104, 3, 0, 0, 0, '2021-11-04 11:46:25', '2021-11-04 11:46:25'),
(75, 105, 7, 103, 0, 0, '2021-11-04 11:48:13', '2021-11-04 11:48:13'),
(76, 106, 7, 103, 0, 0, '2021-11-04 11:48:42', '2021-11-04 11:48:42'),
(77, 107, 7, 103, 0, 0, '2021-11-04 11:49:04', '2021-11-04 11:49:04'),
(78, 108, 7, 103, 0, 0, '2021-11-04 11:49:28', '2021-11-04 11:49:28'),
(79, 109, 4, 0, 0, 0, '2021-11-23 13:24:55', '2021-11-23 13:24:55'),
(81, 111, 5, 0, 0, 0, '2021-11-25 15:35:57', '2021-11-25 15:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_apoteker`
--

CREATE TABLE `tbl_apoteker` (
  `id_apoteker` int(11) NOT NULL,
  `nama_apoteker` varchar(50) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `telp` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_sik_sipa` varchar(30) NOT NULL,
  `no_stra` varchar(30) NOT NULL,
  `tanggal_mulai_tugas` date NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_apoteker`
--

INSERT INTO `tbl_apoteker` (`id_apoteker`, `nama_apoteker`, `alamat`, `telp`, `email`, `no_sik_sipa`, `no_stra`, `tanggal_mulai_tugas`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'Apoteker', 'Banyuwangi', '083', 'apoteker@gmail.com', '123/321', '456', '2021-11-28', '2021-11-28 15:18:46', '2021-11-28 15:18:46'),
(2, 'apt. MUHAMMAD FANTONI, S.Farm', 'Lingkungan Ketapang RT.014', '085738296745', 'fantoni745@gmail.com', '440/6714.1/', 'straunej/1997', '2021-10-01', '2021-11-29 08:33:11', '2021-11-29 08:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_biaya`
--

CREATE TABLE `tbl_biaya` (
  `id_biaya` int(3) NOT NULL,
  `id_kategori_biaya` int(6) NOT NULL,
  `nama_biaya` varchar(255) NOT NULL,
  `biaya` int(10) NOT NULL,
  `tipe_biaya` enum('1','2') DEFAULT NULL COMMENT '1 = FIX, 2 =PRESENTASE',
  `presentase` double DEFAULT NULL,
  `id_biaya_presentase` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_biaya`
--

INSERT INTO `tbl_biaya` (`id_biaya`, `id_kategori_biaya`, `nama_biaya`, `biaya`, `tipe_biaya`, `presentase`, `id_biaya_presentase`) VALUES
(1, 1, 'Tes', 200000, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_biaya_sk`
--

CREATE TABLE `tbl_biaya_sk` (
  `sksehat` int(11) NOT NULL,
  `sksakit` int(11) NOT NULL,
  `rapid_antigen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_biaya_sk`
--

INSERT INTO `tbl_biaya_sk` (`sksehat`, `sksakit`, `rapid_antigen`) VALUES
(50000, 20000, 95000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bidang`
--

CREATE TABLE `tbl_bidang` (
  `id_bidang` int(11) NOT NULL,
  `nama_bidang` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bidang`
--

INSERT INTO `tbl_bidang` (`id_bidang`, `nama_bidang`) VALUES
(1, 'BIDANG 1'),
(2, 'BIDANG 2'),
(3, 'bidang 33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departemen`
--

CREATE TABLE `tbl_departemen` (
  `id_departemen` int(11) NOT NULL,
  `nama_departemen` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_departemen`
--

INSERT INTO `tbl_departemen` (`id_departemen`, `nama_departemen`) VALUES
(1, 'DEPARTEMEN 1'),
(2, 'kemanan'),
(3, 'KEUANGAN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_diagnosa_icd10`
--

CREATE TABLE `tbl_diagnosa_icd10` (
  `id_diagnosa` int(4) NOT NULL,
  `code` varchar(25) NOT NULL,
  `diagnosa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_diagnosa_icd10`
--

INSERT INTO `tbl_diagnosa_icd10` (`id_diagnosa`, `code`, `diagnosa`) VALUES
(1, 'R10.4', 'Abdominal pain'),
(2, 'H 33', 'Ablasi dan kerusakan retina'),
(3, 'H33.2', 'Ablasio Retina / Cornea'),
(4, 'O20.0', 'Abortus iminens'),
(5, 'O08.0', 'Abortus infeksius'),
(6, 'O06.9', 'Abortus inkomplit'),
(7, 'O02.1', 'Abortus insiplens'),
(8, 'O 05', 'Abortus lainnya'),
(9, 'O 04', 'Abortus medik'),
(10, 'O 03', 'Abortus spontan'),
(11, 'L02.9', 'Abses(LUKA)'),
(12, 'K65.0', 'Abses abdominal'),
(13, 'L02.4', 'Abses Akilla'),
(14, 'K 35.1', 'Abses apendicular/apendikes'),
(15, 'K35.1', 'Abses app'),
(16, 'N75.1', 'Abses bartolin'),
(17, 'J34.0', 'Abses beplum'),
(18, 'N73.5', 'Abses CD'),
(19, 'Q06.0', 'Abses cerebri'),
(20, 'L02.1', 'Abses colli'),
(21, 'H16.3', 'Abses cornea'),
(22, 'Q76.4', 'Abses coxal'),
(23, 'J86.9', 'Abses dada'),
(24, 'K05.2', 'Abses gingival'),
(25, 'N15.1', 'Abses ginjal'),
(26, 'A 06.4', 'Abses hati amuba'),
(27, 'K75.0', 'Abses hati/liver/hepar'),
(28, 'L02.2', 'Abses ingunialis'),
(29, 'L02.8', 'Abses kepala/ragio'),
(30, 'L02.4', 'Abses lutut kiri/axilla/femur/femoral'),
(31, 'N61', 'Abses mama'),
(32, 'K10.0', 'Abses mandibula'),
(33, 'G06.6', 'Abses otak'),
(34, 'J86.9', 'Abses pada dada'),
(35, 'N76.0', 'Abses pagina '),
(36, 'K12.2', 'ABSES PALATUM'),
(37, 'H00.0', 'Abses palpebra'),
(38, 'K85', 'Abses pancereas'),
(39, 'L02.3', 'Abses pantat/buttock/glutea'),
(40, 'J39.0', 'Abses paraparingeal'),
(41, 'K61.0', 'Abses parienal'),
(42, 'J 85.1, .2', 'Abses paru'),
(43, 'J85.1', 'Abses paru/lung'),
(44, 'J36', 'Abses peritonsilair'),
(45, 'K05.2', 'Abses perodental'),
(46, 'K65.0', 'Abses perut'),
(47, 'L02.2', 'Abses pinggang kiri'),
(48, 'L02.0', 'Abses pipi'),
(49, 'T81.4', 'Abses post op/luka oprasi'),
(50, 'N15.1', 'Abses renal'),
(51, 'K65.0', 'Abses Retro pritonial'),
(52, 'K12.2', 'Abses sub mandibula'),
(53, 'J86.9', 'Abses torax'),
(54, 'N70.9', 'Abses turbo ovarial (ATO)'),
(55, 'L02.2', 'Abses umbilicia/dinding (Abdomen punggung)'),
(56, 'K22.0', 'Achalasia cardia / esopagus'),
(57, 'Q39.5', 'Achelasia congenital'),
(58, 'Q40.0', 'Achelasia pylorus'),
(59, 'R10.0', 'Acut abdomen'),
(60, 'J20.9', 'Acut laringo tracea broncitis'),
(61, 'C92.0', 'Acut myelocitic leukemia (AML)'),
(62, 'J80', 'Acut respiratory distress syndrom'),
(63, 'K72.0', 'Acute hepatic failure'),
(64, 'D16.5', 'Adamantinoma'),
(65, 'C11.1', 'Adeno ca'),
(66, 'C16.9', 'Adeno ca. gaster '),
(67, 'C18.9', 'Adeno Ca.Colon'),
(68, 'C34.9', 'Adeno Ca.paru'),
(69, 'J35.2', 'Adeno tonsilitis cronis'),
(70, 'N80.0', 'Adenomycosio'),
(71, 'N70.9', 'Adnexitis'),
(72, 'O64.1', 'After Coming head'),
(73, 'D 70', 'Agranulositosus'),
(74, 'T 15, T 17 - T19', 'Akibat dari kemasukan benda asing melalui  lubang tubuh'),
(75, 'T78.4', 'Alergi'),
(76, 'J 30.3', 'Alergi rhinitis akibat kerja'),
(77, 'C95.7', 'Aleukimia leukimia'),
(78, 'C91.0', 'ALL'),
(79, 'A06.9', 'Amebiasis'),
(80, 'A 06.0-.3 .5-.9', 'Amebiasis lainnya'),
(81, 'N 91.0, .1, .2', 'Amenore'),
(82, 'N91.2', 'Amenorrhea'),
(83, 'I21.9', 'AMI ( infark miokard akut)'),
(84, 'S98.1', 'Amputasi jari kaki satu'),
(85, 'D64.8', 'Anemia (gravio)'),
(86, 'D 61', 'Anemia aplastik lainnya'),
(87, 'D 50', 'Anemia defisiensi zat besi'),
(88, 'D58.9', 'Anemia hemolitik'),
(89, 'D 59', 'Anemia Hemolitik'),
(90, 'D 51 – D 58,  D 60, D 62 ', 'Anemia lainnya'),
(91, 'D50.0', 'Anemia pasca pendarahan'),
(92, 'Q00.0', 'Anencepalus bayi'),
(93, 'Q35.0', 'anencepalus ibu'),
(94, 'I71.4', 'Aneorisme Aorta Abdominal'),
(95, 'I71.9', 'Aneuryama aorta'),
(96, 'I20.9', 'Angina pictoris '),
(97, 'I20.0', 'angina pictoris unsiable/fasca infark'),
(98, 'D10.6', 'Angio fibroma nasofaring'),
(99, 'T78.3', 'Angioauritic Alergi'),
(100, 'Q89.9', 'Anomali intra cranial'),
(101, 'O99.0', 'Anomia post partum '),
(102, 'Q11.1', 'Anoptalmia'),
(103, 'R63.0', 'Anorexia'),
(104, 'A 22', 'Anthraks'),
(105, 'O62.2', 'Antonea Uteri'),
(106, 'F41.9', 'Anxietas'),
(107, 'I35.1', 'Aorta insufisianis'),
(108, 'Q25.3', 'Aorta stenosis '),
(109, 'R47.0', 'Apasia'),
(110, 'O48.9', 'APB'),
(111, 'H27.0', 'Apekia'),
(112, 'K37', 'Apendicitis'),
(113, 'K35.9', 'Apendicitis acut'),
(114, 'K36', 'Apendicitis kronis'),
(115, 'K35.0', 'Apendicitis perforasi'),
(116, 'K38.1', 'Apendicular'),
(117, 'K38.1', 'Apendix infilltrat'),
(118, 'R06.8', 'Apnea'),
(119, 'P28.4', 'Apnea bayi'),
(120, 'R06.8', 'Apneic spell'),
(121, 'A06.9', 'AR'),
(122, 'I49.0', 'Aritmia'),
(123, 'M25.5', 'Artialgia'),
(124, 'M13.9', 'Artretis '),
(125, 'M 08 - M 09', 'Artritis belia'),
(126, 'M 00 - M 01', 'Artritis piogenik dan artritis pada penyakit infeksi dan parasit YDK di tempat lain'),
(127, 'M 05 - M 06', 'Artritis reumatoid'),
(128, 'M 12 - M 14', 'Artropati dan artritis'),
(129, 'M 02 - M 03', 'Artropati reaktif'),
(130, 'M 15 - M 19', 'Artrosis'),
(131, 'B77.9', 'Ascariasis'),
(132, 'R18', 'Ascites'),
(133, 'Q21.1', 'ASD ( Atreal septa depta )'),
(134, 'Z31.2', 'Aseptor implant'),
(135, 'E87.2', 'Asidosis metabdik'),
(136, 'J 45', 'Asma akibat kerja'),
(137, 'J45.9', 'Asma bronciale (AB)'),
(138, 'R09.0', 'Asphixia'),
(139, 'P21.0', 'Asphixia berat'),
(140, 'P21.1', 'asphixia ringan'),
(141, 'T17.1', 'Aspirasi hidung '),
(142, 'P24.0', 'Aspirasi mecodum'),
(143, 'T17.9', 'Aspirasi minyak T /Bd.Asing/Food'),
(144, 'J69', 'Aspirasi pnemunea dewasa'),
(145, 'P24.1', 'Aspirasi pnemunia bayi'),
(146, 'R53', 'Astenea '),
(147, 'J98.1', 'Atelactasis'),
(148, 'I 70', 'Aterosklerosis'),
(149, 'I70.9', 'Atoroma'),
(150, 'Q42.3', 'Atresia ani '),
(151, 'Q 41.0', 'Atresia duodeni'),
(152, 'Q41.0', 'Atresia Ileum'),
(153, 'Q42.1', 'Atresia rectum '),
(154, 'I48', 'Atrial fibrilasi (AF)'),
(155, 'M08.0', 'Atritis Rematik'),
(156, 'I44.3', 'AV block'),
(157, 'T14.7', 'Avulsion'),
(158, 'R79.8', 'Azotermia'),
(159, 'N48.1', 'Balanitis'),
(160, 'N48.1', 'balanitis '),
(161, 'C44.1', 'Basalioma Canthus lateralis'),
(162, 'C44.3', 'Basalioma hidung/pipi/mata'),
(163, 'C44.2', 'Basalioma telinga '),
(164, 'N20.0', 'Batu btaghorn'),
(165, 'K80.8', 'Batu empedu'),
(166, 'N20.0', 'Batu ginjal'),
(167, 'N21.1', 'Batu uretra /BBB'),
(168, 'A37.9', 'batuk rejan ( pertusis)'),
(169, 'Z33', 'bayi belum lahir ( infartu)'),
(170, 'P08.0', 'Bayi besar'),
(171, 'P92.2', 'bayi kurang minum'),
(172, 'Z 38', ''),
(173, 'P95', 'bayi mati'),
(174, 'O36.4', 'bayi meninggal ibu hidup (KJDR)'),
(175, 'Z38.0', 'bayi normal'),
(176, 'P03.4', 'Bayi sectio'),
(177, 'P03.3', 'Bayi vakum'),
(178, 'F05.0', 'BBLR'),
(179, 'T 16', 'Benda asing pada telinga'),
(180, 'Y04', 'berkelahi'),
(181, 'Q 35 - Q 37', 'Bibir celah dan langit-langit celah'),
(182, 'Q36.9', 'Bibir sumbing'),
(183, 'O02.0', 'Bilgted ovum'),
(184, 'K80.5', 'Biliary kolik'),
(185, 'J 66.0', 'Bisinosis'),
(186, 'N93.0', 'Bleeding post coitus'),
(187, 'B50.8', 'Block Water Fever'),
(188, 'K92.1', 'Bloody diare'),
(189, 'R00.1', 'Bmdicardia'),
(190, 'N75.8', 'bortolintitis'),
(191, 'N10', 'BPH ( prostat)'),
(192, 'P14.3', 'Bracial Palsy'),
(193, 'J47', 'Bronciektasis'),
(194, 'J21.9', 'Bronciolitis /Acut'),
(195, 'J40', 'Broncitis'),
(196, 'J20.9', 'Broncitis acut'),
(197, 'J42', 'Broncitis kronik'),
(198, 'J18.0', 'Bronco pnemunia'),
(199, 'J 47', 'Bronkiektasis'),
(200, 'J 20 - J 21', 'Bronkitis akut dan bronkiolitis akut'),
(201, 'J 40 - J 44', 'Bronkitis, emfisema dan penyakit paru obstruktif kronik lainnya'),
(202, 'A 23', 'Bruselosis'),
(203, 'Z47.0', 'Buka pen'),
(204, 'Z30.5', 'Buka spiral'),
(205, 'X76.0', 'bunuh diri dengan membakar diri '),
(206, 'X70', 'bunuh diri dengan menusuk badan '),
(207, 'E78.3', 'Burger O'),
(208, 'T21', 'Burt abdomen'),
(209, 'H 54', 'Buta dan rabun'),
(210, 'C54.1', 'CA ewametrium'),
(211, 'C67.9', 'Ca. Blader'),
(212, 'C68.0', 'Ca. Buli-buli'),
(213, 'C18.0', 'Ca. Caecum'),
(214, 'C53.9', 'Ca. Cerviks'),
(215, 'C76.0', 'ca. Coll'),
(216, 'C18.9', 'Ca. Colon'),
(217, 'C54.9', 'ca. Corpus'),
(218, 'C44', 'Ca. Epidermoid'),
(219, 'C15.9', 'Ca. Esopagus'),
(220, 'C40.2', 'Ca. Femur'),
(221, 'C16.9', 'Ca. Gaster/lambung'),
(222, 'C77.9', 'ca. Gland (kelenjar)'),
(223, 'C32.9', 'Ca. Laring'),
(224, 'C02.9', 'Ca. Lidah'),
(225, 'C50.9', 'Ca. Mama'),
(226, 'C41.1', 'Ca. Mandibula'),
(227, 'C11.9', 'Ca. Nesofaring'),
(228, 'C56', 'Ca. Ovari'),
(229, 'C05.9', 'Ca. Palata'),
(230, 'C25.9', 'Ca. Pancereas'),
(231, 'C76.3', 'Ca. Pantat'),
(232, 'L 07', 'Ca. Parotis ( pinggang)'),
(233, 'C34.1', 'Ca. Paru'),
(234, 'C60.9', 'ca. Penis'),
(235, 'C55', 'Ca. Rahim/uterus'),
(236, 'C20', 'Ca. Recti'),
(237, 'C18.7', 'Ca. Sigmoid'),
(238, 'C76.0', 'ca. Squo mous cell'),
(239, 'C51.9', 'Ca. Tibia'),
(240, 'C52', 'Ca. Vagina'),
(241, 'C22.1', 'Ca.chalangio'),
(242, 'C58', 'ca.corio'),
(243, 'C61', 'Ca.prostat'),
(244, 'C73', 'Ca.teroid'),
(245, 'Q03.0', 'cacat bawaan '),
(246, 'I25.1', 'CAD/CHD (PJK)'),
(247, 'B 05', 'Campak'),
(248, 'B05.9', 'campak/measles'),
(249, 'B37.9', 'candidiasis'),
(250, 'P12.8', 'Capul succedonum'),
(251, 'K76.1', 'cardioac cirosis'),
(252, 'K76.1', 'cardioac cirosis'),
(253, 'R57.0', 'cardiogenic syok'),
(254, 'I42.9', 'cardiomeapaty'),
(255, 'I51.7', 'cardiomegali'),
(256, 'C44.2', 'carsinoma telinga'),
(257, 'C55', 'carsinoma utery'),
(258, 'Q12.0', 'catarac'),
(259, 'H26.2', 'Catarac compilated'),
(260, 'H26.0', 'catarac muda ( juvenil)'),
(261, 'H26.4', 'catarac scondary'),
(262, 'H26.1', 'Catarac traumatik'),
(263, 'H25.2', 'Catarac tua(mature)'),
(264, 'S 26 - S 27', 'Cedera alat dalam lainnya'),
(265, 'S 06', 'Cedera intrakranial'),
(266, 'P 10 - P 15', 'Cedera lahir'),
(267, 'S 05', 'Cedera mata dan orbita'),
(268, 'S 36 - S 37 S 97-98, T04-', 'Cedera remuk dan trauma amputasi YDT dan daerah badan multipel'),
(269, 'S00-S01, S04, S09-S11, ', 'Cedera YDT lainnya, YTT dan daerah badan multipel'),
(270, 'L03.9', 'celuitis'),
(271, 'H05.0', 'celulitis orbita'),
(272, 'R51', 'cepalgia'),
(273, 'P12.0', 'cepalhematoma bayi'),
(274, 'S08.8', 'cepalhematoma bayi traumatik'),
(275, 'P12.0', 'cepalhomatoma bayi'),
(276, 'G93.9', 'cerebral '),
(277, 'G80.9', 'cerebral palsy (CP)'),
(278, 'H61.2', 'cerumen'),
(279, 'M53.1', 'cervisal syndrome'),
(280, 'K74.6', 'CH (cirosis hati)'),
(281, 'H00.1', 'chalazion'),
(282, 'R07.4', 'chest pain'),
(283, 'I50.0', 'CHF (gagal jantung kongestif)'),
(284, 'A 92.0', 'Chikungunya'),
(285, 'K80.5', 'choledocholitiasis'),
(286, 'K80.2', 'cholelitiasis'),
(287, 'K83.1', 'cholestasis'),
(288, 'K83.1', 'cholestasis'),
(289, 'K81.9', 'cholicystitis'),
(290, 'K81.0', 'cholicystitis acut'),
(291, 'M98.8', 'chondroitis'),
(292, 'N48.9', 'chordea'),
(293, 'G25.5', 'Chorea'),
(294, 'C58', 'chorio cersininoma'),
(295, 'E24.9', 'chusing syndrome'),
(296, 'L90.5', 'cicatrix'),
(297, 'D06.9', 'CIN ( carsinoma insitu cerviks)'),
(298, 'K76.1', 'ciroses cardiac'),
(299, 'T17.1', 'cirosis alineum cav.nasi'),
(300, 'N03.9', 'CKD (cronic kidny disease)'),
(301, 'K76.0', 'CLD'),
(302, 'K76.9', 'CLD'),
(303, 'C91.1/M9823/3', 'CLL'),
(304, 'C92.1/M98/G31.3', 'CMI'),
(305, 'A00.9', 'colera'),
(306, 'R10.4', 'colic abdomen'),
(307, 'R10.4', 'colic abdomen'),
(308, 'N23', 'colic ureter'),
(309, 'N23', 'colit renal ginjal'),
(310, 'A09', 'Colitis (acut)'),
(311, 'A06.0', 'colitis amooba'),
(312, 'K51.9', 'colitis ulceritiva'),
(313, 'K51.9', 'colitis ulkiraliv'),
(314, 'A16.2', 'Coll abses'),
(315, 'Q80.2', 'colodian baby'),
(316, 'K92.1', 'colon post radiasi'),
(317, 'K91.4', 'colostomi prolaps'),
(318, 'K91.4', 'colostomy'),
(319, 'R40.2', 'coma'),
(320, 'P91.5', 'coma bayi'),
(321, 'E14.0', 'coma diabetic'),
(322, 'K72.9', 'coma hepaticum'),
(323, 'E14.0', 'coma hiperglikemik'),
(324, 'E15', 'coma hipoglikemik'),
(325, 'E14.0', 'coma honk ( hiper osmolarilas non ketosis)'),
(326, 'N19', 'coma uremikum'),
(327, 'N19', 'coma urine'),
(328, 'T31.1', 'combustio grade 10-19%'),
(329, 'T31.3', 'combustio grade 30-39%'),
(330, 'T31.6', 'combustio grade 60-69%'),
(331, 'T31.7', 'combustio grade 70-79%'),
(332, 'T22.1', 'combustio lengan '),
(333, 'L70.0', 'comedo'),
(334, 'R41.0', 'comfusi'),
(335, 'D13.5', 'comon bill duct (CBD)'),
(336, 'J00', 'comon colid'),
(337, 'T14.2', 'compresion'),
(338, 'G93.5', 'compressisi medula spinalis'),
(339, 'A63.0', 'condiloma acuminatum'),
(340, '', 'Congenital centralis /PSC'),
(341, 'H13.1', 'conjungtivitas neunatal gonocokal'),
(342, 'H10.9', 'conjungtivitis'),
(343, 'M62.9', 'conraktur otot /leher'),
(344, 'K59.0', 'contifation'),
(345, 'M79.9', 'contractur akilla'),
(346, 'M24.4', 'contraktur alku kanan/elbow'),
(347, 'M20.0', 'contraktur jari kaki kiri'),
(348, 'M62.4', 'contraktur musole'),
(349, 'S06.2', 'contusio cerebri /CKB'),
(350, 'S06.0', 'contusio cerebril/CKS/CKR'),
(351, 'S05.8', 'contusio mata'),
(352, 'S34.3', 'contusio modula spinalis'),
(353, 'T14.6', 'contusio muscolorum'),
(354, 'T14.6', 'contusio otot leher'),
(355, 'S30.2', 'contusio penis'),
(356, 'S37.0', 'contusio renis'),
(357, 'S20.2', 'contusio torax'),
(358, 'R56.8', 'convulsi ( kejang)'),
(359, 'J44.9', 'COPD/PPOM'),
(360, 'I27.9', 'cor pulmunale cronic ( CPC)'),
(361, 'T17.2', 'corpus alienum hipoparing'),
(362, 'T17.5', 'Corpus Alineum Broncus '),
(363, 'S21.0', 'corpus alineum peluru'),
(364, 'S29.9', 'corpus alineumthoacal (punggung)'),
(365, 'M13.1', 'coxitis'),
(366, 'J81', 'CPA ( odema perut akut)'),
(367, 'Q33.9', 'CPD'),
(368, 'H34.2', 'CRAO'),
(369, 'N18.9', 'CRF/GGK'),
(370, 'K76.9', 'cronic liver disease'),
(371, 'J98.4', 'cronic lung disiase'),
(372, 'J05.0', 'Croup'),
(373, 'M53.1', 'CRS'),
(374, 'S97.8', 'crush foot'),
(375, 'S95.9', 'crush injuri cruris'),
(376, 'Q66.0', 'CTEV'),
(377, 'N94.1', 'Cuitus'),
(378, 'L02.4', 'curetage skin'),
(379, 'I 64', 'CVA'),
(380, 'I61.9', 'CVA bleeding/hemorage/HS'),
(381, 'I63.9', 'CVA infak'),
(382, 'I67.9', 'CVD'),
(383, 'I66.9', 'CVD trombosit'),
(384, 'R23.0', 'cyanosis'),
(385, 'N30.9', 'cyatitis'),
(386, 'Q24.9', 'cynotic CHD'),
(387, 'N75.0', 'cysta bartolini'),
(388, 'L72.1', 'cysta cebaceaus'),
(389, 'G93.0', 'cysta cerebrl'),
(390, 'N80.1', 'cysta coklat'),
(391, 'H11.4', 'cysta conjunctiva'),
(392, 'H04.8', 'cysta ductus laclimaris'),
(393, 'N85.8', 'cysta endometrium'),
(394, 'I72.0', 'cysta epidermoid'),
(395, 'H02.8', 'Cysta eyelld (kelopak mata)'),
(396, 'K09.0', 'cysta folikuler'),
(397, 'I51.9', 'cysta hati'),
(398, 'N60.0', 'cysta mama'),
(399, 'K09.2', 'cysta maxijja'),
(400, 'J34.1', 'cysta nasal(binus)'),
(401, 'N83.2', 'Cysta overy'),
(402, 'K86.2', 'cysta pancereas'),
(403, 'Q18.1', 'cysta preauriculer'),
(404, 'K04.8', 'cysta radioculer'),
(405, 'Q18.1', 'cysta retro kurikuler'),
(406, 'D46.6', 'cysta sarcoma'),
(407, 'K11.6', 'cysta sub mandibula'),
(408, 'Q89.2', 'cysta thyrogiasus'),
(409, 'E04.1', 'cysta tiroid'),
(410, 'N81.1', 'cystocele (female)'),
(411, 'N32.8', 'cystocele (male)'),
(412, 'N81.4', 'cystocele (prolaps uteri)'),
(415, 'O02.1', 'dead conseptus'),
(416, 'I51.9', 'Decom cordis'),
(417, 'L89', 'decubitus(ulcer)'),
(418, 'E 50', 'Defisiensi vitamin A'),
(419, 'E 51 - E 56', 'Defisiensi vitamin lainnya'),
(420, 'Q 66', 'Deformasi kongenital kaki'),
(421, 'Q 65', 'Deformasi kongenital sendi panggul'),
(422, 'K06.8', 'deformiti gum'),
(423, 'E06', 'dehidrasi'),
(424, 'R62.8', 'deloyed depelopment'),
(425, 'F80.9', 'deloyed movement'),
(426, 'L02.9', 'demam abses'),
(427, 'A 91', 'Demam berdarah dengue'),
(428, 'A 68', 'Demam bolak balik'),
(429, 'A 90', 'Demam dengue'),
(430, 'A 95', 'Demam kuning'),
(431, 'I00', 'demam rematik'),
(432, 'I 00 - I 02', 'Demam reumatik akut'),
(433, 'A 01', 'Demam tifoid dan paratifoid'),
(434, 'A 75', 'Demam tifus'),
(435, 'A01.0', 'demam tipoid'),
(436, 'A 93 - A 94 A 96 - A 99', 'Demam virus dan demam berdarah virus tular serangga lainnya'),
(437, 'A 92.1 - A 92', 'Demam virus tular nyamuk'),
(438, 'R 50', 'Demam yang sebabnya tidak diketahui'),
(439, 'F 00 - F 03 ', 'Demensia'),
(440, 'F03', 'dementia senlititis'),
(441, 'A90', 'dengue'),
(442, 'A90', 'Dengue fever'),
(443, 'E 86', 'Deplesi volume (dehidrasi)'),
(444, 'F32.9', 'depresi'),
(445, 'M 20 - M 21', 'Derformitas tungkai didapat'),
(446, 'L30.8', 'Dermatitis'),
(447, 'L 23 - L 24', 'Dermatosis akibat kerja'),
(448, 'N94.6', 'Desmenorrhea'),
(449, 'K30', 'Despepsia'),
(450, 'J34.2', 'deviasi septuri'),
(451, 'G36.0', 'devic\'s desease'),
(452, 'Q24.0', 'dextrocordia'),
(453, 'A91', 'DHF/DSS'),
(454, 'E 10', 'Diabetes melitus bergantung insulin'),
(455, 'E 12', 'Diabetes melitus berhubungan malnutrisi'),
(456, 'O 24', 'Diabetes melitus dalam kehamilan'),
(457, 'E 11', 'Diabetes melitus tidak bergantung insulin'),
(458, 'E 13', 'Diabetes melitus YDT lainnya'),
(459, 'E 14', 'Diabetes melitus YTT '),
(460, 'A 09', 'Diare & gastroenteritis oleh penyebab infeksi tertentu (kolitis infeksi)'),
(461, 'P78.3', 'diare bayi baru lahir'),
(462, 'A09', 'diare yang ada hasil lab'),
(463, 'K52.9', 'diare yang tidak ada leb'),
(464, 'D69.9', 'diathesis hemorrhage'),
(465, 'W45.0', 'dibacok/ditebas/ditusuk maling'),
(466, 'X 85 - Y 09', 'Dicederai'),
(467, 'N86', 'dicubitus ( cerviks)'),
(468, 'T14.4', 'diffuse axonal injury'),
(469, 'A 36', 'Difteria'),
(470, 'W54.0', 'digigit anjing ( dogbite)'),
(471, 'Y04.0', 'dikeroyok'),
(472, 'I51.7', 'Dilated cardio myopanti (DCM)'),
(473, 'Y04', 'dipikul'),
(474, 'H53.2', 'diplopia'),
(475, 'A36.9', 'Dipteria'),
(476, 'A06.0', 'disentri amoeba'),
(477, 'A03.9', 'disentri basiler'),
(478, 'W64.9', 'diseruduk kerbau'),
(479, 'R13', 'Disfagia'),
(480, 'G93.9', 'disfungsi batang otak'),
(481, 'T14.3', 'Dislokasi'),
(482, 'S93.0', 'Dislokasi Ankle'),
(483, 'S43.0', 'Dislokasi bahu/humerus'),
(484, 'S53.1', 'dislokasi elbow/siku'),
(485, 'S73.0', 'Dislokasi HIP'),
(486, 'H27.1', 'Dislokasi lensa'),
(487, 'S83.1', 'dislokasi lutut'),
(488, 'S03.0', 'Dislokasi mandibula'),
(489, 'S33.2', 'Dislokasi panggul kiri'),
(490, 'S03.0', 'dislokasi TMJ'),
(491, 'S 03, 13, 23, 33, 43, 53 ', 'Dislokasi, terkilir, teregang YDT dan daerah badan multipel'),
(492, 'K 30', 'Dispepsia '),
(493, 'R14', 'distension abdomen'),
(494, 'O66.9', 'Distocia'),
(495, 'P22.9', 'Distress pernapasan bal'),
(496, 'J98.4', 'distroyed lung'),
(497, 'V03.1', 'ditabrak mobil dari belakang sedang jalan'),
(498, 'W34.0', 'ditembak'),
(499, 'Q43.0', 'diverticula meckel\'s'),
(500, 'E14.9', 'DM'),
(501, 'E14.5', 'DM gangren'),
(502, 'E10', 'DM Juvenil'),
(503, 'E14.2', 'DM nepropaty'),
(504, 'G81.9', 'doble hemiparese'),
(505, 'M 40 - M 44, M 54.6, .8, ', 'Dorsopati lainnya'),
(506, 'Q90.9', 'down syndrom'),
(507, 'B 72', 'Drakunkuliasis'),
(508, 'P03.6', 'drip normal bayi'),
(509, 'I62.1', 'Drip normal ibu'),
(510, 'T75.1', 'Drowning'),
(511, 'L27.0', 'drug eruption '),
(512, 'T43.3', 'drug induce halopridal'),
(513, 'F19.0', 'drug intoxication'),
(514, 'T88.7', 'drugindiced hepatitis'),
(515, 'N93.8', 'DUB'),
(516, 'K29.8', 'Duodenitis'),
(517, 'I82.9', 'DVT'),
(518, 'R49.0', 'dysphonia'),
(519, 'I49.9', 'dysrhytmia'),
(522, 'R60.1', 'edema anasorhe'),
(523, 'G93.6', 'edema cerebral '),
(524, 'H02.8', 'edema eyelid mata'),
(525, 'H47.1', 'edema papil'),
(526, 'J81', 'edema paru akut'),
(527, 'N90.8', 'edema vulva'),
(528, 'O 10 - O 13, O 16', 'Edema, proteinuria dan gangguan hipertensi dalam kehamilan, persalinan dan masa nifas'),
(529, 'S06.4', 'EDH ( epidural hematoma)'),
(530, 'H 83.3', 'Efek kebisingan telinga bagian dalam'),
(531, 'T 67', 'Efek panas dan pencahayaan'),
(532, 'T 66', 'Efek radiasi YTT'),
(533, 'Y 40 - Y 59', 'Efek samping pengguna obat, bahan obat dan bahan biologik'),
(534, 'T 33 - T 35, T 68 - T69  ', 'Efek sebab luar lainnya dan YTT pembedahan dan perawatan YTK di tempat lain'),
(535, 'T 70', 'Efek tekanan udara dan tekanan air'),
(536, 'T 51, T 53 -T 55 , T 57 -', 'Efek toksik bahan non medisinal lainnya'),
(537, 'J90', 'efusi pleura'),
(538, 'J 90 - J 91', 'Efusi pleura (empiema)'),
(539, 'B 67', 'Ekinokokosis'),
(540, 'O15.9', 'eklampsia'),
(541, 'O 15', 'Eklampsia'),
(542, 'Q24.8', 'Ektopic cordis'),
(543, 'T75.4', 'elektrik shook'),
(544, 'I 74', 'Emboli dan trombosis arteri'),
(545, 'I 26', 'Emboli paru'),
(546, 'R11', 'emesis'),
(547, 'J43.9', 'empisema paru'),
(548, 'J86.9', 'empyema'),
(549, 'G93.4', 'encepalopati'),
(550, 'J38', 'endocarditia'),
(551, 'N80.9', 'endometnosis'),
(552, 'N 80', 'Endometriosis'),
(553, 'N71.9', 'endometritis'),
(554, 'H44.0', 'endoptalmitis'),
(555, 'G04.9', 'ensefalitis'),
(556, 'A 83 - 86', 'Ensefalitis virus'),
(557, 'K72.9', 'ensepalopati hepatikum'),
(558, 'A09', 'enteritis'),
(559, 'K63.2', 'entrocular fistula'),
(560, 'Q64.1', 'entropia bulu-buli'),
(561, 'H02.1', 'entropien mata citaticial'),
(562, 'N45.9', 'epididmitis'),
(563, 'S06.4', 'epidoral hematoma'),
(564, 'R10', 'epigastro pain'),
(565, 'J05.1', 'epigglotitis'),
(566, 'G40.9', 'epilepsi'),
(567, 'G 40 - G 41', 'Epilepsi'),
(568, 'F 32 - F 39', 'Episoda depresif, gangguan depresif  berulang, gangguan suasana perasaan (mood afektif) menetap, lainnya atau YTT'),
(569, 'F 30,  F 31', 'Episode manik dan gangguan afektif bipolar'),
(570, 'R04.0', 'epitaxis'),
(571, 'K06.0', 'epulis'),
(572, 'A46', 'erisipelas'),
(573, 'L53.9', 'eritodemi'),
(574, 'L53.0', 'erythema toxica'),
(575, 'K20', 'esopagitis'),
(576, 'H50.0', 'esotrapia'),
(577, 'B05.2', 'exanthema subitum'),
(578, 'T14.0', 'excoriasis'),
(579, 'M89.9', 'exostosis'),
(580, 'Q75.6', 'exostusis multiple'),
(581, 'G25.9', 'exstra piramidal syndrom'),
(584, 'S02.2', 'faktur hidung/nasi'),
(585, 'J 02 ', 'Faringitis akut'),
(586, 'O 85', 'febris pueperalis'),
(587, 'P 20,1', 'fetal bayi'),
(588, 'O 33,9', 'fetal distress'),
(589, 'D 24', 'fibro adenoma mama (FAM)'),
(590, 'M 79,0', 'fibro myostis'),
(591, 'D 21,9 ', 'fibro sarcoma'),
(592, 'D 36,7', 'fibroma'),
(593, 'D 21,3', 'fibroma axilla'),
(594, 'D 16,2', 'fibroma femur'),
(595, 'D 36,7', 'fibroma jari/pipi'),
(596, 'D 21,0', 'fibroma kepala'),
(597, 'D 26,0', 'fibroma osteo'),
(598, 'M 79,0', 'fibromyalgia'),
(599, 'N 48,6', 'fibrosis corpora cavernosa'),
(600, 'B 74', 'Filariasis'),
(601, 'K 60,3', 'fistal perianal'),
(602, 'N 38,0', 'fistal perineum'),
(603, 'T 81,8', 'fistal post op'),
(604, 'K 63,2', 'fistel enterocutaneous'),
(605, 'Q 35,9', 'fistel palatum'),
(606, 'Q 18,1', 'fistel preauriculer'),
(607, 'K 63,2', 'fistula abdomen'),
(608, 'Q 42,2', 'fistula afresia ani'),
(609, 'J86.0', 'fistula dada '),
(610, 'Q 18,8', 'fistula medula'),
(611, 'Q 43,6', 'fistula rectum/kelainan'),
(612, 'N 36,0', 'fistula uretra'),
(613, 'L 98,4', 'fistula vesico cutanens'),
(614, 'H 61.8', 'Fistula/Kista preaurikel'),
(615, 'R 14', 'flatulence'),
(616, 'I 80 - I 82', 'Flebitis, tromboflebitis, emboli dan trombosis vena'),
(617, 'M 23,4', 'floating kuee'),
(618, 'N89.8', 'flour albus( keputihan)'),
(619, 'J 11,1', 'flu'),
(620, 'O 33,9', 'FPD'),
(621, 'S 32,4', 'fr acetabulus'),
(622, 'S 92,3', 'fr fedis'),
(623, 'S 32,5', 'fr remus inferlor/superlor, pubis'),
(624, 'S 02,4', 'fr zygoma'),
(625, 'S 32,2', 'Fr. Oxygeus'),
(626, 'S02.8', 'fraktur alveolis'),
(627, 'S 82,8', 'fraktur ankie'),
(628, 'S02.1', 'fraktur basis cranil/okipitalis'),
(629, 'S82.8', 'fraktur bimaleolar'),
(630, 'S92.0', 'fraktur calcaneus'),
(631, 'S12.9', 'fraktur cervical'),
(632, 'S42.0', 'fraktur clavicula'),
(633, 'S42.0.0', 'fraktur clavicula close'),
(634, 'S52.5', 'fraktur colles'),
(635, 'T14.2', 'fraktur comperesion'),
(636, 'S32.2', 'fraktur cosial/coxle'),
(637, 'S32.2.1', 'fraktur costal/coxle open'),
(638, 'S82.3', 'fraktur cruris distal'),
(639, 'S 52,0', 'fraktur elbow'),
(640, 'S72.9', 'fraktur femur '),
(641, 'S82.4', 'fraktur fibula'),
(642, 'S02.0', 'fraktur frontalis/pariental'),
(643, 'S42.3', 'fraktur humarius'),
(644, 'S42.3.1', 'fraktur humarius open'),
(645, 'S 12, S 22, S 32, T 08', 'Fraktur leher, toraks atau panggul '),
(646, 'S32.0', 'fraktur lumbar/l2'),
(647, 'S82.8', 'fraktur maleolus'),
(648, 'M84.0', 'fraktur maluncin'),
(649, 'S02.6', 'fraktur mandibula'),
(650, 'S 62,3', 'fraktur matacarpai'),
(651, 'S02.4', 'fraktur maxilla'),
(652, 'T 02', 'Fraktur meliputi daerah badan multipel'),
(653, 'S92.5', 'fraktur metatarual'),
(654, 'S52.0', 'fraktur montigia'),
(655, 'T02.9', 'fraktur multiple'),
(656, 'S52.0', 'fraktur okanon'),
(657, 'S32.5', 'fraktur os pubis'),
(658, 'S 72', 'Fraktur paha'),
(659, 'S82.0', 'fraktur patella /genu'),
(660, 'S32.8', 'fraktur pelvis'),
(661, 'S92.5', 'fraktur phalink'),
(662, 'S52.0', 'fraktur radius antebrichis '),
(663, 'S22.3', 'fraktur rib lga'),
(664, 'S42.1', 'fraktur scapula '),
(665, 'S52.5', 'fraktur sinithis'),
(666, 'S91.1', 'fraktur talus'),
(667, 'S02.1', 'fraktur temporal'),
(668, 'S 02', 'Fraktur tengkorak dan tulang muka'),
(669, 'S82.2', 'fraktur tibia'),
(670, 'S72.1', 'fraktur trocanta '),
(671, 'S 42, S 52, S 62, S 82  S', 'Fraktur tulang anggota gerak lainnya'),
(672, 'S52.2', 'fraktur ulna'),
(673, 'Y 08', 'fraktur vetebrata'),
(674, 'S92.1', 'fraktur weber'),
(675, 'S62.8', 'fraktur wist'),
(676, 'R 50,9', 'fuo'),
(677, 'H 60,0', 'furunkel telinga'),
(680, 'N 17.8', 'Gagal ginjal akut akibat asam jengkol'),
(681, 'N 17.0-.2,.9-N19', 'Gagal ginjal lainnya'),
(682, 'I50.0', 'gagal jantung'),
(683, 'I 50', 'Gagal jantung'),
(684, 'J96.9', 'gagal napas'),
(685, 'R 09.2', 'Gagal napas'),
(686, 'N64.8', 'galactocele'),
(687, 'F 40, F 41', 'Gangguan anxietas fobik, gangguan anxietas lainnya'),
(688, 'H 43 - H 45', 'Gangguan badan kaca dan bola mata'),
(689, 'R48.0', 'gangguan belajar '),
(690, 'N 83', 'Gangguan bukan radang pada indung telur, saluran telur dan ligamentum latum'),
(691, 'N 95', 'Gangguan dalam masa menopause dan perime nopause lainnya '),
(692, 'H 90 - H 91', 'Gangguan daya dengar'),
(693, 'H 53', 'Gangguan daya lihat'),
(694, 'M 50 - M 51', 'Gangguan diskus servikal dan intervertebral lainnya'),
(695, 'F 44', 'Gangguan disosiatif [konversi]'),
(696, 'E15-35, E 58, E 63, E 65,', 'Gangguan endokrin, nutrisi dan metabolik lainnya'),
(697, 'X 50', 'Gangguan gerakan  berulang-ulang dengan kekuatan berlebih'),
(698, 'N 91.3 - .5, N 92.2 - .6', 'Gangguan haid Lainnya'),
(699, 'I 44 - I 49', 'Gangguan hantaran dan aritmia jantung'),
(700, 'F 05 - F 06, F 90 - F 98', 'Gangguan hiperkinetik, perilaku, emosional atau fungsi sosial khas, gangguan \"tic\", dan gangguan mental dan emosional lainnya'),
(701, 'M 30 - M 31,  M 33 - M 36', 'Gangguan jaringan ikat sistemik lainnya'),
(702, 'M 70', 'Gangguan jaringan lunak akibat yang berhubungan  dengan penggunaan tekanan berlebihan'),
(703, 'M 71 - M 79', 'Gangguan jaringan lunak lainnya'),
(704, 'F 99', 'Gangguan jiwa YTT'),
(705, 'E 07', 'Gangguan kelenjar tiroid lainnya'),
(706, 'F 60 - F 69', 'Gangguan kepribadian, gangguan kebiasaan dan impuls, gangguan identitas, gangguan prevensi seksual'),
(707, 'Y 96', 'Gangguan kesehatan yang berhubungan dengan  '),
(708, 'H 30 - H 32', 'Gangguan koroid dan korioretina'),
(709, 'H 51', 'Gangguan lain gerakan mata binokular'),
(710, 'H 02 - H 03', 'Gangguan lain kelopak mata'),
(711, 'H 35 - H 36', 'Gangguan lain retina '),
(712, 'F 10', 'Gangguan mental dan perilaku akibat penggunaan Alkohol'),
(713, 'F 16', 'Gangguan mental dan perilaku akibat penggunaan Halosinogenika'),
(714, 'F 12', 'Gangguan mental dan perilaku akibat penggunaan Kanabinoida'),
(715, 'F 14', 'Gangguan mental dan perilaku akibat penggunaan Kokain'),
(716, 'F 11', 'Gangguan mental dan perilaku akibat penggunaan Opioida'),
(717, 'F 13', 'Gangguan mental dan perilaku akibat penggunaan Sedativa atau Hipnotika'),
(718, 'F 15', 'Gangguan mental dan perilaku akibat penggunaan Stimulansia'),
(719, 'F 17', 'Gangguan mental dan perilaku akibat penggunaan Tembakau'),
(720, 'F 18, F 19', 'Gangguan mental dan perilaku akibat zat pelarut yang mudah menguap atau zat multipel dan zat psikoaktif lainnya'),
(721, 'F 42', 'Gangguan obsesif - kompulsif'),
(722, 'N 60 - N 64', 'Gangguan pada payudara'),
(723, 'K 00 – K 01', 'Gangguan perkembangan dan erupsi gigi termasuk impaksi'),
(724, 'F 80 - F 89', 'Gangguan perkembangan psikologis'),
(725, 'J 68', 'Gangguan pernapasan akibat menghirup zat kimia, gas, asap dan uap'),
(726, 'N 41 - N 42', 'Gangguan prostat lainnya'),
(727, 'F 28 - F 29', 'Gangguan psikotik nonorganik lainnya atau YTT'),
(728, 'H 52', 'Gangguan refraksi dan akomodasi'),
(729, 'P 22 - P 28', 'Gangguan saluran napas lainnya yang ber-hubungan dengan masa perinatal'),
(730, 'H 46 - H 48', 'Gangguan saraf optik dan saraf penglihatan'),
(731, 'G 50 - G 55, G 56.1, .4, ', 'Gangguan saraf, radiks dan pleksus saraf'),
(732, 'G 45', 'Gangguan serangan peredaran otak sepintas dan sindrom yang terkait'),
(733, 'N 82, N 84 - N 90, N 93- ', 'Gangguan sistem kemih kelamin lainnya'),
(734, 'H 04 - H 06', 'Gangguan sistem lakrimal dan orbita'),
(735, 'F 25', 'Gangguan skizoafektif'),
(736, 'F 43.1', 'Gangguan stress pasca trauma'),
(737, 'M 80 - M 85', 'Gangguan struktur dan densitas tulang'),
(738, 'E 00 - E 02', 'Gangguan tiroid berhubungan dengan defisiensi  iodium'),
(739, 'F 22, F 24', 'Gangguan waham menetap dan induksi'),
(740, 'M07.4', 'ganglion'),
(741, 'K04.1', 'gangren pulpa( GP)'),
(742, 'R02', 'gangren radix (GR)'),
(743, 'R02', 'gangrene'),
(744, 'K31.9', 'gaster porforasi'),
(745, 'K25.9', 'gastri ulcer'),
(746, 'K29.7', 'gastritis'),
(747, 'K29.1', 'gastritis acut'),
(748, 'K29.2', 'gastritis alcoholik'),
(749, 'K29.6', 'gastritis alergi'),
(750, 'K29.4', 'gastritis chronik'),
(751, 'K 29', 'Gastritis dan duodenitis'),
(752, 'K29.9', 'gastro duodenitis'),
(753, 'Q79.3', 'gastro schizis'),
(754, 'O68.9', 'gawat janin'),
(755, 'G61.0', 'GBS'),
(756, 'A09', 'GE'),
(757, 'R 00 - R 01', 'Gejala pada jantung'),
(758, 'T 90 - T 98', 'Gejala sisa cedera, keracunan dan akibat lanjut sebab luar'),
(759, 'E 64', 'Gejala sisa malnutrisi dan defisiensi gizi lainnya'),
(760, 'R 02 - R 09.0, .1, .3, .8', 'Gejala, tanda dan penemuan klinik dan laboratorium tidak normal lainnya, YTK di tempat lain'),
(761, 'O30.0', 'gemeli'),
(762, 'N17.9', 'GGA'),
(763, 'N18.9', 'GGK/GNC'),
(764, 'K05.1', 'ginggivitis'),
(765, 'R10.1', 'gipastrik pain'),
(766, 'K06.8', 'glant cell femur'),
(767, 'Q15.0', 'glaucoma congenital'),
(768, 'H40.1', 'glaucoma kronik'),
(769, 'H40.5', 'glaucoma sekunder'),
(770, 'H 40 - H 42', 'Glaukoma'),
(771, 'H40.2', 'glaukoma acut'),
(772, 'N03.9', 'glomerulo nepritis kronis'),
(773, 'N00.9', 'GNA( gromeruloneprritis acut)'),
(774, 'N00', 'GNAPS ( glomerulonepritis acut post streptococos)'),
(775, 'B 26', 'Gondong'),
(776, 'M00.0', 'gonitis'),
(777, 'A54.9', 'gonorrhea'),
(778, 'M10.9', 'gout ( urat)'),
(779, 'M10.0', 'gout artritis'),
(780, 'Z35.4', 'grande multipara'),
(781, 'L92.9', 'granuloma'),
(782, 'J32.9', 'granuloma hidung'),
(783, 'H01.8', 'granuloma mata'),
(784, 'H71', 'granuloma telinga'),
(785, 'L92.3', 'granuloma umbilicus'),
(786, 'E05', 'grave\"s desease'),
(787, 'K06.0', 'gusi berdarah'),
(788, 'N62', 'gynecomastia'),
(789, 'Z01.4', 'gyneko ekologi'),
(792, 'M20.1', 'hallux valgus'),
(793, 'Q66.3', 'hallux valgus congenital'),
(794, 'O16', 'hamil + hipertensi'),
(795, 'O00.9', 'hamil ectopic'),
(796, 'O47.0', 'hamil kurang dari 37 mg'),
(797, 'O26.9', 'hamil muda'),
(798, 'O80.9', 'hamil normal'),
(799, 'O99.0', 'hamil+ anemia'),
(800, 'R 75', 'Hasil laboratorium positif HIV'),
(801, 'R51', 'headache'),
(802, 'T67.0', 'heat struke'),
(803, 'B 68 - 71, B 75, B 77 - B', 'Helmintiasis lain'),
(804, 'K43.9', 'hema insisionalis'),
(805, 'D18.0', 'hemangioma'),
(806, 'C49.3', 'hemangioma sarcoma'),
(807, 'R04.2', 'hemaptoe'),
(808, 'K92.0', 'hematemasis'),
(809, 'O21.1', 'hematematis graviderum'),
(810, 'P54.8', 'hemato bayi'),
(811, 'S27.1', 'hemato pnemo thorax'),
(812, 'S27.1', 'hemato traumatik'),
(813, 'B65.0', 'hematocyluria'),
(814, 'T14.0', 'hematoma '),
(815, 'S09.9', 'hematoma dahi kiri'),
(816, 'N90.8', 'hematoma labia'),
(817, 'S06.5', 'hematoma subdural'),
(818, 'N50.1', 'hematoma testis'),
(819, 'N89.8', 'hematoma vagina'),
(820, 'O71.7', 'hematoma vulva'),
(821, 'R16.0', 'hematomegali'),
(822, 'N35.7', 'hematometra'),
(823, 'R31', 'hematuria'),
(824, 'G81.9', 'hemiparesis'),
(825, 'D18.0/M9131/0', 'hemongioma capilary'),
(826, 'D66', 'hemopili'),
(827, 'H44.3', 'hemorage intra ocular'),
(828, 'P21.8', 'hemorage intra of newbron'),
(829, 'R58', 'HEMORHAGE  '),
(830, 'H11.3', 'hemorhage conjupctiva'),
(831, 'I84.9', 'hemoroid'),
(832, 'I84.5', 'hemoroid external'),
(833, 'I34.2', 'hemoroid interna'),
(834, 'I 84', 'Hemoroid/Wasir'),
(835, 'N94.8', 'henmatocal'),
(836, 'D69.0', 'henoch schonlein purpura (HSP)'),
(837, 'K72.9', 'hepatik fallure'),
(838, 'K75.9', 'hepatitis'),
(839, 'B15.9', 'hepatitis A'),
(840, 'B 15', 'Hepatitis A akut'),
(841, 'K72.0', 'hepatitis acut'),
(842, 'B16.9', 'hepatitis B akut'),
(843, 'B 16', 'Hepatitis B akut'),
(844, 'B 17.1', 'Hepatitis C akut'),
(845, 'B17.1', 'hepatitis C cronis'),
(846, 'B 17.2', 'Hepatitis E akut'),
(847, 'B19.9', 'hepatitis fulminaat'),
(848, 'K73.9', 'hepatitis kronik'),
(849, 'K 73', 'Hepatitis kronik'),
(850, 'P59.2', 'hepatitis neunatal'),
(851, 'B19.9', 'hepatitis virus akut'),
(852, 'B16.9', 'hepatitis virus B'),
(853, 'B 17.0.8,  B18 - B19', 'Hepatitis virus lainnya'),
(854, 'K76.7', 'hepato renal syndrom'),
(855, 'C22.0', 'hepatoma'),
(856, 'R16.2', 'hepatos plenomegali'),
(857, 'E79.0', 'heperurisemia'),
(858, 'I95.9', 'hepotensi'),
(859, 'Q66.0', 'hermoprodite'),
(860, 'K46.9', 'hernia'),
(861, 'K44.9', 'hernia eoigastric/ventral'),
(862, 'K43.9', 'hernia femoral'),
(863, 'K 40', 'Hernia inguinal'),
(864, 'K41.9', 'hernia insisional'),
(865, 'K 41 - K 46', 'Hernia lainnya'),
(866, 'K45.8', 'hernia medialis'),
(867, 'K42.9', 'hernia umbicollis'),
(868, 'B00.1', 'herpes facialis'),
(869, 'B00.9', 'herpes simpleks'),
(870, 'B02,9', 'herpes zooster'),
(871, 'K43.9', 'HHD'),
(872, 'R06.6', 'hiccup'),
(873, 'O 40', 'Hidramnion'),
(874, 'N43.3', 'hidrocelle'),
(875, 'N50.9', 'hidrocelle testis dextra'),
(876, 'G91.9', 'hidrocepalus'),
(877, 'Q03.0', 'hidrocepalus bayi'),
(878, 'N 43', 'Hidrokel dan spermatokel'),
(879, 'P01.3', 'hidrom neos bayi'),
(880, 'O40', 'hidromnios'),
(881, 'N13.3', 'hidroneorosis'),
(882, 'K60.9', 'hidrops'),
(883, 'Q 03', 'Hidrosefalus kongenital'),
(884, 'G93.4', 'HIE ( hipoxic ischemic ensialopaty)'),
(885, 'T66', 'hifopermia'),
(886, 'D18.1', 'higroma ( colli d Cystioa)'),
(887, 'K40.9', 'HIL /scrotalis/inguinalis'),
(888, 'P70.4', 'hipaglikemia bayi'),
(889, 'E88.0', 'hipalbumenimia'),
(890, 'H21.0', 'hipema'),
(891, 'S05.1', 'hipema traumatic'),
(892, 'P59.9', 'hiper billirubimania'),
(893, 'E78.0', 'hiper cholestrol'),
(894, 'I51.3', 'hiperactive exercise'),
(895, 'E78.0', 'hipercolestrolemia'),
(896, 'K04.0', 'hiperemia pulpa HP'),
(897, 'R73.9', 'hipergilikemia'),
(898, 'R50.9', 'hiperpirakia'),
(899, 'N 40', 'Hiperplasia prostat'),
(900, 'I67.4', 'hipertensi ensepalopaty'),
(901, 'I 10', 'Hipertensi esensial (primer)'),
(902, 'O 14', 'Hipertensi gestasional (akibat kehamilan)dengan proteinuria yang nyata/preeklamsia'),
(903, 'K 76.6', 'Hipertensi portal'),
(904, 'E05.9', 'hipertiroid'),
(905, 'L91.0', 'hipertrapi scar'),
(906, 'N40', 'hipertropi  prostat'),
(907, 'K31.1', 'hipertropi pilory stenosis'),
(908, 'E16.2', 'hipoglikemia'),
(909, 'P 20 - P 21', 'Hipoksia intrauterus dan asfiksia lahir'),
(910, 'Q54.9', 'hipospadia   '),
(911, 'Q54.4', 'hipospadia penoscrotal'),
(912, 'E03.9', 'hipotiroid'),
(913, 'E 03', 'Hipotiroidisme lain'),
(914, 'T79.4', 'hipovolamik syok'),
(915, 'P21.9', 'hipoxia bayi'),
(916, 'Q43.1', 'hischpruag'),
(917, 'F44.9', 'histeria'),
(918, 'B24', 'HIV'),
(919, 'I42.1', 'HOCM hipertensi oostruktif cardiomyopati'),
(920, 'C81.0', 'hodkin disease'),
(921, 'B08.4', 'hona,foot dan mouth disease ( HFMD)'),
(922, 'E14.0', 'HONK'),
(923, 'H00.0', 'hordeolum'),
(924, 'O72.1', 'HPP'),
(925, 'N92.0', 'hyper menorea'),
(926, 'E05.9', 'hyperthiroid'),
(929, 'S06.2', 'ICH multiple'),
(930, 'R17', 'icterus '),
(931, 'P59.9', 'icterus neonatorum'),
(932, 'I25.9', 'IHD'),
(933, 'K56.7', 'ileus'),
(934, 'K56.0', 'ileus paralitik'),
(935, 'K 56', 'Ileus paralitik dan obstruksi usus tanpa Hernia'),
(936, 'K56.6', 'ilius obstruktif'),
(937, 'I21.9', 'imark miokard'),
(938, 'Q52.3', 'Imperforata hymen (blum pernah hamil)'),
(939, 'L00', 'impetigo bulose'),
(940, 'F52.2', 'impotensi dini'),
(941, 'X25.0', 'impressi fr.os frontal'),
(942, 'Z 23. 2', 'Imunisasi BCG'),
(943, 'Z 24. 4', 'Imunisasi campak'),
(944, 'Z 23.0, .1, .3 - .4, .6 -', 'Imunisasi dan kemoterapi pencegahan lainnya'),
(945, 'Z 27. 1', 'Imunisasi gabungan DPT (Difteri, Pertusis, Tetanus)'),
(946, 'Z 24. 6', 'Imunisasi hepatitis virus'),
(947, 'Z 24. 0', 'Imunisasi poliomielitis'),
(948, 'Z 24. 2', 'Imunisasi rabies'),
(949, 'Z 23. 5', 'Imunisasi tetanus'),
(950, 'G 80', 'Infantil cerebral palsy'),
(951, 'I 21 - I 22', 'Infark miokard akut'),
(952, 'I 63', 'Infark serebral'),
(953, 'J40', 'infeksi bronohitis'),
(954, 'K04.7', 'infeksi gigi'),
(955, 'K01.1', 'infeksi gigi'),
(956, 'S54.9', 'infeksi gonocolle'),
(957, 'A 54', 'Infeksi gonokok   '),
(958, 'B 00', 'Infeksi herpesvirus (Herpes simpleks)'),
(959, 'P 38 - P 39', 'Infeksi khusus lainnya pada masa perinatal'),
(960, 'A 70', 'Infeksi Klamedia'),
(961, 'L 00 - L 08', 'Infeksi kulit dan jaringan subkutan'),
(962, 'A 57 - A 64', 'Infeksi lainnya yang terutama ditularkan melalui hubungan seksual'),
(963, 'T81.4', 'infeksi luka oprasi (ILO)'),
(964, 'A 39', 'Infeksi meningokok'),
(965, 'A39.9', 'infeksi meninokok'),
(966, 'P39.9', 'infeksi neunatal'),
(967, 'P39.9', 'infeksi neunatrium'),
(968, 'O86.4', 'infeksi puerferalis'),
(969, 'N11.9', 'infeksi renal chronis'),
(970, 'J 00 - J 01 J 05 - J 06', 'Infeksi saluran napas bagian atas akut lainnya'),
(971, 'B 66', 'Infeksi trematoda lainnya'),
(972, 'R38', 'infeksi umbilicus'),
(973, 'N97.9', 'infertality'),
(974, 'N 97', 'Infertilitas perempuan'),
(975, 'K11.9', 'infiltrat parotis'),
(976, 'J 10 - J 11', 'Influensa'),
(977, 'T14.9', 'injury'),
(978, 'R19.8/Z33', 'inpartu'),
(979, 'T14.0', 'insect bite'),
(980, 'T63.4', 'insect bite'),
(981, 'G47.0', 'insomnia'),
(982, 'N18.9', 'insufisiensi renal GGK'),
(983, 'G93.9', 'inta cerebral bleding'),
(984, 'A05.9', 'intake makanan'),
(985, 'J84.9', 'interstitial lung oedema'),
(986, 'K08.9', 'interusi gigi'),
(987, 'T39.1', 'intocikasi bodrex'),
(988, 'K90.4', 'intolorance food'),
(989, 'T60.9/X48.0', 'intosikasi racun serangga'),
(990, 'T14.7/X44.0', 'intosikasi susu'),
(991, 'T88.7', 'intosikesi'),
(992, 'F15.0', 'intoxcisasi CTM'),
(993, 'T62.0/X49.0', 'intoxcisasi jamur'),
(994, 'T60.9/X68.9', 'intoxicasi bayigon'),
(995, 'T52.0/X66.0', 'intoxicasi bensin'),
(996, 'T55/X69.0', 'intoxicasi deterjen'),
(997, 'T52.0/X46.0', 'intoxicasi kerosin'),
(998, 'F10.0', 'intoxicasi obat'),
(999, 'T60.4', 'intoxicasi racun tikus'),
(1000, 'D75.9', 'intra cranial bleeding'),
(1001, 'I62.2', 'intra cranial bleeding non traumatik'),
(1002, 'S06.3', 'intra cranial bleeding traumatik'),
(1003, 'K56.1', 'invaginasi'),
(1004, 'N85.5', 'inversio uteri '),
(1005, 'O71.2', 'inversio uteri post fartum'),
(1006, 'C76.0', 'inverte papiloma cav.nasi'),
(1007, 'L01.0', 'invertigo'),
(1008, 'H 20 - H 22', 'Iridosiklitis dan gangguan lain iris dan badan silier'),
(1009, 'K04.9', 'iritasi pulpa'),
(1010, 'I99', 'ischemik'),
(1011, 'M54.3', 'ischialgia'),
(1012, 'N39.0', 'ISK'),
(1013, 'J06.9', 'ISPA'),
(1014, 'D69.3', 'ITP'),
(1015, 'Z30.5', 'IUD'),
(1016, 'O36.4', 'IUFD ( KJDR)'),
(1017, 'P95', 'IUFD ( KJDR)bayi'),
(1018, 'KODE', 'J'),
(1019, 'V03.4', 'jalan kaki ditabrak mobil'),
(1020, 'V01.9', 'jalan kaki ditabrak motor'),
(1021, 'P 00 - P 04', 'Janin dan bayi baru lahir yang dipengaruhi oleh faktor dan penyulit kehamilan persalinan dan kelahiran'),
(1022, 'I25.9', 'jantung kroner'),
(1023, 'I09.0', 'jantung rematik'),
(1024, 'W19.0', 'jatuh'),
(1025, 'W 00 - W 19', 'Jatuh'),
(1026, 'V38.1', 'jatuh dari cidomo'),
(1027, 'W18.0', 'jatuh dari kamar mandi '),
(1028, 'W07.0', 'jatuh dari korsi '),
(1029, 'V48.6', 'jatuh dari mobil di jalan raya'),
(1030, 'V28.9', 'jatuh dari motor'),
(1031, 'W14.0', 'jatuh dari pohon'),
(1032, 'W13.0', 'jatuh dari rumah /bangunan'),
(1033, 'V18.9', 'jatuh dari sepeda'),
(1034, 'W11.0', 'jatuh dari tangga '),
(1035, 'W06.0', 'jatuh dari tempat tidur'),
(1036, 'V58.0', 'jatuh dari truck'),
(1037, 'W01.0', 'jatuh dibawah'),
(1038, 'W51.2', 'jatuh disekolah sox ditabrak teman'),
(1039, 'W17.0', 'jatuh kesumur'),
(1040, 'V48.6', 'jatuh terguling dari mobil'),
(1041, 'E14,0', 'KAD (koma asidosis diabetic)'),
(1042, 'V38,1', 'kaki masuk jeruji motor'),
(1043, 'O63,0', 'kala I'),
(1044, 'O63,1', 'Kala II'),
(1045, 'I 42 - I 43', 'Kardiomiopati'),
(1046, 'K 02', 'Karies gigi'),
(1047, 'K02,9', 'karies propunda'),
(1048, 'D 04', 'Karsinoma in situ kulit'),
(1049, 'D 00 - D 03 D 07 - D 09', 'Karsinoma in situ lainnya'),
(1050, 'D 05', 'Karsinoma in situ payudara'),
(1051, 'D 06', 'Karsinoma in situ serviks uterus'),
(1052, 'H 25 - H 28', 'Katarak dan gangguan lain lensa'),
(1053, 'Z30,9', 'KB suntik'),
(1054, 'E41', 'KCCL'),
(1055, 'Z 21', 'Keadaan infeksi HIV asimtomatik'),
(1056, 'X09,0', 'kebekeran rumah'),
(1057, 'V 90 - V 94', 'Kecelakaan angkutan air'),
(1058, 'V 01 - V 89', 'Kecelakaan angkutan darat'),
(1059, 'V 98 -V 99', 'Kecelakaan angkutan lain'),
(1060, 'V 95 - V 97', 'Kecelakaan angkutan udara dan ruang angkasa'),
(1061, 'X 40 - X 44', 'Kecelakaan keracunan dan terdedah oleh bahan beracun lainnya'),
(1062, 'W 65 - W 74', 'Kecelakaan tenggelam dan terbenam'),
(1063, 'K83,0', 'kedangnitis'),
(1064, 'O00,0', 'kehamilan abdominal'),
(1065, 'O 00', 'Kehamilan ektopik'),
(1066, 'O 02, O 06 - O 08', 'Kehamilan lain yang berakhir dengan abortus'),
(1067, 'O48', 'kehamilan lewat waktu'),
(1068, 'O 48', 'Kehamilan lewat waktu'),
(1069, 'O 30', 'Kehamilan multipel'),
(1070, 'R56,8', 'kejang '),
(1071, 'R56,0', 'kejang demam'),
(1072, 'R 56', 'Kejang YTT'),
(1073, 'W20', 'kejatuhan benda'),
(1074, 'K 07 – K 08', 'Kelainan dentofasial termasuk maloklusi'),
(1075, 'Q 91 - Q 99', 'Kelainan kromosom YTK ditempat lain'),
(1076, 'M 22 - M 25', 'Kelainan sendi lainnya'),
(1077, 'L91,0', 'keloid'),
(1078, 'W44,0', 'kemasukan biji di telingga'),
(1079, 'O84', 'Kembar siam'),
(1080, 'R14', 'kembung'),
(1081, 'X11,0', 'kena air panas'),
(1082, 'E25,0', 'kena gelas/kaca'),
(1083, 'W 27', 'kena jarum'),
(1084, 'W27', 'kena kapak'),
(1085, 'W22,0', 'kena kawat/besi'),
(1086, 'W21', 'kena kayu'),
(1087, 'W20,0', 'kena lempar buku'),
(1088, 'W31', 'kena mesin giling'),
(1089, 'X10', 'kena minyak panas'),
(1090, 'W22,0', 'kena paku'),
(1091, 'W20,8', 'kena pancing'),
(1092, 'W29,0', 'kena peluru nyasar'),
(1093, 'W26,0', 'kena pisau/pedang'),
(1094, 'X58', 'kena ranting pohon'),
(1095, 'W 34,0', 'kena tembak'),
(1096, 'E46', 'KEP'),
(1097, 'X 45', 'Keracunan akibat pemaparan alkohol'),
(1098, 'X 49', 'Keracunan akibat pemaparan bahan beracun berbahaya lainnya'),
(1099, 'X 47', 'Keracunan akibat pemaparan gas-gas & uap-uap lainnya'),
(1100, 'X 46', 'Keracunan akibat pemaparan pelarut organik & hidrokarbon serta uapnya'),
(1101, 'X 48', 'Keracunan akibat pemaparan pestisida'),
(1102, 'T 59', 'Keracunan gas, asap dan uap lain'),
(1103, 'T 56', 'Keracunan logam'),
(1104, 'T 36 - T 50', 'Keracunan obat dan preparat biologik'),
(1105, 'T 52', 'Keracunan pelarut organik'),
(1106, 'T 60', 'Keracunan pestisida'),
(1107, 'H16,9', 'Keratitis'),
(1108, 'H 15 - H 19', 'Keratitis dan gangguan lain sklera dan kornea'),
(1109, 'H20,9', 'kerato uvcitis'),
(1110, 'P57,9', 'kern icterus'),
(1111, 'Y 60 - Y 84', 'Kesalahan pada pasien selama perawatan medis non bedah'),
(1112, 'W87,0', 'kestrum'),
(1113, 'O00,1', 'KET'),
(1114, 'O 42', 'Ketuban pecah dini'),
(1115, 'Z 41.2', 'Khitanan menurut agama dan adat kebiasaan'),
(1116, 'T88,1', 'KIPI (komplikasi ikutan pasca imuisasi)'),
(1117, 'Q89,8', 'kista cengenital'),
(1118, 'N 75.0.1', 'Kista dan abses kelenjar Bartholin'),
(1119, 'K66,8', 'kista mesenterial'),
(1120, 'H05,8', 'kista orbit'),
(1121, 'N83,2', 'kista ovarli (beraslin)'),
(1122, 'Q50,5', 'kista parovarium'),
(1123, 'K04,8', 'kista radicular'),
(1124, 'K 09 – K 10', 'Kista rongga mulut dan penyakit pada rahang'),
(1125, 'C44,5', 'kista umbilicoli'),
(1126, 'D27', 'kistoma ovaril'),
(1127, 'V29,9', 'KLL'),
(1128, 'K 80', 'Kolelitiasis'),
(1129, 'A60,9', 'kolera'),
(1130, 'A 00', 'Kolera'),
(1131, 'K 81', 'Kolesistitis'),
(1132, 'K 72', 'Koma hepatikum dan hepatitis fulminan '),
(1133, 'X02,0', 'kompor meledak /kena api kompor'),
(1134, 'G93,5', 'kompressi medulla'),
(1135, 'D 65 – D 69, D 71 - D 73,', 'Kondisi hemoragik dan penyakit darah dan organ pembuat darah lainnya'),
(1136, 'P 08, P 29, P 50 - P 54 P', 'Kondisi lain yang bermula pada masa Perinatal'),
(1137, 'H 10 - H 13', 'Konjungtivitis dan gangguan lain konjungtiva'),
(1138, 'J24,8', 'konka hipertrofi'),
(1139, 'X 10 - X 19', 'Kontak dengan bahan panas'),
(1140, 'X 20 - X 29', 'Kontak dengan binatang & tumbuhan beracun'),
(1141, 'M20,0', 'kontraktur jari'),
(1142, 'A16,9', 'KP'),
(1143, 'A16,2', 'KP lama'),
(1144, 'O42,9', 'KPD'),
(1145, 'E40', 'kwarsiakor'),
(1146, 'Q36.9', 'labio genato suzies'),
(1147, 'Q51.0', 'labio mayora'),
(1148, 'Q35.9', 'labio palato baizies'),
(1149, 'S31.8', 'lacerasi anus'),
(1150, 'S05.2', 'lacerasi eye/cornea tampaprolapsa'),
(1151, 'S31.4', 'lacerasi vulva'),
(1152, 'T14.1', 'laceratum'),
(1153, 'H02.2', 'lagophitalmoes'),
(1154, 'P 95', 'Lahir mati'),
(1155, 'Q31.0', 'laringeal web'),
(1156, 'J04.0', 'laringitis akut'),
(1157, 'J37.0', 'laringitis cronik'),
(1158, 'J 04', 'Laringitis dan trakeitis akut'),
(1159, 'J38.0', 'laringo malacea/plagin'),
(1160, 'J36.0', 'laringo paringitis acut'),
(1161, 'S05.3', 'lecerasi cerebri'),
(1162, 'W36.0', 'ledakan tabung gas'),
(1163, 'S06.2', 'left heard failure LHF'),
(1164, 'D 25', 'Leiomioma uterus'),
(1165, 'A 30', 'Lepra/Kusta'),
(1166, 'G 56.3', 'Lesi saraf radialis'),
(1167, 'G 56.2', 'Lesi saraf ulnaris'),
(1168, 'B 55', 'Lesmaniasis'),
(1169, 'P01.7', 'letak lintang anak'),
(1170, 'O32.2', 'letak lintang ibu'),
(1171, 'P03.1', 'letak lintang kasep anak'),
(1172, 'O64.1', 'letak lintang kasiep ibu'),
(1173, 'O32.3', 'Letak muka'),
(1174, 'O32.1', 'letak sunsang ( ibu)'),
(1175, 'P01.7', 'letak sunsang anak '),
(1176, 'H17.8', 'leucoma cornea '),
(1177, 'C 91 - C 95', 'Leukemia'),
(1178, 'C95.0', 'leukemia acut'),
(1179, 'H18.9', 'leukemia comea'),
(1180, 'AO6.4', 'lever ambic abses'),
(1181, 'A06.1', 'lever amebic abses'),
(1182, 'M35.9', 'leymyosarcoma'),
(1183, 'A 18.2', 'Limfadenitis tuberkulosa '),
(1184, 'C 82 - C 85', 'Limfoma non Hodgkin'),
(1185, 'C85.9', 'limpoma no hodgkins'),
(1186, 'C85.9', 'limpomamalignah'),
(1187, 'I50.1', 'lipoma'),
(1188, 'D17.9', 'lipoma neohal'),
(1189, 'C85.9', 'lipoma retraurculer'),
(1190, 'K76.9', 'liver cronic'),
(1191, 'K76.9', 'liver cronis disease'),
(1192, 'K12.2', 'lodwing angina '),
(1193, 'M23.4', 'loose body patela (knee)'),
(1194, 'T 20 - T 32', 'Luka bakar dan korosi'),
(1195, 'T79.3', 'luka empeksi'),
(1196, 'M54.5', 'lumbago ( LBP) /low back pain'),
(1197, 'M32.9', 'lupa CNS'),
(1198, 'M 32', 'Lupus eritemateus sistemik'),
(1199, 'I51.7', 'LVH cardiomegali'),
(1200, 'I88.9', 'lympadenitis'),
(1201, 'C85.0', 'lympadenopaty'),
(1202, 'R59.1', 'lympadenpaty sup mandibula'),
(1203, 'Q89.2', 'lympadepaty colli'),
(1204, 'D18.1', 'lympengioma'),
(1205, 'D17.9', 'lympo sarcoma'),
(1209, 'Q18.4', 'macrostamia'),
(1210, 'K07.4', 'mal oclussion'),
(1211, 'B 50 - B 54', 'Malaria (Included all malaria)'),
(1212, 'B50.0+', 'malaria cerebral'),
(1213, 'B54', 'malaria cerebral klinis /demam'),
(1214, 'B50.9', 'malaria falciferum/tropical/algida'),
(1215, 'B53.0', 'malaria ovaie'),
(1216, 'B52.9', 'malaria quartana'),
(1217, 'B51.9', 'malaria vivak /tertiana'),
(1218, 'Q 67 - Q 79', 'Malformasi dan deformasi kongenital sistem muskuloskeletal lain'),
(1219, 'Q 54 - Q 56', 'Malformasi kongenital alat kelamin laki'),
(1220, 'Q 50 - Q 52', 'Malformasi kongenital alat kelamin wanita'),
(1221, 'Q 10 - Q 18, Q 30 - Q 34,', 'Malformasi kongenital lainnya'),
(1222, 'Q 38 - Q 40,Q 42 - Q 45', 'Malformasi kongenital sistem cerna lainnya'),
(1223, 'Q 60 - Q 64', 'Malformasi kongenital sistem kemih lainnya'),
(1224, 'Q 20 - Q 28', 'Malformasi kongenital sistem peredaran darah'),
(1225, 'Q 00 - Q 02 Q 04, Q 06, Q', 'Malformasi kongenital susunan saraf lain'),
(1226, 'C76.5', 'malignancy lutut'),
(1227, 'E46', 'malnutrisi'),
(1228, 'E 40 - E 46', 'Malnutrisi'),
(1229, 'Q43.3', 'malrotasi'),
(1230, 'M84.0', 'malunion'),
(1231, 'Q83.8', 'mama alberant'),
(1232, 'E41', 'marasmus'),
(1233, 'E42', 'marasmus kwarsi'),
(1234, 'N60.9', 'marnae diplasia'),
(1235, 'K63.8', 'massa colon'),
(1236, 'N61', 'mastititis abses'),
(1237, 'H70.9', 'mastoiditis'),
(1238, 'N64.9', 'mastopati'),
(1239, 'W57', 'masuk lintah'),
(1240, 'C71.6', 'medulo blastoma'),
(1241, 'K59.3', 'mega colon'),
(1242, 'Q43.1', 'mega colon congenital'),
(1243, 'Q43.1', 'megacolon congenital'),
(1244, 'Q82.0', 'meiges syndrom'),
(1245, 'C 43', 'Melanoma ganas kulit'),
(1246, 'P54.1', 'melena bayi'),
(1247, 'K92.1', 'melena dewasa'),
(1248, 'C43.9', 'melenoma malignen'),
(1249, 'K22.6', 'mellery weis syndrom'),
(1250, 'W22', 'menabrak dinding'),
(1251, 'V47', 'menabrak pohon'),
(1252, 'W44.0', 'menelan uang logam'),
(1253, 'G03.9', 'menengitis'),
(1254, 'A17.0 ', 'meningitis TBC'),
(1255, 'A 17.0', 'Meningitis tuberkulosa'),
(1256, 'G04.9', 'meningo ensafalitis'),
(1257, 'Q01.9', 'meningo ensefalocelle'),
(1258, 'A17.8+ G05.0*', 'meningo gasepalitis TB'),
(1259, 'Q05.9', 'meningocelle'),
(1260, 'N92.1', 'menometroragia'),
(1261, 'N95.1', 'menopause'),
(1262, 'N92.0', 'menoraghia'),
(1263, 'N 92.0, .1', 'Menoragi atau metroragi'),
(1264, 'N92.6', 'menstruasi'),
(1265, 'F79', 'mental retardation'),
(1266, 'Z39.0', 'menunggu bayi'),
(1267, 'C 45', 'Mesotelioma'),
(1268, 'D 74', 'Metahaemoglobinema'),
(1269, 'C81', 'metastase glutea CA'),
(1270, 'C71.9', 'metastase intra cranial'),
(1271, 'R14', 'meteorismus ( perut kembung) '),
(1272, 'Q55.8', 'micro urethra conginital'),
(1273, 'Q02', 'microcepally'),
(1274, 'G43.9', 'migren'),
(1275, 'G 43 - G 44', 'Migren dan sindrom nyeri kepala lainnya'),
(1276, 'B 35 - B 49', 'Mikosis'),
(1277, 'G00.9', 'miningitis prulent /bacterial'),
(1278, 'M 60 – M 64, \'M 66 – M 68', 'Miopati dan reumatisme'),
(1279, 'O02.1', 'mised abortion/dead concytens'),
(1280, 'K00.0', 'missing teeth'),
(1281, 'I05.9', 'mitra valve prolapa'),
(1282, 'I34.0', 'mitral insufiensi'),
(1283, 'I05.0', 'mitral stenosis'),
(1284, 'J18.9', 'mnemonia berat'),
(1285, 'O 01', 'Mola hidatidosa'),
(1286, 'O01.9', 'mola hidatodosa'),
(1287, 'B08.1', 'moluscum contagiosum'),
(1288, 'H03.1', 'moluscum contagiosum mata'),
(1289, 'B37.9', 'monoliasis'),
(1290, 'P37.5', 'monoliasis bayi'),
(1291, 'G 56.8', 'Mononeuropati anggota tubuh bagian atas lainnya'),
(1292, 'G83.1', 'monoparase extrimitas'),
(1293, 'B05.9', 'morbili'),
(1294, 'A30.9', 'morbus harsan fieaksi'),
(1295, 'T75.3', 'motion sicknese'),
(1296, 'I34.0', 'MR ( mitral regorgitasi)'),
(1297, 'G57.7', 'mulitple cranial palsy'),
(1298, 'Z64.1', 'multipara'),
(1299, 'G93.9', 'multiple cerebri'),
(1300, 'Q89.9', 'multiple conginital anomaly'),
(1301, 'T06.4', 'multiple contusio muscolorum'),
(1302, 'Q78.6', 'multiple exostosis'),
(1303, 'D21.2', 'multiple fibroma colorsum'),
(1304, 'H00.0', 'multiple hordeulum'),
(1305, 'C97', 'multiple polip senile'),
(1306, 'M79.1', 'myalgia'),
(1307, 'G70.0', 'myastenia gravis'),
(1308, 'P94.0', 'myastenia gravis bayi'),
(1309, 'B49', 'mycosis mycotic'),
(1310, 'N12', 'myelenopritis'),
(1311, 'G04.9', 'myelitis'),
(1312, 'D47.1', 'myelofibrosis'),
(1313, 'I40.0', 'myocardial infection MCI'),
(1314, 'I51.4', 'myocarditis'),
(1315, 'D25.9', 'myoma uteri'),
(1316, 'H52.1', 'myopia'),
(1317, 'C42.9', 'myosercoma betis kiri'),
(1318, 'M60.9', 'myositis'),
(1319, 'KODE', 'N'),
(1320, 'Q82.5', 'naevus pigmentasi'),
(1321, 'T87.5', 'necrasis palax /brachl'),
(1322, 'R02', 'necrosis'),
(1323, 'N 12', 'Nefritis tubulo - interstitial, tidak ditentukan akut atau kronik/pielonefritis'),
(1324, 'N 14.3', 'Nefropati disebabkan oleh logam–logam berat'),
(1325, 'N 02.8', 'Nefropati Imunoglobulin A (Ig A)'),
(1326, 'C 30, C 31, C 37 - C 38.0', 'Neoplasma ganas  sistem napas dan alat  rongga dada lainnya'),
(1327, 'C 51 - C 52, C 57', 'Neoplasma ganas alat kelamin  perempuan lainnya'),
(1328, 'C 63', 'Neoplasma ganas alat kelamin pria lainnya'),
(1329, 'C 66, C 68', 'Neoplasma ganas alat kemih lainnya'),
(1330, 'C 70, C 72', 'Neoplasma ganas bagian susunan saraf pusat'),
(1331, 'C 55', 'Neoplasma ganas bagian uterus lainnya dan YTT'),
(1332, 'C 00 - C 10', 'Neoplasma ganas bibir, rongga mulut,  kelenjar liur, faring, tonsil'),
(1333, 'C 12 - C 14', 'Neoplasma ganas bibir, rongga mulut, faring, lainnya & YTT'),
(1334, 'C 34', 'Neoplasma ganas bronkus dan paru');
INSERT INTO `tbl_diagnosa_icd10` (`id_diagnosa`, `code`, `diagnosa`) VALUES
(1335, 'C 19 - C 21', 'Neoplasma ganas daerah  rektosigmoid, rektum dan anus'),
(1336, 'C 15', 'Neoplasma ganas esofagus'),
(1337, 'C 64 - C 65', 'Neoplasma ganas ginjal, pelvis ginjal'),
(1338, 'C 22', 'Neoplasma ganas hati dan saluran empedu intrahepatik'),
(1339, 'C 46 - C 49', 'Neoplasma ganas jaringan ikat & jaringan lunak'),
(1340, 'C 67', 'Neoplasma ganas kandung kemih (buli-buli)'),
(1341, 'C 74 - C 75', 'Neoplasma ganas kelenjar endokrin lain dan struktur terkait '),
(1342, 'C 73', 'Neoplasma ganas kelenjar tiroid'),
(1343, 'C 18 ', 'Neoplasma ganas kolon'),
(1344, 'C 54', 'Neoplasma ganas korpus uteri'),
(1345, 'C 44', 'Neoplasma ganas kulit lainnya'),
(1346, 'C 88-C 90, C 96', 'Neoplasma ganas lain dari limfoid, hematopoetik dan jaringan terkait lainnya'),
(1347, 'C 16', 'Neoplasma ganas lambung'),
(1348, 'C 32', 'Neoplasma ganas laring'),
(1349, 'C 69', 'Neoplasma ganas mata dan  adneksa'),
(1350, 'C 38.1-.8', 'Neoplasma ganas mediastinum'),
(1351, 'C 11', 'Neoplasma ganas nasofaring    '),
(1352, 'C 71', 'Neoplasma ganas otak'),
(1353, 'C 56', 'Neoplasma ganas ovarium (indung telur)'),
(1354, 'C 25', 'Neoplasma ganas pankreas'),
(1355, 'C 50', 'Neoplasma ganas payudara'),
(1356, 'C 60', 'Neoplasma ganas penis'),
(1357, 'C 58', 'Neoplasma ganas plasenta (uri)'),
(1358, 'C 97', 'Neoplasma ganas primer tempat multipel'),
(1359, 'C 61', 'Neoplasma ganas prostat'),
(1360, 'C 77 - C 80', 'Neoplasma ganas sekunder dan neoplasma ganas kelenjar getah bening YTT'),
(1361, 'C 53', 'Neoplasma ganas serviks uterus'),
(1362, 'C 76', 'Neoplasma ganas tempat lain dan yang tidak jelas batasannya'),
(1363, 'C 62', 'Neoplasma ganas testis'),
(1364, 'C 33', 'Neoplasma ganas trakea'),
(1365, 'C 40 - C 41', 'Neoplasma ganas tulang dan tulang rawan sendi'),
(1366, 'C 17, C 23 - C 24,  C 26', 'Neoplasma ganas usus halus dan alat cerna lainnya'),
(1367, 'D 30', 'Neoplasma jinak alat kemih'),
(1368, 'D 22 - D 23', 'Neoplasma jinak kulit'),
(1369, 'D 10 - D12.0-.5,.7-.9, D1', 'Neoplasma jinak lainnya'),
(1370, 'D 15.2', 'Neoplasma jinak mediastinum'),
(1371, 'D 33', 'Neoplasma jinak otak dan susunan saraf pusat lainnya'),
(1372, 'D 27', 'Neoplasma jinak ovarium (indung telur)'),
(1373, 'D 24', 'Neoplasma jinak payudara'),
(1374, 'D 14.1 - .4', 'Neoplasma jinak sistem napas lainnya'),
(1375, 'D 37 - D 48', 'Neoplasma yang tak menentu perangainya dan yang tak diketahui sifatnya'),
(1376, 'N29.8', 'nephro calcinosis'),
(1377, 'N04.8', 'nepratio sindrom'),
(1378, 'N05', 'nepritis'),
(1379, 'N20.0', 'neprolitiasis'),
(1380, 'E14.2+N08.3*', 'nepropati diabetik'),
(1381, 'M79.2', 'neuralgia'),
(1382, 'F48.0', 'neurastania'),
(1383, 'H46', 'neuritis optic'),
(1384, 'H46', 'neuritis retro bulbar'),
(1385, 'H30.9', 'neuro chorioretiasis'),
(1386, 'Q85.0', 'neuro fibromatosis'),
(1387, 'D70', 'neuro panic'),
(1388, 'G58.9', 'neuropaty'),
(1389, 'K56.7', 'neus post histerectomy'),
(1390, 'L85.9', 'NHL'),
(1391, 'I64', 'NHS ( non hemorage stroke)'),
(1392, 'H 55', 'Nistagmus & pergerakan mata yang tidak teratur lainnya'),
(1393, 'A69.0', 'noma'),
(1394, 'M84.1', 'non union fraktur'),
(1395, 'R07.4', 'nyeri dada'),
(1396, 'R 10', 'Nyeri perut dan panggul'),
(1397, 'M54.5', 'nyeri pinggang'),
(1398, 'M 54.5', 'Nyeri punggung bawah'),
(1399, 'KODE', 'O'),
(1400, 'E 66', 'Obesitas'),
(1401, 'E66.9', 'obesitas /overweleh '),
(1402, 'R50.9', 'OBS febris'),
(1403, 'K59.0', 'obstipasi'),
(1404, 'P03.1', 'obstruksi anus ( akut bawan bayi)'),
(1405, 'J34.8', 'obstruksi nasi '),
(1406, 'K11.8', 'obstruksi parsial'),
(1407, 'N13.1', 'obstruksi uropati'),
(1408, 'P76.9', 'obstruksi usus'),
(1409, 'K87', 'obstruktif sundice'),
(1410, 'H34.1', 'oclosio arteri retina sentral '),
(1411, 'I25.2', 'old myocard infaction ( OMI)'),
(1412, 'O41.0', 'oligohidramnion'),
(1413, 'H66.9', 'OMP '),
(1414, 'P38', 'ompalitis '),
(1415, 'Q79.2', 'ompalocelle'),
(1416, 'B 73', 'Onkosersiasis'),
(1417, 'S 82,2,1', 'open fr cruris'),
(1418, 'S31.8', 'open wound prut'),
(1419, 'S31.1', 'open wourd abdomen wall'),
(1420, 'S81.0', 'open wourd knee'),
(1421, 'S71.1', 'open wourd tigh paha'),
(1422, 'H49.9', 'opthalmopalgia'),
(1423, 'B46', 'oral trush'),
(1424, 'Z 20, Z 22', 'Orang lain dengan risiko gangguan kesehatan yang berkaitan dengan penyakit menular'),
(1425, 'Z 00.2 - Z 13', 'Orang yang mendapatkan pelayanan kesehatan untuk pemeriksaan khusus dan investigasi lainnya'),
(1426, 'Z 40 - Z41.0, .1, .3 - Z ', 'Orang yang mengunjungi pelayanan kesehatan untuk tindakan perawatan khusus lainnya'),
(1427, 'H05.0', 'orbital celluitis'),
(1428, 'N46.9', 'orchitis'),
(1429, 'C40.1', 'osteo sarcoma dari'),
(1430, 'C49.2', 'osteo sarcoma femur'),
(1431, 'C40.2', 'osteo sarcoma lutut'),
(1432, 'M19.9', 'osteoartritis'),
(1433, 'M 86', 'Osteomielitis'),
(1434, 'M86.9', 'osteomyolitis'),
(1435, 'M87.9', 'osteonecrosis'),
(1436, 'H66.9', 'otitis'),
(1437, 'H 65 - H 75', 'Otitis media dan gangguan  mastoid dan  telinga tengah'),
(1438, 'T50.9', 'over dosis'),
(1443, 'K38.1', 'PAI'),
(1444, 'R10.4', 'pain abdominal'),
(1445, 'O44.0', 'palacenta previa ( jalan keluar bayi tertutup placenta)'),
(1446, 'Q35.9', 'palato sciziz'),
(1447, 'R00.2', 'palpitasi'),
(1448, 'G80.9', 'palsy cerebral'),
(1449, 'K86.8', 'pancereas anular'),
(1450, 'K85', 'pancreatitis acut'),
(1451, 'D61.9', 'pancytopenia'),
(1452, 'F41.0', 'panic diserdes'),
(1453, 'K 85 - K 86', 'Pankreatitis akut dan penyakit pankreas lainnya'),
(1454, 'H44.0', 'panophtalmitis'),
(1455, 'G12.3', 'paraliasi pertodik'),
(1456, 'K56.0', 'paralitik ilius '),
(1457, 'G82.2', 'paraparesis'),
(1458, 'J02.9', 'paringitis'),
(1459, 'G20', 'parkinson'),
(1460, 'G 21', 'Parkinson sekunder'),
(1461, 'K11.2', 'parotitis'),
(1462, 'O47.0', 'partus imaturus'),
(1463, 'O63.0', 'partus kasep'),
(1464, 'O62.3', 'partus kobrojal'),
(1465, 'O63.2', 'partus lama'),
(1466, 'B 90.9.1', 'Paru/lobus luluh akibat TB'),
(1467, 'Z30.1', 'pasang sepiral'),
(1468, 'Z90.7', 'pasca oferictomi'),
(1469, 'F45.9', 'pasiccsomatis'),
(1470, 'I47.1', 'PAT'),
(1471, 'A 66', 'Patek (Frambusia)'),
(1472, 'Z 50', 'Pelayanan yang melibatkan gangguan prosedur prosedur rehabilitasi'),
(1473, 'N73.5', 'pelvic peritonisis'),
(1474, 'W 42', 'Pemaparan bising'),
(1475, 'W 43', 'Pemaparan getaran '),
(1476, 'W 88', 'Pemaparan radiasi pengion'),
(1477, 'W 90', 'Pemaparan radiasi pengion lain'),
(1478, 'W 91', 'Pemaparan radiasi YTT'),
(1479, 'W 89', 'Pemaparan sinar ultra violet dan man-mide visible'),
(1480, 'Z 46.3', 'Pemasangan dan penyesuaian gigi palsu'),
(1481, 'Z 46.0', 'Pemasangan dan penyesuaian kacamata dan lensa kontak'),
(1482, 'Z 00.1', 'Pemeriksaan kesehatan bayi dan anak secara rutin'),
(1483, 'Z 00.0', 'Pemeriksaan kesehatan umum'),
(1484, 'K62.5', 'pendarahan anus'),
(1485, 'K06.8', 'pendarahan gusi'),
(1486, 'D75.9', 'pendarahan infra kranial PIK'),
(1487, 'R58', 'pendarahan intra abdomen'),
(1488, 'D75.9', 'pendarahan intra cranial'),
(1489, 'N95.0', 'pendarahan pasca menopouse'),
(1490, 'O 72', 'Pendarahan pasca persalinan'),
(1491, 'T18.0', 'pendarahan post op'),
(1492, 'P51.9', 'pendarahan tali pusat bayi'),
(1493, 'P51.9', 'pendarahan umbilicoli'),
(1494, 'I61.3', 'pendarahn pons'),
(1495, 'H46', 'penelitis'),
(1496, 'J93.9', 'penemo thorax'),
(1497, 'J93.8', 'penemo torax acut /cronik'),
(1498, 'P25.2', 'penemunia deastinum bayi'),
(1499, 'J98.2', 'penemunia disdtinum'),
(1500, 'Z 35', 'Pengawasan kehamilan dengan risiko tinggi'),
(1501, 'Z 34', 'Pengawasan kehamilan normal'),
(1502, 'Z 30', 'Pengelolaan kontrasepsi'),
(1503, 'Z 31 - Z 33, Z 37,Z 55 - ', 'Penunjang sarana kesehatan untuk alasan Lainnya'),
(1504, 'N 44 - N 46 N 48 - N 51', 'Penyakit alat kelamin laki lainnya'),
(1505, 'G 30', 'Penyakit Alzheimer'),
(1506, 'K 35 - K 38', 'Penyakit apendiks'),
(1507, 'I 71 - I 72, I 77 - I 79', 'Penyakit arteri, arteriol dan kapiler lainnya'),
(1508, 'A 21, A 24-28 A 31-32, A ', 'Penyakit bakteria lainnya'),
(1509, 'K 13 - K 14', 'Penyakit bibir, mukosa mulut lainnya dan lidah'),
(1510, 'B 76', 'Penyakit cacing tambang'),
(1511, 'K 50 - K 51', 'Penyakit Crohn dan tukak kolitis    '),
(1512, 'M 65.4', 'Penyakit de Quervain'),
(1513, 'K 57', 'Penyakit Divertikel usus'),
(1514, 'K 20 - K 23, K 28,  K 31', 'Penyakit esofagus, lambung dan duodenum lainnya'),
(1515, 'N 02.0 -.7,.9,N03, N 05 -', 'Penyakit glomerulus lainnya'),
(1516, 'E 04', 'Penyakit gondok nontoksik lain'),
(1517, 'K 05 – K 06', 'Penyakit gusi, jaringan periodontal dan tulang alveolar'),
(1518, 'K 71', 'Penyakit hati akibat bahan beracun di tempat kerja'),
(1519, 'K 70', 'Penyakit Hati Alkohol'),
(1520, 'K 74.0 - .5, K 75, K 76.1', 'Penyakit hati lainnya'),
(1521, 'P 55', 'Penyakit hemolitik pd janin & bayi baru lahir'),
(1522, 'J 30.0 - J 30.2,  J 33,  ', 'Penyakit hidung dan sinus hidung lainnya'),
(1523, 'I 11 - I 15', 'Penyakit hipertensi lainnya'),
(1524, 'C 81', 'Penyakit Hodgkin'),
(1525, 'P 35 - P 37', 'Penyakit infeksi dan parasit kongenital'),
(1526, 'A 65, A 67, A 69, A 74, B', 'Penyakit infeksi dan parasit lainnya'),
(1527, 'A 02, A 04 - A 05 A 07 - ', 'Penyakit infeksi usus lainnya'),
(1528, 'I 20, I 23 - I 25', 'Penyakit jantung iskemik lainnya'),
(1529, 'I 27 - I 41, I 51- I 52', 'Penyakit jantung lainnya'),
(1530, 'I 05 - I 09', 'Penyakit jantung reumatik kronik'),
(1531, 'K 03', 'Penyakit jaringan keras gigi lainnya'),
(1532, 'K 12', 'Penyakit jaringan lunak mulut (Stomatitis)  dan lesi yang berkaitan'),
(1533, 'K 11', 'Penyakit kelenjar liur'),
(1534, 'A 55 - A 56', 'Penyakit klamidia yg ditularkan melalui hubungan seksual'),
(1535, 'L 10 - L 22, L 25 - L 99', 'Penyakit kulit dan jaringan subkutan lainnya'),
(1536, 'H 57 - H 59', 'Penyakit lain mata dan adneksa'),
(1537, 'G 20', 'Penyakit Parkinson'),
(1538, 'I 73.1 - .9', 'Penyakit pembuluh darah perifer lainnya'),
(1539, 'K 04', 'Penyakit pulpa dan periapikal'),
(1540, 'N94.9', 'penyakit radang panggul PRP'),
(1541, 'G 00 - G 09', 'Penyakit radang susunan saraf pusat'),
(1542, 'J 36 - J 39', 'Penyakit saluran napas bagian atas lainnya'),
(1543, 'I 65 - I 69', 'Penyakit serebrovaskular lainnya'),
(1544, 'K 82 - K 83, K 87 - K 93', 'Penyakit sistem cerna lainnya'),
(1545, 'N 25 - N 29, N 31 - N 39', 'Penyakit sistem kemih lainnya'),
(1546, 'M 87 - M 99', 'Penyakit sistem muskuloskeletal dan jaringan ikat '),
(1547, 'J 22, J 66.1 -2, J 66.8, ', 'Penyakit sistem napas lainnya'),
(1548, 'I 86 - I 99', 'Penyakit sistem sirkulasi lainnya'),
(1549, 'G 10 - G 13, G 22 - G 26,', 'Penyakit susunan saraf lainnya'),
(1550, 'H 60 - H 61.0-.3,.9, H 62', 'Penyakit telinga dan prosesus mastoid'),
(1551, 'D 80 – D 89', 'Penyakit tertentu yang menyangkut mekanisme imun'),
(1552, 'J 35', 'Penyakit tonsil dan adenoid kronik'),
(1553, 'N 10 - N 11,  N 13, N 14.', 'Penyakit tubulo-interstitial ginjal lainnya'),
(1554, 'K 52 - K 55, K 59 - K 67', 'Penyakit usus dan peritoneum lainnya'),
(1555, 'B 20 - B 24', 'Penyakit virus gangguan defisiensi imun  pada manusia (HIV)'),
(1556, 'A 81,  A 87 - A 89 B 25, ', 'Penyakit virus lainnya'),
(1557, 'T 79 - T 88', 'Penyulit awal trauma tertentu dan penyulit pembedahan dan perawatan YTK di tempat lain'),
(1558, 'O 20 - O 23, O 25 - O 29', 'Penyulit kehamilan dan persalinan lainnya'),
(1559, 'O 85 - O 99', 'Penyulit yang lebih banyak berhubungan  dengan masa nifas dan kondisi obstetrik  lainnya, YTK ditempat lain'),
(1560, 'Z 39', 'Perawatan dan pemeriksaan pasca persalinan'),
(1561, 'O 31 - O 39 O 41, O 43, O', 'Perawatan ibu yang berkaitan dengan janin  dan ketuban dan masalah persalinan'),
(1562, 'Z91.5', 'percoban bunuh diri ( gantung diri)'),
(1563, 'O 46', 'Perdarahan antepartum YTK ditempat lain'),
(1564, 'I 60 - I 62', 'Perdarahan intrakranial'),
(1565, 'D46.9', 'pereleukemia'),
(1566, 'G52.2', 'pereplegia'),
(1567, 'K63.1', 'perforasi ileum/usus'),
(1568, 'N92.1', 'peri penopose bleeding'),
(1569, 'K37', 'periapendicitis'),
(1570, 'I31.3', 'pericardial Effusi'),
(1571, 'K05.2', 'periodentitis acut'),
(1572, 'K65.0', 'peritonisis difusi'),
(1573, 'K65.0', 'peritonisis generalized'),
(1574, 'K65.9', 'peritonitis'),
(1575, 'J36', 'peritonsilaer abses'),
(1576, 'K 76.0', 'Perlemakan hati'),
(1577, 'K05.3', 'perodenitis cronic'),
(1578, 'K63.1', 'perporasi jejunum'),
(1579, 'K63.1', 'perporasi kolon sigmoid'),
(1580, 'H66.9', 'perpurasi MAC'),
(1581, 'O 68', 'Persalinan dengan penyulit gawat janin'),
(1582, 'O 64 - O 66', 'Persalinan macet'),
(1583, 'O 84', 'Persalinan multipel'),
(1584, 'O 60', 'Persalinan prematur'),
(1585, 'O 80', 'Persalinan tunggal spontan'),
(1586, 'G81.9', 'persiapan CT scen'),
(1587, 'K00.6', 'persistensi gigi'),
(1588, 'P 05 - P 07', 'Pertumbuhan janin lamban, malnutrisi janin dan gangguan yang berhubungan dengan ke-hamilan pendek dan berat badan lahir rendah'),
(1589, 'A37.9', 'pertusis'),
(1590, 'A 37', 'Pertusis/Batuk rejan'),
(1591, 'N47', 'phymosis'),
(1592, 'J 86', 'Piotoraks [empiema]'),
(1593, 'F09', 'pisikosis organik'),
(1594, 'P02.0', 'placenta pravia bayi'),
(1595, 'J 92', 'Plak pleural'),
(1596, 'O 44', 'Plasenta previa'),
(1597, 'J18.8', 'plaura pnemunia'),
(1598, 'I 80.9', 'plebitis'),
(1599, 'K10.2', 'plegmoa'),
(1600, 'J90', 'pleura efusi'),
(1601, 'N11.8', 'PNC'),
(1602, 'J18.1', 'pnemonia lobaris'),
(1603, 'J86.9', 'pnemu torax'),
(1604, 'J15.7', 'pnemunia antipical'),
(1605, 'J69.0', 'pnemunia sapirasi'),
(1606, 'J 60 - J 65', 'Pneumokoniosis'),
(1607, 'J 12 - J 18', 'Pneumonia'),
(1608, 'J 67', 'Pneumonitis Hipersensitivity akibat abu organik'),
(1609, 'J 93', 'Pneumotoraks'),
(1610, 'D59.5', 'PNH ( parokimal noctumal hemoglobimuria)'),
(1611, 'M13.0', 'poli artritis'),
(1612, 'D45', 'policetimia vera'),
(1613, 'J98.4', 'policystic pam'),
(1614, 'Q69.9', 'polidektili'),
(1615, 'M35.3', 'polimialgia'),
(1616, 'G62.9', 'polineurpati'),
(1617, 'A 80', 'Poliomielitis akut'),
(1618, 'N84.1', 'polip cervikes'),
(1619, 'N84.0', 'polip endumetrium'),
(1620, 'D13.1', 'polip gaster'),
(1621, 'D13.1', 'polip gaster /stomach'),
(1622, 'D 12.6', 'Polip gastrointestinal'),
(1623, 'J33.9', 'polip nasi'),
(1624, 'K62.1', 'polip recti'),
(1625, 'K62.1', 'polip rectum'),
(1626, 'J33.8', 'pollip nasi'),
(1627, 'Q25.6', 'polmunal stenosis'),
(1628, 'J81', 'polmunari congestion'),
(1629, 'K63.1', 'porforasi sigmoid'),
(1630, 'K63.1', 'porforasi usus'),
(1631, 'K63.1', 'porfurasi ileum'),
(1632, 'K31.9', 'porpurasi gaster'),
(1633, 'J36', 'portionisilair infiltrat'),
(1634, 'F07.2', 'post concusison syndrome'),
(1635, 'N93.0', 'post congital bleding'),
(1636, 'Z98.8', 'post op apendictomy'),
(1637, 'Z98.8', 'post op strumectomy'),
(1638, 'Z93.3', 'post sigmoidectomy'),
(1639, 'Z93.3', 'post vcolostomy'),
(1640, 'O34.8', 'post veginal repair'),
(1641, 'J44.9', 'PPOM'),
(1642, 'O14.1', 'pre eklamsia brat'),
(1643, 'O14.9', 'pre eklamusia ringan'),
(1644, 'O60', 'prematur'),
(1645, 'P07.3', 'prematur bayi'),
(1646, 'N 47', 'Prepusium berlebih, fimosis dan parafimosis'),
(1647, 'O42.9', 'PRM'),
(1648, 'K62.8', 'proktitis'),
(1649, 'N81.4', 'prolap uteri'),
(1650, 'N 81', 'Prolaps alat kelamin perempuan'),
(1651, 'K62.9', 'prolaps anus'),
(1652, 'K91.4', 'prolaps colostomy'),
(1653, 'S05.2', 'prolaps iris'),
(1654, 'T85.3', 'prolaps mata '),
(1655, 'O34.5', 'prolaps tali pusat'),
(1656, 'K63.4', 'prolaps usus'),
(1657, 'N81.4', 'prolaps uteri ( tunggal pagiana)'),
(1658, 'O63.9', 'prolongud leten fase'),
(1659, 'H05.2', 'propthosis'),
(1660, 'N41.9', 'protatitis'),
(1661, 'J84.0', 'protenosis alveuler'),
(1662, 'A18.3+ K673*', 'prtonisis TBC'),
(1663, 'I60.9', 'PSA ( pendarahan sub arachnoid'),
(1664, 'M84.1', 'psaudar throsis'),
(1665, 'Z93.1', 'pseudophkia'),
(1666, 'F29', 'psikosis'),
(1667, 'M 07', 'Psoriasis dan artropati enteropati'),
(1668, 'M 10 - M 11', 'Psoriasis dan atropati lainnya'),
(1669, 'L40.1', 'psoriasis pustular'),
(1670, 'L40.0', 'psoriasis vulgenis'),
(1671, 'H11.8', 'psudo pteregium'),
(1672, 'H11.0', 'pteregium'),
(1673, 'O01.9', 'PTG ( penyakit tropobles ganas)'),
(1674, 'H02.4', 'ptisisc bulbi'),
(1675, 'H02.4', 'ptosis'),
(1676, 'N93.8', 'PUD'),
(1677, 'J98.4', 'pulmunal insufiensi'),
(1678, 'I27.9', 'PVC bigemini'),
(1679, 'N20.0', 'pyalolitasi'),
(1680, 'N12', 'pyelonepritis'),
(1681, 'N10', 'pyelonepritis acut'),
(1682, 'N11.9', 'pyolonepritis kronik'),
(1683, 'N13.6', 'pyoneprosus'),
(1686, 'M06.9', 'RA '),
(1687, 'A82.9', 'rabies'),
(1688, 'A 82', 'Rabies'),
(1689, 'N 71, N 74, N 75.8 - N 77', 'Radang alat dalam panggul perempuan lainnya (adneksitis)'),
(1690, 'H 00 - H 01', 'Radang kelopak mata'),
(1691, 'N 73', 'Radang panggul perempuan lainnya '),
(1692, 'N 72', 'Radang serviks'),
(1693, 'K11.6', 'ranala'),
(1694, 'I44.7', 'RBBB'),
(1695, 'P22.0', 'RDS'),
(1696, 'K75.2', 'reactur hepatitis'),
(1697, 'T78.2', 'reaksi anaphilactic'),
(1698, 'F44.9', 'reaksi conversi'),
(1699, 'F44.9', 'reaksi convrsi'),
(1700, 'E16.0', 'reaksi hipoglekimia '),
(1701, 'F43.0', 'reaksi stress acut'),
(1702, 'F 43.0, F 43.2-.9 F 45, F', 'Reaksi terhadap stres berat dan gangguan penyesuaian, gangguan somatoform, gangguan neurotik lainnya'),
(1703, 'C49.1', 'rebtomysarcoma cruris dextra'),
(1704, 'K62.5', 'rectal bleeding'),
(1705, 'P54.2', 'rectal bleeding bayi'),
(1706, 'N82.3', 'recto vagianal fistula'),
(1707, 'K21.9', 'reflex esofagus'),
(1708, 'K21.0', 'reflix esofagus'),
(1709, 'S05.8', 'reftur palpebra'),
(1710, 'S56.1', 'reftur tendon flexon digit'),
(1711, 'K06.8', 'refture alvecler '),
(1712, 'I77.2', 'refture artery'),
(1713, 'N83.8', 'refture tuba'),
(1714, 'S31.4', 'refture vagina'),
(1715, 'N28.8', 'ren mobilis'),
(1716, 'N23', 'renal colix'),
(1717, 'N19', 'renal fail'),
(1718, 'N19', 'renal nsipiensi'),
(1719, 'O70.9', 'reptum perineum (post partum )'),
(1720, 'S36.2', 'reptun pancereas traumatik'),
(1721, 'S05.3', 'reptur bola mata'),
(1722, 'S05.2', 'reptur cornea dengan prolap'),
(1723, 'S05.3', 'reptur cornea tampa prolaps'),
(1724, 'S36.1', 'reptur hepas '),
(1725, 'S86.0', 'reptur injuri tendon aciles'),
(1726, 'T14.6', 'reptur tendon'),
(1727, 'N36.8', 'reptur uretra non traumatik'),
(1728, 'S09.2', 'reptur uretra traumatik'),
(1729, 'O71.1', 'repture uteri'),
(1730, 'Z91.5', 'resiko ifeksi'),
(1731, '', 'respirasi puradokal'),
(1732, 'P22.9', 'respiratory distress bayi'),
(1733, 'J96.9', 'respiratory failure'),
(1734, 'P28.5', 'respiratory failure bayi '),
(1735, 'O72.0', 'rest. Placenta ( sisa placenta)'),
(1736, 'R33', 'retantio urine'),
(1737, 'F79', 'retar dasi mental'),
(1738, 'F 70 - F 79', 'Retardasi mental'),
(1739, 'R 33', 'retensi urin'),
(1740, 'C96.2', 'retino blastoma'),
(1741, 'Q55.2', 'retractile testis'),
(1742, 'H52.0', 'retraksi contas'),
(1743, 'K66,8', 'retropertioneal'),
(1744, 'N22', 'revtur VE'),
(1745, 'I09.9', 'RHD'),
(1746, 'M06.9', 'rhematoid'),
(1747, 'J31.0', 'rhinitis'),
(1748, 'J00', 'rhino paringitis'),
(1749, 'S31.4', 'robekan jalan lahir'),
(1750, 'B 06', 'Rubela'),
(1751, 'T14.6', 'ruftur muscolorum'),
(1752, 'S37.0', 'rufture lenkideney/ gijal'),
(1753, 'N09.0', 'rumah terbakar'),
(1754, 'S05.3', 'ruptur sclera'),
(1758, 'M46.1', 'sacro lleitis'),
(1759, 'I60.9', 'SAH ( sub aranoid hemoragic)'),
(1760, 'O32', 'salah letak'),
(1761, 'N 70', 'Salpingitis dan ooforitis'),
(1762, 'A 20', 'Sampar/Pes'),
(1763, 'I20.9', 'SAP ( stable anggia pastoris)'),
(1764, 'D21.1', 'sarcoma lengan '),
(1765, 'C55', 'sarcoma utery'),
(1766, 'J33.0', 'SBE'),
(1767, 'A49.9', 'SBP ( spontan bacterial peritonitis)'),
(1768, '', 'schizoprenia'),
(1769, 'J98.4', 'schwarte paru'),
(1770, 'S31.8', 'scizur abdomen penetrane'),
(1771, 'O62.1', 'scondery arrest'),
(1772, 'A18.4', 'scrof uloderma'),
(1773, 'W 20 - W 41, W 44 - W 64,', 'Sebab luar lainnya'),
(1774, 'H21.4', 'secclusio'),
(1775, '', 'seclusion pupil'),
(1776, 'O82.9', 'sectio'),
(1777, 'K04.3', 'secundarcan'),
(1778, 'B 92', 'Sekuele (gejala sisa) lepra'),
(1779, 'B 91', 'Sekuele (gejala sisa) poliomielitis'),
(1780, 'B 90.0 - .8', 'Sekuele (gejala sisa) TB lainnya'),
(1781, 'Z 36', 'Seleksi antenatal'),
(1782, 'A02.0', 'selmonikosis'),
(1783, 'C62.9', 'seminoma testis'),
(1784, 'X 60 - X 69', 'Sengaja mencederai diri dengan bahan beracun'),
(1785, 'X 70 - X 84', 'Sengaja mencederai diri lainnya'),
(1786, 'R 54', 'Senilitas'),
(1787, 'P06.9', 'sepsis bayi'),
(1788, 'O85', 'sepsis puerperalis'),
(1789, 'P36.9', 'sepsis seunatrium'),
(1790, 'M00.9', 'septic arteriris '),
(1791, 'A14.9', 'septic syok'),
(1792, 'A41.9', 'septicemia'),
(1793, 'A41.9', 'septikaimia'),
(1794, 'A 40 - A 41', 'Septisemia'),
(1795, 'R06.0', 'sesak'),
(1796, 'I61.9', 'SH ( struke hemorage)'),
(1797, 'A03.9', 'shigeloss'),
(1798, 'T78.2', 'shock anaphylatic'),
(1799, 'R57.1', 'shock hyvopelemic'),
(1800, 'N11.2', 'shymlaeparon'),
(1801, 'A 50', 'Sifilis bawaan'),
(1802, 'A 51', 'Sifilis dini     '),
(1803, 'A 52 - A 53', 'Sifilis lainnya   '),
(1804, 'A 03', 'Sigelosis'),
(1805, 'N55', 'sincope'),
(1806, 'F 04, F 07, F 09', 'Sindrom amnesik dan gangguan mental organik'),
(1807, 'Q03.1', 'sindrom dendy walcer'),
(1808, 'Q 90', 'Sindrom Down'),
(1809, 'K 76.7', 'Sindrom hepatorenal'),
(1810, 'F 50 - F 59', 'Sindrom makan, gangguan tidur, disfungsi seksual, gangguan perilaku lainnya'),
(1811, 'R 95', 'Sindrom mati mendadak pada bayi'),
(1812, 'N 00 - N 01', 'Sindrom nefritik progresif cepat dan akut'),
(1813, 'N 04', 'Sindrom nefrotik'),
(1814, 'B 90.9.2', 'Sindrom obstruksi pasca TB'),
(1815, 'G 81 - G 83', 'Sindrom paralitik lainnya'),
(1816, 'T 74', 'Sindrom salah perlakuan'),
(1817, 'K 58', 'Sindrom usus ringkih (Irritable bowel syndrome)'),
(1818, 'G 56.0', 'Sindroma carpal tunnel'),
(1819, 'I 73.0', 'Sindroma Raynaud’s'),
(1820, 'I64', 'sindrome batang otak'),
(1821, 'F07.2', 'sindrome concusion'),
(1822, 'G43.9', 'sindrome migren'),
(1823, 'I87.1', 'sindrome vena cava'),
(1824, 'J32.9', 'sinostis nasi'),
(1825, 'R00.1', 'sinus brodycardia'),
(1826, 'J32.9', 'sinus hati'),
(1827, 'Q18.1', 'sinus preacular'),
(1828, 'J 32', 'Sinusitis kronik'),
(1829, 'Z41.2', 'sircumsisi'),
(1830, 'K 74.6', 'Sirosis hati'),
(1831, 'N 30', 'Sistitis'),
(1832, 'L98.9', 'skin tag'),
(1833, 'B 65', 'Skistosomiasis (Bilharziasis)'),
(1834, 'F 20, F 21, F 23', 'Skizofrenia, gangguan skizotipal, psikotik akut dan sementara'),
(1835, 'G 35', 'Sklerosis multipel'),
(1836, 'L93.0', 'SLE'),
(1837, 'T63.0', 'snake bite'),
(1838, 'I63.9', 'SNH ( struke non hemorage)'),
(1839, '', 'socet dangkal'),
(1840, 'R57.0', 'sock cardiogenic'),
(1841, 'R900', 'SOL'),
(1842, 'M41.9', 'Soliausis'),
(1843, 'O 45', 'Solusio plasenta'),
(1844, 'O43.3', 'solutio placenta'),
(1845, 'R90.0', 'SOP'),
(1846, 'Q05.9', 'spina bepida '),
(1847, 'Q 05', 'Spina bifida'),
(1848, 'M46.9', 'spondilitis'),
(1849, 'M 45 - M 49', 'Spondiloartropati seronegatif'),
(1850, 'M43.1', 'spondilolisthesis'),
(1851, 'M47.9', 'spondilosis'),
(1852, 'C69.9', 'squemus cell ca.orbita'),
(1853, 'I47.1', 'Supraventricular tachycardia'),
(1854, 'N20.0', 'staghum stone ( calculus)'),
(1855, 'J 46', 'Status Asmatikus'),
(1856, 'J46', 'status asmeticus'),
(1857, 'G44.0', 'status convcilisive'),
(1858, 'G41.9', 'status epileptikus'),
(1859, '', 'stenosis jejunum'),
(1860, 'Q64.3', 'stenosis oni'),
(1861, '', 'stenosis pylorus'),
(1862, 'M48.0', 'stenosis spinalis'),
(1863, 'N35.9', 'stenosis ureter'),
(1864, 'K12.1', 'stomatitis'),
(1865, 'H 49 - H 50', 'Strabismus'),
(1866, 'K27.9', 'strees ulcer'),
(1867, 'K27.9', 'stres ulcus'),
(1868, 'K62.4', 'stricture ani/anus'),
(1869, 'N35.9', 'stricture uretra '),
(1870, 'I 64', 'Strok tak menyebut perdarahan atau infark'),
(1871, 'I64', 'stroke'),
(1872, 'E05.2', 'stroma hipertiroid'),
(1873, '', 'stroma hypertyroid'),
(1874, 'E04.9', 'stroma nodusa'),
(1875, 'E05.0', 'struma difuse tocxic'),
(1876, 'E04.2', 'struma multi nodusa '),
(1877, 'E05.2', 'struma nodusa hypertiroid'),
(1878, 'E04.9', 'struma nodusa non toxix'),
(1879, 'E05.1', 'struma nudusa toxix'),
(1880, 'E04.2', 'struma systic'),
(1881, 'E04.1', 'struma uni nadular non toxic'),
(1882, 'D14.3', 'STU parn'),
(1883, '', 'sub dural hematoma non traumatik'),
(1884, '', 'sub dural hematoma SDH'),
(1885, '', 'sub dural hematoma traumatik'),
(1886, 'I51.9', 'sub endo miocard'),
(1887, 'I21.4', 'sub endocaroio infarak'),
(1888, 'R96.0', 'suden death'),
(1889, 'H 34', 'Sumbatan vaskular retina'),
(1890, 'H11.2', 'sumbilofiron'),
(1891, 'I47.1', 'SVT ( supra venticuler tachicandila)'),
(1892, 'Q74.2', 'sympus'),
(1893, 'R55', 'syncope'),
(1894, 'Q70.9', 'syndaktily'),
(1895, 'G45.0', 'syndrom vertevro basiler'),
(1896, 'G61.0', 'syndrome barre guillain SGB'),
(1897, 'G25.9', 'syndrome extra pramidal'),
(1898, '', 'syndrome frontal lobe'),
(1899, 'G43.9', 'syndrome migrain'),
(1900, 'N04.8', 'syndrome nefhrotic '),
(1901, 'F06.9', 'syndrome otak organik'),
(1902, 'G45.0', 'syndrome vertebro basiler'),
(1903, 'H21.5', 'synechia/perlekatan mata'),
(1904, 'N57.9', 'syock'),
(1905, 'A53.9', 'sypilis'),
(1907, 'R00.0', 'tacicandia'),
(1908, 'A71.9', 'tacom'),
(1909, 'D56.9', 'talasemia'),
(1910, 'P02.4', 'tali pusat menimbung'),
(1911, 'L81.8', 'tatto'),
(1912, 'W70.0', 'tenggelam dikali'),
(1913, 'G44.2', 'tension head ache'),
(1914, 'X 00 - X 09', 'Terdedah asap, api dan uap'),
(1915, 'X 30 - X 39', 'Terdedah faktor alam'),
(1916, 'W20.0', 'tertimpa besi'),
(1917, 'Q 53', 'Testis tidak turun'),
(1918, 'A35', 'tetanus ( cephalic)'),
(1919, 'A 34 - A 35', 'Tetanus lainnya'),
(1920, 'A 33', 'Tetanus neonatorum'),
(1921, 'A33', 'tetanus neunatrium'),
(1922, 'Q21.3', 'tetralogi falot'),
(1923, 'M31.4', 'thalogasus'),
(1924, 'A01.0', 'thypoid fefer /abdominalis'),
(1925, 'O89.2', 'thyroglosal persistent'),
(1926, 'G45.9', 'TIA'),
(1927, 'Q 41', 'Tidak ada, atresia dan stenosis usus halus'),
(1928, 'G93.2', 'TIK'),
(1929, 'E 06', 'Tiroiditis'),
(1930, 'E06.3', 'tiroiditis hasimoto'),
(1931, 'E 05', 'Tirotoksikosis (hipertiroidisme)'),
(1932, 'R25.2', 'tismus'),
(1933, 'A33', 'tismus bayi'),
(1934, 'D33.0', 'to eccipital '),
(1935, 'G 92', 'Toksik insefalopati'),
(1936, 'B 58', 'Toksoplasmosis'),
(1937, 'J03.9', 'tonsilitis acut'),
(1938, 'J 03', 'Tonsilitis akut'),
(1939, 'J35.0', 'tonsilitis cronic'),
(1940, 'J06.8', 'tonsilo phanngitis'),
(1941, 'N44', 'torsi tersis D'),
(1942, 'M43.6', 'torticolis'),
(1943, 'J45.9', 'total blok'),
(1944, 'J04.1', 'traceitis acut'),
(1945, 'J39.8', 'traceomalacea '),
(1946, 'A 71', 'Trakoma'),
(1947, 'M67.3', 'transien synoritis'),
(1948, 'G82.5', 'traptorasre/tetraplegia'),
(1949, 'N28.9', 'trauma ginjal'),
(1950, 'S39.0', 'trauma pelvis'),
(1951, 'B 56 - B 57', 'Tripanosomiasis'),
(1952, 'A 15.0', 'Tuberkulosis (TB) paru BTA (+) dengan/ tanpa biakan kuman TB'),
(1953, 'A 16.3 - .9', 'Tuberkulosis alat napas lainnya'),
(1954, 'A  18.1, .3 - .8', 'Tuberkulosis lainnya'),
(1955, 'A 19', 'Tuberkulosis milier'),
(1956, 'A 15.1 - A 16.2', 'Tuberkulosis paru lainnya'),
(1957, 'A 17.1 - .9', 'Tuberkulosis susunan saraf pusat lainnya'),
(1958, 'A 18.0', 'Tuberkulosis tulang dan sendi'),
(1959, 'K 25 - K 27', 'Tukak lambung dan duodenum'),
(1960, 'D12.9', 'tumor anus'),
(1961, 'D12.0', 'tumor ceacum'),
(1962, 'D13.1', 'tumor gaster'),
(1963, 'D36.7', 'tumor glutea'),
(1964, 'C76.3', 'tumor glutea malignom'),
(1965, 'D48.0', 'tumor gusi '),
(1966, 'D13.1 ', 'tumor kantong empedu'),
(1967, 'C51.0', 'tumor labio mayora'),
(1968, 'D14.1', 'tumor laring ( paru)'),
(1969, 'C69', 'tumor mata'),
(1970, 'D16.4', 'tumor maxilla'),
(1971, 'O36.7', 'tumor meilum'),
(1972, 'D31.6', 'tumor orbit'),
(1973, 'O27', 'tumor ovari'),
(1974, 'C05.9', 'tumor palatum'),
(1975, 'D11.0', 'tumor parotis ( preaucular)'),
(1976, 'C49.0', 'tumor soft tissue ( ganas)'),
(1977, 'D11.7', 'tumor sub mandibula'),
(1978, 'D36.7', 'tumor tulang dada IGA'),
(1979, 'E05.9', 'tyrotoxi cosis'),
(1980, 'J 34.8', 'Ulcus mucosa hidung & perforasi septum nasi'),
(1981, 'N 20 - N 23', 'Urolitiasis'),
(1982, 'B 01 - B 02', 'Varisela (cacar air) dan zoster (herpes zoster)'),
(1983, 'I 85', 'Varises esofagus'),
(1984, 'R58', 'Haemorrhage, not elsewhere classified( pendarahan)'),
(1985, 'I 83', 'Varises vena ekstremitas bawah'),
(1986, 'I10', 'HYPERTENSION'),
(1987, 'O00.2', 'Ovarian pregnancy'),
(1988, 'Z30.0', 'KONSELING KB'),
(1989, 'B35', 'Tinea barbae and tinea capitis'),
(1990, 'vulnus appertum', 'vulnus appertum'),
(1991, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_diskon_trx`
--

CREATE TABLE `tbl_diskon_trx` (
  `id_diskon_trx` int(11) NOT NULL,
  `bulan` varchar(15) NOT NULL,
  `diskon` double NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dokter`
--

CREATE TABLE `tbl_dokter` (
  `id_dokter` int(11) NOT NULL,
  `nama_dokter` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `id_agama` int(11) NOT NULL,
  `alamat_tinggal` text NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `id_status_menikah` int(11) NOT NULL,
  `id_spesialis` int(11) NOT NULL,
  `no_izin_praktek` varchar(20) NOT NULL,
  `golongan_darah` varchar(2) NOT NULL,
  `alumni` varchar(40) NOT NULL,
  `is_jaga` int(1) NOT NULL COMMENT '0:"Lepas" , 1:"Jaga"',
  `no_pendaftaran` varchar(20) DEFAULT NULL COMMENT 'no_pendaftaran pasien yang sedang ditangani',
  `komisi_biaya_pemeriksaan` float NOT NULL,
  `komisi_biaya_tindakan` float NOT NULL,
  `komisi_biaya_obat` float NOT NULL,
  `id_poli` int(11) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dokter`
--

INSERT INTO `tbl_dokter` (`id_dokter`, `nama_dokter`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `id_agama`, `alamat_tinggal`, `no_hp`, `id_status_menikah`, `id_spesialis`, `no_izin_praktek`, `golongan_darah`, `alumni`, `is_jaga`, `no_pendaftaran`, `komisi_biaya_pemeriksaan`, `komisi_biaya_tindakan`, `komisi_biaya_obat`, `id_poli`, `dtm_crt`, `dtm_upd`) VALUES
(3, 'dr. NYOMAN WIRA SWASTIKA, Sp.B', 'L', 'lombok barat', '1978-04-05', 3, 'GENTENG', '0987654321', 1, 11, 'spo 987654', 'A', 'unair udayana', 1, '000002', 15, 15, 15, 4, '2021-11-29 04:21:10', '2021-12-13 04:51:29'),
(4, 'drg. INDAH DWI ERNAWATI M. Kes', 'P', 'Banyuwangi', '1973-05-04', 1, 'Dusun Krajan Wetan RT 001 RW 003 Desa Temuguruh Kecamatan Sempu', '0811370398', 1, 6, 'sip09999', 'B', 'Unair', 1, NULL, 10, 10, 10, 2, '2021-11-29 04:23:47', '2021-12-02 08:27:50'),
(5, 'dr. ROBBY ADITYA, S.Ked', 'L', 'Banyuwangi', '1997-02-21', 1, 'SRONO', '000987654321', 2, 4, 'sip09997', 'A', 'Unair', 1, '000003', 15, 15, 15, 1, '2021-11-29 04:25:37', '2021-12-11 06:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_golongan_barang`
--

CREATE TABLE `tbl_golongan_barang` (
  `id_golongan_barang` int(11) NOT NULL,
  `nama_golongan_barang` varchar(50) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_golongan_barang`
--

INSERT INTO `tbl_golongan_barang` (`id_golongan_barang`, `nama_golongan_barang`, `keterangan`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'Obat Keras', 'dibutuhkan resep dari dokter', '2019-11-14 16:06:41', '2019-11-14 10:15:55'),
(2, 'Obat Antibiotik', 'Dibutuhkan resep dokter', '2019-12-07 10:52:24', '2021-10-27 04:12:14'),
(3, 'BMHP', 'Barang Medis Habis Pakai', '2021-10-21 10:02:39', '2021-12-13 03:34:27'),
(4, 'Suplemen', 'Suplemen makanan dan minuman', '2021-10-27 11:13:15', '2021-10-27 11:13:15'),
(5, 'Multi vitamin', 'Suplemen vitamin & mineral', '2021-10-27 11:14:03', '2021-10-27 11:14:03'),
(6, 'Obat bebas', 'Tanpa resep dokter', '2021-10-27 11:14:23', '2021-10-27 11:14:23'),
(7, 'Obat luar', 'Pemakaian luar', '2021-10-27 11:14:44', '2021-10-27 11:14:44'),
(8, 'Generik', '-', '2021-12-03 09:57:21', '2021-12-03 09:57:21'),
(9, 'Paten', '-', '2021-12-03 09:57:26', '2021-12-03 09:57:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gudang`
--

CREATE TABLE `tbl_gudang` (
  `kode_gudang` varchar(20) NOT NULL,
  `nama_gudang` varchar(20) NOT NULL,
  `alamat_gudang` varchar(100) NOT NULL,
  `kota` varchar(25) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_gudang`
--

INSERT INTO `tbl_gudang` (`kode_gudang`, `nama_gudang`, `alamat_gudang`, `kota`, `telp`, `dtm_crt`, `dtm_upd`) VALUES
('GUD1573716602', 'Gudang B', 'jl kencana', 'Denpasar', '0809090909', '2019-11-14 14:30:02', '2021-10-04 08:56:56'),
('GUD1574152872', 'Gudang A', 'jl Padonan', 'Badung', '0899898989', '2019-11-19 15:41:12', '2021-10-04 08:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hak_akses`
--

CREATE TABLE `tbl_hak_akses` (
  `id` int(11) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hak_akses`
--

INSERT INTO `tbl_hak_akses` (`id`, `id_user_level`, `id_menu`, `dtm_crt`, `dtm_upd`) VALUES
(15, 1, 1, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(19, 1, 3, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(24, 1, 9, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(37, 4, 22, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(42, 1, 2, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(43, 1, 6, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(44, 1, 7, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(45, 1, 8, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(46, 1, 13, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(47, 1, 14, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(48, 1, 15, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(49, 1, 16, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(50, 1, 17, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(51, 1, 18, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(52, 1, 20, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(53, 1, 23, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(55, 1, 24, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(56, 1, 29, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(58, 1, 34, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(59, 1, 37, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(60, 1, 38, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(62, 1, 36, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(63, 1, 19, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(66, 2, 7, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(67, 2, 17, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(68, 2, 6, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(69, 2, 8, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(70, 2, 39, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(78, 5, 30, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(81, 5, 22, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(83, 1, 21, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(84, 1, 22, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(85, 1, 25, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(86, 1, 26, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(87, 1, 27, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(88, 1, 28, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(89, 1, 30, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(90, 1, 31, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(91, 1, 32, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(92, 1, 35, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(93, 1, 40, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(97, 4, 42, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(98, 4, 43, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(100, 5, 44, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(108, 1, 47, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(109, 1, 48, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(110, 5, 49, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(113, 1, 50, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(116, 1, 52, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(117, 1, 33, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(118, 1, 53, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(120, 5, 54, '2018-03-28 09:59:32', '2018-03-28 09:59:32'),
(121, 5, 55, '2018-04-03 11:37:10', '2018-04-03 11:37:10'),
(122, 4, 41, '2018-04-19 10:35:23', '2018-04-19 10:35:23'),
(123, 8, 57, '2018-04-25 16:19:54', '2018-04-25 16:19:54'),
(128, 5, 58, '2018-04-25 23:23:52', '2018-04-25 23:23:52'),
(129, 5, 59, '2018-04-25 23:23:53', '2018-04-25 23:23:53'),
(130, 5, 60, '2018-04-25 23:36:39', '2018-04-25 23:36:39'),
(135, 3, 27, '2018-05-17 09:21:12', '2018-05-17 09:21:12'),
(136, 3, 28, '2018-05-17 09:21:13', '2018-05-17 09:21:13'),
(137, 3, 29, '2018-05-17 09:21:13', '2018-05-17 09:21:13'),
(138, 1, 64, '2018-05-19 14:30:19', '2018-05-19 14:30:19'),
(139, 1, 65, '2019-11-13 09:54:42', '2019-11-13 09:54:42'),
(140, 1, 66, '2019-11-13 10:03:08', '2019-11-13 10:03:08'),
(141, 1, 67, '2019-11-13 10:03:09', '2019-11-13 10:03:09'),
(142, 1, 72, '2019-11-13 10:27:02', '2019-11-13 10:27:02'),
(143, 1, 71, '2019-11-13 10:27:03', '2019-11-13 10:27:03'),
(144, 1, 70, '2019-11-13 10:27:04', '2019-11-13 10:27:04'),
(145, 1, 69, '2019-11-13 10:27:04', '2019-11-13 10:27:04'),
(146, 1, 68, '2019-11-13 10:27:05', '2019-11-13 10:27:05'),
(147, 1, 73, '2019-11-13 10:30:02', '2019-11-13 10:30:02'),
(148, 1, 74, '2019-11-13 10:34:53', '2019-11-13 10:34:53'),
(149, 1, 75, '2019-11-13 10:34:56', '2019-11-13 10:34:56'),
(150, 1, 76, '2019-11-13 10:34:57', '2019-11-13 10:34:57'),
(151, 1, 77, '2019-11-13 10:34:58', '2019-11-13 10:34:58'),
(152, 1, 78, '2019-11-13 10:39:30', '2019-11-13 10:39:30'),
(153, 1, 79, '2019-11-13 12:08:07', '2019-11-13 12:08:07'),
(154, 1, 80, '2019-11-13 13:59:47', '2019-11-13 13:59:47'),
(155, 1, 81, '2019-11-14 12:32:36', '2019-11-14 12:32:36'),
(156, 1, 82, '2019-11-14 13:38:07', '2019-11-14 13:38:07'),
(157, 1, 83, '2019-11-14 14:20:11', '2019-11-14 14:20:11'),
(158, 1, 84, '2019-11-14 15:53:52', '2019-11-14 15:53:52'),
(159, 1, 85, '2019-11-14 16:30:27', '2019-11-14 16:30:27'),
(160, 1, 86, '2019-11-14 20:59:31', '2019-11-14 20:59:31'),
(161, 1, 89, '2019-11-15 17:57:49', '2019-11-15 17:57:49'),
(162, 1, 88, '2019-11-16 08:39:25', '2019-11-16 08:39:25'),
(163, 1, 87, '2019-11-16 08:39:28', '2019-11-16 08:39:28'),
(164, 1, 90, '2019-11-16 08:39:31', '2019-11-16 08:39:31'),
(165, 1, 91, '2019-11-16 08:39:33', '2019-11-16 08:39:33'),
(166, 1, 93, '2019-11-18 08:37:03', '2019-11-18 08:37:03'),
(168, 1, 92, '2019-11-18 08:44:29', '2019-11-18 08:44:29'),
(169, 1, 94, '2019-11-20 09:24:15', '2019-11-20 09:24:15'),
(170, 1, 95, '2019-11-20 09:24:16', '2019-11-20 09:24:16'),
(171, 1, 96, '2019-11-21 14:05:41', '2019-11-21 14:05:41'),
(172, 1, 102, '2019-11-23 11:14:22', '2019-11-23 11:14:22'),
(173, 6, 96, '2019-11-26 09:26:02', '2019-11-26 09:26:02'),
(174, 7, 102, '2019-11-26 09:28:33', '2019-11-26 09:28:33'),
(175, 1, 116, '2019-12-03 10:19:47', '2019-12-03 10:19:47'),
(176, 1, 117, '2019-12-05 11:01:39', '2019-12-05 11:01:39'),
(180, 3, 92, '2019-12-11 21:20:05', '2019-12-11 21:20:05'),
(194, 3, 46, '2019-12-13 09:27:19', '2019-12-13 09:27:19'),
(198, 8, 127, '2019-12-13 09:34:43', '2019-12-13 09:34:43'),
(199, 7, 117, '2019-12-13 09:39:09', '2019-12-13 09:39:09'),
(200, 8, 45, '2019-12-17 11:19:42', '2019-12-17 11:19:42'),
(201, 8, 62, '2019-12-17 11:20:16', '2019-12-17 11:20:16'),
(202, 4, 40, '2018-04-19 10:35:23', '2018-04-19 10:35:23'),
(203, 4, 41, '2018-04-19 10:35:23', '2018-04-19 10:35:23'),
(204, 5, 39, '2021-09-14 20:44:09', '2021-09-14 20:44:09'),
(206, 1, 133, '2021-09-17 10:14:28', '2021-09-17 10:14:28'),
(207, 1, 134, '2021-09-19 13:36:09', '2021-09-19 13:36:09'),
(208, 9, 22, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(209, 9, 30, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(210, 9, 22, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(211, 9, 42, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(212, 9, 43, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(214, 9, 49, '2018-03-27 10:33:46', '2018-03-27 10:33:46'),
(216, 9, 55, '2018-04-03 11:37:10', '2018-04-03 11:37:10'),
(217, 9, 41, '2018-04-19 10:35:23', '2018-04-19 10:35:23'),
(218, 9, 57, '2018-04-25 16:19:54', '2018-04-25 16:19:54'),
(219, 9, 58, '2018-04-25 23:23:52', '2018-04-25 23:23:52'),
(220, 9, 59, '2018-04-25 23:23:53', '2018-04-25 23:23:53'),
(221, 9, 60, '2018-04-25 23:36:39', '2018-04-25 23:36:39'),
(222, 9, 27, '2018-05-17 09:21:12', '2018-05-17 09:21:12'),
(223, 9, 28, '2018-05-17 09:21:13', '2018-05-17 09:21:13'),
(224, 9, 29, '2018-05-17 09:21:13', '2018-05-17 09:21:13'),
(231, 9, 40, '2018-04-19 10:35:23', '2018-04-19 10:35:23'),
(232, 9, 41, '2018-04-19 10:35:23', '2018-04-19 10:35:23'),
(235, 1, 39, '2021-10-05 08:58:30', '2021-10-05 08:58:30'),
(236, 1, 41, '2021-10-05 08:58:32', '2021-10-05 08:58:32'),
(237, 1, 42, '2021-10-05 08:58:33', '2021-10-05 08:58:33'),
(238, 1, 43, '2021-10-05 08:58:35', '2021-10-05 08:58:35'),
(239, 1, 44, '2021-10-05 08:58:36', '2021-10-05 08:58:36'),
(240, 1, 45, '2021-10-05 08:58:38', '2021-10-05 08:58:38'),
(241, 1, 46, '2021-10-05 08:58:39', '2021-10-05 08:58:39'),
(242, 1, 49, '2021-10-05 08:58:40', '2021-10-05 08:58:40'),
(243, 1, 54, '2021-10-05 08:58:41', '2021-10-05 08:58:41'),
(244, 1, 55, '2021-10-05 08:58:46', '2021-10-05 08:58:46'),
(245, 1, 57, '2021-10-05 08:58:47', '2021-10-05 08:58:47'),
(246, 1, 58, '2021-10-05 08:58:48', '2021-10-05 08:58:48'),
(247, 1, 59, '2021-10-05 08:58:48', '2021-10-05 08:58:48'),
(248, 1, 60, '2021-10-05 08:58:49', '2021-10-05 08:58:49'),
(249, 1, 61, '2021-10-05 08:58:50', '2021-10-05 08:58:50'),
(250, 1, 62, '2021-10-05 08:58:52', '2021-10-05 08:58:52'),
(251, 1, 63, '2021-10-05 08:58:53', '2021-10-05 08:58:53'),
(252, 1, 97, '2021-10-05 08:58:57', '2021-10-05 08:58:57'),
(253, 1, 99, '2021-10-05 08:58:58', '2021-10-05 08:58:58'),
(254, 1, 100, '2021-10-05 08:58:59', '2021-10-05 08:58:59'),
(255, 1, 101, '2021-10-05 08:59:01', '2021-10-05 08:59:01'),
(256, 1, 103, '2021-10-05 08:59:02', '2021-10-05 08:59:02'),
(257, 1, 104, '2021-10-05 08:59:03', '2021-10-05 08:59:03'),
(258, 1, 106, '2021-10-05 08:59:04', '2021-10-05 08:59:04'),
(259, 1, 107, '2021-10-05 08:59:05', '2021-10-05 08:59:05'),
(260, 1, 108, '2021-10-05 08:59:06', '2021-10-05 08:59:06'),
(261, 1, 109, '2021-10-05 08:59:08', '2021-10-05 08:59:08'),
(262, 1, 110, '2021-10-05 08:59:09', '2021-10-05 08:59:09'),
(263, 1, 111, '2021-10-05 08:59:10', '2021-10-05 08:59:10'),
(264, 1, 112, '2021-10-05 08:59:13', '2021-10-05 08:59:13'),
(265, 1, 113, '2021-10-05 08:59:15', '2021-10-05 08:59:15'),
(266, 1, 114, '2021-10-05 08:59:16', '2021-10-05 08:59:16'),
(267, 1, 115, '2021-10-05 08:59:16', '2021-10-05 08:59:16'),
(268, 1, 118, '2021-10-05 08:59:19', '2021-10-05 08:59:19'),
(269, 1, 119, '2021-10-05 08:59:20', '2021-10-05 08:59:20'),
(270, 1, 120, '2021-10-05 08:59:21', '2021-10-05 08:59:21'),
(271, 1, 121, '2021-10-05 08:59:22', '2021-10-05 08:59:22'),
(272, 1, 122, '2021-10-05 08:59:22', '2021-10-05 08:59:22'),
(273, 1, 123, '2021-10-05 08:59:23', '2021-10-05 08:59:23'),
(274, 1, 126, '2021-10-05 08:59:24', '2021-10-05 08:59:24'),
(275, 1, 127, '2021-10-05 08:59:25', '2021-10-05 08:59:25'),
(276, 1, 128, '2021-10-05 08:59:26', '2021-10-05 08:59:26'),
(277, 1, 129, '2021-10-05 08:59:28', '2021-10-05 08:59:28'),
(278, 1, 130, '2021-10-05 08:59:32', '2021-10-05 08:59:32'),
(279, 1, 131, '2021-10-05 08:59:33', '2021-10-05 08:59:33'),
(280, 1, 132, '2021-10-05 08:59:35', '2021-10-05 08:59:35'),
(281, 5, 40, '2021-10-12 10:33:26', '2021-10-12 10:33:26'),
(282, 1, 135, '2021-10-20 09:07:00', '2021-10-20 09:07:00'),
(284, 8, 47, '2021-10-21 13:34:27', '2021-10-21 13:34:27'),
(286, 8, 63, '2021-10-21 13:34:47', '2021-10-21 13:34:47'),
(287, 1, 136, '2021-10-22 09:07:00', '2021-10-20 09:07:00'),
(288, 3, 61, '2021-10-23 09:26:20', '2021-10-23 09:26:20'),
(291, 8, 126, '2021-10-21 13:34:47', '2021-10-21 13:34:47'),
(292, 1, 137, '2021-11-04 10:33:46', '2021-11-04 10:33:46'),
(293, 3, 138, '2021-11-06 10:33:46', '2021-11-06 10:33:46'),
(294, 1, 139, '2021-11-26 15:21:34', '2021-11-26 15:21:34'),
(295, 1, 138, '2021-11-26 15:21:34', '2021-11-26 15:21:34'),
(296, 10, 49, '2021-11-28 12:42:23', '2021-11-28 12:42:23'),
(297, 10, 44, '2021-11-28 12:43:48', '2021-11-28 12:43:48'),
(298, 1, 140, '2021-12-01 21:48:36', '2021-12-01 21:48:36'),
(299, 1, 141, '2021-12-01 21:48:36', '2021-12-01 21:48:36'),
(300, 1, 142, '2021-12-01 21:48:38', '2021-12-01 21:48:38'),
(301, 1, 143, '2021-12-01 21:48:43', '2021-12-01 21:48:43'),
(302, 1, 144, '2021-12-01 21:48:44', '2021-12-01 21:48:44'),
(303, 1, 145, '2021-12-01 21:48:44', '2021-12-01 21:48:44'),
(304, 1, 146, '2021-12-01 21:48:45', '2021-12-01 21:48:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_imunisasi`
--

CREATE TABLE `tbl_imunisasi` (
  `no_rekam_medis` varchar(10) NOT NULL,
  `macam_persalinan` enum('1','2') NOT NULL COMMENT '1 = Normal, 2 = SC',
  `pelayanan_persalinan` enum('1','2','3','4','5','6') NOT NULL COMMENT '1 = Dokter, 2 = Bidan, 3 = Tenanga Puskesmas, 4 = Dukun Terlatih, 5 = Dukun, 6 = Sendiri',
  `anak_ke` tinyint(2) NOT NULL,
  `tempat_persalinan` enum('1','2','3','4','5') NOT NULL COMMENT '1 = Rumah, 2 = Rumah Sakit, 3 = Puskesmas, 4 = Rumah Berasalin, 5 = Rumah Bidan',
  `asi` enum('1','2') NOT NULL COMMENT '1 = Asi, 2 = SuFor',
  `hb0` date NOT NULL,
  `bcg` date NOT NULL,
  `polio1` date NOT NULL,
  `pentabio1` date NOT NULL,
  `polio2` date NOT NULL,
  `pentabio2` date NOT NULL,
  `polio3` date NOT NULL,
  `pentabio3` date NOT NULL,
  `polio4` date NOT NULL,
  `campak` date NOT NULL,
  `je` date NOT NULL,
  `pentabio_booster` date NOT NULL,
  `campak_booster` date NOT NULL,
  `vitA1` varchar(100) NOT NULL,
  `vitA2` varchar(100) NOT NULL,
  `vitA3` varchar(100) NOT NULL,
  `vitA4` varchar(100) NOT NULL,
  `vitA5` varchar(100) NOT NULL,
  `vitA6` varchar(100) NOT NULL,
  `vitA7` varchar(100) NOT NULL,
  `vitA8` varchar(100) NOT NULL,
  `vitA9` varchar(100) NOT NULL,
  `vitA10` varchar(100) NOT NULL,
  `obat_cacing1` varchar(100) NOT NULL,
  `obat_cacing2` varchar(100) NOT NULL,
  `obat_cacing3` varchar(100) NOT NULL,
  `obat_cacing4` varchar(100) NOT NULL,
  `obat_cacing5` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

CREATE TABLE `tbl_inventory` (
  `id_inventory` varchar(15) NOT NULL,
  `kode_purchase` varchar(15) DEFAULT NULL,
  `inv_type` varchar(25) DEFAULT NULL,
  `id_klinik` int(11) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`id_inventory`, `kode_purchase`, `inv_type`, `id_klinik`, `dtm_crt`, `dtm_upd`) VALUES
('RCP1638087624', 'PO1638087590', 'RECEIPT_ORDER', 1, '2021-11-28 15:20:24', '2021-11-28 15:20:24'),
('RCP1638087760', NULL, 'TRX_STUFF', 1, '2021-11-28 15:22:40', '2021-11-28 15:22:40'),
('RCP1638088051', NULL, 'TRX_STUFF', 1, '2021-11-28 15:27:31', '2021-11-28 15:27:31'),
('RCP1638272589', 'PO1638272515', 'RECEIPT_ORDER', 1, '2021-11-30 11:43:09', '2021-11-30 11:43:09'),
('RCP1638960088', 'PO1638959928', 'RECEIPT_ORDER', 1, '2021-12-08 10:41:28', '2021-12-08 10:41:28'),
('RCP1639198853', NULL, 'TRX_STUFF', 1, '2021-12-11 05:00:53', '2021-12-11 05:00:53'),
('RCP1639199405', NULL, 'TRX_STUFF', 1, '2021-12-11 05:10:05', '2021-12-11 05:10:05'),
('RCP1639369724', NULL, 'TRX_STUFF', 1, '2021-12-13 04:28:44', '2021-12-13 04:28:44'),
('RCP1639369953', NULL, 'TRX_STUFF', 1, '2021-12-13 04:32:33', '2021-12-13 04:32:33'),
('RCP1639371305', NULL, 'TRX_STUFF', 1, '2021-12-13 04:55:05', '2021-12-13 04:55:05'),
('RCP1639371589', NULL, 'TRX_STUFF', 1, '2021-12-13 04:59:49', '2021-12-13 04:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_detail`
--

CREATE TABLE `tbl_inventory_detail` (
  `id_inventory_detail` int(11) NOT NULL,
  `id_inventory` varchar(15) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `kode_gudang` varchar(15) NOT NULL,
  `id_lokasi_barang` int(11) NOT NULL,
  `jumlah` double NOT NULL,
  `harga` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `tgl_exp` date NOT NULL,
  `notes` varchar(50) DEFAULT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_inventory_detail`
--

INSERT INTO `tbl_inventory_detail` (`id_inventory_detail`, `id_inventory`, `kode_barang`, `kode_gudang`, `id_lokasi_barang`, `jumlah`, `harga`, `diskon`, `tgl_exp`, `notes`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'RCP1638087624', 'BRG1638086758', 'GUD1574152872', 2, 20, 15600, 0, '2022-12-28', NULL, '2021-11-28 15:20:24', '2021-11-28 15:20:24'),
(2, 'RCP1638087760', 'BRG1638086758', '', 0, 1, 15600, 0, '2022-12-28', NULL, '2021-11-28 15:22:40', '2021-11-28 15:22:40'),
(3, 'RCP1638088051', 'BRG1638086758', '', 0, 1, 15600, 0, '2022-12-28', NULL, '2021-11-28 15:27:31', '2021-11-28 15:27:31'),
(4, 'RCP1638272589', 'BRG1638272332', 'GUD1574152872', 2, 12, 2000000, 500000, '2021-12-30', NULL, '2021-11-30 11:43:09', '2021-11-30 11:43:09'),
(5, 'RCP1638960088', 'BRG1638505329', 'GUD1574152872', 1, 30, 65000, 0, '2022-05-10', NULL, '2021-12-08 10:41:28', '2021-12-08 10:41:28'),
(6, 'RCP1639369724', 'BRG1638505329', '', 0, 1, 50000, 0, '2022-05-10', NULL, '2021-12-13 04:28:44', '2021-12-13 04:28:44'),
(7, 'RCP1639369724', 'BRG1638272332', '', 0, 1, 1500000, 0, '2021-12-30', NULL, '2021-12-13 04:28:44', '2021-12-13 04:28:44'),
(8, 'RCP1639369953', 'BRG1638272332', '', 0, 1, 1500000, 0, '2021-12-30', NULL, '2021-12-13 04:32:33', '2021-12-13 04:32:33'),
(9, 'RCP1639369953', 'BRG1638505329', '', 0, 1, 50000, 0, '2022-05-10', NULL, '2021-12-13 04:32:33', '2021-12-13 04:32:33'),
(10, 'RCP1639371589', 'BRG1638272332', '', 0, 1, 1500000, 0, '0000-00-00', NULL, '2021-12-13 04:59:49', '2021-12-13 04:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jabatan`
--

CREATE TABLE `tbl_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(30) NOT NULL,
  `dtm_crt` datetime DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jabatan`
--

INSERT INTO `tbl_jabatan` (`id_jabatan`, `nama_jabatan`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'Bag. Umum', '2019-12-02 15:49:21', '2021-09-23 04:17:05'),
(2, 'Administrasi', '2019-12-02 15:49:21', '2019-12-02 09:49:26'),
(3, 'penanggung jawab lab', '2019-12-02 15:49:21', '2019-12-02 15:49:21'),
(4, 'Apoteker', '2019-12-02 15:49:21', '2019-12-02 15:49:21'),
(5, 'OB', '2019-12-02 15:49:21', '2019-12-02 15:49:21'),
(6, 'Perawat', '2021-09-23 11:17:32', '2021-09-23 11:17:32'),
(7, 'Bidan', '2021-09-23 11:17:41', '2021-09-23 11:17:41'),
(8, 'Laundry', '2021-09-23 11:17:49', '2021-12-01 03:53:54'),
(9, 'Sopir Ambulance', '2021-09-23 11:27:27', '2021-12-01 03:53:20'),
(10, 'Sekuriti', '2021-12-01 03:54:35', '2021-12-01 03:54:35'),
(11, 'Kebersihan', '2021-12-01 03:55:15', '2021-12-01 03:55:15'),
(12, 'penunjang non medis', '2021-12-01 03:55:41', '2021-12-01 03:55:41'),
(13, 'Gizi', '2021-12-01 03:56:08', '2021-12-01 03:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jasa`
--

CREATE TABLE `tbl_jasa` (
  `kode_jasa` varchar(15) NOT NULL,
  `nama_jasa` varchar(50) NOT NULL,
  `id_kategori_barang` int(11) NOT NULL,
  `id_satuan_barang` int(11) NOT NULL,
  `hna` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `barcode_jasa` int(11) NOT NULL,
  `foto_jasa` varchar(200) NOT NULL,
  `id_klinik` int(11) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jasa`
--

INSERT INTO `tbl_jasa` (`kode_jasa`, `nama_jasa`, `id_kategori_barang`, `id_satuan_barang`, `hna`, `harga`, `barcode_jasa`, `foto_jasa`, `id_klinik`, `dtm_crt`, `dtm_upd`) VALUES
('JSA1573872070', 'Peracikan Obat', 2, 1, 80999, 90000, 0, 'OBT_1573872462.jpg', 1, '2019-11-16 09:41:11', '2019-11-16 03:47:42'),
('JSA1633058385', 'Rapid Antigen', 3, 1, 70000, 95000, 101, 'OBT_1633058385.jpeg', 1, '2021-10-01 10:19:45', '2021-10-01 10:19:45'),
('JSA1633058440', 'Imunisasi', 3, 1, 75000, 100000, 102, 'OBT_1633058440.doc', 1, '2021-10-01 10:20:40', '2021-10-01 10:20:40'),
('JSA1633338784', 'Fisiotherapy', 3, 11, 95000, 100000, 1250, 'OBT_1634184070.jpg', 1, '2021-10-04 16:13:04', '2021-10-14 04:01:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_operasi`
--

CREATE TABLE `tbl_jenis_operasi` (
  `id_jenis_operasi` int(3) NOT NULL,
  `nama_jenis_operasi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenjang_pendidikan`
--

CREATE TABLE `tbl_jenjang_pendidikan` (
  `id_jenjang_pendidikan` int(11) NOT NULL,
  `jenjang_pendidikan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jenjang_pendidikan`
--

INSERT INTO `tbl_jenjang_pendidikan` (`id_jenjang_pendidikan`, `jenjang_pendidikan`) VALUES
(1, 'SD'),
(2, 'SMP'),
(3, 'SMA'),
(4, 'D3'),
(5, 'D4'),
(6, 'S1'),
(7, 'S2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kamar`
--

CREATE TABLE `tbl_kamar` (
  `id_kamar` int(5) NOT NULL,
  `id_kategori_kamar` int(2) NOT NULL,
  `no_kamar` varchar(100) NOT NULL,
  `status` enum('0','1') DEFAULT '0' COMMENT '0 = Kosong, 1= Terisi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kamar`
--

INSERT INTO `tbl_kamar` (`id_kamar`, `id_kategori_kamar`, `no_kamar`, `status`) VALUES
(1, 1, '123', '0'),
(2, 1, '123', '1'),
(3, 1, '1234', NULL),
(4, 0, '321', '1'),
(5, 0, '321', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kartu_hutang`
--

CREATE TABLE `tbl_kartu_hutang` (
  `id` int(6) NOT NULL,
  `kode_supplier` varchar(15) NOT NULL,
  `kode_purchase` varchar(15) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tipe` enum('0','1') NOT NULL COMMENT '0 = Hutang, 1 = Bayar',
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kartu_hutang`
--

INSERT INTO `tbl_kartu_hutang` (`id`, `kode_supplier`, `kode_purchase`, `nominal`, `tipe`, `tanggal`) VALUES
(1, 'SUP1638087407', 'PO1638272515', 18000000, '0', '2021-11-30 11:43:09'),
(2, 'SUP1638869841', 'PO1638959928', 1950000, '0', '2021-12-08 10:41:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_barang`
--

CREATE TABLE `tbl_kategori_barang` (
  `id_kategori_barang` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori_barang`
--

INSERT INTO `tbl_kategori_barang` (`id_kategori_barang`, `nama_kategori`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'obat penenang', '2018-03-04 21:43:32', '2018-03-04 21:43:32'),
(2, 'obat tidur', '2018-03-04 21:43:32', '2018-03-04 21:43:32'),
(3, 'Perawatan', '2018-03-04 21:44:29', '2018-03-04 21:44:29'),
(4, 'Obat luar', '2021-10-11 12:33:19', '2021-10-11 12:33:19'),
(5, 'BMHP', '2021-11-09 10:45:35', '2021-11-29 08:03:09'),
(6, 'Injeksi dan Cairan', '2021-12-03 09:35:36', '2021-12-03 09:35:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_biaya`
--

CREATE TABLE `tbl_kategori_biaya` (
  `id_kategori_biaya` int(3) NOT NULL,
  `item` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kategori_biaya`
--

INSERT INTO `tbl_kategori_biaya` (`id_kategori_biaya`, `item`) VALUES
(1, 'Pembelian');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_kamar`
--

CREATE TABLE `tbl_kategori_kamar` (
  `id_kategori_kamar` int(2) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kategori_kamar`
--

INSERT INTO `tbl_kategori_kamar` (`id_kategori_kamar`, `nama`, `harga`) VALUES
(1, 'KAMAR KELAS 1', 350000),
(2, 'KAMAR KELAS 2', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_periksa_lab_radiologi`
--

CREATE TABLE `tbl_kategori_periksa_lab_radiologi` (
  `id_kategori` int(3) NOT NULL,
  `nama_kategori` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_tindakan`
--

CREATE TABLE `tbl_kategori_tindakan` (
  `id_kategori` int(3) NOT NULL,
  `item` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kategori_tindakan`
--

INSERT INTO `tbl_kategori_tindakan` (`id_kategori`, `item`) VALUES
(1, 'Umum'),
(3, 'Gigi'),
(5, 'Pendaftaran'),
(6, 'UGD'),
(7, 'Poliklinik'),
(8, 'Rawat Inap'),
(9, 'Jasa Operator OK');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_klinik`
--

CREATE TABLE `tbl_klinik` (
  `id_klinik` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_klinik`
--

INSERT INTO `tbl_klinik` (`id_klinik`, `nama`, `alamat`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'Klinik Mahottama', 'Jalan Raya Padonan No. 108, Tibubeneng, Kuta Utara, Badung, Bali 80363', '2018-02-26 22:25:21', '2021-09-23 02:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_komisi_dokter`
--

CREATE TABLE `tbl_komisi_dokter` (
  `id_komisi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_dokter` int(5) NOT NULL,
  `no_transaksi` varchar(20) NOT NULL,
  `komisi` int(11) NOT NULL,
  `type` enum('Pemeriksaan','Tindakan','Obat') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kontrol_kehamilan`
--

CREATE TABLE `tbl_kontrol_kehamilan` (
  `id_kontrol` int(5) NOT NULL,
  `no_periksa` varchar(30) NOT NULL,
  `no_rekam_medis` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `jamkeskmas` enum('0','1') NOT NULL DEFAULT '0',
  `cara_masuk` varchar(255) NOT NULL,
  `usia_klinis` varchar(100) NOT NULL,
  `trimeter_ke` double NOT NULL,
  `anamsesis` varchar(255) NOT NULL,
  `bb` double NOT NULL,
  `td` double NOT NULL,
  `lila` double NOT NULL,
  `status_gizi` varchar(100) NOT NULL,
  `tfu` double NOT NULL,
  `refleksi_patela` enum('0','1') NOT NULL DEFAULT '0',
  `djj` double NOT NULL,
  `kepala_thd` varchar(150) NOT NULL,
  `tbj` double NOT NULL,
  `presentasi` varchar(150) NOT NULL,
  `jumlah_janin` double NOT NULL,
  `status_imunisasi` varchar(150) NOT NULL,
  `injeksi_tt` enum('0','1') NOT NULL DEFAULT '0',
  `catatan_kia` enum('0','1') NOT NULL DEFAULT '0',
  `fe` varchar(15) NOT NULL COMMENT 'Kode Obat',
  `jml_fe` int(8) NOT NULL,
  `hb_dilakukan` enum('0','1') NOT NULL DEFAULT '0',
  `hb_hasil` double NOT NULL,
  `hb_anemia` enum('0','1') NOT NULL DEFAULT '0',
  `protein_uria` enum('0','1') NOT NULL DEFAULT '0',
  `gula_darah` varchar(100) NOT NULL,
  `sifilis` enum('0','1') NOT NULL DEFAULT '0',
  `hbsag` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lokasi_barang`
--

CREATE TABLE `tbl_lokasi_barang` (
  `id_lokasi_barang` int(11) NOT NULL,
  `lokasi` varchar(10) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lokasi_barang`
--

INSERT INTO `tbl_lokasi_barang` (`id_lokasi_barang`, `lokasi`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'rak no B4', '2019-11-14 16:34:19', '2019-11-14 10:36:39'),
(2, 'R5', '2019-11-20 12:48:56', '2019-11-20 12:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manufaktur`
--

CREATE TABLE `tbl_manufaktur` (
  `kode_manufaktur` varchar(4) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manufaktur_detail`
--

CREATE TABLE `tbl_manufaktur_detail` (
  `id_detail` int(5) NOT NULL,
  `kode_manufaktur` varchar(4) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_reference`
--

CREATE TABLE `tbl_master_reference` (
  `id` bigint(20) NOT NULL,
  `master_ref_code` varchar(30) NOT NULL,
  `master_ref_value` varchar(60) NOT NULL,
  `master_ref_name` varchar(60) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_master_reference`
--

INSERT INTO `tbl_master_reference` (`id`, `master_ref_code`, `master_ref_value`, `master_ref_name`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'ANAMNESI', 'pusing', 'Pusing', '2018-03-04 02:46:29', '2018-03-04 02:46:29'),
(2, 'ANAMNESI', 'batuk', 'Batuk 3 Kali', '2018-03-04 02:46:52', '2018-03-04 02:46:52'),
(3, 'ANAMNESI', 'demam2hari', 'Demam 2 Hari', '2018-03-04 02:52:53', '2018-03-04 02:52:53'),
(4, 'ANJURANOBAT', '3x1', '3 x 1', '2018-03-08 15:52:01', '2018-03-08 15:52:01'),
(5, 'ANJURANOBAT', '3x1/2', '3 x 1/2', '2018-03-08 15:52:01', '2018-03-08 15:52:01'),
(6, 'ALERGIOBAT', 'paracetamol', 'Paracetamol', '2018-03-09 16:19:36', '2018-03-09 16:19:36'),
(7, 'ALERGIOBAT', 'ultraflu', 'Ultra Flu', '2018-03-09 16:19:36', '2018-03-09 16:19:36'),
(11, 'ANAMNESI', 'hiv', 'hiv', '2018-03-23 17:22:19', '2018-03-23 17:22:19'),
(9, 'ANAMNESI', 'sakitkepala', 'sakit kepala', '2018-03-23 17:16:09', '2018-03-23 17:16:09'),
(10, 'ANAMNESI', 'pusing7keliling', 'pusing 7 keliling', '2018-03-23 17:16:09', '2018-03-23 17:16:09'),
(12, 'ANAMNESI', 'pilek', 'pilek', '2018-03-23 17:42:43', '2018-03-23 17:42:43'),
(13, 'DIAGNOSA', 'dbd', 'DBD', '2018-03-23 17:42:43', '2018-03-23 17:42:43'),
(14, 'DIAGNOSA', 'tyfus', 'Tyfus', '2018-03-23 17:42:43', '2018-03-23 17:42:43'),
(16, 'ALERGIOBAT', 'setop', 'setop', '2018-03-23 17:55:46', '2018-03-23 17:55:46'),
(17, 'ALERGIOBAT', 'marimas', 'marimas', '2018-03-23 17:55:46', '2018-03-23 17:55:46'),
(18, 'DIAGNOSA', 'sa', 'sa', '2018-03-23 17:55:46', '2018-03-23 17:55:46'),
(19, 'TINDAKAN', 'sasa', 'sasa', '2018-03-23 17:55:46', '2018-03-23 17:55:46'),
(20, 'ALERGIOBAT', 'sa', 'sa', '2018-03-23 18:05:38', '2018-03-23 18:05:38'),
(23, 'ANAMNESI', 'ds', 'ds', '2018-03-23 18:07:28', '2018-03-23 18:07:28'),
(24, 'ALERGIOBAT', 'ds', 'ds', '2018-03-23 18:07:28', '2018-03-23 18:07:28'),
(32, 'ALERGIOBAT', '123', '123', '2018-03-26 15:32:54', '2018-03-26 15:32:54'),
(26, 'TINDAKAN', 'ds', 'ds', '2018-03-23 18:07:28', '2021-10-01 03:10:08'),
(27, 'ANAMNESI', 'sa', 'sa', '2018-03-23 18:08:56', '2018-03-23 18:08:56'),
(28, 'TINDAKAN', 'sa', 'sa', '2018-03-23 18:08:56', '2018-03-23 18:08:56'),
(29, 'ANAMNESI', 'batuk3kali', 'Batuk 3 Kali', '2018-03-26 10:14:27', '2018-03-26 10:14:27'),
(31, 'DIAGNOSA', 'hiv', 'HIV', '2018-03-26 10:24:44', '2018-03-26 10:24:44'),
(33, 'ANAMNESI', 'muntah', 'muntah', '2018-03-27 10:50:51', '2018-03-27 10:50:51'),
(34, 'ALERGIOBAT', 'mixagrip', 'mixagrip', '2018-03-27 10:50:51', '2018-03-27 10:50:51'),
(35, 'DIAGNOSA', 'sakitkepala', 'sakit kepala', '2018-03-27 10:50:51', '2018-03-27 10:50:51'),
(36, 'TINDAKAN', 'suntikbiasa', 'Suntik biasa', '2018-03-27 10:50:51', '2018-03-27 10:50:51'),
(37, 'ANAMNESI', 'sakithati', 'sakit hati', '2018-03-28 11:26:31', '2018-03-28 11:26:31'),
(38, 'ALERGIOBAT', 'ss', 'ss', '2018-03-28 11:26:31', '2018-03-28 11:26:31'),
(39, 'DIAGNOSA', 'ss', 'ss', '2018-03-28 11:26:31', '2018-03-28 11:26:31'),
(40, 'DIAGNOSA', 'hamil', 'Hamil', '2018-03-28 20:37:20', '2018-03-28 20:37:20'),
(41, 'TINDAKAN', 'suntikdifteri', 'suntik difteri', '2018-03-29 14:35:00', '2018-03-29 14:35:00'),
(42, 'ANAMNESI', 'sakitgigi', 'sakit gigi', '2018-04-03 10:45:17', '2018-04-03 10:45:17'),
(43, 'ALERGIOBAT', 'amouxilin', 'amouxilin', '2018-04-03 10:45:17', '2018-04-03 10:45:17'),
(44, 'DIAGNOSA', 'flu', 'Flu', '2018-04-03 10:45:17', '2018-04-03 10:45:17'),
(45, 'DIAGNOSA', 'muntaber', 'muntaber', '2018-04-03 20:10:28', '2018-04-03 20:10:28'),
(46, 'TINDAKAN', 'plester', 'plester', '2018-04-03 20:10:28', '2018-04-03 20:10:28'),
(47, 'ALERGIOBAT', 'amoxicillin', 'amoxicillin', '2018-04-14 21:09:37', '2018-04-14 21:09:37'),
(48, 'DIAGNOSA', 'hipertensi', 'hipertensi', '2018-04-14 21:09:37', '2018-04-14 21:09:37'),
(49, 'DIAGNOSA', 'urti', 'URTI', '2018-04-14 21:09:37', '2018-04-14 21:09:37'),
(50, 'TINDAKAN', 'cekguladarah', 'Cek Gula Darah', '2018-04-14 21:09:37', '2018-04-14 21:09:37'),
(51, 'ALERGIOBAT', 'ctm', 'ctm', '2018-04-17 17:01:12', '2018-04-17 17:01:12'),
(52, 'TINDAKAN', 'jahit', 'jahit', '2018-04-17 17:01:12', '2018-04-17 17:01:12'),
(53, 'ANAMNESI', 'pu', 'Pu', '2018-04-17 17:05:35', '2018-04-17 17:05:35'),
(54, 'ANAMNESI', 'pusi', 'Pusi', '2018-04-17 17:08:04', '2018-04-17 17:08:04'),
(55, 'DIAGNOSA', 'demamberdarah', 'Demam Berdarah', '2018-04-26 21:33:08', '2018-04-26 21:33:08'),
(56, 'DIAGNOSA', 'mutaber', 'Mutaber', '2018-04-26 21:33:08', '2018-04-26 21:33:08'),
(57, 'ANAMNESI', 'batukpilekpanas3hari', 'batuk pilek panas 3 hari', '2018-05-05 14:17:26', '2018-05-05 14:17:26'),
(58, 'DIAGNOSA', 'ispa', 'ISPA', '2018-05-05 14:17:26', '2018-05-05 14:17:26'),
(59, 'TINDAKAN', 'asamurat', 'asam urat', '2018-05-05 14:17:26', '2018-05-05 14:17:26'),
(60, 'ANAMNESI', 'asdasd', 'asdasd', '2018-05-05 14:22:40', '2018-05-05 14:22:40'),
(61, 'ALERGIOBAT', 'sdfsdf', 'sdfsdf', '2018-05-05 14:22:40', '2018-05-05 14:22:40'),
(62, 'TINDAKAN', 'suntikrabies', 'Suntik Rabies', '2018-05-05 14:22:40', '2018-05-05 14:22:40'),
(63, 'ANAMNESI', 'mencret', 'mencret', '2018-05-10 11:13:27', '2018-05-10 11:13:27'),
(64, 'ALERGIOBAT', 'obatseranggga', 'obat seranggga', '2018-05-10 11:13:27', '2018-05-10 11:13:27'),
(65, 'DIAGNOSA', 'gastroenteritis', 'Gastro Enteritis', '2018-05-10 11:13:27', '2018-05-10 11:13:27'),
(66, 'DIAGNOSA', 'sakitpusing', 'Sakit Pusing', '2018-05-10 18:14:19', '2018-05-10 18:14:19'),
(67, 'TINDAKAN', 'diberiobat', 'diberi obat', '2018-05-10 18:14:19', '2018-05-10 18:14:19'),
(68, 'TINDAKAN', 'pemberianobat', 'Pemberian Obat', '2018-05-18 08:34:59', '2018-05-18 08:34:59'),
(69, 'ANAMNESI', 'panas', 'panas', '2018-05-18 23:09:12', '2018-05-18 23:09:12'),
(70, 'DIAGNOSA', 'sakitdemamberdarah', 'Sakit demam berdarah', '2018-05-18 23:09:12', '2018-05-18 23:09:12'),
(71, 'ANAMNESI', 'mual', 'Mual', '2019-12-06 10:35:11', '2019-12-06 10:35:11'),
(72, 'DIAGNOSA', 'baiksaja', 'baik saja', '2019-12-06 10:35:11', '2019-12-06 10:35:11'),
(73, 'TINDAKAN', '-', '-', '2019-12-06 10:35:11', '2019-12-06 10:35:11'),
(74, 'ANAMNESI', '-', '-', '2019-12-21 13:05:06', '2019-12-21 13:05:06'),
(75, 'ALERGIOBAT', '-', '-', '2019-12-21 13:05:06', '2019-12-21 13:05:06'),
(76, 'DIAGNOSA', '-', '-', '2019-12-21 13:05:06', '2019-12-21 13:05:06'),
(77, 'ALERGIOBAT', 'iya', 'iya', '2019-12-21 13:08:22', '2019-12-21 13:08:22'),
(78, 'DIAGNOSA', 'batukpilek', 'batuk pilek', '2019-12-21 13:08:22', '2019-12-21 13:08:22'),
(79, 'TINDAKAN', 'periksa', 'periksa', '2019-12-21 13:08:22', '2019-12-21 13:08:22'),
(80, 'DIAGNOSA', 'febris', 'febris', '2020-01-10 11:57:04', '2020-01-10 11:57:04'),
(81, 'TINDAKAN', 'injeksi', 'injeksi', '2020-01-10 11:57:04', '2020-01-10 11:57:04'),
(82, 'ALERGIOBAT', 'tidakada', 'tidak ada', '2020-01-15 05:56:02', '2020-01-15 05:56:02'),
(83, 'DIAGNOSA', 'dm', 'DM', '2020-01-15 05:56:02', '2020-01-15 05:56:02'),
(84, 'ANAMNESI', 'sakitperut', 'SAKIT PERUT', '2020-01-15 16:30:05', '2020-01-15 16:30:05'),
(85, 'ANAMNESI', 'mualmuntah', 'MUAL MUNTAH', '2020-01-16 13:53:44', '2020-01-16 13:53:44'),
(86, 'DIAGNOSA', 'gea', 'GEA', '2020-01-16 13:53:44', '2020-01-16 13:53:44'),
(87, 'TINDAKAN', 'injeksiranitidin', 'INJEKSI RANITIDIN', '2020-01-16 13:53:44', '2020-01-16 13:53:44'),
(88, 'ANAMNESI', 'sssssss', 'sssssss', '2020-01-21 18:55:51', '2020-01-21 18:55:51'),
(89, 'DIAGNOSA', 'sssss', 'sssss', '2020-01-21 18:55:51', '2020-01-21 18:55:51'),
(90, 'TINDAKAN', 'daffds', 'daffds', '2020-01-21 18:55:51', '2020-01-21 18:55:51'),
(91, 'ANAMNESI', 'dqwd', 'dqwd', '2020-01-21 18:59:39', '2020-01-21 18:59:39'),
(92, 'DIAGNOSA', 'dsffgsd', 'dsffgsd', '2020-01-21 18:59:39', '2020-01-21 18:59:39'),
(93, 'TINDAKAN', 'dfdaf', 'dfdaf', '2020-01-21 18:59:39', '2020-01-21 18:59:39'),
(94, 'ALERGIOBAT', 'betametason', 'betametason', '2020-06-30 09:00:58', '2020-06-30 09:00:58'),
(95, 'ANAMNESI', 'tes', 'tes', '2020-10-27 14:21:38', '2020-10-27 14:21:38'),
(96, 'DIAGNOSA', 'tes', 'tes', '2020-10-27 14:21:38', '2020-10-27 14:21:38'),
(97, 'ANAMNESI', 'pilekdengandahak', 'pilek dengan dahak', '2021-06-18 16:31:53', '2021-06-18 16:31:53'),
(98, 'ANAMNESI', 'anamesti', 'anamesti', '2021-06-23 09:39:58', '2021-06-23 09:39:58'),
(99, 'ALERGIOBAT', 'riawayat', 'riawayat', '2021-06-23 09:39:58', '2021-06-23 09:39:58'),
(100, 'DIAGNOSA', 'tidakkenapakenapa', 'tidak kenapa kenapa', '2021-06-23 09:39:58', '2021-06-23 09:39:58'),
(101, 'ANAMNESI', 'a', 'a', '2021-09-13 09:51:17', '2021-09-13 09:51:17'),
(102, 'ALERGIOBAT', 'asa', 'asa', '2021-09-13 09:51:17', '2021-09-13 09:51:17'),
(103, 'DIAGNOSA', 'asa', 'asa', '2021-09-13 09:51:17', '2021-09-13 09:51:17'),
(104, 'ANAMNESI', 'asa', 'asa', '2021-09-15 12:20:12', '2021-09-15 12:20:12'),
(105, 'ALERGIOBAT', 'asas', 'asas', '2021-09-15 12:20:12', '2021-09-15 12:20:12'),
(106, 'DIAGNOSA', 'assa', 'assa', '2021-09-15 12:20:12', '2021-09-15 12:20:12'),
(107, 'TINDAKAN', 'asas', 'asas', '2021-09-15 12:20:12', '2021-09-15 12:20:12'),
(108, 'ALERGIOBAT', 'sasamarimas', 'SASAmarimas', '2021-09-16 10:50:29', '2021-09-16 10:50:29'),
(109, 'ALERGIOBAT', 'azitromichin', 'azitromichin', '2021-09-22 05:07:51', '2021-09-22 05:07:51'),
(110, 'DIAGNOSA', 'abortus', 'abortus', '2021-09-22 05:07:51', '2021-09-22 05:07:51'),
(111, 'ANAMNESI', 'batukberdahak', 'Batuk berdahak', '2021-09-22 10:06:24', '2021-09-22 10:06:24'),
(112, 'DIAGNOSA', 'cough', 'Cough', '2021-09-22 10:06:24', '2021-09-22 10:06:24'),
(113, 'TINDAKAN', 'nebulizer', 'Nebulizer', '2021-09-22 10:06:24', '2021-09-22 10:06:24'),
(114, 'ANAMNESI', 'gigibawahkiribe;alakangsakit', 'GIGI BAWAH KIRI BE;ALAKANG SAKIT', '2021-09-29 18:42:57', '2021-09-29 18:42:57'),
(115, 'DIAGNOSA', 'gigi36pulpitis', 'GIGI 36 PULPITIS', '2021-09-29 18:42:57', '2021-09-29 18:42:57'),
(116, 'TINDAKAN', 'mumifikasigigi36(23.79)', 'MUMIFIKASI GIGI 36 (23.79)', '2021-09-29 18:42:57', '2021-09-29 18:42:57'),
(117, 'ANAMNESI', 'bintikmerahdiwajah', 'bintik merah di wajah', '2021-09-29 19:18:38', '2021-09-29 19:18:38'),
(118, 'ANAMNESI', 'telapaktangandantelapakkaki', 'telapak tangan dan telapak kaki', '2021-09-29 19:18:38', '2021-09-29 19:18:38'),
(119, 'ANAMNESI', 'nyeritelan', 'nyeri telan', '2021-09-29 19:18:38', '2021-09-29 19:18:38'),
(120, 'DIAGNOSA', 'hfmd', 'HFMD', '2021-09-29 19:18:38', '2021-09-29 19:18:38'),
(121, 'TINDAKAN', 'cefadroxil2x500mg\r\nparacetamolforte3x650mg\r\ncetirizin2x10mgk', 'cefadroxil 2x500mg\r\nparacetamol forte 3x650mg\r\ncetirizin 2x1', '2021-09-29 19:18:38', '2021-09-29 19:18:38'),
(122, 'DIAGNOSA', 'rfa', 'rfa', '2021-09-29 19:22:30', '2021-09-29 19:22:30'),
(123, 'DIAGNOSA', 'batukpanas', 'Batuk panas', '2021-10-02 22:19:04', '2021-10-02 22:19:04'),
(124, 'TINDAKAN', 'kbdepo3bulan', 'KB DEPO 3 BULAN', '2021-10-02 22:19:04', '2021-10-02 22:19:04'),
(125, 'DIAGNOSA', 'batukberdahak', 'Batuk berdahak', '2021-10-02 22:21:46', '2021-10-02 22:21:46'),
(126, 'TINDAKAN', 'jasamedis', 'JASA MEDIS', '2021-10-02 22:21:46', '2021-10-02 22:21:46'),
(127, 'ANAMNESI', 'testing002', 'Testing 002', '2021-10-02 22:34:45', '2021-10-02 22:34:45'),
(128, 'TINDAKAN', 'observasi@jam', 'OBSERVASI @JAM', '2021-10-02 22:34:45', '2021-10-02 22:34:45'),
(129, 'TINDAKAN', 'jm+injeksi', 'JM + INJEKSI', '2021-10-04 10:45:25', '2021-10-04 10:45:25'),
(130, 'ANAMNESI', 'demam', 'demam', '2021-10-04 15:21:24', '2021-10-04 15:21:24'),
(131, 'ANAMNESI', 'pilekdrkemarin', 'pilek dr kemarin', '2021-10-04 15:21:24', '2021-10-04 15:21:24'),
(132, 'ANAMNESI', 'cektensi', 'cek tensi', '2021-10-06 09:19:23', '2021-10-06 09:19:23'),
(133, 'TINDAKAN', 'checkup(batashrgbawah)', 'Check up (Batas Hrg Bawah)', '2021-10-06 09:19:23', '2021-10-06 09:19:23'),
(134, 'ANAMNESI', 'batukpilekpanas4hariyll', 'batuk pilek panas 4 hari yll', '2021-10-06 09:33:18', '2021-10-06 09:33:18'),
(135, 'ANAMNESI', 'pileksejak4hariyanglalu', 'pilek sejak 4 hari yang lalu', '2021-10-06 11:04:01', '2021-10-06 11:04:01'),
(136, 'DIAGNOSA', 'rhinitis', 'Rhinitis', '2021-10-06 11:04:01', '2021-10-06 11:04:01'),
(137, 'ANAMNESI', 'luka', 'Luka', '2021-10-06 13:17:40', '2021-10-06 13:17:40'),
(138, 'ANAMNESI', 'lecetkarenaterjatuh', 'lecet karena terjatuh', '2021-10-06 13:17:40', '2021-10-06 13:17:40'),
(139, 'DIAGNOSA', 'luka', 'luka', '2021-10-06 13:17:40', '2021-10-06 13:17:40'),
(140, 'DIAGNOSA', 'lecet', 'lecet', '2021-10-06 13:17:40', '2021-10-06 13:17:40'),
(141, 'ANAMNESI', 'mualdannyeriperut', 'mual dan nyeri perut', '2021-10-06 14:26:55', '2021-10-06 14:26:55'),
(142, 'DIAGNOSA', 'dispepsia', 'dispepsia', '2021-10-06 14:26:55', '2021-10-06 14:26:55'),
(143, 'ANAMNESI', 'gatalpadamatasebelahkiri', 'gatal pada mata sebelah kiri', '2021-10-08 16:22:38', '2021-10-08 16:22:38'),
(144, 'DIAGNOSA', 'konjungtivitis', 'Konjungtivitis', '2021-10-08 16:22:38', '2021-10-08 16:22:38'),
(145, 'ANAMNESI', 'badanterasameriang', 'badan terasa meriang', '2021-10-08 18:13:22', '2021-10-08 18:13:22'),
(146, 'TINDAKAN', 'eksterparasilipoma(b)', 'EKSTERPARASI LIPOMA (B)', '2021-10-08 18:13:22', '2021-10-08 18:13:22'),
(147, 'ANAMNESI', 'nyeriperutbawah', 'Nyeri perut bawah', '2021-10-11 11:29:41', '2021-10-11 11:29:41'),
(148, 'DIAGNOSA', 'isk', 'ISK', '2021-10-11 11:29:41', '2021-10-11 11:29:41'),
(149, 'ANAMNESI', 'matakabur', 'mata kabur', '2021-10-11 11:35:22', '2021-10-11 11:35:22'),
(150, 'DIAGNOSA', 'katarak', 'katarak', '2021-10-11 11:35:22', '2021-10-11 11:35:22'),
(151, 'DIAGNOSA', 'asamlambung', 'Asam lambung', '2021-10-11 12:01:25', '2021-10-11 12:01:25'),
(152, 'ANAMNESI', 'lukakbm', 'luka KBM', '2021-10-11 12:10:20', '2021-10-11 12:10:20'),
(153, 'DIAGNOSA', 'lukagesek', 'luka gesek', '2021-10-11 12:10:20', '2021-10-11 12:10:20'),
(154, 'ANAMNESI', 'bapil', 'bapil', '2021-10-11 12:24:29', '2021-10-11 12:24:29'),
(155, 'DIAGNOSA', 'headache', 'headache', '2021-10-11 12:27:14', '2021-10-11 12:27:14'),
(156, 'ANAMNESI', 'kontroltensi', 'kontrol tensi', '2021-10-11 12:32:26', '2021-10-11 12:32:26'),
(157, 'ANAMNESI', 'batukpilek', 'batuk pilek', '2021-10-11 12:33:37', '2021-10-11 12:33:37'),
(158, 'ANAMNESI', 'gatal', 'GATAL', '2021-10-11 12:44:18', '2021-10-11 12:44:18'),
(159, 'DIAGNOSA', 'gatal', 'GATAL', '2021-10-11 12:44:18', '2021-10-11 12:44:18'),
(160, 'DIAGNOSA', 'fever', 'fever', '2021-10-11 13:39:51', '2021-10-11 13:39:51'),
(161, 'ANAMNESI', 'mualdanmuntah', 'mual dan muntah', '2021-10-11 13:41:28', '2021-10-11 13:41:28'),
(162, 'TINDAKAN', 'gic(batashrgbawah)', 'GIC (Batas Hrg Bawah)', '2021-10-11 14:03:48', '2021-10-11 14:03:48'),
(163, 'DIAGNOSA', 'gigibelakangbengkak', 'Gigi belakang bengkak', '2021-10-11 14:06:23', '2021-10-11 14:06:23'),
(164, 'TINDAKAN', 'incisiabces', 'INCISI ABCES', '2021-10-11 14:06:23', '2021-10-11 14:06:23'),
(165, 'DIAGNOSA', 'migrain', 'migrain', '2021-10-11 14:31:21', '2021-10-11 14:31:21'),
(166, 'DIAGNOSA', 'cold', 'cold', '2021-10-11 14:45:01', '2021-10-11 14:45:01'),
(167, 'DIAGNOSA', 'diare', 'diare', '2021-10-11 14:57:31', '2021-10-11 14:57:31'),
(168, 'ANAMNESI', 'pilekmeriangdari2hariyanglalu', 'pilek meriang dari 2 hari yang lalu', '2021-10-11 15:16:52', '2021-10-11 15:16:52'),
(169, 'ANAMNESI', 'badannyeri', 'badan nyeri', '2021-10-11 16:36:43', '2021-10-11 16:36:43'),
(170, 'DIAGNOSA', 'myalgia', 'myalgia', '2021-10-11 16:36:43', '2021-10-11 16:36:43'),
(171, 'ANAMNESI', 'pilekdanpanas', 'pilek dan panas', '2021-10-11 16:38:56', '2021-10-11 16:38:56'),
(172, 'ANJURANOBAT', '1x1', '1 x 1', '2021-10-12 09:51:34', '2021-10-12 09:51:34'),
(173, 'ANJURANOBAT', '2x1', '2 x 1', '2021-10-12 09:51:53', '2021-10-12 09:51:53'),
(174, 'ANAMNESI', 'lukapadavagina', 'luka pada vagina', '2021-10-12 09:53:51', '2021-10-12 09:53:51'),
(175, 'DIAGNOSA', 'ulkusvaginasuspsyphilis', 'ulkus vagina susp syphilis', '2021-10-12 09:53:51', '2021-10-12 09:53:51'),
(176, 'ANJURANOBAT', '1x1/2', '1 x 1/2', '2021-10-12 09:55:59', '2021-10-12 09:55:59'),
(177, 'ANJURANOBAT', '2x1/2', '2 x 1/2', '2021-10-12 09:56:13', '2021-10-12 09:56:13'),
(178, 'ANAMNESI', 'radang', 'RADANG', '2021-10-12 15:16:20', '2021-10-12 15:16:20'),
(179, 'ANAMNESI', 'nyeridangbengkaktelingakanan', 'nyeri dang bengkak telinga kanan', '2021-10-13 09:07:53', '2021-10-13 09:07:53'),
(180, 'DIAGNOSA', 'perichondritisaurikulad', 'perichondritis aurikula D', '2021-10-13 09:07:53', '2021-10-13 09:07:53'),
(181, 'ANAMNESI', 'nyerikepala', 'nyeri kepala', '2021-10-13 09:12:07', '2021-10-13 09:12:07'),
(182, 'DIAGNOSA', 'ht+hiperurisemia+cephalgia', 'HT+Hiperurisemia+Cephalgia', '2021-10-13 09:12:07', '2021-10-13 09:12:07'),
(183, 'ANAMNESI', 'kontrolluka', 'kontrol luka', '2021-10-13 09:15:04', '2021-10-13 09:15:04'),
(184, 'DIAGNOSA', 'followupvulnusappertumcruris+multiplevulnusekskoriasi', 'Follow up vulnus appertum cruris + multiple vulnus ekskorias', '2021-10-13 09:15:04', '2021-10-13 09:15:04'),
(185, 'TINDAKAN', 'wt5-10cm', 'WT 5-10 CM', '2021-10-13 09:15:04', '2021-10-13 09:15:04'),
(186, 'DIAGNOSA', 'cephalgia', 'cephalgia', '2021-10-13 09:18:10', '2021-10-13 09:18:10'),
(187, 'DIAGNOSA', 'faringitisakut', 'Faringitis akut', '2021-10-13 09:27:34', '2021-10-13 09:27:34'),
(188, 'ANAMNESI', 'gatalhampirseluruhtubuh', 'gatal hampir seluruh tubuh', '2021-10-13 09:29:23', '2021-10-13 09:29:23'),
(189, 'DIAGNOSA', 'dermatitis', 'dermatitis', '2021-10-13 09:29:23', '2021-10-13 09:29:23'),
(190, 'ANAMNESI', 'nyerigigi', 'nyeri gigi', '2021-10-13 10:26:36', '2021-10-13 10:26:36'),
(191, 'TINDAKAN', 'explorasi', 'EXPLORASI', '2021-10-13 10:26:36', '2021-10-13 10:26:36'),
(192, 'DIAGNOSA', 'kariesgigi', 'karies gigi', '2021-10-13 11:09:45', '2021-10-13 11:09:45'),
(193, 'TINDAKAN', 'cabutgigi/komplikasi(batashrgbawah)', 'Cabut gigi/komplikasi (Batas Hrg Bawah)', '2021-10-13 11:09:45', '2021-10-13 11:09:45'),
(194, 'ANAMNESI', 'panaspilek', 'panas pilek', '2021-10-14 09:48:56', '2021-10-14 09:48:56'),
(195, 'DIAGNOSA', 'obs.febris', 'Obs. febris', '2021-10-14 09:48:56', '2021-10-14 09:48:56'),
(196, 'ANAMNESI', 'nyerisaatkencing', 'nyeri saat kencing', '2021-10-14 09:57:15', '2021-10-14 09:57:15'),
(197, 'DIAGNOSA', 'ht+ispa', 'HT + ISPA', '2021-10-14 10:35:35', '2021-10-14 10:35:35'),
(198, 'ANAMNESI', 'nyeridada', 'nyeri dada', '2021-10-14 10:37:05', '2021-10-14 10:37:05'),
(199, 'ANAMNESI', 'pusingberputar', 'pusing berputar', '2021-10-14 17:30:31', '2021-10-14 17:30:31'),
(200, 'DIAGNOSA', 'vertigo+ht', 'Vertigo + HT', '2021-10-14 17:30:31', '2021-10-14 17:30:31'),
(201, 'ANAMNESI', 'gataldikaki', 'gatal di kaki', '2021-10-14 17:58:49', '2021-10-14 17:58:49'),
(202, 'DIAGNOSA', 'dermatitisalergi', 'Dermatitis Alergi', '2021-10-14 17:58:49', '2021-10-14 17:58:49'),
(203, 'ANAMNESI', 'gataldibahu', 'gatal di bahu', '2021-10-14 18:30:56', '2021-10-14 18:30:56'),
(204, 'ANAMNESI', 'punggungdanlipatanpayudara', 'punggung dan lipatan payudara', '2021-10-14 18:30:56', '2021-10-14 18:30:56'),
(205, 'DIAGNOSA', 'candidiasis', 'candidiasis', '2021-10-14 18:30:56', '2021-10-14 18:30:56'),
(206, 'ANAMNESI', 'kontrol', 'kontrol', '2021-10-15 08:36:41', '2021-10-15 08:36:41'),
(207, 'DIAGNOSA', 'dmtii', 'DMT II', '2021-10-15 08:36:41', '2021-10-15 08:36:41'),
(208, 'ANAMNESI', 'nyeritertusukduritanaman', 'nyeri tertusuk duri tanaman', '2021-10-15 09:11:40', '2021-10-15 09:11:40'),
(209, 'DIAGNOSA', 'vulnusictum', 'vulnus ictum', '2021-10-15 09:11:40', '2021-10-15 09:11:40'),
(210, 'ANAMNESI', 'demamsejaktadfimalam', 'demam sejak tadfi malam', '2021-10-15 09:44:04', '2021-10-15 09:44:04'),
(211, 'ANAMNESI', 'sepertimules', 'seperti mules', '2021-10-16 08:58:08', '2021-10-16 08:58:08'),
(212, 'ANAMNESI', 'bablancar', 'BAB lancar', '2021-10-16 08:58:08', '2021-10-16 08:58:08'),
(213, 'ANAMNESI', 'kentut(+)', 'kentut (+)', '2021-10-16 08:58:08', '2021-10-16 08:58:08'),
(214, 'ANAMNESI', 'muntah(-)', 'muntah (-)', '2021-10-16 08:58:08', '2021-10-16 08:58:08'),
(215, 'DIAGNOSA', 'konstipasi', 'Konstipasi', '2021-10-16 08:58:08', '2021-10-16 08:58:08'),
(216, 'ANAMNESI', 'gatalpadaleher', 'gatal pada leher', '2021-10-16 09:00:19', '2021-10-16 09:00:19'),
(217, 'ANAMNESI', 'diaredarikemarin', 'diare dari kemarin', '2021-10-16 09:04:42', '2021-10-16 09:04:42'),
(218, 'ANAMNESI', 'muntahdarikemarin', 'muntah dari kemarin', '2021-10-16 09:04:42', '2021-10-16 09:04:42'),
(219, 'DIAGNOSA', 'gea+obs.vomiting', 'GEA + Obs. Vomiting', '2021-10-16 09:04:42', '2021-10-16 09:04:42'),
(220, 'ANAMNESI', 'kadangpusing', 'kadang pusing', '2021-10-16 10:49:22', '2021-10-16 10:49:22'),
(221, 'ANAMNESI', 'muntaharikemarin', 'muntah ari kemarin', '2021-10-16 16:56:28', '2021-10-16 16:56:28'),
(222, 'DIAGNOSA', 'dyspepsia', 'Dyspepsia', '2021-10-16 16:56:28', '2021-10-16 16:56:28'),
(223, 'ANAMNESI', 'pilekdari3hariyanglalu', 'pilek dari 3 hari yang lalu', '2021-10-16 16:59:33', '2021-10-16 16:59:33'),
(224, 'ANAMNESI', 'nyeripadapergelangantangan', 'nyeri pada pergelangan tangan', '2021-10-17 18:48:16', '2021-10-17 18:48:16'),
(225, 'ANAMNESI', 'batuksejakkemarin', 'batuk sejak kemarin', '2021-10-17 18:50:04', '2021-10-17 18:50:04'),
(226, 'ANAMNESI', 'pilekdandemamsejakkemarin', 'pilek dan demam sejak kemarin', '2021-10-17 18:52:13', '2021-10-17 18:52:13'),
(227, 'ANAMNESI', 'gataldanperihdidadakirisejak3hariyll', 'gatal dan perih di dada kiri sejak 3 hari yll', '2021-10-18 10:19:03', '2021-10-18 10:19:03'),
(228, 'ALERGIOBAT', 'amoxicillin\r\npiroxicam\r\nasammefenamat', 'amoxicillin\r\npiroxicam\r\nasam mefenamat', '2021-10-18 10:19:03', '2021-10-18 10:19:03'),
(229, 'DIAGNOSA', 'dermatitisvenenata', 'dermatitis venenata', '2021-10-18 10:19:03', '2021-10-18 10:19:03'),
(230, 'DIAGNOSA', 'dm+ht', 'DM + HT', '2021-10-18 10:24:08', '2021-10-18 10:24:08'),
(231, 'ANAMNESI', 'generalcheckup', 'general check up', '2021-10-18 10:28:30', '2021-10-18 10:28:30'),
(232, 'DIAGNOSA', 'hiperurisemia', 'hiperurisemia', '2021-10-18 10:28:30', '2021-10-18 10:28:30'),
(233, 'ANAMNESI', 'gatallengandanungkaisejak1bulanyll\r\n\r\nriwayatalergimiedantel', 'gatal lengan dan ungkai sejak 1 bulan yll\r\n\r\nriwayat alergi ', '2021-10-18 10:30:12', '2021-10-18 10:30:12'),
(234, 'ANAMNESI', 'postkll', 'post KLL', '2021-10-20 08:24:36', '2021-10-20 08:24:36'),
(235, 'ANAMNESI', 'lukadibagiankakikanan', 'luka di bagian kaki kanan', '2021-10-20 08:24:36', '2021-10-20 08:24:36'),
(236, 'ANAMNESI', 'kakikiei', 'kaki kiei', '2021-10-20 08:24:36', '2021-10-20 08:24:36'),
(237, 'ANAMNESI', 'lututdanlengan', 'lutut dan lengan', '2021-10-20 08:24:36', '2021-10-20 08:24:36'),
(238, 'DIAGNOSA', 'vulnuslaceration', 'Vulnus laceration', '2021-10-20 08:24:36', '2021-10-20 08:24:36'),
(239, 'ANAMNESI', 'muntah3x', 'muntah 3x', '2021-10-20 09:53:06', '2021-10-20 09:53:06'),
(240, 'DIAGNOSA', 'obs.vomiting', 'Obs. vomiting', '2021-10-20 09:53:06', '2021-10-20 09:53:06'),
(241, 'ANAMNESI', 'panasdaritadipagi', 'panas dari tadi pagi', '2021-10-20 09:54:42', '2021-10-20 09:54:42'),
(242, 'ANAMNESI', 'nyerihaid', 'nyeri haid', '2021-10-20 09:56:42', '2021-10-20 09:56:42'),
(243, 'DIAGNOSA', 'disminore', 'Disminore', '2021-10-20 09:56:42', '2021-10-20 09:56:42'),
(244, 'ANAMNESI', 'terkenacengkramananjingdidada', 'terkena cengkraman anjing di dada', '2021-10-20 16:03:39', '2021-10-20 16:03:39'),
(245, 'DIAGNOSA', 'vulnuslaceratione.cdigigitanjing', 'Vulnus laceration e.c digigit anjing', '2021-10-20 16:03:39', '2021-10-20 16:03:39'),
(246, 'ANAMNESI', 'gatalkuranglebih2bulan', 'gatal kurang lebih 2 bulan', '2021-10-20 17:09:53', '2021-10-20 17:09:53'),
(247, 'ANAMNESI', 'batukdanpilek', 'batuk dan pilek', '2021-10-20 17:15:34', '2021-10-20 17:15:34'),
(248, 'ANAMNESI', 'nyerisaathaid', 'nyeri saat haid', '2021-10-20 17:19:05', '2021-10-20 17:19:05'),
(249, 'ANAMNESI', 'mens2kalisebulan', 'mens 2 kali sebulan', '2021-10-20 17:19:05', '2021-10-20 17:19:05'),
(250, 'DIAGNOSA', 'menometroraghia', 'menometroraghia', '2021-10-20 17:19:05', '2021-10-20 17:19:05'),
(251, 'ANAMNESI', 'pilek4hari', 'pilek 4 hari', '2021-10-20 17:21:17', '2021-10-20 17:21:17'),
(252, 'ANAMNESI', 'gataldikaki1minggu', 'gatal di kaki 1 minggu', '2021-10-21 08:32:20', '2021-10-21 08:32:20'),
(253, 'ANAMNESI', 'sariawandari3hari', 'sariawan dari 3 hari', '2021-10-21 08:33:49', '2021-10-21 08:33:49'),
(254, 'DIAGNOSA', 'stomatitis', 'Stomatitis', '2021-10-21 08:33:49', '2021-10-21 08:33:49'),
(255, 'ANAMNESI', 'tangankirisakitdankadangkaku', 'tangan kiri sakit dan kadang kaku', '2021-10-21 08:35:22', '2021-10-21 08:35:22'),
(256, 'ANAMNESI', 'sepertitremor', 'seperti tremor', '2021-10-21 08:35:22', '2021-10-21 08:35:22'),
(257, 'DIAGNOSA', 'vulnusekskoriasiregiopedisdigitivsinistra', 'Vulnus ekskoriasi regio pedis digiti V sinistra', '2021-10-21 08:37:31', '2021-10-21 08:37:31'),
(258, 'ANAMNESI', 'lemasdanpusingdari3hari', 'lemas dan pusing dari 3 hari', '2021-10-21 09:00:55', '2021-10-21 09:00:55'),
(259, 'ANAMNESI', 'gataldilengandanpaha', 'gatal di lengan dan paha', '2021-10-21 09:28:37', '2021-10-21 09:28:37'),
(260, 'ANAMNESI', 'muntah3xdartadipagi', 'muntah 3x dar tadi pagi', '2021-10-21 15:52:35', '2021-10-21 15:52:35'),
(261, 'ANAMNESI', 'pilekgatalditenggorokan', 'pilek gatal di tenggorokan', '2021-10-21 16:40:11', '2021-10-21 16:40:11'),
(262, 'ANAMNESI', 'sakittenggorokan', 'sakit tenggorokan', '2021-10-21 16:47:35', '2021-10-21 16:47:35'),
(263, 'ANAMNESI', 'pasienininmemeriksakangigibawahyangsakit', 'pasien inin memeriksakan gigi bawah yang sakit', '2021-10-21 17:36:38', '2021-10-21 17:36:38'),
(264, 'DIAGNOSA', 'gigi46pulpitis', 'GIGI 46 PULPITIS', '2021-10-21 17:36:38', '2021-10-21 17:36:38'),
(265, 'ANAMNESI', 'bisuldipaha', 'bisul di paha', '2021-10-21 18:03:14', '2021-10-21 18:03:14'),
(266, 'DIAGNOSA', 'furunkel', 'Furunkel', '2021-10-21 18:03:14', '2021-10-21 18:03:14'),
(267, 'DIAGNOSA', 'febris+ispa', 'Febris + ISPA', '2021-10-21 18:23:19', '2021-10-21 18:23:19'),
(268, 'ANAMNESI', 'rawatluka', 'rawat luka', '2021-10-21 18:24:54', '2021-10-21 18:24:54'),
(269, 'DIAGNOSA', 'vulnusekskoriasi', 'Vulnus Ekskoriasi', '2021-10-21 18:24:54', '2021-10-21 18:24:54'),
(270, 'ANAMNESI', 'nyeriperutkananbawah', 'nyeri perut kanan bawah', '2021-10-21 18:26:24', '2021-10-21 18:26:24'),
(271, 'ANAMNESI', 'pasieninginmemeriksakangigiatasyangsakit', 'pasien ingin memeriksakan gigi atas yang sakit', '2021-10-21 18:36:16', '2021-10-21 18:36:16'),
(272, 'DIAGNOSA', 'gigi64pulpitis', 'GIGI 64 PULPITIS', '2021-10-21 18:36:16', '2021-10-21 18:36:16'),
(273, 'DIAGNOSA', 'rhinofaringitisakut', 'rhinofaringitis akut', '2021-10-22 09:49:40', '2021-10-22 09:49:40'),
(274, 'DIAGNOSA', 'followupvulnusappertumregiopedisdextra', 'Follow up vulnus appertum regio pedis dextra', '2021-10-22 09:57:24', '2021-10-22 09:57:24'),
(275, 'DIAGNOSA', 'obs.febrish1\r\nispa\r\ngea', 'Obs.Febris H1 \r\nISPA\r\nGEA', '2021-10-22 10:00:43', '2021-10-22 10:00:43'),
(276, 'ANAMNESI', 'diare', 'diare', '2021-10-22 10:03:15', '2021-10-22 10:03:15'),
(277, 'ANAMNESI', 'nyeriperut', 'nyeri perut', '2021-10-22 10:03:15', '2021-10-22 10:03:15'),
(278, 'DIAGNOSA', 'gea\r\ndyspepsia', 'GEA\r\nDyspepsia', '2021-10-22 10:03:15', '2021-10-22 10:03:15'),
(279, 'DIAGNOSA', 'followupvulnusappertumcruris+multiplevulnusekskorias', 'Follow up vulnus appertum cruris + multiple vulnus ekskorias', '2021-10-22 10:07:32', '2021-10-22 10:07:32'),
(280, 'DIAGNOSA', 'skabies', 'SKABIES', '2021-10-22 10:09:57', '2021-10-22 10:09:57'),
(281, 'ANAMNESI', 'matamerah', 'MATA MERAH', '2021-10-22 10:13:24', '2021-10-22 10:13:24'),
(282, 'DIAGNOSA', 'hordeolum', 'HORDEOLUM', '2021-10-22 10:13:24', '2021-10-22 10:13:24'),
(283, 'ANAMNESI', 'riwayatnyeriperut', 'riwayat nyeri perut', '2021-10-22 10:16:03', '2021-10-22 10:16:03'),
(284, 'ANAMNESI', 'saatinitidak', 'saat ini tidak', '2021-10-22 10:16:03', '2021-10-22 10:16:03'),
(285, 'DIAGNOSA', 'taa', 'taa', '2021-10-22 10:16:03', '2021-10-22 10:16:03'),
(286, 'DIAGNOSA', 'cephalgia\r\ndyspepsia', 'cephalgia\r\ndyspepsia', '2021-10-22 10:17:43', '2021-10-22 10:17:43'),
(287, 'DIAGNOSA', 'obs.febris+gea', 'Obs. Febris + GEA', '2021-10-23 08:41:09', '2021-10-23 08:41:09'),
(288, 'ANAMNESI', 'rawatlukaditelunjuktangankiri', 'rawat luka di telunjuk tangan kiri', '2021-10-23 08:43:44', '2021-10-23 08:43:44'),
(289, 'ANAMNESI', 'terkenagerinda3hariyanglalu', 'terkena gerinda 3 hari yang lalu', '2021-10-23 08:43:44', '2021-10-23 08:43:44'),
(290, 'DIAGNOSA', 'vulnuslaceratumdigitiiimanussinistra', 'Vulnus laceratum digiti II Manus sinistra', '2021-10-23 08:43:44', '2021-10-23 08:43:44'),
(291, 'DIAGNOSA', 'vertigp', 'Vertigp', '2021-10-23 08:53:59', '2021-10-23 08:53:59'),
(292, 'ANAMNESI', 'dahaksudahmulaikeluar', 'dahak sudah mulai keluar', '2021-10-23 09:43:14', '2021-10-23 09:43:14'),
(293, 'DIAGNOSA', 'susp.pnemonia', 'Susp. Pnemonia', '2021-10-23 09:43:14', '2021-10-23 09:43:14'),
(294, 'ANAMNESI', 'tangankesemutandannyeri', 'tangan kesemutan dan nyeri', '2021-10-23 10:30:52', '2021-10-23 10:30:52'),
(295, 'DIAGNOSA', 'tendosinovitis', 'Tendosinovitis', '2021-10-23 10:30:52', '2021-10-23 10:30:52'),
(296, 'DIAGNOSA', 'obs.febris+ispa', 'obs. Febris + ISPA', '2021-10-23 15:42:40', '2021-10-23 15:42:40'),
(297, 'ANAMNESI', 'kelopakmatabengkak', 'kelopak mata bengkak', '2021-10-23 15:45:11', '2021-10-23 15:45:11'),
(298, 'DIAGNOSA', 'kalazion', 'Kalazion', '2021-10-23 15:45:11', '2021-10-23 15:45:11'),
(299, 'ANAMNESI', 'kontroljahitankbimplan', 'kontrol jahitan KB Implan', '2021-10-23 15:47:24', '2021-10-23 15:47:24'),
(300, 'DIAGNOSA', 'kbimplant', 'KB Implant', '2021-10-23 15:47:24', '2021-10-23 15:47:24'),
(301, 'ANAMNESI', 'rawatlukadibagianpaha', 'rawat luka di bagian paha', '2021-10-23 16:34:12', '2021-10-23 16:34:12'),
(302, 'ALERGIOBAT', 'asammefenamat', 'asam mefenamat', '2021-10-23 16:34:12', '2021-10-23 16:34:12'),
(303, 'ANAMNESI', 'cekgula', 'cek gula', '2021-10-23 17:25:29', '2021-10-23 17:25:29'),
(304, 'DIAGNOSA', 'medicalcheckup', 'medical check up', '2021-10-23 17:25:29', '2021-10-23 17:25:29'),
(305, 'ANAMNESI', 'rawatlukaditelapakkaki', 'rawat luka di telapak kaki', '2021-10-23 17:28:49', '2021-10-23 17:28:49'),
(306, 'DIAGNOSA', 'combutioplantarpedis+dmtipeii', 'Combutio plantar pedis + DM tipe II', '2021-10-23 17:28:49', '2021-10-23 17:28:49'),
(307, 'ANAMNESI', 'rawatlukaditanganterkenakeramik', 'rawat luka di tangan terkena keramik', '2021-10-23 17:30:44', '2021-10-23 17:30:44'),
(308, 'DIAGNOSA', 'vulnuslaceratumrdigitiiiimanussinistra', 'Vulnus laceratum rdigiti III manus sinistra', '2021-10-23 17:30:44', '2021-10-23 17:30:44'),
(309, 'ANAMNESI', 'sakitgigikananbawah', 'sakit gigi kanan bawah', '2021-10-23 19:11:48', '2021-10-23 19:11:48'),
(310, 'DIAGNOSA', 'pulpitis85', 'pulpitis 85', '2021-10-23 19:11:48', '2021-10-23 19:11:48'),
(311, 'DIAGNOSA', '26pulpitis', '26 pulpitis', '2021-10-23 19:18:53', '2021-10-23 19:18:53'),
(312, 'DIAGNOSA', 'periodontitismarginaliskronis26goyangdrajat227', 'periodontitis marginalis kronis 26 goyang drajat 2 27', '2021-10-23 19:21:44', '2021-10-23 19:21:44'),
(313, 'DIAGNOSA', 'nekrosapulpa25', 'nekrosa pulpa 25', '2021-10-23 19:24:18', '2021-10-23 19:24:18'),
(314, 'ANAMNESI', 'gigisakitberlubang', 'gigi sakit berlubang', '2021-10-23 19:30:32', '2021-10-23 19:30:32'),
(315, 'DIAGNOSA', 'nekrosapulpa', 'nekrosa pulpa', '2021-10-23 19:30:32', '2021-10-23 19:30:32'),
(316, 'ANAMNESI', 'gigikananbawahsakit', 'gigi kanan bawah sakit', '2021-10-23 19:32:43', '2021-10-23 19:32:43'),
(317, 'ANAMNESI', 'gigikiribelakangbawah', 'gigi kiri belakang bawah', '2021-10-23 19:34:52', '2021-10-23 19:34:52'),
(318, 'DIAGNOSA', 'nekrosapulpa26', 'nekrosa pulpa 26', '2021-10-23 19:34:52', '2021-10-23 19:34:52'),
(319, 'ANAMNESI', 'gigidepanbawahberlubang', 'gigi depan bawah berlubang', '2021-10-23 19:37:16', '2021-10-23 19:37:16'),
(320, 'DIAGNOSA', 'pulpitisreversible31', 'pulpitis reversible 31', '2021-10-23 19:37:16', '2021-10-23 19:37:16'),
(321, 'ANAMNESI', 'gigikiribelakangsakit', 'gigi kiri belakang sakit', '2021-10-23 19:38:53', '2021-10-23 19:38:53'),
(322, 'ANAMNESI', 'gigikiriatassakitdanberlubang', 'gigi kiri atas sakit dan berlubang', '2021-10-23 19:42:38', '2021-10-23 19:42:38'),
(323, 'DIAGNOSA', 'pulpitisireversible26', 'pulpitis ireversible 26', '2021-10-23 19:42:38', '2021-10-23 19:42:38'),
(324, 'DIAGNOSA', 'nekrosapulpa45', 'nekrosa pulpa 45', '2021-10-23 19:44:38', '2021-10-23 19:44:38'),
(325, 'ANAMNESI', 'cekgigi', 'cek gigi', '2021-10-23 19:50:06', '2021-10-23 19:50:06'),
(326, 'DIAGNOSA', 'gmk', 'GMK', '2021-10-23 19:50:06', '2021-10-23 19:50:06'),
(327, 'TINDAKAN', 'eksterparasiclavus(k)', 'EKSTERPARASI CLAVUS (K)', '2021-10-23 19:50:06', '2021-10-23 19:50:06'),
(328, 'ANAMNESI', 'gusigigikananbelakangatasbengkak', 'gusi gigi kanan belakang atas bengkak', '2021-10-23 19:53:49', '2021-10-23 19:53:49'),
(329, 'ANAMNESI', 'gigidepangoyang', 'gigi depan goyang', '2021-10-23 19:57:55', '2021-10-23 19:57:55'),
(330, 'DIAGNOSA', 'goyangfisiologis5161', 'goyang fisiologis 51 61', '2021-10-23 19:57:55', '2021-10-23 19:57:55'),
(331, 'DIAGNOSA', 'absesperiapikalis', 'abses periapikalis', '2021-10-23 20:00:49', '2021-10-23 20:00:49'),
(332, 'ANAMNESI', 'gigibelakangatasbengkak', 'gigi belakang atas bengkak', '2021-10-23 20:03:31', '2021-10-23 20:03:31'),
(333, 'ANAMNESI', 'sudah4hari', 'sudah 4 hari', '2021-10-25 09:10:14', '2021-10-25 09:10:14'),
(334, 'DIAGNOSA', 'ispa+suspectcovid19', 'ISPA + Suspect Covid 19', '2021-10-25 09:10:14', '2021-10-25 09:10:14'),
(335, 'ANAMNESI', 'babbedarah', 'BAB bedarah', '2021-10-25 09:52:32', '2021-10-25 09:52:32'),
(336, 'DIAGNOSA', 'haemoroid', 'Haemoroid', '2021-10-25 09:52:32', '2021-10-25 09:52:32'),
(337, 'ANAMNESI', 'sesak', 'sesak', '2021-10-25 15:20:39', '2021-10-25 15:20:39'),
(338, 'DIAGNOSA', 'ispa+asthma', 'ISPA + Asthma', '2021-10-25 15:20:39', '2021-10-25 15:20:39'),
(339, 'ANAMNESI', 'terkenatrolidikepala', 'terkena troli di kepala', '2021-10-25 15:22:30', '2021-10-25 15:22:30'),
(340, 'ANAMNESI', 'lukarobek', 'luka robek', '2021-10-25 15:22:30', '2021-10-25 15:22:30'),
(341, 'DIAGNOSA', 'vulnuslaceratumregiofrontalis', 'Vulnus Laceratum Regio frontalis', '2021-10-25 15:22:30', '2021-10-25 15:22:30'),
(342, 'ANAMNESI', 'pegal', 'pegal', '2021-10-25 15:37:14', '2021-10-25 15:37:14'),
(343, 'ANAMNESI', 'gataldikepala', 'gatal di kepala', '2021-10-25 15:37:14', '2021-10-25 15:37:14'),
(344, 'DIAGNOSA', 'vertigo+dispesia', 'vertigo + Dispesia', '2021-10-25 16:15:52', '2021-10-25 16:15:52'),
(345, 'ANAMNESI', 'sariawandari2hari', 'sariawan dari 2 hari', '2021-10-25 16:31:30', '2021-10-25 16:31:30'),
(346, 'DIAGNOSA', 'vertigo', 'Vertigo', '2021-10-25 16:32:51', '2021-10-25 16:32:51'),
(347, 'DIAGNOSA', 'gangrenpulpa', 'gangren pulpa', '2021-10-25 18:05:25', '2021-10-25 18:05:25'),
(348, 'DIAGNOSA', 'gangrenradix', 'gangren radix', '2021-10-25 18:40:47', '2021-10-25 18:40:47'),
(349, 'ANAMNESI', 'badanlemas', 'badan lemas', '2021-10-25 19:51:59', '2021-10-25 19:51:59'),
(350, 'ANAMNESI', 'sesak3hari', 'sesak 3 hari', '2021-10-25 19:55:29', '2021-10-25 19:55:29'),
(351, 'ANAMNESI', 'gataldiketiakkanan', 'gatal di ketiak kanan', '2021-10-25 19:57:05', '2021-10-25 19:57:05'),
(352, 'ANAMNESI', 'batukdahak', 'batuk dahak', '2021-10-26 17:01:32', '2021-10-26 17:01:32'),
(353, 'ANAMNESI', 'gataltenggorokan', 'gatal tenggorokan', '2021-10-26 17:01:32', '2021-10-26 17:01:32'),
(354, 'DIAGNOSA', 'sups.absesperiapikalis', 'sups. abses periapikalis', '2021-10-26 17:50:01', '2021-10-26 17:50:01'),
(355, 'ANAMNESI', 'gigidepanbelumtumbuh', 'gigi depan belum tumbuh', '2021-10-26 18:00:38', '2021-10-26 18:00:38'),
(356, 'DIAGNOSA', 'sups.impaksigigiante', 'sups. impaksi gigi ante', '2021-10-26 18:00:38', '2021-10-26 18:00:38'),
(357, 'DIAGNOSA', 'pulpire26', 'pulp ire 26', '2021-10-26 18:18:51', '2021-10-26 18:18:51'),
(358, 'ANAMNESI', 'gigidepanbawahgoyang', 'gigi depan bawah goyang', '2021-10-26 18:41:54', '2021-10-26 18:41:54'),
(359, 'DIAGNOSA', 'goyangfisiologis71', 'goyang fisiologis 71', '2021-10-26 18:41:54', '2021-10-26 18:41:54'),
(360, 'ANAMNESI', 'sakittenggorokandari2hari', 'sakit tenggorokan dari 2 hari', '2021-10-27 17:28:11', '2021-10-27 17:28:11'),
(361, 'DIAGNOSA', 'obs.febrish+2', 'Obs. Febris H+2', '2021-10-27 17:28:11', '2021-10-27 17:28:11'),
(362, 'ANAMNESI', 'pilekdanbersin\"', 'pilek dan bersin\"', '2021-10-27 17:31:01', '2021-10-27 17:31:01'),
(363, 'ANAMNESI', 'rawatlukadikepala', 'rawat luka di kepala', '2021-10-27 17:32:28', '2021-10-27 17:32:28'),
(364, 'DIAGNOSA', 'vulnuslaceratumregiofrontalisdextra', 'Vulnus laceratum regio frontalis dextra', '2021-10-27 17:32:28', '2021-10-27 17:32:28'),
(365, 'ANAMNESI', 'muntah2x', 'muntah 2x', '2021-10-27 17:34:48', '2021-10-27 17:34:48'),
(366, 'ANAMNESI', 'rawatlukabisuldipahakiri', 'rawat luka bisul di paha kiri', '2021-10-28 09:35:07', '2021-10-28 09:35:07'),
(367, 'DIAGNOSA', 'absescutaneusregiofemurs', 'Abses cutaneus regio femur s', '2021-10-28 09:35:07', '2021-10-28 09:35:07'),
(368, 'DIAGNOSA', 'diarecairakut', 'DIare Cair Akut', '2021-10-28 09:37:34', '2021-10-28 09:37:34'),
(369, 'DIAGNOSA', 'f.akut', 'F. AKut', '2021-10-28 09:39:51', '2021-10-28 09:39:51'),
(370, 'DIAGNOSA', 'ht', 'HT', '2021-10-28 16:55:13', '2021-10-28 16:55:13'),
(371, 'ANAMNESI', 'tanganseringpegaldilengandansendijari', 'tangan sering pegal di lengan dan sendi jari', '2021-10-28 16:58:22', '2021-10-28 16:58:22'),
(372, 'DIAGNOSA', 'hiperurecemiadanhiperkolesterolemia', 'Hiperurecemia dan hiperkolesterolemia', '2021-10-28 16:58:22', '2021-10-28 16:58:22'),
(373, 'ANAMNESI', 'nyeriuluhati', 'nyeri ulu hati', '2021-10-28 17:20:26', '2021-10-28 17:20:26'),
(374, 'ANAMNESI', 'pusingsejaktadisore', 'pusing sejak tadi sore', '2021-10-28 17:44:50', '2021-10-28 17:44:50'),
(375, 'DIAGNOSA', 'cephalgia+obs.vomiting', 'Cephalgia + Obs. Vomiting', '2021-10-28 17:44:50', '2021-10-28 17:44:50'),
(376, 'ANAMNESI', 'konsultasimens', 'konsultasi mens', '2021-10-28 18:15:59', '2021-10-28 18:15:59'),
(377, 'ANAMNESI', 'lukadidagu', 'luka di dagu', '2021-10-28 18:56:00', '2021-10-28 18:56:00'),
(378, 'DIAGNOSA', 'v.laceratumregiomentalis', 'V. laceratum regio mentalis', '2021-10-28 18:56:00', '2021-10-28 18:56:00'),
(379, 'ANAMNESI', 'gataldilengandanperut', 'gatal di lengan dan perut', '2021-10-28 18:57:40', '2021-10-28 18:57:40'),
(380, 'ANAMNESI', 'melenting\"', 'melenting\"', '2021-10-28 18:57:40', '2021-10-28 18:57:40'),
(381, 'ANAMNESI', 'sudahmylaikering', 'sudah mylai kering', '2021-10-28 18:57:40', '2021-10-28 18:57:40'),
(382, 'DIAGNOSA', 'herpessimplex', 'Herpes Simplex', '2021-10-28 18:57:40', '2021-10-28 18:57:40'),
(383, 'ANAMNESI', 'nyeriperutkananatas', 'nyeri perut kanan atas', '2021-10-28 19:41:39', '2021-10-28 19:41:39'),
(384, 'ANAMNESI', 'kadangterasaperih', 'kadang terasa perih', '2021-10-28 19:41:39', '2021-10-28 19:41:39'),
(385, 'ANAMNESI', 'bisulditangan', 'bisul di tangan', '2021-10-28 19:58:19', '2021-10-28 19:58:19'),
(386, 'ANAMNESI', 'diaresejakkemarin2-3xsehari', 'diare sejak kemarin 2-3x sehari', '2021-10-29 15:27:50', '2021-10-29 15:27:50'),
(387, 'ANAMNESI', 'adaampas', 'ada ampas', '2021-10-29 15:27:50', '2021-10-29 15:27:50'),
(388, 'ANAMNESI', 'lendir-', 'lendir-', '2021-10-29 15:27:50', '2021-10-29 15:27:50'),
(389, 'ANAMNESI', 'muntah-', 'muntah -', '2021-10-29 15:27:50', '2021-10-29 15:27:50'),
(390, 'ANAMNESI', 'demam-', 'demam -', '2021-10-29 15:27:50', '2021-10-29 15:27:50'),
(391, 'ANAMNESI', 'gatal-gatalhilangtimbulsudahlama', 'gatal- gatal hilang timbul sudah lama', '2021-10-29 15:47:38', '2021-10-29 15:47:38'),
(392, 'DIAGNOSA', 'dermatitisatopik', 'dermatitis atopik', '2021-10-29 15:47:38', '2021-10-29 15:47:38'),
(393, 'DIAGNOSA', 'v.laseratum', 'v. laseratum', '2021-10-29 17:26:38', '2021-10-29 17:26:38'),
(394, 'ANAMNESI', 'kontrollukaposthecting', 'kontrol luka post hecting', '2021-10-29 17:28:18', '2021-10-29 17:28:18'),
(395, 'DIAGNOSA', 'vappertum', 'v appertum', '2021-10-29 17:28:18', '2021-10-29 17:28:18'),
(396, 'TINDAKAN', 'wt<5cm', 'WT <  5 CM', '2021-10-29 17:28:18', '2021-10-29 17:28:18'),
(397, 'DIAGNOSA', 'f.upnailavulsidigiti2manusdextra', 'f. up nail avulsi digiti 2 manus dextra', '2021-10-29 18:10:28', '2021-10-29 18:10:28'),
(398, 'ANAMNESI', 'pusingtidakenakbadan', 'pusing tidak enak badan', '2021-10-29 19:22:19', '2021-10-29 19:22:19'),
(399, 'DIAGNOSA', 'fatigue', 'fatigue', '2021-10-29 19:22:19', '2021-10-29 19:22:19'),
(400, 'ANAMNESI', 'kontrollukapostopsc', 'kontrol luka post op sc', '2021-10-29 19:57:05', '2021-10-29 19:57:05'),
(401, 'ANAMNESI', 'lepassimpuljahitansc', 'lepas simpul jahitan sc', '2021-10-29 19:57:05', '2021-10-29 19:57:05'),
(402, 'DIAGNOSA', 'postopsc', 'post op sc', '2021-10-29 19:57:05', '2021-10-29 19:57:05'),
(403, 'ANAMNESI', 'sejak2harilalu.nyeritelan-', 'sejak 2 hari lalu. nyeri telan -', '2021-10-29 19:59:03', '2021-10-29 19:59:03'),
(404, 'DIAGNOSA', 'commoncold', 'commoncold', '2021-10-29 19:59:03', '2021-10-29 19:59:03'),
(405, 'ANAMNESI', 'pilekmeriang', 'pilek meriang', '2021-10-29 20:01:50', '2021-10-29 20:01:50'),
(406, 'DIAGNOSA', 'pulpitis16', 'pulpitis 16', '2021-10-30 18:48:51', '2021-10-30 18:48:51'),
(407, 'TINDAKAN', 'checkup(batashrgatas)', 'Check up (Batas Hrg Atas)', '2021-10-30 18:48:51', '2021-10-30 18:48:51'),
(408, 'ANAMNESI', 'gigikeribelakangsakit', 'gigi keri belakang sakit', '2021-10-30 19:05:46', '2021-10-30 19:05:46'),
(409, 'DIAGNOSA', '28nekrosapulpa', '28 nekrosa pulpa', '2021-10-30 19:05:46', '2021-10-30 19:05:46'),
(410, 'ANAMNESI', 'gigibawahdepansisasedikitdangoyangtetapibelumtanggal', 'gigi bawah depan sisa sedikit dan goyang tetapi belum tangga', '2021-10-30 19:20:43', '2021-10-30 19:20:43'),
(411, 'DIAGNOSA', 'persistensi73gr', 'persistensi 73 GR', '2021-10-30 19:20:43', '2021-10-30 19:20:43'),
(412, 'TINDAKAN', 'cabutgigi/topikalanastesi(batashrgatas)', 'Cabut gigi/topikal anastesi (Batas Hrg Atas)', '2021-10-30 19:20:43', '2021-10-30 19:20:43'),
(413, 'DIAGNOSA', 'keputihan', 'Keputihan', '2021-11-01 15:16:48', '2021-11-01 15:16:48'),
(414, 'DIAGNOSA', 'followupabsescutaneousfemursinistra', 'follow up abses cutaneous femur sinistra', '2021-11-01 17:25:42', '2021-11-01 17:25:42'),
(415, 'ANAMNESI', 'kontrollukapostterkenanpecahankaca2hariyll', 'kontrol luka post terkenan pecahan kaca 2 hari yll', '2021-11-01 17:27:30', '2021-11-01 17:27:30'),
(416, 'DIAGNOSA', 'followupvulnusappertumplantarpedisdextra', 'Follow up vulnus appertum plantar pedis dextra', '2021-11-01 17:27:30', '2021-11-01 17:27:30'),
(417, 'DIAGNOSA', 'followupvulnusappr.frontalis', 'Follow up vulnus app r. frontalis', '2021-11-01 17:29:25', '2021-11-01 17:29:25'),
(418, 'TINDAKAN', 'bukajaritan@simpul', 'Buka jaritan @ simpul', '2021-11-01 17:29:25', '2021-11-01 17:29:25'),
(419, 'DIAGNOSA', 'followuppostekstraksikuku', 'follow up post ekstraksi kuku', '2021-11-01 17:53:36', '2021-11-01 17:53:36'),
(420, 'ANAMNESI', 'pasiendatangdengankeluhansakitgigikananbawah', 'pasien datang dengan keluhan sakit gigi kanan bawah', '2021-11-01 18:20:31', '2021-11-01 18:20:31'),
(421, 'DIAGNOSA', 'gigi47pulpitis', 'GIGI 47 PULPITIS', '2021-11-01 18:20:31', '2021-11-01 18:20:31'),
(422, 'TINDAKAN', 'emergencytreatment/openbur(batashrgbawah)', 'Emergency Treatment/Open Bur (Batas Hrg Bawah)', '2021-11-01 18:20:31', '2021-11-01 18:20:31'),
(423, 'ANAMNESI', 'nyerimenelan', 'nyeri menelan', '2021-11-01 18:22:43', '2021-11-01 18:22:43'),
(424, 'DIAGNOSA', 'faringitisakut\r\nlimfadenitis', 'Faringitis akut\r\nLimfadenitis', '2021-11-01 18:22:43', '2021-11-01 18:22:43'),
(425, 'DIAGNOSA', 'followupvulnusappr.mentalis\r\ndermatitiskontakiritan', 'follow up vulnus app r. mentalis \r\ndermatitis kontak iritan', '2021-11-01 19:31:37', '2021-11-01 19:31:37'),
(426, 'ANAMNESI', 'kontrollukaposttersandungbatu1mingguyll(kontrolke3)', 'kontrol luka post tersandung batu 1 minggu yll (kontrol ke 3', '2021-11-01 19:33:32', '2021-11-01 19:33:32'),
(427, 'DIAGNOSA', 'pyogenicgranulomaectraumaminor', 'pyogenic granuloma ec trauma minor', '2021-11-01 19:33:32', '2021-11-01 19:33:32'),
(428, 'ANAMNESI', 'demamdanpusingsejaktadipagi', 'demam dan pusing sejak tadi pagi', '2021-11-02 15:46:43', '2021-11-02 15:46:43'),
(429, 'DIAGNOSA', 'obs.febrish1\r\ncephalgia', 'obs. febris H1\r\ncephalgia', '2021-11-02 15:46:43', '2021-11-02 15:46:43'),
(430, 'ANAMNESI', 'pileksejakkemarin', 'pilek sejak kemarin', '2021-11-02 17:49:11', '2021-11-02 17:49:11'),
(431, 'ANAMNESI', 'batukjarang', 'batuk jarang', '2021-11-02 17:49:11', '2021-11-02 17:49:11'),
(432, 'DIAGNOSA', 'periodontitismarginalisakut55', 'periodontitis marginalis akut 55', '2021-11-02 17:54:12', '2021-11-02 17:54:12'),
(433, 'DIAGNOSA', '54', '54', '2021-11-02 17:54:12', '2021-11-02 17:54:12'),
(434, 'DIAGNOSA', 'gingivitisakut84', 'gingivitis akut 84', '2021-11-02 17:56:15', '2021-11-02 17:56:15'),
(435, 'TINDAKAN', 'treatmentmumifikasi(batashrgbawah)', 'Treatment Mumifikasi (Batas Hrg Bawah)', '2021-11-02 18:13:51', '2021-11-02 18:13:51'),
(436, 'ANAMNESI', 'hidungkeluarcairanberbausejak5hariyll', 'hidung keluar cairan berbau sejak 5 hari yll', '2021-11-02 18:58:51', '2021-11-02 18:58:51'),
(437, 'ANAMNESI', 'diawalipilek7hryll', 'diawali pilek 7 hr yll', '2021-11-02 18:58:51', '2021-11-02 18:58:51'),
(438, 'DIAGNOSA', 'susp.sinusitismaksilarisddpolipnasal', 'Susp. Sinusitis maksilaris dd Polip nasal', '2021-11-02 18:58:51', '2021-11-02 18:58:51'),
(439, 'ANAMNESI', 'keluarcacingkremidarianusketikatidur', 'keluar cacing kremi dari anus ketika tidur', '2021-11-02 19:01:24', '2021-11-02 19:01:24'),
(440, 'DIAGNOSA', 'enterobiasis', 'Enterobiasis', '2021-11-02 19:01:24', '2021-11-02 19:01:24'),
(441, 'ANAMNESI', 'benjolandibuahzakarkanansejak8bulanyll', 'benjolan di buah zakar kanan sejak 8 bulan yll', '2021-11-02 19:03:00', '2021-11-02 19:03:00'),
(442, 'DIAGNOSA', 'herniascrotalis', 'hernia scrotalis', '2021-11-02 19:03:00', '2021-11-02 19:03:00'),
(443, 'ANAMNESI', 'nyeritelansejaktadipagi', 'nyeri telan sejak tadi pagi', '2021-11-02 19:05:03', '2021-11-02 19:05:03'),
(444, 'ANAMNESI', 'benjolandivaginasejak>10thnyll', 'benjolan di vagina sejak >10 thn yll', '2021-11-02 19:12:14', '2021-11-02 19:12:14'),
(445, 'DIAGNOSA', 'prolapseuteri\r\nispa\r\nht', 'prolapse uteri\r\nispa\r\nht', '2021-11-02 19:12:14', '2021-11-02 19:12:14'),
(446, 'DIAGNOSA', 'followupvulnusappertumr.labialis+vulnusekskoriasidorsumpedis', 'follow up vulnus appertum r. labialis + vulnus ekskoriasi do', '2021-11-02 19:14:46', '2021-11-02 19:14:46'),
(447, 'ANAMNESI', 'kakubagianjempoltangankanan', 'kaku bagian jempol tangan kanan', '2021-11-02 19:16:13', '2021-11-02 19:16:13'),
(448, 'DIAGNOSA', 'triggerthumb', 'trigger thumb', '2021-11-02 19:16:13', '2021-11-02 19:16:13'),
(449, 'ANAMNESI', 'kontrolgula', 'kontrol gula', '2021-11-02 19:19:48', '2021-11-02 19:19:48'),
(450, 'ANAMNESI', 'kesemutan', 'kesemutan', '2021-11-02 19:19:48', '2021-11-02 19:19:48'),
(451, 'DIAGNOSA', 'cephalgia\r\ndmtii\r\nneuropathydiabetic', 'cephalgia\r\nDMT II\r\nNeuropathy diabetic', '2021-11-02 19:19:48', '2021-11-02 19:19:48'),
(452, 'ANAMNESI', 'mualsejaktadipagi', 'mual sejak tadi pagi', '2021-11-02 19:22:02', '2021-11-02 19:22:02'),
(453, 'ANAMNESI', 'rasapanasdiuluhati', 'rasa panas di ulu hati', '2021-11-04 15:45:00', '2021-11-04 15:45:00'),
(454, 'DIAGNOSA', 'dyspepsiaddgerd', 'dyspepsia dd GERD', '2021-11-04 15:45:00', '2021-11-04 15:45:00'),
(455, 'ANAMNESI', 'nyeripadaanusdanbabdarah', 'nyeri pada anus dan bab darah', '2021-11-04 15:46:39', '2021-11-04 15:46:39'),
(456, 'ALERGIOBAT', '--', '--', '2021-11-04 15:46:39', '2021-11-04 15:46:39'),
(457, 'DIAGNOSA', 'hemorrhoidgr1ddfisuraani', 'hemorrhoid gr 1 dd fisura ani', '2021-11-04 15:46:39', '2021-11-04 15:46:39'),
(458, 'ANAMNESI', 'nafsumakanmenurun', 'nafsu makan menurun', '2021-11-04 15:50:52', '2021-11-04 15:50:52'),
(459, 'DIAGNOSA', 'dyspepsia\r\nibs', 'dyspepsia\r\nIBS', '2021-11-04 15:50:52', '2021-11-04 15:50:52'),
(460, 'DIAGNOSA', 'followupcutaneousabsesregiofemursinistra', 'Follow up cutaneous abses regio femur sinistra', '2021-11-04 16:02:50', '2021-11-04 16:02:50'),
(461, 'ANAMNESI', 'nyeripadaleherbagianbelakang', 'nyeri pada leher bagian belakang', '2021-11-04 16:04:21', '2021-11-04 16:04:21'),
(462, 'DIAGNOSA', 'cervicalmusclespasm', 'cervical muscle spasm', '2021-11-04 16:04:21', '2021-11-04 16:04:21'),
(463, 'ANAMNESI', 'bengkakgusi', 'bengkak gusi', '2021-11-04 16:09:12', '2021-11-04 16:09:12'),
(464, 'DIAGNOSA', 'absesbucal48gp', 'abses bucal 48 GP', '2021-11-04 16:09:12', '2021-11-04 16:09:12'),
(465, 'ANAMNESI', 'mualsejak3hariyll', 'mual sejak 3 hari yll', '2021-11-04 16:15:04', '2021-11-04 16:15:04'),
(466, 'DIAGNOSA', 'dyspepsia\r\nispa', 'dyspepsia\r\nispa', '2021-11-04 16:15:04', '2021-11-04 16:15:04'),
(467, 'DIAGNOSA', 'followupvulnusappr.mentalis', 'follow up vulnus app r. mentalis', '2021-11-04 16:16:59', '2021-11-04 16:16:59'),
(468, 'ANAMNESI', 'batukpileksejakkemarin', 'batuk pilek sejak kemarin', '2021-11-04 16:24:29', '2021-11-04 16:24:29'),
(469, 'ANAMNESI', 'perutkembung', 'perut kembung', '2021-11-04 16:26:14', '2021-11-04 16:26:14'),
(470, 'DIAGNOSA', 'dyspepsia\r\ncephalgia', 'dyspepsia\r\ncephalgia', '2021-11-04 16:26:14', '2021-11-04 16:26:14'),
(471, 'ANAMNESI', 'telapakkakikanantertusukpaku', 'telapak kaki kanan tertusuk paku', '2021-11-04 16:31:58', '2021-11-04 16:31:58'),
(472, 'DIAGNOSA', 'vulnusiktumplantaspedisdextra', 'vulnus iktum plantas pedis dextra', '2021-11-04 16:31:58', '2021-11-04 16:31:58'),
(473, 'ANAMNESI', 'nyeritelingakiri', 'nyeri telinga kiri', '2021-11-04 16:33:57', '2021-11-04 16:33:57'),
(474, 'ANAMNESI', 'keluarcairan', 'keluar cairan', '2021-11-04 16:33:57', '2021-11-04 16:33:57'),
(475, 'DIAGNOSA', 'asoma\r\nht', 'AS OMA\r\nHT', '2021-11-04 16:33:57', '2021-11-04 16:33:57'),
(476, 'ANAMNESI', 'gataldiperut', 'gatal di perut', '2021-11-04 16:35:19', '2021-11-04 16:35:19'),
(477, 'ANAMNESI', 'konsultasitensi', 'KONSULTASI TENSI', '2021-11-04 16:43:41', '2021-11-04 16:43:41'),
(478, 'ANAMNESI', 'konsultasi', 'konsultasi', '2021-11-04 16:46:30', '2021-11-04 16:46:30'),
(479, 'ANAMNESI', 'demamsejak2hryll', 'demam sejak 2 hr yll', '2021-11-04 17:59:08', '2021-11-04 17:59:08'),
(480, 'DIAGNOSA', 'obsfebris\r\nrfa', 'Obs Febris\r\nRFA', '2021-11-04 17:59:08', '2021-11-04 17:59:08'),
(481, 'DIAGNOSA', 'followupvulnusappertumr.labialis+vulnusekskoriasidorsumpedis', 'follow up vulnus appertum r. labialis + vulnus ekskoriasi do', '2021-11-04 18:00:54', '2021-11-04 18:00:54'),
(482, 'ANAMNESI', 'babcair', 'bab cair', '2021-11-04 18:20:02', '2021-11-04 18:20:02'),
(483, 'ANAMNESI', 'perutmulas', 'perut mulas', '2021-11-04 18:20:02', '2021-11-04 18:20:02'),
(484, 'ANAMNESI', 'pasienininmemeriksakangigibawahyanggoyang', 'pasien inin memeriksakan gigi bawah yang goyang', '2021-11-04 18:35:56', '2021-11-04 18:35:56'),
(485, 'DIAGNOSA', '47periodontitis', '47 periodontitis', '2021-11-04 18:35:56', '2021-11-04 18:35:56'),
(486, 'TINDAKAN', 'cabutgigi/lokalanastesi(batashrgbawah)', 'Cabut gigi/Lokal anastesi (Batas Hrg Bawah)', '2021-11-04 18:35:56', '2021-11-04 18:35:56'),
(487, 'DIAGNOSA', 'impaksi38', 'impaksi 38', '2021-11-04 18:37:13', '2021-11-04 18:37:13');
INSERT INTO `tbl_master_reference` (`id`, `master_ref_code`, `master_ref_value`, `master_ref_name`, `dtm_crt`, `dtm_upd`) VALUES
(488, 'ANAMNESI', 'pasieninginmemeriksakangigibawahyangngilu', 'pasien ingin memeriksakan gigi bawah yang ngilu', '2021-11-04 18:55:23', '2021-11-04 18:55:23'),
(489, 'DIAGNOSA', 'gigi35pulpitis', 'gigi 35 pulpitis', '2021-11-04 18:55:23', '2021-11-04 18:55:23'),
(490, 'ANAMNESI', 'lukadijaritelunjukkananposttersetrumlistriktadipagi', 'luka di jari telunjuk kanan post tersetrumlistrik tadi pagi', '2021-11-04 18:59:53', '2021-11-04 18:59:53'),
(491, 'DIAGNOSA', 'combustioeclistrik', 'combustio ec listrik', '2021-11-04 18:59:53', '2021-11-04 18:59:53'),
(492, 'ANAMNESI', 'cottonbudtertinggalditelingakanan', 'cotton bud tertinggal di telinga kanan', '2021-11-04 19:01:45', '2021-11-04 19:01:45'),
(493, 'DIAGNOSA', 'adcorpusalienum', 'AD corpus alienum', '2021-11-04 19:01:45', '2021-11-04 19:01:45'),
(494, 'ANAMNESI', 'panasbatukpileksejakkemarin', 'panas batuk pilek sejak kemarin', '2021-11-04 19:04:02', '2021-11-04 19:04:02'),
(495, 'ANAMNESI', 'meriang', 'meriang', '2021-11-05 16:14:21', '2021-11-05 16:14:21'),
(496, 'ANAMNESI', 'sakitbagianleher', 'sakit bagian leher', '2021-11-05 16:14:21', '2021-11-05 16:14:21'),
(497, 'DIAGNOSA', 'dispepsia+ht', 'DIspepsia + HT', '2021-11-05 16:14:21', '2021-11-05 16:14:21'),
(498, 'ANAMNESI', 'kontrollukabisul', 'kontrol luka bisul', '2021-11-05 16:35:50', '2021-11-05 16:35:50'),
(499, 'DIAGNOSA', 'absescutaneusfemursinistra', 'abses cutaneus femur sinistra', '2021-11-05 16:35:50', '2021-11-05 16:35:50'),
(500, 'ANAMNESI', 'gatalditangan', 'gatal di tangan', '2021-11-05 16:52:00', '2021-11-05 16:52:00'),
(501, 'ANAMNESI', 'perut', 'perut', '2021-11-05 16:52:00', '2021-11-05 16:52:00'),
(502, 'ANAMNESI', 'danleher', 'dan leher', '2021-11-05 16:52:00', '2021-11-05 16:52:00'),
(503, 'DIAGNOSA', 'dermatitisalrgi', 'Dermatitis Alrgi', '2021-11-05 16:52:00', '2021-11-05 16:52:00'),
(504, 'ANAMNESI', 'konsultasikelaminbengkak', 'konsultasi kelamin bengkak', '2021-11-05 16:55:16', '2021-11-05 16:55:16'),
(505, 'DIAGNOSA', 'balanitis', 'Balanitis', '2021-11-05 16:55:16', '2021-11-05 16:55:16'),
(506, 'ANAMNESI', 'diaredanmuntah', 'diare dan muntah', '2021-11-05 18:01:52', '2021-11-05 18:01:52'),
(507, 'ANAMNESI', 'bengkakdidarehleher', 'bengkak di dareh leher', '2021-11-05 18:51:35', '2021-11-05 18:51:35'),
(508, 'ANAMNESI', 'riwayatdemamdangosokgigiterkenagusi', 'riwayat demam dan gosok gigi terkena gusi', '2021-11-05 18:51:35', '2021-11-05 18:51:35'),
(509, 'DIAGNOSA', 'gingivitissusp.limfadenitis', 'Gingivitis susp. Limfadenitis', '2021-11-05 18:51:35', '2021-11-05 18:51:35'),
(510, 'ANAMNESI', 'sakitperutbagianbawah', 'sakit perut bagian bawah', '2021-11-05 19:05:37', '2021-11-05 19:05:37'),
(511, 'DIAGNOSA', 'obs.vomiting+gea', 'Obs. Vomiting  + GEA', '2021-11-06 15:57:58', '2021-11-06 15:57:58'),
(512, 'ANAMNESI', 'gataldidaerahkepala2minggu', 'gatal di daerah kepala 2 minggu', '2021-11-06 16:41:38', '2021-11-06 16:41:38'),
(513, 'DIAGNOSA', 'dermatitisseboroik', 'Dermatitis Seboroik', '2021-11-06 16:41:38', '2021-11-06 16:41:38'),
(514, 'ANAMNESI', 'jaritangansakit', 'jari tangan sakit', '2021-11-06 17:03:32', '2021-11-06 17:03:32'),
(515, 'ANAMNESI', 'followuplukakesetrumlistrik', 'follow up luka kesetrum listrik', '2021-11-06 18:09:03', '2021-11-06 18:09:03'),
(516, 'DIAGNOSA', 'followupcombutioec.kesetrumlistrik', 'Follow Up Combutio ec. kesetrum listrik', '2021-11-06 18:09:03', '2021-11-06 18:09:03'),
(517, 'DIAGNOSA', 'np45', 'np 45', '2021-11-06 18:09:11', '2021-11-06 18:09:11'),
(518, 'ANAMNESI', 'gataldilengan', 'gatal di lengan', '2021-11-06 18:32:21', '2021-11-06 18:32:21'),
(519, 'ANAMNESI', 'kaki', 'kaki', '2021-11-06 18:32:21', '2021-11-06 18:32:21'),
(520, 'ANAMNESI', 'lutut', 'lutut', '2021-11-06 18:32:21', '2021-11-06 18:32:21'),
(521, 'DIAGNOSA', 'tineacorporis', 'Tinea Corporis', '2021-11-06 18:32:21', '2021-11-06 18:32:21'),
(522, 'DIAGNOSA', '75', '75', '2021-11-06 18:37:28', '2021-11-06 18:37:28'),
(523, 'TINDAKAN', 'openbur(batashrgatas)', 'Open Bur (Batas Hrg Atas)', '2021-11-06 18:37:28', '2021-11-06 18:37:28'),
(524, 'ANAMNESI', 'gusikiribengkak', 'gusi kiri bengkak', '2021-11-06 18:48:14', '2021-11-06 18:48:14'),
(525, 'ANAMNESI', 'nafasgrok\"', 'nafas grok\"', '2021-11-06 18:50:11', '2021-11-06 18:50:11'),
(526, 'DIAGNOSA', 'np28', 'np 28', '2021-11-06 18:51:01', '2021-11-06 18:51:01'),
(527, 'DIAGNOSA', 'vulnuslaceratumregiopedissinistra', 'Vulnus laceratum regio pedis sinistra', '2021-11-06 18:57:15', '2021-11-06 18:57:15'),
(528, 'DIAGNOSA', 'nekrosapulpitis47', 'nekrosa pulpitis 47', '2021-11-06 19:01:43', '2021-11-06 19:01:43'),
(529, 'DIAGNOSA', 'pulpitis21', 'pulpitis 21', '2021-11-06 19:48:58', '2021-11-06 19:48:58'),
(530, 'ANAMNESI', 'gigibawahdepangoyangsisasedikit', 'gigi bawah depan goyang sisa sedikit', '2021-11-06 19:51:19', '2021-11-06 19:51:19'),
(531, 'DIAGNOSA', 'persistensi54', 'persistensi 54', '2021-11-06 19:51:19', '2021-11-06 19:51:19'),
(532, 'DIAGNOSA', '84', '84', '2021-11-06 19:51:19', '2021-11-06 19:51:19'),
(533, 'DIAGNOSA', 'np85', 'np 85', '2021-11-06 19:54:15', '2021-11-06 19:54:15'),
(534, 'TINDAKAN', 'treatmentmumifikasi(batashrgatas)', 'Treatment Mumifikasi (Batas Hrg Atas)', '2021-11-06 19:54:15', '2021-11-06 19:54:15'),
(535, 'ANAMNESI', 'robekpadajarikaki', 'robek pada jari kaki', '2021-11-06 20:01:31', '2021-11-06 20:01:31'),
(536, 'DIAGNOSA', 'v.laceratumdigitiiiipedissinistra', 'V. laceratum digiti III pedis sinistra', '2021-11-06 20:01:31', '2021-11-06 20:01:31'),
(537, 'TINDAKAN', 'hecting1-5', 'Hecting 1-5', '2021-11-06 20:01:31', '2021-11-06 20:01:31'),
(538, 'ANAMNESI', 'periksagigi', 'periksa gigi', '2021-11-06 20:02:11', '2021-11-06 20:02:11'),
(539, 'DIAGNOSA', 'pulpitis48', 'pulpitis 48', '2021-11-06 20:02:11', '2021-11-06 20:02:11'),
(540, 'ANAMNESI', 'panas\r\nbatuk\r\npilek\r\nradang', 'panas\r\nbatuk\r\npilek\r\nradang', '2021-11-07 10:55:43', '2021-11-07 10:55:43'),
(541, 'ANAMNESI', 'tekukterasasakitsampailengan', 'tekuk terasa sakit sampai lengan', '2021-11-07 11:01:54', '2021-11-07 11:01:54'),
(542, 'DIAGNOSA', 'rematik', 'rematik', '2021-11-07 11:01:54', '2021-11-07 11:01:54'),
(543, 'ANAMNESI', 'panassejakkemarin', 'panas sejak kemarin', '2021-11-07 11:06:35', '2021-11-07 11:06:35'),
(544, 'ANAMNESI', 'kencingbernanah', 'kencing bernanah', '2021-11-07 11:13:01', '2021-11-07 11:13:01'),
(545, 'ANAMNESI', 'pusing\r\npilek\r\nbatuk\r\nrematik', 'pusing\r\npilek\r\nbatuk\r\nrematik', '2021-11-07 11:17:09', '2021-11-07 11:17:09'),
(546, 'ANAMNESI', 'keemutan', 'keemutan', '2021-11-07 12:45:19', '2021-11-07 12:45:19'),
(547, 'ANAMNESI', 'nyeripadabagianibujarikaki', 'nyeri pada bagian ibu jari kaki', '2021-11-07 17:54:34', '2021-11-07 17:54:34'),
(548, 'ANAMNESI', 'pilekdansakittenggorokan', 'pilek dan sakit tenggorokan', '2021-11-07 17:56:49', '2021-11-07 17:56:49'),
(549, 'ANAMNESI', 'diarekuranglebih5kali', 'diare kurang lebih 5 kali', '2021-11-07 18:02:00', '2021-11-07 18:02:00'),
(550, 'ANAMNESI', 'kontrolkuka', 'kontrol kuka', '2021-11-07 18:04:13', '2021-11-07 18:04:13'),
(551, 'ALERGIOBAT', 'piroxicam', 'piroxicam', '2021-11-07 19:06:25', '2021-11-07 19:06:25'),
(552, 'ANAMNESI', 'kontroltensidanbatuk', 'kontrol tensi dan batuk', '2021-11-07 19:56:41', '2021-11-07 19:56:41'),
(553, 'ANAMNESI', 'nyeripadatengkuk', 'NYERI PADA TENGKUK', '2021-11-08 08:13:44', '2021-11-08 08:13:44'),
(554, 'ANAMNESI', 'kontrolhamil', 'kontrol hamil', '2021-11-08 17:31:03', '2021-11-08 17:31:03'),
(555, 'DIAGNOSA', 'pregnancy', 'pregnancy', '2021-11-08 17:31:03', '2021-11-08 17:31:03'),
(556, 'ANAMNESI', 'suntikkb', 'SUNTIK KB', '2021-11-08 17:37:20', '2021-11-08 17:37:20'),
(557, 'DIAGNOSA', 'konselingkb', 'KONSELING KB', '2021-11-08 17:37:20', '2021-11-08 17:37:20'),
(558, 'TINDAKAN', 'kb1bulan', 'KB 1 BULAN', '2021-11-08 17:37:20', '2021-11-08 17:37:20'),
(559, 'ANAMNESI', 'gataldanlukadikepala', 'gatal dan luka di kepala', '2021-11-08 18:00:06', '2021-11-08 18:00:06'),
(560, 'DIAGNOSA', 'dermatitisseboroikddtineacapitiskerion-inflammatory', 'dermatitis seboroik dd tinea capitis kerion - inflammatory', '2021-11-08 18:00:06', '2021-11-08 18:00:06'),
(561, 'DIAGNOSA', 'followupcombutioec.listrik', 'Follow Up Combutio ec. listrik', '2021-11-08 18:01:10', '2021-11-08 18:01:10'),
(562, 'ANAMNESI', 'kontrollukatangandantungkaibawahkanansejak3hariyll', 'kontrol luka tangan dan tungkai bawah kanan sejak 3 hari yll', '2021-11-08 18:23:56', '2021-11-08 18:23:56'),
(563, 'DIAGNOSA', 'multiplevulnusekskoriasi', 'multiple vulnus ekskoriasi', '2021-11-08 18:23:56', '2021-11-08 18:23:56'),
(564, 'ANAMNESI', 'diaredanmual', 'diare dan mual', '2021-11-09 07:06:28', '2021-11-09 07:06:28'),
(565, 'DIAGNOSA', 'suntikvit', 'suntik vit', '2021-11-09 15:25:47', '2021-11-09 15:25:47'),
(566, 'ANAMNESI', 'gataldipunggungdanpayudara', 'gatal di punggung dan payudara', '2021-11-09 15:26:49', '2021-11-09 15:26:49'),
(567, 'ALERGIOBAT', 'amoxicilindancefixime', 'amoxicilin dan cefixime', '2021-11-09 15:26:49', '2021-11-09 15:26:49'),
(568, 'ANAMNESI', 'tangankenagergaji', 'tangan kena gergaji', '2021-11-09 15:39:09', '2021-11-09 15:39:09'),
(569, 'ANAMNESI', 'benjolandilehermasihada', 'benjolan di leher masih ada', '2021-11-09 17:30:14', '2021-11-09 17:30:14'),
(570, 'ANAMNESI', 'sudahmendingan', 'sudah mendingan', '2021-11-09 17:30:14', '2021-11-09 17:30:14'),
(571, 'ANAMNESI', 'gatalditangandanperut', 'gatal di tangan dan perut', '2021-11-09 18:46:19', '2021-11-09 18:46:19'),
(572, 'DIAGNOSA', 'herpeszooster', 'Herpes zooster', '2021-11-09 18:46:19', '2021-11-09 18:46:19'),
(573, 'ANAMNESI', 'lukadikakiterkenatusuksate', 'luka di kaki terkena tusuk sate', '2021-11-09 18:47:42', '2021-11-09 18:47:42'),
(574, 'ANAMNESI', 'diaredaritadipagi', 'diare dari tadi pagi', '2021-11-09 19:01:22', '2021-11-09 19:01:22'),
(575, 'ANAMNESI', 'pusingdanbatuk', 'pusing dan batuk', '2021-11-10 14:56:14', '2021-11-10 14:56:14'),
(576, 'ALERGIOBAT', 'cephalosporin', 'cephalosporin', '2021-11-10 16:40:28', '2021-11-10 16:40:28'),
(577, 'DIAGNOSA', 'dermatitisecinsectbite', 'dermatitis ec insect bite', '2021-11-10 16:40:28', '2021-11-10 16:40:28'),
(578, 'ANAMNESI', 'bintik2dileherdanpunggung', 'bintik2 di leher dan punggung', '2021-11-10 16:42:23', '2021-11-10 16:42:23'),
(579, 'DIAGNOSA', 'miliaria', 'miliaria', '2021-11-10 16:42:23', '2021-11-10 16:42:23'),
(580, 'DIAGNOSA', 'tineacapitiskerion-inflammatory', 'tinea capitis kerion - inflammatory', '2021-11-10 19:30:01', '2021-11-10 19:30:01'),
(581, 'ANAMNESI', 'gataldilengankiri', 'gatal di lengan kiri', '2021-11-10 19:31:15', '2021-11-10 19:31:15'),
(582, 'DIAGNOSA', 'ispa\r\ndermatitisvenenata', 'ispa\r\ndermatitis venenata', '2021-11-10 19:31:15', '2021-11-10 19:31:15'),
(583, 'ANAMNESI', 'bengkakdannyeritangankiripostdigigitkalajengking', 'bengkak dan nyeri tangan kiri post digigit kalajengking', '2021-11-10 19:33:56', '2021-11-10 19:33:56'),
(584, 'DIAGNOSA', 'insectbite', 'insect bite', '2021-11-10 19:33:56', '2021-11-10 19:33:56'),
(585, 'ANAMNESI', 'lemassejaktadipagi', 'lemas sejak tadi pagi', '2021-11-10 19:43:42', '2021-11-10 19:43:42'),
(586, 'DIAGNOSA', 'gastritis', 'GASTRITIS', '2021-11-11 07:05:40', '2021-11-11 07:05:40'),
(587, 'ANAMNESI', 'gatal-gatalalergi', 'gatal-gatal alergi', '2021-11-11 10:10:15', '2021-11-11 10:10:15'),
(588, 'ANAMNESI', 'matamerahtertusukranting', 'mata merah tertusuk ranting', '2021-11-11 10:20:01', '2021-11-11 10:20:01'),
(589, 'ANAMNESI', 'lemes', 'lemes', '2021-11-11 11:35:02', '2021-11-11 11:35:02'),
(590, 'DIAGNOSA', 'faringitis.', 'faringitis.', '2021-11-11 11:50:24', '2021-11-11 11:50:24'),
(591, 'ANAMNESI', 'anyang-anyangan', 'anyang-anyangan', '2021-11-11 16:50:33', '2021-11-11 16:50:33'),
(592, 'ANAMNESI', 'gataldileher', 'gatal di leher', '2021-11-11 16:52:01', '2021-11-11 16:52:01'),
(593, 'ALERGIOBAT', 'tridakada', 'tridak ada', '2021-11-11 16:52:01', '2021-11-11 16:52:01'),
(594, 'DIAGNOSA', 'deermatitiskontakalergi', 'Deermatitis Kontak Alergi', '2021-11-11 16:52:01', '2021-11-11 16:52:01'),
(595, 'DIAGNOSA', 'cephalgia+ispa', 'Cephalgia + ISPA', '2021-11-11 17:05:36', '2021-11-11 17:05:36'),
(596, 'DIAGNOSA', 'combutiodigitiiimanussinistra', 'Combutio digiti II manus sinistra', '2021-11-11 17:18:11', '2021-11-11 17:18:11'),
(597, 'ANAMNESI', 'batukmuntah', 'batuk muntah', '2021-11-11 17:51:53', '2021-11-11 17:51:53'),
(598, 'DIAGNOSA', 'ispa+dispepsia', 'ISPA + Dispepsia', '2021-11-11 17:51:53', '2021-11-11 17:51:53'),
(599, 'DIAGNOSA', 'vulnusappertumregiocrurisdextra', 'vulnus appertum regio cruris dextra', '2021-11-11 18:26:01', '2021-11-11 18:26:01'),
(600, 'ANAMNESI', 'sariawan2minggu', 'sariawan 2 minggu', '2021-11-11 19:07:37', '2021-11-11 19:07:37'),
(601, 'ANAMNESI', 'sakitpinggang', 'sakit pinggang', '2021-11-12 09:52:21', '2021-11-12 09:52:21'),
(602, 'ANAMNESI', 'batuk2minggu', 'batuk 2 minggu', '2021-11-13 17:30:33', '2021-11-13 17:30:33'),
(603, 'ANAMNESI', 'jarisakit', 'jari sakit', '2021-11-13 18:30:59', '2021-11-13 18:30:59'),
(604, 'DIAGNOSA', 'hiperurecemia?', 'Hiperurecemia?', '2021-11-13 18:30:59', '2021-11-13 18:30:59'),
(605, 'DIAGNOSA', 'gerd', 'GERD', '2021-11-13 18:42:35', '2021-11-13 18:42:35'),
(606, 'ANAMNESI', 'pilekpanas', 'pilek panas', '2021-11-13 19:08:58', '2021-11-13 19:08:58'),
(607, 'ANAMNESI', 'gatalditubuh', 'gatal di tubuh', '2021-11-13 19:55:44', '2021-11-13 19:55:44'),
(608, 'DIAGNOSA', 'reaksialergi', 'Reaksi Alergi', '2021-11-13 19:55:44', '2021-11-13 19:55:44'),
(609, 'DIAGNOSA', 'gigi36resesi', 'GIGI 36 RESESI', '2021-11-13 20:05:18', '2021-11-13 20:05:18'),
(610, 'DIAGNOSA', '37pulpitis', '37 PULPITIS', '2021-11-13 20:05:18', '2021-11-13 20:05:18'),
(611, 'DIAGNOSA', 'gmkra+rb', 'GMK RA+RB', '2021-11-13 20:05:18', '2021-11-13 20:05:18'),
(612, 'TINDAKAN', 'scallingra+rb(batashrgatas)', 'Scalling RA + RB (Batas Hrg Atas)', '2021-11-13 20:05:18', '2021-11-13 20:05:18'),
(613, 'ANAMNESI', 'gigiberlubang', 'gigi berlubang', '2021-11-13 20:09:11', '2021-11-13 20:09:11'),
(614, 'TINDAKAN', 'komposite(batashrgbawah)', 'Komposite (Batas Hrg Bawah)', '2021-11-13 20:09:11', '2021-11-13 20:09:11'),
(615, 'DIAGNOSA', '81gf', '81 GF', '2021-11-13 20:15:24', '2021-11-13 20:15:24'),
(616, 'TINDAKAN', 'cabutgigi/topikalanastesi(batashrgbawah)', 'Cabut gigi/topikal anastesi (Batas Hrg Bawah)', '2021-11-13 20:15:24', '2021-11-13 20:15:24'),
(617, 'ANAMNESI', 'gigikananbelakanggoyang', 'gigi kanan belakang goyang', '2021-11-13 20:17:27', '2021-11-13 20:17:27'),
(618, 'DIAGNOSA', 'gf85', 'gf 85', '2021-11-13 20:17:27', '2021-11-13 20:17:27'),
(619, 'ANAMNESI', 'gigikananbelakangnyilu', 'gigi kanan belakang nyilu', '2021-11-13 20:19:33', '2021-11-13 20:19:33'),
(620, 'DIAGNOSA', 'resesi16', 'resesi 16', '2021-11-13 20:19:33', '2021-11-13 20:19:33'),
(621, 'ANAMNESI', 'gigibelakanggoyang', 'gigi belakang goyang', '2021-11-13 20:21:12', '2021-11-13 20:21:12'),
(622, 'DIAGNOSA', 'gf55', 'gf 55', '2021-11-13 20:21:12', '2021-11-13 20:21:12'),
(623, 'ANAMNESI', 'nyeridikaki', 'nyeri di kaki', '2021-11-15 11:02:33', '2021-11-15 11:02:33'),
(624, 'ANAMNESI', 'gatal-gataldileher', 'gatal-gatal di leher', '2021-11-15 11:09:37', '2021-11-15 11:09:37'),
(625, 'TINDAKAN', 'perawatan', 'Perawatan', '2021-11-28 15:22:40', '2021-11-28 15:22:40'),
(626, 'TINDAKAN', 'administrasipasienbaru', 'ADMINISTRASI PASIEN BARU', '2021-12-13 04:59:49', '2021-12-13 04:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_sequence`
--

CREATE TABLE `tbl_master_sequence` (
  `id_master_sequence` int(11) NOT NULL,
  `master_seq_code` varchar(20) NOT NULL,
  `seq_name` varchar(100) NOT NULL,
  `seq_no` int(11) NOT NULL,
  `length_no` int(2) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_master_sequence`
--

INSERT INTO `tbl_master_sequence` (`id_master_sequence`, `master_seq_code`, `seq_name`, `seq_no`, `length_no`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'NOPERIKSA', 'No Periksa', 0, 6, '2018-02-28 22:01:47', '2018-02-28 22:01:47'),
(2, 'NOREKAMMEDIS', 'No Rekam Medis', 5, 6, '2018-02-28 22:04:56', '2021-12-11 06:49:42'),
(3, 'NOPENDAFTARAN', 'No Pendaftaran', 5, 6, '2018-03-03 01:32:21', '2021-12-11 06:49:42'),
(4, 'NOTRANSAKSIOBAT', 'No Transaksi Obat', 2, 6, '2018-05-11 16:49:33', '2021-12-13 04:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL COMMENT 'y=yes,n=no',
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `title`, `url`, `icon`, `is_main_menu`, `is_aktif`, `dtm_crt`, `dtm_upd`) VALUES
(39, 'Pemeriksaan Rapid Antigen', 'rapid_antigen', 'fa fa-book', 0, 'y', '2021-09-13 10:35:14', '2021-09-13 10:35:14'),
(40, 'Pencarian', 'pendaftaran/pencarian', 'fa fa-search', 0, 'y', '2018-04-19 10:35:14', '2018-04-19 10:35:14'),
(41, 'Formulir Rapid Antigen', 'pendaftaran_rapid_antigen', 'fa fa-book', 0, 'y', '2021-09-13 10:35:14', '2021-09-13 10:35:14'),
(42, 'Form Pendaftaran', 'pendaftaran/create', 'fa fa-pencil-square-o', 0, 'y', '2018-03-27 10:45:17', '2018-03-27 10:45:17'),
(43, 'Antrian Pendaftaran', 'pendaftaran', 'fa fa-pencil-square', 0, 'y', '2018-03-27 10:45:17', '2018-03-27 10:45:17'),
(44, 'Periksa Medis', 'periksamedis', 'fa fa-stethoscope', 0, 'y', '2018-03-27 10:45:17', '2018-03-27 10:45:17'),
(45, 'Pembayaran', 'pembayaran', 'fa fa-money', 62, 'y', '2018-03-27 10:45:17', '2018-03-27 10:45:17'),
(46, 'Apotek', 'apotek', 'fa fa-user-md', 0, 'y', '2018-03-27 10:45:17', '2018-03-27 10:45:17'),
(47, 'Laporan Keuangan', 'laporankeuangan', 'fa fa-book', 0, 'y', '2018-03-27 10:45:17', '2018-03-27 10:45:17'),
(49, 'Antrian', 'periksamedis/antrian', 'fa fa-hourglass-half', 0, 'y', '2018-03-27 10:45:17', '2018-03-27 10:45:17'),
(50, 'Jadwal Shift', 'hrms/shift', 'fa fa-calendar', 96, 'y', '2018-03-27 10:45:17', '2018-03-27 10:45:17'),
(53, 'Profile', 'profile', 'fa fa-server', 0, 'n', '2018-03-27 10:45:17', '2018-03-27 10:45:17'),
(54, 'Rekam Medis', 'periksamedis/riwayat', 'fa fa-book', 0, 'y', '2018-03-28 09:57:51', '2018-03-28 09:57:51'),
(55, 'Surat Ket Sehat', 'periksamedis/sksehat', 'fa fa-book', 0, 'y', '2018-04-03 11:37:00', '2018-04-03 11:37:00'),
(57, 'Rekap Asuransi', 'pembayaran/rekap_asuransi', 'fa fa-money', 0, 'y', '2018-04-25 16:19:45', '2018-04-25 16:19:45'),
(58, 'Pencarian', 'periksamedis/pencarian', 'fa fa-search', 60, 'y', '2018-04-25 23:11:09', '2018-04-25 23:11:09'),
(59, 'Form Pendaftaran', 'periksamedis/daftar_baru', 'fa fa-pencil-square', 60, 'y', '2018-04-25 17:02:17', '2018-04-25 17:02:17'),
(60, 'Daftar Baru', '#', 'fa fa-pencil', 0, 'y', '2018-04-25 23:36:00', '2018-04-25 23:36:00'),
(61, 'POS Obat', 'apotek/jual_obat', 'fa fa-pencil-square', 0, 'y', '2018-05-11 13:51:40', '2018-05-11 13:51:40'),
(62, 'Pembayaran', '#', 'fa fa-money', 0, 'y', '2018-05-11 17:08:59', '2018-05-11 17:08:59'),
(63, 'Obat Tanpa Periksa', 'pembayaran/obat_tanpa_periksa', 'fa fa-money', 62, 'y', '2018-05-11 17:10:41', '2018-05-11 17:10:41'),
(64, 'Sinkronisasi', 'sinkronisasi', 'fa fa-refresh', 0, 'y', '2018-05-19 14:29:55', '2018-05-19 14:29:55'),
(65, 'Kelola Menu', 'kelolamenu', 'fa fa-book', 73, 'y', '2018-03-27 10:45:17', '2018-03-27 10:45:17'),
(66, 'Kelola Pengguna', 'user', 'fa fa-user', 73, 'y', '2019-11-13 10:02:07', '2019-11-13 10:02:07'),
(67, 'Level Pengguna', 'userlevel', 'fa fa-level-up', 73, 'y', '2019-11-13 10:02:46', '2019-11-13 10:02:46'),
(68, 'MASTER SDM', 'dokter', 'fa fa-user-md', 78, 'y', '2019-11-13 10:20:12', '2019-11-13 10:20:12'),
(69, 'MASTER PASIEN', 'pasien', 'fa fa-id-card-o', 78, 'y', '2019-11-13 10:20:37', '2019-11-13 10:20:37'),
(70, 'PROFIL RS', 'profile', 'fa fa-id-card-o', 0, 'y', '2019-11-13 10:21:53', '2019-11-13 10:21:53'),
(71, 'Jenis SDM', 'spesialis', 'fa fa-stethoscope', 78, 'y', '2019-11-13 10:24:15', '2019-11-13 10:24:15'),
(72, 'MASTER REFERENSI', 'master_ref', 'fa fa-fax', 0, 'y', '2019-11-13 10:25:31', '2019-11-13 10:25:31'),
(73, 'Setting', '#', 'fa fa-cog', 0, 'y', '2019-11-13 10:29:20', '2019-11-13 10:29:20'),
(74, 'DATA OBAT DAN ALKES', 'dataobat', 'fa fa-medkit', 77, 'y', '2019-11-13 10:33:01', '2019-11-13 10:33:01'),
(75, 'DATA KATEGORI BARANG', 'kategoribarang', 'fa fa-clone', 77, 'y', '2019-11-13 10:33:42', '2019-11-13 10:33:42'),
(76, 'DATA SATUAN BARANG', 'datasatuan', 'fa fa-thermometer-full', 77, 'y', '2019-11-13 10:34:14', '2019-11-13 10:34:14'),
(77, 'MENU OBAT ALKES BHP', '#', 'fa fa-medkit', 0, 'y', '2019-11-13 10:34:43', '2019-11-13 10:34:43'),
(78, 'MASTER DATA', '#', 'fa fa-database', 0, 'y', '2019-11-13 10:38:22', '2019-11-13 10:38:22'),
(79, 'MASTER KLINIK', 'klinik', 'fa fa-hospital-o', 78, 'y', '2019-11-13 12:07:36', '2019-11-13 12:07:36'),
(80, 'MASTER PEGAWAI', 'hrms/pegawai', 'fa fa-id-card-o', 96, 'y', '2019-11-13 13:59:34', '2019-11-13 13:59:34'),
(81, 'DATA PABRIK', 'pabrik', 'fa fa-industry', 77, 'y', '2019-11-14 12:31:59', '2019-11-14 12:31:59'),
(82, 'DATA SUPPLIER', 'supplier', 'fa fa-truck', 77, 'y', '2019-11-14 13:37:57', '2019-11-14 13:37:57'),
(83, 'DATA GUDANG', 'gudang', 'fa fa-home', 77, 'y', '2019-11-14 14:19:15', '2019-11-14 14:19:15'),
(84, 'DATA GOLONGAN BARANG', 'golonganbarang', 'fa fa-object-group', 77, 'y', '2019-11-14 15:53:36', '2019-11-14 15:53:36'),
(85, 'DATA LOKASI BARANG', 'lokasibarang', 'fa fa-stack-exchange', 77, 'y', '2019-11-14 16:30:12', '2019-11-14 16:30:12'),
(86, 'MASTER APOTEKER', 'apoteker', 'fa fa-user', 78, 'y', '2019-11-14 20:59:18', '2019-11-14 20:59:18'),
(87, 'DATA OBAT RACIKAN', 'obat_racik', 'fa fa-medkit', 77, 'y', '2019-11-15 15:10:24', '2019-11-15 15:10:24'),
(88, 'MASTER JASA', 'jasa', 'fa fa-code-fork', 78, 'y', '2019-11-15 15:15:45', '2019-11-15 15:15:45'),
(89, 'Laporan biaya obat', 'laporankeuangan/biaya_obat', 'fa fa-medkit', 47, 'y', '2019-11-15 17:53:02', '2019-11-15 17:53:02'),
(90, 'Laporan biaya tindakan', 'laporankeuangan/biaya_tindakan', 'fa fa-minus', 47, 'y', '2019-11-15 18:16:29', '2019-11-15 18:16:29'),
(91, 'Laporan biaya pemeriksaan', 'laporankeuangan/biaya_pemeriksaan', 'fa fa-minus', 47, 'y', '2019-11-15 18:23:22', '2019-11-15 18:23:22'),
(92, 'Transaksi Apotek', 'transaksi_apotek', 'fa fa-briefcase', 0, 'y', '2019-11-18 08:35:09', '2019-11-18 08:35:09'),
(93, 'Purchase Order Obat', 'transaksi_apotek/po', 'fa fa-medkit', 92, 'y', '2019-11-18 08:36:52', '2019-11-18 08:36:52'),
(94, 'Penerimaan Obat', 'transaksi_apotek/receipt', 'fa fa-shopping-cart', 92, 'y', '2019-11-19 09:01:49', '2019-11-19 09:01:49'),
(95, 'RETUR BARANG', 'transaksi_apotek/create_retur', 'fa fa-undo', 92, 'y', '2019-11-20 09:23:56', '2019-11-20 09:23:56'),
(96, 'HRMS', 'hrms', 'fa fa-group', 0, 'y', '2019-11-21 14:05:31', '2019-11-21 14:05:31'),
(97, 'MASTER JABATAN', 'hrms/jabatan', 'fa fa-level-up', 96, 'y', '2019-11-21 14:06:18', '2019-11-21 14:06:18'),
(99, 'Referensi Gaji', 'hrms/ref_gaji', 'fa fa-money', 96, 'y', '2019-11-21 14:29:23', '2019-11-21 14:29:23'),
(100, 'Setting Gaji', 'hrms/set_gaji', 'fa fa-cog', 96, 'y', '2019-11-21 16:19:09', '2019-11-21 16:19:09'),
(101, 'Absensi Pegawai', 'hrms/absensi', 'fa fa-clock-o', 96, 'y', '2019-11-22 20:54:07', '2019-11-22 20:54:07'),
(102, 'Akuntansi', 'akuntansi', 'fa fa-money', 0, 'y', '2019-11-23 11:14:06', '2019-11-23 11:14:06'),
(103, 'MASTER akun', 'akuntansi/akun', 'fa fa-bookmark', 102, 'y', '2019-11-23 11:18:20', '2019-11-23 11:18:20'),
(104, 'Jurnal Akuntansi', 'akuntansi/transaksi_akuntansi', 'fa fa-id-card-o', 102, 'y', '2019-11-25 09:53:39', '2019-11-25 09:53:39'),
(106, 'Potongan', 'hrms/gaji/potongan', 'fa fa-cut', 96, 'n', '2019-11-26 14:00:04', '2019-11-26 14:00:04'),
(107, 'General ledger', 'akuntansi/akun/buku_besar', 'fa fa-book', 102, 'y', '2019-11-27 20:05:13', '2019-11-27 20:05:13'),
(108, 'saldo akun', 'akuntansi/akun/saldo', 'fa fa-money', 102, 'n', '2019-11-27 20:05:56', '2019-11-27 20:05:56'),
(109, 'Jam Lembur', 'hrms/lembur', 'fa fa-clock-o', 96, 'n', '2019-11-27 20:07:40', '2019-11-27 20:07:40'),
(110, 'Rumah tangga', 'akuntansi/transaksi_akuntansi/rt', 'fa fa-home', 102, 'n', '2019-11-28 21:06:06', '2019-11-28 21:06:06'),
(111, 'Petty Cash', 'akuntansi/transaksi_akuntansi/petty', 'fa fa-credit-card', 102, 'y', '2019-11-29 18:05:10', '2019-11-29 18:05:10'),
(112, 'Laporan Laba rugi', 'akuntansi/laporan/laba_rugi', 'fa fa-bar-chart', 117, 'y', '2019-11-29 18:06:19', '2019-11-29 18:06:19'),
(113, 'Neraca', 'akuntansi/transaksi_akuntansi/neraca', 'fa fa-balance-scale', 102, 'y', '2019-11-29 18:07:49', '2019-11-29 18:07:49'),
(114, 'chart of account', 'akuntansi/akun/coa', 'fa fa-list-alt', 102, 'y', '2019-12-01 14:25:08', '2019-12-01 14:25:08'),
(115, 'Jurnal Besar', 'akuntansi/akun/jurnal_besar', 'fa fa-newspaper-o', 102, 'n', '2019-12-02 11:00:26', '2019-12-02 11:00:26'),
(116, 'diskon transaksi', 'diskon_trx', 'fa fa-percent', 73, 'y', '2019-12-03 10:11:54', '2019-12-03 10:11:54'),
(117, 'Laporan akuntansi', '#', 'fa fa-id-card-o', 0, 'y', '2019-12-05 11:01:25', '2019-12-05 11:01:25'),
(118, 'Buku Kas', 'akuntansi/laporan/kas', 'fa fa-book', 117, 'y', '2019-12-05 11:05:54', '2019-12-05 11:05:54'),
(119, 'Rekap Pengeluaran Klinik', 'akuntansi/laporan/rekap_klinik', 'fa fa-list-alt', 117, 'y', '2019-12-05 21:54:04', '2019-12-05 21:54:04'),
(120, 'Rekap Kas Rumah Tangga', 'akuntansi/laporan/rekap_rt', 'fa fa-group', 117, 'n', '2019-12-06 08:49:44', '2019-12-06 08:49:44'),
(121, 'Rekap Kas Petty Cash', 'akuntansi/laporan/rekap_pc', 'fa fa-money', 117, 'n', '2019-12-06 08:50:40', '2019-12-06 08:50:40'),
(122, 'Rekap Pengeluaran', 'akuntansi/laporan/rekap_all', 'fa fa-file', 117, 'y', '2019-12-07 11:26:55', '2019-12-07 11:26:55'),
(123, 'Rekap Mingguan', 'akuntansi/laporan/rekap_mingguan', 'fa fa-calendar', 117, 'n', '2019-12-08 23:16:37', '2019-12-08 23:16:37'),
(126, 'Kasir', 'kasir', 'fa fa-bars', 0, 'n', '2019-12-13 09:33:45', '2019-12-13 09:33:45'),
(127, 'POS Obat', 'kasir/jual_obat', 'fa fa-pencil-square', 0, 'y', '2019-12-13 09:34:32', '2019-12-13 09:34:32'),
(128, 'Tutup Buku', 'akuntansi/transaksi_akuntansi/close_book', 'fa fa-book', 102, 'y', '2019-12-15 20:11:38', '2019-12-15 20:11:38'),
(129, 'Stok Obat', 'dataobat/stok', 'fa fa-line-chart', 77, 'y', '2021-06-22 14:13:22', '2021-06-22 14:13:22'),
(130, 'History Barang', 'dataobat/history', 'fa fa-history', 77, 'y', '2021-06-22 22:47:39', '2021-06-22 22:47:39'),
(131, 'Laporan Keuangan', 'dataobat/laporankeuangan', 'fa fa-book', 77, 'y', '2021-06-23 09:21:52', '2021-06-23 09:21:52'),
(132, 'Manufaktur', 'dataobat/manufaktur', 'fa fa-industry', 77, 'y', '2021-06-23 10:18:24', '2021-06-23 10:18:24'),
(133, 'Biaya Surat Keterangan', 'biayask', 'fa fa-money', 73, 'y', '2021-09-17 10:13:40', '2021-09-17 10:13:40'),
(134, 'Komisi Dokter', 'komisi_dokter', 'fa fa-money', 0, 'y', '2021-09-17 10:13:40', '2021-09-17 10:13:40'),
(135, 'Master Tindakan', 'tindakan', 'fa fa-stethoscope', 78, 'y', '2021-10-20 09:05:24', '2021-10-20 09:05:24'),
(136, 'Tipe Periksa Lab', 'tipe_lab', 'fa fa-stethoscope', 78, 'y', '2021-10-22 11:06:10', '2021-10-22 11:06:10'),
(137, 'Hutang PO Obat', 'supplier/hutang', 'fa fa-money', 77, 'y', '2021-11-04 11:06:10', '2021-11-04 11:06:10'),
(138, 'Obat Hampir Habis', 'obat_hampir_habis', 'fa fa-medkit', 0, 'y', '2021-11-06 14:14:45', '2021-11-06 14:14:45'),
(139, 'Penyesuaian Stok', 'dataobat/stok_adjustment', 'fa fa-pencil-square', 77, 'y', '2021-11-26 15:21:15', '2021-11-26 15:21:15'),
(140, 'Poli', 'poli', 'fa fa-stethoscope', 78, 'y', '2021-12-01 21:44:34', '2021-12-01 21:44:34'),
(141, 'Master Kategori Tindakan', 'tipe_kategori_tindakan', 'fa fa-code-fork', 78, 'y', '2021-12-01 21:45:04', '2021-12-01 21:45:04'),
(142, 'Master Pemeriksaan Radiologi', 'tipe_radiologi', 'fa fa-stethoscope', 78, 'y', '2021-12-01 21:46:37', '2021-12-01 21:46:37'),
(143, 'Kategori Kamar', 'kategori_kamar', 'fa fa-bed', 78, 'y', '2021-12-01 21:47:05', '2021-12-01 21:47:05'),
(144, 'Kamar', 'kamar', 'fa fa-bed', 78, 'y', '2021-12-01 21:47:19', '2021-12-01 21:47:19'),
(145, 'Kategori Biaya', 'kategori_biaya', 'fa fa-money', 78, 'y', '2021-12-01 21:47:43', '2021-12-01 21:47:43'),
(146, 'Biaya', 'biaya', 'fa fa-money', 78, 'y', '2021-12-01 21:48:00', '2021-12-01 21:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_obat_alkes_bhp`
--

CREATE TABLE `tbl_obat_alkes_bhp` (
  `kode_barang` varchar(15) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `id_kategori_barang` int(11) DEFAULT NULL,
  `id_satuan_barang` int(11) DEFAULT NULL,
  `jenis_barang` int(2) DEFAULT NULL COMMENT '1 = obat , 2 = alat kesehatan',
  `harga` int(11) NOT NULL,
  `id_klinik` int(11) NOT NULL,
  `dtm_crt` datetime DEFAULT current_timestamp(),
  `dtm_upd` datetime DEFAULT current_timestamp(),
  `kode_pabrik` varchar(15) DEFAULT NULL,
  `id_golongan_barang` int(11) DEFAULT NULL,
  `minimal_stok` double NOT NULL,
  `deskripsi` varchar(200) DEFAULT NULL,
  `indikasi` varchar(200) DEFAULT NULL,
  `kandungan` varchar(200) DEFAULT NULL,
  `dosis` varchar(100) DEFAULT NULL,
  `kemasan` varchar(50) DEFAULT NULL,
  `efek_samping` varchar(200) DEFAULT NULL,
  `zat_aktif` varchar(200) DEFAULT NULL,
  `etiket` varchar(200) DEFAULT NULL COMMENT 'aturan minum obat',
  `foto_barang` varchar(50) DEFAULT NULL,
  `barcode` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_obat_alkes_bhp`
--

INSERT INTO `tbl_obat_alkes_bhp` (`kode_barang`, `nama_barang`, `id_kategori_barang`, `id_satuan_barang`, `jenis_barang`, `harga`, `id_klinik`, `dtm_crt`, `dtm_upd`, `kode_pabrik`, `id_golongan_barang`, `minimal_stok`, `deskripsi`, `indikasi`, `kandungan`, `dosis`, `kemasan`, `efek_samping`, `zat_aktif`, `etiket`, `foto_barang`, `barcode`) VALUES
('AIDXB', 'INDUXIN 10 IU AMPUL 1 ML/10', 1, 3, 1, 11700, 1, '0000-00-00 00:00:00', '2021-12-11 05:32:55', 'PAB1624001874', 2, 5, '', '', '', '', '', '', '', '', NULL, ''),
('AKMCA', 'KALMECO 500 MCG AMP 1 ML/ 1X5', 5, 1, 1, 36400, 1, '0000-00-00 00:00:00', '2021-12-09 08:02:17', '', 8, 5, '', '', '', '', '', '', '', '', NULL, ''),
('AKNXA', 'KALNEX 250 MG AMPUL 5ML / 10', NULL, NULL, NULL, 14950, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('AKNXB', 'KALNEX 500 MG AMPUL 5ML/10', NULL, NULL, NULL, 19500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('APPGA', 'POSPARGIN 0,2 MG AMP 1ML / 10', NULL, NULL, NULL, 7800, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('ARANA', 'RANTIN 50 MG AMPUL/ 2 ML', NULL, NULL, NULL, 65000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('AVCRA', 'VOMCERAN 8 MG AMPUL 4 ML/5', NULL, NULL, NULL, 74100, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('AVCRC', 'VOMCERAN 4 MG AMPUL 2 ML/5', NULL, NULL, NULL, 40300, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('BRG1638090777', 'Jarum Suntik', 5, 8, 2, 12000, 1, '2021-11-28 16:12:57', '2021-11-28 16:12:57', 'PAB1624001874', 3, 5, '', '', '', '', '', '', '', '', NULL, ''),
('BRG1638272332', 'ALBAPURE 200ml', 5, 1, 1, 1500000, 1, '2021-11-30 11:38:52', '2021-12-12 12:07:44', 'PAB1638269278', 3, 5, '', '', 'Human Albumin 20%', '', 'Box, 1 Botol', '', '', '', NULL, ''),
('BRG1638505328', 'AMINOPHYLLINE INJ', 6, 2, 1, 11050, 1, '2021-12-01 11:14:00', '2021-12-09 07:57:26', 'PAB1638500170', 8, 5, '-', '-', 'AMINOPHYLLINE INJ', '24mg/ml', 'box', '-', '-', '-', '-', '0131'),
('BRG1638505329', 'AMINOPHYLLINE INJ', 6, 2, 1, 50000, 1, '2021-12-02 11:14:00', '2021-12-13 04:27:03', 'PAB1638500193', 8, 5, '-', '-', 'AMINOPHYLLINE INJ', '24mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505330', 'ATROPIN SULFAT', 6, 2, 1, 0, 1, '2021-12-03 11:14:00', '2021-12-09 05:19:42', '', 8, 5, '-', '-', 'ATROPIN SULFAT', '', '', '-', '-', '-', '-', '-'),
('BRG1638505331', 'CETADOP INJ', 6, 2, 3, 0, 1, '2021-12-04 11:14:00', '2021-12-04 11:14:00', 'PAB1638500206', 9, 3, '-', '-', 'DOPAMIN HCL', '40mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505332', 'D40%', 6, 12, 3, 0, 1, '2021-12-05 11:14:00', '2021-12-05 11:14:00', 'null', 8, 3, '-', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505333', 'DEXAMETHASONE INJ', 6, 2, 3, 0, 1, '2021-12-06 11:14:00', '2021-12-06 11:14:00', 'PAB1638500215', 8, 10, '-', '-', 'DEXAMETHASONE INJ', '5mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505334', 'DEXAMETHASONE INJ', 6, 2, 3, 0, 1, '2021-12-07 11:14:00', '2021-12-07 11:14:00', 'PAB1638500228', 8, 10, '-', '-', 'DEXAMETHASONE INJ', '5mg/ml', 'box/100', '-', '-', '-', '-', '-'),
('BRG1638505335', 'DIAZEPAM INJ', 6, 2, 3, 0, 1, '2021-12-08 11:14:00', '2021-12-08 11:14:00', 'PAB1638500215', 8, 5, '-', '-', 'DIAZEPAM', '5mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505336', 'VALIPAB1638500243 INJ', 6, 2, 3, 0, 1, '2021-12-09 11:14:00', '2021-12-09 11:14:00', 'PAB1638500243', 9, 5, '-', '-', 'DIAZEPAM', '5mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505337', 'EPINEPRIN', 6, 2, 3, 0, 1, '2021-12-10 11:14:00', '2021-12-10 11:14:00', 'null', 8, 5, '-', '-', 'EPINEPRIN', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505338', 'EPHEDRIN', 6, 2, 3, 0, 1, '2021-12-11 11:14:00', '2021-12-11 11:14:00', 'null', 8, 5, '-', '-', 'EPHEDRIN', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505339', 'LIDOCAIN HCl 2% INJ', 6, 2, 3, 0, 1, '2021-12-12 11:14:00', '2021-12-12 11:14:00', 'PAB1638500257', 8, 10, '-', '-', 'LIDOCAIN HCl ', '2%', 'box', '-', '-', '-', '-', '-'),
('BRG1638505340', 'INDOP INJ', 6, 12, 3, 0, 1, '2021-12-13 11:14:00', '2021-12-13 11:14:00', 'PAB1638500268', 9, 3, '-', '-', 'DOPAMIN HCL', '40mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505341', 'ATRACURIUM', 6, 2, 4, 0, 1, '2021-12-14 11:14:00', '2021-12-14 11:14:00', 'null', 0, 0, '-', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505342', 'FENTANYL', 6, 2, 4, 0, 1, '2021-12-15 11:14:00', '2021-12-15 11:14:00', 'PAB1638500290', 8, 10, '-', '-', 'FENTANYL CITRATE', '100mcg/2ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505343', 'ISOFLURAN', 6, 2, 4, 0, 1, '2021-12-16 11:14:00', '2021-12-16 11:14:00', 'null', 0, 0, '-', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505344', 'KTM-100', 6, 12, 4, 0, 1, '2021-12-17 11:14:00', '2021-12-17 11:14:00', 'PAB1638500527', 9, 3, '-', '-', 'KETAMIN HCl', '100mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505345', 'KETAMINEHAMELN', 6, 12, 4, 0, 1, '2021-12-18 11:14:00', '2021-12-18 11:14:00', 'PAB1638500536', 9, 3, '-', '-', 'KETAMIN HCl', '50mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505346', 'MIDAZOLAM/MILOS', 6, 2, 4, 0, 1, '2021-12-19 11:14:00', '2021-12-19 11:14:00', 'null', 0, 5, '-', '-', 'MIDAZOLAM HCl', '1mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505347', 'FORTANEST INJ', 6, 2, 4, 0, 1, '2021-12-20 11:14:00', '2021-12-20 11:14:00', 'PAB1638500549', 9, 5, '-', '-', 'MIDAZOLAM HCl', '1mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505348', 'N20', 6, 8, 4, 0, 1, '2021-12-21 11:14:00', '2021-12-21 11:14:00', 'null', 0, 0, '-', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505349', 'NEOSTIGMINE METILSULFAT INJ/PROSTIGMIN', 6, 2, 4, 0, 1, '2021-12-22 11:14:00', '2021-12-22 11:14:00', 'null', 0, 0, '-', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505350', 'NOKUBA', 6, 8, 4, 0, 1, '2021-12-23 11:14:00', '2021-12-23 11:14:00', 'null', 0, 0, '-', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505351', 'NOVERON/ROCULAX', 6, 8, 4, 0, 1, '2021-12-24 11:14:00', '2021-12-24 11:14:00', 'PAB1638500557', 9, 10, '-', '-', 'ROCURONIUM BROMIDE', '10mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505352', 'PETHIDINA INJ', 6, 2, 4, 0, 1, '2021-12-25 11:14:00', '2021-12-25 11:14:00', 'PAB1638500570', 9, 5, '-', '-', 'PETHIDINE HCl', '50mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505353', 'NUPOVEL INJ', 6, 2, 4, 0, 1, '2021-12-26 11:14:00', '2021-12-26 11:14:00', 'PAB1638500557', 9, 10, '-', '-', 'PROPOFOL', '10mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505354', 'REGIVELL SPINAL 0.5% INJ', 6, 2, 4, 0, 1, '2021-12-27 11:14:00', '2021-12-27 11:14:00', 'PAB1638500557', 9, 10, '-', '-', 'BUPIVACAINE HCl MONOHYDRATE', '5mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505355', 'BUNASCAN SPINAL 0,5% INJ', 6, 2, 4, 0, 1, '2021-12-28 11:14:00', '2021-12-28 11:14:00', 'PAB1638500268', 9, 10, '-', '-', 'BUPIVACAINE HCl MONOHYDRATE', '5mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505356', 'SEVOFLURANE/HALOTHAN', 6, 2, 4, 0, 1, '2021-12-29 11:14:00', '2021-12-29 11:14:00', 'null', 0, 0, '-', '-', '', '', 'box', '-', '-', '-', '-', '-'),
('BRG1638505357', 'V-C 500', 6, 2, 5, 0, 1, '2021-12-30 11:14:00', '2021-12-30 11:14:00', 'PAB1638500268', 9, 5, '-', '-', 'ASAM AKSORBAT', '100mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505358', 'ASAM TRANEXAMAT INJ', 6, 2, 5, 0, 1, '2021-12-31 11:14:00', '2021-12-31 11:14:00', 'PAB1638500623', 8, 5, '-', '-', 'ASAM TRANEXAMAT', '100mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505359', 'CEFOTAXIM INJ', 6, 12, 5, 0, 1, '2022-01-01 11:14:00', '2022-01-01 11:14:00', 'PAB1638500640', 8, 5, '-', '-', 'CEFOTAXIM SODIUM', '1g', 'box', '-', '-', '-', '-', '-'),
('BRG1638505360', 'CEFTRIAXON INJ POWDER', 6, 12, 5, 0, 1, '2022-01-02 11:14:00', '2022-01-02 11:14:00', 'PAB1638500640', 8, 5, '-', '-', 'CEFTRIAXON SODIUM', '1g', 'box', '-', '-', '-', '-', '-'),
('BRG1638505361', 'CEFTRIAXON INJ POWDER', 6, 12, 5, 0, 1, '2022-01-03 11:14:00', '2022-01-03 11:14:00', 'PAB1638500623', 8, 5, '-', '-', 'CEFTRIAXON SODIUM', '1g', 'box', '-', '-', '-', '-', '-'),
('BRG1638505362', 'CITICOLIN INJ', 6, 2, 5, 0, 1, '2022-01-04 11:14:00', '2022-01-04 11:14:00', 'PAB1638500650', 8, 5, '-', '-', 'CITICOLIN SODIUM', '125mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505363', 'CITICOLIN INJ', 6, 2, 5, 0, 1, '2022-01-05 11:14:00', '2022-01-05 11:14:00', 'PAB1638500668', 8, 5, '-', '-', 'CITICOLIN SODIUM', '125mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505364', 'FURAMINE INJ', 6, 2, 5, 0, 1, '2022-01-06 11:14:00', '2022-01-06 11:14:00', 'PAB1638500215', 9, 3, '-', '-', 'FURSULTIAMINE HCl', '2,5mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505365', 'KETOROLAC INJ', 6, 2, 5, 0, 1, '2022-01-07 11:14:00', '2022-01-07 11:14:00', 'PAB1638500215', 8, 10, '-', '-', 'KETOROLAC TROMETAMOL', '30mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505366', 'LANSOPRAZOLE 30 MG INJ POWDER', 6, 12, 5, 0, 1, '2022-01-08 11:14:00', '2022-01-08 11:14:00', 'null', 0, 0, '-', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505367', 'MEROPENEM INJ POWDER', 6, 12, 5, 0, 1, '2022-01-09 11:14:00', '2022-01-09 11:14:00', 'PAB1638500623', 8, 5, '-', '-', 'MEROPENEM TRIHYDRATE', '1g', 'box', '-', '-', '-', '-', '-'),
('BRG1638505368', 'METHYLERGOMETRINE MALEAT INJ', 6, 2, 5, 0, 1, '2022-01-10 11:14:00', '2022-01-10 11:14:00', 'PAB1638500557', 8, 5, '-', '-', 'METHYLERGOMETRINE MALEAT', '0,2 mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505369', 'METOCLOPRAMIDE INJ', 6, 2, 5, 0, 1, '2022-01-11 11:14:00', '2022-01-11 11:14:00', 'PAB1638500650', 8, 5, '-', '-', 'METOCLOPRAMIDE HCl', '5mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505370', 'METOCLOPRAMIDE INJ (GAVISTAL)', 6, 2, 5, 0, 1, '2022-01-12 11:14:00', '2022-01-12 11:14:00', 'null', 0, 0, '-', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505371', 'METRONIDAZOLE 13 100ML', 6, 13, 5, 0, 1, '2022-01-13 11:14:00', '2022-01-13 11:14:00', 'PAB1638500257', 8, 3, '-', '-', 'METRONIDAZOLE', '500mg/100ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505372', 'NEUROBION 5000 INJ', 6, 2, 5, 0, 1, '2022-01-14 11:14:00', '2022-01-14 11:14:00', 'PAB1638501021', 9, 10, '-', '-', 'B1, B6', '100mg', 'box', '-', '-', '-', '-', '-'),
('BRG1638505373', 'NICARDIPINE INJ', 6, 2, 5, 0, 1, '2022-01-15 11:14:00', '2022-01-15 11:14:00', 'PAB1638500557', 8, 3, '-', '-', 'NICARDIPINE HCl', '1mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505374', 'PHYTOMENADION INJ', 6, 2, 5, 0, 1, '2022-01-16 11:14:00', '2022-01-16 11:14:00', 'PAB1638500215', 8, 3, '-', '-', 'PHYTOMENADIONE', '2mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505375', 'PHYTOMENADION INJ', 6, 2, 5, 0, 1, '2022-01-17 11:14:00', '2022-01-17 11:14:00', 'PAB1638500215', 8, 3, '-', '-', 'PHYTOMENADIONE', '10mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505376', 'PIRACETAM INJ', 6, 2, 5, 0, 1, '2022-01-18 11:14:00', '2022-01-18 11:14:00', 'PAB1638500623', 8, 5, '-', '-', 'PIRACETAM', '200mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505377', 'PLASMINEX INJ', 6, 2, 5, 0, 1, '2022-01-19 11:14:00', '2022-01-19 11:14:00', 'PAB1638500243', 9, 5, '-', '-', 'ASAM TRANEXAMAT', '100mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505378', 'PROSOGAN INJ (LANSOPRAZOLE 30MG)', 6, 2, 5, 0, 1, '2022-01-20 11:14:00', '2022-01-20 11:14:00', 'null', 0, 0, '-', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505379', 'PUMPITOR INJ', 6, 2, 5, 0, 1, '2022-01-21 11:14:00', '2022-01-21 11:14:00', 'PAB1638500243', 9, 5, '-', '-', 'OMEPRAZOLE SODIUM', '40mg', 'box', '-', '-', '-', '-', '-'),
('BRG1638505380', 'RANITIDINE INJ (PAB1638500215)', 6, 2, 5, 0, 1, '2022-01-22 11:14:00', '2022-01-22 11:14:00', 'PAB1638500215', 8, 5, '-', '-', 'RANITIDINE HCl', '25mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505381', 'RANITIDINE INJ (QUANTUM)', 6, 2, 5, 0, 1, '2022-01-23 11:14:00', '2022-01-23 11:14:00', 'PAB1638500257', 8, 5, '-', '-', 'RANITIDINE HCl', '25mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505382', 'RATIVOL INJ', 6, 2, 5, 0, 1, '2022-01-24 11:14:00', '2022-01-24 11:14:00', 'PAB1638500243', 9, 5, '-', '-', 'KETOROLAC TROMETAMOL', '30mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505383', 'SAGESTAM INJ', 6, 2, 5, 0, 1, '2022-01-25 11:14:00', '2022-01-25 11:14:00', 'PAB1638500243', 9, 5, '-', '-', 'GENTAMICIN SULFAT', '40mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505384', 'PAB1638500243 HEST INJ', 6, 2, 5, 0, 1, '2022-01-26 11:14:00', '2022-01-26 11:14:00', 'PAB1638500243', 9, 0, '-', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505385', 'SANMOL 13', 6, 13, 5, 0, 1, '2022-01-27 11:14:00', '2022-01-27 11:14:00', 'PAB1638500243', 9, 5, '-', '-', 'PARACETAMOL', '1000mg', 'box', '-', '-', '-', '-', '-'),
('BRG1638505386', 'TAXEGRAM 1 INJ', 6, 12, 5, 0, 1, '2022-01-28 11:14:00', '2022-01-28 11:14:00', 'PAB1638500243', 9, 5, '-', '-', 'CEFOTAXIME SODIUM', '1g', 'box', '-', '-', '-', '-', '-'),
('BRG1638505387', 'VENTOLIN NEBULE', 6, 2, 5, 0, 1, '2022-01-29 11:14:00', '2022-01-29 11:14:00', 'PAB1638501029', 9, 5, '-', '-', 'SALBUTAMOL', '2,5mg', 'box', '-', '-', '-', '-', '-'),
('BRG1638505388', 'ANTRAIN INJ', 6, 2, 5, 0, 1, '2022-01-30 11:14:00', '2022-01-30 11:14:00', 'PAB1638501042', 9, 10, '-', '-', 'METAMIZOLE SODIUM', '500mg/ml', 'box', '-', '-', '-', '-', '-'),
('BRG1638505389', 'BROADCED 1 INJ (CEFTRIAXON)', 6, 12, 5, 0, 1, '2022-01-31 11:14:00', '2022-01-31 11:14:00', 'PAB1638500549', 9, 5, '-', '-', 'CEFTRIAXONE DISODIUM', '1g', 'box', '-', '-', '-', '-', '-'),
('BRG1638505390', 'TETAGAM P', 6, 12, 5, 0, 1, '2022-02-01 11:14:00', '2022-02-01 11:14:00', 'PAB1638501050', 9, 3, '-', '-', 'HUMAN TETANUS IM', '1ml (250 IU)', 'box', '-', '-', '-', '-', '-'),
('BRG1638505391', 'ALKOHOL 70% 1 L', 6, 12, 5, 0, 1, '2022-02-02 11:14:00', '2022-02-02 11:14:00', 'null', 0, 0, 'null', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505392', 'AMINOFLUID', 6, 8, 5, 0, 1, '2022-02-03 11:14:00', '2022-02-03 11:14:00', 'null', 0, 0, 'null', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505393', 'AQUA 1 L', 6, 8, 5, 0, 1, '2022-02-04 11:14:00', '2022-02-04 11:14:00', 'null', 0, 0, 'null', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505394', 'AQUABIDEST/AQUA PRO INJ/WFI', 6, 8, 5, 0, 1, '2022-02-05 11:14:00', '2022-02-05 11:14:00', 'null', 0, 0, 'null', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505395', 'AUTOMATIC X-RAY B 600ML', 6, 8, 5, 0, 1, '2022-02-06 11:14:00', '2022-02-06 11:14:00', 'null', 0, 0, 'null', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505396', 'FORMALIN 95%', 6, 8, 5, 0, 1, '2022-02-07 11:14:00', '2022-02-07 11:14:00', 'null', 0, 0, 'null', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505397', 'HYDROGEN PEROXIDA 3%', 6, 12, 5, 0, 1, '2022-02-08 11:14:00', '2022-02-08 11:14:00', 'null', 0, 0, 'null', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505398', 'NaCl 100 ML', 6, 8, 5, 0, 1, '2022-02-09 11:14:00', '2022-02-09 11:14:00', 'null', 0, 0, 'null', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505399', 'NaCl 1000 ML', 6, 8, 5, 0, 1, '2022-02-10 11:14:00', '2022-02-10 11:14:00', 'null', 0, 0, 'null', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505400', 'NaCl 500 ML', 6, 8, 5, 0, 1, '2022-02-11 11:14:00', '2022-02-11 11:14:00', 'null', 0, 0, 'null', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505401', 'RL', 6, 8, 5, 0, 1, '2022-02-12 11:14:00', '2022-02-12 11:14:00', 'null', 0, 0, 'null', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505402', 'ULTRASOUND TRANSMISION GEL', 6, 8, 5, 0, 1, '2022-02-13 11:14:00', '2022-02-13 11:14:00', 'null', 0, 0, 'null', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505403', 'WIDAHES', 6, 8, 5, 0, 1, '2022-02-14 11:14:00', '2022-02-14 11:14:00', 'null', 0, 0, 'null', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505404', 'OTSUTRAN-40', 6, 8, 5, 0, 1, '2022-02-15 11:14:00', '2022-02-15 11:14:00', 'null', 0, 0, 'null', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505405', 'ASERING', 6, 8, 5, 0, 1, '2022-02-16 11:14:00', '2022-02-16 11:14:00', 'null', 0, 0, 'null', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('BRG1638505406', 'OTSU-D5', 6, 8, 5, 0, 1, '2022-02-17 11:14:00', '2022-02-17 11:14:00', 'null', 0, 0, 'null', '-', 'null', 'null', 'null', '-', '-', '-', '-', '-'),
('CKTFA', 'KALTROFEN 100 MG SUPPO/2x5', NULL, NULL, NULL, 16900, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('CNGAA', 'NEO GYNOXA OVULA / 2 x 5', NULL, NULL, NULL, 19500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('COVIVR', 'COVIVOR', NULL, NULL, NULL, 780000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('CVNMA', 'VENOSMIL GEL / 60 G', NULL, NULL, NULL, 221000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('DCEFA', 'CEFSPAN DRY SYRUP/30 ML', NULL, NULL, NULL, 130000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('DCOXA', 'CLAVAMOX DRY SYRUP/60ML', NULL, NULL, NULL, 97500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('de_barang', 'nama_barang', 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pabrik', 0, 0, 'deskripsi', 'indikasi', 'kandungan', 'dosis', 'kemasan', 'efek_samping', 'zat_aktif', 'etiket', 'foto_barang', 'barcode'),
('DSTRA', 'STAFORIN 250 MG DRY SYRUP/60ML', NULL, NULL, NULL, 97500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('DSTRB', 'STAFORIN 125 MG/5 ML DS /60 ML', NULL, NULL, NULL, 65000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('DVLPI', 'DIVALPI', NULL, NULL, NULL, 728000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('DVTIA', 'VESTEIN DRY SYRUP / 60 ML', NULL, NULL, NULL, 52000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('FLVIR', 'FLUVIR 1 x 10tab', NULL, NULL, NULL, 16900, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('FVLOW10', 'FAVILOW tab 10x10', NULL, NULL, NULL, 20800, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('GBATA', 'BRAINACT 1000 MG SACHET / 5', NULL, NULL, NULL, 32500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('GLRCA', 'LIPROLAC VANILLA POWDER / 30', NULL, NULL, NULL, 8667, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('GTRTA', 'TROLIT SACHET 4 G / 6', NULL, NULL, NULL, 14083, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IBATB', 'BRAINACT 250 MG/2 ML INJ/5\'S', NULL, NULL, NULL, 55900, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IBATC', 'BRAINACT 500 MG/4 ML INJ AMP/5', NULL, NULL, NULL, 91000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IBATD', 'BRAINACT 1000MG/8 ML INJ AMP/5', NULL, NULL, NULL, 140400, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('ICFZE', 'CEFAZOL 1 GR INJ+AQUA PI/1', NULL, NULL, NULL, 169000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IFLTB', 'FLUTIAS 125 MCG INHALER / 1', NULL, NULL, NULL, 182000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IHXLA', 'HEXILON INJEKSI 125 MG 2ML/1', NULL, NULL, NULL, 130000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IMIKA', 'MIKASIN 250 MG/2 ML INJ VL/1', NULL, NULL, NULL, 130000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IMIKB', 'MIKASIN 500 MG/2 ML INJ VL/1', NULL, NULL, NULL, 230100, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IMRFA', 'MEROFEN 500 MG IV VIAL / 1', NULL, NULL, NULL, 351000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IMRFC', 'MEROFEN 1000 MG IV VIAL / 1', NULL, NULL, NULL, 663000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('INRTB', 'NEUROTAM 3 GR INJ AMP / 4', NULL, NULL, NULL, 71500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('INRTC', 'NEUROTAM INFUS 60 ML VIAL / 1', NULL, NULL, NULL, 273000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IOTBD', 'OCTALBIN 20% 100 ML INFUS/1', NULL, NULL, NULL, 1950000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IOTBE', 'OCTALBIN 25% 50 ML INFUS/1', NULL, NULL, NULL, 1274000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IOTBF', 'OCTALBIN 25% 100 ML INFUS/1', NULL, NULL, NULL, 2535000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('ITRSB', 'TORASIC 30 MG INJ AMP 1 ML/1x6', NULL, NULL, NULL, 46583, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IVDNA', 'VITADION 2 MG INJ AMP 1 ML/5', NULL, NULL, NULL, 15600, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IVPMA', 'VIPIME 1 G+AQUA PI AMP 10ML/1', NULL, NULL, NULL, 390000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KCEFB', 'CEFSPAN 100MG KAPSUL/3X10', NULL, NULL, NULL, 29900, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KFCHB', 'FUCOHELIX 100 MG KAPSUL/2X10', NULL, NULL, NULL, 14950, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KFCLB', 'FLUCORAL 150 MG KAPSUL/1 X 10', NULL, NULL, NULL, 91000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KFNRA', 'FORNEURO 5 X 6 KAPSUL', NULL, NULL, NULL, 7367, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KGSDA', 'GLISODIN KAPSUL / 30', NULL, NULL, NULL, 8017, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KHPXB', 'HEPAMAX KAPSUL / 3X10', NULL, NULL, NULL, 11917, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KKMCK', 'KALMECO 500 MCG KAPSUL/10X10', NULL, NULL, NULL, 3640, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KKNXE', 'KALNEX 250MG KAPSUL/10X10', NULL, NULL, NULL, 2535, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KKXTA', 'KALXETIN 20 MG 30 KAPSUL', NULL, NULL, NULL, 8667, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KKXTB', 'KALXETIN 10 MG 30 KAPSUL', NULL, NULL, NULL, 5200, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KLCDA', 'LANCID 30 MG KAPSUL / 2X10', NULL, NULL, NULL, 19500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KNPTA', 'NEPATIC 300 MG KAPSUL /5X10', NULL, NULL, NULL, 12740, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KOFDA', 'OSFIT DHA KAPSUL / 3 x 10', NULL, NULL, NULL, 5850, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KPVLA', 'PROVELYN 75 MG KAPSUL / 14\'S', NULL, NULL, NULL, 13492, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KPVLB', 'PROVELYN 150 MG KAPSUL / 14\'S', NULL, NULL, NULL, 20893, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KSBOB', 'SYNBIO KAPSUL / 3X10', NULL, NULL, NULL, 5850, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KSTRK', 'STAFORIN 500 MG KAPSUL/3X10', NULL, NULL, NULL, 12783, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KUDHA', 'URDAHEX KAPSUL / 3X10', NULL, NULL, NULL, 12567, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KVNMB', 'VENOSMIL KAPSUL / 2X10', NULL, NULL, NULL, 13000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KVTIA', 'VESTEIN 300 MG KAPSUL / 2X10', NULL, NULL, NULL, 5980, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LBENA', 'BENACOL EXPECTORANT SYR/60ML', NULL, NULL, NULL, 13000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LBENB', 'BENACOL EXPECTORANT SYR/100ML', NULL, NULL, NULL, 18200, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LBNDA', 'BENACOL DTM SYRUP / 60 ML', NULL, NULL, NULL, 15600, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LCTNA', 'CETINAL SYRUP / 60 ML', NULL, NULL, NULL, 78000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LENSA', 'ENYSTIN DROPS / 12 ML', NULL, NULL, NULL, 46800, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LFCHA', 'FUCOHELIX SYRUP / 90 ML', NULL, NULL, NULL, 117000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LLKMA', 'LIKURMIN SYRUP / 100 ML', NULL, NULL, NULL, 58500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LNCBA', 'NECIBLOK SUSPENSI / 200 ML', NULL, NULL, NULL, 114400, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LNCBB', 'NECIBLOK SUSPENSI / 100 ML', NULL, NULL, NULL, 71500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LNRTA', 'NEUROTAM SYRUP / 100 ML', NULL, NULL, NULL, 78000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LNZ100', 'LANZOX 100 IU', NULL, NULL, NULL, 3744000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LNZ50', 'LANZOX 50 IU', NULL, NULL, NULL, 2314000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LPCRLCBD', 'LIPROLAC BABY DROP', NULL, NULL, NULL, 260000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LPFLA', 'PROFILAS SYRUP / 60ML', NULL, NULL, NULL, 91000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LSTMB', 'STARMUNO KIDS SYRUP / 60 ML', NULL, NULL, NULL, 91000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LTBRB', 'TRANSBRONCHO 15MG/5MLLIQ/100ML', NULL, NULL, NULL, 26000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LVAPA', 'VALPI 250 MG/5 ML SYRUP / 60 ML', NULL, NULL, NULL, 52000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LVCRA', 'VOMCERAN 4 MG/5 ML SYRUP/60 ML', NULL, NULL, NULL, 97500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('LVMTA', 'VOMITAS SYRUP / 60 ML', NULL, NULL, NULL, 58500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PROVC', 'PROVE C inj 5 Ampul', NULL, NULL, NULL, 39000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PROVD', 'PROVE D tab 30 tab', NULL, NULL, NULL, 3250, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PROVDDROP', 'PROVE D DROP', NULL, NULL, NULL, 260000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PROVE', 'PROVE C inj 5 Ampul', NULL, NULL, NULL, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TAGNA', 'ANGIOTEN TABLET / 3X10', NULL, NULL, NULL, 16250, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TBATA', 'BRAINACT 500 MG TAB/3X10', NULL, NULL, NULL, 16250, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TBATB', 'BRAINACT 1000 MG TAB/3X10', NULL, NULL, NULL, 26650, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TBATC', 'BRAINACT O-DIS TABLET/30\'S', NULL, NULL, NULL, 16683, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TBTOA', 'BETA ONE 2.5 MG TABLET / 5X10', NULL, NULL, NULL, 3250, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TBTOB', 'BETA ONE 5 MG TABLET / 3X10', NULL, NULL, NULL, 6890, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TBTSK', 'BACTESYN 375 MG KAPLET / 3X10', NULL, NULL, NULL, 28167, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TCEFE', 'CEFSPAN 200 MG TABLET / 1x10', NULL, NULL, NULL, 47450, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TCLTA', 'CHOLESTAT 10 MG TABLET/3X10', NULL, NULL, NULL, 6240, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TCLTE', 'CHOLESTAT 20 MG TABLET/3X10', NULL, NULL, NULL, 10833, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TCOXK', 'CLAVAMOX 500 MG TABLET / 3X10', NULL, NULL, NULL, 16683, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TCPGB', 'CPG 75 MG TABLET BLISTER/ 3X10', NULL, NULL, NULL, 22100, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TCRQB', 'CAR Q 100 MG KAPLET / 3X10', NULL, NULL, NULL, 14300, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TCRVE', 'CRAVIT 250 MG TABLET / 1X10', NULL, NULL, NULL, 35100, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TCRVK', 'CRAVIT 500MG TABLET / 1X10', NULL, NULL, NULL, 53950, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TCRVN', 'CRAVIT 750 MG FILCO KAPLET/1X10', NULL, NULL, NULL, 60450, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TCTNA', 'CETINAL 10 MG CHEW TABLET/3X10', NULL, NULL, NULL, 5333, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TCTZA', 'CITAZ 50 MG TABLET/5X10', NULL, NULL, NULL, 5070, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TCTZB', 'CITAZ 100 MG TABLET/5X10', NULL, NULL, NULL, 14248, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TDVKA', 'DIVASK 5 MG TABLET / 3X10', NULL, NULL, NULL, 8450, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TDVKB', 'DIVASK 10 MG TABLET / 3X10', NULL, NULL, NULL, 14300, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TENTA', 'EMINETON TABLET/10X10', NULL, NULL, NULL, 2210, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TFDSA', 'FORDESIA 5 MG TABLET/3X10', NULL, NULL, NULL, 28516, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TFGOA', 'FREGO 5 MG TABLET/5 X 10', NULL, NULL, NULL, 7800, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TFGOB', 'FREGO 10 MG TABLET/5 X 10', NULL, NULL, NULL, 9620, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TFROE', 'FEROFORT FC TABLET/10 X 10', NULL, NULL, NULL, 2080, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TFRSA', 'FORRES 50 MG TABLET/5 X 10', NULL, NULL, NULL, 6500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('THXLA', 'HEXILON 4 MG KAPLET/5X10', NULL, NULL, NULL, 3900, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('THXLB', 'HEXILON 8 MG KAPLET/3X10', NULL, NULL, NULL, 5850, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('THXLC', 'HEXILON 16 MG KAPLET/3X10', NULL, NULL, NULL, 9317, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TIVKA', 'IRVASK 150 MG KAPLET / 3X10', NULL, NULL, NULL, 13000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TIVKB', 'IRVASK 300 MG KAPLET / 3X10', NULL, NULL, NULL, 18200, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TIVTA', 'INVITEC 200 MCG TABLET/3x10', NULL, NULL, NULL, 14733, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TKMYK', 'KALMOXILIN 500MG KAPLET/10X10', NULL, NULL, NULL, 3380, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TKNXK', 'KALNEX 500MG TABLET/10X10', NULL, NULL, NULL, 4355, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TKOZA', 'KOMBIGLYZE 28 TAB', NULL, NULL, NULL, 17550, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TKTFA', 'KALTROFEN 50 MG TABLET/3 X 10', NULL, NULL, NULL, 2383, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TKTFB', 'KALTROFEN 100 MG TABLET/3 X 10', NULL, NULL, NULL, 5850, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TLINA', 'LIXIANA 15 MG FILCO TABLET/2X14', NULL, NULL, NULL, 31339, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TLINB', 'LIXIANA 30 MG FILCO TABLET/2X14', NULL, NULL, NULL, 31339, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TLINC', 'LIXIANA 60 MG FILCO TABLET/2X14', NULL, NULL, NULL, 31339, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TLTMA', 'LACTAMOR KAPLET/6X10', NULL, NULL, NULL, 2925, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TMTXA', 'METRIX 1 MG TABLET/2 X 15', NULL, NULL, NULL, 3683, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TMTXB', 'METRIX 2 MG TABLET/2 X 15', NULL, NULL, NULL, 6717, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TMTXC', 'METRIX 3 MG TABLET/2 X 15', NULL, NULL, NULL, 7800, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TMTXD', 'METRIX 4 MG TABLET/2 X 15', NULL, NULL, NULL, 9230, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TNRTA', 'NEUROTAM 800 MG KAPLET/5X10', NULL, NULL, NULL, 3380, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TNRTB', 'NEUROTAM 1200 MG KAPLET/5X10', NULL, NULL, NULL, 6890, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TNVRK', 'NEVOX XR 500 MG TABLET/3X10', NULL, NULL, NULL, 2860, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TONZA', 'ONGLYZA 5 MG 28 TAB', NULL, NULL, NULL, 3750, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TONZB', 'ONGLYZA 2.5 MG', NULL, NULL, NULL, 364000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TPFLA', 'PROFILAS TABLET /5X10', NULL, NULL, NULL, 4940, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TPFTA', 'PROFERTIL 50MG TABLET/1X10', NULL, NULL, NULL, 21450, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TPIMA', 'PIONIX M 15/500 MG KAPLET/30\'S', NULL, NULL, NULL, 9750, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TPIMB', 'PIONIX M 15/850 MG KAPLET/30\'S', NULL, NULL, NULL, 9750, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TPMTA', 'PREMASTON 5 MG TABLET/3X10', NULL, NULL, NULL, 5200, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TPNXA', 'PIONIX 15 MG TABLET / 30\'S', NULL, NULL, NULL, 8450, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TPNXB', 'PIONIX 30 MG TABLET / 30\'S', NULL, NULL, NULL, 13000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TRANA', 'RANTIN 150 MG TABLET/10X10', NULL, NULL, NULL, 5850, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TRLSC', 'RILLUS TABLET/5X6', NULL, NULL, NULL, 9317, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TSCNA', 'SINCRONIK KAPLET SS / 3X10', NULL, NULL, NULL, 10400, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TSLNA', 'SEROLIN 10 MG TABLET/5 X 21', NULL, NULL, NULL, 8419, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TSLNB', 'SEROLIN 30 MG TABLET/2 X 21', NULL, NULL, NULL, 16714, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TSPOA', 'SPIROLA 25 MG TABLET / 5X10', NULL, NULL, NULL, 2340, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TSPOB', 'SPIROLA 100 MG TABLET / 5X10', NULL, NULL, NULL, 6370, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TSTMA', 'STARMUNO KAPLET /3X10', NULL, NULL, NULL, 10617, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TTBRA', 'TRANSBRONCHO 30 MG TAB / 10X10', NULL, NULL, NULL, 975, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TTIVE', 'TARIVID 200 MG TABLET / 3X10', NULL, NULL, NULL, 12133, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TTIVK', 'TARIVID 400 MG TABLET / 3X10', NULL, NULL, NULL, 20367, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TTKVA', 'TKV 0.5 MG FILCO TABLET/3X10', NULL, NULL, NULL, 34667, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TTRSA', 'TORASIC 10 MG TABLET / 2X10', NULL, NULL, NULL, 6825, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TTRVD', 'TRUVAZ 10 MG TABLET/3X10', NULL, NULL, NULL, 19067, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TTRVE', 'TRUVAZ 20 MG TABLET/3X10', NULL, NULL, NULL, 20800, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TTRVF', 'TRUVAZ 40 MG TABLET/3X10', NULL, NULL, NULL, 22533, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TVBCA', 'V-BLOC 25 MG TABLET/3 X 10', NULL, NULL, NULL, 9230, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TVBCC', 'V-BLOC 6.25 MG TABLET/3 X 10', NULL, NULL, NULL, 3467, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TVCRA', 'VOMCERAN 8 MG TABLET/1 X 10', NULL, NULL, NULL, 27300, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TVCRB', 'VOMCERAN 4 MG TABLET/1 X 10', NULL, NULL, NULL, 20800, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TVMTB', 'VOMITAS FDT /5 X 10', NULL, NULL, NULL, 5330, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TZEGA', 'ZEGAVIT KAPLET / 5X10', NULL, NULL, NULL, 4160, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TZTXA', 'ZITHRAX 500 MG KAPLET/1X6', NULL, NULL, NULL, 56333, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('VBRHA', 'BROADCED HOSPITAL PACK 1G VL/1', NULL, NULL, NULL, 292500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('VBROK', 'BROADCED 1 G.I.V VIAL /1', NULL, NULL, NULL, 266500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('VBTSA', 'BACTESYN 0.75 G VIAL/1', NULL, NULL, NULL, 91000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('VBTSB', 'BACTESYN 1,5 G VIAL/1', NULL, NULL, NULL, 171500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('VCNEB', 'CERNEVIT INJEKSI / 10', NULL, NULL, NULL, 253500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('VCRVD', 'CRAVIT 750 MG FLEXYBAG 150ML/1', NULL, NULL, NULL, 481000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('VCRVE', 'CRAVIT 500 MG FLEXYBAG 100 ML / 1', NULL, NULL, NULL, 403000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('VEDNA', 'ENDROLIN PACK 3.75 MG VIAL / 1', NULL, NULL, NULL, 1592500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('VEZLA', 'EZELIN 300 IU INJEKSI 3 ML/1', NULL, NULL, NULL, 162500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('VEZMA', 'EZOMEB 40 MG INJEKSI VIAL 10 ML/1', NULL, NULL, NULL, 175500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('VKFXK', 'KALFOXIM 0.5 G VIAL/1', NULL, NULL, NULL, 104000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('VKFXP', 'KALFOXIM 1 G VIAL / 1', NULL, NULL, NULL, 195000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('VOTBA', 'OCTALBIN 5% INFUS 250 ML/1', NULL, NULL, NULL, 1625000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('VPRZA', 'PRANZA 40 MG VIAL / 1', NULL, NULL, NULL, 188500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('VRITA', 'RIBACTER 500 MG', NULL, NULL, NULL, 585000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_obat_alkes_bhp` (`kode_barang`, `nama_barang`, `id_kategori_barang`, `id_satuan_barang`, `jenis_barang`, `harga`, `id_klinik`, `dtm_crt`, `dtm_upd`, `kode_pabrik`, `id_golongan_barang`, `minimal_stok`, `deskripsi`, `indikasi`, `kandungan`, `dosis`, `kemasan`, `efek_samping`, `zat_aktif`, `etiket`, `foto_barang`, `barcode`) VALUES
('VTAZA', 'TAZAM 4.5 G INJEKSI VIAL/1', NULL, NULL, NULL, 357500, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('VTHDB', 'THIDIM 1 G VIAL / 1', NULL, NULL, NULL, 299000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('VTIVC', 'TARIVID OTIC SOLUTION / 5 ML', NULL, NULL, NULL, 104000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ' NULL ', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_obat_racikan`
--

CREATE TABLE `tbl_obat_racikan` (
  `kode_obat_racikan` varchar(25) NOT NULL,
  `nama_obat_racikan` varchar(50) NOT NULL,
  `id_kategori_barang` int(11) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_obat_racikan_child_jasa`
--

CREATE TABLE `tbl_obat_racikan_child_jasa` (
  `id_orc_jasa` int(11) NOT NULL,
  `kode_obat_racikan` varchar(15) NOT NULL,
  `kode_jasa` varchar(15) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_obat_racikan_child_obat`
--

CREATE TABLE `tbl_obat_racikan_child_obat` (
  `id_orc_obat` int(11) NOT NULL,
  `kode_obat_racikan` varchar(15) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pabrik`
--

CREATE TABLE `tbl_pabrik` (
  `kode_pabrik` varchar(15) NOT NULL,
  `nama_pabrik` varchar(50) NOT NULL,
  `alamat_pabrik` varchar(100) NOT NULL,
  `kota` varchar(25) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `npwp` varchar(30) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pabrik`
--

INSERT INTO `tbl_pabrik` (`kode_pabrik`, `nama_pabrik`, `alamat_pabrik`, `kota`, `telp`, `npwp`, `dtm_crt`, `dtm_upd`) VALUES
('PAB1573711347', 'PT Obat Sejahtera', 'jl payah kumbuh', 'sulawesi', '08998989898', '09-0909-8849', '2019-11-14 13:02:27', '2019-11-14 07:24:57'),
('PAB1624001874', 'PT Selama Bersama', 'Jalan penjaringan sari II F no 46', 'Surabaya', '082264619988', '198672453688', '2021-06-18 14:37:54', '2021-06-18 14:37:54'),
('PAB1638269278', 'PT. DEXA MEDICA INJEKSI', 'SURABAYA', 'SURABAYA', '085738296745', '67891', '2021-11-30 10:47:58', '2021-11-30 10:47:58'),
('PAB1638269381', 'PT. KALBE FARMA', 'RUNGKUT', 'SURABAYA', '085738296745', '98754', '2021-11-30 10:49:41', '2021-11-30 10:49:41'),
('PAB1638500170', 'Phapros', '-', '-', '-', '-', '2021-12-03 09:36:54', '2021-12-03 09:38:07'),
('PAB1638500193', 'Lucas Djaja', '-', '-', '-', '-', '2021-12-03 09:37:06', '2021-12-03 09:38:17'),
('PAB1638500206', 'Ethica', '-', '-', '-', '-', '2021-12-03 09:37:14', '2021-12-03 09:38:27'),
('PAB1638500215', 'Mepro', '-', '-', '-', '-', '2021-12-03 09:37:25', '2021-12-03 09:38:34'),
('PAB1638500228', 'Bernofarm', '-', '-', '-', '-', '2021-12-03 09:38:42', '2021-12-03 09:38:42'),
('PAB1638500243', 'Sanbe', '-', '-', '-', '-', '2021-12-03 09:38:57', '2021-12-03 09:38:57'),
('PAB1638500257', 'Quantum Labs', '-', '-', '-', '-', '2021-12-03 16:47:42', '2021-12-03 16:47:42'),
('PAB1638500268', 'Fahrenheit', '-', '-', '-', '-', '2021-12-03 16:47:42', '2021-12-03 16:47:42'),
('PAB1638500290', 'Mahakam Beta Farma', '-', '-', '-', '-', '2021-12-03 16:47:42', '2021-12-03 16:47:42'),
('PAB1638500527', 'Guardian Pharmatama', '-', '-', '-', '-', '2021-12-03 16:47:42', '2021-12-03 16:47:42'),
('PAB1638500536', 'Hameln', '-', '-', '-', '-', '2021-12-03 16:47:42', '2021-12-03 16:47:42'),
('PAB1638500557', 'Novell', '-', '-', '-', '-', '2021-12-03 16:47:42', '2021-12-03 16:47:42'),
('PAB1638500570', 'Kimia Farma', '-', '-', '-', '-', '2021-12-03 16:47:42', '2021-12-03 16:47:42'),
('PAB1638500623', 'Hexapharm Jaya', '-', '-', '-', '-', '2021-12-03 16:47:42', '2021-12-03 16:47:42'),
('PAB1638500640', 'Ogb Dexa', '-', '-', '-', '-', '2021-12-03 16:47:42', '2021-12-03 16:47:42'),
('PAB1638500650', 'Bernopharm', '-', '-', '-', '-', '2021-12-03 16:47:42', '2021-12-03 16:47:42'),
('PAB1638500668', 'Etercon Pharma', '-', '-', '-', '-', '2021-12-03 16:47:42', '2021-12-03 16:47:42'),
('PAB1638501021', 'Merck', '-', '-', '-', '-', '2021-12-03 16:47:42', '2021-12-03 16:47:42'),
('PAB1638501029', 'Gsk', '-', '-', '-', '-', '2021-12-03 16:47:42', '2021-12-03 16:47:42'),
('PAB1638501042', 'Interbat', '-', '-', '-', '-', '2021-12-03 16:47:42', '2021-12-03 16:47:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pasien`
--

CREATE TABLE `tbl_pasien` (
  `no_rekam_medis` varchar(10) NOT NULL,
  `no_id_pasien` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_lengkap` varchar(120) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `golongan_darah` varchar(2) NOT NULL,
  `status_menikah` varchar(20) NOT NULL,
  `pekerjaan` varchar(30) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kabupaten` varchar(30) NOT NULL,
  `rt` varchar(30) NOT NULL,
  `rw` varchar(30) NOT NULL,
  `nama_orang_tua_atau_istri` varchar(30) DEFAULT NULL,
  `nomer_telepon` varchar(20) NOT NULL,
  `riwayat_alergi_obat` text NOT NULL,
  `note_dokter` varchar(200) DEFAULT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pasien`
--

INSERT INTO `tbl_pasien` (`no_rekam_medis`, `no_id_pasien`, `nik`, `nama_lengkap`, `tanggal_lahir`, `golongan_darah`, `status_menikah`, `pekerjaan`, `alamat`, `kabupaten`, `rt`, `rw`, `nama_orang_tua_atau_istri`, `nomer_telepon`, `riwayat_alergi_obat`, `note_dokter`, `dtm_crt`, `dtm_upd`) VALUES
('000001', '000001', '35100095312690000', 'SRI AMINAH/ NY', '1969-12-13', '', 'Menikah', 'PETANI', 'DUSUN TEMUREJO KEMBIRITAN GENTENG', 'BANYUWANGI', '01', '04', 'SUKARMAN', '081333782669', 'amoxicilin dan cefixime,', NULL, '2021-12-11 06:36:09', '2021-12-13 04:59:49'),
('000002', '000002', '3306114104880004', 'WATIRAH/NY', '1988-03-01', '', 'Menikah', 'SWASTA', 'DUSUN PANDANSARI SARIMULYO CLURING', 'BANYUWANGI', '001', '002', 'NN', '087834802188', '', NULL, '2021-12-11 06:40:03', '2021-12-11 06:40:03'),
('000003', '000003', '3510021909650007', 'WAGINO/TN', '1965-09-19', '', 'Menikah', 'PETANI', 'DUSUN SUMBERJAMBE TEMUREJO BANGOREJO', 'BANYUWANGI', '001', '001', 'NN', 'NN', '', NULL, '2021-12-11 06:43:15', '2021-12-11 06:43:15'),
('000004', '000004', 'NN', 'MARJITO/TN', '2006-02-28', '', 'Belum Menikah', 'WIRASWASTA', 'LINGK. ANYAR KROBOKAN KUTA UTARA', 'BADUNG', '000', '000', 'NN', 'NN', '', NULL, '2021-12-11 06:46:03', '2021-12-11 06:46:03'),
('000005', '000005', '3510241602930002', 'DHIKA KARDINATA/SDR', '1993-02-16', '', 'Belum Menikah', 'PELAJAR', 'DUSUN KRAJAN TAMANSARI LICIN', 'BANYUWANGI', '001', '001', 'NN', '082140551114', '', NULL, '2021-12-11 06:49:42', '2021-12-11 06:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat_tinggal` varchar(200) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `pendidikan_terakhir` varchar(20) NOT NULL,
  `pelatihan` varchar(255) NOT NULL,
  `nilai_index` int(6) NOT NULL,
  `tanggal_mulai_tugas` date NOT NULL,
  `id_shift` int(11) DEFAULT NULL,
  `id_klinik` int(11) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id_pegawai`, `nama_pegawai`, `nik`, `tanggal_lahir`, `email`, `no_hp`, `alamat_tinggal`, `id_jabatan`, `pendidikan_terakhir`, `pelatihan`, `nilai_index`, `tanggal_mulai_tugas`, `id_shift`, `id_klinik`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'TITIK PUSPITASARI', '3510064302860001', '1986-02-03', 'titikpuspitasari474@gmail.com', '081332682806', 'Dsn.Trembelang RT.01 RW.04 Desa Cluring Kec.Cluring', 2, 'D3', 'APN , MU', 1, '2021-10-01', NULL, 1, '2021-12-01 04:02:50', '2021-12-01 04:02:50'),
(2, 'SULIS RISMAWATI', '3510074205890002', '1989-05-02', 'altanalkareem@gmail.com', '083111725897', 'Dsn.krajan rt.07 rw.02,Ds.jajag,Kec.Gambiran,Kab.banyuwangi', 2, 'S1', 'Asuhan Persalinan Normal,PEKERTI,Midwifery Update', 1, '2021-10-01', NULL, 1, '2021-12-01 07:09:03', '2021-12-01 07:17:48'),
(4, 'DIAN LATRI DEWI KARTIKA SARI', '3510095809940001', '1994-09-18', 'dianlatri99@gmail.com', '082331141529', 'DUSUN TEMUREJO RT 001 RW 007 DESA KEMBIRITAN KECAMATAN GENTENG KABUPATEN BANYUWANGI', 6, 'D3', 'APN', 1, '2021-10-01', NULL, 1, '2021-12-01 07:12:21', '2021-12-01 07:12:21'),
(5, 'Mohammad nur rizal usnanda', '3510093103950001', '1995-03-31', 'arizalnandadika@gmail.com', '081393283914, 083119', 'Dusun kaliputih rt 03 rw 06 desa kembiritan kecamatan genteng kabupaten banyuwangi', 11, 'SMA', '', 1, '2021-10-01', NULL, 1, '2021-12-01 07:16:24', '2021-12-01 07:16:24'),
(6, 'HARI STIYAWAN', '3510090205820015', '1982-05-02', 'HER@gmail.com', '082335969354', 'dusun pandan rt 001 rw 001 desa kembiritan kecamatan genteng kabupaten banyuwangi', 9, 'SMA', '', 1, '2021-10-01', NULL, 1, '2021-12-01 07:22:32', '2021-12-01 07:22:32'),
(7, 'Bayu setiawan', '3502050103000001', '2000-03-01', 'bayukawok9@gmail.com', '083114307795', 'Kembiritan genteng banyuwangi', 10, 'SMA', '', 1, '2021-10-01', NULL, 1, '2021-12-01 10:14:17', '2021-12-01 10:14:17'),
(8, 'Fiona Febrianti', '3510084402970002', '1997-02-04', 'febriantifiona@gmail.com', '087781305878', 'Dsn. Umbulrejo 003/007 ds. Bagorejo kec. Srono kab. Banyuwangi', 6, 'D3', 'Btcls', 1, '2021-10-01', NULL, 1, '2021-12-02 09:01:23', '2021-12-02 09:01:23'),
(9, 'Gunawan wibisono', '3509152807680001', '1968-07-28', 'Gunawanwibisono@gmail.com', '082230299417', 'Dsn. Jatisari 003/001 ds.bmo kec.blimbingsari kab.banyuwangi', 8, 'SMA', '', 1, '2021-10-01', NULL, 1, '2021-12-02 09:04:12', '2021-12-02 09:04:12'),
(10, 'Rizki hidayat', '3510112803920002', '1992-03-26', 'rizkineanculspeed012@gmail.com', '087857857057', 'Dsn. Krajan rt 03 rw 09 desa kalibaru kulon, kec. Kalibaru, kab. banyuwangi', 6, 'S1', 'BTCLS', 1, '2021-10-01', NULL, 1, '2021-12-02 11:49:44', '2021-12-02 11:49:44'),
(11, 'Ongky ramadhan', '3510111703920002', '1992-03-17', 'Ongkyramadhan121@gmail.com', '082325632686', 'Dusun Krajan rt 01 re 08 desa kalibaru kulon kecamatan kalibaru kabupaten banyuwangi', 6, 'S1', 'Vaksinator, btcls', 1, '2021-10-01', NULL, 1, '2021-12-04 02:16:53', '2021-12-04 02:17:14'),
(12, 'Laila Nur Afni', '3510054104000005', '1999-09-02', 'lailanurafni232@gmail.com', '082338587609', 'Dsn. Krajan 001/020 Ds. Tembokrejo Kec. Muncar Kab. Banyuwangi', 7, 'D3', 'BTCLS', 1, '2021-10-01', NULL, 1, '2021-12-04 02:19:30', '2021-12-04 02:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendaftaran`
--

CREATE TABLE `tbl_pendaftaran` (
  `id_pendaftaran` int(11) NOT NULL,
  `no_pendaftaran` varchar(30) NOT NULL,
  `no_rekam_medis` varchar(10) NOT NULL,
  `id_klinik` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `id_poli` int(3) NOT NULL,
  `is_periksa` int(1) NOT NULL COMMENT '0:"Dalam Antrian" , 1:"Selesai", 2:"Dibatalkan", 3:"Ditunda"',
  `is_closed` enum('0','1') NOT NULL DEFAULT '0' COMMENT '	0 = Masih Proses Periksa, 1 = Selesai Diperiksa',
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pendaftaran`
--

INSERT INTO `tbl_pendaftaran` (`id_pendaftaran`, `no_pendaftaran`, `no_rekam_medis`, `id_klinik`, `id_dokter`, `id_poli`, `is_periksa`, `is_closed`, `dtm_crt`, `dtm_upd`) VALUES
(1, '000001', '000001', 1, 3, 4, 1, '1', '2021-12-11 06:36:09', '2021-12-13 04:59:49'),
(2, '000002', '000002', 1, 3, 4, 0, '0', '2021-12-11 06:40:03', '2021-12-13 04:51:29'),
(3, '000003', '000003', 1, 5, 1, 0, '0', '2021-12-11 06:43:15', '2021-12-11 06:43:15'),
(4, '000004', '000004', 1, 5, 1, 0, '0', '2021-12-11 06:46:03', '2021-12-11 06:46:03'),
(5, '000005', '000005', 1, 3, 4, 0, '0', '2021-12-11 06:49:42', '2021-12-11 06:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_periksa`
--

CREATE TABLE `tbl_periksa` (
  `no_periksa` varchar(30) NOT NULL,
  `no_pendaftaran` varchar(30) NOT NULL,
  `no_rekam_medis` varchar(30) NOT NULL,
  `anamnesi` text NOT NULL COMMENT 'Gunakan separator ;',
  `diagnosa` text NOT NULL COMMENT 'Gunakan separator ;',
  `tindakan` text NOT NULL COMMENT 'Gunakan separator ;',
  `is_surat_ket_sakit` int(1) NOT NULL,
  `nomor_skt` varchar(18) NOT NULL,
  `tujuan_surat` varchar(60) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `lama_istirahat_surat` int(2) DEFAULT NULL,
  `id_dokter` int(11) NOT NULL,
  `note_dokter` varchar(200) DEFAULT NULL,
  `note_apoteker` text NOT NULL,
  `is_ambil_obat` int(1) NOT NULL,
  `obat_detail` text DEFAULT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_periksa`
--

INSERT INTO `tbl_periksa` (`no_periksa`, `no_pendaftaran`, `no_rekam_medis`, `anamnesi`, `diagnosa`, `tindakan`, `is_surat_ket_sakit`, `nomor_skt`, `tujuan_surat`, `tanggal_mulai`, `lama_istirahat_surat`, `id_dokter`, `note_dokter`, `note_apoteker`, `is_ambil_obat`, `obat_detail`, `dtm_crt`, `dtm_upd`) VALUES
('000001/20211213/000001', '000001', '000001', 'muntah', 'Flu', 'ADMINISTRASI PASIEN BARU', 0, '0001/12/KR/SK/21', '', NULL, 0, 3, '', '', 0, 'ALBAPURE 200ml', '2021-12-13 04:59:49', '2021-12-13 04:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_periksa_diagnosa`
--

CREATE TABLE `tbl_periksa_diagnosa` (
  `id_periksa_diagnosa` int(5) NOT NULL,
  `no_periksa` varchar(30) NOT NULL,
  `id_diagnosa` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_periksa_d_alkes`
--

CREATE TABLE `tbl_periksa_d_alkes` (
  `id_periksa_d_alkes` int(11) NOT NULL,
  `no_pendaftaran` varchar(30) NOT NULL,
  `no_periksa` varchar(30) NOT NULL,
  `kode_barang` varchar(6) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `tipe_periksa` enum('1','2','3','4','5') NOT NULL COMMENT '1= Poli, 2 = Rawat Inap, 3 = Operasi, 4 = Laboratorium, 5 = Radiologi',
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_periksa_d_biaya`
--

CREATE TABLE `tbl_periksa_d_biaya` (
  `id_periksa_d_biaya` int(11) NOT NULL,
  `no_pendaftaran` varchar(30) NOT NULL,
  `no_periksa` varchar(30) NOT NULL,
  `id_biaya` int(6) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `biaya` int(11) NOT NULL,
  `tipe_periksa` enum('1','2','3','4','5') NOT NULL COMMENT '	1= Poli, 2 = Rawat Inap, 3 = Operasi, 4 = Laboratorium, 5 = Radiologi',
  `dtm_crt` datetime NOT NULL,
  `dtm_upd` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_periksa_d_fisik`
--

CREATE TABLE `tbl_periksa_d_fisik` (
  `id_periksa_d_fisik` int(11) NOT NULL,
  `no_periksa` varchar(30) NOT NULL,
  `nama_periksa_fisik` varchar(60) NOT NULL,
  `nilai_periksa_fisik` varchar(10) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_periksa_d_fisik`
--

INSERT INTO `tbl_periksa_d_fisik` (`id_periksa_d_fisik`, `no_periksa`, `nama_periksa_fisik`, `nilai_periksa_fisik`, `dtm_crt`, `dtm_upd`) VALUES
(1, '000001/20211213/000001', 'Berat Badan', '65', '2021-12-13 04:59:49', '2021-12-13 04:59:49'),
(2, '000001/20211213/000001', 'Tinggi Badan', '174', '2021-12-13 04:59:49', '2021-12-13 04:59:49'),
(3, '000001/20211213/000001', 'Tekanan Darah', '125', '2021-12-13 04:59:49', '2021-12-13 04:59:49'),
(4, '000001/20211213/000001', 'Suhu Tubuh', '36', '2021-12-13 04:59:49', '2021-12-13 04:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_periksa_d_obat`
--

CREATE TABLE `tbl_periksa_d_obat` (
  `id_periksa_d_obat` int(11) NOT NULL,
  `no_pendaftaran` varchar(30) NOT NULL,
  `no_periksa` varchar(30) NOT NULL,
  `kode_barang` varchar(30) NOT NULL,
  `jumlah` double NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `anjuran` varchar(60) NOT NULL,
  `keterangan` varchar(60) NOT NULL,
  `penggunaan_obat` varchar(240) DEFAULT NULL,
  `is_tebus` int(1) NOT NULL,
  `tipe_periksa` enum('1','2','3','4','5') NOT NULL COMMENT '1= Poli, 2 = Rawat Inap, 3 = Operasi, 4 = Laboratorium, 5 = Radiologi',
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_periksa_d_obat`
--

INSERT INTO `tbl_periksa_d_obat` (`id_periksa_d_obat`, `no_pendaftaran`, `no_periksa`, `kode_barang`, `jumlah`, `harga_satuan`, `anjuran`, `keterangan`, `penggunaan_obat`, `is_tebus`, `tipe_periksa`, `dtm_crt`, `dtm_upd`) VALUES
(1, '', '000001/20211213/000001', 'BRG1638272332', 1, 0, '', '0', '', 0, '1', '2021-12-13 04:59:49', '2021-12-13 04:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_periksa_d_tindakan`
--

CREATE TABLE `tbl_periksa_d_tindakan` (
  `id_periksa_d_tindakan` int(11) NOT NULL,
  `no_pendaftaran` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_periksa` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_tindakan` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya` int(11) NOT NULL,
  `tipe_periksa` enum('1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1= Poli, 2 = Rawat Inap, 3 = Operasi, 4 = Laboratorium, 5 = Radiologi',
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_periksa_lab`
--

CREATE TABLE `tbl_periksa_lab` (
  `id_periksa_lab` int(5) NOT NULL,
  `no_pendaftaran` varchar(30) NOT NULL,
  `no_periksa` varchar(30) NOT NULL,
  `id_tipe` int(3) NOT NULL,
  `biaya` int(11) NOT NULL,
  `hasil` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_periksa_lab_detail`
--

CREATE TABLE `tbl_periksa_lab_detail` (
  `id_detail` int(6) NOT NULL,
  `no_periksa_lab` varchar(30) NOT NULL,
  `id_tipe` int(3) NOT NULL,
  `hasil` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_periksa_lanjutan`
--

CREATE TABLE `tbl_periksa_lanjutan` (
  `id_periksa` int(11) NOT NULL,
  `no_pendaftaran` varchar(30) NOT NULL,
  `tipe_periksa` enum('1','2','3','4','5') NOT NULL COMMENT '1= Poli, 2 = Rawat Inap, 3 = Operasi, 4 = Laboratorium, 5 = Radiologi',
  `tanggal` datetime NOT NULL,
  `is_periksa` enum('0','1','2') NOT NULL COMMENT '0 = Sudah Diperiksa, 1 = Periksa Aktif, 2 = Sedang Diperiksa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_periksa_lanjutan`
--

INSERT INTO `tbl_periksa_lanjutan` (`id_periksa`, `no_pendaftaran`, `tipe_periksa`, `tanggal`, `is_periksa`) VALUES
(1, '000001', '1', '2021-12-11 06:36:09', '1'),
(2, '000002', '1', '2021-12-11 06:40:03', '1'),
(3, '000003', '1', '2021-12-11 06:43:15', '1'),
(4, '000004', '1', '2021-12-11 06:46:03', '1'),
(5, '000005', '1', '2021-12-11 06:49:42', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_periksa_operasi`
--

CREATE TABLE `tbl_periksa_operasi` (
  `id_periksa_operasi` int(3) NOT NULL,
  `no_pendaftaran` varchar(30) NOT NULL,
  `no_periksa` varchar(30) NOT NULL,
  `id_jenis_operasi` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_periksa_radiologi`
--

CREATE TABLE `tbl_periksa_radiologi` (
  `id_periksa_radiologi` int(5) NOT NULL,
  `no_pendaftaran` varchar(30) NOT NULL,
  `no_periksa` varchar(30) NOT NULL,
  `id_tipe` int(3) NOT NULL,
  `biaya` int(11) NOT NULL,
  `hasil` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_poli`
--

CREATE TABLE `tbl_poli` (
  `id_poli` int(3) NOT NULL,
  `item` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_poli`
--

INSERT INTO `tbl_poli` (`id_poli`, `item`) VALUES
(1, 'Poli Umum'),
(2, 'Poli Gigi'),
(3, 'Poli Spesialis Penyakit Dalam'),
(4, 'Poli Spesialis Bedah Umum'),
(5, 'Poli Spesialis Orthopedi'),
(6, 'Poli Rawat Luka'),
(7, 'UGD'),
(8, 'Rawat Inap');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_potongan_gaji`
--

CREATE TABLE `tbl_potongan_gaji` (
  `id_potongan` int(11) NOT NULL,
  `potongan_bpjs` double DEFAULT NULL,
  `cicilan` double DEFAULT NULL,
  `kasbon` double DEFAULT NULL,
  `bulan` varchar(15) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profil_rumah_sakit`
--

CREATE TABLE `tbl_profil_rumah_sakit` (
  `id` int(11) NOT NULL,
  `nama_rumah_sakit` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `propinsi` varchar(30) NOT NULL,
  `kabupaten` varchar(30) NOT NULL,
  `no_telpon` varchar(30) NOT NULL,
  `logo` text NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_profil_rumah_sakit`
--

INSERT INTO `tbl_profil_rumah_sakit` (`id`, `nama_rumah_sakit`, `alamat`, `propinsi`, `kabupaten`, `no_telpon`, `logo`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'Klinik Mahottama', 'Jalan Raya Padonan, No 108, Br. Tibubeneng, Kuta Utara, 80363', 'Bali', 'Badung', '085737301424', 'logo.png', '2018-03-27 11:38:32', '2021-09-23 02:34:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchases`
--

CREATE TABLE `tbl_purchases` (
  `kode_purchase` varchar(15) NOT NULL,
  `kode_supplier` varchar(15) NOT NULL,
  `id_apoteker` int(11) NOT NULL,
  `id_klinik` int(11) NOT NULL,
  `jenis_pembayaran` varchar(15) NOT NULL,
  `is_closed` tinyint(1) NOT NULL,
  `is_receive` tinyint(1) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tanggal_po` date NOT NULL,
  `pengirim` varchar(50) DEFAULT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purchases`
--

INSERT INTO `tbl_purchases` (`kode_purchase`, `kode_supplier`, `id_apoteker`, `id_klinik`, `jenis_pembayaran`, `is_closed`, `is_receive`, `keterangan`, `total_harga`, `tanggal_po`, `pengirim`, `dtm_crt`, `dtm_upd`) VALUES
('PO1638087590', 'SUP1638087407', 1, 1, '0', 1, 1, 'Pembelian Obat', 312000, '2021-11-28', 'Driver A', '2021-11-28 15:19:50', '2021-11-28 15:19:50'),
('PO1638272515', 'SUP1638087407', 2, 1, '1', 0, 1, 'YHUHFUDHUD', 18000000, '2021-11-30', 'YONO', '2021-11-30 11:41:55', '2021-11-30 11:41:55'),
('PO1638959928', 'SUP1638869841', 2, 1, '1', 0, 1, 'YHUHFUDHUD', 1950000, '2021-12-08', 'YONO', '2021-12-08 10:38:48', '2021-12-08 10:38:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_d`
--

CREATE TABLE `tbl_purchase_d` (
  `id_purchase_d` int(11) NOT NULL,
  `kode_purchase` varchar(15) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `jumlah` double NOT NULL,
  `harga` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purchase_d`
--

INSERT INTO `tbl_purchase_d` (`id_purchase_d`, `kode_purchase`, `kode_barang`, `jumlah`, `harga`, `diskon`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'PO1638087590', 'BRG1638086758', 20, 15600, 0, '2021-11-28 15:19:50', '2021-11-28 15:19:50'),
(2, 'PO1638272515', 'BRG1638272332', 12, 2000000, 500000, '2021-11-30 11:41:55', '2021-11-30 11:41:55'),
(3, 'PO1638959928', 'BRG1638505329', 30, 65000, 0, '2021-12-08 10:38:48', '2021-12-08 10:38:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rapid_antigen`
--

CREATE TABLE `tbl_rapid_antigen` (
  `id_rapid` int(4) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `no_sampel` varchar(30) NOT NULL,
  `nik_or_passport` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat_domisili` text NOT NULL,
  `pekerjaan` varchar(150) NOT NULL,
  `alamat_bekerja` text NOT NULL,
  `keluhan` text NOT NULL,
  `komorbid` text NOT NULL,
  `alasan` text NOT NULL,
  `riwayat_vaksin` enum('Belum','Sudah') NOT NULL,
  `tgl_vaksin_1` date NOT NULL,
  `tgl_vaksin_2` date NOT NULL,
  `riwayat_kontak` enum('Ya','Tidak') NOT NULL,
  `tgl_kontak` date NOT NULL,
  `kontak_di` varchar(200) NOT NULL,
  `riwayat_swab_rapid_sebelumnya` text NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `parameter_pemeriksaan` varchar(255) NOT NULL,
  `hasil` enum('Positif','Negatif') DEFAULT NULL,
  `nilai_rujukan` enum('Positif','Negatif') DEFAULT NULL,
  `saran` text NOT NULL,
  `tgl_pemeriksaan` datetime NOT NULL,
  `tgl_buat` date NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `qr_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ref_gaji`
--

CREATE TABLE `tbl_ref_gaji` (
  `id_ref_gaji` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `gaji_pokok` double NOT NULL,
  `uang_kehadiran` double NOT NULL,
  `uang_makan` double NOT NULL,
  `uang_transport` double NOT NULL,
  `uang_lembur` double NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ref_gaji`
--

INSERT INTO `tbl_ref_gaji` (`id_ref_gaji`, `id_jabatan`, `gaji_pokok`, `uang_kehadiran`, `uang_makan`, `uang_transport`, `uang_lembur`, `dtm_crt`, `dtm_upd`) VALUES
(1, 5, 0, 28800, 0, 0, 0, '2019-11-21 15:55:47', '2021-09-23 04:26:06'),
(2, 4, 0, 10000, 7500, 2500, 0, '2019-11-21 16:13:40', '2021-09-23 04:25:50'),
(3, 3, 4000000, 250000, 500000, 500000, 0, '2019-11-22 15:44:21', '2021-12-01 07:30:29'),
(4, 1, 1000000, 125000, 250000, 250000, 0, '2019-11-25 17:58:55', '2021-12-01 07:31:32'),
(5, 2, 1000000, 125000, 250000, 250000, 0, '2019-11-27 19:16:13', '2021-12-01 07:29:40'),
(6, 9, 2000000, 0, 250000, 0, 0, '2021-09-23 11:29:14', '2021-12-01 07:31:08'),
(7, 7, 1850000, 125000, 250000, 0, 0, '2021-09-23 11:29:48', '2021-12-01 07:32:16'),
(8, 6, 1650000, 0, 0, 0, 0, '2021-09-23 11:30:06', '2021-09-23 11:30:06'),
(9, 12, 1000000, 125000, 250000, 250000, 0, '2021-12-01 07:29:06', '2021-12-01 07:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rekap_asuransi`
--

CREATE TABLE `tbl_rekap_asuransi` (
  `id_rekap_asuransi` int(11) NOT NULL,
  `no_transaksi` varchar(30) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_saldo_akun`
--

CREATE TABLE `tbl_saldo_akun` (
  `id_saldo` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `tanggal` varchar(15) NOT NULL,
  `jumlah_saldo` double NOT NULL,
  `is_updated` int(1) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_satuan_barang`
--

CREATE TABLE `tbl_satuan_barang` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(60) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_satuan_barang`
--

INSERT INTO `tbl_satuan_barang` (`id_satuan`, `nama_satuan`, `keterangan`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'btl', 'botol', '2018-03-04 21:46:41', '2018-03-04 21:46:41'),
(2, 'ampul', 'ampul', '2018-03-04 21:46:41', '2018-03-04 21:46:41'),
(3, 'box', 'box', '2018-03-04 21:46:41', '2018-03-04 21:46:41'),
(4, 'mg', 'miligram', '2018-03-04 21:46:41', '2018-03-04 21:46:41'),
(6, 'cap', 'kapsul', '2018-03-04 21:46:41', '2018-03-04 21:46:41'),
(7, 'rol 1m', 'Rol 1 Meter', '2018-03-04 21:48:53', '2018-03-04 21:48:53'),
(8, 'Pcs', 'Pcs', '2021-06-18 12:39:32', '2021-06-18 12:39:32'),
(9, 'Strip', '1 Pepel isi 10 pcs', '2021-10-04 09:48:20', '2021-10-05 01:56:01'),
(10, 'ml', 'mililitre', '2021-10-04 09:48:42', '2021-10-04 09:48:42'),
(11, 'Pkt', 'paket perawatan', '2021-10-04 16:08:09', '2021-10-05 01:55:50'),
(12, 'Infus', '', '2021-12-03 09:36:18', '2021-12-03 09:36:18'),
(13, 'Vial', '', '2021-12-03 09:36:23', '2021-12-03 09:36:23'),
(14, 'Fls', '', '2021-12-03 09:36:27', '2021-12-03 09:36:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id_setting` int(11) NOT NULL,
  `nama_setting` varchar(50) NOT NULL,
  `value` varchar(40) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id_setting`, `nama_setting`, `value`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'Tampil Menu', 'ya', '2018-03-27 10:46:50', '2018-03-27 10:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting_gaji`
--

CREATE TABLE `tbl_setting_gaji` (
  `id_setting_gaji` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `gaji_pokok` double NOT NULL,
  `uang_kehadiran` double DEFAULT NULL,
  `uang_makan` double DEFAULT NULL,
  `uang_transport` double DEFAULT NULL,
  `uang_lembur` double DEFAULT NULL,
  `potongan_telat` double DEFAULT NULL,
  `tunjangan` double DEFAULT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shift`
--

CREATE TABLE `tbl_shift` (
  `id_shift` int(11) NOT NULL,
  `nama_shift` varchar(15) NOT NULL,
  `jam_datang` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `id_klinik` int(11) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_shift`
--

INSERT INTO `tbl_shift` (`id_shift`, `nama_shift`, `jam_datang`, `jam_pulang`, `id_klinik`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'S2', '15:00:00', '21:00:00', 1, '2019-11-26 13:14:02', '2021-09-23 04:10:58'),
(2, 'S1', '14:00:00', '20:00:00', 1, '2019-11-26 13:17:05', '2021-09-23 04:10:46'),
(3, 'P2', '08:00:00', '14:00:00', 1, '2019-11-26 13:18:03', '2021-09-23 04:07:12'),
(4, 'P1', '07:00:00', '13:00:00', 1, '2019-11-26 13:18:25', '2021-09-23 04:06:50'),
(5, 'P3', '09:00:00', '15:00:00', 0, '2021-09-23 11:12:00', '2021-09-23 11:12:00'),
(6, 'P3', '09:00:00', '15:00:00', 0, '2021-09-23 11:13:09', '2021-09-23 11:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sksehat`
--

CREATE TABLE `tbl_sksehat` (
  `nomor` varchar(18) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `umur` int(2) NOT NULL,
  `pekerjaan` varchar(200) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tinggi_badan` float NOT NULL,
  `berat_badan` float NOT NULL,
  `golongan_darah` varchar(2) NOT NULL,
  `alamat` text NOT NULL,
  `buta_warna` varchar(150) NOT NULL,
  `keperluan` text NOT NULL,
  `tgl_cetak` date NOT NULL,
  `id_dokter` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_spesialis`
--

CREATE TABLE `tbl_spesialis` (
  `id_spesialis` int(11) NOT NULL,
  `spesialis` varchar(40) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_spesialis`
--

INSERT INTO `tbl_spesialis` (`id_spesialis`, `spesialis`, `dtm_crt`, `dtm_upd`) VALUES
(4, 'Umum', '2018-03-27 10:47:49', '2018-03-27 10:47:49'),
(5, 'Penyakit Dalam', '2018-03-27 10:47:49', '2018-03-27 10:47:49'),
(6, 'Gigi', '2021-09-23 09:20:20', '2021-09-23 02:20:31'),
(11, 'Spesialis Bedah', '2021-11-28 11:30:04', '2021-11-28 14:29:44'),
(12, 'Perawat', '2021-12-02 08:30:38', '2021-12-02 08:30:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status_menikah`
--

CREATE TABLE `tbl_status_menikah` (
  `id_status_menikah` int(11) NOT NULL,
  `status_menikah` varchar(30) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_status_menikah`
--

INSERT INTO `tbl_status_menikah` (`id_status_menikah`, `status_menikah`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'kawin', '2018-03-27 10:48:33', '2018-03-27 10:48:33'),
(2, 'belum kawin', '2018-03-27 10:48:33', '2018-03-27 10:48:33'),
(3, 'duda', '2018-03-27 10:48:33', '2018-03-27 10:48:33'),
(4, 'janda', '2018-03-27 10:48:33', '2018-03-27 10:48:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stok_adjustment`
--

CREATE TABLE `tbl_stok_adjustment` (
  `kode` varchar(15) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stok_adjustment_detail`
--

CREATE TABLE `tbl_stok_adjustment_detail` (
  `id_detail` int(6) NOT NULL,
  `kode` varchar(15) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `from_stok` int(7) NOT NULL,
  `to_stok` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `kode_supplier` varchar(15) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `alamat_supplier` varchar(200) NOT NULL,
  `kota` varchar(25) NOT NULL,
  `telp` varchar(25) NOT NULL,
  `npwp` varchar(25) NOT NULL,
  `no_rekening` varchar(25) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`kode_supplier`, `nama_supplier`, `alamat_supplier`, `kota`, `telp`, `npwp`, `no_rekening`, `dtm_crt`, `dtm_upd`) VALUES
('SUP1638087407', 'ALPHA', 'Banyuwangi', 'Banyuwangi', '083', '123456', '456789', '2021-11-28 15:16:47', '2021-11-28 15:16:47'),
('SUP1638869025', 'BINA SAN PRIMA (BSP)', 'JALAN LETJEN SUTOYO NO.138, KRAJAN, KRANJINGAN, KECAMATAN SUMBERSARI, KABUPATEN JEMBER', 'JEMBER', '08112047418', '000', '000', '2021-12-07 09:23:45', '2021-12-07 09:23:45'),
('SUP1638869394', 'ENSEVAL PUTERA MEGATRADING', 'JALAN MOLTER NONGSINSIDI NO.889 JEMBER', 'JEMBER', '(0331) 335000', '01.342.572.3-054.000', '1. MANDIRI VA (8800701301', '2021-12-07 09:29:54', '2021-12-07 09:30:59'),
('SUP1638869841', 'MITRA MEDITAMA ABADI', 'JALAN SIMPANG DANAU LIMBOTO TIMUR II A5-I 32', 'MALANG', '0', '31.310.458.0-623.000', 'BCA (318.319.777)', '2021-12-07 09:37:21', '2021-12-07 09:37:21'),
('SUP1638870114', 'SURGIKA ALKESINDO', 'JALAN LETJEN SUPRAPTO NO. 60 GEDUNG INDRA SENTRAL UNIT G-H', 'JAKARTA PUSAT', '(021) 425 3634', '94.231.534.2-627.000', 'BNI (016 361 126 5)', '2021-12-07 09:41:54', '2021-12-07 09:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tindakan`
--

CREATE TABLE `tbl_tindakan` (
  `kode_tindakan` varchar(8) NOT NULL,
  `tindakan` varchar(150) NOT NULL,
  `biaya` int(11) NOT NULL,
  `id_kategori` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tindakan`
--

INSERT INTO `tbl_tindakan` (`kode_tindakan`, `tindakan`, `biaya`, `id_kategori`) VALUES
('A1', 'ADMINISTRASI PASIEN BARU', 45000, 5),
('A2', 'ADMINISTRASI PASIEN LAMA', 25000, 5),
('B1', 'PEMERIKSAAN', 25000, 6),
('B10', 'PASANG RECTAL TUBE', 25000, 6),
('B11', 'AFF RECTAL TUBE', 25000, 6),
('B12', 'PASANG DRAIN', 25000, 6),
('B13', 'AFF DRAIN', 25000, 6),
('B14', 'PASANG KATETER', 25000, 6),
('B15', 'KONSUL DOKTER UMUM', 100000, 6),
('B16', 'KONSUL DOKTER SPESIALIS', 150000, 6),
('B17', 'RUJUKAN AMBULANCE DALAM KOTA  - JARAK &lt; 5 KM DARI KLINIK', 300000, 6),
('B18', 'RUJUKAN AMBULANCE LUAR KOTA - JEMBER', 1500000, 6),
('B19', 'RUJUKAN AMBULANCE LUAR KOTA - MALANG', 2500000, 6),
('B2', 'PASANG INFUS', 5000, 6),
('B20', 'RUJUKAN AMBULANCE LUAR KOTA - SURABAYA', 2500000, 6),
('B3', 'INJEKSI/OBAT', 5000, 6),
('B4', 'HECTING &lt; 5 CM', 100000, 6),
('B5', 'HECTING &lt; 5 - 10 CM', 250000, 6),
('B6', 'RAWAT LUKA SEDERHANA', 125000, 6),
('B7', 'RAWAT LUKA SEDANG', 250000, 6),
('B8', 'PASANG NGT', 25000, 6),
('B9', 'AFF NGT', 25000, 6),
('C1', 'PEMERIKSAAN POLI UMUM', 75000, 7),
('C10', 'RAWAT LUKA POST OP', 35000, 7),
('C2', 'PEMERIKSAAN POLI SPESIALIS', 100000, 7),
('C3', 'RAWAT LUKA  RINGAN - POLI', 200000, 7),
('C4', 'RAWAT LUKA SEDANG - POLI', 300000, 7),
('C5', 'RAWAT LUKA BERAT - POLI', 400000, 7),
('C6', 'ANGKAT JAHITAN', 15000, 7),
('C7', 'GANTI KATETER', 25000, 7),
('C8', 'ASPIRASI SEROMA', 100000, 7),
('C9', 'INCISI ABSES', 100000, 7),
('E1', 'OP. RINGAN', 2500000, 9),
('E2', 'OP. SEDANG', 3000000, 9),
('E3', 'OP. BERAT', 4000000, 9),
('E4', 'OP. KHUSUS', 5000000, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tipe_periksa_jasa`
--

CREATE TABLE `tbl_tipe_periksa_jasa` (
  `id_tipe` int(3) NOT NULL,
  `item` varchar(255) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tipe_periksa_jasa`
--

INSERT INTO `tbl_tipe_periksa_jasa` (`id_tipe`, `item`, `harga`) VALUES
(1, 'JASA OPERATOR OP. RINGAN', 2500000),
(2, 'JASA OPERATOR OP. SEDANG', 3000000),
(3, 'JASA OPERATOR OP. BERAT', 4000000),
(4, 'JASA OPERATOR OP. KHUSUS', 5000000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tipe_periksa_lab`
--

CREATE TABLE `tbl_tipe_periksa_lab` (
  `id_tipe` int(3) NOT NULL,
  `item` varchar(200) NOT NULL,
  `id_kategori` int(3) NOT NULL,
  `harga` int(9) NOT NULL,
  `nilai_normal` text NOT NULL,
  `diet` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tipe_periksa_lab`
--

INSERT INTO `tbl_tipe_periksa_lab` (`id_tipe`, `item`, `id_kategori`, `harga`, `nilai_normal`, `diet`) VALUES
(1, 'Hemoglobin', 0, 100000, 'L:13, 4-17,7,P:11,4-15,1 g/dl', ''),
(2, 'DL', 0, 104000, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tipe_periksa_radiologi`
--

CREATE TABLE `tbl_tipe_periksa_radiologi` (
  `id_tipe` int(3) NOT NULL,
  `item` varchar(200) NOT NULL,
  `id_kategori` int(3) NOT NULL,
  `harga` int(9) NOT NULL,
  `nilai_normal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tipe_periksa_radiologi`
--

INSERT INTO `tbl_tipe_periksa_radiologi` (`id_tipe`, `item`, `id_kategori`, `harga`, `nilai_normal`) VALUES
(1, 'Radiologi', 0, 100000, '2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` bigint(20) NOT NULL,
  `kode_transaksi` varchar(20) NOT NULL,
  `id_klinik` int(11) NOT NULL,
  `no_transaksi` varchar(30) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `status_transaksi` int(2) NOT NULL,
  `atas_nama` varchar(60) DEFAULT NULL,
  `cara_pembayaran` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1 = Tunai, 2 = Transfer',
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `kode_transaksi`, `id_klinik`, `no_transaksi`, `tgl_transaksi`, `status_transaksi`, `atas_nama`, `cara_pembayaran`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'PRKS', 1, '1/20211128/1', '2021-11-28', 0, NULL, '1', '2021-11-28 15:22:40', '2021-11-28 15:22:40'),
(2, 'PRKS', 1, '2/20211128/000723', '2021-11-28', 0, NULL, '1', '2021-11-28 15:27:31', '2021-11-28 15:27:31'),
(3, 'TRXOBAT', 1, 'TRXOBAT000001', '2021-12-13', 1, 'HANIFA', '1', '2021-12-13 04:28:44', '2021-12-13 11:33:41'),
(4, 'TRXOBAT', 1, 'TRXOBAT000002', '2021-12-13', 1, 'HANIFA', '1', '2021-12-13 04:32:33', '2021-12-13 11:36:03'),
(5, 'PRKS', 1, '000001/20211213/000001', '2021-12-13', 0, NULL, '1', '2021-12-13 04:59:49', '2021-12-13 04:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi_d`
--

CREATE TABLE `tbl_transaksi_d` (
  `id_transaksi_d` bigint(20) NOT NULL,
  `no_transaksi` varchar(30) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `amount_transaksi` bigint(20) NOT NULL,
  `dc` varchar(2) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi_d`
--

INSERT INTO `tbl_transaksi_d` (`id_transaksi_d`, `no_transaksi`, `deskripsi`, `amount_transaksi`, `dc`, `dtm_crt`, `dtm_upd`) VALUES
(1, '1/20211128/1', 'Total Obat-obatan', 15600, 'd', '2021-11-28 15:22:40', '2021-11-28 15:22:40'),
(2, '1/20211128/1', 'Subsidi Obat-obatan', 0, 'c', '2021-11-28 15:22:40', '2021-11-28 15:22:40'),
(3, '1/20211128/1', 'Biaya Pemeriksaan', 10000, 'd', '2021-11-28 15:22:40', '2021-11-28 15:22:40'),
(4, '1/20211128/1', 'Biaya Tindakan Perawatan', 10000, 'd', '2021-11-28 15:22:40', '2021-11-28 15:22:40'),
(5, '2/20211128/000723', 'Total Obat-obatan', 15600, 'd', '2021-11-28 15:27:31', '2021-11-28 15:27:31'),
(6, '2/20211128/000723', 'Subsidi Obat-obatan', 0, 'c', '2021-11-28 15:27:31', '2021-11-28 15:27:31'),
(7, '2/20211128/000723', 'Biaya Pemeriksaan', 10000, 'd', '2021-11-28 15:27:31', '2021-11-28 15:27:31'),
(8, '2/20211128/000723', 'Biaya Tindakan Perawatan', 10000, 'd', '2021-11-28 15:27:31', '2021-11-28 15:27:31'),
(9, 'TRXOBAT000001', 'Total Obat-obatan', 1550000, 'd', '2021-12-13 04:28:44', '2021-12-13 04:28:44'),
(10, 'TRXOBAT000002', 'Total Obat-obatan', 1550000, 'd', '2021-12-13 04:32:33', '2021-12-13 04:32:33'),
(11, 'TRXOBAT000001', 'Subsidi dari Kasir', 0, 'c', '2021-12-13 04:33:41', '2021-12-13 04:33:41'),
(12, 'TRXOBAT000001', 'Pembayaran Biaya Medis', 1550000, 'c', '2021-12-13 04:33:41', '2021-12-13 04:33:41'),
(13, 'TRXOBAT000002', 'Subsidi dari Kasir', 0, 'c', '2021-12-13 04:36:03', '2021-12-13 04:36:03'),
(14, 'TRXOBAT000002', 'Pembayaran Biaya Medis', 1550000, 'c', '2021-12-13 04:36:03', '2021-12-13 04:36:03'),
(15, '000001/20211213/000001', 'Total Obat-obatan', 1500000, 'd', '2021-12-13 04:59:49', '2021-12-13 04:59:49'),
(16, '000001/20211213/000001', 'Total BMHP', 0, 'd', '2021-12-13 04:59:49', '2021-12-13 04:59:49'),
(17, '000001/20211213/000001', 'Subsidi Obat-obatan', 0, 'c', '2021-12-13 04:59:49', '2021-12-13 04:59:49'),
(18, '000001/20211213/000001', 'Biaya Pemeriksaan', 0, 'd', '2021-12-13 04:59:49', '2021-12-13 04:59:49'),
(19, '000001/20211213/000001', 'Biaya Tindakan ', 0, 'd', '2021-12-13 04:59:49', '2021-12-13 04:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi_d_obat`
--

CREATE TABLE `tbl_transaksi_d_obat` (
  `id_transaksi_d_obat` int(11) NOT NULL,
  `no_transaksi` varchar(30) NOT NULL,
  `kode_barang` varchar(30) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi_d_obat`
--

INSERT INTO `tbl_transaksi_d_obat` (`id_transaksi_d_obat`, `no_transaksi`, `kode_barang`, `jumlah`, `harga`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'TRXOBAT000001', 'BRG1638505329', 1, 50000, '2021-12-13 04:28:44', '2021-12-13 04:28:44'),
(2, 'TRXOBAT000001', 'BRG1638272332', 1, 1500000, '2021-12-13 04:28:44', '2021-12-13 04:28:44'),
(3, 'TRXOBAT000002', 'BRG1638272332', 1, 1500000, '2021-12-13 04:32:33', '2021-12-13 04:32:33'),
(4, 'TRXOBAT000002', 'BRG1638505329', 1, 50000, '2021-12-13 04:32:33', '2021-12-13 04:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trx_akuntansi`
--

CREATE TABLE `tbl_trx_akuntansi` (
  `id_trx_akun` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `dtm_crt` datetime DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_trx_akuntansi`
--

INSERT INTO `tbl_trx_akuntansi` (`id_trx_akun`, `deskripsi`, `tanggal`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'Pembelian Barang dengan Kode PO1638087590', '2021-11-28', '2021-11-28 15:20:24', '2021-11-28 15:20:24'),
(2, 'Penjualan Obat dari Nomor Pemeriksaan 1/20211128/1', '2021-11-28', '2021-11-28 15:22:40', '2021-11-28 15:22:40'),
(3, 'Penjualan Obat dari Nomor Pemeriksaan 2/20211128/000723', '2021-11-28', '2021-11-28 15:27:31', '2021-11-28 15:27:31'),
(4, 'Pembelian Barang dengan Kode PO1638272515', '2021-11-30', '2021-11-30 11:43:09', '2021-11-30 11:43:09'),
(5, 'Pembelian Barang dengan Kode PO1638959928', '2021-12-08', '2021-12-08 10:41:28', '2021-12-08 10:41:28'),
(6, 'Penjualan Obat dengan Kode Transaksi TRXOBAT000001', '2021-12-13', '2021-12-13 04:28:44', '2021-12-13 04:28:44'),
(7, 'Penjualan Obat dengan Kode Transaksi TRXOBAT000002', '2021-12-13', '2021-12-13 04:32:33', '2021-12-13 04:32:33'),
(8, 'Penjualan BMHP dari Nomor Pemeriksaan 000001/20211213/000001', '2021-12-13', '2021-12-13 04:59:49', '2021-12-13 04:59:49'),
(9, 'Penjualan Obat dari Nomor Pemeriksaan 000001/20211213/000001', '2021-12-13', '2021-12-13 04:59:49', '2021-12-13 04:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trx_akuntansi_detail`
--

CREATE TABLE `tbl_trx_akuntansi_detail` (
  `id_trx_akun_detail` int(11) NOT NULL,
  `id_trx_akun` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `jumlah` double NOT NULL,
  `tipe` varchar(10) NOT NULL,
  `keterangan` varchar(15) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_trx_akuntansi_detail`
--

INSERT INTO `tbl_trx_akuntansi_detail` (`id_trx_akun_detail`, `id_trx_akun`, `id_akun`, `jumlah`, `tipe`, `keterangan`, `dtm_crt`, `dtm_upd`) VALUES
(1, 1, 58, 312000, 'DEBIT', 'akun', '2021-11-28 15:20:24', '2021-11-28 15:20:24'),
(2, 1, 65, 312000, 'DEBIT', 'lawan', '2021-11-28 15:20:24', '2021-11-28 15:20:24'),
(3, 1, 20, 312000, 'KREDIT', 'lawan', '2021-11-28 15:20:24', '2021-11-28 15:20:24'),
(4, 2, 20, 15600, 'DEBIT', 'lawan', '2021-11-28 15:22:40', '2021-11-28 15:22:40'),
(5, 2, 65, 15600, 'DEBIT', 'lawan', '2021-11-28 15:22:40', '2021-11-28 15:22:40'),
(6, 2, 58, 15600, 'KREDIT', 'akun', '2021-11-28 15:22:40', '2021-11-28 15:22:40'),
(7, 2, 39, 15600, 'KREDIT', 'akun', '2021-11-28 15:22:40', '2021-11-28 15:22:40'),
(8, 2, 64, 0, 'DEBIT', 'akun', '2021-11-28 15:22:40', '2021-11-28 15:22:40'),
(9, 3, 20, 15600, 'DEBIT', 'lawan', '2021-11-28 15:27:31', '2021-11-28 15:27:31'),
(10, 3, 65, 15600, 'DEBIT', 'lawan', '2021-11-28 15:27:31', '2021-11-28 15:27:31'),
(11, 3, 58, 15600, 'KREDIT', 'akun', '2021-11-28 15:27:31', '2021-11-28 15:27:31'),
(12, 3, 39, 15600, 'KREDIT', 'akun', '2021-11-28 15:27:31', '2021-11-28 15:27:31'),
(13, 3, 64, 0, 'DEBIT', 'akun', '2021-11-28 15:27:31', '2021-11-28 15:27:31'),
(14, 4, 58, 24000000, 'DEBIT', 'akun', '2021-11-30 11:43:09', '2021-11-30 11:43:09'),
(15, 4, 45, 6000000, 'KREDIT', 'akun', '2021-11-30 11:43:09', '2021-11-30 11:43:09'),
(16, 4, 65, 18000000, 'DEBIT', 'lawan', '2021-11-30 11:43:09', '2021-11-30 11:43:09'),
(17, 4, 109, 18000000, 'KREDIT', 'lawan', '2021-11-30 11:43:09', '2021-11-30 11:43:09'),
(18, 5, 58, 1950000, 'DEBIT', 'akun', '2021-12-08 10:41:28', '2021-12-08 10:41:28'),
(19, 5, 65, 1950000, 'DEBIT', 'lawan', '2021-12-08 10:41:28', '2021-12-08 10:41:28'),
(20, 5, 109, 1950000, 'KREDIT', 'lawan', '2021-12-08 10:41:28', '2021-12-08 10:41:28'),
(21, 6, 39, 1550000, 'KREDIT', 'akun', '2021-12-13 04:28:44', '2021-12-13 04:28:44'),
(22, 6, 58, 1565000, 'KREDIT', 'akun', '2021-12-13 04:28:44', '2021-12-13 04:28:44'),
(23, 6, 46, 0, 'DEBIT', 'akun', '2021-12-13 04:28:44', '2021-12-13 04:28:44'),
(24, 6, 20, 1550000, 'DEBIT', 'lawan', '2021-12-13 04:28:44', '2021-12-13 04:28:44'),
(25, 6, 65, 1565000, 'DEBIT', 'lawan', '2021-12-13 04:28:44', '2021-12-13 04:28:44'),
(26, 7, 39, 1550000, 'KREDIT', 'akun', '2021-12-13 04:32:33', '2021-12-13 04:32:33'),
(27, 7, 58, 1565000, 'KREDIT', 'akun', '2021-12-13 04:32:33', '2021-12-13 04:32:33'),
(28, 7, 46, 0, 'DEBIT', 'akun', '2021-12-13 04:32:33', '2021-12-13 04:32:33'),
(29, 7, 20, 1550000, 'DEBIT', 'lawan', '2021-12-13 04:32:33', '2021-12-13 04:32:33'),
(30, 7, 65, 1565000, 'DEBIT', 'lawan', '2021-12-13 04:32:33', '2021-12-13 04:32:33'),
(31, 8, 20, 0, 'DEBIT', 'lawan', '2021-12-13 04:59:49', '2021-12-13 04:59:49'),
(32, 8, 65, 0, 'DEBIT', 'lawan', '2021-12-13 04:59:49', '2021-12-13 04:59:49'),
(33, 8, 59, 0, 'KREDIT', 'akun', '2021-12-13 04:59:49', '2021-12-13 04:59:49'),
(34, 8, 41, 0, 'KREDIT', 'akun', '2021-12-13 04:59:49', '2021-12-13 04:59:49'),
(35, 9, 20, 1500000, 'DEBIT', 'lawan', '2021-12-13 04:59:49', '2021-12-13 04:59:49'),
(36, 9, 65, 1500000, 'DEBIT', 'lawan', '2021-12-13 04:59:49', '2021-12-13 04:59:49'),
(37, 9, 58, 1500000, 'KREDIT', 'akun', '2021-12-13 04:59:49', '2021-12-13 04:59:49'),
(38, 9, 39, 1500000, 'KREDIT', 'akun', '2021-12-13 04:59:49', '2021-12-13 04:59:49'),
(39, 9, 64, 0, 'DEBIT', 'akun', '2021-12-13 04:59:49', '2021-12-13 04:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_users` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `images` text NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL,
  `id_dokter` int(11) NOT NULL COMMENT 'Jika user_level merupakan dokter',
  `id_pegawai` int(11) NOT NULL COMMENT 'jika user adalah pegawai',
  `id_apoteker` int(11) NOT NULL COMMENT 'jika user adalah apoteker',
  `id_klinik` int(11) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp(),
  `usr_upd` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_users`, `full_name`, `email`, `password`, `images`, `id_user_level`, `is_aktif`, `id_dokter`, `id_pegawai`, `id_apoteker`, `id_klinik`, `dtm_crt`, `dtm_upd`, `usr_upd`) VALUES
(1, 'Super Admin', 'super.admin@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '-', 1, 'y', 0, 0, 0, 1, '2021-09-29 14:21:00', '2021-09-29 14:21:00', 'null'),
(18, 'Pendaftaran', 'pendaftaran@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 4, 'y', 0, 0, 0, 1, '2021-11-28 12:12:40', '2021-11-28 12:12:40', NULL),
(19, 'accounting', 'accounting@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 7, 'y', 0, 0, 0, 1, '2021-11-28 12:15:06', '2021-11-28 12:15:06', NULL),
(20, 'billing', 'billing@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 8, 'y', 0, 0, 0, 1, '2021-11-28 12:16:58', '2021-11-28 12:16:58', NULL),
(22, 'Poli', 'poli@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 10, 'y', 0, 0, 0, 1, '2021-11-28 12:41:17', '2021-11-28 12:41:17', NULL),
(23, 'Dr. Indah', 'dr.indah@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 5, 'y', 4, 0, 0, 1, '2021-11-28 12:48:41', '2021-11-29 09:51:20', 'pendaftaran@gmail.com'),
(24, 'Apotek', 'apotek@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 3, 'y', 0, 0, 0, 1, '2021-11-28 15:14:15', '2021-11-28 14:43:21', NULL),
(25, 'dr. NYOMAN WIRA SWASTIKA, Sp.B', 'drwira@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 5, 'y', 3, 0, 0, 1, '2021-11-29 10:54:49', '2021-11-29 10:59:47', NULL),
(26, 'dr. ROBBY', 'dr.robby@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 5, 'y', 5, 0, 0, 1, '2021-11-29 11:01:22', '2021-11-29 11:01:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_level`
--

CREATE TABLE `tbl_user_level` (
  `id_user_level` int(11) NOT NULL,
  `nama_level` varchar(30) NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_level`
--

INSERT INTO `tbl_user_level` (`id_user_level`, `nama_level`, `dtm_crt`, `dtm_upd`) VALUES
(1, 'Super Admin', '2018-03-27 10:49:30', '2018-03-27 10:49:30'),
(3, 'Petugas Apotek', '2018-03-27 10:49:30', '2018-05-10 19:17:58'),
(4, 'Pendaftaran', '2018-03-27 10:49:30', '2018-03-27 10:49:30'),
(5, 'Dokter', '2018-03-27 10:49:30', '2018-03-27 10:49:30'),
(6, 'HRD', '2019-11-26 09:25:50', '2019-11-26 09:25:50'),
(7, 'Accounting', '2019-11-26 09:28:18', '2019-11-26 09:28:18'),
(8, 'Billing', '2019-12-13 09:14:04', '2019-12-13 09:14:04'),
(9, 'Nakes', '2021-09-29 10:48:24', '2021-09-29 10:48:24'),
(10, 'Poli', '2021-11-28 12:40:50', '2021-11-28 12:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wilayah`
--

CREATE TABLE `tbl_wilayah` (
  `kode` varchar(13) NOT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alkes_kontrol_kehamilan`
--
ALTER TABLE `alkes_kontrol_kehamilan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alkes_periksa_lab`
--
ALTER TABLE `alkes_periksa_lab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alkes_periksa_rapid`
--
ALTER TABLE `alkes_periksa_rapid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `last_sync`
--
ALTER TABLE `last_sync`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `no_sync_table`
--
ALTER TABLE `no_sync_table`
  ADD PRIMARY KEY (`table_name`);

--
-- Indexes for table `tbl_absensi_pegawai`
--
ALTER TABLE `tbl_absensi_pegawai`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `tbl_agama`
--
ALTER TABLE `tbl_agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `tbl_akun_detail`
--
ALTER TABLE `tbl_akun_detail`
  ADD PRIMARY KEY (`id_akun_d`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indexes for table `tbl_apoteker`
--
ALTER TABLE `tbl_apoteker`
  ADD PRIMARY KEY (`id_apoteker`);

--
-- Indexes for table `tbl_biaya`
--
ALTER TABLE `tbl_biaya`
  ADD PRIMARY KEY (`id_biaya`);

--
-- Indexes for table `tbl_bidang`
--
ALTER TABLE `tbl_bidang`
  ADD PRIMARY KEY (`id_bidang`);

--
-- Indexes for table `tbl_departemen`
--
ALTER TABLE `tbl_departemen`
  ADD PRIMARY KEY (`id_departemen`);

--
-- Indexes for table `tbl_diagnosa_icd10`
--
ALTER TABLE `tbl_diagnosa_icd10`
  ADD PRIMARY KEY (`id_diagnosa`);

--
-- Indexes for table `tbl_diskon_trx`
--
ALTER TABLE `tbl_diskon_trx`
  ADD PRIMARY KEY (`id_diskon_trx`);

--
-- Indexes for table `tbl_dokter`
--
ALTER TABLE `tbl_dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD KEY `id_agama` (`id_agama`),
  ADD KEY `id_spesialis` (`id_spesialis`);

--
-- Indexes for table `tbl_golongan_barang`
--
ALTER TABLE `tbl_golongan_barang`
  ADD PRIMARY KEY (`id_golongan_barang`);

--
-- Indexes for table `tbl_gudang`
--
ALTER TABLE `tbl_gudang`
  ADD PRIMARY KEY (`kode_gudang`);

--
-- Indexes for table `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_imunisasi`
--
ALTER TABLE `tbl_imunisasi`
  ADD PRIMARY KEY (`no_rekam_medis`);

--
-- Indexes for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD PRIMARY KEY (`id_inventory`),
  ADD KEY `kode_purchase` (`kode_purchase`);

--
-- Indexes for table `tbl_inventory_detail`
--
ALTER TABLE `tbl_inventory_detail`
  ADD PRIMARY KEY (`id_inventory_detail`),
  ADD KEY `id_inventory` (`id_inventory`);

--
-- Indexes for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `tbl_jasa`
--
ALTER TABLE `tbl_jasa`
  ADD PRIMARY KEY (`kode_jasa`);

--
-- Indexes for table `tbl_jenis_operasi`
--
ALTER TABLE `tbl_jenis_operasi`
  ADD PRIMARY KEY (`id_jenis_operasi`);

--
-- Indexes for table `tbl_jenjang_pendidikan`
--
ALTER TABLE `tbl_jenjang_pendidikan`
  ADD PRIMARY KEY (`id_jenjang_pendidikan`);

--
-- Indexes for table `tbl_kamar`
--
ALTER TABLE `tbl_kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `tbl_kartu_hutang`
--
ALTER TABLE `tbl_kartu_hutang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kategori_barang`
--
ALTER TABLE `tbl_kategori_barang`
  ADD PRIMARY KEY (`id_kategori_barang`);

--
-- Indexes for table `tbl_kategori_biaya`
--
ALTER TABLE `tbl_kategori_biaya`
  ADD PRIMARY KEY (`id_kategori_biaya`);

--
-- Indexes for table `tbl_kategori_kamar`
--
ALTER TABLE `tbl_kategori_kamar`
  ADD PRIMARY KEY (`id_kategori_kamar`);

--
-- Indexes for table `tbl_kategori_periksa_lab_radiologi`
--
ALTER TABLE `tbl_kategori_periksa_lab_radiologi`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_kategori_tindakan`
--
ALTER TABLE `tbl_kategori_tindakan`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_klinik`
--
ALTER TABLE `tbl_klinik`
  ADD PRIMARY KEY (`id_klinik`);

--
-- Indexes for table `tbl_komisi_dokter`
--
ALTER TABLE `tbl_komisi_dokter`
  ADD PRIMARY KEY (`id_komisi`);

--
-- Indexes for table `tbl_kontrol_kehamilan`
--
ALTER TABLE `tbl_kontrol_kehamilan`
  ADD PRIMARY KEY (`id_kontrol`);

--
-- Indexes for table `tbl_lokasi_barang`
--
ALTER TABLE `tbl_lokasi_barang`
  ADD PRIMARY KEY (`id_lokasi_barang`);

--
-- Indexes for table `tbl_manufaktur`
--
ALTER TABLE `tbl_manufaktur`
  ADD PRIMARY KEY (`kode_manufaktur`);

--
-- Indexes for table `tbl_manufaktur_detail`
--
ALTER TABLE `tbl_manufaktur_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `tbl_master_reference`
--
ALTER TABLE `tbl_master_reference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_master_sequence`
--
ALTER TABLE `tbl_master_sequence`
  ADD PRIMARY KEY (`id_master_sequence`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `tbl_obat_alkes_bhp`
--
ALTER TABLE `tbl_obat_alkes_bhp`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `tbl_obat_racikan`
--
ALTER TABLE `tbl_obat_racikan`
  ADD PRIMARY KEY (`kode_obat_racikan`);

--
-- Indexes for table `tbl_obat_racikan_child_jasa`
--
ALTER TABLE `tbl_obat_racikan_child_jasa`
  ADD PRIMARY KEY (`id_orc_jasa`);

--
-- Indexes for table `tbl_obat_racikan_child_obat`
--
ALTER TABLE `tbl_obat_racikan_child_obat`
  ADD PRIMARY KEY (`id_orc_obat`);

--
-- Indexes for table `tbl_pabrik`
--
ALTER TABLE `tbl_pabrik`
  ADD PRIMARY KEY (`kode_pabrik`);

--
-- Indexes for table `tbl_pasien`
--
ALTER TABLE `tbl_pasien`
  ADD PRIMARY KEY (`no_rekam_medis`);

--
-- Indexes for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- Indexes for table `tbl_periksa`
--
ALTER TABLE `tbl_periksa`
  ADD PRIMARY KEY (`no_periksa`);

--
-- Indexes for table `tbl_periksa_diagnosa`
--
ALTER TABLE `tbl_periksa_diagnosa`
  ADD PRIMARY KEY (`id_periksa_diagnosa`);

--
-- Indexes for table `tbl_periksa_d_alkes`
--
ALTER TABLE `tbl_periksa_d_alkes`
  ADD PRIMARY KEY (`id_periksa_d_alkes`);

--
-- Indexes for table `tbl_periksa_d_biaya`
--
ALTER TABLE `tbl_periksa_d_biaya`
  ADD PRIMARY KEY (`id_periksa_d_biaya`);

--
-- Indexes for table `tbl_periksa_d_fisik`
--
ALTER TABLE `tbl_periksa_d_fisik`
  ADD PRIMARY KEY (`id_periksa_d_fisik`);

--
-- Indexes for table `tbl_periksa_d_obat`
--
ALTER TABLE `tbl_periksa_d_obat`
  ADD PRIMARY KEY (`id_periksa_d_obat`);

--
-- Indexes for table `tbl_periksa_d_tindakan`
--
ALTER TABLE `tbl_periksa_d_tindakan`
  ADD PRIMARY KEY (`id_periksa_d_tindakan`);

--
-- Indexes for table `tbl_periksa_lab`
--
ALTER TABLE `tbl_periksa_lab`
  ADD PRIMARY KEY (`id_periksa_lab`);

--
-- Indexes for table `tbl_periksa_lab_detail`
--
ALTER TABLE `tbl_periksa_lab_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `tbl_periksa_lanjutan`
--
ALTER TABLE `tbl_periksa_lanjutan`
  ADD PRIMARY KEY (`id_periksa`);

--
-- Indexes for table `tbl_periksa_operasi`
--
ALTER TABLE `tbl_periksa_operasi`
  ADD PRIMARY KEY (`id_periksa_operasi`);

--
-- Indexes for table `tbl_periksa_radiologi`
--
ALTER TABLE `tbl_periksa_radiologi`
  ADD PRIMARY KEY (`id_periksa_radiologi`);

--
-- Indexes for table `tbl_poli`
--
ALTER TABLE `tbl_poli`
  ADD PRIMARY KEY (`id_poli`);

--
-- Indexes for table `tbl_potongan_gaji`
--
ALTER TABLE `tbl_potongan_gaji`
  ADD PRIMARY KEY (`id_potongan`);

--
-- Indexes for table `tbl_profil_rumah_sakit`
--
ALTER TABLE `tbl_profil_rumah_sakit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_purchases`
--
ALTER TABLE `tbl_purchases`
  ADD PRIMARY KEY (`kode_purchase`);

--
-- Indexes for table `tbl_purchase_d`
--
ALTER TABLE `tbl_purchase_d`
  ADD PRIMARY KEY (`id_purchase_d`),
  ADD KEY `kode_purchase` (`kode_purchase`);

--
-- Indexes for table `tbl_rapid_antigen`
--
ALTER TABLE `tbl_rapid_antigen`
  ADD PRIMARY KEY (`id_rapid`);

--
-- Indexes for table `tbl_ref_gaji`
--
ALTER TABLE `tbl_ref_gaji`
  ADD PRIMARY KEY (`id_ref_gaji`);

--
-- Indexes for table `tbl_rekap_asuransi`
--
ALTER TABLE `tbl_rekap_asuransi`
  ADD PRIMARY KEY (`id_rekap_asuransi`);

--
-- Indexes for table `tbl_saldo_akun`
--
ALTER TABLE `tbl_saldo_akun`
  ADD PRIMARY KEY (`id_saldo`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indexes for table `tbl_satuan_barang`
--
ALTER TABLE `tbl_satuan_barang`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `tbl_setting_gaji`
--
ALTER TABLE `tbl_setting_gaji`
  ADD PRIMARY KEY (`id_setting_gaji`);

--
-- Indexes for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  ADD PRIMARY KEY (`id_shift`);

--
-- Indexes for table `tbl_sksehat`
--
ALTER TABLE `tbl_sksehat`
  ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `tbl_spesialis`
--
ALTER TABLE `tbl_spesialis`
  ADD PRIMARY KEY (`id_spesialis`);

--
-- Indexes for table `tbl_status_menikah`
--
ALTER TABLE `tbl_status_menikah`
  ADD PRIMARY KEY (`id_status_menikah`);

--
-- Indexes for table `tbl_stok_adjustment`
--
ALTER TABLE `tbl_stok_adjustment`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `tbl_stok_adjustment_detail`
--
ALTER TABLE `tbl_stok_adjustment_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`kode_supplier`);

--
-- Indexes for table `tbl_tindakan`
--
ALTER TABLE `tbl_tindakan`
  ADD PRIMARY KEY (`kode_tindakan`);

--
-- Indexes for table `tbl_tipe_periksa_jasa`
--
ALTER TABLE `tbl_tipe_periksa_jasa`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indexes for table `tbl_tipe_periksa_lab`
--
ALTER TABLE `tbl_tipe_periksa_lab`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indexes for table `tbl_tipe_periksa_radiologi`
--
ALTER TABLE `tbl_tipe_periksa_radiologi`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tbl_transaksi_d`
--
ALTER TABLE `tbl_transaksi_d`
  ADD PRIMARY KEY (`id_transaksi_d`),
  ADD KEY `kode_transaksi` (`no_transaksi`);

--
-- Indexes for table `tbl_transaksi_d_obat`
--
ALTER TABLE `tbl_transaksi_d_obat`
  ADD PRIMARY KEY (`id_transaksi_d_obat`);

--
-- Indexes for table `tbl_trx_akuntansi`
--
ALTER TABLE `tbl_trx_akuntansi`
  ADD PRIMARY KEY (`id_trx_akun`);

--
-- Indexes for table `tbl_trx_akuntansi_detail`
--
ALTER TABLE `tbl_trx_akuntansi_detail`
  ADD PRIMARY KEY (`id_trx_akun_detail`),
  ADD KEY `tbl_trx_akuntansi_detail_ibfk_1` (`id_trx_akun`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_users`);

--
-- Indexes for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- Indexes for table `tbl_wilayah`
--
ALTER TABLE `tbl_wilayah`
  ADD PRIMARY KEY (`kode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alkes_kontrol_kehamilan`
--
ALTER TABLE `alkes_kontrol_kehamilan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alkes_periksa_lab`
--
ALTER TABLE `alkes_periksa_lab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alkes_periksa_rapid`
--
ALTER TABLE `alkes_periksa_rapid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_absensi_pegawai`
--
ALTER TABLE `tbl_absensi_pegawai`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_agama`
--
ALTER TABLE `tbl_agama`
  MODIFY `id_agama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `tbl_akun_detail`
--
ALTER TABLE `tbl_akun_detail`
  MODIFY `id_akun_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tbl_apoteker`
--
ALTER TABLE `tbl_apoteker`
  MODIFY `id_apoteker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_biaya`
--
ALTER TABLE `tbl_biaya`
  MODIFY `id_biaya` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_bidang`
--
ALTER TABLE `tbl_bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_departemen`
--
ALTER TABLE `tbl_departemen`
  MODIFY `id_departemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_diagnosa_icd10`
--
ALTER TABLE `tbl_diagnosa_icd10`
  MODIFY `id_diagnosa` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1992;

--
-- AUTO_INCREMENT for table `tbl_diskon_trx`
--
ALTER TABLE `tbl_diskon_trx`
  MODIFY `id_diskon_trx` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_dokter`
--
ALTER TABLE `tbl_dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_golongan_barang`
--
ALTER TABLE `tbl_golongan_barang`
  MODIFY `id_golongan_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT for table `tbl_inventory_detail`
--
ALTER TABLE `tbl_inventory_detail`
  MODIFY `id_inventory_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_jenis_operasi`
--
ALTER TABLE `tbl_jenis_operasi`
  MODIFY `id_jenis_operasi` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_jenjang_pendidikan`
--
ALTER TABLE `tbl_jenjang_pendidikan`
  MODIFY `id_jenjang_pendidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_kamar`
--
ALTER TABLE `tbl_kamar`
  MODIFY `id_kamar` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_kartu_hutang`
--
ALTER TABLE `tbl_kartu_hutang`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_kategori_barang`
--
ALTER TABLE `tbl_kategori_barang`
  MODIFY `id_kategori_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_kategori_biaya`
--
ALTER TABLE `tbl_kategori_biaya`
  MODIFY `id_kategori_biaya` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_kategori_kamar`
--
ALTER TABLE `tbl_kategori_kamar`
  MODIFY `id_kategori_kamar` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_kategori_periksa_lab_radiologi`
--
ALTER TABLE `tbl_kategori_periksa_lab_radiologi`
  MODIFY `id_kategori` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_kategori_tindakan`
--
ALTER TABLE `tbl_kategori_tindakan`
  MODIFY `id_kategori` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_klinik`
--
ALTER TABLE `tbl_klinik`
  MODIFY `id_klinik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_komisi_dokter`
--
ALTER TABLE `tbl_komisi_dokter`
  MODIFY `id_komisi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_kontrol_kehamilan`
--
ALTER TABLE `tbl_kontrol_kehamilan`
  MODIFY `id_kontrol` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_lokasi_barang`
--
ALTER TABLE `tbl_lokasi_barang`
  MODIFY `id_lokasi_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_manufaktur_detail`
--
ALTER TABLE `tbl_manufaktur_detail`
  MODIFY `id_detail` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_master_reference`
--
ALTER TABLE `tbl_master_reference`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=627;

--
-- AUTO_INCREMENT for table `tbl_master_sequence`
--
ALTER TABLE `tbl_master_sequence`
  MODIFY `id_master_sequence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `tbl_obat_racikan_child_jasa`
--
ALTER TABLE `tbl_obat_racikan_child_jasa`
  MODIFY `id_orc_jasa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_obat_racikan_child_obat`
--
ALTER TABLE `tbl_obat_racikan_child_obat`
  MODIFY `id_orc_obat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_periksa_diagnosa`
--
ALTER TABLE `tbl_periksa_diagnosa`
  MODIFY `id_periksa_diagnosa` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_periksa_d_alkes`
--
ALTER TABLE `tbl_periksa_d_alkes`
  MODIFY `id_periksa_d_alkes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_periksa_d_biaya`
--
ALTER TABLE `tbl_periksa_d_biaya`
  MODIFY `id_periksa_d_biaya` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_periksa_d_fisik`
--
ALTER TABLE `tbl_periksa_d_fisik`
  MODIFY `id_periksa_d_fisik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_periksa_d_obat`
--
ALTER TABLE `tbl_periksa_d_obat`
  MODIFY `id_periksa_d_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_periksa_d_tindakan`
--
ALTER TABLE `tbl_periksa_d_tindakan`
  MODIFY `id_periksa_d_tindakan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_periksa_lab`
--
ALTER TABLE `tbl_periksa_lab`
  MODIFY `id_periksa_lab` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_periksa_lab_detail`
--
ALTER TABLE `tbl_periksa_lab_detail`
  MODIFY `id_detail` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_periksa_lanjutan`
--
ALTER TABLE `tbl_periksa_lanjutan`
  MODIFY `id_periksa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_periksa_operasi`
--
ALTER TABLE `tbl_periksa_operasi`
  MODIFY `id_periksa_operasi` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_periksa_radiologi`
--
ALTER TABLE `tbl_periksa_radiologi`
  MODIFY `id_periksa_radiologi` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_poli`
--
ALTER TABLE `tbl_poli`
  MODIFY `id_poli` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_potongan_gaji`
--
ALTER TABLE `tbl_potongan_gaji`
  MODIFY `id_potongan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_d`
--
ALTER TABLE `tbl_purchase_d`
  MODIFY `id_purchase_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_rapid_antigen`
--
ALTER TABLE `tbl_rapid_antigen`
  MODIFY `id_rapid` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ref_gaji`
--
ALTER TABLE `tbl_ref_gaji`
  MODIFY `id_ref_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_rekap_asuransi`
--
ALTER TABLE `tbl_rekap_asuransi`
  MODIFY `id_rekap_asuransi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_saldo_akun`
--
ALTER TABLE `tbl_saldo_akun`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_satuan_barang`
--
ALTER TABLE `tbl_satuan_barang`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_setting_gaji`
--
ALTER TABLE `tbl_setting_gaji`
  MODIFY `id_setting_gaji` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  MODIFY `id_shift` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_spesialis`
--
ALTER TABLE `tbl_spesialis`
  MODIFY `id_spesialis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_status_menikah`
--
ALTER TABLE `tbl_status_menikah`
  MODIFY `id_status_menikah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_stok_adjustment_detail`
--
ALTER TABLE `tbl_stok_adjustment_detail`
  MODIFY `id_detail` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tipe_periksa_jasa`
--
ALTER TABLE `tbl_tipe_periksa_jasa`
  MODIFY `id_tipe` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_tipe_periksa_lab`
--
ALTER TABLE `tbl_tipe_periksa_lab`
  MODIFY `id_tipe` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_tipe_periksa_radiologi`
--
ALTER TABLE `tbl_tipe_periksa_radiologi`
  MODIFY `id_tipe` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_transaksi_d`
--
ALTER TABLE `tbl_transaksi_d`
  MODIFY `id_transaksi_d` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_transaksi_d_obat`
--
ALTER TABLE `tbl_transaksi_d_obat`
  MODIFY `id_transaksi_d_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_trx_akuntansi`
--
ALTER TABLE `tbl_trx_akuntansi`
  MODIFY `id_trx_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_trx_akuntansi_detail`
--
ALTER TABLE `tbl_trx_akuntansi_detail`
  MODIFY `id_trx_akun_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_absensi_pegawai`
--
ALTER TABLE `tbl_absensi_pegawai`
  ADD CONSTRAINT `tbl_absensi_pegawai_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `tbl_pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_akun_detail`
--
ALTER TABLE `tbl_akun_detail`
  ADD CONSTRAINT `tbl_akun_detail_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `tbl_akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD CONSTRAINT `tbl_inventory_ibfk_1` FOREIGN KEY (`kode_purchase`) REFERENCES `tbl_purchases` (`kode_purchase`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_inventory_detail`
--
ALTER TABLE `tbl_inventory_detail`
  ADD CONSTRAINT `tbl_inventory_detail_ibfk_1` FOREIGN KEY (`id_inventory`) REFERENCES `tbl_inventory` (`id_inventory`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_purchase_d`
--
ALTER TABLE `tbl_purchase_d`
  ADD CONSTRAINT `tbl_purchase_d_ibfk_1` FOREIGN KEY (`kode_purchase`) REFERENCES `tbl_purchases` (`kode_purchase`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_saldo_akun`
--
ALTER TABLE `tbl_saldo_akun`
  ADD CONSTRAINT `tbl_saldo_akun_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `tbl_akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_trx_akuntansi_detail`
--
ALTER TABLE `tbl_trx_akuntansi_detail`
  ADD CONSTRAINT `tbl_trx_akuntansi_detail_ibfk_1` FOREIGN KEY (`id_trx_akun`) REFERENCES `tbl_trx_akuntansi` (`id_trx_akun`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
