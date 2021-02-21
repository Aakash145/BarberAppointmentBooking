<?php

class ScheduleDAO   {

    private static $db;
    static function init()  {
        self::$db = new PDOAgent("Schedule");    
    }    

   static function createSchedule(Schedule $schedule){
    // query
        $sqlInsert = "INSERT INTO shift_details (user_id, start_date_time,end_date_time)
                  VALUES (:user_id, :start_date_time, :end_date_time)";
    
    // QUERY BIND EXECUTE
    $timestamp =  $schedule->getStartDate()->getTimestamp();
    $stime = date('Y-m-d H:i:s', $timestamp);

    $timestamp2 =  $schedule->getEndDate()->getTimestamp();
    $etime = date('Y-m-d H:i:s', $timestamp2);

    self::$db->query($sqlInsert);
    self::$db->bind(':user_id',trim($schedule->getUserId()));
    self::$db->bind(':start_date_time',$stime);
    self::$db->bind(':end_date_time',$etime);
    
    self::$db->execute();
    return self::$db->rowCount();

    }

    static function updateSchedule(Schedule $schedule){
        // query
            $sqlUpdate = "UPDATE shift_details SET start_date_time = :start_date_time, 
            end_date_time = :end_date_time WHERE shift_id = :shift_id";

            $timestamp =  $schedule->getStartDate()->getTimestamp();
            $stime = date('Y-m-d H:i:s', $timestamp);

            $timestamp2 =  $schedule->getEndDate()->getTimestamp();
            $etime = date('Y-m-d H:i:s', $timestamp2);
        
        // QUERY BIND EXECUTE
        self::$db->query($sqlUpdate);
        self::$db->bind(':shift_id',trim($schedule->getShiftId()));
        self::$db->bind(':start_date_time',$stime);
        self::$db->bind(':end_date_time',$etime);
        
        self::$db->execute();
        return self::$db->rowCount();
    
        }

    static function getSchedule(string $barbid)  {
        
        $sql = "SELECT * FROM shift_details WHERE user_id=:user_id";
        self::$db->query($sql);
        self::$db->bind(":user_id",$barbid);
        self::$db->execute();
        return self::$db->singleResult();
    }

    static function getBarberSchedule($dateTime){
        // $select = "SELECT distinct shift_details.user_id FROM shift_details,booking where shift_details.start_date_time <= :dateTime and shift_details.end_date_time > :dateTime and shift_details.user_id = booking.barber_id and booking.barber_id not in(select  distinct barber_id from booking where booking_date_time = :dateTime )";
        $select = 'SELECT distinct shift_details.user_id FROM shift_details where shift_details.start_date_time <= :dateTime and shift_details.end_date_time > :dateTime and shift_details.user_id not in (select  distinct barber_id from booking where booking_date_time = :dateTime )';
        self::$db->query($select);
        self::$db->bind(":dateTime",$dateTime);      
        self::$db->execute();
        return self::$db->getResultSet();
    }
    static function deleteSchedule(string $barbid)  {
        
        $sql = "DELETE FROM shift_details WHERE user_id=:user_id";
        self::$db->query($sql);
        self::$db->bind(":user_id",$barbid);
        self::$db->execute();
        return self::$db->rowCount();
    }
    
}