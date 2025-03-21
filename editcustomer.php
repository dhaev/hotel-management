<?php
require_once 'config.php';
require_once 'header.php';

$id=$_GET['id'];
$sql='SELECT * FROM customer WHERE CustomerID=?; ';
$stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
             echo('profile.php ?  error= could not connect');
             exit();
        }
        mysqli_stmt_bind_param($stmt,'i',$id);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        while($row=mysqli_fetch_assoc($result)){
            ?>
      <script >
         $(function () {
            $('#id').val('<?= $row['CustomerID'];?>');
            $('#fname').val('<?= $row['fname'];?>');
            $('#lname').val('<?= $row['lname'];?>');
            $('#Email').val('<?=  $row['email'];?>');
            $('#phone').val('<?= $row['phone'];?>');
            $('#address').val('<?= $row['address'];?>');
            $('#country').val('<?= $row['country'];?>');
            $('#city').val('<?= $row['city'];?>');
         });

      </script>
      <?php            
}

?>
<div class="w3-content"><form class="textForm" id="form1" action="inc/update_customer" method="post">
         <div class="w3-row-padding ">
            <div class="w3-col"><h2 class="w3-center w3-padding-large w3-margin-top w3-margin-bottom">Edit Customer Details</h2>
         </div>
      </div>
       <div class="w3-row-padding">
        <input type="hidden" id="id" name="cid"  readonly>
               <div class="w3-half">
                  <p>
                     <label class=" w3-padding-large ">Firstname</label></p><p>
                     <input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="text" id="fname" name="fname"  required>
                  </p>
               </div>
      
              <div class="w3-half">
                  <p>
                     <label class=" w3-padding-large ">Lastname</label></p><p>
                     <input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="text" id="lname" name="lname" required>
                  </p>
               </div>
      
               <div class="w3-half">
                  <p>
                     <label class=" w3-padding-large ">Email</label></p><p>
                     <input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="email" id="Email" name="email"  required>
                  </p>
               </div>
      
              <div class="w3-half">
                  <p>
                     <label class=" w3-padding-large ">Phone number</label></p><p>
                     <input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="telephone" id="phone" name="phone" >
                  </p>
               </div>
                  <div class="w3-col">
                  <p>
                     <label class=" w3-padding-large ">Address</label></p><p><input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="text" id="address" name="address" >
                  </p>
               </div>
      
               <div class="w3-half">
                  <p>
                     <label class=" w3-padding-large ">Country</label></p><p></p><p><input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="text" id="country" name="country" >
                  </p>
               </div>
      
              <div class="w3-half">
                  <p><label class=" w3-padding-large ">City</label></p><p><input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="text" id="city" name="city" >
                  </p>
               </div>
   
              
      <div class="w3-col">
                  <p>
                  <button class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="submit" id='add' name="update" >Save</button>
      </p></div>
         
         
     </form></div>


<?php
require_once 'footer.php';
?>