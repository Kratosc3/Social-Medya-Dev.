<?php
session_start();
include "coonect.php";

$sql_get_notif = 'SELECT * FROM notifications WHERE shown = "0" AND owner = "'.$_SESSION['id'].'"';
$res_get_notif = $conn->query($sql_get_notif);
if($res_get_notif){

  while($row_notif = $res_get_notif->fetch_assoc()){

    if ($row_notif['type'] == 'comment'){
      $type = ' durumuna yorum yaptı. ';

    }else{

      if($row_notif['type'] == 'friend'){

        $type = ' seni arkadaş olarak ekledi.';

      }else{

        $type = ' durumunu beğendi. ';

      }


      }

      if($row_notif['type'] == 'friend'){
        echo("<div onclick = 'goProfile(".$row_notif['postid'].")' class = 'notify-s'><img class='aa' src=upload/pp.jpg><a href =# id=".$row_notif['postid'].">".$row_notif['notificater'].$type."</a> </div> ");

      }else{
    echo("<div onclick = 'goPost(".$row_notif['postid'].")' class = 'notify-s'><img class='aa' src=upload/pp.jpg><a href =# id=".$row_notif['postid'].">".$row_notif['notificater'].$type."</a> </div> ");
}
  }
}
?>
