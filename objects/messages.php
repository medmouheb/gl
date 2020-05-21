<?php
class Message
{

    public $conn;
    private $table_name = "message";

    public $id;
    public $type;
    public $content;
    public $idCompany;
    public $idClient;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    function sendMessage(){
        $query = "INSERT INTO 
          " . $this->table_name . "
            SET
            type=:type,
            content=:content,
            idCompany=:idCompany,
            idClient=:idClient
            ";

            $stmt = $this->conn->prepare($query);

            $this->content = htmlspecialchars(strip_tags($this->content));

            $stmt->bindParam(":type", $this->type);
            $stmt->bindParam(":content", $this->content);
            $stmt->bindParam(":idCompany", $this->idCompany);
            $stmt->bindParam(":idClient", $this->idClient);

            if ($stmt->execute()) {
                return true;
            }
            return false;
    }

    function sendRatting(){
        $query = "INSERT INTO 
          " . $this->table_name . "
            SET
            type='ratting',
            idCompany=:idCompany,
            idClient=:idClient
            ";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":idCompany", $this->idCompany);
            $stmt->bindParam(":idClient", $this->idClient);

            if ($stmt->execute()) {
                return true;
            }
            return false;
    }

    function sendFixed(){
        $query = "INSERT INTO 
          " . $this->table_name . "
            SET
            type='fixed',
            idCompany=:idCompany,
            idClient=:idClient
            ";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":idCompany", $this->idCompany);
            $stmt->bindParam(":idClient", $this->idClient);

            if ($stmt->execute()) {
                return true;
            }
            return false;

    }

    function readCompany(){
        $query = "SELECT * FROM " . $this->table_name." where idCompany = ".$this->idCompany;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
      
        return $stmt;
    }

    function readClient(){
        $query = "SELECT * FROM " . $this->table_name." where idClient = ".$this->idClient;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
      
        return $stmt;
    }

}
