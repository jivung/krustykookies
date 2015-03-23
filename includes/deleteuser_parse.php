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
	/*$selectedUsers = array();*/
	foreach ($_POST['user'] as $selectedUser) {
		/*array_push($selectedUsers, $selectedUser);*/
		$db->deleteUser($selectedUser);
	}
	$db->closeConnection();
	header("Location: ../delete_user.php?success");
?>