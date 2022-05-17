<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/db.php';

// instantiate withd$withdrawal object
include_once '../core/withdrawal.php';

$database = new Database();
$db = $database->getConnection();

$withdrawal = new Withdrawals($db);

function randomNumber($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}
$withdrawal->withdrawal_id = randomNumber(40);

// var_dump($_REQUEST);
// die();
// make sure data is not empty
if(
    !empty($_REQUEST['wallet']) &&
    !empty($_REQUEST['wallet_id']) &&
    !empty($_SESSION['user_id']) &&
    !empty($_REQUEST['amount']) &&
    !empty($_SESSION['account_number'])

){

    // set withd$withdrawal property values
    $withdrawal->amount = trim($_REQUEST['amount']);
    $withdrawal->user_id = trim($_SESSION['user_id']);
    $withdrawal->wallet = trim($_REQUEST['wallet']);
    $withdrawal->wallet_id = trim($_REQUEST['wallet_id']);
   
    $withdrawal->created_at = date('Y-m-d H:i:s');

    // create the withd$withdrawal 
    if($withdrawal->create()){

        // set response code - 201 created
        http_response_code(201);
        $_SESSION['WITH'] = true;

        // tell the user
        echo $withdrawal->Success(['msg' => 'created successfully','withdrawal_id' => $withdrawal->withdrawal_id ]);
    }

    // if unable to create the withd$withdrawal, tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo $withdrawal->forbidden('Opps! Something went wrong');
    }
}

// tell the user data is incomplete
else{

    // set response code - 400 bad request
    http_response_code(409);

    // tell the user
   echo $withdrawal->actionFailure('Unable to create. Data is incomplete.');
}
?>