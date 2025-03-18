<?php
require_once '../config.php';
session_start();
require_once 'functions.php';

if (isset($_FILES['file'])) {
     $id = $_SESSION["CustomerID"];
     $file = $_FILES['file'];
     $fileName = $file['name'];
     $fileType = $file['type'];
     $fileTempName = $file['tmp_name'];
     $fileError = $file['error'];
     $fileSize = $file['size'];
     $getFileExt = explode('.', $fileName);
     $fileEXT = strtolower(end($getFileExt));
     $allowed = array('jpeg', 'png', 'jpg');
     $image = uniqid('profile' . $id . '_', true) . '.' . $fileEXT;
     $fileDestination = '../img/' . $image;

     if ($fileName === "" && $fileError === 4) {
         echo("failed to upload image");
     } else {
         if (invalidImage($fileEXT, $allowed, $fileSize, $fileError, $image, $fileTempName, $fileDestination) !== true) {
             updateProfileImage($conn, $image, $id);
             $imgsrc = '/img/' . $image;
             $_SESSION["image"] = $image;
             echo($imgsrc);
         }
     }
} else {
     echo('image not uploaded');
}
?>