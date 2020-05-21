<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once  '../../config/database.php';
include_once '../../objects/company.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new Company($db);
 
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$user->email = $data->email;
$user->password = $data->password;
$user->company_name = $data->company_name;
$user->company_logo = $data->company_logo;
$user->phone = $data->phone;
 
// create the user
if(
    !empty($user->email) &&
    !empty($user->password) &&
    !empty($user->company_name) &&
    !empty($user->company_logo) &&
    !empty($user->phone) &&
    $user->create()
){
 
    http_response_code(200);
 
    echo json_encode(array("message" => "User was created."));
} 
else{
 
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to create user."));
}
?>