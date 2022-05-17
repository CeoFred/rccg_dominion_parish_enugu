<?php session_start();

 // required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('HEY NIGGA!! SEND THE RIGHT REQUEST TYPE');
}

// include database and object file
include_once '../../config/db.php';
include_once '../../core/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$user = new User($db);


$pin = isset($_REQUEST['pin']) ? $_REQUEST['pin'] : null;
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if($pin === null || $user_id === null){
        echo $user->forbidden('Pin is required');
        return;
}

/**
 * More security measures should be implemented for now skipping it
 */

 try {
   
   $user->query("SELECT *
     FROM users WHERE transaction_pin = ? AND user_id = ?",[$pin,$user_id]);

    if($user->_result){
        $pass = $user->_result[0]->password;
        echo  $user->actionSuccess(['data' => true]);
    } else {
        
    echo  $user->actionFailure('Wrong PIN!');
    return;
    }

 } catch (\Throwable $th) {
        echo $user->actionFailure('Opps! Something went wrong, error code xm112c3'. $th->getMessage()); 
        die;
    }

