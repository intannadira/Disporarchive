/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : app_disposisi_surat

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 17/05/2023 16:25:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for jabatan_bidang
-- ----------------------------
DROP TABLE IF EXISTS `jabatan_bidang`;
CREATE TABLE `jabatan_bidang`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_jabatan_bidang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jabatan_bidang
-- ----------------------------
INSERT INTO `jabatan_bidang` VALUES (1, 'Kepala Sekretaris', '2023-04-26 21:07:26', '2023-04-26 21:07:26');
INSERT INTO `jabatan_bidang` VALUES (2, 'Kepala Sub Umum', '2023-04-26 21:07:44', '2023-04-26 21:08:00');
INSERT INTO `jabatan_bidang` VALUES (3, 'Kepala Dinas', '2023-04-26 21:07:44', '2023-04-26 21:07:44');
INSERT INTO `jabatan_bidang` VALUES (4, 'subkorperencanaan', '2023-04-26 21:07:44', '2023-04-26 21:07:44');
INSERT INTO `jabatan_bidang` VALUES (5, 'subkorkepegawaian', '2023-04-26 21:07:44', '2023-04-26 21:07:44');
INSERT INTO `jabatan_bidang` VALUES (6, 'kabidpemuda', '2023-04-26 21:07:44', '2023-04-26 21:07:44');
INSERT INTO `jabatan_bidang` VALUES (7, 'subkororganisasi', '2023-04-26 21:07:44', '2023-04-26 21:07:44');
INSERT INTO `jabatan_bidang` VALUES (8, 'subkorpramuka', '2023-04-26 21:07:44', '2023-04-26 21:07:44');
INSERT INTO `jabatan_bidang` VALUES (9, 'kabidolahraga', '2023-04-26 21:07:44', '2023-04-26 21:07:44');
INSERT INTO `jabatan_bidang` VALUES (10, 'subkorrekreasi', '2023-04-26 21:07:44', '2023-04-26 21:07:44');
INSERT INTO `jabatan_bidang` VALUES (11, 'subkorprestasi', '2023-04-26 21:07:44', '2023-04-26 21:07:44');
INSERT INTO `jabatan_bidang` VALUES (12, 'kabidsarpras', '2023-04-26 21:07:44', '2023-04-26 21:07:44');
INSERT INTO `jabatan_bidang` VALUES (13, 'subkorpendidikan', '2023-04-26 21:07:44', '2023-04-26 21:07:44');
INSERT INTO `jabatan_bidang` VALUES (14, 'subkorsarpras', '2023-04-26 21:07:44', '2023-04-26 21:07:44');
INSERT INTO `jabatan_bidang` VALUES (15, 'staff', '2023-04-26 21:07:44', '2023-04-26 21:07:44');

