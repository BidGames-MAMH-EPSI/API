<?php
class Payment_way{
  
    // database connection and table name
    private $conn;
  
    // object properties
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all Images
    function read(){

        // select all query
        $query = "SELECT * FROM Payment_ways";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

}
?>