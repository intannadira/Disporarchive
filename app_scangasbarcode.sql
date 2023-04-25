/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : app_scangasbarcode

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 05/06/2022 23:38:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for detail_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `detail_transaksi`;
CREATE TABLE `detail_transaksi`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_transaksi
-- ----------------------------
INSERT INTO `detail_transaksi` VALUES (1, '20220523-1-IN-1', '5901234123457', '2022-05-23 10:21:11', '2022-05-23 10:21:11');
INSERT INTO `detail_transaksi` VALUES (2, '20220523-1-IN-1', '1234567890128', '2022-05-23 10:21:11', '2022-05-23 10:21:11');
INSERT INTO `detail_transaksi` VALUES (3, '20220523-1-IN-1', '4070071967072', '2022-05-23 10:21:11', '2022-05-23 10:21:11');
INSERT INTO `detail_transaksi` VALUES (4, '20220605-1-IN-1', '4070071967072', '2022-06-05 18:21:58', '2022-06-05 18:21:58');
INSERT INTO `detail_transaksi` VALUES (5, '20220605-1-IN-1', '1234567890128', '2022-06-05 18:21:58', '2022-06-05 18:21:58');
INSERT INTO `detail_transaksi` VALUES (6, '20220605-1-IN-1', '5901234123457', '2022-06-05 18:21:58', '2022-06-05 18:21:58');
INSERT INTO `detail_transaksi` VALUES (7, '20220605-OUT-1', '5901234123457', '2022-06-05 22:27:34', '2022-06-05 22:27:34');
INSERT INTO `detail_transaksi` VALUES (8, '20220605-OUT-1', '1234567890128', '2022-06-05 22:27:34', '2022-06-05 22:27:34');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for gas
-- ----------------------------
DROP TABLE IF EXISTS `gas`;
CREATE TABLE `gas`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `barcode_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gas
-- ----------------------------
INSERT INTO `gas` VALUES (7, '4070071967072', '4070071967072', '2022-06-05 21:57:20', '2022-06-05 21:57:20');
INSERT INTO `gas` VALUES (12, '5901234123457', '5901234123457', '2022-06-05 22:02:01', '2022-06-05 22:02:01');
INSERT INTO `gas` VALUES (13, '1234567890128', '1234567890128', '2022-06-05 22:02:01', '2022-06-05 22:02:01');
INSERT INTO `gas` VALUES (14, '4070071967072', '4070071967072', '2022-06-05 22:02:01', '2022-06-05 22:02:01');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (5, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (6, '2022_04_08_220224_create_sessions_table', 1);
INSERT INTO `migrations` VALUES (7, '2022_05_18_144738_create_detail_transaksis_table', 1);
INSERT INTO `migrations` VALUES (8, '2022_05_18_144836_create_transaksis_table', 1);
INSERT INTO `migrations` VALUES (9, '2022_05_18_144845_create_gases_table', 1);
INSERT INTO `migrations` VALUES (10, '2022_05_18_144854_create_relasis_table', 1);
INSERT INTO `migrations` VALUES (11, '2022_05_18_144904_create_sopirs_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for relasi
-- ----------------------------
DROP TABLE IF EXISTS `relasi`;
CREATE TABLE `relasi`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_relasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of relasi
-- ----------------------------
INSERT INTO `relasi` VALUES (1, 'Relasi B', 'Wonogiri', '7', '2022-05-23 10:07:00', '2022-05-23 10:21:11');
INSERT INTO `relasi` VALUES (2, 'Relasi A', 'Wonogiri', '13', '2022-05-23 10:07:39', '2022-06-05 22:27:34');
INSERT INTO `relasi` VALUES (3, 'Gudang Utama', 'Solo', '100', '2022-05-23 14:43:06', '2022-05-23 14:43:06');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id`) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('GyuLjmkPsmP9L3ZpUyIEa7WREP3AFP4Kmx1vBU0j', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicWhEVmJOMk5KVlNjeFZHcTFRMW1URk5vWHM0U0NZUUE3ZFpsUWJrQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zY2FuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1654443176);

-- ----------------------------
-- Table structure for sopir
-- ----------------------------
DROP TABLE IF EXISTS `sopir`;
CREATE TABLE `sopir`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sopir
-- ----------------------------
INSERT INTO `sopir` VALUES (1, 'Kurniawan', 'Mojosongo', '23437437868743', '2022-05-23 10:06:03', '2022-05-23 10:06:03');
INSERT INTO `sopir` VALUES (2, 'Aji Santoso', 'Solo', '743847784788', '2022-05-23 10:06:21', '2022-05-23 10:06:21');

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `id_supir` int(11) NOT NULL,
  `id_relasi` int(11) NOT NULL,
  `status` enum('masuk','keluar') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES (1, '20220523-1-IN-1', '2022-05-23', 1, 1, 'masuk', '2022-05-23 10:21:11', '2022-05-23 10:21:11');
INSERT INTO `transaksi` VALUES (2, '20220605-1-IN-1', '2022-06-05', 1, 2, 'masuk', '2022-06-05 18:21:58', '2022-06-05 18:21:58');
INSERT INTO `transaksi` VALUES (3, '20220605-OUT-1', '2022-06-05', 1, 2, 'keluar', '2022-06-05 22:27:34', '2022-06-05 22:27:34');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `uid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `jabatan_id` int(11) NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `profile_photo_path` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
