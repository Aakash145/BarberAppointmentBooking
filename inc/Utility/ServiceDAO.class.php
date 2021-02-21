<?php

class ServiceDAO   {

    private static $db;
    static function init()  {
        self::$db = new PDOAgent("Service");    
    }    

    
   static function createService(Service $service){
    // query
        $sqlInsert = "INSERT INTO service (service_label, service_description,rate)
                  VALUES (:serviceLabel, :serviceDescription, :rate)";
    
    // QUERY BIND EXECUTE
    self::$db->query($sqlInsert);
    self::$db->bind(':serviceLabel',trim($service->getName()));
    self::$db->bind(':serviceDescription',trim($service->getDescription()));
    self::$db->bind(':rate',trim($service->getRate()));
    
    self::$db->execute();
    return self::$db->rowCount();

    }

    static function updateService(Service $service){
        // query
            $sqlUpdate = "UPDATE service SET service_label=:serviceLabel, 
            service_description=:serviceDescription,rate=:rate WHERE service_id = :serviceId";
        
        // QUERY BIND EXECUTE
        self::$db->query($sqlUpdate);
        self::$db->bind(':serviceId',trim($service->getId()));
        self::$db->bind(':serviceLabel',trim($service->getName()));
        self::$db->bind(':serviceDescription',trim($service->getDescription()));
        self::$db->bind(':rate',$service->getRate());
        
        self::$db->execute();
        return self::$db->rowCount();
    
        }

    static function getService(string $serviceName)  {
        
        $sql = "SELECT * FROM service WHERE service_label=:serviceName";
        self::$db->query($sql);
        self::$db->bind(":serviceName",$serviceName);
        self::$db->execute();
        return self::$db->singleResult();
    }
    
    static function getServices(){
        $selectAll = "SELECT * FROM service";
        self::$db->query($selectAll);
        self::$db->execute();
        return self::$db->getResultSet();
    }
    static function deleteService(string $serviceid)  {
        
        $sql = "DELETE FROM service WHERE service_id=:service_id";
        self::$db->query($sql);
        self::$db->bind(":service_id",$serviceid);
        self::$db->execute();
        return self::$db->rowCount();
    }
}