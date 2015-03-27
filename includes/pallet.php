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
	
	public function getId(){
		return $this->id;
	}
	
	public function getRecipeName(){
		return $this->recipeName;
	}
	
	public function getLocation(){
		return $this->location;
	}
	
	public function getDeliveryDate(){
		if($this->deliveryDate != null){
			return $this->deliveryDate;
		}
		return "-";
	}
	
	public function isBlocked(){
		if($this->isBlocked){
			return "Ja";
		}
		return "Nej";
	}
	
	public function getCustomerName(){
		if($this->customerName != null){
			return $this->customerName;
		}
		return "-";
	}
	
}


	
?>