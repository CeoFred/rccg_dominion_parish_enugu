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
$withdrawal->id = $_REQUEST['id'];

// echo json_encode($_REQUEST);
// return;
if(
  
  !empty($_REQUEST['id'])

  ){

try {
    $update =  $withdrawal->delete($_REQUEST['id']);

    if($update === true){
        
     // set response code - 200 ok
     http_response_code(200);

      header("Location: /dashboard/invest/withdrawal_confirmation_status.php?id=$withdrawal->withdrawal_id");
     return;
    } else {
        
     // set response code - 403 
     http_response_code(405);
      header("Location: /dashboard/invest/withdrawal_confirmation_status.php?id=$withdrawal->withdrawal_id");
     return;
    }
  
} catch (\Throwable $th) {
  
    // set response code - 503 service unavailable
    http_response_code(503);

    header("Location: /dashboard/invest/withdrawal_confirmation_status.php?id=$withdrawal->withdrawal_id");
 return;
}



  }else{

  // set response code - 400 bad request
  http_response_code(400);

  header("Location: /dashboard/invest/withdrawals.php");
  die();
  }


