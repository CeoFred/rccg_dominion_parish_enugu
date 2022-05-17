<?php
require_once 'Base.php';

require_once 'mailer.php';
require_once 'settings.php';

class Deposit extends Base {

  // database connection and table name
  private $conn,$table_name = "deposits";

  // object properties
  public $id,$deposit_id,$user_id,$amount,$status,$plan_id,$created_at,$updated_at;
  
  public $investment_confirmed = 2;


 public $active_status = 1,$not_active = 0, $matured = 3;

  private $_fetchStyle = PDO::FETCH_CLASS;
  // constructor with $this->conn as database connection
  public function __construct($db){
    $this->conn = $db;
    date_default_timezone_set('Africa/Lagos');

    $site_settings =  new SiteSettings($db);
    $this->site_settings = $site_settings->getInfo()[0];
    $h = extract($this->site_settings, EXTR_PREFIX_SAME, 'site');
    // echo $h;
  }


  public function updateInvestment(){
    date_default_timezone_set('Africa/Lagos');

    // delete query
    $query = "UPDATE $this->table_name
    SET amount=:amount, plan_id=:plan_id, payment_method=:payment_method, date_due=:date_due,updated_at=:updated_at
    WHERE deposit_id=:deposit_id";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->id = htmlspecialchars(strip_tags($this->deposit_id));
    $this->plan_id = htmlspecialchars(strip_tags($this->plan_id));
    $this->payment_method = htmlspecialchars(strip_tags($this->payment_method));
    
    $this->updated_at = date('Y-m-d H:i:s');
    

    $stmt->bindParam(":amount", $this->amount);
    $stmt->bindParam(":updated_at", $this->updated_at);
    $stmt->bindParam(":deposit_id", $this->id);
    $stmt->bindParam(":plan_id", $this->plan_id);
    $stmt->bindParam(":payment_method", $this->payment_method);
    $stmt->bindParam(":date_due", $this->date_due);



    // execute query
    return $stmt->execute();
    
  }

