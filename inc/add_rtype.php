<?php

if(isset($_FILES['file'])||isset($_POST['rtype'])){
      
   
   require_once '../config.php';
   require_once 'functions.php';

      $rtype=$_POST['rtype'];
      $price=$_POST['price'];
      $desc=$_POST['desc'];
      $file=$_FILES['file'];
      $fileName=$file['name'];
      $fileType=$file['type'];
      $fileTempName=$file['tmp_name'];
      $fileError=$file['error'];
      $fileSize=$file['size'];
      $getFileExt=explode('.',$fileName);
      $fileEXT=strtolower(end($getFileExt));
      $allowed=array('jpeg','png','jpg');
      $image=uniqid($rtype.'_',true).'.'.$fileEXT;
      $fileDestination='../img/rtype/'.$image;

      if (isset($_GET['oldimage']) && $fileName === "" && $fileError === 4) {
            $oldimage=$_GET['oldimage'];
            $RtypeID=$_GET['id'];
            $image=$oldimage; 
            updateRtype($conn,$rtype,$price,$desc,$image,$RtypeID);                   
      }
      elseif (isset($_GET['oldimage']) && ($fileName !== "")) {
            $RtypeID=$_GET['id'];
            if (img($fileEXT,$allowed,$fileSize,$fileError,$image,$fileTempName,$fileDestination) !== true){
                  exit();
            }
            if(empty($rtype)||empty($price)||empty($desc)){
                echo('Please fill all fields');
               exit();
            }
            updateRtype($conn,$rtype,$price,$desc,$image,$RtypeID);  

      } elseif ((!isset($_GET['oldimage'])) && $fileName === "" && $fileError === 4) {
            echo('Please select an image');
      } 
      else{
            if (img($fileEXT,$allowed,$fileSize,$fileError,$image,$fileTempName,$fileDestination) !== true){
                  exit();
            }

            if(addrtypeEmpty($rtype,$price,$desc,$image)!==false){
                echo('Please fill all fields');
               exit();
            }
            if(rtypeExists($conn,$rtype)!==false){
                echo('Room type already exists');
               exit();
            }

            addRtype($conn,$rtype,$price,$desc,$image);
             
      }

}  

else{
    echo('add_rtype.php');
   exit();
   }
?>