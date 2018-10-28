/*
Navicat MySQL Data Transfer

Source Server         : root
Source Server Version : 50637
Source Host           : localhost:3306
Source Database       : quiz

Target Server Type    : MYSQL
Target Server Version : 50637
File Encoding         : 65001

Date: 2018-10-28 21:28:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for answer
-- ----------------------------
DROP TABLE IF EXISTS `answer`;
CREATE TABLE `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `is_correct` tinyint(1) DEFAULT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_answer_question_id` (`question_id`),
  CONSTRAINT `fk_answer_question_id` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of answer
-- ----------------------------
INSERT INTO `answer` VALUES ('1', '4', '1', '1');
INSERT INTO `answer` VALUES ('2', '3', '0', '1');
INSERT INTO `answer` VALUES ('3', '5', '0', '1');
INSERT INTO `answer` VALUES ('4', '100500', '0', '1');
INSERT INTO `answer` VALUES ('5', '5', '0', '2');
INSERT INTO `answer` VALUES ('6', '8', '1', '2');
INSERT INTO `answer` VALUES ('7', '10', '0', '2');
INSERT INTO `answer` VALUES ('8', '5', '0', '4');
INSERT INTO `answer` VALUES ('9', '7', '1', '4');
INSERT INTO `answer` VALUES ('10', 'Много', '0', '4');
INSERT INTO `answer` VALUES ('11', '365', '0', '4');
INSERT INTO `answer` VALUES ('12', 'Я не знаю', '0', '1');
INSERT INTO `answer` VALUES ('13', 'Что такое PHP?', '0', '2');
INSERT INTO `answer` VALUES ('14', '20', '0', '2');
INSERT INTO `answer` VALUES ('15', '0', '0', '4');

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1540635148');
INSERT INTO `migration` VALUES ('m181027_100040_dump', '1540637483');
INSERT INTO `migration` VALUES ('m181028_135954_create_table_result', '1540747616');

-- ----------------------------
-- Table structure for question
-- ----------------------------
DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of question
-- ----------------------------
INSERT INTO `question` VALUES ('1', '2+2');
INSERT INTO `question` VALUES ('2', 'Сколько типов данных в PHP?');
INSERT INTO `question` VALUES ('4', 'Сколько дней в неделе?');

-- ----------------------------
-- Table structure for result
-- ----------------------------
DROP TABLE IF EXISTS `result`;
CREATE TABLE `result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_id` varchar(255) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_result_question_id` (`question_id`),
  KEY `fk_result_answer_id` (`answer_id`),
  CONSTRAINT `fk_result_answer_id` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_result_question_id` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of result
-- ----------------------------
INSERT INTO `result` VALUES ('1', '5bd5f16b24ed9', '1', '1');
INSERT INTO `result` VALUES ('2', '5bd5f16b24ed9', '2', '6');
INSERT INTO `result` VALUES ('3', '5bd5f16b24ed9', '4', '9');
