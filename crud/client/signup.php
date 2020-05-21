<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once  '../../config/database.php';
include_once '../../objects/client.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new Client($db);
 
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$user->email = $data->email;
$user->password = $data->password;
$user->first_name = $data->first_name;
$user->last_name = $data->last_name;
$user->phone = $data->phone;
$user->photo = $data->photo;
 
// create the user
if(
    !empty($user->email) &&
    !empty($user->password) &&
    !empty($user->first_name) &&
    !empty($user->last_name) &&
    !empty($user->phone) &&
    !empty($user->photo) &&
    $user->signup()
){
 
    http_response_code(200);
 
    echo json_encode(array("message" => "User was created."));
} 
else{
 
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to create user."));
}
?>