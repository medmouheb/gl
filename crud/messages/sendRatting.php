<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once  '../../config/database.php';
include_once '../../objects/messages.php';
 
$database = new Database();
$db = $database->getConnection();
 
$review = new Message($db);
 
$data = json_decode(file_get_contents("php://input"));
 
// set review property values
$review->idCompany = $data->idCompany;
$review->idClient = $data->idClient;
// create the review
if(
    !empty($review->idCompany) &&
    !empty($review->idClient) &&
    $review->sendRatting()
){
 
    http_response_code(200);
 
    echo json_encode(array("message" => "review was created."));
} 
else{
 
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to create review."));
}
?>