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
	if(empty($_POST['wanted'])){
		header("Location: ../customer_order.php?emptyDate");
		exit();
	}
	if(!validateDate($_POST['wanted'])){
		header("Location: ../customer_order.php?wrongFormat");
		exit();
	}
	$customer = str_replace(' ', '_', $_POST['customer']);
	$wanted = $_POST['wanted'];
	$amount = 0;
	$cookies = $db->getRecipes();
	
	if(isset($customer)) {
		$orderId = $db->addOrder($customer, $wanted);
		foreach($cookies as $cookie) {
			if($_POST[$cookie['name']] > 0) { 
				$amount = $_POST[$cookie['name']]; 
				$db->addOrderPallets($orderId, $cookie['name'], $amount);
			}
		}
	}
	if($amount){
		header("Location: ../customer_order.php?success");
	} else{
		header("Location: ../customer_order.php?empty");
	}
?>