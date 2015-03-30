<?php
require_once("includes/database.php");
require_once("includes/user.php");
require_once("includes/setup.php");
require_once("includes/mysql_connect_data.php");
if(!$_SESSION['user']->isCustomerUser()){
	header("Location: index.php");
}
require_once("includes/header.php");
$orders = $db->getCustomerOrders($_SESSION['username']);
?>

<h1>Recept</h1>
<p class="breadtext">
	<a href="create_recipe.php">Lägg till recept</a>
</p>
<table id="materialtable">	
	<tr>
		<td style="background-color: #FFF">OrderID</td>
		<td style="background-color: #FFF">Beställningsdatum</td>
		<td style="background-color: #FFF">Datum skickat</td>
		<td style="background-color: #FFF">Leveransdatum</td>
	</tr>
	<?php
	foreach($orders as $order){ ?>
	<tr> 
		<td><a href="order.php?i=<?php echo $order['id']; ?>" class="material"><?php echo str_replace('_', ' ', $order['id']); ?></a></td>	
		<td><?php echo $order['orderTime']; ?></td>
		<td><?php if($order['sendTime'] != NULL) { echo $order['sendTime']; } else { echo "Inte skickad"; }?></td>
		<td><?php if($order['deliveryTime'] != NULL) { echo $order['deliveryTime']; } else { echo "Inte levererad"; } ?></td>
	</tr>
	<?php } ?>
</table>

<?php
require_once("includes/footer.php");
?>