   <?php
   require_once 'config.php';
   require_once 'inc/functions.php';

   $selector=$_POST['selector'];
   $validator=$_POST['validator'];
   $password=$_POST['pwd'];
   $rpassword=$_POST['rpwd'];

   if (empty($password)||empty($rpassword)){
      header("Location: newpwd.php");
   }else if($password !=$rpassword){
      header("Location: newpwd.php");

   }

   $cdate=date("U");

   $sql="SELECT *FROM resetpwd WHERE resetpwdSelector=? AND resetpwdExpires>=?";
      $stmt=mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt,$sql)){
         echo('error');
         exit();
      }
      mysqli_stmt_bind_param($stmt,'ss',$selector,$cdate);
      mysqli_stmt_execute($stmt);
       $result=mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result)>0) {
       $row=mysqli_fetch_assoc($result) ; 
         $tbin= hex2bin($validator);
         $tcheck= password_verify($tbin, $row["resetpwdToken"])
         if ($tcheck===false) {
            echo "try again";
         } else if($tcheck===true){
            $tmail=$row["resetpwdEmail"];

            $sql="SELECT * FROM registered WHERE email=?";
      $stmt=mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt,$sql)){
         echo('error');
         exit();
      }
      mysqli_stmt_bind_param($stmt,'s',$email);
      mysqli_stmt_execute($stmt);
       $result=mysqli_stmt_get_result($stmt);

       if (mysqli_num_rows($result)>0) {
       $row=mysqli_fetch_assoc($result) ; 

       $sql="UPDATE room_type SET password=? WHERE email=?";
      $stmt=mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt,$sql)){
         echo(' failed to update rtype');
         exit();
      }
      $npwd=password_hash($password, PASSWORD_DEFAULT)
      mysqli_stmt_bind_param($stmt,'ss',$npwd,$tmail);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);

$sql="  DELETE from resetpwd WHERE resetpwdEmail=?";
         $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            echo('stmt failed:could not cancel2');
        }
        mysqli_stmt_bind_param($stmt,'s',$email);
        mysqli_stmt_execute($stmt);


         }else{
            echo "err";
         }
         

       
    }else{
echo'try again';
    }
      mysqli_stmt_close($stmt);

 ?>



 <? 
 if (isset($_GET['reset'])) {
    echo'<p style="color:green"> check your email</p>';
 }
require_once 'footer.php';
?>