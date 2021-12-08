<?php
class FlashSale
{

    // database connection and table name
    private $conn;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read all flash_sales
    function read()
    {

        // select all query
        $query = "SELECT * FROM Flash_sale";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // read one sale by id
    function readOne($object_id, $user_id)
    {

        // select all query
        $query = "SELECT * FROM Flash_sale WHERE object_id = :object_id AND user_id = :user_id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('object_id', $object_id, PDO::PARAM_INT);
        $stmt->bindValue('user_id', $user_id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // flash sale by user_id, object_id, flash price and status
    function add($user_id, $object_id, $flash_price, $status)
    {

        $query = "INSERT INTO Flash_sale (user_id, object_id, flash_price, status) VALUES (:user_id, :object_id, :flash_price, :status)";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue('object_id', $object_id, PDO::PARAM_INT);
        $stmt->bindValue('flash_price', $flash_price, PDO::PARAM_INT);
        $stmt->bindValue('status', $status, PDO::PARAM_STR);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}