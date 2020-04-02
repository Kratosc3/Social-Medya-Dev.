<?php
session_start();
include 'coonect.php';

$id = $_SESSION['id'];


$sql_get_friends = 'SELECT * FROM friends';
$res_get_friends = $conn->query($sql_get_friends);

if($res_get_friends){
  while($row_friends = $res_get_friends->fetch_assoc()){
    echo $row_friends['fid'];
  }
}




 ?>
