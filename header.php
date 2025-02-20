<?php
  session_start();
?>

<!DOCTYPE html>
  <html lang=en>
    <head>
      <meta name="viewport" content="width:device-width,initial-scale=1">
      <meta charset=utf-8 >
      <title>form play</title>
      <link rel="stylesheet" type="text/css" href="css/reset.css">
      <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
      <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
       <link rel="stylesheet" type="text/css" href="css/style.css">  
       <link rel="stylesheet" type="text/css" href="css/w3.css">
     
      <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css"> -->
       <script src="jQuery.js"></script>
      <script type="text/javascript" src="function.js"></script>
       <!-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> -->
    </head>
      <body >
<?php include 'sidenav.php'; ?>

 <div class="w3-bar w3-border w3-brown nav">
 <?php
              if (isset($_SESSION['CustomerID'])) {
            ?> 
        <div class="w3-bar-item w3-right " >
         <img src="img/<?=$_SESSION['image']?>" id="img1" class='w3-block w3-circle dropdown-btn' alt="profile picture">
          
          <div class="w3-hide w3-white w3-card w3-dropdown-content w3-display-middle">
            <a href="profile.php" class="w3-block w3-button" >Profile</a>
            <a href="logout.php" class="w3-block w3-button">Logout</a>
            <a href="change_password.php" class="w3-block w3-button">Change password</a>
          </div>
       </div>
  
 
 <?php } 
              else{ 
            ?>
              <a href="add_customer.php" class="w3-bar-item w3-button w3-padding-16 w3-right" >SignUp</a></li>
              <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-right" onclick="document.getElementById('id01').style.display='block'">Login</a>
              <a href="book.php" class="w3-bar-item w3-button w3-padding-16 w3-right">Book</a>
              <a href="index.php" class="w3-bar-item w3-button w3-padding-16 w3-right">Home</a>
            
            <?php }
            ?>  
     <!--  <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-right">Home</a>
      <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-right" >Link 1</a>
      <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-right">Link 2</a>
      <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-right">Link 3</a> -->
      <?php if (isset($_SESSION['email'])) {
 ?>
      <button class="w3-button w3-bar-item w3-padding-12 w3-xlarge w3_open" id="openNav" > &#9776;</button>
      <!-- ☰ -->
     <?php } ?>
               
      
        </div>
        <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-2">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2 >Login</h2>
      </header>
      <div class="w3-container">
        <form class="form1"  id='login' action="inc/login.php" method="post">
            
          
        <p><input class="w3-input" type="email" id="email" name="email" placeholder="email..." autocomplete="username" required></p>
        <p><input  class="w3-input" type="password" id="pwd" name="pwd" placeholder="Password..." autocomplete="password" required></p>
        <p><button class="w3-button" id='log_in' name="login" >Submit</button>
                </form></p>
      </div>
      <footer class="w3-container w3-teal">
        <p>Modal Footer</p>
      </footer>
    </div>
  </div>
       
        
<div id="main" class=" w3-padding-large w3-padding-top-64">
      
 