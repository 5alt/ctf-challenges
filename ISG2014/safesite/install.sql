CREATE TABLE `isg_admin` (
  `uid` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(32) default NULL,
  `password` varchar(64) default NULL,
  `info` varchar(200) default NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `isg_admin`(`username`, `password`, `info`) VALUES('admin', '86c969bebab9cfeb47efcc65d85f26c5', 'login and capture the flag!');