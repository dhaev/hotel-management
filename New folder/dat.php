<?php

if(isset($_POST['dat'])){
   $cin=$_POST['cin'];
   $cout=$_POST['cout'];
   
   require_once 'config.php';
   require_once 'inc/functions.php';

   if(addRoomEmpty($cin,$cout)!==false){
       echo('index.php ? addroom error=please fill all fields');
      exit();
   }

   createRoom($conn,$cin,$cout);

   
}
else{
    echo('index.php');
   exit();
   }
?>