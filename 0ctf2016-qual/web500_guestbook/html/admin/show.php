<?php
function filter($data){
    $bad = array('"', "'", '&', '<', '>', "\r", "\n");
    foreach ($bad as $b) {
        $data = str_replace($b, '', $data);
    }
    return $data;
}

if($_COOKIE['admin']!=='salt_is_admin') die('you are not admin.');
$secret =base64_encode($_GET['secret']);

require_once('../config.php');
$sql = "SELECT username, message FROM `message` WHERE secret='{$secret}'";

/* Select queries return a resultset */
if ($result = mysqli_query($link, $sql)) {
    if($row = mysqli_fetch_row($result)){
        $name = filter($row[0]);
        $message = filter($row[1]);
        ?>
<html>
<!--
change log:
use http-only cookie to prevent cookie stealing by xss, so flag is safe in cookie
always check /admin/server_info.php for load balancing

to do:
files and folders permission control, disallow other users write file into uploads folder

 -->
<body>
    <script>var debug=false;</script>
    <div id="<?php echo $name; ?>">
        <h2><?php echo $name; ?></h2>
    </div>
    <div id="text"></div>
    <script>
    data = "<?php echo $message; ?>"
    t = document.getElementById("text")
    if(debug){
        t.innerHTML=data
    }else{
        t.innerText=data
    }
    </script>
</body>
</html>

<?php
    die();
    }
}
die('no such secret!');
?>


