				<div id="logout">
					<form name="logoutform" id="logoutform" method=POST" action="includes/logout.php" >
						<input type="submit" class="submit_button_logout" name="submit" value="Logga ut" />
					</form>
				</div>
				<div id="statuscontainer">
					
					Du är inloggad som <b><?php echo $_SESSION['username']; ?></b>
					
				</div>