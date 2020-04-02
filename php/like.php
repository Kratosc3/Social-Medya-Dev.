<?php
session_start();
if ($_SESSION['login'] == 'ok'){
include "coonect.php";
  $a = 0;
$likerid = $_SESSION['id'];
$postid = $_POST['postid'];
$sqlgetif = 'SELECT * FROM likes WHERE likerid =  "'.$likerid.'" '.' AND postid =  "'.$postid.'" ';
$results = $conn->query($sqlgetif);
$resc = $results->num_rows;
if($resc > 0){
  $sqlrmlike = 'DELETE FROM likes where likerid = "'.$likerid.'"';
  $rslt = $conn->query($sqlrmlike);
  if($rslt){
    echo('ok');
    $sql_del_notif = "DELETE FROM notifications where postid = '$postid'";
    $res_del_notif = $conn->query($sql_del_notif);
    if($res_del_notif){echo 'ok';}

  }else{echo('no'.$likerid);}
}else{
      $sql = "INSERT INTO likes (postid,likerid) values ('".$postid."','".$likerid."')";



      if($conn->query($sql)){
        echo('ok');

        $sql_find_sharer = "SELECT * FROM share WHERE shareid = '$postid'";
        $res_find_sharer = $conn->query($sql_find_sharer);
        if($res_find_sharer){
          while($row_res_find = $res_find_sharer->fetch_assoc()){
            $sharedid = $row_res_find['sharedid'];
            echo ($sharedid);
          }
        }
        if($sharedid == $_SESSION['id']){

        }else{
          $ins = "INSERT INTO notifications (notificater , postid ,type ,owner ,shown) VALUES ('$likerid','$postid','like','$sharedid',0)";
          $res_ins = $conn->query($ins);
          if($res_ins){echo ('ok');}
        }


      }else{
        echo('no');
      }
    }
}
?>
