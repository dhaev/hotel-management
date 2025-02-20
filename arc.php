<?php
include 'config.php';

$rnum=$_POST['r'];

$sql="SELECT rnum FROM room WHERE rnum=?";
$stmt=mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
	echo('could not connect');
}
mysqli_stmt_bind_param($stmt,'i',$rnum);
mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result)>0){
	
	echo "room exist";
}

?>