<?php
session_start();
include 'coonect.php';

if ($conn){
  $likes = 'SELECT * FROM likes WHERE owner = '$_SESSION['id']'';
  $res_likes = $conn->query($likes);
  $comments = 'SELECT * FROM comments WHERE owner = '.$_SESSION['id']'';
  $res_comments = $conn->query($comments);

  if($res->num_rows > 0){
    while($row_comments = $res_comments->fetch_all()){
      ECHO ($row_comments['poster']);
      ECHO ($row_comments['comid']);
      ECHO ($row_comments['comment']);
      ECHO ($row_comments['postid'])  ;
      $ins = "INSERT INTO notifications (notificater , postid ,type ,owner ,shown) VALUES ('$poster','$postid','comment',$_SESSION['id'],'0')";
      $res_ins =$conn->query($ins);
      if ($res_ins){echo 'oK';}
    }
  }


}
 ?>
