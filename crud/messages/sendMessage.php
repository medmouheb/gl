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
$review->type = $data->type;
$review->content = $data->content;
$review->idCompany = $data->idCompany;
$review->idClient = $data->idClient;
// create the review
if(
    !empty($review->type) &&
    !empty($review->content) &&
    !empty($review->idCompany) &&
    !empty($review->idClient) &&
    $review->sendMessage()
){
 
    http_response_code(200);
 
    echo json_encode(array("message" => "review was created."));
} 
else{
 
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to create review."));
}
?>