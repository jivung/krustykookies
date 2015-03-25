<?php
require_once("includes/setup.php");
require_once("includes/database.php");
require_once("includes/mysql_connect_data.php");
require_once("includes/header.php");
$db = new Database($host, $userName, $password, $database);
$db->openConnection();
if(!$db->checkCustomer($_SESSION['username'])) {
	$db->closeConnection();
	header("Location: index.php");
}
$db->closeConnection();
?>

<h1>Lägg ny beställning</h1>
<?php
	if(isset($_GET['empty'])) {
?>
		<p class ="breadtext" style="color: red";>
		Något fält lämnades tomt, försök igen.
		</p>
<?php
		} else if(isset($_GET['false'])) {
?>
		<p class ="breadtext" style="color: red";>
		Lösenorden överensstämmer ej, försök igen.
		</p>
<?php
	} else if(isset($_GET['success'])) {
?>
		<p class ="breadtext" style="color: green";>
		Beställningen lades framgångsrikt! :)
		</p>
<?php
	}
?>
</p>
<form name="placeorder "id="placeorder" method="POST" action="includes/customer_order_parse.php">
	
	<input type="submit" class="submit_button_login" style="float: right" name="submit" value="Lägg beställning" />
</form>

<?php
require_once("includes/footer.php");
?>