<?php

class BookingServiceDAO   {

    // Create a member to store the PDO agent
    private static $db;
    // create the init function to start the PDO agent
    static function init()  {
        //Initialize the internal PDO Agent
        self::$db = new PDOAgent("BookingService");    
    }    

    static function createBooking(BookingService $bookingService){        
    $sqlInsert = "INSERT INTO booking_service (booking_id, service_id)
                  VALUES (:bookingId,:serviceId)";
    // QUERY BIND EXECUTE
    self::$db->query($sqlInsert);
    self::$db->bind(':bookingId',$bookingService->getBookingId());
    self::$db->bind(':serviceId',trim($bookingService->getServiceId()));
    self::$db->execute();
    self::$db->rowCount();

    }


    
}