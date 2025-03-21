<?php

if(isset($_POST['rnum'])&&isset($_POST['rnum'])){
   $rtype=$_POST['rtype'];
   $rnum=$_POST['rnum'];
   var_dump($_POST);
   
   require_once '../config.php';
   require_once 'functions.php';

   if(addRoomEmpty($rtype,$rnum)!==false){
      echo('please fill all fields');
      exit();
   }
   if(selectRnum($conn,$rnum)!==false){
     echo('room number already exists');
      exit();
   }
   

   createRoom($conn,$rtype,$rnum);

   
}
else{
    echo('add_room.php');
   exit();
   }
?>