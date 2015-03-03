<?php
require_once("setup.php");
require_once("database.php");
require_once("mysql_connect_data.php");
$db = new Database($host, $userName, $password, $database);
$db->openConnection();
$user = "brocca";
$supuser = "superuser";
$password = $db->checkPassword($supuser, "password");

if($db->checkSuperUser($supuser)) {
	echo "jadå";
	echo $db->checkSuperUser(supuser);
} else {
	echo "wtf";
}
$db->closeConnection();
?>