-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 09:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `harvestfarm`
--

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` longblob DEFAULT NULL,
  `tanggal_tambah` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `kategori`, `harga`, `stok`, `deskripsi`, `gambar`, `tanggal_tambah`) VALUES
(2, 'Tomat Segar', 'Sayuran', 8000.00, 50, 'Tomat segar baru dipanen dari kebun', 0x746f6d61742e6a7067, '2025-04-17 06:56:47'),
(3, 'Mangga Harum Manis', 'Buah', 12000.00, 30, 'Mangga harum manis manis dan segar', 0x6d616e6767612e6a7067, '2025-04-17 06:56:47'),
(4, 'Kopi Robusta', 'Minuman', 25000.00, 20, 'Kopi robusta dari perkebunan lokal', 0x6b6f70692e6a7067, '2025-04-17 06:56:47'),
(5, 'Kentang', 'Sayuran', 7000.00, 80, 'Kentang segar ukuran besar', 0x6b656e74616e672e6a7067, '2025-04-17 06:56:47'),
(6, 'Jagung Manis', 'Biji-bijian', 5000.00, 60, 'Jagung manis yang baru dipanen', 0x6a6167756e672e6a7067, '2025-04-17 06:56:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
