<?php
class Object_{
  
    // database connection and table name
    private $conn;
  
    // object properties
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all sales
    function read(){

        // select all query
        $query = "SELECT * FROM Objects";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read all sales by sale_id
    function readBySaleId($sale_id, $max = 10, $page = 1){
    
        // select all query
        $query = "SELECT * FROM Objects WHERE sale_id = :sale_id LIMIT :min,:pas";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $min = ($page-1)*$max;
        $pas = $max;

        $stmt->bindValue('sale_id', $sale_id, PDO::PARAM_INT);
        $stmt->bindValue('min', $min, PDO::PARAM_INT);
        $stmt->bindValue('pas', $pas, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read one sale by id
    function readOne($object_id){
    
        // select all query
        $query = "SELECT * FROM Objects WHERE object_id = :object_id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('object_id', $object_id, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}
?>