USE `testing-workshop`;

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `customer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_forename` varchar(1024) DEFAULT NULL,
  `customer_surname` varchar(1024) DEFAULT NULL,
  `customer_email` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
