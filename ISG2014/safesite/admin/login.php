<?php
	require_once('conn.php');
	if(isset($_POST['submit']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		if(check_login($username, $password))
		{
			setcookie('u', $username);
			setcookie('p', sha1($password));
			header('Location: index.php');
			die();
		}
		else
		{
			echo "密码错误！";
		}
	}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="md5_salt">
<title>后台管理</title>
</head>
<body>
<h3>管理登录</h3>
<form action="login.php" method="post">
用户名：<input class="input" value="" type="text" name="username" /><br />
密码：<input class="input" type="password" name="password" /><br />
<input type="submit" name="submit" value="登 录" />
</form>
</body>
</html>
