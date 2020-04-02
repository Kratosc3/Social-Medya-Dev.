<?php
session_start();
include "coonect.php";
$postid = $_POST['postid'];

if ($conn){
  $sql = "SELECT * FROM likes WHERE postid = ".$postid."";
  $results = $conn->query($sql);
  $a = $results->num_rows;
  echo ($a);




}



 ?>
