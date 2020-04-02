<?php
include "coonect.php";
$userid = $_POST['userid'];
$sql = "UPDATE notifications SET shown='0' where owner='".$userid."'";
$res = $conn->query($sql);



 ?>
