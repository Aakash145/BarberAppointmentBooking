<?php

class BookingService {

    //Properties    
    private $bookin_service_id;
	private $booking_id;
	private $service_id;

	//Setters
	public function setId($id){
        $this->bookin_service_id = $id;        
    }
    public function setBookingId($booking_id){
        $this->booking_id = $booking_id;        
    }
	public function setServiceId($service_id){
		$this->service_id = $service_id;
	}
	//Getters
	public function getId(){
        return $this->bookin_service_id;
	}
    public function getBookingId(){
        return $this->booking_id;
	}
	 
	public function getServiceId(){
		return $this->service_id;
	}
}
?>