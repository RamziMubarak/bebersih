-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2023 at 05:53 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clean`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(50) NOT NULL DEFAULT 'NULL',
  `email_admin` varchar(50) DEFAULT NULL,
  `password_admin` varchar(50) DEFAULT NULL,
  `nama_admin` varchar(50) DEFAULT NULL,
  `no_telp` varchar(50) DEFAULT NULL,
  `photo_admin` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `email_admin`, `password_admin`, `nama_admin`, `no_telp`, `photo_admin`) VALUES
('1', 'ramzi@gmail.com', 'ramzi123', 'Ramzi Mubarak', '0849389483', 'admin1.png'),
('2', 'daffa@gmail.com', 'daffa123', 'Daffa Satria', '087436743', 'admin2.png'),
('3', 'lazuardi@gmail.com', 'lazuardi123', 'Ananta Lazuardi', '0589438958', 'admin3.png');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `email_customer` varchar(50) DEFAULT NULL,
  `password_customer` varchar(50) DEFAULT NULL,
  `nama_customer` varchar(50) DEFAULT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `no_telp` varchar(50) DEFAULT NULL,
  `photo_customer` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `email_customer`, `password_customer`, `nama_customer`, `alamat`, `no_telp`, `photo_customer`) VALUES
(1, 'lazuardi@gmail.com', 'lazuardi123', 'Lazuardi', 'Jalan Sukajadi', '088378232', 'customer1.png'),
(2, 'alzildan@gmail.com', 'alzildan123', 'Al Zildan', 'Jalan Dago', '0883434322', 'customer2.png'),
(3, 'bagas@gmail.com', 'bagas123', 'Bagas Praditya', 'Ujung Berung', '088378232', 'customer3.png'),
(4, 'adien@gmail.com', 'adien123', 'Adien Fadhillah', 'Cimahi', '08854645', 'pekerja4.png'),
(5, 'jasmine@gmail.com', 'jasmine123', 'Jasmine Putri', 'Sukasenang', '0885454542', 'pekerja5.png'),
(6, 'dewi@gmail.com', 'dewi123', 'Dewi Saputri', 'Jalan Bale Endah', '08853453412', 'pekerja6.png'),
(8, 'test@gmail.com', '1', '1', '1', '1', 'admin2.png'),
(9, 'asep@gmail.com', 'asep123', 'asep', 'Cibinong', '3404930349', 'admin3.png');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(11) NOT NULL,
  `nama_layanan` varchar(100) DEFAULT NULL,
  `desc` varchar(255) NOT NULL,
  `harga` varchar(100) DEFAULT NULL,
  `photo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nama_layanan`, `desc`, `harga`, `photo`) VALUES
(1, 'Paket A', 'Pada paket ini menawarkan pembersihan rumah secara menyeluruh. Mulai dari menyapu, mengepel, dan pembersihan kaca.', '250000', 'paketa.png'),
(2, 'Paket B', 'General Cleaning + Hydro Cleaning ,  Pada paket ini menawarkan kebersihan rumah secara menyeluruh, ditambahkan pembersih bantal , kasur(1 Sisi),Sofa dan gorden dengan vacuum khusus', '325000', 'paketb.png'),
(3, 'Paket C', 'General Cleaning + AC cleaning,', '350000', 'paketc.png'),
(4, 'Paket D', 'Hydro Cleaning,Pada paket ini menawarkan pembersihan bantal, sofa, kasur (2 sisi), dan gorden secara menyeluruh, bebas tungau dan debu. ', '275000', 'paketd.png'),
(5, 'Paket E', 'General Cleaning + AC Cleaning + Hydro Cleaning Pada Paket ini Menawarkan pembersihan secara keseluruhan mulai dari ruangan, pergantian bantal, kasur, sofa, dll. Ditambah dengan pembersihan AC.', '750000', 'pakete.png'),
(6, 'Paket F', 'General Cleaning + Fogging  Pada paket ini menawarkan pembersihan rumah secara menyeluruh ditambahkan dengan disinfeksi menggunakan mesin mutakhir untuk mengurangi penyebaran virus.', '375000', 'paketf.png');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `Total` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_rumah` varchar(15) NOT NULL,
  `no_wa` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id_order`, `id_layanan`, `id_customer`, `Total`, `tanggal`, `status`, `nama`, `no_rumah`, `no_wa`, `alamat`) VALUES
(1, 3, 3, 350000, '2023-06-09', 'Layanan Selesai', 'Bagas', '098747893', '089978683929', 'Jalan Gagak no 81');

-- --------------------------------------------------------

--
-- Table structure for table `pekerja`
--

CREATE TABLE `pekerja` (
  `id_pekerja` int(11) NOT NULL,
  `email_pekerja` varchar(100) NOT NULL,
  `password_pekerja` varchar(100) NOT NULL,
  `nama_pekerja` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `photo_pekerja` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pekerja`
--

INSERT INTO `pekerja` (`id_pekerja`, `email_pekerja`, `password_pekerja`, `nama_pekerja`, `no_telp`, `photo_pekerja`) VALUES
(1, 'adin@gmail.com', 'adin123', 'Adien Fadhzilah', '0908954546', 'pekerja1.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `FK__pekerja` (`id_layanan`) USING BTREE,
  ADD KEY `FK_order_customer` (`id_customer`);

--
-- Indexes for table `pekerja`
--
ALTER TABLE `pekerja`
  ADD PRIMARY KEY (`id_pekerja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pekerja`
--
ALTER TABLE `pekerja`
  MODIFY `id_pekerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_order_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_order_layanan` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
