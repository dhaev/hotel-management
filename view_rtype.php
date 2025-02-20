<?php
require_once 'config.php';
require_once 'header.php';
?>
 <div class="w3-row-padding w3-padding-16">
   <div class="w3-col">
    <select id='sortByStatus' class="roomavail">
    <option value="0">all</option>
    <option value="1">available</option>
    <option value="2">unavailable</option>
  </select>
  <p class="w3-large w3-right">
      <a href="add_rtype.php" class="w3-light-grey w3-button">
        <i class="fa fa-plus"></i>
      </a>
        <i class="fa fa-table w3-button" id='rtypegrid'></i>
        <i class="fa fa-list w3-button" id='rtypetable'></i>
      </p>
    </div>

 </div>
<div id='rtypeView'>
  <table id="example23" class="w3-table-all w3-hoverable w3-card-4 w3-small w3-centered">
    <thead>
      <tr class="w3-black">
        <th>#</th>
        <th>Room Type</th>
        <th>Price</th>
        <th>Description</th>
        <th>image</th>
        <th>Extra</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql="SELECT * FROM room_type ";
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
        <td><?php echo $row['RtypeID'];?></td>
        <td><?php echo $row['rtype'];?></td>
        <td><?php echo $row['price'];?></td>
        <td><?php echo $row['description'];?></td>
        <td><?php echo $row['image'];?></td>
        <td>
          <a href="edit_rtype.php?id=<?php echo $row['RtypeID'];?>" class="btn btn-info btn-lg">
            <span class="fa fa-edit">edit</span>
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
            targets: [ 4 ],
            orderData: [ 4, 0 ]
        } ]
    } );
} );
</script>

<?php
require_once 'footer.php';
?>


