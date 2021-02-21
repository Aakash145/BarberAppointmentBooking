<?php

class BookingDAO   {

    // Create a member to store the PDO agent
    private static $db;
    // create the init function to start the PDO agent
    static function init()  {
        //Initialize the internal PDO Agent
        self::$db = new PDOAgent("Booking");    
    }    

    static function createBooking(Booking $booking){        
    $sqlInsert = "INSERT INTO booking (customer_id, barber_id, booking_date_time,amount,booking_status,comments)
                  VALUES (:customerId,:barberId, :bookingDateTime, :amount, :bookingStatus,:comments)";
    // QUERY BIND EXECUTE
    self::$db->query($sqlInsert);
    self::$db->bind(':customerId',$booking->getCustomerId());
    self::$db->bind(':barberId',trim($booking->getBarberId()));
    self::$db->bind(':bookingDateTime',trim($booking->getBookingDateTime()));
    self::$db->bind(':amount',$booking->getAmount());    
    self::$db->bind(':bookingStatus',trim($booking->getBookingStatus()));
    self::$db->bind(':comments',trim($booking->getComments()));
    self::$db->execute();
    if(self::$db->rowCount() > 0){
        $sql = "SELECT max(booking_id) as max_key FROM booking;";
        self::$db->query($sql);
        self::$db->execute();
        $results = self::$db->getResultSet();
        foreach($results  as $result){
             foreach ($result as $key => $value) {
                if(trim($key) == "max_key"){
                    return $value;
                }
            }
         }
    }
    return 0;

    }

    static function getBookings(string $userId)  {        
        $sql = "SELECT * FROM booking WHERE customerId=:userId";
        self::$db->query($sql);
        self::$db->bind(":userId",$userId);
        self::$db->execute();
        return self::$db->getResultSet();    
    }
    
}