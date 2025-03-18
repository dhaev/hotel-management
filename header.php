<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Form Play</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="jQuery.js"></script>
    <!-- <script type="text/javascript" src="function.js"></script> -->
</head>
<body>
    <?php include 'sidenav.php'; ?>

    <div class="w3-bar w3-border w3-brown nav w3-display-container" id="headbar">
        <?php if (isset($_SESSION['CustomerID'])) { ?>
            <div class="w3-bar-item w3-display-right">
                <div class="w3-bar-item w3-right">
                <img src="img/<?=$_SESSION['image']?>" id="img1" class="w3-circle" alt="profile picture" style="width: 50px; height: 50px;">
               
                    <a href="profile.php" class="w3-bar-item w3-button w3-padding-16 w3-right">Profile</a>
                    <a href="logout.php" class="w3-bar-item w3-button w3-padding-16 w3-right">Logout</a>
                    <a href="change_password.php" class="w3-bar-item w3-button w3-padding-16 w3-right">Change password</a>
              </div>  
            </div>
        <?php } else { ?>
            
            <a href="add_customer.php" class="w3-bar-item w3-button w3-padding-16 w3-right">SignUp</a>
            <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-right" onclick="document.getElementById('id01').style.display='block'">Login</a>
            <a href="book.php" class="w3-bar-item w3-button w3-padding-16 w3-right">Book</a>
            <a href="index.php" class="w3-bar-item w3-button w3-padding-16 w3-right">Home</a>
            
        <?php } ?>

        <?php if (isset($_SESSION['email'])) { ?>
            <button class="w3-button w3-bar-item w3-padding-12 w3-xlarge w3_open" id="openNav">&#9776;</button>
        <?php } ?>
    </div>

    <div id="id01" class="w3-modal">
        <div class="w3-modal-content w3-animate-top w3-card-2">
            <header class="w3-container w3-brown">
                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright w3-xlarge">&times;</span>
                <h3 class="w3-center">Login</h3>
            </header>
            <div class="w3-container">


            <form id="form1" id="login" action="inc/login.php" method="post">
      
      <div class="form-row justify-content-center mt-5">
         <div class="form-group col-md-4">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" autocomplete="username" required>
         </div>
         </div>
      <div class="form-row justify-content-center mt-2">
         <div class="form-group col-md-4">
            <label for="pwd">Password</label>
            <input type="password" class="form-control" id="pwd" name="pwd"autocomplete="password" required>
         </div>
      </div>
      <div class="form-row justify-content-center">
         <button class="btn btn-secondary form-group col-md-4 text-center" type="submit" id="log_in" name="login">Submit</button>
      </div>
   </form>

            </div>
   
        </div>
    </div>

    <div id="main" class="w3-padding-large w3-padding-top-64">
        <!-- Main content goes here -->
    