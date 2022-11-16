/*
 Navicat Premium Data Transfer

 Source Server         : Mysql
 Source Server Type    : MySQL
 Source Server Version : 80031 (8.0.31)
 Source Host           : localhost:3306
 Source Schema         : produccion_cruz

 Target Server Type    : MySQL
 Target Server Version : 80031 (8.0.31)
 File Encoding         : 65001

 Date: 16/11/2022 13:34:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for actividad
-- ----------------------------
DROP TABLE IF EXISTS `actividad`;
CREATE TABLE `actividad`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `actividad` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of actividad
-- ----------------------------
INSERT INTO `actividad` VALUES (1, 'corte editado', 1);
INSERT INTO `actividad` VALUES (2, 'CACAO LOL', 1);
INSERT INTO `actividad` VALUES (3, 'CINTADO', 1);
INSERT INTO `actividad` VALUES (4, 'TALADO', 1);

-- ----------------------------
-- Table structure for archivo_caja
-- ----------------------------
DROP TABLE IF EXISTS `archivo_caja`;
CREATE TABLE `archivo_caja`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 76 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of archivo_caja
-- ----------------------------
INSERT INTO `archivo_caja` VALUES (75, 'img/archivo_cajas/123.xlsx', '2022-11-08', 1);

-- ----------------------------
-- Table structure for archivo_enfunde
-- ----------------------------
DROP TABLE IF EXISTS `archivo_enfunde`;
CREATE TABLE `archivo_enfunde`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of archivo_enfunde
-- ----------------------------
INSERT INTO `archivo_enfunde` VALUES (25, 'img/archivo_enfunde/2018.xlsx', '2022-10-28', 1);
INSERT INTO `archivo_enfunde` VALUES (26, 'img/archivo_enfunde/2019.xlsx', '2022-10-28', 1);
INSERT INTO `archivo_enfunde` VALUES (27, 'img/archivo_enfunde/2020.xlsx', '2022-10-28', 1);
INSERT INTO `archivo_enfunde` VALUES (28, 'img/archivo_enfunde/ENFUNDE 2018.xlsx', '2022-11-08', 1);

-- ----------------------------
-- Table structure for archivo_recobro
-- ----------------------------
DROP TABLE IF EXISTS `archivo_recobro`;
CREATE TABLE `archivo_recobro`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of archivo_recobro
-- ----------------------------
INSERT INTO `archivo_recobro` VALUES (10, 'img/archivo_recobro/2018.xlsx', '2022-10-28', 1);
INSERT INTO `archivo_recobro` VALUES (11, 'img/archivo_recobro/2019.xlsx', '2022-10-28', 1);
INSERT INTO `archivo_recobro` VALUES (12, 'img/archivo_recobro/2020.xlsx', '2022-10-28', 1);

-- ----------------------------
-- Table structure for asignacion_actividad
-- ----------------------------
DROP TABLE IF EXISTS `asignacion_actividad`;
CREATE TABLE `asignacion_actividad`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `actividad_id` int NULL DEFAULT NULL,
  `trabajador_id` int NULL DEFAULT NULL,
  `valor` decimal(10, 2) NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `ocupado` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `actividad_id`(`actividad_id` ASC) USING BTREE,
  INDEX `trabajador_id`(`trabajador_id` ASC) USING BTREE,
  CONSTRAINT `asignacion_actividad_ibfk_1` FOREIGN KEY (`actividad_id`) REFERENCES `actividad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `asignacion_actividad_ibfk_2` FOREIGN KEY (`trabajador_id`) REFERENCES `empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of asignacion_actividad
-- ----------------------------
INSERT INTO `asignacion_actividad` VALUES (1, 1, 2, 15.00, '2022-10-02', 1, 0);
INSERT INTO `asignacion_actividad` VALUES (2, 2, 2, 12.00, '2022-10-01', 1, 0);
INSERT INTO `asignacion_actividad` VALUES (3, 3, 1, 21.00, '2022-10-01', 1, 0);

-- ----------------------------
-- Table structure for caja_excel
-- ----------------------------
DROP TABLE IF EXISTS `caja_excel`;
CREATE TABLE `caja_excel`  (
  `id` int NULL DEFAULT NULL,
  `id_excel` int NULL DEFAULT NULL,
  `dia` char(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `caja` char(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `peso_prim` char(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `caja2` char(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `pes_seg` char(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `tipo_caja` char(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `contenedor` char(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `fecha_carga` date NULL DEFAULT NULL,
  INDEX `id_excel`(`id_excel` ASC) USING BTREE,
  CONSTRAINT `caja_excel_ibfk_1` FOREIGN KEY (`id_excel`) REFERENCES `archivo_caja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of caja_excel
-- ----------------------------
INSERT INTO `caja_excel` VALUES (1, 75, 'MARTES', '2018-01-02', '960', '40320', '30', '1500', 'DOLE ORGANICA', 'DFIU7112428', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (2, 75, 'MIÉRCOLES', '2018-01-03', '960', '39360', '20', '1000', 'DOLE ORGANICA', 'DFIU4220481', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (3, 75, 'JUEVES', '2018-01-04', '960', '39360', '35', '1750', 'DOLE CONVENCI', 'DFIU4236071', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (4, 75, 'LUNES', '2018-01-08', '960', '40320', '34', '1700', 'DOLE ORGANICA', 'DFIU4229215', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (5, 75, 'MARTES', '2018-01-09', '960', '40320', '34', '1700', 'DOLE ORGANICA', 'DFIU4221641', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (6, 75, 'MIÉRCOLES', '2018-01-10', '960', '40320', '26', '1300', 'DOLE ORGANICA', 'DFIU4238140', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (7, 75, 'JUEVES', '2018-01-11', '960', '40320', '67', '3350', 'DOLE CONVENCI', 'DFIU7120017', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (8, 75, 'LUNES', '2018-01-15', '960', '40320', '20', '1000', 'DOLE CONVENCI', 'DFIU4231491', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (9, 75, 'MARTES', '2018-01-16', '960', '40320', '14', '700', 'DOLE CONVENCI', 'DFIU4237572', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (10, 75, 'JUEVES', '2018-01-18', '960', '40320', '51', '2550', 'DOLE CONVENCI', 'DFIU8002087', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (11, 75, 'VIERNES', '2018-01-19', '960', '40320', '20', '1000', 'DOLE CONVENCI', 'DFIU4221718', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (12, 75, 'LUNES', '2018-01-22', '960', '40320', '30', '1500', 'DOLE CONVENCI', 'SEGU9128028', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (13, 75, 'MARTES', '2018-01-23', '960', '40320', '83', '4150', 'DOLE CONVENCI', 'DFIU4281785', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (14, 75, 'VIERNES', '2018-01-26', '960', '40320', '72', '3600', 'DOLE CONVENCI', 'DFIU4225288', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (15, 75, 'LUNES', '2018-01-29', '960', '40320', '', '', 'DOLE CONVENCI', 'DFIU4251332', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (16, 75, 'MARTES', '2018-01-30', '960', '40320', '69', '3450', 'DOLE CONVENCI', 'DFIU4232693', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (17, 75, 'VIERNES', '2018-02-02', '960', '40320', '34', '1700', 'CHIQUITA CONVE', 'PXU-0251', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (18, 75, 'LUNES', '2018-02-05', '960', '40320', '32', '1600', 'DOLE CONVENCI', 'DFIU4261515', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (19, 75, 'MARTES', '2018-02-06', '960', '40320', '49', '2450', 'DOLE CONVENCI', 'DFIU4201877', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (20, 75, 'VIERNES', '2018-02-09', '540', '22680', '76', '3800', 'CHIQUITA CONVE', 'EAG-0303', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (21, 75, 'MARTES', '2018-02-13', '960', '40320', '64', '3200', 'DOLE ORGANICA', 'DFIU4205487', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (22, 75, 'MIÉRCOLES', '2018-02-14', '960', '40320', '18', '900', 'DOLE ORGANICA', 'DFIU3320275', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (23, 75, 'LUNES', '2018-02-19', '960', '40320', '80', '4000', 'DOLE ORGANICA', 'DFIU4264495', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (24, 75, 'MARTES', '2018-02-20', '912', '38304', '19', '950', 'DOLE ORGANICA', 'DFIU3312726', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (25, 75, 'LUNES', '2018-02-26', '960', '40896', '47', '2350', 'DOLE CONVENCI', 'DFIU8002934', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (26, 75, 'MARTES', '2018-02-27', '960', '40896', '67', '3350', 'DOLE ORGANICA', 'SEGU9463957', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (27, 75, 'MIÉRCOLES', '2018-02-28', '960', '40896', '', '', 'DOLE CONVENCI', 'DTPU7210992', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (28, 75, 'LUNES', '2018-03-05', '960', '40896', '68', '3400', 'DOLE CONVENCI', 'DFIU4210061', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (29, 75, 'MARTES', '2018-03-06', '960', '40896', '57', '2850', 'DOLE ORGANICA', 'DFIU3300659', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (30, 75, 'VIERNES', '2018-03-09', '960', '40896', '45', '2250', 'DOLE ORGANICA', 'SZLU9899918', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (31, 75, 'LUNES', '2018-03-12', '960', '40896', '', '', 'DOLE ORGANICA', 'DFIU4220563', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (32, 75, 'MARTES', '2018-03-13', '960', '40320', '', '', 'DOLE ORGANICA', 'DTPU429045', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (33, 75, 'MIÉRCOLES', '2018-03-14', '960', '40320', '73', '3650', 'DOLE ORGANICA', 'DFIU4242726', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (34, 75, 'JUEVES', '2018-03-15', '960', '40320', '41', '2050', 'DOLE ORGANICA', 'DFIU4233025', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (35, 75, 'VIERNES', '2018-03-16', '384', '16128', '41', '2050', 'DOLE ORGANICA', 'DFIU7108290', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (36, 75, 'LUNES', '2018-03-19', '960', '40320', '25', '1250', 'DOLE ORGANICA', 'DFIU4261515', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (37, 75, 'MARTES', '2018-03-20', '960', '40320', '25', '1250', 'DOLE ORGANICA', 'DFIU7120038', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (38, 75, 'JUEVES', '2018-03-22', '960', '40320', '25', '1250', 'DOLE ORGANICA', 'DFIU4200989', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (39, 75, 'VIERNES', '2018-03-23', '960', '40320', '12', '600', 'DOLE ORGANICA', 'DFIU2150301', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (40, 75, 'LUNES', '2018-03-26', '960', '40320', '33', '1650', 'DOLE ORGANICA', 'DFIU4239147', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (41, 75, 'MARTES', '2018-03-27', '960', '40320', '33', '1650', 'DOLE ORGANICA', 'DFIU3300330', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (42, 75, 'JUEVES', '2018-03-30', '960', '40320', '33', '1650', 'DOLE ORGANICA', 'DFIU2600306', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (43, 75, 'LUNES', '2018-04-02', '960', '40320', '62', '3100', 'DOLE ORGANICA', 'DFIU3340348', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (44, 75, 'LUNES', '2018-04-09', '960', '40320', '29', '1450', 'DOLE ORGANICA', 'DFIU4231974', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (45, 75, 'MARTES', '2018-04-10', '960', '40320', '29', '1450', 'DOLE ORGANICA', 'DFIU8002770', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (46, 75, 'JUEVES', '2018-04-12', '960', '40320', '29', '1450', 'DOLE ORGANICA', 'CXRU1609656', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (47, 75, 'LUNES', '2018-04-16', '960', '40320', '34', '1700', 'DOLE ORGANICA', 'DFIU3321245', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (48, 75, 'MARTES', '2018-04-17', '960', '40320', '34', '1700', 'DOLE ORGANICA', 'DFIU7112412', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (49, 75, 'JUEVES', '2018-04-19', '960', '40320', '34', '1700', 'DOLE ORGANICA', 'SZLU9927244', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (50, 75, 'VIERNES', '2018-04-20', '864', '36288', '34', '1700', 'DOLE ORGANICA', 'DFIU7107226', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (51, 75, 'LUNES', '2018-04-23', '960', '40320', '', '', 'DOLE ORGANICA', 'DFIU4280520', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (52, 75, 'MARTES', '2018-04-24', '960', '40320', '75', '3750', 'DOLE ORGANICA', 'DFIU7221199', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (53, 75, 'JUEVES', '2018-04-26', '960', '40320', '', '', 'DOLE ORGANICA', 'DFIU7100216', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (54, 75, 'VIERNES', '2018-04-27', '960', '40320', '', '', 'DOLE ORGANICA', 'DFIU3320315', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (55, 75, 'LUNES', '2018-04-30', '960', '40320', '', '', 'DOLE ORGANICA', 'DFIU8110883', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (56, 75, 'MARTES', '2018-05-01', '960', '40320', '', '', 'DOLE ORGANICA', 'DFIU8123900', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (57, 75, 'LUNES', '2018-05-07', '960', '40320', '', '', 'DOLE ORGANICA', 'BMOU9826187', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (58, 75, 'MARTES', '2018-05-08', '960', '40320', '11', '550', 'DOLE ORGANICA', 'SEGU9127844', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (59, 75, 'LUNES', '2018-05-14', '528', '22176', '92', '4600', 'DOLE ORGANICA', 'PPH-0602', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (60, 75, 'MARTES', '2018-05-15', '960', '40320', '16', '800', 'DOLE ORGANICA', 'DFIU3333478', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (61, 75, 'LUNES', '2018-05-21', '960', '40320', '51', '2550', 'DOLE ORGANICA', 'CXRU1612768', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (62, 75, 'MARTES', '2018-05-22', '960', '40320', '51', '2550', 'DOLE ORGANICA', 'DFIU4264345', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (63, 75, 'LUNES', '2018-05-28', '960', '40320', '52', '2600', 'DOLE ORGANICA', 'DFIU4236934', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (64, 75, 'MARTES', '2018-05-29', '960', '40320', '53', '2650', 'DOLE ORGANICA', 'DFIU4239595', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (65, 75, 'LUNES', '2018-06-04', '960', '40320', '40', '2000', 'DOLE ORGANICA', 'DFIU4209040', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (66, 75, 'MARTES', '2018-06-05', '960', '40320', '37', '1850', 'DOLE ORGANICA', 'DFIU4209482', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (67, 75, 'LUNES', '2018-06-11', '960', '40320', '53', '2650', 'DOLE ORGANICA', 'DFIU8001630', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (68, 75, 'MARTES', '2018-06-12', '960', '40320', '53', '2650', 'DOLE ORGANICA', 'DFIU4203484', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (69, 75, 'LUNES', '2018-06-18', '960', '40320', '62', '3100', 'DOLE ORGANICA', 'DFIU7231324', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (70, 75, 'MARTES', '2018-06-19', '960', '40320', '23', '1150', 'DOLE ORGANICA', 'DFIU7202080', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (71, 75, 'LUNES', '2018-06-25', '960', '40320', '66', '3300', 'DOLE ORGANICA', 'DFIU7107930', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (72, 75, 'MARTES', '2018-06-26', '960', '40320', '66', '3300', 'DOLE ORGANICA', 'DFIU4238290', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (73, 75, 'LUNES', '2018-07-02', '960', '40320', '35', '1750', 'DOLE ORGANICA', 'DFIU2101800', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (74, 75, 'MARTES', '2018-07-03', '960', '40320', '40', '2000', 'DOLE ORGANICA', 'DFIU2152027', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (75, 75, 'VIERNES', '2018-07-06', '960', '40320', '46', '2300', 'DOLE ORGANICA', 'DFIU4235645', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (76, 75, 'LUNES', '2018-07-09', '960', '40320', '40', '2000', 'DOLE ORGANICA', 'DFIU7105877', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (77, 75, 'MARTES', '2018-07-10', '960', '40320', '40', '2000', 'DOLE ORGANICA', 'DFIU4204222', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (78, 75, 'VIERNES', '2018-07-13', '528', '22176', '40', '2000', 'DOLE ORGANICA', 'GPF-703', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (79, 75, 'LUNES', '2018-07-16', '960', '40320', '42', '2100', 'DOLE ORGANICA', 'DFIU7231113', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (80, 75, 'MARTES', '2018-07-17', '960', '40320', '29', '1450', 'DOLE ORGANICA', 'DFIU8102126', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (81, 75, 'SABADO', '2018-07-21', '962', '40404', '28', '1400', 'DOLE ORGANICA', 'DFIU7220973', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (82, 75, 'LUNES', '2018-07-23', '936', '39312', '26', '1300', 'DOLE ORGANICA', 'DFIU4237801', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (83, 75, 'MARTES', '2018-07-24', '960', '40320', '37', '1850', 'DOLE ORGANICA', 'DFIU4271513', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (84, 75, 'LUNES', '2018-07-30', '888', '37296', '46', '2300', 'DOLE ORGANICA', 'DFIU4264453', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (85, 75, 'MARTES', '2018-07-31', '960', '40320', '23', '1150', 'DOLE ORGANICA', 'DFIU3315690', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (86, 75, 'VIERNES', '2018-08-03', '960', '40320', '70', '3500', 'DOLE ORGANICA', 'HAA-1655', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (87, 75, 'LUNES', '2018-08-06', '960', '40320', '62', '3100', 'DOLE ORGANICA', 'DFIU4233508', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (88, 75, 'MARTES', '2018-08-07', '816', '34272', '26', '1300', 'DOLE ORGANICA', 'DFIU4281867', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (89, 75, 'VIERNES', '2018-08-10', '1080', '45360', '62', '3100', 'DOLE ORGANICA', 'GESU9529509', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (90, 75, 'LUNES', '2018-08-13', '960', '40320', '78', '3900', 'DOLE ORGANICA', 'DFIU8110564', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (91, 75, 'MARTES', '2018-08-14', '960', '40320', '25', '1250', 'DOLE ORGANICA', 'DFIU4271196', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (92, 75, 'VIERNES', '2018-08-17', '480', '20160', '8', '400', 'DOLE ORGANICA', 'GQS-0726', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (93, 75, 'LUNES', '2018-08-20', '960', '40320', '60', '3000', 'DOLE ORGANICA', 'DFIU4220440', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (94, 75, 'MARTES', '2018-08-21', '960', '40320', '50', '2500', 'DOLE ORGANICA', 'DFIU4241036', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (95, 75, 'VIERNES', '2018-08-24', '960', '40320', '47', '2350', 'DOLE ORGANICA', 'DFIU8122518', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (96, 75, 'LUNES', '2018-08-27', '960', '40320', '41', '2050', 'DOLE ORGANICA', 'DFIU4264330', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (97, 75, 'MARTES', '2018-08-28', '960', '40320', '49', '2450', 'DOLE ORGANICA', 'DFIU4233489', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (98, 75, 'VIERNES', '2018-08-31', '960', '40320', '114', '5700', 'DOLE ORGANICA', 'DFIU7201443', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (99, 75, 'LUNES', '2018-09-03', '864', '36288', '114', '5700', 'DOLE ORGANICA', 'DFIU4235028', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (100, 75, 'LUNES', '2018-09-10', '960', '40320', '142', '7100', 'DOLE ORGANICA', 'DFIU8122502', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (101, 75, 'MARTES', '2018-09-11', '960', '40320', '32', '1600', 'DOLE ORGANICA', 'DFIU4300484', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (102, 75, 'LUNES', '2018-09-17', '960', '40320', '76', '3800', 'DOLE ORGANICA', 'XRU1483866', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (103, 75, 'MARTES', '2018-09-18', '960', '40320', '51', '2550', 'DOLE ORGANICA', 'DFIU8102893', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (104, 75, 'VIERNES', '2018-09-21', '960', '40320', '26', '1300', 'DOLE ORGANICA', 'DFIU3324769', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (105, 75, 'LUNES', '2018-09-24', '912', '38304', '90', '4500', 'DOLE ORGANICA', 'DFIU3300411', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (106, 75, 'MARTES', '2018-09-25', '720', '30240', '44', '2200', 'DOLE ORGANICA', 'DFIU4261259', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (107, 75, 'LUNES', '2018-10-01', '960', '40320', '', '', 'DOLE ORGANICA', 'HAA-1655', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (108, 75, 'MARTES', '2018-10-02', '960', '40320', '62', '3100', 'DOLE ORGANICA', 'DFIU4231721', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (109, 75, 'LUNES', '2018-10-08', '960', '40320', '43', '2150', 'DOLE ORGANICA', 'DFIU3311756', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (110, 75, 'MARTES', '2018-10-09', '960', '40320', '34', '1700', 'DOLE ORGANICA', 'DFIU3337283', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (111, 75, 'LUNES', '2018-10-15', '960', '40320', '', '', 'DOLE ORGANICA', 'DFIU7102100', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (112, 75, 'MARTES', '2018-10-16', '960', '40320', '53', '2650', 'DOLE ORGANICA', 'DFIU4201917', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (113, 75, 'LUNES', '2018-10-22', '960', '40320', '15', '750', 'DOLE ORGANICA', 'DFIU3320296', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (114, 75, 'MARTES', '2018-10-23', '960', '40320', '38', '1900', 'DOLE ORGANICA', 'DFIU4230324', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (115, 75, 'LUNES', '2018-10-29', '960', '40320', '', '', 'DOLE ORGANICA', 'DFIU4236446', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (116, 75, 'MARTES', '2018-10-30', '960', '40320', '30', '1500', 'DOLE ORGANICA', 'DFIU4251121', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (117, 75, 'LUNES', '2018-10-05', '912', '38304', '22', '1100', 'DOLE ORGANICA', 'DFIU4250526', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (118, 75, 'MARTES', '2018-11-06', '960', '40320', '57', '2850', 'DOLE ORGANICA', 'DFIU4240528', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (119, 75, 'LUNES', '2018-11-12', '960', '40320', '29', '1450', 'DOLE ORGANICA', 'DTPU4291012', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (120, 75, 'MARTES', '2018-11-13', '960', '40320', '11', '550', 'DOLE ORGANICA', 'DFIU3342680', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (121, 75, 'SABADO', '2018-11-17', '960', '40320', '11', '550', 'DOLE CONVENCI', 'DFIU3321163', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (122, 75, 'LUNES', '2018-11-19', '960', '40320', '20', '1000', 'DOLE ORGANICA', 'DFIU4243281', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (123, 75, 'MARTES', '2018-11-20', '960', '40320', '97', '4850', 'DOLE ORGANICA', 'DFIU4255913', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (124, 75, 'LUNES', '2018-11-26', '960', '40320', '', '', 'DOLE ORGANICA', 'DFIU4264514', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (125, 75, 'VIERNES', '2018-11-30', '960', '40320', '', '', 'DOLE CONVENCI', 'DFIU4210035', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (126, 75, 'LUNES', '2018-12-03', '816', '34272', '', '', 'DOLE ORGANICA', 'DFIU424900', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (127, 75, 'VIERNES', '2018-12-07', '960', '40320', '17', '850', 'DOLE ORGANICA', 'DFIU4271350', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (128, 75, 'JUEVES', '2018-12-13', '960', '40320', '', '', 'DOLE ORGANICA', 'SEGU9128326', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (129, 75, 'VIERNES', '2018-12-14', '960', '40320', '42', '2100', 'DOLE ORGANICA', 'DFIU3322869', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (130, 75, 'LUNES', '2018-12-17', '960', '40320', '38', '1900', 'DOLE ORGANICA', 'DFIU7201607', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (131, 75, 'MIERCOLES', '2018-12-19', '480', '20160', '30', '1500', 'DOLE ORGANICA', 'LAD-811', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (132, 75, 'JUEVES', '2018-12-20', '960', '40320', '42', '2100', 'DOLE ORGANICA', 'DFIU4209158', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (133, 75, 'LUNES', '2018-12-24', '960', '40320', '', '', 'DOLE ORGANICA', 'DFIU8124552', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (134, 75, 'MIERCOLES', '2018-12-26', '960', '40320', '30', '1500', 'DOLE ORGANICA', 'DTPU2140001', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (135, 75, 'JUEVES', '2018-12-27', '960', '40320', '28', '1400', 'DOLE ORGANICA', 'DFIU4234910', 1, '2022-11-08');
INSERT INTO `caja_excel` VALUES (136, 75, 'VIERNES', '2018-12-28', '624', '26208', '9', '450', 'DOLE CONVENCI', 'DFIU7108686', 1, '2022-11-08');

-- ----------------------------
-- Table structure for compra_herramienta
-- ----------------------------
DROP TABLE IF EXISTS `compra_herramienta`;
CREATE TABLE `compra_herramienta`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `proveedor` int NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `numero_compra` char(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `tipo_comprobante` char(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `iva` int NULL DEFAULT NULL,
  `txt_totalneto` decimal(10, 2) NULL DEFAULT NULL,
  `txt_impuesto` decimal(10, 2) NULL DEFAULT NULL,
  `txt_a_pagar` decimal(10, 2) NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `proveedor`(`proveedor` ASC) USING BTREE,
  CONSTRAINT `compra_herramienta_ibfk_1` FOREIGN KEY (`proveedor`) REFERENCES `proveedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of compra_herramienta
-- ----------------------------
INSERT INTO `compra_herramienta` VALUES (5, 1, '2022-09-11', '20220605200640', 'Factura', 12, 123.00, 14.76, 137.76, 0);
INSERT INTO `compra_herramienta` VALUES (6, 1, '2022-09-11', '20220605190629', 'Factura', 12, 617205.00, 74064.60, 691269.60, 0);
INSERT INTO `compra_herramienta` VALUES (7, 1, '2022-09-11', '20220605190632', 'Notacompra', 0, 12468.00, 0.00, 12468.00, 0);
INSERT INTO `compra_herramienta` VALUES (8, 1, '2022-09-11', '20220605190633', 'Factura', 12, 623400.00, 74808.00, 698208.00, 0);
INSERT INTO `compra_herramienta` VALUES (9, 2, '2022-09-11', '0987654321', 'Factura', 12, 2456655.00, 294798.60, 2751453.60, 1);

-- ----------------------------
-- Table structure for compra_insumos
-- ----------------------------
DROP TABLE IF EXISTS `compra_insumos`;
CREATE TABLE `compra_insumos`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `proveedor` int NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `numero_compra` char(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `tipo_comprobante` char(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `iva` int NULL DEFAULT NULL,
  `txt_totalneto` decimal(10, 2) NULL DEFAULT NULL,
  `txt_impuesto` decimal(10, 2) NULL DEFAULT NULL,
  `txt_a_pagar` decimal(10, 2) NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `proveedor`(`proveedor` ASC) USING BTREE,
  CONSTRAINT `compra_insumos_ibfk_1` FOREIGN KEY (`proveedor`) REFERENCES `proveedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of compra_insumos
-- ----------------------------
INSERT INTO `compra_insumos` VALUES (10, 2, '2022-09-10', '20220605190633', 'Factura', 12, 15129.00, 1815.48, 16944.48, 0);
INSERT INTO `compra_insumos` VALUES (11, 2, '2022-09-10', '2022060554321', 'Factura', 12, 6888.00, 826.56, 7714.56, 0);
INSERT INTO `compra_insumos` VALUES (12, 2, '2022-09-10', '202206034545454', 'Factura', 12, 16671.50, 2000.58, 18672.08, 0);

-- ----------------------------
-- Table structure for desechos
-- ----------------------------
DROP TABLE IF EXISTS `desechos`;
CREATE TABLE `desechos`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `produccion_id` int NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `tipo` char(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `produccion_id`(`produccion_id` ASC) USING BTREE,
  CONSTRAINT `desechos_ibfk_1` FOREIGN KEY (`produccion_id`) REFERENCES `produccion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of desechos
-- ----------------------------
INSERT INTO `desechos` VALUES (2, 14, '2022-10-05', 'Desechos', 2);

-- ----------------------------
-- Table structure for detalle_compra_herramienta
-- ----------------------------
DROP TABLE IF EXISTS `detalle_compra_herramienta`;
CREATE TABLE `detalle_compra_herramienta`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_compra` int NULL DEFAULT NULL,
  `id_herramienta` int NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `descuento` decimal(10, 2) NULL DEFAULT NULL,
  `total` decimal(10, 2) NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_compra`(`id_compra` ASC) USING BTREE,
  INDEX `id_herramienta`(`id_herramienta` ASC) USING BTREE,
  CONSTRAINT `detalle_compra_herramienta_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra_herramienta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_compra_herramienta_ibfk_2` FOREIGN KEY (`id_herramienta`) REFERENCES `herramienta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detalle_compra_herramienta
-- ----------------------------
INSERT INTO `detalle_compra_herramienta` VALUES (1, 5, 1, 1, 123.00, 0.00, 123.00, 0);
INSERT INTO `detalle_compra_herramienta` VALUES (2, 6, 1, 100, 123.00, 0.00, 12300.00, 0);
INSERT INTO `detalle_compra_herramienta` VALUES (3, 6, 2, 49, 12345.00, 0.00, 604905.00, 0);
INSERT INTO `detalle_compra_herramienta` VALUES (4, 7, 1, 1, 123.00, 0.00, 123.00, 0);
INSERT INTO `detalle_compra_herramienta` VALUES (5, 7, 2, 1, 12345.00, 0.00, 12345.00, 0);
INSERT INTO `detalle_compra_herramienta` VALUES (6, 8, 2, 50, 12345.00, 0.00, 617250.00, 0);
INSERT INTO `detalle_compra_herramienta` VALUES (7, 8, 1, 50, 123.00, 0.00, 6150.00, 0);
INSERT INTO `detalle_compra_herramienta` VALUES (8, 9, 2, 199, 12345.00, 0.00, 2456655.00, 1);

-- ----------------------------
-- Table structure for detalle_compra_insumo
-- ----------------------------
DROP TABLE IF EXISTS `detalle_compra_insumo`;
CREATE TABLE `detalle_compra_insumo`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_compra` int NULL DEFAULT NULL,
  `id_insumo` int NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `descuento` decimal(10, 2) NULL DEFAULT NULL,
  `total` decimal(10, 2) NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_compra`(`id_compra` ASC) USING BTREE,
  INDEX `id_insumo`(`id_insumo` ASC) USING BTREE,
  CONSTRAINT `detalle_compra_insumo_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra_insumos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_compra_insumo_ibfk_2` FOREIGN KEY (`id_insumo`) REFERENCES `insumo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detalle_compra_insumo
-- ----------------------------
INSERT INTO `detalle_compra_insumo` VALUES (7, 10, 1, 123, 123.00, 0.00, 15129.00, 0);
INSERT INTO `detalle_compra_insumo` VALUES (8, 11, 1, 56, 123.00, 0.00, 6888.00, 0);
INSERT INTO `detalle_compra_insumo` VALUES (9, 12, 1, 99, 123.00, 0.00, 12177.00, 0);
INSERT INTO `detalle_compra_insumo` VALUES (10, 12, 2, 89, 50.50, 0.00, 4494.50, 0);

-- ----------------------------
-- Table structure for empleado
-- ----------------------------
DROP TABLE IF EXISTS `empleado`;
CREATE TABLE `empleado`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `apellidos` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `cedula` char(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `direccions` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `telefono` char(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `correo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `sexo` char(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of empleado
-- ----------------------------
INSERT INTO `empleado` VALUES (1, 'BACILIO', 'OMR', '2021-01-01', '0940321854', 'MILAGRO, AV. AMAZONAS', '098765443221', 'elgamer-26@hotmail.com', 'Masculino', 1);
INSERT INTO `empleado` VALUES (2, 'BACILIO TONTO', 'RAMIREZ ZAVALA', '2012-02-01', '0940321850', 'MILAGRO, AV. AMAZONAS', '1234567890', 'elgamer-26@hotmail.com', 'Masculino', 1);

-- ----------------------------
-- Table structure for empresa
-- ----------------------------
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa`  (
  `empresa_id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `ruc` char(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `telefono` char(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `correo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `actividad` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL,
  `encargado` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `telefono_encargado` char(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`empresa_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of empresa
-- ----------------------------
INSERT INTO `empresa` VALUES (1, 'ORGANICFRUIT.', '1111', 'direccion', '2222', 'oranfui@hormail.com', 'actividad', 'encargado', '444', 'img/empresa/IMG1192022192455.jpg');

-- ----------------------------
-- Table structure for encinte
-- ----------------------------
DROP TABLE IF EXISTS `encinte`;
CREATE TABLE `encinte`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `produccion_id` int NULL DEFAULT NULL,
  `cinta_id` int NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `detalle` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `produccion_id`(`produccion_id` ASC) USING BTREE,
  INDEX `cinta_id`(`cinta_id` ASC) USING BTREE,
  CONSTRAINT `encinte_ibfk_1` FOREIGN KEY (`produccion_id`) REFERENCES `produccion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `encinte_ibfk_2` FOREIGN KEY (`cinta_id`) REFERENCES `tipo_cinta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of encinte
-- ----------------------------
INSERT INTO `encinte` VALUES (1, 13, 1, '2022-10-06', 'PRIMEA COSECHA');
INSERT INTO `encinte` VALUES (2, 13, 2, '2022-10-04', 'REOGER EL BANANO');
INSERT INTO `encinte` VALUES (3, 13, 3, '2022-10-04', 'OTROMAS');
INSERT INTO `encinte` VALUES (4, 13, 4, '2022-10-04', 'aaaa');
INSERT INTO `encinte` VALUES (5, 13, 5, '2022-10-04', 'bbbbb');
INSERT INTO `encinte` VALUES (6, 13, 6, '2022-10-04', 'cccccc');
INSERT INTO `encinte` VALUES (7, 13, 7, '2022-10-04', 'ddddddd');
INSERT INTO `encinte` VALUES (16, 13, 8, '2022-10-04', 'finalizsdo');
INSERT INTO `encinte` VALUES (22, 12, 1, '2022-10-04', 'AS');
INSERT INTO `encinte` VALUES (23, 12, 2, '2022-10-04', 'as');
INSERT INTO `encinte` VALUES (27, 12, 3, '2022-10-04', 'sa');
INSERT INTO `encinte` VALUES (28, 12, 4, '2022-10-04', 'as');
INSERT INTO `encinte` VALUES (29, 12, 5, '2022-10-04', 'asasasa');
INSERT INTO `encinte` VALUES (30, 12, 6, '2022-10-04', 'ASASASA');
INSERT INTO `encinte` VALUES (31, 12, 7, '2022-10-04', 'ASASASAAAAAAAA');
INSERT INTO `encinte` VALUES (32, 12, 8, '2022-10-04', 'CCCCC');
INSERT INTO `encinte` VALUES (33, 14, 1, '2022-10-05', 'INICIO');

-- ----------------------------
-- Table structure for enfunde_excel
-- ----------------------------
DROP TABLE IF EXISTS `enfunde_excel`;
CREATE TABLE `enfunde_excel`  (
  `id` int NULL DEFAULT NULL,
  `id_excel` int NULL DEFAULT NULL,
  `id_cinta` int NULL DEFAULT NULL,
  `lote_1A` char(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `lote_1B` char(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `lote_1C` char(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `lote_2` char(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `lote_3` char(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `lote_4` char(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `lote_5` char(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `lote_6` char(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `lote_7` char(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `lote_8` char(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `lote_A` char(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `lote_B` char(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `lote_C` char(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `lote_D` char(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `total` char(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `fecha` date NULL DEFAULT NULL,
  INDEX `id_excel`(`id_excel` ASC) USING BTREE,
  INDEX `id_cinta`(`id_cinta` ASC) USING BTREE,
  CONSTRAINT `enfunde_excel_ibfk_1` FOREIGN KEY (`id_excel`) REFERENCES `archivo_enfunde` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `enfunde_excel_ibfk_2` FOREIGN KEY (`id_cinta`) REFERENCES `tipo_cinta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of enfunde_excel
-- ----------------------------
INSERT INTO `enfunde_excel` VALUES (1, 25, 1, '234', '202', '166', '774', '525', '439', '323', '248', '67', '108', '720', '839', '460', '87', '5192', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (2, 25, 2, '268', '194', '111', '610', '430', '358', '274', '212', '77', '126', '639', '594', '534', '113', '4540', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (3, 25, 3, '295', '239', '135', '711', '445', '404', '292', '269', '84', '119', '578', '598', '753', '155', '5077', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (4, 25, 4, '307', '203', '155', '570', '447', '356', '278', '196', '88', '101', '460', '520', '655', '122', '4458', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (5, 25, 5, '240', '213', '152', '628', '459', '414', '302', '199', '95', '132', '394', '433', '834', '180', '4675', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (6, 25, 6, '268', '176', '155', '657', '469', '399', '297', '250', '81', '93', '305', '297', '681', '157', '4285', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (7, 25, 7, '247', '175', '129', '569', '440', '418', '228', '213', '98', '121', '302', '276', '564', '168', '3948', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (8, 25, 8, '206', '171', '150', '542', '450', '384', '257', '161', '92', '92', '312', '264', '537', '139', '3757', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (9, 25, 1, '234', '165', '103', '588', '428', '406', '282', '232', '105', '132', '300', '216', '581', '155', '3927', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (10, 25, 2, '241', '166', '126', '476', '401', '338', '224', '174', '80', '107', '323', '207', '471', '154', '3488', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (11, 25, 3, '132', '139', '124', '427', '396', '342', '221', '180', '100', '84', '393', '190', '485', '136', '3349', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (12, 25, 4, '202', '151', '140', '424', '371', '373', '242', '211', '85', '88', '514', '270', '418', '94', '3583', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (13, 25, 5, '174', '205', '150', '480', '376', '342', '246', '204', '101', '86', '632', '291', '393', '104', '3784', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (14, 25, 6, '215', '168', '155', '346', '373', '325', '262', '156', '99', '96', '601', '343', '353', '143', '3635', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (15, 25, 7, '207', '199', '131', '557', '445', '355', '235', '186', '120', '76', '780', '433', '416', '110', '4250', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (16, 25, 8, '241', '157', '138', '550', '377', '375', '265', '228', '131', '95', '971', '540', '316', '100', '4484', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (17, 25, 1, '200', '202', '177', '575', '475', '412', '332', '251', '105', '83', '1108', '747', '357', '81', '5105', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (18, 25, 2, '292', '206', '187', '633', '498', '436', '257', '292', '199', '85', '1133', '735', '306', '69', '5328', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (19, 25, 3, '262', '227', '177', '642', '530', '453', '369', '286', '156', '94', '1110', '847', '279', '79', '5511', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (20, 25, 4, '256', '218', '187', '667', '540', '453', '323', '245', '142', '97', '859', '700', '271', '60', '5018', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (21, 25, 5, '258', '224', '204', '624', '450', '349', '278', '186', '140', '116', '834', '739', '310', '51', '4763', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (22, 25, 6, '215', '217', '167', '762', '515', '343', '292', '288', '132', '144', '823', '784', '309', '55', '5046', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (23, 25, 7, '233', '195', '180', '672', '504', '317', '280', '192', '95', '156', '679', '704', '306', '56', '4569', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (24, 25, 8, '327', '194', '125', '616', '357', '331', '240', '208', '100', '110', '545', '618', '356', '62', '4189', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (25, 25, 1, '247', '189', '150', '644', '423', '328', '210', '158', '94', '91', '488', '465', '346', '57', '3890', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (26, 25, 2, '202', '122', '118', '507', '360', '304', '193', '167', '84', '102', '478', '540', '326', '51', '3554', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (27, 25, 3, '208', '117', '124', '532', '372', '234', '189', '133', '63', '80', '451', '513', '402', '81', '3499', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (28, 25, 4, '239', '152', '112', '489', '332', '268', '158', '152', '95', '116', '467', '533', '404', '71', '3588', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (29, 25, 5, '202', '151', '112', '473', '247', '306', '227', '166', '91', '107', '452', '430', '380', '100', '3444', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (30, 25, 6, '205', '126', '106', '417', '318', '237', '205', '146', '65', '81', '472', '384', '408', '73', '3243', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (31, 25, 7, '206', '139', '111', '456', '325', '232', '179', '161', '50', '82', '378', '383', '419', '93', '3214', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (32, 25, 8, '206', '153', '123', '432', '353', '212', '192', '120', '75', '86', '401', '367', '402', '85', '3207', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (33, 25, 1, '217', '131', '106', '445', '290', '254', '177', '127', '73', '64', '385', '303', '520', '102', '3194', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (34, 25, 2, '198', '142', '139', '527', '338', '300', '194', '170', '55', '79', '405', '345', '548', '123', '3563', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (35, 25, 3, '223', '149', '115', '452', '332', '272', '169', '160', '66', '100', '414', '316', '463', '108', '3339', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (36, 25, 4, '194', '187', '111', '508', '356', '297', '231', '131', '68', '80', '421', '314', '489', '135', '3522', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (37, 25, 5, '215', '129', '115', '443', '416', '323', '184', '141', '68', '93', '442', '303', '437', '112', '3421', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (38, 25, 6, '216', '151', '123', '539', '371', '341', '216', '171', '72', '64', '470', '362', '383', '105', '3584', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (39, 25, 7, '199', '146', '93', '527', '397', '294', '239', '161', '77', '82', '496', '312', '423', '122', '3568', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (40, 25, 8, '218', '166', '133', '534', '397', '316', '238', '219', '87', '97', '539', '293', '361', '104', '3702', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (41, 25, 1, '196', '146', '122', '491', '414', '345', '209', '167', '95', '71', '544', '299', '321', '103', '3523', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (42, 25, 2, '170', '141', '124', '408', '386', '290', '201', '117', '91', '82', '453', '323', '293', '89', '3168', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (43, 25, 3, '218', '145', '119', '445', '403', '329', '223', '172', '76', '94', '598', '343', '329', '97', '3591', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (44, 25, 4, '189', '143', '122', '490', '344', '288', '218', '178', '82', '82', '639', '414', '290', '76', '3555', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (45, 25, 5, '179', '151', '89', '432', '390', '307', '196', '154', '95', '97', '615', '497', '305', '80', '3587', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (46, 25, 6, '193', '192', '130', '470', '400', '364', '230', '181', '82', '83', '658', '488', '303', '64', '3838', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (47, 25, 7, '205', '200', '141', '512', '443', '305', '266', '163', '81', '83', '702', '578', '316', '85', '4080', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (48, 25, 8, '216', '138', '130', '490', '493', '351', '297', '181', '91', '94', '757', '630', '322', '67', '4257', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (49, 25, 1, '216', '167', '146', '505', '420', '291', '261', '221', '105', '79', '835', '590', '301', '64', '4201', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (50, 25, 2, '241', '198', '174', '481', '406', '310', '290', '207', '106', '77', '791', '629', '272', '51', '4233', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (51, 25, 3, '239', '219', '181', '601', '540', '380', '283', '238', '76', '100', '850', '757', '335', '74', '4873', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (52, 25, 4, '305', '238', '183', '610', '492', '354', '333', '219', '131', '94', '740', '645', '328', '85', '4757', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (1, 26, 1, '302', '167', '185', '684', '489', '356', '366', '206', '117', '109', '758', '578', '335', '53', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (2, 26, 2, '288', '275', '214', '708', '548', '369', '373', '241', '101', '143', '763', '701', '401', '81', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (3, 26, 3, '300', '213', '175', '707', '528', '337', '243', '239', '108', '126', '649', '521', '371', '63', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (4, 26, 4, '278', '191', '206', '673', '546', '341', '320', '231', '122', '86', '519', '544', '382', '72', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (5, 26, 5, '272', '165', '152', '754', '558', '454', '262', '259', '120', '130', '586', '515', '408', '80', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (6, 26, 6, '300', '206', '128', '693', '458', '293', '252', '182', '97', '130', '572', '437', '381', '75', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (7, 26, 7, '236', '155', '140', '595', '450', '361', '225', '165', '83', '90', '500', '418', '362', '83', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (8, 26, 8, '265', '160', '155', '604', '413', '302', '230', '198', '95', '101', '498', '404', '436', '103', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (9, 26, 1, '249', '167', '138', '626', '414', '297', '213', '197', '101', '109', '429', '443', '515', '177', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (10, 26, 2, '253', '178', '123', '605', '369', '355', '252', '184', '58', '101', '584', '392', '493', '88', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (11, 26, 3, '255', '140', '160', '518', '296', '273', '227', '178', '83', '93', '406', '475', '497', '143', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (12, 26, 4, '255', '145', '133', '499', '383', '316', '209', '156', '77', '94', '431', '401', '498', '90', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (13, 26, 5, '283', '134', '139', '596', '378', '352', '223', '220', '108', '126', '564', '424', '477', '156', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (14, 26, 6, '256', '177', '123', '529', '344', '272', '208', '150', '74', '73', '581', '403', '469', '123', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (15, 26, 7, '252', '230', '155', '551', '414', '351', '243', '231', '75', '82', '794', '578', '506', '130', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (16, 26, 8, '234', '200', '173', '624', '375', '432', '318', '180', '84', '102', '917', '635', '569', '160', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (17, 26, 1, '272', '286', '133', '702', '434', '396', '337', '191', '117', '132', '843', '537', '483', '110', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (18, 26, 2, '229', '195', '151', '650', '487', '490', '289', '220', '137', '95', '774', '726', '472', '131', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (19, 26, 3, '287', '170', '133', '630', '402', '346', '352', '264', '111', '120', '858', '684', '443', '140', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (20, 26, 4, '215', '198', '169', '721', '335', '467', '291', '193', '104', '116', '728', '619', '410', '120', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (21, 26, 5, '269', '188', '144', '586', '492', '353', '306', '226', '111', '129', '712', '571', '409', '106', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (22, 26, 6, '213', '203', '148', '618', '464', '416', '318', '261', '82', '96', '675', '637', '396', '101', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (23, 26, 7, '206', '170', '168', '620', '434', '363', '207', '210', '212', '112', '690', '540', '389', '78', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (24, 26, 8, '208', '188', '144', '562', '459', '402', '300', '223', '101', '122', '681', '514', '309', '72', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (25, 26, 1, '220', '184', '134', '622', '430', '342', '256', '220', '124', '96', '625', '502', '325', '67', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (26, 26, 2, '317', '180', '161', '536', '443', '334', '251', '198', '101', '100', '628', '479', '361', '66', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (27, 26, 3, '154', '153', '153', '494', '403', '282', '171', '137', '83', '68', '539', '443', '370', '62', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (28, 26, 4, '169', '143', '119', '477', '396', '283', '205', '144', '96', '83', '538', '355', '254', '59', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (29, 26, 5, '124', '118', '130', '379', '340', '274', '110', '162', '76', '26', '532', '333', '290', '45', '', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (30, 26, 6, '261', '193', '164', '511', '469', '216', '191', '149', '102', '97', '555', '494', '331', '76', '14', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (31, 26, 7, '212', '151', '122', '573', '380', '288', '166', '113', '60', '92', '488', '450', '336', '93', '63', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (32, 26, 8, '201', '132', '124', '469', '326', '241', '205', '124', '79', '61', '488', '370', '372', '66', '333', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (33, 26, 1, '233', '128', '133', '480', '360', '271', '162', '115', '64', '74', '541', '443', '277', '49', '843', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (34, 26, 2, '177', '143', '124', '460', '368', '214', '149', '113', '87', '58', '465', '350', '292', '76', '889', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (35, 26, 3, '236', '154', '189', '515', '348', '220', '256', '154', '53', '78', '499', '421', '269', '71', '1504', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (36, 26, 4, '262', '129', '100', '515', '374', '295', '164', '138', '54', '79', '502', '371', '352', '92', '1368', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (37, 26, 5, '238', '149', '147', '653', '363', '225', '256', '159', '52', '59', '511', '433', '343', '78', '1432', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (38, 26, 6, '278', '169', '137', '585', '413', '260', '247', '170', '53', '83', '509', '435', '442', '82', '1401', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (39, 26, 7, '314', '161', '147', '646', '457', '378', '232', '189', '61', '74', '547', '357', '332', '51', '1387', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (40, 26, 8, '227', '162', '119', '563', '356', '263', '285', '175', '63', '73', '464', '320', '379', '108', '1236', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (41, 26, 1, '283', '177', '173', '641', '386', '336', '233', '174', '69', '101', '547', '417', '360', '83', '1190', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (42, 26, 2, '280', '134', '132', '576', '343', '324', '242', '161', '76', '87', '522', '350', '328', '66', '960', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (43, 26, 3, '240', '134', '100', '586', '345', '362', '239', '210', '101', '83', '603', '461', '376', '81', '560', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (44, 26, 4, '234', '170', '128', '502', '392', '327', '203', '153', '85', '107', '464', '456', '372', '100', '489', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (45, 26, 5, '276', '115', '121', '585', '358', '378', '225', '173', '71', '80', '646', '397', '365', '98', '380', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (46, 26, 6, '240', '149', '113', '500', '339', '323', '225', '193', '105', '85', '555', '446', '354', '94', '261', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (47, 26, 7, '213', '146', '104', '440', '311', '345', '179', '168', '54', '75', '643', '378', '315', '76', '175', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (48, 26, 8, '187', '138', '99', '506', '300', '305', '180', '147', '69', '56', '571', '510', '309', '75', '148', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (49, 26, 1, '195', '175', '132', '476', '368', '362', '246', '194', '97', '96', '711', '478', '373', '102', '106', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (50, 26, 2, '230', '169', '105', '472', '318', '338', '195', '139', '97', '90', '552', '456', '354', '92', '121', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (51, 26, 3, '188', '120', '123', '490', '316', '354', '182', '139', '95', '70', '560', '511', '339', '62', '70', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (52, 26, 4, '187', '212', '142', '453', '416', '357', '295', '151', '73', '72', '719', '521', '366', '84', '83', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (1, 27, 1, '215', '130', '138', '548', '399', '368', '271', '175', '125', '80', '625', '575', '359', '105', '53', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (2, 27, 2, '350', '190', '148', '595', '429', '365', '238', '218', '79', '106', '867', '476', '393', '111', '88', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (3, 27, 3, '319', '245', '182', '725', '521', '487', '329', '253', '103', '135', '699', '548', '517', '100', '93', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (4, 27, 4, '339', '231', '127', '725', '439', '310', '299', '255', '110', '86', '752', '583', '391', '106', '105', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (5, 27, 5, '237', '200', '148', '672', '472', '345', '254', '235', '110', '121', '576', '567', '356', '79', '166', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (6, 27, 6, '234', '163', '160', '585', '440', '329', '268', '221', '113', '62', '511', '492', '351', '64', '199', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (7, 27, 7, '240', '183', '182', '710', '457', '421', '274', '192', '116', '90', '563', '478', '351', '90', '383', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (8, 27, 8, '290', '182', '160', '650', '480', '358', '271', '191', '102', '125', '469', '459', '375', '77', '511', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (9, 27, 1, '243', '202', '196', '722', '544', '389', '244', '189', '113', '76', '537', '452', '323', '87', '783', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (10, 27, 2, '205', '182', '162', '454', '470', '353', '205', '153', '88', '73', '485', '394', '340', '89', '807', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (11, 27, 3, '224', '182', '134', '546', '405', '319', '270', '154', '99', '77', '507', '394', '372', '95', '917', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (12, 27, 4, '184', '177', '134', '534', '442', '292', '205', '173', '81', '70', '432', '426', '387', '88', '1097', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (13, 27, 5, '239', '223', '132', '566', '384', '261', '265', '153', '72', '94', '573', '461', '368', '68', '1140', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (14, 27, 6, '266', '155', '142', '452', '348', '248', '185', '133', '71', '117', '584', '392', '375', '69', '1081', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (15, 27, 7, '190', '140', '126', '456', '349', '234', '258', '148', '63', '85', '461', '468', '380', '90', '1106', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (16, 27, 8, '248', '200', '143', '514', '430', '245', '199', '157', '77', '72', '670', '533', '406', '107', '1129', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (17, 27, 1, '271', '185', '149', '645', '365', '268', '227', '171', '82', '92', '549', '519', '420', '93', '1034', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (18, 27, 2, '288', '195', '135', '557', '435', '310', '252', '195', '85', '81', '671', '580', '424', '99', '940', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (19, 27, 3, '322', '164', '189', '568', '352', '278', '262', '200', '73', '117', '744', '533', '461', '97', '795', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (20, 27, 4, '282', '203', '169', '603', '416', '367', '322', '264', '68', '105', '684', '589', '507', '112', '518', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (21, 27, 5, '287', '165', '195', '704', '385', '295', '226', '178', '122', '95', '785', '636', '449', '99', '415', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (22, 27, 6, '294', '170', '111', '504', '390', '335', '215', '184', '89', '105', '639', '457', '340', '91', '297', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (23, 27, 7, '265', '147', '113', '722', '402', '387', '271', '165', '62', '85', '665', '521', '430', '86', '240', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (24, 27, 8, '244', '172', '119', '487', '378', '333', '197', '153', '86', '89', '629', '470', '354', '84', '179', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (25, 27, 1, '246', '120', '121', '571', '310', '326', '204', '164', '87', '89', '628', '451', '344', '78', '127', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (26, 27, 2, '266', '175', '124', '493', '315', '297', '222', '170', '72', '72', '577', '435', '304', '91', '131', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (27, 27, 3, '181', '150', '102', '517', '301', '296', '200', '157', '70', '56', '402', '365', '317', '84', '98', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (28, 27, 4, '239', '130', '113', '442', '260', '268', '155', '140', '52', '75', '393', '322', '278', '83', '102', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (29, 27, 5, '200', '155', '118', '414', '285', '269', '177', '119', '75', '58', '437', '292', '252', '71', '100', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (30, 27, 6, '150', '112', '76', '378', '297', '278', '126', '108', '39', '63', '387', '320', '238', '42', '104', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (31, 27, 7, '172', '133', '102', '410', '277', '225', '175', '142', '48', '66', '443', '348', '286', '55', '143', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (32, 27, 8, '163', '92', '92', '399', '258', '250', '135', '113', '60', '62', '365', '342', '251', '54', '174', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (33, 27, 1, '200', '142', '134', '439', '277', '125', '176', '134', '42', '58', '506', '421', '292', '53', '365', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (34, 27, 2, '179', '125', '94', '402', '307', '388', '180', '160', '56', '57', '473', '365', '280', '92', '662', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (35, 27, 3, '140', '122', '99', '441', '275', '260', '154', '111', '46', '50', '439', '381', '278', '67', '978', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (36, 27, 4, '198', '145', '96', '468', '314', '241', '166', '134', '73', '44', '458', '357', '287', '59', '1724', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (37, 27, 5, '175', '160', '114', '511', '364', '337', '236', '154', '69', '51', '555', '393', '306', '101', '1839', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (38, 27, 6, '238', '252', '113', '606', '395', '286', '237', '182', '63', '80', '554', '375', '371', '82', '2202', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (39, 27, 7, '213', '135', '117', '557', '402', '355', '248', '197', '79', '55', '556', '405', '386', '80', '2045', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (40, 27, 8, '220', '166', '129', '544', '426', '311', '223', '171', '90', '79', '491', '379', '360', '81', '1637', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (41, 27, 1, '220', '220', '121', '658', '471', '327', '276', '198', '77', '63', '585', '415', '329', '94', '1633', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (42, 27, 2, '202', '204', '152', '541', '455', '355', '239', '231', '100', '90', '645', '482', '391', '82', '1457', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (43, 27, 3, '215', '137', '175', '637', '455', '330', '309', '186', '78', '68', '652', '404', '396', '96', '1506', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (44, 27, 4, '240', '222', '127', '516', '407', '380', '263', '231', '80', '91', '549', '484', '319', '87', '978', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (45, 27, 5, '290', '150', '170', '529', '397', '259', '243', '166', '87', '67', '517', '442', '378', '66', '955', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (46, 27, 6, '205', '169', '149', '516', '390', '280', '182', '125', '113', '102', '530', '441', '343', '70', '981', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (47, 27, 7, '200', '156', '128', '514', '393', '333', '210', '156', '76', '78', '482', '447', '363', '76', '940', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (48, 27, 8, '214', '146', '116', '474', '366', '276', '177', '135', '70', '76', '542', '394', '330', '83', '755', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (49, 27, 1, '210', '166', '145', '463', '364', '240', '238', '144', '78', '67', '440', '473', '304', '65', '674', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (50, 27, 2, '199', '135', '105', '444', '309', '266', '174', '126', '44', '68', '458', '426', '329', '61', '586', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (51, 27, 3, '210', '145', '115', '445', '358', '261', '185', '148', '82', '63', '570', '400', '300', '71', '603', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (52, 27, 4, '229', '157', '170', '457', '322', '257', '215', '187', '72', '51', '530', '513', '358', '72', '488', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (53, 27, 5, '230', '144', '121', '489', '403', '366', '213', '140', '58', '78', '540', '570', '373', '70', '553', 1, '2022-10-28');
INSERT INTO `enfunde_excel` VALUES (1, 28, 1, '234', '202', '166', '774', '525', '439', '323', '248', '67', '108', '720', '839', '460', '87', '5192', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (2, 28, 2, '268', '194', '111', '610', '430', '358', '274', '212', '77', '126', '639', '594', '534', '113', '4540', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (3, 28, 3, '295', '239', '135', '711', '445', '404', '292', '269', '84', '119', '578', '598', '753', '155', '5077', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (4, 28, 4, '307', '203', '155', '570', '447', '356', '278', '196', '88', '101', '460', '520', '655', '122', '4458', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (5, 28, 5, '240', '213', '152', '628', '459', '414', '302', '199', '95', '132', '394', '433', '834', '180', '4675', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (6, 28, 6, '268', '176', '155', '657', '469', '399', '297', '250', '81', '93', '305', '297', '681', '157', '4285', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (7, 28, 7, '247', '175', '129', '569', '440', '418', '228', '213', '98', '121', '302', '276', '564', '168', '3948', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (8, 28, 8, '206', '171', '150', '542', '450', '384', '257', '161', '92', '92', '312', '264', '537', '139', '3757', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (9, 28, 1, '234', '165', '103', '588', '428', '406', '282', '232', '105', '132', '300', '216', '581', '155', '3927', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (10, 28, 2, '241', '166', '126', '476', '401', '338', '224', '174', '80', '107', '323', '207', '471', '154', '3488', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (11, 28, 3, '132', '139', '124', '427', '396', '342', '221', '180', '100', '84', '393', '190', '485', '136', '3349', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (12, 28, 4, '202', '151', '140', '424', '371', '373', '242', '211', '85', '88', '514', '270', '418', '94', '3583', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (13, 28, 5, '174', '205', '150', '480', '376', '342', '246', '204', '101', '86', '632', '291', '393', '104', '3784', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (14, 28, 6, '215', '168', '155', '346', '373', '325', '262', '156', '99', '96', '601', '343', '353', '143', '3635', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (15, 28, 7, '207', '199', '131', '557', '445', '355', '235', '186', '120', '76', '780', '433', '416', '110', '4250', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (16, 28, 8, '241', '157', '138', '550', '377', '375', '265', '228', '131', '95', '971', '540', '316', '100', '4484', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (17, 28, 1, '200', '202', '177', '575', '475', '412', '332', '251', '105', '83', '1108', '747', '357', '81', '5105', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (18, 28, 2, '292', '206', '187', '633', '498', '436', '257', '292', '199', '85', '1133', '735', '306', '69', '5328', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (19, 28, 3, '262', '227', '177', '642', '530', '453', '369', '286', '156', '94', '1110', '847', '279', '79', '5511', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (20, 28, 4, '256', '218', '187', '667', '540', '453', '323', '245', '142', '97', '859', '700', '271', '60', '5018', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (21, 28, 5, '258', '224', '204', '624', '450', '349', '278', '186', '140', '116', '834', '739', '310', '51', '4763', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (22, 28, 6, '215', '217', '167', '762', '515', '343', '292', '288', '132', '144', '823', '784', '309', '55', '5046', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (23, 28, 7, '233', '195', '180', '672', '504', '317', '280', '192', '95', '156', '679', '704', '306', '56', '4569', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (24, 28, 8, '327', '194', '125', '616', '357', '331', '240', '208', '100', '110', '545', '618', '356', '62', '4189', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (25, 28, 1, '247', '189', '150', '644', '423', '328', '210', '158', '94', '91', '488', '465', '346', '57', '3890', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (26, 28, 2, '202', '122', '118', '507', '360', '304', '193', '167', '84', '102', '478', '540', '326', '51', '3554', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (27, 28, 3, '208', '117', '124', '532', '372', '234', '189', '133', '63', '80', '451', '513', '402', '81', '3499', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (28, 28, 4, '239', '152', '112', '489', '332', '268', '158', '152', '95', '116', '467', '533', '404', '71', '3588', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (29, 28, 5, '202', '151', '112', '473', '247', '306', '227', '166', '91', '107', '452', '430', '380', '100', '3444', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (30, 28, 6, '205', '126', '106', '417', '318', '237', '205', '146', '65', '81', '472', '384', '408', '73', '3243', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (31, 28, 7, '206', '139', '111', '456', '325', '232', '179', '161', '50', '82', '378', '383', '419', '93', '3214', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (32, 28, 8, '206', '153', '123', '432', '353', '212', '192', '120', '75', '86', '401', '367', '402', '85', '3207', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (33, 28, 1, '217', '131', '106', '445', '290', '254', '177', '127', '73', '64', '385', '303', '520', '102', '3194', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (34, 28, 2, '198', '142', '139', '527', '338', '300', '194', '170', '55', '79', '405', '345', '548', '123', '3563', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (35, 28, 3, '223', '149', '115', '452', '332', '272', '169', '160', '66', '100', '414', '316', '463', '108', '3339', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (36, 28, 4, '194', '187', '111', '508', '356', '297', '231', '131', '68', '80', '421', '314', '489', '135', '3522', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (37, 28, 5, '215', '129', '115', '443', '416', '323', '184', '141', '68', '93', '442', '303', '437', '112', '3421', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (38, 28, 6, '216', '151', '123', '539', '371', '341', '216', '171', '72', '64', '470', '362', '383', '105', '3584', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (39, 28, 7, '199', '146', '93', '527', '397', '294', '239', '161', '77', '82', '496', '312', '423', '122', '3568', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (40, 28, 8, '218', '166', '133', '534', '397', '316', '238', '219', '87', '97', '539', '293', '361', '104', '3702', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (41, 28, 1, '196', '146', '122', '491', '414', '345', '209', '167', '95', '71', '544', '299', '321', '103', '3523', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (42, 28, 2, '170', '141', '124', '408', '386', '290', '201', '117', '91', '82', '453', '323', '293', '89', '3168', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (43, 28, 3, '218', '145', '119', '445', '403', '329', '223', '172', '76', '94', '598', '343', '329', '97', '3591', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (44, 28, 4, '189', '143', '122', '490', '344', '288', '218', '178', '82', '82', '639', '414', '290', '76', '3555', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (45, 28, 5, '179', '151', '89', '432', '390', '307', '196', '154', '95', '97', '615', '497', '305', '80', '3587', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (46, 28, 6, '193', '192', '130', '470', '400', '364', '230', '181', '82', '83', '658', '488', '303', '64', '3838', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (47, 28, 7, '205', '200', '141', '512', '443', '305', '266', '163', '81', '83', '702', '578', '316', '85', '4080', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (48, 28, 8, '216', '138', '130', '490', '493', '351', '297', '181', '91', '94', '757', '630', '322', '67', '4257', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (49, 28, 1, '216', '167', '146', '505', '420', '291', '261', '221', '105', '79', '835', '590', '301', '64', '4201', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (50, 28, 2, '241', '198', '174', '481', '406', '310', '290', '207', '106', '77', '791', '629', '272', '51', '4233', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (51, 28, 3, '239', '219', '181', '601', '540', '380', '283', '238', '76', '100', '850', '757', '335', '74', '4873', 1, '2022-11-08');
INSERT INTO `enfunde_excel` VALUES (52, 28, 4, '305', '238', '183', '610', '492', '354', '333', '219', '131', '94', '740', '645', '328', '85', '4757', 1, '2022-11-08');

-- ----------------------------
-- Table structure for hectarea
-- ----------------------------
DROP TABLE IF EXISTS `hectarea`;
CREATE TABLE `hectarea`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `lote_id` int NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `lote_id`(`lote_id` ASC) USING BTREE,
  CONSTRAINT `hectarea_ibfk_1` FOREIGN KEY (`lote_id`) REFERENCES `lote` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of hectarea
-- ----------------------------
INSERT INTO `hectarea` VALUES (3, 5, 'H1', 1);
INSERT INTO `hectarea` VALUES (4, 5, 'H2', 1);
INSERT INTO `hectarea` VALUES (5, 5, 'H3', 1);
INSERT INTO `hectarea` VALUES (6, 6, 'H1', 1);
INSERT INTO `hectarea` VALUES (7, 6, 'H2', 1);
INSERT INTO `hectarea` VALUES (8, 7, 'H1', 1);
INSERT INTO `hectarea` VALUES (9, 7, 'H2', 1);
INSERT INTO `hectarea` VALUES (10, 7, 'H3', 1);

-- ----------------------------
-- Table structure for herramienta
-- ----------------------------
DROP TABLE IF EXISTS `herramienta`;
CREATE TABLE `herramienta`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` char(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `marca` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `tipo` int NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT 0,
  `descripcion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL,
  `ruta` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `eliminado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tipo`(`tipo` ASC) USING BTREE,
  CONSTRAINT `herramienta_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipo_herramienta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of herramienta
-- ----------------------------
INSERT INTO `herramienta` VALUES (1, '7840484', 'Nombre herramienta ', 'Marca herramienta ', 1, 123.00, 982, 'Descripción', 'img/herramienta/IMG992022211949.png', 1, 1);
INSERT INTO `herramienta` VALUES (2, '1234567890', 'Nombre herramienta editado', 'Marca herramienta editado', 1, 12345.00, 893, 'Descripción editado', 'img/herramienta/IMG99202221196.png', 1, 1);

-- ----------------------------
-- Table structure for insumo
-- ----------------------------
DROP TABLE IF EXISTS `insumo`;
CREATE TABLE `insumo`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` char(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `marca` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `tipo` int NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT 0,
  `descripcion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL,
  `ruta` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `eliminado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tipo`(`tipo` ASC) USING BTREE,
  CONSTRAINT `insumo_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipo_insumo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of insumo
-- ----------------------------
INSERT INTO `insumo` VALUES (1, '8744182', 'aaaa', 'bbb', 1, 123.00, 1217, 'Descripción', 'img/insumo/IMG992022193455.png', 1, 1);
INSERT INTO `insumo` VALUES (2, '8744180', 'Nombre insumo ', 'Marca insumo ', 1, 50.50, 1210, 'Descripción para cortar monte', 'img/insumo/IMG992022193443.jpg', 1, 1);

-- ----------------------------
-- Table structure for lote
-- ----------------------------
DROP TABLE IF EXISTS `lote`;
CREATE TABLE `lote`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of lote
-- ----------------------------
INSERT INTO `lote` VALUES (5, 'LOTE 1A', 1);
INSERT INTO `lote` VALUES (6, 'LOTE 1B', 1);
INSERT INTO `lote` VALUES (7, 'LOTE 1C', 1);

-- ----------------------------
-- Table structure for permisos
-- ----------------------------
DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_rol` int NULL DEFAULT NULL,
  `usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `empresa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `insumo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `herramienta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `proveedor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `c_insumo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `c_herramienta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `actividades` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `trabajadores` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `asignar_actividad` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `cintas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `lotes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `produccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `encinte` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `frutas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `proceso_cajas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `data_cajas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `proceso_enfunde` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `data_enfunde` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `proceso_recobro` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `data_recobro` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `proceso_produccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `data_produccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `prediccion_cajas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `prediccion_enfunde` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `prediccion_recobro` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `prediccion_produccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `informes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_rol`(`id_rol` ASC) USING BTREE,
  CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`rol_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permisos
-- ----------------------------
INSERT INTO `permisos` VALUES (1, 7, 'false', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'true');
INSERT INTO `permisos` VALUES (2, 1, 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true');
INSERT INTO `permisos` VALUES (3, 2, 'true', 'false', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'true', 'true', 'true', 'true', 'true');
INSERT INTO `permisos` VALUES (4, 3, 'false', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'true');

-- ----------------------------
-- Table structure for produccion
-- ----------------------------
DROP TABLE IF EXISTS `produccion`;
CREATE TABLE `produccion`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `f_i` date NULL DEFAULT NULL,
  `f_f` date NULL DEFAULT NULL,
  `usuario_id` int NULL DEFAULT NULL,
  `lote_id` int NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `lote_id`(`lote_id` ASC) USING BTREE,
  INDEX `usuario_id`(`usuario_id` ASC) USING BTREE,
  CONSTRAINT `produccion_ibfk_1` FOREIGN KEY (`lote_id`) REFERENCES `lote` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `produccion_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of produccion
-- ----------------------------
INSERT INTO `produccion` VALUES (12, 'produccion de banano', '2022-10-04', '2023-10-02', 1, 5, 2);
INSERT INTO `produccion` VALUES (13, 'OTRA PRODUCCION', '2022-10-04', '2023-03-01', 1, 6, 2);
INSERT INTO `produccion` VALUES (14, 'abc', '2022-10-05', '2022-11-01', 1, 5, 1);
INSERT INTO `produccion` VALUES (15, 'aaaa', '2022-11-15', '2022-12-07', 1, 5, 1);

-- ----------------------------
-- Table structure for produccion_actividades
-- ----------------------------
DROP TABLE IF EXISTS `produccion_actividades`;
CREATE TABLE `produccion_actividades`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `produccion_id` int NULL DEFAULT NULL,
  `actividad_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `produccion_id`(`produccion_id` ASC) USING BTREE,
  INDEX `actividad_id`(`actividad_id` ASC) USING BTREE,
  CONSTRAINT `produccion_actividades_ibfk_1` FOREIGN KEY (`produccion_id`) REFERENCES `produccion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `produccion_actividades_ibfk_2` FOREIGN KEY (`actividad_id`) REFERENCES `asignacion_actividad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of produccion_actividades
-- ----------------------------
INSERT INTO `produccion_actividades` VALUES (19, 12, 1);
INSERT INTO `produccion_actividades` VALUES (25, 15, 1);
INSERT INTO `produccion_actividades` VALUES (26, 15, 2);
INSERT INTO `produccion_actividades` VALUES (27, 15, 3);

-- ----------------------------
-- Table structure for produccion_hectarea
-- ----------------------------
DROP TABLE IF EXISTS `produccion_hectarea`;
CREATE TABLE `produccion_hectarea`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `produccion_id` int NULL DEFAULT NULL,
  `hectarea_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `produccion_id`(`produccion_id` ASC) USING BTREE,
  INDEX `hectarea_id`(`hectarea_id` ASC) USING BTREE,
  CONSTRAINT `produccion_hectarea_ibfk_1` FOREIGN KEY (`produccion_id`) REFERENCES `produccion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `produccion_hectarea_ibfk_2` FOREIGN KEY (`hectarea_id`) REFERENCES `hectarea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of produccion_hectarea
-- ----------------------------
INSERT INTO `produccion_hectarea` VALUES (22, 12, 3);
INSERT INTO `produccion_hectarea` VALUES (23, 12, 4);
INSERT INTO `produccion_hectarea` VALUES (24, 13, 6);
INSERT INTO `produccion_hectarea` VALUES (25, 14, 3);
INSERT INTO `produccion_hectarea` VALUES (26, 14, 4);
INSERT INTO `produccion_hectarea` VALUES (27, 14, 5);
INSERT INTO `produccion_hectarea` VALUES (28, 15, 4);
INSERT INTO `produccion_hectarea` VALUES (29, 15, 5);

-- ----------------------------
-- Table structure for produccion_herramienta
-- ----------------------------
DROP TABLE IF EXISTS `produccion_herramienta`;
CREATE TABLE `produccion_herramienta`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `produccion_id` int NULL DEFAULT NULL,
  `herraienta_id` int NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `produccion_id`(`produccion_id` ASC) USING BTREE,
  INDEX `herraienta_id`(`herraienta_id` ASC) USING BTREE,
  CONSTRAINT `produccion_herramienta_ibfk_1` FOREIGN KEY (`produccion_id`) REFERENCES `produccion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `produccion_herramienta_ibfk_2` FOREIGN KEY (`herraienta_id`) REFERENCES `herramienta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of produccion_herramienta
-- ----------------------------
INSERT INTO `produccion_herramienta` VALUES (6, 12, 1, 2);
INSERT INTO `produccion_herramienta` VALUES (7, 12, 2, 3);
INSERT INTO `produccion_herramienta` VALUES (8, 13, 1, 10);
INSERT INTO `produccion_herramienta` VALUES (9, 13, 2, 2);
INSERT INTO `produccion_herramienta` VALUES (10, 14, 1, 1);
INSERT INTO `produccion_herramienta` VALUES (11, 14, 2, 1);
INSERT INTO `produccion_herramienta` VALUES (12, 15, 1, 1);
INSERT INTO `produccion_herramienta` VALUES (13, 15, 2, 1);

-- ----------------------------
-- Table structure for produccion_insumo
-- ----------------------------
DROP TABLE IF EXISTS `produccion_insumo`;
CREATE TABLE `produccion_insumo`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `produccion_id` int NULL DEFAULT NULL,
  `insumo_id` int NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `produccion_id`(`produccion_id` ASC) USING BTREE,
  INDEX `insumo_id`(`insumo_id` ASC) USING BTREE,
  CONSTRAINT `produccion_insumo_ibfk_1` FOREIGN KEY (`produccion_id`) REFERENCES `produccion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `produccion_insumo_ibfk_2` FOREIGN KEY (`insumo_id`) REFERENCES `insumo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of produccion_insumo
-- ----------------------------
INSERT INTO `produccion_insumo` VALUES (5, 12, 1, 1);
INSERT INTO `produccion_insumo` VALUES (6, 12, 2, 2);
INSERT INTO `produccion_insumo` VALUES (7, 13, 1, 2);
INSERT INTO `produccion_insumo` VALUES (8, 14, 1, 1);
INSERT INTO `produccion_insumo` VALUES (9, 14, 2, 1);
INSERT INTO `produccion_insumo` VALUES (10, 15, 1, 1);

-- ----------------------------
-- Table structure for proveedor
-- ----------------------------
DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE `proveedor`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `ruc` char(14) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `telefono` char(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `correo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `encargado` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of proveedor
-- ----------------------------
INSERT INTO `proveedor` VALUES (1, 'RAZON EDITADA', '12345', '54321', ' DIRECCION EDITADA', 'COR@HOTMAIL.COM', 'LUIS DEL POZO', ' VENTA DE BANANA', 1);
INSERT INTO `proveedor` VALUES (2, 'INSETECH', '0987654321123', '0987654321', 'CASITA', 'Correo@GMAIL.COM', 'JORGE LUIS LOPEX', 'PARA SER UN PROVEEDRO', 1);

-- ----------------------------
-- Table structure for racimos
-- ----------------------------
DROP TABLE IF EXISTS `racimos`;
CREATE TABLE `racimos`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `produccion_id` int NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `tipo` char(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `produccion_id`(`produccion_id` ASC) USING BTREE,
  CONSTRAINT `racimos_ibfk_1` FOREIGN KEY (`produccion_id`) REFERENCES `produccion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of racimos
-- ----------------------------
INSERT INTO `racimos` VALUES (1, 14, '2022-10-05', 'Racimos', 100);

-- ----------------------------
-- Table structure for recobro_excel
-- ----------------------------
DROP TABLE IF EXISTS `recobro_excel`;
CREATE TABLE `recobro_excel`  (
  `id` int NULL DEFAULT NULL,
  `id_excel` int NULL DEFAULT NULL,
  `id_cinta` int NULL DEFAULT NULL,
  `1A_cai` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `1A_saldo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `1B_cai` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `1B_saldo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `1C_cai` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `1C_saldo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `2_cai` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `2_saldo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `3_cai` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `3_saldo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `4_cai` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `4_saldo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `5_cai` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `5_saldo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `6_cai` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `6_saldo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `7_cai` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `7_saldo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `8_cai` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `8_saldo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `A_cai` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `A_saldo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `B_cai` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `B_saldo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `C_cai` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `C_saldo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `D_cai` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `D_saldo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `caidos` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `total` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `saldos` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `porcentaje` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  INDEX `id_excel`(`id_excel` ASC) USING BTREE,
  INDEX `id_cinta`(`id_cinta` ASC) USING BTREE,
  CONSTRAINT `recobro_excel_ibfk_1` FOREIGN KEY (`id_excel`) REFERENCES `archivo_recobro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recobro_excel_ibfk_2` FOREIGN KEY (`id_cinta`) REFERENCES `tipo_cinta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of recobro_excel
-- ----------------------------
INSERT INTO `recobro_excel` VALUES (1, 10, 1, '', '-103', '', '2', '', '9', '', '78', '', '-22', '', '60', '', '21', '', '26', '', '15', '', '7', '', '0', '', '-17', '', '-135', '', '26', '0', '5192', '-33', '0.64');
INSERT INTO `recobro_excel` VALUES (2, 10, 2, '', '-25', '', '2', '', '24', '', '12', '', '71', '', '25', '', '13', '', '15', '', '-11', '', '7', '', '9', '', '39', '', '-7', '', '-19', '0', '4540', '155', '3.41');
INSERT INTO `recobro_excel` VALUES (3, 10, 3, '', '-3', '', '-9', '', '47', '', '21', '', '-27', '', '20', '', '13', '', '-10', '', '4', '', '0', '', '-2', '', '55', '', '28', '', '-27', '0', '5077', '110', '2.17');
INSERT INTO `recobro_excel` VALUES (4, 10, 4, '', '-3', '', '3', '', '44', '', '45', '', '21', '', '42', '', '24', '', '-39', '', '-4', '', '12', '', '45', '', '73', '', '3', '', '3', '0', '4458', '269', '6.03');
INSERT INTO `recobro_excel` VALUES (5, 10, 5, '', '-12', '', '-6', '', '-8', '', '10', '', '15', '', '4', '', '11', '', '49', '', '25', '', '22', '', '-20', '', '-84', '', '17', '', '-5', '0', '4675', '18', '0.39');
INSERT INTO `recobro_excel` VALUES (6, 10, 6, '', '-21', '', '6', '', '44', '', '17', '', '-16', '', '24', '', '-3', '', '18', '', '5', '', '-15', '', '-38', '', '-10', '', '-6', '', '12', '0', '4285', '17', '0.40');
INSERT INTO `recobro_excel` VALUES (7, 10, 7, '', '-27', '', '7', '', '63', '', '18', '', '-1', '', '40', '', '29', '', '-8', '', '9', '', '2', '', '67', '', '-4', '', '-2', '', '1', '0', '3948', '194', '4.91');
INSERT INTO `recobro_excel` VALUES (8, 10, 8, '', '-11', '', '4', '', '20', '', '8', '', '15', '', '13', '', '19', '', '12', '', '-4', '', '5', '', '-1', '', '7', '', '29', '', '-23', '0', '3757', '93', '2.48');
INSERT INTO `recobro_excel` VALUES (9, 10, 1, '', '-8', '', '4', '', '3', '', '10', '', '13', '', '30', '', '6', '', '3', '', '-7', '', '23', '', '-52', '', '-17', '', '-3', '', '-31', '0', '3927', '-26', '0.66');
INSERT INTO `recobro_excel` VALUES (10, 10, 2, '', '5', '', '7', '', '6', '5', '12', '2', '7', '3', '-2', '', '17', '', '-3', '', '4', '', '8', '', '55', '', '-3', '', '3', '', '13', '10', '3488', '129', '3.70');
INSERT INTO `recobro_excel` VALUES (11, 10, 3, '', '27', '', '4', '', '29', '16', '-2', '4', '25', '3', '17', '', '28', '', '0', '', '16', '', '15', '', '-6', '', '14', '', '13', '', '23', '23', '3349', '203', '6.06');
INSERT INTO `recobro_excel` VALUES (12, 10, 4, '', '-8', '', '-13', '', '1', '15', '-4', '19', '3', '1', '24', '', '34', '', '19', '', '2', '', '35', '', '-15', '', '8', '', '-35', '', '-13', '35', '3583', '38', '1.06');
INSERT INTO `recobro_excel` VALUES (13, 10, 5, '', '-11', '', '15', '', '52', '10', '10', '13', '-4', '6', '26', '', '22', '', '18', '', '30', '', '1', '', '18', '', '17', '', '-26', '', '-12', '29', '3784', '156', '4.12');
INSERT INTO `recobro_excel` VALUES (14, 10, 6, '2', '15', '3', '69', '1', '52', '10', '67', '19', '-24', '17', '-3', '1', '8', '', '7', '', '27', '', '57', '3', '-124', '', '18', '', '20', '', '25', '56', '3635', '214', '5.89');
INSERT INTO `recobro_excel` VALUES (15, 10, 7, '3', '-7', '1', '-69', '2', '-43', '20', '-44', '28', '7', '32', '-11', '5', '6', '', '-10', '', '10', '', '22', '2', '0', '', '-6', '', '22', '', '12', '93', '4250', '-111', '2.61');
INSERT INTO `recobro_excel` VALUES (16, 10, 8, '2', '136', '3', '-9', '3', '13', '33', '-6', '36', '-62', '32', '-29', '8', '8', '3', '0', '2', '9', '3', '4', '3', '58', '', '0', '', '-30', '', '-16', '128', '4484', '76', '1.69');
INSERT INTO `recobro_excel` VALUES (17, 10, 1, '3', '-117', '', '1', '4', '94', '12', '-37', '37', '-17', '33', '10', '8', '24', '2', '-13', '1', '7', '1', '-18', '5', '-65', '', '-22', '', '-40', '', '-43', '106', '5105', '-236', '4.62');
INSERT INTO `recobro_excel` VALUES (18, 10, 2, '2', '-20', '2', '23', '4', '-9', '16', '-39', '23', '6', '26', '-1', '5', '-1', '4', '-14', '1', '49', '', '8', '3', '-41', '', '-89', '', '-24', '', '-7', '86', '5328', '-159', '2.98');
INSERT INTO `recobro_excel` VALUES (19, 10, 3, '5', '14', '', '29', '9', '55', '27', '62', '33', '20', '45', '69', '1', '38', '4', '29', '', '54', '1', '-48', '3', '129', '', '88', '', '35', '', '35', '128', '5511', '609', '11.05');
INSERT INTO `recobro_excel` VALUES (20, 10, 4, '4', '-21', '', '21', '4', '-21', '15', '-11', '10', '4', '23', '-24', '2', '20', '3', '7', '2', '1', '1', '-15', '3', '-102', '', '-10', '', '19', '', '17', '67', '5018', '-115', '2.29');
INSERT INTO `recobro_excel` VALUES (21, 10, 5, '4', '-23', '3', '22', '1', '5', '17', '-17', '9', '-3', '14', '66', '3', '35', '2', '7', '3', '6', '6', '1', '5', '118', '', '-17', '', '-5', '', '10', '67', '4763', '205', '4.30');
INSERT INTO `recobro_excel` VALUES (22, 10, 6, '3', '-79', '', '7', '2', '15', '17', '-2', '4', '4', '15', '25', '', '62', '10', '-6', '', '28', '', '-1', '', '-15', '', '39', '', '-22', '', '23', '51', '5046', '78', '1.55');
INSERT INTO `recobro_excel` VALUES (23, 10, 7, '2', '-16', '1', '-12', '1', '6', '10', '-14', '6', '31', '18', '-45', '', '-12', '', '2', '', '-15', '', '77', '', '-70', '', '44', '', '95', '', '35', '38', '4569', '106', '2.32');
INSERT INTO `recobro_excel` VALUES (24, 10, 8, '2', '4', '2', '28', '', '-13', '13', '3', '2', '-107', '9', '15', '', '18', '2', '13', '', '-6', '', '-45', '', '-86', '', '-46', '', '183', '', '24', '30', '4189', '-15', '0.36');
INSERT INTO `recobro_excel` VALUES (25, 10, 1, '3', '-25', '', '-17', '', '18', '7', '197', '3', '184', '17', '112', '', '124', '2', '26', '', '38', '', '-27', '2', '62', '', '-113', '', '-17', '', '27', '34', '3890', '589', '15.14');
INSERT INTO `recobro_excel` VALUES (26, 10, 2, '2', '48', '', '17', '', '10', '1', '-194', '8', '-193', '11', '-50', '', '-91', '1', '-59', '', '-32', '', '-21', '1', '-28', '', '-28', '', '-42', '', '-7', '24', '3554', '-670', '18.85');
INSERT INTO `recobro_excel` VALUES (27, 10, 3, '2', '2', '2', '-13', '', '-4', '2', '72', '6', '15', '6', '34', '12', '-10', '3', '23', '', '12', '', '3', '1', '51', '', '30', '', '38', '', '24', '34', '3499', '277', '7.92');
INSERT INTO `recobro_excel` VALUES (28, 10, 4, '3', '109', '4', '35', '1', '31', '21', '-54', '14', '205', '18', '-129', '3', '77', '1', '-24', '1', '-58', '', '-4', '1', '49', '', '47', '', '41', '', '52', '67', '3588', '377', '10.51');
INSERT INTO `recobro_excel` VALUES (29, 10, 5, '5', '-45', '7', '19', '1', '-21', '19', '52', '5', '-80', '11', '115', '2', '2', '4', '-15', '', '58', '1', '30', '2', '13', '', '89', '', '25', '', '-74', '57', '3444', '168', '4.88');
INSERT INTO `recobro_excel` VALUES (30, 10, 6, '1', '23', '14', '-4', '', '79', '13', '-124', '12', '108', '', '-5', '3', '7', '4', '2', '1', '27', '', '-13', '', '-24', '', '7', '', '-18', '', '-47', '48', '3243', '18', '0.56');
INSERT INTO `recobro_excel` VALUES (31, 10, 7, '1', '-10', '8', '48', '', '33', '13', '215', '8', '-47', '', '54', '3', '13', '2', '0', '', '-5', '', '16', '', '96', '', '14', '', '53', '', '15', '35', '3214', '495', '15.40');
INSERT INTO `recobro_excel` VALUES (32, 10, 8, '3', '3', '4', '33', '', '-30', '14', '-44', '10', '57', '', '-75', '', '11', '', '2', '', '17', '1', '2', '', '180', '', '-4', '', '-17', '', '5', '32', '3207', '140', '4.37');
INSERT INTO `recobro_excel` VALUES (33, 10, 1, '2', '-5', '2', '-4', '', '-27', '11', '-58', '4', '-33', '', '86', '', '29', '', '0', '', '2', '', '-21', '', '-10', '', '-8', '', '43', '', '-38', '19', '3194', '-44', '1.38');
INSERT INTO `recobro_excel` VALUES (34, 10, 2, '2', '-59', '5', '-98', '', '17', '8', '32', '1', '-38', '', '-42', '1', '-24', '', '3', '', '7', '', '21', '', '-28', '', '18', '', '164', '', '3', '17', '3563', '-24', '0.67');
INSERT INTO `recobro_excel` VALUES (35, 10, 3, '2', '75', '4', '88', '', '-21', '6', '-14', '3', '-10', '', '30', '1', '0', '', '-8', '', '17', '', '4', '', '39', '', '10', '', '-242', '', '-18', '16', '3339', '-50', '1.50');
INSERT INTO `recobro_excel` VALUES (36, 10, 4, '', '9', '', '26', '', '47', '10', '115', '', '48', '', '-127', '2', '30', '', '-17', '', '-23', '', '-16', '', '-47', '', '-51', '', '27', '', '-26', '12', '3522', '-5', '0.14');
INSERT INTO `recobro_excel` VALUES (37, 10, 5, '', '15', '6', '-19', '', '28', '8', '-316', '1', '-45', '', '151', '1', '119', '1', '-34', '1', '8', '3', '-3', '', '163', '', '85', '', '-77', '', '-47', '21', '3421', '28', '0.82');
INSERT INTO `recobro_excel` VALUES (38, 10, 6, '2', '25', '', '-24', '', '-12', '6', '66', '', '109', '', '37', '1', '-132', '', '-13', '', '-17', '', '-40', '', '-89', '', '-14', '', '158', '', '-31', '9', '3584', '23', '0.64');
INSERT INTO `recobro_excel` VALUES (39, 10, 7, '1', '-125', '', '1', '', '-16', '10', '130', '', '-68', '', '-13', '2', '-16', '1', '19', '1', '15', '2', '4', '', '100', '', '7', '', '-31', '', '16', '17', '3568', '23', '0.64');
INSERT INTO `recobro_excel` VALUES (40, 10, 8, '1', '-25', '2', '59', '', '17', '11', '34', '', '40', '', '17', '1', '-5', '', '86', '1', '45', '', '-3', '', '-108', '', '-9', '', '-14', '', '76', '16', '3702', '210', '5.67');
INSERT INTO `recobro_excel` VALUES (41, 10, 1, '1', '-2', '', '-68', '', '11', '13', '-39', '', '104', '', '14', '3', '33', '1', '-65', '', '3', '', '2', '', '-67', '', '35', '', '45', '', '17', '18', '3523', '23', '0.65');
INSERT INTO `recobro_excel` VALUES (42, 10, 2, '1', '-4', '1', '-24', '', '-7', '6', '54', '', '-145', '', '-100', '', '-177', '', '48', '', '55', '1', '45', '', '-43', '', '-15', '', '-41', '', '-9', '9', '3168', '-363', '11.46');
INSERT INTO `recobro_excel` VALUES (43, 10, 3, '', '131', '', '48', '', '35', '5', '63', '', '176', '', '88', '', '145', '', '-52', '', '-69', '', '-65', '', '-17', '', '-66', '', '-57', '', '13', '5', '3591', '373', '10.39');
INSERT INTO `recobro_excel` VALUES (44, 10, 4, '', '-123', '', '-35', '', '-13', '7', '10', '', '-70', '', '53', '', '114', '', '-2', '', '4', '', '6', '', '77', '', '27', '', '40', '', '16', '7', '3555', '104', '2.93');
INSERT INTO `recobro_excel` VALUES (45, 10, 5, '8', '16', '', '6', '', '-11', '10', '-27', '', '22', '', '10', '3', '-44', '3', '10', '', '7', '', '15', '', '-26', '', '33', '', '5', '', '12', '24', '3587', '28', '0.78');
INSERT INTO `recobro_excel` VALUES (46, 10, 6, '4', '9', '', '-6', '', '1', '11', '9', '', '-14', '', '12', '2', '5', '2', '6', '', '11', '', '-6', '4', '-24', '', '-14', '', '3', '', '1', '23', '3838', '-7', '0.18');
INSERT INTO `recobro_excel` VALUES (47, 10, 7, '7', '-54', '3', '-21', '1', '-10', '6', '19', '', '40', '', '29', '2', '19', '8', '-6', '', '0', '', '-9', '', '4', '', '-26', '', '-6', '', '13', '27', '4080', '-8', '0.20');
INSERT INTO `recobro_excel` VALUES (48, 10, 8, '1', '2', '2', '-5', '2', '13', '7', '-32', '', '27', '', '-3', '5', '7', '6', '26', '', '-34', '', '1', '3', '17', '6', '25', '', '-54', '', '8', '32', '4257', '-2', '0.05');
INSERT INTO `recobro_excel` VALUES (49, 10, 1, '3', '12', '4', '17', '', '33', '10', '15', '', '10', '1', '-16', '10', '4', '6', '129', '3', '-102', '2', '-12', '5', '-2', '7', '6', '', '-26', '', '3', '51', '4201', '71', '1.69');
INSERT INTO `recobro_excel` VALUES (50, 10, 2, '11', '-9', '3', '-14', '', '47', '11', '40', '3', '9', '4', '44', '11', '18', '19', '52', '', '-30', '', '2', '', '39', '8', '33', '', '-22', '', '5', '70', '4233', '214', '5.06');
INSERT INTO `recobro_excel` VALUES (51, 10, 3, '15', '-19', '5', '25', '2', '-5', '15', '-25', '1', '-82', '8', '34', '4', '104', '10', '0', '', '-4', '2', '-6', '', '-19', '8', '43', '', '12', '', '25', '70', '4873', '83', '1.70');
INSERT INTO `recobro_excel` VALUES (52, 10, 4, '5', '-20', '3', '99', '', '11', '19', '43', '5', '119', '2', '15', '15', '-41', '10', '-10', '', '15', '', '-4', '9', '125', '18', '149', '', '-12', '', '-32', '86', '4757', '457', '9.61');
INSERT INTO `recobro_excel` VALUES (1, 11, 1, '5', '-2', '4', '-83', '', '10', '28', '101', '1', '11', '10', '61', '16', '62', '1', '6', '8', '4', '1', '23', '16', '42', '19', '-3', '4', '96', '1', '12', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (2, 11, 2, '5', '2', '7', '-14', '1', '10', '34', '-30', '5', '33', '10', '-28', '15', '-84', '3', '69', '4', '17', '', '2', '15', '-7', '24', '77', '1', '45', '', '32', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (3, 11, 3, '9', '-24', '2', '27', '', '-4', '44', '16', '', '54', '12', '10', '16', '116', '10', '-48', '6', '-15', '2', '-9', '', '53', '10', '50', '7', '-66', '', '-27', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (4, 11, 4, '6', '-89', '4', '-10', '', '12', '46', '-28', '24', '35', '10', '19', '29', '-10', '11', '-11', '12', '-5', '2', '-27', '16', '99', '22', '24', '', '-17', '', '14', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (5, 11, 5, '8', '-140', '', '-10', '', '9', '43', '-16', '23', '5', '12', '98', '20', '-11', '5', '21', '5', '12', '', '14', '21', '2', '15', '1', '4', '20', '2', '-2', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (6, 11, 6, '7', '-32', '', '35', '', '-5', '54', '-9', '23', '-10', '15', '-92', '31', '4', '9', '-10', '3', '8', '', '-19', '20', '-117', '14', '0', '2', '29', '1', '8', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (7, 11, 7, '10', '-2', '', '15', '', '4', '56', '1', '20', '-6', '11', '28', '22', '-2', '                                                       ', '3', '7', '18', '1', '6', '28', '-17', '9', '35', '6', '11', '', '21', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (8, 11, 8, '13', '-15', '3', '10', '', '0', '55', '-44', '25', '-18', '13', '6', '27', '-14', '27', '14', '9', '42', '3', '30', '37', '-12', '22', '-14', '8', '-3', '2', '17', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (9, 11, 1, '7', '-98', '2', '78', '3', '10', '74', '47', '24', '-18', '5', '-79', '20', '59', '19', '7', '8', '41', '4', '75', '20', '53', '14', '35', '17', '-31', '2', '42', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (10, 11, 2, '9', '-8', '1', '52', '1', '17', '46', '-118', '11', '-100', '8', '97', '17', '-44', '9', '64', '7', '5', '4', '36', '24', '67', '14', '-32', '20', '-14', '4', '-2', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (11, 11, 3, '6', '17', '1', '-32', '3', '3', '55', '-35', '4', '75', '', '-80', '20', '-96', '', '44', '4', '7', '1', '13', '17', '-61', '21', '80', '20', '-63', '1', '11', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (12, 11, 4, '4', '-11', '2', '57', '4', '-7', '20', '20', '8', '-18', '', '194', '7', '91', '3', '81', '2', '14', '3', '13', '11', '8', '11', '6', '19', '100', '1', '-41', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (13, 11, 5, '11', '-27', '2', '5', '8', '9', '22', '10', '7', '16', '', '8', '11', '-13', '3', '-8', '5', '-6', '3', '-6', '', '14', '18', '-18', '15', '-15', '3', '47', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (14, 11, 6, '6', '26', '3', '6', '2', '17', '16', '6', '4', '73', '', '-20', '13', '17', '4', '-86', '4', '-7', '3', '-19', '16', '31', '19', '39', '24', '-2', '3', '17', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (15, 11, 7, '5', '101', '7', '83', '2', '-11', '27', '210', '7', '-5', '', '184', '5', '96', '6', '109', '2', '25', '', '42', '15', '88', '31', '-93', '33', '-36', '4', '24', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (16, 11, 8, '5', '-29', '2', '-6', '7', '9', '40', '139', '6', '-83', '6', '99', '10', '39', '10', '45', '5', '-7', '1', '12', '16', '72', '25', '59', '20', '79', '1', '39', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (17, 11, 1, '3', '44', '6', '71', '2', '-51', '35', '51', '10', '99', '10', '-7', '7', '7', '6', '-14', '2', '20', '1', '-6', '11', '-87', '21', '16', '10', '-55', '6', '-16', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (18, 11, 2, '2', '113', '3', '41', '3', '34', '24', '83', '6', '33', '12', '138', '14', '17', '7', '-14', '4', '9', '', '19', '12', '-315', '32', '-187', '18', '-94', '3', '13', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (19, 11, 3, '5', '-12', '', '51', '1', '22', '20', '-121', '5', '-119', '7', '-110', '', '29', '5', '61', '2', '12', '5', '30', '15', '317', '28', '269', '11', '78', '6', '-7', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (20, 11, 4, '3', '-413', '', '-87', '2', '-49', '36', '100', '10', '-163', '', '-289', '4', '-6', '4', '-235', '1', '-144', '5', '16', '11', '-331', '23', '-8', '18', '-14', '1', '-3', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (21, 11, 5, '9', '-86', '3', '168', '', '-133', '26', '-150', '10', '-71', '', '-21', '9', '-143', '2', '19', '2', '-7', '4', '-16', '', '-64', '33', '-10', '19', '40', '8', '12', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (22, 11, 6, '8', '13', '', '76', '1', '-4', '21', '75', '9', '34', '9', '47', '2', '83', '1', '42', '2', '0', '4', '39', '', '-93', '21', '-23', '16', '-3', '1', '14', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (23, 11, 7, '11', '-52', '1', '-74', '2', '9', '16', '-65', '9', '-15', '1', '-28', '3', '-11', '2', '-4', '2', '145', '2', '-18', '', '41', '18', '20', '11', '24', '4', '10', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (24, 11, 8, '9', '-54', '1', '0', '2', '41', '15', '64', '9', '26', '4', '113', '4', '21', '4', '25', '2', '-13', '1', '19', '', '-97', '24', '25', '15', '-94', '1', '21', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (25, 11, 1, '5', '213', '', '6', '1', '-68', '10', '23', '6', '60', '4', '-42', '7', '-27', '7', '-38', '1', '27', '2', '1', '', '389', '26', '-19', '4', '38', '1', '-9', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (26, 11, 2, '4', '39', '2', '-12', '1', '38', '9', '-87', '2', '356', '3', '-416', '7', '-67', '4', '-6', '1', '5', '2', '-30', '', '-80', '28', '-118', '3', '-1', '', '1', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (27, 11, 3, '4', '-86', '1', '15', '', '36', '3', '71', '1', '-31', '10', '-59', '4', '-37', '', '-15', '', '10', '', '-35', '', '10', '15', '70', '4', '2', '', '9', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (28, 11, 4, '4', '16', '1', '16', '', '-38', '16', '-110', '5', '69', '7', '44', '4', '14', '', '-11', '1', '6', '', '20', '', '56', '10', '-78', '3', '-53', '3', '9', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (29, 11, 5, '5', '-18', '', '-6', '', '2', '11', '17', '4', '-69', '14', '-20', '10', '-50', '1', '19', '1', '-18', '', '-42', '', '75', '16', '-10', '4', '11', '3', '6', '', '', '', '');
INSERT INTO `recobro_excel` VALUES (30, 11, 6, '5', '-5', '', '-3', '', '-43', '13', '-117', '10', '36', '13', '-29', '3', '-41', '10', '-55', '1', '0', '3', '-12', '13', '-98', '16', '41', '3', '80', '', '-25', '14', '19', '1', '');
INSERT INTO `recobro_excel` VALUES (31, 11, 7, '6', '-68', '', '-74', '', '-41', '21', '100', '11', '-36', '13', '45', '4', '-24', '6', '32', '1', '18', '2', '11', '18', '-49', '9', '-73', '3', '-123', '', '-17', '63', '21', '7', '30');
INSERT INTO `recobro_excel` VALUES (32, 11, 8, '5', '0', '', '25', '', '-5', '13', '0', '8', '14', '19', '-4', '5', '-10', '6', '-30', '', '11', '', '-8', '11', '5', '4', '-70', '1', '14', '1', '-5', '333', '126', '212', '');
INSERT INTO `recobro_excel` VALUES (33, 11, 1, '3', '-21', '', '-46', '', '14', '16', '115', '11', '-1', '12', '19', '7', '9', '3', '-31', '', '-1', '1', '-36', '11', '10', '2', '41', '2', '-49', '', '12', '843', '19', '131', '321');
INSERT INTO `recobro_excel` VALUES (34, 11, 2, '9', '31', '', '27', '', '11', '19', '-54', '12', '-9', '8', '0', '8', '-12', '1', '3', '3', '25', '1', '18', '12', '-28', '3', '15', '2', '32', '1', '-2', '889', '135', '120', '148');
INSERT INTO `recobro_excel` VALUES (35, 11, 3, '5', '-1', '', '6', '', '42', '28', '-35', '28', '-7', '12', '-4', '5', '-8', '5', '10', '1', '3', '1', '4', '', '11', '6', '8', '', '-65', '', '9', '1504', '324', '160', '502');
INSERT INTO `recobro_excel` VALUES (36, 11, 4, '6', '28', '', '-7', '', '6', '20', '1', '17', '6', '13', '22', '10', '-14', '4', '1', '1', '5', '', '-5', '', '-24', '5', '25', '1', '18', '', '8', '1368', '100', '197', '310');
INSERT INTO `recobro_excel` VALUES (37, 11, 5, '20', '122', '', '56', '', '47', '35', '8', '25', '-34', '16', '17', '13', '11', '6', '24', '1', '22', '', '15', '', '106', '4', '100', '', '53', '', '4', '1432', '23', '288', '32');
INSERT INTO `recobro_excel` VALUES (38, 11, 6, '5', '-42', '', '8', '', '-8', '25', '-1', '29', '4', '9', '58', '5', '31', '', '5', '3', '-12', '', '17', '1', '-1', '2', '22', '', '78', '1', '35', '1401', '226', '261', '271');
INSERT INTO `recobro_excel` VALUES (39, 11, 7, '13', '-36', '', '-1', '', '-37', '34', '90', '19', '3', '9', '22', '10', '-35', '4', '-14', '2', '-1', '5', '-24', '1', '51', '6', '-27', '', '-6', '1', '-43', '1387', '3', '290', '315');
INSERT INTO `recobro_excel` VALUES (40, 11, 8, '5', '21', '', '-19', '5', '-9', '22', '-39', '18', '-19', '7', '7', '13', '32', '3', '-24', '2', '-15', '', '1', '1', '-6', '2', '-3', '', '12', '1', '6', '1236', '62', '82', '193');
INSERT INTO `recobro_excel` VALUES (41, 11, 1, '13', '30', '', '-30', '11', '-24', '28', '88', '12', '-1', '18', '-1', '18', '30', '5', '-55', '', '9', '', '17', '3', '-49', '8', '32', '', '-4', '', '13', '1190', '121', '425', '215');
INSERT INTO `recobro_excel` VALUES (42, 11, 2, '10', '-99', '', '2', '7', '-30', '31', '26', '14', '-28', '17', '-1', '11', '112', '2', '-102', '', '-4', '', '-9', '3', '74', '7', '157', '2', '98', '1', '-27', '960', '165', '273', '188');
INSERT INTO `recobro_excel` VALUES (43, 11, 3, '5', '21', '', '-78', '12', '-9', '19', '25', '18', '16', '26', '36', '11', '186', '3', '-16', '2', '11', '', '-1', '8', '-59', '4', '-9', '', '-55', '', '-5', '560', '301', '74', '126');
INSERT INTO `recobro_excel` VALUES (44, 11, 4, '1', '-17', '', '12', '13', '-31', '24', '-10', '24', '10', '20', '22', '12', '83', '5', '-31', '2', '11', '', '-1', '12', '42', '', '46', '3', '44', '', '24', '489', '164', '103', '250');
INSERT INTO `recobro_excel` VALUES (45, 11, 5, '5', '5', '5', '-7', '12', '-8', '41', '-9', '26', '-18', '49', '-13', '24', '-9', '10', '-1', '3', '-4', '1', '-24', '10', '-27', '11', '15', '7', '0', '3', '16', '380', '1', '1', '317');
INSERT INTO `recobro_excel` VALUES (46, 11, 6, '7', '-13', '7', '-14', '12', '3', '51', '27', '30', '-42', '43', '26', '34', '-16', '12', '4', '12', '18', '4', '2', '9', '-9', '12', '6', '6', '-19', '1', '13', '261', '113', '92', '18');
INSERT INTO `recobro_excel` VALUES (47, 11, 7, '7', '2', '8', '35', '9', '-9', '66', '60', '20', '-93', '35', '112', '16', '14', '10', '8', '7', '-1', '3', '2', '16', '-30', '35', '-73', '7', '-25', '5', '-1', '175', '15', '78', '45');
INSERT INTO `recobro_excel` VALUES (48, 11, 8, '5', '1', '3', '2', '4', '5', '53', '104', '10', '-45', '38', '60', '17', '3', '16', '38', '6', '15', '3', '1', '23', '15', '15', '44', '7', '-3', '1', '11', '148', '31', '74', '37');
INSERT INTO `recobro_excel` VALUES (49, 11, 1, '6', '4', '10', '5', '6', '7', '36', '50', '18', '46', '28', '20', '20', '-10', '17', '24', '7', '1', '4', '-16', '13', '-55', '34', '-50', '15', '20', '6', '6', '106', '11', '47', '25');
INSERT INTO `recobro_excel` VALUES (50, 11, 2, '1', '-6', '8', '-28', '2', '1', '40', '-43', '18', '15', '31', '4', '7', '0', '12', '-23', '6', '-8', '2', '-16', '18', '-84', '37', '-22', '5', '8', '7', '-3', '121', '29', '19', '17');
INSERT INTO `recobro_excel` VALUES (51, 11, 3, '2', '-5', '2', '-19', '5', '-37', '36', '-74', '22', '10', '31', '-32', '7', '4', '8', '-11', '10', '-9', '4', '-33', '20', '-125', '31', '-1', '8', '2', '1', '-22', '70', '13', '35', '7');
INSERT INTO `recobro_excel` VALUES (52, 11, 4, '3', '10', '7', '11', '2', '11', '56', '-84', '17', '26', '32', '47', '13', '26', '5', '-11', '5', '-4', '5', '2', '28', '34', '38', '7', '20', '-15', '5', '2', '83', '32', '16', '32');
INSERT INTO `recobro_excel` VALUES (1, 12, 1, '8', '-3', '14', '9', '7', '7', '39', '-13', '24', '4', '26', '18', '18', '8', '6', '5', '5', '11', '4', '1', '38', '18', '53', '-53', '12', '-16', '4', '6', '53', '2', '11', '31');
INSERT INTO `recobro_excel` VALUES (2, 12, 2, '21', '-74', '21', '-24', '24', '-22', '55', '8', '39', '3', '32', '35', '12', '-10', '4', '-35', '4', '-13', '7', '-11', '53', '193', '44', '-90', '16', '15', '9', '6', '88', '2', '27', '12');
INSERT INTO `recobro_excel` VALUES (3, 12, 3, '11', '-122', '10', '19', '16', '-22', '62', '78', '56', '-5', '2', '-5', '29', '4', '23', '-5', '16', '-4', '11', '32', '50', '132', '71', '-34', '15', '4', '10', '-7', '93', '2', '7', '58');
INSERT INTO `recobro_excel` VALUES (4, 12, 4, '11', '-107', '6', '23', '4', '15', '58', '167', '45', '42', '29', '-34', '27', '1', '17', '78', '14', '38', '12', '40', '68', '147', '37', '61', '23', '19', '5', '7', '105', '28', '12', '24');
INSERT INTO `recobro_excel` VALUES (5, 12, 5, '6', '-18', '5', '-11', '5', '23', '55', '9', '25', '32', '48', '-39', '25', '-13', '10', '21', '10', '10', '9', '7', '26', '40', '42', '26', '21', '67', '7', '-19', '166', '20', '8', '28');
INSERT INTO `recobro_excel` VALUES (6, 12, 6, '13', '9', '9', '2', '5', '52', '23', '24', '22', '75', '18', '35', '24', '5', '11', '21', '9', '20', '5', '-32', '12', '8', '25', '52', '21', '36', '4', '16', '199', '4', '42', '37');
INSERT INTO `recobro_excel` VALUES (7, 12, 7, '7', '-21', '12', '-5', '11', '86', '46', '-28', '16', '94', '5', '-7', '26', '-7', '7', '-78', '10', '12', '8', '14', '10', '105', '28', '63', '18', '-1', '6', '27', '383', '114', '40', '50');
INSERT INTO `recobro_excel` VALUES (8, 12, 8, '5', '27', '11', '-18', '11', '52', '39', '13', '41', '51', '27', '9', '32', '23', '9', '-18', '7', '21', '16', '24', '10', '50', '29', '93', '25', '20', '9', '23', '511', '153', '88', '94');
INSERT INTO `recobro_excel` VALUES (9, 12, 1, '5', '-17', '13', '-7', '9', '32', '18', '23', '42', '12', '22', '-17', '25', '9', '7', '-9', '13', '4', '9', '-17', '3', '25', '19', '10', '26', '-62', '3', '-2', '783', '63', '153', '57');
INSERT INTO `recobro_excel` VALUES (10, 12, 2, '6', '-9', '10', '-22', '12', '15', '16', '85', '17', '32', '15', '8', '23', '-19', '16', '16', '8', '0', '10', '5', '16', '70', '18', '76', '24', '30', '3', '8', '807', '43', '11', '78');
INSERT INTO `recobro_excel` VALUES (11, 12, 3, '9', '3', '15', '19', '14', '13', '17', '83', '20', '30', '10', '-10', '23', '-11', '7', '36', '6', '9', '11', '10', '11', '138', '33', '51', '25', '95', '1', '16', '917', '26', '12', '53');
INSERT INTO `recobro_excel` VALUES (12, 12, 4, '3', '3', '12', '-6', '13', '-6', '21', '-96', '21', '53', '10', '28', '23', '-26', '6', '37', '7', '-3', '7', '4', '7', '54', '34', '136', '24', '97', '', '-7', '1097', '29', '16', '220');
INSERT INTO `recobro_excel` VALUES (13, 12, 5, '5', '-12', '6', '6', '13', '-15', '21', '-63', '18', '-8', '5', '24', '22', '40', '6', '-8', '2', '-16', '7', '14', '4', '37', '21', '50', '21', '-3', '1', '8', '1140', '6', '145', '2');
INSERT INTO `recobro_excel` VALUES (14, 12, 6, '6', '31', '', '27', '10', '-4', '10', '19', '21', '-24', '11', '1', '9', '10', '6', '-15', '5', '4', '16', '9', '6', '20', '11', '-12', '26', '-3', '1', '-5', '1081', '15', '51', '729');
INSERT INTO `recobro_excel` VALUES (15, 12, 7, '9', '0', '', '4', '1', '0', '11', '4', '24', '0', '10', '1', '12', '5', '6', '0', '6', '4', '6', '0', '6', '3', '10', '5', '24', '0', '', '0', '1106', '39', '62', '118');
INSERT INTO `recobro_excel` VALUES (16, 12, 8, '9', '5', '1', '0', '3', '3', '21', '0', '8', '6', '12', '0', '13', '0', '11', '6', '3', '3', '8', '0', '8', '0', '22', '0', '26', '0', '1', '0', '1129', '18', '280', '226');
INSERT INTO `recobro_excel` VALUES (17, 12, 1, '14', '19', '', '15', '1', '0', '39', '0', '13', '0', '19', '4', '16', '0', '14', '0', '3', '0', '8', '0', '11', '0', '32', '124', '42', '40', '7', '8', '1034', '151', '39', '54');
INSERT INTO `recobro_excel` VALUES (18, 12, 2, '7', '0', '', '0', '2', '0', '41', '0', '17', '3', '15', '0', '12', '0', '24', '0', '1', '0', '13', '9', '22', '0', '40', '0', '33', '0', '6', '0', '940', '370', '39', '77');
INSERT INTO `recobro_excel` VALUES (19, 12, 3, '4', '46', '', '82', '3', '9', '47', '44', '13', '0', '15', '0', '17', '28', '11', '2', '4', '8', '8', '11', '13', '289', '14', '175', '28', '15', '2', '0', '795', '46', '93', '224');
INSERT INTO `recobro_excel` VALUES (20, 12, 4, '5', '0', '', '0', '3', '37', '38', '21', '11', '0', '10', '0', '16', '51', '8', '0', '6', '0', '2', '0', '6', '0', '43', '0', '25', '38', '1', '10', '518', '17', '70', '113');
INSERT INTO `recobro_excel` VALUES (21, 12, 5, '5', '0', '', '3', '1', '0', '14', '0', '6', '0', '9', '-8', '2', '1', '6', '2', '', '0', '9', '-1', '5', '0', '17', '0', '8', '0', '', '6', '415', '188', '65', '5');
INSERT INTO `recobro_excel` VALUES (22, 12, 6, '11', '0', '', '0', '', '0', '19', '0', '7', '0', '3', '-3', '5', '0', '6', '0', '4', '0', '2', '0', '6', '0', '7', '0', '8', '-1', '', '0', '297', '35', '6', '129');
INSERT INTO `recobro_excel` VALUES (23, 12, 7, '7', '-1', '', '0', '6', '-6', '26', '0', '20', '-13', '9', '-4', '10', '0', '3', '3', '4', '-1', '5', '5', '10', '0', '26', '-17', '22', '-16', '2', '1', '240', '97', '29', '36');
INSERT INTO `recobro_excel` VALUES (24, 12, 8, '3', '15', '9', '-7', '', '0', '28', '-8', '7', '0', '3', '4', '3', '0', '2', '5', '2', '2', '12', '1', '1', '0', '31', '100', '17', '0', '2', '6', '179', '2', '29', '6');
INSERT INTO `recobro_excel` VALUES (25, 12, 1, '3', '75', '6', '0', '', '-20', '31', '132', '8', '78', '4', '164', '2', '3', '2', '0', '1', '0', '1', '0', '6', '24', '19', '0', '15', '0', '1', '4', '127', '2', '62', '4');
INSERT INTO `recobro_excel` VALUES (26, 12, 2, '5', '127', '4', '0', '1', '8', '31', '189', '7', '32', '2', '34', '1', '-4', '2', '0', '1', '0', '3', '0', '2', '60', '17', '0', '5', '0', '', '1', '131', '2', '99', '8');
INSERT INTO `recobro_excel` VALUES (27, 12, 3, '3', '0', '4', '63', '', '29', '8', '0', '2', '0', '3', '0', '2', '0', '7', '62', '5', '25', '3', '19', '17', '14', '16', '96', '16', '90', '', '34', '98', '65', '12', '8');
INSERT INTO `recobro_excel` VALUES (28, 12, 4, '4', '0', '4', '7', '1', '15', '5', '83', '3', '27', '3', '58', '3', '10', '9', '12', '5', '6', '8', '20', '14', '62', '20', '89', '16', '45', '2', '24', '102', '7', '60', '13');
INSERT INTO `recobro_excel` VALUES (29, 12, 5, '11', '8', '2', '9', '', '10', '14', '45', '2', '49', '4', '64', '3', '44', '4', '10', '5', '6', '', '25', '11', '53', '27', '92', '20', '56', '2', '13', '100', '30', '38', '30');
INSERT INTO `recobro_excel` VALUES (30, 12, 6, '3', '14', '1', '0', '3', '4', '2', '14', '2', '-1', '', '0', '2', '33', '3', '25', '1', '5', '1', '6', '7', '19', '26', '0', '8', '2', '1', '0', '104', '11', '27', '31');
INSERT INTO `recobro_excel` VALUES (31, 12, 7, '5', '-1', '6', '-2', '1', '-1', '5', '0', '4', '-2', '40', '-2', '3', '15', '1', '-2', '1', '-3', '', '4', '4', '26', '10', '-8', '4', '0', '', '0', '143', '6', '40', '30');
INSERT INTO `recobro_excel` VALUES (32, 12, 8, '7', '-1', '3', '0', '2', '-1', '2', '0', '2', '0', '4', '-2', '4', '-3', '2', '0', '3', '0', '4', '0', '11', '-10', '10', '-6', '9', '-4', '2', '-2', '174', '10', '18', '90');
INSERT INTO `recobro_excel` VALUES (33, 12, 1, '9', '-1', '2', '0', '2', '-1', '3', '0', '7', '-2', '4', '-4', '9', '-4', '6', '-4', '7', '0', '2', '0', '17', '-16', '12', '-12', '11', '-7', '3', '-3', '365', '81', '59', '116');
INSERT INTO `recobro_excel` VALUES (34, 12, 2, '3', '8', '3', '1', '', '-1', '2', '0', '6', '-3', '2', '7', '8', '-2', '3', '-3', '1', '0', '1', '1', '11', '-7', '8', '-7', '18', '-6', '4', '-87', '662', '60', '240', '121');
INSERT INTO `recobro_excel` VALUES (35, 12, 3, '1', '0', '7', '15', '1', '14', '5', '1', '3', '5', '2', '12', '3', '-1', '1', '-1', '', '-1', '1', '3', '6', '-5', '13', '-9', '16', '-12', '4', '-2', '978', '154', '309', '191');
INSERT INTO `recobro_excel` VALUES (36, 12, 4, '2', '2', '', '0', '', '10', '5', '0', '3', '0', '2', '-1', '4', '-1', '1', '0', '', '-1', '', '0', '11', '20', '3', '7', '7', '0', '1', '0', '1724', '360', '317', '423');
INSERT INTO `recobro_excel` VALUES (37, 12, 5, '1', '2', '3', '10', '', '2', '4', '1', '1', '3', '5', '10', '3', '1', '', '-7', '1', '0', '', '1', '17', '-1', '12', '-2', '9', '-10', '8', '-4', '1839', '297', '508', '308');
INSERT INTO `recobro_excel` VALUES (38, 12, 6, '1', '8', '', '5', '2', '2', '', '1', '4', '3', '8', '-1', '4', '17', '2', '1', '', '1', '2', '-2', '9', '-2', '7', '0', '12', '8', '11', '3', '2202', '352', '418', '341');
INSERT INTO `recobro_excel` VALUES (39, 12, 7, '', '4', '2', '1', '', '2', '6', '-1', '2', '1', '2', '0', '8', '8', '4', '-10', '2', '-1', '', '1', '12', '-3', '12', '-9', '16', '-6', '5', '0', '2045', '344', '397', '396');
INSERT INTO `recobro_excel` VALUES (40, 12, 8, '', '1', '1', '3', '3', '-41', '1', '0', '6', '-1', '10', '-5', '7', '-1', '2', '3', '6', '-5', '4', '11', '3', '4', '8', '1', '9', '9', '3', '2', '1637', '240', '341', '440');
INSERT INTO `recobro_excel` VALUES (41, 12, 1, '1', '1', '3', '-6', '1', '2', '2', '45', '12', '-10', '13', '-14', '11', '-5', '2', '2', '5', '-2', '', '1', '10', '2', '4', '-11', '6', '-45', '4', '2', '1633', '365', '327', '272');
INSERT INTO `recobro_excel` VALUES (42, 12, 2, '', '0', '4', '2', '3', '10', '8', '-5', '14', '-7', '6', '23', '10', '-4', '3', '1', '1', '0', '', '2', '2', '2', '6', '0', '6', '0', '2', '0', '1457', '237', '445', '282');
INSERT INTO `recobro_excel` VALUES (43, 12, 3, '4', '7', '1', '7', '', '11', '15', '-6', '12', '-8', '14', '-5', '12', '-4', '3', '0', '3', '-3', '3', '0', '2', '5', '15', '17', '5', '20', '2', '-56', '1506', '262', '340', '335');
INSERT INTO `recobro_excel` VALUES (44, 12, 4, '0', '0', '', '1', '', '2', '21', '-6', '17', '2', '9', '1', '22', '1', '7', '1', '6', '5', '7', '-2', '14', '2', '33', '-5', '19', '-3', '1', '1', '978', '181', '223', '304');
INSERT INTO `recobro_excel` VALUES (45, 12, 5, '1', '5', '1', '5', '1', '3', '17', '-4', '22', '0', '7', '5', '17', '71', '3', '42', '2', '4', '3', '-1', '10', '3', '38', '-13', '32', '-16', '8', '-3', '955', '310', '306', '83');
INSERT INTO `recobro_excel` VALUES (46, 12, 6, '2', '2', '4', '0', '1', '27', '28', '-1', '10', '-3', '6', '4', '12', '0', '3', '7', '6', '9', '7', '-4', '23', '130', '44', '-14', '54', '-29', '6', '-4', '981', '191', '173', '390');
INSERT INTO `recobro_excel` VALUES (47, 12, 7, '', '3', '5', '-1', '2', '-131', '18', '6', '22', '11', '10', '-2', '27', '8', '9', '-3', '1', '2', '8', '1', '26', '36', '46', '87', '45', '119', '5', '6', '940', '242', '203', '164');
INSERT INTO `recobro_excel` VALUES (48, 12, 8, '1', '61', '2', '0', '3', '14', '18', '53', '28', '8', '13', '54', '21', '-6', '2', '34', '4', '6', '11', '7', '11', '12', '29', '0', '41', '0', '6', '0', '755', '118', '77', '266');
INSERT INTO `recobro_excel` VALUES (49, 12, 1, '4', '1', '3', '2', '4', '0', '22', '14', '24', '21', '10', '62', '24', '26', '5', '-1', '11', '11', '7', '3', '17', '3', '40', '-23', '30', '-23', '9', '-3', '674', '188', '115', '160');
INSERT INTO `recobro_excel` VALUES (50, 12, 2, '2', '-1', '4', '10', '5', '10', '16', '-3', '17', '7', '12', '-51', '17', '3', '13', '-3', '8', '-4', '7', '9', '26', '-4', '25', '-5', '31', '-6', '6', '-26', '586', '120', '42', '68');
INSERT INTO `recobro_excel` VALUES (51, 12, 3, '1', '18', '3', '47', '1', '0', '16', '112', '15', '70', '16', '62', '31', '3', '13', '4', '4', '13', '17', '0', '30', '-12', '31', '-16', '37', '8', '4', '-5', '603', '72', '194', '79');
INSERT INTO `recobro_excel` VALUES (52, 12, 4, '7', '10', '1', '66', '4', '70', '17', '41', '19', '70', '22', '17', '22', '0', '11', '9', '3', '7', '21', '0', '15', '5', '40', '11', '50', '0', '3', '1', '488', '165', '30', '60');
INSERT INTO `recobro_excel` VALUES (53, 12, 5, '7', '-59', '3', '33', '2', '7', '45', '88', '26', '90', '55', '110', '35', '22', '11', '19', '4', '1', '9', '-10', '23', '-17', '36', '75', '50', '38', '4', '2', '553', '464', '', '');

-- ----------------------------
-- Table structure for rol
-- ----------------------------
DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol`  (
  `rol_id` int NOT NULL AUTO_INCREMENT,
  `rol` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`rol_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of rol
-- ----------------------------
INSERT INTO `rol` VALUES (1, 'admin', 1);
INSERT INTO `rol` VALUES (2, 'empleado', 1);
INSERT INTO `rol` VALUES (3, 'Bodegero de cajas', 1);
INSERT INTO `rol` VALUES (7, 'NUEVO ROL', 1);

-- ----------------------------
-- Table structure for tipo_cinta
-- ----------------------------
DROP TABLE IF EXISTS `tipo_cinta`;
CREATE TABLE `tipo_cinta`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `semana` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tipo_cinta
-- ----------------------------
INSERT INTO `tipo_cinta` VALUES (1, 'semana 1', '#d71d1d');
INSERT INTO `tipo_cinta` VALUES (2, 'semana 2', '#cb34a3');
INSERT INTO `tipo_cinta` VALUES (3, 'semana 3', '#cfbfcb');
INSERT INTO `tipo_cinta` VALUES (4, 'semana 4', '#000000');
INSERT INTO `tipo_cinta` VALUES (5, 'semana 5', '#e4dd11');
INSERT INTO `tipo_cinta` VALUES (6, 'semana 6', '#16fd12');
INSERT INTO `tipo_cinta` VALUES (7, 'semana 7', '#3f9282');
INSERT INTO `tipo_cinta` VALUES (8, 'semana 8', '#3275e2');

-- ----------------------------
-- Table structure for tipo_herramienta
-- ----------------------------
DROP TABLE IF EXISTS `tipo_herramienta`;
CREATE TABLE `tipo_herramienta`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo_herramienta` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tipo_herramienta
-- ----------------------------
INSERT INTO `tipo_herramienta` VALUES (1, 'martillo editado', 1);
INSERT INTO `tipo_herramienta` VALUES (2, 'machete', 1);

-- ----------------------------
-- Table structure for tipo_insumo
-- ----------------------------
DROP TABLE IF EXISTS `tipo_insumo`;
CREATE TABLE `tipo_insumo`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo_insumo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tipo_insumo
-- ----------------------------
INSERT INTO `tipo_insumo` VALUES (1, 'fundas1', 1);
INSERT INTO `tipo_insumo` VALUES (2, 'cloro', 1);

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `usuario_id` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `apellidos` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `correo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `cedula` char(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `usuario` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `contraseña` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `rol_id` int NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`usuario_id`) USING BTREE,
  INDEX `rol_id`(`rol_id` ASC) USING BTREE,
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 'CRUZ', 'GRANDA', 'JOSEDELA@HOTMAIL.COM', '1212', 'admin', '123', 'img/usuario/IMG992022212748.png', 1, 1);
INSERT INTO `usuario` VALUES (2, 'JOORGE MOISES', 'RAMIREZ ZAVALA', 'elgamer-26@hotmail.com', '12121', 'admin1', '123', 'img/usuario/IMG392022203820.jpg', 2, 1);
INSERT INTO `usuario` VALUES (3, 'JOORGE MOISES', 'RAMIREZ ZAVALA', 'qlgamer-26@hotmail.com', '121211', 'admin123', 'Jorge12+{', 'img/usuario/IMG39202218328.jpg', 3, 1);

-- ----------------------------
-- Procedure structure for llamer_etiquetas
-- ----------------------------
DROP PROCEDURE IF EXISTS `llamer_etiquetas`;
delimiter ;;
CREATE PROCEDURE `llamer_etiquetas`()
BEGIN
DECLARE trabajador int;
DECLARE herramienta int;
DECLARE insumos int;
DECLARE produccion int;

SELECT COUNT(*) INTO trabajador from empleado WHERE estado = 1;
SELECT COUNT(*) INTO herramienta from herramienta WHERE estado = 1;
SELECT COUNT(*) INTO insumos from insumo WHERE estado = 1;
SELECT COUNT(*) INTO produccion from produccion WHERE estado = 1;
SELECT trabajador, herramienta, insumos, produccion;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for recobro_total_caidos_lote
-- ----------------------------
DROP PROCEDURE IF EXISTS `recobro_total_caidos_lote`;
delimiter ;;
CREATE PROCEDURE `recobro_total_caidos_lote`(in id int)
BEGIN

DECLARE lote1a INT;
DECLARE lote1b INT;
DECLARE lote1c INT;

DECLARE lote2 INT;
DECLARE lote3 INT;
DECLARE lote4 INT;
DECLARE lote5 INT;
DECLARE lote6 INT;
DECLARE lote7 INT;
DECLARE lote8 INT;

DECLARE loteA INT;
DECLARE loteB INT;
DECLARE loteC INT;
DECLARE loteD INT; 


DECLARE lote1a_s INT;
DECLARE lote1b_s INT;
DECLARE lote1c_s INT;

DECLARE lote2_s INT;
DECLARE lote3_s INT;
DECLARE lote4_s INT;
DECLARE lote5_s INT;
DECLARE lote6_s INT;
DECLARE lote7_s INT;
DECLARE lote8_s INT;

DECLARE loteA_s INT;
DECLARE loteB_s INT;
DECLARE loteC_s INT;
DECLARE loteD_s INT; 


CREATE TEMPORARY table tabla_temp_lotes( 
lote VARCHAR(50) DEFAULT NULL, 
total int DEFAULT NULL,
saldo int DEFAULT NULL);

	SELECT SUM(recobro_excel.1A_cai) INTO lote1a 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
	
	SELECT SUM(recobro_excel.1A_saldo) INTO lote1a_s 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total, saldo) VALUES ('LOTE 1A', lote1a, lote1a_s);
	
	
	SELECT SUM(recobro_excel.1B_cai) INTO lote1b 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
	
	SELECT SUM(recobro_excel.1B_saldo) INTO lote1b_s 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total, saldo) VALUES ('LOTE 1B', lote1b, lote1b_s);
	
	
	SELECT SUM(recobro_excel.1C_cai) INTO lote1c 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
	
	SELECT SUM(recobro_excel.1C_saldo) INTO lote1c_s 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total, saldo) VALUES ('LOTE 1C', lote1c, lote1c_s);
	
	
	SELECT SUM(recobro_excel.2_cai) INTO lote2 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
	
	SELECT SUM(recobro_excel.2_saldo) INTO lote2_s 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total, saldo) VALUES ('LOTE 2', lote2, lote2_s);
	
	
	SELECT SUM(recobro_excel.3_cai) INTO lote3 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
	
	SELECT SUM(recobro_excel.3_saldo) INTO lote3_s 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total, saldo) VALUES ('LOTE 3', lote3, lote3_s);
	
	
	SELECT SUM(recobro_excel.4_cai) INTO lote4 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
	
	SELECT SUM(recobro_excel.4_saldo) INTO lote4_s
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total, saldo) VALUES ('LOTE 4', lote4, lote4_s);
	
	
	SELECT SUM(recobro_excel.5_cai) INTO lote5 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
	
	SELECT SUM(recobro_excel.5_saldo) INTO lote5_s 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total, saldo) VALUES ('LOTE 5', lote5, lote5_s);
	
	
	SELECT SUM(recobro_excel.6_cai) INTO lote6 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
	
	SELECT SUM(recobro_excel.6_saldo) INTO lote6_s 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total, saldo) VALUES ('LOTE 6', lote6, lote6_s);
	
	
	SELECT SUM(recobro_excel.7_cai) INTO lote7 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
	
	SELECT SUM(recobro_excel.7_saldo) INTO lote7_s 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total, saldo) VALUES ('LOTE 7', lote7, lote7_s);
	
	
	SELECT SUM(recobro_excel.8_cai) INTO lote8 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
	
	SELECT SUM(recobro_excel.8_saldo) INTO lote8_s 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total, saldo) VALUES ('LOTE 8', lote8, lote8_s);
	
	
	SELECT SUM(recobro_excel.A_cai) INTO loteA 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
	
	SELECT SUM(recobro_excel.A_saldo) INTO loteA_s 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total, saldo) VALUES ('LOTE A', loteA, loteA_s);
	
	
	SELECT SUM(recobro_excel.B_cai) INTO loteB 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
	
	SELECT SUM(recobro_excel.B_saldo) INTO loteB_s 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total, saldo) VALUES ('LOTE B', loteB, loteB_s);
	
	
	SELECT SUM(recobro_excel.C_cai) INTO loteC 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
	
	SELECT SUM(recobro_excel.C_saldo) INTO loteC_s 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total, saldo) VALUES ('LOTE C', loteC, loteC_s);
	
	
	SELECT SUM(recobro_excel.D_cai) INTO loteD 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
	
	SELECT SUM(recobro_excel.D_saldo) INTO loteD_s 
	FROM recobro_excel 
	WHERE recobro_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total, saldo) VALUES ('LOTE D', loteD, loteD_s);
	
	
	SELECT * FROM tabla_temp_lotes;
	DROP TABLE tabla_temp_lotes;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for total_enfunde_lotes
-- ----------------------------
DROP PROCEDURE IF EXISTS `total_enfunde_lotes`;
delimiter ;;
CREATE PROCEDURE `total_enfunde_lotes`(in id int)
BEGIN

DECLARE lote1a INT;
DECLARE lote1b INT;
DECLARE lote1c INT;

DECLARE lote2 INT;
DECLARE lote3 INT;
DECLARE lote4 INT;
DECLARE lote5 INT;
DECLARE lote6 INT;
DECLARE lote7 INT;
DECLARE lote8 INT;

DECLARE loteA INT;
DECLARE loteB INT;
DECLARE loteC INT;
DECLARE loteD INT; 

CREATE TEMPORARY table tabla_temp_lotes( 
lote VARCHAR(50) DEFAULT NULL, 
total int DEFAULT NULL);

	SELECT SUM(enfunde_excel.lote_1A) INTO lote1a 
	FROM enfunde_excel 
	WHERE enfunde_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total) VALUES ('LOTE 1A', lote1a);
		
	SELECT SUM(enfunde_excel.lote_1B) INTO lote1b 
	FROM enfunde_excel 
	WHERE enfunde_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total) VALUES ('LOTE 1B', lote1b);
	
	SELECT SUM(enfunde_excel.lote_1C) INTO lote1c 
	FROM enfunde_excel 
	WHERE enfunde_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total) VALUES ('LOTE 1C', lote1c);
	
	SELECT SUM(enfunde_excel.lote_2) INTO lote2 
	FROM enfunde_excel 
	WHERE enfunde_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total) VALUES ('LOTE 2', lote2);
	
	SELECT SUM(enfunde_excel.lote_3) INTO lote3 
	FROM enfunde_excel 
	WHERE enfunde_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total) VALUES ('LOTE 3', lote3);
	
	SELECT SUM(enfunde_excel.lote_4) INTO lote4 
	FROM enfunde_excel 
	WHERE enfunde_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total) VALUES ('LOTE 4', lote4);
	
	SELECT SUM(enfunde_excel.lote_5) INTO lote5 
	FROM enfunde_excel 
	WHERE enfunde_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total) VALUES ('LOTE 5', lote5);
	
	SELECT SUM(enfunde_excel.lote_6) INTO lote6 
	FROM enfunde_excel 
	WHERE enfunde_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total) VALUES ('LOTE 6', lote6);
	
	SELECT SUM(enfunde_excel.lote_7) INTO lote7 
	FROM enfunde_excel 
	WHERE enfunde_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total) VALUES ('LOTE 7', lote7);
			
	SELECT SUM(enfunde_excel.lote_8) INTO lote8 
	FROM enfunde_excel 
	WHERE enfunde_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total) VALUES ('LOTE 8', lote8);
	
	SELECT SUM(enfunde_excel.lote_A) INTO loteA 
	FROM enfunde_excel 
	WHERE enfunde_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total) VALUES ('LOTE A', loteA);
	
	SELECT SUM(enfunde_excel.lote_B) INTO loteB 
	FROM enfunde_excel 
	WHERE enfunde_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total) VALUES ('LOTE B', loteB);
	
	SELECT SUM(enfunde_excel.lote_C) INTO loteC 
	FROM enfunde_excel 
	WHERE enfunde_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total) VALUES ('LOTE C', loteC);
	
	SELECT SUM(enfunde_excel.lote_D) INTO loteD 
	FROM enfunde_excel 
	WHERE enfunde_excel.id_excel = id;
		
	INSERT into tabla_temp_lotes (lote, total) VALUES ('LOTE D', loteD);
	
	
	SELECT * FROM tabla_temp_lotes;
	
	DROP TABLE tabla_temp_lotes;

END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
