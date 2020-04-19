CREATE TABLE `auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_auth_id` int(11) unsigned NOT NULL,
  `source` TEXT NOT NULL,
  `source_id` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_FK` (`customer_auth_id`),
  CONSTRAINT `auth_FK` FOREIGN KEY (`customer_auth_id`) REFERENCES `customers_auth` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;