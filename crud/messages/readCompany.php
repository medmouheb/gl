<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once  '../../config/database.php';
include_once '../../objects/messages.php';
 
$database = new Database();
$db = $database->getConnection();
 
$review = new Message($db);
 
$data = json_decode(file_get_contents("php://input"));
 
$review->idCompany = $data->idCompany;
$stmt = $review->readCompany();
$num = $stmt->rowCount();
if(
    $num>0
){
    $res=array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($res,$row);
    }
    
    http_response_code(200);
 
    echo json_encode(array("data" =>  $res));
} 
else{
 
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to get review."));
}
?>