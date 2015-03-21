<?php
require_once("includes/setup.php");
require_once("includes/database.php");
require_once("includes/mysql_connect_data.php");
	
if(!empty($_POST)){

	$db = new Database($host, $userName, $password, $database);
	$db->openConnection();
	
	if (!$db->isConnected()) {
		$error = 'connect';
	}
	
	$user = $_POST['krustyname'];
	$userPassword = $_POST['krustypassword'];
	
	if (empty($user) || empty($userPassword)) {
		$error = 'empty';
	} else{
		if(!($db->checkPassword($user, $userPassword))) {
			$error = 'no_user';
		}
	}

	$db->closeConnection();
	
	if(!$error){
	
		$_SESSION['username'] = $user;
		$_SESSION['db'] = $db;
	
		// success!
		header("Location: index.php");
	
	}

}

$loginPage = true;
require_once("includes/header.php");
	
?>

<div id="logincontainer">
	<div id="loginheader">
		INLOGGNING
	</div>
	<div id="loginwindow">		
		<div id="loginformcontainer">
			<form name="loginform" id="loginform" method="POST" action="login.php">
				<div id="loginputfieldcontainer">
					<input type="text" class="input_field_login" name="krustyname" placeholder="användarnamn"/>
				</div>
				<div id="loginputfieldcontainer">
					<input type="password" class="input_field_login" name="krustypassword" placeholder="lösenord"/>
				</div>
				<div id="loginmessagecontainer">
					<?php
						if($error == 'no_user') { echo "Fel användarnamn eller lösenord. Försök igen."; }
						else if($error == 'empty') { echo "Användarnamn eller lösenord tomt. Försök igen."; }
					?>
				</div>
				<div id="loginsubmitcontainer">
					<input type="submit" class="submit_button_login" name="submit" value="Logga in" />
				</div>
			</form>
		</div>		
	</div>
</div>

<?php
require_once("includes/footer.php");
?>