<?php 
$db = new Database($host, $userName, $password, $database);
$isLogedIn = isset($_SESSION['username']);
if(!$isLogedIn && !($loginPage || $readmePage)){
	header("Location: login.php");
}
$user = $_SESSION['user'];
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
					<a href="readme.php" class="wzup">README</a> - <a href="info.php" class="wzup">INFORMATION</a> - <a href="support.php" class="wzup">SUPPORT</a>
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
				<div id="statuscontainer"> Du är inloggad som <b><?php echo $user->getUsername(); ?></b></div>
				<?php } ?>
			</div>
		</div>
		<div id="maincontainer">
			
			<?php if($isLogedIn){ ?>
			
			<div id="leftbar">
				<div id="leftbarcontent">
					<ul>
						
						<?php if($user->isCustomerUser()) { ?>
						<li class="heading">Kund</li>
						<li class="link"><a href="customer_order.php">Lägg ny beställning</a></li>
						<li class="link"><a href="customer_orders.php">Mina beställningar</a></li>
						<hr>
						<li class="link"><a href="customer_edit.php">Mina uppgifter</a></li>
						<?php } ?>
						
						<?php if($user->isSuperUser()) { ?>
						<li class="heading">Administration</li>
						<li class="link"><a href="log.php">Logg</a></li>
						<li class="link"><a href="create_user.php">Skapa ny användare</a></li>
						<li class="link"><a href="delete_user.php">Radera användare</a></li>
						<?php } ?>
						
						<?php if($user->isSuperUser() || $user->isMaterialUser()) { ?>
						<li class="heading">Material & recept</li>
						<li class="link"><a href="materials.php">Material</a></li>
						<li class="link"><a href="recipes.php">Recept</a></li>
						<?php } ?>
						
						<?php if($user->isSuperUser() || $user->isProductionUser()) { ?>
						<li class="heading">Produktion</li>
						<li class="link"><a href="pallets.php">Producera/sök pallar</a></li>
						<li class="link"><a href="blocking.php">Blockera pallar</a></li>
						<?php } ?>
						
						<?php if($user->isSuperUser() || $user->isOrderUser()) { ?>
						<li class="heading">Ordrar & leveranser</li>
						<?php } ?>
						
					</ul>
				</div>
			</div>
			<div id="mainbar">
				<div id="mainbarcontenttest">
					
			<?php } ?>