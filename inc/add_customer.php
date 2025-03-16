<?php
	
if (isset($_POST['fname'])) {

	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$pwd=$_POST['pwd'];
	$rpwd=$_POST['rpwd'];
	$image='default.png';

	require_once '../config.php';
	require_once 'functions.php';

	if(signupEmpty($fname,$lname,$email,$phone,$pwd,$rpwd)!==false){
		echo('please fill all fields');
		exit();
	}
	if(invalidEmail($email)!==false){
		echo('invalid email');
		exit();
	}
	if(pwdMatch($pwd,$rpwd)!==false){
		echo('passwords do not match');
		exit();
	}
	if(emailExists($conn,$email)!==false){
		echo(' email already exists');
		exit();
	}
	
	createUser($conn,$fname,$lname,$email,$phone,$pwd,$image);
	
}else{
	header("../location:add_customer.php");
}

