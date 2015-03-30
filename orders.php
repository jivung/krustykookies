<?php
require_once("includes/database.php");
require_once("includes/user.php");
require_once("includes/setup.php");
require_once("includes/mysql_connect_data.php");
if(!$_SESSION['user']->isSuperUser() && !$_SESSION['user']->isMaterialUser()){
	header("Location: index.php");
}
require_once("includes/header.php");
$orders = $db->getOrders();
?>   
<h1>Ordrar</h1>
<?php
if (isset($_GET['success'])) {
?>
<p class="breadtext" style="color: green">
	Ökningen lyckades! :)
</p>
<?php
}
?>
<table id="materialtable">
	<tr>
		<td style="background-color: #FFF"><b>Kund</b></td>
		<td style="background-color: #FFF"><b>Önskad lev.</b></td>
		<td style="background-color: #FFF"><b>Leverans</b></td>
		
	</tr>
	<?php
	foreach($orders as $order){ 
	$company = $db->getCompany($order['userName']);
	$db->checkPallets($order['id']);
	?>
	
	<tr> 
		<td><?php echo str_replace('_', ' ', $company); ?></a></td>
		<td><?php echo $order['wantedDate']; ?></td>
		<td>
		<?php if($order['deliveryTime'] !== NULL) { echo $order['deliveryTime']; } else { echo "Inte levererad"; } ?>
		<td style="background-color: #FFF">
		<?php if($order['sendTime'] == NULL) {
		?>
		<form name="sendorder "id="sendorder" method="POST" action="includes/sendorder.php">
		<input type="hidden" name="orderid" value="<?php echo $order['id'] ?>"/>
		<input type="submit" class="submit_button_login"" name="submit" value="Skicka" />
		</form>
		<?php	
		} ?>
		</td>
		<td style="background-color: #FFF">
		<?php if($order['deliveryTime'] == NULL && $order['sendTime'] !== NULL) {
		?>
		<form name="deliverorder "id="deliverorder" method="POST" action="includes/deliverorder.php">
		<input type="hidden" name="orderid" value="<?php echo $order['id'] ?>"/>
		<input type="submit" class="submit_button_login"" name="submit" value="Leverera" />	
		</form>
		<?php
		} ?>
		</td>
		<td style="background-color: #FFF"></td>
		
		<!-- <td style="background-color: #FFF"><a href="includes/add_material_parse.php?mat=<?php echo $ingredient['name']; ?>">Lägg till</a></td> -->
	</tr>
	<?php } ?>

	</form>
</table>

<?php
require_once("includes/footer.php");
?>