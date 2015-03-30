<?php 
	
class Pallet{
	
	private $id;
	private $recipeName;
	private $location;
	private $productionTime;
	private $isBlocked;
	private $orderId;
	private $deliveryTime;
	
	public function __construct($id, $recipeName, $location, $productionTime, $isBlocked, $orderId, $deliveryTime){
		$this->id = $id;
		$this->recipeName = $recipeName;
		$this->location = $location;
		$this->productionTime = $productionTime;
		$this->isBlocked = $isBlocked;
		$this->orderId = $orderId;
		$this->deliveryTime = $deliveryTime;
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
	
	public function isBlocked(){
		if($this->isBlocked){
			return "Ja";
		}
		return "Nej";
	}
	
	public function getOrderId(){
		if($this->orderId != null){
			return $this->orderId;
			
		}
		return "-";
	}
	
	public function getDeliveryTime(){
		if($this->deliveryTime != null){
			return date("Y-m-d H:i", $this->deliveryTime);
		} 
		return "-";
	}
	
}


	
?>