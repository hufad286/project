-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2024 at 08:45 AM
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
-- Database: `db_ukk`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`` PROCEDURE `lihat_laporan` ()   SELECT produk.nama_produk, produk.harga_beli, produk.harga_jual, produk.stok
FROM produk

ORDER BY produk.stok ASC$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail` int(11) NOT NULL,
  `id_penjualan` bigint(20) NOT NULL,
  `idProduk` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail`, `id_penjualan`, `idProduk`, `qty`, `total_harga`) VALUES
(1, 4, 21, 3, 36000),
(2, 4, 18, 5, 60000),
(3, 4, 26, 5, 60000),
(4, 4, 17, 2, 24000),
(5, 4, 18, 2, 24000),
(6, 4, 20, 1, 12000),
(7, 4, 33, 12, 240000),
(8, 6, 19, 1, 12000),
(9, 6, 17, 2, 24000),
(10, 6, 25, 2, 24000),
(11, 6, 34, 3, 45000),
(12, 6, 30, 2, 24000),
(13, 7, 20, 2, 24000),
(14, 7, 32, 3, 36000),
(15, 7, 31, 1, 12000),
(16, 7, 32, 10, 120000),
(17, 7, 24, 2, 24000),
(18, 7, 34, 1, 15000),
(19, 7, 22, 1, 12000),
(20, 7, 34, 1, 15000),
(21, 7, 17, 2, 24000),
(22, 7, 35, 2, 40000),
(23, 7, 22, 4, 48000),
(24, 7, 18, 33, 396000),
(25, 7, 29, 1, 12000),
(26, 7, 27, 1, 0),
(27, 8, 23, 1, 12000),
(28, 8, 34, 0, 0),
(29, 8, 35, 5, 0),
(30, 8, 35, 3, 0),
(31, 10, 21, 2, 24000),
(32, 10, 17, 2, 0),
(33, 10, 17, 2, 0),
(34, 10, 17, 4, 0),
(35, 11, 17, 2, 24000),
(36, 11, 27, 4, 0),
(37, 11, 18, 4, 0),
(38, 11, 17, 5, 0),
(39, 11, 17, 5, 0),
(40, 11, 19, 2, 0),
(41, 11, 17, 10, 0),
(42, 11, 18, 6, 0),
(43, 11, 17, 2, 0),
(44, 12, 17, 2, 24000),
(45, 12, 19, 4, 0),
(46, 13, 17, 5, 60000),
(47, 13, 17, 4, 48000),
(48, 13, 19, 4, 48000),
(49, 14, 17, 7, 84000),
(50, 15, 17, 5, 60000);

--
-- Triggers `detail_penjualan`
--
DELIMITER $$
CREATE TRIGGER `kurangiStok` AFTER INSERT ON `detail_penjualan` FOR EACH ROW UPDATE produk SET produk.stok = produk.stok - NEW.qty
WHERE produk.idProduk = NEW.idProduk
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `nambahTotalHarga` AFTER INSERT ON `detail_penjualan` FOR EACH ROW UPDATE penjualan SET penjualan.total=penjualan.total+NEW.total_harga
WHERE penjualan.id_penjualan=NEW.id_penjualan
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `katid` int(11) NOT NULL,
  `katnama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`katid`, `katnama`) VALUES
(1, 'makanan'),
(16, 'minuman');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` bigint(20) NOT NULL,
  `no_faktur` varchar(50) NOT NULL,
  `tgl_penjualan` datetime NOT NULL,
  `idUser` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `no_faktur`, `tgl_penjualan`, `idUser`, `total`) VALUES
(8, 'INVC2402270001', '2024-02-27 09:17:53', 12, 12000),
(9, 'INVC2402270002', '2024-02-27 10:55:05', 12, 0),
(10, 'INVC2402270003', '2024-02-27 10:55:12', 12, 24000),
(11, 'INVC2402270004', '2024-02-27 12:10:01', 12, 24000),
(12, 'INVC2402270005', '2024-02-27 14:17:30', 12, 24000),
(13, 'INVC2402270006', '2024-02-27 14:25:47', 12, 156000),
(14, 'INVC2402270007', '2024-02-27 14:39:47', 12, 84000),
(15, 'INVC2402270008', '2024-02-27 14:42:42', 12, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idProduk` int(11) NOT NULL,
  `kode_produk` varchar(25) NOT NULL,
  `nama_produk` varchar(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `diskon` decimal(10,0) NOT NULL,
  `katid` int(11) NOT NULL,
  `satid` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idProduk`, `kode_produk`, `nama_produk`, `harga_beli`, `harga_jual`, `diskon`, `katid`, `satid`, `stok`) VALUES
(17, '8999908000101', 'NEO RHEUMAC', 10000, 12000, '0', 1, 3, 145),
(18, '8999908000200', 'BODREX TAB ', 10000, 12000, '0', 1, 3, 190),
(19, '8999908000705', 'BODREXIN 20', 10000, 12000, '0', 1, 3, 190),
(20, '8999908000903', 'FLUCYL 4TAB', 10000, 12000, '0', 1, 3, -35900),
(21, '8999908001108', 'FLUCYL SIRU', 10000, 12000, '0', 1, 3, -59900),
(22, '8999908082701', 'MARINA UV W', 10000, 12000, '0', 1, 3, -59900),
(23, '8999908082800', 'MARINA HAND', 10000, 12000, '0', 1, 3, -11900),
(24, '8999908082909', 'MARINA HAND', 10000, 12000, '0', 1, 3, -23900),
(25, '8999908083005', 'MARINA HAND', 10000, 12000, '0', 1, 3, -23900),
(26, '8999908083104', 'MARINA HAND', 10000, 12000, '0', 1, 3, -59900),
(27, '8999908083203', 'MARINA HAND', 10000, 12000, '0', 1, 3, 96),
(28, '8999908083302', 'MARINA HAND', 10000, 12000, '0', 1, 3, 100),
(29, '8999908083401', 'MARINA HAND', 10000, 12000, '0', 1, 3, -11900),
(30, '8999908083500', 'MARINA HAND', 10000, 12000, '0', 1, 3, -23900),
(31, '8999908083609', 'MARINA HAND', 10000, 12000, '0', 1, 3, -11900),
(32, '8999908083708', 'MARINA HAND', 10000, 12000, '0', 1, 3, -155900),
(34, 'PRD9908083709', 'mie', 10000, 15000, '5', 1, 3, -74900),
(35, 'PRD9908083710', 'tt', 10000, 20000, '4', 1, 3, -39000);

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `satid` int(11) NOT NULL,
  `satnama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`satid`, `satnama`) VALUES
(3, 'sachet'),
(7, 'pcs'),
(8, 'kg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `Nama_User` varchar(225) NOT NULL,
  `Password` varchar(225) NOT NULL,
  `Level` enum('admin','kasir') NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `Nama_User`, `Password`, `Level`, `username`) VALUES
(12, 'arif hidayat', '202cb962ac59075b964b07152d234b70', 'admin', 'arif'),
(14, 'herli ', '202cb962ac59075b964b07152d234b70', 'kasir', 'her'),
(15, 'klis', '202cb962ac59075b964b07152d234b70', 'kasir', 'muklis');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_penjualan` (`id_penjualan`),
  ADD KEY `idProduk` (`idProduk`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`katid`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idProduk`),
  ADD KEY `katid` (`katid`),
  ADD KEY `satid` (`satid`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`satid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `katid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idProduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `satid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`satid`) REFERENCES `satuan` (`satid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`katid`) REFERENCES `kategori` (`katid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
