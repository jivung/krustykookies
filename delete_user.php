<?php
require_once("includes/database.php");
require_once("includes/user.php");
require_once("includes/setup.php");
require_once("includes/mysql_connect_data.php");
if(!$_SESSION['user']->isSuperUser()){
	header("Location: index.php");
}
require_once("includes/header.php");
$users = $db->listRegularUsers();
$usersLength = count($users);
?>

<script language="JavaScript">
function toggle(source) {
  checkboxes = document.getElementsByName('user[ ]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>

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

<table id="materialtable">
	<tr>
		<td style="background-color: #FFF"><b>Användarnamn</b></td>
		<td style="background-color: #FFF"><b>Kontotyp</b></td>
		<td style="background-color: #FFF"><input type="checkbox" onClick="toggle(this)" />Välj alla<br/></td>
	</tr>
	<form name="deleteuser "id="deleteuser" method="POST" action="includes/deleteuser_parse.php">
	<?php foreach($users as $user){ ?>
	<tr> 
		<td><?php echo str_replace('_', ' ', $user['userName']); ?></td>
		<td><?php echo $db->getUserType($user['userName']); ?></td>
		
		<td style="background-color: #FFF"><input type="checkbox" name="user[ ]" value="<?php echo $user['userName']; ?>"/></d>
		
		<!-- <td style="background-color: #FFF"><a href="includes/add_material_parse.php?mat=<?php echo $ingredient['name']; ?>">Lägg till</a></td> -->
	</tr>
	<?php } ?>
	<tr>
		<td style="background-color: #FFF"></td>
		<td style="background-color: #FFF; padding-right: 0;"></td>
		<td style="background-color: #FFF"><input type="submit" class="submit_button_login"" name="submit" value="Radera" /></td>
	</tr>
	</form>
</table>
<?php
require_once("includes/footer.php");
?>