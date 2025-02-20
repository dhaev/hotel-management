<?php
	
if(isset($_POST['submit'])){

	$name=$_POST['uname'];
	$email=$_POST['email'];
	$pwd=$_POST['pwd'];
	$rpwd=$_POST['rpwd'];
	$image='img/default.png';

	require_once '../config.php';
	require_once 'functions.php';

	if(signupEmpty($name,$email,$pwd,$rpwd)!==false){
		 echo('index.php ? error=please fill all fields');
		exit();
	}
	if(invalidEmail($email)!==false){
		 echo('index.php ? error=invalid email');
		exit();
	}
	if(pwdMatch($pwd,$rpwd)!==false){
		 echo('index.php ? error=passwords do not match');
		exit();
	}
	if(unameExists($conn,$name)!==false){
		 echo('index.php ? error=username exists');
		exit();
	}
	
	createUser($conn,$name,$email,$pwd,$image);

}
else{
	 echo('index.php');
	exit();
}