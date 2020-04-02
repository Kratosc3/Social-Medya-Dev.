<?php
$servername = "localhost";
$username = "root";
$password = "password";
$db = 'market';
// Create connection
$conn = new mysqli($servername, $username, $password,$db);
$err = connect_error;
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}else{

}


?>
