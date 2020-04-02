<?php
session_start();
include "coonect.php";

$sql_get_post = "SELECT * FROM share" ;
$results = $conn->query($sql_get_post);

if ($conn){

  $get = 'SELECT * FROM share ORDER BY shareid DESC';
  $results = $conn->query($get);
  $cont = $results->num_rows;


  if ($results->num_rows > 0) {
    while ($row = $results->fetch_assoc()){

  $header_row = $row['head'];
  $adres_row = $row['addres'];
  $tel_row = $row['tel'];
  $price_row = $row['price'];
  $comm_row = $row['comm'];
  $time_row = $row['time'];
  $date_row = $row['date'];
  $photo_row =$row['uploadir'];
  $shared_id = $row['sharedid'];
  $sharedidcrc32 = crc32($shared_id);



  $shareid  = $row['shareid'];
  $sqlgetLikes = 'SELECT * FROM likes WHERE postid = '.$shareid.'';
  $resultLikes = $conn->query($sqlgetLikes);
  $likes = $resultLikes->num_rows;




  #  echo ('<br>'.$header_row.'<br> '.$adres_row.'<br>'.$header_row.'<br>'.$tel_row.'<br>'.$price_row.'<br>'.$comm_row.'<br>'.$time_row.'<br>'.$date_row);



    echo ('<div id = "post_'.$shareid.'" class=stories style="margin:auto;">');
    echo ('<h2 class = "shared-id"><div class="legend-pp"><img class = "pp" src = "../upload/pp.jpg"> <a onclick = "redirectProfile('.$sharedidcrc32.')" style = "text-decoration:none;color:white;" >'.$shared_id.'</a></div></h2>');
    echo ('<div class="header-uploaded">'.$header_row.'</div>');
    echo ('<h2 id = >'.$adres_row.'</h1>');
    echo ('<h2 id = >'.$tel_row.'</h1>');
    echo ('<h2 id = >'.$price_row.'</h1>');

    $dir = '../upload/'.$sharedidcrc32.'/'.$photo_row;
    if ($photo_row){
      $file = scandir($dir);


      foreach ($file as &$files) {
        if($dir == '../upload/'){
        }else{
            if ($files != '.' && $files != '..' )
            echo ('<img class="shared-img" src = '.$dir.'/'.$files.'>');
          }
      }



    }




    echo ('<div class = "like-div"><button onclick = "like('.$shareid.')" >Like</button></div>');
    echo ('<label>likes:</label><div id = "likes_'.$shareid.'">'.$likes.'</div>');

    $sql = "SELECT DISTINCT poster FROM comments where postid = '$shareid' ";
    $result = $conn->query($sql);
    echo('<ul class = "comments-holder" id = "comment_'.$shareid.'" ><h2 class = "comments-header">Yorumlar</h2>');

    if($result->num_rows > 0 ){
      while($row = $result->fetch_array()){


        $Commenter = $row['poster'];
        echo ('<h3>'.$Commenter.'</h3>');

        $sqlcom = 'SELECT * FROM comments where postid = '.$shareid.' AND poster = "'.$Commenter.'" ';
        $rescom = $conn->query($sqlcom);
        if ($rescom->num_rows > 0 ){
          while($roww = $rescom->fetch_assoc()){
            $Comment = $roww['comment'];
            echo ('<li>'.$Comment);
            if($Commenter == $_SESSION['id']){

            $comid = $roww['comid'];
            echo('<a style = float:right;color:white; onclick =rmcom('.$comid.')> sil </a> ');
  }
            echo('</li>');


          }
        }
      }
    }

    $sqlgetCom = 'SELECT * FROM comments WHERE postid = '.$shareid.' ';
    $resultsCom = $conn->query($sqlgetCom);



    if($resultsCom->num_rows > 0 ){

        while ($rowCom = $resultsCom->fetch_assoc()){
                $Commenter = $rowCom['poster'];
                $Comment = $rowCom['comment'];



    }
  }
    echo('</ul>');

    echo('
          <div class = "comment-holder">
          <label class = "comment-label">Yorum : </label>
          <input id = "comment-post" type="text" class="comment"  ><button  onclick= "comment('.$shareid.')" class="send-comment" >Gönder</button>
          </div>');
    echo ('</div>');


  }
  }

    }else{
  echo ($err);
}


 ?>
