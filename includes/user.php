<?php 
	
class User {
	
	private $username;
	private $userType;
	
	public function __construct($username, $userType){
		$this->username = $username;
		$this->userType = $userType;
	}
	
	public function getUsername(){
		return $this->username;
	}	
	
	public function isSuperUser(){
		if($this->userType == 'super'){
			return true;
		}
		return false;
	}
	
	public function isMaterialUser(){
		if($this->userType == 'material'){
			return true;
		}
		return false;
	}
	
	public function isProductionUser(){
		if($this->userType == 'production'){
			return true;
		}
		return false;
	}
	
	public function isOrderUser(){
		if($this->userType == 'order'){
			return true;
		}
		return false;
	}
	
	public function isCustomerUser(){
		if($this->userType == 'customer'){
			return true;
		}
		return false;
	}
	
	public function echoUserType(){
		if($this->isSuperUser()){
			echo "Superuser";
		} else if($){
			
		}
	}
	
	public function printUserType($userName) {
		if ($this->checkSuperUser($userName)) {
			echo "Superuser";
		} else if ($this->checkMaterialUser($userName)) {
			echo "Material Department";
		} else if ($this->checkProductionUser($userName)) {
			echo "Pallet/production Department";
		} else if ($this->checkOrderAndDeliveryUser($userName)) {
			echo "Order/delivery department";
		} 
	}

}


?>