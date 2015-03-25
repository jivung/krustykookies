<?php
/*
 * Class Database: interface to the movie database from PHP.
 *
 * You must:
 *
 * 1) Change the function userExists so the SQL query is appropriate for your tables.
 * 2) Write more functions.
 *
 */
class Database {
	private $host;
	private $userName;
	private $password;
	private $database;
	private $conn;
	
	/**
	 * Constructs a database object for the specified user.
	 */
	public function __construct($host, $userName, $password, $database) {
		$this->host = $host;
		$this->userName = $userName;
		$this->password = $password;
		$this->database = $database;
	}
	
	/** 
	 * Opens a connection to the database, using the earlier specified user
	 * name and password.
	 *
	 * @return true if the connection succeeded, false if the connection 
	 * couldn't be opened or the supplied user name and password were not 
	 * recognized.
	 */
	public function openConnection() {
		try {
			$this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", 
					$this->userName,  $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			$error = "Connection error: " . $e->getMessage();
			print $error . "<p>";
			unset($this->conn);
			return false;
		}
		return true;
	}
	
	/**
	 * Closes the connection to the database.
	 */
	public function closeConnection() {
		$this->conn = null;
		unset($this->conn);
	}

	/**
	 * Checks if the connection to the database has been established.
	 *
	 * @return true if the connection has been established
	 */
	public function isConnected() {
		return isset($this->conn);
	}
	
	/**
	 * Execute a database query (select).
	 *
	 * @param $query The query string (SQL), with ? placeholders for parameters
	 * @param $param Array with parameters 
	 * @return The result set
	 */
	private function executeQuery($query, $param = null) {
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute($param);
			$result = $stmt->fetchAll();
		} catch (PDOException $e) {
			$error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		return $result;
	}
	
