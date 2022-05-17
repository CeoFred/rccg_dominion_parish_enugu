<?php
require_once 'Base.php';

require_once 'mailer.php';

class Notifications extends Base {

  // database connection and table name
  private $conn,$table_name = "notifications";

  // object properties
  public $id,$deposit_id,$user_id,$amount,$status,$plan_id,$created_at,$updated_at;
  
  public $investment_confirmed = 2;


 public $active_status = 1,$not_active = 0, $matured = 3;

  private $_fetchStyle = PDO::FETCH_CLASS;
  // constructor with $db as database connection
  public function __construct($db){
    $this->conn = $db;
    ini_set('timezone','Africa/Lagos');

  }


  public function readUsernNotification($user_id)
  {
    
    // delete query
    $query = "SELECT * FROM $this->table_name
    WHERE user_id=:user_id";

    // prepare query
    $stmt = $this->conn->prepare($query);
    $this->id = htmlspecialchars(strip_tags($user_id));
    $stmt->bindParam(":user_id", $user_id);
     $stmt->execute();
     return $stmt;
  }


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
  function create($user_id)
  {

    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
            message=:message,
            user_id=:user_id,
            activity_type=:activity_type,
            notify_id=:notify_id,
            browser=:browser,
            ip=:ip
                ";

    // prepare query
    $stmt = $this->conn->prepare($query);
    $notify_id = time().uniqid();
    $this->notify_id = $notify_id;
    $user_id = htmlspecialchars(strip_tags($user_id));

    $stmt->bindParam(":notify_id", $this->notify_id);
    $stmt->bindParam(":activity_type", $this->activity_type);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":message", $this->message);
    $stmt->bindParam(":browser", $this->browser);
    $stmt->bindParam(":ip", $this->ip);
    
    // execute query
    if ($stmt->execute()) {
       return true;
    }

    return false;
  }

}
