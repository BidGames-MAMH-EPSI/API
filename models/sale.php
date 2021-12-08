<?php
class Sale
{

    // database connection and table name
    private $conn;

    // object properties

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }


    // read one user by id
    function findAllSalesWithThemImageByHouseId($max = 10, $page = 1, $house_id = null)
    {
        if (is_null($house_id)) {
            $query = "SELECT * FROM Sales INNER JOIN Images ON Sales.sale_id = Images.sale_id LIMIT :min,:pas";
        } else {
            $query = "SELECT * FROM Sales INNER JOIN Images ON Sales.sale_id = Images.sale_id WHERE house_id = :house_id LIMIT :min,:pas";
        }
        // select all query


        // prepare query statement
        $stmt = $this->conn->prepare($query);

        if (!is_null($house_id)) {
            $stmt->bindValue('house_id', $house_id, PDO::PARAM_INT);
        }

        $min = ($page - 1) * $max;
        $pas = $max;

        $stmt->bindValue('min', $min, PDO::PARAM_INT);
        $stmt->bindValue('pas', $pas, PDO::PARAM_INT);


        // execute query
        $stmt->execute();

        return $stmt;
    }

    // read one sale by sale_id
    function readOneIdById($sale_id)
    {
        // select all query
        $query = "SELECT sale_id FROM Sales WHERE sale_id = :sale_id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('sale_id', $sale_id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // read one sale by sale_id
    function readOne($sale_id)
    {
        // select all query
        $query = "SELECT * FROM Sales WHERE sale_id = :sale_id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('sale_id', $sale_id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}