-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 02:14 PM
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
-- Database: `zafer`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `foto_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `foto_admin`) VALUES
(6, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Yasmin Hafiza', 'profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'For Women'),
(2, 'For Man'),
(3, 'For Unisex');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_pelanggan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_pelanggan`, `id_produk`, `jumlah`) VALUES
(5, 1, 1),
(7, 2, 1),
(7, 15, 1),
(7, 24, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password_pelanggan` varchar(50) NOT NULL,
  `telepon_pelanggan` varchar(255) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `email`, `password_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`) VALUES
(1, 'yasmin', 'yasmin@gmail.com', 'f7d7b066b1d9f8316d053e7e332c8937a9379d23', '081510292719', 'Visar Indah Pratama Jl.kenanga 3 No.5 RT 04 RW12 Cibinong'),
(7, 'hafiza', 'hafiza@gmail.com', '59dc310530b44e8dd1231682b4cc5f2458af1c60', '081624357', 'grand serpong city'),
(8, 'yasmin hafiza', 'yasmin.hafiza@gmail.com', '6e2effc3dbeff53ff50309190bd09f7718e02739', '0816277298', 'jl.mawar 4 No.8');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(12, 28, 'yasmin hafiza', 'Syariah Mandiri', 114000, '2024-07-11', '2024071111060820240625104156bukti.jpg'),
(13, 29, 'yasmin hafiza', 'BTPN', 332000, '2024-07-11', '2024071111122520240625115348bukti.jpg'),
(14, 35, 'Siti Nurhaliza', 'BCA', 205000, '2024-07-11', '20240711191710202407050759481675178266438.png'),
(15, 37, 'yasmin', 'Mandiri', 691000, '2024-07-12', '20240712075149file (6).pdf'),
(16, 38, 'hafiza', 'BRI', 106000, '2024-07-12', '20240712095735bukti.jpg'),
(17, 44, 'yasmin', 'Panin', 106000, '2024-07-13', '20240713081716about1.png');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `total_pembelian` int(11) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `total_berat` int(11) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `distrik` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `ekspedisi` varchar(255) DEFAULT NULL,
  `paket` varchar(255) DEFAULT NULL,
  `ongkir` int(11) DEFAULT NULL,
  `estimasi` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'pending',
  `resi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `tanggal_pembelian`, `total_pembelian`, `alamat`, `total_berat`, `provinsi`, `distrik`, `type`, `kode_pos`, `ekspedisi`, `paket`, `ongkir`, `estimasi`, `status`, `resi`) VALUES
