-- MySQL dump 10.13  Distrib 5.6.45, for Linux (x86_64)
--
-- Host: localhost    Database: ys
-- ------------------------------------------------------
-- Server version	5.6.45-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `about`
--

DROP TABLE IF EXISTS `about`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '内容',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about`
--

LOCK TABLES `about` WRITE;
/*!40000 ALTER TABLE `about` DISABLE KEYS */;
INSERT INTO `about` VALUES (1,'关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们',1571109865,1571109401);
/*!40000 ALTER TABLE `about` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `name` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `thumb` int(11) NOT NULL DEFAULT '1' COMMENT '管理员头像',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `login_time` int(11) DEFAULT '0' COMMENT '最后登录时间',
  `login_ip` varchar(100) DEFAULT '' COMMENT '最后登录ip',
  `admin_cate_id` int(2) NOT NULL DEFAULT '1' COMMENT '管理员分组',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `admin_cate_id` (`admin_cate_id`) USING BTREE,
  KEY `nickname` (`nickname`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','admin','39cd50b004741be7c72ad82f1f68a2ac',1,1510885948,1568791654,1589423236,'161.117.6.16',1),(2,'管理员','ys','9eb2b9ad495a75f80f9cf67ed08bbaae',1,1571727847,1571727856,1573714500,'220.134.74.208',2);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_cate`
--

DROP TABLE IF EXISTS `admin_cate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `permissions` text NOT NULL COMMENT '权限菜单',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `desc` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `name` (`name`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_cate`
--