  public function restore($deposit_id)
  {
date_default_timezone_set('Africa/Lagos');
    
    // delete query
    $query = "UPDATE $this->table_name
    SET status=:status,
    updated_at=:updated_at
    WHERE deposit_id=:deposit_id";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->id = htmlspecialchars(strip_tags($deposit_id));
    $this->updated_at = date('Y-m-d H:i:s');
    // bind id of record to delete
    $stmt->bindParam(":status", $this->active_status);
    $stmt->bindParam(":updated_at", $this->updated_at);
    $stmt->bindParam(":deposit_id", $deposit_id);

    // execute query
    return $stmt->execute();
    
  }

  
  function confirmInvestment(){
    date_default_timezone_set('Africa/Lagos');
    $deposit = (object) $this->readOne();
    $date_due = date_create(date("Y-m-d H:i:s"));
    $this->date_due = date_format($date_due,"Y-m-d H:i:s");
    
    $days_array  = ['Basic' => '5 days','Standard' => '7 Days','Medium' => '10 days',];
    $real_due_time = $days_array[$deposit->plan_id];
    
    $this->date_due = date_format(date_add($date_due, date_interval_create_from_date_string($real_due_time)),"Y-m-d H:i:s");
    
    // update query
    $query =    "UPDATE
    " . $this->table_name . "

    SET
    status=:status,
    term_started=:term_started,
    updated_at=:updated_at,
    date_due=:date_due
    WHERE deposit_id=:deposit_id

    ";


// prepare query statement
$stmt = $this->conn->prepare($query);
$this->started = date('Y-m-d H:i:s');

// bind id of job to be updated
$stmt->bindParam(":status", $this->investment_confirmed);
$stmt->bindParam(":deposit_id", $this->deposit_id);
$stmt->bindParam(":updated_at", $this->started);
$stmt->bindParam(":term_started", $this->started);
$stmt->bindParam(":date_due", $this->date_due);

if($stmt->execute()){
return true;
} else {
return false;
}

}

function forceMatureInvestment(){
    date_default_timezone_set('Africa/Lagos');


    $depoClass =  new Deposit($this->conn);
    $referralClass = new Referrals($this->conn);

    $table_name = 'deposits';

    $site =  new SiteSettings($this->conn);

    $commison_percent = $site->getInfo()[0]['commission_percent'];

    $getSingleDepositQuery = "SELECT * FROM $table_name WHERE deposit_id=:deposit_id LIMIT 1";

    $stmt = $this->conn->prepare($getSingleDepositQuery);
    $stmt->bindParam(':deposit_id',$this->deposit_id);

    // execute query
    $stmt->execute();

    // get retrieved row
    $deposit = $stmt->fetch(PDO::FETCH_ASSOC);
  
      $id = $deposit['deposit_id'];
      $amount = $deposit['amount'];
      $user_id = $deposit['user_id'];
      $plan_id = $deposit['plan_id'];
      
      $status = $deposit['status'];
      $depositors_first_name = $deposit['depositors_first_name'];
      $depositors_last_name = $deposit['depositors_last_name'];

        $depoClass->status = 1;
        $depoClass->deposit_id = $id;
        $depoClass->user_id = $user_id;
        $depoClass->plan_id = $plan_id;
        $depoClass->deposit_amount = $amount;

        // add referral bonus here
        $userQuery = "SELECT * FROM users WHERE user_id=:user_id";
        
        // prepare query statement
        $stmt = $this->conn->prepare($userQuery);
        $stmt->bindParam(":user_id", $depoClass->user_id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $referee = $row['referred_by'];

    if (strlen($referee) > 0) {

      $commission = $commison_percent / 100 * $depoClass->deposit_amount;

      $findRefereee = "SELECT * FROM users WHERE referral_id=:referral_id";
      $findRefereeeStatement = $this->conn->prepare($findRefereee);
      $findRefereeeStatement->bindParam('referral_id', $referee);
      $findRefereeeStatement->execute();
      $results = $findRefereeeStatement->fetch(PDO::FETCH_ASSOC);
      $referee_referral_bonus = $results['referral_bonus'];
      $referee_status = $results['status'];

      $new_referral_bonus = $commission + $referee_referral_bonus;


      if ($referee_status) {

        // add referral bonus here
        $addFundsToReferr = "UPDATE
      users
      SET
      referral_bonus=:referral_bonus
      WHERE referral_id=:referral_id";

        $stmt = $this->conn->prepare($addFundsToReferr);
        $stmt->bindParam(":referral_id", $referee);
        $stmt->bindParam(":referral_bonus", $new_referral_bonus);
        if ($stmt->execute()) {

          // update current deposit status
          $updateDeposits = "UPDATE
          deposits
          SET
          status=:status
          WHERE deposit_id=:deposit_id
      ";
          // prepare query statement
          $stmt = $this->conn->prepare($updateDeposits);
          $updated = 3;
          // bind id of job to be updated
          $stmt->bindParam(":status", $updated);
          $stmt->bindParam(":deposit_id", $depoClass->deposit_id);
          $stmt->execute();


          // create referral on table for referee, sends mail too
          $referralClass->create($commission, $depositors_first_name, $depositors_last_name, $new_referral_bonus, $user_id, $referee);
          $update =  $depoClass->matureInvestment();
          return $update;
        }
      }
    } else {

      $updateDeposits = "UPDATE
    deposits
    SET
    status=:status
    WHERE deposit_id=:deposit_id
";
      // prepare query statement
      $stmt = $this->conn->prepare($updateDeposits);
      $updated = 3;

      $stmt->bindParam(":status", $updated);
      $stmt->bindParam(":deposit_id", $depoClass->deposit_id);
      $stmt->execute();

      $update =  $depoClass->matureInvestment();
      return $update;
    }
}


  function matureInvestment(){
date_default_timezone_set('Africa/Lagos');

    $site_name = ($this->site_settings['Name']);
    $site_email = $this->site_settings['support_email'];
    $site_address = $this->site_settings['address_1'];

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
     $query =    "UPDATE
     users
     SET
     account_balance=:account_balance,
     earned_total=:earned_total,
     total_deposit=:total_deposit,
     current_deposit=:current_deposit
     WHERE user_id=:user_id
     ";


// earned_total is the total percentage of investment gained

$this->earned_total_checked = 0;

if($this->plan_id == 'Basic'){
  $this->Earned_total_checked = 5.5 * 5/100 * $this->deposit_amount;
}
if($this->plan_id == 'Standard'){
 $this->earned_total_checked = 7 * 7/100 * $this->deposit_amount;

}   
if($this->plan_id == 'Medium'){
 $this->earned_total_checked = 8.5 * 10/100 * $this->deposit_amount;
}  

//total deposit is the total amount of confirmed deposits
$this->new_total_deposit = $this->deposit_amount + $total_deposit;
// current deposit is the last confirmed deposit
$this->new_current_deposit = $this->deposit_amount;
// account balance is summation of total deposit plus savings
$this->new_account_balance  = $this->earned_total_checked + $account_balance + $this->deposit_amount;
// earned total is the amount
$this->new_earned_total =  $this->earned_total_checked + $earned_total;


// prepare query statement
$stmt = $this->conn->prepare($query);

// bind id of deposit to be updated
$stmt->bindParam(":user_id", $this->user_id);
$stmt->bindParam(":account_balance", $this->new_account_balance);
$stmt->bindParam(":current_deposit", $this->new_current_deposit);
$stmt->bindParam(":total_deposit", $this->new_total_deposit);
$stmt->bindParam(":earned_total", $this->new_earned_total);
$data = ["deposit_id" => $this->deposit_id,"plan" => $this->plan_id,  "fullname"=> $fullname, "email" => $email, "account_balance" => $this->new_account_balance, "amount" => $this->deposit_amount, "account_number" => $account_number];
$this->data = $data;

try {
 
  $message = "
  <div>
  <div align='center'>
  <img src='https://capitalassettrade.net/assets/images/logo2.png' alt=$site_name height='50px' />
</div>
    <br/>
    <br/>
    <br/>

    <div>Hello $firstname,</div>
  <br/>
    <div>
      Congratulations, your invetment was successfull and your earnings has been added to your account which you can view when
      you log into your account. feel free to apply for your cash
      withdrawal and we look forward to more invetments from you. Cheers!!.
      </br>
      
       see below for more details concerning this investment.

      <div class='me-account-summary'>
                        <div class='me-account-summary-head'>
                            <div>
                                <h4>Your Deposit Summary</h4>
                            </div>
                        </div>
                        <div class='me-account-summary-body me-account-money-detail'>
                            <ul>
                                <li>
                                    <div class='me-summary-data'>
                                        <p>Amount Invested</p>
                                        <p><strong>$$this->deposit_amount</strong></p>
                                    </div>
                                </li>
                                
                                <li>
                                    <div class='me-summary-data'>
                                        <p>Payment Status</p>
                                        <p><strong>Confirmed</strong></p>
                                    </div>
                                </li>
                                     
                                <li>
                                <div class='me-summary-data'>
                                    <p>Investment Status</p>
                                    <p><strong>Matured</strong></p>
                                </div>
                            </li>   
                                <li>
                                    <div class='me-summary-data'>
                                        <p>Current Account balance</p>
                                        <p><strong>$$this->new_account_balance</strong></p>
                                    </div>
                                </li>
                                <li>
                                <div class='me-summary-data'>
                                    <p>Total Profit Earned</p>
                                    <p><strong>$$this->new_earned_total</strong></p>
                                </div>
                            </li>
                            
                            <div>
                        </div>
                               
                            </ul>
                        </div>
                    </div>
    <br/>
    <br/>

    visit <a href='https://capitalassettrade.net/dashboard/invest/index.php'>Here</a> to check the status of your deposits and withdrawals.


    <div>
      <b>Regards,</b>
      <br/>
      <b>$site_name Team </b>

    </div>

    
    <br/>
    <br/>
    <br/>
    <br/>

    <div>
    <small>
   $site_address
    <br/>
    $site_email
    </small>
    </div>
    </div>
  </div>
  ";
 
 sendMail($email, $site_email,'no-reply',$message,$firstname,'Capital Asset Trade - Matured Investment');

 // $this->validateReferral($user_id,$this->deposit_amount);

 if($stmt->execute()) return true;
 return false;
} catch (\Throwable $th) {
 return $th->getMessage();  
}

  }

  public function getAllPendingDeposit($user_id){
    $query = "SELECT *  FROM
    " . $this->table_name . "
    WHERE user_id = :user_id AND status=:status
    ORDER BY created_at DESC
    LIMIT 10
    ";
  
  // prepare query statement
  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(":user_id", $user_id);
  $stmt->bindParam(":status",$this->active_status);

  // execute query
  $stmt->execute();

   // get retrieved row
   $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
   return $row;
  }

  public function getAllMaturedDeposit($user_id)  
  {
    // select all query
    $query = "SELECT *  FROM
    " . $this->table_name . "
    WHERE user_id = :user_id AND status=:status
    ORDER BY created_at DESC
    LIMIT 10
    ";
  
  // prepare query statement
  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(":user_id", $user_id);
  $stmt->bindParam(":status",$this->matured);

  // execute query
  $stmt->execute();

   // get retrieved row
   $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
   return $row;
  }
  function readAllActiveDeposit($user_id){
    // select all query
    $query = "SELECT *  FROM
    " . $this->table_name . "
    WHERE user_id = :user_id AND status=:status
    ORDER BY created_at DESC
    ";
  
  // prepare query statement
  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(":user_id", $user_id);
  $stmt->bindParam(":status",$this->investment_confirmed);

  // execute query
  $stmt->execute();

   // get retrieved row
   $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
   $_SESSION['ddp'] = $row;
   return $row;
  }
  function readAllDeposit($user_id){
      // select all query
      $query = "SELECT *  FROM
      " . $this->table_name . "
      WHERE user_id = :user_id
      ORDER BY created_at DESC
      ";
    
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":user_id", $user_id);

    // execute query
    $stmt->execute();

     // get retrieved row
     $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
     $_SESSION['ddp'] = $row;
     return $row;
    }

