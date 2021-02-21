<?php

require_once("inc/config.inc.php");
require_once("inc/Entity/Page.class.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Entity/Role.class.php");
require_once("inc/Entity/Service.class.php");
require_once("inc/Entity/Schedule.class.php");
require_once("inc/Entity/Booking.class.php");
require_once("inc/Entity/BookingService.class.php");
require_once("inc/Utility/UserDAO.class.php");
require_once("inc/Utility/ServiceDAO.class.php");
require_once("inc/Utility/ScheduleDAO.class.php");
require_once("inc/Utility/RoleDAO.class.php");
require_once("inc/Utility/BookingDAO.class.php");
require_once("inc/Utility/BookingServiceDAO.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/Validate.class.php");
require_once("inc/Utility/LoginManager.class.php");


session_start();
BookingServiceDAO::init();
UserDAO::init();
ServiceDAO::init();
ScheduleDAO::init();
BookingDAO::init();

$_error=[];

if (LoginManager::verifyLogin() && LoginManager::isUser()) {
    Page::userHeader();

if( !empty($_POST))
{
    $services = $_POST['services'];
    $date = $_POST['date'];
    $time = $_POST['time'];    
    $ad = date("m/d/Y");
    $cdate = strtotime($ad);
    $sdate = strtotime($date);    
    $dateTime = $date ." ". $time;    
    if($_POST['action'] == "addBasicDetail"){   
        $_POST['services'] = implode(",",$_POST['services']);
        //fetch avilable barbers
        $barberAvailableSchedule = ScheduleDAO::getBarberSchedule($dateTime);
        $barberIds = array();
        foreach($barberAvailableSchedule as $barberSchedule){
            array_push($barberIds,$barberSchedule->getUserId());
        }
        $barberArr = null;
        if(!empty($barberIds))    
            $barberArr = UserDAO::getAllUsers(implode(",",$barberIds));
        Page::bookAppointment($barberArr);
    }else if($_POST['action'] == "bookAppointment"){
        $selectedBarber = $_POST['barbRad'];
        $user = UserDAO::getUser($_SESSION['loggedin']);
        $booking = new Booking;
        $booking->setCustomerId($user->getuser());
        $booking->setBarberId($selectedBarber);
        $booking->setBookingDateTime($dateTime);
        $booking->setAmount(0);
        $booking->setComments("");
        $booking->setBookingStatus("Booked");
        $bookingId = BookingDAO::createBooking($booking);
        //create service
        $servicesArr= explode(",", $_POST['services']);
        foreach($servicesArr as $serviceId){
            $bookingService = new BookingService;
            $bookingService->setBookingId($bookingId);
            $bookingService->setServiceId($serviceId);
            BookingServiceDAO::createBooking($bookingService);
        }
        header('Location: userLogin.php?message=Appointment Confirmed for '.$dateTime);
    }
}
else{
   $services =  ServiceDAO::getServices();
    Page::userBody($services);
}

    Page::userFooter();
}
else{
    header('Location: loginPage.php');
}
?>