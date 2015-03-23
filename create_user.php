<?php
require_once("includes/setup.php");
require_once("includes/database.php");
require_once("includes/mysql_connect_data.php");
require_once("includes/header.php");
$db = new Database($host, $userName, $password, $database);
$db->openConnection();
if(!$db->checkSuperUser($_SESSION['username'])) {
	$db->closeConnection();
	header("Location: index.php");
}
$db->closeConnection();
?>

<h1>Skapa användarkonto</h1>
<?php
	if(isset($_GET['empty'])) {
?>
		<p class ="breadtext" style="color: red";>
		Något fält lämnades tomt, försök igen.
		</p>
<?php
		} else if(isset($_GET['false'])) {
?>
		<p class ="breadtext" style="color: red";>
		Lösenorden överensstämmer ej, försök igen.
		</p>
<?php
	} else if(isset($_GET['success'])) {
?>
		<p class ="breadtext" style="color: green";>
		Användarkontot skapades framgångsrikt! :)
		</p>
<?php
	}
?>
</p>
<form name="createuser "id="createuser" method="POST" action="includes/createuser_parse.php">
	<input type="text" class="input_field_login" name="krustyname" placeholder="användarnamn"/><br /><br />
	<input type="password" class="input_field_login" name="krustypassword" placeholder="lösenord"/><br /><br />
	<input type="password" class="input_field_login" name="krustypassword2" placeholder="upprepa lösenord"/><br /><br />
	<fieldset>
	<legend>Kontotyp</legend>
	<input type="radio" name="kontotyp" id="superuser" value="isSuperUser" />
	<label for="superuser">SuperUser</label> <br />
	<input type="radio" name="kontotyp" id="material" value="isMaterialUser" />
	<label for="material">Material & Recept</label> <br />
	<input type="radio" name="kontotyp" id="produktion" value="isProductionUser" />
	<label for="produktion">Pallar</label> <br />
	<input type="radio" name="kontotyp" id="ordrar" value="isOrderUser" />
	<label for="ordrar">Ordrar & Leveranser</label>
	</fieldset><br />
	<input type="submit" class="submit_button_login" style="float: right" name="submit" value="Skapa konto" />
</form>

<?php
require_once("includes/footer.php");
?>