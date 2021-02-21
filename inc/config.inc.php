<?php

// Set all the database things!
define("DB_HOST", "localhost");
define("DB_NAME", "barbershop");
define("DB_USER","root");
define("DB_PASS","");
define("DB_PORT",3308);

define('LOGFILE','log/error_log.txt');
ini_set("log_errors", TRUE);  
ini_set('error_log', LOGFILE); 



?>