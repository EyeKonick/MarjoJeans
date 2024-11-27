-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2024 at 03:48 PM
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
-- Database: `marjojeans`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
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
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@test.com', NULL, '$2y$12$5YqmsMUlC7GO9hy.G3RUTONOv/ZPZ8gNwzOa0wdOQqHFHzwKSnS2S', NULL, '2024-08-30 10:27:23', '2024-08-30 11:19:13');

-- --------------------------------------------------------

--
-- Table structure for table `apartments`
--

CREATE TABLE `apartments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `landlord_id` bigint(20) UNSIGNED NOT NULL,
  `landlord_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `apartment_name` varchar(255) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `rooms_available` int(11) NOT NULL,
  `room_rate` decimal(8,2) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `apartment_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`apartment_images`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apartments`
--

INSERT INTO `apartments` (`id`, `landlord_id`, `landlord_name`, `address`, `contact_no`, `facebook`, `email`, `apartment_name`, `latitude`, `longitude`, `rooms_available`, `room_rate`, `description`, `status`, `created_at`, `updated_at`, `apartment_images`) VALUES
(25, 3, 'test', '460 Lynch Course\nHavenhaven, FL 52377-0636', '1-878-892-9434', 'http://www.huel.com/quasi-rerum-aperiam-et-ipsam-voluptatem-repudiandae-aut.html', 'hammes.franco@example.org', 'debitis Apartment', NULL, NULL, 5, 771.25, 'Accusamus optio maiores asperiores aliquid ipsum consequuntur.', 'approved', '2024-09-08 02:47:21', '2024-09-08 02:47:21', NULL),
(26, 3, 'test', '550 Larue Pines Suite 325\nNorth Cali, MO 57736', '1-623-879-5331', 'http://www.weimann.com/', 'zschimmel@example.net', 'atque Apartment', NULL, NULL, 3, 456.85, 'Esse magni consequatur nobis debitis quia dolores sed autem.', 'approved', '2024-09-08 02:47:21', '2024-09-08 02:47:21', NULL),
(27, 3, 'test', '23037 Langosh Landing Apt. 999\nKennyview, CO 35934', '1-321-921-6617', 'http://www.little.com/praesentium-eum-ut-repellendus-in-ut-voluptates-et-quisquam', 'vena.kunze@example.org', 'iusto Apartment', NULL, NULL, 4, 475.09, 'Eos ut quaerat dolores qui placeat repudiandae saepe.', 'approved', '2024-09-08 02:47:21', '2024-09-08 02:47:21', NULL),
(28, 3, 'test', '7237 Emilie Landing Apt. 567\nPort Corenechester, ID 15357', '(989) 551-8980', 'http://www.stanton.net/excepturi-velit-vitae-eius-quibusdam', 'haag.coy@example.net', 'dolore Apartment', NULL, NULL, 1, 1153.57, 'Harum nemo perspiciatis et libero et et id voluptatem.', 'rejected', '2024-09-08 02:47:21', '2024-09-08 03:00:08', NULL),
(29, 4, 'Landlord1', '88342 Murazik Springs Suite 862\nAngiefort, KS 63367', '+1.804.468.1751', 'http://schulist.com/possimus-sunt-dolore-quas-magnam-iste', 'bechtelar.lenore@example.com', 'magnam Apartment', NULL, NULL, 4, 901.25, 'Rerum id doloribus dolorem deleniti et dolorum aut ad.', 'rejected', '2024-09-08 02:47:21', '2024-09-08 03:00:16', NULL),
(30, 4, 'Landlord1', '7976 Yoshiko Harbors\nMadalynmouth, MA 66312-0596', '1-434-684-6190', 'http://www.dach.com/nam-sed-et-est-et-praesentium-beatae.html', 'carmine.terry@example.net', 'magni Apartment', NULL, NULL, 3, 1477.62, 'Dolore beatae accusamus magnam amet unde officiis.', 'approved', '2024-09-08 02:47:21', '2024-09-08 02:47:21', NULL),
(33, 1, 'landlord', '3211 Zemlak Parkway\nSouth Dannie, MO 58072-9622', '(623) 592-9150', 'http://www.cremin.org/reprehenderit-dolores-amet-distinctio-veniam-fugit-enim', 'geovanni80@example.net', 'quibusdam Apartment', NULL, NULL, 3, 1087.91, 'Numquam aut eos at neque debitis sunt quidem.', 'rejected', '2024-09-08 02:47:21', '2024-09-08 03:00:10', NULL),
(34, 1, 'landlord', '6988 McLaughlin Causeway Suite 964\nLynchfort, UT 49180', '(308) 569-2163', 'http://ruecker.com/consectetur-totam-eos-sit-sunt', 'ejones@example.net', 'quaerat Apartment', NULL, NULL, 3, 1375.08, 'Autem non vel enim.', 'rejected', '2024-09-08 02:47:21', '2024-09-08 03:00:13', NULL),
(35, 1, 'landlord', '499 Bahringer PlazaQuitzonshire, KS 13089-7069', '847.621.6562', 'http://mcglynn.com/laboriosam-ut-voluptas-aut-ut-aliquid-quam.html', 'sabryna.leffler@example.org', 'quam Apartment343', NULL, NULL, 5, 1623.93, 'At perferendis molestiae est autem itaque praesentium tenetur officia.', 'approved', '2024-09-08 02:47:21', '2024-10-20 11:06:53', NULL),
(36, 1, 'landlord', '8608 Tremblay Meadow Suite 190\nPort Stevebury, AZ 38364-7834', '+1-603-284-3944', 'http://www.senger.com/non-doloribus-voluptas-eveniet-ex', 'sharon70@example.net', 'rerum Apartment', NULL, NULL, 4, 1173.06, 'Quod eos sunt nihil.', 'approved', '2024-09-08 02:47:21', '2024-09-08 02:47:21', NULL),
(37, 3, 'test', '1047 Betsy Via Apt. 512\nPort Armandotown, NH 69343', '630.574.5689', 'https://grant.com/cumque-quidem-et-neque-voluptas-laborum-dolorum-voluptatem.html', 'kkeeling@example.org', 'maiores Apartment', NULL, NULL, 1, 510.37, 'Corrupti et optio corrupti excepturi eum.', 'approved', '2024-09-08 02:47:21', '2024-09-08 02:47:21', NULL),
(38, 3, 'test', '603 Orval Hill Suite 060\nSouth Tyraborough, NH 47367', '+1-657-857-7078', 'http://tromp.com/', 'maynard.kozey@example.org', 'aut Apartment', NULL, NULL, 5, 248.32, 'Illo sequi asperiores quia libero dolores asperiores.', 'approved', '2024-09-08 02:47:21', '2024-09-08 02:47:21', NULL),
(39, 4, 'Landlord1', '3013 Davis Passage Apt. 830\nPort Yadira, ID 98411', '318-537-1234', 'http://tremblay.com/qui-eos-voluptas-qui-exercitationem-sunt', 'pryan@example.org', 'quae Apartment', NULL, NULL, 1, 376.38, 'Odit tempora porro eos rerum voluptates iusto voluptas.', 'approved', '2024-09-08 02:47:42', '2024-09-08 02:47:42', NULL),
(40, 1, 'landlord', '6837 Ratke Rapids\nBeierburgh, NC 97538-9512', '+1 (252) 730-3213', 'http://www.daugherty.com/ut-eveniet-aut-quaerat-et', 'chandler.adams@example.net', 'optio Apartment', NULL, NULL, 4, 113.46, 'Iusto quaerat quas reiciendis ex quia beatae minima.', 'rejected', '2024-09-08 02:47:42', '2024-09-08 03:00:13', NULL),
(41, 4, 'Landlord1', '5885 Shields Shore\nNew Chadrick, IN 56293-8831', '1-830-457-6674', 'http://dickens.com/', 'bvandervort@example.net', 'ut Apartment', NULL, NULL, 1, 508.75, 'Dolorem libero qui nihil minus omnis adipisci quidem facilis.', 'rejected', '2024-09-08 02:47:42', '2024-09-08 03:00:12', NULL),
(42, 3, 'test', '523 Trantow Square Suite 655\nNew Michelle, CO 29766', '(254) 840-5242', 'http://www.douglas.info/et-est-et-reiciendis-magni', 'mmann@example.net', 'pariatur Apartment', NULL, NULL, 2, 682.53, 'Delectus beatae maxime facilis blanditiis rem.', 'rejected', '2024-09-08 02:47:42', '2024-09-08 03:00:12', NULL),
(43, 3, 'test', '41973 Parker Crescent Apt. 653\nRonnymouth, NJ 59254-8728', '+1.820.558.7246', 'http://marks.com/aut-nostrum-quas-minus-tempore-et-modi-quidem', 'block.presley@example.net', 'maiores Apartment', NULL, NULL, 1, 1070.44, 'Culpa enim est earum fugit corrupti labore velit.', 'approved', '2024-09-08 02:47:42', '2024-09-08 02:47:42', NULL),
(44, 1, 'landlord', '4380 Krystina Cape\nLake Kim, NC 79188-9097', '+1-781-590-6928', 'https://kutch.com/quia-ea-doloribus-et-eos-et-perspiciatis.html', 'damion.sporer@example.net', 'dolores Apartment', NULL, NULL, 5, 609.63, 'Sint esse culpa et sint eligendi ex.', 'approved', '2024-09-08 02:47:42', '2024-09-20 16:49:03', NULL),
(45, 3, 'test', '290 Caroline Ville Suite 967\nEast Emmalee, MA 80967', '+1 (785) 651-8668', 'http://www.zemlak.com/excepturi-iure-qui-reiciendis.html', 'rkoelpin@example.org', 'et Apartment', NULL, NULL, 3, 778.33, 'Molestiae adipisci ut excepturi voluptatem omnis.', 'approved', '2024-09-08 02:47:42', '2024-09-08 02:47:42', NULL),
(47, 1, 'landlord', '400 Hessel ExtensionsNorth Annie, OH 69202-7911', '+1-605-336-8280', 'http://hamill.com/', 'hyatt.bobbie@example.org', 'quod Apsf123asd', NULL, NULL, 1, 1596.26, 'Recusandae nesciunt deleniti voluptas quia et repellendus eos.', 'pending', '2024-09-08 02:47:42', '2024-10-20 11:11:10', NULL),
(48, 3, 'test', '314 Robel Corners Suite 843\nSouth Vicente, ID 31395', '480.888.5604', 'http://champlin.com/explicabo-illum-velit-et-et-facilis-voluptas', 'palma.welch@example.com', 'delectus Apartment', NULL, NULL, 4, 389.85, 'Est quo ratione rerum quo voluptates sint dolorum consequuntur.', 'approved', '2024-09-08 02:47:42', '2024-09-08 02:47:42', NULL),
(49, 3, 'test', '2984 Jules Spur\nEast Maud, NJ 38253', '+12402490433', 'http://trantow.biz/', 'oarmstrong@example.net', 'similique Apartment', NULL, NULL, 3, 1821.30, 'Molestiae eaque quis nihil voluptatem quia et.', 'pending', '2024-09-08 02:47:42', '2024-09-08 02:47:42', NULL),
(50, 1, 'landlord', '7513 Zoe BrooksKoelpinburgh, CA 95178-2830', '+1-254-603-8757', 'http://www.schowalter.com/', 'blick.alex@example.com', 'minima Apartmentsdsd', NULL, NULL, 3, 252.97, 'Quidem accusamus neque tempore dolores.', 'pending', '2024-09-08 02:47:42', '2024-10-20 11:02:54', NULL),
(51, 1, 'landlord', '784 Dickinson Ridge\nNew Meggie, WV 38498-2670', '669-835-9424', 'http://russel.com/neque-asperiores-perferendis-perferendis-sed', 'mohr.anabel@example.com', 'quam Apartment', NULL, NULL, 4, 559.56, 'Cupiditate et adipisci blanditiis.', 'pending', '2024-09-08 02:47:42', '2024-09-08 02:47:42', NULL),
(52, 3, 'test', '278 Genesis Square\nLake Megane, SD 88095', '530-562-1206', 'http://www.cummerata.com/error-vel-ut-unde-non-aperiam-omnis-repellat', 'hollie03@example.com', 'quam Apartment', NULL, NULL, 4, 648.11, 'Quaerat ad omnis pariatur ipsa voluptatem adipisci.', 'pending', '2024-09-08 02:47:42', '2024-09-08 02:47:42', NULL),
(53, 3, 'test', '136 Brianne Row\nRoseville, VA 36346-1518', '+1-989-324-4183', 'http://www.schmitt.net/non-exercitationem-aliquid-blanditiis-et-reiciendis-repellendus', 'fay.beulah@example.org', 'ea Apartment', NULL, NULL, 1, 1552.42, 'Tempora est magnam omnis eos et qui commodi blanditiis.', 'pending', '2024-09-08 02:47:42', '2024-09-08 02:47:42', NULL),
(54, 1, 'landlord', 'asdasdad', 'asdasd', 'asdasdasd', 'asdas@test.com', 'asdasdasd', NULL, NULL, 23, 12313.00, 'asdasd', 'approved', '2024-09-08 05:05:33', '2024-09-08 05:20:51', NULL),
(55, 1, 'landlord', 'asdasd', 'asdasd', 'asdasd', 'asdasd@test.com', 'testdasd', NULL, NULL, 50, 1500.00, 'test', 'approved', '2024-09-08 05:06:00', '2024-09-08 05:09:20', NULL),
(56, 1, 'landlord', 'dasdasd', 'sadasd', 'asdasd', 'adasd@test.com', 'adasdasd', NULL, NULL, 2323, 2000.00, 'asdadas', 'approved', '2024-09-08 05:11:50', '2024-09-08 05:11:55', NULL),
(57, 1, 'landlord', 'asdsd', 'sdasda', 'asdasd', 'adas@test.com', 'dsdsd', NULL, NULL, 15, 1500.00, 'adasda', 'approved', '2024-09-08 05:15:54', '2024-09-08 05:20:50', NULL),
(58, 1, 'landlord', 'asdasd', 'sadasd', 'adasda', 'dasd@asd', 'asdasd', NULL, NULL, 123, 123123.00, 'adasd', 'approved', '2024-09-08 05:20:34', '2024-09-08 05:20:40', NULL),
(60, 1, 'landlord', 'adfuiuiuiuiu', '09090909099', 'uiuiuiuiui', 'uiuiuiui@trtrtrt', 'oioioioio', NULL, NULL, 23, 45.00, 'iuiuiuiui', 'approved', '2024-09-20 17:24:18', '2024-09-20 18:34:06', NULL),
(61, 1, 'landlord', 'uiuiu', 'iuiui', 'uiuiui', 'uiuiuiui@test', 'uiuiuiu', NULL, NULL, 23, 2500.00, 'uiuiu', 'approved', '2024-09-20 17:30:19', '2024-09-20 17:31:07', NULL),
(62, 1, 'landlord', 'klklklkl', '9090909090', 'klklklklkl', 'lklklklkl@test.com', 'lklklklklkl', NULL, NULL, 7878, 787878.00, 'klklkl', 'approved', '2024-09-20 18:55:36', '2024-09-20 18:55:43', NULL),
(63, 1, 'landlord', 'dfdfdf', 'dfdfd', 'dfdfdf', 'dfdf@test', 'dfdfdf', NULL, NULL, 121212, 121212.00, 'fgfgfgfg', 'approved', '2024-09-20 19:04:08', '2024-09-20 19:04:14', NULL),
(65, 1, 'landlord', 'ytytytyt', '76676767677', 'yty', 'tyty@test', 'ytytytytyt', NULL, NULL, 4, 1500.00, 'New', 'approved', '2024-11-23 17:50:31', '2024-11-23 17:53:54', NULL),
(66, 1, 'landlord', 'vbvbvbvb', 'vbvbvbvb', 'vbvbvbvbvb', 'vbvbv@nfsdf', 'vbvbvbvb', NULL, NULL, 5, 5000.00, 'sxsxsxsx', 'pending', '2024-11-23 23:16:00', '2024-11-23 23:16:00', NULL),
(67, 1, 'landlord', 'nmnmnm', 'nmnmnm', 'nmnmnm', 'nmnmnm@test', 'nmnmnm', NULL, NULL, 888, 88888.00, 'BHSADfasdf', 'approved', '2024-11-23 23:22:13', '2024-11-26 22:09:49', '[\"1_1732432933.png\",\"2_1732432933.png\",\"3_1732432933.png\",\"4_1732432933.png\"]'),
(68, 1, 'landlord', 'opopopop', 'opopo', 'popopopop', 'opopop@test', 'popopop', NULL, NULL, 50, 5000.00, 'asadfafd', 'approved', '2024-11-23 23:31:43', '2024-11-23 23:34:05', '[\"1_1732433503.png\",\"2_1732433503.png\",\"3_1732433503.png\",\"4_1732433503.png\"]');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('aadmin@test.com|127.0.0.1', 'i:1;', 1729452517),
('aadmin@test.com|127.0.0.1:timer', 'i:1729452517;', 1729452517),
('admin@test.com|127.0.0.1', 'i:1;', 1732715641),
('admin@test.com|127.0.0.1:timer', 'i:1732715641;', 1732715641),
('tenant@test.com|127.0.0.1', 'i:2;', 1732712149),
('tenant@test.com|127.0.0.1:timer', 'i:1732712149;', 1732712149);

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
-- Table structure for table `landlords`
--

