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
      $('#Email').val('<?= $_SESSION['email'];?>');
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
      <div id="roomContainer">
         <div class="form-row justify-content-center room-row">
            <div class="form-group col-md-2">
               <label for="rtype_0">Room Type</label>
               <select class="form-control rtype" id="rtype_0" name="room[0][rtype]" required>
                  <option value="">Select Room Type</option>
                  <!-- Options will be populated by JavaScript -->
               </select>
            </div>
            <div class="form-group col-md-2">
               <label for="numr_0">Number of Rooms</label>
               <input type="number" class="form-control numr" name="room[0][numr]" id="numr_0" min="1" max="5" required>
            </div>
            <div class="form-group col-md-2">
               <label for="price_0">Price</label>
               <input class="form-control price" type="text" name="room[0][price]" id="price_0" value="0" readonly>
            </div>
            <div class="form-group col-md-1 align-self-end">
               <button type="button" class="btn btn-danger remove-room">Remove</button>
            </div>
         </div>
      </div>
      <div class="form-row justify-content-center">
         <div class="form-group col-md-4 text-right">
            <button id="addRoom" type="button" class="btn btn-secondary">Add Room</button>
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
            <input type="email" class="form-control" name="email" id="Email" value="" required>
         </div>
         <div class="form-group col-md-4">
            <label for="phone">Phone number</label>
            <input type="tel" class="form-control" name="phone" id="phone" value="" required>
         </div>
      </div>
      <div class="form-row justify-content-center">
         <div class="form-group col-md-4 text-center">
            <button class="btn btn-primary" type="submit" name="book">Book</button>
         </div>
      </div>
   </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
   fetchRoomTypes();

  document.getElementById('addRoom').addEventListener('click', function() {
    var roomContainer = document.getElementById('roomContainer');
    var roomRows = document.querySelectorAll('.room-row');
    var newIndex = roomRows.length;

    var newRoomRow = document.createElement('div');
    newRoomRow.className = 'form-row justify-content-center room-row';
    newRoomRow.innerHTML = `
      <div class="form-group col-md-2">
        <label for="rtype_${newIndex}">Room Type</label>
        <select class="form-control rtype" id="rtype_${newIndex}" name="room[${newIndex}][rtype]" required>
          <option value="">Select Room Type</option>
        </select>
      </div>
      <div class="form-group col-md-2">
        <label for="numr_${newIndex}">Number of Rooms</label>
        <input type="number" class="form-control numr" name="room[${newIndex}][numr]" id="numr_${newIndex}" min="1" max="5" required>
      </div>
      <div class="form-group col-md-2">
        <label for="price_${newIndex}">Price</label>
        <input class="form-control price" type="text" name="room[${newIndex}][price]" id="price_${newIndex}" value="0" readonly>
      </div>
      <div class="form-group col-md-1 align-self-end">
        <button type="button" class="btn btn-danger remove-room">Remove</button>
      </div>
    `;

    roomContainer.appendChild(newRoomRow);
    populateRoomTypes(newIndex);
  });

  document.getElementById('roomContainer').addEventListener('click', function(event) {
    if (event.target.classList.contains('remove-room')) {
      event.target.closest('.room-row').remove();
    }
  });

  document.getElementById('roomContainer').addEventListener('change', function(event) {
    if (event.target.classList.contains('rtype') || event.target.classList.contains('numr')) {
      updatePrice(event.target);
    }
  });
});


 </script>

 <?php
 require_once 'footer.php';
 ?>