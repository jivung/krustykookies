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
	if(!($db->checkSuperUser($_SESSION['username']) == "1" || $db->checkMaterialUser($_SESSION['username']) == '1')) {
		header("Location: ../index.php");
		exit();
	}
	
	$customer = str_replace(' ', '_', $_POST['customer']);
	$amount = 0;
	$cookies = $db->getRecipes();
	
	if(isset($customer)) {
		$db->addOrder($customer);
		foreach($cookies as $cookie) {
			if(isset($_POST[$cookie['name']])) { $amount = $_POST[$cookie['name']]; }
			$db->addOrderPallets($order, $cookie['name'], $amount);
		}
	}
	$db->closeConnection();
	header("Location: ../customer_order.php?success");
?>