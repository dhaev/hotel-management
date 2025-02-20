<?php
include'config.php';
require_once 'inc/functions.php';

$RtypeID=$_POST['q']; 
$nr=$_POST['r'];
$ns =$_POST['s'];
$_POST['rid'] ??= "";
$RoomID=$_POST['rid'];
// $RoomID=(gettype($_POST['rid'])==='NULL') ? '': $_POST['rid'];
echo'isset : '.isset($_POST['rid']);
echo'<br>';

echo'inarray : '.in_array("0",$_POST);
echo'<br>';

echo'type : '.gettype($_POST['rid']);
echo'<br>';

echo'POST : ';
print_r($_POST);
echo'<br>';
echo'GET : ';
print_r($_GET);
echo'<br>';
echo'REQUEST : ';
print_r($_REQUEST);
echo'<br>';
echo'SERVER : ';
print_r($_SERVER);
$b=0;
            $bs=1;
            $m=1;
  $t = geteditrnum($conn,$RtypeID,$b,$bs,$nr,$ns,$m,$RoomID); 
  print_r($t);         
 ?>        
<select class="w3-select w3-round-xxlarge w3-padding-large" name="option" type="text" name="numr" id="numr" required>
<?php                      
            

           // $t = getrnum($conn,$RtypeID,$b,$bs,$nr,$ns,$m);
           
           // getrnum($conn,$RtypeID,$b,$bs,$r,$s,$m)

           $op=count($t);           

if ($op<1) {
   ?>
   <option> No room available </option>
<?php
exit();
}
if ($RoomID === '') {
   for ($i=1; $i <= count($t) ; ) { 
    ?>
           <option value="<?=$i?>"> <?= $i?></option>

    <?php     $i++;   }
} else {
     foreach ($t as $room) {
            ?>
             <option value="<?= $room['RoomID']?>"><?= $room['rnum']?></option>
             <?php
           }

    
}

           
        
echo'</select>';
