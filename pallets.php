<?php
require_once("includes/pallet.php");
require_once("includes/database.php");
require_once("includes/user.php");
require_once("includes/setup.php");
require_once("includes/mysql_connect_data.php");

$db = new Database($host, $userName, $password, $database);

// Skapar ny pall
if(isset($_POST['create'])){
	if($db->checkRecipeIngredients($_POST['recipeName'])){
		$db->addPallet($_POST['recipeName']);
	} else{
		$insufficientIngredients = true;
	}
}

// Söker pall
if(isset($_POST['search']) && !empty($_POST['id'])){
	$pallet = $db->getPallet($_POST['id']);
	if($pallet != null){
		$pallets = array($pallet);
	} 
} else{
	$pallets = $db->getPallets();
}

require_once("includes/header.php");

?>

<h1>Pallar</h1>

<h2>Producera ny pall</h2>

<form action="pallets.php" method="POST">
	<select name="recipeName">
		<?php 
		$recipes = $db->getRecipes();
		foreach($recipes as $recipe){
			echo "<option>". $recipe['name'] . "</option>";
		} 
		?>
	</select>
	<input type="submit" value="Skapa" name="create" />
</form>

<?php

if($insufficientIngredients){
	echo "<p class='error'>Pallen kunde inte produceras. Det saknas ingredienser.</p>";
}	

?>

<h2>Sök pall</h2>

<form action="pallets.php" method="POST">
	<input type="text" name="id" placeholder="id" value="<?php if(!empty($_POST['id'])){ echo $_POST['id']; } ?>"/>
	<input type="submit" name="search" value="Sök" />
</form>
<br/>

<?php if(count($pallets)){ ?>

<table id="materialtable">
	<tr>
		<td style="background-color: #FFF"><b>Id</b></td>
		<td style="background-color: #FFF"><b>Recept</b></td>
		<td style="background-color: #FFF"><b>Plats</b></td>
		<td style="background-color: #FFF"><b>Är blockerad</b></td>
		<td style="background-color: #FFF"><b>Kund</b></td>
		<td style="background-color: #FFF"><b>Leveransdatum</b></td>
	</tr>
	
	<?php 
	foreach($pallets as $pallet){
	?>
	<tr> 
		<td><?php echo $pallet->getId(); ?></td>
		<td><a href="pallet.php?id=<?php echo $pallet->getId(); ?>" class="material"><?php echo $pallet->getRecipeName(); ?></a></td>
		<td><?php echo $pallet->getLocation(); ?></td>
		<td><?php echo $pallet->isBlocked(); ?></td>
		<td><?php echo $pallet->getCustomerName(); ?></td>
		<td><?php echo $pallet->getDeliveryDate(); ?></td>
	</tr>
	<?php } ?>
	</form>
</table>

<?php } else if(!empty($_POST['id'])){ ?>

<p>Hittade ingen pall med sökt id.</p>

<?php } else{ ?>

<p>Det finns inga pallar. Klicka på Skapa pall här ovanför.</p>

<?php } ?>

<?php
require_once("includes/footer.php");
?>