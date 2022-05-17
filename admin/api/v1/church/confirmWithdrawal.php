<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/db.php';
include_once '../core/withdrawal.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare job object
$withdrawal = new Withdrawals($db);

// echo json_encode($_REQUEST);
// return;
if(
  
  !empty($_REQUEST['withdrawal_id'])

  ){

    $withdrawal->status = 1;
    $withdrawal->withdrawal_id = $_REQUEST['withdrawal_id'];
    $withdrawal->user_id = $_REQUEST['user_id'];
    $withdrawal->amount = $_REQUEST['amount'];

try {
    $update =  $withdrawal->confirmwithdrawal();

    echo $update;
    return;
    if($update === true){
        
     // set response code - 200 ok
     http_response_code(200);

     echo $withdrawal->actionSuccess("withdrawal was updated.",$update);

     return;
    } else {
        
     // set response code - 403 
     http_response_code(405);

     echo $withdrawal->actionFailure("Deposit withdrawal was not updated.",$update);

     return;
    }
  
} catch (\Throwable $th) {
  
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo $withdrawal->forbidden("Unable to update withdrawal. ".$th->getMessage());
    return;
}



  }else{

  // set response code - 400 bad request
  http_response_code(400);

  // tell the user
  echo $withdrawal->notFound(json_encode($_REQUEST));

  }