CREATE TABLE `landlords` (
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
-- Dumping data for table `landlords`
--

INSERT INTO `landlords` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'landlord', 'landlord@test.com', NULL, '$2y$12$btJGqDFnPFxeFA4z52dL/edf0gUao0crzxHKj3fRzBy99tbYkd72.', NULL, '2024-08-30 15:58:48', '2024-08-30 15:58:48'),
(3, 'test', 'test@test.com', NULL, '$2y$12$UPDDM4BoOunF/Si.y7Mu6eAb1KApZ67bMLafZQPUAYuH1Ew40.Efq', NULL, '2024-08-30 16:02:42', '2024-08-30 16:02:42'),
(4, 'Landlord1', 'landlord1@test.com', NULL, '$2y$12$YBpec5T.pBwnDGkLoyIthe3n0qoIBV2elLswpdvGyEO2t15jnOjsK', NULL, '2024-09-08 01:53:29', '2024-09-08 01:53:29');

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
(4, '2024_08_30_161926_create_admins_table', 2),
(5, '2024_08_30_162003_create_landlords_table', 2),
(6, '2024_09_05_153043_create_apartments_table', 3),
(7, '2024_09_08_005302_update_status_column_in_apartments_table', 4),
(8, '2024_09_08_103111_add_landlord_id_to_apartments_table', 5),
(9, '2024_10_20_191542_add_images_to_apartments_table', 6),
(10, '2024_11_24_014549_update_apartment_images_column', 7),
(11, '2024_11_24_020952_drop_images_from_apartments_table', 8);

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
('c5JGEACaFvG0yZBwcwl15yNpBgoucNSgFtISWAB5', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoibjFCRUQxSmQ3UXZIckMyM3ZndFZzS1h2RFFDTnBQbzgxZ2t5eVhHRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcGFydG1lbnRzLzY4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NTU6ImxvZ2luX2xhbmRsb3JkXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1732712118),
('Vk6K4Hw5265zsrvlJYTJzCKvRkOtKQAOqeuHhbQa', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNFNvQUxwU0dZSmlOaGNNWkdEbmNQcUZLVmNOMHNlaWhSUEk2bTlQcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sYW5kbG9yZC9hZGQtYXBhcnRtZW50Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1NToibG9naW5fbGFuZGxvcmRfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1732718861);

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
(1, 'User', 'user@test.com', NULL, '$2y$12$ZhpKtat1rM32zS5wXgdx8u2ApSfUAZ.5s3h1xZG9DlStyHw6ZpzLC', NULL, '2024-08-30 10:21:49', '2024-08-30 10:21:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `apartments`
--
ALTER TABLE `apartments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apartments_landlord_id_foreign` (`landlord_id`);

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
-- Indexes for table `landlords`
--
ALTER TABLE `landlords`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `landlords_email_unique` (`email`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `apartments`
--
ALTER TABLE `apartments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

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
-- AUTO_INCREMENT for table `landlords`
--
ALTER TABLE `landlords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apartments`
--
ALTER TABLE `apartments`
  ADD CONSTRAINT `apartments_landlord_id_foreign` FOREIGN KEY (`landlord_id`) REFERENCES `landlords` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
