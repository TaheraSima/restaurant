-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 21, 2020 at 06:16 AM
-- Server version: 10.2.27-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simecdemo_cowboy2`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_receipt`
--

CREATE TABLE `all_receipt` (
  `all_receipt_id` int(11) NOT NULL,
  `all_receipt_status` int(2) NOT NULL DEFAULT 1,
  `all_receipt_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_status` int(2) NOT NULL DEFAULT 1,
  `category_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_status`, `category_date`) VALUES
(7, 'Default', 1, '2019-12-04 16:34:12'),
(22, 'Mini Burgers', 1, '2020-01-18 09:15:57'),
(23, 'Special Burger', 1, '2020-01-18 09:16:10'),
(24, 'Pizza', 1, '2020-01-18 09:16:22'),
(25, 'Beverage', 1, '2020-01-18 09:16:38'),
(26, 'Chicken Fry', 1, '2020-01-18 09:17:18'),
(27, 'Fries', 1, '2020-01-18 09:17:29'),
(28, 'Subway', 1, '2020-01-18 09:17:40');

-- --------------------------------------------------------

--
-- Table structure for table `cbranch`
--

CREATE TABLE `cbranch` (
  `cbranch_id` int(11) NOT NULL,
  `cbranch_status` int(2) NOT NULL DEFAULT 1,
  `cbranch_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_settings`
--

CREATE TABLE `company_settings` (
  `company_settings_id` int(11) NOT NULL,
  `company_settings_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_settings_logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_settings_address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_settings_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_settings_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_settings_website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_settings_fb` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_settings_twitter` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_settings_youtube` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_settings_status` int(2) NOT NULL DEFAULT 1,
  `company_settings_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company_settings`
--

INSERT INTO `company_settings` (`company_settings_id`, `company_settings_name`, `company_settings_logo`, `company_settings_address`, `company_settings_phone`, `company_settings_email`, `company_settings_website`, `company_settings_fb`, `company_settings_twitter`, `company_settings_youtube`, `company_settings_status`, `company_settings_date`) VALUES
(1, 'DEMO RESTAURANT', '9d6d9d8aa8861fce244f5de8cbcd1288.png', 'Sector:4, Uttara, Dhaka', '01971033730', 'demo@restaurant.com', 'http://demorestaurant.com', NULL, NULL, NULL, 1, '2019-10-12 16:12:28');

-- --------------------------------------------------------

--
-- Table structure for table `customergroup`
--

CREATE TABLE `customergroup` (
  `customergroup_id` int(11) NOT NULL,
  `customergroup_name` varchar(255) NOT NULL,
  `customergroup_status` int(2) NOT NULL DEFAULT 1,
  `customergroup_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customergroup`
--

INSERT INTO `customergroup` (`customergroup_id`, `customergroup_name`, `customergroup_status`, `customergroup_date`) VALUES
(6, 'Other', 1, '2020-01-16 12:47:29'),
(8, 'Online', 1, '2020-01-18 10:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customers_id` int(11) NOT NULL,
  `customers_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customers_group_id` int(11) NOT NULL,
  `customers_address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `customers_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customers_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customers_photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'demo.png',
  `customers_status` int(2) NOT NULL DEFAULT 1,
  `customers_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customers_id`, `customers_name`, `customers_type`, `customers_group_id`, `customers_address`, `customers_email`, `customers_phone`, `customers_photo`, `customers_status`, `customers_date`) VALUES
(12, 'Foodpanda', 'Business', 8, '31891023 dgaoa', 'sales@Foodpanda.com.bd', '01898001', 'demo.png', 1, '2020-01-18 10:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discount_id` int(11) NOT NULL,
  `discount_type` varchar(255) DEFAULT NULL,
  `customer_group_id` int(11) DEFAULT NULL,
  `discount_amount` float(13,2) DEFAULT NULL,
  `discount_status` int(2) NOT NULL DEFAULT 1,
  `discount_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `discount_type`, `customer_group_id`, `discount_amount`, `discount_status`, `discount_date`) VALUES
(3, 'Customer Group', 8, 21.00, 1, '2020-01-18 10:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `due_collection`
--

CREATE TABLE `due_collection` (
  `due_collection_id` int(11) NOT NULL,
  `due_collection_customer_id` int(11) NOT NULL,
  `due_collection_receive_amount` float(13,2) NOT NULL,
  `due_collection_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL,
  `faq_status` int(2) NOT NULL DEFAULT 1,
  `faq_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forgotpassword`
--

CREATE TABLE `forgotpassword` (
  `forgotpassword_id` int(11) NOT NULL,
  `forgotpassword_status` int(2) NOT NULL DEFAULT 1,
  `forgotpassword_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grid_setting`
--

CREATE TABLE `grid_setting` (
  `grid_setting_id` int(10) UNSIGNED NOT NULL,
  `grid_setting_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `grid_setting_icon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `grid_setting_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grid_setting_query` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grid_setting_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `inventory_status` int(2) NOT NULL DEFAULT 1,
  `inventory_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_unit` int(11) NOT NULL,
  `item_sale_permiss` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `buying_price` float(10,2) NOT NULL DEFAULT 0.00,
  `sell_price` float(13,2) DEFAULT NULL,
  `per_pcs_profit` float(10,2) NOT NULL DEFAULT 0.00,
  `item_status` int(2) NOT NULL DEFAULT 1,
  `item_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_unit`, `item_sale_permiss`, `buying_price`, `sell_price`, `per_pcs_profit`, `item_status`, `item_date`) VALUES
(1, 'Chicken', 2, 'Not Allowed', 0.00, 0.00, 0.00, 1, '2020-01-18 09:53:56'),
(2, 'cheese', 2, 'Not Allowed', 0.00, 0.00, 0.00, 1, '2020-01-18 09:56:37'),
(3, 'MIni Burger Bun', 1, 'Not Allowed', 0.00, 0.00, 0.00, 1, '2020-01-18 09:57:04'),
(4, 'Pepsi', 3, 'Allow', 16.00, 20.00, 4.00, 1, '2020-01-18 10:11:34');

-- --------------------------------------------------------

--
-- Table structure for table `main_menu`
--

CREATE TABLE `main_menu` (
  `main_menu_id` int(10) UNSIGNED NOT NULL,
  `main_menu_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `main_menu_icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `main_menu_rank` int(10) NOT NULL,
  `main_menu_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#',
  `main_menu_has_access` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `main_menu_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `main_menu`
--

INSERT INTO `main_menu` (`main_menu_id`, `main_menu_name`, `main_menu_icon`, `main_menu_rank`, `main_menu_link`, `main_menu_has_access`, `main_menu_status`) VALUES
(1, 'Setting', 'fas fa-cogs', 997, 'company_settings/all', 'salman,superadmin,sima,supervisor,manager,golam,test,abc,sales', 1),
(2, 'Purchase', 'fas fa-shopping-bag', 7, 'new_purchase/all', 'salman,superadmin,sima,supervisor,manager,golam,test,abc,sales', 1),
(3, 'Receipts', 'fas fa-shopping-cart', 6, 'all_receipt', 'salman,superadmin,sima,manager,golam,test,sales', 1),
(4, 'Due Collection', 'fas fa-money-bill-alt', 20, '#', 'salman,superadmin,sima,spadmn,manager,golam,anikadnan,,sales', 0),
(5, 'Due Payment', 'fas fa-money-check', 21, '#', 'salman,superadmin,sima,spadmn,manager,golam,sales', 0),
(6, 'Reports', 'fas fa-cash-register', 9, '#', 'salman,superadmin,sima,supervisor,manager,test,abc', 1),
(7, 'Customers', 'fas fa-users', 30, 'customers/all', 'salman,superadmin,sima,manager,golam,test,abc,sales', 0),
(8, 'Worker Info', 'fas fa-user', 31, 'worker_list/all', 'salman,superadmin,sima,manager,test,golam,abc', 0),
(9, 'Raw Materials', 'fas fa-cubes', 1, 'item/all', 'salman,superadmin,sima,manager,golam,test,abc,sales', 1),
(10, 'Products', 'fab fa-product-hunt', 4, 'products/all', 'salman,superadmin,sima,supervisor,manager,golam,test,abc,sales', 1),
(15, 'Suppliers', 'fas fa-users', 12, 'suppliers/all', 'salman,superadmin,sima,manager,golam,sales', 0),
(16, 'Sales', 'fas fa-shopping-cart', 5, 'new_order/all', 'salman,superadmin,sima,supervisor,manager,kitchen,golam,test,abc,sales', 1),
(17, 'Unit', 'fas fa-cubes', 2, 'unit/all', 'salman,superadmin,sima,test,golam,abc,sales', 0),
(18, 'Production', 'fab fa-product-hunt', 3, 'production/all', 'salman,superadmin,sima,manager,golam,test,abc,sales', 0),
(20, 'Inventory', 'fab fa-accessible-icon', 8, 'inventory/all', 'salman,sima,manager,golam,razib', 0),
(21, 'Store', 'fab fa-canadian-maple-leaf', 19, 'store/all', 'salman,superadmin,sima,manager,razib,golam,anikadnan,', 0),
(25, 'Logout', 'fab fa-product-hunt', 999, 'logout', 'salman,superadmin,sima,supervisor,manager,kitchen,golam,test,tt,jj,abc,sales', 1),
(26, 'Online Sales', 'fas fa-users', 22, 'customers/onlinesale', 'salman,superadmin,sima,manager,golam,sales', 1),
(27, 'Help Center', 'fas fa-info-circle', 998, 'faq/all', 'salman,superadmin,sima,supervisor,manager,kitchen,golam,test,tt,jj,jhjk,abc,ed,sales', 1),
(28, 'Password Reset', 'fas fa-info-circle', 997, 'forgotpassword/all', 'salman,sima,manager', 1);

-- --------------------------------------------------------

--
-- Table structure for table `material_store`
--

CREATE TABLE `material_store` (
  `m_store_details_id` int(11) NOT NULL,
  `m_store_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `prev_pur_qty` float DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `closing_qty` float DEFAULT NULL,
  `transaction_type` varchar(255) DEFAULT NULL,
  `purchase_unit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material_store`
--

INSERT INTO `material_store` (`m_store_details_id`, `m_store_id`, `item_id`, `prev_pur_qty`, `quantity`, `closing_qty`, `transaction_type`, `purchase_unit`) VALUES
(1, 1, 4, 0, 10, 10, 'In', 3);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `modules_id` int(10) NOT NULL,
  `modules_name` varchar(255) NOT NULL,
  `modules_table` varchar(255) NOT NULL,
  `modules_access` text DEFAULT NULL,
  `modules_status` int(1) NOT NULL DEFAULT 1,
  `modules_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`modules_id`, `modules_name`, `modules_table`, `modules_access`, `modules_status`, `modules_date`) VALUES
(64, 'Customers', 'customers', NULL, 1, '2019-10-12 12:27:10'),
(65, 'Company Settings', 'company_settings', NULL, 1, '2019-10-12 15:30:12'),
(66, 'Worker List', 'worker_list', NULL, 1, '2019-10-13 11:15:16'),
(67, 'Item', 'item', NULL, 1, '2019-10-13 17:20:12'),
(68, 'category', 'category', NULL, 1, '2019-10-13 17:25:51'),
(70, 'products', 'products', NULL, 1, '2019-10-13 17:26:27'),
(71, 'New Purchase', 'new_purchase', NULL, 1, '2019-10-16 11:32:34'),
(72, 'Main Menu', 'main_menu', NULL, 1, '2019-10-12 12:27:10'),
(73, 'Modules', 'modules', NULL, 1, '2019-10-12 12:27:10'),
(74, 'Sub Category', 'sub_category', NULL, 1, '2019-10-12 12:27:10'),
(75, 'Sub Menu', 'sub_menu', NULL, 1, '2019-10-12 12:27:10'),
(76, 'Suppliers', 'suppliers', NULL, 1, '2019-10-12 12:27:10'),
(77, 'Top Menu', 'top_menu', NULL, 1, '2019-10-12 12:27:10'),
(78, 'Users', 'users', NULL, 1, '2019-10-12 12:27:10'),
(79, 'new order', 'new_order', NULL, 1, '2019-10-12 12:27:10'),
(80, 'unit', 'unit', NULL, 1, '2019-10-25 11:42:49'),
(81, 'production', 'production', NULL, 1, '2019-10-25 11:47:16'),
(82, 'Receipt List', 'receipt_list', NULL, 1, '2019-10-29 12:06:57'),
(83, 'vat_setting', 'vat_setting', NULL, 1, '2019-10-29 16:31:47'),
(84, 'test', 'test', NULL, 1, '2019-10-30 13:43:52'),
(85, 'inventory', 'inventory', NULL, 1, '2019-11-01 15:48:44'),
(86, 'discount', 'discount', NULL, 1, '2019-11-04 18:01:38'),
(87, 'sales_report', 'sales_report', NULL, 1, '2019-11-05 16:00:13'),
(88, 'cbranch', 'cbranch', NULL, 1, '2019-11-07 10:20:02'),
(89, 'all_receipt', 'all_receipt', NULL, 1, '2019-11-07 11:01:33'),
(90, 'store', 'store', NULL, 1, '2019-11-08 17:22:04'),
(91, 'customergroup', 'customergroup', NULL, 1, '2019-11-17 10:53:59'),
(92, 'categorysale', 'categorysale', NULL, 1, '2019-11-18 12:56:31'),
(93, 'productsale', 'productsale', NULL, 1, '2019-11-18 12:57:56'),
(94, 'receivablesale', 'receivablesale', NULL, 1, '2019-11-18 13:00:13'),
(99, 'forgotpassword', 'forgotpassword', NULL, 1, '2019-12-04 18:12:52'),
(100, 'faq', 'faq', NULL, 1, '2020-01-14 10:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `m_store`
--

CREATE TABLE `m_store` (
  `m_store_id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `production_id` int(11) DEFAULT NULL,
  `m_store_status` int(11) NOT NULL DEFAULT 1,
  `m_store_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_store`
--

INSERT INTO `m_store` (`m_store_id`, `req_id`, `production_id`, `m_store_status`, `m_store_date`) VALUES
(1, 1, NULL, 1, '2020-01-18 10:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `new_order`
--

CREATE TABLE `new_order` (
  `new_order_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `products_type` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `products_price` float(13,2) NOT NULL,
  `products_quantity` int(11) NOT NULL,
  `products_value` float(13,2) NOT NULL,
  `grand_total` float(13,2) NOT NULL,
  `new_order_status` int(2) NOT NULL DEFAULT 1,
  `new_order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `new_order`
--

INSERT INTO `new_order` (`new_order_id`, `order_id`, `products_id`, `products_type`, `products_price`, `products_quantity`, `products_value`, `grand_total`, `new_order_status`, `new_order_date`) VALUES
(3, 3, 4, 1, 20.00, 4, 80.00, 80.00, 1, '2020-01-18 10:12:29'),
(4, 4, 2, 2, 60.00, 2, 120.00, 120.00, 1, '2020-01-18 10:19:06');

-- --------------------------------------------------------

--
-- Table structure for table `new_purchase`
--

CREATE TABLE `new_purchase` (
  `new_purchase_id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `new_purchase_quantity` float(11,2) NOT NULL,
  `prev_pur_qty` float DEFAULT 0,
  `closing_qty` float DEFAULT 0,
  `new_purchase_unit` int(11) DEFAULT NULL,
  `new_purchase_unit_price` float(11,2) NOT NULL,
  `approved_qty` double NOT NULL DEFAULT 0,
  `suppliers_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `new_purchase`
--

INSERT INTO `new_purchase` (`new_purchase_id`, `req_id`, `item_id`, `new_purchase_quantity`, `prev_pur_qty`, `closing_qty`, `new_purchase_unit`, `new_purchase_unit_price`, `approved_qty`, `suppliers_id`) VALUES
(1, 1, 4, 10.00, 0, 10, 3, 16.00, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_main`
--

CREATE TABLE `order_main` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customers_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `order_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_vat` float(13,2) DEFAULT NULL,
  `amount` float(13,2) DEFAULT NULL,
  `total_amount` float(13,2) DEFAULT NULL,
  `recv_amount` float(13,2) DEFAULT NULL,
  `retn_amount` int(11) DEFAULT NULL,
  `due_amount` float(13,2) DEFAULT 0.00,
  `products_discount` float(13,2) NOT NULL DEFAULT 0.00,
  `loyality_discount` float(13,2) NOT NULL DEFAULT 0.00,
  `actual_amount` float(13,2) NOT NULL DEFAULT 0.00,
  `special_discount` float(13,2) DEFAULT NULL,
  `net_amount` float(13,2) NOT NULL DEFAULT 0.00,
  `card_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_status` int(11) NOT NULL DEFAULT 1,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `order_time` datetime DEFAULT NULL,
  `cancel_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_main`
--

INSERT INTO `order_main` (`id`, `customer_id`, `customers_type`, `user_id`, `order_no`, `order_vat`, `amount`, `total_amount`, `recv_amount`, `retn_amount`, `due_amount`, `products_discount`, `loyality_discount`, `actual_amount`, `special_discount`, `net_amount`, `card_no`, `payment_type`, `order_status`, `order_date`, `order_time`, `cancel_time`) VALUES
(3, 0, '', 36, '2870', 0.00, 80.00, 80.00, 80.00, 0, 0.00, 0.00, 0.00, 80.00, 0.00, 80.00, '', '1', 2, '2020-01-18 10:12:29', '2020-01-18 14:13:28', NULL),
(4, 0, '', 36, '8733', 0.00, 120.00, 120.00, 200.00, 80, 0.00, 0.00, 0.00, 120.00, 0.00, 120.00, '', '1', 2, '2020-01-18 10:19:06', '2020-01-18 14:20:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `production_id` int(11) NOT NULL,
  `production_products_id` int(11) NOT NULL,
  `production_status` int(2) NOT NULL DEFAULT 1,
  `production_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`production_id`, `production_products_id`, `production_status`, `production_date`) VALUES
(1, 1, 1, '2020-01-18 09:54:37'),
(2, 2, 1, '2020-01-18 09:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `production_details`
--

CREATE TABLE `production_details` (
  `production_details_id` int(11) NOT NULL,
  `production_details_production_id` int(11) NOT NULL,
  `production_details_item_id` int(11) NOT NULL,
  `production_details_unit` int(11) DEFAULT NULL,
  `production_details_amount` float NOT NULL,
  `production_details_status` int(11) NOT NULL,
  `production_details_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `products_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `unit_type_id` int(11) DEFAULT NULL,
  `products_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `products_price` int(11) NOT NULL,
  `products_discount_price` float(13,2) DEFAULT NULL,
  `products_cost` float(13,2) DEFAULT NULL,
  `products_sku` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_barcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `products_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_color` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_production` int(10) UNSIGNED DEFAULT NULL,
  `products_stock_limit` int(10) UNSIGNED DEFAULT NULL,
  `products_status` int(2) NOT NULL DEFAULT 1,
  `products_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`products_id`, `category_id`, `unit_type_id`, `products_name`, `products_price`, `products_discount_price`, `products_cost`, `products_sku`, `products_barcode`, `products_photo`, `products_size`, `products_color`, `products_production`, `products_stock_limit`, `products_status`, `products_date`) VALUES
(1, 22, 1, 'Mini Chicken Burger', 50, 0.00, 30.00, '7368', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:20:06'),
(2, 22, 1, 'MIni Chicken Cheese Burger', 60, 0.00, 34.00, '4463', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:21:04'),
(3, 22, 1, 'BBQ Chicken', 65, 0.00, 35.00, '3002', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:21:51'),
(4, 22, 1, 'BBQ chicken Delight', 70, 0.00, 39.00, '9975', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:22:59'),
(5, 22, 1, 'Chicken Sausage Delight', 90, 0.00, 40.00, '5340', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:23:59'),
(6, 23, 1, 'Cattleman Special Burger', 120, 0.00, 67.00, '5949', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:26:23'),
(7, 23, 1, 'Cheese Suspense', 130, 0.00, 78.00, '9703', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:30:37'),
(8, 23, 1, 'Chicken Maxi', 150, 0.00, 82.00, '8031', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:31:24'),
(9, 23, 1, 'Cowboy Gear', 250, 0.00, 102.00, '3073', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:32:20'),
(10, 26, 1, 'Crispy Fried Chicken', 60, 0.00, 35.00, '4171', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:33:32'),
(11, 26, 1, 'Pop Chicken', 80, 0.00, 50.00, '9491', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:34:41'),
(12, 27, 1, 'Potato Wedges', 50, 0.00, 30.00, '6059', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:35:42'),
(13, 27, 1, 'Nachos', 80, 0.00, 50.00, '1566', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:36:48'),
(14, 28, 1, 'Chicken Subway', 100, 0.00, 60.00, '1429', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:37:43'),
(15, 25, 1, 'Pepsi', 20, 0.00, 16.00, '8016', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:39:04'),
(16, 24, 1, 'Chicken Lovers 6\"', 130, 0.00, 80.00, '7056', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:40:27'),
(17, 24, 1, 'Chicken Lovers 9\"', 240, 0.00, 150.00, '3328', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:41:08'),
(18, 24, 1, 'Chicken Lovers 12\"', 340, 0.00, 240.00, '5103', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:41:43'),
(19, 24, 1, 'Dhaka Pizza 6\"', 140, 0.00, 80.00, '9681', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:42:18'),
(20, 24, 1, 'Dhaka Pizza 9\"', 240, 0.00, 140.00, '7722', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:42:56'),
(21, 24, 1, 'Dhaka pizza 12\"', 330, 0.00, 200.00, '5528', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:43:25'),
(22, 24, 1, 'Mexican Hot 6\'', 150, 0.00, 80.00, '6198', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:44:22'),
(23, 24, 1, 'Mexican Hot 9\"', 250, 0.00, 135.00, '2847', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:45:09'),
(24, 24, 1, 'mexican Hot 12\"', 350, 0.00, 235.00, '2542', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:45:52'),
(25, 28, 1, 'Chicken Wrap', 80, 0.00, 45.00, '9348', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:46:31'),
(26, 28, 1, 'Chicken Cheese Wrap', 100, 0.00, 60.00, '4185', '', 'defaultimg.jpg', NULL, NULL, NULL, NULL, 1, '2020-01-18 09:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `requisition`
--

CREATE TABLE `requisition` (
  `id` int(11) NOT NULL,
  `req_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total` float DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `approved_by` int(10) UNSIGNED DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `requisition`
--

INSERT INTO `requisition` (`id`, `req_no`, `total`, `user_id`, `approved_by`, `username`, `status`, `date`) VALUES
(1, '7583-1', 16, 36, NULL, 'manager', 1, '2020-01-18 10:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE `sub_menu` (
  `sub_menu_id` int(10) UNSIGNED NOT NULL,
  `sub_menu_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sub_menu_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sub_menu_main` int(10) NOT NULL,
  `sub_menu_rank` int(5) NOT NULL,
  `sub_menu_icon` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sub_menu_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_menu`
--

INSERT INTO `sub_menu` (`sub_menu_id`, `sub_menu_name`, `sub_menu_link`, `sub_menu_main`, `sub_menu_rank`, `sub_menu_icon`, `sub_menu_status`) VALUES
(1, 'New Purchase', 'new_purchase/all', 2, 1, 'fas fa-shopping-basket', 0),
(2, 'Purchase Return', 'placeorder/index', 2, 2, 'fas fa-align-center', 0),
(3, 'Company Setting', 'company_settings/all', 1, 1, 'fas fa-store', 0),
(5, 'Collect New Due', '#', 4, 1, 'fas fa-money-bill', 1),
(6, 'Receipt List', '', 3, 1, 'fas fa-cash-register', 0),
(7, 'Social Setting', '#', 1, 2, 'fas fa-share-alt', 0),
(8, 'Raw Entry', 'item/all', 9, 1, 'fas fa-seedling', 0),
(9, 'Category', 'category/all', 10, 1, 'fas fa-pizza-slice', 0),
(10, 'Discount', 'sub_category/all', 10, 3, 'fas fa-hamburger', 0),
(11, 'Item List', 'products/all', 10, 2, 'fas fa-utensils', 0),
(12, 'Purchase Requisition', '', 2, 1, 'fas fa-shopping-cart', 0),
(13, 'New Order', 'new_order/all', 16, 1, 'fas fa-sort-amount-up-alt', 0),
(14, 'VAT', 'vat_setting/all', 1, 3, 'fas fa-seedling', 0),
(16, 'Discount', 'discount/all', 1, 4, 'fas fa-pizza-slice', 0),
(17, 'Sales Summary', 'sales_report/all', 6, 3, 'fas fa-seedling', 1),
(18, 'Company Branch', 'cbranch/all', 1, 2, 'far fa-angry', 0),
(19, 'All Receipt', 'all_receipt', 3, 2, 'fas fa-pizza-slice', 0),
(20, 'Customer Group', 'customergroup/all', 1, 5, 'fas fa-seedling', 0),
(21, 'Category Wise Sales', 'sales_report/index_categorysale', 6, 1, 'fas fa-pizza-slice', 0),
(22, 'Product Wise Sale ', 'sales_report/index_productsale', 6, 2, 'fas fa-utensils', 0),
(23, 'Sales Receivable Report', 'sales_report/index_receivablesale', 6, 4, 'fas fa-hamburger', 0),
(24, 'Stock Balance', 'store/all', 6, 5, 'fas fa-seedling', 0),
(25, 'Create User', 'users/create', 1, 5, 'fas fa-pizza-slice', 0),
(26, 'Password Reset', 'forgotpassword/all', 1, 6, 'fas fa-hamburger', 0),
(27, 'Employee', 'worker_list/all', 1, 7, 'fas fa-hamburger', 0),
(28, 'Sales by employee', 'sales_report/sales_by_employee', 6, 6, 'fas fa-seedling', 1),
(29, 'Sales by Payment Type', 'sales_report/sales_by_payment_type', 6, 7, 'far fa-angry', 1),
(30, 'Receipts', 'sales_report/receipts', 6, 8, 'fas fa-utensils', 1),
(31, 'Sales by Item', 'sales_report/sales_by_item', 6, 5, 'fas fa-shopping-cart', 1);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `suppliers_id` int(11) NOT NULL,
  `suppliers_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `suppliers_business_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suppliers_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suppliers_address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `suppliers_status` int(2) NOT NULL DEFAULT 1,
  `suppliers_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `test_id` int(11) NOT NULL,
  `test_status` int(2) NOT NULL DEFAULT 1,
  `test_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `top_menu`
--

CREATE TABLE `top_menu` (
  `top_menu_id` int(10) UNSIGNED NOT NULL,
  `top_menu_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `top_menu_icon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `top_menu_rank` int(10) NOT NULL,
  `top_menu_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `top_menu_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `top_menu`
--

INSERT INTO `top_menu` (`top_menu_id`, `top_menu_name`, `top_menu_icon`, `top_menu_rank`, `top_menu_link`, `top_menu_status`) VALUES
(1, 'Users', 'fa fa-users', 1, 'users/all', 1),
(2, 'Sales', 'fas fa-shopping-cart', 2, '#', 1),
(3, 'Settings', 'fa fa-users', 1, 'users/all', 1),
(4, 'Purchase', 'fas fa-shopping-cart', 1, '#', 1),
(5, 'Purchase 2', 'fas fa-shopping-cart', 3, '#', 1);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `unit_status` int(2) NOT NULL DEFAULT 1,
  `unit_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_name`, `unit_status`, `unit_date`) VALUES
(1, 'Each', 1, '2020-01-18 09:17:55'),
(2, 'Gram', 1, '2020-01-18 09:53:25'),
(3, 'ml', 1, '2020-01-18 09:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_id_md5` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'User',
  `user_photo` varchar(255) NOT NULL,
  `user_bio` text NOT NULL,
  `user_designation` int(10) NOT NULL,
  `user_status` int(10) NOT NULL DEFAULT 1,
  `last_login` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_id_md5`, `full_name`, `username`, `password`, `user_type`, `user_photo`, `user_bio`, `user_designation`, `user_status`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'c4ca4238a0b923820dcc509a6f75849b', 'Md Salman Sajib', 'salman', '202cb962ac59075b964b07152d234b70', '1', '3f90cc9362f96aa3085cc180b432f3ea.jpg', 'Huge fan of HTML, CSS and Javascript. Web design and open source lover. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.', 0, 1, '2019-09-02 10:06:13', NULL, NULL),
(3, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 'TAHERA KHATUN', 'sima', '202cb962ac59075b964b07152d234b70', '1', '', '', 0, 1, '2019-09-06 04:04:08', NULL, NULL),
(36, '19ca14e7ea6328a42e0eb13d585e4c22', 'Manager', 'manager', '202cb962ac59075b964b07152d234b70', '4', '', '', 0, 1, '2019-10-13 15:02:53', NULL, NULL),
(44, 'f7177163c833dff4b38fc8d2872f1ec6', 'Sales Man', 'sales', '827ccb0eea8a706c4c34a16891f84e7b', '6', '', '', 0, 1, '2019-10-24 15:31:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(10) UNSIGNED NOT NULL,
  `user_type_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_type_access` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type_status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type_name`, `user_type_access`, `user_type_status`) VALUES
(1, 'Master Admin', 'all', 1),
(3, 'Supervisorg', 'dashboard,forgotpassword,all_receipt,receipt_list,production,unit,new_order,new_purchase,products,category,item,customers', 1),
(4, 'Manager', 'dashboard,faq,forgotpassword,receivablesale,productsale,categorysale,customergroup,store,all_receipt,cbranch,sales_report,discount,inventory,vat_setting,receipt_list,production,unit,new_order,users,suppliers,new_purchase,products,category,item,worker_list,company_settings,customers', 1),
(5, 'Kitchen', 'dashboard,all_receipt,sales_report,new_order', 1),
(6, 'Sales Man', 'dashboard,faq,receivablesale,productsale,categorysale,customergroup,store,all_receipt,sales_report,discount,inventory,vat_setting,receipt_list,production,unit,new_order,suppliers,new_purchase,products,category,item,company_settings,customers', 1),
(7, 'Admin', 'dashboard,customergroup,store,all_receipt,cbranch,sales_report,discount,inventory,vat_setting,receipt_list,production,unit,new_order,users,suppliers,new_purchase,products,category,item,worker_list,company_settings,customers', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vat_setting`
--

CREATE TABLE `vat_setting` (
  `vat_setting_id` int(11) NOT NULL,
  `vat_setting_value` int(11) NOT NULL,
  `vat_setting_status` int(2) NOT NULL DEFAULT 1,
  `vat_setting_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vat_setting`
--

INSERT INTO `vat_setting` (`vat_setting_id`, `vat_setting_value`, `vat_setting_status`, `vat_setting_date`) VALUES
(1, 0, 1, '2020-01-18 09:58:59');

-- --------------------------------------------------------

--
-- Table structure for table `worker_list`
--

CREATE TABLE `worker_list` (
  `worker_list_id` int(11) NOT NULL,
  `worker_list_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `worker_list_username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `worker_list_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `worker_list_usertype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `worker_list_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_receipt`
--
ALTER TABLE `all_receipt`
  ADD PRIMARY KEY (`all_receipt_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `cbranch`
--
ALTER TABLE `cbranch`
  ADD PRIMARY KEY (`cbranch_id`);

--
-- Indexes for table `company_settings`
--
ALTER TABLE `company_settings`
  ADD PRIMARY KEY (`company_settings_id`);

--
-- Indexes for table `customergroup`
--
ALTER TABLE `customergroup`
  ADD PRIMARY KEY (`customergroup_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customers_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `due_collection`
--
ALTER TABLE `due_collection`
  ADD PRIMARY KEY (`due_collection_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  ADD PRIMARY KEY (`forgotpassword_id`);

--
-- Indexes for table `grid_setting`
--
ALTER TABLE `grid_setting`
  ADD PRIMARY KEY (`grid_setting_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `main_menu`
--
ALTER TABLE `main_menu`
  ADD PRIMARY KEY (`main_menu_id`);

--
-- Indexes for table `material_store`
--
ALTER TABLE `material_store`
  ADD PRIMARY KEY (`m_store_details_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`modules_id`);

--
-- Indexes for table `m_store`
--
ALTER TABLE `m_store`
  ADD PRIMARY KEY (`m_store_id`);

--
-- Indexes for table `new_order`
--
ALTER TABLE `new_order`
  ADD PRIMARY KEY (`new_order_id`);

--
-- Indexes for table `new_purchase`
--
ALTER TABLE `new_purchase`
  ADD PRIMARY KEY (`new_purchase_id`);

--
-- Indexes for table `order_main`
--
ALTER TABLE `order_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`production_id`);

--
-- Indexes for table `production_details`
--
ALTER TABLE `production_details`
  ADD PRIMARY KEY (`production_details_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`products_id`);

--
-- Indexes for table `requisition`
--
ALTER TABLE `requisition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`sub_menu_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`suppliers_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `top_menu`
--
ALTER TABLE `top_menu`
  ADD PRIMARY KEY (`top_menu_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- Indexes for table `vat_setting`
--
ALTER TABLE `vat_setting`
  ADD PRIMARY KEY (`vat_setting_id`);

--
-- Indexes for table `worker_list`
--
ALTER TABLE `worker_list`
  ADD PRIMARY KEY (`worker_list_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_receipt`
--
ALTER TABLE `all_receipt`
  MODIFY `all_receipt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `cbranch`
--
ALTER TABLE `cbranch`
  MODIFY `cbranch_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_settings`
--
ALTER TABLE `company_settings`
  MODIFY `company_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customergroup`
--
ALTER TABLE `customergroup`
  MODIFY `customergroup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `due_collection`
--
ALTER TABLE `due_collection`
  MODIFY `due_collection_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  MODIFY `forgotpassword_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grid_setting`
--
ALTER TABLE `grid_setting`
  MODIFY `grid_setting_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `main_menu`
--
ALTER TABLE `main_menu`
  MODIFY `main_menu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `material_store`
--
ALTER TABLE `material_store`
  MODIFY `m_store_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `modules_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `m_store`
--
ALTER TABLE `m_store`
  MODIFY `m_store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `new_order`
--
ALTER TABLE `new_order`
  MODIFY `new_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `new_purchase`
--
ALTER TABLE `new_purchase`
  MODIFY `new_purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_main`
--
ALTER TABLE `order_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `production_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `production_details`
--
ALTER TABLE `production_details`
  MODIFY `production_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `products_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `requisition`
--
ALTER TABLE `requisition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `sub_menu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `suppliers_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `top_menu`
--
ALTER TABLE `top_menu`
  MODIFY `top_menu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vat_setting`
--
ALTER TABLE `vat_setting`
  MODIFY `vat_setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `worker_list`
--
ALTER TABLE `worker_list`
  MODIFY `worker_list_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
