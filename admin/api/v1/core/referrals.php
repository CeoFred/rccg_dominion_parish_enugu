<?php
require_once 'mailer.php';

class Referrals {

  // database connection and table name
  private $conn,$table_name = "referrals";

  // object properties
  public $id,$deposit_id,$user_id,$amount,$status,$plan_id,$created_at,$updated_at;
  
 private $null  = null,$deleted_status = 2;


 public $active_status = 1,$not_active = 0;

  private $_fetchStyle = PDO::FETCH_CLASS;
  // constructor with $db as database connection
  public function __construct($db){
    $this->conn = $db;
  }

  public function getBonusHistoryForReferee($referee_id){
    $q = "SELECT * FROM referrals WHERE referee_id=:referee_id";

    
    $stmt = $this->conn->prepare($q);

    $stmt->bindParam(":referee_id", $referee_id);

    $userData  = $stmt->execute();

    if($userData){
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else {
      return false;
    }
  }

  public function getReferralsForUsers($referee_id){


    $userQuery = "SELECT *  FROM users WHERE referral_id=:referral_id ";

    $stmt = $this->conn->prepare($userQuery);

    $stmt->bindParam(":referral_id", $referee_id);

    $userData  = $stmt->execute();

    if($userData){
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else {
      return false;
    }
  }

  
  // create referral
  function create($commission,$depositors_first_name, $depositors_last_name, $amount, $depositors_id, $referee_id)
  {

    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
            depositors_id=:depositors_id,status=:status,
            referral_commision_profit=:referral_commision_profit,depositors_first_name=:depositors_first_name,
            depositors_last_name=:depositors_last_name,referral_commision_id=:referral_commision_id, referee_id=:referee_id";

    // prepare query
    $stmt = $this->conn->prepare($query);
    $referral_commision_id = time().uniqid();
    $this->referral_commision_id = $referral_commision_id;
    $this->status = 1;

    // sanitize
    $this->referee_id = htmlspecialchars(strip_tags($referee_id));
    $this->depositors_last_name = htmlspecialchars(strip_tags($depositors_last_name));
    $this->depositors_first_name = htmlspecialchars(strip_tags($depositors_first_name));
    $this->amount = htmlspecialchars(strip_tags($amount));
    $this->depositors_id = htmlspecialchars(strip_tags($depositors_id));

    // bind values
    $stmt->bindParam(":referral_commision_id", $this->referral_commision_id);
    $stmt->bindParam(":referral_commision_profit", $amount);
    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":depositors_first_name", $this->depositors_first_name);
    $stmt->bindParam(":depositors_last_name", $this->depositors_last_name);
    $stmt->bindParam(":referee_id", $this->referee_id);
    $stmt->bindParam(":depositors_id", $this->depositors_id);

    

    // send mail to refereee
    if ($stmt->execute()) {

      $query = "SELECT *  FROM
      users
      WHERE referral_id = :referral_id
      LIMIT 0,1
      ";
    
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":referral_id", $referee_id);

    // execute query
    $stmt->execute();

     // get retrieved row
     $row = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    
     extract($row);

  $message = "
  <div>
  <div align='center'>
  <img src='https://capitalassettrade.net/assets/images/logo2.png' height='50' />
  </div>
    <br/>
    <br/>
    <br/>

    <div>Hello $username,</div>
  <br/>
    <div>
        You have successfully received your referral commision, more details concerning this transaction 
        can be seen below. 
      <div class='me-account-summary'>
                        <div class='me-account-summary-head'>
                            <div>
                                <h4>Commission Profit Summary</h4>
                            </div>
                        </div>
                        <div class='me-account-summary-body me-account-money-detail'>
                            <ul>
                                <li>
                                    <div class='me-summary-data'>
                                        <p>Total Referral Bonus</p>
                                        <p><strong>$$amount</strong></p>
                                    </div>
                                </li>
                                
                                <li>
                                    <div class='me-summary-data'>
                                        <p>Depositors Name</p>
                                        <p><strong>$depositors_first_name $depositors_last_name</strong></p>
                                    </div>
                                </li>
                            
                                <li>
                                <div class='me-summary-data'>
                                        <p>Referral Commision</p>
                                        <p><strong>$$commission</strong></p>
                                    </div>
                            </li>
                            
                               
                            </ul>
                        </div>
                    </div>
    <br/>
    <br/>
    <br/>
    <br/>

    visit <a href='https://capitalassettrade.net/dashboard/invest/index.php'>Here</a> to see your bonus.


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
  sendMail($email,'hello@capitalassettrade.net','Referral Commision Invoice',$message,$username,'Capital Asset Trade');

      return true;
    }

    return false;
  }

}
