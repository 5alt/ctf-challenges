CREATE TABLE `news` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`title` varchar(255) COLLATE utf8_bin NOT NULL,
	`content` TEXT COLLATE utf8_bin NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `flag` (
	`flag` varchar(255) COLLATE utf8_bin NOT NULL,
	PRIMARY KEY (`flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `flag` VALUES('flag{W4f_bY_paSS_f0R_CI}');

INSERT INTO `news`(`title`, `content`) VALUES('Hello World', 'Hello guys, flag is in the database'),
('Waf', 'wtf, the waf blocks some keywords'),
('Sqlin', 'you should solve this game by sqlin'),
('darkness', 'hello darkness my old friend');