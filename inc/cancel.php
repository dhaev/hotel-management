<?php


	$ID=$_GET['id'];
	$status= 3;
	
	require_once '../config.php';
	require_once 'functions.php';
	$ord=bookingstatus($conn,$ID,$status);
	
	    
	   	$sql="INSERT INTO `cancel`  (ord) VALUES(?)";
	     $stmt=mysqli_stmt_init($conn);

	    if (!mysqli_stmt_prepare($stmt,$sql)){
	        echo('view_booked.php ?stmt failed:could not cancel2');
	    } 

	    mysqli_stmt_bind_param($stmt,'i',$ID);
	    mysqli_stmt_execute($stmt);
	    
	    mysqli_stmt_close($stmt);
	    header('location:../view_booked.php ? page not found');
	   