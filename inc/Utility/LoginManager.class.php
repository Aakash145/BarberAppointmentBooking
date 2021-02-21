<?php

class LoginManager  {
    static function verifyLogin()   {

        if (session_id() == '' && !isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION["loggedin"]))  {
            return true;

        } else {
            session_destroy();
            return false;

        }
    }

    static function isAdmin()   {
        if (isset($_SESSION["loggedin"]) && isset($_SESSION["userRole"])){
            if($_SESSION["userRole"] == "ADMIN")
                return true;
        } else {
            session_destroy();           
        }
        return false;
    }
    static function isUser()   {
        if (isset($_SESSION["loggedin"]) && isset($_SESSION["userRole"])){
            if($_SESSION["userRole"] != "ADMIN")
                return true;
        } else {
            session_destroy();           
        }
        return false;
    }


        
    
}

?>