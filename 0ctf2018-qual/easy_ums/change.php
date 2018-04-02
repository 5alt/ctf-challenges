<?php
include_once "common.php";

check_login();

if(isset($_REQUEST['phone']) && isset($_REQUEST['task'])){
	if(!$_SESSION['task']) die('please get your work!');
	if(substr(md5($_REQUEST['task']), 0, 6) !== $_SESSION['task']) die('prove your work first!');
	$_SESSION['task'] = gen_task();

	$new_phone = $_REQUEST['phone'];
	if(!filter_phone($new_phone)) die('bad phone format!');
	update_phone($new_phone);
	unset_verify();
	$_SESSION['verify'] = 0;
	$_SESSION['phone'] = $new_phone;
	$code = generate_code($new_phone);
	send_sms($new_phone, $code);
	insert_code($new_phone, $code);
	header("Location: verify.php");
	die();
}

$_SESSION['task'] = gen_task();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Change Phone</title>

    <!-- Bootstrap core CSS -->
    <link href="static/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="static/signin.css" rel="stylesheet">
  </head>

  <body>
<div class="container theme-showcase" role="main">
	<h1>Change Phone</h1>
	<p>Please use your ip instead of phone<br>We will send a http request to 80 port with verify code!</p>
   <div class="jumbotron">
<p>Try to find a string $str so that (substr(md5($str), 0, 6) === '<?php echo $_SESSION['task']; ?>'). </p>
<form action="" role="form" method="POST">
   <div class="form-group">
      <label for="name">String</label>
      <input type="text" class="form-control" name="task" 
         placeholder="Please enter the string you find to prove your work">
         <label for="name">Phone</label>
      <input type="text" class="form-control" name="phone" 
         placeholder="Please enter your new phone number(ip address).">
   </div>
   <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>
</body>
</html>
