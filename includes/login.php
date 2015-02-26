<?php
	
	require_once('database.inc.php');
	require_once("mysql_connect_data.inc.php");
	
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
	
	if (!$db->userExists($user)) {
		$db->closeConnection();
		header("Location: ../index.php?no_user=" . $user);
		exit();
	}
	
	$passwordReal = $db->checkPassword($user);
	foreach($passwordReal as $pass){
		$passwordReal = $pass[0];
	}
	
	if(!($passwordReal == $userPassword)) {
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
	