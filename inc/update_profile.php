<?php
require_once '../config.php';
session_start();
require_once 'functions.php';
var_dump($_POST);
if (isset($_POST['fname'])) {
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $country = $_POST['country'];
      $city = $_POST['city'];    
      $id = $_SESSION["CustomerID"];

      updateCustomer($conn, $id, $fname, $lname, $email, $phone, $address, $country, $city);

      $_SESSION['fname'] = $fname;
      $_SESSION['lname'] = $lname;
      $_SESSION['email'] = $email;
      $_SESSION['phone'] = $phone;
      $_SESSION['address'] = $address;
      $_SESSION['country'] = $country;
      $_SESSION['city'] = $city;
} else {
      echo('profile update failed');
}