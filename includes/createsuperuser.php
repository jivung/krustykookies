<?php
	$servername = "localhost:3307";
	$username = "root";
	$password = "Schecter2011";
	$dbname = "krustykookies";
	
	$servername = "localhost";
	$userName = "root";
	$password = "root";
	$dbname = "krustykookies";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$password = password_hash("password", PASSWORD_DEFAULT);

	$sql = "INSERT INTO users (userName, passWord, isSuperUser) VALUES ('superuser', '".$password."', 1)";

	if ($conn->query($sql) === TRUE) {
		echo "New superuser created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
?>