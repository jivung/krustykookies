<?php
require_once("includes/setup.php");
require_once("includes/database.php");
require_once("includes/mysql_connect_data.php");
require_once("includes/header.php");
$db->openConnection();
$ingredients = $db->getIngredients();
$db->closeConnection();

?>
<script language="JavaScript">
function toggle(source) {
  checkboxes = document.getElementsByName('material[ ]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
<h1>Material</h1>
<?php
if (isset($_GET['success'])) {
?>
<p class="breadtext" style="color: green">
	Ökningen lyckades! :)
</p>
<?php
}
?>
<table id="materialtable">
	<tr>
		<td style="background-color: #FFF"><b>Material</b></td>
		<td style="background-color: #FFF"><b>Mängd</b></td>
		<td style="background-color: #FFF"><input type="checkbox" onClick="toggle(this)" />Välj alla<br/></td>
	</tr>
	<form name="addmatamount "id="addmatamount" method="POST" action="includes/add_material_parse.php">
	<?php foreach($ingredients as $ingredient){ ?>
	<tr> 
		<td><?php echo $ingredient['name']; ?></td>
		<td><?php echo $ingredient['amount']; ?> enheter</td>
		
		<td style="background-color: #FFF"><input type="checkbox" name="material[ ]" value="<?php echo $ingredient['name']; ?>"/></d>
		
		<!-- <td style="background-color: #FFF"><a href="includes/add_material_parse.php?mat=<?php echo $ingredient['name']; ?>">Lägg till</a></td> -->
	</tr>
	<?php } ?>
	<tr>
		<td style="background-color: #FFF"></td>
		<td style="background-color: #FFF; padding-right: 0;"><input type="text" class="input_field_amount" name="amount" placeholder="mängd"/></td>
		<td style="background-color: #FFF"><input type="submit" class="submit_button_login"" name="submit" value="Öka mängd" /></td>
	</tr>
	</form>
</table>

<?php
require_once("includes/footer.php");
?>