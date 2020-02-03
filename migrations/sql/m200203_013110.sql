CREATE TABLE `menu_items` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`item_name` VARCHAR(255) NULL DEFAULT '',
	`price` DECIMAL(16,4) NULL DEFAULT '0.0000',
	`description` TEXT NULL,
	`item_photo` TEXT NULL,
	`active` TINYINT(1) NULL DEFAULT '0',
	`created_at` DATETIME NULL DEFAULT NULL,
	`created_by` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB
;