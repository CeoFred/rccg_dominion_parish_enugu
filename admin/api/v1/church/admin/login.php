<?php
session_start();

 // required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('HEY NIGGA!! SEND THE RIGHT REQUEST TYPE');
}

// include database and object file
include_once '../../config/db.php';
include_once '../../core/admin.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare admin object
$admin = new Admin($db);


$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;


// validate email regex
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo $admin->forbidden('Invalid Email Format');
    return;
}

if($email === null || $password === null){
        http_response_code(400);
        echo $admin->forbidden('Email or password was left empty');
        return;
}

/**
 * More security measures should be implemented for now skipping it
 */

 try {
   
   $admin->query("SELECT *
     FROM admin WHERE email = ?",[$email]);

    if($admin->_result){
        $pass = $admin->_result[0]->password;
     $valid =   password_verify($password,$pass) ? 1 : 0;
     if($valid){
        $_SESSION['admin_id'] = $admin->_result[0]->admin_id;
        $_SESSION['is_admin'] =  true;
        $_SESSION['admin_first_name'] = $admin->_result[0]->first_name;

    // update last login
    $admin->updateLastLogin($admin->_result[0]->admin_id);
    echo  $admin->actionSuccess('Login successful');
    return;
     }else{
    echo  $admin->unauthorized('Email and password does not match');
        return;
     }
    }

 } catch (\Throwable $th) {
        echo $admin->actionFailure('Opps! Something went wrong, error code xm112c3'. $th->getMessage()); 
        die;
    }

