<?php
require_once("includes/database.php");
require_once("includes/user.php");
require_once("includes/setup.php");
require_once("includes/mysql_connect_data.php");
require_once("includes/header.php");

if(isset($_POST['block'])){
	
	// Hämtar sökt tidgaste produktionstid
	if(!empty($_POST['fromTime'])){
		$_POST["fromTime"] = trim($_POST["fromTime"]);
		if(validateTime($_POST['fromTime'])){
			$fromTime = strtotime($_POST['fromTime']);
		} else{
			$fromTimeError = true;
		}
	}
	
	// Hämtar sökt senaste produktionstid
	if(!empty($_POST['toTime'])){
		$_POST["toTime"] = trim($_POST["toTime"]);
		if(validateTime($_POST['toTime'])){
			$toTime = strtotime($_POST['toTime']) + 59;
		} else{
			$toTimeError = true;
		}
	}
	
	// Blockerar pallar
	if(!$fromTimeError && !$toTimeError){
		$numBlocked = $db->blockPallets($_POST['recipeName'], $fromTime, $toTime);
	}
	
}


?>

<h1>Blockera pallar</h1>

<form action="blocking.php" method="post">
	<table id="pallettable">
		<tr>
			<td>Recept</td>
			<td>Tidigaste produktionstid</td>
			<td>Senaste produktionstid</td>
			<td></td>
		</tr>
		<tr>
			<td>
				<select name="recipeName">
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
			<td>
				<input type="submit" name="block" value="Blockera" />
			</td>
		</tr>
	</table>
</form>
<span class="breadtext">
<?php 
if(isset($_POST['block'])){
	 echo "<p>" . $numBlocked . " st pallar blockerades.</p>"; 
}
?>
</span>
<?php
require_once("includes/footer.php");
?>