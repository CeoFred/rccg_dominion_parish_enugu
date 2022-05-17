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
  
  !empty($_REQUEST['firstname']) &&
  !empty($_REQUEST['lastname']) &&
  !empty(trim($_REQUEST['mobile']))

  ){

    $user->firstname = trim($_REQUEST['firstname']);
  $user->lastname = trim($_REQUEST['lastname']);
  $user->mobile = trim($_REQUEST['mobile']);
  $user->user = trim($_SESSION['user_id']);


try {
    if($user->updateProfile()){
             // set response code - 200 ok
     http_response_code(200);

     echo $user->actionSuccess("Profile was updated.");

     return;
    }

} catch (\Throwable $th) {
  
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo $user->forbidden("Unable to update profile. ".$th->getMessage());
    return;
}



  }else{

  // set response code - 400 bad request
  http_response_code(400);

  // tell the user
  echo $user->notFound(json_encode($_REQUEST));

  }


