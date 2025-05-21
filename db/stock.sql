-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2025 at 03:04 PM
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
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `total_due` decimal(12,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `mobile`, `total_due`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Diku International', 'Mirpur', '01956888836', 75.00, '2025-05-14 12:03:20', '2025-05-19 12:24:51', NULL),
(2, 'Milon Hossain', 'Mirpur', '01736699819', 0.00, '2025-05-15 12:10:48', '2025-05-19 11:26:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_date` date NOT NULL,
  `total_amount` decimal(12,2) NOT NULL,
  `paid_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `due_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `customer_id`, `invoice_date`, `total_amount`, `paid_amount`, `due_amount`, `notes`, `created_at`, `updated_at`) VALUES
(6, 2, '2025-05-19', 13500.00, 13500.00, 0.00, NULL, '2025-05-19 11:22:28', '2025-05-19 11:26:07'),
(7, 1, '2025-05-19', 1700.00, 1625.00, 75.00, NULL, '2025-05-19 12:21:57', '2025-05-19 12:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `product_id`, `quantity`, `unit_price`, `total_price`, `created_at`, `updated_at`) VALUES
(12, 6, 2, 3, 1700.00, 5100.00, '2025-05-19 11:22:28', '2025-05-19 11:22:28'),
(13, 6, 3, 2, 4200.00, 8400.00, '2025-05-19 11:22:28', '2025-05-19 11:22:28'),
(14, 7, 2, 1, 1700.00, 1700.00, '2025-05-19 12:21:57', '2025-05-19 12:21:57');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_01_000000_create_products_table', 2),
(6, '2023_01_01_000001_create_customers_table', 2),
(7, '2023_01_01_000002_create_invoices_table', 2),
(8, '2023_01_01_000003_create_invoice_items_table', 2),
(9, '2023_01_01_000004_create_payments_table', 2),
(10, '2025_05_21_074713_create_packsizes_table', 3),
(11, '2025_05_21_074725_create_vendors_table', 3),
(12, '2025_05_21_074733_create_types_table', 3),
(13, '2025_05_21_074742_create_stock_table', 3),
(14, '2025_05_21_074742_create_stocks_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `packsizes`
--

CREATE TABLE `packsizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packsizes`
--

INSERT INTO `packsizes` (`id`, `name`, `size`, `unit`, `created_at`, `updated_at`) VALUES
(1, '30KG', '30KG', '12', '2025-05-21 04:17:10', '2025-05-21 04:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `customer_id`, `invoice_id`, `amount`, `payment_date`, `payment_method`, `notes`, `created_at`, `updated_at`) VALUES
(8, 2, 6, 13000.00, '2025-05-19', 'Cash', NULL, '2025-05-19 11:23:10', '2025-05-19 11:23:10'),
(9, 2, 6, 500.00, '2025-05-19', 'Cash', NULL, '2025-05-19 11:26:07', '2025-05-19 11:26:07'),
(10, 1, 7, 1525.00, '2025-05-19', 'Cash', NULL, '2025-05-19 12:24:07', '2025-05-19 12:24:07'),
(11, 1, 7, 100.00, '2025-05-19', 'Cash', NULL, '2025-05-19 12:24:50', '2025-05-19 12:24:50');

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `pack_size` varchar(255) NOT NULL,
  `buying_price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `pack_size`, `buying_price`, `selling_price`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Omera', '12KG', 1245.00, 2000.00, 6, '2025-05-14 11:55:59', '2025-05-15 12:06:33', '2025-05-15 12:06:33'),
(2, 'Petormax', '12KG(Cylinder + Gas)', 1600.00, 1700.00, 34, '2025-05-15 12:06:27', '2025-05-20 11:23:07', NULL),
(3, 'Petormax', '35KG(Cylinder + Gas)', 4000.00, 4200.00, 16, '2025-05-15 12:07:18', '2025-05-20 11:22:58', NULL),
(4, 'Fresh', '12KG(Cylinder + Gas)', 1600.00, 1700.00, 19, '2025-05-15 12:07:58', '2025-05-20 11:22:48', NULL),
(5, 'Fresh', '35KG(Cylinder + Gas)', 4000.00, 4200.00, 20, '2025-05-15 12:08:24', '2025-05-20 11:22:35', NULL),
(6, 'Omera', '12KG(Cylinder + Gas)', 1600.00, 1700.00, 29, '2025-05-15 12:08:55', '2025-05-20 11:22:27', NULL),
(7, 'Omera', '35KG(Cylinder + Gas)', 4000.00, 4200.00, 39, '2025-05-15 12:09:14', '2025-05-20 11:22:20', NULL),
(8, 'Green', '12KG(Cylinder + Gas)', 1600.00, 1700.00, 39, '2025-05-15 12:09:36', '2025-05-20 11:22:10', NULL),
(9, 'Green', '35KG (Cylinder + Gas)', 4000.00, 4200.00, 49, '2025-05-15 12:10:02', '2025-05-20 11:21:54', NULL),
(10, 'asdad', '12KG', 1212.00, 122.00, 121, '2025-05-19 11:28:41', '2025-05-19 12:03:28', '2025-05-19 12:03:28'),
(11, 'hfghfh', '35KG', 113.00, 1313.00, 13, '2025-05-19 11:29:08', '2025-05-19 12:03:24', '2025-05-19 12:03:24'),
(12, 'hjhj', '12KG', 1212.00, 212.00, 12, '2025-05-19 11:29:22', '2025-05-19 12:03:13', '2025-05-19 12:03:13'),
(13, 'Green', '45KG(Cylinder + Gas)', 5366.00, 5555.00, 54, '2025-05-20 11:27:32', '2025-05-20 11:27:32', NULL),
(14, 'Omera', '45KG(Cylinder + Gas)', 5366.00, 5555.00, 54, '2025-05-20 11:28:14', '2025-05-20 11:28:14', NULL),
(15, 'Petormax', '45KG(Cylinder + Gas)', 5366.00, 5555.00, 50, '2025-05-20 11:29:09', '2025-05-20 11:29:09', NULL),
(16, 'Fresh', '45KG(Cylinder + Gas)', 5366.00, 5555.00, 50, '2025-05-20 11:29:54', '2025-05-20 11:29:54', NULL),
(17, 'Omera', '12KG(Cylinder)', 1500.00, 1600.00, 63, '2025-05-20 12:16:14', '2025-05-20 12:16:14', NULL),
(18, 'Omera', '35KG(Cylinder)', 1623.00, 1763.00, 32, '2025-05-20 12:16:57', '2025-05-20 12:16:57', NULL),
(19, 'Omera', '45KG(Cylinder)', 1623.00, 1832.00, 53, '2025-05-20 12:17:42', '2025-05-20 12:17:42', NULL),
(20, 'Petormax', '12KG(Cylinder)', 1623.00, 1823.00, 63, '2025-05-20 12:18:19', '2025-05-20 12:18:19', NULL),
(21, 'Petormax', '45KG(Cylinder)', 1623.00, 1833.00, 63, '2025-05-20 12:18:51', '2025-05-20 12:18:51', NULL),
(22, 'Petormax', '35KG(Cylinder)', 1653.00, 1823.00, 23, '2025-05-20 12:19:24', '2025-05-20 12:19:24', NULL),
(23, 'Fresh', '12KG(Cylinder)', 1623.00, 1823.00, 63, '2025-05-20 12:20:03', '2025-05-20 12:20:03', NULL),
(24, 'Fresh', '35KG(Cylinder)', 1623.00, 1823.00, 63, '2025-05-20 12:20:43', '2025-05-20 12:20:43', NULL),
(25, 'Fresh', '45KG(Cylinder)', 1623.00, 1823.00, 53, '2025-05-20 12:21:35', '2025-05-20 12:21:52', NULL),
(26, 'Green', '12KG(Cylinder )', 1623.00, 1823.00, 53, '2025-05-20 12:22:39', '2025-05-20 12:22:39', NULL),
(27, 'Green', '35KG(Cylinder)', 1623.00, 1823.00, 53, '2025-05-20 12:23:07', '2025-05-20 12:23:07', NULL),
(28, 'Green', '45KG(Cylinder)', 1623.00, 1823.00, 63, '2025-05-20 12:23:36', '2025-05-20 12:23:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `packsizes_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `vendor_id`, `type_id`, `product_id`, `packsizes_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 1, 50, 200.00, '2025-05-21 06:46:45', '2025-05-21 06:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Gas', 'tt', '2025-05-21 06:46:25', '2025-05-21 06:46:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Taibur', 'milon@gmail.com', NULL, '$2y$12$Kyc/5jDSlD5fG6bvEGqCn.MbWtkJwCRP28jd.SNx2bL2sCbDrc.yC', NULL, '2025-05-14 07:47:02', '2025-05-14 07:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `contact_person`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'sdgsd', 'sdg', 'sdg@gmail.com', 'dgsg', 'dgsg', '2025-05-21 06:45:52', '2025-05-21 06:45:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_items_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packsizes`
--
ALTER TABLE `packsizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_customer_id_foreign` (`customer_id`),
  ADD KEY `payments_invoice_id_foreign` (`invoice_id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stock_unique` (`vendor_id`,`type_id`,`product_id`,`packsizes_id`),
  ADD KEY `stocks_type_id_foreign` (`type_id`),
  ADD KEY `stocks_product_id_foreign` (`product_id`),
  ADD KEY `stocks_packsizes_id_foreign` (`packsizes_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `packsizes`
--
ALTER TABLE `packsizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoice_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_packsizes_id_foreign` FOREIGN KEY (`packsizes_id`) REFERENCES `packsizes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
