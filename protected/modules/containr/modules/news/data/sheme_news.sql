-- ----------------------------
-- Table structure for containr_newsPlugin
-- ----------------------------
DROP TABLE IF EXISTS `containr_newsPlugin`;
CREATE TABLE `containr_newsPlugin` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`type`  int(11) NULL DEFAULT NULL ,
`itemsperpage`  int(11) NULL DEFAULT NULL ,
`pager`  int(11) NULL DEFAULT NULL ,
`detailpage`  int(11) NULL DEFAULT NULL ,
`headline`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Table structure for containr_newsPost
-- ----------------------------
DROP TABLE IF EXISTS `containr_newsPost`;
CREATE TABLE `containr_newsPost` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`title`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`teaser`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
`content`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
`dateCreate`  int(11) NULL DEFAULT NULL ,
`dateUpdate`  int(11) NULL DEFAULT NULL ,
`datePublish`  int(11) NULL DEFAULT NULL ,
`dateUnpublish`  int(11) NULL DEFAULT NULL ,
`dateDelete`  int(11) NULL DEFAULT NULL ,
`userCreate`  int(11) NULL DEFAULT NULL ,
`userUpdate`  int(11) NULL DEFAULT NULL ,
`userPublish`  int(11) NULL DEFAULT NULL ,
`userDelete`  int(11) NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;
