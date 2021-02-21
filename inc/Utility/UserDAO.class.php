<?php

class UserDAO   {

    // Create a member to store the PDO agent
    private static $db;
    // create the init function to start the PDO agent
    static function init()  {
        //Initialize the internal PDO Agent
        self::$db = new PDOAgent("User");    
    }    

    // function to create user
    static function createUser(User $user){
        
        // query
        $sqlInsert = "INSERT INTO user (Name, role, username,email,Contact_Number,create_date,password,is_active)
                  VALUES (:name, :role, :username, :email, :contact_number, :create_date, :password, :is_active)";
    
    // QUERY BIND EXECUTE
    self::$db->query($sqlInsert);
    self::$db->bind(':name',trim($user->getName()));
    self::$db->bind(':role',trim($user->getRole()));
    self::$db->bind(':email',trim($user->getEmail()));
    self::$db->bind(':username',(!empty($user->getUsername()) ? trim($user->getUsername()) : ""));
    
    self::$db->bind(':password',trim($user->getPassword()));
    self::$db->bind(':contact_number',trim($user->getContact_Number()));
    self::$db->bind(':create_date',date("Y/m/d"));
    self::$db->bind(':is_active',1);
    
    self::$db->execute();
        return self::$db->rowCount();

    }

    // get a user detail
    static function getUser(string $userName)  {
        
        $sql = "SELECT * FROM user WHERE username=:user";
        self::$db->query($sql);
        self::$db->bind(":user",$userName);
        self::$db->execute();
        return self::$db->singleResult();
    
    }
    //get user details from name
    static function getUserDet(string $name)  {
        
        $sql = "SELECT * FROM user WHERE Name=:user";
        self::$db->query($sql);
        self::$db->bind(":user",$name);
        self::$db->execute();
        return self::$db->singleResult();
    
    }

    static function getUsers($roleId = null){
        if(empty($roleId)){
            $selectAll = "SELECT * FROM user";
            self::$db->query($selectAll);
        }else{         
            $selectAll = "SELECT * FROM user where role = :roleId";
            self::$db->query($selectAll);
            self::$db->bind(":roleId",$roleId);
        }
        self::$db->execute();
        return self::$db->getResultSet();
    }

    
    static function getAllUsers($userIdArray = null){
        if(empty($userIdArray)){
            $selectAll = "SELECT * FROM user";
            self::$db->query($selectAll);
        }else{         
            $selectAll = "SELECT * FROM user where user_id IN (:roleIds)";
            self::$db->query($selectAll);
            self::$db->bind(":roleIds",$userIdArray);
        }
        self::$db->execute();
        return self::$db->getResultSet();
    }
    static function deleteBarber(string $barbid)  {
        $sql = "DELETE FROM user WHERE user_id=:user_id";
        self::$db->query($sql);
        self::$db->bind(":user_id",$barbid);
        self::$db->execute();
        return self::$db->rowCount();
    }
    
    
}