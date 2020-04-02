<?php
include 'coonect.php';
session_start();
if ($conn) {

  $shared_id = $_SESSION['id'];
  $header = $_POST['header'];
  $adress = $_POST['adress'];
  $tel    = $_POST['tel'];
  $price  = $_POST['price'];
  $comment = $_POST['comment'];
  $time    = date("his");
  $date    = date("Ymd");
  $photo   = $_POST['photo'];
  $crckey = crc32($_SESSION['id']);
  // NOTE: $p  = (str_replace('"', '',$photo));
  $p = $_SESSION['uploadirkey'];
  echo($p);



  $insert = "INSERT INTO share (head,addres,tel,price,comm,time,date,uploadir,sharedid,crcid) VALUES ('".$header."','".$adress."','".$tel."','".$price."','".$comment."','".$time."','".$date."','".$p."','".$shared_id."','".$crckey."')";

  if ($conn->query($insert)=== TRUE) {
    echo ('İnserted');

    $dir = '../upload/'.$p;
    $file = scandir($dir);
    $a = count($files);
    foreach ($file as &$files) {
          if ($files != '.' && $files != '..')
          echo($files.'<br>');
    }

  }else {
    echo ($conn->error);

  }

$_SESSION['uploadirkey'] = '';
}else{
  echo ($err);
}
?>
