<?php
require_once 'config.php';
require_once 'header.php';
?>
                 
   <div class="w3-content"><form class="form1" id="form1" action="inc/add_customer" method="post">
         <div class="w3-row-padding ">
            <div class="w3-col"><h2 class="w3-center w3-padding-large w3-margin-top w3-margin-bottom">Sign up</h2>
         </div>
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
                  <p><label class=" w3-padding-large ">Password</label></p><p><input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="password" id="pwd" name="pwd" placeholder="Password..." required>
                  </p>
               </div>
               <div class="w3-col">
                  <p><label class=" w3-padding-large "> Repeat Password</label></p><p><input class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="password" id="rpwd" name="rpwd" placeholder="Repeat Password..." required>
                  </p>
               </div>
      <div class="w3-col">
                  <p>
                  <button class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom" type="submit" id='add' name="add" >Add</button>
      </p></div>
         
         
     </form></div>

<?php
require_once 'footer.php';
?>