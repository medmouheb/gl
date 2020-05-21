<?php
class Company
{

    public $conn;
    private $table_name = "company";

    public $id;
    public $email;
    public $password;
    public $company_name;
    public $company_logo;
    public $phone;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read(){
        
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

    function create()
    {
        $query = "INSERT INTO 
        " . $this->table_name . "
          SET
          email=:email,
          password=:password,
          company_name=:company_name,
          company_logo=:company_logo,
          phone=:phone
        ";

        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->company_name = htmlspecialchars(strip_tags($this->company_name));
        $this->company_logo = htmlspecialchars(strip_tags($this->company_logo));
        $this->phone = htmlspecialchars(strip_tags($this->phone));

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":company_name", $this->company_name);
        $stmt->bindParam(":company_logo", $this->company_logo);
        $stmt->bindParam(":phone", $this->phone);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    function delete(){
        $query="DELETE FROM ".$this->table_name." WHERE id=".$this->id;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
