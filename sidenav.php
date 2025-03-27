<?php if (isset($_SESSION['email'])) {
 ?>
<div class="w3-sidebar w3-mobile w3-bar-block w3-card w3-animate-left w3-brown w3-padding-top-64 w3-third" style="display:none" id="mySidebar">
  <button class=" w3-button w3-large w3-display-topright w3_close"> &times;</button>

   <a href="index.php" class="w3-bar-item w3-button w3-border">Home</a>

   <a href="view_reservations.php" class="w3-bar-item w3-button w3-border-bottom w3-border-left w3-border-right">Reservations</a>
   <a href="view_checkin.php" class="w3-bar-item w3-button w3-border-bottom w3-border-left w3-border-right">Check In</a>
   <a href="view_checkout.php" class="w3-bar-item w3-button w3-border-bottom w3-border-left w3-border-right">Check Out</a>
   <a href="view_cancel.php" class="w3-bar-item w3-button w3-border-bottom w3-border-left w3-border-right">Cancelled</a>
   <a href="view_rooms.php" class="w3-bar-item w3-button w3-border-bottom">Rooms</a>
   <a href="view_rtype.php" class="w3-bar-item w3-button w3-border-bottom">Room Types</a>
   
   <a href="view_customers.php" class="w3-bar-item w3-button w3-border-bottom">Customers</a>
   
   <a href="view_employees.php" class="w3-bar-item w3-button w3-border">Employees</a>
</div>

<?php 
} ?>