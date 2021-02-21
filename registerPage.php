<?php

require_once("inc/Entity/admin_file.php");
require_once("inc/Entity/main_file.php");
require_once("inc/config.inc.php");
require_once("inc/Entity/Page.class.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Entity/Role.class.php");
require_once("inc/Utility/UserDAO.class.php");
require_once("inc/Utility/RoleDAO.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/Validate.class.php");
require_once("inc/Utility/LoginManager.class.php");


MainPage::header();

UserDAO::init();
RoleDAO::init();

$message = "";
$errors = [];

if (!empty($_POST)) {
    // if it is an edit 
        $errors = Validate::validateInput();
        if(empty($errors)){
          $username = $_POST['username'];
          $userTmp = UserDAO::getUser($username);
          if(!empty($userTmp)){
            array_push($errors, "Username $username already exists.");
          }
        }
        if(empty($errors))
      {
       
        // instantiate a new user
        $user = new User();
        //fetching Role id from Role table using role 
        $Roles = RoleDAO::getRoles();
        $role =  $_POST['role'];
        
        foreach($Roles as $rol) {
                if($rol->getRole_type() == $role )
                {
                    $user->setRole($rol->getRole_id());
                }
        }
        // assemble the user data
        $user->setName(strtolower($_POST['uname']));
        $user->setContact_Number(strtolower($_POST['phone']));
        $user->setEmail(strtolower($_POST['mail']));
        $user->setUsername(strtolower($_POST['username'])); 
        $user->setPassword(password_hash($_POST['pass'],PASSWORD_DEFAULT));
        
        $flag = UserDAO::createUser($user);
        $message="";
        if($flag ==1 )
        {
            $message = "Registration Successfull please login to your account";
        }
        
        header('Location: loginPage.php?message=Registration Successfull please login to your account');

      }
        
}

MainPage::registerBody($errors);
MainPage::registerFooter();


?>