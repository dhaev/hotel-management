<?php
require_once '../config.php';
session_start();
require_once 'functions.php';

if (isset($_FILES['file'])&&isset($_POST['pre'])){
      $fname=$_POST['fname'];
      $lname=$_POST['lname'];
      $email=$_POST['email'];
      $phone=$_POST['phone'];
      $address=$_POST['address'];
      $country=$_POST['country'];
      $city=$_POST['city'];    
      $id=$_SESSION["CustomerID"];
      
      $preview=$_POST['pre'];
      $file=$_FILES['file'];
      $fileName=$file['name'];
      $fileType=$file['type'];
      $fileTempName=$file['tmp_name'];
      $fileError=$file['error'];
      $fileSize=$file['size'];
      $getFileExt=explode('.',$fileName);
      $fileEXT=strtolower(end($getFileExt));
      $allowed=array('jpeg','png','jpg');
      $image=uniqid('profile'.$id.'_',true).'.'.$fileEXT;
      $fileDestination='../img/'.$image;

      if ($fileName === "" && $fileError === 4) {
            $image=$_SESSION["image"];
            updateProfile($conn,$fname,$lname,$email,$phone,$address,$country,$city,$image,$id);
             $imgsrc='/img/'.$image;
             unlink($preview);
            echo($imgsrc); 
            //echo(json_encode('img:'.$imgsrc.''));         
      } else {
            if (img($fileEXT,$allowed,$fileSize,$fileError,$image,$fileTempName,$fileDestination) !== true){
                  exit();
            }
            updateProfile($conn,$fname,$lname,$email,$phone,$address,$country,$city,$image,$id);
            $imgsrc='/img/'.$image;
            $_SESSION["image"]=$image;
           // print($imgsrc);
            unlink($preview);
            echo($imgsrc);
            echo(json_encode('img:imgsrc'));
      }

}
else{
      echo('pre file not set nooooo!!!!!!! am crying!!!!!!!');
}