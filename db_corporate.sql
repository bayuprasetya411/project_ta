-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Des 2019 pada 06.31
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_corporate`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_area`
--

CREATE TABLE `tb_area` (
  `id_area` int(5) NOT NULL,
  `area` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_area`
--

INSERT INTO `tb_area` (`id_area`, `area`) VALUES
(1, 'KLM'),
(2, 'SAU'),
(3, 'TOP'),
(4, 'SWI'),
(5, 'UBN'),
(6, 'SMY'),
(7, 'MMN'),
(8, 'BNO'),
(9, 'KUT'),
(10, 'JBR'),
(11, 'NSD');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` varchar(5) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `bobot_kriteria` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `nama_kriteria`, `bobot_kriteria`) VALUES
('C1', 'Presensi', 15),
('C2', 'Disiplin', 35),
('C3', 'Produktifitas', 30),
('C4', 'Gaul', 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `id_nilai` int(5) NOT NULL,
  `nik` int(8) NOT NULL,
  `id_kriteria` varchar(5) NOT NULL,
  `id_sub_kriteria` varchar(5) NOT NULL,
  `id_periode` int(5) NOT NULL,
  `nilai_akhir` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_nilai`
--

INSERT INTO `tb_nilai` (`id_nilai`, `nik`, `id_kriteria`, `id_sub_kriteria`, `id_periode`, `nilai_akhir`) VALUES
(1, 97150001, 'C1', '2', 4, 55),
(2, 97150001, 'C2', '14', 4, 55),
(3, 97150001, 'C3', '28', 4, 55),
(4, 97150001, 'C4', '45', 4, 55),
(5, 90160129, 'C1', '1', 4, 62.5),
(6, 90160129, 'C2', '14', 4, 62.5),
(7, 90160129, 'C3', '25', 4, 62.5),
(8, 90160129, 'C4', '45', 4, 62.5),
(9, 97156683, 'C1', '1', 4, 33),
(10, 97156683, 'C2', '19', 4, 33),
(11, 97156683, 'C3', '26', 4, 33),
(12, 97156683, 'C4', '45', 4, 33),
(13, 97154504, 'C1', '1', 4, 59.5),
(14, 97154504, 'C2', '14', 4, 59.5),
(15, 97154504, 'C3', '27', 4, 59.5),
(16, 97154504, 'C4', '45', 4, 59.5),
(17, 95154500, 'C1', '1', 4, 31.5),
(18, 95154500, 'C2', '19', 4, 31.5),
(19, 95154500, 'C3', '27', 4, 31.5),
(20, 95154500, 'C4', '45', 4, 31.5),
(21, 72160007, 'C1', '1', 4, 52),
(22, 72160007, 'C2', '14', 4, 52),
(23, 72160007, 'C3', '32', 4, 52),
(24, 72160007, 'C4', '45', 4, 52),
(25, 78160010, 'C1', '1', 4, 42),
(26, 78160010, 'C2', '19', 4, 42),
(27, 78160010, 'C3', '28', 4, 42),
(28, 78160010, 'C4', '41', 4, 42),
(29, 17900202, 'C1', '1', 4, 53),
(30, 17900202, 'C2', '15', 4, 53),
(31, 17900202, 'C3', '29', 4, 53),
(32, 17900202, 'C4', '45', 4, 53),
(33, 94150611, 'C1', '1', 4, 49.5),
(34, 94150611, 'C2', '16', 4, 49.5),
(35, 94150611, 'C3', '29', 4, 49.5),
(36, 94150611, 'C4', '45', 4, 49.5),
(37, 89150606, 'C1', '1', 4, 56.5),
(38, 89150606, 'C2', '14', 4, 56.5),
(39, 89150606, 'C3', '29', 4, 56.5),
(40, 89150606, 'C4', '45', 4, 56.5),
(53, 97154504, 'C1', '1', 7, 68.5),
(54, 97154504, 'C2', '14', 7, 68.5),
(55, 97154504, 'C3', '29', 7, 68.5),
(56, 97154504, 'C4', '41', 7, 68.5),
(57, 97150001, 'C1', '1', 7, 53),
(58, 97150001, 'C2', '15', 7, 53),
(59, 97150001, 'C3', '29', 7, 53),
(60, 97150001, 'C4', '45', 7, 53),
(61, 97158142, 'C1', '2', 7, 44),
(62, 97158142, 'C2', '17', 7, 44),
(63, 97158142, 'C3', '26', 7, 44),
(64, 97158142, 'C4', '45', 7, 44),
(65, 97156683, 'C1', '1', 7, 55.5),
(66, 97156683, 'C2', '16', 7, 55.5),
(67, 97156683, 'C3', '25', 7, 55.5),
(68, 97156683, 'C4', '45', 7, 55.5),
(69, 96156700, 'C1', '1', 7, 53.5),
(70, 96156700, 'C2', '14', 7, 53.5),
(71, 96156700, 'C3', '31', 7, 53.5),
(72, 96156700, 'C4', '45', 7, 53.5),
(73, 98170027, 'C1', '1', 7, 55),
(74, 98170027, 'C2', '14', 7, 55),
(75, 98170027, 'C3', '30', 7, 55),
(76, 98170027, 'C4', '45', 7, 55),
(77, 97150001, 'C1', '1', 6, 75),
(78, 97150001, 'C2', '14', 6, 75),
(79, 97150001, 'C3', '22', 6, 75),
(80, 97150001, 'C4', '42', 6, 75);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_periode`
--

CREATE TABLE `tb_periode` (
  `id_periode` int(5) NOT NULL,
  `nama_periode` varchar(20) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_periode`
--

INSERT INTO `tb_periode` (`id_periode`, `nama_periode`, `create_at`) VALUES
(4, 'Maret-2019', '2019-10-26 04:12:19'),
(6, 'Oktober-2019', '2019-10-27 08:45:17'),
(7, 'November-2019', '2019-11-01 10:18:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_periode_has_kriteria`
--

CREATE TABLE `tb_periode_has_kriteria` (
  `id_periode` int(5) NOT NULL,
  `id_kriteria` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_periode_has_kriteria`
--

INSERT INTO `tb_periode_has_kriteria` (`id_periode`, `id_kriteria`) VALUES
(4, 'C1'),
(4, 'C2'),
(4, 'C3'),
(4, 'C4'),
(6, 'C1'),
(6, 'C2'),
(6, 'C3'),
(6, 'C4'),
(7, 'C1'),
(7, 'C2'),
(7, 'C3'),
(7, 'C4'),
(0, 'C1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_subkriteria`
--

CREATE TABLE `tb_subkriteria` (
  `id_sub_kriteria` int(5) NOT NULL,
  `nama_sub_kriteria` varchar(50) NOT NULL,
  `nilai_sub_kriteria` double NOT NULL,
  `id_kriteria` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_subkriteria`
--

INSERT INTO `tb_subkriteria` (`id_sub_kriteria`, `nama_sub_kriteria`, `nilai_sub_kriteria`, `id_kriteria`) VALUES
(1, '>= 22 Hari', 100, 'C1'),
(2, '20 < 22 Hari', 80, 'C1'),
(3, '18 < 20 Hari', 70, 'C1'),
(4, '16 < 18 Hari', 60, 'C1'),
(5, '14 < 16 Hari', 50, 'C1'),
(6, '12 < 14 Hari', 40, 'C1'),
(7, '10 < 12 Hari', 30, 'C1'),
(8, '8 < 10 Hari', 10, 'C1'),
(9, '1 < 5 Hari', 5, 'C1'),
(10, '0', 0, 'C1'),
(11, '>= 100 %', 100, 'C3'),
(12, '95 < 100 %', 95, 'C3'),
(13, '0 Pelanggaran', 100, 'C2'),
(14, '1 Pelanggaran', 80, 'C2'),
(15, '2 Pelanggaran', 70, 'C2'),
(16, '3 Pelanggaran', 60, 'C2'),
(17, '4 Pelanggaran', 40, 'C2'),
(18, '5 Pelanggaran', 20, 'C2'),
(19, '> 5 Pelanggaran', 0, 'C2'),
(20, '90 < 95 %', 90, 'C3'),
(21, '85 < 90 %', 85, 'C3'),
(22, '80 < 85 %', 80, 'C3'),
(23, '75 < 80 %', 75, 'C3'),
(24, '70 < 75 %', 70, 'C3'),
(25, '65 < 70 %', 65, 'C3'),
(26, '60 < 65 %', 60, 'C3'),
(27, '55 < 60 %', 55, 'C3'),
(28, '50 < 55 %', 50, 'C3'),
(29, '45 < 50 %', 45, 'C3'),
(30, '40 < 45 %', 40, 'C3'),
(31, '35 < 40 %', 35, 'C3'),
(32, '30 < 35 %', 30, 'C3'),
(33, '25 < 30 %', 25, 'C3'),
(34, '20 < 25 %', 20, 'C3'),
(35, '15 < 20 %', 15, 'C3'),
(36, '10 < 15 %', 10, 'C3'),
(37, '1 < 10 %', 5, 'C3'),
(38, '0', 0, 'C3'),
(39, '0 %', 100, 'C4'),
(40, '< 1 %', 80, 'C4'),
(41, '1 < 2 %', 60, 'C4'),
(42, '2 < 3 %', 40, 'C4'),
(43, '3 < 4 %', 20, 'C4'),
(44, '5 %', 10, 'C4'),
(45, '> 5 %', 0, 'C4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_teknisi`
--

CREATE TABLE `tb_teknisi` (
  `nik` int(8) NOT NULL,
  `nama` varchar(50) DEFAULT 'Not Null',
  `no_telpon` varchar(13) DEFAULT 'Not Null',
  `id_area` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_teknisi`
--

INSERT INTO `tb_teknisi` (`nik`, `nama`, `no_telpon`, `id_area`) VALUES
(17900202, 'I Gede Satya Wiguna', '085792060470', 1),
(17960663, 'I Wayan Yoshi Bagaskara', '085102531168', 3),
(18980118, 'I Nyoman Dhanajaya', '089634759200', 3),
(18990100, 'I Made Anom Widnyana Kusuma', '087861540392', 5),
(72160007, 'Nyoman Mudanayasa', '085100560865', 2),
(78160010, 'I Komang Kembaryasa', '085100760972', 5),
(82160008, 'Ketut Mandiawan Antara', '082212106814', 8),
(85160004, 'Ida Bagus Agung Surya Pujawan', '085101371202', 5),
(88160059, 'I Made Sutarna', '085815091323', 5),
(88170025, 'Suwadi', '081291770796', 1),
(89150606, 'Gede Marayasa', '087861954477', 9),
(89170032, 'I Made Dharmawan', '082212106830', 7),
(90160129, 'I Gede Suartama', '082212106829', 1),
(91170141, 'Kadek Wira Dharma', '082212106839', 1),
(92158138, 'Dewa Putu Gede Eka Patriana', '083115158477', 6),
(92160187, 'Ade Hendrawan', '081337414083', 5),
(92160306, 'Gede Edwin Ferlangga', '085100450675', 1),
(93151034, 'I Nyoman Rai Sutrisna', '081246529002', 5),
(94150611, 'I Made Adi Winata', '082144118794', 8),
(95153600, 'Made Adhy Yoga Pramana', '081282027480', 2),
(95154500, 'I Nyoman Sako Trikayana', '081529096482', 6),
(95160281, 'Kadek Nova Widiasa', '081236763151', 5),
(95170251, 'I Kadek Agus Suardana', '08537778929', 8),
(96150439, 'Amirudin Hamzah', '081298822336', 2),
(96156700, 'Made Adi Mertadana', '081317901925', 1),
(97150001, 'I Gusti Agung Bayu Prasetya Dikayana', '081246734250', 1),
(97154504, 'Bagus Setiawan', '081317902007', 1),
(97156683, 'Pande Ady Mahardika', '081339684959', 1),
(97158142, 'Kadek Satria Adeguna', '081236849884', 1),
(97170032, 'I Wayan Eka TirtaYasa', '087861770482', 4),
(98170027, 'Made Merta Yasa', '081238681163', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_area`
--
ALTER TABLE `tb_area`
  ADD PRIMARY KEY (`id_area`),
  ADD KEY `id_wilayah` (`id_area`);

--
-- Indeks untuk tabel `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `tb_periode`
--
ALTER TABLE `tb_periode`
  ADD PRIMARY KEY (`id_periode`),
  ADD UNIQUE KEY `nama_periode` (`nama_periode`);

--
-- Indeks untuk tabel `tb_subkriteria`
--
ALTER TABLE `tb_subkriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`);

--
-- Indeks untuk tabel `tb_teknisi`
--
ALTER TABLE `tb_teknisi`
  ADD PRIMARY KEY (`nik`),
  ADD UNIQUE KEY `nik` (`nik`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_area`
--
ALTER TABLE `tb_area`
  MODIFY `id_area` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `id_nilai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT untuk tabel `tb_periode`
--
ALTER TABLE `tb_periode`
  MODIFY `id_periode` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_subkriteria`
--
ALTER TABLE `tb_subkriteria`
  MODIFY `id_sub_kriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
