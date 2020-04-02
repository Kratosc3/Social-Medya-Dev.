<?php
session_start();
include 'coonect.php';

include "gett.php";



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






    $sql = "SELECT DISTINCT poster FROM comments where postid = '$shareid' ";
    $result = $conn->query($sql);
    echo('<ul class = "comments-holder" id = "comment_'.$shareid.'" ><h2 class = "comments-header">Yorumlar</h2>');

    if($result->num_rows > 0 ){
      while($row = $result->fetch_array()){


        $Commenter = $row['poster'];

                $sql_get_if_friend = 'SELECT * FROM friends where friend = "'.$Commenter.'"  and'.'  id = "'.$_SESSION['id'].'"';
                $res_get_if_friend = $conn->query($sql_get_if_friend);
                if($res_get_if_friend){
                  while($row = $res_get_if_friend->fetch_assoc()){
                    echo ('<div class = "commenter"><img src= "../upload/pp.jpg"><a onclick = "" href = "" >'.$Commenter.'</a>  </div>');

                  }
                }
                if($res_get_if_friend->num_rows==0){
                  if($Commenter == $_SESSION['id']){
                    echo ('<div class = "commenter"><img src= "../upload/pp.jpg"><a onclick = "" href = "" >'.$Commenter.'</a>  </div>');

                  }else{
                  echo ('<div class = "commenter"><img src= "../upload/pp.jpg"><a onclick = "" href = "" >'.$Commenter.'</a> <img class = "request" src="../vip/rq_color2.svg" onclick = addFriend("'.$Commenter.'")> </div>');
        }
                }else{



                }





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

  $sql_get_if_like = 'SELECT * FROM likes where postid = '.$shareid.'';
  $res_get_if_like = $conn->query($sql_get_if_like);
  if($res_get_if_like){
    if($res_get_if_like->num_rows > 0){


      echo('</ul>');
      echo ('<div  style = "float:right;margin-left:5px;"class = "like-div"> <div id = "like" class="liked"  src ="../vip/heart.png"  onclick = "like('.$shareid.')" ></div></div><span style = "margin-top:5px;float:right" id = "likes_'.$shareid.'">'.$likes.'</span>');

  }else{
    echo('</ul>');

    echo ('<div  style = "float:right;margin-left:5px;"class = "like-div"> <div id = "like" class="like"  src ="../vip/heart.png"  onclick = "like('.$shareid.')" ></div></div><span style = "margin-top:5px;float:right" id = "likes_'.$shareid.'">'.$likes.'</span>');

  }
}


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
