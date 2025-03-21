<?php
require_once '../config.php';
require_once '../header.php';
require_once 'functions.php';
if (isset($_POST['cid'])) {
      $id=$_POST["cid"];
      $fname=$_POST['fname'];
      $lname=$_POST['lname'];
      $email=$_POST['email'];
      $phone=$_POST['phone'];
      $address=$_POST['address'];
      $country=$_POST['country'];
      $city=$_POST['city'];    
      
      updateCustomer($conn,$id,$fname,$lname,$email,$phone,$address,$country,$city); 
      exit();  
}else{
      
}


      
      



