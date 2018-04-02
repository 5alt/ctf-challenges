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
   <title>Monkey</title>
   <link href="/static/bootstrap.min.css" rel="stylesheet">
   <script src="/static/jquery.min.js"></script>
   <script src="/static/bootstrap.min.js"></script>
</head>
<body>
<div class="container theme-showcase" role="main">
   <div class="jumbotron">
           <h1>Monkey</h1>
           <p>The flag is at http://127.0.0.1:8080/secret</p>
           <p>After you submited a url, a monkey will browse the url.</p>
           <p>The monkey will stay 2 minutes on your page.</p>
         </div>
<p>Try to find a string $str so that (substr(md5($str), 0, 6) === '<?php echo $_SESSION['task']; ?>'). </p>
<form action="run.php" role="form" method="POST">
   <div class="form-group">
      <label for="name">String</label>
      <input type="text" class="form-control" name="task" 
         placeholder="Please enter the string you find to prove your work">
         <label for="name">Url</label>
      <input type="text" class="form-control" name="url" 
         placeholder="Please provide the url you want the monkey to browse">
   </div>
   <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>
</body>
</html>
