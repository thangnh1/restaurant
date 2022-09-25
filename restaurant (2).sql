-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2022 at 11:25 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_acckh`
--

CREATE TABLE `tbl_acckh` (
  `khachhang_id` int(15) NOT NULL,
  `kh_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kh_password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kh_fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kh_sdt` int(20) NOT NULL,
  `kh_email` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_acckh`
--

INSERT INTO `tbl_acckh` (`khachhang_id`, `kh_user`, `kh_password`, `kh_fullname`, `kh_sdt`, `kh_email`) VALUES
(60, 'thanh1@gmail.com', '805b346dd6c0d595ecb74f28e323afe3', 'Hieu Tran', 20202020, 'thanhkd1@gmail.com'),
(61, 'kienck', '4297f44b13955235245b2497399d7a93', 'Trung Kiên', 20202020, 'kskdsakd@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `user`, `password`, `admin_name`) VALUES
(1, 'admin1', '21232f297a57a5a743894a0e4a801fc3', 'Kien');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(100) NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(8, 'FOOD'),
(9, 'DRINK'),
(10, 'DESSERT');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_donhang`
--

CREATE TABLE `tbl_donhang` (
  `donhang_id` int(15) NOT NULL,
  `madonhang` int(255) NOT NULL,
  `ngaythang` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `loaiban` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `songuoi` int(20) NOT NULL,
  `food_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `occasion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gio` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `kh_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kh_phone` int(100) NOT NULL,
  `tinhtrang` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sanpham`
--

CREATE TABLE `tbl_sanpham` (
  `sanpham_id` int(100) NOT NULL,
  `category_id` int(50) NOT NULL,
  `sanpham_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `sanpham_image` varchar(100) CHARACTER SET utf8 NOT NULL,
  `sanpham_gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_sanpham`
--

INSERT INTO `tbl_sanpham` (`sanpham_id`, `category_id`, `sanpham_name`, `sanpham_image`, `sanpham_gia`) VALUES
(13, 9, 'Carrot Juice', 'carot.jpg', 10),
(14, 8, 'Hamburger', 'hamburger.jpg', 12),
(15, 8, 'Sandwich', 'sandwich.jpg', 12),
(16, 8, 'Spaghetti', 'spagetti.jpg', 15),
(17, 8, 'Braised beef short ribs', 'suon.jpg', 50),
(18, 8, 'Salad', 'br3.jpg', 15),
(19, 8, 'Pan-fried goose breast', 'br4.jpg', 20),
(20, 9, 'Watermelon Juice', 'duahau.jpg', 10),
(21, 9, 'Guava Juice', 'oi.jpg', 10),
(22, 9, 'Fragrant Juice', 'thom.jpg', 10),
(23, 9, 'Orange Juice', 'cam.jpg', 10),
(24, 9, 'Tomato Juice', 'cachua.jpg', 10),
(25, 10, 'Flan Cake', 'trangmieng1.png', 5),
(26, 10, 'Pudding Cake', 'trangmieng2.jpeg', 5),
(27, 10, 'Mauri Cake', 'trangmieng3.jpg', 5),
(28, 10, 'Ice Cream', 'kem.jpg', 5),
(29, 10, 'Fruits', 'traicay.jpg', 10),
(30, 10, 'Crepe Cake', 'crepe.jpg', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_acckh`
--
ALTER TABLE `tbl_acckh`
  ADD PRIMARY KEY (`khachhang_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  ADD PRIMARY KEY (`donhang_id`);

--
-- Indexes for table `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD PRIMARY KEY (`sanpham_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_acckh`
--
ALTER TABLE `tbl_acckh`
  MODIFY `khachhang_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  MODIFY `donhang_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- AUTO_INCREMENT for table `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  MODIFY `sanpham_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
