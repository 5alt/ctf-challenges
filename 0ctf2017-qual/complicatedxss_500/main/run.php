<?php
session_start();

$phantomjs = '/usr/local/lib/node_modules/phantomjs/lib/phantom/bin/phantomjs';
$run = '/var/www/html/static/i_dont_believe_you_can_guess_this_js.js.php';

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
$payload = $_POST['payload'];

$filename = 'data/'.bin2hex(file_get_contents('/dev/urandom', NULL, NULL, 0, 16)).".html";
file_put_contents($filename, $payload);

$url = 'http://government.vip/'.$filename;

execInBackground($phantomjs.' '.$run.' '.$url);

echo "processing...";

?>
