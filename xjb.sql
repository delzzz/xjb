/*
SQLyog Ultimate v12.08 (64 bit)
MySQL - 5.5.49-0ubuntu0.14.04.1 : Database - webvr
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`webvr` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `webvr`;

/*Table structure for table `cishoo_action` */

DROP TABLE IF EXISTS `cishoo_action`;

CREATE TABLE `cishoo_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '行为唯一标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '行为说明',
  `remark` char(140) NOT NULL DEFAULT '' COMMENT '行为描述',
  `rule` text NOT NULL COMMENT '行为规则',
  `log` text NOT NULL COMMENT '日志规则',
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统行为表';

/*Data for the table `cishoo_action` */

insert  into `cishoo_action`(`id`,`name`,`title`,`remark`,`rule`,`log`,`type`,`status`,`update_time`) values (1,'user_login','用户登录','积分+10，每天一次','table:member|field:score|condition:uid={$self} AND status>-1|rule:score+10|cycle:24|max:1;','[user|get_nickname]在[time|time_format]登录了后台',1,1,1387181220),(2,'add_article','发布文章','积分+5，每天上限5次','table:member|field:score|condition:uid={$self}|rule:score+5|cycle:24|max:5','',2,0,1380173180),(3,'review','评论','评论积分+1，无限制','table:member|field:score|condition:uid={$self}|rule:score+1','',2,1,1383285646),(4,'add_document','发表文档','积分+10，每天上限5次','table:member|field:score|condition:uid={$self}|rule:score+10|cycle:24|max:5','[user|get_nickname]在[time|time_format]发表了一篇文章。\r\n表[model]，记录编号[record]。',2,0,1386139726),(5,'add_document_topic','发表讨论','积分+5，每天上限10次','table:member|field:score|condition:uid={$self}|rule:score+5|cycle:24|max:10','',2,0,1383285551),(6,'update_config','更新配置','新增或修改或删除配置','','',1,1,1383294988),(7,'update_model','更新模型','新增或修改模型','','',1,1,1383295057),(8,'update_attribute','更新属性','新增或更新或删除属性','','',1,1,1383295963),(9,'update_channel','更新导航','新增或修改或删除导航','','',1,1,1383296301),(10,'update_menu','更新菜单','新增或修改或删除菜单','','',1,1,1383296392),(11,'update_category','更新分类','新增或修改或删除分类','','',1,1,1383296765);

/*Table structure for table `cishoo_action_log` */

DROP TABLE IF EXISTS `cishoo_action_log`;

CREATE TABLE `cishoo_action_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `action_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '行为id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行用户id',
  `action_ip` bigint(20) NOT NULL COMMENT '执行行为者ip',
  `model` varchar(50) NOT NULL DEFAULT '' COMMENT '触发行为的表',
  `record_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '触发行为的数据id',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '日志备注',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行行为的时间',
  PRIMARY KEY (`id`),
  KEY `action_ip_ix` (`action_ip`),
  KEY `action_id_ix` (`action_id`),
  KEY `user_id_ix` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='行为日志表';

/*Data for the table `cishoo_action_log` */

insert  into `cishoo_action_log`(`id`,`action_id`,`user_id`,`action_ip`,`model`,`record_id`,`remark`,`status`,`create_time`) values (1,1,1,3232289025,'member',1,'admin在2016-08-29 15:09登录了后台',1,1472454584),(2,10,1,3232289025,'Menu',3,'操作url：/Admin/Menu/edit.html',1,1472455236),(3,10,1,3232289025,'Menu',3,'操作url：/Admin/Menu/edit.html',1,1472455341),(4,10,1,3232289025,'Menu',3,'操作url：/Admin/Menu/edit.html',1,1472455409),(5,11,1,3232289025,'category',1,'操作url：/Admin/Category/edit.html',1,1472455621),(6,11,1,3232289025,'category',2,'操作url：/Admin/Category/edit.html',1,1472455682),(7,11,1,3232289025,'category',2,'操作url：/Admin/Category/edit.html',1,1472455909),(8,11,1,3232289025,'category',39,'操作url：/Admin/Category/add.html',1,1472456134),(9,11,1,3232289025,'category',39,'操作url：/Admin/Category/edit.html',1,1472456148),(10,11,1,3232289025,'category',39,'操作url：/Admin/Category/edit.html',1,1472456159),(11,8,1,3232289025,'attribute',33,'操作url：/Admin/Model/generate.html',1,1472456850),(12,8,1,3232289025,'attribute',34,'操作url：/Admin/Model/generate.html',1,1472456850),(13,8,1,3232289025,'attribute',35,'操作url：/Admin/Model/generate.html',1,1472456850),(14,8,1,3232289025,'attribute',36,'操作url：/Admin/Model/generate.html',1,1472456850),(15,7,1,3232289025,'model',2,'操作url：/Admin/Model/update.html',1,1472457000),(16,10,1,3232289025,'Menu',122,'操作url：/Admin/Menu/add.html',1,1472462630),(17,10,1,3232289025,'Menu',123,'操作url：/Admin/Menu/add.html',1,1472462669),(18,10,1,3232289025,'Menu',122,'操作url：/Admin/Menu/edit.html',1,1472462725),(19,10,1,3232289025,'Menu',123,'操作url：/Admin/Menu/edit.html',1,1472463839),(20,10,1,3232289025,'Menu',122,'操作url：/Admin/Menu/edit.html',1,1472465488),(21,10,1,3232289025,'Menu',124,'操作url：/Admin/Menu/add.html',1,1472465773),(22,10,1,3232289025,'Menu',124,'操作url：/Admin/Menu/edit.html',1,1472465800),(23,10,1,3232289025,'Menu',125,'操作url：/Admin/Menu/add.html',1,1472467500),(24,1,1,3232289025,'member',1,'admin在2016-08-30 09:42登录了后台',1,1472521370),(25,10,1,3232289025,'Menu',126,'操作url：/Admin/Menu/add.html',1,1472524264),(26,8,1,3232289025,'attribute',12,'操作url：/Admin/Attribute/update.html',1,1472526340),(27,8,1,3232289025,'attribute',37,'操作url：/Admin/Attribute/update.html',1,1472526500),(28,8,1,3232289025,'attribute',37,'操作url：/Admin/Attribute/remove/id/37.html',1,1472526549),(29,8,1,3232289025,'attribute',38,'操作url：/Admin/Attribute/update.html',1,1472526604),(30,7,1,3232289025,'model',2,'操作url：/Admin/Model/update.html',1,1472526624),(31,8,1,3232289025,'attribute',38,'操作url：/Admin/Attribute/update.html',1,1472526693),(32,8,1,3232289025,'attribute',38,'操作url：/Admin/Attribute/update.html',1,1472526735),(33,1,1,3232236412,'member',1,'admin在2016-08-30 13:37登录了后台',1,1472535435),(34,11,1,3232236412,'category',40,'操作url：/Admin/Category/add.html',1,1472535507),(35,1,1,3232289025,'member',1,'admin在2016-08-30 13:45登录了后台',1,1472535904),(36,11,1,3232289025,'category',40,'操作url：/Admin/Category/edit.html',1,1472535922),(37,1,1,3232236412,'member',1,'admin在2016-08-30 15:03登录了后台',1,1472540604),(38,10,1,3232236412,'Menu',127,'操作url：/Admin/Menu/add.html',1,1472540703),(39,10,1,3232236412,'Menu',128,'操作url：/Admin/Menu/add.html',1,1472542837),(40,10,1,3232289025,'Menu',129,'操作url：/Admin/Menu/add.html',1,1472543805),(41,10,1,3232289025,'Menu',129,'操作url：/Admin/Menu/edit.html',1,1472543821),(42,10,1,3232289025,'Menu',130,'操作url：/Admin/Menu/add.html',1,1472544086),(43,10,1,3232289025,'Menu',131,'操作url：/Admin/Menu/add.html',1,1472544111),(44,11,1,3232289025,'category',41,'操作url：/Admin/Category/add.html',1,1472544339),(45,10,1,3232289025,'Menu',129,'操作url：/Admin/Menu/edit.html',1,1472544674),(46,10,1,3232236412,'Menu',132,'操作url：/Admin/Menu/add.html',1,1472547325),(47,10,1,3232236412,'Menu',128,'操作url：/Admin/Menu/edit.html',1,1472547336),(48,7,1,3232289025,'model',1,'操作url：/Admin/Model/update.html',1,1472549851),(49,1,1,3232236412,'member',1,'admin在2016-08-31 09:40登录了后台',1,1472607640),(50,1,1,3232289025,'member',1,'admin在2016-08-31 09:43登录了后台',1,1472607818),(51,11,1,3232289025,'category',42,'操作url：/Admin/Category/add.html',1,1472608202),(52,11,1,3232289025,'category',43,'操作url：/Admin/Category/add.html',1,1472608272),(53,11,1,3232289025,'category',44,'操作url：/Admin/Category/add.html',1,1472608330),(54,11,1,3232289025,'category',45,'操作url：/Admin/Category/add.html',1,1472608371),(55,11,1,3232289025,'category',46,'操作url：/Admin/Category/add.html',1,1472608392),(56,11,1,3232289025,'category',47,'操作url：/Admin/Category/add.html',1,1472608455),(57,11,1,3232289025,'category',47,'操作url：/Admin/Category/edit.html',1,1472608568),(58,11,1,3232289025,'category',48,'操作url：/Admin/Category/add.html',1,1472609056),(59,6,1,3232289025,'config',43,'操作url：/Admin/Config/edit.html',1,1472609621),(60,11,1,3232289025,'category',49,'操作url：/Admin/Category/add.html',1,1472610130),(61,11,1,3232289025,'category',50,'操作url：/Admin/Category/add.html',1,1472610193),(62,11,1,3232289025,'category',51,'操作url：/Admin/Category/add.html',1,1472610253),(63,6,1,3232289025,'config',39,'操作url：/Admin/Config/edit.html',1,1472612228),(64,1,1,3232289025,'member',1,'admin在2016-08-31 13:23登录了后台',1,1472621009),(65,1,1,3232236412,'member',1,'admin在2016-08-31 14:03登录了后台',1,1472623417),(66,10,1,3232289025,'Menu',133,'操作url：/Admin/Menu/add.html',1,1472634119),(67,10,1,3232289025,'Menu',134,'操作url：/Admin/Menu/add.html',1,1472634653),(68,10,1,3232289025,'Menu',134,'操作url：/Admin/Menu/edit.html',1,1472634734),(69,10,1,3232289025,'Menu',134,'操作url：/Admin/Menu/edit.html',1,1472634833),(70,1,1,3232289025,'member',1,'admin在2016-08-31 17:23登录了后台',1,1472635395),(71,1,1,3232289025,'member',1,'admin在2016-09-01 09:59登录了后台',1,1472695181),(72,1,1,3232289025,'member',1,'admin在2016-09-01 11:18登录了后台',1,1472699894),(73,1,1,3232289025,'member',1,'admin在2016-09-02 18:07登录了后台',1,1472810856),(74,1,1,3232289025,'member',1,'admin在2016-09-05 10:18登录了后台',1,1473041909),(75,1,1,3232289025,'member',1,'admin在2016-09-14 10:31登录了后台',1,1473820279),(76,1,1,3232236412,'member',1,'admin在2016-09-14 10:32登录了后台',1,1473820336),(77,1,1,3232236412,'member',1,'admin在2016-09-14 11:15登录了后台',1,1473822936),(78,1,1,3232289025,'member',1,'admin在2016-09-14 13:16登录了后台',1,1473830180),(79,10,1,3232289025,'Menu',135,'操作url：/Admin/Menu/add.html',1,1473835498),(80,1,1,3232289025,'member',1,'admin在2016-09-21 16:31登录了后台',1,1474446703),(81,8,1,3232289025,'attribute',39,'操作url：/Admin/Attribute/update.html',1,1474447232),(82,7,1,3232289025,'model',2,'操作url：/Admin/Model/update.html',1,1474447270),(83,1,1,3232289025,'member',1,'admin在2016-09-22 16:29登录了后台',1,1474532960),(84,9,1,3232289025,'channel',1,'操作url：/Admin/Channel/edit.html',1,1474533023),(85,9,1,3232289025,'channel',2,'操作url：/Admin/Channel/edit.html',1,1474533055),(86,9,1,3232289025,'channel',3,'操作url：/Admin/Channel/edit.html',1,1474533076),(87,11,1,3232289025,'category',52,'操作url：/Admin/Category/add.html',1,1474536022),(88,11,1,3232289025,'category',53,'操作url：/Admin/Category/add.html',1,1474536042),(89,11,1,3232289025,'category',54,'操作url：/Admin/Category/add.html',1,1474536148),(90,11,1,3232289025,'category',55,'操作url：/Admin/Category/add.html',1,1474536172),(91,11,1,3232289025,'category',53,'操作url：/Admin/Category/edit.html',1,1474536182),(92,11,1,3232289025,'category',52,'操作url：/Admin/Category/edit.html',1,1474536190),(93,11,1,3232289025,'category',53,'操作url：/Admin/Category/remove/id/53.html',1,1474538785),(94,11,1,3232289025,'category',52,'操作url：/Admin/Category/remove/id/52.html',1,1474538791),(95,11,1,3232289025,'category',54,'操作url：/Admin/Category/remove/id/54.html',1,1474538797),(96,11,1,3232289025,'category',55,'操作url：/Admin/Category/remove/id/55.html',1,1474538801),(97,11,1,3232289025,'category',56,'操作url：/Admin/Category/add.html',1,1474539202),(98,11,1,3232289025,'category',57,'操作url：/Admin/Category/add.html',1,1474539224),(99,11,1,3232289025,'category',58,'操作url：/Admin/Category/add.html',1,1474539243),(100,11,1,3232289025,'category',59,'操作url：/Admin/Category/add.html',1,1474539268),(101,11,1,3232289025,'category',41,'操作url：/Admin/Category/edit.html',1,1474539354),(102,11,1,3232289025,'category',41,'操作url：/Admin/Category/edit.html',1,1474539385),(103,1,1,3232289025,'member',1,'admin在2016-09-23 09:41登录了后台',1,1474594885),(104,1,1,3232289025,'member',1,'admin在2016-09-23 14:04登录了后台',1,1474610665),(105,1,1,3232289025,'member',1,'admin在2016-09-23 15:30登录了后台',1,1474615827),(106,1,1,3232289025,'member',1,'admin在2016-09-26 09:58登录了后台',1,1474855096),(107,1,1,3232236404,'member',1,'admin在2016-09-27 14:03登录了后台',1,1474956235),(108,11,1,3232236404,'category',60,'操作url：/Admin/Category/add.html',1,1474956985),(109,11,1,3232236404,'category',60,'操作url：/Admin/Category/remove/id/60.html',1,1474957003),(110,1,1,3232240385,'member',1,'admin在2016-10-10 15:48登录了后台',1,1476085705),(111,7,1,3232240385,'model',5,'操作url：/Admin/Model/update.html',1,1476085823),(112,8,1,3232240385,'attribute',40,'操作url：/Admin/Attribute/update.html',1,1476085924),(113,8,1,3232240385,'attribute',41,'操作url：/Admin/Attribute/update.html',1,1476086194),(114,8,1,3232240385,'attribute',42,'操作url：/Admin/Attribute/update.html',1,1476086260),(115,11,1,3232240385,'category',60,'操作url：/Admin/Category/add.html',1,1476086790),(116,11,1,3232240385,'category',61,'操作url：/Admin/Category/add.html',1,1476086838),(117,7,1,3232240385,'model',5,'操作url：/Admin/Model/update.html',1,1476087070),(118,10,1,3232240385,'Menu',136,'操作url：/Admin/Menu/add.html',1,1476087697),(119,10,1,3232240385,'Menu',136,'操作url：/Admin/Menu/edit.html',1,1476087740),(120,10,1,3232240385,'Menu',137,'操作url：/Admin/Menu/add.html',1,1476088420),(121,10,1,3232240385,'Menu',138,'操作url：/Admin/Menu/add.html',1,1476088434),(122,10,1,3232240385,'Menu',139,'操作url：/Admin/Menu/add.html',1,1476088717),(123,10,1,3232240385,'Menu',140,'操作url：/Admin/Menu/add.html',1,1476088750),(124,1,1,3232240385,'member',1,'admin在2016-10-11 09:41登录了后台',1,1476150079),(125,10,1,3232240385,'Menu',136,'操作url：/Admin/Menu/edit.html',1,1476151632),(126,1,1,3232240385,'member',1,'admin在2016-10-11 12:09登录了后台',1,1476158982),(127,1,1,3232240385,'member',1,'admin在2016-10-11 13:34登录了后台',1,1476164054),(128,1,1,3232240385,'member',1,'admin在2016-10-11 16:21登录了后台',1,1476174116),(129,1,1,3232240385,'member',1,'admin在2016-10-11 17:43登录了后台',1,1476179019),(130,1,1,3232240385,'member',1,'admin在2016-10-14 17:35登录了后台',1,1476437723),(131,1,1,3232240385,'member',1,'admin在2016-10-17 14:28登录了后台',1,1476685726),(132,8,1,3232240385,'attribute',43,'操作url：/Admin/Attribute/update.html',1,1476687808),(133,7,1,3232240385,'model',1,'操作url：/Admin/Model/update.html',1,1476687827),(134,1,1,3232240385,'member',1,'admin在2016-10-18 16:19登录了后台',1,1476778749),(135,1,1,3232240385,'member',1,'admin在2016-11-03 10:45登录了后台',1,1478141148),(136,1,1,3232240385,'member',1,'admin在2016-11-08 10:13登录了后台',1,1478571192),(137,1,1,3232240385,'member',1,'admin在2016-11-08 11:05登录了后台',1,1478574340),(138,1,1,3232240385,'member',1,'admin在2016-11-10 14:11登录了后台',1,1478758288),(139,1,1,3232240385,'member',1,'admin在2016-12-08 09:42登录了后台',1,1481161354),(140,9,1,3232240385,'channel',1,'操作url：/Admin/Channel/edit.html',1,1481164562),(141,9,1,3232240385,'channel',2,'操作url：/Admin/Channel/edit.html',1,1481164664),(142,9,1,3232240385,'channel',0,'操作url：/Admin/Channel/del/id/3.html',1,1481165362);

