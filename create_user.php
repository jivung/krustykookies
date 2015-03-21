<?php
require_once("includes/setup.php");
require_once("includes/database.php");
require_once("includes/mysql_connect_data.php");
require_once("includes/header.php");
?>

<h1>Skapa användarkonto</h1>
<form id="createuser" method="POST">
	<input type="text" class="input_field_login" name="krustyname" placeholder="användarnamn"/><br />
	<input type="password" class="input_field_login" name="krustypassword" placeholder="lösenord"/>
	<input type="password" class="input_field_login" name="krustypassword2" placeholder="upprepa lösenord"/>
	<fieldset style="width: 300px;">
	<legend>Kontotyp</legend>
	<input type="radio" name="kontotyp" id="superuser" value="var" />
	<label for="superuser">SuperUser</label> <br />
	<input type="radio" name="kontotyp" id="material" value="sommar" />
	<label for="material">Material</label> <br />
	<input type="radio" name="kontotyp" id="produktion" value="host" />
	<label for="produktion">Produktion</label> <br />
	<input type="radio" name="kontotyp" id="Ordrar" value="vinter" />
	<label for="ordrar">Ordrar</label>
	</fieldset>
</form>

<?php
require_once("includes/footer.php");
?>