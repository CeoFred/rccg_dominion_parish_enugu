<?php
require_once 'Base.php';

require_once 'mailer.php';

class SiteSettings extends Base {

  // database connection and table name
  private $conn,$table_name = "site_settings";

  // object properties
  public $id=1,$deposit_id,$user_id,$amount,$status,$plan_id,$created_at,$updated_at;
  
  public $investment_confirmed = 2;


 public $active_status = 1,$not_active = 0, $matured = 3;

  private $_fetchStyle = PDO::FETCH_CLASS;
  // constructor with $db as database connection
  public function __construct($db){
    $this->conn = $db;
    date_default_timezone_set('Africa/Lagos');

  }

    /**
     * Update Customer Support Script
     * 
     * @return boolean
     */
    public function updateScript()
    {
        $query = "UPDATE site_settings 
        SET customer_support_script=:customer_support_script 
        WHERE id=:id";

        $stmt = $this->conn->prepare($query);
        $one = 1;
        

        $stmt->bindParam(":customer_support_script", $this->script);
        $stmt->bindParam(":id", $one);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


  public function getInfo()
  {
    
    // delete query
    $query = "SELECT * FROM $this->table_name
    ";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // execute query
     $stmt->execute();
    
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function create()
  {
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
            Name=:Name,btc_address=:btc_address,bch_address=:bch_address,
            bnb_address=:bnb_address,perfect_money=:perfect_money,
            ltc_address=:ltc_address,doge_address=:doge_address,
            commission_percent=:commission_percent,address_1=:address_1,
        support_email=:support_email,eth_address=:eth_address,telephone=:telephone,
            created_at=:created_at,logo_url=:logo_url,modified_by=:modified_by,customer_support_script=:customer_support_script
             ";
    $stmt = $this->conn->prepare($query);

    $this->support_email = htmlspecialchars(strip_tags($this->support_email));
    $this->eth_address = htmlspecialchars(strip_tags($this->eth_address));
    $this->telephone = htmlspecialchars(strip_tags(trim($this->telephone)));
    $this->modified_by = htmlspecialchars(strip_tags(trim($this->modified_by)));
    $this->created_at = date('Y-m-d H:i:s');    
    $this->account_number = (rand(0,11).time());
   

    $stmt->bindParam(":support_email", $this->support_email);
    $stmt->bindParam(":eth_address", $this->eth_address);
    $stmt->bindParam(":telephone", $this->telephone);
    $stmt->bindParam(":customer_support_script", $this->customer_support_script);
  $stmt->bindParam(":created_at", $this->created_at);
  $stmt->bindParam(":logo_url",$this->logo_url);
  $stmt->bindParam(":Name",$this->Name);
  $stmt->bindParam(":btc_address",$this->btc_address);
  $stmt->bindParam(":commission_percent",$this->commission_percent);
  $stmt->bindParam(":address_1",$this->address_1);
   $stmt->bindParam(":modified_by", $this->modified_by);
   $stmt->bindParam(":ltc_address", $this->ltc_address);
   $stmt->bindParam(":doge_address", $this->doge_address);
   $stmt->bindParam(":bnb_address", $this->bnb_address);
   $stmt->bindParam(":perfect_money", $this->perfect_money);
    $stmt->bindParam(":bch_address",
      $this->bch_address
    );


   if ($stmt->execute())   return true;

   return false;
  }

  
  function updateSettings(){
date_default_timezone_set('Africa/Lagos');
        // query to insert record
        $query = "UPDATE $this->table_name 
    SET
    Name=:Name,btc_address=:btc_address,
      bnb_address=:bnb_address,perfect_money=:perfect_money,
            ltc_address=:ltc_address,doge_address=:doge_address,
    commission_percent=:commission_percent,address_1=:address_1,address_2=:address_2,
support_email=:support_email,eth_address=:eth_address,telephone=:telephone
,logo_url=:logo_url,modified_by=:modified_by,bch_address=:bch_address
    WHERE id=:id
     ";
$stmt = $this->conn->prepare($query);

$this->support_email = htmlspecialchars(strip_tags($this->support_email));
$this->eth_address = htmlspecialchars(strip_tags($this->eth_address));
$this->telephone = htmlspecialchars(strip_tags(trim($this->telephone)));
$this->modified_by = htmlspecialchars(strip_tags(trim($this->modified_by)));


$stmt->bindParam(":id", $this->id);
$stmt->bindParam(":support_email", $this->support_email);
$stmt->bindParam(":eth_address", $this->eth_address);
$stmt->bindParam(":telephone", $this->telephone);
$stmt->bindParam(":logo_url",$this->logo_url);
$stmt->bindParam(":Name",$this->Name);
$stmt->bindParam(":btc_address",$this->btc_address);
$stmt->bindParam(":commission_percent",$this->commission_percent);
$stmt->bindParam(":address_1",$this->address_1);
$stmt->bindParam(":address_2",$this->address_2);
$stmt->bindParam(":modified_by", $this->modified_by);
    $stmt->bindParam(":ltc_address", $this->ltc_address);
    $stmt->bindParam(":doge_address", $this->doge_address);
    $stmt->bindParam(":bnb_address", $this->bnb_address);
    $stmt->bindParam(":perfect_money", $this->perfect_money);
    $stmt->bindParam(":bch_address", $this->bch_address);

 if($stmt->execute()) return true;
 return false;
}
}