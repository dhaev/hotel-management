<?php


	$RoomID=$_GET['id'];
	$status=1;
	
	require_once '../config.php';
	require_once 'functions.php';

	 $sql="INSERT INTO `maintenance`(RoomID,status) VALUES(?,?)";
	     $stmt=mysqli_stmt_init($conn);

	    if (!mysqli_stmt_prepare($stmt,$sql)){
	        echo('view_rooms.php ?stmt failed:could not cancel');
	    } 

	    mysqli_stmt_bind_param($stmt,'ii',$RoomID,$status);
	    mysqli_stmt_execute($stmt);
	    
	    mysqli_stmt_close($stmt);
	     echo('view_rooms.php ? error=none');
	   