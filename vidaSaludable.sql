DROP TABLE IF EXISTS progress;
DROP TABLE IF EXISTS users;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `last_login` date,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `progress`(
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` INT(10) unsigned NOT NULL,
  `weight` FLOAT NOT NULL,
  `height`FLOAT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY(id_user) REFERENCES users(id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;