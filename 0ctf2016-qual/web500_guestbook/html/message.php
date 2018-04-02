<?php
//\x33 \u002 &#23;
//insert into meaasge(name, msg) values ('asa\', ',0xffff),(0x22, 0x33)#')
function filter($data){
	$bad = array('"', "'", '&', '<', '>', "\r", "\n");
	foreach ($bad as $b) {
		$data = str_replace($b, '', $data);
	}
	return $data;
}

$name = filter($_POST['username']);
$message = filter($_POST['message']);
$secret =base64_encode($_POST['secret']);

require_once('config.php');
#insert to db
$sql = "INSERT INTO `message`(`secret`, `username`, `message`)VALUES('{$secret}', '{$name}', '{$message}')";
if(mysqli_query($link, $sql)){
	$url = 'show.php?secret='.urlencode($_POST['secret']);
	header("Location: ".$url);
}else{
	echo "maybe another secret!";
}
?>