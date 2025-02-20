   <?php
   require_once 'config.php';
   require_once 'inc/functions.php';
 
$selector=bin2hex(random_bytes(10));
$token=random_bytes(32);

$url="www.img.com/index/newpassword.php?selector=$selector&validator=bin2hex($token)";
$exp=date("U")+1800;

$email=$_POST['email'];

$sql="  DELETE from resetpwd WHERE resetpwdEmail=?";
         $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            echo('stmt failed:could not cancel2');
        }
        mysqli_stmt_bind_param($stmt,'s',$email);
        mysqli_stmt_execute($stmt);
       

$sql="INSERT INTO resetpwd (resetpwdEmail,resetpwdSelector,resetpwdToken,resetpwdExpires) VALUES(?,?,?,?);";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            echo('stmt insert add_rtype failed');
            exit();
        }
        $htoken=password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt,'ssss',$email,$selector,$htoken,$exp);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $to=$email;

        $subject='reset password';

        $message='<p> Below is the link to reset password.Ignore if you did not request. </p>';
        $message.='<p> link : </p><br>';
        $message.='<a href="$url">'.$url.' </a>';

        $headers='From: img <img@gmail.com>\r\n';
        $headers.='Reply-To: img@gmail.com \r\n';
        $headers.='Content-type: text/html\r\n';

        mail($to, $subject, $message, $headers);

        header("Location:index.php?reset=success");


require_once 'footer.php';
?>