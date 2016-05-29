-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 29, 2016 at 08:29 PM
-- Server version: 5.6.28-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hoannc006`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` int(1) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `gender` int(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `description` text,
  `presenter` varchar(50) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `level`, `fullname`, `gender`, `birthday`, `phone`, `avatar`, `description`, `presenter`, `create_at`, `update_at`) VALUES
(1, 'anhdn', 'nhocwaltcott@gmail.com', 'eba9eb56eebdae21ce21f74e46e47319', 0, 'Đỗ Nguyệt Anh', 1, '1994-04-24', '0966092547', 'dog2.png', '"Khi tin mình có thể làm được điều gì thì chắc chắn bạn sẽ đạt được điều ấy!!!	    								    								    								    								    								    								    								    				', '2', '2016-05-27 11:09:08', '2016-05-29 04:09:33'),
(2, 'hoannc', 'nguyenconghoan94@gmail.com', 'c1101c86e7b7a604ff93ba4d99017ccf', 3, 'Nguyễn Công Hoan', 2, '1994-04-05', '01648998623', 'hoannc.jpg', '				    									    									    									    					Nếu bạn có niềm tin và sự kiên trì, bạn sẽ thành công !				    								    								    								    				', '', '2016-05-27 10:20:24', '2016-05-28 06:23:45'),
(4, 'daind', 'dai12051997@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'Nguyễn Đức Đại', 2, '1998-01-01', '01664628565', '', '				    									    									    								    					aaaaaaaaaaaaa			    								    								    								    				', '2', '2016-05-25 10:52:32', '2016-05-29 09:57:50'),
(5, 'hoangnm', 'hoangnm@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'Nguyễn Minh Hoàng', NULL, NULL, '0912206193', '', 'Đây là nguyễn minh hoàng', '10', '2016-05-25 07:11:33', NULL),
(6, 'thaint', 'thaint@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'Nguyễn Trọng Thái', NULL, NULL, '01672297611', '', 'đây là thái', '9', '2016-05-25 09:42:32', NULL),
(7, 'tiennh', 'tiennh@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'Nguyễn Hữu Tiến', NULL, NULL, '0968242682', '', '', '8', '2016-05-26 11:34:39', NULL),
(8, 'tuannv', 'tuannv@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'Nguyễn Văn Tuấn', NULL, NULL, '01644772473', '', '', '7', '2016-05-26 11:35:27', NULL),
(9, 'nhodh', 'nhodh@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'Đoàn Hữu Nho', NULL, NULL, '01687149577', '', '', '6', '2016-05-26 11:36:34', NULL),
(10, 'hocvt', 'hocvt@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'Vũ Thái Học', NULL, NULL, '01643123455', '', '', '5', '2016-05-26 11:37:17', NULL),
(11, 'luongnp', 'luongnp@gmail.com', '25d55ad283aa400af464c76d713c07ad', 2, 'Nguyễn Phúc Lương', 2, '1994-11-30', '016578988', '217892_10151115975579048_1483385134_n.jpg', '				    									    									    									    									    								    								    								    				Lương np', '', '2016-05-27 10:58:10', '2016-05-28 06:36:41'),
(12, 'anhct', 'anhct@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'Chu Thế Anh', NULL, NULL, '0156888888', '', '', '3', '2016-05-26 11:39:10', NULL),
(13, 'thaind', 'thaind@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'Nguyễn Duy Thái', NULL, NULL, '015678908', '', '', '2', '2016-05-26 11:39:54', NULL),
(14, 'quannh', 'quannh', '25d55ad283aa400af464c76d713c07ad', 1, 'Nguyễn Hồng Quân', NULL, NULL, '0187658899', '', '', '2', '2016-05-27 12:36:38', NULL),
(15, 'hoihh', 'hoihh@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'Hoàng Hữu Hợi', NULL, NULL, '0176889877', '', '', '2', '2016-05-27 09:01:02', NULL),
(16, 'tungtv', 'tungtv@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'Trần Văn Tùng', NULL, NULL, '01876557889', '', '', '2', '2016-05-27 09:05:48', NULL),
(17, 'hoan á', 'hhhhhhhhhhhhhhh', '25d55ad283aa400af464c76d713c07ad', 1, 'hhhhhhhhhhhhhhhhhh', NULL, NULL, '121938928', '', NULL, '', '2016-05-27 03:02:00', NULL),
(19, 'aaaaaa á', 'dsdsd', '25d55ad283aa400af464c76d713c07ad', 1, 'âaaaaaaaaaâ', NULL, NULL, 'sfsfsf', '', NULL, '', '2016-05-27 03:09:06', NULL),
(20, 'as ă', 'aaaaaa', '25d55ad283aa400af464c76d713c07ad', 1, 'dfdfdf', NULL, NULL, 'dsds', '', NULL, '', '2016-05-27 03:10:53', NULL),
(21, 'phongpt', 'phongpt@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'Phạm Thanh Phong', NULL, NULL, '0966092523', NULL, NULL, '', '2016-05-27 05:26:18', NULL),
(22, 'anhnt', 'anhnt@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'Nguyễn Tùng Anh', NULL, NULL, '01664628562', NULL, NULL, '2', '2016-05-27 09:38:16', NULL),
(23, 'phucnh', 'phucnh@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'Nguyễn Hữu Phúc', NULL, NULL, '0966092232', NULL, NULL, '1', '2016-05-28 11:47:55', NULL),
(24, 'thanhnv', 'thanhnv@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'Nguyễn Văn Thành', NULL, NULL, '01222222233', NULL, NULL, '2', '2016-05-29 02:07:16', NULL),
(25, 'ngocbv', 'ngocbv@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'Bùi Văn Ngọc', NULL, NULL, '01664628561', NULL, NULL, '', '2016-05-29 02:08:27', NULL),
(26, 'huulv', 'huulv@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'Lê Văn Hựu', NULL, NULL, '09660925423', NULL, NULL, '', '2016-05-29 04:02:11', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
