<?php
require_once 'config.php';
require_once 'header.php';
?>

<?php 
if (isset($_SESSION['email'])) {
?>
<script>
   $(function () {
      $('#fname').val('<?= $_SESSION['fname'];?>');
      $('#lname').val('<?= $_SESSION['lname'];?>');
      $('#email').val('<?= $_SESSION['email'];?>');
      $('#phone').val('<?= $_SESSION['phone'];?>');
      $('#address').val('<?= $_SESSION['address'];?>');
      $('#country').val('<?= $_SESSION['country'];?>');
      $('#city').val('<?= $_SESSION['city'];?>');
   });
</script>
<?php } ?>

<div class="w3-container w3-margin-top w3-center">
   <h2 class="w3-center w3-margin-bottom">Book Room</h2>
   <form id="form1" action="inc/book.php" method="post" class="w3-container w3-card-4 w3-light-grey w3-padding-16 w3-margin-auto" style="max-width: 600px;">
      <div class="w3-row-padding">
         <div class="w3-half">
            <label for="cin">Check in</label>
            <input type="date" class="w3-input w3-border" name="checkin" id="cin" value="<?php echo date('Y-m-d')?>" required>
         </div>
         <div class="w3-half">
            <label for="cout">Check out</label>
            <input type="date" class="w3-input w3-border" name="checkout" id="cout" required>
         </div>
      </div>
      <div class="w3-row-padding w3-margin-top">
         <div class="w3-third">
            <label for="rtype_0">Room Type</label>
            <select class="w3-select w3-border" id="rtype_0" name="room[0][rtype]" required>
               <option value="">Select Room Type</option>
            </select>
         </div>
         <div class="w3-third">
            <label for="numr_0">Room Number</label>
            <input type="number" class="w3-input w3-border" name="room[0][numr]" id="numr_0" required>
         </div>
         <div class="w3-third">
            <label for="price_0">Price</label>
            <input class="w3-input w3-border" type="text" name="room[0][price]" id="price_0" value="0">
         </div>
      </div>
      <div id="newRow"></div>
      <input type="hidden" value="0" id="indx">
      <div class="w3-row-padding w3-margin-top">
         <div class="w3-col m4 w3-right-align">
            <button id="addRow" type="button" class="w3-button w3-secondary">Add Room</button>
         </div>
      </div>
      <div class="w3-row-padding w3-margin-top">
         <div class="w3-half">
            <label for="fname">Firstname</label>
            <input type="text" class="w3-input w3-border" name="fname" id="fname" value="" required>
         </div>
         <div class="w3-half">
            <label for="lname">Lastname</label>
            <input type="text" class="w3-input w3-border" name="lname" id="lname" value="" required>
         </div>
      </div>
      <div class="w3-row-padding w3-margin-top">
         <div class="w3-half">
            <label for="email">Email</label>
            <input type="email" class="w3-input w3-border" name="email" id="email" value="" required>
         </div>
         <div class="w3-half">
            <label for="phone">Phone number</label>
            <input type="tel" class="w3-input w3-border" name="phone" id="phone" value="" required>
         </div>
      </div>
      <div class="w3-row-padding w3-margin-top">
         <button class="w3-button w3-secondary w3-block" type="submit" name="book">Book</button>
      </div>
   </form>
</div>

<?php
if (isset($_GET['type'])) {
?>
<script>
   let oi = "<?php echo $_GET['type'];?>";
   grtype(oi);
</script>
<?php
} else {
?>
<script>
   grtype();
</script>
<?php
}
require_once 'footer.php';
?>