SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `containr_loginbox`
-- ----------------------------
DROP TABLE IF EXISTS `containr_loginbox`;
CREATE TABLE `containr_loginbox` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`title` varchar(255) NOT NULL,
	`showHeadline` tinyint(4) NOT NULL,
	`redirectAfterLogin` int(11) NOT NULL,
	`enableRegistration` tinyint(4) NOT NULL,
	`doubleoptin` tinyint(4) NOT NULL,
	`adminActivation` tinyint(4) NOT NULL,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;
