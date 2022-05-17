<?php session_start();

 // required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
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



$result = [];
$data =  file_get_contents("php://input",);
mb_parse_str($data, $result);

$old_pin = isset($result['old_pin']) ? $result['old_pin'] : null;
$new_pin = isset($result['new_pin']) ? $result['new_pin'] : null;


$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if($old_pin === null){
    http_response_code(400);
        echo $user->actionFailure('Old Transaction Pin is required');
        return;
}

if($new_pin === null){
    http_response_code(400);

    echo $user->actionFailure('New Transaction Pin is required');
    return;
}
if($user_id === null){
    http_response_code(400);

    echo $user->actionFailure('Authentication Error, try again!');
    return;
}


/**
 * More security measures should be implemented for now skipping it
 */

 try {
   
    $user->oldPin = $old_pin;
    $user->newPin = $new_pin;

    $response = $user->pinUpdate();

    if($response['status']){
        echo  $user->actionSuccess(['data' => $response['message']]);
        die();

    } else {
        http_response_code(400);
        echo $user->actionFailure($response['message']);
        die();
    }

 } catch (\Throwable $th) {
     http_response_code(400);
        echo $user->actionFailure('Opps! Something went wrong, error code xm112c3'. $th->getMessage()); 
        die;
    }

