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
	if(!empty($_POST['material'])) {
		foreach($_POST['material'] as $selectedMaterial) {
			$db->addMaterialAmount($selectedMaterial, $_POST['amount']);
		}
	}
	$db->closeConnection();
	header("Location: ../materials.php?success");
?>