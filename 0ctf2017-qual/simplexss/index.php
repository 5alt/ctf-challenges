<?php
session_start();

function genTasks(){
  return bin2hex(file_get_contents('/dev/urandom', NULL, NULL, 0, 3));
}

$_SESSION['task'] = genTasks();

?>

<?php
require_once 'class.geetestlib.php';
?>

<!DOCTYPE html>
<html>
<head>
   <title>Simple XSS</title>
   <link href="static/bootstrap.min.css" rel="stylesheet">
   <script src="static/jquery.min.js"></script>
   <script src="static/bootstrap.min.js"></script>
<script src="https://static.geetest.com/static/tools/gt.js"></script>
</head>
<body>
<div class="container theme-showcase" role="main">
   <div class="jumbotron">
           <h1>Simple XSS</h1>
           <p>Flag is in <a href="flag.php">flag.php</a> with ip restriction</p>
           <p>No bruteforcing and scanning!</p>
           <p>Try to bypass filter and exploit</p>
           <p>Capcha is not needed for preview.</p>
           <p>Always use latest Chrome</p>
         </div>
<p>Try to find a string $str so that (substr(md5($str), 0, 6) === '<?php echo $_SESSION['task']; ?>').</p>
<form action="run.php" role="form" method="POST" id="xss">
   <div class="form-group">
    <label for="name">String(no need for preview)</label>
      <input type="text" class="form-control" name="task"
         placeholder="Please enter the string you find to prove your work">
         <label for="name">xss payload</label>
      <textarea class="form-control" name="payload"
         placeholder="Please provide the xss payload"></textarea>
   </div>
   <div id="embed-captcha"></div>
    <p id="wait" class="show">Loading capcha......</p>
    <p id="notice" class="hide">Drag to the right place</p>
    <br>
   <button type="submit" class="btn btn-default" onclick="xss.action='preview.php';xss.submit();">Preview</button>
   <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>
 <script>
    var handlerEmbed = function (captchaObj) {
        $("#embed-submit").click(function (e) {
            var validate = captchaObj.getValidate();
            if (!validate) {
                $("#notice")[0].className = "show";
                setTimeout(function () {
                    $("#notice")[0].className = "hide";
                }, 2000);
                e.preventDefault();
            }
        });
        // 将验证码加到id为captcha的元素里，同时会有三个input的值：geetest_challenge, geetest_validate, geetest_seccode
        captchaObj.appendTo("#embed-captcha");
        captchaObj.onReady(function () {
            $("#wait")[0].className = "hide";
        });
        // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
    };
    $.ajax({
        // 获取id，challenge，success（是否启用failback）
        url: "startCaptchaServlet.php?type=pc&t=" + (new Date()).getTime(), // 加随机数防止缓存
        type: "get",
        dataType: "json",
        success: function (data) {
            // 使用initGeetest接口
            // 参数1：配置参数
            // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
            initGeetest({
                gt: data.gt,
                challenge: data.challenge,
                product: "embed", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
                // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
            }, handlerEmbed);
        }
    });
</script>
</body>
</html>