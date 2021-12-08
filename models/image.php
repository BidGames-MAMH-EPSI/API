<?php
class Image{
  
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
        $query = "SELECT * FROM Images";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read all images by object_id
    function readByObjectId($object_id){
    
        // select all query
        $query = "SELECT * FROM Images WHERE object_id = :object_id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('object_id', $object_id, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read one image by id
    function readOne($image_id){
    
        // select all query
        $query = "SELECT * FROM Images WHERE image_id = :image_id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('image_id', $image_id, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}
?>