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
	
	public function isAdmin(){
		if($this->userType == 'admin'){
			return true;
		}
		return false;
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
		} else if(1==1){
			
		}
	}
	
	public function printUserType() {
		if ($this->isAdmin()) {
			echo "Administratör";
		} else if ($this->isSuperUser()) {
			echo "Superuser";
		} else if ($this->isMaterialUser()) {
			echo "Material Department";
		} else if ($this->isProductionUser()) {
			echo "Pallet/production Department";
		} else if ($this->isOrderUser()) {
			echo "Order/delivery department";
		} 
	}

}


?>