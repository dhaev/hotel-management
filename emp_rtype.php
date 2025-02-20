<?php
require_once 'config.php';
require_once 'header.php';
?>
              
<form class="form1" id="form1" action="inc/department" method="post">
   <h2 >Department</h2>
 
   <input type="text" id="department" name="department" placeholder="department..." required>
   <button type="submit" name="add" >Add</button>
</form>

<?php
require_once 'footer.php';
?>