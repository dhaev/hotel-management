<?php
require_once 'config.php';
require_once 'header.php';
?>
              
              <form class="form1" id="form1" action="inc/add_room" method="post">
   <h2>Add Room</h2>
   <div>
      <select id="rtype" name="rtype" required>
         <option value="">Select Room Type</option>
         <?php
         $sql = "SELECT RtypeID, rtype FROM room_type";
         $stmt = mysqli_stmt_init($conn);
         if (!mysqli_stmt_prepare($stmt, $sql)) {
             echo('index.php?error=could not connect');
             exit();
         }
         mysqli_stmt_execute($stmt);
         $result = mysqli_stmt_get_result($stmt);
         while ($row = mysqli_fetch_assoc($result)) {
         ?>
         <option value="<?php echo $row['RtypeID']; ?>"><?php echo $row['rtype']; ?></option>
         <?php }
         ?>
      </select>
      <input type="text" id='rnum' name="rnum" onkeyup='check(this.value);' onchange='check(this.value);' placeholder="Room number..." required>
      <p type="text" id='ch'></p>
   </div>
   <button type="submit" name="add">Add</button>
</form>

<script>
   // function check(rnum) {
   //    $(document).ready(function(){
            
   //          $.ajax({
   //             url:'arc.php',
   //             type:'post',
   //             data:{r:rnum}
   //          }).done(function(data){$('#ch').html(data)}).fail(function(data){alert('failed')});
   //       });   }
</script>
     
<?php
require_once 'footer.php';
?>