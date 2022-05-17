<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/db.php';
include_once '../core/index.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare job object
$investment = new Deposit($db);

// echo json_encode($_REQUEST);
// return;
if(
  
  !empty($_REQUEST['deposit_id'])

  ){

    $investment->status = 1;
    $investment->deposit_id = $_REQUEST['deposit_id'];
    $investment->user_id = $_REQUEST['user_id'];
    $investment->plan_id = $_REQUEST['plan_id'];
    $investment->deposit_amount = $_REQUEST['deposit_amount'];


try {

  
    $update =  $investment->confirmInvestment();

    if($update === true){
        
     // set response code - 200 ok
     http_response_code(200);

     echo $investment->success(["id" => $investment->deposit_id]);

     return;
    } else {
        
     // set response code - 403 
     http_response_code(405);

     echo $investment->actionFailure("Deposit Investment was not updated.");

     return;
    }
  
} catch (\Throwable $th) {
  
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo $investment->forbidden("Unable to update investment. ".$th->getMessage());
    return;
}



  }else{

  // set response code - 400 bad request
  http_response_code(400);

  // tell the user
  echo $investment->notFound(json_encode($_REQUEST));

  }


