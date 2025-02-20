   <?php
   require_once 'config.php';
   require_once 'header.php';
   if (isset($_GET['r'])) {
      echo 'yup';
   }

//print_r($_GET);
//echo count($_GET);

   $customerID=$_GET['customerID'];
   $id=$_GET['id'];
   $RoomID=$_GET['RoomID'];
   $BookID=$_GET['BookID'];
   $RtypeID=$_GET['RtypeID'];
   $customername=explode(' ',$_GET['customerName']);
   $fname=$customername[0];
   $lname=$customername[1];
   $email=$_GET['email'];
   $phone=$_GET['Phone'];
   $fulladdress=explode(',',$_GET['address']);
   $address=$fulladdress[0];   
   $city=$fulladdress[1];   
   $country=$fulladdress[2];   
   $rnum=$_GET['rnum'];
   $rtype=$_GET['rtype'];
   $price=$_GET['price'];
   $check_in=date_create($_GET['check_in']);
   $checkin=date_format($check_in,'Y-m-d');
   $check_out=date_create($_GET['check_out']);
   $checkout=date_format($check_out,'Y-m-d');

   ?>
      <script >
         $(function () {

            let checkin= "<?php echo $checkin ?>";
            let checkout= "<?php echo $checkout ?>";
            let roomid= "<?php echo $RoomID ?>";
            let rtypeid= "<?php echo $RtypeID ?>";
            let rtype= "<?php echo $rtype ?>";
            let rnum= "<?php echo $rnum;?>";
            $('#cid').val('<?= $customerID;?>');
            $('#bid').val('<?= $BookID;?>');
            $('#id').val('<?= $id;?>');
            $('#rid').val(roomid);
            $('#cin').val(checkin);
            $('#cout').val(checkout);
            $('#price_0').val('<?= $price;?>');
            $('#fname').val('<?= $fname;?>');
            $('#lname').val('<?= $lname;?>');
            $('#Email').val('<?=  $email;?>');
            $('#phone').val('<?= $phone;?>');
            $('#address').val('<?= $address;?>');
            $('#country').val('<?= $country;?>');
            $('#city').val('<?= $city;?>');
            grtype(rtypeid);
            grnum(checkin,checkout,roomid,rtypeid);
         });

      </script>
      <?php    

   ?>
   <div class="w3-content"><form id="form1" action="inc/update_book.php" method="post">
            
         <div class="w3-row-padding ">
            <div class="w3-col"><h2 class="w3-center w3-padding-large w3-margin-top w3-margin-bottom">Edit Book</h2>
         </div>
      </div>
       <div class="w3-col">
               <p><input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="hidden" name="cid" id="cid" required>
               <p><input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="hidden" name="bid" id="bid" required>
               <p><input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="hidden" name="roomid" id="rid" required>
               <p><input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="hidden" name="id" id="id" required>
               </p>
            </div>
         <div class="w3-row-padding w3-padding-top">
            <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">Check in</label></p><p>
                  <input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom book" type="date" name="checkin" id="cin"  required>
               </p>
            </div>
            <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">Check out</label></p><p>
                  <input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom book" type="date" name="checkout" id="cout" required>
               </p>
            </div>
         </div>
          
         <div class="w3-row-padding w3-border-bottom w3-border-dark-grey w3-margin-top w3-margin-bottom">
            <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">Room Type</label></p><p>
                  <select class="w3-select w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom book editrtype" type="text" id="rtype_0" name="rtype"  required></select>
               </p>
            </div>
            <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">No. of Rooms</label></p><p>
                  <select class="w3-select w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom"  type="text"  name="numr" id="numr_0" required>                 
                  </select>
               </p> 
            </div>
            <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">Price</label></p><p>
                  <input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom"   type="text"  name="price" id="price_0"  placeholder="price..." readonly>
               </p>
            </div>
            </div> 

            <button class="dropdown-btn w3-margin-top w3-margin-bottom" type="button" >view all</button>
         
        
          <div class="w3-row-padding w3-hide">
            <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">Firstname</label></p><p>
                  <input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="text" id="fname" name="fname" placeholder="Firstname..." required>
               </p>
            </div>
   
           <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">Lastname</label></p><p>
                  <input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="text" id="lname" name="lname" placeholder="Lastname..." required>
               </p>
            </div>
   
            <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">Email</label></p><p>
                  <input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="email" id="Email" name="email" placeholder="Email..." required>
               </p>
            </div>
   
           <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">Phone number</label></p><p>
                  <input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="telephone" id="phone" name="phone" placeholder="Phone number..." required>
               </p>
            </div>
               <div class="w3-col">
               <p>
                  <label class=" w3-padding-large ">Address</label></p><p><input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="text" id="address" name="address" placeholder="Address..." required>
               </p>
            </div>
   
            <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">Country</label></p><p></p><p><input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="text" id="country" name="country" placeholder="Country..."  required>
               </p>
            </div>
   
           <div class="w3-half">
               <p><label class=" w3-padding-large ">City</label></p><p><input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="text" id="city" name="city" placeholder="City..." required>
               </p>
            </div>
         </div>
         <div class="w3-row-padding">
   <div class="w3-half">
               <p>
               <button class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom w3-red" type="button" name="book" >cancel</button>
   </p></div>
   <div class="w3-half">
               <p>
               <button class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom w3-blue" type="submit" name="book" >Save</button>
   </p></div>
            </div>   
             
               
                     
      </form></div>

<?php
require_once 'footer.php';
?>