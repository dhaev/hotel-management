<?php
include'config.php';
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>

      <?php
      $q = $_GET['q'];
      $r = $_GET['r'];
      $s = $_GET['s'];


      include 'config.php';


 echo $q;

      echo '<select >';
                     
                     //$sql="SELECT rnum FROM add_room WHERE rtype='".$q."' AND NOT EXISTS (SELECT rnum FROM book)";
                     $sql="SELECT rnum FROM add_room WHERE rtype='".$q."' AND rnum NOT IN (SELECT rnum FROM `dat` WHERE cin AND cout BETWEEN '".$r."' AND '".$s."')";  
                     $result=mysqli_query($conn,$sql);

                     while($row=mysqli_fetch_assoc($result)){
                     echo '<option>'.$row['rnum'].'</option>';

                     }
                     
                 
               echo'</select>';
      ?>
</body>
</html>