(29, 1, '2024-07-11', 332000, 'visar indah pratama jl.kenanga 4 no 5', 600, 'Jawa Barat', 'Bogor', 'Kota', '16119', 'gosend', 'sameday', 35000, 'sama hari', 'sudah diterima', '888888'),
(35, 1, '2024-07-11', 205000, 'Jl. Diponegoro No. 23\r\nKelurahan: Menteng\r\nKecamatan: Menteng', 400, 'DKI Jakarta', 'Jakarta Pusat', 'Kota', '10540', 'jnt', 'oke', 7000, '4-7 hari', 'Produk sedang diproses', '1234567890	'),
(36, 1, '2024-07-11', 159000, 'Jl. Diponegoro No. 23\r\nKelurahan: Menteng\r\nKecamatan: Menteng', 200, 'Kepulauan Riau', 'Kepulauan Anambas', 'Kabupaten', '29991', 'grab express', 'truck', 60000, '1-2 hari', 'pending', NULL),
(38, 7, '2024-07-12', 106000, 'Ibu Siti Aminah\r\nJalan Merdeka No. 10\r\nRT 02 RW 03\r\nKelurahan Sukamaju\r\nKecamatan Sukaresmi', 200, 'DI Yogyakarta', 'Bantul', 'Kabupaten', '55715', 'tiki', 'oke', 7000, '4-7 hari', 'sedang diproses', NULL),
(39, 7, '2024-07-12', 258000, 'qwertyuiogfxcvbnm cvbn', 400, 'Kalimantan Tengah', 'Seruyan', 'Kabupaten', '74211', 'anterin', 'truck', 60000, '1-2 hari', 'pending', NULL),
(40, 7, '2024-07-12', 34900, 'Jl. Melati No. 10, RT 03/RW 05,\r\nKelurahan Cempaka Putih,\r\nKecamatan Cempaka Putih,', 200, 'DKI Jakarta', 'Jakarta Timur', 'Kota', '13330', 'gosend', 'flash', 25000, '1 hari', 'pending', NULL),
(41, 7, '2024-07-12', 889000, 'Jl. Ir. H. Juanda No. 25,\r\nKelurahan Gambir,\r\nKecamatan Gambir,', 1800, 'DKI Jakarta', 'Jakarta Pusat', 'Kota', '10540', 'tiki', 'oke', 7000, '4-7 hari', 'pending', NULL),
(42, 7, '2024-07-12', 1015000, 'Jl. Ir. H. Juanda No. 25,\r\nKelurahan Gambir,\r\nKecamatan Gambir,', 2000, 'Kepulauan Riau', 'Natuna', 'Kabupaten', '29711', 'gosend', 'flash', 25000, '1 hari', 'pending', NULL),
(43, 1, '2024-07-12', 134000, 'visar', 200, 'DKI Jakarta', 'Jakarta Barat', 'Kota', '11220', 'pandu logistics', 'sameday', 35000, 'sama hari', 'pending', NULL),
(44, 1, '2024-07-13', 106000, 'Serpong Garden', 200, 'Banten', 'Tangerang', 'Kota', '15111', 'jne', 'oke', 7000, '4-7 hari', 'Produk sedang diproses', '4567890'),
(45, 8, '2024-07-26', 106000, 'Jalan: Jl. Merdeka No. 123 Kelurahan: Kebon Jeruk Kecamatan: Kebayoran Lama', 200, 'DKI Jakarta', 'Jakarta Selatan', 'Kota', '12230', 'jne', 'oke', 7000, '4-7 hari', 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `subberat` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `berat`, `subberat`, `subharga`) VALUES
(8, 7, 4, 1, 'ARMNI Si (50 ML)', 99000, 200, 200, 99000),
(9, 8, 5, 3, 'Bomsell ( 50 ML )', 99000, 200, 600, 297000),
(33, 23, 22, 6, 'Blu Emotion', 99000, 200, 1200, 594000),
(34, 24, 2, 4, 'Scandal (50ml)', 99000, 200, 800, 396000),
(35, 25, 5, 1, 'Bomsell ( 50 ML )', 99000, 200, 200, 99000),
(36, 26, 5, 6, 'Bomsell ( 50 ML )', 99000, 200, 1200, 594000),
(37, 26, 10, 1, 'Ver Eros ( 50 ML )', 99000, 200, 200, 99000),
(38, 27, 9, 1, 'Black Opivm ( 50 ML )', 99000, 200, 200, 99000),
(39, 28, 6, 1, 'Baccarat ( 50 ML )', 99000, 200, 200, 99000),
(40, 29, 7, 3, 'Desire Blue', 99000, 200, 600, 297000),
(41, 30, 5, 6, 'Bomsell ( 50 ML )', 99000, 200, 1200, 594000),
(42, 30, 10, 1, 'Ver Eros ( 50 ML )', 99000, 200, 200, 99000),
(43, 30, 2, 1, 'Scandal (50ml)', 90000, 200, 200, 90000),
(44, 31, 6, 1, 'Baccarat ( 50 ML )', 99000, 200, 200, 99000),
(45, 32, 7, 1, 'Desire Blue', 99000, 200, 200, 99000),
(46, 33, 6, 1, 'Baccarat ( 50 ML )', 99000, 200, 200, 99000),
(47, 34, 6, 1, 'Baccarat ( 50 ML )', 99000, 200, 200, 99000),
(48, 35, 9, 2, 'Black Opivm ( 50 ML )', 99000, 200, 400, 198000),
(49, 36, 6, 1, 'Baccarat ( 50 ML )', 99000, 200, 200, 99000),
(50, 37, 2, 1, 'Scandal (50ml)', 90000, 200, 200, 90000),
(51, 37, 15, 1, '1 million lcky ( 50 ML )', 99000, 200, 200, 99000),
(52, 37, 24, 5, 'Daisy', 99000, 200, 1000, 495000),
(53, 38, 7, 1, 'Desire Blue', 99000, 200, 200, 99000),
(54, 39, 7, 1, 'Desire Blue', 99000, 200, 200, 99000),
(55, 39, 10, 1, 'Ver Eros ( 50 ML )', 99000, 200, 200, 99000),
(56, 40, 26, 1, 'Red Vanilla ( 50 ML )', 9900, 200, 200, 9900),
(57, 41, 2, 1, 'Scandal (50ml)', 90000, 200, 200, 90000),
(58, 41, 15, 1, '1 million lcky ( 50 ML )', 99000, 200, 200, 99000),
(59, 41, 24, 5, 'Daisy', 99000, 200, 1000, 495000),
(60, 41, 14, 1, 'Lambo ( 50 Ml )', 99000, 200, 200, 99000),
(61, 41, 23, 1, 'BlueSeduktion ( 50 ML )', 99000, 200, 200, 99000),
(62, 42, 12, 10, 'VIP Men ( 50 ML ) ', 99000, 200, 2000, 990000),
(63, 43, 5, 1, 'Bomsell ( 50 ML )', 99000, 200, 200, 99000),
(64, 44, 10, 1, 'Ver Eros ( 50 ML )', 99000, 200, 200, 99000),
(65, 45, 7, 1, 'Desire Blue', 99000, 200, 200, 99000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `foto_produk` varchar(255) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `jumlah_terjual` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `berat_produk`, `foto_produk`, `deskripsi_produk`, `stok_produk`, `jumlah_terjual`) VALUES
(5, 1, 'Bomsell ( 50 ML )', 99000, 200, 'Bomsell2.jpeg', '', 39, 14),
(6, 3, 'Baccarat ( 50 ML )', 99000, 200, 'baccarat 540.jpeg', '', 30, 5),
(7, 2, 'Desire Blue', 99000, 200, 'desireblue.jpeg', 'Stunning works of art, creating an alluring aura of elegance and undeniable luxury. With every spray, this fragrance invites you to enter a world full of unforgettable beauty and timeless elegance.  Top Notes: Saffron, Jasmine Middle Notes: Amberwood, Ambergriss Base Notes: Fir resin, Cedar  HOW-TO-USE 1. Semprotkan parfum dari jarak sekitar 15-20 cm. 2. Pastikan menekan kepala spray dengan penuh.Penekanan tidak sempurna akan menyebabkan rembesan pada botol parfum. 3. Oleskan lotion/balm sebelum menyemprotkan parfum untuk hasil yang lebih tahan lama dan mengindari iritasi pada area sensitif.', 29, 8),
(9, 3, 'Black Opivm ( 50 ML )', 99000, 200, 'Black Opivm2.jpeg', 'Stunning works of art, creating an alluring aura of elegance and undeniable luxury. With every spray, this fragrance invites you to enter a world full of unforgettable beauty and timeless elegance.  Top Notes: Saffron, Jasmine Middle Notes: Amberwood, Ambergriss Base Notes: Fir resin, Cedar  HOW-TO-USE 1. Semprotkan parfum dari jarak sekitar 15-20 cm. 2. Pastikan menekan kepala spray dengan penuh.Penekanan tidak sempurna akan menyebabkan rembesan pada botol parfum. 3. Oleskan lotion/balm sebelum menyemprotkan parfum untuk hasil yang lebih tahan lama dan mengindari iritasi pada area sensitif.', 30, 3),
(10, 2, 'Ver Eros ( 50 ML )', 99000, 200, 'Ver Eros2.jpeg', 'From the first time you smell the fragrance, Ver Eros immediately gives a strong and fresh impression. This aroma is like a burst of energy that uplifts the spirit and radiates vitality. Perfect for men who want to show their dynamic and energetic side.   Top Notes:Apple, Lemon, Mint Middle Notes: Tonka Bean, Ambroxan, Geranium Base Notes: vanilla, cedarwood, vetiver, oakmoss  HOW-TO-USE 1. Semprotkan parfum dari jarak sekitar 15-20 cm. 2. Pastikan menekan kepala spray dengan penuh.Penekanan tidak sempurna akan menyebabkan rembesan pada botol parfum. 3. Oleskan lotion/balm sebelum menyemprotkan parfum untuk hasil yang lebih tahan lama dan mengindari iritasi pada area sensitif.', 39, 4),
(11, 2, 'sauvage', 99000, 200, 'sauvage.jpeg', 'Aroma tahan lama yang cocok untuk digunakan sepanjang hari.\r\nKombinasi aroma yang unik dan memikat, ideal untuk berbagai kesempatan, baik formal maupun santai.\r\nDikembangkan oleh perfumer terkenal, François Demachy, yang menciptakan harmoni sempurna antara kesegaran dan kekuatan.', 50, 0),
(12, 2, 'VIP Men ( 50 ML ) ', 99000, 200, 'VIP Men.jpeg', 'With Vip Men, every spray is a statement about who you are: a man who is bold, stylish, and lives with luxury and boundless energy. Giving you a scent that exudes unparalleled luxury, power and charm.    Top Notes: Passion Fruit, Lime, Pepper, Ginger Middle Notes:, Vodka, Gin, Mint, Spices Base Notes: Amber, Leather, Woodys Notes  HOW-TO-USE 1. Semprotkan parfum dari jarak sekitar 15-20 cm. 2. Pastikan menekan kepala spray dengan penuh.Penekanan tidak sempurna akan menyebabkan rembesan pada botol parfum. 3. Oleskan lotion/balm sebelum menyemprotkan parfum untuk hasil yang lebih tahan lama dan mengindari iritasi pada area sensitif.', 40, 10),
(13, 2, 'CRD aventus', 99000, 200, 'crd.jpeg', 'Komposisi Aroma:\r\n\r\nTop Notes: Bergamot, Blackcurrant, Apple, Pineapple\r\nHeart Notes: Rose, Dry Birch, Moroccan Jasmine, Patchouli\r\nBase Notes: Oakmoss, Musk, Ambergris, Vanilla', 50, 0),
(14, 2, 'Lambo ( 50 Ml )', 99000, 200, 'lambo.jpeg', 'Top Notes: Kesegaran mandarin dan bergamot yang menyegarkan membuka perjalanan aroma dengan sentuhan yang energik dan menggoda.', 50, 1),
(15, 2, '1 million lcky ( 50 ML )', 99000, 200, '1 Mllion Lcky.jpeg', 'Komposisi Aroma:\r\n\r\nTop Notes: Plum, Grapefruit, Bergamot\r\nHeart Notes: Hazelnut, Honey, Cedar, Cashmere Wood, Orange Blossom, Jasmine\r\nBase Notes: Patchouli, Oakmoss, Vetiver', 90, 2),
(19, 1, 'Light Blue', 99000, 200, 'light blue.jpeg', 'Top Notes: Sicilian Lemon, Apple, Cedar, Bellflower\r\nMiddle Notes: Bamboo, White Rose, Jasmine\r\nBase Notes: Amber, Cedar, Musk\r\n\r\nHOW-TO-USE\r\n1. Semprotkan parfum dari jarak sekitar 15-20 cm.\r\n2. Pastikan menekan kepala spray dengan penuh.Penekanan tidak sempurna akan menyebabkan rembesan pada botol parfum.\r\n3. Oleskan lotion/balm sebelum menyemprotkan parfum untuk hasil yang lebih tahan lama dan mengindari iritasi pada area sensitif.\r\n', 30, 0),
(20, 2, 'Dnhll Blue ( 50 ML )', 99000, 99000, 'Dnhll Blue1.jpeg', 'Top Notes: Litchi, Bergamot, Lotus, Mandarin Orange Middle Notes: Orange, Sea Notes, Brazilian Rosewoo Base Notes: Tonka Bean, Musk, Benzoin, Amber  HOW-TO-USE 1. Semprotkan parfum dari jarak sekitar 15-20 cm. 2. Pastikan menekan kepala spray dengan penuh.Penekanan tidak sempurna akan menyebabkan rembesan pada botol parfum. 3. Oleskan lotion/balm sebelum menyemprotkan parfum untuk hasil yang lebih tahan lama dan mengindari iritasi pada area sensitif.', 40, 0),
(21, 2, 'Blu de Chnll', 99000, 200, 'Blu de Chnll2.jpeg', 'Top Notes: Mint, Grapefruit, Pink Pepper, Lemon Middle Notes: Ginger, Nutmeg, Jasmine, Iso E Super Base Notes: Inscense, vetiver, cedar, sandalwood, patchouli, labdanum, white musk  HOW-TO-USE 1. Semprotkan parfum dari jarak sekitar 15-20 cm. 2. Pastikan menekan kepala spray dengan penuh.Penekanan tidak sempurna akan menyebabkan rembesan pada botol parfum. 3. Oleskan lotion/balm sebelum menyemprotkan parfum untuk hasil yang lebih tahan lama dan mengindari iritasi pada area sensitif.', 90, 0),
(22, 2, 'Blu Emotion', 99000, 200, 'Blu Emotion2.jpeg', 'Top Notes: Apple, Cloves, Lemon Middle Notes:Leather, safron, rose,lily Base Notes: vanilla, cedar, amber, musk  HOW-TO-USE 1. Semprotkan parfum dari jarak sekitar 15-20 cm. 2. Pastikan menekan kepala spray dengan penuh.Penekanan tidak sempurna akan menyebabkan rembesan pada botol parfum. 3. Oleskan lotion/balm sebelum menyemprotkan parfum untuk hasil yang lebih tahan lama dan mengindari iritasi pada area sensitif.', 30, 6),
(23, 2, 'BlueSeduktion ( 50 ML )', 99000, 200, 'BlueSeduktion1.jpeg', 'Top Notes: Melon, Bergamot, Mint, Black Currant Middle Notes: Sea Water, Green Apple, Cappucino, Cardamom, Nutmeg Base Notes: Woodsnote, Amber  HOW-TO-USE 1. Semprotkan parfum dari jarak sekitar 15-20 cm. 2. Pastikan menekan kepala spray dengan penuh.Penekanan tidak sempurna akan menyebabkan rembesan pada botol parfum. 3. Oleskan lotion/balm sebelum menyemprotkan parfum untuk hasil yang lebih tahan lama dan mengindari iritasi pada area sensitif.', 40, 1),
(24, 1, 'Daisy', 99000, 200, '1.jpeg', 'Top Notes: Raspberry, Blackberry, Bergamot Middle Notes: Daisy, Jasmine Base Notes: Sugar, Musk, Woody Notes  HOW-TO-USE 1. Semprotkan parfum dari jarak sekitar 15-20 cm. 2. Pastikan menekan kepala spray dengan penuh.Penekanan tidak sempurna akan menyebabkan rembesan pada botol parfum. 3. Oleskan lotion/balm sebelum menyemprotkan parfum untuk hasil yang lebih tahan lama dan mengindari iritasi pada area sensitif.', 70, 10),
(25, 1, 'Jasmine Nior', 99000, 200, 'Jasmine Nior.jpeg', 'Top Notes: Gardenia, Green Notes Middle Notes: Jasmine Sambac, Almond Base Notes: Tonka Bean, Musk Amber, Patchouli  HOW-TO-USE 1. Semprotkan parfum dari jarak sekitar 15-20 cm. 2. Pastikan menekan kepala spray dengan penuh.Penekanan tidak sempurna akan menyebabkan rembesan pada botol parfum. 3. Oleskan lotion/balm sebelum menyemprotkan parfum untuk hasil yang lebih tahan lama dan mengindari iritasi pada area sensitif.', 60, 0),
(26, 1, 'Red Vanilla ( 50 ML )', 9900, 200, 'Red Vanilla1.jpeg', 'Top Notes: Vanilla, Patchouli, Pear Middle Notes: Blackcurrant, Praline Base Notes: Iris, Tonka Bean  HOW-TO-USE 1. Semprotkan parfum dari jarak sekitar 15-20 cm. 2. Pastikan menekan kepala spray dengan penuh.Penekanan tidak sempurna akan menyebabkan rembesan pada botol parfum. 3. Oleskan lotion/balm sebelum menyemprotkan parfum untuk hasil yang lebih tahan lama dan mengindari iritasi pada area sensitif.', 50, 1),
(27, 2, 'Agner Black', 99000, 200, 'Agner Black.jpeg', 'Aigner Black adalah parfum pria yang elegan dan penuh gaya, diluncurkan oleh rumah mode mewah Aigner. Parfum ini dirancang untuk pria modern yang percaya diri dan memiliki selera tinggi. Dengan aroma yang memadukan kesegaran dan kekuatan, Aigner Black menghadirkan karakter yang maskulin dan berkelas.\r\n\r\nKomposisi Aroma:\r\n\r\nTop Notes: Bergamot, Grapefruit, Orange\r\nHeart Notes: Mint, Pine Needle, Oakmoss\r\n', 80, 0),
(29, 1, 'Girl Summer', 99000, 200, 'girlsummer.jpeg', 'erinspirasi dari kehangatan musim panas yang menggoda, Parfum Girl Summer menghadirkan harmoni yang segar dan memikat. Campuran buah-buahan cerah seperti buah jeruk dan berry segar memberikan aroma yang menyegarkan dan menggugah selera. Ditambah dengan sentuhan bunga-bunga ringan seperti bunga anggrek dan mawar putih, parfum ini menciptakan kesan yang feminin dan elegan. Akhirnya, sentuhan amber dan vanilla memberikan kehangatan yang lembut dan memikat, sempurna untuk menemani hari-hari ceria di musim panas. Parfum Girl Summer adalah pilihan ideal untuk wanita yang ingin merayakan keceriaan dan keindahan musim panas dengan aroma yang memikat dan mempesona.', 50, 0),
(30, 1, 'Jm English Pear', 99000, 200, 'JM English Pear.jpeg', 'Top Notes: Pear, Melon Middle Notes: Freesia, Rose Base Notes: Patchouli, Musk, Amber, Rhuburb  HOW-TO-USE 1. Semprotkan parfum dari jarak sekitar 15-20 cm. 2. Pastikan menekan kepala spray dengan penuh.Penekanan tidak sempurna akan menyebabkan rembesan pada botol parfum. 3. Oleskan lotion/balm sebelum menyemprotkan parfum untuk hasil yang lebih tahan lama dan mengindari iritasi pada area sensitif.', 50, 0),
(31, 1, 'Girl Summer  30 ml', 79000, 200, 'girlsummer2.jpeg', '', 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `produk_foto`
--

CREATE TABLE `produk_foto` (
  `id_produk_foto` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `nama_produk_foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_foto`
--

INSERT INTO `produk_foto` (`id_produk_foto`, `id_produk`, `nama_produk_foto`) VALUES
(3, 29, 'girlsummer.jpeg'),
(4, 29, 'girlsummer2.jpeg'),
(8, 5, '20240712110023Bomsell.jpeg'),
(9, 5, '20240712110030Bomsell2.jpeg'),
(10, 6, '20240712110051baccarat 540.jpeg'),
(11, 6, '20240712110059baccarat 540 2.jpeg'),
(12, 7, '20240712110409desireblue.jpeg'),
(13, 7, '20240712110416desireblue2.jpeg'),
(14, 9, '20240712110443Black Opivm.jpeg'),
(15, 9, '20240712110454Black Opivm2.jpeg'),
(16, 10, '20240712110515Ver Eros.jpeg'),
(17, 10, '20240712110524Ver Eros2.jpeg'),
(18, 11, '20240712110635sauvage.jpeg'),
(19, 12, '20240712110700VIP Men.jpeg'),
(20, 13, '20240712111017crd.jpeg'),
(21, 13, '20240712111419crd2.jpeg'),
(22, 14, '20240712111456lambo.jpeg'),
(23, 15, '202407121116191 Mllion Lcky.jpeg'),
(26, 30, 'JM English Pear.jpeg'),
(27, 19, '20240712112715light blue.jpeg'),
(28, 19, '20240712112727light blue 2.jpeg'),
(29, 20, '20240712113049Dnhll Blue1.jpeg'),
(30, 20, '20240712113059Dnhll Blue2.jpeg'),
(31, 21, '20240712113128Blu de Chnll2.jpeg'),
(32, 22, '20240712113153Blu Emotion1.jpeg'),
(33, 22, '20240712113202Blu Emotion2.jpeg'),
(34, 23, '20240712113228BlueSeduktion1.jpeg'),
(35, 23, '20240712113236BlueSeduktion2.jpeg'),
(36, 24, '202407121133061.jpeg'),
(38, 25, '20240712113518Jasmine Nior2.jpeg'),
(40, 25, '20240712114748Jasmine Nior2.jpeg'),
(41, 26, '20240712114950Red Vanilla1.jpeg'),
(42, 26, '20240712115000Red Vanilla2.jpeg'),
(43, 27, '20240712115048Agner Black.jpeg'),
(44, 31, 'girlsummer2.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_pelanggan`,`id_produk`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produk_foto`
--
ALTER TABLE `produk_foto`
  ADD PRIMARY KEY (`id_produk_foto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `produk_foto`
--
ALTER TABLE `produk_foto`
  MODIFY `id_produk_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
