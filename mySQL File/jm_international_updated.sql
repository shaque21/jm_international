-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2025 at 02:08 PM
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
-- Database: `jm_international_updated`
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
(1, 'Mitford Masud\'s House', 'mitford-masuds-house', 1, '2025-01-22 10:52:24', NULL),
(2, 'Model Town Keraniganj', 'model-town-keraniganj', 1, '2025-01-22 10:52:33', NULL);

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
(1, 1, 1, 190, 20, '2025-01-22 10:52:54', '2025-01-22 10:58:17'),
(2, 1, 2, 190, 20, '2025-01-22 10:53:09', '2025-01-22 10:58:17'),
(3, 1, 3, 190, 20, '2025-01-22 10:53:24', '2025-01-22 10:58:17');

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
(1, 1, 1, 1, 1, 2, 200, '1737543174', 1, '2025-01-22 10:52:54', '2025-01-22 10:52:54'),
(2, 1, 1, 2, 1, 2, 200, '1737543189', 1, '2025-01-22 10:53:09', '2025-01-22 10:53:09'),
(3, 1, 1, 3, 1, 2, 200, '1737543204', 1, '2025-01-22 10:53:24', '2025-01-22 10:53:24');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_29_163454_create_user_roles_table', 1),
(5, '2024_12_01_133615_create_products_table', 1),
(6, '2024_12_28_080351_create_customers_table', 1),
(7, '2025_01_01_144000_create_employees_table', 1),
(8, '2025_01_14_144553_create_warehouses_table', 1),
(9, '2025_01_14_160822_create_suppliers_table', 1),
(10, '2025_01_16_152839_create_warehouse_stocks_table', 1),
(11, '2025_01_18_130830_create_warehouse_product_stocks_table', 1),
(12, '2025_01_21_044006_create_depos_table', 1),
(13, '2025_01_21_055616_create_depo_stocks_table', 1),
(14, '2025_01_21_172337_create_depo_product_stocks_table', 1),
(15, '2025_01_21_191923_create_order_masters_table', 1),
(16, '2025_01_21_191942_create_order_details_table', 1);

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
(1, 1, 2, 5, 5, '2025-01-22 10:54:05', '2025-01-22 10:54:05'),
(2, 1, 1, 5, 5, '2025-01-22 10:54:05', '2025-01-22 10:54:05'),
(3, 1, 3, 5, 5, '2025-01-22 10:54:05', '2025-01-22 10:54:05'),
(4, 2, 2, 2, 2, '2025-01-22 10:55:57', '2025-01-22 10:55:57'),
(5, 2, 1, 2, 2, '2025-01-22 10:55:57', '2025-01-22 10:55:57'),
(6, 2, 3, 2, 2, '2025-01-22 10:55:57', '2025-01-22 10:55:57'),
(7, 3, 2, 5, 5, '2025-01-22 10:57:44', '2025-01-22 10:57:44'),
(8, 3, 1, 5, 5, '2025-01-22 10:57:44', '2025-01-22 10:57:44'),
(9, 3, 3, 5, 5, '2025-01-22 10:57:44', '2025-01-22 10:57:44'),
(10, 4, 2, 5, 5, '2024-01-22 10:58:17', '2024-01-22 10:58:17'),
(11, 4, 1, 5, 5, '2024-01-22 10:58:17', '2024-01-22 10:58:17'),
(12, 4, 3, 5, 5, '2024-01-22 10:58:17', '2024-01-22 10:58:17');

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
(1, '2025-01-22', 'ORD-20250122_3_11811', 3, 1, 15, NULL, 1, 1, '2025-01-22 10:54:05', '2025-01-22 10:54:05'),
(2, '2025-01-22', 'ORD-20250122_4_72789', 4, 1, 6, NULL, 1, 1, '2025-01-22 10:55:57', '2025-01-22 10:55:57'),
(3, '2025-01-22', 'ORD-20250122_4_92117', 4, 2, 15, 1, NULL, 1, '2025-01-22 10:57:44', '2025-01-22 10:57:44'),
(4, '2024-01-22', 'ORD-20250122_3_48458', 3, 2, 15, 1, NULL, 1, '2024-01-22 10:58:17', '2024-01-22 10:58:17');

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
(1, 'Max Queen', 'Calcium Oratate, Zinc Sulphate, Magnetium oxide tabletsoxide', '3 x 10', 'Calcium Oratate, Zinc Sulphate, Magnetium oxide tabletsoxide', '1737542021.jpg', 'max-queen', 1, '2025-01-22 10:33:41', NULL),
(2, '3Max-D', 'Calcium Oratate, Zinc Sulphate, Magnetium oxide tabletsoxide', '5 X 10', 'Calcium Oratate, Zinc Sulphate, Magnetium oxide tabletsoxide', '1737542044.jpg', '3max-d', 1, '2025-01-22 10:34:04', NULL),
(3, 'Test', 'TestG', '3 x 10', 'Calcium Oratate, Zinc Sulphate, Magnetium oxide tabletsoxide', '1737542072.jpg', 'test', 1, '2025-01-22 10:34:32', NULL);

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
('A2MT9uEfc8fu2PrCnbTXDxujM3Fc9h28KtyX1RdV', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWVN3RHdOc3BwTWhEcEhKRWZ2S1dTQ3JabFRBcjRiQVlxZFZOREVjbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1737551283);

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
(1, 'Indian Person', 'indian@gmail.com', '01627309820', 'JM Mother Company', 'Gujrat, India', '1737543055.jpg', '1', 'indian-person', NULL, '2025-01-22 10:50:55', NULL);

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
  `mobile` varchar(14) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `slug` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `mobile`, `photo`, `status`, `slug`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Samsul Haque', 'samsul.haque309821@gmail.com', NULL, '$2y$12$HmDim3p53.Vx29l7J1O9BuLw6FIRPmpfYhNhzawRc.8P7HnCleHlO', '01627309821', 'samsul-haque-1735972850(1)-1735972850.png', 1, 'samsul-haque-1735977726', 1, '7LSpTx2augZq3Y3zOmxHLuVqJztB07APotXGNiJAgc8BQb8HGek9TPmcIFJk', '2024-12-01 07:21:51', '2025-01-04 02:02:06'),
