<?php

require_once 'Base.php';
require_once 'mailer.php';
require_once 'notifications.php';
require_once 'settings.php';

class Withdrawals extends Base {

  // database connection and table name
  public $conn,$table_name = "withdrawals", $null  = null,$deleted_status = 2,$active_status = 1,$not_active = 0,$_result = null;
  private $_fetchStyle = PDO::FETCH_CLASS;

  // constructor with $db as database connection
  public function __construct($db){

    $this->conn = $db;
    $site_settings =  new SiteSettings($db);
    $this->site_settings = $site_settings->getInfo()[0];
    // var_dump($this->site_settings);
    extract($this->site_settings,EXTR_PREFIX_ALL,'site_settings');
  
    }


    public function deleted()
    {
    // select all query
    $query = "SELECT " . $this->table_name . ".created_at, " . $this->table_name . ".user_id," . $this->table_name . ".withdrawal_id," . $this->table_name . ".amount," . $this->table_name . ".status," . $this->table_name . ".id,users.firstname, users.lastname FROM
                " . $this->table_name . "
                INNER JOIN users ON " . $this->table_name . ".user_id = users.user_id
               ORDER BY created_at DESC
              
                 ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    return $stmt;
    }


    public function delete(String $id)  
    {
    $query =  "UPDATE withdrawals
    SET
    status=:status
    WHERE withdrawal_id=:withdrawal_id
    ";


// prepare query statement
$stmt = $this->conn->prepare($query);
$deleted = 2;

$stmt->bindParam(":status", $deleted);
$stmt->bindParam(":withdrawal_id", $id);

$notificaton = new Notifications($this->conn);
$notificaton->activity_type = 'Withrawal';
$notificaton->message = "Withdrawal with id $id was cancelled";
$notificaton->ip = $_SERVER['REMOTE_ADDR'];
$notificaton->browser = $_SERVER['HTTP_USER_AGENT'];
$notificaton->create($_SESSION['user_id']);

return $stmt->execute();
}




