-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2017 at 06:08 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zendframework`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `date_order` date NOT NULL,
  `total` double NOT NULL,
  `deposit` double NOT NULL COMMENT 'tiền cọc',
  `unpaid` double NOT NULL COMMENT 'còn lại',
  `payment_method` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `id_customer`, `date_order`, `total`, `deposit`, `unpaid`, `payment_method`, `note`) VALUES
(12, 12, '2014-01-13', 2718000, 1000000, 1718000, 'tiền mặt', ''),
(13, 13, '2014-01-13', 2718000, 1000000, 1718000, 'tiền mặt', ''),
(14, 16, '2014-05-20', 295000, 0, 0, 'tiền mặt', ''),
(15, 17, '2014-05-20', 410000, 0, 0, 'tiền mặt', '');

-- --------------------------------------------------------

--
-- Table structure for table `bill_detail`
--

CREATE TABLE `bill_detail` (
  `id_bill` int(11) NOT NULL,
  `id_food` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='chi_tiet_hoa_don' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `bill_detail`
--

INSERT INTO `bill_detail` (`id_bill`, `id_food`, `quantity`, `price`) VALUES
(12, 1, 2, 1194000),
(12, 55, 1, 150000),
(12, 58, 1, 180000),
(13, 2, 2, 1194000),
(13, 55, 1, 150000),
(13, 58, 1, 180000),
(14, 3, 3, 25000),
(14, 46, 1, 220000),
(15, 5, 2, 80000),
(15, 9, 1, 180000),
(15, 11, 1, 70000);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `gender`, `email`, `address`, `phone`, `note`) VALUES
(12, 'Nguyễn Thị Thảo', 'nữ', 'thao@gmail.com', 'Phường Bến Nghé, Quận 1', '0920145687', 'Sinh Nhật'),
(13, 'Trần Thu Trang', 'nữ', 'trang@yahoo.com', 'Phường Bến Thành, Quận 1', '01251546789', 'Đám cưới'),
(14, 'Đỗ Lâm Thiên', 'nam', 'thien@mail.com', 'Phường Bến Thành, Quận 1', '01251546789', ''),
(16, 'Khuất Thùy Phương', 'nữ', 'kpt@edu.vn', 'Phường Bến Thành, Quận 1', '01251546789', 'Vui lòng gửi hàng đúng ngày'),
(17, 'Mai Thu Thảo', 'nữ', 'thao@gmail.com', 'Phường Bến Thành, Quận 1', '01251546789', ''),
(18, 'Ngọc Hương 03', 'nữ', 'huognguyenak@gmail.com', 'Phường Bến Thành, Quận 1', '01251546789', ''),
(20, 'Ngọc Hương', 'nữ', 'huognguyenak96@gmail.com', 'Phường Bến Thành, Quận 1', '01251546789', '');

-- --------------------------------------------------------

--
-- Table structure for table `demo`
--

CREATE TABLE `demo` (
  `id` int(11) NOT NULL,
  `new_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `summary` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `promotion` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'nước ngọt, khăn lạnh',
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `update_at` date NOT NULL,
  `unit` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'đĩa',
  `today` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `id_type`, `name`, `summary`, `detail`, `price`, `promotion`, `image`, `update_at`, `unit`, `today`) VALUES
