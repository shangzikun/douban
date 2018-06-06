/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : douban

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2018-06-06 21:01:20
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ad
-- ----------------------------
INSERT INTO `ad` VALUES ('1', '球球大作战', 'upload/ad/2018-06-02/5b123a0261051.png', 'http://www.baidu.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '2018-06-02 14:32:34', '2018-06-02 14:32:34');
INSERT INTO `ad` VALUES ('2', '111', 'upload/ad/2018-06-02/5b1239f4d0f26.jpg', 'http://www.baidu.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '2018-06-02 14:32:20', '2018-06-02 14:32:20');
INSERT INTO `ad` VALUES ('3', '22', 'upload/ad/2018-06-02/5b123a15cc766.jpg', 'http://www.baidu.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '2018-06-02 14:32:53', '2018-06-02 14:32:53');

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO `address` VALUES ('7', '三胖', '13244236185', '吉林省', '吉林市', '龙潭区', '', '0', '2018-06-06 20:58:46', '2018-06-06 20:58:46');
INSERT INTO `address` VALUES ('8', '小明', '13244235806', '北京市', '北京市市辖区', '东城区', '', '0', '2018-06-06 21:00:55', '2018-06-06 21:00:55');

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL,
  `goods_name` varchar(255) NOT NULL,
  `goods_price` decimal(10,2) NOT NULL,
  `goods_img` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `num` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_goods` (`goods_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cart
-- ----------------------------
INSERT INTO `cart` VALUES ('10', '1', '宝马', '16.00', 'upload/good/2018-06-02/5b1239867816d.png', '1', '123', '1');

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
  `price` int(11) NOT NULL,
  `tag_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1', '宝马', '豪车~~~·', 'upload/good/2018-06-02/5b1239867816d.png', '豪车~~~~', '16', '1,2', '0', '2018-06-02 14:30:30', '2018-06-02 14:30:30');
INSERT INTO `goods` VALUES ('2', '小黄人', '123', 'upload/good/2018-06-02/5b1239b125095.jpg', '123', '60', '1', '0', '2018-06-02 14:31:13', '2018-06-02 14:31:13');
INSERT INTO `goods` VALUES ('3', '火车', '666', 'upload/good/2018-06-02/5b123a6282390.JPG', '666', '90', '2', '0', '2018-06-02 14:34:10', '2018-06-02 14:34:10');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL DEFAULT '0',
  `address_id` int(11) NOT NULL DEFAULT '0',
  `pay_type` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `pay_status` int(11) NOT NULL DEFAULT '0',
  `shipping_status` int(11) NOT NULL DEFAULT '0',
  `shipping_type` varchar(30) NOT NULL DEFAULT '',
  `shipping_no` varchar(30) NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for order_goods
-- ----------------------------
DROP TABLE IF EXISTS `order_goods`;
CREATE TABLE `order_goods` (
  `id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `goods_id` int(11) NOT NULL DEFAULT '0',
  `goods_num` int(11) NOT NULL DEFAULT '0',
  `goods_price` int(11) NOT NULL DEFAULT '0',
  `order_money` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orderid` (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_goods
-- ----------------------------

-- ----------------------------
-- Table structure for order_tmp
-- ----------------------------
DROP TABLE IF EXISTS `order_tmp`;
CREATE TABLE `order_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_info` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_tmp
-- ----------------------------
INSERT INTO `order_tmp` VALUES ('33', '[{\"goods_id\":\"2\",\"goods_num\":\"1\"},{\"goods_id\":\"1\",\"goods_num\":\"1\"}]', '1');
INSERT INTO `order_tmp` VALUES ('34', '[{\"goods_id\":\"2\",\"goods_num\":\"1\"},{\"goods_id\":\"1\",\"goods_num\":\"1\"}]', '1');
INSERT INTO `order_tmp` VALUES ('35', '[{\"goods_id\":\"2\",\"goods_num\":\"1\"},{\"goods_id\":\"1\",\"goods_num\":\"2\"}]', '1');
INSERT INTO `order_tmp` VALUES ('36', '[{\"goods_id\":\"2\",\"goods_num\":\"2\"},{\"goods_id\":\"1\",\"goods_num\":\"2\"}]', '1');

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
  `phone` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '123', '13244235806', '', '123123', '0', '0');
