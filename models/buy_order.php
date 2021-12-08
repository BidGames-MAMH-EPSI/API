<?php
class BuyOrder{
  
    // database connection and table name
    private $conn;
  
    // object properties
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all buy orders
    function read(){

        // select all query
        $query = "SELECT * FROM Buy_order";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }



    // add a buy order with user_id, object_id and bid_price
    function add($user_id, $object_id, $buy_order_price) {
    
        $query = "INSERT INTO Buy_order (user_id, object_id, buy_order_price) VALUES (:user_id, :object_id, :buy_order_price)";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue('object_id', $object_id, PDO::PARAM_INT);
        $stmt->bindValue('buy_order_price', $buy_order_price, PDO::PARAM_STR);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

       // add a buy order with user_id, object_id and bid_price
       function readOne($user_id, $object_id) {
    
        $query = "SELECT * FROM Buy_order WHERE user_id = :user_id AND object_id = :object_id";
    
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