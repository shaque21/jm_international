-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2025 at 09:15 PM
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
-- Database: `jm_international`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(14) NOT NULL,
  `shop_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `slug` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `email_verified_at`, `password`, `mobile`, `shop_name`, `address`, `photo`, `status`, `slug`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Md. Masud Rana', 'masud@gmail.com', NULL, '$2y$12$E8e2f9MmiENwTEbagMbXVuJVZbUgUeWn/8PIaChldfqvDqO3vIrUG', '01627309821', 'Muskan', '11 DC Roy Road, Mitford, Dhaka - 1205', '1735378081.JPG', '1', 'md-masud-rana', NULL, '2024-12-28 03:28:01', NULL),
(5, 'Mr. XXX', 'mr.xxx@gmail.com', NULL, '$2y$12$UeFkuQpNWlSnPgOEYJKoWuxXyGveICXYITXa5Qa8fs0Me/FAjFv8a', '01627309820', 'Modina Store', '3 No. Gate, Mitford, Dhaka', '1735740916.jpg', '1', 'mr-xxx', NULL, '2025-01-01 07:51:49', '2025-01-01 08:16:19');

-- --------------------------------------------------------

--
-- Table structure for table `depos`
--

CREATE TABLE `depos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `depo_name` varchar(255) NOT NULL,
  `depo_slug` varchar(255) NOT NULL,
  `depo_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `depos`
--

INSERT INTO `depos` (`id`, `depo_name`, `depo_slug`, `depo_status`, `created_at`, `updated_at`) VALUES
(1, 'Mitford Masud\'s House', 'mitford-masuds-house', 1, '2025-01-20 23:20:20', '2025-01-20 23:45:22'),
(2, 'Model Town Keraniganj', 'model-town-keraniganj', 1, '2025-01-20 23:28:20', '2025-01-20 23:43:58'),
(3, 'testdfsdf', 'testdfsdf', 0, '2025-01-21 00:06:54', '2025-01-21 00:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `depo_product_stocks`
--

CREATE TABLE `depo_product_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `depo_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `total_stock` int(11) NOT NULL,
  `alert_stock` int(11) NOT NULL DEFAULT 20,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `depo_product_stocks`
--

INSERT INTO `depo_product_stocks` (`id`, `depo_id`, `product_id`, `total_stock`, `alert_stock`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 48, 20, '2025-01-21 12:23:23', '2025-01-21 19:52:44'),
(2, 1, 5, 248, 20, '2025-01-21 12:24:06', '2025-01-21 19:52:44'),
(3, 2, 2, 30, 20, '2025-01-21 12:30:21', '2025-01-21 12:30:21'),
(4, 1, 6, 48, 20, '2025-01-21 19:49:45', '2025-01-21 19:52:44'),
(5, 1, 7, 48, 20, '2025-01-21 19:50:19', '2025-01-21 19:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `depo_stocks`
--

CREATE TABLE `depo_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `depo_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `ds_slug` varchar(255) NOT NULL,
  `ds_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `depo_stocks`
--

