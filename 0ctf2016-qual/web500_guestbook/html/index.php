<head>
<title>Guestbook</title>
<meta charset="utf-8"/>
<script src="static/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="static/semantic.min.css">
<script src="static/semantic.min.js"></script>
<style type="text/css">
code {
  background-color: #E0E0E0;
  padding: 0.25em 0.3em;
  font-family: 'Lato';
  font-weight: bold;
}
.container {
  padding: 5em 0em;
}
h1 {
  margin-top: 10em;
}
</style>
</head>
<!--
$name = filter($_POST['username']);
$message = filter($_POST['message']);
$secret =base64_encode($_POST['secret']);
...
do the rest work
-->
<body>
<div class="ui text container">
	<h1 class="ui dividing header">Guestbook</h1>
	<p>
		Big boss will check every message you left. Use your secret to track your message status.
	</p>
	<form class="ui large form" id="f" action="message.php" method="POST">
		<div class="ui stacked segment">
			<div class="field">
				<label>Secret</label>
				<input type="text" name="secret" placeholder="you can use whatever chars you want but not tooooo long">
			</div>
			<div class="field">
				<label>Username</label>
				<input type="text" name="username">
			</div>
			<div class="field">
				<label>Message</label>
				<textarea name="message"></textarea>
			</div>
			<div class="field">
				<input type="hidden" id="s" name="action" value="submit">
				<br>
				<div class="ui fluid large teal submit button" onclick="$('#f').submit()">
					Submit
				</div>
			</div>
		</div>
	</form>
	<div>
</div>
</body>
