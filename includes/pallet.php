<?php 
	
class Pallet{
	
	private $id;
	private $recipeName;
	private $location;
	private $productionTime;
	private $deliveryTime;
	private $isBlocked;
	private $customerName;
	
	public function __construct($id, $recipeName, $location, $productionTime, $deliveryTime, $isBlocked, $customerName){
		$this->id = $id;
		$this->recipeName = $recipeName;
		$this->location = $location;
		$this->productionTime = $productionTime;
		$this->deliveryTime = $deliveryTime;
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
	
	public function getProductionTime(){
		return date("Y-m-d H:i", $this->productionTime);
	}
	
	public function getDeliveryTime(){
		if($this->deliveryTime != null){
			return $this->deliveryTime;
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
			return date("Y-n-j", $this->customerName);
		}
		return "-";
	}
	
}


	
?>