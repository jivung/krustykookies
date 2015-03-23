<?php
require_once("includes/setup.php");
require_once("includes/database.php");
require_once("includes/mysql_connect_data.php");
require_once("includes/header.php");
$db = new Database($host, $userName, $password, $database);
$db->openConnection();
if(!$db->checkSuperUser($_SESSION['username'])) {
	header("Location: index.php");
}
?>

<h1>Radera användarkonto</h1>
<?php
	if(isset($_GET['success'])) {
?>
		<p class ="breadtext" style="color: green";>
		Användaren/na raderades framgångsrikt.
		</p>
<?php
	}
?>
<form name="deleteuser "id="deleteuser" method="POST" action="includes/deleteuser_parse.php">
<label for="select">
<p class="breadtext">Välj en eller flera (ctrl/shift+klick) användare att radera:</p>
</label>
<?php
	$users = $db->listRegularUsers();
	$usersLength = count($users);
?>
<select name="user[ ]" id="user" size="<?php echo $usersLength; ?>" multiple="multiple">
<?php
	foreach($users as $user => $u) {
?>
<option value="<?php echo $u['userName']; ?>"><?php echo $u['userName']; ?> - <?php $db->getUserType($u['userName']); ?></option>
<?php
	}
?>
</select>
<br />
<input type="submit" class="submit_button_login" style="float: right" name="submit" value="Radera användare" />
</form>
<?php
require_once("includes/footer.php");
?>