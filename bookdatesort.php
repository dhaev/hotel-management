<?php
require_once 'config.php';

if (isset($_GET['b']) && isset($_GET['c'])) {

  $r = $_GET['b'];
  $s = $_GET['c'];
  ?>

   <table id="example23" >
      <thead>
        <tr>
          <th>S/N</th>
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
        if (!empty($r)&& empty($s)) {
        $sql="SELECT book_rnum.BookID,book.check_in,book.check_out,CONCAT(customer.fname,' ',customer.lname) AS customerName,customer.email,customer.phone,CONCAT(customer.address,',',customer.country,',',customer.city) AS address,room.rnum,room_type.rtype  FROM `book`,`customer`,`room`,`room_type` WHERE (book.customerID=customer.CustomerID AND book_rnum.RoomID=room.RoomID  AND room.RtypeID=room_type.RtypeID)AND (book.check_in = '$r')AND(book_rnum.status=0)";
      }elseif (empty($r)&& !empty($s)) {
        $sql="SELECT book_rnum.BookID,book.check_in,book.check_out,CONCAT(customer.fname,' ',customer.lname) AS customerName,customer.email,customer.phone,CONCAT(customer.address,',',customer.country,',',customer.city) AS address,room.rnum,room_type.rtype  FROM `book`,`customer`,`room`,`room_type` WHERE (book.customerID=customer.CustomerID AND book_rnum.RoomID=room.RoomID  AND room.RtypeID=room_type.RtypeID)AND (book.check_in = '$s')AND(book_rnum.status=0)";
      }else{
        $sql="SELECT book_rnum.BookID,book.check_in,book.check_out,CONCAT(customer.fname,' ',customer.lname) AS customerName,customer.email,customer.phone,CONCAT(customer.address,',',customer.country,',',customer.city) AS address,room.rnum,room_type.rtype  FROM `book`,`customer`,`room`,`room_type` WHERE (book.customerID=customer.CustomerID AND book_rnum.RoomID=room.RoomID  AND room.RtypeID=room_type.RtypeID)AND (book.check_in BETWEEN '$r' AND '$s')AND(book_rnum.status=0)";
      }

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
                   
            <a href="inc/checkin.php?id=<?=$row['BookID'];?>" class="btn btn-info btn-sm">
              <span class="glyphicon glyphicon-ok-sign">checkin</span>
            </a>
            <a href="editbook.php?id=<?=$row['BookID'];?>" class="btn btn-info btn-sm">
              <span class="glyphicon glyphicon-edit">edit</span>
            </a>
            
            <a href="inc/cancel.php?id=<?=$row['BookID'];?>" class="btn btn-info btn-sm">
              <span class="glyphicon glyphicon-remove-sign"> Cancel</span>
            </a>
           
        </tr>
      <?php }?>
      </tbody>
    </table>
<?php }else {  echo('date not set');}
?> 