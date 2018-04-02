<?php
include 'common.php';

if(isset($_REQUEST['submit'])){
	$user = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	if(login($user, $password)){
		header("Location: index.php");
		die();
	}else{
		echo '<script>alert("fail!"); location="login.php";</script>';
		die();
	}
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link href="static/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="static/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="post">
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Username</label>
      <input type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus name="username">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
      <button class="btn btn-lg btn-primary btn-block" type="button" name="resend" onclick="location='register.php'">Register</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>
</html>
