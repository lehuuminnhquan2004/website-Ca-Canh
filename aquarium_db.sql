-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th10 25, 2025 lúc 05:31 PM
-- Phiên bản máy phục vụ: 9.1.0
-- Phiên bản PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `aquarium_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `summary` text,
  `content` longtext,
  `thumbnail` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `slug`, `summary`, `content`, `thumbnail`, `url`, `created_at`) VALUES
(1, 'xin chào đây là demo blog', 'xin-chao-day-la-demo-blog', 'aaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaassssssssssss', '1763911230_BannerMaker_28072023_165244.png', '', '2025-11-16 17:30:23'),
(2, 'Các loại thuốc phổ biến và công dụng', 'cac-loai-thuoc-pho-bien-va-cong-dung', 'Các loại thuốc phổ biến và công dụng', 'Đặc trị nấm và vi khuẩn:\r\nAPI Pimafix: Đặc trị các bệnh nấm như nấm ăn vảy, nấm ăn thân, nấm mang, thối đuôi.\r\nAPI Melafix: Chữa trị các bệnh nhiễm khuẩn, thối vây, lở loét.\r\nBlue Sky 999: Trị nấm cho các loại cá cảnh.\r\nTrị ký sinh trùng:\r\nCKcs - Top Top: Chuyên trị các loại ký sinh trùng cho cá.\r\nThuốc tím (Kali Permanganat): Hiệu quả trong việc điều trị ký sinh trùng như trùng mỏ neo, rận cá.\r\nKhử độc, giảm stress và hỗ trợ:\r\nAPI Stress Coat: Giúp cá giảm stress, phục hồi lớp nhớt bảo vệ và khử độc nước.\r\nSeachem Stressguard: Giúp dưỡng cá, giảm stress, khử độc nước và hỗ trợ trị bệnh.\r\nTetra Nhật: Dùng để điều trị các bệnh nấm và ký sinh trùng. \r\nLưu ý khi sử dụng\r\nĐọc kỹ hướng dẫn: Luôn đọc kỹ hướng dẫn sử dụng và liều lượng trên bao bì để đảm bảo an toàn.\r\nKhông cho ăn: Trong quá trình trị bệnh, hạn chế hoặc không cho cá ăn để thuốc phát huy hiệu quả tốt nhất và tránh cá ăn phải thức ăn chưa tiêu hóa hết.\r\nĐiều chỉnh nhiệt độ và oxy: Kết hợp với việc sưởi ấm và sục oxy đầy đủ để giúp cá nhanh hồi phục hơn.', '1763911222_BannerMaker_02082023_172514.png', '', '2025-11-16 17:47:37'),
(3, 'Chữa bệnh thối thân ở cá', 'chua-benh-thoi-than-o-ca', 'Để trị bệnh thối thân ở cá, bạn cần cách ly cá bệnh, điều trị bằng các loại thuốc đặc trị như Bio Knock 3 hoặc Melafix theo đúng liều lượng. Đồng thời, cần thay nước hàng ngày, cung cấp oxy và đảm bảo vệ sinh môi trường sống của cá. Với cà chua, bạn cần tỉa bỏ lá bị bệnh, vệ sinh dụng cụ, luân canh cây trồng và sử dụng thuốc trừ bệnh phù hợp. ', 'Chữa bệnh thối thân ở cá\r\nCách ly cá: Bắt riêng cá bị bệnh ra một hồ/bể khác để điều trị.\r\nSử dụng thuốc:\r\nBio Knock 3: Sử dụng 1 giọt cho 10 lít nước và ngâm cá trong đó. Cần thay 30-50% lượng nước trong hồ hàng ngày trong quá trình điều trị.\r\nMelafix: Dùng thuốc theo hướng dẫn của nhà sản xuất, thường liên tục mỗi ngày trong 7 ngày. Trước mỗi lần đánh thuốc, nên thay 25% lượng nước trong bể.\r\nCác loại thuốc khác: Có thể sử dụng các loại thuốc hóa chất thủy sản, thuốc sinh học hoặc kháng sinh phổ rộng nếu nghi ngờ cá bị nhiễm vi khuẩn kết hợp với nấm.\r\nChăm sóc cá:\r\nLuôn cung cấp đủ oxy cho cá.\r\nCho cá ăn đầy đủ để chúng có đủ dinh dưỡng khi điều trị.\r\nLoại bỏ vật liệu lọc carbon nếu có trong bể khi sử dụng thuốc. \r\nPhòng và trị bệnh thối thân ở cà chua\r\nBiện pháp phòng bệnh:\r\nTrồng giống kháng bệnh, chịu hạn.\r\nLuân canh cây trồng với các loại cây không phải ký chủ trong ít nhất ba năm.\r\nGiữ vệ sinh sạch sẽ vườn, dụng cụ và loại bỏ hết tàn dư cây trồng sau vụ mùa.\r\nTỉa bớt các lá dưới gốc để tránh chạm đất.\r\nTưới nước vào buổi sáng và tránh tưới phun từ trên cao.\r\nBiện pháp xử lý khi bệnh xuất hiện:\r\nLoại bỏ ngay: Phát hiện và loại bỏ ngay những cây bị bệnh.\r\nSử dụng thuốc: Phun thuốc trừ bệnh như Phy Fusaco theo đúng hướng dẫn của nhà sản xuất để trị bệnh, với liều lượng phù hợp và phun định kỳ.\r\nXử lý đất: Phơi ải đất hoặc lên kế hoạch cày sâu vào mùa hè để giảm mầm bệnh trong đất. ', '1763290604_36b52fa8-e71b-4435-888a-cecb98d3876a.jpg', NULL, '2025-11-16 17:53:56'),
(4, 'dvcvxc vx vx vv', 'dvcvxc-vx-vx-vv', 'cvxv', 'cxv', '1763831166_ChatGPT Image 18_12_53 9 thg 6, 2025.png', 'https://www.youtube.com/live/c7ipnoaedJA?si=LCwOelpAw3KJ7twA', '2025-11-23 00:06:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(191) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`) VALUES
(8, 'Phụ kiện hồ cá', 'phu-kien-ho-ca'),
(9, 'Hồ cá – Chân hồ – Bể đúc', 'ho-ca-chan-ho'),
(7, 'Đèn hồ cá – UV – LED', 'den-ho-ca'),
(6, 'Lọc nước & Vật liệu lọc', 'loc-nuoc-vat-lieu'),
(5, 'Máy oxy – Sủi – Tạo luồng', 'may-oxi-sui-tao-luong'),
(4, 'Thuốc & khoáng cho hồ cá', 'thuoc-khoang'),
(3, 'Thức ăn cho cá – tép', 'thuc-an-ca-canh'),
(10, 'Trang trí hồ cá', 'trang-tri-ho'),
(11, 'Nền – Cát – Sỏi', 'nen-cat-soi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `fishs`
--

DROP TABLE IF EXISTS `fishs`;
CREATE TABLE IF NOT EXISTS `fishs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `price` int DEFAULT '0',
  `thumbnail` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `fishs`
--

INSERT INTO `fishs` (`id`, `category_id`, `name`, `slug`, `price`, `thumbnail`, `description`, `created_at`, `status`) VALUES
(1, 1, 'Cá rồng huyết long', 'ca-rong-huyet-long', 300000, './images/uploads/1764008672_6924a2e006f63.jpg', '', '2025-11-24 11:41:12', 0),
(2, 2, 'Cá chép sư tử', 'ca-chep-su-tu', 350000, './images/uploads/1764008575_6924a27fc7645.webp', '', '2025-11-24 18:22:55', 1),
(3, 3, 'Cá chuột mỹ', 'ca-chuot-my', 70000, './images/uploads/1764088376_6925da3890cf5.jpg', '', '2025-11-25 16:32:56', 0),
(4, 3, 'Cá chuột cà phê', 'ca-chuot-ca-phe', 15000, './images/uploads/1764091168_6925e520a7097.webp', '', '2025-11-25 17:19:28', 1),
(5, 3, 'Cá Chuột Panda', 'ca-chuot-panda', 25000, './images/uploads/1764091276_6925e58c7945a.jpg', '', '2025-11-25 17:21:16', 1),
(6, 2, 'Cá Chép Phi Tần Đỏ', 'ca-chep-phi-tan-do', 350000, './images/uploads/1764091322_6925e5baa45d8.jpg', '', '2025-11-25 17:22:02', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `fish_categories`
--

DROP TABLE IF EXISTS `fish_categories`;
CREATE TABLE IF NOT EXISTS `fish_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(191) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `fish_categories`
--

INSERT INTO `fish_categories` (`id`, `name`, `slug`) VALUES
(1, 'Cá rồng', 'ca-rong'),
(2, 'chép sư tử', 'chep-su-tu'),
(3, 'Cá tầng đáy', 'ca-tang-day');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `price` int DEFAULT '0',
  `thumbnail` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=477 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `price`, `thumbnail`, `description`, `created_at`, `status`) VALUES
