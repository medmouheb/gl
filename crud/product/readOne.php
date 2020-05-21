<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once  '../../config/database.php';
include_once '../../objects/product.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
 
$data = json_decode(file_get_contents("php://input"));
 
$product->id = $data->id;
$stmt = $product->readOne();
if(
    $stmt
){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    http_response_code(200);
 
    echo json_encode(array("data" =>  $row ));
} 
else{
 
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to get product."));
}
?>