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
	if(!($_SESSION['user']->isCustomerUser())){
		header("Location: ../index.php");
		exit();
	}
	$db->openConnection();
	$customer = str_replace(' ', '_', $_POST['customer']);
	$wanted = $_POST['wanted'];
	$amount = 0;
	$cookies = $db->getRecipes();
	
	if(isset($customer)) {
		$orderId = $db->addOrder($customer, $wanted);
		foreach($cookies as $cookie) {
			if(isset($_POST[$cookie['name']])) { $amount = $_POST[$cookie['name']]; }
			$db->addOrderPallets($orderId, $cookie['name'], $amount);
		}
	}
	$db->closeConnection();
	header("Location: ../customer_order.php?success");
?>