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
include_once '../../core/notifications.php';
// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$user = new User($db);
$notify = new Notifications($db);

$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;

if($email === null || $password === null){
   
        echo $user->forbidden('Email or password was left empty');
        return;
}

/**
 * More security measures should be implemented for now skipping it
 */

 try {
   
   $user->query("SELECT *
     FROM users WHERE email = ? AND status = ?",[$email,1]);

    if($user->_result){
        $pass = $user->_result[0]->password;
     $valid =   password_verify($password,$pass) ? 1 : 0;
     if($valid){
        $user->_result[0]->password= null;
        session_regenerate_id(true);

        $notify->activity_type = 'Authentication';
        $notify->ip = $_SERVER['REMOTE_ADDR'];
        $notify->browser = $_SERVER['HTTP_USER_AGENT'];
        $notify->message = "You logged in on ".date('l jS \of F Y h:i:s A');
        $notify->create($user->_result[0]->user_id);
        
        $_SESSION['user_id'] = $user->_result[0]->user_id;
        $_SESSION['user_authenticated'] =  true;
        $_SESSION['firstname'] = $user->_result[0]->firstname;
        $_SESSION['username'] = $user->_result[0]->username;
        $_SESSION['lastname'] = $user->_result[0]->lastname;
        $_SESSION['account_balance'] = $user->_result[0]->account_balance;
        $_SESSION['pending_withdrawal'] = $user->_result[0]->pending_withdrawal;
        $_SESSION['user_id'] = $user->_result[0]->user_id;
        $_SESSION['earned_total'] = $user->_result[0]->earned_total; 
        $_SESSION['withdrawal_total'] = $user->_result[0]->withdrawal_total; 
        $_SESSION['total_deposit'] = $user->_result[0]->total_deposit; 
        $_SESSION['current_deposit'] = $user->_result[0]->current_deposit; 
        $_SESSION['account_number'] = $user->_result[0]->account_number; 
        $_SESSION['permanent_address'] = $user->_result[0]->permanent_address; 
        $_SESSION['temporary_address'] = $user->_result[0]->temporary_address; 
        $_SESSION['mobile'] = $user->_result[0]->mobile; 
        $_SESSION['email'] =  $user->_result[0]->email;
        $_SESSION['referral_id'] = $user->_result[0]->referral_id;
        $_SESSION['referral_bonus'] = $user->_result[0]->referral_bonus;
        $_SESSION['profile_photo_url'] = $user->_result[0]->profile_photo_url;


        $_SESSION['last_login'] = date('l jS \of F Y h:i:s A');
    echo  $user->actionSuccess(['data' => $user->_result]);
    return;
     }else{
    echo  $user->actionFailure('Email and password does not match');
        return;
     }
    } else {
        
    echo  $user->actionFailure('Account does not exist or disabled');
    return;
    }

 } catch (\Throwable $th) {
        echo $user->actionFailure('Opps! Something went wrong, error code xm112c3'. $th->getMessage()); 
        die;
    }

