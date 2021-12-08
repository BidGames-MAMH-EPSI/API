<?php
class Bid{
  
    // database connection and table name
    private $conn;
  
    // object properties
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all bids by object_id and user_id
    function read($object_id, $user_id){

        // select all query
        $query = "SELECT * FROM Bid WHERE object_id = :object_id AND user_id = :user_id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('object_id', $object_id, PDO::PARAM_INT);
        $stmt->bindValue('user_id', $user_id, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }


    // read the last bid by object_id and user_id
    function readLastBid($object_id){
    
        $query = "SELECT bid_price FROM Bid WHERE object_id = :object_id ORDER BY bid_price DESC LIMIT 1";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('object_id', $object_id, PDO::PARAM_INT);
        // $stmt->bindValue('user_id', $user_id, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // add a bid with user_id, object_id and bid_price
    function add($user_id, $object_id, $bid_price) {
    
        $query = "INSERT INTO Bid (user_id, object_id, bid_price) VALUES (:user_id, :object_id, :bid_price)";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue('object_id', $object_id, PDO::PARAM_INT);
        $stmt->bindValue('bid_price', $bid_price, PDO::PARAM_STR);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}
?>