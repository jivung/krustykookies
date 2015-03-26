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
$recepies = $db->getRecipes();
$db->closeConnection();

?>
<h1>Recept</h1>
<p class="breadtext">
	<a href="create_recipe.php">Lägg till recept</a>
</p>
<table id="materialtable">	
	<?php
	foreach($recepies as $recipe){ ?>
	<tr> 
		<td><a href="recipe.php?r=<?php echo $recipe['name']; ?>" class="material"><?php echo str_replace('_', ' ', $recipe['name']); ?></a></td>	
		
	</tr>
	<?php } ?>
</table>

<?php
require_once("includes/footer.php");
?>