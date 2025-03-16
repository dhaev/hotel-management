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

<div class="container mt-5">
   <h2 class="text-center mb-4">Book Room</h2>
   <form id="form1" action="inc/book.php" method="post">
      <div class="form-row justify-content-center">
         <div class="form-group col-md-4">
            <label for="cin">Check in</label>
            <input type="date" class="form-control" name="checkin" id="cin" value="<?php echo date('Y-m-d')?>" required>
         </div>
         <div class="form-group col-md-4">
            <label for="cout">Check out</label>
            <input type="date" class="form-control" name="checkout" id="cout" required>
         </div>
      </div>
      <div class="form-row justify-content-center">
         <div class="form-group col-md-2">
            <label for="rtype_0">Room Type</label>
            <select class="form-control" id="rtype_0" name="room[0][rtype]" required>
               <option value="">Select Room Type</option>
            </select>
         </div>
         <div class="form-group col-md-2">
            <label for="numr_0">Room Number</label>
            <input type="number" class="form-control" name="room[0][numr]" id="numr_0" required>
         </div>
         <div class="form-group col-md-2">
            <label for="price_0">Price</label>
            <input class="form-control" type="text" name="room[0][price]" id="price_0" value="0">
         </div>
      </div>
      <div id="newRow"></div>
      <input type="hidden" value="0" id="indx">
      <div class="form-row justify-content-center">
         <div class="form-group col-md-4 text-right">
            <button id="addRow" type="button" class="btn btn-secondary">Add Room</button>
         </div>
      </div>
      <div class="form-row justify-content-center">
         <div class="form-group col-md-4">
            <label for="fname">Firstname</label>
            <input type="text" class="form-control" name="fname" id="fname" value="" required>
         </div>
         <div class="form-group col-md-4">
            <label for="lname">Lastname</label>
            <input type="text" class="form-control" name="lname" id="lname" value="" required>
         </div>
      </div>
      <div class="form-row justify-content-center">
         <div class="form-group col-md-4">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="" required>
         </div>
         <div class="form-group col-md-4">
            <label for="phone">Phone number</label>
            <input type="tel" class="form-control" name="phone" id="phone" value="" required>
         </div>
      </div>
      <div class="form-row justify-content-center">
         
            <button class="btn btn-secondary form-group col-md-4 text-center" type="submit" name="book">Book</button>
         
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