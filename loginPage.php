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

$errors = [];
if (!empty($_POST)) {
    $authUser = UserDAO::getUser($_POST['username']);

    if (!$authUser) {
        $errors[] = "Invalid username";
    } else {
        if ($authUser->verifyPassword($_POST['userPass'])) {
            session_start();
            $role = RoleDAO::getRole($authUser->getRole());            
            $_SESSION['loggedin'] = $authUser->getUserName();
            $_SESSION['userRole'] = $role->getRole_type();
        } else {
            $errors[] = "Invalid Password";
        }
    }
}

if (LoginManager::verifyLogin()) {
    if(LoginManager::isAdmin()){
        header('Location: adminModule.php');
    }else{
        header('Location: userLogin.php?message= Welcome ' . $_POST["username"]);
    }    
} else {
    MainPage::loginBody($errors);
}
MainPage::loginFooter();
?>