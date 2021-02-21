<?php

require_once("inc/Entity/admin_file.php");
require_once("inc/Entity/main_file.php");
require_once("inc/config.inc.php");
require_once("inc/Entity/Page.class.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Entity/Role.class.php");
require_once("inc/Entity/Service.class.php");
require_once("inc/Utility/UserDAO.class.php");
require_once("inc/Utility/ServiceDAO.class.php");
require_once("inc/Utility/RoleDAO.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/Validate.class.php");
require_once("inc/Utility/LoginManager.class.php");

MainPage::header();

UserDAO::init();
RoleDAO::init();
ServiceDAO::init();
$message = "";
$errors = [];

$services = ServiceDAO::getServices();
MainPage::body($services);

MainPage::footer();

?>