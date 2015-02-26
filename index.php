<!DOCTYPE html>
<?php 
require_once("includes/database.inc.php");
require_once("includes/setup.php");
?>
<html>
	<head>
		<title>
			Krusty Kookies Database System
		</title>
		<link type="text/css" rel="stylesheet" href="includes/stylesheet.css" />
	</head>
	<body>
		<div id="topbanner">
			<div id="topcontainer">
				<div id="logocontainer">
					<a class="logo" href="index.php">KRUSTY KOOKIES</a>
				</div>
				<?php 
					//Display user info if logged in.
					if(isset($_SESSION['username'])){
						include_once("includes/userinfo.php");
					}
				?>
			</div>
		</div>
		<?php 
			//Display loginbox if not logged in.
			if(!isset($_SESSION['username'])){
				include_once("includes/loginbox.php");
			}
		?>
		<?php
		
		?>
	</body>
</html>