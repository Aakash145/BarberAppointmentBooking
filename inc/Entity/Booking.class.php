<?php

class Booking {

    //Properties    
	private $booking_id;
	private $customer_id;
	private $barber_id;
	private $booking_date_time;
	private $amount;
	//futuristic column
	private $booking_status;
	private $comments;
	//Setters
    public function setBookingId($id){
        $this->booking_id = $id;        
    } 
	public function setCustomerId($customerId){
		$this->customer_id = $customerId;
	}
	public function setBarberId($barber_id){
		$this->barber_id = $barber_id;
	}
	public function setBookingDateTime($booking_date_time){
		$this->booking_date_time = $booking_date_time;
	} 
	public function setBookingStatus($booking_status){
		$this->booking_status = $booking_status;
	}
    public function setAmount($amount) {
		$this->amount = $amount;
	}
	public function setComments($comments){
		$this->comments = $comments;
	}
	//Getters
    public function getBookingId(){
        return $this->booking_id;
	}
    public function getCustomerId(){
        return $this->customer_id;
    }
	public function getBarberId(){
		return $this->barber_id;
	}
	public function getBookingDateTime(){
		return $this->booking_date_time;
	}

	public function getBookingStatus(){
		return $this->booking_status;
	}

	public function getAmount(){
		return $this->amount;
	}
    public function getComments(){
        return $this->comments;
    }
}
?>