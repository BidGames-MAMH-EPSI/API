<?php
class House
{

    // database connection and table name
    private $conn;


    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }


    // read all houses on the nav bar
    function read()
    {

        // select all query
        $query = "SELECT house_id, name FROM Houses";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // read one house by id
    function readOne($house_id)
    {

        // select all query
        $query = "SELECT * FROM Houses WHERE house_id = :house_id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('house_id', $house_id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // read one house by id
    function readNameForOneHouse($house_id)
    {

        // select all query
        $query = "SELECT name FROM Houses WHERE house_id = :house_id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('house_id', $house_id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // read distinct city of all houses
    function readDistinctCities()
    {

        // select all query
        $query = "SELECT DISTINCT(city) FROM Houses";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}