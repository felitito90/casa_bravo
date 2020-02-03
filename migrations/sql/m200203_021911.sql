CREATE TABLE `sales` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`user_id` INT(11) NOT NULL,
`order_folio` VARCHAR(16) NOT NULL,
`status` TINYINT(1) NOT NULL,
`active` TINYINT(1) NOT NULL,
`created_at` DATETIME NOT NULL,
`created_by` INT(11) NOT NULL,
PRIMARY KEY (`id`)) ENGINE = InnoDB;