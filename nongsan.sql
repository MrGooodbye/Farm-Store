-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2022 at 08:18 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nongsan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminid` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(150) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminid`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`) VALUES
(1, 'Kiệt', 'kiet@gmail.com', 'kietchushop', 'e10adc3949ba59abbe56e057f20f883e', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `productId` int(11) UNSIGNED NOT NULL,
  `sId` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartId`, `productId`, `sId`, `productName`, `price`, `quantity`, `image`) VALUES
(103, 3, 'jlv1ov6far1i93e66mchdh07ro', 'Rau Muống', '10000', 1, '7e52fac97d.jpg'),
(143, 3, '7vbk0dm511iot4j4t414kao3pl', 'Rau Muống', '10000', 1, '7e52fac97d.jpg'),
(147, 13, 't9q715gg655k3k2lurlp2if8ff', 'Cà Rốt', '10000', 1, 'cb7c4352c4.jpg'),
(159, 3, 'afivot0gs2jqg9i2u7q2logvir', 'Rau Muống', '10000', 1, '7e52fac97d.jpg'),
(167, 13, 'a7eb6enjaa6mhl7nlia83hgomd', 'Cà Rốt', '10000', 1, 'cb7c4352c4.jpg'),
(174, 15, '70ni5ngghv84g751j9e1b2gnbn', 'Khoai Tây', '5000', 1, '044dd99052.jpg'),
(175, 15, 'reporc6bo82g4pqhi3mmqpgoq0', 'Khoai Tây', '5000', 1, '044dd99052.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) UNSIGNED NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(43, 'Rau Xanh'),
(48, 'Củ'),
(51, 'Gạo'),
(52, 'Quả');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `orderId` int(11) NOT NULL,
  `hotenkhach` varchar(255) NOT NULL,
  `sdt` int(20) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `thanhpho` varchar(255) NOT NULL,
  `productId` int(11) UNSIGNED NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_order` timestamp NOT NULL DEFAULT current_timestamp(),
  `statuss` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) UNSIGNED NOT NULL,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) UNSIGNED NOT NULL,
  `product_desc` text NOT NULL,
  `type` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `product_desc`, `type`, `price`, `image`) VALUES
(2, 'Bắp Cải Thảo', 43, 'zzzzzzz', 1, '10000', '9c5dd20acd.jpg'),
(3, 'Rau Muống', 43, 'zzzzzzzzz', 1, '10000', '7e52fac97d.jpg'),
(13, 'Cà Rốt', 48, 'Đồ này quá ngon , ngon hơn cả crush của bạn , không còn gì phải bàn cãi , \r\n                nếu không tin cứ bỏ tiền ra mua , bên tui cho vay nóng luôn lấy bạc 50 dễ chịu thoải mái\r\n                nhưng quên nợ là không bảo toàn tính mạng bạn nhé, có gì liên hệ với đại ca tui Kiệt senpai . \r\n                Đã nghiện rồi còn ngại , chốt đơn nhanh đi bạn , cơ hội thành công chỉ đến với \r\n                người có bản lĩnh !', 1, '10000', 'cb7c4352c4.jpg'),
(15, 'Khoai Tây', 48, 'zzzzz', 1, '5000', '044dd99052.jpg'),
(16, 'Củ Cải Trắng', 48, 'zxvzxczv', 0, '10000', '27b9c49834.jpg'),
(17, 'Cà Chua', 52, 'cvxzvxz', 1, '900000', '3290327546.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_regis`
--

CREATE TABLE `tbl_regis` (
  `regisId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `useracc` varchar(255) NOT NULL,
  `userpass` varchar(255) NOT NULL,
  `sdt` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `cmnd` varchar(255) NOT NULL,
  `gioitinh` varchar(255) NOT NULL,
  `ngaysinh` date DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_regis`
--

INSERT INTO `tbl_regis` (`regisId`, `username`, `useracc`, `userpass`, `sdt`, `email`, `diachi`, `cmnd`, `gioitinh`, `ngaysinh`, `image`) VALUES
(47, 'Huỳnh Lâm Phú', 'huynhlamphu', '123456', '0354384768', '012345@gmail.com', '51A, đường 54, Khu Phố 2, Phường Hiệp Bình Chánh, Thành phố Thủ Đức', '012345678912', '2', '2020-02-29', '0c0ef9f3f9.jpg'),
(48, 'Trần Anh Kiệt', 'trananhkiet', '123456', '', '', '', '', '', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `totalprice`
--

CREATE TABLE `totalprice` (
  `varcher` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`),
  ADD KEY `catId` (`catId`),
  ADD KEY `catId_2` (`catId`),
  ADD KEY `catId_3` (`catId`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `catId` (`catId`);

--
-- Indexes for table `tbl_regis`
--
ALTER TABLE `tbl_regis`
  ADD PRIMARY KEY (`regisId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tbl_regis`
--
ALTER TABLE `tbl_regis`
  MODIFY `regisId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `tbl_category` (`catId`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
