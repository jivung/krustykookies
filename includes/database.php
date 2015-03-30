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
			$this->conn = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8", 
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
	 * Execute a database query (select).
	 *
	 * @param $query The query string (SQL), with ? placeholders for parameters
	 * @param $param Array with parameters 
	 * @return The result set
	 */
	private function executeQuery($query, $param = null) {
		$this->openConnection();
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute($param);
			$result = $stmt->fetchAll();
		} catch (PDOException $e) {
			$error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		$this->closeConnection();
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
		$this->openConnection();
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
		$this->closeConnection();
		return $stmt->rowCount();
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
	
	public function getUserType($username){
		$sql = "SELECT isSuperUser, isMaterialUser, isProductionUser, isOrderUser, isCustomer FROM users WHERE userName= ?";
		$result = $this->executeQuery($sql, array($username));
		if ($result[0]['isAdmin']) {
			return "admin";
		}
		if($result[0]['isSuperUser']){
			return "super";
		}
		if($result[0]['isMaterialUser']){
			return "material";
		}
		if($result[0]['isProductionUser']){
			return "production";
		}
		if($result[0]['isOrderUser']){
			return "order";
		}
		if($result[0]['isCustomer']){
			return "customer";
		}
	}
	
	/**
	*Increase the stored amount of chosen material.
	*
	*@param material the material to be increased.
	*@param amount the amount by which to increase.
	*
	*/
	public function addMaterialAmount($material, $amount) {
		$sql = "UPDATE ingredients SET amount = amount+? WHERE name = ?";
		$result = $this->executeUpdate($sql, array($amount, $material));
		$this->updateMaterialDelivery($material, $amount);
	}
	
	private function updateMaterialDelivery($material, $amount) {
		$sql = "INSERT INTO ingredientDeliveries(name, amount, deliveryTime) VALUES(?, ?, UNIX_TIMESTAMP(now()))";
		$result = $this->executeUpdate($sql, array($material, $amount));
	
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
	
	public function getLastDelivery($material) {
		$sql = "SELECT amount, FROM_UNIXTIME(deliveryTime, '%Y-%m-%d, %H:%i') AS time FROM ingredientDeliveries WHERE name = ? ORDER BY deliveryTime DESC LIMIT 1";
		$result = $this->executeQuery($sql, array($material));
		return $result;
	}
	
	public function getRecipes() {
		$sql = "SELECT * from recipes ORDER BY name";
		return $this->executeQuery($sql);
		
	}
	
	public function addRecipe($recipeName) {
		$sql = "INSERT INTO recipes(name) VALUES(?)";
		$result = $this->executeUpdate($sql, array($recipeName));
	}
	
	public function addRecipeIngredient($recipeName, $ingredientName, $amount) {
		$sql = "INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES (?, ?, ?)";
		$result = $this->executeUpdate($sql, array($recipeName, $ingredientName, $amount));
	}
	
	public function getRecipeIngredients($recipeName) {
		$sql = "SELECT * FROM ingredientsInRecipes WHERE recipeName = ? AND amount!=0";
		return $this->executeQuery($sql, array($recipeName));
	}
	
	public function editCustomer($userName, $fullName, $address) {
		$sql = "INSERT INTO customers(userName, fullName, address) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE fullName = ?, address = ?";
		$result = $this->executeUpdate($sql, array($userName, $fullName, $address, $fullName, $address));
	}
	
	public function getCustomers() {
		$sql = "SELECT * FROM customers";
		$result = $this->executeQuery($sql);
		return $result;
	}
	
	public function getCustomer($userName) {
		$sql = "SELECT fullName, address FROM customers WHERE userName = ?";
		$result = $this->executeQuery($sql, array($userName));
		return $result;
	}
	
	public function addOrder($customer) {
		$sql = "INSERT INTO orders(userName, orderTime) VALUES(?, UNIX_TIMESTAMP(now()))";
		$result = $this->executeUpdate($sql, array($customer));
		$id = $this->lastOrderId();
		return $id;
	}
	
	private function lastOrderId() {
		$sql = "SELECT MAX(id) FROM orders";
		$result =$this->executeQuery($sql);
		foreach($result as $id) {
			return $id[0]; 
		}
	}
	
	public function addOrderPallets($order, $cookie, $amount) {
<<<<<<< HEAD
		$sql = "INSERT INTO recipesInOrders(orderId, recipeName, numPallets) values(?, ?, ?)";
=======
		$sql = "INSERT INTO recipesInOrders(orderId, recipeName, recipesInOrders) values(?, ?, ?)";
>>>>>>> d8709f3325b76002776f4a7863d299b457e6f2f2
		$result = $this->executeUpdate($sql, array($order, $cookie, $amount));
	}
	
	public function getCustomerOrders($name) {
		$sql = "SELECT * FROM orders WHERE usernam"
		
	}
	
	public function checkRecipeIngredients($recipeName){
		$numIngredients = count($this->getRecipeIngredients($recipeName));
		$sql = "SELECT count(*) FROM ingredients JOIN ingredientsInRecipes ON ingredients.name=ingredientsInRecipes.ingredientName WHERE recipeName=? AND ingredients.amount>=ingredientsInRecipes.amount*54";
		$result = $this->executeQuery($sql, array($recipeName));
		if($result[0][0] == $numIngredients){
			return true;
		}
		return false;
	}
	
	public function addPallet($recipeName){
		$sql = "INSERT INTO pallets(recipeName, location, isBlocked, productionTime, deliveryTime, orderId) VALUE (?, 'Frysrum', 0, UNIX_TIMESTAMP(now()), null, null)";
		$result = $this->executeUpdate($sql, array($recipeName));
		if($result){
			$ingredients = $this->getRecipeIngredients($recipeName);
			foreach($ingredients as $ingredient){
				$sql = "UPDATE ingredients SET amount = amount-?*54 WHERE name=?";
				$this->executeUpdate($sql, array($ingredient['amount'], $ingredient['ingredientName']));
			}
		}
	}
	
	public function getPallets($id = NULL, $recipeName, $fromTime = NULL, $toTime = NULL, $isBlocked, $customerName){
		$sql = "SELECT * FROM pallets";
		$params = array();
		if($id || ($recipeName && $recipeName!="all") || $fromTime || $toTime || $isBlocked || ($customerName && $customerName!="all")){
			$sql .= " WHERE ";
			if($id){
				$sql .= "id=?";
				$params[] = $id;
			}
			if($recipeName && $recipeName!="all"){
				if(count($params)){
					$sql .= " AND ";
				}
				$sql .= "recipeName=?";
				$params[] = $recipeName;
			}
			if($fromTime){
				if(count($params)){
					$sql .= " AND ";
				}
				$sql .= "productionTime>=?";
				$params[] = $fromTime;
			}
			if($toTime){
				if(count($params)){
					$sql .= " AND ";
				}
				$sql .= "productionTime<=?";
				$params[] = $toTime;
			}
			if($customerName && $customerName!="all"){
				if(count($params)){
					$sql .= " AND ";
				}
				$sql .= "customerName=?";
				$params[] = $customerName;
			}
			if($isBlocked){
				if(count($params)){
					$sql .= " AND ";
				}
				$sql .= "isBlocked=1";
			}
		}
		$result = $this->executeQuery($sql, $params);
		$pallets = array();
		foreach($result as $res){
			$pallets[] = new Pallet($res['id'], $res['recipeName'], $res['location'], $res['productionTime'], $res['deliveryTime'], $res['isBlocked'], $res['customerName']);
		}
		return $pallets;
	}
	
	
	public function blockPallets($recipeName, $fromTime = NULL, $toTime = NULL){
		$sql = "UPDATE pallets SET isBlocked=1 WHERE isBlocked != 1 AND recipeName=?";
		$params = array($recipeName);
		if($fromTime || $toTime){
			if($fromTime){
				$sql .= " AND productionTime>=?";
				$params[] = $fromTime;
			}
			if($toTime){
				$sql .= " AND productionTime<=?";
				$params[] = $toTime;
			}
		}
		return $this->executeUpdate($sql, $params);
	}
	
}

function echo_array($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

function validateDate($date){
    $d = DateTime::createFromFormat("Y-m-d H:i", $date);
    return $d && $d->format("Y-m-d H:i") == $date;
}

?>
