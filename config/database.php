<?php
class Database{
  
    // specify your own database credentials
    private $host = "hugoscqbidgames.mysql.db";
    private $db_name = "hugoscqbidgames";
    private $username = "hugoscqbidgames";
    private $password = "BidGam3s";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        
        try {
            $this->conn = new \PDO("mysql:host=".$this->host.";dbname=".$this->db_name.";charset=utf8mb4;port=3306", $this->username, $this->password, $options);
        } catch (\PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>