<div id="logincontainer">
	<div id="loginheader">
		INLOGGNING
	</div>
	<div id="loginwindow">		
		<div id="loginformcontainer">
			<form name="loginform" id="loginform" method="POST" action="includes/login.php">
				<div id="loginputfieldcontainer">
					<input type="text" class="input_field_login" name="krustyname" placeholder="användarnamn"/>
				</div>
				<div id="loginputfieldcontainer">
					<input type="password" class="input_field_login" name="krustypassword" placeholder="lösenord"/>
				</div>
				<div id="loginmessagecontainer">
					<?php
						if(isset($_GET['false'])) { echo "Fel användarnamn eller lösenord. Försök igen."; }
						elseif(isset($_GET['empty'])) { echo "Användarnamn eller lösenord tomt. Försök igen."; }
						elseif(isset($_GET['no_user'])) { echo "Användaren "; echo $_GET['no_user']; echo " existerar inte.<br />Försök igen."; }
					?>
				</div>
				<div id="loginsubmitcontainer">
					<input type="submit" class="submit_button_login" name="submit" value="Logga in" />
				</div>
			</form>
		</div>		
	</div>
</div>