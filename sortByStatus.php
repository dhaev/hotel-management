   <?php
   require_once 'config.php';
   
   require_once 'inc/functions.php';

  $avail=intval($_GET['avail']);
  $availrtype=intval($_GET['availrtype']);
  $d=date_create($_GET['dateavail']);
          date_time_set($d,14,00);
          $date=date_format($d,"Y-m-d H:i:s");
  $b=0;
  $s=1;
  ?>
<div class="w3-container">
  
 <?php
 if ( empty($avail)&&  empty($availrtype)) {
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
      
  }
  elseif (empty($availrtype)) {
   // code...

 
      if ($avail===1 ) {
        $sql="SELECT room.RoomID,room.rnum,room_type.rtype,room.status FROM room,room_type WHERE room.RtypeID=room_type.RtypeID AND room.RoomID NOT IN ( SELECT book_rnum.RoomID FROM `book_rnum`,`book` WHERE (book_rnum.BookID=book.BookID) AND (book_rnum.status=? OR book_rnum.status=?) AND( ? BETWEEN book.check_in AND book.check_out))";
      }elseif ($avail===2 ) {
        $sql="SELECT room.RoomID,room.rnum,room_type.rtype,room.status FROM room,room_type WHERE room.RtypeID=room_type.RtypeID AND room.RoomID IN ( SELECT book_rnum.RoomID FROM `book_rnum`,`book` WHERE (book_rnum.BookID=book.BookID) AND (book_rnum.status=? OR book_rnum.status=?) AND( ? BETWEEN book.check_in AND book.check_out))";
      }else{
        echo "avail not set";
      }
      
        $stmt=mysqli_stmt_init($conn); 
        if (!mysqli_stmt_prepare($stmt,$sql)){ 
    echo('index.php ?  error=stmt insert new room failed'); 
    exit();
     }
    mysqli_stmt_bind_param($stmt,'iis',$b,$s,$date);
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
  } elseif ( empty($avail)) {
          $sql="SELECT room.RoomID,room.rnum,room_type.rtype,room.status FROM room,room_type WHERE room.RtypeID=room_type.RtypeID AND room.RtypeID=? AND room.RoomID NOT IN ( SELECT book_rnum.RoomID FROM `book_rnum`,`book` WHERE (book_rnum.BookID=book.BookID) AND ( ? BETWEEN book.check_in AND book.check_out))";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
             echo('index.php ?  error= could not connect');
             exit();
        }
        $stmt=mysqli_stmt_init($conn); 
        if (!mysqli_stmt_prepare($stmt,$sql)){ 
    echo('index.php ?  error=stmt insert new room failed'); 
    exit();
     }
    mysqli_stmt_bind_param($stmt,'is',$availrtype,$date);
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
      
  } else {
   if ($avail===1 ) {
        $sql="SELECT room.RoomID,room.rnum,room_type.rtype,room.status FROM room,room_type WHERE room.RtypeID=room_type.RtypeID AND room.RtypeID=? AND room.RoomID NOT IN ( SELECT book_rnum.RoomID FROM `book_rnum`,`book` WHERE (book_rnum.BookID=book.BookID) AND (book_rnum.status=? OR book_rnum.status=?) AND( ? BETWEEN book.check_in AND book.check_out))";
      }elseif ($avail===2 ) {
        $sql="SELECT room.RoomID,room.rnum,room_type.rtype,room.status FROM room,room_type WHERE room.RtypeID=room_type.RtypeID AND room.RtypeID=? AND room.RoomID IN ( SELECT book_rnum.RoomID FROM `book_rnum`,`book` WHERE (book_rnum.BookID=book.BookID) AND (book_rnum.status=? OR book_rnum.status=?) AND( ? BETWEEN book.check_in AND book.check_out))";
      }else{
        echo "avail not set";
      }
      
        $stmt=mysqli_stmt_init($conn); 
        if (!mysqli_stmt_prepare($stmt,$sql)){ 
    echo('index.php ?  error=stmt insert new room failed'); 
    exit();
     }
    mysqli_stmt_bind_param($stmt,'iiis',$availrtype,$b,$s,$date);
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
 }?>
</div>

<script >
       $(function(){
        $('.c').change(function () {
          
        var x=$('#c').val();
  

  $('.a').val(x);

  
  $('.b').val(x);
});
      });
              </script>
<?
require_once 'footer.php';
?>