<?php

class Service {

    //Properties    
    private $service_id;
	private $service_label;
	private $service_description;
	private $rate;
	

	//Setters
	public function setId($id){
        $this->service_id = $id;        
    }
    public function setName($name){
        $this->service_label = $name;        
    }
	public function setDescription($description){
		$this->service_description = $description;
	}
	public function setRate($rate){
		$this->rate = $rate;
	}
	//Getters
	public function getId(){
        return $this->service_id;
	}
    public function getName(){
        return $this->service_label;
	}
	 
	public function getDescription(){
		return $this->service_description;
	}

	public function getRate(){
		return $this->rate;
	}
}
?>