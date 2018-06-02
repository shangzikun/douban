/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : douban

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2018-06-02 10:28:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ad
-- ----------------------------
DROP TABLE IF EXISTS `ad`;
CREATE TABLE `ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `starttime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ad
-- ----------------------------
INSERT INTO `ad` VALUES ('1', '1', 'upload/ad/2018-05-27/5b0a27c228d7b.png', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '2018-05-27 11:36:34', '2018-05-27 14:55:54');
INSERT INTO `ad` VALUES ('2', '', 'upload/ad/2018-05-27/5b0a102c291a2.png', 'http://www.baidu.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2', '2018-05-27 09:55:56', '2018-05-27 14:55:57');
INSERT INTO `ad` VALUES ('3', '', 'upload/ad/2018-05-27/5b0a1079e949a.png', 'www.baidu.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '2018-05-27 09:57:13', '2018-05-27 09:57:13');
INSERT INTO `ad` VALUES ('4', '', 'upload/ad/2018-05-27/5b0a131494fa8.png', 'www.baidu.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '2018-05-27 10:08:20', '2018-05-27 10:08:20');
INSERT INTO `ad` VALUES ('5', '33', 'upload/ad/2018-05-27/5b0a135e6aa23.png', 'www.baidu.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '2018-05-27 10:09:34', '2018-05-27 10:09:34');
INSERT INTO `ad` VALUES ('6', '1111', '', 'www.baidu.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '2018-05-27 11:22:08', '2018-05-27 11:22:08');

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `tag_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1', '1', '', 'upload/good/2018-05-26/5b0921fd5eac3.png', '', '30.00', '0', '2', '0000-00-00 00:00:00', '2018-05-27 14:52:42');
INSERT INTO `goods` VALUES ('2', '', '', '', '', '0.00', '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `goods` VALUES ('3', '', '', '', '', '0.00', '1', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `goods` VALUES ('4', '', '', '', '', '0.00', '1,2', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `goods` VALUES ('5', '2', '2', 'upload/good/2018-05-26/5b09241e57492.png', '2', '22.00', '1,3', '1', '2018-05-26 17:08:46', '2018-05-27 14:52:33');
INSERT INTO `goods` VALUES ('6', '444', '5555', 'upload/good/2018-05-27/5b0a1c4d184e5.png', '4444', '444.00', '1,3', '0', '2018-05-27 10:47:48', '2018-05-27 10:47:48');

-- ----------------------------
-- Table structure for shopcar
-- ----------------------------
DROP TABLE IF EXISTS `shopcar`;
CREATE TABLE `shopcar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL,
  `goods_name` varchar(255) NOT NULL,
  `goods_price` decimal(10,2) NOT NULL,
  `goods_img` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shopcar
-- ----------------------------

-- ----------------------------
-- Table structure for tag
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tag
-- ----------------------------
INSERT INTO `tag` VALUES ('1', '新品', 'green', '0');
INSERT INTO `tag` VALUES ('2', '520特惠', 'red', '0');
INSERT INTO `tag` VALUES ('3', '已售罄', 'grey', '0');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '123', '2147483647', '', '123123', '0');
