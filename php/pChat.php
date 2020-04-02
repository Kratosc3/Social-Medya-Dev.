<?php
include 'coonect.php';
session_start();

$pid = $_POST['id'];

echo '<div style = "position:absoulte;background-color:red;right:0px;margin-right:350px;width:250px;height:35px;">'.$pid.'</div>';




 ?>
