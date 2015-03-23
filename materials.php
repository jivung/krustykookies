<?php
require_once("includes/setup.php");
require_once("includes/database.php");
require_once("includes/mysql_connect_data.php");
require_once("includes/header.php");
$db->openConnection();
$ingredients = $db->getIngredients();
$db->closeConnection();

?>

<h1>Material</h1>

<table>
	<?php foreach($ingredients as $ingredient){ ?>
	<tr>
		<td><?php echo $ingredient['name']; ?></td>
		<td><?php echo $ingredient['amount']; ?></td>
	</tr>
	<?php } ?>
</table>

<?php
require_once("includes/footer.php");
?>