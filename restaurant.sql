
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `tbl_acckh` (
  `khachhang_id` int(15) NOT NULL,
  `kh_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kh_password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kh_fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kh_sdt` int(20) NOT NULL,
  `kh_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbl_acckh` (`khachhang_id`, `kh_user`, `kh_password`, `kh_fullname`, `kh_sdt`, `kh_email`) VALUES
(60, 'thanh1@gmail.com', '805b346dd6c0d595ecb74f28e323afe3', 'Hieu Tran', 20202020, 'thanhkd1@gmail.com'),
(61, 'kienck', '4297f44b13955235245b2497399d7a93', 'Trung Kiên', 20202020, 'kskdsakd@gmail.com');


CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `tbl_admin` (`admin_id`, `user`, `password`, `admin_name`) VALUES
(1, 'admin1', '21232f297a57a5a743894a0e4a801fc3', 'Kien');


CREATE TABLE `tbl_category` (
  `category_id` int(100) NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(8, 'FOOD'),
(9, 'DRINK'),
(10, 'DESSERT');


CREATE TABLE `tbl_dondatban` (
  `madondatban` int(255) NOT NULL,
  `ngaythang` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `maloaiban` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `songuoi` int(20) NOT NULL,
  `occasion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gio` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `kh_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kh_phone` int(100) NOT NULL,
  `tinhtrang` int(20) NOT NULL
 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `tbl_chitietdondatban` (
  `ban_id` int(15) NOT NULL,
  `madondatban` int(255) NOT NULL,
  `soluongban` int(20) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `tbl_dondatmon` (
  `madon` int(255) NOT NULL,
  `ngaythang` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `occasion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gio` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `kh_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kh_phone` int(100) NOT NULL,
  `tinhtrang` int(20) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tbl_chitietdondatmon` (
  `monan_id` int(15) NOT NULL,
  `madon` int(255) NOT NULL,
  `soluong` int(20) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `tbl_monan` (
  `monan_id` int(100) NOT NULL,
  `category_id` int(50) NOT NULL,
  `tenmon` varchar(255) CHARACTER SET utf8 NOT NULL,
  `monan_image` varchar(100) CHARACTER SET utf8 NOT NULL,
  `giamonan` int(11) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `tbl_ban` (
  `ban_id` int(100) NOT NULL,
  `loaiban_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ban_image` varchar(100) CHARACTER SET utf8 NOT NULL,
  `gia_ban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tbl_loaiban` (
  `loaiban_id` int(100) NOT NULL,
  `tenloaiban` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbl_monan` (`monan_id`, `category_id`, `tenmon`, `monan_image`, `giamonan`) VALUES
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


ALTER TABLE `tbl_acckh`
  ADD PRIMARY KEY (`khachhang_id`);


ALTER TABLE `tbl_loaiban`
  ADD PRIMARY KEY (`loaiban_id`);

ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);


ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);


ALTER TABLE `tbl_dondatban`
  ADD PRIMARY KEY (`madondatban`);

ALTER TABLE `tbl_dondatmon`
  ADD PRIMARY KEY (`madon`);

ALTER TABLE `tbl_chitietdondatmon`
  ADD PRIMARY KEY (`madon`);

ALTER TABLE `tbl_chitietdondatban`
  ADD PRIMARY KEY (`madondatban`);

ALTER TABLE `tbl_monan`
  ADD PRIMARY KEY (`monan_id`);

  ALTER TABLE `tbl_ban`
  ADD PRIMARY KEY (`ban_id`);



ALTER TABLE `tbl_acckh`
  MODIFY `khachhang_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `tbl_category`
  MODIFY `category_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `tbl_dondatmon`
  MODIFY `madon` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

ALTER TABLE `tbl_dondatban`
  MODIFY `madondatban` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

ALTER TABLE `tbl_monan`
  MODIFY `monan_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

