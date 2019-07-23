/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : study

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-07-24 01:11:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for st_admin
-- ----------------------------
DROP TABLE IF EXISTS `st_admin`;
CREATE TABLE `st_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of st_admin
-- ----------------------------
INSERT INTO `st_admin` VALUES ('1', 'admin1', 'admin', '4297f44b13955235245b2497399d7a93', '123123', '2019-07-23 14:22:55', '127.0.0.1', '2019-01-21 00:21:06');

-- ----------------------------
-- Table structure for st_adv
-- ----------------------------
DROP TABLE IF EXISTS `st_adv`;
CREATE TABLE `st_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '名称',
  `image` varchar(100) NOT NULL DEFAULT '' COMMENT '图片地址',
  `url` varchar(50) NOT NULL DEFAULT '' COMMENT '转跳链接',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1首页2申购币',
  `sort` smallint(5) NOT NULL DEFAULT '1' COMMENT '排序越大越靠前，最大99999',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1正常2禁用3删除',
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='广告表';

-- ----------------------------
-- Records of st_adv
-- ----------------------------
INSERT INTO `st_adv` VALUES ('1', '123', '/uploads/adv/20190720\\928378f286654e4752350ad02ec823fd.png', '', '1', '1', '3', '2019-07-20 10:51:58');
INSERT INTO `st_adv` VALUES ('2', '1', '/uploads/adv/20190720\\904845d843b54318a9d82b3333db96e9.jpg', '', '1', '10', '1', '2019-07-20 10:56:00');
INSERT INTO `st_adv` VALUES ('3', '2', '/uploads/adv/20190720\\dbc868ceb0da4cc341c13871a5ebd5d4.jpg', '', '1', '9', '1', '2019-07-20 10:56:13');
INSERT INTO `st_adv` VALUES ('4', '3', '/uploads/adv/20190720\\ed8f4558da0d031d24c7ef1437190165.png', '', '1', '8', '1', '2019-07-20 10:56:24');
INSERT INTO `st_adv` VALUES ('5', '4', '/uploads/adv/20190720\\77087f60948f7f8295910af8f51a2e8e.png', '', '2', '10', '1', '2019-07-20 10:57:04');
INSERT INTO `st_adv` VALUES ('6', '5', '/uploads/adv/20190720\\73de558c8b008095167ad0a50d76ac75.png', '', '2', '9', '1', '2019-07-20 10:57:14');
INSERT INTO `st_adv` VALUES ('7', '6', '/uploads/adv/20190720\\ae613b9d5a68f39ec36287714ab447d5.png', '', '2', '8', '1', '2019-07-20 10:57:27');

