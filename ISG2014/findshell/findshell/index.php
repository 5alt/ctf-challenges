<?php
	header('HintLine1: $upload_dir = "./tmp/";');
	header('HintLine2: $rand = mt_rand();');
	header('HintLine3: $filename = md5($_FILES["file"]["name"]).sha1($rand);');
?>

<form method="post" action="" enctype="multipart/form-data">
File: <input type="file" name="file">
<input type="submit" name="submit" value="submit">
</form>
<br >

<?php
	if(!empty($_POST['submit']))
	{
		if ($_FILES["file"]["error"] > 0)
		{
			die("Return Code: " . $_FILES["file"]["error"] . "<br />");
		}
		else if($_FILES["file"]["size"] > 20000)
		{
			die("The file is too large.");
		}
	  	else
		{
			$upload_dir = './tmp/';
			$rand = mt_rand();
			$filename = md5($_FILES["file"]["name"]).sha1($rand);

			if (file_exists($upload_dir . $filename))
			{
				die("File already exists. ");
			}
			else
			{
				file_put_contents($upload_dir . $filename, file_get_contents('tthisiiisttheflllaaag.txt'));
				die("Uplad success!");
			}
		}
		die();
	}
?>