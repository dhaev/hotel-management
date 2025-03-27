<?php
require_once 'config.php';
require_once 'header.php';
?>

<div>
  <table id="example23" class="w3-table-all w3-hoverable w3-card-4 w3-small w3-centered">
    <thead >
      <tr class="w3-black">
        <th>#</th>
        <th>Customer Name</th>
        <th>Room No</th>
        <th>Room type</th>
        <th>Time</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql = "SELECT 
                    reservations.id AS ReservationID,
                    CONCAT(customer.fname, ' ', customer.lname) AS CustomerName,
                    room.rnum AS RoomNumber,
                    room_type.rtype AS RoomType,
                    reservations.date_checked_out AS CheckoutTime
                FROM reservations
                JOIN customer ON reservations.user_id = customer.CustomerID
                JOIN reservation_details ON reservations.id = reservation_details.reservation_id
                JOIN room ON reservation_details.type_id = room.RtypeID
                JOIN room_type ON room.RtypeID = room_type.RtypeID
                WHERE reservations.checked_out = 1";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
             echo('view_booked.php ?  error= could not connect');
             exit();
        }
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        while($row=mysqli_fetch_assoc($result)){
      ?>
      
      <tr>
        <td><?php echo $row['ReservationID'];?></td>
        <td><?php echo $row['CustomerName'];?></td>      
        <td><?php echo $row['RoomNumber'];?></td>
        <td><?php echo $row['RoomType'];?></td>
        <td><?php echo $row['CheckoutTime'];?></td>
      </tr>
      <?php }
        mysqli_stmt_close($stmt);
      ?>
    </tbody>
  </table>  
</div>



<?php
require_once 'footer.php';
?>


