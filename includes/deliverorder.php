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
	if(!($_SESSION['user']->isSuperUser()) || ($_SESSION['user']->isOrderUser())){
		header("Location: ../index.php");
		exit();
	}
	$db->openConnection();
	$order = $_POST['orderid'];
	$db->deliverOrder($order);
	$db->closeConnection();
	header("Location: ../orders.php?success");
?>