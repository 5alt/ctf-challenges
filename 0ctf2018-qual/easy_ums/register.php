<?php

include 'common.php';
if(isset($_REQUEST['submit'])){
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$phone = $_REQUEST['phone'];
  $uid = register($username, $password, $phone);
	if($uid){
    $_SESSION['id'] = $uid;
    $_SESSION['username'] = $username;
    $_SESSION['phone'] = $phone;
    $_SESSION['verify'] = 0;
		$code = generate_code($phone);
		send_sms($phone, $code);
		insert_code($phone, $code);
		echo '<script>alert("success!"); location="login.php";</script>';
	}else{
		echo '<script>alert("fail! duplicated username/phone or bad phone format!"); location="register.php";</script>';
	}
	die();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Bootstrap core CSS -->
    <link href="static/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="static/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="post">
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Register</h1>
      <label for="inputEmail" class="sr-only">Username</label>
      <input type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus name="username">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
      <label for="inputPhone" class="sr-only">Phone</label>
      <input type="text" id="inputPhone" class="form-control" placeholder="Phone" required autofocus name="phone">

      Please use your ip instead of phone<br>We will send a http request to 80 port with verify code!
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Register</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>
</html>