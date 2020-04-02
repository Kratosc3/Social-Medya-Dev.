<?php
session_start();
include 'coonect.php';

$id = $_SESSION['id'];
$friend = $_POST['friend'];

$sql_get_friends = "SELECT * FROM friends WHERE friend = '".$friend."' and id ='".$_SESSION["id"]."' ";
$res_get_friends = $conn->query($sql_get_friends);

$sql_get_usercrc = "SELECT idcrkey FROM user WHERE id = '".$friend."'";
$res_get_usercrc = $conn->query($sql_get_usercrc);

if($row_crc = $res_get_usercrc->fetch_assoc()){

  $crkey = $row_crc['idcrkey'];
  if($res_get_friends->num_rows > 0){

  }else{
    $sql_ins_friends = "INSERT INTO friends (friend,id,isAccept) VALUES ('".$friend."','".$id."',0)";
    $res_ins_friends = $conn->query($sql_ins_friends);
    if($res_ins_friends){
      echo "Frined Adedd";

      $ins = "INSERT INTO notifications (notificater , postid ,type ,owner ,shown) VALUES ('$id','$crkey','friend','$friend',0)";
      $res_ins = $conn->query($ins);
      if($res_ins){echo ('ok');}


    }

  }

}


















 ?>
