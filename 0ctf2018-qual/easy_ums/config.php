<?php
session_start();
ini_set('default_socket_timeout', 5);
error_reporting(0);

$dbhost = '127.0.0.1';
$dbuser = 'root';
$dbpass = '';
$dbname = 'tctf';
$flag = 'flag';



$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

/*
CREATE TABLE users (id int AUTO_INCREMENT, 
username text, 
password text, 
phone text, 
verify int default 0,
PRIMARY KEY(id));

CREATE TABLE tokens (id int AUTO_INCREMENT,
uid int,
phone text,
token text, 
PRIMARY KEY(id));

INSERT INTO users(username, password, phone) VALUES ( 'admin', '3e333ffaac0ff1ae70083a1533787db2', '127.0.0.1' );

CREATE TABLE change_log(
id int AUTO_INCREMENT,
uid int,
phone text, 
ip text,
PRIMARY KEY(id)
);


*/