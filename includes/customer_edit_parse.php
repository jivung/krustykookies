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
	if(!$_SESSION['user']->isCustomerUser()){
		header("Location: ../index.php");
		exit();
	}
	$user = str_replace(' ', ' ', $_POST['userName']);
	$fullname = str_replace(' ', '_', $_POST['fullName']);
	$address = str_replace(' ', '_', $_POST['address']);
	
	if(empty($user) || empty($fullname) || empty($address)) {
		header("Location: ../customer_edit.php?empty");
		exit();
	}
	
	$db->editCustomer($user, $fullname, $address);
	header("Location: ../customer_edit.php?success");
?>