	/**
	 * Execute a database update (insert/delete/update).
	 *
	 * @param $query The query string (SQL), with ? placeholders for parameters
	 * @param $param Array with parameters 
	 * @return The number of affected rows
	 */
	private function executeUpdate($query, $param = null) {
		
		try {
			$stmt = $this->conn->prepare($query);
			$i=1;
			foreach($param as &$par){
				$stmt->bindParam($i, $par);
				$i++;
			}
			$result = $stmt->execute();
		} catch (PDOException $e) {
			$error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		return $result;
	}
	
	/**
	 * Check if a user with the specified user id exists in the database.
	 * Queries the Users database table.
	 *
	 * @param userId The user id 
	 * @return true if the user exists, false otherwise.
	 */
	public function userExists($userId) {
		$sql = "SELECT userName FROM users WHERE userName = ?";
		$result = $this->executeQuery($sql, array($userId));
		return count($result) == 1; 
	}
	
	/**
	*Check if the provided password is correct.
	*Verifies hashed passwords.
	*Queries the Users database table.
	*
	*@param userName The userName
	*@param passWord The password
	*
	*@return true if the password is correct, false otherwise.
	*/
	public function checkPassword($userName, $passWord){
		$sql = "SELECT passWord FROM users WHERE userName = ?";
		$result = $this->executeQuery($sql, array($userName));
		foreach($result as $pass){
			$result = $pass[0];
		}
		if (password_verify($passWord, $result)) {
			return true;
		}
		return false;
	}
	
	/**
	*Check if the user is a superuser.
	*Queries the users table in the database.
	*
	*@param userName The userName
	*
	*@return true if the user is a superuser.
	*/
	public function checkSuperUser($userName) {
		$sql = "SELECT isSuperUser FROM users WHERE userName = ?";
		$result = $this->executeQuery($sql, array($userName));
		foreach($result as $res) {
			return $res[0];
		}
	}
		
	/**
	*Check if the user is a user in the material dept.
	*Queries the users table in the database.
	*
	*@param userName The userName
	*
	*@return true if the user is a user in the material dept.
	*/
	public function checkMaterialUser($userName) {
		$sql = "SELECT isMaterialUser FROM users WHERE userName= ?";
		$result = $this->executeQuery($sql, array($userName));
		foreach($result as $res) {
			return $res[0];
		}
	}
	
	/**
	*Check if the user is a user in the pallet (production) dept.
	*Queries the users table in the database.
	*
	*@param userName The userName
	*
	*@return true if the user is a user in the pallet dept.
	*/
	public function checkProductionUser($userName) {
		$sql = "SELECT isProductionUser FROM users WHERE userName= ?";
		$result = $this->executeQuery($sql, array($userName));
		foreach($result as $res) {
			return $res[0];
		}
	}
	
	/**
	*Check if the user is a user in the order and delivery dept.
	*Queries the users table in the database.
	*
	*@param userName The userName
	*
	*@return true if the user is a user in the order and delivery dept.
	*/
	public function checkOrderAndDeliveryUser($userName) {
		$sql = "SELECT isOrderUser FROM users WHERE userName = ?";
		$result = $this->executeQuery($sql, array($userName));
		foreach($result as $res) {
			return $res[0];
		}
	}
	
	/**
	*Check if the user is a customer.
	*Queries the users table in the database..
	*
	*@param userName The userName
	*
	*@return true if the user is a user in the order and delivery dept.
	*/
	public function checkCustomer($userName) {
		$sql = "SELECT isCustomer FROM users WHERE userName = ?";
		$result = $this->executeQuery($sql, array($userName));
		foreach($result as $res) {
			return $res[0];
		}
	}
	
	/**
	*Create a new user.
	*
	*@param userName the name of the new user.
	*@param password the users password.
	*@userType the type of the user.
	*
	**/
	public function createUser($userName, $password, $userType) {
		$sql = "INSERT INTO users(userName, password, ".$userType.") VALUES(?, ?, '1')";
		$result = $this->executeUpdate($sql, array($userName, $password));
	}
	
	/**
	*Delete a user.
	*
	**/
	public function deleteUser($userName) {
		$sql = "DELETE FROM users WHERE userName = ?";
		$result = $this->executeUpdate($sql, array($userName));
	}
	
	/**
	*List all users in the system.
	*
	*@return all users with username.
	*/
	public function listUsers() {
		$sql = "SELECT userName FROM users ORDER BY userName";
		$result = $this->executeQuery($sql);
		return $result;
	}
	
	/**
	*List all users who are NOT superusers in the system.
	*
	*@return all users with username.
	*/
	public function listRegularUsers() {
		$sql = "SELECT userName FROM users WHERE isSuperUser = '0' ORDER BY userName";
		$result = $this->executeQuery($sql);
		return $result;
	}
	
	/**
	*List all customers in the system.
	*
	*@return all customers with username.
	*/
	public function listCustomers() {
		$sql = "SELECT userName FROM users WHERE isCustomer = '1' ORDER BY userName";
		$result = $this->executeQuery($sql);
		return $result;
	}
	
	
	/**
	*Get the user type of a specific user.
	*
	*@param userName name of the user.
	*
	*@return the type of the user.
	*/
	public function getUserType($userName) {
		if ($this->checkSuperUser($userName)) {
			echo "Superuser";
		} else if ($this->checkMaterialUser($userName)) {
			echo "Material Department";
		} else if ($this->checkProductionUser($userName)) {
			echo "Pallet/production Department";
		} else if ($this->checkOrderAndDeliveryUser($userName)) {
			echo "Order/delivery Department";
		} 
	}
	
	/**
	*Increase the stored amount of chosen material.
	*
	*@param material the material to be increased.
	*
	*/
	public function addMaterialAmount($material, $amount) {
		$sql = "UPDATE ingredients SET amount = amount+? WHERE name = ?";
		$result = $this->executeUpdate($sql, array($amount, $material));
	}
	
	/**
	*List all available ingredients and their properties.
	*
	*@return all ingredients with name and amount.
	*/
	public function getIngredients(){
		$sql = "SELECT * FROM ingredients ORDER BY name";
		return $this->executeQuery($sql);
	}
	
}
?>
