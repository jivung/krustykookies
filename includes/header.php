<?php 
$db = new Database($host, $userName, $password, $database);
$isLogedIn = isset($_SESSION['username']);
if(!$isLogedIn && !$loginPage){
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			Krusty Kookies Database System
		</title>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="includes/stylesheet.css" />
	</head>
	<body>
		<div id="toptopbanner">
			<div id="toptopcontainer">
				<div id="readmecontainer">
					README - INFORMATION - SUPPORT
				</div>
			</div>
		</div>
		<div id="topbanner">
			<div id="topcontainer">
				<div id="logocontainer">
					<a class="logo" href="index.php">KRUSTY KOOKIES DATABASE SYSTEM</a>
				</div>
				<?php if($isLogedIn){ ?>
				<div id="logout">
					<form name="logoutform" id="logoutform" method="POST" action="includes/logout.php" >
						<input type="submit" class="submit_button_logout" name="submit" value="Logga ut" />
					</form>
				</div>
				<div id="statuscontainer"> Du är inloggad som <b><?php echo $_SESSION['username']; ?></b></div>
				<?php } ?>
			</div>
		</div>
		<div id="maincontainer">
			
			<?php if($isLogedIn){ ?>
			
			<div id="leftbar">
				<div id="leftbarcontent">
					<ul>
					
						<?php 
							$db->openConnection();
							if($db->checkSuperUser($_SESSION['username'])) {
						?>
						<li class="heading">Superuser</li>
						<li class="link"><a href="log.php">Logg</a></li>
						<li class="link"><a href="create_user.php">Skapa ny användare</a></li>
						<li class="link"><a href="delete_user.php">Radera användare</a></li>
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
						<li class="link"><a href="production.php">Produktion</a></li>
						<li class="link"><a href="blocking.php">Blockering</a></li>
						<li class="link"><a href="search.php">Sökning</a></li>
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
				<div id="mainbarcontenttest">
					
			<?php } ?>