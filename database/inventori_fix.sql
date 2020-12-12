-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 02, 2019 at 05:06 AM
-- Server version: 5.7.15-log
-- PHP Version: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventori_fix`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(128) NOT NULL,
  `username_admin` varchar(128) NOT NULL,
  `password_admin` varchar(128) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username_admin`, `password_admin`, `id_role`) VALUES
(4, 'qwe', 'qwe', '$2y$10$78A47obtELe6geVrRUAz0uouRIN1vc24qm/AsjhR3TDQ3.2Gf9zK.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `admin_akses`
--

CREATE TABLE `admin_akses` (
  `id_admin_akses` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_gudang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_akses`
--

INSERT INTO `admin_akses` (`id_admin_akses`, `id_admin`, `id_perusahaan`, `id_gudang`) VALUES
(1, 4, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_gudang` int(11) NOT NULL,
  `kode_barang` varchar(11) NOT NULL,
  `merk_barang` varchar(128) NOT NULL,
  `nama_barang` varchar(128) NOT NULL,
  `product_type_barang` varchar(128) NOT NULL,
  `ID` double NOT NULL,
  `OD` double NOT NULL,
  `thick_barang` double NOT NULL,
  `weight_barang` double NOT NULL,
  `total_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_perusahaan`, `id_gudang`, `kode_barang`, `merk_barang`, `nama_barang`, `product_type_barang`, `ID`, `OD`, `thick_barang`, `weight_barang`, `total_barang`) VALUES
(123, 5, 3, 'P1', 'Timken', 'Barang1', 'b', 13, 13, 13, 13, 9),
(126, 5, 4, 'P1', 'Timken', 'Barang1', 'b', 13, 13, 13, 13, 18),
(127, 5, 4, 'P2', 'SKF', 'Barang2', 'b', 89, 13, 13, 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `boking`
--

CREATE TABLE `boking` (
  `id_boking` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `no_surat` int(11) NOT NULL,
  `nama_boking` varchar(128) NOT NULL,
  `tanggal_boking` varchar(128) NOT NULL,
  `qty_boking` int(11) NOT NULL,
  `status_boking` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `boking`
--

INSERT INTO `boking` (`id_boking`, `id_barang`, `no_surat`, `nama_boking`, `tanggal_boking`, `qty_boking`, `status_boking`) VALUES
(101, 123, 345, 'Ramad', '2019-10-09', 4, 0);

--
-- Triggers `boking`
--
DELIMITER $$
CREATE TRIGGER `approved` AFTER UPDATE ON `boking` FOR EACH ROW BEGIN
	UPDATE barang SET total_barang=total_barang-NEW.qty_boking
    WHERE id_barang = NEW.id_barang
    AND NEW.status_boking = 1;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus_approved` AFTER DELETE ON `boking` FOR EACH ROW BEGIN
	UPDATE barang SET total_barang=total_barang+OLD.qty_boking
    WHERE id_barang = OLD.id_barang
    AND OLD.status_boking = 1;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `not_approved` AFTER UPDATE ON `boking` FOR EACH ROW BEGIN
	UPDATE barang SET total_barang=total_barang+NEW.qty_boking
    WHERE id_barang = NEW.id_barang
    AND NEW.status_boking = 0;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id_gudang` int(11) NOT NULL,
  `nama_gudang` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id_gudang`, `nama_gudang`) VALUES
(3, 'Pekanbaru'),
(4, 'Padang');

-- --------------------------------------------------------

--
-- Table structure for table `jual`
--

CREATE TABLE `jual` (
  `id_jual` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(128) NOT NULL,
  `username_pegawai` varchar(128) NOT NULL,
  `password_pegawai` varchar(128) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `username_pegawai`, `password_pegawai`, `id_role`) VALUES
(1, 'ramat', 'rmt', '$2y$10$4VPvw1Y2Mc2U6bNmn0k1leNQCUWXB4uSPQ7AmEVy.ICMsnaB43HgK', 2),
(3, 'ramat1', 'ramat1', '$2y$10$S4h3X/3/11KrFYQVJt4OdOG4NdwfmWUJ2YvB6H2T/MWtjqXekgbS2', 2),
(4, 'ramat2', 'ramat2', '$2y$10$z.2zO66n5ohI0uzreRYoAeTRU.om3wzXpGSw7GyiX0d7uKoyWeNiC', 2),
(5, 'bal', 'abb', '$2y$10$yjcMfTi/UlQEbslmss4ZUOFTsnIy/l9roLY9indFn1H1nnj9UYTr6', 2),
(6, 'asan', 'asan', '$2y$10$A/9eKCWFdGhUsgk51JlrQ.iS2u0hlxU7EwQ.C0PyktT.aIme.e5nK', 2),
(7, 'tess', 'tess', '$2y$10$xPGyR09/Dscl8/o6CO/RTOnoyhNYeNDJkKFOckaiKWX7MV7gDLSpq', 2),
(8, 'asdf', 'asdf', '$2y$10$t1bUwXkCyjWUnoSwn3N2buZhkwYZVXWf7vRppg0C9XUYKS2UqKu06', 2),
(9, 'asdqw', 'asdqw', '$2y$10$yjcN5/VFOPBfUwkUd.o7M.D5dwOzZf3Ojh8cc1R2B2pCUNXj4OyKq', 2),
(10, 'sdff', 'sdff', '$2y$10$HlN/AKWReb4JEp61xw1s7eX/pFsl/eJb59xVP1tjDP5hENktyErsu', 2),
(11, 'sdfff', 'sdfff', '$2y$10$USXzmdLNTxem8nXGsoWEC.tHu2WQcmHL81tI2nbn/D.uKhzKqbURm', 2),
(12, 'aaa', 'aa', '$2y$10$5F7MD6Tdl4.6ep98dWHjT.mHMjZiGnwztmM5wQlEO9LSE8GVHJY.G', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_akses`
--

CREATE TABLE `pegawai_akses` (
  `id_peg_akses` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pegawai_akses`
--

INSERT INTO `pegawai_akses` (`id_peg_akses`, `id_pegawai`, `id_perusahaan`) VALUES
(3, 3, 5),
(4, 3, 7),
(6, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `nama_perusahaan`) VALUES
(5, 'Perusahaan 1'),
(7, 'Perusahaan 2');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'sadmin'),
(2, 'pegawai'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tanggal_stok` varchar(128) NOT NULL,
  `nopo_stok` varchar(128) NOT NULL,
  `noreg_stok` varchar(128) NOT NULL,
  `masuk_stok` int(11) NOT NULL,
  `keluar_stok` int(11) NOT NULL,
  `harga_beli_stok` int(11) NOT NULL,
  `approve_stok` int(1) NOT NULL,
  `harga_jual_stok` int(11) NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  `harga_ongkos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_stok`, `id_barang`, `tanggal_stok`, `nopo_stok`, `noreg_stok`, `masuk_stok`, `keluar_stok`, `harga_beli_stok`, `approve_stok`, `harga_jual_stok`, `keterangan`, `harga_ongkos`) VALUES
(154, 123, '2019-10-24', '34t', '23f', 9, 0, 5000, 0, 0, 'd', 5000),
(157, 126, '2019-10-23', '34t', '23f', 9, 0, 5000, 0, 0, 'j', 5000),
(158, 126, '2019-10-23', '34t', '23f', 9, 0, 5000, 0, 0, 'j', 5000);

--
-- Triggers `stok`
--
DELIMITER $$
CREATE TRIGGER `delete_stok` AFTER DELETE ON `stok` FOR EACH ROW BEGIN
UPDATE barang 
set barang.total_barang = barang.total_barang - (old.masuk_stok - old.keluar_stok)
where id_barang = OLD.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_stok_barang` AFTER INSERT ON `stok` FOR EACH ROW BEGIN
	UPDATE barang SET total_barang=total_barang+(NEW.masuk_stok-NEW.keluar_stok)
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_keluar_stok` BEFORE UPDATE ON `stok` FOR EACH ROW BEGIN
	UPDATE barang 
    SET	total_barang = (total_barang + OLD.keluar_stok) - NEW.keluar_stok
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_masuk_stok` AFTER UPDATE ON `stok` FOR EACH ROW BEGIN
	UPDATE barang 
    SET	total_barang = (total_barang - OLD.masuk_stok) + NEW.masuk_stok
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `id_sa` int(11) NOT NULL,
  `nama_sa` varchar(128) NOT NULL,
  `username_sa` varchar(128) NOT NULL,
  `password_sa` varchar(128) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`id_sa`, `nama_sa`, `username_sa`, `password_sa`, `id_role`) VALUES
(1, 'ramat', 'ramat', '$2y$10$4VPvw1Y2Mc2U6bNmn0k1leNQCUWXB4uSPQ7AmEVy.ICMsnaB43HgK', 1),
(3, 'ramat1', 'ramat1', '$2y$10$S4h3X/3/11KrFYQVJt4OdOG4NdwfmWUJ2YvB6H2T/MWtjqXekgbS2', 1),
(4, 'ramat2', 'ramat2', '$2y$10$z.2zO66n5ohI0uzreRYoAeTRU.om3wzXpGSw7GyiX0d7uKoyWeNiC', 1),
(5, 'bal', 'abb', '$2y$10$yjcMfTi/UlQEbslmss4ZUOFTsnIy/l9roLY9indFn1H1nnj9UYTr6', 1),
(6, 'asan', 'asan', '$2y$10$A/9eKCWFdGhUsgk51JlrQ.iS2u0hlxU7EwQ.C0PyktT.aIme.e5nK', 1),
(7, 'tess', 'tess', '$2y$10$xPGyR09/Dscl8/o6CO/RTOnoyhNYeNDJkKFOckaiKWX7MV7gDLSpq', 1),
(8, 'asdf', 'asdf', '$2y$10$t1bUwXkCyjWUnoSwn3N2buZhkwYZVXWf7vRppg0C9XUYKS2UqKu06', 1),
(9, 'asdqw', 'asdqw', '$2y$10$yjcN5/VFOPBfUwkUd.o7M.D5dwOzZf3Ojh8cc1R2B2pCUNXj4OyKq', 1),
(10, 'sdff', 'sdff', '$2y$10$HlN/AKWReb4JEp61xw1s7eX/pFsl/eJb59xVP1tjDP5hENktyErsu', 1),
(11, 'sdfff', 'sdfff', '$2y$10$USXzmdLNTxem8nXGsoWEC.tHu2WQcmHL81tI2nbn/D.uKhzKqbURm', 1),
(12, 'aaa', 'aa', '$2y$10$5F7MD6Tdl4.6ep98dWHjT.mHMjZiGnwztmM5wQlEO9LSE8GVHJY.G', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `admin_akses`
--
ALTER TABLE `admin_akses`
  ADD PRIMARY KEY (`id_admin_akses`),
  ADD KEY `akses_admin` (`id_admin`),
  ADD KEY `akses_perusahaan_admin` (`id_perusahaan`),
  ADD KEY `akses_gudang_admin` (`id_gudang`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `perusahaan` (`id_gudang`),
  ADD KEY `brg_perusahaan` (`id_perusahaan`);

--
-- Indexes for table `boking`
--
ALTER TABLE `boking`
  ADD PRIMARY KEY (`id_boking`),
  ADD KEY `barang` (`id_barang`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_gudang`);

--
-- Indexes for table `jual`
--
ALTER TABLE `jual`
  ADD PRIMARY KEY (`id_jual`),
  ADD KEY `jual_stok` (`id_barang`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pegawai_akses`
--
ALTER TABLE `pegawai_akses`
  ADD PRIMARY KEY (`id_peg_akses`),
  ADD KEY `akses_pegawai` (`id_pegawai`),
  ADD KEY `akses_perusahaan` (`id_perusahaan`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `stok_barang` (`id_barang`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`id_sa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `admin_akses`
--
ALTER TABLE `admin_akses`
  MODIFY `id_admin_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT for table `boking`
--
ALTER TABLE `boking`
  MODIFY `id_boking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id_gudang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jual`
--
ALTER TABLE `jual`
  MODIFY `id_jual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `pegawai_akses`
--
ALTER TABLE `pegawai_akses`
  MODIFY `id_peg_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT for table `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `id_sa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_akses`
--
ALTER TABLE `admin_akses`
  ADD CONSTRAINT `akses_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akses_gudang_admin` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id_gudang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akses_perusahaan_admin` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `brg_gdg` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id_gudang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `brg_perusahaan` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `boking`
--
ALTER TABLE `boking`
  ADD CONSTRAINT `boking_brg` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jual`
--
ALTER TABLE `jual`
  ADD CONSTRAINT `jual_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai_akses`
--
ALTER TABLE `pegawai_akses`
  ADD CONSTRAINT `akses_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akses_perusahaan` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
