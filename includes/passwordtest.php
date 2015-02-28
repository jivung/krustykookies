<?php
require_once("setup.php");
require_once("database.php");
require_once("mysql_connect_data.php");
$db = new Database($host, $userName, $password, $database);
$db->openConnection();
$user = "brocca";
$password = $db->checkPassword($user);
foreach($password as $pass){
	echo $pass[0];
}
?>