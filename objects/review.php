<?php
class Review{
    public $conn;
    private $table_name = "review";

    public $id;
    public $text;
    public $idProduct;
    public $idClient;
    public $photo;
    public $isfexed;
    public $ratting;
    public $idCompany;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    function read(){
        
        $query = "SELECT * FROM " . $this->table_name." where idProduct = ".$this->idProduct;
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
      
        return $stmt;
  
    }
    function create(){
        $query = "INSERT INTO 
        " . $this->table_name . "
          SET
          text=:text,
          idProduct=:idProduct,
          idClient=:idClient,
          idCompany=:idCompany
        ";

        $stmt = $this->conn->prepare($query);

        $this->text = htmlspecialchars(strip_tags($this->text));
        $this->idProduct = htmlspecialchars(strip_tags($this->idProduct));
        $this->idClient = htmlspecialchars(strip_tags($this->idClient));
        $this->idCompany = htmlspecialchars(strip_tags($this->idCompany));
        $stmt->bindParam(":text", $this->text);
        $stmt->bindParam(":idProduct", $this->idProduct);
        $stmt->bindParam(":idClient", $this->idClient);
        $stmt->bindParam(":idCompany", $this->idCompany);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function isfexed(){
        
        $query = "UPDATE " . $this->table_name." SET isfexed='yes'  where idClient=:idClient and idCompany=:idCompany ";
        $stmt = $this->conn->prepare($query);
        $this->idClient = htmlspecialchars(strip_tags($this->idClient));
        $this->idCompany = htmlspecialchars(strip_tags($this->idCompany));
        $stmt->bindParam(":idClient", $this->idClient);
        $stmt->bindParam(":idCompany", $this->idCompany);

        $stmt->execute();
        return $stmt;
        
    }

    function ratting(){
        
        $query = "UPDATE " . $this->table_name." SET ratting=:ratting  where idClient=:idClient and idCompany=:idCompany ";
        $stmt = $this->conn->prepare($query);
        $this->idClient = htmlspecialchars(strip_tags($this->idClient));
        $this->idCompany = htmlspecialchars(strip_tags($this->idCompany));
        $this->ratting = htmlspecialchars(strip_tags($this->ratting));

        $stmt->bindParam(":ratting", $this->ratting);

        $stmt->bindParam(":idClient", $this->idClient);
        $stmt->bindParam(":idCompany", $this->idCompany);
        $stmt->execute();

        return $stmt;
  
    }
   
}
