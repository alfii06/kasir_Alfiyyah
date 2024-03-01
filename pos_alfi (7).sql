-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 06:08 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_alfi`
--

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `toko_id`, `nama_pelanggan`, `alamat`, `no_hp`, `created_at`) VALUES
(4, 1, 'Alfiyyah', 'Kota Banjar', '083426747493', '2024-02-19 06:27:59'),
(8, 1, 'Hasna', 'Banjar Patroman', '081364839285', '2024-02-19 06:28:12'),
(9, 1, 'Ananda', 'Kota Bandung', '083426747594', '2024-02-19 06:28:17'),
(11, 1, 'Azizah', 'Banjar Patroman', '081364839285', '2024-02-19 00:40:25'),
(14, 1, 'Intan', 'Ciamis', '081364839285', '2024-02-20 00:55:23');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `pembelian_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `no_faktur` varchar(50) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `suplier_id` int(11) NOT NULL,
  `total` varchar(11) NOT NULL,
  `bayar` varchar(11) NOT NULL,
  `sisa` varchar(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`pembelian_id`, `toko_id`, `user_id`, `no_faktur`, `tanggal_pembelian`, `suplier_id`, `total`, `bayar`, `sisa`, `keterangan`, `created_at`) VALUES
(3, 1, 1, '1', '2024-02-15', 1, '15000', '20000', '5000', 'bcfgf', '2024-02-14 17:00:00'),
(4, 1, 2, '465854', '2024-02-16', 1, '50.000', ' 50.000', '0', 'test', '2024-02-16 02:28:35'),
(5, 1, 2, '465854', '2024-02-16', 111, '50.000', 'Rp 50,000', '0', 'test', '2024-02-15 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_detail`
--

CREATE TABLE `pembelian_detail` (
  `beli_detail_id` int(11) NOT NULL,
  `pembelian_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `pelanggan` int(11) NOT NULL,
  `total` varchar(50) NOT NULL,
  `bayar` varchar(50) NOT NULL,
  `sisa` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`penjualan_id`, `toko_id`, `user_id`, `tanggal_penjualan`, `pelanggan`, `total`, `bayar`, `sisa`, `keterangan`, `created_at`) VALUES
(4, 1, 2, '2024-02-20', 4, '', '', '', '', '2024-02-19 17:00:00'),
(5, 1, 2, '2024-02-20', 11, '', '', '', '', '2024-02-19 17:00:00'),
(6, 1, 2, '2024-02-19', 14, '', '', '', '', '2024-02-19 17:00:00'),
(7, 1, 2, '2024-02-20', 8, '', '', '', '', '2024-02-19 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `penjualan_detail_id` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`penjualan_detail_id`, `penjualan_id`, `produk_id`, `qty`, `harga_beli`, `harga_jual`, `created_at`) VALUES
(14, 7, 1, 1, 2000, 2500, '2024-02-20 10:41:44'),
(15, 7, 1, 2, 2000, 5000, '2024-02-20 10:41:51'),
(16, 7, 1, 4, 2000, 10000, '2024-02-20 10:41:59'),
(17, 7, 7, 2, 12000, 26000, '2024-02-20 10:43:29'),
(18, 7, 7, 2, 12000, 26000, '2024-02-20 10:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produk_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga_beli` varchar(11) NOT NULL,
  `harga_jual` varchar(11) NOT NULL,
  `stok_barang` varchar(50) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produk_id`, `toko_id`, `nama_produk`, `kategori_id`, `satuan`, `harga_beli`, `harga_jual`, `stok_barang`, `created_at`) VALUES
(13, 1, 'Pensil', 3, 'pcs', '4.000', '5.000', '50', 2024),
(14, 1, 'Pulpen', 4, 'pcs', '2000', '3.000', '35', 2024),
(15, 1, 'Lem', 5, 'pcs', '2000', '3.000', '20', 2024),
(16, 1, 'Penggaris', 2, 'pcs', '3000', '4000', '60', 2024),
(17, 1, 'Buku Gambar', 1, 'pcs', '4000', '4500', '75', 2024);

-- --------------------------------------------------------

--
-- Table structure for table `produk_kategori`
--

CREATE TABLE `produk_kategori` (
  `kategori_id` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_kategori`
--

INSERT INTO `produk_kategori` (`kategori_id`, `nama_kategori`, `created_at`) VALUES
(1, 'buku', '2024-03-01 03:10:47'),
(2, 'penggaris', '2024-03-01 03:11:04'),
(3, 'pensil', '2024-03-01 03:11:28'),
(4, 'pulpen', '2024-03-01 03:11:46'),
(5, 'lem', '2024-03-01 03:12:03');

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `suplier_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `nama_suplier` varchar(50) NOT NULL,
  `tlp_suplier` varchar(50) NOT NULL,
  `alamat_suplier` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`suplier_id`, `toko_id`, `nama_suplier`, `tlp_suplier`, `alamat_suplier`, `created_at`) VALUES
(1, 1, 'Dani', '0846573845921', 'Ciamis', '2024-02-06 01:45:58'),
(2, 2, 'Ya', '08968596044582', 'Pangandaran', '2024-02-06 02:18:11'),
(3, 3, 'Al', '085766421549', 'Kota Banjar', '2024-02-06 02:18:24');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pelanggan`
--

CREATE TABLE `tabel_pelanggan` (
  `pelanggan_id` int(11) NOT NULL,
  `toko` varchar(255) DEFAULT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_pelanggan`
--

INSERT INTO `tabel_pelanggan` (`pelanggan_id`, `toko`, `nama_pelanggan`, `alamat`, `no_hp`, `created_at`) VALUES
(1, NULL, 'Alfiyyah', 'Banjar', '083426747493', '2024-01-30 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `toko_id` int(11) NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tlp_hp` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`toko_id`, `nama_toko`, `alamat`, `tlp_hp`, `created_at`) VALUES
(1, 'PT. dhhgf', 'Kota Banjar', '086583465734', '2024-02-12 06:38:21');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `toko_id`, `username`, `password`, `email`, `nama_lengkap`, `alamat`, `role`, `created_at`) VALUES
(1, 1, 'admin', '$2y$10$AbnUkAti8yfZS7oA.nl6Ou1D7NfvrnPOnYsxzkb35xCt4RbIcA0De', 'admin@gmail.com', 'Admin', 'Kota Banjar', 'admin', '2024-02-13 04:19:03'),
(2, 2, 'petugas', '$2y$10$7MbMKG86gM7zdCJBP7WQue1qFnEDCQJh1tThKQQsogCf.qbHPR8nS', 'petugas@gmail.com', 'Petugas', 'Banjar', 'petugas', '2024-02-13 04:19:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`pembelian_id`);

--
-- Indexes for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD PRIMARY KEY (`beli_detail_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`penjualan_id`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`penjualan_detail_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indexes for table `produk_kategori`
--
ALTER TABLE `produk_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`suplier_id`);

--
-- Indexes for table `tabel_pelanggan`
--
ALTER TABLE `tabel_pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`toko_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `pembelian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  MODIFY `beli_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `penjualan_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `produk_kategori`
--
ALTER TABLE `produk_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
  MODIFY `suplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tabel_pelanggan`
--
ALTER TABLE `tabel_pelanggan`
  MODIFY `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `toko_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
