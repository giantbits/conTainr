SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for containr_formsPlugin
-- ----------------------------
DROP TABLE IF EXISTS `containr_formsPlugin`;
CREATE TABLE `containr_formsPlugin` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(128) default NULL,
  `mailRecipient` varchar(128) default NULL,
  `mailSubject` varchar(128) default NULL,
  `successMessage` text,
  `errorMessage` text,
  `model` varchar(128) default NULL,
  PRIMARY KEY  (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;
