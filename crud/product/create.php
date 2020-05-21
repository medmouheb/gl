<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once  '../../config/database.php';
include_once '../../objects/product.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
 
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$product->name = $data->name;
$product->description = $data->description;
$product->idCompany = $data->idCompany;
$product->photo = $data->photo;
 
// create the product
if(
    !empty($product->name) &&
    !empty($product->description) &&
    !empty($product->idCompany) &&
    !empty($product->photo) &&
    $product->create()
){
 
    http_response_code(200);
 
    echo json_encode(array("message" => "product was created."));
} 
else{
 
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to create product."));
}
?>