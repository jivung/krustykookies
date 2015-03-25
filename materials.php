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

<table id="materialtable">
	<tr>
		<td style="background-color: #FFF"><b>Material</b></td>
		<td style="background-color: #FFF"><b>Mängd</b></td>
	</tr>
	<?php foreach($ingredients as $ingredient){ ?>
	<tr>
		<td><?php echo $ingredient['name']; ?></td>
		<td><?php echo $ingredient['amount']; ?> enheter</td>
		<td style="background-color: #FFF"><a href="">Lägg till</a></td>
	</tr>
	<?php } ?>
</table>

<?php
require_once("includes/footer.php");
?>