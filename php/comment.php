<?php
session_start();
include "coonect.php";

$comment =$_POST['comment'];
$comment = addslashes($comment);
$shareid = $_POST['shareid'];
$poster  = $_SESSION['id'];
$com =  mysqli_real_escape_string($comment);

if ($conn){


if($_SESSION['login']=='ok'){
  $sql = sprintf("INSERT INTO comments (postid,comment,poster) VALUES ('$shareid','%s','$poster' )",$comment);
  $result = $conn->query($sql);

  if($result){
    echo('<li>'.$comment.'</li>');
    $sql_find_sharer = "SELECT * FROM share WHERE shareid = '$shareid'";
    $res_find_sharer = $conn->query($sql_find_sharer);
    if($res_find_sharer){
      while($row_res_find = $res_find_sharer->fetch_assoc()){
        $sharedid = $row_res_find['sharedid'];
        echo ($sharedid);
      }
    }
    if($sharedid == $_SESSION['id']){

    }else{
      $ins = "INSERT INTO notifications (notificater , postid ,type ,owner ,shown) VALUES ('$poster','$shareid','comment','$sharedid',0)";
      $res_ins = $conn->query($ins);
      if($res_ins){echo ('ok');}
    }


  }else{
    echo($err);
  }
}else{echo('Kayıt ol');}
}


 ?>
