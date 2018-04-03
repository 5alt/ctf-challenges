<?php
session_start();

function genTasks(){
	return bin2hex(file_get_contents('/dev/urandom', NULL, NULL, 0, 3));
}

$_SESSION['task'] = genTasks();

?>

<!DOCTYPE html>
<html>
<head>
   <title>XSS Book</title>
   <link href="static/bootstrap.min.css" rel="stylesheet">
   <script src="static/jquery.min.js"></script>
   <script src="static/bootstrap.min.js"></script>
</head>
<body>
<div class="container theme-showcase" role="main">
   <div class="jumbotron">
           <h1>XSS Book</h1>
           <p>The flag is in http://admin.government.vip:8000</p>
           <p>Bruteforce and scanning are not needed!</p>
           <p>Admin will be hit by your payload</p>
         </div>
<p>Try to find a string $str so that (substr(md5($str), 0, 6) === '<?php echo $_SESSION['task']; ?>'). </p>
<form action="run.php" role="form" method="POST">
   <div class="form-group">
      <label for="name">String</label>
      <input type="text" class="form-control" name="task" 
         placeholder="Please enter the string you find to prove your work">
         <label for="name">xss payload</label>
      <textarea class="form-control" name="payload" 
         placeholder="Please provide the xss payload"></textarea>
   </div>
   <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>
</body>
</html>
