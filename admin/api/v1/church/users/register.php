<?php session_start();

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
include_once '../../core/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare job object
$user = new User($db);

// get user_i

$firstname = isset($_REQUEST['firstname']) ? $_REQUEST['firstname'] : null;
$lastname = isset($_REQUEST['lastname']) ? $_REQUEST['lastname'] : null;
$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : null;
$fullname = isset($_REQUEST['fullname']) ? $_REQUEST['fullname'] : null;
$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
$bitcoin_wallet = isset($_REQUEST['bitcoin_wallet']) ? $_REQUEST['bitcoin_wallet'] : null;
$pin = isset($_REQUEST['pin']) ? $_REQUEST['pin'] : null;

$was_referred = $_REQUEST['was_referred'];
$referred_by = isset($_REQUEST['referred_by']) ? $_REQUEST['referred_by'] : null;


if($firstname === null || $firstname === null || $lastname ===   null || $password === null){
        http_response_code(403);
        // echo $_REQUEST['firstname'];
        echo $user->forbidden('You cannot go any furthe,details are incomplete');
        return;
}

$user->firstname =  $firstname;
$user->lastname = $lastname;
$user->email = $email;
$user->password = $password;
$user->username = $username;
$user->fullname = $firstname.' '.$lastname;
$user->bitcoin_wallet = $bitcoin_wallet;
$user->was_referred = $was_referred;
$user->referred_by = $referred_by;
$user->transaction_pin = $pin;

$user->query("SELECT email FROM $user->table_name WHERE email =? OR username = ?",[$email, $username]);

if($user->_result){
    
    echo $user->actionFailure('Email or Username already in use');
    return;
}

 try {

    $user_id =  $user->register();
     http_response_code(201);
     $user_d = $user->singleUser($user_id)->fetchAll(PDO::FETCH_ASSOC)[0];
          session_regenerate_id(true);

     $_SESSION['user_id'] = $user_d['user_id'];
     $_SESSION['user_authenticated'] =  true;
     $_SESSION['firstname'] = $user_d['firstname'];
     $_SESSION['username'] = $user_d['username'];
     $_SESSION['lastname'] = $user_d['lastname'];
     $_SESSION['account_balance'] = $user_d['account_balance'];
     $_SESSION['pending_withdrawal'] = $user_d['pending_withdrawal'];
     $_SESSION['user_id'] = $user_d['user_id'];
     $_SESSION['earned_total'] = $user_d['earned_total']; 
     $_SESSION['withdrawal_total'] = $user_d['withdrawal_total']; 
     $_SESSION['total_deposit'] = $user_d['total_deposit']; 
     $_SESSION['current_deposit'] = $user_d['current_deposit']; 
     $_SESSION['account_number'] = $user_d['account_number']; 
     $_SESSION['permanent_address'] = $user_d['permanent_address']; 
     $_SESSION['temporary_address'] = $user_d['temporary_address']; 
     $_SESSION['mobile'] = $user_d['mobile']; 
     $_SESSION['email'] =  $user_d['email'];
     $_SESSION['referral_id'] = $user_d['referral_id'];
     $_SESSION['referral_bonus'] = $user_d['referral_bonus'];
     $_SESSION['last_login'] = date('l jS \of F Y h:i:s A');
     $_SESSION['profile_photo_url'] = $user_d['profile_photo_url'];
     
    setcookie("user_id", $user_d['user_id'], time()+3600000);
    setcookie("user_authenticated", true, time()+3600000);
    setcookie("last_login", date('l jS \of F Y h:i:s A'), time()+3600000);
    setcookie("email", $user_d['email'], time()+3600000);
    setcookie("account_number",$user_d['account_number'], time()+3600000);

    
     echo $user->actionSuccess('Account Was created successfully');
     return;

 } catch (\Throwable $th) {
    http_response_code(505);

        echo $user->actionFailure('Opps! Something went wrong, error code xm112c3 '. $th->getMessage()); 
        die;
}

