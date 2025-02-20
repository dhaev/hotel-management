   <?php
    print_r($_POST);  
   if (isset($_POST['bid'])) {

   $Customerid=$_POST["cid"];
   $Bookid=$_POST["bid"];
   $id=$_POST["id"];
   $checkin=$_POST['checkin'];
   $checkout=$_POST['checkout'];
   $rtype=$_POST['rtype'];
   $RoomID=$_POST['numr'];
   $price=$_POST['price'];
   $fname=$_POST['fname'];
   $lname=$_POST['lname'];
   $email=$_POST['email'];
   $phone=$_POST['phone'];
   $address=$_POST['address'];
   $country=$_POST['country'];
   $city=$_POST['city'];
   
   $status=0 ;


   require_once '../config.php';
   require_once 'functions.php';

   if(bookEmpty($checkin,$checkout,$rtype,$RoomID,$price,$fname,$lname,$email,$phone,$address,$country,$city)!==false){
       echo('index.php ? error=please fill all fields');
      exit();
   }
     
   updateBook($conn,$Customerid,$Bookid,$id,$checkin,$checkout,$RoomID,$price,$fname,$lname,$email,$phone,$address,$country,$city,$status);

   }
   else{
       echo('index.php');
      exit();
   }





  