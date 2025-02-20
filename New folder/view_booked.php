<?php
require_once 'config.php';
require_once 'header.php';
?>

      
<!--form>

  <input type="date" id="cin" value="<?php
  /*echo date("Y-m-d")*/?>" onchange="checkinDate()"   placeholder="Checkin...">
        <input type="date" id="cout" onchange="checkoutDate();" placeholder="Checkout...">
        <button onclick="show()" name="dat">add</button>

  <select  onchange="showUser(this.value)">
    <option value="">Select a person:</option>
    <option value="Single">Single</option>
    <option value="Twin">Twin</option>
    <option value="Suite">Suite</option>
    

    </select>

    <div id="rnum"><b>Person info will be listed here...</b></div>
  </form>



  <p id="show">changes to show</p><br>
  <p id="show1">changes to show</p><br>
  <p id="show2">changes to show</p><br>
  <p id="show3">changes to show</p><br>
  <p id="show4">changes to show</p><br>
  <p id="show5">changes to show</p><br>
  <p id="show7">changes to show</p><br>
  <p id="show8">changes to show</p><br>
  <p id="show9">changes to show</p><br>



  <h2>JavaScript Validation</h2>

  <p>Please input a number between 1 and 10:</p>

  <input id="numb">

  <button type="button" onclick="myFunction()">Submit</button>

  <p id="demo"></p-->
<div class="col-md-8">
    <div class="input-group input-daterange">
      <input type="text" class="form-control date-range-filter" placeholder="Date Start" data-date-format="mm-dd-yyyy" id="min" />
      <span class="input-group-addon">to</span>
      <input type="text" class="form-control date-range-filter" placeholder="Date End" data-date-format="mm-dd-yyyy" id="max"/>
    </div>
  </div>

<div>

  <table id="example23" class="display">
    <thead>
      <tr>
        <th>S/N</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Country</th>
        <th>City</th>
        <th>Room No</th>
        <th>Room type</th>
        <th>Check in</th>
        <th>Check out</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql="SELECT * FROM book ";
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
        <td><?php echo $row['rnum'];?></td>
        <td><?php echo $row['rtype'];?></td>
        <td><?php echo $row['check_in'];?></td>
        <td><?php echo $row['check_out'];?></td>
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
<?php
require_once 'footer.php';
?>