    function confirmwithdrawal(){
      // update query
    $query =    "UPDATE
    " . $this->table_name . "

    SET
    status=:status,updated_at=:updated_at
    WHERE withdrawal_id=:withdrawal_id

    ";


// prepare query statement
$stmt = $this->conn->prepare($query);
$this->updated_at = date('Y-m-d H:i:s');
// bind id of job to be updated
$stmt->bindParam(":status", $this->active_status);
$stmt->bindParam(":withdrawal_id", $this->withdrawal_id);
$stmt->bindParam(":updated_at", $this->updated_at);




// execute query
if($stmt->execute()){

$userQuery = "SELECT * FROM users WHERE user_id=:user_id";

// prepare query statement
$stmt = $this->conn->prepare($userQuery);

// bind id of job to be updated
$stmt->bindParam(":user_id", $this->user_id);

// execute query
$stmt->execute();

// get retrieved row
$row = $stmt->fetch(PDO::FETCH_ASSOC);

extract($row);

// update query
$query = "UPDATE users
SET
account_balance=:account_balance,
withdrawal_total=:withdrawal_total,
pending_withdrawal=:pending_withdrawal
WHERE user_id=:user_id
";


$new_account_balance  = ($account_balance) - ($this->amount);
$this->new_account_balance = $new_account_balance;
$new_withdrawal_total = ($withdrawal_total) + ($this->amount);
$this->new_withdrawal_total = $new_withdrawal_total;

$pending_withdrawal = 0.00;
// prepare query statement
$stmt = $this->conn->prepare($query);

// bind id of job to be updated
$stmt->bindParam(":user_id", $this->user_id);
$stmt->bindParam(":account_balance", $new_account_balance);
$stmt->bindParam(":withdrawal_total", $new_withdrawal_total);
$stmt->bindParam(":pending_withdrawal", $pending_withdrawal);

try {
if($stmt->execute()) {

  $notificaton = new Notifications($this->conn);
  $notificaton->activity_type = 'Withrawal';
  $notificaton->message = "Your Withdrawal of $this->amount has been confirmed";
  $notificaton->ip = $_SERVER['REMOTE_ADDR'];
  $notificaton->browser = $_SERVER['HTTP_USER_AGENT'];
  $notificaton->create($this->user_id);

  $message = "
  <div>
  <div align='center'>  
  <img src='https://capitalassettrade.net/assets/images/logo2.png' height='50' />

</div>
    <br/>
    <br/>
    <br/>

    <div>Hello $firstname,</div>
  <br/>
    <div>
    This mail is to inform you that your withdrawal of $this->amount has been successfully transfered to
    the payment method you specified during this transacton. Your dashboard has been duely updated with 
    detailed information concerning this withdrawal, if you are not aware of this, please contact us at
    hello@capitalassettrade.net and we would be glad to assist you, thank you.

      <div class='me-account-summary'>
                        <div class='me-account-summary-head'>
                            <div>
                                <h4>Your Withdrawal Summary</h4>
                            </div>
                        </div>
                        <div class='me-account-summary-body me-account-money-detail'>
                            <ul>
                                <li>
                                    <div class='me-summary-data'>
                                        <p>Withdrawal Amount</p>
                                        <p><strong>$$this->amount</strong></p>
                                    </div>
                                </li>
                                
                                <li>
                                    <div class='me-summary-data'>
                                        <p>Status</p>
                                        <p><strong>Confirmed</strong></p>
                                    </div>
                                </li>
                                        
                                <li>
                                    <div class='me-summary-data'>
                                        <p>New Account balance</p>
                                        <p><strong>$$this->new_account_balance</strong></p>
                                    </div>
                                </li>
                                <li>
                                <div class='me-summary-data'>
                                    <p>Total Amount Withdrawn</p>
                                    <p><strong>$$this->new_withdrawal_total</strong></p>
                                </div>
                            </li>
                            
                            <div>
                        </div>
                               
                            </ul>
                        </div>
                    </div>
    <br/>
    <br/>

    visit <a href='https://capitalassettrade.net/dashboard/invest/index.php'>Here</a> to check the status of your investments and withdrawals.


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
  sendMail($email,'hello@capitalassettrade.net','Withdrawal Payout Successful',$message,$firstname,'Capital Asset Trade');
  
  return true;
}
return false;
} catch (\Throwable $th) {
return $th->getMessage();  
}

} else return false;


    }

