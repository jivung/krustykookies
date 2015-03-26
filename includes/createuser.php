<?php 
require_once("database.php");
require_once("user.php");
require_once("setup.php");
require_once("mysql_connect_data.php");
$db = new Database($host, $userName, $password, $database);
$page = $_GET['page'];
?>
<div id="mainbarcontenttest">
	<h1>Skapa användarkonto</h1>
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
</div>