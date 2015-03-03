<?php
	
	require_once('database.php');
	require_once("mysql_connect_data.php");
	
	$db = new Database($host, $userName, $password, $database);
	$db->openConnection();

	if (!$db->isConnected()) {
		header("Location: ../index.php?connect_error");
		exit();
	}
	
	$user = $_POST['krustyname'];
	$userPassword = $_POST['krustypassword'];
	
	if (empty($user) || empty($userPassword)) {
		header("Location: ../index.php?empty");
		exit();
	}
	/*
	if (!$db->userExists($user)) {
		$db->closeConnection();
		header("Location: ../index.php?false");
		exit();
	}
	*/
	if(!($db->checkPassword($user, $userPassword))) {
		$db->closeConnection();
		header("Location: ../index.php?false");
		exit();
	}
	
	$db->closeConnection();

	session_start();
	$_SESSION['username'] = $user;
	$_SESSION['db'] = $db;
	
	// success!
	header("Location: ../index.php");
	
?>
	