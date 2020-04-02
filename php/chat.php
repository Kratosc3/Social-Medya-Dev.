<?php
include 'coonect.php';
session_start();

$id = $_SESSION['id'];

$sql_get_chat = 'SELECT * FROM friends where id = "'.$id.'"';
$res_get_chat = $conn->query($sql_get_chat);


echo "<h4 style = 'text-align:center;'>Arkadaşlar<h4>";
echo "<ul class = 'friends-ul'>";

if($res_get_chat){
  while($row = $res_get_chat->fetch_assoc()){
    echo  "<li onclick = startChat('".$row['friend']."') ><img style = 'margin-right:5px;' class = 'pp' src= '../upload/pp.jpg'>".$row['friend']."</li>";

  }
}
echo "</ul>";

 ?>
