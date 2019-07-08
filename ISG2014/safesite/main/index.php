<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="md5_salt">

    <title>Safe Site</title>

    <!-- Bootstrap core CSS -->
    <link href="./static/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="./static/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./static/theme.css" rel="stylesheet">

</head>

  <body role="document">

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Safe Site</a>
        </div>
      </div>
    </div>

    <div class="container theme-showcase" role="main">
      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Safe Site</h1>
        <p>This is a really safe site. No SQLi, no XSS, no CSRF...</p>
		<p>No one can hack it directly, unless you have a dir overflow 0day ;)</p>
		<p>You can you up, no can no BB =, =</p>
		<p><strong>Beat the admin!</strong></p>
        <p><a href="#" class="btn btn-primary btn-lg" role="button">Come on!</a></p>
      </div>
	  <form role="form" action="" method="post">
	  <div class="form-group">
	  <label for="disabledSelect">Contact Admin:</label>
	  <textarea class="form-control" rows="3" name="text"></textarea>
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	  </form>
    <p><?php if(isset($_POST['text'])) echo 'Send Successfully!'; ?></p>

    </div> <!-- /container -->

</body>
</html>