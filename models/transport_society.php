<?php
class Transport_society{
  
    // database connection and table name
    private $conn;
  
    // object properties
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all transport societies
    function read(){

        // select all query
        $query = "SELECT * FROM Objects";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read the minimum price within all transport societies
    function readMinTransportSocietyPrice(){

        // select the minimum price within all transport societies
        $query = "SELECT price FROM Transport_societies ORDER BY price ASC LIMIT 1";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read the maximum price within all transport societies
    function readMaxTransportSocietyPrice(){

        // select the maximum price within all transport societies
        $query = "SELECT price FROM Transport_societies ORDER BY price DESC LIMIT 1";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read the minimum delay within all transport societies
    function readMinTransportSocietyDelay(){

        // select the minimum max_delay within all transport societies
        $query = "SELECT max_delay FROM Transport_societies ORDER BY max_delay ASC LIMIT 1";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read the maximum delay within all transport societies
    function readMaxTransportSocietyDelay(){

        // select the maximum max_delay within all transport societies
        $query = "SELECT max_delay FROM Transport_societies ORDER BY max_delay DESC LIMIT 1";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}
?>