(1, 8, 'Bánh canh đã edit lần 3', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Được làm từ bột gạo, bột mì, hoặc bột sắn hoặc bột gạo pha bột sắn cán thành tấm và cắt ra thành sợi to và ngắn với nước dùng được nấu từ tôm, cá, giò heo... thêm gia vị tùy theo từng loại', 40000, 'nước ngọt', '2017-10-16-10-44-10-be.png', '2017-10-16', 'đĩa', 1),
(2, 10, 'Nước giải khác các loại', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Chèn thập cẩm, chè đâu xanh, trà sữa trân châu,... được chế biến từ chính các đầu bếp của nhà hàng chúng tôi.', 45000, 'nước ngọt, khăn lạnh', 'nuoc_giai_khat_cac_loai.jpg', '2013-12-29', 'đĩa', 0),
(3, 2, 'Súp Gà Ngô non', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Cách làm:\r\n\r\n\r\nĐun nước dùng sôi, cho thịt gà vào, nêm muối tiêu, đun sôi nhỏ lửa 10 phút. Nếu bạn sợ gà quá nhừ thì có thể vớt thịt gà ra.', 25000, 'nước ngọt, khăn lạnh', 'sup_ngo_non.jpg', '2013-12-29', 'đĩa', 0),
(4, 1, 'Salát cà chua dưa chuột', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...Cách làm: dưa chuột cà chua, dứa, gọt vỏ, rửa sạch, thái lát mỏng. Bày xen kẽ các nguyên liệu trên theo hình tròn hoặc hình dẻ quạt.Tỏi, ớt đập dập, băm nhỏ, cho vào tô với một chút dấm đường và một chút muối. Quậy đều hỗn hợp trên, nếm thử thấy có vị chua, ngọt vừa ăn là được. Dội hỗn hợp trên vào đĩa nguyên liệu đã được trình bày.', 25000, 'nước ngọt, khăn lạnh', 'salat_ca_chua_dua_chuot.jpg', '2013-12-29', 'đĩa', 0),
(5, 1, 'Nộm gà xé phay', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Nguyên liệu:\r\n250g thịt ức gà\r\n½ củ hành tây to (hoặc 1 củ nhỏ)\r\n½ củ cà rốt\r\n1 chút lạc rang\r\nRau mùi, húng\r\nNước mắm, chanh, đường', 80000, 'nước ngọt, khăn lạnh', 'nom_ga_xe_phay.jpg', '2013-12-29', 'đĩa', 0),
(6, 2, 'Nem Phù đổng', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Gọi một đĩa nem ốc mà phải đợi đến 15 phút. Nem được gói từ trước, đến khi khách gọi nhà hàng mới mang vào rán. Trong lúc đợi có thể gọi bún ốc, Gọi một đĩa nem ốc mà phải đợi đến 15 phút. Nem được gói từ trước, đến khi khách gọi nhà hàng mới mang vào rán. Trong lúc đợi có thể gọi bún ốc, ', 80000, 'nước ngọt, khăn lạnh', 'nem-oc-phu-dong.jpg', '2013-12-29', 'đĩa', 0),
(7, 1, 'Tôm sú chiên trà', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Tôm sú chiên tràTôm sú chiên tràTôm sú chiên tràTôm sú chiên tràTôm sú chiên tràTôm sú chiên tràTôm sú chiên tràTôm sú chiên tràTôm sú chiên tràTôm sú chiên tràTôm sú chiên tràTôm sú chiên tràTôm sú chiên tràTôm sú chiên tràTôm sú chiên tràTôm sú chiên tràTôm sú chiên tràTôm sú chiên trà', 650000, 'nước ngọt, khăn lạnh', 'tomsu-nuocdua.jpg', '2013-12-29', 'đĩa', 0),
(8, 2, 'Gà quay', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Xu hướng ẩm thực của nhà hàng Anh Em khá đa dạng, tuy nhiên, nổi bật nhất vẫn là những món quay với hương vị mới như gà quay sầu riêng, gà quay bọc xôi...Xu hướng ẩm thực của nhà hàng Anh Em khá đa dạng, tuy nhiên, nổi bật nhất vẫn là những món quay với hương vị mới như gà quay sầu riêng, gà quay bọc xôi...', 25000, 'nước ngọt, khăn lạnh', 'ImageHandler.ashx.jpg', '2013-12-29', 'đĩa', 0),
(9, 1, 'Mực xào thập cẩm', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Mực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩm', 180000, 'nước ngọt, khăn lạnh', 'muc_xao_tham_cap.jpg', '2013-12-29', 'đĩa', 0),
(10, 1, 'Mực xào thập cẩm', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Mực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩmMực xào thập cẩm', 180000, 'nước ngọt, khăn lạnh', 'muc_xao_tham_cap.jpg', '2013-12-29', 'đĩa', 0),
(11, 1, 'Cải làn xào tỏi', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Cải làn xào tỏiCải làn xào tỏiCải làn xào tỏiCải làn xào tỏiCải làn xào tỏiCải làn xào tỏiCải làn xào tỏiCải làn xào tỏiCải làn xào tỏiCải làn xào tỏi', 70000, 'nước ngọt, khăn lạnh', 'cai_lan_xao_toi.jpg', '2013-12-29', 'đĩa', 0),
(12, 3, 'Canh chua ngao', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Canh chua ngaoCanh chua ngaoCanh chua ngaoCanh chua ngaoCanh chua ngaoCanh chua ngaoCanh chua ngaoCanh chua ngaoCanh chua ngaoCanh chua ngaoCanh chua ngaoCanh chua ngaoCanh chua ngaoCanh chua ngao', 90000, 'nước ngọt, khăn lạnh', 'canh ngao.jpg', '2013-12-29', 'đĩa', 0),
(13, 2, 'Cơm tám', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'com_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpgcom_tam.jpg', 25000, 'nước ngọt, khăn lạnh', 'com_tam.jpg', '2013-12-29', 'đĩa', 0),
(14, 1, 'Xôi Hoàng Phố', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Xôi Hoàng PhốXôi Hoàng PhốXôi Hoàng PhốXôi Hoàng PhốXôi Hoàng PhốXôi Hoàng PhốXôi Hoàng PhốXôi Hoàng PhốXôi Hoàng PhốXôi Hoàng PhốXôi Hoàng PhốXôi Hoàng PhốXôi Hoàng PhốXôi Hoàng PhốXôi Hoàng Phố', 60000, 'nước ngọt, khăn lạnh', 'xoi_hoang_pho.jpg', '2013-12-29', 'đĩa', 0),
(15, 2, 'Khăn lạnh', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Khăn lạnhKhăn lạnhKhăn lạnhKhăn lạnhKhăn lạnhKhăn lạnhKhăn lạnhKhăn lạnhKhăn lạnhKhăn lạnhKhăn lạnhKhăn lạnhKhăn lạnh', 2000, 'nước ngọt, khăn lạnh', 'khen_lanh.jpg', '2013-12-29', 'đĩa', 0),
(16, 2, 'Dưa Vàng', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Dưa VàngDưa VàngDưa VàngDưa VàngDưa VàngDưa VàngDưa VàngDưa VàngDưa VàngDưa VàngDưa VàngDưa VàngDưa VàngDưa VàngDưa VàngDưa VàngDưa VàngDưa Vàng', 60000, 'nước ngọt, khăn lạnh', 'dua_vang.jpg', '2013-12-29', 'đĩa', 0),
(17, 2, 'Nộm gà hoa chuối', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Nộm gà hoa chuốiNộm gà hoa chuốiNộm gà hoa chuốiNộm gà hoa chuốiNộm gà hoa chuốiNộm gà hoa chuốiNộm gà hoa chuốiNộm gà hoa chuốiNộm gà hoa chuốiNộm gà hoa chuốiNộm gà hoa chuốiNộm gà hoa chuốiNộm gà hoa chuốiNộm gà hoa chuối', 80000, 'nước ngọt, khăn lạnh', 'nom_ga_hoa_chuoi.jpg', '2013-12-29', 'đĩa', 0),
(18, 3, 'Tôm sú nướng ngũ vị', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Tôm sú nướng ngũ vịTôm sú nướng ngũ vị\r\nTôm sú nướng ngũ vị\r\nTôm sú nướng ngũ vị\r\nTôm sú nướng ngũ vị\r\nTôm sú nướng ngũ vị\r\nTôm sú nướng ngũ vị\r\nTôm sú nướng ngũ vị', 650000, 'nước ngọt, khăn lạnh', 'tom_su_nuong_ngu_vi.jpg', '2013-12-29', 'đĩa', 0),
(19, 3, 'Gà nướng Phù Đổng', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Gà nướng Phù ĐổngGà nướng Phù ĐổngGà nướng Phù ĐổngGà nướng Phù ĐổngGà nướng Phù ĐổngGà nướng Phù ĐổngGà nướng Phù ĐổngGà nướng Phù ĐổngGà nướng Phù ĐổngGà nướng Phù ĐổngGà nướng Phù Đổng', 280000, 'nước ngọt, khăn lạnh', 'ga_nuong_phu_dong.JPG', '2013-12-29', 'đĩa', 0),
(20, 2, 'Bò xốt tiêu đen', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Bò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đenBò xốt tiêu đen', 150000, 'nước ngọt, khăn lạnh', 'bo_sot_tieu_den.jpg', '2013-12-30', 'đĩa', 0),
(21, 2, 'Cá Điêu hồng chiên xù', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Cá Điêu hồng chiên xù\r\nCá Điêu hồng chiên xù\r\nCá Điêu hồng chiên xùCá Điêu hồng chiên xù\r\nCá Điêu hồng chiên xù\r\nCá Điêu hồng chiên xù', 2400000, 'nước ngọt, khăn lạnh', 'ca_dieu_hong_chien_xu.jpg', '2013-12-30', 'đĩa', 0),
(22, 2, 'Ngô chiên', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Ngô chiênNgô chiênNgô chiênNgô chiênNgô chiên\r\nNgô chiênNgô chiên\r\nNgô chiên', 60000, 'nước ngọt, khăn lạnh', 'ngochien.jpg', '2013-12-30', 'đĩa', 0),
(23, 2, 'Ngọn susu xào tỏi', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Ngọn susu xào tỏi Ngọn susu xào tỏi Ngọn susu xào tỏi\r\nNgọn susu xào tỏi Ngọn susu xào tỏi Ngọn susu xào tỏi', 45000, 'nước ngọt, khăn lạnh', 'susu_xao_toi.jpg', '2013-12-30', 'đĩa', 0),
(24, 2, 'Canh bóng mọc thập cẩm', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Canh bóng mọc thập cẩmCanh bóng mọc thập cẩmCanh bóng mọc thập cẩmCanh bóng mọc thập cẩm\r\nCanh bóng mọc thập cẩmCanh bóng mọc thập cẩmCanh bóng mọc thập cẩmCanh bóng mọc thập cẩm\r\nCanh bóng mọc thập cẩmCanh bóng mọc thập cẩmCanh bóng mọc thập cẩmCanh bóng mọc thập cẩmCanh bóng mọc thập cẩmCanh bóng mọc thập cẩm', 60000, 'nước ngọt, khăn lạnh', 'canh_bong_moc_thap_cam.jpg', '2013-12-30', 'đĩa', 0),
(25, 2, 'Cơm tám', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám \r\nCơm tám Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám \r\nCơm tám Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám Cơm tám ', 30000, 'nước ngọt, khăn lạnh', 'com_tam_ga.jpg', '2013-12-30', 'đĩa', 0),
(26, 2, 'Xôi vò hạt sen', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Xôi vò hạt sen\r\nXôi vò hạt sen\r\nXôi vò hạt sen\r\nXôi vò hạt sen\r\nXôi vò hạt sen\r\nXôi vò hạt sen', 60000, 'nước ngọt, khăn lạnh', 'xoi_vo_hat_sen.jpg', '2013-12-30', 'đĩa', 0),
(27, 2, 'Gỏi mướp đắng ruốc', 'Nguyên liệu\n\nMướp đắng: 2 quả, ruốc thịt heo: 50g, đá bào: 500g, nilon bọc đồ ăn, hoa cà rốt trang trí.', 'Cách chế biến\n\nMướp đắng rửa sạch, để ráo. Bổ đôi quả theo chiều dọc, sau đó xát thành từng lát mỏng 0,8 mm theo chiều ngang quả mướp. Đá cây bào mỏng, cho vào đĩa sâu lòng, bọc nilon mỏng kín mặt đĩa, xếp mướp đắng lên trên, trình bày cho đẹp mắt. Để khoảng 30 phút cho mướp mát lạnh. Nếu đã tan hết thì thay lượt đá khác với cách làm tương tự. Sau đó rắc ruốc thịt heo xé tơi lên trên.', 50000, 'nước ngọt, khăn lạnh', 'goi muop dang ruoc.jpg', '2013-12-30', 'đĩa', 0),
(28, 2, 'Dưa hấu', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Dưa hấu Dưa hấuDưa hấu Dưa hấuDưa hấu Dưa hấuDưa hấu Dưa hấu\r\nDưa hấu Dưa hấuDưa hấu Dưa hấu', 50000, 'nước ngọt, khăn lạnh', 'dua_hau.jpg', '2013-12-30', 'đĩa', 0),
(29, 2, 'Súp ngô cua', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Súp ngô cua Súp ngô cua Súp ngô cua Súp ngô cua Súp ngô cua Súp ngô cua Súp ngô cua Súp ngô cua Súp ngô cua Súp ngô cua Súp ngô cua Súp ngô cua', 30000, 'nước ngọt, khăn lạnh', 'sup_ngo_cua.jpg', '2013-12-30', 'đĩa', 0),
(30, 2, 'Salad Phù Đổng', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Salad Phù Đổng Salad Phù Đổng Salad Phù Đổng Salad Phù Đổng Salad Phù Đổng Salad Phù Đổng Salad Phù Đổng Salad Phù Đổng Salad Phù Đổng Salad Phù Đổng Salad Phù Đổng Salad Phù Đổng', 120000, 'nước ngọt, khăn lạnh', 'salat.jpg', '2013-12-30', 'đĩa', 0),
(31, 2, 'Tôm sú rang muối tiêu', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Tôm sú rang muối tiêu\r\nTôm sú rang muối tiêu\r\nTôm sú rang muối tiêu\r\nTôm sú rang muối tiêu\r\nTôm sú rang muối tiêu\r\nTôm sú rang muối tiêu', 650000, 'nước ngọt, khăn lạnh', 'tom_su_rang_muoi.jpg', '2013-12-30', 'đĩa', 1),
(32, 2, 'Gà nướng Phù Đổng', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Gà nướng Phù Đổng\r\nGà nướng Phù Đổng\r\nGà nướng Phù Đổng\r\nGà nướng Phù Đổng\r\nGà nướng Phù Đổng\r\nGà nướng Phù Đổng', 280000, 'nước ngọt, khăn lạnh', 'ga_nuong_pd.jpg', '2013-12-30', 'đĩa', 0),
(33, 2, 'Cua bấy chiên bơ', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Cua bấy chiên bơ\r\nCua bấy chiên bơ\r\nCua bấy chiên bơ\r\nCua bấy chiên bơ\r\nCua bấy chiên bơ\r\nCua bấy chiên bơ', 70000, 'nước ngọt, khăn lạnh', 'cua_bay_chien_bo.jpg', '2013-12-30', 'đĩa', 1),
(34, 2, 'Bò lúc lắc khoai tây', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Bò lúc lắc khoai tây\r\nBò lúc lắc khoai tây\r\nBò lúc lắc khoai tây\r\nBò lúc lắc khoai tây\r\nBò lúc lắc khoai tây\r\nBò lúc lắc khoai tây', 150000, 'nước ngọt, khăn lạnh', 'bo_luc_lac_khoai_tay.jpg', '2013-12-30', 'đĩa', 0),
(35, 2, 'Hoa lơ xanh xào tỏi', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Hoa lơ xanh xào tỏi\r\nHoa lơ xanh xào tỏi\r\nHoa lơ xanh xào tỏi\r\nHoa lơ xanh xào tỏi\r\nHoa lơ xanh xào tỏi\r\nHoa lơ xanh xào tỏi', 70000, 'nước ngọt, khăn lạnh', 'bong_cai_xanh.png', '2013-12-30', 'đĩa', 1),
(36, 2, 'Canh mọc tôm cua', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Canh mọc tôm cua\r\nCanh mọc tôm cuaCanh mọc tôm cua', 32000, 'nước ngọt, khăn lạnh, khăn lạnh', 'canh_moc_tom_cua.jpg', '2017-10-15', 'đĩa', 0),
(37, 2, 'Cơm chiên Hạnh Phúc', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Cơm chiên Hạnh Phúc\r\nCơm chiên Hạnh Phúc\r\nCơm chiên Hạnh Phúc\r\nCơm chiên Hạnh Phúc\r\nCơm chiên Hạnh Phúc\r\nCơm chiên Hạnh Phúc', 60000, 'nước ngọt, khăn lạnh', 'com_hanh_phuc.jpg', '2013-12-30', 'đĩa', 0),
(38, 2, 'Bánh trưng', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Bánh trưng Bánh trưng\r\nBánh trưng Bánh trưng Bánh trưng\r\nBánh trưng Bánh trưng\r\nBánh trưng Bánh trưng Bánh trưng', 60000, 'nước ngọt, khăn lạnh', 'banh_chung.jpg', '2013-12-30', 'đĩa', 0),
(39, 2, 'Kem Caramen', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Kem Caramen Kem Caramen Kem Caramen\r\nKem Caramen Kem Caramen Kem Caramen\r\nKem Caramen Kem Caramen Kem Caramen\r\nKem Caramen Kem Caramen Kem Caramen', 12000, 'nước ngọt, khăn lạnh', 'kem-caramen.jpg', '2013-12-30', 'đĩa', 0),
(40, 2, 'Súp Hải sản', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Súp Hải sản Súp Hải sản Súp Hải sản\r\nSúp Hải sản Súp Hải sản Súp Hải sản\r\nSúp Hải sản Súp Hải sản Súp Hải sản', 50000, 'nước ngọt, khăn lạnh', 'sup_hai_san.jpg', '2013-12-30', 'đĩa', 0),
(41, 2, 'Súp Hải sản', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Súp Hải sản Súp Hải sản Súp Hải sản\r\nSúp Hải sản Súp Hải sản Súp Hải sản\r\nSúp Hải sản Súp Hải sản Súp Hải sản', 50000, 'nước ngọt, khăn lạnh', 'sup_hai_san.jpg', '2013-12-30', 'đĩa', 0),
(42, 2, 'Salad Cá Ngừ', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Salad Cá Ngừ Salad Cá Ngừ\r\nSalad Cá Ngừ Salad Cá Ngừ\r\nSalad Cá Ngừ Salad Cá Ngừ\r\nSalad Cá Ngừ Salad Cá Ngừ\r\nSalad Cá Ngừ Salad Cá Ngừ\r\nSalad Cá Ngừ Salad Cá Ngừ', 98000, 'nước ngọt, khăn lạnh', 'salad_ca_ngu.jpg', '2013-12-30', 'đĩa', 0),
(43, 2, 'Tôm sú hấp nước dừa', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Tôm sú hấp nước dừa\r\nTôm sú hấp nước dừa\r\nTôm sú hấp nước dừa\r\nTôm sú hấp nước dừa', 650000, 'nước ngọt, khăn lạnh, khăn lạnh', 'tom_su_hap_nuoc_dua.jpg', '2017-10-15', 'đĩa', 0),
(44, 2, 'Gà hấp lá chanh', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Gà hấp lá chanh\r\nGà hấp lá chanh\r\nGà hấp lá chanh\r\nGà hấp lá chanh\r\nGà hấp lá chanh\r\nGà hấp lá chanh', 320000, 'nước ngọt, khăn lạnh', 'ga_hap_la_canh.jpg', '2013-12-30', 'đĩa', 0),
(45, 2, 'Cá tầm nướng', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Cá tầm nướng Cá tầm nướng\r\nCá tầm nướng Cá tầm nướng\r\nCá tầm nướng Cá tầm nướng\r\nCá tầm nướng Cá tầm nướng\r\nCá tầm nướng Cá tầm nướng\r\nCá tầm nướng Cá tầm nướng', 320000, 'nước ngọt, khăn lạnh', 'ca_tam_nuong.jpg', '2013-12-30', 'đĩa', 0),
(46, 2, 'Bò Úc bít tết', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Bò Úc bít tết Bò Úc bít tết Bò Úc bít tết\r\nBò Úc bít tết Bò Úc bít tết Bò Úc bít tết\r\nBò Úc bít tết Bò Úc bít tết Bò Úc bít tết\r\nBò Úc bít tết Bò Úc bít tết Bò Úc bít tết', 220000, 'nước ngọt, khăn lạnh', 'bo_uc_bit_tet.jpg', '2013-12-30', 'đĩa', 0),
(47, 2, 'Bò Úc bít tết', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Bò Úc bít tết Bò Úc bít tết Bò Úc bít tết\r\nBò Úc bít tết Bò Úc bít tết Bò Úc bít tết\r\nBò Úc bít tết Bò Úc bít tết Bò Úc bít tết\r\nBò Úc bít tết Bò Úc bít tết Bò Úc bít tết', 220000, 'nước ngọt, khăn lạnh', 'bo_uc_bit_tet.jpg', '2013-12-30', 'đĩa', 0),
(48, 4, 'Rau cải chíp xào thịt hộp', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Rau cải chíp xào thịt hộp Rau cải chíp xào thịt hộp Rau cải chíp xào thịt hộp\r\nRau cải chíp xào thịt hộp Rau cải chíp xào thịt hộp Rau cải chíp xào thịt hộp', 80000, 'nước ngọt, khăn lạnh', 'rau_cai_chip_vao_thit_hop.jpg', '2013-12-30', 'đĩa', 0),
(49, 5, 'Canh gà nấm tươi', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Canh gà nấm tươi Canh gà nấm tươi Canh gà nấm tươi\r\nCanh gà nấm tươi Canh gà nấm tươi Canh gà nấm tươi', 70000, 'nước ngọt, khăn lạnh', 'canh_ga_nam_tuoi.jpg', '2013-12-30', 'đĩa', 0),
(50, 6, 'Cơm rang Hải sản', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Cơm rang Hải sản Cơm rang Hải sản Cơm rang Hải sản\r\nCơm rang Hải sản Cơm rang Hải sản Cơm rang Hải sản', 80000, 'nước ngọt, khăn lạnh', 'com_rang_hai_san.jpg', '2013-12-30', 'đĩa', 0),
(51, 6, 'Xôi lạp sườn', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Xôi lạp sườn Xôi lạp sườn Xôi lạp sườn\r\nXôi lạp sườn Xôi lạp sườn Xôi lạp sườn\r\nXôi lạp sườn Xôi lạp sườn Xôi lạp sườn', 60000, 'nước ngọt, khăn lạnh', 'xoi_lap_suon.jpg', '2013-12-30', 'đĩa', 0),
(52, 6, 'Hoa quả thập cẩm', 'Nguyên liệu: 3 quả dưa chuột, 3 quả cà chua, 1/2 quả dứa, xà lách xoăn, hành tây, tỏi, đường, dấm, ớt...', 'Hoa quả thập cẩm Hoa quả thập cẩm Hoa quả thập cẩm\r\nHoa quả thập cẩm Hoa quả thập cẩm Hoa quả thập cẩm', 65000, 'nước ngọt, khăn lạnh', 'hoa_qua_thap_cam.jpg', '2013-12-30', 'đĩa', 0),
(53, 4, 'Salat Tôm trái thơm', 'Tôm để làm salad nên chọn tôm tươi, thích nhất vẫn là loại tôm đang bơi lội tung tăng khi ra chợ', 'Nguyên liệu:\r\n\r\n* Nước trộn:\r\n\r\n- 80ml dấm gạo\r\n\r\n- 60ml xì dầu\r\n\r\n- 2 tbs mật ong\r\n\r\n- 1 tsp dầu vừng\r\n\r\n- 1 – 2 tsp gừng băm nhỏ\r\n\r\n- 4, 5 tép tỏi, băm nhỏ', 150000, 'nước uống, khen lạnh', 'salad_tom_thai_thom.jpg', '2013-12-31', 'đĩa', 1),
(54, 4, 'Bào Ngư xào song nấm', 'Dùng nóng với cơm và chấm kèm nước tương. ', 'Nguyên liệu- 1 hộp bầu ngư - 10 tai nấm đông cô - 1 hủ hay 1 hộp măng tây - củ hành,- muối ,tiêu, bột bouillons de volaille ( hoặc bột ngọt ),- 1 muỗng súp dầu mè,- 1 muỗng súp dầu hào.- Dầu ăn- 1 muổng súp bột maïzenna - Chút ngò , hành lá ', 300000, 'nước uống, khen lạnh', 'nam bao ngu xao toi.jpg', '2013-12-31', 'đĩa', 1),
(55, 4, 'Bào Ngư sốt dầu hào nguyên con', 'Đây là một món ăn ngon và bổ dưỡng,chế biến món ăn tốn khá nhiều thời gian cho khâu sơ chế và khâu nấu nướng,dưới đây là cách chế biến món bào ngư sốt dầu hào. ', 'Nguyên liệu:\r\n\r\n    Bào ngư 4 con\r\n    gà mái 1 con\r\n    thịt nạc 300g\r\n    sò điệp khô 3 con\r\n    Hành lá 1 tép\r\n    Nước dùng gà\r\n    jambon Kim Hoa 50g\r\n    dầu hào\r\n    dầu mè\r\n    bột năng\r\n    một miếng phên tre nếu không có thì dùng mấy chiếc xiên bằng tre', 250000, 'nước uống, khen lạnh', 'bao_ngu_sot_dau_hao.jpg', '2013-12-31', 'đĩa', 1),
(56, 4, 'Bào Ngư om cải xanh', 'Nguyên liệu: 500g bào ngư Úc 300g rau cải xanh Nước xương gà, hành khô, gừng, mắm, muối, mì chính. ', 'YÊU CẦU THÀNH PHẨM:\r\n\r\nThơm ngon , nước trong mà vẫn ngọt đặc trưng. Có thể cho thêm nấm hương để tăng thêm độ hấp dẫn. Trang trí thêm hoa cà rốt cho bắt mắt.\r\n\r\nMón này dùng làm món khai vị (thay súp). ', 180000, 'nước uống, khen lạnh', 'bao_ngu_om_cai_xanh.jpg', '2013-12-31', 'đĩa', 1),
(57, 4, 'Bào Ngư sốt nấm', 'Bắc nồi lên bếp, cho mỡ gà vào thắng lấy nước. ', 'Nguyên liệu:\r\n- 500g nấm hương\r\n- 2 chai nước bào ngư\r\n- 100g bông cải xanh\r\n- 300g nước dùng gà\r\n- 50g dầu hàu\r\n- 150g mỡ gà\r\n- 5g muối\r\n- 50g gừng, hành tây', 190000, 'nước uống, khen lạnh', 'bao_ngu_sot_nam.jpg', '2013-12-31', 'đĩa', 1),
(58, 4, 'Gỏi mướp đắng ruốc', 'Mướp đắng ướp đá ruốc không chỉ là món ăn đơn giản, ngon miệng mà còn rất tốt cho sức khỏe. ', 'Nguyên liệu\r\n\r\nMướp đắng: 2 quả, ruốc thịt heo: 50g, đá bào: 500g, nilon bọc đồ ăn, hoa cà rốt trang trí.', 12000, 'nước uống, khen lạnh', 'goi-kho-qua-muop-dang.jpg', '2013-12-31', 'đĩa', 1),
(59, 4, 'Nộm bò rau muống', 'Món này ăn rau muống giòn cực như ăn rau sống ý. Mùa hè ăn thế này thấy mát mát và mát mắt nữa vì đủ màu, xanh, đỏ, nâu, trắng. Thịt bò cũng chua chua ngọt ngọt. ', 'Nguyên liệu:\r\n\r\nRau muống: sơ mới ½ mớ\r\nGiá đỗ: 1 ít thôi\r\nCà rốt: thái mỏng dài bằng giá đỗ.\r\nThịt thăn bò, dứa ½ quả\r\nLạc rang giã dập\r\nMuối, cốt chanh, đường, ớt xay.', 80000, 'nước uống, khen lạnh', 'nom_bo_rau_muong.jpg', '2013-12-31', 'đĩa', 1),
(60, 4, 'Nộm gà hoa chuối', 'Nộm gà hoa chuối làm không quá cầu kỳ nhưng để để món ăn có được nhiều hương vị phong phú, bạn cần chuẩn bị nhiều loại nguyên liệu khác nhau. ', 'Nguyên liệu: Thịt gà (lườn): 150 g, cà rốt bào sợi: một củ, hoa chuối: 300 g, chanh: một quả, đường: 3 thìa canh, giấm: 3 thìa canh, muối: 2 thìa cà phê, mắm: 2 thìa canh, lá chanh: 5 lá, hành tây: một củ, rau răm, tỏi, ớt, lạc, hành, tiêu, rau mùi, thơm, xà lách, cà chua.', 50000, 'nước uống, khen lạnh', 'nom_ga_rau_chuoi.jpg', '2013-12-31', 'đĩa', 1),
(61, 6, 'Xôi gà', 'Nộm gà hoa chuối làm không quá cầu kỳ nhưng để để món ăn có được nhiều hương vị phong phú, bạn cần chuẩn bị nhiều loại nguyên liệu khác nhau. ', 'Nguyên liệu: Thịt gà (lườn): 150 g, cà rốt bào sợi: một củ, hoa chuối: 300 g, chanh: một quả, đường: 3 thìa canh, giấm: 3 thìa canh, muối: 2 thìa cà phê, mắm: 2 thìa canh, lá chanh: 5 lá, hành tây: một củ, rau răm, tỏi, ớt, lạc, hành, tiêu, rau mùi, thơm, xà lách, cà chua.', 25000, 'nước ngọt, khăn lạnh', 'xoi_ga.jpg', '2014-01-03', 'đĩa', 1),
(62, 1, 'ốc bươu kho gừng ', 'Món ốc đậm đà thấm vị, thịt giòn ngọt, thơm và ấm vị gừng. Mùa mưa đang đến, ngồi bên mâm cơm gia đình với món Ốc bươu kho gừng thơm lừng sẽ giúp không khí cả gia đình bạn ấm cúng lắm đó.', 'Để chế biến món ăn này, chúng ta cần các nguyên liệu sau đây:\r\n- Ốc bươu bỏ phần ốc bùn phía dưới, xát thịt ốc với ít muối và ít giấm rửa sạch nhớt, để ráo. Ướp với 1m bột ngọt AJI-NO-MOTO®, 1M nước mắm, 1m giấm gạo lên men LISA, 2M hành tỏi băm, gừng sợi và ớt hiểm.\r\n- Gừng thái chỉ. Ớt hiểm đập dập.\r\nCách chế biến\r\n- Dùng tộ đất cho 1M dầu, 1M đường thắng caramel, thêm 1M dầu điều, cho ốc bươu vào xào săn, kho nhỏ lửa đến khi ốc vừa chín, nước kho cạn sệt.\r\nThưởng thức\r\n- Bày ra đĩa, dùng khi ', 50000, '0', 'oc-buou-kho-gung.jpg', '2014-04-21', 'món', 1),
(63, 3, 'Tên món ăn', 'Mô tả tóm tắt', 'Mô tả đầy đủ', 1200000, 'nước ngọt, khăn lạnh', '2017-10-14-08-56-46-be.png', '2017-10-14', 'hộp', 1),
(65, 4, 'name foods', 'Mô tả ngắn', 'Detailsss', 111111, 'khăn lạnh', '2017-10-14-02-03-20-452015114730781.png', '2017-10-14', 'đĩa', 0),
(66, 1, 'ggg', 'gg', 'ggg', 4444, 'nước ngọt', '2017-10-14-02-50-07-be.png', '2017-10-14', 'ggg', 0),
(68, 6, 'Tên món mới', 'cccc', 'cxcc', 2222, 'nước ngọt, khăn lạnh', '2017-10-16-10-30-27-1.PNG', '2017-10-16', '23232', 1),
(69, 1, 'sdsd', 'sdsd', 'sdsds', 333, 'nước ngọt', '2017-10-16-10-31-09-452015114730781.png', '2017-10-16', 'dsds', 1),
(70, 4, 'sdsds', 'sdsds', 'dsds', 222, 'khăn lạnh', '2017-10-14-03-10-15-be.png', '2017-10-14', 'dsds', 1),
(71, 4, 'hfdfg', 'dssd', 'sdsd', 12121, 'khăn lạnh', '2017-10-15-03-16-08-be.png', '2017-10-15', '3wd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_type`
--

CREATE TABLE `food_type` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `food_type`
--

INSERT INTO `food_type` (`id`, `name`, `description`, `image`) VALUES
(1, 'Món Canh Bổ Dưỡng', 'Mùi thơm của cá quyện với vị ngọt của hoa thiên lý sẽ mang đến cho cả nhà một tô canh ngọt ngào và bổ dưỡng. Bạn có muốn biết thêm nhiều công thức món canh ngon hấp dẫn khác của người Việt Nam?', 'caloc-bongly.jpg'),
(2, 'Bún, mì, miến, phở', 'Bánh canh, Bánh đa cua, Bún bò Huế, Bún bung', 'bun_mi_mien_pho.jpg'),
(3, 'Cơm', 'Cơm bình dân với nhiều món ăn đa dạng, phong phú. Thông thường thực đơn sẽ bao gồm một dĩa cơm và một phần thức ăn theo lựa chọn, một bát canh.', 'com.jpg'),
(4, 'Món ăn thường nhật', 'Sử dụng rất đa dạng các loại rau, củ, quả phối trộn với muối theo một tỉ lệ nhất định theo kinh nghiệm của người ẩm thực không quá mặn cũng không quá nhạt.', 'page2-img5.jpg'),
(5, 'Xôi', 'Là một món ăn ngon, bổ, phổ thông, và rất được ưa chuộng như một đồ thờ cúng ngày lễ, tết, giỗ chạp, hoặc đi kèm với lợn sữa quay trên mâm đồ lễ ăn hỏi. Sử dụng thịt gấc để tạo màu sắc đỏ tươi tắn và hương vị thơm ngon cho món xôi.', 'xoi_ga10.jpg'),
(6, 'Cháo, súp, canh', 'Gồm một nồi nước dùng đang sôi, các món ăn sống được để xung quanh và người ăn gắp đồ ăn sống bỏ vào nồi nước dùng, đợi chín tới và ăn nóng', 'chao_sup_canh.jpg'),
(7, 'Món cuốn', 'Món ăn ngon, nổi tiếng của người Việt và được chế biến từ thịt, trứng, rau củ quả băm nhỏ trộn đều, gói trong bánh đa nem và rán giòn', 'mon_cuon.jpg'),
(8, 'Bánh mặn', 'à loại bánh duy nhất có lịch sử lâu đời trong ẩm thực truyền thống Việt Nam còn được sử sách nhắc lại, bánh chưng có vị trí đặc biệt trong tâm thức của cộng đồng người Việt', 'banh_man.jpg'),
(9, 'Xào', 'Một số loại lá được đốt lên lấy tro để ngâm cùng với gạo nếp tạo ra màu nâu vàng như màu hổ phách cũng như hương vị đặc trưng của bánh. Phổ biến nhất vẫn là cách gói bánh thuôn dài. Bánh ăn chấm đường hoặc mật ong,mật mía.', 'xao.jpg'),
(10, 'Nước giải khát', 'Các loại nước giải khát', 'nuoc_giai_khat.jpg'),
(11, 'Salát', 'Đây là một món ăn được nhiều người Việt Nam thích ăn. Có 2 nguyên liệu tạo nên hương vị đặc trưng cho món sa lát Nga. Đó là Sause Mayonnaise (có thể mua ở các siêu thị) và Jambon (mua ở các cửa hàng bán thực phẩm chín), còn các nguyên liệu khác là rau quả củ rất sẵn ', 'salat.jpg'),
(12, 'Bào ngư', 'Đây là một món ăn ngon và bổ dưỡng,chế biến món ăn tốn khá nhiều thời gian cho khâu sơ chế và khâu nấu nướng,dưới đây là cách chế biến món bào ngư sốt dầu hào. ', 'bao_ngu.jpg'),
(13, 'Demo insert', 'Demo Description...', 'demo.png'),
(14, 'Demo insert', 'Demo Description...', 'demo.png'),
(15, 'Demo insert', 'Demo Description...', 'demo.png');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `promotion_price` float NOT NULL DEFAULT '0',
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `price`, `promotion_price`, `detail`, `image`) VALUES
(1, 'Thực đơn 1', 1194000, 0, 'Súp Gà Ngô non, Nộm gà xé phay, Tôm sú chiên trà, Mực xào thập cẩm, Cải làn xào tỏi', 'thuc_don_1.jpg'),
(2, 'Thực đơn 2', 1327000, 0, 'Cải làn xào tỏi, Cơm tám, Xôi Hoàng Phố, Dưa Vàng, Nộm gà hoa chuối', 'thuc_don_2.jpg'),
(3, 'Thực đơn 3', 170600, 0, 'Tôm sú nướng ngũ vị, Gà nướng Phù Đổng, Bò xốt tiêu đen, Cá Điêu hồng chiên xù.', 'thuc_don_3.jpg'),
(4, 'Thực đơn 4', 2185000, 0, 'Các món ăn theo thực đơn đã chọn, chế biến ngon, đẹp, đầy đặn, phục vụ nóng<br>\nKhuyến mãi: khăn lạnh, món tráng miệng', 'thuc_don_4.jpg'),
(5, 'Thực đơn 5', 2180000, 0, 'Các món ăn theo thực đơn đã chọn, chế biến ngon, đẹp, đầy đặn, phục vụ nóng<br>\nKhuyến mãi: khăn lạnh, món tráng miệng', 'thuc_don_5.jpg'),
(6, 'Thực đơn 6', 2690000, 0, 'Các món ăn theo thực đơn đã chọn, chế biến ngon, đẹp, đầy đặn, phục vụ nóng<br>\nKhuyến mãi: khăn lạnh, món tráng miệng', 'thuc_don_6.jpg'),
(7, 'Thực đơn 7', 2890000, 0, 'Các món ăn theo thực đơn đã chọn, chế biến ngon, đẹp, đầy đặn, phục vụ nóng<br>\nKhuyến mãi: khăn lạnh, món tráng miệng', 'thuc_don_7.jpg'),
(8, 'Thực đơn 8', 1980000, 0, 'Các món ăn theo thực đơn đã chọn, chế biến ngon, đẹp, đầy đặn, phục vụ nóng<br>\nKhuyến mãi: khăn lạnh, món tráng miệng', 'thuc_don_8.jpg'),
(9, 'Thực đơn 9', 1780000, 0, 'Các món ăn theo thực đơn đã chọn, chế biến ngon, đẹp, đầy đặn, phục vụ nóng<br>\nKhuyến mãi: khăn lạnh, món tráng miệng', 'thuc_don_9.jpg'),
(10, 'Thực đơn 10', 1780000, 0, 'Các món ăn theo thực đơn đã chọn, chế biến ngon, đẹp, đầy đặn, phục vụ nóng<br>\nKhuyến mãi: khăn lạnh, món tráng miệng', 'thuc_don_10.jpg'),
(11, 'Thực đơn 11', 1890000, 0, 'Các món ăn theo thực đơn đã chọn, chế biến ngon, đẹp, đầy đặn, phục vụ nóng<br>\nKhuyến mãi: khăn lạnh, món tráng miệng', 'thuc_don_11.jpg'),
(12, 'Thực đơn 12', 1890000, 0, 'Các món ăn theo thực đơn đã chọn, chế biến ngon, đẹp, đầy đặn, phục vụ nóng<br>\nKhuyến mãi: khăn lạnh, món tráng miệng', 'thuc_don_12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu_detail`
--

CREATE TABLE `menu_detail` (
  `id_menu` int(11) NOT NULL,
  `id_food` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `menu_detail`
--

INSERT INTO `menu_detail` (`id_menu`, `id_food`, `quantity`) VALUES
(1, 3, 1),
(1, 7, 1),
(1, 8, 1),
(1, 9, 1),
(1, 17, 1),
(2, 11, 1),
(2, 13, 1),
(2, 14, 1),
(2, 15, 1),
(2, 16, 1),
(2, 17, 1),
(3, 18, 1),
(3, 19, 1),
(3, 20, 1),
(3, 21, 1),
(3, 22, 1),
(3, 30, 1),
(4, 17, 1),
(4, 23, 1),
(4, 24, 1),
(4, 25, 1),
(4, 26, 1),
(4, 27, 1),
(5, 18, 1),
(5, 28, 1),
(5, 29, 1),
(5, 31, 1),
(5, 32, 1),
(5, 33, 1),
(6, 18, 1),
(6, 34, 1),
(6, 35, 1),
(6, 36, 1),
(6, 37, 1),
(6, 38, 1),
(7, 39, 1),
(7, 40, 1),
(7, 41, 1),
(7, 42, 1),
(7, 43, 1),
(7, 44, 1),
(8, 45, 1),
(8, 46, 1),
(8, 47, 1),
(8, 48, 1),
(8, 49, 1),
(8, 50, 1),
(9, 51, 1),
(9, 52, 1),
(9, 53, 1),
(9, 54, 1),
(9, 55, 1),
(9, 56, 1),
(10, 1, 1),
(10, 58, 1),
(10, 59, 1),
(10, 60, 1),
(10, 61, 1),
(10, 62, 1),
(11, 22, 1),
(11, 24, 1),
(11, 26, 1),
(11, 28, 1),
(11, 30, 1),
(11, 32, 1),
(12, 2, 1),
(12, 8, 1),
(12, 16, 1),
(12, 22, 1),
(12, 32, 1),
(12, 48, 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_resource`
--

CREATE TABLE `role_resource` (
  `role` varchar(50) NOT NULL,
  `resource` varchar(100) NOT NULL,
  `allow` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_resource`
--

INSERT INTO `role_resource` (`role`, `resource`, `allow`) VALUES
('editor', 'mon_an_trong_ngay', 'index'),
('editor', 'tin_tuc', 'index,them,cap-nhat,xoa'),
('guest', 'mon_an', 'index'),
('guest', 'mon_an_trong_ngay', 'index'),
('staff', 'khach_hang', 'index,them,xoa,cap-nhat,chi-tiet'),
('staff', 'mon_an', 'index,them,xoa,cap-nhat'),
('staff', 'mon_an_trong_ngay', 'index'),
('staff', 'thuc_don', 'index,them-thuc-don,chi-tiet,them-mon,xoa,cap-nhat');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pw_reset_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pw_reset_token_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `birthdate`, `gender`, `address`, `email`, `phone`, `role`, `pw_reset_token`, `pw_reset_token_date`) VALUES
(47, 'huonghuong222', '$2y$10$7tmSVC3I6f.sQFYPscTSVuZloEBaeQb.HyToXVZUHuaezLaZN4Si.', 'Hương Hương', '2017-09-22', 'nữ', 'Hoàng Diệu 2, Thủ Đức', 'huonghuong08.php@gmail.com', '2333434', 'admin', NULL, NULL),
(48, 'huong01', '$2y$10$GZu42i9PmHTN2xeYdpSZsuUh6ODOyqioq8P8c1Hkawy5tEpffxV1q', 'Hương Hương', '2017-09-09', 'nam', 'Hoàng Diệu 2, Thủ Đức', 'hudsdsdongnguyenak96@gmail.com', '21313131', 'guest', NULL, NULL),
(52, 'huonghuong', '$2y$10$Bq1SC8iuO8AdUxVseudz0uhTYPO4PX2NISO5EiUHPksrThcgrTsr6', 'Hương Hương ssss', '2017-09-07', 'other', 'Lê Thị Riêng', 'huongnguyenak96@gmail.com', '234567324456', 'editor', NULL, NULL),
(57, 'huonghuong0008', '$2y$10$bNkMerTk45xRbtOidJtPfuxtBWRLccDQUEDI6IUMLCWCBWBnrU4Fq', 'Ngọc Hương', '2017-10-07', 'nữ', 'Quận 1, Hồ Chí Minh City', 'huong02@yahoo.com', '1234567890', 'guest', NULL, NULL),
(54, 'huongngoc99', '$2y$10$tdFR5mr7R5Lcnxv38KTRB.RRfxux3/vXmwsRAnS8DGytX/EThTOcO', 'Ngọc  Hương', '2017-10-17', 'nữ', 'Quận 1, HCM', 'huong01@yahoo.com', '21234567890', 'admin', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `1` (`id_customer`);

--
-- Indexes for table `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD PRIMARY KEY (`id_bill`,`id_food`),
  ADD KEY `3` (`id_food`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demo`
--
ALTER TABLE `demo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `my_unique_key` (`new_name`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type` (`id_type`);

--
-- Indexes for table `food_type`
--
ALTER TABLE `food_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_detail`
--
ALTER TABLE `menu_detail`
  ADD PRIMARY KEY (`id_menu`,`id_food`),
  ADD KEY `id_food` (`id_food`);

--
-- Indexes for table `role_resource`
--
ALTER TABLE `role_resource`
  ADD PRIMARY KEY (`role`,`resource`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `food_type`
--
ALTER TABLE `food_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `1` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`);

--
-- Constraints for table `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD CONSTRAINT `2` FOREIGN KEY (`id_bill`) REFERENCES `bills` (`id`),
  ADD CONSTRAINT `3` FOREIGN KEY (`id_food`) REFERENCES `foods` (`id`);

--
-- Constraints for table `foods`
--
ALTER TABLE `foods`
  ADD CONSTRAINT `foods_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `food_type` (`id`);

--
-- Constraints for table `menu_detail`
--
ALTER TABLE `menu_detail`
  ADD CONSTRAINT `menu_detail_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `menu_detail_ibfk_2` FOREIGN KEY (`id_food`) REFERENCES `foods` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
