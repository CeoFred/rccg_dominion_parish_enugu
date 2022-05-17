<?php
require_once 'Base.php';
require_once 'mailer.php';

class User extends Base {

  // database connection and table name
  public $conn,$table_name = "users", $null  = null,$deleted_status = 2,$active_status = 1,$not_active = 0,$_result = null;
  private $_fetchStyle = PDO::FETCH_CLASS;

  // constructor with $db as database connection
  public function __construct($db){

    $this->conn = $db;
  
    }



    public function getAllRefrallBonus($user_id){
      $query = "SELECT
      *
  FROM
  referrals 
  WHERE
      referee_id = ?";

$stmt = $this->conn->prepare($query);
$stmt->bindParam(1, $user_id);
$stmt->execute();
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

return $row;
    }

    public function getAllReferallsForUser($referral_id){
      $query = "SELECT
      *
  FROM
      " . $this->table_name . " 
  WHERE
      referred_by = ?";

// prepare query statement
$stmt = $this->conn->prepare($query);

// bind id of job to be updated
$stmt->bindParam(1, $referral_id);


// execute query
$stmt->execute();

// get retrieved row
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

return $row;
    }
    public function restore($user_id)
    {
      # code...
      $query = "UPDATE users SET status=:status WHERE user_id=:user_id";

      $stmt =  $this->conn->prepare($query);


      $stmt->bindParam(':user_id', $user_id);
      $stmt->bindParam(':status', $this->active_status);

      return $stmt->execute();

    }

    function delete($user_id){
      $query = "UPDATE users SET status=:status WHERE user_id=:user_id";

      $stmt =  $this->conn->prepare($query);


      $stmt->bindParam(':user_id', $user_id);
      $stmt->bindParam(':status', $this->deleted_status);

      return $stmt->execute();


    }
    function getUser($user_id){
      
    // select all query
    $query = "SELECT *  FROM
    " . $this->table_name . "
    WHERE user_id=:user_id LIMIT 0,1
     ";

// prepare query statement
$stmt = $this->conn->prepare($query);

$stmt->bindParam(":user_id", $user_id);

// execute query
$stmt->execute();

return $stmt->fetch(PDO::FETCH_ASSOC);

    }
  function allUsers(){

    // select all query
    $query = "SELECT *  FROM
                " . $this->table_name . "
                ORDER BY created_at
                 DESC";

    // prepare query statement
    $stmt = $this->conn->prepare($query);



    // execute query
    $stmt->execute();

    return $stmt;
  }