  // read all deposits
  function read()
  {

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


  // create deposit
  function create()
  {
    date_default_timezone_set('Africa/Lagos');

    $site_name = ($this->site_settings['Name']);
    $site_email = $this->site_settings['support_email'];
    $site_address = $this->site_settings['address_1'];
    $site_eth_adress = $this->site_settings['eth_address'];
    $site_btc_adress = $this->site_settings['btc_address'];
    $site_bch_adress = $this->site_settings['bch_address'];
    $site_perfect_money = $this->site_settings['perfect_money'];

    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
            date_due=:date_due,payment_method=:payment_method,
            term_started=:term_started,
            updated_at=:updated_at,
            deposit_id=:deposit_id,user_id=:user_id,amount=:amount,status=:status,plan_id=:plan_id,
            depositors_first_name=:depositors_first_name,depositors_last_name=:depositors_last_name";

    // prepare query
    $stmt = $this->conn->prepare($query);
    $deposit_id = time().uniqid();
    $this->deposit_id = $deposit_id;
    // var_dump($this);
    // die();
    $this->status = $this->payment_method == 'wallet' ? 2 : 1;
    $this->term_started = $this->payment_method == 'wallet' ? date('Y-m-d H:i:s') : null;
    // sanitize
    $this->user_id = htmlspecialchars(strip_tags($this->user_id));
    $this->depositors_last_name = htmlspecialchars(strip_tags($this->depositors_last_name));
    $this->depositors_first_name = htmlspecialchars(strip_tags($this->depositors_first_name));
    $this->amount = htmlspecialchars(strip_tags($this->amount));
    $this->plan_id = htmlspecialchars(strip_tags($this->plan_id));
    $this->updated_at = $this->payment_method == 'wallet' ? date('Y-m-d H:i:s') : null;
    // bind values
    $stmt->bindParam(":deposit_id", $this->deposit_id);
    $stmt->bindParam(":user_id", $this->user_id);
    $stmt->bindParam(":amount", $this->amount);
    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":payment_method", $this->payment_method);
    $stmt->bindParam(":plan_id", $this->plan_id);
    $stmt->bindParam(":date_due", $this->date_due);
    $stmt->bindParam(":depositors_first_name", $this->depositors_first_name);
    $stmt->bindParam(":depositors_last_name", $this->depositors_last_name);
    $stmt->bindParam(":term_started", $this->term_started);
    $stmt->bindParam(":updated_at", $this->updated_at);
    // execute query
    if ($stmt->execute()) {
      $query = "SELECT *  FROM
      users
      WHERE user_id = :user_id
      LIMIT 0,1
      ";
    
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":user_id", $this->user_id);

    // execute query
    $stmt->execute();

      
     // get retrieved row
     $row = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    
     extract($row);



     if($this->payment_method == 'wallet'){
      //debit user asap
      $query = "UPDATE users SET account_balance=:account_balance WHERE user_id=:user_id";
      
    $this->new_balance = $account_balance >= $this->amount ? $account_balance - $this->amount : 0;
    // var_dump($row);
    // return;
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":user_id", $this->user_id);
    $stmt->bindParam(":account_balance", $this->new_balance);
    // execute query
    if($stmt->execute()){
      $_SESSION['account_balance'] =  $this->new_balance;
    }

    }
      $status = $this->payment_method == 'wallet' ? 'Confirmed' : 'Pending Confimation';

