<?php
require_once 'functions.php';

if(isset($_FILES['file'])){
      $file=$_FILES['file'];
      $fileName=$file['name'];
      $fileType=$file['type'];
      $fileTempName=$file['tmp_name'];
      $fileError=$file['error'];
      $fileSize=$file['size'];
      $getFileExt=explode('.',$fileName);
      $fileEXT=strtolower(end($getFileExt));
      $allowed=array('jpeg','png','jpg');
      $image=uniqid('',true).'.'.$fileEXT;
      $fileDestination='../img/preview/'.$image;
      if (img($fileEXT,$allowed,$fileSize,$fileError,$image,$fileTempName,$fileDestination) !== true){
            
                  exit();
      }
      $imgsrc='img/preview/'.$image;
    print($imgsrc);  
}