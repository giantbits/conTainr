SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for containr_elementLib
-- ----------------------------
DROP TABLE IF EXISTS `containr_elementLib`;
CREATE TABLE `containr_elementLib` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`type`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`elementId`  int(11) NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Table structure for containr_elementPageRef
-- ----------------------------
DROP TABLE IF EXISTS `containr_elementPageRef`;
CREATE TABLE `containr_elementPageRef` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`elementId`  int(11) NULL DEFAULT NULL ,
`pageId`  int(11) NULL DEFAULT NULL ,
`columnId`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`posNum`  int(11) NULL DEFAULT NULL ,
`template`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`datePublishFrom`  int(11) NULL DEFAULT NULL ,
`datePublishTo`  int(11) NULL DEFAULT NULL ,
`state`  int(11) NULL DEFAULT NULL ,
`userCreate`  int(11) NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Table structure for containr_media
-- ----------------------------
DROP TABLE IF EXISTS `containr_media`;
CREATE TABLE `containr_media` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`path`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`filename`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`type`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`title`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`description`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
`size`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Table structure for containr_page
-- ----------------------------
DROP TABLE IF EXISTS `containr_page`;
CREATE TABLE `containr_page` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`lft`  int(11) NULL DEFAULT NULL ,
`rgt`  int(11) NULL DEFAULT NULL ,
`level`  int(11) NULL DEFAULT NULL ,
`title`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`navTitle`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`code`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`metaDescription`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`metaKeywords`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`state`  int(11) NULL DEFAULT NULL ,
`datePublishFrom`  int(11) NULL DEFAULT NULL ,
`datePublishTo`  int(11) NULL DEFAULT NULL ,
`dateCreated`  int(11) NULL DEFAULT NULL ,
`dateDeleted`  int(11) NULL DEFAULT NULL ,
`dateLastUpdate`  int(11) NULL DEFAULT NULL ,
`userCreated`  int(11) NULL DEFAULT NULL ,
`userDeleted`  int(11) NULL DEFAULT NULL ,
`userLastUpdate`  int(11) NULL DEFAULT NULL ,
`template`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`accessRole`  int(11) NULL DEFAULT NULL ,
`visibleInNav`  int(11) NULL DEFAULT NULL ,
`locale`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Table structure for containr_user
-- ----------------------------
DROP TABLE IF EXISTS `containr_user`;
CREATE TABLE `containr_user` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`login`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`password`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`email`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`nameLast`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`nameFirst`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`phone`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`role`  int(11) NULL DEFAULT NULL ,
`state`  int(11) NULL DEFAULT NULL ,
`dateRegistration`  int(11) NULL DEFAULT NULL ,
`dateLastUpdate`  int(11) NULL DEFAULT NULL ,
`dateLastLogin`  int(11) NULL DEFAULT NULL ,
`web`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`street`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`streetNum`  varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`company`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`city`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`zip`  varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
--  Table structure for `containr_groupaccess`
-- ----------------------------
DROP TABLE IF EXISTS `containr_groupaccess`;
CREATE TABLE `containr_groupaccess` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`type` varchar(50) DEFAULT NULL,
	`elementId` int(11) DEFAULT NULL,
	`usergroup` int(11) DEFAULT NULL,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
--  Table structure for `containr_groupaccesscache`
-- ----------------------------
DROP TABLE IF EXISTS `containr_groupaccesscache`;
CREATE TABLE `containr_groupaccesscache` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`type` varchar(50) DEFAULT NULL,
	`elementId` int(11) DEFAULT NULL,
	`usergroup` int(11) DEFAULT NULL,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
--  Table structure for `containr_urlcache`
-- ----------------------------
DROP TABLE IF EXISTS `containr_urlcache`;
CREATE TABLE `containr_urlcache` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`pathinfo` varchar(255) NOT NULL,
	`pageid` int(11) NOT NULL,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
--  Table structure for `containr_userhash`
-- ----------------------------
DROP TABLE IF EXISTS `containr_userhash`;
CREATE TABLE `containr_userhash` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` int(11) NOT NULL,
	`hash` varchar(40) NOT NULL,
	`hashtype` int(11) NOT NULL,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

SET FOREIGN_KEY_CHECKS = 1;
