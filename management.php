<?php

require_once("inc/config.inc.php");
require_once("inc/Entity/admin_file.php");
require_once("inc/Entity/main_file.php");
require_once("inc/Utility/Validate.class.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Entity/Role.class.php");
require_once("inc/Entity/Schedule.class.php");
require_once("inc/Entity/Service.class.php");
require_once("inc/Utility/UserDAO.class.php");
require_once("inc/Utility/RoleDAO.class.php");
require_once("inc/Utility/ServiceDAO.class.php");
require_once("inc/Utility/ScheduleDAO.class.php");
require_once("inc/Utility/PDOAgent.class.php");


UserDAO::init();
RoleDAO::init();
ServiceDAO::init();
ScheduleDAO::init();


$role = RoleDAO::getRoleFromType("BARBER");
$barbers = UserDAO::getUsers($role->getRole_id());
$services = ServiceDAO::getServices();

if(!empty($_GET) && !empty($_GET['formName'])){
AdminPage::mgtFormHead();
AdminPage::mgtFormBody($barbers, $services);
AdminPage::adminFooter();
}else{
    header('Location: adminModule.php');
}
if (!empty($_POST['actionItem'])) {
    // Regarding Add Barber
    if ($_POST['actionItem'] == "addBarber") {
        $errors = Validate::validateBarberInput();
        if (empty($errors)) {
            // instantiate a new user
            $user = new User();
            //fetching Role id from Role table using role 
            $Roles = RoleDAO::getRoles();
            $role =  $_POST['role'];

            foreach ($Roles as $rol) {
                if ($rol->getRole_type() == $role) {
                    $user->setRole($rol->getRole_id());
                }
            }
            // assemble the user data
            $user->setName(strtolower($_POST['barbName']));
            $user->setContact_Number(strtolower($_POST['contact']));
            $user->setEmail(strtolower($_POST['userMail']));
                      
            $flag = UserDAO::createUser($user);
            if ($flag == 1) {
                echo '<p style="font-size:2em;
                            font-weight:bold;"
               >Registration Successfull</p>';
            }
        } else {
            echo '<ul style="font-size:1.5em;
            font-weight:bold;
            list-style-type:circle;">';
            foreach ($errors as $err) {
                echo "<li>" . $err . "</li>";
                echo "<br>";
            }
            echo '</ul>';
        }
    }

    // Delete Barber
else if ($_POST['actionItem'] == "delBarber") {
    $barberId =  UserDAO::getUserDet($_POST['barNameDel']);
    $count =  ScheduleDAO::deleteSchedule($barberId->getuser());
    if($count == 1){
        $count2 = UserDAO::deleteBarber($barberId->getuser());
        if($count2 !=1){
            echo '<ul style="font-size:1.5em;
            font-weight:bold;
            list-style-type:circle;">';
            echo "Delete Unsuccessful";
            echo '</ul>';
        }
        else{
            echo '<ul style="font-size:1.5em;
            font-weight:bold;
            list-style-type:circle;">';
            echo "Deleted Successfully";
            echo '</ul>'; 
        }
    }
    else {
        echo '<ul style="font-size:1.5em;
        font-weight:bold;
        list-style-type:circle;">';
        echo "Delete Unsuccessful";
        echo '</ul>';
    }
    
}

//delete service
else if ($_POST['actionItem'] == "delService") {
    $serviceId =  ServiceDAO::getService($_POST['serviceNameDel']);
    $count =  ServiceDAO::deleteService($serviceId->getId());
    if($count != 1){
        echo '<ul style="font-size:1.5em;
        font-weight:bold;
        list-style-type:circle;">';
        echo "Delete Unsuccessful";
        echo '</ul>';
    }
    else{
        echo '<ul style="font-size:1.5em;
        font-weight:bold;
        list-style-type:circle;">';
        echo "Deleted Successfully";
        echo '</ul>'; 
    }
}

    else if ($_POST['actionItem'] == "getServDet") {
        $serDetail = ServiceDAO::getService($_POST['servicesNam']);
        AdminPage::manageServiceFormPart2($serDetail);
    }


    else if (($_POST['actionItem'] == "addService")
        || ($_POST['actionItem'] == "manageServices")
    ) {
        $service = new Service;
        $errors = Validate::validateServiceDetails();
        if (empty($errors)) {
            $service->setName($_POST['serviceName']);
            $service->setDescription($_POST['serviceDesc']);
            $service->setRate(number_format($_POST['price']));
            $flag = 0;
            if ($_POST['actionItem'] == "addService") {
                $flag = ServiceDAO::createService($service);
            } else {
                $service->setId($_POST['serviceId']);
                $flag = ServiceDAO::updateService($service);
            }

            if ($flag == 1) {
                echo '<p style="font-size:2em;
                            font-weight:bold;"
               >Service Added/Updated successfully</p>';
            }
        } else {
            echo '<ul style="font-size:1.5em;
            font-weight:bold;
            list-style-type:circle;">';
            foreach ($errors as $err) {
                echo "<li>" . $err . "</li>";
                echo "<br>";
            }
            echo '</ul>';
        }
    }

// Schedule Add

else if ($_POST['actionItem'] == "getBarID") {
    $barbDet =  UserDAO::getUserDet($_POST['barID']);
    AdminPage::addScheduleFormPart2($barbDet);
}
else if ($_POST['actionItem'] == "addSchedule")
     {
    $schedule = new Schedule;
    $errors = Validate::validateScheduleDetails();
    if (empty($errors)) {

        $date = $_POST['sdate'];
        $start = $_POST['sdate']. " " .$_POST['stime'].":00";
        
        $end = $_POST['sdate']. " " .$_POST['etime'];
        $startDateTime = new DateTime(date("Y-m-d H:i:s",strtotime($start)));
        $endDateTime = new DateTime(date("Y-m-d H:i:s",strtotime($end)));
       // $startDateTime = new DateTime(strtotime($start))    ;
        //$startDateTime = date("yyyy-mm-dd hh:mm:ss",$start);
        // $endDateTime = strtotime($end);
        // echo $date;

        

        // $sdate = date("Y-m-d H:i:s",strtotime($_POST['stime']));
        // $stimeStr = new DateTime($sdate);

        // $edate = date("Y-m-d H:i:s",strtotime($_POST['etime']));
        // $etimeStr = new DateTime($edate);

        $schedule->setUserId($_POST['userid']);
        $schedule->setStartDate($startDateTime);
        $schedule->setEndDate($endDateTime);
        $flag = 0;
        if ($_POST['actionItem'] == "addSchedule") {
            $flag = ScheduleDAO::createSchedule($schedule);
        } 

        if ($flag == 1) {
            echo '<p style="font-size:2em;
                        font-weight:bold;"
           >Service Added/Updated successfully</p>';
        }
    }else {
        echo '<ul style="font-size:1.5em;
        font-weight:bold;
        list-style-type:circle;">';
        foreach ($errors as $err) {
            echo "<li>" . $err . "</li>";
            echo "<br>";
        }
        echo '</ul>';
    }
}

//Schedule Manage
else if ($_POST['actionItem'] == "mangetBarID") {
    $barbDet =  UserDAO::getUserDet($_POST['barSchID']);
    $barbDetFinal =  ScheduleDAO::getSchedule($barbDet->getUser());
    AdminPage::manageScheduleFormPart2($barbDetFinal);
}

else if ($_POST['actionItem'] == "manageSchedule")
 {
    $schedule = new Schedule;
    $errors = Validate::validateScheduleDetails();
    if (empty($errors)) {

     
        $start = $_POST['schedule_date']. " " .$_POST['stime'].":00";        
        $end = $_POST['schedule_date']. " " .$_POST['etime'];
        $startDateTime = new DateTime(date("Y-m-d H:i:s",strtotime($start)));
        $endDateTime = new DateTime(date("Y-m-d H:i:s",strtotime($end)));
       

        // $sdate = date("Y-m-d H:i:s",strtotime($_POST['stime']));
        // $stimeStr = new DateTime($sdate);

        // $edate = date("Y-m-d H:i:s",strtotime($_POST['etime']));
        // $etimeStr = new DateTime($edate);

        $schedule->setUserId($_POST['userid']);
        $schedule->setShiftId($_POST['shiftid']);
        $schedule->setStartDate($startDateTime);
        $schedule->setEndDate($endDateTime);
        $flag = 0;
        $flag = ScheduleDAO::updateSchedule($schedule);
        
        if ($flag == 1) {
            echo '<p style="font-size:2em;
                        font-weight:bold;"
           >Service Added/Updated successfully</p>';
        }
    }else {
        echo '<ul style="font-size:1.5em;
        font-weight:bold;
        list-style-type:circle;">';
        foreach ($errors as $err) {
            echo "<li>" . $err . "</li>";
            echo "<br>";
        }
        echo '</ul>';
    }
}

}
?>