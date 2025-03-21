<?php
require_once 'config.php';
require_once 'header.php';

$r_id = $_GET['reservation_id'];
$room_details = [];
$sql_dates = "SELECT DATE(`start_date`) AS start_date, DATE(`end_date`) AS end_date, DATEDIFF(`end_date`, `start_date`) AS num_days FROM `reservations` WHERE id = ?";
$stmt_dates = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt_dates, $sql_dates)) {
    echo('failed to connect');
    exit();
}
mysqli_stmt_bind_param($stmt_dates, 'i', $r_id);
mysqli_stmt_execute($stmt_dates);
$result_dates = mysqli_stmt_get_result($stmt_dates);
if ($row_dates = mysqli_fetch_assoc($result_dates)) {
    $start_date = $row_dates['start_date'];
    $end_date = $row_dates['end_date'];
    $num_days = $row_dates['num_days'];
} else {
    echo('Reservation does not exist');
    exit();
}
mysqli_stmt_close($stmt_dates);

$sql = "WITH get_details AS (SELECT id, type_id, num_rooms FROM `reservation_details` WHERE reservation_id=?)
SELECT id, type_id, num_rooms, price, (num_rooms * price) AS sub_total, rtype FROM get_details JOIN room_type ON type_id = RtypeID";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo('failed to connect');
    exit();
}
mysqli_stmt_bind_param($stmt, 'i', $r_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $room_details[] = $row;
    }
} else {
    $room_details = false;
    echo('Room type does not exist');
}
mysqli_stmt_close($stmt);

if (isset($_SESSION['email'])) {
?>
<script>
   $(function () {
      $('#reservation_id').val('<?= $r_id;?>');
      $('#cin').val('<?= $start_date; ?>');
      $('#cout').val('<?= $end_date; ?>');
      // Pre-fill room details
      <?php foreach ($room_details as $index => $detail) { ?>
      $('#rtype_<?= $index; ?>').val('<?= $detail['type_id']; ?>');
      $('#numr_<?= $index; ?>').val('<?= $detail['num_rooms']; ?>');
      $('#price_<?= $index; ?>').val('<?= $detail['sub_total'] * $num_days ; ?>');
      <?php } ?>
   });
</script>
<?php } ?>

<div class="container mt-5">
   <h2 class="text-center mb-4">Edit Reservation</h2>
   <form id="textForm" action="inc/update_reservation.php" method="post">
      <div class="form-row justify-content-center">
         <div class="form-group col-md-4">
            <label for="cin">Check in</label>
            <input type="date" class="form-control" name="checkin" id="cin" value="<?php echo $start_date; ?>" required>
         </div>
         <div class="form-group col-md-4">
            <label for="cout">Check out</label>
            <input type="date" class="form-control" name="checkout" id="cout" value="<?php echo $end_date; ?>" required>
         </div>
      </div>
      <div id="roomContainer">
         <?php foreach ($room_details as $index => $detail) { ?>
         <div class="form-row justify-content-center room-row">
            <div class="form-group col-md-2">
               <label for="rtype_<?= $index; ?>">Room Type</label>
               <select class="form-control rtype" id="rtype_<?= $index; ?>" name="room[<?= $index; ?>][rtype]" required>
                  <option value="<?= $detail['type_id']; ?>"><?= $detail['rtype']; ?></option>
                  <!-- Options will be populated by JavaScript -->
               </select>
            </div>
            <div class="form-group col-md-2">
               <label for="numr_<?= $index; ?>">Number of Rooms</label>
               <input type="number" class="form-control numr" name="room[<?= $index; ?>][numr]" id="numr_<?= $index; ?>" value="<?= $detail['num_rooms']; ?>" min="1" max="5" required>
            </div>
            <div class="form-group col-md-2">
               <label for="price_<?= $index; ?>">Price</label>
               <input class="form-control price" type="text" name="room[<?= $index; ?>][price]" id="price_<?= $index; ?>" value="<?= $detail['sub_total']  * $num_days; ?>" readonly>
            </div>
            <div class="form-group col-md-1 align-self-end">
               <button type="button" class="btn btn-danger remove-room">Remove</button>
            </div>
         </div>
         <?php } ?>
      </div>
      <div class="form-row justify-content-center">
         <div class="form-group col-md-4 text-right">
            <button id="addRoom" type="button" class="btn btn-secondary">Add Room</button>
         </div>
      </div>

      <input type="hidden" name="reservation_id" id="reservation_id" value="<?php echo $r_id;?>">
      
      <div class="form-row justify-content-center">
         <div class="form-group col-md-4 text-center">
            <button class="btn btn-primary" type="submit" name="update">Update</button>
         </div>
      </div>
   </form>
</div>

<script src="https://js.stripe.com/v3/"></script>
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

  var form = document.getElementById('edit_reservation_form');
  form.addEventListener('submit', function(event) {
    event.preventDefault();

    var formData = new FormData(form);
    var actionUrl = form.getAttribute('action');
  
    fetch(actionUrl, {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'requires_payment') {
        // Redirect to index.php with client_secret and amount
        window.location.href = `index.php?payment_intent_id=${data.payment_intent_id}&client_secret=${data.client_secret}`;
      } else {
        console.error(data.message);
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
  });
});
</script>

<?php
require_once 'footer.php';
?>