-- ----------------------------
-- Table structure for st_agent
-- ----------------------------
DROP TABLE IF EXISTS `st_agent`;
CREATE TABLE `st_agent` (
  `agent_id` int(11) NOT NULL AUTO_INCREMENT,
  `agent_name` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `p_agent_id` int(11) NOT NULL DEFAULT '0',
  `password` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `money` decimal(20,6) DEFAULT '0.000000',
  `code` varchar(255) DEFAULT NULL,
  `invite_number` varchar(255) DEFAULT NULL,
  `login_status` tinyint(1) DEFAULT '1',
  `invite_status` tinyint(1) DEFAULT '1',
  `status` tinyint(1) DEFAULT '1',
  `last_login_time` datetime DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  `add_ip` varchar(255) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`agent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='代理表';

-- ----------------------------
-- Records of st_agent
-- ----------------------------
INSERT INTO `st_agent` VALUES ('2', 'ertert', 'werwer11', '0', 'e10adc3949ba59abbe56e057f20f883e', '123456', '111.000000', '', '370523', '1', '1', '1', null, null, '2019-07-06 12:44:33', null, '2019-07-06 13:17:14');
INSERT INTO `st_agent` VALUES ('3', 'rtrtrtrtyr', '123', '0', '8b38d8cdd602df02fa34172fc246ad49', '4545454', '0.000000', '', '932781', '1', '1', '2', null, null, '2019-07-06 13:13:18', '127.0.0.1', '2019-07-06 13:13:18');
INSERT INTO `st_agent` VALUES ('4', 'fgfgfgfgf', 'ertert', '2', 'd3a17e3b704b2991a8e150808441d4c8', 'sdsdfrtr', '0.000000', '', '564469', '1', '1', '2', null, null, '2019-07-06 13:13:28', '127.0.0.1', '2019-07-06 13:13:28');
INSERT INTO `st_agent` VALUES ('5', 'dfgdghgh', 'rerer1', '2', '3af2be585b9264b63e037962063a712f', 'rtrtrtyhty', '0.000000', '', '167504', '1', '1', '1', null, null, '2019-07-06 13:19:28', '127.0.0.1', '2019-07-07 10:18:10');
INSERT INTO `st_agent` VALUES ('6', '123456', '123123', '0', '4297f44b13955235245b2497399d7a93', '123123', '121.000000', '/uploads/code/156335577914470.png', '4222', '1', '1', '1', '2019-07-17 17:29:36', '127.0.0.1', '2019-07-09 18:57:08', '127.0.0.1', '2019-07-09 18:57:08');
INSERT INTO `st_agent` VALUES ('7', '123123444', '123123', '0', '4297f44b13955235245b2497399d7a93', '123123', '0.000000', '', '5813', '1', '1', '1', null, null, '2019-07-09 19:23:39', '127.0.0.1', '2019-07-09 19:23:39');
INSERT INTO `st_agent` VALUES ('8', 'ertertertrgh', '123123', '0', '4297f44b13955235245b2497399d7a93', '123123', '0.000000', '', '2755', '1', '1', '1', null, null, '2019-07-09 19:24:14', '127.0.0.1', '2019-07-09 19:24:14');
INSERT INTO `st_agent` VALUES ('9', 'werwert4', '234234', '6', '0e9212587d373ca58e9bada0c15e6fe4', '234234', '0.000000', '', '3279', '1', '1', '1', null, null, '2019-07-09 19:24:37', '127.0.0.1', '2019-07-09 19:24:37');

-- ----------------------------
-- Table structure for st_agent_money_log
-- ----------------------------
DROP TABLE IF EXISTS `st_agent_money_log`;
CREATE TABLE `st_agent_money_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agent_id` int(11) DEFAULT NULL,
  `agent_name` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `from_oid` int(11) DEFAULT NULL,
  `operation_id` int(11) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1提现2上/下分3其他',
  `type_info` varchar(255) DEFAULT NULL,
  `before_money` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `money` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `after_money` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `add_time` datetime DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='代理资金记录';

-- ----------------------------
-- Records of st_agent_money_log
-- ----------------------------
INSERT INTO `st_agent_money_log` VALUES ('1', '2', 'ertert', null, '14', '14', '1', '上分', '0.000000', '1.000000', '1.000000', '2019-07-06 13:03:28', '平台操作代理ertert上分');
INSERT INTO `st_agent_money_log` VALUES ('2', '2', 'ertert', null, '16', '16', '1', '上分', '1.000000', '1.000000', '2.000000', '2019-07-06 13:05:57', '平台操作代理ertert上分');
INSERT INTO `st_agent_money_log` VALUES ('3', '2', 'ertert', null, '17', '17', '1', '下分', '2.000000', '-1.000000', '1.000000', '2019-07-06 13:06:00', '平台操作代理ertert下分');
INSERT INTO `st_agent_money_log` VALUES ('4', '2', 'ertert', null, '22', '22', '1', '下分', '1.000000', '-1.000000', '0.000000', '2019-07-06 13:19:07', '平台操作代理ertert下分');
INSERT INTO `st_agent_money_log` VALUES ('5', '2', 'ertert', null, '1', '60', '2', '代理提现', '0.000000', '111.000000', '111.000000', '2019-07-08 23:28:11', '代理提现失败');
INSERT INTO `st_agent_money_log` VALUES ('6', '6', '123456', '123123', '79', '79', '2', '上分', '0.000000', '123.000000', '123.000000', '2019-07-09 20:43:47', '平台操作代理123456上分');
INSERT INTO `st_agent_money_log` VALUES ('7', '6', '123456', '123123', '2', '82', '1', '代理提现', '123.000000', '1.000000', '122.000000', '2019-07-09 22:17:25', '代理发起提现');
INSERT INTO `st_agent_money_log` VALUES ('8', '6', '123456', '123123', '3', '83', '1', '代理提现', '122.000000', '2.000000', '120.000000', '2019-07-09 22:25:53', '代理发起提现');
INSERT INTO `st_agent_money_log` VALUES ('9', '6', '123456', '123123', '2', '85', '1', '代理提现', '120.000000', '1.000000', '121.000000', '2019-07-09 22:26:15', '代理提现失败');
INSERT INTO `st_agent_money_log` VALUES ('10', '6', '123456', '123123', '4', '95', '1', '代理提现', '121.000000', '23.000000', '98.000000', '2019-07-18 12:50:51', '代理发起提现');
INSERT INTO `st_agent_money_log` VALUES ('11', '6', '123456', '123123', '4', '96', '1', '代理提现', '98.000000', '23.000000', '121.000000', '2019-07-18 12:51:01', '代理提现失败');

-- ----------------------------
-- Table structure for st_agent_withdraw_log
-- ----------------------------
DROP TABLE IF EXISTS `st_agent_withdraw_log`;
CREATE TABLE `st_agent_withdraw_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agent_id` int(11) DEFAULT NULL,
  `agent_name` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `money` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `bank_info_id` int(11) DEFAULT NULL,
  `name` varchar(6) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `bank_name` varchar(20) DEFAULT '',
  `branch_name` varchar(50) DEFAULT NULL,
  `bank_card` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '1待审核2已通过3已拒绝',
  `add_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='代理提现表';

-- ----------------------------
-- Records of st_agent_withdraw_log
-- ----------------------------
INSERT INTO `st_agent_withdraw_log` VALUES ('1', '2', 'ertert', 'werwer11', '111.000000', '1', 'qwed', null, '1', '123', '123', '3', '2019-07-08 23:25:22', '2019-07-08 23:28:11', '1');
INSERT INTO `st_agent_withdraw_log` VALUES ('2', '6', '123456', '123123', '1.000000', '2', '网二', '13138602015', '招商银行', null, '4102512365112356', '3', '2019-07-09 22:17:25', '2019-07-09 22:26:15', '123');
INSERT INTO `st_agent_withdraw_log` VALUES ('3', '6', '123456', '123123', '2.000000', '2', '网二', '13138602015', '招商银行', '1313', '4102512365112356', '2', '2019-07-09 22:25:53', '2019-07-09 22:26:12', '审核通过');
INSERT INTO `st_agent_withdraw_log` VALUES ('4', '6', '123456', '123123', '23.000000', '2', '网二', '13138602015', '招商银行', '1313', '4102512365112356', '3', '2019-07-18 12:50:51', '2019-07-18 12:51:01', '123123123');

-- ----------------------------
-- Table structure for st_apply_coin
-- ----------------------------
DROP TABLE IF EXISTS `st_apply_coin`;
CREATE TABLE `st_apply_coin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `abbreviation` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `describe` varchar(255) DEFAULT NULL,
  `price` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `min_hand` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `max_hand` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `sell_amount` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `give_amount` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `add_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `show_status` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='申购币表';

-- ----------------------------
-- Records of st_apply_coin
-- ----------------------------
INSERT INTO `st_apply_coin` VALUES ('1', '2311', '123', '/uploads/adv/20190720\\f5ac2ee09604845a7d2188d3f156f36d.png', '234', '234.000000', '234.000000', '1.000000', '0.000000', '0.000000', '2019-07-08 11:49:36', '2019-07-20 10:47:47', '1', '1');
INSERT INTO `st_apply_coin` VALUES ('2', '45', '234', '/uploads/adv/20190720\\9107c42f795c409df221397fcf190945.png', 'dt', '3.000000', '3.000000', '1.000000', '0.000000', '0.000000', '2019-07-08 18:54:27', '2019-07-20 10:47:41', '1', '1');

-- ----------------------------
-- Table structure for st_apply_coin_give_log
-- ----------------------------
DROP TABLE IF EXISTS `st_apply_coin_give_log`;
CREATE TABLE `st_apply_coin_give_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `apply_coin_id` int(11) DEFAULT NULL,
  `apply_coin_name` varchar(255) DEFAULT NULL,
  `number` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `give_uid` int(11) DEFAULT '0',
  `give_username` varchar(255) DEFAULT NULL,
  `from_oid` int(11) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='申购币赠送记录';

-- ----------------------------
-- Records of st_apply_coin_give_log
-- ----------------------------
INSERT INTO `st_apply_coin_give_log` VALUES ('2', '1', '13138602014', 'asdasd', '2', '45', '0.100000', '2', '18237837598', '2', '2019-07-20 12:48:49');
INSERT INTO `st_apply_coin_give_log` VALUES ('3', '1', '13138602014', 'asdasd', '2', '45', '0.500000', '2', '18237837598', '3', '2019-07-20 12:49:54');
INSERT INTO `st_apply_coin_give_log` VALUES ('4', '1', '13138602014', 'asdasd', '2', '45', '0.050000', '2', '18237837598', '4', '2019-07-20 12:53:40');
INSERT INTO `st_apply_coin_give_log` VALUES ('5', '1', '13138602014', 'asdasd', '2', '45', '0.050000', '2', '18237837598', '5', '2019-07-22 23:30:36');

-- ----------------------------
-- Table structure for st_apply_coin_order_log
-- ----------------------------
DROP TABLE IF EXISTS `st_apply_coin_order_log`;
CREATE TABLE `st_apply_coin_order_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `apply_coin_id` int(11) DEFAULT NULL,
  `apply_coin_name` varchar(255) DEFAULT NULL,
  `number` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `price` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '单币价格',
  `amount` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '消费金额',
  `add_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='申购币获取记录';

-- ----------------------------
-- Records of st_apply_coin_order_log
-- ----------------------------
INSERT INTO `st_apply_coin_order_log` VALUES ('1', '2', '18237837598', '34234', '2', '45', '1.000000', '3.000000', '9.000000', '2019-07-20 12:43:17');
INSERT INTO `st_apply_coin_order_log` VALUES ('2', '2', '18237837598', '34234', '2', '45', '2.000000', '3.000000', '18.000000', '2019-07-20 12:48:49');
INSERT INTO `st_apply_coin_order_log` VALUES ('3', '2', '18237837598', '34234', '2', '45', '10.000000', '3.000000', '90.000000', '2019-07-20 12:49:54');
INSERT INTO `st_apply_coin_order_log` VALUES ('4', '2', '18237837598', '34234', '2', '45', '1.000000', '3.000000', '9.000000', '2019-07-20 12:53:40');
INSERT INTO `st_apply_coin_order_log` VALUES ('5', '2', '18237837598', '34234', '2', '45', '1.000000', '3.000000', '9.000000', '2019-07-22 23:30:36');

-- ----------------------------
-- Table structure for st_bank
-- ----------------------------
DROP TABLE IF EXISTS `st_bank`;
CREATE TABLE `st_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(20) NOT NULL COMMENT '银行名称',
  PRIMARY KEY (`id`),
  KEY `bank_name` (`bank_name`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8 COMMENT='银行表';

-- ----------------------------
-- Records of st_bank
-- ----------------------------
INSERT INTO `st_bank` VALUES ('104', '三门峡银行');
INSERT INTO `st_bank` VALUES ('32', '上海银行');
INSERT INTO `st_bank` VALUES ('19', '东亚银行');
INSERT INTO `st_bank` VALUES ('52', '东莞银行');
INSERT INTO `st_bank` VALUES ('9', '中信银行');
INSERT INTO `st_bank` VALUES ('8', '中国银行');
INSERT INTO `st_bank` VALUES ('58', '临商银行');
INSERT INTO `st_bank` VALUES ('72', '丹东银行');
INSERT INTO `st_bank` VALUES ('54', '乌鲁木齐商业银行');
INSERT INTO `st_bank` VALUES ('78', '九江银行');
INSERT INTO `st_bank` VALUES ('4', '交通银行');
INSERT INTO `st_bank` VALUES ('10', '光大银行');
INSERT INTO `st_bank` VALUES ('73', '兰州银行');
INSERT INTO `st_bank` VALUES ('24', '兴业银行');
INSERT INTO `st_bank` VALUES ('94', '内蒙古银行');
INSERT INTO `st_bank` VALUES ('7', '农业银行');
INSERT INTO `st_bank` VALUES ('98', '包商银行');
INSERT INTO `st_bank` VALUES ('34', '北京银行');
INSERT INTO `st_bank` VALUES ('11', '华夏银行');
INSERT INTO `st_bank` VALUES ('51', '南京银行');
INSERT INTO `st_bank` VALUES ('74', '南昌银行');
INSERT INTO `st_bank` VALUES ('77', '南通商业银行');
INSERT INTO `st_bank` VALUES ('33', '厦门银行');
INSERT INTO `st_bank` VALUES ('83', '台州银行');
INSERT INTO `st_bank` VALUES ('36', '吉林银行');
INSERT INTO `st_bank` VALUES ('68', '哈尔滨银行');
INSERT INTO `st_bank` VALUES ('107', '商丘市商业银行');
INSERT INTO `st_bank` VALUES ('91', '嘉兴银行');
INSERT INTO `st_bank` VALUES ('47', '大连银行');
INSERT INTO `st_bank` VALUES ('100', '威海商业银行');
INSERT INTO `st_bank` VALUES ('62', '宁夏银行');
INSERT INTO `st_bank` VALUES ('38', '宁波银行');
INSERT INTO `st_bank` VALUES ('108', '安徽省农村信用社');
INSERT INTO `st_bank` VALUES ('59', '宜昌市商业银行');
INSERT INTO `st_bank` VALUES ('89', '富滇银行');
INSERT INTO `st_bank` VALUES ('6', '工商银行');
INSERT INTO `st_bank` VALUES ('14', '平安银行');
INSERT INTO `st_bank` VALUES ('13', '广发银行');
INSERT INTO `st_bank` VALUES ('41', '广州银行');
INSERT INTO `st_bank` VALUES ('97', '广西北部湾银行');
INSERT INTO `st_bank` VALUES ('92', '廊坊银行');
INSERT INTO `st_bank` VALUES ('3', '建设银行');
INSERT INTO `st_bank` VALUES ('66', '徽商银行');
INSERT INTO `st_bank` VALUES ('22', '恒丰银行');
INSERT INTO `st_bank` VALUES ('16', '恒生银行');
INSERT INTO `st_bank` VALUES ('56', '成都银行');
INSERT INTO `st_bank` VALUES ('57', '抚顺银行');
INSERT INTO `st_bank` VALUES ('2', '招商银行');
INSERT INTO `st_bank` VALUES ('101', '攀枝花市商业银行');
INSERT INTO `st_bank` VALUES ('111', '无锡农村商业银行');
INSERT INTO `st_bank` VALUES ('71', '无锡市商业银行');
INSERT INTO `st_bank` VALUES ('79', '日照银行');
INSERT INTO `st_bank` VALUES ('15', '星展银行');
INSERT INTO `st_bank` VALUES ('75', '晋商银行');
INSERT INTO `st_bank` VALUES ('50', '杭州银行');
INSERT INTO `st_bank` VALUES ('12', '民生银行');
INSERT INTO `st_bank` VALUES ('18', '汇丰银行');
INSERT INTO `st_bank` VALUES ('42', '汉口银行');
INSERT INTO `st_bank` VALUES ('109', '江西省农村信用社');
INSERT INTO `st_bank` VALUES ('96', '沧州银行');
INSERT INTO `st_bank` VALUES ('49', '河北银行');
INSERT INTO `st_bank` VALUES ('87', '泉州银行');
INSERT INTO `st_bank` VALUES ('93', '泰隆商业银行');
INSERT INTO `st_bank` VALUES ('103', '泸州市商业银行');
INSERT INTO `st_bank` VALUES ('45', '洛阳银行');
INSERT INTO `st_bank` VALUES ('21', '浙商银行');
INSERT INTO `st_bank` VALUES ('23', '浦东发展银行');
INSERT INTO `st_bank` VALUES ('28', '淮坊银行');
INSERT INTO `st_bank` VALUES ('17', '渣打银行');
INSERT INTO `st_bank` VALUES ('31', '渤海银行');
INSERT INTO `st_bank` VALUES ('40', '温州银行');
INSERT INTO `st_bank` VALUES ('110', '湖南农村信用社');
INSERT INTO `st_bank` VALUES ('95', '湖州银行');
INSERT INTO `st_bank` VALUES ('27', '烟台银行');
INSERT INTO `st_bank` VALUES ('39', '焦作市商业银行');
INSERT INTO `st_bank` VALUES ('63', '珠海华润银行');
INSERT INTO `st_bank` VALUES ('84', '盐城银行');
INSERT INTO `st_bank` VALUES ('44', '盛京银行');
INSERT INTO `st_bank` VALUES ('35', '福建海峡银行');
INSERT INTO `st_bank` VALUES ('81', '秦皇岛银行');
INSERT INTO `st_bank` VALUES ('55', '绍兴银行');
INSERT INTO `st_bank` VALUES ('102', '绵阳市商业银行');
INSERT INTO `st_bank` VALUES ('20', '花旗银行');
INSERT INTO `st_bank` VALUES ('48', '苏州银行');
INSERT INTO `st_bank` VALUES ('88', '营口银行');
INSERT INTO `st_bank` VALUES ('60', '葫芦岛银行');
INSERT INTO `st_bank` VALUES ('70', '西安银行');
INSERT INTO `st_bank` VALUES ('69', '贵阳银行');
INSERT INTO `st_bank` VALUES ('86', '赣州银行');
INSERT INTO `st_bank` VALUES ('46', '辽阳银行');
INSERT INTO `st_bank` VALUES ('106', '邢台银行');
INSERT INTO `st_bank` VALUES ('5', '邮储银行');
INSERT INTO `st_bank` VALUES ('61', '郑州银行');
INSERT INTO `st_bank` VALUES ('67', '重庆银行');
INSERT INTO `st_bank` VALUES ('53', '金华银行');
INSERT INTO `st_bank` VALUES ('65', '锦州银行');
INSERT INTO `st_bank` VALUES ('85', '长沙银行');
INSERT INTO `st_bank` VALUES ('90', '阜新银行');
INSERT INTO `st_bank` VALUES ('76', '青岛银行');
INSERT INTO `st_bank` VALUES ('82', '青海银行');
INSERT INTO `st_bank` VALUES ('80', '鞍山银行');
INSERT INTO `st_bank` VALUES ('64', '齐商银行');
INSERT INTO `st_bank` VALUES ('26', '齐鲁银行');
INSERT INTO `st_bank` VALUES ('43', '龙江银行');

-- ----------------------------
-- Table structure for st_bank_info
-- ----------------------------
DROP TABLE IF EXISTS `st_bank_info`;
CREATE TABLE `st_bank_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `utype` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1用户2代理',
  `username` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(5) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `bank_name` varchar(20) NOT NULL DEFAULT '',
  `branch_name` varchar(50) NOT NULL DEFAULT '',
  `bank_card` varchar(20) NOT NULL DEFAULT '',
  `add_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '1正常2删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='银行信息表';

-- ----------------------------
-- Records of st_bank_info
-- ----------------------------
INSERT INTO `st_bank_info` VALUES ('1', '1', '1', '131', '张三丰', '13138602014', '123', '123', '123', '2019-07-09 13:21:17', '2019-07-18 12:49:26', '1');
INSERT INTO `st_bank_info` VALUES ('2', '6', '2', '123456', '网二', '13138602015', '招商银行', '1313', '4102512365112356', '2019-07-09 21:32:47', '2019-07-18 12:49:30', '1');
INSERT INTO `st_bank_info` VALUES ('3', '2', '1', '34234', '123', '34234', '建设银行', '1', '6217002362215120123', '2019-07-20 09:49:08', null, '1');
INSERT INTO `st_bank_info` VALUES ('4', '2', '1', '34234', '123', '34234', '交通银行', '13', '6217002362215120123', '2019-07-20 09:49:20', null, '1');

-- ----------------------------
-- Table structure for st_config
-- ----------------------------
DROP TABLE IF EXISTS `st_config`;
CREATE TABLE `st_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='系统设置表';

-- ----------------------------
-- Records of st_config
-- ----------------------------
INSERT INTO `st_config` VALUES ('1', '网站名称', 'title', '内部学习系统1', '2019-07-19 17:16:37');
INSERT INTO `st_config` VALUES ('2', '网站地址', 'address', 'www.baidu.com', '2019-07-19 17:16:37');
INSERT INTO `st_config` VALUES ('3', '默认注册代理账号', 'point_agent', '123456', '2019-07-19 17:16:37');
INSERT INTO `st_config` VALUES ('4', '邀请赠送申购币比例%', 'coin_give', '5', null);

-- ----------------------------
-- Table structure for st_kefu
-- ----------------------------
DROP TABLE IF EXISTS `st_kefu`;
CREATE TABLE `st_kefu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1正常2删除',
  `sort` smallint(5) NOT NULL DEFAULT '1' COMMENT '默认1，越大越靠前',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of st_kefu
-- ----------------------------
INSERT INTO `st_kefu` VALUES ('1', '电话客服', '123365555', '', '2019-07-05 21:57:01', '1', '2');
INSERT INTO `st_kefu` VALUES ('2', 'qq客服', '123123', '', '2019-07-19 22:02:37', '1', '1');
INSERT INTO `st_kefu` VALUES ('3', '微信客服', '123', '/uploads/kefu/20190719\\dd520c352e58bceadea5f17cd62cb0d6.png', '2019-07-19 22:02:49', '1', '1');
INSERT INTO `st_kefu` VALUES ('4', '手机版下载', '123', '/uploads/kefu/20190719\\bc870cb979c0cb2f0e91a75fdcd437f4.png', '2019-07-19 22:03:04', '1', '1');

-- ----------------------------
-- Table structure for st_news
-- ----------------------------
DROP TABLE IF EXISTS `st_news`;
CREATE TABLE `st_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `des` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `sort` smallint(5) DEFAULT '1',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1新闻资讯2关于我们3帮助中心4下载中心',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `add_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='新闻表';

-- ----------------------------
-- Records of st_news
-- ----------------------------
INSERT INTO `st_news` VALUES ('1', '<i>serwer</i>', '234234', '<i>serwer</i>', '123', '1', '1', '2019-07-05 21:55:05');
INSERT INTO `st_news` VALUES ('2', '<p><b>我是简介</b></p><p><b><img src=\"http://local.test.com/static/admin/lib/layui/images/face/1', '公司简介', '<p><b>我是简介</b></p><p><b><img src=\"http://local.test.com/static/admin/lib/layui/images/face/1.gif\" alt=\"[嘻嘻]\"><br></b></p>', '10', '2', '1', '2019-07-19 22:14:47');
INSERT INTO `st_news` VALUES ('3', '123', '联系我们', '123', '9', '2', '1', '2019-07-19 22:15:09');
INSERT INTO `st_news` VALUES ('4', '<p><img src=\"/uploads/notice/20190719/1ba69a98bd63d832e45bd70096458d27.png\" alt=\"undefined\"></p><p>', '注册指南', '<p><img src=\"/uploads/notice/20190719/1ba69a98bd63d832e45bd70096458d27.png\" alt=\"undefined\"></p><p>我是注册指南</p>', '10', '3', '1', '2019-07-19 22:15:32');
INSERT INTO `st_news` VALUES ('5', '我是交易指南', '交易指南', '我是交易指南', '9', '3', '1', '2019-07-19 22:15:49');
INSERT INTO `st_news` VALUES ('6', '123123', 'APP下载', '123123', '10', '4', '1', '2019-07-19 22:16:01');

-- ----------------------------
-- Table structure for st_notice
-- ----------------------------
DROP TABLE IF EXISTS `st_notice`;
CREATE TABLE `st_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1用户2代理',
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `sort` smallint(5) DEFAULT '1' COMMENT '排序越大越靠前，最大99999',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1正常2禁用3删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='公告表';

-- ----------------------------
-- Records of st_notice
-- ----------------------------
INSERT INTO `st_notice` VALUES ('1', '1', '435345', '345345', '2019-07-05 21:56:08', null, '123', '1');
INSERT INTO `st_notice` VALUES ('2', '1', '123', '123123', '2019-07-19 21:33:01', null, '1', '1');

-- ----------------------------
-- Table structure for st_operation_log
-- ----------------------------
DROP TABLE IF EXISTS `st_operation_log`;
CREATE TABLE `st_operation_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL COMMENT '1用户操作2代理操作3管理员操作',
  `uid` int(11) NOT NULL COMMENT '操作人id',
  `username` varchar(50) NOT NULL COMMENT '操作人用户名',
  `operation_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '被操作人类型 1会员2代理3管理员4平台信息',
  `aid` int(11) NOT NULL DEFAULT '0' COMMENT '被操作ID',
  `before` varchar(255) NOT NULL DEFAULT '' COMMENT '操作前数据',
  `note` varchar(255) NOT NULL COMMENT '详细说明',
  `url` varchar(255) NOT NULL COMMENT '请求地址',
  `param` text NOT NULL COMMENT '请求参数',
  `add_ip` varchar(50) NOT NULL,
  `add_time` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=262 DEFAULT CHARSET=utf8 COMMENT='操作表';

-- ----------------------------
-- Records of st_operation_log
-- ----------------------------
INSERT INTO `st_operation_log` VALUES ('1', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/login/login', 'a:3:{s:18:\"/admin/login/login\";s:0:\"\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:6:\"123456\";}', '127.0.0.1', '2019-07-05 20:24:33');
INSERT INTO `st_operation_log` VALUES ('2', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/login/login', 'a:3:{s:18:\"/admin/login/login\";s:0:\"\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:6:\"123456\";}', '127.0.0.1', '2019-07-05 21:07:03');
INSERT INTO `st_operation_log` VALUES ('3', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/login/login', 'a:3:{s:18:\"/admin/login/login\";s:0:\"\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:6:\"123456\";}', '127.0.0.1', '2019-07-05 21:09:37');
INSERT INTO `st_operation_log` VALUES ('4', '3', '1', 'admin1', '4', '0', '', '添加新闻', '/admin/admin/news_add', 'a:5:{s:21:\"/admin/admin/news_add\";s:0:\"\";s:5:\"title\";s:6:\"234234\";s:7:\"content\";s:13:\"<i>serwer</i>\";s:4:\"file\";s:0:\"\";s:4:\"sort\";s:3:\"123\";}', '127.0.0.1', '2019-07-05 21:55:05');
INSERT INTO `st_operation_log` VALUES ('5', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/api/status_change', 'a:4:{s:24:\"/admin/api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:2:\"db\";s:4:\"news\";}', '127.0.0.1', '2019-07-05 21:55:09');
INSERT INTO `st_operation_log` VALUES ('6', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/api/status_change', 'a:4:{s:24:\"/admin/api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:4:\"news\";}', '127.0.0.1', '2019-07-05 21:55:11');
INSERT INTO `st_operation_log` VALUES ('7', '3', '1', 'admin1', '4', '0', '', '添加公告', '/admin/admin/notice_add', 'a:5:{s:23:\"/admin/admin/notice_add\";s:0:\"\";s:5:\"title\";s:6:\"435345\";s:7:\"content\";s:6:\"345345\";s:4:\"type\";s:1:\"1\";s:4:\"sort\";s:3:\"123\";}', '127.0.0.1', '2019-07-05 21:56:08');
INSERT INTO `st_operation_log` VALUES ('8', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/api/status_change', 'a:4:{s:24:\"/admin/api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:2:\"db\";s:6:\"notice\";}', '127.0.0.1', '2019-07-05 21:56:11');
INSERT INTO `st_operation_log` VALUES ('9', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/api/status_change', 'a:4:{s:24:\"/admin/api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:6:\"notice\";}', '127.0.0.1', '2019-07-05 21:56:12');
INSERT INTO `st_operation_log` VALUES ('10', '3', '1', 'admin1', '4', '0', '', '添加客服', '/admin/admin/kefu_add', 'a:6:{s:21:\"/admin/admin/kefu_add\";s:0:\"\";s:4:\"name\";s:12:\"电话客服\";s:5:\"value\";s:9:\"123365555\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:0:\"\";s:4:\"sort\";s:1:\"2\";}', '127.0.0.1', '2019-07-05 21:57:01');
INSERT INTO `st_operation_log` VALUES ('11', '3', '1', 'admin1', '2', '2', '', '添加代理', '/admin/user/agent_add', 'a:5:{s:21:\"/admin/user/agent_add\";s:0:\"\";s:10:\"agent_name\";s:6:\"ertert\";s:8:\"password\";s:6:\"123456\";s:8:\"nickname\";s:6:\"werwer\";s:10:\"p_agent_id\";s:0:\"\";}', '127.0.0.1', '2019-07-06 12:44:33');
INSERT INTO `st_operation_log` VALUES ('12', '3', '1', 'admin1', '2', '2', '', '修改登录状态', '/admin/user/agent_status_change', 'a:3:{s:31:\"/admin/user/agent_status_change\";s:0:\"\";s:8:\"agent_id\";s:1:\"2\";s:6:\"status\";s:1:\"2\";}', '127.0.0.1', '2019-07-06 12:47:46');
INSERT INTO `st_operation_log` VALUES ('13', '3', '1', 'admin1', '2', '2', '', '修改登录状态', '/admin/user/agent_status_change', 'a:3:{s:31:\"/admin/user/agent_status_change\";s:0:\"\";s:8:\"agent_id\";s:1:\"2\";s:6:\"status\";s:1:\"1\";}', '127.0.0.1', '2019-07-06 12:47:48');
INSERT INTO `st_operation_log` VALUES ('14', '3', '1', 'admin1', '2', '2', '', '上分', '/admin/api/new_agent_money_change', 'a:4:{s:33:\"/admin/api/new_agent_money_change\";s:0:\"\";s:8:\"agent_id\";s:1:\"2\";s:5:\"money\";s:1:\"1\";s:5:\"param\";s:2:\"up\";}', '127.0.0.1', '2019-07-06 13:03:28');
INSERT INTO `st_operation_log` VALUES ('16', '3', '1', 'admin1', '2', '2', '', '上分', '/admin/api/new_agent_money_change', 'a:4:{s:33:\"/admin/api/new_agent_money_change\";s:0:\"\";s:8:\"agent_id\";s:1:\"2\";s:5:\"money\";s:1:\"1\";s:5:\"param\";s:2:\"up\";}', '127.0.0.1', '2019-07-06 13:05:57');
INSERT INTO `st_operation_log` VALUES ('17', '3', '1', 'admin1', '2', '2', '', '下分', '/admin/api/new_agent_money_change', 'a:4:{s:33:\"/admin/api/new_agent_money_change\";s:0:\"\";s:8:\"agent_id\";s:1:\"2\";s:5:\"money\";s:1:\"1\";s:5:\"param\";s:4:\"down\";}', '127.0.0.1', '2019-07-06 13:06:00');
INSERT INTO `st_operation_log` VALUES ('18', '3', '1', 'admin1', '2', '3', '', '添加代理', '/admin/user/agent_add', 'a:5:{s:21:\"/admin/user/agent_add\";s:0:\"\";s:10:\"agent_name\";s:10:\"rtrtrtrtyr\";s:8:\"password\";s:7:\"4545454\";s:8:\"nickname\";s:3:\"123\";s:10:\"p_agent_id\";s:0:\"\";}', '127.0.0.1', '2019-07-06 13:13:18');
INSERT INTO `st_operation_log` VALUES ('19', '3', '1', 'admin1', '2', '4', '', '添加代理', '/admin/user/agent_add', 'a:5:{s:21:\"/admin/user/agent_add\";s:0:\"\";s:10:\"agent_name\";s:9:\"fgfgfgfgf\";s:8:\"password\";s:8:\"sdsdfrtr\";s:8:\"nickname\";s:6:\"ertert\";s:10:\"p_agent_id\";s:6:\"ertert\";}', '127.0.0.1', '2019-07-06 13:13:28');
INSERT INTO `st_operation_log` VALUES ('20', '3', '1', 'admin1', '2', '2', '{\"agent_id\":2,\"agent_name\":\"ertert\",\"nickname\":\"werwer\",\"p_agent_id\":0,\"password\":\"e10adc3949ba59abbe56e057f20f883e\",\"pwd\":\"123456\",\"money\":\"1\",\"code\":null,\"invite_number\":\"370523\",\"login_status\":1,\"invite_status\":1,\"status\":1,\"last_login_time\":null,\"last', '编辑代理,修改昵称', '/admin/user/agent_edit', 'a:7:{s:22:\"/admin/user/agent_edit\";s:0:\"\";s:8:\"agent_id\";s:1:\"2\";s:8:\"password\";s:6:\"123456\";s:8:\"nickname\";s:8:\"werwer11\";s:10:\"p_agent_id\";s:0:\"\";s:13:\"invite_status\";s:1:\"1\";s:12:\"login_status\";s:1:\"1\";}', '127.0.0.1', '2019-07-06 13:17:14');
INSERT INTO `st_operation_log` VALUES ('21', '3', '1', 'admin1', '2', '0', '', '删除代理', '/admin/user/agent_del', 'a:2:{s:21:\"/admin/user/agent_del\";s:0:\"\";s:8:\"agent_id\";s:1:\"3\";}', '127.0.0.1', '2019-07-06 13:18:57');
INSERT INTO `st_operation_log` VALUES ('22', '3', '1', 'admin1', '2', '2', '', '下分', '/admin/api/new_agent_money_change', 'a:4:{s:33:\"/admin/api/new_agent_money_change\";s:0:\"\";s:8:\"agent_id\";s:1:\"2\";s:5:\"money\";s:1:\"1\";s:5:\"param\";s:4:\"down\";}', '127.0.0.1', '2019-07-06 13:19:07');
INSERT INTO `st_operation_log` VALUES ('23', '3', '1', 'admin1', '2', '0', '', '删除代理', '/admin/user/agent_del', 'a:2:{s:21:\"/admin/user/agent_del\";s:0:\"\";s:8:\"agent_id\";s:1:\"4\";}', '127.0.0.1', '2019-07-06 13:19:11');
INSERT INTO `st_operation_log` VALUES ('24', '3', '1', 'admin1', '2', '5', '', '添加代理', '/admin/user/agent_add', 'a:5:{s:21:\"/admin/user/agent_add\";s:0:\"\";s:10:\"agent_name\";s:8:\"dfgdghgh\";s:8:\"password\";s:10:\"rtrtrtyhty\";s:8:\"nickname\";s:5:\"rerer\";s:10:\"p_agent_id\";s:6:\"ertert\";}', '127.0.0.1', '2019-07-06 13:19:28');
INSERT INTO `st_operation_log` VALUES ('25', '3', '1', 'admin1', '2', '5', '{\"agent_id\":5,\"agent_name\":\"dfgdghgh\",\"nickname\":\"rerer\",\"p_agent_id\":2,\"password\":\"3af2be585b9264b63e037962063a712f\",\"pwd\":\"rtrtrtyhty\",\"money\":\"0\",\"code\":null,\"invite_number\":\"167504\",\"login_status\":1,\"invite_status\":1,\"status\":1,\"last_login_time\":null,', '编辑代理,修改登录状态', '/admin/user/agent_edit', 'a:7:{s:22:\"/admin/user/agent_edit\";s:0:\"\";s:8:\"agent_id\";s:1:\"5\";s:8:\"password\";s:10:\"rtrtrtyhty\";s:8:\"nickname\";s:5:\"rerer\";s:10:\"p_agent_id\";s:6:\"ertert\";s:13:\"invite_status\";s:1:\"2\";s:12:\"login_status\";s:1:\"2\";}', '127.0.0.1', '2019-07-06 13:19:47');
INSERT INTO `st_operation_log` VALUES ('26', '3', '1', 'admin1', '2', '5', '{\"agent_id\":5,\"agent_name\":\"dfgdghgh\",\"nickname\":\"rerer\",\"p_agent_id\":2,\"password\":\"3af2be585b9264b63e037962063a712f\",\"pwd\":\"rtrtrtyhty\",\"money\":\"0\",\"code\":null,\"invite_number\":\"167504\",\"login_status\":2,\"invite_status\":2,\"status\":1,\"last_login_time\":null,', '编辑代理,修改登录状态', '/admin/user/agent_edit', 'a:7:{s:22:\"/admin/user/agent_edit\";s:0:\"\";s:8:\"agent_id\";s:1:\"5\";s:8:\"password\";s:10:\"rtrtrtyhty\";s:8:\"nickname\";s:5:\"rerer\";s:10:\"p_agent_id\";s:6:\"ertert\";s:13:\"invite_status\";s:1:\"1\";s:12:\"login_status\";s:1:\"1\";}', '127.0.0.1', '2019-07-06 13:19:54');
INSERT INTO `st_operation_log` VALUES ('27', '3', '1', 'admin1', '1', '1', '', '添加会员', '/admin/user/user_add', 'a:7:{s:20:\"/admin/user/user_add\";s:0:\"\";s:8:\"username\";s:11:\"13138602014\";s:8:\"password\";s:6:\"123456\";s:8:\"nickname\";s:6:\"asdasd\";s:8:\"agent_id\";s:8:\"dfgdghgh\";s:3:\"pid\";s:0:\"\";s:5:\"lever\";s:1:\"1\";}', '127.0.0.1', '2019-07-06 23:23:50');
INSERT INTO `st_operation_log` VALUES ('28', '3', '1', 'admin1', '1', '1', '', '修改交易状态', '/admin/user/user_trade_status', 'a:3:{s:29:\"/admin/user/user_trade_status\";s:0:\"\";s:3:\"uid\";s:1:\"1\";s:6:\"status\";s:1:\"2\";}', '127.0.0.1', '2019-07-06 23:25:58');
INSERT INTO `st_operation_log` VALUES ('29', '3', '1', 'admin1', '1', '1', '', '修改交易状态', '/admin/user/user_trade_status', 'a:3:{s:29:\"/admin/user/user_trade_status\";s:0:\"\";s:3:\"uid\";s:1:\"1\";s:6:\"status\";s:1:\"1\";}', '127.0.0.1', '2019-07-06 23:26:00');
INSERT INTO `st_operation_log` VALUES ('30', '3', '1', 'admin1', '1', '1', '', '修改登录状态', '/admin/user/user_status_change', 'a:3:{s:30:\"/admin/user/user_status_change\";s:0:\"\";s:3:\"uid\";s:1:\"1\";s:6:\"status\";s:1:\"2\";}', '127.0.0.1', '2019-07-06 23:26:01');
INSERT INTO `st_operation_log` VALUES ('31', '3', '1', 'admin1', '1', '1', '', '修改登录状态', '/admin/user/user_status_change', 'a:3:{s:30:\"/admin/user/user_status_change\";s:0:\"\";s:3:\"uid\";s:1:\"1\";s:6:\"status\";s:1:\"1\";}', '127.0.0.1', '2019-07-06 23:26:02');
INSERT INTO `st_operation_log` VALUES ('32', '3', '1', 'admin1', '1', '2', '', '添加会员', '/admin/user/user_add', 'a:7:{s:20:\"/admin/user/user_add\";s:0:\"\";s:8:\"username\";s:11:\"18237837598\";s:8:\"password\";s:6:\"123456\";s:8:\"nickname\";s:5:\"34234\";s:8:\"agent_id\";s:8:\"dfgdghgh\";s:3:\"pid\";s:11:\"13138602014\";s:5:\"lever\";s:3:\"100\";}', '127.0.0.1', '2019-07-06 23:27:41');
INSERT INTO `st_operation_log` VALUES ('33', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/login/login', 'a:3:{s:18:\"/admin/login/login\";s:0:\"\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:6:\"123456\";}', '127.0.0.1', '2019-07-07 10:13:07');
INSERT INTO `st_operation_log` VALUES ('34', '3', '1', 'admin1', '2', '5', '{\"agent_id\":5,\"agent_name\":\"dfgdghgh\",\"nickname\":\"rerer\",\"p_agent_id\":2,\"password\":\"3af2be585b9264b63e037962063a712f\",\"pwd\":\"rtrtrtyhty\",\"money\":\"0\",\"code\":null,\"invite_number\":\"167504\",\"login_status\":1,\"invite_status\":1,\"status\":1,\"last_login_time\":null,', '编辑代理,修改姓名', '/admin/user/agent_edit', 'a:7:{s:22:\"/admin/user/agent_edit\";s:0:\"\";s:8:\"agent_id\";s:1:\"5\";s:8:\"password\";s:10:\"rtrtrtyhty\";s:8:\"nickname\";s:6:\"rerer1\";s:10:\"p_agent_id\";s:6:\"ertert\";s:13:\"invite_status\";s:1:\"1\";s:12:\"login_status\";s:1:\"1\";}', '127.0.0.1', '2019-07-07 10:18:10');
INSERT INTO `st_operation_log` VALUES ('35', '3', '1', 'admin1', '1', '2', '{\"uid\":2,\"username\":\"18237837598\",\"nickname\":\"34234\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\",\"pwd\":\"123456\",\"pid\":1,\"agent_id\":5,\"agent_name\":\"dfgdghgh\",\"agent_nickname\":\"rerer\",\"code\":null,\"login_status\":1,\"invite_status\":1,\"trade_status\":1,\"lever\"', '编辑会员', '/admin/user/user_edit', 'a:12:{s:21:\"/admin/user/user_edit\";s:0:\"\";s:3:\"uid\";s:1:\"2\";s:8:\"username\";s:11:\"18237837598\";s:8:\"password\";s:6:\"123456\";s:8:\"nickname\";s:5:\"34234\";s:5:\"money\";s:4:\"0.00\";s:6:\"xm_fee\";s:4:\"0.00\";s:12:\"login_status\";s:1:\"1\";s:12:\"trade_status\";s:1:\"1\";s:13:\"invite_status\";s:1:\"1\";s:8:\"agent_id\";s:8:\"dfgdghgh\";s:3:\"pid\";s:11:\"13138602014\";}', '127.0.0.1', '2019-07-07 10:24:13');
INSERT INTO `st_operation_log` VALUES ('36', '3', '1', 'admin1', '1', '2', '{\"uid\":2,\"username\":\"18237837598\",\"nickname\":\"34234\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\",\"pwd\":\"123456\",\"pid\":1,\"agent_id\":5,\"agent_name\":\"dfgdghgh\",\"agent_nickname\":\"rerer1\",\"code\":null,\"login_status\":1,\"invite_status\":1,\"trade_status\":1,\"lever', '编辑会员,修改登录状态', '/admin/user/user_edit', 'a:12:{s:21:\"/admin/user/user_edit\";s:0:\"\";s:3:\"uid\";s:1:\"2\";s:8:\"username\";s:11:\"18237837598\";s:8:\"password\";s:6:\"123456\";s:8:\"nickname\";s:5:\"34234\";s:5:\"money\";s:4:\"0.00\";s:6:\"xm_fee\";s:4:\"0.00\";s:12:\"login_status\";s:1:\"2\";s:12:\"trade_status\";s:1:\"2\";s:13:\"invite_status\";s:1:\"2\";s:8:\"agent_id\";s:8:\"dfgdghgh\";s:3:\"pid\";s:11:\"13138602014\";}', '127.0.0.1', '2019-07-07 10:24:20');
INSERT INTO `st_operation_log` VALUES ('40', '3', '1', 'admin1', '1', '2', '', '上分', '/admin/api/new_user_money_change', 'a:4:{s:32:\"/admin/api/new_user_money_change\";s:0:\"\";s:3:\"uid\";s:1:\"2\";s:5:\"money\";s:1:\"1\";s:5:\"param\";s:2:\"up\";}', '127.0.0.1', '2019-07-07 10:41:45');
INSERT INTO `st_operation_log` VALUES ('41', '3', '1', 'admin1', '1', '2', '', '下分', '/admin/api/new_user_money_change', 'a:4:{s:32:\"/admin/api/new_user_money_change\";s:0:\"\";s:3:\"uid\";s:1:\"2\";s:5:\"money\";s:1:\"1\";s:5:\"param\";s:4:\"down\";}', '127.0.0.1', '2019-07-07 10:41:49');
INSERT INTO `st_operation_log` VALUES ('42', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/api/status_change', 'a:4:{s:24:\"/admin/api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:2:\"db\";s:4:\"news\";}', '127.0.0.1', '2019-07-07 11:09:15');
INSERT INTO `st_operation_log` VALUES ('43', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/api/status_change', 'a:4:{s:24:\"/admin/api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:4:\"news\";}', '127.0.0.1', '2019-07-07 11:09:23');
INSERT INTO `st_operation_log` VALUES ('44', '3', '1', 'admin1', '4', '0', '', '添加產品', '/admin/admin/product_add', 'a:6:{s:24:\"/admin/admin/product_add\";s:0:\"\";s:4:\"name\";s:1:\"1\";s:12:\"abbreviation\";s:1:\"1\";s:8:\"contract\";s:1:\"1\";s:8:\"min_hand\";s:1:\"1\";s:8:\"max_hand\";s:1:\"1\";}', '127.0.0.1', '2019-07-07 11:36:54');
INSERT INTO `st_operation_log` VALUES ('45', '3', '1', 'admin1', '4', '0', '', '添加產品', '/admin/admin/product_add', 'a:6:{s:24:\"/admin/admin/product_add\";s:0:\"\";s:4:\"name\";s:1:\"2\";s:12:\"abbreviation\";s:1:\"1\";s:8:\"contract\";s:1:\"2\";s:8:\"min_hand\";s:2:\"12\";s:8:\"max_hand\";s:2:\"12\";}', '127.0.0.1', '2019-07-07 11:37:18');
INSERT INTO `st_operation_log` VALUES ('46', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/api/status_change', 'a:4:{s:24:\"/admin/api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"2\";s:6:\"status\";s:1:\"2\";s:2:\"db\";s:7:\"product\";}', '127.0.0.1', '2019-07-07 11:39:00');
INSERT INTO `st_operation_log` VALUES ('47', '3', '1', 'admin1', '4', '0', '', '修改产品', '/admin/admin/product_edit', 'a:7:{s:25:\"/admin/admin/product_edit\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:4:\"name\";s:1:\"1\";s:12:\"abbreviation\";s:1:\"1\";s:8:\"contract\";s:8:\"1.000000\";s:8:\"min_hand\";s:1:\"1\";s:8:\"max_hand\";s:1:\"1\";}', '127.0.0.1', '2019-07-07 11:43:06');
INSERT INTO `st_operation_log` VALUES ('48', '3', '1', 'admin1', '4', '0', '', '添加申购币', '/admin/admin/coin_add', 'a:9:{s:21:\"/admin/admin/coin_add\";s:0:\"\";s:4:\"name\";s:2:\"23\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:58:\"/uploads/adv/20190708\\17631d6451e3b5c1da951c1302cce9b1.png\";s:12:\"abbreviation\";s:3:\"123\";s:8:\"describe\";s:3:\"234\";s:5:\"price\";s:3:\"234\";s:8:\"min_hand\";s:3:\"234\";s:8:\"max_hand\";s:1:\"1\";}', '127.0.0.1', '2019-07-08 11:49:36');
INSERT INTO `st_operation_log` VALUES ('49', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/api/status_change', 'a:5:{s:24:\"/admin/api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:10:\"apply_coin\";s:5:\"field\";s:11:\"show_status\";}', '127.0.0.1', '2019-07-08 11:50:22');
INSERT INTO `st_operation_log` VALUES ('50', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/api/status_change', 'a:5:{s:24:\"/admin/api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:2:\"db\";s:10:\"apply_coin\";s:5:\"field\";s:11:\"show_status\";}', '127.0.0.1', '2019-07-08 11:50:24');
INSERT INTO `st_operation_log` VALUES ('51', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/api/status_change', 'a:5:{s:24:\"/admin/api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:10:\"apply_coin\";s:5:\"field\";s:11:\"show_status\";}', '127.0.0.1', '2019-07-08 12:34:15');
INSERT INTO `st_operation_log` VALUES ('52', '3', '1', 'admin1', '4', '0', '', '修改申购币', '/admin/admin/coin_edit', 'a:10:{s:22:\"/admin/admin/coin_edit\";s:0:\"\";s:4:\"name\";s:4:\"2311\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:58:\"/uploads/adv/20190708\\17631d6451e3b5c1da951c1302cce9b1.png\";s:12:\"abbreviation\";s:3:\"123\";s:8:\"describe\";s:3:\"234\";s:5:\"price\";s:10:\"234.000000\";s:8:\"min_hand\";s:10:\"234.000000\";s:8:\"max_hand\";s:8:\"1.000000\";s:2:\"id\";s:1:\"1\";}', '127.0.0.1', '2019-07-08 12:38:31');
INSERT INTO `st_operation_log` VALUES ('53', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/api/status_change', 'a:4:{s:24:\"/admin/api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:2:\"db\";s:10:\"apply_coin\";}', '127.0.0.1', '2019-07-08 12:38:41');
INSERT INTO `st_operation_log` VALUES ('54', '3', '1', 'admin1', '3', '1', '{\"username\":\"admin1\",\"nickname\":\"admin\"}', '修改个人信息', '/admin/index/personal', 'a:4:{s:21:\"/admin/index/personal\";s:0:\"\";s:8:\"nickname\";s:5:\"admin\";s:4:\"pass\";s:6:\"123123\";s:6:\"repass\";s:6:\"123123\";}', '127.0.0.1', '2019-07-08 12:54:08');
INSERT INTO `st_operation_log` VALUES ('55', '3', '1', 'admin', '3', '0', '', '管理员退出登录', '/admin/login/logout', 'a:1:{s:19:\"/admin/login/logout\";s:0:\"\";}', '127.0.0.1', '2019-07-08 12:54:09');
INSERT INTO `st_operation_log` VALUES ('56', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/login/login', 'a:3:{s:18:\"/admin/login/login\";s:0:\"\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:6:\"123123\";}', '127.0.0.1', '2019-07-08 12:54:14');
INSERT INTO `st_operation_log` VALUES ('57', '3', '1', 'admin1', '4', '0', '', '添加申购币', '/admin/coin/coin_add', 'a:9:{s:20:\"/admin/coin/coin_add\";s:0:\"\";s:4:\"name\";s:2:\"45\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:58:\"/uploads/adv/20190708\\3b587709b8ed64e3e7fffeb809dee537.png\";s:12:\"abbreviation\";s:3:\"234\";s:8:\"describe\";s:2:\"dt\";s:5:\"price\";s:1:\"3\";s:8:\"min_hand\";s:1:\"3\";s:8:\"max_hand\";s:1:\"1\";}', '127.0.0.1', '2019-07-08 18:54:27');
INSERT INTO `st_operation_log` VALUES ('58', '3', '1', 'admin1', '2', '2', '', '审核提现', '/admin/api/agent_withdraw_handle', 'a:4:{s:32:\"/admin/api/agent_withdraw_handle\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '127.0.0.1', '2019-07-08 23:27:24');
INSERT INTO `st_operation_log` VALUES ('60', '3', '1', 'admin1', '2', '2', '', '拒绝提现', '/admin/api/agent_withdraw_handle', 'a:4:{s:32:\"/admin/api/agent_withdraw_handle\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"3\";s:6:\"remark\";s:1:\"1\";}', '127.0.0.1', '2019-07-08 23:28:11');
INSERT INTO `st_operation_log` VALUES ('61', '3', '1', 'admin1', '1', '1', '', '审核用户提现', '/admin/api/user_withdraw_handle', 'a:4:{s:31:\"/admin/api/user_withdraw_handle\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '127.0.0.1', '2019-07-09 00:00:26');
INSERT INTO `st_operation_log` VALUES ('63', '3', '1', 'admin1', '1', '1', '', '拒绝代理提现', '/admin/api/user_withdraw_handle', 'a:4:{s:31:\"/admin/api/user_withdraw_handle\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"3\";s:6:\"remark\";s:1:\"1\";}', '127.0.0.1', '2019-07-09 00:28:47');
INSERT INTO `st_operation_log` VALUES ('64', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/api/status_change', 'a:4:{s:24:\"/admin/api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:2:\"db\";s:9:\"bank_info\";}', '127.0.0.1', '2019-07-09 13:21:49');
INSERT INTO `st_operation_log` VALUES ('65', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/api/status_change', 'a:4:{s:24:\"/admin/api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:9:\"bank_info\";}', '127.0.0.1', '2019-07-09 13:21:57');
INSERT INTO `st_operation_log` VALUES ('66', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/api/status_change', 'a:4:{s:24:\"/admin/api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:2:\"db\";s:9:\"bank_info\";}', '127.0.0.1', '2019-07-09 13:23:05');
INSERT INTO `st_operation_log` VALUES ('67', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/api/status_change', 'a:4:{s:24:\"/admin/api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:9:\"bank_info\";}', '127.0.0.1', '2019-07-09 13:23:08');
INSERT INTO `st_operation_log` VALUES ('68', '3', '1', 'admin1', '1', '0', '', '修改用户银行卡', '/admin/user/bank_info', 'a:7:{s:21:\"/admin/user/bank_info\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:4:\"name\";s:3:\"123\";s:5:\"phone\";s:11:\"13138602014\";s:9:\"bank_name\";s:3:\"123\";s:11:\"branch_name\";s:3:\"123\";s:9:\"bank_card\";s:3:\"123\";}', '127.0.0.1', '2019-07-09 14:03:03');
INSERT INTO `st_operation_log` VALUES ('69', '3', '1', 'admin1', '4', '0', '', '修改产品', '/admin/admin/product_edit', 'a:8:{s:25:\"/admin/admin/product_edit\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:4:\"name\";s:1:\"1\";s:12:\"abbreviation\";s:1:\"1\";s:8:\"contract\";s:8:\"1.000000\";s:8:\"min_hand\";s:8:\"1.000000\";s:8:\"max_hand\";s:8:\"1.000000\";s:3:\"fee\";s:4:\"0.05\";}', '127.0.0.1', '2019-07-09 16:23:09');
INSERT INTO `st_operation_log` VALUES ('70', '3', '1', 'admin1', '2', '6', '', '添加代理', '/admin/user/agent_add', 'a:5:{s:21:\"/admin/user/agent_add\";s:0:\"\";s:10:\"agent_name\";s:6:\"123456\";s:8:\"password\";s:6:\"123456\";s:8:\"nickname\";s:6:\"123123\";s:10:\"p_agent_id\";s:0:\"\";}', '127.0.0.1', '2019-07-09 18:57:08');
INSERT INTO `st_operation_log` VALUES ('71', '2', '6', '123456', '2', '0', '', '登录', '/agent/login/login', 'a:4:{s:18:\"/agent/login/login\";s:0:\"\";s:10:\"agent_name\";s:6:\"123456\";s:8:\"password\";s:6:\"123456\";s:4:\"code\";s:4:\"5778\";}', '127.0.0.1', '2019-07-09 18:58:09');
INSERT INTO `st_operation_log` VALUES ('72', '3', '1', 'admin1', '2', '7', '', '添加代理', '/admin/user/agent_add', 'a:4:{s:21:\"/admin/user/agent_add\";s:0:\"\";s:10:\"agent_name\";s:9:\"123123444\";s:8:\"password\";s:6:\"123123\";s:8:\"nickname\";s:6:\"123123\";}', '127.0.0.1', '2019-07-09 19:23:39');
INSERT INTO `st_operation_log` VALUES ('73', '3', '1', 'admin1', '2', '8', '', '添加代理', '/admin/user/agent_add', 'a:4:{s:21:\"/admin/user/agent_add\";s:0:\"\";s:10:\"agent_name\";s:12:\"ertertertrgh\";s:8:\"password\";s:6:\"123123\";s:8:\"nickname\";s:6:\"123123\";}', '127.0.0.1', '2019-07-09 19:24:14');
INSERT INTO `st_operation_log` VALUES ('74', '2', '6', '123456', '2', '9', '', '添加代理', '/agent/user/agent_add', 'a:4:{s:21:\"/agent/user/agent_add\";s:0:\"\";s:10:\"agent_name\";s:8:\"werwert4\";s:8:\"password\";s:6:\"234234\";s:8:\"nickname\";s:6:\"234234\";}', '127.0.0.1', '2019-07-09 19:24:37');
INSERT INTO `st_operation_log` VALUES ('75', '3', '1', 'admin1', '1', '3', '', '添加会员', '/admin/user/user_add', 'a:7:{s:20:\"/admin/user/user_add\";s:0:\"\";s:8:\"username\";s:11:\"18237837599\";s:8:\"password\";s:6:\"123123\";s:8:\"nickname\";s:3:\"123\";s:8:\"agent_id\";s:6:\"123456\";s:3:\"pid\";s:0:\"\";s:5:\"lever\";s:3:\"100\";}', '127.0.0.1', '2019-07-09 20:08:52');
INSERT INTO `st_operation_log` VALUES ('76', '2', '6', '123456', '2', '6', '{\"nickname\":\"123123\"}', '修改个人信息', '/agent/agent/personal', 'a:4:{s:21:\"/agent/agent/personal\";s:0:\"\";s:8:\"nickname\";s:6:\"123123\";s:4:\"pass\";s:6:\"123123\";s:6:\"repass\";s:6:\"123123\";}', '127.0.0.1', '2019-07-09 20:41:05');
INSERT INTO `st_operation_log` VALUES ('77', '2', '6', '123456', '2', '0', '', '退出登录', '/agent/login/logout', 'a:1:{s:19:\"/agent/login/logout\";s:0:\"\";}', '127.0.0.1', '2019-07-09 20:41:06');
INSERT INTO `st_operation_log` VALUES ('78', '2', '6', '123456', '2', '0', '', '登录', '/agent/login/login', 'a:4:{s:18:\"/agent/login/login\";s:0:\"\";s:10:\"agent_name\";s:6:\"123456\";s:8:\"password\";s:6:\"123123\";s:4:\"code\";s:4:\"0426\";}', '127.0.0.1', '2019-07-09 20:41:13');
INSERT INTO `st_operation_log` VALUES ('79', '3', '1', 'admin1', '2', '6', '', '上分', '/admin/api/new_agent_money_change', 'a:4:{s:33:\"/admin/api/new_agent_money_change\";s:0:\"\";s:8:\"agent_id\";s:1:\"6\";s:5:\"money\";s:3:\"123\";s:5:\"param\";s:2:\"up\";}', '127.0.0.1', '2019-07-09 20:43:47');
INSERT INTO `st_operation_log` VALUES ('82', '2', '6', '123456', '2', '0', '', '代理提现', '/agent/withdraw/withdraw', 'a:3:{s:24:\"/agent/withdraw/withdraw\";s:0:\"\";s:5:\"money\";s:1:\"1\";s:12:\"bank_info_id\";s:1:\"2\";}', '127.0.0.1', '2019-07-09 22:17:25');
INSERT INTO `st_operation_log` VALUES ('83', '2', '6', '123456', '2', '0', '', '代理提现', '/agent/withdraw/withdraw', 'a:3:{s:24:\"/agent/withdraw/withdraw\";s:0:\"\";s:5:\"money\";s:1:\"2\";s:12:\"bank_info_id\";s:1:\"2\";}', '127.0.0.1', '2019-07-09 22:25:53');
INSERT INTO `st_operation_log` VALUES ('84', '3', '1', 'admin1', '2', '6', '', '审核代理提现', '/admin/api/agent_withdraw_handle', 'a:4:{s:32:\"/admin/api/agent_withdraw_handle\";s:0:\"\";s:2:\"id\";s:1:\"3\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '127.0.0.1', '2019-07-09 22:26:12');
INSERT INTO `st_operation_log` VALUES ('85', '3', '1', 'admin1', '2', '6', '', '拒绝代理提现', '/admin/api/agent_withdraw_handle', 'a:4:{s:32:\"/admin/api/agent_withdraw_handle\";s:0:\"\";s:2:\"id\";s:1:\"2\";s:6:\"status\";s:1:\"3\";s:6:\"remark\";s:3:\"123\";}', '127.0.0.1', '2019-07-09 22:26:15');
INSERT INTO `st_operation_log` VALUES ('86', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/login/login', 'a:3:{s:18:\"/admin/login/login\";s:0:\"\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:6:\"123123\";}', '127.0.0.1', '2019-07-10 16:03:54');
INSERT INTO `st_operation_log` VALUES ('87', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:18:\"/admin/Login/login\";s:0:\"\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:6:\"123123\";}', '127.0.0.1', '2019-07-15 11:22:00');
INSERT INTO `st_operation_log` VALUES ('88', '3', '1', 'admin1', '4', '0', '', '添加产品', '/admin/Admin/product_add', 'a:7:{s:24:\"/admin/Admin/product_add\";s:0:\"\";s:4:\"name\";s:3:\"BTC\";s:12:\"abbreviation\";s:3:\"BTC\";s:8:\"contract\";s:1:\"1\";s:8:\"min_hand\";s:3:\"0.1\";s:8:\"max_hand\";s:3:\"100\";s:3:\"fee\";s:1:\"5\";}', '127.0.0.1', '2019-07-15 11:29:08');
INSERT INTO `st_operation_log` VALUES ('89', '3', '1', 'admin1', '4', '0', '', '添加产品', '/admin/Admin/product_add', 'a:7:{s:24:\"/admin/Admin/product_add\";s:0:\"\";s:4:\"name\";s:3:\"ETH\";s:12:\"abbreviation\";s:3:\"ETH\";s:8:\"contract\";s:1:\"1\";s:8:\"min_hand\";s:2:\"10\";s:8:\"max_hand\";s:3:\"100\";s:3:\"fee\";s:1:\"5\";}', '127.0.0.1', '2019-07-15 11:29:32');
INSERT INTO `st_operation_log` VALUES ('90', '3', '1', 'admin1', '4', '0', '', '添加产品', '/admin/Admin/product_add', 'a:7:{s:24:\"/admin/Admin/product_add\";s:0:\"\";s:4:\"name\";s:3:\"EOS\";s:12:\"abbreviation\";s:3:\"EOS\";s:8:\"contract\";s:1:\"1\";s:8:\"min_hand\";s:1:\"1\";s:8:\"max_hand\";s:1:\"1\";s:3:\"fee\";s:1:\"1\";}', '127.0.0.1', '2019-07-15 11:29:43');
INSERT INTO `st_operation_log` VALUES ('91', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:18:\"/admin/Login/login\";s:0:\"\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:6:\"123123\";}', '127.0.0.1', '2019-07-17 12:52:12');
INSERT INTO `st_operation_log` VALUES ('92', '2', '6', '123456', '2', '0', '', '登录', '/agent/Login/login', 'a:4:{s:18:\"/agent/Login/login\";s:0:\"\";s:10:\"agent_name\";s:6:\"123456\";s:8:\"password\";s:6:\"123123\";s:4:\"code\";s:4:\"7558\";}', '127.0.0.1', '2019-07-17 17:29:36');
INSERT INTO `st_operation_log` VALUES ('93', '3', '1', 'admin1', '1', '0', '', '修改用户银行卡', '/admin/User/bank_info', 'a:7:{s:21:\"/admin/User/bank_info\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:4:\"name\";s:9:\"张三丰\";s:5:\"phone\";s:11:\"13138602014\";s:9:\"bank_name\";s:3:\"123\";s:11:\"branch_name\";s:3:\"123\";s:9:\"bank_card\";s:3:\"123\";}', '127.0.0.1', '2019-07-18 12:49:26');
INSERT INTO `st_operation_log` VALUES ('94', '3', '1', 'admin1', '2', '0', '', '修改代理银行卡', '/admin/User/bank_info', 'a:7:{s:21:\"/admin/User/bank_info\";s:0:\"\";s:2:\"id\";s:1:\"2\";s:4:\"name\";s:6:\"网二\";s:5:\"phone\";s:11:\"13138602015\";s:9:\"bank_name\";s:12:\"招商银行\";s:11:\"branch_name\";s:4:\"1313\";s:9:\"bank_card\";s:16:\"4102512365112356\";}', '127.0.0.1', '2019-07-18 12:49:30');
INSERT INTO `st_operation_log` VALUES ('95', '2', '6', '123456', '2', '0', '', '代理提现', '/agent/Withdraw/withdraw', 'a:3:{s:24:\"/agent/Withdraw/withdraw\";s:0:\"\";s:5:\"money\";s:2:\"23\";s:12:\"bank_info_id\";s:1:\"2\";}', '127.0.0.1', '2019-07-18 12:50:51');
INSERT INTO `st_operation_log` VALUES ('96', '3', '1', 'admin1', '2', '6', '', '拒绝代理提现', '/admin/Api/agent_withdraw_handle', 'a:4:{s:32:\"/admin/Api/agent_withdraw_handle\";s:0:\"\";s:2:\"id\";s:1:\"4\";s:6:\"status\";s:1:\"3\";s:6:\"remark\";s:9:\"123123123\";}', '127.0.0.1', '2019-07-18 12:51:01');
INSERT INTO `st_operation_log` VALUES ('97', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:18:\"/admin/Login/login\";s:0:\"\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:6:\"123123\";}', '127.0.0.1', '2019-07-19 14:15:20');
INSERT INTO `st_operation_log` VALUES ('98', '3', '1', 'admin1', '4', '0', '', '添加产品', '/admin/Admin/product_add', 'a:10:{s:24:\"/admin/Admin/product_add\";s:0:\"\";s:4:\"name\";s:3:\"123\";s:12:\"abbreviation\";s:3:\"123\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:62:\"/uploads/product/20190719\\ce512f917b80d74387cb2c582070266c.png\";s:8:\"contract\";s:3:\"123\";s:8:\"min_hand\";s:3:\"123\";s:8:\"max_hand\";s:3:\"123\";s:4:\"wave\";s:3:\"123\";s:3:\"fee\";s:3:\"123\";}', '127.0.0.1', '2019-07-19 14:18:38');
INSERT INTO `st_operation_log` VALUES ('99', '3', '1', 'admin1', '4', '0', '', '修改产品', '/admin/Admin/product_edit', 'a:11:{s:25:\"/admin/Admin/product_edit\";s:0:\"\";s:2:\"id\";s:1:\"5\";s:4:\"name\";s:3:\"EOS\";s:12:\"abbreviation\";s:3:\"EOS\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:62:\"/uploads/product/20190719\\a853b5703e5becb59afca0fe246f7e70.png\";s:8:\"contract\";s:8:\"1.000000\";s:8:\"min_hand\";s:8:\"1.000000\";s:8:\"max_hand\";s:8:\"1.000000\";s:4:\"wave\";s:3:\"123\";s:3:\"fee\";s:8:\"1.000000\";}', '127.0.0.1', '2019-07-19 14:18:45');
INSERT INTO `st_operation_log` VALUES ('100', '3', '1', 'admin1', '4', '0', '', '修改产品', '/admin/Admin/product_edit', 'a:11:{s:25:\"/admin/Admin/product_edit\";s:0:\"\";s:2:\"id\";s:1:\"4\";s:4:\"name\";s:3:\"ETH\";s:12:\"abbreviation\";s:3:\"ETH\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:62:\"/uploads/product/20190719\\d78f57cf01f19ebc8fedf2d18e968110.png\";s:8:\"contract\";s:8:\"1.000000\";s:8:\"min_hand\";s:9:\"10.000000\";s:8:\"max_hand\";s:10:\"100.000000\";s:4:\"wave\";s:3:\"123\";s:3:\"fee\";s:8:\"5.000000\";}', '127.0.0.1', '2019-07-19 14:18:52');
INSERT INTO `st_operation_log` VALUES ('101', '3', '1', 'admin1', '4', '0', '', '修改产品', '/admin/Admin/product_edit', 'a:11:{s:25:\"/admin/Admin/product_edit\";s:0:\"\";s:2:\"id\";s:1:\"3\";s:4:\"name\";s:3:\"BTC\";s:12:\"abbreviation\";s:3:\"BTC\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:62:\"/uploads/product/20190719\\ad194c7b4958445f898daef96bcfb9a7.png\";s:8:\"contract\";s:8:\"1.000000\";s:8:\"min_hand\";s:8:\"0.100000\";s:8:\"max_hand\";s:10:\"100.000000\";s:4:\"wave\";s:2:\"12\";s:3:\"fee\";s:8:\"5.000000\";}', '127.0.0.1', '2019-07-19 14:18:58');
INSERT INTO `st_operation_log` VALUES ('102', '3', '1', 'admin1', '4', '0', '', '修改产品', '/admin/Admin/product_edit', 'a:11:{s:25:\"/admin/Admin/product_edit\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:4:\"name\";s:1:\"1\";s:12:\"abbreviation\";s:1:\"1\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:62:\"/uploads/product/20190719\\c4994bca1340d8c7d171fbb2fba125e8.png\";s:8:\"contract\";s:8:\"1.000000\";s:8:\"min_hand\";s:8:\"1.000000\";s:8:\"max_hand\";s:8:\"1.000000\";s:4:\"wave\";s:3:\"1.2\";s:3:\"fee\";s:8:\"0.050000\";}', '127.0.0.1', '2019-07-19 14:19:04');
INSERT INTO `st_operation_log` VALUES ('103', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:5:{s:24:\"/admin/Api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"6\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:7:\"product\";s:5:\"field\";s:12:\"trade_status\";}', '127.0.0.1', '2019-07-19 14:24:59');
INSERT INTO `st_operation_log` VALUES ('104', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:5:{s:24:\"/admin/Api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"6\";s:6:\"status\";s:1:\"2\";s:2:\"db\";s:7:\"product\";s:5:\"field\";s:12:\"trade_status\";}', '127.0.0.1', '2019-07-19 14:25:00');
INSERT INTO `st_operation_log` VALUES ('105', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:5:{s:24:\"/admin/Api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"5\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:7:\"product\";s:5:\"field\";s:12:\"trade_status\";}', '127.0.0.1', '2019-07-19 14:25:03');
INSERT INTO `st_operation_log` VALUES ('106', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:5:{s:24:\"/admin/Api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"4\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:7:\"product\";s:5:\"field\";s:12:\"trade_status\";}', '127.0.0.1', '2019-07-19 14:25:05');
INSERT INTO `st_operation_log` VALUES ('107', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:5:{s:24:\"/admin/Api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"3\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:7:\"product\";s:5:\"field\";s:12:\"trade_status\";}', '127.0.0.1', '2019-07-19 14:25:06');
INSERT INTO `st_operation_log` VALUES ('108', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:5:{s:24:\"/admin/Api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"6\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:7:\"product\";s:5:\"field\";s:12:\"trade_status\";}', '127.0.0.1', '2019-07-19 14:25:41');
INSERT INTO `st_operation_log` VALUES ('109', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:5:{s:24:\"/admin/Api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"6\";s:6:\"status\";s:1:\"2\";s:2:\"db\";s:7:\"product\";s:5:\"field\";s:12:\"trade_status\";}', '127.0.0.1', '2019-07-19 14:25:42');
INSERT INTO `st_operation_log` VALUES ('110', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:5:{s:24:\"/admin/Api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"6\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:7:\"product\";s:5:\"field\";s:12:\"trade_status\";}', '127.0.0.1', '2019-07-19 14:28:25');
INSERT INTO `st_operation_log` VALUES ('111', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:5:{s:24:\"/admin/Api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"6\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:7:\"product\";s:5:\"field\";s:11:\"show_status\";}', '127.0.0.1', '2019-07-19 14:28:30');
INSERT INTO `st_operation_log` VALUES ('112', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:5:{s:24:\"/admin/Api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"5\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:7:\"product\";s:5:\"field\";s:11:\"show_status\";}', '127.0.0.1', '2019-07-19 14:33:59');
INSERT INTO `st_operation_log` VALUES ('113', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:5:{s:24:\"/admin/Api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"5\";s:6:\"status\";s:1:\"2\";s:2:\"db\";s:7:\"product\";s:5:\"field\";s:11:\"show_status\";}', '127.0.0.1', '2019-07-19 14:34:01');
INSERT INTO `st_operation_log` VALUES ('114', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:5:{s:24:\"/admin/Api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"6\";s:6:\"status\";s:1:\"2\";s:2:\"db\";s:7:\"product\";s:5:\"field\";s:12:\"trade_status\";}', '127.0.0.1', '2019-07-19 14:34:03');
INSERT INTO `st_operation_log` VALUES ('115', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:5:{s:24:\"/admin/Api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"5\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:7:\"product\";s:5:\"field\";s:11:\"show_status\";}', '127.0.0.1', '2019-07-19 14:34:20');
INSERT INTO `st_operation_log` VALUES ('116', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:5:{s:24:\"/admin/Api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"4\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:7:\"product\";s:5:\"field\";s:11:\"show_status\";}', '127.0.0.1', '2019-07-19 14:34:23');
INSERT INTO `st_operation_log` VALUES ('117', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:5:{s:24:\"/admin/Api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"3\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:7:\"product\";s:5:\"field\";s:11:\"show_status\";}', '127.0.0.1', '2019-07-19 14:34:24');
INSERT INTO `st_operation_log` VALUES ('118', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:5:{s:24:\"/admin/Api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"6\";s:6:\"status\";s:1:\"2\";s:2:\"db\";s:7:\"product\";s:5:\"field\";s:11:\"show_status\";}', '127.0.0.1', '2019-07-19 14:34:25');
INSERT INTO `st_operation_log` VALUES ('119', '3', '1', 'admin1', '1', '2', '', '修改登录状态', '/admin/User/user_status_change', 'a:3:{s:30:\"/admin/User/user_status_change\";s:0:\"\";s:3:\"uid\";s:1:\"2\";s:6:\"status\";s:1:\"1\";}', '127.0.0.1', '2019-07-19 15:09:27');
INSERT INTO `st_operation_log` VALUES ('120', '1', '2', '18237837598', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:18:\"/index/Login/login\";s:0:\"\";s:8:\"username\";s:11:\"18237837598\";s:8:\"password\";s:6:\"123456\";s:5:\"vcode\";s:4:\"8930\";}', '127.0.0.1', '2019-07-19 15:09:34');
INSERT INTO `st_operation_log` VALUES ('121', '1', '2', '18237837598', '1', '0', '', '会员退出登陆', '/index/Login/logout', 'a:1:{s:19:\"/index/Login/logout\";s:0:\"\";}', '127.0.0.1', '2019-07-19 15:09:44');
INSERT INTO `st_operation_log` VALUES ('122', '1', '2', '18237837598', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:18:\"/index/Login/login\";s:0:\"\";s:8:\"username\";s:11:\"18237837598\";s:8:\"password\";s:6:\"123456\";s:5:\"vcode\";s:4:\"0928\";}', '127.0.0.1', '2019-07-19 15:09:52');
INSERT INTO `st_operation_log` VALUES ('123', '1', '2', '18237837598', '1', '0', '', '会员退出登陆', '/index/Login/logout', 'a:1:{s:19:\"/index/Login/logout\";s:0:\"\";}', '127.0.0.1', '2019-07-19 16:06:49');
INSERT INTO `st_operation_log` VALUES ('124', '1', '4', '18237837511', '1', '4', '', '用户注册', '/index/Login/register', 'a:8:{s:21:\"/index/Login/register\";s:0:\"\";s:8:\"username\";s:11:\"18237837511\";s:5:\"vcode\";s:4:\"0638\";s:4:\"code\";s:6:\"111111\";s:8:\"nickname\";s:3:\"123\";s:8:\"password\";s:6:\"123123\";s:11:\"re_password\";s:6:\"123123\";s:13:\"invite_number\";s:0:\"\";}', '127.0.0.1', '2019-07-19 17:31:14');
INSERT INTO `st_operation_log` VALUES ('125', '3', '1', 'admin1', '4', '0', '', '添加公告', '/admin/Admin/notice_add', 'a:5:{s:23:\"/admin/Admin/notice_add\";s:0:\"\";s:5:\"title\";s:3:\"123\";s:7:\"content\";s:6:\"123123\";s:4:\"type\";s:1:\"1\";s:4:\"sort\";s:3:\"123\";}', '127.0.0.1', '2019-07-19 21:33:01');
INSERT INTO `st_operation_log` VALUES ('126', '3', '1', 'admin1', '4', '0', '', '编辑公告', '/admin/Admin/notice_edit', 'a:6:{s:24:\"/admin/Admin/notice_edit\";s:0:\"\";s:2:\"id\";s:1:\"2\";s:5:\"title\";s:3:\"123\";s:7:\"content\";s:6:\"123123\";s:4:\"type\";s:1:\"1\";s:4:\"sort\";s:1:\"1\";}', '127.0.0.1', '2019-07-19 21:33:13');
INSERT INTO `st_operation_log` VALUES ('127', '3', '1', 'admin1', '4', '0', '', '添加客服', '/admin/Admin/kefu_add', 'a:6:{s:21:\"/admin/Admin/kefu_add\";s:0:\"\";s:4:\"name\";s:8:\"qq客服\";s:5:\"value\";s:6:\"123123\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:0:\"\";s:4:\"sort\";s:1:\"1\";}', '127.0.0.1', '2019-07-19 22:02:37');
INSERT INTO `st_operation_log` VALUES ('128', '3', '1', 'admin1', '4', '0', '', '添加客服', '/admin/Admin/kefu_add', 'a:6:{s:21:\"/admin/Admin/kefu_add\";s:0:\"\";s:4:\"name\";s:12:\"微信客服\";s:5:\"value\";s:3:\"123\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:59:\"/uploads/kefu/20190719\\dd520c352e58bceadea5f17cd62cb0d6.png\";s:4:\"sort\";s:0:\"\";}', '127.0.0.1', '2019-07-19 22:02:49');
INSERT INTO `st_operation_log` VALUES ('129', '3', '1', 'admin1', '4', '0', '', '添加客服', '/admin/Admin/kefu_add', 'a:6:{s:21:\"/admin/Admin/kefu_add\";s:0:\"\";s:4:\"name\";s:15:\"手机版下载\";s:5:\"value\";s:3:\"123\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:59:\"/uploads/kefu/20190719\\bc870cb979c0cb2f0e91a75fdcd437f4.png\";s:4:\"sort\";s:0:\"\";}', '127.0.0.1', '2019-07-19 22:03:04');
INSERT INTO `st_operation_log` VALUES ('130', '1', '4', '18237837511', '1', '0', '', '会员退出登陆', '/index/Login/logout', 'a:1:{s:19:\"/index/Login/logout\";s:0:\"\";}', '127.0.0.1', '2019-07-19 22:06:03');
INSERT INTO `st_operation_log` VALUES ('131', '3', '1', 'admin1', '4', '0', '', '添加资讯', '/admin/Admin/news_add', 'a:6:{s:21:\"/admin/Admin/news_add\";s:0:\"\";s:5:\"title\";s:12:\"公司简介\";s:7:\"content\";s:133:\"<p><b>我是简介</b></p><p><b><img src=\"http://local.test.com/static/admin/lib/layui/images/face/1.gif\" alt=\"[嘻嘻]\"><br></b></p>\";s:4:\"file\";s:0:\"\";s:4:\"type\";s:1:\"2\";s:4:\"sort\";s:2:\"10\";}', '127.0.0.1', '2019-07-19 22:14:47');
INSERT INTO `st_operation_log` VALUES ('132', '3', '1', 'admin1', '4', '0', '', '添加资讯', '/admin/Admin/news_add', 'a:6:{s:21:\"/admin/Admin/news_add\";s:0:\"\";s:5:\"title\";s:12:\"联系我们\";s:7:\"content\";s:3:\"123\";s:4:\"file\";s:0:\"\";s:4:\"type\";s:1:\"2\";s:4:\"sort\";s:1:\"9\";}', '127.0.0.1', '2019-07-19 22:15:09');
INSERT INTO `st_operation_log` VALUES ('133', '3', '1', 'admin1', '4', '0', '', '添加资讯', '/admin/Admin/news_add', 'a:6:{s:21:\"/admin/Admin/news_add\";s:0:\"\";s:5:\"title\";s:12:\"注册指南\";s:7:\"content\";s:121:\"<p><img src=\"/uploads/notice/20190719/1ba69a98bd63d832e45bd70096458d27.png\" alt=\"undefined\"></p><p>我是注册指南</p>\";s:4:\"file\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:4:\"sort\";s:2:\"10\";}', '127.0.0.1', '2019-07-19 22:15:32');
INSERT INTO `st_operation_log` VALUES ('134', '3', '1', 'admin1', '4', '0', '', '添加资讯', '/admin/Admin/news_add', 'a:6:{s:21:\"/admin/Admin/news_add\";s:0:\"\";s:5:\"title\";s:12:\"交易指南\";s:7:\"content\";s:18:\"我是交易指南\";s:4:\"file\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:4:\"sort\";s:1:\"9\";}', '127.0.0.1', '2019-07-19 22:15:49');
INSERT INTO `st_operation_log` VALUES ('135', '3', '1', 'admin1', '4', '0', '', '添加资讯', '/admin/Admin/news_add', 'a:6:{s:21:\"/admin/Admin/news_add\";s:0:\"\";s:5:\"title\";s:9:\"APP下载\";s:7:\"content\";s:6:\"123123\";s:4:\"file\";s:0:\"\";s:4:\"type\";s:1:\"4\";s:4:\"sort\";s:2:\"10\";}', '127.0.0.1', '2019-07-19 22:16:01');
INSERT INTO `st_operation_log` VALUES ('136', '3', '1', 'admin1', '1', '2', '{\"uid\":2,\"username\":\"18237837598\",\"nickname\":\"34234\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\",\"pwd\":\"123456\",\"pid\":1,\"agent_id\":5,\"agent_name\":\"dfgdghgh\",\"agent_nickname\":\"rerer1\",\"code\":\"\\/uploads\\/code\\/156342697440497.png\",\"invite_number\":\"2345\",\"', '编辑会员,修改密码', '/admin/User/user_edit', 'a:13:{s:21:\"/admin/User/user_edit\";s:0:\"\";s:3:\"uid\";s:1:\"2\";s:8:\"username\";s:11:\"18237837598\";s:8:\"password\";s:6:\"123123\";s:8:\"nickname\";s:5:\"34234\";s:13:\"invite_number\";s:6:\"234512\";s:5:\"money\";s:4:\"0.00\";s:6:\"xm_fee\";s:4:\"0.00\";s:12:\"login_status\";s:1:\"1\";s:12:\"trade_status\";s:1:\"2\";s:13:\"invite_status\";s:1:\"2\";s:8:\"agent_id\";s:8:\"dfgdghgh\";s:3:\"pid\";s:11:\"13138602014\";}', '127.0.0.1', '2019-07-19 22:34:35');
INSERT INTO `st_operation_log` VALUES ('137', '1', '2', '18237837598', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:18:\"/index/Login/login\";s:0:\"\";s:8:\"username\";s:11:\"18237837598\";s:8:\"password\";s:6:\"123123\";s:5:\"vcode\";s:4:\"4753\";}', '127.0.0.1', '2019-07-19 22:34:43');
INSERT INTO `st_operation_log` VALUES ('138', '1', '2', '18237837598', '1', '1', '', '会员发起实名认证', '/index/User/real_auth', 'a:3:{s:21:\"/index/User/real_auth\";s:0:\"\";s:4:\"name\";s:3:\"123\";s:4:\"card\";s:18:\"410725199309220013\";}', '127.0.0.1', '2019-07-20 00:33:08');
INSERT INTO `st_operation_log` VALUES ('139', '3', '1', 'admin1', '1', '2', '', '审核通过会员实名', '/admin/Api/user_real_handle', 'a:4:{s:27:\"/admin/Api/user_real_handle\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '127.0.0.1', '2019-07-20 00:33:31');
INSERT INTO `st_operation_log` VALUES ('140', '3', '1', 'admin1', '1', '2', '', '审核拒绝会员实名', '/admin/Api/user_real_handle', 'a:4:{s:27:\"/admin/Api/user_real_handle\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"3\";s:6:\"remark\";s:3:\"123\";}', '127.0.0.1', '2019-07-20 00:34:18');
INSERT INTO `st_operation_log` VALUES ('141', '1', '2', '18237837598', '1', '2', '', '会员发起实名认证', '/index/User/real_auth', 'a:3:{s:21:\"/index/User/real_auth\";s:0:\"\";s:4:\"name\";s:3:\"123\";s:4:\"card\";s:18:\"410725199309220013\";}', '127.0.0.1', '2019-07-20 00:38:25');
INSERT INTO `st_operation_log` VALUES ('142', '3', '1', 'admin1', '1', '2', '', '审核通过会员实名', '/admin/Api/user_real_handle', 'a:4:{s:27:\"/admin/Api/user_real_handle\";s:0:\"\";s:2:\"id\";s:1:\"2\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '127.0.0.1', '2019-07-20 00:42:50');
INSERT INTO `st_operation_log` VALUES ('143', '3', '1', 'admin1', '1', '2', '', '审核通过会员实名', '/admin/Api/user_real_handle', 'a:4:{s:27:\"/admin/Api/user_real_handle\";s:0:\"\";s:2:\"id\";s:1:\"2\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '127.0.0.1', '2019-07-20 00:45:00');
INSERT INTO `st_operation_log` VALUES ('144', '3', '1', 'admin1', '1', '2', '', '上分', '/admin/Api/new_user_money_change', 'a:4:{s:32:\"/admin/Api/new_user_money_change\";s:0:\"\";s:3:\"uid\";s:1:\"2\";s:5:\"money\";s:4:\"1000\";s:5:\"param\";s:2:\"up\";}', '127.0.0.1', '2019-07-20 10:01:39');
INSERT INTO `st_operation_log` VALUES ('145', '1', '2', '34234', '1', '0', '', '用户提现', '/index/User/withdraw', 'a:3:{s:20:\"/index/User/withdraw\";s:0:\"\";s:5:\"money\";s:1:\"1\";s:12:\"bank_info_id\";s:1:\"3\";}', '127.0.0.1', '2019-07-20 10:05:34');
INSERT INTO `st_operation_log` VALUES ('146', '1', '2', '34234', '1', '0', '', '用户提现', '/index/User/withdraw', 'a:3:{s:20:\"/index/User/withdraw\";s:0:\"\";s:5:\"money\";s:1:\"2\";s:12:\"bank_info_id\";s:1:\"3\";}', '127.0.0.1', '2019-07-20 10:05:40');
INSERT INTO `st_operation_log` VALUES ('147', '1', '2', '34234', '1', '2', '{\"old_password\":\"123456\",\"password\":\"123123\",\"repass\":\"123123\"}', '修改密码', '/index/User/re_pwd', 'a:4:{s:18:\"/index/User/re_pwd\";s:0:\"\";s:12:\"old_password\";s:6:\"123456\";s:8:\"password\";s:6:\"123123\";s:6:\"repass\";s:6:\"123123\";}', '127.0.0.1', '2019-07-20 10:24:32');
INSERT INTO `st_operation_log` VALUES ('148', '3', '1', 'admin1', '4', '0', '', '修改申购币', '/admin/Coin/coin_edit', 'a:10:{s:21:\"/admin/Coin/coin_edit\";s:0:\"\";s:4:\"name\";s:2:\"45\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:58:\"/uploads/adv/20190720\\9107c42f795c409df221397fcf190945.png\";s:12:\"abbreviation\";s:3:\"234\";s:8:\"describe\";s:2:\"dt\";s:5:\"price\";s:8:\"3.000000\";s:8:\"min_hand\";s:8:\"3.000000\";s:8:\"max_hand\";s:8:\"1.000000\";s:2:\"id\";s:1:\"2\";}', '127.0.0.1', '2019-07-20 10:47:41');
INSERT INTO `st_operation_log` VALUES ('149', '3', '1', 'admin1', '4', '0', '', '修改申购币', '/admin/Coin/coin_edit', 'a:10:{s:21:\"/admin/Coin/coin_edit\";s:0:\"\";s:4:\"name\";s:4:\"2311\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:58:\"/uploads/adv/20190720\\f5ac2ee09604845a7d2188d3f156f36d.png\";s:12:\"abbreviation\";s:3:\"123\";s:8:\"describe\";s:3:\"234\";s:5:\"price\";s:10:\"234.000000\";s:8:\"min_hand\";s:10:\"234.000000\";s:8:\"max_hand\";s:8:\"1.000000\";s:2:\"id\";s:1:\"1\";}', '127.0.0.1', '2019-07-20 10:47:47');
INSERT INTO `st_operation_log` VALUES ('150', '3', '1', 'admin1', '4', '0', '', '添加广告', '/admin/Admin/adv_add', 'a:7:{s:20:\"/admin/Admin/adv_add\";s:0:\"\";s:4:\"name\";s:3:\"123\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:58:\"/uploads/adv/20190720\\928378f286654e4752350ad02ec823fd.png\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"1\";s:4:\"sort\";s:0:\"\";}', '127.0.0.1', '2019-07-20 10:51:58');
INSERT INTO `st_operation_log` VALUES ('151', '3', '1', 'admin1', '4', '0', '', '添加广告', '/admin/Admin/adv_add', 'a:7:{s:20:\"/admin/Admin/adv_add\";s:0:\"\";s:4:\"name\";s:1:\"1\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:58:\"/uploads/adv/20190720\\904845d843b54318a9d82b3333db96e9.jpg\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"1\";s:4:\"sort\";s:2:\"10\";}', '127.0.0.1', '2019-07-20 10:56:00');
INSERT INTO `st_operation_log` VALUES ('152', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:4:{s:24:\"/admin/Api/status_change\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:6:\"status\";s:1:\"3\";s:2:\"db\";s:3:\"adv\";}', '127.0.0.1', '2019-07-20 10:56:05');
INSERT INTO `st_operation_log` VALUES ('153', '3', '1', 'admin1', '4', '0', '', '添加广告', '/admin/Admin/adv_add', 'a:7:{s:20:\"/admin/Admin/adv_add\";s:0:\"\";s:4:\"name\";s:1:\"2\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:58:\"/uploads/adv/20190720\\dbc868ceb0da4cc341c13871a5ebd5d4.jpg\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"1\";s:4:\"sort\";s:1:\"9\";}', '127.0.0.1', '2019-07-20 10:56:13');
INSERT INTO `st_operation_log` VALUES ('154', '3', '1', 'admin1', '4', '0', '', '添加广告', '/admin/Admin/adv_add', 'a:7:{s:20:\"/admin/Admin/adv_add\";s:0:\"\";s:4:\"name\";s:1:\"3\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:58:\"/uploads/adv/20190720\\ed8f4558da0d031d24c7ef1437190165.png\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"1\";s:4:\"sort\";s:1:\"8\";}', '127.0.0.1', '2019-07-20 10:56:24');
INSERT INTO `st_operation_log` VALUES ('155', '3', '1', 'admin1', '4', '0', '', '添加广告', '/admin/Admin/adv_add', 'a:7:{s:20:\"/admin/Admin/adv_add\";s:0:\"\";s:4:\"name\";s:1:\"4\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:58:\"/uploads/adv/20190720\\77087f60948f7f8295910af8f51a2e8e.png\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"1\";s:4:\"sort\";s:2:\"10\";}', '127.0.0.1', '2019-07-20 10:57:04');
INSERT INTO `st_operation_log` VALUES ('156', '3', '1', 'admin1', '4', '0', '', '添加广告', '/admin/Admin/adv_add', 'a:7:{s:20:\"/admin/Admin/adv_add\";s:0:\"\";s:4:\"name\";s:1:\"5\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:58:\"/uploads/adv/20190720\\73de558c8b008095167ad0a50d76ac75.png\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"1\";s:4:\"sort\";s:1:\"9\";}', '127.0.0.1', '2019-07-20 10:57:14');
INSERT INTO `st_operation_log` VALUES ('157', '3', '1', 'admin1', '4', '0', '', '添加广告', '/admin/Admin/adv_add', 'a:7:{s:20:\"/admin/Admin/adv_add\";s:0:\"\";s:4:\"name\";s:1:\"6\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:58:\"/uploads/adv/20190720\\ae613b9d5a68f39ec36287714ab447d5.png\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"2\";s:4:\"sort\";s:1:\"8\";}', '127.0.0.1', '2019-07-20 10:57:27');
INSERT INTO `st_operation_log` VALUES ('158', '3', '1', 'admin1', '4', '0', '', '编辑广告', '/admin/Admin/adv_edit', 'a:8:{s:21:\"/admin/Admin/adv_edit\";s:0:\"\";s:2:\"id\";s:1:\"6\";s:4:\"name\";s:1:\"5\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:58:\"/uploads/adv/20190720\\73de558c8b008095167ad0a50d76ac75.png\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"2\";s:4:\"sort\";s:1:\"9\";}', '127.0.0.1', '2019-07-20 10:57:43');
INSERT INTO `st_operation_log` VALUES ('159', '3', '1', 'admin1', '4', '0', '', '编辑广告', '/admin/Admin/adv_edit', 'a:8:{s:21:\"/admin/Admin/adv_edit\";s:0:\"\";s:2:\"id\";s:1:\"5\";s:4:\"name\";s:1:\"4\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:58:\"/uploads/adv/20190720\\77087f60948f7f8295910af8f51a2e8e.png\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"2\";s:4:\"sort\";s:2:\"10\";}', '127.0.0.1', '2019-07-20 10:57:47');
INSERT INTO `st_operation_log` VALUES ('160', '1', '2', '18237837598', '1', '2', '', '申购币购买', '/index/Coin/buy', 'a:3:{s:15:\"/index/Coin/buy\";s:0:\"\";s:6:\"number\";s:1:\"1\";s:2:\"id\";s:1:\"2\";}', '127.0.0.1', '2019-07-20 12:43:17');
INSERT INTO `st_operation_log` VALUES ('161', '1', '2', '18237837598', '1', '2', '', '申购币购买', '/index/Coin/buy', 'a:3:{s:15:\"/index/Coin/buy\";s:0:\"\";s:6:\"number\";s:1:\"2\";s:2:\"id\";s:1:\"2\";}', '127.0.0.1', '2019-07-20 12:48:49');
INSERT INTO `st_operation_log` VALUES ('162', '1', '2', '18237837598', '1', '2', '', '申购币购买', '/index/Coin/buy', 'a:3:{s:15:\"/index/Coin/buy\";s:0:\"\";s:6:\"number\";s:2:\"10\";s:2:\"id\";s:1:\"2\";}', '127.0.0.1', '2019-07-20 12:49:54');
INSERT INTO `st_operation_log` VALUES ('163', '1', '2', '18237837598', '1', '2', '', '申购币购买', '/index/Coin/buy', 'a:3:{s:15:\"/index/Coin/buy\";s:0:\"\";s:6:\"number\";s:1:\"1\";s:2:\"id\";s:1:\"2\";}', '127.0.0.1', '2019-07-20 12:53:40');
INSERT INTO `st_operation_log` VALUES ('164', '1', '2', '18237837598', '1', '0', '', '会员退出登陆', '/index/Login/logout', 'a:1:{s:19:\"/index/Login/logout\";s:0:\"\";}', '127.0.0.1', '2019-07-20 13:57:49');
INSERT INTO `st_operation_log` VALUES ('165', '1', '2', '18237837598', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:18:\"/index/Login/login\";s:0:\"\";s:8:\"username\";s:11:\"18237837598\";s:8:\"password\";s:6:\"123123\";s:5:\"vcode\";s:4:\"4275\";}', '127.0.0.1', '2019-07-20 15:23:54');
INSERT INTO `st_operation_log` VALUES ('166', '1', '2', '18237837598', '1', '100004', '', '会员建仓扣除手续费', '/index/Trade/create_order', 'a:1:{s:25:\"/index/Trade/create_order\";s:0:\"\";}', '127.0.0.1', '2019-07-21 00:46:11');
INSERT INTO `st_operation_log` VALUES ('167', '1', '2', '18237837598', '1', '100003', '', '会员平仓', '/index/Trade/close_order', 'a:1:{s:24:\"/index/Trade/close_order\";s:0:\"\";}', '127.0.0.1', '2019-07-21 01:15:26');
INSERT INTO `st_operation_log` VALUES ('168', '1', '2', '18237837598', '1', '100004', '', '会员平仓', '/index/Trade/close_order', 'a:1:{s:24:\"/index/Trade/close_order\";s:0:\"\";}', '127.0.0.1', '2019-07-21 01:18:13');
INSERT INTO `st_operation_log` VALUES ('169', '1', '2', '18237837598', '1', '100005', '', '会员建仓', '/index/Trade/create_order', 'a:1:{s:25:\"/index/Trade/create_order\";s:0:\"\";}', '127.0.0.1', '2019-07-21 01:21:43');
INSERT INTO `st_operation_log` VALUES ('170', '1', '2', '18237837598', '1', '100006', '', '会员建仓', '/index/Trade/create_order', 'a:1:{s:25:\"/index/Trade/create_order\";s:0:\"\";}', '127.0.0.1', '2019-07-21 01:24:54');
INSERT INTO `st_operation_log` VALUES ('171', '1', '2', '18237837598', '1', '100007', '', '会员建仓', '/index/Trade/create_order', 'a:1:{s:25:\"/index/Trade/create_order\";s:0:\"\";}', '127.0.0.1', '2019-07-21 02:01:37');
INSERT INTO `st_operation_log` VALUES ('172', '1', '2', '18237837598', '1', '100008', '', '会员建仓', '/index/Trade/create_order', 'a:1:{s:25:\"/index/Trade/create_order\";s:0:\"\";}', '127.0.0.1', '2019-07-21 02:01:40');
INSERT INTO `st_operation_log` VALUES ('173', '1', '2', '18237837598', '1', '100005', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100005\";}', '127.0.0.1', '2019-07-21 02:16:06');
INSERT INTO `st_operation_log` VALUES ('174', '1', '2', '18237837598', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:18:\"/index/Login/login\";s:0:\"\";s:8:\"username\";s:11:\"18237837598\";s:8:\"password\";s:6:\"123123\";s:5:\"vcode\";s:4:\"4924\";}', '127.0.0.1', '2019-07-21 09:09:21');
INSERT INTO `st_operation_log` VALUES ('175', '1', '2', '18237837598', '1', '100006', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100006\";}', '127.0.0.1', '2019-07-21 09:18:09');
INSERT INTO `st_operation_log` VALUES ('176', '1', '2', '18237837598', '1', '100007', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100007\";}', '127.0.0.1', '2019-07-21 09:30:54');
INSERT INTO `st_operation_log` VALUES ('177', '1', '2', '18237837598', '1', '100008', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100008\";}', '127.0.0.1', '2019-07-21 09:34:20');
INSERT INTO `st_operation_log` VALUES ('178', '1', '2', '18237837598', '1', '100009', '', '会员建仓', '/index/Trade/create_order', 'a:1:{s:25:\"/index/Trade/create_order\";s:0:\"\";}', '127.0.0.1', '2019-07-21 09:39:11');
INSERT INTO `st_operation_log` VALUES ('179', '1', '2', '18237837598', '1', '100010', '', '会员建仓', '/index/Trade/create_order', 'a:1:{s:25:\"/index/Trade/create_order\";s:0:\"\";}', '127.0.0.1', '2019-07-21 09:39:13');
INSERT INTO `st_operation_log` VALUES ('180', '1', '2', '18237837598', '1', '100011', '', '会员建仓', '/index/Trade/create_order', 'a:1:{s:25:\"/index/Trade/create_order\";s:0:\"\";}', '127.0.0.1', '2019-07-21 09:39:15');
INSERT INTO `st_operation_log` VALUES ('181', '1', '2', '18237837598', '1', '100012', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:0:\"\";s:9:\"stop_loss\";s:0:\"\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-22 03:26:53');
INSERT INTO `st_operation_log` VALUES ('182', '1', '2', '18237837598', '1', '100013', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:0:\"\";s:9:\"stop_loss\";s:0:\"\";s:2:\"id\";s:1:\"5\";s:9:\"direction\";s:1:\"2\";}', '127.0.0.1', '2019-07-22 03:27:02');
INSERT INTO `st_operation_log` VALUES ('183', '1', '2', '18237837598', '1', '100014', '', '会员建仓', '/index/Trade/create_order', 'a:7:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:2:\"01\";s:19:\"target_profit_check\";s:1:\"1\";s:13:\"target_profit\";s:8:\"10472.14\";s:9:\"stop_loss\";s:0:\"\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-22 03:28:30');
INSERT INTO `st_operation_log` VALUES ('184', '1', '2', '18237837598', '1', '100015', '', '会员建仓', '/index/Trade/create_order', 'a:8:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:2:\"01\";s:19:\"target_profit_check\";s:1:\"1\";s:13:\"target_profit\";s:8:\"10472.14\";s:15:\"stop_loss_check\";s:1:\"1\";s:9:\"stop_loss\";s:8:\"10455.39\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-22 03:28:44');
INSERT INTO `st_operation_log` VALUES ('185', '1', '2', '18237837598', '1', '100016', '', '会员建仓', '/index/Trade/create_order', 'a:7:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:2:\"01\";s:19:\"target_profit_check\";s:1:\"1\";s:13:\"target_profit\";s:8:\"10412.49\";s:9:\"stop_loss\";s:0:\"\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-22 03:32:43');
INSERT INTO `st_operation_log` VALUES ('186', '1', '2', '18237837598', '1', '100017', '', '会员建仓', '/index/Trade/create_order', 'a:7:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:2:\"01\";s:19:\"target_profit_check\";s:1:\"1\";s:13:\"target_profit\";s:8:\"10412.49\";s:9:\"stop_loss\";s:0:\"\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-22 03:32:53');
INSERT INTO `st_operation_log` VALUES ('187', '1', '2', '18237837598', '1', '100018', '', '会员建仓', '/index/Trade/create_order', 'a:7:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:2:\"01\";s:19:\"target_profit_check\";s:1:\"1\";s:13:\"target_profit\";s:8:\"10411.49\";s:9:\"stop_loss\";s:0:\"\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-22 03:32:57');
INSERT INTO `st_operation_log` VALUES ('188', '1', '2', '18237837598', '1', '100019', '', '会员建仓', '/index/Trade/create_order', 'a:7:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:2:\"01\";s:19:\"target_profit_check\";s:1:\"1\";s:13:\"target_profit\";s:9:\"10411.271\";s:9:\"stop_loss\";s:0:\"\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-22 03:34:02');
INSERT INTO `st_operation_log` VALUES ('189', '1', '2', '18237837598', '1', '100020', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:2:\"11\";s:13:\"target_profit\";s:0:\"\";s:9:\"stop_loss\";s:0:\"\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-22 03:39:41');
INSERT INTO `st_operation_log` VALUES ('190', '1', '2', '18237837598', '1', '100017', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100017\";}', '127.0.0.1', '2019-07-22 03:40:32');
INSERT INTO `st_operation_log` VALUES ('191', '1', '2', '18237837598', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:18:\"/index/Login/login\";s:0:\"\";s:8:\"username\";s:11:\"18237837598\";s:8:\"password\";s:6:\"123123\";s:5:\"vcode\";s:4:\"4315\";}', '127.0.0.1', '2019-07-22 11:20:09');
INSERT INTO `st_operation_log` VALUES ('192', '1', '2', '18237837598', '1', '100021', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:7:\"10586.4\";s:9:\"stop_loss\";s:7:\"10566.4\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-22 13:42:44');
INSERT INTO `st_operation_log` VALUES ('193', '1', '2', '18237837598', '1', '100022', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:8:\"10587.48\";s:9:\"stop_loss\";s:8:\"10567.48\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-22 13:43:07');
INSERT INTO `st_operation_log` VALUES ('194', '1', '2', '18237837598', '1', '100023', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:8:\"10594.73\";s:9:\"stop_loss\";s:8:\"10574.73\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-22 13:43:53');
INSERT INTO `st_operation_log` VALUES ('195', '1', '2', '18237837598', '1', '100024', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:8:\"10595.77\";s:9:\"stop_loss\";s:8:\"10575.77\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-22 13:44:15');
INSERT INTO `st_operation_log` VALUES ('196', '1', '2', '18237837598', '1', '100025', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:8:\"10602.63\";s:9:\"stop_loss\";s:8:\"10582.63\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-22 13:45:57');
INSERT INTO `st_operation_log` VALUES ('197', '1', '2', '18237837598', '1', '100026', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:6:\"14.308\";s:9:\"stop_loss\";s:6:\"-5.692\";s:2:\"id\";s:1:\"5\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-22 13:49:08');
INSERT INTO `st_operation_log` VALUES ('198', '1', '2', '18237837598', '1', '100027', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:2:\"12\";s:13:\"target_profit\";s:5:\"10593\";s:9:\"stop_loss\";s:5:\"10573\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-22 13:53:55');
INSERT INTO `st_operation_log` VALUES ('199', '1', '2', '18237837598', '1', '100028', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:8:\"10626.87\";s:9:\"stop_loss\";s:8:\"10606.87\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-22 14:03:28');
INSERT INTO `st_operation_log` VALUES ('200', '1', '2', '18237837598', '1', '100029', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:8:\"10632.61\";s:9:\"stop_loss\";s:8:\"10612.61\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-22 14:07:11');
INSERT INTO `st_operation_log` VALUES ('201', '1', '2', '18237837598', '1', '100030', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:8:\"10623.36\";s:9:\"stop_loss\";s:8:\"10603.36\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-22 14:07:51');
INSERT INTO `st_operation_log` VALUES ('202', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:18:\"/admin/Login/login\";s:0:\"\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:6:\"123123\";}', '127.0.0.1', '2019-07-22 19:18:02');
INSERT INTO `st_operation_log` VALUES ('203', '1', '2', '18237837598', '1', '100030', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100030\";}', '127.0.0.1', '2019-07-22 19:18:08');
INSERT INTO `st_operation_log` VALUES ('204', '1', '2', '18237837598', '1', '2', '', '申购币购买', '/index/Coin/buy', 'a:3:{s:15:\"/index/Coin/buy\";s:0:\"\";s:6:\"number\";s:1:\"1\";s:2:\"id\";s:1:\"2\";}', '127.0.0.1', '2019-07-22 23:30:36');
INSERT INTO `st_operation_log` VALUES ('205', '1', '2', '18237837598', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:18:\"/index/Login/login\";s:0:\"\";s:8:\"username\";s:11:\"18237837598\";s:8:\"password\";s:6:\"123123\";s:5:\"vcode\";s:4:\"8791\";}', '127.0.0.1', '2019-07-23 14:22:29');
INSERT INTO `st_operation_log` VALUES ('206', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:18:\"/admin/Login/login\";s:0:\"\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:6:\"123123\";}', '127.0.0.1', '2019-07-23 14:22:55');
INSERT INTO `st_operation_log` VALUES ('207', '3', '1', 'admin1', '1', '2', '', '修改交易状态', '/admin/User/user_trade_status', 'a:3:{s:29:\"/admin/User/user_trade_status\";s:0:\"\";s:3:\"uid\";s:1:\"2\";s:6:\"status\";s:1:\"1\";}', '127.0.0.1', '2019-07-23 14:23:03');
INSERT INTO `st_operation_log` VALUES ('208', '1', '2', '18237837598', '1', '100031', '', '会员建仓', '/index/Trade/create_order', 'a:7:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:19:\"target_profit_check\";s:1:\"1\";s:13:\"target_profit\";s:8:\"10116.08\";s:9:\"stop_loss\";s:8:\"10096.08\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-23 14:23:06');
INSERT INTO `st_operation_log` VALUES ('209', '3', '1', 'admin1', '1', '100031', '', '强行平仓', '/admin/Api/closeOrder', 'a:2:{s:21:\"/admin/Api/closeOrder\";s:0:\"\";s:3:\"oid\";s:6:\"100031\";}', '127.0.0.1', '2019-07-23 15:37:42');
INSERT INTO `st_operation_log` VALUES ('210', '3', '1', 'admin1', '1', '100029', '', '强行平仓', '/admin/Api/closeOrder', 'a:2:{s:21:\"/admin/Api/closeOrder\";s:0:\"\";s:3:\"oid\";s:6:\"100029\";}', '127.0.0.1', '2019-07-23 15:53:26');
INSERT INTO `st_operation_log` VALUES ('211', '3', '1', 'admin1', '1', '100028', '', '强行平仓', '/admin/Api/closeOrder', 'a:2:{s:21:\"/admin/Api/closeOrder\";s:0:\"\";s:3:\"oid\";s:6:\"100028\";}', '127.0.0.1', '2019-07-23 15:53:43');
INSERT INTO `st_operation_log` VALUES ('212', '3', '1', 'admin1', '1', '100027', '', '强行平仓', '/admin/Api/closeOrder', 'a:2:{s:21:\"/admin/Api/closeOrder\";s:0:\"\";s:3:\"oid\";s:6:\"100027\";}', '127.0.0.1', '2019-07-23 15:55:41');
INSERT INTO `st_operation_log` VALUES ('213', '3', '1', 'admin1', '1', '100026', '', '强行平仓', '/admin/Api/closeOrder', 'a:2:{s:21:\"/admin/Api/closeOrder\";s:0:\"\";s:3:\"oid\";s:6:\"100026\";}', '127.0.0.1', '2019-07-23 15:56:00');
INSERT INTO `st_operation_log` VALUES ('214', '3', '1', 'admin1', '1', '100025', '', '强行平仓', '/admin/Api/closeOrder', 'a:2:{s:21:\"/admin/Api/closeOrder\";s:0:\"\";s:3:\"oid\";s:6:\"100025\";}', '127.0.0.1', '2019-07-23 15:56:56');
INSERT INTO `st_operation_log` VALUES ('215', '3', '1', 'admin1', '1', '100024', '', '强行平仓', '/admin/Api/closeOrder', 'a:2:{s:21:\"/admin/Api/closeOrder\";s:0:\"\";s:3:\"oid\";s:6:\"100024\";}', '127.0.0.1', '2019-07-23 15:58:41');
INSERT INTO `st_operation_log` VALUES ('216', '3', '1', 'admin1', '1', '100023', '', '强行平仓', '/admin/Api/closeOrder', 'a:2:{s:21:\"/admin/Api/closeOrder\";s:0:\"\";s:3:\"oid\";s:6:\"100023\";}', '127.0.0.1', '2019-07-23 15:58:55');
INSERT INTO `st_operation_log` VALUES ('217', '3', '1', 'admin1', '1', '100022', '', '强行平仓', '/admin/Api/closeOrder', 'a:2:{s:21:\"/admin/Api/closeOrder\";s:0:\"\";s:3:\"oid\";s:6:\"100022\";}', '127.0.0.1', '2019-07-23 15:59:26');
INSERT INTO `st_operation_log` VALUES ('218', '1', '2', '18237837598', '1', '100021', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100021\";}', '127.0.0.1', '2019-07-23 16:01:13');
INSERT INTO `st_operation_log` VALUES ('219', '1', '2', '18237837598', '1', '100020', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100020\";}', '127.0.0.1', '2019-07-23 16:05:02');
INSERT INTO `st_operation_log` VALUES ('220', '1', '2', '18237837598', '1', '100019', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100019\";}', '127.0.0.1', '2019-07-23 16:06:36');
INSERT INTO `st_operation_log` VALUES ('221', '1', '2', '18237837598', '1', '100018', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100018\";}', '127.0.0.1', '2019-07-23 16:07:29');
INSERT INTO `st_operation_log` VALUES ('222', '3', '1', 'admin1', '1', '100016', '', '强行平仓', '/admin/Api/closeOrder', 'a:2:{s:21:\"/admin/Api/closeOrder\";s:0:\"\";s:3:\"oid\";s:6:\"100016\";}', '127.0.0.1', '2019-07-23 16:08:14');
INSERT INTO `st_operation_log` VALUES ('223', '3', '1', 'admin1', '1', '100015', '', '强行平仓', '/admin/Api/closeOrder', 'a:2:{s:21:\"/admin/Api/closeOrder\";s:0:\"\";s:3:\"oid\";s:6:\"100015\";}', '127.0.0.1', '2019-07-23 16:08:20');
INSERT INTO `st_operation_log` VALUES ('224', '3', '1', 'admin1', '1', '100014', '', '强行平仓', '/admin/Api/closeOrder', 'a:2:{s:21:\"/admin/Api/closeOrder\";s:0:\"\";s:3:\"oid\";s:6:\"100014\";}', '127.0.0.1', '2019-07-23 16:10:02');
INSERT INTO `st_operation_log` VALUES ('225', '1', '2', '18237837598', '1', '100032', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:8:\"10071.82\";s:9:\"stop_loss\";s:8:\"10051.82\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"2\";}', '127.0.0.1', '2019-07-23 16:15:36');
INSERT INTO `st_operation_log` VALUES ('226', '1', '2', '18237837598', '1', '100013', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100013\";}', '127.0.0.1', '2019-07-23 16:23:58');
INSERT INTO `st_operation_log` VALUES ('227', '1', '2', '18237837598', '1', '100032', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100032\";}', '127.0.0.1', '2019-07-23 16:24:29');
INSERT INTO `st_operation_log` VALUES ('228', '1', '2', '18237837598', '1', '100012', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100012\";}', '127.0.0.1', '2019-07-23 16:24:58');
INSERT INTO `st_operation_log` VALUES ('229', '1', '2', '18237837598', '1', '100011', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100011\";}', '127.0.0.1', '2019-07-23 16:25:21');
INSERT INTO `st_operation_log` VALUES ('230', '1', '2', '18237837598', '1', '100033', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:8:\"10003.83\";s:9:\"stop_loss\";s:7:\"9983.83\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"2\";}', '127.0.0.1', '2019-07-23 16:32:16');
INSERT INTO `st_operation_log` VALUES ('231', '1', '2', '18237837598', '1', '100034', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:8:\"10021.61\";s:9:\"stop_loss\";s:8:\"10001.61\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"2\";}', '127.0.0.1', '2019-07-23 16:33:53');
INSERT INTO `st_operation_log` VALUES ('232', '1', '2', '18237837598', '1', '100035', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:7:\"9975.28\";s:9:\"stop_loss\";s:7:\"9955.28\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"2\";}', '127.0.0.1', '2019-07-23 16:35:59');
INSERT INTO `st_operation_log` VALUES ('233', '1', '2', '18237837598', '1', '100036', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:7:\"9986.39\";s:9:\"stop_loss\";s:7:\"9966.39\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"2\";}', '127.0.0.1', '2019-07-23 16:36:31');
INSERT INTO `st_operation_log` VALUES ('234', '1', '2', '18237837598', '1', '100037', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:6:\"9994.6\";s:9:\"stop_loss\";s:6:\"9974.6\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-23 16:39:22');
INSERT INTO `st_operation_log` VALUES ('235', '1', '2', '18237837598', '1', '100038', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:7:\"9968.32\";s:9:\"stop_loss\";s:7:\"9948.32\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-23 16:41:52');
INSERT INTO `st_operation_log` VALUES ('236', '1', '2', '18237837598', '1', '100039', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:7:\"9972.99\";s:9:\"stop_loss\";s:7:\"9952.99\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-23 16:43:07');
INSERT INTO `st_operation_log` VALUES ('237', '1', '2', '18237837598', '1', '100040', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:7:\"9981.53\";s:9:\"stop_loss\";s:7:\"9961.53\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-23 16:44:36');
INSERT INTO `st_operation_log` VALUES ('238', '1', '2', '18237837598', '1', '100041', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:2:\"01\";s:13:\"target_profit\";s:7:\"9980.63\";s:9:\"stop_loss\";s:7:\"9960.63\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-23 16:45:07');
INSERT INTO `st_operation_log` VALUES ('239', '1', '2', '18237837598', '1', '100041', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100041\";}', '127.0.0.1', '2019-07-23 16:53:27');
INSERT INTO `st_operation_log` VALUES ('240', '1', '2', '18237837598', '1', '100040', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100040\";}', '127.0.0.1', '2019-07-23 16:54:49');
INSERT INTO `st_operation_log` VALUES ('241', '1', '2', '18237837598', '1', '100039', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100039\";}', '127.0.0.1', '2019-07-23 16:55:41');
INSERT INTO `st_operation_log` VALUES ('242', '1', '2', '18237837598', '1', '100038', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100038\";}', '127.0.0.1', '2019-07-23 16:55:55');
INSERT INTO `st_operation_log` VALUES ('243', '1', '2', '18237837598', '1', '100042', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:7:\"9933.97\";s:9:\"stop_loss\";s:7:\"9913.97\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-23 16:56:26');
INSERT INTO `st_operation_log` VALUES ('244', '1', '2', '18237837598', '1', '100042', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100042\";}', '127.0.0.1', '2019-07-23 16:56:38');
INSERT INTO `st_operation_log` VALUES ('245', '1', '2', '18237837598', '1', '100037', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100037\";}', '127.0.0.1', '2019-07-23 16:56:43');
INSERT INTO `st_operation_log` VALUES ('246', '1', '2', '18237837598', '1', '100036', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100036\";}', '127.0.0.1', '2019-07-23 16:57:13');
INSERT INTO `st_operation_log` VALUES ('247', '1', '2', '18237837598', '1', '100035', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100035\";}', '127.0.0.1', '2019-07-23 16:57:17');
INSERT INTO `st_operation_log` VALUES ('248', '1', '2', '18237837598', '1', '100034', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100034\";}', '127.0.0.1', '2019-07-23 16:57:20');
INSERT INTO `st_operation_log` VALUES ('249', '1', '2', '18237837598', '1', '100033', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100033\";}', '127.0.0.1', '2019-07-23 16:57:54');
INSERT INTO `st_operation_log` VALUES ('250', '1', '2', '18237837598', '1', '100043', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:7:\"9957.46\";s:9:\"stop_loss\";s:7:\"9937.46\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-23 16:58:36');
INSERT INTO `st_operation_log` VALUES ('251', '1', '2', '18237837598', '1', '100044', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:7:\"9957.46\";s:9:\"stop_loss\";s:7:\"9937.46\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"2\";}', '127.0.0.1', '2019-07-23 16:58:39');
INSERT INTO `st_operation_log` VALUES ('252', '1', '2', '18237837598', '1', '100044', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100044\";}', '127.0.0.1', '2019-07-23 16:58:50');
INSERT INTO `st_operation_log` VALUES ('253', '1', '2', '18237837598', '1', '100045', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:7:\"9964.46\";s:9:\"stop_loss\";s:7:\"9944.46\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-23 17:02:56');
INSERT INTO `st_operation_log` VALUES ('254', '3', '1', 'admin1', '1', '100001', '', '强行平仓', '/admin/Api/closeOrder', 'a:2:{s:21:\"/admin/Api/closeOrder\";s:0:\"\";s:3:\"oid\";s:6:\"100001\";}', '127.0.0.1', '2019-07-23 17:03:46');
INSERT INTO `st_operation_log` VALUES ('255', '3', '1', 'admin1', '1', '100009', '', '强行平仓', '/admin/Api/closeOrder', 'a:2:{s:21:\"/admin/Api/closeOrder\";s:0:\"\";s:3:\"oid\";s:6:\"100009\";}', '127.0.0.1', '2019-07-23 17:03:50');
INSERT INTO `st_operation_log` VALUES ('256', '1', '2', '18237837598', '1', '100046', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:7:\"9998.95\";s:9:\"stop_loss\";s:7:\"9978.95\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-23 23:27:17');
INSERT INTO `st_operation_log` VALUES ('257', '1', '2', '18237837598', '1', '100045', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100045\";}', '127.0.0.1', '2019-07-23 23:27:33');
INSERT INTO `st_operation_log` VALUES ('258', '1', '2', '18237837598', '1', '100010', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:24:\"/index/Trade/close_order\";s:0:\"\";s:3:\"oid\";s:6:\"100010\";}', '127.0.0.1', '2019-07-23 23:27:36');
INSERT INTO `st_operation_log` VALUES ('259', '1', '2', '18237837598', '1', '100047', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:2:\"10\";s:13:\"target_profit\";s:7:\"9993.14\";s:9:\"stop_loss\";s:7:\"9973.14\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '127.0.0.1', '2019-07-23 23:27:43');
INSERT INTO `st_operation_log` VALUES ('260', '1', '2', '18237837598', '1', '100048', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:2:\"10\";s:13:\"target_profit\";s:7:\"9990.01\";s:9:\"stop_loss\";s:7:\"9970.01\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"2\";}', '127.0.0.1', '2019-07-23 23:27:48');
INSERT INTO `st_operation_log` VALUES ('261', '1', '2', '18237837598', '1', '100049', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:25:\"/index/Trade/create_order\";s:0:\"\";s:4:\"hand\";s:2:\"10\";s:13:\"target_profit\";s:7:\"9990.01\";s:9:\"stop_loss\";s:7:\"9970.01\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"2\";}', '127.0.0.1', '2019-07-23 23:27:52');

-- ----------------------------
-- Table structure for st_order
-- ----------------------------
DROP TABLE IF EXISTS `st_order`;
CREATE TABLE `st_order` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(255) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `agent_name` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_abbreviation` varchar(255) DEFAULT NULL,
  `money` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '保证金',
  `hand` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '手数',
  `contract` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '合约比例',
  `lever` decimal(20,6) NOT NULL DEFAULT '1.000000',
  `fee` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '手续费',
  `direction` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1买入（买涨）2卖出（买跌）',
  `buy_price` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '买入价',
  `sell_price` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '卖出价',
  `target_profit_check` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1否2是',
  `target_profit` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '止盈',
  `stop_loss_check` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1否2是',
  `stop_loss` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '止损',
  `profit` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '盈利金额',
  `loss_point` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '爆仓价格',
  `order_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1持仓2平仓',
  `order_close_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1用户平仓2总后台强平3爆仓4止盈平仓5止损平仓6过夜费不足强行平',
  `add_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB AUTO_INCREMENT=100050 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of st_order
-- ----------------------------
INSERT INTO `st_order` VALUES ('100000', '123123', '1', '13138602014', '5', 'dfgdghgh', '1', '1', 'BTC', '100.000000', '1.000000', '2.000000', '1.000000', '1.000000', '1', '2.000000', '3.000000', '1', '4.000000', '1', '0.000000', '0.000000', '0.000000', '2', '1', '2019-07-08 13:42:23', '2019-07-08 13:42:28');
INSERT INTO `st_order` VALUES ('100001', '1231233', '1', '13138602014', '5', 'dfgdghgh', '1', '1', 'BTC', '100.000000', '1.000000', '2.000000', '1.000000', '1.000000', '1', '2.000000', '9945.250000', '1', '4.000000', '1', '0.000000', '19886.500000', '0.000000', '2', '2', '2019-07-08 13:42:23', '2019-07-23 17:03:46');
INSERT INTO `st_order` VALUES ('100003', 'sn15636407267635', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10685.610000', '1.000000', '1.000000', '1.000000', '5.000000', '1', '10685.610000', '10906.950000', '1', '0.000000', '1', '0.000000', '0.000000', '0.000000', '2', '1', '2019-07-21 00:38:46', '2019-07-21 01:15:26');
INSERT INTO `st_order` VALUES ('100004', 'sn15636411716949', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10695.750000', '1.000000', '1.000000', '1.000000', '5.000000', '1', '10695.750000', '10926.960000', '1', '0.000000', '1', '0.000000', '10926.960000', '0.000000', '2', '1', '2019-07-21 00:46:11', '2019-07-21 01:18:13');
INSERT INTO `st_order` VALUES ('100005', 'sn15636433036681', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.924580', '1.000000', '0.001000', '1.000000', '5.000000', '1', '10924.580000', '10931.970000', '1', '0.000000', '1', '0.000000', '10931.970000', '0.000000', '2', '1', '2019-07-21 01:21:43', '2019-07-21 02:16:06');
INSERT INTO `st_order` VALUES ('100006', 'sn15636434945648', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.946940', '1.000000', '0.001000', '1.000000', '5.000000', '1', '10946.940000', '10807.230000', '1', '0.000000', '1', '0.000000', '10807.230000', '0.000000', '2', '1', '2019-07-21 01:24:54', '2019-07-21 09:18:09');
INSERT INTO `st_order` VALUES ('100007', 'sn15636456972101', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.928320', '1.000000', '0.001000', '1.000000', '5.000000', '2', '10928.320000', '10777.760000', '1', '0.000000', '1', '0.000000', '10777.760000', '0.000000', '2', '1', '2019-07-21 02:01:37', '2019-07-21 09:30:54');
INSERT INTO `st_order` VALUES ('100008', 'sn15636457006106', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.929650', '1.000000', '0.001000', '1.000000', '5.000000', '2', '10929.650000', '10782.260000', '1', '0.000000', '1', '0.000000', '10782.260000', '0.000000', '2', '1', '2019-07-21 02:01:40', '2019-07-21 09:34:20');
INSERT INTO `st_order` VALUES ('100009', 'sn15636731513272', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.790030', '1.000000', '0.001000', '1.000000', '5.000000', '2', '10790.030000', '9945.250000', '1', '0.000000', '1', '0.000000', '-0.844780', '0.000000', '2', '2', '2019-07-21 09:39:11', '2019-07-23 17:03:50');
INSERT INTO `st_order` VALUES ('100010', 'sn15636731537166', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.790250', '1.000000', '0.001000', '1.000000', '5.000000', '2', '10790.250000', '9987.380000', '1', '0.000000', '1', '0.000000', '0.802870', '0.000000', '2', '1', '2019-07-21 09:39:13', '2019-07-23 23:27:36');
INSERT INTO `st_order` VALUES ('100011', 'sn15636731552966', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.790250', '1.000000', '0.001000', '1.000000', '5.000000', '2', '10790.250000', '10035.780000', '1', '0.000000', '1', '0.000000', '-0.754470', '0.000000', '2', '1', '2019-07-21 09:39:15', '2019-07-23 16:25:21');
INSERT INTO `st_order` VALUES ('100012', 'sn15637372137198', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.467730', '1.000000', '0.001000', '1.000000', '5.000000', '1', '10467.730000', '10033.530000', '1', '0.000000', '1', '0.000000', '0.434200', '0.000000', '2', '1', '2019-07-22 03:26:53', '2019-07-23 16:24:58');
INSERT INTO `st_order` VALUES ('100013', 'sn15637372228698', '2', '34234', '5', 'dfgdghgh', '5', 'EOS', 'EOS', '4.246000', '1.000000', '1.000000', '1.000000', '1.000000', '2', '4.246000', '4.043000', '1', '0.000000', '1', '0.000000', '-0.203000', '0.000000', '2', '1', '2019-07-22 03:27:02', '2019-07-23 16:23:58');
INSERT INTO `st_order` VALUES ('100014', 'sn15637373102535', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.463390', '1.000000', '0.001000', '1.000000', '5.000000', '1', '10463.390000', '10051.820000', '2', '10472.140000', '1', '0.000000', '0.411570', '0.000000', '2', '2', '2019-07-22 03:28:30', '2019-07-23 16:10:02');
INSERT INTO `st_order` VALUES ('100015', 'sn15637373243459', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.464330', '1.000000', '0.001000', '1.000000', '5.000000', '1', '10464.330000', '10056.700000', '2', '10472.140000', '2', '10455.390000', '0.407630', '0.000000', '2', '2', '2019-07-22 03:28:44', '2019-07-23 16:08:20');
INSERT INTO `st_order` VALUES ('100016', 'sn15637375631991', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.402490', '1.000000', '0.001000', '1.000000', '5.000000', '1', '10402.490000', '10056.140000', '2', '10412.490000', '1', '0.000000', '0.346350', '0.000000', '2', '2', '2019-07-22 03:32:43', '2019-07-23 16:08:14');
INSERT INTO `st_order` VALUES ('100017', 'sn15637375738554', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.402170', '1.000000', '0.001000', '1.000000', '5.000000', '1', '10402.170000', '10410.600000', '2', '10412.490000', '1', '0.000000', '10410.600000', '0.000000', '2', '1', '2019-07-22 03:32:53', '2019-07-22 03:40:32');
INSERT INTO `st_order` VALUES ('100018', 'sn15637375774116', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.400390', '1.000000', '0.001000', '1.000000', '5.000000', '1', '10400.390000', '10046.650000', '2', '10411.490000', '1', '0.000000', '0.353740', '0.000000', '2', '1', '2019-07-22 03:32:57', '2019-07-23 16:07:29');
INSERT INTO `st_order` VALUES ('100019', 'sn15637376425826', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.401270', '1.000000', '0.001000', '1.000000', '5.000000', '1', '10401.270000', '10033.150000', '2', '10411.271000', '1', '0.000000', '0.368120', '0.000000', '2', '1', '2019-07-22 03:34:02', '2019-07-23 16:06:36');
INSERT INTO `st_order` VALUES ('100020', 'sn15637379814738', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '114.503510', '11.000000', '0.001000', '1.000000', '55.000000', '1', '10409.410000', '10033.260000', '1', '0.000000', '1', '0.000000', '4.137650', '0.000000', '2', '1', '2019-07-22 03:39:41', '2019-07-23 16:05:02');
INSERT INTO `st_order` VALUES ('100021', 'sn15637741642925', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.576400', '1.000000', '0.001000', '1.000000', '5.000000', '1', '10576.400000', '10040.140000', '1', '0.000000', '1', '0.000000', '0.536260', '0.000000', '2', '1', '2019-07-22 13:42:44', '2019-07-23 16:01:13');
INSERT INTO `st_order` VALUES ('100022', 'sn15637741873460', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.577480', '1.000000', '0.001000', '1.000000', '5.000000', '1', '10577.480000', '10015.610000', '1', '0.000000', '1', '0.000000', '0.561870', '0.000000', '2', '2', '2019-07-22 13:43:07', '2019-07-23 15:59:26');
INSERT INTO `st_order` VALUES ('100023', 'sn15637742339458', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.584730', '1.000000', '0.001000', '1.000000', '5.000000', '1', '10584.730000', '10016.480000', '1', '0.000000', '1', '0.000000', '0.568250', '0.000000', '2', '2', '2019-07-22 13:43:53', '2019-07-23 15:58:55');
INSERT INTO `st_order` VALUES ('100024', 'sn15637742554933', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.585770', '1.000000', '0.001000', '1.000000', '5.000000', '1', '10585.770000', '10018.860000', '1', '0.000000', '1', '0.000000', '0.566910', '0.000000', '2', '2', '2019-07-22 13:44:15', '2019-07-23 15:58:41');
INSERT INTO `st_order` VALUES ('100025', 'sn15637743572751', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.592630', '1.000000', '0.001000', '1.000000', '5.000000', '1', '10592.630000', '10038.810000', '1', '0.000000', '1', '0.000000', '0.553820', '0.000000', '2', '2', '2019-07-22 13:45:57', '2019-07-23 15:56:56');
INSERT INTO `st_order` VALUES ('100026', 'sn15637745485104', '2', '34234', '5', 'dfgdghgh', '5', 'EOS', 'EOS', '4.308000', '1.000000', '1.000000', '1.000000', '1.000000', '1', '4.308000', '4.031000', '1', '0.000000', '1', '0.000000', '0.277000', '0.000000', '2', '2', '2019-07-22 13:49:08', '2019-07-23 15:56:00');
INSERT INTO `st_order` VALUES ('100027', 'sn15637748355927', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '126.996000', '12.000000', '0.001000', '1.000000', '60.000000', '1', '10583.000000', '10043.860000', '1', '0.000000', '1', '0.000000', '6.469680', '0.000000', '2', '2', '2019-07-22 13:53:55', '2019-07-23 15:55:41');
INSERT INTO `st_order` VALUES ('100028', 'sn15637754089336', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.616870', '1.000000', '0.001000', '1.000000', '5.000000', '1', '10616.870000', '10039.260000', '1', '0.000000', '1', '0.000000', '0.577610', '0.000000', '2', '2', '2019-07-22 14:03:28', '2019-07-23 15:53:43');
INSERT INTO `st_order` VALUES ('100029', 'sn15637756315481', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.622610', '1.000000', '0.001000', '1.000000', '5.000000', '1', '10622.610000', '10038.760000', '1', '0.000000', '1', '0.000000', '0.583850', '0.000000', '2', '2', '2019-07-22 14:07:11', '2019-07-23 15:53:26');
INSERT INTO `st_order` VALUES ('100030', 'sn15637756715230', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.613360', '1.000000', '0.001000', '1.000000', '5.000000', '1', '10613.360000', '10481.510000', '1', '0.000000', '1', '0.000000', '10481.510000', '0.000000', '2', '1', '2019-07-22 14:07:51', '2019-07-22 19:18:08');
INSERT INTO `st_order` VALUES ('100031', 'sn15638629865629', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.106080', '1.000000', '0.001000', '1.000000', '5.000000', '1', '10106.080000', '10022.250000', '2', '10116.080000', '1', '0.000000', '0.083830', '0.000000', '2', '2', '2019-07-23 14:23:06', '2019-07-23 15:37:42');
INSERT INTO `st_order` VALUES ('100032', 'sn15638697365119', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.061820', '1.000000', '0.001000', '1.000000', '5.000000', '2', '10061.820000', '10038.200000', '1', '0.000000', '1', '0.000000', '-0.023620', '0.000000', '2', '1', '2019-07-23 16:15:36', '2019-07-23 16:24:29');
INSERT INTO `st_order` VALUES ('100033', 'sn15638707368754', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '9.993830', '1.000000', '0.001000', '1.000000', '5.000000', '2', '9993.830000', '9949.970000', '1', '0.000000', '1', '0.000000', '-0.043860', '0.000000', '2', '1', '2019-07-23 16:32:16', '2019-07-23 16:57:54');
INSERT INTO `st_order` VALUES ('100034', 'sn15638708334841', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '10.011610', '1.000000', '0.001000', '1.000000', '5.000000', '2', '10011.610000', '9929.300000', '1', '0.000000', '1', '0.000000', '-0.082310', '0.000000', '2', '1', '2019-07-23 16:33:53', '2019-07-23 16:57:20');
INSERT INTO `st_order` VALUES ('100035', 'sn15638709598713', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '9.965280', '1.000000', '0.001000', '1.000000', '5.000000', '2', '9965.280000', '9929.300000', '1', '0.000000', '1', '0.000000', '-0.035980', '0.000000', '2', '1', '2019-07-23 16:35:59', '2019-07-23 16:57:17');
INSERT INTO `st_order` VALUES ('100036', 'sn15638709919937', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '9.976390', '1.000000', '0.001000', '1.000000', '5.000000', '2', '9976.390000', '9925.780000', '1', '0.000000', '1', '0.000000', '-0.050610', '0.000000', '2', '1', '2019-07-23 16:36:31', '2019-07-23 16:57:13');
INSERT INTO `st_order` VALUES ('100037', 'sn15638711627993', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '9.984600', '1.000000', '0.001000', '1.000000', '5.000000', '1', '9984.600000', '9925.500000', '1', '0.000000', '1', '0.000000', '0.059100', '0.000000', '2', '1', '2019-07-23 16:39:22', '2019-07-23 16:56:43');
INSERT INTO `st_order` VALUES ('100038', 'sn15638713122264', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '9.958320', '1.000000', '0.001000', '1.000000', '5.000000', '1', '9958.320000', '9931.680000', '1', '0.000000', '1', '0.000000', '0.026640', '0.000000', '2', '1', '2019-07-23 16:41:52', '2019-07-23 16:55:55');
INSERT INTO `st_order` VALUES ('100039', 'sn15638713875359', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '9.962990', '1.000000', '0.001000', '1.000000', '5.000000', '1', '9962.990000', '9939.580000', '1', '0.000000', '1', '0.000000', '0.023410', '0.000000', '2', '1', '2019-07-23 16:43:07', '2019-07-23 16:55:41');
INSERT INTO `st_order` VALUES ('100040', 'sn15638714764132', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '9.971530', '1.000000', '0.001000', '1.000000', '5.000000', '1', '9971.530000', '9930.120000', '1', '0.000000', '1', '0.000000', '0.041410', '0.000000', '2', '1', '2019-07-23 16:44:36', '2019-07-23 16:54:49');
INSERT INTO `st_order` VALUES ('100041', 'sn15638715071053', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '9.970630', '1.000000', '0.001000', '1.000000', '5.000000', '1', '9970.630000', '9951.680000', '1', '0.000000', '1', '0.000000', '0.018950', '0.000000', '2', '1', '2019-07-23 16:45:07', '2019-07-23 16:53:27');
INSERT INTO `st_order` VALUES ('100042', 'sn15638721864580', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '9.923970', '1.000000', '0.001000', '1.000000', '5.000000', '1', '9923.970000', '9926.040000', '1', '0.000000', '1', '0.000000', '0.002070', '0.000000', '2', '1', '2019-07-23 16:56:26', '2019-07-23 16:56:38');
INSERT INTO `st_order` VALUES ('100043', 'sn15638723164672', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '9.947460', '1.000000', '0.001000', '1.000000', '5.000000', '1', '9947.460000', '9951.810000', '2', '9951.000000', '1', '0.000000', '0.004350', '0.000000', '2', '4', '2019-07-23 16:58:36', '2019-07-23 21:59:17');
INSERT INTO `st_order` VALUES ('100044', 'sn15638723198038', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '9.947460', '1.000000', '0.001000', '1.000000', '5.000000', '2', '9947.460000', '9947.000000', '1', '0.000000', '1', '0.000000', '-0.000460', '0.000000', '2', '1', '2019-07-23 16:58:39', '2019-07-23 16:58:50');
INSERT INTO `st_order` VALUES ('100045', 'sn15638725768790', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '9.954460', '1.000000', '0.001000', '1.000000', '5.000000', '1', '9954.460000', '9987.380000', '1', '0.000000', '1', '0.000000', '0.032920', '0.000000', '2', '1', '2019-07-23 17:02:56', '2019-07-23 23:27:33');
INSERT INTO `st_order` VALUES ('100046', 'sn15638956377211', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '9.988950', '1.000000', '0.001000', '1.000000', '5.000000', '1', '9988.950000', '0.000000', '1', '0.000000', '1', '0.000000', '0.000000', '0.000000', '1', '1', '2019-07-23 23:27:17', null);
INSERT INTO `st_order` VALUES ('100047', 'sn15638956635747', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '99.831400', '10.000000', '0.001000', '1.000000', '50.000000', '1', '9983.140000', '0.000000', '1', '0.000000', '1', '0.000000', '0.000000', '0.000000', '1', '1', '2019-07-23 23:27:43', null);
INSERT INTO `st_order` VALUES ('100048', 'sn15638956686806', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '99.800100', '10.000000', '0.001000', '1.000000', '50.000000', '2', '9980.010000', '0.000000', '1', '0.000000', '1', '0.000000', '0.000000', '19960.020000', '1', '1', '2019-07-23 23:27:48', null);
INSERT INTO `st_order` VALUES ('100049', 'sn15638956726325', '2', '34234', '5', 'dfgdghgh', '3', 'BTC', 'BTC', '99.800100', '10.000000', '0.001000', '1.000000', '50.000000', '2', '9980.010000', '0.000000', '1', '0.000000', '1', '0.000000', '0.000000', '19960.020000', '1', '1', '2019-07-23 23:27:52', null);

-- ----------------------------
-- Table structure for st_page_number
-- ----------------------------
DROP TABLE IF EXISTS `st_page_number`;
CREATE TABLE `st_page_number` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of st_page_number
-- ----------------------------
INSERT INTO `st_page_number` VALUES ('1', '20');
INSERT INTO `st_page_number` VALUES ('2', '50');
INSERT INTO `st_page_number` VALUES ('3', '100');
INSERT INTO `st_page_number` VALUES ('4', '500');
INSERT INTO `st_page_number` VALUES ('5', '1000');
INSERT INTO `st_page_number` VALUES ('6', '5000');

-- ----------------------------
-- Table structure for st_product
-- ----------------------------
DROP TABLE IF EXISTS `st_product`;
CREATE TABLE `st_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `desc_name` varchar(255) DEFAULT NULL,
  `abbreviation` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `contract` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '合约比例',
  `min_hand` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `max_hand` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `wave` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '止盈止损波动比例',
  `trade_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1可以交易2禁止交易',
  `show_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1启用2停用',
  `fee` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '手续费/1手',
  `night_fee` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '過夜費',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1正常2删除',
  `add_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='产品表';

-- ----------------------------
-- Records of st_product
-- ----------------------------
INSERT INTO `st_product` VALUES ('3', 'BTC', 'BTC/USTD', 'BTC', '/uploads/product/20190719\\ad194c7b4958445f898daef96bcfb9a7.png', '0.001000', '0.100000', '100.000000', '10.000000', '1', '1', '5.000000', '1.000000', '1', '2019-07-15 11:29:08', '2019-07-15 11:29:08');
INSERT INTO `st_product` VALUES ('4', 'ETH', 'ETH/USTD', 'ETH', '/uploads/product/20190719\\d78f57cf01f19ebc8fedf2d18e968110.png', '1.000000', '10.000000', '100.000000', '20.000000', '1', '1', '5.000000', '1.000000', '1', '2019-07-15 11:29:32', '2019-07-15 11:29:32');
INSERT INTO `st_product` VALUES ('5', 'EOS', 'EOS/USTD', 'EOS', '/uploads/product/20190719\\a853b5703e5becb59afca0fe246f7e70.png', '1.000000', '1.000000', '1.000000', '2.000000', '1', '1', '1.000000', '1.000000', '1', '2019-07-15 11:29:43', '2019-07-15 11:29:43');

-- ----------------------------
-- Table structure for st_real_auth
-- ----------------------------
DROP TABLE IF EXISTS `st_real_auth`;
CREATE TABLE `st_real_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `card` varchar(255) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '1未审核2已审核3已拒绝',
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='实名认证表';

-- ----------------------------
-- Records of st_real_auth
-- ----------------------------
INSERT INTO `st_real_auth` VALUES ('1', '2', '18237837598', '123', '410712312312312311', '2019-07-20 00:33:08', '2019-07-20 00:34:18', '3', '123');
INSERT INTO `st_real_auth` VALUES ('2', '2', '18237837598', '123', '410723232323232323', '2019-07-20 00:38:25', '2019-07-20 00:45:00', '2', '审核通过');

-- ----------------------------
-- Table structure for st_recharge
-- ----------------------------
DROP TABLE IF EXISTS `st_recharge`;
CREATE TABLE `st_recharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `agent_name` varchar(255) DEFAULT NULL,
  `order_sn` varchar(255) DEFAULT NULL,
  `money` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1微信支付2支付宝支付',
  `param` text,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1未支付2已支付',
  `add_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='充值表';

-- ----------------------------
-- Records of st_recharge
-- ----------------------------

-- ----------------------------
-- Table structure for st_user
-- ----------------------------
DROP TABLE IF EXISTS `st_user`;
CREATE TABLE `st_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '邀请人ID',
  `agent_id` int(11) NOT NULL DEFAULT '0',
  `agent_name` varchar(255) DEFAULT NULL,
  `agent_nickname` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `invite_number` varchar(255) DEFAULT NULL,
  `login_status` tinyint(1) NOT NULL DEFAULT '1',
  `invite_status` tinyint(1) NOT NULL DEFAULT '1',
  `trade_status` tinyint(1) NOT NULL DEFAULT '1',
  `lever` decimal(5,2) NOT NULL DEFAULT '1.00' COMMENT '杠杆比例/1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `real` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未实名，1已实名',
  `money` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `promise_money` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `last_login_time` datetime DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  `add_ip` varchar(255) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of st_user
-- ----------------------------
INSERT INTO `st_user` VALUES ('1', '13138602014', 'asdasd', 'e10adc3949ba59abbe56e057f20f883e', '123456', '0', '5', 'dfgdghgh', 'rerer', '/uploads/code/156342697637800.png', '1234', '1', '1', '1', '1.00', '1', '0', '19887.500000', '-100.000000', null, null, '127.0.0.1', '2019-07-06 23:23:50', '2019-07-06 23:23:50');
INSERT INTO `st_user` VALUES ('2', '18237837598', '34234', '4297f44b13955235245b2497399d7a93', '123123', '1', '5', 'dfgdghgh', 'rerer1', '/uploads/code/156342697440497.png', '2345', '1', '2', '1', '1.00', '1', '1', '868.750400', '314.420550', '2019-07-23 14:22:29', '127.0.0.1', '127.0.0.1', '2019-07-06 23:27:41', '2019-07-20 10:24:32');
INSERT INTO `st_user` VALUES ('3', '18237837599', '123', '4297f44b13955235245b2497399d7a93', '123123', '2', '6', '123456', '123123', '/uploads/code/156342688269339.png', '4561', '1', '1', '1', '1.00', '1', '0', '0.000000', '0.000000', null, null, '127.0.0.1', '2019-07-09 20:08:52', '2019-07-09 20:08:52');
INSERT INTO `st_user` VALUES ('4', '18237837512', '123', '4297f44b13955235245b2497399d7a93', '123123', '2', '6', '123456', '123123', null, '252664', '1', '1', '1', '1.00', '1', '0', '0.000000', '0.000000', null, null, '127.0.0.1', '2019-07-19 17:31:14', null);
INSERT INTO `st_user` VALUES ('5', '18237837513', '123', '4297f44b13955235245b2497399d7a93', '123123', '2', '6', '123456', '123123', '', '252664', '1', '1', '1', '1.00', '1', '0', '0.000000', '0.000000', '0000-00-00 00:00:00', '', '127.0.0.1', '2019-07-19 17:31:14', '0000-00-00 00:00:00');
INSERT INTO `st_user` VALUES ('6', '18237837511', '123', '4297f44b13955235245b2497399d7a93', '123123', '2', '6', '123456', '123123', '', '252664', '1', '1', '1', '1.00', '1', '0', '0.000000', '0.000000', '0000-00-00 00:00:00', '', '127.0.0.1', '2019-07-19 17:31:14', '0000-00-00 00:00:00');
INSERT INTO `st_user` VALUES ('7', '18237837511', '123', '4297f44b13955235245b2497399d7a93', '123123', '2', '6', '123456', '123123', '', '252664', '1', '1', '1', '1.00', '1', '0', '0.000000', '0.000000', '0000-00-00 00:00:00', '', '127.0.0.1', '2019-07-19 17:31:14', '0000-00-00 00:00:00');
INSERT INTO `st_user` VALUES ('8', '18237837511', '123', '4297f44b13955235245b2497399d7a93', '123123', '2', '6', '123456', '123123', '', '252664', '1', '1', '1', '1.00', '1', '0', '0.000000', '0.000000', '0000-00-00 00:00:00', '', '127.0.0.1', '2019-07-19 17:31:14', '0000-00-00 00:00:00');
INSERT INTO `st_user` VALUES ('9', '18237837511', '123', '4297f44b13955235245b2497399d7a93', '123123', '2', '6', '123456', '123123', '', '252664', '1', '1', '1', '1.00', '1', '0', '0.000000', '0.000000', '0000-00-00 00:00:00', '', '127.0.0.1', '2019-07-19 17:31:14', '0000-00-00 00:00:00');
INSERT INTO `st_user` VALUES ('10', '18237837511', '123', '4297f44b13955235245b2497399d7a93', '123123', '2', '6', '123456', '123123', '', '252664', '1', '1', '1', '1.00', '1', '0', '0.000000', '0.000000', '0000-00-00 00:00:00', '', '127.0.0.1', '2019-07-19 17:31:14', '0000-00-00 00:00:00');
INSERT INTO `st_user` VALUES ('11', '18237837511', '123', '4297f44b13955235245b2497399d7a93', '123123', '2', '6', '123456', '123123', '', '252664', '1', '1', '1', '1.00', '1', '0', '0.000000', '0.000000', '0000-00-00 00:00:00', '', '127.0.0.1', '2019-07-19 17:31:14', '0000-00-00 00:00:00');
INSERT INTO `st_user` VALUES ('12', '18237837511', '123', '4297f44b13955235245b2497399d7a93', '123123', '2', '6', '123456', '123123', '', '252664', '1', '1', '1', '1.00', '1', '0', '0.000000', '0.000000', '0000-00-00 00:00:00', '', '127.0.0.1', '2019-07-19 17:31:14', '0000-00-00 00:00:00');
INSERT INTO `st_user` VALUES ('13', '18237837511', '123', '4297f44b13955235245b2497399d7a93', '123123', '2', '6', '123456', '123123', '', '252664', '1', '1', '1', '1.00', '1', '0', '0.000000', '0.000000', '0000-00-00 00:00:00', '', '127.0.0.1', '2019-07-19 17:31:14', '0000-00-00 00:00:00');
INSERT INTO `st_user` VALUES ('14', '18237837511', '123', '4297f44b13955235245b2497399d7a93', '123123', '2', '6', '123456', '123123', '', '252664', '1', '1', '1', '1.00', '1', '0', '0.000000', '0.000000', '0000-00-00 00:00:00', '', '127.0.0.1', '2019-07-19 17:31:14', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for st_user_apply_coin
-- ----------------------------
DROP TABLE IF EXISTS `st_user_apply_coin`;
CREATE TABLE `st_user_apply_coin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `apply_coin_id` int(11) DEFAULT NULL,
  `apply_coin_name` varchar(255) DEFAULT NULL,
  `amount` decimal(20,6) NOT NULL DEFAULT '0.000000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户申购币表';

-- ----------------------------
-- Records of st_user_apply_coin
-- ----------------------------
INSERT INTO `st_user_apply_coin` VALUES ('1', '2', '18237837598', '2', '45', '15.000000');
INSERT INTO `st_user_apply_coin` VALUES ('2', '1', '13138602014', '2', '45', '0.100000');

-- ----------------------------
-- Table structure for st_user_money_log
-- ----------------------------
DROP TABLE IF EXISTS `st_user_money_log`;
CREATE TABLE `st_user_money_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `from_oid` int(11) DEFAULT NULL,
  `operation_id` int(11) DEFAULT NULL,
  `before_money` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `money` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `after_money` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `add_time` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1充值2提现3下注/结算4上/下分5申购币6其他',
  `type_info` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 COMMENT='用户资金记录';

-- ----------------------------
-- Records of st_user_money_log
-- ----------------------------
INSERT INTO `st_user_money_log` VALUES ('1', '2', '18237837598', null, '40', '40', '0.000000', '1.000000', '1.000000', '2019-07-07 10:41:45', '1', '上分', '平台操作会员18237837598上分');
INSERT INTO `st_user_money_log` VALUES ('2', '2', '18237837598', null, '41', '41', '1.000000', '-1.000000', '0.000000', '2019-07-07 10:41:49', '1', '下分', '平台操作会员18237837598下分');
INSERT INTO `st_user_money_log` VALUES ('3', '1', '13138602014', 'asdasd', '1', '63', '0.000000', '1.000000', '1.000000', '2019-07-09 00:28:47', '2', '用户提现', '用户提现失败');
INSERT INTO `st_user_money_log` VALUES ('4', '2', '18237837598', '34234', '144', '144', '0.000000', '1000.000000', '1000.000000', '2019-07-20 10:01:39', '3', '上分', '平台操作会员18237837598上分');
INSERT INTO `st_user_money_log` VALUES ('5', '2', '34234', '34234', '2', '145', '1000.000000', '1.000000', '999.000000', '2019-07-20 10:05:34', '2', '代理提现', '用户发起提现');
INSERT INTO `st_user_money_log` VALUES ('6', '2', '34234', '34234', '3', '146', '999.000000', '2.000000', '997.000000', '2019-07-20 10:05:40', '2', '代理提现', '用户发起提现');
INSERT INTO `st_user_money_log` VALUES ('7', '2', '18237837598', '34234', '1', '160', '997.000000', '9.000000', '988.000000', '2019-07-20 12:43:17', '5', '申购币', '申购币购买');
INSERT INTO `st_user_money_log` VALUES ('8', '2', '18237837598', '34234', '2', '161', '988.000000', '18.000000', '970.000000', '2019-07-20 12:48:49', '5', '申购币', '申购币购买');
INSERT INTO `st_user_money_log` VALUES ('9', '2', '18237837598', '34234', '3', '162', '970.000000', '90.000000', '880.000000', '2019-07-20 12:49:54', '5', '申购币', '申购币购买');
INSERT INTO `st_user_money_log` VALUES ('10', '2', '18237837598', '34234', '4', '163', '880.000000', '9.000000', '871.000000', '2019-07-20 12:53:40', '5', '申购币', '申购币购买');
INSERT INTO `st_user_money_log` VALUES ('11', '2', '34234', '34234', '100004', '166', '871.000000', '5.000000', '866.000000', '2019-07-21 00:46:11', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('12', '2', '34234', '34234', '100003', '167', '866.000000', '221.340000', '1087.340000', '2019-07-21 01:15:26', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('13', '2', '34234', '34234', '100004', '168', '1087.340000', '231.210000', '1318.550000', '2019-07-21 01:18:13', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('14', '2', '34234', '34234', '100005', '169', '1318.550000', '5.000000', '1313.550000', '2019-07-21 01:21:43', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('15', '2', '34234', '34234', '100006', '170', '1313.550000', '5.000000', '1308.550000', '2019-07-21 01:24:54', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('16', '2', '34234', '34234', '100007', '171', '1308.550000', '5.000000', '1303.550000', '2019-07-21 02:01:37', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('17', '2', '34234', '34234', '100008', '172', '1303.550000', '5.000000', '1298.550000', '2019-07-21 02:01:40', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('18', '2', '34234', '34234', '100005', '173', '1298.550000', '0.007390', '1298.557390', '2019-07-21 02:16:06', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('19', '2', '34234', '34234', '100006', '175', '1298.557390', '0.139710', '1298.697100', '2019-07-21 09:18:09', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('20', '2', '34234', '34234', '100007', '176', '1298.697100', '-0.150560', '1298.546540', '2019-07-21 09:30:54', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('21', '2', '34234', '34234', '100008', '177', '1298.546540', '-0.147390', '1298.399150', '2019-07-21 09:34:20', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('22', '2', '34234', '34234', '100009', '178', '1298.399150', '5.000000', '1293.399150', '2019-07-21 09:39:11', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('23', '2', '34234', '34234', '100010', '179', '1293.399150', '5.000000', '1288.399150', '2019-07-21 09:39:13', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('24', '2', '34234', '34234', '100011', '180', '1288.399150', '5.000000', '1283.399150', '2019-07-21 09:39:15', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('25', '2', '34234', '34234', '100012', '181', '1283.399150', '5.000000', '1278.399150', '2019-07-22 03:26:53', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('26', '2', '34234', '34234', '100013', '182', '1278.399150', '1.000000', '1277.399150', '2019-07-22 03:27:02', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('27', '2', '34234', '34234', '100014', '183', '1277.399150', '5.000000', '1272.399150', '2019-07-22 03:28:30', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('28', '2', '34234', '34234', '100015', '184', '1272.399150', '5.000000', '1267.399150', '2019-07-22 03:28:44', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('29', '2', '34234', '34234', '100016', '185', '1267.399150', '5.000000', '1262.399150', '2019-07-22 03:32:43', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('30', '2', '34234', '34234', '100017', '186', '1262.399150', '5.000000', '1257.399150', '2019-07-22 03:32:53', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('31', '2', '34234', '34234', '100018', '187', '1257.399150', '5.000000', '1252.399150', '2019-07-22 03:32:57', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('32', '2', '34234', '34234', '100019', '188', '1252.399150', '5.000000', '1247.399150', '2019-07-22 03:34:02', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('33', '2', '34234', '34234', '100020', '189', '1247.399150', '55.000000', '1192.399150', '2019-07-22 03:39:41', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('34', '2', '34234', '34234', '100017', '190', '1192.399150', '0.008430', '1192.407580', '2019-07-22 03:40:32', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('35', '2', '34234', '34234', '100021', '192', '1192.407580', '5.000000', '1187.407580', '2019-07-22 13:42:44', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('36', '2', '34234', '34234', '100022', '193', '1187.407580', '5.000000', '1182.407580', '2019-07-22 13:43:07', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('37', '2', '34234', '34234', '100023', '194', '1182.407580', '5.000000', '1177.407580', '2019-07-22 13:43:53', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('38', '2', '34234', '34234', '100024', '195', '1177.407580', '5.000000', '1172.407580', '2019-07-22 13:44:15', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('39', '2', '34234', '34234', '100025', '196', '1172.407580', '5.000000', '1167.407580', '2019-07-22 13:45:57', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('40', '2', '34234', '34234', '100026', '197', '1167.407580', '1.000000', '1166.407580', '2019-07-22 13:49:08', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('41', '2', '34234', '34234', '100027', '198', '1166.407580', '60.000000', '1106.407580', '2019-07-22 13:53:55', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('42', '2', '34234', '34234', '100028', '199', '1106.407580', '5.000000', '1101.407580', '2019-07-22 14:03:28', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('43', '2', '34234', '34234', '100029', '200', '1101.407580', '5.000000', '1096.407580', '2019-07-22 14:07:11', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('44', '2', '34234', '34234', '100030', '201', '1096.407580', '5.000000', '1091.407580', '2019-07-22 14:07:51', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('45', '2', '34234', '34234', '100030', '203', '1091.407580', '0.131850', '1091.539430', '2019-07-22 19:18:08', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('46', '2', '18237837598', '34234', '5', '204', '1091.539430', '9.000000', '1082.539430', '2019-07-22 23:30:36', '5', '申购币', '申购币购买');
INSERT INTO `st_user_money_log` VALUES ('47', '2', '34234', '34234', '100031', '208', '1082.539430', '5.000000', '1077.539430', '2019-07-23 14:23:06', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('48', '2', '18237837598', '34234', '100031', '209', '1077.539430', '0.083830', '1077.623260', '2019-07-23 15:37:42', '3', '平仓', '强行平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('49', '2', '18237837598', '34234', '100029', '210', '1077.623260', '0.583850', '1078.207110', '2019-07-23 15:53:26', '3', '平仓', '强行平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('50', '2', '18237837598', '34234', '100028', '211', '1078.207110', '0.577610', '1078.784720', '2019-07-23 15:53:43', '3', '平仓', '强行平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('51', '2', '18237837598', '34234', '100027', '212', '1078.784720', '6.469680', '1085.254400', '2019-07-23 15:55:41', '3', '平仓', '强行平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('52', '2', '18237837598', '34234', '100026', '213', '1085.254400', '0.277000', '1085.531400', '2019-07-23 15:56:00', '3', '平仓', '强行平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('53', '2', '18237837598', '34234', '100025', '214', '1085.531400', '0.553820', '1086.085220', '2019-07-23 15:56:56', '3', '平仓', '强行平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('54', '2', '18237837598', '34234', '100024', '215', '1086.085220', '0.566910', '1086.652130', '2019-07-23 15:58:41', '3', '平仓', '强行平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('55', '2', '18237837598', '34234', '100023', '216', '1086.652130', '0.568250', '1087.220380', '2019-07-23 15:58:55', '3', '平仓', '强行平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('56', '2', '18237837598', '34234', '100022', '217', '1087.220380', '0.561870', '1087.782250', '2019-07-23 15:59:26', '3', '平仓', '强行平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('57', '2', '34234', '34234', '100021', '218', '1087.782250', '0.536260', '1088.318510', '2019-07-23 16:01:13', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('58', '2', '34234', '34234', '100020', '219', '1088.318510', '4.137650', '1092.456160', '2019-07-23 16:05:02', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('59', '2', '34234', '34234', '100019', '220', '1092.456160', '0.368120', '1092.824280', '2019-07-23 16:06:36', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('60', '2', '34234', '34234', '100018', '221', '1092.824280', '0.353740', '1093.178020', '2019-07-23 16:07:29', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('61', '2', '18237837598', '34234', '100016', '222', '1093.178020', '0.346350', '1093.524370', '2019-07-23 16:08:14', '3', '平仓', '强行平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('62', '2', '18237837598', '34234', '100015', '223', '1093.524370', '0.407630', '1093.932000', '2019-07-23 16:08:20', '3', '平仓', '强行平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('63', '2', '18237837598', '34234', '100014', '224', '1093.932000', '0.411570', '1094.343570', '2019-07-23 16:10:02', '3', '平仓', '强行平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('64', '2', '34234', '34234', '100032', '225', '1094.343570', '5.000000', '1089.343570', '2019-07-23 16:15:36', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('65', '2', '34234', '34234', '100013', '226', '1089.343570', '-0.203000', '1089.140570', '2019-07-23 16:23:58', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('66', '2', '34234', '34234', '100032', '227', '1089.140570', '-0.023620', '1089.116950', '2019-07-23 16:24:29', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('67', '2', '34234', '34234', '100012', '228', '1089.116950', '0.434200', '1089.551150', '2019-07-23 16:24:58', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('68', '2', '34234', '34234', '100011', '229', '1089.551150', '-0.754470', '1088.796680', '2019-07-23 16:25:21', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('69', '2', '34234', '34234', '100033', '230', '1088.796680', '5.000000', '1083.796680', '2019-07-23 16:32:16', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('70', '2', '34234', '34234', '100034', '231', '1083.796680', '5.000000', '1078.796680', '2019-07-23 16:33:53', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('71', '2', '34234', '34234', '100035', '232', '1078.796680', '5.000000', '1073.796680', '2019-07-23 16:35:59', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('72', '2', '34234', '34234', '100036', '233', '1073.796680', '5.000000', '1068.796680', '2019-07-23 16:36:31', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('73', '2', '34234', '34234', '100037', '234', '1068.796680', '5.000000', '1063.796680', '2019-07-23 16:39:22', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('74', '2', '34234', '34234', '100038', '235', '1063.796680', '5.000000', '1058.796680', '2019-07-23 16:41:52', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('75', '2', '34234', '34234', '100039', '236', '1058.796680', '5.000000', '1053.796680', '2019-07-23 16:43:07', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('76', '2', '34234', '34234', '100040', '237', '1053.796680', '5.000000', '1048.796680', '2019-07-23 16:44:36', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('77', '2', '34234', '34234', '100041', '238', '1048.796680', '5.000000', '1043.796680', '2019-07-23 16:45:07', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('78', '2', '34234', '34234', '100041', '239', '1043.796680', '0.018950', '1043.815630', '2019-07-23 16:53:27', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('79', '2', '34234', '34234', '100040', '240', '1043.815630', '0.041410', '1043.857040', '2019-07-23 16:54:49', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('80', '2', '34234', '34234', '100039', '241', '1043.857040', '0.023410', '1043.880450', '2019-07-23 16:55:41', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('81', '2', '34234', '34234', '100038', '242', '1043.880450', '0.026640', '1043.907090', '2019-07-23 16:55:55', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('82', '2', '34234', '34234', '100042', '243', '1043.907090', '5.000000', '1038.907090', '2019-07-23 16:56:26', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('83', '2', '34234', '34234', '100042', '244', '1038.907090', '0.002070', '1038.909160', '2019-07-23 16:56:38', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('84', '2', '34234', '34234', '100037', '245', '1038.909160', '0.059100', '1038.968260', '2019-07-23 16:56:43', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('85', '2', '34234', '34234', '100036', '246', '1038.968260', '-0.050610', '1038.917650', '2019-07-23 16:57:13', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('86', '2', '34234', '34234', '100035', '247', '1038.917650', '-0.035980', '1038.881670', '2019-07-23 16:57:17', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('87', '2', '34234', '34234', '100034', '248', '1038.881670', '-0.082310', '1038.799360', '2019-07-23 16:57:20', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('88', '2', '34234', '34234', '100033', '249', '1038.799360', '-0.043860', '1038.755500', '2019-07-23 16:57:54', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('89', '2', '34234', '34234', '100043', '250', '1038.755500', '5.000000', '1033.755500', '2019-07-23 16:58:36', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('90', '2', '34234', '34234', '100044', '251', '1033.755500', '5.000000', '1028.755500', '2019-07-23 16:58:39', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('91', '2', '34234', '34234', '100044', '252', '1028.755500', '-0.000460', '1028.755040', '2019-07-23 16:58:50', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('92', '2', '34234', '34234', '100045', '253', '1028.755040', '5.000000', '1023.755040', '2019-07-23 17:02:56', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('93', '1', '13138602014', 'asdasd', '100001', '254', '1.000000', '19886.500000', '19887.500000', '2019-07-23 17:03:46', '3', '平仓', '强行平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('94', '2', '18237837598', '34234', '100009', '255', '1023.755040', '-0.844780', '1022.910260', '2019-07-23 17:03:50', '3', '平仓', '强行平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('95', '2', '18237837598', '34234', '100043', '0', '1022.910260', '0.004350', '1022.914610', '2019-07-23 21:59:17', '3', '平仓', '止盈平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('96', '2', '34234', '34234', '100046', '256', '1022.914610', '5.000000', '1017.914610', '2019-07-23 23:27:17', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('97', '2', '34234', '34234', '100045', '257', '1017.914610', '0.032920', '1017.947530', '2019-07-23 23:27:33', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('98', '2', '34234', '34234', '100010', '258', '1017.947530', '0.802870', '1018.750400', '2019-07-23 23:27:36', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('99', '2', '34234', '34234', '100047', '259', '1018.750400', '50.000000', '968.750400', '2019-07-23 23:27:43', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('100', '2', '34234', '34234', '100048', '260', '968.750400', '50.000000', '918.750400', '2019-07-23 23:27:48', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('101', '2', '34234', '34234', '100049', '261', '918.750400', '50.000000', '868.750400', '2019-07-23 23:27:52', '3', '建仓', '会员建仓，扣除手续费');

-- ----------------------------
-- Table structure for st_user_withdraw_log
-- ----------------------------
DROP TABLE IF EXISTS `st_user_withdraw_log`;
CREATE TABLE `st_user_withdraw_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `agent_name` varchar(255) DEFAULT NULL,
  `money` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `bank_info_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `bank_name` varchar(20) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `bank_card` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1待审核2已通过3已拒绝',
  `add_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `admin_remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户提现';

-- ----------------------------
-- Records of st_user_withdraw_log
-- ----------------------------
INSERT INTO `st_user_withdraw_log` VALUES ('1', '1', '13138602014', 'asdasd', '5', '123', '1.000000', '1', '123', '123', '123', '123', '123', '3', '2019-07-08 23:50:52', '2019-07-09 00:28:47', '1', null);
INSERT INTO `st_user_withdraw_log` VALUES ('2', '2', '34234', '34234', null, null, '1.000000', '3', '123', '34234', '建设银行', '1', '6217002362215120123', '1', '2019-07-20 10:05:34', null, null, null);
INSERT INTO `st_user_withdraw_log` VALUES ('3', '2', '34234', '34234', null, null, '2.000000', '3', '123', '34234', '建设银行', '1', '6217002362215120123', '1', '2019-07-20 10:05:40', null, null, null);
