-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2023 at 03:32 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `creator` int(11) NOT NULL,
  `modifier` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `status`, `creator`, `modifier`, `created_date`, `modified_date`) VALUES
(1, 'Category', 1, 1, 1, '2023-03-10 22:55:42', '2023-03-10 22:56:18'),
(2, 'Category 1', 1, 1, 1, '2023-03-10 22:56:44', '2023-03-10 22:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(10) UNSIGNED NOT NULL,
  `department_name` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `creator` int(11) NOT NULL,
  `modifier` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `status`, `creator`, `modifier`, `created_date`, `modified_date`) VALUES
(1, 'Department 1', 1, 2, 1, '2023-03-08 23:17:47', '2023-03-22 00:53:14'),
(2, 'Department 2', 1, 1, 1, '2023-03-10 22:01:06', '2023-03-22 00:53:05'),
(3, 'Department 3', 1, 1, 1, '2023-03-22 00:52:42', '2023-03-22 00:52:42'),
(4, 'Department 4', 1, 1, 1, '2023-03-22 00:53:24', '2023-03-22 00:53:24'),
(5, 'Department 5', 1, 1, 1, '2023-03-22 00:53:37', '2023-03-22 00:53:37');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_03_07_102813_create_store_table', 2),
(5, '2023_03_07_102922_create_department_table', 2),
(6, '2023_03_11_043557_create_category_table', 3),
(7, '2023_03_11_051808_create_unite_table', 4),
(8, '2023_03_11_063150_create_product_table', 5),
(9, '2023_03_11_072548_create_product_log_table', 6),
(10, '2023_03_12_110013_create_product_temp_table', 7),
(12, '2023_03_18_122209_create_purchase_cart_table', 8),
(13, '2023_03_17_113903_create_purchase_table', 9),
(14, '2023_03_20_085214_create_requisition_table', 10),
(15, '2023_03_20_104544_create_requisition_cart_table', 11),
(16, '2023_03_20_112626_create_requisition_log_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `unite_id` int(10) UNSIGNED NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `creator` int(11) NOT NULL,
  `modifier` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `category_id`, `store_id`, `unite_id`, `barcode`, `status`, `creator`, `modifier`, `created_date`, `modified_date`) VALUES
(9, 'Note book12', 1, 1, 1, NULL, 1, 1, 1, '2023-03-12 01:13:34', '2023-03-19 02:29:45'),
(10, 'book 123', 2, 2, 2, NULL, 1, 1, 1, '2023-03-18 23:33:51', '2023-03-19 02:29:30'),
(11, 'Kolom 22', 2, 2, 1, NULL, 1, 1, 1, '2023-03-19 01:35:38', '2023-03-19 02:29:16'),
(12, 'Gel Pen', 1, 2, 1, NULL, 1, 2, 2, '2023-03-20 04:06:58', '2023-03-20 04:06:58'),
(13, 'New Product 1', 1, 1, 1, NULL, 1, 2, 2, '2023-03-21 06:52:28', '2023-03-21 06:52:28'),
(14, 'New Product 2', 1, 2, 2, NULL, 1, 2, 2, '2023-03-20 20:10:19', '2023-03-20 20:10:19');

-- --------------------------------------------------------

--
-- Table structure for table `product_log`
--

