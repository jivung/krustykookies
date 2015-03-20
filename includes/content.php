<?php 
require_once("setup.php");
require_once("database.php");
require_once("mysql_connect_data.php");
$db = new Database($host, $userName, $password, $database);
$page = $_GET['page'];
?>
<div id="maincontainer">
	<div id="leftbar">
		<div id="leftbarcontent">
			<ul>
			
				<?php 
					$db->openConnection();
					if($db->checkSuperUser($_SESSION['username'])) {
				?>
				<li class="heading">Superuser</li>
				<li class="link"><a href="?page=captainslog">Logg</a></li>
				<li class="link"><a href="?page=createuser">Skapa ny användare</a></li>
				<li class="link"><a href="?page=deleteuser">Radera användare</a></li>
				<?php	
					}
					$db->closeConnection();
				?>
				<?php 
					$db->openConnection();
					if($db->checkMaterialUser($_SESSION['username']) || $db->checkSuperUser($_SESSION['username'])) {
				?>
				<li class="heading">Material & recept</li>
				<?php	
					}
					$db->closeConnection();
				?>
				<?php 
					$db->openConnection();
					if($db->checkProductionUser($_SESSION['username']) || $db->checkSuperUser($_SESSION['username'])) {
				?>
				<li class="heading">Pallar</li>
				<li class="link"><a href="?page=production">Produktion</a></li>
				<li class="link"><a href="?page=blocking">Blockering</a></li>
				<li class="link"><a href="?page=search">Sökning</a></li>
				<?php	
					}
					$db->closeConnection();
				?>
				<?php 
					$db->openConnection();
					if($db->checkOrderAndDeliveryUser($_SESSION['username']) || $db->checkSuperUser($_SESSION['username'])) {
				?>
				<li class="heading">Ordrar & leveranser</li>
				<?php	
					}
					$db->closeConnection();
				?>
			</ul>
		</div>
	</div>
	<div id="mainbar">
		<?php
			switch($page) {
				case "captainslog":
					include_once("captainslogg.php");
					break;
				case "createuser":
					include_once("createuser");
					break;
				case "deleteuser":
					include_once("deleteuser.php");
					break;
				
				
				case "production":
					include_once("production.php");
					break;
				case "blocking":
					include_once("blocking.php");
					break;
				case "search":
					include_once("search.php");
					break;
				default: 
					include_once("default.php");
			} 	
		?>
	</div>
</div>
