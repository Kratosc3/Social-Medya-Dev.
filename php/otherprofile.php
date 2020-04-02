<?php
session_start();
include 'coonect.php';
$crckey = $_POST['userid'];
$get = 'SELECT * FROM share  WHERE crcid = '.$crckey.' '.' ORDER BY shareid DESC ';
$results = $conn->query($get);
echo('<div id = "story-line" class = "story-line"></div>');

if ($conn){


  if ($results->num_rows > 0){
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



      echo ('<div class=stories>');

      echo ('<h2 class = "shared-id"><div class="legend-pp"><img class = "pp" src = "upload/pp.jpg">'.$shared_id.'</div></h2> ');
      echo ('<div class="header-uploaded">'.$header_row.'</div>');
      echo ('<h2 id = >'.$adres_row.'</h1>');
      echo ('<h2 id = >'.$tel_row.'</h1>');
      echo ('<h2 id = >'.$price_row.'</h1>');
      echo ('<h2 id = >'.$comm_row.'</h1>');


      $dir = '../upload/'.$sharedidcrc32.'/'.$photo_row;

      $file = scandir($dir);
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
          echo ('<li style = "width:100%;float:left;list-style-type:none;margin:5px;"><input type = "text"></input></li> <li style = "float:left;list-style-type:none;margin:5px;" ><button>Gönder</button></li>');
      echo ('</div>');
    }
  }

}




?>
