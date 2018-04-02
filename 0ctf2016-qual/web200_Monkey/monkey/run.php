<?php
session_start();

$phantomjs = '/usr/bin/phantomjs';
$run = 'run.js';

function genTasks(){
	return bin2hex(file_get_contents('/dev/urandom', NULL, NULL, 0, 3));
}

function execInBackground($cmd) { 
    if (substr(php_uname(), 0, 7) == "Windows"){ 
        pclose(popen("start /B ". $cmd, "r"));  
    } 
    else { 
        exec($cmd . " > /dev/null &");   
    } 
} 
//check task first
if(!$_SESSION['task']) die('please get your work!');
if(substr(md5($_POST['task']), 0, 6) !== $_SESSION['task']) die('prove your work first!');
$_SESSION['task'] = genTasks();
$url = $_POST['url'];

if(preg_match('/\s/', $url)){
	die('No blank chars');
}
//bad char: " ' ` $ < > \ |
$filter = array('"', "'", '`', '$', '<', '>', "\\", '|');
//url = 'bad char: " \' ` $ < > \\ |';


foreach ($filter as $value) {
	$url = str_replace($value, '%'.bin2hex($value), $url);
}

execInBackground($phantomjs.' '.$run.' '.$url);

echo "processing...";

?>
