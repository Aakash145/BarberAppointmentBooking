<?php

class RoleDAO  {

    private static $db;
    static function init()    {
        self::$db = new PDOAgent("Role");
    }

    static function getRoles() {
           
        $selectAll = "select * from user_role;";
        self::$db->query($selectAll);
        self::$db->execute();
        return self::$db->getResultSet(); 
        
    }

    static function getRole($roleId) {
           
        $select = "select * from user_role where role_id = :roleId;";
        self::$db->query($select);
        self::$db->bind(":roleId",$roleId);
        self::$db->execute();
        return self::$db->singleResult(); 
        
    }

    static function getRoleFromType($roleType) {
           
        $select = "select * from user_role where role_type = :roleType;";
        self::$db->query($select);
        self::$db->bind(":roleType",$roleType);
        self::$db->execute();
        return self::$db->singleResult(); 
        
    }
}


?>