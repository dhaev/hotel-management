<?php
   require_once 'config.php';
   require_once 'header.php';
   require_once 'inc/functions.php';

   $selector=$_POST['selector'];
   $validator=$_POST['validator'];

   if (empty($selector)||empty($validator)) {
      echo "invalid request";
   }else{
      if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
?>

<form class="" id='' action="resetpwd.php" method="post">
            <h2 >forgot password</h2>
        <input type="hidden" name="selector"  value="<?php echo $selector ?>" autocomplete="username" required>
        <input type="hidden" name="validator"  value="<?php echo $validator ?>"  required>
          
        <input type="password" name="pwd" placeholder="password..." autocomplete="username" required>
        <input type="password" name="rpwd" placeholder="password..." autocomplete="username" required>
        <button id='log_in' name="login" >Submit</button>
        </form>

 <? 
}
 }
require_once 'footer.php';
?>