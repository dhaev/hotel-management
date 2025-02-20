   <?php
      print_r($_POST);
   if (isset($_POST['checkin']) && isset($_POST['checkout']) ) {

   $checkin=$_POST['checkin'];
$checkout=$_POST['checkout'];
   $fname=$_POST['fname'];
   $lname=$_POST['lname'];
   $email=$_POST['email'];
   $phone=$_POST['phone'];
   $address=$_POST['address'];
   $country=$_POST['country'];
   $city=$_POST['city'];
    $status=0 ;


   $room=$_POST['room'];
   require_once '../config.php';
   require_once 'functions.php';
   
foreach ($room as $value) {
     $rtype=$value['rtype'];
   $numr=$value['numr'];
   $price=$value['price'];
   
   if(bookEmpty($checkin,$checkout,$rtype,$numr,$price,$fname,$lname,$email,$phone,$address,$country,$city)!==false){
       echo('index.php ? error=please fill all fields');
      exit();
   }
     
}
   $BookID=createBook($conn,$checkin,$checkout,$fname,$lname,$email,$phone,$address,$country,$city);
   foreach ($room as $value) {
     $rtype=$value['rtype'];
   $numr=$value['numr'];
   $price=$value['price'];
   
   for ($i=1; $i <= intval($numr) ; $i++) { 
   bookRnum($conn,$rtype,$checkin,$checkout,$BookID,$status,$price);
  }
     
}
}else{
       echo('index.php');
      exit();
   }

// require_once '../book.php';



  