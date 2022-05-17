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

$old_password = isset($result['old_password']) ? $result['old_password'] : null;
$new_password = isset($result['new_password']) ? $result['new_password'] : null;


$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if($old_password === null){
    http_response_code(400);
        echo $user->actionFailure('Old Password is required');
        return;
}

if($new_password === null){
    http_response_code(400);

    echo $user->actionFailure('New Password is required');
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
   
    $user->oldPassword = $old_password;
    $user->newPassword = $new_password;

    $response = $user->passWordUpdate();

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

