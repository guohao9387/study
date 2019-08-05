/*
Navicat MySQL Data Transfer

Source Server         : 47.90.122.200
Source Server Version : 50644
Source Host           : 47.90.122.200:3306
Source Database       : study

Target Server Type    : MYSQL
Target Server Version : 50644
File Encoding         : 65001

Date: 2019-08-03 17:04:24
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
INSERT INTO `st_admin` VALUES ('1', 'admin1', 'admin', 'ad47bff5c0c5dc2e3b4622388f86be40', 'jyl2019', '2019-08-02 17:21:52', '115.60.190.26', '2019-01-21 00:21:06');

-- ----------------------------
-- Table structure for st_adv
-- ----------------------------
DROP TABLE IF EXISTS `st_adv`;
CREATE TABLE `st_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '名称',
  `image` varchar(100) NOT NULL DEFAULT '' COMMENT '图片地址',
  `url` varchar(50) NOT NULL DEFAULT '' COMMENT '转跳链接',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1首页2申购币3app首页',
  `sort` smallint(5) NOT NULL DEFAULT '1' COMMENT '排序越大越靠前，最大99999',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1正常2禁用3删除',
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='广告表';

-- ----------------------------
-- Records of st_adv
-- ----------------------------
INSERT INTO `st_adv` VALUES ('1', '123', '/uploads/adv/20190720\\928378f286654e4752350ad02ec823fd.png', '', '1', '1', '3', '2019-07-20 10:51:58');
INSERT INTO `st_adv` VALUES ('2', '1', '/uploads/adv/20190724/274807a92184a9de7600ce571e5cb19f.png', '', '1', '10', '1', '2019-07-20 10:56:00');
INSERT INTO `st_adv` VALUES ('3', '2', '/uploads/adv/20190724/c6a1782e4d31a841e49d3a34eb9d938b.jpg', '', '1', '9', '1', '2019-07-20 10:56:13');
INSERT INTO `st_adv` VALUES ('4', '3', '/uploads/adv/20190724/5bf03d94a917c4a62fc11c97b2dd20bc.png', '', '1', '8', '1', '2019-07-20 10:56:24');
INSERT INTO `st_adv` VALUES ('5', '4', '/uploads/adv/20190720\\77087f60948f7f8295910af8f51a2e8e.png', '', '2', '10', '1', '2019-07-20 10:57:04');
INSERT INTO `st_adv` VALUES ('6', '5', '/uploads/adv/20190720\\73de558c8b008095167ad0a50d76ac75.png', '', '2', '9', '1', '2019-07-20 10:57:14');
INSERT INTO `st_adv` VALUES ('7', '6', '/uploads/adv/20190720\\ae613b9d5a68f39ec36287714ab447d5.png', '', '2', '8', '1', '2019-07-20 10:57:27');
INSERT INTO `st_adv` VALUES ('8', 'shou', '/uploads/adv/20190801/444523619433b14ee392fa37c3b545d1.jpeg', '', '3', '1', '1', '2019-08-01 14:39:46');
INSERT INTO `st_adv` VALUES ('9', 'shouj', '/uploads/adv/20190801/324addfa29d7730147c16512a34c56a8.jpg', '', '3', '1', '1', '2019-08-01 14:44:13');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='代理表';

-- ----------------------------
-- Records of st_agent
-- ----------------------------
INSERT INTO `st_agent` VALUES ('16', '123456', '直属会员', '0', '36e1a5072c78359066ed7715f5ff3da8', '159357', '0.000000', null, '8327', '1', '1', '1', '2019-08-01 14:21:56', '115.60.191.216', '2019-08-01 14:21:28', '115.60.191.216', '2019-08-01 14:21:28');
INSERT INTO `st_agent` VALUES ('17', '147258', '直属代理', '16', '36e1a5072c78359066ed7715f5ff3da8', '159357', '0.000000', null, '7520', '1', '1', '1', null, null, '2019-08-01 14:22:41', '115.60.191.216', '2019-08-01 14:22:41');
INSERT INTO `st_agent` VALUES ('18', '18937810752', '程宏国', '16', '21218cca77804d2ba1922c33e0151105', '888888', '0.000000', '/uploads/code/156464152154120.png', '1969', '1', '1', '1', '2019-08-01 17:43:59', '115.60.191.216', '2019-08-01 14:35:02', '115.60.191.216', '2019-08-01 14:35:02');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='代理资金记录';

-- ----------------------------
-- Records of st_agent_money_log
-- ----------------------------

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
  `real_money` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `rate` decimal(20,6) NOT NULL DEFAULT '0.000000',
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='银行信息表';

-- ----------------------------
-- Records of st_bank_info
-- ----------------------------
INSERT INTO `st_bank_info` VALUES ('7', '33', '1', '13663840507', '项国星', '13663840507', '招商银行', '上海支行', '4874151545980000', '2019-08-01 17:23:28', null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='系统设置表';

-- ----------------------------
-- Records of st_config
-- ----------------------------
INSERT INTO `st_config` VALUES ('1', '网站名称', 'title', '艾比特', '2019-08-01 14:55:09');
INSERT INTO `st_config` VALUES ('2', '网站地址', 'address', 'aioq.cn', '2019-08-01 14:55:09');
INSERT INTO `st_config` VALUES ('3', '默认注册代理账号', 'point_agent', '123456', '2019-08-01 14:55:09');
INSERT INTO `st_config` VALUES ('4', '邀请赠送申购币比例%', 'coin_give', '5', '2019-08-01 14:55:09');
INSERT INTO `st_config` VALUES ('5', '入金汇率', 'recharge_rate', '6.91', '2019-08-01 14:55:09');
INSERT INTO `st_config` VALUES ('6', '出金汇率', 'withdraw_rate', '6.82', '2019-08-01 14:55:09');
INSERT INTO `st_config` VALUES ('7', 'app下载地址', 'app_download', 'https://vtrep.cn/app.php/987', '2019-08-01 14:55:09');

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of st_kefu
-- ----------------------------
INSERT INTO `st_kefu` VALUES ('1', '电话客服', '123365555', '', '2019-07-05 21:57:01', '1', '2');
INSERT INTO `st_kefu` VALUES ('2', 'qq客服', '123123', '', '2019-07-19 22:02:37', '2', '1');
INSERT INTO `st_kefu` VALUES ('3', '微信客服', '123', '/uploads/kefu/20190719\\dd520c352e58bceadea5f17cd62cb0d6.png', '2019-07-19 22:02:49', '1', '1');
INSERT INTO `st_kefu` VALUES ('4', '手机版下载', '123', '/uploads/kefu/20190719\\bc870cb979c0cb2f0e91a75fdcd437f4.png', '2019-07-19 22:03:04', '1', '1');
INSERT INTO `st_kefu` VALUES ('5', 'QQ在线客服', '286643531', '', '2019-07-29 10:33:50', '1', '1');
INSERT INTO `st_kefu` VALUES ('6', 'ces', '12', '', '2019-07-29 10:52:53', '2', '13');

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='新闻表';

-- ----------------------------
-- Records of st_news
-- ----------------------------
INSERT INTO `st_news` VALUES ('4', '<p><img src=\"/uploads/notice/20190719/1ba69a98bd63d832e45bd70096458d27.png\" alt=\"undefined\"></p><p>', '注册指南', '<p><img src=\"/uploads/notice/20190719/1ba69a98bd63d832e45bd70096458d27.png\" alt=\"undefined\"></p><p>我是注册指南</p>', '10', '3', '1', '2019-07-19 22:15:32');
INSERT INTO `st_news` VALUES ('5', '我是交易指南', '交易指南', '我是交易指南', '9', '3', '1', '2019-07-19 22:15:49');
INSERT INTO `st_news` VALUES ('6', '123123', 'APP下载', '123123', '10', '4', '1', '2019-07-19 22:16:01');
INSERT INTO `st_news` VALUES ('7', '2008年爆发全球金融危机，当时有人用“中本聪”的化名发表了一篇论文，描述了比特币的模式。', '比特币发展历程', '<p>2008年爆发全球<a href=\"https://baike.so.com/doc/1644940-1738752.html\" target=\"_blank\">金融危机</a>，当时有人用“<a href=\"https://baike.so.com/doc/7358369-7624972.html\" target=\"_blank\">中本聪</a>”的化名发表了一篇论文，描述了比特币的模式。</p><p>和法定货币相比，比特币没有一个集中的发行方，而是由网络节点的计算生成，谁都有可能参与制造比特币，而且可以全世界流通，可以在任意一台接入互联网的电脑上买卖，不管身处何方，任何人都可以挖掘、购买、出售或收取比特币，并且在交易过程中外人无法辨认用户身份信息。2009年，不受央行和任何金融机构控制的比特币诞生。比特币是一种“<a href=\"https://baike.so.com/doc/5580339-5793249.html\" target=\"_blank\">电子货币</a>”，由计算机生成的一串串复杂代码组成，新比特币通过预设的程序制造，随着比特币总量的增加，<a class=\"show-img layoutright\" style=\"text-align: center;\" href=\"https://p1.ssl.qhmsg.com/t015546eae2040c5c0f.jpg\" data-index=\"2\" data-log=\"content-gallery\" data-type=\"gallery\"><span class=\"show-img-hd\"><img id=\"img_9124182\" src=\"https://p1.ssl.qhmsg.com/dr/220__/t015546eae2040c5c0f.jpg\" data-img=\"mod_img\"></span><span class=\"show-img-bd\" style=\"text-align: left;\"></span></a>新币制造的速度减慢，直到2014年达到2100万个的总量上限，被挖出的比特币总量已经超过1200万个。</p><p>每当比特币进入主流媒体的视野时，主流媒体总会请一些主流经济学家分析一下比特币。早先，这些分析总是集中在比特币是不是骗局。而现如今的分析总是集中在比特币能否成为未来的主流货币。而这其中争论的焦点又往往集中在比特币的通缩特性上。</p><p>不少比特币玩家是被比特币的不能随意增发所吸引的。和比特币玩家的态度截然相反，经济学家们对比特币2100万固定总量的态度两极分化。</p><p><a href=\"https://baike.so.com/doc/2607138-2752878.html\" target=\"_blank\">凯恩斯学派</a>的经济学家们认为政府应该积极调控货币总量，用<a href=\"https://baike.so.com/doc/772160-816985.html\" target=\"_blank\">货币政策</a>的松紧来为经济适时的加油或者刹车。因此，他们认为比特币固定总量货币牺牲了可调控性，而且更糟糕的是将不可避免地导致通货紧缩，进而伤害整体经济。奥地利学派经济学家们的观点却截然相反，他们认为政府对货币的干预越少越好，货币总量的固定导致的通缩并没什么大不了的，甚至是社会进步的标志。</p><p>比特币网络通过“挖矿”来生成新的比特币。所谓“挖矿”实质上是用计算机解决一项复杂的数学问题，来保证比特币网络分布式记账系统的一致性。比特币网络会自动调整数学问题的难度，让整个网络约每10分钟得到一个合格答案。随后比特币网络会新生成一定量的比特币作为赏金，奖励获得答案的人。</p><p><a class=\"show-img layoutright\" style=\"text-align: center;\" href=\"https://p1.ssl.qhmsg.com/t0189c5b170f97f2093.jpg\" data-index=\"3\" data-log=\"content-gallery\" data-type=\"gallery\"><span class=\"show-img-hd\"><img title=\"比特币\" id=\"img_7351480\" alt=\"比特币\" src=\"https://p1.ssl.qhmsg.com/dr/220__/t0189c5b170f97f2093.jpg\" data-img=\"mod_img\"></span><span class=\"show-img-bd\" style=\"text-align: left;\">比特币</span></a></p><p>2009年比特币诞生的时候，每笔赏金是50个比特币。诞生10分钟后，第一批50个比特币生成了，而此时的货币总量就是50。随后比特币就以约每10分钟50个的速度增长。当总量达到1050万时(2100万的50%)，赏金减半为25个。当总量达到1575万(新产出525万，即1050的50%)时，赏金再减半为12.5个。</p><p>首先，根据其设计原理，比特币的总量会持续增长，直至100多年后达到2100万的那一天。但比特币货币总量后期增长的速度会非常缓慢。事实上，87.5%的比特币都将在头12年内被“挖”出来。所以从货币总量上看，比特币并不会达到固定量，其货币总量实质上是会不断膨胀的，尽管速度越来越慢。因此看起来比特币似乎是通胀货币才对。</p><p>然而判断处于通货紧缩还是膨胀，并不依据货币总量是减少还是增多，而是看整体物价水平是下跌还是上涨。整体物价上升即为通货膨胀，反之则为通货紧缩。长期看来，比特币的发行机制决定了它的货币总量增长速度将远低于社会财富的增长速度。</p><p>凯恩斯学派的经济学家们认为，物价持续下跌会让人们倾向于推迟消费，因为同样一块钱明天就能买到更多的东西。消费意愿的降低又进一步导致了需求萎缩、商品滞销，使物价变得更低，步入“通缩螺旋”的恶性循环。同样，通缩货币哪怕不存入银行本身也能升值（购买力越来越强），人们的投资意愿也会升高，社会生产也会陷入低迷。因此比特币是一种具备通缩倾向的货币。比特币经济体中，以比特币定价的商品价格将会持续下跌。</p><p>比特币是一种网络虚拟货币，数量有限，但是可以用来套现：可以兑换成大多数国家的货币。你可以使用比特币购买一些虚拟的物品，比如网络游戏当中的衣服、帽子、装备等，只要有人接受，你也可以使用比特币购买现实生活当中的物品。</p>', '1', '1', '1', '2019-07-25 09:32:53');
INSERT INTO `st_news` VALUES ('11', '央行研究局局长王信在今天的数字金融学术研讨会上表示，要推动央行数字货币的研发。', '央行将研究发行法定数字货币', '<p>央行研究局局长王信在今天的数字金融学术研讨会上表示，要推动央行数字货币的研发。其实这个事情很早之前就提出来了，17年就有这方面传闻，当时还有人传言名字都取好了，叫熊猫币，后来这事就不了了之了。法定数字货币这个事情为什么拖了这么久，最主要的原因还是没想清楚为什么要做，怎么做，怎么监管，一旦发行法定数字货币，各行各业会受到什么样的影响？<br>一个国家的货币，涉及各行各业，所以要推动他的发展需要大量的模型测算，各行各业的影响以及对经济和生活带来什么样的改变。这次把这个事情再次提到台面上，最主要的原因是Libra的冲击。我们老百姓都能看明白Facebook发币是为了侵蚀各国央行，成为世界央行，大佬们更能够清晰的意识到问题的严重和紧迫。所以这次王信也提出：下个阶段值得深入研究的课题包括，未来是否会形成法定数字货币，少数数字稳定币并存的格局。个人认为，这件事情不可避免，趋势推动下，唯有尽快拥抱创新，革新自我，才能永远走在世界的前沿，这个时代已经无法让一个国家躺在自己的乌托邦里实现梦想了。国家如此，我们每个个体更应该如此，持续学习，紧跟时代，才是暴富的正确姿势。</p>', '2', '1', '1', '2019-07-26 16:30:54');
INSERT INTO `st_news` VALUES ('12', '法定数字货币将会提升人们对数字货币的认知，长期利好区块链鼻祖比特币，未来也将会有越来越多的人加入到炒币大军。', '央行如果发行法定数字货币，将长期利好比特币', '<p>法定数字货币将会提升人们对数字货币的认知，长期利好区块链鼻祖比特币，未来也将会有越来越多的人加入到炒币大军。昨天我们看到新浪的数字货币频道，似乎已经感觉到了什么，这些不可逆的未来，才是年轻人该去了解的。</p><p>对于银行来说，是近乎于毁灭性的打击，区块链技术革命最先革谁的命？革的是金融机构的命，以前金融机构靠着自己的牌坊，博取信任，利用招牌谋取暴利，老头老太太一听工商银行这四个字，他们卖的一切都可以投入全部养老金。而区块链刚好是一个不需要证明信任的技术，因此银行的暴利时代将会一去不复返。</p><p>监管层可以大批量减员了，比如说银监会这个机构，他们每天需要观察大量的数据，找出银行业可能出现的问题，而区块链技术全部数据都在链上可追溯，没有造假，没法篡改，人们维权只需要一个懂链上查询的人即可。</p><p>还有各行各业的影响，比如医疗行业，病历上链，更好的为各家医院提供案例，且无需泄露患者信息，又或是供应链，在供应链中的每个过程都可以被记录和溯源，保障每个环节的安全可靠。如此的案例太多太多，守旧的人会被这个时代淘汰，就像20年前做传统生意的人，现在如果还不会熟练的运用互联网做市场，基本进入垂死挣扎的状态了，垄断型或资源型企业除外。<br></p>', '1', '1', '1', '2019-07-26 16:34:12');
INSERT INTO `st_news` VALUES ('13', null, '公司简介', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; AI比特智能对冲(AICKEN)，是一家完全去中心化的交易智能系统。2016年3月在新西兰奥克兰注册，2018年3月取得了FSP交易中心牌照和钱包基金牌照(AICKEN)。AI比特智能成立之初就已经确定在智能化区块链上的研发主题，目前在丹麦和香港有分部，为客户和机构提供智能化对冲渠道，为更便捷的投资和财富增值提出新的思路和市场。AI比特严格遵循新西兰已经国际区块链公约和规章制度，寻求更高的科技为区块链发展新的智能体验。', '1', '2', '1', '2019-07-26 16:56:26');
INSERT INTO `st_news` VALUES ('14', null, '联系我们', '<p align=\"center\" style=\"text-align: center;\"><span>运营中心地址：<span>香港特别行政区九龙半岛九龙城区</span></span></p><p align=\"center\" style=\"text-align: center;\"><span><span>宏丰大厦(浙江街)17层</span></span></p><p align=\"center\" style=\"text-align: center;\"><span><span>香港预约电话：400-387-9666</span></span></p><p align=\"left\" style=\"text-align: center;\"><span><br></span></p>', '1', '2', '1', '2019-07-26 17:03:17');

-- ----------------------------
-- Table structure for st_night_fee
-- ----------------------------
DROP TABLE IF EXISTS `st_night_fee`;
CREATE TABLE `st_night_fee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) DEFAULT NULL,
  `fee` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `date` date DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8mb4 COMMENT='过夜费收取记录';

-- ----------------------------
-- Records of st_night_fee
-- ----------------------------
INSERT INTO `st_night_fee` VALUES ('128', '100222', '20.000000', '2019-08-02', '2019-08-02 00:01:01');
INSERT INTO `st_night_fee` VALUES ('129', '100224', '20.000000', '2019-08-02', '2019-08-02 00:01:01');
INSERT INTO `st_night_fee` VALUES ('130', '100225', '20.000000', '2019-08-02', '2019-08-02 00:01:01');
INSERT INTO `st_night_fee` VALUES ('131', '100232', '20.000000', '2019-08-02', '2019-08-02 00:01:01');
INSERT INTO `st_night_fee` VALUES ('132', '100233', '20.000000', '2019-08-02', '2019-08-02 00:01:01');
INSERT INTO `st_night_fee` VALUES ('133', '100234', '20.000000', '2019-08-02', '2019-08-02 00:01:01');
INSERT INTO `st_night_fee` VALUES ('134', '100235', '20.000000', '2019-08-02', '2019-08-02 00:01:01');
INSERT INTO `st_night_fee` VALUES ('135', '100236', '20.000000', '2019-08-02', '2019-08-02 00:01:01');
INSERT INTO `st_night_fee` VALUES ('136', '100237', '20.000000', '2019-08-02', '2019-08-02 00:01:01');
INSERT INTO `st_night_fee` VALUES ('137', '100238', '20.000000', '2019-08-02', '2019-08-02 00:01:01');
INSERT INTO `st_night_fee` VALUES ('138', '100239', '20.000000', '2019-08-02', '2019-08-02 00:01:01');
INSERT INTO `st_night_fee` VALUES ('139', '100240', '20.000000', '2019-08-02', '2019-08-02 00:01:01');
INSERT INTO `st_night_fee` VALUES ('140', '100241', '20.000000', '2019-08-02', '2019-08-02 00:01:01');
INSERT INTO `st_night_fee` VALUES ('141', '100242', '20.000000', '2019-08-02', '2019-08-02 00:01:01');
INSERT INTO `st_night_fee` VALUES ('142', '100245', '20.000000', '2019-08-02', '2019-08-02 00:01:01');
INSERT INTO `st_night_fee` VALUES ('143', '100246', '20.000000', '2019-08-02', '2019-08-02 00:01:01');
INSERT INTO `st_night_fee` VALUES ('144', '100222', '10.000000', '2019-08-03', '2019-08-03 00:01:01');
INSERT INTO `st_night_fee` VALUES ('145', '100224', '10.000000', '2019-08-03', '2019-08-03 00:01:01');
INSERT INTO `st_night_fee` VALUES ('146', '100225', '10.000000', '2019-08-03', '2019-08-03 00:01:02');
INSERT INTO `st_night_fee` VALUES ('147', '100232', '10.000000', '2019-08-03', '2019-08-03 00:01:02');
INSERT INTO `st_night_fee` VALUES ('148', '100234', '10.000000', '2019-08-03', '2019-08-03 00:01:02');
INSERT INTO `st_night_fee` VALUES ('149', '100236', '10.000000', '2019-08-03', '2019-08-03 00:01:02');
INSERT INTO `st_night_fee` VALUES ('150', '100245', '10.000000', '2019-08-03', '2019-08-03 00:01:02');
INSERT INTO `st_night_fee` VALUES ('151', '100246', '10.000000', '2019-08-03', '2019-08-03 00:01:02');
INSERT INTO `st_night_fee` VALUES ('152', '100249', '10.000000', '2019-08-03', '2019-08-03 00:01:02');
INSERT INTO `st_night_fee` VALUES ('153', '100251', '10.000000', '2019-08-03', '2019-08-03 00:01:02');
INSERT INTO `st_night_fee` VALUES ('154', '100252', '10.000000', '2019-08-03', '2019-08-03 00:01:02');
INSERT INTO `st_night_fee` VALUES ('155', '100268', '10.000000', '2019-08-03', '2019-08-03 00:01:02');
INSERT INTO `st_night_fee` VALUES ('156', '100269', '10.000000', '2019-08-03', '2019-08-03 00:01:02');
INSERT INTO `st_night_fee` VALUES ('157', '100272', '10.000000', '2019-08-03', '2019-08-03 00:01:02');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='公告表';

-- ----------------------------
-- Records of st_notice
-- ----------------------------
INSERT INTO `st_notice` VALUES ('1', '1', '艾比特智能', '欢迎使用艾比特智能，引领时代新财富！', '2019-07-05 21:56:08', null, '123', '1');
INSERT INTO `st_notice` VALUES ('2', '1', '风险提示！', '数字货币操作有风险，请注意风险！', '2019-07-19 21:33:01', null, '1', '3');
INSERT INTO `st_notice` VALUES ('3', '1', '7月26日维护公告！', '将于7月27日凌晨2-点-4点维护系统，优化操作流畅度问题。', '2019-07-26 16:37:49', null, '1', '1');

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
  `before` text NOT NULL COMMENT '操作前数据',
  `note` varchar(255) NOT NULL COMMENT '详细说明',
  `url` varchar(255) NOT NULL COMMENT '请求地址',
  `param` text NOT NULL COMMENT '请求参数',
  `add_ip` varchar(50) NOT NULL,
  `add_time` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1230 DEFAULT CHARSET=utf8 COMMENT='操作表';

-- ----------------------------
-- Records of st_operation_log
-- ----------------------------
INSERT INTO `st_operation_log` VALUES ('929', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:1:\"s\";s:19:\"//admin/Login/login\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:7:\"jyl2019\";}', '123.55.59.123', '2019-08-01 00:41:52');
INSERT INTO `st_operation_log` VALUES ('930', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:1:\"s\";s:19:\"//admin/Login/login\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:7:\"jyl2019\";}', '115.60.191.216', '2019-08-01 14:18:05');
INSERT INTO `st_operation_log` VALUES ('931', '3', '1', 'admin1', '2', '16', '', '添加代理', '/admin/User/agent_add', 'a:5:{s:1:\"s\";s:22:\"//admin/User/agent_add\";s:10:\"agent_name\";s:6:\"123456\";s:8:\"password\";s:6:\"159357\";s:8:\"nickname\";s:12:\"直属会员\";s:10:\"p_agent_id\";s:0:\"\";}', '115.60.191.216', '2019-08-01 14:21:28');
INSERT INTO `st_operation_log` VALUES ('932', '2', '16', '123456', '2', '0', '', '登录', '/agent/Login/login', 'a:4:{s:1:\"s\";s:19:\"//agent/Login/login\";s:10:\"agent_name\";s:6:\"123456\";s:8:\"password\";s:6:\"159357\";s:4:\"code\";s:4:\"6714\";}', '115.60.191.216', '2019-08-01 14:21:56');
INSERT INTO `st_operation_log` VALUES ('933', '3', '1', 'admin1', '2', '17', '', '添加代理', '/admin/User/agent_add', 'a:5:{s:1:\"s\";s:22:\"//admin/User/agent_add\";s:10:\"agent_name\";s:6:\"147258\";s:8:\"password\";s:6:\"159357\";s:8:\"nickname\";s:12:\"直属代理\";s:10:\"p_agent_id\";s:6:\"123456\";}', '115.60.191.216', '2019-08-01 14:22:41');
INSERT INTO `st_operation_log` VALUES ('934', '3', '1', 'admin1', '1', '31', '', '添加会员', '/admin/User/user_add', 'a:7:{s:1:\"s\";s:21:\"//admin/User/user_add\";s:8:\"username\";s:11:\"15136413457\";s:8:\"password\";s:6:\"999999\";s:8:\"nickname\";s:6:\"韩寒\";s:8:\"agent_id\";s:6:\"147258\";s:3:\"pid\";s:0:\"\";s:5:\"lever\";s:2:\"50\";}', '115.60.191.216', '2019-08-01 14:23:38');
INSERT INTO `st_operation_log` VALUES ('935', '3', '1', 'admin1', '1', '32', '', '添加会员', '/admin/User/user_add', 'a:7:{s:1:\"s\";s:21:\"//admin/User/user_add\";s:8:\"username\";s:11:\"13140033272\";s:8:\"password\";s:6:\"999999\";s:8:\"nickname\";s:6:\"叶问\";s:8:\"agent_id\";s:6:\"147258\";s:3:\"pid\";s:0:\"\";s:5:\"lever\";s:2:\"50\";}', '115.60.191.216', '2019-08-01 14:24:14');
INSERT INTO `st_operation_log` VALUES ('936', '3', '1', 'admin1', '1', '33', '', '添加会员', '/admin/User/user_add', 'a:7:{s:1:\"s\";s:21:\"//admin/User/user_add\";s:8:\"username\";s:11:\"13663840507\";s:8:\"password\";s:6:\"999999\";s:8:\"nickname\";s:9:\"项国星\";s:8:\"agent_id\";s:6:\"147258\";s:3:\"pid\";s:0:\"\";s:5:\"lever\";s:2:\"50\";}', '115.60.191.216', '2019-08-01 14:25:41');
INSERT INTO `st_operation_log` VALUES ('937', '3', '1', 'admin1', '1', '34', '', '添加会员', '/admin/User/user_add', 'a:7:{s:1:\"s\";s:21:\"//admin/User/user_add\";s:8:\"username\";s:11:\"13653847075\";s:8:\"password\";s:6:\"999999\";s:8:\"nickname\";s:6:\"马云\";s:8:\"agent_id\";s:6:\"147258\";s:3:\"pid\";s:0:\"\";s:5:\"lever\";s:2:\"50\";}', '115.60.191.216', '2019-08-01 14:26:08');
INSERT INTO `st_operation_log` VALUES ('938', '1', '33', '13663840507', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13663840507\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"7613\";}', '115.60.191.216', '2019-08-01 14:26:57');
INSERT INTO `st_operation_log` VALUES ('939', '3', '1', 'admin1', '1', '35', '', '添加会员', '/admin/User/user_add', 'a:7:{s:1:\"s\";s:21:\"//admin/User/user_add\";s:8:\"username\";s:11:\"13623857649\";s:8:\"password\";s:6:\"999999\";s:8:\"nickname\";s:6:\"杨科\";s:8:\"agent_id\";s:6:\"147258\";s:3:\"pid\";s:0:\"\";s:5:\"lever\";s:2:\"50\";}', '115.60.191.216', '2019-08-01 14:27:22');
INSERT INTO `st_operation_log` VALUES ('940', '3', '1', 'admin1', '1', '36', '', '添加会员', '/admin/User/user_add', 'a:7:{s:1:\"s\";s:21:\"//admin/User/user_add\";s:8:\"username\";s:11:\"15736735157\";s:8:\"password\";s:6:\"999999\";s:8:\"nickname\";s:9:\"罗海林\";s:8:\"agent_id\";s:6:\"147258\";s:3:\"pid\";s:0:\"\";s:5:\"lever\";s:2:\"50\";}', '115.60.191.216', '2019-08-01 14:27:57');
INSERT INTO `st_operation_log` VALUES ('941', '1', '35', '13623857649', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13623857649\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"8429\";}', '115.60.191.216', '2019-08-01 14:28:05');
INSERT INTO `st_operation_log` VALUES ('942', '3', '1', 'admin1', '1', '37', '', '添加会员', '/admin/User/user_add', 'a:7:{s:1:\"s\";s:21:\"//admin/User/user_add\";s:8:\"username\";s:11:\"13721424988\";s:8:\"password\";s:6:\"999999\";s:8:\"nickname\";s:6:\"邵枫\";s:8:\"agent_id\";s:6:\"147258\";s:3:\"pid\";s:0:\"\";s:5:\"lever\";s:2:\"50\";}', '115.60.191.216', '2019-08-01 14:28:24');
INSERT INTO `st_operation_log` VALUES ('943', '3', '1', 'admin1', '1', '38', '', '添加会员', '/admin/User/user_add', 'a:7:{s:1:\"s\";s:21:\"//admin/User/user_add\";s:8:\"username\";s:11:\"12345678910\";s:8:\"password\";s:6:\"999999\";s:8:\"nickname\";s:6:\"刘强\";s:8:\"agent_id\";s:6:\"147258\";s:3:\"pid\";s:0:\"\";s:5:\"lever\";s:2:\"50\";}', '115.60.191.216', '2019-08-01 14:28:48');
INSERT INTO `st_operation_log` VALUES ('944', '1', '33', '13663840507', '1', '18', '', '会员发起实名认证', '/index/User/real_auth', 'a:3:{s:1:\"s\";s:22:\"//index/User/real_auth\";s:4:\"name\";s:9:\"项国星\";s:4:\"card\";s:18:\"410423189804157458\";}', '115.60.191.216', '2019-08-01 14:29:08');
INSERT INTO `st_operation_log` VALUES ('945', '1', '32', '13140033272', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13140033272\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"0860\";}', '115.60.191.216', '2019-08-01 14:29:29');
INSERT INTO `st_operation_log` VALUES ('946', '1', '37', '13721424988', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13721424988\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"0409\";}', '115.60.191.216', '2019-08-01 14:29:30');
INSERT INTO `st_operation_log` VALUES ('947', '1', '32', '13140033272', '1', '19', '', '会员发起实名认证', '/index/User/real_auth', 'a:3:{s:1:\"s\";s:22:\"//index/User/real_auth\";s:4:\"name\";s:6:\"叶问\";s:4:\"card\";s:18:\"410425197606062255\";}', '115.60.191.216', '2019-08-01 14:29:57');
INSERT INTO `st_operation_log` VALUES ('948', '1', '32', '13140033272', '1', '0', '', '会员退出登陆', '/index/Login/logout', 'a:1:{s:1:\"s\";s:20:\"//index/Login/logout\";}', '115.60.191.216', '2019-08-01 14:30:01');
INSERT INTO `st_operation_log` VALUES ('949', '1', '37', '13721424988', '1', '20', '', '会员发起实名认证', '/index/User/real_auth', 'a:3:{s:1:\"s\";s:22:\"//index/User/real_auth\";s:4:\"name\";s:6:\"邵枫\";s:4:\"card\";s:18:\"412625199808218888\";}', '115.60.191.216', '2019-08-01 14:30:08');
INSERT INTO `st_operation_log` VALUES ('950', '1', '31', '15136413457', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"15136413457\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"0062\";}', '115.60.191.216', '2019-08-01 14:30:14');
INSERT INTO `st_operation_log` VALUES ('951', '1', '31', '15136413457', '1', '21', '', '会员发起实名认证', '/index/User/real_auth', 'a:3:{s:1:\"s\";s:22:\"//index/User/real_auth\";s:4:\"name\";s:6:\"韩寒\";s:4:\"card\";s:18:\"422455197507080910\";}', '115.60.191.216', '2019-08-01 14:30:37');
INSERT INTO `st_operation_log` VALUES ('952', '3', '1', 'admin1', '1', '31', '', '审核通过会员实名', '/admin/Api/user_real_handle', 'a:4:{s:1:\"s\";s:28:\"//admin/Api/user_real_handle\";s:2:\"id\";s:2:\"21\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '115.60.191.216', '2019-08-01 14:30:45');
INSERT INTO `st_operation_log` VALUES ('953', '3', '1', 'admin1', '1', '37', '', '审核通过会员实名', '/admin/Api/user_real_handle', 'a:4:{s:1:\"s\";s:28:\"//admin/Api/user_real_handle\";s:2:\"id\";s:2:\"20\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '115.60.191.216', '2019-08-01 14:30:49');
INSERT INTO `st_operation_log` VALUES ('954', '3', '1', 'admin1', '1', '32', '', '审核通过会员实名', '/admin/Api/user_real_handle', 'a:4:{s:1:\"s\";s:28:\"//admin/Api/user_real_handle\";s:2:\"id\";s:2:\"19\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '115.60.191.216', '2019-08-01 14:30:52');
INSERT INTO `st_operation_log` VALUES ('955', '3', '1', 'admin1', '1', '33', '', '审核通过会员实名', '/admin/Api/user_real_handle', 'a:4:{s:1:\"s\";s:28:\"//admin/Api/user_real_handle\";s:2:\"id\";s:2:\"18\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '115.60.191.216', '2019-08-01 14:30:56');
INSERT INTO `st_operation_log` VALUES ('956', '1', '35', '13623857649', '1', '22', '', '会员发起实名认证', '/index/User/real_auth', 'a:3:{s:1:\"s\";s:22:\"//index/User/real_auth\";s:4:\"name\";s:6:\"杨科\";s:4:\"card\";s:18:\"423654789512345678\";}', '115.60.191.216', '2019-08-01 14:30:56');
INSERT INTO `st_operation_log` VALUES ('957', '3', '1', 'admin1', '1', '35', '', '审核通过会员实名', '/admin/Api/user_real_handle', 'a:4:{s:1:\"s\";s:28:\"//admin/Api/user_real_handle\";s:2:\"id\";s:2:\"22\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '115.60.191.216', '2019-08-01 14:31:01');
INSERT INTO `st_operation_log` VALUES ('958', '1', '34', '13653847075', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13653847075\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"2059\";}', '115.60.191.216', '2019-08-01 14:32:09');
INSERT INTO `st_operation_log` VALUES ('959', '1', '34', '13653847075', '1', '23', '', '会员发起实名认证', '/index/User/real_auth', 'a:3:{s:1:\"s\";s:22:\"//index/User/real_auth\";s:4:\"name\";s:6:\"马云\";s:4:\"card\";s:18:\"410822199107212513\";}', '115.60.191.216', '2019-08-01 14:32:29');
INSERT INTO `st_operation_log` VALUES ('960', '1', '36', '15736735157', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"15736735157\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"4759\";}', '115.60.191.216', '2019-08-01 14:33:07');
INSERT INTO `st_operation_log` VALUES ('961', '3', '1', 'admin1', '1', '38', '{\"uid\":38,\"username\":\"12345678910\",\"nickname\":\"\\u5218\\u5f3a\",\"password\":\"52c69e3a57331081823331c4e69d3f2e\",\"pwd\":\"999999\",\"pid\":0,\"agent_id\":17,\"agent_name\":\"147258\",\"agent_nickname\":\"\\u76f4\\u5c5e\\u4ee3\\u7406\",\"code\":null,\"invite_number\":\"718636\",\"login_status\":1,\"invite_status\":1,\"trade_status\":1,\"lever\":\"50.00\",\"status\":1,\"real\":0,\"money\":\"0.000000\",\"promise_money\":\"0.000000\",\"last_login_time\":null,\"last_login_ip\":null,\"add_ip\":\"115.60.191.216\",\"add_time\":\"2019-08-01 14:28:48\",\"update_time\":\"2019-08-01 14:28:48\"}', '编辑会员,修改账号', '/admin/User/user_edit', 'a:14:{s:1:\"s\";s:22:\"//admin/User/user_edit\";s:3:\"uid\";s:2:\"38\";s:8:\"username\";s:11:\"15738070600\";s:8:\"password\";s:6:\"999999\";s:8:\"nickname\";s:6:\"刘强\";s:13:\"invite_number\";s:6:\"718636\";s:5:\"money\";s:4:\"0.00\";s:6:\"xm_fee\";s:4:\"0.00\";s:12:\"login_status\";s:1:\"1\";s:12:\"trade_status\";s:1:\"1\";s:13:\"invite_status\";s:1:\"1\";s:8:\"agent_id\";s:6:\"147258\";s:3:\"pid\";s:0:\"\";s:5:\"lever\";s:5:\"50.00\";}', '115.60.191.216', '2019-08-01 14:33:08');
INSERT INTO `st_operation_log` VALUES ('962', '3', '1', 'admin1', '1', '34', '', '审核通过会员实名', '/admin/Api/user_real_handle', 'a:4:{s:1:\"s\";s:28:\"//admin/Api/user_real_handle\";s:2:\"id\";s:2:\"23\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '115.60.191.216', '2019-08-01 14:33:18');
INSERT INTO `st_operation_log` VALUES ('963', '1', '36', '15736735157', '1', '24', '', '会员发起实名认证', '/index/User/real_auth', 'a:3:{s:1:\"s\";s:22:\"//index/User/real_auth\";s:4:\"name\";s:9:\"罗海林\";s:4:\"card\";s:15:\"453435435434354\";}', '115.60.191.216', '2019-08-01 14:33:26');
INSERT INTO `st_operation_log` VALUES ('964', '1', '38', '15738070600', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"15738070600\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"9394\";}', '115.60.191.216', '2019-08-01 14:33:47');
INSERT INTO `st_operation_log` VALUES ('965', '3', '1', 'admin1', '2', '18', '', '添加代理', '/admin/User/agent_add', 'a:5:{s:1:\"s\";s:22:\"//admin/User/agent_add\";s:10:\"agent_name\";s:11:\"18937810752\";s:8:\"password\";s:6:\"888888\";s:8:\"nickname\";s:9:\"程宏国\";s:10:\"p_agent_id\";s:6:\"123456\";}', '115.60.191.216', '2019-08-01 14:35:02');
INSERT INTO `st_operation_log` VALUES ('966', '3', '1', 'admin1', '1', '36', '', '审核通过会员实名', '/admin/Api/user_real_handle', 'a:4:{s:1:\"s\";s:28:\"//admin/Api/user_real_handle\";s:2:\"id\";s:2:\"24\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '115.60.191.216', '2019-08-01 14:35:42');
INSERT INTO `st_operation_log` VALUES ('967', '2', '18', '18937810752', '2', '0', '', '登录', '/agent/Login/login', 'a:4:{s:1:\"s\";s:19:\"//agent/Login/login\";s:10:\"agent_name\";s:11:\"18937810752\";s:8:\"password\";s:6:\"888888\";s:4:\"code\";s:4:\"3352\";}', '182.120.32.211', '2019-08-01 14:38:09');
INSERT INTO `st_operation_log` VALUES ('968', '1', '35', '13623857649', '1', '35', '{\"old_password\":\"999999\",\"password\":\"908911\",\"repass\":\"908911\"}', '修改密码', '/index/User/re_pwd', 'a:4:{s:1:\"s\";s:19:\"//index/User/re_pwd\";s:12:\"old_password\";s:6:\"999999\";s:8:\"password\";s:6:\"908911\";s:6:\"repass\";s:6:\"908911\";}', '115.60.191.216', '2019-08-01 14:38:16');
INSERT INTO `st_operation_log` VALUES ('969', '1', '35', '13623857649', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13623857649\";s:8:\"password\";s:6:\"908911\";}', '115.60.191.216', '2019-08-01 14:38:23');
INSERT INTO `st_operation_log` VALUES ('970', '1', '38', '15738070600', '1', '25', '', '会员发起实名认证', '/index/User/real_auth', 'a:3:{s:1:\"s\";s:22:\"//index/User/real_auth\";s:4:\"name\";s:6:\"刘强\";s:4:\"card\";s:18:\"432852459856254615\";}', '115.60.191.216', '2019-08-01 14:38:42');
INSERT INTO `st_operation_log` VALUES ('971', '2', '18', '18937810752', '2', '0', '', '登录', '/agent/Login/login', 'a:4:{s:1:\"s\";s:19:\"//agent/Login/login\";s:10:\"agent_name\";s:11:\"18937810752\";s:8:\"password\";s:6:\"888888\";s:4:\"code\";s:4:\"6770\";}', '115.60.191.216', '2019-08-01 14:39:32');
INSERT INTO `st_operation_log` VALUES ('972', '3', '1', 'admin1', '4', '0', '', '添加广告', '/admin/Admin/adv_add', 'a:7:{s:1:\"s\";s:21:\"//admin/Admin/adv_add\";s:4:\"name\";s:4:\"shou\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:59:\"/uploads/adv/20190801/444523619433b14ee392fa37c3b545d1.jpeg\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:4:\"sort\";s:0:\"\";}', '115.60.191.216', '2019-08-01 14:39:46');
INSERT INTO `st_operation_log` VALUES ('973', '1', '35', '13623857649', '1', '0', '', '会员退出登陆', '/index/Login/logout', 'a:1:{s:1:\"s\";s:20:\"//index/Login/logout\";}', '115.60.191.216', '2019-08-01 14:42:09');
INSERT INTO `st_operation_log` VALUES ('974', '1', '36', '15736735157', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"15736735157\";s:8:\"password\";s:6:\"999999\";}', '115.60.191.216', '2019-08-01 14:43:48');
INSERT INTO `st_operation_log` VALUES ('975', '3', '1', 'admin1', '4', '0', '', '添加广告', '/admin/Admin/adv_add', 'a:7:{s:1:\"s\";s:21:\"//admin/Admin/adv_add\";s:4:\"name\";s:5:\"shouj\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:58:\"/uploads/adv/20190801/324addfa29d7730147c16512a34c56a8.jpg\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:4:\"sort\";s:0:\"\";}', '115.60.191.216', '2019-08-01 14:44:13');
INSERT INTO `st_operation_log` VALUES ('976', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:5:{s:1:\"s\";s:25:\"//admin/Api/status_change\";s:2:\"id\";s:1:\"7\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:7:\"product\";s:5:\"field\";s:12:\"trade_status\";}', '115.60.191.216', '2019-08-01 14:44:56');
INSERT INTO `st_operation_log` VALUES ('977', '1', '37', '13721424988', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13721424988\";s:8:\"password\";s:6:\"999999\";}', '115.60.191.216', '2019-08-01 14:44:56');
INSERT INTO `st_operation_log` VALUES ('978', '3', '1', 'admin1', '4', '0', '', '修改状态', '/admin/Api/status_change', 'a:5:{s:1:\"s\";s:25:\"//admin/Api/status_change\";s:2:\"id\";s:1:\"6\";s:6:\"status\";s:1:\"1\";s:2:\"db\";s:7:\"product\";s:5:\"field\";s:12:\"trade_status\";}', '115.60.191.216', '2019-08-01 14:44:57');
INSERT INTO `st_operation_log` VALUES ('979', '3', '1', 'admin1', '1', '39', '', '添加会员', '/admin/User/user_add', 'a:7:{s:1:\"s\";s:21:\"//admin/User/user_add\";s:8:\"username\";s:11:\"19900000101\";s:8:\"password\";s:6:\"999999\";s:8:\"nickname\";s:6:\"张楠\";s:8:\"agent_id\";s:6:\"147258\";s:3:\"pid\";s:0:\"\";s:5:\"lever\";s:2:\"50\";}', '115.60.191.216', '2019-08-01 14:46:06');
INSERT INTO `st_operation_log` VALUES ('980', '3', '1', 'admin1', '1', '40', '', '添加会员', '/admin/User/user_add', 'a:7:{s:1:\"s\";s:21:\"//admin/User/user_add\";s:8:\"username\";s:11:\"19900000102\";s:8:\"password\";s:6:\"999999\";s:8:\"nickname\";s:6:\"张亮\";s:8:\"agent_id\";s:6:\"147258\";s:3:\"pid\";s:0:\"\";s:5:\"lever\";s:2:\"50\";}', '115.60.191.216', '2019-08-01 14:46:34');
INSERT INTO `st_operation_log` VALUES ('981', '3', '1', 'admin1', '1', '41', '', '添加会员', '/admin/User/user_add', 'a:7:{s:1:\"s\";s:21:\"//admin/User/user_add\";s:8:\"username\";s:11:\"19900000103\";s:8:\"password\";s:6:\"999999\";s:8:\"nickname\";s:9:\"程宏国\";s:8:\"agent_id\";s:6:\"147258\";s:3:\"pid\";s:0:\"\";s:5:\"lever\";s:2:\"50\";}', '115.60.191.216', '2019-08-01 14:47:02');
INSERT INTO `st_operation_log` VALUES ('982', '1', '32', '13140033272', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13140033272\";s:8:\"password\";s:6:\"999999\";}', '115.60.191.216', '2019-08-01 14:47:29');
INSERT INTO `st_operation_log` VALUES ('983', '1', '38', '15738070600', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"15738070600\";s:8:\"password\";s:6:\"999999\";}', '115.60.191.216', '2019-08-01 14:48:08');
INSERT INTO `st_operation_log` VALUES ('984', '1', '31', '15136413457', '1', '0', '', '会员退出登陆', '/index/Login/logout', 'a:1:{s:1:\"s\";s:20:\"//index/Login/logout\";}', '115.60.191.216', '2019-08-01 14:48:17');
INSERT INTO `st_operation_log` VALUES ('985', '1', '39', '19900000101', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"19900000101\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"4164\";}', '115.60.191.216', '2019-08-01 14:48:29');
INSERT INTO `st_operation_log` VALUES ('986', '1', '37', '13721424988', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13721424988\";s:8:\"password\";s:6:\"999999\";}', '115.60.191.216', '2019-08-01 14:48:44');
INSERT INTO `st_operation_log` VALUES ('987', '1', '39', '19900000101', '1', '26', '', '会员发起实名认证', '/index/User/real_auth', 'a:3:{s:1:\"s\";s:22:\"//index/User/real_auth\";s:4:\"name\";s:6:\"张楠\";s:4:\"card\";s:18:\"411522456715160203\";}', '115.60.191.216', '2019-08-01 14:48:52');
INSERT INTO `st_operation_log` VALUES ('988', '1', '39', '19900000101', '1', '0', '', '会员退出登陆', '/index/Login/logout', 'a:1:{s:1:\"s\";s:20:\"//index/Login/logout\";}', '115.60.191.216', '2019-08-01 14:49:01');
INSERT INTO `st_operation_log` VALUES ('989', '1', '40', '19900000102', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"19900000102\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"5866\";}', '115.60.191.216', '2019-08-01 14:49:14');
INSERT INTO `st_operation_log` VALUES ('990', '1', '40', '19900000102', '1', '27', '', '会员发起实名认证', '/index/User/real_auth', 'a:3:{s:1:\"s\";s:22:\"//index/User/real_auth\";s:4:\"name\";s:6:\"张亮\";s:4:\"card\";s:18:\"410456198946450201\";}', '115.60.191.216', '2019-08-01 14:49:31');
INSERT INTO `st_operation_log` VALUES ('991', '1', '40', '19900000102', '1', '0', '', '会员退出登陆', '/index/Login/logout', 'a:1:{s:1:\"s\";s:20:\"//index/Login/logout\";}', '115.60.191.216', '2019-08-01 14:49:35');
INSERT INTO `st_operation_log` VALUES ('992', '1', '41', '19900000103', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"19900000103\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"1471\";}', '115.60.191.216', '2019-08-01 14:49:59');
INSERT INTO `st_operation_log` VALUES ('993', '1', '41', '19900000103', '1', '28', '', '会员发起实名认证', '/index/User/real_auth', 'a:3:{s:1:\"s\";s:22:\"//index/User/real_auth\";s:4:\"name\";s:9:\"程宏国\";s:4:\"card\";s:18:\"456123198715021213\";}', '115.60.191.216', '2019-08-01 14:50:18');
INSERT INTO `st_operation_log` VALUES ('994', '3', '1', 'admin1', '1', '41', '', '审核通过会员实名', '/admin/Api/user_real_handle', 'a:4:{s:1:\"s\";s:28:\"//admin/Api/user_real_handle\";s:2:\"id\";s:2:\"28\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '115.60.191.216', '2019-08-01 14:50:26');
INSERT INTO `st_operation_log` VALUES ('995', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:1:\"s\";s:19:\"//admin/Login/login\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:7:\"jyl2019\";}', '123.55.59.123', '2019-08-01 14:50:28');
INSERT INTO `st_operation_log` VALUES ('996', '3', '1', 'admin1', '1', '40', '', '审核通过会员实名', '/admin/Api/user_real_handle', 'a:4:{s:1:\"s\";s:28:\"//admin/Api/user_real_handle\";s:2:\"id\";s:2:\"27\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '115.60.191.216', '2019-08-01 14:50:29');
INSERT INTO `st_operation_log` VALUES ('997', '3', '1', 'admin1', '1', '39', '', '审核通过会员实名', '/admin/Api/user_real_handle', 'a:4:{s:1:\"s\";s:28:\"//admin/Api/user_real_handle\";s:2:\"id\";s:2:\"26\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '115.60.191.216', '2019-08-01 14:50:33');
INSERT INTO `st_operation_log` VALUES ('998', '3', '1', 'admin1', '1', '38', '', '审核通过会员实名', '/admin/Api/user_real_handle', 'a:4:{s:1:\"s\";s:28:\"//admin/Api/user_real_handle\";s:2:\"id\";s:2:\"25\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '115.60.191.216', '2019-08-01 14:50:36');
INSERT INTO `st_operation_log` VALUES ('999', '1', '34', '13653847075', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13653847075\";s:8:\"password\";s:6:\"999999\";}', '115.60.191.216', '2019-08-01 14:51:10');
INSERT INTO `st_operation_log` VALUES ('1000', '3', '1', 'admin1', '1', '31', '', '上分', '/admin/Api/new_user_money_change', 'a:4:{s:1:\"s\";s:33:\"//admin/Api/new_user_money_change\";s:3:\"uid\";s:2:\"31\";s:5:\"money\";s:6:\"100000\";s:5:\"param\";s:2:\"up\";}', '115.60.191.216', '2019-08-01 14:51:21');
INSERT INTO `st_operation_log` VALUES ('1001', '3', '1', 'admin1', '1', '32', '', '上分', '/admin/Api/new_user_money_change', 'a:4:{s:1:\"s\";s:33:\"//admin/Api/new_user_money_change\";s:3:\"uid\";s:2:\"32\";s:5:\"money\";s:6:\"100000\";s:5:\"param\";s:2:\"up\";}', '115.60.191.216', '2019-08-01 14:51:28');
INSERT INTO `st_operation_log` VALUES ('1002', '3', '1', 'admin1', '1', '33', '', '上分', '/admin/Api/new_user_money_change', 'a:4:{s:1:\"s\";s:33:\"//admin/Api/new_user_money_change\";s:3:\"uid\";s:2:\"33\";s:5:\"money\";s:6:\"100000\";s:5:\"param\";s:2:\"up\";}', '115.60.191.216', '2019-08-01 14:51:37');
INSERT INTO `st_operation_log` VALUES ('1003', '1', '37', '13721424988', '1', '0', '', '会员退出登陆', '/mobile/Login/logout', 'a:1:{s:1:\"s\";s:21:\"//mobile/Login/logout\";}', '115.60.191.216', '2019-08-01 14:51:45');
INSERT INTO `st_operation_log` VALUES ('1004', '3', '1', 'admin1', '1', '34', '', '上分', '/admin/Api/new_user_money_change', 'a:4:{s:1:\"s\";s:33:\"//admin/Api/new_user_money_change\";s:3:\"uid\";s:2:\"34\";s:5:\"money\";s:6:\"100000\";s:5:\"param\";s:2:\"up\";}', '115.60.191.216', '2019-08-01 14:51:46');
INSERT INTO `st_operation_log` VALUES ('1005', '3', '1', 'admin1', '1', '35', '', '上分', '/admin/Api/new_user_money_change', 'a:4:{s:1:\"s\";s:33:\"//admin/Api/new_user_money_change\";s:3:\"uid\";s:2:\"35\";s:5:\"money\";s:6:\"100000\";s:5:\"param\";s:2:\"up\";}', '115.60.191.216', '2019-08-01 14:51:57');
INSERT INTO `st_operation_log` VALUES ('1006', '3', '1', 'admin1', '1', '36', '', '上分', '/admin/Api/new_user_money_change', 'a:4:{s:1:\"s\";s:33:\"//admin/Api/new_user_money_change\";s:3:\"uid\";s:2:\"36\";s:5:\"money\";s:6:\"100000\";s:5:\"param\";s:2:\"up\";}', '115.60.191.216', '2019-08-01 14:52:07');
INSERT INTO `st_operation_log` VALUES ('1007', '3', '1', 'admin1', '1', '37', '', '上分', '/admin/Api/new_user_money_change', 'a:4:{s:1:\"s\";s:33:\"//admin/Api/new_user_money_change\";s:3:\"uid\";s:2:\"37\";s:5:\"money\";s:6:\"100000\";s:5:\"param\";s:2:\"up\";}', '115.60.191.216', '2019-08-01 14:52:15');
INSERT INTO `st_operation_log` VALUES ('1008', '3', '1', 'admin1', '1', '38', '', '上分', '/admin/Api/new_user_money_change', 'a:4:{s:1:\"s\";s:33:\"//admin/Api/new_user_money_change\";s:3:\"uid\";s:2:\"38\";s:5:\"money\";s:6:\"100000\";s:5:\"param\";s:2:\"up\";}', '115.60.191.216', '2019-08-01 14:52:21');
INSERT INTO `st_operation_log` VALUES ('1009', '3', '1', 'admin1', '1', '39', '', '上分', '/admin/Api/new_user_money_change', 'a:4:{s:1:\"s\";s:33:\"//admin/Api/new_user_money_change\";s:3:\"uid\";s:2:\"39\";s:5:\"money\";s:5:\"50000\";s:5:\"param\";s:2:\"up\";}', '115.60.191.216', '2019-08-01 14:52:29');
INSERT INTO `st_operation_log` VALUES ('1010', '3', '1', 'admin1', '1', '40', '', '上分', '/admin/Api/new_user_money_change', 'a:4:{s:1:\"s\";s:33:\"//admin/Api/new_user_money_change\";s:3:\"uid\";s:2:\"40\";s:5:\"money\";s:5:\"50000\";s:5:\"param\";s:2:\"up\";}', '115.60.191.216', '2019-08-01 14:52:35');
INSERT INTO `st_operation_log` VALUES ('1011', '1', '35', '13623857649', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13623857649\";s:8:\"password\";s:6:\"908911\";s:5:\"vcode\";s:4:\"7808\";}', '115.60.191.216', '2019-08-01 14:52:39');
INSERT INTO `st_operation_log` VALUES ('1012', '1', '41', '19900000103', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"19900000103\";s:8:\"password\";s:6:\"999999\";}', '182.120.32.211', '2019-08-01 14:52:39');
INSERT INTO `st_operation_log` VALUES ('1013', '3', '1', 'admin1', '1', '41', '', '上分', '/admin/Api/new_user_money_change', 'a:4:{s:1:\"s\";s:33:\"//admin/Api/new_user_money_change\";s:3:\"uid\";s:2:\"41\";s:5:\"money\";s:5:\"50000\";s:5:\"param\";s:2:\"up\";}', '115.60.191.216', '2019-08-01 14:52:41');
INSERT INTO `st_operation_log` VALUES ('1014', '1', '34', '13653847075', '1', '100215', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"5\";s:13:\"target_profit\";s:7:\"9861.95\";s:9:\"stop_loss\";s:7:\"9961.95\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"2\";}', '115.60.191.216', '2019-08-01 14:53:13');
INSERT INTO `st_operation_log` VALUES ('1015', '1', '34', '13653847075', '1', '100216', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"5\";s:13:\"target_profit\";s:5:\"162.5\";s:9:\"stop_loss\";s:5:\"262.5\";s:2:\"id\";s:1:\"4\";s:9:\"direction\";s:1:\"2\";}', '115.60.191.216', '2019-08-01 14:53:18');
INSERT INTO `st_operation_log` VALUES ('1016', '1', '34', '13653847075', '1', '100217', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"5\";s:13:\"target_profit\";s:8:\"-45.7496\";s:9:\"stop_loss\";s:7:\"54.2504\";s:2:\"id\";s:1:\"5\";s:9:\"direction\";s:1:\"2\";}', '115.60.191.216', '2019-08-01 14:53:23');
INSERT INTO `st_operation_log` VALUES ('1017', '1', '34', '13653847075', '1', '100218', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"5\";s:13:\"target_profit\";s:5:\"46.09\";s:9:\"stop_loss\";s:6:\"146.09\";s:2:\"id\";s:1:\"6\";s:9:\"direction\";s:1:\"2\";}', '115.60.191.216', '2019-08-01 14:53:30');
INSERT INTO `st_operation_log` VALUES ('1018', '1', '34', '13653847075', '1', '100219', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"5\";s:13:\"target_profit\";s:8:\"-44.1221\";s:9:\"stop_loss\";s:7:\"55.8779\";s:2:\"id\";s:1:\"7\";s:9:\"direction\";s:1:\"2\";}', '115.60.191.216', '2019-08-01 14:53:36');
INSERT INTO `st_operation_log` VALUES ('1019', '1', '37', '13721424988', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13721424988\";s:8:\"password\";s:6:\"999999\";}', '115.60.191.216', '2019-08-01 14:54:09');
INSERT INTO `st_operation_log` VALUES ('1020', '1', '37', '13721424988', '1', '100220', '', '会员建仓', '/mobile/Trade/create_order', 'a:4:{s:1:\"s\";s:27:\"//mobile/Trade/create_order\";s:4:\"hand\";s:2:\"20\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 14:55:42');
INSERT INTO `st_operation_log` VALUES ('1021', '1', '37', '13721424988', '1', '100220', '', '会员平仓', '/mobile/Trade/close_order', 'a:2:{s:1:\"s\";s:26:\"//mobile/Trade/close_order\";s:3:\"oid\";s:6:\"100220\";}', '115.60.191.216', '2019-08-01 14:56:03');
INSERT INTO `st_operation_log` VALUES ('1022', '1', '32', '13140033272', '1', '100221', '', '会员建仓', '/mobile/Trade/create_order', 'a:4:{s:1:\"s\";s:27:\"//mobile/Trade/create_order\";s:4:\"hand\";s:2:\"10\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 14:56:15');
INSERT INTO `st_operation_log` VALUES ('1023', '1', '35', '13623857649', '1', '100222', '', '会员建仓', '/mobile/Trade/create_order', 'a:4:{s:1:\"s\";s:27:\"//mobile/Trade/create_order\";s:4:\"hand\";s:2:\"10\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 14:56:59');
INSERT INTO `st_operation_log` VALUES ('1024', '1', '37', '13721424988', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13721424988\";s:8:\"password\";s:6:\"999999\";}', '115.60.191.216', '2019-08-01 14:57:19');
INSERT INTO `st_operation_log` VALUES ('1025', '1', '35', '13623857649', '1', '100223', '', '会员建仓', '/mobile/Trade/create_order', 'a:4:{s:1:\"s\";s:27:\"//mobile/Trade/create_order\";s:4:\"hand\";s:1:\"5\";s:2:\"id\";s:1:\"4\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 14:57:20');
INSERT INTO `st_operation_log` VALUES ('1026', '1', '32', '13140033272', '1', '100221', '', '会员平仓', '/mobile/Trade/close_order', 'a:2:{s:1:\"s\";s:26:\"//mobile/Trade/close_order\";s:3:\"oid\";s:6:\"100221\";}', '115.60.191.216', '2019-08-01 14:57:39');
INSERT INTO `st_operation_log` VALUES ('1027', '1', '35', '13623857649', '1', '100224', '', '会员建仓', '/mobile/Trade/create_order', 'a:4:{s:1:\"s\";s:27:\"//mobile/Trade/create_order\";s:4:\"hand\";s:1:\"6\";s:2:\"id\";s:1:\"6\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 14:57:41');
INSERT INTO `st_operation_log` VALUES ('1028', '1', '32', '13140033272', '1', '100225', '', '会员建仓', '/mobile/Trade/create_order', 'a:4:{s:1:\"s\";s:27:\"//mobile/Trade/create_order\";s:4:\"hand\";s:2:\"50\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 14:57:49');
INSERT INTO `st_operation_log` VALUES ('1029', '1', '35', '13623857649', '1', '100223', '', '会员平仓', '/mobile/Trade/close_order', 'a:2:{s:1:\"s\";s:26:\"//mobile/Trade/close_order\";s:3:\"oid\";s:6:\"100223\";}', '115.60.191.216', '2019-08-01 14:57:49');
INSERT INTO `st_operation_log` VALUES ('1030', '1', '36', '15736735157', '1', '100226', '', '会员建仓', '/mobile/Trade/create_order', 'a:4:{s:1:\"s\";s:27:\"//mobile/Trade/create_order\";s:4:\"hand\";s:2:\"10\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 14:57:50');
INSERT INTO `st_operation_log` VALUES ('1031', '1', '36', '15736735157', '1', '100226', '', '会员平仓', '/mobile/Trade/close_order', 'a:2:{s:1:\"s\";s:26:\"//mobile/Trade/close_order\";s:3:\"oid\";s:6:\"100226\";}', '115.60.191.216', '2019-08-01 14:58:21');
INSERT INTO `st_operation_log` VALUES ('1032', '1', '34', '13653847075', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13653847075\";s:8:\"password\";s:6:\"999999\";}', '115.60.191.216', '2019-08-01 15:01:07');
INSERT INTO `st_operation_log` VALUES ('1033', '1', '41', '19900000103', '1', '0', '', '会员退出登陆', '/index/Login/logout', 'a:1:{s:1:\"s\";s:20:\"//index/Login/logout\";}', '115.60.191.216', '2019-08-01 15:01:28');
INSERT INTO `st_operation_log` VALUES ('1034', '1', '35', '13623857649', '1', '0', '', '会员退出登陆', '/index/Login/logout', 'a:1:{s:1:\"s\";s:20:\"//index/Login/logout\";}', '115.60.191.216', '2019-08-01 15:02:55');
INSERT INTO `st_operation_log` VALUES ('1035', '1', '35', '13623857649', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13623857649\";s:8:\"password\";s:6:\"908911\";s:5:\"vcode\";s:4:\"9953\";}', '115.60.191.216', '2019-08-01 15:06:10');
INSERT INTO `st_operation_log` VALUES ('1036', '1', '33', '13663840507', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13663840507\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"8056\";}', '115.60.191.216', '2019-08-01 15:10:42');
INSERT INTO `st_operation_log` VALUES ('1037', '1', '33', '13663840507', '1', '100227', '', '会员建仓', '/index/Trade/create_order', 'a:8:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:2:\"10\";s:19:\"target_profit_check\";s:1:\"1\";s:13:\"target_profit\";s:7:\"10023.5\";s:15:\"stop_loss_check\";s:1:\"1\";s:9:\"stop_loss\";s:6:\"9923.5\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 15:11:45');
INSERT INTO `st_operation_log` VALUES ('1038', '1', '33', '13663840507', '1', '100228', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:2:\"10\";s:13:\"target_profit\";s:6:\"263.47\";s:9:\"stop_loss\";s:6:\"163.47\";s:2:\"id\";s:1:\"4\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 15:14:47');
INSERT INTO `st_operation_log` VALUES ('1039', '1', '33', '13663840507', '1', '100229', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:3:\"100\";s:13:\"target_profit\";s:7:\"54.2747\";s:9:\"stop_loss\";s:8:\"-45.7253\";s:2:\"id\";s:1:\"5\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 15:14:54');
INSERT INTO `st_operation_log` VALUES ('1040', '1', '36', '15736735157', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"15736735157\";s:8:\"password\";s:6:\"999999\";}', '115.60.191.216', '2019-08-01 15:15:13');
INSERT INTO `st_operation_log` VALUES ('1041', '1', '33', '13663840507', '1', '100230', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:2:\"50\";s:13:\"target_profit\";s:6:\"146.64\";s:9:\"stop_loss\";s:5:\"46.64\";s:2:\"id\";s:1:\"6\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 15:15:25');
INSERT INTO `st_operation_log` VALUES ('1042', '1', '34', '13653847075', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13653847075\";s:8:\"password\";s:6:\"999999\";}', '115.60.191.216', '2019-08-01 15:15:36');
INSERT INTO `st_operation_log` VALUES ('1043', '1', '33', '13663840507', '1', '100231', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:2:\"50\";s:13:\"target_profit\";s:7:\"55.9055\";s:9:\"stop_loss\";s:8:\"-44.0945\";s:2:\"id\";s:1:\"7\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 15:15:38');
INSERT INTO `st_operation_log` VALUES ('1044', '1', '33', '13663840507', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13663840507\";s:8:\"password\";s:6:\"999999\";}', '115.60.191.216', '2019-08-01 15:17:30');
INSERT INTO `st_operation_log` VALUES ('1045', '1', '34', '13653847075', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13653847075\";s:8:\"password\";s:6:\"999999\";}', '115.60.191.216', '2019-08-01 15:20:00');
INSERT INTO `st_operation_log` VALUES ('1046', '1', '34', '13653847075', '1', '100219', '', '会员平仓', '/mobile/Trade/close_order', 'a:2:{s:1:\"s\";s:26:\"//mobile/Trade/close_order\";s:3:\"oid\";s:6:\"100219\";}', '115.60.191.216', '2019-08-01 15:20:15');
INSERT INTO `st_operation_log` VALUES ('1047', '1', '34', '13653847075', '1', '100218', '', '会员平仓', '/mobile/Trade/close_order', 'a:2:{s:1:\"s\";s:26:\"//mobile/Trade/close_order\";s:3:\"oid\";s:6:\"100218\";}', '115.60.191.216', '2019-08-01 15:20:18');
INSERT INTO `st_operation_log` VALUES ('1048', '1', '34', '13653847075', '1', '100217', '', '会员平仓', '/mobile/Trade/close_order', 'a:2:{s:1:\"s\";s:26:\"//mobile/Trade/close_order\";s:3:\"oid\";s:6:\"100217\";}', '115.60.191.216', '2019-08-01 15:20:20');
INSERT INTO `st_operation_log` VALUES ('1049', '1', '33', '13663840507', '1', '100228', '', '会员平仓', '/mobile/Trade/close_order', 'a:2:{s:1:\"s\";s:26:\"//mobile/Trade/close_order\";s:3:\"oid\";s:6:\"100228\";}', '115.60.191.216', '2019-08-01 15:20:21');
INSERT INTO `st_operation_log` VALUES ('1050', '1', '34', '13653847075', '1', '100216', '', '会员平仓', '/mobile/Trade/close_order', 'a:2:{s:1:\"s\";s:26:\"//mobile/Trade/close_order\";s:3:\"oid\";s:6:\"100216\";}', '115.60.191.216', '2019-08-01 15:20:23');
INSERT INTO `st_operation_log` VALUES ('1051', '1', '34', '13653847075', '1', '100215', '', '会员平仓', '/mobile/Trade/close_order', 'a:2:{s:1:\"s\";s:26:\"//mobile/Trade/close_order\";s:3:\"oid\";s:6:\"100215\";}', '115.60.191.216', '2019-08-01 15:20:25');
INSERT INTO `st_operation_log` VALUES ('1052', '1', '35', '13623857649', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13623857649\";s:8:\"password\";s:6:\"908911\";}', '115.60.191.216', '2019-08-01 15:24:48');
INSERT INTO `st_operation_log` VALUES ('1053', '1', '33', '13663840507', '1', '100231', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100231\";}', '115.60.191.216', '2019-08-01 15:24:49');
INSERT INTO `st_operation_log` VALUES ('1054', '1', '33', '13663840507', '1', '100230', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100230\";}', '115.60.191.216', '2019-08-01 15:24:52');
INSERT INTO `st_operation_log` VALUES ('1055', '1', '33', '13663840507', '1', '100229', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100229\";}', '115.60.191.216', '2019-08-01 15:24:59');
INSERT INTO `st_operation_log` VALUES ('1056', '1', '33', '13663840507', '1', '100227', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100227\";}', '115.60.191.216', '2019-08-01 15:25:02');
INSERT INTO `st_operation_log` VALUES ('1057', '1', '33', '13663840507', '1', '100232', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:8:\"10012.05\";s:9:\"stop_loss\";s:7:\"9912.05\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 15:25:41');
INSERT INTO `st_operation_log` VALUES ('1058', '1', '36', '15736735157', '1', '100233', '', '会员建仓', '/mobile/Trade/create_order', 'a:4:{s:1:\"s\";s:27:\"//mobile/Trade/create_order\";s:4:\"hand\";s:2:\"10\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"2\";}', '115.60.191.216', '2019-08-01 15:26:44');
INSERT INTO `st_operation_log` VALUES ('1059', '1', '33', '13663840507', '1', '100234', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:6:\"263.51\";s:9:\"stop_loss\";s:6:\"163.51\";s:2:\"id\";s:1:\"4\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 15:28:18');
INSERT INTO `st_operation_log` VALUES ('1060', '1', '33', '13663840507', '1', '100235', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:7:\"54.2921\";s:9:\"stop_loss\";s:8:\"-45.7079\";s:2:\"id\";s:1:\"5\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 15:28:23');
INSERT INTO `st_operation_log` VALUES ('1061', '1', '33', '13663840507', '1', '100236', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:18:\"146.67000000000002\";s:9:\"stop_loss\";s:5:\"46.67\";s:2:\"id\";s:1:\"6\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 15:28:27');
INSERT INTO `st_operation_log` VALUES ('1062', '1', '33', '13663840507', '1', '100237', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:7:\"55.9006\";s:9:\"stop_loss\";s:8:\"-44.0994\";s:2:\"id\";s:1:\"7\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 15:28:31');
INSERT INTO `st_operation_log` VALUES ('1063', '1', '31', '15136413457', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"15136413457\";s:8:\"password\";s:6:\"999999\";}', '115.60.191.216', '2019-08-01 15:31:29');
INSERT INTO `st_operation_log` VALUES ('1064', '1', '31', '15136413457', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"15136413457\";s:8:\"password\";s:6:\"999999\";}', '115.60.191.216', '2019-08-01 15:36:16');
INSERT INTO `st_operation_log` VALUES ('1065', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:1:\"s\";s:19:\"//admin/Login/login\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:7:\"jyl2019\";}', '123.55.59.123', '2019-08-01 15:39:13');
INSERT INTO `st_operation_log` VALUES ('1066', '1', '33', '13663840507', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13663840507\";s:8:\"password\";s:6:\"999999\";}', '123.55.59.123', '2019-08-01 15:39:40');
INSERT INTO `st_operation_log` VALUES ('1067', '1', '42', '17337808380', '1', '42', '', '会员注册', '/mobile/Login/register', 'a:8:{s:1:\"s\";s:23:\"//mobile/Login/register\";s:8:\"username\";s:11:\"17337808380\";s:5:\"vcode\";s:4:\"9281\";s:4:\"code\";s:6:\"669330\";s:8:\"nickname\";s:5:\"zhang\";s:8:\"password\";s:11:\"zhang016011\";s:11:\"re_password\";s:11:\"zhang016011\";s:13:\"invite_number\";s:4:\"1969\";}', '183.162.18.177', '2019-08-01 15:43:56');
INSERT INTO `st_operation_log` VALUES ('1068', '1', '41', '19900000103', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"19900000103\";s:8:\"password\";s:6:\"999999\";}', '182.120.32.211', '2019-08-01 15:47:50');
INSERT INTO `st_operation_log` VALUES ('1069', '1', '42', '17337808380', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"17337808380\";s:8:\"password\";s:11:\"zhang016011\";}', '183.162.18.177', '2019-08-01 15:48:54');
INSERT INTO `st_operation_log` VALUES ('1070', '1', '34', '13653847075', '1', '100238', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"5\";s:13:\"target_profit\";s:8:\"10002.41\";s:9:\"stop_loss\";s:7:\"9902.41\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 15:53:32');
INSERT INTO `st_operation_log` VALUES ('1071', '1', '34', '13653847075', '1', '100239', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"5\";s:13:\"target_profit\";s:6:\"263.43\";s:9:\"stop_loss\";s:6:\"163.43\";s:2:\"id\";s:1:\"4\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 15:53:37');
INSERT INTO `st_operation_log` VALUES ('1072', '1', '34', '13653847075', '1', '100240', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"5\";s:13:\"target_profit\";s:7:\"54.2736\";s:9:\"stop_loss\";s:8:\"-45.7264\";s:2:\"id\";s:1:\"5\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 15:53:42');
INSERT INTO `st_operation_log` VALUES ('1073', '1', '34', '13653847075', '1', '100241', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"5\";s:13:\"target_profit\";s:18:\"146.70999999999998\";s:9:\"stop_loss\";s:18:\"46.709999999999994\";s:2:\"id\";s:1:\"6\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 15:53:45');
INSERT INTO `st_operation_log` VALUES ('1074', '1', '34', '13653847075', '1', '100242', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"5\";s:13:\"target_profit\";s:7:\"55.9063\";s:9:\"stop_loss\";s:8:\"-44.0937\";s:2:\"id\";s:1:\"7\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 15:53:49');
INSERT INTO `st_operation_log` VALUES ('1075', '1', '42', '17337808380', '1', '29', '', '会员发起实名认证', '/mobile/User/real_auth', 'a:3:{s:1:\"s\";s:23:\"//mobile/User/real_auth\";s:4:\"name\";s:6:\"张沉\";s:4:\"card\";s:18:\"341281198801016032\";}', '183.162.18.177', '2019-08-01 15:55:16');
INSERT INTO `st_operation_log` VALUES ('1076', '2', '18', '18937810752', '2', '0', '', '登录', '/agent/Login/login', 'a:4:{s:1:\"s\";s:19:\"//agent/Login/login\";s:10:\"agent_name\";s:11:\"18937810752\";s:8:\"password\";s:6:\"888888\";s:4:\"code\";s:4:\"3229\";}', '182.120.32.211', '2019-08-01 16:04:32');
INSERT INTO `st_operation_log` VALUES ('1077', '1', '35', '13623857649', '1', '0', '', '会员退出登陆', '/index/Login/logout', 'a:1:{s:1:\"s\";s:20:\"//index/Login/logout\";}', '115.60.191.216', '2019-08-01 16:09:32');
INSERT INTO `st_operation_log` VALUES ('1078', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:1:\"s\";s:19:\"//admin/Login/login\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:7:\"jyl2019\";}', '115.60.191.216', '2019-08-01 16:10:18');
INSERT INTO `st_operation_log` VALUES ('1079', '1', '33', '13663840507', '1', '0', '', '会员退出登陆', '/mobile/Login/logout', 'a:1:{s:1:\"s\";s:21:\"//mobile/Login/logout\";}', '123.55.59.123', '2019-08-01 16:12:43');
INSERT INTO `st_operation_log` VALUES ('1080', '3', '1', 'admin1', '1', '43', '', '添加会员', '/admin/User/user_add', 'a:7:{s:1:\"s\";s:21:\"//admin/User/user_add\";s:8:\"username\";s:11:\"19900000105\";s:8:\"password\";s:6:\"999999\";s:8:\"nickname\";s:3:\"解\";s:8:\"agent_id\";s:6:\"147258\";s:3:\"pid\";s:0:\"\";s:5:\"lever\";s:2:\"50\";}', '115.60.191.216', '2019-08-01 16:12:49');
INSERT INTO `st_operation_log` VALUES ('1081', '3', '1', 'admin1', '1', '43', '', '上分', '/admin/Api/new_user_money_change', 'a:4:{s:1:\"s\";s:33:\"//admin/Api/new_user_money_change\";s:3:\"uid\";s:2:\"43\";s:5:\"money\";s:5:\"50000\";s:5:\"param\";s:2:\"up\";}', '115.60.191.216', '2019-08-01 16:13:03');
INSERT INTO `st_operation_log` VALUES ('1082', '3', '1', 'admin1', '1', '43', '', '上分', '/admin/Api/new_user_money_change', 'a:4:{s:1:\"s\";s:33:\"//admin/Api/new_user_money_change\";s:3:\"uid\";s:2:\"43\";s:5:\"money\";s:5:\"50000\";s:5:\"param\";s:2:\"up\";}', '115.60.191.216', '2019-08-01 16:13:16');
INSERT INTO `st_operation_log` VALUES ('1083', '1', '43', '19900000105', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"19900000105\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"3237\";}', '115.60.191.216', '2019-08-01 16:14:41');
INSERT INTO `st_operation_log` VALUES ('1084', '1', '33', '13663840507', '1', '0', '', '会员退出登陆', '/index/Login/logout', 'a:1:{s:1:\"s\";s:20:\"//index/Login/logout\";}', '115.60.191.216', '2019-08-01 16:14:46');
INSERT INTO `st_operation_log` VALUES ('1085', '3', '1', 'admin1', '1', '42', '', '审核通过会员实名', '/admin/Api/user_real_handle', 'a:4:{s:1:\"s\";s:28:\"//admin/Api/user_real_handle\";s:2:\"id\";s:2:\"29\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '115.60.191.216', '2019-08-01 16:15:30');
INSERT INTO `st_operation_log` VALUES ('1086', '1', '43', '19900000105', '1', '30', '', '会员发起实名认证', '/index/User/real_auth', 'a:3:{s:1:\"s\";s:22:\"//index/User/real_auth\";s:4:\"name\";s:3:\"解\";s:4:\"card\";s:18:\"418866199302096987\";}', '115.60.191.216', '2019-08-01 16:16:22');
INSERT INTO `st_operation_log` VALUES ('1087', '3', '1', 'admin1', '1', '43', '', '审核通过会员实名', '/admin/Api/user_real_handle', 'a:4:{s:1:\"s\";s:28:\"//admin/Api/user_real_handle\";s:2:\"id\";s:2:\"30\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '115.60.191.216', '2019-08-01 16:16:40');
INSERT INTO `st_operation_log` VALUES ('1088', '1', '33', '13663840507', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13663840507\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"5024\";}', '115.60.191.216', '2019-08-01 16:17:26');
INSERT INTO `st_operation_log` VALUES ('1089', '1', '36', '15736735157', '1', '0', '', '会员退出登陆', '/mobile/Login/logout', 'a:1:{s:1:\"s\";s:21:\"//mobile/Login/logout\";}', '106.34.168.75', '2019-08-01 16:19:05');
INSERT INTO `st_operation_log` VALUES ('1090', '1', '43', '19900000105', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"19900000105\";s:8:\"password\";s:6:\"999999\";}', '106.34.168.75', '2019-08-01 16:21:14');
INSERT INTO `st_operation_log` VALUES ('1091', '1', '43', '19900000105', '1', '0', '', '会员退出登陆', '/mobile/Login/logout', 'a:1:{s:1:\"s\";s:21:\"//mobile/Login/logout\";}', '106.34.168.75', '2019-08-01 16:23:21');
INSERT INTO `st_operation_log` VALUES ('1092', '1', '35', '13623857649', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13623857649\";s:8:\"password\";s:6:\"908911\";s:5:\"vcode\";s:4:\"7992\";}', '115.60.191.216', '2019-08-01 16:32:39');
INSERT INTO `st_operation_log` VALUES ('1093', '1', '39', '19900000101', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"19900000101\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"6895\";}', '182.120.32.211', '2019-08-01 16:33:16');
INSERT INTO `st_operation_log` VALUES ('1094', '1', '37', '13721424988', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13721424988\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"9774\";}', '115.60.191.216', '2019-08-01 16:33:43');
INSERT INTO `st_operation_log` VALUES ('1095', '1', '37', '13721424988', '1', '37', '{\"old_password\":\"999999\",\"password\":\"swf225\",\"repass\":\"swf225\"}', '修改密码', '/index/User/re_pwd', 'a:4:{s:1:\"s\";s:19:\"//index/User/re_pwd\";s:12:\"old_password\";s:6:\"999999\";s:8:\"password\";s:6:\"swf225\";s:6:\"repass\";s:6:\"swf225\";}', '115.60.191.216', '2019-08-01 16:34:10');
INSERT INTO `st_operation_log` VALUES ('1096', '1', '39', '19900000101', '1', '100243', '', '会员建仓', '/index/Trade/create_order', 'a:8:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"1\";s:19:\"target_profit_check\";s:1:\"1\";s:13:\"target_profit\";s:8:\"10028.64\";s:15:\"stop_loss_check\";s:1:\"1\";s:9:\"stop_loss\";s:7:\"9928.64\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '182.120.32.211', '2019-08-01 16:34:29');
INSERT INTO `st_operation_log` VALUES ('1097', '1', '37', '13721424988', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13721424988\";s:8:\"password\";s:6:\"swf225\";}', '115.60.191.216', '2019-08-01 16:35:02');
INSERT INTO `st_operation_log` VALUES ('1098', '1', '40', '19900000102', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"19900000102\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"2431\";}', '182.120.32.211', '2019-08-01 16:38:35');
INSERT INTO `st_operation_log` VALUES ('1099', '1', '40', '19900000102', '1', '100244', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:7:\"9920.07\";s:9:\"stop_loss\";s:8:\"10020.07\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"2\";}', '182.120.32.211', '2019-08-01 16:44:43');
INSERT INTO `st_operation_log` VALUES ('1100', '1', '40', '19900000102', '1', '100244', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100244\";}', '182.120.32.211', '2019-08-01 16:45:41');
INSERT INTO `st_operation_log` VALUES ('1101', '1', '36', '15736735157', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"15736735157\";s:8:\"password\";s:6:\"999999\";}', '106.34.168.75', '2019-08-01 16:49:05');
INSERT INTO `st_operation_log` VALUES ('1102', '1', '37', '13721424988', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13721424988\";s:8:\"password\";s:6:\"swf225\";}', '115.60.191.216', '2019-08-01 17:04:34');
INSERT INTO `st_operation_log` VALUES ('1103', '1', '40', '19900000102', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"19900000102\";s:8:\"password\";s:6:\"999999\";}', '182.120.32.211', '2019-08-01 17:08:39');
INSERT INTO `st_operation_log` VALUES ('1104', '1', '33', '13663840507', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13663840507\";s:8:\"password\";s:6:\"999999\";}', '123.55.59.123', '2019-08-01 17:15:08');
INSERT INTO `st_operation_log` VALUES ('1105', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:1:\"s\";s:19:\"//admin/Login/login\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:7:\"jyl2019\";}', '123.55.59.123', '2019-08-01 17:16:17');
INSERT INTO `st_operation_log` VALUES ('1106', '1', '33', '13663840507', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13663840507\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"9241\";}', '115.60.191.216', '2019-08-01 17:22:43');
INSERT INTO `st_operation_log` VALUES ('1107', '1', '33', '13663840507', '1', '0', '', '用户提现', '/index/User/withdraw', 'a:3:{s:1:\"s\";s:21:\"//index/User/withdraw\";s:5:\"money\";s:3:\"500\";s:12:\"bank_info_id\";s:1:\"7\";}', '115.60.191.216', '2019-08-01 17:23:46');
INSERT INTO `st_operation_log` VALUES ('1108', '1', '36', '15736735157', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"15736735157\";s:8:\"password\";s:6:\"999999\";}', '115.60.191.216', '2019-08-01 17:26:16');
INSERT INTO `st_operation_log` VALUES ('1109', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:1:\"s\";s:19:\"//admin/Login/login\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:7:\"jyl2019\";}', '115.60.191.216', '2019-08-01 17:29:05');
INSERT INTO `st_operation_log` VALUES ('1110', '3', '1', 'admin1', '1', '33', '', '审核会员提现', '/admin/Api/user_withdraw_handle', 'a:4:{s:1:\"s\";s:32:\"//admin/Api/user_withdraw_handle\";s:2:\"id\";s:1:\"7\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '115.60.191.216', '2019-08-01 17:30:48');
INSERT INTO `st_operation_log` VALUES ('1111', '2', '18', '18937810752', '2', '0', '', '登录', '/agent/Login/login', 'a:4:{s:1:\"s\";s:19:\"//agent/Login/login\";s:10:\"agent_name\";s:11:\"18937810752\";s:8:\"password\";s:6:\"888888\";s:4:\"code\";s:4:\"6281\";}', '115.60.191.216', '2019-08-01 17:43:59');
INSERT INTO `st_operation_log` VALUES ('1112', '1', '36', '15736735157', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"15736735157\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"0935\";}', '115.60.191.216', '2019-08-01 18:06:44');
INSERT INTO `st_operation_log` VALUES ('1113', '1', '36', '15736735157', '1', '100245', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"1\";s:13:\"target_profit\";s:7:\"54.2677\";s:9:\"stop_loss\";s:8:\"-45.7323\";s:2:\"id\";s:1:\"5\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 18:07:00');
INSERT INTO `st_operation_log` VALUES ('1114', '1', '36', '15736735157', '1', '100246', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:2:\"10\";s:13:\"target_profit\";s:7:\"55.8732\";s:9:\"stop_loss\";s:8:\"-44.1268\";s:2:\"id\";s:1:\"7\";s:9:\"direction\";s:1:\"1\";}', '115.60.191.216', '2019-08-01 18:34:23');
INSERT INTO `st_operation_log` VALUES ('1115', '1', '32', '13140033272', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13140033272\";s:8:\"password\";s:6:\"999999\";}', '115.60.190.121', '2019-08-01 19:16:28');
INSERT INTO `st_operation_log` VALUES ('1116', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:1:\"s\";s:19:\"//admin/Login/login\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:7:\"jyl2019\";}', '123.55.59.123', '2019-08-01 19:42:26');
INSERT INTO `st_operation_log` VALUES ('1117', '1', '36', '15736735157', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"15736735157\";s:8:\"password\";s:6:\"999999\";}', '115.60.191.216', '2019-08-01 19:48:18');
INSERT INTO `st_operation_log` VALUES ('1118', '1', '40', '19900000102', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"19900000102\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"6237\";}', '182.120.32.211', '2019-08-01 19:53:12');
INSERT INTO `st_operation_log` VALUES ('1119', '1', '40', '19900000102', '1', '100247', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:2:\"10\";s:13:\"target_profit\";s:7:\"9913.12\";s:9:\"stop_loss\";s:8:\"10013.12\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"2\";}', '182.120.32.211', '2019-08-01 19:53:26');
INSERT INTO `st_operation_log` VALUES ('1120', '1', '40', '19900000102', '1', '100248', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:2:\"12\";s:13:\"target_profit\";s:8:\"10068.17\";s:9:\"stop_loss\";s:7:\"9968.17\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '182.120.32.211', '2019-08-01 20:28:32');
INSERT INTO `st_operation_log` VALUES ('1121', '1', '40', '19900000102', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"19900000102\";s:8:\"password\";s:6:\"999999\";}', '182.120.32.211', '2019-08-01 21:36:22');
INSERT INTO `st_operation_log` VALUES ('1122', '1', '40', '19900000102', '1', '100247', '', '会员平仓', '/mobile/Trade/close_order', 'a:2:{s:1:\"s\";s:26:\"//mobile/Trade/close_order\";s:3:\"oid\";s:6:\"100247\";}', '182.120.32.211', '2019-08-01 21:36:35');
INSERT INTO `st_operation_log` VALUES ('1123', '1', '40', '19900000102', '1', '100248', '', '会员平仓', '/mobile/Trade/close_order', 'a:2:{s:1:\"s\";s:26:\"//mobile/Trade/close_order\";s:3:\"oid\";s:6:\"100248\";}', '182.120.32.211', '2019-08-01 22:03:54');
INSERT INTO `st_operation_log` VALUES ('1124', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:1:\"s\";s:19:\"//admin/Login/login\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:7:\"jyl2019\";}', '123.55.59.123', '2019-08-02 00:12:46');
INSERT INTO `st_operation_log` VALUES ('1125', '1', '34', '13653847075', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13653847075\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"5951\";}', '115.60.191.216', '2019-08-02 08:46:56');
INSERT INTO `st_operation_log` VALUES ('1126', '1', '34', '13653847075', '1', '100239', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100239\";}', '115.60.191.216', '2019-08-02 08:59:55');
INSERT INTO `st_operation_log` VALUES ('1127', '1', '34', '13653847075', '1', '100242', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100242\";}', '115.60.191.216', '2019-08-02 09:00:01');
INSERT INTO `st_operation_log` VALUES ('1128', '1', '34', '13653847075', '1', '100241', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100241\";}', '115.60.191.216', '2019-08-02 09:00:04');
INSERT INTO `st_operation_log` VALUES ('1129', '1', '34', '13653847075', '1', '100240', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100240\";}', '115.60.191.216', '2019-08-02 09:00:07');
INSERT INTO `st_operation_log` VALUES ('1130', '1', '34', '13653847075', '1', '100238', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100238\";}', '115.60.191.216', '2019-08-02 09:00:15');
INSERT INTO `st_operation_log` VALUES ('1131', '1', '35', '13623857649', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13623857649\";s:8:\"password\";s:6:\"908911\";s:5:\"vcode\";s:4:\"1280\";}', '115.60.191.216', '2019-08-02 09:01:54');
INSERT INTO `st_operation_log` VALUES ('1132', '1', '38', '15738070600', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"15738070600\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"5108\";}', '115.60.191.216', '2019-08-02 09:03:26');
INSERT INTO `st_operation_log` VALUES ('1133', '1', '40', '19900000102', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"19900000102\";s:8:\"password\";s:6:\"999999\";}', '125.47.206.111', '2019-08-02 09:08:36');
INSERT INTO `st_operation_log` VALUES ('1134', '1', '40', '19900000102', '1', '100249', '', '会员建仓', '/mobile/Trade/create_order', 'a:4:{s:1:\"s\";s:27:\"//mobile/Trade/create_order\";s:4:\"hand\";s:2:\"10\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '125.47.206.111', '2019-08-02 09:08:59');
INSERT INTO `st_operation_log` VALUES ('1135', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:1:\"s\";s:19:\"//admin/Login/login\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:7:\"jyl2019\";}', '115.60.191.216', '2019-08-02 09:11:09');
INSERT INTO `st_operation_log` VALUES ('1136', '1', '39', '19900000101', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"19900000101\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"1829\";}', '125.47.206.111', '2019-08-02 09:19:13');
INSERT INTO `st_operation_log` VALUES ('1137', '1', '40', '19900000102', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"19900000102\";s:8:\"password\";s:6:\"999999\";}', '125.47.206.111', '2019-08-02 09:30:15');
INSERT INTO `st_operation_log` VALUES ('1138', '1', '39', '19900000101', '1', '100250', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"2\";s:13:\"target_profit\";s:8:\"10414.25\";s:9:\"stop_loss\";s:8:\"10314.25\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '125.47.206.111', '2019-08-02 09:46:31');
INSERT INTO `st_operation_log` VALUES ('1139', '1', '39', '19900000101', '1', '100250', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100250\";}', '125.47.206.111', '2019-08-02 09:59:42');
INSERT INTO `st_operation_log` VALUES ('1140', '1', '31', '15136413457', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"15136413457\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"7940\";}', '115.60.190.26', '2019-08-02 10:23:17');
INSERT INTO `st_operation_log` VALUES ('1141', '1', '31', '15136413457', '1', '100251', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"2\";s:13:\"target_profit\";s:8:\"10441.55\";s:9:\"stop_loss\";s:8:\"10341.55\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '115.60.190.26', '2019-08-02 10:24:00');
INSERT INTO `st_operation_log` VALUES ('1142', '1', '31', '15136413457', '1', '100252', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"2\";s:13:\"target_profit\";s:6:\"266.51\";s:9:\"stop_loss\";s:6:\"166.51\";s:2:\"id\";s:1:\"4\";s:9:\"direction\";s:1:\"1\";}', '115.60.190.26', '2019-08-02 10:25:33');
INSERT INTO `st_operation_log` VALUES ('1143', '1', '34', '13653847075', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13653847075\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"3092\";}', '115.60.190.26', '2019-08-02 10:41:29');
INSERT INTO `st_operation_log` VALUES ('1144', '1', '34', '13653847075', '1', '100253', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"5\";s:13:\"target_profit\";s:8:\"10440.28\";s:9:\"stop_loss\";s:8:\"10340.28\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '115.60.190.26', '2019-08-02 10:42:33');
INSERT INTO `st_operation_log` VALUES ('1145', '1', '34', '13653847075', '1', '100254', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"5\";s:13:\"target_profit\";s:6:\"266.45\";s:9:\"stop_loss\";s:6:\"166.45\";s:2:\"id\";s:1:\"4\";s:9:\"direction\";s:1:\"1\";}', '115.60.190.26', '2019-08-02 10:42:39');
INSERT INTO `st_operation_log` VALUES ('1146', '1', '34', '13653847075', '1', '100255', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"5\";s:13:\"target_profit\";s:7:\"54.2926\";s:9:\"stop_loss\";s:8:\"-45.7074\";s:2:\"id\";s:1:\"5\";s:9:\"direction\";s:1:\"1\";}', '115.60.190.26', '2019-08-02 10:42:47');
INSERT INTO `st_operation_log` VALUES ('1147', '1', '34', '13653847075', '1', '100256', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:2:\"50\";s:13:\"target_profit\";s:5:\"47.25\";s:9:\"stop_loss\";s:6:\"147.25\";s:2:\"id\";s:1:\"6\";s:9:\"direction\";s:1:\"2\";}', '115.60.190.26', '2019-08-02 10:42:56');
INSERT INTO `st_operation_log` VALUES ('1148', '1', '34', '13653847075', '1', '100257', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"5\";s:13:\"target_profit\";s:8:\"-44.0605\";s:9:\"stop_loss\";s:7:\"55.9395\";s:2:\"id\";s:1:\"7\";s:9:\"direction\";s:1:\"2\";}', '115.60.190.26', '2019-08-02 10:43:01');
INSERT INTO `st_operation_log` VALUES ('1149', '1', '40', '19900000102', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"19900000102\";s:8:\"password\";s:6:\"999999\";}', '125.47.206.111', '2019-08-02 11:11:09');
INSERT INTO `st_operation_log` VALUES ('1150', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:1:\"s\";s:19:\"//admin/Login/login\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:7:\"jyl2019\";}', '123.55.59.123', '2019-08-02 12:49:49');
INSERT INTO `st_operation_log` VALUES ('1151', '1', '31', '15136413457', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"15136413457\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"2024\";}', '115.60.190.26', '2019-08-02 13:49:13');
INSERT INTO `st_operation_log` VALUES ('1152', '1', '37', '13721424988', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13721424988\";s:8:\"password\";s:6:\"swf225\";s:5:\"vcode\";s:4:\"1005\";}', '115.60.190.26', '2019-08-02 13:49:57');
INSERT INTO `st_operation_log` VALUES ('1153', '1', '34', '13653847075', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13653847075\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"5883\";}', '115.60.190.26', '2019-08-02 13:52:01');
INSERT INTO `st_operation_log` VALUES ('1154', '1', '34', '13653847075', '1', '100256', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100256\";}', '115.60.190.26', '2019-08-02 13:52:39');
INSERT INTO `st_operation_log` VALUES ('1155', '1', '34', '13653847075', '1', '100254', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100254\";}', '115.60.190.26', '2019-08-02 13:53:04');
INSERT INTO `st_operation_log` VALUES ('1156', '1', '34', '13653847075', '1', '100258', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"5\";s:13:\"target_profit\";s:8:\"-44.1098\";s:9:\"stop_loss\";s:7:\"55.8902\";s:2:\"id\";s:1:\"7\";s:9:\"direction\";s:1:\"2\";}', '115.60.190.26', '2019-08-02 13:53:11');
INSERT INTO `st_operation_log` VALUES ('1157', '1', '34', '13653847075', '1', '100253', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100253\";}', '115.60.190.26', '2019-08-02 13:53:19');
INSERT INTO `st_operation_log` VALUES ('1158', '1', '34', '13653847075', '1', '100257', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100257\";}', '115.60.190.26', '2019-08-02 13:53:23');
INSERT INTO `st_operation_log` VALUES ('1159', '1', '34', '13653847075', '1', '100259', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"3\";s:13:\"target_profit\";s:8:\"10358.19\";s:9:\"stop_loss\";s:8:\"10458.19\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"2\";}', '115.60.190.26', '2019-08-02 13:53:38');
INSERT INTO `st_operation_log` VALUES ('1160', '1', '34', '13653847075', '1', '100260', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"3\";s:13:\"target_profit\";s:6:\"165.98\";s:9:\"stop_loss\";s:6:\"265.98\";s:2:\"id\";s:1:\"4\";s:9:\"direction\";s:1:\"2\";}', '115.60.190.26', '2019-08-02 13:53:45');
INSERT INTO `st_operation_log` VALUES ('1161', '1', '34', '13653847075', '1', '100261', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"3\";s:13:\"target_profit\";s:7:\"54.2845\";s:9:\"stop_loss\";s:8:\"-45.7155\";s:2:\"id\";s:1:\"5\";s:9:\"direction\";s:1:\"1\";}', '115.60.190.26', '2019-08-02 13:53:59');
INSERT INTO `st_operation_log` VALUES ('1162', '1', '34', '13653847075', '1', '100262', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"3\";s:13:\"target_profit\";s:6:\"146.99\";s:9:\"stop_loss\";s:18:\"46.989999999999995\";s:2:\"id\";s:1:\"6\";s:9:\"direction\";s:1:\"1\";}', '115.60.190.26', '2019-08-02 13:54:08');
INSERT INTO `st_operation_log` VALUES ('1163', '1', '34', '13653847075', '1', '100263', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"3\";s:13:\"target_profit\";s:8:\"-44.1164\";s:9:\"stop_loss\";s:7:\"55.8836\";s:2:\"id\";s:1:\"7\";s:9:\"direction\";s:1:\"2\";}', '115.60.190.26', '2019-08-02 13:54:21');
INSERT INTO `st_operation_log` VALUES ('1164', '1', '34', '13653847075', '1', '100260', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100260\";}', '115.60.190.26', '2019-08-02 13:54:52');
INSERT INTO `st_operation_log` VALUES ('1165', '1', '34', '13653847075', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13653847075\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"2760\";}', '115.60.190.26', '2019-08-02 14:35:13');
INSERT INTO `st_operation_log` VALUES ('1166', '1', '34', '13653847075', '1', '100259', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100259\";}', '115.60.190.26', '2019-08-02 14:35:22');
INSERT INTO `st_operation_log` VALUES ('1167', '1', '34', '13653847075', '1', '100263', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100263\";}', '115.60.190.26', '2019-08-02 14:35:24');
INSERT INTO `st_operation_log` VALUES ('1168', '1', '34', '13653847075', '1', '100262', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100262\";}', '115.60.190.26', '2019-08-02 14:35:29');
INSERT INTO `st_operation_log` VALUES ('1169', '1', '34', '13653847075', '1', '100261', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100261\";}', '115.60.190.26', '2019-08-02 14:35:32');
INSERT INTO `st_operation_log` VALUES ('1170', '1', '34', '13653847075', '1', '100258', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100258\";}', '115.60.190.26', '2019-08-02 14:35:34');
INSERT INTO `st_operation_log` VALUES ('1171', '1', '34', '13653847075', '1', '100255', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100255\";}', '115.60.190.26', '2019-08-02 14:35:37');
INSERT INTO `st_operation_log` VALUES ('1172', '1', '34', '13653847075', '1', '100264', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:2:\"10\";s:13:\"target_profit\";s:8:\"10497.91\";s:9:\"stop_loss\";s:8:\"10397.91\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '115.60.190.26', '2019-08-02 14:36:55');
INSERT INTO `st_operation_log` VALUES ('1173', '1', '33', '13663840507', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13663840507\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"6248\";}', '115.60.190.26', '2019-08-02 14:47:34');
INSERT INTO `st_operation_log` VALUES ('1174', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:1:\"s\";s:19:\"//admin/Login/login\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:7:\"jyl2019\";}', '115.60.190.26', '2019-08-02 14:48:56');
INSERT INTO `st_operation_log` VALUES ('1175', '1', '33', '13663840507', '1', '0', '', '用户提现', '/index/User/withdraw', 'a:3:{s:1:\"s\";s:21:\"//index/User/withdraw\";s:5:\"money\";s:5:\"10000\";s:12:\"bank_info_id\";s:1:\"7\";}', '115.60.190.26', '2019-08-02 14:49:11');
INSERT INTO `st_operation_log` VALUES ('1176', '1', '31', '15136413457', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"15136413457\";s:8:\"password\";s:6:\"999999\";}', '115.60.190.26', '2019-08-02 14:49:35');
INSERT INTO `st_operation_log` VALUES ('1177', '1', '33', '13663840507', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13663840507\";s:8:\"password\";s:6:\"999999\";}', '115.60.190.26', '2019-08-02 14:50:26');
INSERT INTO `st_operation_log` VALUES ('1178', '1', '31', '15136413457', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"15136413457\";s:8:\"password\";s:6:\"999999\";}', '115.60.190.26', '2019-08-02 14:50:41');
INSERT INTO `st_operation_log` VALUES ('1179', '3', '1', 'admin1', '1', '33', '', '审核会员提现', '/admin/Api/user_withdraw_handle', 'a:4:{s:1:\"s\";s:32:\"//admin/Api/user_withdraw_handle\";s:2:\"id\";s:1:\"8\";s:6:\"status\";s:1:\"2\";s:6:\"remark\";s:0:\"\";}', '115.60.190.26', '2019-08-02 14:50:47');
INSERT INTO `st_operation_log` VALUES ('1180', '1', '31', '15136413457', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"15136413457\";s:8:\"password\";s:6:\"999999\";}', '115.60.190.26', '2019-08-02 14:51:31');
INSERT INTO `st_operation_log` VALUES ('1181', '3', '1', 'admin1', '4', '0', '', '修改产品', '/admin/Admin/product_edit', 'a:13:{s:1:\"s\";s:26:\"//admin/Admin/product_edit\";s:2:\"id\";s:1:\"7\";s:4:\"name\";s:3:\"ETC\";s:9:\"desc_name\";s:7:\"ETC/USD\";s:12:\"abbreviation\";s:3:\"ETC\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:62:\"/uploads/product/20190725/9b1f58e0f410593993a5b0b9d5535d48.jpg\";s:8:\"contract\";s:11:\"1000.000000\";s:8:\"min_hand\";s:8:\"0.100000\";s:8:\"max_hand\";s:9:\"50.000000\";s:4:\"wave\";s:9:\"10.000000\";s:3:\"fee\";s:9:\"30.000000\";s:9:\"night_fee\";s:9:\"10.000000\";}', '115.60.190.26', '2019-08-02 14:51:39');
INSERT INTO `st_operation_log` VALUES ('1182', '3', '1', 'admin1', '4', '0', '', '修改产品', '/admin/Admin/product_edit', 'a:13:{s:1:\"s\";s:26:\"//admin/Admin/product_edit\";s:2:\"id\";s:1:\"6\";s:4:\"name\";s:3:\"LTC\";s:9:\"desc_name\";s:7:\"LTC/USD\";s:12:\"abbreviation\";s:3:\"LTC\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:62:\"/uploads/product/20190725/9925699d90c89010bb7f6c4d80ae9159.png\";s:8:\"contract\";s:10:\"100.000000\";s:8:\"min_hand\";s:8:\"0.100000\";s:8:\"max_hand\";s:9:\"50.000000\";s:4:\"wave\";s:9:\"10.000000\";s:3:\"fee\";s:9:\"30.000000\";s:9:\"night_fee\";s:9:\"10.000000\";}', '115.60.190.26', '2019-08-02 14:51:47');
INSERT INTO `st_operation_log` VALUES ('1183', '3', '1', 'admin1', '4', '0', '', '修改产品', '/admin/Admin/product_edit', 'a:13:{s:1:\"s\";s:26:\"//admin/Admin/product_edit\";s:2:\"id\";s:1:\"5\";s:4:\"name\";s:3:\"EOS\";s:9:\"desc_name\";s:7:\"EOS/USD\";s:12:\"abbreviation\";s:3:\"EOS\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:62:\"/uploads/product/20190725/d0999abd80cca599735dbe9c61553499.jpg\";s:8:\"contract\";s:11:\"1000.000000\";s:8:\"min_hand\";s:8:\"0.100000\";s:8:\"max_hand\";s:10:\"100.000000\";s:4:\"wave\";s:9:\"50.000000\";s:3:\"fee\";s:9:\"30.000000\";s:9:\"night_fee\";s:9:\"10.000000\";}', '115.60.190.26', '2019-08-02 14:51:54');
INSERT INTO `st_operation_log` VALUES ('1184', '3', '1', 'admin1', '4', '0', '', '修改产品', '/admin/Admin/product_edit', 'a:13:{s:1:\"s\";s:26:\"//admin/Admin/product_edit\";s:2:\"id\";s:1:\"4\";s:4:\"name\";s:3:\"ETH\";s:9:\"desc_name\";s:7:\"ETH/USD\";s:12:\"abbreviation\";s:3:\"ETH\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:62:\"/uploads/product/20190725/ea64af996700fe17e14dd2964c0114c8.png\";s:8:\"contract\";s:10:\"100.000000\";s:8:\"min_hand\";s:8:\"0.100000\";s:8:\"max_hand\";s:10:\"100.000000\";s:4:\"wave\";s:9:\"50.000000\";s:3:\"fee\";s:9:\"30.000000\";s:9:\"night_fee\";s:9:\"10.000000\";}', '115.60.190.26', '2019-08-02 14:52:00');
INSERT INTO `st_operation_log` VALUES ('1185', '3', '1', 'admin1', '4', '0', '', '修改产品', '/admin/Admin/product_edit', 'a:13:{s:1:\"s\";s:26:\"//admin/Admin/product_edit\";s:2:\"id\";s:1:\"3\";s:4:\"name\";s:3:\"BTC\";s:9:\"desc_name\";s:7:\"BTC/USD\";s:12:\"abbreviation\";s:3:\"BTC\";s:4:\"file\";s:0:\"\";s:5:\"image\";s:62:\"/uploads/product/20190719\\ad194c7b4958445f898daef96bcfb9a7.png\";s:8:\"contract\";s:8:\"2.000000\";s:8:\"min_hand\";s:8:\"0.100000\";s:8:\"max_hand\";s:10:\"100.000000\";s:4:\"wave\";s:9:\"50.000000\";s:3:\"fee\";s:9:\"30.000000\";s:9:\"night_fee\";s:9:\"10.000000\";}', '115.60.190.26', '2019-08-02 14:52:06');
INSERT INTO `st_operation_log` VALUES ('1186', '1', '43', '19900000105', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"19900000105\";s:8:\"password\";s:6:\"999999\";}', '42.228.113.227', '2019-08-02 14:54:10');
INSERT INTO `st_operation_log` VALUES ('1187', '1', '43', '19900000105', '1', '100265', '', '会员建仓', '/mobile/Trade/create_order', 'a:4:{s:1:\"s\";s:27:\"//mobile/Trade/create_order\";s:4:\"hand\";s:1:\"1\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '42.228.113.227', '2019-08-02 14:54:46');
INSERT INTO `st_operation_log` VALUES ('1188', '1', '34', '13653847075', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13653847075\";s:8:\"password\";s:6:\"999999\";}', '115.60.190.26', '2019-08-02 14:54:53');
INSERT INTO `st_operation_log` VALUES ('1189', '1', '43', '19900000105', '1', '100266', '', '会员建仓', '/mobile/Trade/create_order', 'a:4:{s:1:\"s\";s:27:\"//mobile/Trade/create_order\";s:4:\"hand\";s:1:\"1\";s:2:\"id\";s:1:\"4\";s:9:\"direction\";s:1:\"1\";}', '42.228.113.227', '2019-08-02 14:55:02');
INSERT INTO `st_operation_log` VALUES ('1190', '1', '43', '19900000105', '1', '100267', '', '会员建仓', '/mobile/Trade/create_order', 'a:4:{s:1:\"s\";s:27:\"//mobile/Trade/create_order\";s:4:\"hand\";s:1:\"1\";s:2:\"id\";s:1:\"5\";s:9:\"direction\";s:1:\"1\";}', '42.228.113.227', '2019-08-02 14:55:19');
INSERT INTO `st_operation_log` VALUES ('1191', '1', '34', '13653847075', '1', '100264', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100264\";}', '115.60.190.26', '2019-08-02 15:12:40');
INSERT INTO `st_operation_log` VALUES ('1192', '1', '32', '13140033272', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13140033272\";s:8:\"password\";s:6:\"999999\";}', '115.60.190.26', '2019-08-02 15:17:54');
INSERT INTO `st_operation_log` VALUES ('1193', '1', '36', '15736735157', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"15736735157\";s:8:\"password\";s:6:\"999999\";}', '115.60.190.26', '2019-08-02 15:19:36');
INSERT INTO `st_operation_log` VALUES ('1194', '1', '33', '13663840507', '1', '100268', '', '会员建仓', '/index/Trade/create_order', 'a:6:{s:1:\"s\";s:26:\"//index/Trade/create_order\";s:4:\"hand\";s:1:\"2\";s:13:\"target_profit\";s:8:\"10493.42\";s:9:\"stop_loss\";s:8:\"10593.42\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"2\";}', '115.60.190.26', '2019-08-02 15:20:08');
INSERT INTO `st_operation_log` VALUES ('1195', '1', '33', '13663840507', '1', '100235', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100235\";}', '115.60.190.26', '2019-08-02 15:20:15');
INSERT INTO `st_operation_log` VALUES ('1196', '1', '33', '13663840507', '1', '100237', '', '会员平仓', '/index/Trade/close_order', 'a:2:{s:1:\"s\";s:25:\"//index/Trade/close_order\";s:3:\"oid\";s:6:\"100237\";}', '115.60.190.26', '2019-08-02 15:20:17');
INSERT INTO `st_operation_log` VALUES ('1197', '1', '36', '15736735157', '1', '100269', '', '会员建仓', '/mobile/Trade/create_order', 'a:4:{s:1:\"s\";s:27:\"//mobile/Trade/create_order\";s:4:\"hand\";s:1:\"5\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"2\";}', '115.60.190.26', '2019-08-02 15:21:36');
INSERT INTO `st_operation_log` VALUES ('1198', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:1:\"s\";s:19:\"//admin/Login/login\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:7:\"jyl2019\";}', '115.60.190.26', '2019-08-02 15:51:31');
INSERT INTO `st_operation_log` VALUES ('1199', '1', '32', '13140033272', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13140033272\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"8243\";}', '115.60.190.26', '2019-08-02 15:55:39');
INSERT INTO `st_operation_log` VALUES ('1200', '1', '32', '13140033272', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13140033272\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"9837\";}', '115.60.190.26', '2019-08-02 15:58:35');
INSERT INTO `st_operation_log` VALUES ('1201', '1', '34', '13653847075', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13653847075\";s:8:\"password\";s:6:\"999999\";}', '115.60.190.26', '2019-08-02 16:36:05');
INSERT INTO `st_operation_log` VALUES ('1202', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:1:\"s\";s:19:\"//admin/Login/login\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:7:\"jyl2019\";}', '123.55.59.123', '2019-08-02 17:13:35');
INSERT INTO `st_operation_log` VALUES ('1203', '3', '1', 'admin1', '3', '0', '', '管理员登录', '/admin/Login/login', 'a:3:{s:1:\"s\";s:19:\"//admin/Login/login\";s:8:\"username\";s:6:\"admin1\";s:8:\"password\";s:7:\"jyl2019\";}', '115.60.190.26', '2019-08-02 17:21:52');
INSERT INTO `st_operation_log` VALUES ('1204', '3', '1', 'admin1', '4', '0', '', '编辑资讯', '/admin/Admin/news_edit', 'a:8:{s:1:\"s\";s:23:\"//admin/Admin/news_edit\";s:2:\"id\";s:2:\"11\";s:5:\"title\";s:39:\"央行将研究发行法定数字货币\";s:7:\"content\";s:1415:\"<p>央行研究局局长王信在今天的数字金融学术研讨会上表示，要推动央行数字货币的研发。其实这个事情很早之前就提出来了，17年就有这方面传闻，当时还有人传言名字都取好了，叫熊猫币，后来这事就不了了之了。法定数字货币这个事情为什么拖了这么久，最主要的原因还是没想清楚为什么要做，怎么做，怎么监管，一旦发行法定数字货币，各行各业会受到什么样的影响？<br>一个国家的货币，涉及各行各业，所以要推动他的发展需要大量的模型测算，各行各业的影响以及对经济和生活带来什么样的改变。这次把这个事情再次提到台面上，最主要的原因是Libra的冲击。我们老百姓都能看明白Facebook发币是为了侵蚀各国央行，成为世界央行，大佬们更能够清晰的意识到问题的严重和紧迫。所以这次王信也提出：下个阶段值得深入研究的课题包括，未来是否会形成法定数字货币，少数数字稳定币并存的格局。个人认为，这件事情不可避免，趋势推动下，唯有尽快拥抱创新，革新自我，才能永远走在世界的前沿，这个时代已经无法让一个国家躺在自己的乌托邦里实现梦想了。国家如此，我们每个个体更应该如此，持续学习，紧跟时代，才是暴富的正确姿势。</p>\";s:4:\"file\";s:0:\"\";s:3:\"des\";s:117:\"央行研究局局长王信在今天的数字金融学术研讨会上表示，要推动央行数字货币的研发。\";s:4:\"type\";s:1:\"1\";s:4:\"sort\";s:1:\"2\";}', '123.55.59.123', '2019-08-02 17:43:50');
INSERT INTO `st_operation_log` VALUES ('1205', '3', '1', 'admin1', '4', '0', '', '编辑资讯', '/admin/Admin/news_edit', 'a:8:{s:1:\"s\";s:23:\"//admin/Admin/news_edit\";s:2:\"id\";s:2:\"12\";s:5:\"title\";s:63:\"央行如果发行法定数字货币，将长期利好比特币\";s:7:\"content\";s:1537:\"<p>法定数字货币将会提升人们对数字货币的认知，长期利好区块链鼻祖比特币，未来也将会有越来越多的人加入到炒币大军。昨天我们看到新浪的数字货币频道，似乎已经感觉到了什么，这些不可逆的未来，才是年轻人该去了解的。</p><p>对于银行来说，是近乎于毁灭性的打击，区块链技术革命最先革谁的命？革的是金融机构的命，以前金融机构靠着自己的牌坊，博取信任，利用招牌谋取暴利，老头老太太一听工商银行这四个字，他们卖的一切都可以投入全部养老金。而区块链刚好是一个不需要证明信任的技术，因此银行的暴利时代将会一去不复返。</p><p>监管层可以大批量减员了，比如说银监会这个机构，他们每天需要观察大量的数据，找出银行业可能出现的问题，而区块链技术全部数据都在链上可追溯，没有造假，没法篡改，人们维权只需要一个懂链上查询的人即可。</p><p>还有各行各业的影响，比如医疗行业，病历上链，更好的为各家医院提供案例，且无需泄露患者信息，又或是供应链，在供应链中的每个过程都可以被记录和溯源，保障每个环节的安全可靠。如此的案例太多太多，守旧的人会被这个时代淘汰，就像20年前做传统生意的人，现在如果还不会熟练的运用互联网做市场，基本进入垂死挣扎的状态了，垄断型或资源型企业除外。<br></p>\";s:4:\"file\";s:0:\"\";s:3:\"des\";s:162:\"法定数字货币将会提升人们对数字货币的认知，长期利好区块链鼻祖比特币，未来也将会有越来越多的人加入到炒币大军。\";s:4:\"type\";s:1:\"1\";s:4:\"sort\";s:1:\"1\";}', '123.55.59.123', '2019-08-02 17:45:48');
INSERT INTO `st_operation_log` VALUES ('1206', '3', '1', 'admin1', '4', '0', '', '编辑资讯', '/admin/Admin/news_edit', 'a:8:{s:1:\"s\";s:23:\"//admin/Admin/news_edit\";s:2:\"id\";s:1:\"7\";s:5:\"title\";s:21:\"比特币发展历程\";s:7:\"content\";s:5605:\"<p>2008年爆发全球<a href=\"https://baike.so.com/doc/1644940-1738752.html\" target=\"_blank\">金融危机</a>，当时有人用“<a href=\"https://baike.so.com/doc/7358369-7624972.html\" target=\"_blank\">中本聪</a>”的化名发表了一篇论文，描述了比特币的模式。</p><p>和法定货币相比，比特币没有一个集中的发行方，而是由网络节点的计算生成，谁都有可能参与制造比特币，而且可以全世界流通，可以在任意一台接入互联网的电脑上买卖，不管身处何方，任何人都可以挖掘、购买、出售或收取比特币，并且在交易过程中外人无法辨认用户身份信息。2009年，不受央行和任何金融机构控制的比特币诞生。比特币是一种“<a href=\"https://baike.so.com/doc/5580339-5793249.html\" target=\"_blank\">电子货币</a>”，由计算机生成的一串串复杂代码组成，新比特币通过预设的程序制造，随着比特币总量的增加，<a class=\"show-img layoutright\" style=\"text-align: center;\" href=\"https://p1.ssl.qhmsg.com/t015546eae2040c5c0f.jpg\" data-index=\"2\" data-log=\"content-gallery\" data-type=\"gallery\"><span class=\"show-img-hd\"><img id=\"img_9124182\" src=\"https://p1.ssl.qhmsg.com/dr/220__/t015546eae2040c5c0f.jpg\" data-img=\"mod_img\"></span><span class=\"show-img-bd\" style=\"text-align: left;\"></span></a>新币制造的速度减慢，直到2014年达到2100万个的总量上限，被挖出的比特币总量已经超过1200万个。</p><p>每当比特币进入主流媒体的视野时，主流媒体总会请一些主流经济学家分析一下比特币。早先，这些分析总是集中在比特币是不是骗局。而现如今的分析总是集中在比特币能否成为未来的主流货币。而这其中争论的焦点又往往集中在比特币的通缩特性上。</p><p>不少比特币玩家是被比特币的不能随意增发所吸引的。和比特币玩家的态度截然相反，经济学家们对比特币2100万固定总量的态度两极分化。</p><p><a href=\"https://baike.so.com/doc/2607138-2752878.html\" target=\"_blank\">凯恩斯学派</a>的经济学家们认为政府应该积极调控货币总量，用<a href=\"https://baike.so.com/doc/772160-816985.html\" target=\"_blank\">货币政策</a>的松紧来为经济适时的加油或者刹车。因此，他们认为比特币固定总量货币牺牲了可调控性，而且更糟糕的是将不可避免地导致通货紧缩，进而伤害整体经济。奥地利学派经济学家们的观点却截然相反，他们认为政府对货币的干预越少越好，货币总量的固定导致的通缩并没什么大不了的，甚至是社会进步的标志。</p><p>比特币网络通过“挖矿”来生成新的比特币。所谓“挖矿”实质上是用计算机解决一项复杂的数学问题，来保证比特币网络分布式记账系统的一致性。比特币网络会自动调整数学问题的难度，让整个网络约每10分钟得到一个合格答案。随后比特币网络会新生成一定量的比特币作为赏金，奖励获得答案的人。</p><p><a class=\"show-img layoutright\" style=\"text-align: center;\" href=\"https://p1.ssl.qhmsg.com/t0189c5b170f97f2093.jpg\" data-index=\"3\" data-log=\"content-gallery\" data-type=\"gallery\"><span class=\"show-img-hd\"><img title=\"比特币\" id=\"img_7351480\" alt=\"比特币\" src=\"https://p1.ssl.qhmsg.com/dr/220__/t0189c5b170f97f2093.jpg\" data-img=\"mod_img\"></span><span class=\"show-img-bd\" style=\"text-align: left;\">比特币</span></a></p><p>2009年比特币诞生的时候，每笔赏金是50个比特币。诞生10分钟后，第一批50个比特币生成了，而此时的货币总量就是50。随后比特币就以约每10分钟50个的速度增长。当总量达到1050万时(2100万的50%)，赏金减半为25个。当总量达到1575万(新产出525万，即1050的50%)时，赏金再减半为12.5个。</p><p>首先，根据其设计原理，比特币的总量会持续增长，直至100多年后达到2100万的那一天。但比特币货币总量后期增长的速度会非常缓慢。事实上，87.5%的比特币都将在头12年内被“挖”出来。所以从货币总量上看，比特币并不会达到固定量，其货币总量实质上是会不断膨胀的，尽管速度越来越慢。因此看起来比特币似乎是通胀货币才对。</p><p>然而判断处于通货紧缩还是膨胀，并不依据货币总量是减少还是增多，而是看整体物价水平是下跌还是上涨。整体物价上升即为通货膨胀，反之则为通货紧缩。长期看来，比特币的发行机制决定了它的货币总量增长速度将远低于社会财富的增长速度。</p><p>凯恩斯学派的经济学家们认为，物价持续下跌会让人们倾向于推迟消费，因为同样一块钱明天就能买到更多的东西。消费意愿的降低又进一步导致了需求萎缩、商品滞销，使物价变得更低，步入“通缩螺旋”的恶性循环。同样，通缩货币哪怕不存入银行本身也能升值（购买力越来越强），人们的投资意愿也会升高，社会生产也会陷入低迷。因此比特币是一种具备通缩倾向的货币。比特币经济体中，以比特币定价的商品价格将会持续下跌。</p><p>比特币是一种网络虚拟货币，数量有限，但是可以用来套现：可以兑换成大多数国家的货币。你可以使用比特币购买一些虚拟的物品，比如网络游戏当中的衣服、帽子、装备等，只要有人接受，你也可以使用比特币购买现实生活当中的物品。</p>\";s:4:\"file\";s:0:\"\";s:3:\"des\";s:127:\"2008年爆发全球金融危机，当时有人用“中本聪”的化名发表了一篇论文，描述了比特币的模式。\";s:4:\"type\";s:1:\"1\";s:4:\"sort\";s:1:\"1\";}', '123.55.59.123', '2019-08-02 17:46:00');
INSERT INTO `st_operation_log` VALUES ('1207', '1', '33', '13663840507', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13663840507\";s:8:\"password\";s:6:\"999999\";}', '115.60.190.26', '2019-08-02 18:02:33');
INSERT INTO `st_operation_log` VALUES ('1208', '1', '33', '13663840507', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13663840507\";s:8:\"password\";s:6:\"999999\";s:5:\"vcode\";s:4:\"8811\";}', '106.33.11.147', '2019-08-02 19:32:23');
INSERT INTO `st_operation_log` VALUES ('1209', '1', '33', '13663840507', '1', '0', '', '会员退出登陆', '/index/Login/logout', 'a:1:{s:1:\"s\";s:20:\"//index/Login/logout\";}', '106.33.11.147', '2019-08-02 19:32:34');
INSERT INTO `st_operation_log` VALUES ('1210', '1', '35', '13623857649', '1', '0', '', '会员登录', '/index/Login/login', 'a:4:{s:1:\"s\";s:19:\"//index/Login/login\";s:8:\"username\";s:11:\"13623857649\";s:8:\"password\";s:6:\"908911\";s:5:\"vcode\";s:4:\"5910\";}', '106.33.11.147', '2019-08-02 19:33:04');
INSERT INTO `st_operation_log` VALUES ('1211', '1', '35', '13623857649', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13623857649\";s:8:\"password\";s:6:\"908911\";}', '106.33.11.147', '2019-08-02 19:47:39');
INSERT INTO `st_operation_log` VALUES ('1212', '1', '35', '13623857649', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13623857649\";s:8:\"password\";s:6:\"908911\";}', '117.136.75.151', '2019-08-02 19:49:23');
INSERT INTO `st_operation_log` VALUES ('1213', '1', '35', '13623857649', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13623857649\";s:8:\"password\";s:6:\"908911\";}', '117.136.75.168', '2019-08-02 19:51:57');
INSERT INTO `st_operation_log` VALUES ('1214', '1', '35', '13623857649', '1', '100270', '', '会员建仓', '/mobile/Trade/create_order', 'a:4:{s:1:\"s\";s:27:\"//mobile/Trade/create_order\";s:4:\"hand\";s:1:\"1\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '117.136.75.168', '2019-08-02 19:52:09');
INSERT INTO `st_operation_log` VALUES ('1215', '1', '35', '13623857649', '1', '100270', '', '会员平仓', '/mobile/Trade/close_order', 'a:2:{s:1:\"s\";s:26:\"//mobile/Trade/close_order\";s:3:\"oid\";s:6:\"100270\";}', '117.136.75.168', '2019-08-02 19:54:01');
INSERT INTO `st_operation_log` VALUES ('1216', '1', '43', '19900000105', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"19900000105\";s:8:\"password\";s:6:\"999999\";}', '171.9.137.246', '2019-08-02 21:40:04');
INSERT INTO `st_operation_log` VALUES ('1217', '1', '43', '19900000105', '1', '100271', '', '会员建仓', '/mobile/Trade/create_order', 'a:4:{s:1:\"s\";s:27:\"//mobile/Trade/create_order\";s:4:\"hand\";s:1:\"1\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '171.9.137.246', '2019-08-02 21:40:45');
INSERT INTO `st_operation_log` VALUES ('1218', '1', '43', '19900000105', '1', '100265', '', '会员平仓', '/mobile/Trade/close_order', 'a:2:{s:1:\"s\";s:26:\"//mobile/Trade/close_order\";s:3:\"oid\";s:6:\"100265\";}', '171.9.137.246', '2019-08-02 21:40:57');
INSERT INTO `st_operation_log` VALUES ('1219', '1', '43', '19900000105', '1', '100266', '', '会员平仓', '/mobile/Trade/close_order', 'a:2:{s:1:\"s\";s:26:\"//mobile/Trade/close_order\";s:3:\"oid\";s:6:\"100266\";}', '171.9.137.246', '2019-08-02 21:41:00');
INSERT INTO `st_operation_log` VALUES ('1220', '1', '43', '19900000105', '1', '100271', '', '会员平仓', '/mobile/Trade/close_order', 'a:2:{s:1:\"s\";s:26:\"//mobile/Trade/close_order\";s:3:\"oid\";s:6:\"100271\";}', '171.9.137.246', '2019-08-02 21:41:03');
INSERT INTO `st_operation_log` VALUES ('1221', '1', '43', '19900000105', '1', '100267', '', '会员平仓', '/mobile/Trade/close_order', 'a:2:{s:1:\"s\";s:26:\"//mobile/Trade/close_order\";s:3:\"oid\";s:6:\"100267\";}', '171.9.137.246', '2019-08-02 21:41:07');
INSERT INTO `st_operation_log` VALUES ('1222', '1', '43', '19900000105', '1', '100272', '', '会员建仓', '/mobile/Trade/create_order', 'a:4:{s:1:\"s\";s:27:\"//mobile/Trade/create_order\";s:4:\"hand\";s:1:\"2\";s:2:\"id\";s:1:\"5\";s:9:\"direction\";s:1:\"1\";}', '171.9.137.246', '2019-08-02 21:41:45');
INSERT INTO `st_operation_log` VALUES ('1223', '1', '43', '19900000105', '1', '100273', '', '会员建仓', '/mobile/Trade/create_order', 'a:4:{s:1:\"s\";s:27:\"//mobile/Trade/create_order\";s:4:\"hand\";s:2:\"10\";s:2:\"id\";s:1:\"7\";s:9:\"direction\";s:1:\"1\";}', '171.9.137.246', '2019-08-02 21:42:42');
INSERT INTO `st_operation_log` VALUES ('1224', '1', '43', '19900000105', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"19900000105\";s:8:\"password\";s:6:\"999999\";}', '171.15.172.59', '2019-08-03 00:00:22');
INSERT INTO `st_operation_log` VALUES ('1225', '1', '43', '19900000105', '1', '100273', '', '会员平仓', '/mobile/Trade/close_order', 'a:2:{s:1:\"s\";s:26:\"//mobile/Trade/close_order\";s:3:\"oid\";s:6:\"100273\";}', '171.15.172.59', '2019-08-03 00:00:34');
INSERT INTO `st_operation_log` VALUES ('1226', '1', '40', '19900000102', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"19900000102\";s:8:\"password\";s:6:\"999999\";}', '182.126.69.208', '2019-08-03 01:09:59');
INSERT INTO `st_operation_log` VALUES ('1227', '1', '43', '19900000105', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"19900000105\";s:8:\"password\";s:6:\"999999\";}', '171.15.172.59', '2019-08-03 01:19:58');
INSERT INTO `st_operation_log` VALUES ('1228', '1', '43', '19900000105', '1', '100274', '', '会员建仓', '/mobile/Trade/create_order', 'a:4:{s:1:\"s\";s:27:\"//mobile/Trade/create_order\";s:4:\"hand\";s:2:\"10\";s:2:\"id\";s:1:\"3\";s:9:\"direction\";s:1:\"1\";}', '171.15.172.59', '2019-08-03 01:20:17');
INSERT INTO `st_operation_log` VALUES ('1229', '1', '32', '13140033272', '1', '0', '', '会员登录', '/mobile/Login/login', 'a:3:{s:1:\"s\";s:20:\"//mobile/Login/login\";s:8:\"username\";s:11:\"13140033272\";s:8:\"password\";s:6:\"999999\";}', '115.60.190.194', '2019-08-03 11:19:04');

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
) ENGINE=InnoDB AUTO_INCREMENT=100275 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of st_order
-- ----------------------------
INSERT INTO `st_order` VALUES ('100215', 'sn15646423931484', '34', '13653847075', '17', '147258', '3', 'BTC', 'BTC', '1982.398000', '5.000000', '2.000000', '50.000000', '150.000000', '2', '9911.990000', '9960.110000', '1', '0.000000', '1', '0.000000', '-481.200000', '10110.229800', '2', '1', '2019-08-01 14:53:13', '2019-08-01 15:20:25');
INSERT INTO `st_order` VALUES ('100216', 'sn15646423983322', '34', '13653847075', '17', '147258', '4', 'ETH', 'ETH', '2125.000000', '5.000000', '100.000000', '50.000000', '150.000000', '2', '212.500000', '213.280000', '1', '0.000000', '1', '0.000000', '-390.000000', '216.750000', '2', '1', '2019-08-01 14:53:18', '2019-08-01 15:20:23');
INSERT INTO `st_order` VALUES ('100217', 'sn15646424032133', '34', '13653847075', '17', '147258', '5', 'EOS', 'EOS', '425.040000', '5.000000', '1000.000000', '50.000000', '150.000000', '2', '4.250400', '4.294300', '1', '0.000000', '1', '0.000000', '-219.500000', '4.335408', '2', '1', '2019-08-01 14:53:23', '2019-08-01 15:20:20');
INSERT INTO `st_order` VALUES ('100218', 'sn15646424105411', '34', '13653847075', '17', '147258', '6', 'LTC', 'LTC', '960.900000', '5.000000', '100.000000', '50.000000', '150.000000', '2', '96.090000', '96.610000', '1', '0.000000', '1', '0.000000', '-260.000000', '98.011800', '2', '1', '2019-08-01 14:53:30', '2019-08-01 15:20:18');
INSERT INTO `st_order` VALUES ('100219', 'sn15646424164884', '34', '13653847075', '17', '147258', '7', 'ETC', 'ETC', '587.790000', '5.000000', '1000.000000', '50.000000', '150.000000', '2', '5.877900', '5.904700', '1', '0.000000', '1', '0.000000', '-134.000000', '5.995458', '2', '1', '2019-08-01 14:53:36', '2019-08-01 15:20:15');
INSERT INTO `st_order` VALUES ('100220', 'sn15646425424460', '37', '13721424988', '17', '147258', '3', 'BTC', 'BTC', '7961.008000', '20.000000', '2.000000', '50.000000', '600.000000', '1', '9951.260000', '9950.000000', '1', '0.000000', '1', '0.000000', '-50.400000', '9752.234800', '2', '1', '2019-08-01 14:55:42', '2019-08-01 14:56:03');
INSERT INTO `st_order` VALUES ('100221', 'sn15646425758274', '32', '13140033272', '17', '147258', '3', 'BTC', 'BTC', '3978.304000', '10.000000', '2.000000', '50.000000', '300.000000', '1', '9945.760000', '9952.360000', '1', '0.000000', '1', '0.000000', '132.000000', '9746.844800', '2', '1', '2019-08-01 14:56:15', '2019-08-01 14:57:39');
INSERT INTO `st_order` VALUES ('100222', 'sn15646426192270', '35', '13623857649', '17', '147258', '3', 'BTC', 'BTC', '3978.400000', '10.000000', '2.000000', '50.000000', '300.000000', '1', '9946.000000', '0.000000', '1', '0.000000', '1', '0.000000', '0.000000', '9747.080000', '1', '1', '2019-08-01 14:56:59', null);
INSERT INTO `st_order` VALUES ('100223', 'sn15646426408363', '35', '13623857649', '17', '147258', '4', 'ETH', 'ETH', '2129.900000', '5.000000', '100.000000', '50.000000', '150.000000', '1', '212.990000', '213.060000', '1', '0.000000', '1', '0.000000', '35.000000', '208.730200', '2', '1', '2019-08-01 14:57:20', '2019-08-01 14:57:49');
INSERT INTO `st_order` VALUES ('100224', 'sn15646426615941', '35', '13623857649', '17', '147258', '6', 'LTC', 'LTC', '1160.040000', '6.000000', '100.000000', '50.000000', '180.000000', '1', '96.670000', '94.660000', '1', '0.000000', '1', '0.000000', '-1160.040000', '94.736600', '2', '3', '2019-08-01 14:57:41', '2019-08-03 00:36:25');
INSERT INTO `st_order` VALUES ('100225', 'sn15646426699817', '32', '13140033272', '17', '147258', '3', 'BTC', 'BTC', '19909.560000', '50.000000', '2.000000', '50.000000', '1500.000000', '1', '9954.780000', '0.000000', '1', '0.000000', '1', '0.000000', '0.000000', '9755.684400', '1', '1', '2019-08-01 14:57:49', null);
INSERT INTO `st_order` VALUES ('100226', 'sn15646426707104', '36', '15736735157', '17', '147258', '3', 'BTC', 'BTC', '3981.912000', '10.000000', '2.000000', '50.000000', '300.000000', '1', '9954.780000', '9951.350000', '1', '0.000000', '1', '0.000000', '-68.600000', '9755.684400', '2', '1', '2019-08-01 14:57:50', '2019-08-01 14:58:21');
INSERT INTO `st_order` VALUES ('100227', 'sn15646435053020', '33', '13663840507', '17', '147258', '3', 'BTC', 'BTC', '3989.400000', '10.000000', '2.000000', '50.000000', '300.000000', '1', '9973.500000', '9962.640000', '2', '10023.500000', '2', '9923.500000', '-217.200000', '9774.030000', '2', '1', '2019-08-01 15:11:45', '2019-08-01 15:25:02');
INSERT INTO `st_order` VALUES ('100228', 'sn15646436872740', '33', '13663840507', '17', '147258', '4', 'ETH', 'ETH', '4269.400000', '10.000000', '100.000000', '50.000000', '300.000000', '1', '213.470000', '213.270000', '1', '0.000000', '1', '0.000000', '-200.000000', '209.200600', '2', '1', '2019-08-01 15:14:47', '2019-08-01 15:20:21');
INSERT INTO `st_order` VALUES ('100229', 'sn15646436947822', '33', '13663840507', '17', '147258', '5', 'EOS', 'EOS', '8549.400000', '100.000000', '1000.000000', '50.000000', '3000.000000', '1', '4.274700', '4.287200', '1', '0.000000', '1', '0.000000', '1250.000000', '4.189206', '2', '1', '2019-08-01 15:14:54', '2019-08-01 15:24:59');
INSERT INTO `st_order` VALUES ('100230', 'sn15646437252354', '33', '13663840507', '17', '147258', '6', 'LTC', 'LTC', '9664.000000', '50.000000', '100.000000', '50.000000', '1500.000000', '1', '96.640000', '96.580000', '1', '0.000000', '1', '0.000000', '-300.000000', '94.707200', '2', '1', '2019-08-01 15:15:25', '2019-08-01 15:24:52');
INSERT INTO `st_order` VALUES ('100231', 'sn15646437389480', '33', '13663840507', '17', '147258', '7', 'ETC', 'ETC', '5905.500000', '50.000000', '1000.000000', '50.000000', '1500.000000', '1', '5.905500', '5.895400', '1', '0.000000', '1', '0.000000', '-505.000000', '5.787390', '2', '1', '2019-08-01 15:15:38', '2019-08-01 15:24:49');
INSERT INTO `st_order` VALUES ('100232', 'sn15646443413953', '33', '13663840507', '17', '147258', '3', 'BTC', 'BTC', '398.482000', '1.000000', '2.000000', '50.000000', '30.000000', '1', '9962.050000', '0.000000', '1', '0.000000', '1', '0.000000', '0.000000', '9762.809000', '1', '1', '2019-08-01 15:25:41', null);
INSERT INTO `st_order` VALUES ('100233', 'sn15646444044805', '36', '15736735157', '17', '147258', '3', 'BTC', 'BTC', '3987.220000', '10.000000', '2.000000', '50.000000', '300.000000', '2', '9968.050000', '10167.990000', '1', '0.000000', '1', '0.000000', '-3987.220000', '10167.411000', '2', '3', '2019-08-01 15:26:44', '2019-08-02 02:44:45');
INSERT INTO `st_order` VALUES ('100234', 'sn15646444985838', '33', '13663840507', '17', '147258', '4', 'ETH', 'ETH', '426.940000', '1.000000', '100.000000', '50.000000', '30.000000', '1', '213.470000', '0.000000', '1', '0.000000', '1', '0.000000', '0.000000', '209.200600', '1', '1', '2019-08-01 15:28:18', null);
INSERT INTO `st_order` VALUES ('100235', 'sn15646445038931', '33', '13663840507', '17', '147258', '5', 'EOS', 'EOS', '85.842000', '1.000000', '1000.000000', '50.000000', '30.000000', '1', '4.292100', '4.331800', '1', '0.000000', '1', '0.000000', '39.700000', '4.206258', '2', '1', '2019-08-01 15:28:23', '2019-08-02 15:20:15');
INSERT INTO `st_order` VALUES ('100236', 'sn15646445075137', '33', '13663840507', '17', '147258', '6', 'LTC', 'LTC', '193.340000', '1.000000', '100.000000', '50.000000', '30.000000', '1', '96.670000', '94.660000', '1', '0.000000', '1', '0.000000', '-193.340000', '94.736600', '2', '3', '2019-08-01 15:28:27', '2019-08-03 00:36:25');
INSERT INTO `st_order` VALUES ('100237', 'sn15646445111648', '33', '13663840507', '17', '147258', '7', 'ETC', 'ETC', '118.012000', '1.000000', '1000.000000', '50.000000', '30.000000', '1', '5.900600', '5.993200', '1', '0.000000', '1', '0.000000', '92.600000', '5.782588', '2', '1', '2019-08-01 15:28:31', '2019-08-02 15:20:17');
INSERT INTO `st_order` VALUES ('100238', 'sn15646460121802', '34', '13653847075', '17', '147258', '3', 'BTC', 'BTC', '1990.482000', '5.000000', '2.000000', '50.000000', '150.000000', '1', '9952.410000', '10376.820000', '1', '0.000000', '1', '0.000000', '4244.100000', '9753.361800', '2', '1', '2019-08-01 15:53:32', '2019-08-02 09:00:15');
INSERT INTO `st_order` VALUES ('100239', 'sn15646460175772', '34', '13653847075', '17', '147258', '4', 'ETH', 'ETH', '2134.200000', '5.000000', '100.000000', '50.000000', '150.000000', '1', '213.420000', '216.230000', '1', '0.000000', '1', '0.000000', '1405.000000', '209.151600', '2', '1', '2019-08-01 15:53:37', '2019-08-02 08:59:55');
INSERT INTO `st_order` VALUES ('100240', 'sn15646460224068', '34', '13653847075', '17', '147258', '5', 'EOS', 'EOS', '427.360000', '5.000000', '1000.000000', '50.000000', '150.000000', '1', '4.273600', '4.268200', '1', '0.000000', '1', '0.000000', '-27.000000', '4.188128', '2', '1', '2019-08-01 15:53:42', '2019-08-02 09:00:07');
INSERT INTO `st_order` VALUES ('100241', 'sn15646460253697', '34', '13653847075', '17', '147258', '6', 'LTC', 'LTC', '967.100000', '5.000000', '100.000000', '50.000000', '150.000000', '1', '96.710000', '97.560000', '1', '0.000000', '1', '0.000000', '425.000000', '94.775800', '2', '1', '2019-08-01 15:53:45', '2019-08-02 09:00:04');
INSERT INTO `st_order` VALUES ('100242', 'sn15646460296914', '34', '13653847075', '17', '147258', '7', 'ETC', 'ETC', '590.630000', '5.000000', '1000.000000', '50.000000', '150.000000', '1', '5.906300', '5.946000', '1', '0.000000', '1', '0.000000', '198.500000', '5.788174', '2', '1', '2019-08-01 15:53:49', '2019-08-02 09:00:01');
INSERT INTO `st_order` VALUES ('100243', 'sn15646484696694', '39', '19900000101', '17', '147258', '3', 'BTC', 'BTC', '399.145600', '1.000000', '2.000000', '50.000000', '30.000000', '1', '9978.640000', '9928.010000', '2', '10028.640000', '2', '9928.640000', '-100.000000', '9779.067200', '2', '5', '2019-08-01 16:34:29', '2019-08-01 17:30:58');
INSERT INTO `st_order` VALUES ('100244', 'sn15646490838365', '40', '19900000102', '17', '147258', '3', 'BTC', 'BTC', '398.800000', '1.000000', '2.000000', '50.000000', '30.000000', '2', '9970.000000', '9972.780000', '1', '0.000000', '1', '0.000000', '-5.560000', '10169.400000', '2', '1', '2019-08-01 16:44:43', '2019-08-01 16:45:41');
INSERT INTO `st_order` VALUES ('100245', 'sn15646540201046', '36', '15736735157', '17', '147258', '5', 'EOS', 'EOS', '85.354000', '1.000000', '1000.000000', '50.000000', '30.000000', '1', '4.267700', '4.178300', '1', '0.000000', '1', '0.000000', '-85.354000', '4.182346', '2', '3', '2019-08-01 18:07:00', '2019-08-03 00:40:57');
INSERT INTO `st_order` VALUES ('100246', 'sn15646556632420', '36', '15736735157', '17', '147258', '7', 'ETC', 'ETC', '1174.640000', '10.000000', '1000.000000', '50.000000', '300.000000', '1', '5.873200', '0.000000', '1', '0.000000', '1', '0.000000', '0.000000', '5.755736', '1', '1', '2019-08-01 18:34:23', null);
INSERT INTO `st_order` VALUES ('100247', 'sn15646604064082', '40', '19900000102', '17', '147258', '3', 'BTC', 'BTC', '3985.316000', '10.000000', '2.000000', '50.000000', '300.000000', '2', '9963.290000', '10023.280000', '1', '0.000000', '1', '0.000000', '-1199.800000', '10162.555800', '2', '1', '2019-08-01 19:53:26', '2019-08-01 21:36:35');
INSERT INTO `st_order` VALUES ('100248', 'sn15646625123586', '40', '19900000102', '17', '147258', '3', 'BTC', 'BTC', '4808.160000', '12.000000', '2.000000', '50.000000', '360.000000', '1', '10017.000000', '10029.290000', '1', '0.000000', '1', '0.000000', '294.960000', '9816.660000', '2', '1', '2019-08-01 20:28:32', '2019-08-01 22:03:54');
INSERT INTO `st_order` VALUES ('100249', 'sn15647081399223', '40', '19900000102', '17', '147258', '3', 'BTC', 'BTC', '4157.076000', '10.000000', '2.000000', '50.000000', '300.000000', '1', '10392.690000', '0.000000', '1', '0.000000', '1', '0.000000', '0.000000', '10184.836200', '1', '1', '2019-08-02 09:08:59', null);
INSERT INTO `st_order` VALUES ('100250', 'sn15647103914109', '39', '19900000101', '17', '147258', '3', 'BTC', 'BTC', '828.976000', '2.000000', '2.000000', '50.000000', '60.000000', '1', '10362.200000', '10372.000000', '1', '0.000000', '1', '0.000000', '39.200000', '10154.956000', '2', '1', '2019-08-02 09:46:31', '2019-08-02 09:59:42');
INSERT INTO `st_order` VALUES ('100251', 'sn15647126408368', '31', '15136413457', '17', '147258', '3', 'BTC', 'BTC', '831.200000', '2.000000', '2.000000', '50.000000', '60.000000', '1', '10390.000000', '0.000000', '1', '0.000000', '1', '0.000000', '0.000000', '10182.200000', '1', '1', '2019-08-02 10:24:00', null);
INSERT INTO `st_order` VALUES ('100252', 'sn15647127335318', '31', '15136413457', '17', '147258', '4', 'ETH', 'ETH', '866.040000', '2.000000', '100.000000', '50.000000', '60.000000', '1', '216.510000', '0.000000', '1', '0.000000', '1', '0.000000', '0.000000', '212.179800', '1', '1', '2019-08-02 10:25:33', null);
INSERT INTO `st_order` VALUES ('100253', 'sn15647137537128', '34', '13653847075', '17', '147258', '3', 'BTC', 'BTC', '2078.058000', '5.000000', '2.000000', '50.000000', '150.000000', '1', '10390.290000', '10407.780000', '1', '0.000000', '1', '0.000000', '174.900000', '10182.484200', '2', '1', '2019-08-02 10:42:33', '2019-08-02 13:53:19');
INSERT INTO `st_order` VALUES ('100254', 'sn15647137599446', '34', '13653847075', '17', '147258', '4', 'ETH', 'ETH', '2164.500000', '5.000000', '100.000000', '50.000000', '150.000000', '1', '216.450000', '216.080000', '1', '0.000000', '1', '0.000000', '-185.000000', '212.121000', '2', '1', '2019-08-02 10:42:39', '2019-08-02 13:53:04');
INSERT INTO `st_order` VALUES ('100255', 'sn15647137677393', '34', '13653847075', '17', '147258', '5', 'EOS', 'EOS', '429.210000', '5.000000', '1000.000000', '50.000000', '150.000000', '1', '4.292100', '4.285700', '1', '0.000000', '1', '0.000000', '-32.000000', '4.206258', '2', '1', '2019-08-02 10:42:47', '2019-08-02 14:35:37');
INSERT INTO `st_order` VALUES ('100256', 'sn15647137769143', '34', '13653847075', '17', '147258', '6', 'LTC', 'LTC', '9725.000000', '50.000000', '100.000000', '50.000000', '1500.000000', '2', '97.250000', '96.970000', '1', '0.000000', '1', '0.000000', '1400.000000', '99.195000', '2', '1', '2019-08-02 10:42:56', '2019-08-02 13:52:39');
INSERT INTO `st_order` VALUES ('100257', 'sn15647137813842', '34', '13653847075', '17', '147258', '7', 'ETC', 'ETC', '593.950000', '5.000000', '1000.000000', '50.000000', '150.000000', '2', '5.939500', '5.888200', '1', '0.000000', '1', '0.000000', '256.500000', '6.058290', '2', '1', '2019-08-02 10:43:01', '2019-08-02 13:53:23');
INSERT INTO `st_order` VALUES ('100258', 'sn15647251915703', '34', '13653847075', '17', '147258', '7', 'ETC', 'ETC', '589.020000', '5.000000', '1000.000000', '50.000000', '150.000000', '2', '5.890200', '5.909200', '1', '0.000000', '1', '0.000000', '-95.000000', '6.008004', '2', '1', '2019-08-02 13:53:11', '2019-08-02 14:35:34');
INSERT INTO `st_order` VALUES ('100259', 'sn15647252188638', '34', '13653847075', '17', '147258', '3', 'BTC', 'BTC', '1248.982800', '3.000000', '2.000000', '50.000000', '90.000000', '2', '10408.190000', '10447.370000', '1', '0.000000', '1', '0.000000', '-235.080000', '10616.353800', '2', '1', '2019-08-02 13:53:38', '2019-08-02 14:35:22');
INSERT INTO `st_order` VALUES ('100260', 'sn15647252254258', '34', '13653847075', '17', '147258', '4', 'ETH', 'ETH', '1296.060000', '3.000000', '100.000000', '50.000000', '90.000000', '2', '216.010000', '216.110000', '1', '0.000000', '1', '0.000000', '-30.000000', '220.330200', '2', '1', '2019-08-02 13:53:45', '2019-08-02 13:54:52');
INSERT INTO `st_order` VALUES ('100261', 'sn15647252397245', '34', '13653847075', '17', '147258', '5', 'EOS', 'EOS', '257.070000', '3.000000', '1000.000000', '50.000000', '90.000000', '1', '4.284500', '4.286400', '1', '0.000000', '1', '0.000000', '5.700000', '4.198810', '2', '1', '2019-08-02 13:53:59', '2019-08-02 14:35:32');
INSERT INTO `st_order` VALUES ('100262', 'sn15647252484272', '34', '13653847075', '17', '147258', '6', 'LTC', 'LTC', '581.940000', '3.000000', '100.000000', '50.000000', '90.000000', '1', '96.990000', '97.350000', '1', '0.000000', '1', '0.000000', '108.000000', '95.050200', '2', '1', '2019-08-02 13:54:08', '2019-08-02 14:35:29');
INSERT INTO `st_order` VALUES ('100263', 'sn15647252611047', '34', '13653847075', '17', '147258', '7', 'ETC', 'ETC', '353.016000', '3.000000', '1000.000000', '50.000000', '90.000000', '2', '5.883600', '5.908900', '1', '0.000000', '1', '0.000000', '-75.900000', '6.001272', '2', '1', '2019-08-02 13:54:21', '2019-08-02 14:35:24');
INSERT INTO `st_order` VALUES ('100264', 'sn15647278159681', '34', '13653847075', '17', '147258', '3', 'BTC', 'BTC', '4178.316000', '10.000000', '2.000000', '50.000000', '300.000000', '1', '10445.790000', '10519.950000', '1', '0.000000', '1', '0.000000', '1483.200000', '10236.874200', '2', '1', '2019-08-02 14:36:55', '2019-08-02 15:12:40');
INSERT INTO `st_order` VALUES ('100265', 'sn15647288861219', '43', '19900000105', '17', '147258', '3', 'BTC', 'BTC', '418.489200', '1.000000', '2.000000', '50.000000', '30.000000', '1', '10462.230000', '10517.930000', '1', '0.000000', '1', '0.000000', '111.400000', '10252.985400', '2', '1', '2019-08-02 14:54:46', '2019-08-02 21:40:57');
INSERT INTO `st_order` VALUES ('100266', 'sn15647289029105', '43', '19900000105', '17', '147258', '4', 'ETH', 'ETH', '439.300000', '1.000000', '100.000000', '50.000000', '30.000000', '1', '219.650000', '219.640000', '1', '0.000000', '1', '0.000000', '-1.000000', '215.257000', '2', '1', '2019-08-02 14:55:02', '2019-08-02 21:41:00');
INSERT INTO `st_order` VALUES ('100267', 'sn15647289191188', '43', '19900000105', '17', '147258', '5', 'EOS', 'EOS', '86.338000', '1.000000', '1000.000000', '50.000000', '30.000000', '1', '4.316900', '4.315900', '1', '0.000000', '1', '0.000000', '-1.000000', '4.230562', '2', '1', '2019-08-02 14:55:19', '2019-08-02 21:41:07');
INSERT INTO `st_order` VALUES ('100268', 'sn15647304081512', '33', '13663840507', '17', '147258', '3', 'BTC', 'BTC', '843.428000', '2.000000', '2.000000', '50.000000', '60.000000', '2', '10542.850000', '10760.000000', '1', '0.000000', '1', '0.000000', '-843.428000', '10753.707000', '2', '3', '2019-08-02 15:20:08', '2019-08-03 10:27:52');
INSERT INTO `st_order` VALUES ('100269', 'sn15647304965478', '36', '15736735157', '17', '147258', '3', 'BTC', 'BTC', '2108.994000', '5.000000', '2.000000', '50.000000', '150.000000', '2', '10544.970000', '10760.000000', '1', '0.000000', '1', '0.000000', '-2108.994000', '10755.869400', '2', '3', '2019-08-02 15:21:36', '2019-08-03 10:27:52');
INSERT INTO `st_order` VALUES ('100270', 'sn15647467294535', '35', '13623857649', '17', '147258', '3', 'BTC', 'BTC', '419.400000', '1.000000', '2.000000', '50.000000', '30.000000', '1', '10485.000000', '10480.500000', '1', '0.000000', '1', '0.000000', '-9.000000', '10275.300000', '2', '1', '2019-08-02 19:52:09', '2019-08-02 19:54:01');
INSERT INTO `st_order` VALUES ('100271', 'sn15647532457013', '43', '19900000105', '17', '147258', '3', 'BTC', 'BTC', '420.782000', '1.000000', '2.000000', '50.000000', '30.000000', '1', '10519.550000', '10519.990000', '1', '0.000000', '1', '0.000000', '0.880000', '10309.159000', '2', '1', '2019-08-02 21:40:45', '2019-08-02 21:41:03');
INSERT INTO `st_order` VALUES ('100272', 'sn15647533053828', '43', '19900000105', '17', '147258', '5', 'EOS', 'EOS', '172.580000', '2.000000', '1000.000000', '50.000000', '60.000000', '1', '4.314500', '4.225000', '1', '0.000000', '1', '0.000000', '-172.580000', '4.228210', '2', '3', '2019-08-02 21:41:45', '2019-08-03 00:19:49');
INSERT INTO `st_order` VALUES ('100273', 'sn15647533629584', '43', '19900000105', '17', '147258', '7', 'ETC', 'ETC', '1181.900000', '10.000000', '1000.000000', '50.000000', '300.000000', '1', '5.909500', '5.930800', '1', '0.000000', '1', '0.000000', '213.000000', '5.791310', '2', '1', '2019-08-02 21:42:42', '2019-08-03 00:00:34');
INSERT INTO `st_order` VALUES ('100274', 'sn15647664179939', '43', '19900000105', '17', '147258', '3', 'BTC', 'BTC', '4167.236000', '10.000000', '2.000000', '50.000000', '300.000000', '1', '10418.090000', '0.000000', '1', '0.000000', '1', '0.000000', '0.000000', '10209.728200', '1', '1', '2019-08-03 01:20:17', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='产品表';

-- ----------------------------
-- Records of st_product
-- ----------------------------
INSERT INTO `st_product` VALUES ('3', 'BTC', 'BTC/USD', 'BTC', '/uploads/product/20190719\\ad194c7b4958445f898daef96bcfb9a7.png', '2.000000', '0.100000', '100.000000', '50.000000', '1', '1', '30.000000', '10.000000', '1', '2019-07-15 11:29:08', '2019-07-15 11:29:08');
INSERT INTO `st_product` VALUES ('4', 'ETH', 'ETH/USD', 'ETH', '/uploads/product/20190725/ea64af996700fe17e14dd2964c0114c8.png', '100.000000', '0.100000', '100.000000', '50.000000', '1', '1', '30.000000', '10.000000', '1', '2019-07-15 11:29:32', '2019-07-15 11:29:32');
INSERT INTO `st_product` VALUES ('5', 'EOS', 'EOS/USD', 'EOS', '/uploads/product/20190725/d0999abd80cca599735dbe9c61553499.jpg', '1000.000000', '0.100000', '100.000000', '50.000000', '1', '1', '30.000000', '10.000000', '1', '2019-07-15 11:29:43', '2019-07-15 11:29:43');
INSERT INTO `st_product` VALUES ('6', 'LTC', 'LTC/USD', 'LTC', '/uploads/product/20190725/9925699d90c89010bb7f6c4d80ae9159.png', '100.000000', '0.100000', '50.000000', '10.000000', '1', '1', '30.000000', '10.000000', '1', '2019-07-25 21:58:49', '2019-07-25 21:58:49');
INSERT INTO `st_product` VALUES ('7', 'ETC', 'ETC/USD', 'ETC', '/uploads/product/20190725/9b1f58e0f410593993a5b0b9d5535d48.jpg', '1000.000000', '0.100000', '50.000000', '10.000000', '1', '1', '30.000000', '10.000000', '1', '2019-07-25 21:59:24', '2019-07-25 21:59:24');

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='实名认证表';

-- ----------------------------
-- Records of st_real_auth
-- ----------------------------
INSERT INTO `st_real_auth` VALUES ('18', '33', '13663840507', '项国星', '410423189804157458', '2019-08-01 14:29:08', '2019-08-01 14:30:56', '2', '审核通过');
INSERT INTO `st_real_auth` VALUES ('19', '32', '13140033272', '叶问', '410425197606062255', '2019-08-01 14:29:57', '2019-08-01 14:30:52', '2', '审核通过');
INSERT INTO `st_real_auth` VALUES ('20', '37', '13721424988', '邵枫', '412625199808218888', '2019-08-01 14:30:08', '2019-08-01 14:30:49', '2', '审核通过');
INSERT INTO `st_real_auth` VALUES ('21', '31', '15136413457', '韩寒', '422455197507080910', '2019-08-01 14:30:37', '2019-08-01 14:30:45', '2', '审核通过');
INSERT INTO `st_real_auth` VALUES ('22', '35', '13623857649', '杨科', '423654789512345678', '2019-08-01 14:30:56', '2019-08-01 14:31:01', '2', '审核通过');
INSERT INTO `st_real_auth` VALUES ('23', '34', '13653847075', '马云', '410822199107212513', '2019-08-01 14:32:29', '2019-08-01 14:33:18', '2', '审核通过');
INSERT INTO `st_real_auth` VALUES ('24', '36', '15736735157', '罗海林', '453435435434354', '2019-08-01 14:33:26', '2019-08-01 14:35:42', '2', '审核通过');
INSERT INTO `st_real_auth` VALUES ('25', '38', '15738070600', '刘强', '432852459856254615', '2019-08-01 14:38:42', '2019-08-01 14:50:36', '2', '审核通过');
INSERT INTO `st_real_auth` VALUES ('26', '39', '19900000101', '张楠', '411522456715160203', '2019-08-01 14:48:52', '2019-08-01 14:50:33', '2', '审核通过');
INSERT INTO `st_real_auth` VALUES ('27', '40', '19900000102', '张亮', '410456198946450201', '2019-08-01 14:49:31', '2019-08-01 14:50:29', '2', '审核通过');
INSERT INTO `st_real_auth` VALUES ('28', '41', '19900000103', '程宏国', '456123198715021213', '2019-08-01 14:50:18', '2019-08-01 14:50:26', '2', '审核通过');
INSERT INTO `st_real_auth` VALUES ('29', '42', '17337808380', '张沉', '341281198801016032', '2019-08-01 15:55:16', '2019-08-01 16:15:30', '2', '审核通过');
INSERT INTO `st_real_auth` VALUES ('30', '43', '19900000105', '解', '418866199302096987', '2019-08-01 16:16:22', '2019-08-01 16:16:40', '2', '审核通过');

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
  `rate` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `real_money` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `amount` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '实际到账金额',
  `type` varchar(20) NOT NULL DEFAULT '1' COMMENT '1微信支付2支付宝支付',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1未支付2已支付',
  `add_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COMMENT='充值表';

-- ----------------------------
-- Records of st_recharge
-- ----------------------------
INSERT INTO `st_recharge` VALUES ('50', '33', '13663840507', '17', '147258', 'rn15646412522200', '3000.000000', '6.890000', '435.410000', '0.000000', '2004', '1', '2019-08-01 14:34:12', null);
INSERT INTO `st_recharge` VALUES ('51', '33', '13663840507', '17', '147258', 'rn15646413053456', '3000.000000', '6.890000', '435.410000', '0.000000', '5001', '1', '2019-08-01 14:35:05', null);
INSERT INTO `st_recharge` VALUES ('52', '37', '13721424988', '17', '147258', 'rn15646419358698', '30000.000000', '6.890000', '4354.140000', '0.000000', '2004', '1', '2019-08-01 14:45:35', null);
INSERT INTO `st_recharge` VALUES ('53', '36', '15736735157', '17', '147258', 'rn15646427369373', '5000.000000', '6.910000', '723.590000', '0.000000', '5001', '1', '2019-08-01 14:58:56', null);
INSERT INTO `st_recharge` VALUES ('54', '32', '13140033272', '17', '147258', 'rn15646428374621', '1000.000000', '6.910000', '144.720000', '0.000000', '2004', '1', '2019-08-01 15:00:37', null);
INSERT INTO `st_recharge` VALUES ('55', '36', '15736735157', '17', '147258', 'rn15646437432048', '500.000000', '6.910000', '72.360000', '0.000000', '2004', '1', '2019-08-01 15:15:43', null);
INSERT INTO `st_recharge` VALUES ('56', '32', '13140033272', '17', '147258', 'rn15646465237826', '1000.000000', '6.910000', '144.720000', '0.000000', '2004', '1', '2019-08-01 16:02:03', null);
INSERT INTO `st_recharge` VALUES ('57', '32', '13140033272', '17', '147258', 'rn15646466092970', '800.000000', '6.910000', '115.770000', '0.000000', '2004', '2', '2019-08-01 16:03:29', '2019-08-02 17:12:17');
INSERT INTO `st_recharge` VALUES ('58', '31', '15136413457', '17', '147258', 'rn15647285925558', '30000.000000', '6.910000', '4341.530000', '0.000000', '5001', '1', '2019-08-02 14:49:52', null);
INSERT INTO `st_recharge` VALUES ('59', '31', '15136413457', '17', '147258', 'rn15647286609776', '500.000000', '6.910000', '72.360000', '0.000000', '2004', '1', '2019-08-02 14:51:00', null);
INSERT INTO `st_recharge` VALUES ('60', '31', '15136413457', '17', '147258', 'rn15647286991872', '20000.000000', '6.910000', '2894.360000', '0.000000', '2004', '1', '2019-08-02 14:51:39', null);
INSERT INTO `st_recharge` VALUES ('61', '32', '13140033272', '17', '147258', 'rn15647325713620', '500.000000', '6.910000', '72.360000', '0.000000', '2004', '1', '2019-08-02 15:56:11', null);
INSERT INTO `st_recharge` VALUES ('62', '32', '13140033272', '17', '147258', 'rn15647326206482', '800.000000', '6.910000', '115.770000', '0.000000', '2004', '2', '2019-08-02 15:57:00', '2019-08-02 17:38:50');

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of st_user
-- ----------------------------
INSERT INTO `st_user` VALUES ('31', '15136413457', '韩寒', '52c69e3a57331081823331c4e69d3f2e', '999999', '0', '17', '147258', '直属代理', '/uploads/code/156464469013838.png', '740022', '1', '1', '1', '50.00', '1', '1', '99860.000000', '1697.240000', '2019-08-02 14:51:31', '115.60.190.26', '115.60.191.216', '2019-08-01 14:23:38', '2019-08-01 14:30:45');
INSERT INTO `st_user` VALUES ('32', '13140033272', '叶问', '52c69e3a57331081823331c4e69d3f2e', '999999', '0', '17', '147258', '直属代理', '/uploads/code/156464205199894.png', '860353', '1', '1', '1', '50.00', '1', '1', '98533.540000', '19909.560000', '2019-08-03 11:19:04', '115.60.190.194', '115.60.191.216', '2019-08-01 14:24:14', '2019-08-01 14:30:52');
INSERT INTO `st_user` VALUES ('33', '13663840507', '项国星', '52c69e3a57331081823331c4e69d3f2e', '999999', '0', '17', '147258', '直属代理', '/uploads/code/156464385250190.png', '105606', '1', '1', '1', '50.00', '1', '1', '81673.332000', '825.422000', '2019-08-02 19:32:23', '106.33.11.147', '115.60.191.216', '2019-08-01 14:25:41', '2019-08-01 14:30:56');
INSERT INTO `st_user` VALUES ('34', '13653847075', '马云', '52c69e3a57331081823331c4e69d3f2e', '999999', '0', '17', '147258', '直属代理', '/uploads/code/156464227193118.png', '850339', '1', '1', '1', '50.00', '1', '1', '102936.220000', '0.000000', '2019-08-02 16:36:05', '115.60.190.26', '115.60.191.216', '2019-08-01 14:26:08', '2019-08-01 14:33:18');
INSERT INTO `st_user` VALUES ('35', '13623857649', '杨科', '98cd2178e85f0f3ad347f403decf43d3', '908911', '0', '17', '147258', '直属代理', '/uploads/code/156464150467998.png', '571543', '1', '1', '1', '50.00', '1', '1', '98145.960000', '3978.400000', '2019-08-02 19:51:57', '117.136.75.168', '115.60.191.216', '2019-08-01 14:27:22', '2019-08-01 14:38:16');
INSERT INTO `st_user` VALUES ('36', '15736735157', '罗海林', '52c69e3a57331081823331c4e69d3f2e', '999999', '0', '17', '147258', '直属代理', '/uploads/code/156464183013095.png', '588656', '1', '1', '1', '50.00', '1', '1', '92579.832000', '1174.640000', '2019-08-02 15:19:36', '115.60.190.26', '115.60.191.216', '2019-08-01 14:27:57', '2019-08-01 14:35:42');
INSERT INTO `st_user` VALUES ('37', '13721424988', '邵枫', 'b30c9e06dd2455abc6b498c26c2e312b', 'swf225', '0', '17', '147258', '直属代理', '/uploads/code/156464171287201.png', '669166', '1', '1', '1', '50.00', '1', '1', '99349.600000', '0.000000', '2019-08-02 13:49:57', '115.60.190.26', '115.60.191.216', '2019-08-01 14:28:24', '2019-08-01 16:34:10');
INSERT INTO `st_user` VALUES ('38', '15738070600', '刘强', '52c69e3a57331081823331c4e69d3f2e', '999999', '0', '17', '147258', '直属代理', '/uploads/code/156464208994729.png', '718636', '1', '1', '1', '50.00', '1', '1', '100000.000000', '0.000000', '2019-08-02 09:03:26', '115.60.191.216', '115.60.191.216', '2019-08-01 14:28:48', '2019-08-01 14:50:36');
INSERT INTO `st_user` VALUES ('39', '19900000101', '张楠', '52c69e3a57331081823331c4e69d3f2e', '999999', '0', '17', '147258', '直属代理', null, '646100', '1', '1', '1', '50.00', '1', '1', '49849.200000', '0.000000', '2019-08-02 09:19:13', '125.47.206.111', '115.60.191.216', '2019-08-01 14:46:06', '2019-08-01 14:50:33');
INSERT INTO `st_user` VALUES ('40', '19900000102', '张亮', '52c69e3a57331081823331c4e69d3f2e', '999999', '0', '17', '147258', '直属代理', '/uploads/code/156465052171928.png', '851765', '1', '1', '1', '50.00', '1', '1', '48089.600000', '4157.076000', '2019-08-03 01:09:59', '182.126.69.208', '115.60.191.216', '2019-08-01 14:46:34', '2019-08-01 14:50:29');
INSERT INTO `st_user` VALUES ('41', '19900000103', '程宏国', '52c69e3a57331081823331c4e69d3f2e', '999999', '0', '17', '147258', '直属代理', '/uploads/code/156464236119428.png', '139958', '1', '1', '1', '50.00', '1', '1', '50000.000000', '0.000000', '2019-08-01 15:47:50', '182.120.32.211', '115.60.191.216', '2019-08-01 14:47:02', '2019-08-01 14:50:26');
INSERT INTO `st_user` VALUES ('42', '17337808380', 'zhang', '1eb54196aed4e51d932a8bc94280f2d8', 'zhang016011', '0', '18', '18937810752', '程宏国', '/uploads/code/156464573583143.png', '986164', '1', '1', '1', '1.00', '1', '1', '0.000000', '0.000000', '2019-08-01 15:48:54', '183.162.18.177', '183.162.18.177', '2019-08-01 15:43:56', '2019-08-01 16:15:30');
INSERT INTO `st_user` VALUES ('43', '19900000105', '解', '52c69e3a57331081823331c4e69d3f2e', '999999', '0', '17', '147258', '直属代理', '/uploads/code/156464767613722.png', '793937', '1', '1', '1', '50.00', '1', '1', '99360.700000', '4167.236000', '2019-08-03 01:19:58', '171.15.172.59', '115.60.191.216', '2019-08-01 16:12:49', '2019-08-01 16:16:40');

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
) ENGINE=InnoDB AUTO_INCREMENT=736 DEFAULT CHARSET=utf8 COMMENT='用户资金记录';

-- ----------------------------
-- Records of st_user_money_log
-- ----------------------------
INSERT INTO `st_user_money_log` VALUES ('578', '31', '15136413457', '韩寒', '1000', '1000', '0.000000', '100000.000000', '100000.000000', '2019-08-01 14:51:21', '3', '上分', '平台操作会员15136413457上分');
INSERT INTO `st_user_money_log` VALUES ('579', '32', '13140033272', '叶问', '1001', '1001', '0.000000', '100000.000000', '100000.000000', '2019-08-01 14:51:28', '3', '上分', '平台操作会员13140033272上分');
INSERT INTO `st_user_money_log` VALUES ('580', '33', '13663840507', '项国星', '1002', '1002', '0.000000', '100000.000000', '100000.000000', '2019-08-01 14:51:37', '3', '上分', '平台操作会员13663840507上分');
INSERT INTO `st_user_money_log` VALUES ('581', '34', '13653847075', '马云', '1004', '1004', '0.000000', '100000.000000', '100000.000000', '2019-08-01 14:51:46', '3', '上分', '平台操作会员13653847075上分');
INSERT INTO `st_user_money_log` VALUES ('582', '35', '13623857649', '杨科', '1005', '1005', '0.000000', '100000.000000', '100000.000000', '2019-08-01 14:51:57', '3', '上分', '平台操作会员13623857649上分');
INSERT INTO `st_user_money_log` VALUES ('583', '36', '15736735157', '罗海林', '1006', '1006', '0.000000', '100000.000000', '100000.000000', '2019-08-01 14:52:07', '3', '上分', '平台操作会员15736735157上分');
INSERT INTO `st_user_money_log` VALUES ('584', '37', '13721424988', '邵枫', '1007', '1007', '0.000000', '100000.000000', '100000.000000', '2019-08-01 14:52:15', '3', '上分', '平台操作会员13721424988上分');
INSERT INTO `st_user_money_log` VALUES ('585', '38', '15738070600', '刘强', '1008', '1008', '0.000000', '100000.000000', '100000.000000', '2019-08-01 14:52:21', '3', '上分', '平台操作会员15738070600上分');
INSERT INTO `st_user_money_log` VALUES ('586', '39', '19900000101', '张楠', '1009', '1009', '0.000000', '50000.000000', '50000.000000', '2019-08-01 14:52:29', '3', '上分', '平台操作会员19900000101上分');
INSERT INTO `st_user_money_log` VALUES ('587', '40', '19900000102', '张亮', '1010', '1010', '0.000000', '50000.000000', '50000.000000', '2019-08-01 14:52:35', '3', '上分', '平台操作会员19900000102上分');
INSERT INTO `st_user_money_log` VALUES ('588', '41', '19900000103', '程宏国', '1013', '1013', '0.000000', '50000.000000', '50000.000000', '2019-08-01 14:52:41', '3', '上分', '平台操作会员19900000103上分');
INSERT INTO `st_user_money_log` VALUES ('589', '34', '13653847075', '马云', '100215', '1014', '100000.000000', '150.000000', '99850.000000', '2019-08-01 14:53:13', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('590', '34', '13653847075', '马云', '100216', '1015', '99850.000000', '150.000000', '99700.000000', '2019-08-01 14:53:18', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('591', '34', '13653847075', '马云', '100217', '1016', '99700.000000', '150.000000', '99550.000000', '2019-08-01 14:53:23', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('592', '34', '13653847075', '马云', '100218', '1017', '99550.000000', '150.000000', '99400.000000', '2019-08-01 14:53:30', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('593', '34', '13653847075', '马云', '100219', '1018', '99400.000000', '150.000000', '99250.000000', '2019-08-01 14:53:36', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('594', '37', '13721424988', '邵枫', '100220', '1020', '100000.000000', '600.000000', '99400.000000', '2019-08-01 14:55:42', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('595', '37', '13721424988', '邵枫', '100220', '1021', '99400.000000', '-50.400000', '99349.600000', '2019-08-01 14:56:03', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('596', '32', '13140033272', '叶问', '100221', '1022', '100000.000000', '300.000000', '99700.000000', '2019-08-01 14:56:15', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('597', '35', '13623857649', '杨科', '100222', '1023', '100000.000000', '300.000000', '99700.000000', '2019-08-01 14:56:59', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('598', '35', '13623857649', '杨科', '100223', '1025', '99700.000000', '150.000000', '99550.000000', '2019-08-01 14:57:20', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('599', '32', '13140033272', '叶问', '100221', '1026', '99700.000000', '132.000000', '99832.000000', '2019-08-01 14:57:39', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('600', '35', '13623857649', '杨科', '100224', '1027', '99550.000000', '180.000000', '99370.000000', '2019-08-01 14:57:41', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('601', '32', '13140033272', '叶问', '100225', '1028', '99832.000000', '1500.000000', '98332.000000', '2019-08-01 14:57:49', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('602', '35', '13623857649', '杨科', '100223', '1029', '99370.000000', '35.000000', '99405.000000', '2019-08-01 14:57:49', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('603', '36', '15736735157', '罗海林', '100226', '1030', '100000.000000', '300.000000', '99700.000000', '2019-08-01 14:57:50', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('604', '36', '15736735157', '罗海林', '100226', '1031', '99700.000000', '-68.600000', '99631.400000', '2019-08-01 14:58:21', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('605', '33', '13663840507', '项国星', '100227', '1037', '100000.000000', '300.000000', '99700.000000', '2019-08-01 15:11:45', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('606', '33', '13663840507', '项国星', '100228', '1038', '99700.000000', '300.000000', '99400.000000', '2019-08-01 15:14:47', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('607', '33', '13663840507', '项国星', '100229', '1039', '99400.000000', '3000.000000', '96400.000000', '2019-08-01 15:14:54', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('608', '33', '13663840507', '项国星', '100230', '1041', '96400.000000', '1500.000000', '94900.000000', '2019-08-01 15:15:25', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('609', '33', '13663840507', '项国星', '100231', '1043', '94900.000000', '1500.000000', '93400.000000', '2019-08-01 15:15:38', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('610', '34', '13653847075', '马云', '100219', '1046', '99250.000000', '-134.000000', '99116.000000', '2019-08-01 15:20:15', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('611', '34', '13653847075', '马云', '100218', '1047', '99116.000000', '-260.000000', '98856.000000', '2019-08-01 15:20:18', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('612', '34', '13653847075', '马云', '100217', '1048', '98856.000000', '-219.500000', '98636.500000', '2019-08-01 15:20:20', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('613', '33', '13663840507', '项国星', '100228', '1049', '93400.000000', '-200.000000', '93200.000000', '2019-08-01 15:20:21', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('614', '34', '13653847075', '马云', '100216', '1050', '98636.500000', '-390.000000', '98246.500000', '2019-08-01 15:20:23', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('615', '34', '13653847075', '马云', '100215', '1051', '98246.500000', '-481.200000', '97765.300000', '2019-08-01 15:20:25', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('616', '33', '13663840507', '项国星', '100231', '1053', '93200.000000', '-505.000000', '92695.000000', '2019-08-01 15:24:49', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('617', '33', '13663840507', '项国星', '100230', '1054', '92695.000000', '-300.000000', '92395.000000', '2019-08-01 15:24:52', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('618', '33', '13663840507', '项国星', '100229', '1055', '92395.000000', '1250.000000', '93645.000000', '2019-08-01 15:24:59', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('619', '33', '13663840507', '项国星', '100227', '1056', '93645.000000', '-217.200000', '93427.800000', '2019-08-01 15:25:02', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('620', '33', '13663840507', '项国星', '100232', '1057', '93427.800000', '30.000000', '93397.800000', '2019-08-01 15:25:41', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('621', '36', '15736735157', '罗海林', '100233', '1058', '99631.400000', '300.000000', '99331.400000', '2019-08-01 15:26:44', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('622', '33', '13663840507', '项国星', '100234', '1059', '93397.800000', '30.000000', '93367.800000', '2019-08-01 15:28:18', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('623', '33', '13663840507', '项国星', '100235', '1060', '93367.800000', '30.000000', '93337.800000', '2019-08-01 15:28:23', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('624', '33', '13663840507', '项国星', '100236', '1061', '93337.800000', '30.000000', '93307.800000', '2019-08-01 15:28:27', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('625', '33', '13663840507', '项国星', '100237', '1062', '93307.800000', '30.000000', '93277.800000', '2019-08-01 15:28:31', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('626', '34', '13653847075', '马云', '100238', '1070', '97765.300000', '150.000000', '97615.300000', '2019-08-01 15:53:32', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('627', '34', '13653847075', '马云', '100239', '1071', '97615.300000', '150.000000', '97465.300000', '2019-08-01 15:53:37', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('628', '34', '13653847075', '马云', '100240', '1072', '97465.300000', '150.000000', '97315.300000', '2019-08-01 15:53:42', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('629', '34', '13653847075', '马云', '100241', '1073', '97315.300000', '150.000000', '97165.300000', '2019-08-01 15:53:45', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('630', '34', '13653847075', '马云', '100242', '1074', '97165.300000', '150.000000', '97015.300000', '2019-08-01 15:53:49', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('631', '43', '19900000105', '解', '1081', '1081', '0.000000', '50000.000000', '50000.000000', '2019-08-01 16:13:03', '3', '上分', '平台操作会员19900000105上分');
INSERT INTO `st_user_money_log` VALUES ('632', '43', '19900000105', '解', '1082', '1082', '50000.000000', '50000.000000', '100000.000000', '2019-08-01 16:13:16', '3', '上分', '平台操作会员19900000105上分');
INSERT INTO `st_user_money_log` VALUES ('633', '39', '19900000101', '张楠', '100243', '1096', '50000.000000', '30.000000', '49970.000000', '2019-08-01 16:34:29', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('634', '40', '19900000102', '张亮', '100244', '1099', '50000.000000', '30.000000', '49970.000000', '2019-08-01 16:44:43', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('635', '40', '19900000102', '张亮', '100244', '1100', '49970.000000', '-5.560000', '49964.440000', '2019-08-01 16:45:41', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('636', '33', '13663840507', '项国星', '7', '1107', '93277.800000', '500.000000', '92777.800000', '2019-08-01 17:23:46', '2', '用户提现', '用户发起提现');
INSERT INTO `st_user_money_log` VALUES ('637', '39', '19900000101', '张楠', '100243', '0', '49970.000000', '-100.000000', '49870.000000', '2019-08-01 17:30:58', '3', '平仓', '止损平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('638', '36', '15736735157', '罗海林', '100245', '1113', '99331.400000', '30.000000', '99301.400000', '2019-08-01 18:07:00', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('639', '36', '15736735157', '罗海林', '100246', '1114', '99301.400000', '300.000000', '99001.400000', '2019-08-01 18:34:23', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('640', '40', '19900000102', '张亮', '100247', '1119', '49964.440000', '300.000000', '49664.440000', '2019-08-01 19:53:26', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('641', '40', '19900000102', '张亮', '100248', '1120', '49664.440000', '360.000000', '49304.440000', '2019-08-01 20:28:32', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('642', '40', '19900000102', '张亮', '100247', '1122', '49304.440000', '-1199.800000', '48104.640000', '2019-08-01 21:36:35', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('643', '40', '19900000102', '张亮', '100248', '1123', '48104.640000', '294.960000', '48399.600000', '2019-08-01 22:03:54', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('644', '35', '13623857649', '杨科', '100222', '128', '99405.000000', '20.000000', '99385.000000', '2019-08-02 00:01:01', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('645', '35', '13623857649', '杨科', '100224', '129', '99385.000000', '20.000000', '99365.000000', '2019-08-02 00:01:01', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('646', '32', '13140033272', '叶问', '100225', '130', '98332.000000', '20.000000', '98312.000000', '2019-08-02 00:01:01', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('647', '33', '13663840507', '项国星', '100232', '131', '92777.800000', '20.000000', '92757.800000', '2019-08-02 00:01:01', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('648', '36', '15736735157', '罗海林', '100233', '132', '99001.400000', '20.000000', '98981.400000', '2019-08-02 00:01:01', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('649', '33', '13663840507', '项国星', '100234', '133', '92757.800000', '20.000000', '92737.800000', '2019-08-02 00:01:01', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('650', '33', '13663840507', '项国星', '100235', '134', '92737.800000', '20.000000', '92717.800000', '2019-08-02 00:01:01', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('651', '33', '13663840507', '项国星', '100236', '135', '92717.800000', '20.000000', '92697.800000', '2019-08-02 00:01:01', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('652', '33', '13663840507', '项国星', '100237', '136', '92697.800000', '20.000000', '92677.800000', '2019-08-02 00:01:01', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('653', '34', '13653847075', '马云', '100238', '137', '97015.300000', '20.000000', '96995.300000', '2019-08-02 00:01:01', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('654', '34', '13653847075', '马云', '100239', '138', '96995.300000', '20.000000', '96975.300000', '2019-08-02 00:01:01', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('655', '34', '13653847075', '马云', '100240', '139', '96975.300000', '20.000000', '96955.300000', '2019-08-02 00:01:01', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('656', '34', '13653847075', '马云', '100241', '140', '96955.300000', '20.000000', '96935.300000', '2019-08-02 00:01:01', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('657', '34', '13653847075', '马云', '100242', '141', '96935.300000', '20.000000', '96915.300000', '2019-08-02 00:01:01', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('658', '36', '15736735157', '罗海林', '100245', '142', '98981.400000', '20.000000', '98961.400000', '2019-08-02 00:01:01', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('659', '36', '15736735157', '罗海林', '100246', '143', '98961.400000', '20.000000', '98941.400000', '2019-08-02 00:01:01', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('660', '36', '15736735157', '罗海林', '100233', '0', '98941.400000', '-3987.220000', '94954.180000', '2019-08-02 02:44:45', '3', '平仓', '爆仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('661', '34', '13653847075', '马云', '100239', '1126', '96915.300000', '1405.000000', '98320.300000', '2019-08-02 08:59:55', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('662', '34', '13653847075', '马云', '100242', '1127', '98320.300000', '198.500000', '98518.800000', '2019-08-02 09:00:01', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('663', '34', '13653847075', '马云', '100241', '1128', '98518.800000', '425.000000', '98943.800000', '2019-08-02 09:00:04', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('664', '34', '13653847075', '马云', '100240', '1129', '98943.800000', '-27.000000', '98916.800000', '2019-08-02 09:00:07', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('665', '34', '13653847075', '马云', '100238', '1130', '98916.800000', '4244.100000', '103160.900000', '2019-08-02 09:00:15', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('666', '40', '19900000102', '张亮', '100249', '1134', '48399.600000', '300.000000', '48099.600000', '2019-08-02 09:08:59', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('667', '39', '19900000101', '张楠', '100250', '1138', '49870.000000', '60.000000', '49810.000000', '2019-08-02 09:46:31', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('668', '39', '19900000101', '张楠', '100250', '1139', '49810.000000', '39.200000', '49849.200000', '2019-08-02 09:59:42', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('669', '31', '15136413457', '韩寒', '100251', '1141', '100000.000000', '60.000000', '99940.000000', '2019-08-02 10:24:00', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('670', '31', '15136413457', '韩寒', '100252', '1142', '99940.000000', '60.000000', '99880.000000', '2019-08-02 10:25:33', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('671', '34', '13653847075', '马云', '100253', '1144', '103160.900000', '150.000000', '103010.900000', '2019-08-02 10:42:33', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('672', '34', '13653847075', '马云', '100254', '1145', '103010.900000', '150.000000', '102860.900000', '2019-08-02 10:42:39', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('673', '34', '13653847075', '马云', '100255', '1146', '102860.900000', '150.000000', '102710.900000', '2019-08-02 10:42:47', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('674', '34', '13653847075', '马云', '100256', '1147', '102710.900000', '1500.000000', '101210.900000', '2019-08-02 10:42:56', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('675', '34', '13653847075', '马云', '100257', '1148', '101210.900000', '150.000000', '101060.900000', '2019-08-02 10:43:01', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('676', '34', '13653847075', '马云', '100256', '1154', '101060.900000', '1400.000000', '102460.900000', '2019-08-02 13:52:39', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('677', '34', '13653847075', '马云', '100254', '1155', '102460.900000', '-185.000000', '102275.900000', '2019-08-02 13:53:04', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('678', '34', '13653847075', '马云', '100258', '1156', '102275.900000', '150.000000', '102125.900000', '2019-08-02 13:53:11', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('679', '34', '13653847075', '马云', '100253', '1157', '102125.900000', '174.900000', '102300.800000', '2019-08-02 13:53:19', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('680', '34', '13653847075', '马云', '100257', '1158', '102300.800000', '256.500000', '102557.300000', '2019-08-02 13:53:23', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('681', '34', '13653847075', '马云', '100259', '1159', '102557.300000', '90.000000', '102467.300000', '2019-08-02 13:53:38', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('682', '34', '13653847075', '马云', '100260', '1160', '102467.300000', '90.000000', '102377.300000', '2019-08-02 13:53:45', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('683', '34', '13653847075', '马云', '100261', '1161', '102377.300000', '90.000000', '102287.300000', '2019-08-02 13:53:59', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('684', '34', '13653847075', '马云', '100262', '1162', '102287.300000', '90.000000', '102197.300000', '2019-08-02 13:54:08', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('685', '34', '13653847075', '马云', '100263', '1163', '102197.300000', '90.000000', '102107.300000', '2019-08-02 13:54:21', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('686', '34', '13653847075', '马云', '100260', '1164', '102107.300000', '-30.000000', '102077.300000', '2019-08-02 13:54:52', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('687', '34', '13653847075', '马云', '100259', '1166', '102077.300000', '-235.080000', '101842.220000', '2019-08-02 14:35:22', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('688', '34', '13653847075', '马云', '100263', '1167', '101842.220000', '-75.900000', '101766.320000', '2019-08-02 14:35:24', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('689', '34', '13653847075', '马云', '100262', '1168', '101766.320000', '108.000000', '101874.320000', '2019-08-02 14:35:29', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('690', '34', '13653847075', '马云', '100261', '1169', '101874.320000', '5.700000', '101880.020000', '2019-08-02 14:35:32', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('691', '34', '13653847075', '马云', '100258', '1170', '101880.020000', '-95.000000', '101785.020000', '2019-08-02 14:35:34', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('692', '34', '13653847075', '马云', '100255', '1171', '101785.020000', '-32.000000', '101753.020000', '2019-08-02 14:35:37', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('693', '34', '13653847075', '马云', '100264', '1172', '101753.020000', '300.000000', '101453.020000', '2019-08-02 14:36:55', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('694', '33', '13663840507', '项国星', '8', '1175', '92677.800000', '10000.000000', '82677.800000', '2019-08-02 14:49:11', '2', '用户提现', '用户发起提现');
INSERT INTO `st_user_money_log` VALUES ('695', '43', '19900000105', '解', '100265', '1187', '100000.000000', '30.000000', '99970.000000', '2019-08-02 14:54:46', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('696', '43', '19900000105', '解', '100266', '1189', '99970.000000', '30.000000', '99940.000000', '2019-08-02 14:55:02', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('697', '43', '19900000105', '解', '100267', '1190', '99940.000000', '30.000000', '99910.000000', '2019-08-02 14:55:19', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('698', '34', '13653847075', '马云', '100264', '1191', '101453.020000', '1483.200000', '102936.220000', '2019-08-02 15:12:40', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('699', '33', '13663840507', '项国星', '100268', '1194', '82677.800000', '60.000000', '82617.800000', '2019-08-02 15:20:08', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('700', '33', '13663840507', '项国星', '100235', '1195', '82617.800000', '39.700000', '82657.500000', '2019-08-02 15:20:15', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('701', '33', '13663840507', '项国星', '100237', '1196', '82657.500000', '92.600000', '82750.100000', '2019-08-02 15:20:17', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('702', '36', '15736735157', '罗海林', '100269', '1197', '94954.180000', '150.000000', '94804.180000', '2019-08-02 15:21:36', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('703', '32', '13140033272', '叶问', '57', '0', '98312.000000', '115.770000', '98427.770000', '2019-08-02 17:12:17', '1', '自动充值', '自动充值');
INSERT INTO `st_user_money_log` VALUES ('704', '32', '13140033272', '叶问', '62', '0', '98427.770000', '115.770000', '98543.540000', '2019-08-02 17:38:50', '1', '自动充值', '自动充值');
INSERT INTO `st_user_money_log` VALUES ('705', '35', '13623857649', '杨科', '100270', '1214', '99365.000000', '30.000000', '99335.000000', '2019-08-02 19:52:09', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('706', '35', '13623857649', '杨科', '100270', '1215', '99335.000000', '-9.000000', '99326.000000', '2019-08-02 19:54:01', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('707', '43', '19900000105', '解', '100271', '1217', '99910.000000', '30.000000', '99880.000000', '2019-08-02 21:40:45', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('708', '43', '19900000105', '解', '100265', '1218', '99880.000000', '111.400000', '99991.400000', '2019-08-02 21:40:57', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('709', '43', '19900000105', '解', '100266', '1219', '99991.400000', '-1.000000', '99990.400000', '2019-08-02 21:41:00', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('710', '43', '19900000105', '解', '100271', '1220', '99990.400000', '0.880000', '99991.280000', '2019-08-02 21:41:03', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('711', '43', '19900000105', '解', '100267', '1221', '99991.280000', '-1.000000', '99990.280000', '2019-08-02 21:41:07', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('712', '43', '19900000105', '解', '100272', '1222', '99990.280000', '60.000000', '99930.280000', '2019-08-02 21:41:45', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('713', '43', '19900000105', '解', '100273', '1223', '99930.280000', '300.000000', '99630.280000', '2019-08-02 21:42:42', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('714', '43', '19900000105', '解', '100273', '1225', '99630.280000', '213.000000', '99843.280000', '2019-08-03 00:00:34', '3', '平仓', '会员平仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('715', '35', '13623857649', '杨科', '100222', '144', '99326.000000', '10.000000', '99316.000000', '2019-08-03 00:01:01', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('716', '35', '13623857649', '杨科', '100224', '145', '99316.000000', '10.000000', '99306.000000', '2019-08-03 00:01:01', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('717', '32', '13140033272', '叶问', '100225', '146', '98543.540000', '10.000000', '98533.540000', '2019-08-03 00:01:02', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('718', '33', '13663840507', '项国星', '100232', '147', '82750.100000', '10.000000', '82740.100000', '2019-08-03 00:01:02', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('719', '33', '13663840507', '项国星', '100234', '148', '82740.100000', '10.000000', '82730.100000', '2019-08-03 00:01:02', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('720', '33', '13663840507', '项国星', '100236', '149', '82730.100000', '10.000000', '82720.100000', '2019-08-03 00:01:02', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('721', '36', '15736735157', '罗海林', '100245', '150', '94804.180000', '10.000000', '94794.180000', '2019-08-03 00:01:02', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('722', '36', '15736735157', '罗海林', '100246', '151', '94794.180000', '10.000000', '94784.180000', '2019-08-03 00:01:02', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('723', '40', '19900000102', '张亮', '100249', '152', '48099.600000', '10.000000', '48089.600000', '2019-08-03 00:01:02', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('724', '31', '15136413457', '韩寒', '100251', '153', '99880.000000', '10.000000', '99870.000000', '2019-08-03 00:01:02', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('725', '31', '15136413457', '韩寒', '100252', '154', '99870.000000', '10.000000', '99860.000000', '2019-08-03 00:01:02', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('726', '33', '13663840507', '项国星', '100268', '155', '82720.100000', '10.000000', '82710.100000', '2019-08-03 00:01:02', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('727', '36', '15736735157', '罗海林', '100269', '156', '94784.180000', '10.000000', '94774.180000', '2019-08-03 00:01:02', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('728', '43', '19900000105', '解', '100272', '157', '99843.280000', '10.000000', '99833.280000', '2019-08-03 00:01:02', '3', '过夜费', '扣除过夜费');
INSERT INTO `st_user_money_log` VALUES ('729', '43', '19900000105', '解', '100272', '0', '99833.280000', '-172.580000', '99660.700000', '2019-08-03 00:19:49', '3', '平仓', '爆仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('730', '35', '13623857649', '杨科', '100224', '0', '99306.000000', '-1160.040000', '98145.960000', '2019-08-03 00:36:25', '3', '平仓', '爆仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('731', '33', '13663840507', '项国星', '100236', '0', '82710.100000', '-193.340000', '82516.760000', '2019-08-03 00:36:25', '3', '平仓', '爆仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('732', '36', '15736735157', '罗海林', '100245', '0', '94774.180000', '-85.354000', '94688.826000', '2019-08-03 00:40:57', '3', '平仓', '爆仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('733', '43', '19900000105', '解', '100274', '1228', '99660.700000', '300.000000', '99360.700000', '2019-08-03 01:20:17', '3', '建仓', '会员建仓，扣除手续费');
INSERT INTO `st_user_money_log` VALUES ('734', '33', '13663840507', '项国星', '100268', '0', '82516.760000', '-843.428000', '81673.332000', '2019-08-03 10:27:52', '3', '平仓', '爆仓，结算收益');
INSERT INTO `st_user_money_log` VALUES ('735', '36', '15736735157', '罗海林', '100269', '0', '94688.826000', '-2108.994000', '92579.832000', '2019-08-03 10:27:52', '3', '平仓', '爆仓，结算收益');

-- ----------------------------
-- Table structure for st_user_withdraw_log
-- ----------------------------
DROP TABLE IF EXISTS `st_user_withdraw_log`;
CREATE TABLE `st_user_withdraw_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(255) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `agent_name` varchar(255) DEFAULT NULL,
  `money` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `rate` decimal(20,6) NOT NULL,
  `real_money` decimal(20,6) NOT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='用户提现';

-- ----------------------------
-- Records of st_user_withdraw_log
-- ----------------------------
INSERT INTO `st_user_withdraw_log` VALUES ('7', 'uw15646514269047', '33', '13663840507', '项国星', null, null, '500.000000', '6.820000', '73.310000', '7', '项国星', '13663840507', '招商银行', '上海支行', '4874151545980000', '2', '2019-08-01 17:23:46', '2019-08-01 17:30:48', '审核通过');
INSERT INTO `st_user_withdraw_log` VALUES ('8', 'uw15647285519184', '33', '13663840507', '项国星', null, null, '10000.000000', '6.820000', '68200.000000', '7', '项国星', '13663840507', '招商银行', '上海支行', '4874151545980000', '2', '2019-08-02 14:49:11', '2019-08-02 14:50:47', '审核通过');
