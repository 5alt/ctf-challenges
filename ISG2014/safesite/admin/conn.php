<?php
error_reporting(0);
require_once('config.php');
$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);

// Check connection
if (mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	die();
}

function check_login(&$username, &$password)
{
	global $con;
	$password = md5($password);
	$sql = "SELECT * FROM `isg_admin` WHERE username='$username'";
	$result = mysqli_query($con, $sql);
	if(!$result) die('Query error!');
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if($row && $row['password'] == $password)
	{
		$username = $row['username'];
		$password = $row['password'];
		return true;
	}
	else return false;
}
function check_cookie($username, $password)
{
	global $con;
	$sql = "SELECT `password` FROM `isg_admin` WHERE username='$username'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if($row && sha1($row['password']) == $password) return true;
	else return false;
}
?>