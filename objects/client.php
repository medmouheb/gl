<?php
class Client
{

    public $conn;
    private $table_name = "client";

    public $id;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $phone;
    public $photo;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {

        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }
    function login()
    {

        $query = "SELECT * FROM " . $this->table_name . " where email=:email and password=:password";

        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        $stmt->execute();

        return $stmt;
    }

    function signup()
    {
        $query = "INSERT INTO 
          " . $this->table_name . "
            SET
            email=:email,
            password=:password,
            first_name=:first_name,
            last_name=:last_name,
            phone=:phone,
            photo=:photo
            ";

        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->photo = htmlspecialchars(strip_tags($this->photo));

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":photo", $this->photo);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=" . $this->id;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
