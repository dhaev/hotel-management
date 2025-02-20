   <?php
   require_once 'config.php';
   require_once 'header.php';

   
  ?>

   <?php 

   if ( isset($_SESSION['email'] )&&($_SESSION['email'] !=='groot@gmail.com')) {
      ?>
      <script >
         $(function () {
            $('#fname').val('<?= $_SESSION['fname'];?>');
            $('#lname').val('<?= $_SESSION['lname'];?>');
            $('#email').val('<?=  $_SESSION['email'];?>');
            $('#phone').val('<?= $_SESSION['phone'];?>');
            $('#address').val('<?= $_SESSION['address'];?>');
            $('#country').val('<?= $_SESSION['country'];?>');
            $('#city').val('<?= $_SESSION['city'];?>');
         });

      </script>
      <?php  }  ?>
              <!--  <input class="w3-input w3-round-xxlarge w3-padding-large date"  id="test" > -->

   <div class="w3-content"><form id="form1" action="inc/book.php" method="post">
            
         <div class="w3-row-padding ">
            <div class="w3-col"><h2 class="w3-center w3-padding-large w3-margin-top w3-margin-bottom">Book Room</h2>
         </div>
      </div>
         <div class="w3-row-padding w3-padding-top">
            <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">Check in</label></p><p>
                  <input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom book" type="date" name="checkin" id="cin" value="<?php echo date('Y-m-d')?>" required>
               </p>
            </div>
            <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">Check out</label></p><p>
                  <input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom book" type="date" name="checkout" id="cout" required>
               </p>
            </div>
         </div>
          
         <div id="room" class="w3-row-padding w3-border-bottom w3-border-dark-grey w3-margin-top w3-margin-bottom">
            <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">Room Type</label></p><p>
                  <select class="w3-select w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom rtype" type="text" id="rtype_0" name="room[0][rtype]"  placeholder=' Select Room type' required>
                    
   
                  </select>
               </p>
            </div>
            <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">No. of Rooms</label></p><p>
                  <select class="w3-select w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom"  type="text"  name="room[0][numr]" id="numr_0" required></select>
               </p> 
            </div>
            <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">Price</label></p><p>
                  <input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom price"   type="text"  name="room[0][price]" id="price_0"  placeholder="price..." value="0" >
               </p>
            </div>
            </div> 
         
         <div id="newRow"></div>
         <input type="text" value="0" id="indx">
          <div class="w3-row-padding">
         <div class="w3-col"><p><button id="addRow" type="button" class="w3-light-grey w3-button  w3-margin-top w3-margin-bottom"><i class="fa fa-plus"></i>+</button> </p></div>
         </div>
          <div class="w3-row-padding">
            <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">Firstname</label></p><p>
                  <input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="text" id="fname" name="fname" placeholder="Firstname..." value='grgrgg' required>
               </p>
            </div>
   
           <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">Lastname</label></p><p>
                  <input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="text" id="lname" name="lname" placeholder="Lastname..." value='grgrgg' required>
               </p>
            </div>
   
            <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">Email</label></p><p>
                  <input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="email" id="email" name="email" placeholder="Email..."value='grgrgglogo@bron.coms' required>
               </p>
            </div>
   
           <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">Phone number</label></p><p>
                  <input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="telephone" id="phone" name="phone" placeholder="Phone number..." value='9876556789' required>
               </p>
            </div>
               <div class="w3-col">
               <p>
                  <label class=" w3-padding-large ">Address</label></p><p><input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="text" id="address" name="address" placeholder="Address..." value='grgrgg' required>
               </p>
            </div>
   
            <div class="w3-half">
               <p>
                  <label class=" w3-padding-large ">Country</label></p><p></p><p><input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="text" id="country" name="country" placeholder="Country..." value='grgrgg' required>
               </p>
            </div>
   
           <div class="w3-half">
               <p><label class=" w3-padding-large ">City</label></p><p><input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="text" id="city" name="city" placeholder="City..." value='grgrgg' required>
               </p>
            </div>
   <div class="w3-col">
               <p>
               <button class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="submit" name="book" >Book</button>
   </p></div>
            </div>   
             
               
                     
      </form></div>
   <?php
   if (isset($_GET['type'])) {
       
    ?>
<script>
   let oi= "<?php echo $_GET['type'];?>";
   grtype(oi);
   </script>
<?php
 }else{
   ?>
   <script>
   grtype();
   </script>
   <?php
 }
require_once 'footer.php';
?>