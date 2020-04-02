<?php
include 'coonect.php';
if ($conn) {
  echo ('OK!<br>');
  $header = $_POST['header'];
  $adress = $_POST['adress'];
  $tel    = $_POST['tel'];
  $price  = $_POST['price'];
  $comment = $_POST['comment'];
  $time    = date("his");
  $date    = date("Ymd");
  $photo   = $_POST['photo'];
  $p  = (str_replace('"', '',$photo));
  echo ($header);
  echo ($adress);
  echo ($tel);
  echo ($price);
  echo ($comment);

  $insert = "INSERT INTO share (head,addres,tel,price,comm,time,date,uploadir) VALUES ('".$header."','".$adress."','".$tel."','".$price."','".$comment."','".$time."','".$date."','".$p."')";

  if ($conn->query($insert)=== TRUE) {
    echo ('İnserted');
    echo ('<br>');
    echo ('<img src = upload/'.$p.'>');
    echo ($p);
    echo ('<br>');
    $dir = 'upload/'.$p;

    $file = scandir($dir);
    $a = count($files);

    foreach ($file as &$files) {
          if ($files != '.' && $files != '..')
          echo($files.'<br>');

      // code...
    }

  }else {
    echo ($conn->error);

  }


}else{
  echo ($err);
}
?>
