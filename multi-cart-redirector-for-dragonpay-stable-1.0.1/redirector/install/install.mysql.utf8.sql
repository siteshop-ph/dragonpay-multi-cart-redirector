DROP TABLE IF EXISTS `license`;

CREATE TABLE IF NOT EXISTS `license` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `field` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `license` (`field`) VALUES
('public_key'),
('license_data'),
('status');

DROP TABLE IF EXISTS `log_redirections`;

CREATE TABLE IF NOT EXISTS `log_redirections` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `action` varchar(50) NOT NULL,
  `shopping_cart_id` varchar(120) NOT NULL,
  `refno` varchar(120) NOT NULL,
  `txnid` varchar(120) NOT NULL,
  `destination` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;