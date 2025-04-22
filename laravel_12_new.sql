/*
 Navicat Premium Data Transfer

 Source Server         : Mitra
 Source Server Type    : MySQL
 Source Server Version : 80403 (8.4.3)
 Source Host           : localhost:3306
 Source Schema         : laravel_12_new

 Target Server Type    : MySQL
 Target Server Version : 80403 (8.4.3)
 File Encoding         : 65001

 Date: 22/04/2025 16:56:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for actions
-- ----------------------------
DROP TABLE IF EXISTS `actions`;
CREATE TABLE `actions`  (
  `id` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ordinal` tinyint UNSIGNED NOT NULL DEFAULT 0,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `actions_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `actions_updated_by_index`(`updated_by` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of actions
-- ----------------------------
INSERT INTO `actions` VALUES ('create', 'Create', NULL, NULL, '2025-04-22 08:37:00', '2025-04-22 08:37:00', 3, 1);
INSERT INTO `actions` VALUES ('delete', 'Delete', NULL, NULL, '2025-04-22 08:37:00', '2025-04-22 08:37:00', 5, 1);
INSERT INTO `actions` VALUES ('index', 'Index', NULL, NULL, '2025-04-22 08:37:00', '2025-04-22 08:37:00', 1, 1);
INSERT INTO `actions` VALUES ('update', 'Update', NULL, NULL, '2025-04-22 08:37:00', '2025-04-22 08:37:00', 4, 1);
INSERT INTO `actions` VALUES ('view', 'View', NULL, NULL, '2025-04-22 08:37:00', '2025-04-22 08:37:00', 2, 1);

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `customers_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `customers_updated_by_index`(`updated_by` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------

-- ----------------------------
-- Table structure for employee_accounts
-- ----------------------------
DROP TABLE IF EXISTS `employee_accounts`;
CREATE TABLE `employee_accounts`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `employee_accounts_username_unique`(`username` ASC) USING BTREE,
  INDEX `employee_accounts_employee_id_foreign`(`employee_id` ASC) USING BTREE,
  INDEX `employee_accounts_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `employee_accounts_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `employee_accounts_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employee_accounts
-- ----------------------------
INSERT INTO `employee_accounts` VALUES ('9ebc3087-7c77-497a-a638-e0ef76f28db3', '9ebc3087-173e-4f4a-804d-1e2855442711', 'developer@system', NULL, '$2y$12$JPk/FpZ7M8MO8Rqb4WZdJOuEsdiI6SF.edQtdLEu9tl3v/OzlPQui', NULL, 'system', 'system', '2025-04-22 08:37:32', '2025-04-22 08:37:32', 1);

-- ----------------------------
-- Table structure for employee_password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `employee_password_reset_tokens`;
CREATE TABLE `employee_password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employee_password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for employee_sessions
-- ----------------------------
DROP TABLE IF EXISTS `employee_sessions`;
CREATE TABLE `employee_sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `employee_sessions_user_id_index`(`user_id` ASC) USING BTREE,
  INDEX `employee_sessions_last_activity_index`(`last_activity` ASC) USING BTREE,
  CONSTRAINT `employee_sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `employee_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employee_sessions
-- ----------------------------
INSERT INTO `employee_sessions` VALUES ('NzthrLBYxANAUv9NrpSneEKdrbx6OZOVLAgB9cqm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:137.0) Gecko/20100101 Firefox/137.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic0FJeWZ6NkJEQTcwMHpGT3lMZ1REZGFPM294VEg1c3VPOFZ4WVBBUyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMDoiaHR0cDovL2xvY2FsaG9zdDo4MDAxL3Byb2R1Y3RzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1745309332);

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position_id` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `employees_email_unique`(`email` ASC) USING BTREE,
  INDEX `employees_position_id_foreign`(`position_id` ASC) USING BTREE,
  INDEX `employees_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `employees_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `employees_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employees
-- ----------------------------
INSERT INTO `employees` VALUES ('9ebc3087-173e-4f4a-804d-1e2855442711', 'developer', 'Full Stack Developer', '+6281380912181', 'developer@system', NULL, 'system', 'system', '2025-04-22 08:37:31', '2025-04-22 08:37:31', 1);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cancelled_at` int NULL DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED NULL DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for marketplaces
-- ----------------------------
DROP TABLE IF EXISTS `marketplaces`;
CREATE TABLE `marketplaces`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ordinal` tinyint UNSIGNED NOT NULL DEFAULT 0,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `marketplaces_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `marketplaces_updated_by_index`(`updated_by` ASC) USING BTREE,
  INDEX `marketplaces_created_at_index`(`created_at` ASC) USING BTREE,
  INDEX `marketplaces_updated_at_index`(`updated_at` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of marketplaces
-- ----------------------------
INSERT INTO `marketplaces` VALUES ('blibli', 'Blibli', 'https://www.blibli.com', '/files/images/products/marketplace_image_blibli_image_20250123_151915_016293.png', 'system', 'system', '2024-11-22 09:32:53', '2024-11-22 09:32:53', 2, 1);
INSERT INTO `marketplaces` VALUES ('shopee', 'Shopee', 'https://shopee.co.id', '/files/images/products/marketplace_image_shopee_image_20250123_155411_894485.png', 'system', 'system', '2024-11-22 09:32:53', '2025-01-23 08:54:11', 3, 1);
INSERT INTO `marketplaces` VALUES ('tokopedia', 'Tokopedia', 'https://www.tokopedia.com', '/files/images/products/marketplace_image_tokopedia_image_20250123_155441_151576.png', 'system', 'system', '2024-11-22 09:32:53', '2025-01-23 08:54:41', 1, 1);

-- ----------------------------
-- Table structure for meta_properties
-- ----------------------------
DROP TABLE IF EXISTS `meta_properties`;
CREATE TABLE `meta_properties`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_property_group_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ordinal` tinyint UNSIGNED NOT NULL DEFAULT 0,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `meta_properties_meta_property_group_id_foreign`(`meta_property_group_id` ASC) USING BTREE,
  INDEX `meta_properties_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `meta_properties_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `meta_properties_meta_property_group_id_foreign` FOREIGN KEY (`meta_property_group_id`) REFERENCES `meta_property_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of meta_properties
-- ----------------------------
INSERT INTO `meta_properties` VALUES ('description', 'general', 'description', 'system', 'system', '2025-04-22 08:38:17', '2025-04-22 08:38:17', 2, 1);
INSERT INTO `meta_properties` VALUES ('keywords', 'general', 'keywords', 'system', 'system', '2025-04-22 08:38:17', '2025-04-22 08:38:17', 3, 1);
INSERT INTO `meta_properties` VALUES ('title', 'general', 'title', 'system', 'system', '2025-04-22 08:38:17', '2025-04-22 08:38:17', 1, 1);

-- ----------------------------
-- Table structure for meta_property_groups
-- ----------------------------
DROP TABLE IF EXISTS `meta_property_groups`;
CREATE TABLE `meta_property_groups`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ordinal` tinyint UNSIGNED NOT NULL DEFAULT 0,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `meta_property_groups_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `meta_property_groups_updated_by_index`(`updated_by` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of meta_property_groups
-- ----------------------------
INSERT INTO `meta_property_groups` VALUES ('facebook', 'Facebook', 'system', 'system', '2025-04-22 08:38:06', '2025-04-22 08:38:06', 2, 1);
INSERT INTO `meta_property_groups` VALUES ('general', '(General)', 'system', 'system', '2025-04-22 08:38:06', '2025-04-22 08:38:06', 1, 1);
INSERT INTO `meta_property_groups` VALUES ('instagram', 'Instagram', 'system', 'system', '2025-04-22 08:38:06', '2025-04-22 08:38:06', 3, 1);
INSERT INTO `meta_property_groups` VALUES ('tiktok', 'Tiktok', 'system', 'system', '2025-04-22 08:38:06', '2025-04-22 08:38:06', 4, 1);
INSERT INTO `meta_property_groups` VALUES ('twitter', 'Twitter', 'system', 'system', '2025-04-22 08:38:06', '2025-04-22 08:38:06', 5, 1);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '0000_09_30_042036_create_positions_table', 2);
INSERT INTO `migrations` VALUES (5, '2024_08_30_043431_create_pages_table', 2);
INSERT INTO `migrations` VALUES (6, '2024_08_30_043441_create_actions_table', 2);
INSERT INTO `migrations` VALUES (7, '2024_09_30_035334_create_employees_table', 2);
INSERT INTO `migrations` VALUES (8, '2024_09_30_035339_create_employee_accounts_table', 2);
INSERT INTO `migrations` VALUES (9, '2024_10_01_090408_create_personal_access_tokens_table', 2);
INSERT INTO `migrations` VALUES (10, '2024_10_01_090410_create_marketplaces_table', 2);
INSERT INTO `migrations` VALUES (11, '2024_10_01_090413_create_meta_property_groups_table', 2);
INSERT INTO `migrations` VALUES (12, '2024_10_01_090415_create_meta_properties_table', 2);
INSERT INTO `migrations` VALUES (13, '2024_10_03_073200_create_product_category_seconds_table', 2);
INSERT INTO `migrations` VALUES (14, '2024_10_03_073202_create_product_category_firsts_table', 2);
INSERT INTO `migrations` VALUES (15, '2024_10_10_064954_create_products_table', 2);
INSERT INTO `migrations` VALUES (16, '2024_10_10_081200_create_product_contents_table', 2);
INSERT INTO `migrations` VALUES (17, '2024_10_10_081205_create_product_content_metas_table', 2);
INSERT INTO `migrations` VALUES (18, '2024_10_10_081208_create_product_content_displays_table', 2);
INSERT INTO `migrations` VALUES (19, '2024_10_10_081210_create_product_content_videos_table', 2);
INSERT INTO `migrations` VALUES (20, '2024_10_10_081222_create_product_content_features_table', 2);
INSERT INTO `migrations` VALUES (21, '2024_10_10_081245_create_product_content_marketplaces_table', 2);
INSERT INTO `migrations` VALUES (22, '2024_10_10_081340_create_product_content_specifications_table', 2);
INSERT INTO `migrations` VALUES (23, '2024_10_10_081401_create_product_content_qnas_table', 2);
INSERT INTO `migrations` VALUES (24, '2024_11_12_162024_create_product_content_reviews_table', 2);
INSERT INTO `migrations` VALUES (25, '2024_11_18_160201_create_customers_table', 2);
INSERT INTO `migrations` VALUES (26, '2024_11_18_160233_create_sales_carts_table', 2);
INSERT INTO `migrations` VALUES (27, '2024_11_18_160300_create_sales_cart_detail_table', 2);
INSERT INTO `migrations` VALUES (28, '2024_11_18_160313_create_sales_orders_table', 2);
INSERT INTO `migrations` VALUES (29, '2024_11_18_160332_create_sales_order_detail_table', 2);
INSERT INTO `migrations` VALUES (30, '2024_11_18_160359_create_sales_invoices_table', 2);
INSERT INTO `migrations` VALUES (31, '2024_11_18_160428_create_sales_payments_table', 2);

-- ----------------------------
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages`  (
  `id` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pages_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `pages_updated_by_index`(`updated_by` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES ('dashboard', 'Dashboard', 'system', 'system', '2025-04-22 08:37:18', '2025-04-22 08:37:18', 1);
INSERT INTO `pages` VALUES ('employee', 'Employee', 'system', 'system', '2025-04-22 08:37:18', '2025-04-22 08:37:18', 1);
INSERT INTO `pages` VALUES ('employee_account', 'Employee Account', 'system', 'system', '2025-04-22 08:37:18', '2025-04-22 08:37:18', 1);
INSERT INTO `pages` VALUES ('page', 'Page', 'system', 'system', '2025-04-22 08:37:18', '2025-04-22 08:37:18', 1);
INSERT INTO `pages` VALUES ('permission', 'Permission', 'system', 'system', '2025-04-22 08:37:18', '2025-04-22 08:37:18', 1);
INSERT INTO `pages` VALUES ('position', 'Position', 'system', 'system', '2025-04-22 08:37:18', '2025-04-22 08:37:18', 1);
INSERT INTO `pages` VALUES ('product', 'Product', 'system', 'system', '2025-04-22 08:37:18', '2025-04-22 08:37:18', 1);
INSERT INTO `pages` VALUES ('product_category_first', 'Product Category First', 'system', 'system', '2025-04-22 08:37:18', '2025-04-22 08:37:18', 1);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for positions
-- ----------------------------
DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions`  (
  `id` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `positions_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `positions_updated_by_index`(`updated_by` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of positions
-- ----------------------------
INSERT INTO `positions` VALUES ('admin', 'Admin', 'system', 'system', '2025-04-22 08:37:18', '2025-04-22 08:37:18', 1);
INSERT INTO `positions` VALUES ('developer', 'Developer', 'system', 'system', '2025-04-22 08:37:18', '2025-04-22 08:37:18', 1);

-- ----------------------------
-- Table structure for product_category_firsts
-- ----------------------------
DROP TABLE IF EXISTS `product_category_firsts`;
CREATE TABLE `product_category_firsts`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_category_second_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_category_firsts_product_category_second_id_foreign`(`product_category_second_id` ASC) USING BTREE,
  INDEX `product_category_firsts_slug_index`(`slug` ASC) USING BTREE,
  INDEX `product_category_firsts_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `product_category_firsts_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `product_category_firsts_product_category_second_id_foreign` FOREIGN KEY (`product_category_second_id`) REFERENCES `product_category_seconds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_category_firsts
-- ----------------------------

-- ----------------------------
-- Table structure for product_category_seconds
-- ----------------------------
DROP TABLE IF EXISTS `product_category_seconds`;
CREATE TABLE `product_category_seconds`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_category_seconds_slug_index`(`slug` ASC) USING BTREE,
  INDEX `product_category_seconds_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `product_category_seconds_updated_by_index`(`updated_by` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_category_seconds
-- ----------------------------

-- ----------------------------
-- Table structure for product_content_displays
-- ----------------------------
DROP TABLE IF EXISTS `product_content_displays`;
CREATE TABLE `product_content_displays`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_content_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ordinal` tinyint UNSIGNED NOT NULL DEFAULT 0,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_content_displays_product_content_id_foreign`(`product_content_id` ASC) USING BTREE,
  INDEX `product_content_displays_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `product_content_displays_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `product_content_displays_product_content_id_foreign` FOREIGN KEY (`product_content_id`) REFERENCES `product_contents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_content_displays
-- ----------------------------

-- ----------------------------
-- Table structure for product_content_features
-- ----------------------------
DROP TABLE IF EXISTS `product_content_features`;
CREATE TABLE `product_content_features`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_content_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ordinal` tinyint UNSIGNED NOT NULL DEFAULT 0,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_content_features_product_content_id_foreign`(`product_content_id` ASC) USING BTREE,
  INDEX `product_content_features_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `product_content_features_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `product_content_features_product_content_id_foreign` FOREIGN KEY (`product_content_id`) REFERENCES `product_contents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_content_features
-- ----------------------------

-- ----------------------------
-- Table structure for product_content_marketplaces
-- ----------------------------
DROP TABLE IF EXISTS `product_content_marketplaces`;
CREATE TABLE `product_content_marketplaces`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `marketplace_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_content_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ordinal` tinyint UNSIGNED NOT NULL DEFAULT 0,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_content_marketplaces_marketplace_id_foreign`(`marketplace_id` ASC) USING BTREE,
  INDEX `product_content_marketplaces_product_content_id_foreign`(`product_content_id` ASC) USING BTREE,
  INDEX `product_content_marketplaces_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `product_content_marketplaces_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `product_content_marketplaces_marketplace_id_foreign` FOREIGN KEY (`marketplace_id`) REFERENCES `marketplaces` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_content_marketplaces_product_content_id_foreign` FOREIGN KEY (`product_content_id`) REFERENCES `product_contents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_content_marketplaces
-- ----------------------------

-- ----------------------------
-- Table structure for product_content_metas
-- ----------------------------
DROP TABLE IF EXISTS `product_content_metas`;
CREATE TABLE `product_content_metas`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_content_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_property_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ordinal` tinyint UNSIGNED NOT NULL DEFAULT 0,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `product_content_metas_product_content_id_meta_property_id_unique`(`product_content_id` ASC, `meta_property_id` ASC) USING BTREE,
  INDEX `product_content_metas_meta_property_id_foreign`(`meta_property_id` ASC) USING BTREE,
  INDEX `product_content_metas_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `product_content_metas_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `product_content_metas_meta_property_id_foreign` FOREIGN KEY (`meta_property_id`) REFERENCES `meta_properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_content_metas_product_content_id_foreign` FOREIGN KEY (`product_content_id`) REFERENCES `product_contents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_content_metas
-- ----------------------------

-- ----------------------------
-- Table structure for product_content_qnas
-- ----------------------------
DROP TABLE IF EXISTS `product_content_qnas`;
CREATE TABLE `product_content_qnas`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_content_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ordinal` tinyint UNSIGNED NOT NULL DEFAULT 0,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_content_qnas_product_content_id_foreign`(`product_content_id` ASC) USING BTREE,
  INDEX `product_content_qnas_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `product_content_qnas_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `product_content_qnas_product_content_id_foreign` FOREIGN KEY (`product_content_id`) REFERENCES `product_contents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_content_qnas
-- ----------------------------

-- ----------------------------
-- Table structure for product_content_reviews
-- ----------------------------
DROP TABLE IF EXISTS `product_content_reviews`;
CREATE TABLE `product_content_reviews`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_content_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` float NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ordinal` tinyint UNSIGNED NOT NULL DEFAULT 0,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_content_reviews_product_content_id_foreign`(`product_content_id` ASC) USING BTREE,
  INDEX `product_content_reviews_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `product_content_reviews_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `product_content_reviews_product_content_id_foreign` FOREIGN KEY (`product_content_id`) REFERENCES `product_contents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_content_reviews
-- ----------------------------

-- ----------------------------
-- Table structure for product_content_specifications
-- ----------------------------
DROP TABLE IF EXISTS `product_content_specifications`;
CREATE TABLE `product_content_specifications`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_content_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ordinal` tinyint UNSIGNED NOT NULL DEFAULT 0,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_content_specifications_product_content_id_foreign`(`product_content_id` ASC) USING BTREE,
  INDEX `product_content_specifications_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `product_content_specifications_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `product_content_specifications_product_content_id_foreign` FOREIGN KEY (`product_content_id`) REFERENCES `product_contents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_content_specifications
-- ----------------------------

-- ----------------------------
-- Table structure for product_content_videos
-- ----------------------------
DROP TABLE IF EXISTS `product_content_videos`;
CREATE TABLE `product_content_videos`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_content_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `video_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ordinal` tinyint UNSIGNED NOT NULL DEFAULT 0,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_content_videos_product_content_id_foreign`(`product_content_id` ASC) USING BTREE,
  INDEX `product_content_videos_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `product_content_videos_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `product_content_videos_product_content_id_foreign` FOREIGN KEY (`product_content_id`) REFERENCES `product_contents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_content_videos
-- ----------------------------

-- ----------------------------
-- Table structure for product_contents
-- ----------------------------
DROP TABLE IF EXISTS `product_contents`;
CREATE TABLE `product_contents`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `product_contents_url_unique`(`url` ASC) USING BTREE,
  INDEX `product_contents_product_id_foreign`(`product_id` ASC) USING BTREE,
  INDEX `product_contents_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `product_contents_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `product_contents_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_contents
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_category_first_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `selling_price` decimal(15, 2) NOT NULL,
  `availability` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `products_product_category_first_id_foreign`(`product_category_first_id` ASC) USING BTREE,
  INDEX `products_availability_index`(`availability` ASC) USING BTREE,
  INDEX `products_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `products_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `products_product_category_first_id_foreign` FOREIGN KEY (`product_category_first_id`) REFERENCES `product_category_firsts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------

-- ----------------------------
-- Table structure for sales_cart_detail
-- ----------------------------
DROP TABLE IF EXISTS `sales_cart_detail`;
CREATE TABLE `sales_cart_detail`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_cart_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `product_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `selling_price` decimal(15, 2) NOT NULL DEFAULT 0.00,
  `qty` decimal(8, 2) NOT NULL DEFAULT 0.00,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sales_cart_detail_sales_cart_id_foreign`(`sales_cart_id` ASC) USING BTREE,
  INDEX `sales_cart_detail_product_id_foreign`(`product_id` ASC) USING BTREE,
  INDEX `sales_cart_detail_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `sales_cart_detail_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `sales_cart_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sales_cart_detail_sales_cart_id_foreign` FOREIGN KEY (`sales_cart_id`) REFERENCES `sales_carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sales_cart_detail
-- ----------------------------

-- ----------------------------
-- Table structure for sales_carts
-- ----------------------------
DROP TABLE IF EXISTS `sales_carts`;
CREATE TABLE `sales_carts`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sales_carts_session_id_foreign`(`session_id` ASC) USING BTREE,
  INDEX `sales_carts_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `sales_carts_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `sales_carts_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sales_carts
-- ----------------------------

-- ----------------------------
-- Table structure for sales_invoices
-- ----------------------------
DROP TABLE IF EXISTS `sales_invoices`;
CREATE TABLE `sales_invoices`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_order_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NOT NULL,
  `number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sales_invoices_sales_order_id_foreign`(`sales_order_id` ASC) USING BTREE,
  INDEX `sales_invoices_date_index`(`date` ASC) USING BTREE,
  INDEX `sales_invoices_number_index`(`number` ASC) USING BTREE,
  INDEX `sales_invoices_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `sales_invoices_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `sales_invoices_sales_order_id_foreign` FOREIGN KEY (`sales_order_id`) REFERENCES `sales_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sales_invoices
-- ----------------------------

-- ----------------------------
-- Table structure for sales_order_detail
-- ----------------------------
DROP TABLE IF EXISTS `sales_order_detail`;
CREATE TABLE `sales_order_detail`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_order_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `selling_price` decimal(15, 2) NOT NULL DEFAULT 0.00,
  `qty` decimal(8, 2) NOT NULL DEFAULT 0.00,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sales_order_detail_sales_order_id_foreign`(`sales_order_id` ASC) USING BTREE,
  INDEX `sales_order_detail_product_id_foreign`(`product_id` ASC) USING BTREE,
  INDEX `sales_order_detail_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `sales_order_detail_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `sales_order_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sales_order_detail_sales_order_id_foreign` FOREIGN KEY (`sales_order_id`) REFERENCES `sales_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sales_order_detail
-- ----------------------------

-- ----------------------------
-- Table structure for sales_orders
-- ----------------------------
DROP TABLE IF EXISTS `sales_orders`;
CREATE TABLE `sales_orders`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `customer_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `snap_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `snap_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `date` timestamp NOT NULL,
  `number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fraud_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sales_orders_employee_id_foreign`(`employee_id` ASC) USING BTREE,
  INDEX `sales_orders_customer_id_foreign`(`customer_id` ASC) USING BTREE,
  INDEX `sales_orders_snap_url_index`(`snap_url` ASC) USING BTREE,
  INDEX `sales_orders_snap_token_index`(`snap_token` ASC) USING BTREE,
  INDEX `sales_orders_date_index`(`date` ASC) USING BTREE,
  INDEX `sales_orders_number_index`(`number` ASC) USING BTREE,
  INDEX `sales_orders_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `sales_orders_updated_by_index`(`updated_by` ASC) USING BTREE,
  INDEX `sales_orders_status_index`(`status` ASC) USING BTREE,
  CONSTRAINT `sales_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sales_orders_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sales_orders
-- ----------------------------

-- ----------------------------
-- Table structure for sales_payments
-- ----------------------------
DROP TABLE IF EXISTS `sales_payments`;
CREATE TABLE `sales_payments`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_invoice_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NOT NULL,
  `number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sales_payments_sales_invoice_id_foreign`(`sales_invoice_id` ASC) USING BTREE,
  INDEX `sales_payments_date_index`(`date` ASC) USING BTREE,
  INDEX `sales_payments_number_index`(`number` ASC) USING BTREE,
  INDEX `sales_payments_created_by_index`(`created_by` ASC) USING BTREE,
  INDEX `sales_payments_updated_by_index`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `sales_payments_sales_invoice_id_foreign` FOREIGN KEY (`sales_invoice_id`) REFERENCES `sales_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sales_payments
-- ----------------------------

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id` ASC) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('LckTSPYVEmc4tgYYL0ZcU9x7guJTp56nenr7sXBz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:137.0) Gecko/20100101 Firefox/137.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidU42UGdNMjVETktVNFZrcGE1MU1IRGZrZnNUWjVYSUJRQU1LNFVaVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9lbXBsb3llZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjIyOiJtYXJ5LXNpZGViYXItY29sbGFwc2VkIjtzOjU6ImZhbHNlIjt9', 1745315569);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'aslanasilon', 'aslanasilon@gmail.com', NULL, '$2y$12$W07aUhO.FxuK2aGBXMs3Zulqv0ushUjCMTgjJyiKrlKIxRooLqOki', NULL, '2025-04-22 06:29:03', '2025-04-22 06:29:03');

SET FOREIGN_KEY_CHECKS = 1;
