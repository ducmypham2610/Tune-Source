-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 26, 2022 lúc 05:18 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tunesource`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(10) NOT NULL,
  `song_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cart_id`, `song_id`, `user_id`) VALUES
(12, 5, 4),
(21, 5, 1),
(22, 22, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `genre`
--

INSERT INTO `genre` (`genre_id`, `name`, `description`) VALUES
(1, 'pop', 'pop music'),
(4, 'country', 'country music'),
(6, 'Electro music', ''),
(7, 'rock', ''),
(8, 'edm', 'edm'),
(9, 'Indie', 'Indie music');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `playlist`
--

CREATE TABLE `playlist` (
  `playlist_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `song_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `playlist`
--

INSERT INTO `playlist` (`playlist_id`, `user_id`, `song_id`) VALUES
(7, 1, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `singer`
--

CREATE TABLE `singer` (
  `singer_id` int(11) NOT NULL,
  `singer_name` varchar(50) NOT NULL,
  `singer_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `singer`
--

INSERT INTO `singer` (`singer_id`, `singer_name`, `singer_description`) VALUES
(4, 'Justin Bieber', ''),
(5, 'Taylor Swift', ''),
(6, 'The Weeknd', ''),
(7, 'Ariana Grande', ''),
(8, 'Imagine Dragons', ''),
(9, 'Vicetone', ''),
(13, 'Linkin Park', 'rockband'),
(14, 'Afrojack', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `song`
--

CREATE TABLE `song` (
  `song_id` int(10) NOT NULL,
  `song_name` varchar(50) NOT NULL,
  `song_price` varchar(20) NOT NULL,
  `song_img` varchar(255) NOT NULL,
  `song_lyrics` text NOT NULL,
  `song_description` varchar(255) NOT NULL,
  `song_audio` varchar(255) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `singer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `song`
--

INSERT INTO `song` (`song_id`, `song_name`, `song_price`, `song_img`, `song_lyrics`, `song_description`, `song_audio`, `genre_id`, `singer_id`) VALUES
(5, 'Last Christmas', '$5', 'lastchristmas.jpg', 'I hate that I remember\r\nI wish I could forget\r\nWhat you did last December\r\nYou left my heart a mess (a mess)\r\nBoy, you blew it\r\nHow could you do it, do it, oh, yeah, oh, yeah?\r\nLast Christmas\r\nI gave you my heart\r\nBut the very next day you gave it away\r\nThis year\r\nTo save me from tears\r\nI\'ll give it to someone special, oh, yeah, yeah.\r\nBut last Christmas\r\nI gave you my heart\r\nBut the very next day you gave it away\r\nThis year\r\nTo save me from tears\r\nI\'ll give it to someone special\r\nThought we belong together\r\nAt least that\'s what you said\r\nI should\'ve known better\r\nYou broke my heart again (again)\r\nBoy, you blew it\r\nHow could you do it, do it, oh, yeah?\r\nThe last Christmas\r\nI gave you my heart, gave you my heart\r\nBut the very next day you gave it away (gave it away)\r\nThis year\r\nTo save me from tears (you got it)\r\nI\'ll give it to someone special\r\nThe last Christmas (oh, baby)\r\nI gave you my heart\r\nBut the very next day you gave it away (gave it away)\r\nThis year (you got it)\r\nTo save me from tears\r\nI\'ll give it to someone special\r\nOoh, yeah\r\nHow could you leave Christmas morning?\r\nYou broke my heart with no warning\r\nBoy, you blew it\r\nHow could you do it, do it, oh, yeah?\r\nLast Christmas\r\nI gave you my heart (gave you my heart)\r\nBut the very next day you gave it away (you gave it away)\r\nThis year\r\nTo save me from tears (oh, baby)\r\nI\'ll give it to someone special\r\nThis is our last (last) last (last) Christmas\r\nYou broke my heart\r\nLast (last) last (last) Christmas you broke my heart\r\nThis year\r\nTo save me from tears\r\nI\'ll give it to someone special\r\nI hate that I remember\r\nI wish I could forget\r\nWhat you did last December\r\nYou left my heart a mess (you left my heart a mess)\r\n(This year, to save me from tears (oh, baby) I\'ll give it to someone special)\r\nI hate that I remember\r\nI wish I could forget\r\nWhat you did last December\r\nYou left my heart a mess (you left my heart a mess)\r\n(This year, to save me from tears (oh, baby) I\'ll give it to someone special)', '', 'song6.mp3', 1, 7),
(22, 'Mistletoe', '$5', 'img1.jpg', 'It’s the most beautiful time of the year\r\nLights fill the streets spreading so much cheer\r\nI should be playing in the winter snow\r\nBut I\'mma be under the mistletoe\r\n\r\nI don’t wanna miss out on the holiday\r\nBut I can’t stop staring at your face\r\nI should be playing in the winter snow\r\nBut I’mma be under the mistletoe\r\n\r\nWith you, shawty with you\r\nWith you, shawty with you\r\nWith you under the mistletoe\r\n\r\nEveryone\'s gathering around the fire\r\nChestnuts roasting like a hot July\r\nI should be chilling with my folks, I know\r\nBut I’mma be under the mistletoe\r\n\r\nWord on the street Santa\'s coming tonight,\r\nReindeer\'s flying through the sky so high\r\nI should be making a list, I know\r\nBut I’mma be under the mistletoe\r\n\r\nWith you, shawty with you\r\nWith you, shawty with you\r\nWith you under the mistletoe\r\n\r\nWith you, shawty with you\r\nWith you, shawty with you\r\nWith you under the mistletoe\r\n\r\nAye, love, the wise men followed the star\r\nThe way I followed my heart\r\nAnd it led me to a miracle\r\n\r\nAye, love, don\'t you buy me nothing\r\n\'cause I am feeling one thing, your lips on my lips\r\nThat’s a merry, merry Christmas\r\n\r\nIt’s the most beautiful time of the year\r\nLights fill the streets spreading so much cheer\r\nI should be playing in the winter snow\r\nBut I’mma be under the mistletoe\r\n\r\nI don’t wanna miss out on the holiday\r\nBut I can’t stop staring at your face\r\nI should be playing in the winter snow\r\nBut I’mma be under the mistletoe\r\n\r\nWith you, shawty with you\r\nWith you, shawty with you\r\nWith you under the mistletoe\r\n\r\nWith you, shawty with you\r\nWith you, shawty with you\r\nWith you, under the mistletoe, under the mistletoe\r\n\r\nKiss me underneath the mistletoe\r\nShow me baby that you love me so-oh-oh\r\nOh, oh, ohhh\r\n\r\nKiss me underneath the mistletoe,\r\nShow me baby that you love me so-oh-oh\r\nOh, oh, ohhh', '', 'song1.mp3', 1, 4),
(27, 'ABC', '$10', 'chrismartin.jpg', 'HAHAHAHA', '', 'song3.mp3', 1, 4),
(28, 'Thunder', '$5', 'thunder.jpg', 'Just a young gun with a quick fuse I was uptight, wanna let loose I was dreaming of bigger things and Wanna leave my own life behind Not a \"Yes sir\", not a follower Fit the box, fit the mold Have a seat in the foyer, take a number I was lightning before the thunder Thunder, thunder Thunder, thun-, thunder Thun-thun-thunder, thunder Thunder, thunder, thun-, thunder Thun-thun-thunder, thunder', '', 'song4.mp3', 7, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telephone` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `telephone`, `role`) VALUES
(1, 'ducmy', 'my123', 'my@gmail.com', 123456, 'admin'),
(2, 'test', '123456', '091234', 0, 'normal'),
(3, 'test1', '123456', '12345123', 0, 'normal'),
(4, 'chichi', 'chichi', '09123', 0, 'normal'),
(5, 'alo', '123', '0386862610', 0, 'normal');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cart_ibfk_1` (`song_id`);

--
-- Chỉ mục cho bảng `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Chỉ mục cho bảng `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`playlist_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Chỉ mục cho bảng `singer`
--
ALTER TABLE `singer`
  ADD PRIMARY KEY (`singer_id`);

--
-- Chỉ mục cho bảng `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `genre_id` (`genre_id`),
  ADD KEY `singer_id` (`singer_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `playlist`
--
ALTER TABLE `playlist`
  MODIFY `playlist_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `singer`
--
ALTER TABLE `singer`
  MODIFY `singer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `song`
--
ALTER TABLE `song`
  MODIFY `song_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `song` (`song_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Các ràng buộc cho bảng `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `playlist_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `song` (`song_id`);

--
-- Các ràng buộc cho bảng `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `song_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `song_ibfk_2` FOREIGN KEY (`singer_id`) REFERENCES `singer` (`singer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
