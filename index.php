<?php
require_once("includes/setup.php");
require_once("includes/database.php");
require_once("includes/mysql_connect_data.php");
require_once("includes/header.php");
?>

<h1>Hej och välkommen!</h1>

<p class="breadtext">
	Du är inloggad som <b><?php echo $_SESSION['username'] ?></b>, och har <i>
	<?php 
		$db->openConnection();
		if($db->checkSuperUser($_SESSION['username'])) {
	?>
	alla 
	<?php	
		} else if($db->checkProductionUser($_SESSION['username'])) {
	?>
	produktions-
	<?php	
		} else if($db->checkMaterialUser($_SESSION['username'])) {
	?>
	material-
	<?php	
		} else if($db->checkOrderUser($_SESSION['username'])) {
	?>
	order-
	<?php	
		} else {
	?>
	inga 
	<?php	
		}
		$db->closeConnection();
	?>
	</i>privilegier.
</p>

<p class="normaltext">
	Använd menyn till vänster för att manövrera systemet. Vid eventuella frågor, alternativt support, hänvisas till valen högst upp till höger på sidan.<br/>
</p>
<p class="footnote">
	Jobba på så chefen blir nöjd, och kom ihåg att ha en trevlig arbetsdag! (OBS! inga kaffepauser på arbetstid)
</p>

<?php
require_once("includes/footer.php");
?>