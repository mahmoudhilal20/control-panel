<?php
class DB_Connect_LP {
    private $conn;
    // Connecting to database
    function __construct() {
    }  
    public function connect_LP($DomainID) {
        require 'config_lp.php';    
        // Connecting to mysql database
        $this->conn = new mysqli(DB_HOST1 ,DB_USER1 ,DB_PASSWORD1 ,DB_DATABASE1);
        // return database handler
        return $this->conn;
    }
}
?>