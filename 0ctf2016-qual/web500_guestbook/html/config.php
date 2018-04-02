<?php
$link = mysqli_connect("localhost", "guestbook", "reUuEYbmtdcyKbCh", "guestbook");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
