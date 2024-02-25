-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 03:15 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `berkathusada`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `noantri` int(11) NOT NULL,
  `kodepasien` varchar(30) NOT NULL,
  `poli` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id`, `tgl`, `noantri`, `kodepasien`, `poli`, `status`) VALUES
(1, '2022-04-25', 1, 'Pa2200002', 'Umum', 'Menunggu'),
(2, '2022-04-25', 2, 'PL2200003', 'Umum', 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `apotek_chutang`
--

CREATE TABLE `apotek_chutang` (
  `id` int(11) NOT NULL,
  `nofaktur` varchar(30) NOT NULL,
  `bayar` int(11) NOT NULL,
  `entri` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `apotek_chutang`
--

INSERT INTO `apotek_chutang` (`id`, `nofaktur`, `bayar`, `entri`) VALUES
(1, 'TBH202200007', 10000, '2022-04-13'),
(2, 'TBH202200007', 5000, '2022-04-13'),
(3, 'TBH202200007', 2000, '2022-04-13'),
(4, 'TBH202200007', 7000, '2022-04-13');

-- --------------------------------------------------------

--
-- Table structure for table `apotek_trk`
--

CREATE TABLE `apotek_trk` (
  `id` int(11) NOT NULL,
  `nofaktur` varchar(30) NOT NULL,
  `tglfaktur` date NOT NULL,
  `idkasir` varchar(10) NOT NULL,
  `kodepasien` varchar(20) NOT NULL,
  `ppn` varchar(10) NOT NULL,
  `admin` int(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `bayar` int(11) NOT NULL,
  `status_bayar` varchar(20) NOT NULL,
  `entri` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `apotek_trk`
--

INSERT INTO `apotek_trk` (`id`, `nofaktur`, `tglfaktur`, `idkasir`, `kodepasien`, `ppn`, `admin`, `status`, `bayar`, `status_bayar`, `entri`) VALUES
(1, 'TBH202200001', '2022-04-02', '1', '', '', 0, 'selesai', 0, '', '2022-04-02 04:39:04'),
(2, 'TBH202200002', '2022-04-02', '1', 'PL2200003', 'on', 0, 'selesai', 0, '', '2022-04-06 05:14:04'),
(4, 'TBH202200003', '2022-04-06', '1', '', 'off', 0, 'selesai', 0, '', '2022-04-06 07:40:24'),
(5, 'TBH202200005', '2022-04-06', '1', '', 'off', 0, 'selesai', 0, '', '2022-04-07 01:06:41'),
(6, 'TBH202200006', '2022-04-07', '1', '', 'on', 0, 'selesai', 50000, 'lunas', '2022-04-07 04:22:35'),
(7, 'TBH202200007', '2022-04-07', '1', '', '', 0, 'selesai', 24000, 'lunas', '2022-04-13 03:32:12'),
(8, 'TBH202200008', '2022-04-07', '1', '', 'on', 0, 'selesai', 20000, 'lunas', '2022-04-07 07:12:16'),
(9, 'TBH202200009', '2022-04-09', '1', '', '', 0, 'selesai', 16000, 'lunas', '2022-04-09 03:26:57'),
(10, 'TBH202200010', '2022-04-09', '1', '', 'on', 2240, 'selesai', 20000, 'lunas', '2022-06-25 02:35:48'),
(11, 'TBH202200011', '2022-06-25', '1', '', '', 0, 'selesai', 28000, 'lunas', '2022-06-25 02:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `apotek_trkdetail`
--

CREATE TABLE `apotek_trkdetail` (
  `id` int(11) NOT NULL,
  `faktur` varchar(30) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `jml` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `biaya` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `entri` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `apotek_trkdetail`
--

INSERT INTO `apotek_trkdetail` (`id`, `faktur`, `kode`, `jml`, `harga`, `biaya`, `diskon`, `entri`) VALUES
(2, 'TBH202200002', 'S123', 2, 7500, 15000, 0, '2022-04-05 13:29:08'),
(3, 'TBH202200002', 'S124', 1, 9000, 9000, 0, '2022-04-05 13:35:33'),
(6, 'TBH202200002', 'dwa2323', 2, 24000, 47000, 500, '2022-04-06 04:04:10'),
(7, 'TBH202200003', '424232', 2, 0, 0, 0, '2022-04-06 07:38:49'),
(8, 'TBH202200005', 'S124', 2, 9000, 18000, 0, '2022-04-06 08:33:47'),
(10, 'TBH202200006', '00990', 3, 7000, 21000, 0, '2022-04-07 02:52:50'),
(11, 'TBH202200006', '424232', 3, 8000, 24000, 0, '2022-04-07 04:07:19'),
(12, 'TBH202200007', '23233', 2, 12000, 24000, 0, '2022-04-07 05:01:39'),
(13, 'TBH202200008', '424232', 1, 8000, 8000, 0, '2022-04-07 07:10:48'),
(14, 'TBH202200008', 'S123', 1, 7500, 7500, 0, '2022-04-07 07:11:15'),
(15, 'TBH202200009', '424232', 2, 8000, 16000, 0, '2022-04-09 03:26:08'),
(17, 'TBH202200010', '424232', 2, 8000, 16000, 0, '2022-06-25 02:15:10'),
(18, 'TBH202200011', '23203', 2, 15000, 28000, 1000, '2022-06-25 02:41:28');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nofaktur` varchar(30) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jml` int(11) NOT NULL,
  `jml_klinik` int(11) NOT NULL,
  `jml_apotek` int(11) NOT NULL,
  `ed` date NOT NULL,
  `hargabeli` int(11) NOT NULL,
  `hargajual` int(11) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `diskon` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `entri` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nofaktur`, `kode`, `nama`, `jml`, `jml_klinik`, `jml_apotek`, `ed`, `hargabeli`, `hargajual`, `satuan`, `diskon`, `status`, `entri`) VALUES
