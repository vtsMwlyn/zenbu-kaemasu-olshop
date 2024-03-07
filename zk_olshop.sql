-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2024 at 10:58 AM
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
-- Database: `zk_olshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `buyer_id`, `product_id`, `created_at`, `updated_at`) VALUES
(23, 3, 61, '2024-03-06 02:12:54', '2024-03-06 02:12:54'),
(77, 5, 48, '2024-03-06 23:59:42', '2024-03-06 23:59:42'),
(79, 5, 57, '2024-03-07 00:20:18', '2024-03-07 00:20:18'),
(80, 4, 54, '2024-03-07 00:20:47', '2024-03-07 00:20:47'),
(81, 4, 55, '2024-03-07 00:20:51', '2024-03-07 00:20:51'),
(82, 4, 64, '2024-03-07 00:21:16', '2024-03-07 00:21:16'),
(83, 4, 58, '2024-03-07 00:23:02', '2024-03-07 00:23:02');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Fashion', 'fashion', '2024-03-05 02:13:01', '2024-03-05 02:13:01'),
(2, 'Electronics', 'electronics', '2024-03-05 02:13:01', '2024-03-05 02:13:01'),
(3, 'Tools', 'tools', '2024-03-05 02:13:01', '2024-03-05 02:13:01'),
(4, 'Healthcares', 'healthcares', '2024-03-05 02:13:01', '2024-03-05 02:13:01'),
(5, 'Food and beverages', 'food-and-beverages', '2024-03-05 02:13:01', '2024-03-05 02:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_02_29_000000_create_roles_table', 1),
(3, '2024_02_29_000001_create_users_table', 1),
(4, '2024_02_29_000002_create_user_details_table', 1),
(5, '2024_02_29_000003_create_products_table', 1),
(6, '2024_02_29_000004_create_categories_table', 1),
(7, '2024_02_29_000005_create_product_categories_table', 1),
(8, '2024_02_29_000006_create_wishlists_table', 1),
(9, '2024_02_29_000007_create_carts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `desc` longtext NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL,
  `price` bigint(20) UNSIGNED NOT NULL,
  `prodimg_path` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `seller_id`, `product_name`, `desc`, `stock`, `price`, `prodimg_path`, `slug`, `created_at`, `updated_at`) VALUES
(45, 1, 'Tas backpack', '<div>Ini tas cuyyy beli dong!!<br>Udah murah dijamin kualitas bagus, ga bikin minus.<br><br>Varian warna:</div><ol><li>Biru</li><li>Merah</li><li>Hijau</li><li>Hitam</li><li>Putih</li></ol>', 50, 625000, 'post-images/ftyb1wjqksGFNhYLMg66MZv1xyNHJIZKrgx26CMX.jpg', 'slug-1709708639558', '2024-03-05 20:32:29', '2024-03-06 00:03:59'),
(47, 1, 'Sepatu', '<div>Ini sepatu sekolah, ya... mau dipake buat pergi pergi juga bisa.<br>Populer di kalangan anak muda, bahan bagus, dijamin awett<br>Rugi dong kalo ga beli <em>uhahaha *kodoque lompat<br><br></em><strong>Available sizes:<br></strong>30, 32, 34, 36, 38, 40, 42, 44<br><br><strong>Available colors:</strong></div><ol><li>Hitam putih</li><li>Coklat putih</li><li>Full putih</li></ol><div>Melayani COD, kredit, debit, gopay, shopeepay, dll.</div>', 50, 525000, 'post-images/LmD2N6VNbBQb0Myve9fRO48q5WRqbIPneZOcyajU.png', 'slug-1709708752004', '2024-03-05 20:37:59', '2024-03-06 00:05:52'),
(48, 1, 'TWS Earphone Bluetooth', '<div><em>Males pake earphone kabel? Ini dia solusinya<br><br></em>Dilengkapi dengan powerbank, kalo ga pake tinggal cas.<br>Mau pake tinggal cabut terus konek bluetooth, tinggal setel lagu.<br>Pokoknya simple, easy to use, and praktis lah.<br><br>Bluetooth 5.0 wireless<br><br>Mana harganya juga murah cuma Rp 60 ribuan aja loh!<br>Ayo buru cepetan beli, ada garansi mungkin sih tapi gatau juga deng.</div>', 35, 65000, 'post-images/57xdZudA7RpRoTT2YZ6Iql63L6yEB52UTRHCiivv.jpg', 'tws-earphone-bluetooth-1709717499271', '2024-03-05 20:39:16', '2024-03-06 02:31:39'),
(49, 1, 'BLACK T-SHIRT HIGH QUALITY', '<div>Buat kamu yang suka berpakaian serba hitam sangat cocok loh.<br>Bahan dia punya bagus confirm punya, lu olang pasti rugi kalo talak ada beli lho.<br>Ayo buruan borong, stok terbatas cum a 69 ayyo sus.<br><br>Ukuran tersedia: S, M, L, XL, XXL<br>Varian warna: Hitam, hitam-putih, hitam-kuning</div>', 69, 125000, 'post-images/ZodI6zKl4J8Y1hxhhjbgIQm7P3iEG4iijU4FS4WS.jpg', 'slug-1709708845578', '2024-03-05 20:40:24', '2024-03-06 00:07:25'),
(50, 1, 'A SUS pipobuk', '<div><strong>BRAND NEW LAPTOP ASUS Vivobook<br></strong>Kondisi: baru<br>Manufakturer: Asus<br>Model: ASUS Vivobook<strong><br><br></strong>Spesifikasi<br>-------------<br>Processor i5-7250U (2 core processors, 2.4GHz)<br>SSD 256 GB<br>Storage HDD 1 TB<br>RAM 8 GB onboard<br>Intel graphics ultra HD<br>OS Windows 11 + Microsoft Office for home and students (ready activation)<br><br>Bonus<br>--------</div><ol><li>Tas laptop</li><li>Mouse + mouse pad</li></ol><div>Selalu baca deskripsi dengan baik dan benar sebelum membeli!!</div>', 25, 4580000, 'post-images/JX8GYxpfhD0rSxCrsUyofNP2p0KvknpdWiWlq2si.png', 'slug-1709709009258', '2024-03-05 20:49:35', '2024-03-06 00:10:09'),
(53, 2, 'Tang LAN', '<div>Tang LAN ni boss, bisa buat potong kabel, kelupas kabel, sama patenin kabel LAN kamu nich<br>Kalo kamu teknisi jaringan sih must have ya Buru beli nanti menyesal lho</div>', 25, 125000, 'post-images/oKzV40IihQwqLKbFzW2YUcF7lqz2CrhFUJv6qKgZ.jpg', 'slug-1709708051863', '2024-03-05 20:57:46', '2024-03-05 23:54:11'),
(54, 2, 'Donat 1 pack', '<ul><li>1 pack isi 8 donat</li><li>Worth it lah daripada beli beli lagi di tempat jual donat</li><li>Donat freshly baked, ga disimpen lebih dari 1 hari</li></ul>', 69, 40000, 'post-images/SnD5Ocnuw55y2O3zVUWHIrLm2XS0SUsvB4xHk6NT.webp', 'slug-1709708239361', '2024-03-05 20:59:36', '2024-03-05 23:57:19'),
(55, 2, 'Kue Onde-Onde', '<div>Kue yang kenyal, di dalam manis varian coklat sama susu. 1 pak isi 12 pcs.<br><br></div><blockquote><em>Enak sih, sayang kalo ga dibeli.</em></blockquote>', 60, 24000, 'post-images/Tw2RV52JAUSiRYOR78ZNCbPz19HoxxcvKEWAdqKW.jpg', 'slug-1709708266609', '2024-03-05 21:01:19', '2024-03-05 23:57:46'),
(57, 2, 'Scrum Lulur Tradional Herborist', '<div><strong>Scrum Lulur Tradional Herborist<br></strong><em>Cocok untuk:</em></div><ol><li>Mandi</li><li>Pengganti sabun</li><li>Perawatan kulit</li></ol><div><em>Benefit:</em><br>- Mengandung green tea extract and whitening<br>- Asli bali tradisional</div>', 40, 60000, 'post-images/N7KXcm4SUSy0vTwPCL8uaIi2vpom1KSbzU0AylXA.jpg', 'slug-1709708328213', '2024-03-05 21:27:37', '2024-03-05 23:58:48'),
(58, 2, 'Stand HP', '<div>Stand HP bisa buat naro HP pas lagi beraktivitas atau makan.<br>Bisa diatur ketinggian dan kemiringannya.<br>Barang awet dan terjamin kualitasnya.</div>', 69, 57500, 'post-images/kxZwhLmZUoTFKTs3vd3czoA26unuseMrRibHuzEv.jpg', 'slug-1709708352365', '2024-03-05 21:29:08', '2024-03-05 23:59:12'),
(59, 2, 'HP Poco M5s Android Smartphone', '<div><strong>POCO M5s</strong><br>-------------<br>Spesifikasi:</div><ul><li>Processor MediaTek hHelio G95</li><li>64MP Quad Camera</li><li>Manufacturer OPPO</li><li>Memori 128GB/6GB (<em>bisa extend up to 6 GB dari memori utama</em>)</li><li>Baterai dengan kapasitas 5000mAh</li></ul><div>HP cocok untuk gaming, streaming, dll. Package included charger kabel type C dan layar antigores<br>100% original dengan 12 bulan garansi<br>Pengiriman cepat dan aman, pembayaran bisa nyicil<br>Varian warna tersedia: Hitam, silver, putih</div>', 30, 2600000, 'post-images/6FnfjXJcB4TzJTGDoL2AI73h4ShkrJu2XY8CygMR.jpg', 'slug-1709708470600', '2024-03-05 21:31:55', '2024-03-06 00:01:10'),
(60, 2, 'PAKET KOSMETIK ALL IN ONE', '<div>Package sudah included:</div><ul><li>Kuas</li><li>Mini cermin</li><li>Busa</li><li>Lipstic</li><li>Make up</li></ul>', 50, 1680000, 'post-images/KveFgInH6GFRU1Bk3uCIitSEvrPy8YvllHsEoZvA.jpg', 'slug-1709708537823', '2024-03-05 21:33:06', '2024-03-06 00:02:17'),
(61, 2, 'Acne Cream NEW', '<div>Dengan formulasi terbaru dari <em>acnes sealing jell</em> dengan <em>active and soothing ingredients</em><br>Membantu melawan bakteri penyebab jerawat dan mengecilkan volume jerawat! <br><br>Bisa bekerja dengan baik di 90% berbagai macam kulit, pemakaian beberapa hari dijamin mengurangi jerawat.<br><strong>Produk 100% original</strong>, bisa COD</div>', 69, 83000, 'post-images/0DVWaiT37H7EjOxABErlXBm2CYZIzREwkuV4WgEd.jpg', 'slug-1709708570060', '2024-03-05 21:34:40', '2024-03-06 00:02:50'),
(62, 1, 'Kunci Inggris SIZE LARGE', '<div>TEKIRO ADJUSTABLE WRENCH PC 10EU TYPE<br><br>&gt; Solusi praktis untuk kebutuhan pertukangan di rumah tangga<br>&gt; Cocok untuk berbagai size baut<br>&gt; Harga jauh lebih murah dibandingkan toko/seller lain!!</div>', 70, 232500, 'post-images/8iVGxdapHx4bre65Mui54Ysq8NfNFAEBtQNvJ5Nd.webp', 'slug', '2024-03-05 21:37:03', '2024-03-06 00:10:54'),
(63, 1, 'Charger HP type C', '<div><em>SAMSUNG charger type C</em><br><br>120V/50W USB port 3.2 cocok untuk HP port type C<br>Model varian color black<br><br>Garansi 1 tahun<br>Produk resmi 100% ori riil no fake fake.</div>', 69, 96000, 'post-images/m9GeaYTQOuRzMCjrcg9QeKgAtL49WrQFJ7a3jQfj.webp', 'slug-1709709077054', '2024-03-05 21:38:57', '2024-03-06 00:11:17'),
(64, 1, 'Mochi', '<div>Kue mochi ukuran besar, 1 pack isi 6 beda varian warna dan rasa.<br>Pengemasan dilakukan dengan baik agar makanan sampai di tangan konsumen dalam keadaan baik dan masih nikmat untuk disantap.<br>Produk impor dari Jepang, tanpa pengawet dan pewarna sintetis.<br>Varian rasa bisa request, dm admin.</div>', 45, 75000, 'post-images/gC3psdi3bE6XJZ5TnPcC8YWgRXK2sMLeVZ38ZXB8.jpg', 'slug-1709709105958', '2024-03-05 21:40:56', '2024-03-06 00:11:45'),
(66, 1, 'Tas Lengan (Purse)', '<div>Ini adalah produk keluaran terbaru<br>100% ori, kualitas bahan terjamin, awet<br><br><em>Varian warna:</em></div><ol><li>Hitam</li><li>Abu</li><li>Putih</li></ol><div><br></div>', 40, 625000, 'post-images/rPPb93VWulBrvKmgqemEO2yoYSkQ5G3aC1rtvCOm.jpg', 'tas-lengan-(purse)', '2024-03-06 02:32:37', '2024-03-06 02:32:37'),
(67, 1, 'Pemanjangan Kabel', '<div><strong>Stop Contact Cable Extender</strong><br><br>Spesifikasi</div><ul><li>Stop Kontak Arde 4 Lubang Uticon</li><li>Steker Arde Broco</li><li>Kabel NYHY 2 x 0,75 Eterna 10 Meter</li></ul>', 20, 35000, 'post-images/ZJrFnvUaWwx9L01povniBLbXRmNI2wnS9jMjRa92.jpg', 'pemanjangan-kabel', '2024-03-06 02:57:44', '2024-03-06 02:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(45, 45, 1, '2024-03-05 20:32:29', '2024-03-06 00:03:59'),
(47, 47, 1, '2024-03-05 20:37:59', '2024-03-06 00:05:52'),
(48, 48, 2, '2024-03-05 20:39:16', '2024-03-06 02:31:39'),
(49, 49, 1, '2024-03-05 20:40:24', '2024-03-06 00:07:25'),
(50, 50, 2, '2024-03-05 20:49:35', '2024-03-06 00:10:09'),
(53, 53, 3, '2024-03-05 20:57:46', '2024-03-05 23:54:11'),
(54, 54, 5, '2024-03-05 20:59:36', '2024-03-05 23:57:19'),
(55, 55, 5, '2024-03-05 21:01:19', '2024-03-05 23:57:46'),
(57, 57, 4, '2024-03-05 21:27:37', '2024-03-05 23:58:48'),
(58, 58, 2, '2024-03-05 21:29:08', '2024-03-05 23:59:12'),
(59, 59, 2, '2024-03-05 21:31:55', '2024-03-06 00:01:10'),
(60, 60, 4, '2024-03-05 21:33:06', '2024-03-06 00:02:17'),
(61, 61, 4, '2024-03-05 21:34:40', '2024-03-06 00:02:50'),
(62, 62, 3, '2024-03-05 21:37:03', '2024-03-06 00:10:54'),
(63, 63, 2, '2024-03-05 21:38:57', '2024-03-06 00:11:17'),
(64, 64, 5, '2024-03-05 21:40:56', '2024-03-06 00:11:45'),
(66, 66, 1, '2024-03-06 02:32:37', '2024-03-06 02:32:37'),
(67, 67, 2, '2024-03-06 02:57:44', '2024-03-06 02:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'Buyer', '2024-03-05 02:13:01', '2024-03-05 02:13:01'),
(2, 'Seller', '2024-03-05 02:13:01', '2024-03-05 02:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 2, 'kirifujinagisa@email.com', '$2y$10$15tM/oqFpd3K0KArC.jf5uVO3OV.zxEGgNEr/OdWE6up1naxnhs1G', '2024-03-05 02:13:01', '2024-03-05 02:13:01'),
(2, 2, 'misonomika@email.com', '$2y$10$sr4s6kB7krvMEQWvIvirROlSy3OYsCS9fPk005bsw94EuuTcCdv62', '2024-03-05 02:13:01', '2024-03-05 02:13:01'),
(3, 1, 'yurizonoseia@email.com', '$2y$10$MbjWb4vu.Snj9eaC/P5HLOhwDCZTymDhoB7JEUq6mkvWMBr4oEmW.', '2024-03-05 02:13:01', '2024-03-05 02:13:01'),
(4, 1, 'shimoekoharu@email.com', '$2y$10$ZyJJK.T5w4K/RJBRAcRB4u6PnV8swOm3vzGzihukk0RaKJ7htdSaa', '2024-03-06 02:06:59', '2024-03-06 02:06:59'),
(5, 1, 'urawahanako@email.com', '$2y$10$lAGDJ4AatiiaxJgdSjuXNu2jlb5CIy388lr4ITX2U9eNFqYJz3hFK', '2024-03-06 02:24:35', '2024-03-06 02:24:35'),
(6, 1, 'ajitanihifumi@email.com', '$2y$10$K9f3nnfI1HBabcp9pbGAwORcsXZ2JjctZzNXbpgHBu9duHUBKmWCK', '2024-03-06 02:30:02', '2024-03-06 02:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `real_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `profpic_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `username`, `real_name`, `dob`, `address`, `phone`, `profpic_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'kirifujinagisa', 'Kirifuji Nagisa', '2000-02-22', 'Trinity General Academy', '08xxxxxxxxxx', 'post-images/oeM8Qnhpjv5M2V4jtk7X7LLnlFbxDylu0b9BUl6Q.png', '2024-03-05 02:13:01', '2024-03-07 02:51:07'),
(2, 2, 'misonomika', 'Misono Mika', '2000-01-24', 'Trinity General Academy', '08xxxxxxxxxx', 'post-images/QxGCoyb7bJgOPBC9FLktZRB3GDpr4mwpTDBFRx7y.png', '2024-03-05 02:13:01', '2024-03-07 02:45:04'),
(3, 3, 'yurizonoseia', 'Yurizono Seia', '2000-01-01', 'Trinity General Academy', '08xxxxxxxxxx', 'post-images/kHCq9rM0cv62a2lhuavSw28pLLbWBUkNFztbxeTL.png', '2024-03-05 02:13:01', '2024-03-07 02:53:30'),
(4, 4, 'shimoe-koharu', 'Shimoe Koharu', '2000-04-16', 'Trinity General Academy', '08xxxxxxxxxx', 'post-images/FQvnjhu1RuioNhQKxkDAQUUklefLkZrmxzQ4ON3Q.jpg', '2024-03-06 02:06:59', '2024-03-07 02:55:00'),
(5, 5, 'urawa-hanako', 'Urawa Hanako', '2000-01-03', 'Trinity General Academy', '08xxxxxxxxxx', 'post-images/Gev3ATo3Gug36DQJSvKNEDOsimmAJC9ip1Kj3Zdb.png', '2024-03-06 02:24:35', '2024-03-07 02:56:05'),
(6, 6, 'ajitani-hifumi', 'Ajitani Hifumi', '2000-11-27', 'Trinity General Academy', '08xxxxxxxxxx', 'post-images/loCB4fG66Vk5BtzPnsiO3c0Kmf12QP78jKaGuvrB.png', '2024-03-06 02:30:03', '2024-03-07 02:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `buyer_id`, `product_id`, `created_at`, `updated_at`) VALUES
(20, 1, 59, '2024-03-06 01:13:02', '2024-03-06 01:13:02'),
(24, 1, 58, '2024-03-06 02:02:27', '2024-03-06 02:02:27'),
(29, 3, 57, '2024-03-06 02:11:43', '2024-03-06 02:11:43'),
(36, 6, 58, '2024-03-06 02:30:31', '2024-03-06 02:30:31'),
(37, 6, 48, '2024-03-06 02:30:38', '2024-03-06 02:30:38'),
(43, 4, 57, '2024-03-06 20:28:16', '2024-03-06 20:28:16'),
(49, 4, 45, '2024-03-06 20:34:30', '2024-03-06 20:34:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_buyer_id_foreign` (`buyer_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_category_name_unique` (`category_name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_seller_id_foreign` (`seller_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_categories_product_id_foreign` (`product_id`),
  ADD KEY `product_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_details_username_unique` (`username`),
  ADD KEY `user_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_buyer_id_foreign` (`buyer_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `product_categories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
