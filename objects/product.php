<?php
class Product{
    public $conn;
    private $table_name = "product";

    public $id;
    public $name;
    public $description;
    public $idCompany;
    public $photo;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    function read(){
        
        $query = "SELECT * FROM " . $this->table_name." where idCompany = ".$this->idCompany;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
      
        return $stmt;
  
    }
    function readOne(){
        
        $query = "SELECT * FROM " . $this->table_name." where id = ".$this->id;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
      
        return $stmt;
  
    }
    function create(){
        $query = "INSERT INTO 
        " . $this->table_name . "
          SET
          name=:name,
          description=:description,
          idCompany=:idCompany,
          photo=:photo
        ";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->idCompany = htmlspecialchars(strip_tags($this->idCompany));
        $this->photo = htmlspecialchars(strip_tags($this->photo));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":idCompany", $this->idCompany);
        $stmt->bindParam(":photo", $this->photo);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
   
}
