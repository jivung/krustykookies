<?php
	require_once("database.php");
	require_once("user.php");
	require_once("setup.php");
	require_once("mysql_connect_data.php");
	$db = new Database($host, $userName, $password, $database);

	if (!isset($_SESSION['username'])) {
		header("Location: ../login.php");
		exit();
	}
	if(!$_SESSION['user']->isSuperUser()){
		header("Location: index.php");
		exit();
	}
	$user = str_replace(' ', '_', $_POST['krustyname']);
	$krustypass1 = $_POST['krustypassword'];
	$krustypass2 = $_POST['krustypassword2'];
	$userType = $_POST['kontotyp'];
	
	if(empty($user) || empty($krustypass1) || empty(krustypass2) || empty(usertype) || !isset($_POST['kontotyp'])) {
		header("Location: ../create_user.php?empty");
		exit();
	}
	
	if($krustypass1 != $krustypass2)  {
		header("Location: ../create_user.php?false");
		exit();
	}
	$password = password_hash($krustypass1, PASSWORD_DEFAULT);
	$db->createUser($user, $password, $userType);
	header("Location: ../create_user.php?success");
?>