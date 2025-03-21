<?php
require_once 'config.php';
require_once 'header.php';
?>

             
                 
         <form class="textForm" id="textForm" action="inc/change_password.php" method="post">
            <h2 >Change Password<?php echo $_SESSION['CustomerID'];echo $_SESSION['email'];?></h2>
          
            <input type="password" name="oldpwd" placeholder="Old Password...">
            <input type="password" name="newpwd" placeholder="New password...">

            <button type="submit" name="change" >Add</button>
        </form>
 
      
     
<?php
require_once 'footer.php';
?>