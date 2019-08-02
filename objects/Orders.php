<?php
class Orders {
    private $conn;
    private $table_name = "tbl_orders";
 
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
    public $order_status;
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

    function send() {
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
                    contact = :contact,
                    order_status = :order_status,
                    status = :status
                ";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->order_date = date('Y-m-d');
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->total = htmlspecialchars(strip_tags($this->total));
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->contact = htmlspecialchars(strip_tags($this->contact));
        $this->order_status = "pending";
        $this->status = 0;

        // bind values
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
        $stmt->bindParam(":order_status", $this->order_status);
        $stmt->bindParam(":status", $this->status);

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
                   order_status = :order_status
                WHERE
                    id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);
        $this->order_status = "confirmed";

        $stmt->bindParam(":order_status", $this->order_status);
        $stmt->bindParam(":id", $this->id);


        if($stmt->execute()) {
            return true;
        }
        else {
            return false;
        }
    }
}
?>