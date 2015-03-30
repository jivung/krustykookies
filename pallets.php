<?php
require_once("includes/pallet.php");
require_once("includes/database.php");
require_once("includes/user.php");
require_once("includes/setup.php");
require_once("includes/mysql_connect_data.php");

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
$pallets = $db->getPallets($_POST['id'], $_POST['recipeName'], $fromTime, $toTime, $_POST['isBlocked'], $_POST['customerName']);

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
				echo "<option selected"; 
			} else{
				echo "<option";
			}
			echo " value='{$recipe['name']}'>";
			echo str_replace("_", " ", $recipe['name']) . "</option>";
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
	
	<table id="pallettable">
		<tr>
			<td>Id</td>
			<td>Recept</td>
			<td>Tidigaste produktionstid</td>
			<td>Senaste produktionstid</td>
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
						echo "<option selected"; 
					} else{
						echo "<option";
					}
					echo " value='{$recipe['name']}'>";
					echo str_replace("_", " ", $recipe['name']) . "</option>";
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
		</tr>
		<tr>
			<td>Är blockerad</td>
			<td>Levererad till</td>
		</tr>
		<tr>
			<td>
				<input type="checkbox" name="isBlocked" <?php if($_POST['isBlocked']){ echo "checked"; } ?>/>
			</td>
			<td>
				<select name="customerName">
				<option value="all">Alla kunder</option>
				<?php 
				$customers = $db->getCustomers();
				foreach($customers as $customer){
					if($_POST['customerName'] == $customer['fullName']){
						echo "<option selected>"; 
					} else{
						echo "<option>";
					}
					echo $customer['fullName'] . "</option>";
				} 
				?>
				</select>
			</td>
		</tr>
		<tr>
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

<?php if(count($pallets)){
	
$db->getPalletCustomerName($pallets[0]->getOrderId());	
?>

<p class="breadtext"><?php echo count($pallets); ?> träffar</p>

<table id="materialtable">
	<tr>
		<td style="background-color: #FFF"><b>Id</b></td>
		<td style="background-color: #FFF"><b>Recept</b></td>
		<td style="background-color: #FFF"><b>Plats</b></td>
		<td style="background-color: #FFF"><b>Produktionstid</b></td>
		<td style="background-color: #FFF"><b>Blockerad</b></td>
		<td style="background-color: #FFF"><b>Kund</b></td>
		<td style="background-color: #FFF"><b>Leveranstid</b></td>
	</tr>
	
	<?php 
	foreach($pallets as $pallet){
	?>
	<tr> 
		<td><?php echo $pallet->getId(); ?></td>
		<td><?php echo str_replace("_", " ", $pallet->getRecipeName()); ?></td>
		<td><?php echo $pallet->getLocation(); ?></td>
		<td><?php echo $pallet->getProductionTime(); ?></td>
		<td><?php echo $pallet->isBlocked(); ?></td>
		<td><?php echo $db->getPalletCustomerName($pallet->getOrderId()); ?></td>
		<td><?php echo $pallet->getDeliveryTime(); ?></td>
	</tr>
	<?php } ?>
	</form>
</table>

<?php } else if($_POST['search']){ ?>

<p class="breadtext">Hittade ingen pall med sökta kriterier.</p>

<?php } else{ ?>

<p class="breadtext">Det finns inga pallar. Klicka på Skapa pall här ovanför.</p>

<?php } ?>

<?php
require_once("includes/footer.php");
?>