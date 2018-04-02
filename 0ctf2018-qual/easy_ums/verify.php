<?php

include_once "common.php";

check_login();

if(isset($_REQUEST['code'])){
	$code = $_REQUEST['code'];
	if(check_code($_SESSION['phone'], $code)){
		delete_code($_SESSION['phone']);
		set_verify();
		$_SESSION['verify'] = 1;
		echo '<script>alert("success!"); location="index.php";</script>';
		die();
	}else{
		echo '<script>alert("fail!"); location="verify.php";</script>';
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

    <title>Verify</title>

    <!-- Bootstrap core CSS -->
    <link href="static/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="static/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="post">
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Verify Your Phone</h1>
      <label for="inputEmail" class="sr-only">Code</label>
      <input type="text" id="inputEmail" class="form-control" placeholder="The verify code you received" required autofocus name="code">
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Submit</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>
</html>