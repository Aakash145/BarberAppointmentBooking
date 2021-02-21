<?php

require_once("inc/Entity/admin_file.php");
require_once("inc/Entity/main_file.php");
require_once("inc/Utility/LoginManager.class.php");

session_start();

if (LoginManager::verifyLogin() && LoginManager::isAdmin()) {
    AdminPage::adminHeader();
    AdminPage::adminBody();
    AdminPage::adminFooter();
}else{
    header('Location: loginPage.php');
}

?>