<?php
require_once 'config.php';
require_once 'header.php';
?>

<div>
  <table  id="example23" class="w3-table-all w3-hoverable w3-card-4 w3-small w3-centered">
    <thead class="w3-light-grey">
      <tr>
        <th>#</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Country</th>
        <th>City</th>
        <th>Job</th>
        <th>Extra</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql="SELECT * FROM employees ";
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
        <td><?php echo $row['id'];?></td>
        <td><?php echo $row['fname'];?></td>
        <td><?php echo $row['lname'];?></td>
        <td><?php echo $row['email'];?></td>
        <td><?php echo $row['phone'];?></td>
        <td><?php echo $row['address'];?></td>
        <td><?php echo $row['country'];?></td>
        <td><?php echo $row['city'];?></td>
        <td><?php echo $row['job'];?></td>
        <td>
          <a href="#" class="btn btn-info btn-lg">
            <span class="glyphicon glyphicon-info-sign"></span>
          </a>        
          <a href="#" class="btn btn-info btn-lg">
            <span class="glyphicon glyphicon-ok-sign"></span>
          </a>
          <a href="#" class="btn btn-info btn-lg">
            <span class="glyphicon glyphicon-edit"></span>
          </a>
          <a href="#">
            <span class="glyphicon glyphicon-minus-sign"></span>
          </a>
          <a href="#">
            <span class="glyphicon glyphicon-remove-sign"></span>
          </a>
          <a href="#">
            <span class="glyphicon glyphicon-plus-sign"></span>
          </a>
          <a href="#">
            <span class="glyphicon glyphicon-check"></span>
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
            targets: [ 7 ],
            orderData: [ 7, 0 ]
        } ]
    } );
} );
</script>

<?php
require_once 'footer.php';
?>