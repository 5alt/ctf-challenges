<?php
include 'common.php';

check_login();
check_verify();

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>hello</title>

    <!-- Bootstrap core CSS -->
    <link href="static/bootstrap.min.css" rel="stylesheet">

  </head>

  <body>

    <!-- Begin page content -->
    <main role="main" class="container">
      <h1 class="mt-5">Hello <?php echo htmlspecialchars($_SESSION['username']).'('.htmlspecialchars($_SESSION['phone']).')'; ?></h1>
      <p>You can change your phone <a href="change.php">here</a>.</p>
      <p>If you make your phone to be 8.8.8.8, I will give you a flag.</p>
      <?php
      if(get_flag()){ 
        echo "<p>".$flag."</p>";
  } ?>
    </main>


  </body>
</html>
