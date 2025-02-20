<?php
require_once 'config.php';
require_once 'header.php';
?>

             
                 
         <form class="form1" id="form1" action="inc/add_employee" method="post">
            <h2 >Sign Up</h2>
          
            <input type="text" name="fname" placeholder="Firstname..." required>
            <input type="text" name="lname" placeholder="Lastname..." required>
            <input type="email" name="email" placeholder="Email..." required>
            <input type="text" name="phone" placeholder="Phone number..." required>
            <input type="text" name="address" placeholder="Address..." required>
            <input type="text" name="country" placeholder="Country..." required>
            <input type="text" name="city" placeholder="City..." required>
            <input type="text" name="job" placeholder="Job..." required>
            <button type="submit" name="add" >Add</button>
        </form>
      
<?php
require_once 'footer.php';
?>