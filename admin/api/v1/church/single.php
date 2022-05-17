<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/db.php';
include_once '../core/index.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare deposit object
$deposit = new Deposit($db);

// set ID property of record to read
$deposit->deposit_id = isset($_GET['deposit_id']) ? $_GET['deposit_id'] : die();

// read the details of deposit to be edited
$deposit->readOne();

if($deposit->id){
    // create array
    $deposit_arr = array(
        "id" =>  $deposit->id,
        "amount" => $deposit->amount,  
        "receipient_last_name" => $deposit->depositors_last_name,
        "receipient_first_name" => $deposit->depositors_first_name,
        "created_at" => $deposit->created_at
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo $deposit->success($deposit_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user deposit does not exist
    echo $deposit->notFound("deposit does not exist.");
}
