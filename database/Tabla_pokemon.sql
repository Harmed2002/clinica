/*
Navicat MySQL Data Transfer

Source Server         : MySQL8
Source Server Version : 80026
Source Host           : 127.0.0.1:3316
Source Database       : test_clinica

Target Server Type    : MYSQL
Target Server Version : 80026
File Encoding         : 65001

Date: 2023-09-01 23:27:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pokemon
-- ----------------------------
DROP TABLE IF EXISTS `pokemon`;
CREATE TABLE `pokemon` (
`id`  bigint UNSIGNED NOT NULL AUTO_INCREMENT ,
`name`  varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL ,
`attack`  tinyint UNSIGNED NOT NULL ,
`defense`  tinyint UNSIGNED NOT NULL ,
`speed`  tinyint UNSIGNED NOT NULL ,
`image`  varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT NULL ,
`created_at`  timestamp NULL DEFAULT NULL ,
`updated_at`  timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP ,
`deleted_at`  timestamp NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_spanish_ci

;

-- ----------------------------
-- Records of pokemon
-- ----------------------------
BEGIN;
INSERT INTO `pokemon` VALUES ('1', 'Venusaur', '80', '80', '80', null, null, '2023-09-02 02:48:10', null), ('2', 'Charizard', '84', '78', '100', null, null, '2023-09-01 14:38:10', null), ('3', 'Blastoise', '83', '100', '78', null, null, '2023-09-01 14:38:15', null), ('4', 'Butterfree', '45', '50', '70', null, null, '2023-09-01 14:38:19', null), ('5', 'Beedrill', '90', '40', '75', null, null, '2023-09-01 14:38:21', null), ('6', 'Pidgeot', '80', '75', '101', null, null, '2023-09-01 14:38:22', null), ('7', 'Raichu', '90', '55', '110', null, null, '2023-09-01 14:38:24', null), ('8', 'Sandslash', '100', '110', '65', null, null, '2023-09-01 14:38:25', null), ('9', 'Clefable', '70', '73', '60', null, null, '2023-09-01 14:38:26', null), ('10', 'Poliwrath', '95', '95', '70', null, null, '2023-09-01 14:38:29', null), ('11', 'Gengar', '65', '60', '110', null, null, '2023-09-01 14:38:30', null), ('12', 'Jynx', '50', '35', '95', null, null, '2023-09-01 14:38:31', null), ('13', 'Omastar', '60', '125', '55', null, null, '2023-09-01 14:38:33', null), ('14', 'Metagross', '135', '130', '70', null, null, '2023-09-01 14:38:35', null), ('15', 'Hydreigon', '105', '90', '98', null, null, '2023-09-01 14:38:39', null), ('16', 'Harold Medina', '1', '1', '1', null, '2023-09-01 23:47:42', '2023-09-01 21:49:17', '2023-09-02 02:48:32');
COMMIT;