(2, 'Md. Masud Rana', 'masud.rana@gmail.com', NULL, '$2y$12$n6Q08.visZ8XPqgcX.FgvuJyTrsJWKC461/MooMwxp4F26xRk5Fb.', '01627309821', 'md-masud-rana-1737541857(2)-1737541857.jpg', 1, 'md-masud-rana-1737541857', 2, NULL, '2025-01-22 10:30:57', '2025-01-22 10:30:57'),
(3, 'Parvej Ahmed Porag', 'porag@gmail.com', NULL, '$2y$12$yLjLfocdYveBUrSVe3xWr.k7LxQzfZ45OIwXEJvvbzsg/BHHM3Dxi', '01627309820', 'parvej-ahmed-porag-1737541907(3)-1737541907.jpg', 1, 'parvej-ahmed-porag-1737541907', 3, NULL, '2025-01-22 10:31:47', '2025-01-22 10:31:47'),
(4, 'Happy Rose', 'happy@gmail.com', NULL, '$2y$12$AfaaShjeBCn/Nm0nTz9ND.JJZBNudCdshhSQ9GvjG3nBJiqi.YHIa', '01627309800', 'happy-rose-1737541952(4)-1737541952.jpg', 1, 'happy-rose-1737541952', 3, NULL, '2025-01-22 10:32:32', '2025-01-22 10:32:32'),
(5, 'Mukti Uncle', 'mukti@gmail.com', NULL, '$2y$12$57.sgLwGLnKhBv4nHmhw.e870X2LpZwoqYbF8VJtjJbJX91vslCdO', '01627309800', 'mukti-uncle-1737550162(5)-1737550162.jpg', 1, 'mukti-uncle-1737550162', 2, NULL, '2025-01-22 12:49:22', '2025-01-22 12:49:22');

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
(1, 'New Elephant Road', 'new-elephant-road', 1, '2025-01-22 10:34:56', NULL);

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
(1, 1, 1, 793, 100, '2025-01-22 10:51:14', '2025-01-22 10:55:57'),
(2, 1, 2, 293, 100, '2025-01-22 10:51:26', '2025-01-22 10:55:57'),
(3, 1, 3, 293, 100, '2025-01-22 10:51:37', '2025-01-22 10:55:57');

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
  `wr_slug` varchar(255) NOT NULL,
  `wr_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouse_stocks`
--

INSERT INTO `warehouse_stocks` (`id`, `warehouse_id`, `user_id`, `supplier_id`, `product_id`, `quantity`, `wr_slug`, `wr_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 500, '1737543074', 1, '2025-01-22 10:51:14', '2025-01-22 10:51:14'),
(2, 1, 1, 1, 2, 500, '1737543086', 1, '2025-01-22 10:51:26', '2025-01-22 10:51:26'),
(3, 1, 1, 1, 3, 500, '1737543097', 1, '2025-01-22 10:51:37', '2025-01-22 10:51:37'),
(4, 1, 1, 1, 1, 500, '1737543123', 1, '2025-01-22 10:52:03', '2025-01-22 10:52:03');

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
  ADD UNIQUE KEY `customers_email_unique` (`email`);

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
  ADD UNIQUE KEY `users_slug_unique` (`slug`);

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
  ADD UNIQUE KEY `warehouse_stocks_wr_slug_unique` (`wr_slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `depos`
--
ALTER TABLE `depos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `depo_product_stocks`
--
ALTER TABLE `depo_product_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `depo_stocks`
--
ALTER TABLE `depo_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_masters`
--
ALTER TABLE `order_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `warehouse_product_stocks`
--
ALTER TABLE `warehouse_product_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `warehouse_stocks`
--
ALTER TABLE `warehouse_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_masters`
--
ALTER TABLE `order_masters`
  ADD CONSTRAINT `order_masters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