/*Table structure for table `cishoo_addons` */

DROP TABLE IF EXISTS `cishoo_addons`;

CREATE TABLE `cishoo_addons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL COMMENT '插件名或标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '中文名',
  `description` text COMMENT '插件描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `config` text COMMENT '配置',
  `author` varchar(40) DEFAULT '' COMMENT '作者',
  `version` varchar(20) DEFAULT '' COMMENT '版本号',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `has_adminlist` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否有后台列表',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='插件表';

/*Data for the table `cishoo_addons` */

insert  into `cishoo_addons`(`id`,`name`,`title`,`description`,`status`,`config`,`author`,`version`,`create_time`,`has_adminlist`) values (2,'SiteStat','站点统计信息','统计站点的基础信息',1,'{\"title\":\"\\u7cfb\\u7edf\\u4fe1\\u606f\",\"width\":\"1\",\"display\":\"1\",\"status\":\"0\"}','thinkphp','0.1',1379512015,0),(3,'DevTeam','开发团队信息','开发团队成员信息',1,'{\"title\":\"OneThink\\u5f00\\u53d1\\u56e2\\u961f\",\"width\":\"2\",\"display\":\"1\"}','thinkphp','0.1',1379512022,0),(4,'SystemInfo','系统环境信息','用于显示一些服务器的信息',1,'{\"title\":\"\\u7cfb\\u7edf\\u4fe1\\u606f\",\"width\":\"2\",\"display\":\"1\"}','thinkphp','0.1',1379512036,0),(5,'Editor','前台编辑器','用于增强整站长文本的输入和显示',1,'{\"editor_type\":\"2\",\"editor_wysiwyg\":\"1\",\"editor_height\":\"300px\",\"editor_resize_type\":\"1\"}','thinkphp','0.1',1379830910,0),(6,'Attachment','附件','用于文档模型上传附件',1,'null','thinkphp','0.1',1379842319,1),(9,'SocialComment','通用社交化评论','集成了各种社交化评论插件，轻松集成到系统中。',1,'{\"comment_type\":\"1\",\"comment_uid_youyan\":\"\",\"comment_short_name_duoshuo\":\"\",\"comment_data_list_duoshuo\":\"\"}','thinkphp','0.1',1380273962,0),(15,'EditorForAdmin','后台编辑器','用于增强整站长文本的输入和显示',1,'{\"editor_type\":\"2\",\"editor_wysiwyg\":\"1\",\"editor_height\":\"500px\",\"editor_resize_type\":\"1\"}','thinkphp','0.1',1383126253,0);

/*Table structure for table `cishoo_attachment` */

DROP TABLE IF EXISTS `cishoo_attachment`;

CREATE TABLE `cishoo_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `title` char(30) NOT NULL DEFAULT '' COMMENT '附件显示名',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '附件类型',
  `source` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资源ID',
  `record_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联记录ID',
  `download` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `size` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '附件大小',
  `dir` int(12) unsigned NOT NULL DEFAULT '0' COMMENT '上级目录ID',
  `sort` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `idx_record_status` (`record_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='附件表';

/*Data for the table `cishoo_attachment` */

/*Table structure for table `cishoo_attribute` */

DROP TABLE IF EXISTS `cishoo_attribute`;

