<?php 
require_once("includes/setup.php");
require_once("includes/database.php");
require_once("includes/mysql_connect_data.php");
$db = new Database($host, $userName, $password, $database);
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
				<li class="heading">Pallar</li>
				<li class="link"><a href="?page=production">Produktion</a></li>
				<li class="link"><a href="?page=blocking">Blockering</a></li>
				<li class="link"><a href="?page=search">Sökning</a></li>
				<li class="heading">Ordrar & leveranser</li>
				
			</ul>
		</div>
	</div>
	<div id="mainbar">
		<?php
				
		?>
	</div>
</div>
