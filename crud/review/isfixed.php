<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once  '../../config/database.php';
include_once '../../objects/review.php';
 
$database = new Database();
$db = $database->getConnection();
 
$review = new Review($db);
 
$data = json_decode(file_get_contents("php://input"));
 
$review->idClient = $data->idClient;
$review->idCompany = $data->idCompany;
$stmt = $review->isfexed();
if(
    $stmt
){
    
    http_response_code(200);
 
    echo json_encode(array("data" =>  "succes"));
} 
else{
 
    http_response_code(400);
 
    echo json_encode(array("message" => "error."));
}
?>