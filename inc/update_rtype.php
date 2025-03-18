<?php

if(isset($_POST['rtype'])){
      
   require_once '../config.php';
   require_once 'functions.php';

   $rtype=$_POST['rtype'];
   $price=$_POST['price'];
   $desc=$_POST['desc'];
   $RtypeID=$_POST['rtid'];

   if(empty($rtype)||empty($price)||empty($desc)){
       echo('Please fill all fields');
       exit();
   }

   updateRtype($conn,$rtype,$price,$desc,$RtypeID);  

} else {
    echo('update_rtype_text.php');
    exit();
}
?>