  function updateAdress(){
        // update query
        $query =  "UPDATE
        " . $this->table_name . "
        SET
        
    permanent_address=:permanent_address,country=:country,
    state=:state,temporary_address=:temporary_address,updated_at=:updated_at
         WHERE
        user_id =:user_id";
    
// prepare query statement
$stmt = $this->conn->prepare($query);

$now = date('Y-m-d H:i:s');
// bind values
$stmt->bindParam(":updated_at", $now);
$stmt->bindParam(":permanent_address", $this->permanent_address);
$stmt->bindParam(":country", $this->country);
$stmt->bindParam(":state", $this->state);
$stmt->bindParam(":temporary_address", $this->temporary_address);
$stmt->bindParam(":user_id", $this->user);


// execute the query
if ($stmt->execute()) {
  return true;
}

return false;
  }


  
  function updateProfile(){
    // update query
    $query =  "UPDATE
    " . $this->table_name . "
    SET
    
firstname=:firstname,lastname=:lastname,mobile=:mobile,updated_at=:updated_at
     WHERE
    user_id =:user_id";

$stmt = $this->conn->prepare($query);

$now = date('Y-m-d H:i:s');
// bind values
$stmt->bindParam(":updated_at", $now);
$stmt->bindParam(":firstname", $this->firstname);
$stmt->bindParam(":lastname", $this->lastname);
$stmt->bindParam(":mobile", $this->mobile);
$stmt->bindParam(":user_id", $this->user);


// execute the query
if ($stmt->execute()) {
return true;
}

return false;
}
  function update(){

    // update query
    $query =    "UPDATE
                " . $this->table_name . "
                SET
                
            firstname=:firstname,lastname=:lastname,email=:email,
            updated_at=:updated_at,username=:username,account_number=:account_number,
            current_deposit=:current_deposit,total_deposit=:total_deposit,withdrawal_total=:withdrawal_total,
            earned_total=:earned_total,pending_withdrawal=:pending_withdrawal,account_balance=:account_balance,
            permanent_address=:permanent_address,mobile=:mobile

                 WHERE
                user_id =:user_id";

    

    // sanitize
    $this->firstname = htmlspecialchars(strip_tags($this->firstname));
    $this->lastname = htmlspecialchars(strip_tags($this->lastname));
    $this->email = htmlspecialchars(strip_tags(trim($this->email)));
    $this->username = htmlspecialchars(strip_tags(trim($this->username)));
    


// prepare query statement
    $stmt = $this->conn->prepare($query);

    $now = date('Y-m-d H:i:s');
    // bind values
    $stmt->bindParam(":firstname", $this->firstname);
    $stmt->bindParam(":user_id",$this->user_id);
    $stmt->bindParam(":lastname", $this->lastname);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":username",$this->username);
    $stmt->bindParam(":account_number",$this->account_number);
    $stmt->bindParam(":updated_at", $now);
    $stmt->bindParam(":permanent_address",$this->permanent_address);
    $stmt->bindParam(":account_balance",$this->account_balance);
    $stmt->bindParam(":pending_withdrawal",$this->pending_withdrawal);
    $stmt->bindParam(":earned_total",$this->earned_total);
    $stmt->bindParam(":withdrawal_total",$this->withdrawal_total);
    $stmt->bindParam(":total_deposit",$this->total_deposit);
    $stmt->bindParam(":current_deposit",$this->current_deposit);
    $stmt->bindParam(":mobile",$this->mobile);


    // execute the query
    if ($stmt->execute()) {
      return true;
    }

