<?php
class User{
  
    // database connection and table name
    private $conn;
  
    // object properties
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all users
    function read(){

        // select all query
        $query = "SELECT * FROM Users";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read one user by id
    function readOne($user_id){
    
        // select all query
        $query = "SELECT * FROM Users WHERE user_id = :user_id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('user_id', $user_id, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }


     function readFirstNameAndLastNameOfOneUser($user_id){
    
        // select all query
        $query = "SELECT user_id, lastname, firstname FROM Users WHERE user_id = :user_id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('user_id', $user_id, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}