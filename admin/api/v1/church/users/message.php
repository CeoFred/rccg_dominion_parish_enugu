<?php
session_start();

/**
 * Here we want to register a new user
 */

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
include_once '../../core/messages.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare job object
$message = new Messages($db);

// get user_i

$name = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
$subject = isset($_REQUEST['subject']) ? $_REQUEST['subject'] : null;
$content = isset($_REQUEST['content']) ? $_REQUEST['content'] : null;
$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;

// var_dump($_REQUEST);
if($name === null || $content === null ){
        http_response_code(403);
        // echo $_REQUEST['firstname'];
        echo $message->forbidden('Check required fields and try again');
        return;
}

$message->name =  $name;
$message->subject = $subject;
$message->content = $content;
$message->email = $email;

 try {

    $message_ =  $message->create();
    if($message_){
        
    http_response_code(201);

    echo $message->actionSuccess('Message Was sent successfully');
    return;

    }
 } catch (\Throwable $th) {
    http_response_code(505);

        echo $message->actionFailure('Opps! Something went wrong, error code xm112c3 '. $th->getMessage()); 
        die;
}

