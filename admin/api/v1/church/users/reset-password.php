<?php session_start();

 // required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
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




$token = isset($_GET['T']) ? $_GET['T'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$confirm_password = isset($_POST['c_password']) ? $_POST['c_password'] : null;

if($token === null){
    http_response_code(400);
     $_SESSION['ERROR'] = 'Reset Token is invalid';
    return header('Location: ../../../create-new-password.php?T=REQUIRED&E=TOKEN');
}

if(!$password){

    http_response_code(400);
     $_SESSION['ERROR'] = 'Please input a new password';
    return header('Location: ../../../create-new-password.php?T=REQUIRED&E=PASSWORD-NULL');
}

if(strlen($password) < 6){
    http_response_code(400);
     $_SESSION['ERROR'] = 'Password should be more than 6 characters';
    return header('Location: ../../../create-new-password.php?T=REQUIRED&E=PASSWORD-LENGTH');
}

if($password !== $confirm_password){

    http_response_code(400);
     $_SESSION['ERROR'] = 'Passwords do not match';
    return header('Location: ../../../create-new-password.php?T=REQUIRED&E=PASSWORD-NULL');
}

 try {
   
    $user->token = $token;
    $newPassword = $_POST['password'];

    $user->password = $newPassword;
    $user->finalizeAccountRecovery();


 } catch (\Throwable $th) {
     http_response_code(400);
     throw $th;
  $_SESSION['ERROR'] = 'Something went wrong!';

     return header('Location: ../../../create-new-password.php');
    }

