<?php
class Be_warned{
  
    // database connection and table name
    private $conn;
  
    // object properties
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all warne
    function read(){

        // select all query
        $query = "SELECT * FROM Be_warned";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // select warne by sale_id and user_id
    function readOneBySaleIdAndUserId($sale_id, $user_id){
    
        // select all query
        $query = "SELECT * FROM Be_warned WHERE sale_id = :sale_id AND user_id = :user_id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('sale_id', $sale_id, PDO::PARAM_INT);
        $stmt->bindValue('user_id', $user_id, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read one warne by id
    function readOne($sale_id){
    
        // select all query
        $query = "SELECT * FROM Be_warned WHERE sale_id = :sale_id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('sale_id', $sale_id, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // add a warne by user_id and sale_id
    function add($user_id, $sale_id) {

        $query = "INSERT INTO Be_warned (user_id, sale_id) VALUES (:user_id, :sale_id)";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue('sale_id', $sale_id, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}
?>