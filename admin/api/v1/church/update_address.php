<?php session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/db.php';
include_once '../core/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare job object
$user = new User($db);


// echo json_encode($_REQUEST);
// return;
if(
  
  !empty($_REQUEST['country']) &&
  !empty($_REQUEST['state']) &&
  !empty(trim($_REQUEST['permanent_address']))   &&
  !empty($_REQUEST['temporary_address']) 


  ){

    $user->country = trim($_REQUEST['country']);
  $user->state = trim($_REQUEST['state']);
  $user->permanent_address = trim($_REQUEST['permanent_address']);
  $user->temporary_address = trim($_REQUEST['temporary_address']);
  $user->user = trim($_SESSION['user_id']);


try {
    if($user->updateAdress()){
             // set response code - 200 ok
     http_response_code(200);

     echo $user->actionSuccess("Address was updated.");

     return;
    }

  
} catch (\Throwable $th) {
  
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo $user->forbidden("Unable to update address. ".$th->getMessage());
    return;
}



  }else{

  // set response code - 400 bad request
  http_response_code(400);

  // tell the user
  echo $user->notFound(json_encode($_REQUEST));

  }


