-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 25, 2024 lúc 05:07 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlkh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `price`, `qty`) VALUES
('aoNGsktb0rVZLK9Wk0W4', 'Rji673LrcxLgYgRgugNK', '9', '7000000.00', '1'),
('iaEUtID3JCw9rIJllL5N', 'Rji673LrcxLgYgRgugNK', '12', '7000000.00', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`id`, `full_name`, `email`, `phone_number`, `message`, `created_at`) VALUES
(1, 'Dương Công Kiên', 'duongcongkien09082003@gmail.com', '0376679803', '1', '2024-01-25 07:42:37'),
(2, 'Dương Công Kiên', 'duongcongkien09082003@gmail.com', '0376679803', '1', '2024-01-25 07:43:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address_type` varchar(255) NOT NULL,
  `method` varchar(200) NOT NULL,
  `product_id` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `qty` varchar(200) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(8, 'Kho Xưởng Hai Bà Trưng-4mx5m', 5000000.00, '0pVONNCy9sJHBTBmK8wV.jpg'),
(9, 'Kho Xưởng Bắc Từ Liêm - 6mx6m', 7000000.00, 'L5fG1Oel7n4Y0sqaSGdr.jpg'),
(10, 'Kho Xưởng Long Biên - 5mx6m', 6000000.00, 'WAH6DWn9mlrQHYxHDg5T.jpg'),
(11, 'Kho Nam Từ Liêm - 6mx8m', 800000.00, '9Wr7GBjM1iKExPWCLMeZ.jpg'),
(12, 'Kho xưởng Cầu Giấy - 5mx7m', 7000000.00, 'bSQKLpI5IxxSjUrPMknG.jpg'),
(13, 'Kho xưởng Hồ Tây - 5mx6m', 6000000.00, '5zHA6la3ucjOpKZWaWd5.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `choose` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `choose`, `reset_token`) VALUES
(2, 'Dương Công Kiên', 'duongcongkien09082003@gmail.com', '$2y$10$uE4hmLFo7rCtneUIwlYbeOSxlX0aU7YxpjMOy2MzTBrBYK8B21yb.', 'on', NULL),
(10, 'Dương Công Kiên', 'congkiendz982003@gmail.com', '$2y$10$uVRamfIHuuL0YimxgxxYnuiKuB9X519G74rZpITp7ol0TtnipThgy', 'on', NULL),
(11, 'Linh ngu', 'linhngu@email.com', '$2y$10$R3GVcHAwsv53uOMoQ27xYOcbdxkfkYM5IyJIEPJNOadgyEZuxafI.', 'on', NULL),
(12, 'Duong', 'duong@gmail.com', '$2y$10$juD.BvXwT9ynbfqfUCMyUuFzf824qQAcujDczcVWKwsKBiODGslSu', 'on', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
