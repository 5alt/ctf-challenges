GRANT USAGE ON *.* TO 'guestbook'@'localhost' IDENTIFIED BY PASSWORD '*AE4F4DF71E005A3B0E007E0335BD2C1873FC75BA';
GRANT SELECT, INSERT ON `guestbook`.* TO 'guestbook'@'localhost';

CREATE TABLE `message` (
  `secret` varchar(200) NOT NULL PRIMARY KEY,
  `username` varchar(256) NOT NULL,
  `message` TEXT NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0
)DEFAULT CHARSET=utf8