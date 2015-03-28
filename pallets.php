<?php
require_once("includes/pallet.php");
require_once("includes/database.php");
require_once("includes/user.php");
require_once("includes/setup.php");
require_once("includes/mysql_connect_data.php");

function validateDate($date){
    $d = DateTime::createFromFormat("Y-m-d H:i", $date);
    return $d && $d->format("Y-m-d H:i") == $date;
}

$db = new Database($host, $userName, $password, $database);

// Skapar ny pall
if(isset($_POST['create'])){
	if($db->checkRecipeIngredients($_POST['createRecipeName'])){
		$db->addPallet($_POST['createRecipeName']);
	} else{
		$insufficientIngredients = true;
	}
}

// Hämtar sökt tidgaste produktionstid
if(!empty($_POST['fromTime'])){
	$_POST["fromTime"] = trim($_POST["fromTime"]);
	if(validateDate($_POST['fromTime'])){
		$fromTime = strtotime($_POST['fromTime']);
	} else{
		$fromTimeError = true;
	}
}

// Hämtar sökt senaste produktionstid
if(!empty($_POST['toTime'])){
	$_POST["toTime"] = trim($_POST["toTime"]);
	if(validateDate($_POST['toTime'])){
		$toTime = strtotime($_POST['toTime']) + 59;
	} else{
		$toTimeError = true;
	}
}

// Hämtar sökta pallar
$pallets = $db->getPallets($_POST['id'], $_POST['recipeName'], $fromTime, $toTime);

require_once("includes/header.php");
?>

<h1>Pallar</h1>

<h2>Producera ny pall</h2>

<form action="pallets.php" method="POST">
	<select name="createRecipeName">
		<?php 
		$recipes = $db->getRecipes();
		foreach($recipes as $recipe){
			if($_POST['createRecipeName'] == $recipe['name']){
				echo "<option selected>"; 
			} else{
				echo "<option>";
			}
			echo $recipe['name'] . "</option>";
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

<h2>Sök pallar</h2>

<form action="pallets.php" method="POST">
	
	<table>
		<tr>
			<td>Id</td>
			<td>Recept</td>
			<td>Tidigaste produktionstid</td>
			<td>Senaste produktionstid</td>
			<td></td>
		</tr>
		<tr>
			<td>
				<input type="text" name="id" placeholder="id" value="<?php if(!empty($_POST['id'])){ echo $_POST['id']; } ?>"/>
			</td>
			<td>
				<select name="recipeName">
				<option value="all">Alla sorter</option>
				<?php 
				$recipes = $db->getRecipes();
				foreach($recipes as $recipe){
					if($_POST['recipeName'] == $recipe['name']){
						echo "<option selected>"; 
					} else{
						echo "<option>";
					}
					echo $recipe['name'] . "</option>";
				} 
				?>
				</select>
			</td>
			<td>
				<input type="text" name="fromTime" placeholder="ÅÅÅÅ-MM-DD TT:MM" value="<?php if($_POST['fromTime']){ echo $_POST['fromTime']; } ?>" />
			</td>
			<td>
				<input type="text" name="toTime" placeholder="ÅÅÅÅ-MM-DD TT:MM" value="<?php if($_POST['toTime']){ echo $_POST['toTime']; } ?>" />
			</td>
			<td>
				<input type="submit" name="search" value="Sök" />
			</td>
		</tr>
		
	</table>

</form>

<?php 
if($fromTimeError){ 
	echo "<p class='error'>Tidgaste produktionstid är av fel format. Det ska vara t.ex. 2014-04-01 12:40.</p>";	
}
if($toTimeError){ 
	echo "<p class='error'>Senaste produktionstid är av fel format. Det ska vara t.ex. 2014-04-01 12:40.</p>";	
}
?>

<br/>

<?php if(count($pallets)){ ?>

<p><?php echo count($pallets); ?> träffar</p>

<table id="materialtable">
	<tr>
		<td style="background-color: #FFF"><b>Id</b></td>
		<td style="background-color: #FFF"><b>Recept</b></td>
		<td style="background-color: #FFF"><b>Plats</b></td>
		<td style="background-color: #FFF"><b>Produktionstid</b></td>
		<td style="background-color: #FFF"><b>Är blockerad</b></td>
		<td style="background-color: #FFF"><b>Kund</b></td>
		<td style="background-color: #FFF"><b>Leveranstid</b></td>
	</tr>
	
	<?php 
	foreach($pallets as $pallet){
	?>
	<tr> 
		<td><?php echo $pallet->getId(); ?></td>
		<td><a href="pallet.php?id=<?php echo $pallet->getId(); ?>" class="material"><?php echo $pallet->getRecipeName(); ?></a></td>
		<td><?php echo $pallet->getLocation(); ?></td>
		<td><?php echo $pallet->getProductionTime(); ?></td>
		<td><?php echo $pallet->isBlocked(); ?></td>
		<td><?php echo $pallet->getCustomerName(); ?></td>
		<td><?php echo $pallet->getDeliveryTime(); ?></td>
	</tr>
	<?php } ?>
	</form>
</table>

<?php } else if($_POST['search']){ ?>

<p>Hittade ingen pall med sökta kriterier.</p>

<?php } else{ ?>

<p>Det finns inga pallar. Klicka på Skapa pall här ovanför.</p>

<?php } ?>

<?php
require_once("includes/footer.php");
?>