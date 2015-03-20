<?php 
require_once("setup.php");
require_once("database.php");
require_once("mysql_connect_data.php");
$db = new Database($host, $userName, $password, $database);
$page = $_GET['page'];
?>
<div id="mainbarcontenttest">
	<h1>Produktion</h1>
</div>