<?php
include 'coonect.php';
if ($conn){
  $regid = $_POST['reg-id'];
  $regpw = $_POST['reg-pw'];
  $regemail = $_POST['email'];
  $regidcrc = crc32($_POST['reg-id']);
  $sqlreg = "INSERT INTO user (id,pass,email,idcrkey) VALUES ('".$regid."','".$regpw."','".$regemail."','".$regidcrc."')";
  $sqlselid = "SELECT * FROM user WHERE id = '".$regid."'";
  $resultsid = $conn->query($sqlselid);
  $rowid = $resultsid->fetch_all();
  $sqlselem = "SELECT * FROM user WHERE email = '".$regemail."'";
  $resultsem = $conn->query($sqlselem);
  $rowem = $resultsem->fetch_all();
  if(count($rowid)>0){
    echo('Bu İsimde bir kullanıcı zaten var');
  }else{
    if(count($rowem)>0){
      echo('Bu e-mail zaten kullanılıyor');

    }else{
      if ($conn->query($sqlreg)=== TRUE){
        echo 'Kayıt Tamam';
        }else {
          echo ($conn->error);
        }
    }
  }
}
 ?>
