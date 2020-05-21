<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once  '../../config/database.php';
include_once '../../objects/review.php';
 
$database = new Database();
$db = $database->getConnection();
 
$review = new Review($db);
 
$data = json_decode(file_get_contents("php://input"));
 
// set review property values
$review->text = $data->text;
$review->idProduct = $data->idProduct;
$review->idCompany = $data->idCompany;

$review->idClient = $data->idClient;
 
// create the review
if(
    !empty($review->text) &&
    !empty($review->idProduct) &&
    !empty($review->idClient) &&
    !empty($review->idCompany) &&
    $review->create()
){
 
    http_response_code(200);
 
    echo json_encode(array("message" => "review was created."));
} 
else{
 
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to create review."));
}
?>