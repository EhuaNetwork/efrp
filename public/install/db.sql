/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : frpc_cn

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 11/01/2022 10:21:20
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ecms_admin
-- ----------------------------
DROP TABLE IF EXISTS `ecms_admin`;
CREATE TABLE `ecms_admin`  (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pass` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `uptime` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ecms_admin
-- ----------------------------
INSERT INTO `ecms_admin` VALUES (1, 'admin', '$2y$10$6OuHYIOaQOzww8uLEiLtLehSfPYd5qtTub.w0.95VKm2ASOcNDeJe', '127.0.0.1', '2021-03-18 14:25:41');

-- ----------------------------
-- Table structure for ecms_article
-- ----------------------------
DROP TABLE IF EXISTS `ecms_article`;
CREATE TABLE `ecms_article`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '新闻表',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  `status` int(3) NULL DEFAULT 1,
  `top` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `port` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remote_ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remote_port` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ecms_article
-- ----------------------------
INSERT INTO `ecms_article` VALUES (11, '154', '演示站', '2022-01-11 10:15:50', '2022-01-11 10:15:50', 1, NULL, '127.0.0.1', '260', '103.45.128.17', '260');

-- ----------------------------
-- Table structure for ecms_mod
-- ----------------------------
DROP TABLE IF EXISTS `ecms_mod`;
CREATE TABLE `ecms_mod`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `upid` int(11) NULL DEFAULT NULL,
  `upid_all` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `top` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 159 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ecms_mod
-- ----------------------------
INSERT INTO `ecms_mod` VALUES (3, '默认分类', 0, '[0]', 75);
INSERT INTO `ecms_mod` VALUES (152, '客户演示', 3, '[0][3]', 0);
INSERT INTO `ecms_mod` VALUES (154, '局域网演示', 3, '[0][3]', 0);

-- ----------------------------
-- Table structure for ecms_system
-- ----------------------------
DROP TABLE IF EXISTS `ecms_system`;
CREATE TABLE `ecms_system`  (
  `key` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `value` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `as` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `top` int(255) NULL DEFAULT 0,
  `view` int(255) NULL DEFAULT 1
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ecms_system
-- ----------------------------
INSERT INTO `ecms_system` VALUES ('web_keywords', 'EFRPC内网映射', 'K', NULL, 0);
INSERT INTO `ecms_system` VALUES ('web_description', 'EFRPC内网映射', 'D', NULL, 0);
INSERT INTO `ecms_system` VALUES ('web_title', 'EFRPC内网映射', 'T', NULL, 0);
INSERT INTO `ecms_system` VALUES ('company', 'EFRPC内网映射（内网端）', '站点名称', 0, 1);
INSERT INTO `ecms_system` VALUES ('server_ip', '103.45.128.17', '服务器IP', 0, 1);
INSERT INTO `ecms_system` VALUES ('server_port', '7000', '服务器端口', 0, 1);

SET FOREIGN_KEY_CHECKS = 1;
