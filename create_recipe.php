<?php
require_once("includes/setup.php");
require_once("includes/database.php");
require_once("includes/mysql_connect_data.php");
require_once("includes/header.php");
$db = new Database($host, $userName, $password, $database);
$db->openConnection();
if(!($db->checkSuperUser($_SESSION['username']) == "1" || $db->checkMaterialUser($_SESSION['username']) == '1')) {
	$db->closeConnection();
	header("Location: index.php");
}
$ingredients = $db->getIngredients();
$db->closeConnection();
?>

<h1>Lägg till recept</h1>
<?php
	if(isset($_GET['empty'])) {
?>
		<p class ="breadtext" style="color: red";>
		Något fält lämnades tomt, försök igen.
		</p>
<?php
	} else if(isset($_GET['success'])) {
?>
		<p class ="breadtext" style="color: green";>
		Receptet skapades framgångsrikt! :)
		</p>
<?php
	}
?>
</p>
<form name="createrecipe "id="createrecipe" method="POST" action="includes/createrecipe_parse.php">
	<input type="text" class="input_field_login" name="recipename" placeholder="namn"/><br /><br />
	<table id="materialtable">	
		<tr>
			<td style="background-color: #FFF"><b>Ingrediens</b></td>
		</tr>
		<?php
		foreach($ingredients as $ingredient){ ?>
			<tr> 
				<td><?php echo str_replace('_', ' ', $ingredient['name']); ?></td>	
				<td><input type="text" class="input_field_ingredient" name="<?php echo $ingredient['name']; ?>" placeholder="mängd (g)"/></td>
			</tr>
		<?php } ?>
		<tr>
			<td style="background-color: #FFF"></td>
			<td style="background-color: #FFF"><input type="submit" class="submit_button_login" style="float: right" name="submit" value="Lägg till recept" /></td>
		</tr>
	</table>
</form>

<?php
require_once("includes/footer.php");
?>