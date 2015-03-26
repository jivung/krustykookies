<?php
require_once("includes/database.php");
require_once("includes/user.php");
require_once("includes/setup.php");
require_once("includes/mysql_connect_data.php");
if(!$_SESSION['user']->isSuperUser() && !$_SESSION['user']->isMaterialUser()){
	header("Location: index.php");
}
require_once("includes/header.php");
$recipe = $_GET['r'];
$ingredients = $db->getRecipeIngredients($recipe);
?>

<h1><?php if(isset($_GET['r'])) { echo str_replace('_', ' ', $_GET['r']); } ?></h1>
<p class="breadtext">
	<a href="update_recipe.php">Uppdatera recept</a>
</p>
<p class="normaltext">
Recept för 100 kakor.
</P>
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