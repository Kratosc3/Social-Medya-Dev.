<?php
session_start();
include "coonect.php";
$postid = $_POST['postid'];

$sql = 'DELETE FROM comments where comid = '.$postid.'';
$result = $conn->query($sql);

if ($result){
  echo('Deleted');
}else{
  echo('not Deleted');
}


 ?>
