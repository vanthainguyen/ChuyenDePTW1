-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 11, 2019 lúc 01:44 AM
-- Phiên bản máy phục vụ: 10.1.36-MariaDB
-- Phiên bản PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `facefly`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `airlines`
--

CREATE TABLE `airlines` (
  `airline_id` int(11) NOT NULL,
  `airline_name` varchar(55) NOT NULL,
  `nation_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `airlines`
--

INSERT INTO `airlines` (`airline_id`, `airline_name`, `nation_id`) VALUES
(1, ' Vietnam Airlines', 2),
(2, ' Jetstar Pacific', 2),
(3, 'VietJetAir', 2),
(4, 'Air Mekong', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `airports`
--

CREATE TABLE `airports` (
  `airport_id` int(11) NOT NULL,
  `airport_name` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `airports`
--

INSERT INTO `airports` (`airport_id`, `airport_name`) VALUES
(1, 'Sân bay Quốc tế Tân Sơn Nhất'),
(2, 'Sân bay Quốc tế Nội Bài – Hà Nội'),
(3, 'Sân bay Quốc tế Đà Nẵng'),
(4, 'Sân bay Côn Đảo'),
(5, 'Sân bay Nà Sản'),
(6, 'Sân bay Phù Cát – Bình Định'),
(7, 'Sân bay Cà Mau'),
(8, 'Sân bay Buôn Ma Thuột'),
(9, 'Sân bay Điện Biên Phủ'),
(10, 'Sân bay Pleiku – Gia Lai'),
(11, 'Sân bay Rạch Giá – Kiên Giang'),
(12, 'Sân bay Liên Khương – Đà Lạt'),
(13, 'Sân bay Tuy Hòa – Phú Yên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(55) NOT NULL,
  `city_code` varchar(15) NOT NULL,
  `city_airport_id` int(11) NOT NULL,
  `nation_id` int(11) NOT NULL,
  `flight_route_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `city_code`, `city_airport_id`, `nation_id`, `flight_route_id`) VALUES
