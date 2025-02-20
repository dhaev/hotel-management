<?php


	$ID=$_GET['id'];
	$status= 1;
	
	require_once '../config.php';
	require_once 'functions.php';

		$ord=bookingstatus($conn,$ID,$status);

	    
	   	$sql="INSERT INTO `check_in`  (ord) VALUES(?)";
	     $stmt=mysqli_stmt_init($conn);

	    if (!mysqli_stmt_prepare($stmt,$sql)){
	        echo('could not connect');
	    } 

	    mysqli_stmt_bind_param($stmt,'i',$ID);
	    mysqli_stmt_execute($stmt);
	    
	    mysqli_stmt_close($stmt);
	     //echo('checkin complete');
	     header('location:../view_booked.php');
	   