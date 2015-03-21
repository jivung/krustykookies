<?php
	require_once("setup.php");
	require_once("database.php");
	require_once("mysql_connect_data.php");
	$db = new Database($host, $userName, $password, $database);
	$db->openConnection();

	if (!$db->isConnected()) {
		header("Location: ../login.php?connect_error");
		exit();
	}
	if (!isset($_SESSION['username'])) {
		header("Location: ../login.php");
		exit();
	}
	if(!$db->checkSuperUser($_SESSION['username']) == "1") {
		header("Location: ../index.php");
		exit();
	}
	$user = $_POST['krustyname'];
	$krustypass1 = $_POST['krustypassword'];
	$krustypass2 = $_POST['krustypassword2'];
	$userType = $_POST['kontotyp'];
	
	if(empty($user) || empty($krustypass1) || empty(krustypass2) || empty(usertype)) {
		header("Location: ../create_user.php?empty");
		exit();
	}
	
	if($krustypass1 != $krustypass2)  {
		header("Location: ../create_user.php?false");
		exit();
	}
	$password = password_hash($krustypass1, PASSWORD_DEFAULT);
	$db->createUser($user, $password, $userType);
	$db->closeConnection();
	header("Location: ../create_user.php?success");
?>