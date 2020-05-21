<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once  '../../config/database.php';
include_once '../../objects/company.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new Company($db);
 
$data = json_decode(file_get_contents("php://input"));
 
$user->id = $data->id;
$stmt = $user->delete();
if(
    $stmt
){
    
    http_response_code(200);
 
    echo json_encode(array("message" =>  "company deleted"));
} 
else{
 
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to delete company."));
}
?>