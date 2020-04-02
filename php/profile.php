
<?php
if (session_status() == PHP_SESSION_NONE) {
      session_start();
      include 'coonect.php';
      $sql_get_notif = 'SELECT * FROM notifications WHERE shown = "0" AND owner = "'.$_SESSION['id'].' "';
      $res_get_notif = $conn->query($sql_get_notif);
      if($res_get_notif){$count = $res_get_notif->num_rows;}

}
?>

<!DOCTYPE html>
<html>
<head>
  <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
  <meta content="utf-8" http-equiv="encoding">
<link href="../styl/style.css" rel="stylesheet">
<script src="../js/jquery.js"></script>
<script src="../js/script.js"></script>
<link rel="shortcut icon" href="../php/favicon.ico">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<!-- NOTE:
#DFEFA5 0 green
#A1C327 1 green
#5A9F28 2 green
#0080B3 0 blue
#042634 1 blue
-->

<script type="text/javascript">

function exit(){
  location.reload();
  return false;
}

$(document).ready(function update(){


    $.get("../php/profileget.php",function(data){
      $('#story-line').append(data);
    });


});



</script>


<body>


  <div class="container">
    <!-- Trigger the modal with a button -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Kayıt Formu</h4>
          </div>
          <div class="modal-body">
            <!-- NOTE: Register Form -->
            <div class="register-div">
              <form class="register-class" action="../php/register.php" method="post">
                <ul class = register-class-ul>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                      <input id="email-reg" type="text" class="form-control" name="reg-id" placeholder="İsim">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="password-reg" type="password" class="form-control" name="reg-pw" placeholder="Şifre">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="password-reg" type="password" class="form-control" name="password" placeholder="Şifre(Tekrar)">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input id="password-reg" type="email" class="form-control" name="email" placeholder="E-Posta">
                  </div>
                  <button type="submit" class="btn btn-default" >Kayıt OL</button>
              </ul>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button style = 'background-color:crimson;' type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
          </div>
        </div>
      </div>
    </div>
  </div>


<div class="header">
  <?php


  if ($_SESSION['login'] == ''){

  echo ('<div class="login-div">');
  echo ('<form class="form-inline" action="../php/login.php" method="post">');
  echo ('<ul><li><div class="input-group"><span class="input-group-addon"><i id = "someid" class="glyphicon glyphicon-user"></i></span><input id="email" type="text" class="form-control" name="id" placeholder="İsim"></div></li>');
  echo ('<li><div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span><input id="password" type="password" class="form-control" name="pw" placeholder="Şifre"></div></li>');
  echo ('<li><input type="submit" name="submit" value="Giriş"></li>');
  echo ('<li><button type="button" class="kayıt-ol-modal" data-toggle="modal" data-target="#myModal">Kayıt</button></li></ul>');
  echo ('</form>');
  echo ('</div>');
}else{
    echo('
    <div style="display:inline-block;" class = "profile" >

    <img src = "/upload/pp.jpg" style = "margin-top:10px;width:45px;height:45px;float:right;border-radius:10px;border:2px solid green;padding:3px;">

    <div style="color:white;float:right;margin-top:10px;margin-right:10px;">
      <a href="profile" style="font-size:15px;color:white;">'.$_SESSION['id'].'</a>
      <div style="float:left;border:2px solid black;border-top:0px;border-left:0px;border-bottom:0px;margin-right:5px;padding:3px;">
        <a  class ="notification"><img class="profile-near-links" src =../vip/basic_mail.svg> <span class="badge">3</span></a>
        <a href="#" onclick=notify("'.$_SESSION["id"].'") class ="notification"><img onclick ="mouse(event)" class = "profile-near-links" src =../vip/basic_message_txt.svg>



        <span class="badge">
'.$count.'
        </span></a>


        <a href="index" class ="notification"><img class = "profile-near-links" src =../vip/basic_home.svg></a>
      </div>

    </div>

    <h3><a href ="exit.php" style="background-color:darkred;font-size:9px;padding-top:3px;border-radius:3px;color:white;border:1px solid green;width:30px;height:15px;text-align:center;padding:auto;float:right;margin-top:-15px;margin-right:10px;">Çık</a></h3>



    </div>

    ');
}
  ?>

    <ul class = "header-links">
    <li><a href="index">Ana sayfa</a></li>
    </ul>



</div>





  <!-- NOTE: SHARE FORM START -->


 <?php

if ($_SESSION['login'] == 'ok'){

 echo '<div class="form-holder"><div class="share-header"><h3 style="font-family: Impact; font-weight: bold;">Paylaşım</h3></div>
  <form id="share-form"  >
    <!-- NOTE: Başlık -->
   <div class="input-group">
     <span class="input-group-addon" style = "background-color:green;color:white;"><i class="glyphicon glyphicon-fire"></i></span>
     <input id="header" type="text" class="form-control" name="header" placeholder="Başlık :">
   </div>

   <!-- NOTE: Adress -->
   <div class="input-group">
     <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
     <input id="adress" type="text" class="form-control" name="adress" placeholder="Adres :">
   </div>

<!-- NOTE: Telefon -->
   <div class="input-group">
     <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
     <input id="tel" type="text" class="form-control" name="tel" placeholder="Telefon :">
   </div>

<!-- NOTE: Fiyat -->
   <div class="input-group">
     <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
     <input id="price" type="text" class="form-control" name="price" placeholder="Fiyat :">
   </div>

   <!-- NOTE: Yorum -->
<div class="form-group" style = "margin-top:10px;">
    <label for="comment">Açıklama</label>
    <textarea id="comment" class="form-control" rows="2" id="comment" name = "comment"></textarea>
  </div>
  <div type="file" id="dragandrophandler" >Fotoğraf / Video Yükle</div>
  <!-- NOTE: Button -->
 </form>

<button onclick="post()"  id = "post-button" class="btn btn-primary">Paylaş</button>
</div>';
}
?>









<div id="story-line" class="story-line">
</div>















  </body>
</html>
