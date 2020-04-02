<?php
include "coonect.php";
session_start();
echo $_SESSION['id'];
$Commenter = "kratosc2";


$sql_get_if_friend = 'SELECT * FROM friends where friend = "'.$Commenter.'"  and '.'  id = "'.$_SESSION['id'].'"';
$res_get_if_friend = $conn->query($sql_get_if_friend);
if($res_get_if_friend){
  while($row = $res_get_if_friend->fetch_assoc()){
    echo ($row['friend']);
  }
}


?>
