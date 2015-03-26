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
	/*$selectedUsers = array();*/
	foreach ($_POST['user'] as $selectedUser) {
		/*array_push($selectedUsers, $selectedUser);*/
		$db->deleteUser($selectedUser);
	}
	header("Location: ../delete_user.php?success");
?>