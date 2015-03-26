<?php
require_once("includes/database.php");
require_once("includes/user.php");
require_once("includes/setup.php");
require_once("includes/mysql_connect_data.php");
if(!$_SESSION['user']->isSuperUser()){
	header("Location: index.php");
}
require_once("includes/header.php");
?>

<h1>Logg</h1>
<p class="breadtext">Ännu inte implementerad (för dålig lön för mödan).</p>
<p class="normaltext">Kontakta supporten för bristfällig information.</p>
<p class="footnote">Disclaimer: svar kan dröja obestämd tid.</p>

<?php
require_once("includes/footer.php");
?>