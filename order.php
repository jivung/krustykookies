<?php
require_once("includes/database.php");
require_once("includes/user.php");
require_once("includes/setup.php");
require_once("includes/mysql_connect_data.php");
if(!$_SESSION['user']->isSuperUser() && !$_SESSION['user']->isOrderUser()){
	header("Location: index.php");
}
require_once("includes/header.php");
$orderid = $_GET['o'];
$order = $db->getOrder($orderid);
$orderPallets = $db->getOrderPallets($orderid);
?>

<h1>OrderId: <?php if(isset($_GET['o'])) { echo str_replace('_', ' ', $_GET['o']); } ?></h1>
<p class="breadtext">
<b>Kund:</b> 
<?php
foreach($order as $ord) {
	$username = $ord['userName'];
	echo str_replace('_', ' ', $db->getCompany($username));
} 

?>
</p>
<table id="materialtable">
	<tr>
		<td style="background-color: #FFF"><b>Kaka</b></td>
		<td style="background-color: #FFF"><b>Antal pallar</b></td>
	</tr>
	<?php
	foreach($orderPallets as $orderPallet){ if($orderPallet['numPallets'] > 0) {?>
	<tr> 
		<td><?php echo str_replace('_', ' ', $orderPallet['recipeName']); ?></td>	
		<td><?php echo $orderPallet['numPallets'] ?></td>
	</tr>
	<?php } } ?>
</table>
<?php
require_once("includes/footer.php");
?>