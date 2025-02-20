 <?php
   require_once 'config.php';
   require_once 'inc/functions.php';
     ?>
<script type="" src="jQuery.js"></script>
<script type="" src="function.js"></script>
<div id='roomView'>
  <div class="w3-row-padding w3-padding-16">
   <div class="w3-col">
    <select id='sortByStatus' class="roomavail  w3-margin-right">
    <option value="0">all</option>
    <option value="1">available</option>
    <option value="2">unavailable</option>
  </select>


   <select id="availrtype" class="roomavail  w3-margin-right"><?php
   
    $sql="SELECT * FROM room_type WHERE rtype IN (SELECT rtype FROM room)";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            echo('index.php ?  error= could not connect');
           exit();
        }
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
       ?>
       <option value=""  >All</option>
       <?php
        while($row=mysqli_fetch_assoc($result)){
       ?>
       <option value='<?php echo $row['RtypeID']?>'><?php echo $row['rtype']?></option>
       <?php }
       ?></select>
        <input type="date" id='d' name="date" class="roomavail"> value="<?= date('Y-m-d')?>" class="c"> 
</div>
</div>

  <div class="w3-row-padding w3-padding-16" id='fm'>
  
 
<?php
        $sql="SELECT room.RoomID,room.rnum,room_type.rtype,room.status FROM room,room_type WHERE room.RtypeID=room_type.RtypeID";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
             echo('index.php ?  error= could not connect');
             exit();
        }
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        while($row=mysqli_fetch_assoc($result)){
      ?>
      <button type='button'  id='<?php echo $row['RoomID'];?>' class="w3-button w3-margin"><?php echo $row['rnum'];?>
              <?php //echo $row['rtype'];?><input class="cbox" type="checkbox" name="<?php echo $row['RoomID'];?>" ></button>
              <script >
                  $( '#<?php echo $row['RoomID'];?>').contextmenu(function() {
                    alert( "Handler for .contextmenu() called." );
                  });
                  var w=<?php echo $row['status'];?>;
                  
                  if (w === 0) {
                    $('#<?php echo $row['RoomID'];?>').addClass('w3-green');
                  }else if (w === 1) {
                    $('#<?php echo $row['RoomID'];?>').addClass('w3-red');
                  }else {
                    $('#<?php echo $row['RoomID'];?>').addClass('w3-cyan');
                  }

              </script>
      <?php }
        mysqli_stmt_close($stmt);
      ?>
</div>
</div>
