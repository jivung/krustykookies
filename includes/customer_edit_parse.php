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
	if(!$db->checkCustomer($_SESSION['username']) == "1") {
		header("Location: ../index.php");
		exit();
	}
	$user = $_POST['userName'];
	$fullname = $_POST['fullName'];
	$address = $_POST['address'];
	
	if(empty($user) || empty($fullname) || empty($address)) {
		header("Location: ../customer_edit.php?empty");
		exit();
	}
	
	$db->editCustomer($user, $fullname, $address);
	$db->closeConnection();
	header("Location: ../customer_edit.php?success");
?>