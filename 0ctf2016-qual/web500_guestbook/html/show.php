<?php
function filter($data){
    $bad = array('"', "'", '&', '<', '>', "\r", "\n");
    foreach ($bad as $b) {
        $data = str_replace($b, '', $data);
    }
    return $data;
}

$secret =base64_encode($_GET['secret']);

require_once('config.php');
$sql = "SELECT username, message, status FROM `message` WHERE secret='{$secret}'";

/* Select queries return a resultset */
if ($result = mysqli_query($link, $sql)) {
    if($row = mysqli_fetch_row($result)){
        $name = filter($row[0]);
        $message = filter($row[1]);
        $status = $row[2];
        ?>
<html>
<body>
    <div><h3><?php if($status)echo 'checked'; else echo 'to be checked'; ?></h3></div>
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



