<div class="w3-content">
   <form id="form1" action="inc/book.php" method="post">
      <div class="w3-row-padding">
         <div class="w3-col">
            <h2 class="w3-center  w3-margin-top w3-margin-bottom">Book Room</h2>
         </div>
      </div>
      <div class="w3-row-padding w3-padding-top">
         <div class="w3-half">
            <p>
               <label class="">Check in</label>
            </p>
            <p>
               <input class=" book" type="date" name="checkin" id="cin" value="<?php echo date('Y-m-d')?>" required>
            </p>
         </div>
         <div class="w3-half">
            <p>
               <label class="">Check out</label>
            </p>
            <p>
               <input class=" book" type="date" name="checkout" id="cout" required>
            </p>
         </div>
      </div>
      <div id="room" class="">
         <div class="w3-half">
            <p>
               <label class="">Room Type</label>
            </p>
            <p>
               <select class="w3-select rtype" type="text" id="rtype_0" name="room[0][rtype]" placeholder='Select Room type' required>
               </select>
            </p>
         </div>
         <div class="w3-half">
            <p>
               <label class="">No. of Rooms</label>
            </p>
            <p>
               <select class="w3-select" type="text" name="room[0][numr]" id="numr_0" required></select>
            </p>
         </div>
         <div class="w3-half">
            <p>
               <label class="">Price</label>
            </p>
            <p>
               <input class=" price" type="text" name="room[0][price]" id="price_0" placeholder="price..." value="0">
            </p>
         </div>
      </div>
      <div id="newRow"></div>
      <input type="text" value="0" id="indx">
      <div class="w3-row-padding">
         <div class="w3-col">
            <p>
               <button id="addRow" type="button" class="w3-light-grey w3-button w3-margin-top w3-margin-bottom">+</button>
            </p>
         </div>
      </div>
      <div class="w3-row-padding">
         <div class="w3-half">
            <p>
               <label class="">Firstname</label>
            </p>
            <p>
               <input class="" type="text" id="fname" name="fname" placeholder="Firstname..." value='grgrgg' required>
            </p>
         </div>
         <div class="w3-half">
            <p>
               <label class="">Lastname</label>
            </p>
            <p>
               <input class="" type="text" id="lname" name="lname" placeholder="Lastname..." value='grgrgg' required>
            </p>
         </div>
         <div class="w3-half">
            <p>
               <label class="">Email</label>
            </p>
            <p>
               <input class="" type="email" id="email" name="email" placeholder="Email..." value='grgrgglogo@bron.coms' required>
            </p>
         </div>
         <div class="w3-half">
            <p>
               <label class="">Phone number</label>
            </p>
            <p>
               <input class="" type="telephone" id="phone" name="phone" placeholder="Phone number..." value='9876556789' required>
            </p>
         </div>
         <div class="w3-col">
            <p>
               <button class="" type="submit" name="book">Book</button>
            </p>
         </div>
      </div>
   </form>
</div>

