<?php
class Add_favorite{
  
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
        $query = "SELECT * FROM Add_favorites";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // select favorites by object_id and user_id
    function readOneByObjectIdAndUserId($object_id, $user_id){
    
        // select all query
        $query = "SELECT * FROM Add_favorites WHERE object_id = :object_id AND user_id = :user_id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('object_id', $object_id, PDO::PARAM_INT);
        $stmt->bindValue('user_id', $user_id, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read one sale by id
    function readOne($object_id){
    
        // select all query
        $query = "SELECT * FROM Add_favorites WHERE object_id = :object_id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('object_id', $object_id, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // add a favorite by user_id and object_id
    function add($user_id, $object_id) {

        $query = "INSERT INTO Add_favorites (user_id, object_id) VALUES (:user_id, :object_id)";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue('object_id', $object_id, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}
?>