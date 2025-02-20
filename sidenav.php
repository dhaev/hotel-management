<?php if (isset($_SESSION['email'])) {
 ?>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left w3-brown w3-padding-top-64 w3-third" style="display:none" id="mySidebar">
  <button class=" w3-button w3-large w3-display-topright w3_close"> &times;</button>

   <a href="index.php" class="w3-bar-item w3-button w3-border">Home</a>

   <button class="w3-button w3-block w3-left-align dropdown-btn w3-border-bottom w3-border-left w3-border-right" >
  Book <i class="fa fa-caret-down"></i>
  </button>
  <div class="w3-hide w3-white w3-card ">
    <a href="book.php" class="w3-bar-item w3-button w3-border-bottom w3-border-left w3-border-right">book</a>
    <a href="view_booked.php" class="w3-bar-item w3-button w3-border-bottom">View Booked</a>
  </div>

   <a href="view_checkin.php" class="w3-bar-item w3-button w3-border-bottom w3-border-left w3-border-right">Check In</a>
   <a href="view_checkout.php" class="w3-bar-item w3-button w3-border-bottom w3-border-left w3-border-right">Check Out</a>
   <a href="view_cancel.php" class="w3-bar-item w3-button w3-border-bottom w3-border-left w3-border-right">Cancelled</a>

   <button class="w3-button w3-block w3-left-align w3-border-bottom w3-border-left w3-border-right dropdown-btn" >
  Room <i class="fa fa-caret-down"></i>
  </button>
  <div class="w3-hide w3-white w3-card">
    <!-- <a href="add_room.php" class="w3-bar-item w3-button w3-border-bottom ">a rm</a> -->
      <a href="view_rooms.php" class="w3-bar-item w3-button w3-border-bottom">v rm</a>
      <!-- <a href="add_rtype.php" class="w3-bar-item w3-button w3-border-bottom">a rt</a> -->
      <a href="view_rtype.php" class="w3-bar-item w3-button w3-border-bottom">v rt</a>
  </div>

  <button class="w3-button w3-block w3-left-align w3-dropdown-click w3-border-bottom w3-border-left w3-border-right  dropdown-btn" >
  Customers <i class="fa fa-caret-down"></i>
  </button>
  <div class="w3-hide w3-white w3-card ">
    <a href="add_customer.php" class="w3-bar-item w3-button w3-border-bottom">add cus</a>
       <a href="view_customers.php" class="w3-bar-item w3-button w3-border-bottom">view cus</a>
  </div>

  <button class="w3-button w3-block w3-left-align w3-border dropdown-btn">
  Employees <i class="fa fa-caret-down"></i>
  </button>
  <div class="w3-hide w3-white w3-card">
     <a href="add_employee.php" class="w3-bar-item w3-button w3-border">a emp</a>
       <a href="view_employees.php" class="w3-bar-item w3-button w3-border">v emp</a>
  </div>
</div>

<?php 
} ?>