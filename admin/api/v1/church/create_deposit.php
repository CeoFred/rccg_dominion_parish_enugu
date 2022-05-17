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

// instantiate deposit object
include_once '../core/index.php';

$database = new Database();
$db = $database->getConnection();

$deposit = new Deposit($db);

function randomNumber($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}
date_default_timezone_set('Africa/Lagos');
// var_dump(date_default_timezone_get());
// die();
// make sure data is not empty
if(
    !empty($_REQUEST['amount']) && 
    !empty($_SESSION['user_id']) &&
    !empty($_SESSION['firstname']) &&
    !empty($_SESSION['lastname']) && 
    !empty($_REQUEST['plan_id']) &&
    !empty($_REQUEST['payment_method'])

){

    // set deposit property values
    $deposit->amount = trim($_REQUEST['amount']);
    $deposit->user_id = trim($_SESSION['user_id']);
    $deposit->depositors_first_name = trim($_SESSION['firstname']);
    $deposit->depositors_last_name = trim($_SESSION['lastname']);
    $deposit->payment_method = $_REQUEST['payment_method'];
    $deposit->plan_id = trim($_REQUEST['plan_id']);
   
    $date_due = date_create(date("Y-m-d H:i:s"));
    
$days_array  = ['Basic' => '5 days','Standard' => '7 days','Medium' => '10 days'];
$real_due_time = $days_array[$deposit->plan_id];

    date_add($date_due, date_interval_create_from_date_string($real_due_time));

    $deposit->date_due = date_format($date_due,"Y-m-d H:i:s");

    $deposit->created_at = date('Y-m-d H:i:s');
    $deposit->deposit_id = randomNumber(50);      

    // create the deposit 
    if($deposit->create()){

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo $deposit->Success(['msg' => 'deposit created successfully','deposit_id' => $deposit->deposit_id ]);
    }

    // if unable to create the deposit, tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo $deposit->forbidden('Opps! Something went wrong');
    }
}

// tell the user data is incomplete
else{

    // set response code - 400 bad request
    http_response_code(409);

    // tell the user
   echo $deposit->actionFailure('Unable to create deposit. Data is incomplete.');
}
