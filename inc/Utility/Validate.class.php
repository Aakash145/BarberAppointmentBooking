<?php

class Validate
{

static function validateInput()    
 {
    $errors = [];    
    
    //Validate the name 
    $name = $_POST['uname'];
    // First Name and Last Name should not be empty and not numbers
        // Also replace occurences of semicolon, colon, comma, ampersand, 
        // dollar sign, < and > and any improper character with nothing
    $filter = array(";","<",">",":","&","$",",");
    str_replace($filter,"",$_POST['uname']);
    if($name == '' || is_numeric($name))
    {
        $errors[] = "Please Enter a valid first name.";
    }

    
    //Validate the email address
    $email = $_POST['mail'];
    if(!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $errors[] = "Please Enter a valid email address";
    }



    //Validate the number of days    
    $contact = $_POST['phone'];
    $as = strlen($contact);
    if(!isset($contact) || !(strlen($contact) == 10) || !is_numeric($contact))
    {
        $errors[] = "Please enter a valid 10 digit contact number";
    }

    //Check the message
    $uname = $_POST['username'];
    if($uname == '' || strpos($uname," "))
    {
        $errors[] = "Please enter a valid username ";
    }

    $password = $_POST['pass'];
    if(strlen($password) < 6 || (strcmp($password,$_POST['cpass']) != 0))
    {
        $errors[] = "Please enter a valid 6 digit password ";
    }
    //Return the errors
    return $errors;
 }

 static function validateBarberInput(){
    $errors = [];        
    //Validate the name and name should not be empty and not numbers
        // Also replace occurences of semicolon, colon, comma, ampersand, 
        // dollar sign, < and > and any improper character with nothing
    $filter = array(";","<",">",":","&","$",",");
    str_replace($filter,"",$_POST['barbName']);
    if($_POST['barbName'] == '' || is_numeric($_POST['barbName'])){
        $errors[] = "Please Enter a valid first name.";
    }   
    //Validate the email address
    $email = $_POST['userMail'];
    if(!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Please Enter a valid email address";
    }
    //Validate the number of days    
    $contact = $_POST['contact'];
    $as = strlen($contact);
    if(!isset($contact) || !(strlen($contact) == 10) || !is_numeric($contact)){
        $errors[] = "Please enter a valid 10 digit contact number";
    }
    //Check the message
    $address = $_POST['address'];
    if($address == ''){
        $errors[] = "Please enter a valid address ";
    }   
    //Return the errors
    return $errors;
 }
 
 static function validateServiceDetails(){
    $errors = [];        
    
    $filter = array(";","<",">",":","&","$",",");
    str_replace($filter,"",$_POST['serviceName']);
    if($_POST['serviceName'] == '' || is_numeric($_POST['serviceName'])){
        $errors[] = "Please Enter a valid service Name.";
    }   
  
    $serviceDesc = $_POST['serviceDesc'];
    if(!isset($serviceDesc) ){
        $errors[] = "Please Enter service description";
    }
    //Validate rate    
    $price = $_POST['price'];    
    if(!isset($price) || !(is_numeric($price))){
        $errors[] = "Price can only be numeric";
    }
    //Return the errors
    return $errors;
 }
 static function validateScheduleDetails(){
    $errors = [];  
    return $errors;
 }

}

?>