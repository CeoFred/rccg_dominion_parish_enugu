<?php session_start();

 // required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    die('DEAD END!!');
}

// include database and object file
include_once '../../config/db.php';
include_once '../../core/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$user = new User($db);




$token = isset($_GET['t']) ? $_GET['t'] : null;

if($token === null){
    http_response_code(400);
     $_SESSION['ERROR'] = 'Reset Token is required';

    return header('Location: ../../../index.php?T=REQUIRED&E=TOKEN');
}


 try {
   
    $user->token = $token;

    $user->confirmPasswordResetToken();


 } catch (\Throwable $th) {
     http_response_code(400);
  $_SESSION['ERROR'] = 'Something went wrong!';

     return header('Location: ../../../index.php');
    }

