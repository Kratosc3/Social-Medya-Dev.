<?php
$dir = 'upload/07592820200301/';

$file = scandir($dir);
$a = count($files);

foreach ($file as &$files) {
      if ($files != '.' && $files != '..')
      echo($files.'<br>');

  // code...
}




 ?>
