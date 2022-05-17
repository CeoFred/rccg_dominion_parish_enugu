<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../../config/db.php';
include_once '../../core/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare job object
$user = new User($db);


// echo json_encode($_REQUEST);
// return;
if(
  
  !empty($_REQUEST['user_id']) &&
  !empty($_REQUEST['account_number']) 

  ){

    foreach ($_REQUEST as $key => $value) {
        $user->$key = $value;
    }

try {
  $user->update();

     // set response code - 200 ok
     http_response_code(200);

     echo $user->actionSuccess("Package was updated.");

     return;
  
} catch (\Throwable $th) {
  
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo $user->forbidden("Unable to update user. ".$th->getMessage());
    return;
}



  }else{

  // set response code - 400 bad request
  http_response_code(400);

  // tell the user
  echo $user->notFound(json_encode($_REQUEST));

  }


