   <?php
   require_once 'config.php';
   require_once 'inc/functions.php';

    $t = SelectAllRtype($conn) ; 
   ?>
 
 <div class="w3-row-padding w3-padding-16" id='rtypeView'>
 <?php
      foreach ($t as $array ) { 
      ?> 
        <div class="w3-third w3-margin-bottom">
      <img src="img/rtype/<?= $array['image'];?>" alt="Norway" style="width:100%;height:100%;">
      <div class="w3-container w3-white">
        <h3><?= $array['rtype'];?> Room</h3>
        <h6 class="w3-opacity">From <?= $array['price'];?></h6>
        <p>Single bed</p>
        <p>15m<sup>2</sup></p>
        <p class="w3-large"><i class="fa fa-bath"></i> <i class="fa fa-phone"></i><i class="fa fa-wifi"></i></p>
        <a href="book.php?type=<?php echo $array['RtypeID'];?>"><button class="w3-button w3-block w3-black w3-margin-bottom croom">Choose Room</button></a>
        <a href="edit_rtype.php?id=<?php echo $array['RtypeID'];?>" class="w3-button w3-block w3-cyan w3-margin-bottom">
            <span class="fa fa-edit">edit</span>
          </a>        
      </div>
    </div> 
 
       <?php
   }
   ?>
   </div>
   