(455, 7, 'Đèn XML 80 trắng', 'en-xml-80-trang', 365000, './images/uploads/1763887078_6922c7e65887c.png', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 0),
(454, 7, 'Đèn XML 80 đỏ', 'den-xml-80-do', 365000, './images/uploads/1763887331_6922c8e323530.png', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(453, 7, 'Đèn XML 60 vàng', 'en-xml-60-vang', 285000, './images/uploads/1763983559_692440c77de40.png', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(452, 7, 'Đèn XML 60 trắng', 'en-xml-60-trang', 285000, './images/uploads/1763887474_6922c9725ca0c.png', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(451, 7, 'Đèn XML 60 đỏ', 'en-xml-60-o', 285000, './images/uploads/1763887479_6922c977be24f.png', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(450, 7, 'Đèn XML 150 vàng', 'en-xml-150-vang', 595000, './images/uploads/1763983544_692440b8ab2f0.png', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(449, 7, 'Đèn XML 150 trắng', 'en-xml-150-trang', 595000, './images/uploads/1763983578_692440da1e39a.png', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(448, 7, 'Đèn XML 150 đỏ', 'en-xml-150-o', 595000, './images/uploads/1763983584_692440e07876a.png', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(447, 7, 'Đèn XML 120 vàng', 'en-xml-120-vang', 540000, './images/uploads/1763983597_692440eddb5b5.png', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(446, 7, 'Đèn XML 120 trắng', 'en-xml-120-trang', 540000, './images/uploads/1763983610_692440fa12dd9.png', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(445, 7, 'Đèn XML 120 đỏ', 'en-xml-120-o', 540000, './images/uploads/1763983620_6924410456af1.png', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(444, 7, 'Đèn XML 100 vàng', 'en-xml-100-vang', 460000, './images/uploads/1763983626_6924410a0beed.png', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(443, 7, 'Đèn XML 100 trắng', 'en-xml-100-trang', 460000, './images/uploads/1763983631_6924410f58e3d.png', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(442, 7, 'Đèn XML 100 đỏ', 'en-xml-100-o', 460000, './images/uploads/1763983643_6924411b9fcdb.png', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(441, 7, 'Đèn UV Baoyu 9w - hẹn giờ', 'en-uv-baoyu-9w-hen-gio', 220000, './images/uploads/1763887648_6922ca2060e6b.webp', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(440, 7, 'Đèn UV Baoyu 7w - hẹn giờ', 'en-uv-baoyu-7w-hen-gio', 210000, './images/uploads/1763887681_6922ca413b766.webp', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(439, 7, 'Đèn UV Baoyu 5w - hẹn giờ', 'en-uv-baoyu-5w-hen-gio', 200000, './images/uploads/1763887687_6922ca47d0257.webp', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(438, 7, 'Đèn UV 7w jeneca', 'en-uv-7w-jeneca', 130000, './images/uploads/1763887845_6922cae522d57.png', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(437, 7, 'Đèn UV 5w jeneca', 'en-uv-5w-jeneca', 120000, './images/uploads/1763887851_6922caeb33cf1.png', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(436, 7, 'Đèn UV 11w jeneca', 'en-uv-11w-jeneca', 130000, './images/uploads/1763887856_6922caf09414c.png', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(435, 7, 'Đèn rồng KaoKui 80 vàng', 'en-rong-kaokui-80-vang', 510000, './images/uploads/1763887932_6922cb3cb61e9.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(434, 7, 'Đèn rồng KaoKui 80 đỏ', 'en-rong-kaokui-80-o', 510000, './images/uploads/1763888032_6922cba09ffe9.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(433, 7, 'Đèn rồng KaoKui 180cm vàng', 'en-rong-kaokui-180cm-vang', 900000, './images/uploads/1763888053_6922cbb52b412.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(432, 7, 'Đèn rồng KaoKui 180cm đỏ', 'en-rong-kaokui-180cm-o', 900000, './images/uploads/1763888087_6922cbd701f9b.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(431, 7, 'Đèn rồng KaoKui 150cm vàng', 'en-rong-kaokui-150cm-vang', 700000, './images/uploads/1763888098_6922cbe246e64.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(430, 7, 'Đèn rồng KaoKui 150cm đỏ', 'en-rong-kaokui-150cm-o', 700000, './images/uploads/1763888106_6922cbea127c2.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(429, 7, 'Đèn rồng KaoKui 120cm vàng', 'en-rong-kaokui-120cm-vang', 600000, './images/uploads/1763888114_6922cbf2bdf1f.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(428, 7, 'Đèn rồng KaoKui 120cm đỏ', 'en-rong-kaokui-120cm-o', 600000, './images/uploads/1763888161_6922cc21a4d27.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(427, 7, 'Đèn rồng KaoKui 100cm vàng', 'en-rong-kaokui-100cm-vang', 540000, './images/uploads/1763888170_6922cc2ac84ed.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(426, 7, 'Đèn rồng KaoKui 100 đỏ', 'en-rong-kaokui-100-o', 540000, './images/uploads/1763888184_6922cc382dbfd.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(425, 7, 'Đèn rọi KAOKUI F06 18W', 'en-roi-kaokui-f06-18w', 275000, './images/uploads/1763888201_6922cc499af86.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(424, 7, 'Đèn rọi KaoKui F03 10W', 'en-roi-kaokui-f03-10w', 130000, './images/uploads/1763888218_6922cc5a6b65e.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(423, 7, 'Đèn rẻ 53cm ĐM', 'en-re-53cm-m', 105000, './images/uploads/1763888326_6922ccc64de2a.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(422, 7, 'Đèn rẻ 43cm vàng', 'en-re-43cm-vang', 80000, './images/uploads/1763888336_6922ccd0d2a15.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(421, 7, 'Đèn rẻ 43cm trắng', 'en-re-43cm-trang', 80000, './images/uploads/1763888360_6922cce8993b0.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(420, 7, 'Đèn rẻ 43cm ĐM', 'en-re-43cm-m', 90000, './images/uploads/1763888373_6922ccf51aee3.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(419, 7, 'Đèn rẻ 33cm vàng', 'en-re-33cm-vang', 75000, './images/uploads/1763888382_6922ccfe230c6.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(418, 7, 'Đèn rẻ 33cm trắng', 'en-re-33cm-trang', 75000, './images/uploads/1763888406_6922cd169eb7d.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(417, 7, 'Đèn rẻ 23cm vàng', 'en-re-23cm-vang', 65000, './images/uploads/1763888414_6922cd1eb622e.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(416, 7, 'Đèn rẻ 23cm trắng', 'en-re-23cm-trang', 65000, './images/uploads/1763888421_6922cd25a9b4f.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(415, 7, 'Đèn Neo Helios XP12000', 'en-neo-helios-xp12000', 730000, './images/uploads/1763887042_6922c7c2f0528.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(414, 7, 'Đèn Neo Helios  XP900', 'en-neo-helios-xp900', 550000, './images/uploads/1763886990_6922c78e81e7e.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(413, 7, 'Đèn Neo Helios  XP800', 'en-neo-helios-xp800', 510000, './images/uploads/1763887024_6922c7b0d98ca.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(412, 7, 'Đèn Neo Helios  XP600', 'en-neo-helios-xp600', 380000, './images/uploads/1763887030_6922c7b62849e.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(411, 7, 'Đèn Neo Helios  XP450', 'en-neo-helios-xp450', 330000, './images/uploads/1763887036_6922c7bc4f67a.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(410, 7, 'Đèn NaNo S3 Pro 13w', 'en-nano-s3-pro-13w', 160000, './images/uploads/1763886898_6922c732ca202.webp', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(409, 7, 'Đèn Nano S3 Plus 13w', 'en-nano-s3-plus-13w', 135000, './images/uploads/1763888472_6922cd5859902.webp', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(408, 7, 'Đèn Led kẹp JENECA SC 80 TX', 'en-led-kep-jeneca-sc-80-tx', 160000, './images/uploads/1763983693_6924414d04ef7.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(407, 7, 'Đèn Led kẹp JENECA SC 80 đổi màu', 'en-led-kep-jeneca-sc-80-oi-mau', 170000, './images/uploads/1763983708_6924415cc60bb.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(406, 7, 'Đèn Led kẹp Jeneca SC 60 TX', 'den-led-kep-jeneca-sc-60-tx', 145000, './images/uploads/1763888659_6922ce1333d43.jpg', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(405, 7, 'Đèn Led kẹp JENECA SC 60 đm', 'en-led-kep-jeneca-sc-60-m', 150000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(404, 7, 'Đèn Led kẹp JENECA SC 50 Đm', 'en-led-kep-jeneca-sc-50-m', 130000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(403, 7, 'Đèn led kẹp Jeneca SC 40 TX', 'en-led-kep-jeneca-sc-40-tx', 115000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(402, 7, 'Đèn Led kẹp JENECA SC 40 Đm', 'en-led-kep-jeneca-sc-40-m', 120000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(401, 7, 'Đèn Led kẹp JENECA SC 30 Đm', 'en-led-kep-jeneca-sc-30-m', 110000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(400, 7, 'Đèn Led kẹp JENECA SC 20 Đm', 'en-led-kep-jeneca-sc-20-m', 100000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(399, 7, 'Đèn Led kẹp JENECA SC 100 TX', 'en-led-kep-jeneca-sc-100-tx', 195000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(398, 7, 'Đèn Led kẹp JENECA SC 100 Đm', 'en-led-kep-jeneca-sc-100-m', 205000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(397, 7, 'Đèn Led Jeneca D16', 'en-led-jeneca-d16', 115000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(396, 7, 'Đèn Kẹp Jeneca D9s', 'en-kep-jeneca-d9s', 105000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(395, 7, 'Đèn KaoKui KKx2', 'en-kaokui-kkx2', 115000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(394, 7, 'Đèn KaoKui KK JY 25 đổi màu', 'en-kaokui-kk-jy-25-oi-mau', 90000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(393, 7, 'Đèn JENECA SC 580', 'en-jeneca-sc-580', 150000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(392, 7, 'Đèn JENECA SC 480', 'en-jeneca-sc-480', 145000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(391, 7, 'Đèn JENECA SC 380', 'en-jeneca-sc-380', 130000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(390, 7, 'Đèn JENECA SC 280', 'en-jeneca-sc-280', 110000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(389, 7, 'Đèn huyết Mayin 60cm', 'en-huyet-mayin-60cm', 650000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(388, 7, 'Đèn huyết Mayin 1m2', 'en-huyet-mayin-1m2', 860000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(387, 7, 'Đèn huyết Mayin 1m', 'en-huyet-mayin-1m', 820000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(386, 7, 'Đèn BAOYU hồng 60cm', 'en-baoyu-hong-60cm', 270000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(385, 8, 'Decal đáy ô vuông dài 10x60 cm', 'decal-ay-o-vuong-dai-10x60-cm', 18000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(384, 9, 'Decal dán hồ 60x50', 'decal-dan-ho-60x50', 75000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(383, 9, 'Decal dán hồ 50x35', 'decal-dan-ho-50x35', 45000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(382, 9, 'Decal dán hồ 40x35', 'decal-dan-ho-40x35', 35000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(381, 9, 'Decal dán hồ 30x20', 'decal-dan-ho-30x20', 25000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(380, 7, 'Dây trong suốt phi 10', 'day-trong-suot-phi-10', 10000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(379, 8, 'Dây ruột gà ngắn 80cm', 'day-ruot-ga-ngan-80cm', 10000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(378, 8, 'Dây ruột gà dài 1m', 'day-ruot-ga-dai-1m', 10000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(377, 5, 'Dây oxi 4 ly', 'day-oxi-4-ly', 2000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(376, 5, 'Cốc sủi oxi thủy tinh 35cm', 'coc-sui-oxi-thuy-tinh-35cm', 67000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(375, 5, 'Cốc sủi oxi thủy tinh 25cm', 'coc-sui-oxi-thuy-tinh-25cm', 58000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(374, 5, 'Cốc sủi oxi inox', 'coc-sui-oxi-inox', 145000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(373, 8, 'Chậu nhựa thủy sinh', 'chau-nhua-thuy-sinh', 30000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(372, 9, 'Cây mút lau hồ trung', 'cay-mut-lau-ho-trung', 25000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(371, 8, 'Cạo rêu kính Chenls', 'cao-reu-kinh-chenls', 130000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(370, 8, 'Bộ vệ sinh 2in1 Baoyu', 'bo-ve-sinh-2in1-baoyu', 120000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(369, 8, 'Bộ vệ sinh 5in1 BaoYu 90cm', 'bo-ve-sinh-5in1-baoyu-90cm', 220000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(368, 8, 'Bộ máy vệ sinh 6in1 Baoyu', 'bo-may-ve-sinh-6in1-baoyu', 330000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(367, 5, 'Kệ 2 ( Máy Oxi, Lọc Bio, Bộ vệ sinh, Đèn,…)', 'ke-2-may-oxi-loc-bio-bo-ve-sinh-en', 0, '', 'Phụ kiện lọc nước cho hồ cá cảnh, hỗ trợ loại bỏ cặn bẩn và tạp chất, giúp nước trong, ổn định môi trường sống cho cá và vi sinh có lợi.', '2025-11-23 08:01:43', 1),
(366, 8, 'Zero Shock 125ml', 'zero-shock-125ml', 80000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(365, 7, 'Vòng cho cá ăn', 'vong-cho-ca-an', 22000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(364, 5, 'Viên sủi CO2', 'vien-sui-co2', 65000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(363, 4, 'Vi sinh tiêu hóa BAC+ 30ML', 'vi-sinh-tieu-hoa-bac-30ml', 40000, '', 'Chế phẩm vi sinh hỗ trợ xử lý chất thải, giảm mùi hôi và ổn định hệ vi sinh trong hồ cá, giúp cá khỏe mạnh và hạn chế bệnh.', '2025-11-23 08:01:43', 1),
(362, 4, 'Vi sinh tích hợp OBIO  30ml', 'vi-sinh-tich-hop-obio-30ml', 44000, '', 'Chế phẩm vi sinh hỗ trợ xử lý chất thải, giảm mùi hôi và ổn định hệ vi sinh trong hồ cá, giúp cá khỏe mạnh và hạn chế bệnh.', '2025-11-23 08:01:43', 1),
(361, 4, 'Vi sinh Seachem Stability 500ml', 'vi-sinh-seachem-stability-500ml', 495000, './images/uploads/1764091484_6925e65c75209.webp', 'Chế phẩm vi sinh hỗ trợ xử lý chất thải, giảm mùi hôi và ổn định hệ vi sinh trong hồ cá, giúp cá khỏe mạnh và hạn chế bệnh.', '2025-11-23 08:01:43', 1),
(360, 4, 'Vi sinh Seachem Stability 200ml', 'vi-sinh-seachem-stability-200ml', 265000, '', 'Chế phẩm vi sinh hỗ trợ xử lý chất thải, giảm mùi hôi và ổn định hệ vi sinh trong hồ cá, giúp cá khỏe mạnh và hạn chế bệnh.', '2025-11-23 08:01:43', 1),
(359, 4, 'Vi sinh Seachem Stability 100ml', 'vi-sinh-seachem-stability-100ml', 160000, '', 'Chế phẩm vi sinh hỗ trợ xử lý chất thải, giảm mùi hôi và ổn định hệ vi sinh trong hồ cá, giúp cá khỏe mạnh và hạn chế bệnh.', '2025-11-23 08:01:43', 1),
(358, 4, 'Vi sinh prime Seachem 250ml', 'vi-sinh-prime-seachem-250ml', 265000, '', 'Chế phẩm vi sinh hỗ trợ xử lý chất thải, giảm mùi hôi và ổn định hệ vi sinh trong hồ cá, giúp cá khỏe mạnh và hạn chế bệnh.', '2025-11-23 08:01:43', 1),
(357, 4, 'Vi sinh phân hủy Pristine 100ml', 'vi-sinh-phan-huy-pristine-100ml', 160000, '', 'Chế phẩm vi sinh hỗ trợ xử lý chất thải, giảm mùi hôi và ổn định hệ vi sinh trong hồ cá, giúp cá khỏe mạnh và hạn chế bệnh.', '2025-11-23 08:01:43', 1),
(356, 4, 'Vi sinh JinDi - làm lắng cặn', 'vi-sinh-jindi-lam-lang-can', 12000, '', 'Chế phẩm vi sinh hỗ trợ xử lý chất thải, giảm mùi hôi và ổn định hệ vi sinh trong hồ cá, giúp cá khỏe mạnh và hạn chế bệnh.', '2025-11-23 08:01:43', 1),
(355, 4, 'Vi sinh Extra Bio 500ml', 'vi-sinh-extra-bio-500ml', 155000, './images/uploads/1764091521_6925e6818b4dc.webp', 'Chế phẩm vi sinh hỗ trợ xử lý chất thải, giảm mùi hôi và ổn định hệ vi sinh trong hồ cá, giúp cá khỏe mạnh và hạn chế bệnh.', '2025-11-23 08:01:43', 1),
(354, 4, 'Vi sinh Extra Bio 250ml', 'vi-sinh-extra-bio-250ml', 85000, '', 'Chế phẩm vi sinh hỗ trợ xử lý chất thải, giảm mùi hôi và ổn định hệ vi sinh trong hồ cá, giúp cá khỏe mạnh và hạn chế bệnh.', '2025-11-23 08:01:43', 1),
(353, 4, 'Vi sinh Extra Bio 125ml', 'vi-sinh-extra-bio-125ml', 50000, '', 'Chế phẩm vi sinh hỗ trợ xử lý chất thải, giảm mùi hôi và ổn định hệ vi sinh trong hồ cá, giúp cá khỏe mạnh và hạn chế bệnh.', '2025-11-23 08:01:43', 1),
(352, 4, 'Vi sinh Extra Bio 1000ml', 'vi-sinh-extra-bio-1000ml', 270000, '', 'Chế phẩm vi sinh hỗ trợ xử lý chất thải, giảm mùi hôi và ổn định hệ vi sinh trong hồ cá, giúp cá khỏe mạnh và hạn chế bệnh.', '2025-11-23 08:01:43', 1),
(351, 4, 'Vi sinh CLEAR 30ML', 'vi-sinh-clear-30ml', 50000, '', 'Chế phẩm vi sinh hỗ trợ xử lý chất thải, giảm mùi hôi và ổn định hệ vi sinh trong hồ cá, giúp cá khỏe mạnh và hạn chế bệnh.', '2025-11-23 08:01:43', 1),
(350, 4, 'Vi sinh Aquarium Care', 'vi-sinh-aquarium-care', 70000, '', 'Chế phẩm vi sinh hỗ trợ xử lý chất thải, giảm mùi hôi và ổn định hệ vi sinh trong hồ cá, giúp cá khỏe mạnh và hạn chế bệnh.', '2025-11-23 08:01:43', 1),
(349, 9, 'Vách ngăn hồ 30x30', 'vach-ngan-ho-30x30', 25000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(348, 9, 'Vách ngăn hồ 30x15', 'vach-ngan-ho-30x15', 15000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(347, 8, 'Túi đựng Purigen', 'tui-ung-purigen', 10000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(346, 7, 'Thuốc tím cho cá 50G', 'thuoc-tim-cho-ca-50g', 30000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(345, 7, 'Thuốc tím cho cá 20G', 'thuoc-tim-cho-ca-20g', 15000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(344, 7, 'Thuốc tím cho cá 100G', 'thuoc-tim-cho-ca-100g', 50000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(343, 4, 'Thuốc Tetra NHật loại 2', 'thuoc-tetra-nhat-loai-2', 25000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(342, 4, 'Thuốc Tetra NHật loại 1', 'thuoc-tetra-nhat-loai-1', 45000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(341, 4, 'Thuốc Super one', 'thuoc-super-one', 30000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(340, 4, 'Thuốc Stress coat 237ml', 'thuoc-stress-coat-237ml', 280000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(339, 4, 'Thuốc Stress coat 118ml', 'thuoc-stress-coat-118ml', 180000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(338, 4, 'Thuốc Pimafix 118ml', 'thuoc-pimafix-118ml', 190000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(337, 4, 'Thuốc Melafix 118ml', 'thuoc-melafix-118ml', 200000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(336, 4, 'Thuốc Knock 4', 'thuoc-knock-4', 30000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(335, 4, 'Thuốc Knock 3', 'thuoc-knock-3', 30000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(334, 4, 'Thuốc Knock 2', 'thuoc-knock-2', 30000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(333, 4, 'Thuốc knock 1', 'thuoc-knock-1', 30000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(332, 4, 'Thuốc kháng sinh tép 1 viên', 'thuoc-khang-sinh-tep-1-vien', 10000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(331, 4, 'Thuốc Diệt rêu tảo hại', 'thuoc-diet-reu-tao-hai', 40000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(330, 4, 'Thuốc diệt ký sinh trùng Naphar', 'thuoc-diet-ky-sinh-trung-naphar', 0, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(329, 4, 'Thuốc Diệt Khuẩn Sweep', 'thuoc-diet-khuan-sweep', 45000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(328, 4, 'Thuốc Blue sky 9999 10ml', 'thuoc-blue-sky-9999-10ml', 50000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(327, 4, 'Thuốc Blue Sky 999 5ml', 'thuoc-blue-sky-999-5ml', 30000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(326, 4, 'Thuốc Blue Sky 999 10ml', 'thuoc-blue-sky-999-10ml', 46000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(325, 4, 'Thuốc Blue Sky 999 100ml', 'thuoc-blue-sky-999-100ml', 150000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(324, 4, 'Thuốc aqua bạc', 'thuoc-aqua-bac', 185000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(323, 4, 'Thuốc Anti tress', 'thuoc-anti-tress', 40000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(322, 8, 'Than hoạt tính', 'than-hoat-tinh', 20000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(321, 8, 'Tẩy cặn canxi 60ml', 'tay-can-canxi-60ml', 70000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(320, 8, 'Tẩy cặn canxi 100ml', 'tay-can-canxi-100ml', 145000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(319, 8, 'Tảo viên', 'tao-vien', 45000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(318, 8, 'Tảo bột', 'tao-bot', 25000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(317, 5, 'Sủi TQ', 'sui-tq', 3000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(316, 5, 'Sủi mịn', 'sui-min', 5000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(315, 4, 'Ống hút thuốc 5ml', 'ong-hut-thuoc-5ml', 3000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(314, 4, 'Ống hút thuốc 3ml', 'ong-hut-thuoc-3ml', 2000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(313, 4, 'Ống hút thuốc 10ml', 'ong-hut-thuoc-10ml', 4000, '', 'Sản phẩm hỗ trợ phòng và trị một số bệnh thường gặp ở cá cảnh, giúp cá nhanh hồi phục, nên sử dụng đúng liều lượng theo hướng dẫn.', '2025-11-23 08:01:43', 1),
(312, 8, 'Ống đỏ phi25 1m', 'ong-o-phi25-1m', 60000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(311, 8, 'Ống đỏ phi20 1m', 'ong-o-phi20-1m', 45000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(310, 7, 'Máy cho cá ăn SunSun', 'may-cho-ca-an-sunsun', 200000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(309, 7, 'Máy cho cá ăn Jeneca Feed', 'may-cho-ca-an-jeneca-feed', 185000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(308, 7, 'KoiKA BAC+ 30ML', 'koika-bac-30ml', 40000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(307, 8, 'Kiểm tra PH', 'kiem-tra-ph', 32000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(306, 8, 'Kiểm tra NH3,NH4', 'kiem-tra-nh3-nh4', 80000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(305, 8, 'Kiểm tra độ mặn', 'kiem-tra-o-man', 110000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(304, 8, 'Kiểm tra CO2', 'kiem-tra-co2', 160000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(303, 4, 'Khử Clo ShangHai', 'khu-clo-shanghai', 15000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(302, 4, 'Khử clo Prime Seachem 250ml', 'khu-clo-prime-seachem-250ml', 265000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(301, 4, 'Khử clo Prime Seachem 100ml', 'khu-clo-prime-seachem-100ml', 160000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(300, 7, 'Khoáng tép, cá Nutrafin', 'khoang-tep-ca-nutrafin', 80000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(299, 4, 'Khoáng tép GH+', 'khoang-tep-gh', 80000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(298, 8, 'khóa vàng thẳng', 'khoa-vang-thang', 3000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(297, 8, 'Khóa vàng chia 3', 'khoa-vang-chia-3', 3000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(296, 8, 'khóa đen thẳng', 'khoa-en-thang', 3000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(295, 8, 'Khóa đen cam', 'khoa-en-cam', 4000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(294, 8, 'Khay trùng chỉ meca', 'khay-trung-chi-meca', 25000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(293, 7, 'Khay cho cá ăn Jeneca F35', 'khay-cho-ca-an-jeneca-f35', 75000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(292, 8, 'Kẹp góc sinicon', 'kep-goc-sinicon', 25000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(291, 9, 'Kẹp giữ nắp hồ', 'kep-giu-nap-ho', 35000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(290, 8, 'Keo dán rêu', 'keo-dan-reu', 12000, '', 'Keo dán, vật tư hỗ trợ dán, lắp ráp và trang trí hồ cá cảnh, bám dính tốt và an toàn khi sử dụng đúng hướng dẫn.', '2025-11-23 08:01:43', 1),
(289, 4, 'Hút đáy ngăn tép phi 16 thường', 'hut-ay-ngan-tep-phi-16-thuong', 45000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(288, 4, 'Hút đáy ngăn tép phi 16 sịn', 'hut-ay-ngan-tep-phi-16-sin', 70000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(287, 4, 'Hút đáy ngăn tép phi 12 thường', 'hut-ay-ngan-tep-phi-12-thuong', 40000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(286, 4, 'Hút đáy ngăn tép phi 12 sịn', 'hut-ay-ngan-tep-phi-12-sin', 65000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(285, 8, 'Hủ Purigen Crystal', 'hu-purigen-crystal', 80000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(284, 5, 'Hít dây oxi xịn', 'hit-day-oxi-xin', 4000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(283, 7, 'Hít dây bơm - đèn xịn', 'hit-day-bom-en-xin', 6000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(282, 7, 'Hít dây bơm - đèn thường', 'hit-day-bom-en-thuong', 3000, '', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(281, 8, 'Gói trị đường ruột Relive', 'goi-tri-uong-ruot-relive', 30000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(280, 8, 'Gía thể', 'gia-the', 15000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(279, 8, 'Đế lót đáy', 'e-lot-ay', 50000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(278, 11, 'Cốt nền Aquabase', 'cot-nen-aquabase', 130000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(277, 8, 'Co phi 16', 'co-phi-16', 4000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(276, 5, 'Chia 4 oxi', 'chia-4-oxi', 1000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(275, 5, 'Chia 3 oxi mica', 'chia-3-oxi-mica', 3000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(274, 5, 'Chia 3 oxi', 'chia-3-oxi', 1000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(273, 5, 'Chia 2 oxi', 'chia-2-oxi', 1000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(272, 4, 'Cám tôm tép K Ghost', 'cam-tom-tep-k-ghost', 70000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(271, 3, 'Cám Thái G8', 'cam-thai-g8', 30000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(270, 3, 'Cám Thái G12', 'cam-thai-g12', 30000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(269, 3, 'Cám Thái 5/8', 'cam-thai-5-8', 25000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(268, 3, 'Cám Thái 3/5', 'cam-thai-3-5', 28000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(267, 4, 'Cám tép cảnh TM', 'cam-tep-canh-tm', 35000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(266, 4, 'cám tép cảnh Q3 50g', 'cam-tep-canh-q3-50g', 200000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(265, 4, 'Cám tép cảnh Q3 15g', 'cam-tep-canh-q3-15g', 70000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(264, 3, 'Cám ShangHai hủ 50g', 'cam-shanghai-hu-50g', 10000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(263, 3, 'Cám ShangHai hủ 170g', 'cam-shanghai-hu-170g', 20000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(262, 3, 'Cám Sanko 500g hạt trung', 'cam-sanko-500g-hat-trung', 48000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(261, 3, 'Cám Sanko 500g hạt lớn', 'cam-sanko-500g-hat-lon', 48000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(260, 3, 'Cám SANKO 5/8', 'cam-sanko-5-8', 20000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(259, 7, 'Cám La Hán thiết xanh', 'cam-la-han-thiet-xanh', 150000, '', 'Cám chuyên dùng cho cá La Hán, giúp cá khỏe mạnh, lên màu đẹp, hạt dễ ăn và hạn chế làm đục nước, phù hợp cho hồ cá cảnh gia đình và cửa hàng.', '2025-11-23 08:01:43', 1),
(258, 7, 'Cám La Hán thiết đen', 'cam-la-han-thiet-en', 150000, '', 'Cám chuyên dùng cho cá La Hán, giúp cá khỏe mạnh, lên màu đẹp, hạt dễ ăn và hạn chế làm đục nước, phù hợp cho hồ cá cảnh gia đình và cửa hàng.', '2025-11-23 08:01:43', 1),
(257, 7, 'Cám KOI FOOD tăng trọng 1kg S', 'cam-koi-food-tang-trong-1kg-s', 160000, '', 'Cám chuyên dùng cho cá koi, giúp cá khỏe mạnh, lên màu đẹp, hạt dễ ăn và hạn chế làm đục nước, phù hợp cho hồ cá cảnh gia đình và cửa hàng.', '2025-11-23 08:01:43', 1),
(256, 7, 'Cám KOI FOOD tăng trọng 1kg M', 'cam-koi-food-tang-trong-1kg-m', 160000, '', 'Cám chuyên dùng cho cá koi, giúp cá khỏe mạnh, lên màu đẹp, hạt dễ ăn và hạn chế làm đục nước, phù hợp cho hồ cá cảnh gia đình và cửa hàng.', '2025-11-23 08:01:43', 1),
(255, 7, 'Cám KOI FOOD tăng màu 1kg S', 'cam-koi-food-tang-mau-1kg-s', 205000, '', 'Cám chuyên dùng cho cá koi, giúp cá khỏe mạnh, lên màu đẹp, hạt dễ ăn và hạn chế làm đục nước, phù hợp cho hồ cá cảnh gia đình và cửa hàng.', '2025-11-23 08:01:43', 1),
(254, 7, 'Cám KOI FOOD lên màu 1kg M', 'cam-koi-food-len-mau-1kg-m', 205000, '', 'Cám chuyên dùng cho cá koi, giúp cá khỏe mạnh, lên màu đẹp, hạt dễ ăn và hạn chế làm đục nước, phù hợp cho hồ cá cảnh gia đình và cửa hàng.', '2025-11-23 08:01:43', 1),
(253, 3, 'Cám Gold Tokyo 500g hạt trung', 'cam-gold-tokyo-500g-hat-trung', 70000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(252, 3, 'Cám Gold Tokyo 500g hạt lớn', 'cam-gold-tokyo-500g-hat-lon', 70000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(251, 3, 'Cám gói vàng', 'cam-goi-vang', 8000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(250, 3, 'Cám dán Biozym Trùng huyết', 'cam-dan-biozym-trung-huyet', 130000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(249, 3, 'Cám chép sư tử 500G hạt nhỏ', 'cam-chep-su-tu-500g-hat-nho', 125000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(248, 3, 'Cám chép sư tử 500G hạt lớn', 'cam-chep-su-tu-500g-hat-lon', 125000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(247, 7, 'Cám cá chuột Loại 1', 'cam-ca-chuot-loai-1', 70000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(246, 3, 'Cám Artermia sấy khô 50g', 'cam-artermia-say-kho-50g', 30000, '', 'Thức ăn tổng hợp cho nhiều loại cá cảnh, giúp cá phát triển khỏe mạnh, lên màu tự nhiên, hạt dễ ăn và ít làm bẩn nước hồ.', '2025-11-23 08:01:43', 1),
(245, 6, 'Bông lọc thác Jeneca', 'bong-loc-thac-jeneca', 35000, '', 'Phụ kiện lọc nước cho hồ cá cảnh, hỗ trợ loại bỏ cặn bẩn và tạp chất, giúp nước trong, ổn định môi trường sống cho cá và vi sinh có lợi.', '2025-11-23 08:01:43', 1),
(244, 8, 'BỘ Van điện Mufan', 'bo-van-ien-mufan', 550000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(243, 8, 'Bộ van cơ Mufan', 'bo-van-co-mufan', 0, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1);
INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `price`, `thumbnail`, `description`, `created_at`, `status`) VALUES
(456, 7, 'Đèn XML 80 vàng', 'en-xml-80-vang', 365000, './images/uploads/1763983444_69244054447d0.png', 'Đèn chiếu sáng cho hồ cá cảnh, giúp tôn màu cá và cây thủy sinh, đồng thời tạo điểm nhấn nổi bật cho bể trong không gian sống.', '2025-11-23 08:01:43', 1),
(457, 4, 'Hẹn giờ cơ xanh', 'hen-gio-co-xanh', 120000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(458, 6, 'Lọc Bio JENECA AF 3', 'loc-bio-jeneca-af-3', 45000, '', 'Phụ kiện lọc nước cho hồ cá cảnh, hỗ trợ loại bỏ cặn bẩn và tạp chất, giúp nước trong, ổn định môi trường sống cho cá và vi sinh có lợi.', '2025-11-23 08:01:43', 1),
(459, 6, 'Lọc Bio QS 200A', 'loc-bio-qs-200a', 135000, '', 'Phụ kiện lọc nước cho hồ cá cảnh, hỗ trợ loại bỏ cặn bẩn và tạp chất, giúp nước trong, ổn định môi trường sống cho cá và vi sinh có lợi.', '2025-11-23 08:01:43', 1),
(460, 6, 'Lọc Bio XY 180', 'loc-bio-xy-180', 30000, '', 'Phụ kiện lọc nước cho hồ cá cảnh, hỗ trợ loại bỏ cặn bẩn và tạp chất, giúp nước trong, ổn định môi trường sống cho cá và vi sinh có lợi.', '2025-11-23 08:01:43', 1),
(461, 6, 'Lọc Bio XY 2833', 'loc-bio-xy-2833', 26000, '', 'Phụ kiện lọc nước cho hồ cá cảnh, hỗ trợ loại bỏ cặn bẩn và tạp chất, giúp nước trong, ổn định môi trường sống cho cá và vi sinh có lợi.', '2025-11-23 08:01:43', 1),
(462, 6, 'Lọc Bio XY 2880', 'loc-bio-xy-2880', 80000, '', 'Phụ kiện lọc nước cho hồ cá cảnh, hỗ trợ loại bỏ cặn bẩn và tạp chất, giúp nước trong, ổn định môi trường sống cho cá và vi sinh có lợi.', '2025-11-23 08:01:43', 1),
(463, 6, 'Lọc Bio XY 2882', 'loc-bio-xy-2882', 110000, '', 'Phụ kiện lọc nước cho hồ cá cảnh, hỗ trợ loại bỏ cặn bẩn và tạp chất, giúp nước trong, ổn định môi trường sống cho cá và vi sinh có lợi.', '2025-11-23 08:01:43', 1),
(464, 6, 'Lọc Bio XY 2901', 'loc-bio-xy-2901', 130000, '', 'Phụ kiện lọc nước cho hồ cá cảnh, hỗ trợ loại bỏ cặn bẩn và tạp chất, giúp nước trong, ổn định môi trường sống cho cá và vi sinh có lợi.', '2025-11-23 08:01:43', 1),
(465, 6, 'Lọc Bio XY 2902', 'loc-bio-xy-2902', 145000, '', 'Phụ kiện lọc nước cho hồ cá cảnh, hỗ trợ loại bỏ cặn bẩn và tạp chất, giúp nước trong, ổn định môi trường sống cho cá và vi sinh có lợi.', '2025-11-23 08:01:43', 1),
(466, 8, 'Máy làm mát KK 332', 'may-lam-mat-kk-332', 150000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(467, 9, 'Nam châm chùi bể Aquarium', 'nam-cham-chui-be-aquarium', 95000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(468, 9, 'Nam châm chùi bể Aquawings 6 - 10mm', 'nam-cham-chui-be-aquawings-6-10mm', 110000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(469, 9, 'Nam châm chùi bể SoBo <6mm', 'nam-cham-chui-be-sobo-6mm', 57000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(470, 9, 'Nam châm chùi bể SoBo 10-16mm', 'nam-cham-chui-be-sobo-10-16mm', 140000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(471, 9, 'Nam châm chùi bể SoBo 6mm > 10mm', 'nam-cham-chui-be-sobo-6mm-10mm', 100000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(472, 8, 'Nhiệt kế điện tử', 'nhiet-ke-ien-tu', 75000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(473, 8, 'Nhiệt kế gián kính', 'nhiet-ke-gian-kinh', 15000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(474, 8, 'Nhiệt kế thủy ngân', 'nhiet-ke-thuy-ngan', 15000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(475, 8, 'Nhíp 27 cong', 'nhip-27-cong', 80000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1),
(476, 8, 'Nhíp 27 thẳng', 'nhip-27-thang', 65000, '', 'Phụ kiện hồ cá cảnh hỗ trợ chăm sóc và trang trí bể, giúp hệ thống vận hành ổn định và tăng tính thẩm mỹ cho không gian sống.', '2025-11-23 08:01:43', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
