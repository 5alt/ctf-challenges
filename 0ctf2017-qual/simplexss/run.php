<?php
/**
 * 输出二次验证结果,本文件示例只是简单的输出 Yes or No
 */
error_reporting(0);
require_once 'class.geetestlib.php';
require_once 'config.php';
session_start();

function genTasks(){
    return bin2hex(file_get_contents('/dev/urandom', NULL, NULL, 0, 3));
}

//check task first
if(!$_SESSION['task']) die('please get your work!');
if(substr(md5($_POST['task']), 0, 6) !== $_SESSION['task']) die('prove your work first!');
$_SESSION['task'] = genTasks();

$GtSdk = new GeetestLib(CAPTCHA_ID, PRIVATE_KEY);


$user_id = $_SESSION['user_id'];
if ($_SESSION['gtserver'] == 1) {   //服务器正常
    $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $user_id);
    if ($result) {
        //good
    } else{
         die('capcha error');
    }
}else{  //服务器宕机,走failback模式
    if ($GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
        //good
    }else{
        die('capcha error');
    }
}
?>


<?php
include 'function.php';
if(strpos($_POST['payload'], '<') === false) die("processing... it may take some time..");
$payload = add_html(filter_xss($_POST['payload']));

$filename = 'data/'.bin2hex(file_get_contents('/dev/urandom', NULL, NULL, 0, 16)).'.html';;
file_put_contents($filename, $payload);

echo "processing... it may take some time..";

?>