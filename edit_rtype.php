<?php
require_once 'config.php';
require_once 'header.php';

$id=$_GET['id'];
$sql='SELECT * FROM room_type WHERE RtypeID=?';
$stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
             echo('failed to connect');
             exit();
        }
        mysqli_stmt_bind_param($stmt,'i',$id);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        while($row=mysqli_fetch_assoc($result)){
            ?>
      <script >
         $(function () {
            $('#img').attr('src','img/rtype/<?= $row['image'];?>');
            $('#rtype').val('<?= $row['rtype'];?>');
            $('#price').val('<?=  $row['price'];?>');
            $('#desc').val('<?= $row['description'];?>');
            
         });

      </script>
      <?php  }  
           

?>
<div class="w3-content">              
<form class="form1 w3-row-padding" id="form1" action="inc/add_rtype" method="post" enctype="multipart/form-data">
   


   <div class="w3-col"><h2 class="w3-center w3-padding-large w3-margin-top w3-margin-bottom"> Edit Room Type</h2>
         </div><div class="w3-half">
          <p><img id='img' class="w3-input  w3-margin-bottom" src=""  ></p>
      <p><input id='file' class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom"   type="file" onchange='showimg()'  name='file' required></p>
   </div>
      <div class="w3-half">
       <p>
                  <label class=" w3-padding-large ">Room Type</label></p><p>
      <input type="text" id="rtype" name="rtype" class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom"   placeholder="Room Type..." required></p>
      <p>
                  <label class=" w3-padding-large ">Price</label></p><p>
      <input type="number" id="price" class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom"   name="price" placeholder="price..." required></p>
      <p>
                  <label class=" w3-padding-large ">Description</label></p><p>
      <textarea  name="desc" id="desc" class="w3-input w3-border w3-round-small w3-padding-large w3-margin-top w3-margin-bottom"   placeholder="description..." required> </textarea></p> 
      </div>
           <div class="w3-col">  <p><button class="w3-input w3-round-xxlarge w3-padding-large w3-margin-top w3-margin-bottom"   id="chng" name="edit_rtype" >Save</button></p>
       </div>
       

 
  
</form>    </div> 
<?php
require_once 'footer.php';
?>