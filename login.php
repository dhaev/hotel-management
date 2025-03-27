<?php
require_once 'config.php';
require_once 'header.php';
?>

             
                 
         <form class="loginForm" id="loginForm" id='login' action="inc/login.php" method="post">
            <h2 >Login</h2>
          
        <input type="email" id="email" name="email" placeholder="email..." autocomplete="username" required>
        <input type="password" id="pwd" name="pwd" placeholder="Password..." autocomplete="password" required>
        <button id='log_in' name="login" >Submit</button>
        </form>
 
<?php
require_once 'footer.php';
?>