(5, '00032', 'dwa2323', 'akjdwajdkk', 8, 0, -4, '2023-01-01', 20000, 24000, 'jkj', 0, '', '2022-04-07 00:58:21'),
(8, '123212', 'k9e0r9', 'kkjdka', 0, 0, 0, '2023-01-01', 10000, 12500, 'kaj', 0, 'STOK', '2022-04-07 02:52:08'),
(11, '000', '23233', 'lodaw', 0, 10, 6, '2023-01-01', 10000, 12000, 'buah', 0, 'STOK', '2022-04-07 07:40:40'),
(14, '8980', '23203', 'jie', 0, 6, 8, '2022-01-05', 12000, 15000, 'sa', 1000, 'STOK', '2022-06-25 02:41:45'),
(15, '8980', '424232', 'bakdwa', 5, -1, 7, '2024-01-01', 5000, 8000, 'lusin', 0, 'STOK', '2022-06-25 02:40:48'),
(16, '999', '00990', 'jagung', 0, 2, -6, '2022-08-23', 5000, 7000, 'buah', 0, 'STOK', '2022-04-07 04:23:48'),
(17, '123567', 'S123', 'paracetamol', 16, -1, 8, '2022-07-23', 6000, 7500, 'keping', 0, 'STOK', '2022-06-08 02:22:37'),
(18, '123567', 'S124', 'MYLANTA', 3, 3, 0, '2023-02-23', 7000, 9000, 'Botol', 0, 'STOK', '2022-06-04 04:22:58');

-- --------------------------------------------------------

--
-- Table structure for table `barangdist`
--

