<?php
require_once 'config.php';
require_once 'header.php';
?>
<script>
    $(function () {
        $('#img').prop('src', 'img/<?= $_SESSION['image'];?>');
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
   <form id="form1" action="inc/profile" method="post">
        <div class="form-row justify-content-center">
            <div class="form-group col-md-4">
             <img id='img' style="height: 150px;" src="">
             <input id='file' type="file" onchange='showimg()' name='file'>
            </div>
        </div>
      <div class="form-row justify-content-center">
         <div class="form-group col-md-4">
            <label for="fname">Firstname</label>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="Firstname..." value='' required>
         </div>
         <div class="form-group col-md-4">
            <label for="lname">Lastname</label>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Lastname..." value='' required>
         </div>
      </div>
      <div class="form-row justify-content-center">
         <div class="form-group col-md-4">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="Email" name="email" placeholder="Email..." value='' required>
         </div>
         <div class="form-group col-md-4">
            <label for="phone">Phone number</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone number..." value='' required>
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