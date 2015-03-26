<?php 
	
class Pallet{
	
	private $id;
	private $recipeName;
	private $location;
	private $deliveryDate;
	private $isBlocked;
	private $customerName;
	
	public function __construct($id, $recipeName, $location, $deliveryDate, $isBlocked, $customerName){
		$this->id = $id;
		$this->recipeName = $recipeName;
		$this->location = $location;
		$this->deliveryDate = $deliveryDate;
		$this->isBlocked = $isBlocked;
		$this->customerName = $customerName;
	}
	
	public getId(){
		return $this->id;
	}
	
	public getRecipeName(){
		return $this->recipeName;
	}
	
	public getLocation(){
		return $this->location;
	}
	
	public getDeliveryDate(){
		return $this->deliveryDate;
	}
	
	public isBlocked(){
		return $this->isBlocked;
	}
	
	public getCustomerName(){
		return $this->customerName;
	}
	
}


	
?>