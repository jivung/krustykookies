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
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$password = password_hash("password", PASSWORD_DEFAULT);

	$sql = "INSERT INTO users (userName, passWord) VALUES ('superuser', '".$password."')";

	if ($conn->query($sql) === TRUE) {
		echo "New superuser created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
?>