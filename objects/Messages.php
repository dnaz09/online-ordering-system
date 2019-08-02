<?php
class Messages {
    private $conn;
    private $table_name = "tbl_contacts";
 
    // object properties
    public $id;
    public $firstname;
    public $lastname;
    public $mobile;
    public $email;
    public $message;
    public $status;

    public function __construct($db){
        $this->conn = $db;
    }

    function update() {
        $query = "UPDATE " . $this->table_name . "
                    SET
                        status = :status
                    WHERE
                        status = 0
                ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":status", $this->status);
        $this->status = "1";

        $stmt->bindParam(":status", $this->status);

        $stmt->execute();

        return $stmt;
    }

    function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC LIMIT 5";  
 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }

    function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE status = 0";  
 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }
}
?>