<?php
require_once("includes/database.php");
require_once("includes/user.php");
require_once("includes/setup.php");
require_once("includes/mysql_connect_data.php");
if(!$_SESSION['user']->isCustomerUser()){
	header("Location: index.php");
}
require_once("includes/header.php");
?>

<h1>Mina uppgifter</h1>
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
		Användarkontot redigerades framgångsrikt! :)
		</p>
<?php
	}
?>
</p>
<p class="normaltext">
<?php 
$customer = $db->getCustomer($_SESSION['username']);
foreach($customer as $cust) {
?>
<b>Företagsnamn: </b><?php echo str_replace('_', ' ', $cust['fullName']); ?><br />
<b>Address: </b><?php echo str_replace('_', ' ', $cust['address']); ?></br >
<?php
}
?>
</p>
<form name="editcustomer "id="editcustomer" method="POST" action="includes/customer_edit_parse.php">
	<input type="hidden" name="userName" value="<?php echo $_SESSION['username'] ?>"/>
	<input type="text" class="input_field_login" name="fullName" placeholder="Företagsnamn"/><br /><br />
	<input type="text" class="input_field_login" name="address" placeholder="Address"/><br /><br />
	<input type="submit" class="submit_button_login" style="float: right" name="submit" value="Spara" />
</form>

<?php
require_once("includes/footer.php");
?>