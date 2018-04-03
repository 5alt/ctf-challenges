<?php
header("X-XSS-Protection: 0");
include 'function.php';

echo add_html(filter_xss($_POST['payload']));
?>
