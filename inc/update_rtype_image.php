<?php

if(isset($_FILES['file']) || isset($_POST['rtype'])){
      
   require_once '../config.php';
   var_dump($_POST);
   var_dump($_GET);
   require_once 'functions.php';
   
   $rtype = $_POST['rtype'];
   $RtypeID = $_POST['id'];
   $file = $_FILES['file'];
   $fileName = $file['name'];
   $fileType = $file['type'];
   $fileTempName = $file['tmp_name'];
   $fileError = $file['error'];
   $fileSize = $file['size'];
   $getFileExt = explode('.', $fileName);
   $fileEXT = strtolower(end($getFileExt));
   $allowed = array('jpeg', 'png', 'jpg');
   $image = uniqid($rtype . '_', true) . '.' . $fileEXT;
   $fileDestination = '../img/rtype/' . $image;

   if ($fileName === "" && $fileError === 4) {
       echo("failed to upload image");                  
   } elseif (invalidImage($fileEXT, $allowed, $fileSize, $fileError, $image, $fileTempName, $fileDestination) !== true) {
       updateRtypeImage($conn, $image, $RtypeID);
       echo('update_rtype.php');
       exit();
   }
}
?>
