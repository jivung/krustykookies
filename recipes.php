<?php
require_once("includes/database.php");
require_once("includes/user.php");
require_once("includes/setup.php");
require_once("includes/mysql_connect_data.php");
if(!$_SESSION['user']->isSuperUser() && !$_SESSION['user']->isMaterialUser()){
	header("Location: index.php");
}
require_once("includes/header.php");
$recepies = $db->getRecipes();
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