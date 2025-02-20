<?php
require_once 'config.php';
require_once 'header.php';
require_once 'inc/functions.php';
?>

  <div class="bdate">
         <input type="date" name="checkin" id="from" value="<?php echo date("Y-m-d")?>" onchange="booksort()">
         <input type="date" name="checkout" id="to" onchange="sortCheckoutDate()" >
      </div>
  <table id="example23" class="w3-table-all w3-hoverable w3-card-4 w3-small w3-centered" >
    <thead>
      <tr  class="w3-black">
        <th>#</th>
        <th>Customer Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Room No</th>
        <th>Room type</th>
        <th>Check in</th>
        <th>Check out</th>
        <th>Extra</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql="SELECT book.customerID,book_rnum.id,book_rnum.BookID,book_rnum.RoomID,room.RtypeID,book_rnum.price,book.check_in,book.check_out,CONCAT(customer.fname,' ',customer.lname) AS customerName,customer.email,customer.phone,CONCAT(customer.address,',',customer.city,',',customer.country) AS address,room.rnum,room_type.rtype  FROM `book`,`customer`,`room`,`room_type`,`book_rnum` WHERE (book_rnum.BookID=book.BookID AND book.customerID=customer.CustomerID AND book_rnum.RoomID=room.RoomID  AND room.RtypeID=room_type.RtypeID AND book_rnum.status=0) ORDER BY book_rnum.BookID ASC";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            echo('could not connect');
             exit();
        }
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        while($row=mysqli_fetch_assoc($result)){
      ?>
      
      <tr>
        <td><?php echo $row['BookID'];?></td>
        <td><?php echo $row['customerName'];?></td>
        <td><?php echo $row['email'];?></td>
        <td><?php echo $row['phone'];?></td>
        <td><?php echo $row['address'];?></td>
        <td><?php echo $row['rnum'];?></td>
        <td><?php echo $row['rtype'];?></td>
        <td><?php echo $row['check_in'];?></td>
        <td><?php echo $row['check_out'];?></td>
        <td>
                 
          <a href="inc/checkin.php?id=<?=$row['id'];?>" class="btn btn-info btn-sm">
            <span class="glyphicon glyphicon-ok-sign">checkin</span>
          </a>
          <a href="editbook.php?customerID=<?=$row['customerID'];?>&id=<?=$row['id'];?>&BookID=<?=$row['BookID'];?>&RoomID=<?=$row['RoomID'];?>&RtypeID=<?=$row['RtypeID'];?>&customerName=<?=$row['customerName'];?>&email=<?=$row['email'];?>&Phone=<?=$row['phone'];?>&address=<?=$row['address'];?>&rnum=<?=$row['rnum'];?>&rtype=<?=$row['rtype'];?>&price=<?=$row['price'];?>&check_in=<?=$row['check_in'];?>&check_out=<?=$row['check_out'];?>" class="btn btn-info btn-sm">
            <span class="glyphicon glyphicon-edit">edit</span>
          </a>
          
          <a href="inc/cancel.php?id=<?=$row['id'];?>" class="btn btn-info btn-sm">
            <span class="glyphicon glyphicon-remove-sign"> Cancel</span>
          </a>
         
      </tr>
    <?php }?>
    </tbody>
  </table>  
</div>

<script>  
  $(document).ready(function() {
   
} );
</script>

<?php
require_once 'footer.php';
?>