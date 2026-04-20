-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 07, 2026 at 04:15 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nrp` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `nrp`, `email`, `jurusan`) VALUES
(1, 'Sandhika Galih1', '123456789', 'sandhikahgalih@gmail.com', 'Informatika'),
(2, 'Budi Prasetyo', '123456789', 'budiprasetyo@gmail.com', 'Sistem Informasi '),
(3, 'Ega Laf', '123456789', 'ega@Gmail.com', 'Sistem Informasi'),
(4, 'jaka', '121321', 'nopa@gmail.com', 'Informatika'),
(5, 'jaka1', '121212', 'test@gmail.com', 'Informatika'),
(11, 'Ega', '1212323', 'eggg@gmail.com', 'Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_alternatif`
--

CREATE TABLE `tbl_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `kode_alternatif` varchar(10) DEFAULT NULL,
  `nama_alternatif` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cluster`
--

CREATE TABLE `tbl_cluster` (
  `id_cluster` int(11) NOT NULL,
  `kode_cluster` varchar(10) NOT NULL,
  `nama_cluster` varchar(100) NOT NULL,
  `id_dataset` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cluster`
--

INSERT INTO `tbl_cluster` (`id_cluster`, `kode_cluster`, `nama_cluster`, `id_dataset`) VALUES
(3, 'C1', 'Best Seller', 107),
(4, 'C2', 'Low Demand', 108);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dataset`
--

CREATE TABLE `tbl_dataset` (
  `id_dataset` int(11) NOT NULL,
  `nama_dataset` varchar(100) NOT NULL,
  `harga_parfum` varchar(100) DEFAULT '-',
  `volume_penjualan` varchar(100) DEFAULT '-',
  `frekuensi_pembelian` varchar(100) DEFAULT '-',
  `jenis_aroma` varchar(100) DEFAULT '-',
  `rating_pelanggan` varchar(100) DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_dataset`
--

INSERT INTO `tbl_dataset` (`id_dataset`, `nama_dataset`, `harga_parfum`, `volume_penjualan`, `frekuensi_pembelian`, `jenis_aroma`, `rating_pelanggan`) VALUES
(1, 'Black Orchid', '360000', '2', '15', 'Fresh', 'Tidak Dinilai'),
(2, 'White Musk', '150000', '8', '15', 'Fresh', 'Bagus'),
(3, 'Blue Ocean', '230000', '3', '15', 'Woody', 'Bagus'),
(4, 'Midnight Rose', '350000', '1', '15', 'Fresh', 'Tidak Dinilai'),
(5, 'Vanilla Sky', '160000', '5', '15', 'Fresh', 'Tidak Dinilai'),
(6, 'Oud Royal', '400000', '1', '15', 'Woody', 'Bagus'),
(7, 'Amber Night', '260000', '3', '15', 'Woody', 'Tidak Dinilai'),
(8, 'Fresh Breeze', '390000', '2', '15', 'Woody', 'Bagus'),
(9, 'Golden Sand', '350000', '3', '15', 'Woody', 'Tidak Dinilai'),
(10, 'Dark Desire', '270000', '4', '15', 'Woody', 'Tidak Dinilai'),
(11, 'Aqua Marine', '260000', '3', '15', 'Fresh', 'Tidak Dinilai'),
(12, 'Sweet Blossom', '370000', '5', '15', 'Woody', 'Tidak Dinilai'),
(13, 'Velvet Oud', '200000', '2', '15', 'Woody', 'Bagus'),
(14, 'Citrus Bloom', '190000', '5', '15', 'Woody', 'Tidak Dinilai'),
(15, 'Ocean Mist', '280000', '4', '15', 'Woody', 'Bagus'),
(16, 'Floral Dream', '200000', '3', '15', 'Woody', 'Tidak Dinilai'),
(17, 'Mystic Wood', '300000', '5', '10', 'Woody', 'Tidak Dinilai'),
(18, 'Pure Jasmine', '350000', '5', '10', 'Fresh', 'Tidak Dinilai'),
(19, 'Ice Cool', '300000', '3', '10', 'Fresh', 'Tidak Dinilai'),
(20, 'Lavender Touch', '360000', '2', '10', 'Woody', 'Bagus'),
(21, 'Rose Velvet', '240000', '4', '10', 'Fresh', 'Bagus'),
(22, 'Spicy Amber', '270000', '2', '10', 'Woody', 'Tidak Dinilai'),
(23, 'Deep Forest', '340000', '4', '10', 'Woody', 'Tidak Dinilai'),
(24, 'Soft Vanilla', '320000', '3', '10', 'Woody', 'Tidak Dinilai'),
(25, 'Exotic Musk', '340000', '4', '10', 'Woody', 'Bagus'),
(26, 'Lemon Zest', '300000', '3', '10', 'Woody', 'Tidak Dinilai'),
(27, 'Fresh Linen', '320000', '4', '10', 'Woody', 'Bagus'),
(28, 'Black Coffee', '340000', '3', '5', 'Woody', 'Bagus'),
(29, 'Night Shadow', '270000', '2', '5', 'Fresh', 'Tidak Dinilai'),
(30, 'Golden Vanilla', '310000', '3', '5', 'Woody', 'Tidak Dinilai'),
(31, 'Tropical Escape', '350000', '2', '5', 'Woody', 'Bagus'),
(32, 'Summer Rain', '220000', '3', '5', 'Woody', 'Bagus'),
(33, 'Autumn Wood', '350000', '4', '5', 'Woody', 'Bagus'),
(34, 'Royal Patchouli', '340000', '2', '5', 'Woody', 'Tidak Dinilai'),
(35, 'Crystal Blue', '300000', '4', '10', 'Woody', 'Tidak Dinilai'),
(36, 'White Gardenia', '190000', '2', '10', 'Woody', 'Tidak Dinilai'),
(37, 'Dark Leather', '240000', '3', '10', 'Woody', 'Tidak Dinilai'),
(38, 'Soft Powder', '290000', '3', '10', 'Woody', 'Bagus'),
(39, 'Clean Cotton', '340000', '6', '10', 'Woody', 'Bagus'),
(40, 'Sweet Peony', '310000', '3', '10', 'Woody', 'Bagus'),
(41, 'Wild Berry', '260000', '4', '10', 'Fresh', 'Tidak Dinilai'),
(42, 'Ocean Breeze', '240000', '6', '10', 'Fresh', 'Bagus'),
(43, 'Urban Night', '330000', '5', '10', 'Fresh', 'Tidak Dinilai'),
(44, 'Elegant Rose', '270000', '2', '10', 'Woody', 'Tidak Dinilai'),
(45, 'Smooth Sandalwood', '320000', '4', '10', 'Woody', 'Tidak Dinilai'),
(46, 'Amber Gold', '240000', '5', '10', 'Woody', 'Bagus'),
(47, 'Fresh Mint', '250000', '2', '10', 'Fresh', 'Tidak Dinilai'),
(48, 'Pink Blossom', '310000', '4', '10', 'Woody', 'Bagus'),
(49, 'Smoky Oud', '270000', '6', '10', 'Fresh', 'Tidak Dinilai'),
(50, 'Pure White', '280000', '4', '10', 'Fresh', 'Tidak Dinilai'),
(51, 'Classic Homme', '210000', '2', '10', 'Woody', 'Tidak Dinilai'),
(52, 'Femme Grace', '150000', '4', '10', 'Woody', 'Tidak Dinilai'),
(53, 'Silver Moon', '210000', '3', '10', 'Woody', 'Tidak Dinilai'),
(54, 'Morning Dew', '250000', '5', '10', 'Woody', 'Bagus'),
(55, 'Secret Love', '380000', '4', '10', 'Woody', 'Bagus'),
(56, 'Cool Waterfall', '320000', '5', '10', 'Woody', 'Bagus'),
(57, 'Intense Black', '270000', '3', '10', 'Woody', 'Tidak Dinilai'),
(58, 'Blooming Lily', '260000', '5', '10', 'Woody', 'Tidak Dinilai'),
(59, 'Soft Amber', '280000', '3', '10', 'Woody', 'Bagus'),
(60, 'Bright Citrus', '240000', '4', '10', 'Woody', 'Tidak Dinilai'),
(61, 'Vanilla Woods', '250000', '5', '10', 'Woody', 'Tidak Dinilai'),
(62, 'Fresh Energy', '240000', '2', '10', 'Woody', 'Tidak Dinilai'),
(63, 'Royal Musk', '160000', '3', '10', 'Woody', 'Tidak Dinilai'),
(64, 'Deep Blue', '220000', '5', '10', 'Fresh', 'Tidak Dinilai'),
(65, 'Sweet Candy', '260000', '6', '10', 'Fresh', 'Tidak Dinilai'),
(66, 'Green Tea', '280000', '5', '10', 'Woody', 'Bagus'),
(67, 'Night Bloom', '310000', '3', '15', 'Fresh', 'Bagus'),
(68, 'Desert Oud', '350000', '4', '15', 'Woody', 'Tidak Dinilai'),
(69, 'Crystal Rose', '260000', '4', '15', 'Woody', 'Bagus'),
(70, 'Ocean Pearl', '250000', '3', '15', 'Fresh', 'Tidak Dinilai'),
(71, 'Soft Touch', '220000', '6', '15', 'Woody', 'Tidak Dinilai'),
(72, 'Spicy Night', '260000', '5', '15', 'Woody', 'Tidak Dinilai'),
(73, 'Golden Bloom', '250000', '2', '15', 'Woody', 'Bagus'),
(74, 'Pure Elegance', '300000', '3', '10', 'Woody', 'Tidak Dinilai'),
(75, 'Ice Mountain', '340000', '4', '10', 'Woody', 'Bagus'),
(76, 'Wild Ocean', '280000', '4', '10', 'Woody', 'Bagus'),
(77, 'Sweet Romance', '260000', '5', '10', 'Woody', 'Tidak Dinilai'),
(78, 'White Amber', '290000', '2', '10', 'Fresh', 'Tidak Dinilai'),
(79, 'Dark Vanilla', '210000', '4', '10', 'Woody', 'Bagus'),
(80, 'Clean Fresh', '300000', '3', '10', 'Fresh', 'Bagus'),
(81, 'Morning Sun', '340000', '6', '10', 'Woody', 'Bagus'),
(82, 'Floral Kiss', '370000', '4', '10', 'Woody', 'Tidak Dinilai'),
(83, 'Urban Fresh', '310000', '3', '10', 'Woody', 'Tidak Dinilai'),
(84, 'Royal Night', '340000', '6', '10', 'Woody', 'Tidak Dinilai'),
(85, 'Citrus Splash', '140000', '2', '10', 'Woody', 'Tidak Dinilai'),
(86, 'Gentle Breeze', '220000', '3', '10', 'Woody', 'Bagus'),
(87, 'Velvet Rose', '290000', '7', '10', 'Woody', 'Tidak Dinilai'),
(88, 'Deep Sensation', '320000', '2', '10', 'Fresh', 'Bagus'),
(89, 'Fresh Spirit', '220000', '4', '10', 'Woody', 'Bagus'),
(90, 'Golden Wood', '210000', '3', '10', 'Woody', 'Bagus'),
(91, 'Pink Vanilla', '280000', '4', '10', 'Fresh', 'Tidak Dinilai'),
(92, 'Ocean Drift', '310000', '6', '10', 'Fresh', 'Bagus'),
(93, 'Black Intense', '390000', '7', '10', 'Woody', 'Tidak Dinilai'),
(94, 'White Blossom', '250000', '3', '10', 'Woody', 'Tidak Dinilai'),
(95, 'Sweet Desire', '400000', '6', '10', 'Oriental', 'Tidak Dinilai'),
(96, 'Woody Classic', '350000', '3', '10', 'Woody', 'Bagus'),
(97, 'Cool Breeze', '280000', '5', '10', 'Woody', 'Bagus'),
(98, 'Amber Soft', '320000', '4', '10', 'Woody', 'Tidak Dinilai'),
(99, 'Pure Fresh', '310000', '5', '10', 'Fresh', 'Tidak Dinilai'),
(100, 'Midnight Blue', '360000', '6', '15', 'Fresh', 'Bagus'),
(101, 'Tropical Bloom', '180000', '2', '15', 'Woody', 'Bagus'),
(102, 'Green Forest', '240000', '4', '15', 'Woody', 'Tidak Dinilai'),
(103, 'Elegant Musk', '290000', '4', '15', 'Woody', 'Tidak Dinilai'),
(104, 'Soft Floral', '310000', '6', '15', 'Woody', 'Bagus'),
(105, 'Spicy Wood', '350000', '7', '15', 'Woody', 'Tidak Dinilai'),
(106, 'Clean Energy', '270000', '4', '15', 'Woody', 'Tidak Dinilai'),
(107, 'Fresh Wave', '280000', '9', '15', 'Fresh', 'Bagus'),
(108, 'Sweet Lily', '190000', '1', '15', 'Woody', 'Bagus'),
(109, 'Dark Ocean', '360000', '7', '15', 'Woody', 'Tidak Dinilai'),
(110, 'Golden Night', '210000', '4', '15', 'Woody', 'Bagus'),
(111, 'Citrus Fresh', '300000', '5', '10', 'Woody', 'Tidak Dinilai'),
(112, 'Powder Soft', '180000', '3', '10', 'Fresh', 'Tidak Dinilai'),
(113, 'Royal Elegance', '230000', '2', '10', 'Woody', 'Tidak Dinilai'),
(114, 'Ice Ocean', '290000', '3', '10', 'Woody', 'Bagus'),
(115, 'Velvet Touch', '300000', '4', '10', 'Woody', 'Tidak Dinilai'),
(116, 'Sweet Vanilla', '270000', '7', '10', 'Fresh', 'Bagus'),
(117, 'Urban Style', '220000', '6', '10', 'Woody', 'Tidak Dinilai'),
(118, 'Deep Musk', '270000', '8', '10', 'Oriental', 'Bagus'),
(119, 'Fresh Garden', '310000', '9', '10', 'Woody', 'Tidak Dinilai'),
(120, 'Soft Rose', '180000', '1', '10', 'Woody', 'Tidak Dinilai'),
(121, 'Mystic Night', '240000', '3', '10', 'Woody', 'Tidak Dinilai'),
(122, 'White Crystal', '310000', '5', '10', 'Woody', 'Bagus'),
(123, 'Cool Spirit', '390000', '8', '10', 'Woody', 'Tidak Dinilai'),
(124, 'Golden Amber', '280000', '3', '10', 'Woody', 'Bagus'),
(125, 'Sweet Bloom', '310000', '5', '10', 'Woody', 'Tidak Dinilai'),
(126, 'Ocean Blue', '310000', '3', '10', 'Woody', 'Bagus'),
(127, 'Dark Wood', '240000', '4', '10', 'Woody', 'Tidak Dinilai'),
(128, 'Pure Musk', '340000', '5', '10', 'Woody', 'Bagus'),
(129, 'Floral Harmony', '270000', '5', '10', 'Woody', 'Bagus'),
(130, 'Fresh Morning', '310000', '3', '10', 'Woody', 'Tidak Dinilai'),
(131, 'Elegant Touch', '250000', '3', '10', 'Fresh', 'Bagus'),
(132, 'Royal Oud', '310000', '4', '10', 'Fresh', 'Tidak Dinilai'),
(133, 'Soft Breeze', '390000', '7', '10', 'Woody', 'Tidak Dinilai'),
(134, 'Citrus Garden', '240000', '5', '10', 'Woody', 'Tidak Dinilai'),
(135, 'Midnight Love', '290000', '3', '10', 'Woody', 'Bagus'),
(136, 'Clean White', '320000', '6', '10', 'Fresh', 'Tidak Dinilai'),
(137, 'Warm Vanilla', '100000', '2', '10', 'Woody', 'Bagus'),
(138, 'Fresh Aqua', '170000', '2', '10', 'Woody', 'Bagus'),
(139, 'Sweet Floral', '180000', '1', '10', 'Woody', 'Tidak Dinilai'),
(140, 'Golden Dream', '230000', '4', '10', 'Woody', 'Tidak Dinilai'),
(141, 'Spicy Bloom', '280000', '3', '10', 'Fresh', 'Tidak Dinilai'),
(142, 'Cool Night', '210000', '4', '10', 'Woody', 'Bagus'),
(143, 'Velvet Amber', '310000', '7', '10', 'Woody', 'Bagus'),
(144, 'White Soft', '240000', '2', '10', 'Fresh', 'Tidak Dinilai'),
(145, 'Fresh Wood', '340000', '4', '10', 'Woody', 'Bagus'),
(146, 'Elegant Bloom', '380000', '3', '10', 'Woody', 'Tidak Dinilai'),
(147, 'Deep Night', '370000', '6', '10', 'Fresh', 'Bagus'),
(148, 'Sweet Powder', '390000', '3', '10', 'Woody', 'Tidak Dinilai'),
(149, 'Ocean Fresh', '260000', '4', '10', 'Woody', 'Bagus'),
(150, 'Golden Rose', '310000', '4', '10', 'Woody', 'Bagus'),
(151, 'Wild Spirit', '210000', '4', '10', 'Woody', 'Tidak Dinilai'),
(152, 'Soft Jasmine', '310000', '7', '10', 'Woody', 'Tidak Dinilai'),
(153, 'Royal Classic', '240000', '2', '10', 'Fresh', 'Bagus'),
(154, 'Clean Breeze', '340000', '4', '10', 'Woody', 'Tidak Dinilai'),
(155, 'Fresh Bloom', '380000', '3', '10', 'Woody', 'Tidak Dinilai'),
(156, 'Sweet Garden', '370000', '6', '10', 'Fresh', 'Bagus'),
(157, 'Dark Rose', '390000', '3', '10', 'Woody', 'Tidak Dinilai'),
(158, 'Cool Mint', '260000', '4', '10', 'Woody', 'Bagus'),
(159, 'Amber Classic', '310000', '4', '10', 'Woody', 'Tidak Dinilai'),
(160, 'Ocean Wind', '300000', '3', '10', 'Fresh', 'Bagus'),
(161, 'White Musk Soft', '340000', '6', '10', 'Woody', 'Tidak Dinilai'),
(162, 'Golden Citrus', '370000', '4', '10', 'Woody', 'Tidak Dinilai'),
(163, 'Sweet Ocean', '310000', '3', '10', 'Woody', 'Tidak Dinilai'),
(164, 'Deep Elegance', '340000', '6', '10', 'Woody', 'Tidak Dinilai'),
(165, 'Fresh Day', '140000', '2', '10', 'Woody', 'Tidak Dinilai'),
(166, 'Soft Vanilla Musk', '220000', '3', '10', 'Woody', 'Bagus'),
(167, 'Night Fresh', '290000', '7', '10', 'Woody', 'Tidak Dinilai'),
(168, 'Royal Bloom', '320000', '2', '10', 'Fresh', 'Bagus'),
(169, 'Clean Cotton Soft', '220000', '4', '10', 'Woody', 'Bagus'),
(170, 'Sweet Amber', '210000', '3', '10', 'Woody', 'Bagus'),
(171, 'Ocean Light', '280000', '4', '10', 'Fresh', 'Tidak Dinilai'),
(172, 'Dark Sensation', '310000', '6', '10', 'Fresh', 'Bagus'),
(173, 'Elegant White', '390000', '7', '10', 'Woody', 'Tidak Dinilai'),
(174, 'Fresh Forest', '250000', '3', '10', 'Woody', 'Tidak Dinilai'),
(175, 'Soft Powder Rose', '400000', '6', '10', 'Woody', 'Tidak Dinilai'),
(176, 'Golden Oud', '160000', '5', '10', 'Woody', 'Tidak Dinilai'),
(177, 'Sweet Fresh', '400000', '1', '10', 'Woody', 'Bagus'),
(178, 'Cool Aqua', '260000', '3', '10', 'Woody', 'Tidak Dinilai'),
(179, 'White Rose', '390000', '2', '10', 'Woody', 'Bagus'),
(180, 'Deep Blue Night', '350000', '3', '10', 'Woody', 'Bagus'),
(181, 'Fresh Lemon', '270000', '4', '10', 'Woody', 'Tidak Dinilai'),
(182, 'Soft Elegance', '260000', '3', '10', 'Fresh', 'Tidak Dinilai'),
(183, 'Royal Fresh', '370000', '5', '10', 'Woody', 'Bagus'),
(184, 'Sweet Wood', '200000', '2', '10', 'Woody', 'Bagus'),
(185, 'Clean Ocean', '190000', '5', '10', 'Woody', 'Tidak Dinilai'),
(186, 'Dark Amber', '280000', '4', '10', 'Woody', 'Bagus'),
(187, 'Floral Soft', '200000', '3', '10', 'Woody', 'Tidak Dinilai'),
(188, 'Fresh Touch', '300000', '5', '10', 'Woody', 'Tidak Dinilai'),
(189, 'Golden Musk', '350000', '5', '10', 'Woody', 'Bagus'),
(190, 'Midnight Fresh', '300000', '3', '10', 'Fresh', 'Tidak Dinilai'),
(191, 'Sweet Harmony', '360000', '2', '10', 'Fresh', 'Bagus'),
(192, 'Ocean Calm', '240000', '4', '10', 'Fresh', 'Bagus'),
(193, 'White Vanilla', '270000', '2', '10', 'Woody', 'Bagus'),
(194, 'Deep Forest Oud', '390000', '7', '10', 'Woody', 'Tidak Dinilai'),
(195, 'Fresh Blooming', '240000', '5', '10', 'Woody', 'Tidak Dinilai'),
(196, 'Soft Cotton', '290000', '3', '10', 'Woody', 'Bagus'),
(197, 'Royal Spirit', '320000', '6', '10', 'Fresh', 'Bagus'),
(198, 'Sweet Night', '100000', '2', '10', 'Woody', 'Bagus'),
(199, 'Cool White', '170000', '2', '10', 'Woody', 'Bagus'),
(200, 'Elegant Ocean', '180000', '1', '10', 'Woody', 'Bagus');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hasil`
--

CREATE TABLE `tbl_hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_dataset` int(11) DEFAULT NULL,
  `id_cluster` int(11) DEFAULT NULL,
  `jarak_minimum` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_hasil`
--

INSERT INTO `tbl_hasil` (`id_hasil`, `id_dataset`, `id_cluster`, `jarak_minimum`) VALUES
(1, 159, 3, 0.8137),
(2, 46, 4, 1.3692),
(3, 7, 4, 1.1011),
(4, 98, 3, 0.8286),
(5, 11, 4, 1.3404),
(6, 33, 3, 0.8809),
(7, 28, 3, 0.8809),
(8, 93, 3, 1.7771),
(9, 1, 3, 1.9285),
(10, 58, 4, 1.3061),
(11, 3, 4, 1.1752),
(12, 60, 4, 0.8087),
(13, 14, 4, 1.4204),
(14, 111, 3, 0.9476),
(15, 134, 4, 1.3061),
(16, 85, 4, 1.7631),
(17, 51, 4, 1.1641),
(18, 154, 3, 0.8286),
(19, 39, 3, 1.0059),
(20, 169, 4, 0.9071),
(21, 106, 3, 1.1772),
(22, 80, 3, 1.1386),
(23, 185, 4, 1.208),
(24, 136, 3, 1.2113),
(25, 178, 4, 0.8087),
(26, 97, 3, 0.9937),
(27, 158, 4, 0.9071),
(28, 142, 4, 0.7589),
(29, 123, 3, 1.7771),
(30, 56, 3, 1.0059),
(31, 199, 4, 1.8103),
(32, 35, 3, 0.8137),
(33, 69, 4, 1.1752),
(34, 186, 3, 0.8669),
(35, 10, 3, 1.1772),
(36, 37, 4, 0.8087),
(37, 109, 3, 1.9702),
(38, 157, 3, 0.8286),
(39, 172, 3, 1.2378),
(40, 79, 4, 0.7589),
(41, 127, 4, 0.8087),
(42, 64, 4, 1.5134),
(43, 180, 3, 0.8809),
(44, 164, 3, 0.9604),
(45, 23, 3, 0.8286),
(46, 194, 3, 1.7771),
(47, 118, 3, 2.1629),
(48, 147, 3, 1.2476),
(49, 88, 3, 1.7564),
(50, 68, 3, 1.1875),
(51, 146, 3, 0.8286),
(52, 103, 3, 1.1772),
(53, 200, 4, 1.8103),
(54, 44, 3, 1.5577),
(55, 131, 4, 1.1862),
(56, 173, 3, 1.7771),
(57, 25, 3, 0.8809),
(58, 52, 4, 1.4698),
(59, 16, 4, 0.9826),
(60, 129, 3, 0.9937),
(61, 82, 3, 0.8286),
(62, 187, 4, 0.6381),
(63, 138, 4, 1.8103),
(64, 155, 3, 0.8286),
(65, 195, 4, 1.3061),
(66, 8, 3, 1.8066),
(67, 165, 4, 1.7631),
(68, 62, 4, 1.2657),
(69, 174, 4, 0.8087),
(70, 119, 3, 2.7147),
(71, 181, 3, 0.8137),
(72, 27, 3, 0.8809),
(73, 47, 4, 1.4786),
(74, 130, 3, 0.8137),
(75, 89, 4, 0.9071),
(76, 188, 3, 0.9476),
(77, 107, 3, 2.9542),
(78, 145, 3, 0.8809),
(79, 86, 4, 0.9071),
(80, 124, 3, 0.8669),
(81, 73, 4, 1.5262),
(82, 162, 3, 0.8286),
(83, 140, 4, 0.8087),
(84, 189, 3, 1.0059),
(85, 110, 4, 1.0651),
(86, 176, 4, 1.7923),
(87, 150, 3, 0.8669),
(88, 9, 3, 1.1875),
(89, 30, 3, 0.8137),
(90, 90, 4, 0.7589),
(91, 102, 4, 1.1011),
(92, 66, 3, 0.9937),
(93, 19, 3, 1.0986),
(94, 75, 3, 0.8809),
(95, 114, 3, 0.8669),
(96, 57, 3, 0.8137),
(97, 20, 3, 1.5938),
(98, 26, 3, 0.8137),
(99, 100, 3, 1.51),
(100, 190, 3, 1.0986),
(101, 135, 3, 0.8669),
(102, 4, 3, 1.9285),
(103, 54, 4, 1.3692),
(104, 81, 3, 1.0059),
(105, 121, 4, 0.8087),
(106, 17, 3, 0.9476),
(107, 67, 3, 1.4212),
(108, 167, 3, 1.7702),
(109, 29, 3, 1.7237),
(110, 126, 3, 0.8669),
(111, 42, 4, 1.5682),
(112, 192, 4, 1.1862),
(113, 92, 3, 1.2378),
(114, 149, 4, 0.9071),
(115, 171, 3, 1.0986),
(116, 15, 3, 1.2146),
(117, 70, 4, 1.3404),
(118, 160, 3, 1.1386),
(119, 6, 3, 1.8066),
(120, 48, 3, 0.8669),
(121, 91, 3, 1.0986),
(122, 112, 4, 1.6567),
(123, 74, 3, 0.8137),
(124, 99, 3, 1.2011),
(125, 18, 3, 1.2113),
(126, 128, 3, 1.0059),
(127, 50, 3, 1.0986),
(128, 21, 4, 1.1862),
(129, 168, 3, 1.7564),
(130, 153, 4, 1.5347),
(131, 113, 4, 1.2657),
(132, 183, 3, 1.0059),
(133, 63, 4, 1.4698),
(134, 84, 3, 0.9604),
(135, 132, 3, 1.0986),
(136, 34, 3, 1.5655),
(137, 197, 3, 1.2476),
(138, 55, 3, 0.8809),
(139, 53, 4, 0.6381),
(140, 49, 3, 1.2011),
(141, 45, 3, 0.8286),
(142, 59, 3, 0.8669),
(143, 133, 3, 1.7771),
(144, 196, 3, 0.8669),
(145, 182, 4, 1.1128),
(146, 104, 3, 1.308),
(147, 152, 3, 1.7702),
(148, 38, 3, 0.8669),
(149, 175, 3, 0.9604),
(150, 120, 4, 1.7631),
(151, 71, 4, 1.5048),
(152, 24, 3, 0.8286),
(153, 166, 4, 0.9071),
(154, 22, 3, 1.5577),
(155, 141, 3, 1.0986),
(156, 72, 4, 1.5048),
(157, 105, 3, 1.9702),
(158, 32, 4, 0.9071),
(159, 170, 4, 0.7589),
(160, 125, 3, 0.9476),
(161, 12, 3, 1.2829),
(162, 65, 4, 1.5134),
(163, 95, 3, 1.5419),
(164, 139, 4, 1.7631),
(165, 177, 3, 1.5938),
(166, 156, 3, 1.2476),
(167, 191, 3, 1.7564),
(168, 108, 4, 1.443),
(169, 198, 4, 1.8103),
(170, 163, 3, 0.8137),
(171, 40, 3, 0.8669),
(172, 148, 3, 0.8286),
(173, 77, 4, 1.3061),
(174, 116, 3, 1.9411),
(175, 184, 4, 1.2345),
(176, 101, 4, 1.9585),
(177, 31, 3, 1.5938),
(178, 83, 3, 0.8137),
(179, 43, 3, 1.2113),
(180, 117, 4, 1.3061),
(181, 5, 4, 2.0869),
(182, 61, 4, 1.3061),
(183, 143, 3, 1.7953),
(184, 13, 4, 1.443),
(185, 87, 3, 1.7702),
(186, 115, 3, 0.8137),
(187, 137, 4, 1.8103),
(188, 78, 3, 1.7237),
(189, 94, 4, 0.8087),
(190, 122, 3, 0.9937),
(191, 36, 4, 1.1641),
(192, 2, 4, 2.7524),
(193, 161, 3, 0.9604),
(194, 179, 3, 1.5938),
(195, 144, 4, 1.4786),
(196, 193, 3, 1.5861),
(197, 41, 4, 1.1128),
(198, 76, 3, 0.8669),
(199, 151, 4, 0.6381),
(200, 96, 3, 0.8809);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kriteria`
--

CREATE TABLE `tbl_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kriteria`
--

INSERT INTO `tbl_kriteria` (`id_kriteria`, `nama_kriteria`) VALUES
(1, 'Harga Parfum'),
(2, 'Volume Penjualan'),
(3, 'Frekuensi Pembelian'),
(4, 'Jenis Aroma'),
(5, 'Rating Pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id_login` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('admin','pimpinan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id_login`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'pimpinan', 'pimpinan', 'pimpinan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `tbl_cluster`
--
ALTER TABLE `tbl_cluster`
  ADD PRIMARY KEY (`id_cluster`);

--
-- Indexes for table `tbl_dataset`
--
ALTER TABLE `tbl_dataset`
  ADD PRIMARY KEY (`id_dataset`);

--
-- Indexes for table `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id_login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cluster`
--
ALTER TABLE `tbl_cluster`
  MODIFY `id_cluster` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_dataset`
--
ALTER TABLE `tbl_dataset`
  MODIFY `id_dataset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
