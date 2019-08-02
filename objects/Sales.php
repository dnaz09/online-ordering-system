<?php
class Sales {
    private $conn;
    private $table_name = "tbl_sales";
 
    // object properties
    public $id;
    public $order_date;
    public $title;
    public $price;
    public $quantity;
    public $total;
    public $firstname;
    public $lastname;
    public $email;
    public $contact;

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

    function takeout() {
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    id = :id,
                    order_date = :order_date,
                    title = :title,
                    price = :price,
                    quantity = :quantity,
                    total = :total,
                    firstname = :firstname,
                    lastname = :lastname,
                    email = :email,
                    contact = :contact
                ";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->order_date = htmlspecialchars(strip_tags($this->order_date));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->total = htmlspecialchars(strip_tags($this->total));
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->contact = htmlspecialchars(strip_tags($this->contact));
        

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":order_date", $this->order_date);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":total", $this->total);
        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":contact", $this->contact);

        if($stmt->execute()) {
            return true;
        }
        else {
            return false;
        }
    }
}
?>