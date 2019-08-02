<?php
class Menus {
    // database connection and table name
    private $conn;
    private $table_name = "tbl_posts";
 
    // object properties
    public $id;
    public $title;
    public $content;
    public $price;
    public $image;
    public $posted_by;
    public $timestamp;
 
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
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = " .$_GET['edit_id'];  
 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }

    function create() {

        $query = "INSERT INTO " . $this->table_name . "
                SET 
                    id = :id,
                    title = :title,
                    content = :content,
                    price = :price,
                    image = :image,
                    posted_by = :posted_by,
                    created_at = :created_at
                ";
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->posted_by = htmlspecialchars(strip_tags($this->posted_by));
        
        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":posted_by", $this->posted_by);
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
                    title = :title,
                    content = :content,
                    price = :price,
                    image = :image,
                    posted_by = :posted_by,
                    created_at = :created_at
                WHERE
                    id = :id";
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->posted_by = htmlspecialchars(strip_tags($this->posted_by));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":posted_by", $this->posted_by);
        $stmt->bindParam(":created_at", $this->timestamp);


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