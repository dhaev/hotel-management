<?php
include'config.php';
require_once 'inc/functions.php';

$RoomID=$_GET['rid'];
 
$RtypeID=$_GET['rtid'];
$r=$_GET['cin'];
$s=$_GET['cout'];
?>
                     
     <select class="w3-select w3-round-xxlarge w3-padding-large" name="option" type="text" name="numr" id="numr" required>                 
    
      <?php      $b=0;
            $bs=1;
            $m=1;

           $t = geteditrnum($conn,$RtypeID,$b,$bs,$r,$s,$m,$RoomID);
           $op=count($t);
           

if ($op<1) {
   ?>
   <option> No room available </option>
<?php
} else {
    foreach ($t as $room) {
            ?>
             <option value="<?= $room['RoomID']?>"><?= $room['rnum']?></option>
             <?php
           }

}
        
?>     
</select>
