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
	if(!$_SESSION['user']->isSuperUser() && !$_SESSION['user']->isMaterialUser()){
		header("Location: ../index.php");
		exit();
	}
	if(!empty($_POST['material'])) {
		foreach($_POST['material'] as $selectedMaterial) {
			$db->addMaterialAmount($selectedMaterial, $_POST['amount']);
		}
	}
	header("Location: ../materials.php?success");
?>