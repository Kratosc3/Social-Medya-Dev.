<?php
session_start();
/* Getting file name */
$filename = $_FILES['file']['name'];
$key = $_POST['randkey'];
/* Getting File size */
$filesize = $_FILES['file']['size'];
$shid = $_SESSION['crckey'];

$dir = '../upload/'.$shid.'/';
$dir2 = $dir.$key;
$_SESSION['uploadirkey'] = $key;
mkdir($dir,0777);
mkdir($dir2,0777);





$location = $dir2.'/'.$filename;

$return_arr = array();

/* Upload file */
if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
    $src = "default.png";

    // checking file is image or not
    if(is_array(getimagesize($location))){
        $src = $location;
    }
    $return_arr = array("name" => $filename,"size" => $filesize, "src"=> $src);
}else {
  echo(error);
}

echo json_encode($foldername);
