-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2018 at 05:25 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `apilogin`
--

CREATE TABLE `apilogin` (
  `id` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telfon` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `user` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `apikeys` varchar(40) NOT NULL,
  `tanggal` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apilogin`
--

INSERT INTO `apilogin` (`id`, `id_cabang`, `nama`, `email`, `telfon`, `alamat`, `user`, `pass`, `apikeys`, `tanggal`) VALUES
(16, 68, 'TokoPos Tembalang', 'tembalang@tokopos.com', '081588888888', 'Jl. Sirojudin, Tembalang', 'totem', 'Admin123', 'VeDLG34FbGj0GPpq', '2018-05-16 08:17:07.861359');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(16) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `stock` int(6) NOT NULL,
  `harga` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `stock`, `harga`) VALUES
('289038', 'Pocari Sweat Sedang 600ml', 10, 4000);

-- --------------------------------------------------------

--
-- Table structure for table `barangkeluar`
--

CREATE TABLE `barangkeluar` (
  `id` int(6) NOT NULL,
  `id_transaksi` varchar(14) NOT NULL,
  `id_staf` varchar(16) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `total_item` int(3) NOT NULL,
  `total_harga` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barangkeluar`
--

INSERT INTO `barangkeluar` (`id`, `id_transaksi`, `id_staf`, `nama`, `tanggal`, `total_item`, `total_harga`) VALUES
(10, 'O201805160001', 'um68017', 'Manager', '2018-05-16 11:21:57', 10, 40000);

-- --------------------------------------------------------

--
-- Table structure for table `barangkeluar_detail`
--

CREATE TABLE `barangkeluar_detail` (
  `id_keluar` int(6) NOT NULL,
  `id_transaksi` varchar(14) NOT NULL,
  `id_barang` varchar(16) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `harga_satuan` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barangkeluar_detail`
--

INSERT INTO `barangkeluar_detail` (`id_keluar`, `id_transaksi`, `id_barang`, `nama`, `jumlah`, `harga_satuan`) VALUES
(11, 'O201805160001', '289038', 'Pocari Sweat Sedang 600ml', 10, 4000);

-- --------------------------------------------------------

--
-- Table structure for table `barangmasuk`
--

CREATE TABLE `barangmasuk` (
  `id` int(6) NOT NULL,
  `id_transaksi` varchar(14) NOT NULL,
  `id_staf` varchar(16) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `total_item` int(3) NOT NULL,
  `total_harga` int(8) NOT NULL,
  `flag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barangmasuk`
--

INSERT INTO `barangmasuk` (`id`, `id_transaksi`, `id_staf`, `nama`, `tanggal`, `total_item`, `total_harga`, `flag`) VALUES
(25, 'out680056', 'um68017', 'Manager', '2018-05-16 11:18:48', 20, 80000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `barangmasuk_detail`
--

CREATE TABLE `barangmasuk_detail` (
  `id_masuk` int(6) NOT NULL,
  `id_transaksi` varchar(16) NOT NULL,
  `id_barang` varchar(16) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `harga_satuan` int(8) NOT NULL,
  `flag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barangmasuk_detail`
--

INSERT INTO `barangmasuk_detail` (`id_masuk`, `id_transaksi`, `id_barang`, `nama`, `jumlah`, `harga_satuan`, `flag`) VALUES
(26, 'out680056', '289038', 'Pocari Sweat Sedang 600ml', 20, 4000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staf`
--

CREATE TABLE `staf` (
  `id` int(3) NOT NULL,
  `id_staf` varchar(16) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `kunci` varchar(12) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `foto` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staf`
--

INSERT INTO `staf` (`id`, `id_staf`, `username`, `nama`, `email`, `kunci`, `level`, `foto`) VALUES
(0, 'up68019', 'johan', 'Johan', 'johanrahar@gmail.com', 'Johan123', 2, ''),
(1, 'um68017', 'manager', 'Manager', 'Manager@tokopos.com', 'Manager1', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apilogin`
--
ALTER TABLE `apilogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `barangkeluar`
--
ALTER TABLE `barangkeluar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `barangkeluar_detail`
--
ALTER TABLE `barangkeluar_detail`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indexes for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangmasuk_detail`
--
ALTER TABLE `barangmasuk_detail`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indexes for table `staf`
--
ALTER TABLE `staf`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apilogin`
--
ALTER TABLE `apilogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `barangkeluar`
--
ALTER TABLE `barangkeluar`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `barangkeluar_detail`
--
ALTER TABLE `barangkeluar_detail`
  MODIFY `id_keluar` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `barangmasuk_detail`
--
ALTER TABLE `barangmasuk_detail`
  MODIFY `id_masuk` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
