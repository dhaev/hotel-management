   <?php
   require_once 'config.php';
   require_once 'header.php';
   require_once 'inc/functions.php';
   $t = geteditrnum($conn,$RtypeID,$b,$bs,$nr,$ns,$m,$RoomID);
   print_r($t);
  //  $retVal = (gettype($_GET['y'])==NULL) ? 'yes': 'nope' ;
  //  echo gettype($_GET['y']);
  //  echo gettype($_GET['k']);
  // echo $retVal;
  // print_r($_GET);
 ?>
  <!-- <script src="jQuery.js"></script> -->

<!-- <div id="div1"><button id="one" type="button">one</button></div>
<p id='p1'><button class="p1button" id="two" type="button"> two</button></p>
  -->

<!-- <form class="form1" id="form1" id='login' action="pwdreset.php" method="post">
            <h2 >forgot password</h2>
          
        <input type="email" id="email" name="email" placeholder="email..." autocomplete="username" required>
        <button id='log_in' name="login" >Submit</button>
        </form> -->

        <!-- <input type="email" id="rid" name="email" placeholder="email..." autocomplete="username" value="bvgccgfcg"> -->
 <!--  -->
 <div ></div>
<script >
  // $('#one').click(function(){
    // console.log($(this).parent().siblings().find('[id*="two"]').html());
    // var roomid=$('#rid').length;
    // console.log($('#rid').length);
  
  //   if ($('#rid').length) { console.log();} else {console.log($('#rid').val());}
    
  // });
   $(function(){
    // var k=$('#rid').val();
    // var y=$('#rd').val();
    // console.log($('#rid').val());
    //     $.get('index.php',{k,y}).done(function (data) {console.log(data);}).fail(function (data) {
    //        alert('failed');});
   //  $( '#main' ).load( 'rtypegrid.php', function() {
   // alert( "Load was performed." );});

  })
</script>
<?php 
 if (isset($_GET['reset'])) {
    echo'<p style="color:green"> check your email</p>';
 }
require_once 'footer.php';
?>