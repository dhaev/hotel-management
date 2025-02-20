<?php
include'config.php';
require_once 'inc/functions.php';
?>
    <option value=''disabled> select</option>
    
   <?php  /* recheck SELECT rtype FROM room_type WHERE EXISTS (SELECT rtype FROM add_room )*/
     $sql="SELECT * FROM room_type WHERE rtype IN (SELECT rtype FROM room)";
     $stmt=mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt,$sql)){
         echo('index.php ?  error= could not connect');
        exit();
     }
     mysqli_stmt_execute($stmt);
     $result=mysqli_stmt_get_result($stmt);
   
     while($row=mysqli_fetch_assoc($result)){
    ?>
    <option value='<?php echo $row['RtypeID']?>'><?php echo $row['rtype']?></option>
    <?php }
    ?>
    