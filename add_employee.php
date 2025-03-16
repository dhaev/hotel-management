<?php
require_once 'config.php';
require_once 'header.php';
?>
<div class="container mt-5">
   <h2 class="text-center mb-4">Add Employee</h2>
   <form id="form1" action="inc/add_employee" method="post">
      <div class="form-row justify-content-center">
         <div class="form-group col-md-4">
            <label for="fname">Firstname</label>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="Firstname..." required>
         </div>
         <div class="form-group col-md-4">
            <label for="lname">Lastname</label>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Lastname..." required>
         </div>
      </div>
      <div class="form-row justify-content-center">
         <div class="form-group col-md-4">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email..." required>
         </div>
         <div class="form-group col-md-4">
            <label for="phone">Phone number</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone number..." required>
         </div>
      </div>
      <div class="form-row justify-content-center">
         <div class="form-group col-md-4">
            <label for="pwd">Password</label>
            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password..." required>
         </div>
         <div class="form-group col-md-4">
            <label for="rpwd">Repeat Password</label>
            <input type="password" class="form-control" id="rpwd" name="rpwd" placeholder="Repeat Password..." required>
         </div>
      </div>
      <div class="form-row justify-content-center">
         <button class="btn btn-secondary form-group col-md-4 text-center" type="submit" id='add' name="add">Submit</button>
      </div>
   </form>
</div>
<?php
require_once 'footer.php';
?>