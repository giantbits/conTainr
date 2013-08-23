SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for containr_contentImage
-- ----------------------------
DROP TABLE IF EXISTS `containr_contentImage`;
CREATE TABLE `containr_contentImage` (
	`id`  int(11) NOT NULL AUTO_INCREMENT ,
	`title`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
	`teaser`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
	`content`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
	`dateCreate`  int(11) NULL DEFAULT NULL ,
	`dateUpdate`  int(11) NULL DEFAULT NULL ,
	`dateDelete`  int(11) NULL DEFAULT NULL ,
	`userCreate`  int(11) NULL DEFAULT NULL ,
	`userUpdate`  int(11) NULL DEFAULT NULL ,
	`userDelete`  int(11) NULL DEFAULT NULL ,
	`mediaId`  int(11) NULL DEFAULT NULL ,
	`mediaPosition`  varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
	`state`  int(11) NULL DEFAULT NULL ,
	`cssclass`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
	`cssid`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
	`showHeadline`  int(11) NULL DEFAULT NULL ,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `containr_contentImageLang`;
CREATE TABLE IF NOT EXISTS `containr_contentImageLang` (
	`l_id` int(11) NOT NULL AUTO_INCREMENT,
	`contentImage_id` int(11) NOT NULL,
	`lang_id` varchar(6) NOT NULL,
	`l_title` varchar(255) NOT NULL,
	`l_teaser` varchar(255) NOT NULL,
	`l_content` TEXT NOT NULL,
	PRIMARY KEY (`l_id`),
	KEY `contentImage_id` (`contentImage_id`),
	KEY `lang_id` (`lang_id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

	ALTER TABLE `containr_contentImageLang`
	ADD CONSTRAINT `contentimagelang_ibfk_1` FOREIGN KEY (`contentimage_id`) REFERENCES `containr_contentImage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