      $this->wallet_address = null ;

      if($this->payment_method == 'BTC'){
        $this->wallet_address = $site_btc_adress;
      } else if ($this->payment_method == 'ETH'){
        $this->wallet_address = $site_eth_adress;
      } else if ($this->payment_method == 'BCH') {
        $this->wallet_address = $site_bch_adress;
      } else if ($this->payment_method == 'PERFECTMONEY') {
        $this->wallet_address = "Perfect Money";
      } else {
        $this->wallet_address = 'Capital Asset Trade Wallet';
      }
  $message = "
  <div>
  <div align='center'>
  <img src='https://capitalassettrade.net/assets/images/logo2.png' alt='$site_name' height='50px' />

</div>
    <br/>
    <br/>
    <br/>

    <div>Hello $this->depositors_first_name,</div>
  <br/>
    <div>
      This mail is to notify you of your most recent deposit, see details below for more information.

      <div class='me-account-summary'>
                        <div class='me-account-summary-head'>
                            <div>
                                <h4>Your Deposit Summary</h4>
                            </div>
                        </div>
                        <div class='me-account-summary-body me-account-money-detail'>
                            <ul>
                                <li>
                                    <div class='me-summary-data'>
                                        <p>Payable Amount</p>
                                        <p><strong>$$this->amount</strong></p>
                                    </div>
                                </li>
                                
