<?php
if (isset($_POST['email']) || isset($_POST['pwd'])) {
	// code...
	$email=$_POST['email'];
	
	$pwd=$_POST['pwd'];
	

	require_once '../config.php';
	require_once 'functions.php';

	if(loginEmpty($email,$pwd)!==false){
		 echo('Please fill all fields');
		exit();
	}
	loginUser($conn,$email,$pwd);
	$url= 'index.php';	
	$alert='welcome';
	// echo (json_encode(array('url'=>$url,'alert'=>$alert)));
	echo (json_encode(array('url'=>$url,'alert'=>$alert)));
}	