CREATE TABLE `product_log` (
  `product_log_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_mode` tinyint(4) NOT NULL,
  `quantity` int(11) NOT NULL,
  `reference` varchar(200) NOT NULL,
  `user_ref` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_log`
--

INSERT INTO `product_log` (`product_log_id`, `product_id`, `product_mode`, `quantity`, `reference`, `user_ref`, `status`, `created_date`) VALUES
(1, 9, 1, 12, 'Anupam', 1, 1, '2023-03-12 01:13:34'),
(5, 10, 1, 10, 'Anupam', 1, 1, '2023-03-18 23:33:51'),
(8, 11, 1, 10, 'ggg', 1, 1, '2023-03-19 01:35:38'),
(15, 11, 2, 1, '7', 1, 1, '2023-03-19 02:38:24'),
(16, 9, 2, 1, '8', 1, 1, '2023-03-19 02:45:15'),
(17, 10, 2, 1, '8', 1, 1, '2023-03-19 02:45:15'),
(18, 9, 2, 1, '9', 1, 1, '2023-03-19 06:59:12'),
(19, 12, 1, 20, 'ABC123', 2, 1, '2023-03-20 04:06:58'),
(20, 12, 2, 7, '10', 2, 1, '2023-03-20 04:11:39'),
(21, 9, 2, 4, '10', 2, 1, '2023-03-20 04:11:39'),
(22, 9, 3, 10, 'Delivered', 2, 1, '2023-03-21 04:17:20'),
(23, 10, 3, 5, 'Delivered', 2, 1, '2023-03-21 04:17:20'),
(24, 13, 1, 10, '13231', 2, 1, '2023-03-21 06:52:28'),
(25, 13, 2, 7, '11', 2, 1, '2023-03-21 06:53:38'),
(26, 13, 3, 4, 'Delivered', 2, 1, '2023-03-20 19:28:14'),
(27, 14, 1, 15, 'ABXCC', 2, 1, '2023-03-20 20:10:19'),
(28, 14, 2, 6, '12', 2, 1, '2023-03-20 20:11:00'),
(29, 14, 3, 9, 'Delivered', 2, 1, '2023-03-20 20:12:59'),
(30, 10, 3, 4, 'Delivered', 3, 1, '2023-03-23 03:36:07'),
(31, 11, 3, 3, 'Delivered', 3, 1, '2023-03-23 03:36:07'),
(32, 12, 3, 2, 'Delivered', 3, 1, '2023-03-23 03:36:07');

-- --------------------------------------------------------

--
-- Table structure for table `product_temp`
--

CREATE TABLE `product_temp` (
  `product_temp_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_mode` tinyint(4) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `reference` varchar(200) NOT NULL,
  `user_ref` int(11) DEFAULT NULL,
  `temp_invoice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `total_quantity` varchar(100) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `memo_number` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `creator` int(11) NOT NULL,
  `modifier` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `total_quantity`, `supplier`, `memo_number`, `note`, `status`, `creator`, `modifier`, `created_date`, `modified_date`) VALUES
