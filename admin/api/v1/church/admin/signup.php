<?php

/**
 * Here we want to register a new admin
 */

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

// prepare job object
$admin = new Admin($db);

// get admin_i

$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : null;
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

// check if email is valid
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(403);
    echo $admin->forbidden('Invalid Email Format');
    return;
}

if($firstName === null || $firstName === null || $lastName ===   null || $password === null){
        http_response_code(403);
        echo $admin->forbidden('You cannot go any furthe,details are incomplete');
        return;
}

$admin->firstName =  $firstName;
$admin->lastName = $lastName;
$admin->email = $email;
$admin->password = $password;


$admin->query("SELECT email FROM $admin->table_name WHERE email =? ",[$email]);

if($admin->_result){
    http_response_code(403);
    echo $admin->actionFailure('Email already in use');
    return;
}

 try {

     $admin->register();
     http_response_code(201);
     echo $admin->dataCreated('Account created successfully');
     return;

 } catch (\Throwable $th) {
    http_response_code(500);

        echo $admin->actionFailure('Opps! Something went wrong, error code xm112c3 '. $th->getMessage()); 
        die;
}

