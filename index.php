<?php 
require_once("includes/setup.php");
require_once("includes/database.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			Krusty Kookies Database System
		</title>
		<meta charset="utf8"/>
		<link type="text/css" rel="stylesheet" href="includes/stylesheet.css" />
	</head>
	<body>
		<!--<div id="toptopbanner">
			<<div id="toptopcontainer">
				<div id="readmecontainer">
					README - INFORMATION - SUPPORT
				</div>
			</div>
		</div>-->
		<div id="topbanner">
			<div id="topcontainer">
				<div id="logocontainer">
					<a class="logo" href="index.php">KRUSTY KOOKIES DATABASE SYSTEM</a>
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
			//Display loginbox if not logged in, else show content appropriate to usertype.
			if(!isset($_SESSION['username'])){
				include_once("includes/loginbox.php");
			} else {
				include_once("includes/content.php");
			}
		?>
		<?php
		
		?>
	</body>
</html>