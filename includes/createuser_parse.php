<?php
	require_once("setup.php");
	require_once("database.php");
	require_once("mysql_connect_data.php");
	$db = new Database($host, $userName, $password, $database);
	$db->openConnection();

	if (!$db->isConnected()) {
		header("Location: ../index.php?connect_error");
		exit();
	}
	if (!isset($_SESSION['username'])) {
		header("Location: ../index.php?wtf1");
		exit();
	}
	if(!$db->checkSuperUser($_SESSION['username'])) {
		header("Location: ../index.php?wtf2");
		exit();
	}
	$user = $_POST['krustyname'];
	$krustypass1 = $_POST['krustypassword'];
	$krustypass2 = $_POST['krustypassword2'];
	$userType = $_POST['kontotyp'];
	
	if(empty($user) || empty($krustypass1) || empty(krustypass2) || empty(usertype)) {
		header("Location: ../index.php?page=createuser&empty");
		exit();
	}
	
	if($krustypass1 != $krustypass2)  {
		header("Location: ../index.php?page=createuser&false");
		exit();
	}
	$password = password_hash($krustypass1, PASSWORD_DEFAULT);
	$db->createUser($user, $password, $userType);
	$db->closeConnection();
	header("Location: ../index.php?page=createuser&success");
?>