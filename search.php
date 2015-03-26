<?php
require_once("includes/database.php");
require_once("includes/user.php");
require_once("includes/setup.php");
require_once("includes/mysql_connect_data.php");
require_once("includes/header.php");
?>

<h1>Sök pall</h1>

<table id="materialtable">
	<tr>
		<td style="background-color: #FFF"><b>Id</b></td>
		<td style="background-color: #FFF"><b>Recept</b></td>
		<td style="background-color: #FFF"><b>Plats</b></td>
		<td style="background-color: #FFF"><b>Leveransdatum</b></td>
		<td style="background-color: #FFF"><b>Är blockerad</b></td>
		<td style="background-color: #FFF"><b>Kund</b></td>
	</tr>
	<tr> 
		<td>52</td>
		<td>Ring nut</td>
		<td>Frysrummet</td>
		<td>2015-02-02</td>
		<td>Nej</td>
		<td>Rut AB</td>
	</tr>
	</form>
</table>

<?php
require_once("includes/footer.php");
?>