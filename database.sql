CREATE TABLE `news`
(
    `id`      int(11) NOT NULL AUTO_INCREMENT,
    `header`  varchar(100) DEFAULT NULL,
    `content` text,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