    function create(){
        
    // query to insert record
    $query = "INSERT INTO
    " . $this->table_name . "
SET
user_id=:user_id,amount=:amount,wallet_id=:wallet_id,wallet=:wallet,status=:status,withdrawal_id=:withdrawal_id
 ";

// prepare query
$stmt = $this->conn->prepare($query);

$stmt->bindParam(":user_id", $this->user_id);
$stmt->bindParam(":amount", $this->amount);
$stmt->bindParam(":wallet_id", $this->wallet_id);
$stmt->bindParam(":wallet", $this->wallet);
$stmt->bindParam(":status", $this->not_active);
$stmt->bindParam(":withdrawal_id", $this->withdrawal_id);


$userQuery = "SELECT * FROM users WHERE user_id=:user_id";

// prepare query statement
$stmt__ = $this->conn->prepare($userQuery);

// bind id of job to be updated
$stmt__->bindParam(":user_id", $this->user_id);

// execute query
$stmt__->execute();

// get retrieved row
$row_ = $stmt__->fetch(PDO::FETCH_ASSOC);

extract($row_);

if($row_['account_balance'] < $this->amount){
  echo $this->actionFailure('Insuffucient funds to withdraw');
  die();
}

$message = "
<div>
<div align='center'>

<img src='https://capitalassettrade.net/assets/images/logo2.png' height='50' />

</div>
  <br/>
  <br/>
  <br/>

  <div>Hello $firstname,</div>
<br/>
  <div>
  This mail is to inform you that a withdrawal of $$this->amount.00 has been initiated.
   Please be patient with us while we process your withdrawal which 
  takes usually less than 24Hrs. Your dashboard would be duely updated with 
  detailed information concerning this withdrawal, if you are not aware of this, please contact us at
  hello@capitalassettrade.net and we would be glad to assist you, thank you.

    <div class='me-account-summary'>
                      <div class='me-account-summary-head'>
                          <div>
                              <h4>Your Withdrawal Invoice</h4>
                          </div>
                      </div>
                      <div class='me-account-summary-body me-account-money-detail'>
                          <ul>
                              <li>
                                  <div class='me-summary-data'>
                                      <p>Withdrawal Amount</p>
                                      <p><strong>$$this->amount</strong></p>
                                  </div>
                              </li>
                              
                              <li>
                                  <div class='me-summary-data'>
                                      <p>Status</p>
                                      <p><strong>Pending</strong></p>
                                  </div>
                              </li>
                                  
                          </li>
                          
                          <div>
                      </div>
                             
                          </ul>
                      </div>
                  </div>
  <br/>
  <br/>

  visit <a href='https://capitalassettrade.net/dashboard/invest/index.php?'>Here</a> to check the status of your deposits and withdrawals.


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
sendMail($email,'hello@capitalassettrade.net','Withdrawal Invoice',$message,$firstname,'Capital Asset Trade');

return $stmt->execute();

}


/**
 * Get All Withrawal for single User
 * 
 * @param string $userid required
 * @return array
 */
  function allForUser($userid){
    $query = "SELECT * FROM $this->table_name WHERE user_id=:user_id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":user_id", $userid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  function all(){

    // select all query
    $query = "SELECT " . $this->table_name . ".created_at, " . $this->table_name . ".user_id," . $this->table_name . ".withdrawal_id," . $this->table_name . ".amount," . $this->table_name . ".status," . $this->table_name . ".id,users.firstname, users.lastname FROM
                " . $this->table_name . "
                INNER JOIN users ON ".$this->table_name.".user_id = users.user_id
               ORDER BY created_at DESC
                
                 ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);


    // execute query
    $stmt->execute();

    return $stmt;
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


  function singleForUser($id){

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


  function getDeleted(){
    
    // select all query
    $query = "SELECT *  FROM
                " . $this->table_name . "
                
                WHERE user_id=:user_id AND status=:status
                ORDER BY id DESC
                LIMIT
                0,10
                 ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":user_id", $_SESSION['user_id']);
    $stmt->bindParam(":status", $this->deleted_status);

    // execute query
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  function getActive(){

    // select all query
    $query = "SELECT *  FROM
                " . $this->table_name . "
                
                WHERE user_id=:user_id AND status=:status
                ORDER BY id DESC
                LIMIT
                0,10
                 ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":user_id", $_SESSION['user_id']);
    $stmt->bindParam(":status", $this->active_status);

    // execute query
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  function getUnApproved(){

    // select all query
    $query = "SELECT *  FROM
                " . $this->table_name . "
                
                WHERE user_id=:user_id AND status=:status
                ORDER BY id DESC
                LIMIT
                0,10
                 ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":user_id", $_SESSION['user_id']);
    $stmt->bindParam(":status", $this->not_active);

    // execute query
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  function readOne(){
    
    // select all query
    $query = " SELECT " . $this->table_name . ".wallet," . $this->table_name . ".wallet_id," . $this->table_name . ".created_at, " . $this->table_name . ".user_id," . $this->table_name . ".withdrawal_id," . $this->table_name . ".amount," . $this->table_name . ".status," . $this->table_name . ".id,users.firstname, users.lastname FROM
                " . $this->table_name . "
                INNER JOIN users ON ".$this->table_name.".user_id = users.user_id
                
              WHERE withdrawal_id=:withdrawal_id
              
               ORDER BY created_at DESC
               LIMIT
               0,1
                 ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":withdrawal_id", $this->withdrawal_id);

    // execute query
    $stmt->execute();

    return $stmt;

  }
    
}