INSERT INTO `depo_stocks` (`id`, `depo_id`, `warehouse_id`, `product_id`, `user_id`, `employee_id`, `quantity`, `ds_slug`, `ds_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 1, 3, 50, '1737462203', 1, '2025-01-21 12:23:23', '2025-01-21 12:23:23'),
(2, 1, 1, 5, 1, 3, 50, '1737462246', 1, '2025-01-21 12:24:06', '2025-01-21 12:24:06'),
(3, 2, 1, 2, 1, 4, 30, '1737462621', 1, '2025-01-21 12:30:21', '2025-01-21 12:30:21'),
(4, 1, 1, 5, 1, 4, 200, '1737488913', 1, '2025-01-21 19:48:33', '2025-01-21 19:48:33'),
(5, 1, 1, 6, 1, 3, 50, '1737488985', 1, '2025-01-21 19:49:45', '2025-01-21 19:49:45'),
(6, 1, 1, 7, 1, 4, 50, '1737489019', 1, '2025-01-21 19:50:19', '2025-01-21 19:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(14) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `slug` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 2,
  `emp_quantity` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(8, '0001_01_01_000000_create_users_table', 1),
(9, '0001_01_01_000001_create_cache_table', 1),
(10, '0001_01_01_000002_create_jobs_table', 1),
(11, '2024_11_29_163454_create_user_roles_table', 1),
(12, '2024_12_01_133615_create_products_table', 2),
(13, '2024_12_28_080351_create_customers_table', 3),
(14, '2025_01_01_144000_create_employees_table', 3),
(15, '2025_01_14_144553_create_warehouses_table', 3),
(16, '2025_01_14_160822_create_suppliers_table', 3),
(17, '2025_01_16_152839_create_warehouse_stocks_table', 4),
(18, '2025_01_18_130830_create_warehouse_product_stocks_table', 5),
(19, '2025_01_21_044006_create_depos_table', 6),
(20, '2025_01_21_055616_create_depo_stocks_table', 7),
(21, '2025_01_21_172337_create_depo_product_stocks_table', 8),
(22, '2025_01_21_191923_create_order_masters_table', 9),
(23, '2025_01_21_191942_create_order_details_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_master_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `ordered_qty` int(11) NOT NULL,
  `delivered_qty` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_master_id`, `product_id`, `ordered_qty`, `delivered_qty`, `created_at`, `updated_at`) VALUES
