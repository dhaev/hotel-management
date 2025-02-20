<?php
//require_once '../config.php';

function signupEmpty($fname,$lname,$email,$phone,$address,$country,$city,$pwd,$rpwd){
	$result;
	if (empty($fname)||empty($lname)||empty($email)||empty($phone)||empty($address)||empty($country)||empty($city)||empty($pwd)||empty($rpwd)){
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function validUserID($name){
	$result;
	if (!preg_match('/^[a-zA-Z0-9]*$/',$name)){
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function invalidEmail($email){
	$result;
	if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function pwdMatch($pwd,$rpwd){
	$result;
	if ($pwd !== $rpwd){
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function emailExists($conn,$email){
	$sql="SELECT * FROM customer WHERE email = ?;";
	$stmt=mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)){
		 echo('index.php ? error=stmt emailname exist failed');
		exit();
	}
	mysqli_stmt_bind_param($stmt,'s',$email);
	mysqli_stmt_execute($stmt);

	$resultData=mysqli_stmt_get_result($stmt);
	
	if ($row=mysqli_fetch_assoc($resultData)) {
	
	return $row;
	}
	else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

function createUser($conn,$fname,$lname,$email,$phone,$address,$country,$city,$pwd,$image){
	$sql="INSERT INTO customer (fname,lname,email,phone,address,country,city,password,image) VALUES(?,?,?,?,?,?,?,?,?);";
	$stmt=mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)){
		 echo('index.php ?  error=stmt createUser failed');
		exit();
	}
	$hashpwd=password_hash($pwd, PASSWORD_DEFAULT);
	mysqli_stmt_bind_param($stmt,'sssssssss',$fname,$lname,$email,$phone,$address,$country,$city,$hashpwd,$image);
	mysqli_stmt_execute($stmt);

	mysqli_stmt_close($stmt);
	 echo('index.php ? error=none');
}

function loginEmpty($name,$pwd){
	$result;
	if (empty($name)||empty($pwd)){
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function loginUser($conn,$name,$pwd){
	$emailExists=emailExists($conn,$email);
	if ($unameExists === false) {
		 echo('login.php ? error=incorrect username');
		
		exit();
	}

	$hashedpwd=$emailExists['password'];
	$pwdcheck=password_verify($pwd, $hashedpwd);
	if ( $pwdcheck === false) {
		 echo('login.php ? error= incorrect password');
		exit();
	}
	elseif ($pwdcheck === true) {
		session_start();
		$_SESSION['id'] =$emailExists['id'];
		$_SESSION['email'] =$emailExists['email'];
		 echo('index.php');
		exit();
	}
}


function updateProfile($conn,$name,$email,$image,$id){
	 /*
	 -----------------------without prepare statement-----------------------------
	  $sql="UPDATE `customer` SET `username`='$name',`email`='$email' WHERE id='$id'";
      
      if (mysqli_query($conn,$sql)===true) {
            header('location: ../profile.php ?error=none');
      } 
      else {
           header('location: ../profile.php ?error=something went wrong');
      } 
      */
	/*$sql="UPDATE `customer` SET `username`=?,`email`=?,`image`=? WHERE id=?";
	$stmt=mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)){
		 echo('index.php ? error=stmt failed');
		exit();
	}

	mysqli_stmt_bind_param($stmt,'sssi',$name,$email,$image,$id);
	mysqli_stmt_execute($stmt);

	mysqli_stmt_close($stmt);
	 echo('index.php ? error=none');

	*/
	 $sql="UPDATE `customer` SET `username`=?,`email`=?,`image`=? WHERE id=?";
     $stmt=mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)){
       header('location:index.php ?stmt failed:could not update');
    } 

    mysqli_stmt_bind_param($stmt,'sssi',$name,$email,$image,$id);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
     echo('index.php ? error=none');

}

function addRoomEmpty($cin,$cout){
	$result;
	if (empty($cin)||empty($cout)){
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function createRoom($conn,$cin,$cout){
	$sql="INSERT INTO dat (cin,cout) VALUES(?,?);";
	$stmt=mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)){
		 echo('index.php ?  error=stmt createUser failed');
		exit();
	}
	mysqli_stmt_bind_param($stmt,'ss',$cin,$cout);
	mysqli_stmt_execute($stmt);

	mysqli_stmt_close($stmt);
	 echo('index.php ? error=none');
}