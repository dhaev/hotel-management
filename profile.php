<?php
require_once 'config.php';
require_once 'header.php';
?>
<script>
    $(function () {
        $('#img').prop('src', 'img/<?= $_SESSION['image'];?>');
        $('#preview').prop('src', 'img/<?= $_SESSION['image'];?>');
        $('#fname').val('<?= $_SESSION['fname'];?>');
        $('#lname').val('<?= $_SESSION['lname'];?>');
        $('#Email').val('<?= $_SESSION['email'];?>');
        $('#phone').val('<?= $_SESSION['phone'];?>');
        $('#address').val('<?= $_SESSION['address'];?>');
        $('#country').val('<?= $_SESSION['country'];?>');
        $('#city').val('<?= $_SESSION['city'];?>');
    });
</script>
<div class="container mt-5">
   <h2 class="text-center mb-4">Profile</h2>
   <form id="imageForm" action="inc/update_profile_image.php" method="post" enctype="multipart/form-data">
      <div id="view_menu"><div  class="form-row justify-content-center">
         <div class="form-group col-md-4">
            <img id='img' style="height: 210px;" src="">
         </div>
      </div>
      <div class="form-row justify-content-center">
         <div class="form-group col-md-1">
            <button class="btn btn-primary form-group text-center" type="button" id='edituploadImage' name="edituploadImage" onclick="showEditMenu()">Edit</button>
         </div> 
      </div>
   </div>
   <div id="edit_menu" style="display: none;">
   <div  class="form-row justify-content-center">
         <div class="form-group col-md-4">
            <img id='preview' style="height: 210px;" src="">
         </div>
      </div>
      <div class="form-row justify-content-center">
         <div class="form-group col-md-3">
            <input class="text-center primary form-control" id='file' type="file" onchange='showimg()' name='file'>
         </div>
         <div class="form-group col-md-1">
            <button class="btn btn-secondary form-group text-center" type="submit" id='uploadImage' name="uploadImage">Save</button>
         </div> 
         <div class="form-group col-md-1">
         <button class="btn btn-danger form-group text-center" type="button" id='canceluploadImage' name="canceluploadImage" onclick="cancelUpload()">Cancel</button>
      </div> 
      </div>
      </div>
   </form>

   <!-- Form for Text Data -->
   <form id="textForm" action="inc/update_profile.php" method="post">
      <div class="form-row justify-content-center">
         <div class="form-group col-md-4">
            <label for="fname">Firstname</label>
            <input type="text" class="form-control" id="fname" name="fname" required>
         </div>
         <div class="form-group col-md-4">
            <label for="lname">Lastname</label>
            <input type="text" class="form-control" id="lname" name="lname" required>
         </div>
      </div>
      <div class="form-row justify-content-center">
         <div class="form-group col-md-4">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="Email" name="email" required>
         </div>
         <div class="form-group col-md-4">
            <label for="phone">Phone number</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
         </div>
      </div>
      <div class="form-row justify-content-center">
         <div class="form-group col-md-8">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address">
         </div>
      </div>
      <div class="form-row justify-content-center">
         <div class="form-group col-md-2">
            <label for="city">City</label>
            <input type="text" class="form-control" id="city" name="city">
         </div>
         <div class="form-group col-md-2">
            <label for="state">State</label>
            <input type="text" class="form-control" id="state" name="state">
         </div>
         <div class="form-group col-md-1">
            <label for="zip">Zip Code</label>
            <input type="text" class="form-control" id="zip" name="zip">
         </div>   
         <div class="form-group col-md-2">
            <label for="country">Country</label>
            <input type="text" class="form-control" id="country" name="country">
         </div>   
      </div>
      <div class="form-row justify-content-center">
         <button class="btn btn-secondary form-group col-md-4 text-center" type="submit" id='update' name="update">Update</button>
      </div>
   </form>
</div>
<?php
require_once 'footer.php';
?>