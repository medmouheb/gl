<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once  '../../config/database.php';
include_once '../../objects/client.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new client($db);
 
$data = json_decode(file_get_contents("php://input"));
 
$user->email = $data->email;
$user->password = $data->password;
$stmt = $user->login();
$num = $stmt->rowCount();
if(
    $num>0
){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);
    $userData=array(
        "id"=>$id,
        "email"=>$email,
        "password"=>$password,
        "first_name"=>$first_name,
        "last_name"=>$last_name,
        "phone"=>$phone,
        "photo"=>$photo
    );
    http_response_code(200);
 
    echo json_encode(array("data" =>  $userData));
} 
else{
 
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to login web master."));
}
?>