    return false;
  }


  function singleUser($id){

    // select all query
    $query = "SELECT *  FROM
                " . $this->table_name . "
                WHERE user_id=:user_id
                LIMIT
                0,1
                 ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":user_id", $id);

    // execute query
    $stmt->execute();

    return $stmt;
  }

  function randomNumber($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
  }
  // create courier
  function register(){

    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
            referral_id=:referral_id,bitcoin_wallet=:bitcoin_wallet,
            was_referred=:was_referred,referred_by=:referred_by,
            user_id=:user_id,firstname=:firstname,lastname=:lastname,email=:email,
            transaction_pin=:transaction_pin,
            created_at=:created_at,password=:password,username=:username,fullname=:fullname,account_number=:account_number,status=:status
             ";
    // prepare query
    $stmt = $this->conn->prepare($query);
    $user_id = time().uniqid();
    // sanitize
    $this->firstname = htmlspecialchars(strip_tags($this->firstname));
    $this->lastname = htmlspecialchars(strip_tags($this->lastname));
    $this->email = htmlspecialchars(strip_tags(trim($this->email)));
    $this->username = htmlspecialchars(strip_tags(trim($this->username)));
    $this->created_at = date('Y-m-d H:i:s');
    $this->password = password_hash(htmlspecialchars(strip_tags(trim($this->password))),PASSWORD_BCRYPT);
    $this->referral_id = $this->randomNumber(30);
    $this->user_id = rand(3,34).time();
    $this->account_number = (rand(0,11).time());
    // bind values
     $stmt->bindParam(":firstname", $this->firstname);
     $stmt->bindParam(":lastname", $this->lastname);
     $stmt->bindParam(":email", $this->email);
     $stmt->bindParam(":username",$this->username);
     $stmt->bindParam(":account_number",$this->account_number);
     $stmt->bindParam(":fullname", $this->fullname);
   $stmt->bindParam(":created_at", $this->created_at);
    $stmt->bindParam(":user_id",$user_id);
   $stmt->bindParam(":password",$this->password);
   $stmt->bindParam(":status", $this->active_status);
   $stmt->bindParam(":referral_id",$this->referral_id);
   $stmt->bindParam(":bitcoin_wallet",$this->bitcoin_wallet);
   $stmt->bindParam(":was_referred",$this->was_referred);
   $stmt->bindParam(":referred_by",$this->referred_by);
    $stmt->bindParam(":transaction_pin", $this->transaction_pin);
    // var_dump($this);
    // die();
    // execute query
    if ($stmt->execute()) {
      
      $message = "
      <div>
      <div align='center'>
  <img src='https://capitalassettrade.net/assets/images/logo2.png' height='50' />


</div>
        <br/>
        <br/>
        <br/>

        <div>Hello $this->firstname,</div>
      <br/>
        <div>
        Thank you for taking your time to register on our platform, a big welcome to the family.

        <p>Your account has been set up and you can now proceed to log in and begin your transactions on the go.</p>

        <br/>
        <br/>

        visit <a href='https://capitalassettrade.net'>https://capitalassettrade.net</a> to login.


        <div>
          <b>Regards,</b>
          <br/>
          <b>Capital Asset Trade Team </b>

        </div>

        
  <br/>
  <br/>
  <br/>
  <br/>

  <div>
  <small>
      P M House
250 Shepcote Lane
SHEFFIELD
SOUTH YORKSHIRE
  <br/>
  hello@capitalassettrade.net
  </small>
  </div>
        </div>
      </div>
      ";
      sendMail($this->email,'hello@capitalassettrade.net','no-reply',$message,$this->fullname,'Capital Asset Trade');

      return $user_id;
    }

    return false;
  }

    /**
   * Perform raw query
   */
  public function query($sql, $params = [],$class = false,$fetch = true) {
    $this->_error = false;
    if($this->_query = $this->conn->prepare($sql)) {
      $x = 1;
      if(count($params)) {
        foreach($params as $param) {
          $this->_query->bindValue($x, $param);
          $x++;
        }
      }
      if($this->_query->execute()) {

        if($fetch){
          if($class && $this->_fetchStyle === PDO::FETCH_CLASS){
            $this->_result = $this->_query->fetchAll($this->_fetchStyle,$class);
          } else {
            $this->_result = $this->_query->fetchAll($this->_fetchStyle);
          }
          
        $this->_count = $this->_query->rowCount();
        $this->_lastInsertID = $this->conn->lastInsertId();
          }
        
      } else {
        $this->_error = true;
      }
    }
    return $this;
  }


public function pinUpdate(){
  $oldPin  = $this->oldPin;
  $newPin =  $this->newPin;

  if(($oldPin)){

    $q = "SELECT * FROM users WHERE user_id=:user_id";
    $stmt =  $this->conn->prepare($q);

    $stmt->bindParam(':user_id', $_SESSION['user_id']);

    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $transaction_pin =  $user['transaction_pin'];

    if($oldPin !==  $transaction_pin){
      return ['status' => false, 'message' => 'Old Pin is incorrect'];
    } else {

      if($transaction_pin === $newPin){
        return ['status' => false , 'message' => 'Old pin and new Pin cannot be the same'];

      }

      $q__ = "UPDATE users SET transaction_pin=:newPin WHERE user_id=:userid";
      $stmt_ = $this->conn->prepare($q__);

      $stmt_->bindParam(":newPin", $newPin);
      $stmt_->bindParam(":userid", $_SESSION['user_id']);

      if($stmt_->execute()){
        return ['status' => true , 'message' => 'Pin Updated Succesfully!'];
      } else {
         return ['status' => false , 'message' => 'Failed to update Pin'];
      }
    }
  }
}