                                <li>
                                    <div class='me-summary-data'>
                                        <p>Payment Status</p>
                                        <p><strong>$status</strong></p>
                                    </div>
                                </li>
                                
                                
                                <li>
                                    <div class='me-summary-data'>
                                        <p>Plan</p>
                                        <p><strong>$this->plan_id</strong></p>
                                    </div>
                                </li>
                                

                                <li>
                                    <div class='me-summary-data'>
                                        <p>Approximate Due Profit TimeStamp</p>
                                        <p><strong>$this->date_due</strong></p>
                                    </div>
                                </li>
                                
                                

                             
                                
                                <li>
                                    <div class='me-summary-data'>
                                        <p>Payment Method</p>
                                        <p><strong>$this->payment_method</strong></p>
                                    </div>
                                </li>
                                <li>
                                <div class='me-summary-data'>
                                    <p>Wallet ID</p>
                                    <p><strong>$this->wallet_address</strong></p>
                                </div>
                            </li>
                            
                            <div>
                            
                             Kindly pay the sum of $$this->amount to the specified crypto id and await confirmation.
                             <br><strong>NB:</strong> Your profits would reflect once deposits are comfired and your profit date is due.

                        </div>
                               
                            </ul>
                        </div>
                    </div>
    <br/>
    <br/>
    <br/>
    <br/>

