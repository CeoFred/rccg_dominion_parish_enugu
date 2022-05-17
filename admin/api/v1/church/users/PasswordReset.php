<?php session_start();

 // required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die(' SEND THE RIGHT REQUEST TYPE');
}

// include database and object file
include_once '../../config/db.php';
include_once '../../core/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$user = new User($db);




$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;

if($email === null){
    http_response_code(400);
        echo $user->actionFailure('Email is required');
        return;
}


 try {
   
    $user->email = $email;

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        http_response_code(400);
        echo $user->actionFailure('Email is not valid');
        return;
    }

    $response = $user->passwordReset();

    if($response['status']){
        echo  $user->actionSuccess(['data' => $response['message']]);
        return;


    } else {
        http_response_code(400);
        echo $user->actionFailure($response['message']);
        return;
    }

 } catch (\Throwable $th) {
     http_response_code(400);
        echo $user->actionFailure('Opps! Something went wrong, error code xm112c3'. $th->getMessage()); 
        return;
    }

