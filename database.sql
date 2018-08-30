#用户表
DROP TABLE IF EXISTS `cd_user`;
CREATE TABLE `cd_user`(
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `creater_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '创建人ID',
  `username` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `auth_key` char(100) NOT NULL DEFAULT '',
  `password_hash` char(100) NOT NULL DEFAULT '',
  `password_reset_token` char(100) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '',
  `created_at` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
  `login_at` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
  `remark` text COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `creater_id` (`creater_id`),
  KEY `username` (`username`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT '用户表';

DROP TABLE IF EXISTS `cd_admin_log`;
CREATE TABLE `cd_admin_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) NOT NULL DEFAULT '0' COMMENT '操作人id',
  `level` int(11) DEFAULT '0',
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_time` double DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '日志类型',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '标题',
  `server_ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `client_ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `prefix` text COLLATE utf8_unicode_ci,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_log_level` (`level`),
  KEY `uid` (`uid`),
  KEY `type` (`type`),
  KEY `idx_log_category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#机房表
DROP TABLE IF EXISTS `cd_server_room`;
CREATE TABLE `cd_server_room`(
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `creater_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '创建人ID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '',
  `desc` varchar(1000) NOT NULL DEFAULT '' COMMENT '',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '',
  `type` varchar(50) NOT NULL DEFAULT '' COMMENT '类型',
  `created_at` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
  `order` int(10) unsigned NOT NULL DEFAULT 0,
  `remark` text COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `creater_id` (`creater_id`),
  KEY `name` (`name`),
  KEY `type` (`type`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT '机房表';

#服务器分组表
DROP TABLE IF EXISTS `cd_server_group`;
CREATE TABLE `cd_server_group`(
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `creater_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '创建人ID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '',
  `desc` varchar(1000) NOT NULL DEFAULT '' COMMENT '',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '',
  `type` varchar(50) NOT NULL DEFAULT '' COMMENT '类型',
  `created_at` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
  `order` int(10) unsigned NOT NULL DEFAULT 0,
  `remark` text COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `creater_id` (`creater_id`),
  KEY `name` (`name`),
  KEY `type` (`type`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT '服务器分组表';

#服务器表
DROP TABLE IF EXISTS `cd_server`;
CREATE TABLE `cd_server` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `room_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '机房',
  `creater_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '创建人ID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '',
  `desc` varchar(1000) NOT NULL DEFAULT '' COMMENT '',
  `ip` varchar(255) NOT NULL DEFAULT '' COMMENT '外网',
  `inner_ip` varchar(255) NOT NULL DEFAULT '' COMMENT '内网',
  `port` int(6) NOT NULL DEFAULT 22 COMMENT '端口',
  `ssh_private_key` varchar(1000) NOT NULL DEFAULT '' COMMENT '',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '',
  `type` varchar(50) NOT NULL DEFAULT '' COMMENT '类型',
  `level` varchar(50) NOT NULL DEFAULT '' COMMENT '级别',
  `created_at` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
  `order` int(10) unsigned NOT NULL DEFAULT 0,
  `remark` text COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `creater_id` (`creater_id`),
  KEY `room_id` (`room_id`),
  KEY `name` (`name`),
  KEY `ip` (`ip`),
  KEY `inner_ip` (`inner_ip`),
  KEY `status` (`status`),
  KEY `type` (`type`),
  KEY `level` (`level`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT '服务器表';


#项目表分组表
DROP TABLE IF EXISTS `cd_project_group`;
CREATE TABLE `cd_project_group`(
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `creater_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '创建人ID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '',
  `desc` varchar(1000) NOT NULL DEFAULT '' COMMENT '',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '',
  `type` varchar(50) NOT NULL DEFAULT '' COMMENT '类型',
  `created_at` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
  `order` int(10) unsigned NOT NULL DEFAULT 0,
  `remark` text COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `creater_id` (`creater_id`),
  KEY `name` (`name`),
  KEY `type` (`type`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT '项目表分组表';

CREATE TABLE `cd_server_group_server` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` bigint(20) NOT NULL DEFAULT '0',
  `server_id` bigint(20) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `server_id` (`server_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


#项目表
DROP TABLE IF EXISTS `cd_project`;
CREATE TABLE `cd_project`(
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `creater_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '创建人ID',
  `project_group_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '',
  `repo_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:git,2:svn',
  `repo_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '仓库ID',
  `repo_address` varchar(1000) NOT NULL DEFAULT '' COMMENT '',
  `repo_account` varchar(255) NOT NULL DEFAULT '' COMMENT '',
  `repo_password` varchar(255) NOT NULL DEFAULT '' COMMENT '',
  `repo_private_key` varchar(1000) NOT NULL DEFAULT '' COMMENT '',
  `repo_branch` varchar(50) NOT NULL DEFAULT '' COMMENT '',
  `desc` varchar(1000) NOT NULL DEFAULT '' COMMENT '',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '',
  `type` varchar(50) NOT NULL DEFAULT '' COMMENT '类型',
  `published_at` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
  `created_at` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
  `order` int(10) unsigned NOT NULL DEFAULT 0,
  `remark` text COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `creater_id` (`creater_id`),
  KEY `repo_id` (`repo_id`),
  KEY `project_group_id` (`project_group_id`),
  KEY `name` (`name`),
  KEY `type` (`type`),
  KEY `repo_type` (`repo_type`),
  KEY `published_at` (`published_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT '项目表';


DROP TABLE IF EXISTS `cd_project_job`;
CREATE TABLE `cd_project_job` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '',
  `creater_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '发布人ID',
  `name` varchar(255) NOT NULL DEFAULT '',
  `action_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '',
  `action_name` varchar(255) NOT NULL DEFAULT '' COMMENT '',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `type` varchar(50) NOT NULL DEFAULT '' COMMENT '类型',
  `started_at` int(10) unsigned NOT NULL DEFAULT '0',
  `finished_at` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` int(10) unsigned NOT NULL DEFAULT '0',
  `variable` text COMMENT '',
  `messages` text COMMENT 'message',
  `desc` text COMMENT '',
  `remark` text COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `creater_id` (`creater_id`),
  KEY `project_id` (`project_id`),
  KEY `name` (`name`),
  KEY `type` (`type`),
  KEY `started_at` (`started_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT '';


DROP TABLE IF EXISTS `cd_project_action`;
CREATE TABLE `cd_project_action` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '',
  `action_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '',
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `action_id` (`action_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT '';


DROP TABLE IF EXISTS `cd_command_script`;
CREATE TABLE `cd_command_script` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `creater_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '创建人ID',
  `name` varchar(255) NOT NULL DEFAULT '',
  `script` text NOT NULL ,
  `runner` varchar(50) NOT NULL DEFAULT '' COMMENT 'run as',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `type` varchar(50) NOT NULL DEFAULT '' COMMENT '类型',
  `is_local` enum('0', '1') NOT NULL DEFAULT '0' COMMENT '0:远程, 1:本地',	
  `created_at` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` int(10) unsigned NOT NULL DEFAULT '0',
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  `remark` text COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `creater_id` (`creater_id`),
  KEY `name` (`name`),
  KEY `type` (`type`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT '';


DROP TABLE IF EXISTS `cd_command_action`;
CREATE TABLE `cd_command_action` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `creater_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '创建人ID',
  `name` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `type` varchar(50) NOT NULL DEFAULT '' COMMENT '类型',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` int(10) unsigned NOT NULL DEFAULT '0',
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  `remark` text COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `creater_id` (`creater_id`),
  KEY `name` (`name`),
  KEY `type` (`type`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT '';


DROP TABLE IF EXISTS `cd_command_action_script`;
CREATE TABLE `cd_command_action_script` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '',
  `script_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '',
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `action_id` (`action_id`),
  KEY `script_id` (`script_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT '';


DROP TABLE IF EXISTS `cd_command_step`;
CREATE TABLE `cd_command_step` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `script` text NOT NULL ,
  `script_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '',
  `type` varchar(50) NOT NULL DEFAULT '' COMMENT '类型',
  `is_local` enum('0', '1') NOT NULL DEFAULT '0' COMMENT '0:远程, 1:本地',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `action_type` enum('1','2') NOT NULL DEFAULT 1 COMMENT '1:before, 2:after',
  `optional` tinyint(4) NOT NULL DEFAULT 1 COMMENT '可选',
  `condition` varchar(255) NOT NULL DEFAULT '' COMMENT '条件',
  `runner` varchar(50) NOT NULL DEFAULT '' COMMENT 'run as',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` int(10) unsigned NOT NULL DEFAULT '0',
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  `remark` text COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `script_id` (`script_id`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT '';


DROP TABLE IF EXISTS `cd_command_job`;
CREATE TABLE `cd_command_job` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `creater_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '创建人ID',
  `job_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '',
  `script_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '',
  `step_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `runner` varchar(50) NOT NULL DEFAULT '' COMMENT 'run as',
  `script` text NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT '' COMMENT 'script/step',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `server_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '',
  `optional` tinyint(4) NOT NULL DEFAULT 1 COMMENT '可选',
  `started_at` int(10) unsigned NOT NULL DEFAULT '0',
  `finished_at` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` int(10) unsigned NOT NULL DEFAULT '0',
  `messages` text COMMENT 'message',
  `remark` text COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `job_id` (`job_id`),
  KEY `script_id` (`script_id`),
  KEY `step_id` (`step_id`),
  KEY `server_ip` (`server_ip`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT '';

/*DROP TABLE IF EXISTS `cd_project_action_server`;
CREATE TABLE `cd_project_action_server` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) NOT NULL DEFAULT '0',
  `action_id` bigint(20) NOT NULL DEFAULT '0',
  `server_group_id` bigint(20) NOT NULL DEFAULT 0,
  `server_id` bigint(20) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '',
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `server_id` (`server_id`),
  KEY `action_id` (`action_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
*/

DROP TABLE IF EXISTS `cd_project_action_server_group`;
CREATE TABLE `cd_project_action_server_group` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_action_id` bigint(20) NOT NULL DEFAULT '0',
  `server_group_id` bigint(20) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `project_action_id` (`project_action_id`),
  KEY `server_group_id` (`server_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `cd_configure`;
CREATE TABLE `cd_configure` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `creater_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '创建人ID',
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '类型',
  `code` varchar(100) NOT NULL COMMENT '唯一标识',
  `name` varchar(100) NOT NULL COMMENT '配置名称',
  `content` text NOT NULL COMMENT '配置内容',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `priority` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `type_code` (`type`,`code`) USING BTREE,
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='configure';

DROP TABLE IF EXISTS `cd_depository`;
CREATE TABLE `cd_depository` (  
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `creater_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '创建人ID',
  `type` enum('1', '2') NOT NULL DEFAULT '1' COMMENT '1:git/2:svn',
  `address` varchar(100) NOT NULL DEFAULT '' COMMENT '地址', 
  `account` varchar(100) NOT NULL DEFAULT '' COMMENT 'svn生效',
  `password` varchar(100) NOT NULL DEFAULT '' COMMENT 'svn生效',
  `private_key` varchar(1000) NOT NULL DEFAULT '' COMMENT 'git生效',
  `public_key` varchar(1000) NOT NULL DEFAULT '' COMMENT 'git生效',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` int(10) unsigned NOT NULL DEFAULT '0',
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  `remark` text COLLATE utf8_unicode_ci COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `address` (`address`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='depository';


DROP TABLE IF EXISTS `cd_variable`;
CREATE TABLE `cd_variable` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `creater_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '创建人ID',
  `name` varchar(255) NOT NULL DEFAULT '',
  `code` varchar(100) NOT NULL COMMENT 'project_id|action_id|script_id|step_id',
  `value` varchar(255) NOT NULL DEFAULT '',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



