<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once  '../../config/database.php';
include_once '../../objects/client.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new Client($db);
 
$data = json_decode(file_get_contents("php://input"));
 
$stmt = $user->read();
$num = $stmt->rowCount();
if(
    $num>0
){
    $res=array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($res,$row);
    }
    // extract($row);
    // $userData=array(
    //     "id"=>$id,
    //     "email"=>$email,
    //     "password"=>$password,
    //     "company_name"=>$company_name,
    //     "company_logo"=>$company_logo,
    //     "phone"=>$phone
    // );
    http_response_code(200);
 
    echo json_encode(array("data" =>  $res));
} 
else{
 
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to get users."));
}
?>