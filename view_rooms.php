 <?php
require_once 'config.php';
require_once 'header.php';
?>

<div id='roomView'>
<div class="w3-row-padding w3-padding-16">
   <div class="w3-col">
    <select id='sortByStatus' class="roomavail  w3-margin-right">
    <option value="0">all</option>
    <option value="1">available</option>
    <option value="2">unavailable</option>
  </select>


   <select id="availrtype" class="roomavail  w3-margin-right"><?php
   
    $sql="SELECT * FROM room_type WHERE rtype IN (SELECT rtype FROM room)";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            echo('index.php ?  error= could not connect');
           exit();
        }
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
       ?>
       <option value=""  >All</option>
       <?php
        while($row=mysqli_fetch_assoc($result)){
       ?>
       <option value='<?php echo $row['RtypeID']?>'><?php echo $row['rtype']?></option>
       <?php }
       ?></select>
        <input type="date" id='d' name="date" value="<?= date('Y-m-d')?>" class="c"> 
  <p class="w3-large w3-right">
      <a href="add_rnum.php" class="w3-light-grey w3-button">
        <i class="fa fa-plus"></i>
      </a>
        <i class="fa fa-table w3-button" id='roomgrid'></i>
        <i class="fa fa-list w3-button" id='roomtable'></i>
      </p>
    </div>

 </div>

  <table id="example23" class="w3-table-all w3-hoverable w3-card-4 w3-small w3-centered">
    <thead >
      <tr class="w3-black">
        <th>Room Number</th>
        <th>Room Type</th>
        <th>Extra</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql="SELECT room.RoomID,room.rnum,room_type.rtype FROM room,room_type WHERE room.RtypeID=room_type.RtypeID";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
             echo('index.php ?  error= could not connect');
             exit();
        }
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        while($row=mysqli_fetch_assoc($result)){
      ?>
      
      <tr>
        <td><?php echo $row['rnum'];?></td>
        <td><?php echo $row['rtype'];?></td>
        <td>
          <a href="#" class="btn btn-info btn-sm">
            <span class="glyphicon glyphicon-edit">edit</span>
          </a>
          <a href="inc/maintenance.php?id=<?=$row['RoomID'];?>" class="btn btn-info btn-sm">
            <span class="glyphicon glyphicon-minus-sign">maintenance</span>
          </a>
        </td>
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
            targets: [ 2 ],
            orderData: [ 2 , 0 ]
        } ]
    } );
} );
</script>

<?php
require_once 'footer.php';
?>


