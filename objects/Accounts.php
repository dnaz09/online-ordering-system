<?php

class Accounts {
 
    // database connection and table name
    private $conn;
    private $table_name = "tbl_users";
 
    // object properties
    public $id;
    public $user_id;
    public $password;
    public $firstname;
    public $lastname;
    public $userlevel;
    public $user_status;
    public $timestamp;
 
    public function __construct($db){
        $this->conn = $db;
    }

    function read() {
        //select all data
        $query = "SELECT * FROM " . $this->table_name . " WHERE userlevel = 'admin'";  
 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }

    function create() {
 
        //write query
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    user_id = :user_id, 
                    password = :password, 
                    firstname = :firstname, 
                    lastname = :lastname, 
                    userlevel = :userlevel, 
                    user_status = :user_status, 
                    created_at = :created_at";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->password = htmlspecialchars(strip_tags($this->lastname));
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->userlevel = htmlspecialchars(strip_tags($this->userlevel));
        $this->user_status = htmlspecialchars(strip_tags($this->user_status));

        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');

        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":password", md5($this->lastname));
        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":userlevel", $this->userlevel);
        $stmt->bindParam(":user_status", $this->user_status);
        $stmt->bindParam(":created_at", $this->timestamp);

        if($stmt->execute()) {
            return true;
        } 
        else {
            return false;
        }
    }

    function update() {

        $query = "UPDATE " . $this->table_name . "
                SET
                    user_id = :user_id, 
                    password = :password, 
                    firstname = :firstname, 
                    lastname = :lastname, 
                    userlevel = :userlevel, 
                    created_at = :created_at
                WHERE 
                    id = :id";
            
        $stmt = $this->conn->prepare($query);

         // posted values
         $this->user_id = htmlspecialchars(strip_tags($this->user_id));
         $this->password = htmlspecialchars(strip_tags($this->lastname));
         $this->firstname = htmlspecialchars(strip_tags($this->firstname));
         $this->lastname = htmlspecialchars(strip_tags($this->lastname));
         $this->userlevel = htmlspecialchars(strip_tags($this->userlevel));
         $this->id = htmlspecialchars(strip_tags($this->id));
 
         // to get time-stamp for 'created' field
         $this->timestamp = date('Y-m-d H:i:s');
 
         $stmt->bindParam(":user_id", $this->user_id);
         $stmt->bindParam(":password", md5($this->lastname));
         $stmt->bindParam(":firstname", $this->firstname);
         $stmt->bindParam(":lastname", $this->lastname);
         $stmt->bindParam(":userlevel", $this->userlevel);
         $stmt->bindParam(":created_at", $this->timestamp);
         $stmt->bindParam(':id', $this->id);
 
        if($stmt->execute()) {
            return true;
        } 
        else {
            return false;
        }
        
    }

    // delete the product
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

    function enable() {
        $query = "UPDATE " . $this->table_name . "
        SET
            user_status = 'active'
        WHERE 
            id = :id";
    
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }
        else {
            return false;
        }
 
    }

    function disable() {
        $query = "UPDATE " . $this->table_name . "
        SET
            user_status = 'inactive'
        WHERE 
            id = :id";
    
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }
        else {
            return false;
        }
 
    }
 
}
?>