public function finalizeAccountRecovery()
{
  $user = $this->query("SELECT * FROM users WHERE reset_token = ?",[$this->token],false,true);

  date_default_timezone_set('Africa/Lagos');

  if($user->_result && $user->_result[0]->reset_token_expiry){
    $now = date("Y-m-d H:i:s");
    $due = date($user->_result[0]->reset_token_expiry);
    $date1_ = strtotime($due);  
    $date2_ = strtotime($now);
  // Formulate the Difference between two dates 
  if($date2_ > $date1_){
    // expired
    $_SESSION['ERROR'] = 'Reset Token Expired';
    return header('Location: ../../../create-new-password.php?E=EXPIRED');
  
  } else {
    
    $q__ = "UPDATE users SET password=:password,reset_token=:reset_token,reset_token_expiry=:reset_token_expiry WHERE reset_token=:reset_token__";
    $stmt_ = $this->conn->prepare($q__);
  
    $null =  null;
    $this->password  =  password_hash($this->password, PASSWORD_BCRYPT);
    $stmt_->bindParam(":password",$this->password);
    $stmt_->bindParam(":reset_token__", $this->token);
    $stmt_->bindParam(":reset_token", $null);
    $stmt_->bindParam(":reset_token_expiry", $null);
  
    if($stmt_->execute()){

      $username =  $user->_result[0]->username;
  
      $message = "
      <div>
      <div align='center'>
  <img src='https://capitalassettrade.net/assets/images/logo2.png' height='50' />


  </div>
        <br/>
        <br/>
        <br/>
  
        <div>Hi $username,</div>
      <br/>
        <div>
        Your account has been succesfully recovered and password reset, please log into your your account with 
        your email and your new password.
        <br/>
        <br/>
  
        <div>
          <b>Regards,</b>
          <br/>
          <b>Capital Asset Trade Team </b>
  
        </div>
  
        
  <br/>
  <br/>
  <br/>
  <br/>
  
  <div>
  <small>
      P M House
250 Shepcote Lane
SHEFFIELD
SOUTH YORKSHIRE
  <br/>
  hello@capitalassettrade.net
  </small>
  </div>
        </div>
      </div>
      ";
      sendMail($this->email,'hello@capitalassettrade.net','Account Password Reset',$message,$user->_result[0]->username,'Capital Asset Trade');
      unset($_SESSION['ERROR']);
      unset($_SESSION['TOKEN']);
      $_SESSION['SUCCESS'] = 'Password Reset was successful,try to login with your new password';
    
      return  header('Location: ../../../index.php?reset-p=true');
  
    } else {
      $_SESSION['ERROR'] = 'Failed to recover account, attempt starting the whole process afresh';
      return  header('Location: ../../../create-new-password.php');
  
    }
  
  }
  
  } else {
    
    $_SESSION['ERROR'] = 'Invalid or expired token';
    return  header('Location: ../../../create-new-password.php');
  }
  
  
}
public function confirmPasswordResetToken(){
  $user = $this->query("SELECT reset_token_expiry FROM users WHERE reset_token = ?",[$this->token],false,true);

  date_default_timezone_set('Africa/Lagos');

  $now = date("Y-m-d H:i:s");
  $due = date($user->_result[0]->reset_token_expiry);
  $date1_ = strtotime($due);  
  $date2_ = strtotime($now);

  if($user->_result && $user->_result[0]->reset_token_expiry){
    // Formulate the Difference between two dates 
if($date2_ > $date1_){
  // expired
  $_SESSION['ERROR'] = 'Reset Token Expired';
  return header('Location: ../../../index.php?E=EXPIRED');

} else {
  // var_dump($user);
  $_SESSION['TOKEN'] = $_GET['t'];

  return  header('Location: ../../../create-new-password.php');
}
  } else {
    $_SESSION['ERROR'] = 'Invalid Token';
    return header('Location: ../../../index.php?E=EXPIRED');
  
  }


}