CREATE TABLE `barangdist` (
  `id` int(11) NOT NULL,
  `idbrg` varchar(30) NOT NULL,
  `dari` varchar(20) NOT NULL,
  `ke` varchar(20) NOT NULL,
  `jml` int(11) NOT NULL,
  `entri` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barangdist`
--

INSERT INTO `barangdist` (`id`, `idbrg`, `dari`, `ke`, `jml`, `entri`) VALUES
(1, '17', 'center', 'apotek', 20, '2022-04-11 17:00:00'),
(2, '17', 'center', 'apotek', 20, '2022-04-11 17:00:00'),
(3, '17', 'center', 'klinik', 4, '2022-04-11 17:00:00'),
(4, '17', 'klinik', 'apotek', 4, '2022-04-11 17:00:00'),
(5, '17', 'apotek', 'center', 4, '2022-04-11 17:00:00'),
(6, '17', 'center', 'klinik', 5, '2022-04-11 17:00:00'),
(7, '17', 'klinik', 'center', 3, '2022-04-11 17:00:00'),
(8, '15', 'apotek', 'center', 20, '2022-04-12 17:00:00'),
(9, '15', 'center', 'apotek', 5, '2022-06-24 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `barangmasuk`
--

CREATE TABLE `barangmasuk` (
  `id` int(11) NOT NULL,
  `tgl_faktur` date NOT NULL,
  `tgl_dtg` date NOT NULL,
  `iddist` varchar(10) NOT NULL,
  `nofaktur` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `entri` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barangmasuk`
--

INSERT INTO `barangmasuk` (`id`, `tgl_faktur`, `tgl_dtg`, `iddist`, `nofaktur`, `status`, `entri`) VALUES
(3, '2022-02-16', '2022-02-17', '1', '123212', 'D', '2022-03-18 14:51:11'),
(4, '2020-12-31', '2021-12-31', '3', '222', '', '2022-02-17 15:21:25'),
(5, '2022-01-01', '2022-01-01', '1', '000', 'D', '2022-03-18 14:55:20'),
(6, '2022-01-01', '2022-01-01', '1', '00032', 'D', '2022-03-19 02:41:26'),
(7, '2022-01-01', '2022-01-01', '1', '8980', 'D', '2022-03-24 08:21:16'),
(8, '2021-12-01', '2021-01-31', '3', '2222', '', '2022-02-17 15:28:00'),
(9, '2022-01-01', '2022-01-01', '3', '00294', 'E', '2022-03-18 15:15:17'),
(10, '2022-01-01', '2022-01-01', '3', '000321', 'E', '2022-03-18 15:18:45'),
(11, '2022-03-24', '2022-03-26', '4', '999', 'D', '2022-03-26 06:45:27'),
(12, '2022-03-16', '2022-03-18', '1', '123567', 'D', '2022-03-26 07:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

CREATE TABLE `distributor` (
  `id` int(11) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `distributor`
--

INSERT INTO `distributor` (`id`, `kode`, `nama`, `hp`, `alamat`) VALUES
(1, 'D001', 'd', 'klsd,mfs,mf', ',,m,sma,dmad'),
(3, 'D003', 'lsfaslkf', 'lklakfadhhjsj', 'klkalskdatunggu'),
(4, 'D003', 'dadw', '0909', 'kjada');

-- --------------------------------------------------------

--
-- Table structure for table `jasa`
--

CREATE TABLE `jasa` (
  `id` int(11) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `entri` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jasa`
--

INSERT INTO `jasa` (`id`, `kode`, `nama`, `harga`, `entri`) VALUES
(4, 'J004', 'Konsultasi', 100000, '2022-06-04 03:01:38');

-- --------------------------------------------------------

--
-- Table structure for table `klinik_chutang`
--

CREATE TABLE `klinik_chutang` (
  `id` int(11) NOT NULL,
  `nofaktur` varchar(30) NOT NULL,
  `bayar` int(11) NOT NULL,
  `entri` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `klinik_trk`
--

CREATE TABLE `klinik_trk` (
  `id` int(11) NOT NULL,
  `nofaktur` varchar(30) NOT NULL,
  `tglfaktur` date NOT NULL,
  `idkasir` varchar(10) NOT NULL,
  `kodepasien` varchar(20) NOT NULL,
  `ppn` varchar(10) NOT NULL,
  `admin` int(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `bayar` int(11) NOT NULL,
  `status_bayar` varchar(20) NOT NULL,
  `entri` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klinik_trk`
--

INSERT INTO `klinik_trk` (`id`, `nofaktur`, `tglfaktur`, `idkasir`, `kodepasien`, `ppn`, `admin`, `status`, `bayar`, `status_bayar`, `entri`) VALUES
(1, 'TBH202200001', '2022-04-15', '1', '', 'on', 0, 'selesai', 18000, 'lunas', '2022-04-15 07:36:45'),
(2, 'TBH202200002', '2022-04-21', '1', '', 'on', 0, 'selesai', 65000, 'lunas', '2022-04-22 14:35:46'),
(3, 'TBH202200003', '2022-04-26', '1', 'Pwadadaf2200001', 'on', 0, 'selesai', 65500, 'lunas', '2022-04-26 01:29:43'),
(4, 'TBH202200004', '2022-04-26', '', 'Pa2200002', 'off', 1500, 'selesai', 180000, 'lunas', '2022-06-04 04:22:58'),
(5, 'TBH202200005', '2022-06-04', '1', '', 'on', 675, 'selesai', 120000, 'lunas', '2022-06-04 04:27:47'),
(6, 'TBH202200006', '2022-06-25', '1', 'Pa2200002', 'on', 4000, 'selesai', 115000, 'lunas', '2022-06-25 01:56:57'),
(7, 'TBH202200007', '2022-06-25', '1', '', '', 0, 'proses', 0, '', '2022-06-25 02:13:40');

-- --------------------------------------------------------

--
-- Table structure for table `klinik_trkdetail`
--

CREATE TABLE `klinik_trkdetail` (
  `id` int(11) NOT NULL,
  `faktur` varchar(30) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `jml` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `biaya` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `entri` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klinik_trkdetail`
--

INSERT INTO `klinik_trkdetail` (`id`, `faktur`, `kode`, `jml`, `harga`, `biaya`, `diskon`, `entri`) VALUES
(1, 'TBH202200001', '424232', 2, 8000, 16000, 0, '2022-04-15 07:36:00'),
(4, 'TBH202200002', '424232', 1, 8000, 8000, 0, '2022-04-22 08:18:03'),
(8, 'TBH202200002', 'T002', 0, 0, 5000, 0, '2022-04-22 08:25:27'),
(10, 'TBH202200002', 'J003', 0, 0, 40000, 0, '2022-04-22 14:29:10'),
(11, 'TBH202200002', 'T002', 0, 0, 3000, 0, '2022-04-22 14:35:15'),
(12, 'TBH202200003', '23203', 1, 15000, 14000, 1000, '2022-04-26 01:22:38'),
(13, 'TBH202200003', 'J003', 0, 0, 40000, 0, '2022-04-26 01:28:45'),
(14, 'TBH202200003', 'T002', 0, 0, 5000, 0, '2022-04-26 01:28:53'),
(18, 'TBH202200004', 'S124', 1, 9000, 9000, 0, '2022-05-23 07:26:00'),
(19, 'TBH202200004', 'S123', 1, 7500, 7500, 0, '2022-05-23 07:28:08'),
(20, 'TBH202200004', '23203', 3, 15000, 42000, 1000, '2022-06-04 03:30:22'),
(22, 'TBH202200004', 'J004', 0, 0, 100000, 0, '2022-06-04 03:36:32'),
(23, 'TBH202200004', 'T003', 3, 0, 20000, 0, '2022-06-04 04:03:25'),
(25, 'TBH202200005', 'S123', 1, 7500, 7500, 0, '2022-06-04 04:25:41'),
(26, 'TBH202200005', 'J004', 0, 0, 100000, 0, '2022-06-04 04:25:49'),
(27, 'TBH202200005', 'T002', 1, 0, 0, 0, '2022-06-04 04:26:08'),
(28, 'TBH202200006', 'J004', 0, 0, 100000, 0, '2022-06-25 01:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `kodepasien` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `kodepasien`, `nama`) VALUES
(1, 'PBH22940001', 'Yunus'),
(2, 'PBH22950002', 'Thira');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `tmpl` varchar(30) NOT NULL,
  `tgll` date NOT NULL,
  `alamat` text NOT NULL,
  `entri` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `kode`, `nik`, `nama`, `jk`, `hp`, `tmpl`, `tgll`, `alamat`, `entri`) VALUES
(3, 'Pwadadaf2200001', '1709034302070005', 'dwadadaf', 'Laki-laki', '21323152323', 'dwa', '2007-10-30', 'kajdakwdja', '2022-02-13 01:47:13'),
(4, 'Pa2200002', '1709030210940001', 'adadawd', 'Perempuan', '085664941484', 'adawd', '2021-04-06', 'ada,f,maf', '2022-02-12 06:16:46'),
(5, 'PL2200003', '1709030210940001', 'laldkalkd', 'Laki-laki', '1231401', 'amfa', '2014-03-01', 'kajfkasdax ajjsd', '2022-02-12 04:44:14');

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `id` int(11) NOT NULL,
  `poli` varchar(40) NOT NULL,
  `iddokter` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id`, `poli`, `iddokter`) VALUES
(2, 'Umum', ''),
(3, 'Umum', '4');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `idpasien` int(11) NOT NULL,
  `iddokter` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `anamnesa` text NOT NULL,
  `diagnosis` text NOT NULL,
  `terapi` text NOT NULL,
  `entri` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`id`, `kode`, `idpasien`, `iddokter`, `tgl`, `anamnesa`, `diagnosis`, `terapi`, `entri`) VALUES
(2, 'R2022001', 4, 4, '2022-04-19', 'demam flu batuk pusing mual laper', 'kurang makan', 'makan sepiring beras masak', '2022-04-20 07:42:03'),
(3, 'R2022004002', 4, 4, '2022-04-19', 'demam flu batuk pusing mual laper', 'kurang makan', 'makan sepiring beras masak', '2022-04-20 07:42:44');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id`, `satuan`) VALUES
(6, 'keping'),
(7, 'buah'),
(8, 'lusin'),
(10, 'adwad'),
(11, 'jsjwjq'),
(12, 'asnk');

-- --------------------------------------------------------

--
-- Table structure for table `so_cek`
--

CREATE TABLE `so_cek` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `stokreal` int(11) NOT NULL,
  `ket` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `so_cek`
--

INSERT INTO `so_cek` (`id`, `kode`, `kodebarang`, `stokreal`, `ket`) VALUES
(2, '22030102', '424232', 80, 'pas'),
(3, '22030101', '424232', 80, 'pas\r\n'),
(4, '22030103', 'S123', 20, ''),
(5, '22030103', 'S124', 2, 'hilang'),
(6, '22040104', '424232', 8, ''),
(7, '22040104', 'S123', 8, '');

-- --------------------------------------------------------

--
-- Table structure for table `so_master`
--

CREATE TABLE `so_master` (
  `id` int(11) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `tgl1` date NOT NULL,
  `tgl2` date NOT NULL,
  `lokasi` varchar(20) NOT NULL,
  `entri` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `so_master`
--

INSERT INTO `so_master` (`id`, `kode`, `tgl1`, `tgl2`, `lokasi`, `entri`) VALUES
(1, '22030101', '2022-04-05', '2022-04-06', 'Gudang/Centre', '2022-03-26 02:57:37'),
(2, '22030102', '2022-04-01', '2022-04-03', 'Gudang/Centre', '2022-03-26 05:33:46'),
(3, '22030103', '2022-04-01', '2022-04-03', 'Gudang/Centre', '2022-03-26 07:40:58'),
(4, '22040104', '2022-04-18', '2022-04-19', 'Apotek', '2022-04-13 06:47:20');

-- --------------------------------------------------------

--
-- Table structure for table `tindakan`
--

CREATE TABLE `tindakan` (
  `id` int(11) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `entri` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tindakan`
--

INSERT INTO `tindakan` (`id`, `kode`, `nama`, `harga`, `entri`) VALUES
(2, 'T002', 'Perban', 0, '2022-04-22 08:25:00'),
(3, 'T003', 'Tambal gigi', 20000, '2022-06-04 03:03:17');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `gelar1` varchar(20) NOT NULL,
  `gelar2` varchar(20) NOT NULL,
  `tgll` date NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pas` varchar(60) NOT NULL,
  `status` varchar(50) NOT NULL,
  `entri` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `kode`, `nama`, `gelar1`, `gelar2`, `tgll`, `nohp`, `email`, `pas`, `status`, `entri`) VALUES
(1, 'K9999999', 'ADMIN CENTER', '', '', '0000-00-00', '082183925322', 'admincenter@berkathusadakaur.com', '6051e9bdf8241b9e6b9b240539446334', 'Admin Center,Apotek,Klinik,Dokter', '2022-04-15 08:58:17'),
(4, 'K2281004', 'Wendra', 'dr', '', '1981-01-31', '1234', 'daeda@dwa.ca', '81dc9bdb52d04dc20036dbd8313ed055', 'Klinik,Dokter', '2022-04-15 09:23:11'),
(5, 'K2293005', 'Afryandri C', '', 'S.Kom', '1993-01-01', '321', 'aan@chan.com', 'caf1a3dfb505ffed0d024130f58c5cfa', '', '2022-04-15 04:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_akses`
--

CREATE TABLE `user_akses` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `akses` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apotek_chutang`
--
ALTER TABLE `apotek_chutang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apotek_trk`
--
ALTER TABLE `apotek_trk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apotek_trkdetail`
--
ALTER TABLE `apotek_trkdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangdist`
--
ALTER TABLE `barangdist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klinik_chutang`
--
ALTER TABLE `klinik_chutang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klinik_trk`
--
ALTER TABLE `klinik_trk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klinik_trkdetail`
--
ALTER TABLE `klinik_trkdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `so_cek`
--
ALTER TABLE `so_cek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `so_master`
--
ALTER TABLE `so_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `apotek_chutang`
--
ALTER TABLE `apotek_chutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `apotek_trk`
--
ALTER TABLE `apotek_trk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `apotek_trkdetail`
--
ALTER TABLE `apotek_trkdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `barangdist`
--
ALTER TABLE `barangdist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `distributor`
--
ALTER TABLE `distributor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `klinik_chutang`
--
ALTER TABLE `klinik_chutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `klinik_trk`
--
ALTER TABLE `klinik_trk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `klinik_trkdetail`
--
ALTER TABLE `klinik_trkdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `so_cek`
--
ALTER TABLE `so_cek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `so_master`
--
ALTER TABLE `so_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tindakan`
--
ALTER TABLE `tindakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
