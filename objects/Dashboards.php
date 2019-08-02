<?php
class Dashboard {
    private $conn;
    private $users = "tbl_users";
    private $orders = "tbl_orders";
    private $sales = "tbl_sales";
    private $message = "tbl_contacts";

    public function __construct($db){
        $this->conn = $db;
    }

    function readUser() {
        $query = "SELECT count(1) AS total FROM " . $this->users . " WHERE userlevel = 'admin'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }

    function readOrder() {
        $query = "SELECT count(1) AS total FROM " . $this->orders;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }

    function readSales() {
        $query = "SELECT count(1) AS total FROM " . $this->sales;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }

    function readMessage() {
        $query = "SELECT count(1) AS total FROM " . $this->message;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }

}