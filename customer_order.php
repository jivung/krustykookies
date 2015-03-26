<?php
require_once("includes/database.php");
require_once("includes/user.php");
require_once("includes/setup.php");
require_once("includes/mysql_connect_data.php");
if(!$_SESSION['user']->isCustomerUser()){
	header("Location: index.php");
}
require_once("includes/header.php");
$cookies = $db->getRecipes();
?>

<h1>Lägg ny beställning</h1>
<?php
	if(isset($_GET['empty'])) {
?>
		<p class ="breadtext" style="color: red";>
		Något fält lämnades tomt, försök igen.
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
	<input type="hidden" name="customer"/>
	<table id="materialtable">	
		<tr>
			<td style="background-color: #FFF"><b>Kaka</b></td>
			<td style="background-color: #FFF"><b>Antal pallar</b></td>
		</tr>
		<?php
		foreach($cookies as $cookie){ ?>
			<tr> 
				<td><?php echo str_replace('_', ' ', $cookie['name']); ?></td>	
				<td><input type="text" class="input_field_ingredient" name="<?php echo $cookie['name']; ?>" placeholder="antal"/></td>
			</tr>
		<?php } ?>
		<tr>
			<td style="background-color: #FFF"></td>
			<td style="background-color: #FFF"><input type="submit" class="submit_button_login" style="float: right" name="submit" value="Lägg beställning" /></td>
		</tr>
	</table>
</form>

<?php
require_once("includes/footer.php");
?>