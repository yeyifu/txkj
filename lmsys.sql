/*
Navicat MySQL Data Transfer

Source Server         : 本地-mysql5.7
Source Server Version : 50726
Source Host           : 127.0.0.1:3306
Source Database       : lmsys

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-12-23 16:32:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for appkey
-- ----------------------------
DROP TABLE IF EXISTS `appkey`;
CREATE TABLE `appkey` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `com_id` int(10) NOT NULL COMMENT '企业id',
  `appkey` varchar(255) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `remarks` varchar(250) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '备注',
  `enable` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '是否可用，1:可用，0不可用',
  `field2` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field3` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field4` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='秘钥表';

-- ----------------------------
-- Records of appkey
-- ----------------------------
INSERT INTO `appkey` VALUES ('1', '1', 'anx60CLdghvDmjzQBvdX0VRmYCL44aVq', '1577068762', '', '1', null, null, null);
INSERT INTO `appkey` VALUES ('2', '2', 'anx60CLdghvDsdfdfdfjhgkdssdfdgdYC', '1578276133', '', '0', null, null, null);

-- ----------------------------
-- Table structure for auth
-- ----------------------------
DROP TABLE IF EXISTS `auth`;
CREATE TABLE `auth` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `auth` varchar(25) CHARACTER SET utf8mb4 NOT NULL COMMENT '权限：system/admin/user',
  `field1` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field2` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field3` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field4` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of auth
-- ----------------------------
INSERT INTO `auth` VALUES ('1', 'system', null, null, null, null);
INSERT INTO `auth` VALUES ('2', 'admin', null, null, null, null);
INSERT INTO `auth` VALUES ('3', '  user', null, null, null, null);

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `com_name` varchar(255) CHARACTER SET utf8mb4 NOT NULL COMMENT '企业名称',
  `number` bigint(11) unsigned NOT NULL COMMENT '联系电话',
  `email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 NOT NULL COMMENT '联系人',
  `cre_address` varchar(255) CHARACTER SET utf8mb4 NOT NULL COMMENT '证件地址',
  `no_login` tinyint(2) unsigned NOT NULL COMMENT '是否禁止登陆，0否，1是',
  `no_em` tinyint(2) unsigned NOT NULL COMMENT '是否授权，0否，1是',
  `is_use` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '是否使用，0否，1是',
  `is_del` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除：0否，1是',
  `Auth_person` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '授权人',
  `field1` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `fiedl2` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field3` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field4` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field5` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='企业表';

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES ('1', '阿里巴巴集团', '18229919139', '56353454@qq.com', '马云', '杭州阿里巴巴集团', '0', '1', '0', '0', '', null, null, null, null, null);
INSERT INTO `company` VALUES ('2', '华为公司责任有限公司', '18229919878', '12155422@qq.com', '任正非', '华为科技有限公司', '0', '1', '1', '0', '', null, null, null, null, null);
INSERT INTO `company` VALUES ('17', '锤子科技', '18223355875', '345435435@qq.com', '罗永浩', '北京市中关村', '0', '1', '0', '0', '', null, null, null, null, null);
INSERT INTO `company` VALUES ('20', '搜狐科技', '14563346433', '3425465@qq.com', '张朝阳', '北京市中关村', '0', '1', '1', '0', '', null, null, null, null, null);
INSERT INTO `company` VALUES ('26', '腾讯大厦', '15466545442', '123456@qq.com', '马化腾', '深圳腾讯大厦', '0', '1', '0', '0', '', null, null, null, null, null);
INSERT INTO `company` VALUES ('27', '小米科技', '18554441127', '4587454@qq.com', '雷军', '武汉', '0', '1', '1', '0', '', null, null, null, null, null);
INSERT INTO `company` VALUES ('28', '联想集团', '13877758666', '456874@qq.com', '柳传志', '北京', '0', '1', '1', '1', '', null, null, null, null, null);
INSERT INTO `company` VALUES ('29', '一号互联科技', '1342435345', '21343535@qq.com', '赵勇', '深圳市科技生态园', '0', '1', '1', '0', '', null, null, null, null, null);
INSERT INTO `company` VALUES ('33', '复兴集团', '15475896522', '324354@qq.com', '郭广昌', '上海市黄浦区', '0', '1', '0', '0', '', null, null, null, null, null);
INSERT INTO `company` VALUES ('41', '美团', '13795845875', '2548464@qq.com', '王兴', '北京市', '0', '1', '1', '0', '', null, null, null, null, null);

-- ----------------------------
-- Table structure for empower
-- ----------------------------
DROP TABLE IF EXISTS `empower`;
CREATE TABLE `empower` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `com_id` int(10) unsigned NOT NULL COMMENT '公司id',
  `apk_id` int(11) NOT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `licence` varchar(255) CHARACTER SET utf8mb4 DEFAULT '' COMMENT '授权码',
  `hard_code` varchar(255) CHARACTER SET utf8mb4 NOT NULL COMMENT '硬件码',
  `imei` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `enable` tinyint(2) unsigned DEFAULT '1' COMMENT '是否可用：0否，1是',
  `time` int(11) DEFAULT NULL,
  `em_status` tinyint(2) DEFAULT '0' COMMENT '授权状态，0:未授权，1:已授权',
  `em_type` tinyint(2) unsigned DEFAULT '1' COMMENT '授权类型：1正式，2测试',
  `em_name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '授权用户',
  `remarks` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '备注',
  `version` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '版本号',
  `field1` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field2` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field3` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field4` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=400 DEFAULT CHARSET=utf8 COMMENT='授权表';

-- ----------------------------
-- Records of empower
-- ----------------------------
INSERT INTO `empower` VALUES ('6', '1', '1', null, '9d9bf805950ee3a5ab859a4a80c429d1', 'bb5b4b2a', '99001273093985', '0', '1578039545', '1', '1', 'admin3', null, '1578039545', null, null, null, null);
INSERT INTO `empower` VALUES ('7', '1', '1', null, 'ec2ec48bc2b8e660e5cf41401d1fe6f6', 'bb5b4b4b', '99001273055555', '0', '1578016079', '1', '1', 'admin', null, '1578016079', null, null, null, null);
INSERT INTO `empower` VALUES ('8', '1', '1', null, 'be3ba2a2dac13d636f8132a950f7127a', 'aa5b4b5a', '99991273044444', '0', '1578036113', '1', '1', 'admin3', null, '1578036113', null, null, null, null);
INSERT INTO `empower` VALUES ('9', '2', '1', null, '668f8377f0566ba671b58dcefcb5755a', 'bb5dfg2l', '9900578905985', '1', '1578378694', '1', '1', 'admin2', null, '1578378694', null, null, null, null);
INSERT INTO `empower` VALUES ('10', '2', '1', null, '01be177efff5982761a5255725393262', 'brtyfg2l', '9900578945879', '1', '1579403024', '1', '1', 'admin2', null, '1579403025', null, null, null, null);
INSERT INTO `empower` VALUES ('16', '1', '1', null, 'be314fcb0952fee945ae43e139a690d3', '6666666666', '99999999999999', '1', '1590474352', '1', '1', 'admin', null, '1590474352', null, null, null, null);
INSERT INTO `empower` VALUES ('17', '1', '1', null, 'fab1a34d998c5d7064a17477b689667c', 'bb5b4b88', '99001273093985', '1', '1590629130', '1', '1', 'user1', null, '20200520', null, null, null, null);
INSERT INTO `empower` VALUES ('18', '2', '2', null, 'f1862e092c630eb63163c7b13bf675fc', 'bb5b4b88', '99001273093985', '1', '1590737852', '1', '1', 'admin2', null, '20200520', null, null, null, null);
INSERT INTO `empower` VALUES ('19', '1', '1', null, '92a1473650697d3a2b6a575b2b083dec', 'bb5dfg2l', '9900578945879', '0', '1590629481', '1', '2', 'admin', null, '20200520', null, null, null, null);
INSERT INTO `empower` VALUES ('20', '1', '1', null, '72fc60351769d833fbe3de432933a292', '1063275', '1107498724', '1', '1590646157', '1', '1', 'admin', null, '20200520', null, null, null, null);
INSERT INTO `empower` VALUES ('362', '1', '1', null, 'c572fb18009836ffb772bb6bcd5e3c1c', '2129079', '1221513640', '1', '1590646091', '1', '1', 'admin', null, '20200520', null, null, null, null);
INSERT INTO `empower` VALUES ('363', '1', '1', null, '1cc23d72a8b7b2960497f36f06311cbd', '7345981', '1112470314', '1', '1590646771', '1', '1', 'admin', null, '20200520', null, null, null, null);
INSERT INTO `empower` VALUES ('364', '1', '1', null, '873cdd95051e69d1381e40caac25dfa2', '1916364', '1294046780', '0', '1590803231', '1', '1', 'admin', null, '20200520', null, null, null, null);
INSERT INTO `empower` VALUES ('365', '1', '1', null, '73af66f082437868298d189d5539c9c8', '7124092', '1234290227', '1', '1590646169', '1', '1', 'admin', null, '20200520', null, null, null, null);
INSERT INTO `empower` VALUES ('366', '1', '1', null, '9a6a939aa82653c540f2023cbb1f57f1', '5417904', '1279914542', '1', '1590646560', '1', '1', 'admin', null, '20200520', null, null, null, null);
INSERT INTO `empower` VALUES ('367', '1', '1', null, '', '8856537', '1228458491', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('368', '1', '1', null, '', '1321002', '1242910667', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('369', '1', '1', null, '0abfa7ddc41f62ea96c12f4b75c88289', '6822026', '1238643806', '1', '1590648278', '1', '1', 'admin', null, '20200520', null, null, null, null);
INSERT INTO `empower` VALUES ('370', '1', '1', null, '', '6934328', '1104873410', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('371', '1', '1', null, '', '2392050', '1037219079', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('372', '1', '1', null, '', '9342304', '1107298482', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('373', '1', '1', null, '', '2340299', '1345295428', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('374', '1', '1', null, '', '4490278', '1176110912', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('375', '1', '1', null, '', '1011988', '1370373689', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('376', '1', '1', null, '', '8081574', '1073819570', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('377', '1', '1', null, '', '3082921', '1242222674', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('378', '1', '1', null, '', '2554111', '1273069491', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('379', '1', '1', null, '', '6126910', '1350746785', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('380', '1', '1', null, '', '6663077', '1120860953', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('381', '1', '1', null, '', '9566507', '1042422419', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('382', '1', '1', null, '', '7886116', '1308892665', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('383', '1', '1', null, '', '9230793', '1395560710', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('384', '1', '1', null, '', '9598830', '1192840588', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('385', '1', '1', null, '', '4517243', '1109792309', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('386', '1', '1', null, '', '9316230', '1246340512', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('387', '1', '1', null, '', '9747176', '1125038447', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('388', '1', '1', null, '', '1451864', '1278358158', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('389', '1', '1', null, '', '8763278', '1325935315', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('390', '1', '1', null, '', '3984022', '1356822906', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('391', '1', '1', null, '', '4091882', '1218076639', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('392', '1', '1', null, '', '5570089', '1145124834', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('393', '1', '1', null, '', '4163047', '1408154641', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('394', '1', '1', null, '', '2520911', '1024517307', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('395', '1', '1', null, '', '9306385', '1005800403', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('396', '1', '1', null, '', '3427192', '1350449039', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('397', '1', '1', null, '', '8892528', '1174495572', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('398', '1', '1', null, '', '5769447', '1242956542', '1', null, '0', '1', null, null, null, null, null, null, null);
INSERT INTO `empower` VALUES ('399', '1', '1', null, '', '7004523', '1276505255', '1', null, '0', '1', null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for empower_copy
-- ----------------------------
DROP TABLE IF EXISTS `empower_copy`;
CREATE TABLE `empower_copy` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `com_id` int(10) unsigned NOT NULL COMMENT '公司id',
  `uuid` varchar(255) DEFAULT NULL,
  `licence` varchar(255) CHARACTER SET utf8mb4 DEFAULT '' COMMENT '授权码',
  `hard_code` varchar(255) CHARACTER SET utf8mb4 NOT NULL COMMENT '硬件码',
  `imei` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `enable` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '是否使用：0否，1是',
  `time` int(11) DEFAULT NULL,
  `em_status` tinyint(2) DEFAULT '0' COMMENT '授权状态，0:未授权，1:已授权，2停用',
  `em_type` tinyint(2) unsigned DEFAULT '0' COMMENT '授权类型：1正式，2测试',
  `em_name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '授权用户',
  `remarks` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '备注',
  `version` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '版本号',
  `field1` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field2` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field3` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field4` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='授权表';

-- ----------------------------
-- Records of empower_copy
-- ----------------------------
INSERT INTO `empower_copy` VALUES ('6', '1', null, '9d9bf805950ee3a5ab859a4a80c429d1', 'bb5b4b2a', '99001273093985', '0', '1578039545', '1', '1', 'admin3', null, '1578039545', null, null, null, null);
INSERT INTO `empower_copy` VALUES ('7', '1', null, 'ec2ec48bc2b8e660e5cf41401d1fe6f6', 'bb5b4b4b', '99001273055555', '0', '1578016079', '1', '1', 'admin', null, '1578016079', null, null, null, null);
INSERT INTO `empower_copy` VALUES ('8', '1', null, 'be3ba2a2dac13d636f8132a950f7127a', 'aa5b4b5a', '99991273044444', '0', '1578036113', '1', '1', 'admin3', null, '1578036113', null, null, null, null);
INSERT INTO `empower_copy` VALUES ('9', '2', null, '668f8377f0566ba671b58dcefcb5755a', 'bb5dfg2l', '9900578905985', '0', '1578378694', '1', '1', 'admin2', null, '1578378694', null, null, null, null);
INSERT INTO `empower_copy` VALUES ('10', '2', null, '01be177efff5982761a5255725393262', 'brtyfg2l', '9900578945879', '1', '1579403024', '1', '1', 'admin2', null, '1579403025', null, null, null, null);
INSERT INTO `empower_copy` VALUES ('16', '1', null, 'be314fcb0952fee945ae43e139a690d3', '6666666666', '99999999999999', '0', '1590474352', '1', '1', 'admin', null, '1590474352', null, null, null, null);

-- ----------------------------
-- Table structure for em_count
-- ----------------------------
DROP TABLE IF EXISTS `em_count`;
CREATE TABLE `em_count` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `com_id` int(11) unsigned NOT NULL COMMENT '企业id',
  `all_em` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '授权总数',
  `free_em` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '赠送授权数',
  `used_em` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '已使用授权数',
  `exe_em` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '透支授权额度',
  `field1` int(10) unsigned DEFAULT NULL COMMENT '预留字段',
  `field2` int(11) DEFAULT NULL COMMENT '预留字段',
  `field3` int(11) DEFAULT NULL COMMENT '预留字段',
  `field4` int(11) DEFAULT NULL COMMENT '预留字段',
  `fiedl5` int(11) DEFAULT NULL COMMENT '预留字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='企业授权数量表';

-- ----------------------------
-- Records of em_count
-- ----------------------------
INSERT INTO `em_count` VALUES ('1', '1', '100', '54', '46', '0', null, null, null, null, null);
INSERT INTO `em_count` VALUES ('6', '2', '30', '27', '3', '0', null, null, null, null, null);
INSERT INTO `em_count` VALUES ('10', '17', '50', '49', '0', '0', null, null, null, null, null);
INSERT INTO `em_count` VALUES ('11', '20', '50', '50', '0', '0', null, null, null, null, null);
INSERT INTO `em_count` VALUES ('15', '26', '120', '120', '0', '0', null, null, null, null, null);
INSERT INTO `em_count` VALUES ('20', '37', '0', '0', '0', '0', null, null, null, null, null);
INSERT INTO `em_count` VALUES ('21', '38', '100', '100', '0', '0', null, null, null, null, null);
INSERT INTO `em_count` VALUES ('22', '27', '100', '100', '0', '0', null, null, null, null, null);
INSERT INTO `em_count` VALUES ('23', '28', '55', '55', '0', '0', null, null, null, null, null);
INSERT INTO `em_count` VALUES ('31', '36', '0', '0', '0', '0', null, null, null, null, null);
INSERT INTO `em_count` VALUES ('32', '29', '55', '55', '0', '0', null, null, null, null, null);
INSERT INTO `em_count` VALUES ('34', '30', '0', '0', '0', '0', null, null, null, null, null);
INSERT INTO `em_count` VALUES ('35', '31', '0', '0', '0', '0', null, null, null, null, null);
INSERT INTO `em_count` VALUES ('36', '32', '0', '0', '0', '0', null, null, null, null, null);
INSERT INTO `em_count` VALUES ('37', '33', '20', '20', '0', '0', null, null, null, null, null);
INSERT INTO `em_count` VALUES ('38', '38', '34', '0', '0', '0', null, null, null, null, null);
INSERT INTO `em_count` VALUES ('39', '39', '43', '0', '0', '0', null, null, null, null, null);
INSERT INTO `em_count` VALUES ('40', '40', '33', '0', '0', '0', null, null, null, null, null);
INSERT INTO `em_count` VALUES ('41', '41', '55', '55', '0', '0', null, null, null, null, null);

-- ----------------------------
-- Table structure for em_log
-- ----------------------------
DROP TABLE IF EXISTS `em_log`;
CREATE TABLE `em_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `com_id` int(10) unsigned NOT NULL COMMENT '企业id',
  `company` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '公司名称',
  `action` varchar(255) CHARACTER SET utf8mb4 NOT NULL COMMENT '操作',
  `type` varchar(255) CHARACTER SET utf8mb4 NOT NULL COMMENT '类型',
  `count` int(10) unsigned NOT NULL,
  `username` varchar(255) NOT NULL,
  `time` int(11) unsigned NOT NULL,
  `remarks` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '备注',
  `field1` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field2` varchar(255) DEFAULT NULL COMMENT '预留字段',
  `field3` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field4` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field5` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='授权数量日志记录表';

-- ----------------------------
-- Records of em_log
-- ----------------------------
INSERT INTO `em_log` VALUES ('1', '1', '华为公司责任有限公司', '修改授权', '公司', '10', 'system', '1576025013', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('2', '27', '小米科技', '开启授权', '公司', '122', 'system', '1567418315', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('3', '28', '联想', '开启授权', '公司', '66', 'system', '1577517315', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('4', '29', '美团', '开启授权', '公司', '55', 'system', '1577518315', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('5', '29', '一号互联科技', '开启授权', '公司', '100', 'system', '1578984609', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('6', '30', '', '开启授权', '公司', '0', 'system', '1578984678', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('7', '31', '阿里', '开启授权', '公司', '0', 'system', '1578984816', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('8', '32', '', '开启授权', '公司', '0', 'system', '1578984901', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('9', '33', '环球复兴', '开启授权', '公司', '22', 'system', '1578987242', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('10', '37', '111', '开启授权', '公司', '333', 'systems', '1579334795', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('11', '38', '222', '开启授权', '公司', '34', 'systems', '1579335421', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('12', '39', '333', '开启授权', '公司', '43', 'systems', '1579335584', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('13', '40', '美团', '开启授权', '公司', '33', 'systems', '1579335870', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('14', '41', '美团', '开启授权', '公司', '55', 'systems', '1579336009', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('15', '1', '华为公司责任有限公司', '增加授权数10', '公司', '10', 'systems', '1579339310', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('16', '1', '华为公司责任有限公司', '增加授权数10', '公司', '10', 'systems', '1579339553', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('17', '1', '华为公司责任有限公司', '增加授权数10', '公司', '10', 'systems', '1579339694', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('18', '20', '搜狐科技', '增加授权数', '公司', '38', 'systems', '1579394825', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('19', '1', '华为公司责任有限公司', '增加授权数', '公司', '5', 'systems', '1584694073', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('20', '1', '华为公司责任有限公司', '减少授权数', '公司', '10', 'systems', '1584695655', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('21', '27', '小米科技', '减少授权数', '公司', '22', 'systems', '1585721045', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('22', '33', '复兴集团', '减少授权数', '公司', '2', 'systems', '1585807026', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('23', '26', '腾讯大厦', '增加授权数', '公司', '27', 'systems', '1585807192', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('24', '26', '腾讯大厦', '减少授权数', '公司', '50', 'systems', '1585807280', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('25', '26', '腾讯大厦', '增加授权数', '公司', '10', 'systems', '1585807294', '', null, null, null, null, null);
INSERT INTO `em_log` VALUES ('26', '26', '腾讯大厦', '增加授权数', '公司', '10', 'systems', '1585807363', '', null, null, null, null, null);

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `com_id` int(10) unsigned NOT NULL COMMENT '公司id',
  `time` int(11) unsigned NOT NULL,
  `action` varchar(255) NOT NULL,
  `info` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `company` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `action_name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '操作用户',
  `field1` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field2` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field3` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field4` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=245 DEFAULT CHARSET=utf8 COMMENT='操作日志表';

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES ('1', '0', '1576639695', '添加', '企业列表', '华为', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('2', '0', '1576639695', '添加', '企业列表', '华为', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('3', '0', '1576658230', '修改', '', '华为公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('4', '0', '1576658535', '修改', '', '阿里巴巴', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('5', '0', '1576658699', '修改', '企业资料', '阿里巴巴', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('6', '0', '1576658771', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('7', '0', '1576661353', '删除', '企业资料', '锤子科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('8', '0', '1576661437', '添加', '企业资料', '锤子科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('9', '0', '1576661474', '添加', '企业资料', '佛挡杀佛', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('10', '0', '1576661507', '删除', '企业资料', '佛挡杀佛', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('11', '0', '1576661955', '添加', '企业资料', '辅导费', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('12', '0', '1576661961', '删除', '企业资料', '辅导费', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('13', '0', '1576663325', '添加', '企业资料', 'fsdf', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('14', '0', '1576663331', '删除', '企业资料', 'fsdf', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('15', '0', '1576663458', '删除', '企业资料', '锤子科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('16', '0', '1576663554', '删除', '企业资料', '京东商城', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('17', '0', '1576663614', '删除', '企业资料', '百度科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('18', '0', '1576663711', '添加', '企业资料', '百度科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('19', '0', '1576667482', '删除', '企业资料', '百度科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('20', '0', '1576667519', '添加', '企业资料', '锤子科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('21', '0', '1576667567', '添加', '企业资料', '百度科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('22', '0', '1576675195', '添加', '企业资料', '腾讯科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('23', '0', '1576763309', '修改', '企业资料', '阿里巴巴集团', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('24', '0', '1577088878', '删除', '企业资料', '腾讯科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('25', '0', '1577088880', '删除', '企业资料', '百度科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('26', '0', '1577168953', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('27', '0', '1577172508', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('28', '0', '1577172575', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('29', '0', '1577173485', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('30', '0', '1577174921', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('31', '0', '1577174945', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('32', '0', '1577174973', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('33', '0', '1577175940', '修改', '企业资料', '阿里巴巴集团', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('34', '0', '1577183364', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('35', '0', '1577329441', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('36', '0', '1577329475', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('37', '0', '1577329878', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('38', '0', '1577342947', '修改', '企业资料', '阿里巴巴集团', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('39', '0', '1577349496', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('40', '0', '1577349517', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('41', '0', '1577349525', '修改', '企业资料', '阿里巴巴集团', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('42', '0', '1577349751', '修改', '企业资料', '锤子科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('43', '0', '1577351141', '修改', '企业资料', '阿里巴巴集团', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('44', '0', '1577351268', '修改', '企业资料', '锤子科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('45', '0', '1577351345', '修改', '企业资料', '锤子科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('46', '0', '1577351363', '修改', '企业资料', '锤子科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('47', '0', '1577359391', '修改', '企业资料', '阿里巴巴集团', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('48', '0', '1577359413', '修改', '企业资料', '阿里巴巴集团', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('49', '0', '1577362054', '修改', '企业资料', '锤子科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('50', '0', '1577365278', '修改', '企业资料', '锤子科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('51', '0', '1577366697', '修改', '企业资料', '锤子科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('52', '0', '1577367749', '修改', '企业资料', '锤子科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('53', '0', '1577367770', '修改', '企业资料', '锤子科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('54', '0', '1577368089', '修改', '企业资料', '锤子科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('55', '0', '1577432291', '删除', '企业资料', '腾讯科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('56', '0', '1577432646', '添加', '企业资料', '腾讯科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('57', '0', '1577432855', '添加', '企业资料', '腾讯科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('58', '0', '1577434106', '删除', '企业资料', '腾讯科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('59', '0', '1577434256', '删除', '企业资料', '腾讯科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('60', '0', '1577434297', '添加', '企业资料', '腾讯大厦', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('61', '0', '1577442554', '删除', '企业资料', '', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('62', '0', '1577442748', '删除', '企业资料', '百度科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('63', '0', '1577502039', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('64', '0', '1577502057', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('65', '0', '1577502085', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('66', '0', '1577516445', '修改', '企业资料', '联想', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('67', '0', '1577516584', '修改', '企业资料', '联想', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('68', '0', '1577517635', '删除', '企业资料', '', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('69', '0', '1577518152', '修改', '企业资料', '联想', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('70', '0', '1577518187', '修改', '企业资料', '联想集团', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('71', '0', '1577518220', '修改', '企业资料', '联想集团', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('74', '0', '1577667285', '修改', '企业资料', '搜狐科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('75', '0', '1577754021', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('76', '0', '1577773795', '修改', '企业资料', '华为公司责任有限公司', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('77', '1', '1578304609', '禁用', '授权信息', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('78', '1', '1578305570', '启用', '授权信息', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('79', '1', '1578306018', '禁用', '授权信息', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('80', '1', '1578306043', '启用', '授权账号:99001273093985', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('81', '1', '1578306279', '禁用', '授权信息', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('82', '1', '1578306378', '启用', '授权账号:99001273093985', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('83', '1', '1578306403', '禁用', '授权信息', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('84', '1', '1578306499', '启用', '授权账号:99991273055555', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('85', '1', '1578306507', '启用', '授权账号:99991273055555', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('86', '1', '1578306538', '禁用', '授权账号:99991273055555', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('87', '1', '1578306700', '启用', '授权账号:99001273055555', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('88', '1', '1578307022', '启用', '授权账号:99991273044444', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('89', '1', '1578307028', '禁用', '授权账号:99001273093985', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('90', '1', '1578307146', '启用', '授权账号:99001273093985', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('91', '1', '1578362368', '禁用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('92', '2', '1578364904', '启用', '授权账号:99001273093985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('93', '1', '1578378249', '禁用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('94', '1', '1578378271', '启用', '授权账号:99001273055555', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('95', '1', '1578378363', '启用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('96', '2', '1578378704', '禁用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('97', '2', '1578378712', '启用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('98', '2', '1578378763', '禁用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('99', '2', '1578378788', '启用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('100', '2', '1578379816', '禁用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('101', '2', '1578379952', '启用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('102', '2', '1578380018', '禁用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('103', '2', '1578380502', '启用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('104', '2', '1578380609', '禁用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('105', '2', '1578380654', '启用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('106', '2', '1578380939', '禁用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('107', '2', '1578380974', '启用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('108', '2', '1578381009', '禁用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('109', '2', '1578381062', '启用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('110', '2', '1578381291', '启用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('111', '2', '1578381900', '禁用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('112', '2', '1578381930', '启用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('113', '2', '1578381980', '启用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('114', '2', '1578382053', '禁用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('115', '2', '1578382329', '启用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('116', '2', '1578382545', '禁用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('117', '2', '1578382551', '启用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('118', '2', '1578382627', '禁用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('119', '2', '1578383333', '启用', '授权账号:32435456', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('120', '2', '1578383524', '启用', '授权账号:32435456', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('121', '2', '1578383755', '启用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('122', '2', '1578383954', '禁用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('123', '2', '1578384004', '启用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('124', '2', '1578384018', '禁用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('125', '2', '1578384219', '启用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('126', '2', '1578384524', '禁用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('127', '2', '1578384594', '启用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('128', '2', '1578384617', '禁用', '授权账号:9900578905985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('129', '1', '1578384725', '禁用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('130', '2', '1578385595', '启用', '授权账号:9900578945879', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('131', '1', '1578386522', '启用', '授权账号:99001273093985', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('132', '1', '1578386574', '禁用', '授权账号:99001273093985', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('133', '1', '1578386651', '禁用', '授权账号:99001273055555', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('134', '0', '1578564911', '删除', '企业资料', '美团', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('135', '0', '1578565707', '删除', '企业资料', '联想集团', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('136', '0', '1578565767', '删除', '企业资料', '联想集团', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('137', '0', '1578881267', '修改', '企业资料', '锤子科技', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('138', '0', '1578984915', '删除', '企业资料', '', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('139', '0', '1578984919', '删除', '企业资料', '', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('140', '0', '1578984923', '删除', '企业资料', '', 'system', null, null, null, null);
INSERT INTO `log` VALUES ('141', '1', '1579158053', '启用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('142', '1', '1579315585', '禁用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('143', '1', '1579315587', '启用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('144', '0', '1579330359', '修改', '企业资料', '复兴集团', 'systems', null, null, null, null);
INSERT INTO `log` VALUES ('145', '0', '1579330470', '修改', '企业资料', '复兴', 'systems', null, null, null, null);
INSERT INTO `log` VALUES ('146', '0', '1579330482', '修改', '企业资料', '复兴集团', 'systems', null, null, null, null);
INSERT INTO `log` VALUES ('147', '0', '1579337808', '修改', '企业资料', '华为公司责任有限公司', 'systems', null, null, null, null);
INSERT INTO `log` VALUES ('148', '0', '1579339360', '修改', '企业资料', '华为公司责任有限公司', 'systems', null, null, null, null);
INSERT INTO `log` VALUES ('149', '0', '1579339554', '修改', '企业资料', '华为公司责任有限公司', 'systems', null, null, null, null);
INSERT INTO `log` VALUES ('150', '0', '1579339694', '修改', '企业资料', '华为公司责任有限公司', 'systems', null, null, null, null);
INSERT INTO `log` VALUES ('151', '0', '1579348679', '修改', '企业资料', '华为公司责任有限公司', 'systems', null, null, null, null);
INSERT INTO `log` VALUES ('152', '0', '1579394825', '修改', '企业资料', '搜狐科技', 'systems', null, null, null, null);
INSERT INTO `log` VALUES ('153', '1', '1579403171', '禁用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('154', '1', '1579403173', '启用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('155', '1', '1579403208', '启用', '授权账号:99001273055555', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('156', '1', '1579403210', '禁用', '授权账号:99991273044444', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('157', '1', '1579403220', '禁用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('158', '1', '1579405828', '启用', '授权账号:99001273093985', '', 'user1', null, null, null, null);
INSERT INTO `log` VALUES ('159', '1', '1579414060', '启用', '授权账号:99991273044444', '', 'user1', null, null, null, null);
INSERT INTO `log` VALUES ('160', '1', '1579414064', '禁用', '授权账号:99991273044444', '', 'user1', null, null, null, null);
INSERT INTO `log` VALUES ('161', '1', '1579414066', '启用', '授权账号:99991273044444', '', 'user1', null, null, null, null);
INSERT INTO `log` VALUES ('162', '1', '1579414190', '禁用', '授权账号:99991273044444', '', 'user1', null, null, null, null);
INSERT INTO `log` VALUES ('163', '1', '1579415121', '禁用', '授权账号:99001273093985', '', 'user1', null, null, null, null);
INSERT INTO `log` VALUES ('164', '1', '1579415143', '启用', '授权账号:99001273093985', '', 'user1', null, null, null, null);
INSERT INTO `log` VALUES ('165', '1', '1579415268', '禁用', '授权账号:99001273093985', '', 'user1', null, null, null, null);
INSERT INTO `log` VALUES ('166', '1', '1579416254', '禁用', '授权账号:99001273055555', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('167', '1', '1579416275', '启用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('168', '1', '1579416291', '启用', '授权账号:99991273044444', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('169', '1', '1579422153', '禁用', '授权账号:99001273093985', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('170', '1', '1579422431', '启用', '授权账号:99001273093985', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('171', '1', '1579422920', '启用', '授权账号:99991273044444', '', 'user1', null, null, null, null);
INSERT INTO `log` VALUES ('172', '1', '1580448207', '启用', '授权账号:ez991520', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('173', '1', '1580448220', '启用', '授权账号:ez991520', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('174', '1', '1580452777', '启用', '授权账号:ez991520', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('175', '1', '1580453161', '启用', '授权账号:ez991520', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('176', '1', '1580454073', '启用', '授权账号:ez991520', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('177', '1', '1580454154', '启用', '授权账号:ez991520', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('178', '1', '1580454171', '启用', '授权账号:ez991520', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('179', '1', '1580454295', '启用', '授权账号:ez991520', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('180', '1', '1580454417', '启用', '授权账号:ez991520', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('181', '1', '1580454648', '启用', '授权账号:ez991520', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('182', '1', '1580454818', '启用', '授权账号:ez991520', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('183', '1', '1580454834', '禁用', '授权账号:ez991520', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('184', '1', '1580454866', '启用', '授权账号:ez991520', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('185', '1', '1580454904', '禁用', '授权账号:ez991520', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('186', '1', '1580454971', '启用', '授权账号:ez991520', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('187', '1', '1580455108', '禁用', '授权账号:ez991520', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('188', '1', '1580455178', '启用', '授权账号:ez991520', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('189', '1', '1580455185', '禁用', '授权账号:ez991520', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('190', '1', '1580455245', '禁用', '授权账号:99991273044444', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('191', '1', '1580455252', '启用', '授权账号:99991273044444', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('192', '1', '1580455313', '启用', '授权账号:99001273093985', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('193', '1', '1580455317', '禁用', '授权账号:99991273044444', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('194', '1', '1580455319', '启用', '授权账号:99001273055555', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('195', '1', '1580455322', '禁用', '授权账号:99001273055555', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('196', '1', '1580455325', '启用', '授权账号:99991273044444', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('197', '1', '1580455328', '禁用', '授权账号:99001273093985', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('198', '1', '1580455335', '启用', '授权账号:99001273093985', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('199', '1', '1580455338', '禁用', '授权账号:99991273044444', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('200', '1', '1580455592', '禁用', '授权账号:99001273093985', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('201', '1', '1580455595', '启用', '授权账号:99991273044444', '', 'admin3', null, null, null, null);
INSERT INTO `log` VALUES ('202', '1', '1580456160', '启用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('203', '1', '1580456164', '禁用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('204', '1', '1580456279', '禁用', '授权账号:99991273044444', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('205', '1', '1580456354', '启用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('206', '1', '1580456518', '禁用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('207', '1', '1580456593', '启用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('208', '1', '1580456596', '启用', '授权账号:99991273044444', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('209', '1', '1580456599', '启用', '授权账号:99001273055555', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('210', '1', '1580456602', '禁用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('211', '1', '1580456604', '禁用', '授权账号:99991273044444', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('212', '1', '1580456607', '禁用', '授权账号:99001273055555', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('213', '1', '1580456611', '启用', '授权账号:99991273044444', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('214', '1', '1580545220', '禁用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('215', '1', '1580545242', '启用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('216', '1', '1580545255', '禁用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('217', '1', '1580545278', '禁用', '授权账号:99991273044444', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('218', '1', '1580545320', '启用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('219', '1', '1580545348', '启用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('220', '1', '1580545392', '禁用', '授权账号:99991273044444', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('221', '1', '1580545735', '启用', '授权账号:9900578945879', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('222', '1', '1580552232', '禁用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('223', '1', '1580630459', '启用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('224', '1', '1580630479', '禁用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('225', '1', '1580630558', '启用', '授权账号:99991273044444', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('226', '1', '1580630561', '禁用', '授权账号:99991273044444', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('227', '1', '1583995212', '启用', '授权账号:99001273093985', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('228', '1', '1585807363', '修改', '企业资料', '腾讯大厦', 'systems', null, null, null, null);
INSERT INTO `log` VALUES ('229', '1', '1590474933', '启用', '授权账号:99001273055555', '', 'user1', null, null, null, null);
INSERT INTO `log` VALUES ('230', '1', '1590474961', '启用', '授权账号:99991273044444', '', 'user1', null, null, null, null);
INSERT INTO `log` VALUES ('231', '1', '1590479374', '启用', '授权账号:99001273055555', '', '叶一夫', null, null, null, null);
INSERT INTO `log` VALUES ('232', '1', '1590479444', '启用', '授权账号:99001273055555', '', '叶一夫', null, null, null, null);
INSERT INTO `log` VALUES ('233', '1', '1590480186', '启用', '授权账号:99999999999999', '', '叶一夫', null, null, null, null);
INSERT INTO `log` VALUES ('234', '1', '1590480190', '禁用', '授权账号:99999999999999', '', '叶一夫', null, null, null, null);
INSERT INTO `log` VALUES ('235', '1', '1590629327', '启用', '授权账号:99999999999999', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('236', '1', '1590630252', '禁用', '授权账号:9900578945879', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('237', '1', '1590634913', '上传文件', '批量导入iemi码,硬件码', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('238', '1', '1590646004', '上传文件', '批量导入iemi码,硬件码', '', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('239', '1', '1590646771', '完成授权', '授权账号：1112470314', '华为公司责任有限公司', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('240', '1', '1590648278', '完成授权', '授权账号：1238643806', '华为公司责任有限公司', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('241', '1', '1590650935', '删除用户', '名称:，账号:', '', 'systems', null, null, null, null);
INSERT INTO `log` VALUES ('242', '2', '1590737852', '完成授权', '授权账号：99001273093985', '', 'admin2', null, null, null, null);
INSERT INTO `log` VALUES ('243', '1', '1590803231', '完成授权', '授权账号：1294046780', '华为公司责任有限公司', 'admin', null, null, null, null);
INSERT INTO `log` VALUES ('244', '1', '1590804779', '禁用', '授权账号:1294046780', '', 'admin', null, null, null, null);

-- ----------------------------
-- Table structure for map
-- ----------------------------
DROP TABLE IF EXISTS `map`;
CREATE TABLE `map` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL COMMENT 'phone表id',
  `longitude` varchar(50) CHARACTER SET utf8mb4 NOT NULL COMMENT '经度坐标',
  `latitude` varchar(50) CHARACTER SET utf8mb4 NOT NULL COMMENT '纬度坐标',
  `address` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '坐标地点',
  `create_time` bigint(20) unsigned DEFAULT NULL COMMENT '记录写入时间',
  `time` bigint(20) unsigned DEFAULT NULL COMMENT '时间',
  `field1` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '保留字段',
  `field2` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '保留字段',
  `field3` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '保留字段',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='手机定位信息表';

-- ----------------------------
-- Records of map
-- ----------------------------
INSERT INTO `map` VALUES ('5', '1', '114.063392', '22.544018', '福田站', '1586319288', '1586318378', null, null, null);
INSERT INTO `map` VALUES ('1', '1', '114.034647', '22.615831', '深圳市北站', '1586230048', '1586106454', null, null, null);
INSERT INTO `map` VALUES ('2', '1', '114.018549', '22.582465', '塘朗山公园', '1586110336', '1586106458', null, null, null);
INSERT INTO `map` VALUES ('3', '1', '114.045663', '22.603159', '白石龙公园', '1586229846', '1586106456', null, null, null);
INSERT INTO `map` VALUES ('4', '1', '114.123759', '22.538143', '深圳站', '1586319937', '1586318387', null, null, null);
INSERT INTO `map` VALUES ('6', '1', '114.109047', '22.552302', '荔枝公园1', '1586325500', '1586318389', null, null, null);
INSERT INTO `map` VALUES ('7', '1', '114.109049', '22.551352', '荔枝公园2', '1586325542', '1586318389', '', '', '');
INSERT INTO `map` VALUES ('8', '2', '114.101049', '22.552352', '地点1', '1586325542', '1586308389', '', '', '');
INSERT INTO `map` VALUES ('9', '2', '114.102049', '22.553352', '地点2', '1586325542', '158631839', '', '', '');
INSERT INTO `map` VALUES ('10', '2', '114.103049', '22.554352', '地点3', '1586325542', '1586328389', '', '', '');
INSERT INTO `map` VALUES ('11', '2', '114.100049', '22.555352', '地点4', '1586325542', '1586338389', '', '', '');
INSERT INTO `map` VALUES ('12', '3', '114.103549', '22.556452', '地点名1', '1586325542', '1586308389', '', '', '');
INSERT INTO `map` VALUES ('13', '3', '114.108949', '22.557652', '地点名2', '1586325542', '158631839', '', '', '');
INSERT INTO `map` VALUES ('14', '3', '114.106449', '22.553952', '地点名3', '1586325542', '1586328389', '', '', '');
INSERT INTO `map` VALUES ('15', '3', '114.101049', '22.557752', '地点名4', '1586325542', '1586338389', '', '', '');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `auth` tinyint(2) unsigned NOT NULL COMMENT '权限类型：1:system 2:admin 3:user',
  `pre_menu` varchar(255) CHARACTER SET utf8mb4 NOT NULL COMMENT '上级菜单',
  `menu` varchar(255) CHARACTER SET utf8mb4 NOT NULL COMMENT '菜单',
  `url` varchar(255) CHARACTER SET utf8mb4 NOT NULL COMMENT 'url路由',
  `type` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '菜单打开方式',
  `hidden` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏：0否，1是',
  `field1` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field2` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field3` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field4` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='菜单表';

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '1', '系统管理员', '主页信息', '/Index/index', '0', '0', null, null, null, null);
INSERT INTO `menu` VALUES ('2', '1', '系统管理员', '授权日志', '/Empowers/index', '0', '0', null, null, null, null);
INSERT INTO `menu` VALUES ('3', '1', '系统管理员', '企业列表', '/Company/index', '0', '1', null, null, null, null);
INSERT INTO `menu` VALUES ('4', '2', '企业管理员', '企业信息', '/Company/info', '0', '0', null, null, null, null);
INSERT INTO `menu` VALUES ('5', '1', '系统管理员', '操作日志', '/Logs/system', '0', '0', null, null, null, null);
INSERT INTO `menu` VALUES ('6', '2', '企业管理员', '管理员列表', '/User/info', '0', '0', null, null, null, null);
INSERT INTO `menu` VALUES ('7', '2', '系统管理员', '用户列表', '/User/lists', '0', '0', null, null, null, null);
INSERT INTO `menu` VALUES ('8', '2', '企业管理员', '授权列表', '/Company/empower', '0', '0', null, null, null, null);
INSERT INTO `menu` VALUES ('9', '2', '企业管理员', '操作日志', '/Logs/admin', '0', '0', null, null, null, null);
INSERT INTO `menu` VALUES ('10', '3', '企业用户', '企业信息', '/User/index', '0', '0', null, null, null, null);
INSERT INTO `menu` VALUES ('11', '3', '企业用户', '授权列表', '/User/empower', '0', '1', null, null, null, null);
INSERT INTO `menu` VALUES ('13', '3', '企业用户', '授权列表', '/Company/empower', '0', '0', null, null, null, null);
INSERT INTO `menu` VALUES ('14', '3', '企业用户', '操作日志', '/Logs/user', '0', '0', null, null, null, null);
INSERT INTO `menu` VALUES ('15', '1', '短信验证码', '短信验证码', '/Sendsms/Sendsms', '0', '1', null, null, null, null);
INSERT INTO `menu` VALUES ('16', '2', '短信验证码', '短信验证码', '/Sendsms/Sendsms', '0', '1', '', '', '', '');
INSERT INTO `menu` VALUES ('17', '3', '短信验证码', '短信验证码', '/Sendsms/Sendsms', '0', '1', '', '', '', '');

-- ----------------------------
-- Table structure for phone_info
-- ----------------------------
DROP TABLE IF EXISTS `phone_info`;
CREATE TABLE `phone_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imei` varchar(50) CHARACTER SET utf8mb4 NOT NULL COMMENT 'imei码',
  `licence` varchar(125) CHARACTER SET utf8mb4 NOT NULL COMMENT '授权信息',
  `gms_signal` int(10) unsigned DEFAULT NULL COMMENT 'gms信号强度',
  `wifi_signal` int(50) unsigned DEFAULT NULL COMMENT 'wifi信号强度',
  `emei1` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT 'emei2码',
  `emei2` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT 'emei2码',
  `system_version` varchar(25) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '系统版本',
  `hard_type` varchar(125) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '硬件类型',
  `rom_version` varchar(125) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT 'rom版本',
  `em_info` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '授权信息',
  `time` bigint(20) unsigned DEFAULT NULL COMMENT '写入记录时间',
  `field1` varchar(125) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '保留字段',
  `field2` varchar(125) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '保留字段',
  `field3` varchar(125) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '保留字段',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='手机信息表';

-- ----------------------------
-- Records of phone_info
-- ----------------------------
INSERT INTO `phone_info` VALUES ('1', '99001273093985', '9d9bf805950ee3a5ab859a4a80c429d1', '99', '100', '356214020564360', '356214020564361', 'Android10.0.1', 'redmi', 'anx60CLdghvDmjzQBvdX0VRmYCL44aVq', '已授权', null, null, null, null);
INSERT INTO `phone_info` VALUES ('2', '99002435455454', 'fdsfd4wer346sd4fdf5f4ds4f3d5fd5f5f4', '97', '99', '578578575785587', '575757524524973', 'Android10.0.1', 'redmi', '5fds13f1df1ds35f41f3ds1f3s5d4fds1fsd2', '已授权', null, null, null, null);
INSERT INTO `phone_info` VALUES ('3', '99004665656456', 'fsdf4151fdsf13d1fd53f13d1f3d1f3d1s', '99', '100', '783212420486242', '752124687245254', 'Android10.01', 'huawei', '4fsd51f2v1xd3v1fdhhgfj1gj2gh1j3g4fh31f', '已授权', null, null, null, null);
INSERT INTO `phone_info` VALUES ('4', '99003145422115', 'f4d54fd3f3df1d4db4gf5jg1jy4jy541h5', '100', '100', '75421656201526', '128468534225422', 'Android10.0.3', 'vivo', '5sd5g4dfh1fgh1d5h3xdfh2g1j35gf4hg2df', '已授权', null, null, null, null);
INSERT INTO `phone_info` VALUES ('5', '99001255544547', '4565fd45gh454hytjymk1m5b5gfb54s', '80', '60', '27862452574587', '428578520412422', 'Android9.1.13', 'oppo', 'yjk54hg4nb56gf43nb1gf51nbf54vc21b35', '已授权', null, null, null, null);

-- ----------------------------
-- Table structure for phone_set
-- ----------------------------
DROP TABLE IF EXISTS `phone_set`;
CREATE TABLE `phone_set` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `interval` int(10) unsigned DEFAULT NULL COMMENT '数据上传时间间隔',
  `url` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '通信url',
  `screen` tinyint(2) unsigned DEFAULT NULL COMMENT '禁止锁屏',
  `conservation` tinyint(2) unsigned DEFAULT NULL COMMENT '关闭节能',
  `white_list` tinyint(2) unsigned DEFAULT NULL COMMENT '白名单',
  `list_info` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '白名单列表信息',
  `record` tinyint(2) unsigned DEFAULT NULL COMMENT '启动通话录音',
  `restart` tinyint(2) unsigned DEFAULT NULL COMMENT '重启设备',
  `resume_factory` tinyint(2) unsigned DEFAULT NULL COMMENT '恢复出厂设置',
  `diagnostic` tinyint(2) unsigned DEFAULT NULL COMMENT '开启诊断模式',
  `diagnostic_log` tinyint(2) unsigned DEFAULT NULL COMMENT '下载诊断日志',
  `wechat_back` tinyint(3) unsigned DEFAULT NULL COMMENT '开启微信文件备份',
  `update_time` bigint(20) unsigned DEFAULT NULL COMMENT '修改时间戳',
  `field1` varchar(125) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '保留字段',
  `field2` tinyint(2) unsigned DEFAULT NULL COMMENT '保留字段',
  `field3` tinyint(2) unsigned DEFAULT NULL COMMENT '保留字段',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='手机指令表';

-- ----------------------------
-- Records of phone_set
-- ----------------------------
INSERT INTO `phone_set` VALUES ('1', '1', '60', 'http://romsir/info', '1', '1', '0', '1', '0', '0', '1', '1', '1', '1', '1586102453', null, null, null);
INSERT INTO `phone_set` VALUES ('2', '2', '70', 'http://romsir/info', '1', '1', '1', '1', '1', '0', '1', '1', '1', '1', '1586102453', '', null, null);
INSERT INTO `phone_set` VALUES ('3', '3', '70', 'http://romsir/info', '0', '1', '1', '1', '1', '1', '1', '1', '0', '1', '1586102453', '', null, null);
INSERT INTO `phone_set` VALUES ('4', '4', '80', 'http://romsir/info', '1', '1', '0', '1', '1', '1', '1', '1', '1', '0', '1586102453', '', null, null);
INSERT INTO `phone_set` VALUES ('5', '5', '65', 'http://romsir/info', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '1586102453', '', null, null);

-- ----------------------------
-- Table structure for sms
-- ----------------------------
DROP TABLE IF EXISTS `sms`;
CREATE TABLE `sms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone` bigint(12) unsigned NOT NULL COMMENT '手机号',
  `smscode` int(10) unsigned NOT NULL COMMENT '短信验证码',
  `create_time` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='短信验证表';

-- ----------------------------
-- Records of sms
-- ----------------------------
INSERT INTO `sms` VALUES ('6', '18229919139', '38902282', '1601013594');
INSERT INTO `sms` VALUES ('7', '18229919135', '88888888', '1590806676');
INSERT INTO `sms` VALUES ('8', '13714162534', '88888888', '1590806676');
INSERT INTO `sms` VALUES ('9', '18229919136', '88888888', '1590806676');
INSERT INTO `sms` VALUES ('10', '18229919875', '88888888', '1590806676');
INSERT INTO `sms` VALUES ('11', '18229919744', '88888888', '1590806676');
INSERT INTO `sms` VALUES ('12', '18229919845', '88888888', '1590806676');
INSERT INTO `sms` VALUES ('13', '18329919137', '88888888', '1590806676');
INSERT INTO `sms` VALUES ('14', '13620200516', '88888888', '1590806676');
INSERT INTO `sms` VALUES ('15', '18229919888', '88888888', '1590806676');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` tinyint(2) unsigned NOT NULL COMMENT '用户类型：0系统/1用户/2管理员',
  `com_id` int(11) unsigned NOT NULL COMMENT '企业id',
  `username` varchar(255) CHARACTER SET utf8mb4 NOT NULL COMMENT '用户名',
  `code` int(10) unsigned DEFAULT NULL COMMENT '登陆验证码',
  `phone` bigint(11) NOT NULL,
  `login_flag` tinyint(4) unsigned NOT NULL COMMENT '禁止登陆：0否,1是',
  `create_time` int(11) unsigned NOT NULL,
  `last_time` int(11) unsigned DEFAULT NULL,
  `is_del` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除 0:否，1:是',
  `field1` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field2` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field3` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field4` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  `field5` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '预留字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', '1', 'systems', '66666666', '18229919139', '0', '1575737594', '1601013611', '0', null, null, null, null, null);
INSERT INTO `users` VALUES ('2', '2', '1', 'admin', '66666666', '18229919845', '0', '1575734691', '1590806761', '0', null, null, null, null, null);
INSERT INTO `users` VALUES ('3', '3', '1', 'user1', '66666666', '18329919137', '0', '1575734000', '1590808202', '0', null, null, null, null, null);
INSERT INTO `users` VALUES ('4', '2', '2', 'admin2', '66666666', '18229919136', '0', '1576024013', '1590741336', '0', null, null, null, null, null);
INSERT INTO `users` VALUES ('5', '2', '1', 'admin4', '66666666', '18229919135', '0', '1576024013', '1590475009', '0', '', '', '', '', '');
INSERT INTO `users` VALUES ('6', '2', '17', 'admin4', '66666666', '18229919188', '0', '1575734591', '1575738791', '0', '', '', '', '', '');
INSERT INTO `users` VALUES ('7', '3', '1', 'user2', '66666666', '1544444444', '0', '1577691106', '1578304119', '0', null, null, null, null, null);
INSERT INTO `users` VALUES ('8', '3', '2', 'user3', '66666666', '15666666666', '0', '1578276760', '1578278686', '0', null, null, null, null, null);
INSERT INTO `users` VALUES ('9', '3', '1', 'user3', '66666666', '16789545647', '0', '1579395815', '1579403785', '0', null, null, null, null, null);
INSERT INTO `users` VALUES ('10', '1', '0', 'root', '66666666', '13714162534', '0', '1583288507', '1583310516', '0', null, null, null, null, null);
INSERT INTO `users` VALUES ('11', '1', '0', 'system1', null, '13620200516', '0', '1583299659', '1585737176', '0', null, null, null, null, null);
INSERT INTO `users` VALUES ('12', '2', '1', '叶一夫', null, '18229919888', '0', '1584322962', '1590484487', '0', null, null, null, null, null);
INSERT INTO `users` VALUES ('13', '3', '1', 'user7', null, '14567897777', '0', '1584694892', null, '0', null, null, null, null, null);
INSERT INTO `users` VALUES ('14', '3', '1', 'user8', null, '15887458744', '0', '1584696121', null, '0', null, null, null, null, null);
INSERT INTO `users` VALUES ('15', '2', '1', 'admin', null, '5', '0', '1584699434', null, '1', null, null, null, null, null);
INSERT INTO `users` VALUES ('16', '3', '1', 'user5', null, '11111', '0', '1584699473', null, '0', null, null, null, null, null);
