<?php
require_once 'config.php';
require_once 'header.php';
?>
      <script >
         $(function () {
            $('#img').prop('src','img/<?= $_SESSION['image'];?>');
            $('#fname').val('<?= $_SESSION['fname'];?>');
            $('#lname').val('<?= $_SESSION['lname'];?>');
            $('#Email').val('<?=  $_SESSION['email'];?>');
            $('#phone').val('<?= $_SESSION['phone'];?>');
            $('#address').val('<?= $_SESSION['address'];?>');
            $('#country').val('<?= $_SESSION['country'];?>');
            $('#city').val('<?= $_SESSION['city'];?>');
         });

      </script>




<div class="w3-content"> 
    <div class="w3-col w3-margin" >
                <h2 class="w3-center w3-padding-large w3-margin">EDIT CUSTOMER DETAILS</h2>
        
        
   </div>
    <form class="form1" id='profile' action="inc/update_profile" method="post" enctype="multipart/form-data">
          <div class="w3-center w3-auto w3-margin-bottom" style="max-width: 150px;" type="hidden"> 
            <p><img type="hidden" id='img' class="w3-circle w3-image w3-margin-bottom" style="height: 150px;"  src=""  ></p>
               <p><input id='file'  class="w3-input  w3-round-xxlarge w3-padding-large w3-margin-top w3-center w3-margin-bottom" type="file" onchange='showimg()'  name='file' ></p></div>           
       <div class="w3-row-padding w3-margin">
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
             <label class=" w3-padding-large ">Country</label></p><p></p><p><input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="text" id="country" name="country" placeholder="Country..." required>
          </p>
        </div>
      
               <div class="w3-half">
          <p><label class=" w3-padding-large ">City</label></p><p><input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="text" id="city" name="city" placeholder="City..." required>
          </p>
       </div>
      
      
               <div class="w3-col">
          <p>
          <button class="w3-input  w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="submit"  id="update" name="update" >Save</button>
     

</p></div>
         
         
     </form></div>


<?php
require_once 'footer.php';
?>