(7, '1', 'sdfsdfsdfs', NULL, NULL, 1, 1, 1, '2023-03-19 02:38:24', '2023-03-19 02:38:24'),
(8, '2', 'safdsaf', '23123', 'sdgsg sdgasdf sdf', 1, 1, 1, '2023-03-19 02:45:15', '2023-03-19 02:45:15'),
(9, '1', 'adas', NULL, 'asdad', 1, 1, 1, '2023-03-19 06:59:12', '2023-03-19 06:59:12'),
(10, '11', 'Metador', 'ASRF55484', 'Purchase By SS', 1, 2, 2, '2023-03-20 04:11:39', '2023-03-20 04:11:39'),
(11, '7', 'Metador', '23f32', 'sddsf w werew', 1, 2, 2, '2023-03-21 06:53:38', '2023-03-21 06:53:38'),
(12, '6', 'Metador', '485485', 'avc', 1, 2, 2, '2023-03-20 20:11:00', '2023-03-20 20:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_cart`
--

CREATE TABLE `purchase_cart` (
  `purchase_cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_cart`
--

INSERT INTO `purchase_cart` (`purchase_cart_id`, `product_id`, `product_name`, `quantity`, `user_id`, `created_date`) VALUES
(17, 9, 'Note book12', 2, 7, '2023-03-20'),
(18, 11, 'Kolom 22', 1, 7, '2023-03-20'),
(25, 10, 'book 123', 1, 3, '2023-03-23'),
(26, 11, 'Kolom 22', 1, 2, '2023-03-23');

-- --------------------------------------------------------

--
-- Table structure for table `requisition`
--

CREATE TABLE `requisition` (
  `requisition_id` bigint(20) UNSIGNED NOT NULL,
  `total_quantity` varchar(100) DEFAULT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `approved_date` timestamp NULL DEFAULT NULL,
  `delivered_by` int(11) DEFAULT NULL,
  `delivered_date` timestamp NULL DEFAULT NULL,
  `canceled_by` int(11) DEFAULT NULL,
  `canceled_date` timestamp NULL DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `creator` int(11) NOT NULL,
  `modifier` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisition`
--

INSERT INTO `requisition` (`requisition_id`, `total_quantity`, `department_id`, `store_id`, `approved_by`, `approved_date`, `delivered_by`, `delivered_date`, `canceled_by`, `canceled_date`, `note`, `status`, `creator`, `modifier`, `created_date`, `modified_date`) VALUES
(1, '15', 1, NULL, 2, '2023-03-21 05:11:17', 2, '2023-03-21 04:17:20', 2, '2023-03-21 05:10:58', 'asfsadf sdf sdf sdf', 2, 2, 2, '2023-03-20 06:20:05', '2023-03-20 06:20:05'),
(2, '4', 2, NULL, 2, '2023-03-20 19:27:52', 2, '2023-03-20 19:28:14', NULL, NULL, 'wq3ertfsrg  wetwe', 3, 2, 2, '2023-03-20 19:26:34', '2023-03-20 19:26:34'),
(3, '9', 2, NULL, 2, '2023-03-20 20:12:32', 2, '2023-03-20 20:12:59', NULL, NULL, NULL, 3, 2, 2, '2023-03-20 20:11:41', '2023-03-20 20:11:41'),
(4, '6', 1, NULL, NULL, NULL, NULL, NULL, 7, '2023-03-22 03:41:59', 'afsdf dsfd sdf', 4, 5, 5, '2023-03-22 02:18:24', '2023-03-22 02:18:24'),
(5, '4', 2, NULL, 1, '2023-03-22 02:37:53', NULL, NULL, NULL, NULL, 'adsda asd as sad', 2, 5, 5, '2023-03-22 02:22:34', '2023-03-22 02:22:34'),
(6, '9', 2, 2, 7, '2023-03-21 20:12:49', 3, '2023-03-23 03:36:07', NULL, NULL, 'dfsff fsdf df', 3, 5, 5, '2023-03-21 19:38:28', '2023-03-21 19:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `requisition_cart`
--

CREATE TABLE `requisition_cart` (
  `requisition_cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requisition_log`
--

CREATE TABLE `requisition_log` (
  `requisition_log_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_mode` tinyint(4) NOT NULL,
  `quantity` int(11) NOT NULL,
  `reference` varchar(200) DEFAULT NULL,
  `user_ref` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisition_log`
--

INSERT INTO `requisition_log` (`requisition_log_id`, `product_id`, `product_mode`, `quantity`, `reference`, `user_ref`, `status`, `created_date`) VALUES
(1, 9, 2, 10, '1', 2, 1, '2023-03-20 06:20:05'),
(2, 10, 2, 5, '1', 2, 1, '2023-03-20 06:20:05'),
(4, 13, 2, 4, '2', 2, 1, '2023-03-20 19:26:34'),
(5, 14, 2, 9, '3', 2, 1, '2023-03-20 20:11:41'),
(6, 10, 2, 3, '4', 5, 1, '2023-03-22 02:18:24'),
(7, 11, 2, 3, '4', 5, 1, '2023-03-22 02:18:24'),
(8, 14, 2, 4, '5', 5, 1, '2023-03-22 02:22:34'),
(9, 10, 2, 4, '6', 5, 1, '2023-03-21 19:38:28'),
(10, 11, 2, 3, '6', 5, 1, '2023-03-21 19:38:28'),
(11, 12, 2, 2, '6', 5, 1, '2023-03-21 19:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(10) UNSIGNED NOT NULL,
  `store_name` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `creator` int(11) NOT NULL,
  `modifier` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `store_name`, `status`, `creator`, `modifier`, `created_date`, `modified_date`) VALUES
(1, 'Book Store', 1, 2, 2, '2023-03-08 23:20:15', '2023-03-08 23:20:59'),
(2, 'Pan Store', 1, 2, 2, '2023-03-09 01:38:08', '2023-03-09 01:38:08'),
(3, 'Box Store', 1, 2, 2, '2023-03-09 01:38:39', '2023-03-09 01:38:39'),
(4, 'ICT', 1, 1, 1, '2023-03-10 21:58:09', '2023-03-10 22:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `unite`
--

CREATE TABLE `unite` (
  `unite_id` int(10) UNSIGNED NOT NULL,
  `unite_name` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `creator` int(11) NOT NULL,
  `modifier` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unite`
--

INSERT INTO `unite` (`unite_id`, `unite_name`, `status`, `creator`, `modifier`, `created_date`, `modified_date`) VALUES
(1, 'PCs', 1, 1, 2, '2023-03-10 23:36:38', '2023-03-20 04:05:04'),
(2, 'Gram', 1, 1, 2, '2023-03-10 23:39:17', '2023-03-20 04:05:14'),
(3, 'KG', 1, 2, 2, '2023-03-20 04:05:25', '2023-03-20 04:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `dept_admin` varchar(500) DEFAULT NULL,
  `dept_ao` varchar(500) DEFAULT NULL,
  `store_manager` varchar(500) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `creator` tinyint(4) DEFAULT NULL,
  `modifier` tinyint(4) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `designation`, `email`, `number`, `username`, `user_image`, `email_verified_at`, `password`, `dept_admin`, `dept_ao`, `store_manager`, `role`, `status`, `creator`, `modifier`, `created_date`, `modified_date`) VALUES
(1, 'SR Super Admin', 'Super Admin', 'sr@superadmin.com', '01771050040', 'SRSuperAdmin12', '1679465187.jpg', NULL, '$2y$10$vULvLn2vZTVQJOd6XzMiYuNWfZvcAwYNrEIeqblwCjj/7GvzJvCPq', NULL, NULL, NULL, 1, 1, NULL, 1, '2023-03-07 06:24:13', '2023-03-22 00:06:27'),
(2, 'SR Admin', 'Admin', 'sr@admin.com', '01771050041', 'SRAdmin12', '1679465252.jpeg', NULL, '$2y$10$uw7yImRfXw9s2azs7lrIL.5BpbidwznQJ.vEBbyTlQzLkhqWAb/Xi', NULL, NULL, NULL, 2, 1, NULL, 1, '2023-03-09 04:18:18', '2023-03-22 00:07:32'),
(3, 'SR Store Manager', 'Store Mamager', 'sr@storemanager.com', '01771050044', 'SRStoreManager12', '1679465681.jpg', NULL, '$2y$10$hp.ItHKVLMmf2l9QhAienejG2ipY7Q8msvtAiXI9o3EuM31ElKJ7O', NULL, NULL, '1 2 4', 5, 1, 2, 1, '2023-03-09 09:56:37', '2023-03-22 00:14:41'),
(4, 'SR Department Admin 2', 'Department Admin', 'sr@depadmin2.com', '01771050045', 'SRDepAdmin2', '1679466040.png', NULL, '$2y$10$HouqLXrcTzbEu/L9gSiABOzG60QklXHvf/BC59H.mj2ajQYOJ2sBW', '1', NULL, NULL, 3, 1, 2, 1, '2023-03-09 09:59:56', '2023-03-22 00:20:40'),
(5, 'SR Department AO', 'Department AO', 'sr@depao.com', '01771050043', 'SRDepAO12', '1678507814.jpg', NULL, '$2y$10$p81tqn7hLnUvW0vrm5PqiObO.6KYbqQHX95amayTZeWZ0.QNWwKOW', NULL, '1 2 3 5', NULL, 4, 1, 2, 1, '2023-03-09 10:01:48', '2023-03-22 02:11:12'),
(6, 'SR Store Manager 2', 'Store Manager', 'sr@storemanager2.com', '01771050046', 'SRStoreManager2', '1679466217.jpg', NULL, '$2y$10$6gyb0MlxYaiWkL845R9hE.Aupvei6gRWloBVddLxhws6QxkkePlVS', NULL, NULL, '2 3 4', 5, 1, 1, 1, '2023-03-11 04:08:45', '2023-03-22 00:23:37'),
(7, 'SR Department Admin', 'Department Admin', 'sr@depadmin.com', '01771050042', 'SRDepAdmin12', '1679465466.jpg', NULL, '$2y$10$vULvLn2vZTVQJOd6XzMiYuNWfZvcAwYNrEIeqblwCjj/7GvzJvCPq', '1 2', NULL, NULL, 3, 1, 2, 1, '2023-03-20 07:05:22', '2023-03-22 00:11:06');

-- --------------------------------------------------------



-- --------------------------------------------------------


--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_category_name_unique` (`category_name`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD UNIQUE KEY `department_department_name_unique` (`department_name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_product_name_unique` (`product_name`),
  ADD UNIQUE KEY `product_barcode_unique` (`barcode`),
  ADD KEY `product_category_id_foreign` (`category_id`),
  ADD KEY `product_store_id_foreign` (`store_id`),
  ADD KEY `product_unite_id_foreign` (`unite_id`);

--
-- Indexes for table `product_log`
--
ALTER TABLE `product_log`
  ADD PRIMARY KEY (`product_log_id`),
  ADD KEY `product_log_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_temp`
--
ALTER TABLE `product_temp`
  ADD PRIMARY KEY (`product_temp_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `purchase_cart`
--
ALTER TABLE `purchase_cart`
  ADD PRIMARY KEY (`purchase_cart_id`);

--
-- Indexes for table `requisition`
--
ALTER TABLE `requisition`
  ADD PRIMARY KEY (`requisition_id`),
  ADD KEY `requisition_department_id_foreign` (`department_id`);

--
-- Indexes for table `requisition_cart`
--
ALTER TABLE `requisition_cart`
  ADD PRIMARY KEY (`requisition_cart_id`);

--
-- Indexes for table `requisition_log`
--
ALTER TABLE `requisition_log`
  ADD PRIMARY KEY (`requisition_log_id`),
  ADD KEY `requisition_log_product_id_foreign` (`product_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`),
  ADD UNIQUE KEY `store_store_name_unique` (`store_name`);

--
-- Indexes for table `unite`
--
ALTER TABLE `unite`
  ADD PRIMARY KEY (`unite_id`),
  ADD UNIQUE KEY `unite_unite_name_unique` (`unite_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_number_unique` (`number`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_log`
--
ALTER TABLE `product_log`
  MODIFY `product_log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product_temp`
--
ALTER TABLE `product_temp`
  MODIFY `product_temp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purchase_cart`
--
ALTER TABLE `purchase_cart`
  MODIFY `purchase_cart_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `requisition`
--
ALTER TABLE `requisition`
  MODIFY `requisition_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requisition_cart`
--
ALTER TABLE `requisition_cart`
  MODIFY `requisition_cart_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `requisition_log`
--
ALTER TABLE `requisition_log`
  MODIFY `requisition_log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `unite`
--
ALTER TABLE `unite`
  MODIFY `unite_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `product_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`),
  ADD CONSTRAINT `product_unite_id_foreign` FOREIGN KEY (`unite_id`) REFERENCES `unite` (`unite_id`);

--
-- Constraints for table `product_log`
--
ALTER TABLE `product_log`
  ADD CONSTRAINT `product_log_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `requisition`
--
ALTER TABLE `requisition`
  ADD CONSTRAINT `requisition_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `requisition_log`
--
ALTER TABLE `requisition_log`
  ADD CONSTRAINT `requisition_log_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