CREATE TABLE `cishoo_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '字段名',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '字段注释',
  `field` varchar(100) NOT NULL DEFAULT '' COMMENT '字段定义',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '数据类型',
  `value` varchar(100) NOT NULL DEFAULT '' COMMENT '字段默认值',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '参数',
  `model_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '模型id',
  `is_must` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否必填',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `validate_rule` varchar(255) NOT NULL,
  `validate_time` tinyint(1) unsigned NOT NULL,
  `error_info` varchar(100) NOT NULL,
  `validate_type` varchar(25) NOT NULL,
  `auto_rule` varchar(100) NOT NULL,
  `auto_time` tinyint(1) unsigned NOT NULL,
  `auto_type` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `model_id` (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COMMENT='模型属性表';

/*Data for the table `cishoo_attribute` */

insert  into `cishoo_attribute`(`id`,`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) values (1,'uid','用户ID','int(10) unsigned NOT NULL ','num','0','',0,'',1,0,1,1384508362,1383891233,'',0,'','','',0,''),(2,'name','标识','char(40) NOT NULL ','string','','同一根节点下标识不重复',1,'',1,0,1,1383894743,1383891233,'',0,'','','',0,''),(3,'title','标题','char(80) NOT NULL ','string','','文档标题',1,'',1,0,1,1383894778,1383891233,'',0,'','','',0,''),(4,'category_id','所属分类','int(10) unsigned NOT NULL ','string','','',0,'',1,0,1,1384508336,1383891233,'',0,'','','',0,''),(5,'description','描述','char(140) NOT NULL ','textarea','','',1,'',1,0,1,1383894927,1383891233,'',0,'','','',0,''),(6,'root','根节点','int(10) unsigned NOT NULL ','num','0','该文档的顶级文档编号',0,'',1,0,1,1384508323,1383891233,'',0,'','','',0,''),(7,'pid','所属ID','int(10) unsigned NOT NULL ','num','0','父文档编号',0,'',1,0,1,1384508543,1383891233,'',0,'','','',0,''),(8,'model_id','内容模型ID','tinyint(3) unsigned NOT NULL ','num','0','该文档所对应的模型',0,'',1,0,1,1384508350,1383891233,'',0,'','','',0,''),(9,'type','内容类型','tinyint(3) unsigned NOT NULL ','select','2','',1,'1:目录\r\n2:主题\r\n3:段落',1,0,1,1384511157,1383891233,'',0,'','','',0,''),(10,'position','推荐位','smallint(5) unsigned NOT NULL ','checkbox','0','多个推荐则将其推荐值相加',1,'1:列表推荐\r\n2:频道页推荐\r\n4:首页推荐',1,0,1,1383895640,1383891233,'',0,'','','',0,''),(11,'link_id','外链','int(10) unsigned NOT NULL ','num','0','0-非外链，大于0-外链ID,需要函数进行链接与编号的转换',1,'',1,0,1,1383895757,1383891233,'',0,'','','',0,''),(12,'cover_id','图片','int(10) unsigned NOT NULL ','picture','0','0-无封面，大于0-封面图片ID，需要函数处理',1,'',1,0,1,1472526340,1383891233,'',0,'','regex','',0,'function'),(13,'display','可见性','tinyint(3) unsigned NOT NULL ','radio','1','',1,'0:不可见\r\n1:所有人可见',1,0,1,1386662271,1383891233,'',0,'','regex','',0,'function'),(14,'deadline','截至时间','int(10) unsigned NOT NULL ','datetime','0','0-永久有效',1,'',1,0,1,1387163248,1383891233,'',0,'','regex','',0,'function'),(15,'attach','附件数量','tinyint(3) unsigned NOT NULL ','num','0','',0,'',1,0,1,1387260355,1383891233,'',0,'','regex','',0,'function'),(16,'view','浏览量','int(10) unsigned NOT NULL ','num','0','',1,'',1,0,1,1383895835,1383891233,'',0,'','','',0,''),(17,'comment','评论数','int(10) unsigned NOT NULL ','num','0','',1,'',1,0,1,1383895846,1383891233,'',0,'','','',0,''),(18,'extend','扩展统计字段','int(10) unsigned NOT NULL ','num','0','根据需求自行使用',0,'',1,0,1,1384508264,1383891233,'',0,'','','',0,''),(19,'level','优先级','int(10) unsigned NOT NULL ','num','0','越高排序越靠前',1,'',1,0,1,1383895894,1383891233,'',0,'','','',0,''),(20,'create_time','创建时间','int(10) unsigned NOT NULL ','datetime','0','',1,'',1,0,1,1383895903,1383891233,'',0,'','','',0,''),(21,'update_time','更新时间','int(10) unsigned NOT NULL ','datetime','0','',0,'',1,0,1,1384508277,1383891233,'',0,'','','',0,''),(22,'status','数据状态','tinyint(4) NOT NULL ','radio','0','',0,'-1:删除\r\n0:禁用\r\n1:正常\r\n2:待审核\r\n3:草稿',1,0,1,1384508496,1383891233,'',0,'','','',0,''),(23,'parse','内容解析类型','tinyint(3) unsigned NOT NULL ','select','0','',0,'0:html\r\n1:ubb\r\n2:markdown',2,0,1,1384511049,1383891243,'',0,'','','',0,''),(24,'content','文章内容','text NOT NULL ','editor','','',1,'',2,0,1,1383896225,1383891243,'',0,'','','',0,''),(25,'template','详情页显示模板','varchar(100) NOT NULL ','string','','参照display方法参数的定义',1,'',2,0,1,1383896190,1383891243,'',0,'','','',0,''),(26,'bookmark','收藏数','int(10) unsigned NOT NULL ','num','0','',1,'',2,0,1,1383896103,1383891243,'',0,'','','',0,''),(27,'parse','内容解析类型','tinyint(3) unsigned NOT NULL ','select','0','',0,'0:html\r\n1:ubb\r\n2:markdown',3,0,1,1387260461,1383891252,'',0,'','regex','',0,'function'),(28,'content','下载详细描述','text NOT NULL ','editor','','',1,'',3,0,1,1383896438,1383891252,'',0,'','','',0,''),(29,'template','详情页显示模板','varchar(100) NOT NULL ','string','','',1,'',3,0,1,1383896429,1383891252,'',0,'','','',0,''),(30,'file_id','文件ID','int(10) unsigned NOT NULL ','file','0','需要函数处理',1,'',3,0,1,1383896415,1383891252,'',0,'','','',0,''),(31,'download','下载次数','int(10) unsigned NOT NULL ','num','0','',1,'',3,0,1,1383896380,1383891252,'',0,'','','',0,''),(32,'size','文件大小','bigint(20) unsigned NOT NULL ','num','0','单位bit',1,'',3,0,1,1383896371,1383891252,'',0,'','','',0,''),(33,'parse','内容解析类型','tinyint(3) unsigned NOT NULL ','string','0','',1,'',4,0,1,1472456850,1472456850,'',0,'','','',0,''),(34,'content','文章内容','text NOT NULL ','string','','',1,'',4,0,1,1472456850,1472456850,'',0,'','','',0,''),(35,'template','详情页显示模板','varchar(100) NOT NULL ','string','','',1,'',4,0,1,1472456850,1472456850,'',0,'','','',0,''),(36,'bookmark','收藏数','int(10) unsigned NOT NULL ','string','0','',1,'',4,0,1,1472456850,1472456850,'',0,'','','',0,''),(38,'title2','副标题','varchar(80) NOT NULL','string','','副标题',1,'',1,0,1,1472526735,1472526604,'',3,'','regex','',3,'function'),(39,'hover_cover_id','鼠标悬停图','int(10) UNSIGNED NOT NULL','picture','','0-无封面，大于0-封面图片ID，需要函数处理',1,'',1,0,1,1474447232,1474447232,'',3,'','regex','',3,'function'),(40,'job_name','职位名称','varchar(255) NOT NULL','string','','',1,'',5,1,1,1476085924,1476085924,'',3,'','regex','',3,'function'),(41,'duty','岗位职责','text NOT NULL','editor','','',1,'',5,0,1,1476086194,1476086194,'',3,'','regex','',3,'function'),(42,'qualificaty','任职资格','text NOT NULL','editor','','',1,'',5,0,1,1476086260,1476086260,'',3,'','regex','',3,'function'),(43,'url','跳转路径','varchar(255) NOT NULL','string','','跳转路径',1,'',1,0,1,1476687808,1476687808,'',3,'','regex','',3,'function');

/*Table structure for table `cishoo_auth_extend` */

DROP TABLE IF EXISTS `cishoo_auth_extend`;

CREATE TABLE `cishoo_auth_extend` (
  `group_id` mediumint(10) unsigned NOT NULL COMMENT '用户id',
  `extend_id` mediumint(8) unsigned NOT NULL COMMENT '扩展表中数据的id',
  `type` tinyint(1) unsigned NOT NULL COMMENT '扩展类型标识 1:栏目分类权限;2:模型权限',
  UNIQUE KEY `group_extend_type` (`group_id`,`extend_id`,`type`),
  KEY `uid` (`group_id`),
  KEY `group_id` (`extend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户组与分类的对应关系表';

/*Data for the table `cishoo_auth_extend` */

insert  into `cishoo_auth_extend`(`group_id`,`extend_id`,`type`) values (1,1,1),(1,1,2),(1,2,1),(1,2,2),(1,3,1),(1,3,2),(1,4,1),(1,37,1);

/*Table structure for table `cishoo_auth_group` */

DROP TABLE IF EXISTS `cishoo_auth_group`;

CREATE TABLE `cishoo_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id,自增主键',
  `module` varchar(20) NOT NULL COMMENT '用户组所属模块',
  `type` tinyint(4) NOT NULL COMMENT '组类型',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `description` varchar(80) NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户组状态：为1正常，为0禁用,-1为删除',
  `rules` varchar(500) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `cishoo_auth_group` */

insert  into `cishoo_auth_group`(`id`,`module`,`type`,`title`,`description`,`status`,`rules`) values (1,'admin',1,'默认用户组','',1,'1,2,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,79,80,81,82,83,84,86,87,88,89,90,91,92,93,94,95,96,97,100,102,103,105,106'),(2,'admin',1,'测试用户','测试用户',1,'1,2,5,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,79,80,82,83,84,88,89,90,91,92,93,96,97,100,102,103,195'),(3,'admin',1,'运营','',-1,'');

/*Table structure for table `cishoo_auth_group_access` */

DROP TABLE IF EXISTS `cishoo_auth_group_access`;

CREATE TABLE `cishoo_auth_group_access` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cishoo_auth_group_access` */

/*Table structure for table `cishoo_auth_rule` */

DROP TABLE IF EXISTS `cishoo_auth_rule`;

CREATE TABLE `cishoo_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `module` varchar(20) NOT NULL COMMENT '规则所属module',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1-url;2-主菜单',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `condition` varchar(300) NOT NULL DEFAULT '' COMMENT '规则附加条件',
  PRIMARY KEY (`id`),
  KEY `module` (`module`,`status`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=236 DEFAULT CHARSET=utf8;

/*Data for the table `cishoo_auth_rule` */

insert  into `cishoo_auth_rule`(`id`,`module`,`type`,`name`,`title`,`status`,`condition`) values (1,'admin',2,'Admin/Index/index','首页',1,''),(2,'admin',2,'Admin/Article/mydocument','内容',1,''),(3,'admin',2,'Admin/User/index','用户',1,''),(4,'admin',2,'Admin/Addons/index','扩展',1,''),(5,'admin',2,'Admin/Config/group','系统',1,''),(7,'admin',1,'Admin/article/add','新增',1,''),(8,'admin',1,'Admin/article/edit','编辑',1,''),(9,'admin',1,'Admin/article/setStatus','改变状态',1,''),(10,'admin',1,'Admin/article/update','保存',1,''),(11,'admin',1,'Admin/article/autoSave','保存草稿',1,''),(12,'admin',1,'Admin/article/move','移动',1,''),(13,'admin',1,'Admin/article/copy','复制',1,''),(14,'admin',1,'Admin/article/paste','粘贴',1,''),(15,'admin',1,'Admin/article/permit','还原',1,''),(16,'admin',1,'Admin/article/clear','清空',1,''),(17,'admin',1,'Admin/article/index','首页介绍',1,''),(18,'admin',1,'Admin/article/recycle','回收站',1,''),(19,'admin',1,'Admin/User/addaction','新增用户行为',1,''),(20,'admin',1,'Admin/User/editaction','编辑用户行为',1,''),(21,'admin',1,'Admin/User/saveAction','保存用户行为',1,''),(22,'admin',1,'Admin/User/setStatus','变更行为状态',1,''),(23,'admin',1,'Admin/User/changeStatus?method=forbidUser','禁用会员',1,''),(24,'admin',1,'Admin/User/changeStatus?method=resumeUser','启用会员',1,''),(25,'admin',1,'Admin/User/changeStatus?method=deleteUser','删除会员',1,''),(26,'admin',1,'Admin/User/index','用户信息',1,''),(27,'admin',1,'Admin/User/action','用户行为',1,''),(28,'admin',1,'Admin/AuthManager/changeStatus?method=deleteGroup','删除',1,''),(29,'admin',1,'Admin/AuthManager/changeStatus?method=forbidGroup','禁用',1,''),(30,'admin',1,'Admin/AuthManager/changeStatus?method=resumeGroup','恢复',1,''),(31,'admin',1,'Admin/AuthManager/createGroup','新增',1,''),(32,'admin',1,'Admin/AuthManager/editGroup','编辑',1,''),(33,'admin',1,'Admin/AuthManager/writeGroup','保存用户组',1,''),(34,'admin',1,'Admin/AuthManager/group','授权',1,''),(35,'admin',1,'Admin/AuthManager/access','访问授权',1,''),(36,'admin',1,'Admin/AuthManager/user','成员授权',1,''),(37,'admin',1,'Admin/AuthManager/removeFromGroup','解除授权',1,''),(38,'admin',1,'Admin/AuthManager/addToGroup','保存成员授权',1,''),(39,'admin',1,'Admin/AuthManager/category','分类授权',1,''),(40,'admin',1,'Admin/AuthManager/addToCategory','保存分类授权',1,''),(41,'admin',1,'Admin/AuthManager/index','权限管理',1,''),(42,'admin',1,'Admin/Addons/create','创建',1,''),(43,'admin',1,'Admin/Addons/checkForm','检测创建',1,''),(44,'admin',1,'Admin/Addons/preview','预览',1,''),(45,'admin',1,'Admin/Addons/build','快速生成插件',1,''),(46,'admin',1,'Admin/Addons/config','设置',1,''),(47,'admin',1,'Admin/Addons/disable','禁用',1,''),(48,'admin',1,'Admin/Addons/enable','启用',1,''),(49,'admin',1,'Admin/Addons/install','安装',1,''),(50,'admin',1,'Admin/Addons/uninstall','卸载',1,''),(51,'admin',1,'Admin/Addons/saveconfig','更新配置',1,''),(52,'admin',1,'Admin/Addons/adminList','插件后台列表',1,''),(53,'admin',1,'Admin/Addons/execute','URL方式访问插件',1,''),(54,'admin',1,'Admin/Addons/index','插件管理',1,''),(55,'admin',1,'Admin/Addons/hooks','钩子管理',1,''),(56,'admin',1,'Admin/model/add','新增',1,''),(57,'admin',1,'Admin/model/edit','编辑',1,''),(58,'admin',1,'Admin/model/setStatus','改变状态',1,''),(59,'admin',1,'Admin/model/update','保存数据',1,''),(60,'admin',1,'Admin/Model/index','模型管理',1,''),(61,'admin',1,'Admin/Config/edit','编辑',1,''),(62,'admin',1,'Admin/Config/del','删除',1,''),(63,'admin',1,'Admin/Config/add','新增',1,''),(64,'admin',1,'Admin/Config/save','保存',1,''),(65,'admin',1,'Admin/Config/group','网站设置',1,''),(66,'admin',1,'Admin/Config/index','配置管理',1,''),(67,'admin',1,'Admin/Channel/add','新增',1,''),(68,'admin',1,'Admin/Channel/edit','编辑',1,''),(69,'admin',1,'Admin/Channel/del','删除',1,''),(70,'admin',1,'Admin/Channel/index','导航管理',1,''),(71,'admin',1,'Admin/Category/edit','编辑',1,''),(72,'admin',1,'Admin/Category/add','新增',1,''),(73,'admin',1,'Admin/Category/remove','删除',1,''),(74,'admin',1,'Admin/Category/index','分类管理',1,''),(75,'admin',1,'Admin/file/upload','上传控件',-1,''),(76,'admin',1,'Admin/file/uploadPicture','上传图片',-1,''),(77,'admin',1,'Admin/file/download','下载',-1,''),(79,'admin',1,'Admin/article/batchOperate','导入',1,''),(80,'admin',1,'Admin/Database/index?type=export','备份数据库',1,''),(81,'admin',1,'Admin/Database/index?type=import','还原数据库',1,''),(82,'admin',1,'Admin/Database/export','备份',1,''),(83,'admin',1,'Admin/Database/optimize','优化表',1,''),(84,'admin',1,'Admin/Database/repair','修复表',1,''),(86,'admin',1,'Admin/Database/import','恢复',1,''),(87,'admin',1,'Admin/Database/del','删除',1,''),(88,'admin',1,'Admin/User/add','新增用户',1,''),(89,'admin',1,'Admin/Attribute/index','属性管理',1,''),(90,'admin',1,'Admin/Attribute/add','新增',1,''),(91,'admin',1,'Admin/Attribute/edit','编辑',1,''),(92,'admin',1,'Admin/Attribute/setStatus','改变状态',1,''),(93,'admin',1,'Admin/Attribute/update','保存数据',1,''),(94,'admin',1,'Admin/AuthManager/modelauth','模型授权',1,''),(95,'admin',1,'Admin/AuthManager/addToModel','保存模型授权',1,''),(96,'admin',1,'Admin/Category/move','移动',-1,''),(97,'admin',1,'Admin/Category/merge','合并',-1,''),(98,'admin',1,'Admin/Config/menu','后台菜单管理',-1,''),(99,'admin',1,'Admin/Article/mydocument','内容',-1,''),(100,'admin',1,'Admin/Menu/index','菜单管理',1,''),(101,'admin',1,'Admin/other','其他',-1,''),(102,'admin',1,'Admin/Menu/add','新增',1,''),(103,'admin',1,'Admin/Menu/edit','编辑',1,''),(104,'admin',1,'Admin/Think/lists?model=article','文章管理',-1,''),(105,'admin',1,'Admin/Think/lists?model=download','下载管理',1,''),(106,'admin',1,'Admin/Think/lists?model=config','配置管理',1,''),(107,'admin',1,'Admin/Action/actionlog','行为日志',1,''),(108,'admin',1,'Admin/User/updatePassword','修改密码',1,''),(109,'admin',1,'Admin/User/updateNickname','修改昵称',1,''),(110,'admin',1,'Admin/action/edit','查看行为日志',1,''),(111,'admin',2,'Admin/article/index','文档列表',-1,''),(112,'admin',2,'Admin/article/add','新增',-1,''),(113,'admin',2,'Admin/article/edit','编辑',-1,''),(114,'admin',2,'Admin/article/setStatus','改变状态',-1,''),(115,'admin',2,'Admin/article/update','保存',-1,''),(116,'admin',2,'Admin/article/autoSave','保存草稿',-1,''),(117,'admin',2,'Admin/article/move','移动',-1,''),(118,'admin',2,'Admin/article/copy','复制',-1,''),(119,'admin',2,'Admin/article/paste','粘贴',-1,''),(120,'admin',2,'Admin/article/batchOperate','导入',-1,''),(121,'admin',2,'Admin/article/recycle','回收站',-1,''),(122,'admin',2,'Admin/article/permit','还原',-1,''),(123,'admin',2,'Admin/article/clear','清空',-1,''),(124,'admin',2,'Admin/User/add','新增用户',-1,''),(125,'admin',2,'Admin/User/action','用户行为',-1,''),(126,'admin',2,'Admin/User/addAction','新增用户行为',-1,''),(127,'admin',2,'Admin/User/editAction','编辑用户行为',-1,''),(128,'admin',2,'Admin/User/saveAction','保存用户行为',-1,''),(129,'admin',2,'Admin/User/setStatus','变更行为状态',-1,''),(130,'admin',2,'Admin/User/changeStatus?method=forbidUser','禁用会员',-1,''),(131,'admin',2,'Admin/User/changeStatus?method=resumeUser','启用会员',-1,''),(132,'admin',2,'Admin/User/changeStatus?method=deleteUser','删除会员',-1,''),(133,'admin',2,'Admin/AuthManager/index','权限管理',-1,''),(134,'admin',2,'Admin/AuthManager/changeStatus?method=deleteGroup','删除',-1,''),(135,'admin',2,'Admin/AuthManager/changeStatus?method=forbidGroup','禁用',-1,''),(136,'admin',2,'Admin/AuthManager/changeStatus?method=resumeGroup','恢复',-1,''),(137,'admin',2,'Admin/AuthManager/createGroup','新增',-1,''),(138,'admin',2,'Admin/AuthManager/editGroup','编辑',-1,''),(139,'admin',2,'Admin/AuthManager/writeGroup','保存用户组',-1,''),(140,'admin',2,'Admin/AuthManager/group','授权',-1,''),(141,'admin',2,'Admin/AuthManager/access','访问授权',-1,''),(142,'admin',2,'Admin/AuthManager/user','成员授权',-1,''),(143,'admin',2,'Admin/AuthManager/removeFromGroup','解除授权',-1,''),(144,'admin',2,'Admin/AuthManager/addToGroup','保存成员授权',-1,''),(145,'admin',2,'Admin/AuthManager/category','分类授权',-1,''),(146,'admin',2,'Admin/AuthManager/addToCategory','保存分类授权',-1,''),(147,'admin',2,'Admin/AuthManager/modelauth','模型授权',-1,''),(148,'admin',2,'Admin/AuthManager/addToModel','保存模型授权',-1,''),(149,'admin',2,'Admin/Addons/create','创建',-1,''),(150,'admin',2,'Admin/Addons/checkForm','检测创建',-1,''),(151,'admin',2,'Admin/Addons/preview','预览',-1,''),(152,'admin',2,'Admin/Addons/build','快速生成插件',-1,''),(153,'admin',2,'Admin/Addons/config','设置',-1,''),(154,'admin',2,'Admin/Addons/disable','禁用',-1,''),(155,'admin',2,'Admin/Addons/enable','启用',-1,''),(156,'admin',2,'Admin/Addons/install','安装',-1,''),(157,'admin',2,'Admin/Addons/uninstall','卸载',-1,''),(158,'admin',2,'Admin/Addons/saveconfig','更新配置',-1,''),(159,'admin',2,'Admin/Addons/adminList','插件后台列表',-1,''),(160,'admin',2,'Admin/Addons/execute','URL方式访问插件',-1,''),(161,'admin',2,'Admin/Addons/hooks','钩子管理',-1,''),(162,'admin',2,'Admin/Model/index','模型管理',-1,''),(163,'admin',2,'Admin/model/add','新增',-1,''),(164,'admin',2,'Admin/model/edit','编辑',-1,''),(165,'admin',2,'Admin/model/setStatus','改变状态',-1,''),(166,'admin',2,'Admin/model/update','保存数据',-1,''),(167,'admin',2,'Admin/Attribute/index','属性管理',-1,''),(168,'admin',2,'Admin/Attribute/add','新增',-1,''),(169,'admin',2,'Admin/Attribute/edit','编辑',-1,''),(170,'admin',2,'Admin/Attribute/setStatus','改变状态',-1,''),(171,'admin',2,'Admin/Attribute/update','保存数据',-1,''),(172,'admin',2,'Admin/Config/index','配置管理',-1,''),(173,'admin',2,'Admin/Config/edit','编辑',-1,''),(174,'admin',2,'Admin/Config/del','删除',-1,''),(175,'admin',2,'Admin/Config/add','新增',-1,''),(176,'admin',2,'Admin/Config/save','保存',-1,''),(177,'admin',2,'Admin/Menu/index','菜单管理',-1,''),(178,'admin',2,'Admin/Channel/index','导航管理',-1,''),(179,'admin',2,'Admin/Channel/add','新增',-1,''),(180,'admin',2,'Admin/Channel/edit','编辑',-1,''),(181,'admin',2,'Admin/Channel/del','删除',-1,''),(182,'admin',2,'Admin/Category/index','分类管理',-1,''),(183,'admin',2,'Admin/Category/edit','编辑',-1,''),(184,'admin',2,'Admin/Category/add','新增',-1,''),(185,'admin',2,'Admin/Category/remove','删除',-1,''),(186,'admin',2,'Admin/Category/move','移动',-1,''),(187,'admin',2,'Admin/Category/merge','合并',-1,''),(188,'admin',2,'Admin/Database/index?type=export','备份数据库',-1,''),(189,'admin',2,'Admin/Database/export','备份',-1,''),(190,'admin',2,'Admin/Database/optimize','优化表',-1,''),(191,'admin',2,'Admin/Database/repair','修复表',-1,''),(192,'admin',2,'Admin/Database/index?type=import','还原数据库',-1,''),(193,'admin',2,'Admin/Database/import','恢复',-1,''),(194,'admin',2,'Admin/Database/del','删除',-1,''),(195,'admin',2,'Admin/other','其他',1,''),(196,'admin',2,'Admin/Menu/add','新增',-1,''),(197,'admin',2,'Admin/Menu/edit','编辑',-1,''),(198,'admin',2,'Admin/Think/lists?model=article','应用',-1,''),(199,'admin',2,'Admin/Think/lists?model=download','下载管理',-1,''),(200,'admin',2,'Admin/Think/lists?model=config','应用',-1,''),(201,'admin',2,'Admin/Action/actionlog','行为日志',-1,''),(202,'admin',2,'Admin/User/updatePassword','修改密码',-1,''),(203,'admin',2,'Admin/User/updateNickname','修改昵称',-1,''),(204,'admin',2,'Admin/action/edit','查看行为日志',-1,''),(205,'admin',1,'Admin/think/add','新增数据',1,''),(206,'admin',1,'Admin/think/edit','编辑数据',1,''),(207,'admin',1,'Admin/Menu/import','导入',1,''),(208,'admin',1,'Admin/Model/generate','生成',1,''),(209,'admin',1,'Admin/Addons/addHook','新增钩子',1,''),(210,'admin',1,'Admin/Addons/edithook','编辑钩子',1,''),(211,'admin',1,'Admin/Article/sort','文档排序',1,''),(212,'admin',1,'Admin/Config/sort','排序',1,''),(213,'admin',1,'Admin/Menu/sort','排序',1,''),(214,'admin',1,'Admin/Channel/sort','排序',1,''),(215,'admin',1,'Admin/Category/operate/type/move','移动',1,''),(216,'admin',1,'Admin/Category/operate/type/merge','合并',1,''),(217,'admin',1,'Admin/About/index','关于我们',1,''),(218,'admin',1,'Admin/Banner/index','首页banner',1,''),(219,'admin',1,'Admin/Banner/add','添加banner',1,''),(220,'admin',1,'Admin/Banner/edit','编辑banner',1,''),(221,'admin',1,'Admin/Video/index','首页视频',1,''),(222,'admin',1,'Admin/Video/add','添加首页视频',1,''),(223,'admin',1,'Admin/Product/index','产品介绍',1,''),(224,'admin',1,'Admin/Product/add','添加产品图',1,''),(225,'admin',1,'Admin/Product/edit','修改产品图',1,''),(226,'admin',1,'Admin/Video/edit','编辑首页视频',1,''),(227,'admin',1,'Admin/Message/index','留言信息',1,''),(228,'admin',1,'Admin/Message/look','查看留言信息',1,''),(229,'admin',2,'Admin/About/index','网站',1,''),(230,'admin',1,'Admin/Vedio/write','信息写入',1,''),(231,'admin',1,'Admin/Job/index','岗位信息',1,''),(232,'admin',1,'Admin/Job/add','新增',1,''),(233,'admin',1,'Admin/Job/edit','编辑',1,''),(234,'admin',1,'Admin/Job/write','写入',1,''),(235,'admin',1,'Admin/Job/del','删除',1,'');

/*Table structure for table `cishoo_category` */

DROP TABLE IF EXISTS `cishoo_category`;

CREATE TABLE `cishoo_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(30) NOT NULL COMMENT '标志',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `list_row` tinyint(3) unsigned NOT NULL DEFAULT '10' COMMENT '列表每页行数',
  `meta_title` varchar(50) NOT NULL DEFAULT '' COMMENT 'SEO的网页标题',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `template_index` varchar(100) NOT NULL COMMENT '频道页模板',
  `template_lists` varchar(100) NOT NULL COMMENT '列表页模板',
  `template_detail` varchar(100) NOT NULL COMMENT '详情页模板',
  `template_edit` varchar(100) NOT NULL COMMENT '编辑页模板',
  `model` varchar(100) NOT NULL DEFAULT '' COMMENT '关联模型',
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '允许发布的内容类型',
  `link_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外链',
  `allow_publish` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许发布内容',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '可见性',
  `reply` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许回复',
  `check` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '发布的文章是否需要审核',
  `reply_model` varchar(100) NOT NULL DEFAULT '',
  `extend` text NOT NULL COMMENT '扩展设置',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
  `icon` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类图标',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COMMENT='分类表';

/*Data for the table `cishoo_category` */

insert  into `cishoo_category`(`id`,`name`,`title`,`pid`,`sort`,`list_row`,`meta_title`,`keywords`,`description`,`template_index`,`template_lists`,`template_detail`,`template_edit`,`model`,`type`,`link_id`,`allow_publish`,`display`,`reply`,`check`,`reply_model`,`extend`,`create_time`,`update_time`,`status`,`icon`) values (1,'blog','网站类容',0,0,10,'','','','','','','','2','2,1',0,0,1,0,0,'1','',1379474947,1472455621,1,0),(2,'index_product','首页产品',1,1,10,'','','','','','','','2','2,1,3',0,1,1,0,1,'1','',1379475028,1472455909,1,31),(39,'index_prodecut_descript','首页产品描述',1,2,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1472456134,1472456159,1,0),(40,'product_instruction','解决方案',1,0,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1472535507,1472535922,1,0),(41,'product_introduce','产品介绍',1,0,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1472544339,1474539385,1,0),(42,'join_condition','加盟条件',47,0,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1472608202,1472608202,1,0),(43,'join_flow','加盟流程',47,0,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1472608272,1472608272,1,0),(44,'profit_model','盈利模式',47,0,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1472608330,1472608330,1,0),(45,'question','常见问题',47,0,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1472608371,1472608371,1,0),(46,'service','增值服务',47,0,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1472608392,1472608392,1,0),(47,'plan','合作共赢',0,0,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1472608455,1472608568,1,0),(48,'about_us','关于我们',1,0,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1472609056,1472609056,1,0),(49,'adverties','招贤纳士',0,0,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1472610130,1472610130,0,0),(50,'responsibility','岗位职责',49,0,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1472610193,1472610193,1,0),(51,'qualifications','任职资格',49,0,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1472610253,1472610253,0,0),(56,'p1','产品介绍1',41,0,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1474539202,1474539202,1,0),(57,'p2','产品介绍2',41,0,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1474539224,1474539224,1,0),(58,'s1','解决方案1',40,0,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1474539243,1474539243,1,0),(59,'s2','解决方案2',40,0,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1474539268,1474539268,1,0),(60,'job_info','岗位信息',0,0,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1476086790,1476086790,1,0),(61,'job_list','发布岗位',60,0,10,'','','','','','','','2','2,1,3',0,1,1,1,0,'','',1476086838,1476086838,1,0);

/*Table structure for table `cishoo_channel` */

DROP TABLE IF EXISTS `cishoo_channel`;

CREATE TABLE `cishoo_channel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '频道ID',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级频道ID',
  `title` char(30) NOT NULL COMMENT '频道标题',
  `url` char(100) NOT NULL COMMENT '频道连接',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '导航排序',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `target` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '新窗口打开',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `cishoo_channel` */

insert  into `cishoo_channel`(`id`,`pid`,`title`,`url`,`sort`,`create_time`,`update_time`,`status`,`target`) values (1,0,'直辖市','#',1,1379475111,1481164562,1,0),(2,0,'江苏省','#',2,1379475131,1481164664,1,0),(4,0,'合作共赢','Partner/index',4,1474533101,1474533101,1,0),(5,0,'关于我们','About/index',5,1474533136,1474533136,1,0),(6,0,'招贤纳士','Adverties/index',6,1474533155,1474533155,1,0),(7,1,'上海市','#',0,1481164643,1481164643,1,0),(8,2,'西湖一日游','#',0,1481164694,1481164694,1,0);

/*Table structure for table `cishoo_cishoo_zxns` */

DROP TABLE IF EXISTS `cishoo_cishoo_zxns`;

CREATE TABLE `cishoo_cishoo_zxns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `job_name` varchar(255) NOT NULL COMMENT '职位名称',
  `duty` text NOT NULL COMMENT '岗位职责',
  `qualificaty` text NOT NULL COMMENT '任职资格',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `cishoo_cishoo_zxns` */

/*Table structure for table `cishoo_config` */

DROP TABLE IF EXISTS `cishoo_config`;

CREATE TABLE `cishoo_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置说明',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '配置值',
  `remark` varchar(100) NOT NULL COMMENT '配置说明',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `value` text NOT NULL COMMENT '配置值',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `type` (`type`),
  KEY `group` (`group`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

/*Data for the table `cishoo_config` */

insert  into `cishoo_config`(`id`,`name`,`type`,`title`,`group`,`extra`,`remark`,`create_time`,`update_time`,`status`,`value`,`sort`) values (1,'WEB_SITE_TITLE',1,'网站标题',1,'','网站标题前台显示标题',1378898976,1379235274,1,'OneThink内容管理框架',7),(2,'WEB_SITE_DESCRIPTION',2,'网站描述',1,'','网站搜索引擎描述',1378898976,1379235841,1,'cishoo vr官网',2),(3,'WEB_SITE_KEYWORD',2,'网站关键字',1,'','网站搜索引擎关键字',1378898976,1381390100,1,'ThinkPHP,OneThink',8),(4,'WEB_SITE_CLOSE',4,'关闭站点',1,'0:关闭,1:开启','站点关闭后其他用户不能访问，管理员可以正常访问',1378898976,1379235296,1,'1',3),(9,'CONFIG_TYPE_LIST',3,'配置类型列表',4,'','主要用于数据解析和页面表单的生成',1378898976,1379235348,1,'0:数字\r\n1:字符\r\n2:文本\r\n3:数组\r\n4:枚举',8),(10,'WEB_SITE_ICP',1,'网站备案号',1,'','设置在网站底部显示的备案号，如“沪ICP备12007941号-2',1378900335,1379235859,1,'',4),(11,'DOCUMENT_POSITION',3,'文档推荐位',2,'','文档推荐位，推荐到多个位置KEY值相加即可',1379053380,1379235329,1,'1:列表页推荐\r\n2:频道页推荐\r\n4:网站首页推荐',10),(12,'DOCUMENT_DISPLAY',3,'文档可见性',2,'','文章可见性仅影响前台显示，后台不收影响',1379056370,1379235322,1,'0:所有人可见\r\n1:仅注册会员可见\r\n2:仅管理员可见',4),(13,'COLOR_STYLE',4,'后台色系',1,'default_color:默认\r\nblue_color:紫罗兰','后台颜色风格',1379122533,1379235904,1,'default_color',10),(20,'CONFIG_GROUP_LIST',3,'配置分组',4,'','配置分组',1379228036,1384418383,1,'1:基本\r\n2:内容\r\n3:用户\r\n4:系统',4),(21,'HOOKS_TYPE',3,'钩子的类型',4,'','类型 1-用于扩展显示内容，2-用于扩展业务处理',1379313397,1379313407,1,'1:视图\r\n2:控制器',6),(22,'AUTH_CONFIG',3,'Auth配置',4,'','自定义Auth.class.php类配置',1379409310,1379409564,1,'AUTH_ON:1\r\nAUTH_TYPE:2',8),(23,'OPEN_DRAFTBOX',4,'是否开启草稿功能',2,'0:关闭草稿功能\r\n1:开启草稿功能\r\n','新增文章时的草稿功能配置',1379484332,1379484591,1,'1',5),(24,'DRAFT_AOTOSAVE_INTERVAL',0,'自动保存草稿时间',2,'','自动保存草稿的时间间隔，单位：秒',1379484574,1386143323,1,'60',9),(25,'LIST_ROWS',0,'后台每页记录数',2,'','后台数据每页显示记录数',1379503896,1380427745,1,'10',10),(26,'USER_ALLOW_REGISTER',4,'是否允许用户注册',3,'0:关闭注册\r\n1:允许注册','是否开放用户注册',1379504487,1379504580,1,'1',3),(27,'CODEMIRROR_THEME',4,'预览插件的CodeMirror主题',4,'3024-day:3024 day\r\n3024-night:3024 night\r\nambiance:ambiance\r\nbase16-dark:base16 dark\r\nbase16-light:base16 light\r\nblackboard:blackboard\r\ncobalt:cobalt\r\neclipse:eclipse\r\nelegant:elegant\r\nerlang-dark:erlang-dark\r\nlesser-dark:lesser-dark\r\nmidnight:midnight','详情见CodeMirror官网',1379814385,1384740813,1,'ambiance',3),(28,'DATA_BACKUP_PATH',1,'数据库备份根路径',4,'','路径必须以 / 结尾',1381482411,1381482411,1,'./Data/',5),(29,'DATA_BACKUP_PART_SIZE',0,'数据库备份卷大小',4,'','该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M',1381482488,1381729564,1,'20971520',7),(30,'DATA_BACKUP_COMPRESS',4,'数据库备份文件是否启用压缩',4,'0:不压缩\r\n1:启用压缩','压缩备份文件需要PHP环境支持gzopen,gzwrite函数',1381713345,1381729544,1,'1',9),(31,'DATA_BACKUP_COMPRESS_LEVEL',4,'数据库备份文件压缩级别',4,'1:普通\r\n4:一般\r\n9:最高','数据库备份文件的压缩级别，该配置在开启压缩时生效',1381713408,1381713408,1,'9',10),(32,'DEVELOP_MODE',4,'开启开发者模式',4,'0:关闭\r\n1:开启','是否开启开发者模式',1383105995,1383291877,1,'1',11),(33,'ALLOW_VISIT',3,'不受限控制器方法',0,'','',1386644047,1386644741,1,'0:article/draftbox\r\n1:article/mydocument\r\n2:Category/tree\r\n3:Index/verify\r\n4:file/upload\r\n5:file/download\r\n6:user/updatePassword\r\n7:user/updateNickname\r\n8:user/submitPassword\r\n9:user/submitNickname\r\n10:file/uploadpicture',3),(34,'DENY_VISIT',3,'超管专限控制器方法',0,'','仅超级管理员可访问的控制器方法',1386644141,1386644659,1,'0:Addons/addhook\r\n1:Addons/edithook\r\n2:Addons/delhook\r\n3:Addons/updateHook\r\n4:Admin/getMenus\r\n5:Admin/recordList\r\n6:AuthManager/updateRules\r\n7:AuthManager/tree',4),(35,'REPLY_LIST_ROWS',0,'回复列表每页条数',2,'','',1386645376,1387178083,1,'10',5),(36,'ADMIN_ALLOW_IP',2,'后台允许访问IP',4,'','多个用逗号分隔，如果不配置表示不限制IP访问',1387165454,1387165553,1,'',12),(37,'SHOW_PAGE_TRACE',4,'是否显示页面Trace',4,'0:关闭\r\n1:开启','是否显示页面Trace信息',1387165685,1387165685,1,'0',6),(38,'CONTACT_US_AD',1,'联系我们标语',1,'','',1472609319,1472609319,1,'创享完美VR体验，让科技服务于生活',1),(39,'COMPANNY_NAME',1,'公司名称',1,'','',1472609414,1472612228,1,'江苏星途网络科技有限公司',0),(40,'COMPANNY_ADDRESS',1,'公司地址',1,'','',1472609450,1472609450,1,'南通市开发区通盛大道188号创业服务中心D座901',0),(41,'PARTNER_PERSON',1,'品牌合作联系人',1,'','',1472609514,1472609514,1,'仲聪',0),(42,'PARTNER_PERSON_MOBILE',1,'品牌合作联系人手机',1,'','',1472609573,1472609573,1,'13186599003',0),(43,'PRODUCT_PERSON',1,'产品联系人',1,'','',1472609611,1472609621,1,'李曦',0),(44,'PRODUCT_PERSON_MOBILE',1,'产品联系人手机',1,'','',1472609652,1472609652,1,'13186599003',0),(45,'ACCEPT_ADDRESS',1,'应聘联系总部地址',1,'','',1472609952,1472609952,1,'南通市开发区通盛大道188号创业服务中心D座901',0),(46,'ACCEPT_CONTACT_TEL',1,'应聘联系电话',1,'','',1472609991,1472609991,1,'021-52406932',0);

/*Table structure for table `cishoo_contact` */

DROP TABLE IF EXISTS `cishoo_contact`;

CREATE TABLE `cishoo_contact` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(100) NOT NULL DEFAULT '' COMMENT '地址',
  `tel` varchar(20) NOT NULL DEFAULT '' COMMENT '电话',
  `qq` varchar(20) NOT NULL DEFAULT '' COMMENT 'qq',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '手机号',
  `email` varchar(20) NOT NULL DEFAULT '' COMMENT '邮箱',
  `wechat` varchar(20) NOT NULL DEFAULT '' COMMENT '微信',
  `contact_person` varchar(30) NOT NULL DEFAULT '' COMMENT '联系人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `cishoo_contact` */

insert  into `cishoo_contact`(`id`,`address`,`tel`,`qq`,`mobile`,`email`,`wechat`,`contact_person`) values (1,'上海市宝山区国权北路','026-698546','109876776','18986682546','','xiaoasheng11','桔子');

/*Table structure for table `cishoo_document` */

DROP TABLE IF EXISTS `cishoo_document`;

CREATE TABLE `cishoo_document` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `name` char(40) NOT NULL DEFAULT '' COMMENT '标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '标题',
  `category_id` int(10) unsigned NOT NULL COMMENT '所属分类',
  `description` char(140) NOT NULL DEFAULT '' COMMENT '描述',
  `root` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '根节点',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属ID',
  `model_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '内容模型ID',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '内容类型',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '推荐位',
  `link_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外链',
  `cover_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '图片',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '可见性',
  `deadline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '截至时间',
  `attach` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '附件数量',
  `view` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览量',
  `comment` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  `extend` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '扩展统计字段',
  `level` int(10) NOT NULL DEFAULT '0' COMMENT '优先级',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
  `title2` varchar(80) NOT NULL COMMENT '副标题',
  `hover_cover_id` int(10) unsigned NOT NULL COMMENT '鼠标悬停图',
  `url` varchar(255) NOT NULL COMMENT '跳转路径',
  PRIMARY KEY (`id`),
  KEY `idx_category_status` (`category_id`,`status`),
  KEY `idx_status_type_pid` (`status`,`uid`,`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='文档模型基础表';

/*Data for the table `cishoo_document` */

insert  into `cishoo_document`(`id`,`uid`,`name`,`title`,`category_id`,`description`,`root`,`pid`,`model_id`,`type`,`position`,`link_id`,`cover_id`,`display`,`deadline`,`attach`,`view`,`comment`,`extend`,`level`,`create_time`,`update_time`,`status`,`title2`,`hover_cover_id`,`url`) values (1,1,'','空间设备定位',2,'空间设备定位',0,0,2,2,0,0,22,1,0,0,8,0,0,0,1387260660,1476689001,1,'',25,'http://test.vr.net/Home/Product/index.html'),(2,1,'','虚拟现实设备',2,'',0,0,2,2,0,0,21,1,0,0,0,0,0,0,1472527980,1476688897,1,'',24,'http://test.vr.net/Home/Product/index.html'),(3,1,'','拟现实游戏娱乐',39,'背景图1',0,0,2,2,0,0,6,1,0,0,0,0,0,0,1472528118,1472528118,1,'',0,''),(4,1,'','虚拟样板间',39,'',0,0,2,2,0,0,6,1,0,0,0,0,0,0,1472528166,1472528166,1,'',0,''),(5,1,'','多人交互对战平台5',40,'',0,0,2,2,0,0,23,1,0,0,0,0,0,0,1472535720,1476179622,1,'基于HTC-VIVE一体化运营方案',0,''),(6,1,'','多人交互对战平台4',40,'',0,0,2,2,0,0,23,1,0,0,0,0,0,0,1472535900,1476179622,1,'基于HTC-VIVE一体化运营方案',0,''),(7,1,'','多人交互对战平台3',40,'',0,0,2,2,0,0,23,1,0,0,0,0,0,0,1472535960,1476179622,1,'基于HTC-VIVE一体化运营方案',0,''),(8,1,'','多人交互对战平台2',40,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472536020,1476179622,1,'基于HTC-VIVE一体化运营方案',0,''),(9,1,'','多人交互对战平台1',40,'',0,0,2,2,0,0,23,1,0,0,0,0,0,0,1472536020,1476179622,1,'基于HTC-VIVE一体化运营方案',0,''),(10,1,'','#',41,'',0,0,2,2,0,0,7,1,0,0,0,0,0,0,1472544470,1472544470,3,'',0,''),(12,1,'','岗位职责',50,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472610309,1476086338,1,'',0,''),(13,1,'','任职资格',51,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472610337,1472610337,1,'',0,''),(14,1,'','增值服务',46,'',0,0,2,2,0,0,13,1,0,0,0,0,0,0,1472611800,1472611852,1,'增值服务标题',0,''),(15,1,'','增值服务2',46,'',0,0,2,2,0,0,14,1,0,0,0,0,0,0,1472611884,1472611884,1,'增值服务标题',0,''),(16,1,'','增值服务3',46,'',0,0,2,2,0,0,15,1,0,0,0,0,0,0,1472611904,1472611904,1,'增值服务标题',0,''),(17,1,'','常见问题标题',45,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472611938,1472611938,1,'常见问题副标题',0,''),(18,1,'','常见问题标题2',45,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472611970,1472611970,1,'常见问题副标题',0,''),(19,1,'','常见问题3',45,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472611988,1472611988,1,'常见问题副标题',0,''),(20,1,'','盈利模式',44,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612012,1472612012,1,'盈利模式副标题',0,''),(21,1,'','盈利模式2',44,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612034,1472612034,1,'盈利模式副标题',0,''),(22,1,'','盈利模式3',44,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612053,1472612053,1,'盈利模式副标题',0,''),(23,1,'','增值服务4',46,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612082,1472612082,1,'增值服务副标题',0,''),(24,1,'','增值服务5',46,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612119,1472612119,1,'增值服务副标题',0,''),(25,1,'','常见问题4',45,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612100,1476693895,1,'常见问题副标题',0,''),(26,1,'','常见问题5',45,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612160,1476693929,1,'常见问题副标题',0,''),(27,1,'','盈利模式4',44,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612197,1472612197,1,'盈利模式副标题',0,''),(28,1,'','盈利模式5',44,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612218,1472612218,1,'盈利模式副标题',0,''),(29,1,'','加盟流程标题',43,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612245,1472612245,1,'加盟流程副标题',0,''),(30,1,'','加盟流程标题2',43,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612272,1472612272,1,'加盟流程副标题',0,''),(31,1,'','加盟流程3',43,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612302,1472612302,1,'加盟流程副标题',0,''),(32,1,'','加盟流程标题4',43,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612321,1472612321,1,'加盟流程副标题',0,''),(33,1,'','加盟流程5',43,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612342,1472612342,1,'加盟流程副标题',0,''),(34,1,'','加盟条件标题',42,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612340,1476693995,1,'加盟条件副标题',0,''),(35,1,'','加盟条件标题2',42,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612397,1476693993,1,'加盟条件副标题',0,''),(36,1,'','加盟条件3',42,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612414,1476693991,1,'加盟条件副标题',0,''),(37,1,'','加盟条件4',42,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612429,1476693989,1,'加盟条件副标题',0,''),(38,1,'','加盟条件标题5',42,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1472612449,1476693987,1,'加盟条件副标题',0,''),(41,1,'','s1',56,'',0,0,2,2,0,0,34,1,0,0,0,0,0,0,1476179038,1476179038,1,'',0,''),(42,1,'','s1',58,'',0,0,2,2,0,0,34,1,0,0,0,0,0,0,1476179131,1476179131,1,'',0,''),(43,1,'','fads',57,'',0,0,2,2,0,0,49,1,0,0,0,0,0,0,1476438034,1476438034,1,'',0,''),(44,1,'','test',42,'',0,0,2,2,0,0,0,1,0,0,0,0,0,0,1476694008,1476694008,1,'test',0,'');

/*Table structure for table `cishoo_document_article` */

DROP TABLE IF EXISTS `cishoo_document_article`;

CREATE TABLE `cishoo_document_article` (
  `id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文档ID',
  `parse` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '内容解析类型',
  `content` text NOT NULL COMMENT '文章内容',
  `template` varchar(100) NOT NULL DEFAULT '' COMMENT '详情页显示模板',
  `bookmark` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文档模型文章表';

/*Data for the table `cishoo_document_article` */

insert  into `cishoo_document_article`(`id`,`parse`,`content`,`template`,`bookmark`) values (1,0,'当您身临其境的置身于我们的X-star无限空间平台中，一切的曾经在屏幕上的事物\r\n                        便跃然眼前。逼真的画面，精准的定位，您享受到的将是一个全新的虚拟现实世界。','',0),(2,0,'基于目前体验度最好的VR虚拟现实设备HTC VIVE\r\n                        做了深度优化，解决了繁琐的布线和有限的区域限制，真正意义上让用户清爽的身临其境，享受那份独属于自己的酣畅淋漓。','',0),(3,0,'<pre>身临其境VR主题公园是继美国The void、澳洲Zero Latency 之后全球第三家，\r\n&nbsp; 中国首家正式商用的VR虚拟现实主题公园。在身临其境VR主题公园中，玩家将穿戴一体式计算背包，\r\n手持充满科幻色彩的炫感枪，在戴上身临其境VR头盔的一瞬间，真实世界瞬间消失，玩家进入了虚拟的外层空间，\r\n化身成为科幻片中的孤胆英雄，整装上阵，与外太空入侵者进行殊死搏斗。\r\n不仅如此，在一个相同的场地空间.</pre>','',0),(4,0,'<pre>身临其境VR主题公园是继美国The void、澳洲Zero Latency 之后全球第三家，\r\n&nbsp; 中国首家正式商用的VR虚拟现实主题公园。在身临其境VR主题公园中，玩家将穿戴一体式计算背包，\r\n手持充满科幻色彩的炫感枪，在戴上身临其境VR头盔的一瞬间，真实世界瞬间消失，玩家进入了虚拟的外层空间，\r\n化身成为科幻片中的孤胆英雄，整装上阵，与外太空入侵者进行殊死搏斗。\r\n不仅如此，在一个相同的场地空间.</pre>','',0),(5,0,'<span style=\"color:#FFFFFF;font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;background-color:#091A25;\">在无线空间行走平台您能身临其境，</span><br />\r\n<span style=\"color:#FFFFFF;font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;background-color:#091A25;\">置身于这些计算机屏幕上才有的虚拟世界之中。</span><br />\r\n<span style=\"color:#FFFFFF;font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;background-color:#091A25;\">您将会体验到无比逼真的画面和声音，</span><br />\r\n<span style=\"color:#FFFFFF;font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;background-color:#091A25;\">带您到另一个地方，另一个时代</span>','',0),(6,0,'<span style=\"color:#FFFFFF;font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;background-color:#030A0E;\">在无线空间行走平台您能身临其境，</span><br />\r\n<span style=\"color:#FFFFFF;font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;background-color:#030A0E;\">置身于这些计算机屏幕上才有的虚拟世界之中。</span><br />\r\n<span style=\"color:#FFFFFF;font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;background-color:#030A0E;\">您将会体验到无比逼真的画面和声音，</span><br />\r\n<span style=\"color:#FFFFFF;font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;background-color:#030A0E;\">带您到另一个地方，另一个时代</span>','',0),(7,0,'<span style=\"color:#FFFFFF;font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;background-color:#091A25;\">在无线空间行走平台您能身临其境，</span><br />\r\n<span style=\"color:#FFFFFF;font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;background-color:#091A25;\">置身于这些计算机屏幕上才有的虚拟世界之中。</span><br />\r\n<span style=\"color:#FFFFFF;font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;background-color:#091A25;\">您将会体验到无比逼真的画面和声音，</span><br />\r\n<span style=\"color:#FFFFFF;font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;background-color:#091A25;\">带您到另一个地方，另一个时代</span>','',0),(8,0,'<span style=\"color:#FFFFFF;font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;background-color:#030A0E;\">在无线空间行走平台您能身临其境，</span><br />\r\n<span style=\"color:#FFFFFF;font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;background-color:#030A0E;\">置身于这些计算机屏幕上才有的虚拟世界之中。</span><br />\r\n<span style=\"color:#FFFFFF;font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;background-color:#030A0E;\">您将会体验到无比逼真的画面和声音，</span><br />\r\n<span style=\"color:#FFFFFF;font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;background-color:#030A0E;\">带您到另一个地方，另一个时代</span>','',0),(9,0,'<span style=\"font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;\">在无线空间行走平台您能身临其境，</span><br />\r\n<span style=\"font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;\">置身于这些计算机屏幕上才有的虚拟世界之中。</span><br />\r\n<span style=\"font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;\">您将会体验到无比逼真的画面和声音，</span><br />\r\n<span style=\"font-family:ExtraLight, SimHei;font-size:26px;line-height:40px;\">带您到另一个地方，另一个时代</span>','',0),(10,0,'','',0),(12,0,'<div class=\"ft16 clf mtop12 pd_left16\" style=\"font-size:medium;color:#FFFFFF;font-family:Simsun;background-color:#091A25;\">\r\n	1.全面负责店面的日常事务管理等。\r\n</div>\r\n<div class=\"ft16 clf mtop12 pd_left16\" style=\"font-size:medium;color:#FFFFFF;font-family:Simsun;background-color:#091A25;\">\r\n	2.负责店面销售目标执行与跟进，完成预算利润指标\r\n</div>\r\n<div class=\"ft16 clf mtop12 pd_left16\" style=\"font-size:medium;color:#FFFFFF;font-family:Simsun;background-color:#091A25;\">\r\n	3.负责市场推广计划的执行及监督。\r\n</div>','',0),(13,0,'<div class=\"ft16 clf mtop12 pd_left16\" style=\"font-size:medium;color:#FFFFFF;font-family:Simsun;background-color:#091A25;\">\r\n	1.大学专科或以上学历。\r\n</div>\r\n<div class=\"ft16 clf mtop12 pd_left16\" style=\"font-size:medium;color:#FFFFFF;font-family:Simsun;background-color:#091A25;\">\r\n	2.有较强的人家交往能力，积极主动。能在压力下工作。\r\n</div>\r\n<div class=\"ft16 clf mtop12 pd_left16 mbottom60\" style=\"font-size:medium;color:#FFFFFF;font-family:Simsun;background-color:#091A25;\">\r\n	3.酒店管理、市场营销或相关管理专业优先。\r\n</div>','',0),(14,0,'增值服务内容<span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span>','',0),(15,0,'<span>增值服务内容<span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span></span>','',0),(16,0,'<span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span>','',0),(17,0,'常见问题内容<span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span>','',0),(18,0,'常见问题内容<span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span>','',0),(19,0,'<span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span><span>常见问题内容</span>','',0),(20,0,'盈利模式内容<span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span>','',0),(21,0,'<span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span>','',0),(22,0,'<span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span>','',0),(23,0,'增值服务内容<span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span>','',0),(24,0,'增值服务内容<span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span><span>增值服务内容</span>','',0),(25,0,'<span style=\"color:#41b1ff;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span>','',0),(26,0,'<span style=\"color:#41b1ff;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span><span style=\"color:#41B1FF;\">常见问题内容</span>','',0),(27,0,'盈利模式内容<span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span>盈利模式内容</span><span style=\"font-size:12px;line-height:18px;\">盈利模式内容</span>盈利模式内容<span style=\"font-size:12px;line-height:18px;\">盈利模式内容</span><span style=\"font-size:12px;line-height:18px;\">盈利模式内容</span>','',0),(28,0,'盈利模式内容<span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span><span style=\"font-size:13.3333px;\">盈利模式内容</span>','',0),(29,0,'加盟流程内容<span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span>','',0),(30,0,'加盟流程内容<span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span>','',0),(31,0,'加盟流程内容<span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span>','',0),(32,0,'加盟流程内容<span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span>','',0),(33,0,'加盟流程内容<span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span><span style=\"font-size:13.3333px;line-height:20px;\">加盟流程内容</span>','',0),(34,0,'<p>\r\n	<span><span>加盟条件内容</span></span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟</span> \r\n</p>\r\n<p>\r\n	<span>条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件</span> \r\n</p>\r\n<p>\r\n	<span>内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span> \r\n</p>\r\n<p>\r\n	<span>加盟条件内容</span><span>加盟条件内容</span><span style=\"color:#000000;\">&nbsp;</span> \r\n</p>','',0),(35,0,'<span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span>','',0),(36,0,'<span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span>','',0),(37,0,'<span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span><span>加盟条件内容</span>','',0),(38,0,'<span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span><span style=\"font-size:16px;line-height:24px;\">加盟条件内容</span>','',0),(39,0,'<p>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;关于我们\r\n</p>\r\n<p>\r\n	关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们\r\n</p>\r\n<p>\r\n	关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们\r\n</p>\r\n<p>\r\n	关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们\r\n</p>\r\n<p>\r\n	关于我们<strong></strong> \r\n</p>','',0),(40,0,'<p>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  关于我们\r\n</p>\r\n<p>\r\n	关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于\r\n</p>\r\n<p>\r\n	我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们\r\n</p>\r\n<p>\r\n	关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关于我们关\r\n</p>\r\n<p>\r\n	于我们关于我们关于我们关于我们关于我们关于我<span style=\"line-height:1.5;\">们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于</span> \r\n</p>\r\n<p>\r\n	<span style=\"line-height:1.5;\">我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span><span style=\"line-height:1.5;\">关于我们</span> \r\n</p>','',0),(41,0,'&nbsp; &nbsp;','',0),(42,0,'&nbsp;','',0),(43,0,'fd','',0),(44,0,'<span style=\"color:#41b1ff;\">atgaergtserghs45try5t</span>','',0);

/*Table structure for table `cishoo_document_download` */

DROP TABLE IF EXISTS `cishoo_document_download`;

CREATE TABLE `cishoo_document_download` (
  `id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文档ID',
  `parse` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '内容解析类型',
  `content` text NOT NULL COMMENT '下载详细描述',
  `template` varchar(100) NOT NULL DEFAULT '' COMMENT '详情页显示模板',
  `file_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件ID',
  `download` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `size` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文档模型下载表';

/*Data for the table `cishoo_document_download` */

/*Table structure for table `cishoo_file` */

DROP TABLE IF EXISTS `cishoo_file`;

CREATE TABLE `cishoo_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文件ID',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '原始文件名',
  `savename` char(20) NOT NULL DEFAULT '' COMMENT '保存名称',
  `savepath` char(30) NOT NULL DEFAULT '' COMMENT '文件保存路径',
  `ext` char(5) NOT NULL DEFAULT '' COMMENT '文件后缀',
  `mime` char(40) NOT NULL DEFAULT '' COMMENT '文件mime类型',
  `size` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `location` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '文件保存位置',
  `create_time` int(10) unsigned NOT NULL COMMENT '上传时间',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COMMENT='文件表';

/*Data for the table `cishoo_file` */

insert  into `cishoo_file`(`id`,`name`,`savename`,`savepath`,`ext`,`mime`,`size`,`md5`,`sha1`,`location`,`create_time`,`remark`) values (36,'57c67ec65dc23.mp4','57d8ba8fcef71.mp4','2016-09-14/','mp4','video/mp4',17378704,'03672460493917681bf94a5bb453ee85','cdb0967a179d14e6a3b5586aed3a2f463e9e2597',0,1473821327,NULL),(37,'57c67ec65dc23.mp4','57d8ba8fcef71.mp4','2016-09-14/','mp4','video/mp4',17378704,'03672460493917681bf94a5bb453ee85','cdb0967a179d14e6a3b5586aed3a2f463e9e2597',0,1473821327,'首页视频345'),(38,'57c67ec65dc23.mp4','57d8ba8fcef71.mp4','2016-09-14/','mp4','video/mp4',17378704,'03672460493917681bf94a5bb453ee85','cdb0967a179d14e6a3b5586aed3a2f463e9e2597',0,1473821327,'fasdfa'),(39,'57c67ec65dc23.mp4','57d8ba8fcef71.mp4','2016-09-14/','mp4','video/mp4',17378704,'03672460493917681bf94a5bb453ee85','cdb0967a179d14e6a3b5586aed3a2f463e9e2597',0,1473821327,'trewtwe'),(40,'57c67ec65dc23.mp4','57d8ba8fcef71.mp4','2016-09-14/','mp4','video/mp4',17378704,'03672460493917681bf94a5bb453ee85','cdb0967a179d14e6a3b5586aed3a2f463e9e2597',0,1473821327,'首页视频');

/*Table structure for table `cishoo_front_picture` */

DROP TABLE IF EXISTS `cishoo_front_picture`;

CREATE TABLE `cishoo_front_picture` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `picture_id` int(11) NOT NULL COMMENT '图片id',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '跳转地址',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '图片标题',
  `level` int(10) NOT NULL COMMENT '优先级',
  `type` varchar(20) NOT NULL COMMENT '图片类型',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `cishoo_front_picture` */

insert  into `cishoo_front_picture`(`id`,`picture_id`,`create_time`,`url`,`title`,`level`,`type`,`deleted`) values (1,7,0,'#','#',0,'banner',0),(5,7,0,'#','#',0,'banner',0),(17,32,1472627478,'','',0,'video',0),(22,40,1473833315,'','',0,'video',0);

/*Table structure for table `cishoo_hooks` */

DROP TABLE IF EXISTS `cishoo_hooks`;

CREATE TABLE `cishoo_hooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `description` text NOT NULL COMMENT '描述',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `addons` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子挂载的插件 ''，''分割',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `cishoo_hooks` */

insert  into `cishoo_hooks`(`id`,`name`,`description`,`type`,`update_time`,`addons`) values (1,'pageHeader','页面header钩子，一般用于加载插件CSS文件和代码',1,0,''),(2,'pageFooter','页面footer钩子，一般用于加载插件JS文件和JS代码',1,0,'ReturnTop'),(3,'documentEditForm','添加编辑表单的 扩展内容钩子',1,0,'Attachment'),(4,'documentDetailAfter','文档末尾显示',1,0,'Attachment,SocialComment'),(5,'documentDetailBefore','页面内容前显示用钩子',1,0,''),(6,'documentSaveComplete','保存文档数据后的扩展钩子',2,0,'Attachment'),(7,'documentEditFormContent','添加编辑表单的内容显示钩子',1,0,'Editor'),(8,'adminArticleEdit','后台内容编辑页编辑器',1,1378982734,'EditorForAdmin'),(13,'AdminIndex','首页小格子个性化显示',1,1382596073,'SiteStat,SystemInfo,DevTeam'),(14,'topicComment','评论提交方式扩展钩子。',1,1380163518,'Editor'),(16,'app_begin','应用开始',2,1384481614,'');

/*Table structure for table `cishoo_job_info` */

DROP TABLE IF EXISTS `cishoo_job_info`;

CREATE TABLE `cishoo_job_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL COMMENT '职位名称',
  `duty` text COMMENT '岗位职责',
  `qualified` text COMMENT '人指责格',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '最后更新时间',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `cishoo_job_info` */

insert  into `cishoo_job_info`(`id`,`name`,`duty`,`qualified`,`create_time`,`update_time`,`deleted`) values (3,'客服专员','<span>\r\n<div class=\"ft16 clf mtop12 pd_left16\" style=\"font-size:medium;color:#FFFFFF;font-family:\"background-color:#091A25;\">\r\n	<span style=\"color:#000000;\">1.大学专科或以上学历。</span>\r\n</div>\r\n<div class=\"ft16 clf mtop12 pd_left16\" style=\"font-size:medium;color:#FFFFFF;font-family:\"background-color:#091A25;\">\r\n	<span style=\"color:#000000;\">2.有较强的人家交往能力，积极主动。能在压力下工作。</span>\r\n</div>\r\n<div class=\"ft16 clf mtop12 pd_left16 mbottom60\" style=\"font-size:medium;color:#FFFFFF;font-family:\"background-color:#091A25;\">\r\n	<span style=\"color:#000000;\">3.酒店管理、市场营销或相关管理专业优先。</span>\r\n</div>\r\n</span>','<div class=\"ft16 clf mtop12 pd_left16\" style=\"font-size:medium;color:#FFFFFF;font-family:\" background-color:#091a25;\"=\"\"> <span style=\"color:#000000;\">1.全面负责店面的日常事务管理等。</span> \r\n	</div>\r\n<div class=\"ft16 clf mtop12 pd_left16\" style=\"font-size:medium;color:#FFFFFF;font-family:\" background-color:#091a25;\"=\"\"> <span style=\"color:#000000;\">2.负责店面销售目标执行与跟进，完成预算利润指标</span> \r\n</div>\r\n<div class=\"ft16 clf mtop12 pd_left16\" style=\"font-size:medium;color:#FFFFFF;font-family:\" background-color:#091a25;\"=\"\"> <span style=\"color:#000000;\">3.负责市场推广计划的执行及监督。</span> \r\n	</div>',1476153103,1476153103,0),(4,'运营专员','dfasfdasfasd','fsdafdsafdsaasdfasdfasdfdasf',1476155018,1476155018,0),(5,'testes','<ol class=\" list-paddingleft-2\">\r\n	<li>\r\n		<p>\r\n			大学专科或以上学历.\r\n		</p>\r\n	</li>\r\n	<li>\r\n		<p>\r\n			有较强的人家交往能力，积极主动。能在压力下工作。\r\n		</p>\r\n	</li>\r\n	<li>\r\n		<p>\r\n			酒店管理、市场营销或相关管理专业优先\r\n		</p>\r\n	</li>\r\n</ol>','o',1476156373,1476156373,0);

/*Table structure for table `cishoo_member` */

DROP TABLE IF EXISTS `cishoo_member`;

CREATE TABLE `cishoo_member` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `nickname` char(16) NOT NULL DEFAULT '' COMMENT '昵称',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '性别',
  `birthday` date NOT NULL DEFAULT '0000-00-00' COMMENT '生日',
  `qq` char(10) NOT NULL DEFAULT '' COMMENT 'qq号',
  `score` mediumint(8) NOT NULL DEFAULT '0' COMMENT '用户积分',
  `login` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '会员状态',
  PRIMARY KEY (`uid`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='会员表';

/*Data for the table `cishoo_member` */

insert  into `cishoo_member`(`uid`,`nickname`,`sex`,`birthday`,`qq`,`score`,`login`,`reg_ip`,`reg_time`,`last_login_ip`,`last_login_time`,`status`) values (1,'admin',0,'0000-00-00','',150,40,0,1472454562,3232240385,1481161354,1);

/*Table structure for table `cishoo_menu` */

DROP TABLE IF EXISTS `cishoo_menu`;

CREATE TABLE `cishoo_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `tip` varchar(255) NOT NULL DEFAULT '' COMMENT '提示',
  `group` varchar(50) DEFAULT '' COMMENT '分组',
  `is_dev` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否仅开发者模式可见',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8;

/*Data for the table `cishoo_menu` */

insert  into `cishoo_menu`(`id`,`title`,`pid`,`sort`,`url`,`hide`,`tip`,`group`,`is_dev`) values (1,'首页',0,1,'Index/index',0,'','',0),(2,'内容',0,2,'Article/mydocument',0,'','',0),(3,'首页介绍',2,0,'article/index',1,'','内容',0),(4,'新增',3,0,'article/add',0,'','',0),(5,'编辑',3,0,'article/edit',0,'','',0),(6,'改变状态',3,0,'article/setStatus',0,'','',0),(7,'保存',3,0,'article/update',0,'','',0),(8,'保存草稿',3,0,'article/autoSave',0,'','',0),(9,'移动',3,0,'article/move',0,'','',0),(10,'复制',3,0,'article/copy',0,'','',0),(11,'粘贴',3,0,'article/paste',0,'','',0),(12,'导入',3,0,'article/batchOperate',0,'','',0),(13,'回收站',2,0,'article/recycle',1,'','内容',0),(14,'还原',13,0,'article/permit',0,'','',0),(15,'清空',13,0,'article/clear',0,'','',0),(16,'用户',0,4,'User/index',0,'','',0),(17,'用户信息',16,0,'User/index',0,'','用户管理',0),(18,'新增用户',17,0,'User/add',0,'添加新用户','',0),(19,'用户行为',16,0,'User/action',0,'','行为管理',0),(20,'新增用户行为',19,0,'User/addaction',0,'','',0),(21,'编辑用户行为',19,0,'User/editaction',0,'','',0),(22,'保存用户行为',19,0,'User/saveAction',0,'\"用户->用户行为\"保存编辑和新增的用户行为','',0),(23,'变更行为状态',19,0,'User/setStatus',0,'\"用户->用户行为\"中的启用,禁用和删除权限','',0),(24,'禁用会员',19,0,'User/changeStatus?method=forbidUser',0,'\"用户->用户信息\"中的禁用','',0),(25,'启用会员',19,0,'User/changeStatus?method=resumeUser',0,'\"用户->用户信息\"中的启用','',0),(26,'删除会员',19,0,'User/changeStatus?method=deleteUser',0,'\"用户->用户信息\"中的删除','',0),(27,'权限管理',16,0,'AuthManager/index',0,'','用户管理',0),(28,'删除',27,0,'AuthManager/changeStatus?method=deleteGroup',0,'删除用户组','',0),(29,'禁用',27,0,'AuthManager/changeStatus?method=forbidGroup',0,'禁用用户组','',0),(30,'恢复',27,0,'AuthManager/changeStatus?method=resumeGroup',0,'恢复已禁用的用户组','',0),(31,'新增',27,0,'AuthManager/createGroup',0,'创建新的用户组','',0),(32,'编辑',27,0,'AuthManager/editGroup',0,'编辑用户组名称和描述','',0),(33,'保存用户组',27,0,'AuthManager/writeGroup',0,'新增和编辑用户组的\"保存\"按钮','',0),(34,'授权',27,0,'AuthManager/group',0,'\"后台 \\ 用户 \\ 用户信息\"列表页的\"授权\"操作按钮,用于设置用户所属用户组','',0),(35,'访问授权',27,0,'AuthManager/access',0,'\"后台 \\ 用户 \\ 权限管理\"列表页的\"访问授权\"操作按钮','',0),(36,'成员授权',27,0,'AuthManager/user',0,'\"后台 \\ 用户 \\ 权限管理\"列表页的\"成员授权\"操作按钮','',0),(37,'解除授权',27,0,'AuthManager/removeFromGroup',0,'\"成员授权\"列表页内的解除授权操作按钮','',0),(38,'保存成员授权',27,0,'AuthManager/addToGroup',0,'\"用户信息\"列表页\"授权\"时的\"保存\"按钮和\"成员授权\"里右上角的\"添加\"按钮)','',0),(39,'分类授权',27,0,'AuthManager/category',0,'\"后台 \\ 用户 \\ 权限管理\"列表页的\"分类授权\"操作按钮','',0),(40,'保存分类授权',27,0,'AuthManager/addToCategory',0,'\"分类授权\"页面的\"保存\"按钮','',0),(41,'模型授权',27,0,'AuthManager/modelauth',0,'\"后台 \\ 用户 \\ 权限管理\"列表页的\"模型授权\"操作按钮','',0),(42,'保存模型授权',27,0,'AuthManager/addToModel',0,'\"分类授权\"页面的\"保存\"按钮','',0),(43,'扩展',0,7,'Addons/index',0,'','',0),(44,'插件管理',43,1,'Addons/index',0,'','扩展',0),(45,'创建',44,0,'Addons/create',0,'服务器上创建插件结构向导','',0),(46,'检测创建',44,0,'Addons/checkForm',0,'检测插件是否可以创建','',0),(47,'预览',44,0,'Addons/preview',0,'预览插件定义类文件','',0),(48,'快速生成插件',44,0,'Addons/build',0,'开始生成插件结构','',0),(49,'设置',44,0,'Addons/config',0,'设置插件配置','',0),(50,'禁用',44,0,'Addons/disable',0,'禁用插件','',0),(51,'启用',44,0,'Addons/enable',0,'启用插件','',0),(52,'安装',44,0,'Addons/install',0,'安装插件','',0),(53,'卸载',44,0,'Addons/uninstall',0,'卸载插件','',0),(54,'更新配置',44,0,'Addons/saveconfig',0,'更新插件配置处理','',0),(55,'插件后台列表',44,0,'Addons/adminList',0,'','',0),(56,'URL方式访问插件',44,0,'Addons/execute',0,'控制是否有权限通过url访问插件控制器方法','',0),(57,'钩子管理',43,2,'Addons/hooks',0,'','扩展',0),(58,'模型管理',68,3,'Model/index',0,'','系统设置',0),(59,'新增',58,0,'model/add',0,'','',0),(60,'编辑',58,0,'model/edit',0,'','',0),(61,'改变状态',58,0,'model/setStatus',0,'','',0),(62,'保存数据',58,0,'model/update',0,'','',0),(63,'属性管理',68,0,'Attribute/index',1,'网站属性配置。','',0),(64,'新增',63,0,'Attribute/add',0,'','',0),(65,'编辑',63,0,'Attribute/edit',0,'','',0),(66,'改变状态',63,0,'Attribute/setStatus',0,'','',0),(67,'保存数据',63,0,'Attribute/update',0,'','',0),(68,'系统',0,5,'Config/group',0,'','',0),(69,'网站设置',68,1,'Config/group',0,'','系统设置',0),(70,'配置管理',68,4,'Config/index',0,'','系统设置',0),(71,'编辑',70,0,'Config/edit',0,'新增编辑和保存配置','',0),(72,'删除',70,0,'Config/del',0,'删除配置','',0),(73,'新增',70,0,'Config/add',0,'新增配置','',0),(74,'保存',70,0,'Config/save',0,'保存配置','',0),(75,'菜单管理',68,5,'Menu/index',0,'','系统设置',0),(76,'导航管理',68,6,'Channel/index',0,'','系统设置',0),(77,'新增',76,0,'Channel/add',0,'','',0),(78,'编辑',76,0,'Channel/edit',0,'','',0),(79,'删除',76,0,'Channel/del',0,'','',0),(80,'分类管理',68,2,'Category/index',0,'','系统设置',0),(81,'编辑',80,0,'Category/edit',0,'编辑和保存栏目分类','',0),(82,'新增',80,0,'Category/add',0,'新增栏目分类','',0),(83,'删除',80,0,'Category/remove',0,'删除栏目分类','',0),(84,'移动',80,0,'Category/operate/type/move',0,'移动栏目分类','',0),(85,'合并',80,0,'Category/operate/type/merge',0,'合并栏目分类','',0),(86,'备份数据库',68,0,'Database/index?type=export',0,'','数据备份',0),(87,'备份',86,0,'Database/export',0,'备份数据库','',0),(88,'优化表',86,0,'Database/optimize',0,'优化数据表','',0),(89,'修复表',86,0,'Database/repair',0,'修复数据表','',0),(90,'还原数据库',68,0,'Database/index?type=import',0,'','数据备份',0),(91,'恢复',90,0,'Database/import',0,'数据库恢复','',0),(92,'删除',90,0,'Database/del',0,'删除备份文件','',0),(93,'其他',0,6,'other',1,'','',0),(96,'新增',75,0,'Menu/add',0,'','系统设置',0),(98,'编辑',75,0,'Menu/edit',0,'','',0),(104,'下载管理',102,0,'Think/lists?model=download',0,'','',0),(105,'配置管理',102,0,'Think/lists?model=config',0,'','',0),(106,'行为日志',16,0,'Action/actionlog',0,'','行为管理',0),(108,'修改密码',16,0,'User/updatePassword',1,'','',0),(109,'修改昵称',16,0,'User/updateNickname',1,'','',0),(110,'查看行为日志',106,0,'action/edit',1,'','',0),(112,'新增数据',58,0,'think/add',1,'','',0),(113,'编辑数据',58,0,'think/edit',1,'','',0),(114,'导入',75,0,'Menu/import',0,'','',0),(115,'生成',58,0,'Model/generate',0,'','',0),(116,'新增钩子',57,0,'Addons/addHook',0,'','',0),(117,'编辑钩子',57,0,'Addons/edithook',0,'','',0),(118,'文档排序',3,0,'Article/sort',1,'','',0),(119,'排序',70,0,'Config/sort',1,'','',0),(120,'排序',75,0,'Menu/sort',1,'','',0),(121,'排序',76,0,'Channel/sort',1,'','',0),(122,'关于我们',123,0,'About/index',0,'','网站管理',0),(123,'网站',0,3,'About/index',0,'','',0),(124,'首页banner',123,0,'Banner/index',0,'','网站管理',0),(125,'添加banner',124,0,'Banner/add',0,'','网站',0),(126,'编辑banner',124,0,'Banner/edit',0,'','网站',0),(127,'首页视频',123,0,'Video/index',0,'','',0),(128,'添加首页视频',127,0,'Video/add',0,'','',0),(129,'产品介绍',123,0,'Product/index',0,'','网站管理',0),(130,'添加产品图',129,0,'Product/add',1,'','网站',0),(131,'修改产品图',129,0,'Product/edit',1,'','网站',0),(132,'编辑首页视频',127,0,'Video/edit',0,'','',0),(133,'留言信息',123,0,'Message/index',0,'','网站管理',0),(134,'查看留言信息',133,0,'Message/look',1,'','网站',0),(135,'信息写入',127,0,'Vedio/write',0,'','',0),(136,'岗位信息',123,0,'Job/index',0,'','网站管理',0),(137,'新增',136,0,'Job/add',0,'','',0),(138,'编辑',136,0,'Job/edit',0,'','',0),(139,'写入',136,0,'Job/write',0,'','',0),(140,'删除',136,0,'Job/del',0,'','',0);

/*Table structure for table `cishoo_message` */

DROP TABLE IF EXISTS `cishoo_message`;

CREATE TABLE `cishoo_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '姓名',
  `sex` tinyint(4) NOT NULL DEFAULT '0' COMMENT '性别 0女，1男',
  `phone` varchar(20) NOT NULL DEFAULT '' COMMENT '电话',
  `address` varchar(50) NOT NULL DEFAULT '' COMMENT '地址',
  `message` varchar(500) NOT NULL DEFAULT '' COMMENT '留言信息',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `cishoo_message` */

insert  into `cishoo_message`(`id`,`name`,`sex`,`phone`,`address`,`message`,`create_time`) values (4,'juzi',0,'18986682546','','hello wrold',1472635325),(5,'juzi',0,'18986682546','','fdasfdsa',1472635514),(6,'apple',0,'1898668246','湖北省恩施市','今天天气不错',1472635552),(7,'caomei',0,'1865849444','','hello world',1472635596),(8,'啊啊啊',0,'啊啊','啊啊省啊啊市','啊啊啊',1472636423),(9,'fdas',1,'fads','fdas省fdas市','fdas',1473843841),(10,'fdas',1,'fdas','fdsa省sadf市','adfs',1473843868),(11,'fdas',0,'fads','','                             ',1473844294);

/*Table structure for table `cishoo_model` */

DROP TABLE IF EXISTS `cishoo_model`;

CREATE TABLE `cishoo_model` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '模型ID',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '模型标识',
  `title` char(30) NOT NULL DEFAULT '' COMMENT '模型名称',
  `extend` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '继承的模型',
  `relation` varchar(30) NOT NULL DEFAULT '' COMMENT '继承与被继承模型的关联字段',
  `need_pk` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '新建表时是否需要主键字段',
  `field_sort` text NOT NULL COMMENT '表单字段排序',
  `field_group` varchar(255) NOT NULL DEFAULT '1:基础' COMMENT '字段分组',
  `attribute_list` text NOT NULL COMMENT '属性列表（表的字段）',
  `template_list` varchar(100) NOT NULL DEFAULT '' COMMENT '列表模板',
  `template_add` varchar(100) NOT NULL DEFAULT '' COMMENT '新增模板',
  `template_edit` varchar(100) NOT NULL DEFAULT '' COMMENT '编辑模板',
  `list_grid` text NOT NULL COMMENT '列表定义',
  `list_row` smallint(2) unsigned NOT NULL DEFAULT '10' COMMENT '列表数据长度',
  `search_key` varchar(50) NOT NULL DEFAULT '' COMMENT '默认搜索字段',
  `search_list` varchar(255) NOT NULL DEFAULT '' COMMENT '高级搜索的字段',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `engine_type` varchar(25) NOT NULL DEFAULT 'MyISAM' COMMENT '数据库引擎',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='文档模型表';

/*Data for the table `cishoo_model` */

insert  into `cishoo_model`(`id`,`name`,`title`,`extend`,`relation`,`need_pk`,`field_sort`,`field_group`,`attribute_list`,`template_list`,`template_add`,`template_edit`,`list_grid`,`list_row`,`search_key`,`search_list`,`create_time`,`update_time`,`status`,`engine_type`) values (1,'document','基础文档',0,'',1,'{\"1\":[\"43\",\"39\",\"38\",\"2\",\"3\",\"5\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"16\",\"17\",\"19\",\"20\"]}','1:基础','','','','','id:编号\r\ntitle:标题:article/index?cate_id=[category_id]&pid=[id]\r\ntitle:副标题\r\ntype|get_document_type:类型\r\nlevel:优先级\r\nupdate_time|time_format:最后更新\r\nstatus_text:状态\r\nview:浏览\r\nid:操作:[EDIT]&cate_id=[category_id]|编辑,article/setstatus?status=-1&ids=[id]|删除',0,'','',1383891233,1476687827,1,'MyISAM'),(2,'article','文章',1,'',1,'{\"1\":[\"3\",\"38\",\"24\",\"2\",\"5\",\"12\",\"39\"],\"2\":[\"9\",\"13\",\"19\",\"10\",\"16\",\"17\",\"26\",\"20\",\"14\",\"11\",\"25\"]}','1:基础,2:扩展','','','','','id:编号\r\ntitle:标题:article/edit?cate_id=[category_id]&id=[id]\r\ncontent:内容',0,'','',1383891243,1474447270,1,'MyISAM'),(3,'download','下载',1,'',1,'{\"1\":[\"3\",\"28\",\"30\",\"32\",\"2\",\"5\",\"31\"],\"2\":[\"13\",\"10\",\"27\",\"9\",\"12\",\"16\",\"17\",\"19\",\"11\",\"20\",\"14\",\"29\"]}','1:基础,2:扩展','','','','','id:编号\r\ntitle:标题',0,'','',1383891252,1387260449,1,'MyISAM'),(4,'document_article','document_article',0,'',1,'','1:基础','','','','','',10,'','',1472456850,1472456850,1,'MyISAM'),(5,'cishoo_zxns','招贤纳士信息表',0,'',1,'{\"1\":[\"40\",\"41\",\"42\"]}','1:基础','','','','','id:编号',10,'','',1476085823,1476087070,1,'InnoDB');

/*Table structure for table `cishoo_picture` */

DROP TABLE IF EXISTS `cishoo_picture`;

CREATE TABLE `cishoo_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id自增',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '用于alt属性',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '图片类型',
  `level` int(11) NOT NULL DEFAULT '0' COMMENT '优先级',
  `marks` varchar(20) NOT NULL DEFAULT '' COMMENT '图片标识（区分展示模块，如banner）',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '删除标识0未删除，1已删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

/*Data for the table `cishoo_picture` */

insert  into `cishoo_picture`(`id`,`path`,`url`,`md5`,`sha1`,`status`,`create_time`,`title`,`type`,`level`,`marks`,`update_time`,`deleted`) values (7,'/Uploads/Picture/2016-08-30/57c5211631a9b.jpg','','774cfa69f452a84f892e2797fa019e4f','3c1d3103e50a7f49a85b9a7b507059181d0e1eba',1,1472536854,'','image/jpeg',0,'banner',0,0),(8,'/Uploads/Picture/2016-08-30/57c5211631a9b.jpg','#','774cfa69f452a84f892e2797fa019e4f','3c1d3103e50a7f49a85b9a7b507059181d0e1eba',1,1472536854,'','image/jpeg',0,'banner',0,0),(12,'/Uploads/Picture/2016-08-31/57c645d3d1f4e.png','','7635dcea76b3da0a1497d8acd9f9af52','614109da9d44cfa6410fc25d835a5f0d53a28870',1,1472611795,'','image/png',0,'',0,0),(13,'/Uploads/Picture/2016-08-31/57c6460b3c50e.jpg','','ba45c8f60456a672e003a875e469d0eb','30420d1a9afb2bcb60335812569af4435a59ce17',1,1472611851,'','image/jpeg',0,'',0,0),(14,'/Uploads/Picture/2016-08-31/57c6462b2cdb0.jpg','','bdf3bf1da3405725be763540d6601144','d997e1c37edc05ad87d03603e32ad495ee2cfce1',1,1472611883,'','image/jpeg',0,'',0,0),(15,'/Uploads/Picture/2016-08-31/57c6463f684a7.jpg','','5a44c7ba5bbe4ec867233d67e4806848','3b15be84aff20b322a93c0b9aaa62e25ad33b4b4',1,1472611903,'','image/jpeg',0,'',0,0),(18,'/Uploads/Picture/2016-08-31/57c64fb78ba54.jpg','','692336e2a88338a6d392a569cff87461','ae1973279ddacb9708391ef3625ed5dd71c9d7f6',1,1472614327,'','image/jpeg',0,'',0,0),(20,'/Uploads/Picture/2016-08-31/57c670eba28fa.png','','6a68484620f2aea064d6448d38bd908d','b75540a23d3df67421a5ab70e21816c8d7a0256b',1,1472622827,'','image/png',0,'',0,0),(21,'/Uploads/Picture/2016-08-31/57c6a9487748d.png','','a680f4b809e212f2041aa383e3c58ef3','f4035d27dc7793a641013b43f504dbc66df0dde7',1,1472637256,'','image/png',0,'',0,0),(22,'/Uploads/Picture/2016-08-31/57c6a99e55731.png','','5712985b7cfb3df60044794e1ab0e4b2','38a72da899d47021ce002402c21e458dc90b51bf',1,1472637342,'','image/png',0,'',0,0),(23,'/Uploads/Picture/2016-09-14/57d8c00d1a51e.png','','7bdd8a54305100c59cf6ce25e2807db5','2d7441e870f80c2ecd8964abb434fdf95e667bc8',1,1473822733,'','image/png',0,'',0,0),(24,'/Uploads/Picture/2016-09-21/57e248067afa4.png','','da09840700e97b700347ba78851898da','3008fd24a13b0aca042ae4bd0b81dc5003a24fd8',1,1474447366,'','image/png',0,'',0,0),(25,'/Uploads/Picture/2016-09-21/57e2481719835.png','','80e2aeddfb9eeb1674d837c3bf9f0afb','c306ac220c4f1fa3ed85e68125e08d441ca95272',1,1474447383,'','image/png',0,'',0,0),(33,'/Uploads/Picture/2016-10-11/57fc810f7df7f.png','','7cdd46492752a23a35d1d7de9af32f4a','1043a2fa4ba9f8d96bca4c3c9e7acaaba52af516',1,1476165903,'','image/png',0,'p1',1476165905,0),(34,'/Uploads/Picture/2016-10-11/57fc811d87ff8.png','','fbe0a75cf7275f9052c03cda295560c1','b1b42ff60b9ddbb7144c01355e55ff579e069489',1,1476165917,'','image/png',0,'p1',1476165919,0),(35,'/Uploads/Picture/2016-10-11/57fc841a5cf2a.jpg','','0273a8ea189718541f401531757740b2','08f15f1740ebfb0b150827ba093691c753361bd2',1,1476166682,'','image/jpeg',0,'',0,0),(36,'/Uploads/Picture/2016-10-11/57fc852bbdde7.png','','e800599752aec2c7f5c3ba8f691c3ee0','c9d6afe2b3bd9cacf578e1d64dc14f1abafec13d',1,1476166955,'','image/png',0,'',0,0),(37,'/Uploads/Picture/2016-10-11/57fc86d5e7f13.png','','2fc2389771f527647b762ae85422fad5','e7723a299faff48d4572d67c3ae21f3ca367ebb1',1,1476167381,'','image/png',0,'p1',1476167384,0),(43,'/Uploads/Picture/2016-10-11/57fc94e17c487.png','','a3c1fa59aac2390d832845d5d09c7542','3b51397976e83f8b8f5ae38fd3482fadf7c42028',1,1476170977,'','image/png',0,'p1',1476174128,0),(46,'/Uploads/Picture/2016-10-11/57fc96204d6e3.jpg','','752dde8d5209cb3fe9fe7da14bf92b19','fd8d1f103e23a271718276708665e01edca1d529',1,1476171296,'','image/jpeg',0,'',0,0),(47,'/Uploads/Picture/2016-10-11/57fcad178940c.jpg','','1474c30ab022640b6b9bfd9fd71fc44e','1a457415647543f8f507d1983530a53b05cb4c6d',1,1476177175,'','image/jpeg',0,'',0,0),(48,'/Uploads/Picture/2016-10-14/5800a7097611d.png','','7917760523a8f76d78e2d490a11480fa','7e94c03c01f8a87ec7a7f6f4ca662187d0704435',1,1476437769,'','image/png',0,'',0,0),(49,'/Uploads/Picture/2016-10-14/5800a81107e6b.jpg','','6e68574863c8b53e162b338d2342d52a','6d2e5572d2b208567c6cf9bc341e81703002e48c',1,1476438033,'','image/jpeg',0,'',0,0);

/*Table structure for table `cishoo_ucenter_admin` */

DROP TABLE IF EXISTS `cishoo_ucenter_admin`;

CREATE TABLE `cishoo_ucenter_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员用户ID',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '管理员状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员表';

/*Data for the table `cishoo_ucenter_admin` */

/*Table structure for table `cishoo_ucenter_app` */

DROP TABLE IF EXISTS `cishoo_ucenter_app`;

CREATE TABLE `cishoo_ucenter_app` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '应用ID',
  `title` varchar(30) NOT NULL COMMENT '应用名称',
  `url` varchar(100) NOT NULL COMMENT '应用URL',
  `ip` char(15) NOT NULL COMMENT '应用IP',
  `auth_key` varchar(100) NOT NULL COMMENT '加密KEY',
  `sys_login` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '同步登陆',
  `allow_ip` varchar(255) NOT NULL COMMENT '允许访问的IP',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '应用状态',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='应用表';

/*Data for the table `cishoo_ucenter_app` */

/*Table structure for table `cishoo_ucenter_member` */

DROP TABLE IF EXISTS `cishoo_ucenter_member`;

CREATE TABLE `cishoo_ucenter_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` char(16) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `email` char(32) NOT NULL COMMENT '用户邮箱',
  `mobile` char(15) NOT NULL COMMENT '用户手机',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) DEFAULT '0' COMMENT '用户状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

/*Data for the table `cishoo_ucenter_member` */

insert  into `cishoo_ucenter_member`(`id`,`username`,`password`,`email`,`mobile`,`reg_time`,`reg_ip`,`last_login_time`,`last_login_ip`,`update_time`,`status`) values (1,'admin','0ab4ca2ea4e0941a9183461ed0198cc9','xcsdyx123@126.com','',1472454562,3232289025,1481161354,3232240385,1472454562,1);

/*Table structure for table `cishoo_ucenter_setting` */

DROP TABLE IF EXISTS `cishoo_ucenter_setting`;

CREATE TABLE `cishoo_ucenter_setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '设置ID',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型（1-用户配置）',
  `value` text NOT NULL COMMENT '配置数据',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='设置表';

/*Data for the table `cishoo_ucenter_setting` */

/*Table structure for table `cishoo_url` */

DROP TABLE IF EXISTS `cishoo_url`;

CREATE TABLE `cishoo_url` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '链接唯一标识',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `short` char(100) NOT NULL DEFAULT '' COMMENT '短网址',
  `status` tinyint(2) NOT NULL DEFAULT '2' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='链接表';

/*Data for the table `cishoo_url` */

/*Table structure for table `cishoo_userdata` */

DROP TABLE IF EXISTS `cishoo_userdata`;

CREATE TABLE `cishoo_userdata` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `type` tinyint(3) unsigned NOT NULL COMMENT '类型标识',
  `target_id` int(10) unsigned NOT NULL COMMENT '目标id',
  UNIQUE KEY `uid` (`uid`,`type`,`target_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cishoo_userdata` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
