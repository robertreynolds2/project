-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2021 at 12:41 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(10) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama`, `username`, `password`, `foto`) VALUES
(1, 'DEDI HUMAEDI', 'dedi', '123456', 'profil.png'),
(2, 'Riki Kurnia', 'riki', '123456', 'profil.png'),
(3, 'Sandi Maulana', 'sandi', '123456', 'profil.png'),
(4, 'Bayu Gaggu', 'bayu', '123456', 'profil.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mobil`
--

CREATE TABLE `tbl_mobil` (
  `id_mobil` int(10) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `warna` varchar(100) DEFAULT NULL,
  `plat` varchar(25) DEFAULT NULL,
  `kursi` int(1) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `harga` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mobil`
--

INSERT INTO `tbl_mobil` (`id_mobil`, `nama`, `warna`, `plat`, `kursi`, `gambar`, `harga`) VALUES
(1, 'Mercedes-Benz A 200 ', 'Silver', 'A 10210 MIN      ', 2, 'Harga Mobil Mercedes Benz Terbaru.png', 600000),
(2, 'Toyota Kijang Innova', 'Putih', 'B 2021 ASW', 6, 'kijang-inova.jpg', 400000),
(3, 'Toyota Fortuner', 'Abu Abu', 'B 011021 COK', 8, 'fortuner-abu.jpg', 500000),
(4, 'Toyota Avanza', 'Putih', 'B 2331 IKK', 6, 'avansa-putih.jpg', 200000),
(5, 'Daihatsu Xenia', 'Hitam', 'B 1212 NEN', 6, 'avansa-hitam.png', 300000),
(13, 'Suzuki All New Ertiga', 'Putih', 'R 1739 KN', 6, 'suzuki-all-new-ertiga-1579279546.png', 300000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_trans` int(10) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `menyewa` varchar(100) DEFAULT NULL,
  `warna` varchar(100) DEFAULT NULL,
  `harga` varchar(100) DEFAULT NULL,
  `tgl_transaksi` varchar(255) DEFAULT NULL,
  `tgl_pengembalian` varchar(254) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `id_mobil` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_trans`, `nama`, `menyewa`, `warna`, `harga`, `tgl_transaksi`, `tgl_pengembalian`, `gambar`, `id_mobil`) VALUES
(1, 'Riki Kurnia', 'Mercedes-Benz A 200 ', 'Silver', '600.000', '06-Apr-2021,  07:26:56 AM', '07-Apr-2021,  07:26:56 AM', 'Harga Mobil Mercedes Benz Terbaru.png', 1),
(6, 'DEDI HUMAEDI', 'Toyota Kijang Innova', 'Putih', '400.000', '06-Apr-2021,  07:39:53 AM', '07-Apr-2021,  07:39:53 AM', 'kijang-inova.jpg', 2),
(7, 'Sandi Maulana', 'Mercedes-Benz A 200 ', 'Silver', '600.000', '06-Apr-2021,  07:40:25 AM', '07-Apr-2021,  07:40:25 AM', 'Harga Mobil Mercedes Benz Terbaru.png', 1),
(23, 'Bayu Gaggu', 'Suzuki All New Ertiga', 'Putih', '300.000', '06-Apr-2021,  08:34:59 AM', '07-Apr-2021,  08:34:59 AM', 'suzuki-all-new-ertiga-1579279546.png', 13);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `username`, `password`) VALUES
(1, 'Admin', 'administrator', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `tbl_mobil`
--
ALTER TABLE `tbl_mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_trans`),
  ADD KEY `id_mobil` (`id_mobil`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_mobil`
--
ALTER TABLE `tbl_mobil`
  MODIFY `id_mobil` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_trans` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_mobil`) REFERENCES `tbl_mobil` (`id_mobil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
