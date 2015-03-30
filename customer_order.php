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
<?php if(isset($_GET['empty'])) { ?>
		<p class ="breadtext" style="color: red";>
		Du måste välja någon kaka.
		</p>
<?php } else if(isset($_GET['success'])) { ?>
		<p class ="breadtext" style="color: green";>
		Beställningen lades framgångsrikt! :)
		</p>
<?php } else if(isset($_GET['emptyDate'])) { ?>
		<p class ="breadtext" style="color: red";>
		Du måste välja önskat leveransdatum.
		</p>
<?php } else if(isset($_GET['wrongFormat'])) { ?>
		<p class ="breadtext" style="color: red";>
		Önskat leveransdatum är av fel format. Det ska vara t.ex. 2015-05-02
		</p>
<?php } ?>
</p>
<form name="placeorder "id="placeorder" method="POST" action="includes/customer_order_parse.php">
	<input type="hidden" name="customer" value="<?php echo $_SESSION['username'] ?>"/>
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
			<td style="background-color: #FFF">Önskat leveransdatum: </td>
			<td style="background-color: #FFF">
				<input type="submit" class="submit_button_login" style="float: right" name="submit" value="Lägg beställning" />
				<input type="text" class="input_field_ingredient" style="float: left; width: 200px; margin-right:10px" name="wanted" placeholder="ÅÅÅÅ-MM-DD"/>
				</td>
		</tr>
	</table>
</form>

<?php
require_once("includes/footer.php");
?>