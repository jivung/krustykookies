<?php
require_once("includes/setup.php");
require_once("includes/database.php");
require_once("includes/mysql_connect_data.php");
require_once("includes/header.php");
$db->openConnection();
if(!($db->checkSuperUser($_SESSION['username']) == "1" || $db->checkMaterialUser($_SESSION['username']) == '1')) {
	$db->closeConnection();
	header("Location: index.php");
}
$recipe = $_GET['r'];
$ingredients = $db->getRecipeIngredients($recipe);
$db->closeConnection();

?>
<h1><?php if(isset($_GET['r'])) { echo str_replace('_', ' ', $_GET['r']); } ?></h1>
<p class="breadtext">
	<a href="update_recipe.php">Uppdatera recept</a>
</p>
<table id="materialtable">
	<tr>
		<td style="background-color: #FFF"><b>Ingrediens</b></td>
		<td style="background-color: #FFF"><b>Mängd (gram)</b></td>
	</tr>
	<?php
	foreach($ingredients as $ingredient){ ?>
	<tr> 
		<td><?php echo str_replace('_', ' ', $ingredient['ingredientName']); ?></td>	
		<td><?php echo $ingredient['amount']; ?></td>
	</tr>
	<?php } ?>
</table>
<?php
require_once("includes/footer.php");
?>