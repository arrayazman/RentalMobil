/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : rental_mobil

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 14/02/2026 11:28:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2025-02-14-000001', 'App\\Database\\Migrations\\CreateUsers', 'default', 'App', 1771035169, 1);
INSERT INTO `migrations` VALUES (2, '2026-02-14-000002', 'App\\Database\\Migrations\\CreateMobils', 'default', 'App', 1771035169, 1);
INSERT INTO `migrations` VALUES (3, '2026-02-14-000003', 'App\\Database\\Migrations\\CreatePelanggans', 'default', 'App', 1771035810, 2);
INSERT INTO `migrations` VALUES (4, '2026-02-14-000004', 'App\\Database\\Migrations\\CreateSewas', 'default', 'App', 1771035810, 2);
INSERT INTO `migrations` VALUES (5, '2026-02-14-000005', 'App\\Database\\Migrations\\CreatePengembalians', 'default', 'App', 1771035810, 2);
INSERT INTO `migrations` VALUES (6, '2026-02-14-000006', 'App\\Database\\Migrations\\AddDendaTrigger', 'default', 'App', 1771039275, 3);

-- ----------------------------
-- Table structure for mobils
-- ----------------------------
DROP TABLE IF EXISTS `mobils`;
CREATE TABLE `mobils`  (
  `id_mobil` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_polisi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `merk` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipe` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga_per_hari` int(11) NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'tersedia',
  PRIMARY KEY (`id_mobil`) USING BTREE,
  UNIQUE INDEX `no_polisi`(`no_polisi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mobils
-- ----------------------------
INSERT INTO `mobils` VALUES (3, 'T 009 L', 'Honda Jazz', 'Matic', 75000, 'tersedia');
INSERT INTO `mobils` VALUES (4, 'B 1234 ABC', 'Toyota Avanza', 'MPV', 350000, 'tersedia');
INSERT INTO `mobils` VALUES (5, 'B 5678 DEF', 'Honda Jazz', 'Hatchback', 450000, 'tersedia');
INSERT INTO `mobils` VALUES (6, 'D 9012 GHI', 'Suzuki Ertiga', 'MPV', 300000, 'tersedia');
INSERT INTO `mobils` VALUES (7, 'F 3456 JKL', 'Daihatsu Xenia', 'MPV', 320000, 'sedang disewa');
INSERT INTO `mobils` VALUES (8, 'B 7890 MNO', 'Toyota Innova', 'MPV', 600000, 'tersedia');

-- ----------------------------
-- Table structure for pelanggans
-- ----------------------------
DROP TABLE IF EXISTS `pelanggans`;
CREATE TABLE `pelanggans`  (
  `id_pelanggan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_ktp` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `no_hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_pelanggan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pelanggans
-- ----------------------------
INSERT INTO `pelanggans` VALUES (2, 'Fahrizal', '05225225', 'Jakarta', '085752252252');
INSERT INTO `pelanggans` VALUES (3, 'Budi Santoso', '3201012345670001', 'Jl. Merdeka No. 10', '081234567890');
INSERT INTO `pelanggans` VALUES (4, 'Siti Aminah', '3201012345670002', 'Jl. Sudirman No. 45', '081234567891');
INSERT INTO `pelanggans` VALUES (5, 'Rudi Hartono', '3201012345670003', 'Jl. Thamrin No. 88', '081234567892');
INSERT INTO `pelanggans` VALUES (6, 'Dewi Sartika', '3201012345670004', 'Jl. Gatot Subroto No. 12', '081234567893');
INSERT INTO `pelanggans` VALUES (7, 'Andi Wijaya', '3201012345670005', 'Jl. Ahmad Yani No. 99', '081234567894');

-- ----------------------------
-- Table structure for pengembalians
-- ----------------------------
DROP TABLE IF EXISTS `pengembalians`;
CREATE TABLE `pengembalians`  (
  `id_pengembalian` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sewa_id` int(11) UNSIGNED NOT NULL,
  `tgl_kembali` date NOT NULL,
  `denda` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_pengembalian`) USING BTREE,
  INDEX `pengembalians_sewa_id_foreign`(`sewa_id`) USING BTREE,
  CONSTRAINT `pengembalians_sewa_id_foreign` FOREIGN KEY (`sewa_id`) REFERENCES `sewas` (`id_sewa`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengembalians
-- ----------------------------
INSERT INTO `pengembalians` VALUES (4, 3, '2026-02-21', 100000);
INSERT INTO `pengembalians` VALUES (5, 4, '2026-02-16', 0);
INSERT INTO `pengembalians` VALUES (6, 5, '2026-02-19', 50000);

-- ----------------------------
-- Table structure for sewas
-- ----------------------------
DROP TABLE IF EXISTS `sewas`;
CREATE TABLE `sewas`  (
  `id_sewa` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pelanggan_id` int(11) UNSIGNED NOT NULL,
  `mobil_id` int(11) UNSIGNED NOT NULL,
  `tgl_sewa` date NOT NULL,
  `lama_sewa` int(11) NOT NULL,
  `total_biaya` int(11) NOT NULL,
  PRIMARY KEY (`id_sewa`) USING BTREE,
  INDEX `sewas_pelanggan_id_foreign`(`pelanggan_id`) USING BTREE,
  INDEX `sewas_mobil_id_foreign`(`mobil_id`) USING BTREE,
  CONSTRAINT `sewas_mobil_id_foreign` FOREIGN KEY (`mobil_id`) REFERENCES `mobils` (`id_mobil`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `sewas_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggans` (`id_pelanggan`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sewas
-- ----------------------------
INSERT INTO `sewas` VALUES (3, 2, 3, '2026-02-14', 5, 375000);
INSERT INTO `sewas` VALUES (4, 3, 4, '2026-02-14', 2, 700000);
INSERT INTO `sewas` VALUES (5, 7, 8, '2026-02-14', 4, 2400000);
INSERT INTO `sewas` VALUES (6, 5, 7, '2026-02-14', 2, 640000);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (3, 'admin', '$2y$10$jaPOR8xQi5D5Ah2tKglRn.Kw73dEiYFQ0oFmCb3SApsiinLxRWcr6', '2026-02-14 10:09:13');

-- ----------------------------
-- Triggers structure for table pengembalians
-- ----------------------------
DROP TRIGGER IF EXISTS `before_insert_pengembalians`;
delimiter ;;
CREATE TRIGGER `before_insert_pengembalians` BEFORE INSERT ON `pengembalians` FOR EACH ROW BEGIN
            DECLARE batas_kembali DATE;
            DECLARE terlambat INT DEFAULT 0;
            DECLARE denda_per_hari INT DEFAULT 50000;
            DECLARE var_tgl_sewa DATE;
            DECLARE var_lama_sewa INT;

            SELECT tgl_sewa, lama_sewa INTO var_tgl_sewa, var_lama_sewa
            FROM sewas
            WHERE id_sewa = NEW.sewa_id;

            SET batas_kembali = DATE_ADD(var_tgl_sewa, INTERVAL var_lama_sewa DAY);
            SET terlambat = DATEDIFF(NEW.tgl_kembali, batas_kembali);

            IF terlambat > 0 THEN
                SET NEW.denda = terlambat * denda_per_hari;
            ELSE
                SET NEW.denda = 0;
            END IF;
        END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
