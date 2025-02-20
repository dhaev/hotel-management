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
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Room No</th>
        <th>Room type</th>
        <th>Time</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql="SELECT book_rnum.id,book_rnum.BookID,CONCAT(customer.fname,' ',customer.lname) AS customername,customer.email,customer.phone,CONCAT(customer.address,',',customer.city,',',customer.country) AS address,room.rnum,room.RoomID,room_type.rtype,check_out.time  FROM `book`,`customer`,`room`,`room_type`,`check_out`,`book_rnum` WHERE (book_rnum.BookID=book.BookID AND book.customerID=customer.CustomerID AND book_rnum.RoomID=room.RoomID  AND room.RtypeID=room_type.RtypeID AND book_rnum.id=check_out.ord AND book_rnum.status=2)";
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
        <td><?php echo $row['BookID'];?></td>
        <td><?php echo $row['customername'];?></td>
        <td><?php echo $row['email'];?></td>
        <td><?php echo $row['phone'];?></td>
        <td><?php echo $row['address'];?></td>
        <td><?php echo $row['rnum'];?></td>
        <td><?php echo $row['rtype'];?></td>
        <td><?php echo $row['time'];?></td>
      </tr>
      <?php }
        mysqli_stmt_close($stmt);
      ?>
    </tbody>
  </table>  
</div>

<script>  
  $(document).ready(function() {
    $('#example23').DataTable( {
        columnDefs: [ {
            targets: [ 1 ],
            orderData: [ 0, 1 ]
        }, {
            targets: [ 1 ],
            orderData: [ 1, 0 ]
        }, {
            targets: [ 7 ],
            orderData: [ 7, 0 ]
        } ]
    } );
} );
</script>

<?php
require_once 'footer.php';
?>