LOCK TABLES `admin_cate` WRITE;
/*!40000 ALTER TABLE `admin_cate` DISABLE KEYS */;
INSERT INTO `admin_cate` VALUES (1,'超级管理员','1,3,2,4,5,6,7,8,9,10,11,12,13,14,16,17,18,19,20,21,22,23,30,24,25,27,26,28,29,31,32,33,34,35,36,37,38,39,40,41',0,1571126687,'超级管理员'),(2,'ys','1,6,7,16,17,18,19,20,21,22,23,30,27,26,31,32,33,34,35,36,37,38,39,40,41',1571727830,1571727950,'');
/*!40000 ALTER TABLE `admin_cate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_log`
--

DROP TABLE IF EXISTS `admin_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_menu_id` int(11) NOT NULL DEFAULT '0' COMMENT '操作菜单id',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '操作者id',
  `ip` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '操作ip',
  `operation_id` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '操作关联id',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '操作时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `admin_id` (`admin_id`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_log`
--

LOCK TABLES `admin_log` WRITE;
/*!40000 ALTER TABLE `admin_log` DISABLE KEYS */;
INSERT INTO `admin_log` VALUES (1,0,1,'114.107.21.60','',1568789920),(2,0,1,'114.107.21.60','1',1568791654),(3,0,1,'114.107.21.60','',1568791697),(4,0,1,'114.107.21.60','',1568791709),(5,0,1,'60.168.68.220','1',1568963685),(6,0,1,'60.168.68.220','20',1568964965),(7,0,1,'60.168.68.220','21',1568965084),(8,0,1,'60.168.68.220','1',1568970615),(9,0,1,'60.168.68.220','22',1569030931),(10,0,1,'60.168.68.220','23',1569031225),(11,0,1,'60.168.68.220','23',1569031241),(12,0,1,'60.168.68.220','1',1569031247),(13,0,1,'161.117.1.118','',1569055912),(14,0,1,'60.168.68.220','1',1569056105),(15,0,1,'180.103.147.185','',1569227233),(16,0,1,'221.218.170.129','',1569251556),(17,0,1,'114.107.20.164','',1569288762),(18,0,1,'114.107.20.164','1',1569288897),(19,0,1,'117.67.217.171','',1569383205),(20,0,1,'117.68.155.254','',1569633710),(21,0,1,'117.68.155.254','1',1569633799),(22,0,1,'60.168.68.14','',1569650431),(23,0,1,'60.168.68.14','',1569746506),(24,0,1,'60.168.68.14','1',1569811720),(25,0,1,'60.166.89.7','',1569821497),(26,0,1,'36.33.36.49','',1570002583),(27,0,1,'60.166.88.95','',1570497395),(28,0,1,'60.166.88.95','',1570504314),(29,0,1,'117.68.155.209','1',1570589380),(30,0,1,'117.68.155.209','',1570610711),(31,0,1,'117.68.155.209','',1570670043),(32,0,1,'117.68.155.209','1',1570678671),(33,0,1,'60.166.88.116','',1570692559),(34,0,1,'35.241.76.65','',1570848415),(35,0,1,'60.168.69.130','1',1570862031),(36,0,1,'60.168.69.130','',1571015094),(37,0,1,'117.67.157.145','',1571036715),(38,0,1,'117.67.157.145','',1571041132),(39,0,1,'117.67.157.145','',1571107134),(40,0,1,'117.67.157.145','1',1571126687),(41,0,1,'117.67.157.145','',1571188540),(42,0,1,'117.67.157.145','',1571188563),(43,0,1,'117.67.157.145','',1571188583),(44,0,1,'117.67.157.145','',1571188608),(45,0,1,'117.67.157.145','',1571188623),(46,0,1,'117.67.157.145','',1571188650),(47,0,1,'117.67.157.145','',1571188696),(48,0,1,'117.67.157.145','',1571188726),(49,0,1,'60.168.69.90','',1571274259),(50,0,1,'60.168.69.90','',1571304030),(51,0,1,'60.168.69.90','',1571360747),(52,0,1,'114.107.20.177','',1571637094),(53,0,1,'114.107.20.177','',1571645360),(54,0,1,'114.107.20.177','',1571645827),(55,0,1,'114.107.20.56','',1571727243),(56,0,1,'114.107.20.56','2',1571727830),(57,0,1,'114.107.20.56','2',1571727847),(58,0,1,'114.107.20.56','2',1571727856),(59,0,2,'114.107.20.56','',1571727869),(60,0,1,'114.107.20.56','2',1571727890),(61,0,1,'114.107.20.56','2',1571727922),(62,0,1,'114.107.20.56','2',1571727950),(63,0,2,'114.107.20.56','',1571728015),(64,0,2,'101.9.21.26','',1571728038),(65,0,2,'60.249.34.175','',1571728299),(66,0,1,'114.107.20.56','',1571792028),(67,0,2,'220.132.206.232','',1571845310),(68,0,1,'117.68.155.61','',1571906523),(69,0,1,'60.166.89.72','',1572227297),(70,0,1,'60.166.89.72','',1572227365),(71,0,2,'220.134.74.208','',1573144372),(72,0,1,'117.67.137.87','',1573550805),(73,0,2,'39.8.65.151','',1573652113),(74,0,2,'220.132.118.107','',1573652499),(75,0,1,'114.102.137.195','',1573655465),(76,0,1,'60.168.69.206','',1573698527),(77,0,2,'220.134.74.208','',1573714500),(78,0,1,'114.107.20.75','',1574323481),(79,0,1,'117.67.217.167','',1575516017),(80,0,1,'35.241.76.65','',1575549650),(81,0,1,'117.67.218.137','',1576220379),(82,0,1,'117.67.218.137','',1577349998),(83,0,1,'117.67.218.137','',1578014859),(84,0,1,'161.117.6.16','',1584586606),(85,0,1,'161.117.6.16','',1586487759),(86,0,1,'161.117.6.16','',1589423236);
/*!40000 ALTER TABLE `admin_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_menu`
--

DROP TABLE IF EXISTS `admin_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `module` varchar(50) NOT NULL DEFAULT '' COMMENT '模块',
  `controller` varchar(100) NOT NULL DEFAULT '' COMMENT '控制器',
  `function` varchar(100) NOT NULL DEFAULT '' COMMENT '方法',
  `parameter` varchar(50) NOT NULL DEFAULT '' COMMENT '参数',
  `description` varchar(250) NOT NULL DEFAULT '' COMMENT '描述',
  `is_display` int(1) NOT NULL DEFAULT '1' COMMENT '1显示在左侧菜单2只作为节点',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '1权限节点2普通节点',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级菜单0为顶级菜单',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `icon` varchar(100) NOT NULL DEFAULT '' COMMENT '图标',
  `is_open` int(1) NOT NULL DEFAULT '0' COMMENT '0默认闭合1默认展开',
  `orders` int(11) NOT NULL DEFAULT '0' COMMENT '排序值，越小越靠前',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `module` (`module`) USING BTREE,
  KEY `controller` (`controller`) USING BTREE,
  KEY `function` (`function`) USING BTREE,
  KEY `is_display` (`is_display`) USING BTREE,
  KEY `type` (`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='系统菜单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_menu`
--

LOCK TABLES `admin_menu` WRITE;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` VALUES (1,'系统','','','','','系统设置。',1,1,0,0,1568787872,'fa-cog',1,1),(2,'系统菜单排序','admin','menu','orders','','系统菜单排序。',2,1,3,1517562047,1517562047,'',0,0),(3,'系统菜单','admin','menu','index','','系统菜单管理',1,1,1,0,1568787842,'fa-share-alt',0,0),(4,'新增/修改系统菜单','admin','menu','publish','','新增/修改系统菜单.',2,1,3,1516948769,1516948769,'',0,0),(5,'删除系统菜单','admin','menu','delete','','删除系统菜单。',2,1,3,1516948857,1516948857,'',0,0),(6,'个人信息','admin','admin','personal','','个人信息修改。',1,1,1,1516949435,1516949435,'fa-user',0,0),(7,'修改密码','admin','admin','editpassword','','管理员修改个人密码。',1,1,1,1516949702,1517619887,'fa-unlock-alt',0,0),(8,'管理员','','','','','会员管理。',1,1,0,1516950991,1568787881,'fa-users',0,2),(9,'管理员','admin','admin','index','','系统管理员列表。',1,1,8,1516951163,1568787886,'fa-user',0,0),(10,'新增/修改管理员','admin','admin','publish','','新增/修改系统管理员。',2,1,9,1516951224,1516951224,'',0,0),(11,'删除管理员','admin','admin','delete','','删除管理员。',2,1,9,1516951253,1516951253,'',0,0),(12,'权限组','admin','admin','admincate','','权限分组。',1,1,8,1516951353,1568787890,'fa-dot-circle-o',0,0),(13,'新增/修改权限组','admin','admin','admincatepublish','','新增/修改权限组。',2,1,12,1516951483,1516951483,'',0,0),(14,'删除权限组','admin','admin','admincatedelete','','删除权限组。',2,1,12,1516951515,1516951515,'',0,0),(15,'管理员登录','admin','common','login','','管理员登录。',2,2,0,1516954517,1568788029,'',0,0),(16,'最新消息','','','','','',1,1,0,1568872724,1568872724,'fa-envelope-open-o',0,3),(17,'消息列表','admin','Information','index','','',1,1,16,1568872893,1568872893,'fa-envelope-open-o',0,0),(18,'首页轮播','','','','','',1,1,0,1568876692,1568876692,'fa-image',0,4),(19,'轮播图列表','admin','Carousel','index','','',1,1,18,1568877013,1568946683,'fa-image',0,0),(20,'媒合流程','','','','','',1,1,0,1568964965,1568964965,'fa-plus-square',0,5),(21,'媒合流程','admin','matchprocess','index','','',1,1,20,1568965084,1568965084,'fa-plus-square',0,0),(22,'月嫂','','','','','',1,1,0,1569030931,1569030931,'fa-moon-o',0,9),(23,'月嫂入驻申请','admin','matron','index','','',1,1,22,1569031225,1569031241,'fa-neuter',0,0),(24,'关于我们','','','','','',1,1,0,1569051905,1569051923,'fa-user-circle',0,6),(25,'关于我们','admin','About','index','','',1,1,24,1569052025,1569053185,'fa-user-circle',0,0),(26,'优惠券列表','admin','coupon','index','','',1,1,27,1569203252,1569221894,'fa-money',0,0),(27,'优惠券','','','','','',1,1,0,1569203267,1569203267,'fa-money',0,10),(28,'用户协议','','','','','',1,1,0,1569291575,1569291575,'fa-handshake-o',0,7),(29,'用户协议','admin','Agreement','index','','',1,1,28,1569291649,1569292333,'fa-handshake-o',0,0),(30,'月嫂列表','admin','matron','index2','','',1,1,22,1569466066,1569466066,'fa-reorder',0,0),(31,'订单','','','','','',1,1,0,1569729623,1569729623,'fa-credit-card',0,11),(32,'订单列表','admin','order','index','','',1,1,31,1569729662,1569729662,'fa-align-justify',0,0),(33,'佣金','','','','','',1,1,0,1569807552,1569807552,'fa-diamond',0,12),(34,'佣金设置','admin','commission','setting','','',1,1,33,1569807604,1569807604,'fa-cog fa-fw',0,0),(35,'佣金记录','admin','commission','index','','',1,1,33,1570527030,1570585423,'fa-align-justify',0,0),(36,'请假申请','','','','','',1,1,0,1570676037,1570676037,'fa fa-calendar-check-o',0,13),(37,'请假申请','admin','Apply','index','','',1,1,36,1570676117,1570676117,'fa fa-calendar-check-o',0,0),(38,'评价管理','','','','','',1,1,0,1570775112,1570775512,'fa-edit',0,14),(39,'评价列表','admin','evaluate','index','','',1,1,38,1570775563,1570775563,'fa-align-justify',0,0),(40,'用户','','','','','',1,1,0,1571125472,1571125874,'fa fa-user-o',0,8),(41,'用户信息','admin','user','index','','',1,1,40,1571125538,1571125538,'fa fa-user-o',0,0);
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agreement`
--

DROP TABLE IF EXISTS `agreement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agreement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '内容',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agreement`
--

LOCK TABLES `agreement` WRITE;
/*!40000 ALTER TABLE `agreement` DISABLE KEYS */;
INSERT INTO `agreement` VALUES (1,'用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议用户协议',1571109874,1571109874);
/*!40000 ALTER TABLE `agreement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apply`
--

DROP TABLE IF EXISTS `apply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordersn` varchar(255) NOT NULL DEFAULT '' COMMENT '订单号',
  `matron_id` int(11) NOT NULL DEFAULT '0' COMMENT '月嫂id',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '类型  1事假  2病假  3产假  4其他',
  `reason` varchar(255) NOT NULL DEFAULT '' COMMENT '请假事由',
  `start_time` int(11) NOT NULL DEFAULT '0' COMMENT '开始时间',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '结束时间',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apply`
--

LOCK TABLES `apply` WRITE;
/*!40000 ALTER TABLE `apply` DISABLE KEYS */;
INSERT INTO `apply` VALUES (42,'',78,1,'结婚',1571155200,1571155200,1571205351),(43,'2019101696445',78,1,'结婚',1571155200,1571241600,1571205418);
/*!40000 ALTER TABLE `apply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attachment`
--

DROP TABLE IF EXISTS `attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module` char(15) NOT NULL DEFAULT '' COMMENT '所属模块',
  `filename` char(50) NOT NULL DEFAULT '' COMMENT '文件名',
  `filepath` char(200) NOT NULL DEFAULT '' COMMENT '文件路径+文件名',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `fileext` char(10) NOT NULL DEFAULT '' COMMENT '文件后缀',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '会员ID',
  `uploadip` char(15) NOT NULL DEFAULT '' COMMENT '上传IP',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未审核1已审核-1不通过',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '审核者id',
  `audit_time` int(11) NOT NULL DEFAULT '0' COMMENT '审核时间',
  `use` varchar(200) NOT NULL COMMENT '用处',
  `download` int(11) NOT NULL DEFAULT '0' COMMENT '下载量',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `filename` (`filename`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='附件表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachment`
--

LOCK TABLES `attachment` WRITE;
/*!40000 ALTER TABLE `attachment` DISABLE KEYS */;
INSERT INTO `attachment` VALUES (1,'admin','0f1ffc451e7573eac2bdbdedfc108866.jpeg','/uploads/admin/admin_thumb/20190918/2825d8da4dd603c345c56767d13e3165.jpg',31709,'jpeg',1,'117.67.157.139',1,1568701903,1,1568701903,'admin_thumb',0);
/*!40000 ALTER TABLE `attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carousel`
--

DROP TABLE IF EXISTS `carousel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `img_path` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '图片路径',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carousel`
--

LOCK TABLES `carousel` WRITE;
/*!40000 ALTER TABLE `carousel` DISABLE KEYS */;
INSERT INTO `carousel` VALUES (16,0,'/uploads/20191016/a7768e5aee0d7bd2dc513d79da20afa1.png',1571192176,1571192176),(17,20,'/uploads/20191016/c7b506c1148ab741c77dfb92e06e316d.png',1571192189,1571368090),(18,10,'/uploads/20191016/38f3a94125bd6d060339b1f4f7372a9a.png',1571213954,1571368079);
/*!40000 ALTER TABLE `carousel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commission_log`
--

DROP TABLE IF EXISTS `commission_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commission_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matron_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `ordersn` varchar(255) NOT NULL DEFAULT '',
  `commission` decimal(10,2) NOT NULL DEFAULT '0.00',
  `days` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commission_log`
--

LOCK TABLES `commission_log` WRITE;
/*!40000 ALTER TABLE `commission_log` DISABLE KEYS */;
INSERT INTO `commission_log` VALUES (4,79,51,'2019101619101',9660.00,26,1571214092,1571214092),(5,77,50,'2019101646596',7384.61,30,1571297285,1571297285),(6,78,47,'2019101696445',14800.00,26,1571389771,1571389771),(7,78,48,'2019101659092',14960.00,26,1571389786,1571389786),(8,79,54,'2019111396223',9660.00,26,1573653263,1573653263);
/*!40000 ALTER TABLE `commission_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commission_setting`
--

DROP TABLE IF EXISTS `commission_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commission_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `star` int(11) NOT NULL DEFAULT '0' COMMENT '2到6为 二星月嫂 三星月嫂 以此类推 7为金牌月嫂 8为月子管家',
  `proportion` int(11) NOT NULL DEFAULT '0' COMMENT '佣金比例 80就是80%',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commission_setting`
--

LOCK TABLES `commission_setting` WRITE;
/*!40000 ALTER TABLE `commission_setting` DISABLE KEYS */;
INSERT INTO `commission_setting` VALUES (1,2,20),(2,3,30),(3,4,40),(4,5,50),(5,6,60),(6,7,70),(7,8,80);
/*!40000 ALTER TABLE `commission_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon`
--

DROP TABLE IF EXISTS `coupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `face_value` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '优惠券面值',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1为新人券  2为普通券',
  `validity_time` int(11) NOT NULL DEFAULT '0' COMMENT '领取后的有效期  单位 天',
  `full` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单金额满多少可用 0为无门槛',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '1为正常启用 0为禁用',
  `total` int(11) NOT NULL DEFAULT '0' COMMENT '优惠券总数量',
  `receive_num` int(11) NOT NULL DEFAULT '0' COMMENT '优惠券已领取数量',
  `start_time` int(11) NOT NULL DEFAULT '0' COMMENT '优惠券可以开始领取时间',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '优惠券结束领取时间',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon`
--

LOCK TABLES `coupon` WRITE;
/*!40000 ALTER TABLE `coupon` DISABLE KEYS */;
INSERT INTO `coupon` VALUES (19,'新人优惠',200.00,1,10,300.00,1,100,3,1569859200,1575043200,1571192565,1571192565);
/*!40000 ALTER TABLE `coupon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon_log`
--

DROP TABLE IF EXISTS `coupon_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupon_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `coupon_id` int(11) NOT NULL DEFAULT '0' COMMENT '优惠券id',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '优惠券标题',
  `face_value` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '优惠券面值',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1为新人券  2为普通券',
  `validity_time` int(11) NOT NULL DEFAULT '0' COMMENT '领取后的有效期  单位 天',
  `full` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单金额满多少可用 0为无门槛',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '优惠券领取时间',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0为已使用 1为未使用',
  `expire_time` int(11) NOT NULL DEFAULT '0' COMMENT '到期时间',
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon_log`
--

LOCK TABLES `coupon_log` WRITE;
/*!40000 ALTER TABLE `coupon_log` DISABLE KEYS */;
INSERT INTO `coupon_log` VALUES (19,6,19,'新人优惠',200.00,1,10,300.00,1571193237,0,1572057237,1571193237),(20,7,19,'新人优惠',200.00,1,10,300.00,1571205190,0,1572069190,1571205190),(21,8,19,'新人优惠',200.00,1,10,300.00,1572832359,1,1573696359,1572832359);
/*!40000 ALTER TABLE `coupon_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluate`
--

DROP TABLE IF EXISTS `evaluate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `b_nursing` int(11) NOT NULL DEFAULT '0' COMMENT '宝宝护理',
  `early_education` int(11) NOT NULL DEFAULT '0' COMMENT '宝宝早教',
  `collocation` int(11) NOT NULL DEFAULT '0' COMMENT '膳食搭配',
  `feed` int(11) NOT NULL DEFAULT '0' COMMENT '科学喂养',
  `m_nursing` int(11) NOT NULL DEFAULT '0' COMMENT '产妇护理',
  `communicate` int(11) NOT NULL DEFAULT '0' COMMENT '沟通技巧',
  `order_id` int(11) NOT NULL DEFAULT '0' COMMENT '订单id',
  `matron_id` int(11) NOT NULL DEFAULT '0' COMMENT '月嫂id',
  `content` text NOT NULL COMMENT '评价内容',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluate`
--

LOCK TABLES `evaluate` WRITE;
/*!40000 ALTER TABLE `evaluate` DISABLE KEYS */;
INSERT INTO `evaluate` VALUES (6,1,1,1,1,1,2,47,78,'测试评价1',1571205128,1571196165),(7,4,3,4,4,5,5,50,77,'张阿姨做菜很好吃，特别是煲汤手艺一流，张阿姨做菜很好吃，特别是煲汤手艺一流，张阿姨做菜很好吃，特别是煲汤手艺一流',1571206058,1571206058);
/*!40000 ALTER TABLE `evaluate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `information`
--

DROP TABLE IF EXISTS `information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `img` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `text` text NOT NULL COMMENT '纯文本内容',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `information`
--

LOCK TABLES `information` WRITE;
/*!40000 ALTER TABLE `information` DISABLE KEYS */;
INSERT INTO `information` VALUES (14,10,'/uploads/20191018/a689b0e481755c5871b5f18d5e3ddc49.png','新生儿脐带护理4步走，做错一步都可能引发感染','<p style=\"text-align:center\"><img src=\"/ueditor/php/upload/image/20191018/1571362471611569.png\" title=\"1571362471611569.png\" alt=\"1571362471611569.png\" width=\"478\" height=\"335\"/></p><p style=\"text-align: center; text-indent: 0em;\"><br/></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">新生儿脐部是月嫂工作观察的重点，也是重要的护理项目。小宝宝出生后脐带结扎，脐部有少量的黄色分泌物或血性分泌物这都属于正常现象，还会有轻度的红肿，个别小宝宝由于哭得较多，脐部会有凸起。就要做到每天的严密观察，尤其是脐部分泌物的性状，一般7到10天脐带就会干燥、脱落，也有的宝宝经过两周多脱落。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"text-indent: 0em;\"><span style=\"font-size: 14px;\"><strong>1.不要摩擦到脐带</strong></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><strong><br/></strong></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">要给宝宝选择合适大小的纸尿裤，千万不要让纸尿裤的腰标在宝宝的脐带根部。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">要不然宝宝活动的时候很容易摩擦到脐带根部，导致破皮发红，甚至出血。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><strong><br/></strong></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"></span></p><p style=\"white-space: normal; text-indent: 0em;\"><span style=\"font-size: 14px;\"><strong>2.要保持脐带位置干燥</strong></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\"><strong><br/></strong></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\">在脐带脱落前后，要保证脐带位置的干燥。</span></p><p style=\"white-space: normal; text-indent: 2em;\"><br/></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\">脐带一旦被水或者尿液弄湿，要立即用干棉球或者干净柔软的纱布擦干，然后用碘伏消毒。</span></p><p style=\"white-space: normal; text-indent: 2em;\"><br/></p><p style=\"white-space: normal; text-indent: 0em;\"><span style=\"font-size: 14px;\"><strong>3.避免接触到抚触油</strong></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\"><strong><br/></strong></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\">如果给宝宝用抚触油按摩，但切记不要涂到脐带根部，一面脐带感染。</span></p><p style=\"white-space: normal; text-indent: 2em;\"><br/></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\">除了抚触油、各种面霜、乳液也不行。</span></p><p style=\"white-space: normal; text-indent: 2em;\"><br/></p><p style=\"white-space: normal; text-indent: 0em;\"><span style=\"font-size: 14px;\"><strong>4.做好消毒</strong></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\">每天要给宝宝的脐带做1~2次的消毒，用棉签和碘伏绕着起到根部轻轻擦拭，不要用力过度，一面戳破感染。</span></p><p style=\"white-space: normal; text-indent: 2em;\"><br/></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\">一般来说，宝宝的脐带1~2周左右会脱落，如果2周了还没有脱落，只要没有红肿或者化脓等感染现象就不必担心。</span></p><p style=\"white-space: normal; text-indent: 2em;\"><br/></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\">一旦出现宝宝肚脐周围出血、变红、有渗出物、肿胀，以及宝宝出现发热不舒服的症状，有可能脐带感染，就要赶紧待宝宝去医院。</span></p><p style=\"white-space: normal; text-indent: 2em;\"><br/></p><p style=\"white-space: normal; text-indent: 0em;\"><span style=\"background-color: rgb(255, 0, 0); font-size: 14px;\"><strong><span style=\"font-size: 14px; background-color: rgb(255, 255, 255); color: rgb(255, 0, 0);\">脐部护理具体步骤</span></strong><br/></span></p><p style=\"text-indent: 2em;\"><br/></p><p style=\"text-align: center; text-indent: 0em;\"><img src=\"/ueditor/php/upload/image/20191018/1571363901499860.png\" title=\"1571363901499860.png\" alt=\"image.png\"/></p><p style=\"text-indent: 2em;\"><br/></p><p style=\"text-indent: 0em;\"><span style=\"color: rgb(255, 0, 0); font-size: 14px;\"><strong>月嫂手部消毒</strong></span></p><p style=\"text-indent: 2em;\"><span style=\"color: rgb(255, 0, 0); font-size: 14px;\"><strong><br/></strong></span></p><p style=\"text-indent: 2em;\"><span style=\"color: rgb(0, 0, 0); font-size: 14px;\">取一根医用棉签蘸酒精后，消毒月嫂自己的手指，即与宝宝脐部皮肤接触的两个手指。然后如下图操作。</span></p><p style=\"text-align: center; text-indent: 0em;\"><span style=\"color: rgb(0, 0, 0); font-size: 14px;\"><img src=\"/ueditor/php/upload/image/20191018/1571364181789772.png\" title=\"1571364181789772.png\" alt=\"image.png\"/></span></p><p style=\"text-align: center; text-indent: 0em;\"><img src=\"/ueditor/php/upload/image/20191018/1571364189890996.png\" title=\"1571364189890996.png\" alt=\"image.png\"/></p><p style=\"text-indent: 2em;\"><br/></p><p style=\"text-indent: 2em;\"><br/></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">用一只手轻轻提起未脱落的脐带残端或用拇指及食指轻轻展开脐部皮肤，使脐根部完全暴露。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">另一只手由脐根依次由内向外顺时针擦拭。</span></p><p style=\"text-align: center; text-indent: 0em;\"><span style=\"font-size: 14px;\"><strong><img src=\"/ueditor/php/upload/image/20191018/1571364376196726.png\" title=\"1571364376196726.png\" alt=\"image.png\"/></strong></span></p><p style=\"text-align: center; text-indent: 0em;\"><span style=\"font-size: 14px;\"><strong><img src=\"/ueditor/php/upload/image/20191018/1571364386950573.png\" title=\"1571364386950573.png\" alt=\"image.png\"/></strong></span></p><p style=\"text-align: center; text-indent: 0em;\"><span style=\"font-size: 14px;\"><strong><img src=\"/ueditor/php/upload/image/20191018/1571364393537620.png\" title=\"1571364393537620.png\" alt=\"image.png\"/></strong></span></p><p style=\"text-indent: 2em;\"><br/></p><p style=\"text-indent: 2em;\"><span style=\"color: rgb(255, 0, 0); font-size: 14px;\">注意：<span style=\"font-size: 14px; color: rgb(0, 0, 0);\">消毒时不要只消毒肚脐表面，要往脐部里面深一点消毒，消毒时不要离开宝宝，尽量缩短消毒时间。</span></span></p><p style=\"text-indent: 2em;\"><span style=\"color: rgb(255, 0, 0); font-size: 14px;\"><br/></span></p><p style=\"text-indent: 2em;\"><span style=\"color: rgb(255, 0, 0); font-size: 14px;\"><span style=\"font-size: 14px; color: rgb(255, 0, 0); text-indent: 32px;\">特别说明：</span><span style=\"font-size: 14px; text-indent: 32px; color: rgb(0, 0, 0);\">同一根棉签切不可重复使用哦！三只棉签用尽，完整的脐部消毒就完成了，最后不要忘了护住宝宝脐部。重要的是，要保持脐部的干燥，干燥，干燥！</span></span></p><p style=\"text-indent: 2em;\"><span style=\"text-indent: 32px; color: rgb(255, 0, 0); font-size: 14px;\"><br/></span></p><p style=\"text-indent: 2em;\"><span style=\"text-indent: 32px; color: rgb(255, 0, 0); font-size: 14px;\">脐部护理不到位出现的感染的现象很多，<span style=\"text-indent: 32px; font-size: 14px; color: rgb(0, 0, 0);\">在小编身边就有好几起，都是我的朋友，跟他们说了感染严重宝宝是需要住院。最后还是没听话，后来一问才知道原来他们一给宝宝消毒时宝宝就哭，舍不得下手。余额舍不得，宝宝反而越受罪了。</span></span></p><p style=\"text-indent: 2em;\"><span style=\"text-indent: 32px; color: rgb(255, 0, 0); font-size: 14px;\"><br/></span></p><p style=\"text-indent: 0em;\"><span style=\"color: rgb(255, 0, 0); font-size: 14px;\"><strong>月嫂警惕！以下情况需要就医</strong></span></p><p style=\"text-align: center; text-indent: 0em;\"><span style=\"color: rgb(255, 0, 0); font-size: 14px;\"><strong><img src=\"/ueditor/php/upload/image/20191018/1571364605160532.png\" title=\"1571364605160532.png\" alt=\"image.png\"/></strong></span></p><p style=\"text-indent: 2em;\"><span style=\"color: rgb(255, 0, 0); font-size: 14px;\"><strong><br/></strong></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px; color: rgb(0, 0, 0);\">1 脓液（粘性白色，黄色或绿色液体渗出）</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px; color: rgb(0, 0, 0);\"><br/></span></p><p style=\"text-indent: 2em;\"><span style=\"text-indent: 32px; font-size: 14px; color: rgb(0, 0, 0);\">2 周围皮肤发红或肿胀</span></p><p style=\"text-indent: 2em;\"><span style=\"text-indent: 32px; font-size: 14px; color: rgb(0, 0, 0);\"><br/></span></p><p style=\"text-indent: 2em;\"><span style=\"text-indent: 32px; font-size: 14px; color: rgb(0, 0, 0);\">3 腋窝有异味</span></p><p style=\"text-indent: 2em;\"><span style=\"text-indent: 32px; font-size: 14px; color: rgb(0, 0, 0);\"><br/></span></p><p style=\"text-indent: 2em;\"><span style=\"text-indent: 32px; font-size: 14px; color: rgb(0, 0, 0);\">4 持续出血，擦掉后仍持续</span></p><p style=\"text-indent: 2em;\"><span style=\"text-indent: 32px; font-size: 14px; color: rgb(0, 0, 0);\"><br/></span></p><p style=\"text-indent: 2em;\"><span style=\"text-indent: 32px; font-size: 14px; color: rgb(0, 0, 0);\">5 宝宝出现昏睡或发烧</span></p><p style=\"text-indent: 2em;\"><span style=\"text-indent: 32px; color: rgb(255, 0, 0); font-size: 14px;\"><br/></span></p><p style=\"text-indent: 0em;\"><span style=\"font-size: 14px;\"><strong><span style=\"color: rgb(0, 0, 0); font-size: 14px; text-indent: 32px;\">出现上面这些情况请立即就医，让大夫处理</span></strong></span></p><p style=\"text-indent: 2em;\"><span style=\"text-indent: 32px; color: rgb(255, 0, 0); font-size: 14px;\"><br/></span></p><p style=\"text-indent: 2em;\"><span style=\"text-indent: 32px; font-size: 14px; color: rgb(0, 0, 0);\">小编说：脐部护理真实很重要，脐部发炎也是完全可以预防的，希望每个小宝宝都能得到科学的护理，健健康康度过新生儿期。</span></p><p style=\"text-indent: 2em;\"><span style=\"text-indent: 32px; color: rgb(255, 0, 0); font-size: 14px;\"><br/></span></p><p style=\"text-indent: 2em;\"><br/></p>',1571382482,1571193557,'新生儿脐部是月嫂工作观察的重点，也是重要的护理项目。小宝宝出生后脐带结扎，脐部有少量的黄色分泌物或血性分泌物这都属于正常现象，还会有轻度的红肿，个别小宝宝由于哭得较多，脐部会有凸起。就要做到每天的严密观察，尤其是脐部分泌物的性状，一般7到10天脐带就会干燥、脱落，也有的宝宝经过两周多脱落。1.不要摩擦到脐带要给宝宝选择合适大小的纸尿裤，千万不要让纸尿裤的腰标在宝宝的脐带根部。要不然宝宝活动的时候很容易摩擦到脐带根部，导致破皮发红，甚至出血。2.要保持脐带位置干燥在脐带脱落前后，要保证脐带位置的干燥。脐带一旦被水或者尿液弄湿，要立即用干棉球或者干净柔软的纱布擦干，然后用碘伏消毒。3.避免接触到抚触油如果给宝宝用抚触油按摩，但切记不要涂到脐带根部，一面脐带感染。除了抚触油、各种面霜、乳液也不行。4.做好消毒每天要给宝宝的脐带做1~2次的消毒，用棉签和碘伏绕着起到根部轻轻擦拭，不要用力过度，一面戳破感染。一般来说，宝宝的脐带1~2周左右会脱落，如果2周了还没有脱落，只要没有红肿或者化脓等感染现象就不必担心。一旦出现宝宝肚脐周围出血、变红、有渗出物、肿胀，以及宝宝出现发热不舒服的症状，有可能脐带感染，就要赶紧待宝宝去医院。脐部护理具体步骤月嫂手部消毒取一根医用棉签蘸酒精后，消毒月嫂自己的手指，即与宝宝脐部皮肤接触的两个手指。然后如下图操作。用一只手轻轻提起未脱落的脐带残端或用拇指及食指轻轻展开脐部皮肤，使脐根部完全暴露。另一只手由脐根依次由内向外顺时针擦拭。注意：消毒时不要只消毒肚脐表面，要往脐部里面深一点消毒，消毒时不要离开宝宝，尽量缩短消毒时间。特别说明：同一根棉签切不可重复使用哦！三只棉签用尽，完整的脐部消毒就完成了，最后不要忘了护住宝宝脐部。重要的是，要保持脐部的干燥，干燥，干燥！脐部护理不到位出现的感染的现象很多，在小编身边就有好几起，都是我的朋友，跟他们说了感染严重宝宝是需要住院。最后还是没听话，后来一问才知道原来他们一给宝宝消毒时宝宝就哭，舍不得下手。余额舍不得，宝宝反而越受罪了。月嫂警惕！以下情况需要就医1 脓液（粘性白色，黄色或绿色液体渗出）2 周围皮肤发红或肿胀3 腋窝有异味4 持续出血，擦掉后仍持续5 宝宝出现昏睡或发烧出现上面这些情况请立即就医，让大夫处理小编说：脐部护理真实很重要，脐部发炎也是完全可以预防的，希望每个小宝宝都能得到科学的护理，健健康康度过新生儿期。'),(49,20,'/uploads/20191018/4aaa0638312d0cd3a94efeca1356c30a.png','一岁宝宝若会一下事情，说明发育得很好，家长养育很尽心','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20191018/1571365976407224.png\" title=\"1571365976407224.png\" alt=\"image.png\"/></p><p style=\"text-indent: 2em;\"><strong><br/></strong></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">一般宝宝一岁时，家长都会带着去体检，在体检室里看医生测量身高体重之类的。但医生只会在表格里填个“合格”或“不合格”，具体细节很少说。家长如果掌握一定的知识，就可以通过观察宝宝的表现，在家自查。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">一岁宝宝若会以下事情，说明发育得很好，家长养育很尽心。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"text-indent: 0em;\"><span style=\"color: rgb(255, 0, 0);\"><strong><span style=\"font-size: 14px;\">大运动方面</span></strong></span></p><p style=\"text-indent: 2em;\"><span style=\"color: rgb(255, 0, 0);\"><strong><span style=\"font-size: 14px;\"><br/></span></strong></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px; color: rgb(0, 0, 0);\">大运动能力是指宝宝的跑、跳、蹦等需要手脚协调的能力。虽然一岁的宝宝不全是已经会走路的，但至少都会站立，也会从站姿改变成坐姿。同事也会扶着墙壁或者沙发走一段距离。如果有东西掉在地下，他们还能弯腰去捡。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px; color: rgb(0, 0, 0);\"><br/></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px; color: rgb(0, 0, 0);\">一岁的宝宝如果在七八个月的时候就开始爬行，并且在充分爬行之后，会在大运动能力方面表现优秀。他们会在遇到台阶时，很自然地用爬行的姿势上台阶，下台阶时还会用腿试探地面高低。没有经历过爬行阶段的宝宝在这方面就显得有些笨拙。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px; color: rgb(0, 0, 0);\"><br/></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px; color: rgb(0, 0, 0);\"></span></p><p style=\"white-space: normal; text-indent: 0em;\"><span style=\"color:#ff0000\"><span style=\"font-size: 14px;\"><strong>精细动作方面</strong></span></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"color: rgb(255, 0, 0);\"><strong><span style=\"font-size: 14px;\"><br/></span></strong></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\">精细动作主要是指宝宝手部的动作，比如抓、握、捡以及各个手指的灵活度。一岁的宝宝已经会将较大体积的两个积木（用布做的）摞起来，也会在大人的帮助下捧着杯子喝水，虽然会让水洒出来。如果家长指导得当，他们还会尝试用手将叫上穿的袜子拽下来。</span></p><p style=\"white-space: normal; text-indent: 0em; text-align: center;\"><img src=\"/ueditor/php/upload/image/20191018/1571366961191684.png\" title=\"1571366961191684.png\" alt=\"image.png\"/></p><p style=\"text-indent: 2em;\"><br/></p><p style=\"white-space: normal; text-indent: 0em;\"><span style=\"color:#ff0000\"><span style=\"font-size: 14px;\"><strong>语言方面</strong></span></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"color: rgb(255, 0, 0);\"><strong><span style=\"font-size: 14px;\"><br/></span></strong></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\">这个年龄段的宝宝会说喊“爸爸”、“妈妈”、“奶奶”、‘饭饭’等叠词，还会一些比较简单的单字，比如“拿”“给”等。经常跟宝宝对话的家庭，宝宝学会的词汇更多。</span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\"><span style=\"font-size: 14px; text-indent: 32px;\">一岁后的宝宝就可以开始看绘本了，绘本上丰富的语言会成为宝宝珍贵的“语料库”，为宝宝进一步扩大词汇量提供宝贵的机会。在家长绘声绘的绘本朗读中，宝宝还会对语音语调有初步的概念，还会丰富他的语言表达。</span></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\"><span style=\"font-size: 14px; text-indent: 32px;\"><br/></span></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\"><span style=\"font-size: 14px; text-indent: 32px;\"><span style=\"font-size: 14px; text-indent: 32px;\">家长可将读绘本的时间固定下来，比如放在每晚的“睡前仪式”里。这样更有利于每天坚持，养成习惯后宝宝的发育将大有裨益。</span></span></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\"><span style=\"font-size: 14px; text-indent: 32px;\"><span style=\"font-size: 14px; text-indent: 32px;\"><br/></span></span></span></p><p style=\"text-indent: 0em; text-align: center;\"><img src=\"/ueditor/php/upload/image/20191018/1571367216311979.png\" title=\"1571367216311979.png\" alt=\"image.png\"/></p><p style=\"text-indent: 2em;\"><br/></p><p style=\"white-space: normal; text-indent: 0em;\"><span style=\"color: rgb(255, 0, 0);\"><span style=\"font-size: 14px;\"><strong>认知方面</strong></span></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"color: rgb(255, 0, 0);\"><strong><span style=\"font-size: 14px;\"><br/></span></strong></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\">会简单模仿家长的动作，比如妈妈拿起手机接电话，宝宝也会把手放在耳边，做出接打电话的样子。</span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\">如果家长之前有意识地教孩子人事物体，在说出房间里的某一个物体时，宝宝还会扭头做出寻找动作，证明他已经有初步的记忆，知道哪个物体经常放在哪里。</span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\">听到熟悉的歌曲时宝宝会做出简单的舞蹈动作，比如往下稍蹲、挥动手臂或者剁椒等。说明宝宝已经有了对音乐的初步感知。</span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px; text-indent: 32px;\">对照以上几个方面，你家宝宝表现得怎么样？</span></p>',1571382570,1571367743,'一般宝宝一岁时，家长都会带着去体检，在体检室里看医生测量身高体重之类的。但医生只会在表格里填个“合格”或“不合格”，具体细节很少说。家长如果掌握一定的知识，就可以通过观察宝宝的表现，在家自查。一岁宝宝若会以下事情，说明发育得很好，家长养育很尽心。大运动方面大运动能力是指宝宝的跑、跳、蹦等需要手脚协调的能力。虽然一岁的宝宝不全是已经会走路的，但至少都会站立，也会从站姿改变成坐姿。同事也会扶着墙壁或者沙发走一段距离。如果有东西掉在地下，他们还能弯腰去捡。一岁的宝宝如果在七八个月的时候就开始爬行，并且在充分爬行之后，会在大运动能力方面表现优秀。他们会在遇到台阶时，很自然地用爬行的姿势上台阶，下台阶时还会用腿试探地面高低。没有经历过爬行阶段的宝宝在这方面就显得有些笨拙。精细动作方面精细动作主要是指宝宝手部的动作，比如抓、握、捡以及各个手指的灵活度。一岁的宝宝已经会将较大体积的两个积木（用布做的）摞起来，也会在大人的帮助下捧着杯子喝水，虽然会让水洒出来。如果家长指导得当，他们还会尝试用手将叫上穿的袜子拽下来。语言方面这个年龄段的宝宝会说喊“爸爸”、“妈妈”、“奶奶”、‘饭饭’等叠词，还会一些比较简单的单字，比如“拿”“给”等。经常跟宝宝对话的家庭，宝宝学会的词汇更多。一岁后的宝宝就可以开始看绘本了，绘本上丰富的语言会成为宝宝珍贵的“语料库”，为宝宝进一步扩大词汇量提供宝贵的机会。在家长绘声绘的绘本朗读中，宝宝还会对语音语调有初步的概念，还会丰富他的语言表达。家长可将读绘本的时间固定下来，比如放在每晚的“睡前仪式”里。这样更有利于每天坚持，养成习惯后宝宝的发育将大有裨益。认知方面会简单模仿家长的动作，比如妈妈拿起手机接电话，宝宝也会把手放在耳边，做出接打电话的样子。如果家长之前有意识地教孩子人事物体，在说出房间里的某一个物体时，宝宝还会扭头做出寻找动作，证明他已经有初步的记忆，知道哪个物体经常放在哪里。听到熟悉的歌曲时宝宝会做出简单的舞蹈动作，比如往下稍蹲、挥动手臂或者剁椒等。说明宝宝已经有了对音乐的初步感知。对照以上几个方面，你家宝宝表现得怎么样？'),(50,0,'/uploads/20191018/770e000f24bd80f285d1a29b1b299cd5.png','月嫂温馨提示：剖腹产后，这件事千万别做','<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20191018/1571368074969785.png\" title=\"1571368074969785.png\" alt=\"image.png\"/></p><p style=\"text-indent: 2em;\"><br/></p><p style=\"text-indent: 0em;\"><strong><span style=\"font-size: 14px;\">1、忌平卧：</span></strong></p><p style=\"text-indent: 2em;\"><strong><span style=\"font-size: 14px;\"><br/></span></strong></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">手术后麻醉逐渐消失，宝妈们伤口感到疼痛，而平卧位子宫收缩的痛觉最为敏感。因此，宝妈们最好采取侧卧位，身体与床成20°~30°，并用被子或毯子折叠放在背部，可减轻身体移动对伤口的震动和牵引痛。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"></span></p><p style=\"white-space: normal; text-indent: 0em;\"><strong><span style=\"font-size: 14px;\">2、忌静卧：</span></strong></p><p style=\"white-space: normal; text-indent: 2em;\"><strong><span style=\"font-size: 14px;\"><br/></span></strong></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\">手术后麻醉消失，知觉恢复，应该下床进行肢体活动，24小时后可以联系翻身、坐起或者下床慢慢地移动。这样能够增强胃肠蠕动，及早排气，以防止肠粘连和血栓的形状。</span></p><p style=\"text-indent: 2em;\"><br/></p><p style=\"white-space: normal; text-indent: 0em;\"><strong><span style=\"font-size: 14px;\">3、忌过多进食：</span></strong></p><p style=\"white-space: normal; text-indent: 2em;\"><strong><span style=\"font-size: 14px;\"><br/></span></strong></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\">手术时肠管受到不同程度的刺激，正常功能被抵制，肠蠕动相对减慢，如进食过多，会使粪便增多，不但为造成便秘，而且使产气增加、腹部增高，不利于康复。所以，宝妈们要注意术后6小时内应该禁食，6小时后也要</span></p><p style=\"text-indent: 2em;\"><br/></p><p style=\"white-space: normal; text-indent: 0em;\"><strong><span style=\"font-size: 14px;\">4、忌多吃鱼：</span></strong></p><p style=\"white-space: normal; text-indent: 2em;\"><strong><span style=\"font-size: 14px;\"><br/></span></strong></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\">鱼所富含的二十碳六烯酸具有抵制血小板凝聚的作用，不利于术后的止血及伤口的愈合。</span></p><p style=\"text-indent: 2em;\"><br/></p><p style=\"white-space: normal; text-indent: 0em;\"><strong><span style=\"font-size: 14px;\">5、忌吃产气过多的和辛辣食物：</span></strong></p><p style=\"white-space: normal; text-indent: 2em;\"><strong><span style=\"font-size: 14px;\"><br/></span></strong></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\">如黄豆及豆制品、红薯、蔗糖等，这些食物易发酵，在肠道内产生大量的气体而致腹胀，影响早日康复。</span></p><p style=\"text-indent: 2em;\"><br/></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">不要吃辣椒、葱、蒜等刺激性食物，也不要多吃含纤维素多的食物，以防疼痛加剧，宝妈们要注意这一点。</span></p><p style=\"text-indent: 2em;\"><br/></p><p style=\"white-space: normal; text-indent: 0em;\"><strong><span style=\"font-size: 14px;\">6、忌多用镇痛药物：</span></strong></p><p style=\"white-space: normal; text-indent: 2em;\"><strong><span style=\"font-size: 14px;\"><br/></span></strong></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\">剖宫产术后麻醉药作用逐渐消失，-般在术后几小时伤口较疼痛，可请医生在手术当天使用镇痛药物。在此以后，最好不要再使用药物镇痛，以免影响肠蠕动功能的恢复。作口的疼痛一般在3天后便会自然消失。</span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\"></span></p><p style=\"white-space: normal; text-indent: 0em;\"><strong><span style=\"font-size: 14px;\">7、忌腹部刀口清洗：</span></strong></p><p style=\"white-space: normal; text-indent: 2em;\"><strong><span style=\"font-size: 14px;\"><br/></span></strong></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\">在术后2周内，不要让刀口沾水，宝妈们要注意，全身的清洁宜采用擦浴。</span></p><p style=\"white-space: normal; text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span><br/></p><p style=\"text-indent: 2em;\"><br/></p>',1571369170,1571369125,'1、忌平卧：手术后麻醉逐渐消失，宝妈们伤口感到疼痛，而平卧位子宫收缩的痛觉最为敏感。因此，宝妈们最好采取侧卧位，身体与床成20°~30°，并用被子或毯子折叠放在背部，可减轻身体移动对伤口的震动和牵引痛。2、忌静卧：手术后麻醉消失，知觉恢复，应该下床进行肢体活动，24小时后可以联系翻身、坐起或者下床慢慢地移动。这样能够增强胃肠蠕动，及早排气，以防止肠粘连和血栓的形状。3、忌过多进食：手术时肠管受到不同程度的刺激，正常功能被抵制，肠蠕动相对减慢，如进食过多，会使粪便增多，不但为造成便秘，而且使产气增加、腹部增高，不利于康复。所以，宝妈们要注意术后6小时内应该禁食，6小时后也要4、忌多吃鱼：鱼所富含的二十碳六烯酸具有抵制血小板凝聚的作用，不利于术后的止血及伤口的愈合。5、忌吃产气过多的和辛辣食物：如黄豆及豆制品、红薯、蔗糖等，这些食物易发酵，在肠道内产生大量的气体而致腹胀，影响早日康复。不要吃辣椒、葱、蒜等刺激性食物，也不要多吃含纤维素多的食物，以防疼痛加剧，宝妈们要注意这一点。6、忌多用镇痛药物：剖宫产术后麻醉药作用逐渐消失，-般在术后几小时伤口较疼痛，可请医生在手术当天使用镇痛药物。在此以后，最好不要再使用药物镇痛，以免影响肠蠕动功能的恢复。作口的疼痛一般在3天后便会自然消失。7、忌腹部刀口清洗：在术后2周内，不要让刀口沾水，宝妈们要注意，全身的清洁宜采用擦浴。'),(51,0,'/uploads/20191018/eb3bdc4263c525ad1ff5f5bea0578997.png','怎么判断宝宝吃饱了？','<p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">人工喂养的宝宝每次吃了多少奶，妈妈可以准确知道。母乳喂养的宝宝每天吃了多少奶，是否吃饱了，新手妈妈就心中没底了。</span></p><p style=\"text-indent: 0em;\"><span style=\"font-size: 14px;\"><strong>母乳喂养时间掌控两项标准</strong></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><strong><span style=\"font-size: 14px; text-indent: 32px;\">●</span></strong></span><span style=\"font-size: 14px;\">不宜过长</span><span style=\"font-size: 14px; text-indent: 2em;\">:宝宝吃奶的时间不宜过长，从奶汁的成分来看，先吸出的母乳中蛋白质含量高，而脂肪含星低，随着吸出奶汁的量逐渐增多，母乳中脂肪含星逐渐增高，蛋白质的星逐渐降低。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">吃奶时间过长，会使脂肪摄入过多，容易引起宝宝腹泻。其次，乳汁已吸空，再含着奶头，吸入的都是空气，容易造成溢乳。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">●时间标准:一般认为一侧乳房的哺乳时间为10分钟。吸奶最初2分钟，已经可以吃到总乳汁量的50%，</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">最初4分钟，可吃到总乳汁量的80%~&nbsp;90%，最后的5分钟几乎吃不到多少奶。所以吃奶时间越长，并不等于吃得越多。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"text-indent: 0em; text-align: center;\"><span style=\"font-size: 14px;\"><img src=\"/ueditor/php/upload/image/20191018/1571369973294111.png\" title=\"1571369973294111.png\" alt=\"image.png\"/></span></p><p style=\"text-indent: 0em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"text-indent: 0em;\"><span style=\"font-size: 14px;\"><strong>足食的五大标准</strong></span></p><p style=\"text-indent: 0em;\"><strong><span style=\"font-size: 14px;\">1.乳房的自我感觉</span></strong></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">妈妈在哺乳前，乳房有饱胀感，表面静脉显露,用手按时，乳汁很容易挤出。哺乳后，妈妈会感觉到乳房松软，轻微下垂。</span></p><p style=\"text-indent: 2em;\"><br/></p><p style=\"text-indent: 0em;\"><strong><span style=\"font-size: 14px;\">2.吃奶的声音</span></strong><br/></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><span style=\"font-size: 14px; text-indent: 32px;\">宝宝平均每吸吮2~&nbsp;3次，可以听到咽下的声音，表明乳汁充足，如此连续约10分钟左右足以喂饱宝宝。如果宝宝吸奶时要花很大力气，或是吃完后还含着乳头不放，表明宝宝没有吃饱。</span></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><span style=\"font-size: 14px; text-indent: 32px;\"><br/></span></span></p><p style=\"text-indent: 0em; text-align: center;\"><span style=\"font-size: 14px;\"><span style=\"font-size: 14px; text-indent: 32px;\"><img src=\"/ueditor/php/upload/image/20191018/1571370068120418.png\" title=\"1571370068120418.png\" alt=\"image.png\"/></span></span></p><p style=\"text-indent: 0em;\"><span style=\"font-size: 14px;\"><span style=\"font-size: 14px; text-indent: 32px;\"><br/></span></span></p><p style=\"text-indent: 0em;\"><strong><span style=\"font-size: 14px;\"><span style=\"font-size: 14px; text-indent: 32px;\">3.宝宝的满足感</span></span></strong></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><span style=\"font-size: 14px; text-indent: 32px;\">宝宝吃饱后会有一种满足感，一般能够安静入睡2~&nbsp;4小时。如果宝宝哭闹不安，或没睡到1&nbsp;~&nbsp;2小时就醒来,常表示没有吃饱，应适当增加奶星。</span></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><span style=\"font-size: 14px; text-indent: 32px;\"><br/></span></span></p><p style=\"text-indent: 0em;\"><strong><span style=\"font-size: 14px;\"><span style=\"font-size: 14px; text-indent: 32px;\">4.大小便次数</span></span></strong></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><span style=\"font-size: 14px; text-indent: 32px;\">宝宝的大小便次数和性状可反应宝宝的饥饱情况。母乳喂养的宝宝，大便呈金黄色，奶粉喂养的宝宝，大便呈淡黄色，比较干燥。如宝宝大便每日2~4次，小便8~&nbsp;9次，表示吃饱了。如果宝宝的大便呈绿色，粪质少，并含有大最黏液，说明宝宝没有吃饱。</span></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><span style=\"font-size: 14px; text-indent: 32px;\"><br/></span></span></p><p style=\"text-indent: 0em; text-align: center;\"><span style=\"font-size: 14px;\"><span style=\"font-size: 14px; text-indent: 32px;\"><img src=\"/ueditor/php/upload/image/20191018/1571370168828053.png\" title=\"1571370168828053.png\" alt=\"image.png\"/></span></span></p><p style=\"text-indent: 0em;\"><br/></p><p style=\"text-indent: 0em;\"><strong><span style=\"font-size: 14px;\"><span style=\"font-size: 14px; text-indent: 32px;\">5.体重增长</span></span></strong></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><span style=\"font-size: 14px; text-indent: 32px;\">体重的衡量是饮食是否充足的可靠依据。体重增减是最有效的指标。足月新生儿头1个月增加720~&nbsp;750克，第2个月增加600克。一般6个月以内的宝宝，平均每月增加体重600克左右，就表示吃饱了。如果宝宝体重增加较名说明奶水充足;如果体重每月增长少于500克，表示奶量不够，宝宝没有吃饱。</span></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><span style=\"font-size: 14px; text-indent: 32px;\"><span style=\"font-size: 14px; text-indent: 32px;\">另一种方法是在喂奶前后给宝宝各称一次体重，其差额便是每次的喂奶量。出生3个月时每次喂奶量约为100~&nbsp;150克，6个月时为150~&nbsp;200克，达到这个数量表示宝宝吃饱了</span></span></span></p>',1571382645,1571370297,'人工喂养的宝宝每次吃了多少奶，妈妈可以准确知道。母乳喂养的宝宝每天吃了多少奶，是否吃饱了，新手妈妈就心中没底了。母乳喂养时间掌控两项标准●不宜过长:宝宝吃奶的时间不宜过长，从奶汁的成分来看，先吸出的母乳中蛋白质含量高，而脂肪含星低，随着吸出奶汁的量逐渐增多，母乳中脂肪含星逐渐增高，蛋白质的星逐渐降低。吃奶时间过长，会使脂肪摄入过多，容易引起宝宝腹泻。其次，乳汁已吸空，再含着奶头，吸入的都是空气，容易造成溢乳。●时间标准:一般认为一侧乳房的哺乳时间为10分钟。吸奶最初2分钟，已经可以吃到总乳汁量的50%，最初4分钟，可吃到总乳汁量的80%~ 90%，最后的5分钟几乎吃不到多少奶。所以吃奶时间越长，并不等于吃得越多。足食的五大标准1.乳房的自我感觉妈妈在哺乳前，乳房有饱胀感，表面静脉显露,用手按时，乳汁很容易挤出。哺乳后，妈妈会感觉到乳房松软，轻微下垂。2.吃奶的声音宝宝平均每吸吮2~ 3次，可以听到咽下的声音，表明乳汁充足，如此连续约10分钟左右足以喂饱宝宝。如果宝宝吸奶时要花很大力气，或是吃完后还含着乳头不放，表明宝宝没有吃饱。3.宝宝的满足感宝宝吃饱后会有一种满足感，一般能够安静入睡2~ 4小时。如果宝宝哭闹不安，或没睡到1 ~ 2小时就醒来,常表示没有吃饱，应适当增加奶星。4.大小便次数宝宝的大小便次数和性状可反应宝宝的饥饱情况。母乳喂养的宝宝，大便呈金黄色，奶粉喂养的宝宝，大便呈淡黄色，比较干燥。如宝宝大便每日2~4次，小便8~ 9次，表示吃饱了。如果宝宝的大便呈绿色，粪质少，并含有大最黏液，说明宝宝没有吃饱。5.体重增长体重的衡量是饮食是否充足的可靠依据。体重增减是最有效的指标。足月新生儿头1个月增加720~ 750克，第2个月增加600克。一般6个月以内的宝宝，平均每月增加体重600克左右，就表示吃饱了。如果宝宝体重增加较名说明奶水充足;如果体重每月增长少于500克，表示奶量不够，宝宝没有吃饱。另一种方法是在喂奶前后给宝宝各称一次体重，其差额便是每次的喂奶量。出生3个月时每次喂奶量约为100~ 150克，6个月时为150~ 200克，达到这个数量表示宝宝吃饱了'),(52,0,'/uploads/20191018/65338f686aea249469c7305423289e21.png','还怕晚上宝宝睡觉闹？月嫂、宝妈必须知道5个哄睡技巧！！','<p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">宝宝出生后，如果家里请了月嫂，宝妈可能可以睡一些好觉。<br/></span></p><p style=\"text-indent: 2em;\"><span style=\"text-indent: 32px; font-size: 14px;\">月嫂，可能就没什么好觉能睡了。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">如果照顾的宝宝还是一个夜猫子的话，&nbsp;到了晚上就开始调皮捣蛋的话，再有经验的姐妹，都会被这个宝宝弄的心烦意乱的。</span></p><p style=\"text-indent: 0em; text-align: center;\"><span style=\"font-size: 14px;\"><img src=\"/ueditor/php/upload/image/20191018/1571375462566461.png\" title=\"1571375462566461.png\" alt=\"image.png\"/></span></p><p style=\"text-indent: 0em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">如果你一直在为宝宝的睡觉问题头痛不已，老师给姐妹们推荐的5个哄睡技巧。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">努力改善宝宝的睡眠习惯，帮助宝宝建立有规律的睡眠。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"text-indent: 0em; text-align: center;\"><span style=\"font-size: 14px;\"><img src=\"/ueditor/php/upload/image/20191018/1571375515528131.png\" title=\"1571375515528131.png\" alt=\"image.png\"/></span></p><p style=\"text-indent: 0em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"text-indent: 0em;\"><strong><span style=\"font-size: 14px;\">1、一家人同时睡</span></strong></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">其实宝宝的生活规律常常会跟着家里大人同步，宝宝该到点睡觉的时候，全家人一起睡下，能帮助宝宝更好地入睡及培养他的睡眠习惯。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"text-indent: 0em; text-align: center;\"><span style=\"font-size: 14px;\"><img src=\"/ueditor/php/upload/image/20191018/1571375757473751.png\" title=\"1571375757473751.png\" alt=\"image.png\"/></span></p><p style=\"text-indent: 0em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"text-indent: 0em;\"><span style=\"font-size: 14px;\"><strong>&nbsp;2、让宝宝唾在独立小床上</strong></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">关于婴儿是睡在自己床上还是跟宝妈一起睡更好并没有定论，但是婴儿睡眠的专家还是建议:&nbsp;</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">最好是把婴儿床放在宝妈或者月嫂旁边，这样宝宝不仅有自己的独立空间，而且伸手就可以够到孩子，照顾起来也非常方便。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"text-indent: 0em;\"><strong><span style=\"font-size: 14px;\">3、白天多给宝宝做运动</span></strong></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">尤其对于晚上不肯睡觉的宝宝来说，增加白天的活动量是一个很好的方法，白天的体力消耗增大，到了晚上，宝宝的身体自然而然就会休息了。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">带着宝宝爬行，散步、晒太阳是最好的选择。外出活动的时候，时间最好选择在紫外线不强烈的上午，做好防晒保护。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"text-indent: 0em;\"><strong><span style=\"font-size: 14px;\">4、午间安排午睡</span></strong><span style=\"font-size: 14px;\"><br/></span></p><p style=\"text-indent: 2em;\"><strong><span style=\"font-size: 14px;\">中午是一天中气温最高的时候，宝宝也容易在这个时间觉得疲劳，最适合让宝宝午睡，也能缓解上午的疲倦。</span></strong></p><p style=\"text-indent: 2em;\"><strong><span style=\"font-size: 14px;\">温馨提示：</span></strong><span style=\"font-size: 14px;\">别让宝宝睡太久，否则会影响晚上的睡眠质量。一般不能超过3个小时，一旦过了午睡时间，一定要叫醒宝宝。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"text-indent: 0em;\"><strong><span style=\"font-size: 14px;\">5、唾前准备活动</span></strong></p><p style=\"text-indent: 2em;\"><strong style=\"text-indent: 0em;\"><span style=\"font-size: 14px;\">睡觉前洗澡对调整宝宝的身体进入唾眠状态很有好处。可以尝试在睡前的30&nbsp;~&nbsp;40分钟安排宝宝洗澡。</span></strong></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">然后用按摩油给宝宝全身进行按摩或者抚触，帮助宝宝放松下来，自然而然就会进入睡眠状态。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\"><br/></span></p><p style=\"text-indent: 0em; text-align: center;\"><span style=\"font-size: 14px;\"><img src=\"/ueditor/php/upload/image/20191018/1571376022981745.png\" title=\"1571376022981745.png\" alt=\"image.png\"/></span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">你看，掌握了以上的5种哄睡技巧，是不是让宝万变得简单了呢，其实只要咱们<strong>多一些耐心，多给在线客服安全感</strong>。</span></p><p style=\"text-indent: 2em;\"><span style=\"font-size: 14px;\">帮助宝宝慢慢培养一个好的睡觉习惯，多些时间，宝宝是会好好听话的，就算是咱们做月嫂的，宝宝也会记得你的好。</span></p>',1571376253,1571376118,'宝宝出生后，如果家里请了月嫂，宝妈可能可以睡一些好觉。月嫂，可能就没什么好觉能睡了。如果照顾的宝宝还是一个夜猫子的话， 到了晚上就开始调皮捣蛋的话，再有经验的姐妹，都会被这个宝宝弄的心烦意乱的。如果你一直在为宝宝的睡觉问题头痛不已，老师给姐妹们推荐的5个哄睡技巧。努力改善宝宝的睡眠习惯，帮助宝宝建立有规律的睡眠。1、一家人同时睡其实宝宝的生活规律常常会跟着家里大人同步，宝宝该到点睡觉的时候，全家人一起睡下，能帮助宝宝更好地入睡及培养他的睡眠习惯。 2、让宝宝唾在独立小床上关于婴儿是睡在自己床上还是跟宝妈一起睡更好并没有定论，但是婴儿睡眠的专家还是建议: 最好是把婴儿床放在宝妈或者月嫂旁边，这样宝宝不仅有自己的独立空间，而且伸手就可以够到孩子，照顾起来也非常方便。3、白天多给宝宝做运动尤其对于晚上不肯睡觉的宝宝来说，增加白天的活动量是一个很好的方法，白天的体力消耗增大，到了晚上，宝宝的身体自然而然就会休息了。带着宝宝爬行，散步、晒太阳是最好的选择。外出活动的时候，时间最好选择在紫外线不强烈的上午，做好防晒保护。4、午间安排午睡中午是一天中气温最高的时候，宝宝也容易在这个时间觉得疲劳，最适合让宝宝午睡，也能缓解上午的疲倦。温馨提示：别让宝宝睡太久，否则会影响晚上的睡眠质量。一般不能超过3个小时，一旦过了午睡时间，一定要叫醒宝宝。5、唾前准备活动睡觉前洗澡对调整宝宝的身体进入唾眠状态很有好处。可以尝试在睡前的30 ~ 40分钟安排宝宝洗澡。然后用按摩油给宝宝全身进行按摩或者抚触，帮助宝宝放松下来，自然而然就会进入睡眠状态。你看，掌握了以上的5种哄睡技巧，是不是让宝万变得简单了呢，其实只要咱们多一些耐心，多给在线客服安全感。帮助宝宝慢慢培养一个好的睡觉习惯，多些时间，宝宝是会好好听话的，就算是咱们做月嫂的，宝宝也会记得你的好。'),(53,100,'/uploads/20191113/8deefac05037b799f18f9db664914353.PNG','添加測試','<p>測試1<img src=\"/ueditor/php/upload/image/20191018/1571370068120418.png\" alt=\"1571370068120418.png\"/></p>',1573652778,1573652778,'測試1');
/*!40000 ALTER TABLE `information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matchprocess`
--

DROP TABLE IF EXISTS `matchprocess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matchprocess` (
  `id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `head_img` varchar(255) NOT NULL DEFAULT '' COMMENT '头图',
  `content` text NOT NULL COMMENT '内容',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matchprocess`
--

LOCK TABLES `matchprocess` WRITE;
/*!40000 ALTER TABLE `matchprocess` DISABLE KEYS */;
INSERT INTO `matchprocess` VALUES (1,'测试112131','/uploads/20190926/3781ccb66dac61a8404b2f5370afeb70.jpg','<p style=\"text-align: center;\">媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍媒合流程介绍<img src=\"/ueditor/php/upload/image/20191016/1571192357522736.jpg\" title=\"1571192357522736.jpg\" alt=\"1571192357522736.jpg\" width=\"750\" height=\"250\"/></p>',0,1571192518);
/*!40000 ALTER TABLE `matchprocess` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matron`
--

DROP TABLE IF EXISTS `matron`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matron` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `head_img` varchar(255) NOT NULL DEFAULT '' COMMENT '月嫂上传的头像',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '月嫂地址',
  `year` int(11) NOT NULL DEFAULT '0' COMMENT '工作年限',
  `households` int(11) NOT NULL DEFAULT '0' COMMENT '服务家庭数',
  `temp` varchar(255) NOT NULL DEFAULT '' COMMENT '月嫂修改资料临时存储字段',
  `age` int(11) NOT NULL DEFAULT '0' COMMENT '年龄',
  `star` int(11) NOT NULL DEFAULT '0' COMMENT '2到6为 二星月嫂 三星月嫂 以此类推 7为金牌月嫂 8为月子管家',
  `introduce` varchar(255) NOT NULL DEFAULT '' COMMENT '月嫂介绍',
  `label` varchar(255) NOT NULL DEFAULT '' COMMENT '月嫂标签',
  `region` int(11) NOT NULL DEFAULT '0' COMMENT '1为福州 2为马来西亚',
  `native_place` varchar(255) NOT NULL DEFAULT '' COMMENT '月嫂籍贯 省份',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '月嫂26天的价格',
  `status` int(11) NOT NULL COMMENT '1为显示 0为隐藏',
  `is_home_page` int(11) NOT NULL DEFAULT '0' COMMENT '是否在首页展示 1显示 0不显示',
  `is_data_audit` int(11) NOT NULL DEFAULT '0' COMMENT '1审核通过  2已提交 3已拒绝 0未提交',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `nation` varchar(255) NOT NULL DEFAULT '' COMMENT '民族',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matron`
--

LOCK TABLES `matron` WRITE;
/*!40000 ALTER TABLE `matron` DISABLE KEYS */;
INSERT INTO `matron` VALUES (77,6,'/uploads/20191016/b2294e6778095c1cd93f54315d191387.jpg','测试地址',10,50,'',37,5,'服务过50+个家庭，好评率达99%','身份证 健康证 母婴护理证 催乳师证 营养师证 育婴证',1,'安徽',12800.00,1,1,0,1571192770,1571192789,'汉族'),(78,7,'','测试地址2',20,60,'',65,8,'我们公司经验最丰富的的月嫂，服务过高达60+个家庭','身份证 健康证 母婴护理证 催乳师证 营养师证 育婴证',1,'江苏',18700.00,1,1,0,1571194969,1571195069,'汉族'),(79,8,'/uploads/20191016/6ef474e0d518ecad8f2f4415327b3234.jpg','合肥市高新区',3,15,'',35,7,'张阿姨，为人平和，吃苦耐劳，有着丰富的护理经验','身份证 健康证 催乳师证',1,'安徽',13800.00,1,1,0,1571196681,1571369475,'汉族'),(80,10,'','',0,0,'',0,0,'','',1,'',0.00,0,0,0,1573653009,1573653009,'');
/*!40000 ALTER TABLE `matron` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matroncollect`
--

DROP TABLE IF EXISTS `matroncollect`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matroncollect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `matron_id` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matroncollect`
--

LOCK TABLES `matroncollect` WRITE;
/*!40000 ALTER TABLE `matroncollect` DISABLE KEYS */;
INSERT INTO `matroncollect` VALUES (59,8,78,1571382988),(61,8,77,1571383022),(62,7,77,1571389476),(66,10,79,1573651914);
/*!40000 ALTER TABLE `matroncollect` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matron_id` int(11) NOT NULL DEFAULT '0' COMMENT '月嫂id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '订单 联系人 姓名',
  `mobile` varchar(255) NOT NULL DEFAULT '' COMMENT '订单 联系人 手机号',
  `ordersn` varchar(255) NOT NULL DEFAULT '' COMMENT '订单号',
  `remark` text NOT NULL COMMENT '备注',
  `region` int(11) NOT NULL DEFAULT '0' COMMENT '所属地区  1福州 2马来西亚',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '订单详细地址',
  `coupon_log_id` int(11) NOT NULL DEFAULT '0' COMMENT '使用的优惠券id',
  `start_time` int(11) NOT NULL DEFAULT '0' COMMENT '预约时间',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '结束时间=预约时间+预约天数',
  `days` int(11) NOT NULL DEFAULT '0' COMMENT '预约天数',
  `total_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总价',
  `payable_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '应付价',
  `coupon_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '优惠券金额',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0未付款 1已付款 2已完成 3已取消 4已申请退款 5退款完成',
  `wx_transaction_id` varchar(255) NOT NULL DEFAULT '' COMMENT '微信支付订单号',
  `matron_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '下单时，月嫂26天的价格',
  `is_receive` int(11) NOT NULL DEFAULT '0' COMMENT '是否发放佣金',
  `matron_star` int(11) NOT NULL DEFAULT '0' COMMENT '下单时的月嫂星级',
  `matron_proportion` int(11) NOT NULL DEFAULT '0' COMMENT '下单时的月嫂星级对应的佣金比例',
  `commission` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '预计获得佣金',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `is_evaluate` int(11) NOT NULL DEFAULT '0' COMMENT '是否评价',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (47,78,6,'测试下单','17355105312','2019101696445','',1,'测试地址',19,1571241600,1573401600,26,18700.00,18500.00,200.00,2,'',18700.00,1,8,80,14800.00,1571195110,1571389771,1,1571195129),(48,78,6,'测试下单','16605520110','2019101659092','',1,'测试地址2',0,1573660800,1575820800,26,18700.00,18700.00,0.00,2,'',18700.00,1,8,80,14960.00,1571195222,1571389786,0,1571389780),(49,77,7,'张丽','17855325','2019101686244','',1,'合肥市蜀山区',20,1571241600,1573401600,26,12800.00,12600.00,200.00,3,'',12800.00,0,5,50,6300.00,1571205643,1571205909,0,0),(50,77,8,'测试','18297999901','2019101646596','',1,'南京市玄武区',0,1571241600,1573747200,30,14769.23,14769.23,0.00,2,'',12800.00,1,5,50,7384.61,1571205961,1571297285,1,1571205987),(51,79,6,'吴瑶','17355105312','2019101619101','',1,'测试吴瑶',0,1576425600,1578585600,26,13800.00,13800.00,0.00,2,'',13800.00,1,7,70,9660.00,1571214041,1571214092,0,1571214075),(52,79,9,'棋牌室','15155947763','2019102298252','',1,'啦啦啦',0,1573920000,1576080000,26,13800.00,13800.00,0.00,1,'',13800.00,0,7,70,9660.00,1571726556,1571726581,0,1571726581),(53,77,8,'大明','18297999901','2019102247476','',1,'的深V色大V深V',0,1577030400,1579190400,26,12800.00,12800.00,0.00,1,'',12800.00,0,5,50,6400.00,1571727069,1571727255,0,1571727255),(54,79,10,'呂先生','0937542154','2019111396223','',1,'台中市大馬路四段31號五樓',0,1581782400,1583942400,26,13800.00,13800.00,0.00,2,'',13800.00,1,7,70,9660.00,1573651459,1573653263,0,1573653237);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '小程序用户openid',
  `nickname` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '用户微信昵称',
  `avatar_url` varchar(255) NOT NULL DEFAULT '' COMMENT '用户微信头像',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1普通用户 2月嫂',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '用户真实姓名',
  `mobile` varchar(255) NOT NULL DEFAULT '' COMMENT '手机号',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0未申请入驻  1申请并通过  2申请未审核 3拒绝入驻',
  `matron_create_time` int(11) NOT NULL DEFAULT '0' COMMENT '申请入驻时间',
  `matron_update_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后一次审核通过时间 拒绝时间',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (6,'oNAkT0U0mvXEtu3n8K38tPY2t5Vc','傍晚升起的太阳','https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJ8tfQWkBgcg8rPkNANfMaVu0DLsnuRfiae0CicZj0HBeIdR9uqkdXVficOhmsG83UYqegzeHPSOjWzA/132',2,'吴瑞','17355105312',1,1571192764,1571192770,1571191529,0),(7,'oNAkT0csMfQUrZsND2Q7Ev2Dieiw','云想衣裳 花想容','https://wx.qlogo.cn/mmopen/vi_32/kHZ6jBO5US5icjSt4bicTYLtElMxpXbKibOXUuGy6m4GKmlkxSubHjr4xltoSuEibhhqqGfJAY1AiaEOiacY1L5kVL8Q/132',2,'张丽','17855325506',1,1571194956,1571194969,1571194930,0),(8,'oNAkT0TIhlFTooQwClBfeg3Cy5qU','-','https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJGiawJ43QNONmTF3YwNCbqxcNoiaFsHaAIQKMF4LzqWJxNtNUewBWm6BMMqrzT7WhTGWF8cbMjrODQ/132',2,'杏花路','18297999901',1,1571196018,1571196681,1571196001,0),(9,'oNAkT0Qd1ml-6g9YxOmL7oTeJ8eM','安子','https://wx.qlogo.cn/mmopen/vi_32/7wTSibribeOZGf3kyeMd53sWdVUiaoyKxtC4BsmQ2QxbNONiba6tVGNfMwaVPImKYX2pficSszHjtSbkkV461KqC37g/132',1,'','',0,0,0,1571726493,0),(10,'oNAkT0Y6wDhM3sVWXMCGG3WItQFI','凱煜kyle-台灣','https://wx.qlogo.cn/mmopen/vi_32/xliaVxbK40vcAhJylgiayqt6t3gv7UvfShHt92mmqbphZ4kYCKgBqtVZ9BibFdaGgE5ibByQCPiaRlgBgG4YVJz606g/132',2,'凱煜','54846631',1,1573652995,1573653009,1573651285,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-16 16:35:49
