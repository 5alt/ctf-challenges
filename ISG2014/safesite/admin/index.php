<?php
	require_once('conn.php');
	if(isset($_COOKIE['u']) && isset($_COOKIE['p']))
	{
		$username = $_COOKIE['u'];
		$password = $_COOKIE['p'];
		if(check_cookie($username, $password))
		{
			echo 'The flag is '.$flag;
			die();
		}
	}
	header('Location: login.php');
	