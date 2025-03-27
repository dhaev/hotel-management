<?php
if (isset($_POST['email']) || isset($_POST['pwd'])) {
	$email=$_POST['email'];
	$pwd=$_POST['pwd'];

	require_once '../config.php';
	require_once 'functions.php';

	if (loginEmpty($email, $pwd) !== false) {
		echo json_encode(array('status' => 'error', 'message' => 'Please fill all fields'));
		exit();
	}

	if (loginUser($conn, $email, $pwd)) {
		echo json_encode(array('status' => 'success', 'message' => 'Login successful', 'url' => 'index.php'));
	} else {
		echo json_encode(array('status' => 'error', 'message' => 'Invalid email or password'));
	}
}