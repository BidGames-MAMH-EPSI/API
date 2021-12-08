<?php
class Category{
  
    // database connection and table name
    private $conn;
  
    // object properties
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all categories
    function read() {
    
        // select all query
        $query = "SELECT * FROM Categories";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read one category by id
    function readOne($category_id) {
    
        // select all query
        $query = "SELECT * FROM Categories WHERE category_id = :category_id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('category_id', $category_id, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}
?>