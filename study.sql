/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : study

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-07-10 12:44:49
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
INSERT INTO `st_admin` VALUES ('1', 'admin1', 'admin', '4297f44b13955235245b2497399d7a93', '123123', '2019-07-08 12:54:14', '127.0.0.1', '2019-01-21 00:21:06');

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
INSERT INTO `st_agent` VALUES ('6', '123456', '123123', '0', '4297f44b13955235245b2497399d7a93', '123123', '121.000000', '', '4222', '1', '1', '1', '2019-07-09 20:41:13', '127.0.0.1', '2019-07-09 18:57:08', '127.0.0.1', '2019-07-09 18:57:08');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='代理资金记录';

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='代理提现表';

-- ----------------------------
-- Records of st_agent_withdraw_log
-- ----------------------------
INSERT INTO `st_agent_withdraw_log` VALUES ('1', '2', 'ertert', 'werwer11', '111.000000', '1', 'qwed', null, '1', '123', '123', '3', '2019-07-08 23:25:22', '2019-07-08 23:28:11', '1');
INSERT INTO `st_agent_withdraw_log` VALUES ('2', '6', '123456', '123123', '1.000000', '2', '网二', '13138602015', '招商银行', null, '4102512365112356', '3', '2019-07-09 22:17:25', '2019-07-09 22:26:15', '123');
INSERT INTO `st_agent_withdraw_log` VALUES ('3', '6', '123456', '123123', '2.000000', '2', '网二', '13138602015', '招商银行', '1313', '4102512365112356', '2', '2019-07-09 22:25:53', '2019-07-09 22:26:12', '审核通过');

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
INSERT INTO `st_apply_coin` VALUES ('1', '2311', '123', '/uploads/adv/20190708\\17631d6451e3b5c1da951c1302cce9b1.png', '234', '234.000000', '234.000000', '1.000000', '0.000000', '0.000000', '2019-07-08 11:49:36', '2019-07-08 12:38:31', '1', '1');
INSERT INTO `st_apply_coin` VALUES ('2', '45', '234', '/uploads/adv/20190708\\3b587709b8ed64e3e7fffeb809dee537.png', 'dt', '3.000000', '3.000000', '1.000000', '0.000000', '0.000000', '2019-07-08 18:54:27', '2019-07-08 18:54:27', '2', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='申购币赠送记录';

-- ----------------------------
-- Records of st_apply_coin_give_log
-- ----------------------------
INSERT INTO `st_apply_coin_give_log` VALUES ('1', null, null, null, null, null, '0.000000', '0', null, null, null);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='申购币获取记录';

-- ----------------------------
-- Records of st_apply_coin_order_log
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='银行信息表';

-- ----------------------------
-- Records of st_bank_info
-- ----------------------------
INSERT INTO `st_bank_info` VALUES ('1', '1', '1', '131', '张三丰', '13138602014', '123', '123', '123', '2019-07-09 13:21:17', '2019-07-09 14:03:03', '1');
INSERT INTO `st_bank_info` VALUES ('2', '6', '2', '123456', '网二', '13138602015', '招商银行', '1313', '4102512365112356', '2019-07-09 21:32:47', null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='系统设置表';

-- ----------------------------
-- Records of st_config
-- ----------------------------
INSERT INTO `st_config` VALUES ('1', '网站名称', 'title', '内部学习系统1', '2019-07-09 20:13:30');
INSERT INTO `st_config` VALUES ('2', '网站地址', 'address', 'www.baidu.com', '2019-07-09 20:13:30');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of st_kefu
-- ----------------------------
INSERT INTO `st_kefu` VALUES ('1', '电话客服', '123365555', '', '2019-07-05 21:57:01', '1', '2');

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
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `add_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='新闻表';

-- ----------------------------
-- Records of st_news
-- ----------------------------
INSERT INTO `st_news` VALUES ('1', '<i>serwer</i>', '234234', '<i>serwer</i>', '123', '1', '2019-07-05 21:55:05');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='公告表';

-- ----------------------------
-- Records of st_notice
-- ----------------------------
INSERT INTO `st_notice` VALUES ('1', '1', '435345', '345345', '2019-07-05 21:56:08', null, '123', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COMMENT='操作表';

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
  `money` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '保证金',
  `hand` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '手数',
  `contract` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '合约比例',
  `fee` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '手续费',
  `direction` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1买入（买涨）2卖出（买跌）',
  `buy_price` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '买入价',
  `sell_price` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '卖出价',
  `target_profit` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '止盈',
  `stop_loss` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '止损',
  `profit` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '盈利金额',
  `order_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1持仓2平仓',
  `order_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1用户平仓2总后台强平3爆仓',
  `add_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB AUTO_INCREMENT=100002 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of st_order
-- ----------------------------
INSERT INTO `st_order` VALUES ('100000', '123123', '1', '13138602014', '5', 'dfgdghgh', '1', '1', '100.000000', '1.000000', '2.000000', '1.000000', '1', '2.000000', '3.000000', '4.000000', '0.000000', '0.000000', '2', '1', '2019-07-08 13:42:23', '2019-07-08 13:42:28');
INSERT INTO `st_order` VALUES ('100001', '1231233', '1', '13138602014', '5', 'dfgdghgh', '1', '1', '100.000000', '1.000000', '2.000000', '1.000000', '1', '2.000000', '3.000000', '4.000000', '0.000000', '0.000000', '1', '1', '2019-07-08 13:42:23', '2019-07-08 13:42:28');

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
  `abbreviation` varchar(255) DEFAULT NULL,
  `contract` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '合约比例',
  `min_hand` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `max_hand` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `trade_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1可以交易2禁止交易',
  `show_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1启用2停用',
  `fee` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '手续费/1手',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1正常2删除',
  `add_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='产品表';

-- ----------------------------
-- Records of st_product
-- ----------------------------
INSERT INTO `st_product` VALUES ('1', '1', '1', '1.000000', '1.000000', '1.000000', '2', '2', '0.050000', '1', null, null);
INSERT INTO `st_product` VALUES ('2', '2', '1', '2.000000', '12.000000', '12.000000', '2', '2', '0.000000', '2', null, null);

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
  `pid` int(11) DEFAULT '0' COMMENT '邀请人ID',
  `agent_id` int(11) DEFAULT NULL,
  `agent_name` varchar(255) DEFAULT NULL,
  `agent_nickname` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `invite_number` varchar(255) DEFAULT NULL,
  `login_status` tinyint(1) NOT NULL DEFAULT '1',
  `invite_status` tinyint(1) NOT NULL DEFAULT '1',
  `trade_status` tinyint(1) NOT NULL DEFAULT '1',
  `lever` decimal(5,2) NOT NULL DEFAULT '100.00' COMMENT '杠杆比例/100',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `money` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `promise_money` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `last_login_time` datetime DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  `add_ip` varchar(255) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of st_user
-- ----------------------------
INSERT INTO `st_user` VALUES ('1', '13138602014', 'asdasd', 'e10adc3949ba59abbe56e057f20f883e', '123456', '0', '5', 'dfgdghgh', 'rerer', '', '1234', '1', '1', '1', '1.00', '1', '1.000000', '0.000000', null, null, '127.0.0.1', '2019-07-06 23:23:50', '2019-07-06 23:23:50');
INSERT INTO `st_user` VALUES ('2', '18237837598', '34234', 'e10adc3949ba59abbe56e057f20f883e', '123456', '1', '5', 'dfgdghgh', 'rerer1', '', '2345', '2', '2', '2', '99.99', '1', '0.000000', '0.000000', null, null, '127.0.0.1', '2019-07-06 23:27:41', '2019-07-07 10:24:20');
INSERT INTO `st_user` VALUES ('3', '18237837599', '123', '4297f44b13955235245b2497399d7a93', '123123', '0', '6', '123456', '123123', '', '4561', '1', '1', '1', '100.00', '1', '0.000000', '0.000000', null, null, '127.0.0.1', '2019-07-09 20:08:52', '2019-07-09 20:08:52');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户申购币表';

-- ----------------------------
-- Records of st_user_apply_coin
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户资金记录';

-- ----------------------------
-- Records of st_user_money_log
-- ----------------------------
INSERT INTO `st_user_money_log` VALUES ('1', '2', '18237837598', null, '40', '40', '0.000000', '1.000000', '1.000000', '2019-07-07 10:41:45', '1', '上分', '平台操作会员18237837598上分');
INSERT INTO `st_user_money_log` VALUES ('2', '2', '18237837598', null, '41', '41', '1.000000', '-1.000000', '0.000000', '2019-07-07 10:41:49', '1', '下分', '平台操作会员18237837598下分');
INSERT INTO `st_user_money_log` VALUES ('3', '1', '13138602014', 'asdasd', '1', '63', '0.000000', '1.000000', '1.000000', '2019-07-09 00:28:47', '2', '用户提现', '用户提现失败');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户提现';

-- ----------------------------
-- Records of st_user_withdraw_log
-- ----------------------------
INSERT INTO `st_user_withdraw_log` VALUES ('1', '1', '13138602014', 'asdasd', '5', '123', '1.000000', '1', '123', '123', '123', '123', '123', '3', '2019-07-08 23:50:52', '2019-07-09 00:28:47', '1', null);