public function passwordReset(){

  $user = $this->query("SELECT email,username FROM users WHERE email = ?",[$this->email],false,true);
  if($user && $user->_result && $user->_result[0]){

    $token = hash('ripemd160', time().$this->email);
    date_default_timezone_set('Africa/Lagos');

    $date_due = date_create(date("Y-m-d H:i:s"));
    $this->date_due = date_format($date_due,"Y-m-d H:i:s");
    
    $this->token_expiry = date_format(date_add($date_due, date_interval_create_from_date_string('24 hours')),"Y-m-d H:i:s");
    $this->token = $token;

    
    $q__ = "UPDATE users SET reset_token=:reset_token,reset_token_expiry=:reset_token_expiry WHERE email=:email";
    $stmt_ = $this->conn->prepare($q__);

    $stmt_->bindParam(":email", $this->email);
    $stmt_->bindParam(":reset_token", $this->token);
    $stmt_->bindParam(":reset_token_expiry", $this->token_expiry);

    if($stmt_->execute()){
      $username =  $user->_result[0]->username;

      $message = "
      <div>
      <div align='center'>
  <img src='https://capitalassettrade.net/assets/images/logo2.png' height='50' />


</div>
        <br/>
        <br/>
        <br/>

        <div>Hi $username,</div>
      <br/>
        <div>
        A password reset was triggered for your account recently, use the link below to complete the
        process and get back into your account. For this you would need to create a new password for your
        account. If this action was not authorized by you please contact us via our suport mail <a href='mailto:hello@capitalassettrade.net'>hello@capitalassettrade.net</a>.
        <br/>
        <br/>

         <a href='https://capitalassettrade.net/api/crypto/users/tokenconfirmation.php?t=$this->token'>Reset Password</a>


        <div>
          <b>Regards,</b>
          <br/>
          <b>Capital Asset Trade Team </b>

        </div>

        
  <br/>
  <br/>
  <br/>
  <br/>

  <div>
  <small>
      P M House
250 Shepcote Lane
SHEFFIELD
SOUTH YORKSHIRE
  <br/>
  hello@capitalassettrade.net
  </small>
  </div>
        </div>
      </div>
      ";
      sendMail($this->email,'hello@capitalassettrade.net','Account Reset',$message,$user->_result[0]->username,'Capital Asset Trade');

      return ['status' => true , 'message' => 'Great! Your reset email is on it\'s way, check your inbox'];

    } else {
       return ['status' => false , 'message' => 'Failed'];
    }


  } else {
    return ['status' => false, 'message' => 'Account not found'];

  }
}

  public function passWordUpdate()
  {
    //
    $oldPassword  = $this->oldPassword;
    $newPassword =  $this->newPassword;

    if(($oldPassword)){

      $q = "SELECT * FROM users WHERE user_id=:user_id";
      $stmt =  $this->conn->prepare($q);

      $stmt->bindParam(':user_id', $_SESSION['user_id']);

      $stmt->execute();

      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      $usersPassword =  $user['password'];

      if(!password_verify($oldPassword, $usersPassword)){
        return ['status' => false, 'message' => 'Old Password is incorrect'];
      } else {
        $hashedNewPassword  =  password_hash($newPassword, PASSWORD_BCRYPT);

        $q__ = "UPDATE users SET password=:newpassword WHERE user_id=:userid";
        $stmt_ = $this->conn->prepare($q__);

        $stmt_->bindParam(":newpassword", $hashedNewPassword);
        $stmt_->bindParam(":userid", $_SESSION['user_id']);

        if($stmt_->execute()){
          return ['status' => true , 'message' => 'Password Updated Succesfully!'];
        } else {
           return ['status' => false , 'message' => 'Failed to update Password'];
        }

      }




    }
  }

    
}