(1, 'Đà Nẵng', 'DN', 1, 2, 1),
(2, 'Thành phố Hồ Chí Minh', 'TPHCM', 2, 2, 1),
(4, 'Hà Nội ', 'HN', 3, 2, 1),
(5, 'Bà Rịa-Vũng Tàu', 'BR-VT', 4, 2, 1),
(6, 'Sơn La', 'SL', 5, 2, 1),
(7, 'Bình Định', 'BĐ', 6, 2, 1),
(8, 'Cà Mau', 'CM', 7, 2, 1),
(9, 'Đắk Lắk', 'ĐL', 8, 2, 1),
(10, 'Điện Biên', 'ĐBP', 9, 2, 1),
(11, 'Gia Lai', 'GL', 10, 2, 1),
(12, 'Kiên Giang', 'KG', 11, 2, 1),
(13, 'Lâm Đồng', 'LD', 12, 2, 1),
(14, 'Phú Yên', 'PY', 13, 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_user_id` int(11) NOT NULL,
  `customer_first_name` varchar(55) NOT NULL,
  `customer_last_name` varchar(16) NOT NULL,
  `customer_title` varchar(16) NOT NULL,
  `customer_transfer` varchar(55) NOT NULL,
  `customer_paypal` varchar(55) NOT NULL,
  `customer_credit_card` int(16) NOT NULL,
  `customer_credit_name` varchar(55) NOT NULL,
  `customer_credit_ccv` varchar(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `flight_booking`
--

CREATE TABLE `flight_booking` (
  `fb_id` int(11) NOT NULL,
  `fb_airline_id` int(11) NOT NULL,
  `fb_city_from_id` int(11) NOT NULL,
  `fb_city_to_id` int(11) NOT NULL,
  `fb_departure_date` int(11) NOT NULL,
  `fb_landing_date` int(11) NOT NULL,
  `fb_transit_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `flight_classes`
--

CREATE TABLE `flight_classes` (
  `fc_id` int(11) NOT NULL,
  `fc_name` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `flight_classes`
--

INSERT INTO `flight_classes` (`fc_id`, `fc_name`) VALUES
(1, 'Business'),
(2, 'Economic'),
(3, 'Premium Economy');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `flight_list`
--

CREATE TABLE `flight_list` (
  `fl_id` int(11) NOT NULL,
  `fl_fc_id` int(11) NOT NULL,
  `fl_code` varchar(15) NOT NULL,
  `fl_total` int(11) NOT NULL,
  `fl_cost` float NOT NULL,
  `fl_city_from_id` int(11) NOT NULL,
  `fl_city_to_id` int(11) NOT NULL,
  `fl_departure_date` int(11) NOT NULL,
  `fl_return_date` int(11) NOT NULL,
  `fl_type` tinyint(11) NOT NULL,
  `fl_airline_id` int(11) NOT NULL,
  `fl_distance` int(11) NOT NULL,
  `fl_fr_id` int(11) NOT NULL,
  `fl_airport_id_from` int(11) NOT NULL,
  `fl_airport_id_to` int(11) NOT NULL,
  `fl_flight_route_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `flight_list`
--

INSERT INTO `flight_list` (`fl_id`, `fl_fc_id`, `fl_code`, `fl_total`, `fl_cost`, `fl_city_from_id`, `fl_city_to_id`, `fl_departure_date`, `fl_return_date`, `fl_type`, `fl_airline_id`, `fl_distance`, `fl_fr_id`, `fl_airport_id_from`, `fl_airport_id_to`, `fl_flight_route_id`) VALUES
(1, 1, 'CB1', 5, 0, 1, 2, 1554791216, 1554891216, 0, 2, 500, 1, 3, 1, 1),
(2, 1, 'CB2', 5, 0, 1, 2, 1552076816, 1555143115, 0, 4, 900, 1, 3, 1, 1),
(3, 1, 'CB3', 8, 0, 4, 2, 1557362503, 1557412903, 1, 1, 3600, 1, 2, 1, 1),
(4, 2, 'CB4', 8, 0, 8, 7, 1555002000, 1555081200, 1, 4, 3100, 1, 7, 6, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `flight_route`
--

CREATE TABLE `flight_route` (
  `fr_id` int(11) NOT NULL,
  `fr_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `flight_route`
--

INSERT INTO `flight_route` (`fr_id`, `fr_name`) VALUES
(1, 'Domestic Route'),
(2, 'International Route');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nation`
--

CREATE TABLE `nation` (
  `nation_id` int(11) NOT NULL,
  `nation_name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nation`
--

INSERT INTO `nation` (`nation_id`, `nation_name`) VALUES
(1, 'Japanese'),
(2, 'Việt Nam'),
(3, 'American');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transits`
--

CREATE TABLE `transits` (
  `transit_id` int(11) NOT NULL,
  `transit_city_id` int(11) NOT NULL,
  `transit_departure_date` int(11) NOT NULL,
  `transit_landing_date` int(11) NOT NULL,
  `transit_fl_id` int(11) NOT NULL,
  `transit_airport_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `transits`
--

INSERT INTO `transits` (`transit_id`, `transit_city_id`, `transit_departure_date`, `transit_landing_date`, `transit_fl_id`, `transit_airport_id`) VALUES
(1, 13, 1554777616, 1554788416, 1, 3),
(2, 5, 1554799216, 1554806416, 1, 4),
(3, 10, 1557369703, 1557376903, 3, 9),
(4, 1, 1557380503, 1557391303, 3, 3),
(5, 13, 1557394903, 1557421200, 3, 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(55) NOT NULL,
  `user_password` varchar(55) NOT NULL,
  `user_first_name` varchar(55) NOT NULL,
  `user_last_name` varchar(15) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_last_access` int(11) NOT NULL DEFAULT '0',
  `user_attempt` int(11) NOT NULL DEFAULT '0',
  `user_status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_first_name`, `user_last_name`, `user_phone`, `user_last_access`, `user_attempt`, `user_status`) VALUES
(1, 'badman@gmail.com', '11111111', 'Bắc', 'Cung Gia', '0126515156', 1552123559, 0, 0),
(2, 'badman2@gmail.com', '22222222', 'Lục ', 'Nam', '0164545654', 1551861711, 1, 0),
(3, 'badman3@gmail.com', '1515151515', 'hien', 'minh', '016516513234', 1551936684, 1, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`airline_id`);

--
-- Chỉ mục cho bảng `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`airport_id`);

--
-- Chỉ mục cho bảng `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `flight_booking`
--
ALTER TABLE `flight_booking`
  ADD PRIMARY KEY (`fb_id`);

--
-- Chỉ mục cho bảng `flight_classes`
--
ALTER TABLE `flight_classes`
  ADD PRIMARY KEY (`fc_id`);

--
-- Chỉ mục cho bảng `flight_list`
--
ALTER TABLE `flight_list`
  ADD PRIMARY KEY (`fl_id`);

--
-- Chỉ mục cho bảng `flight_route`
--
ALTER TABLE `flight_route`
  ADD PRIMARY KEY (`fr_id`);

--
-- Chỉ mục cho bảng `nation`
--
ALTER TABLE `nation`
  ADD PRIMARY KEY (`nation_id`);

--
-- Chỉ mục cho bảng `transits`
--
ALTER TABLE `transits`
  ADD PRIMARY KEY (`transit_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `airlines`
--
ALTER TABLE `airlines`
  MODIFY `airline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `airports`
--
ALTER TABLE `airports`
  MODIFY `airport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `flight_booking`
--
ALTER TABLE `flight_booking`
  MODIFY `fb_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `flight_classes`
--
ALTER TABLE `flight_classes`
  MODIFY `fc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `flight_list`
--
ALTER TABLE `flight_list`
  MODIFY `fl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `flight_route`
--
ALTER TABLE `flight_route`
  MODIFY `fr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `nation`
--
ALTER TABLE `nation`
  MODIFY `nation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `transits`
--
ALTER TABLE `transits`
  MODIFY `transit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
