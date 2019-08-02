<?php
class Feedbacks {
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

    function read() {
        //select all data
        $query = "SELECT * FROM " . $this->table_name;  

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function readOne() {
        $query = "SELECT message FROM " . $this->table_name . " WHERE id = " .$_GET['view'];  
 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }

    function send() {
        $query = "INSERT INTO " . $this->table_name . "
                SET 
                    id = :id,
                    firstname = :firstname,
                    lastname = :lastname,
                    mobile = :mobile,
                    email = :email,
                    message = :message,
                    status = :status
                ";
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->message = htmlspecialchars(strip_tags($this->message));
        $this->status = 0;

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":mobile", $this->mobile);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":message", $this->message);
        $stmt->bindParam(":status", $this->status);
        



        if($stmt->execute()) {
            return true;
        }
        else {
            return false;
        }
    }

    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
 
        if($result = $stmt->execute()){
            return true;
        }
        else {
            return false;
        }
    }
}
?>