(2, 3, 2, 3, 3, '2025-01-21 18:25:29', '2025-01-21 18:25:29'),
(3, 3, 7, 3, 3, '2025-01-21 18:25:29', '2025-01-21 18:25:29'),
(4, 4, 2, 2, 2, '2025-01-21 19:46:58', '2025-01-21 19:46:58'),
(5, 4, 7, 2, 2, '2025-01-21 19:46:58', '2025-01-21 19:46:58'),
(6, 4, 5, 2, 2, '2025-01-21 19:46:58', '2025-01-21 19:46:58'),
(7, 4, 6, 2, 2, '2025-01-21 19:46:58', '2025-01-21 19:46:58'),
(8, 5, 2, 2, 2, '2025-01-21 19:52:44', '2025-01-21 19:52:44'),
(9, 5, 7, 2, 2, '2025-01-21 19:52:44', '2025-01-21 19:52:44'),
(10, 5, 5, 2, 2, '2025-01-21 19:52:44', '2025-01-21 19:52:44'),
(11, 5, 6, 2, 2, '2025-01-21 19:52:44', '2025-01-21 19:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `order_masters`
--

CREATE TABLE `order_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL DEFAULT curdate(),
  `invoice_no` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `num_of_item` int(11) NOT NULL,
  `depo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `warehouse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_masters`
--

INSERT INTO `order_masters` (`id`, `date`, `invoice_no`, `customer_id`, `user_id`, `num_of_item`, `depo_id`, `warehouse_id`, `order_status`, `created_at`, `updated_at`) VALUES
(3, '2025-01-22', 'ORD-20250122_5_29005', 5, 1, 6, NULL, 1, 1, '2025-01-21 18:25:29', '2025-01-21 18:25:29'),
(4, '2025-01-22', 'ORD-20250122_5_31170', 5, 1, 8, NULL, 1, 1, '2025-01-21 19:46:58', '2025-01-21 19:46:58'),
(5, '2025-01-22', 'ORD-20250122_5_18907', 5, 4, 8, 1, NULL, 1, '2025-01-21 19:52:44', '2025-01-21 19:52:44');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `generic_name` varchar(255) NOT NULL,
  `packing` varchar(255) NOT NULL,
  `specification` varchar(255) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `product_slug` varchar(175) DEFAULT NULL,
  `product_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `generic_name`, `packing`, `specification`, `product_img`, `product_slug`, `product_status`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'TestG', '5 X 10', 'sdafsdafas', '1733076287.jpg', 'test', 0, '2024-12-01 12:04:47', '2024-12-02 08:57:31'),
(2, '3Max-D', 'Calcium Oratate, Zinc Sulphate, Magnetium oxide tabletsoxide', '3 x 10', 'Boxes should be Metalic and Brand Name should be embossed.', '1733150940.jpg', '3max-d', 1, '2024-12-01 12:10:30', '2024-12-02 08:49:00'),
(3, 'Test2', 'TestG2', '5 X 10', 'Test2S', '1733140183.jpg', 'test2', 0, '2024-12-02 05:49:45', '2024-12-02 08:58:11'),
(4, 'Test2', 'TestG2', '5 X 10', 'Test2S', '1733140185.jpg', 'test2', 0, '2024-12-02 05:49:46', '2024-12-02 08:58:11'),
(5, 'Test3', 'TestG3', '3 x 10', 'Test3S', '1737216879.jpg', 'test3', 1, '2024-12-02 05:55:16', '2025-01-18 10:14:38'),
(6, 'Test4', 'TestG4', '3 x 10', 'TestG4sdfsdf', '1733142367.jpg', 'test4', 1, '2024-12-02 06:26:07', NULL),
(7, 'Max Queen', 'Calcium Oratate, Zinc Sulphate, Magnetium oxide tabletsoxide', '3 x 10', 'Calcium Oratate, Zinc Sulphate, Magnetium oxide tabletsoxide', '1737469133.jpg', 'max-queen', 1, '2024-12-02 08:59:27', '2025-01-21 14:18:52');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('znCUyhe0dPnxtBuiA0ZyONYSvE3xKC4J6gOY8SNL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNUo1aDJFWkk1QVRSeU9ablIyTFJLR3poSW02dkFSRXphY21pY1FFaCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1737490430);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sup_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(14) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `sup_photo` varchar(255) DEFAULT NULL,
  `sup_status` varchar(255) NOT NULL DEFAULT '1',
  `sup_slug` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `sup_name`, `email`, `mobile`, `company_name`, `address`, `sup_photo`, `sup_status`, `sup_slug`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Indian Person', 'indian@gmail.com', '01627309820', 'JM Mother Company', 'Gujrat, India', '1737041010.jpg', '1', 'indian-person', NULL, '2025-01-16 09:23:30', NULL),
(2, 'Indian Person 2', 'indian2@gmail.com', '01627309822', 'JM Mother Company 2', 'Mumbai, India', '1737041121.jpg', '1', 'indian-person-2', NULL, '2025-01-16 09:24:41', '2025-01-16 09:25:21');

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
  `mobile` varchar(50) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `slug` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role_id` int(10) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `mobile`, `photo`, `status`, `slug`, `remember_token`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Samsul Haque', 'samsul.haque309821@gmail.com', NULL, '$2y$12$HmDim3p53.Vx29l7J1O9BuLw6FIRPmpfYhNhzawRc.8P7HnCleHlO', '01627309821', 'samsul-haque-1735972850(1)-1735972850.png', 1, 'samsul-haque-1735977726', NULL, 1, '2024-12-01 07:21:51', '2025-01-04 02:02:06'),
(3, 'Mukti Uncle', 'mukti@gmail.com', NULL, '$2y$12$bEsWOTagc8g2LXrXyWurMu2N0mF4V/V8A.tEj88Pu/RFRQ9NU2ep2', '01627309800', 'mukti-uncle-1735972828(3)-1735972828.jpg', 1, 'mukti-uncle-1735972828', NULL, 2, '2025-01-03 23:29:39', '2025-01-04 00:59:07'),
(4, 'Md. Masud Rana', 'masud.rana@gmail.com', NULL, '$2y$12$LKo1U53SQ3E9w9EAcSD6i.yFuGjrOMe1wSbnVYql9J5EYTodYeXCa', '01627309820', 'md-masud-rana-(4)-1735968742.jpg', 1, 'md-masud-rana-', NULL, 2, '2025-01-03 23:32:22', '2025-01-03 23:32:22'),
(5, 'Parvej Ahmed Porag', 'porag@gmail.com', NULL, '$2y$12$btyN/n2mcLMQTTuSD8xhFuCv1HnwMldTiK0dlYoqLkr7OYTh/bTlK', '01627309820', 'parvej-ahmed-porag-1737463137(5)-1737463137.jpg', 1, 'parvej-ahmed-porag-1737463137', NULL, 3, '2025-01-21 12:36:23', '2025-01-21 12:38:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `role_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `warehouse_slug` varchar(255) NOT NULL,
  `warehouse_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `warehouse_slug`, `warehouse_status`, `created_at`, `updated_at`) VALUES
(1, 'New Elephant Road', 'new-elephant-road', 1, '2025-01-16 09:21:37', '2025-01-16 09:22:02'),
(2, 'Green Road', 'green-road', 0, '2025-01-16 09:25:58', '2025-01-18 06:42:27');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_product_stocks`
--

CREATE TABLE `warehouse_product_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `total_stock` int(11) NOT NULL,
  `alert_stock` int(11) NOT NULL DEFAULT 100,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouse_product_stocks`
--

INSERT INTO `warehouse_product_stocks` (`id`, `warehouse_id`, `product_id`, `total_stock`, `alert_stock`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 905, 100, '2025-01-18 09:03:47', '2025-01-21 19:46:58'),
(2, 1, 5, 248, 100, '2025-01-18 09:04:36', '2025-01-21 19:48:33'),
(3, 1, 7, 591, 100, '2025-01-18 09:43:50', '2025-01-21 19:50:19'),
(4, 1, 6, 148, 100, '2025-01-21 19:42:43', '2025-01-21 19:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_stocks`
--

CREATE TABLE `warehouse_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `wr_slug` varchar(255) DEFAULT NULL,
  `wr_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouse_stocks`
--

INSERT INTO `warehouse_stocks` (`id`, `warehouse_id`, `user_id`, `supplier_id`, `product_id`, `quantity`, `wr_slug`, `wr_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, 200, '1737212627', 1, '2025-01-18 09:03:47', '2025-01-18 09:03:47'),
(2, 1, 1, 1, 2, 500, '1737213006', 1, '2025-01-18 09:04:06', '2025-01-18 09:10:06'),
(3, 1, 1, 2, 5, 500, '1737213178', 1, '2025-01-18 09:04:36', '2025-01-18 09:12:58'),
(4, 1, 1, 1, 7, 50, '1737215030', 0, '2025-01-18 09:43:50', '2025-01-18 09:55:10'),
(5, 1, 1, 1, 7, 320, '1737457369', 1, '2025-01-18 09:55:37', '2025-01-21 11:02:49'),
(6, 1, 1, 1, 2, 1000, '1737457475', 1, '2025-01-21 11:04:35', '2025-01-21 11:04:35'),
(7, 1, 1, 1, 6, 200, '1737488563', 1, '2025-01-21 19:42:43', '2025-01-21 19:42:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD UNIQUE KEY `customers_slug_unique` (`slug`);

--
-- Indexes for table `depos`
--
ALTER TABLE `depos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `depos_depo_slug_unique` (`depo_slug`);

--
-- Indexes for table `depo_product_stocks`
--
ALTER TABLE `depo_product_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depo_stocks`
--
ALTER TABLE `depo_stocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `depo_stocks_ds_slug_unique` (`ds_slug`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD UNIQUE KEY `employees_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_masters`
--
ALTER TABLE `order_masters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_masters_customer_id_foreign` (`customer_id`),
  ADD KEY `order_masters_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_roles_role_id_unique` (`role_id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `warehouses_warehouse_slug_unique` (`warehouse_slug`);

--
-- Indexes for table `warehouse_product_stocks`
--
ALTER TABLE `warehouse_product_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_stocks`
--
ALTER TABLE `warehouse_stocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wr_slug` (`wr_slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `depos`
--
ALTER TABLE `depos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `depo_product_stocks`
--
ALTER TABLE `depo_product_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `depo_stocks`
--
ALTER TABLE `depo_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_masters`
--
ALTER TABLE `order_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `warehouse_product_stocks`
--
ALTER TABLE `warehouse_product_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warehouse_stocks`
--
ALTER TABLE `warehouse_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_masters`
--
ALTER TABLE `order_masters`
  ADD CONSTRAINT `order_masters_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `order_masters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
