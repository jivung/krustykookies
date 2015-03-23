<?php
require_once("includes/setup.php");
require_once("includes/database.php");
require_once("includes/mysql_connect_data.php");
$readmePage = true;
$loginPage = false;
require_once("includes/header.php");
?>

<?php 
if($isLogedIn){ 
	include_once("includes/support.txt");
} else { ?>
<div id="unloggedbox">
	<div id="unloggedboxcontent">
		<?php include_once("includes/support.txt"); ?>
	</div>
</div>
<?php } ?>
<?php
require_once("includes/footer.php");
?>