-- ----------------------------
-- Table structure for karyawan
-- ----------------------------
DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_wa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jabatan_bidang_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of karyawan
-- ----------------------------
INSERT INTO `karyawan` VALUES (1, 'Susi', '628895720904', 1, '2023-04-26 21:57:30', '2023-05-17 15:21:46');
INSERT INTO `karyawan` VALUES (2, 'Budi', '6285726125606', 2, '2023-04-26 21:58:26', '2023-04-26 21:58:26');
INSERT INTO `karyawan` VALUES (3, 'Sukardi', '6285726125606', 3, NULL, NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (23, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (24, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (25, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1);
INSERT INTO `migrations` VALUES (26, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (27, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (28, '2022_04_08_220224_create_sessions_table', 1);
INSERT INTO `migrations` VALUES (29, '2022_05_18_144738_create_detail_transaksis_table', 1);
INSERT INTO `migrations` VALUES (30, '2022_05_18_144836_create_transaksis_table', 1);
INSERT INTO `migrations` VALUES (31, '2022_05_18_144845_create_gases_table', 1);
INSERT INTO `migrations` VALUES (32, '2022_05_18_144854_create_relasis_table', 1);
INSERT INTO `migrations` VALUES (33, '2022_05_18_144904_create_sopirs_table', 1);
INSERT INTO `migrations` VALUES (34, '2022_06_15_195255_create_tipe_gases_table', 1);
INSERT INTO `migrations` VALUES (35, '2023_04_25_223257_create_surat_masuks_table', 2);
INSERT INTO `migrations` VALUES (36, '2023_04_25_223825_create_jabatan_bidangs_table', 2);
INSERT INTO `migrations` VALUES (37, '2023_04_25_224943_create_karyawans_table', 2);
INSERT INTO `migrations` VALUES (38, '2023_04_25_225048_create_surat_keluars_table', 2);
INSERT INTO `migrations` VALUES (40, '2023_04_26_221925_create_roles_table', 3);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bagian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES (1, 'Super Admin', 'Admin', NULL, NULL);
INSERT INTO `role` VALUES (2, 'Admin 1', 'Kasubag Utama', NULL, NULL);
INSERT INTO `role` VALUES (3, 'Admin 2', 'Sekretaris Dinas', NULL, NULL);
INSERT INTO `role` VALUES (4, 'Admin 3', 'Kepala Dinas', NULL, NULL);
INSERT INTO `role` VALUES (5, 'User 1', 'Subkorperencanaan', NULL, NULL);
INSERT INTO `role` VALUES (6, 'User 2', 'Subkorkepegawaian', NULL, NULL);
INSERT INTO `role` VALUES (7, 'User 3', 'Kabidpemuda', NULL, NULL);
INSERT INTO `role` VALUES (8, 'User 4', 'Subkororganisasi', NULL, NULL);
INSERT INTO `role` VALUES (9, 'User 5', 'Subkorpramuka', NULL, NULL);
INSERT INTO `role` VALUES (10, 'User 6', 'Kabidolahraga', NULL, NULL);
INSERT INTO `role` VALUES (11, 'User 7', 'Subkorrekreasi', NULL, NULL);
INSERT INTO `role` VALUES (12, 'User 8', 'Subkorprestasi', NULL, NULL);
INSERT INTO `role` VALUES (13, 'User 9', 'Kabidsarpras', NULL, NULL);
INSERT INTO `role` VALUES (14, 'User 10', 'Subkorpendidikan', NULL, NULL);
INSERT INTO `role` VALUES (15, 'User 11', 'Subkorsarpras', NULL, NULL);
INSERT INTO `role` VALUES (16, 'User 12', 'All Staff', NULL, NULL);

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('9CGhOSUcCNfzt4v7N4b0T5kqltHs8chMxl2h37UB', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoia1VxSW9XY3FPcmlqT2V5UHh1VlhucnVFR3doRTNlUWlldVhLTEpWTSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvc3VwZXJhZG1pbi9rYXJ5YXdhbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk7fQ==', 1684311902);

-- ----------------------------
-- Table structure for surat_keluar
-- ----------------------------
DROP TABLE IF EXISTS `surat_keluar`;
CREATE TABLE `surat_keluar`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `perihal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_surat` timestamp NOT NULL,
  `tujuan_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tipe_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of surat_keluar
-- ----------------------------

-- ----------------------------
-- Table structure for surat_masuk
-- ----------------------------
DROP TABLE IF EXISTS `surat_masuk`;
CREATE TABLE `surat_masuk`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_urut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dari_instansi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `perihal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_terima` date NOT NULL,
  `kepada` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_surat` enum('segera','sangat-segera','biasa') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_disposisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` enum('diajukan','ditolak','didisposisi','dilaksanakan','diverifikasi-kasubag','diverifikasi-sekdin','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tindakan` enum('revisi','diajukan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jabatan_bidang_id` int(11) NULL DEFAULT NULL,
  `karyawan_id` int(11) NULL DEFAULT NULL,
  `tindakan_kadin` enum('selesaikan','tolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `catatan_kadin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tanggal_penyelesaian` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of surat_masuk
-- ----------------------------
INSERT INTO `surat_masuk` VALUES (1, '001', 'Sekda Surakarta', 'KP11/539/2023', 'Rapat Umum 2023', '2023-04-27', '2023-04-26', 'Sekretaris Dispora', 'sangat-segera', 'segera ditindaklanjuti', 'selesai', NULL, 'diajukan', 1, 2, 'selesaikan', 'Menghadap saya dan koordinasi', '2023-04-28 16:08:41', '2023-04-27 14:45:27', '2023-04-30 00:15:54');
INSERT INTO `surat_masuk` VALUES (2, '002', 'DPRD Surakarta', 'KP/DPR/2023', 'Rapat Bundar', '2023-04-28', '2023-04-29', 'Kepala Dinas', 'segera', 'ssds', 'diverifikasi-sekdin', NULL, 'diajukan', 1, 1, 'selesaikan', 'dsds', '2023-05-17 14:40:40', '2023-04-30 19:07:42', '2023-05-17 15:07:19');
INSERT INTO `surat_masuk` VALUES (3, '003', 'Dinas Pendidikan', 'KP/23/2023', 'Koordinasi Pendidikan', '2023-05-01', '2023-05-02', 'Kepala Dinas Dispora', 'sangat-segera', 'Laksanakan', 'didisposisi', NULL, 'diajukan', 6, 1, 'selesaikan', 'Diskusikan dulu ke saya', '2023-05-02 20:34:32', '2023-05-02 20:03:26', '2023-05-02 20:34:32');
INSERT INTO `surat_masuk` VALUES (4, '004', 'Dinas Kependudukan', 'KP/80/2023', 'Rapat Tahunan', '2023-05-01', '2023-05-02', 'Kepala Dinas', 'sangat-segera', NULL, 'diajukan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-02 20:06:38', '2023-05-02 20:06:38');

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
  `jabatan_id` int(11) NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `profile_photo_path` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (9, 'superadmin', 'superadmin@gmail.com', NULL, '$2y$10$Ze4seKcasjw8QjbM.h5CF.3e.ENsYy15Wy25d1eX73NDv9FlQoR5O', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2023-04-26 15:37:26', '2023-04-26 15:37:26');
INSERT INTO `users` VALUES (10, 'kasubagumum', 'admin1@gmail.com', NULL, '$2y$10$ArTg0Q1FCkVIePRGBinV7eIsoRFy90Ff2qOA6Vt7GBREiIHAaZ8kW', NULL, NULL, NULL, 2, NULL, NULL, NULL, '2023-04-26 15:38:39', '2023-04-26 15:38:39');
INSERT INTO `users` VALUES (11, 'sekdin', 'admin2@gmail.com', NULL, '$2y$10$TA9M8GRqsRyxrEksOPYeGOi//M0nfXWx5dP5D/Jup5aZiRIYe0MJC', NULL, NULL, NULL, 3, NULL, NULL, NULL, '2023-04-26 15:39:22', '2023-04-26 15:39:22');
INSERT INTO `users` VALUES (12, 'kadin', 'admin3@gmail.com', NULL, '$2y$10$a2ZFI7JK78FPvsxSLLfRe.ZWQ7wtQ.IGC82nX7wFZEzm3lC/yiTL2', NULL, NULL, NULL, 4, NULL, NULL, NULL, '2023-04-26 15:40:10', '2023-04-26 15:40:10');
INSERT INTO `users` VALUES (13, 'subkorperencanaan', 'user1@gmail.com', NULL, '$2y$10$B8RnwwbHkJSEOO.nsgzZ5O4FsZEp0gBCiDewQ2M/12RZu3tqer97.', NULL, NULL, NULL, 5, NULL, NULL, NULL, '2023-04-26 15:40:49', '2023-04-26 15:40:49');
INSERT INTO `users` VALUES (14, 'subkorkepegawaian', 'user2@gmail.com', NULL, '$2y$10$/itl7HTOJzDgoKVNEJAf5OtYYXtgx2uqvh/ZB628YWpM0MoxLGDsa', NULL, NULL, NULL, 6, NULL, NULL, NULL, '2023-04-26 15:41:18', '2023-04-26 15:41:18');
INSERT INTO `users` VALUES (15, 'kabidpemuda', 'user3@gmail.com', NULL, '$2y$10$h3uRzsC5pqf6GOW7AtfrfOAX.tx/ZBBxt1jMA8SlOIWZ7C09uKQVS', NULL, NULL, NULL, 7, NULL, NULL, NULL, '2023-04-30 20:56:26', '2023-04-30 20:56:26');
INSERT INTO `users` VALUES (17, 'subkororganisasi', 'user4@gmail.com', NULL, '$2y$10$h3uRzsC5pqf6GOW7AtfrfOAX.tx/ZBBxt1jMA8SlOIWZ7C09uKQVS', NULL, NULL, NULL, 8, NULL, NULL, NULL, '2023-04-30 20:56:26', '2023-04-30 20:56:26');
INSERT INTO `users` VALUES (18, 'subkorpramuka', 'user5@gmail.com', NULL, '$2y$10$h3uRzsC5pqf6GOW7AtfrfOAX.tx/ZBBxt1jMA8SlOIWZ7C09uKQVS', NULL, NULL, NULL, 9, NULL, NULL, NULL, '2023-04-30 20:56:26', '2023-04-30 20:56:26');
INSERT INTO `users` VALUES (19, 'kabidolahraga', 'user6@gmail.com', NULL, '$2y$10$h3uRzsC5pqf6GOW7AtfrfOAX.tx/ZBBxt1jMA8SlOIWZ7C09uKQVS', NULL, NULL, NULL, 10, NULL, NULL, NULL, '2023-04-30 20:56:26', '2023-04-30 20:56:26');
INSERT INTO `users` VALUES (20, 'subkorrekreasi', 'user7@gmail.com', NULL, '$2y$10$h3uRzsC5pqf6GOW7AtfrfOAX.tx/ZBBxt1jMA8SlOIWZ7C09uKQVS', NULL, NULL, NULL, 11, NULL, NULL, NULL, '2023-04-30 20:56:26', '2023-04-30 20:56:26');
INSERT INTO `users` VALUES (21, 'subkorprestasi', 'user8@gmail.com', NULL, '$2y$10$h3uRzsC5pqf6GOW7AtfrfOAX.tx/ZBBxt1jMA8SlOIWZ7C09uKQVS', NULL, NULL, NULL, 12, NULL, NULL, NULL, '2023-04-30 20:56:26', '2023-04-30 20:56:26');
INSERT INTO `users` VALUES (23, 'kabidsarpras', 'user9@gmail.com', NULL, '$2y$10$h3uRzsC5pqf6GOW7AtfrfOAX.tx/ZBBxt1jMA8SlOIWZ7C09uKQVS', NULL, NULL, NULL, 13, NULL, NULL, NULL, '2023-04-30 20:56:26', '2023-04-30 20:56:26');
INSERT INTO `users` VALUES (24, 'subkorpendidikan', 'user10@gmail.com', NULL, '$2y$10$h3uRzsC5pqf6GOW7AtfrfOAX.tx/ZBBxt1jMA8SlOIWZ7C09uKQVS', NULL, NULL, NULL, 14, NULL, NULL, NULL, '2023-04-30 20:56:26', '2023-04-30 20:56:26');
INSERT INTO `users` VALUES (25, 'subkorsarpras', 'user11@gmail.com', NULL, '$2y$10$h3uRzsC5pqf6GOW7AtfrfOAX.tx/ZBBxt1jMA8SlOIWZ7C09uKQVS', NULL, NULL, NULL, 15, NULL, NULL, NULL, '2023-04-30 20:56:26', '2023-04-30 20:56:26');
INSERT INTO `users` VALUES (26, 'allstaff', 'user12@gmail.com', NULL, '$2y$10$h3uRzsC5pqf6GOW7AtfrfOAX.tx/ZBBxt1jMA8SlOIWZ7C09uKQVS', NULL, NULL, NULL, 16, NULL, NULL, NULL, '2023-04-30 20:56:26', '2023-04-30 20:56:26');

SET FOREIGN_KEY_CHECKS = 1;
