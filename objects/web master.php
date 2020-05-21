<?php
class WebMaster{
  
    public $conn;
    private $table_name = "web_master";
  
    public $id;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $phone;

  
    public function __construct($db){
        $this->conn = $db;
    }


    function login(){
        
        $query = "SELECT * FROM " . $this->table_name." where email=:email and password=:password" ;

        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        $stmt->execute();
      
        return $stmt;
  
    }

}
?>