    visit <a href='https://capitalassettrade.net/dashboard/invest/scheme_details.php?id=$this->deposit_id'>Here</a> to check the status of your deposit.


    <div>
      <b>Regards,</b>
      <br/>
      <b>$site_name Team </b>

    </div>


    <br/>
    <br/>
    <br/>
    <br/>

    <div>
    <small>
    $site_address
    <br/>
    $site_email
    </small>
    </div>
    </div>
  </div>
  ";
  sendMail($email,$site_email,'Deposit Invoice',$message,$this->depositors_first_name,$site_name);

      return true;
    }

    return false;
  }

  // used when filling up the update job form
  function readOne(){
    // query to read single record
    $query = "SELECT
                *
            FROM
                " . $this->table_name . " 
            WHERE
                deposit_id = ?
            LIMIT
                0,1";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind id of job to be updated
    $stmt->bindParam(1, $this->deposit_id);


    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
   
    return $row;
  }


  //check if row can be worked on
  public function is_workable(){
    $_query = "SELECT * FROM ".$this->table_name."
                         WHERE job_id = :id AND status = :status";
  $stmt =   $this->conn->prepare($_query);
    $stmt->bindParam(':id',$this->id);
    $stmt->bindParam(':status', $this->active_status);

    $stmt->execute();
    $this->_count = $num =  $stmt->rowCount();
    $this->_result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($this->_count < 0){
      $this->_error = true;
      return false;
    }else{
      return $num;
    }
  }
  /**
   * Perform raw query
   */
  public function query($sql, $params = [],$class = false,$fetch = true) {
    $this->_error = false;
    $this->_result =  null;
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
  // delete the courier
  function delete($deposit_id)
  {

  date_default_timezone_set('Africa/Lagos');

    // delete query
    $query = "UPDATE $this->table_name
    SET status=:status,
    deleted_at=:deleted_at
    WHERE deposit_id=:deposit_id";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->id = htmlspecialchars(strip_tags($deposit_id));
    $this->deleted_at = date('Y-m-d H:i:s');
    // bind id of record to delete
    $stmt->bindParam(":status", $this->not_active);
    $stmt->bindParam(":deleted_at", $this->deleted_at);
    $stmt->bindParam(":deposit_id", $deposit_id);

    // execute query
    if ($stmt->execute()) {
      return true;
    }

    return false;
  }

  // search products
  function search($tracking_id)
  {

    // select all query
    $query = "SELECT *
            FROM
                " . $this->table_name . "
            WHERE
            tracking_id = ? AND package_status = ?";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $tracking_id = htmlspecialchars(strip_tags($tracking_id));
    
    // bind
    $stmt->bindParam(1, $tracking_id);
    $stmt->bindParam(2, $this->active_status);


    // execute query
    if($stmt->execute()){
        return $stmt;  
    }

  }

  // read jobs with pagination
  public function readPaging($from_record_num, $records_per_page)
  {

    // select query
    $query = "SELECT
            *
            FROM
                " . $this->table_name . "
                WHERE status = ?
            ORDER BY created_at DESC
            LIMIT ?, ?";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind variable values
    $stmt->bindParam(1, $this->active_status);
    $stmt->bindParam(2, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(3, $records_per_page, PDO::PARAM_INT);

    // execute query
    $stmt->execute();

    // return values from database
    return $stmt;
  }

  public function count()
  {
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['total_rows'];
  }

}
